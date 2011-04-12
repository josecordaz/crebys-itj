<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	function SetToHidden(valor) {
		var obj = document.getElementById("order");
		obj.value = valor;
		alert(obj);
	}
 
	function enviar() { 
		document.form2.submit(); 
		return false 
	}
</script>
</head>
<body>


<!--
<form name="formulario" action="search.php?adssss=2" method=\"post\">
	<input type="hidden" name="order" id="order" value=""/>
	<a href="#" onClick="SetToHidden('1'); enviar();">ID</a><br>
	<a href="#" onClick="SetToHidden('2'); enviar();">ID</a><br>
	<a href="#" onClick="SetToHidden('3'); enviar();">ID</a>
   	<input type="text" name="or" id="or" value="23"/>
</form>
-->

<form name="form2" action="search.php" method="post">
	<input type="hidden" name="meta" id="meta" value="1"/>
	<input type="hidden" name="accion" id="accion" value="1"/>

	<input type="hidden" name="order" id="order" value=""/>
	<div class="menup">
    	<ul> 
			<li class="current"><a href="untitled.php"><span>10,000</span></a></li>
			<li ><a href="#" onClick="SetToHidden('9'); enviar();" ><span>20,000</span></a></li>
        </ul>
    </div>
</form>

</body>
</html>
