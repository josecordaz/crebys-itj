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

	// La siguiente variable se utilizará como temporal
	// para guardar la meta en la que se está trabajando 
	// actulmente.
	if(isset($_GET['meta']))
		$_SESSION['meta']=$_GET['meta'];
	else
		$_SESSION['meta']=1;
	
	// Librería para Procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	// Objeto 
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
    <?php
		$metas=array();
		$metas=$proc->devolverMetas();
		for($e=0;$e<count($metas);$e++){
			if($metas[$e][0]==$_SESSION['meta'])
		    	echo "<li class='current'><a href=''><span>M".$metas[$e][0]."</span></a></li>";
			else
	    		echo "<li ><a href='meta-accion.php?meta=".$metas[$e][0]."'><span>M".$metas[$e][0]."</span></a></li>";
		}
	?>
    </ul>
	</div>
	<div style="clear:both"></div>
    <div id="divmeta">    
	
    	<div id="info-meta"></font></font>
        	<br/>
	        Proceso Estratégico:
            <div class="info">
              <?php
            	$namep=$proc->datosMeta($_SESSION['meta']);
				echo $namep[0][2];
			?>
            </div>
            <br/>
            Proceso Clave:
            <div class="info">
              <?php
				echo $namep[0][1];
            ?>
            </div>
            <br/>
        	Descripción:
			<div class="info">
			  <?php
				echo $namep[0][0];
            ?>
</div>
                        	<div ><input type="button" value="Editar" /></div>

            <br/>

    	</div>
        <form action="accion.php" method="post">
       	<div id="insumos-meta">
		<?php 
			$acciones=array();
			$acciones=$proc->devolverAcciones($_SESSION['meta']);
			for($i=0;$i<count($acciones);$i++){
				echo "<input type='radio' name='raccion' value='".($i+1)."' />";
				echo "<span class='sub-titulo'>Accion ".($i+1).":</span>";
		?>
	            <div class="cortita">
    	       	<hr>
        	    </div>
        		<div class="info">
                	
		<?php
        	   	echo $acciones[$i][0];
		?>
	        	</div>	
            
            	<br/>        
		<?php 
			}
		?>
	        	        
	       	<div >
                <input type="button" value="Agregar" />
            	<input type="submit" value="Editar" />
                <input type="button" value="Eliminar" />
            </div>    
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
