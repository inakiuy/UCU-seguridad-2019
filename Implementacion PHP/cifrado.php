<?php
	// incluir sesion
	include_once './api/user/probar.php';
	// incluir configuracion del sitio
	include_once './api/config/inc_config.php';
?>

<!DOCTYPE html>
<html lang="en" >
	<head>
	  <meta charset="UTF-8">
	  <title>UCU - Seguridad Informatica 2019v2</title>
	  
	  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	  <link rel="stylesheet" href="./assets/css/style.css">
	</head>

	<body>
	<div class="login-wrap">
		<div class="login-html cifrado">
			<form action="./api/file/upload_cifrado.php" method="post" enctype="multipart/form-data">
				Seleccione el archivo a cifrar:<br><br>
				<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
				Contrasena:<br><br>
				<input type="text" name="key" id="key"><br>
				<input type="submit" value="Cifrar Archivo" name="submit"><br>
			</form>
			<?php echo "<a href='http://$WEBSERVER/api/user/panelSesion.php'>Volver</a><br>"; ?>
		</div>
	</div>
	</body>
</html>