
<?php 
	
	require_once("../clases/ticket.php");
	$ticket = new ticket();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		
 		case 1: 
 			   echo (json_encode($ticket->crearTicket($_REQUEST['capturista'],$_REQUEST['titulo'], $_REQUEST['departamento_id'],$_REQUEST['desc'],$_REQUEST['email'],$_REQUEST['tel'])));
		break; 
		case 2: 
				echo (json_encode($ticket->cargarTicketsXusuario($_REQUEST['capturista'])));
		break;
		case 3:
				echo (json_encode($ticket->cargarTickets($_REQUEST['estatus_id'])));
		break;
		case 4:
				echo (json_encode($ticket->cargarTicketsXid($_REQUEST['id_ticket'])));
		break;
		case 5:
				echo (json_encode($ticket->cargarEstatusTicket($_REQUEST['id_estatus'])));
		break;
		case 6:
				echo (json_encode($ticket->actualizarStatusTicket($_REQUEST['ticket_id'],$_REQUEST['usuario'],$_REQUEST['id_estatus'])));
		break;
		case 7:
				echo (json_encode($ticket->agregarMensajeTicket($_REQUEST['ticket_id'],$_REQUEST['mensaje'],$_REQUEST['usuario'])));
		break;
		case 8:
				echo (json_encode($ticket->cargarMensajesAdmiTicket($_REQUEST['ticket_id'])));
		break;
		case 9:
				echo (json_encode($ticket->cargarSelectEstatus()));
		break;
		case 10:
				echo (json_encode($ticket->cargarEstatusTicket2($_REQUEST['id_estatus'])));
		break;
 	}
 
?>