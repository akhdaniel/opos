<?php
ini_set('max_execution_time',0);
//define('TARGET_URL', 'http://192.168.1.103/versi');
define('TARGET_URL', 'http://vitraining.com/versi');
define('VERSIONING_MODULE', '/versioning/default/');
define('ASSET', DS . 'assets' . DS);
define('APP_NAME', 'opos');

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}


	/********************************************************************************************
	master side
	create updates.zip
	********************************************************************************************/
	public function actionCreatezip(){


		$as = AppSetting::model()->findOrCreate('major_version','1');
		$major_version = $as->val;

		$as = AppSetting::model()->findOrCreate('minor_version','0');
		$minor_version = $as->val;
		$minor_version =  $minor_version + 1;

		//$root = realpath(Yii::app()->basePath . '/../') ;
		$root = getcwd() ;
		$tmp_dir = $root . ASSET;

		$zipFile = $tmp_dir . APP_NAME . "-updates-".$major_version . "." . $minor_version. ".zip";
		$sources = array(
			"themes" .DS,
			"db".DS."db_upgrade.sql",
			"protected".DS."globals.php",
			"protected".DS."controllers".DS,
			"protected".DS."models".DS,
			"protected".DS."views".DS,
			"protected".DS."modules".DS,
		);
		$this->zip( $sources , $zipFile, false , $root );

		$as->val = $minor_version ;
		$as->save();

		$this->upload($zipFile);
		$v = "v". $major_version . ".".$minor_version;
		
		Yii::app()->user->setFlash('success' , 'Zip Created and uploaded. Lastest version: ' . $v );
		$this->redirect(array('/versioning'));			

	}

	function zip($sources, $destination, $include_dir = false, $root)
	{

	    if (!extension_loaded('zip') ) {
	    	echo 'no extention zip';
	        return false;
	    }

	    if (file_exists($destination)) {
	        unlink ($destination);
	    }
	    $zip = new ZipArchive();
	    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
	        return false;
	    }

	    foreach($sources as $source)
	    {
	    	if (!file_exists($source) )
	    	{
	    		echo 'no exist';
	    		return false;
	    	}

		    $source = str_replace('\\', DS, realpath($source));
		    if (is_dir($source) === true)
		    {

		        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), 
		        	RecursiveIteratorIterator::SELF_FIRST);

		        if ($include_dir) {

		            //$arr = explode("/",$source);
		            //$maindir =  $arr[count($arr)- 1];

		            $source = "";
		            for ($i=0; $i < count($arr) - 1; $i++) { 
		                $source .= DS . $arr[$i];
		            }

		            $source = substr($source, 1);
		            $maindir = str_replace($root . DS, '', $source . DS);
		            $zip->addEmptyDir($maindir);

		        }

		        foreach ($files as $file)
		        {
		            $file = str_replace('\\', DS, $file);

		            // Ignore "." and ".." folders
		            if( in_array(substr($file, strrpos($file, DS)+1), array('.', '..')) )
		                continue;

		            $file = realpath($file);
		            if (is_dir($file) === true)
		            {
		                $zip->addEmptyDir(str_replace($root . DS, '', $file . DS));
		            }
		            else if (is_file($file) === true)
		            {
		                $zip->addFromString(str_replace($root . DS, '', $file), file_get_contents($file));
		            }
		        }
		    }
		    else if (is_file($source) === true)
		    {
		        $zip->addFromString(str_replace($root . DS, '', $source), file_get_contents($source));
		    }
	    }

	    return $zip->close();
	}

	/********************************************************************************************
	master site:
	upload zip to server
	********************************************************************************************/
	function upload($filename){
		$file_name_with_full_path = realpath($filename);
		$post = array('extra_info' => '123456','file_contents'=>'@'.$file_name_with_full_path);
		$ch = curl_init();
		$target = TARGET_URL . VERSIONING_MODULE . 'receive';
		curl_setopt($ch, CURLOPT_URL, $target);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result=curl_exec ($ch);
		curl_close ($ch); 
	}

	/********************************************************************************************
	remote site:
	download 
	unzip
	timpa files
	********************************************************************************************/
	public function actionUpgrade(){
		$root = getcwd() ;
		$tmp_dir = $root . ASSET;


		$as = AppSetting::model()->findOrCreate('major_version','1');
		$major_version = $as->val;
		$as = AppSetting::model()->findOrCreate('minor_version','0');
		$minor_version = $as->val;
		$curr_v = "v" . $major_version . "." . $minor_version;

		$new_version_file = $this->getNewVersion();
		//opos-updates-1.94.zip
		list($a, $new_minor_version, $c) = explode(".", $new_version_file);
		$new_v = "v".$major_version . "." . $new_minor_version;

		if($new_version_file <= $minor_version){
			Yii::app()->user->setFlash('warning' , 'No newer version than current version :' . $curr_v );
			$this->redirect(array('/versioning'));		
		}


		$target = TARGET_URL . str_replace('\\','/',ASSET) . $new_version_file;
		if($this->download( $target , $tmp_dir . $new_version_file) ){
			//echo 'new version found: ' . $tmp_dir. $new_version_file;
			//unzip
			if ($this->unzip($tmp_dir.$new_version_file, $root) ){

				$as->val= $new_minor_version;
				$as->save();
	


				Yii::app()->user->setFlash('success' , 'Upgrade successfull. Lastest version: ' . $new_v );
				$this->redirect(array('/versioning'));			
			}
		}
	}

	/********************************************************************************************
	remote site:
	download file 
	********************************************************************************************/
	function download($file_source, $file_target) {
	    $rh = fopen($file_source, 'rb');
	    $wh = fopen($file_target, 'w+b');
	    if (!$rh || !$wh) {
	        return false;
	    }

	    while (!feof($rh)) {
	        if (fwrite($wh, fread($rh, 4096)) === FALSE) {
	            return false;
	        }
	        //echo '.';
	        //flush();
	    }

	    fclose($rh);
	    fclose($wh);

	    return true;
	}

	function unzip($zipFile, $dest_dir){
		$zip = new ZipArchive;
		if ($zip->open($zipFile) === TRUE) {
		    $zip->extractTo($dest_dir);
		    $zip->close();

		    //jalankan sql execute db upgrade
			$lines=array();
			$fp = fopen(Yii::app()->getBaseUrl(true)."/db/db_upgrade.sql", 'r');
			while (!feof($fp))
			{
			    $line=fgets($fp);
			    $line=trim($line);
			    //add to array
			    $lines[]=$line;
			}
			fclose($fp);
			
			if($lines != array() OR $lines[0] != ""){
				foreach ($lines as $l => $value) {
					Yii::app()->db->createCommand($value)->query();
				}
			}

			return true;
		} else {
			return false;
		}		
	}

	/********************************************************************************************
	remote site:
	list upadte files, get the newest 
	********************************************************************************************/
	public function getNewVersion(){
	    $matches = array();
	    
		$target = TARGET_URL . str_replace('\\','/',ASSET);
	    preg_match_all("/(a href\=\")([^\?\"]*)(\")/i", $this->get_text($target), $matches);
	    foreach($matches[2] as $match)
	    {
	        if(strstr($match , APP_NAME)) {
	        	$new =  $match ;	        	
	        }
	    }

	    return $new;
	}


	/********************************************************************************************
	server site:
	receive file 
	********************************************************************************************/
    function get_text($filename)
    {
        $fp_load = fopen("$filename", "rb");
        if ( $fp_load )
        {
            while ( !feof($fp_load) )
            {
                $content .= fgets($fp_load, 8192);
            }
            fclose($fp_load);
        return $content;
        }
    }	
	/********************************************************************************************
	server site:
	receive file 
	********************************************************************************************/
	public function actionReceive(){
		$root = getcwd() ;
		$uploaddir = $root . ASSET;

		$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);
		echo '<pre>';
			if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
			    echo "File is valid, and was successfully uploaded.\n";
			} else {
			    echo "Possible file upload attack!\n";
			}
			echo 'Here is some more debugging info:';
			print_r($_FILES);
			echo "\n<hr />\n";
			print_r($_POST);
		print "</pr" . "e>\n";
	}
}
?>
