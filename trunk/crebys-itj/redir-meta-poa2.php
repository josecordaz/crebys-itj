<?php
	// Esta página rediccionará a poa.php
	if(isset($_GET['meta']))
		echo "Se recivió meta:=[".$_GET['meta']."]";
	echo "<br>";
	if(isset($_GET['accion']))
		echo "Se recivió acción:=[".$_GET['accion']."]";

?>

