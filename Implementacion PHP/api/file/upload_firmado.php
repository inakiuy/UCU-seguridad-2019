<?php
// incluir configuracion del sitio
include_once '../config/inc_config.php';

// incluir las funciones de firmado
include_once './firma.php';

$target_dir = "../../documentos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$firmadoOk = 1;

// Insertar link para volver
echo "<a href='http://$WEBSERVER/firma.html'>Volver</a><br>";

// Check if file already exists
if (file_exists($target_file)) {
    echo 'Lo sentimos, el archivo ya existe (Posible enumeracion de archivos).<br>';
    $firmadoOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo 'Lo sentimos, su archivo es muy grande (Posible filtrado de informacion de configuracion de PHP)<br>';
    $firmadoOk = 0;
}

// Firmar
signature($target_file, "password");


// Check if $uploadOk is set to 0 by an error
if ($firmadoOk == 0) {
    echo 'Ocurrio un problema al cifrar su archivo.<br>';
// if everything is ok, try to upload file
} else {
	echo '<pre>';

	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido firmado y almacenado en nuestros servidores.<br>";
    } else {
        echo "Lo siento, ha ocurrido un error al firmar tu archivo.<br>";
    }
	echo "Más información de depuración:<br>";
	print_r($_FILES);

	print '</pre>';
}
?>