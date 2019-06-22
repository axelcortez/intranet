<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Captura Inventario</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarSolicitudes()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div> 
        <h4 class="header " align="center" style="color:#1a237e;">Gestion de Solcitudes de Articulos</h4>
        <hr> 

        <div class="container-fluid" class="revelate">
             <table>
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Solicitante</th>
                      <th>Sucursal</th>
                      <th>Articulo</th>
                      <th>Costo</th>
                      <th>Estatus</th>
                      <th>Fecha</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody id="solicitudesArticulos"> 
                </tbody>
              </table>
        </div>


    </div><!-- CONTENEDOR 1 -->

    <?php
                include('modals.php');
            ?>


    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/equipo.js"></script>
    <script type="text/javascript" src="../js/inventarios.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();

             

        });
        //funciones
        function cargarSolicitudes(){
            inventarios({ opcion : 18 }, respSolicitudes); 
           onRequest({ opcion : 70 }, respcargasucursales); 
           inventarios({ opcion : 22}, respInboxPendientes);
        }

        function verDetallesSolcitud(id){
            //console.log(id)
            inventarios({ opcion : 19,solicitud_id:id }, respDetalleSolicitud); 

        }
        function aprobarSolicitud(id){
            inventarios({ opcion : 20,solicitud_id:id }, respAutorizarSolicitud); 
        }

        function cancelarSolicitud(id){
              //      console.log(id)
        }

        function calcularPago(event){
            var pagoQuincenal=0;
             if ( event.which == 13 ) {
                       var precio = $("#txtPrecio").val(); 
                       var quincenas = $("#txtQuincenasAutorizar").val();
                       
                if (quincenas<1) {
                        M.toast({html: 'Es necesario espesificar las quincenas!!.', classes: 'rounded red'}); 
                         return;

                } 
                    pagoQuincenal=precio/quincenas;
                    $("#txtPagoQuincenal").val(Math.round(pagoQuincenal));

               }
             if (event.which ==127){
                $("#txtPagoQuincenal").val("0");
             }
        }

        function autorizarSolicitudArticulo(){


            var solicitud_id = $("#txtIdSolcitudAtutorizar").val();
            var nota =$("#txtNotaAutorizacion").val(); 
            var quincenas =$("#txtQuincenasAutorizar").val();
            var pagoQuincenal =$("#txtPagoQuincenal").val();
            var monto =$("#txtPrecio").val();  


            if(quincenas<1 || quincenas==''){
              M.toast({html: 'Es necesario espesificar las quincenas!!.', classes: 'rounded red'}); 
              $("#txtPagoQuincenal").val("");
              return;
            }
            if(pagoQuincenal<1 || pagoQuincenal==''){
                 M.toast({html: 'El pago quincenal no se a confirmado!!.', classes: 'rounded orange'}); 
              return;
            }

            inventarios({ opcion : 21,solicitud_id:solicitud_id,nota:nota,quincenas:quincenas,pagoQuincenal:pagoQuincenal,monto:monto}, respAutorizarCargo); 

        }


       
        //respuestas
        var respSolicitudes = function(data) { 
            if (!data && data == null)
                return;  
            
              var documento='';
              var datanew='';
              var activo='';
    
                for(var i=0; i<data.length; i++){

                    if (data[i].estatus_id!=5) {
                        activo='disabled';
                    }
                    else{
                        activo='';
                    }

                    documento+="<tr>"+
                                "<td>"+data[i].id+"</td>"+
                                "<td>"+data[i].solicitante+"</td>"+
                                "<td>"+data[i].sucursal+"</td>"+
                                "<td>"+data[i].articulo+"</td>"+
                                "<td>"+data[i].costo+"</td>"+
                                "<td>"+data[i].estatus+"</td>"+
                                "<td>"+data[i].fecha+"</td>"+
                                "<td><a onclick='verDetallesSolcitud("+data[i].solicitud_id+")' class='btn-floating tooltipped waves-light modal-trigger' href='#modalDetallesArticulo' data-position='bottom' data-tooltip='Ver Detalle'><i class='material-icons'>assignment</i></a> <a onclick='aprobarSolicitud("+data[i].solicitud_id+")' href='#modalAprobarSolicitud'  class='"+activo+" btn-floating modal-trigger tooltipped green waves-light' data-position='bottom' data-tooltip='Aceptar'><i class='material-icons'>assignment_turned_in</i></a> <a onclick='cancelarSolicitud("+data[i].solicitud_id+")' class='btn-floating tooltipped red waves-light "+activo+"' data-position='bottom' data-tooltip='Cancelar'><i class='material-icons'>cancel</i></a>";
 
                }               
                
                $('#solicitudesArticulos').html(documento);
                $('.tooltipped').tooltip();
            
        }

        var respDetalleSolicitud = function(data) { 
            if (!data && data == null)
                return;  
            
              $("#txtSolicitanteId").val(data[0].empleado_id);
              $("#txtSolicitante").val(data[0].empleado);
              $("#txtComentario").val(data[0].comentario);
              $("#txtAntiguedad").val(data[0].antiguedad);

        }

          var respAutorizarSolicitud = function(data) { 
            if (!data && data == null)
                return;  

            
              $("#txtIdAutorizado").val(data[0].empleado_id);
              $("#txtNombreSolicitante").val(data[0].empleado);
              $("#txtIdSolcitudAtutorizar").val(data[0].solicitud_id);
              $("#txtPrecioReal").val(data[0].precio);
              $("#txtPrecio").val(data[0].p_descuento);  
              $("#txtQuincenasAutorizar").val(data[0].quincenas);
              $("#txtPagoQuincenal").val(data[0].pagoQuincenal); 
        }

        var respAutorizarCargo = function(data){
            if (!data && data==null)
                return;

            console.log(data)

            if (data[0].respuesta==2) {
                M.toast({html: 'Se a autorizado la solicitud.', classes: 'rounded green'}); 
                 $("#modalAprobarSolicitud").modal('close');
                
            }
            else{
                M.toast({html: 'A ocurrido un problema favor de intentarlo nuevamente o contactar con un administrador.', classes: 'rounded red'}); 
                
            }


           

            inventarios({ opcion : 18 }, respSolicitudes); 
        }
        

    </script> 

    
 
    </body>
</html>