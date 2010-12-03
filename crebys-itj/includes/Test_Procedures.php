<?php
	// Libreria para procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	// Libreria para base de datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_Datos.php');

	// Objeto para la conexion para la base de datos
	$conexion=new Base_de_Datos("localhost","root","","crebys-itj");

	// Objeto para procedimientos
	$proc=new Procedimientos($conexion);
	
	// Probamos procedimientos insUsuario
	if(!$proc->insUsuario(123,"dsdfsdffd","Jose Carlos","Ordaz","Crizantos","sonykarl"))
		echo $proc->mostrarError();
?>