<!DOCTYPE html>
<html lang="en" >
    <head>
        
            <meta charset="UTF-8">  
            <title>Agenda de Actividades</title>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css"> 
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
            
    </head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" /> 
    <body onload="cargarGruposXid()">
        <div id="container" ><!-- CONTENEDOR 1 -->
            <div class="nav-wrapper">
            <?php
                    include('../menu/menu.php');
                ?>
            </div>
            <h3 class="header " align="center" style="color:#1a237e;">Agenda de Actividades</h3> 

            <div class="row">
                <div class="col l10 s12 offset-l1" >
                    <ul class="collapsible expandable" id="c_grupos">
                       
                    </ul>
                </div>
            </div>

            
        </div>
        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/bancaprepa.js"></script>
        <script type="text/javascript" src="../js/js.cookie.js"></script>
        <script type="text/javascript" src="../js/fondoAhorro.js"></script>
        <script type="text/javascript" src="../js/gruposTrabajo.js"></script>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script> 

        <div id="modalCrearActividad" class="modal">
                <nav class="indigo darken-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons">add</i>Crear Actividad
                        </a>
                    </div>
                </nav>
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col l5 s12 m12">
                            <i class="material-icons prefix">book</i>
                            <input id="tituloActividad" type="text" class="validate">
                            <label for="tituloActividad">Titulo</label>
                        </div>
                        <div class="input-field col l3 s6 m6">
                            <i class="material-icons prefix">developer_board</i>
                            <input id="fecha_inicioActividad" type="date">
                            <label for="fecha_inicioActividad">Fecha inicio</label>
                        </div>
                        <div class="input-field col l3 s6 m6">
                            <i class="material-icons prefix">developer_board</i>
                            <input id="fecha_finActividad" type="date">
                            <label for="fecha_finActividad">Fecha fin</label>
                        </div>
                        <div class="input-field col s12 l12 m12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea id="descripcionActividad" class="materialize-textarea"></textarea>
                            <label for="descripcionActividad">Descripcion</label>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
                    <a id="btnAgregarActividades" class= "modal-action waves-effect waves-green btn-small indigo darken-4 right">Agregar</a>
                </div>
        </div>

        

        <div id="modalCrearSubactividad" class="modal">
                <nav class="indigo darken-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons">add</i>Crear Subactividad
                        </a>
                    </div>
                </nav>
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col l5 s12 m12">
                            <i class="material-icons prefix">book</i>
                            <input id="tituloSubActividad" type="text" class="validate">
                            <label for="tituloSubActividad">Titulo</label>
                        </div>
                        <div class="input-field col l3 s6 m6">
                            <i class="material-icons prefix">developer_board</i>
                            <input id="fecha_inicioSubActividad" type="date">
                            <label for="fecha_inicioSubActividad">Fecha inicio</label>
                        </div>
                        <div class="input-field col l3 s6 m6">
                            <i class="material-icons prefix">developer_board</i>
                            <input id="fecha_finSubActividad" type="date">
                            <label for="fecha_finSubActividad">Fecha fin</label>
                        </div>
                        <div class="input-field col s12 l12 m12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea id="descripcionSubActividad" class="materialize-textarea"></textarea>
                            <label for="descripcionSubActividad">Descripcion</label>
                        </div>
                    </div> 
                    <div class="row">
                        
                        <div class="input-field col l7 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nombreAbuscar" type="text" class="validate" placeholder="Nombre" onkeyup="buscaEmpleados()"/>
                            <label for="nombreAbuscar">Nombre</label>
                        </div>
                        <div class="input field col l1 s1">
                            <label for="Id" class="activate"></label>
                            <input placeholder="Id" id="IdEmpleado" type="text" class="validate" style='display:none;' >
                        </div>
                        <div class="input field col l7 s12" id="listaEmpleados">
                            <table class="highlight">
                                <tbody id="listaEmpleadosTabla">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
                    <a id="btnAgregarSubActividades" class= "modal-action waves-effect waves-green btn-small indigo darken-4 right">Agregar</a>
                </div>
        </div>
        <div id="modalEditarProgreso" class="modal">
                <nav class="indigo darken-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                            <i class="large material-icons">assignment</i>Editar Progreso
                        </a>
                    </div>
                </nav>
                <div class="modal-content">
                    <div class="row">
                        <div class="input-field col s12 l12">
                            <i class="material-icons prefix">assignment</i>
                            <textarea id="descripcionEditActividad" class="materialize-textarea"></textarea>
                            <label for="descripcionEditActividad">Comentario</label>
                        </div>
                        <div class="input-field col l2 s6">
                            <i class="material-icons prefix">show_chart</i>
                            <input placeholder="Porcentaje" id="porcentajeActividad" type="text" class="validate">
                            <label for="porcentajeActividad">Porcentaje</label> 
                        </div>
                        <div class="input-field col l3 s6 m6" style='display:none;'>
                            <i class="material-icons prefix">show_chart</i>
                            <input   placeholder="Porcentaje" id="porcentajeActividad2" type="text" class="validate">
                            <label for="porcentajeActividad2">Porcentaje</label> 
                        </div>
                        <div class="input-field col l2">
                           <p>%</p>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="#!" class= " modal-action modal-close waves-effect waves-green btn-flat left">Cerrar</a>
                    <a id="btnAceptarEditarProgreso" class= "modal-action waves-effect waves-green btn-small indigo darken-4 right">Aceptar</a>
                </div>
        </div>

        

    
    </body>
</html>