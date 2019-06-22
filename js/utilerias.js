// funcion general de loads esta inicializa al cargar el navegador, todas las funciones que esten dentro se ejecutaran al cargar el navegador
document.addEventListener('DOMContentLoaded', function() {

    let rol_id = Cookies.get('b_rol_id'); 
    onRequest({ opcion : 22 ,id_rol:rol_id },respCargarMenu); 

    var elemsdropdown = document.querySelectorAll('.dropdown-trigger');
    var dropdown = M.Dropdown.init(elemsdropdown, {
        closeOnClick:true
    }); 

    var elemsnav = document.querySelectorAll('.sidenav');
    var sidenav = M.Sidenav.init(elemsnav, {});

    
 
   
});

//---------------Respuesta para cargar menus---------

var respCargarMenu  = function(data) { 
    if (!data && data == null)
        return;  
     
    var usuario = Cookies.get('b_id_sucursal');
    if(usuario<1){ 
        window.location = "login.html";
    } 


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
 function mensajeAlerta(titulo,tipo){
    swal({
      title: titulo, 
      icon: tipo, 
      buttons: {
          cancel: false,
          confirm: true,
        }
    });
 }

 function cerrarCession(){
      Cookies.remove('b_capturista_id');
      Cookies.remove('b_usuario');
      Cookies.remove('b_capturista');
      Cookies.remove('b_rol_id');
      Cookies.remove('b_empresa_id');
      Cookies.remove('b_puesto_id'); 
      location.href="/intranet/";
 }