<?php
	// Página que nos ayudará a redireccionar según el usuario
	// que inicie sesión
	
	/* Tabla de redireccionamiento
	
		Nombre del usuario					Página
		
		[+] Administrador 					admin.php
		[+] Jefe de departamento			jefe.php
		[+] Secretaria de departamento		secretaria.php
	*/
	
	// Libreria para la utilización de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	
	// Iniciamos la sesión
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor :=[localhost]
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta :=[/crebys-itj]
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	// Creamos objeto para redireccionar
	
	// Verificamos si se accedió directamente a este archivo
	if(!isset($_POST['usuario'])){
		// Mostramos en login.php el error de acceso
		setcookie("error","Escriba su nombre de usuario y contraseña", time()+20);
		// Redireccionamos a login
		header("Location: http://$host$uri/login.php");
		// Terminamos la ejecución
		exit;		
		// Se accedió de buen modo
	} else{
		// Creamos objeto de base de datos
		$proc=new Procedimientos();

		// Validamos los datos del usuario
		$res=$proc->iniciarSesion($_POST['usuario'],$_POST['password']);
		// Si se puede iniciarsesion
		if($res===true){
			// Verificamos el nombre de usuario
			switch($proc->saberTipoUsuario($_POST['usuario'])){
				// Caso de administración
				case "Administrador":
					// Guardamos el nick como variable de sesión
					$_SESSION['nick']=$_POST['usuario'];
					// Redireccionamos a admin
					header("Location: http://$host$uri/admin.php");
					// Terminamos la ejecucion
					exit;

				// Case de los jefes de departamento												
				case "Jefe":
					// Guardamos el nick como variable de sesión
					$_SESSION['nick']=$_POST['usuario'];
					// jefe.php
					header("Location: http://$host$uri/jefe.php");
					// Terminamos la ejecucion
					exit;
			}
		}else{
			// Mostramos en login.php el error de acceso
			setcookie("error",$res, time()+20);
			// Redireccionamos a login
			header("Location: http://$host$uri/login.php");
			// Terminamos la ejecución
			exit;
		}		
	}
?>