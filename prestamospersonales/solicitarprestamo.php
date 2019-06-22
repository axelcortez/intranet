<?php 
     # definimos la carpeta destino
     $carpetaDestino="imagenes/";
                
     # si hay algun archivo que subir
     if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0])
     {
 
         # recorremos todos los arhivos que se han subido
         for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
         {
 
            $_FILES["archivo"]["name"][0] = $_COOKIE["b_capturista_id"]."_".date("Y-m-d")."_".$_FILES["archivo"]["name"][0];

             # si es un formato de imagen
             if($_FILES["archivo"]["type"][$i]=="application/pdf" || $_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
             {
 
                 # si exsite la carpeta o se ha creado
                 if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                 {
                     $origen=$_FILES["archivo"]["tmp_name"][$i];
                     $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
 
                     # movemos el archivo
                     if(@move_uploaded_file($origen, $destino))
                     {
                         $documento=$_FILES["archivo"]["name"][$i]." Se movio correctamente";
                     }else{
                         $documento= "No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                     }
                 }else{
                     $documento= "No se ha podido crear la carpeta: ".$carpetaDestino;
                 }
             }else{
                 $documento= $_FILES["archivo"]["name"][$i]." - NO es imagen jpg, png o gif o pdf";
             }
         }
     }else{
         $documento= "No se ha subido ninguna imagen";
     }
?>
<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Crear solicitudes</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onload="cargarCreacionSolicitud()">
    <div id="container" ><!-- CONTENEDOR 1 -->
         <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
        <h3 class="header " align="center" style="color:#1a237e;">Solicitud de Prestamo Personal</h3> 
      
        <h5 class="header" align="center" ><b>Información del Solicitante</b></h5>
        <div class="row ">
            <div class="input-field col l6 s12 offset-l1">
                <input placeholder="Nombre del solicitante" id="nombre_solicitante" type="text" class="validate" disabled>
                <label for="nombre_solicitante"><b>Nombre del solicitante:</b></label>
            </div>
            <div class="input-field col l3 s6">
                <input placeholder="Fecha solicitud" id="fecha_solicitud" type="date" class="validate" disabled>
                <label for="fecha_solicitud"><b>Fecha Solicitud:</b></label>
            </div>
            <div class="input-field col l2 s4">
                <a id="btnAbrirPoliticas" class="waves-effect btn blue darken-4 pulse"><i class="material-icons left">book</i>Politicas</a>
                <br></br>
            </div>
            <div class="input-field col l3 s6 offset-l1">
                <input placeholder="Puesto" id="puesto_solicitud" type="text" class="validate" disabled>
                <label for="puesto_solicitud"><b>Puesto:</b></label>
            </div>
            <div class="input-field col l3 s6 ">
                <input placeholder="Sucursal" id="sucursal_solicitud" type="text" class="validate" disabled>
                <label for="sucursal_solicitud"><b>Sucursal:</b></label>
            </div>
            <div class="input-field col l3  s6">
                <input placeholder="Empresa" id="empresa_solicitud" type="text" class="validate" disabled>
                <label for="empresa_solicitud"><b>Empresa:</b></label>
            </div>            
        </div>
        <h5 class="header" align="center" ><b>Información del Prestamo</b></h5>
        <div class="row">
            <div class="input-field col l2 s12 offset-l1">
                <input placeholder="Numero de Tarjeta" id="num_tarjeta" type="text" class="validate">
                <label for="num_tarjeta"><b>Numero de Tarjeta:</b></label>
            </div>
            <div class="input-field col l3 s6">
                <input placeholder="Benificiario Cuenta" id="bnf_cta" type="text" class="validate">
                <label for="bnf_cta"><b>Benificiario Cuenta:</b></label>
            </div>
            <div class="input-field col l2 s1">
           
                <label>
                    <input type="checkbox" id="chBeneficiario" onclick="beneficiarioCheck()" />
                    <span>El beneficiario es el colaborador</span>
                </label>
           
            </div>
            <div class="input-field col l3 s12">
                <input placeholder="Nombre Banco" id="nombre_banco" type="text" class="validate">
                <label for="nombre_banco"><b>Nombre Banco:</b></label>
            </div>
            <div class="input-field col l2 offset-l1 s12">
                <input placeholder="Monto Solicitado" id="monto_solicitado" type="text" class="validate">
                <label for="monto_solicitado"><b>Monto Solicitado:</b></label>
            </div>
            <div class="input-field col l1 s6">
                <input placeholder="Quincenas" id="quincenas" type="number" class="validate">
                <label for="quincenas"><b>Quincenas:</b></label>
            </div>
            <div class="input-field col l1 s6">
                <input placeholder="Meses pagar" id="meses_pagar" type="text" class="validate" disabled>
                <label for="meses_pagar"><b>Meses pagar</b></label>
            </div>
            <div class="input-field col l2 s6">
                <input placeholder="Interes del prestamo" id="interes_prestamo" type="text" class="validate" disabled>
                <label for="interes_prestamo"><b>Interes del prestamo:</b></label>
            </div>
            <div class="input-field col l2 s6">
                <input placeholder="Tipo de Abono" id="tipo_abono" type="text" class="validate" disabled>
                <label for="tipo_abono"><b>Tipo de Abono:</b></label>
            </div>
            <div class="input-field col l2 s6">
                <input placeholder="Descuendo de" id="descuento" type="text" class="validate" disabled>
                <label for="descuento"><b>Descuendo de:</b></label>
            </div>
            <div class="input-field col l1 offset-l1 s6">
                <input placeholder="Monto Total a Pagar" id="monto_total_pagar" type="text" class="validate" disabled>
                <label for="monto_total_pagar"><b>Monto Total:</b></label>
            </div>
            <div class="input-field col l5 s6 ">
                <input placeholder="Monto Con Letra" id="monto_letra" type="text" class="validate" disabled>
                <label for="monto_letra"><b>Monto Con Letra:</b></label>
            </div>
            <div class="input-field col l2 s6">
                <input placeholder="Inicio del Descuento" id="inicio_descuento" type="date" class="validate" disabled>
                <label for="inicio_descuento"><b>Inicio del Descuento:</b></label>
            </div>
            <div class="input-field col l2 s6">
                <input placeholder="Fin del Descuento" id="fin_descuento" type="date" class="validate" disabled>
                <label for="fin_descuento"><b>Fin del Descuento:</b></label>
            </div>
        </div>
        <div class="col l12 s6" align="center" >
            <a id="btnCrearSolicitud" class="waves-effect btn blue darken-4"><i class="material-icons left">add</i>Crear Solicitud</a>
            <br></br>
        </div>

        <div class="row"><!-- CONTENEDOR 1 -->
            <div class="col s12">
                <table class="highlight">
                    <thead >
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Fecha Solicitud</th>
                        <th>Monto Solicitado</th>
                        <th>Quincenas</th>
                        <th>Monto Autorizado</th>
                        <th>Monto Total a Pagar</th>
                        <th>Descuento quincenal</th>
                        <th>Estatus</th>
                        <th>Fecha Autorizado</th>  
                        <th>Comentarios</th>                                       
                    </tr>
                    </thead>

                    <tbody id="tablaSolicitudPrestamo">
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>        
        

        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/bancaprepa.js"></script>
        <script type="text/javascript" src="../js/js.cookie.js"></script>
        <script type="text/javascript" src="../js/equipo.js"></script>
        <script type="text/javascript" src="../js/prestamos.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 


    <div id="modalinfoPrestamo" class="modal">
           <nav class="teal lighten-1">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">comment</i>Información del Prestamo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
                <div class="row">
               
                    <div class="input-field col s6">
                        <h7>Comentarios:</h7>
                        <textarea id="textoAreaInfo" class="materialize-textarea" disabled></textarea>
                    </div>
                    <div class="input-field col s3">
                        <h7 id="texto_monto_autorizado" style='display:none;'>Monto autorizado:</h7>
                        <input id="textoMontoAInfo" style='display:none;' type="text" class="validate" disabled>
                    </div>
                    <div class="col s12">
                        <table class="highlight">
                            <thead >
                            <tr>
                                <th>Numero de pago</th>
                                <th>Cantidad</th>
                                <th>Fecha de pago</th>
                                <th>Abonado</th>                                 
                            </tr>
                            </thead>

                            <tbody id="tablaCorrida">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
           </div>
    </div>

    

    <div id="modalSubirResponsiva" class="modal">
           <nav class="teal lighten-1">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">backup</i>Subir Responsiva
                   </a>
               </div>
           </nav>
           <div class="modal-content">
                <div class="row">
                <form  id="formFiles2" class="col s12" action="<?php echo $_SERVER["PHP_SELF"]?>"  method="post"  enctype="multipart/form-data" name="inscripcion">
                    <div class="file-field input-field">
                        <div id="classbtnSubirResponsiva" class="btn grey">
                            <span>Subir Responsiva</span>
                            <input type="file" id="btnSubirResponsiva" name="archivo[]" disabled>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"   type="text" id="archivoResponsiva">
                        </div>
                    </div>
                    <div class="col 12 s12" id="cargarArchivoSolicitud"  style='display:none;'>

                    </div>
                    <br>
                    <div class="col 12 s12" align="right">
                        <a id="btnEliminarResp" class="waves-effect waves-light btn-small" disabled><i class="material-icons right">delete</i>Eliminar</a>
                    </div>
                </form>
                </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
               <a id="AceptarSubirResponsiva" class= "modal-action waves-effect waves-green btn-flat right" disabled>Aceptar</a>
           </div>
    </div>


    
    <div id="cargarResponsivaModal" class="modal">
                <nav class=" orange accent-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons right">record_voice_over</i>Aceptar Carga
                        </a>
                    </div>
                </nav>

                <div class="modal-content"> 
                    <center> <h5><strong>¿Seguro que desea realizar la carga?</strong></h5></center>
                </div>

                <div class="row" >
                            <div class="col s6 right"    >
                            <a id="aceptarCarga" class="waves-effect waves-light btn  accent-4 blue"><i class="material-icons left">done</i>Aceptar</a>
                                
                            </div>
                            <div class="col s6 "   >
                            <a " class="waves-effect modal-close waves-light btn right accent-4 red"><i class="material-icons left">close</i>Cancelar</a>
                            </div>
                </div>
                
                
                <div class="modal-footer"> 
                    
                </div>
            </div>
    
 
    </body>
</html>