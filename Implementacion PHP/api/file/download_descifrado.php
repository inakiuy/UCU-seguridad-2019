<?php
// get database connection
include_once '../config/database.php';

// incluir las funciones de cifrado y descifrado
include_once './crypto.php';

// Coneccion a la base
$database = new Database();
$db = $database->getConnection();
$table_name = "files";

// Seteo de variables
$target_dir = "../../uploads/";
$target_file = $target_dir . $_POST["fileToDownload"];
$password = $_POST['key'];
$status = 1;

// Descifrar
if(!file_exists($target_file)){ // no existe el archivo
	$status = 0;
    die('Archivo no encontrado');
} else {
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=" . basename($target_file));
	header("Content-Transfer-Encoding: binary");
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    flush(); // Flush system output buffer
	
	$fileData = decrypt($target_file, $password);
    // leer el archivo de la memoria
    echo($fileData);
}
?>