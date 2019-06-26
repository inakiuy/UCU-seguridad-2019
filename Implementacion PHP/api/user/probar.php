<?php
	//se necesita iniciar la sesion cuando el acceso es para un usuario unicamente
	session_start();
	//esto es para ocultar errores al programador
	error_reporting(0);

	//para que solamente se vea por el usuario iniciado
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion = ''){
		echo 'usted no tiene autorizacion';
		die();
	}
?>