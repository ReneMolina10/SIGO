<?php /* Smarty version Smarty-3.1.8, created on 2025-07-21 20:39:49
         compiled from "views\generators\components\oculto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1198900099687e89751a2fa5-92849627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e460ce1412e26ba4c5bb6e18a11dea84a521372' => 
    array (
      0 => 'views\\generators\\components\\oculto.tpl',
      1 => 1751560690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1198900099687e89751a2fa5-92849627',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687e89751b2041_51821187',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687e89751b2041_51821187')) {function content_687e89751b2041_51821187($_smarty_tpl) {?>
			<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" value="<?php echo (($tmp = @(($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['valor'] : $tmp))===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['value'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"></input>
 <?php }} ?>