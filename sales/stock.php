<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Captura Inventario</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">  
         <link rel="stylesheet" href="../assets/css/styles.css" />
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="inicializarCombos()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper"><!-- MENU -->
           <?php
                include('../menu/menu.php');
            ?>
        </div> <!-- MENU -->
        <h4 class="header " align="center" style="color:#1a237e;">Registro Stock </h4>

        <div class="container-fluid"><!-- CONTENEDOR 2--> 
                  <div class="row"><!-- ROW 1-->
                    <div class="input-field col l1 s4">
                      <input id="txtIdPagoEspecie" class="black-text" type="text" placeholder=" " value="0" disabled>
                      <label class="black-text active" for="txtIdPagoEspecie"  >Id</label>
                    </div>

                    <div class="input-field col l2 s8">
                      <input id="txtFecha" type="date" placeholder=" ">
                      <label class="black-text active" for="txtFecha"  >Fecha</label>
                    </div>
                    <div class="input-field col l2 s12">
                      <input id="txtCoordinacion" type="text"  placeholder=" ">
                      <label class="black-text active" for="txtCoordinacion"  >Coordinacion</label>
                    </div>
                    <div class="input-field col l3 s12">
                      <select id="cboSucursal">
                          <option value="" disabled selected>Choose your option</option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                      </select>
                        <label class="black-text">Sucursal</label>
                    </div>
                    <div class="input-field col l1 s4">
                      <input id="txtIdDist" type="text" onKeyPress="return soloNumeros(event)"  placeholder="0">
                      <label class="black-text active" for="txtIdDist"  >Id</label>
                    </div>
                    <div class="input-field col l3 s8">
                      <input id="txtDistribuidora" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtDistribuidora"  >Distribuidora</label>
                    </div>
                  </div><!-- ROW 1-->
                  <div class="row"> <!-- ROW 2-->
                    <div class="input-field col l2 s4">
                      <input id="txtPago" type="text" onKeyPress="return soloNumeros(event)" placeholder=" ">
                      <label class="black-text active" for="txtPago"  >Pago en Especie</label>
                    </div>
                    <div class="input-field col l3 s8">
                      <select id="cboEquipo">
                          <option value="" disabled selected>Choose your option</option>
                          <option value="1">Option 1</option>
                          <option value="2">Option 2</option>
                          <option value="3">Option 3</option>
                      </select>
                        <label class="black-text">Tipo de Equipo</label>
                    </div> 
                    <div class="input-field col l4 s12">
                      <input id="txtDescripcion" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtDescripcion"  >Descripcion</label>
                    </div>
                     <div class="input-field col l3 s12">
                      <input id="txtMarca" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtMarca"  >Marca</label>
                    </div>

                  </div><!-- ROW 2-->
                  <div class="row"><!-- ROW 3-->
                   
                    <div class="input-field col l2 s12">
                      <input id="txtModelo" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtModelo"  >Modelo</label>
                    </div>
                    <div class="input-field col l2 s12">
                      <input id="txtSerie" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtSerie"  >Serie</label>
                    </div>
                    <div class="input-field col l3 s12">
                      <input id="txtUbicacion" type="text"   placeholder=" ">
                      <label class="black-text active" for="txtUbicacion"  >Ubicacion</label>
                    </div>                      
                  </div><!-- ROW 3--> 
                  <div class="row center">
                        <a class="waves-effect waves-light btn red" onclick="limpiarCampos()"><i class="material-icons left">clear</i>Cancelar</a>
                        <a class="waves-effect waves-light btn green" id="btnGuardarArticulo"><i class="material-icons right">check</i>Aceptar</a>
   
                  </div>

                  
        </div><!-- CONTENEDOR 2-->
        <div class="container-fluid">
            
                <div class="row">
                    <div class="col l12 s12  scroller3 " >
                        <hr>
                        <table class="highlight responsive-table">
                            <thead>
                               <tr>
                                  <th>#</th>
                                  <th>Dist id</th>
                                  <th>Distribuidora</th>
                                  <th>Articulo</th>
                                  <th>Sucursal</th> 
                                  <th>Detalle</th> 
                                  <th>Estatus</th>
                                  <th>Acciones</th> 
                              </tr>
                            </thead>

                            <tbody id="tbPagosEspecie"> 
                            </tbody>
                          </table>
                        <hr>
                    </div>
                    
                </div>
                 
                
                  
            </div>
    </div><!-- CONTENEDOR 1 -->

      <!-- Modal Structure -->  

         <?php
                include('modals.php');
            ?>
   
      

    



    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script> 
    <script type="text/javascript" src="../js/bancaprepa.js"></script> 
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/equipo.js"></script> 
 

   
  <script>
        $(document).ready(function(){

            // inicializamos componentes
            $('.sidenav').sidenav();
            
            $('select').formSelect();


            //eventos

             $("#btnGuardarArticulo").click(function() { 


                var txtIdPagoEspecie = $("#txtIdPagoEspecie").val();
                var txtFecha = $("#txtFecha").val();
                var txtCoordinacion =$("#txtCoordinacion").val().toUpperCase();
                var cboSucursal =$("#cboSucursal").val();
                var txtIdCoor =$("#txtIdDist").val();
                var txtDistribuidora =$("#txtDistribuidora").val().toUpperCase(); 
                var txtPago =$("#txtPago").val(); 
                var cboEquipo =$("#cboEquipo").val();
                var txtMarca =$("#txtMarca").val().toUpperCase();
                var txtModelo =$("#txtModelo").val().toUpperCase();
                var txtSerie =$("#txtSerie").val().toUpperCase();
                var txtDescripcion =$("#txtDescripcion").val().toUpperCase();
                var txtUbicacion =$("#txtUbicacion").val().toUpperCase(); 
 
                if(txtFecha==""){
                    M.toast({html: 'Es necesario ingresar la fecha.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtCoordinacion==""){
                    M.toast({html: 'Es necesario la coordinacion ala que pertenece.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtIdCoor<=0){
                    M.toast({html: 'Es necesario indicar el Id del distribuidora.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtDistribuidora==""){
                    M.toast({html: 'Es necesario indicar el nombre del distribuidora.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtDescripcion==""){
                    M.toast({html: 'Es necesario espesificar una descripcion.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtPago==""){
                    M.toast({html: 'Es necesario ingresar el pago en especie.', classes: 'rounded red'}); 
                    return;
                } 
                if(txtUbicacion==""){
                    M.toast({html: 'Es necesario espesificar la ubicacion actual.', classes: 'rounded red'}); 
                    return;
                } 
                if(cboSucursal<1){
                    M.toast({html: 'Seleccione una sucursal valida.', classes: 'rounded red'}); 
                    return;
                } 
                if(cboEquipo<1){
                    M.toast({html: 'Seleccione el tipo de articulo.', classes: 'rounded red'}); 
                    return;
                } 

                inventarios({ opcion :9,txtIdPagoEspecie:txtIdPagoEspecie,txtFecha:txtFecha, txtCoordinacion:txtCoordinacion,cboSucursal:cboSucursal,txtIdCoor:txtIdCoor,txtDistribuidora:txtDistribuidora,txtPago:txtPago,cboEquipo:cboEquipo,txtMarca:txtMarca,txtModelo:txtModelo,txtSerie:txtSerie,txtDescripcion:txtDescripcion,txtUbicacion:txtUbicacion},resRegistroStock);
                 

             });

              


        });
        // funciones
        function inicializarCombos(){
            onRequest({ opcion : 70 }, respcargasucursales); 
            onRequest({ opcion : 71 }, respcargatiposequipo); 
            //console.log("here")
            inventarios({ opcion : 10 }, respCargarPagosEspecie); 
            inventarios({ opcion : 22}, respInboxPendientes);
        }

        function soloNumeros(e){

          var key = window.Event ? e.which : e.keyCode

          return ((key >= 48 && key <= 57) || (key==8))

        }

        function limpiarCampos(){
                $("#txtIdPagoEspecie").val("0");
                $("#txtFecha").val("");
                $("#txtCoordinacion").val("");
                $("#txtIdDist").val("");
                $("#txtDistribuidora").val(""); 
                $("#txtPago").val(""); 
                $("#txtMarca").val("");
                $("#txtModelo").val("");
                $("#txtSerie").val("");
                $("#txtDescripcion").val("");
                $("#txtUbicacion").val("");
                
        }

        function cambiarEstatus(id){
            $("#txtIdEstatus").val(id);
        }

        function cambiarEstatusPago(){
             var txtIdEstatus = $("#txtIdEstatus").val();
             var txtMotivo =   $("#txtMotivo").val();
             var sltEstatusPago =$("#sltEstatusPago").val();
             
             if(sltEstatusPago!=5){
              if(txtMotivo.length<5){
                    M.toast({html: 'El motivo no puede ir vacio', classes: 'rounded red'}); 
                    return;
                } 
              }

            inventarios({ opcion : 11,txtIdEstatus:txtIdEstatus,txtMotivo:txtMotivo,sltEstatusPago:sltEstatusPago }, respCambiarEstatusPagos); 

        }

        function agregarImg(id){

            $("#frameImg").attr('src', "img.php?txtIdCarga="+id );

        }

        function editarPagoEspecie(id){
            inventarios({ opcion : 13,txtId:id }, respBuscarPago);
        }

    

        //respuestas

    var respcargasucursales = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="0"  selected>Seleccione Sucursal</option>';
    
        for(var i=0; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].nomComercial+'</option>';
        } 
        
        $('#cboSucursal').html(documento);
        $('#cboSucursal').formSelect(); 
        cargarMenuPorRol();
    
    }
    var respcargatiposequipo = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="0" selected>Tipo de Equipo</option>';
    
        for(var i=0; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        } 
        
        $('#cboEquipo').html(documento);
        $('#cboEquipo').formSelect(); 
    
    }
    var resRegistroStock = function(data) { 
        if (!data && data == null)
            return;  
         
        if(data[0].respuesta<3){
            M.toast({html: 'Los datos se an guardado correctamente.', classes: 'rounded green'});
            limpiarCampos();
            inventarios({ opcion : 10 }, respCargarPagosEspecie);
        }
        else{
            M.toast({html: 'Ocurrio un error al intentar guardar los datos.', classes: 'rounded red'})
        }
    }

    var respCargarPagosEspecie = function(data) { 
        if (!data && data == null)
            return;  
        
        console.log(data);
        
         var documento='';
    
      for(var i=0; i<data.length; i++){
            documento+="<tr>"+
                       "<td>"+data[i].id+"</td>"+
                       "<td>"+data[i].distribuidora_id+"</td>"+
                       "<td>"+data[i].distribuidora+"</td>"+
                       "<td>"+data[i].articulo+"</td>"+
                       "<td>"+data[i].sucursal+"</td>"+
                       "<td>"+data[i].descripcion+"</td>"+
                       "<td>"+data[i].estatus+"</td>"+
                       "<td><a onclick='editarPagoEspecie("+data[i].id+")' class='waves-effect waves-light  btn-floating tooltipped' data-position='top' data-tooltip='Editar'><i class='material-icons left'>border_color</i></a> <a onclick='agregarImg("+data[i].id+")' class='waves-effect waves-light  btn-floating tooltipped  modal-trigger' data-position='top' data-tooltip='Agregar Imagen' href='#modalCargarImg'><i class='material-icons left'>camera_alt</i></a> <a onclick='cambiarEstatus("+data[i].id+")' class='waves-effect waves-light  btn-floating tooltipped blue modal-trigger' data-position='top' data-tooltip='Cambiar Estatus' href='#modalDeshabilitar'><i class='material-icons left'>autorenew</i></a>              </td>"+
                       "</tr>";
        }
        $('#tbPagosEspecie').html(documento); 
        $('.tooltipped').tooltip();

    }

     var respBuscarPago = function(data) { 
        if (!data && data == null)
            return;  
 

                $("#txtIdPagoEspecie").val(data[0].id);
                $("#txtFecha").val(data[0].fecha);
                $("#txtCoordinacion").val(data[0].coordinacion);
                $("#txtIdDist").val(data[0].distribuidora_id);
                $("#txtDistribuidora").val(data[0].distribuidora); 
                $("#txtPago").val(data[0].pago); 
                $("#txtMarca").val(data[0].marca);
                $("#txtModelo").val(data[0].modelo);
                $("#txtSerie").val(data[0].serie);
                $("#txtDescripcion").val(data[0].descripcion);
                $("#txtUbicacion").val(data[0].ubicacion);
                   
         
    }

    var respCambiarEstatusPagos = function(data) { 
        if (!data && data == null)
            return;  
         
          inventarios({ opcion : 10 }, respCargarPagosEspecie); 

          $("#modalDeshabilitar").modal('close');
    }
 
    </script> 

    
 
    </body>
</html>