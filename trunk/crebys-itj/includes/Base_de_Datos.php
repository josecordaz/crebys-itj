<?php
	//Clase para el manejo de la Base de datos
	class Base_de_datos{
		//Guardamos el nombre del servidor
		private $server="";
		//Guardamos el nombre de usuario
		private $usuario='';
		//Guardamos la contraseña del usuario
		private $password="";
		//Guardamos el nombre de la base de datos
		//a la que nos conectaremos
		private $bd="";
		//Guardamos la conexión con el 
		//servidor de Base de Datos
		private $conexion;
		//Guardamos la consulta SQL 
		private $sql;
		//Guardamos el resultado de la 
		//consulta SQL
		private $resSQL;
		//Guardamos el numero de 
		//registros devueltos por la 
		//consulta SQL
		private $numReg;
		//Guardamos el numero de campos devueltos
		//por la consulta SQL
		private $numCampos;
		//Constructor donde se necesita
		// Dirección del servidor de base de datos
		// Nombre del usuario
		// Contraseña del usuario
		// para realizar la conexión
		private $resArray;
		public $error;
		function __construct($server,$usuario,$password,$bd){
			$this->resArray= array();
			$this->server=$server;
			$this->usuario=$usuario;
			$this->password=$password;
			$this->bd=$bd;
			try { 
				if(!($this->conexion=@mysqli_connect($this->server,$this->usuario,$this->password,$this->bd))) {
					throw new Exception('No se pudo conectar al servidor'); 
				}
			 } catch(Exception $e) {
					die($e->getMessage()."".mysqli_connect_error());
			 }
		}
		//Establecemos y ejecutamos una consulta SQL
		function executeSQL($sql){
			// echo "La consulta es(".$sql.")<br>";
			$res=$this->conexion->multi_query($sql);
//			$this->error=@mysqli_error($this->conexion);
			//$this->error=mysqli_error(mysqli_multi_query($sql,$this->conexion));
			if($res){
			$fila=0;
				do{
					if($result=$this->conexion->store_result()){
						while($row=$result->fetch_row()){
							$columna=0;		
							foreach ($row as $cell){
								$this->resArray[$fila][$columna]=$cell;
								$columna++;
							}
							$fila++;
						}
						$result->close();
					}
				}while ($this->conexion->next_result());
			}
		}
		// Validamos los datos de inicio de sesion
		function iniciarSesion($us_nick,$us_password){
				$this->executeSQL("call iniciarSesion('$us_nick','".md5($us_password)."',@error); select @error");
				switch($this->error()){
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
		
		
		//Mostramos el resultado de la consulta SQL
		function mostrarResSQL(){
			for($fila=0;$fila<count($this->resArray);$fila++){
				for($col=0;$col<count($this->resArray[$fila]);$col++)
					echo $this->resArray[$fila][$col]."<br>";
				echo "<p><p>";
			}
        }
        //Retorna el valor de la variable error 
        //contenida en los procedimientos almacenados
        function error(){
        	return $this->resArray[0][0];
        }
        //Obtiene el arreglo de 
        //resultados de la consulta
        //ejecutada
        function getArray(){
        	return $this->resArray;
        }
		function desconectar(){
			$this->conexion->close();
		}
		//Error raiz
		public  function erroraiz(){
			$var=mysqli_error($this->conexion);
			return $var;
		}
		function getCxn(){
			return $this->conexion;
		}
	}
	
	//Programa principal
	
	//$conexion=new base_de_datos("localhost","root","","crebys-itj");
//	$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
//	$path=$DOCUMENT_ROOT."/CREBYS-ITJ/instalacion/install_proc.sql";
//	$conexion->executeSQL("LOAD DATA INFILE ".$path.";");
	//echo mysqli_error($conexion->getCxn());
	
	//echo $conexion->isConectado();
	//echo $conexion->iniciarSesion("sony_karl","20021605035");
	

	
	
	//$conexion->mostrarResSQL();
	//echo ($conexion->erroraiz());
	//$conexion->desconectar();

?>
