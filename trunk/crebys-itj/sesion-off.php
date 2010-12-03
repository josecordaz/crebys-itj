<?php
	
	// Iniciamos el manejo de variables de session
	session_start();
	
	// Eliminamos la variable de sesion	
	unset($_SESSION['nick']);
	
	// Establecemos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	// Guardamos el nombre del archivo
	$extra = 'login.php';
		
	// Redireccionamos al login para iniciar sesion
	header("Location: http://$host$uri/$extra");
	
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