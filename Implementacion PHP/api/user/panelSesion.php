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