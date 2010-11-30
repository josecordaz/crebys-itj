<?php

	// Incluimos la libreria para hacer la conexion con la base de datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_datos.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "doctitle" -->
<title>Documento sin t&iacute;tulo</title>
<!-- #EndEditable -->
<link href="../ITJStyle.css" rel="stylesheet" type="text/css" />
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
                            	<img alt="" class="style5" src="../recursos/Img/BannerSup/izq.png" />
                          </td>
                            <td class="style9" colspan="2">
                            	<img alt="" class="style8" src="../recursos/Img/BannerSup/centrosup.png" />
                          </td>
                            <td rowspan="2">
                            	<img alt="" class="style7" src="../recursos/Img/BannerSup/der.png" />
                            </td>
                        </tr>
                        <tr>
                        	<td class="style11">
                            	<img src="../recursos/Img/BannerSup/centroinf.png" class="style12" />                            </td>
                          <td>&nbsp;</td>
                      </tr>
                  	</table>
                  	<table>
                    	<tr>
                        	<td>
                            	<img src="../recursos/Img/BannerSup/BannerBicentenario.jpg" width="900" height="120" />
                            </td>
                        </tr>
                    </table>
                    <table class="style16" bgcolor="#FFFFFF" border="0">
                    	<tr>
                        	<td rowspan="2" class="style17"><img alt="" src="../recursos/Img/Titulo.png" style="width: 510px; height: 50px" /></td>
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
											<div class="content">
                                            
                                            <?php 
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
				echo "Creado correctamente<p>";
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
