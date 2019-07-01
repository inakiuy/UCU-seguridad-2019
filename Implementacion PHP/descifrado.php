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
			<form action="./api/file/download_descifrado.php" method="post">
				Seleccione el archivo a descargar:<br><br>
				<input type="text" name="fileToDownload" id="fileToDownload"><br>
				Contrasena:<br><br>
				<input type="text" name="key" id="key"><br>
				<input type="submit" value="Descargar Archivo" name="submit"><br>
			</form>
		</div>
	</div>
	</body>
</html>