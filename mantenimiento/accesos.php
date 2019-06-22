<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Accesos</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
</head>
    <body onLoad="cargarMenuPorRol()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
                <div class="row">
                    <div class="nav-wrapper">
                        <?php
                            include('../menu/menu.php');
                        ?> 
                        <h4 class="header " style="color:#1a237e;">Accesos</h4>
                        <hr>
                    </div>
                </div>
            </div>
          
            <div class="row">
                    <div class='input-field col s4 offset-s2'>
                            <select id="tipoRolAc" onChange="cargarAccesos(tipoRolAc.value)"> 
                            </select>
                            <label><strong>Seleccione el Rol:</strong></label>
                    </div>
                    <div class=' col s4' id="accesosRol">
                        <h6>Menu</h6> 
                        <p><label><input type="checkbox" id="agregarPub" onChange="habDesAccesos(tipoRolAc.value,'agregarPub',1)"/><span>Agregar Publicacion</span></label></p>
                        <p><label><input type="checkbox" id="bancaprepaCh" onChange="habDesAccesos(tipoRolAc.value,'bancaprepaCh',11)"/><span>Publicaciones Vistas</span></label></p>
                        <p><label><input type="checkbox" id="mandarTicket" onChange="habDesAccesos(tipoRolAc.value,'mandarTicket',2)"/><span>Mandar Ticket</span></label></p>
                        <p><label><input type="checkbox" id="catEmp" onChange="habDesAccesos(tipoRolAc.value,'catEmp',3)"/><span>Catalogo de empresas</span></label></p>
                        <p><label><input type="checkbox" id="catRoles" onChange="habDesAccesos(tipoRolAc.value,'catRoles',4)"/><span>Catalogo de roles</span></label></p>
                        <p><label><input type="checkbox" id="tipoDoc" onChange="habDesAccesos(tipoRolAc.value,'tipoDoc',5)"/><span>Tipo de documentos</span></label></p>
                        <p><label><input type="checkbox" id="correosCheck" onChange="habDesAccesos(tipoRolAc.value,'correosCheck',9)"/><span>Correos</span></label></p>
                        <p><label><input type="checkbox" id="cargarArchivos" onChange="habDesAccesos(tipoRolAc.value,'cargarArchivos',6)"/><span>Cargar Archivos</span></label></p>
                        <p><label><input type="checkbox" id="usuarios" onChange="habDesAccesos(tipoRolAc.value,'usuarios',7)"/><span>Usuarios</span></label></p>
                        <p><label><input type="checkbox" id="accesosCheck" onChange="habDesAccesos(tipoRolAc.value,'accesosCheck',8)"/><span>Accesos</span></label></p>
                        <p><label><input type="checkbox" id="rolesUsuCh" onChange="habDesAccesos(tipoRolAc.value,'rolesUsuCh',10)"/><span>Roles-Usuarios</span></label></p>
                        <p><label><input type="checkbox" id="tipoEquipo" onChange="habDesAccesos(tipoRolAc.value,'tipoEquipo',12)"/><span>Catalogo de equipos</span></label></p>
                        <p><label><input type="checkbox" id="misTickets" onChange="habDesAccesos(tipoRolAc.value,'misTickets',13)"/><span>Mis Tickets</span></label></p>
                        <p><label><input type="checkbox" id="mantTickets" onChange="habDesAccesos(tipoRolAc.value,'mantTickets',14)"/><span>Mtto. Tickets</span></label></p>
                        <p><label><input type="checkbox" id="capInven" onChange="habDesAccesos(tipoRolAc.value,'capInven',15)"/><span>Captura de inventario</span></label></p>
                        <p><label><input type="checkbox" id="busquedaEquipoCh" onChange="habDesAccesos(tipoRolAc.value,'busquedaEquipoCh',16)"/><span>Busqueda de Equipo</span></label></p>
                        <p><label><input type="checkbox" id="mantPubCh" onChange="habDesAccesos(tipoRolAc.value,'mantPubCh',17)"/><span>Mantenimiento de Publicaciones</span></label></p>
                        <p><label><input type="checkbox" id="capAreas" onChange="habDesAccesos(tipoRolAc.value,'capAreas',18)"/><span>Captura de Areas</span></label></p>
                        <p><label><input type="checkbox" id="crearSolpp" onChange="habDesAccesos(tipoRolAc.value,'crearSolpp',19)"/><span>Crear Solicitudes Prestamos Personales</span></label></p>
                        <p><label><input type="checkbox" id="solicitudesPp" onChange="habDesAccesos(tipoRolAc.value,'solicitudesPp',20)"/><span>Solicitudes Prestamos Personales</span></label></p>
                        <p><label><input type="checkbox" id="registroStock" onChange="habDesAccesos(tipoRolAc.value,'registroStock',21)"/><span>Registro de Stock</span></label></p>
                        <p><label><input type="checkbox" id="solicitudArticulo" onChange="habDesAccesos(tipoRolAc.value,'solicitudArticulo',22)"/><span>Solicitudes de Articulos</span></label></p>
                        <p><label><input type="checkbox" id="pagosPp" onChange="habDesAccesos(tipoRolAc.value,'pagosPp',23)"/><span>Pagos Prestamos Personales</span></label></p>
                        <p><label><input type="checkbox" id="reportesPp" onChange="habDesAccesos(tipoRolAc.value,'reportesPp',24)"/><span>Reportes Prestamos Personales</span></label></p>
                        <p><label><input type="checkbox" id="cartaFondoA" onChange="habDesAccesos(tipoRolAc.value,'cartaFondoA',25)"/><span>Carta Fondo de Ahorro</span></label></p>
                        <p><label><input type="checkbox" id="solicitudesFondoAhorros" onChange="habDesAccesos(tipoRolAc.value,'solicitudesFondoAhorros',26)"/><span>Solicitudes Para Fondo de Ahorro</span></label></p>
                        <p><label><input type="checkbox" id="registroDeGrupos" onChange="habDesAccesos(tipoRolAc.value,'registroDeGrupos',27)"/><span>Registro de grupos</span></label></p>
                        <p><label><input type="checkbox" id="agendaDeActividades" onChange="habDesAccesos(tipoRolAc.value,'agendaDeActividades',28)"/><span>Agenda de Actividades</span></label></p>
                        
                    </div>
            </div>             
           
           
     </div>

                  

    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
     <!-------------------- Inicializar modal-------------------------->
    <script>
            $(document).ready(function(){
                 $('.modal').modal();
            });
    </script>
                
    </body>
</html>