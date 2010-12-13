<?php
// Libreria para la utilización de procedimientos
include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

// Objeto para la manipulación de procedimientos
$proc=new Procedimientos();

//  Iniciamos la sesión
session_start();

// Guardamos lo contenido en el selector partida
if(isset($_GET['partida'])){
	$_SESSION['partida']=$_GET['partida'];
}
// Guardamos lo contenido en el selector nombre
if(isset($_GET['nombre'])){
	$_SESSION['nombre']=$_GET['nombre'];
}
// Guardamos lo contenido en el selector medida
if(isset($_GET['medida'])){
	$_SESSION['medida']=$_GET['medida'];
}
// Guardamos lo contenido en el selector medida cuando agregamos
if(isset($_POST['medidaname'])){
	$_SESSION['medida']=$_POST['medidaname'];
	$proc->agregarMedida($_POST['medidaname']);	
}
// Guardamos lo contenido en el input precio
if(isset($_GET['precio'])){
	$_SESSION['precio']=$_GET['precio'];
}

header("location: insumo.php")

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