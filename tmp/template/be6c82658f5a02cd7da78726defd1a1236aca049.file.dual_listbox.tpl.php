<?php /* Smarty version Smarty-3.1.8, created on 2025-07-03 14:03:36
         compiled from "views/generators/components/dual_listbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10596841956866c5f8b56e73-72391359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be6c82658f5a02cd7da78726defd1a1236aca049' => 
    array (
      0 => 'views/generators/components/dual_listbox.tpl',
      1 => 1751560689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10596841956866c5f8b56e73-72391359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'c' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866c5f8b63ae1_65230095',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866c5f8b63ae1_65230095')) {function content_6866c5f8b63ae1_65230095($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/opt/sitios/sigo/libs/smarty/libs/plugins/modifier.capitalize.php';
?>
  <select multiple="multiple" size="10" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]" title="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
">
  <div id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
">
    <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['ID'];?>
"  <?php if ((($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']][$_smarty_tpl->tpl_vars['c']->value['ID']])===null||$tmp==='' ? '' : $tmp)==1){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['c']->value['CAMPO'];?>
</option>
    <?php } ?>
</div>
  </select>
  <br>
  <!--<button type="submit" class="btn btn-default btn-block">Submit data</button>-->

<script>
  var demo1 = $('select[name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]"]').bootstrapDualListbox();
  /*$("#demoform").submit(function() {
    alert($('[name="duallistbox_demo1[]"]').val());
    return false;
  });*/
</script>

<!--         <div class="form-group">
  <label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" class="font-weight-bold mb-2"><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['f']->value['campo']);?>
</label>
  <select multiple="multiple" size="10" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]" title="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" class="form-control">
    <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['ID'];?>
" <?php if ((($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']][$_smarty_tpl->tpl_vars['c']->value['ID']])===null||$tmp==='' ? '' : $tmp)==1){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['CAMPO'];?>
</option>
    <?php } ?>
  </select>
</div>
<script>
  var demo1 = $('select[name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
[]"]').bootstrapDualListbox({
    nonSelectedListLabel: 'Disponibles',
    selectedListLabel: 'Seleccionados',
    preserveSelectionOnMove: 'moved',
    moveOnSelect: false,
    filterPlaceHolder: 'Buscar',
    infoText: 'Mostrando todos <?php echo 0;?>
',
    infoTextEmpty: 'Lista vacía',
    infoTextFiltered: '<span class="label label-warning">Filtrado</span> <?php echo 0;?>
 de <?php echo 1;?>
'
  });
</script>
<style>
  /* Mejora visual para el dual listbox */
  .bootstrap-duallistbox-container .moveall, 
  .bootstrap-duallistbox-container .removeall {
    background: #007bff;
    color: #fff;
    border-radius: 3px;
    margin-bottom: 5px;
  }
  .bootstrap-duallistbox-container select {
    min-height: 250px;
    font-size: 15px;
  }
  .bootstrap-duallistbox-container .btn {
    margin: 2px 0;
  }
</style>
 --><?php }} ?>