<?php
	
	require_once("../conexion/conexion.php");

	class Usuario extends Conectar{


			public function login($user,$pass){

				    $res=array();
					$datos=array();
					$i=0; 

					$sql="SELECT  u.empleado, u.nombre, c.descripcion, ur.rol_id, eu.empresa_id, c.rol_id,s.nomComercial,r.descripcion,IF(c.telefono='' OR c.telefono=0,'SIN NUMERO',c.telefono) telefono, c.sucursal_id, e.`nombre`
										FROM usuarios u
										JOIN capturistas c ON c.id=u.empleado
									INNER JOIN b_usuario_empresa eu ON u.empleado=eu.usuario_id
									INNER JOIN b_usuario_rol ur ON ur.usuario_id=u.empleado
									INNER JOIN sucursales s ON s.id=c.sucursal_id
									INNER JOIN roles r ON r.id=c.rol_id
									INNER JOIN b_cat_empresas e ON e.`id`=eu.`empresa_id`
                            WHERE u.nombre='$user' AND u.clave=MD5('$pass') AND c.estatus_id=5"; 
					$resultado = mysqli_query($this->con(), $sql); 

				    while ($res = mysqli_fetch_row($resultado)) {

				       $datos[$i]['empleado_id'] = $res[0];
                       $datos[$i]['usuario'] = $res[1]; 
					   $datos[$i]['capturista'] = $res[2]; 
					   $datos[$i]['rol_id'] = $res[3];
					   $datos[$i]['empresa_id'] = $res[4];
					   $datos[$i]['puesto_id'] = $res[5]; 
					   $datos[$i]['sucursal'] = $res[6];
					   $datos[$i]['puesto'] = $res[7];
					   $datos[$i]['telefono'] = $res[8];  
					   $datos[$i]['id_sucursal'] = $res[9];  
					   $datos[$i]['empresa'] = $res[10];  
					   $i++;
 
					} 
					
					if ( count($datos )==0) { 
						$datos[0]['empleado_id']  =0;
						return  $datos; 
				  	}


			return $datos;  
 
			}
			//-----------------------------------------------Cargar Catalogos----------------------------------------------------
			public function catalogoEmpresas($empresa)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($empresa != "")
				{	
					$q = "Where emp.nombre like '%$empresa%'";
				}

				$sql="SELECT emp.id, emp.nombre, e.descripcion
					FROM b_cat_empresas emp
					INNER JOIN estatus e ON emp.estatus_id = e.id ".$q; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['empresa_id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['estatus'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['empresa_id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function catalogoRoles($rol)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($rol != "")
				{	
					$q = "Where rol.descripcion like '%$rol%'";
				}

				$sql="SELECT rol.id, rol.descripcion, e.descripcion
						FROM b_cat_roles rol
						INNER JOIN estatus e ON rol.estatus_id = e.id ".$q; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['rol_id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1]; 
				   $datos[$i]['estatus'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['rol_id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function catalogoDocumentos($doc)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($doc != "")
				{	
					$q = "Where doc.descripcion like '%$doc%'";
				}

				$sql="SELECT doc.id, doc.descripcion, e.descripcion
						FROM b_cat_doc doc
						INNER JOIN estatus e ON doc.estatus_id = e.id ".$q; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['doc_id'] = $res[0];
				   $datos[$i]['descripcion']  = $res[1]; 
				   $datos[$i]['estatus'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['doc_id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			public function catalogoCorreos($capid, $suc, $puesto)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 


				if($capid>0 AND $suc<=0 AND $puesto<=0)
				{	
					$q = "AND c.id=$capid";
				}
				if($capid>0 AND $suc>0 AND $puesto<=0)
				{
					$q = "AND c.id=$capid AND c.sucursal_id=$suc";
				}
				if($capid>0 AND $suc<=0 AND $puesto>0)
				{
					$q = "AND c.id=$capid AND c.rol_id=$puesto";
				}
				if($capid<=0 AND $suc<=0 AND $puesto>0)
				{
					$q = "AND c.rol_id=$puesto";
				}
				if($capid<=0 AND $suc>0 AND $puesto>0)
				{
					$q = "AND c.rol_id=$puesto AND c.sucursal_id=$suc";
				}
				if($capid<=0 AND $suc>0 AND $puesto<=0)
				{
					$q = "AND c.sucursal_id=$suc";
				}
				if($capid<=0 AND $suc<=0 AND $puesto<=0)
				{
					$q = " ";
				}
				if($capid>0 AND $suc>0 AND $puesto>0)
				{
					$q = "AND c.id=$capid AND c.sucursal_id=$suc AND  c.rol_id=$puesto";
				}

				
				$sql="SELECT c.id, cor.dominio, s.nomComercial, c.descripcion, cor.correo, cor.pass, cor.entregado, e.descripcion, r.`descripcion`, cor.id
					FROM capturistas c
					INNER JOIN b_correos cor ON cor.capturista_id=c.id
					INNER JOIN sucursales s ON s.id = c.sucursal_id 
					INNER JOIN roles r ON c.`rol_id`=r.`id`
					INNER JOIN estatus e ON e.id=c.estatus_id WHERE c.estatus_id=5  ".$q."  ORDER BY cor.id DESC"; 
				$resultado = mysqli_query($this->con(), $sql); 

				

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id_empleado'] = $res[0];
				   $datos[$i]['dominio'] = $res[1];
				   $datos[$i]['sucursal']  = $res[2]; 
				   $datos[$i]['nombrecompleto'] = $res[3];
				   $datos[$i]['correo']=$res[4];
				   $datos[$i]['pass']=$res[5];
				   $datos[$i]['entregado']=$res[6]; 
				   $datos[$i]['estatus']=$res[7]; 
					 $datos[$i]['puesto']=$res[8];
					 $datos[$i]['id_correo']=$res[9];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_empleado']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			//----------------------------------------Cargar por Id--------------------------------------
			//-------------------------------CARGAR EMPRESA-------------------------------------------------
			public function cargarEmpPorId($empresa)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 
				$sql="SELECT id, nombre
					FROM b_cat_empresas 
					WHERE id= $empresa"; 
				
				$resultado = mysqli_query($this->con(), $sql); 
				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['empresa_id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1];
				   $i++;

				} 
				if ( count($datos )==0) { 
					$datos[0]['empresa_id']  =0;
					return  $datos; 
				  }
				return $datos;  
			}
//--------------------------------------------CARGAR roles-------------------------------------------------
			public function cargarRolPorId($rol)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 
				$sql="SELECT id, descripcion
					FROM b_cat_roles 
					WHERE id= $rol"; 
				
				$resultado = mysqli_query($this->con(), $sql); 
				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['rol_id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $i++;

				} 
				if ( count($datos )==0) { 
					$datos[0]['rol_id']  =0;
					return  $datos; 
				  }
				return $datos;  
			}
//---------------------------------------CARGAR tipo de documentos-------------------------------------------------			
			public function cargarDocPorId($doc)
			{
                $q="";
				$res=array();
				$datos=array();
				$i=0; 
				$sql="SELECT id, descripcion
					FROM b_cat_doc
					WHERE id= $doc"; 
				
				$resultado = mysqli_query($this->con(), $sql); 
				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['doc_id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $i++;

				} 
				if ( count($datos )==0) { 
					$datos[0]['doc_id']  =0;
					return  $datos; 
				  }
				return $datos;  
			}

			//----------------------------------------------Insertar------------------------------------------

			public function guardarEmpresas($empresa)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="INSERT INTO b_cat_empresas(nombre,capturista_id,fecha_captura,hora_captura) 
									VALUES('$empresa',$txtUsuario,CURDATE(),CURTIME())";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_empresas'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function guardarRoles($rol)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="INSERT INTO b_cat_roles(descripcion,capturista_id,fecha_captura,hora_captura) 
									VALUES('$rol',$txtUsuario,CURDATE(),CURTIME())";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_roles'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function guardarDoc($doc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="INSERT INTO b_cat_doc(descripcion,capturista_id,fecha_captura,hora_captura) 
									VALUES('$doc',$txtUsuario,CURDATE(),CURTIME())";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_doc'] =  array('0' => '0' );
				return  $datos;	
				
			}

//-------------------------------------------------UPDATES---------------------------------------------------

			public function actualizarEmpresa($empId,$emp)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_cat_empresas SET nombre='$emp' WHERE id=$empId";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_empresas'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function actualizarRol($rolId,$rol)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_cat_roles SET descripcion='$rol' WHERE id=$rolId";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_roles'] =  array('0' => '0' );
				return  $datos;	
			}

			public function actualizarDoc($DocId,$Doc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_cat_doc SET descripcion='$Doc' WHERE id=$DocId";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_cat_doc'] =  array('0' => '0' );
				return  $datos;	
				
			}
//----------------------------------Deshabilitar-----------------------------------------
//----------------------------------Deshabilitar EMPRESA-----------------------------------------
			public function desEmp($empId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="UPDATE b_cat_empresas SET estatus_id=6 WHERE id=$empId";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_empresas'] =  array('0' => '0' );
				return  $datos;	
				
			}
//----------------------------------Deshabilitar roles-----------------------------------------
			public function desRol($rolId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="UPDATE b_cat_roles SET estatus_id=6 WHERE id=$rolId";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_roles'] =  array('0' => '0' );
				return  $datos;	
				
			}
//----------------------------------Deshabilitar tipo de documentos-----------------------------------------
			public function desDoc($docId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="UPDATE b_cat_doc SET estatus_id=6 WHERE id=$docId";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_doc'] =  array('0' => '0' );
				return  $datos;	
				
			}

//-------------------------------------------Eliminar--------------------------------------------------------------
//------------------------------Eliminar Empresas------------------------
			public function eliminarEmp($empId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="DELETE FROM b_cat_empresas WHERE id=$empId";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_empresas'] =  array('0' => '0' );
				return  $datos;	
				
			}
//------------------------------Eliminar roles------------------------
			public function eliminarRol($rolId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="DELETE FROM b_cat_roles WHERE id=$rolId";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_roles'] =  array('0' => '0' );
				return  $datos;	
				
			}
//------------------------------Eliminar tipo de documentos------------------------
			public function eliminarDoc($docId)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="DELETE FROM b_cat_doc WHERE id=$docId";
			
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_cat_doc'] =  array('0' => '0' );
				return  $datos;	
				
			}
//------------------------------------------------------PUBLICACIONES-------------------------------------------
//-----------------------------Cargar publicaciones	-----------------------------
			public function cargarPublicaciones()
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				//if($empresa != "")
				//{	
				//	$q = "Where emp.nombre like '%$empresa%'";
				//}

				$sql="SELECT c.descripcion AS publicador, p.descripcion 
				      FROM b_publicaciones p 
					  INNER JOIN capturistas c 
					  ON p.capturista_id=c.id
					  ORDER BY fecha_publicacion DESC,hora_publicacion DESC"; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['publicador'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['publicador']  =0;
					return  $datos; 
				  }


				return $datos;  
				
			}
	//-------------------------------Agregar publicaciones-------------------------
			public function agregarPublicaciones($texto,$tipopub)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="INSERT INTO b_publicaciones(capturista_id,descripcion,fecha_publicacion,hora_publicacion, tipo_doc, empresa_id) 
									VALUES($txtUsuario,'$texto',CURDATE(),CURTIME(),$tipopub,1)";
			    
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_publicaciones'] =  array('0' => '0' );
				return  $datos;	
			}
//----------------------------------CARGAR MENU para accesos--------------------------------------
			public function cargarAccesos($id_rol)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="SELECT mr.id_rol, mr.id_menu
						FROM b_menu_roles mr
						INNER JOIN b_menu m
						ON mr.id_menu=m.id
						WHERE mr.id_rol=$id_rol ORDER BY mr.id_menu ASC";
			
				$resultado = mysqli_query($this->con(), $sql);   
				
				while ($res = mysqli_fetch_row($resultado)) {

					$datos[$i]['id_rol'] = $res[0]; 	
					$datos[$i]['id_menu'] = $res[1];
					$i++;
 
				 }     
				  
				 if ( count($datos )==0) { 
					 $datos[0]['id_rol']  =0;
					 return  $datos; 
				   }
 
 
				 return $datos;
			}
//----------------------------------habilitar y deshabilitar accesos--------------------------------------
			public function habilitarAcceso($rol_id,$menu_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				$txtUsuario=$_COOKIE["b_menu_roles"];  

				$sql="INSERT INTO b_menu_roles (id_rol, id_menu) VALUES ($rol_id,$menu_id);";
				
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_menu_roles'] =  array('0' => '0' );
				return  $datos;	
			}
			
			public function deshabilitarAcceso($rol_id,$menu_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				$txtUsuario=$_COOKIE["b_menu_roles"];  

				$sql="DELETE FROM b_menu_roles WHERE id_rol=$rol_id AND id_menu=$menu_id";
				
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_menu_roles'] =  array('0' => '0' );
				return  $datos;	
			}

			//--------------------------GUARDAMOS LA INFORMACION BASICA DE UNA PUBLICACION -----------------------------------//////


			public function guardarPublicacion($titulo,$descripcion,$imagen,$documento_id,$docuemento,$chbPDF)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0; 
				$capturista_id=$_COOKIE["b_capturista_id"]; 
				
				

				$sql="INSERT INTO b_publicaciones_bancaprepa(titulo,descripcion,imagen,documento_id,documento,capturista_id,fecha,hora,formato)
														VALUES('$titulo','$descripcion','$imagen',$documento_id,'$docuemento',$capturista_id,CURDATE(),CURTIME(),'$chbPDF')";
				
				
				//return $sql;
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos[0]['publicacion'] ='1' ;
				return  $datos;	
			}

			//-------------------------------------------cargamos los tipos de documentos--------------------------------------------------------------
			//-----------------------------------------------------
			public function catDocumentos()
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0; 

				$sql="SELECT id,descripcion FROM b_cat_doc WHERE estatus_id=5"; 
				$resultado = mysqli_query($this->con(), $sql);    
				while ($res = mysqli_fetch_row($resultado)) {

					$datos[$i]['id'] = $res[0]; 	
					$datos[$i]['docuemento'] = $res[1];
					$i++;
 
				 }     
				  
 
				 return $datos;
				
			}

			public function catPublicaciones($capturista_id,$menu)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0; 
				$ql='';
				$qlempresas='';

				
				
				$sql="SELECT rol_id FROM b_capturista_roles WHERE capturista_id=$capturista_id ORDER BY rol_id ASC limit 1";  
				$resultado = mysqli_query($this->con(), $sql);    
				while ($res = mysqli_fetch_row($resultado)) {
					// cargamos los roles que tiene el usuario
						$rol_id = $res[0]; 	
						
						if($rol_id==1){
							// cargamos las publicaciones que el rol puede visualizar
							$sqlm="SELECT titulo,descripcion,imagen,b_cat_empresas.nombre ,bp.fecha,bp.hora ,bp.fecha_modificacion,bp.hora_modificacion,documento 
									FROM b_publicaciones_bancaprepa AS bp
									JOIN b_cat_empresas ON b_cat_empresas.id=bp.empresa_id
									WHERE documento_id=$menu"; 
							$resultadom = mysqli_query($this->con(), $sqlm);    
							while ($resm = mysqli_fetch_row($resultadom)) {
			
								$datos[$i]['titulo'] = $resm[0]; 	 
								$datos[$i]['descripcion'] = $resm[1]; 	
								$datos[$i]['imagen'] = $resm[2]; 	
								$datos[$i]['empresa'] = $resm[3]; 	
								$datos[$i]['fecha'] = $resm[4]; 	
								$datos[$i]['hora'] = $resm[5]; 	
								$datos[$i]['fecha_modificacion'] = $resm[6]; 	
								$datos[$i]['hora_modificacion'] = $resm[7]; 
								$datos[$i]['documento'] = $resm[8]; 
								
								$i++;
			
							}  
							
							return $datos;
						}
						else{
									$sqlempresas="SELECT empresa_id FROM b_capturista_empresa WHERE capturista_id=$capturista_id";  
									$resultado = mysqli_query($this->con(), $sqlempresas);    
									while ($res = mysqli_fetch_row($resultado)) {
										// cargamos las empresas que tiene el usuario
										$qlempresas .= $res[0].','; 	
											
									}
					
									
										//CONCATENAMOS TODAS LAS EMPRESAS QUE EL USUARIO TIENE Y PONEMOS LA GENERAL MISMA QUE SE MOSTRARA A TODOS LOS USUARIOS
									$qlempresas =   $qlempresas.'5';
								// cargamos las publicaciones que el rol puede visualizar
									$sqlm="SELECT titulo,descripcion,imagen,b_cat_empresas.nombre ,bp.fecha,bp.hora ,bp.fecha_modificacion,bp.hora_modificacion ,documento
									FROM b_publicaciones_bancaprepa AS bp
									JOIN b_cat_empresas ON b_cat_empresas.id=bp.empresa_id
									WHERE documento_id=$menu AND rol_id >=$rol_id AND empresa_id IN($qlempresas)"; 

											
									$resultadom = mysqli_query($this->con(), $sqlm);    
									while ($resm = mysqli_fetch_row($resultadom)) {

										$datos[$i]['titulo'] = $resm[0]; 	 
										$datos[$i]['descripcion'] = $resm[1]; 	
										$datos[$i]['imagen'] = $resm[2]; 	
										$datos[$i]['empresa'] = $resm[3]; 	
										$datos[$i]['fecha'] = $resm[4]; 	
										$datos[$i]['hora'] = $resm[5]; 	
										$datos[$i]['fecha_modificacion'] = $resm[6]; 	
										$datos[$i]['hora_modificacion'] = $resm[7]; 
										$datos[$i]['documento'] = $resm[8]; 
										
										$i++;

									}  
							return $datos;
						}
				}
 
			
				}
				
			public function cargarUsuarios($usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($usuario != "")
				{	
					$q = "Where empleado = '$usuario'";
				}

				$sql="SELECT empleado,nombre,entregado FROM usuarios ".$q." Order by nombre asc";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['entregado'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  
			}
			public function insertarUsuario_rol($empleado_id,$rol)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_usuario_rol (usuario_id, rol_id) VALUES ($empleado_id,$rol);";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['usuario_id'] =  array('0' => '0' );
				return  $datos;	
			}

			public function insertarUsuario_Empresa($empleado_id,$empresa)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_usuario_empresa (usuario_id, empresa_id) VALUES ($empleado_id,$empresa);";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['usuario_id'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarRolesUsuarios($idusuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

			

				$sql="SELECT ur.usuario_id, ur.rol_id FROM usuarios u INNER JOIN b_usuario_rol ur 
						ON ur.usuario_id=u.empleado WHERE u.empleado=$idusuario"; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['usuarioid'] = $res[0];
				   $datos[$i]['rolid'] = $res[1]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['usuarioid']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function verificarUsuario_rol($usuario, $rol)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 


				$sql="SELECT COUNT(usuario_id) FROM b_usuario_rol WHERE usuario_id=$usuario AND rol_id=$rol"; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['contador'] = $res[0];
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  
			}
			public function verificarUsuario_empresa($usuario, $empresa)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 


				$sql="SELECT COUNT(usuario_id) FROM b_usuario_empresa WHERE usuario_id=$usuario AND empresa_id=$empresa"; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['contador'] = $res[0];
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function cargarListadodeUsuarios($usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($usuario != "")
				{	
					$q = "AND c.id='$usuario'";
				}

				$sql="SELECT c.id, c.`descripcion` AS Nombre, u.`nombre` AS Usuario, 
					IFNULL(u.pwdtmp,'Sin contraseña disponible') AS pass, u.entregado, e.descripcion AS estatus, s.`nomComercial`
					FROM usuarios u
					INNER JOIN capturistas c ON c.id=u.`empleado`
					INNER JOIN estatus e ON c.estatus_id=e.id
					INNER JOIN sucursales s ON s.`id`=c.`sucursal_id` WHERE c.`estatus_id`=5 ".$q." ORDER BY c.id DESC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['usuario'] = $res[2]; 
				   $datos[$i]['pass'] = $res[3]; 
				   $datos[$i]['entregado'] = $res[4]; 
				   $datos[$i]['estatus'] = $res[5]; 
				   $datos[$i]['sucursal'] = $res[6]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function cargarRolesDeUsuarios($usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT c.id, u.nombre AS usuario,cr.`descripcion` AS Roles, cr.`id`AS id_rol
						FROM usuarios u 
						INNER JOIN capturistas c ON c.id=u.empleado
						INNER JOIN b_usuario_rol ur ON ur.usuario_id=u.empleado
						INNER JOIN b_cat_roles cr ON cr.id=ur.rol_id
						WHERE c.id='$usuario'";
				 
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['usuario'] = $res[1]; 
				   $datos[$i]['roles'] = $res[2];
				   $datos[$i]['id_rol'] = $res[3];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function cargarEmpresasDeUsuarios($usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT c.id, u.nombre AS usuario, ce.`nombre`,ce.id AS id_emp
						FROM usuarios u 
						INNER JOIN capturistas c ON c.id=u.empleado
						INNER JOIN b_usuario_empresa ue ON ue.usuario_id=u.empleado
						INNER JOIN b_cat_empresas ce ON ce.id = ue.`empresa_id`
						WHERE c.id='$usuario'";
				 
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['usuario'] = $res[1]; 
				   $datos[$i]['empresas'] = $res[2];
				   $datos[$i]['id_emp'] = $res[3]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  
				}

				

				public function borrarRoldeUsuario($usuario,$rol)
				{
					$res=array();
					$datos=array();
					$resultado  =array();
					$i=0;

					
					$sql="DELETE FROM b_usuario_rol WHERE usuario_id='$usuario' AND rol_id='$rol'";
					
					$resultado = mysqli_query($this->con(), $sql);   
					
					$datos['b_usuario_rol'] =  array('0' => '0' );
					return  $datos;	
				}

				public function borrarEmpdeUsuario($usuario,$emp)
				{
					$res=array();
					$datos=array();
					$resultado  =array();
					$i=0;
				
					$sql="DELETE FROM b_usuario_empresa WHERE usuario_id=$usuario AND empresa_id=$emp";
					
					$resultado = mysqli_query($this->con(), $sql);   
					
					$datos['b_usuario_empresa'] =  array('0' => '0' );
					return  $datos;	
				}
				
			public function cargarUsuariosXnombre($usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				if($usuario != "")
				{	
					$q = "WHERE c.descripcion LIKE '%$usuario%'";
				}

				$sql="SELECT c.id, c.`descripcion` AS Nombre, u.`nombre` AS Usuario, e.descripcion AS estatus
					FROM usuarios u
					INNER JOIN capturistas c ON c.id=u.`empleado`
					INNER JOIN estatus e ON c.estatus_id=e.id  ".$q." ORDER BY c.id DESC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['usuario'] = $res[2]; 
				   $datos[$i]['estatus'] = $res[3]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function insertarEmpresa_rol($empresa,$puesto)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_empresa_puesto (empresa_id, puesto_id) VALUES ($empresa,$puesto)";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function VerifInsertarEmpresa_rol($empresa,$puesto)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT COUNT(empresa_id) FROM b_empresa_puesto WHERE empresa_id=$empresa AND puesto_id=$puesto";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['contador'] = $res[0];				   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function CargarRolXEmp($empresa)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT r.id,r.`descripcion` FROM roles r INNER JOIN b_empresa_puesto ep ON ep.puesto_id=r.`id`
						WHERE ep.empresa_id=$empresa order by r.descripcion asc";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_rol'] = $res[0];	
				   $datos[$i]['nombre'] = $res[1];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_rol']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function borrarRoldeEmp($emp,$rol)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
			
				$sql="DELETE FROM b_empresa_puesto WHERE empresa_id=$emp AND puesto_id=$rol";
				
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_emp_rol'] =  array('0' => '0' );
				return  $datos;	
			}

			public function CargarPuestos()
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT id, descripcion FROM roles";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];	
				   $datos[$i]['nombre'] = $res[1];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }
  

				return $datos;  
			}
			public function insertarTablaTmp( $empid,$puestoid,$usuario,$sucursal)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_tmp_pub (id_emp, id_puesto, id_usuario, id_sucursal) VALUES ($empid,$puestoid,$usuario, $sucursal)";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function CargarTablaTemp($usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT bt.id_emp, emp. nombre, bt.id_puesto, r.descripcion, bt.`id_sucursal`,IF(bt.id_sucursal>0,s.nomComercial, 'Todas')
				FROM b_tmp_pub bt
				INNER JOIN roles r ON r.id=bt.id_puesto
				INNER JOIN b_cat_empresas emp ON emp.id=bt.id_emp
				LEFT JOIN sucursales s ON bt.`id_sucursal`=s.id
				WHERE bt.id_usuario=$usuario";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_empresa'] = $res[0];	
				   $datos[$i]['empresa'] = $res[1];
				   $datos[$i]['id_puesto'] = $res[2];	
				   $datos[$i]['puesto'] = $res[3];
				   $datos[$i]['id_sucursal'] = $res[4];	
				   $datos[$i]['sucursal'] = $res[5];							   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_empresa']  =0;
					return  $datos; 
				  }


				return $datos;  
			}
			
			public function EliminarDatoDeTmp($emp,$puesto,$sucursal)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
			
				$sql="DELETE FROM b_tmp_pub WHERE id_emp=$emp AND id_puesto=$puesto AND id_sucursal=$sucursal";
				
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_tmp_pub'] =  array('0' => '0' );
				return  $datos;	
			}
			public function verificarTablaTmp($usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT COUNT(id)
				FROM b_tmp_pub t
				WHERE id_usuario=$usuario";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['contador'] = $res[0];				   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function EliminarTodoDeTmp()
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
			
				$sql="DELETE FROM b_tmp_pub";
				
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['b_tmp_pub'] =  array('0' => '0' );
				return  $datos;	
			}

			public function idParaTablaTmp($usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT MAX(id) AS id FROM b_publicaciones_bancaprepa";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];				   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  
			}
			public function insertarTablaDetalle( $pub,$emp,$puesto, $sucursal)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_detalle_publicacion (publicacion_id, empresa_id, puesto_id, sucursal_id) VALUES ($pub,$emp,$puesto, $sucursal)";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarRolesParaConfirmaciones($publicacion)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="SELECT publicacion_id, puesto_id, empresa_id, sucursal_id FROM b_detalle_publicacion WHERE publicacion_id=$publicacion";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['publicacion_id'] = $res[0];	
				   $datos[$i]['puesto_id'] = $res[1];
				   $datos[$i]['empresa_id'] = $res[2];	
				   $datos[$i]['sucursal_id'] = $res[3];				   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['publicacion_id']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function cargarEmpleadosXempresa($empresa, $publicacion_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				
				$sql="INSERT INTO b_confirmaciones (publicacion_id, empleado_id, puesto_id, empresa_id) 
					SELECT $publicacion_id, c.id,c.rol_id, ue.empresa_id 
					FROM capturistas c
					INNER JOIN b_usuario_empresa ue ON ue.usuario_id=c.id
					WHERE ue.empresa_id=$empresa";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}
			public function cargarEmpleadosXpuesto($puesto, $empresa, $publicacion_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				
				$sql="INSERT INTO b_confirmaciones (publicacion_id, empleado_id, puesto_id, empresa_id) 
					SELECT $publicacion_id, c.id,c.rol_id, ue.empresa_id 
					FROM capturistas c
					INNER JOIN b_usuario_empresa ue ON ue.usuario_id=c.id
					WHERE c.rol_id=$puesto AND ue.empresa_id=$empresa";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function insertarTablaConfirmaciones($pub,$empleado,$puesto,$empresa)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				
				$sql="INSERT INTO b_confirmaciones (publicacion_id, empleado_id, puesto_id, empresa_id) VALUES ($pub,$empleado,$puesto,$empresa)";
				
				$resultado = mysqli_query($this->con(), $sql);   
				$datos['id'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargaPublicacionesBancaprepa($usuario, $tipodoc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$var="S";
				
				if($tipodoc==1)
				{
					$sql="SELECT p.id, p.titulo, p.descripcion,p.imagen,p.formato, conf.empresa_id,conf.puesto_id, conf.visto, p.documento_id, 
					DATE_FORMAT( p.fecha, '%d/%b/%Y') AS fecha, DATE_FORMAT( p.hora, '%l:%i%p') AS hora
					FROM b_publicaciones_bancaprepa p
					INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
					INNER JOIN capturistas c ON c.id=conf.empleado_id
					WHERE c.id=$usuario AND conf.visto='$var' AND p.documento_id=$tipodoc AND p.estatus=5
					ORDER BY p.id DESC";

					$resultado = mysqli_query($this->con(), $sql); 	

					while ($res = mysqli_fetch_row($resultado)) 
					{
						$datos[$i]['id_publicacion'] = $res[0];	
						$datos[$i]['titulo'] = $res[1];
						$datos[$i]['descripcion'] = $res[2];
						$datos[$i]['ruta'] = $res[3];
						$datos[$i]['formato'] = $res[4];	
						$datos[$i]['empresa_id'] = $res[5];
						$datos[$i]['puesto_id'] = $res[6];	
						$datos[$i]['visto'] = $res[7];
						$datos[$i]['tipodoc'] = $res[8];
						$datos[$i]['fecha'] = $res[9];
						$datos[$i]['hora'] = $res[10];						   
						$i++;
					} 
				
					if ( count($datos )==0) { 
						$datos[0]['id_publicacion']  =0;
						return  $datos; 
					}


					return $datos; 

				}
				
				else
				{
					$sql="SELECT p.id, p.titulo, p.descripcion,p.imagen,p.formato, p.documento_id, 
					DATE_FORMAT( p.fecha, '%d/%b/%Y') AS fecha, DATE_FORMAT( p.hora, '%l:%i%p') AS hora
					FROM b_publicaciones_bancaprepa p
					WHERE p.documento_id=$tipodoc AND p.estatus=5
					ORDER BY p.id DESC";

					$resultado = mysqli_query($this->con(), $sql); 	

					while ($res = mysqli_fetch_row($resultado)) 
					{
						$datos[$i]['id_publicacion'] = $res[0];	
						$datos[$i]['titulo'] = $res[1];
						$datos[$i]['descripcion'] = $res[2];
						$datos[$i]['ruta'] = $res[3];
						$datos[$i]['formato'] = $res[4];	
						$datos[$i]['tipodoc'] = $res[5];
						$datos[$i]['fecha'] = $res[6];
						$datos[$i]['hora'] = $res[7];						   
						$i++;
					} 

					if ( count($datos )==0) { 
						$datos[0]['id_publicacion']  =0;
						return  $datos; 
					}


					return $datos; 
				}


				
			}

			public function ActualizarVisto($pub,$empleado)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$visto="S";
				$sql="UPDATE b_confirmaciones SET visto='$visto', fecha_visto=CURDATE(), hora_visto=CURTIME() WHERE publicacion_id=$pub AND empleado_id=$empleado";
				
				$resultado = mysqli_query($this->con(), $sql);   
				$datos['publicacion_id'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargaPubNuevas( $usuario, $tipodoc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$var="N";
				
				$sql="SELECT p.id, p.titulo, p.descripcion,p.imagen,p.formato, conf.empresa_id,conf.puesto_id, conf.visto, p.documento_id, 
				DATE_FORMAT( p.fecha, '%d/%b/%Y') AS fecha, DATE_FORMAT( p.hora, '%l:%i%p') AS hora 
				FROM b_publicaciones_bancaprepa p
				INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
				INNER JOIN capturistas c ON c.id=conf.empleado_id
				WHERE  c.id=$usuario AND conf.visto='$var' AND p.documento_id=$tipodoc AND p.estatus=5
				ORDER BY p.id DESC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_publicacion'] = $res[0];	
				   $datos[$i]['titulo'] = $res[1];
				   $datos[$i]['descripcion'] = $res[2];
				   $datos[$i]['ruta'] = $res[3];
				   $datos[$i]['formato'] = $res[4];	
				   $datos[$i]['empresa_id'] = $res[5];
				   $datos[$i]['puesto_id'] = $res[6];	
				   $datos[$i]['visto'] = $res[7];	
				   $datos[$i]['tipodoc'] = $res[8];
				   $datos[$i]['fecha'] = $res[9];
				   $datos[$i]['hora'] = $res[10];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_publicacion']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function verificaPubNuevas($usuario, $tipodoc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$var="N";
				
				$sql="SELECT COUNT(p.id)
				FROM b_publicaciones_bancaprepa p
				INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
				INNER JOIN capturistas c ON c.id=conf.empleado_id
				WHERE c.id=$usuario AND conf.visto='$var' AND p.documento_id=$tipodoc and p.estatus=5";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['conteo'] = $res[0];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['conteo']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function verificaPubVistas($usuario, $tipodoc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$var="S";
				
				if($tipodoc==1)
				{
					$sql="SELECT COUNT(p.id)
					FROM b_publicaciones_bancaprepa p
					INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
					INNER JOIN capturistas c ON c.id=conf.empleado_id
					WHERE c.id=$usuario AND conf.visto='$var' AND p.documento_id=$tipodoc";
				}
				else
				{
					$sql="SELECT COUNT(p.id)
					FROM b_publicaciones_bancaprepa p
					INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
					INNER JOIN capturistas c ON c.id=conf.empleado_id
					WHERE p.documento_id=$tipodoc";
				}
				
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['conteo'] = $res[0];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['conteo']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			public function verificaPubNuevasPorUsuario($usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				$var="N";
				
				$sql="SELECT COUNT(p.id)
				FROM b_publicaciones_bancaprepa p
				INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
				INNER JOIN capturistas c ON c.id=conf.empleado_id
				WHERE c.id=$usuario AND conf.visto='$var' AND p.`documento_id`=1 AND p.estatus=5";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['conteo'] = $res[0];					   
				   $i++;
				} 
				
				if ( count($datos )==0) { 
					$datos[0]['conteo']  =0;
					return  $datos; 
				  }


				return $datos;  
			}

			

			public function cargarSitieneCorreoOno($id_empleado)
			{
                
				$res=array();
				$datos=array();
				$i=0; 

				

				$sql="SELECT c.id, c.descripcion, IFNULL(cor.correo,'vacio'), cor.pass
					FROM capturistas c
					LEFT OUTER JOIN b_correos cor ON cor.capturista_id=c.id
					WHERE c.id=$id_empleado "; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id_empleado'] = $res[0];
				   $datos[$i]['nombrecompleto'] = $res[1];
				   $datos[$i]['correo']  = $res[2]; 
				   $datos[$i]['pass'] = $res[3];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_empleado']  =0;
					return  $datos; 
				  }


				return $datos;  

			}


			public function insertarCorreos($usuarioid,$dominio,$correo,$pass)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
			
				$sql="INSERT INTO b_correos(capturista_id,dominio,correo,pass) 
									VALUES($usuarioid,'$dominio','$correo','$pass')";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_correos'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function catalogoCorreosxID($id_correo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT c.id, cor.dominio, s.nomComercial, c.descripcion, cor.correo, cor.pass, cor.entregado, cor.estatus, cor.id
						FROM capturistas c
						INNER JOIN b_correos cor ON cor.capturista_id=c.id
						INNER JOIN sucursales s ON s.id = c.sucursal_id 
						WHERE c.id=$id_correo"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id_empleado'] = $res[0];
				   $datos[$i]['dominio'] = $res[1];
				   $datos[$i]['sucursal']  = $res[2]; 
				   $datos[$i]['nombrecompleto'] = $res[3];
				   $datos[$i]['correo']=$res[4];
				   $datos[$i]['pass']=$res[5];
				   $datos[$i]['entregado']=$res[6]; 
					 $datos[$i]['estatus']=$res[7];
					 $datos[$i]['id_correo']=$res[8]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_empleado']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			
			public function actualizarCorreos($usuarioid,$correo,$pass,$entregado, $estatus)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_correos SET correo='$correo', pass='$pass', entregado='$entregado', estatus='$estatus'
						WHERE capturista_id=$usuarioid";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_correos'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function eliminarCorreos($id_correo)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				

				$sql="DELETE FROM b_correos WHERE id=$id_correo";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['b_correos'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function cargarInventarios()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT equipo.id,equipo.`descripcion`
				FROM i_tipo_equipo equipo"; 

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

			public function insertarEquipos($descripcion)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
			
				$sql="INSERT INTO i_tipo_equipo(descripcion) 
									VALUES('$descripcion')";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['i_tipo_equipo'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function insertarTickets($usuario_id, $area_id, $titulo, $descripcion, $correo, $telefono)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
			
				$sql="INSERT INTO b_tickets (capturista_id, area_id, titulo, descripcion, email, telefono, fecha_creacion, hora_creacion, estatus )
					VALUES ($usuario_id,$area_id,'$titulo', '$descripcion','$correo','$telefono', CURDATE(), CURTIME(),'en espera')";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_tickets'] =  array('0' => '0' );
				return  $datos;	
				
			}
			
			public function capturainv()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id,nomComercial
				FROM sucursales suc
				WHERE id NOT IN 
				(
					SELECT id
					FROM sucursales suc
					WHERE b_estatus='N'
				)
				ORDER BY nomComercial ASC"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nomComercial'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			
			public function cargartipoequipos()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id,descripcion
				FROM i_tipo_equipo ORDER BY descripcion ASC"; 

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

			public function insertarcatequipos($sucursal_id,$tipo_equipo,$num_equipo,$descripcion,
			$marca,$modelo,$serie,$fecha_compra,$valor_factura, $cap ,$area_id)
			{
				$res=array();
				$datos=array();
				$resultado=array();
				$i=0;
	
			
				$sql="INSERT INTO i_equipo(sucursal_id,tipo_equipo_id,num_equipo,descripcion,
									marca,modelo,serie,fecha_compra,valor_factura, capturista_id,area_id) 
								VALUES($sucursal_id,$tipo_equipo,$num_equipo,'$descripcion',
										'$marca','$modelo','$serie','$fecha_compra','$valor_factura', $cap ,$area_id)";
			
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['i_equipo'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function cargarTickets()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT t.id, t.`titulo`, t.`descripcion`, c.`descripcion`, t.`estatus`
						FROM b_tickets t
						INNER JOIN capturistas c ON c.`id`=t.`capturista_id`"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['titulo'] = $res[1];
				   $datos[$i]['descripcion'] = $res[2];
				   $datos[$i]['solicitado'] = $res[3];
				   $datos[$i]['estatus'] = $res[4];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			
			public function noserierepetida($serie)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT COUNT(id), serie
					FROM i_equipo 
					WHERE serie = '$serie'"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['contador'] = $res[0];
				   $datos[$i]['serie'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function noequiporepetido($tipo_equipo,$num_equipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT COUNT(e.id), t.`descripcion`, e.`num_equipo`
					FROM i_equipo e
					INNER JOIN i_tipo_equipo t ON t.`id`=e.`tipo_equipo_id`
					WHERE tipo_equipo_id = $tipo_equipo AND num_equipo = $num_equipo
				"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['contador'] = $res[0];
				   $datos[$i]['tipo'] = $res[1];
				   $datos[$i]['numero'] = $res[2];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function verifTablaTemporal($usuario)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT COUNT(id)
					FROM b_tmp_pub WHERE id_usuario=$usuario"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['contador'] = $res[0];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			
			public function cargarEquipos($id, $suc, $numEquipo, $area)
			{
  
				$res=array();
				$datos=array();
				$i=0; 
				$q=""; 

				if($suc>0 AND $id>0 AND $numEquipo>0 AND $area>0)
				{
					$q = "WHERE e.num_equipo='$numEquipo' AND e.sucursal_id='$suc' AND e.id=$id AND e.area_id=$area";
				}
				
				if($suc>0 AND $id<=0 AND $numEquipo<=0 AND $area<=0)
				{	
					$q = "WHERE e.sucursal_id='$suc'";
				}

				if($suc<=0 AND $id>0 AND $numEquipo<=0 AND $area<=0)
				{	
					$q = "WHERE e.id='$id'";
				}

				if($suc<=0 AND $id<=0 AND $numEquipo>0 AND $area<=0)
				{	
					$q= "WHERE e.num_equipo='$numEquipo'";
				}

				if($suc<=0 AND $id<=0 AND $numEquipo<=0 AND $area>0)
				{	
					$q= "WHERE e.area_id='$area'";
				}

				if($suc>0 AND $id>0 AND $numEquipo<=0 AND $area<=0)
				{	
					$q= "WHERE e.sucursal_id='$suc' AND e.id='$id'";
				}

				if($suc>0 AND $id<=0 AND $numEquipo>0 AND $area<=0)
				{	
					$q= "WHERE e.sucursal_id='$suc' AND e.num_equipo='$numEquipo'";
				}

				if($suc>0 AND $id<=0 AND $numEquipo<=0 AND $area>0)
				{	
					$q= "WHERE e.sucursal_id='$suc' AND e.area_id='$area'";
				}

				if($suc<=0 AND $id>0 AND $numEquipo>0 AND $area<=0)
				{	
					$q= "WHERE e.id='$id' AND e.num_equipo='$numEquipo'";
				}

				if($suc<=0 AND $id>0 AND $numEquipo<=0 AND $area>0)
				{	
					$q= "WHERE e.id='$id' AND e.area_id='$area'";
				}

				if($suc<=0 AND $id<=0 AND $numEquipo>0 AND $area>0)
				{	
					$q= "WHERE e.num_equipo='$numEquipo' AND e.area_id='$area'";
				}

				if($suc>0 AND $id>0 AND $numEquipo>0 AND $area<=0)
				{	
					$q= "WHERE e.sucursal_id='$suc' AND e.id='$id' AND e.num_equipo='$numEquipo'";
				}

				if($suc>0 AND $id<=0 AND $numEquipo>0 AND $area>0)
				{	
					$q= "WHERE e.sucursal_id='$suc' AND e.area_id='$area' AND e.num_equipo='$numEquipo'";
				}

				if($suc<=0 AND $id>0 AND $numEquipo>0 AND $area>0)
				{	
					$q= "WHERE e.id='$id' AND e.area_id='$area' AND e.num_equipo='$numEquipo'";
				}

				if($suc>0 AND $id>0 AND $numEquipo<=0 AND $area>0)
				{	
					$q= "WHERE e.id='$id' AND e.area_id='$area' AND e.sucursal_id='$suc'";
				}

				if($suc<=0 AND $id<=0 AND $numEquipo<=0 AND $area<=0)
				{	
					$q= "";
				}
				
				$sql="SELECT e.id, e.sucursal_id,s.nomComercial, e.descripcion equipo,te.descripcion tipo,
					estatus.descripcion estatus, e.`num_equipo`,IFNULL(c.`descripcion`,'Sin responsable asignado') AS responsable, a.descripcion,
					e.marca, e.`modelo`,e.`serie`, e.valor_factura
					FROM i_equipo e 
					JOIN i_tipo_equipo te ON te.id=e.tipo_equipo_id
					JOIN estatus ON estatus.id=e.estatus_id
					INNER JOIN sucursales s ON e.sucursal_id=s.id
					INNER JOIN b_cat_areas a ON a.id=e.`area_id` 
					LEFT OUTER JOIN capturistas c ON c.id=e.`encargado_id` ".$q." ORDER BY e.num_equipo DESC, id DESC ";  
 
				$resultado = mysqli_query($this->con(), $sql);  
				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['id_suc'] = $res[1];
				   $datos[$i]['nomComercial'] = $res[2];
				   $datos[$i]['equipo'] = $res[3];
				   $datos[$i]['tipo'] = $res[4];
				   $datos[$i]['estatus'] = $res[5];
				   $datos[$i]['numEquipo'] = $res[6];
				   $datos[$i]['responsable'] = $res[7];
				   $datos[$i]['area'] = $res[8];
				   $datos[$i]['marca'] = $res[9];
				   $datos[$i]['modelo'] = $res[10];
				   $datos[$i]['serie'] = $res[11];
				   $datos[$i]['valorf'] = $res[12];
				   $i++;

				} 
			 

				return $datos;  

			}


			public function cargarMttoPublicaciones()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT p.id, p.titulo, d.`descripcion` ,DATE_FORMAT( p.fecha, '%d/%b/%Y') AS fecha, 
				DATE_FORMAT( p.hora, '%l:%i%p') AS hora , e.`descripcion`, c.`descripcion`
				FROM b_publicaciones_bancaprepa p
				INNER JOIN b_cat_doc d ON d.id=p.`documento_id`
				INNER JOIN estatus e ON e.`id`=p.`estatus`
				INNER JOIN capturistas c ON c.`id`=p.`capturista_id`
				ORDER BY p.id DESC"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['titulo'] = $res[1];
				   $datos[$i]['tipoDoc'] = $res[2];
				   $datos[$i]['fecha'] = $res[3];
				   $datos[$i]['hora'] = $res[4];
				   $datos[$i]['estatus'] = $res[5];
				   $datos[$i]['capturista'] = $res[6];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarVistoDePub($idpub)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT p.id, cap.descripcion, c.visto,DATE_FORMAT( c.fecha_visto, '%d/%b/%Y') AS fecha, 
					DATE_FORMAT( c.hora_visto, '%l:%i%p') AS hora,s.nomComercial
					FROM b_publicaciones_bancaprepa p
					INNER JOIN b_confirmaciones c ON c.publicacion_id = p.`id`
					INNER JOIN capturistas cap ON cap.id= c.empleado_id
					INNER JOIN sucursales s ON s.id = cap.sucursal_id
					WHERE p.id=$idpub
					ORDER BY descripcion ASC"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1];
				   $datos[$i]['visto'] = $res[2];
				   $datos[$i]['Fvisto'] = $res[3];
				   $datos[$i]['Hvisto'] = $res[4];
				   $datos[$i]['sucursal'] = $res[5];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarPubXid($idpub)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id, titulo, descripcion
						FROM b_publicaciones_bancaprepa b
						WHERE id=$idpub"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['titulo'] = $res[1];
				   $datos[$i]['descripcion'] = $res[2];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}


			public function actualizarPublicaciones($pubid, $titulo, $desc)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_publicaciones_bancaprepa SET titulo='$titulo', descripcion='$desc', 
				 fecha_modificacion=CURDATE(), hora_modificacion=CURTIME()WHERE id=$pubid";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_publicaciones_bancaprepa'] =  array('0' => '0' );
				return  $datos;	
				
			}


			public function cargarEquipoXid($idequipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT e.id, e.descripcion, e.nota_cancelacion, e.fecha_baja, e.num_equipo, e.marca, e.modelo, e.serie, e.sucursal_id, e.valor_factura, e.area_id,
				e.tipo_equipo_id, s.nomComercial,t.`descripcion`
				FROM i_equipo e
				INNER JOIN sucursales s ON s.`id`=e.sucursal_id
				INNER JOIN i_tipo_equipo t ON t.`id`=e.`tipo_equipo_id`
				WHERE e.id=$idequipo"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $datos[$i]['nota'] = $res[2];
				   $datos[$i]['fechaB'] = $res[3];
				   $datos[$i]['numEquipo'] = $res[4];
				   $datos[$i]['marca'] = $res[5];
				   $datos[$i]['modelo'] = $res[6];
				   $datos[$i]['serie'] = $res[7];
				   $datos[$i]['sucursal'] = $res[8];
				   $datos[$i]['valor_factura'] = $res[9];
				   $datos[$i]['area_id'] = $res[10];
				   $datos[$i]['tipo'] = $res[11];
				   $datos[$i]['nombre_sucursal'] = $res[12];
				   $datos[$i]['tipo_equipo'] = $res[13];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function darDeBajaEquipo($equipoid, $descDes)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE i_equipo SET estatus_id=6, nota_cancelacion='$descDes', fecha_baja=CURDATE() WHERE id=$equipoid";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['i_equipo'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function busquedaEmpleadosXnombre($nom)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id, descripcion
						FROM capturistas WHERE descripcion like '%$nom%' AND estatus_id=5"; 

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

			public function insertarResponsiva($empleado_id,$equipo_id,$fecha_ent,$comentarios)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT i_responsivas (equipo_id, capturista_id, fecha, fecha_entrega, comentario) 
					VALUES ($equipo_id,$empleado_id,CURDATE(),'$fecha_ent','$comentarios')";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['equipo_id'] =  array('0' => '0' );
				return  $datos;	
			}


			public function darBajapublicaciones($pubid)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE b_publicaciones_bancaprepa SET estatus=6 WHERE id=$pubid";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['b_publicaciones_bancaprepa'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function cargarEmpleadosXId($idcap)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id, descripcion
						FROM capturistas
						WHERE id=$idcap"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarResponsables($id_equipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT c.`descripcion`,DATE_FORMAT( r.`fecha_entrega`, '%d/%b/%Y') AS fecha, r.`comentario`
					FROM i_equipo e
					INNER JOIN i_responsivas r ON r.`equipo_id`=e.`id`
					INNER JOIN capturistas c ON c.id=r.`capturista_id`
					WHERE e.id=$id_equipo ORDER BY r.id DESC "; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['nombreEncargado'] = $res[0];
				   $datos[$i]['fechaEntrega'] = $res[1];
				   $datos[$i]['comentario'] = $res[2];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			public function actualizarEquipo($idequipo,$desc, $numequipo, $marca, $modelo, $serie, $suc, $valorF, $area, $tipoequipo)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				
				$sql="UPDATE i_equipo SET descripcion='$desc', num_equipo=$numequipo, marca = '$marca', modelo='$modelo', serie='$serie', 
					sucursal_id=$suc, valor_factura='$valorF', area_id=$area, tipo_equipo_id=$tipoequipo 
					WHERE id=$idequipo";
				
				$resultado = mysqli_query($this->con(), $sql);   
				$datos['i_equipo'] =  array('0' => '0' );
				return  $datos;	
			}
			
			public function cargarIdEquipoXnumEquipo($num_equipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id, num_equipo
						FROM i_equipo
						WHERE num_equipo=$num_equipo"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id_equipo'] = $res[0];
				   $datos[$i]['num_equipo'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_equipo']  =0;
					return  $datos; 
				  }


				return $datos;  

			}
			public function actualizarEncargadoActual($idequipo,$encargadoActual)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
				
				$sql="UPDATE i_equipo SET encargado_id=$encargadoActual	WHERE id=$idequipo";
				
				$resultado = mysqli_query($this->con(), $sql);   
				$datos['i_equipo'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarSucursalPorEquipo($id_suc)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id,nomComercial
				FROM sucursales WHERE id=$id_suc"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nomComercial'] = $res[1];
				   $i++;

				} 


				$sql="SELECT id,nomComercial
				FROM sucursales WHERE id<>$id_suc"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nomComercial'] = $res[1];
				   $i++;

				} 

				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarInsercciones()
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT id
				FROM aux"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   
				   $i++;

				} 

				if ( count($datos )==0) { 
					$datos[0]['capturista_id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function insertarNuevosUsuarios($empleado_id,$usuario,$pass)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO usuarios SET nombre='$usuario', clave= MD5('$pass'), empleado=$empleado_id, pwdtmp='$pass'";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['usuarios'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarResponsiva($idEquipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT e.id, e.descripcion,  e.num_equipo,DATE_FORMAT( r.`fecha_entrega`, '%d/%b/%Y') AS fecha , c.descripcion
				FROM i_equipo e 
				INNER JOIN i_responsivas r ON e.encargado_id=r.`capturista_id`
				INNER JOIN capturistas c ON c.`id`= e.`encargado_id`
				WHERE e.id=$idEquipo
				ORDER BY r.`id` DESC
				LIMIT 1"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $datos[$i]['num_equipo'] = $res[2];
				   $datos[$i]['fecha_entrega'] = $res[3];
				   $datos[$i]['encargado'] = $res[4];
				   $i++;

				} 

				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarSitieneUsuarioOno($id_empleado)
			{
                
				$res=array();
				$datos=array();
				$i=0; 

				

				$sql="SELECT c.id, c.descripcion, IFNULL(u.nombre,'vacio')
				FROM capturistas c
				LEFT OUTER JOIN usuarios u ON u.empleado=c.id
				WHERE c.id=$id_empleado "; 
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id_empleado'] = $res[0];
				   $datos[$i]['nombrecompleto'] = $res[1];
				   $datos[$i]['usuario']  = $res[2]; 
				   
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_empleado']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarUsuariosXID($id_usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 


				$sql="SELECT c.id, c.`descripcion` AS Nombre, u.`nombre` AS Usuario,
					IFNULL(u.pwdtmp,'Sin contraseña disponible') AS pass, u.entregado, e.descripcion AS estatus, s.`nomComercial`
					FROM usuarios u
					INNER JOIN capturistas c ON c.id=u.`empleado`
					INNER JOIN estatus e ON c.estatus_id=e.id 
					INNER JOIN sucursales s ON s.`id`=c.`sucursal_id`
					WHERE c.id=$id_usuario
					ORDER BY c.id DESC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['usuario'] = $res[2]; 
				   $datos[$i]['pass'] = $res[3]; 
				   $datos[$i]['entregado'] = $res[4]; 
				   $datos[$i]['estatus'] = $res[5]; 
				   $datos[$i]['sucursal'] = $res[6]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarNumDepub($id_usuario, $doc_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				$v="N";

				$sql="SELECT COUNT(p.id), d.id, d.descripcion
					FROM b_publicaciones_bancaprepa p
					INNER JOIN b_confirmaciones conf ON conf.publicacion_id=p.id
					INNER JOIN capturistas c ON c.id=conf.empleado_id
					INNER JOIN b_cat_doc d ON d.id=p.documento_id
					WHERE c.id=$id_usuario AND conf.visto='N' AND p.documento_id=$doc_id AND p.estatus=5";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['conteo'] = $res[0];
				   $datos[$i]['id_doc'] = $res[1]; 
				   $datos[$i]['descripcion'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['conteo']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function actualizarUsuariosEntregaSi($id_usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE usuarios SET entregado='SI' WHERE empleado=$id_usuario";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['usuarios'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function actualizarUsuariosEntregaNo($id_usuario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE usuarios SET entregado='NO' WHERE empleado=$id_usuario";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['usuarios'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function actualizarTelefonoCapturista($capturista_id,$telefono)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="UPDATE capturistas SET telefono='$telefono' WHERE id=$capturista_id";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos[$i]['telefono'] = $telefono; 
				return  $datos;	
				
			}

			public function cargarSucursalesXEmpresa($empresa_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				$v="N";

				$sql="SELECT sucursales.id AS sucursal_id
					, sucursales.nomComercial AS sucursal
					FROM sucursales 
					WHERE sucursales.activa = 'S' AND sucursales.b_estatus='S' AND b_empresa = $empresa_id
					ORDER BY nomComercial ASC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarEmpleadosXempresaYSucursal($empresa, $sucursal, $publicacion_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO b_confirmaciones (publicacion_id, empleado_id, puesto_id, empresa_id) 
					SELECT $publicacion_id, c.id,c.rol_id, ue.empresa_id 
					FROM capturistas c
					INNER JOIN b_usuario_empresa ue ON ue.usuario_id=c.id
					INNER JOIN b_empresa_sucursales es ON es.empresa_id=ue.empresa_id
					INNER JOIN sucursales s ON s.id=es.sucursal_id
					WHERE c.sucursal_id=$sucursal AND ue.empresa_id=$empresa GROUP BY c.id";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function verifNombreDeUsuarios($nombre_usuario)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				$v="N";

				$sql="SELECT count(id), nombre, empleado
				FROM usuarios
				WHERE nombre LIKE '$nombre_usuario'";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['contador'] = $res[0];
				   $datos[$i]['nombre'] = $res[1]; 
				   $datos[$i]['empleado_id'] = $res[2]; 
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarAreaXId($id_area)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT id, descripcion
				FROM b_cat_areas
				WHERE id=$id_area";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1]; 
				   $i++;

				} 


				$sql="SELECT id, descripcion
				FROM b_cat_areas
				WHERE id<>$id_area"; 

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

			public function cargarTipoEquipoXId($id_tipoEquipo)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT id, descripcion
				FROM i_tipo_equipo
				WHERE id=$id_tipoEquipo";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1]; 
				   $i++;

				} 


				$sql="SELECT id, descripcion
				FROM i_tipo_equipo
				WHERE id<>$id_tipoEquipo"; 

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
			public function cargarImg($imgId)
			{ 
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT titulo,descripcion,imagen,documento,fecha,hora,formato FROM b_publicaciones_bancaprepa WHERE id=$imgId"; 
 
				$resultado = mysqli_query($this->con(), $sql);  
				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['titulo'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1]; 
				   $datos[$i]['imagen'] = $res[2]; 
				   $datos[$i]['documento'] = $res[3];
				   $datos[$i]['fecha'] = $res[4]; 
				   $datos[$i]['hora'] = $res[5]; 
				   $datos[$i]['formato'] = $res[6];
				   $i++;

				} 
				


				return $datos;  

			}

			public function verifSiYaTieneResponsiva($equipo_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				$v="N";

				$sql="SELECT COUNT(equipo_id), $equipo_id
				FROM i_responsivas r
				WHERE r.equipo_id=$equipo_id";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['contador'] = $res[0];
				   $datos[$i]['equipo_id'] = $res[1];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['contador']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			//////////////////////////////////////////////////////////	//AGREGAAAAAAAAAAAAAR AL QUE ESTA EN EL SERVIDOR DESDE AQUÍ


			
			public function insertEnInventarioGeneral($sucursal)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="INSERT INTO i_inventario(sucursal_id, capturista_id, fecha, hora, estatus_id) 
									VALUES($sucursal,$txtUsuario, CURDATE(),CURTIME(), 1)";
			    
				$resultado = mysqli_query($this->con(), $sql);   
				
				$datos['i_inventario'] =  array('0' => '0' );
				return  $datos;	
			}


			public function insertEnInventarioDetalle($equipo)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				
				$sql="INSERT INTO i_inventario_detalle (inventario_id, equipo_id, fecha_insertado, hora_insertado) 
					  SELECT id,  $equipo, CURDATE(), CURTIME()
						FROM i_inventario
						ORDER BY id DESC
						LIMIT 1";
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id'] =  array('0' => '0' );
				return  $datos;	
			}

			
			public function cargarTodosInventarios($sucursal_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				

				$sql="SELECT i.id, s.`nomComercial`, i.`fecha`, i.hora, IFNULL(i.`fecha_terminado`,'-'), IFNULL(i.`hora_terminado`,'-'), e.`descripcion`,e.id, c.`descripcion`
				FROM i_inventario i 
				INNER JOIN sucursales s ON s.id=i.sucursal_id
				INNER JOIN estatus e ON e.`id`=i.`estatus_id`
				INNER JOIN capturistas c ON c.id=i.capturista_id
				where i.sucursal_id = $sucursal_id
				ORDER BY i.id DESC";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_inventario'] = $res[0];
				   $datos[$i]['sucursal_nombre'] = $res[1];
				   $datos[$i]['fecha_creado'] = $res[2];
				   $datos[$i]['hora_creado'] = $res[3];
				   $datos[$i]['fecha_terminado'] = $res[4];
				   $datos[$i]['hora_terminado'] = $res[5];
				   $datos[$i]['estatus'] = $res[6];	   
				   $datos[$i]['estatus_id'] = $res[7];	   
				   $datos[$i]['capturista'] = $res[8];	
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_inventario']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			
			public function iniciarInventario($sucursal)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				$txtUsuario=$_COOKIE["b_capturista_id"];  
				
				$sql="INSERT INTO i_inventario (sucursal_id, capturista_id, fecha,hora, estatus_id) 
					  VALUES ($sucursal, $txtUsuario, CURDATE(), CURTIME(), 1) ";
						
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['id_emp'] =  array('0' => '0' );
				return  $datos;	
			}

			public function finalizarInventario()
			{
				$res=array();
				$datos=array();
				$i=0; 

				$sql="SELECT id
					FROM i_inventario
					ORDER BY id DESC
					LIMIT 1"; 
 
				$resultado = mysqli_query($this->con(), $sql);  
				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_inventario'] = $res[0];
				  
				   $i++;

				} 
				


				return $datos;  
				
			}

			public function actualizarInventario($id_inventario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="UPDATE i_inventario SET fecha_terminado=CURDATE(), hora_terminado=CURTIME(), estatus_id=2 WHERE id=$id_inventario";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['i_inventario'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function cargarEquiposPorInventario($inventario_id)
			{
				$q="";
				$res=array();
				$datos=array();
				$i=0; 
				

				$sql="SELECT i.id, e.id, t.descripcion, e.`descripcion`, s.`nomComercial`, IFNULL(c.`descripcion`,'-'), e.marca, e.sucursal_id
				FROM i_inventario i 
				INNER JOIN i_inventario_detalle d ON d.inventario_id=i.id
				INNER JOIN i_equipo e ON e.id = d.equipo_id
				INNER JOIN sucursales s ON s.id=i.sucursal_id
				INNER JOIN i_tipo_equipo t ON t.id = e.tipo_equipo_id
				LEFT JOIN capturistas c ON c.id = e.`encargado_id`
				WHERE i.id=$inventario_id AND e.`estatus_id`=5 ORDER BY e.id asc";
				
				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {

				   $datos[$i]['id_inventario'] = $res[0];
				   $datos[$i]['id_equipo'] = $res[1];
				   $datos[$i]['tipo_equipo'] = $res[2];
				   $datos[$i]['desc'] = $res[3];
				   $datos[$i]['sucursal'] = $res[4];
				   $datos[$i]['encargado_nombre'] = $res[5]; 
				   $datos[$i]['marca'] = $res[6];
				   $datos[$i]['id_sucursal'] = $res[7];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id_inventario']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			

			public function eliminarInventarioXID($inventario_id)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				
	
				$sql="DELETE FROM i_inventario_detalle WHERE inventario_id=$inventario_id";
			    
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['i_inventario_detalle'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function insertEnInventarioDetalleEditar($id_inventario,$equipo)
			{
				
				
				
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;

				$sql="INSERT INTO i_inventario_detalle(inventario_id, equipo_id, fecha_insertado, hora_insertado) 
					  VALUES($id_inventario,$equipo, CURDATE(), CURTIME() ) ";
				
				
						
				
				$resultado = mysqli_query($this->con(), $sql);   

				$datos['inventario_id'] =  array('0' => '0' );
				return  $datos;	
			}

			public function cargarEquipoXidPara_Inventario($idequipo)
			{
  
				$res=array();
				$datos=array();
				$i=0; 

				
				$sql="SELECT e.id, e.descripcion, e.nota_cancelacion, e.fecha_baja, e.num_equipo, e.marca, e.modelo, e.serie, e.sucursal_id, e.valor_factura, e.area_id,
				e.tipo_equipo_id, s.nomComercial,t.`descripcion`, IFNULL(c.`descripcion`,'-')
				FROM i_equipo e
				INNER JOIN sucursales s ON s.`id`=e.sucursal_id
				INNER JOIN i_tipo_equipo t ON t.`id`=e.`tipo_equipo_id`
				LEFT JOIN capturistas c ON c.id=e.`encargado_id`
				WHERE e.id=$idequipo and e.estatus_id=5"; 

				$resultado = mysqli_query($this->con(), $sql); 

				while ($res = mysqli_fetch_row($resultado)) {
				   $datos[$i]['id'] = $res[0];
				   $datos[$i]['descripcion'] = $res[1];
				   $datos[$i]['nota'] = $res[2];
				   $datos[$i]['fechaB'] = $res[3];
				   $datos[$i]['numEquipo'] = $res[4];
				   $datos[$i]['marca'] = $res[5];
				   $datos[$i]['modelo'] = $res[6];
				   $datos[$i]['serie'] = $res[7];
				   $datos[$i]['sucursal'] = $res[8];
				   $datos[$i]['valor_factura'] = $res[9];
				   $datos[$i]['area_id'] = $res[10];
				   $datos[$i]['tipo'] = $res[11];
				   $datos[$i]['nombre_sucursal'] = $res[12];
				   $datos[$i]['tipo_equipo'] = $res[13];
				   $datos[$i]['encargado'] = $res[14];
				   $i++;

				} 
				
				if ( count($datos )==0) { 
					$datos[0]['id']  =0;
					return  $datos; 
				  }


				return $datos;  

			}

			public function cargarEquiposPorInventarioComparando($inventario_id, $sucursal_id)
			{
						$q="";
						$res=array();
						$datos=array();
						$i=0; 
						

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


			public function eliminarInvRecienCreado($id_inventario)
			{
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				$txtUsuario=$_COOKIE["b_capturista_id"];  
	
				$sql="DELETE FROM i_inventario WHERE id = $id_inventario";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['i_inventario'] =  array('0' => '0' );
				return  $datos;	
				
			}

			public function editarUsuario($user, $pass, $empleado_id)
			{
				
				$res=array();
				$datos=array();
				$resultado  =array();
				$i=0;
	
				 
	
				$sql="UPDATE usuarios SET nombre='$user', pwdtmp='$pass',clave= MD5('$pass') WHERE empleado=$empleado_id";
			    
				$resultado = mysqli_query($this->con(), $sql);   
	
				$datos['usuarios'] =  array('0' => '0' );
				return  $datos;	
				
			}





			



			


			

}

