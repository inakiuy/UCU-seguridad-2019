<?php

// incluir configuracion del sitio
include_once '../config/inc_config.php';

// incluir las funciones de firmado
include_once './firma.php';



$target_dir = "../../documentos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file_f = $target_dir . basename($_FILES["fileToUpload_firma"]["name"]);
$target_file_kp = $target_dir . basename($_FILES["fileToUpload_key_publica"]["name"]);
$tmp_filename = $_FILES["fileToUpload"]["tmp_name"];
$tmp_filename_f = $_FILES["fileToUpload_firma"]["tmp_name"];
$tmp_filename_kp = $_FILES["fileToUpload_key_publica"]["tmp_name"];
$verificadoOk = 1;

// Insertar link para volver
echo "<a href='http://$WEBSERVER/firmado.php'>Volver</a><br>";

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo 'Lo sentimos, su archivo es muy grande (Posible filtrado de informacion de configuracion de PHP)<br>';
    $verificadoOk = 0;
}

print_r("PASO 1 - Antes de verificar!");print_r("<br />");
print_r("PASO 1.1 Archivo: $target_file");print_r("<br />");
print_r("PASO 1.2 Firma: $target_file_f");print_r("<br />");
print_r("PASO 1.3 Llave pública: $target_file_kp");print_r("<br />");
// Verificar
$verificadoOk = Verify($tmp_filename, $tmp_filename_f, $tmp_filename_kp );

// Check if $uploadOk is set to 0 by an error
if ($verificadoOk == 0) {
    echo 'Ocurrio un problema al verificar la firmar.<br>';
} else {
	echo 'Verificado de firma OK!<br>';
}
?>