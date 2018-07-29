<?php
define('VERSION',"1.13");

/*
1.13
- version management

1.12
- session admin filter by default tampil yang milik user_id login
- session_id hanya ada jika Session.stat = OPEN
- bisa create order hanya jika ada session['session_id']
- semua proses close dan post session menggunakan GET['session_id']
- perbaikan nomor urut order


1.11 Change Logs:

- local user authentication
- penomoran Struk increment getNumber()
- metoda post ke OpenERP: oe_summary_method: 0 | 1
- order cancel new status: perubahan sum total di SEssion model
  hanya ambil yang paid dan posted saja
- product gift (by x get y)
- product discount
- session['oe'] ganti menjadi user->getState('oe')
- tambah version info



*/

/**
 * This is the shortcut to DIRECTORY_SEPARATOR
 */
define('ID_GROUP_SUPER_ADMIN',1);
define('ID_GROUP_CUSTOMER',2);
defined('DS') or define('DS',DIRECTORY_SEPARATOR);

define('ORDER_NEW','NEW');
define('ORDER_CONFIRM','CONFIRM');
define('ORDER_PAID','PAID');
define('ORDER_POSTED','POSTED');
define('ORDER_CANCEL','CANCEL');

define('SESSION_OPENING_CONTROL','OPENING_CONTROL');
define('SESSION_OPEN','OPEN');
define('SESSION_CLOSING_CONTROL','CLOSING_CONTROL');
define('SESSION_CLOSED','CLOSED');
define('SESSION_POSTED','POSTED');

define('JOURNAL_POSTED','POSTED');
define('JOURNAL_UNPOSTED','UNPOSTED');

define('STOCK_MOVE_POSTED','POSTED');
define('STOCK_MOVE_UNPOSTED','UNPOSTED');

define('ORDER_DETAIL_WAITING', 1);
define('ORDER_DETAIL_ONPROGRESS', 2);
define('ORDER_DETAIL_DONE', 3);
define('ORDER_DETAIL_DELIVERED', 4);

define('GROUP_ADMIN', 'ADMIN');
define('GROUP_CASHIER', 'CASHIER');
define('GROUP_WAITER', 'WAITER');
define('GROUP_KITCHEN', 'KITCHEN');

define('JOIN_UNPAID', 'UNPAID');
define('JOIN_PAID', 'PAID');

define('REGULAR_CUSTOMER', 1);
/**
 * This is the shortcut to Yii::app()
 */
function app()
{
    return Yii::app();
}
 
/**
 * This is the shortcut to Yii::app()->clientScript
 */
function cs()
{
    // You could also call the client script instance via Yii::app()->clientScript
    // But this is faster
    return Yii::app()->getClientScript();
}
 
/**
 * This is the shortcut to Yii::app()->user.
 */
function user() 
{
    return Yii::app()->getUser();
}
 
/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route,$params=array(),$ampersand='&')
{
    return Yii::app()->createUrl($route,$params,$ampersand);
}
 
/**
 * This is the shortcut to CHtml::encode
 */
function h($text)
{
    return htmlspecialchars($text,ENT_QUOTES,Yii::app()->charset);
}
 
/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = '#', $htmlOptions = array()) 
{
    return CHtml::link($text, $url, $htmlOptions);
}
 
/**
 * This is the shortcut to Yii::t() with default category = 'stay'
 */
function t($message, $category = 'stay', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}
 
/**
 * This is the shortcut to Yii::app()->request->baseUrl
 * If the parameter is given, it will be returned and prefixed with the app baseUrl.
 */
function bu($url=null) 
{
    static $baseUrl;
    if ($baseUrl===null)
        $baseUrl=Yii::app()->getRequest()->getBaseUrl();
    return $url===null ? $baseUrl : $baseUrl.'/'.ltrim($url,'/');
}
 

/**
* return the server name
 */
function serverName($url=null) 
{
    $server=Yii::app()->getRequest()->getHostInfo();
    return $server;
}

/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name) 
{
    return Yii::app()->params[$name];
}

function getBackGround()
{
	$dir =  'themes/' . Yii::app()->theme->name . '/css/bg/';
	if (is_dir($dir)) 
	{
	    if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {

		        if ($file != "." && $file != ".." && strpos($file,".") && (strpos($file,".")!==0)) {		
	            	$files[] = $dir . $file;
				}
	        }
	        closedir($dh);
	    }
	}	
	//$index = floor( (date('H')*60+ date('i'))/30 ) ;
	$index = floor(gmdate('H') / BG_INDEX_DIVIDER);//0-3 : 3, 3-6: 1
	return bu() . '/'. $files[$index] ;
}

function iconPath($s)
{
	return bu() . '/images/icon/' . $s;
}

function quizImagePath($s)
{
	return bu() . '/images/quiz/' . $s;
}
function lpImagePath($s)
{
	return bu() . '/images/lp/' . $s;
}

function rewardImagePath($s)
{
	return bu() . '/images/reward/' . $s;
}

function oeInfo()
{
	$as = AppSetting::model()->findOrCreate('openerp_server','http://127.0.0.1:8069/xmlrpc/');
	$server			= $as->val;

	$as = AppSetting::model()->findOrCreate('openerp_database','testdb');
	$database		= $as->val;

	$as = AppSetting::model()->findOrCreate('auth_oe','0');
	$auth_oe = $as->val;

	$ret =   "SERVER [" . $server . "] <br>"; 
	$ret .=  "DB [" . $database  . "] <br>"; 
	$ret .=  "OE AUTH [" . $auth_oe  . "] <br>"; 

    if ($oe = Yii::app()->user->getState('oe')){
    	$ret .= "OE SESSION [exists] <br>";
    }

	return $ret ;

}

function oeLogin($username=null , $password=null)
{
	$as = AppSetting::model()->findOrCreate('openerp_server','http://127.0.0.1:8069/xmlrpc/');
	$server			= $as->val;

	$as = AppSetting::model()->findOrCreate('openerp_database','testdb');
	$database		= $as->val;

	$as = AppSetting::model()->findOrCreate('auth_oe','0');
	$auth_oe = $as->val;
	
	if($auth_oe == 1)
	{
		$password		= $password? $password : Yii::app()->user->getState('oe_password');
		$username		= $username? $username : Yii::app()->user->name;
	}
	else
	{
		$as = AppSetting::model()->findOrCreate('openerp_admin_user','admin');
		$openerp_admin_user = $as->val;

		$as = AppSetting::model()->findOrCreate('openerp_admin_pwd','0');
		$openerp_admin_pwd = $as->val;
		
		$username = $openerp_admin_user;
		$password = $openerp_admin_pwd;		

	}

	// kalau gagal login, munkin session masih ada, jadi clear browser dulu
	//if (! Yii::app()->session['oe']){
	if (! Yii::app()->user->getState('oe') ) {
		
		$oe = new OpenERP();
		$userId = $oe->login($username , $password, $database, $server);		

		Yii::app()->user->setState('oe', $oe) ;
		Yii::app()->user->setState('oe_userid',$userId);
	}
	else 
	{
		$oe = Yii::app()->user->getState('oe') ;
		$userId = Yii::app()->user->getState('oe_userid') ;
	}
	return array($oe, $userId) ;
}

function status_kitchen($status_id){
	switch ($status_id) {
		case ORDER_DETAIL_WAITING:
			return 'Waiting';
			break;
		
		case ORDER_DETAIL_ONPROGRESS:
			return 'On Progress';
			break;

		case ORDER_DETAIL_DONE:
			return 'Done';
			break;

		case ORDER_DETAIL_DELIVERED:
			return 'Delivered';
			break;
	}
}

function time_elapsed($start){
	$result = "";
	$start_date 	= new DateTime($start);
	$since_start 	= $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
	
	/*echo $since_start->days.' days total<br>';
	echo $since_start->y.' years<br>';
	echo $since_start->m.' months<br>';
	echo $since_start->d.' days<br>';
	echo $since_start->h.' hours<br>';
	echo $since_start->i.' minutes<br>';
	echo $since_start->s.' seconds<br>';*/
	if($since_start->d > 0){
		$result .= $since_start->d.' days, ';
	}

	if($since_start->h > 0){
		$result .= $since_start->h.' hours, ';
	}

	if($since_start->i > 0){
		$result .= $since_start->i.' minutes, ';
	}

	if($since_start->s > 0){
		$result .= $since_start->s.' seconds ago';
	}

	return $result;
}

/*function in_odi($needle, $haystack){
	var_dump($needle);die;
	foreach($haystack as $h){
		if($needle == $h){
			return true;
		}else{
			return false;
		}
	}
}*/

?>
