<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/tecplt.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- #BeginEditable "doctitle" -->
<title>Documento sin t&iacute;tulo</title>
<!-- #EndEditable -->

</head>

<body>


<select onchange="location='target.php?er='+this.value+'#ref'">
</select>	

<?php
	$capitulo=1;
	$partida_actual=34;
echo "<select name='atajos' class='s-corto' onchange=\"location='target.php?cap=".$capitulo."&cip-'+this.value+'='+this.value+'#".$partida_actual."'\">";
	echo "<option value=\"2\">Dos</option>";
	echo "<option value=\"3\">Tres</option>";
echo "</select>"; 
	for($i=0;$i<200;$i++)
		if($i==150)
			echo "<a name=\"34\"/>"; 
		else
			echo"<p>skdkdkfkf</p>"; 
?>


</body>
</html>
