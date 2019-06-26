<?php  
	//valida al usuario
	include_once 'probar.php';
	//se elimina la sesion
	session_destroy();
	//es redirigido
	header("Location:../../../index.html");

?>