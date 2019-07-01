<?php  
	include_once 'probar.php';
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
		<label class="label">bienvenido: <?php echo $_SESSION['usuario'] ?></label><br><br><br>
	<div class="login-form">		
	<div class="group">
		<label class="label">acceda a nuestros servicios de:</label><br><br><br>
		<a href="../../cifrado.php">cifrado</a><br><br>
		<a href="../../decifrado.php">decifrado</a><br><br>
		<a href="../../firmado.php">firmado</a><br><br>
		<a href="cerrarSesion.php">cerrar sesion</a><br><br>
	</div>
	</div>
	</div>
	</div>
</body>
</html>