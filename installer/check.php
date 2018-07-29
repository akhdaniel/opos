<html>
<title>Setting</title>
<head>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="InstallDatabaseForm">
<?php require('setting.php');?>
<?php
$isWriteable = is_writable($_SERVER['DOCUMENT_ROOT'].'/'.$www.'/installer') 
&& is_writable($_SERVER['DOCUMENT_ROOT'].'/'.$www.'/protected/runtime') 
&& is_writable($_SERVER['DOCUMENT_ROOT'].'/'.$www.'/assets');

$minVersion=phpversion() > 5;
$extensions = get_loaded_extensions();
$isIoncubeLoaded = in_array("ionCube Loader", $extensions);
$isCurlLoaded = in_array("curl", $extensions);
$isWin32 = strstr($_SERVER['SERVER_SOFTWARE'],'Win32');
?>

<?php if($isWriteable) : ?>
<div align="center" id="border">
	<h3><div id="write">Your directory is writable. [OK]</div></h3>
</div>
<?php else :?>
<div align="center" id="border">
	<h3><div id="read">Your directory is Not writable.</div></h3>
	<p>Please set the permission or ownership of "opos" folder</p>
</div>
<?php endif; ?>


<?php if($minVersion) : ?>
<div align="center" id="border">
	<h3><div id="write">PHP version <?php echo phpversion()?> > 5.  [OK]</div></h3>
</div>
<?php else :?>
<div align="center" id="border">
	<h3><div id="read">PHP version <?php echo phpversion().' <'?> 5</div></h3>
	<p>RYO AutoResponder requires PHP version minimum of 5.0</p>
</div>
<?php endif; ?>




<?php if($isWriteable && $minVersion ): ?>
<div align="center">
<a href="<?php echo getServerURL().'/'.$www.'/installer/installer.php'; ?>" id='begin'>
Click here to begin installation</a>
</div>
<?php endif; ?>

</div>
</form>
</body>
<html>