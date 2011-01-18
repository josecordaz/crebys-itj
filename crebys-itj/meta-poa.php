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
							
							hola
							
							<!-- InstanceEndEditable --></td>
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

<div id="area2">
	<div id="parte-izquierda">
    	<div class="izquierda"><span class="subtitulo">Procesos Estratégicos</span></div>
        <br/>
        <div id="menu-vertical">
            <?php
                $proc_est=$proc->devolverProcesos_Estrategicos();
                    for($i=0;$i<count($proc_est);$i++){
                        if(!isset($_GET['proc-est'])&&$i==0){
                            echo "<a class='link-selected' href='meta-poa.php?proc-est=".$proc_est[$i][0]."'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                        }else{
                            if($proc_est[$i][0]==$_GET['proc-est'])
                                echo "<a class='link-selected' href='meta-poa.php?proc-est=".$proc_est[$i][0]."'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                            else
                                echo "<a class='link-unselected' href='meta-poa.php?proc-est=".$proc_est[$i][0]."'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        echo "<br>";
                        echo "<br>";
                    }
    
            ?>
        </div>
	</div>
    <div id="parte-derecha">
    	<div class="menup-partida2">
            <ul>
				<?php
					$metas=array();
					if(!isset($_GET['proc-est']))
						$metas=$proc->devolverMetasPE(2);
					else
						$metas=$proc->devolverMetasPE($_GET['proc-est']);
						
                    if(isset($_GET['meta']))
                        $_SESSION['meta']=$_GET['meta'];
                    for($e=0;$e<count($metas);$e++){
                        if(!isset($_GET['meta'])&&$e==0){
                            echo "<li class='current-partida'><a href=''><span>Meta ".$metas[$e][0]."</span></a></li>";
                            $_SESSION['meta']=$metas[$e][0];
                        }else{
                            if($metas[$e][0]==$_SESSION['meta'])
                                echo "<li class='current-partida'><a href=''><span>Meta ".$metas[$e][0]."</span></a></li>";
                            else
                                echo "<li ><a href='meta-poa.php?proc-est=".$_GET['proc-est']."&meta=".$metas[$e][0]."'><span>".$metas[$e][0]."</span></a></li>";
                        }
                    }
                ?>
            </ul>
		</div>
        <div id="info-meta3">
        	<div class="detalle-meta">
           		<span class="label-detalle">Departamento:</span> 
				<br/>
                <br/>
                <br/>
	        	<span class="label-detalle">Proceso Estratégico:</span>
                <br/>
                <br/>
                <br/>
            	<span class="label-detalle">Proceso Clave: </span>
                <br/>
                <br/>
                <br/>
  	        	<span class="label-detalle">Descripción de la meta:</span>
            </div>
            <div id="detalles2">
    			<span class="res-detalle">Desarrollo Académico</span>
	            <br/>
    	        <br/>
                <br/>
        	    <span class="res-detalle">Académico</span>
				<br/>
	            <br/>
                <br/>
	            <span class="res-detalle">Formación Docente</span>
	            <br/>
                <br/>
	            <br/>
				<span class="res-detalle">Gestionar y Fomentar que el 100% de los directivos y personal de apoyo y asistencia a la educación participen en cursos de capacitación y desarrollo.</span>
                
            </div>
    	</div>
    </div>
    <div class="centrado">
		<div id="line-up-cen">    	
            <br/>
            <input value="Aceptar" name="aceptar" type="button"/>
            <input value="Cancelar" name="cancelar" type="button"/>
            <br/>
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
