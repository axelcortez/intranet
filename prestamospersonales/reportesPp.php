<!DOCTYPE html>
<html lang="en" >

   
    <head>
        
            <meta charset="UTF-8">  
            <title>Reportes de Prestamos Personales</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarReportePrestamo()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('../menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Reportes de Prestamos Personales</h3> 
            <div class="row ">
                <div class="input-field col m6 s6 l3 offset-l3 offset-m1">
                    <i class="material-icons prefix">business</i>
                    <select id="sucursalesSolicitudes">
                    </select>
                    <label>Sucursal</label>
                </div>
                <div class="col l3 s6 m6 left-align ">
                    <a id="btnBuscarXSuc" class="waves-effect waves-light btn-small blue darken-4 "><i class="fas fa-search"></i>Buscar</a>
                    <a id="btnExcelReporte" class="waves-effect waves-light btn-small blue darken-4 "><i class="fas fa-file-excel"></i> Excel</a>
                </div>
            </div>

            <div class="row">
                <div class="col s12 l12 m12 ">
                    <table class="highlight responsive-table" id="tabladePagos" style="font-size:10px">
                        <thead >
                        <tr>
                            <th>Sucursal</th>
                            <th>Id del solicitante</th>
                            <th>Nombre del Solicitante</th>
                            <th>Fecha de ingreso</th>
                            <th>Monto Autorizado</th>
                            <th>Monto Total</th>
                            <th>Inicio descuento</th>
                            <th>Fin descuento</th>
                            <th>Quincenas Abonadas</th>
                            <th>Quincenas Totales</th>
                            <th>Descuento Mensual</th> 
                            <th>Suma</th> 
                            <th>Cantidad Restante</th> 
                            <th>Estatus</th>                  
                        </tr>
                        </thead>

                        <tbody id="tablaReportesPp">
                            
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