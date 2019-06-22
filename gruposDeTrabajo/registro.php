<!DOCTYPE html>
<html lang="en" >

   
<head>

    
        <meta charset="UTF-8">  
        <title>Captura Inventario</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bancaprepa.css">  
        
</head>
<link  /> 
    <body onload="cargarControlesGrupos()">
    <div id="container" ><!-- CONTENEDOR 1 -->
        <div class="nav-wrapper">
           <?php
                include('../menu/menu.php');
            ?>
        </div> 
        <h4 class="header " align="center" style="color:#1a237e;">Grupos de Trabajo</h4>
        <hr> 

        <div class="container" class="revelate">
            <div class="row">
                <div class="col s12">
                   <button class="btn waves-effect waves-light right green pulse modal-trigger" onclick="cargarIntegrantesTmpDeGrupo()" data-target="registroGrupo" type="submit" name="action">NUEVO GRUPO
                      <i class="material-icons right">send</i>
                    </button>
                </div>
              
            </div>

             <table>
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Lider</th>
                      <th># Integrantes</th>
                      <th>Fecha Creacion</th>
                      <th>Acciones</th>
                  </tr>
                </thead>

                <tbody id="tb_gruposDeTrabajo"> 
                </tbody>
              </table>
        </div>


    </div><!-- CONTENEDOR 1 -->
    <?php
                include('modals.php');
            ?>
 

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
            $('.modal').modal({dismissible: false}); 

            onRequest({ opcion : 70 }, respcargasucursales); 


        });

      //funciones
      function cargarControlesGrupos(){
        grupos({ opcion : 1}, respListaEmpleadosActivos); 
        cargarGruposCreados();
      }
      //removemos la clase
      function mostrarLista(){
        document.getElementById('listaEspecial').classList.remove('divEspecial'); 
      }
      //agregamos la clase
      function ocultarLista(){
        document.getElementById('listaEspecial').classList.add('divEspecial'); 
      }
      //buscar empleado por nombre
      function buscarEmpleado(empleado){

        if(empleado.length>0){
          grupos({ opcion : 2,empleado:empleado}, respListaEmpleadosActivos); 
        }
        if(empleado.length<1){
          grupos({ opcion : 1}, respListaEmpleadosActivos); 
        } 
      }
      
      //selecccionar empleado por id 
      function seleccionarEmpleado(empleado){

        console.log(empleado)
         let capturista = listaEmpleados[empleado][0].capturista;

         document.getElementById('empleadoGrupo').value = capturista;
          ocultarLista()
          grupos({ opcion : 1}, respListaEmpleadosActivos); 
      }

      //cerramos la lista
      function cerrarLista(){
         ocultarLista()
         document.getElementById('empleadoGrupo').value = "";
          grupos({ opcion : 1}, respListaEmpleadosActivos); 
      }

      //agregar empleado al grupo
      function agregarEmpleadoAGrupo(){
          let empleado_id  =  document.getElementById('empleadoGrupo').value;
          empleado_id= empleado_id.split(' ',1); 

          grupos({ opcion : 3,empleado_id:empleado_id[0]}, respAgregarEmpleadoAGrupo); 
      }

      //cargar integrantes del grupo
      function cargarIntegrantesTmpDeGrupo(){
        grupos({ opcion : 4}, respEmpleadosEnGrupo);
      }

      //eliminar integrantes
      function eliminarIntegrante(integrante_id){
        grupos({ opcion : 5,integrante_id:integrante_id}, respEmpleadosEnGrupo);
      }

      // guardar grupo de trabajo

      function guardarGrupoDeTrabajo(){
            let nombreGrupo =document.getElementById('nombreGrupo').value.toUpperCase(); 
 
            if(nombreGrupo.length<5)
            {
              M.toast({html: 'El nombre del grupo no es correcto.', classes: 'rounded red'})
                return;
            }else{
                
                /*if(fechaInicio=='' || fechaFinal =='' || fechaFinal<fechaInicio)
                    return M.toast({html: 'Las fechas no son correctas.', classes: 'rounded red'})*/
 
                  grupos({ opcion : 6,nombre:nombreGrupo,fecha_inicial:'',fecha_final:''}, respGuardarGrupo);
            }
      }

      //funcion para cargar los grupos
      function cargarGruposCreados(){
          grupos({ opcion : 7}, respGruposCreados);
      }

      //ver detalle del grupo de trabajo 
      function verDetalleGrupoTrabajo(grupo_id){
          $("#detalleGrupo").modal('open');
          grupos({ opcion : 9,grupo_id:grupo_id}, respDetalleGrupo);
      }

      var listaEmpleados = []
      //respuestas
      var respListaEmpleadosActivos = function(data) { 
            if (!data && data == null)
                return; 
 
 
            listaEmpleados = []
            let cadena =`<table class="bordered"><tr class='subrallar-tabla' onclick='cerrarLista()'><td>                </td></tr>`;
    
                for(var i=0; i<data.length; i++){

                    listaEmpleados[data[i].capturista_id] =[{capturista_id:data[i].capturista_id,capturista:data[i].capturista,correo:data[i].correo}]
                    cadena +=`<tr class='subrallar-tabla' onclick='seleccionarEmpleado(${data[i].capturista_id})'><td>${data[i].capturista}</td></tr>`;
                    
                } 
                cadena+='</table>'
            
            document.getElementById('listaEspecial').innerHTML  =cadena;
      }

      //respuestas
      var respAgregarEmpleadoAGrupo = function(data) { 
            if (!data && data == null)
                return;   

            console.log(data)
  
             switch(data[0].respuesta){

                  case 1:
                        grupos({ opcion : 4}, respEmpleadosEnGrupo);
                    break
                  case 2:

                    break
             }
      }

      //respuestas
      var respEmpleadosEnGrupo = function(data) { 
            if (!data && data == null)
                return;   
  
            let cadena ='';
    
                for(var i=0; i<data.length; i++){
 
                    cadena +=`<tr class='subrallar-tabla' ><td>${data[i].capturista_id}</td><td>${data[i].capturista}</td><td>${data[i].correo}</td><td><a class="btn-floating btn-small waves-effect waves-light red" onclick='eliminarIntegrante(${data[i].capturista_id})'><i class="material-icons">remove</i></a></td></tr>`;
                    
                }  
            
            document.getElementById('tb_integrantes').innerHTML =cadena;
      }

      var respGuardarGrupo = function(data){
            if (!data && data == null)
                return;  

              console.log(data)

              switch(data[0].respuesta){
                    case 1:
                          M.toast({html: 'El grupo se guardo correctamente.', classes: 'rounded green'})  
                          cargarGruposCreados();
                          $('#registroGrupo').modal('close'); 
                          document.getElementById('nombreGrupo').value='';
                      break
                    case 2:
                       return   M.toast({html: 'El grupo necesita almenos un integrante.', classes: 'rounded red'}) 
                      break
              }
      }

      var respGruposCreados = function(data) { 
            if (!data && data == null)
                return;   
  
            let cadena ='';
    
                for(var i=0; i<data.length; i++){
 
                    cadena +=`<tr class='subrallar-tabla' ><td>${data[i].grupo_id}</td><td>${data[i].grupo}</td><td>${data[i].lider}</td><td class="center">${data[i].integrantes}</td><td>${data[i].fecha_registro}</td><td><a class="btn-floating btn-small waves-effect waves-light blue" onclick='verDetalleGrupoTrabajo(${data[i].grupo_id})'><i class="material-icons">format_align_justify</i></a></td></tr>`;
                    
                }  
            
            document.getElementById('tb_gruposDeTrabajo').innerHTML =cadena;
      }

      var respDetalleGrupo = function(data) { 
            if (!data && data == null)
                return;   

              document.getElementById('dNombreGrupo').value=data[0].grupo
  
            let cadena ='';
    
                for(var i=0; i<data.length; i++){
 
                    cadena +=`<tr><td>${data[i].capturista_id}</td><td>${data[i].capturista}</td><td>${data[i].correo}</td><td>${data[i].estatus}</td></tr>`;
                    
                }  
            
            document.getElementById('tb_integrantes_estatus').innerHTML =cadena;
      }

    </script>  
    
    </body>
</html>