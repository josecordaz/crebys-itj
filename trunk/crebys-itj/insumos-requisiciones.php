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
	
	// Obtenemos todas las partidas
	$capitulosPOA=$proc->devolverCapitulosPOA($_SESSION['nick']);
	
	if(!(isset($_GET['meta'])&&isset($_GET['accion'])&&isset($_GET['cap']))){
		$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$metas[0][0]);				
	}

	// Si recivimos los tres parámetros	
	if(isset($_GET['meta'])&&isset($_GET['accion'])&&isset($_GET['cap'])){
		$accionesMeta=$proc->devolverAccionesMetaPOA($_SESSION['nick'],$_GET['meta']);	
	}else
		header("Location: http://$host$uri/insumos-requisiciones.php?meta=".$metas[0][0]."&accion=".$proc->NumAccion($accionesMeta[0][1])."&cap=".$capitulosPOA[0]."#pe");
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
<div class="menup">
<ul>
<?php
// Menu de Metas
	for($i=0;$i<count($metas);$i++)
		if($_GET['meta']==$metas[$i][0])
			echo "<li class=\"current\"><a href=\"#\"><span>Meta ".$metas[$i][0]."</span></a></li>";
		else
			echo "<li><a href=\"insumos-requisiciones.php?meta=".$metas[$i][0]."&accion=".$proc->NumAccion($accionesMeta[0][1])."&cap=".$capitulosPOA[0]."#pe\"><span>Meta ".$metas[$i][0]."</span></a></li>";
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
	echo "<li><a href=\"insumos-requisiciones.php?meta=".$_GET['meta']."&accion=".$proc->NumAccion($accionesMeta[$i][1])."&cap=".$capitulosPOA[0]."#pe\"><span>Accion ".$proc->NumAccion($accionesMeta[$i][1])."</span></a></li>";
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

<div class="none-space"><p></div>
<div id="insumos-disponibles">Insumos Disponibles</div>
<div class="none-space">
<p>
<?php
	// Espacio para mostrar error en caso de que hubiera                
	if(isset($_COOKIE['error'])){
		echo $_COOKIE['error'];
			echo "&nbsp;";
			echo "<a href=\"#".$_SESSION['insumo-pasado']."\">Ir al insumo</a>";
		echo "<br/>";
		unset($_COOKIE['error']);
	}
?>
<p></div>



<form method="post" action="redir-insumos-requisiciones.php">
    <div id="info-partida">    
    <?php
        // Obtenemos los capitulos que tiene el POA en esta acción con este nick determinados
    ?>
        <div class="menup-partida">
            <ul> 
    <?php
            for($i=0;$i<count($capitulosPOA);$i++)
                if($_GET['cap']==$capitulosPOA[$i])
                    echo "<li class=\"current-partida\"><a href=\"#\"><span>".$capitulosPOA[$i]."0,000</span></a></li>";
                else
                    echo "<li><a href=\"insumos-requisiciones.php?meta=".$_GET['meta']."&accion=".$_GET['accion']."&cap=".$capitulosPOA[$i]."#pe\"><span>".$capitulosPOA[$i]."0,000</span></a></li>";
                    
    ?>
            </ul>
        </div>
    <?php
        // Obtenemos los insumos de este usuario con esta meta con esta accion con este capitulo
        $insumosPOA=$proc->devolverInsumosPOA($_SESSION['nick'],$_GET['cap']);
        
        // Hacemos el recorrido de los insumos por partida
        $Id_Partida=$insumosPOA[0][2];
        echo "<div id=\"tabla-partida-poa\">";
            echo "<span class=\"label-partida\">[-] Partida ".$Id_Partida."</span>";
            echo "<div class=\"renglon-titulos\"";
                echo "<div class=\"celda3\">Agregar</div>";
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
                echo "<div id=\"tabla-partida-poa\">";
                    echo "<span class=\"label-partida\">[-] Partida ".$Id_Partida."</span>";
                    echo "<div class=\"renglon-titulos\"";
                        echo "<div class=\"celda3\">Agregar</div>";
                        echo "<div class=\"celda3\">Nombre</div>";
                        echo "<div class=\"celda3\">Medida</div>";
                        echo "<div class=\"celda3\">Cantidad Restante</div>";		
                        echo "<div class=\"celda3\">Catidad a solicitar</div>";					
                    echo "</div>";
            }// Aquí mostramos los insumos
            if($i%2==0){
				echo "<a name=".$insumosPOA[$i][3].">";
                echo "<div class=\"renglon-blanco-corto\">";
                    echo "<div class=\"celda4\"><input name=\"cant-sel-".$insumosPOA[$i][3]."\" type=\"checkbox\"/></div>";
                    echo "<div class=\"celda4\">".$insumosPOA[$i][0]."</div>";
					$_SESSION["insumo-".$insumosPOA[$i][3]]=$insumosPOA[$i][0];
                    echo "<div class=\"celda4\">".$insumosPOA[$i][1]."</div>";
					$cantidad_restante=$proc->devolverResto($_SESSION['nick'],$insumosPOA[$i][3]);
                    echo "<div class=\"celda4\">".$cantidad_restante."</div>";
					// Creamos un variable de session que guarde la cantidad máxima que en usuario puedes solicitar del producto $insumosPOA[$i][3]
						$_SESSION['cant-'.$insumosPOA[$i][3]]=$cantidad_restante;
                    echo "<div class=\"celda4\"><input class=\"at-corto\" name=\"cant-sol-".$insumosPOA[$i][3]."\" type=\"text\"/></div>";								
                echo "</div>";
            }else{
				echo "<a name=".$insumosPOA[$i][3].">";
                echo "<div class=\"renglon-morado-corto\">";
                    echo "<div class=\"celda4\"><input name=\"cant-sel-".$insumosPOA[$i][3]."\" type=\"checkbox\"/></div>";
                    echo "<div class=\"celda4\">".$insumosPOA[$i][0]."</div>";
					$_SESSION["insumo-".$insumosPOA[$i][3]]=$insumosPOA[$i][0];
                    echo "<div class=\"celda4\">".$insumosPOA[$i][1]."</div>";
					$cantidad_restante=$proc->devolverResto($_SESSION['nick'],$insumosPOA[$i][3]);
                    echo "<div class=\"celda4\">".$cantidad_restante."</div>";
					// Creamos un variable de session que guarde la cantidad máxima que en usuario puedes solicitar del producto $insumosPOA[$i][3]
						$_SESSION['cant-'.$insumosPOA[$i][3]]=$cantidad_restante;					
                    echo "<div class=\"celda4\"><input class=\"at-corto\" name=\"cant-sol-".$insumosPOA[$i][3]."\" type=\"text\"/></div>";								
                echo "</div>";
            }
        }
        echo "</div>";			
            
                
    ?>
    </div>
</div>

	<div class="centrado">
		<div id="line-up-cen">    	
            <br/>
            <input value="Agregar" name="agregar" type="submit"/>
            <input value="Cancelar" name="cancelar" type="button" onclick="location='poa.php#pe'"/>
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
