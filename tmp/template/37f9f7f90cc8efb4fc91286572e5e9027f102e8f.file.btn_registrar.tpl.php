<?php /* Smarty version Smarty-3.1.8, created on 2025-08-03 23:48:29
         compiled from "views\generators\btn_registrar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1017066781687e897532a838-64339874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37f9f7f90cc8efb4fc91286572e5e9027f102e8f' => 
    array (
      0 => 'views\\generators\\btn_registrar.tpl',
      1 => 1754282900,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1017066781687e897532a838-64339874',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687e897537bc92_23221829',
  'variables' => 
  array (
    'esModal' => 0,
    'ocultarAgregar' => 0,
    'name_crud_table' => 0,
    'BASE_URL' => 0,
    'controlador' => 0,
    'parentId' => 0,
    'f' => 0,
    'nameTableGen' => 0,
    'nSingular' => 0,
    'formId' => 0,
    'parentFormId' => 0,
    'urlEditarModal' => 0,
    'urlAgregar' => 0,
    'modalId' => 0,
    'childFormId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687e897537bc92_23221829')) {function content_687e897537bc92_23221829($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars["esModal"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['esModal']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["ocultarAgregar"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['ocultarAgregar']->value)===null||$tmp==='' ? 'false' : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["name_crud_table"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['name_crud_table']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["urlEditarModal"] = new Smarty_variable(($_smarty_tpl->tpl_vars['BASE_URL']->value).($_smarty_tpl->tpl_vars['controlador']->value)."/editar_modal/".($_smarty_tpl->tpl_vars['parentId']->value)."/".($_smarty_tpl->tpl_vars['f']->value['name_crud_table']), null, 0);?>
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
<?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>
    <?php $_smarty_tpl->tpl_vars['parentFormId'] = new Smarty_variable("formp_grid", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['childModalId'] = new Smarty_variable("modal_".($_smarty_tpl->tpl_vars['nameTableGen']->value), null, 0);?>    
    <?php $_smarty_tpl->tpl_vars['childFormId'] = new Smarty_variable("formp_".($_smarty_tpl->tpl_vars['nameTableGen']->value), null, 0);?>    
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['parentFormId'] = new Smarty_variable('formp', null, 0);?>                      
    <?php $_smarty_tpl->tpl_vars['childModalId'] = new Smarty_variable("modal_".($_smarty_tpl->tpl_vars['nameTableGen']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['childFormId'] = new Smarty_variable("formp_".($_smarty_tpl->tpl_vars['nameTableGen']->value), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['ocultarAgregar']->value=='false'){?>
  <?php $_smarty_tpl->tpl_vars["esModal"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['esModal']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
  <?php $_smarty_tpl->tpl_vars["nSingular"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['nSingular']->value)===null||$tmp==='' ? 'Registro' : $tmp), null, 0);?>
  <a
    class="btn btn-sm btn-<?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>outline-dark<?php }else{ ?>dark<?php }?> rounded-pill"
    data-parent-full="formp"                       
    data-parent-modal="<?php echo $_smarty_tpl->tpl_vars['formId']->value;?>
"                  
    data-open-mode="<?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>modal<?php }else{ ?>full<?php }?>"  

    data-parent-form-id="<?php echo $_smarty_tpl->tpl_vars['parentFormId']->value;?>
"     
    data-parent-form-type="<?php if ($_smarty_tpl->tpl_vars['esModal']->value){?>modal<?php }else{ ?>full<?php }?>"

    href="javascript:void(0);"
    onclick="return registrarConHijo(
      this,
      '<?php if ($_smarty_tpl->tpl_vars['esModal']->value){?><?php echo $_smarty_tpl->tpl_vars['urlEditarModal']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['urlAgregar']->value;?>
<?php }?>',
      '<?php echo $_smarty_tpl->tpl_vars['nameTableGen']->value;?>
',
      '<?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>
',
      '<?php echo $_smarty_tpl->tpl_vars['modalId']->value;?>
',
      '<?php echo $_smarty_tpl->tpl_vars['childFormId']->value;?>
'
    )"
  >
    <i class="fas fa-plus-circle mr-1"></i> Registrar <?php echo $_smarty_tpl->tpl_vars['nSingular']->value;?>

  </a> 
<?php }?>
<?php }} ?>