<?php
	// Iniciamos el manejo de variables de session 
	session_start();
	
	if(count($_GET)==1){
		if(isset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo'])){
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo']);
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'un_medida']);			 
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant1']);
			unset($_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'cant2']);
		}
		else
			$_SESSION["".$_SESSION['accion-cargar']."".$_GET["id_insumo"].'id_insumo']=$_GET['id_insumo'];
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
	
	if(isset($_SESSION['cap']))
		header("location:cargar-insumos-poa.php?cap=".$_SESSION['cap']);
	else
		header("location:cargar-insumos-poa.php");
?>