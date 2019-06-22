<?php
require_once( '../pdf/pdf.php' );
require_once( '../php/conexion/conexion.php' );
$c = new Conectar();

class DF extends PDF
{
    

    
}



$fecha_entrega 	= $_REQUEST[ 'fecha' ];
$nombre 	= $_REQUEST[ 'nombre' ];
$monto 	= $_REQUEST[ 'monto' ];
$id_solicitud 	= $_REQUEST[ 'id_solicitud' ];
$fecha_final_completa 	= $_REQUEST[ 'final_completa' ];
//$id_equipo = $_REQUEST[ 'id_equipo' ];



$sql = "SELECT s.monto_total, s.fin_descuento, c.dom_calle, c.dom_colonia, c.dom_poblacion
		FROM b_prestamo_solicitudes s 
		INNER JOIN capturistas c ON c.id = s.capturista_id
		WHERE s.id=$id_solicitud";
	$resultado = mysqli_query($c->con(), $sql); 
	while ($res = mysqli_fetch_row($resultado)) 
	{
		$montoTotal = $res[ 0 ];
		$fin_descuento = $res[ 1 ];
		$dom_calle = $res[ 2 ];
		$dom_colonia = $res[ 3 ];
		$dom_poblacion = $res[ 4 ];
	}


    

$df = new DF();
$df->FPDF( 'P', 'mm', 'Letter' );
$df->AddPage();

$df->Ln(-6);
$df->SetFillColor(192,192,192); //Fondo del texto Gris Claro

$totalPagosVale	= 0;
$capital  		= 0;
$interes 		= 0;
$cont 			= 0;
$moratorio 		= 0;
$totalMoratorio = 0;
$fondo 			= 0;
$totalFondo 	= 0;


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//											 BUSCAR LOS PAGO DE RELACION DE VALES 														//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$df->SetFont('Arial','B',15);
$df->Ln(50);
$df->Cell(50);
$df->Cell(95,5,utf8_decode("Pagaré"),0,0,'C',false);
$df->Ln(8);
$df->SetFont('Arial','',10);
$df->Cell(195,5,"Bueno por $$montoTotal",0,0,0,false);
$df->Ln(8);
$df->Cell(195,5,"Lugar y fecha de suscripcion",0,0,0,false);
$df->Ln(5);
$df->Cell(195,5,"Culiacan, Sinaloa a $fecha_entrega",0,0,0,false);
$df->SetFont('Arial','',10);

$df->Ln(10);


$df->Multicell(190,8,utf8_decode("Debe (mos) y pagare (mos) incondicionalmente por este pagaré a la orden de Prestaciones Responsables SA de CV en Culiacan, Sinaloa, el día $fecha_final_completa, la cantidad de $$montoTotal. Valor recibido a mi (nuestra) entera satisfacción por concepto de prestamo personal. Este pagaré forma parte de una seria numerada del 1 al 1 y todos están sujetos a la condición de que, al no pagarse cualquiera de ellos a su vencimiento, seran exigibles todos los que le sigan en número, además de los ya vencidos, desde la fecha de vencimiento de este documento hasta el día de su liquidación, causara intereses moratorios al tipo 3% mensual, pagadero es esta ciudad juntamente con el principal. "),0,'J',0);
$df->Ln(10);
/*
if($num_equipo > 0)
{
	$df->Ln(5);
	$df->Cell(10);
	$df->SetFont('Arial','B',11);
	$df->Cell(1,5,'ID  # EQUIPO   TIPO                     FECHA ENTREGA                      DESCRIPCION',0,0,'N',false);
	$df->SetFont('Arial','',10);
	$df->Ln(5);
	$sql = "SELECT e.id, e.`num_equipo`, t.`descripcion`, e.`descripcion`, r.fecha_entrega
	FROM i_equipo e 
	INNER JOIN i_tipo_equipo t ON e.`tipo_equipo_id`=t.`id`
	INNER JOIN i_responsivas r ON r.`equipo_id`=e.`id`
	WHERE e.num_equipo=$num_equipo AND e.estatus_id=5 AND r.estatus=5";
	$resultado = mysqli_query($c->con(), $sql); 
	while ($res = mysqli_fetch_row($resultado)) 
	{
		$id = $res[ 0 ];
		$numEquipo = $res[ 1 ];
		$tipo = $res[ 2 ];
		$descripcionE = $res[ 3 ];
		$fechaEntrega = $res[ 4 ];

		$df->Ln(3);
		$df->Cell(10);
		$df->Cell(1,5,"    ".$id,0,0,'C',false);
		$df->Cell(10);
		$df->Cell(1,5,"         ".$numEquipo,0,0,'C',false);
		$df->Cell(10);
		$df->Cell(1,5,"     ".$tipo."  ",0,0,'N',false);
		$df->Cell(40); 
		$df->Cell(1,5,"                                  ".$fechaEntrega,0,0,'C',false);
		$df->Cell(30);
		$df->Multicell(120,5,utf8_decode($descripcionE),0,'J',0);
		
	}
}*/
$df->Ln(6);
$df->SetFont('Arial','B',10);
$df->Cell(95,5,utf8_decode("                        Datos del deudor"),0,0,'',false);
$df->Ln(6);
$df->Cell(95,5,utf8_decode("Nombre: $nombre"),0,0,'',false);
$df->Ln(6);
$df->Cell(95,5,utf8_decode("Dirección: $dom_calle COLONIA $dom_colonia"),0,0,'',false);
$df->Ln(6);
$df->Cell(95,5,utf8_decode("Población: $dom_poblacion"),0,0,'',false);
$df->Ln(20);
$df->Cell(95,5,utf8_decode("Firma (s):_________________________________"),0,0,'',false);
$df->Ln(6);
$df->Cell(95,5,utf8_decode("                Acepto y Pagaré"),0,0,'',false);
$df->Ln(20);
$df->Cell(95,5,utf8_decode("                        Datos de gerente"),0,0,'',false);
$df->Ln(10);
$df->Cell(95,5,utf8_decode("Nombre:__________________________________________"),0,0,'',false);
$df->Ln(15);
$df->Cell(95,5,utf8_decode("Firma:____________________________________________"),0,0,'',false);


//Fondo del texto Gris Claro Claro
/*
//////////////////////////////////////////
//BUSCAR LOS PAGO DE CAPITAL MAS INTERES//
$sql="SELECT  SUM(pago_completo)
	, capturistas.descripcion AS capturista
	, p_pagos.fecha
	, p_distribuidoras.id AS distribuidora_id
	, p_distribuidoras.descripcion AS distribuidora
	, p_pagos.folio_cobrador
	, p_pagos.cobrador_id
	, CONCAT( SUBSTRING(p_pagos.hora,-8,5),' ',p_pagos.ampm) AS hora
	FROM p_pagos
	INNER JOIN p_distribuidoras ON (p_pagos.p_distribuidora_id = p_distribuidoras.id)
	INNER JOIN capturistas ON (capturistas.id = p_pagos.capturista_id)
	WHERE p_pagos.fecha BETWEEN '$fecha_inicial' AND '$fecha_final'
	AND p_distribuidoras.sucursal_id = $sucursal_id 
	GROUP BY p_pagos.id, p_pagos.fecha, p_pagos.p_distribuidora_id, p_pagos.capturista_id
	ORDER BY p_pagos.fecha, p_pagos.p_distribuidora_id, p_pagos.capturista_id";
$arreglo = $funcion->consulta( $sql );
while ( $fila = mysqli_fetch_array( $arreglo ) )
{
	$pago_completo		= $fila[ 0 ];
	$capturista 		= $fila[ 1 ];
	$fecha 				= $fila[ 2 ];
	$distribuidora_id 	= $fila[ 3 ];
	$distribuidora 		= $fila[ 4 ];
	$folio_cobrador 	= $fila[ 5 ];
	$cobrador_id 		= $fila[ 6 ];
	$hora 				= $fila[ 7 ];


		$cont ++;
		$df->Ln(3);
		$df->Cell(1);
		$df->Cell(9,2.5,$cont,0,0,'L',$color);
		$df->Cell(12,2.5,$distribuidora_id,0,0,'L',$color);
		$df->Cell(65,2.5,substr($distribuidora,0,35),0,0,'L',$color);
		$df->Cell(25,2.5,"$".number_format($pago_completo,2),0,0,'R',$color);
		$df->Cell(49,2.5,substr($capturista,0,20),0,0,'L',$color);
		$df->Cell(20,2.5,$fecha,0,0,'L',$color);
		$df->Cell(15,2.5,$hora,0,0,'L',$color);
		//$df->Cell(8,2.5,"",0,0,'L',$color);
	
	
}

$df->SetFont('Arial','B',10);
$df->Ln(6);
$df->Cell(1);
$df->Cell(5,1,$cont,0,0,'L');


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//											 BUSCAR LOS PAGO DE PRESTAMOS PERSONALES 													//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$df->Ln(15);
$df->Cell(70);
$df->Cell(195,4,"PAGOS PRESTAMOS PERSONALES",0,0,'L',false);

$df->SetFillColor(192,192,192); //Fondo del texto Gris Claro
$df->SetFont('Arial','',10);
$df->Ln(5);
$df->Cell(1);
$df->Cell(195,4,"          Id        Distribuidora                                                          Pago          Capturista                                Fecha        Hora",0,0,'L',true);
$df->Ln(2);
$df->Cell(1);
$df->Cell(5,1,"__________________________________________________________________________________________________",0,0,'L');
$df->Ln(1);
$df->SetFont('Arial','',9);
$df->SetFillColor(232,232,232); //Fondo del texto Gris Claro Claro
*/

$df->Output();
?>
