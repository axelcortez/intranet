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
    <body onLoad="cargarStock()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div> 
        <h4 class="header " align="center" style="color:#1a237e;">Articulos en venta </h4>
        <hr>

        <div id="Stock" class="container">
              
                    
            
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

            $("#aceptarSolicitud").click(function() { 
                var articulo_id = $('#txtIdSolicitar').val();  
                var capturista_id =$('#txtIdSolicitar').val();   
                var comentario =$("#txtSolicitud").val();      
                var quincenas =$("#txtQuincenasSolicitadas").val();

                if(comentario.length<3){
                        M.toast({html: 'Es nesesario agregar una nota.', classes: 'rounded red'})
                    return;
                }

                inventarios({opcion:24,articulo_id:articulo_id},respValidarQuincenas);


             });

        });
        //funciones
        function cargarStock(){
            inventarios({ opcion : 14 }, respStock); 
            onRequest({ opcion : 70 }, respcargasucursales); 
            inventarios({ opcion : 22}, respInboxPendientes);
            inventarios({ opcion : 23}, respMensajes);
        }

        function verImg(id){
            inventarios({ opcion : 15,id:id }, respGalery); 
        }

        function solicitarArticulo(id){
            console.log(id);

            $("#txtIdSolicitar").val(id);


            inventarios({ opcion : 16,id:id }, respPreviewSolicitud); 
        }

        function soloNumeros(e){

          var key = window.Event ? e.which : e.keyCode

          return ((key >= 48 && key <= 57) || (key==8))

        }
        //respuestas
        var respStock = function(data) { 
            if (!data && data == null)
                return;  
            
              var documento='';
              var datanew='';
    
                for(var i=0; i<data.length; i++){

                    if(data[i].antiguedad<8){
                        datanew='<div class="col s2 l2 left-align">'+
                                                    '<b><span class="new badge green lighten-1"></span></b>'+
                                                '</div>';
                    }
                    else{
                        datanew='';
                    }
                    documento+='<div class="row z-depth-2">'+
                                    '<div class="col l3  " > '+
                                    '<a onclick="verImg('+data[i].id+')" href="#modalImagenes" class="modal-trigger"><img src="../imagenes/stock/'+data[i].imagen+'" class="imgstock"></a>'+
                                    '</div>'+
                                    '<div class="col l8  " >'+
                                        '<div class="minicont">'+
                                            '<div class="row">'+
                                                '<div class="col s10 l10 left-align">'+
                                                    '<div class="col s6">'+
                                                        '<h5 id="txtTipo">'+data[i].tipo+'</h5>'+
                                                    '</div> '+
                                               '</div>'+datanew
                                                +
                                                '<div class="col s12 l12 grey-text">'+
                                                    '<div class="col s6 l6" id="txtDescripcion">'+
                                                        ''+data[i].descripcion+''+
                                                    '</div>'+
                                               '</div>'+
                                                '<div class="col s12 l12 ">'+
                                                    '<div class="col s6 l6 " id="txtPrecio"> <spam class="strikethrough"> <b> $'+data[i].precio_real+'</spam></b></div>'+
                                                    '<div class="col s6 l6 ">'+
                                                        '<a onclick="solicitarArticulo('+data[i].id+')" class=" modal-trigger waves-effect waves-light btn right blue" href="#modalSolicitar"><i class="material-icons right">add_shopping_cart</i>'+'Solicitar</a>'+
                                                    '</div>'+
                                                '</div>'+ 
                                                '<div class="col s12 l12">'+
                                                   '<div class="col s6 l6 " id="txtQuincenas">'+
                                                       '<b>Ahora:  <spam class="deep-orange-text"> $'+data[i].precio+'</spam></b>'+
                                                  
                                                       ' a <b>'+data[i].quincenas+' qna.</b>'+
                                                   '</div> '+
                                                '</div>'+
                                            '</div> '+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                }               
                
                $('#Stock').html(documento);  

            
        }

        var respGalery = function(data) { 
            if (!data && data == null)
                return;  

            console.log(data)
            
              var documento='<div class="carousel carousel-slider">';
    
                for(var i=0; i<data.length; i++){
                    documento +='<a class="carousel-item" href="#'+data[i].imagen+'!"><img  src="../imagenes/stock/'+data[i].imagen+'"></a>';
                    
                }               
                
                $('#divGaleria').html('</div>'+documento);  
                $('.carousel.carousel-slider').carousel({
                        fullWidth: true
                      });
                $('.materialboxed').materialbox();

            
        }


         var respPreviewSolicitud = function(data) { 
            if (!data && data == null)
                return;  
            
              var documento='';
              var datanew='';
    
                for(var i=0; i<data.length; i++){

                    if(data[i].antiguedad<8){
                        datanew='<div class="col s2 l2 left-align">'+
                                                    '<b><span class="new badge green lighten-1"></span></b>'+
                                                '</div>';
                    }
                    else{
                        datanew='';
                    }
                    documento+='<div class="row z-depth-2">'+
                                    '<div class="col l4  " > '+
                                    '<a onclick="verImg('+data[i].id+')" href="#modalImagenes" class="modal-trigger"><img src="../imagenes/stock/'+data[i].imagen+'" class="imgstock"></a>'+
                                    '</div>'+
                                    '<div class="col l8  " >'+
                                        '<div class="minicont">'+
                                            '<div class="row">'+
                                                '<div class="col s10 l10 left-align">'+
                                                    '<div class="col s6">'+
                                                        '<h5 id="txtTipo">'+data[i].tipo+'</h5>'+
                                                    '</div> '+
                                               '</div>'+datanew
                                                +
                                                '<div class="col s12 l12 grey-text">'+
                                                    '<div class="col s12 l6" id="txtDescripcion">'+
                                                        ''+data[i].descripcion+''+
                                                    '</div>'+
                                               '</div>'+
                                                '<div class="col s12 l12 ">'+
                                                    '<div class="col s12 l6 " id="txtPrecio"> <spam class="strikethrough"> <b> $'+data[i].precio_real+'</spam></b></div>'+
                                                    '<div class="col s6 l6 ">'+
                                                    '</div>'+
                                                '</div>'+ 
                                                '<div class="col s12 l12">'+
                                                   '<div class="col s12 l6 " id="txtQuincenas">'+
                                                       '<b>Ahora:  <spam class="deep-orange-text"> $'+data[i].precio+'</spam></b>'+
                                                  
                                                       ' a <b>'+data[i].quincenas+' qna.</b>'+
                                                   '</div> '+
                                                '</div>'+
                                            '</div> '+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                }               
                
                $('#vistaSolicitud').html(documento);  

            
        }

         var respGuardarSolicitud = function(data) { 
            if (!data && data == null)
                return;  

            if(data[0].respuesta==2){
                 M.toast({html: 'Se genero correctamente la solicitud.', classes: 'rounded green'});
                 $("#txtSolicitud").val(""); 
                 $("#txtQuincenasSolicitadas").val("");  

            }else{
                 M.toast({html: 'Ocurrio un error al intentar guardar los datos.', classes: 'rounded red'})
            }

            $("#modalSolicitar").modal('close');
            
        }

         var respValidarQuincenas = function(data) { 
            if (!data && data == null)
                return;  

            console.log(data)
            var articulo_id = $('#txtIdSolicitar').val();  
            var capturista_id =$('#txtIdSolicitar').val();   
            var comentario =$("#txtSolicitud").val();      
            var quincenas =$("#txtQuincenasSolicitadas").val(); 

            if(data[0].precio<=6000){

                if (quincenas<=10) {
                    inventarios({ opcion : 17 ,articulo_id:articulo_id,capturista_id:capturista_id,comentario:comentario,quincenas:quincenas}, respGuardarSolicitud);
                }
                else{
                      M.toast({html: 'Este articulo solo puede tener hasta 10 quincenas', classes: 'rounded red'})
                }
                 
                

            }else{

                 if (quincenas<=14) {
                    inventarios({ opcion : 17 ,articulo_id:articulo_id,capturista_id:capturista_id,comentario:comentario,quincenas:quincenas}, respGuardarSolicitud);
                }
                else{
                      M.toast({html: 'Este articulo solo puede tener hasta 14 quincenas', classes: 'rounded red'})
                }
                
            }

          
            
        }

    </script> 

    
 
    </body>
</html>