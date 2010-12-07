<?php

	include_once 'Validar.php';
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
		function __construct($conexion){
			//Inicializamos la conexi�n a la base de datos
			$this->conexion=$conexion;
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
					$this->conexion->executeSQL("call insPartida('.$Id_Partida.','.$Pa_Nombre.',@error); select @error");
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
							$this->error="[-] El registro ya existe";	
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
					if($this->validar->validarCadena($In_Unidad_M, $this->sacarLongitud("Insumos","In_Unidad_M"))){
						if($this->validar->validarNumero($Id_Partida)){
							$this->conexion->executeSQL("call insInsumo('".$In_Nombre."',".$In_Precio.",'".$In_Unidad_M."',".$Id_Partida.",@error);select @error");
							switch ($this->conexion->error()){
							case 0:
								$this->error="[-] Error en la consulta";
								break;
							case 1:
								$this->error="[-] El insumo se insert� correctamente:
													Id_Insumo: ".$this->getId_Insumo($In_Nombre)."
													In_Nombre: ".$In_Nombre."
													In_Precio: ".$In_Precio."
													In_Unidad_M: ".$In_Unidad_M."
													Id_Partida: ".$Id_Partida;
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
						$this->error="[-] In_Unidad_M no v�lido";
				}else
					$this->error="[-] In_Precio no v�lido";
			}else 
				$this->error="[-] In_Nombre no v�lido";
			return 0;
		}
		//Funcion para la modificacion de un 
		//registro en la tabla Insumos 
		function modInsumo($arreglo){
			// Id_Insumo = 0
			// In_Nombre = 1
			// In_Precio = 2
			// In_Unidad_M = 3
			// Id_Partida = 4
			if($this->validar->validarNumero($arreglo[0])){
				if($this->validar->validarCadena($arreglo[1],$this->sacarLongitud("Insumos","In_Nombre"))){
					if($this->validar->validarDouble($arreglo[2])){
						if($this->validar->validarCadena($arreglo[3],$this->sacarLongitud("Insumos","In_Unidad_M"))){
							if($this->validar->validarNumero($arreglo[4])){
								$this->conexion->executeSQL("call modInsumo(".$arreglo[0].",'".$arreglo[1]."',".$arreglo[2].",'".$arreglo[3]."',".$arreglo[4].",@error); select @error");
								switch ($this->conexion->error()){
									case 0:
										$this->error="[-] Error en la consulta";
										break;
									case 1:
										$this->error="[-] El insumo se insert� correctamente:
													Id_Insumo: ".$this->getId_Insumo($arreglo[1])."
													In_Nombre: ".$arreglo[1]."
													In_Precio: ".$arreglo[2]."
													In_Unidad_M: ".$arreglo[3]."
													Id_Partida: ".$arreglo[4];
										return 1;
									case 2:
										$this->error="[-] No existe el insumo: ".$Id_Insumo;
										break;
									case 3:
										$this->error="[-] No existe la partida: ".$Id_Partida;																		
								}
							}else
								$this->error="[-] Id_Partida no v�lido";
						}else
							$this->error="[-] In_Unidad_M no v�lido";
					}else 
						$this->error="[-] In_Precio no v�lido";
				}else
					$this->error="[-] In_Nombre no v�lido";
			}else
				$this->error="[-] Id_Insumo no v�lido";
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
	}
	
?>