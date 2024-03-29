<?php

	// Incluimos la libreria para hacer la conexion con la base de datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_datos.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" -->
<title>Documento sin t&iacute;tulo</title>
<!-- #EndEditable -->

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
                            	<img src="../recursos/Img/BannerSup/centroinf.png" class="style12" /></td>
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
                        	<td><!-- InstanceBeginEditable name="Bienvenida" -->Bienvenida<!-- InstanceEndEditable --></td>
                        </tr>
                    </table>
              	</td>
            </tr>
            <tr>
                <td class="style2" bgcolor="#FF9900"><!-- InstanceBeginEditable name="menu" -->
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                <!-- InstanceEndEditable --></td>
            </tr>
            <tr bgcolor="#FFFFFF">
            	<td align="center">
								<table width="85%" >
            			<tr align ="center">
										<td align ="center">  					
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
		// Conexi�n a base de datos
		$conexion=new Base_de_datos("localhost","root","","crebys-itj");
		
		// Conexi�n al archivo de procedimientos.sql
		
		$fi= fopen($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/instalacion/Files/procedimientos.sql','r');

		// Ciclo para leer archivo
		
		while($linea=fgets($fi,1024)){
			// Guardamos la posicion de la linea
			// en la que encuentre el caracter [!]
			$pos_char=strpos($linea,"!");
			// Si no encuentra el simbolo [!]
			// Quiere decir que es parte del procedimiento Inicio-Contenido-Fin
			if(is_bool($pos_char)){
				// Posici�n del caracter [&]
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
						
						// Posici�n inicial del procedimiento
						$pos_ini=strpos($procedimiento, "PROCEDURE ")+10;	
						// Posici�n inicial del procedimiento
						$pos_fin=strpos($procedimiento, "(");
						
						// Posici�n final del procedimiento
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
			// Mostramos el procedimientos que se intent� crear en mayusculas
			echo "Creando procedimiento[".strtoupper($arr_nom_proc[$i])."]...";
			// Verificamos si el error que devolvi� fue de ya creado
			if (strpos($arr_errores[$i], "already exists")){
				// Mostramos que en procedimiento ya existia
				echo "[+] Procedimiento ya existente<p>";
			} // Vefiricamos si se creo correctamente el procedimiento
			elseif (strlen($arr_errores[$i])==0){
				// Mensaje de procedimiento creado correctamente
				echo "Creado correctamente<p>";
				// Incrementamos contador
				$crt_proc++;
			} // Si entra aqu� es que ocurri� algun error
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
                                	INSTITUTO TECNOL&Oacute;GICO DE JIQUILPAN<br />
                                    Av. Carr. Nacional s/n Km. 202 Jiquilpan de Ju&aacute;rez, Michoac&aacute;n <span lang="es-mx">
                                    C.P. 59510</span><br />
                                    Tels: 01(353) 533 11 26, 533 05 74, 533 23 48, 533 36 08, 533 11 26 y 533 30 91
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 7pt; color: #000099; vertical-align: top; text-align: center;">
                                	� 2010<span lang="es-mx"> Im&aacute;genes y Desarrollo propiedad intelectual del ITJ<br />
                                    �ltima Actualizaci�n: 02/12/2010
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
