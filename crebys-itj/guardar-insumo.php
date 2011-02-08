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
	if(!isset($_SESSION['mod'])){
		$val=$proc->insInsumo($_SESSION['nombre'],$_SESSION['precio'],$proc->devolverIdUnidadM($_SESSION['medida']),$_SESSION['partida']);
	}
	else{
		//echo "session nombre:=[".$_SESSION['nombre']."]";
		$arreglo=array($_SESSION['id_insumo'],"".$_SESSION['nombre'],$_SESSION['precio'],$_SESSION['medida'],$_SESSION['partida']);
		$val=$proc->modInsumo($arreglo);
	}
	// Validamos
	if($val!=1){
		// Establecemos el error en una cokkie
		//echo $proc->devError();
		//echo $_SESSION['consulta'];
		setcookie("error",$proc->devError(), time()+20);
		// Redireccionamos a insumo.php para mostrar el error
		header("Location: http://$host$uri/insumo.php");
	}else{
		if(isset($_SESSION['mod'])){
			unset($_SESSION['mod']);
			header("Location: http://$host$uri/lista-insumos.php?cap=".$_SESSION['cap']."#".$_SESSION['id_insumo']."");
		}else{
			$datoInsumo=$proc->devIdInsumo($_SESSION['nombre']);
			header("Location: http://$host$uri/lista-insumos.php?cap=".substr($_SESSION['partida'],0,1)."#".$datoInsumo."");
		}
	}
	
?>
