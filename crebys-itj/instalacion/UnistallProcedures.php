<?php
	// Incluimos la libreria para hacer la conexion con la base de datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_datos.php');
	
	// Creamos el objeto para la conexion con crebys-itj
	$conexion=new Base_de_datos("localhost", "root", "", "mysql");
	
	// Ejecutamos la consulta
	$conexion->executeSQL("DELETE FROM proc WHERE db = 'crebys-itj'");
	
	// Guardamos el error si lo hubiera
	$error=$conexion->erroraiz();
	
	// Cerramos la conexión
	$conexion->desconectar();
	
	// Mostramos el resultado de la consulta
	if(strlen($error)!=0)
		echo $error."<br>";
	else
		echo "[+] Procedimientos borrados con éxito<br>";
	

?>