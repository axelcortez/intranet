<!DOCTYPE html>
<html lang="en" >

   
<head>
    
        <meta charset="UTF-8">  
        <title>Captura Inventario</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
        
</head>
<link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onLoad="capturainv(),cargaAreas()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div>
    
        <h4 class="header " align="center" style="color:#1a237e;">Captura de Equipos</h4>
        <div class="row">
                <div class="row">
                    <div class="input-field col s10 offset-s1 l2 offset-l3">
                            <i class="material-icons prefix">business</i>
                            <select id="sucursalesdd">
                            </select>
                            <label>Sucursal</label>
                    </div>
                    <div class="input-field col s10 offset-s1  l2">
                    <i class="material-icons prefix">laptop_chromebook</i>
                        <select id="sltArea">
                        </select>
                        <label>Área</label>
                    </div>
                    <div class="input-field col s10 offset-s1  l2">
                    <i class="material-icons prefix">laptop_chromebook</i>
                        <select id="tiposequipos">
                        </select>
                        <label>Tipo de Equipo</label>
                    </div>

                </div>
                <div class="row">
                                <div class="input-field col l2 offset-l2 s5">
                                    <i class="material-icons prefix">description</i>
                                    <textarea id="num_equipo" class="materialize-textarea"></textarea>
                                    <label for="num_equipo"># de Equipo</label>
                                </div>
                                <div class="input-field col l6 s7">
                                    <i class="material-icons prefix">description</i>
                                    <textarea id="descripcion" class="materialize-textarea"></textarea>
                                    <label for="descripcion">Descripcion</label>
                                </div>
                </div>
                <div class="row">
                        <div class="input-field col s6 l2 offset-l2">
                            <i class="material-icons prefix">description</i>
                            <textarea id="marca" class="materialize-textarea"></textarea>
                            <label for="marca">Marca</label>
                        </div>
                        
                        <div class="input-field col s6 l3">
                            <i class="material-icons prefix">description</i>
                            <textarea id="modelo" class="materialize-textarea"></textarea>
                            <label for="modelo">Modelo</label>
                        </div>
                        <div class="input-field col l3 s12">
                            <i class="material-icons prefix">description</i>
                            <textarea id="serie" class="materialize-textarea"></textarea>
                            <label for="serie">Serie</label>
                        </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 l5 offset-l2">
                            <i class="material-icons prefix">date_range</i>
                            <input id="fecha_compra" type="date" class="validate">
                            <label for="fecha_compra">Fecha Compra</label>
                    </div>
                    <div class="input-field col s6 l3">
                            <i class="material-icons prefix">description</i>
                            <textarea id="valor_factura" class="materialize-textarea"></textarea>
                            <label for="valor_factura">Valor Factura</label>
                    </div>
                    <div class="col s12" align="center">
                            <a id="btnCrearinvequipo" class="waves-effect btn blue darken-4"><i class="material-icons left">add</i>Añadir</a>
                    </div>  
            </div>
        </div>





     <div id="modalAceptarDosEquipos" class="modal">
                <nav class="grey">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons left">add</i>Aceptar dos equipos
                        </a>
                    </div>
                </nav>
                <div class="modal-content" id="textoModal"> 
                   
                </div>
                <div class="row" >
                            <div class="col s6 right"    >
                            <a id="aceptarDobleTipo" class="waves-effect waves-light btn  accent-4 blue"><i class="material-icons left">done</i>Aceptar</a>
                                
                            </div>
                            <div class="col s6 "   >
                            <a id="cancelarDobleTipo" class="waves-effect modal-close waves-light btn right accent-4 red"><i class="material-icons left">close</i>Cancelar</a>
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
    <script type="text/javascript" src="../js/equipo.js"></script>
    <script type="text/javascript" src="../js/inventarios.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script> 

    
 
    </body>
</html>