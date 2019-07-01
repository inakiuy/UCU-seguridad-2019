<?php
// get database connection
include_once '../config/database.php';

// incluir configuracion del sitio
include_once '../config/inc_config.php';

// incluir las funciones de cifrado y descifrado
include_once './crypto.php';

// incluir sesion
include_once 'api/user/probar.php';

// Coneccion a la base
$database = new Database();
$db = $database->getConnection();
$table_name = "files";

// Seteo de variables
$target_dir = "../../uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$tmp_filename = $_FILES['fileToUpload']['tmp_name'];
$password = $_POST['key'];
$status = 1;

// Insertar link para volver
echo "<a href='http://$WEBSERVER/cifrado.html'>Volver</a><br>";

// Cifrar
$status = encrypt($tmp_filename, $password);

// Check if $uploadOk is set to 0 by an error
if ($status == 0) {
    echo 'Ocurrio un problema al cifrar su archivo.<br>';
// Si todo esta bien, mover el archivo del temp a la ubicacion final
} else {
	echo '<pre>';

	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
		//Luego de mover el archivo inserto los datos en la tabla files
		// query to insert record
        $query = "INSERT INTO
                    " . $table_name . "
                SET
                    id_usuario=:id_usuario, filename=:filename, serverpath=:serverpath";
    
        // prepare query
        $stmt = $db->prepare($query);
		
		// bind values
		$id_usuario = 1;
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":filename", $_FILES['fileToUpload']['name']);
        $stmt->bindParam(":serverpath", $target_file);
		
		if($stmt->execute()){
            echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido cifrado y almacenado en nuestros servidores.<br>";
		} else {
			echo "Lo siento, ha ocurrido un error al cifrar tu archivo (error 1).<br>";
		}
        
    } else {
        echo "Lo siento, ha ocurrido un error al cifrar tu archivo.<br>";
    }
	echo "Más información de depuración:<br>";
	print_r($_FILES);

	print '</pre>';
}
?>