<?php

	// Librería para Procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	// Objeto 
	$proc=new Procedimientos();
	
	$acciones=array();
	
	$acciones=$proc->devolverAcciones(1);
	
	echo count($acciones);

?>