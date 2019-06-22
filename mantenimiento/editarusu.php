<!DOCTYPE html>
<html lang="en" >

   
    <head>
        
            <meta charset="UTF-8">  
            <title>Editar Usuario</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarConfEditUsuarios()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('../menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Editar usuario</h3> 
            <div class="row">
                <div class="input-field col l4 s6 offset-l4 offset-s3">
                    <i class="material-icons prefix">account_circle</i>
                    <input placeholder="Usuario" id="usuario_edit" type="text" class="validate">
                    <label class="active" for="usuario_edit">Usuario</label>
                </div>
                <div class="input-field col l4 s6 offset-l4 offset-s3">
                    <i class="material-icons prefix">vpn_key</i>
                    <input placeholder="Contrasena" id="pass_edit" type="password" class="validate">
                    <label class="active" for="pass_edit">Contraseña</label>
                </div>
                <div class="col ">
                    <a class="btn-floating btn-small waves-effect waves-light blue" onClick="mostrarPassEditCorreo()"><i class="material-icons">remove_red_eye</i></a>
                </div>
                <div class="input-field col l4 s6 offset-l4 offset-s3">
                    <i class="material-icons prefix">vpn_key</i>
                    <input placeholder="Contrasena" id="pass_edit2" type="password" class="validate">
                    <label class="active" for="pass_edit">Contraseña</label>
                </div>
                <div class=" col l4 s6 offset-l6 offset-s6">
                    <a class="btn-floating btn-large waves-effect waves-light indigo darken-4" id="btnAceptarEdit"><i class="material-icons">check</i></a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/bancaprepa.js"></script>
        <script type="text/javascript" src="../js/js.cookie.js"></script>
        <script type="text/javascript" src="../js/fondoAhorro.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 
    </body>
</html>