<?php
	
    require_once("../conexion/conexion.php");

    class ahorro extends Conectar
    {
        public function verificarArchivo($capturista)
        {
           $q="";
            $res=array();
            $datos=array();
            $i=0; 

            $sql="SELECT f.id, f.capturista_id, f.ruta_archivo, f.fecha_subida, f.hora_subida, f.aceptar,  c.descripcion
            FROM b_carta_fondoahorro f 
            INNER JOIN capturistas c ON c.id=f.capturista_id
            WHERE f.capturista_id=$capturista"; 

           
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) {

                $datos[$i]['id'] = $res[0];
                $datos[$i]['capturista_id'] = $res[1];
                $datos[$i]['ruta_archivo'] = $res[2];
                $datos[$i]['fecha_subida'] = $res[3];
                $datos[$i]['hora_subida'] = $res[4];
                $datos[$i]['acepto'] = $res[5];
                $datos[$i]['capturista'] = $res[6];

                $i++;

            } 
            if ( count($datos )==0) { 
                $datos[0]['id']  =0;
                return  $datos; 
            }
            return $datos;  

        }

        public function agregarArchivo($ruta,$capturistaId, $acepto) 
        {
            $res=array();
            $datos=array();
            $resultado  =array();
            $i=0;

            $ruta=$capturistaId.'_'.date("Y-m-d").'_'.$ruta;
            $sql="INSERT INTO b_carta_fondoahorro (capturista_id, ruta_archivo, fecha_subida, hora_subida, aceptar) 
                     VALUES($capturistaId, '$ruta', CURDATE(), CURTIME(),'$acepto')";
        
            $resultado = mysqli_query($this->con(), $sql);   

            $datos['b_carta_fondoahorro'] =  array('0' => '0' );
            return  $datos;	
        }

        public function eliminarArchivo($id_capturista)
        {
            $res=array();
            $datos=array();
            $resultado  =array();
           
            $sql="DELETE from b_carta_fondoahorro WHERE capturista_id=$id_capturista";
            
            $resultado = mysqli_query($this->con(), $sql);   
            $datos['b_carta_fondoahorro'] =  array('0' => '0' );
            return  $datos;	
        }

        public function cargarSolicitudes()
        {
           $q="";
            $res=array();
            $datos=array();
            $i=0; 

            $sql="SELECT f.id, f.capturista_id, f.ruta_archivo, f.fecha_subida, f.hora_subida, f.aceptar,  c.descripcion
            FROM b_carta_fondoahorro f 
            INNER JOIN capturistas c ON c.id=f.capturista_id"; 

           
            $resultado = mysqli_query($this->con(), $sql); 
            while ($res = mysqli_fetch_row($resultado)) {

                $datos[$i]['id'] = $res[0];
                $datos[$i]['capturista_id'] = $res[1];
                $datos[$i]['ruta_archivo'] = $res[2];
                $datos[$i]['fecha_subida'] = $res[3];
                $datos[$i]['hora_subida'] = $res[4];
                $datos[$i]['acepto'] = $res[5];
                $datos[$i]['capturista'] = $res[6];

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
