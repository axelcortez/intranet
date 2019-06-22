<?php
	
	require_once("../conexion/conexion.php");

	class Inventario extends Conectar{


			public function registroAreas($area_id,$nombre){
					$capturista_id=$_COOKIE["b_capturista_id"];
					$res=array();
					$datos=array();
					$i=0; 



				if($area_id>0){
					$query="UPDATE b_cat_areas SET descripcion='$nombre' WHERE id=$area_id";  
					$resp=	mysqli_query($this->con(), $query); 

				}else{
					$query="INSERT INTO b_cat_areas (descripcion,estatus_id,capturista_id,fecha_captura,hora_captura)
									VALUES('$nombre',5,$capturista_id,CURDATE(),CURTIME())";  
					$resp=	mysqli_query($this->con(), $query);  
				} 

				if($resp>0){
					$datos[$i]['respuesta'] = '2';
				}else{

					$datos[$i]['respuesta'] = '3';
				}

				return $datos;

			}

			public function cargarAreas(){
				$res=array();
				$datos=array();
				$i=0;

				$query="SELECT b_cat_areas.id,b_cat_areas.descripcion,estatus.descripcion FROM b_cat_areas
							JOIN estatus ON estatus.id=b_cat_areas.estatus_id ORDER BY b_cat_areas.`descripcion` ASC";  
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['area_id'] = $res[0];
					   $datos[$i]['descripcion'] = $res[1]; 
					   $datos[$i]['estatus'] = $res[2]; 
					   $i++;

					} 

				return $datos;
			}

			public function buscarArea($area_id,$area){
				$res=array();
				$datos=array();
				$i=0; 

				if($area_id>0){
					$ql='WHERE b_cat_areas.id='.$area_id;
				}
				else{
					$ql='WHERE b_cat_areas.descripcion like "%$area%"';
				}

				$query="SELECT b_cat_areas.id,b_cat_areas.descripcion,estatus.descripcion FROM b_cat_areas
							JOIN estatus ON estatus.id=b_cat_areas.estatus_id ".$ql;   
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['area_id'] = $res[0];
					   $datos[$i]['descripcion'] = $res[1]; 
					   $datos[$i]['estatus'] = $res[2]; 
					   $i++;

					} 

				return $datos;
			}
			public function desHabilitarArea($area_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="UPDATE b_cat_areas SET estatus_id=6 WHERE id=$area_id";  
					$resp=	mysqli_query($this->con(), $query); 

				return $datos;
			}
			public function eliminarArea($area_id){
				$res=array();
				$datos=array();
				$i=0; 

				$query="DELETE FROM b_cat_areas WHERE id=$area_id";  
					$resp=	mysqli_query($this->con(), $query); 

				return $datos;
			}
			public function deshabilitarResponsivas($equipo_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query=" UPDATE i_responsivas SET estatus=4 WHERE equipo_id=$equipo_id";  
					$resp=	mysqli_query($this->con(), $query); 

				return $datos;
			}

			public function buscarCp($cp){
				$res=array();
				$datos=array();
				$i=0; 

				 $query=" SELECT  cp, estado, c_estado,municipio,c_municipio,ifnull(ciudad,municipio) FROM cp_sepomex WHERE cp=$cp LIMIT 1";   
				 return $query;
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['cp'] = $res[0];
					   $datos[$i]['estado'] = $res[1]; 
					   $datos[$i]['ce'] = $res[2]; 
					   $datos[$i]['municipio'] = $res[3]; 
					   $datos[$i]['cm'] = $res[4]; 
					   $datos[$i]['ciudad'] = $res[5]; 
					   $i++;

					} 

				return $datos;
			}

			public function buscarCpCol($cp){
				$res=array();
				$datos=array();
				$i=0; 

				 $query=" SELECT  colonia FROM cp_sepomex WHERE cp=$cp";   
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['colonia'] = $res[0]; 
					   $i++;

					} 

				return $datos;
			}
			public function registrarStock($txtIdPagoEspecie,$txtFecha,$txtCoordinacion,$cboSucursal,$txtIdDist,$txtDistribuidora,$txtPago,$cboEquipo,$txtMarca,$txtModelo,$txtSerie,$txtDescripcion,$txtUbicacion){
 

				$capturista_id=$_COOKIE["b_capturista_id"];
				$res=array();
				$datos=array();
				$i=0; 

				if ($txtIdPagoEspecie>0) {
					$query="UPDATE b_pagos_especie
									SET 
									  fecha = '$txtFecha',
									  coordinacion = '$txtCoordinacion',
									  distribuidora_id = $txtIdDist,
									  distribuidora = '$txtDistribuidora',
									  pago = '$txtPago',
									  descripcion = '$txtDescripcion',
									  ubicacion = '$txtUbicacion',
									  marca = '$txtMarca',
									  modelo = '$txtModelo',
									  serie = '$txtSerie',
									  estatus_id = 5,
									  fecha_captura = CURDATE(),
									  hora_captura = CURTIME(),
									  capturista_id = $capturista_id
									WHERE id = $txtIdPagoEspecie";
				}else{

				 $query="insert into b_pagos_especie
					            (fecha,
					             coordinacion,
					             sucursal_id,
					             distribuidora_id,
					             distribuidora,
					             pago,
					             tipo_id,
					             descripcion,
					             ubicacion,
					             marca,
					             modelo,
					             serie,
					             estatus_id,
					             fecha_captura,
					             hora_captura,
					             capturista_id)
						values ('$txtFecha',
						        '$txtCoordinacion',
						        '$cboSucursal',
						        '$txtIdDist',
						        '$txtDistribuidora',
						        '$txtPago',
						        '$cboEquipo',
						        '$txtDescripcion',
						        '$txtUbicacion',
						        '$txtMarca',
						        '$txtModelo',
						        '$txtSerie',
						        12,
						        CURDATE(),
						        CURTIME(),
						        $capturista_id);";   

						        //return $query;
					  
				}

				$respuesta= mysqli_query($this->con(), $query);  
				 
						if($respuesta>0){
							$datos[$i]['respuesta'] = '2';
						}else{

							$datos[$i]['respuesta'] = '3';
						}

				return $datos;
			}

			public function cargarPagosEspecie(){
				$res=array();
				$datos=array();
				$i=0; 

				 $query=" SELECT pe.id,te.descripcion,s.nomComercial,pe.descripcion,e.descripcion,pe.distribuidora_id,pe.distribuidora FROM b_pagos_especie pe
							 JOIN i_tipo_equipo te ON te.id=pe.tipo_id
							 JOIN sucursales s ON s.id=pe.sucursal_id
							 JOIN estatus e ON e.id=pe.estatus_id 
							ORDER BY pe.id DESC";    
							 
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['articulo'] = $res[1];
					   $datos[$i]['sucursal'] = $res[2];
					   $datos[$i]['descripcion'] = $res[3];
					   $datos[$i]['estatus'] = $res[4];
					   $datos[$i]['distribuidora_id'] = $res[5];
					   $datos[$i]['distribuidora'] = $res[6];

					   $i++;

					} 

				return $datos;
			}

			public function cambiarEstatusPago($id,$motivo,$sltEstatusPago){
				$res=array();
				$datos=array();
				$i=0; 

				$capturista_id=$_COOKIE["b_capturista_id"];

				 $query="SELECT estatus_id FROM b_pagos_especie WHERE id=$id";   
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {
					   $estatus_actual = $res[0]; 
					}


				$query="INSERT INTO b_cambio_estatus_pe (pago_id,motivo,estatus_actual,estatus_nuevo,fecha_registro,hora_registro,capturista_id)
													VALUE($id,'$motivo',$estatus_actual,$sltEstatusPago,CURDATE(),CURTIME(),$capturista_id)";   
				$respuesta= mysqli_query($this->con(), $query);  


				$query="UPDATE b_pagos_especie SET estatus_id=$sltEstatusPago WHERE id=$id";   
				$respuesta= mysqli_query($this->con(), $query);  

				return $datos[$i]['respuesta'] = '2';


			}

			public function cargarImgStock($id,$docName){
				$res=array();
				$datos=array();
				$i=0; 
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="INSERT INTO b_img_pago_esp (pago_id,docName,capturista_id,fecha_captura,hora_captura)
												VALUE($id,'$docName',$capturista_id,CURDATE(),CURTIME())";   
				$respuesta= mysqli_query($this->con(), $query);  


				if($respuesta>0){
					$datos[$i]['respuesta'] = '2';
				}else{

					$datos[$i]['respuesta'] = '3';
				}

				return $datos;
			}

			public function buscarPago($id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT id,  fecha,  coordinacion,  sucursal_id,  distribuidora_id,  distribuidora,  pago,  tipo_id, descripcion,  ubicacion,  asignado,  marca,  modelo,  serie
						FROM b_pagos_especie
						 WHERE id=$id ";   
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['fecha'] = $res[1];
					   $datos[$i]['coordinacion'] = $res[2];
					   $datos[$i]['sucursal_id'] = $res[3];
					   $datos[$i]['distribuidora_id'] = $res[4];
					   $datos[$i]['distribuidora'] = $res[5];
					   $datos[$i]['pago'] = $res[6];
					   $datos[$i]['tipo_id'] = $res[7];
					   $datos[$i]['descripcion'] = $res[8];
					   $datos[$i]['ubicacion'] = $res[9];
					   $datos[$i]['asignado'] = $res[10];
					   $datos[$i]['marca'] = $res[11];
					   $datos[$i]['modelo'] = $res[12];
					   $datos[$i]['serie'] = $res[13];
					   $i++;

					} 
				return $datos;
			}

			public function cargarStock(){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT pe.id,d.docName,te.descripcion equipo,CONCAT(pe.descripcion,' ',pe.marca,' ','Modelo :',modelo) descripcion,ROUND((pe.pago-(pe.pago*.10))) precio,pe.pago precioNormal,IF((pe.pago-(pe.pago*.10))<=6000,'5-10','10-14') quincenas,pe.fecha_captura,IF( DATEDIFF(CURDATE(),pe.fecha_captura)>7,1,0) antiguedad FROM b_img_pago_esp d
						JOIN b_pagos_especie pe ON pe.id=d.pago_id
						JOIN i_tipo_equipo te ON te.id=pe.tipo_id
						WHERE pe.estatus_id=5 GROUP BY d.pago_id ORDER BY pe.fecha DESC";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['imagen'] = $res[1];
					   $datos[$i]['tipo'] = $res[2];
					   $datos[$i]['descripcion'] = $res[3];
					   $datos[$i]['precio'] = $res[4];
					   $datos[$i]['precio_real'] = $res[5];
					   $datos[$i]['quincenas'] = $res[6];
					   $datos[$i]['fecha_captura'] = $res[7];
					   $datos[$i]['antiguedad'] = $res[8];
					   $i++;

					} 
				return $datos;
			}
			public function cargarCarousel($id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT pe.id,d.docName,te.descripcion equipo,CONCAT(pe.descripcion,' ',pe.marca,' ','Modelo :',modelo) descripcion,ROUND((pe.pago-(pe.pago*.10))) precio,pe.pago precioNormal,IF((pe.pago-(pe.pago*.10))<=6000,'5-10','10-14') quincenas,pe.fecha_captura,IF( DATEDIFF(CURDATE(),pe.fecha_captura)>7,1,0) antiguedad FROM b_img_pago_esp d
						JOIN b_pagos_especie pe ON pe.id=d.pago_id
						JOIN i_tipo_equipo te ON te.id=pe.tipo_id
						WHERE pe.estatus_id=5 AND pe.id=$id  ORDER BY pe.fecha DESC";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['imagen'] = $res[1];
					   $datos[$i]['tipo'] = $res[2];
					   $datos[$i]['descripcion'] = $res[3];
					   $datos[$i]['precio'] = number_format($res[4],2);
					   $datos[$i]['precio_real'] = number_format($res[5],2);
					   $datos[$i]['quincenas'] = $res[6];
					   $datos[$i]['fecha_captura'] = $res[7];
					   $datos[$i]['antiguedad'] = $res[8];
					   $i++;

					} 
				return $datos;
			}

			public function cargarPrevioEnSolicitud($id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT pe.id,d.docName,te.descripcion equipo,CONCAT(pe.descripcion,' ',pe.marca,' ','Modelo :',modelo) descripcion,ROUND((pe.pago-(pe.pago*.10))) precio,pe.pago precioNormal,IF((pe.pago-(pe.pago*.10))<=6000,'5-10','10-14') quincenas,pe.fecha_captura,IF( DATEDIFF(CURDATE(),pe.fecha_captura)>7,1,0) antiguedad FROM b_img_pago_esp d
						JOIN b_pagos_especie pe ON pe.id=d.pago_id
						JOIN i_tipo_equipo te ON te.id=pe.tipo_id
						WHERE pe.estatus_id=5 AND pe.id=$id GROUP BY d.pago_id  ORDER BY pe.fecha DESC";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['imagen'] = $res[1];
					   $datos[$i]['tipo'] = $res[2];
					   $datos[$i]['descripcion'] = $res[3];
					   $datos[$i]['precio'] = $res[4];
					   $datos[$i]['precio_real'] = $res[5];
					   $datos[$i]['quincenas'] = $res[6];
					   $datos[$i]['fecha_captura'] = $res[7];
					   $datos[$i]['antiguedad'] = $res[8];
					   $i++;

					} 
				return $datos;
			}
			public function guardarSolicitud($articulo_id,$capturista_id,$comentario,$quincenas){
				$res=array();
				$datos=array();
				$i=0; 
			
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="INSERT INTO b_solicitud_articulo(comentario,articulo_id,empleado_id,quincenas,nota_autorizacion,estatus_id,fecha_captura,hora_captura)
			   										VALUE('$comentario',$articulo_id,$capturista_id,$quincenas,' ',5,CURDATE(),CURTIME())";   
				$respuesta= mysqli_query($this->con(), $query);  


				if($respuesta>0){
					$datos[$i]['respuesta'] = '2';
				}else{

					$datos[$i]['respuesta'] = '3';
				}

				return $datos;
			}

			public function cargarSolicitudes(){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT pe.id,c.descripcion,s.nomComercial,te.descripcion,ROUND((pe.pago-(pe.pago*.10))) costo, es.descripcion ,CONCAT(sa.fecha_captura,' ',sa.hora_captura) fecha,sa.id,sa.estatus_id FROM b_solicitud_articulo sa
						JOIN b_pagos_especie pe ON pe.id=sa.articulo_id 
						JOIN capturistas c ON c.id=sa.empleado_id
						JOIN sucursales s ON s.id=c.sucursal_id
						JOIN estatus es ON es.id=sa.estatus_id
						JOIN i_tipo_equipo te ON te.id=pe.tipo_id
						 ORDER BY sa.id DESC";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['id'] = $res[0]; 
					   $datos[$i]['solicitante'] = $res[1];
					   $datos[$i]['sucursal'] = $res[2];
					   $datos[$i]['articulo'] = $res[3];
					   $datos[$i]['costo'] = $res[4];
					   $datos[$i]['estatus'] = $res[5];
					   $datos[$i]['fecha'] = $res[6];
					   $datos[$i]['solicitud_id'] = $res[7];  
					   $datos[$i]['estatus_id'] = $res[8];
					    $i++;

					} 
				return $datos;
			}
			public function verSolicitud($solicitud_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT sa.empleado_id,c.descripcion,sa.comentario,ROUND((DATEDIFF(CURDATE(),c.fecha_ingreso)/365),2) antiguedad FROM b_solicitud_articulo sa
							JOIN capturistas c ON c.id=sa.empleado_id WHERE sa.id=$solicitud_id";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['empleado_id'] = $res[0]; 
					   $datos[$i]['empleado'] = $res[1];
					   $datos[$i]['comentario'] = $res[2];
					   $datos[$i]['antiguedad'] = $res[3]." Años";
					    $i++;

					} 
				return $datos;
			}
			public function preAutorizarSolicitud($solicitud_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT sa.empleado_id,c.descripcion,sa.articulo_id,sa.id,pe.pago ,round(pe.pago-(pe.pago*.10)) c_descuento,sa.quincenas,
				 			round((pe.pago-(pe.pago*.10))/quincenas) FROM b_solicitud_articulo sa
							JOIN capturistas c ON c.id=sa.empleado_id 
							JOIN b_pagos_especie pe ON pe.id=sa.articulo_id WHERE sa.id=$solicitud_id";    

					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) {

					   $datos[$i]['empleado_id'] = $res[0]; 
					   $datos[$i]['empleado'] = $res[1];
					   $datos[$i]['articulo_id'] = $res[2]; 
					   $datos[$i]['solicitud_id'] = $res[3];
					   $datos[$i]['precio'] = $res[4];
					   $datos[$i]['p_descuento'] = $res[5];
					   $datos[$i]['quincenas'] = $res[6];
					   $datos[$i]['pagoQuincenal'] = $res[7];
					    $i++;

					} 
				return $datos;
			}

			public function autorizarSolicitud($solicitud_id,$nota,$quincenas,$pago_quincenal,$monto){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="UPDATE b_solicitud_articulo SET autorizante=$capturista_id,monto=$monto,quincenas=$quincenas,pago_quincenal=$pago_quincenal,nota_autorizacion='$nota',fecha_autorizado=CURDATE(),hora_autorizado=CURTIME(),estatus_id=10	WHERE id=$solicitud_id";  
				mysqli_query($this->con(), $query);  

				$query="SELECT articulo_id,empleado_id FROM b_solicitud_articulo WHERE id=$solicitud_id";   
				$respuesta= mysqli_query($this->con(), $query);  
				while ($res = mysqli_fetch_row($respuesta)){
					$articulo_id = $res[0];
					$empleado_id =$res[1];
				} 
				   	

				
				$query="UPDATE b_pagos_especie SET estatus_id=11 WHERE id=$articulo_id"; 
						$respuesta= mysqli_query($this->con(), $query);

				$query="UPDATE b_solicitud_articulo SET estatus_id=2 WHERE articulo_id=$articulo_id AND id<>$solicitud_id"; 
						$respuesta= mysqli_query($this->con(), $query);  

				$query="INSERT INTO b_inbox(mensaje,emisor_id,fecha_envio,hora_envio,receptor_id)
						VALUE('SU SOLICITUD DE ARTICULO FUE APROVADA SIGA EL PROCESO CON SU GERENTE',0,CURDATE(),CURTIME(),$empleado_id)"; 
						$respuesta= mysqli_query($this->con(), $query);

				$datos[$i]['respuesta'] = '2';	

				return $datos;
			}


			public function mensajesPendientes($capturista_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT COUNT(*) FROM b_inbox WHERE receptor_id=$capturista_id";  
				// return $query;
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $datos[$i]['mensajes'] = $res[0];  


				return $datos;
			}


			public function cargarMensajes($capturista_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT COUNT(*) FROM b_inbox WHERE receptor_id=$capturista_id";  
				// return $query;
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $datos[$i]['mensajes'] = $res[0];   
					
				return $datos;
			}
			public function validarQuincenas($articulo_id){
				$res=array();
				$datos=array();
				$i=0; 

				 $query="SELECT ROUND((pe.pago-(pe.pago*.10))) precio FROM b_img_pago_esp d
						JOIN b_pagos_especie pe ON pe.id=d.pago_id
						JOIN i_tipo_equipo te ON te.id=pe.tipo_id
						WHERE pe.estatus_id=5 AND pe.id=$articulo_id GROUP BY d.pago_id  ORDER BY pe.fecha DESC";   
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $datos[$i]['precio'] = $res[0];   
					
				return $datos;
			}

			public function cargarAreasParaFiltrarInventario()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id, descripcion 
				FROM b_cat_areas
				WHERE estatus_id=5"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarEquiposPorInventarioArea($inventario_id, $sucursal_id, $area_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($area_id==0)
				{
						$sql="SELECT e.id, t.`descripcion`, s.`nomComercial`, IFNULL(c.`descripcion`,'-'),IFNULL(d.`equipo_id`,'-') AS invetariado,
						a.`descripcion`, e.`descripcion`,e.marca, e.`modelo`, e.`valor_factura`, e.`serie`
						FROM i_equipo e 
						LEFT JOIN i_inventario_detalle d ON d.`equipo_id`=e.`id` AND d.`inventario_id`= $inventario_id
						INNER JOIN sucursales s ON s.id=e.`sucursal_id`
						LEFT JOIN capturistas c ON c.id=e.`encargado_id`
						INNER JOIN i_tipo_equipo t ON t.id=e.`tipo_equipo_id`
						INNER JOIN b_cat_areas a ON a.id=e.`area_id` 
						WHERE e.`sucursal_id`= $sucursal_id 
						ORDER BY invetariado DESC";
				}
				else
				{
						$sql="SELECT e.id, t.`descripcion`, s.`nomComercial`, IFNULL(c.`descripcion`,'-'),IFNULL(d.`equipo_id`,'-') AS invetariado,
						a.`descripcion`, e.`descripcion`,e.marca, e.`modelo`, e.`valor_factura`, e.`serie`
						FROM i_equipo e 
						LEFT JOIN i_inventario_detalle d ON d.`equipo_id`=e.`id` AND d.`inventario_id`= $inventario_id
						INNER JOIN sucursales s ON s.id=e.`sucursal_id`
						LEFT JOIN capturistas c ON c.id=e.`encargado_id`
						INNER JOIN i_tipo_equipo t ON t.id=e.`tipo_equipo_id`
						INNER JOIN b_cat_areas a ON a.id=e.`area_id` 
						WHERE e.`sucursal_id`= $sucursal_id AND a.id=$area_id
						ORDER BY invetariado DESC";
				}
				

				
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_equipo'] = $res[0];
				   $datos[$i]['tipo_equipo'] = $res[1];
				   $datos[$i]['sucursal_nombre'] = $res[2];
				   $datos[$i]['encargado'] = $res[3];
				   $datos[$i]['inventariado'] = $res[4];
				   $datos[$i]['area'] = $res[5];
					 $datos[$i]['descripcion'] = $res[6];
					 $datos[$i]['marca'] = $res[7];
				   $datos[$i]['modelo'] = $res[8];
					 $datos[$i]['valor_factura'] = $res[9];
					 $datos[$i]['serie'] = $res[10];
				  
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_equipo']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

}

?>