<!DOCTYPE html>
<html lang="en" >

   
    <head>
        
            <meta charset="UTF-8">  
            <title>Realizar Pagos</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarMenuPorRol()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('../menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Realizar Pagos</h3> 
            <div class="row">
                <div class="input-field col l3 s6 m4 offset-l4 offset-s2 offset-m3">
                    <i class="material-icons prefix">event</i>
                        <input id="fechaPago" type="date" class="validate">
                        <label for="fechaPago">Fecha pago:</label>
                </div>
                <div class="col l3 s3 m3">
                    <a class="btn-floating waves-effect waves-light indigo darken-4" id="buscarPagosXfecha"><i class="material-icons">search</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col l11 s11" align="right">
                    <p>
                        <label>
                            <input type="checkbox" id="selectall" disabled/>
                            <span>Seleccionar Todos</span>
                        </label>
                    </p>
                    <a class="waves-effect waves-light btn-small indigo darken-4" id="realizarPagos"><i class="material-icons left">attach_money</i>Pagar</a>
                </div>
                
            </div>
            <div class="row">
                <div class="col s11 l10 m12 offset-l1">
                    <table class="highlight responsive-table" id="tabladePagos">
                        <thead >
                        <tr>
                            <th>Id del solicitante</th>
                            <th>Nombre del Solicitante</th>
                            <th>Id del prestamo</th>
                            <th>N. de pago</th>
                            <th>Fecha de pago</th>
                            <th>Pago</th>
                            <th>Abono</th>
                            <th>Abonar</th>
                            
                                                            
                        </tr>
                        </thead>

                        <tbody id="tablaPagos">
                            
                        </tbody>
                    </table>
                </div>
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
    </body>
</html>