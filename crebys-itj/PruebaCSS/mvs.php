<?php
	session_start();

	
	$arr=$_SESSION;
	krsort($arr);
	
	foreach($arr as $key => $value){
    	echo $key."= ".$value."<br>";
	}

?>