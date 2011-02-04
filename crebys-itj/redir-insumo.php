<?php
// Libreria para la utilización de procedimientos
include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
// Libreria para la utilización de procedimientos
include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Validar.php');

	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// Objeto para la manipulación de procedimientos
$proc=new Procedimientos();

// Objeto para validar entradas
$val=new Validar();

//  Iniciamos la sesión
session_start();

// Guardamos lo contenido en el selector partida
if(isset($_GET['partida'])){
	$_SESSION['partida']=$_GET['partida'];
}
// Guardamos lo contenido en el selector nombre
if(isset($_GET['nombre'])){
//	echo "me llegó nombre:=[".$_GET['nombre']."]<br>";
	$_SESSION['nombre']=$_GET['nombre'];
	//echo "session[nombre]:=[".$_SESSION['nombre']."]";
}
// Guardamos lo contenido en el selector medida
if(isset($_GET['medida'])){
	$_SESSION['medida']=$_GET['medida'];
}

// Guardamos lo contenido en el input precio
if(isset($_GET['precio'])){
	$_SESSION['precio']=$_GET['precio'];
}

// Guardamos lo contenido en el selector medida cuando agregamos
if(isset($_POST['medidaname'])){
	// Validamos que la entrada sea correcta
	if($val->validarCadena2($_POST['medidaname'],$proc->sacarLongitud("Insumos", "In_Nombre"))){
		$_SESSION['medida']=$_POST['medidaname'];
		$proc->agregarMedida($_POST['medidaname']);
	}else{
		// Creamos la cookie del error
		setcookie("error","Entrada no v&aacute;lida",time()+20);
		// Cookie con la cadena
		setcookie("medida",$_POST['medidaname'],time()+20);
		// Redireccionamos a unidad_m.php
		header("Location: http://$host$uri/unidad_m.php");
		exit();
	}
}

// Redireccionamos a insumo.php
	header("Location: http://$host$uri/insumo.php");
?>
