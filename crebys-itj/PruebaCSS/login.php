<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Validar.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- #BeginEditable "doctitle" -->
<title>Crebys-ITJ Crontrol de requisiciones de bienes y servicios del ITJ </title>
<!-- #EndEditable -->
<link href="ITJStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div>
    	<table align="center" class="style1">
        	<tr>
            	<td>
                	<table cellpadding="0" cellspacing="0" class="FondoTabla">
                      	<tr>
                        	<td class="style6" rowspan="2">
                            	<img alt="" class="style5" src="../recursos/Img/BannerSup/izq.png" />
                          </td>
                            <td class="style9" colspan="2">
                            	<img alt="" class="style8" src="../recursos/Img/BannerSup/centrosup.png" />
                          </td>
                            <td rowspan="2">
                            	<img alt="" class="style7" src="../recursos/Img/BannerSup/der.png" />
                            </td>
                        </tr>
                        <tr>
                        	<td class="style11">
                            	<img src="../recursos/Img/BannerSup/centroinf.png" class="style12" />                            </td>
                          <td>&nbsp;</td>
                      </tr>
                  	</table>
                  	<table>
                    	<tr>
                        	<td>
                            	<img src="../recursos/Img/BannerSup/BannerBicentenario.jpg" width="900" height="120" />
                            </td>
                        </tr>
                    </table>
                    <table class="style16" bgcolor="#FFFFFF" border="0">
                    	<tr>
                        	<td rowspan="2" class="style17"><img alt="" src="../recursos/Img/Titulo.png" style="width: 510px; height: 50px" /></td>
                            <td class="style19" rowspan="2">&nbsp;</td>
                            <td>&nbsp;</td>
                      </tr>
                        <tr>
                        	<td>Inicio</td>
                        </tr>
                    </table>
              	</td>
            </tr>
            <tr>
                <td class="style2" bgcolor="#FF9900"><!-- InstanceBeginEditable name="menu" -->

                <!-- InstanceEndEditable --></td>
            </tr>
            <tr bgcolor="#FFFFFF">
            	<td align="center">
								<table width="85%" >
            			<tr>
										<td align ="center">  					
											<!-- #BeginEditable "RE" -->

<div class="content">


<?php
	if (isset($_POST['usuario'])) {
		$validar=new Validar();
		
		if(!$validar->validarCadena($_POST['usuario'],30))
	  		echo "El nombre de usuario que escribió es incorrecto";
		else{
			echo "Usuario:=[".$_POST['usuario']."]<br/>";
			echo "Contraseña:=[".$_POST['password']."]";
		}
	 }
	else
	{?>
    	<div align="center">
        	
                <form ACTION="login.php" METHOD="POST">	
                
                    <hr/>        
                    
                    <br/>
                    
                    <div class="caja">
                    	Usuario: <input TYPE="text" NAME="usuario"/><br/>
                    </div>
            
                    <br/>
                    
                    <div class="caja">
	                    Contraseña: <input TYPE="text" NAME="password"/><br/>
                    </div>
                    
                    <br/>
                    
                    <input TYPE="submit" NAME="proc" value="Iniciar Sesión"/>
                
                    <hr/>
            
                </form>
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
                                	INSTITUTO TECNOLÓGICO DE JIQUILPAN<br />
                                    Av. Carr. Nacional s/n Km. 202 Jiquilpan de Juárez, Michoacán <span lang="es-mx">
                                    C.P. 59510</span><br />
                                    Tels: 01(353) 533 11 26, 533 05 74, 533 23 48, 533 36 08, 533 11 26 y 533 30 91
                                </span>
                            </td>
                            <td>
                                <span style="font-size: 7pt; color: #000099; vertical-align: top; text-align: center;">
                                	© 2010<span lang="es-mx"> Imágenes y Desarrollo propiedad intelectual del ITJ<br />
                                    Última Actualización: 7/09/2010
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
