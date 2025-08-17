<?php /* Smarty version Smarty-3.1.8, created on 2025-08-16 01:39:07
         compiled from "views\generators\detalles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134965000968a0278b5dad84-84262063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6e3e7f82415f8ec310e07cdd23fd88f1025607d' => 
    array (
      0 => 'views\\generators\\detalles.tpl',
      1 => 1751560689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134965000968a0278b5dad84-84262063',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ventana_modal' => 0,
    '_layoutParams' => 0,
    'csseditar' => 0,
    'datosf' => 0,
    'f' => 0,
    'd' => 0,
    'c' => 0,
    'controlador' => 0,
    'idgrupoidioma' => 0,
    'codigoJS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68a0278b630510_45221767',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68a0278b630510_45221767')) {function content_68a0278b630510_45221767($_smarty_tpl) {?>
<?php if ((($tmp = @$_smarty_tpl->tpl_vars['ventana_modal']->value)===null||$tmp==='' ? '' : $tmp)!=true){?>
<div id="divLoading"> </div> 
<script  src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/app.js" type="text/javascript"></script>
<?php }?>

<style type="text/css">	
	<?php echo (($tmp = @$_smarty_tpl->tpl_vars['csseditar']->value)===null||$tmp==='' ? '' : $tmp);?>

</style>

<?php $_smarty_tpl->tpl_vars["libJSFinder"] = new Smarty_variable("0", null, 0);?>

  
<style>
	.clasificacion input[type = "radio"]{ display:none;/*position: absolute;top: -1000em;*/}
	.clasificacion label{ color:grey; margin-bottom: 0px !important; }

	.clasificacion{
	    direction: rtl;
	    unicode-bidi: bidi-override;
	    text-align: left;
	    font-size: 25px;
	    margin: 0px !important;
	}

	.clasificacion label:hover,
	.clasificacion label:hover ~ label{color:orange;}
	.clasificacion input[type = "radio"]:checked ~ label{color:orange;}
</style>




<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datosf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>

	<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['etiq'])===null||$tmp==='' ? '' : $tmp)!=''){?> 
		<?php echo $_smarty_tpl->tpl_vars['f']->value['etiq'];?>
 
	<?php }else{ ?>

		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['col'])===null||$tmp==='' ? '' : $tmp)!=''){?> <div class="<?php echo $_smarty_tpl->tpl_vars['f']->value['col'];?>
" style="border: 1px solid #ededed;"> <?php }?>
		<div class="form-group" >
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['label'])===null||$tmp==='' ? '' : $tmp)!=''){?>
		<label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['label'];?>
: </label>
		<?php }?>


		<?php if ($_smarty_tpl->tpl_vars['f']->value['tipo']=="text"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="datetime-local"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="telephone"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="email"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="color"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="month"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="number"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="range"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="search"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="time"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="url"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="week"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="file"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="date"){?>
			
			<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['f']->value['value'] : $tmp);?>
 </p>

		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="textarea"){?>

			<p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp);?>
 </p>

		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="urlfile"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/urlfile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


			<?php $_smarty_tpl->tpl_vars['libJSFinder'] = new Smarty_variable(1, null, 0);?>

  		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="tabla"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/tabla.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


  		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="examinar"){?> 

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/examinar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="datalist"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/datalist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select"){?>

			

			<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
				<?php if ((($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp)==$_smarty_tpl->tpl_vars['c']->value['ID']){?>
					<p ><?php echo $_smarty_tpl->tpl_vars['c']->value['CAMPO'];?>
</p>
				<?php }?>
			<?php } ?> 

		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select_ajax"){?>

			<p id="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
"></p>

			<script type="text/javascript">
				var pat = '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/infosearch_selectajax/<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']])===null||$tmp==='' ? '' : $tmp);?>
/';
				load_info_select_ajax(pat,'<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
');
			</script>

		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select_multiple"){?>

			<ul>
			<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['datos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['c']->key;
?>				
				<?php if ((($tmp = @$_smarty_tpl->tpl_vars['d']->value[$_smarty_tpl->tpl_vars['f']->value['campo']][$_smarty_tpl->tpl_vars['c']->value['ID']])===null||$tmp==='' ? '' : $tmp)==1){?>
					<li><?php echo $_smarty_tpl->tpl_vars['c']->value['CAMPO'];?>
</li>
				<?php }?> 
			<?php } ?>
			</ul>
						

		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="listas_dependientes"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/listas_dependientes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="dual_listbox"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/dual_listbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="estrellas"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/estrellas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="radio"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/radio.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    	<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="checkbox"){?>
    		
    		<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/checkbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    	<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="oculto"){?>
			
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/oculto.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="mapa"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/mapa.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="uploadfile"){?>

			<?php $_smarty_tpl->createLocalArrayVariable('f', null, 0);
$_smarty_tpl->tpl_vars['f']->value['disabled'] = "true";?>
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/uploadfile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }?>


			
		</div>
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['col'])===null||$tmp==='' ? '' : $tmp)!=''){?> </div><?php }?>
	<?php }?>
<?php } ?>

<input type="hidden" name="id_tabla" id="id_tabla" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value['ID_T'])===null||$tmp==='' ? '' : $tmp);?>
"></input>



<script type="text/javascript">

	function cambiar_idioma(id){

		if(document.formp.id_grupo_idioma.value==0 && document.formp.id_idioma.value==1){
			alert("Es necesario guardar primero esta página  ");
		}else { 

		document.formp.submit();

		window.open("<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/editar/"+document.formp.id_grupo_idioma.value+"/"+id,"_self");

	}
	

		/*
	if(id!=0){
		if(document.formp.id.value==0){
			//if( confirm("Es necesario guardar primero la página ") )

		}else{
			window.open("<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/editar/<?php echo $_smarty_tpl->tpl_vars['idgrupoidioma']->value;?>
/"+id,"_self");
		}
	}	
	*/
}

	<?php echo (($tmp = @$_smarty_tpl->tpl_vars['codigoJS']->value)===null||$tmp==='' ? '' : $tmp);?>

</script><?php }} ?>