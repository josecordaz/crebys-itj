<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "doctitle" -->
<title>Documento sin t&iacute;tulo</title>
<!-- #EndEditable -->
<link href="/ITJStyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	.blur{
   	background-color: #ccc; /*shadow color*/
	  color: inherit;
  	margin-left: 4px;
	  margin-top: 4px;
	}

	.shadow, .content{
   	position: relative;
   	bottom: 2px;
   	right: 2px;
	}

	.shadow{
   	background-color: #666; /*shadow color*/
   	color: inherit;
	}

	.content{
  	background-color: #fff; /*background color of content*/
  	color: #000; /*text color of content*/
  	border: 1px solid #000; /*border color*/
  	padding: .5em 2ex;
	} 
	#form1{
    	height: 23px;
    }
    body{
    	font-family: Verdana;
    	font-size: 11px;
    	font-weight: normal;
    	font-style: normal;
    	font-variant: normal;
    	text-transform: none;
    	color: #000000;
    	background-color: #293563;
    }
    .nuevoEstilo1{
    }
    .style1{
    	padding: 4px 0 4 0;
    	width: 900px;
    	height: 135px;
    	text-align: center; 
    }
    .style2{
		height: 24px;
    }
           
    .FondoTabla{
    	width: 900px;
    	vertical-align: middle;
    	height: 90px;
    	background-color: #666666;
    }
    .style5{
    	width: 139px;
    	height: 89px;
	}
    .style6{
    	text-align: center;
    }
    .style7{
    	width: 103px;
    	height: 90px;
    }
    .style8{
    	width: 658px;
    	height: 42px;
    }
    .style9{
    	height: 39px;
    	background:white;
    }
    .style11{
    	text-align: right;
    }
    .style12{
    	float: left;
    	height: 43px;
    }
    .style13{
    	width: 900px;
    	text-align: center;
    }
    .style16{
    	width: 900px;
    	height: 56px;
    }
    .style17{
    	width: 492px;
    	font-family: Arial;
    }
    .style19{
    	width: 73px;
    }
</style>
</head>

<body>
	<div>
    	<table align="center" class="style1">
        	<tr>
            	<td>
                	<table cellpadding="0" cellspacing="0" class="FondoTabla">
                      	<tr>
                        	<td class="style6" rowspan="2">
                            	<img alt="" class="style5" src="/Img/BannerSup/izq.png" />
                            </td>
                            <td class="style9" colspan="2">
                            	<img alt="" class="style8" src="/Img/BannerSup/centrosup.png" />
                            </td>
                            <td rowspan="2">
                            	<img alt="" class="style7" src="/Img/BannerSup/der.png" />
                            </td>
                        </tr>
                        <tr>
                        	<td class="style11">
                            	<img src="/Img/BannerSup/centroinf.png" class="style12" />                            </td>
                          <td>&nbsp;</td>
                      </tr>
                  	</table>
                  	<table>
                    	<tr>
                        	<td>
                            	<img src="/Img/BannerSup/BannerBicentenario.jpg" width="900" height="120" />
                            </td>
                        </tr>
                    </table>
                    <table class="style16" bgcolor="#FFFFFF" border="0">
                    	<tr>
                        	<td rowspan="2" class="style17"><img alt="" src="/Img/Titulo.png" style="width: 510px; height: 50px" /></td>
                            <td class="style19" rowspan="2">&nbsp;</td>
                            <td>&nbsp;</td>
                      </tr>
                        <tr>
                        	<td>Inicio</td>
                        </tr>
                    </table>
              	</td>
            </tr>
            <tr>
                <td class="style2" bgcolor="#FF9900"><!-- InstanceBeginEditable name="menu" -->
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                <!-- InstanceEndEditable -->Menu 2</td>
            </tr>
            <tr bgcolor="#FFFFFF">
            	<td>
								<table width="85%">
            			<tr>
										<td>  					
											<!-- #BeginEditable "RE" -->
											<div class="blur">
											<p>&nbsp;</p>
											<div class="shadow">
											<div class="content"><?php
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
		//Guardamos la conexión conexión con el 
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
					die($e->getMessage());
			 }
		}
		//Establecemos la base de datos que vamos a utilizar
		function usarBd($bd){
			$this->bd=$bd;
			try { 
				if(!($this->enlace=@mysql_select_db($this->bd,$this->conexion)))
					throw new Exception('No se pudo usar la base de datos'); 
			}catch(Exception $e) {
					die($e->getMessage().' ~ '.$this->bd.' ~ ');
			 }
		}
		//Establecemos y ejecutamos una consulta SQL
		function executeSQL($sql){
			//echo "La consulta es(".$sql.")<br>";
			$res=$this->conexion->multi_query($sql);
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
	}
	
	//Programa principal
	
	$conexion=new base_de_datos("localhost","root","","crebys-itj");
	//$conexion->executeSQL("call insInsumo('Caramelo',45.56,'Pieza',1,@error);select @error");
	//$conexion->mostrarResSQL();
	
	//echo $conexion->isConectado();
	$conexion->executeSQL("select * from Insumos");
	$conexion->mostrarResSQL();
	$conexion->desconectar();

?>
</div>
											<p>&nbsp;</p>
                                            </div>
											</div>
											<!-- #EndEditable -->
            				</td>
            			</tr>
            		</table>
                    <table class="style13">
                    	<tr>
                         	<td>
                            	<span style="font-size: 7pt; color: #000099; vertical-align: top; text-align: center;">
                                	INSTITUTO TECNOLÓGICO DE JIQUILPAN<br />
                                    Av. Carr. Nacional s/n Km. 202 Jiquilpan de Juárez, Michoacán <span lang="es-mx">
                                    C.P. 59510</span><br />
                                    Tels: 01(353) 533 11 26, 533 05 74, 533 23 48, 533 36 08, 533 11 26 y 533 30 91
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 7pt; color: #000099; vertical-align: top; text-align: center;">
                                	© 2010<span lang="es-mx"> Imágenes y Desarrollo propiedad intelectual del ITJ<br />
                                    Última Actualización: 7/09/2010
                                    <br />
                                    webmasteritj@itjiquilpan.edu.mx
                                 </span></span>
                           	</td>
                        </tr>
                    </table>
                    <br />
              	</td>
            </tr>
        </table>
	</div>
</body>
<!-- InstanceEnd --></html>
