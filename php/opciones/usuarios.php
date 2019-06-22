
<?php 
	
	require_once("../clases/usuario.php");
	$usuario = new Usuario();  
	//opciones a  ejecutar en el swich
	$opcion=$_REQUEST['opcion']; 
 
 	switch ($opcion) {
		 
		//Iniciar sesion
 		case 1: 
 			   echo (json_encode($usuario->login($_REQUEST['usuario'],$_REQUEST['password'])));
		break; 
		//Cargar catalogo de empresas
		case 2: 
			echo (json_encode($usuario->catalogoEmpresas($_REQUEST['empresa'])));
		break;
		//Cargar catalogo de roles
		case 3: 
			echo (json_encode($usuario->catalogoRoles($_REQUEST['rol'])));
		break;
		//Cargar catalogo de tipo de documentos 
		case 4: 
			echo (json_encode($usuario->catalogoDocumentos($_REQUEST['doc'])));
		break;
		//Guardar empresas 
		case 5: 
			echo (json_encode($usuario->guardarEmpresas($_REQUEST['empresa'])));
		break;
		//Guardar roles
		case 6: 
			echo (json_encode($usuario->guardarRoles($_REQUEST['rol'])));
		break;
		//Guardar tipo de documentos 
		case 7: 
			echo (json_encode($usuario->guardarDoc($_REQUEST['doc'])));
		break;
		//Cargar empresa por ID
		case 8: 
			echo (json_encode($usuario->cargarEmpPorId($_REQUEST['empresa_id'])));
		break;
		//Update para editar empresa
		case 9: 
			echo (json_encode($usuario->actualizarEmpresa($_REQUEST['empresa_id'],$_REQUEST['empresa'])));
		break;
		//Cargar roles por id
		case 10: 
			echo (json_encode($usuario->cargarRolPorId($_REQUEST['rol_id'])));
		break;
		//update para editar roles
		case 11: 
			echo (json_encode($usuario->actualizarRol($_REQUEST['rol_id'],$_REQUEST['rol'])));
		break; 
		//cargar tipo de documentos por ID
		case 12: 
			echo (json_encode($usuario->cargarDocPorId($_REQUEST['doc_id'])));
		break;
		//Update para editar tipo de documentos
		case 13: 
			echo (json_encode($usuario->actualizarDoc($_REQUEST['doc_id'],$_REQUEST['doc'])));
		break;
		//deshabilitar empresas
		case 14: 
			echo (json_encode($usuario->desEmp($_REQUEST['emp_id'])));
		break;
		//Deshabilitar roles
		case 15: 
			echo (json_encode($usuario->desRol($_REQUEST['rol_id'])));
		break;
		//deshabilitar tipo de documentos
		case 16: 
			echo (json_encode($usuario->desDoc($_REQUEST['doc_id'])));
		break; 
		//Eliminar empresas
		case 17: 
			echo (json_encode($usuario->eliminarEmp($_REQUEST['emp_id'])));
		break; 
		//Eliminar rol
		case 18: 
			echo (json_encode($usuario->eliminarRol($_REQUEST['rol_id'])));
		break; 
		//Eliminar Tipo de documentos
		case 19: 
			echo (json_encode($usuario->eliminarDoc($_REQUEST['doc_id'])));
		break; 
		case 20: 
			echo (json_encode($usuario->cargarPublicaciones()));
		break;
		case 21: 
			echo (json_encode($usuario->agregarPublicaciones($_REQUEST['texto'],$_REQUEST['tipopub'])));
		break;  
		case 22: 
			echo (json_encode($usuario->cargarAccesos($_REQUEST['id_rol'])));
		break; 
		case 23: 
			echo (json_encode($usuario->habilitarAcceso($_REQUEST['id_rol'],$_REQUEST['id_menu'])));
		break;
		case 24: 
			echo (json_encode($usuario->deshabilitarAcceso($_REQUEST['id_rol'],$_REQUEST['id_menu'])));
		break;
		case 25: 
			echo (json_encode($usuario->guardarPublicacion($_REQUEST['titulo'],$_REQUEST['descripcion'],$_REQUEST['imagen'],$_REQUEST['documento_id'],$_REQUEST['docuemento'],$_REQUEST['chbPDF'])));
		break;
		case 26: 
			echo (json_encode($usuario->catalogoCorreos($_REQUEST['cap_id'],$_REQUEST['sucursal'],$_REQUEST['puesto'])));
		break;
		case 27: 
			echo (json_encode($usuario->catDocumentos()));
		break;
		case 28: 
			echo (json_encode($usuario->catPublicaciones($_REQUEST['capturista_id'],$_REQUEST['menu'])));
		break;
		case 29: 
			echo (json_encode($usuario->cargarUsuarios($_REQUEST['usuario'])));
		break;
		case 30: 
			echo (json_encode($usuario->insertarUsuario_rol($_REQUEST['usuario'],$_REQUEST['rol'])));
		break;
		case 31: 
			echo (json_encode($usuario->cargarRolesUsuarios($_REQUEST['id_usuario'])));
		break;
		case 32: 
			echo (json_encode($usuario->insertarUsuario_Empresa($_REQUEST['usuario'],$_REQUEST['empresa'])));
		break;
		case 33:  
			echo (json_encode($usuario->verificarUsuario_rol($_REQUEST['usuario'],$_REQUEST['rol'])));
		break;
		case 34: 
			echo (json_encode($usuario->verificarUsuario_empresa($_REQUEST['usuario'],$_REQUEST['empresa'])));
		break;
		case 35: 
			echo (json_encode($usuario->cargarListadodeUsuarios($_REQUEST['usuario_id'])));
		break;
		case 36: 
			echo (json_encode($usuario->cargarRolesDeUsuarios($_REQUEST['usuario_id'])));
		break;
		
		case 37: 
			echo (json_encode($usuario->cargarEmpresasDeUsuarios($_REQUEST['usuario_id'])));
		break;
		case 38: 
			echo (json_encode($usuario->borrarRoldeUsuario($_REQUEST['usuario_id'],$_REQUEST['rol_id'])));
		break;
		case 39: 
			echo (json_encode($usuario->borrarEmpdeUsuario($_REQUEST['usuario_id'],$_REQUEST['empresa_id'])));
		break;
		case 40: 
			echo (json_encode($usuario->cargarUsuariosXnombre($_REQUEST['nom_usuario'])));
		break;
		case 41: 
			echo (json_encode($usuario->insertarEmpresa_rol($_REQUEST['idemp'], $_REQUEST['idrol'])));
		break;
		case 42: 
			echo (json_encode($usuario->VerifInsertarEmpresa_rol($_REQUEST['idemp'], $_REQUEST['idrol'])));
		break;
		case 43: 
			echo (json_encode($usuario->CargarRolXEmp($_REQUEST['idemp'])));
		break;
		case 44: 
			echo (json_encode($usuario->borrarRoldeEmp($_REQUEST['idemp'],$_REQUEST['idrol'])));
		break;
		case 45: 
			echo (json_encode($usuario->CargarPuestos()));
		break;
		case 46: 
			echo (json_encode($usuario->insertarTablaTmp($_REQUEST['idemp'],$_REQUEST['idpuesto'],$_REQUEST['idusuario'],$_REQUEST['idsucursal'])));
		break;
		case 47: 
			echo (json_encode($usuario->CargarTablaTemp($_REQUEST['idusuario'])));
		break;
		case 48: 
			echo (json_encode($usuario->EliminarDatoDeTmp($_REQUEST['empresa'],$_REQUEST['puesto'],$_REQUEST['sucursal'])));
		break;
		case 49: 
			echo (json_encode($usuario->verificarTablaTmp($_REQUEST['id_usuario'])));
		break;
		case 50:
			echo (json_encode($usuario->EliminarTodoDeTmp()));
		break;
		case 51:
			echo (json_encode($usuario->idParaTablaTmp($_REQUEST['id_usuario'])));
		break;
		case 52:
			echo (json_encode($usuario->insertarTablaDetalle($_REQUEST['publicacion_id'],$_REQUEST['empresa_id'],$_REQUEST['puesto_id'],$_REQUEST['sucursal_id'])));
		break;
		case 53:
			echo (json_encode($usuario->cargarRolesParaConfirmaciones($_REQUEST['publicacion_id'])));
		break; 
		case 54:
			echo (json_encode($usuario->cargarEmpleadosXempresa($_REQUEST['empresa_id'],$_REQUEST['publicacion_id'])));
		break;
		case 55:
			echo (json_encode($usuario->cargarEmpleadosXpuesto($_REQUEST['puesto_id'],$_REQUEST['empresa_id'],$_REQUEST['publicacion_id'])));
		break;
		case 56:
			echo (json_encode($usuario->insertarTablaConfirmaciones($_REQUEST['publicacion_id'],$_REQUEST['empleado_id'],$_REQUEST['puesto_id'],$_REQUEST['empresa_id'])));
		break;
		case 57:
			echo (json_encode($usuario->cargaPublicacionesBancaprepa($_REQUEST['usuario_id'],$_REQUEST['tipo_doc'])));
		break;
		case 58:
			echo (json_encode($usuario->ActualizarVisto($_REQUEST['publicacion_id'],$_REQUEST['empleado_id'])));
		break;
		case 59:
			echo (json_encode($usuario->cargaPubNuevas($_REQUEST['usuario_id'],$_REQUEST['tipo_doc'])));
		break;
		case 60:
			echo (json_encode($usuario->verificaPubNuevas($_REQUEST['usuario_id'],$_REQUEST['tipodoc'])));
		break;
		case 61:
			echo (json_encode($usuario->verificaPubVistas($_REQUEST['usuario_id'],$_REQUEST['tipodoc'])));
		break;
		case 62:
			echo (json_encode($usuario->verificaPubNuevasPorUsuario($_REQUEST['usuario_id'])));
		break;
		case 63:
			echo (json_encode($usuario->cargarSitieneCorreoOno($_REQUEST['usuario_id'])));
		break;
		case 64:
			echo (json_encode($usuario->insertarCorreos($_REQUEST['usuario_id'],$_REQUEST['dominio'],$_REQUEST['correo'],$_REQUEST['pass'])));
		break;
		case 65:
			echo (json_encode($usuario->catalogoCorreosxID($_REQUEST['usuario_id'])));
		break;
		case 66:
			echo (json_encode($usuario->actualizarCorreos($_REQUEST['usuario_id'],$_REQUEST['correo'],$_REQUEST['pass'],$_REQUEST['entregado'],$_REQUEST['estatus'])));
		break;	
		case 67:
			echo (json_encode($usuario->eliminarCorreos($_REQUEST['id_correo'])));
		break;
		case 68:
			echo (json_encode($usuario->cargarInventarios()));
		break;
		case 69:
			echo (json_encode($usuario->insertarEquipos($_REQUEST['descripcion'])));
		break;
		case 70:
			echo (json_encode($usuario->capturainv()));
		break;
		case 71:
			echo (json_encode($usuario->cargartipoequipos()));
		break;
		case 72:
			echo (json_encode($usuario->insertarcatequipos($_REQUEST['sucursal_id'],$_REQUEST['tipo_equipo'],$_REQUEST['num_equipo'],$_REQUEST['descripcion'],$_REQUEST['marca'],$_REQUEST['modelo'],$_REQUEST['serie'],$_REQUEST['fecha_compra'],$_REQUEST['valor_factura'],$_REQUEST['capturista'],$_REQUEST['area_id'])));
		break;
		case 73:
			echo (json_encode($usuario->noserierepetida($_REQUEST['serie'])));
		break;
		case 74:
			echo (json_encode($usuario->noequiporepetido($_REQUEST['tipo_equipo'],$_REQUEST['num_equipo'])));
		break;
		case 75:
			echo (json_encode($usuario->cargarTickets()));
		break;
		case 76:
			echo (json_encode($usuario->verifTablaTemporal($_REQUEST['usuario_id'])));
		break;
		case 77:
			echo (json_encode($usuario->cargarEquipos($_REQUEST['id'],$_REQUEST['sucursal'],$_REQUEST['numequipo'], $_REQUEST['area_id'])));
		break;
		case 78:
			echo (json_encode($usuario->cargarMttoPublicaciones()));
		break;
		case 79:
			echo (json_encode($usuario->cargarVistoDePub($_REQUEST['pub_id'])));
		break;
		case 80:
			echo (json_encode($usuario->cargarPubXid($_REQUEST['pub_id'])));
		break;
		case 81:
			echo (json_encode($usuario->actualizarPublicaciones($_REQUEST['pub_id'],$_REQUEST['tit'],$_REQUEST['des'])));
		break;
		case 82:
			echo (json_encode($usuario->cargarEquipoXid($_REQUEST['equipo_id'])));
		break;
		case 83:
			echo (json_encode($usuario->darDeBajaEquipo($_REQUEST['equipo_id'],$_REQUEST['descripcion'])));
		break;
		case 84:
			echo (json_encode($usuario->busquedaEmpleadosXnombre($_REQUEST['nombre'])));
		break;
		case 85:
			echo (json_encode($usuario->insertarResponsiva($_REQUEST['id_empleado'],$_REQUEST['idequipo'],$_REQUEST['fecha_ent'],$_REQUEST['comen'])));
		break;
		case 86:
			echo (json_encode($usuario->darBajapublicaciones($_REQUEST['pub_id'])));
		break;
		case 87:
			echo (json_encode($usuario->cargarEmpleadosXId($_REQUEST['empleado_id'])));
		break;
		case 88:
			echo (json_encode($usuario->cargarResponsables($_REQUEST['equipo_id'])));
		break;
		case 89:
			echo (json_encode($usuario->actualizarEquipo($_REQUEST['equipo_id'],$_REQUEST['desc'],$_REQUEST['num_equipo'],$_REQUEST['marca'],$_REQUEST['modelo'],$_REQUEST['serie'],$_REQUEST['sucursal'],$_REQUEST['valor_factura'],$_REQUEST['area_id'], $_REQUEST['tipo_id'])));
		break;
		case 90:
			echo (json_encode($usuario->cargarIdEquipoXnumEquipo($_REQUEST['num_equipo'])));
		break;
		case 91:
			echo (json_encode($usuario->actualizarEncargadoActual($_REQUEST['equipo_id'],$_REQUEST['encargado'])));
		break;
		case 92:
			echo (json_encode($usuario->cargarSucursalPorEquipo($_REQUEST['id_sucursal'])));
		break;
		case 93:
			echo (json_encode($usuario->cargarInsercciones()));
		break;
		case 94:
			echo (json_encode($usuario->insertarNuevosUsuarios($_REQUEST['empleado_id'],$_REQUEST['usuario'],$_REQUEST['contra'])));
		break;
		case 95:
			echo (json_encode($usuario->cargarResponsiva($_REQUEST['equipo_id'])));
		break;
		case 96:
			echo (json_encode($usuario->cargarSitieneUsuarioOno($_REQUEST['usuario_id'])));
		break;
		case 97:
			echo (json_encode($usuario->cargarUsuariosXID($_REQUEST['empleado_id'])));
		break;
		case 98:
			echo (json_encode($usuario->cargarNumDepub($_REQUEST['usuario'],$_REQUEST['doc'])));
		break;
		case 99:
			echo (json_encode($usuario->actualizarUsuariosEntregaSi($_REQUEST['usuario'])));
		break;
		case 100:
			echo (json_encode($usuario->actualizarUsuariosEntregaNo($_REQUEST['usuario'])));
		break;
		case 101:
			echo (json_encode($usuario->actualizarTelefonoCapturista($_REQUEST['capturista_id'],$_REQUEST['cel'])));
		break;
		case 102:
			echo (json_encode($usuario->cargarSucursalesXEmpresa($_REQUEST['empresa'])));
		break;
		case 103:
			echo (json_encode($usuario->verifNombreDeUsuarios($_REQUEST['usuario'])));
		break;
		case 104:
			echo (json_encode($usuario->cargarEmpleadosXempresaYSucursal($_REQUEST['empresa_id'],$_REQUEST['sucursal_id'],$_REQUEST['publicacion_id'])));
		break;
		case 105:
			echo (json_encode($usuario->cargarAreaXId($_REQUEST['area_id'])));
		break;
		case 106:
			echo (json_encode($usuario->cargarTipoEquipoXId($_REQUEST['tipo_id'])));
		break;
		case 107:
			echo (json_encode($usuario->cargarImg($_REQUEST['imgId'])));
		break;
		case 108:
			echo (json_encode($usuario->verifSiYaTieneResponsiva($_REQUEST['equipo_id'])));
		break;

		//AGREGAR DESDE AQUÍ AL SERVIDOR!!!!!!!!!!!!!!!
		
		case 109:
			echo (json_encode($usuario->insertEnInventarioGeneral($_REQUEST['sucursal'])));
		break;
		case 110:
			echo (json_encode($usuario->insertEnInventarioDetalle($_REQUEST['equipo_id'])));
		break;
		case 111:
			echo (json_encode($usuario->cargarTodosInventarios($_REQUEST['sucursal'])));
		break;
		case 112:
			echo (json_encode($usuario->iniciarInventario($_REQUEST['sucursal'])));
		break;
		case 113:
			echo (json_encode($usuario->finalizarInventario()));
		break;
		case 114:
			echo (json_encode($usuario->actualizarInventario($_REQUEST['inventario_id'])));
		break;
		case 115:
			echo (json_encode($usuario->cargarEquiposPorInventario($_REQUEST['inventario_id'])));
		break;
		case 116:
			echo (json_encode($usuario->eliminarInventarioXID($_REQUEST['inventario_id'])));
		break;
		case 117:
			echo (json_encode($usuario->insertEnInventarioDetalleEditar($_REQUEST['inventario_id'],$_REQUEST['equipo_id'])));
		break;
		case 118:
			echo (json_encode($usuario->cargarEquipoXidPara_Inventario($_REQUEST['equipo_id'])));
		break;
		case 119:
			echo (json_encode($usuario->cargarEquiposPorInventarioComparando($_REQUEST['inventario_id'],$_REQUEST['sucursal'])));
		break;
		case 120:
			echo (json_encode($usuario->eliminarInvRecienCreado($_REQUEST['inventario_id'])));
		break;
		case 121:
			echo (json_encode($usuario->editarUsuario($_REQUEST['usuario'],$_REQUEST['contra'],$_REQUEST['empleado_id'])));
		break;

 	}
 
?>