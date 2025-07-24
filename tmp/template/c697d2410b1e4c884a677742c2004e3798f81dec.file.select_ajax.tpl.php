<?php /* Smarty version Smarty-3.1.8, created on 2025-07-15 00:45:43
         compiled from "views/generators/components/select_ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6762030416875dcf74d3cb4-87784628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c697d2410b1e4c884a677742c2004e3798f81dec' => 
    array (
      0 => 'views/generators/components/select_ajax.tpl',
      1 => 1751560690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6762030416875dcf74d3cb4-87784628',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'BASE_URL' => 0,
    'controlador' => 0,
    'd' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6875dcf74faf34_45735063',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6875dcf74faf34_45735063')) {function content_6875dcf74faf34_45735063($_smarty_tpl) {?><?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?>
	<div class="input-group">
	<div class="input-group-addon">
	<i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['f']->value['icon'];?>
"></i>
	</div>
<?php }?>

<select class="form-control <?php echo $_smarty_tpl->tpl_vars['f']->value['class'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" style="width:100%" 
<?php if (isset($_smarty_tpl->tpl_vars['f']->value['required'])&&$_smarty_tpl->tpl_vars['f']->value['required']=="true"){?> required="required" <?php }?>>

</select>

<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?></div><?php }?>

<script type="text/javascript">
	
	$(document).ready(function(){ 
		$("#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
").select2({
			language: 'es',
			theme: 'bootstrap4',
			placeholder: "Seleccione...",
			//allowClear: true,	
  			minimumInputLength: 1,  			
			ajax: { 
				url: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/get_datos_select_ajax/<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
/',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
					  palabra: params.term // search term
					};
				},
				processResults: function (response) {
					return {
					    results: response
					};
				},
				//error: function(xhr) {  }, //no se usa, porque el selec_ajax cancela peticiones conforme vas escribiendo y las cancelaciones entran como error
			   	cache: true
			},
		});

		var pat = '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/infosearch_selectajax/<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp);?>
/';
		load_info_select_ajax(pat,'<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
');
	});

	banderaSelectGenerator = true;


	 
</script>

<?php }} ?>