$(document).ready(function(){

    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });

    $("#BtnAgregarEquipo").click(function() {
        var nombreEquipo='';
        nombreEquipo = $("#nomequipo").val();

        if(nombreEquipo==""){
            M.toast({html: 'Necesario ingresar nombre de equipo.', classes: 'rounded red'}); 
            return;
        }
        console.log("Presionaste el boton del modal para agregar equipo: "+nombreEquipo);
        onRequest({ opcion : 69, descripcion:nombreEquipo},respAgregaEquipo);

    });

    $("#BtnBusquedaEquipo").click(function() {
        
        console.log("Presionaste el boton para buscar");
        var idEquipo = $("#id_equipo").val();
        var sucursal_id = $("#sucursalesdd").val();
        var num_equipo = $("#num_equipo").val();
        var area_id = $("#sltArea").val();
       
        console.log("id:"+ idEquipo+" sucursal:"+sucursal_id+" tipo:"+ num_equipo+" area: "+area_id);
        
        

        onRequest({ opcion : 77 ,id:idEquipo, sucursal:sucursal_id, numequipo:num_equipo, area_id:area_id }, respCargarEquipos);


    });
    $("#BtnLimpiaBusEquipo").click(function() {
        
        onRequest({ opcion : 70 }, respcargasucursales);
        $("#num_equipo").val("");
        $("#id_equipo").val("");
        inventarios({ opcion : 2},respCargaAreas);    

        onRequest({ opcion : 77 ,id:"", sucursal:"", numequipo:"", area_id:"" }, respCargarEquipos);


    });

    
    $("#btnDesEquipo").click(function() {
        
        console.log("Presionaste el boton para dar de baja");
        var idEquipo = $("#idEquipoDes").val();
        var notacancelacion = $("#descDes").val().toUpperCase();
        
        if(notacancelacion=="" )
        {
            M.toast({html: 'Favor de ingresar la nota de cancelacion, por favor.', classes: 'rounded red'}); 
            return;
        }
       
        console.log("id:"+ idEquipo+" nota de cancelacion:"+notacancelacion);
        
        onRequest({ opcion : 83 ,equipo_id:idEquipo, descripcion:notacancelacion}, respBajaEquipos);


    });

    $("#aceptarDobleTipo").click(function() {

        var sucursal_id=$("#sucursalesdd").val();
        var tipo_equipo=$("#tiposequipos").val();
        var num_equipo=$("#num_equipo").val();
        var descripcion=$("#descripcion").val().toUpperCase();
        var marca=$("#marca").val().toUpperCase();
        var modelo=$("#modelo").val().toUpperCase();
        var serie=$("#serie").val().toUpperCase();
        var fecha_compra=$("#fecha_compra").val();
        var valor_factura=$("#valor_factura").val();
        var capturistaid=Cookies.get('b_capturista_id');
        var area_id=$("#sltArea").val();
        

    
        onRequest({ opcion : 72, sucursal_id:sucursal_id, tipo_equipo:tipo_equipo,num_equipo:num_equipo, 
            descripcion:descripcion,marca:marca, modelo:modelo,serie:serie, fecha_compra:fecha_compra, 
            valor_factura:valor_factura, capturista:capturistaid,area_id:area_id},respCrearinvequipo);
        
        $("#modalAceptarDosEquipos").modal("close");

    });

    

    $("#btnReporteExcel").click(function() {

        console.log("presionado excel");
        //descargarExcel();
        fnExcelReport();

    });

    $("#btnExcelInventario").click(function() {

        console.log("presionado excel");
        //descargarExcel();
        fnExcelReportInventario();

    });

    $("#cerrarYactualizarModalResp").click(function() {
        onRequest({ opcion : 70 }, respcargasucursales);

        onRequest({ opcion : 71 }, respcargatiposequipo);

        var idEquipo = $("#id_equipo").val();
        var sucursal_id = String($("#sucursalesdd").val());
        var num_equipo = $("#num_equipo").val();
        var areaid = $("#sltArea").val();

        onRequest({ opcion : 77 ,id:idEquipo, sucursal:sucursal_id, numequipo:num_equipo, area_id:areaid }, respCargarEquipos);
    });
    
    $("#btnEditarEquipo").click(function() {
        
        console.log("Presionaste el boton para editar");
        var idEquipo = $("#idEquipoEdit").val();
        var desc = $("#descEdit").val().toUpperCase();
        var numeroE = $("#numEquipo").val();
        var marca =  $("#marcaEdit").val();
        var modelo =  $("#modelEdit").val();
        var serie =  $("#serieEdit").val();
        var sucursal =  $("#sucursalesddEdit").val();
        var area =  $("#areasddEdit").val();
        var tipo =  $("#tipoEquipoDD").val();
        var valor_fac =  String($("#valorF").val());

        console.log("Id: "+idEquipo+" area: "+area);
        
        if(numeroE=="" )
        {
            M.toast({html: 'Favor de ingresar el numero de equipo!', classes: 'rounded red'}); 
            return;
        }
        if(desc=="" )
        {
            M.toast({html: 'Favor de ingresar la descripcion!', classes: 'rounded red'}); 
            return;
        }
        if(marca=="" )
        {
            M.toast({html: 'Favor de ingresar marca!', classes: 'rounded red'}); 
            return;
        }
        if(modelo=="" )
        {
            M.toast({html: 'Favor de ingresar el modelo!', classes: 'rounded red'}); 
            return;
        }
        if(serie=="" )
        {
            M.toast({html: 'Favor de ingresar la serie!', classes: 'rounded red'}); 
            return;
        }
        if(sucursal=="0" )
        {
            M.toast({html: 'Favor de ingresar la sucursal!', classes: 'rounded red'}); 
            return;
        }
        if(area=="0" )
        {
            M.toast({html: 'Favor de ingresar el area!', classes: 'rounded red'}); 
            return;
        }
        if(tipo=="0" )
        {
            M.toast({html: 'Favor de ingresar el tipo de equipo!', classes: 'rounded red'}); 
            return;
        }
        if(valor_fac=="" )
        {
            M.toast({html: 'Favor de ingresar el valor factura!', classes: 'rounded red'}); 
            return;
        }
        onRequest({ opcion : 89 ,equipo_id:idEquipo, desc:desc, num_equipo:numeroE, marca:marca, modelo:modelo, serie:serie, sucursal:sucursal, valor_factura:valor_fac, area_id:area, tipo_id:tipo}, respEditarEquipos);


    });

    $("#cargarInfoEquipo").click(function() {
        var cadena = $('#codArticulo').val();
        var separador = "'"; // un espacio en blanco
        var limite    = 1;
        var id_equipo = parseInt(cadena.split(separador, limite));

        console.log("ID del equipo escaneado: "+id_equipo);
        onRequest({ opcion : 118 ,equipo_id:id_equipo}, respCargarEquipoParaInventario);
    });

    

    $("#finalizarInventario").click(function() {
            var tableReg = document.getElementById('tablaInventario');
			var sucursal_id = $("#sucursalesdd").val();
            
            

            console.log("LENGHT= "+(tableReg.rows.length-1));
            // Recorremos todas las filas con contenido de la tabla
            
            for (var i = 1; i < tableReg.rows.length ; i++)
            {
            
                compareWith = document.getElementById("tablaInventario").rows[i].cells.item(0).innerHTML;

                console.log("DATOS= "+compareWith );
                    
                onRequest({ opcion : 110 ,equipo_id:compareWith}, respInsertarEnInventarioDetalle);
            
            }
            console.log("Terminaste los deberes!");
            M.toast({html: 'Inventario Creado.', classes: 'rounded green'}); 

            location.reload();
    });

    $('#codArticulo').keypress(function(e){   
        if(e.which == 13){      
            var cadena = $('#codArticulo').val();
            var separador = "'"; // un espacio en blanco
            var limite    = 1;
            var id_equipo = parseInt(cadena.split(separador, limite));
    
            console.log("ID del equipo escaneado: "+id_equipo);
            onRequest({ opcion : 118 ,equipo_id:id_equipo}, respCargarEquipoParaInventario); 
        }   
       });    
        
    $("#btnBusquedaInv").click(function() {
        var sucursal_id = parseInt($("#sucursalesdd").val());

        if(sucursal_id==0)
        {
            M.toast({html: 'Seleccione una sucursal!.', classes: 'rounded red'});
        }
        else
        {
            document.getElementById('tablaCreaInventario').style.display = 'block';
            onRequest({ opcion : 111 ,sucursal:sucursal_id}, respCargarInventario);
        }
        
    });

    ///------------------------------------Editar y Finalizar el inventario------------------------------------------------
    $("#cargarInfoEquipoEditar").click(function() {
        var cadena = $('#codArticuloEdit').val();
        var separador = "'"; // un espacio en blanco
        var limite    = 1;
        var id_equipo = parseInt(cadena.split(separador, limite));

        console.log("ID del equipo escaneado: "+id_equipo);
        onRequest({ opcion : 118 ,equipo_id:id_equipo}, respParaEditarCargarEquipoParaInventario);
    });

    

    $("#finalizarInventarioEditar").click(function() {
           
            
            var id_inventario = Cookies.get('i_inventarioID');

            //Eliminar todo para volverlo a cargar
            onRequest({ opcion : 116 ,inventario_id:id_inventario}, respEliminarInventario);
             

            //location.reload();
    });

    $('#codArticuloEdit').keypress(function(e){   
        if(e.which == 13){      
            var cadena = $('#codArticuloEdit').val();
            var separador = "'"; // un espacio en blanco
            var limite    = 1;
            var id_equipo = parseInt(cadena.split(separador, limite));

            console.log("ID del equipo escaneado: "+id_equipo);
            onRequest({ opcion : 118 ,equipo_id:id_equipo}, respParaEditarCargarEquipoParaInventario);
        }   
       });   
       
       
       $("#cerrarInventario").click(function() {
        var tableReg = document.getElementById('tablaInventario');
        var sucursal_id = $("#sucursalesdd").val();
        
        onRequest({ opcion : 109 ,sucursal:sucursal_id}, respInsertarEnInventarioGeneral);

        console.log("LENGHT= "+(tableReg.rows.length-1));
        // Recorremos todas las filas con contenido de la tabla
        
        for (var i = 1; i < tableReg.rows.length ; i++)
        {
        
            compareWith = document.getElementById("tablaInventario").rows[i].cells.item(0).innerHTML;

            console.log("DATOS= "+compareWith );
                
            onRequest({ opcion : 110 ,equipo_id:compareWith}, respInsertarEnInventarioDetalle);
        
        }
        console.log("Terminaste los deberes!");
        M.toast({html: 'Inventario Creado.', classes: 'rounded green'}); 

        
           
            
        var id_inventario = Cookies.get('i_inventarioID');

       
        onRequest({ opcion : 113 }, respFinalizarInventario1);
         

        //location.reload();
       });

       

       $("#cerrarInventarioEdit").click(function() {


        var id_inventario = Cookies.get('i_inventarioID');

            //Eliminar todo para volverlo a cargar
        onRequest({ opcion : 116 ,inventario_id:id_inventario}, respEliminarInventarioEditar);
        
        
        var id_inventario = Cookies.get('i_inventarioID');

       
        onRequest({ opcion : 114 ,inventario_id:id_inventario}, respFinalizarInventario);
         

        //location.reload();
       });

       
       $("#btnIniciaInventario").click(function() {
            var sucursal_id = parseInt($("#sucursalesdd").val());

            if(sucursal_id==0)
            {
                M.toast({html: 'Seleccione una sucursal!.', classes: 'rounded red'});
            }
            else
            {
                $('#modalCrearInventario').modal('open'); 
                onRequest({ opcion : 109 ,sucursal:sucursal_id}, respInsertarEnInventarioGeneral);
            }
       });

       $("#cancelarCreaciondeInventario").click(function() {

        var opcion = confirm("¿Seguro que desea salir? Se eliminará el inventario y no ha guardado nada.");
                    if (opcion == true) 
                    {
                        onRequest({ opcion : 113}, respEliminarInventarioRecienCreado);
                    } 
                    else 
                    {
                        M.toast({html: 'Continue con la carga de equipos.', classes: 'rounded green'});
                    }

   });

   

   $("#btnBusquedaPorArea").click(function() {
       var areaid=$("#areadd").val();
       console.log("||||AREA: "+areaid);
       var inventario_id=Cookies.get('i_id_inventario');
       var sucursal_id=Cookies.get('i_sucursal');
       
       inventarios({ opcion : 26 ,inventario_id:inventario_id, sucursal:sucursal_id , area_id:areaid},respCargarInventarioXArea);
       
       
   });
    

});
    function cargarMenuPorRol(){
    
    empleadoid = Cookies.get('b_capturista_id');
    console.log("id empleado= "+empleadoid);
    onRequest({ opcion : 31 ,id_usuario:empleadoid },respCargarRolesPorUsuario);
    
    onRequest({ opcion : 62 ,usuario_id:empleadoid}, respNotificaciones);

    }
    
    function cargarInventario(){
        console.log("Cargando Equipos");
        onRequest({ opcion : 68 }, respInventario);

    }

    function capturainv(){
        console.log("Cargando Sucursales");
        onRequest({ opcion : 70 }, respcargasucursales);

        onRequest({ opcion : 71 }, respcargatiposequipo);

    }

    function busquedaEquipo()
    {
        onRequest({ opcion : 70 }, respcargasucursales);

        onRequest({ opcion : 71 }, respcargatiposequipo);

        inventarios({ opcion : 2},respCargaAreas);

        var idEquipo = $("#id_equipo").val();
        var sucursal_id = String($("#sucursalesdd").val());
        var num_equipo = $("#num_equipo").val();
        var areaid = $("#sltArea").val();

        onRequest({ opcion : 77 ,id:idEquipo, sucursal:sucursal_id, numequipo:num_equipo, area_id:areaid }, respCargarEquipos);
    }

    function desEquipo(idequipo)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Id del equipo:"+idequipo);
        onRequest({ opcion : 82 ,equipo_id:idequipo}, respCargarEquipoPorId);
        

    }

    function editarEquipo(idequipo)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Id del equipo:"+idequipo);
        onRequest({ opcion : 82 ,equipo_id:idequipo}, respCargarEquipoPorIdParaEditar);
        

    }
    function imprimirResponsiva(idequipo)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Id del equipo:"+idequipo);
        onRequest({ opcion : 95 ,equipo_id:idequipo}, respImprimirResponsiva);
        

    }
    
    function notaCancelacion(idequipo)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Id del equipo:"+idequipo);
        onRequest({ opcion : 82 ,equipo_id:idequipo}, respCargarNota);
        

    }
    
    function buscaEmpleados()
    {
        var bus= $("#nomResponsable").val();
        if (bus.length>2)
        {
            document.getElementById('listaEmpleados').style.display = 'block';
            onRequest({ opcion : 84 ,nombre:bus}, respBuscarEmpleados);
        }
        else
        {
            document.getElementById('listaEmpleados').style.display = 'none';
        }
        console.log("Buscando texto:"+bus);
        
    }

    function asignarResponsable(equipo_id, numequipo)
    {  
        console.log("id del equipo:"+equipo_id);
        Cookies.set("i_idequipo", equipo_id );
        console.log("Numero del equipo:"+numequipo);
        Cookies.set("i_numequipo", numequipo );
        $("#IdResponsable").val("");
        $("#nomResponsable").val("");
        $("#comenEquipo").val("");
        $("#respFecha_ent").val("");

        var equip = Cookies.get('i_idequipo');
        var numEquip = Cookies.get('i_numequipo');
       
        console.log("id del equipo desde cookies:"+equip+" Numero de equipo desde cookies"+numEquip);
        onRequest({ opcion : 88 ,equipo_id:equip}, respCargarResponsables);

    }

    function imprimirQr(id){
        var a = document.createElement('a');
         a.href="../reportes/rep_qr.php?equipo_id="+id;
         a.target="_blanck";
         document.body.appendChild(a);
         a.click();
    }
    
    function asignarEquipo()
    {  
        var equip = Cookies.get('i_idequipo');
        

        //Deshabilitamos las resopnsivas que tenga ese equipo
        inventarios({ opcion : 6, equipo_id:equip},respDeshabilitarResponsivas);  
        

    }

    


    function agregarAdiv(id_empleado)
    {  
        
        document.getElementById('listaEmpleados').style.display = 'none';
        $("#IdResponsable").val(id_empleado);
        var id=$("#IdResponsable").val();
        onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdiv);

       
       

    }

   

    function fnExcelReport()
    {
        var tab_text="<table border='2px' charset=UTF-8><tr> "+
        "<th>Id</th>"+
        "<th>Sucursal</th>"+
        "<th>Area</th>"+
        "<th># Equipo</th>"+ 
        "<th>Tipo</th>"+
        "<th>Marca</th>"+
        "<th>Modelo</th>"+
        "<th>Serie</th>"+
        "<th>Descripcion</th>"+
        "<th>Valor Factura</th>"+
        "<th>Responsable</th>"+
        "<th>Estatus</th>"+
        "</tr>";
        var textRange; var j=0;
        tab = document.getElementById('tablaEquipos2'); // id of table

        for(j = 0 ; j < tab.rows.length; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        tab_text= tab_text.replace(/<a[^>]*>/gi, "");
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }  
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

        return (sa);
    }

    function fnExcelReportInventario()
    {
        var tab_text="<table border='2px' charset=UTF-8><tr> "+
        "<th>Id</th>"+
        "<th>Tipo de Equipo</th>"+
        "<th>Descripcion</th>"+
        "<th>Sucursal</th>"+
        "<th>Area</th>"+
        "<th>Encargado</th>"+
        "<th>Inventariado</th>"+
        "<th>Marca</th>"+
        "<th>Modelo</th>"+
        "<th>Valor Factura</th>"+
        "<th>Serie</th>"+
        "</tr>";
        var textRange; var j=0;
        tab = document.getElementById('tablaInventarioDeEquipoVer2'); // id of table

        for(j = 0 ; j < tab.rows.length; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        tab_text= tab_text.replace(/<a[^>]*>/gi, "");
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }  
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

        return (sa);
    }

    ///// __________________________ AGREGAR DESDE AQUI A SERVIDOR FUNCIONES------------------------

    function muestraBoton()
    {
       var opcion= $('#selectOpcion').val();
       console.log("OPCION:"+opcion);
       if(opcion==1)
       {
            document.getElementById('btnBusquedaInv').style.display = 'none';
            document.getElementById('btnIniciaInventario').style.display = 'block';
            document.getElementById('tablaCreaInventario').style.display = 'none';
       }
       else
       {
          document.getElementById('btnIniciaInventario').style.display = 'none';
          document.getElementById('btnBusquedaInv').style.display = 'block';
          document.getElementById('tablaCreaInventario').style.display = 'none';
       }

    }
    
    function inventario()
    {
        onRequest({ opcion : 70 }, respcargasucursales);
    }

    function editarInventario(id_inventario)
    {
        console.log("Inventario ID= "+id_inventario);

        Cookies.set("i_inventarioID",id_inventario);

        onRequest({ opcion : 115, inventario_id:id_inventario }, respCargarInventarioParaEditar);
    }


    function verInventario(id_inventario)
    {
        console.log("Inventario ID= "+id_inventario);

        var suc= $('#sucursalesdd').val();
       console.log("SUCURSAL: "+ suc);

       Cookies.set("i_id_inventario", id_inventario );
       Cookies.set("i_sucursal", suc );
        onRequest({ opcion : 119, inventario_id:id_inventario, sucursal:suc}, respCargarInventarioParaVer);
    } 
    


    //RESPUESTAS-----------------------------------------------------------------------------------------------------------
    var respInventario = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        var d = '';
        var x = '';
    
            
            for (var i = 0; i < data.length; i++) {
            if(i%2==0)
            {
                x='even';
            }
            else
            {
                x='odd';
            }
            d+= '<tr>'+
            '<td>'+data[i].id+'</td>'+ 
            '<td>'+data[i].descripcion+'</td>'+  
            '</tr> ';
            }
                
                $("#tablaequipo").html(d);
        
        cargarMenuPorRol();
    }

    var respAgregaEquipo = function(data) { 
        console.log(data);
        if (!data && data == null)
        {
            M.toast({html: 'Equipo NO agregado', classes: 'rounded red'}); 
            return;
        }
        
        M.toast({html: 'Equipo agregado', classes: 'rounded blue'}); 
        
        $("#modalAgregarEquipo").modal("close");
    
        onRequest({ opcion : 68 }, respInventario);
    }

    var respcargasucursales = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="0"  selected>Seleccione Sucursal</option>';
    
        for(var i=0; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].nomComercial+'</option>';
        }
        console.log("checarc");
        
        $('#sucursalesdd').html(documento);
        $('#sucursalesdd').formSelect(); 
        cargarMenuPorRol();
    
    }
    
    var respCargarSucursalParaEditar = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="'+data[0].id+'" selected>'+data[0].nomComercial+'</option>';
    
        for(var i=1; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].nomComercial+'</option>';
        }
        console.log("checarc");
        
        $('#sucursalesddEdit').html(documento);
        $('#sucursalesddEdit').formSelect(); 
    
    }

    var respCargarAreaParaEditar = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="'+data[0].id+'" selected>'+data[0].descripcion+'</option>';
    
        for(var i=1; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        
        $('#areasddEdit').html(documento);
        $('#areasddEdit').formSelect(); 
    
    }

    var respCargarTipoEquipoPEditar = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="'+data[0].id+'" selected>'+data[0].descripcion+'</option>';
    
        for(var i=1; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        
        $('#tipoEquipoDD').html(documento);
        $('#tipoEquipoDD').formSelect(); 
    
    }

    var respcargatiposequipo = function(data) { 
        if (!data && data == null)
            return;  
     
        var documento='<option value="0" selected>Seleccione Tipo Equipo</option>';
    
        for(var i=0; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        console.log("checarc");
        
        $('#tiposequipos').html(documento);
        $('#tiposequipos').formSelect(); 
    
    }

    $( "#btnCrearinvequipo" ).click(function() { 
        var sucursal_id=$("#sucursalesdd").val();
        var tipo_equipo=$("#tiposequipos").val();
        var num_equipo=$("#num_equipo").val();
        var descripcion=$("#descripcion").val();
        var marca=$("#marca").val();
        var modelo=$("#modelo").val();
        var serie=$("#serie").val();
        var fecha_compra=$("#fecha_compra").val();
        var valor_factura=$("#valor_factura").val();
        var area_id=$("#sltArea").val();
        
    
    if(sucursal_id<=0)
    {
        M.toast({html: 'Favor de seleccionar sucursal', classes: 'rounded red'}); 
        return;
    }

    if(tipo_equipo<= 0)
    {
        M.toast({html: 'Favor de seleccionar tipo de equipo', classes: 'rounded red'}); 
        return;
    }

    if(num_equipo=="")
    {
        M.toast({html: 'Favor de ingresar numero de equipo', classes: 'rounded red'}); 
        return;
    }

    if(descripcion=="")
    {
        M.toast({html: 'Favor de ingresar descripcion de equipo', classes: 'rounded red'}); 
        return;
    }

    if(marca=="")
    {
        M.toast({html: 'Favor de ingresar marca del equipo', classes: 'rounded red'}); 
        return;
    }

    if(modelo=="")
    {
        M.toast({html: 'Favor de ingresar modelo del equipo', classes: 'rounded red'}); 
        return;
    }

    if(serie== "")
    {
        M.toast({html: 'Favor de ingresar serie del equipo', classes: 'rounded red'}); 
        return;
    }

    if(fecha_compra=="")
    {
        M.toast({html: 'Favor de ingresar fecha de compra', classes: 'rounded red'}); 
        return;
    }

    if(valor_factura=="")
    {
        M.toast({html: 'Favor de ingresar valor factura', classes: 'rounded red'}); 
        return;
    }

    if(area_id=="")
    {
        M.toast({html: 'Favor de seleccionar un area.', classes: 'rounded red'}); 
        return;
    }


    
    onRequest({ opcion : 73, serie:serie},respverificar);
    
    });

    var respverificar = function(data) { 
  
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        if(data[0].contador>0 )
        {
           if(data[0].serie=="n/a" || data[0].serie=="N/A" || data[0].serie=="N/a" || data[0].serie=="n/A" || data[0].serie=="na" || data[0].serie=="NA" || data[0].serie=="nA" || data[0].serie=="Na")
           {
                var tipo_equipo=$("#tiposequipos").val();
                var num_equipo=$("#num_equipo").val();
                onRequest({ opcion : 74, tipo_equipo:tipo_equipo, num_equipo:num_equipo},respverificar2);
            }
            else
            {
                M.toast({html: 'Numero de Serie repetida', classes: 'rounded red'});  
                return;
            }
            
        }
        else 
        {
            var tipo_equipo=$("#tiposequipos").val();
            var num_equipo=$("#num_equipo").val();
            onRequest({ opcion : 74, tipo_equipo:tipo_equipo, num_equipo:num_equipo},respverificar2);
           
           
        }
    }

    var respCrearinvequipo = function(data) { 
        //se insertan los datos en la tabla confirmaciones!
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }

        console.log(data)
        $("#modalAceptarDosEquipos").modal("close");
    
        M.toast({html: 'ENHORABUENA...!!! Equipo agregado correctamente ', classes: 'rounded green'}); 
        
        $("#tiposequipos").val("");
        $("#num_equipo").val("");
        $("#descripcion").val("");
        $("#marca").val("");
        $("#modelo").val("");
        $("#serie").val("");
        $("#fecha_compra").val("");
        $("#valor_factura").val("");
       
        onRequest({ opcion : 71 }, respcargatiposequipo);
        cargarInventario();
    }

    var respverificar2 = function(data) { 
  
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        if(data[0].contador>0)
        {
            M.toast({html: 'Tipo de equipo ya asignado a un numero de equipo', classes: 'rounded red'});  
            $('#modalAceptarDosEquipos').modal('open');

            var d='';
            d="<center> <h5><strong>El numero de equipo "+data[0].numero+" ya cuenta con un "+data[0].tipo+" ¿Seguro que desea agregar un "+data[0].tipo+" mas?</strong></h5></center>";

            $("#textoModal").html(d);
        }
        else 
        {
            var sucursal_id=$("#sucursalesdd").val();
            var tipo_equipo=$("#tiposequipos").val();
            var num_equipo=$("#num_equipo").val();
            var descripcion=$("#descripcion").val().toUpperCase();
            var marca=$("#marca").val().toUpperCase();
            var modelo=$("#modelo").val().toUpperCase();
            var serie=$("#serie").val().toUpperCase();
            var fecha_compra=$("#fecha_compra").val();
            var valor_factura=$("#valor_factura").val();
            var capturistaid=Cookies.get('b_capturista_id');
            var area_id=$("#sltArea").val();
            

        
            onRequest({ opcion : 72, sucursal_id:sucursal_id, tipo_equipo:tipo_equipo,num_equipo:num_equipo, 
                descripcion:descripcion,marca:marca, modelo:modelo,serie:serie, fecha_compra:fecha_compra, 
                valor_factura:valor_factura, capturista:capturistaid,area_id:area_id},respCrearinvequipo);
        }
    }

    

    var respCargarEquipos = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        var d = '';
        var d2 = '';
        var x = '';
        console.log(data);
        console.log("------------"+data);
            for (var i = 0; i < data.length; i++) {
               
               
                if(data[i].estatus=="BAJA")
                {
                    if(i%2==0)
                    {
                        x='even';
                    }
                    else
                    {
                        x='odd';
                    }
                    d+= '<tr>'+
                    '<td>'+data[i].id+'</td>'+ 
                    '<td>'+data[i].nomComercial+'</td>'+ 
                    '<td>'+data[i].area+'</td>'+                      
                    '<td>'+data[i].numEquipo+'</td>'+
                    '<td>'+data[i].tipo+'</td>'+ 
                    '<td>'+data[i].equipo+'</td>'+ 
                    '<td>'+data[i].responsable+'</td>'+            
                    '<td>'+data[i].estatus+'</td>'+
                    '<td class="'+x+' left">'+
                    '<a onclick="asignarResponsable('+data[i].id+','+data[i].numEquipo+')" class="waves-effect waves-light btn-floating btn-small  green darken-4 btn modal-trigger" href="#modalAsignarResp"><i class="material-icons">assignment_ind</i></a>' + 
                    '<a onclick="desEquipo('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small orange darken-2 btn modal-trigger disabled" href="#modalDeshEquipo"><i class="material-icons">do_not_disturb</i></a>' +
                    '<a onclick="notaCancelacion('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small grey darken-1 btn modal-trigger" href="#modalNotaCancelacion"><i class="material-icons">library_books</i></a>' + 
                    '<a onclick="editarEquipo('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue darken-3 btn modal-trigger" href="#modalEditarEquipo"><i class="material-icons">edit</i></a>' + 
                    '<a onclick="imprimirResponsiva('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small teal darken-1" href="#!"><i class="material-icons">print</i></a>' + 
                    '<a onclick="imprimirQr('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue accent-3 href="#!"><i class="material-icons">center_focus_strong</i></a>' + 
                    '</tr> ';
                    d2+='<tr>'+
                    '<td>'+data[i].id+'</td>'+ 
                    '<td>'+data[i].nomComercial+'</td>'+ 
                    '<td>'+data[i].area+'</td>'+                      
                    '<td>'+data[i].numEquipo+'</td>'+
                    '<td>'+data[i].tipo+'</td>'+ 
                    '<td>'+data[i].marca+'</td>'+
                    '<td>'+data[i].modelo+'</td>'+
                    '<td>'+data[i].serie+'</td>'+
                    '<td>'+data[i].equipo+'</td>'+ 
                    '<td>'+data[i].valorf+'</td>'+
                    '<td>'+data[i].responsable+'</td>'+            
                    '<td>'+data[i].estatus+'</td>'+
                    '</tr> ';
                    
                }
                else
                {
                    if(i%2==0)
                    {
                        x='even';
                    }
                    else
                    {
                        x='odd';
                    }
                    d+= '<tr>'+
                    '<td>'+data[i].id+'</td>'+ 
                    '<td>'+data[i].nomComercial+'</td>'+
                    '<td>'+data[i].area+'</td>'+  
                    '<td>'+data[i].numEquipo+'</td>'+
                    '<td>'+data[i].tipo+'</td>'+ 
                    '<td>'+data[i].equipo+'</td>'+  
                    '<td>'+data[i].responsable+'</td>'+                   
                    '<td>'+data[i].estatus+'</td>'+
                    '<td class="'+x+' left">'+
                    '<a onclick="asignarResponsable('+data[i].id+','+data[i].numEquipo+')" class="waves-effect waves-light btn-floating btn-small  green darken-4 btn modal-trigger "  href="#modalAsignarResp"><i class="material-icons tooltipped" data-tooltip="Responsiva" data-position="top">assignment_ind</i></a>' + 
                    '<a onclick="desEquipo('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small orange darken-2 btn modal-trigger tooltipped" data-position="top" data-tooltip="Deshabilitar" href="#modalDeshEquipo"><i class="material-icons">do_not_disturb</i></a>' +
                    '<a onclick="editarEquipo('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue darken-3 btn modal-trigger tooltipped" data-position="top" data-tooltip="Editar" href="#modalEditarEquipo"><i class="material-icons">edit</i></a>' + 
                    '<a onclick="imprimirResponsiva('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small teal darken-1 tooltipped" data-position="top" data-tooltip="Imprimir Responsiva"  href="#!"><i class="material-icons">print</i></a>' + 
                    '<a onclick="imprimirQr('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue accent-3 tooltipped" data-position="top" data-tooltip="Imprimir QR"  href="#!"><i class="material-icons">center_focus_strong</i></a>' + 
                    '</tr> ';
                    d2+='<tr>'+
                    '<td>'+data[i].id+'</td>'+ 
                    '<td>'+data[i].nomComercial+'</td>'+ 
                    '<td>'+data[i].area+'</td>'+                      
                    '<td>'+data[i].numEquipo+'</td>'+
                    '<td>'+data[i].tipo+'</td>'+ 
                    '<td>'+data[i].marca+'</td>'+
                    '<td>'+data[i].modelo+'</td>'+
                    '<td>'+data[i].serie+'</td>'+
                    '<td>'+data[i].equipo+'</td>'+ 
                    '<td>'+data[i].valorf+'</td>'+
                    '<td>'+data[i].responsable+'</td>'+            
                    '<td>'+data[i].estatus+'</td>'+
                    '</tr> ';
                }
            }
               
                 $("#tablaEquipos").html(d);
                 
                 $("#tablaEquipos2").html(d2);
                 $('.tooltipped').tooltip();
                 
        cargarMenuPorRol();
    }

    
    var respCargarEquipoPorId = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        if (data[0].id>0) { 
            console.log(data[0].id);
          $("#idEquipoDes").val(data[0].id);
    
           return;
         
        }
    }

    var respCargarEquipoPorIdParaEditar = function(data) { 
    
        if (!data && data == null) 
        return; 

        var suc= data[0].sucursal;
        var area= data[0].area_id;
        var tipo= data[0].tipo;
        onRequest({ opcion : 92, id_sucursal:suc }, respCargarSucursalParaEditar);
        onRequest({ opcion : 105, area_id:area }, respCargarAreaParaEditar);
        onRequest({ opcion : 106, tipo_id:tipo }, respCargarTipoEquipoPEditar);
        if (data[0].id>0) { 
            console.log("Valor factura: "+data[0].valor_factura);
          $("#idEquipoEdit").val(data[0].id);
          $("#numEquipo").val(data[0].numEquipo);
          $("#descEdit").val(data[0].descripcion);
          $("#marcaEdit").val(data[0].marca);
          $("#modelEdit").val(data[0].modelo);
          $("#serieEdit").val(data[0].serie);
          $("#valorF").val(data[0].valor_factura);
          
    
           return;
         
        }
    }
    
    var respImprimirResponsiva = function(data) { 
    
        if (!data && data == null) 
        return; 

        
        if (data[0].id>0) { 
            console.log(data[0].id);
         var id_equipo= data[0].id;
         var numEquipo=data[0].num_equipo;
         var descripcion=data[0].descripcion;
         var fecha=data[0].fecha_entrega;
         var encargado=data[0].encargado;
         
         var a = document.createElement('a');
         a.href="../reportes/responsiva.php?numEquipo="+numEquipo+"&fecha_entrega="+fecha+"&capturista="+encargado+"&comentarios="+descripcion+"&id_equipo="+id_equipo;
         a.target="_blanck";
         document.body.appendChild(a);
         a.click();

        }
        else
        {
            M.toast({html: 'Sin responsable asignado, no hay responsiva para imprimir.', classes: 'rounded red'}); 
            return;
        }
    }


    
    var respCargarNota = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        if (data[0].id>0) { 
            console.log(data[0].id);
          $("#idEquipoNota").val(data[0].id);
          $("#notaEquipo").val(data[0].nota);
          $("#fechaBaja").val(data[0].fechaB);
           return;
         
        }
    }

    
    var respBajaEquipos = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Equipo no Actualizado, contacte al area de sistemas.', classes: 'rounded red'}); 
            return;
        }
        
        M.toast({html: 'El Equipo se dio de baja correctamente!', classes: 'rounded green'}); 
    
        $("#modalDeshEquipo").modal("close");
    
        busquedaEquipo();
    }
    var respEditarEquipos = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Equipo no Actualizado, contacte al area de sistemas.', classes: 'rounded red'}); 
            return;
        }
        
        M.toast({html: 'El Equipo se actualizo correctamente!', classes: 'rounded green'}); 
    
        $("#modalEditarEquipo").modal("close");
    
   
    }

    var respCargaAreas = function(data) {  
        if (!data && data == null)
        {
            M.toast({html: 'Error al registrar Área', classes: 'rounded red'}); 
            return;
        }
         
        var documento='<option value="0" selected>Seleccione Área</option>';

        for (var i = 0; i < data.length; i++) {
              documento+= '<option value="'+data[i].area_id+'">'+data[i].descripcion+'</option>';
             }
    
       $("#sltArea").html(documento);
        $('#sltArea').formSelect();
}

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
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
                d+= '<tr>'+
                '<td>Sin coincidencias</td>'+
                '<td class="left">'+ 
                '</tr> ';  
            }
            else
            {
                d+="<tr> <td>"+data[i].descripcion+" </td>" 
                +"<td> <a onclick='agregarAdiv("+data[i].id+");' class='waves-effect waves-light btn-floating btn-small blue'><i class='material-icons'>add</i></a> " +
                "</td> </tr> ";
            }
            
            
        }

        $("#listaEmpleados").addClass("espacioClientes");
        $("#listaEmpleadosTabla").html(d);
    }
    

    var respAsignarResponsiva = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }

        M.toast({html: 'Responsable asignado a equipo!.', classes: 'rounded green'})
        

        var equip = Cookies.get('i_idequipo');

        console.log("id del equipo desde cookies:"+equip);
        onRequest({ opcion : 88 ,equipo_id:equip}, respCargarResponsables);
        
       
    }

    var respAsignarResponsivaAEquipo = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }
        
       
    }
    
    
    

    var respAgregarNombreAdiv = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }

        var nombre=data[0].nombre;
        $("#nomResponsable").val(nombre);
        
    }

    

    var respCargarResponsables = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrío un problema, contacte al equipo de sistemas.', classes: 'rounded red'}); 
            return;
        }


        var d='';
        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].nombreEncargado);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
                d+= '<tr>'+
                '<td>No tiene responsable asignado</td>'+
                '<td class="left">'+ 
                '</tr> ';  
            }
            else
            {
                d+="<tr> "+
                '<td>'+data[i].nombreEncargado+'</td>'+ 
                '<td>'+data[i].fechaEntrega+'</td>'+  
                '<td>'+data[i].comentario+'</td>'+
                '</tr> ';
            }
            
            
        }

        $("#datosEncargadoTabla").html(d);
       
    }

    

    var respDeshabilitarResponsivas = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrío un problema, contacte al equipo de sistemas.', classes: 'rounded red'}); 
            return;
        }
        
        var equip = Cookies.get('i_idequipo');
        var id_emp = $("#IdResponsable").val();
        var fecha_ent = $("#respFecha_ent").val();
        var numEquipo = Cookies.get('i_numequipo');
        if(id_emp=="")
        {
            M.toast({html: 'Agregue al responsable porfavor!', classes: 'rounded red'}); 
            return;
        }
        if(fecha_ent=="")
        {
            M.toast({html: 'Agrega la fecha de entrega!', classes: 'rounded red'}); 
            return;
        }
        
        var comentarios = $("#comenEquipo").val();
        if(comentarios=="")
        {
            M.toast({html: 'Agregue comentarios sobre el equipo porfavor!.', classes: 'rounded red'}); 
            return;
        }
        console.log("id de empleado:"+id_emp+" equipo id:"+equip+"fecha entrega:"+fecha_ent);
 
        onRequest({ opcion : 85 ,id_empleado:id_emp, idequipo:equip, fecha_ent:fecha_ent, comen:comentarios}, respAsignarResponsiva);
        onRequest({ opcion : 91 ,equipo_id:equip, encargado:id_emp}, respAsignarResponsivaAEquipo);
        onRequest({ opcion : 90 ,num_equipo:numEquipo}, respVerificarSiTeniaResponsiva);
        console.log("estatus dado de baja");
       
    }


    
    var respVerificarSiTeniaResponsiva = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrío un problema, contacte al equipo de sistemas.', classes: 'rounded red'}); 
            return;
        }


        var id_equipo=0;
        for (var i = 0; i < data.length; i++) 
        {
            
            id_equipo=data[i].id_equipo;
            Cookies.set("i_idequipo", id_equipo );
            console.log("--------------------- id de equipo:"+id_equipo);
            onRequest({ opcion : 107 ,equipo_id:id_equipo}, respuestaVerificacion);
        }

    }

    var respuestaVerificacion = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrío un problema, contacte al equipo de sistemas.', classes: 'rounded red'}); 
            return;
        }
        var equip = data[0].equipo_id;
        var id_emp = $("#IdResponsable").val();
        var fecha_ent = $("#respFecha_ent").val();
        var comentarios =   $("#comenEquipo").val();
        console.log("|-----Id del equipo:"+equip+"  responsable="+id_emp+"   fecha_entrega:"+fecha_ent+"------"+comentarios+"|");
        
        if(data[0].contador>0)
        {
            return;
        }
        else
        {
            console.log("||||Entrando a borrar y todo eso");
            inventarios({ opcion : 6, equipo_id:equip},respDeshabilitarResponsivas);  
            onRequest({ opcion : 85 ,id_empleado:id_emp, idequipo:equip, fecha_ent:fecha_ent, comen:comentarios}, respAsignarFaltante);
            onRequest({ opcion : 91 ,equipo_id:equip, encargado:id_emp}, respAsignarResponsivaAEquipo);
        }
        
    }

    var respAsignarFaltante = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrío un problema, contacte al equipo de sistemas.', classes: 'rounded red'}); 
            return;
        }
        M.toast({html: 'Asignado.', classes: 'rounded green'}); 
    }

    
    var respCargarEquipoParaInventario = function(data) 
    {
        if (!data && data == null) 
        return; 

        var sucursal=$('#sucursalesdd').val();
        console.log("VIENDO SUCURSAL= "+sucursal);
        var d = '';
        var x = '';
        var found=0;
        var compareWith="";
        var tableReg = document.getElementById('tablaInventario');

        console.log("LENGHT= "+(tableReg.rows.length-1));
        for (var i = 1; i < tableReg.rows.length ; i++)
        {
        
            compareWith = document.getElementById("tablaInventario").rows[i].cells.item(0).innerHTML;

            console.log("DATOS= "+compareWith );
                
            if(data[0].id==compareWith)
            {
                
                found=1;
                M.toast({html: 'Dato repetido.', classes: 'rounded red'}); 
                $('#codArticulo').val("");
                return;
            }
            else
            {
                found=0;
            }
           
        }

        

        
        if(found==0)
        {
            var Descripcion=String(data[0].descripcion);
           
            if(Descripcion=="undefined")
            {
                M.toast({html: 'Sin datos sobre ese equipo!.', classes: 'rounded red'}); 
                $('#codArticulo').val("");
            
            }
            else
            {
                if(sucursal==data[0].sucursal)
                {
                    var fila="<tr><td>"+data[0].id+"</td><td>"+data[0].tipo_equipo+"</td><td>"+data[0].nombre_sucursal+"</td><td>"+data[0].descripcion+"</td><td>"+data[0].marca+"</td><td>"+data[0].modelo+"</td></tr> "+
                    '<td><input type="button" class="borrar" value="Eliminar" /></td>';
                    var btn = document.createElement("TR");
                    btn.innerHTML=fila;
                    document.getElementById("tablaInventarioDeEquipo").appendChild(btn);
                }
                else
                {
                    
                    var opcion = confirm("Agregaste un equipo que no es de esa sucursal, estas seguro que quieres agregarlo a esta sucursal?");
                    if (opcion == true) 
                    {
                        
                        var fila="<tr><td>"+data[0].id+"</td><td>"+data[0].tipo_equipo+"</td><td>"+data[0].nombre_sucursal+"</td><td>"+data[0].descripcion+"</td><td>"+data[0].marca+"</td><td>"+data[0].modelo+"</td></tr> "+
                        '<td><input type="button" class="borrar" value="Eliminar" /></td>';
                        var btn = document.createElement("TR");
                        btn.innerHTML=fila;
                        document.getElementById("tablaInventarioDeEquipo").appendChild(btn);
                    } 
                    else 
                    {
                        M.toast({html: '¡Equipo no agregado!.', classes: 'rounded red'});
                    }
                    
                    
                }
                
            
            }
        }
        else
        {
            M.toast({html: 'Dato repetido.', classes: 'rounded red'}); 
            $('#codArticulo').val("");
            return;
        }
        
            
        
        $('#codArticulo').val("");
    }


    var respInsertarEnInventarioGeneral = function(data) 
    {
        if (!data && data == null) 
        return; 


        console.log("INSERTADO EN INVENTARIO GENERAL");
    }

    
    var respInsertarEnInventarioDetalle = function(data) 
    {
        if (!data && data == null) 
        return; 


        console.log("INSERTADO EN INVENTARIO GENERAL");
    }

    var respCargarInventario = function(data) 
    {
        if (!data && data == null) 
        return; 

        var d="";

        for (var i = 0; i < data.length; i++) 
        {
            var sucursal=String(data[i].sucursal_nombre);
            console.log("-------"+sucursal);
            if(sucursal=="undefined")
            {
                d+= '<tr>'+
                '<td>Sin equipos registrados en la sucursal seleccionada</td>'+
                '<td class="left">'+ 
                '</tr> ';  
            }
            else
            {
                
                if(data[i].estatus_id==2)
                {
                    d+="<tr> "+
                    '<td>'+data[i].id_inventario+'</td>'+ 
                    '<td>'+data[i].sucursal_nombre+'</td>'+ 
                    '<td>'+data[i].fecha_creado+'</td>'+  
                    '<td>'+data[i].hora_creado+'</td>'+
                    '<td>'+data[i].fecha_terminado+'</td>'+
                    '<td>'+data[i].hora_terminado+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+
                    '<td>'+data[i].estatus+'</td>'+
                    "<td> <a onclick='editarInventario("+data[i].id_inventario+");' class='waves-effect waves-light btn-floating btn-small blue btn modal-trigger' href='#modalEditarInventario' disabled><i class='material-icons'>edit</i></a> </td>" +
                    "<td> <a onclick='verInventario("+data[i].id_inventario+");' class='waves-effect waves-light btn-floating btn-small teal darken-4 btn modal-trigger' href='#modalVerInventario'><i class='material-icons'>assignment</i></a> </td>" +
                    '</tr> ';
                }
                else
                {
                    d+="<tr> "+
                    '<td>'+data[i].id_inventario+'</td>'+ 
                    '<td>'+data[i].sucursal_nombre+'</td>'+ 
                    '<td>'+data[i].fecha_creado+'</td>'+  
                    '<td>'+data[i].hora_creado+'</td>'+
                    '<td>'+data[i].fecha_terminado+'</td>'+
                    '<td>'+data[i].hora_terminado+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+
                    '<td>'+data[i].estatus+'</td>'+
                    "<td> <a onclick='editarInventario("+data[i].id_inventario+");' class='waves-effect waves-light btn-floating btn-small blue btn modal-trigger' href='#modalEditarInventario'><i class='material-icons'>edit</i></a> </td>" +
                    "<td> <a onclick='verInventario("+data[i].id_inventario+");' class='waves-effect waves-light btn-floating btn-small teal darken-4 btn modal-trigger' href='#modalVerInventario'><i class='material-icons'>assignment</i></a> </td>" +
                    '</tr> ';
                }
                
            }
            
            
        }

        $("#datosInventario").html(d);

        
    }

    
    var respCargarInventarioParaEditar = function(data) 
    {
        if (!data && data == null) 
        return; 

        var d="";
        Cookies.set("sucursal_inv_paraEditar",data[0].id_sucursal);

        for (var i = 0; i < data.length; i++) 
        {
            var sucursal=String(data[i].sucursal);
            console.log("-------"+sucursal);
            if(sucursal=="undefined")
            {
                
            }
            else
            {
                d+="<tr> "+
                '<td>'+data[i].id_equipo+'</td>'+ 
                '<td>'+data[i].tipo_equipo+'</td>'+  
                '<td>'+data[i].desc+'</td>'+
                '<td>'+data[i].sucursal+'</td>'+
                '<td>'+data[i].marca+'</td>'+
                '<td>'+data[i].encargado_nombre+'</td>'+     
                '<td><input type="button" class="borrar" value="Eliminar" /></td>';           
                '</tr> ';
            }
            
            
        }

        $("#tablaInventarioDeEquipoEditar").html(d);

        
    }

    var respParaEditarCargarEquipoParaInventario = function(data) 
    {
        if (!data && data == null) 
        return; 

        var sucursal = Cookies.get("sucursal_inv_paraEditar");
        console.log("SUCURSAL PARA EDITAR DESDE COOKIES: "+ sucursal);
        var d = '';
        var x = '';
        var found=0;
        var compareWith="";
        var tableReg = document.getElementById('tablaInventarioEditar');

        console.log("LENGHT= "+(tableReg.rows.length-1));
        for (var i = 1; i < tableReg.rows.length ; i++)
        {
        
            compareWith = document.getElementById("tablaInventarioEditar").rows[i].cells.item(0).innerHTML;

            console.log("DATOS= "+compareWith );
                
            if(data[0].id==compareWith)
            {
                
                found=1;
                M.toast({html: 'Dato repetido.', classes: 'rounded red'}); 
                return;
            }
            else
            {
                found=0;
            }
           
        }


        if(found==0)
        {
            var Descripcion=String(data[0].descripcion);
           
            if(Descripcion=="undefined")
            {
                M.toast({html: 'Sin datos sobre ese equipo!.', classes: 'rounded red'}); 
            
            }
            else
            {
                if(sucursal==data[0].sucursal)
                {
                    var fila="<tr><td>"+data[0].id+"</td><td>"+data[0].tipo_equipo+"</td><td>"+data[0].descripcion+"</td><td>"+data[0].nombre_sucursal+"</td><td>"+data[0].marca+"</td><td>"+data[0].encargado+"</td></tr> "+
                    '<td><input type="button" class="borrar" value="Eliminar" /></td>';
                    var btn = document.createElement("TR");
                    btn.innerHTML=fila;
                    document.getElementById("tablaInventarioDeEquipoEditar").appendChild(btn);
                }
                else
                {
                    
                    var opcion = confirm("Agregaste un equipo que no es de esa sucursal, estas seguro que quieres agregarlo a esta sucursal?");
                    if (opcion == true) 
                    {
                        
                        var fila="<tr><td>"+data[0].id+"</td><td>"+data[0].tipo_equipo+"</td><td>"+data[0].descripcion+"</td><td>"+data[0].nombre_sucursal+"</td><td>"+data[0].marca+"</td><td>"+data[0].encargado+"</td></tr> "+
                        '<td><input type="button" class="borrar" value="Eliminar" /></td>';
                        var btn = document.createElement("TR");
                        btn.innerHTML=fila;
                        document.getElementById("tablaInventarioDeEquipoEditar").appendChild(btn);
                    } 
                    else 
                    {
                        M.toast({html: '¡Equipo no agregado!.', classes: 'rounded red'});
                    }
                    
                    
                }
                
            
            }
        }
        else
        {
            M.toast({html: 'Dato repetido.', classes: 'rounded red'}); 
            return;
        }
        
            
        
        $('#codArticuloEdit').val("");
    }


    

    var respEliminarInventario = function(data) 
    {
        if (!data && data == null) 
        return; 


        console.log("eliminado inventario");


        var id_inventario = Cookies.get('i_inventarioID');

        var tableReg = document.getElementById('tablaInventarioEditar');
        console.log("LENGHT= "+(tableReg.rows.length-1));
        // Recorremos todas las filas con contenido de la tabla
        
        for (var i = 1; i < tableReg.rows.length ; i++)
        {
        
            compareWith = document.getElementById("tablaInventarioEditar").rows[i].cells.item(0).innerHTML;

            console.log("DATOS= "+compareWith );
                
            onRequest({ opcion : 110 ,inventario_id:id_inventario,equipo_id:compareWith}, respInsertarEnInventarioDetalle);
        
        }
        console.log("Terminaste los deberes!");
        M.toast({html: 'Inventario editado.', classes: 'rounded green'});

        //location.reload();
        onRequest({ opcion : 115, inventario_id:id_inventario }, respCargarInventarioParaEditar);


    }
    var respEliminarInventarioEditar = function(data) 
    {
        if (!data && data == null) 
        return; 


        console.log("eliminado inventario");


        var id_inventario = Cookies.get('i_inventarioID');

        var tableReg = document.getElementById('tablaInventarioEditar');
        console.log("LENGHT= "+(tableReg.rows.length-1));
        // Recorremos todas las filas con contenido de la tabla
        
        for (var i = 1; i < tableReg.rows.length ; i++)
        {
        
            compareWith = document.getElementById("tablaInventarioEditar").rows[i].cells.item(0).innerHTML;

            console.log("DATOS= "+compareWith );
                
            onRequest({ opcion : 110 ,inventario_id:id_inventario,equipo_id:compareWith}, respInsertarEnInventarioDetalle);
        
        }
        console.log("Terminaste los deberes!");
        M.toast({html: 'Inventario editado.', classes: 'rounded green'});

        


    }
    

    var respFinalizarInventario1 = function(data) 
    {
        if (!data && data == null) 
        return; 


        var id_inventario=data[0].id_inventario;
        onRequest({ opcion : 114 ,inventario_id:id_inventario}, respFinalizarInventario);


    }

    var respFinalizarInventario = function(data) 
    {
        if (!data && data == null) 
        return; 


        console.log("FINALIZADO inventario");

        M.toast({html: 'Inventario Finalizado.', classes: 'rounded green'});

        location.reload();


    }

    var respCargarInventarioParaVer = function(data) 
    {
        if (!data && data == null) 
        return; 

        var d="";
        var d2="";
       var inv="";

        for (var i = 0; i < data.length; i++) 
        {
            var sucursal=String(data[i].sucursal_nombre);
            console.log("-------"+sucursal);
            if(sucursal=="undefined")
            {
                d+="<tr> "+
                '<td>Sin equipos registrados en este inventario. </td>'+
                '</tr> ';
            }
            else
            {
                if(data[i].inventariado=="-")
                {
                    inv="No";
                }
                else
                {
                    inv="Si";
                }
                d+="<tr> "+
                '<td>'+data[i].id_equipo+'</td>'+ 
                '<td>'+data[i].tipo_equipo+'</td>'+  
                '<td>'+data[i].descripcion+'</td>'+   
                '<td>'+data[i].sucursal_nombre+'</td>'+   
                '<td>'+data[i].area+'</td>'+               
                '<td>'+data[i].encargado+'</td>'+          
                '<td>'+inv+'</td>'+             
                '</tr> ';

                d2+="<tr> "+
                '<td>'+data[i].id_equipo+'</td>'+ 
                '<td>'+data[i].tipo_equipo+'</td>'+  
                '<td>'+data[i].descripcion+'</td>'+   
                '<td>'+data[i].sucursal_nombre+'</td>'+   
                '<td>'+data[i].area+'</td>'+               
                '<td>'+data[i].encargado+'</td>'+          
                '<td>'+inv+'</td>'+   
                '<td>'+data[i].marca+'</td>'+   
                '<td>'+data[i].modelo+'</td>'+   
                '<td>'+data[i].valor_factura+'</td>'+               
                '<td>'+data[i].serie+'</td>'+            
                '</tr> ';

            }
            
            
        }

        $("#tablaInventarioDeEquipoVer").html(d);
        $("#tablaInventarioDeEquipoVer2").html(d2);

        inventarios({ opcion : 25},respCargarAreasTodas);  

        
    }

    

    var respEliminarInventarioRecienCreado = function(data) 
    {
        if (!data && data == null) 
        return; 

        var id_inventario= data[0].id_inventario;
        console.log("INVENTARIO ID= "+id_inventario);

        
        onRequest({ opcion : 120 ,inventario_id:id_inventario}, respInvEliminado);
        
    }


    var respInvEliminado = function(data) 
    {
        M.toast({html: 'El Inventario recien creado ha sido eliminado.', classes: 'rounded red'});
        $("#modalCrearInventario").modal("close");
    }

    
    var respCargarAreasTodas = function(data) { 
        if(!data && data == NULL)
            RETURN;  
     
        var documento='<option value=0 selected>Todas</option>';
    
        for(var i=0; i<data.length; i++){
            documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        
        $('#areadd').html(documento);
        $('#areadd').formSelect(); 
    
    }


    var respCargarInventarioXArea = function(data) 
    {
        if (!data && data == null) 
        return; 

        var d="";
        var d2="";
       var inv="";

        for (var i = 0; i < data.length; i++) 
        {
            var sucursal=String(data[i].sucursal_nombre);
            console.log("-------"+sucursal);
            if(sucursal=="undefined")
            {
                d+="<tr> "+
                '<td>Sin equipos registrados en este inventario. </td>'+
                '</tr> ';
            }
            else
            {
                if(data[i].inventariado=="-")
                {
                    inv="No";
                }
                else
                {
                    inv="Si";
                }
                d+="<tr> "+
                '<td>'+data[i].id_equipo+'</td>'+ 
                '<td>'+data[i].tipo_equipo+'</td>'+  
                '<td>'+data[i].descripcion+'</td>'+   
                '<td>'+data[i].sucursal_nombre+'</td>'+   
                '<td>'+data[i].area+'</td>'+               
                '<td>'+data[i].encargado+'</td>'+          
                '<td>'+inv+'</td>'+             
                '</tr> ';

                d2+="<tr> "+
                '<td>'+data[i].id_equipo+'</td>'+ 
                '<td>'+data[i].tipo_equipo+'</td>'+  
                '<td>'+data[i].descripcion+'</td>'+   
                '<td>'+data[i].sucursal_nombre+'</td>'+   
                '<td>'+data[i].area+'</td>'+               
                '<td>'+data[i].encargado+'</td>'+          
                '<td>'+inv+'</td>'+   
                '<td>'+data[i].marca+'</td>'+   
                '<td>'+data[i].modelo+'</td>'+   
                '<td>'+data[i].valor_factura+'</td>'+               
                '<td>'+data[i].serie+'</td>'+            
                '</tr> ';

            }
            
            
        }

        $("#tablaInventarioDeEquipoVer").html(d);
        $("#tablaInventarioDeEquipoVer2").html(d2);
        
    }

    
    


    