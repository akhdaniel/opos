<?php
class DefaultController extends Controller
{
	/*
	semua parameter user dibawah ini akan di md5() di server untuk
	menghasilkan actKey
	*/
	public $productId=2;
	public $cbReceipt;
	public $customerName;
	public $customerAddress;
	public $email;
	public $regKey; // encoded hardware address
	public $computerName; //encode hostname or ip $_SERVER['SERVER_NAME']
	/*
	activation key yang dihasilkan dari server, 
	disimpan di file local activation.key
	*/
	public $actKey;
	
	/*
	alamat server registrasi
	public $regServer = 'http://kukuloba.com:8080/register';
	public $regServer = 'http://localhost/register';
	*/
	
	/*
	kalau mau ambil param dari main.php config
	Yii::app()->controller->module->param1
	*/
    		
	public function actionIndex()
	{
		Yii::app()->controller->redirect(bu('/regkey/default/regForm'));
	}
	
	public function actionRegform()
	{	
		if(isset($_POST['Registration']))
		{
			$this->customerName = $_POST['Registration']['customer_name'];
			$this->customerAddress = $_POST['Registration']['customer_address'];
			$this->cbReceipt = $_POST['Registration']['cb_receipt'];
			$this->email = $_POST['Registration']['email'];
			$this->writeActKey();
			
			$res=json_decode(Yii::app()->regkey->curlPost('registration/create', $_POST));
			
			if($res->status =='ok')
			{
				Yii::app()->user->setFlash('success', $res->message);
				Yii::app()->controller->redirect(bu('/regkey/default/actForm'));				
			}
			else if($res->status =='exist')
			{
				Yii::app()->user->setFlash('info', $res->message);
				Yii::app()->controller->redirect(bu('/regkey/default/actForm'));				
			}
			else if($res->status == 'invalid_cb')
			{
				Yii::app()->user->setFlash('error', $res->message);
				Yii::app()->controller->redirect(bu('/regkey/default/regForm'));								
			}
			else if($res->status == 'error')
			{
				Yii::app()->user->setFlash('error', $res->message);
				Yii::app()->controller->redirect(bu('/regkey/default/regForm'));								
			}
			else
			{
				echo 'Error:' . var_dump($res);
				Yii::app()->end();
			}
		}
		$this->readActKey();
		$this->render('regform');
	}

	public function actionActForm(){
		if(isset($_POST['act_key']))
		{
			$this->readActKey();
			$this->actKey = $_POST['act_key'];
			$this->writeActKey();
			Yii::app()->user->setFlash('success','Activation Key entered successfully. Thank you!');
			$this->redirect(bu('/site'));
		}
		
		$this->render('actform');
	}	
	
	public function writeActKey(){
		$data['product_id']=$this->productId;
		$data['act_key']=$this->actKey;
		$data['customer_name']=$this->customerName;
		$data['customer_address']=$this->customerAddress;
		$data['cb_receipt']=$this->cbReceipt;
		$data['email']=$this->email;
		Yii::app()->regkey->writeKey($data);
	}
	
	public function readActKey()
	{
		
		$data = Yii::app()->regkey->loadKey();
		
		$this->regKey = Yii::app()->regkey->getRegKey();
		$this->productId = $data->product_id;
		$this->actKey = $data->act_key;
		$this->customerName = $data->customer_name;
		$this->customerAddress = $data->customer_address;
		$this->cbReceipt = $data->cb_receipt;
		$this->email = $data->email;			
	}
	
}