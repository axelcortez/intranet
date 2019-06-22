// Funcion principal de Jquery la cual escanea en tiempo real nuestro documento para verificar que los eventos se ejecuten correctamente
$(document).ready(function(){

    M.updateTextFields();
    //Inicialización de los select Materialize
    $('select').formSelect();
    
    //Inicializacion de los tooltip
    $('.tooltipped').tooltip({delay: 50});

    //GUARDAR CELULAR
    $( "#btnGuardarCel" ).click(function() { 
        var cel = $('#telefonoEmpleado').val();
        var capturista_id = $('#capturista_id').val();

        if(cel.length==0){
          M.toast({html: 'Es necesario ingresar un numero', classes: 'rounded red'});
        }

        onRequest({ opcion : 101,capturista_id:capturista_id,cel:cel},resGuardarCel);
        
  });
      
    //CERRAR SESION
    $( "#btnCerrarSession" ).click(function() { 
        Cookies.remove('b_capturista_id');
        Cookies.remove('b_usuario');
        Cookies.remove('b_capturista');
        Cookies.remove('b_rol_id');
        Cookies.remove('b_empresa_id');
        Cookies.remove('b_puesto_id'); 
        location.href="/intranet/";
        
  });
    $( "#btnCerrarSessionSmall" ).click(function() { 
        Cookies.remove('b_capturista_id');
        Cookies.remove('b_usuario');
        Cookies.remove('b_capturista');
        Cookies.remove('b_rol_id');
        Cookies.remove('b_empresa_id');
        Cookies.remove('b_puesto_id'); 
        location.href="/intranet/";
        
  });
    //inicializamos modals
        $('#modalAceptarDoc').modal();
        
    //-----------------------------------
    //validacion del submit de publicaciones
    $( "#btnEnviarForm" ).click(function() {
         
        var titulo = $("#pTitulo").val();
        var documento = $("#docId").val();
        var descripcion = $("#pDescripcion").val();
        var tipopublic = $("#tipoPubAddFile").val();
        var empresa = $("#tipoEmpresaAddFile").val();
        var docname="SIN DOCUMENTO";
        var usuario = Cookies.get('b_capturista_id');

        if($('#chkDoc').is(":checked")) { 
            if(documento.length<=0){
                M.toast({html: 'Es necesario incluir un documento', classes: 'rounded red'});
                return;
            }
            docname = $("#tittleDoc").val();
            var cdocumento ='S';
         } 
         else{
            cdocumento ='N';
         }
 

         //valida que los campos no queden vacios para evitar errores
        if(titulo.length<=0){
            M.toast({html: 'El Titulo de la publicacion no puede estar vacio', classes: 'rounded red'});
            return;
        }
 
        if(descripcion.length<=0){
            M.toast({html: 'Es necesario incluir una descripcion en la publicacion', classes: 'rounded red'});
            return;
        }
        if(tipopublic <=0){
            M.toast({html: 'Es necesario especificar el tipo de publicacion', classes: 'rounded red'});
            return;
        }
        if(empresa<=0){
            M.toast({html: 'Es necesario especificar la empresa ala que se dirige', classes: 'rounded red'});
            return;
        }
        /*
        ---Se comento porque ya no fue necesario---
        if(tiporol<=0){
            M.toast({html: 'Es necesario especificar el rol al que se dirige la publicacion', classes: 'rounded red'});
            return;
        } */
        onRequest({ opcion : 76, usuario_id:usuario},respPermitirPublicacion);

        

        //$( "#formFiles" ).submit();
      });

      //gurdar datos  de la publicacion

      $( "#aceptarPublicacion" ).click(function() {

            $('#aceptarPublicacion').addClass("disabled"); 
            $('#cancelarPub').addClass("disabled"); 
            var titulo = $("#pTitulo").val();
            var descripcion = $("#pDescripcion").val();
            var tipopublic = $("#tipoPubAddFile").val();
            /*var tipoempresa = $("#tipoEmpresaAddFile").val();
            var tiporol = $("#tipoRolAddFile").val();*/
            var docname="SIN DOCUMENTO";
            var cdocumento="";
            var esPDF="";
            

            if($('#chkDoc').is(":checked")) {  
                 docname = $("#tittleDoc").val();
                 cdocumento ='S';
            } 
            else{
                 cdocumento ='N';
            }
            
            if($('#chkPdfImg').is(":checked")) {  
                esPDF="PDF"
           } 
           else{
               esPDF="IMG"
           }
           
            
            onRequest({ opcion : 25,titulo:titulo,descripcion:descripcion,imagen:docname,documento_id:tipopublic,docuemento:cdocumento,chbPDF:esPDF},respPublicacion);

      });
 
    //inicializamos contador de caracteres
    $('#pDescripcion').characterCounter();
 
    //inicializamos selects
    onRequest({ opcion : 4,doc:''},respTpublic);
    onRequest({ opcion : 2,empresa:''},respEmpresa);
    onRequest({ opcion : 3,rol:''},respRol);
    onRequest({ opcion : 3,rol:''},respRolAccesos);
    onRequest({ opcion : 29,usuario:''},respUsuariosDD);

    (function($) {  
        $.get = function(key)   {  
            key = key.replace(/[\[]/, '\\[');  
            key = key.replace(/[\]]/, '\\]');  
            var pattern = "[\\?&]" + key + "=([^&#]*)";  
            var regex = new RegExp(pattern);  
            var url = unescape(window.location.href);  
            var results = regex.exec(url);  
            if (results === null) {  
                return null;  
            } else {  
                return results[1];  
            }  
        }  
    })(jQuery); 

///----------------------------------------------------------------

    //Inicializamos menu
    $('.dropdown-trigger').dropdown();
    //contador de caracteres para tex area
    $('textarea#textopub').characterCounter();
    //inicializar el modal        
    $('.modal').modal();
      
      
       
     //evento de switch de documentos 
     $( "#chkDoc" ).click(function() {  

        if($(this).is(":checked")) {
             $("#btndocId").removeClass('grey');
             $("#docId").removeAttr("disabled");
          }
          else {
            $("#btndocId").addClass('grey');
            $("#docId").attr('disabled','disabled');
          }
     });


     //el boton de notificacion nos enviara al inicio para ver las publicaciones faltantess
     $( "#btnNotiF" ).click(function() {  

        location.href="/intranet/";
        
     });

    //Inicia el evento click en el boton del login
    $( "#btn_login" ).click(function() { 
        //inicializamos variables
        var user='';
        var pass='';
        //igualamos variables con jquery obtenemos el valor '.val()' del id indicado con '$(#ID)'
        user = $("#user").val();
        pass =  $("#password").val();

        // Validamos que los campos no esten vacios
        if(user==''){
            M.toast({html: 'El nombre de usuario no puede ir vacio', classes: 'rounded red'}); 
            return;
        }

        if(pass==''){
            M.toast({html: 'La contraseña no puede ir vacia', classes: 'rounded red'}); 
            return;
        }   
       // llamamos a funcion de ajax para conectar con nuestro servidor php funcion(parametro1,parametro2), el primer parametro es un JSON y el segun una funcion de respuesta en donde recibiremos los datos que nos regrese  ajax
       
        onRequest({ opcion : 1 ,usuario:user,password:pass },respUser);

        //Redirige al index
        
        
        
        
     });
     
     
     // Fin de click en login
     //------------------------------------------------------------------------------------------------------------------//

     

//---------------------------------Botones para redirigir en el Menu sidenav--------------------------------------------------

     //Redirige al login 
     $( "#salirsesion" ).click(function() { 
        location.href="/intranet/login.html";
     });
     //Redirige al catalogo de empresas
     $( "#catemp" ).click(function() { 
        
        location.href="/intranet/catalogos/catemp.php";
     });
    //Redirige al catalogo de rolas
     $( "#catroles" ).click(function() { 
        location.href="/intranet/catalogos/catroles.php";
     });
     //Redirige al catalogo de tipo de documentos
     $( "#catdoc" ).click(function() { 
        location.href="/intranet/catalogos/catdoc.php";
     });
     //Redirige al inicio
     $( "#m_inicio" ).click(function() { 
        location.href="/intranet/";
     });
      //Redirige a los accesos
     $( "#m_accesos" ).click(function() { 
        location.href="/intranet/mantenimiento/accesos.php";
     });
     
     $( "#tipoRolAc" ).keypress(function() { 
        console.log("Presionaste");
     });
     
     $( "#correos" ).click(function() { 
        location.href="/intranet/catalogos/catcorreos.php";
     });

     $( "#m_rol_usu" ).click(function() { 
        location.href="/intranet/mantenimiento/rolusu.php";
     });

     $( "#m_usuarios" ).click(function() { 
        location.href="/intranet/mantenimiento/usuariosTabla.php";
     });
     
     $( "#catEquipo" ).click(function() { 
        location.href="/intranet/catalogos/cattiposequipo.php";
     });
     

//----------------------------------busquedas--------------------------------------------------------------------
     //Busqueda por empresa
     $("#busquedaEmpleados").keypress(function(e) {
          //inicializamos variables
        if(e.which == 13) {
            var busqueda='';
            busqueda =  $("#busquedaEmpleados").val();
            console.log(busqueda);
            onRequest({ opcion : 2,empresa:busqueda},respEmpresas);
        }
    });

    //Busqueda por roles
    $("#busquedaRoles").keypress(function(e) {
        //inicializamos variables
      if(e.which == 13) {
          var busqueda='';
          busqueda =  $("#busquedaRoles").val();
          console.log(busqueda);
          onRequest({ opcion : 3,rol:busqueda},respRoles);
      }
  });

  //Busqueda por tipo de documentos
  $("#busquedaDoc").keypress(function(e) {
    //inicializamos variables
  if(e.which == 13) {
      var busqueda='';
      busqueda =  $("#busquedaDoc").val();
      console.log(busqueda);
      onRequest({ opcion : 4,doc:busqueda},respDoc);
  }
});
//Busqueda de usuarios


$("#btnBusquedaUsuario").click(function() {
    var busqueda='';
    busqueda =  $("#IdEmpleadoCor").val();
    if(busqueda=="")
    {
        console.log("Busqueda viene vacia");
        onRequest({ opcion : 35, usuario_id:""}, respCargaUsuarios);
    }
    else
    {
        console.log(busqueda);
        onRequest({ opcion : 97,empleado_id:busqueda},respCargaUsuarios);
    }
    

});

$("#idEmpleadoCorreo").keypress(function(e) {
    //inicializamos variables
  if(e.which == 13) {
       idempleado =  $("#idEmpleadoCorreo").val();
      console.log("ENTER!!"+idempleado);
      onRequest({ opcion : 63,usuario_id:idempleado},respCargarEmpleadoCorreo);
      
  }
});


//-------------------------------Accion para AGREGAR DENTRO DE LOS MODAL--------------------------------
//-----------------------------------Agregar empresa------------------------------
    $("#BtnAgregarEmpresa").click(function() {
        var nombreEmp='';
        nombreEmp = $("#nomEmp").val().toUpperCase();

        if(nombreEmp==""){
            M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
            return;
        }
        console.log("Presionaste el boton del modal para agregar empresa: "+nombreEmp);
        onRequest({ opcion : 5, empresa:nombreEmp},respAgregaEmpresa);

    });

//-------------------------------------AGREGAR ROLES------------------------------------
    $("#BtnAgregarRol").click(function() {
        var nombreRol='';
        nombreRol = $("#nomrol").val().toUpperCase();

        if(nombreRol==""){
            M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
            return;
        }
        console.log("Presionaste el boton del modal para agregar roles: "+nombreRol);
        onRequest({ opcion : 6, rol:nombreRol},respAgregaRol);

    });
//-------------------------------------AGREGAR Tipo de documentos------------------------------------
    $("#BtnAgregarDoc").click(function() {
        var nombreDoc='';
        nombreDoc = $("#nomdoc").val().toUpperCase();
        if(nombreDoc==""){
            M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
            return;
        }
        console.log("Presionaste el boton del modal para agregar tipo de documentos: "+nombreDoc);
        onRequest({ opcion : 7, doc:nombreDoc},respAgregaDoc);

    });
//-------------------------------Accion para editar DENTRO DE LOS MODAL--------------------------------
//------------------------------------------Editar empresa--------------------------------
    $("#BtnEditarEmpresa").click(function() {
        var empID ='';
        var nomAct='';
        empID = $("#idEmpEdit").val();
        nomAct = $("#nomEmpEdit").val().toUpperCase();
        if(nomAct==""){
            M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
            return;
        }
        console.log("Presionaste boton de editar "+empID+nomAct);
        onRequest({ opcion : 9 ,empresa_id:empID,empresa:nomAct}, respActualizarEmp);
    });
//------------------------------------------Editar rol--------------------------------
$("#BtnEditarRol").click(function() {
    var rolID ='';
    var nomAct='';
    rolID = $("#idRolEdit").val();
    nomAct = $("#editNomRol").val().toUpperCase();
    if(nomAct==""){
        M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
        return;
    }
    console.log("Presionaste boton de editar "+rolID+nomAct);
    onRequest({ opcion : 11 ,rol_id:rolID,rol:nomAct}, respActualizarRol);
});
//------------------------------------------Editar doc--------------------------------
$("#BtnEditarDoc").click(function() {
    var docID ='';
    var nomAct='';
    docID = $("#idDocEdit").val();
    nomAct = $("#editNomDoc").val().toUpperCase();
    if(nomAct==""){
        M.toast({html: 'Los datos ingresados no son correctos.', classes: 'rounded red'}); 
        return;
    }
    console.log("Presionaste boton de editar "+docID+nomAct);
    onRequest({ opcion : 13 ,doc_id:docID,doc:nomAct}, respActualizarDoc);
});

/*
$( "#btnPrueba" ).click(function() {
     var p = $('#'+id_cb).is(':checked')
});*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------------------Accion para deshabilitar DENTRO DE LOS MODAL--------------------------------
//------------------------------------------Deshabilitar empresa-------------------------------

$("#btnDesEmp").click(function() {
    var empID ='';
    empID = $("#idEmpDes").val();
    console.log("Presionaste boton de deshanilitar "+empID);
    onRequest({ opcion : 14 ,emp_id:empID}, respDesEmpFinal);
});
//------------------------------------------Deshabilitar rol--------------------------------------

$("#btnDesRol").click(function() {
    var rolID ='';
    rolID = $("#idRolDes").val();
    console.log("Presionaste boton de deshabilitar "+rolID);
    onRequest({ opcion : 15 ,rol_id:rolID}, respDesRolFinal);
});
//------------------------------------------Deshabilitar tipo de documento--------------------------------------

$("#btnDesDoc").click(function() {
    var docID ='';
    docID = $("#idDocDes").val();
    console.log("Presionaste boton de deshabilitar "+docID);
    onRequest({ opcion : 16 ,doc_id:docID}, respDesDocFinal);
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------------------Accion para Eliminar DENTRO DE LOS MODAL--------------------------------
//------------------------------------------Eliminar empresa-------------------------------

$("#btnEliEmp").click(function() {
    var empID ='';
    empID = $("#idEmpEli").val();
    console.log("Presionaste boton de eliminar "+empID);
    onRequest({ opcion : 17 ,emp_id:empID}, respEliEmpFinal);
});
//------------------------------------------Eliminar rol--------------------------------------

$("#btnEliRol").click(function() {
    var rolID ='';
    rolID = $("#idRolEli").val();
    console.log("Presionaste boton de eliminar "+rolID);
    onRequest({ opcion : 18 ,rol_id:rolID}, respEliRolFinal);
});
//------------------------------------------Eliminar tipo de documento--------------------------------------

$("#btnEliDoc").click(function() {
    var docID ='';
    docID = $("#idDocEli").val();
    console.log("Presionaste boton de eliminar "+docID);
    onRequest({ opcion : 19 ,doc_id:docID}, respEliDocFinal);
});
//--------------------------------------------Eliminar Correo----------------------------
$("#btnBorrarCorreo").click(function() {
    var correoid ='';
    correoid = $("#id_correo").val();
    console.log("Presionaste boton de eliminar "+correoid);
    onRequest({ opcion : 67 ,id_correo:correoid}, respBorrarCorreoFinal);
});
//------------------------------------------Boton agregar configuracion de usuarios-----------------------------
$("#btnAgregarUsu_Rol").click(function() {
    usuario = $("#UsuariosDD2").val();
    rol = $("#tipoRolAc").val();
    console.log("Presionaste boton "+usuario+" "+rol);
    if(rol==null){
        M.toast({html: 'No tiene ningun rol seleccionado!', classes: 'rounded red'});
    }
    else{
        onRequest({ opcion : 33 ,usuario:usuario,rol:rol}, respVerificar_usu_rol);
    }
    
});

$("#btnAgregarEmp_Rol").click(function() {
    empresa = $("#Empresarol").val();
    puesto = $("#tipoPuestoAc").val();
    console.log("Presionaste boton "+empresa+" "+puesto);
    if(puesto==null){
        M.toast({html: 'No tiene ningun puesto seleccionado!', classes: 'rounded red'});
    }
    else{
        onRequest({ opcion : 42 ,idemp:empresa,idrol:puesto}, respVerificar_emp_rol);
    }
    
});

$("#agregaAtodos").click(function() {
    console.log("Boton presionado");
    console.log("Cargando todas las insercciones");
    onRequest({ opcion : 93 }, respUsuariosParaInseccion);
    
    
});



$("#btnAgregarUsu_Empresa").click(function() {
    usuario = $("#UsuariosDD2").val();
    empresa = $("#tipoEmpresaAddFile").val();  
    console.log("Presionaste boton "+usuario+" "+empresa);
    if(empresa==null){
        M.toast({html: 'No tiene ninguna empresa seleccionada!', classes: 'rounded red'});
    }
    else{
        onRequest({ opcion : 34 ,usuario:usuario,empresa:empresa}, respVerificar_usu_empresa);
    }

});

$("#btn_regresar_rolusu").click(function() {
    location.href="/mantenimiento/usuariosTabla.php";

});
$("#btn_regresar_rolemp").click(function() {
    location.href="/catalogos/catemp.php";

});
$("#btnAgEmp_PuestoTmp").click(function() {
    var usuario = Cookies.get('b_capturista_id');
    var empresa = $("#tipoEmpresaAddFile").val(); 
    var sucursal = $("#sucursalesDD").val();  
    var puesto = $("#tipoPuestoXemp").val(); 
    console.log(usuario+" "+empresa+" "+puesto);
    onRequest({ opcion : 46 ,idemp:empresa,idpuesto:puesto, idusuario:usuario, idsucursal:sucursal}, respTablaTmp);


});


$("#btnLimpiar").click(function() {
    
    $("#IdEmpleadoCor").val("");
    $("#nombreAbuscarCor").val("");
    onRequest({ opcion : 70 }, respcargasucursales);
    onRequest({ opcion : 45 },respCargarPuestosParaCorreos);
    
    
    M.toast({html: 'Filtros reestablecidos!', classes: 'rounded green'});  
    return;


});

///------------------------------------------PUBLICACIONES--------------------------------------------------------
//----------------------------------------------Agregar publicacion modal---------------------------------------- 
$("#BtnAgregarPub").click(function() {
    var textoPublicacion='';
    var tipodoc='';
    var empresa_id='';
    var rol_id='';
    var documento='';


    textoPublicacion = $("#textopub").val();
    tipodoc=$("#tipoPub").val();
    empresa_id=$("#tipoEmpresa").val();
    rol_id=$("#tipoRol").val();
    docuemento =$("#documentoCargado").val();
   
    
    console.log(documento);
 
    return;
    onRequest({ opcion : 21, texto:textoPublicacion, tipopub:tipodoc},respAgregaPublicacion);

});
//----------------------------------------CORREOS------------------------------------
$( "#BtnAgregarCorreo" ).click(function() { 
    var idusuario=$("#idEmpleadoCorreo").val();
    var correo=$("#correoEmpleado").val();
    var pass=$("#passEmpleado").val();
    var dominio=$("#dominioDD option:selected").text();
    console.log(idusuario+" "+correo+" "+pass+" "+dominio);

    if(correo=="" || pass=="")
    {
        M.toast({html: 'Correo y/o contraseña vacios, favor de ingresar correo y contraseña', classes: 'rounded red'}); 
        console.log(correo+" "+pass+" "+dominio);
    }
    else
    {
        if(dominio=="Dominio:")
        {
            M.toast({html: 'Dominio no seleccionado, favor de seleccionar uno.', classes: 'rounded red'}); 
        }
        else
        {
            var correoarmado="";

            if(dominio=="presico")
            {
                correoarmado=correo+"@"+dominio+".mx";
            }
            else
            {
                if(dominio=="dejur")
                {
                    correoarmado=correo+"@"+dominio+".com.mx";
                }
                else
                {
                    correoarmado=correo+"@"+dominio+".com";
                }
               
            }
            console.log(correoarmado);

            onRequest({ opcion : 64, usuario_id:idusuario, dominio:dominio,correo:correoarmado, pass:pass },respAgregaCorreo);

        }
    }


    
    
});
$( "#BtnEditarCorreo" ).click(function() { 
    var idusuario=$("#idCorreoEdit").val();
    var correo=$("#editCorreo").val();
    var pass=$("#editPass").val();
    var entregado="";
    var estatus="";
    if($("#cbEntregado").prop('checked') )
    {
        entregado="Si";
    }
    else
    {
        entregado="No";
    }

    if($("#cbEstatus").prop('checked') )
    {
        estatus="Activo";
    }
    else
    {
        estatus="Baja";
    }

    console.log(idusuario+" "+correo+" "+pass+" "+entregado+" "+estatus);

    onRequest({ opcion : 66, usuario_id:idusuario, correo:correo, pass:pass,entregado:entregado, estatus:estatus },respEditarCorreoF);
    
});


$( "#BtnAgregarUsuario" ).click(function() { 
    var idusuario=$("#idEmpleadoCorreo").val();
    var usuario=$("#UsuarioEmpleado").val();
    var pass=$("#passEmpleado").val();
   
    console.log(idusuario+" "+usuario+" "+pass);

    if(usuario=="" || pass=="")
    {
        M.toast({html: 'Usuario y/o contraseña vacios, favor de ingresar correo y contraseña', classes: 'rounded red'}); 
        console.log(usuario+" "+pass);
    }
    else
    {
        onRequest({ opcion : 103 ,usuario:usuario}, respVerifNombreUsuario);
    }


    
    
});
//-----------------------------------------------------------------------------
$("#passEmpleado").keypress(function(e) {
    //inicializamos variables
  if(e.which == 13) {
    var idusuario=$("#idEmpleadoCorreo").val();
    var correo=$("#correoEmpleado").val();
    var pass=$("#passEmpleado").val();
    var dominio=$("#dominioDD option:selected").text();
    console.log(idusuario+" "+correo+" "+pass+" "+dominio);
    onRequest({ opcion : 64, usuario_id:idusuario, dominio:dominio,correo:correo, pass:pass },respAgregaCorreo);  
  }
});


//----------------------------------------------Enter al iniciar------------------------------------
    $("#password").keypress(function(e) {
        if(e.which == 13) {
            $( "#btn_login" ).click();
        }
    });


    $("#CrearTicketbtn").click(function() {
        var usuario = Cookies.get('b_capturista_id');
        var area=$("#areaApoyo").val();
        var titulo=$("#tituloDD option:selected").text();
        var desc=$("#descripcionTicket").val();
        var correo=$("#email").val();
        var telefono=$("#tel").val();
        console.log("ID empleado="+usuario+" Area de apoyo:"+area+" titulo:"+titulo);
        console.log("desc:"+desc+" email:"+correo+" telefono:"+telefono);
        onRequest({ opcion : 73, usuario_id:usuario, area_id:area,titulo:titulo, descripcion:desc, correo:correo, telefono:telefono },respAgregaTicket);

      
    
    });

    
    $("#btnEditPub").click(function() {
      
      var id = $("#Idpub").val();
      var titulo = $("#tituloPub").val();
      var descripcion= $("#desc").val();
      console.log("------"+id+"--"+titulo+"--"+descripcion);

      onRequest({ opcion : 81, pub_id:id, tit:titulo,des:descripcion },respActualizarPub)
    
    });

    $("#btnDarBaja").click(function() {
      
        var id = $("#IdpubBaja").val();
        
        
        console.log("------"+id);
  
        onRequest({ opcion : 86, pub_id:id },respDardeBajaPub)
      
      });

      //---------------------------BUSQUEDA DE CORREOS
      //CLICK AL BOTON
      $("#btnBusquedaCorreo").click(function() {
      
        var nombreB='';
        nombreB =  $("#nombreAbuscarCor").val();
        var sucursalB='';
        sucursalB =  $("#sucursalesAbuscar").val();
        var puestoB='';
        puestoB =  $("#puestosCor").val();
       
        if(nombreB=="" )
        {
            $("#IdEmpleadoCor").val("0");
        }
        var id_empleado= $("#IdEmpleadoCor").val();
        console.log("id empleado: "+id_empleado+" sucursal: "+sucursalB+" puesto: "+puestoB);
       
       
        onRequest({ opcion : 26,cap_id:id_empleado,sucursal:sucursalB, puesto:puestoB},respCorreos);
        
      });

      $("#btnAceptarEdit").click(function() {
      
        var a = getParameterByName("usuario_id");
        console.log("usuario:"+a);
        var user =  $("#usuario_edit").val();
        var pass =  $("#pass_edit").val();
        var pass2 =  $("#pass_edit2").val();

       if(pass===pass2)
       {
           console.log("Go on!!");
           onRequest({ opcion : 121 , usuario:user, contra:pass, empleado_id:a}, respEditUsuario);
       }
       else
       {
            M.toast({html: 'Contraseñas no coinciden!', classes: 'rounded red'});
       }        
      });



     
      
      
});




//----------------------------------------Termina document.READY()----------------------------------
//------------------------------------------------------------------------------------------------------------------------////
//-----------------------------------------------------NOTIFICACIONES

//-----------------------------Funciones para cargar al iniciar una pagina---------------
//Funcion que carga las empresas
function cargarEmpresas(){
    onRequest({ opcion : 2 ,empresa:""}, respEmpresas);
   
}


//Funcion para cargar roles
function cargarRoles(){
    onRequest({ opcion : 3 ,rol:""}, respRoles);
    
}

//Funcion para cargar tipo de documentos
function cargarDoc(){
    onRequest({ opcion : 4 ,doc:""}, respDoc);
   
}

//Funcion que carga las publicaciones
function cargarPublicaciones(){
    console.log("Cargar publicaciones");
    onRequest({ opcion : 20}, respCargarPublicaciones);
   
   
    
}

function cargarMantPub(){
    console.log("Cargar publicaciones");
    onRequest({ opcion : 78}, respCargarMttoPub);
    
   
   
    
}
function cargarCorreos(){
    onRequest({ opcion : 26 ,cap_id:"0", sucursal:"0", puesto:"0"}, respCorreos);
    onRequest({ opcion : 70 }, respcargasucursales);
    onRequest({ opcion : 45 },respCargarPuestosParaCorreos);
    
}

function cargarTickets(){
    onRequest({ opcion : 75 }, respCargarTickets);
    
}

function cargarMenuPorRol(){
    
    empleadoid = Cookies.get('b_capturista_id');
    console.log("id empleado= "+empleadoid);
    onRequest({ opcion : 31 ,id_usuario:empleadoid },respCargarRolesPorUsuario);
    
    onRequest({ opcion : 62 ,usuario_id:empleadoid}, respNotificaciones);

    onRequest({ opcion : 27}, respCargarTipoDedoc);

}

//cargamos el menu de publicaciones
function cargarPublicacionesB(){
    onRequest({ opcion : 27}, respCargaPublicacionesVistas);
     
    
}

function cargarPublicacionesNuevas(){
    onRequest({ opcion : 27}, respCargaPublicacionesB);
     
}
function cargarUsuariosT(){
    onRequest({ opcion : 35, usuario_id:""}, respCargaUsuarios);
    
}


function cargarConfUsuarios(){
    var a = getParameterByName("usuario_id");
    console.log("usuario:"+a);
    onRequest({ opcion : 36 ,usuario_id:a}, respCargarConfRoles);
    onRequest({ opcion : 37 ,usuario_id:a}, respCargarConfEmpresas);
    onRequest({ opcion : 29,usuario:a},respUsuariosDDConf);
    empleadoid = Cookies.get('b_capturista_id');
    console.log("id empleado= "+empleadoid);
    onRequest({ opcion : 31 ,id_usuario:empleadoid },respCargarRolesPorUsuario);
    
}

function cargarConfEditUsuarios(){
    var a = getParameterByName("usuario_id");
    console.log("usuario:"+a);
    onRequest({ opcion : 35, usuario_id:a}, respCargarEditUsuario);
    
    
}

function cargarConfEmpresa(){
    var a = getParameterByName("empresa_id");
    console.log("empresa:"+a);
    onRequest({ opcion : 8 ,empresa_id:a },respCargarEmpresaXid);
    onRequest({ opcion : 45 },respCargarPuestos);
    onRequest({ opcion : 43 ,idemp:a}, respCargarRolesXemp);
    
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function eliminarRol(rolid) {    
   var usuario = $("#UsuariosDD2").val();
   var rol = rolid;
   console.log("----------Eliminar ROl---------");
   console.log("usuario= "+ usuario);
   console.log("rol= "+ rol);
   onRequest({ opcion : 38 ,usuario_id:usuario,rol_id:rol },respEliminarRolUsu);

}

function eliminarEmp(empid) {    
    var usuario = $("#UsuariosDD2").val();
    var empresa = empid;
    console.log("----------Eliminar empresa---------");
    console.log("usuario= "+ usuario);
    console.log("empresa= "+ empresa);
    onRequest({ opcion : 39 ,usuario_id:usuario,empresa_id:empresa },respEliminarEmpUsu);
 }

 function eliminarRoldeEmp(rolid) {    
    var empresa = $("#Empresarol").val();
    var rol = rolid;
    console.log("----------Eliminar puesto de empresa---------");
    console.log("empresa= "+ empresa);
    console.log("pusto= "+ rol);
    onRequest({ opcion : 44 ,idemp:empresa,idrol:rol },respEliminarRolEmp);
 
 }
 //Cargar los roles en la pagina addfile
 function cargarRolesAf(empid) {    
     var empresa = empid;
     console.log("------------------------ "+empresa);
     console.log("-BOTON HABILITADO-----------------------");
    $("#btnAgEmp_PuestoTmp").removeAttr("disabled");
     M.toast({html: 'No olvides agregar los puestos!', classes: 'rounded blue'}); 
     onRequest({ opcion : 43 ,idemp:empresa}, respCargarRolesXempChb);
     onRequest({ opcion : 102 ,empresa:empresa}, respCargaSucursalesXEmpresa);
 }



 function cargarAddfile()
 {
    var usuario="";
    usuario=Cookies.get('b_capturista_id');
    onRequest({ opcion : 49 ,id_usuario:usuario}, respVerificarTablaTmp);
    
 }

 function mostrarPass()
 {
   console.log("Mostrar contraseña");
   
   if($("#editPass").attr("type")=="password" )
   {
        console.log("Es tipo contraseña"); 
        $("#editPass").attr("type","text");
   }
   else
   {
        console.log("Es tipo text"); 
        $("#editPass").attr("type","password");
   }
      
 }
 function mostrarPassAgregarcorreo()
 {
   console.log("Mostrar contraseña");
   
   if($("#passEmpleado").attr("type")=="password" )
   {
        console.log("Es tipo contraseña"); 
        $("#passEmpleado").attr("type","text");
   }
   else
   {
        console.log("Es tipo text"); 
        $("#passEmpleado").attr("type","password");
   }
      
 }

 function verInfoPub(pub_id)
{
    //Carga la empresa por su id para despues editarla
    console.log("Id de la publicacion:"+pub_id);
    onRequest({ opcion : 79 ,pub_id:pub_id}, respCargarVistosEmpleados);

}

function editarPublicacion(pub_id)
{
    //Carga la publicacion por su id para despues editarla
    console.log("Id de la publicacion:"+pub_id);
    onRequest({ opcion : 80 ,pub_id:pub_id}, respCargarPubXid);
}

function deshabPub(pub_id)
{
    console.log("Id de la publicacion:"+pub_id);
    onRequest({ opcion : 80 ,pub_id:pub_id}, respBajaPub);
}

function buscaEmpleadosCor()
{
    var bus= $("#nombreAbuscarCor").val();
    if (bus.length>2)
    {
        document.getElementById('listaEmpleadosBC').style.display = 'block';
        onRequest({ opcion : 84 ,nombre:bus}, respBuscarEmpleadosCorreo);
    }
    else
    {
        document.getElementById('listaEmpleadosBC').style.display = 'none';
    }
    console.log("Buscando texto:"+bus);
    
}

function CerrarYborrarDiv()
{
    $("#nombreAbuscarCor").val("");
    document.getElementById('listaEmpleadosBC').style.display = 'none';
}

function buscaEmpleadosAdd()
{
    var bus= $("#nombreEmpleadoCorreo").val();
    if (bus.length>2)
    {
        document.getElementById('listaEmpleadosADD').style.display = 'block';
        onRequest({ opcion : 84 ,nombre:bus}, respAddEmpleadosCorreo);
    }
    else
    {
        document.getElementById('listaEmpleadosADD').style.display = 'none';
    }
    console.log("Buscando texto:"+bus);
    
}
function buscaEmpleadosUsuarios()
{
    var bus= $("#nombreEmpleadoCorreo").val();
    if (bus.length>2)
    {
        document.getElementById('listaEmpleadosADD').style.display = 'block';
        onRequest({ opcion : 84 ,nombre:bus}, respAddEmpleadosUsuario);
    }
    else
    {
        document.getElementById('listaEmpleadosADD').style.display = 'none';
    }
    console.log("Buscando texto:"+bus);
    
}

function agregarAdiv(id_empleado)
{  
    
    document.getElementById('listaEmpleadosBC').style.display = 'none';
    $("#IdEmpleadoCor").val(id_empleado);
    var id=$("#IdEmpleadoCor").val();
    onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdiv);

}



function agregarAdivADD(id_empleado)
{  
    
    document.getElementById('listaEmpleadosADD').style.display = 'none';
    $("#idEmpleadoCorreo").val(id_empleado);
    var id=$("#idEmpleadoCorreo").val();
    onRequest({ opcion : 63,usuario_id:id},respCargarEmpleadoCorreo);
    onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdivADD);

}

function agregarAdivUsuario(id_empleado)
{  
    
    document.getElementById('listaEmpleadosADD').style.display = 'none';
    $("#idEmpleadoCorreo").val(id_empleado);
    var id=$("#idEmpleadoCorreo").val();
    onRequest({ opcion : 96,usuario_id:id},respCargarEmpleadoUsuario);
    onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdivADD);

}

function mostrarPassEditCorreo()
{
    console.log("Mostrar contraseña");
    
    if($("#pass_edit").attr("type")=="password" )
    {
        console.log("Es tipo contraseña"); 
        $("#pass_edit").attr("type","text");
        $("#pass_edit2").attr("type","text");
    }
    else
    {
        console.log("Es tipo text"); 
        $("#pass_edit").attr("type","password");
        $("#pass_edit2").attr("type","password");
    }
     
}
//----------------------------------------Funcion de respuesta de la consulta que aplicamos con ajax-----------------------------
var respUser = function(data) { 

    if (!data && data == null) 
        return;   
    
        console.log(data)
            // validamos que exista una respuesta
      if (data[0].empleado_id>0) { 
 
            Cookies.set("b_capturista_id", data[0].empleado_id );
            Cookies.set("b_usuario", data[0].usuario );
            Cookies.set("b_capturista",data[0].capturista);
            Cookies.set("b_rol_id",data[0].rol_id); 
            Cookies.set("b_empresa_id",data[0].empresa_id); 
            Cookies.set("b_puesto_id",data[0].puesto_id);   
            Cookies.set("b_sucursal",data[0].sucursal); 
            Cookies.set("b_puesto",data[0].puesto);  
            Cookies.set("b_telefono",data[0].telefono);   
            Cookies.set("b_id_sucursal",data[0].id_sucursal);         
            Cookies.set("b_empresa",data[0].empresa);
            location.href="/intranet/";

         return;
     }
     else{ 
        M.toast({html: 'El usuario o la contraseña no son correctos.', classes: 'rounded red'}); 
     }
}
//---------------------------------------------------CARGAR CATALOGOS--------------------------------------------------
// Funcion de respuesta de la consulta que aplicamos con ajax para el catalogo de empresas
var respEmpresas = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
     d+= '<tr>'+
     '<td>'+data[i].empresa_id+'</td>'+
     '<td>'+data[i].nombre+'</td>'+
     '<td>'+data[i].estatus+'</td>'+ 
     '<td class="left">'+
     '<a onclick="editarEmp('+data[i].empresa_id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarEmp"><i class="material-icons">edit</i></a>' + 
     '<a onclick="deshabEmp('+data[i].empresa_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabEmp"><i class="material-icons">do_not_disturb_alt</i></a>' + 
     '<a onclick="BorrarEmp('+data[i].empresa_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarEmp"><i class="material-icons">delete</i></a>' +
     '<a onclick="editRolesdeEmp('+data[i].empresa_id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger"><i class="material-icons">build</i></a>' +
     '</td>'  +'</tr> ';
     }
     
     $("#tablaemp").html(d);

     cargarMenuPorRol();
}
// ---------------------------------------------------CATALOGO DE ROLES---------------------------------------------------
var respRoles = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
     d+= '<tr>'+
     '<td>'+data[i].rol_id+'</td>'+
     '<td>'+data[i].descripcion+'</td>'+
     '<td>'+data[i].estatus+'</td>'+ 
     '<td class="left">'+
     '<a onclick="editarRol('+data[i].rol_id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarRol"><i class="material-icons">edit</i></a>' + 
     '<a onclick="deshabRol('+data[i].rol_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabRol"><i class="material-icons">do_not_disturb_alt</i></a>' + 
     '<a onclick="BorrarRol('+data[i].rol_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarRol"><i class="material-icons">delete</i></a>' +
     '</td>'  +'</tr> ';
     }
     
     $("#tablarol").html(d);

     cargarMenuPorRol();
}
// ---------------------------------------------------CATALOGO DE tipo DE DOCUMENTOS---------------------------------------------------
var respDoc = function(data) { 
    
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
     '<td>'+data[i].doc_id+'</td>'+
     '<td>'+data[i].descripcion+'</td>'+
     '<td>'+data[i].estatus+'</td>'+ 
     '<td class="'+x+' left">'+
     '<a onclick="editarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarDoc"><i class="material-icons">edit</i></a>' + 
     '<a onclick="deshabDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabDoc"><i class="material-icons">do_not_disturb_alt</i></a>' + 
     '<a onclick="BorrarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarDoc"><i class="material-icons">delete</i></a>' +
     '</td>'  +'</tr> ';
     }
     
     $("#tabladoc").html(d);

     cargarMenuPorRol();
}

// ---------------------------------------------------CATALOGO DE CORREOS---------------------------------------------------
var respCorreos = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';
    var x = '';

    var usuario=Cookies.get('b_capturista_id');
    if(usuario==1251 || usuario==1597 || usuario==118 || usuario==3)
    {
        document.getElementById('password').style.display = 'block';
        document.getElementById('accionesC').style.display = 'block';
        document.getElementById('AgregaCorreosBtnFlotante').style.display = 'block';
       
        
        for (var i = 0; i < data.length; i++) {
            var nombre=String(data[i].nombrecompleto);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin correo asignado</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaCorreos").html(d);
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
                '<td>'+data[i].id_empleado+'</td>'+ 
                '<td>'+data[i].nombrecompleto+'</td>'+ 
                '<td>'+data[i].puesto+'</td>'+ 
                '<td>'+data[i].sucursal+'</td>'+   
                '<td>'+data[i].correo+'</td>'+
                '<td>'+data[i].pass+'</td>'+ 
                '<td>'+data[i].estatus+'</td>'+ 
                '<td class="'+x+' left">'+
                '<a onclick="editarCorreo('+data[i].id_empleado+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarCorreo"><i class="material-icons">edit</i></a>' + 
                //'<a onclick="deshabDoc('+data[i].id_empleado+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabDoc"><i class="material-icons">do_not_disturb_alt</i></a>' + 
                '<a onclick="BorrarCorreo('+data[i].id_correo+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarCorreo"><i class="material-icons">delete</i></a>' +
                '</td>'  +'</tr> ';
            }
        }
            
            $("#tablaCorreos").html(d);
    }
    else
    {
        for (var i = 0; i < data.length; i++) {
            var nombre=String(data[i].nombrecompleto);
            console.log("-------"+nombre);
            var nombre=String(data[i].nombrecompleto);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin correo asignado</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaCorreos").html(d);
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
                '<td>'+data[i].id_empleado+'</td>'+
                '<td>'+data[i].nombrecompleto+'</td>'+
                '<td>'+data[i].puesto+'</td>'+   
                '<td>'+data[i].sucursal+'</td>'+
                '<td>'+data[i].correo+'</td>'+
                '<td>'+data[i].estatus+'</td>'+  
                '<td class="'+x+' left">'+
                '</td>'  +'</tr> ';
            }
        }
        
        $("#tablaCorreos").html(d);
       
    }
    cargarMenuPorRol();
}

//----------------------------RESPUESTAS PARA INSERTAR DATOS------------------------------
//----------------------------insertar empresa---------------------------------------
var respAgregaEmpresa = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa NO agregada', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Empresa agregada', classes: 'rounded blue'}); 
    
    $("#modalAgregarEmp").modal("close");

    onRequest({ opcion : 2 ,empresa:""}, respEmpresas);
}
//--------------------------insertar roles-----------------------------------------
var respAgregaRol = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Rol NO agregado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Rol agregado', classes: 'rounded blue'}); 
    
    $("#modalAgregarRoles").modal("close");

    onRequest({ opcion : 3 ,rol:""}, respRoles);
}
//--------------------------insertar tipo de documentos----------------------------------
var respAgregaDoc = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Tipo de documento NO agregado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Tipo de documento agregado', classes: 'rounded blue'}); 
    
    $("#modalAgregarDoc").modal("close");

    onRequest({ opcion : 4 ,doc:""}, respDoc);
}
//-----------------------------------------Respuestas para editar-------------------------
//--------------------------------Editar empresa---------------------------------------
var respEditEmp = function(data) { 

    if (!data && data == null) 
        return;   
    
        console.log(data)
            // validamos que exista una respuesta
      if (data[0].empresa_id>0) { 
          console.log(data[0].nombre);
        $("#idEmpEdit").val(data[0].empresa_id);
        $("#nomEmpEdit").val(data[0].nombre);

         return;
     }
     
}
var respActualizarEmp = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa No Actualizada', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Empresa Actualizada!', classes: 'rounded blue'}); 

    $("#modalEditarEmp").modal("close");

    onRequest({ opcion : 2 ,empresa:""}, respEmpresas);
}
//------------------------------------Editar ROL-------------------------------
var respEditRol = function(data) { 

    if (!data && data == null) 
        return;   
    
        console.log(data)
            // validamos que exista una respuesta
      if (data[0].rol_id>0) { 
            $("#idRolEdit").val(data[0].rol_id);
            $("#editNomRol").val(data[0].descripcion);

         return;
     }
     
}
var respActualizarRol = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Rol No Actualizado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Rol Actualizado!', classes: 'rounded blue'}); 

    $("#modalEditarRol").modal("close");

    onRequest({ opcion : 3 ,rol:""}, respRoles);
}
//------------------------------------Editar tipo de documento-------------------------------
var respEditDoc = function(data) { 

    if (!data && data == null) 
        return;   
    
        console.log(data)
            // validamos que exista una respuesta
      if (data[0].doc_id>0) { 
            $("#idDocEdit").val(data[0].doc_id);
            $("#editNomDoc").val(data[0].descripcion);

         return;
     }
     
}
var respActualizarDoc = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Tipo de documento No Actualizado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Tipo de documento Actualizado!', classes: 'rounded blue'}); 

    $("#modalEditarDoc").modal("close");

    onRequest({ opcion : 4 ,doc:""}, respDoc);
}
//_---------------------------------Respuestas para deshabilitar-----------------------------
//---------------------------deshabilitar empresa-------------------------------
var respDesEmp = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].empresa_id>0) { 
      console.log(data[0].nombre);
    $("#idEmpDes").val(data[0].empresa_id);
    $("#nomEmpDes").val(data[0].nombre);

     return;
 }
   
}

var respDesEmpFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa no deshabilitada', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Empresa deshabilitada', classes: 'rounded blue'}); 

    $("#modalDeshabEmp").modal("close");

    onRequest({ opcion : 2 ,empresa:""}, respEmpresas);
}
//-----------------------------deshabilitar roles--------------------------
var respDesRol = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].rol_id>0) { 
      console.log(data[0].descripcion);
    $("#idRolDes").val(data[0].rol_id);
    $("#nomRolDes").val(data[0].descripcion);

     return;
 }
   
}

var respDesRolFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Rol no deshabilitado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Rol deshabilitado', classes: 'rounded blue'}); 

    $("#modalDeshabRol").modal("close");

    onRequest({ opcion : 3 ,rol:""}, respRoles);
}
//-----------------------------deshabilitar tipo de documentos------------------------------
var respDesDoc = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].doc_id>0) { 
      console.log(data[0].descripcion);
    $("#idDocDes").val(data[0].doc_id);
    $("#nomDocDes").val(data[0].descripcion);

     return;
 }
   
}

var respDesDocFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Tipo de documento no deshabilitado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Tipo de documento deshabilitado', classes: 'rounded blue'}); 

    $("#modalDeshabDoc").modal("close");

    onRequest({ opcion : 4 ,doc:""}, respDoc);
}


//_---------------------------------------------------------Respuestas para ELIMINAR-------------------------------------------------------------------------
//---------------------------Eliminar empresa-------------------------------
var respEliEmp = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].empresa_id>0) { 
      console.log(data[0].nombre);
    $("#idEmpEli").val(data[0].empresa_id);
    $("#nomEmpEli").val(data[0].nombre);

     return;
 }
   
}

var respEliEmpFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa no eliminada', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Empresa eliminada', classes: 'rounded red accent-4'}); 

    $("#modalEliminarEmp").modal("close");

    onRequest({ opcion : 2 ,empresa:""}, respEmpresas);
}
//-----------------------------Eliminar roles--------------------------
var respEliRol = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].rol_id>0) { 
      console.log(data[0].descripcion);
    $("#idRolEli").val(data[0].rol_id);
    $("#nomRolEli").val(data[0].descripcion);

     return;
 }
   
}


var respEliRolFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Rol no eliminado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Rol eliminado', classes: 'rounded red accent-4'}); 

    $("#modalEliminarRol").modal("close");

    onRequest({ opcion : 3 ,rol:""}, respRoles);
}
//------------------------------------guardar celular -------------------------
var resGuardarCel = function(data) { 
    if (!data && data == null) 
     M.toast({html: 'Telefono registrado correctamente', classes: 'rounded green'}); 
    var cel = $('#telefonoEmpleado').val(data[0].telefono);
}
//-----------------------------Eliminar tipo de documentos------------------------------
var respEliDoc = function(data) { 
    if (!data && data == null) 
    return;   

    console.log(data)
        // validamos que exista una respuesta
  if (data[0].doc_id>0) { 
      console.log(data[0].descripcion);
    $("#idDocEli").val(data[0].doc_id);
    $("#nomDocEli").val(data[0].descripcion);

     return;
 }
   
}

var respEliDocFinal = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Tipo de documento no eliminado', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Tipo de documento eliminado', classes: 'rounded orange darken-3'}); 

    $("#modalEliminarDoc").modal("close");

    onRequest({ opcion : 4 ,doc:""}, respDoc);
}
//------------------------------------------------PUBLICACIONES------------------------------------------
//----------------------------------------Cargar publicaciones en index---------------------------
var respCargarPublicaciones = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
     d+= '<li class="collection-item avatar"> <span class="title"> <strong>'+data[i].publicador+'</strong></span>'+
     '<p>'+data[i].descripcion+'</p>'+
     '</li>';
     }
     
     $("#cargarPubli").html(d);

     cargarConfUsuarios();
}
//---------------------------------------------Agregar publicaciones------------------------------
var respAgregaPublicacion = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Publicacion no agregada, consulte con el area de sistemas', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Publicacion Agregada!', classes: 'rounded #43a047 green darken-1'}); 

    $("#modalAgregarPub").modal("close");

    onRequest({ opcion : 20}, respCargarPublicaciones);


}
// ---------------------------------------CARGAMOS TODOS LOS SELECTS ---------------------------------------
 

var respTpublic = function(data) { 
    if (!data && data == null)
        return; 

     
    var documento='<option  disabled selected>Tipo de publicacion:</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].doc_id+'>'+data[i].descripcion+'</option>';
    }
    
    $('#tipoPub').html(documento);
    $('#tipoPub').formSelect();  

    $('#tipoPubAddFile').html(documento);
    $('#tipoPubAddFile').formSelect();


    

}
///---------------------------------------RESPUESTAS PARA LOS DROPDOWNLIST
var respEmpresa = function(data) { 
    if (!data && data == null)
        return;  
     
    var documento='<option  disabled selected>Empresa:</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].empresa_id+'>'+data[i].nombre+'</option>';
    }
    
    $('#tipoEmpresa').html(documento);
    $('#tipoEmpresa').formSelect(); 

    $('#tipoEmpresaAddFile').html(documento);
    $('#tipoEmpresaAddFile').formSelect(); 
}
var respRol = function(data) { 
    if (!data && data == null)
        return;  
 
    var documento='<option   disabled selected>Seleccione el Rol</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].rol_id+'>'+data[i].descripcion+'</option>';
    }
    
    $('#tipoRol').html(documento);
    $('#tipoRol').formSelect(); 

    $('#tipoRolAddFile').html(documento);
    $('#tipoRolAddFile').formSelect(); 
}

var respRolAccesos = function(data) { 
    if (!data && data == null)
        return;  
        

        console.log(data)
    var documento='<option value="0" disabled selected>Seleccione el Tipo de rol</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].rol_id+'>'+data[i].descripcion+'</option>';
    }
    
    $('#tipoRolAc').html(documento);
    $('#tipoRolAc').formSelect(); 

    $('#tipoRolAcAddFile').html(documento);
    $('#tipoRolAcAddFile').formSelect(); 
}


var respUsuariosDD = function(data) { 
    if (!data && data == null)
        return;  
 
    var documento='<option value="0" disabled selected>Seleccione el usuario</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nombre+'</option>';
    }
    console.log("checarc");
    
    $('#UsuariosDD').html(documento);
    $('#UsuariosDD').formSelect(); 

}

var respUsuariosDDConf = function(data) { 
    if (!data && data == null)
        return;  
 
    var documento='';

    if(data[0].entregado=="SI")
    {
        $('#cbEntregadoUsuario').prop('checked', true);
    }
    else
    {
        $('#cbEntregadoUsuario').prop('checked', false); 
    }

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+' selected>'+data[i].nombre+'</option>';
        
    }
    console.log("checarc2");
    
    $('#UsuariosDD2').html(documento);
    $('#UsuariosDD2').formSelect(); 

}
//---------------------------------------respuesta para los check de los accesos dependiendo del rol---------
var respAccesosPorRol  = function(data) { 
    if (!data && data == null)
        return;  
 
    for(var i=0; i<data.length; i++){
        console.log("-------"+data[i].id_menu); 
        switch(data[i].id_menu)
        {
            case '1': 
                $('#agregarPub').prop('checked', true); 
                break;
            case '2':
                $('#mandarTicket').prop('checked', true);
                break;
            case '3':
                $('#catEmp').prop('checked', true);
                break;
            case '4':
                $('#catRoles').prop('checked', true);
                break;
            case '5':
                $('#tipoDoc').prop('checked', true);
                break;
            case '6':
                $('#cargarArchivos').prop('checked', true);
                break;
            case '7':
                $('#usuarios').prop('checked', true);
                break;
            case '8':
                $('#accesosCheck').prop('checked', true); 
                break;
            case '9':
                $('#correosCheck').prop('checked', true); 
                break;
            case '10':
                $('#rolesUsuCh').prop('checked', true); 
                break;
            case '11':
                $('#bancaprepaCh').prop('checked', true); 
                break;
            case '12':
                $('#tipoEquipo').prop('checked', true); 
                break;
            case '13':
                $('#misTickets').prop('checked', true); 
            break;
            case '14':
                $('#mantTickets').prop('checked', true); 
            break;
            case '15':
                $('#capInven').prop('checked', true); 
            break;
            case '16':
                $('#busquedaEquipoCh').prop('checked', true); 
            break;
            case '17':
                $('#mantPubCh').prop('checked', true); 
            break;
            case '18':
                $('#capAreas').prop('checked', true); 
            break;
            case '19':
                $('#crearSolpp').prop('checked', true); 
            break;
            case '20':
                $('#solicitudesPp').prop('checked', true); 
            break;
             case '21':
                $('#registroStock').prop('checked', true); 
            break;
            case '22':
                $('#solicitudArticulo').prop('checked', true); 
            break;
            case '23':
                $('#pagosPp').prop('checked', true); 
            break;  
            case '24':
                $('#reportesPp').prop('checked', true); 
            break;
            case '25':
                $('#cartaFondoA').prop('checked', true); 
            break;
            case '26':
                $('#solicitudesFondoAhorros').prop('checked', true); 
            break;
            case '27':
                $('#m_registroAct').prop('checked', true); 
            break;
            case '28':
                $('#m_agendaAct').prop('checked', true); 
            break;

        }    
    }
} 


//---------Respuesta para actualizar los accesos al menu de agregar publicacion
var respUpdateAccesos = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Acceso no actualizado, consulte con el area de sistemas', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Acceso Actualizado!', classes: 'rounded #43a047 green darken-1'}); 

    //Actualiza de nuevo los accesos
    
}

//---------Respuesta de la imagen insertada
var respPublicacion = function(data) { 
    if (!data && data == null)
             return;  

    
    var usuario = Cookies.get('b_capturista_id');
    onRequest({ opcion : 51,id_usuario:usuario}, respInsertarTablaTemp); 

   
    
    
    
    console.log(data);     
}


//---------------Respuesta para cargar menus---------

var respCargarMenu  = function(data) { 
    if (!data && data == null)
        return;  

       // console.log(data)
        var usuario = Cookies.get('b_capturista_id');
        if(usuario<1){
          console.log('vale');
          window.location = "login.html";
        }

        console.log(data);
    for(var i=0; i<data.length; i++){
        
        switch(data[i].id_menu)
        {
            case '1': 
                //document.getElementById('M_cargaA').style.display = 'block';
                break;
            case '2':
                document.getElementById('m_mandarT').style.display = 'block';
                document.getElementById('m_tickets').style.display = 'block'; 
                break;
            case '3':
                document.getElementById('catemp').style.display = 'block';
                document.getElementById('m_catalogos').style.display = 'block'; 
                break;
            case '4':
                document.getElementById('catroles').style.display = 'block';
                document.getElementById('m_catalogos').style.display = 'block';  
                break;
            case '5':
                document.getElementById('catdoc').style.display = 'block';
                document.getElementById('m_catalogos').style.display = 'block'; 
                break;
            case '6':
                document.getElementById('M_cargaA').style.display = 'block';
                break;
            case '7':
                document.getElementById('m_usuarios').style.display = 'block';
                document.getElementById('m_mantenimiento').style.display = 'block';
                break;
            case '8':
                document.getElementById('m_accesos').style.display = 'block';
                document.getElementById('m_mantenimiento').style.display = 'block';
                break;
            case '9':
                document.getElementById('correos').style.display = 'block';
                break;
            case '11':
              document.getElementById('m_bancaprepa').style.display = 'block';
              break;
            case '12':
              document.getElementById('catEquipo').style.display = 'block';
              document.getElementById('m_catalogos').style.display = 'block';  
            break;
            case '13':
              document.getElementById('m_misTickets').style.display = 'block';
              document.getElementById('m_tickets').style.display = 'block'; 
              break;
            case '14':
             
              document.getElementById('m_tickets').style.display = 'block'; 
            break;
            case '15':
              document.getElementById('capInv').style.display = 'block';
              document.getElementById('m_Inventario').style.display = 'block';
            break;
            case '16':
              document.getElementById('busquedaEquipo').style.display = 'block';
              document.getElementById('m_Inventario').style.display = 'block';
            break;
            case '17':
              document.getElementById('m_mantenimientoPub').style.display = 'block';
            break;
            case '18':
             document.getElementById('m_catalogos').style.display = 'block'; 
             document.getElementById('catAreas').style.display = 'block';
            break;
            case '19':
             document.getElementById('m_Prestamos').style.display = 'block'; 
             document.getElementById('m_crearSolicitud').style.display = 'block';
            break;
            case '20':
             document.getElementById('m_Prestamos').style.display = 'block'; 
             document.getElementById('m_solicitudes').style.display = 'block';
            break;
            case '21':
             document.getElementById('desplegableStockm').style.display = 'block'; 
             document.getElementById('m_registroStock').style.display = 'block';
            break;
            case '22':
             document.getElementById('desplegableStockm').style.display = 'block'; 
             document.getElementById('m_gestionSolicitud').style.display = 'block';
            break;
            case '23':
             document.getElementById('m_Prestamos').style.display = 'block'; 
             document.getElementById('m_pagos').style.display = 'block';
            break;
            case '24':
             document.getElementById('m_Prestamos').style.display = 'block'; 
             document.getElementById('m_reportesp').style.display = 'block';
            break;
            case '25':
             document.getElementById('m_fondoAhorro').style.display = 'block'; 
             document.getElementById('m_fondoAhorro_menu').style.display = 'block';  
            break;
            case '26':
             document.getElementById('m_SolicitudesfondoAhorro').style.display = 'block';
             document.getElementById('m_fondoAhorro_menu').style.display = 'block';  
            break;
            case '27':
             document.getElementById('m_actividades').style.display = 'block';
             document.getElementById('m_registroAct').style.display = 'block';  
            break;
            case '28':
             document.getElementById('m_actividades').style.display = 'block';
             document.getElementById('m_agendaAct').style.display = 'block';  
            break;
        }    
    }
  //  $('#accesosRol').html(documento);
}

///////////////////////////////////////////////////////////////////////////////////////
//funciones del catalogo de empresas
function editarEmp(emp_id)
{
    //Carga la empresa por su id para despues editarla
    onRequest({ opcion : 8 ,empresa_id:emp_id}, respEditEmp);
}

function deshabEmp(emp_id)
{
    //Carga la empresa por su id para despues deshabilitarla
    onRequest({ opcion : 8 ,empresa_id:emp_id}, respDesEmp);
}

function BorrarEmp(emp_id)
{
    //Carga la empresa por su id para despues borrarla
    onRequest({ opcion : 8 ,empresa_id:emp_id}, respEliEmp);
}

//Funciones del catalogo de roles
function editarRol(rol_id)
{
    //Carga el rol por su id para despues editarlo
    onRequest({ opcion : 10 ,rol_id:rol_id}, respEditRol);
}

function deshabRol(rol_id)
{
    //Carga el rol por su id para despues deshabilitarlo
    onRequest({ opcion : 10 ,rol_id:rol_id}, respDesRol);
}

function BorrarRol(rol_id)
{
    //Carga el rol por su id para despues borrarlo  
    onRequest({ opcion : 10 ,rol_id:rol_id}, respEliRol);
}
//Funciones del catalogo de documentos
function editarDoc(doc_id)
{
    //Carga el tipo de documento por su id para despues editarlo
    onRequest({ opcion : 12 ,doc_id:doc_id}, respEditDoc);
}

function deshabDoc(doc_id)
{
    //Carga el tipo de documento por su id para despues deshabilitarlo
    onRequest({ opcion : 12 ,doc_id:doc_id}, respDesDoc);
}

function BorrarDoc(doc_id)
{
     //Carga el tipo de documento por su id para despues borrarlo
     onRequest({ opcion : 12 ,doc_id:doc_id}, respEliDoc);
}

function asignarPermisos(usuarioid)
{
    var a = document.createElement('a');
    a.href="/mantenimiento/rolusu.php?usuario_id="+usuarioid;
    document.body.appendChild(a);
    a.click();
}
function editarUsu(usuarioid)
{
    var a = document.createElement('a');
    a.href="/mantenimiento/editarusu.php?usuario_id="+usuarioid;
    document.body.appendChild(a);
    a.click();
}

function BorrarCorreo(correo_id)
{
    console.log(correo_id);
    onRequest({ opcion : 65 ,id_correo:correo_id}, respBorrarCorreo);  

}


function cargarAccesos(rol_id){ 

    $('#agregarPub').prop('checked', false);  
    $('#mandarTickket').prop('checked', false); 
    $('#catEmp').prop('checked', false); 
    $('#catRoles').prop('checked', false); 
    $('#tipoDoc').prop('checked', false); 
    $('#cargarArchivos').prop('checked', false); 
    $('#usuarios').prop('checked', false); 
    $('#accesosCheck').prop('checked', false);
    $('#correosCheck').prop('checked', false);
    $('#rolesUsuCh').prop('checked', false);
    $('#bancaprepaCh').prop('checked', false);
    $('#tipoEquipo').prop('checked', false);
    $('#misTickets').prop('checked', false);
    $('#mantTickets').prop('checked', false);
    $('#capInven').prop('checked', false);
    $('#busquedaEquipoCh').prop('checked', false);
    $('#mantPubCh').prop('checked', false);
    $('#capAreas').prop('checked', false);
    $('#crearSolpp').prop('checked', false);
    $('#solicitudesPp').prop('checked', false);
    $('#pagosPp').prop('checked', false);
    $('#reportesPp').prop('checked', false);
    $('#cartaFondoA').prop('checked', false);
    $('#solicitudesFondoAhorros').prop('checked', false);
    $('#m_registroAct').prop('checked', false);
    $('#m_agendaAct').prop('checked', false);

    onRequest({ opcion : 22 ,id_rol:rol_id}, respAccesosPorRol);
       
}

function habDesAccesos(id_rol,id_cb,menu_id)
{
    
    console.log("prueba check "+id_rol+" "+id_cb+" "+menu_id);
    if($('#'+id_cb).is(':checked'))
    {
        onRequest({ opcion : 23 ,id_rol:id_rol, id_menu:menu_id }, respUpdateAccesos);
        console.log("Esta check");
    }
    else{
        console.log("No esta check");
        onRequest({ opcion : 24 ,id_rol:id_rol, id_menu:menu_id }, respUpdateAccesos);
    }  
}


function EntregaUsuario()
{
    var a = getParameterByName("usuario_id");
    console.log("usuario:"+a);
    console.log("prueba check ");
    if($('#cbEntregadoUsuario').is(':checked'))
    {
        console.log("Esta check");
        onRequest({ opcion : 99 ,usuario:a}, respUpdateUsuario);
    }
    else{
        console.log("No esta check");
        onRequest({ opcion : 100 ,usuario:a}, respUpdateUsuario);
    }  
}

function editRolesdeEmp(id_emp)
{
    var a = document.createElement('a');
     a.href="/mantenimiento/rolemp.php?empresa_id="+id_emp;
     document.body.appendChild(a);
     a.click();

}

function eliminarDeTablaTmp(id_emp,id_puesto, id_suc)
{
    console.log("empresa y sueldo "+id_emp+" "+id_puesto+ " "+id_suc);
    onRequest({ opcion : 48 ,empresa:id_emp, puesto:id_puesto, sucursal:id_suc }, respEliminarDatoDeTmp);

}

function btnVista(id_publicacion)
{
    var empleado = Cookies.get('b_capturista_id');
    console.log("----Publicacion---- "+id_publicacion+" "+empleado);
    
    onRequest({ opcion : 58 ,publicacion_id:id_publicacion, empleado_id:empleado }, respVisto);
}

//respuesta de menu publicaciones 
var respCargaPublicacionesB = function(data) { 
    if (!data && data == null)
    return;  

       //console.log(data)
    var documento='';
    var primerMenu=0;
       
   primerMenu = 1;
   documento+="<li class='tab'><a class='white-text  waves-effect waves-dark' id='tab1' onClick='cargarPublicacion(1)' ><strong>Comunicados</strong></a></li>";


    $('#tipoPublicacion').html(documento); 

    cargarPublicacion(primerMenu);

    cargarMenuPorRol();
}

function cargarPublicacion(primerMenu){
    var capturista_id="";
    capturista_id=Cookies.get('b_capturista_id');
    
    
    $('a').removeClass("active indigo darken-4"); 

    $('#tab'+primerMenu).addClass("active indigo darken-4"); 

    Cookies.set("b_tipodoc",primerMenu);
    
    var usuario=Cookies.get('b_capturista_id');
    console.log("VERIFICAR SI HAY PUBLICACIONES "+usuario+" "+primerMenu);
    onRequest({ opcion : 60 ,usuario_id:usuario, tipodoc:primerMenu}, respVerificarPublicaciones);  

}

function editarCorreo(id_usu)
{
    onRequest({ opcion : 65 ,usuario_id:id_usu}, respEditarCorreo);  

}







var respCargaPublicacionesVistas = function(data) { 
    if (!data && data == null)
             return;  

                //console.log(data)
             var documento='';
             var primerMenu=0;

             for(var i=0; i<data.length; i++){

                if(i==0){
                    primerMenu = data[i].id;
                    documento+="<li class='tab'><a class='white-text  waves-effect waves-dark' id='tab"+data[i].id+"' onClick='cargarPublicacionVistas("+data[i].id+")' ><strong>"+data[i].docuemento+"</strong></a></li>";
                } 
                else{
                    documento+="<li class='tab'><a class='white-text waves-effect waves-dark' id='tab"+data[i].id+"' onClick='cargarPublicacionVistas("+data[i].id+")' ><strong>"+data[i].docuemento+"</strong></a></li>";
                }
                  
             }
              
         
             $('#tipoPublicacion').html(documento); 

             cargarPublicacionVistas(primerMenu);

             cargarMenuPorRol();
}
 
function cargarPublicacionVistas(primerMenu){
    var capturista_id="";
    capturista_id=Cookies.get('b_capturista_id');
    
    
    $('a').removeClass("active indigo darken-4"); 

    $('#tab'+primerMenu).addClass("active indigo darken-4"); 

    Cookies.set("b_tipodoc",primerMenu);
    
    var usuario=Cookies.get('b_capturista_id');
    console.log("VERIFICAR SI HAY PUBLICACIONES "+usuario+" "+primerMenu);
    onRequest({ opcion : 61 ,usuario_id:usuario, tipodoc:primerMenu}, respVerificarPublicacionesVistas);  
    
}

var respUsuarios_rol = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Usuario no actualizado, consulte con el area de sistemas', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Agregado rol a usuario!', classes: 'rounded #43a047 green darken-1'}); 

    //Actualiza la pagina
    cargarConfUsuarios();
    
}

var respUsuarios_empresa = function(data) { 
    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Usuario no actualizado, consulte con el area de sistemas', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Agregado empresa a usuario!', classes: 'rounded #43a047 green darken-1'}); 

    //Actualiza la pagina
    cargarConfUsuarios();
    
}

var respCargarRolesPorUsuario = function(data){
    if (!data && data == null)
    {
        M.toast({html: 'Usuario sin roles', classes: 'rounded red'}); 
        return;
    }
    
    for(var i=0; i<data.length; i++){
        var idrol=data[i].rolid;
      //  console.log(idrol);
        onRequest({ opcion : 22 ,id_rol:idrol },respCargarMenu);
    }
}


var respVerificar_usu_rol  = function(data) { 
    if (!data && data == null)
        return;  
    
    
    for(var i=0; i<data.length; i++){
        if(data[i].contador >= 1)
        {
            M.toast({html: '¡El usuario ya cuenta con el rol seleccionado!.', classes: 'rounded red'}); 
        }
        else{
            usuario = $("#UsuariosDD2").val();
            rol = $("#tipoRolAc").val();
            console.log("usuario y rol"+usuario+" "+rol);
            onRequest({ opcion : 30 ,usuario:usuario,rol:rol}, respUsuarios_rol);
        }
    }
}


var respVerificar_usu_empresa  = function(data) { 
    if (!data && data == null)
        return;  
    
    
    for(var i=0; i<data.length; i++){
        if(data[i].contador >= 1)
        {
            M.toast({html: '¡El usuario ya cuenta con la empresa seleccionada!.', classes: 'rounded red'}); 
        }
        else{
            usuario = $("#UsuariosDD2").val();
            empresa = $("#tipoEmpresaAddFile").val();  
            console.log("Presionaste boton "+usuario+" "+empresa);
            onRequest({ opcion : 32 ,usuario:usuario,empresa:empresa}, respUsuarios_empresa);

        }
    }
    cargarConfUsuarios();
        

}
var respCargaUsuarios  = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) 
     {
        var nombre=String(data[i].nombre);
        console.log("-------"+nombre);
        if(nombre=="undefined")
        {
            d+= '<tr>'+
            '<td>Sin usuario asignado</td>'+
            '<td class="left">'+ 
            '</tr> ';  
        }
        else
        {
            d+= '<tr>'+
            '<td>'+data[i].id+'</td>'+
            '<td>'+data[i].nombre+'</td>'+
            '<td>'+data[i].sucursal+'</td>'+
            '<td>'+data[i].usuario+'</td>'+ 
            '<td>'+data[i].pass+'</td>'+ 
            '<td>'+data[i].entregado+'</td>'+ 
            '<td>'+data[i].estatus+'</td>' +
            '<td class="left">'+
            '<a onclick="editarUsu('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger"><i class="material-icons">edit</i></a>'+
            '<a onclick="asignarPermisos('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small black btn modal-trigger"><i class="material-icons">person_pin</i></a>'+
            '</td>'  +'</tr> ';
        }
        
    
     }
     
     $("#tablaUsuarios").html(d);

     cargarMenuPorRol();

}

var respCargarConfRoles = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
         
         var roles=String(data[i].roles);
         console.log("-------"+roles);
         if(roles=="undefined")
         {
            d+= '<tr>'+
            '<td>Sin Roles</td>'+
            '<td class="left">'+ 
            '</tr> ';  
            $("#tablaRolUsuario").html(d);
         }
         else
         {
            d+= '<tr>'+
            '<td>'+data[i].roles+'</td>'+
            '<td class="left">'+
            '<a onclick="eliminarRol('+data[i].id_rol+')" class="waves-effect waves-light btn-floating btn-small red darken-4 btn modal-trigger"><i class="material-icons">delete_forever</i></a>'+ 
            '</tr> ';  
            $("#tablaRolUsuario").html(d);
         }

    }

}


var respCargarConfEmpresas = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
        var empresas=String(data[i].empresas);
        console.log("-------"+empresas);
        if(empresas=="undefined")
        {
           d+= '<tr>'+
           '<td>Sin Empresas</td>'+
           '<td class="left">'+ 
           '</tr> ';  
           $("#tablaEmpUsuario").html(d);
        }
        else
        {
            d+= '<tr>'+
            '<td>'+data[i].empresas+'</td>'+ 
            '<td class="left">'+
            '<a onclick="eliminarEmp('+data[i].id_emp+')" class="waves-effect waves-light btn-floating btn-small red darken-4 btn modal-trigger"><i class="material-icons">delete_forever</i></a>'+ 
            '</tr> ';

            $("#tablaEmpUsuario").html(d);
        }
     }
     
     

}


var respEliminarRolUsu = function(data) { 
    console.log("--------------"+data);
    if (!data && data == null)
    {
        M.toast({html: 'Rol no actualizado, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    M.toast({html: 'Rol eliminado!.', classes: 'rounded red'});  

    //Actualiza de nuevo los accesos

    cargarConfUsuarios();
    console.log("Actualizado!!");
}

var respEliminarEmpUsu = function(data) { 
    console.log("--------------"+data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa no actualizado, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    M.toast({html: 'Empresa eliminada!.', classes: 'rounded red'});  

    //Actualiza de nuevo los accesos

    cargarConfUsuarios();
    console.log("Actualizado!!");
}

var respCargarEmpresaXid = function(data) { 
    if (!data && data == null)
        return;  
 
    var documento='';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].empresa_id+' selected>'+data[i].nombre+'</option>';
        console.log("empresa "+data[i].empresa_id);
    }
   
    
    $('#Empresarol').html(documento);
    $('#Empresarol').formSelect();    
}

var respVerificar_emp_rol  = function(data) { 
    if (!data && data == null)
        return;  
    
    
    for(var i=0; i<data.length; i++){
        if(data[i].contador >= 1)
        {
            M.toast({html: '¡La empresa ya cuenta con el puesto seleccionado!.', classes: 'rounded red'}); 
        }
        else{
            empresa = $("#Empresarol").val();
            rol = $("#tipoPuestoAc").val();
            console.log("empresa y rol"+empresa+" "+rol);
            onRequest({ opcion : 41 ,idemp:empresa,idrol:rol}, respEmpresas_rol);
        }
    }
}

var respEmpresas_rol  = function(data) { 

    console.log(data);
    if (!data && data == null)
    {
        M.toast({html: 'Empresa no actualizado, consulte con el area de sistemas', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Agregado puesto a empresa!', classes: 'rounded #43a047 green darken-1'}); 

    //Actualiza la pagina
    cargarConfEmpresa();
}

var respCargarRolesXemp = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

     for (var i = 0; i < data.length; i++) {
         
         var roles=String(data[i].nombre);
         console.log("-------"+roles);
         if(roles=="undefined")
         {
            d+= '<tr>'+
            '<td>Sin puestos seleccionados</td>'+
            '<td class="left">'+ 
            '</tr> ';  
            $("#tablaRolEmpresa").html(d);
         }
         else
         {
            d+= '<tr>'+
            '<td>'+data[i].nombre+'</td>'+
            '<td class="left">'+
            '<a onclick="eliminarRoldeEmp('+data[i].id_rol+')"  class="waves-effect waves-light btn-floating btn-small red darken-4 btn modal-trigger tooltipped" data-tooltip="I am a tooltip" data-delay="50"  ><i class="material-icons">delete_forever</i></a>'+ 
            '</tr> ';  
            $("#tablaRolEmpresa").html(d);

         }

    }
    cargarMenuPorRol();
}


var respEliminarRolEmp = function(data) { 
    console.log("--------------"+data);
    if (!data && data == null)
    {
        M.toast({html: 'Puesto no eliminado, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    M.toast({html: 'Puesto eliminado!.', classes: 'rounded red'});  

    //Actualiza de nuevo los accesos

    cargarConfEmpresa();
    console.log("Actualizado!!");
}


var respCargarRolesXempChb = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

    var documento='<option value="0"  selected>Todos</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id_rol+'>'+data[i].nombre+'</option>';
    }
    $('#tipoPuestoXemp').html(documento);
    $('#tipoPuestoXemp').formSelect(); 
    
}

var respCargaSucursalesXEmpresa = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';

    var documento='<option value="0"  selected>Todas</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nombre+'</option>';
    }
    $('#sucursalesDD').html(documento);
    $('#sucursalesDD').formSelect(); 
    
}

var respCargarPuestos = function(data) { 
    if (!data && data == null)
        return;  
        

        console.log(data)
    var documento='<option value="0" disabled selected>Seleccione el puesto</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nombre+'</option>';
    }
   
    $('#tipoPuestoAc').html(documento);
    $('#tipoPuestoAc').formSelect(); 
   
}

var respTablaTmp = function(data) { 
    console.log("--------------"+data);
    if (!data && data == null)
    {
        M.toast({html: 'Datos no actualizados, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    M.toast({html: 'Datos actualizados!', classes: 'rounded green'});  
    var usuario = Cookies.get('b_capturista_id');
    onRequest({ opcion : 47 ,idusuario:usuario}, respCargarTablaTmp);
}

var respCargarTablaTmp = function(data) { 
    if (!data && data == null) 
    return; 

    var d = '';

    

     for (var i = 0; i < data.length; i++) {    
        var puesto=String(data[i].puesto);
        console.log("-------"+puesto);
        if(puesto=="undefined")
        {
           d+= '<tr>'+
           '<td>Sin puestos agregados</td>'+
           '<td class="left">'+ 
           '</tr> ';  
           $("#tablaPuestoEmpresa").html(d);
        }
        else{

            d+= '<tr>'+
            '<td>'+data[i].empresa+'</td>'+
            '<td>'+data[i].sucursal+'</td>'+
            '<td>'+data[i].puesto+'</td>'+
            '<td class="left">'+
            '<a onclick="eliminarDeTablaTmp('+data[i].id_empresa+','+data[i].id_puesto+','+data[i].id_sucursal+')"  class="waves-effect waves-light btn-floating btn-small red darken-4 btn modal-trigger tooltipped" data-tooltip="Eliminar puesto" data-delay="50"  ><i class="material-icons">delete_forever</i></a>'+ 
            '</tr> '; 
        }
    }
    $("#tablaPuestoEmpresa").html(d);
    $('.tooltipped').tooltip();
}

var respEliminarDatoDeTmp = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'Datos no eliminados, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    M.toast({html: 'Datos Eliminados!', classes: 'rounded red'});  
    var usuario = Cookies.get('b_capturista_id');
    onRequest({ opcion : 47 ,idusuario:usuario}, respCargarTablaTmp);
    
}

var respVerificarTablaTmp = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    for (var i = 0; i < data.length; i++) {    
       if(data[i].contador>=1)
       {  
            onRequest({ opcion : 50}, respEliminarTodos);
       }
    }
    cargarMenuPorRol();
}

var respEliminarTodos = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'Datos no eliminados, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    cargarMenuPorRol();
}
    

var respInsertarTablaTemp = function(data) { 
    //Se toma el ultimo id de la ultima publicacion insertada 
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
      
       var id_publicacion=data[0].id;
       $("#idpublicacion1").val(id_publicacion);
       //se le asigna a un input que esta oculto para guardarlo y que no se borro


    //se toma el id del usuario para cargar los datos de la tabla temporal
    var usuario = Cookies.get('b_capturista_id');
    console.log("Sacar id de la publicacion= "+id_publicacion);
    onRequest({ opcion : 47 ,idusuario:usuario}, respInsertarDetallePub);
    
}

var respInsertarDetallePub = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    console.log("------------------------------Probando una cosa mas aqui--------------------");
    //Se insertan los datos en la tabla b_detalle_pub uno por uno dependiendo de los datos cargados de la tabla temporal
    var publicacion=$("#idpublicacion1").val()
    for (var i = 0; i < data.length; i++) {    
       var empresa=data[i].id_empresa;
       var puesto=data[i].id_puesto;
       var sucursal=data[i].id_sucursal;
       console.log(publicacion+" "+empresa+" "+puesto+ " "+ sucursal);
       onRequest({ opcion : 52 ,publicacion_id:publicacion,empresa_id:empresa,puesto_id:puesto, sucursal_id:sucursal}, respInsertarDetallePubF);

    }
    //por cada dato insertado en b_detalle_publicacion va a checar el rol de cada inserción para encontrar los usuarios 
    //que tengan dicho rol para insertalos en la tabla de confirmaciones para saber que usuario vio y quien no vio la publicacion.
    
    var publicacion=$("#idpublicacion1").val() // se toma la ultima publicacion insertada para buscar los datos en b_detalle para 
    // luego insertarlos en la tabla de confirmaciones
    console.log("Probando algo aqui------"+publicacion);  
    onRequest({ opcion : 53 ,publicacion_id:publicacion}, respCargarParaInsertarTablaConfirmaciones);

}

var respInsertarDetallePubF = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
}

var respCargarParaInsertarTablaConfirmaciones = function(data) { 
    //Se buscan los empleados para ingresar
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    for (var i = 0; i < data.length; i++) {    
        var publicacion=data[i].publicacion_id;
        var puesto=data[i].puesto_id;
        var empresa=data[i].empresa_id;
        var sucursal=data[i].sucursal_id;
        console.log("publicacion:"+publicacion+" puesto"+puesto+" empresa:"+empresa);
        if(puesto==0)
        {
            console.log("Puesto es igual a 0");
            if(sucursal==0)
            {
                console.log("Sucursal es igual a 0");
                onRequest({ opcion : 54 ,empresa_id:empresa, publicacion_id:publicacion}, respTablaConfirmaciones);
            }
            else
            {
                console.log("Sucursal NO igual a 0");
                onRequest({ opcion : 104 ,empresa_id:empresa, sucursal_id:sucursal, publicacion_id:publicacion}, respTablaConfirmaciones);
            }
            
        }
        else
        {
            
            console.log("Puesto no es igual a 0");
            onRequest({ opcion : 55 ,puesto_id:puesto, empresa_id:empresa, publicacion_id:publicacion}, respTablaConfirmaciones);
        }
     }
     $( "#formFiles" ).submit();
     console.log("TERMINANDO!!!!!!!!!!");
    
}
/*
var respInsertarTablaConfirmaciones = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    var publicacion=$("#idpublicacion1").val()
    for (var i = 0; i < data.length; i++) 
    {
        var verif=String(data[0].empleado_id);
        console.log("------ VERIIIF--"+verif);
        if(verif==0)
        {
            M.toast({html: 'No hay empleados que cumplan con dichos parametros, favor de verificarlo', classes: 'rounded red'});
            $( "#formFiles" ).submit();
            return;
        }
        else
        {
            var empleado=data[i].empleado_id;
            var puesto=data[i].puesto_id;
            var empresa=data[i].empresa_id;
            console.log(i+".- publicacion:"+publicacion+" puesto"+puesto+" empresa:"+empresa+" empleado:"+empleado);

            onRequest({ opcion : 56 ,publicacion_id:publicacion,empleado_id:empleado,puesto_id:puesto,empresa_id:empresa}, respTablaConfirmaciones);
            M.toast({html: 'Publicacion Realizada correctamente', classes: 'rounded green'});
            $( "#formFiles" ).submit();
        }
        
       
    }

    
}
*/
var respTablaConfirmaciones = function(data) { 
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    console.log("INSERCCION REALIZADA");

    
}

var pubdd = '';
var auxiliar=0;
var respCargaPublicacionesFinal = function(data) { 
    if (!data && data == null) 
    return;  
   
    var nombre=Cookies.get('b_capturista');
     for (var i = 0; i < data.length; i++) {
        var titulo=String(data[i].titulo);
        var ruta = String(data[i].ruta);
        if (ruta=="SIN DOCUMENTO")
        {
            ruta="bancaprepa.png";
        }
        console.log("-------"+titulo);
        
        if(titulo=="undefined"){
            
        }
        else{
            $("#CargarPublicacionesVaciasVistas").empty();
            if(data[i].formato=="PDF"){ 
                console.log("ES PDF");   
                    pubdd+='<div class="col s10 m3 l2 mb-5 mt-5 mr-5 z-depth-2">'+
                    '<a class="modal-trigger" onclick="abrirModalImg('+data[i].id_publicacion+')"  href="#">'+
                    '<img class="mosaico z-depth-5" src="/img/pdf.png"></a>'+
                    '<b> <p class="break-word" >'+data[i].titulo.substring(0,20)+'</p></b>'+
                    '</div> ';  
            }
            else{
                if(data[i].formato=="IMG")
                {
                    pubdd+='<div class="col s10 m3 l2 mb-5 mt-5 mr-5 z-depth-2"  >'+
                    '<a class="modal-trigger" onclick="abrirModalImg('+data[i].id_publicacion+')"  href="#">'+
                    '<img class="mosaico  z-depth-5" src="imagenes/publicaciones/'+ruta+'"></a>'+
                    '<b> <p class="break-word" >'+data[i].titulo.substring(0,20)+'</p></b>'+
                   '</div> ';  
                }
                else
                {
                    pubdd+='<div class="col s10 m3 l2 mb-5 mt-5 mr-5 z-depth-2"  >'+
                    '<a class="modal-trigger" onclick="abrirModalImg('+data[i].id_publicacion+')"  href="#">'+
                    '<img class="mosaico z-depth-5" src="imagenes/publicaciones/video.jpg"></a>'+
                    '<b> <p class="break-word" >'+data[i].titulo.substring(0,20)+'</p></b>'+
                   '</div> '; 
                }
                    
            }
        }
    }
    $("#CargarPublicacionesFinal").html(pubdd);
}

var respCargarEmpParaPublicaciones = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    for (var i = 0; i < data.length; i++) 
    {
        var empresa=data[i].id_emp;
        var puesto=Cookies.get('b_puesto_id');
        var tipodoc=Cookies.get('b_tipodoc');
        console.log("_______________EMPRESA Y PUESTO DESDE COOKIES"+ empresa+" "+puesto);
        
        var usuario = Cookies.get('b_capturista_id');
       
        onRequest({ opcion : 57, empresa_id:empresa, usuario_id:usuario,tipo_doc:tipodoc}, respCargaPublicacionesFinal);
        console.log("---Reiniciar variable");
        pubdd=' ';
        console.log("---variable reiniciada"+pubdd+"sda");
    }  
}

var respVisto = function(data) { 
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    console.log("VISTO");
    M.toast({html: 'Marco la publicación como vista, gracias!', classes: 'rounded  blue darken-4'}); 
    cargarPublicacionesNuevas();

    
}

var pubdd2 = '';
var respCargarEmpParaPublicacionesNuevas = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    for (var i = 0; i < data.length; i++) 
    {
        var empresa=data[i].id_emp;
        var puesto=Cookies.get('b_puesto_id');
        var tipodoc=Cookies.get('b_tipodoc');
        var usuario = Cookies.get('b_capturista_id');  
        console.log("_______________EMPRESA Y PUESTO DESDE COOKIES"+ empresa+" "+puesto);
        onRequest({ opcion : 59, empresa_id:empresa, usuario_id:usuario,tipo_doc:tipodoc}, respCargaPublicacionesFinalNuevas);
        console.log("---Reiniciar variable");
        pubdd2=' ';
        console.log("---variable reiniciada"+pubdd+"sda");
    }  
}


var respCargaPublicacionesFinalNuevas = function(data) { 
    if (!data && data == null) 
    return; 
    var nombre=Cookies.get('b_capturista');
     for (var i = 0; i < data.length; i++) {
        var titulo=String(data[i].titulo);
        var ruta = String(data[i].ruta);
        console.log("-------"+titulo+"------"+ruta);
        
        if (ruta=="SIN DOCUMENTO")
        {
            ruta="bancaprepa.png";
        }
        console.log("!1111111111"+ruta);
        if(titulo=="undefined"){
            /*pubdd2+='<div class="sinPub">'+
            '<h4>Sin publicaciones nuevas</h4>'+
            '<h5>Bienvenido '+nombre+'!</h5>'+
            '</div>';*/

        }
        else{
                if(data[i].formato=="PDF"){    
                        pubdd2+= '<div class="col s12 l8 offset-l2" > '+
                        '<div class="card"> '+
                        '       <div class="card-image waves-effect waves-block waves-light">'+
                        '          <iframe src="imagenes/publicaciones/'+ruta+'"  class="col s12" style="border: none;height:500px"></iframe>'+
                        '     </div>'+
                        '    <div class="card-content">'+
                        '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
                        '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
                        '         <p><a onclick="btnVista('+data[i].id_publicacion+')" class="btn-floating waves-effect waves-light btn indigo darken-4" ><i class="material-icons left">remove_red_eye</i></a></p>'+
                        '      </div>'+
                        '      <div class="card-reveal">'+
                        '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
                        '            <p>'+data[i].descripcion+'.</p>'+
                        '         </div>'+
                        '  </div>'+
                        '</div> ';     
                }
                else{
                    if(data[i].formato=="IMG")
                    {
                        pubdd2+= '<div class="col s12 l8 offset-l2" > '+
                        '<div class="card"> '+
                        '       <div class="card-image waves-effect waves-block waves-light">'+
                        '          <img class="activator" src="imagenes/publicaciones/'+ruta+' ">'+
                        '     </div>'+
                        '    <div class="card-content">'+
                        '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
                        '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
                        '         <p><a onclick="btnVista('+data[i].id_publicacion+')" class="btn-floating waves-effect waves-light btn indigo darken-4" ><i class="material-icons left">remove_red_eye</i></a></p>'+
                        '      </div>'+
                        '      <div class="card-reveal">'+
                        '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
                        '            <p>'+data[i].descripcion+'.</p>'+
                        '         </div>'+
                        '  </div>'+
                        '</div> ';
                    }
                    else
                    {
                        console.log("ES VIDEO");
                        pubdd2+= '<div class="col s6 offset-l2" > '+
                        '<div class="card"> '+
                        '       <div class="card-image waves-effect waves-block waves-light">' +
                        '<video class="responsive-video" controls>'+
                        '<source src="imagenes/publicaciones/'+ruta+'" type="video/mp4">'+
                        '</video>'+
                        '     </div>'+
                        '    <div class="card-content">'+
                        '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
                        '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
                        '         <p><a onclick="btnVista('+data[i].id_publicacion+')" class="btn-floating waves-effect waves-light btn indigo darken-4" ><i class="material-icons left">remove_red_eye</i></a></p>'+
                        '      </div>'+
                        '      <div class="card-reveal">'+
                        '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
                        '            <p>'+data[i].descripcion+'.</p>'+
                        '         </div>'+
                        '  </div>'+
                        '</div> ';
                        
                        pubdd+='<div class="video-container"></a> </div>';   
                    }
                }
        }
    }
    $("#CargarPublicacionesN").html(pubdd2);
}


var respVerificarPublicaciones = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    var conteo= data[0].conteo;
    console.log("conteo:"+conteo);
    var nombre=Cookies.get('b_capturista');
    var vacio="";
    if(conteo>0)
    {
        var tipodoc=Cookies.get('b_tipodoc');
        var usuario = Cookies.get('b_capturista_id');  
        onRequest({ opcion : 59, usuario_id:usuario,tipo_doc:tipodoc}, respCargaPublicacionesFinalNuevas);
        console.log("---Reiniciar variable");
        pubdd2=' ';
        console.log("---variable reiniciada"+pubdd+"sda");
    }
    else
    {
        vacio+='<div class="sinPub">'+
            '<h4>Sin publicaciones nuevas</h4>'+
            '<h5>Bienvenido '+nombre+'!</h5>'+
            '</div>';
            $("#CargarPublicacionesN").html(vacio);
    }
}


var respVerificarPublicacionesVistas = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    var conteo= data[0].conteo;
    console.log("conteo:"+conteo);
    var nombre=Cookies.get('b_capturista');
   
    var vacio="";
    if(conteo>0)
    {
        var tipodoc=Cookies.get('b_tipodoc');     
        var usuario = Cookies.get('b_capturista_id');
       
        onRequest({ opcion : 57, usuario_id:usuario,tipo_doc:tipodoc}, respCargaPublicacionesFinal);
        console.log("---Reiniciar variable");
        pubdd=' ';
        console.log("---variable reiniciada"+pubdd+"sda");  
    }
    else
    {
        vacio+='<div class="sinPub">'+
            '<h4>Sin publicaciones vistas</h4>'+
            '<h5>Bienvenido '+nombre+'!</h5>'+
            '</div>';
            $("#CargarPublicacionesFinal").html(vacio);
    }
}


var respNotificaciones = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    var conteo= data[0].conteo;
    texto=' <li class="divider"></li>'+
    '<li><a href="#!"><i class="material-icons right">notifications_active</i>Usted tiene '+conteo+' publicaciones sin leer</a></li>';

    
    if(conteo>0)
    {
        txt='+'+conteo+'';
        $("#btnNoti").addClass('red-text');
        $("#iconNotiF").addClass('red-text');
    }
    else
    {
        txt='';
        $("#btnNoti").removeClass('red-text');
        $("#iconNotiF").removeClass('red-text');
    }
    
    $("#btnNotiF").html(txt);    
}


var respCargarEmpleadoCorreo = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }


    var verif=String(data[0].nombrecompleto);
    if(verif=="undefined")
    {
        $("#correoEmpleado").attr("disabled","disabled");
        $("#passEmpleado").attr("disabled", "disabled");
        $("#selectDominio").attr("disabled", "disabled");
        M.toast({html: 'Id no registrado, verifique si es correcto', classes: 'rounded red'}); 
    }
    else
    {
        console.log(data[0].nombrecompleto);
        console.log(data[0].correo);
        $("#nombreEmpleadoCorreo").val(data[0].nombrecompleto);
        if(data[0].correo=="vacio")
        {
            $("#correoEmpleado").removeAttr("disabled");
            $("#passEmpleado").removeAttr("disabled");
            $("#selectDominio").removeAttr("disabled");
            
        }
        else
        {
            $("#correoEmpleado").attr("disabled","disabled");
            $("#passEmpleado").attr("disabled", "disabled");
            $("#selectDominio").attr("disabled", "disabled");
            M.toast({html: 'Usuario ya tiene correo!', classes: 'rounded red'});    
        }
    }

    
}

var respCargarEmpleadoUsuario = function(data) {
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }


    var verif=String(data[0].nombrecompleto);
    if(verif=="undefined")
    {
        $("#UsuarioEmpleado").attr("disabled","disabled");
        $("#passEmpleado").attr("disabled", "disabled");
        
        M.toast({html: 'Id no registrado, verifique si es correcto', classes: 'rounded red'}); 
    }
    else
    {
        console.log(data[0].nombrecompleto);
        console.log(data[0].usuario);
        $("#nombreEmpleadoCorreo").val(data[0].nombrecompleto);
        if(data[0].usuario=="vacio")
        {
            $("#UsuarioEmpleado").removeAttr("disabled");
            $("#passEmpleado").removeAttr("disabled");
        }
        else
        {
            $("#UsuarioEmpleado").attr("disabled","disabled");
            $("#passEmpleado").attr("disabled", "disabled");
            M.toast({html: 'Empleado ya tiene Usuario!', classes: 'rounded red'});    
        }
    }

    
}



var respAgregaCorreo = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    

    M.toast({html: 'Correo agregado correctamente! ', classes: 'rounded green'}); 
    $("#idEmpleadoCorreo").val("");
    $("#nombreEmpleadoCorreo").val("");
    $("#correoEmpleado").val("");
    $("#passEmpleado").val("");
    $("#dominioDD").val("");
    $("#modalAgregarCorreos").modal("close");
    cargarCorreos();
}


var respEditarCorreo = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    $("#idCorreoEdit").val(data[0].id_empleado);
    $("#editNomCorreo").val(data[0].nombrecompleto);
    $("#editCorreo").val(data[0].correo);
    $("#editPass").val(data[0].pass);

    if(data[0].entregado=="Si")
    {
        $('#cbEntregado').prop('checked', true);
    }
    else
    {
        $('#cbEntregado').prop('checked', false); 
    }

    if(data[0].estatus=="Activo")
    {
        $('#cbEstatus').prop('checked', true);
    }
    else
    {
        $('#cbEstatus').prop('checked', false); 
    }
    

}


var respEditarCorreoF = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    

    M.toast({html: 'Correo editado correctamente! ', classes: 'rounded green'}); 
    $("#modalEditarCorreo").modal("close");
    cargarCorreos();
}


var respBorrarCorreo = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    $("#idBorrarCorreo").val(data[0].id_empleado);
    $("#nomBorrarcorreo").val(data[0].nombrecompleto);
    $("#correoBorrar").val(data[0].correo);
    $("#id_correo").val(data[0].id_correo);
    

}


var respBorrarCorreoFinal = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    

    M.toast({html: 'Correo Eliminado correctamente! ', classes: 'rounded red'}); 
    $("#modalEliminarCorreo").modal("close");
    cargarCorreos();
}




var respAgregaTicket = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    

    M.toast({html: 'Ticket insertado correctamente ', classes: 'rounded green'}); 
    location.href="/mandarTicket.php";
    
}

var respCargarTickets = function(data) { 
    
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
     '<td>'+data[i].titulo+'</td>'+
     '<td>'+data[i].descripcion+'</td>'+
     '<td>'+data[i].solicitado+'</td>'+
     '<td>'+data[i].estatus+'</td>'+ 
     '<td class="'+x+' left">'+
     //'<a onclick="editarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" href="#modalEditarDoc"><i class="material-icons">edit</i></a>' + 
     //'<a onclick="deshabDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger" href="#modalDeshabDoc"><i class="material-icons">do_not_disturb_alt</i></a>' + 
     //'<a onclick="BorrarDoc('+data[i].doc_id+')" class="waves-effect waves-light btn-floating btn-small red accent-4 btn modal-trigger" href="#modalEliminarDoc"><i class="material-icons">delete</i></a>' +
     '</td>'  +'</tr> ';
     }
     
     $("#tablaTicketsGeneral").html(d);

     cargarMenuPorRol();
}


var respPermitirPublicacion = function(data) { 
    //se insertan los datos en la tabla confirmaciones!
    if (!data && data == null)
    {
        M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
        return;
    }
    
    if(data[0].contador==0)
    {
        M.toast({html: 'Es necesario que seleccione los puestos a los que se dirige la publicacion.', classes: 'rounded red'}); 
    }
    else
    {
        $('#modalAceptarDoc').modal('open');
    }

   
   
    
}


var respCargarMttoPub = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';
    var x = '';



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
            '<td>'+data[i].titulo+'</td>'+
            '<td>'+data[i].tipoDoc+'</td>'+
            '<td>'+data[i].capturista+'</td>'+
            '<td>'+data[i].fecha+'</td>'+
            '<td>'+data[i].hora+'</td>'+ 
            '<td>'+data[i].estatus+'</td>'+ 
            '<td class="'+x+' left">'+
            '<a onclick="verInfoPub('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger" href="#modalVerDatosPub"><i class="material-icons">remove_red_eye</i></a>' +
            '<a onclick="editarPublicacion('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger disabled" href="#modalEditarPub"><i class="material-icons">edit</i></a>' + 
            '<a onclick="deshabPub('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger disabled" href="#modalBajaPub"><i class="material-icons">do_not_disturb_alt</i></a>' + 
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
            '<td>'+data[i].tipoDoc+'</td>'+
            '<td>'+data[i].capturista+'</td>'+
            '<td>'+data[i].fecha+'</td>'+
            '<td>'+data[i].hora+'</td>'+ 
            '<td>'+data[i].estatus+'</td>'+ 
            '<td class="'+x+' left">'+
            '<a onclick="verInfoPub('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger" href="#modalVerDatosPub"><i class="material-icons">remove_red_eye</i></a>' +
            '<a onclick="editarPublicacion('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger " href="#modalEditarPub"><i class="material-icons">edit</i></a>' + 
            '<a onclick="deshabPub('+data[i].id+')" class="waves-effect waves-light btn-floating btn-small orange darken-3 btn modal-trigger " href="#modalBajaPub"><i class="material-icons">do_not_disturb_alt</i></a>' + 
            '</td>'  +'</tr> ';
        }
     }
     
     $("#tablaMttoPublicacion").html(d);

     cargarMenuPorRol();
}




var respCargarVistosEmpleados = function(data) { 
    
    if (!data && data == null) 
    return; 

    var d = '';
    var vis = '';
    var f = '';
    var h = '';
    var n=0;
     for (var i = 0; i < data.length; i++) {
        n++;
        var nombre=String(data[i].nombre);
        console.log("-------"+nombre);
        if(nombre=="undefined")
        {
           d+= '<tr>'+
           '<td>Sin personas para mostrar </td>'+
           '<td class="left">'+ 
           '</tr> ';  
           
        }
        else
        {
            if(data[i].visto=="N")
            {
                vis="No";
                f=" ";
                h=" ";

            }
            else
            {
                vis="Si";
                f=data[i].Fvisto;
                h=data[i].Hvisto;
            }
            d+= '<tr>'+
            '<td>'+n+'</td>'+
            '<td>'+data[i].nombre+'</td>'+
            '<td>'+data[i].sucursal+'</td>'+
            '<td>'+vis+'</td>'+
            '<td>'+f+'</td>'+
            '<td>'+h+'</td>'+
            '</td>'  +'</tr> ';
        }
     }
     
     $("#tablaVistoPub").html(d); 
}

var respCargarPubXid = function(data) { 
    
    if (!data && data == null) 
    return; 

    if (data[0].id>0) { 
        console.log(data[0].titulo+" descripcion:"+data[0].descripcion);
      $("#Idpub").val(data[0].id);
      $("#tituloPub").val(data[0].titulo);
      $("#descPubEdit").val(data[0].descripcion);
      
       return;
     
    }
}

var respBajaPub = function(data) { 
    
    if (!data && data == null) 
    return; 

    if (data[0].id>0) { 
      console.log(data[0].titulo+" descripcion:"+data[0].descripcion);
      $("#IdpubBaja").val(data[0].id);
      $("#tituloPubBaja").val(data[0].titulo);
      return;
    }


}



var respActualizarPub = function(data) { 
    if (!data && data == null)
    {
        M.toast({html: 'Publicacion no Actualizada, contacte al area de sistemas.', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Publicación Actualizada!', classes: 'rounded green'}); 

    $("#modalEditarPub").modal("close");

    onRequest({ opcion : 78}, respCargarMttoPub);
    
    
}

var respDardeBajaPub = function(data) { 
    if (!data && data == null)
    {
        M.toast({html: 'Publicacion no Actualizada, contacte al area de sistemas.', classes: 'rounded red'}); 
        return;
    }
    
    M.toast({html: 'Publicación Actualizada!', classes: 'rounded green'}); 

    $("#modalBajaPub").modal("close");
    onRequest({ opcion : 78}, respCargarMttoPub);
    
    
}
var respBuscarEmpleadosCorreo = function(data) { 
    
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

    $("#listaEmpleadosBC").addClass("espacioClientes");
    $("#listaEmpleadosTablaBC").html(d);
}

var respAgregarNombreAdiv = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
        return;
    }

    var nombre=data[0].nombre;
    $("#nombreAbuscarCor").val(nombre);
    
}
var respAgregarNombreAdivADD = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
        return;
    }

    var nombre=data[0].nombre;
    $("#nombreEmpleadoCorreo").val(nombre);
    
}
var respAddEmpleadosCorreo = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
        return;
    }
    
    var d='';
    for (var i = 0; i < data.length; i++) 
    {
        var nombre=String(data[i].descripcion);
        
        d+="<tr> <td>"+data[i].descripcion+" </td>" 
        +"<td> <a onclick='agregarAdivADD("+data[i].id+");' class='waves-effect waves-light btn-floating btn-small blue'><i class='material-icons'>add</i></a> " +
        "</td> </tr> ";
        
    }

    $("#listaEmpleadosADD").addClass("espacioClientes");
    $("#listaEmpleadosTablaADD").html(d);
}
var respAddEmpleadosUsuario = function(data) { 
    
    if (!data && data == null)
    {
        M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
        return;
    }
    
    var d='';
    for (var i = 0; i < data.length; i++) 
    {
        var nombre=String(data[i].descripcion);
        
        d+="<tr> <td>"+data[i].descripcion+" </td>" 
        +"<td> <a onclick='agregarAdivUsuario("+data[i].id+");' class='waves-effect waves-light btn-floating btn-small blue'><i class='material-icons'>add</i></a> " +
        "</td> </tr> ";
        
    }

    $("#listaEmpleadosADD").addClass("espacioClientes");
    $("#listaEmpleadosTablaADD").html(d);
}

var respcargasucursales = function(data) { 
    if (!data && data == null)
        return;  
 
    var documento='<option value="0"  selected>Seleccione Sucursal</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nomComercial+'</option>';
    }
    console.log("checarc");
    
    $('#sucursalesAbuscar').html(documento);
    $('#sucursalesAbuscar').formSelect(); 
    

}


var respCargarPuestosParaCorreos = function(data) { 
    if (!data && data == null)
        return;  
        

       
    var documento='<option value="0" selected>Seleccione el puesto</option>';

    for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nombre+'</option>';
    }
   
    $('#puestosCor').html(documento);
    $('#puestosCor').formSelect(); 
   
}

var respUsuariosParaInseccion = function(data) { 
    if (!data && data == null)
        return;  
    
    for(var i=0; i<data.length; i++){
        
        var capturista=data[i].id;
        var usuario=data[i].usuario;
        var pass=data[i].pass;
        onRequest({ opcion : 94 ,empleado_id:capturista, usuario:usuario, contra:pass}, respInsertarUsuarios);
        
    }

    M.toast({html: 'Todas las insercciones realizadas correctamente.', classes: 'rounded green'}); 
   
}

var respInsertarUsuarios = function(data) { 
    if (!data && data == null)
        return;  
    
        M.toast({html: 'Usuario agregado correctamente.', classes: 'rounded green'});
        $("#modalAgregarUsuarios").modal("close");
        onRequest({ opcion : 35, usuario_id:""}, respCargaUsuarios);
}




var respCargarTipoDedoc = function(data) { 
    if (!data && data == null)
        return;  
    
        var capturista_id=Cookies.get('b_capturista_id');
             
        for(var i=0; i<data.length; i++)
        {
            onRequest({ opcion : 98 ,usuario:capturista_id, doc:data[i].id}, respCargarPubPendientesXtipoDoc); 
        }
}



var respCargarPubPendientesXtipoDoc = function(data) { 
    if (!data && data == null)
        return;  
    
        var conteo=data[0].conteo;
        var menu="";
        if(conteo>0)
        {
            menu="tab"+data[0].id_doc;
            console.log("-----------menu------------"+menu);
            $("#"+menu+"").removeClass('white-text');
            $("#"+menu+"").addClass('red-text');
        }
}


var respUpdateUsuario = function(data) { 
    if (!data && data == null)
        return;  
    
   
    M.toast({html: 'Usuario Actualizado correctamente.', classes: 'rounded green'}); 
   
}
var respVerifNombreUsuario = function(data) { 
    if (!data && data == null)
        return;  
        var idusuario=$("#idEmpleadoCorreo").val();
        var usuario=$("#UsuarioEmpleado").val();
        var pass=$("#passEmpleado").val();
    
        if(data[0].contador>0)
        {
            M.toast({html: 'Usuario repetido, ingrese otro usuario', classes: 'rounded red'});
        }
        else
        {
            onRequest({ opcion : 94 ,empleado_id:idusuario, usuario:usuario, contra:pass}, respInsertarUsuarios);
        }
   
    
   
}

function abrirModalImg(id){
 

    $("#modalImg").modal("open");

     onRequest({ opcion : 107 ,imgId:id}, cargaImg); 

}

var cargaImg = function(data) { 
    if (!data && data == null)
        return;  


      console.log(data)
      pubdd="";
      var i=0;

      if(data[0].formato=="PDF"){  

           pubdd+=  '<div   style="width:100%;" > '+
                        '<div class="card"> '+
                        '       <div class="card-image waves-effect waves-block waves-light">'+
                        '          <iframe src="imagenes/publicaciones/'+data[i].imagen+'"  class="col s12" style="border: none;height:700px;width:100%"></iframe>'+
                        '     </div>'+
                        '    <div class="card-content">'+
                        '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
                        '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
                        '      </div>'+
                        '      <div class="card-reveal">'+
                        '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
                        '            <p>'+data[i].descripcion+'.</p>'+
                        '         </div>'+
                        '  </div>'+
                        '</div> '; 


      }else{

        if(data[i].formato=="IMG")
        {
            pubdd+=  '<div class="col s12 l8 offset-l2" > '+
            '<div class="card"> '+
            '       <div class="card-image waves-effect waves-block waves-light">'+
            '          <img class="activator" src="/imagenes/publicaciones/'+data[i].imagen+'">'+
            '     </div>'+
            '    <div class="card-content">'+
            '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
            '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
            '        </div>'+
            '      <div class="card-reveal">'+
            '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
            '            <p>'+data[i].descripcion+'.</p>'+
            '         </div>'+
            '  </div>'+
            '</div> '; 
        }
        else
        {
            pubdd+=  '<div class="col s6 offset-l2" > '+
            '<div class="card"> '+
            '       <div class="card-image waves-effect waves-block waves-light">'+
            '<video class="responsive-video" controls>'+
            '<source src="imagenes/publicaciones/'+data[i].imagen+'" type="video/mp4">'+
            '</video>'+
            '     </div>'+
            '    <div class="card-content">'+
            '        <span class="card-title activator grey-text text-darken-4"><strong>'+data[i].titulo+'</strong><i class="material-icons right">more_vert</i></span>'+
            '        <p>  &nbsp;&nbsp'+data[i].fecha+'&nbsp; '+data[i].hora+'</p>'+
            '        </div>'+
            '      <div class="card-reveal">'+
            '           <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>'+data[i].titulo+'</span>'+
            '            <p>'+data[i].descripcion+'.</p>'+
            '         </div>'+
            '  </div>'+
            '</div> '; 
        }
      }
    
    $("#contPublicacion").html(pubdd);
   
}

var respCargarEditUsuario = function(data)
{
    if (!data && data == null)
    return;  

    $("#usuario_edit").val(data[0].usuario);
    $("#pass_edit").val(data[0].pass);
    $("#pass_edit2").val(data[0].pass);

    cargarMenuPorRol();
}


var respEditUsuario = function(data) { 
    if (!data && data == null)
        return;  
        M.toast({html: 'Usuario editado con éxito!', classes: 'rounded green'});

        location.href="usuariosTabla.php";
}
