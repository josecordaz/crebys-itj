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

	// La siguiente variable se utilizar� como temporal
	// para guardar la meta en la que se est� trabajando 
	// actulmente.
	if(isset($_GET['meta']))
		$_SESSION['meta']=$_GET['meta'];
	else
		$_SESSION['meta']=1;
	
	// Librer�a para Procedimientos
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
        <a name="pe"/>
        <a href="/crebys-itj/jefe.php" class="menu-off">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="/crebys-itj/poa.php#pe" class="menu-off">POA</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="#pe" class="menu-on">Agregar Meta-Accion</a>
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
    <div class="izquierda"><span class="subtitulo">Procesos Estrat�gicos:</span></div>
    <br/>
	<div>
    	<?php
        	$proc_est=$proc->devolverProcesos_Estrategicos();
				for($i=0;$i<count($proc_est);$i++){
					if(!isset($_GET['proc-est'])&&$i==0){
						echo "<a class='link-selected' href='meta-poa2.php?proc-est=".$proc_est[$i][0]."#pe'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
					}else{
						if($proc_est[$i][0]==$_GET['proc-est'])
							echo "<a class='link-selected' href='meta-poa2.php?proc-est=".$proc_est[$i][0]."#pe'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
						else
							echo "<a class='link-unselected' href='meta-poa2.php?proc-est=".$proc_est[$i][0]."#pe'>".$proc_est[$i][1]."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
					}
				}

		?>
    </div>
 	<br/>
   	<div class="izquierda"><span class="subtitulo">Metas</span></div>
   	<br/>
    <?php
		$metas=array();
		if(!isset($_GET['proc-est']))
			$metas=$proc->devolverMetasPE(2);
		else
			$metas=$proc->devolverMetasPE($_GET['proc-est']);
		if(count($metas)==0)
			echo "No existen metas para este proceso estrat�gico";
		else{
    ?>
    <div class="menup">
	<ul>
    <?php
		if(isset($_GET['meta']))
			$_SESSION['meta']=$_GET['meta'];
		for($e=0;$e<count($metas);$e++){
			if(!isset($_GET['meta'])&&$e==0){
				echo "<li class='current'><a href=''><span>Meta ".$metas[$e][0]."</span></a></li>";
				$_SESSION['meta']=$metas[$e][0];
			}else{
				if($metas[$e][0]==$_SESSION['meta'])
					echo "<li class='current'><a href=''><span>Meta ".$metas[$e][0]."</span></a></li>";
				else
					if(isset($_GET['proc-est']))
						echo "<li ><a href='meta-poa2.php?proc-est=".$_GET['proc-est']."&meta=".$metas[$e][0]."#pe'><span>".$metas[$e][0]."</span></a></li>";
					else
						echo "<li ><a href='meta-poa2.php?proc-est=2&meta=".$metas[$e][0]."#pe'><span>".$metas[$e][0]."</span></a></li>";
			}
		}
		?>
    	</ul>
		</div>
	<div style="clear:both"></div>
    <div id="divmeta">    
	
    	<div id="info-meta"></font></font>
             <?php
	           	$namep=$proc->datosMeta($_SESSION['meta']);
				if(count($metas)==0)
					echo "No existen metas";
				else{
					?>
					Proceso Estrat�gico:
					<div class="info">
					<?php
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
					Descripci�n:
					<div class="info">
					  <?php
						echo $namep[0][0];
					?>
		</div>
					<br/>

    				</div>
        			<form action="accion.php" method="post">
   					<div id="acciones-meta">
                    <div class="divtextcentrado">
                    	<span class="espaciorayado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    	<span class="sub-titulo">Acciones</span>
                       	<span class="espaciorayado">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </div>
					<?php 
						$acciones=array();
						$acciones=$proc->devolverAcciones($_SESSION['meta']);
						if(count($acciones)==0){
							echo "No existen Acciones para esta meta";
							echo "<br>";
							echo "<br>";
						}
						else
						{
							for($i=0;$i<count($acciones);$i++){
								if((isset($_GET['accion'])&&$_GET['accion']==($i+1))||(!isset($_GET['accion'])&&$i==0)){
echo "<input type='radio'  name='raccion' value='".($i+1)."' onchange=\"location ='meta-poa2.php?proc-est=".$_GET['proc-est']."&meta=".$_SESSION['meta']."&accion='+this.value+'#pe'\" checked>";
									$tmp_accion=($i+1);
									}
								else
									if(isset($_GET['proc-est']))
										echo "<input type='radio'  name='raccion' value='".($i+1)."' onchange=\"location ='meta-poa2.php?proc-est=".$_GET['proc-est']."&meta=".$_SESSION['meta']."&accion='+this.value+'#pe'\">";
									else
										echo "<input type='radio'  name='raccion' value='".($i+1)."' onchange=\"location ='meta-poa2.php?proc-est=2&meta=".$_SESSION['meta']."&accion='+this.value+'#pe'\">";
									
								echo "<span class='titaccion'>A-".($i+1).":</span>";
							
					?>
			    		        <div class="cortita">
    	    		   			<hr>
		        			    </div>
				        		<div class="info">
                	
							<?php
    			                echo $acciones[$i][0];
	            	            echo "</div>";
                            }
					?>

            
            		<br/>        
		<?php 
			}}
		?>
	        	        
	       	<div >
	       	  
            	
                
            </div>    
		</div>
		
        </form>
		</div>
        <div class="centrado">
		<div id="line-up-cen">    	
            <br/>
            <input value="Agregar" name="agregar" type="button" onclick="location='redir-meta-poa2.php?meta=<?php echo $_SESSION['meta']?>&accion=<?php 
				if(isset($_GET['accion']))
					echo $_GET['accion'];
				else
					echo $tmp_accion;
			?>'"/>
            <input value="Cancelar" name="cancelar" type="button" onclick="location='poa.php#pe'"/>
            <br/>
            <br/>
        </div>
    </div>
        <?php
		}
		?>
    
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
