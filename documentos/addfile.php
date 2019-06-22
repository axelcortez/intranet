<?php 
     # definimos la carpeta destino
     $carpetaDestino="../imagenes/publicaciones/";
                
     # si hay algun archivo que subir
     if(isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0])
     {
 
         # recorremos todos los arhivos que se han subido
         for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
         {
 
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
        <title>Sistema Bancaprepa</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
        
</head>
    <body onLoad="cargarAddfile()">
    <div id="container"  ><!-- CONTENEDOR 1 -->
        
    
            <?php
                include('../menu/menu.php');

                   
            ?>
    <div class="container">
        <div class="row"></div>
        <div class="row"></div>

        <div class="row ">
            <form  id="formFiles" class="col s6 offset-s3 " action="<?php echo $_SERVER["PHP_SELF"]?>"  method="post"  enctype="multipart/form-data" name="inscripcion">
            <div class="row" >
                <div class="input-field col s12">
                <input placeholder="Escribe Aqui el Titulo de La publicacion" id="pTitulo" type="text" class="validate">
                <label for="pTitulo">TItulo</label>
                </div> 
            </div>

                <div class="switch">¿Desea incluir algun documento?
                            <label>
                            No
                            <input id='chkDoc' type="checkbox">
                            <span class="lever"></span>
                            Si
                            <input id="idpublicacion1" style="visibility:hidden">
                            </label>
                            
                </div> 
                <div class="file-field input-field">
                    <div id="btndocId" class="btn grey"> 
                         <span><i class="material-icons right">cloud_upload</i>Cargar</span>
                        <input id="docId"  type="file" name="archivo[]" disabled>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="tittleDoc" class="file-path validate" type="text">
                    </div>
                </div>
                <div class=" col s5" > 
                        <div class="switch">¿Es pdf?
                            <label>
                                No
                                <input id='chkPdfImg' type="checkbox">
                                <span class="lever"></span>
                                Si
                            </label>
                        </div>
                </div>
                <div class="row">
                    <div class="input-field col s12"> 
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="pDescripcion" class="materialize-textarea" data-length="500" ></textarea>
                    <label for="pDescripcion">Descripcion</label>
                    </div>
                </div> 
                <div class=" col s12" >
                        <div class='input-field col s4'>
                                <select id="tipoPubAddFile" > 
                                </select>
                                <label>Seleccion el tipo de publicacion</label>
                        </div>
                        <div class='input-field col s4'>
                                <select id="tipoEmpresaAddFile" onChange="cargarRolesAf(tipoEmpresaAddFile.value)"> 
                                </select>
                                <label>Seleccion la Empresa</label>
                                
                        </div>
                        <div class='input-field col s4'>
                                <select id="sucursalesDD" > 
                                </select>
                                <label>Seleccion la sucursal</label>
                                
                        </div>
                        <div class='input-field col s4'>
                            <select id="tipoPuestoXemp"> 
                            </select>
                            <label><strong>Seleccione el puesto:</strong></label>
                            <div><br></br></div>
                            <div align="center" >
                                <a id="btnAgEmp_PuestoTmp" class="btn-small light-blue darken-4" disabled><i class="material-icons left">add_circle_outline</i>Agregar</a>
                            </div>  
                        </div>
                        
                 </div> 
            </form>
            <div class="row" style="width: 560px; margin: 0 auto">
                <div class="col s10 offset-s1 scroller2">
                        <table class="highlight">

                                <thead> 
                                    <tr>
                                        <th>Empresas</th> 
                                        <th>Sucursales</th> 
                                        <th>Puestos</th> 
                                        <th>Acciones</th>
                                    </tr>
                                    
                                </thead> 

                                <tbody id="tablaPuestoEmpresa">
                                
                                </tbody>
                        </table>
                </div> 
               
            </div>          
            <div class="row" style="width: 330px; margin: 0 auto">
                <div><br></br></div>
                <div class="col s6 offset-s3">
                    <button id="btnEnviarForm" class="btn waves-effect waves-light btn light-blue darken-4 right">Realizar Carga
                        <i class="material-icons right">send</i>
                    </button>
                </div>
             <!--   <div class="col s6 offset-s3">
                    <button id="btnPrueba" class="btn waves-effect waves-light right">prueba Carga
                        <i class="material-icons right">send</i>
                    </button>
                </div>   -->
            </div>
        </div>
              
    </div>
    </div>

    
            <div id="modalAceptarDoc" class="modal">
                <nav class=" orange accent-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons right">record_voice_over</i>Aceptar Publicacion
                        </a>
                    </div>
                </nav>
                <div class="modal-content"> 
                    <center> <h5><strong>¿Seguro que desea realizar la publicacion?</strong></h5></center>
                </div>
                <div class="row" >
                            <div class="col s6 right"    >
                            <a id="aceptarPublicacion" class="waves-effect waves-light btn  accent-4 blue"><i class="material-icons left">done</i>Aceptar</a>
                                
                            </div>
                            <div class="col s6 "   >
                            <a id="cancelarPub" class="waves-effect modal-close waves-light btn right accent-4 red"><i class="material-icons left">close</i>Cancelar</a>
                            </div>
                </div>
                
                
                <div class="modal-footer"> 
                    
                </div>
            </div>


    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script> 
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 
   
 
    </body>
</html>