<?php 
     # definimos la carpeta destino
     $carpetaDestino="imagenesFondoAhorro/";
                
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
            <title>Solicitud de ingreso al fondo de ahorro</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="cargarDatosFondoAhorro()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Solicitud de ingreso al fondo de ahorro</h3> 
            <div class="row">
                <div class="col l12 center-align s12" >
                    <a id="btnCrearFondoAhorro" class="waves-effect waves-light btn-small indigo darken-4"><i class="material-icons left">local_mall</i>Crear</a>
                    <a id="btnCargarImagen" onclick="verifcarArchivo()" class="waves-effect waves-light btn-small indigo darken-4 btn modal-trigger" href="#modalCargarFondoAhorro"><i class="material-icons left">backup</i>Cargar</a>
                    <a id="btnReglamentoFondoAhorro" target="_blank" href="/img/REGLAMENTOFondoAhorro.pdf" class="waves-effect waves-light btn-small indigo darken-4"><i class="material-icons left">book</i>REGLAMENTO</a>
                    <a id="btnProcesoFondoAhorro" target="_blank" href="/img/ProcesoFondoAhorro.pdf" class="waves-effect waves-light btn-small indigo darken-4"><i class="material-icons left">book</i>PROCESOS</a>

                </div>
            </div>
            <div class="row">
                <div class="col l10 s12 offset-l1" id="tablaFondo"  style='display:none;'>
                <div class="card">
                    <div class="card-content center-align">
                        <div id="content">
                            <table class="highlight responsive-table centered">
                                    <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado Id</th>
                                        <th>Empleado</th>
                                        <th>Fecha subido</th>   
                                        <th>Hora subido</th>  
                                        <th>Acepto porcentaje de aceptación</th>   
                                        <th>Acciones</th>         
                                        
                                    </tr>
                                    </thead>

                                    <tbody id="datosFondo">
                                        
                                    </tbody>
                            </table>
                        </div>
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
        <script type="text/javascript" src="js/fondoAhorro.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 


<div id="modalCargarFondoAhorro" class="modal">
           <nav class="indigo darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">backup</i>Cargar Archivo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
           <div class="row">
                <form  id="formFiles3" class="col s12" action="<?php echo $_SERVER["PHP_SELF"]?>"  method="post"  enctype="multipart/form-data" name="inscripcion">
                    <div class="file-field input-field">
                        <div id="classbtnSubirArchivo" class="btn grey indigo darken-4">
                            <span>Subir Carta</span>
                            <input type="file" id="btnSubirArchivo" name="archivo[]" class="indigo darken-4" disabled>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate"   type="text" id="archivoArchivo">
                        </div>
                    </div>
                    <div class="col 12 s12 " id="cargarArchivoFondoAhorro"  style='display:none;'>

                    </div>
                    <div class="col 12 s12" align="center" style='display:none;' id="divLetras">
                        <p>Porcentaje de aportación al fondo de ahorro o en su caso no aceptación al plan</p>
                    </div>
                    <div class="col 12 s12" align="center" style='display:none;'  id="divRadioButton">
                        <p>
                            <label>
                                <input name="radioAceptar" type="radio" value="si" onchange="habilitarAceptar()"/>
                                <span>5%</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input name="radioAceptar" type="radio" value="no" onchange="habilitarAceptar()"/>
                                <span>No</span>
                            </label>
                        </p>
                    </div>
                    <div class="col 12 s12" align="right">
                        <a id="AceptarSubirArchivo" class="waves-effect waves-light btn-small indigo darken-4" disabled ><i class="material-icons right">check</i>Aceptar</a>
                    </div>
                    <br>
                    <div class="col 12 s12" align="right" style='display:none;' id="divBtnEliminarArchivo">
                        <a id="btnEliminarArchivo" class="waves-effect waves-light btn-small indigo darken-4" ><i class="material-icons right">delete</i>Eliminar</a>
                    </div>
                </form>
                </div>
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
           </div>
    </div>
    

    <div id="modalVerArchivo" class="modal">
           <nav class="indigo darken-4">
               <div class="nav-wrapper">
                   <a href="#!" class="brand-logo">
                       <i class="large material-icons">insert_photo</i>Archivo
                   </a>
               </div>
           </nav>
           <div class="modal-content">
                <div class="row">
                    <div class="col 12 s12 " id="cargarArchivo" >

                    </div>
                </div>     
           </div>
           <div class="modal-footer">
               <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
           </div>
    </div>
    </body>
</html>