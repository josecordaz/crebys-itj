<?php
	// Iniciamos el manejo de sessiones
	session_start();
 
	//echo "Se recivió:=[".$_GET['li']."]<br>";
	
	do{
		//echo key($_SESSION)."<br>";
		//echo ":=[";
		$var=key($_SESSION);
		//echo "Se compará [li".$_GET['li']."] con [".$var."]<br>";
		if($var=="li-".$_GET['li']){
			unset($_SESSION["li-".$_GET['li']]);
			header("location: lista-insumos.php?cap=".$_GET['cap']."");
		}
		//echo "]<br>";
	} while(next($_SESSION))
?>

