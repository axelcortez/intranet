<?php 
	
	require_once("../clases/grupo.php");
	$grupo = new Grupo();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		//Iniciar sesion
 		case 1: 
 			   echo (json_encode($grupo->listaDeEmpleadosActivos()));
			break; 
		case 2: 
 			   echo (json_encode($grupo->listaDeEmpleadosActivosPorNombre($_REQUEST['empleado'])));
			break; 
		case 3: 
 			   echo (json_encode($grupo->empleadoTmp($_REQUEST['empleado_id'])));
			break; 
		case 4: 
 			   echo (json_encode($grupo->cargarIntegrantesTmpDeGrupo()));
			break; 
		case 5: 
 			   echo (json_encode($grupo->eliminarIntegrante($_REQUEST['integrante_id'])));
			break; 
		case 6: 
 			   echo (json_encode($grupo->guardarGrupo($_REQUEST['nombre'],$_REQUEST['fecha_inicial'],$_REQUEST['fecha_final'])));
			break; 
		case 7: 
 			   echo (json_encode($grupo->gruposCreados()));
			break;
		case 8: 
 			   echo (json_encode($grupo->confirmarGrupo($_REQUEST['integrante_id'],$_REQUEST['grupo_id'])));
			break;
		case 9: 
 			   echo (json_encode($grupo->detalleDeGrupo($_REQUEST['grupo_id'])));
			break;
		case 10: 
 			   echo (json_encode($grupo->cargarGruposPorCapturista($_REQUEST['capturista_id'])));
			break;
		case 11: 
 			   echo (json_encode($grupo->cargarActividadesPorGrupo($_REQUEST['grupo_id'])));
			break;
		case 12: 
			   echo (json_encode($grupo->cargarSubActividades($_REQUEST['act_id'])));
			break;
		case 13: 
			   echo (json_encode($grupo->insertarActividades($_REQUEST['grupo_id'],$_REQUEST['titulo'],$_REQUEST['descripcion'],$_REQUEST['fecha_ini'],$_REQUEST['fecha_fin'],$_REQUEST['capturista_id'])));
			break;
		case 14: 
				echo (json_encode($grupo->insertarSubactividades($_REQUEST['actividad_id'],$_REQUEST['titulo'],$_REQUEST['descripcion'],$_REQUEST['capturista_id'],$_REQUEST['fecha_ini'],$_REQUEST['fecha_fin'])));
			 break;
		case 15: 
				echo (json_encode($grupo->insertarComentariosSubActividad($_REQUEST['porcentaje'],$_REQUEST['comentario'], $_REQUEST['id_subActividad'],$_REQUEST['capturista_id'])));
		 	 break;
		case 16: 
				echo (json_encode($grupo->cargarPorcentaje($_REQUEST['subact_id'])));
			 break;
		case 17: 
			    echo (json_encode($grupo->actualizarPorcentaje($_REQUEST['porcentaje'],$_REQUEST['comentario'], $_REQUEST['id_subActividad'])));
		  	 break;
		case 18: 
			    echo (json_encode($grupo->sacarPorcentajesPorActividad($_REQUEST['act_id'])));
			 break;
		case 19: 
			 	echo (json_encode($grupo->actualizarPorcentajeEnActividad($_REQUEST['porcentaje'],$_REQUEST['act_id'])));
		  	 break;
			


	  

 
 	}
 
?>