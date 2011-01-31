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

	// Si se recive el id de un insumo es que se va a modificar
	if(isset($_GET['id_insumo']))
		$datosInsumo=$proc->devDatosInsumo($_GET['id_insumo']);
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
		<a href="/crebys-itj/poa.php" class="menu-on">POA</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/requisiciones.php" class="menu-off">Requisiciones</a>
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
	<span id="titulo">Insumo</span>                 
    	<?php
			if(isset($_COOKIE['error'])){
				echo "<br/>".$_COOKIE['error']."<br/>";
				unset($_COOKIE['error']);
			}
		?>
    
	<hr id="corta"/>
    
    <form action="guardar-insumo.php" method="post">	                
    	<br/>
        <div id="caja-peque">
                        
            <div class="caja-left">
                Partida:
                <select name="partida" class="s-corto" onchange="location = 'redir-insumo.php?partida='+this.value">
                <option value="0"></option>
                	<?php
						$arr=array();
						$arr=$proc->devolverPartidas();
						for($i=0;$i<count($arr);$i++)
							if(isset($_SESSION['partida'])&&$_SESSION['partida']==$arr[$i][0])
		                    	echo "<option value=\"".$arr[$i][0]."\" selected=\"selected\">".$arr[$i][0]."--".$arr[$i][1]."</option>";
							else
								if(count($datosInsumo)>0&&$arr[$i][0]==$datosInsumo[0][0])
									echo "<option value=\"".$arr[$i][0]."\" selected=\"selected\">".$datosInsumo[0][0]."--".$datosInsumo[0][6]."</option>";
								else
									if(isset($_GET['id_partida'])&&$arr[$i][0]==$_GET['id_partida'])
										echo "<option value=\"".$arr[$i][0]."\" selected=\"selected\">".$_GET['id_partida']." -- ".$arr[$i][1]."</option>";
									else
										echo "<option value=\"".$arr[$i][0]."\">".$arr[$i][0]."--".$arr[$i][1]."</option>";

					?>
                </select>
            </div>
            <br/>
            <div class="caja-left">
                Nombre:
                <?php
                if(isset($_SESSION['nombre'])){
					echo "<input name='insumo' onblur=\"location = 'redir-insumo.php?nombre='+this.value\" value='".$_SESSION['nombre']."'>";
				}
				elseif(count($datosInsumo)>0)
						echo "<input name='insumo' onblur=\"location = 'redir-insumo.php?nombre='+this.value\" value='".$datosInsumo[0][2]."'>";
					else{
						echo "<input name='insumo' onblur=\"location = 'redir-insumo.php?nombre='+this.value\">";
					}
				?>
            </div>
            <br/>
            <div class="caja-left">
                Unidad de Medida:
                <select name="unidad_de_medida" onchange="location = 'redir-insumo.php?medida='+this.value">
                <option value="0"></option>
				<?php
					$arrm=array();
					$arrm=$proc->devolverMedidas();
					for($i=0;$i<count($arrm);$i++)
						if(isset($_SESSION['medida'])&&$_SESSION['medida']==$arrm[$i][0])
							echo "<option value='".$_SESSION['medida']."' selected=\"selected\">".$_SESSION['medida']."</option>";
						elseif(count($datosInsumo)>0&&$arrm[$i][0]==$datosInsumo[0][4])
								echo "<option value='".$datosInsumo[0][4]."' selected=\"selected\">".$datosInsumo[0][4]."</option>";
							else
								echo "<option value=\"".$arrm[$i][0]."\">".$arrm[$i][0]."</option>";
				?>
                </select>
	            <input type="button" value="Agregar" onclick="location = 'unidad_m.php'"/>
            </div>
            <br/>
            <div class="caja-left">
                Precio:
                <?php
				if(isset($_SESSION['precio']))
					echo "<input name=\"precio\" onblur=\"location = 'redir-insumo.php?precio='+this.value\" value='".$_SESSION['precio']."'>";
				elseif(count($datosInsumo)>0)
						echo "<input name=\"precio\" onblur=\"location = 'redir-insumo.php?precio='+this.value\" value='".$datosInsumo[0][5]."'>";
					else
						echo "<input name=\"precio\" onblur=\"location = 'redir-insumo.php?precio='+this.value\">";
				?>
            </div>
            <br/>
        </div>
        <hr id="corta"/>
        <br/>
        <div class="caja">
            <input type="submit" name="aceptar" value="Agregar"/>

			<input type="button" name="cancelar" value="Cancelar" onclick="location='lista-insumos.php'"/>
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
