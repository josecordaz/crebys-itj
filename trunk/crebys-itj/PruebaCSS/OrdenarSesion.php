<?php
	// Iniciamos el manejo de variables de session
	session_start();

	$arr= array("hola"=>"mundo",
				"helo"=>"moto",
				"mira"=>"tu");
	
	krsort($arr);
	
	echo "<p>Primera<p>";
	do{
		echo "SESSION[".key($arr)."]:=".current($arr)."<br>";
	}while(next($arr));
	
	$arr['oh']="si";
	
	reset($arr);
	krsort($arr);
	
	echo "<p>Segunda<p>";
	do{
		echo "SESSION[".key($arr)."]:=".current($arr)."<br>";
	}while(next($arr));
	
	reset($arr);
	krsort($arr);
	
	echo "<p>Tercera<p>";
	do{
		echo "SESSION[".key($arr)."]:=".current($arr)."<br>";
	}while(next($arr));
	
?>