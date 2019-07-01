<?php  
	//valida al usuario
	include_once 'probar.php';
	//se elimina la cookie
	setcookie('remember', "", time()-3600, '/');
	//se elimina la sesion
	session_destroy();
	//el usuario es redirigido a la pantalla principal
	header("Location:../../../index.php");

?>