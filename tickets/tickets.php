<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Tickets</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
</head>

    <body onLoad="cargarTickets()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
            <div class="row">
                <div class="nav-wrapper">
                    <?php
                        include('../menu/menu.php');
                    ?> 
                    <h4 class="header center-align" style="color:#1a237e;">Tickets</h4>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l3 offset-l4 offset-s2 ">
                <select id="selectEstatus">
                   
                </select>
                <label>Estatus:</label>
            </div>
            <div class="col l2">
                <a id="buscarXestatus" class="waves-effect waves-light btn-small indigo darken-4">Buscar</a>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l10 offset-l1">
                <div class="card">
                    <div class="card-content">
                        <div id="content">
                            <table class="highlight responsive-table"  style="font-size:9px; font-weight:bold; color:#1a237e;">
                                <thead style="font-size:13px; font-weight:bold;" >
                                <tr>
                                    <th>Id</th>
                                    <th>Titulo</th>
                                    <th>Solicitado por:</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Atendiendo:</th>
                                    <th>Estatus</th> 
                                    <th>Acciones</th>                                            
                                </tr>
                                </thead>

                                <tbody id="tablaTicketsTodos">
                                    
                                </tbody>
                            </table>          
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

     
     <div id="modalAdminTicket" class="modal">
           <nav class="indigo darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">comment</i>Comentarios Ticket
                   </a>
               </div>
           </nav>
           <div class="modal-content">
            Descripción
            <div class="card">
            <div  class="card-content" id="descripcionTicketAdm">
           
            </div>
           </div>
           <br><br>
           Comentarios
           <div class="card">
            <div  class="card-content" id="cardTicketAdm">
           
            </div>
           </div>
               <form class="col s12 no-padding">
               <div class="input-field col s6">
               <a id="ActualizarMensajesManTicket" class="waves-effect waves-light btn-floating btn-small indigo darken-4 left"><i class="material-icons">autorenew</i></a> <br> <br>
                        Comentario:
                        <textarea id="comentarioTicketAdm"></textarea> 
                        <br>
                        <a id="btnActualizarEstatusticket" class="waves-effect waves-light btn indigo darken-4 left"><i class="material-icons left">thumb_up</i>Finalizar</a> 
                        <a id="btnComentarioTicketAdm" class="waves-effect waves-light btn indigo darken-4 right"><i class="material-icons left">send</i>enviar</a> 
               </div>
               </form>
              
               <div class="s2">
                  <!--  <a id="btnComentarioTicket" class="waves-effect waves-light btn blue right"><i class="material-icons left">delete</i>Aceptar</a> -->
                </div>
           </div>
           <div class="modal-footer">
               <a class= " modal-action modal-close waves-effect waves-green btn-flat right">Cerrar</a>
           </div>
    </div>
    
     
    <div id="modalAceptarFinalizacionADM" class="modal" >
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
                        <a id="btnAceptarfinalizacionAdm" class="waves-effect waves-light btn indigo darken-4 left"><i class="material-icons left">thumb_up</i>Si</a> 
                        
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
   
     <!-------------------- Inicializar modal-------------------------->
    <script>
            $(document).ready(function(){
                 $('.modal').modal();
            });
    </script>
                
    </body>
</html>