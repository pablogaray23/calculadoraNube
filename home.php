<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM cuenta WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);






?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> Calculadora - <?php echo $userRow['email']; ?></title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<div id="header">
			<div id="left">
			<label> App Calculadora </label>
			</div>
			<div id="right">
				<div id="content">
					Bienvenido' <?php echo $userRow['email']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
				</div>
			</div>
			<div id="center">
			<center>
				<div id="content">
					Su perfil es <?php echo $userRow['perfil']; ?>&nbsp;
				</div>
				</center>
			</div>
			
			
		</div>



		<div id="body">



		<?php


		if(isset($_POST['submit'])){
			$value1 = $_POST['value1'];
			$value2 = $_POST['value2'];
			$action = $_POST['action'];
			$lala = $userRow['user_id'];

		if($action=="+"){
		echo "<b>Your Answer is:</b><br>" ;
		$resul = $value1+$value2;
		$compname = $value1.' '.$action.' '.$value2.' = '.$resul;
		$fecha = date("Y/m/d");	

		echo $compname;


		if(mysql_query("INSERT INTO registro(user_id,operacion,fecha) VALUES('$lala','$compname','$fecha')"))
					{
					?>

							<?php
							$message = "Operacion exitosa";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
							else
						{
							?>
							<?php
							$message = "Operacion mala ";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}

		}

		if($action=="-"){
		echo "<b>Your Answer is:</b><br>";
		$resul = $value1-$value2;
		$compname = $value1.' '.$action.' '.$value2.' = '.$resul;
		$fecha = date("Y/m/d");

		echo $compname;

		if(mysql_query("INSERT INTO registro(user_id,operacion,fecha) VALUES('$lala','$compname','$fecha')"))
					{
					?>

							<?php
							$message = "Operacion exitosa";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}
							else
						{
							?>
							<?php
							$message = "Operacion mala ";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}

		}

		if($action=="*"){
		echo "<b>Your Answer is:</b><br>";
		$resul = $value1*$value2;
		$compname = $value1.' '.$action.' '.$value2.' = '.$resul;
		$fecha = date("Y/m/d");

		echo $compname;

		if(mysql_query("INSERT INTO registro(user_id,operacion,fecha) VALUES('$lala','$compname','$fecha')"))
					{
					?>

							<?php
							$message = "Operacion exitosa";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}
							else
						{
							?>
							<?php
							$message = "Operacion mala ";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}

		}

		if($action=="/"){
		echo "<b>Your Answer is:</b><br>";

			if($value2 != 0)
			{
			   
				$resul = $value1/$value2;
				$compname = $value1.' '.$action.' '.$value2.' = '.$resul;
				$fecha = date("Y/m/d");

				echo $compname;
				
				
				if(mysql_query("INSERT INTO registro(user_id,operacion,fecha) VALUES('$lala','$compname','$fecha')"))
					{
					?>

							<?php
							$message = "Operacion exitosa";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}
							else
						{
							?>
							<?php
							$message = "Operacion mala ";
			echo "<script type='text/javascript'>alert('$message');</script>";
						}
				}
				else
				{
					$message = " Número 2 debe ser distinto de cero";
			echo "<script type='text/javascript'>alert('$message');</script>";
					
			}	
		}


				


		}
		?>

			<div id="login-form">
			<center>
			
			<h3> Calculadora </h3>
			
			<form method="post">
				<table align="center" width="30%" border="0">
				<tr>
				<td><input type='number'  name='value1' placeholder="       Número 1" required ></td>
				</tr>
				<tr>
				<td><input type='number' name='value2' placeholder="       Número 2" required ></td>
				</tr>
				<tr>
				<td><select name='action' >
				<option>+</option>
				<option>-</option>
				<option>*</option>
				<option>/</option>
				</select></td>
				</tr>
				<tr>
				<td><button type="submit" name="submit"> Calcular ahora </button></td>
				</tr>

				</table>
			</form>	
			
			<?php
				
				$perfil = $userRow['perfil'];

				
				
					if($perfil == "cliente"){
					$result = mysql_query("SELECT * FROM registro WHERE user_id=".$_SESSION['user']);

				echo "<table border='1'>
				<tr>
				<th>    </th>
				<th> Operaci&oacuten </th>
				<th> Fecha </th>
				</tr>";

				while($row = mysql_fetch_array($result))
				{
				echo "<tr>";
				echo "<td> La operaci&oacuten realizada fue </td>";
				echo "<td>" . $row['operacion'] . "</td>";
				echo "<td>" . $row['fecha'] . "</td>";
				echo "</tr>";
				}
				echo "</table>";
					
				}else{
					$result = mysql_query("SELECT * FROM registro LEFT JOIN cuenta ON registro.user_id = cuenta.user_id ORDER BY fecha DESC");

				echo "<table border='1'>
				<tr>
				<th>    </th>
				<th> Operaci&oacuten </th>
				<th> Fecha </th>
				<th> Correo </th>
				</tr>";

				while($row = mysql_fetch_array($result))
				{
				echo "<tr>";
				echo "<td> La operaci&oacuten realizada fue </td>";
				echo "<td>" . $row['operacion'] . "</td>";
				echo "<td>" . $row['fecha'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "</tr>";
				}
				echo "</table>";
				}
				
				
				

				//mysqli_close($con);
				
			
			?>

			
			

		</center>
		</div>
		</div>
	</body>
</html>