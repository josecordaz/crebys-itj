<?php
	// Inicializamos el manejo de variables de session
	session_start();
	
	// Declaramos un arreglo
	$arrsd=array();
	$arrpost=array();
	
	// Copiamos los datos del arreglo
	$arrsd=$_SESSION;
	$arrpost=$_POST;
	
	//echo "entro";
	//echo count($_POST);
	
	foreach($_POST as $key => $value){
		//if(substr($key,0,4)=='cant')
			//echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
	}
	//echo "<p>";
	
	// Nos movemos por los elementos del arreglo de session
	foreach($arrsd as $key => $value){
		//echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		// Verificamos que la cadena inicial de $key sea 'cant-' pues esta
		// variable contiene la cantidad existente de un insumo
		// cant-'#deinsumo'
		if(substr($key,0,5)=='cant-'){
			//echo " key:=[".$key."] >>> valor:=[".$value."]     [<br>";
			// Le damos el indice del insumo $key a $Id_Insumo_Sesion
			$Id_Insumo_Sesion=substr($key,5,strlen($key)-5);
			// Recorremos los elementos de $_POST
			foreach($_POST as $post_key => $post_value){
	 			// Le damos el indice del insumo key($_POST) a $Id_Insumo_POST
				$Id_Insumo_Post=substr($post_key,9,strlen($post_key)-9);
				// Comprobamos la igualdad de los dos indices
				// Si son iguales significa que el insumo key($_POST) ha sido solicitado
				if($Id_Insumo_Post==$Id_Insumo_Sesion&&$post_value>0&&$_POST['cant-sel-'.$Id_Insumo_Post.'']=='on'){
					//echo "idpost=$Id_Insumo_Post ==== idsession=$Id_Insumo_Sesion<br>";
					// Comprobamos que las cantidad pedida y existe sea coherentes
					// y además que el boton de selección está activo
					//echo "insumo [".$Id_Insumo_Sesion."] es mas grande valorpost[".$post_value."] a valorsession[".$value."]<br>";
					if($post_value>$value){
						// Eliminamos por si existiera
						//unset($_COOKIE['mensaje']);
						// Establecemos la cokkie del error para mostrarlo en insumos-requisiciones.php
						setcookie("mensaje","Se ha solicitado ".$post_value." elementos del Insumo[".$_SESSION["insumo-".$Id_Insumo_Post]."] sobrepasando del l&iacute;mite de ".$value." pisponibles", time()+20);
						// Respaldamos el id del insumo sobrepasado para establecer el link del mismo;
						$_SESSION['insumo-pasado']=$Id_Insumo_Post;
						// Redireccionamos a insumos-requisiciones para mostrar el error
						header("location: insumos-requisiciones.php?meta=".$_GET['meta']."&accion=".$_GET['accion']."&cap=".$_GET['cap']."#pa");
						exit();
					}
					//Aquí guardamos la disminución 
					else{
						// Mensaje
							// echo "Se ha solicitado ".$post_value." del insumo ".$Id_Insumo_Sesion." y existen ".$value."<br>";
						
						// Guardamos en variables de session las cantidades de los insumos que se disminuirán
							// echo "creamos la variable = $post_key con el valor solicitado de $post_value<br>";
						$_SESSION[$post_key]=$post_value;
						
					}
						//header();
				}else{
					unset($_SESSION['cant-sel-'.$Id_Insumo_Post]);
					}
			}
		}
	}
	//echo "Esto para la accion ".$_GET['accion']." de la meta ".$_GET['meta'];
	
	// Redireccionamos a la pagina de insumos-requisiciones con los datos de entrada
		 header("location: insumos-requisiciones.php?meta=".$_GET['meta']."&accion=".$_GET['accion']."&cap=".$_GET['cap']."#pa");
		 exit();
	
?>
