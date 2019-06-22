<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Usuarios</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
</head>

    <body onLoad="cargarUsuariosT()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
            <div class="row">
                <div class="nav-wrapper">
                <?php
                 include('../menu/menu.php');
                 ?> 
                
                    <h4 class="header " style="color:#1a237e;">Usuarios</h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="row">
                    <div class="input field col s1">
                            <label for="Id" class="activate" '></label>
                            <input placeholder="Id" id="IdEmpleadoCor" type="text" class="validate" style='display:none;' >
                    </div>
                    <div class="input-field col s6 offset-s2">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input id="nombreAbuscarCor" type="text" class="validate" placeholder="Nombre" onkeyup="buscaEmpleadosCor()"/>
                                    <label for="nombreAbuscarCor">Nombre</label>
                    </div>
                    
                </div>
                <div class="row">
                     <div class="input field col s1">
                            <label for="Id" class="activate" '></label>
                            <input placeholder="Id" id="idficticio" type="text" class="validate" style='display:none;' >
                    </div>
                     <div class="input field col s6 offset-s2" id="listaEmpleadosBC">
                                    <table class="highlight">
                                                    <tbody id="listaEmpleadosTablaBC">
                                                    
                                                    </tbody>
                                    </table>
                        </div>
                
                    <div class="col s12" align="center">
                            <a id="btnLimpiar" class="waves-effect btn blue darken-4"><i class="material-icons left">brush</i>Limpiar</a>
                            <a id="btnBusquedaUsuario" class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Buscar</a>
                    </div>  
                </div>
            </div>
            <div class="input-field indigo darken-4" >
                
                <a id="AgregaUsuariosBtnFlotante" class="btn-floating btn-large halfway-fab waves-effect waves-light teal btn modal-trigger right" href="#modalAgregarUsuarios" >
                    <i class="material-icons blue darken-3">add</i>
                </a>
            </div>
          
        <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div id="content">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col s12"><!-- CONTENEDOR 2 -->
                                    <table class="highlight responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Sucursal</th>
                                            <th>Usuario</th>
                                            <th>Pass</th>
                                            <th>Entregado</th>
                                            <th>Estatus</th>
                                        </tr>
                                        </thead>

                                        <tbody id="tablaUsuarios">
                                           
                                        </tbody>
                                    </table>
                                </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
                </div>
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



     <div id="modalAgregarUsuarios" class="modal">
           <nav class="blue darken-3">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">add_circle</i>Agregar Usuarios Intranet
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                           <input placeholder="Id" id="idEmpleadoCorreo" type="text" class="validate" disabled>
                           <label for="Id:" class="activate"></label>
                       </div>
                       <div class="input field col s6">
                           <input placeholder="Nombre" id="nombreEmpleadoCorreo" type="text" class="validate" onkeyup="buscaEmpleadosUsuarios()">
                           <label for="Nombre" class="activate"></label>
                       </div>
                    </div>
                    <div class="row">
                       <div class="input field col s2">
                            <label for="Id" class="activate" '></label>
                            <input placeholder="Id" id="idficticio2" type="text" class="validate" style='display:none;' >
                        </div>
                        <div class="input field col s6 " id="listaEmpleadosADD">
                                    <table class="highlight">
                                                    <tbody id="listaEmpleadosTablaADD">
                                                    
                                                    </tbody>
                                    </table>
                        </div>
                    </div>
                    <div class="row">
                       <div class="input field col s6">
                           <input placeholder="Usuario" id="UsuarioEmpleado" type="text" class="validate" >
                           <label for="Usuario" class="activate"></label>
                       </div>
                       <div class="input field col s6">
                           <input placeholder="Contraseña" id="passEmpleado" type="password" class="validate" ><a onClick="mostrarPassAgregarcorreo()" class="waves-effect waves-light btn-floating btn-small blue btn right" >
                                    <i class="material-icons right">remove_red_eye</i></a>
                           <label for="Contraseña:" class="activate"></label>
                       </div>
                       
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="BtnAgregarUsuario" class="waves-effect waves-light btn blue darken-3 right"><i class="material-icons left">add_circle_outline</i>Agregar</a>
              
           </div>
    </div>            
    </body>
</html>