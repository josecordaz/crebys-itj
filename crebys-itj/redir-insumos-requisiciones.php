<?php
	// Inicializamos el manejo de variables de session
	session_start();
	
		// Declaramos un arreglo
		$arrsd=array();
		$arrpost=array();
		
		// Copiamos los datos del arreglo
		$arrsd=$_SESSION;
		$arrpost=$_POST;
		
/*  	echo "POST<br>";
		foreach($arrpost as $post_key => $post_value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$post_key."] >>> valor:=[".$post_value."]<br>";
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
*/

		// Inicializamos el contador de session
		// de este capitulo
		$_SESSION[$_POST['cap-ant'].'-err']=0;
		
		// Recorremos el arreglo de POST
		foreach($arrpost as $post_key => $post_value){
			// Verificamos que la variable $post_key
			// inicie con 'cant-sol-'
			if((substr($post_key,0,9)=='cant-sol-')){
				// Respaldamos el índice de este insumo
				$Id_Insumo_POST=substr($post_key,9,strlen($post_key)-9);
				// Verificamos que también exista la variable post del checkbox
				// del insumo que acaba de aceptar el if anterior
				if($arrpost['cant-sel-'.$Id_Insumo_POST]=='on'){
					// creamos la variable de session 
					// de la cantidad de este insumo
					$_SESSION['cant-sol-'.$Id_Insumo_POST]=$_POST['cant-sol-'.$Id_Insumo_POST];
					//Recorremos el arreglo de $_SESSION
					foreach($arrsd as $session_key => $session_value){
						// Verificamos que el nombre de la variable de session
						// inicie con 'cant-'.$Id_Insumo pues esta variable 
						// contiene el límite del insumo Id_Insumo que se puede
						// solicitar
						if($session_key=='cant-'.$Id_Insumo_POST){
							// Ahora verificamos si el valor de $_SESSION['cant-sol-'.$Id_Insumo_POST]
							// es mayor o menor a su límite en el valor de $_SESSION['cant-'.$Id_Insumo_POST]
							if($session_value<$arrpost['cant-sol-'.$Id_Insumo_POST]){
								// Creamos la variable de session  que identificará con error al 
								// presentar el insumo en insumos-requisiciones.php
								$_SESSION['mal-'.$Id_Insumo_POST]=1;
								// Incrementamos el contador de los
								// errores de este capitulo
								$_SESSION[$_POST['cap-ant'].'-err']++;
							}
						}
					}
				}else{
					// Si entra aquí es que no está activada
					// la variable del checkbox con el índice
					// $Id_Insumo_POST por lo tanto eliminamos
					// sus posibles variables de solicitud y error
					// pues se ha cancelado
					
					unset($_SESSION['cant-sol-'.$Id_Insumo_POST]);
					unset($_SESSION['mal-'.$Id_Insumo_POST]);
				}
			}
				
		}

		//echo "Esto para la accion ".$_GET['accion']." de la meta ".$_GET['meta'];
		
	// Verificamos si esta página fue llamada por el boton envier o por los enlaces 
	// en los titulos de capitulo de la pagina insumos-requisiciones.php
	// Para ello checamos el valor del boton enviar para saber si fue pulsado
	// o no
	
/*			echo "<br>SESSION<br>";
		foreach($_SESSION as $key => $value){
			//if(substr($key,0,4)=='cant')
				echo " key:=[".$key."] >>> valor:=[".$value."]<br>";
		}
*/

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
