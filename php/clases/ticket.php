<?php
	
    require_once("../conexion/conexion.php");

    class ticket extends Conectar
    {
        
        public function crearTicket($capturistaId,$titulo, $tipo, $desc, $email, $telefono) 
        {
            $res=array();
            $datos=array();
            $resultado  =array();
            $i=0;


            $sql="INSERT INTO b_tickets(capturista_id,titulo, departamento_id, descripcion, email, telefono, fecha_creacion, hora_creacion, estatus_id) 
                     VALUES($capturistaId, '$titulo', '$tipo','$desc', '$email', $telefono, CURDATE(), CURTIME(), 13)";
        
            $resultado = mysqli_query($this->con(), $sql);   

            $datos['b_tickets'] =  array('0' => '0' );
            return  $datos;	
        }

        public function cargarTicketsXusuario($capturista)
        {

            $res=array();
            $datos=array();
            $i=0; 
         
            
            $sql="SELECT t.id, t.`titulo`,DATE_FORMAT( t.fecha_creacion, '%d/%m/%Y') , t.`descripcion`, c.`descripcion`, e.`descripcion`, 
                c2.`descripcion`, t.estatus_id, usu.`descripcion`
                FROM b_tickets t
                INNER JOIN capturistas c ON c.`id`=t.`capturista_id`
                INNER JOIN estatus e ON e.`id`=t.`estatus_id`
                LEFT JOIN capturistas c2 ON c2.id=t.`usuario_resolviendo`
                INNER JOIN b_areas_apooyo usu ON usu.`id`=t.`departamento_id`
                WHERE t.capturista_id=$capturista
                ORDER BY t.id DESC"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['titulo'] = $res[1];
                $datos[$i]['fecha'] = $res[2];
                $datos[$i]['descripcion'] = $res[3];
                $datos[$i]['solicitado'] = $res[4];
                $datos[$i]['estatus'] = $res[5];
                $datos[$i]['usuario_resolviendo'] = $res[6];
                $datos[$i]['id_estatus'] = $res[7];
                $datos[$i]['area_descripcion'] = $res[8];
                $i++;

            } 
            
            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
                }


            return $datos;  

        }

        public function cargarTickets($estatus_id)
        {

            $res=array();
            $datos=array();
            $i=0; 
            $var="";

            if($estatus_id>0)
            {
               $var= "WHERE t.estatus_id=$estatus_id";
            }
            else
            {
                $var="";
            }
            
            $sql="SELECT t.id, t.`titulo`, t.`descripcion`, c.`descripcion`, e.`descripcion`, c2.`descripcion`, t.estatus_id,
            DATE_FORMAT( t.fecha_creacion, '%d/%m/%Y'), t.`hora_creacion`
                FROM b_tickets t
                INNER JOIN capturistas c ON c.`id`=t.`capturista_id`
                INNER JOIN estatus e ON e.`id`=t.`estatus_id`
                left JOIN capturistas c2 ON c2.id=t.`usuario_resolviendo` ".$var." ORDER BY e.`descripcion` ASC"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['titulo'] = $res[1];
                $datos[$i]['descripcion'] = $res[2];
                $datos[$i]['solicitado'] = $res[3];
                $datos[$i]['estatus'] = $res[4];
                $datos[$i]['usuario_resolviendo'] = $res[5];
                $datos[$i]['id_estatus'] = $res[6];
                $datos[$i]['fechaC'] = $res[7];
                $datos[$i]['horaC'] = $res[8];
                $i++;

            } 
            
            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
                }


            return $datos;  

        }

        public function cargarTicketsXid($id_ticket)
        {          
            $res=array();
            $datos=array();
            $i=0; 


            $sql="SELECT t.id, t.`titulo`,t.`fecha_creacion`, t.descripcion,  t.`estatus_id`
            FROM b_tickets t
            WHERE t.id=$id_ticket"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['titulo'] = $res[1];
                $datos[$i]['fecha'] = $res[2];
                $datos[$i]['descripcion'] = $res[3];
                $datos[$i]['estatus_id'] = $res[4];
               
                $i++;

            } 

            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
            }


            return $datos;  

        }

        public function cargarEstatusTicket($id_estatus)
        {

            $res=array();
            $datos=array();
            $i=0; 

            
            $sql="SELECT e.id, e.`descripcion` FROM estatus e WHERE e.id=$id_estatus"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['estatus'] = $res[1];
                $i++;

            } 


            $sql="SELECT e.id, e.`descripcion`
            FROM estatus e WHERE (e.id<>$id_estatus) AND (e.id=1 OR e.id=13 OR e.`id`=2)"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['estatus'] = $res[1];
                $i++;

            } 

            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
                }


            return $datos;  

        }

        public function actualizarStatusTicket($id_ticket, $id_resolviendo, $estatus)
        {
            $res=array();
            $datos=array();
            $resultado  =array();
            $i=0;

            
            if($estatus==2)
            {
                $sql="UPDATE b_tickets SET estatus_id=$estatus, usuario_resolviendo=$id_resolviendo, fecha_resuelto=CURDATE(), hora_resuelto=CURTIME() WHERE id=$id_ticket";
            }
            else
            {
                $sql="UPDATE b_tickets SET estatus_id=$estatus, usuario_resolviendo=$id_resolviendo WHERE id=$id_ticket";
            }
           
            
            $resultado = mysqli_query($this->con(), $sql);   

            $datos['usuarios'] =  array('0' => '0' );
            return  $datos;	
            
        }

        public function agregarMensajeTicket($ticket_id, $mensaje, $usuario)
        {
            $res=array();
            $datos=array();
            $resultado  =array();
            $i=0;

           

            $sql="INSERT INTO b_tickets_chats(id_ticket,mensaje,de_capturista_id, fecha, hora) 
                                VALUES($ticket_id, '$mensaje' , $usuario, CURDATE(), CURTIME())";
        
            $resultado = mysqli_query($this->con(), $sql);   

            $datos['b_tickets_chats'] =  array('0' => '0' );
            return  $datos;	
            
        }

        public function cargarMensajesAdmiTicket($id_ticket)
        {          
            $res=array();
            $datos=array();
            $i=0; 


            $sql="SELECT ch.`id`, ch.`id_ticket`, ch.`mensaje`, c.`descripcion`,DATE_FORMAT( ch.`fecha`, '%d/%b/%Y') AS fecha , DATE_FORMAT(ch.`hora`, '%l:%i%p') AS hora
            FROM b_tickets_chats ch
            INNER JOIN capturistas c ON c.`id`=ch.`de_capturista_id`
            WHERE ch.`id_ticket`=$id_ticket
            ORDER BY ch.id ASC"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id_chat'] = $res[0];
                $datos[$i]['id_ticket'] = $res[1];
                $datos[$i]['mensaje'] = $res[2];
                $datos[$i]['de'] = $res[3];
                $datos[$i]['fecha'] = $res[4];
                $datos[$i]['hora'] = $res[5];
               
                $i++;

            } 

            if ( count($datos )==0) { 
                $datos[0]['id_chat']  =0;
                return  $datos; 
            }


            return $datos;  

        }

        public function cargarSelectEstatus()
        {

            $res=array();
            $datos=array();
            $i=0; 

            
            $sql=" SELECT id, descripcion 
            FROM estatus
            WHERE id=13 OR id=1 OR id=2"; 

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

        public function cargarEstatusTicket2($id_estatus)
        {

            $res=array();
            $datos=array();
            $i=0; 

            
            $sql="SELECT e.id, e.`descripcion` FROM estatus e WHERE e.id=$id_estatus"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['estatus'] = $res[1];
                $i++;

            } 


            $sql="SELECT e.id, e.`descripcion`
            FROM estatus e WHERE e.id<>$id_estatus AND e.id=2"; 

            $resultado = mysqli_query($this->con(), $sql); 

            while ($res = mysqli_fetch_row($resultado)) {
                $datos[$i]['id'] = $res[0];
                $datos[$i]['estatus'] = $res[1];
                $i++;

            } 

            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
                }


            return $datos;  

        }
    }

?>
