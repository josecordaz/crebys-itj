<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Validar.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_Datos.php');
	//Clase para la manipulaci�n de los
	//procedimientos almacenados de MySQL
	//con sus respectivos errores
	class Procedimientos{
		//Variable para conexion con
		//la base de datos
		private $conexion;
		// Variable para guardar el �xito o error coorespondiente
		private $error;
		// Objeto de la clase Validar.php para validar los tipos de datos
		private $validar;
		// Constructor
		function __construct(){
			//Inicializamos la conexi�n a la base de datos
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
						return "La contrase�a es incorrecta";;
				}
		}
		//Funci�n para insertar una Partida
		function insPartida($Id_Partida,$Pa_Nombre){
			if($this->validar->validarNumero($Id_Partida)){
				if($this->validar->validarCadena($Pa_Nombre,$this->sacarLongitud("Partidas","Pa_Nombre"))){
					$this->conexion->executeSQL("call insPartida(".$Id_Partida.",'".$Pa_Nombre."',@error); select @error");
					//$this->conexion->mostrarResSQL();
					switch ($this->conexion->error()){
						case 0:
							$this->error="[-] Error en la consulta";	
							return 0;
						case 1:
							$this->error="[+] La partida se cre� correctamente:
													- Id_Partida:= ".$Id_Partida."
													"."- Pa_Nombre:=".$Pa_Nombre;
							return 1;
						case 2:
							$this->error="[-] El identificador ya existe";	
							return 0;
						case 3:
							$this->error="[-] El nombre de partida ya existe";
							return 0;
					}
				}else{
					$this->error="[-] Pa_Nombre no v�lido";
					return 0;	
				}
			}else{
				$this->error="[-] Id_Partida no v�lido";
				return 0;
			}
		}
		//Funci�n para modificar el nombre de una Partida
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
								$this->error="[-] No se encontr� el Id_Partida:= ".$Id_Partida;	
								break;
								return 0;
						}
				}else{
					$this->error="[-] Pa_Nombre no v�lido";
					return 0;	
				}
			}else{
					$this->error="[-] Id_Partida no v�lido";
					return 0;	
				}
		}
		//Funci�n para modificar el nombre de una Partida
		function eliPartida($Id_Partida){
			if($this->validar->validarNumero($Id_Partida)){
					$this->conexion->executeSQL("call eliPartida('.$Id_Partida.',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";
								return 0;
							case 1:
								$this->error="[+] Se elimin� la partida correctamente:
													- Id_Partida:= ".$Id_Partida;
								return 1;
							case 2:
								$this->error="[-] No se pudo eliminar la partida ".$Id_Partida."
												Descripci�n: Existen insumos relacionados";	
								return 0;
							case 3:
								$this->error="[-] No se pudo eliminar la partida ".$Id_Partida."
												Descripci�n: No existe";
								return 0;	
						}
			}else{
					$this->error="[-] Id_Partida no v�lido";
					return 0;	
				}
		}
		//Funci�n para insertar Insumos
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
								$this->error="[-] El insumo se insert� correctamente";
								return 1;
							case 2:
								$this->error="[-] Ya existe el insumo: ".$In_Nombre;
								break;
							case 3:
								$this->error="[-] No existe la partida: ".$Id_Partida;
							}
						}else
							$this->error="[-] Id_Partida no v�lido";	
				}else
					$this->error="[-] In_Precio no v�lido";
			}else 
				$this->error="[-] In_Nombre no v�lido";
			return 0;
		}
		//Funci�n para devolver el error de uno de los procedimientos
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
										$this->error="[-] El insumo se insert� correctamente:";
										return 1;
									case 2:
										$this->error="[-] No existe el insumo: ".$arreglo[0];
										break;
									case 3:
										$this->error="[-] No existe la partida: ".$arreglo[4];
										break;
									case 4:
										$this->error="[-] No existe la medida se�alada: ".$arreglo[3];
								}
							}else
								$this->error="[-] Id_Partida no v�lido";
						}else
							$this->error="[-] Un_Nombre no v�lido";
					}else 
						$this->error="[-] In_Precio no v�lido";
				}else
					$this->error="[-] In_Nombre no v�lido";
			}else
				$this->error="[-] Id_Insumo no v�lido";
			return 0;
		}
		//Funci�n que nos devuelve el Id de In_Nombre 
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
								$this->error="[+] Se elimin� el insumo correctamente:
													- Id_Insumo:= ".$Id_Insumo;
								return 1;
							case 2:
								$this->error="[-] No se pudo eliminar el Insumo: ".$Id_Insumo."
												Descripci�n: No existe el insumo";	
								break;
							case 3:
								$this->error="[-] No se pudo eliminar el Insumo: ".$Id_Insumo."
												Descripci�n: Existe registros relacionados en insumos-acciones";
						}
			}else{
					$this->error="[-] Id_Partida no v�lido";
				}
			return 0;
		}
		// Funci�n para insertar procesos estrat�gicos
		function insProcEst($Pe_Nombre){
			if($this->validar->validarCadena($Pe_Nombre, $this->sacarLongitud("proc_estrategicos", "Pe_Nombre"))){
				$this->conexion->executeSQL("call insProc_Estrategico('".$Pe_Nombre."',@error); select @error");
				switch ($this->conexion->error()){
					case 0:
						$this->error="[-] Error en la consulta";
						break;
					case 1:
						$this->error="[+] Proceso Estrat�gico insertado correctamente:= ".$Pe_Nombre;
						return 1;
					case 2:
						$this->error="[-] Ya existe el proceso estret�gico:= ".$Pe_Nombre;
				}
			}else
				$this->error="[-] Pe_Nombre no v�lido";
			return 0;
		}
		// Procedimiento para modificar un proceso estrat�gico
		function modProcEst($Id_Proc_Estrategico,$Pe_Nombre){
			if($this->validar->validarNumero($Id_Proc_Estrategico)){
				if($this->validar->validarCadena($Pe_Nombre, $this->sacarLongitud("proc_estrategicos","Pe_Nombre"))){
						$this->conexion->executeSQL("call modProc_Estrategico(".$Id_Proc_Estrategico.",'".$Pe_Nombre."',@error); select @error");
						switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error de consulta";
								break;
							case 1:
								$this->error="[-] Proceso estrat�gico modificado satisfactoriamente";
								return 1;
						}
				}else
					$this->error="[-] Pe_Nombre no v�lido";
			}else 
				$this->error="[-] Id_Proc_Estrategico no v�lido";
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
								$this->error="[-] Nick no v�lido";	
						}else
							$this->error="[-] Apellido materno no v�lido";	
					}else
						$this->error="[-] Apellido paterno no v�lido";	
				}else
					$this->error="[-] Nombre de usuario no v�lido";	
			}else
				$this->error="[-] Error en la longitud de la contrase�a";
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
						//Variable para sacar la posici�n de "("	
						$pi=strpos($arr[$ren][1],"(");
						//Variable para sacar la posici�n de "("	
						$pf=strpos($arr[$ren][1],")");
						//Retornamos lo que este dentro del parentesis en
						//la segunda columna que es la que tiene la longitud del campo
						//echo "Se regresa longitud:= ".substr($arr[$ren][1],$pi+1,($pf-$pi)-1);
						return substr($arr[$ren][1],$pi+1,($pf-$pi)-1);
					}
			}
			return false;	
		}
		// Devolvemos los procesos estrat�gicos
		function devolverProcesos_Estrategicos(){
			$this->conexion->executeSQL("select * from proc_estrategicos ORDER BY Id_Proc_Estrategico");
			return $this->conexion->getArray();
		}
		// Devolver procesos clave del proceso estrat�gico
		function devolverProcesos_Clave($Id_Proc_Estrategico){
			$this->conexion->executeSQL("select Id_Proc_Clave,Pc_Nombre from proc_claves where Id_Proc_Estrategico=".$Id_Proc_Estrategico);
			return $this->conexion->getArray();
		}
		// Devuelve el contenido de una alguna accion basandose en determinada meta
		function devolverAccion($Id_Meta,$Num_Accion){
			$this->conexion->executeSQL("Select Ac_descripcion from Acciones where Id_Meta=$Id_Meta and Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion));
			return $this->conexion->error();
		}
		// Guardar la acci�n det. de la meta det.
		function guardarAccion($Id_Meta,$Num_Accion,$Ac_Descripcion){
			$this->conexion->executeSQL("update Acciones set Ac_Descripcion='".$Ac_Descripcion."' where Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)."");
			return $this->conexion->error();
		}
		// Saber id de la accion "uno","dos","tres",etc. de la meta determinada
		// Los indices de las acciones deben empezar desde el registro con Id="1"
		// puesto que desde ese indice empezar� a buscar las coincidencias
		function saberIdAccion($Id_Meta,$Id_Num_Accion){
			$this->conexion->executeSQL("call saberIdAccion($Id_Meta,$Id_Num_Accion,@error); select @error");
			return $this->conexion->error();
		}
		// Funsci�n para devolver todas las Acciones de una Meta
		function devolverAcciones($Id_Meta){
			$this->conexion->executeSQL("select Ac_Descripcion,Id_Accion from Acciones where Id_Meta=$Id_Meta order by Id_Accion");
			return $this->conexion->getArray();
		}
		// Devuelve datos b�sicos para la pagina metas-accioes
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
										 WHERE proc_estrategicos.Id_Proc_Estrategico ='.$Id_Proc_Estrategico.' ORDER BY	Id_Meta');
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
				return "Inserci�n correcta";
			else
				return "Hubo un error al insertar la relaci�n";
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
		// Devuelve el Id de la meta que corresponda con la descripci�n dada
		function devIdMeta($Me_Nombre){
			$this->conexion->executeSQL("select Id_Meta from metas where Me_Nombre='$Me_Nombre'");
			return $this->conexion->error();
		}
		// Eliminar una meta con todas sus acciones
		function eliminarMeta($Id_Meta){
			$this->conexion->executeSQL("call eliminarMeta($Id_Meta,@error); select @error");
			return $this->conexion->error();
		}
		// Existen Insumos Cargados()
		function existenInsumosCargados($Us_Nick,$Id_Accion){
			$this->conexion->executeSQL("select count(Id_Insumo_Accion) from Insumos_Acciones inner join (Acciones inner join (Acciones_POA inner join (POA inner join Usuarios on Usuarios.Id_Usuario=POA.Id_Usuario)on POA.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion
where Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=$Id_Accion");

			if($this->conexion->error()>0)
				return 1;
			else
				return 0;
		}
		// Guardar los insumos seleccionados en el POA 
		function guardarInsumosPOA($Us_Nick,$Id_Accion,$insumos,$cantidades){
			$this->conexion->executeSQL("delete Insumos_Acciones.*
			from Insumos_Acciones inner join (Acciones inner join (Acciones_POA inner join (POA inner join Usuarios on Usuarios.Id_Usuario=POA.Id_Usuario)on POA.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion
where Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=$Id_Accion");

			
			$error="bien";
			//echo "count insumos ".count($insumos)."<br>";
			//echo "count cantidades ".count($cantidades)."<br>";			
			for($i=0;$i<count($insumos);$i++){
$this->conexion->executeSQL("call guardarInsumosPOA('$Us_Nick',".$insumos[$i].",".$Id_Accion.",".$cantidades[$i][0].",".$cantidades[$i][1].",@error); select @error;");
				//echo "[".$_SESSION['consulta']."]<br>";
				if($this->conexion->error()!=1&&$error=="bien")
					$error=$this->conexion->erroraiz();
			}
			if($error="bien")
				return 1;
			else
				return $error;
		}
		// Prodedimiento para dar formato tipo moneda
		function convertirFMoneda($cadena){
			// Guardamos la cadena redondeando los decimales a 2
			$subCadena=sprintf("%.2f",$cadena);
	
			// Encontramos la posicion del punto
			$posPunto=strpos($subCadena,'.');
			
			// Variable para los decimales
			$decimales=substr($subCadena,$posPunto+1,2);
			
			// Parte entera
			$enteros=substr($subCadena,0,$posPunto);
			
			// Guardamos el primer grupo incompleto a 3 
				//por ejemplo 
					//3 de 3,456
					//34 de 34,567
					 
			// Calculamos el residuo de primer grupo sobre 3 
			$residuo=strlen($enteros)%3;
			$incompletos="";
			switch ($residuo){
				case 0:
					$incompletos="";
					break;
				case 1:
					$incompletos=substr($enteros,0,1);
					if(floor(strlen($enteros)/3)>0)
						$incompletos.=",";
					break;
				case 2:
					$incompletos=substr($enteros,0,2);
					if(floor(strlen($enteros)/3)>0)
						$incompletos.=",";
					break;
	
			}
			
			// Cilo para dar comillas a las tercias de enteros
			$numComas="";
			for($i=0;$i<floor(strlen($enteros)/3);$i++){
				$numComas=$numComas.substr($enteros,$residuo+(3*$i),3);
				if(($i+1)<floor((strlen($enteros)/3)))
					$numComas=$numComas.",";
			}
			
			return "$ ".$incompletos.$numComas.".".$decimales;
		}
		// Funcion para determinar los capitulos de quien existen insumos agregados en un POA
		function partidasCargadas($Us_Nick,$Id_Meta,$Id_Accion){
			$this->conexion->executeSQL("select DISTINCT(partidas.Id_Partida)
from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida
where Us_Nick='$Us_Nick' and Id_Meta=$Id_Meta and Insumos_Acciones.Id_Accion=$Id_Accion order by partidas.Id_Partida");
			return $this->conexion->getArray();
		}
		// Funci�n para separar los capitulos 
		function separarCapitulos($partidas){
			$capitulo=substr($partidas[0][0],0,1);
			$capitulos[0]=substr($partidas[0][0],0,1);
			$id=1;
			for($i=0;$i<count($partidas);$i++){
				if(substr($partidas[$i][0],0,1)!=$capitulo){
					$capitulo=substr($partidas[$i][0],0,1);
					$capitulos[$id]=substr($partidas[$i][0],0,1);
					$id++;
				}
			}
			return $capitulos;
		}
		// Devolver Insumos Cargados
		function devolverInsumosCargados($Id_Partida,$Us_Nick,$Id_Accion){
			$this->conexion->executeSQL("select Insumos.In_Nombre,Id_Unidad_Medida,In_Precio,Ia_Cantidad1,Ia_Cantidad2 from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida where Insumos.Id_Partida=$Id_Partida and Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=$Id_Accion order by Insumos.In_Nombre");
			return $this->conexion->getArray();
		}
		// Devolver el nombre de una medida
		function devolverNombreMedida($Id_Medida){
			$this->conexion->executeSQL("select Un_Nombre from medidas where Id_Unidad_Medida=$Id_Medida");
			return $this->conexion->error();
		}
		// Calcular Total de POA
		function calcularTotal($Us_Nick){
			$this->conexion->executeSQL("select Insumos.In_Precio,Ia_Cantidad1,Ia_Cantidad2,Insumos_Acciones.Id_Insumo,Insumos_Acciones.Id_Accion from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida where Us_Nick='$Us_Nick'");
			
			return $this->conexion->getArray();
		}
		function calcularTotalMeta($Us_Nick,$Id_Meta){
			$this->conexion->executeSQL("select Insumos.In_Precio,Ia_Cantidad1,Ia_Cantidad2,Insumos_Acciones.Id_Insumo from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida where Us_Nick='$Us_Nick' and Acciones.Id_Meta=$Id_Meta");
			
			$totales=$this->conexion->getArray();
			
			$total=0;
			for($i=0;$i<count($totales);$i++){	
				$total+=$totales[$i][0]*($totales[$i][1]+$totales[$i][2]);
			}
			return $total;
		}
		function devolverTotalAccion($Us_Nick,$Id_Accion){
			$this->conexion->executeSQL("select In_Precio,Ia_Cantidad1,Ia_Cantidad2 from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida where Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=$Id_Accion");
			$arreg=$this->conexion->getArray();
			$total=0;
			for($i=0;$i<count($arreg);$i++)
				$total+=$arreg[$i][0]*($arreg[$i][1]+$arreg[$i][2]);
			return $this->convertirFMoneda($total);
		}
		// Devolver los capitulos de los insumos agregados en el poa seg�n esta meta y esta acci�n y este usuario
		function devolverCapitulosPOA($Us_Nick,$Id_Meta,$Num_Accion){
			$this->conexion->executeSQL("select DISTINCT(Insumos.Id_Partida) from partidas inner join (insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Partida=Partidas.Id_Partida where Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)." order by Insumos.Id_Partida");
			
			$partidas=$this->conexion->getArray();
			
			$capitulo=substr($partidas[0][0],0,1);
			$capitulos[0]=substr($partidas[0][0],0,1);
			$id=1;
			for($i=0;$i<count($partidas);$i++){
				if(substr($partidas[$i][0],0,1)!=$capitulo){
					$capitulo=substr($partidas[$i][0],0,1);
					$capitulos[$id]=substr($partidas[$i][0],0,1);
					$id++;
				}
			}
			return $capitulos;
		}
		// Devuelve los insumos cargados en POA de meta,accion, y capitulo determinado
		function devolverInsumosPOA($Us_Nick,$Id_Capitulo,$Id_Meta,$Num_Accion){
			$this->conexion->executeSQL("select DISTINCT(Insumos.In_Nombre),Un_Nombre,Insumos.Id_Partida,Insumos_Acciones.Id_Insumo from medidas inner join(insumos inner join (insumos_acciones inner join (acciones inner join (acciones_poa inner join (poa inner join usuarios on usuarios.Id_Usuario=poa.Id_Usuario)on poa.Id_Poa=Acciones_POA.Id_Poa)on Acciones_POA.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo=Insumos.Id_Insumo)on Insumos.Id_Unidad_Medida=medidas.Id_Unidad_Medida where Us_Nick='$Us_Nick' and substring(Insumos.Id_Partida,1,1)='$Id_Capitulo' and Insumos_Acciones.Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)." order by Id_Partida,Insumos.In_Nombre");
			return $this->conexion->getArray();
		}// Devuelve lo que resta de un insumo en una requisici�n
		function devolverResto($Us_Nick,$Id_Insumo,$Id_Meta,$Num_Accion){
		    $this->conexion->executeSQL("select sum(Ia_Cantidad1),sum(Ia_Cantidad2) from 
Insumos_Acciones inner join (Acciones inner join (Acciones_POA inner join (POA inner join Usuarios on Usuarios.Id_Usuario=POA.Id_Usuario)on POA.Id_Poa=Acciones_Poa.Id_Poa)on Acciones_Poa.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion where Id_Insumo=$Id_Insumo and Us_Nick='$Us_Nick' and Insumos_Acciones.Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)."");
			$resultado=$this->conexion->getArray();
			$pedido=$resultado[0][0]+$resultado[0][1];
			
		    $this->conexion->executeSQL("select sum(Di_Disminucion)
from disminuciones inner join(Insumos_Acciones inner join (Acciones inner join (Acciones_POA inner join (POA inner join Usuarios on Usuarios.Id_Usuario=POA.Id_Usuario)on POA.Id_Poa=Acciones_Poa.Id_Poa)on Acciones_Poa.Id_Accion=Acciones.Id_Accion)on Acciones.Id_Accion=Insumos_Acciones.Id_Accion)on Insumos_Acciones.Id_Insumo_Accion=Disminuciones.Id_Insumo_Accion where Id_Insumo=$Id_Insumo and Us_Nick=$Us_Nick and Insumos_Acciones.Id_Accion=".$this->saberIdAccion($Id_Meta,$Num_Accion)." ");
			$gastado=$this->conexion->error();
			
			return $pedido-$gastados;
		}

	}
?>
