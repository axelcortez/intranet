
var arregloCorreos= [];
var arregloNotificaciones =[];
var arregloImagenes =[];
const b_empresa = Cookies.get('b_empresa_id');  
var elemsmodal = document.querySelectorAll('.modal');
var modals = M.Modal.init(elemsmodal, {
        dismissible:false
    }); 
 
// funcion general de loads esta inicializa al cargar el navegador, todas las funciones que esten dentro se ejecutaran al cargar el navegador
document.addEventListener('DOMContentLoaded', function() {
    var f = new Date();
    var mes="";
    if((f.getMonth() +1)<=9){
       mes=`0${(f.getMonth() +1)}`
    }else{
       mes=`${(f.getMonth() +1)}`
    }

    var fechaActual =  `${f.getFullYear()}-${mes}-${f.getDate()}`;

    document.getElementById('txtFechaInicial').value=fechaActual;
    document.getElementById('txtFechaFinal').value=fechaActual;

   

    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems, {});
     
    
    consultaAjax({ opcion : 1 },(datos)=>{  

        let opcionesSelect ="<option value='0'>Seleccione una Cuenta</option>";
        for (var i = 0; i < datos.length; ++i){
            opcionesSelect +=`<option value='${datos[i].cta}'>${datos[i].descripcion}</option>`;
        }
        document.getElementById('sltCta').innerHTML = opcionesSelect;
        var elemsselect = document.querySelectorAll('select');
        var select = M.FormSelect.init(elemsselect, {}); 
         

    },'gastos');  

    var tooltips = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(tooltips, {});
 
    consultaAjax({ opcion : 4 ,b_empresa },(sucursales)=>{
        let opcionesSelect ="<option value='0'>Seleccione una Sucursal</option>";
        for (var i = 0; i < sucursales.length; ++i){
            opcionesSelect +=`<option value='${sucursales[i].id}'>${sucursales[i].nomComercial}</option>`;
        }
        document.getElementById('sltSucursal').innerHTML = opcionesSelect;
        var elemsselect = document.querySelectorAll('select');
        var select = M.FormSelect.init(elemsselect, {}); 
    },'gastos'); 

    consultaAjax({ opcion : 5  },(correos)=>{  
        var objeto = {};
        
        for (var i = 0; i < correos.length; ++i){
            objeto[correos[i].id+'-'+correos[i].empleado]= ''; 
            arregloCorreos[correos[i].id] =[ correos[i].id ,correos[i].empleado,correos[i].correo];
        } 
        var optionsautocomplet = {
            data:objeto,
            onAutocomplete : function(texto){ 
                var id = texto.split('-', 1);
                var capturista_id = Cookies.get('b_capturista_id'); 
                id=id[0];  

                if(id==capturista_id){
                    mensajeAlerta('No puede agregarse usted mismo','warning')
                    return;
                }

                arregloNotificaciones.push(id);

                let notificaciones ="";
                for (var i = 0; i < arregloNotificaciones.length; ++i){   
                    notificaciones +=`<tr><td>${arregloCorreos[arregloNotificaciones[i]][0]} - ${arregloCorreos[arregloNotificaciones[i]][1]}</td><td>${arregloCorreos[arregloNotificaciones[i]][2]}</td><td><a class="btn-floating btn-small waves-effect waves-light red" onclick="eliminarNotificacion(${arregloCorreos[arregloNotificaciones[i]][0]})"><i class="material-icons">delete</i></a></td></tr>`;
                }
                document.getElementById('tbNotificacion').innerHTML =notificaciones;
        }         
        }   
        var autocomplete = document.querySelectorAll('.autocomplete');
        var instancesautocomplete = M.Autocomplete.init(autocomplete, optionsautocomplet);
    },'gastos'); 


    consultarSolicitudes();
 
    setInterval('cargarComentarios()', 3000); 
});

function guardarSolicitudDeGasto(){
    let cuenta_id = document.getElementById("sltCta").value;
    let subCuenta_id = document.getElementById("sltSct").value;
    let sucursal_id = document.getElementById("sltSct").value;
    let importe = document.getElementById("txtImporte").value;
    let concepto = document.getElementById("txtConcepto").value.toUpperCase();
    let aEvidencia = document.getElementById("archivoDeEvidencia").value;
    let aCotizacion = document.getElementById("archivoDeCotizacion").value;

    if(subCuenta_id<=0){
        mensajeAlerta('Es necesario seleccionar una tipo de Gasto.','error');
        return;
    }
    if(importe<=0){
        mensajeAlerta('El importe no es correcto.','error');
        return;
    }
    if(concepto.length<=1){
        mensajeAlerta('El concepto que intenta guardar no es valido no es valido.','error');
        return;
    } 
    if(sucursal_id<=0){
        mensajeAlerta('Es necesario espesificar una sucursal.','error');
        return;
    } 

    swal({
        title: "Deseas guardar la solicitud?", 
        icon: "warning",
        buttons: {
            cancel: true,
            confirm: true,
          }, 
      })
      .then((willDelete) => {
        if (willDelete) { 

                consultaAjax({ opcion : 3,cuenta_id,subCuenta_id,sucursal_id,importe,concepto,aEvidencia,aCotizacion,notificaciones:arregloNotificaciones},(respuesta)=>{

                    
                    switch(respuesta[0].estatus){
                        case 0:  
                                swal({
                                    title: "La solicitud se guardo correctamente", 
                                    icon: "success",
                                    buttons: {
                                        cancel: false,
                                        confirm: true,
                                      }, 
                                  }).then((aceptar)=>{
                                      if(aceptar){
                                        document.getElementById("btnCerrarModalGastos").click();
                                        document.getElementById("formFiles3").submit();
                                      } 
                                  });
                                
                            break;
                        case 1:
                                mensajeAlerta(`Ocurrio el siguiente error ${estatus[0].error}.`,'success');
                                break;
                    }
                },'gastos') 

        } else {
          swal({
            title: "EL movimiento fue cancelado!!", 
            icon: "success", 
            buttons: {
                cancel: false,
                confirm: true,
              }
          });
        }
      });
}
 
//------------funcion para buscar las subcuentas
function seleccionarCuenta(cta){

    consultaAjax({ opcion : 2,cta },(subCuentas)=>{ 
        let opcionesSelect ="<option value='0'>Seleccione una Gasto</option>";
        for (var i = 0; i < subCuentas.length; ++i){
            opcionesSelect +=`<option value='${subCuentas[i].id}'>${subCuentas[i].descripcion}</option>`;
        } 
        document.getElementById('sltSct').innerHTML = opcionesSelect;
        var elemsselect = document.getElementById('sltSct');
        M.FormSelect.init(elemsselect, {});
         
         
     },'gastos');
}

function eliminarNotificacion(id){  
    for(var i=0 ;i<arregloNotificaciones.length ; i++) {   
        if(arregloNotificaciones[i] == id) {   
            arregloNotificaciones.splice(i, 1);
        }
    }   
    let notificaciones ="";
    for (var i = 0; i < arregloNotificaciones.length; ++i){
        notificaciones +=`<tr><td>${arregloCorreos[arregloNotificaciones[i]][0]} - ${arregloCorreos[arregloNotificaciones[i]][1]}</td><td>${arregloCorreos[arregloNotificaciones[i]][2]}</td><td><a class="btn-floating btn-small waves-effect waves-light red" onclick="eliminarNotificacion(${arregloNotificaciones[i]})"><i class="material-icons">delete</i></a></td></tr>`;
    }  
    document.getElementById('tbNotificacion').innerHTML =notificaciones; 
}

function consultarSolicitudes(){
    var fecha_inicial=document.getElementById("txtFechaInicial").value;
    var fecha_final=document.getElementById("txtFechaFinal").value;

    consultaAjax({ opcion : 7,fecha_inicial,fecha_final },(datos)=>{  

        
        let solicitudes = ""
        var tamanioArreglo= datos.length -1;
        console.log(datos)
        for(var i = tamanioArreglo ; i>=0 ; i--){

            solicitudes +=`<tr>
                                <td class="center-align">${datos[i].id}</td>
                                <td class="center-align">${datos[i].fecha}</td>
                                <td class="center-align">${datos[i].cuenta}</td>
                                <td class="right-align">${datos[i].importe}</td>
                                <td class="center-align">${datos[i].estatus}</td>
                                <td class="center-align">
                                    <button onclick="verDocumentos(${datos[i].id})" class="buttonbancaprepa modal-trigger " href="#modalDocumentos"  ><i class="material-icons">attach_file</i></button>
                                    <button onclick="verNotificacionesGasto(${datos[i].id})" class="buttonbancaprepa modal-trigger" href="#modalNotificaciones"><i class="material-icons ">chat</i></button>
                                </td>
                            </tr>`

        }  

        document.getElementById('tableSolicitudes').innerHTML =solicitudes;
    },'gastos');
}

function verDocumentos(solicitud_id){
    consultaAjax({ opcion : 8,solicitud_id },(datos)=>{   
        let coleccion ="";
            for(var i=0;i<datos.length ; i++){
                arregloImagenes[datos[i].id] =[ datos[i].id ,datos[i].imagen];
                coleccion +=`<a href="#!" onclick="verImagen(${datos[i].id})" class="collection-item">Imagen : ${datos[i].imagen}</a> `;
            }
        document.getElementById('colecionImagenes').innerHTML =coleccion;   

    },'gastos');
}

function verImagen(imagen){ 
    document.getElementById('imgGasto').src=`/intranet/imagenes/gastos/${arregloImagenes[imagen][1]}`
}
function verNotificacionesGasto(solicitud_id){

    document.getElementById("txtSolicitudId").value=solicitud_id;
 
    consultaAjax({ opcion : 10,solicitud_id},(datos)=>{  
            var cajaChat ="";
          
            for(var i=0;i<datos.length;i++){
                
                if(datos[i].emisor=='S'){
                    cajaChat +=`<li class="collection-item avatar">
                                    <i class="material-icons circle black-text blue">arrow_forward</i>
                                    <b><span class="title black-text">${datos[i].capturista} : ${datos[i].fecha} ${datos[i].hora} </span></b> 
                                    <p>${datos[i].comentario} 
                                    </p> 
                                </li> `

                }else{
                    cajaChat +=`<li class="collection-item avatar ">  
                                    <i class="material-icons circle black-text yellow">arrow_back</i>
                                    <b><span class="title black-text">${datos[i].capturista} : ${datos[i].fecha} ${datos[i].hora} </span></b> 
                                    <p>${datos[i].comentario} 
                                    </p> 
                                 </li> `;
                } 
            }

            document.getElementById("cajaComentariosSolicitud").innerHTML=cajaChat;
            document.getElementById('autoScroll').scroll(0, 1500);
    },'gastos');
 
}

function guardarComentario(){
    var solicitud_id =document.getElementById("txtSolicitudId").value; 
    var comentario = document.getElementById("txtComentario").value.toUpperCase();

    if(comentario==''){
        mensajeAlerta('Es necesario ingresar un comentario!!','error');
        return
    }

    swal({
        title: "Deseas guardar el comentario?", 
        icon: "warning",
        buttons: {
            cancel: true,
            confirm: true,
          }, 
      })
      .then((willDelete) => {
        if (willDelete) { 
            consultaAjax({ opcion : 9,solicitud_id ,comentario},(datos)=>{    

                switch(datos[0].estatus){
                    case 0:
                            mensajeAlerta('Ocurrio un error al intentar ingresar el comentario, vuelva a intentarlo.!!','error');
                        break;
                    case 1:
                            mensajeAlerta('El comentario se ingreso correctamente!!','success');
                            verNotificacionesGasto(solicitud_id);
                            document.getElementById("txtComentario").value="";
                        break;
                }

            },'gastos');
        }else{
            mensajeAlerta('La operacion fue cancelada!!','success');
        }
      });

    
}

function cargarComentarios(){
    var solicitud_id =document.getElementById("txtSolicitudId").value; 

    if(solicitud_id>0){
        verNotificacionesGasto(solicitud_id);
    } 
    
    
}