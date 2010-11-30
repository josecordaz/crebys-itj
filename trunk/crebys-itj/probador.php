<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin tÃ­tulo</title>
</head>
<?php

	$cadena="José Carlos Ordaz Criaáéíóúzantúós";
	
	/*for ($i=0;$i<strlen($cadena);$i++)
		echo substr($cadena, $i,1)."[".ord(substr($cadena, $i,1))."]-<br>";
	echo "<p>";*/
		
	$longitud=100;
	
	$patron="(^([a-zA-Z]|é|á|í|ó|ú)([^\S][a-zA-Z]|[a-zA-Z]|[é|á|í|ó|ú])*$)";
	
	//$patron="^é";
	
	//echo "ereg:=[".ereg($patron, $cadena)."]<br>";
	
	if(ereg($patron, $cadena))
		if(strlen($cadena)<=$longitud)
			echo "True";
		else
			echo "False";
	else
		echo "False";

?>
<body>
</body>
</html>