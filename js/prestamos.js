$(document).ready(function(){
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
         $('.modal').modal();
         $('#selectall').on('click', function () {
            //verificar el estado de ese checkbox si esta marcado o no
            var checked_status = this.checked;
   
            /*
             * asignarle ese estatus a cada uno de los checkbox
             * que tengan la clase "selectall"
            */
            $(".selectall").each(function () {
              this.checked = checked_status;
            });
          });

          $('#realizarPagos').click(function() {
      
            var arr = $('[name="checks[]"]:checked').map(function()
            {
              return this.value;
            }).get();
            
            var str = arr.join(',');
            
           var valor1 = str;
           console.log("---VALOR= "+valor1);
           var arrayDeCadenas = valor1.split(',');
           for (var i=0; i < arrayDeCadenas.length; i++) 
           {
                console.log("Valor= "+arrayDeCadenas[i]);
                var corrida_prestamo_id=arrayDeCadenas[i];
                prestamosp({ opcion : 22,corrida_prestamo_id:corrida_prestamo_id},respPagoReflejado );
           }
          
          });

    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// EVENTOS ////////////////////////////////////////////////////////////////
    $("#quincenas").keypress(function(e) {
        //inicializamos variables
      if(e.which == 13) {
          var f=new Date();
          var mes = f.getMonth()+1; //obteniendo mes
          var dia = f.getDate(); //obteniendo dia
          var ano = f.getFullYear(); //obteniendo año
          if(dia<10)
              dia='0'+dia; //agrega cero si el menor de 10
          if(mes<10)
              mes='0'+mes //agrega cero si el menor de 10
          document.getElementById('fecha_solicitud').value=ano+"-"+mes+"-"+dia;
          var quincenas=0;
          quincenas =  parseInt($("#quincenas").val());
          var mesesApagar=0;
          mesesApagar=quincenas/2;
          var montoSolicitado=0;
          montoSolicitado= parseInt($("#monto_solicitado").val());
          var interes = 0;
          var porc_interes=3;
          interes= (montoSolicitado*(porc_interes/100))*mesesApagar;
          var total_pagar=0;
          total_pagar=interes+montoSolicitado;
          var descuento=0;
          descuento=total_pagar/quincenas;
          var totalConLetra = NumeroALetras(total_pagar);
          $("#meses_pagar").val(mesesApagar);
          $("#interes_prestamo").val(interes);
          $("#monto_total_pagar").val(total_pagar);
          $("#descuento").val(descuento.toFixed(2));
          $("#monto_letra").val(totalConLetra);
          var fecha_solicitud=$('#fecha_solicitud').val();
          prestamosp({ opcion : 5, fecha:fecha_solicitud, quincenas:quincenas},respCargarFechaInicioYFinal);
          
      }
    });
    $( "#btnCrearSolicitud" ).click(function() { 
        var porc_interes=3;
        console.log("Boton presionado");
        var capturistaId = Cookies.get('b_capturista_id');
        var nombre_solicitante= $('#nombre_solicitante').val();
        var fecha_solicitud=$('#fecha_solicitud').val();
        var sucursal_id=Cookies.get('b_id_sucursal');
        var empresa_id=Cookies.get('b_empresa_id');
        var tipo_abono=$('#tipo_abono').val();
        var puesto_id=Cookies.get('b_puesto_id');
        var numTarjeta= $('#num_tarjeta').val();
        var beneficiarioCta = $('#bnf_cta').val();
        var nombreBanco = $('#nombre_banco').val();
        var monto_solicitado = $('#monto_solicitado').val();
        var quincenas = $('#quincenas').val();
        var meses_pagar = $('#meses_pagar').val();
        var interes_prestamo = $('#interes_prestamo').val();
        var tipo_abono = $('#tipo_abono').val();
        var descuento = $('#descuento').val();
        var monto_total_pagar = $('#monto_total_pagar').val();
        var monto_letra = $('#monto_letra').val();
        var inicio_descuento = $('#inicio_descuento').val();
        var fin_descuento = $('#fin_descuento').val();

        if(numTarjeta=="")
        {
            M.toast({html: 'Favor de ingresar el numero de tarjeta.', classes: 'rounded red'}); 
            return;
        }
        if(beneficiarioCta=="")
        {
            M.toast({html: 'Favor de ingresar el beneficiario de la cuenta.', classes: 'rounded red'}); 
            return;
        }
        if(nombreBanco=="")
        {
            M.toast({html: 'Favor de ingresar el nombre del banco.', classes: 'rounded red'}); 
            return;
        }
        if(monto_solicitado=="")
        {
            M.toast({html: 'Favor de ingresar el monto a solicitar.', classes: 'rounded red'}); 
            return;
        }
        if(quincenas=="")
        {
            M.toast({html: 'Favor de ingresar el numero de quincenas.', classes: 'rounded red'}); 
            return;
        }
        if(inicio_descuento=="")
        {
            M.toast({html: 'Favor de ingresar el inicio del descuento.', classes: 'rounded red'}); 
            return;
        }
        if(fin_descuento=="")
        {
            M.toast({html: 'Favor de ingresar el fin del descuento.', classes: 'rounded red'}); 
            return;
        }
        console.log("|Capturista:|"+capturistaId);
        console.log("|nombre_solicitante:|"+nombre_solicitante);
        console.log("|fecha_solicitud:|"+fecha_solicitud);
        console.log("|puesto_id:|"+puesto_id);
        console.log("|sucursal_id:|"+sucursal_id);
        console.log("|empresa_id:|"+empresa_id);
        console.log("|numTarjeta:|"+numTarjeta);
        console.log("|beneficiarioCta:|"+beneficiarioCta);
        console.log("|monto_solicitado:|"+monto_solicitado);
        console.log("|quincenas:|"+quincenas);
        console.log("|meses_pagar:|"+meses_pagar);
        console.log("|interes_prestamo:|"+interes_prestamo);
        console.log("|descuento:|"+descuento);
        console.log("|monto_total_pagar:|"+monto_total_pagar);
        console.log("|inicio_descuento:|"+inicio_descuento);
        console.log("|fin_descuento:|"+fin_descuento);
        console.log("|monto_letra:|"+monto_letra);
        

        prestamosp({ opcion : 1,capturista_id:capturistaId,fecha_solicitud:fecha_solicitud, puesto_id:puesto_id, sucursal_id: sucursal_id, empresa_id:empresa_id, numTarjeta:numTarjeta, beneficiarioCuenta:beneficiarioCta, nombreBanco:nombreBanco, monto_solicitado:monto_solicitado, quincenas:quincenas, meses_a_pagar: meses_pagar, interes_prestamo: interes_prestamo, tipo_abono:tipo_abono, descuento_mensual: descuento,monto_total:monto_total_pagar, inicio_descuento:inicio_descuento, fin_descuento:fin_descuento, monto_letra:monto_letra, porc_interes:porc_interes},respInsertarSolicutd);
        

    });

    
    $("#btnAutorizarPrestamo").click(function() {
        var id_prestamo = Cookies.get('p_idprestamo');
        var comentarios=$('#txtArea').val();
        var usuario_autorizador=Cookies.get('b_capturista_id');
        prestamosp({ opcion : 13,id_prestamo:id_prestamo},respBorrarCorrida );

        if($('#chAutorizar').is(":checked")) 
        {    
            var montoFinal= $('#montoAutorizar').val();
            prestamosp({ opcion : 7,id_prestamo:id_prestamo, coment:comentarios, capturista_autoriza:usuario_autorizador, montoAutorizado:montoFinal},respAutorizarPrestamo );
           
            prestamosp({ opcion : 6, sucursal:"0", estatus_id:"0", capturista_id:"0", fecha_ini:"0", fecha_fin:"0"}, respCargarSolicitudes);
        } 
        else
        {
            prestamosp({ opcion : 11,id_prestamo:id_prestamo, coment:comentarios, capturista_autoriza:usuario_autorizador},respNoAutorizarPrestamo );
            prestamosp({ opcion : 6, sucursal:"0", estatus_id:"0", capturista_id:"0", fecha_ini:"0", fecha_fin:"0"}, respCargarSolicitudes); 
        }
    }); 


    $( "#btnAbrirPoliticas" ).click(function() {
        // location.href="/RedSocialBancaprepa/img/politica.pdf";
        window.open('/img/politica.pdf', '_blank');
    }); 

    $( "#AceptarSubirResponsiva" ).click(function() {
        
        var ruta=$('#archivoResponsiva').val();
        var prestamo = Cookies.get('p_idprestamo');
        console.log("Aceptar"+" : "+ruta);
        prestamosp({ opcion : 16, id_prestamo:prestamo,ruta:ruta }, respSubirResponsiva);
    });
    
    $( "#btnBuscarSolicitudes" ).click(function() {
        var id_empleado = $('#IdEmpleadoSol').val();
        var sucursal = $('#sucursalesSolicitudes').val();
        var estatus_id = $('#estatusSolicitudes').val();
        var fecha_ini = $('#desdeSol').val();
        var fecha_fin = $('#hastaSol').val();

        if(id_empleado=="")
        {
            console.log("No hay nada");
            id_empleado="0";
        }

        if(fecha_ini=="")
        {
            console.log("No hay nada");
            fecha_ini="0";
        }
        if(fecha_fin=="")
        {
            console.log("No hay nada");
            fecha_fin="0";
        }

        console.log("ID_emplado= "+id_empleado+" sucursal= "+sucursal+ " estatus id= "+estatus_id+" fecha inicial= "+fecha_ini+" fecha final= "+fecha_fin);
        
        prestamosp({ opcion : 6, sucursal:sucursal, estatus_id:estatus_id, capturista_id:id_empleado, fecha_ini:fecha_ini, fecha_fin:fecha_fin}, respCargarSolicitudes);


    });

    $("#btnLimpiarSol").click(function() {
    
        $("#IdEmpleadoSol").val("");
        $("#nombreAbuscarSol").val("");
        $("#desdeSol").val("");
        $("#hastaSol").val("");
        prestamosp({ opcion : 18}, respCargarSucursales);
        prestamosp({ opcion : 19}, respCargarEstatusSolicitudes);
        
         
        M.toast({html: 'Filtros reestablecidos!', classes: 'rounded green'});  
        return;
    });
    $("#btnExcelSol").click(function() {

        console.log("presionado excel");
        //descargarExcel();
        fnExcelReportSolicitudes();
    });

    $( "#btnEliminarResp" ).click(function() {
        var prestamo = Cookies.get('p_idprestamo');
        console.log("Id prestamo para eliminar: "+prestamo);
        prestamosp({ opcion : 20, id_prestamo:prestamo}, respEliminarResponsiva);
    });
    $( "#buscarPagosXfecha" ).click(function() {
        var fecha = $("#fechaPago").val();
        console.log("Presionaste boton para buscar "+fecha);
        prestamosp({ opcion : 21, fecha:fecha}, respCargarPagosPorFecha);
    });
    $( "#btnExcelReporte" ).click(function() {
       
        console.log("Presionaste boton Excel");
       
        fnExcelReportesPrestamos();
    });

    $( "#btnBuscarXSuc" ).click(function() {
        var suc=$("#sucursalesSolicitudes").val();

        if (suc>0)
        {
            prestamosp({ opcion : 23, sucursal_id:suc}, respCargarReporte);
        }
        else
        {
            prestamosp({ opcion : 23, sucursal_id:"0"}, respCargarReporte); 
        }
        
        
    });
    
    $( "#btnDispersarPrestamo" ).click(function() {
        console.log("DISPERSAR");
        var prestamo_id = Cookies.get('p_idprestamo');
        prestamosp({ opcion : 24, prestamo_id:prestamo_id}, respDispersado);
        
    });


    
});
    
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
   var respInsertarSolicutd = function(data) {
       if (!data && data == null)
       return;  

    
       var capturistaId = Cookies.get('b_capturista_id');

       M.toast({html: 'Solicitud creada, espere a que se contacten con usted para una respuesta!.', classes: 'rounded green'});
       prestamosp({ opcion : 2,capturista_id:capturistaId},respCargarSolicitudesPorCapturista );

       $('#nombre_solicitante').val("");
       $('#fecha_solicitud').val("");
       $('#tipo_abono').val("");
        
       $('#num_tarjeta').val("");
       $('#bnf_cta').val("");
       $('#nombre_banco').val("");
       $('#monto_solicitado').val("");
       $('#quincenas').val("");
       $('#meses_pagar').val("");
       $('#interes_prestamo').val("");
       $('#tipo_abono').val("");
       $('#descuento').val("");
       $('#monto_total_pagar').val("");
       $('#monto_letra').val("");
       $('#inicio_descuento').val("");
       $('#fin_descuento').val("");


   }

   var respCargarSolicitudesPorCapturista = function(data) { 
    
        if (!data && data == null) 
        return; 

        var d = '';
        var x = '';


        
        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].capturista);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin prestamos solicitados</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaSolicitudPrestamo").html(d);
                
            }
            else
            {
                if(data[i].id_estatus==4)
                {
                    var link = String(data[i].link)
                    if(link == "null")
                    {
                        d+= '<tr>'+
                        '<td>'+data[i].id+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>$-</td>'+ 
                        '<td>$'+data[i].monto_pagar+'</td>'+ 
                        '<td>$'+data[i].descuento_mensual+'</td>'+ 
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td>-</td>'+ 
                        '<td>Falta subir la responsiva</td>'+ 
                        '<td class="left">'+
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        '<a onClick="imprimirCartaResponsiva('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger"><i class="material-icons">local_printshop</i></a>' + 
                        '<a onClick="subirResponsiva('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small red btn modal-trigger" href="#modalSubirResponsiva"><i class="material-icons">backup</i></a>' + 
                        '</td>' +
                        '</tr> ';
                    }
                    else
                    {
                        d+= '<tr>'+
                        '<td>'+data[i].id+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>$-</td>'+ 
                        '<td>$'+data[i].monto_pagar+'</td>'+ 
                        '<td>$'+data[i].descuento_mensual+'</td>'+ 
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td>-</td>'+ 
                        '<td>-</td>'+ 
                        '<td class="left">'+
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        '<a onClick="imprimirCartaResponsiva('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small indigo darken-4 btn modal-trigger"><i class="material-icons">local_printshop</i></a>' + 
                        '<a onClick="subirResponsiva('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small red btn modal-trigger" href="#modalSubirResponsiva"><i class="material-icons">backup</i></a>' + 
                        '</td>' +
                        '</tr> ';
                    }
                   
                }
                else
                {
                    if(data[i].id_estatus==5)
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
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>'+data[i].monto_autorizado+'</td>'+ 
                        '<td>$'+data[i].monto_pagar+'</td>'+ 
                        '<td>$'+data[i].descuento_mensual+'</td>'+ 
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td>'+data[i].fecha_autorizado+'</td>'+ 
                        '<td class="left">'+
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        '<a class="waves-effect waves-light btn-floating btn-small green btn modal-trigger"><i class="material-icons">check</i></a>' + 
                        '</td>' +
                        '</tr> ';
                        M.toast({html: 'Ya tiene un prestamo activo no puede tener mas de un prestamo activo!.', classes: 'rounded red'});
                        $("#num_tarjeta").attr('disabled','disabled');
                        $("#bnf_cta").attr('disabled','disabled');
                        $("#nombre_banco").attr('disabled','disabled');
                        $("#monto_solicitado").attr('disabled','disabled');
                        $("#quincenas").attr('disabled','disabled');
                        $("#meses_pagar").attr('disabled','disabled');
                        $("#interes_prestamo").attr('disabled','disabled');
                        $("#tipo_abono").attr('disabled','disabled');
                        $("#descuento").attr('disabled','disabled');
                        $("#monto_total_pagar").attr('disabled','disabled');
                        $("#monto_letra").attr('disabled','disabled');
                        $("#fin_descuento").attr('disabled','disabled');
                        $("#inicio_descuento").attr('disabled','disabled');
                        $("#btnCrearSolicitud").attr('disabled','disabled');
                       
                        

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
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>'+data[i].monto_autorizado+'</td>'+ 
                        '<td>$'+data[i].monto_pagar+'</td>'+ 
                        '<td>$'+data[i].descuento_mensual+'</td>'+ 
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td>'+data[i].fecha_autorizado+'</td>'+ 
                        
                        '<td class="left">'+
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        '<a class="waves-effect waves-light btn-floating btn-small red btn modal-trigger"><i class="material-icons">close</i></a>' + 
                        '</td>' +
                        '</tr> ';
                    }
                    
                }
                

               
                $("#tablaSolicitudPrestamo").html(d);
                $('.tooltipped').tooltip();
            }
        }
        
       

        cargarMenuPorRol();
    }

    var respCargarSolicitudes = function(data) { 
    
        if (!data && data == null) 
        return; 


        console.log(data);
        var d = '';
        var x = '';
        var d2 = '';

        

        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].capturista);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin prestamos solicitados</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaSolicitudes").html(d);

               
            }
            else
            {

                console.log("-------"+data[i].id_estatus);
                if(data[i].id_estatus==5)
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
                    '<td>'+data[i].sucursalNombre+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+
                    '<td>'+data[i].fecha_solicitud+'</td>'+ 
                    '<td>$'+data[i].monto_solicitado+'</td>'+ 
                    '<td>'+data[i].quincenas+'</td>'+  
                    '<td>$'+data[i].monto_autorizado+'</td>'+ 
                    '<td>$'+data[i].descuento_mensual+'</td>'+
                    '<td>'+data[i].estatus+'</td>'+ 
                    '<td class="left">'+
                    '<a onClick="autorizarPrestamos('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small teal lighten-1 btn modal-trigger" href="#modalAutorizarPrestamos" disabled><i class="material-icons">thumbs_up_down</i></a>' + 
                    '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                    '<a onClick="autorizarPrestamos('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small orange btn modal-trigger" href="#modalAutorizarPrestamos"><i class="material-icons">edit</i></a>' + 
                    '<a onClick="imprimirCarta('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small blue" ><i class="material-icons">local_printshop</i></a>' + 
                    '<a onClick="dispersarPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small  green darken-2 btn modal-trigger" href="#modalConfirmarDispersion"><i class="material-icons">attach_money</i></a>' + 
                    '</td>'+
                    '</tr> ';
                    //------------------------------------------Para excel-----------------------------------------------------
                    d2+='<tr>'+
                    '<td>'+data[i].sucursalNombre+'</td>'+
                    '<td>'+data[i].id_capturista+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+ 
                    '<td>$'+data[i].monto_autorizado+'</td>'+ 
                    '<td>'+data[i].quincenas+'</td>'+
                    '<td>$'+data[i].descuento_mensual+'</td>'+
                    '<td>'+"'"+data[i].numTarjeta+"'"+'</td>'+  
                    '<td>'+data[i].nombreBanco+'</td>'+ 
                    '<td>'+data[i].beneficiarioCuenta+'</td>'+
                    '<td>'+data[i].estatus+'</td> </tr>';
                    
                }
                else
                {
                    if(data[i].id_estatus==4)
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
                        '<td>'+data[i].sucursalNombre+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+  
                        '<td>$-</td>'+ 
                        '<td>-</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="left">'+
                        '<a onClick="autorizarPrestamos('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small teal lighten-1 btn modal-trigger" href="#modalAutorizarPrestamos"><i class="material-icons">thumbs_up_down</i></a>' + 
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small grey btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        '</td>'+
                        '</tr> ';
                        d2+='<tr>'+
                        '<td>'+data[i].sucursalNombre+'</td>'+
                        '<td>'+data[i].id_capturista+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+ 
                        '<td>$'+data[i].monto_autorizado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>$'+data[i].descuento_mensual+'</td>'+
                        '<td>'+"'"+data[i].numTarjeta+"'"+'</td>'+  
                        '<td>'+data[i].nombreBanco+'</td>'+ 
                        '<td>'+data[i].beneficiarioCuenta+'</td>'+
                        '<td>'+data[i].estatus+'</td> </tr>';
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
                        '<td>'+data[i].sucursalNombre+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+
                        '<td>'+data[i].fecha_solicitud+'</td>'+ 
                        '<td>$'+data[i].monto_solicitado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+  
                        '<td>$-</td>'+ 
                        '<td>$-</td>'+
                        '<td>'+data[i].estatus+'</td>'+ 
                        '<td class="left">'+
                        '<a onClick="autorizarPrestamos('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small teal lighten-1 btn modal-trigger" href="#modalAutorizarPrestamos" disabled><i class="material-icons">thumbs_up_down</i></a>' + 
                        '<a onClick="informacionPrestamo('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small teal darken-3 btn modal-trigger" href="#modalinfoPrestamo"><i class="material-icons">comment</i></a>' + 
                        //'<a onClick="autorizarPrestamos('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small orange btn modal-trigger" href="#modalAutorizarPrestamos"><i class="material-icons">edit</i></a>' + 
                        //'<a onClick="imprimirCarta('+data[i].id+');" class="waves-effect waves-light btn-floating btn-small blue btn modal-trigger" ><i class="material-icons">local_printshop</i></a>' + 
                        '</td>'+
                        '</tr> ';
                        d2+='<tr>'+
                        '<td>'+data[i].sucursalNombre+'</td>'+
                        '<td>'+data[i].id_capturista+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+ 
                        '<td>$'+data[i].monto_autorizado+'</td>'+ 
                        '<td>'+data[i].quincenas+'</td>'+
                        '<td>$'+data[i].descuento_mensual+'</td>'+
                        '<td>'+"'"+data[i].numTarjeta+"'"+'</td>'+  
                        '<td>'+data[i].nombreBanco+'</td>'+ 
                        '<td>'+data[i].beneficiarioCuenta+'</td>'+
                        '<td>'+data[i].estatus+'</td> </tr>';
                    }
                   
                }
                

                $("#tablaSolicitudes").html(d);
                $("#tablaSolicitudesExcel").html(d2);
            }
        }
        
       

        cargarMenuPorRol();
    }

    

    

    var respFinalInsertarCorrida = function(data) {
        if (!data && data == null)
        return;  

       
        var fecha_autorizadoRE = Cookies.get('fecha_autorizado_Re');
        var quincenasRE = Cookies.get('quincenas_Re');
        prestamosp({ opcion : 5, fecha:fecha_autorizadoRE, quincenas:quincenasRE},respReAjustarFechaInicioYFinal);

      
  
        
    }
    
    var respCargarFechaInicioYFinal = function(data) {
        if (!data && data == null)
        return;  

        console.log(data);
        var fechaInicio= data[0].inicio;
        var fechaFinal = data[0].fechafinal;

        console.log("Fecha inicio: "+fechaInicio+" Fecha final: "+fechaFinal);
        
        //Se transforma la fecha para poder insertarla en el input del html
        var f=new Date(fechaInicio);
        var mes = f.getMonth()+1; //obteniendo mes
        var dia = f.getDate()+1; //obteniendo dia
        var ano = f.getFullYear(); //obteniendo año
        if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('inicio_descuento').value=ano+"-"+mes+"-"+dia;

        var f2=new Date(fechaFinal);
        var mesF = f2.getMonth()+1; //obteniendo mes
        var diaF = f2.getDate()+1; //obteniendo dia
        var anoF = f2.getFullYear(); //obteniendo año
        if(diaF<10)
            diaF='0'+diaF; //agrega cero si el menor de 10
        if(mesF<10)
            mesF='0'+mesF //agrega cero si el menor de 10
        document.getElementById('fin_descuento').value=anoF+"-"+mesF+"-"+diaF;

    }

    var respReAjustarFechaInicioYFinal = function(data) {
        if (!data && data == null)
        return;  

        console.log(data);
        var fechaInicio= data[0].inicio;
        var fechaFinal = data[0].fechafinal;
        var id_solicitudRE = Cookies.get('p_idprestamo');
        console.log("Fecha inicio: "+fechaInicio+" Fecha final: "+fechaFinal);
        
        //Se transforma la fecha para poder insertarla en el input del html
        var f=new Date(fechaInicio);
        var mes = f.getMonth()+1; //obteniendo mes
        var dia = f.getDate()+1; //obteniendo dia
        var ano = f.getFullYear(); //obteniendo año
        if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
        var fecha_inicio =  ano+"-"+mes+"-"+dia ;

        var f2=new Date(fechaFinal);
        var mesF = f2.getMonth()+1; //obteniendo mes
        var diaF = f2.getDate()+1; //obteniendo dia
        var anoF = f2.getFullYear(); //obteniendo año
        if(diaF<10)
            diaF='0'+diaF; //agrega cero si el menor de 10
        if(mesF<10)
            mesF='0'+mesF //agrega cero si el menor de 10
        var fecha_fin = anoF+"-"+mesF+"-"+diaF ;


        console.log("FECHAS== "+ fecha_inicio+" FECHA fin="+fecha_fin);
        prestamosp({ opcion : 10, fecha_ini:fecha_inicio, fecha_fin:fecha_fin, solicitud_id:id_solicitudRE},respReajusteFecha2 );

        
    }

    
    var respReajusteFecha2 = function(data) {
        if (!data && data == null)
        return;         
        $("#modalAutorizarPrestamos").modal("close"); 
        M.toast({html: 'Solicitud actualizada!.', classes: 'rounded green'}); 
        prestamosp({ opcion : 6, sucursal:"0", estatus_id:"0", capturista_id:"0", fecha_ini:"0", fecha_fin:"0"}, respCargarSolicitudes);
        
       
    }
    
    var respAutorizarPrestamo = function(data) {
        if (!data && data == null)
        return;  


       var id_prestamo = Cookies.get('p_idprestamo');
       M.toast({html: 'Prestamo Autorizado!.', classes: 'rounded green'});
       console.log("ID DEL PRESTAMO ANTES DE REAJUSTAR LA SOLICiTuD="+id_prestamo);
       prestamosp({ opcion : 8,id_solicitud:id_prestamo},respReajustarSolicitud ); 
       
       console.log(data);
      
        
    }

    var respNoAutorizarPrestamo = function(data) {
        if (!data && data == null)
        return;  


       M.toast({html: 'Prestamo NO Autorizado!.', classes: 'rounded red'}); 
       $("#modalAutorizarPrestamos").modal("close");
       console.log(data);
      
    }

    var respReajustarSolicitud = function(data) {
        if (!data && data == null)
        return;

        var fecha_primerCorrida=$("#inicio_pago").val();
        console.log("FECHA= "+fecha_primerCorrida);
        if(fecha_primerCorrida==" ")
        {
            M.toast({html: 'Ingrese la fecha del primer pago porfavor.', classes: 'rounded red'}); 
            return;
        }

        var f = new Date(fecha_primerCorrida);

        console.log("1|monto autorizado:|"+$("#montoAutorizar").val());
        console.log("1|quincenas:|"+data[0].quincenas);
        console.log("FECHA= "+fecha_primerCorrida);
        

        
        var id_solicitudRE=data[0].id;
       
        var quincenasRE=data[0].quincenas;
    
        var mesesApagarRE=quincenasRE/2;
        var montoAutorizadoFRE=parseInt($("#montoAutorizar").val());
        var interesRE = parseInt((montoAutorizadoFRE*0.03)*mesesApagarRE);
        var total_pagarRE=parseInt(interesRE+montoAutorizadoFRE);
        var descuentoRE=(total_pagarRE/quincenasRE).toFixed(2);
        var totalConLetraRE = NumeroALetras(total_pagarRE);
        var fecha_autorizadoRE =  f.getFullYear()+ "-" + (f.getMonth() +1) + "-" +f.getDate() ;

        console.log("|monto autorizado:|"+montoAutorizadoFRE);
        console.log("|quincenas:|"+quincenasRE);
        console.log("|meses_pagar:|"+mesesApagarRE);
        console.log("|interes_prestamo:|"+interesRE);
        console.log("|descuento:|"+descuentoRE);
        console.log("|monto_total_pagar:|"+total_pagarRE);
        console.log("|monto_letra:|"+totalConLetraRE);
        console.log("|fecha autorizado:|"+fecha_autorizadoRE);

        Cookies.set("fecha_autorizado_Re",fecha_autorizadoRE);
        Cookies.set("quincenas_Re",quincenasRE);
        Cookies.set("descuento_Re",descuentoRE);
        Cookies.set("total_pagar_re",total_pagarRE);



        
        prestamosp({ opcion : 9, id_solicitud:id_solicitudRE, interes_prestamo:interesRE, descuento_mensual:descuentoRE, monto_total:total_pagarRE,monto_letra:totalConLetraRE},respAjusteRealizado);
        
       
        
    }

    var respAjusteRealizado = function(data) {
       
        
        var id_solicitudRE = Cookies.get('p_idprestamo');
        var fecha_autorizadoRE = Cookies.get('fecha_autorizado_Re');
        var quincenasRE = Cookies.get('quincenas_Re');
        var descuentoRE = Cookies.get('descuento_Re');
        var total_pagarRE = Cookies.get('total_pagar_re');

        prestamosp({ opcion : 3,prestamoId:id_solicitudRE, fecha:fecha_autorizadoRE, quincenas:quincenasRE, abono:descuentoRE, total:total_pagarRE},respFinalInsertarCorrida );
    }

    
    var respInfoSolicitudes = function(data) {
        if (!data && data == null)
        return;
        
        console.log(data[0].estatus_id);
        if(data[0].estatus_id==5)
        {
            console.log("activo");
            document.getElementById('texto_monto_autorizado').style.display = 'block';
            document.getElementById('textoMontoAInfo').style.display = 'block';
            $("#textoAreaInfo").val(data[0].comentarios);
            $("#textoMontoAInfo").val(data[0].monto_autorizado);
        }
        else
        {
            document.getElementById('texto_monto_autorizado').style.display = 'none';
            document.getElementById('textoMontoAInfo').style.display = 'none';
            $("#textoAreaInfo").val(data[0].comentarios);
        }
 
    }

    var respCargarCorridaXID = function(data) { 
    
        if (!data && data == null) 
        return; 


        console.log(data);
        var d = '';
        var x = '';

        

        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].abonado);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin corrida realizada</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaCorrida").html(d);
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
                '<td>'+data[i].num_pago+'</td>'+
                '<td>$'+data[i].cantidad+'</td>'+
                '<td>'+data[i].fecha+'</td>'+ 
                '<td>'+data[i].abonado+'</td>'+ 
                '</tr> ';
                

                $("#tablaCorrida").html(d);
            }
        }       
    }

    
    var respBorrarCorrida = function(data) { 
    
        if (!data && data == null) 
        return;        
    }

    var respImprimirResponsivaPP= function(data) { 
    
        if (!data && data == null) 
        return; 

        var fecha=data[0].fechaR;
        var capturista = data[0].nombre_capturista;
        var monto_autorizado=data[0].monto_autorizado;
        var id=data[0].id_solicitud;
        var fin_descuento=data[0].fin_descuento;
        
        console.log(fecha);
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
       
        //document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
        //var mesL="";
       
/*
        switch(mes) {
                case 1:
                  mesL="Enero"
                break;
                case 2:
                  mesL="Febrero"
                break;
                case 3:
                  mesL="Marzo"
                break;
                case 4:
                  mesL="Abril"
                break;
                case 5:
                  mesL="Mayo"
                break;
                case 6:
                  mesL="Junio"
                break;
                case 7:
                  mesL="Julio"
                break;
                case 8:
                  mesL="Agosto"
                break;
                case 9:
                  mesL="Septiembre"
                break;
                case 10:
                  mesL="Octubre"
                break;
                case 11:
                  mesL="Noviembre"
                break;
                case 12:
                  mesL="Diciembre"
                break;
              }
        */
         var fechaCompleta="";
         //fechaCompleta=f.getDate() + " de " + meses[f.getMonth()+1] + " de " + f.getFullYear();
         
         var f2=new Date();
         fechaCompleta=f2.getDate() + " de " + meses[f2.getMonth()] + " de " + f2.getFullYear();
         console.log("FECHA COMPLETA: "+fechaCompleta);

         //---------------------------------------------------------------------------------------------------------------
         // FECHA FINAL
         var mesL2="";
        var f2=new Date(fin_descuento);
        var mes2 = f2.getMonth()+1; //obteniendo mes
        var dia2 = f2.getDate()+1; //obteniendo dia
        var ano2 = f2.getFullYear(); //obteniendo año
        if(dia2<10)
            dia2='0'+dia2; //agrega cero si el menor de 10        

        switch(mes2) {
                case 1:
                  mesL2="Enero"
                break;
                case 2:
                  mesL2="Febrero"
                break;
                case 3:
                  mesL2="Marzo"
                break;
                case 4:
                  mesL2="Abril"
                break;
                case 5:
                  mesL2="Mayo"
                break;
                case 6:
                  mesL2="Junio"
                break;
                case 7:
                  mesL2="Julio"
                break;
                case 8:
                  mesL2="Agosto"
                break;
                case 9:
                  mesL2="Septiembre"
                break;
                case 10:
                  mesL2="Octubre"
                break;
                case 11:
                  mesL2="Noviembre"
                break;
                case 12:
                  mesL2="Diciembre"
                break;
              }

         var final_completa="";
         final_completa=dia2+" de "+mesL2+" de "+ano2;
         console.log("FECHA Final COMPLETA: "+final_completa);
         
         var a = document.createElement('a');
         a.href="../reportes/responsivaPp.php?fecha="+fechaCompleta+"&nombre="+capturista+"&monto="+monto_autorizado+"&id_solicitud="+id+"&final_completa="+final_completa;
         a.target="_blanck";
         document.body.appendChild(a);
         a.click();      
         
    }

    var respCargarResponsiva= function(data) { 
    
        if (!data && data == null) 
        return; 

        var responsiva =data[0].archivo_responsiva;
        var responsivapp = String(responsiva);
        var SolicitudCargada = "";
        console.log("Link responsiva: "+ responsivapp);
        var ultimas3Letras=responsivapp.substr( responsivapp.length-3, responsivapp.length-3);
        console.log("ULTIMAS 3 Letras= "+ultimas3Letras);

        if(responsivapp=="null")
        {
            console.log("Es null");
            $("#classbtnSubirResponsiva").removeClass('grey');
            $("#btnSubirResponsiva").removeAttr("disabled");
            $("#AceptarSubirResponsiva").removeAttr("disabled");
            $("#btnEliminarResp").attr('disabled', "disabled");
            document.getElementById('cargarArchivoSolicitud').style.display = 'none';
        }
        else
        {
            console.log("No es null");
            $("#classbtnSubirResponsiva").addClass('grey');
            $("#btnSubirResponsiva").attr('disabled','disabled');
            $("#AceptarSubirResponsiva").attr('disabled','disabled');
            $("#btnEliminarResp").attr('disabled', false);
            M.toast({html: 'Ya cuenta con archivo cargado!.', classes: 'rounded green'}); 
            document.getElementById('cargarArchivoSolicitud').style.display = 'block';
            if(ultimas3Letras=="jpg" || ultimas3Letras=="png")
            {
                SolicitudCargada+= '<div class="col s12 l8 offset-l2" > '+
                '<img class="materialboxed" width="650" src="imagenes/'+responsivapp+'">'+
                '</div> ';     
            }
            else
            {
                SolicitudCargada+= '<div class="col s12 l8 offset-l2" > '+
                '<iframe src="imagenes/'+responsivapp+'"  class="col s12" style="border: none;height:500px"></iframe>'+
                '</div> '; 

            }
           
            $("#cargarArchivoSolicitud").html(SolicitudCargada);
        }
        
    }

    
    var respSubirResponsiva= function(data) { 
    
        if (!data && data == null) 
        return; 

        $( "#formFiles2" ).submit();
        $("#modalSubirResponsiva").modal("close");
        $("#archivoResponsiva").val("");
    }

    var respCargarImagenSubida= function(data) { 
    
        if (!data && data == null) 
        return; 

        var responsiva =data[0].archivo_responsiva;
        var responsivapp = String(responsiva);
        var SolicitudCargada = "";
        console.log("Link responsiva: "+ responsivapp);
        var ultimas3Letras=responsivapp.substr( responsivapp.length-3, responsivapp.length-3);
        console.log("ULTIMAS 3 Letras= "+ultimas3Letras);

        if(responsivapp=="null")
        {
            document.getElementById('cargarArchivoSolicitud').style.display = 'none';
            
        }
        else
        {
            document.getElementById('cargarArchivoSolicitud').style.display = 'block';
            if(ultimas3Letras=="jpg" || ultimas3Letras=="png")
            {
                SolicitudCargada+= '<div class="col s12 l8 offset-l2" > '+
                '<img class="materialboxed" width="650" src="imagenes/'+responsivapp+'">'+
                '</div> ';     
            }
            else
            {
                SolicitudCargada+= '<div class="col s12 l8 offset-l2" > '+
                '<iframe src="imagenes/'+responsivapp+'"  class="col s12" style="border: none;height:500px"></iframe>'+
                '</div> '; 

            }
             
           

            $("#cargarArchivoSolicitud").html(SolicitudCargada);
        }
    }
    
    var respCargarSolicitudParaAceptar= function(data) { 
    
        if (!data && data == null) 
        return; 

        var monto= data[0].monto_solicitado;
        $("#montoAutorizar").val(monto);
    }

    

    var respCargarInfoPrestamo= function(data) { 
    
        if (!data && data == null) 
        return; 

        var estatus = data[0].id_estatus;
        var coment = data[0].comentario;
        
        if(estatus==5)
        {
            $("#chAutorizar").prop("checked", true);
            $("#txtArea").val(coment);
            document.getElementById('montoAutorizar').style.display = 'block';
            //document.getElementById('parrafoMonto').style.display = 'block';
            M.toast({html: 'Solicitud ya autorizada.', classes: 'rounded green'});
        }
        else
        {
            $("#chAutorizar").prop("checked", false);
        }        
    }


    var respImprimirSolicitudPrestamo= function(data) { 
    
        if (!data && data == null) 
        return; 

        var fecha=data[0].fecha;
        var capturista = data[0].nombre_capturista;
        var monto_autorizado=data[0].monto_autorizado;
        var ruta=data[0].ruta;
        
         var a = document.createElement('a');
         a.href="/prestamospersonales/imagenes/"+ruta;
         a.target="_blanck";
         document.body.appendChild(a);
         a.click();        
    }

    
    var respCargarSucursales= function(data) { 
    
        
        if (!data && data == null)
        return;  

        var documento='<option value="0"  selected>Seleccione Sucursal</option>';

        for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].nomComercial+'</option>';
        }
        

        $('#sucursalesSolicitudes').html(documento);
        $('#sucursalesSolicitudes').formSelect(); 
    }
    

    var respCargarEstatusSolicitudes= function(data) { 
    
        
        if (!data && data == null)
        return;  

        var documento='<option value="0"  selected>Seleccione estatus</option>';

        for(var i=0; i<data.length; i++){
        documento+='<option value='+data[i].id+'>'+data[i].descripcion+'</option>';
        }
        

        $('#estatusSolicitudes').html(documento);
        $('#estatusSolicitudes').formSelect(); 
    }

    var respBuscarEmpleadosSolicitudes = function(data) { 
    
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
        $("#nombreAbuscarSol").val(nombre);
        console.log("NOMBRE A DIV="+nombre+" Y ID= "+ $("#IdEmpleadoSol").val() );

        
    }
    
    var respEliminarResponsiva = function(data) { 
    
        if (!data && data == null)
        {
            M.toast({html: 'No se encontraron coincidencias.', classes: 'rounded red'}); 
            return;
        }
    
        M.toast({html: 'Responsiva eliminada.', classes: 'rounded green'}); 

        $("#modalSubirResponsiva").modal("close");

        cargarCreacionSolicitud();
    }
    
    var respCargarPagosPorFecha = function(data) { 
        if (!data && data == null) 
        return; 


        console.log(data);
        var d = '';
        var x = '';

        

        for (var i = 0; i < data.length; i++) 
        {
            var nombre=String(data[i].capturista);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
                $("#selectall").attr('disabled', "disabled");
               d+= '<tr>'+
               '<td>Sin pagos pendientes para la fecha seleccionada</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaPagos").html(d);
            }
            else
            {
                $("#selectall").removeAttr("disabled");
                if(data[i].abonado=="SI")
                {
                    d+= '<tr>'+
                    '<td>'+data[i].id_capturista+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+
                    '<td>'+data[i].prestamo_id+'</td>'+ 
                    '<td>'+data[i].num_pago+'</td>'+ 
                    '<td>'+data[i].fecha_de_pago+'</td>'+ 
                    '<td>Abonado</td>'+ 
                    '<td>$'+data[i].abono+'</td>'+ 
                    '<td>Abonado</td>'+ 
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
                    '<td>'+data[i].id_capturista+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+
                    '<td>'+data[i].prestamo_id+'</td>'+ 
                    '<td>'+data[i].num_pago+'</td>'+ 
                    '<td>'+data[i].fecha_de_pago+'</td>'+ 
                    '<td>'+data[i].actual_atrasado+'</td>'+ 
                    '<td>$'+data[i].abono+'</td>'+ 
                    '<td>'+
                    '<label>'+
                    '  <input name="checks[]" type="checkbox" class="selectall" value="'+data[i].id_num_pago+'"/>'+
                    '  <span></span>'+
                    '</label>'+
                    '</td>'+ 
                    '</tr> ';
                }
                
                

                $("#tablaPagos").html(d);
            }
            
        }               
    }
    
    var respPagoReflejado = function(data) { 
        if (!data && data == null) 
        return; 

        M.toast({html: 'Pagos realizados', classes: 'rounded green'}); 
        console.log("HECHO");

        location.reload();
          
    }
    
    var respCargarReporte = function(data) { 
        
        if (!data && data == null) 
        return; 


        console.log(data);
        var d = '';
        var x = '';

        

        for (var i = 0; i < data.length; i++) 
        {
            var suma = data[i].numde_quincenasPag * data[i].descuento_mensual;
            var cantidad_restante = data[i].monto_total-suma; 
            var estatus="";
            
            estatus=data[i].estatus;
            
            var nombre=String(data[i].capturista);
            console.log("-------"+nombre);
            if(nombre=="undefined")
            {
               d+= '<tr>'+
               '<td>Sin Datos</td>'+
               '<td class="left">'+ 
               '</tr> ';  
               $("#tablaReportesPp").html(d);
               
            }
            else
            {
                d+= '<tr>'+
                '<td>'+data[i].nombre_sucursal+'</td>'+
                '<td>'+data[i].id_capturista+'</td>'+
                '<td>'+data[i].capturista+'</td>'+ 
                '<td>'+data[i].fecha_ingreso+'</td>'+ 
                '<td>'+data[i].monto_autorizado+'</td>'+ 
                '<td>'+data[i].monto_total+'</td>'+ 
                '<td>'+data[i].inicio_descuento+'</td>'+ 
                '<td>'+data[i].fin_descuento+'</td>'+ 
                '<td>'+data[i].numde_quincenasPag+'</td>'+ 
                '<td>'+data[i].quincenas_totales+'</td>'+ 
                '<td>'+data[i].descuento_mensual+'</td>'+ 
                '<td>'+suma+'</td>'+ 
                '<td>'+cantidad_restante+'</td>'+ 
                '<td>'+estatus+'</td>'+ 
                '</tr> ';
            
                $("#tablaReportesPp").html(d);
            }
            
        }               
          
    }

    var respDispersado  = function(data) 
    {
        M.toast({html: 'Dispersión realizada', classes: 'rounded green'}); 
        setTimeout('recargarPag()',3000);
    } 
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// FUNCIONES ////////////////////////////////////////////////////////////////
    function recargarPag(){
        location.reload();
       }
    function CerrarYborrarDiv()
    {
        $("#nombreAbuscarCor").val("");
        document.getElementById('listaEmpleadosBC').style.display = 'none';
    }
    function agregarAdiv(id_empleado)
    {  
        
        document.getElementById('listaEmpleadosBC').style.display = 'none';
        $("#IdEmpleadoSol").val(id_empleado);
        var id=$("#IdEmpleadoSol").val();
        onRequest({ opcion : 87 ,empleado_id:id}, respAgregarNombreAdiv);
       


    }

    function cargarCreacionSolicitud()
    {
        var f=new Date();
        
        var nombre = Cookies.get('b_capturista');
        var puesto = Cookies.get('b_puesto');
        var sucursal = Cookies.get('b_sucursal');
        var empresa = Cookies.get('b_empresa');
        
        var mes = f.getMonth()+1; //obteniendo mes
        var dia = f.getDate(); //obteniendo dia
        var ano = f.getFullYear(); //obteniendo año
        if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_solicitud').value=ano+"-"+mes+"-"+dia;
       // var fecha="0"+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
        console.log(ano+"/"+mes+"/"+dia);
        $('#nombre_solicitante').val(nombre);
        $('#puesto_solicitud').val(puesto);
        $('#sucursal_solicitud').val(sucursal); 
        $('#empresa_solicitud').val(empresa); 
        $('#tipo_abono').val("QUINCENAL");

        var capturistaId = Cookies.get('b_capturista_id');
        prestamosp({ opcion : 2,capturista_id:capturistaId},respCargarSolicitudesPorCapturista );
        
    }

    
    function swAutorizar()
    {
       
        console.log("CAMBIO");
        if($('#chAutorizar').is(":checked")) 
        { 
            document.getElementById('montoAutorizar').style.display = 'block';
            document.getElementById('inicio_pago').style.display = 'block';
        } 
        else
        {
            document.getElementById('montoAutorizar').style.display = 'none';
            document.getElementById('inicio_pago').style.display = 'none';
        }
    }
    function cargarSolicitud()
    {
        
        //$_REQUEST['sucursal'],$_REQUEST['estatus_id'],$_REQUEST['capturista_id'],$_REQUEST['fecha_ini'],$_REQUEST['fecha_fin'] 
        prestamosp({ opcion : 6, sucursal:"0", estatus_id:"0", capturista_id:"0", fecha_ini:"0", fecha_fin:"0"}, respCargarSolicitudes);
        prestamosp({ opcion : 18}, respCargarSucursales);
        prestamosp({ opcion : 19}, respCargarEstatusSolicitudes);

        
    }
    
    function autorizarPrestamos(prestamoId)
    {
        console.log("Id prestamo: "+prestamoId); 
        Cookies.set("p_idprestamo",prestamoId);
        prestamosp({ opcion : 17, id_prestamo:prestamoId}, respCargarInfoPrestamo);
        prestamosp({ opcion : 8, id_solicitud:prestamoId}, respCargarSolicitudParaAceptar);
        prestamosp({ opcion : 15, id_prestamo:prestamoId}, respCargarImagenSubida);

    }

    function informacionPrestamo(prestamoId)
    {
        prestamosp({ opcion : 8, id_solicitud:prestamoId}, respInfoSolicitudes);
        prestamosp({ opcion : 12, id_prestamo:prestamoId}, respCargarCorridaXID);
    }

    function imprimirCartaResponsiva(prestamoId)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Prestamo ID:"+prestamoId);
        prestamosp({ opcion : 14, id_prestamo:prestamoId}, respImprimirResponsivaPP);

    }
    function subirResponsiva(prestamoId) {

        Cookies.set("p_idprestamo",prestamoId);

        var prestamo = Cookies.get('p_idprestamo');
        console.log("ID PRESTAMOS DESDE COOKIES: "+prestamo );
        prestamosp({ opcion : 15, id_prestamo:prestamoId}, respCargarResponsiva);

    }

    function imprimirCarta(prestamoId)
    {
        //Carga el equipo por su id para despues deshabilitarla
        console.log("Prestamo ID:"+prestamoId);
        prestamosp({ opcion : 17, id_prestamo:prestamoId}, respImprimirSolicitudPrestamo);
    }
    
    function beneficiarioCheck()
    {
        if($('#chBeneficiario').is(":checked")) 
        { 
            var nombreBene=$('#nombre_solicitante').val();
            $('#bnf_cta').val(nombreBene);
        } 
        else
        {
            $('#bnf_cta').val("");
        }
    }

    function buscaEmpleadosSolicitudesP()
    {
        var bus= $("#nombreAbuscarSol").val();
        if (bus.length>2)
        {
            document.getElementById('listaEmpleadosBC').style.display = 'block';
            document.getElementById('rowNombre').style.display = 'block';
            onRequest({ opcion : 84 ,nombre:bus}, respBuscarEmpleadosSolicitudes);
        }
        else
        {
            $('#IdEmpleadoSol').val(" ");
            document.getElementById('listaEmpleadosBC').style.display = 'none';
            document.getElementById('rowNombre').style.display = 'none';
        }
        console.log("Buscando texto:"+bus);
        
    }
    function fnExcelReportSolicitudes()
    {
        var tab_text="<table border='2px' charset=UTF-8><tr> "+
        "<th>Sucursal</th>"+
        "<th>Id Capturista</th>"+
        "<th>Nombre</th>"+
        "<th>Monto Autorizado</th>"+ 
        "<th>Quincenas</th>"+ 
        "<th>Descuento Mensual</th>"+ 
        "<th>Numero de cuenta</th>"+
        "<th>Banco</th>"+
        "<th>Beneficiario</th>"+
        "<th>Estatus</th>"+
        "</tr>";
        var textRange; var j=0;
        tab = document.getElementById('tablaSolicitudesExcel'); // id of table

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

    function fnExcelReportesPrestamos()
    {
        var tab_text="<table border='2px' charset=UTF-8><tr> "+
        "<th>Sucursal</th>"+
        "<th>Id del solicitante</th>"+
        "<th>Nombre del Solicitante</th>"+
        "<th>Fecha de ingreso</th>"+
        "<th>Monto Autorizado</th>"+
        "<th>Monto Total</th>"+
        "<th>Inicio descuento</th>"+
        "<th>Fin descuento</th>"+
        "<th>Quincenas Abonadas</th>"+
        "<th>Quincenas Totales</th>"+
        "<th>Descuento Mensual</th> "+
        "<th>Suma</th> "+
        "<th>Cantidad Restante</th>"+
        "<th>Estatus</th>"+
        "</tr>";
        var textRange; var j=0;
        tab = document.getElementById('tablaReportesPp'); // id of table

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

    function cargarReportePrestamo()
    {
        prestamosp({ opcion : 23, sucursal_id:"0"}, respCargarReporte);
        prestamosp({ opcion : 18}, respCargarSucursales);
        cargarMenuPorRol();
    }

    function dispersarPrestamo(id_prestamo)
    {
        console.log("YASTA id: "+id_prestamo);
        Cookies.set("p_idprestamo",id_prestamo);


    }

//-------------------------------------------------------Funcion para sacar numero en letra--------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------


        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }


        function Unidades(num){

        switch(num)
        {
            case 1: return "UN";
            case 2: return "DOS";
            case 3: return "TRES";
            case 4: return "CUATRO";
            case 5: return "CINCO";
            case 6: return "SEIS";
            case 7: return "SIETE";
            case 8: return "OCHO";
            case 9: return "NUEVE";
        }
    
        return "";
    }//Unidades()
    
    function Decenas(num){
    
        decena = Math.floor(num/10);
        unidad = num - (decena * 10);
    
        switch(decena)
        {
            case 1:
                switch(unidad)
                {
                    case 0: return "DIEZ";
                    case 1: return "ONCE";
                    case 2: return "DOCE";
                    case 3: return "TRECE";
                    case 4: return "CATORCE";
                    case 5: return "QUINCE";
                    default: return "DIECI" + Unidades(unidad);
                }
            case 2:
                switch(unidad)
                {
                    case 0: return "VEINTE";
                    default: return "VEINTI" + Unidades(unidad);
                }
            case 3: return DecenasY("TREINTA", unidad);
            case 4: return DecenasY("CUARENTA", unidad);
            case 5: return DecenasY("CINCUENTA", unidad);
            case 6: return DecenasY("SESENTA", unidad);
            case 7: return DecenasY("SETENTA", unidad);
            case 8: return DecenasY("OCHENTA", unidad);
            case 9: return DecenasY("NOVENTA", unidad);
            case 0: return Unidades(unidad);
        }
    }//Unidades()
    
    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
        return strSin + " Y " + Unidades(numUnidades)
    
        return strSin;
    }//DecenasY()
    
    function Centenas(num) 
    {
        centenas = Math.floor(num / 100);
        decenas = num - (centenas * 100);
    
        switch(centenas)
        {
            case 1:
                if (decenas > 0)
                    return "CIENTO " + Decenas(decenas);
                return "CIEN";
            case 2: return "DOSCIENTOS " + Decenas(decenas);
            case 3: return "TRESCIENTOS " + Decenas(decenas);
            case 4: return "CUATROCIENTOS " + Decenas(decenas);
            case 5: return "QUINIENTOS " + Decenas(decenas);
            case 6: return "SEISCIENTOS " + Decenas(decenas);
            case 7: return "SETECIENTOS " + Decenas(decenas);
            case 8: return "OCHOCIENTOS " + Decenas(decenas);
            case 9: return "NOVECIENTOS " + Decenas(decenas);
        }
    
        return Decenas(decenas);
    }//Centenas()
    
    function Seccion(num, divisor, strSingular, strPlural) {
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        letras = "";
    
        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + " " + strPlural;
            else
                letras = strSingular;
    
        if (resto > 0)
            letras += "";
    
        return letras;
    }//Seccion()
    
    function Miles(num) {
        divisor = 1000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        strMiles = Seccion(num, divisor, "UN MIL", "MIL");
        strCentenas = Centenas(resto);
    
        if(strMiles == "")
            return strCentenas;
    
        return strMiles + " " + strCentenas;
    }//Miles()
    
    function Millones(num) {
        divisor = 1000000;
        cientos = Math.floor(num / divisor)
        resto = num - (cientos * divisor)
    
        strMillones = Seccion(num, divisor, "UN MILLON DE", "MILLONES DE");
        strMiles = Miles(resto);
    
        if(strMillones == "")
            return strMiles;
    
        return strMillones + " " + strMiles;
    }//Millones()
    
    function NumeroALetras(num) {
        var data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: "",
            letrasMonedaPlural: 'PESOS',//"PESOS", 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: 'PESO', //"PESO", 'Dólar', 'Bolivar', 'etc'
    
            letrasMonedaCentavoPlural: "CENTAVOS",
            letrasMonedaCentavoSingular: "CENTAVO"
        };
    
        if (data.centavos > 0) {
            data.letrasCentavos = "CON " + (function (){
                if (data.centavos == 1)
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
                else
                    return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
                })();
        };
    
        if(data.enteros == 0)
            return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
        else
            return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
    }//NumeroALetras()

//--------------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------------------------------
