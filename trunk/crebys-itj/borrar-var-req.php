<?php
	// Iniciamos el manejo de variables de session 
	session_start();

	// Declaramos arreglo para respaldar $_SESSION
	$res_session=array();
	
	// Inicializamos el arreglo $res_session con los valores de $_SESSION
	$res_session=$_SESSION;
	
	// Ciclo para borrar las variables de session innesesarias
	foreach($res_session as $key => $value){
		// Verificamos que las variables de session 
		// inicien con 'cant-sol-' pues estas
		// guardan los valores de las variables
		// que se utilizaron para respaldar en la
		// elaboración de requisiciones
		if(substr($key,0,9)=='cant-sol-'){
			// Respaldamos el Id_Insumo
			$id_insumo=substr($key,9,strlen($key)-9);
			// Eliminamos la variable de sesion 
			// con insumo $id_insumo
			unset($_SESSION['cant-sol-'.$id_insumo.'']);
			//echo $key."<br>";
		}
	}
	
	// Redireccionamos a requisiciones.php
	header("location= requisiciones.php");
		
?>