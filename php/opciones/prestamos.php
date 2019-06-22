<?php 
	
	require_once("../clases/prestamo.php");
	$prestamos = new Prestamo();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		//Crear Solicitud
 		case 1: 
				echo (json_encode($prestamos->crearSolicitud($_REQUEST['capturista_id'],$_REQUEST['fecha_solicitud'],$_REQUEST['puesto_id'],$_REQUEST['sucursal_id'],$_REQUEST['empresa_id'],$_REQUEST['numTarjeta'],$_REQUEST['beneficiarioCuenta'],$_REQUEST['nombreBanco'],$_REQUEST['monto_solicitado'],$_REQUEST['quincenas'],$_REQUEST['meses_a_pagar'],$_REQUEST['interes_prestamo'],$_REQUEST['tipo_abono'],$_REQUEST['descuento_mensual'],$_REQUEST['monto_total'],$_REQUEST['inicio_descuento'],$_REQUEST['fin_descuento'], $_REQUEST['monto_letra'], $_REQUEST['porc_interes'])));
		break; 
		case 2: 
				echo (json_encode($prestamos->cargarSolicitudesPorEmpleado($_REQUEST['capturista_id'])));
		break;
		case 3: 
				echo (json_encode($prestamos->insertarCorridas($_REQUEST['prestamoId'],$_REQUEST['fecha'],$_REQUEST['quincenas'],$_REQUEST['abono'], $_REQUEST['total'])));
		break;
		case 4: 
				echo (json_encode($prestamos->cargarUltimoIdSolicitud()));
		break;
		case 5: 
				echo (json_encode($prestamos->calcularFechaPagoInicialYFinal($_REQUEST['fecha'],$_REQUEST['quincenas'])));
		break;
		case 6: 
				echo (json_encode($prestamos->cargarSolicitudes($_REQUEST['sucursal'],$_REQUEST['estatus_id'],$_REQUEST['capturista_id'],$_REQUEST['fecha_ini'],$_REQUEST['fecha_fin'] )));
		break;
		case 7: 
				echo (json_encode($prestamos->autorizarPrestamo($_REQUEST['id_prestamo'],$_REQUEST['coment'],$_REQUEST['capturista_autoriza'],$_REQUEST['montoAutorizado'])));
		break;
		case 8: 
				echo (json_encode($prestamos->cargarSolicitudxId($_REQUEST['id_solicitud'])));
		break;
		case 9: 
				echo (json_encode($prestamos->actualizarPrestamo($_REQUEST['id_solicitud'],$_REQUEST['interes_prestamo'],$_REQUEST['descuento_mensual'],$_REQUEST['monto_total'], $_REQUEST['monto_letra'])));
		break;
		case 10: 
				echo (json_encode($prestamos->actualizarPrestamoFechasPago($_REQUEST['fecha_ini'],$_REQUEST['fecha_fin'],$_REQUEST['solicitud_id'])));
		break;
		case 11: 
				echo (json_encode($prestamos->NoAutorizarPrestamo($_REQUEST['id_prestamo'],$_REQUEST['coment'],$_REQUEST['capturista_autoriza'])));
		break;
		case 12: 
				echo (json_encode($prestamos->cargarCorridaXid($_REQUEST['id_prestamo'])));
		break;
		case 13: 
				echo (json_encode($prestamos->EliminarCorridaSiTiene($_REQUEST['id_prestamo'])));
		break;
		case 14: 
				echo (json_encode($prestamos->cargarInfoPrestamo($_REQUEST['id_prestamo'])));
		break;
		case 15: 
				echo (json_encode($prestamos->cargarArchivoResponsiva($_REQUEST['id_prestamo'])));
		break;
		case 16: 
				echo (json_encode($prestamos->cargarRutaResponsiva($_REQUEST['id_prestamo'], $_REQUEST['ruta'])));
		break;
		case 17: 
				echo (json_encode($prestamos->cargarInfoSolicitudXId($_REQUEST['id_prestamo'])));
		break;
		case 18: 
				echo (json_encode($prestamos->cargarSucursales()));
		break;
		case 19: 
				echo (json_encode($prestamos->cargarEstatus()));
		break;
		case 20: 
				echo (json_encode($prestamos->eliminarResponsiva($_REQUEST['id_prestamo'])));
		break;
		case 21: 
				echo (json_encode($prestamos->cargarPagosPorFecha($_REQUEST['fecha'])));
		break;
		case 22: 
				echo (json_encode($prestamos->reflejarPago($_REQUEST['corrida_prestamo_id'])));
		break;
		case 23: 
				echo (json_encode($prestamos->cargarReporte1Excel($_REQUEST['sucursal_id'])));
		break;
		case 24: 
				echo (json_encode($prestamos->dispersarPrestamo($_REQUEST['prestamo_id'])));
		break;
 	}
 
?>