<?php /* Smarty version Smarty-3.1.8, created on 2025-07-21 20:39:49
         compiled from "C:\xampp\htdocs\sigo\views\generators\editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1403674291687e89750325c0-33853159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dda4b55af7fa658c5118c673c97ae2e48b1b2f3d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\sigo\\views\\generators\\editar.tpl',
      1 => 1753081208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1403674291687e89750325c0-33853159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    '_layoutParams' => 0,
    'controlador' => 0,
    'nameCrudTable' => 0,
    'detalles' => 0,
    'nomsingular' => 0,
    'd' => 0,
    'filtro' => 0,
    'idiomas' => 0,
    'ididioma' => 0,
    'datoi' => 0,
    'ventana_modal' => 0,
    'idgrupoidioma' => 0,
    'datosf' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_687e8975062c54_75220532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_687e8975062c54_75220532')) {function content_687e8975062c54_75220532($_smarty_tpl) {?>
<style>

.content{
    padding-top: 15px!important;
}
.card-title{
    font-size: 1.75rem;
}


</style>

<form class="bs-example bs-example-form prevent-submit" data-example-id="simple-input-groups" id="formp" name="formp" action="javascript:guardar_generator('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
',false,'formp')" method="post" enctype="multipart/form-data">

	<?php if ($_smarty_tpl->tpl_vars['nameCrudTable']->value){?>
		<input type="hidden" name="name_crud_table" value="<?php echo $_smarty_tpl->tpl_vars['nameCrudTable']->value;?>
">
	<?php }?>

	<div class="card">

		<div class="card-header">
			<h3 class="card-title">
				<?php if ((($tmp = @$_smarty_tpl->tpl_vars['detalles']->value)===null||$tmp==='' ? '' : $tmp)=="readonly"){?>
					<i class="fas fa-file-alt"></i> Detalle de <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>
 <?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value['ID_T'])===null||$tmp==='' ? '' : $tmp);?>

				<?php }else{ ?>
					<i class="fas fa-pencil-alt"></i> Crear <?php echo $_smarty_tpl->tpl_vars['nomsingular']->value;?>

				<?php }?>
			</h3>	
			<div class="card-tools">
				<!--<a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/index/<?php echo (($tmp = @$_smarty_tpl->tpl_vars['filtro']->value)===null||$tmp==='' ? '' : $tmp);?>
">Sarlir</a>-->
				<a class="btn" href="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/index/">Salir</a>
				<?php if ((($tmp = @$_smarty_tpl->tpl_vars['detalles']->value)===null||$tmp==='' ? '' : $tmp)!="readonly"){?> 
					<button type="submit" class="btn btn-success btnguardar" id="btnguardar"><i class="fas fa-save mr-2"></i> Guardar</button>
				<?php }?>	
			</div>
			
		</div>



		<?php if (isset($_smarty_tpl->tpl_vars['idiomas']->value)){?>
		<div class="bs-example bs-navbar-top-example" data-example-id="navbar-static-top"> 
			<nav class="navbar navbar-default navbar-static-top">  
		        <div class="container-fluid"> 
		            <div class="navbar-header"> 
		                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8" aria-expanded="false"> 		
		                    <span class="sr-only">Toggle navigation</span> 
		                    <span class="icon-bar"></span> <span class="icon-bar"></span> 
		                    <span class="icon-bar"></span> 
		                </button> 
		                <a class="navbar-brand">Idiomas:</a> 
		            </div>  
		            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8"> 
		                <ul class="nav navbar-nav"> 
		                    <?php  $_smarty_tpl->tpl_vars['datoi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['datoi']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['idiomas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['datoi']->key => $_smarty_tpl->tpl_vars['datoi']->value){
$_smarty_tpl->tpl_vars['datoi']->_loop = true;
?>
		                        <?php if ($_smarty_tpl->tpl_vars['ididioma']->value==$_smarty_tpl->tpl_vars['datoi']->value['id']){?>
		                            <li class="active"><a href="javascript:cambiar_idioma(0)"><?php echo $_smarty_tpl->tpl_vars['datoi']->value['denominacion'];?>
(<?php echo $_smarty_tpl->tpl_vars['datoi']->value['prefijo'];?>
)</a></li>
		                        <?php }else{ ?>
		                            <li><a href="javascript:cambiar_idioma(<?php echo $_smarty_tpl->tpl_vars['datoi']->value['id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['datoi']->value['denominacion'];?>
(<?php echo $_smarty_tpl->tpl_vars['datoi']->value['prefijo'];?>
)</a></li>
		                        <?php }?>   
		                    <?php } ?>
		                </ul> 
		            </div> 
		        </div> 
		    </nav> 
		</div>
		<?php }?>

		<div class="card-body" style="    background-color: white;">
			<?php if ((($tmp = @$_smarty_tpl->tpl_vars['detalles']->value)===null||$tmp==='' ? '' : $tmp)=="readonly"){?>
				<?php echo $_smarty_tpl->getSubTemplate ("views/generators/detalles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<?php }else{ ?>
				<?php echo $_smarty_tpl->getSubTemplate ("views/generators/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<?php }?>
		</div>

	</div>
	
</form>

<?php echo $_smarty_tpl->getSubTemplate ("views/generators/ventanas_modal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ((($tmp = @$_smarty_tpl->tpl_vars['ventana_modal']->value)===null||$tmp==='' ? false : $tmp)){?>
	
<!--<script  src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
public/js/app.js" type="text/javascript"></script>-->
<?php }else{ ?>
	<div id="divLoading"> </div> 
<?php }?>


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

	


	/*<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datosf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['etiq'])===null||$tmp==='' ? '' : $tmp)!=''){?> 
		<?php }else{ ?>
			<?php if ($_smarty_tpl->tpl_vars['f']->value['tipo']=="listas_dependientes"){?>
				$("#<?php echo $_smarty_tpl->tpl_vars['f']->value['campo_dependencia'];?>
").on('change', function() {
				    alert("zxxx");
				});
			<?php }?>
		<?php }?>
	<?php } ?>*/


</script><?php }} ?>