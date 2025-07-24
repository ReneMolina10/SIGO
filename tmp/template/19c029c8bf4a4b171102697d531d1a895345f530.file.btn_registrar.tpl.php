<?php /* Smarty version Smarty-3.1.8, created on 2025-07-21 03:00:12
         compiled from "views/generators/btn_registrar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:683861833687526717bd945-17221633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19c029c8bf4a4b171102697d531d1a895345f530' => 
    array (
      0 => 'views/generators/btn_registrar.tpl',
      1 => 1753081208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '683861833687526717bd945-17221633',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687526717f0599_31230848',
  'variables' => 
  array (
    'childTemplate' => 0,
    'ocultarAgregar' => 0,
    'name_crud_table' => 0,
    'BASE_URL' => 0,
    'controlador' => 0,
    'parentId' => 0,
    'f' => 0,
    'esModal' => 0,
    'nSingular' => 0,
    'urlEditarModal' => 0,
    'nameTableGen' => 0,
    'modalId' => 0,
    'formId' => 0,
    'urlAgregar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687526717f0599_31230848')) {function content_687526717f0599_31230848($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars["isModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['childTemplate']->value['editForm']=='modal'), null, 0);?>
<?php $_smarty_tpl->tpl_vars["ocultarAgregar"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['ocultarAgregar']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["name_crud_table"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["urlEditarModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['BASE_URL']->value)."/".($_smarty_tpl->tpl_vars['controlador']->value)."/editar_modal/".($_smarty_tpl->tpl_vars['parentId']->value)."/".($_smarty_tpl->tpl_vars['f']->value['name_crud_table']), null, 0);?>
<?php $_smarty_tpl->tpl_vars["parentId"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['parentId']->value)===null||$tmp==='' ? 0 : $tmp), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['name_crud_table']->value){?>
  <?php $_smarty_tpl->tpl_vars["modalId"] = new Smarty_variable("modal_".($_smarty_tpl->tpl_vars['name_crud_table']->value), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["formId"] = new Smarty_variable("formp_".($_smarty_tpl->tpl_vars['name_crud_table']->value), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["nameTableGen"] = new Smarty_variable(($_smarty_tpl->tpl_vars['name_crud_table']->value), null, 0);?>
<?php }else{ ?>
  <?php $_smarty_tpl->tpl_vars["modalId"] = new Smarty_variable("modal_formulario", null, 0);?>
  <?php $_smarty_tpl->tpl_vars["formId"] = new Smarty_variable("formp_modal", null, 0);?>
  <?php $_smarty_tpl->tpl_vars["nameTableGen"] = new Smarty_variable("grid", null, 0);?>
<?php }?>



<?php if ($_smarty_tpl->tpl_vars['ocultarAgregar']->value=='false'){?>
  <?php $_smarty_tpl->tpl_vars["esModal"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['esModal']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["nSingular"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['nSingular']->value)===null||$tmp==='' ? 'Registro' : $tmp), null, 0);?>
  <?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>
    <a class="btn btn-sm btn-outline-dark rounded-pill"
       href="javascript:void(0);"
       onclick="
        <?php if ($_smarty_tpl->tpl_vars['parentId']->value==0){?>
          Swal.fire({
            icon: 'warning',
            title: 'Debe guardar primero el formulario principal',
            confirmButtonText: 'Aceptar'
          });
        <?php }else{ ?>
          open_modal_to_edit(
            0,0,0,
            '<?php echo $_smarty_tpl->tpl_vars['urlEditarModal']->value;?>
',
            '<?php echo $_smarty_tpl->tpl_vars['f']->value['bd']['nomSingular'];?>
', 
            <?php echo $_smarty_tpl->tpl_vars['parentId']->value;?>
,
            '<?php echo $_smarty_tpl->tpl_vars['nameTableGen']->value;?>
',
            '<?php echo $_smarty_tpl->tpl_vars['modalId']->value;?>
',
            '<?php echo $_smarty_tpl->tpl_vars['formId']->value;?>
'
          );
        <?php }?>
       ">
      <i class="fas fa-plus-circle mr-1"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>
 
    </a>
  <?php }else{ ?>
    <a class="btn btn-sm btn-dark" href="<?php echo $_smarty_tpl->tpl_vars['urlAgregar']->value;?>
">
      <i class="fas fa-plus-circle mr-1"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>

    </a>
  <?php }?> 
<?php }?>
<?php }} ?>