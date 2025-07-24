<?php /* Smarty version Smarty-3.1.8, created on 2025-07-21 20:39:49
         compiled from "views\generators\components\generico.tpl" */ ?>
<?php /*%%SmartyHeaderCode:793402716687e89751d1110-53160226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ad518250ac05da961fbe7b223d4f57f8ba9f673' => 
    array (
      0 => 'views\\generators\\components\\generico.tpl',
      1 => 1751560690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '793402716687e89751d1110-53160226',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'literal' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687e89752163a7_46833569',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687e89752163a7_46833569')) {function content_687e89752163a7_46833569($_smarty_tpl) {?>			<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?>
			<div class="input-group">
			<div class="input-group-addon">
			<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['f']->value['icon'];?>
"></i>
			</div>
			<?php }?>
			
			
			<input  class="form-control" type="<?php echo $_smarty_tpl->tpl_vars['f']->value['tipo'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" placeholder="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['holder'])===null||$tmp==='' ? '' : $tmp);?>
" 
	        
	        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['literal']->value)===null||$tmp==='' ? '' : $tmp)==1){?>
				 value="{$info.<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '-' : $tmp);?>
|default:''}" 
	        <?php }else{ ?>
				value="<?php echo (($tmp = @(($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['value'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
"   
			<?php }?>

			<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['detalles'])===null||$tmp==='' ? '' : $tmp);?>

			
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['max'])){?> maxlength="<?php echo $_smarty_tpl->tpl_vars['f']->value['max'];?>
" <?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['pattern'])){?> pattern="<?php echo $_smarty_tpl->tpl_vars['f']->value['pattern'];?>
" <?php }?>
			
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['readonly'])&&$_smarty_tpl->tpl_vars['f']->value['readonly']=="true"){?> readonly <?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?> disabled <?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['required'])&&$_smarty_tpl->tpl_vars['f']->value['required']=="true"){?> required="required" <?php }?>

			/>
			
			
			
			<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?></div><?php }?><?php }} ?>