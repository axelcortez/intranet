<?php
require_once( '../pdf/pdf.php' ); 
require_once( '../php/conexion/conexion.php' );
$c = new Conectar();

//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             QR                                                   //
//////////////////////////////////////////////////////////////////////////////////////////////////////
require '../librerias/phpqrcode/qrlib.php'; //Agregamos la libreria para genera códigos QR
$dir = 'qr/'; //Declaramos una carpeta temporal para guardar la imagenes generadas
if(!file_exists($dir)) //Si no existe la carpeta la creamos
    mkdir($dir);
$filename = $dir.'qr.png'; //Declaramos la ruta y nombre del archivo a generar
// Parametros de Condiguración QR //
$tamanio = 10; //Tamaño de Pixel
$level = 'H'; //Precisión L=Baja M=Mediana Q=Alta H=Máxima
$frameSize = 1; //Tamaño en blanco
//echo '<img src="'.$filename.'" />'; //Mostramos la imagen generada
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             QR                                                   //
//////////////////////////////////////////////////////////////////////////////////////////////////////


class DF extends PDF
{
    public function Header()
    {
        //parent::Header("REPORTE PAGOS DE: ");
    }

    public function Footer()
    {
        //parent::Footer();
    }
}

$equipo_id 	= $_REQUEST[ 'equipo_id'];

$df = new DF();
//$df ->FPDF( 'P', 'mm', 'Letter' );
$df ->FPDF( 'P', 'mm',array(62,70) );
$df->AddPage(); 
$df->SetFont('Arial','B',12);

$sql = "SELECT e.id,s.nomComercial,e.num_equipo,t.descripcion FROM i_equipo e
			JOIN sucursales s ON s.id=e.sucursal_id
			JOIN i_tipo_equipo t ON t.id=e.tipo_equipo_id
			WHERE e.id=$equipo_id";
	$resultado = mysqli_query($c->con(), $sql); 
	while ($res = mysqli_fetch_row($resultado)){
		$id = $res[ 0 ];
		$sucursal = $res[ 1 ];
		$num_equipo = $res[ 2 ];
		$tipo = $res[ 3 ];
	}   


//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             QR                                                   //
//////////////////////////////////////////////////////////////////////////////////////////////////////
$contenido = $id.'-'.$sucursal.'-'.$num_equipo.'-'.$tipo; //Texto
QRcode::png($contenido, $filename, $level, $tamanio, $frameSize); //Enviamos los parametros a la Función para generar código QR 
$df->Image("qr/qr.png", 16, 2, 30, 30);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             QR                                                   //
//////////////////////////////////////////////////////////////////////////////////////////////////////
$df->Ln(25); 
$df->Cell(0,1,$num_equipo.' - '.$tipo,0,0,'C');

//---------Consultas------
/*
*/
$df->Output();
?>
