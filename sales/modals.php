
<!--MODAL PARA DESHABILITAR-->
<div id="modalDeshabilitar" class="modal">
                <nav class=" blue accent-4">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo">
                             Cambiar Estatus
                        </a>
                    </div>
                </nav>
                <div class="modal-content"> 
                    <div class="container"> 
                        <div class="row"><!-- ROW 1-->
                            <div class="input-field col l2">
                              <input id="txtIdEstatus" class="black-text" type="text" placeholder=" " disabled>
                              <label class="black-text active" for="txtIdEstatus"  >Id</label>
                            </div>
                              <div class="input-field col l4">
                                      <select id="sltEstatusPago">
                                        <option value="0" disabled selected>Seleccione una Opcion</option>
                                        <option value="5">ACTIVO</option>
                                        <option value="3">CANCELADO</option>
                                        <option value="11">VENDIDO</option>
                                        <option value="12">STOCK</option>
                                        <option value="2">FINALIZADO</option>
                                      </select>
                                <label>Estatus</label>
                              </div>
                            <div class="input-field col l6">
                              <textarea id="txtMotivo" class="materialize-textarea" placeholder=" "></textarea>
                                 <label for="txtMotivo" class="black-text">Motivo</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" >
                            <div class="col s6 right"    >
                            <a onclick="cambiarEstatusPago()" class="waves-effect waves-light btn  accent-4 green"><i class="material-icons left">done</i>Aceptar</a>
                                
                            </div>
                            <div class="col s6 "   >
                            <a  class="waves-effect modal-close waves-light btn right accent-4 red"><i class="material-icons left">close</i>Cancelar</a>
                            </div>
                </div>
                
                
                <div class="modal-footer"> 
                    
                </div>
</div>


<!--MODAL PARA CARGAR IMAGEN-->
<div id="modalCargarImg" class="modal">
                <nav class=" blue accent-4">
                    <div class="nav-wrapper">
                       
                        
                        <div class="container-fluid">
                              <div class="row">
                                <div class="col s6">
                                   <a href="#!" class="brand-logo">
                                        Cargar de imagen
                                    </a>
                                </div>
                                <div class="col s6 ">
                                  <a  class="waves-effect modal-close waves-light btn-small right accent-4 grey">X</a>
                                </div>
                              </div>
                        </div>  
                    </div> 
                          
                 </nav>
                <div class="modal-content"> 
                    <div class="container">  
                           <iframe id="frameImg"  src="img.<?php  ?>" frameborder="0" allowfullscreen >
                            
                            </iframe> 
                    </div>
                </div> 
                
                 
</div>

   <!-- Modal Structure -->
 
      <div id="modalImagenes" class="modal modal-large"  >
         <nav class=" blue accent-4">
              <div class="nav-wrapper">
                 
                  
                  <div class="container-fluid">
                        <div class="row">
                          <div class="col s6">
                             <a href="#!" class="brand-logo">
                                 Imagenes de Articulo
                              </a>
                          </div>
                          <div class="col s6 ">
                            <a  class="waves-effect modal-close waves-light btn-small right accent-4 grey">X</a>
                          </div>
                        </div>
                  </div>  
              </div> 
                    
           </nav>

        <div class="modal-content">
          <div class="container-fluid">
              <div class="row" id="divGaleria">               </div>
          </div>
        </div> 
      </div>


      <div id="modalSolicitar" class="modal modal-large">
               <nav class=" blue accent-4">
                    <div class="nav-wrapper">
                       
                        
                        <div class="container-fluid">
                              <div class="row">
                                <div class="col s6">
                                   <a href="#!" class="brand-logo">
                                        Solicitud de Articulo
                                    </a>
                                </div>
                                <div class="col s6 ">
                                  <a  class="waves-effect modal-close waves-light btn-small right accent-4 grey">X</a>
                                </div>
                              </div>
                        </div>  
                    </div> 
                          
                 </nav>

        <div class="modal-content">
          <div class="container-fluid">
            <div class="row">
                    <div class="input-field col s12 l2">
                      <input type="text" class="validate black-text" disabled value=" <?php
                            echo $_COOKIE['b_capturista_id'];
                            ?>">
                      <label for="txtIdSolicitar">Id</label>
                    </div>
                    <div class="input-field col s12 l10">
                      <input type="text" class="validate black-text" disabled value=" <?php
                            echo $_COOKIE['b_capturista'];
                            ?>">
                      <label class="active">Solicitante</label>                    
                   </div>
              </div>
              <div class="row">
                    <div class="input-field col s12 l2">
                      <input  " id="txtIdSolicitar" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtIdSolicitar"># Articulo</label>
                    </div>
                    <div class="input-field col s12 l6">
                      <textarea id="txtSolicitud" class="materialize-textarea"> </textarea>
                      <label for="txtSolicitud">Contacto</label>                    
                   </div>
                   <div class="input-field col s12 l4">
                      <input id="txtQuincenasSolicitadas" class="validate black-tex" value="0" onKeyPress="return soloNumeros(event)"> 
                      <label for="txtQuincenasSolicitadas" class="active">Quincenas</label>                    
                   </div>
              </div>
              <div class="row">
                <center><a id="aceptarSolicitud" class="waves-effect waves-light btn"><i class="material-icons right">offline_pin</i>Aceptar</a>
              </center>
              </div>
              <div class="row" id="vistaSolicitud">
                
              </div>
          </div>
        </div>
      </div>



      <div id="modalDetallesArticulo" class="modal modal-large">
        <nav class=" blue accent-4">
                    <div class="nav-wrapper">
                        <a class="brand-logo">
                            Detalles del Articulo
                        </a>
                    </div>
                </nav>
        <div class="modal-content">
          <div class="container">
              <div class="row">
                <dir></dir>
                    <div class="input-field col s12 l2">
                      <input id="txtSolicitanteId" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtSolicitanteId" class="active black-text">Id</label>
                    </div>
                    <div class="input-field col s12 l8">
                      <input id="txtSolicitante" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtSolicitante" class="active black-text">Solicitante</label>                    
                   </div>
                   <div class="input-field col s12 l2">
                      <input id="txtAntiguedad" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtAntiguedad" class="active black-text">Antiguedad</label>                    
                   </div>
              </div>
              <div class="row">
                   <div class="input-field col s12 l12">
                      <textarea id="txtComentario" class="materialize-textarea"  > </textarea>
                      <label for="txtComentario" class="active black-text">Comentario</label>
                    </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">  
          <div class="row ">
            <center>
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red white-text  hide-on-med-and-up">Cerrar</a>
            </center>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red white-text  hide-on-med-and-down">Cerrar</a>
          </div>
        </div>
      </div>


    <div id="modalAprobarSolicitud" class="modal">
       <nav class=" blue accent-4">
            <div class="nav-wrapper">
                <a class="brand-logo">
                    Autorizar Solicitud
                </a>
            </div>
        </nav>
        <div class="modal-content">
          <div class="container">
            <div class="row">
                    <div class="input-field col s12 l2">
                      <input id="txtIdAutorizado" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtIdAutorizado">Id</label>
                    </div>
                    <div class="input-field col s12 l10">
                      <input id="txtNombreSolicitante" type="text" class="validate black-text" disabled value=" ">
                      <label class="active">Solicitante</label>                    
                   </div>
              </div>
              <div class="row"> 
                    <div class="input-field col s12 l2">
                      <input  id="txtIdSolcitudAtutorizar" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtIdSolcitudAtutorizar"># Solicitud</label>
                    </div>
                    <div class="input-field col s12 l10">
                      <textarea id="txtNotaAutorizacion" class="materialize-textarea"> </textarea>
                      <label for="txtNotaAutorizacion">Nota</label>                    
                   </div> 
              </div>
              <div class="row"> 
                    <div class="input-field col s12 l3">
                      <input  id="txtPrecioReal" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtPrecioReal" class="black-text">Precio Real</label>
                    </div>
                    <div class="input-field col s12 l3">
                      <input  id="txtPrecio" type="text" class="validate black-text" disabled value=" ">
                      <label for="txtPrecio" class="black-text">Precio Especial</label>
                    </div>
                    <div class="input-field col s2 l3">
                      <input onkeydown="calcularPago(event)"  id="txtQuincenasAutorizar"   min='1' class="validate black-text"  value="0" disabled >
                      <label for="txtQuincenasAutorizar" class="black-text active">Quincenas</label>                    
                   </div>
                   <div class="input-field col s2 l3">
                      <input  id="txtPagoQuincenal" type="text" class="validate black-text" disabled value="0" disabled>
                      <label for="txtPagoQuincenal" class="black-text">Pago Quincenal</label>                    
                   </div>  
              </div>
              <div class="row">
                  <center>
                    <a  href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red white-text  ">Cerrar</a>
                    <a onclick="autorizarSolicitudArticulo()" href="#!" class="modal-action waves-effect waves-green btn-flat green white-text  ">Autorizar</a>
                 </center>
              </div>
          </div>
        </div>
      </div>
