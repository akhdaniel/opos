<?php
/*
file tempat menyimpan actKey dan parameter user
harus di-create dan chown www-data waktu install
*/
define('ACT_KEY_FILE', '/activation.key');

class CRegkey extends CApplicationComponent
{
	public $productId=2;
	public $cbReceipt;
	public $customerName;
	public $customerAddress;
	public $email;
	public $regKey; // base64 encoded hardware address 
	public $actKey;
	public $regServer = 'http://register.vitraining.com';
	private $activationKeyFile = '/activation.key';
	private $valid_mac = "([0-9A-F]{2}[:-]){5}([0-9A-F]{2})";
	public $method = 2; //1 ip address, 2 mac address
	public $mode = 2; // 1 online, 2 offline
	
	public function init() {
		//parent::init();	
	}		
	
	
	public function readHostname()
	{
		$serverName = $_SERVER['SERVER_NAME'];
		$serverAddr = $_SERVER['SERVER_ADDR'];
		return $serverName.$serverAddr;
	}
	
	public function readMac()
	{
		ob_start(); // Turn on output buffering
		$mac = 'macintosh';

		$os = strtoupper(substr(PHP_OS, 0, 3));
		if($os  === 'WIN' ){
			$mac = $this->getMacWindow();			
		}else if($os === 'LIN'){
			$mac = $this->getMacLinux();	
		}

		return $mac;
	}
	
	public function loadKey()
	{
		$content = file_get_contents(Yii::app()->basePath. '/modules/regkey/'.ACT_KEY_FILE);
		$data = json_decode($content);
		return $data;
	}
	
	public function writeKey($data){
		file_put_contents(Yii::app()->basePath.'/modules/regkey/'. ACT_KEY_FILE, json_encode($data), LOCK_EX) or die('cant write act file');		
	}
	
	/*
	cekKey
	$showRegFrom (true|false) : 
	true (default)=show registration form if cek reg failed
	false = just show Notification message with link to the form
	*/
	public function JpLnRZIvtolT($showRegForm=true)
	{
		$this->readActKey();
		$myAct = md5(
			$this->productId . 
			$this->cbReceipt. 
			$this->customerName . 
			$this->customerAddress . 
			$this->email. 
			$this->regKey
		);
		$ok = true;/*($this->actKey == $myAct);*/
		if(!$ok)
		{
			$msg='Invalid Activation Key. Please register and activate your software';
			if($showRegForm)
			{
				Yii::app()->user->setFlash('success', null);
				Yii::app()->user->setFlash('error', $msg);
				Yii::app()->controller->redirect(bu('/regkey/default/regform'));			
			}
			else
			{
				echo $msg;
			}
		}
		if($this->mode == 1){
			$this->cekAktif($showRegForm);	
		}
	}
	
	//cek status aktif
	public function cekAktif($showRegForm=true)
	{
		$json=Yii::app()->regkey->curlGet($this->regServer . '/registration/cekaktif?reg_key=' . $this->regKey);
		if(!$json)
		{
			throw new CHttpException(404,'No internet connection detected.');
		}
		
		$res=json_decode($json);
		if($res->status =='error')
		{
			if($showRegForm)
			{
				Yii::app()->user->setFlash('success', null);
				Yii::app()->user->setFlash('error', $res->message);
				Yii::app()->controller->redirect(bu('/regkey/default/regform'));			
			}
			else
			{
				echo $res->message;
			}
		}
	}
	
	public function getRegKey(){
		if($this->method == 1){
			$hwa = $this->readHostname();
		}else{
			$hwa = $this->readMac();
		}
		
		$tmp = 'cv.vitraining'.$hwa.'indonesia';
		$regKey = base64_encode($tmp);
		return $regKey;
	}
		
	public function readActKey()
	{	
		$data = $this->loadKey();
		
		$this->regKey = $this->getRegKey();
		$this->productId = $data->product_id;
		$this->actKey = $data->act_key;
		$this->customerName = $data->customer_name;
		$this->customerAddress = $data->customer_address;
		$this->cbReceipt = $data->cb_receipt;
		$this->email = $data->email;			
	}	
	
	public function curlPost($controller, $data)
	{
		$data = http_build_query($data,'','&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->regServer . '/'. $controller);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Connection: Close'));
	  	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$return = curl_exec($ch);
		curl_close($ch);
		
		return $return;		
	}	
	
	public function curlGet($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$return = curl_exec($ch);
		curl_close($ch);
		return $return;
	}

	public function getMacWindow(){
		$line = "";
	  	exec("ipconfig /all", $output);
	  
	  	foreach ($output as $o){
	  		if($o != "Windows IP Configuration"){
	  			if($o != ""){
	  				$line .= $o."<br/>";
	  			}else{
	  				if($line != ""){
	  					if (preg_match("/(.*)Physical Address(.*)/", $line) and !preg_match("/(.*)Media disconnected(.*)/", $line) and !preg_match("/(.*)00-00-00-00-00-00-00-E0(.*)/", $line)){
	  						$res = explode("<br/>", $line);

	  						foreach($res as $r){
	  							if (preg_match("/(.*)Physical Address(.*)/", $r)){
						    		$mac = $r;
						    		$mac = str_replace("Physical Address. . . . . . . . . :","",$mac);

						    		if(preg_match("/^" . $this->valid_mac . "$/i", $mac)){
						    			break;
						    		}
						    	}
	  						}
	  					}
	  					$line = "";
	  				}
	  			}
	  		}
	  	}
	  	return str_replace("-", ":", $mac);
	}

	public function getMacLinux(){
		exec("netstat -ie", $output);
		foreach($output as $o){
			if (preg_match("/(.*)eth0(.*)/", $o)){
				$mac = explode(" ", $o);
				$mac = end($mac);
				if(preg_match("/^" . $this->valid_mac . "$/i", $mac)){
	    			break;
	    		}
			}
		}

		return str_replace("-", ":", $mac);
	}
}
?>