<?php
	session_start();

	//krsort($_SESSION);
	//ksort($_SESSION);
	
	
	do{	
		echo "".key($_SESSION)." = ".current($_SESSION)."<br>";
	}while(next($_SESSION));
	echo "<br>";

?>