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
	
	// Librería para manipulación de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
	
	if($_GET['cap'])
		$_SESSION['cap']=$_GET['cap'];

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
        <a name="pe">
        <a href="/crebys-itj/admin.php" class="menu-off">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="/crebys-itj/poa.php#pe" class="menu-off">POA</a>
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
	<div id="titulo">Insumos en POA</div>
    <div class="sub-titulo">
    	<?php
        	echo "Meta[".$_SESSION['meta']."]&nbsp;";
        	echo "Acción:=[".$proc->NumAccion($_SESSION['accion-cargar'])."]<br><br>";
		?>
    </div>
    <div id="insumos-meta2">
		 <div class="menup">
		 	<ul>
            	<?php
					// Guardamos las unidades de mendida
					$unidades_medida=$proc->devolverMedidas();
					for($i=1;$i<6;$i++)
						if(isset($_GET['cap'])&&$_GET['cap']==$i||!isset($_GET['cap'])&&$i==1){
							echo "<li class='current'><a href'#'><span>".$i."0,000</span></a></li>";
							$insumos=$proc->devDatosInsumos($i);    	
						}
						else
							echo "<li ><a href='cargar-insumos-poa.php?cap=".$i."#pe'><span>".$i."0,000</span></a></li>";	
				?>
	    	</ul>
		</div>
	<div style="clear:both"></div>
	<div id="area-partidas">
		
     <?php
     	if(isset($_GET['cap']))
			$capitulo=$_GET['cap'];
		else
			$capitulo=1;
	 ?>

        <div id="titulo-area-partidas">
            <div id="titulo-capitulo">
            	<span class="subtitulo2">Este es el titulo del capitulo 10,000</span>
            </div>
            <div id="atajo">
                Atajo:
                <?php
				    $id_partida=$insumos[0][0];
					$Pa_Nombre=$insumos[0][6];
echo "<select name='atajos' class='s-corto' onchange=\"location='cargar-insumos-poa.php?cap=".$capitulo."&cip-'+this.value+'='+this.value+'#'+this.value\">";
					echo "<option value=0></option>";
                	for($i=0;$i<count($insumos);$i=$i+1){
						if($insumos[$i][0]!=$id_partida){ // If para verificar si se ha cambiado de partida					
		                	echo "<option value='$id_partida'>$id_partida - $Pa_Nombre </option>";
						    $id_partida=$insumos[$i][0];
							$Pa_Nombre=$insumos[$i][6];
						}
					}
                	echo "<option value='$id_partida'>$id_partida - $Pa_Nombre </option>";
				?>
               </select>
            </div>
        </div>
        <div class="linea-larga">
        	<hr class="color-linea-larga">
        </div>
<?php

    $id_partida=$insumos[0][0];
	$Pa_Nombre=$insumos[0][6];
	echo "<div id='tabla-partida-cip'>";
		if(!isset($_GET['cip-'.$id_partida])&&!isset($_SESSION['cip-'.$id_partida])){
			echo "<span class='label-partida'><a name='".$id_partida."'><a class='label-partida' href='cargar-insumos-poa.php?cap=".$capitulo."&cip-".$id_partida."=".$id_partida."#".$id_partida."'>[+] Partida ".$id_partida.": \"".$Pa_Nombre."\"</a></span>";
		}else{
			$_SESSION['cip-'.$id_partida]=$id_partida;
			echo "<span class='label-partida'><a name='".$id_partida."'><a name='$id_partida'/><a class='label-partida' href='redir-cargar-insumos-poa.php?cap=".$capitulo."&cip=".$id_partida."#".$id_partida."'>[-] Partida ".$id_partida.": \"".$Pa_Nombre."\"</a> </span>";
?>

			<div class="renglon-blanco">
    			<div class="celda-azul">Agregar</div>
    			<div class="celda-azul">Nombre</div>
	            <div class="celda-azul">Unidad de Medida</div>
                <div class="celda-azul">
 					<div class="tit-cantidades">Cantidades</div>
                    <div class="tit-sem">Sem 1</div>
                    <div class="tit-sem">Sem 2</div>
                </div>
	            <div class="celda-azul">Precio Unitario</div>
                <div class="celda-azul">Subtotal</div>
	        </div>
<?php
		}
// For para recorrer todos los insumos
for($i=0;$i<count($insumos);$i=$i+1){
	if($insumos[$i][0]!=$id_partida){ // If para verificar si se ha cambiado de partida
		$id_partida=$insumos[$i][0];
		$Pa_Nombre=$insumos[$i][6];
		if(isset($_GET['cip-'.$insumos[$i-1][0]])||isset($_SESSION['cip-'.$insumos[$i-1][0]])){
 ?>
	   		<div class="subtotal">
				<div class="agregar-insumo">

		        </div>
			</div>
<?php
		}
		echo "</div>";
		echo "<div id='tabla-partida-cip'>";
		if(!isset($_GET['cip-'.$id_partida])&&!isset($_SESSION['cip-'.$id_partida])){
			echo "<span class='label-partida'><a name='".$id_partida."'><a class='label-partida' href='cargar-insumos-poa.php?cap=".$capitulo."&cip-".$id_partida."=".$id_partida."#".$id_partida."'>[+] Partida ".$id_partida.": \"".$Pa_Nombre."\"</a></span>";
		}else{
			$_SESSION['cip-'.$id_partida]=$id_partida;
			echo "<span class='label-partida'><a name='".$id_partida."'><a name='$id_partida'/><a class='label-partida' href='redir-cargar-insumos-poa.php?cap=".$capitulo."&cip=".$id_partida."#".$id_partida."'>[-] Partida ".$id_partida.": \"".$Pa_Nombre."\"</a> </span>";
?>
						<div class="renglon-blanco">
    			<div class="celda-azul">Agregar</div>
    			<div class="celda-azul">Nombre</div>
	            <div class="celda-azul">Unidad de Medida</div>
                <div class="celda-azul">
 					<div class="tit-cantidades">Cantidades</div>
                    <div class="tit-sem">Sem 1</div>
                    <div class="tit-sem">Sem 2</div>
                </div>
	            <div class="celda-azul">Precio Unitario</div>
                <div class="celda-azul">Subtotal</div>
						</div>
                        <?php
			}
		}
		if(isset($_GET['cip-'.$id_partida])||isset($_SESSION['cip-'.$id_partida])){
			if(($i%2)==0||$insumos[$i][0]!=$id_partida){
				echo "<div class='renglon-blanco'>";
					echo "<div class='celda-normal'>";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'id_insumo']))
							echo "<a name='".$insumos[$i][1]."'><input type='checkbox' onChange=\"location= 'redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."'\" checked='checked'/>";							
						else
							echo "<a name='".$insumos[$i][1]."'><input type='checkbox' onChange=\"location= 'redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."'\"/>";
					echo "</div>";
					echo "<div class='celda-normal'>".$insumos[$i][2]."</div>";
					echo "<div class='celda-normal'>";
						echo "<select class='tit-medida' name='sel-".$insumos[$i][1]."' onchange=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&Un_Medida='+this.value\">";
							for($e=0;$e<count($unidades_medida);$e++){
								if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'un_medida']))
									if($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'un_medida']==$unidades_medida[$e][0])
								    	echo "<option  value=".$unidades_medida[$e][0]." selected='selected'>".$unidades_medida[$e][0]."</option>";										
									else
										echo "<option  value=".$unidades_medida[$e][0].">".$unidades_medida[$e][0]."</option>";
								elseif($unidades_medida[$e][0]==$insumos[$i][4])
								    	echo "<option  value=".$insumos[$i][4]." selected='selected'>".$unidades_medida[$e][0]."</option>";
									else
										echo "<option  value=".$unidades_medida[$e][0].">".$unidades_medida[$e][0]."</option>";
							}
						echo "</select>";
					echo "</div>";
					echo "<div class='celda-normal'>";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']))
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant1='+this.value\" value=".$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1'].">";
						else
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant1='+this.value\">";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']))
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant2='+this.value\" value=".$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2'].">";
						else
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant2='+this.value\">";
					echo "</div>";
					echo "<div class='celda-normal'>$ ".$insumos[$i][5]."</div>";
					echo "<div class='celda-normal'>";
						$subtotal1=0;
						$subtotal2=0;
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']))
							$subtotal1=$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']*$insumos[$i][5];
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']))
							$subtotal2=$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']*$insumos[$i][5];
						echo "$ ".($subtotal1+$subtotal2)."";
					echo "</div>";
				echo "</div>";
			}else{
				echo "<div class='renglon-morado'>";
					echo "<div class='celda-normal'>";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'id_insumo']))
							echo "<a name='".$insumos[$i][1]."'><input type='checkbox' onChange=\"location= 'redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."'\" checked='checked'/>";							
						else
							echo "<a name='".$insumos[$i][1]."'><input type='checkbox' onChange=\"location= 'redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."'\"/>";
					echo "</div>";
					echo "<div class='celda-normal'>".$insumos[$i][2]."</div>";
					echo "<div class='celda-normal'>";
						echo "<select class='tit-medida' name='sel-".$insumos[$i][1]."' onchange=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&Un_Medida='+this.value\">";
							for($e=0;$e<count($unidades_medida);$e++){
								if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'un_medida']))
									if($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'un_medida']==$unidades_medida[$e][0])
								    	echo "<option  value=".$unidades_medida[$e][0]." selected='selected'>".$unidades_medida[$e][0]."</option>";										
									else
										echo "<option  value=".$unidades_medida[$e][0].">".$unidades_medida[$e][0]."</option>";
								elseif($unidades_medida[$e][0]==$insumos[$i][4])
								    	echo "<option  value=".$insumos[$i][4]." selected='selected'>".$unidades_medida[$e][0]."</option>";
									else
										echo "<option  value=".$unidades_medida[$e][0].">".$unidades_medida[$e][0]."</option>";
							}
						echo "</select>";
					echo "</div>";
					echo "<div class='celda-normal'>";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']))
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant1='+this.value\" value=".$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1'].">";
						else
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant1='+this.value\">";
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']))
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant2='+this.value\" value=".$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2'].">";
						else
							echo "<input type='text' class='at-corto'/ onblur=\"location='redir-guardar-variables.php?id_insumo=".$insumos[$i][1]."&cant2='+this.value\">";
					echo "</div>";
					echo "<div class='celda-normal'>$ ".$insumos[$i][5]."</div>";
					echo "<div class='celda-normal'>";
						$subtotal1=0;
						$subtotal2=0;
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']))
							$subtotal1=$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant1']*$insumos[$i][5];
						if(isset($_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']))
							$subtotal2=$_SESSION["".$_SESSION['accion-cargar'].$insumos[$i][1].'cant2']*$insumos[$i][5];
						echo "$ ".($subtotal1+$subtotal2)."";
					echo "</div>";
				echo "</div>";
			}
			$id_i=$i;
		}
}
		if(isset($_GET['cip-'.$id_partida])||isset($_SESSION['cip-'.$id_partida])){
?>
        <div class="subtotal">
            <div class="agregar-insumo">

                </div>
            </div>
        </div>
        <?php
		}
		?>
	</div>
</div>

</div>

	<div class="centrado">
		<div id="line-up-cen">    	
            <br/>
            <input value="Agregar" name="agregar" type="button" onclick="location='poa.php'"/>
            <input value="Cancelar" name="cancelar" type="button" onclick="location='poa.php#pe'"/>
            <br/>
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
