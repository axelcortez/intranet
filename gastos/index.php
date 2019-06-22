<?php 
     # definimos la carpeta destino
     $carpetaDestino="../imagenes/gastos/";
                
     # si hay algun archivo que subir
     if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0])
     { 
         # recorremos todos los arhivos que se han subido
         for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
         {
          
            $_FILES["archivo"]["name"][$i] = $_COOKIE["b_capturista_id"]."_".date("Y-m-d")."_".$_FILES["archivo"]["name"][$i];
         
             # si es un formato de imagen
             if( $_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
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
<html lang="en">


<head>

    <meta charset="UTF-8">
    <title>Intranet Bancaprepa</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
</head>
<link rel="icon" type="../image/png" href="/img/favicon.ico" />

<body>
    <div id="container">
        <!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
        </div>
        <?php
            include('../menu/menu.php');
        ?>


        <h3 class="center-align">Solicitud de Gastos</h3>
        <hr>

        <div class="container">
            <!-- AQUI SE CARGA EL CONTENIDO-->
            <a href="#modalSolicitudGastos"
                class="btn waves-effect waves-light light-blue darken-4 pulse  secondary-content modal-trigger">Nueva
                Solicitud</a>
            <br><br>

            <div class="row mx-auto">
                <div class="input-field col m4 s12 offset-m2">
                    <input id="txtFechaInicial" type="date" class="validate" placeholder="Importe">
                    <label for="txtFechaInicial" class="black-text">Fecha Inicial</label>
                </div>
                <div class="input-field col m4 s12 ">
                    <input id="txtFechaFinal" type="date" class="validate" placeholder="Importe">
                    <label for="txtFechaFinal" class="black-text">Fecha Final</label>
                </div>
                <div class="input-field col m2 s12 ">
                    <a href="#" onclick="consultarSolicitudes()"
                        class="btn btn-floating waves-effect waves-light light-blue darken-4 tooltipped"
                        data-position="right" data-tooltip="Buscar"><i class="material-icons">search</i></a>
                </div>

            </div>

            <table class="responsive-table tablabancaprepa table-sm">
                <thead>
                    <tr>
                        <th class="center-align">Id</th>
                        <th class="center-align">Fecha</th>
                        <th class="center-align">Cuenta</th>
                        <th class="center-align">Importe</th>
                        <th class="center-align">Estatus</th>
                        <th class="center-align">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableSolicitudes">


                </tbody>
            </table>
        </div>



        <!-- MODALS -->
        <!-- Modal Structure -->
        <div id="modalSolicitudGastos" class="modal modal-fixed-footer modal-xl">
            <div class="modal-content">
                <h4>Solicitud de Gastos</h4>
                <hr>
                <div class="row">
                    <div class="col s12">
                        <form id="formFiles3" class="col s12" action="/intranet/gastos/" method="post"
                            enctype="multipart/form-data" name="inscripcion">
                            <div class="row">
                                <div class="input-field col m3 s12">
                                    <select id="sltCta" onchange="seleccionarCuenta(this.value)">
                                        <option value="0" disabled selected>Seleccione una Cuenta</option>
                                    </select>
                                    <label class="black-text">Cuentas</label>
                                </div>
                                <div class="input-field col m3 s12">
                                    <select id="sltSct">
                                        <option value="0" disabled selected>Seleccione una Gasto</option>
                                    </select>
                                    <label class="black-text">Gastos</label>
                                </div>
                                <div class="input-field col m3 s12">
                                    <select id="sltSucursal">
                                        <option value="0" disabled selected>Seleccione una Sucursal</option>
                                    </select>
                                    <label class="black-text">Gastos</label>
                                </div>
                                <div class="input-field col m3 s12">
                                    <input id="txtImporte" type="number" class="validate" placeholder="Importe">
                                    <label for="txtImporte" class="black-text">Importe</label>
                                </div>

                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="txtConcepto" type="text" class="validate" placeholder="Concepto">
                                    <label for="txtConcepto" class="black-text">Concepto</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col m6 s12">
                                    <div id="classbtnSubirArchivo" class="btn grey indigo darken-4">
                                        <span><i class="material-icons">attach_file</i> Evidencia </span>
                                        <input type="file" name="archivo[]" class="indigo darken-4">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" id="archivoDeEvidencia">
                                    </div>
                                </div>

                                <div class="file-field input-field col m6 s12">
                                    <div id="classbtnSubirArchivo" class="btn grey indigo darken-4">
                                        <span><i class="material-icons">attach_file</i> Cotizacion </span>
                                        <input type="file" name="archivo[]" class="indigo darken-4">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" id="archivoDeCotizacion">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5>Notificar a:</h5>
                                <hr>
                                <div class="col s12">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">email</i>
                                            <input type="text" id="autocomplete-input" class="autocomplete"
                                                placeholder="Buscar empleado...">
                                            <label for="autocomplete-input">Buscar empleado.</label>
                                        </div>
                                        <div class="row">
                                            <table>
                                                <thead>
                                                    <th>Empleado</th>
                                                    <th>Correo</th>
                                                    <th>Acciones</th>
                                                </thead>
                                                <tbody id="tbNotificacion">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    </form>

                </div>
                <div class="row">

                </div>

            </div>
            <div class="modal-footer">
                <a href="#!" id="btnCerrarModalGastos"
                    class="modal-close waves-effect waves-green btn-flat red white-text">Cancelar</a>
                <a href="#!" onclick="guardarSolicitudDeGasto()"
                    class="waves-effect waves-green btn-flat green white-text">Generar</a>
            </div>
        </div>

    </div>
    <!-- Modal documentos -->
    <div id="modalDocumentos" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Documentos Cargados</h4>
            <div class="container">
                <div class="collection" id="colecionImagenes">

                </div>
                <div class="imagen" style="width:100%;height:440px">
                    <img id="imgGasto" class="responsive-img" src="/intranet/imagenes/gastos/sin-imagen.jpg"
                        alt="NO SE ENCONTRO LA IMAGEN">
                </div>
            </div>
        </div>


        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red white-text"
                onclick="document.getElementById('imgGasto').src='/intranet/imagenes/gastos/sin-imagen.jpg'">Cerrar</a>
        </div>
    </div>


    <!-- Modal Notificaciones -->
    <div id="modalNotificaciones" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Comentarios</h4>
            <hr>
            <div class="container-fluid">
                <div class="imagen cajaNotificaciones" id="autoScroll">
                    <ul class="collection" id="cajaComentariosSolicitud">  
                    </ul>
                </div>
                <div class="row">
                    <input type="text"   id="txtSolicitudId" style="display: none;" value="0">
                    <div class="input-field col s9">
                        <input placeholder="Ingresar comentario.." id="txtComentario" type="text" class="validate">
                        <label for="first_name" class="black-text">Comentario</label>
                    </div>
                    <div class="input-field col s3">
                        <a onclick="guardarComentario()"  class="waves-effect waves-light btn blue lighten-4 black-text"><i class="material-icons right">send</i>Enviar</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" onclick="document.getElementById('txtSolicitudId').value=0" class="modal-action modal-close waves-effect waves-green btn-flat red white-text">Cerrar</a>
        </div>
    </div>


    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/utilerias.js"></script>
    <script type="text/javascript" src="../js/gastos.js"></script>
    <script type="text/javascript" src="../js/sweetalert.js"></script>


</body>

</html>