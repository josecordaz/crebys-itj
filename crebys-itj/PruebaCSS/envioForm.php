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

<form method="post" action="mis_datos.php">
	<input type="hidden" name="edad" value="55">
	<p>	
		Tu nombre 
		<input type="text" name="nombre" size="30" value="jose">
	</p>

	<p>Tu sistema favorito 
		<select size="1" name="sistema">
			<option selected value="Linux">Linux</option>
			<option value="Unix">Unix</option>
			<option value="Macintosh">Macintosh</option>
			<option value=&qmargin-left: 75"><option value="Windows">Windows</option>
		</select>
	</p>

	<p>
		¿Te gusta el futbol ?
		<input type="checkbox" name="futbol" value="ON">
	</p>

	<p>
		¿Cual es tu sexo?
	</p>

	<blockquote>

		<p>
			Hombre
			<input type="radio" value="hombre" checked name="sexo">
		</p>
	
		<p>
			Mujer
			<input type="radio" name="sexo" value="mujer">
		</p>

	</blockquote>

	<p>Aficiones</p>

	<p>
		<textarea rows="5" name="aficiones" cols="28"></textarea>
	</p>

	<p>
		<input type="submit" value="Enviar datos" name="enviar"> 
		<input type="res-left: 50">
		<input type="reset" value="Restablecer" name="B2">
	</p>

</FORM> 

</body>
</html>