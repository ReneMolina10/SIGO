<?php /* Smarty version Smarty-3.1.8, created on 2025-07-18 02:39:57
         compiled from "views/generators/components/crud_table.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3307589096875268bdb12e6-85959429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0760a200c62a4b218dc1a1e24d7dd84582082f6' => 
    array (
      0 => 'views/generators/components/crud_table.tpl',
      1 => 1752820788,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3307589096875268bdb12e6-85959429',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6875268bdc3cf2_98930306',
  'variables' => 
  array (
    'childTemplate' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
    'parentId' => 0,
    'f' => 0,
    'columnas_per_sub' => 0,
    'columnas' => 0,
    'tablaResponsiva' => 0,
    'tablaScrollX' => 0,
    'checkbox_column' => 0,
    'bPaginate' => 0,
    'bFilter' => 0,
    'bInfo' => 0,
    'mostrarTfoot' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6875268bdc3cf2_98930306')) {function content_6875268bdc3cf2_98930306($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars["isModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['childTemplate']->value['editForm']=='modal'), null, 0);?>
<div class="mb-2 d-flex justify-content-end">
  <?php echo $_smarty_tpl->getSubTemplate ("views/generators/btn_registrar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('urlAgregar'=>($_smarty_tpl->tpl_vars['_layoutParams']->value['root']).($_smarty_tpl->tpl_vars['controlador']->value)."/editar/0/0/0/".($_smarty_tpl->tpl_vars['parentId']->value)."/".($_smarty_tpl->tpl_vars['f']->value['name_crud_table']),'nSingular'=>(($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['nomSingular'])===null||$tmp==='' ? 'Elemento' : $tmp),'ocultarAgregar'=>(($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['ocultarBtnAgregar'])===null||$tmp==='' ? 'false' : $tmp),'parentId'=>$_smarty_tpl->tpl_vars['parentId']->value,'name_crud_table'=>$_smarty_tpl->tpl_vars['f']->value['name_crud_table'],'esModal'=>$_smarty_tpl->tpl_vars['f']->value['template']['editForm']=='modal'), 0);?>

</div>



<?php $_smarty_tpl->tpl_vars["tablaResponsiva"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['tablaResponsiva'])===null||$tmp==='' ? 'true' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["tablaScrollX"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['tablaScrollX'])===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["checkbox_column"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['checkbox_column'])===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["bPaginate"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['bPaginate'])===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["bFilter"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['bFilter'])===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["bInfo"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['bInfo'])===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["mostrarTfoot"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['f']->value['bd']['mostrarTfoot'])===null||$tmp==='' ? true : $tmp), null, 0);?>




<div class="card mb-4">
  <div class="card-body p-2">
      
      <?php $_smarty_tpl->tpl_vars["columnas"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['columnas_per_sub']->value[$_smarty_tpl->tpl_vars['f']->value['name_crud_table']])===null||$tmp==='' ? array() : $tmp), null, 0);?>

      
      <?php echo $_smarty_tpl->getSubTemplate ("views/generators/tabla.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tableId'=>"tbl_".($_smarty_tpl->tpl_vars['f']->value['name_crud_table']),'columnas'=>$_smarty_tpl->tpl_vars['columnas']->value,'name_crud_table'=>$_smarty_tpl->tpl_vars['f']->value['name_crud_table'],'tablaResponsiva'=>$_smarty_tpl->tpl_vars['tablaResponsiva']->value,'tablaScrollX'=>$_smarty_tpl->tpl_vars['tablaScrollX']->value,'checkbox_column'=>$_smarty_tpl->tpl_vars['checkbox_column']->value,'bPaginate'=>$_smarty_tpl->tpl_vars['bPaginate']->value,'bFilter'=>$_smarty_tpl->tpl_vars['bFilter']->value,'bInfo'=>$_smarty_tpl->tpl_vars['bInfo']->value,'mostrarTfoot'=>$_smarty_tpl->tpl_vars['mostrarTfoot']->value), 0);?>

    
</div>
</div>
<?php }} ?>