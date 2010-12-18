<?php
	// Inicamos la sesion
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	// Si no existe la variable de sesi�n redir
	if(!isset($_SESSION['nick'])){
		// Redireccionamos a login.php
		header("Location: http://$host$uri/login.php");
	}

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
    	echo "Bienvenido ".$_SESSION['nick'];
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
        <a href="/crebys-itj/admin.php" class="menu-on">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/meta.php" class="menu-off">Agregar Meta</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="/crebys-itj/accion.php" class="menu-off">Agregar Accion</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/sesion-off.php" class="menu-off">Cerrar Sesion</a>
		
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
        <li class="current"><a href="#"><span>M1</span></a></li>
        <li ><a href="#"><span>M2</span></a></li>
    </ul>
	</div>
	<div style="clear:both"></div>
    <div id="divmeta">    
	
    	<div id="info-meta"></font></font>
        	<br/>
	        Proceso Estrat�gico:
            <div class="info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Acad�mico</div>
            <br/>
            Proceso Clave:
            <div class="info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Formaci�n Docente</div>
            <br/>
        	Meta 28:
			<div class="info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gestionar y Fomentar que el 100% de los directivos y personal de apoyo y asistencia a la educaci�n participen en cursos de capacitaci�n y desarrollo.</div>
                        	<div ><input type="button" value="Editar" /></div>
            <br/>

    	</div>
        <form action="accion.php" method="post">
       	<div id="insumos-meta">
            <input type="radio" name="raccion" value="1" />
        	<span class="sub-titulo">Accion 1:</span>
            <div class="cortita">
            	<hr>
            </div>
        	<div class="info">
        		
                &nbsp;
                &nbsp;
                &nbsp;
                Coordinar,  verificar y administrar que personal directivo, funcionarios docentes y de apoyo participen en eventos de formaci�n y actualizaci�n profesional que coadyuve a su desarrollo integral.
			        
	        </div>	
            
            <br/>        
	        <input type="radio" name="raccion" value="2" /> 
        	<span class="sub-titulo">Accion 2:</span>
            <div class="cortita">
            	<hr>
            </div>
        	<div class="info">
        		
                &nbsp;
                &nbsp;
                &nbsp;
                Coordinar,  verificar y administrar que personal directivo, funcionarios docentes y de apoyo participen en eventos de formaci�n y actualizaci�n profesional que coadyuve a su desarrollo integral.
			        
	        </div>	
            <br/>        
	        <input type="radio" name="raccion" value="3" /> 
        	<span class="sub-titulo">Accion 3:</span>
            <div class="cortita">
            	<hr>
            </div>
        	<div class="info">
        		
                &nbsp;
                &nbsp;
                &nbsp;
                Coordinar,  verificar y administrar que personal directivo, funcionarios docentes y de apoyo participen en eventos de formaci�n y actualizaci�n profesional que coadyuve a su desarrollo integral.
			        
	        </div>	
            	<div ><input type="submit" value="Editar" /></div>    
		</div>
		
        </form>
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
