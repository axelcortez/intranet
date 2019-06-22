<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Busqueda de Equipo</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="busquedaEquipo()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
    
        <h4 class="header " align="center" style="color:#1a237e;">Busqueda de equipos</h4>
        <div class="row">
                <div class="row">
                    <div class="input-field col s2  offset-s1 ">
                                    <i class="material-icons prefix">laptop_chromebook</i>
                                    <input id="id_equipo" type="number" class="validate" placeholder="Id equipo"/>
                                    <label for="id_equipo">Id equipo</label>
                    </div>
                    <div class="input-field col s3 ">
                            <i class="material-icons prefix">business</i>
                            <select id="sucursalesdd">
                            </select>
                            <label>Sucursal</label>
                    </div>
                    <div class="input-field col s3 ">
                     <i class="material-icons prefix">laptop_chromebook</i>
                            <select id="sltArea">
                            </select>
                            <label>Área</label>
                    </div>
                    <div class="input-field col s2">
                            <i class="material-icons prefix">laptop_chromebook</i>
                                <input id="num_equipo"  placeholder="# equipo" type="text" class="validate">
                            <label for="num_equipo"># Equipo</label>
                     </div>
                     <iframe id="txtArea1" style="display:none"></iframe>
                     <div class="col s12" align="right">
                          <a id="btnReporteExcel" class="btn-floating btn-large waves-effect waves-light blue darken-4"><i class="material-icons">developer_board</i></a>
                     </div>
                     
                    <div class="col s12" align="center">
                            <a id="BtnLimpiaBusEquipo" class="waves-effect btn blue darken-4"><i class="material-icons left">brush</i>Limpiar</a>
                            <a id="BtnBusquedaEquipo" class="waves-effect btn blue darken-4"><i class="material-icons left">search</i>Buscar</a>
                    </div>  
                </div>
            </div>
        </div>


        
        <div class="card">
            <div class="card-content">
                <div id="container">
                    <div class="row"><!-- CONTENEDOR 1 -->
                            <div class="col s12 "><!-- CONTENEDOR 2 -->
                                    <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="font-size:13px">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Sucursal</th>
                                            <th>Area</th>
                                            <th># Equipo</th> 
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Responsable</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>

                                        <tbody id="tablaEquipos">
                                           
                                        </tbody>
                                    </table>
                                    <table class="highlight" width="100%"  border="0" cellspacing="0" cellpadding="0" style="display:none">
                                        <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Sucursal</th>
                                            <th>Area</th>
                                            <th># Equipo</th> 
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Responsable</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Serie</th>
                                        </tr>
                                        </thead>

                                        <tbody id="tablaEquipos2">
                                           
                                        </tbody>
                                    </table>
                            </div><!-- CONTENEDOR 2 -->
                    </div><!-- CONTENEDOR 1 -->
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

    <div id="modalDeshEquipo" class="modal">
           <nav class="orange darken-2">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">do_not_disturb</i>Deshabilitar equipo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                            <input placeholder="Id Equipo" id="idEquipoDes" type="text" class="validate" disabled>
                            <label for="Id Equipo" class="activate" ></label>
                        </div>
                       
                       <div class="input field col s12">
                           <label for="descDes">Motivo para dar de baja el equipo</label>
                           <textarea id="descDes" class="materialize-textarea"></textarea>
                           
                       </div>
                   </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnDesEquipo" class="waves-effect waves-light btn orange darken-2 right"><i class="material-icons left"></i>Deshabilitar</a>
           </div>
    </div>
    
    <div id="modalNotaCancelacion" class="modal">
           <nav class="grey darken-1">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">library_books</i>Nota de cancelación
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s2">
                            <label for="Id Equipo" class="activate" >Id del equipo</label>
                            <input placeholder="Id Equipo" id="idEquipoNota" type="text" class="validate" disabled>
                        </div>
                        <div class="input field col s4">
                            <label for="Fecha de baja" class="activate" >Fecha de baja</label>
                            <input placeholder="Fecha de baja" id="fechaBaja" type="text" class="validate" disabled>
                            
                        </div>
                       <div class="input field col s12">
                           <label for="notaEquipo">Motivo por el cual se dio de baja el equipo</label>
                           <textarea id="notaEquipo" class="materialize-textarea" disabled></textarea>
                           
                       </div>
                   </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="#!" class="modal-action modal-close waves-effect waves-light btn grey darken-1 right"><i class="material-icons left">library_books</i>Aceptar</a>
           </div>
    </div>

    

     <div id="modalAsignarResp" class="modal">
           <nav class="green darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">assignment_ind</i>Responsable
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s1">
                            <label for="Id" class="activate" '></label>
                            <input placeholder="Id" id="IdResponsable" type="text" class="validate" disabled >
                        </div>
                        <div class="input field col s5">
                            <label for="Nombre del responsable" class="activate" ></label>
                            <input placeholder="Nombre del responsable" id="nomResponsable" type="text" class="validate" onkeyup="buscaEmpleados()" >
                        </div>
                        <div class="input-field col s4 ">
                            <i class="material-icons prefix">date_range</i>
                            
                            <input id="respFecha_ent" type="date" class="validate">
                            <label for="respFecha_ent">Fecha Entrega</label>
                         </div>
                         <div class="col s1 ">
                            <a onclick="asignarEquipo()" class='waves-effect waves-light btn-floating btn-small blue'><i class='material-icons'>add</i></a>
                         </div>

                         


                        <div class="input field col s6 " id="listaEmpleados">
                                    <table class="highlight">
                                                    <tbody id="listaEmpleadosTabla">
                                                    
                                                    </tbody>
                                    </table>
                        </div>
                        <div class="input field col s12">
                          <!-- <input placeholder="Descripcion" id="descPubEdit" type="text" class="validate">  -->
                           <textarea  id="comenEquipo" class="materialize-textarea"></textarea>
                           <label for="comenEquipo">Comentarios</label>
                       </div>
                        

                        <div class="input field col s12 ">
                                    <table class="highlight">
                                        <thead >
                                            <tr>
                                                <th>Encargado</th>
                                                <th>Fecha Entrega</th>
                                                <th>Comentario</th> 
                                                
                                            </tr>
                                        </thead>
                                            <tbody id="datosEncargadoTabla">
                                            
                                            </tbody>
                                    </table>
                        </div>

                        <div class="input field col s2" >
                           
                            <input placeholder="Num Equipo" id="numEquipoOculto" type="text" class="validate"  style='display:none;' >
                        </div>
                       
                       
                   </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               
               <a id="cerrarYactualizarModalResp" class="modal-action modal-close waves-effect waves-light btn green darken-4 right"><i class="material-icons left"></i>Cerrar</a>
           </div>
    </div>

    <div id="modalEditarEquipo" class="modal">
           <nav class="blue darken-3">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">edit</i>Editar equipo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <form class="col s12 no-padding">
                   <div class="row">
                        <div class="input field col s1">
                            <label for="Id Equipo" class="activate" >Id</label>
                            <input placeholder="Id Equipo" id="idEquipoEdit" type="text" class="validate" disabled>
                        </div>
                        <div class="input field col s2">
                            <label for="Num Equipo" class="activate" ># de equipo</label>
                            <input placeholder="Num Equipo" id="numEquipo" type="text" class="validate" >
                        </div>           
                        <div class="input field col s3">
                            <label for="Marca" class="activate" >Marca </label>
                            <input placeholder="Marca" id="marcaEdit" type="text" class="validate" >
                        </div>           
                        <div class="input field col s3">
                            <label for="Modelo" class="activate" >Modelo</label>
                            <input placeholder="Modelo" id="modelEdit" type="text" class="validate" >
                        </div>                     
                        <div class="input field col s3">
                            <label for="Serie" class="activate" >Serie</label>
                            <input placeholder="Serie" id="serieEdit" type="text" class="validate" >
                        </div>
                        <div class="input-field col s4">
                            
                            <select id="sucursalesddEdit">
                            </select>
                            <label>Sucursal</label>
                        </div>    
                        <div class="input-field col s4">
                            
                            <select id="areasddEdit">
                            </select>
                            <label>Area</label>
                        </div>  
                        <div class="input-field col s4">
                            
                            <select id="tipoEquipoDD">
                            </select>
                            <label>Tipo</label>
                        </div>  
                        <div class="input field col s3">
                            <label for="Valor Factura" class="activate" >Valor Factura</label>
                            <input placeholder="Valor Factura" id="valorF" type="text" class="validate" >
                        </div>    
                       <div class="input field col s12">
                           <label for="descEdit">Descripcion del equipo</label>
                           <textarea id="descEdit" class="materialize-textarea"></textarea>
                       </div>
                   </div>
               </form>         
          
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cancelar</a>
               <a id="btnEditarEquipo" class="waves-effect btn blue darken-3"><i class="material-icons left">edit</i>Editar</a>
           </div>
    </div>
 
    </body>
</html>