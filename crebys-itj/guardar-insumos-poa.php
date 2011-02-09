<?php
	// Iniciamos el uso de variables de session
	session_start();
	
	// Librería para manipulación de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
		
//Guardar los insumos seleccionados en cargar-insumos-poa.php
	
	// Inicializamos el indice de los arreglos
	krsort($_SESSION);
	
	$i=0;	
	do{
		// Aquí solo guardaremos las variables de session que tengan el formato de Accion-Insumo-Cantidad
		if(substr(key($_SESSION),0,strlen($_SESSION['accion-cargar']))==$_SESSION['accion-cargar']){
			//Si ban es igual a false significa que ya se habia guardado el insumo
			if(ban){
				$insumos[$i]=current($_SESSION);
				echo key($_SESSION)."=".current($_SESSION)."<br>";
			}
			next($_SESSION);
			$ban=true;
			
			$cantidades[$i]=current($_SESSION);
			echo key($_SESSION)."=".current($_SESSION)."<br>";
			next($_SESSION);
			
			//Guardamos los primero digitos del insumo que se guardo al principio del if(sbrtr
			$comp=$_SESSION['accion-cargar'].$insumos[$i];
			
			//Si entra aquí significa que solo tiene una cantidad y por lo tanto current session actul tiene el siguiente insumo
			if($comp!=substr(key($_SESSION),0,strlen($comp))){
				$insumos[$i+1]=current($_SESSION);
				$ban=false;
			}
						
				$cantidades[$i]+=current($_SESSION);
				echo key($_SESSION)."=".current($_SESSION)."<br>";
			//next($_SESSION);
			$i++;
		}
	}while(next($_SESSION));
	
	/*rsort($insumos);
	
	for($i=0;$i<count($insumos);$i++)
		echo $insumos[$i]."<br>";*/
	
	// Ejecutamos el procedimiento para saber el Id_Insumo_Accion
	//$error=$proc->guardarInsumosPOA($_SESSION['accion-cargar'],$insumos,$cantidades);
	
	// Redireccionamos a poa.php
	//header('location: poa.php#pe')

?>