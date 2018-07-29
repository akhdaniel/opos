<?php
error_reporting(E_ALL & ~E_NOTICE );
// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
if(!file_exists($config)){
	header("Location: installer/check.php");
}
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once('protected/globals.php');
Yii::createWebApplication($config)->run();
