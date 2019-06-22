 
  <!-- Modal Structure -->
  <div id="registroGrupo" class="modal"  >
    <div class="modal-content">
      <h4>Nuevo grupo de trabajo</h4> 

      <div class="row">
          <div class="col s12">
              <div class="input-field col s12">
                <input  placeholder="Nombre del Grupo" id="nombreGrupo" type="text" class="validate">
                <label class="black-text" for="first_name">Nombre del Grupo</label>
              </div> 
              <div class="col s12">
                <div class="row">
                  <div class="input-field col m10 s12">
                      <i class="material-icons prefix">textsms</i>
                      <input id="empleadoGrupo" type="text" placeholder="Buscar Empleado" onkeypress="buscarEmpleado(this.value)"  class="autocomplete" onfocus="mostrarLista()"   >
                      <label class="black-text" for="autocomplete-input">Empleado</label>
                      <div id="listaEspecial" class="col m11 offset-m1  s12  scrollerEspecial divEspecial" >
                        
                      </div>
                  </div>
                  <div class=" input-field col m2 s12">
                     <button class="btn waves-effect waves-light right blue " onclick="agregarEmpleadoAGrupo()" >Agregar
                      <i class="material-icons right">add_box</i>
                    </button>
                  </div>
                </div>
              </div>   
          </div>
          
          <div class="scroller5">
              <table>
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Correo</th> 
                      <th>Accion</th> 
                  </tr>
                </thead>
                
                <tbody id="tb_integrantes"> 
                </tbody>
              </table>

          </div>
          
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!"  class="modal-close waves-effect waves-green btn-flat red">CANCELAR</a>
      <a href="#!" onclick="guardarGrupoDeTrabajo()" class=" waves-effect waves-green btn-flat green">GUARDAR</a>
    </div>
  </div>
 
 <!-- Modal detalle  -->
  <div id="detalleGrupo" class="modal"  >
    <div class="modal-content">
      <h4>Detalle del Grupo</h4> 

      <div class="row">
          <div class="col s12">
              <div class="input-field col s12">
                <input  placeholder="Nombre del Grupo" id="dNombreGrupo" type="text" class="validate" readonly="">
                <label class="black-text" for="dNombreGrupo">Grupo</label>
              </div>  
          </div>
          
          <div class="scroller5">
              <table>
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Correo</th> 
                      <th>Estatus</th> 
                  </tr>
                </thead>
                
                <tbody id="tb_integrantes_estatus"> 
                </tbody>
              </table>

          </div>
          
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!"  class="modal-close waves-effect waves-green btn-flat red">CERRAR</a> 
    </div>
  </div>