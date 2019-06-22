<?php 
     # definimos la carpeta destino
     $carpetaDestino="../imagenes/stock/";
                
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
    <body ">
    <div id="container" ><!-- CONTENEDOR 1 -->
        

        <div class="row"></div>
        <div class="row"></div>

        <div class="row ">
            <form  id="formFiles" class="col s12 l6 offset-l3 " action="<?php echo $_SERVER["PHP_SELF"]?>"  method="post"  enctype="multipart/form-data" name="inscripcion">
                <div class="row" >
                    <div class="input-field col s2 l2">
                        <input  id="txtIdCarga" type="text" class="validate black-text" disabled value="<?php echo $_REQUEST['txtIdCarga']?>">
                        <label for="txtIdCarga" class="black-text"># Articulo</label>
                    </div>  
                    <div class="file-field input-field s12 l12">
                        <div id="btndocId" class="btn "> 
                             <span><i class="material-icons right">cloud_upload</i>Cargar</span>
                            <input id="docId"  type="file" name="archivo[]" >
                        </div>
                        <div class="file-path-wrapper">
                            <input id="txtDocName" class="file-path validate" type="text">
                        </div>
                    </div>

                </div> 
            
                
                       
            </form>       
            <div class="row" style="width: 330px; margin: 0 auto">
                <div><br></br></div>
                <div class="col s6 offset-s3">
                    <a class="waves-effect waves-light btn modal-trigger" href="#cargarImgStock"><i class="material-icons right">file_upload</i>Cargar</a>
                </div>
            </div>
        </div>
              
    
    </div>

    
            <div id="cargarImgStock" class="modal" style="width: 98%;">
                
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
                
                 
            </div>


    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script> 
    <script type="text/javascript" src="../js/js.cookie.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
             $('.modal').modal();

            

             $("#aceptarCarga").click(function() { 

                var txtDocName =$("#txtDocName").val()
                var txtIdCarga = $("#txtIdCarga").val()

                if ($("#txtDocName").val()=='') {


                    M.toast({html: 'Es necesario agregar una imagen.', classes: 'rounded red'}); 

                    return;

                }

                 inventarios({ opcion : 12,txtId:txtIdCarga,txtDocName:txtDocName }, respCargarImg);

                   
             });



        });

         var respCargarImg = function(data) { 
                if (!data && data == null)
                    return;  
                 
                if(data[0].respuesta<3){
                    M.toast({html: 'Los datos se an guardado correctamente.', classes: 'rounded green'});
                     $( "#formFiles" ).submit();
                    
                }
                else{
                    M.toast({html: 'Ocurrio un error al intentar guardar los datos.', classes: 'rounded red'})
                }
        }

    </script> 
   
 
    </body>
</html>