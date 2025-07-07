<?php /* Smarty version Smarty-3.1.8, created on 2025-07-07 08:11:02
         compiled from "views/generators/ventanas_modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1614519964686b785fabf8c2-35954764%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd77f1bda425cf101a38b488d54dba73cffc26e5a' => 
    array (
      0 => 'views/generators/ventanas_modal.tpl',
      1 => 1751890255,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1614519964686b785fabf8c2-35954764',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_686b785fac86d1_17491453',
  'variables' => 
  array (
    '_layoutParams' => 0,
    'controlador' => 0,
    'nomsingular' => 0,
    'parentId' => 0,
    'nameCrudTable' => 0,
    'graficas' => 0,
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_686b785fac86d1_17491453')) {function content_686b785fac86d1_17491453($_smarty_tpl) {?>
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


<form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp_modal" name="formp_modal" action="javascript:guardar_generator('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
',true,'formp_modal')" method="post" enctype="multipart/form-data" >
<!-- ================================ MODAL PARA INSERTAR Y EDITAR ========================= -->
<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
 </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario"> 
            <?php echo $_smarty_tpl->getSubTemplate ("views/generators/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" id="id_reg" name="id_reg" value=""/>
            
            <input type="hidden" name="filtro" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['parentId']->value)===null||$tmp==='' ? 0 : $tmp);?>
"/>
            <!--<input type="hidden" name="name_crud_table" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['nameCrudTable']->value)===null||$tmp==='' ? '' : $tmp);?>
"/>-->
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-success" id="btnguardar" type="submit"><i class="fas fa-save"></i> Guardar</button>
          <!--<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>-->
        </div>
      
    </div>                          
  </div>
</div><!-- /.modal -->
</form>

<?php if (isset($_smarty_tpl->tpl_vars['graficas']->value)&&$_smarty_tpl->tpl_vars['graficas']->value!=''){?>
<!-- ================================ MODAL PARA VER GRAFICAS  ========================= -->
<div class="modal fade" id="modal_graficas" tabindex="-1" role="dialog" aria-labelledby="ModalGraficas">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    
    <div class="modal-content">
        <div class="modal-header">  
            <h5 class="modal-title"><i class="fas fa-chart-pie"></i> <span id="tit_modal_graficas" > <?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
 </span>  </h5>                         
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
<?php }?>

<!-- ================================ MODAL PARA IFRAMES  ========================= -->
<div class="modal fade" id="modal_iframe" tabindex="-1" role="dialog" aria-labelledby="myModalLabelIframe">
  <div class="modal-dialog modal-xl" style="min-width:calc(100%);">
    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header">  
            <h5 id="tit_modal_edit" class="modal-title"><i class="fas fa-edit"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
  </h5>                         
            <button type="button" class="close" data-dismiss="modal">&times;</button>                          
        </div>
        <div class="modal-body" id="formulario_iframe"> 
            +++
        </div>
        <div class="modal-footer justify-content-between">
          
        </div>
      
    </div>                          
  </div>
</div><!-- /.modal --><?php }} ?>