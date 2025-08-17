<?php /* Smarty version Smarty-3.1.8, created on 2025-08-16 00:57:57
         compiled from "views\generators\components\select.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124351354968a01de5285b81-76900583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6d8ccf2244bb36b6bf0c16cc3799a5770db62e2' => 
    array (
      0 => 'views\\generators\\components\\select.tpl',
      1 => 1752014188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124351354968a01de5285b81-76900583',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    'literal' => 0,
    'd' => 0,
    'c' => 0,
    'nombre_function_que_trae_lista' => 0,
    'BASE_URL' => 0,
    'controlador' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68a01de52db510_38134635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68a01de52db510_38134635')) {function content_68a01de52db510_38134635($_smarty_tpl) {?><?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?>
	<div class="input-group">
	<div class="input-group-addon">
		<i class="fa fa-<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp);?>
"></i>
	</div>
<?php }?>

<select  id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
"  class="form-control <?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['class'])===null||$tmp==='' ? '' : $tmp);?>
" name="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
" id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
" style="width:100%"
	<?php if (isset($_smarty_tpl->tpl_vars['f']->value['disabled'])&&$_smarty_tpl->tpl_vars['f']->value['disabled']=="true"){?> disabled <?php }?>
	<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['required'])===null||$tmp==='' ? "false" : $tmp)=="true"){?> required  <?php }?> 

>





	<?php if ((($tmp = @$_smarty_tpl->tpl_vars['literal']->value)===null||$tmp==='' ? '' : $tmp)==1){?>			
		{$opciones_campo_<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
}
    <?php }else{ ?> 
		<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = (($tmp = @$_smarty_tpl->tpl_vars['f']->value['datos'])===null||$tmp==='' ? '' : $tmp); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>

			<option <?php if ((($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp)==$_smarty_tpl->tpl_vars['c']->value['ID']){?> selected <?php }?> value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['c']->value['ID'])===null||$tmp==='' ? '' : $tmp);?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['c']->value['CAMPO'])===null||$tmp==='' ? '' : $tmp);?>
</option>
		<?php } ?>  
	<?php }?>
	
</select>

<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['icon'])===null||$tmp==='' ? '' : $tmp)!=''){?></div><?php }?>

<script type="text/javascript">

	<?php if (isset($_smarty_tpl->tpl_vars['f']->value['campo_dependencia'])&&$_smarty_tpl->tpl_vars['f']->value['campo_dependencia']!="false"&&$_smarty_tpl->tpl_vars['f']->value['campo_dependencia']!=''){?>  
		
		<?php ob_start();?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["nombre_function_que_trae_lista"] = new Smarty_variable("traer_lista_".$_tmp1, null, 0);?>

		$("#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo_dependencia'];?>
").change(function() {  // bind a change event:
	      <?php echo $_smarty_tpl->tpl_vars['nombre_function_que_trae_lista']->value;?>
();
	    }).change();

		function <?php echo $_smarty_tpl->tpl_vars['nombre_function_que_trae_lista']->value;?>
(){
			var value_campo_depende = $("#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo_dependencia'];?>
").val().replace(" ","_");
			//alert(value_campo_depende);
			$.ajax({
			  //data:  'x='+x+'&x='+x+'&x='+x,
			  url: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/get_lista_dependiente/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
/'+value_campo_depende+'/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp);?>
/', 
			  type:  'post',
			  scriptCharset:"utf-8",
			  beforeSend: function () {
			    $("div#divLoading").addClass('show');
			    //$("#mensaje").html('Guardando...');			    
			  },
			  success:  function (response) {       
			    $( "#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
" ).html(response).change();
			    $("div#divLoading").removeClass('show');                            
			  }
			});		
		}
	<?php }?>



	<?php if (!isset($_smarty_tpl->tpl_vars['f']->value['disabled'])||$_smarty_tpl->tpl_vars['f']->value['disabled']=="false"){?>
		$(document).ready(function(){ 
			$("#<?php echo (($tmp = @$_smarty_tpl->tpl_vars['f']->value['campo'])===null||$tmp==='' ? '' : $tmp);?>
").select2({
				theme: 'default',
				/*placeholder: {
				    id: '0', // the value of the option
				    text: 'Seleccione una opción'
				},*/
				placeholder: "Seleccione...",
				language: 'es',
				//allowClear: true,			
			});
		 });



		banderaSelectGenerator = true;
	<?php }?>
	
</script>

<?php }} ?>