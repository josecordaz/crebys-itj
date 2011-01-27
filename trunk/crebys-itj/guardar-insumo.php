<?php 
	// Iniciamos manipulación de variables de sesión
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	// Si no existe la variable de sesión redir
	if(!isset($_SESSION['nick'])){
		// Redireccionamos a login.php
		header("Location: http://$host$uri/login.php");
	}
	
	// Libreria para la utilización de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
	
	// Guardamos los datos del insumo
	$val=$proc->insInsumo($_SESSION['nombre'],$_SESSION['precio'],$proc->devolverIdUnidadM($_SESSION['medida']),$_SESSION['partida']);
	
	// Validamos
	
	if($val!=1){
		// Establecemos el error en una cokkie
		setcookie("error",$proc->devError(), time()+20);
		// Redireccionamos a insumo.php para mostrar el error
		header("Location: http://$host$uri/insumo.php");
	}else
		//
	header("Location: http://$host$uri/admin.php");
	
?>
