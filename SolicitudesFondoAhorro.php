<!DOCTYPE html>
<html lang="en" >

   
    <head>
        
            <meta charset="UTF-8">  
            <title>Solicitudes de fondo de ahorro</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarSolicitudesFA()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Solicitudes de fondo de ahorro</h3> 
            <div class="row">
                <div class="col l11 s12 right-align">
                    <a id="btnExcelSolicitudes" class="waves-effect btn teal darken-1"><i class="fas fa-file-excel"></i> Excel</a>
                </div>
            </div>
            <div class="row">
                <div class="col l10 s12 offset-l1">
                <div class="card">
                    <div class="card-content center-align">
                        <div id="content">
                            <table class="highlight responsive-table centered">
                                    <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado Id</th>
                                        <th>Empleado</th>
                                        <th>Fecha de registro</th>   
                                        <th>Hora de registro</th>  
                                        <th>Acepto porcentaje de aceptación</th>   
                                        <th>Acciones</th>         
                                        
                                    </tr>
                                    </thead>

                                    <tbody id="datosSolicitudesFondo">
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col l10 s12 offset-l1"  style='display:none;'>
                <div class="card">
                    <div class="card-content center-align">
                        <div id="content">
                            <table class="highlight responsive-table centered">
                                    <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado Id</th>
                                        <th>Empleado</th>
                                        <th>Fecha subido</th>   
                                        <th>Hora subido</th>  
                                        <th>Acepto porcentaje de aceptación</th>   
                                              
                                        
                                    </tr>
                                    </thead>

                                    <tbody id="datosSolicitudesFondoExcel">
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript" src="js/bancaprepa.js"></script>
        <script type="text/javascript" src="js/js.cookie.js"></script>
        <script type="text/javascript" src="js/fondoAhorro.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 

    

    <div id="modalVerArchivoDesdeSolicitudes" class="modal">
           <nav class="indigo darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">insert_photo</i>Archivo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
                <div class="row">
                    <div class="col 12 s12 " id="cargarArchivo" >

                    </div>
                </div>     
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
           </div>
    </div>
    </body>
</html>