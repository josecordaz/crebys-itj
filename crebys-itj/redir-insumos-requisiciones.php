4
<?php
	// Inicializamos el manejo de variables de session
	session_start();
	
		// Declaramos un arreglo
		$arrsd=array();
		$arrpost=array();
		
		// Copiamos los datos del arreglo
		$arrsd=$_SESSION;
		$arrpost=$_POST;
		
		echo "POST<br>";
		foreach($_POST as $key => $value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		}
		echo "<br>GET<br>";
		foreach($_GET as $key => $value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		}
		echo "<br>SESSION<br>";
		foreach($_SESSION as $key => $value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		}

		//echo "<p>";
		
		// Recorremos el arreglo de POST
		foreach($arrspost as $post_key => $post_value){
			// Si $post_key es la variable del checkbox del insumo
			// 	Entonces continuamos con el proceso
			if((substr($post_key,0,9)=='cont-sel-')&&$post_value='on'){
				// Respaldamos el índice de este insumo
				$Id_Insumo_POST=substr($post_key,9,strlen($post_key)-9);
				// creamos la variable de session 
				// de la cantidad de este insumo
				$_SESSION['cont-sel-'.$Id_Insumo_POST]=$post_value;
			}
				// Eliminamos la variable de sessión 
		}
		//echo "Esto para la accion ".$_GET['accion']." de la meta ".$_GET['meta'];
		
	// Verificamos si esta página fue llamada por el boton envier o por los enlaces 
	// en los titulos de capitulo de la pagina insumos-requisiciones.php
	// Para ello checamos el valor del boton enviar para saber si fue pulsado
	// o no
	
			echo "<br>SESSION<br>";
		foreach($_SESSION as $key => $value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		}

	if(isset($_POST['enviar'])){
		// Si es así, redireccionamos a la pagina que 
		// gardará en la base de datos los insumos 
		// solicitados
		header("location: guardar-requisicion.php?meta=".$_POST['meta']."&accion=".$_POST['accion']);
	}else{
		// De lo contrario
		// Redireccionamos a la pagina de insumos-requisiciones con los datos de entrada
		header("location: insumos-requisiciones.php?meta=".$_POST['meta']."&accion=".$_POST['accion']."&cap=".$_POST['cap']."#pa");
	}
			 exit();


?>
