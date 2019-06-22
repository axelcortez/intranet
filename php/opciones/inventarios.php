<?php 
	
	require_once("../clases/inventario.php");
	$inventario = new Inventario();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		//Iniciar sesion
 		case 1: 
 			   echo (json_encode($inventario->registroAreas($_REQUEST['area_id'],$_REQUEST['nombre_area'])));
		break; 
		case 2: 
 			   echo (json_encode($inventario->cargarAreas()));
		break;  
		case 3: 
 			   echo (json_encode($inventario->buscarArea($_REQUEST['area_id'],$_REQUEST['area'])));
		break;
		case 4: 
 			   echo (json_encode($inventario->desHabilitarArea($_REQUEST['area_id'])));
		break;
		case 5: 
 			   echo (json_encode($inventario->eliminarArea($_REQUEST['area_id'])));
		break;
		case 6: 
 			   echo (json_encode($inventario->deshabilitarResponsivas($_REQUEST['equipo_id'])));
		break;
		case 7: 
 			   echo (json_encode($inventario->buscarCp($_REQUEST['cp'])));
		break;
		case 8: 
 			   echo (json_encode($inventario->buscarCpCol($_REQUEST['cp'])));
		break;
		case 9: 
 			   echo (json_encode($inventario->registrarStock($_REQUEST['txtIdPagoEspecie'],$_REQUEST['txtFecha'],$_REQUEST['txtCoordinacion'],$_REQUEST['cboSucursal'],$_REQUEST['txtIdCoor'],$_REQUEST['txtDistribuidora'],$_REQUEST['txtPago'],$_REQUEST['cboEquipo'],$_REQUEST['txtMarca'],$_REQUEST['txtModelo'],$_REQUEST['txtSerie'],$_REQUEST['txtDescripcion'],$_REQUEST['txtUbicacion'])));
		break;
		case 10: 
 			   echo (json_encode($inventario->cargarPagosEspecie()));
		break;
		case 11: 
 			   echo (json_encode($inventario->cambiarEstatusPago($_REQUEST['txtIdEstatus'],$_REQUEST['txtMotivo'],$_REQUEST['sltEstatusPago'])));
		break;
		case 12: 
 			   echo (json_encode($inventario->cargarImgStock($_REQUEST['txtId'],$_REQUEST['txtDocName'])));
		break;
		case 13: 
 			   echo (json_encode($inventario->buscarPago($_REQUEST['txtId'])));
		break;
		case 14: 
 			   echo (json_encode($inventario->cargarStock()));
		break;
		case 15: 
 			   echo (json_encode($inventario->cargarCarousel($_REQUEST['id'])));
		break;
		case 16: 
 			   echo (json_encode($inventario->cargarPrevioEnSolicitud($_REQUEST['id'])));
		break;
		case 17: 
 			   echo (json_encode($inventario->guardarSolicitud($_REQUEST['articulo_id'],$_REQUEST['capturista_id'],$_REQUEST['comentario'],$_REQUEST['quincenas'])));
		break;
		case 18: 
 			   echo (json_encode($inventario->cargarSolicitudes()));
		break;
		case 19: 
 			   echo (json_encode($inventario->verSolicitud($_REQUEST['solicitud_id'])));
		break;
		case 20: 
 			   echo (json_encode($inventario->preAutorizarSolicitud($_REQUEST['solicitud_id'])));
		break;
		case 21: 
 			   echo (json_encode($inventario->autorizarSolicitud($_REQUEST['solicitud_id'],$_REQUEST['nota'],$_REQUEST['quincenas'],$_REQUEST['pagoQuincenal'],$_REQUEST['monto'])));
		break;
		case 22: 
 			   echo (json_encode($inventario->mensajesPendientes($_COOKIE["b_capturista_id"])));
		break;
		case 23: 
 			   echo (json_encode($inventario->cargarMensajes($_COOKIE["b_capturista_id"])));
		break;
		case 24: 
 			   echo (json_encode($inventario->validarQuincenas($_REQUEST["articulo_id"])));
		break;
		case 25: 
 			   echo (json_encode($inventario->cargarAreasParaFiltrarInventario()));
		break;
		case 26:
			echo (json_encode($inventario->cargarEquiposPorInventarioArea($_REQUEST['inventario_id'],$_REQUEST['sucursal'],$_REQUEST['area_id'])));
		break;



 
 	}
 
?>