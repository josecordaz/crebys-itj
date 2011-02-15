<?php

	$keyanterior="639";
	$key="74638hue";
	$accion="50";
	
	$cadena1=$key+0;
	$cadena2=$keyanterior+0;
	
	$sub1=substr($cadena1,strlen($accion),strlen($cadena1)-strlen($accion));

	if($keyanterior==$sub1)	
		echo "es de la misma";
	else 
		echo "no es de la misma"; 
?>