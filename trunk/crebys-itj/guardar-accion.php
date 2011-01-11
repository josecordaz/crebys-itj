<?php

// Iniciamos el manejo de sesiones
session_start();

// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	

// Verificamos que existan las variables necesarias
if(isset($_POST['cancelar']) and $_POST['cancelar']='cancelar')
	header("Location: http://$host$uri/meta-accion.php");	
	
if(isset($_POST['textarea'])){
	if(isset($_SESSION['meta'])){
		// Libreria para la utilización de procedimientos
		include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	
		// Objeto para la manipulación de procedimientos
		$proc=new Procedimientos();
		
		// Guardamos la accion
		/*
		echo "Meta:=[".$_SESSION['meta']."]";
		echo "<br>";
		echo "Numero de Accion de la meta:=[".$_SESSION['nummeta']."]";
		echo "<br>";
		echo "Descripción:=[".$_POST['textarea'].".]";
		*/
		
		$proc->guardarAccion($_SESSION['meta'],$_SESSION['nummeta'],$_POST['textarea']);
		//echo "contulta:=[".$_SESSION['consulta']."]";
		// Salimos 
		header("Location: http://$host$uri/meta-accion.php");
	}else{
		header("Location: http://$host$uri/login.php");		
		}
}else{
	header("Location: http://$host$uri/login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
</body>
</html>