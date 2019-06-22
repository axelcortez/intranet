<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Tipos de documentos</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
</head>
<link rel="icon" type="image/png" href="../img/favicon.ico" /> 
    <body onLoad="cargarDoc()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
     <div class="nav-wrapper">
            <div class="row">
                <div class="nav-wrapper">
                    <?php
                        include('../menu/menu.php');
                    ?> 
                    <h4 class="header " style="color:#1a237e;">Catalogo de Tipo de Documentos</h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col s12">      
            <nav>
                <div class="nav-wrapper">
                    <div class="input-field indigo darken-4" >
                        <input id="busquedaDoc" type="search" required>
                        <label class="label-icon" for="search"><i class="material-icons ">search</i></label>
                        <i class="material-icons">close</i>
                        <a class="btn-floating btn-large halfway-fab waves-effect waves-light teal btn modal-trigger" href="#modalAgregarDoc">
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
                                            <th>ID</th>
                                            <th>Descripción</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>

                                        <tbody id="tabladoc">
                                           
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
    <!-------------------- Modal para agregar tipo de documentos-------------------------->
    <div id="modalAgregarDoc" class="modal">
           <nav class="blue darken-3">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">add_circle</i>Agregar tipo de documento
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                       <div class="input field col s12">
                           <input placeholder="Nombre documento" id="nomdoc" type="text" class="validate">
                           <label for="Nombre documento" class="activate"></label>
                       </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="BtnAgregarDoc"class="waves-effect waves-light btn blue darken-3 right"><i class="material-icons left">add_circle_outline</i>Agregar</a>
           </div>
    </div>
    <!----------------------------- Modal para editar tipo de documentos ---------------------------------->
    <div id="modalEditarDoc" class="modal">
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">edit</i>Editar Tipo de documento
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                       <div class="input field col s12">
                             <div class="input field col s2">
                                <input placeholder="ID" id="idDocEdit" type="text" class="validate" disabled>
                                <label for="Id" class="activate" ></label>
                            </div>
                            <div class="input field col s8">
                                <input placeholder="Tipo de documento" id="editNomDoc" type="text" class="validate">
                                <label for="Tipo de documento" class="activate"></label>
                            </div>
                        </div>
                   </div>
               </form>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="BtnEditarDoc" class="waves-effect waves-light btn blue right"><i class="material-icons left">edit</i>Aceptar</a>
           </div>
    </div>
    <!----------------------------- Modal para deshabilitar tipo de documentos ---------------------------------->
    <div id="modalDeshabDoc" class="modal">
           <nav class="orange darken-3">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">do_not_disturb_alt</i>Deshabilitar Documento
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                       <div class="input field col s2">
                            <input placeholder="ID" id="idDocDes" type="text" class="validate" disabled>
                            <label for="Id" class="activate" ></label>
                       </div>
                       <div class="input field col s8">
                           <input placeholder="Tipo de Documento" id="nomDocDes" type="text" class="validate" disabled>
                           <label for="Tipo de Documento" class="activate"></label>
                       </div>     
                   </div>
               </form>
               <h6><strong>¿Seguro que quiere deshabilitar este Documento?</strong></h6>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnDesDoc" class="waves-effect waves-light btn orange darken-3 right"><i class="material-icons left">do_not_disturb_alt</i>Deshabilitar</a>
           </div>
    </div>
    <!----------------------------- Modal para eliminar tipo de documentos ---------------------------------->
    <div id="modalEliminarDoc" class="modal">
           <nav class="red accent-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">delete</i>Eliminar Tipo de Documento
                   </a>
               </div>
           </nav>
           <div class="modal-content">
               <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                            <input placeholder="ID" id="idDocEli" type="text" class="validate" disabled>
                            <label for="Id" class="activate" ></label>
                       </div>
                       <div class="input field col s8">
                           <input placeholder="Tipo de Documento" id="nomDocEli" type="text" class="validate" disabled>
                           <label for="Tipo de Documento" class="activate"></label>
                       </div>     
                   </div>
               </form>
               <h6><strong>¿Seguro que quiere eliminar este Documento?</strong></h6>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnEliDoc" class="waves-effect waves-light btn red accent-4 right"><i class="material-icons left">delete</i>Eliminar</a>
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