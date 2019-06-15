<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
// set ID property of user to be loged in
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();
// read the details of user to be loged in
$stmt = $user->login();

if($stmt->rowCount() > 0){
    // get retrieved row
    //fetch devuelve la siguiente fila del resultado de la query en la que se accede al contenido con los nombres de las columnas en lugar de indice
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($user->password, $row['password'])){
        // create array
        $user_arr=array(
            "status" => true,
            "message" => "Successfully Login!",
            "id" => $row['id'],
            "username" => $row['username']
        );
    }
    else{
        $user_arr=array(
            "status" => false,
            "message" => "Invalid Username or Password!",
        );
    }
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username",
    );
}

// Imprimir en el cuerpo de la respuesta el array del status en formato json
// make it json format
print_r(json_encode($user_arr));
?>