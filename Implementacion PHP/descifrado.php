<?php
// get database connection
include_once './api/config/database.php';

// incluir configuracion del sitio
include_once './api/config/inc_config.php';

// incluir sesion
include_once './api/user/probar.php';

// Coneccion a la base
$database = new Database();
$db = $database->getConnection();
$table_name = "files";

// query to insert record
$query = "SELECT
			`filename`
        FROM
			" . $table_name . " 
        WHERE
			id_usuario=:id_usuario";
    
// prepare query
$stmt = $db->prepare($query);

// bind values
$id_usuario = $_SESSION['id'];
$stmt->bindParam(":id_usuario", $id_usuario);
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
			<form action="./api/file/download_descifrado.php" method="post">
				Seleccione el archivo a descargar:<br><br>
				<table id="archivos">
					<tr>
						<th>Nombre archivo</th>
					</tr>
				<?php
					if($stmt->execute()){
						if($stmt->rowCount() > 0){
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								echo "<tr><td>" . $row['filename'] . "</td></tr>";
							}
						}
						echo "</table>";
					} else {
						echo "</table>";
						die();
					}
				?>
				<input type="text" name="fileToDownload" id="fileToDownload"><br>
				Contrasena:<br><br>
				<input type="text" name="key" id="key"><br>
				<input type="submit" value="Descargar Archivo" name="submit"><br>
			</form>
			<?php echo "<a href='http://$WEBSERVER/api/user/panelSesion.php'>Volver</a><br>"; ?>
		</div>
	</div>
	</body>
</html>