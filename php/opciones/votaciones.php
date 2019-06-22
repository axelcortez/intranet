<?php 
	
	require_once("../clases/votacion.php");
	$votacion = new Votacion();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		
 		case 1: 
 			   echo (json_encode($votacion->verifVoto($_REQUEST['empleado_id'])));
		break; 
		case 2: 
 			   echo (json_encode($votacion->insertarVotacion($_REQUEST['sucursal_id'],$_REQUEST['empleado_id'])));
        break;
        case 3: 
 			   echo (json_encode($votacion->verifSucursal($_REQUEST['sucursal_id'])));
		break;
		case 4: 
 			   echo (json_encode($votacion->resultadosVotaciones()));
		break;
 
 	}
 
?>