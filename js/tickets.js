$(document).ready(function(){
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
         $('.modal').modal();

         
     
         
/*
         
         $('#descripcionTicket').summernote({
            placeholder: 'Escriba la descripción',
            tabsize: 2,
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null
          });

          
          $('#comentarioTicket').summernote({
            placeholder: 'Escriba su mensaje',
            tabsize: 2,
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null
          });
          $('#comentarioTicketAdm').summernote({
            placeholder: 'Escriba su mensaje',
            tabsize: 2,
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null
          });

          */
         
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////

   
    $("#CrearTicketbtn").click(function() {
        var divEditor = textboxio.replace('#descripcionTicket');
        var usuario = Cookies.get('b_capturista_id');
        var titulo = $("#tituloTicket").val();
        var opciondd=$("#tituloDD").val();
        var desc= divEditor.content.get();
        var correo=$("#email").val();
        var telefono=$("#tel").val();
        console.log("ID empleado="+usuario+" opcion:"+opciondd);
        console.log("desc:"+desc+" email:"+correo+" telefono:"+telefono);
      

        if(titulo=="")
        {
            M.toast({html: 'Ingrese el titulo!', classes: 'rounded red'});
            return;
        }
        if(opciondd=="")
        {
            M.toast({html: 'Ingrese la opcion!', classes: 'rounded red'});
            return;
        }
        if(desc=="")
        {
            M.toast({html: 'Ingrese la descripcion!', classes: 'rounded red'});
            return;
        }
        if(correo=="")
        {
            M.toast({html: 'Agregue su correo!', classes: 'rounded red'});
            return;
        }
        if(telefono=="")
        {
            M.toast({html: 'Agregue su telefono!', classes: 'rounded red'});
            return;
        }
        tickets({ opcion : 1, capturista:usuario,titulo:titulo, departamento_id:opciondd,desc:desc, email:correo, tel:telefono },respAgregaTicket);

    });

    $("#btnActualizarEstatusticket").click(function() {
        $('#modalAceptarFinalizacionADM').modal('open');
        /*
        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        var estatus =  $("#EstatusTicketDD").val();

        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+"   estatus: "+estatus);

        tickets({ opcion : 6, ticket_id:ticket_id,usuario:usuario, id_estatus:estatus},respActualizarTicket);
        */
    
    });
    
    $("#btnAceptarfinalizacionAdm").click(function() {
        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        var divEditor3 = textboxio.replace('#comentarioTicketAdm');
        var mensaje = divEditor3.content.get();
        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+" Mensaje: "+mensaje);

        tickets({ opcion : 6, ticket_id:ticket_id,usuario:usuario, id_estatus:2}, respActualizarTicket);
        tickets({ opcion : 7, ticket_id:ticket_id, mensaje:mensaje, usuario:usuario}, respMensajesFinalizadoAdm);
    });



    $("#btnActualizarEstatusticketUsu").click(function() {

        $('#modalAceptarFinalizacion').modal('open');
       /*
        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        var estatus =  $("#EstatusTicketDDUsu").val();

        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+"   estatus: "+estatus);

        tickets({ opcion : 6, ticket_id:ticket_id,usuario:usuario, id_estatus:estatus}, respActualizarTicketusu);
     */
    });

    
    
    $("#btnAceptarfinalizacion").click(function() {

        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        var divEditor2 = textboxio.replace('#comentarioTicket');
        var mensaje = divEditor2.content.get();
        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+"Contenido del mensaje: "+mensaje);
        tickets({ opcion : 6, ticket_id:ticket_id,usuario:usuario, id_estatus:2}, respActualizarTicketusu);
        tickets({ opcion : 7, ticket_id:ticket_id, mensaje:mensaje, usuario:usuario}, respMensajesFinalizado);
     
    });

    $("#btnComentarioTicketAdm").click(function() {
        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        var divEditor3 = textboxio.replace('#comentarioTicketAdm');
        var mensaje = divEditor3.content.get();

        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+"   mensaje: "+mensaje);

        tickets({ opcion : 7, ticket_id:ticket_id, mensaje:mensaje, usuario:usuario}, respMensajesAdmn);
    
    });

    $("#btnComentarioTicket").click(function() {
        var usuario = Cookies.get('b_capturista_id');
        var ticket_id = Cookies.get('b_ticket_id');
        
        var divEditor2 = textboxio.replace('#comentarioTicket');
        var mensaje = divEditor2.content.get();
        console.log("MENSAJE: "+mensaje);
        if(mensaje=="")
        {
            M.toast({html: 'Escriba su mensaje!', classes: 'rounded red'});
            return;
        }

        console.log("USUARIO: "+usuario+" TICKET: "+ticket_id+"   mensaje: "+mensaje);

        tickets({ opcion : 7, ticket_id:ticket_id, mensaje:mensaje, usuario:usuario}, respMensajes);
    
    });


    $("#ActualizarMensajesManTicket").click(function() {
        var ticket_id=Cookies.get('b_ticket_id');
        tickets({ opcion : 8, ticket_id: ticket_id}, respCargarMensajes);
    
    });

    
    $("#buscarXestatus").click(function() {
        var estatus_id=$('#selectEstatus').val();
        tickets({ opcion : 3, estatus_id: estatus_id}, respCargarTickets);
    
    });
    
   


});

    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////

    var respAgregaTicket = function(data) { 
        //se insertan los datos en la tabla confirmaciones!
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        

        M.toast({html: 'Ticket insertado correctamente ', classes: 'rounded green'});
        
        
        location.reload();
        $("#modalCrearTicket").modal("close");
        cargarTicketsPorUsuario(); 
        
    }
    var respCargarTicketsPorUsuario = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        var d = '';
        var x = '';
    
    
        console.log("Length:"+data.length);
         for (var i = 0; i < data.length; i++) 
         {
             
             var titulo=String(data[i].titulo);
            if(titulo=="undefined")
            {
                d+= '<tr>'+
                '<td>Sin Tickets generados</td>'+
                '<td class="left">'+ 
                '</tr> ';  
            }
            else
            {
                var estatus=data[i].id_estatus;
                if(estatus==13)
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
                    '<td>'+data[i].titulo+'</td>'+
                    '<td>'+data[i].fecha+'</td>'+
                    '<td>'+data[i].solicitado+'</td>'+
                    '<td>-</td>'+
                    '<td>'+data[i].estatus+'</td>'+ 
                    '<td class="'+x+' left">'+
                    '<a onclick="comentTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalComentariosTicket"><i class="material-icons">comment</i></a>' + 
                    //'<a onclick="deshabDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabDoc"><i class="material-icons">do_not_disturb_alt</i></a>' + 
                    //'<a onclick="BorrarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarDoc"><i class="material-icons">delete</i></a>' +
                    '</td>'  +'</tr> ';
                }
                else
                {
                    if(estatus==2)
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
                        '<td>'+data[i].titulo+'</td>'+
                        '<td>'+data[i].fecha+'</td>'+
                        '<td>'+data[i].solicitado+'</td>'+
                        '<td>'+data[i].usuario_resolviendo+'</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="'+x+' left">'+
                        '<a onclick="comentTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalComentariosTicket"><i class="material-icons">comment</i></a>' + 
                        '<a class="waves-effect waves-light btn-floating btn-small green btn modal-trigger"><i class="material-icons">assignment_turned_in</i></a>' + 
                        //'<a onclick="BorrarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarDoc"><i class="material-icons">delete</i></a>' +
                        '</td>'  +'</tr> ';
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
                        '<td>'+data[i].titulo+'</td>'+
                        '<td>'+data[i].fecha+'</td>'+
                        '<td>'+data[i].solicitado+'</td>'+
                        '<td>'+data[i].usuario_resolviendo+'</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="'+x+' left">'+
                        '<a onclick="comentTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalComentariosTicket"><i class="material-icons">comment</i></a>' + 
                        //'<a class="waves-effect waves-light btn-floating btn-small green btn modal-trigger"><i class="material-icons">assignment_turned_in</i></a>' + 
                        //'<a onclick="BorrarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarDoc"><i class="material-icons">delete</i></a>' +
                        '</td>'  +'</tr> ';
                    }
                }
                
            }
                
        }
             
           
                
            $("#tablaTicketsGeneral").html(d);
            cargarMenuPorRol();
    }
    

    var respCargarTickets = function(data) { 
    
        if (!data && data == null) 
        return; 
    
        var d = '';
        var x = '';
    
    
        console.log("Length:"+data.length);
         for (var i = 0; i < data.length; i++) {
            var titulo=String(data[i].titulo);
            if(titulo=="undefined")
            {
                d+= '<tr>'+
                '<td>Sin Tickets generados</td>'+
                '<td class="left">'+ 
                '</tr> ';  
            }
            else
            {
                if(data[i].id_estatus==13)
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
                    '<td>'+data[i].titulo+'</td>'+
                    '<td>'+data[i].solicitado+'</td>'+
                    '<td>'+data[i].fechaC+'</td>'+
                    '<td>'+data[i].horaC+'</td>'+
                    '<td>-</td>'+
                    '<td>'+data[i].estatus+'</td>'+ 
                    '<td class="'+x+' left">'+
                    '<a onclick="adminTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger" href="#modalAdminTicket"><i class="material-icons">build</i></a>' + 
                    '</td>'  +'</tr> ';                  

                }
                else
                {
                    if(data[i].id_estatus==2)
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
                        '<td>'+data[i].titulo+'</td>'+
                        '<td>'+data[i].solicitado+'</td>'+
                        '<td>'+data[i].fechaC+'</td>'+
                        '<td>'+data[i].horaC+'</td>'+
                        '<td>'+data[i].usuario_resolviendo+'</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="'+x+' left">'+
                        '<a onclick="adminTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger" href="#modalAdminTicket"><i class="material-icons">build</i></a>' + 
                        '<a class="waves-effect waves-light btn-floating btn-small green btn modal-trigger"><i class="material-icons">assignment_turned_in</i></a>' + 
                        '</td>'  +'</tr> ';          
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
                        '<td>'+data[i].titulo+'</td>'+
                        '<td>'+data[i].solicitado+'</td>'+
                        '<td>'+data[i].fechaC+'</td>'+
                        '<td>'+data[i].horaC+'</td>'+
                        '<td>'+data[i].usuario_resolviendo+'</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="'+x+' left">'+
                        '<a onclick="adminTicket('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger" href="#modalAdminTicket"><i class="material-icons">build</i></a>' + 
                        '</td>'  +'</tr> ';          
                    }
                            

                }
               

            }
        }
                     
        $("#tablaTicketsTodos").html(d);
        cargarMenuPorRol();
    }


    
    var respCargarAdminTicket = function(data) { 
        if (!data && data == null)
        return;  
 
        var estatus_id=data[0].estatus_id;

        if(estatus_id==2)
        {
            console.log("Estatus finalizado");
            $("#btnComentarioTicketAdm").attr('disabled','disabled');
            $("#btnActualizarEstatusticket").attr('disabled','disabled');
        }
        else
        {
            console.log("Estatus NO finalizado");
            $("#btnComentarioTicketAdm").removeAttr("disabled");
            $("#btnActualizarEstatusticket").removeAttr("disabled");
        }
     
        var des=data[0].descripcion;
        $('#descripcionTicketAdm').html(des);
    }

   
    var respActualizarTicket = function(data) { 
        if (!data && data == null)
        return;  


        
        M.toast({html: 'Estatus Actualizado!=)', classes: 'rounded green'});
        cargarTickets();
    }
    var respActualizarTicketusu = function(data) { 
        if (!data && data == null)
        return;  


        
        M.toast({html: 'Estatus Actualizado!=)', classes: 'rounded green'});
        cargarTicketsPorUsuario();
    }
    var respMensajesAdmn = function(data) { 
        if (!data && data == null)
        return;  



        M.toast({html: 'Mensaje enviado!=)', classes: 'rounded green'});
        var divEditor3 = textboxio.replace('#comentarioTicketAdm');
        var content="";
        divEditor3.content.set(content);
        

        var ticket_id=Cookies.get('b_ticket_id');
        tickets({ opcion : 8, ticket_id: ticket_id}, respCargarMensajes);
    }

    var respMensajes = function(data) { 
        if (!data && data == null)
        return;  



        M.toast({html: 'Mensaje enviado!=)', classes: 'rounded green'});
        var content="";
        var divEditor2 = textboxio.replace('#comentarioTicket');
        divEditor2.content.set(content);
        
        

        var ticket_id=Cookies.get('b_ticket_id');
        tickets({ opcion : 8, ticket_id: ticket_id}, respCargarMensajes);
    }

    
    var respMensajesFinalizado = function(data) { 
        if (!data && data == null)
        return;  



        M.toast({html: 'Mensaje enviado!=)', classes: 'rounded green'});
        var content="";
        var divEditor2 = textboxio.replace('#comentarioTicket');
        divEditor2.content.set(content);
        
        
        $("#modalAceptarFinalizacion").modal("close");
        location.reload();
    }

    var respMensajesFinalizadoAdm = function(data) { 
        if (!data && data == null)
        return;  



        M.toast({html: 'Mensaje enviado!=)', classes: 'rounded green'});
        var content="";
        var divEditor3 = textboxio.replace('#comentarioTicketAdm');
        divEditor3.content.set(content);
        
        
        $("#modalAceptarFinalizacionADM").modal("close");
        location.reload();
    }


    

    var respCargarMensajes = function(data) { 
        if (!data && data == null)
        return;  

        var d="";
        for (var i = 0; i < data.length; i++) 
        {
            var de=String(data[i].de);
            if(de=="undefined")
            {
                d+="<p><b>Sin comentarios.</b></p><br>";
            }
            else
            {
                d+="<p><b>"+data[i].de+"</b>   &nbsp;"+data[i].fecha+"  "+data[i].hora+"</p><br><p>"+data[i].mensaje+"</p><br>";
            }

        }
        $('#cardTicketAdm').html(d); 

       
        //comentTicket(data[0].id_ticket);
    }

    var respCargarComentarioPorEstatus = function(data) { 
        if (!data && data == null)
        return;  
        var d="";
        var estatus=data[0].estatus_id;
        
        
        if(estatus==2)
        {
            console.log("Estatus finalizado");
            $("#btnComentarioTicket").attr('disabled','disabled');
            $("#btnActualizarEstatusticketUsu").attr('disabled','disabled');
        }
        else
        {
            console.log("Estatus NO finalizado");
            $("#comentarioTicket").removeAttr("disabled");
            $("#btnComentarioTicket").removeAttr("disabled");
            $("#btnActualizarEstatusticketUsu").removeAttr("disabled");
        }

        var de=String(data[0].descripcion);
        console.log("descripcion: "+de);
        
        if(de=="undefined")
        {
            d+="<p><b>Sin descripcion.</b></p><br>";
        }
        else
        {
            d+=de;
        }
        $('#cardDescTicket').html(d);
         

    }
    var respCargarSelectEstatus = function(data) { 
        if (!data && data == null)
        return;  

        var documento='<option value="0"  selected>Seleccione un estatus</option>';

        for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        

        $('#selectEstatus').html(documento);
        $('#selectEstatus').formSelect(); 

    }



    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    
    function cargarTicketsPorUsuario(){

        empleadoid = Cookies.get('b_capturista_id');
        console.log("CARGANDO TICKETS POR USUARIO "+empleadoid);
        var divEditor = textboxio.replace('#descripcionTicket');
        var divEditor2 = textboxio.replace('#comentarioTicket');
        tickets({ opcion : 2, capturista: empleadoid}, respCargarTicketsPorUsuario);
        
    }

    function cargarTickets(){

        var divEditor3 = textboxio.replace('#comentarioTicketAdm');
        tickets({ opcion : 3, estatus_id: "0"}, respCargarTickets);
        tickets({ opcion : 9}, respCargarSelectEstatus);
        
    }

    function comentTicket(id)
    {
        console.log("ADMINISTRACION DE TICKETS");
        Cookies.set("b_ticket_id", id );
        var ticket_id=Cookies.get('b_ticket_id');
        console.log("TICKET ID DESDE COOKIES: "+ticket_id);
        tickets({ opcion : 4, id_ticket: ticket_id}, respCargarComentarioPorEstatus);
        tickets({ opcion : 8, ticket_id: ticket_id}, respCargarMensajes);
        
        
    }
    
    function adminTicket(id)
    {
        console.log("ADMINISTRACION DE TICKETS");
        Cookies.set("b_ticket_id", id );
        var ticket_id=Cookies.get('b_ticket_id');
        console.log("TICKET ID DESDE COOKIES: "+ticket_id);
        tickets({ opcion : 4, id_ticket:ticket_id}, respCargarAdminTicket);
        tickets({ opcion : 8, ticket_id: ticket_id}, respCargarMensajes);
       
       
    }

    

 