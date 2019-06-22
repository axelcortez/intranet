<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Catalogo de correos BANCAPREPA</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
</head>

    <body onLoad="cargarCorreos()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
     <div class="nav-wrapper">
            <div class="row">
                <div class="nav-wrapper">
                    <?php
                        include('../menu/menu.php');
                    ?> 
                    <h4 class="header " style="color:#1a237e;">Catalogo Correos Bancaprepa</h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col s12">      
            <nav>
                <div class="nav-wrapper">
                    <div class="input-field indigo darken-4" >
                        <input id="busquedaCorreos" type="search" required>
                        <label class="label-icon" for="search"><i class="material-icons ">search</i></label>
                        <i class="material-icons">close</i>
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light teal btn modal-trigger" href="#modalAgregarCorreos">
                         <i class="material-icons blue darken-3">add</i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div id="content">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col s12"><!-- CONTENEDOR 2 -->
                                    <table class="highlight">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Sucursal</th>
                                            <th>Correo</th>
                                            <th id="password" style='display:none;'>Pass</th>
                                            <th>Entregado</th>
                                            <th id="accionesC" style='display:none;'>Acciones</th>
                                            
                                        </tr>
                                        </thead>

                                        <tbody id="tablaCorreos">
                                           
                                        </tbody>
                                    </table>
                                </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
                </div>
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
    <!-------------------- Modal para agregar Correos-------------------------->
    <div id="modalAgregarCorreos" class="modal">
           <nav class="blue darken-3">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">add_circle</i>Agregar Correo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                           <input placeholder="Id" id="idEmpleadoCorreo" type="text" class="validate">
                           <label for="Id:" class="activate"></label>
                       </div>
                       <div class="input field col s6">
                           <input placeholder="Nombre" id="nombreEmpleadoCorreo" type="text" class="validate">
                           <label for="Nombre:" class="activate"></label>
                       </div>
                       <div class="input field col s6">
                           <input placeholder="Correo" id="correoEmpleado" type="text" class="validate" >
                           <label for="Correo:" class="activate"></label>
                       </div>
                       <div class="input field col s6">
                           <input placeholder="Contraseña" id="passEmpleado" type="password" class="validate" >
                           <label for="Contraseña:" class="activate"></label>
                       </div>
                       <div id="dominioDD" align="left" class="input-field col s3">
                            <select>
                                <option value="" disabled selected>Seleccione su dominio</option>
                                <option value="bancaprepa">bancaprepa</option>
                                <option value="valeamigo">valeamigo</option>
                                <option value="prestamoslacasita">prestamoslacasita</option>
                                <option value="presico">presico</option>
                            </select>
                            <label>Dominio</label>
                        </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="BtnAgregarCorreo" class="waves-effect waves-light btn blue darken-3 right"><i class="material-icons left">add_circle_outline</i>Agregar</a>
           </div>
    </div>
    <!----------------------------- Modal para editar correos ---------------------------------->
    <div id="modalEditarCorreo" class="modal">
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">edit</i>Editar Correos
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                       <div class="input field col s12">
                             <div class="input field col s2">
                                <input placeholder="ID" id="idCorreoEdit" type="text" class="validate" disabled>
                                <label for="Id" class="activate" ></label>
                            </div>
                            <div class="input field col s8">
                                <input placeholder="Nombre" id="editNomCorreo" type="text" class="validate" disabled>
                                <label for="Nombre" class="activate"></label>
                            </div>
                            <div class="input field col s4">
                                <input placeholder="Correo" id="editCorreo" type="text" class="validate">
                                <label for="Correo" class="activate"></label>
                            </div>
                            <div class="input field col s4">
                                <input placeholder="Contraseña" id="editPass" type="password" class="validate">
                                <label for="Contraseña" class="activate"></label>
                            </div>
                            <div class="col s4">
                                <p><label><input type="checkbox" id="cbEntregado"/><span>Entregado</span></label></p>
                            </div>
                        </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="BtnEditarCorreo" class="waves-effect waves-light btn blue right"><i class="material-icons left">edit</i>Aceptar</a>
           </div>
    </div>
    
    <!----------------------------- Modal para eliminar tipo de documentos ---------------------------------->
    <div id="modalEliminarCorreo" class="modal">
           <nav class="red accent-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">delete</i>Eliminar Correo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                            <input placeholder="ID" id="idBorrarCorreo" type="text" class="validate" disabled>
                            <label for="Id" class="activate" ></label>
                       </div>
                       <div class="input field col s8">
                           <input placeholder="Nombre" id="nomBorrarcorreo" type="text" class="validate" disabled>
                           <label for="Nombre" class="activate"></label>
                       </div>
                       <div class="input field col s8">
                           <input placeholder="Correo" id="correoBorrar" type="text" class="validate" disabled>
                           <label for="Correo" class="activate"></label>
                       </div>          
                   </div>
               </form>
               <h6><strong>¿Seguro que quiere eliminar este correo?</strong></h6>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnBorrarCorreo" class="waves-effect waves-light btn red accent-4 right"><i class="material-icons left">delete</i>Eliminar</a>
           </div>
    </div>
     <!-------------------- Inicializar modal-------------------------->
    <script>
            $(document).ready(function(){
                 $('.modal').modal();
            });
    </script>
                
    </body>
</html>