<?php
	
	require_once("../conexion/conexion.php");

    class Votacion extends Conectar
    {
        public function verifVoto($capturista_id)
        {
            $res=array();
            $datos=array();
            $i=0;

            $query="SELECT COUNT(id) FROM b_votaciones WHERE capturista_id=$capturista_id";  
                $respuesta= mysqli_query($this->con(), $query);  
                while ($res = mysqli_fetch_row($respuesta)) {

                   $datos[$i]['conteo'] = $res[0];
                   
                   $i++;

                } 

            return $datos;

        }

        public function verifSucursal($sucursal)
        {
            $res=array();
            $datos=array();
            $i=0;

            $query="SELECT id_sucursal, numero, sucursal
            FROM b_sucursales_votaciones
            WHERE id_sucursal=$sucursal";  
                $respuesta= mysqli_query($this->con(), $query);  
                while ($res = mysqli_fetch_row($respuesta)) {

                   $datos[$i]['id_sucursal'] = $res[0];
                   $datos[$i]['numero'] = $res[1];
                   $datos[$i]['sucursal'] = $res[2];
                   
                   $i++;

                } 

            return $datos;

        }

        public function insertarVotacion($idsuc,$capturista_id)
        {
            $res=array();
            $datos=array();
            $resultado  =array();
            $i=0;

           

            $sql="INSERT INTO b_votaciones(id_suc,capturista_id) 
                                VALUES($idsuc,$capturista_id)";
        
            $resultado = mysqli_query($this->con(), $sql);   

            $datos['b_votaciones'] =  array('0' => '0' );
            return  $datos;	
        }

        public function resultadosVotaciones()
        {
            $res=array();
            $datos=array();
            $i=0;

            $query="SELECT v.`id_suc`, s.id, s.nomComercial, COUNT(v.`id`)
            FROM b_votaciones v
            INNER JOIN capturistas c ON c.id=v.capturista_id
            INNER JOIN b_sucursales_votaciones sv ON sv.numero=v.id_suc
            INNER JOIN sucursales s ON s.id=sv.id_sucursal
            GROUP BY s.nomComercial
            ORDER BY COUNT(v.id) DESC";  
                $respuesta= mysqli_query($this->con(), $query);  
                while ($res = mysqli_fetch_row($respuesta)) {

                   $datos[$i]['numero_altar'] = $res[0];
                   $datos[$i]['id_suc'] = $res[1];
                   $datos[$i]['sucursal'] = $res[2];
                   $datos[$i]['votos'] = $res[3];
                   
                   $i++;

                } 

            return $datos;

        }
}

?>