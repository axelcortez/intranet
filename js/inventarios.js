$(document).ready(function(){
///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
     $('.modal').modal();
///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
     $("#btnAgrArea").click(function() {

        var nombreArea=$("#txtArea").val().toUpperCase(); 

        if(nombreArea==""){
            M.toast({html: 'Es ecesario ingresar nombre de área.', classes: 'rounded red'}); 
            return;
        } 
        inventarios({ opcion : 1,area_id:0, nombre_area:nombreArea},respAgregaAreas);
         $("#modalAgregarArea").modal("close");

    });

     $("#btnEditArea").click(function() {

        var idArea=$("#idArea").val(); 
        var nombreArea=$("#txtAreaEdit").val().toUpperCase(); 

        if(nombreArea==""){
            M.toast({html: 'Es ecesario ingresar nombre de área.', classes: 'rounded red'}); 
            return;
        } 
        inventarios({ opcion : 1,area_id:idArea,nombre_area:nombreArea},respAgregaAreas);
        $("#modalEditarArea").modal("close");  

    });

    $("#btnDesArea").click(function() {

        var idArea=$("#idAreaDes").val();   
        inventarios({ opcion : 4,area_id:idArea},respDeshabilitarAreas);  
        $("#modalDeshabArea").modal("close");

    });

    $("#btnDelArea").click(function() {

        var idArea=$("#idAreaEliminar").val();  
        inventarios({ opcion : 5,area_id:idArea},respEliminarAreas); 
        $("#modalEliminarArea").modal("close");

    });


});

///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
 var respAgregaAreas = function(data) { 
        console.log(data);
        if (!data && data == null)
        {
            M.toast({html: 'Error al registrar Área', classes: 'rounded red'}); 
            return;
        }
        
        M.toast({html: 'Área agregada correctamente.', classes: 'rounded green'}); 
        
         cargarAreas();

       
}

 var respCargarAreas = function(data) {  
        if (!data && data == null)
        {
            M.toast({html: 'Error al registrar Área', classes: 'rounded red'}); 
            return;
        }
         
        var documento='';

        for (var i = 0; i < data.length; i++) {
              documento+= '<tr>'+
                 '<td>'+data[i].area_id+'</td>'+
                 '<td>'+data[i].descripcion+'</td>'+
                 '<td>'+data[i].estatus+'</td>'+ 
                 '<td class="left">'+
                 '<a onclick="buscarArea('+data[i].area_id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarArea"><i class="material-icons">edit</i></a>' + 
                 '<a onclick="buscarArea('+data[i].area_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabArea"><i class="material-icons">do_not_disturb_alt</i></a>' + 
                 '<a onclick="buscarArea('+data[i].area_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarArea"><i class="material-icons">delete</i></a>' +
                 '</td>'  +'</tr> ';
             }
    
       $("#tablaAreas").html(documento);
}

 var respBuscarArea = function(data) {  
        if (!data && data == null)
        {
            M.toast({html: 'Error al registrar Área', classes: 'rounded red'}); 
            return;
        }
       $("#idArea").val(data[0].area_id);
       $("#txtAreaEdit").val(data[0].descripcion);
       $("#idAreaDes").val(data[0].area_id);
       $("#nomAreaDes").val(data[0].descripcion);
       $("#idAreaEliminar").val(data[0].area_id);
       $("#nomAreaEliminar").val(data[0].descripcion);

}

var respDeshabilitarAreas =function(data){
    cargarAreas();
}

var respEliminarAreas =function(data){
    cargarAreas();
}

 var respCargaAreas = function(data) {  
        if (!data && data == null)
        {
            M.toast({html: 'Error al registrar Área', classes: 'rounded red'}); 
            return;
        }
         
        var documento='<option  disabled selected>Seleccione Área</option>';

        for (var i = 0; i < data.length; i++) {
              documento+= '<option value="'+data[i].area_id+'">'+data[i].descripcion+'</option>';
             }
    
       $("#sltArea").html(documento);
        $('#sltArea').formSelect();
}


///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////

function cargarAreas(){ 
    inventarios({ opcion : 2},respCargarAreas);
    cargarMenuPorRol();
}

function buscarArea(area_id){
    console.log(area_id)
    var area='';
    inventarios({ opcion : 3,area_id:area_id,area:area},respBuscarArea);
}

function cargaAreas(){
    inventarios({ opcion : 2},respCargaAreas);
}