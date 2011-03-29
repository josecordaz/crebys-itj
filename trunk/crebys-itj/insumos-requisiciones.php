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
	
	// Aquí redireccionaremos a esta misma página
	// Esto con la intención de que siempre existan
	// 3 parámetros dentro del get
	$metas=$proc->devolverMetasPOA($_SESSION['nick']);
	
	if(!(isset($_GET['meta'])&&isset($_GET['accion'])&&isset($_GET['cap']))){
		$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$metas[0][0]);				
		$capitulosPOA=$proc->devolverCapitulosPOA($_SESSION['nick'],$metas[0][0],$proc->NumAccion($accionesMeta[0][1]));
	}
	
	// Si recivimos los tres parámetros	
	if(isset($_GET['meta'])&&isset($_GET['accion'])&&isset($_GET['cap'])){
		$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$_GET['meta']);	
		// Obtenemos todas las partidas de la meta, acicon y usuario señalado
		$capitulosPOA=$proc->devolverCapitulosPOA($_SESSION['nick'],$_GET['meta'],$_GET['accion']);
		
		// Verificamos si hubo un cambio de meta o accion
		if($_SESSION['res_accion']!=$_GET['accion']||$_SESSION['res_meta']!=$_GET['meta']){
			echo "entre";
			// Borramos las variables de session
				
			// Declaramos arreglo para respaldar $_SESSION
			$res_session=array();
		
			// Inicializamos el arreglo $res_session con los valores de $_SESSION
			$res_session=$_SESSION;
		
			// Ciclo para borrar las variables de session innesesarias
			foreach($res_session as $key => $value){
				// Verificamos que las variables de session 
				// inicien con 'cant-sol-' pues estas
				// guardan los valores de las variables
				// que se utilizaron para respaldar en la
				// elaboración de requisiciones
				if(substr($key,0,9)=='cant-sol-'){
					// Respaldamos el Id_Insumo
					$id_insumo=substr($key,9,strlen($key)-9);
					// Eliminamos la variable de sesion 
					// con insumo $id_insumo
					unset($_SESSION['cant-sol-'.$id_insumo.'']);
					//echo $key."<br>";
				}
			}
			// Respaldamos accion
			$_SESSION['res_accion']=$_GET['accion'];
			// Respaldamos meta
			$_SESSION['res_meta']=$_GET['meta'];
		}

		
		
	}else
	{
		header("Location: http://$host$uri/insumos-requisiciones.php?meta=".$metas[0][0]."&amp;accion=".$proc->NumAccion($accionesMeta[0][1])."&amp;cap=".$capitulosPOA[0]."#pa");
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
    	echo "Bienvenido ".$_SESSION['nick']."<p>&nbsp;<p>";
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
		<a href="/crebys-itj/requisiciones.php" class="menu-on">Requisiciones</a>
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
<a name="pe"></a>
<div id="titulo">Requisiciones</div>

<div id="separador">
	<div id="mismo-renglon">
	Los bienes o servicios están contemplados en el POA?
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;            
    </div>
    <div id="ckeck2">
    	Si
    	<input type="radio" name="contemplado" checked="checked"/>
        No
      	<input type="radio" name="contemplado"/>
    </div>
</div>
<p>&nbsp;</p>
<div class="menup">
<ul>
<?php
// Menu de Metas
	for($i=0;$i<count($metas);$i++)
		if($_GET['meta']==$metas[$i][0])
			echo "<li class=\"current\"><a href=\"#\"><span>Meta ".$metas[$i][0]."</span></a></li>";
		else
			echo "<li><a href=\"insumos-requisiciones.php?meta=".$metas[$i][0]."&amp;accion=".$proc->NumAccion($accionesMeta[0][1])."&amp;cap=".$capitulosPOA[0]."#pe\"><span>Meta ".$metas[$i][0]."</span></a></li>";
?>
</ul>
</div>
<div id="divmeta">
<?php
// Detalle de las Metas
	// Conocer de quien buscaremos los datos
	$datosMeta=$proc->datosMeta($_GET['meta']);
	// Mostramos los datos de la metas seleccionada
?>

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
            <span class="res-detalle"><?php echo $proc->saberDepartamento($_SESSION['nick']);?></span>
            <br/>
            <br/>
            <span class="res-detalle"><?php echo $datosMeta[0][2]?></span>
            <br/>
            <br/>
            <span class="res-detalle"><?php echo $datosMeta[0][1]?></span>
            <br/>
            <br/>
        </div>
        <div id="desc-meta">
            <span class="label-detalle">Descripción de la meta:</span>
            <div class="info2"><?php echo $datosMeta[0][0]?></div>
        </div>
    </div>	

<?php
	// Area para el menú de las acciones
		// Obtenemos las acciones de la meta seleccionada
       	$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$_GET['meta']);
?>
	<div class="menup-partida">
    	<ul>
<?php 
		//Respaldamos el indice de la accion que estamos activando para utilizarla posteriormente
		$respIdAccion=0;
		// Cargamos las acciones obtenidas
		for($i=0;$i<count($accionesMeta);$i++){
if($_GET['accion']==$proc->NumAccion($accionesMeta[$i][1])){
	echo "<li class=\"current-partida\"><a href=\"#\"><span>Accion ".$proc->NumAccion($accionesMeta[$i][1])."</span></a></li>";
	$respIdAccion=$i;
}
else{
	echo "<li><a href=\"insumos-requisiciones.php?meta=".$_GET['meta']."&amp;accion=".$proc->NumAccion($accionesMeta[$i][1])."&amp;cap=".$capitulosPOA[0]."#pe\"><span>Accion ".$proc->NumAccion($accionesMeta[$i][1])."</span></a></li>";
}
		}
?>
        </ul>
    </div>
    
<?php // Mostramos la información de la acción?>
    <div id="desc-accion">
    	<span class="label">Descripción:</span>
		<div class="info2"><?php echo $accionesMeta[$respIdAccion][0]?></div>
   	</div>
<?php // Establecemos una división ?>

<!--Cerramos divmeta-->
</div>

<div class="none-space"></div>
<a name="pa"></a>
<div id="insumos-disponibles">Insumos Disponibles</div>
<div class="none-space">
<?php
	// Espacio para mostrar error en caso de que hubiera                
	if(isset($_COOKIE['mensaje'])){
		echo $_COOKIE['mensaje'];
			echo "&nbsp;";
			echo "<a href=\"#".$_SESSION['insumo-pasado']."\">Ir al insumo</a>";
		echo "<br/>";
	}
?>
</div>



<?php
echo "Que está pasando por aquí";
echo "<form name=\"form1\" method=\"post\" action=\"redir-insumos-requisiciones.php?meta=".$_GET['meta']."&amp;accion=".$_GET['accion']."&amp;cap=".$_GET['cap']."\">";

        // Obtenemos los capitulos que tiene el POA en esta acción con este nick determinados
?>
        <div class="menup">
            <ul> 
    <?php
            for($i=0;$i<count($capitulosPOA);$i++)
                if($_GET['cap']==$capitulosPOA[$i])
                    echo "<li class=\"current\"><a href=\"#\"><span>".$capitulosPOA[$i]."0,000</span></a></li>";
                else
                    echo "<li ><a href=\"#\" ><span>".$capitulosPOA[$i]."0,000</span></a></li>";
                    
    ?>
            </ul>
        </div>
		<div id="info-partida2">            
	    <?php
    	    // Obtenemos los insumos de este usuario con esta meta con esta accion con este capitulo
	        $insumosPOA=$proc->devolverInsumosPOA($_SESSION['nick'],$_GET['cap'],$_GET['meta'],$_GET['accion']);
			//echo "[".$_SESSION['consulta']."]";
        
    	    // Hacemos el recorrido de los insumos por partida
	        $Id_Partida=$insumosPOA[0][2];
	        echo "<div class=\"tabla-partida-poa\">";
    	        echo "<span class=\"label-partida\">[-] Partida ".$Id_Partida."</span>";
	            echo "<div class=\"renglon-titulos\">";
    	            echo "<div class=\"celda3\">Contemplar</div>";
        	        echo "<div class=\"celda3\">Nombre</div>";
            	    echo "<div class=\"celda3\">Medida</div>";
                	echo "<div class=\"celda3\">Cantidad Restante</div>";		
	                echo "<div class=\"celda3\">Catidad a solicitar</div>";					
    	        echo "</div>";
        	for($i=0;$i<count($insumosPOA);$i++){
            	// Aquí mostramos los encabezados
	            if($Id_Partida!=$insumosPOA[$i][2]){
	                $Id_Partida=$insumosPOA[$i][2];
	                echo "</div>";
	                echo "<div class=\"tabla-partida-poa\">";
	                    echo "<span class=\"label-partida\">[-] Partida ".$Id_Partida."</span>";
	                    echo "<div class=\"renglon-titulos\">";
	                        echo "<div class=\"celda3\">Contemplar</div>";
	                        echo "<div class=\"celda3\">Nombre</div>";
	                        echo "<div class=\"celda3\">Medida</div>";
	                        echo "<div class=\"celda3\">Cantidad Restante</div>";		
	                        echo "<div class=\"celda3\">Catidad a solicitar</div>";					
    	                echo "</div>";
        	    }// Aquí mostramos los insumos
            	if($i%2==0){
					echo "<a name=".$insumosPOA[$i][3]."/>";
	                echo "<div class=\"renglon-blanco-corto\">";
						if(isset($_SESSION["cant-sol-".$insumosPOA[$i][3]]))	
							echo "<div class=\"celda4\"><input name=\"cant-sel-".$insumosPOA[$i][3]."\" type=\"checkbox\" checked='checked'/>";
						else
							echo "<div class=\"celda4\"><input name=\"cant-sel-".$insumosPOA[$i][3]."\" type=\"checkbox\"/>";
							
						echo "</div>";
						echo "<div class=\"celda4\">".$insumosPOA[$i][0]."</div>";
						$_SESSION["insumo-".$insumosPOA[$i][3]]=$insumosPOA[$i][0];
						echo "<div class=\"celda4\">".$insumosPOA[$i][1]."</div>";
						$cantidad_restante=$proc->devolverResto($_SESSION['nick'],$insumosPOA[$i][3],$_GET['meta'],$_GET['accion']);
							echo "<div class=\"celda4\">".$cantidad_restante."</div>";
							// Creamos un variable de session que guarde la cantidad máxima que en usuario puedes solicitar del producto $insumosPOA[$i][3]
							$_SESSION['cant-'.$insumosPOA[$i][3]]=$cantidad_restante;
							echo "<div class=\"celda4\"><input class=\"at-corto\" name=\"cant-sol-".$insumosPOA[$i][3]."\" type=\"text\" value=\" ";
								if(isset($_SESSION["cant-sol-".$insumosPOA[$i][3]]))
									echo $_SESSION["cant-sol-".$insumosPOA[$i][3]];
							echo "\"/></div>";
						echo "</div>";
	            }else{
					echo "<a name=".$insumosPOA[$i][3]."/>";
	                echo "<div class=\"renglon-morado-corto\">";
						echo "<div class=\"celda4\"><input name=\"cant-sel-".$insumosPOA[$i][3]."\" type=\"checkbox\"";
							if(isset($_SESSION["cant-sol-".$insumosPOA[$i][3]]))	
								echo " checked='checked' ";
						echo " /></div>";
						echo "<div class=\"celda4\">".$insumosPOA[$i][0]."</div>";
						$_SESSION["insumo-".$insumosPOA[$i][3]]=$insumosPOA[$i][0];
						echo "<div class=\"celda4\">".$insumosPOA[$i][1]."</div>";
						$cantidad_restante=$proc->devolverResto($_SESSION['nick'],$insumosPOA[$i][3],$_GET['meta'],$_GET['accion']);
						echo "<div class=\"celda4\">".$cantidad_restante."</div>";
						// Creamos un variable de session que guarde la cantidad máxima que en usuario puedes solicitar del producto $insumosPOA[$i][3]
						$_SESSION['cant-'.$insumosPOA[$i][3]]=$cantidad_restante;					
							echo "<div class=\"celda4\"><input class=\"at-corto\" name=\"cant-sol-".$insumosPOA[$i][3]."\" type=\"text\" value=\"";
								if(isset($_SESSION["cant-sol-".$insumosPOA[$i][3]]))
									echo $_SESSION["cant-sol-".$insumosPOA[$i][3]];
							echo "\"/></div>";
            	    echo "</div>";
            	}
	        }
        echo "</div>";			
    ?>
    </div>
    
    <div class="none-space">
    	<p>&nbsp;</p>
    </div>
	<div class="insumos-disponibles">
    	Lo anterior para ser utilizado en:
    </div>
	<div class="none-space">
    </div>
    <div ><textarea cols="60" rows="6" id="des-req"></textarea></div>



	<div class="centrado">
		<div id="line-up-cen">    	
            <br/>
            <input value="" name="agregar" type="submit" style="display:none"/>
           <?php
				echo  "<input value=\"Enviar\" name=\"enviar\" type=\"button\" onclick=\"location='guardar-requisicion.php?meta=".$_GET['meta']."&amp;accion=".$_GET['accion']."'\"/>";           
		   ?>
           
            <input value="Cancelar" name="cancelar" type="button" onclick="location='borrar-var-req.php#pe'"/>
            <br/>
            <br/>
        </div>
    </div>
    
</form>
	


 
											
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

