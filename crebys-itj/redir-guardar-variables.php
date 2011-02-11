<?php
	// Iniciamos el manejo de variables de session 
	session_start();
	
	// Borramos a Creamos la variable de session
	if(count($_GET)==1){
		// Si ya existe la borramos
		if(isset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo'])){
			//echo "Borramos";
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo']);
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'un_medida']);			 
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant1']);
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant2']);
		// Si no la creamos
		}else{
			//echo "Creamos session[".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo'."]";
			$_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo']=$_GET['id_insumo'];
		}
	// Guardamos los datos recividos
	}else{
		if(isset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo'])){
			if(isset($_GET['Un_Medida']))
				$_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'un_medida']=$_GET['Un_Medida'];
			if(isset($_GET['cant1']))
				$_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant1']=$_GET['cant1'];		
			if(isset($_GET['cant2']))
				$_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant2']=$_GET['cant2'];
		}
	}
	/*echo "primer parametro:=["."".$_SESSION['accion-cargar']."]<br>";
	echo "segundo parametro:=["."".$_GET["id_insumo"]."]<br>";
	echo "tercero parametro:=[".'id_insumo'."]<br>";*/
	
	krsort($_SESSION);
	
	if(isset($_SESSION['cap']))
		header("location:cargar-insumos-poa.php?cap=".$_SESSION['cap']."#".$_GET['id_insumo']);
	else
		header("location:cargar-insumos-poa.php#".$_GET['id_insumo']."");
?>