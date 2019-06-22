<?php
require_once( '../pdf/pdf.php' );
require_once( '../php/conexion/conexion.php' );
$c = new Conectar();

class DF extends PDF
{
    public function Header()
    {
        parent::Header();
    }

    public function Footer()
    {
        parent::Footer();
    }
}

$fecha_inicial = '01/01/2018';
$fecha_final = '02/02/2018';

$num_equipo 	= $_REQUEST[ 'numEquipo'];
$fecha_entrega 	= $_REQUEST[ 'fecha_entrega' ];
$nombre 	= $_REQUEST[ 'capturista' ];
$comentarios 	= $_REQUEST[ 'comentarios' ];
//$id_equipo = $_REQUEST[ 'id_equipo' ];

/*



$sql = "SELECT nomComercial FROM sucursales WHERE id = $sucursal_id";
$arreglo = $funcion->consulta( $sql );
while ( $fila = mysqli_fetch_array( $arreglo ) )
    $sucursal = $fila[ 0 ];
*/
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
$df->SetFont('Arial','B',17);
$df->Ln(50);
$df->Cell(50);
$df->Cell(195,5,"COMPROBANTE DE ENTREGA",0,0,'J',false);

$df->SetFont('Arial','',12);

$df->Ln(18);


$df->Multicell(180,5,utf8_decode("Comprobante de entrega del equipo con número de folio $num_equipo, el cual pertenece a PRESTAMOS RESPONSABLES SA DE CV y se le hace entrega a $nombre quien se compromete a hacer uso del equipo exclusivamente dentro del ámbito laboral. Especificaciones del equipo entregado:"),0,'J',0);
$df->Ln(10);
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
}
$df->Ln(12);
$df->Multicell(180,5,utf8_decode("                                                Recibe:                                                                             Entrega:"),0,'',0);
$df->Ln(10);
$df->Multicell(180,5,utf8_decode("                             ___________________________                                    ___________________________  "),0,'',0);
$df->Ln(10);
$df->Multicell(180,5,utf8_decode("                                                                                        Lugar y fecha  "),0,'',0);
$df->Ln(10);
$df->Multicell(180,5,utf8_decode("                                                                  ___________________________________ "),0,'',0);

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
