<?php
	// Iniciamos el manejo de sessiones
	session_start();
 
	//echo "Se recivió:=[".$_GET['cip']."]<br>";
	unset($_SESSION['cip-'.$_GET['cip']]);
	
	/*do{
		//echo key($_SESSION)."<br>";
		//echo ":=[";
		$var=key($_SESSION);
		//echo "Se compará [li".$_GET['li']."] con [".$var."]<br>";
		if($var=="cip-".$_GET['cip']){
			unset($_SESSION[$var]);
			header("location: cargar-insumos-poa.php?cap=".$_GET['cap']."");
		}
		//echo "]<br>";
	} while(next($_SESSION));
	*/
	header("location: cargar-insumos-poa.php?cap=".$_GET['cap']."#pe");
?>

