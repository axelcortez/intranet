<!DOCTYPE html>
<html lang="en" >


   
<head>
    
        <meta charset="UTF-8">  
        <title>Resultados Votaciones</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="css/bancaprepa.css">
        <link rel="icon" type="image/png" href="img/favicon.ico" /> 
</head>
    <body onLoad="cargarResultadosVotos()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
            
        </div>
    
            <?php
                include('menu/menu.php');
            ?>

            <h3 class="header " align="center" style="color:#1a237e;">Resultados Votaciones</h3>
            <div class="col s12 offset-s1"><!-- CONTENEDOR 2 -->
                                    <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
                                        <thead >
                                        <tr>
                                            <th>Numero de Altar</th>
                                            <th>Id Sucursal</th>
                                            <th>Sucursal</th>
                                            <th>Votos</th> 
                                        </tr>
                                        </thead>

                                        <tbody id="tablaResultados">
                                           
                                        </tbody>
                                    </table>
            </div>
            <div class="row">
                <div class="input-field col s2 offset-s10">
                    <input placeholder="Total votos" id="total_votos" type="text" class="validate">
                    <label for="total_votos"><b>Total votos:</b></label>
                </div>
            </div>
            
    
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/bancaprepa.js"></script>
    <script type="text/javascript" src="js/js.cookie.js"></script>
    <script type="text/javascript" src="js/votaciones.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 

    
 
    </body>
</html>