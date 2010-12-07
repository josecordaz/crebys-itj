<?php
	
	// Iniciamos el manejo de variables de session
	session_start();
	
	// Eliminamos la variable de sesion	
	unset($_SESSION['nick']);
	
	// Establecemos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
	// Redireccionamos al login para iniciar sesion
	header("Location: http://$host$uri/login.php");
	
?>

