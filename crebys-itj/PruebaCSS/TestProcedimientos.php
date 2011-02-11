<?php
	
	//Incluimos las clases que vamos 
	//a utilizar
	include_once '../includes/Procedimientos.php';
	include_once '../includes/Base_de_Datos.php';
	
	//Inicializamos conexión a la 
	//base de datos
	$conexion=new Base_de_datos('localhost','root','','crebys-itj');
	
	//Inicializamos la clase
	//de procedimientos
	$procedimiento=new Procedimientos($conexion);
	
	//Probamos los procedimientos
	$arreglo=$procedimiento->calcularTotal('sonykarl');
	
	$total=0;
	for($i=0;$i<count($arreglo);$i++)
		$total+=$arreglo[$i][0]*$arreglo[$i][1];
		
	echo "Total:=[".$procedimiento->convertirFMoneda($total)."]";
	
	?>