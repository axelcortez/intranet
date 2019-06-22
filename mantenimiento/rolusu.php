<!DOCTYPE html>
<html lang="en" >

<head>
    
        <meta charset="UTF-8">  
        <title>Configuracion de los roles de usuarios</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">
        <link rel="icon" type="image/png" href="../img/favicon.ico" /> 
</head>
    <body onLoad="cargarConfUsuarios()">
    
     <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
                <div class="row">
                    <div class="nav-wrapper">
                        <?php
                            include('../menu/menu.php');
                        ?> 
                        <h4 class="header" style="color:#1a237e;">Configuracion usuarios</h4>
                        <hr>
                    </div>
                </div>
            </div>
           
            <div class="row">
                   
                    <div class="input-field col s4">
                            <select id="UsuariosDD2"> 
                            </select>
                            <label><strong>Seleccione el usuario: </strong></label>
                    </div>
                   
                    <div class="input-field col s4">
                            <select id="tipoRolAc"> 
                            </select>
                            <label><strong>Seleccione el Rol:</strong></label>
                    </div>
                    <div class="input-field col s4">
                            <select id="tipoEmpresaAddFile"> 
                            </select>
                            <label><strong>Seleccion la Empresa:</strong></label>
                    </div>
                    <div class="col s5 offset-s1">
                        <table class="highlight">

                                <thead> 
                                    <tr>
                                        <th>Roles</th> 
                                        <th>Acciones</th>
                                    </tr>
                                    
                                </thead> 

                                <tbody id="tablaRolUsuario">
                                
                                </tbody>
                        </table>
                    </div>
                    <div class="col s5">
                    <table class="highlight">
                            <thead>
                            <tr>
                        
                                <th>Empresas</th>
                                <th>Acciones</th>
                                
                            </tr>
                            </thead>

                            <tbody id="tablaEmpUsuario">
                            
                            </tbody>
                    </table>
                    </div>
                   
            </div> 
            <div class="col s2 center">
                                <p><label><input type="checkbox" id="cbEntregadoUsuario" onChange="EntregaUsuario()"/><span>Entregado</span></label></p>
                            </div>
            <div align="center">
                 <a id="btnAgregarUsu_Rol" class="waves-effect waves-light btn light-blue darken-4"><i class="material-icons left">add_circle_outline</i>Agregar Rol</a>
            </div>
            <div><br></br></div>
            <div align="center">
                 <a id="btnAgregarUsu_Empresa" class="waves-effect waves-light btn light-blue darken-4"><i class="material-icons left">add_circle_outline</i>Agregar Empresa</a>
            </div>
            <div><br></br></div>
            <div align="center">
                 <a id="btn_regresar_rolusu" class="waves-effect waves-light btn light-blue darken-4"><i class="material-icons left">replay</i>Regresar</a>
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