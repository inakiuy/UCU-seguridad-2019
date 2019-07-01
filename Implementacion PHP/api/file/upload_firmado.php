<?php

// incluir configuracion del sitio
include_once '../config/inc_config.php';

// incluir las funciones de firmado
include_once './firma.php';



$target_dir = "../../documentos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$tmp_filename = $_FILES["fileToUpload"]["tmp_name"];
$firmadoOk = 1;

// Insertar link para volver
echo "<a href='http://$WEBSERVER/firmado.html'>Volver</a><br>";

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

print_r("PASO 1 - Antes de firmar!");print_r("<br />");
print_r("PASO 1.1 $target_file");print_r("<br />");
// Firmar
$firmadoOk = Signature($tmp_filename, $target_dir );


// Check if $uploadOk is set to 0 by an error
if ($firmadoOk == 0) {
    echo 'Ocurrio un problema al firmar el archivo.<br>';
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