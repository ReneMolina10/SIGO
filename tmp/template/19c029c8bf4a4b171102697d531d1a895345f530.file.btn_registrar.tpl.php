<?php /* Smarty version Smarty-3.1.8, created on 2025-07-07 14:19:46
         compiled from "views/generators/btn_registrar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151012653686b0e8ba09888-61439483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19c029c8bf4a4b171102697d531d1a895345f530' => 
    array (
      0 => 'views/generators/btn_registrar.tpl',
      1 => 1751912376,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151012653686b0e8ba09888-61439483',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_686b0e8ba151c6_98876215',
  'variables' => 
  array (
    'childTemplate' => 0,
    'ocultarAgregar' => 0,
    'name_crud_table' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
    'parentId' => 0,
    'f' => 0,
    'esModal' => 0,
    'nSingular' => 0,
    'urlEditarModal' => 0,
    'urlAgregar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_686b0e8ba151c6_98876215')) {function content_686b0e8ba151c6_98876215($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars["isModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['childTemplate']->value['editForm']=='modal'), null, 0);?>
<?php $_smarty_tpl->tpl_vars["ocultarAgregar"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['ocultarAgregar']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["name_crud_table"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["urlEditarModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['_layoutParams']->value['root'])."/".($_smarty_tpl->tpl_vars['controlador']->value)."/editar_modal/".($_smarty_tpl->tpl_vars['parentId']->value)."/".($_smarty_tpl->tpl_vars['f']->value['name_crud_table']), null, 0);?>



<?php if ($_smarty_tpl->tpl_vars['ocultarAgregar']->value=='false'){?>
  <?php $_smarty_tpl->tpl_vars["esModal"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['esModal']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["nSingular"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['nSingular']->value)===null||$tmp==='' ? 'Registro' : $tmp), null, 0);?>
  <?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>
    <a class="btn btn-sm btn-success"
       href="javascript:open_modal_to_edit(0,0,0,'<?php echo $_smarty_tpl->tpl_vars['urlEditarModal']->value;?>
','<?php echo $_smarty_tpl->tpl_vars['f']->value['bd']['nomSingular'];?>
', <?php echo $_smarty_tpl->tpl_vars['parentId']->value;?>
,'<?php echo $_smarty_tpl->tpl_vars['name_crud_table']->value;?>
' )">
      <i class="fas fa-plus"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>

    </a>
  <?php }else{ ?>
    <a class="btn btn-sm btn-success" href="<?php echo $_smarty_tpl->tpl_vars['urlAgregar']->value;?>
">
      <i class="fas fa-plus"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>

    </a>
  <?php }?> 
<?php }?>
<?php }} ?>