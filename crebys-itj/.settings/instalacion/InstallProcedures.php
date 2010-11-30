<?php 
	// Incluimos la libreria para hacer la conexion con la base de datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_datos.php');

	// Variables
		
		// Errores [Arreglo]
		$arr_errores=array();
		// Nombres de Procedimientos [Arreglo]
		$arr_nom_proc=array();
		// Contador de procedimientos;
		$cont_proc=0;
		// Conexión a base de datos
		$conexion=new Base_de_datos("localhost","root","","crebys-itj");
		
		// Conexión al archivo de procedimientos.sql
		
		$fi= fopen($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/instalacion/Files/procedimientos.sql','r');

		// Ciclo para leer archivo
		
		while($linea=fgets($fi,1024)){
			// Guardamos la posicion de la linea
			// en la que encuentre el caracter [!]
			$pos_char=strpos($linea,"!");
			// Si no encuentra el simbolo [!]
			// Quiere decir que es parte del procedimiento Inicio-Contenido-Fin
			if(is_bool($pos_char)){
				// Posición del caracter [&]
				$pos_char=strpos($linea,"&");
				// Si la posicion del caracter $ es menor o igual a 3 es el inicio del procedimiento
				if (!is_bool($pos_char)&&$pos_char<=2){
					// Iniciamos el almacenamiento del procedimiento
					$procedimiento=substr($linea, 2);
				} // Si entra en lo siguiente es el final del procedimiento
				elseif (!is_bool($pos_char)&&$pos_char>2){
					// Terminamos de guardar el procedimiento
					$procedimiento.=substr($linea, 0,strlen($linea)-3);
					// Guardamos el nombre del procedimiento
						
						// Posición inicial del procedimiento
						$pos_ini=strpos($procedimiento, "PROCEDURE ")+10;	
						// Posición inicial del procedimiento
						$pos_fin=strpos($procedimiento, "(");
						
						// Posición final del procedimiento
						$arr_nom_proc[$cont_proc]=substr($procedimiento,$pos_ini,$pos_fin-$pos_ini);
						
					// Ejecutamos el procedimiento
					$conexion->executeSQL($procedimiento);
					
					// Guardamos el error en el caso que hubiera
					$arr_errores[$cont_proc]=$conexion->erroraiz();

					// Incrementamos el contador
					$cont_proc++;
				}else
					// Guardamos el contenido del procedimiento 
					$procedimiento.=$linea;
			}
		}
		
		// Contador de procedimientos creados;
		$crt_proc=0;
		
		// Mostramos el estatus de los procedimientos
		for($i=0;$i<count($arr_nom_proc);$i++){
			// Mostramos el procedimientos que se intentó crear en mayusculas
			echo "Creando procedimiento[".strtoupper($arr_nom_proc[$i])."]...";
			// Verificamos si el error que devolvió fue de ya creado
			if (strpos($arr_errores[$i], "already exists")){
				// Mostramos que en procedimiento ya existia
				echo "[+] Procedimiento ya existente<p>";
			} // Vefiricamos si se creo correctamente el procedimiento
			elseif (strlen($arr_errores[$i])==0){
				// Mensaje de procedimiento creado correctamente
				echo "[+] Procedimiento creado correctamente<p>";
				// Incrementamos contador
				$crt_proc++;
			} // Si entra aquí es que ocurrió algun error
			else{
				// Mostramos mensaje de error
				echo "<br>[-] Error:= {$arr_errores[$i]}";
			} 
				
		}
		// Verificamos si se creo minimo un procedimiento
		if($crt_proc>0){
			// Mostramos la cantidad de procedimientos que se crearon
			echo "[+] $crt_proc Procedimientos creados correctamente<p>";
		}
?>