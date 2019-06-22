<?php
require_once( '../pdf/pdf.php' );
require_once( '../php/conexion/conexion.php' );
$c = new Conectar();

class DF extends PDF
{
    

    
}



$empleado_id = $_REQUEST[ 'id_capturista'];




$sql = "SELECT c.id, c.descripcion, s.nomComercial, c.fecha_ingreso, UPPER(c.dom_calle), UPPER(c.dom_colonia), d.descripcion, r.descripcion
        FROM capturistas c
        INNER JOIN sucursales s ON s.id=c.sucursal_id
        INNER JOIN departamentos d ON d.id=c.departamento_id
        INNER JOIN roles r ON r.id=c.rol_id
		WHERE c.id=$empleado_id";
	$resultado = mysqli_query($c->con(), $sql); 
	while ($res = mysqli_fetch_row($resultado)) 
	{
		$capturista_id   = $res[ 0 ];
		$capturista      = $res[ 1 ];
		$sucursal        = $res[ 2 ];
        $fecha_ingreso   = $res[ 3 ];
        $d_calle         = $res[ 4 ];
        $d_colonia       = $res[ 5 ];
        $departamento    = $res[ 6 ];
        $puesto          = $res[ 7 ];
	}


    

$df = new DF();
$df->FPDF( 'P', 'mm', 'Letter' );
$df->AddPage();
$df->Image("../img/fondoAhorro.jpg", 0, 0, 216, 280);




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//											 BUSCAR LOS PAGO DE RELACION DE VALES 														//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$df->Ln(50);
$df->Ln(11);
$df->SetFont('Arial','',10);
$df->Cell(95,5,utf8_decode("                                     ".$capturista),0,0,'L');
$df->Ln(0.1);
$df->Cell(95,5,utf8_decode("                                                                                                                                                       ".$capturista_id),0,0,'L');
$df->Ln(10);
$df->Cell(95,5,utf8_decode("                                     ".$d_calle." COLONIA ".$d_colonia),0,0,'L');
$df->Ln(10);
$df->Cell(68,5,"                                                   ".$fecha_ingreso."                                                                      ".$sucursal,0,0,'L');

$df->Ln(10);
$df->Cell(95,5,utf8_decode("                                     ".$puesto),0,0,'L');
$df->Ln(0.1);
$df->Cell(95,5,utf8_decode("                                                                                                                                             ".$departamento),0,0,'L');

$df->Output();
?>
