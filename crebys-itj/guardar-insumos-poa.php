<?php
	// Iniciamos el uso de variables de _SESSION
	session_start();
	
	// Librería para manipulación de procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');

	// Objeto para la manipulación de procedimientos
	$proc=new Procedimientos();
		
	//Guardar los insumos seleccionados en cargar-insumos-poa.php
	
	// Ordenamos el arreglo se $__SESSION por clave
	//$_SESSION=$__SESSION;
	//reset($_SESSION);
	//krsort($_SESSION);
	//echo " guardar-insumos-poa.php<p>";
	
	$insumos=array();
	$cantidades=array();
	
	// Mostramos todas las variables de _SESSION;
	$arr=$_SESSION;
	krsort($arr);
	
	$cont_insumo=0;
	$cont_cantidades=0;
	$_SESSION['contador']=0;
	$ban=1;
	
	/*foreach($arr as $key => $value){
		if(substr($key,0,strlen($_SESSION['accion-cargar']))==$_SESSION['accion-cargar']){
			echo "key= ".$key." valor=".$value."<br>";
		}
	}
	echo "<p>";*/
	
	foreach($arr as $key => $value){
		if(substr($key,0,strlen($_SESSION['accion-cargar']))==$_SESSION['accion-cargar']){
			switch($_SESSION['contador']%3){
				case 0:
				//echo "residuo vale ".($_SESSION['contador']%3)." == 0<br>";
					if($ban){
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;guardo Id_Insumo[".$cont_insumo."]=".$value."<br>";
						$insumos[$cont_insumo]=$value;
						$cont_insumo++;
					
					}
					$_SESSION['contador']++;	
					$bsn=true;
					break;
				case 1:
					//echo "residuo vale ".($_SESSION['contador']%3)." == 1<br>";				
					if(substr($key,strlen($key)-1,1)==2){
						$cantidades[$cont_cantidades][1]=$value;
						$cantidades[$cont_cantidades][0]=0;
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardo la segunda cantidad[".$cont_cantidades."][1]:= ".$value."<br>";
					}
					else{
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardo la primera cantidad[".$cont_cantidades."][0]:= ".$value."<br>";
						$cantidades[$cont_cantidades][1]=0;						
						$cantidades[$cont_cantidades][0]=$value;
					}
					$_SESSION['contador']++;					
					break;
				case 2:
				//echo "residuo vale ".($_SESSION['contador']%3)." ==2 <br>";				
					$cadena1=$key+0;
					$cadena2=$insumos[$cont_insumo-1];
					$sub1=substr($cadena1,strlen($_SESSION['accion-cargar']),strlen($cadena1)-strlen($_SESSION['accion-cargar']));
					if($cadena2==$sub1)	{
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardo la primera cantidad[".$cont_cantidades."][0]:= ".$value."<br>";
						$cantidades[$cont_cantidades][0]=$value;
						//echo "<p>";
					}
					else{
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardo la segunda cantidad[".$cont_cantidades."][0]:= 0<br>";		
						//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;key= ".$key."  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guardo abajo insumo[".$cont_insumo."]:= ".$value."<br>";
						//echo "<p>";
						// Al entrar aquí significa que no existe cantidad 1
						//$cantidades[$cont_cantidades][0]=0;
						//$_SESSION['contador']++;
						$insumos[$cont_insumo]=$value;
						$cont_insumo++;
						$ban=false;
						$_SESSION['contador']++;
					}
					$_SESSION['contador']++;
					$cont_cantidades++;					
					break;
			}
		}
	}
	
	/*echo "<p>Insumos<p>";
	for($i=0;$i<count($insumos);$i++)
		echo $insumos[$i]."=[".$cantidades[$i][0]."][".$cantidades[$i][1]."]<br>";*/
	

	// Ejecutamos el procedimiento para saber el Id_Insumo_Accion
	$error=$proc->guardarInsumosPOA($_SESSION['nick'],$_SESSION['accion-cargar'],$insumos,$cantidades);
	
	//echo $error;

	// Redireccionamos a poa.php
	header("location: poa.php?meta=".$_SESSION['meta']."&accion=".$proc->numAccion($_SESSION['accion-cargar'])."#pe");

?>
