
<!-- ================================ MODAL PARA BUSQUEDAS ========================= -->
<div class="modal fade" id="modal_busqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <form class="bs-example bs-example-form" enctype="multipart/form-data" id="form_search" name="busqueda" action="" method="post">
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnBuscar"><i class="fas fa-search"></i> Buscar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      </form>
    </div>                          
  </div>
</div><!-- /.modal -->


<form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp_modal" name="formp_modal" action="javascript:guardar_generator('{$_layoutParams.root}{$controlador}',true,'formp_modal')" method="post" enctype="multipart/form-data" >
<!-- ================================ MODAL PARA INSERTAR Y EDITAR ========================= -->
<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar {$nomsingular} </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario"> 
            {include file="views/generators/form.tpl"}
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_reg" name="id_reg" value=""/>
            {** Para el guardar crud-table (sub-generator) **}
            <input type="hidden" name="filtro" value="{$parentId|default:0}"/>
            <!--<input type="hidden" name="name_crud_table" value="{$nameCrudTable|default:''}"/>-->
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-success" id="btnguardar" type="submit"><i class="fas fa-save"></i> Guardar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      
    </div>                          
  </div>
</div><!-- /.modal -->
</form>

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

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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