<?php
	
	//Incluimos las clases que vamos 
	//a utilizar
	include_once 'includes/Procedimientos.php';
	include_once 'includes/Base_de_Datos.php';
	
	//Inicializamos conexión a la 
	//base de datos
	$conexion=new Base_de_datos('localhost','root','','crebys-itj');
	
	//Inicializamos la clase
	//de procedimientos
	$procedimiento=new Procedimientos($conexion);
	
	//Probamos los procedimientos
	$procedimiento->modProcEst(60,"Vinculacion");
	echo $procedimiento->mostrarError();
		
	//Terminamos la conexión
	$conexion->desconectar();
	

	
	?>