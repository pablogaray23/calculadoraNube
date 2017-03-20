<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
	$email = mysql_real_escape_string($_POST['email']);
	$upass = mysql_real_escape_string($_POST['pass']);
	$res=mysql_query("SELECT * FROM cuenta WHERE email='$email'");
	$row=mysql_fetch_array($res);
	
	if($row['password']==$upass)
	{
		$_SESSION['user'] = $row['user_id'];
		header("Location: home.php");
	}
	else
	{
		?>
        <script>alert(' Datos Incorrectos. Ingrese nuevamente');</script>
        <?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Calculadora - Sistema Login </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<center>

		</br>
		</br>
		<h1> Iniciar Sesi&oacuten </h1>

		<div id="login-form">
			<form method="post">
				<table align="center" width="30%" border="0">
				<tr>
				<td><input type="text" name="email" placeholder=" Tu Email" required /></td>
				</tr>
				<tr>
				<td><input type="password" name="pass" placeholder=" Tu Password" required /></td>
				</tr>
				<tr>
				<td><button type="submit" name="btn-login"> Iniciar </button></td>
				</tr>

				</table>
			</form>

		</div>
		</br>
			<label style="color:blue ; font-size:30px" > <strong> Debes  iniciar  sesión  para  usar  la  aplicación </strong> </label>
		</center>
	</body>
</html>