<?php
// incluir configuracion del sitio
include_once '../config/inc_config.php';

$target_dir = "../../documentos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Insertar link para volver
echo "<a href='http://$WEBSERVER/firma.html'>Volver</a><br>";

// Check if file already exists
if (file_exists($target_file)) {
    echo 'Lo sentimos, el archivo ya existe (Posible enumeracion de archivos).<br>';
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo 'Lo sentimos, su archivo es muy grande (Posible filtrado de informacion de configuracion de PHP)<br>';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo 'Ocurrio un problema al cifrar su archivo.<br>';
// if everything is ok, try to upload file
} else {
	echo '<pre>';

	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido cifrado y almacenado en nuestros servidores.<br>";
    } else {
        echo "Lo siento, ha ocurrido un error al cifrar tu archivo.<br>";
    }
	echo "Más información de depuración:<br>";
	print_r($_FILES);

	print '</pre>';
}
?>