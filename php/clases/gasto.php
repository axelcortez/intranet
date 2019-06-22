<?php
	
    require_once("../conexion/conexion.php");

    class gastos extends Conectar
    {
        public function buscarCuentas()
        {  
            $res=array();
            $datos=array();
            $i=0;   
            $sql="SELECT * FROM gastos WHERE scta=0";   
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0];
                $datos[$i]['cta'] = $res[1];
                $datos[$i]['scta'] = $res[2];
                $datos[$i]['descripcion'] = $res[3];    
                $i++;
            } 
           
            return $datos; 
        } 
        public function buscarSubCuentas($cta)
        {  
            $res=array();
            $datos=array();
            $i=0;   
            $sql="SELECT * FROM gastos WHERE cta=$cta AND scta>0";   
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0];
                $datos[$i]['cta'] = $res[1];
                $datos[$i]['scta'] = $res[2];
                $datos[$i]['descripcion'] = $res[3];    
                $i++;
            } 
           
            return $datos; 
        } 
        public function generarSolicitudDeGasto($cuenta_id,$subCuenta_id,$sucursal_id,$importe,$concepto,$Evidencia,$Cotizacion,$notificaciones)
        {  
            $res=array();
            $datos=array();
            $i=0;   
            $longitudArreglo = count($notificaciones);  
            $mysqli = $this->con();
            $capturista_id=$_COOKIE["b_capturista_id"]; 
            $capturista =$_COOKIE['b_capturista'];
            $aCotizacion= $_COOKIE["b_capturista_id"]."_".date("Y-m-d")."_".$Cotizacion;
            $aEvidencia= $_COOKIE["b_capturista_id"]."_".date("Y-m-d")."_".$Evidencia;

            $sql="INSERT INTO  solicitud_gasto (gasto_id,fecha,importe,concepto,autoriza,entrega,recibe,sucursal_id,caja,estatus_id,capturista_id,fecha_quincena)
                                        VALUES ($subCuenta_id,CURDATE(),$importe,'$concepto','','BANCO','',$sucursal_id,'Vale',4,$capturista_id,CURDATE())";   
            if (!$resultado=$mysqli->query($sql)){
                $codigo="Error codigo:".$mysqli->errno;
                $mensage = " ".$mysqli->error;
                $resultado=$codigo.$mensage; 

                $datos[0]['estatus']=1; 
                $datos[0]['error']=$resultado;
                        
            }else{ 
                $sql="SELECT id FROM solicitud_gasto WHERE capturista_id=$capturista_id AND gasto_id=$subCuenta_id AND fecha=CURDATE() ORDER BY id DESC LIMIT 1";    
                $resultado = mysqli_query($mysqli, $sql); 
                while ($res = mysqli_fetch_row($resultado)) 
                    $solicitud_id = $res[0];

                if($aEvidencia!='' && $aCotizacion!=''){
                    $sqlinsert ="INSERT INTO  b_detalles_solicitud_gasto (solicitud_id,capturista_id,imagen,tipo,fecha_captura,hora_captura)
                    VALUES ($solicitud_id,$capturista_id,'$aEvidencia','E',CURDATE(),CURTIME()),
                         ($solicitud_id,$capturista_id,'$aCotizacion','C',CURDATE(),CURTIME())";  
                    $resultado = mysqli_query($mysqli, $sqlinsert);  

                }else{
                    if($aEvidencia!='' || $aCotizacion!=''){
                        if($aEvidencia!=''){
                            $sqlinsert ="INSERT INTO  b_detalles_solicitud_gasto (solicitud_id,capturista_id,imagen,tipo,fecha_captura,hora_captura)
                            VALUES ($solicitud_id,$capturista_id,'$aEvidencia','E',CURDATE(),CURTIME())";  
                            $resultado = mysqli_query($mysqli, $sqlinsert);  
                
                        }else{
                            $sqlinsert ="INSERT INTO  b_detalles_solicitud_gasto (solicitud_id,capturista_id,imagen,tipo,fecha_captura,hora_captura)
                             VALUES ($solicitud_id,$capturista_id,'$aCotizacion','C',CURDATE(),CURTIME())";  
                            $resultado = mysqli_query($mysqli, $sqlinsert); 
                        } 
                    }
                } 
                $datos[0]['estatus']=0; 
            }  
            
            if($longitudArreglo>0){
                //Recorro todos los elementos
                for($i=0; $i<$longitudArreglo; $i++)
                { 
                    $empleado_id=$notificaciones[$i]; 
                    $sql="SELECT capturista_id,capturistas.descripcion,correo FROM b_correos 
                                JOIN capturistas ON capturistas.id=b_correos.capturista_id
                            WHERE b_correos.capturista_id=$empleado_id";    
                    $resultado = mysqli_query($mysqli, $sql); 
                    while ($res = mysqli_fetch_row($resultado)){
                        $empleado = $res[1];
                        $correo =   $res[2]; 
                        //$enviados = $this->enviarCorreo($empleado,$correo,$capturista);
                    } 
                        
                    mysqli_query($mysqli,"INSERT INTO b_notificacion_gasto (empleado_id,solicitud_id) VALUES($empleado_id,$solicitud_id)");
                    
                }
            }
           
            return $datos; 
        } 
        public function buscarSucursalesPorEmpresa($b_empresa)
        {  
            $res=array();
            $datos=array();
            $i=0;   
            if($b_empresa==1)
                $sql="SELECT id,nomComercial FROM sucursales WHERE b_empresa IN(1,2,3,4,5,6) AND b_estatus='S'"; 
            else
                $sql="SELECT id,nomComercial FROM sucursales WHERE b_empresa=$b_empresa AND b_estatus='S'"; 
  
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0];
                $datos[$i]['nomComercial'] = $res[1];  
                $i++;
            } 
           
            return $datos; 
        } 

        public function cargarCorreosEmpresa()
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $sql="SELECT capturistas.id,capturistas.descripcion,IFNULL(b_correos.correo,'NO CUENTA CON CORREO') correo FROM capturistas
            LEFT JOIN b_correos ON b_correos.capturista_id=capturistas.id
                        WHERE estatus_id=5";  
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0];
                $datos[$i]['empleado'] = $res[1];
                $datos[$i]['correo'] = $res[2];   
                $i++;
            } 
           
            return $datos; 
        } 

        public function notificarEmpleado()
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $sql="SELECT capturistas.id,capturistas.descripcion,IFNULL(b_correos.correo,'NO CUENTA CON CORREO') correo FROM capturistas
            LEFT JOIN b_correos ON b_correos.capturista_id=capturistas.id
                        WHERE estatus_id=5";  
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0];
                $datos[$i]['empleado'] = $res[1];
                $datos[$i]['correo'] = $res[2];   
                $i++;
            } 
           
            return $datos; 
        }

        public function cargarSolicitudesDeGastos($fecha_inicial,$fecha_final)
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $capturista_id=$_COOKIE["b_capturista_id"]; 
            $sql="SELECT * FROM v_gastos WHERE capturista_id=$capturista_id AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final' UNION 
                SELECT * FROM v_notificacion_gastos WHERE capturista_id=$capturista_id AND fecha BETWEEN '$fecha_inicial' AND '$fecha_final'";  
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0]; 
                $datos[$i]['fecha'] = $res[1]; 
                $datos[$i]['cuenta'] = $res[2]; 
                $datos[$i]['importe'] = $res[3]; 
                $datos[$i]['estatus'] = $res[4];  
                $i++;
            } 

         
           
            return $datos; 
        }

        public function documentosSolicitud($solicitud_id)
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $capturista_id=$_COOKIE["b_capturista_id"]; 
            $sql="SELECT id,imagen,tipo FROM b_detalles_solicitud_gasto WHERE solicitud_id=$solicitud_id";  
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) { 
                $datos[$i]['id'] = $res[0]; 
                $datos[$i]['imagen'] = $res[1]; 
                $datos[$i]['tipo'] = $res[2];  
                $i++;
            }  
            return $datos; 
        }

        public function guardarComentario($solicitud_id,$comentario)
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $capturista_id=$_COOKIE["b_capturista_id"]; 
            $sql="INSERT INTO b_comentarios_solicitudes(solicitud_id,capturista_id,comentario,fecha,hora)
                                                VALUES($solicitud_id,$capturista_id,'$comentario',CURDATE(),CURTIME())";  

            $resultado = mysqli_query($this->con(), $sql); 

            if($resultado>0){
                $datos[0]['estatus']=1;
            }else{
                $datos[0]['estatus']=0;
            }
             
            return $datos; 
        }

        public function cargarComentariosSolicitud($solicitud_id)
        {  
            $res=array();
            $datos=array();
            $i=0;    
            $capturista_id=$_COOKIE["b_capturista_id"]; 
            $sql="SELECT n.capturista_id,c.descripcion,n.comentario,n.fecha,n.hora FROM b_comentarios_solicitudes n
            JOIN capturistas c ON c.id=n.capturista_id
            WHERE n.solicitud_id=$solicitud_id  ";   
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) {  

                if($res[0]==$capturista_id) 
                    $emisor="S";
                else
                    $emisor="N";
                
                $datos[$i]['capturista_id'] = $res[0]; 
                $datos[$i]['capturista'] = $res[1]; 
                $datos[$i]['comentario'] = $res[2]; 
                $datos[$i]['fecha'] = $res[3]; 
                $datos[$i]['hora'] = $res[4];  
                $datos[$i]['emisor'] =$emisor; 

                $i++;
            }  
             
            return $datos; 
        }

        public function enviarCorreo($empleado,$correo,$emisor ){

					   
            $correopara = strip_tags(htmlspecialchars($correo));   
            $correode = strip_tags(htmlspecialchars($emisor)); 
               
            // Create the email and send the message
            $to = $correopara; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
            $email_subject = "Hola se te notifica que $correode a solicitado un gasto y le gustaria que estes al tanto.";
            $email_body = "$correode esta solicitando un gasto y le gustaria que estes al tanto, para mas informacion visita intranet.bancaprepa.com el apartado de solicitud de gastos."; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
              
            $headers = "noreply@bancaprepa.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.   
            //$headers .= "Reply-To: $correode"; 
            mail($to,$email_subject,$email_body,$headers);
            return true;      
        }

       
    }

?>
