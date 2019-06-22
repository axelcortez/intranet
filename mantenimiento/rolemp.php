<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Configuracion de los roles por empresa</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
</head>
    <body onLoad="cargarConfEmpresa()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
                <div class="row">
                    <div class="nav-wrapper">
                        <?php
                            include('../menu/menu.php');
                        ?> 
                        <h4 class="header" style="color:#1a237e;">Configuracion de empresas</h4>
                        <hr>
                    </div>
                </div>
            </div>
           
            <div class="row" align="center">            
 
            
                    
                    <div class="input-field col s4">
                            <select id="Empresarol"> 
                            </select>
                            <label><strong>Seleccion la Empresa:</strong></label>
                    </div>
                    <div class="input-field col s4">
                            <select id="tipoPuestoAc"> 
                            </select>
                            <label><strong>Seleccione el puesto:</strong></label>
                            <div><br></br></div>
                            <div align="center">
                                <a id="btnAgregarEmp_Rol" class="waves-effect waves-light btn light-blue darken-4"><i class="material-icons left">add_circle_outline</i>Agregar puesto</a>
                            </div>
                    </div>
                    <div class="col s3">
                                <a id="btn_regresar_rolemp" class="waves-effect waves-light btn light-blue darken-4"><i class="material-icons left">replay</i>Regresar</a>
                            </div>     
                    <div class="col s9 offset-s1 scroller2">
                        <table class="highlight">

                                <thead> 
                                    <tr>
                                        <th>Puestos</th> 
                                        <th>Acciones</th>
                                    </tr>
                                    
                                </thead> 

                                <tbody id="tablaRolEmpresa">
                                
                                </tbody>
                        </table>
                    </div>           
            </div> 
          
            
          
                    
           
           
     </div>

                  

    <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/js.cookie.js"></script>
    <script type="text/javascript" src="../js/bancaprepa.js"></script>
   

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
     <!-------------------- Inicializar modal-------------------------->
    <script>
            $(document).ready(function(){
                 $('.modal').modal();
            });
    </script>
                
    </body>
</html>