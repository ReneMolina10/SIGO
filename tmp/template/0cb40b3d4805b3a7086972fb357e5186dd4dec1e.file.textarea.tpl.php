<?php /* Smarty version Smarty-3.1.8, created on 2025-07-14 13:06:25
         compiled from "views/generators/components/textarea.tpl" */ ?>
<?php /*%%SmartyHeaderCode:965723636687526a8105400-31989997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cb40b3d4805b3a7086972fb357e5186dd4dec1e' => 
    array (
      0 => 'views/generators/components/textarea.tpl',
      1 => 1752512782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '965723636687526a8105400-31989997',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687526a811a959_91769251',
  'variables' => 
  array (
    'f' => 0,
    'detalles' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687526a811a959_91769251')) {function content_687526a811a959_91769251($_smarty_tpl) {?><style>
.textarea-elegante {
    border: 1.5px solid #bdbdbd;
    border-radius: 0rem;
    background: #f8fafc;
    transition: border-color 0.2s, box-shadow 0.2s;
    font-size: 1.05rem;
    padding: 1rem;
    min-height: 120px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    resize: vertical;
}
.textarea-elegante:focus {
    border-color: #0dcadf;
    background: #fff;
    box-shadow: 0 0 0 2px #1976d233;
    outline: none;
}
.char-counter-elegante {
    font-family: 'Segoe UI', Arial, sans-serif;
    font-size: 0.95em;
    letter-spacing: 0.5px;
}
</style>
<div class="position-relative">
    <textarea
        class="form-control textarea-elegante"
        name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
"
        id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
"
        placeholder="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['f']->value['holder'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
        style="<?php if (isset($_smarty_tpl->tpl_vars['f']->value['alto'])){?>height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['alto'], ENT_QUOTES, 'UTF-8', true);?>
;<?php }?><?php if (isset($_smarty_tpl->tpl_vars['f']->value['style'])){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['style'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>"
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['required'])&&$_smarty_tpl->tpl_vars['f']->value['required']=="true"){?> required<?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['max'])){?> maxlength="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['max'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['rows'])){?> rows="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['rows'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }elseif(isset($_smarty_tpl->tpl_vars['f']->value['row'])){?> rows="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['row'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['readonly'])&&$_smarty_tpl->tpl_vars['f']->value['readonly']=="true"){?> readonly<?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?> disabled<?php }?>
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['detalles']->value)===null||$tmp==='' ? '' : $tmp);?>

        oninput="updateCharCount_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
()"
    ><?php echo htmlspecialchars((($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['value'] : $tmp))===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
    <div class="text-end char-counter-elegante mt-1">
        <span id="charCount_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
">0</span>
        de
        <span id="charMax_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['max'])===null||$tmp==='' ? '∞' : $tmp);?>
</span>
    </div>
</div>
<script>
function updateCharCount_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
() {
    var textarea = document.getElementById('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
');
    var count = textarea.value.length;
    var max = <?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['max'])===null||$tmp==='' ? 'null' : $tmp);?>
;
    var countSpan = document.getElementById('charCount_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
');
    countSpan.textContent = count;
    if (max !== null) {
        document.getElementById('charMax_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
').textContent = max;
        if (count >= max) {
            countSpan.classList.add('text-danger');
        } else {
            countSpan.classList.remove('text-danger');
        }
    }
}
// Inicializa el contador al cargar la página
document.addEventListener('DOMContentLoaded', updateCharCount_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value['campo'], ENT_QUOTES, 'UTF-8', true);?>
);
</script><?php }} ?>