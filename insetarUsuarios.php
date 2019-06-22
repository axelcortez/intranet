<!DOCTYPE html>
<html lang="en" >


   
<head>
    
        <meta charset="UTF-8">  
        <title>Intranet Bancaprepa</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="css/bancaprepa.css">
        <link rel="icon" type="image/png" href="img/favicon.ico" /> 
</head>
    <body>
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
            
        </div>
    
            <?php
                include('menu/menu.php');
            ?>

    <br>
            <div class="col s12" align="center">
                            <a id="agregaAtodos" class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Agregar</a>
                    </div>  

            
            
    
    </div>

    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/bancaprepa.js"></script>
    <script type="text/javascript" src="js/js.cookie.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 

    
 
    </body>
</html>