<?php
// Libreria para la utilización de procedimientos
include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

// Objeto para la manipulación de procedimientos
$proc=new Procedimientos();

//  Iniciamos la sesión
session_start();

// Guardamos el nombre del servidor :=[localhost]
$host  = $_SERVER['HTTP_HOST'];
// Guardamos la carpeta :=[/crebys-itj]
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if(isset($_GET['proc-est'])){
	$_SESSION['proc-est']=$_GET['proc-est'];
	header("Location: http://$host$uri/meta.php");
}else{
	// Si se presiono el boton guardar de meta.php
	
	
	// Si se a aceptado el botón de aceptar
	if(isset($_POST['agregar'])){
		$error=$proc->agregarMeta($_POST['proc-clav'],$_POST['descrip-meta'],$_POST['unidad-m'],$_POST['cantidadmeta']);
		if($error===true){
			$id_meta=$proc->devIdMeta($_POST['descrip-meta']);
			$id_proc_est=$_SESSION['proc-est'];
			unset($_SESSION['proc-est']);
			unset($_SESSION['proc-clave']);
			unset($_SESSION['unidad-meta']);
			unset($_SESSION['cantidad-meta']);
			unset($_SESSION['desc-meta']);
			header("Location: http://$host$uri/meta-accion.php?meta=$id_meta&proc-est=$id_proc_est");
		}else{
			// Guardamos lo contenido en el selector de Proceso Estratégico
				$_SESSION['proc-est']=$_POST['proc-estr'];
			// Guardamos lo contenido en el selector de Proceso Clave
				$_SESSION['proc-clave']=$_POST['proc-clav'];
			// Guardamos lo contenido en el cuadro de texto Unidad de Medida
				$_SESSION['unidad-meta']=$_POST['unidad-m'];
			// Guardamos lo contenido en el cuadro de texto Cantidad
				$_SESSION['cantidad-meta']=$_POST['cantidadmeta'];
			// Guardamos la descripción de la meta
				$_SESSION['desc-meta']=$_POST['descrip-meta'];
			setcookie("error",$error,time()+20);
			header("Location: http://$host$uri/meta.php#pe");
		}
	}elseif(isset($_POST['guardar'])){
		$proc->modMeta($_SESSION['meta'],$_POST['proc-clav'],$_POST['descrip-meta'],$_POST['unidad-m'],$_POST['cantidadmeta']);
		//echo $_SESSION['consulta'];
		unset($_SESSION['proc-clave']);
		header("Location: http://$host$uri/meta-accion.php?proc-est=".$_SESSION['proc-est']."&meta=".$_SESSION['meta']."#pe");
	}else
		header("Location: http://$host$uri/meta-accion.php");
}	
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