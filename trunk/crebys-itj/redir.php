<?php
	

	// Página que nos ayudará a redireccionar según el usuario
	// que inicie sesión
	
	/* Tabla de redireccionamiento
	
		Nombre del usuario					Página
		
		[+] Administrador 					admin.php
		[+] Jefe de departamento			jefe.php
		[+] Secretaria de departamento		secretaria.php
	*/
	
	// Libreria para la facilitacion de validaciones
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	// Libreria para el manejo de la Base de Datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_Datos.php');
	// Objeto de la clase para redireccionar
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/pagina.php');
	
	// Iniciamos la sesión
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor :=[localhost]
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta :=[/crebys-itj]
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	// Creamos objeto para redireccionar
	$pagina=new pagina($host,$uri);
	
	// Verificamos si se accedió directamente a este archivo
	if(!isset($_POST['usuario'])&&!isset($_POST['password'])&&!isset($_SESSION['nick'])){
		// Redireccionamos a login
		//echo "3<br>";
		echo $pagina->redir("login.php");
		//header($pagina->redir("login.php"));
		echo "4";
		// Terminamos la ejecución
		exit;		
		echo "5";
		// Se accedió de buen modo
	} else{
		// Verificamos si viene de login.php
		if(isset($_POST['usuario'])){
			// Creamos objeto de base de datos
			$conexion=new Base_de_Datos($host,"root","","crebys-itj");
			// Creamos objeto para manejar procedimientos
			$proc=new Procedimientos($conexion);
			// Verificamos el nombre de usuario
			switch($_POST['usuario']){
				// Caso de administración
				case "admin":
					if($proc->iniciarSesion($_POST['usuario'],$_POST['password'])){
						// Guardamos el nick como variable de sesión
						$_SESSION['nick']=$_POST['usuario'];
						// Redireccionamos a admin
						$pagina->redir("admin.php");
					}else
						$pagina->redir("login.php");
				// Case de los jefes de departamento
				case "jefe":
					// usuario.php
					$pagina->redir("usuario.php");
			}
		}
	}
	

?>