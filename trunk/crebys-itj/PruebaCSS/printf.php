<?php

	$cadena=rand(100, 10000000000)/3.21;
	echo "Cadena :=[".$cadena."]<br>";
	
	function convertirFMoneda($cadena){
		// Guardamos la cadena redondeando los decimales a 2
		$subCadena=sprintf("%.2f",$cadena);

		// Encontramos la posicion del punto
		$posPunto=strpos($subCadena,'.');
		
		// Variable para los decimales
		$decimales=substr($subCadena,$posPunto+1,2);
		
		// Parte entera
		$enteros=substr($subCadena,0,$posPunto);
		
		// Guardamos el primer grupo incompleto a 3 
			//por ejemplo 
				//3 de 3,456
			    //34 de 34,567
			     
		// Calculamos el residuo de primer grupo sobre 3 
		$residuo=strlen($enteros)%3;
		$incompletos="";
		switch ($residuo){
			case 0:
				$incompletos="";
				break;
			case 1:
				$incompletos=substr($enteros,0,1).",";
				break;
			case 2:
				$incompletos=substr($enteros,0,2).",";
				break;

		}
		
		// Cilo para dar comillas a las tercias de enteros
		$numComas="";
		for($i=0;$i<floor(strlen($enteros)/3);$i++){
			$numComas=$numComas.substr($enteros,$residuo+(3*$i),3);
			if(($i+1)<floor((strlen($enteros)/3)))
				$numComas=$numComas.",";
		}
		
		return "$ ".$incompletos.$numComas.".".$decimales;
	}
	
	echo convertirFMoneda($cadena);
	
?>