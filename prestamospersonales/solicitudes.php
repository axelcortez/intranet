<!DOCTYPE html>
<html lang="en" >

   
    <head>
        
            <meta charset="UTF-8">  
            <title>Solicitudes de prestamos</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onload="cargarSolicitud()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
        <h3 class="header " align="center" style="color:#1a237e;">Solicitudes de Prestamos Personales</h3> 
      
        <div class="row"><!-- CONTENEDOR 1 -->
            <div class="input field col s12 ">
                    <label for="Id" class="activate" '></label>
                    <input placeholder="Id" id="IdEmpleadoSol" type="text" class="validate" style='display:none;' >
            </div>
            <div class="input-field col s6 l3 offset-l1">
                    <i class="material-icons prefix">business</i>
                    <select id="sucursalesSolicitudes">
                    </select>
                    <label>Sucursal</label>
            </div>
            <div class="input-field col s6 l3">
                    <i class="material-icons prefix">menu</i>
                    <select id="estatusSolicitudes">
                    </select>
                    <label>Estatus</label>
            </div>
            <div class="input-field col s8 l4">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="nombreAbuscarSol" type="text" class="validate" placeholder="Nombre" onkeyup="buscaEmpleadosSolicitudesP()"/>
                    <label for="nombreAbuscarSol">Nombre</label>
            </div>
        </div>
        <div class="row" style='display:none;' id="rowNombre">
            <div class="input-field col s8 l4 offset-l7 offset-s2" id="listaEmpleadosBC" >
                    <table class="highlight">
                                    <tbody id="listaEmpleadosTablaBC">
                                    
                                    </tbody>
                    </table>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 l3 offset-l3">
                    <i class="material-icons prefix">date_range</i>
                    <input id="desdeSol" type="date" class="validate">
                    <label for="desdeSol">Desde:</label>
            </div>
            <div class="input-field col s6 l3">
                        <input id="hastaSol" type="date" class="validate">
                        <label for="hastaSol">Hasta:</label>
            </div>
        </div>
       

        <div class="row">
            <div class="col s6 offset-s4">
                <a id="btnBuscarSolicitudes" class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Buscar</a>
                <a id="btnLimpiarSol" class="waves-effect btn blue darken-4"><i class="material-icons left">brush</i>Limpiar</a>
                <a id="btnExcelSol" class="waves-effect btn blue darken-4"><i class="fas fa-file-excel"></i> Excel</a>
            </div>
           
            <div class="col s12 l12">
                <table class="highlight responsive-table" style="font-size:11px;">
                    <thead >
                    <tr>
                        <th>Id</th>
                        <th>Sucursal</th>
                        <th>Nombre del Solicitante</th>
                        <th>Fecha Solicitud</th>
                        <th>Monto Solicitado</th>
                        <th>Quincenas</th>
                        <th>Monto Autorizado</th>
                        <th>Descuento Mensual</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                                                         
                    </tr>
                    </thead>

                    <tbody id="tablaSolicitudes">
                        
                    </tbody>
                </table>
                <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="display:none">
                    <thead >
                    <tr>
                        <th>Sucursal</th>
                        <th>Id</th>
                        <th>Nombre</th> 
                        <th>Monto Solicitado</th>
                        <th>Numero de cuenta</th>
                        <th>Banco</th>
                        <th>Beneficiario</th>
                        <th>Estatus</th>
                        
                    </tr>
                    </thead>

                    <tbody id="tablaSolicitudesExcel">
                        
                    </tbody>
                </table>
            </div>
        </div>

         

        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/bancaprepa.js"></script>
        <script type="text/javascript" src="../js/js.cookie.js"></script>
        <script type="text/javascript" src="../js/equipo.js"></script>
        <script type="text/javascript" src="../js/prestamos.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 

        <!-------------------- Modal para autorizar-------------------------->
    <div id="modalAutorizarPrestamos" class="modal">
           <nav class="teal lighten-1">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">thumbs_up_down</i>Autorizar Prestamo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <h6><b>¿Autorizar Prestamo?</b></h6>
                <div class="switch" onChange="swAutorizar()">
                        <label>
                        No Autorizar
                        <input type="checkbox" id="chAutorizar">
                        <span class="lever"></span>
                        Autorizar
                        </label>
                </div>
                <div class="row">
                    <div class="input-field col s5">
                        Comentario:
                        <textarea id="txtArea" class="materialize-textarea"></textarea> 
                    </div>
                    <div class="input-field col s2">
                        Monto:
                        <input id="montoAutorizar" style='display:none;' type="text" class="validate">
                        
                    </div>
                    <div class="input-field col s3">
                        Fecha de inicio de pago:
                        <input id="inicio_pago" style='display:none;' type="date" class="validate">
                        
                    </div>
                    <div class="col s1">
                        <a id="btnAutorizarPrestamo" class="waves-effect waves-light btn teal lighten-1 right"><i class="material-icons center">thumbs_up_down</i></a>
                    </div>
                        
                </div>
                <div class="row">
                <div class="col s12" id="cargarArchivoSolicitud"  style='display:none;'>

                </div>
                </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat right">Cancelar</a>
               
           </div>
    </div>
    
    <div id="modalinfoPrestamo" class="modal">
           <nav class="teal lighten-1">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">comment</i>Información del Prestamo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
                <div class="row">
                    <div class="input-field col s6">
                        <h7>Comentarios:</h7>
                        <textarea id="textoAreaInfo" class="materialize-textarea" disabled></textarea>
                    </div>
                    <div class="input-field col s3">
                        <h7 id="texto_monto_autorizado" style='display:none;'>Monto autorizado:</h7>
                        <input id="textoMontoAInfo" style='display:none;' type="text" class="validate" disabled>
                    </div>
                    <div class="col s12">
                        <table class="highlight" >
                            <thead >
                            <tr>
                                <th>Numero de pago</th>
                                <th>Cantidad</th>
                                <th>Fecha de pago</th>
                                <th>Abonado</th>                                 
                            </tr>
                            </thead>

                            <tbody id="tablaCorrida">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
           </div>
    </div>



    <div id="modalConfirmarDispersion" class="modal">

        <nav class="red darken-4">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col l12 offset-l4">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons">comment</i>¡¡ALERTA!!
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        <div class="modal-content">
            <div class="row">
                <div class="col">
                    <h3 class="center-align">¿Seguro que desea dispersar el prestamo?</h3 class="center-align">
                </div>
                <div class="col l6 s6 right-align" id="btnDispersarPrestamo">
                    <a class="waves-effect waves-light btn-small blue darken-4">Aceptar</a>
                </div>
                <div class="col l6 s6 left-align"  id="btn cancelar">
                    <a class="waves-effect waves-light btn-small red darken-4 modal-close">Cancelar</a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
        </div>
    </div>
    </body>
</html>