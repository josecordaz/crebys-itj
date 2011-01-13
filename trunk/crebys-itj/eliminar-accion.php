<?php
	// Inicamos la sesion
	session_start();
	
	// Libreria para utilizar procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	// Si no existe la variable de sesión redir
	if(!isset($_SESSION['nick'])){
		// Redireccionamos a login.php
		header("Location: http://$host$uri/login.php");
	}
	
	// Creamos objeto de procedimientos
	$proc=new Procedimientos();
	
	if(isset($_POST['raccion']))
	  	echo "Se procederá a eliminar la acción[".$_POST['raccion']."] de la meta[".$_SESSION['meta']."]";
	else 
		echo "No existe la variable";

?>

