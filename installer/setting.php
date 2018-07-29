<?php
		$path_parts = pathinfo(dirname(__FILE__));
		$dirname = explode( DIRECTORY_SEPARATOR , $path_parts["dirname"]);
		$www = end($dirname);
		

	if($_POST)
	{
		$con = @mysql_connect($_POST['host'],$_POST['username'],$_POST['password']);
		
			if (!$con)
			{
					session_start();
					$_SESSION['warning'] = 'Failed! Connect to Database';
					header( 'Location: ' . getServerURL() .'/'.$www.'/installer/installer.php' );
			}
			else
			{
				$db_selected = @mysql_select_db($_POST['database'], $con);
				
				if (!$db_selected) 
				{
					$table = createTable($con, $_POST['database']);
					if($table)
					{
						$database = createDatabase($_POST,$www);
						if($database)
						{
							$remove = remove();
							if($remove)
							{
								header( 'Location: ' . getServerURL() .'/'.$www );
							}
						}
						else
						{
							session_start();
							$_SESSION['warning'] = 'Failed to Create Main Config File! Please Make Sure Your Direcory WriteAble';
							header( 'Location: ' . getServerURL() .'/'.$www.'/installer/installer.php' );
						}
					}
					else
					{
						session_start();
						$_SESSION['warning'] = 'Failed Create Database! Try to Drop The Database';
						header( 'Location: ' . getServerURL() .'/'.$www.'/installer/installer.php' );
					}
				}
				else
				{
					session_start();
					$_SESSION['warning'] = 'Failed! Database Name Has Been Used';
					header( 'Location: ' . getServerURL() .'/'.$www.'/installer/installer.php' );
				}
			}

	}
	
	function createTable($con, $database)
	{
			// Create database
		if (mysql_query("CREATE DATABASE ".$database,$con))
		{
			$return = execSQL($con, $database)	;

			return $return;
		}
		else
		{
			return false;
		}
	}

	function execSQL($con, $database){
			// Create table
			mysql_select_db($database, $con);
			
			$aresponder = file_get_contents('table.bak');
			
			$data = explode(';',$aresponder);
			$return = false;
			foreach($data as $sql)
			{
				mysql_query($sql,$con);
				$return = true;
			}
			
			mysql_close($con);				

			return $return;
	}


	
	function createDatabase($my_post,$www)
	{
		$file = file_get_contents('main.bak');

		if($file) 
		{
			$patterns = array();
			$patterns[0] = '[username]';
			$patterns[1] = '[password]';
			$patterns[2] = '[email]';
			$patterns[3] = '[driver]';
			$patterns[4] = '[database]';
			$patterns[5] = '[host]';

			$replacements = array();
			$replacements[0] = $my_post['username'];
			$replacements[1] = $my_post['password'];
			$replacements[2] = $my_post['email'];
			$replacements[3] = $my_post['driver'];
			$replacements[4] = $my_post['database'];
			$replacements[5] = $my_post['host'];

			$stringAkhir = str_replace($patterns, $replacements, $file);
			$fp = @fopen('main.php', 'w');
			fwrite($fp, $stringAkhir);
			fclose($fp);
				
			$old 		= dirname(__FILE__).'/main.php';
			$new 		= $_SERVER['DOCUMENT_ROOT'].'/'.$www.'/protected/config/main.php';

			@copy($old, $new);
			unlink('main.php');
			/*
			$index = changeIndex($www);
			if($index)
			{
				return true;
			}
			else
			{
				return false;
			}*/
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function remove()
	{
		unlink("installer.php");
		//unlink("index.php");
		unlink("check.php");
		unlink("setting.php");
		unlink("main.bak");
		unlink("table.bak");
		rmdir(dirname(__FILE__));
		return true;
	}
	
	function changeIndex($www)
	{
			$old 		= dirname(__FILE__).'/index.php';
			$new 		= $_SERVER['DOCUMENT_ROOT'].'/'.$www.'/index.php';

			@copy($old, $new);
			return true;
	}

	function getServerURL(){
		if(strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,4))=='http') {
		    $strOut = sprintf('http://%s:%d', 
		                   $_SERVER['SERVER_NAME'],
		                   $_SERVER['SERVER_PORT']);
		} else {
		     $strOut = sprintf('https://%s:%d', 
		                   $_SERVER['SERVER_NAME'],
		                   $_SERVER['SERVER_PORT']);
		}
    	return $strOut;		
	}

?>