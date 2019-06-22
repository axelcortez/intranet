<?php
	
	require_once("../conexion/conexion.php");

	class Grupo extends Conectar{


			public function listaDeEmpleadosActivos(){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];
					$query="SELECT c.id,CONCAT(c.id,' - ', c.descripcion,' - ',d.descripcion) capturista,IFNULL(em.correo,'SIN CORREO') correo FROM capturistas  c
								JOIN roles d ON d.id=c.rol_id
								LEFT JOIN b_correos em ON em.capturista_id=c.id
							WHERE c.estatus_id=5 AND  c.id NOT IN($capturista_id)";  
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) { 
					   $datos[$i]['capturista_id'] = $res[0];
					   $datos[$i]['capturista'] = $res[1]; 
					   $datos[$i]['correo'] = $res[2]; 
					   $i++;

					} 

				return $datos;
					 
			}

			public function listaDeEmpleadosActivosPorNombre($empleado){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];
					$query="SELECT c.id,CONCAT(c.id,' - ', c.descripcion,' - ',d.descripcion) capturista,IFNULL(em.correo,'SIN CORREO') correo FROM capturistas  c
								JOIN roles d ON d.id=c.rol_id
								LEFT JOIN b_correos em ON em.capturista_id=c.id
							WHERE c.estatus_id=5 AND   c.descripcion like '%$empleado%' AND  c.id NOT IN($capturista_id)"; 
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) { 
					   $datos[$i]['capturista_id'] = $res[0];
					   $datos[$i]['capturista'] = $res[1]; 
					   $datos[$i]['correo'] = $res[2]; 
					   $i++;

					} 

				return $datos;
					 
			}

			public function empleadoTmp($empleado_id){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="SELECT count(integrante_id) FROM b_grupo_tmp WHERE capturista_id=$capturista_id AND integrante_id=$empleado_id";  
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $empleado = $res[0];
 
				if($empleado>1){
					$datos[0]['respuesta']  =2;
				}else{
					$query="INSERT INTO b_grupo_tmp (capturista_id,integrante_id) VALUES ($capturista_id,$empleado_id)";  
					 mysqli_query($this->con(), $query); 
					 $datos[0]['respuesta']  =1;
				}   
				
				return $datos;
					 
			}

			public function cargarIntegrantesTmpDeGrupo(){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="SELECT c.id, c.descripcion,em.correo FROM capturistas c
							JOIN b_correos em ON em.capturista_id=c.id
						WHERE c.id=$capturista_id
						UNION 
						SELECT c.id, c.descripcion,IFNULL(em.correo,'SIN CORREO') correo FROM b_grupo_tmp gt
							JOIN capturistas c ON c.id=gt.integrante_id
							LEFT JOIN b_correos em ON em.capturista_id=c.id
						WHERE gt.capturista_id=$capturista_id
						";  
				$respuesta= mysqli_query($this->con(), $query);  
				while ($res = mysqli_fetch_row($respuesta)) { 
				   $datos[$i]['capturista_id'] = $res[0];
				   $datos[$i]['capturista'] = $res[1]; 
				   $datos[$i]['correo'] = $res[2]; 
				   $i++;
 				}
				
				return $datos;
					 
			}

			public function eliminarIntegrante($integrante_id){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query="DELETE FROM b_grupo_tmp WHERE capturista_id=$capturista_id AND integrante_id=$integrante_id";  
				 mysqli_query($this->con(), $query);  
				  
				return $this->cargarIntegrantesTmpDeGrupo();
					 
			}

			public function guardarGrupo($nombre,$fecha_inicio,$fecha_final){
				$res=array();
				$datos=array();
				$i=0; 
				$capturista_id=$_COOKIE["b_capturista_id"]; 
 
					//validamos que el grupo cuente con personas 
				$query="SELECT count(integrante_id) FROM b_grupo_tmp WHERE   capturista_id=$capturista_id";  
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $integrantes = $res[0];
 	 
					//validamos que existan integrates
				if($integrantes>0){
					//guardamos el grupo
					$query="INSERT INTO  b_grupos_trabajo  (descripcion,integrantes,fecha_inicio,fecha_final,capturista_id,fecha_registro,hora_registro)
									VALUES ('$nombre',$integrantes+1,'$fecha_inicio','$fecha_final',$capturista_id,CURDATE(),CURTIME());";  
							 mysqli_query($this->con(), $query); 
					//sacamos el id del grupo guardado previamente
					$query="SELECT id FROM b_grupos_trabajo WHERE descripcion='$nombre' AND capturista_id=$capturista_id";  
					$respuesta= mysqli_query($this->con(), $query);  
					while ($res = mysqli_fetch_row($respuesta)) 
					   $grupo_id = $res[0];



							$query="SELECT c.id  FROM capturistas c 
									WHERE c.id=$capturista_id
									UNION 
									SELECT c.id FROM b_grupo_tmp gt
										JOIN capturistas c ON c.id=gt.integrante_id 
									WHERE gt.capturista_id=$capturista_id
									";  
							$respuesta= mysqli_query($this->con(), $query);  
							while ($res = mysqli_fetch_row($respuesta)) {  
									$integrante_id = $res[0]; 

									$query=" INSERT INTO  b_detalle_grupos (grupo_id,integrante_id) VALUES ($grupo_id,$integrante_id);";  
									 mysqli_query($this->con(), $query); 

							}

							$query="DELETE FROM b_grupo_tmp WHERE capturista_id=$capturista_id";  
							 mysqli_query($this->con(), $query); 


							 $query="SELECT 
										(SELECT correo FROM b_correos WHERE capturista_id = dg.integrante_id ) correopara,
										g.descripcion grupo,
										em.correo correode,
										dg.integrante_id
									FROM b_detalle_grupos dg
									JOIN b_grupos_trabajo g ON g.id=dg.grupo_id
									JOIN b_correos em ON em.capturista_id=g.capturista_id
									WHERE g.capturista_id=$capturista_id AND grupo_id=$grupo_id";  
									$respuesta= mysqli_query($this->con(), $query);  
									while ($res = mysqli_fetch_row($respuesta)) { 
									   $correopara = $res[0]; 
									   $grupo = $res[1]; 
									   $correode= $res[2];
									   $integrante_id= $res[3];
									   $confirmacion = "http://localhost/RedSocialBancaprepa/php/opciones/grupos.php?opcion=8&integrante_id=$integrante_id&grupo_id=$grupo_id"; 

									   $this-> enviarCorreo($correopara,$confirmacion,$grupo,$correode );
					 				}


							$datos[0]['respuesta']  =1;
				} 
				else{
					$datos[0]['respuesta']  =2;
				}
				  
				 
				return $datos;	 
			}

			public function gruposCreados(){
				$res=array();
				$datos=array();
				$i=0;
				$capturista_id=$_COOKIE["b_capturista_id"];

				$query=" SELECT g.id grupo_id,g.descripcion grupo,c.descripcion lider,g.integrantes integrantes,g.fecha_registro FROM b_grupos_trabajo g
						 JOIN capturistas c ON c.id=g.capturista_id
						 WHERE g.capturista_id=$capturista_id";  
				$respuesta= mysqli_query($this->con(), $query);  
				while ($res = mysqli_fetch_row($respuesta)) { 
				   $datos[$i]['grupo_id'] = $res[0];
				   $datos[$i]['grupo'] = $res[1]; 
				   $datos[$i]['lider'] = $res[2]; 
				   $datos[$i]['integrantes'] = $res[3]; 
				   $datos[$i]['fecha_registro'] = $res[4]; 
				   $i++;
 				}

				return $datos;	 
			}

			public function enviarCorreo($correopara,$confirmacion,$grupo,$correode ){

					   
					$correopara = strip_tags(htmlspecialchars($correopara));  
					$confirmacion = strip_tags(htmlspecialchars($confirmacion)); 
					$correode = strip_tags(htmlspecialchars($correode));
					$grupo = strip_tags(htmlspecialchars($grupo));  
					   
					// Create the email and send the message
					$to = $correopara; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
					$email_subject = "Invitacion a grupo de trabajo:  $grupo";
					$email_body = " Favor de confirmar en la siguiente liga : $confirmacion"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
					  
					$headers = "noreply@bancaprepa.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.   
					//$headers .= "Reply-To: $correode"; 
					mail($to,$email_subject,$email_body,$headers);
					return true;      
			}

			public function confirmarGrupo($integrante_id,$grupo_id){
					$query="UPDATE b_detalle_grupos SET estatus_id=5  WHERE integrante_id=$integrante_id AND grupo_id=$grupo_id";  
					 mysqli_query($this->con(), $query); 

					 return $query;
			}	

			public function detalleDeGrupo($grupo_id){
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT gt.descripcion, dg.integrante_id, c.descripcion, e.descripcion,b_correos.correo FROM  b_detalle_grupos dg
					JOIN capturistas c ON c.id=dg.integrante_id
					JOIN estatus e ON e.id=dg.estatus_id
					JOIN b_correos ON b_correos.capturista_id=c.id
					JOIN b_grupos_trabajo  gt ON gt.id=dg.grupo_id
					WHERE dg.grupo_id=$grupo_id";  
				$respuesta= mysqli_query($this->con(), $query);  
				while ($res = mysqli_fetch_row($respuesta)) { 
				   $datos[$i]['grupo'] = $res[0];
				   $datos[$i]['capturista_id'] = $res[1];
				   $datos[$i]['capturista'] = $res[2]; 
				   $datos[$i]['estatus'] = $res[3];
				   $datos[$i]['correo'] = $res[4];   
				   $i++;
 				}

				return $datos;	 
			}

			public function cargarGruposPorCapturista($capturista_id){
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT gru.id, gru.`descripcion`
				FROM b_detalle_grupos g 
				INNER JOIN capturistas c ON c.id=g.`integrante_id`
				INNER JOIN b_grupos_trabajo gru ON gru.`id`=g.`grupo_id`
				WHERE c.id=$capturista_id";  
				$respuesta= mysqli_query($this->con(), $query);  
				while ($res = mysqli_fetch_row($respuesta)) { 
				   $datos[$i]['id_grupo'] = $res[0];
				   $datos[$i]['grupo'] = $res[1]; 
				   $i++;
 				}

				return $datos;	 
			}

			

			public function cargarActividadesPorGrupo($grupo_id)
			{
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT act.id, act.descripcion, act.fecha_inicio, act.fecha_fin, c.`descripcion`, act.grupo_id, act.titulo, act.porcentaje
				FROM b_grupo_act act 
				INNER JOIN b_grupos_trabajo g ON g.id=act.grupo_id
				INNER JOIN capturistas c ON c.id=act.capturista_id
				WHERE act.grupo_id=$grupo_id";  

				$respuesta= mysqli_query($this->con(), $query);  

				while ($res = mysqli_fetch_row($respuesta)) { 
				$datos[$i]['act_id'] = $res[0];
				$datos[$i]['descripcion_act'] = $res[1];
				$datos[$i]['fecha_inicio'] = $res[2];
				$datos[$i]['fecha_fin'] = $res[3]; 
				$datos[$i]['capturistas'] = $res[4];
				$datos[$i]['grupo_id'] = $res[5];
				$datos[$i]['titulo'] = $res[6];
				$datos[$i]['porcentaje'] = $res[7];
				$i++;
				}

				return $datos;	 
			}

			

			public function cargarSubActividades($act_id)
			{
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT sub.id, sub.descripcion, act.id, c.`descripcion`, sub.fecha_inicio, sub.fecha_fin, sub.titulo, sub.porcentaje
				FROM b_grupo_subact sub
				INNER JOIN b_grupo_act act ON act.id=sub.actividad_id
				INNER JOIN capturistas c ON c.id=sub.capturista_id WHERE act.id=$act_id";  

				$respuesta= mysqli_query($this->con(), $query);  

				while ($res = mysqli_fetch_row($respuesta)) { 
				$datos[$i]['sub_id'] = $res[0];
				$datos[$i]['descripcion'] = $res[1];
				$datos[$i]['actividad_id'] = $res[2];
				$datos[$i]['capturista'] = $res[3];
				$datos[$i]['fecha_inicio'] = $res[4]; 
				$datos[$i]['fecha_fin'] = $res[5];
				$datos[$i]['titulo'] = $res[6];
				$datos[$i]['porcentaje'] = $res[7];
				$i++;
				}

				return $datos;	 
			}

			public function insertarActividades($grupo_id, $titulo, $descripcion, $fecha_ini, $fecha_fin, $capturista_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;	
				$sql="INSERT INTO b_grupo_act (grupo_id, titulo, descripcion, fecha_inicio, fecha_fin,capturista_id, estatus_id, fecha_creacion)
						VALUES ($grupo_id, '$titulo', '$descripcion', '$fecha_ini', '$fecha_fin', $capturista_id, 5, CURDATE())";
           
                
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_grupo_act'] =  array('0' => '0' );
				return  $datos;	
			}
			

			public function insertarSubactividades($actividad_id, $titulo, $descripcion, $capturista_id, $fecha_ini, $fecha_fin )
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;	
				$sql="INSERT INTO b_grupo_subact (actividad_id, titulo, descripcion, capturista_id, fecha_inicio, fecha_fin, estatus_id, fecha_creacion) 
						VALUES($actividad_id, '$titulo', '$descripcion', $capturista_id, '$fecha_ini', '$fecha_fin', 5, CURDATE())";
           
                
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_grupo_subact'] =  array('0' => '0' );
				return  $datos;	
			}

			public function insertarComentariosSubActividad($porcentaje, $comentario, $id_subActividad, $capturista_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;	
				$sql="INSERT INTO b_grupo_coment_sub (subactividad_id, porcentaje, comentario, fecha, hora, capturista_id)
						VALUES ($id_subActividad, $porcentaje, '$comentario', CURDATE(), CURTIME(), $capturista_id)";

				
                
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_grupo_coment_sub'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarPorcentaje($subact_id)
			{
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT id, porcentaje
				FROM b_grupo_subact
				WHERE id=$subact_id";  

				$respuesta= mysqli_query($this->con(), $query);  

				while ($res = mysqli_fetch_row($respuesta)) { 
				$datos[$i]['subact_id'] = $res[0];
				$datos[$i]['porcentaje'] = $res[1];
				
				$i++;
				}

				return $datos;	 
			}

			public function actualizarPorcentaje($porcentaje, $comentario, $id_subActividad)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;	
				$sql="UPDATE b_grupo_subact SET comentario='$comentario', porcentaje=$porcentaje WHERE id=$id_subActividad";

				
                
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_grupo_subact'] =  array('0' => '0' );
				return  $datos;	
			}

			public function sacarPorcentajesPorActividad($act_id)
			{
				$res=array();
				$datos=array();
				$i=0; 

				$query="SELECT sub.id, sub.`titulo`, sub.`porcentaje`
				FROM b_grupo_subact sub
				INNER JOIN b_grupo_act act ON act.`id`=sub.`actividad_id`
				WHERE act.id=$act_id";  

				$respuesta= mysqli_query($this->con(), $query);  

				while ($res = mysqli_fetch_row($respuesta)) { 
				$datos[$i]['sub_id'] = $res[0];
				$datos[$i]['titulo'] = $res[1];
				$datos[$i]['porcentaje'] = $res[2];
				$i++;
				}

				return $datos;	 
			}
			public function actualizarPorcentajeEnActividad($porcentaje, $id_Actividad)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;	
				$sql="UPDATE b_grupo_act SET porcentaje='$porcentaje' WHERE id=$id_Actividad";

				
                
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_grupo_act'] =  array('0' => '0' );
				return  $datos;	
			}
				



}

?>