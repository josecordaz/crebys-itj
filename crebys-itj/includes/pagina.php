<?php	
// Clase para redireccionar
class pagina{
	// Función para redireccionar a $dir
	function redir($dir){
		// Redireccionamos a $dir
		header("Location http://$host$uri/$dir");
	}			
}

?>