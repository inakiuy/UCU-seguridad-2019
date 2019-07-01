<?php  
	include_once 'api/user/probar.php';
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
			<form action="./api/file/upload_firmado.php" method="post" enctype="multipart/form-data">
				Seleccione el archivo a firmar:<br><br>
				<input type="file" name="fileToUpload" id="fileToUpload"><br>
				<input type="submit" value="Firmar Archivo" name="submit"><br>
			</form>
			<form action="./api/file/upload_verificado.php" method="post" enctype="multipart/form-data">
				<br><br>Seleccione el archivo a verificar:<br><br>
				<p>Archivo</p><input type="file" name="fileToUpload" id="fileToUpload"><br>
				<p>Seleccionar firma</p><input type="file" name="fileToUpload_firma" id="fileToUpload_firma"><br>
				<p>Seleccionar llave pública</p><input type="file" name="fileToUpload_key_publica" id="fileToUpload_key_publica"><br><br>
				<input type="submit" value="Verificar Firma" name="submit"><br>
			</form>
		</div>
	</div>
	</body>
</html>