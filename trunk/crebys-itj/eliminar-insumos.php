<?php
	// Inicamos la sesion
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
	
	// Proceso de eliminación
	
	if($_POST['eliminar']=="Eliminar"){
		$partida=0;
			do{
				$partida=current($_POST);
				// Eliminamos
				$proc->eliminarInsumo(key($_POST));
			} while(next($_POST));
			
			// Redireccionamos
			header("location: http://$host$uri/lista-insumos.php?cap=".substr($partida,0,1)."#".$partida."");
	}else{
		// Aquí modifica
		$id_insumo=0;
		do{
			$id_insumo=key($_POST);
			break;
		}while(next($_POST));
		// Redireccionamos
		header("location: http://$host$uri/insumo.php?mod=1&id_insumo=".$id_insumo."#pe");
	}
?>