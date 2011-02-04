<?php
	//Clase utilizada para validar
	//entradas de tipos de datos
	class Validar{
		//Validamos que la cadena sea
		//solo dígitos y que no exceda de
		//11 caracteres
		function validarNumero($cadena){
			$patron="^[0-9]{1,11}$";
			if(ereg($patron, $cadena))
				return true;
			else
				return false;
		}
		//Validamos que la cadena inicie con un caracter
		// y que si se escribe algun espacio en blanco
		// le continue otro caracter puede tener la 
		//cantidad de caracteres que le mande $longitud
		function validarCadena($cadena,$longitud){
			//echo "Longitud de:=[$cadena] :=[$longitud]<br/>";
			//$patron="(^[a-zA-Z]([\s][a-zA-Z]|[a-zA-Z])*$)";
			$patron="(^([a-zA-Z]|é|á|í|ó|ú)([^\S][a-zA-Z]|[a-zA-Z]|[é|á|í|ó|ú])*$)";
			if(ereg($patron, $cadena))
				if(strlen($cadena)<=$longitud)
					return true;
				else
					return false;
			else
				return false;
		}
		//Validamos que $cadena este en 
		//formato de tipo Double
		function validarDouble($cadena){
			$patron="^[0-9]([\.][0-9]|[0-9])*$";
			if(ereg($patron,$cadena))
				return true;
			else
				return false;
		}
		// Validamos la contraseña
		function validarPassword($cadena,$longitud){
			//echo "Longitud de:=[$cadena] :=[$longitud]<br/>";
			//$patron="(^[a-zA-Z]([\s][a-zA-Z]|[a-zA-Z])*$)";
			if(strlen($cadena)<=$longitud)
					return true;
				else
					return false;
		}
		// Función para validar cadenas con números
		function validarCadena2($cadena,$longitud){
			$patron="(^([a-zA-Z]|é|á|í|ó|ú)([^\S]|[a-zA-Z]|[é|á|í|ó|ú]|[0-9])*$)";
			if(ereg($patron, $cadena))
				if(strlen($cadena)<=$longitud)
					return true;
				else
					return false;
			else
				return false;
		}
	}
?>