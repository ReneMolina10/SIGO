
<!-- ================================ MODAL PARA BUSQUEDAS ========================= -->
<div class="modal fade" id="modal_busqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <form class="bs-example bs-example-form prevent-submit" enctype="multipart/form-data" id="form_search" name="busqueda" action="" method="post">
        <div class="modal-header">     
            <h5 class="modal-title"><i class="fas fa-search"></i> Búsqueda avanzada  </h5>             
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body"> 
            <div class='row'>
              <div class='col-sm-12 '>

                <table class="table table-sm table-striped table-bordered">
                  <thead>
                    <tr>
                      <th width="30%">Campo</th>
                      <th width="30%">Opción de búsqueda</th>
                      <th width="40%">Valor</th>
                    </tr>
                  </thead>
                  <tbody id="formf"></tbody>
                </table >

              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_oficio" name="id_oficio" value=""/> <!-- ¿? -->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      </form>
    </div>                          
  </div>
</div><!-- /.modal -->

{assign var="modalId"  value="modal_`$name_crud_table`"}
{assign var="formId"   value="formp_`$name_crud_table`"}

<!-- <form class="bs-example bs-example-form prevent-submit" data-example-id="simple-input-groups" id="formp_modal" name="formp_modal" action="javascript:guardar_generator('{$_layoutParams.root}{$controlador}',true,'formp_modal')" method="post" enctype="multipart/form-data" >
<!-- ================================ MODAL PARA INSERTAR Y EDITAR ========================= -->
<!-- <div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">

    <div class="modal-content">
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar {$nomsingular} </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario"> 
          
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_reg" name="id_reg" value=""/>
            {** Para el guardar crud-table (sub-generator) **}
            <input type="hidden" name="filtro" value="{$parentId|default:0}"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-success" id="btnguardar" type="submit"><i class="fas fa-save"></i> Guardar</button>
        </div>
      
    </div>                          
  </div>
</div> 
</form> -->

<!-- Solo se renderiza con el generato padre en edita -->
<div id="modal_base" class="modal fade" style="display:none;" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content border-0 shadow-lg">
      <form id="formp_base" class="prevent-submit" method="post" enctype="multipart/form-data">
        <!-- Encabezado con gradiente y mejor tipografía -->
        <div class="modal-header bg-gradient-dark text-white">
          <h5 id="tit_modal_edit" class="modal-title font-weight-bold"></h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <!-- Cuerpo con padding mejorado -->
        <div class="modal-body p-6"></div>
        
        <!-- Pie de página con botones mejorados -->
        <div class="modal-footer justify-content-between bg-light">
          <input type="hidden" id="id_reg" name="id_reg"/>
          <input type="hidden" id="filtro" name="filtro"/>
          <input type="hidden" id="name_crud_table" name="name_crud_table"/>
          
          <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i> Cerrar
          </button>
          
          <button type="button" id="btnguardar" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="fas fa-save mr-2"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--<div id="modal_base" class="modal fade" style="display:none;" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id="formp_base" class="prevent-submit" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 id="tit_modal_edit" class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_reg"           name="id_reg"/>
          <input type="hidden" id="filtro"           name="filtro"/>
          <input type="hidden" id="name_crud_table"  name="name_crud_table"/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnguardar" class="btn btn-success">
            <i class="fas fa-save"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
-->

{if isset($graficas) && $graficas != ''}
<!-- ================================ MODAL PARA VER GRAFICAS  ========================= -->
<div class="modal fade" id="modal_graficas" tabindex="-1" role="dialog" aria-labelledby="ModalGraficas">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    
    <div class="modal-content">
        <div class="modal-header">  
            <h5 class="modal-title"><i class="fas fa-chart-pie"></i> <span id="tit_modal_graficas" > {$titulo} </span>  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="div_grafica"> 
            
        </div>
        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>                          
  </div>
</div><!-- /.modal -->
{/if}

<!-- ================================ MODAL PARA IFRAMES  ========================= -->
<div class="modal fade" id="modal_iframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabelIframe">
  <div class="modal-dialog modal-xl" style="min-width:calc(100%);">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar {$nomsingular}  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario_iframe"> 
            +++
        </div>
        <div class="modal-footer justify-content-between">
          
        </div>
      
    </div>                          
  </div>
</div><!-- /.modal -->