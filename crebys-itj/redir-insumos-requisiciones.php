<?php
	// Inicializamos el manejo de variables de session
	session_start();

	// Declaramos un arreglo
	$arrsd=array();
	
	// Copiamos los datos del arreglo
	$arrsd=$_SESSION;
	
	// Nos movemos por los elementos del arreglo de session
	foreach($arrsd as $key => $value){
		// Verificamos que la cadena inicial de $key sea 'cant-' pues esta
		// variable contiene la cantidad existente de un insumo
		if(substr($key,0,5)=='cant-'){
			// Le damos el indice del insumo $key a $Id_Insumo_Sesion
			$Id_Insumo_Sesion=substr($key,5,strlen($key)-5);
			// Recorremos los elementos de $_POST
			do{
	 			// Le damos el indice del insumo key($_POST) a $Id_Insumo_POST
				$Id_Insumo_Post=substr(key($_POST),9,strlen(key($_POST))-9);
				// Comprobamos la igualdad de los dos indices
				// Si son iguales significa que el insumo key($_POST) ha sido solicitado
				if($Id_Insumo_Post==$Id_Insumo_Sesion){
					// Comprobamos que las cantidad pedida y existe sea coherentes
					if(current($_POST)>$value){
						// Establecemos la cokkie del error para mostrarlo en insumos-requisiciones.php
						setcookie("error","Se ha solicitado ".current($_POST)." elementos del Insumo[".$_SESSION["insumo-".$Id_Insumo_Post]."] sobrepasando del l&iacute;mite de ".$value." pisponibles", time()+30);
						// Respaldamos el id del insumo sobrepasado para establecer el link del mismo;
						$_SESSION['insumo-pasado']=$Id_Insumo_Post;
						// Redireccionamos a insumos-requisiciones para mostrar el error
						header("location: insumos-requisiciones.php");
						exit();
					}
						//header();
				}
			}while(next($_POST));	
			reset($_POST);
		}
	}
	
	/*foreach($arrsd as $key => $value){
		if(substr($key,0,5)=='cant-')
			unset($_SESSION[$key]);
	}*/
	
	/*foreach($arrsd as $key => $value){
		if(substr($key,0,5)=='cant-')
			echo "$key vale $value <br>";
	}*/

	
	/*do{
		echo "key = ".key($_POST)." valor = ".current($_POST)."<br>";
	}while(next($_POST));
	
	echo "otros<p>";
	
	reset($_POST);
	
	do{
		echo "key = ".key($_POST)." valor = ".current($_POST)."<br>";
	}while(next($_POST));*/
?>
