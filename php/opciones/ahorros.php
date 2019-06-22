<?php 
	
	require_once("../clases/ahorro.php");
	$ahorro = new ahorro();  
    //opciones a  ejecutar en el swich
    

	$opcion = $_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		case 1: 
				echo (json_encode($ahorro->verificarArchivo($_REQUEST['capturista_id'])));
		break;
		case 2: 
				echo (json_encode($ahorro->agregarArchivo($_REQUEST['ruta'], $_REQUEST['capturista_id'], $_REQUEST['acepto'])));
		break;
		case 3: 
				echo (json_encode($ahorro->eliminarArchivo($_REQUEST['capturista_id'])));
		break;
		case 4: 
				echo (json_encode($ahorro->cargarSolicitudes()));
		break;
		
 	}
 
?>