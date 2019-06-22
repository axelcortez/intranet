<!DOCTYPE html>
<html lang="en" >


   
<head>
    
        <meta charset="UTF-8">  
        <title>Mandar Ticket</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
        
</head>
<link rel="icon" type="image/png" href="../img/favicon.ico" /> 
    <body onLoad="cargarTicketsPorUsuario()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
    
        <h4 class="header " align="center" style="color:#1a237e;">Crear Ticket</h4>
        <div class="row">
            <div class="col l10 s12 offset-l1 right-align">
                <a class="waves-effect waves-light btn-small indigo darken-3 btn modal-trigger"  href="#modalCrearTicket"><i class="material-icons left">add_circle_outline</i>Crear Ticket</a>
            </div>
        </div>
        <div class="row center-align">
        <div class="col s12 l10 offset-l1">
        <div class="card">
            <div class="card-content">
                <div id="content">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col l12 s12"><!-- CONTENEDOR 2 -->
                                    <table class="highlight responsive-table" style="font-size:9px; font-weight:bold; font-family:Verdana; color:#1a237e;">
                                        <thead style="font-size:13px; font-weight:bold;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Titulo</th>
                                            <th>Fecha</th>
                                            <th>Solicitado por:</th>
                                            <th>Atiende</th> 
                                            <th>Estatus</th>    
                                            <th>Acciones</th>                                            
                                        </tr>
                                        </thead>

                                        <tbody id="tablaTicketsGeneral">
                                           
                                        </tbody>
                                    </table>
                                </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
                </div>
            </div>
        </div>
        </div>
        </div>

             
            
            
    
    </div>

    
    <div id="modalCrearTicket" class="modal">
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">comment</i>Comentarios Ticket
                   </a>
               </div>
           </nav>
           
           <div class="modal-content">
                <div class="row">
                    <div class="input-field col l5 s12 m6 offset-l1">
                        <i class="material-icons prefix">chrome_reader_mode</i>
                        <input id="tituloTicket" type="text" class="validate">
                        <label for="tituloTicket">Titulo</label>
                    </div>
                    <div class="input-field col l5 s12 m6">
                        <i class="material-icons prefix">business</i>
                        <select id="tituloDD">
                            <option value="0" disabled>Departamento</option>
                            <option value="1" selected>Sistemas</option>
                            <!--<option value="2">Crédito</option>
                            <option value="3">Cartera</option>
                            <option value="4">Call Center</option>-->
                        </select>
                        <label>Departamento:</label>
                    </div>
                    <div class="input-field col s12 l5 offset-l1">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate">
                            <label for="email">Email para contacto</label>
                        </div>
                        <div class="input-field col s12 l5">
                            <i class="material-icons prefix">phone</i>
                            <input id="tel" type="tel" class="validate">
                            <label for="tel">Telefono para contacto</label>
                        </div> 
                </div>
                <div class="row">
                    <div class="input-field col s12 l10 offset-l1">                            
                        <textarea id="descripcionTicket"></textarea>                            
                    </div>
                    <div class="col s12" align="center">
                        <a id="CrearTicketbtn" class="waves-effect btn blue darken-4"><i class="material-icons left">add</i>Crear Ticket</a>
                    </div>
                </div>
           </div>
           <div class="modal-footer">
               <a  class= " modal-action modal-close waves-effect waves-green btn-flat right">Cerrar</a>
           </div>
    </div>

    <div id="modalComentariosTicket" class="modal" >
           <nav class="blue">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">comment</i>Comentarios Ticket
                   </a>
               </div>
           </nav>
           
           <div class="modal-content">

           <p>Descripcion Ticket</p>
           <div class="card " style="font-size:10px; font-family:Verdana; ">
            <div class="card-content" id="cardDescTicket">
               
            </div>
           </div>
           <p>Conversación</p>
           <div class="card" style="font-size:10px; font-family:Verdana; ">
            <div class="card-content" id="cardTicketAdm">
              
            </div>
           </div>
               <form class="col s12 ">
               <div class="input-field col s6">
               <a id="ActualizarMensajesManTicket" class="waves-effect waves-light btn-floating btn-small indigo darken-4 left"><i class="material-icons">autorenew</i></a> <br> <br>
                        Comentario:
                        <textarea id="comentarioTicket"></textarea> 
                        <br> 
               </div>
               <div class="col l12 s12">
                    <a id="btnActualizarEstatusticketUsu" class="waves-effect waves-light btn indigo darken-4 left"><i class="material-icons left">thumb_up</i>Finalizar</a> 
                    
                    <a id="btnComentarioTicket" class="waves-effect waves-light btn blue right"><i class="material-icons left">send</i>enviar</a>
               </div>
               </form>
              <br>
              <br>
           <div class="modal-footer col">
               <a  class= " modal-action modal-close waves-effect waves-green btn-flat right">Cerrar</a>
           </div>
    </div>

    
    <div id="modalAceptarFinalizacion" class="modal" >
           <nav class="red darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">block</i>Finalizar ticket
                   </a>
               </div>
           </nav>
           
           <div class="modal-content">
                <h5>¿Seguro que desea finalizar el ticket?</h5>
                <div class="row">
                    <div class="col s12 l12">
                        <a id="btnAceptarfinalizacion" class="waves-effect waves-light btn indigo darken-4 left"><i class="material-icons left">thumb_up</i>Si</a> 
                        
                        <a class="modal-action modal-close waves-effect waves-light btn indigo darken-4 right"><i class="material-icons left">thumb_down</i>No</a>
                    </div>
                </div>
           </div>

    </div>

    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/tickets.js"></script>
    <script type="text/javascript" src="../js/textboxio/textboxio.js"></script> 
    
    
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();

           
        });

      
    </script> 

    
 
    </body>
</html>