<?php  
	//esto debe ir siempre que se manejen sesiones
	session_start();
	//esto es para ocultar errores al programador
	error_reporting(0);

	//se valida si se esta accediendo dentro de una sesion
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion = ''){
		echo 'Usted no tiene autorizacion';
		//elimina lo que sigue
		die();
	}

	//se elimina la sesion
	session_destroy();
	//es redirigido
	header("Location:../../../index.html");

?>