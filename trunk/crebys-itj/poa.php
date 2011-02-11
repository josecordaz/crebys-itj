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
	
	if(isset($_GET['meta']))
		$_SESSION['meta']=$_GET['meta'];
	else 
		$_SESSION['meta']=1

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
       	<a name="pe"/>
        <a href="/crebys-itj/jefe.php" class="menu-off">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/meta-poa2.php#pe" class="menu-off">Agregar Relación Meta - Acción</a>
        &nbsp;
        &nbsp;
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
											

                                            

	<div id="titulo">POA</div>     
    <div class="sub-titulo">Programa Operativo Anual</div>
	<div id="area">
 	<?php
				$metas=$proc->devolverMetasPOA($_SESSION['nick']);
			//echo ":::[".$_SESSION['consulta']."]:::";
if(count($metas)!=0){    
	?>   
    <div class="menup">
	<ul>
    	<?php

        	for($i=0;$i<count($metas);$i++){
				if($metas[$i][0]==$_GET['meta']||($i==0&&(!isset($_GET['meta'])))){
					echo "<li class='current'><a href='#'><span>Meta ".$metas[$i][0]."</span></a></li>";
					if(($i==0&&(!isset($_GET['meta']))))
						$tmp_meta=$metas[$i][0];
				}
				else
					echo "<li ><a href='poa.php?meta=".$metas[$i][0]."#pe'><span>M ".$metas[$i][0]."</span></a></li>";
			}
		?>
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
            	<?php 
					if(isset($_GET['meta']))
						$dmetas=$proc->datosMeta($_GET['meta']);
					else
						$dmetas=$proc->datosMeta($tmp_meta);
				?>
    			<span class="res-detalle"><?php echo $proc->saberDepartamento($_SESSION['nick']);?></span>
	            <br/>
    	        <br/>
        	    <span class="res-detalle"><?php echo $dmetas[0][2]?></span>
				<br/>
	            <br/>
	            <span class="res-detalle"><?php echo $dmetas[0][1]?></span>
	            <br/>
	            <br/>
            </div>
            <div id="desc-meta">
	        	<span class="label-detalle">Descripción de la meta:</span>
				<div class="info2"><?php echo $dmetas[0][0]?>
                </div>
            </div>
    	</div>
        
       	<div id="insumos-meta2">
        
        	<div class="menup-partida">
				<ul>
                	<?php
						if(isset($_GET['meta']))
	                    	$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$_GET['meta']);
						else
	                    	$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$tmp_meta);
						//echo "sql:=[".count($accionesMeta)."]";
						//echo "count de acciones:=[".count($accioensMeta)."]";
						for($i=0;$i<count($accionesMeta);$i++)
							if($proc->numAccion($accionesMeta[$i][1])==$_GET['accion']||(($i==0)&&(!isset($_GET['accion'])))){
								echo "<li class='current-partida'><a href='#'><span>Acción ".$proc->numAccion($accionesMeta[$i][1])."</span></a></li>";
								$id_accion=$i;
								// Se guardar esta variable para utilizarla al cargar insumos para esta acción
								$_SESSION['accion-cargar']=$accionesMeta[$i][1];
							}
							else
					    	    echo "<li ><a href='poa.php?meta=".$_SESSION['meta']."&accion=".($i+1)."#pe'><span>A - ".$proc->numAccion($accionesMeta[$i][1])."</span></a></li>";
					?>
                    <span>[+] Expandir todo</span>
			    </ul>
			</div>
            <div style="clear:both"></div>
            <div id="info-partida">
            	<div id="desc-accion">
	        		<span class="label">Descripción:</span>
					<div class="info2"><?php echo $accionesMeta[$id_accion][0]?>
    	            </div>
        	    </div>

			<?php
					//echo "nick:= $_SESSION[nick]"."  - accion".$_SESSION['accion-cargar']."<br>";
                	if($proc->existenInsumosCargados($_SESSION['nick'],$_SESSION['accion-cargar'])>0){
						// Obtenemos las partidas en Insumos_Acciones
						$partidas=$proc->partidasCargadas($_SESSION['nick']);
						// Extraemos los capitulos de las partidas
						$capitulos=$proc->separarCapitulos($partidas);
						// Ordenamos los capitulos
						sort($capitulos);
?>
		 <div class="menup-partida">
		 	<ul>
            	<?php
					for($i=0;$i<count($capitulos);$i++)
						if((isset($_GET['cap'])&&$_GET['cap']==$capitulos[$i])||(!isset($_GET['cap'])&&$i==0))
							echo "<li class='current-partida'><a href'#'><span>".$capitulos[$i]."0,000</span></a></li>";
						else
							echo "<li ><a href='poa.php?cap=".$capitulos[$i]."#pe'><span>".$capitulos[$i]."0,000</span></a></li>";	
				?>
	    	</ul>
		</div>
    <?php                
		// Imprimimos los insumos organizados por partidas
		for($i=0;$i<count($partidas);$i++){
			// Cargamos las partidas que correspondan con el capitulo seleccionado
			if(substr($partidas[$i][0],0,1)==$_GET['cap']||(!isset($_GET['cap'])&&substr($partidas[$i][0],0,1)==1)){
			echo "<div id=\"tabla-partida-poa\">";
				// Mostramos las partidas que correspondan con el capitulo seleccionado
				echo "<span class=\"label-partida\">[-] Partida ".$partidas[$i][0].":</span>";
				// Obtenemos los insumos cargados de esta partida
				$insumos=$proc->devolverInsumosCargados($partidas[$i][0],$_SESSION['nick'],$_SESSION['accion-cargar']);
				
				// Ciclo para crear las variables de session de los insumos cargados
				
				$ses_insumos=$proc->calcularTotal($_SESSION['nick']);
				for($a=0;$a<count($ses_insumos);$a++){
					$_SESSION[$ses_insumos[$a][4].$ses_insumos[$a][3].'id_insumo']=$ses_insumos[$a][3];
					$_SESSION[$ses_insumos[$a][4].$ses_insumos[$a][3].'cant1']=$ses_insumos[$a][1];
					$_SESSION[$ses_insumos[$a][4].$ses_insumos[$a][3].'cant2']=$ses_insumos[$a][2];
				}
				
				
				// Mostramos la barra de titulos Insumos -- Unidad de Medida -- Cantidad -- Precio -- Subtotal
?>

			<div class="renglon-titulos">
				<div class="celda3">Nombre</div>
				<div class="celda3">Unidad de Medida</div>
				<div class="celda3">Precio Unitario</div>
				<div class="celda3">Cantidad</div>
				<div class="celda3">Subtotal</div>
		    </div>
<?php
				// Ciclo para imprimir los insumos de este partida
				for($e=0;$e<count($insumos);$e++){
					if($e%2==0){
						echo "<div class=\"renglon-blanco-corto\">";
							echo "<div class=\"celda4\">".$insumos[$e][0]."</div>";
							echo "<div class=\"celda4\">".$proc->devolverNombreMedida($insumos[$e][1])."</div>";
							echo "<div class=\"celda4\">".$proc->convertirFMoneda($insumos[$e][2])."</div>";
							echo "<div class=\"celda4\">".($insumos[$e][3]+$insumos[$e][4])."</div>";					
							echo "<div class=\"celda4\">".$proc->convertirFMoneda(($insumos[$e][4]+$insumos[$e][3])*$insumos[$e][2])."</div>";						
						echo "</div>";
					}else{
						echo "<div class=\"renglon-morado-corto\">";
							echo "<div class=\"celda4\">".$insumos[$e][0]."</div>";
							echo "<div class=\"celda4\">".$proc->devolverNombreMedida($insumos[$e][1])."</div>";
							echo "<div class=\"celda4\">".$proc->convertirFMoneda($insumos[$e][2])."</div>";
							echo "<div class=\"celda4\">".($insumos[$e][3]+$insumos[$e][4])."</div>";					
							echo "<div class=\"celda4\">".$proc->convertirFMoneda(($insumos[$e][4]+$insumos[$e][3])*$insumos[$e][2])."</div>";						
						echo "</div>";
					}
				}
				echo "<div class=\"sub-par\">".$proc->convertirFMoneda($_SESSION['sub-par-'.$partidas[$i][0]])."</div>";
		echo "</div>";
	}
}
				
	?>
<br/>
<div id="tabla-partida2">


        <br/>
        <br/>
            <div id="info-subtotales"><?php
				if(isset($_GET['cap']))
       				echo "<div class='subcap'>Capitulo ".$_GET['cap']."0,000 = ".$proc->convertirFMoneda($_SESSION['sub-cap-'.$_GET['cap']])."</div>";				
				else
					echo "<div class='subcap'>Capitulo ".$capitulos[0][0]."0,000 = ".$proc->convertirFMoneda($_SESSION['sub-cap-'.$capitulos[0][0]])."</div>";				
			?>
            
                <div class="total">
                    <span >Total : 
<?php       
					
             
					$arreglo=$proc->calcularTotal($_SESSION['nick']);
					$total=0;
					for($i=0;$i<count($arreglo);$i++)
						$total+=$arreglo[$i][0]*($arreglo[$i][1]+$arreglo[0][2]);
						
 					echo $proc->convertirFMoneda($total); 
?>					
                    </span>
                </div>
            </div>
        <br/>
</div>
                                        
                    <?php
				echo "<input type=\"button\" value=\"Modificar Insumos\" onclick=\"location='cargar-insumos-poa.php'\"/>";
}else
				echo "<input type=\"button\" value=\"Cargar Insumos\" onclick=\"location='cargar-insumos-poa.php'\"/>";	
				?>

			                
			<br/>
			<br/>
        	</div>
        </div>
	</div>
<?php
}else
	echo "Para iniciar a elaborar el POA haga click en 'Agregar Relación Meta - Acción'";
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
