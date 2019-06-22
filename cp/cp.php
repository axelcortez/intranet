<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Sepomex</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
</head>
<link rel="icon" type="image/png" href="../img/favicon.ico" /> 
    <body>
 
      <br>
      <br>

        <div class="container-fluid" >
          
            <div class="row">
                <div class="row">
                  <div class="input-field col s1">
                    <input placeholder="Codigo Postal" id="cp" type="text" class="validate black-text">
                    <label for="cp" class="black-text">Codigo Postal</label>
                  </div>
                  <div class="input-field col s2">
                    <input id="estado" type="text" class="validate" placeholder=" ">
                    <label for="estado" class="black-text">Estado</label>
                  </div>
                  <div class="input-field col s1">
                    <input id="ce" type="text" class="validate" placeholder=" ">
                    <label for="ce" class="black-text">C E</label>
                  </div>
                  <div class="input-field col s2">
                    <input id="municipio" type="text" class="validate" placeholder=" ">
                    <label for="municipio " class="black-text">Municipio</label>
                  </div>
                  <div class="input-field col s1">
                    <input id="cm" type="text" class="validate" placeholder=" ">
                    <label for="cm" class="black-text">C M</label>
                  </div>
                  <div class="input-field col s2">
                    <input id="ciudad" type="text" class="validate" placeholder=" ">
                    <label for="ciudad" class="black-text">Ciudad</label>
                  </div>
                  <div class="input-field col s3"> 
                      <select id="colonia">
                      </select>  
                      <label for="cm" class="black-text">Colonia</label>
                  </div>
                </div>
            </div>
      </div>

 
      
     
                  

    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/inventarios.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();

           

              //Busqueda por empresa
               $("#cp").keypress(function(e) {
                    //inicializamos variables
                  if(e.which == 13) {
                       var cp=$("#cp").val();  
                      inventarios({ opcion :7,cp:cp},respCp); 
                  }
                  else{
                  	$("#estado").val("");
                   $("#ce").val("");
                   $("#municipio").val("");
                   $("#cm").val("");
                   $("#ciudad").val("");
                  }
              });
        });

         var respCp = function(data) { 
                  console.log(data);
                  if (!data && data == null)
                  {
                      M.toast({html: 'El CP es erroneo', classes: 'rounded red'}); 
                      return;
                  }
                  var cp=$("#cp").val(); 
                   $("#estado").val(data[0].estado);
                   $("#ce").val(data[0].ce);
                   $("#municipio").val(data[0].municipio);
                   $("#cm").val(data[0].cm);
                   $("#ciudad").val(data[0].ciudad); 
                   var documento='<option selected>Colonias</option>';
                   $('#colonia').html(documento);
                  
                 inventarios({ opcion :8,cp:cp},respCpCol); 
                 
          }

          var respCpCol = function(data) { 
                  console.log(data);
                  if (!data && data == null)
                  {
                      M.toast({html: 'El CP es erroneo', classes: 'rounded red'}); 
                      return;
                  }
                  
                    var documento='<option selected>Colonias</option>';
    
                    for(var i=0; i<data.length; i++){
                        documento+='<option>'+data[i].colonia+'</option>';
                    } 
                    
                    $('#colonia').html(documento);
                    $('#colonia').formSelect(); 
                 
          }




    </script>
                
    </body>
</html>