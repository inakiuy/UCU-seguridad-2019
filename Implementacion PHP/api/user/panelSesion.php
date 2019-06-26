<?php  
	//se necesita iniciar la sesion cuando el acceso es para un usuario unicamente
	session_start();
	//esto es para ocultar errores al programador
	error_reporting(0);

	//para que solamente se vea por el usuario iniciado
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion = ''){
		echo 'usted no tiene autorizacion';
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="../../assets/css/style.css">
	<title>estamos dentro</title>
</head>
<body>
	<div class="login-wrap">
  	<div class="login-html">
		<label class="label">bienvenido: <?php echo $_SESSION['usuario'] ?></label>
	<div class="login-form">
	<div class="group">		
		<a href="cerrarSesion.php">cerrar sesion</a>
	</div>
	</div>
	</div>
	</div>
</body>
</html>