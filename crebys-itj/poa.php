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
		<a href="/crebys-itj/meta-poa.php" class="menu-off">Agregar Meta</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/requisiciones.php" class="menu-off">Agregar Partida</a>
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
											

                                            

                                            
	<div id="area">
    
    <div class="menup">
	<ul>
        <li class="current"><a href="#"><span>Meta 1</span></a></li>
        <li ><a href="#"><span>M2</span></a></li>
        <li ><a href="#"><span>M3</span></a></li>
        <li ><a href="#"><span>M4</span></a></li>
        <li ><a href="#"><span>M5</span></a></li>        
    </ul>
	</div>
	<div style="clear:both"></div>
    <div id="divmeta">    
    	<div id="info-meta2">
        	<div class="detalle-meta">
           		<span class="label-detalle">Departamento:</span> 
				<br/>
                <br/>
	        	<span class="label-detalle">Proceso Estratégico:</span>
                <br/>
                <br/>
            	<span class="label-detalle">Proceso Clave: </span>
                <br/>
                <br/>
            </div>
            <div id="detalles">
    			<span class="res-detalle">Desarrollo Académico</span>
	            <br/>
    	        <br/>
        	    <span class="res-detalle">Académico</span>
				<br/>
	            <br/>
	            <span class="res-detalle">Formación Docente</span>
	            <br/>
	            <br/>
            </div>
            <div id="desc-meta">
	        	<span class="label-detalle">Descripción de la meta:</span>
				<div class="info2">Gestionar y Fomentar que el 100% de los directivos y personal de apoyo y asistencia a la educación participen en cursos de capacitación y desarrollo.
                </div>
            </div>
    	</div>
        
       	<div id="insumos-meta2">
        
        	<div class="menup-partida">
				<ul>
        			<li class="current-partida"><a href="#"><span>Acción 1</span></a></li>
		    	    <li ><a href="#"><span>Acción 2</span></a></li>
		        	<li ><a href="#"><span>Acción 3</span></a></li>
			        <li ><a href="#"><span>Acción 4</span></a></li>
                    <span>[+] Expandir todo</span>
			    </ul>
			</div>
            <div style="clear:both"></div>
            <div id="desc-accion">
	        	<span class="label">Descripción:</span>
				<div class="info2">Fortalecer el programa de actualización profesional a través de la incorporación de un modelo de actualización profesional basado en competencias profesionales.
                </div>
            </div>
            <div id="info-partida">
			<span class="label-partida"><a class="label-partida" href="#">[+] Partida 2101:</a></span>
            <br/>
		    	<div id="tabla-partida">
                	<div class="renglon2">
                        <div class="celda">Nombre</div>
                        <div class="celda">Unidad de Medida</div>
                        <div class="celda">Precio Unitario</div>                        
                        <div class="celda">Cantidad</div>                        
                        <div class="celda">Subtotal</div>
                    </div>
                    <div class="renglon2">
                        <div class="celda2">Caja para archivo muerto tamaño oficio</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 68.00</div>
                        <div class="celda2">6</div>
                        <div class="celda2">$408.00</div>
                    </div>
                    <div class="renglon3">
                        <div class="celda2">Carpeta de 3 argollas</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 72.00</div>
                        <div class="celda2">80</div>
                        <div class="celda2">$5,760.00</div>
                    </div>
                    <div class="subtotal">
	                    <div class="agregar-insumo">
              	            <input type="button" value="Agregar"/>
                        </div>
        	            Subtotal $ 6,168.00
                    </div>
   		        </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
   			<span class="label-partida"><a class="label-partida" href="#">[+] Partida 2101:</a></span>
            <br/>
		    	<div id="tabla-partida">
                	<div class="renglon2">
                        <div class="celda">Nombre</div>
                        <div class="celda">Unidad de Medida</div>
                        <div class="celda">Precio Unitario</div>                        
                        <div class="celda">Cantidad</div>                        
                        <div class="celda">Subtotal</div>
                    </div>
                    <div class="renglon2">
                        <div class="celda2">Caja para archivo muerto tamaño oficio</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 68.00</div>
                        <div class="celda2">6</div>
                        <div class="celda2">$408.00</div>
                    </div>
                    <div class="renglon3">
                        <div class="celda2">Carpeta de 3 argollas</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 72.00</div>
                        <div class="celda2">80</div>
                        <div class="celda2">$5,760.00</div>
                    </div>
                    <div class="subtotal">
	                    <div class="agregar-insumo">
              	            <input type="button" value="Agregar"/>
                        </div>
        	            Subtotal $ 6,168.00
                    </div>
   		        </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
			<span class="label-partida"><a class="label-partida" href="#">[+] Partida 2101:</a></span>
            <br/>
		    	<div id="tabla-partida">
                	<div class="renglon2">
                        <div class="celda">Nombre</div>
                        <div class="celda">Unidad de Medida</div>
                        <div class="celda">Precio Unitario</div>                        
                        <div class="celda">Cantidad</div>                        
                        <div class="celda">Subtotal</div>
                    </div>
                    <div class="renglon2">
                        <div class="celda2">Caja para archivo muerto tamaño oficio</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 68.00</div>
                        <div class="celda2">6</div>
                        <div class="celda2">$408.00</div>
                    </div>
                    <div class="renglon3">
                        <div class="celda2">Carpeta de 3 argollas</div>
                        <div class="celda2">Pieza</div>
                        <div class="celda2">$ 72.00</div>
                        <div class="celda2">80</div>
                        <div class="celda2">$5,760.00</div>
                    </div>
                    <div class="subtotal">
	                    <div class="agregar-insumo">
              	            <input type="button" value="Agregar"/>
                        </div>
        	            Subtotal $ 6,168.00
                    </div>
                    <div class="subtotal-accion">
                    	<span class="lineasupcorta">Subtotal Acción 1: $ 18,504.00</span>
                    </div>
                    <div class="subtotal-meta">
                    	<span class="lineasupcorta">Subtotal Meta 1: $ 36,504.00</span>
                    </div>
                    <div class="total">
                    	<span class="lineasupcorta">Total : $ 72,504.00</span>
                    </div>
   		        </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        	</div>
        </div>
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
