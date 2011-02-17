<?php

	do{
		echo "key = ".key($_POST)." valor = ".current($_POST)."<br>";
	}while(next($_POST))

?>