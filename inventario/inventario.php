<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Inventario</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="inventario()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
    
        <h4 class="header " align="center" style="color:#1a237e;"><i class="material-icons prefix">assignment</i>Inventario</h4>
        <div class="row">
                <div class="row">
                    <div class="input-field col l3  s12 offset-l1 ">
                            <i class="material-icons prefix">assignment</i>
                            <select onchange="muestraBoton()" id="selectOpcion">
                                <option value="" disabled selected>Seleccione una opcion:</option>
                                <option value="1">Nuevo inventario</option>
                                <option value="2">Historico</option>
                            </select>
                            <label>Opciones</label>

                    </div>
                    <div class="input-field col l3  s12">
                            <i class="material-icons prefix">business</i>
                            <select id="sucursalesdd">
                            </select>
                            <label>Sucursal</label>
                    </div>
                    <div class="col s2 offset-11">
                            <a id="btnIniciaInventario" style='display:none;' class="waves-effect btn blue darken-4 modal-trigger"><i class="material-icons left">assignment</i>Iniciar inventario</a> <br>
                            <a id="btnBusquedaInv" style='display:none;' class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Buscar</a>  <br>
                    </div>
                    
                    
                    
                </div>

                <div class="row center-align">
                    <div>
                        <table class="col 9  s12 offset-l1" id="tablaCreaInventario" style='display:none;'>
                            <thead >
                            <tr>
                                <th>Id Inventario</th>
                                <th>Sucursal</th>
                                <th>Fecha Inventariado</th>
                                <th>Hora Inventariado</th>
                                <th>Fecha Finalizado</th>
                                <th>Hora Finalizado</th>
                                <th>Capturista</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>

                            <tbody id="datosInventario">
                                
                            </tbody>
                        </table>
                    </div>  
                </div>

                
               

        </div>
    </div>


               
        

        
        
      

    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/equipo.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 

    <div id="modalCrearInventario" class="modal">
           <nav class="blue darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">assignment</i>Crear Inventario
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s6">
                            <label for="codArticulo">Codigo del articulo:</label>
                            <textarea id="codArticulo" class="materialize-textarea"></textarea>
                        </div>
                        <br>

                        <div>
                            <a id="cargarInfoEquipo" class="waves-effect small btn blue darken-4"><i class="material-icons left">beenhere</i>Cargar</a>
                            <a id="finalizarInventario" class="waves-effect small btn blue darken-4"><i class="material-icons left">check_circle</i>Agregar a Inventario</a> &nbsp; &nbsp; &nbsp;
                            <a id="cerrarInventario" class="waves-effect small btn blue darken-4"><i class="material-icons left">done_all</i>Cerrar Inventario</a> 
                        </div>
                        
                      
                   </div>
                 
                   <div class="col s12">
                        <table class="highlight" id="tablaInventario">
                            <thead >
                            <tr id="trCreaInventario">
                                <th>Id</th>
                                <th>Tipo de equipo</th>
                                <th>Sucursal</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                
                            </tr>
                            </thead>

                            <tbody id="tablaInventarioDeEquipo">
                                
                            </tbody>
                        </table>
                    </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               <a id="cancelarCreaciondeInventario" class= " modal-action waves-effect waves-green btn-flat left">Cancelar</a>
              
           </div>
    </div>
    
    <div id="modalEditarInventario" class="modal">
           <nav class="blue darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">edit</i>Editar Inventario
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s6">
                            <label for="codArticuloEdit">Codigo del articulo:</label>
                            <textarea id="codArticuloEdit" class="materialize-textarea"></textarea>
                        </div>
                        <br>

                        <div>
                            <a id="cargarInfoEquipoEditar" class="waves-effect small btn blue darken-4"><i class="material-icons left">beenhere</i>Cargar</a>  
                            <a id="finalizarInventarioEditar" class="waves-effect small btn blue darken-4"><i class="material-icons left">check_circle</i>Agregar a Inventario</a> <br> <br>
                            <a id="cerrarInventarioEdit" class="waves-effect small btn blue darken-4"><i class="material-icons left">done_all</i>Cerrar Inventario</a> 
                        </div>
                        
                      
                   </div>
                 
                   <div class="col s12">
                        <table class="highlight" id="tablaInventarioEditar">
                            <thead >
                            <tr id="trCreaInventarioEdit">
                                <th>Id</th>
                                <th>Tipo de Equipo</th>
                                <th>Descripcion</th>
                                <th>Sucursal</th>
                                <th>Marca</th>
                                <th>Encargado</th>
                                
                            </tr>
                            </thead>

                            <tbody id="tablaInventarioDeEquipoEditar">
                                
                            </tbody>
                        </table>
                    </div>
               </form>         
          
           </div>
           <div class="modal-footer">
                <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Aceptar</a>
              
           </div>
    </div>
    

    <div id="modalVerInventario" class="modal">
           <nav class="blue darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">assignment</i>Inventario
                   </a>
               </div>
           </nav>
           <div class="modal-content modal-lg">
           <form class="col s12">
                  <div class="row">
                    <div class="input-field col s4">
                        <i class="material-icons prefix">business</i>
                        <select id="areadd">
                        </select>
                        <label>Area:</label>
                   </div>
                   <div class="input-field col s5">
                        <a id="btnBusquedaPorArea"  class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Buscar</a>
                   </div>
                   <div class="input-field col s3">
                        <a id="btnExcelInventario"  class="waves-effect btn blue darken-4"><i class="material-icons left">developer_board</i>Excel</a>
                   </div>
                   <div class="col s12">
                        <table class="responsive-table" id="tablaInventarioVer">
                            <thead >
                            <tr id="trCreaInventarioVer">
                                <th>Id</th>
                                <th>Tipo de Equipo</th>
                                <th>Descripcion</th>
                                <th>Sucursal</th>
                                <th>Area</th>
                                <th>Encargado</th>
                                <th>Inventariado</th>
                            </tr>
                            </thead>

                            <tbody id="tablaInventarioDeEquipoVer">
                                
                            </tbody>
                        </table>

                        <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="display:none">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Tipo de Equipo</th>
                                            <th>Descripcion</th>
                                            <th>Sucursal</th>
                                            <th>Area</th>
                                            <th>Encargado</th>
                                            <th>Inventariado</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Valor Factura</th>
                                            <th>Serie</th>
        
                                        </tr>
                                        </thead>

                                        <tbody id="tablaInventarioDeEquipoVer2">
                                           
                                        </tbody>
                                    </table>
                    </div>
                  </div>
               </form>         
          
           </div>
           <div class="modal-footer">
                <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Aceptar</a>
              
           </div>
    </div>


    </body>
</html>