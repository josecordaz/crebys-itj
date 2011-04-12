<?php

	echo "GET<br>";
	foreach($_GET as $key => $valor)
		echo " variable[$key]:=[$valor]<br>";
	echo "<br>";
	
	echo "POST<br>";
	foreach($_POST as $key => $valor)
		echo " variable[$key]:=[$valor]<br>";
?>
 
