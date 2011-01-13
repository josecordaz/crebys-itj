<?php
	// Inicamos la sesion
	session_start();
	
	// Inicializamos las variables para en redireccionamiento
	// Guardamos el nombre del servidor
	$host  = $_SERVER['HTTP_HOST'];
	// Guardamos la carpeta
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	// Si no existe la variable de sesión redir
	

	// La siguiente variable se utilizará como temporal
	// para guardar la meta en la que se está trabajando 
	// actulmente.
	if(isset($_GET['meta']))
		$_SESSION['meta']=$_GET['meta'];
	else
		$_SESSION['meta']=1;
	
	// Librería para Procedimientos
	include_once ($_SERVER['DOCUMENT_ROOT'].'/CREBYS-ITJ/includes/Procedimientos.php');
	// Objeto 
	$proc=new Procedimientos();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link href="ITJStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>


<div id="area">
 
    <div class="menup">
	<ul id="lista">
    <?php
		$metas=array();
		$metas=$proc->devolverMetas();
		for($e=0;$e<count($metas);$e++){
			if($metas[$e][0]==$_SESSION['meta'])
		    	echo "<li class='current'><a href=''><span>M".$metas[$e][0]."</span></a></li>";
			else
	    		echo "<li ><a href='css.php?meta=".$metas[$e][0]."'><span>M".$metas[$e][0]."</span></a></li>";
		}
	?>
    </ul>
	</div>
	
    <div id="containercolumns">    
	
    	<div id="contentcolumns"></font></font>
        	<br/>
	        Proceso Estratégico:
            <div class="info">
              <?php
            	$namep=$proc->datosMeta($_SESSION['meta']);
				echo $namep[0][2];
			?>
            </div>
            <br/>
            Proceso Clave:
            <div class="info">
              <?php
				echo $namep[0][1];
            ?>
            </div>
            <br/>
        	Descripción:
			<div class="info">
			  <?php
				echo $namep[0][0];
            ?>
</div>
                        	<div ><input type="button" value="Editar" /></div>

            <br/>

    	</div>
        <form action="accion.php" method="post">
       	<div id="menucolumns">
		<?php 
			$acciones=array();
			$acciones=$proc->devolverAcciones($_SESSION['meta']);
			for($i=0;$i<count($acciones);$i++){
				echo "<input type='radio' name='raccion' value='".($i+1)."' />";
				echo "<span class='sub-titulo'>Accion ".($i+1).":</span>";
		?>
	            <div class="cortita">
    	       	<hr>
        	    </div>
        		<div class="info">
                	
		<?php
        	   	echo $acciones[$i][0];
		?>
	        	</div>	
            
            	<br/>        
		<?php 
			}
		?>
	        	        
	       	<div >
                <input type="button" value="Agregar" />
            	<input type="submit" value="Editar" />
                <input type="button" value="Eliminar" />
            </div>    
		</div>
		
        </form>
		</div>
    
</div>


</body>
</html>