<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Validar.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_Datos.php');
	//Clase para la manipulación de los
	//procedimientos almacenados de MySQL
	//con sus respectivos errores
	class Procedimientos{
		//Variable para conexion con
		//la base de datos
		private $conexion;
		// Variable para guardar el éxito o error coorespondiente
		private $error;
		// Objeto de la clase Validar.php para validar los tipos de datos
		private $validar;
		// Constructor
		function __construct(){
			//Inicializamos la conexión a la base de datos
			$this->conexion=new Base_de_Datos("localhost","root","","crebys-itj");
			//Creamos el objetos para validar las entradas de tipos de datos
			$this->validar=new Validar();
		}
		// Saber el tipo de usuario
		function saberTipoUsuario($Us_Nick){
			$this->conexion->executeSQL("call saberTipoUsuario('$Us_Nick',@tipo);select @tipo");	
			return $this->conexion->error();
		}
		// Validamos los datos de inicio de sesion
		function iniciarSesion($us_nick,$us_password){
				$this->conexion->executeSQL("call iniciarSesion('$us_nick',md5('$us_password'),@error); select @error");
				switch($this->conexion->error()){
					case 0:
						return "Error en la consulta";
					case 1:
						return true;
					case 2:
						return "No existe el usuario:=[$us_nick]";
					case 3:
						return "La contraseña es incorrecta";;
				}
		}
		//Función para insertar una Partida
		function insPartida($Id_Partida,$Pa_Nombre){
			if($this->validar->validarNumero($Id_Partida)){
				if($this->validar->validarCadena($Pa_Nombre,$this->sacarLongitud("Partidas","Pa_Nombre"))){
					$this->conexion->executeSQL("call insPartida('.$Id_Partida.','.$Pa_Nombre.',@error); select @error");
					//$this->conexion->mostrarResSQL();
					switch ($this->conexion->error()){
						case 0:
							$this->error="[-] Error en la consulta";	
							return 0;
						case 1:
							$this->error="[+] La partida se creó correctamente:
													- Id_Partida:= ".$Id_Partida."
													"."- Pa_Nombre:=".$Pa_Nombre;
							return 1;
						case 2:
							$this->error="[-] El registro ya existe";	
							return 0;
					}
				}else{
					$this->error="[-] Pa_Nombre no válido";
					return 0;	
				}
			}else{
				$this->error="[-] Id_Partida no válido";
				return 0;
			}
		}
		//Función para modificar el nombre de una Partida
		function modPartida($Id_Partida,$Pa_Nombre){
			if($this->validar->validarNumero($Id_Partida)){
				if($this->validar->validarCadena($Pa_Nombre,$this->sacarLongitud("Partidas","Pa_Nombre"))){
					$this->conexion->executeSQL("call modPartida('.$Id_Partida.','.$Pa_Nombre.',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";	
								return 0;
							case 1:
								$this->error="[+] La partida se modifico correctamente:
													- Id_Partida:= ".$Id_Partida."
													"."- Pa_Nombre:=".$Pa_Nombre;
								return 1;
							case 2:
								$this->error="[-] No se encontró el Id_Partida:= ".$Id_Partida;	
								break;
								return 0;
						}
				}else{
					$this->error="[-] Pa_Nombre no válido";
					return 0;	
				}
			}else{
					$this->error="[-] Id_Partida no válido";
					return 0;	
				}
		}
		//Función para modificar el nombre de una Partida
		function eliPartida($Id_Partida){
			if($this->validar->validarNumero($Id_Partida)){
					$this->conexion->executeSQL("call eliPartida('.$Id_Partida.',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";
								return 0;
							case 1:
								$this->error="[+] Se eliminó la partida correctamente:
													- Id_Partida:= ".$Id_Partida;
								return 1;
							case 2:
								$this->error="[-] No se pudo eliminar la partida ".$Id_Partida."
												Descripción: Existen insumos relacionados";	
								return 0;
							case 3:
								$this->error="[-] No se pudo eliminar la partida ".$Id_Partida."
												Descripción: No existe";
								return 0;	
						}
			}else{
					$this->error="[-] Id_Partida no válido";
					return 0;	
				}
		}
		//Función para insertar Insumos
		function insInsumo($In_Nombre,$In_Precio,$In_Unidad_M,$Id_Partida){
			if($this->validar->validarCadena($In_Nombre,$this->sacarLongitud("Insumos", "In_Nombre"))){
				if($this->validar->validarDouble($In_Precio)){
						if($this->validar->validarNumero($Id_Partida)){
							$this->conexion->executeSQL("call insInsumo('".$In_Nombre."',".$In_Precio.",'".$In_Unidad_M."',".$Id_Partida.",@error);select @error");
							switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";
								break;
							case 1:
								$this->error="[-] El insumo se insertó correctamente";
								return 1;
							case 2:
								$this->error="[-] Ya existe el insumo: ".$In_Nombre;
								break;
							case 3:
								$this->error="[-] No existe la partida: ".$Id_Partida;
							}
						}else
							$this->error="[-] Id_Partida no válido";	
				}else
					$this->error="[-] In_Precio no válido";
			}else 
				$this->error="[-] In_Nombre no válido";
			return 0;
		}
		//Función para devolver el error de uno de los procedimientos
		function devError(){
			return $this->error;
		}
		//Funcion para la modificacion de un 
		//registro en la tabla Insumos 
		function modInsumo($arreglo){
			// Id_Insumo = 0
			// In_Nombre = 1
			// In_Precio = 2
			// In_Unidad_M = 3
			// Id_Partida = 4
			//echo "el nombre del insumo modificado es:=[".$arreglo[1]."]";
			if($this->validar->validarNumero($arreglo[0])){
				if($this->validar->validarCadena($arreglo[1],$this->sacarLongitud("Insumos","In_Nombre"))){
					if($this->validar->validarDouble($arreglo[2])){
						if($this->validar->validarCadena2($arreglo[3],$this->sacarLongitud("medidas","Un_Nombre"))){
							if($this->validar->validarNumero($arreglo[4])){
								$this->conexion->executeSQL("call modInsumo(".$arreglo[0].",'".$arreglo[1]."',".$arreglo[2].",'".$arreglo[3]."',".$arreglo[4].",@error); select @error");
								switch ($this->conexion->error()){
									case 0:
										$this->error="[-] Error en la consulta";
										break;
									case 1:
										$this->error="[-] El insumo se insertó correctamente:";
										return 1;
									case 2:
										$this->error="[-] No existe el insumo: ".$arreglo[0];
										break;
									case 3:
										$this->error="[-] No existe la partida: ".$arreglo[4];
										break;
									case 4:
										$this->error="[-] No existe la medida señalada: ".$arreglo[3];
								}
							}else
								$this->error="[-] Id_Partida no válido";
						}else
							$this->error="[-] Un_Nombre no válido";
					}else 
						$this->error="[-] In_Precio no válido";
				}else
					$this->error="[-] In_Nombre no válido";
			}else
				$this->error="[-] Id_Insumo no válido";
			return 0;
		}
		//Función que nos devuelve el Id de In_Nombre 
		//que acaba de ser innsertado en la tabla
		//Insumos. Se utiliza en el proc insInsumo
		private function getId_Insumo($In_Nombre){
			$this->conexion->executeSQL("select Id_Insumo from Insumos where In_Nombre='".$In_Nombre."'");
			return $this->conexion->error();
		}
		//Mostramos el valor de $this->error
		//con el formato real
		function mostrarError(){
			return nl2br($this->error);
		}
		//Funcion para eliminar
		//insumos apartir de la clave principal
		function eliInsumo($Id_Insumo){
			if($this->validar->validarNumero($Id_Insumo)){
					$this->conexion->executeSQL("call eliInsumo('.$Id_Insumo.',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";
								break;
							case 1:
								$this->error="[+] Se eliminó el insumo correctamente:
													- Id_Insumo:= ".$Id_Insumo;
								return 1;
							case 2:
								$this->error="[-] No se pudo eliminar el Insumo: ".$Id_Insumo."
												Descripción: No existe el insumo";	
								break;
							case 3:
								$this->error="[-] No se pudo eliminar el Insumo: ".$Id_Insumo."
												Descripción: Existe registros relacionados en insumos-acciones";
						}
			}else{
					$this->error="[-] Id_Partida no válido";
				}
			return 0;
		}
		// Función para insertar procesos estratégicos
		function insProcEst($Pe_Nombre){
			if($this->validar->validarCadena($Pe_Nombre, $this->sacarLongitud("proc_estrategicos", "Pe_Nombre"))){
				$this->conexion->executeSQL("call insProc_Estrategico('".$Pe_Nombre."',@error); select @error");
				switch ($this->conexion->error()){
					case 0:
						$this->error="[-] Error en la consulta";
						break;
					case 1:
						$this->error="[+] Proceso Estratégico insertado correctamente:= ".$Pe_Nombre;
						return 1;
					case 2:
						$this->error="[-] Ya existe el proceso estretégico:= ".$Pe_Nombre;
				}
			}else
				$this->error="[-] Pe_Nombre no válido";
			return 0;
		}
		// Procedimiento para modificar un proceso estratégico
		function modProcEst($Id_Proc_Estrategico,$Pe_Nombre){
			if($this->validar->validarNumero($Id_Proc_Estrategico)){
				if($this->validar->validarCadena($Pe_Nombre, $this->sacarLongitud("proc_estrategicos","Pe_Nombre"))){
						$this->conexion->executeSQL("call modProc_Estrategico(".$Id_Proc_Estrategico.",'".$Pe_Nombre."',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error de consulta";
								break;
							case 1:
								$this->error="[-] Proceso estratégico modificado satisfactoriamente";
								return 1;
						}
				}else
					$this->error="[-] Pe_Nombre no válido";
			}else 
				$this->error="[-] Id_Proc_Estrategico no válido";
			return 0;
		}
		// Procedimiento para insertar un usuario
		function insUsuario($Id_Departamento_Puesto,$Us_Password,$Us_Nombre,$Us_Apellidop,$Us_Apellidom,$Us_Nick,$Id_Puesto,$Id_Departamento){
			if($this->validar->validarPassword($Us_Password, $this->sacarLongitud("usuarios","Us_Password"))){
				if($this->validar->validarCadena($Us_Nombre, $this->sacarLongitud("usuarios","Us_Nombre"))){
					if($this->validar->validarCadena($Us_Apellidop, $this->sacarLongitud("usuarios","Us_Apellidop"))){
						if($this->validar->validarCadena($Us_Apellidom, $this->sacarLongitud("usuarios","Us_Apellidom"))){
							if($this->validar->validarCadena($Us_Nick, $this->sacarLongitud("usuarios","Us_Nick"))){
								$this->conexion->executeSQL("call insUsuario(".$Id_Departamento_Puesto.",'".md5($Us_Password)."','".$Us_Nombre."','".$Us_Apellidop."','".$Us_Apellidom."','".$Us_Nick."',".$Id_Puesto.",".$Id_Departamento.",@error); select @error");
								switch ($this->conexion->error()){
									case 0:
										$this->error="[-] Error de consulta";
										break;
									case 1:
										return true;
									case 2:
										$this->error="[-] Nick repetido";
										break;
									case 3:
										$this->error="[-] Nombre repetido";
										break;
									case 4:
										$this->error="[-] No existe el puesto[".$Id_Puesto."]";
										break;
									case 5:
										$this->error="[-] No existe el departamento[".$Id_Departamento."]";
										break;
									case 6:
										$this->error="[-] Ya existe el usuario Jefe para el departamento[".$Id_Departamento."]";
										break;
								}		
							}else
								$this->error="[-] Nick no válido";	
						}else
							$this->error="[-] Apellido materno no válido";	
					}else
						$this->error="[-] Apellido paterno no válido";	
				}else
					$this->error="[-] Nombre de usuario no válido";	
			}else
				$this->error="[-] Error en la longitud de la contraseña";
			return 0;
		}
		// Saber el departamento a partir del nick
		function saberDepartamento($Us_Nick){
			$this->conexion->executeSQL("call saberDepartamento('$Us_Nick',@dep); select @dep");
			return $this->conexion->error();
		}

		// Devuelve todas las partidas existentes
		function devolverPartidas(){
			$this->conexion->executeSQL("select * from Partidas");
			return $this->conexion->getArray();
		}
		// Devuelve insumos a partir del Id de la partida
		function devolverInsumos($Id_Partida){
			$this->conexion->executeSQL("select In_Nombre from Insumos where Id_Partida=$Id_Partida");
			return $this->conexion->getArray();
		}
		// Devuelve el indice de una unidad de medida
		function devolverIdUnidadM($Un_Nombre){
			$this->conexion->executeSQL("select Id_Unidad_Medida from medidas where Un_Nombre='$Un_Nombre'");
			return $this->conexion->error();
		}
		// Develve todas las medidas
		function devolverMedidas(){
			$this->conexion->executeSQL("select Un_Nombre from medidas");	
			return $this->conexion->getArray();
		}
		// Agregar una medida
		function agregarMedida($Un_Nombre){
			$this->conexion->executeSQL("call agregarMedida('".$Un_Nombre."',@error); select @error");
			switch($this->conexion->error()){
				case 0:
					return "Error en la consulta";
				case 1:
					return true;
				case 2:
					return "La medida $Un_Nombre ya existe";					
			}
		}
		// Agregar una accion a $_Meta
		function agregarAccion($Id_Meta,$Ac_Descripcion){
			$this->conexion->executeSQL("call agregarAccion('".$Id_Meta."','".$Ac_Descripcion."',@error); select @error");
			switch($this->conexion->error()){
				case 0:
					return "Error en la consulta";
				case 1:
					return true;
			}
		}
		// Agregar una meta
		function agregarMeta($Id_Proc_Clave,$Me_Nombre,$Me_Unidad_M,$Me_Cantidad){
			$this->conexion->executeSQL("call agregarMeta(".$Id_Proc_Clave.",'".$Me_Nombre."','".$Me_Unidad_M."',".$Me_Cantidad.",@error); select @error");
			switch($this->conexion->error()){
				case 0:
					return "Error en la consulta";
				case 1:
					return true;
				case 2:
					return "Meta ya existente";
			}
		}
		//Sacamos la longitud de cualquier campo
		// en la tabla especificada
		//PE: cadena varchar(30)
		//RES: 	30
		//PE: entero int(11)
		//RES: 	11
		function sacarLongitud($table,$campo){
 			$arr=array();
			$conexion=new Base_de_datos('localhost', 'root', '', 'crebys-itj');
			$conexion->executeSQL("describe ".$table);
			$arr=$conexion->getArray();
			for($ren=0;$ren<count($arr);$ren++){
					//Este if verifica que el registro en el arreglo actual
					//($ren) sea igual al buscado en $campo
					if(strcmp($campo,$arr[$ren][0])==0){
						//Variable para sacar la posición de "("	
						$pi=strpos($arr[$ren][1],"(");
						//Variable para sacar la posición de "("	
						$pf=strpos($arr[$ren][1],")");
						//Retornamos lo que este dentro del parentesis en
						//la segunda columna que es la que tiene la longitud del campo
						//echo "Se regresa longitud:= ".substr($arr[$ren][1],$pi+1,($pf-$pi)-1);
						return substr($arr[$ren][1],$pi+1,($pf-$pi)-1);
					}
			}
			return false;	
		}
		// Devolvemos los procesos estratégicos
		function devolverProcesos_Estrategicos(){
			$this->conexion->executeSQL("select * from proc_estrategicos");
			return $this->conexion->getArray();
		}
		// Devolver procesos clave del proceso estratégico
		function devolverProcesos_Clave($Id_Proc_Estrategico){
			$this->conexion->executeSQL("select Id_Proc_Clave,Pc_Nombre from proc_claves where Id_Proc_Estrategico=".$Id_Proc_Estrategico);
			return $this->conexion->getArray();
		}
		// Devuelve el contenido de una alguna accion basandose en determinada meta
		function devolverAccion($Id_Meta,$Num_Accion){
			$this->conexion->executeSQL("Select Ac_descripcion from Acciones where Id_Meta=$Id_Meta and Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion));
			return $this->conexion->error();
		}
		// Guardar la acción det. de la meta det.
		function guardarAccion($Id_Meta,$Num_Accion,$Ac_Descripcion){
			$this->conexion->executeSQL("update Acciones set Ac_Descripcion='".$Ac_Descripcion."' where Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)."");
			return $this->conexion->error();
		}
		// Saber id de la accion "uno","dos","tres",etc. de la meta determinada
		// Los indices de las acciones deben empezar desde el registro con Id="1"
		// puesto que desde ese indice empezará a buscar las coincidencias
		function saberIdAccion($Id_Meta,$Id_Num_Accion){
			$this->conexion->executeSQL("call saberIdAccion($Id_Meta,$Id_Num_Accion,@error); select @error");
			return $this->conexion->error();
		}
		// Funsción para devolver todas las Acciones de una Meta
		function devolverAcciones($Id_Meta){
			$this->conexion->executeSQL("select Ac_Descripcion from Acciones where Id_Meta=$Id_Meta");
			return $this->conexion->getArray();
		}
		// Devuelve datos básicos para la pagina metas-accioes
		function datosMeta($Id_Meta){
			$this->conexion->executeSQL("SELECT Me_Nombre, Pc_Nombre, Pe_Nombre,proc_estrategicos.Id_Proc_Estrategico,Me_Unidad_M,Me_Cantidad,Me_Nombre,proc_claves.Id_Proc_Clave
										 FROM metas
											INNER JOIN (
												proc_claves
												INNER JOIN proc_estrategicos ON proc_estrategicos.Id_Proc_Estrategico = proc_claves.Id_Proc_Estrategico
											) ON proc_claves.Id_Proc_Clave = metas.Id_Proc_Clave
										 WHERE Id_Meta =$Id_Meta");
			return $this->conexion->getArray();
		}
		// Devuelve todas las metas
		function devolverMetas(){
			$this->conexion->executeSQL('select Id_Meta from Metas');
			return $this->conexion->getArray();
		}
		// Devuelve todas las metas
		function devolverMetasPE($Id_Proc_Estrategico){
			$this->conexion->executeSQL('SELECT Id_Meta
										 FROM metas
											INNER JOIN (
												proc_claves
												INNER JOIN proc_estrategicos ON proc_estrategicos.Id_Proc_Estrategico = proc_claves.Id_Proc_Estrategico
											) ON proc_claves.Id_Proc_Clave = metas.Id_Proc_Clave
										 WHERE proc_estrategicos.Id_Proc_Estrategico ='.$Id_Proc_Estrategico.'');
			return $this->conexion->getArray();
		}
		// Eliminar Accion
		function eliminarAccion($Id_Meta,$Num_Accion){
			$this->conexion->executeSQL("call eliminarAccion(".$Id_Meta.",".$Num_Accion.",@error); select @error");
			return $this->conexion->error();
		}
		// Modificar meta
		function modMeta($Id_Meta,$Id_Proc_Clave,$Me_Nombre,$Me_Unidad_M,$Me_Cantidad){
			$this->conexion->executeSQL("update Metas set Id_Proc_Clave=".$Id_Proc_Clave.", Me_Nombre='$Me_Nombre', Me_Unidad_M='$Me_Unidad_M', Me_Cantidad=$Me_Cantidad where Id_Meta=$Id_Meta;");
			return true;
		}// Saber ID de un proceso clave en base a su nombre
		function saberIdProcClave($Pc_Nombre){
			$this->conexion->executeSQL("select Id_Proc_Clave from proc_claves where Pc_Nombre=$Pc_Nombre");
			return $this->conexion->error();
		}
		// Prodecimiento para agregar Meta-Accion a un poa
		function insMetaAccionPOA($Us_Nick,$Id_Accion){
			$this->conexion->executeSQL("call insMetaAccionPOA('".$Us_Nick."',".$Id_Accion.",@error); select @error");	
			if($this->conexion->error()==1)
				return "Inserción correcta";
			else
				return "Hubo un error al insertar la relación";
		}
		// Devolver metas POA
		function devolverMetasPOA($Us_Nick){
			$this->conexion->executeSQL("select DISTINCT metas.Id_Meta,metas.Id_Proc_Clave,metas.Me_Nombre,metas.Me_Unidad_M,metas.Me_Cantidad
from metas inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=acciones_poa.Id_POA)on acciones_poa.Id_Accion=acciones.Id_Accion)on acciones.Id_Meta=metas.Id_Meta
where Us_Nick='$Us_Nick' ORDER BY metas.Id_Meta");
			return $this->conexion->getArray();
		}
		// Devolver acciones de una meta de un poa
		function devolverAccionesMetaPOA($Us_Nick,$Id_Meta){
			$this->conexion->executeSQL("select Ac_Descripcion, acciones.Id_Accion
from metas inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=acciones_poa.Id_POA)on acciones_poa.Id_Accion=acciones.Id_Accion)on acciones.Id_Meta=metas.Id_Meta
where Us_Nick='$Us_Nick' and metas.Id_Meta=$Id_Meta ORDER BY acciones.Id_Accion");
			return $this->conexion->getArray();
		}
		//Procedimiento para encontrar el numero de accion al que pertenece de acuerdo a su correspondiente meta
		function numAccion($Id_Accion){
			$this->conexion->executeSQL("call numAccion($Id_Accion,@error); select @error");
			return $this->conexion->error();
		}
		// Devolver todos los datos de todos los insumos
		function devDatosInsumos($cap){
			$this->conexion->executeSQL("select insumos.Id_Partida,Id_Insumo,In_Nombre,insumos.Id_Unidad_Medida,Un_Nombre,In_Precio,Pa_Nombre
from medidas inner join (insumos inner join partidas on partidas.Id_Partida=insumos.Id_Partida)on insumos.Id_Unidad_Medida=medidas.Id_Unidad_Medida
where insumos.Id_Partida between ".$cap."0000 and ".($cap+1)."0000
order by insumos.Id_Partida, In_Nombre");
			return $this->conexion->getArray();
		}
		// Devolver todos los datos de todos los insumos
		function devDatosInsumo($id_insumo){
			$this->conexion->executeSQL("select insumos.Id_Partida,Id_Insumo,In_Nombre,insumos.Id_Unidad_Medida,Un_Nombre,In_Precio,Pa_Nombre
from medidas inner join (insumos inner join partidas on partidas.Id_Partida=insumos.Id_Partida)on insumos.Id_Unidad_Medida=medidas.Id_Unidad_Medida
where Id_Insumo=$id_insumo");
			return $this->conexion->getArray();
		}
		// Devolver identificador de un nombre de insumo
		function devIdInsumo($In_Nombre){
			$this->conexion->executeSQL("select Id_Insumo from Insumos where In_Nombre='$In_Nombre'");
			return $this->conexion->error();
		}
		// Eliminar Insumos
		function eliminarInsumo($Id_Insumo){
			$this->conexion->executeSQL("delete from insumos where Id_Insumo=$Id_Insumo");
			return $this->conexion->error();
		}
	}
?>