<html>
<title>Installer</title>
<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<form id="InstallDatabaseForm" method="post" action="<?php echo 'setting.php' ?>" accept-charset="utf-8">
<div id="border">
<div style="display: none; ">
<input type="hidden" name="_method" value="POST"/>
</div>
<table>
<tr>
<td>
<div class="inputSelect">
<label for="InstallDriver">Database Driver</label></td> <td> : </td>
<td><select name="driver" id="InstallDriver">
	<option value="mysql" selected="selected">mysql</option>
	<!--option value="mysqli">mysqli</option>
	<option value="sqlite">sqlite</option>
	<option value="postgres">postgres</option>
	<option value="mssql">mssql</option>
	<option value="db2">db2</option>
	<option value="oracle">oracle</option>
	<option value="firebird">firebird</option>
	<option value="sybase">sybase</option>
	<option value="odbc">odbc</option-->
</select></td>
</div>
</tr>
<tr>
<div class="input text">
	<td><label for="InstallLogin">Host And Port (separated by <b>" : "</b>)</label></td> <td> : </td>
	<td><input name="host" type="text" id="InstallLogin"/></td>
</div>
</tr>
<tr>
<div class="input text">
	<td><label for="InstallLogin">Email</label></td> <td> : </td>
	<td><input name="email" type="text" id="InstallLogin"/></td>
</div>
</tr>
<tr>
<div class="input text">
	<td><label for="InstallPort">Database name</label></td> <td> : </td>
	<td><input name="database" type="text" id="InstallPort"/></td>
</div>
</tr>
<tr>
<tr>
<div class="input text">
	<td><label for="InstallLogin">User / Login</label></td> <td> : </td>
	<td><input name="username" type="text" id="InstallLogin"/></td>
</div>
</tr>

<tr>
<div class="input password">
	<td><label for="InstallPassword">Password</label></td> <td> : </td>
	<td><input type="password" name="password" id="InstallPassword"/></td>
</div>
</tr>
<tr>
<div class="submit">
	<center><td colspan=3><input type="submit" value="Submit"/></td></center>
</div>
</tr>
</table>

</form>
<div id="read">
<?php
	@session_start();
	if(isset($_SESSION['warning'])):
		echo $_SESSION['warning'];
		session_destroy();
	endif; 
?>
</div>
</div>
</body>
</html>