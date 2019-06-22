<!DOCTYPE html>
<html lang="en" >


   
<head>
    
        <meta charset="UTF-8">  
        <title>Mantenimiento de publicaciones</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarMantPub()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
            
        </div>
    
            <?php
                include('menu/menu.php');
            ?>
            <h4 class="header " style="color:#1a237e;">Mantenimiento de publicaciones</h4>
                    <hr>

        <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div id="content">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col s12"><!-- CONTENEDOR 2 -->
                                    <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Titulo</th>
                                            <th>Tipo de documento</th>
                                            <th>Publicado por</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Estatus</th>     
                                            <th>Acciones</th>                                       
                                        </tr>
                                        </thead>

                                        <tbody id="tablaMttoPublicacion">
                                           
                                        </tbody>
                                    </table>
                                </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
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

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 


    <div id="modalVerDatosPub" class="modal">
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">remove_red_eye</i>Informacion sobre la publicación
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           
           <div class="card">
            <div class="card-content">
                <div id="content">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col s12"><!-- CONTENEDOR 2 -->
                                    <table class="highlight">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Sucursal</th>
                                            <th>Visto</th>
                                            <th>Fecha visto</th>
                                            <th>Hora visto</th>                                       
                                        </tr>
                                        </thead>

                                        <tbody id="tablaVistoPub">
                                           
                                        </tbody>
                                    </table>
                                </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
                </div>
            </div>
        </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="#!" class=" modal-action modal-close waves-effect waves-light btn blue right"><i class="material-icons left">playlist_add_check</i>Aceptar</a>
           </div>
    </div>

    
    <div id="modalEditarPub" class="modal">
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">edit</i>Editar publicación
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                            <input placeholder="Idpub" id="Idpub" type="text" class="validate" disabled>
                            <label for="Idpub" class="activate" ></label>
                        </div>
                       <div class="input field col s8">
                           <input placeholder="Titulo" id="tituloPub" type="text" class="validate">
                           <label for="Titulo" class="activate"></label>
                       </div>
                       <div class="input field col s12">
                          <!-- <input placeholder="Descripcion" id="descPubEdit" type="text" class="validate">  -->
                           <textarea  id="descPubEdit" class="materialize-textarea"></textarea>
                           <label for="descPubEdit">Descripcion</label>
                       </div>
                   </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnEditPub" class="waves-effect waves-light btn blue right"><i class="material-icons left">edit</i>Aceptar</a>
           </div>
    </div>
    

    <div id="modalBajaPub" class="modal">
            <nav class="orange darken-3">
                <div class="nav-wrapper">
                    <a href="#!" class="brand-logo">
                        <i class="large material-icons">edit</i>Editar publicación
                    </a>
                </div>
            </nav>
            <div class="modal-content">
            <form class="col s12 no-padding">
                    <div class="row">
                            <div class="input field col s2">
                                <input placeholder="IdpubB" id="IdpubBaja" type="text" class="validate" disabled>
                                <label for="IdpubB" class="activate" ></label>
                            </div>
                        <div class="input field col s8">
                            <input placeholder="TituloB" id="tituloPubBaja" type="text" class="validate" disabled>
                            <label for="TituloB" class="activate"></label>
                        </div>
                    </div>
                </form>         
            
            </div>
            <div class="modal-footer">
                <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
                <a id="btnDarBaja" class="waves-effect waves-light btn orange darken-3 right"><i class="material-icons left">do_not_disturb_alt</i>Aceptar</a>
            </div>
        </div>

    </body>
</html>