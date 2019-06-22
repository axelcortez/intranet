$(document).ready(function(){
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// INICIALIZAR VARIABLES ////////////////////////////////////////////////////////////////
         $('.modal').modal();
         $('.materialboxed').materialbox();

         $("#btnCrearFondoAhorro").click(function() {
             
             var id = Cookies.get('b_capturista_id');
             console.log("Boton presionado!");
             console.log("ID capturistas= "+id);

             var a = document.createElement('a');
             a.href="reportes/cartaAdhesion.php?id_capturista="+id;
             a.target="_blanck";
             document.body.appendChild(a);
             a.click();     

        });

        $( "#AceptarSubirArchivo" ).click(function() {
        
            var ruta=$('#archivoArchivo').val();
            console.log("Aceptar"+" : "+ruta);
            if(ruta=== "")
            {
                M.toast({html: 'Agregue un archivo para subir', classes: 'rounded red'});  
            }
            else
            {
                var id_capturista = Cookies.get('b_capturista_id');
                var valor=$('input:radio[name=radioAceptar]:checked').val()
                console.log("Radio: "+valor); 
                fondoAhorros({ opcion : 2, ruta:ruta, capturista_id:id_capturista,acepto:valor}, respSubirArchivo);
            }
           
            
        });

        $( "#btnEliminarArchivo" ).click(function() {
            var id_capturista = Cookies.get('b_capturista_id');
            console.log("Id para eliminar: "+id_capturista);
            fondoAhorros({ opcion : 3, capturista_id:id_capturista}, respEliminarArchivo);
        });

        $("#btnExcelSolicitudes").click(function() {

            console.log("presionado excel");
            //descargarExcel();
            fnExcelReportSolicitudes();
        });

    
});

    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////FUNCIONES//////////////////////////////////////////////////////////////////
    function verifcarArchivo()
    {
        var id = Cookies.get('b_capturista_id');
        console.log("ID= "+id);
  
        fondoAhorros({ opcion : 1, capturista_id:id}, respVerificarArchivo);
    }

    function habilitarAceptar()
    {
        $("#AceptarSubirArchivo").removeAttr("disabled");
    }

    function recargarPag()
    {
        location.reload();
    }
    
    function cargarDatosFondoAhorro()
    {
        cargarMenuPorRol();
        var id = Cookies.get('b_capturista_id');
        console.log("ID= "+id);
        console.log("CARGAR DATOS FONDO");
  
        fondoAhorros({ opcion : 1, capturista_id:id}, respCargarDatosFondoAhorro);
    }

    function informacionArchivo(capturista_id)
    {
        var id = capturista_id;
        console.log("ID= "+id);
        fondoAhorros({ opcion : 1, capturista_id:id}, respCargarArchivoModal);
        
    }

    function cargarSolicitudesFA()
    {
        cargarMenuPorRol();
        console.log("CARGANDO SOLICITUDES");
        fondoAhorros({ opcion : 4}, respCargarSolicitudesFondoAhorro);

    }

    function fnExcelReportSolicitudes()
    {
        var tab_text="<table border='2px' charset=UTF-8><tr> "+
        "<th>Id</th>"+
        "<th>Empleado Id</th>"+
        "<th>Empleado</th>"+
        "<th>Fecha subido</th>   "+
        "<th>Hora subido</th>  "+
        "<th>Acepto porcentaje de aceptación</th>   "+
        "</tr>";
        var textRange; var j=0;
        tab = document.getElementById('datosSolicitudesFondoExcel'); // id of table

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
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////// RESPUESTAS ////////////////////////////////////////////////////////////////
    var respVerificarArchivo = function(data) 
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        var archivoCargada="";
        if(data[0].id>0)
        {
            console.log("Si hay datos");
            document.getElementById('AceptarSubirArchivo').style.display = 'none';
            document.getElementById('cargarArchivoFondoAhorro').style.display = 'block';
            document.getElementById('divBtnEliminarArchivo').style.display = 'block';
            var archivoCargada =   '<img class="materialboxed" width="650" src="imagenesFondoAhorro/'+data[0].ruta_archivo+'">';
            $("#cargarArchivoFondoAhorro").html(archivoCargada);
        }
        else
        {
            console.log("no hay datos");
            $("#classbtnSubirArchivo").removeClass('grey');
            $("#btnSubirArchivo").removeAttr("disabled");
            document.getElementById('divLetras').style.display = 'block';
            document.getElementById('divRadioButton').style.display = 'block';          
            $("#btnEliminarArchivo").attr('disabled', "disabled");
            document.getElementById('cargarArchivoFondoAhorro').style.display = 'none';

        }
    }

    var respSubirArchivo = function(data)
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }

        M.toast({html: 'Archivo subido con éxito', classes: 'rounded green'}); 
        $( "#formFiles3" ).submit();
        $("#modalCargarFondoAhorro").modal("close"); 
        

    }

    var respCargarDatosFondoAhorro = function(data)
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        var d="";
        if(data[0].id>0)
        {
            console.log("Si hay datos");
            document.getElementById('tablaFondo').style.display = 'block';           
            $("#btnCrearFondoAhorro").attr('disabled', "disabled");
            $("#btnCargarImagen").attr('disabled', "disabled");
            d+= '<tr>'+
                    '<td>'+data[0].id+'</td>'+
                    '<td>'+data[0].capturista_id+'</td>'+
                    '<td>'+data[0].capturista+'</td>'+ 
                    '<td>'+data[0].fecha_subida+'</td>'+ 
                    '<td>'+data[0].hora_subida+'</td>'+ 
                    '<td>'+data[0].acepto+'</td>'+ 
                    '<td class="center">'+
                    '<a onClick="informacionArchivo('+data[0].capturista_id+');" class="waves-effect waves-light btn-floating btn-small blue darken-4 btn modal-trigger" href="#modalVerArchivo"><i class="material-icons">remove_red_eye</i></a>' + 
                    '</tr> ';
            $("#datosFondo").html(d);
        }
        else
        {
           return;
        }


    }

    var respCargarArchivoModal = function(data)
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }

        console.log("LIGA:" +data[0].ruta_archivo);
        var ligaArchivo=data[0].ruta_archivo;
        var archivoCargado="";
        var ultimas3Letras=ligaArchivo.substr( ligaArchivo.length-3, ligaArchivo.length-3);
        console.log("ULTIMAS 3 Letras= "+ultimas3Letras);	

        if(ultimas3Letras=="jpg" || ultimas3Letras=="png")
        {
            archivoCargado+= '<div class="col s12 l8 offset-l2" > '+
            '<img class="materialboxed" width="650" src="imagenesFondoAhorro/'+ligaArchivo+'">'+
            '</div> ';     
            $("#cargarArchivo").html(archivoCargado);
        }
        else
        {
            archivoCargado+= '<div class="col s12 l8 offset-l2" > '+
            '<iframe src="imagenesFondoAhorro/'+ligaArchivo+'"  class="col s12" style="border: none;height:500px"></iframe>'+
            '</div> '; 
            $("#cargarArchivo").html(archivoCargado);

        }


    }

    

    var respEliminarArchivo = function(data)
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }

        M.toast({html: 'Archivo Eliminado con éxito!', classes: 'rounded red'}); 

        $("#modalCargarFondoAhorro").modal("close"); 
        location.reload();

    }

    var respCargarSolicitudesFondoAhorro = function(data)
    {
        if (!data && data == null)
        {
            M.toast({html: 'Ocurrio un problema, contacte con el departamento de sistemas', classes: 'rounded red'});  
            return;
        }
        var d="";
        var d2="";
        for (var i = 0; i < data.length; i++) 
        {
            if(data[i].id>0)
            {
                console.log("Si hay datos");
                d+= '<tr>'+
                        '<td>'+data[i].id+'</td>'+
                        '<td>'+data[i].capturista_id+'</td>'+
                        '<td>'+data[i].capturista+'</td>'+ 
                        '<td>'+data[i].fecha_subida+'</td>'+ 
                        '<td>'+data[i].hora_subida+'</td>'+ 
                        '<td>'+data[i].acepto+'</td>'+ 
                        '<td class="center">'+
                        '<a onClick="informacionArchivo('+data[i].capturista_id+');" class="waves-effect waves-light btn-floating btn-small blue darken-4 btn modal-trigger" href="#modalVerArchivoDesdeSolicitudes"><i class="material-icons">remove_red_eye</i></a>' + 
                        '</tr> ';
                d2+='<tr>'+
                    '<td>'+data[i].id+'</td>'+
                    '<td>'+data[i].capturista_id+'</td>'+
                    '<td>'+data[i].capturista+'</td>'+ 
                    '<td>'+data[i].fecha_subida+'</td>'+ 
                    '<td>'+data[i].hora_subida+'</td>'+ 
                    '<td>'+data[i].acepto+'</td>'+ 
                    '</tr> ';
            }
            else
            {
                d+='<tr><td>Sin datos</td></tr>';
                $("#datosSolicitudesFondo").html(d);
                $("#datosSolicitudesFondoExcel").html(d);
                return;
            }
        }
        
        $("#datosSolicitudesFondo").html(d);
        $("#datosSolicitudesFondoExcel").html(d2);
        
    }
 