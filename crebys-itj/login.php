<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" -->
<title>Crebys-ITJ Crontrol de requisiciones de bienes y servicios del ITJ </title>
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
                        	<td><!-- InstanceBeginEditable name="Bienvenida" --><!-- InstanceEndEditable --></td>
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
            			<tr align ="center">
										<td align ="center">  					
											<!-- #BeginEditable "RE" -->

<div class="content">



    	<div >
        
        		<?php
                
				if(isset($_COOKIE['error'])){
					echo $_COOKIE['error']."<br/>";
					unset($_COOKIE['error']);
				}
				
				?>
        	
                <form ACTION="redir.php" METHOD="post">	
                
                    <hr/>        
                    
                    <br/>
                    
                    <div class="caja">
                    	Usuario: <input TYPE="text" NAME="usuario" value=""/><br/>
                    </div>
            
                    <br/>
                    
                    <div class="caja">
	                    Contrase�a: <input TYPE="password" NAME="password" value=""/><br/>
                    </div>
                    
                    <br/>
                    
                    <input TYPE="submit" NAME="proc" value="Iniciar Sesi�n"/>
                
                    <hr/>
            
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
