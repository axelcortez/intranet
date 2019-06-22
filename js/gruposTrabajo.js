$(document).ready(function(){
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
         $('.modal').modal();

         
         $('.collapsible').collapsible();
         var elem = document.querySelector('.collapsible.expandable');
            var instance = M.Collapsible.init(elem, {
            accordion: false
            });

           
           
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    

    $("#btnAgregarActividades").click(function() {
       
        var titulo=$('#tituloActividad').val();
        if(titulo=="")
        {
            M.toast({html: 'Ingrese el titulo, porfavor!', classes: 'rounded red'});  
            return;
        }
        var fecha_ini=$('#fecha_inicioActividad').val();
        if(fecha_ini=="")
        {
            M.toast({html: 'Ingrese la fecha de inicio, porfavor!', classes: 'rounded red'});  
            return;
        }
        var fecha_fin=$('#fecha_finActividad').val();
        if(fecha_fin=="")
        {
            M.toast({html: 'Ingrese la fecha final, porfavor!', classes: 'rounded red'});  
            return;
        }
        var descripcion=$('#descripcionActividad').val();
        if(descripcion=="")
        {
            M.toast({html: 'Ingrese la descripcion, porfavor!', classes: 'rounded red'});  
            return;
        }
        var grupo_id=Cookies.get('b_grupo_id');
        var capturista_id=Cookies.get('b_capturista_id');
        grupos({ opcion : 13, grupo_id:grupo_id,titulo:titulo,descripcion:descripcion,fecha_ini:fecha_ini,fecha_fin:fecha_fin,capturista_id:capturista_id}, respInsertarActividad); 
    
    });

    $("#btnAgregarSubActividades").click(function() {
       
        var titulo=$('#tituloSubActividad').val();
        if(titulo=="")
        {
            M.toast({html: 'Ingrese el titulo, porfavor!', classes: 'rounded red'});  
            return;
        }
        var fecha_ini=$('#fecha_inicioSubActividad').val();
        if(fecha_ini=="")
        {
            M.toast({html: 'Ingrese la fecha de inicio, porfavor!', classes: 'rounded red'});  
            return;
        }
        var fecha_fin=$('#fecha_finSubActividad').val();
        if(fecha_fin=="")
        {
            M.toast({html: 'Ingrese la fecha final, porfavor!', classes: 'rounded red'});  
            return;
        }
        var descripcion=$('#descripcionSubActividad').val();
        if(descripcion=="")
        {
            M.toast({html: 'Ingrese la descripcion, porfavor!', classes: 'rounded red'});  
            return;
        }
        var capturista_id=$('#IdEmpleado').val();
        if(capturista_id=="")
        {
            M.toast({html: 'Ingrese empleado, porfavor!', classes: 'rounded red'});  
            return;
        }
        var act_id=Cookies.get('b_act_id');
        
        grupos({ opcion : 14, actividad_id:act_id,titulo:titulo,descripcion:descripcion,capturista_id:capturista_id,fecha_ini:fecha_ini,fecha_fin:fecha_fin,}, respInsertarSubActividad); 
    
    });

    
    $("#btnAceptarEditarProgreso").click(function() {
        var subactividad=Cookies.get('b_sub_id');
        
        grupos({ opcion : 16, subact_id:subactividad}, respVerifPorcentaje); 
        
      
    });
   
  
});

    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////

    function cargarGruposXid()
    {
        console.log("Funciona!");
        var capturista=Cookies.get('b_capturista_id');
        grupos({ opcion : 10, capturista_id:capturista}, respCargarGrupos); 
        cargarMenuPorRol();
    }
    
    function cargarActividades(grupo_id)
    {
        console.log("Click");
        Cookies.set("b_grupo_id", grupo_id);
        grupos({ opcion : 11, grupo_id:grupo_id}, respCargarActividades); 
     
    }

    function cargarSubActividades(act_id)
    {
        console.log("Click");
        Cookies.set("b_act_id", act_id);
        grupos({ opcion : 12, act_id:act_id}, respCargarSubActividades); 
     
    }

    function hacerAlgo()
    {
        console.log("HacerAlgo");
        
    }

    function crearActividad(id_grupo)
    {
        Cookies.set("b_grupo_id", id_grupo);
        var grupo_id=Cookies.get('b_grupo_id');
        console.log("GRUPO= "+grupo_id);
    }
    function crearSubactividad(id_actividad)
    {
        Cookies.set("b_act_id", id_actividad);
        var actividad_id=Cookies.get('b_act_id');
        console.log("Actividad= "+actividad_id);
    }

    function buscaEmpleados()
    {
        var bus= $("#nombreAbuscar").val();
        if (bus.length>2)
        {
            document.getElementById('listaEmpleados').style.display = 'block';
            onRequest({ opcion : 84 ,nombre:bus}, respBuscarEmpleados);
        }
        else
        {
            document.getElementById('listaEmpleados').style.display = 'none';
            $("#IdEmpleado").val("");
        }
        console.log("Buscando texto:"+bus);
        
    }
    function agregarAdiv(id_empleado)
    {  
        
        document.getElementById('listaEmpleados').style.display = 'none';
        $("#IdEmpleado").val(id_empleado);
        var id=$("#IdEmpleado").val();
        onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdiv);

    }
    
    function cargarIDSubActividad(sub_id)
    {  
        
        Cookies.set("b_sub_id", sub_id);

        var subActividad=Cookies.get('b_sub_id');
        console.log("SubActividad: "+subActividad);

    }

    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////

    var respBuscarEmpleados = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }
        
        var d='';
        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].descripcion);
            if(nombre=="undefined")
             {
                d+= '<tr>'+
                '<td>Sin coincidencias.</td>'+
                "<td> <a onclick='CerrarYborrarDiv();' class='waves-effect waves-light btn-floating btn-small black'><i class='large material-icons'>mood_bad</i></a> " +
                '<td class="left">'+ 
                '</tr> ';  
                
             }
             else
             {
                d+="<tr> <td>"+data[i].id+" - "+data[i].descripcion+" </td>" 
                +"<td> <a onclick='agregarAdiv("+data[i].id+");' class='waves-effect waves-light btn-floating btn-small blue'><i class='material-icons'>add</i></a> " +
                "</td> </tr> ";
             }
            
            
        }
    
        $("#listaEmpleados").addClass("espacioClientes");
        $("#listaEmpleadosTabla").html(d);
    }

    var respCargarGrupos = function(data)
    {
        if (!data && data == null) 
        return; 

        var txt="";
        if(data[0].id_grupo>0)
        {
            for(var i=0;i<data.length;i++)
            {
                txt += '<li>'+
                '<div onClick="cargarActividades('+data[i].id_grupo+')" class="collapsible-header"><i class="material-icons">chevron_right</i>'+data[i].grupo+'</div> '+
                '<div class="collapsible-body" >'+
                '<div class="row">'+
                '<div class="col s12 m12">'+
                '<a onClick="crearActividad('+data[i].id_grupo+')" href="#modalCrearActividad" class="btn-floating btn-small waves-effect waves-light red right modal-trigger"><i class="material-icons">add</i></a>'+
                '</div>'+
                '<div class="col s12 m12">'+
                '    <ul class="collapsible" data-collapsible="accordion" id="grupo'+data[i].id_grupo+'">'+
                '    </ul>'+
                '   </div>'+
                '</div>';
                '</div>'+
                '</li>';
            }

        }
        else
        {
            txt="Sin actividades";
        }
        
        $("#c_grupos").html(txt);
        $('.collapsible').collapsible();

    }

    

    var respCargarActividades = function(data)
    {
        if (!data && data == null) 
        return; 

        var txt="";
        var texto = data.length;
        
        var grupo_id=Cookies.get('b_grupo_id');
        
        if(texto>0)
        {
            for(var i=0;i<data.length;i++)
            {
                txt += '<li>'+
                '<div align="right">'+
                data[i].porcentaje+'%'+
                '</div>'+
                '            <div onClick="cargarSubActividades('+data[i].act_id+')"  class="collapsible-header">'+
                '               <i class="material-icons">chevron_right</i>Actividad '+(i+1)+' ->' +data[i].titulo+'</div>'+
                '<div class="collapsible-body" >'+
                '<div class="row">'+
                '<div class="col s12 m12">'+
                '<a class="waves-effect waves-light btn-small red darken-4  right"><i class="material-icons i">delete</i>Borrar Actividad</a> '+
                '<a class="waves-effect waves-light btn-small blue darken-3 right"><i class="material-icons i">assignment_turned_in</i>Finalizar Actividad</a>'+
                '<a onClick="crearSubactividad('+data[i].act_id+')" href="#modalCrearSubactividad" class="btn-floating btn-small waves-effect waves-light red right modal-trigger"><i class="material-icons">add</i></a>'+
                '</div>'+
                '<div class="col s12 m12">'+
                '    <ul class="collapsible" data-collapsible="accordion" id="actividad'+data[i].act_id+'">'+
                '    </ul>'+
                '</div>'+
                '</div>';
                '</div>'+
                '        </li>';
                
            }
        }
        else
        {
            txt += '<li>'+
            '            <div class="collapsible-header">'+
            '               <i class="material-icons">close</i> Sin Actividades </div>'+
            '        </li>';
        }
      
        $("#grupo"+grupo_id).html(txt);
        $('.collapsible').collapsible();
        

    }
    

    var respCargarSubActividades = function(data)
    {
        if (!data && data == null) 
        return; 

        var txt="";
        var texto = data.length;
        
        var actividad_id=Cookies.get('b_act_id');
        
        if(texto>0)
        {
            for(var i=0;i<data.length;i++)
            {
                if(data[i].porcentaje>=100)
                {
                    txt += '<li>'+
                    '<div align="right">'+
                    data[i].porcentaje+'%'+
                    '</div>'+
                    '            <div class="collapsible-header">'+
                
                    '               <i class="material-icons">chevron_right</i>'+data[i].capturista+' -> '+data[i].titulo +
                    '            </div>'+
                    '       </li>';
                }
                else
                {
                    txt += '<li>'+
                    '<div align="right">'+
                    data[i].porcentaje+'%'+
                    '</div>'+
                    '            <div class="collapsible-header">'+
                
                    '               <i class="material-icons">chevron_right</i>'+data[i].capturista+' -> '+data[i].titulo +
                    '            </div>'+
                    '           <div class="collapsible-body" >'+
                    '               <div class="row">'+
                    '                   <div class="col s12 m12">'+
                    '                   <a onClick="cargarIDSubActividad('+data[i].sub_id+')" href="#modalEditarProgreso" class="btn-floating btn-small waves-effect waves-light indigo darken-4 right modal-trigger"><i class="material-icons">assignment</i></a>'+
                    '                   </div>'+
                    '               </div>'+
                    '           </div>'+
                    '       </li>';
                }
                
                
            }
        }
        else
        {
            txt += '<li>'+
            '            <div class="collapsible-header">'+
            '               <i class="material-icons">close</i> Sin SubActividades </div>'+
            '        </li>';
        }
        
        $("#actividad"+actividad_id).html(txt);
        $('.collapsible').collapsible();
        

    }

    var respInsertarActividad = function (data)
    {
        if (!data && data == null) 
        return; 
        M.toast({html: 'Actividad insertada correctamente!', classes: 'rounded green'});  
        location.reload();
    }
    var respInsertarSubActividad = function (data)
    {
        if (!data && data == null) 
        return; 
        M.toast({html: 'Subactividad insertada correctamente!', classes: 'rounded green'});  
        
        var actividad_id=Cookies.get('b_act_id');
        grupos({ opcion : 18, act_id:actividad_id}, respRecalcularPorcentajeActividad); 
    }
    var respAgregarNombreAdiv = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }
    
        var nombre=data[0].nombre;
        $("#nombreAbuscar").val(nombre);
        
    }
    var respVerifPorcentaje = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }
    
        
        var descripcion=$('#descripcionEditActividad').val();
        console.log("comentario: "+descripcion);
        var porcentaje=$('#porcentajeActividad').val();
        console.log("porcentaje: "+porcentaje);
        if(descripcion=="")
        {
            M.toast({html: 'Ingrese un comentario, porfavor!', classes: 'rounded red'});  
            return;
        }

        var porcentaje=parseInt($('#porcentajeActividad').val());
        if(porcentaje=="")
        {
            M.toast({html: 'Ingrese el porcentaje, porfavor!', classes: 'rounded red'});  
            return;
        }

        var porcentajeTotalSubActividad=parseInt(data[0].porcentaje);
        var suma=porcentajeTotalSubActividad+porcentaje;
        console.log("La suma es:"+suma);
        $('#porcentajeActividad2').val(suma);
        if(suma>100)
        {
            M.toast({html: 'La actividad ya llego o sobre pasa el 100%!', classes: 'rounded red'});  
            return;
        }
        else
        {
            var subActividad=Cookies.get('b_sub_id');
            var capturista_id=Cookies.get('b_capturista_id');
            grupos({ opcion : 15, porcentaje:porcentaje,comentario:descripcion, id_subActividad:subActividad,capturista_id:capturista_id}, respAgregarComentSub); 
        }

        
    }

    var respAgregarComentSub = function (data)
    {
        if (!data && data == null) 
        return; 
        M.toast({html: 'Comentario insertado correctamente!', classes: 'rounded green'});  
        var descripcion=$('#descripcionEditActividad').val();
        var subActividad=Cookies.get('b_sub_id');
        
        var suma=parseInt($('#porcentajeActividad2').val());
        //location.reload();
        grupos({ opcion : 17, porcentaje:suma,comentario:descripcion, id_subActividad:subActividad}, respActualizarPorcentaje); 
    }
    

    var respActualizarPorcentaje = function (data)
    {
        if (!data && data == null) 
        return; 
        M.toast({html: 'Y Comentario actualizado correctamente!', classes: 'rounded green'});  

        var actividad_id=Cookies.get('b_act_id');
        grupos({ opcion : 18, act_id:actividad_id}, respRecalcularPorcentajeActividad); 
    }

    var respRecalcularPorcentajeActividad = function (data)
    {
        if (!data && data == null) 
        return; 
        
        console.log("Recalculando porcentaje de la actividad");
        var suma=0;

        for(var i=0; i<data.length;i++)
        {
            suma=suma+parseInt(data[i].porcentaje);
        }

        
        var porcentaje=(suma/data.length).toFixed(2);
        console.log("SUMA= "+suma+" lenght="+data.length+" Porcentaje= "+porcentaje);
        var actividad_id=Cookies.get('b_act_id');
        grupos({ opcion : 19, porcentaje:porcentaje,act_id:actividad_id}, respAjustarPorcentajeEnActividad); 
    }

    var respAjustarPorcentajeEnActividad = function (data)
    {
        if (!data && data == null) 
        return; 
        M.toast({html: 'Porcentaje de actividad actualizado correctamente!', classes: 'rounded green'});  

        setTimeout(location.reload(),3000);
    }
    








   