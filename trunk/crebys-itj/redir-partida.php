<?php
	// Iniciamos el manejo de variables de sesión
	session_start();
	
	// Libreria para la utilización de procedimientos y validaciones respectivamente
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	
	// Creamos los objetos coorespondientes a validar y ejecutar procedimientos respectivamente
	$proc=new Procedimientos();

	// Ejecutamos el procedimiento
	// Si hubo error
	if(!($proc->insPartida($_POST['id'],$_POST['nombre']))){
		//echo $_SESSION['consulta'];
		// Creamos la cokkie del error que mostraremos
		setcookie("error",$proc->devError(),time()+20);
		// Redireccionamos a partida.php
		header("location: partida.php");
		// Terminamos la ejecución
		exit();
	}
	// Como no hubo error redireccionamos a lista-insumos.php
	header("location: insumo.php");
	
?>