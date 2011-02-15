<?php
	// Iniciamos el manejo de variables de session
	session_start();

	// Guardamos algunos datos
	
	$_SESSION['uno']="uno";
	$_SESSION['dos']="dos";
	$_SESSION['tres']="tres";
	$_SESSION['cuatro']="cuatro";
	$_SESSION['cinco']="cinco";
	
	// Ordenamos
	krsort($_SESSION);

	// Mostramos los valores 
	echo "Primera<p>";
	do{
		echo "SESSION['".key($_SESSION)."]:=".current($_SESSION)."']<br>";
	}while(next($_SESSION));
	
		// Ordenamos
//	krsort($_SESSION);
	
	// Agregamos un elemnto más
	$_SESSION['cinco']="cinco";
	
	// Mostramos nuevamente
	echo "Primera<p>";
	do{
		echo "SESSION['".key($_SESSION)."]:=".current($_SESSION)."']<br>";
	}while(next($_SESSION));
?>