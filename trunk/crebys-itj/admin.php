<?php

	// Inicamos la sesion
	session_start();

	if(!isset($_SESSION['redir'])){
		// Iniciamos variable de sesion redir
		$_SESSION['redir']=1;
		
		// Inicializamos las variables para en redireccionamiento
		// Guardamos el nombre del servidor
		$host  = $_SERVER['HTTP_HOST'];
		// Guardamos la carpeta
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		// Guardamos el nombre del archivo
		$extra = 'admin.php';
		// Redireccionamos a la misma página para limpiar todo rastro de \$_POST[]
		header("Location: http://$host$uri/$extra");
	}else
		unset($_SESSION['redir']);

	// Libreria para la facilitacion de validaciones
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Validar.php');
	// Libreria para el manejo de la Base de Datos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Base_de_Datos.php');
	
	
	
	
	// Averiguamos si existe esta variable de sesion	
	if(!isset($_SESSION['nick'])){
	
		// Guardamos el nombre del archivo
		$extra = 'login.php';
			
		if(isset($_POST['usuario'])){	
			// Inicializamos el objeto para validar
			$validar=new Validar();
			// Validamos que el nombre de usuario sea válido
			if($validar->validarCadena($_POST['usuario'],30)){
				// Creamos la conexión a la base de datos
				$conexion=new Base_de_Datos("localhost","root","","crebys-itj");
				// Guardamos el resultado e intentamos iniciar sesion
				
				// Mostramos las variables de usuario y password
				$msg_name="\$usuario:=[".$_POST['usuario']."]<br/>";	
				$msg_pass="\$contraseña:=[".$_POST['password']."]<br/>";
								
				
				$sesion=$conexion->iniciarSesion($_POST['usuario'],$_POST['password']);
				// Comprobamos el resultado del inicio de sesion
				if(!is_bool($sesion)&&(isset($_POST['password']))){
					// Guardamos el tipo de error para mostrarlo en la pagin de inicio de sesion
					setcookie("error",$sesion, time()+20);
					// Redireccionamos a la pagina de login.php
					header("Location: http://$host$uri/$extra");
					// Terminamos la ejecucion
					exit;
					// Inicializamos las variables de sesion			
				}else{
					// Creamos la primer variable de sesion
					$_SESSION["nick"] = $_POST['usuario'];
					// Eliminamos la cokkies de password
					unset($_POST['password']);    	
				}
				//Error de validacion	
			}else{
				// Guardamos cookie de nombre no válido
				setcookie("error","El nombre de usuario que escribió es incorrecto", time()+20);
				// Redireccionamos a la pagina de login.php
				header("Location: http://$host$uri/$extra");
				// Terminamos la ejecucion
				exit;
			}
		}else{
			// Redireccionamos a la pagina de login.php
			header("Location: http://$host$uri/$extra");
			// Terminamos la ejecucion
			exit;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<?php

	if(strcmp($_SESSION['nick'],'sony_karl')==0){
		// Mostramos las opciones del administrador
		?>
        <!--Mostramos la opcion Procedimientos-->
        <a href="/crebys-itj/admin.php" class="menu_on">Inicio</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/admin-proc.php" class="menu_off">Procedimientos</a>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
		<a href="/crebys-itj/sesion-off.php" class="menu_off">Cerrar Sesion</a>
		
		<?php
	}
?>

                <!-- InstanceEndEditable --></td>
            </tr>
            <tr bgcolor="#FFFFFF">
            	<td align="center">
								<table width="85%" >
            			<tr align ="center">
										<td align ="center">  					
											<!-- #BeginEditable "RE" -->
											

                                            

                                            
                                            
											<div class="content">                                            
<div id="principal">

		<div id="uno">uno <?php echo $msg_name?></div>
   		<div id="dos">dos <?php echo $msg_pass?></div>
        
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
                                	INSTITUTO TECNOLÓGICO DE JIQUILPAN<br />
                                    Av. Carr. Nacional s/n Km. 202 Jiquilpan de Juárez, Michoacán <span lang="es-mx">
                                    C.P. 59510</span><br />
                                    Tels: 01(353) 533 11 26, 533 05 74, 533 23 48, 533 36 08, 533 11 26 y 533 30 91
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 7pt; color: #000099; vertical-align: top; text-align: center;">
                                	© 2010<span lang="es-mx"> Imágenes y Desarrollo propiedad intelectual del ITJ<br />
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
