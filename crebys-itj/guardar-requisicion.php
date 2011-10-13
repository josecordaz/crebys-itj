<?php
	// Iniciamos el manejo de variables de session
	session_start();
	
	// Meta
	echo "Meta:=".$_GET['meta']."<br>";
	
	// Accion
	echo "Accion:=".$_GET['accion']."<br>";
	
	// Insumos y Cantidades
	$res_session=$_SESSION;
	echo "<p>";
	foreach($res_session as $key => $value)
		if(substr($key,0,9)=='cant-sol-')
			echo "Insumo[".substr($key,9,strlen($key)-9)."]=-=- ".$value."<br>";
	
	echo "<br>".$_SESSION['des-req'];
?>