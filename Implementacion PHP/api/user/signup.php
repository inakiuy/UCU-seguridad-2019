<?php
 
// get database connection
include_once '../config/database.php';

// incluir configuracion del sitio
include_once '../config/inc_config.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// set user property values
$user->username = $_POST['username'];
$user->password = $_POST['password'];
$user->created = date('Y-m-d H:i:s');
 
// create the user
if($user->signup()){
    // Redirect browser 
    header("Location: http://$WEBSERVER/index.html"); 
    exit;    
    /*$user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );*/    
}
else{
    // Redirect browser
    header("Location: http://$WEBSERVER/index.php"); 
    exit;
    /*$user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );*/
}

// Imprimir en el cuerpo de la respuesta el array del status en formato json
// make it json format
print_r(json_encode($user_arr));
?>