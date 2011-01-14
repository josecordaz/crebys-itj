<?php
	// Inicamos la sesion
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	// Si no existe la variable de sesión redir
	if(!isset($_SESSION['nick'])){
		// Redireccionamos a login.php
		header("Location: http://$host$uri/login.php");
	}
	
	
		// Libreria para la utilización de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
	
	// Si recivimos la variable $_get['meta']
	if(isset($_GET['meta']))
		$namep=$proc->datosMeta($_GET['meta']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" -->
<title>Crebys-ITJ(Crontrol de requisiciones de bienes y servicios del ITJ) </title>
<link href="ITJStyle.css" rel="stylesheet" type="text/css" />
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
                            	<img alt="" class="style5" src="recursos/Img/BannerSup/izq.png" />
                          	</td>
                            <td class="style9" colspan="2">
                            	<img alt="" class="style8" src="recursos/Img/BannerSup/centrosup.png" />
                          	</td>
                            <td rowspan="2">
                            	<img alt="" class="style7" src="recursos/Img/BannerSup/der.png" />
                            </td>
                        </tr>
                        <tr>
                        	<td class="style11">
                            	<img src="recursos/Img/BannerSup/centroinf.png" class="style12" /></td>
                          	<td>&nbsp;</td>
                      	</tr>
                   </table>
                   <table>
                    	<tr>
                        	<td>
                            	<img src="recursos/Img/BannerSup/BannerBicentenario.jpg" width="900" height="120" />
                            </td>
                        </tr>
                   </table>
                   <table class="style16" bgcolor="#FFFFFF" border="0">
                    	<tr>
                        	<td rowspan="2" class="style17"><img alt="" src="recursos/Img/Titulo.png" style="width: 510px; height: 50px" /></td>
                            <td class="style19" rowspan="2">&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                        	<td><!-- InstanceBeginEditable name="Bienvenida" -->
<?php
		// Bienvenido al usuario
    	echo "Bienvenido ".$_SESSION['nick']."<p>";
		echo "Jefe del departamento de ";
		// Mostramos el departamento al cual pertenece el usuario a partir de su nick
		echo $proc->saberDepartamento($_SESSION['nick']);
		// Eliminamos la cookie de usuario
		unset($_POST['usuario']);

?>

<!-- InstanceEndEditable --></td>
                        </tr>
                    </table>
              	</td>
            </tr>
            <tr>
                <td class="style2" bgcolor="#FF9900"><!-- InstanceBeginEditable name="menu" -->

        <!--Mostramos la opcion Procedimientos-->
        <a href="/crebys-itj/jefe.php" class="menu-off">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/meta-accion.php" class="menu-off">Metas-Acciones</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/sesion-off.php" class="menu-off">Cerrar Sesi&oacute;n</a>
		

                <!-- InstanceEndEditable --></td>
            </tr>
            <tr bgcolor="#FFFFFF">
            	<td align="center">
								<table width="85%" >
            			<tr align ="center">
										<td align ="center">  					
											<!-- #BeginEditable "RE" -->
											

                                            

                                            
<div id="tres">
	<span id="titulo">Meta</span>
    	<div>
    	<?php
			if(isset($_COOKIE['error'])){
				echo "<hr id='corta'/>";
				echo $_COOKIE['error'];
				unset($_COOKIE['error']);
			}
        ?>
    </div>                    
	<hr id="corta"/>
    <form action="redir-meta.php" method="post">	                
    	<br/>
        <div id="caja-peque">
                        
            <div class="caja-left">
                Proceso Estratégico:
                <select name="proc-estr" class="s-cortoddd" onchange="location = 'redir-meta.php?proc-est='+this.value">
                <option value="0"></option>
                	<?php

						$arr=array();
						$arr=$proc->devolverProcesos_Estrategicos();
						for($i=0;$i<count($arr);$i++){
								if(isset($_SESSION['proc-est'])&&$_SESSION['proc-est']==$arr[$i][0])
			                    	echo "<option value=\"".$arr[$i][0]."\" selected=\"selected\">".$arr[$i][1]."</option>";
								elseif(isset($namep)&&$namep[0][3]==$arr[$i][0]){
									echo "<option value=\"".$arr[$i][0]."\" selected=\"selected\">".$arr[$i][1]."</option>";
									$_SESSION['proc-est']=$arr[$i][0];
								}
								else						
			    	                echo "<option value=\"".$arr[$i][0]."\">".$arr[$i][1]."</option>";
						}

					?>
                </select>
            </div>
            <br/>
            <div class="caja-left">
                Proceso Clave:
                <select name="proc-clav">
                <?php
					$arre=array();
					if(isset($namep)){
						$arre=$proc->devolverProcesos_Clave($namep[0][3]);
					}
					else	
						$arre=$proc->devolverProcesos_Clave($_SESSION['proc-est']);
					for($i=0;$i<count($arre);$i++)
							if(isset($_SESSION['proc-clave'])&&$_SESSION['proc-clave']==$arre[$i][1])
								echo "<option value='".$arre[$i][0]."' selected=\"selected\">".$arre[$i][1]."</option>";
							elseif(isset($namep)&&$namep[0][1]==$arre[$i][1]){
								echo "<option value='".$arre[$i][0]."' selected=\"selected\">".$arre[$i][1]."</option>";
								$_SESSION['proc-clave']=$namep[0][7];
							}else
								echo "<option value='".$arre[$i][0]."'>".$arre[$i][1]."</option>";
				?>
                </select>
            </div>
            <br/>
            <div class="caja-left">
            	<div>
                Unidad de Medida:
                </div>
                <div>
                <?php
				if(isset($namep)){
					echo "<textarea id=\"unidadmed\" name=\"unidad-m\">".$namep[0][4]."</textarea>";
					$_SESSION['unidad-meta']=$namep[0][4];
				}
				else
					if(isset($_SESSION['unidad-meta']))
						echo "<textarea id=\"unidadmed\" name=\"unidad-m\">".$_SESSION['unidad-meta']."</textarea>";
					else
						echo "<textarea id=\"unidadmed\" name=\"unidad-m\"></textarea>";
				?>
                </div>
            </div>
            <br/>
            <div class="caja-left">
                Cantidad:
				 <?php
				 if(isset($namep)){
				 	echo "<input name=\"cantidadmeta\" value=".$namep[0][5].">";
					$_SESSION['cantidad-meta']=$namep[0][5];
				}
				 else
				 	if(isset($_SESSION['cantidad-meta']))
						echo "<input name=\"cantidadmeta\" value=".$_SESSION['cantidad-meta'].">";
					else
						echo "<input name=\"cantidadmeta\" >";
				?>
            </div>
            <br/>
            <div class="caja-left">
            	<div>
                Descripción de la meta:
                </div>
                <div>
                 <?php
				 	if(isset($namep)){
						echo "<textarea id=\"textarea\" name=\"descrip-meta\" >".$namep[0][6]."</textarea>";
						$_SESSION['desc-meta']=$namep[0][6];
					}
					else
						if(isset($_SESSION['desc-meta']))
							echo "<textarea id=\"textarea\" name=\"descrip-meta\" >".$_SESSION['desc-meta']."</textarea>";
						else	
							echo "<textarea id=\"textarea\" name=\"descrip-meta\" ></textarea>";
				?>
                </div>
            </div>
        </div>
        <hr id="corta"/>
        <br/>
        <div class="caja">
        	<?php
            	if(isset($namep)||isset($_SESSION['proc-est']))
					echo "<input type='submit' name='guardar' value='Guardar'/>";
				else
					echo"<input type='submit' name='agregar' value='Agregar'/>";
			?>
			<input type="button" name="cancelar" value="Cancelar"/>
        </div>
        <br/>                    
         </form>
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
                                	© 2010<span lang="es-mx"> Im&aacute;genes y Desarrollo propiedad intelectual del ITJ<br />
                                    Última Actualización: 02/12/2010
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
