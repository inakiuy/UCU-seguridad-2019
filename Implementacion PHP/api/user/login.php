<?php

//inclusion de archivos
include_once '../config/database.php';
include_once '../objects/user.php';

//clave generada por 
$SECRET_KEY = "a231ab06e3e17eb3767ad4960c239ec7177df0d8f81a296ff5f745159a2275b071fce23238f6f840b8b27cfe623c74e8bcb6adb4840574e8698e98a83b5e08bc3fd4d3b9f4222681b7ca1c4ca74bf08d02a7f16097b5a6df8af2f45eecfcf13b82059089a4b9c5d801e3f4910bfd768ce5eda9e748ee6583004edd0162d4499a";

function fetchTokenByUserName($id_usuario){

    //busco en la bd "cookies" el token dado este indice
    $table_name2 = "cookies";
    $database = new Database();
    $db = $database->getConnection();
    $query = "SELECT
                    `token`
                FROM
                    " . $table_name2 . " 
                WHERE
                    id_usuario='".$id_usuario."'"; 

    // prepare query statement
    $stmt = $db->prepare($query);

    // execute query
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    $res = $row[0];
    return $res;
}

function recuerdo() {
    $cookie = isset($_COOKIE['remember']) ? $_COOKIE['remember'] : '';
    if ($cookie) {
        list ($id, $token, $mac) = explode(':', $cookie);
        //se chequea si la cookie fue alterada
        $variable = hash_hmac('sha256', $id . ':' . $token, $SECRET_KEY);
        
        if (!hash_equals(strval( $variable ) , $mac)) {
            return false;
        }
        //se chequea si el token coincide con el almacenado en la bd
        $usertoken = fetchTokenByUserName($id); 
        if (hash_equals(strval($usertoken) , $token)) {
            header("Location:panelSesion.php");
            return true;
        }
    }
}

//se chequea si se debe recordar al usuario
if(recuerdo()){
    die();
}

//configuracion bd
$database = new Database();
$db = $database->getConnection();
$table_name = "users";
$table_name2 = "cookies";
$user = new User($db);

//lo que ingresa el usuario
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

$stmt = $user->login();

if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($user->password, $row['password'])){

        //se inicia la sesion
        session_start();
        $_SESSION['usuario'] = $user->username;
		$_SESSION['id'] = $user->id;
        
		//el usuario quiere ser recordado
        if(!empty($_GET['check'])){

            $id = $row['id'];

            //se genera token
            $token = openssl_random_pseudo_bytes(10);
            $token = bin2hex($token);
            
            //chequeo si el usuario tiene token
            $query1 = "SELECT
                        `token`
                    FROM
                        " . $table_name2 . " 
                    WHERE
                        id_usuario='".$id."'";
            $stmt1 = $db->prepare($query1);
            $stmt1->execute();

            //si que hay que actualizar esa fila
            if($stmt1->rowCount() > 0){
                $query3 = "UPDATE " . $table_name2 . "
                            SET token=:token
                            WHERE id_usuario='".$id."'";
                $stmt4 = $db->prepare($query3);
                $stmt4->bindParam(":token", $token);
                $stmt4->execute();
            }
            //si no tiene sesion recordada y hay que crearla
            else{
                $query2 = "INSERT INTO
                            " . $table_name2 . "
                        SET
                            id_usuario=:id_usuario, token=:token";

                $stmt2 = $db->prepare($query2);
                $stmt2->bindParam(":id_usuario", $id);
                $stmt2->bindParam(":token", $token);
                $stmt2->execute();
            }

            //seteo cookie del usuario
            $cookie = $id . ':' . $token;
            $mac = hash_hmac('sha256', $cookie, $SECRET_KEY, false);
            
            // la cookie queda conformada por id:token:hmac
            $cookie .= ':' . $mac;
            setcookie("remember", $cookie, time()+3600, '/');
        }

        $user_arr=array(
            "status" => true,
            "message" => "Successfully Login!",
            "id" => $row['id'],
            "username" => $row['username']
        );

        header("Location:panelSesion.php");
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

//imprime en el cuerpo de la respuesta el array del status en formato json
print_r(json_encode($user_arr));
?>