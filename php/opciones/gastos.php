<?php 
	
	require_once("../clases/gasto.php");
	$gastos = new gastos();  
    //opciones a  ejecutar en el swich
    

	$opcion = $_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		case 1: 
				echo (json_encode($gastos->buscarCuentas()));
			break;
		case 2: 
				echo (json_encode($gastos->buscarSubCuentas($_REQUEST['cta'])));
			break;  
		case 3: 
				$arregloSolicitudes = Array();
    			$arregloSolicitudes = $_REQUEST['notificaciones']; 
				echo (json_encode($gastos->generarSolicitudDeGasto($_REQUEST['cuenta_id'],$_REQUEST['subCuenta_id'],$_REQUEST['sucursal_id'],$_REQUEST['importe'],$_REQUEST['concepto'],$_REQUEST['aEvidencia'],$_REQUEST['aCotizacion'],$arregloSolicitudes)));
			break; 
		case 4: 
				echo (json_encode($gastos->buscarSucursalesPorEmpresa($_REQUEST['b_empresa'])));
			break;
		case 5: 
			echo (json_encode($gastos->cargarCorreosEmpresa()));
		break;
		case 6: 
			echo (json_encode($gastos->notificarEmpleado($_REQUEST['notificar'],$_REQUEST['correo'])));
		break;
		case 7: 
			echo (json_encode($gastos->cargarSolicitudesDeGastos($_REQUEST['fecha_inicial'],$_REQUEST['fecha_final'])));
		break;
		case 8: 
			echo (json_encode($gastos->documentosSolicitud($_REQUEST['solicitud_id'])));
		break;
		case 9: 
			echo (json_encode($gastos->guardarComentario($_REQUEST['solicitud_id'],$_REQUEST['comentario'])));
		break;
		case 10: 
			echo (json_encode($gastos->cargarComentariosSolicitud($_REQUEST['solicitud_id'])));
		break;
		
 	}
 
?>