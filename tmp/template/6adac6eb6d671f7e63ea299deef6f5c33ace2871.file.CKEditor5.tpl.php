<?php /* Smarty version Smarty-3.1.8, created on 2025-08-21 00:02:34
         compiled from "views\generators\components\CKEditor5.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70489472968a645fa86f784-34353170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6adac6eb6d671f7e63ea299deef6f5c33ace2871' => 
    array (
      0 => 'views\\generators\\components\\CKEditor5.tpl',
      1 => 1755707211,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70489472968a645fa86f784-34353170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'registro' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68a645fa877798_98133528',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68a645fa877798_98133528')) {function content_68a645fa877798_98133528($_smarty_tpl) {?></style>

<div class="main-container">
  <div class="editor-container editor-container_classic-editor editor-container_include-style editor-container_include-word-count editor-container_include-fullscreen">
    <div class="editor-container__editor">
      <div class="ck5-editor" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
_editor" data-field="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
">
        <?php echo $_smarty_tpl->tpl_vars['registro']->value[$_smarty_tpl->tpl_vars['f']->value['campo']];?>

      </div>
    </div>
    <div class="editor_container__word-count" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
_wc"></div>
  </div>
</div>

<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['registro']->value[$_smarty_tpl->tpl_vars['f']->value['campo']], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['f']->value['required']=='true'){?>required<?php }?>>
<?php }} ?>