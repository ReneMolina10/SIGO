<?php /* Smarty version Smarty-3.1.8, created on 2025-07-03 12:38:32
         compiled from "views/generators/components/oculto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17445832166866a87a4dca75-59790969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e57c1d2a5cebe1bd720afef2e70fb3fd43d36bda' => 
    array (
      0 => 'views/generators/components/oculto.tpl',
      1 => 1751560690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17445832166866a87a4dca75-59790969',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866a87a4f1707_29187763',
  'variables' => 
  array (
    'f' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866a87a4f1707_29187763')) {function content_6866a87a4f1707_29187763($_smarty_tpl) {?>
			<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" value="<?php echo (($tmp = @(($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['valor'] : $tmp))===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['value'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"></input>
 <?php }} ?>