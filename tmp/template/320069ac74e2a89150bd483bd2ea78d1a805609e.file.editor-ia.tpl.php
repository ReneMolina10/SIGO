<?php /* Smarty version Smarty-3.1.8, created on 2025-07-24 13:41:19
         compiled from "views\generators\components\editor-ia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199929280868827e4fc03bd0-38708005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '320069ac74e2a89150bd483bd2ea78d1a805609e' => 
    array (
      0 => 'views\\generators\\components\\editor-ia.tpl',
      1 => 1751560689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199929280868827e4fc03bd0-38708005',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68827e4fc96e68_44667293',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68827e4fc96e68_44667293')) {function content_68827e4fc96e68_44667293($_smarty_tpl) {?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
	  <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
		 aria-controls="tab1" aria-selected="true">Editor HTML</a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
		 aria-controls="tab2" aria-selected="false">Herramienta IA</a>
	</li>
  </ul>
  
  <!-- Tab content -->
  <div class="tab-content mt-3" id="myTabContent">
	<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
		<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/textarea.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div>
	<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
		<form id="formPrompt">
			<div class="form-group">
			  <label for="prompt">Prompt</label>
			  <p class="text-muted">Instrucciones para la revisión del texto proporcionado en el editor HTML</p>
			  <textarea class="form-control" id="prompt" name="prompt" rows="4" placeholder="Escribe tu prompt aquí..."><?php echo $_smarty_tpl->tpl_vars['f']->value['prompt'];?>
</textarea>
			</div>
			<button type="button" class="btn btn-primary" id="btnPrompt">Consultar a la IA</button> <button type="button" class="btn btn-primary d-none " id="btnUsarResp">Usar la propuesta de la IA</button>
		  </form>
		  
		  <div id="respuestaIA" class="mt-3"></div>
		  
	</div>
  </div>

  <script>
	$(document).ready(function () {
	  $('#btnPrompt').on('click', function () {
		const prompt = $('#prompt').val().trim();
  
		if (prompt === "") {
		  alert("Por favor escribe un prompt.");
		  return;
		}

		const dgTextoHTML = CKEDITOR.instances['DG_TEXTO'].getData();

 

	//	alert("El prompt es: <?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/getRespuestaIA    " + prompt+' - '+dgTextoHTML);
  
		$.ajax({
		  url: '<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/ia', // <-- cambia esto a tu endpoint
		  method: 'POST',
		  data: { 
			prompt: prompt ,
			texto: dgTextoHTML
		  },
		  beforeSend: function () {
			$('#btnPrompt').prop('disabled', true).text('Consultando...');
			$('#btnUsarResp').addClass('d-none');
		  },
		  success: function (respuesta) {
			$('#respuestaIA').html('<div class="alert alert-success">' + respuesta + '</div>');
			  // Verifica si la respuesta contiene el div con id="esponse_ia"
			if ($('#respuestaIA').find('#response_ia').length > 0) {
				$('#btnUsarResp').removeClass('d-none'); // Mostrar botón 
			} else {
				$('#btnUsarResp').addClass('d-none'); // Por si acaso ocultar si no hay
			}

		  },
		  error: function (xhr) {
			$('#respuestaIA').html('<div class="alert alert-danger">Error al consultar la IA.</div>');
		  },
		  complete: function () {
			$('#btnPrompt').prop('disabled', false).text('Consultar a la IA');
		  }
		});
	  });
	});

	$('#btnUsarResp').on('click', function () {
    const contenidoIA = $('#response_ia').html();
    CKEDITOR.instances['DG_TEXTO'].setData(contenidoIA);
  });

  </script>

  	

		<script src="<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['ruta_view'];?>
plugins/ckeditor/ckeditor.js"></script>
		<script>
var btn_panginas = "Ver páginas"; 
var url_panginas = "BASE_URL/paginas/examinar";
  			$(function () {
					try {
						CKEDITOR.replace('<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
', {
            		// filebrowserBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		// filebrowserImageBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		// filebrowserFlashBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
								height: <?php if (isset($_smarty_tpl->tpl_vars['f']->value['alto'])){?> "<?php echo $_smarty_tpl->tpl_vars['f']->value['alto'];?>
" <?php }else{ ?> '100' <?php }?> ,
								allowedContent:true,
								toolbar: [
									{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
									{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
									{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
									{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat', '-', 'TextColor', 'BGColor' ] },
									{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
									{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
									//{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
									{ name: 'insert', items: [ 'Table', 'HorizontalRule','Image', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },	
									{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
									{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
									{ name: 'about', items: [ 'About' ] }
								]
        		});	
					} catch (error) {
						
					}
    			
  			});

CKEDITOR.on('instanceReady', function (ev) {
    let body = ev.editor.document.getBody();
    body.setStyle('transform', 'scale(1.8)');
    body.setStyle('transform-origin', 'top left');
    body.setStyle('width', '50%'); // Ajusta el ancho para que no se desborde
});
// CKEDITOR.stylesSet.add( 'my_styles2', [
//     // Block-level styles.
//     { name: 'Blue Title', element: 'h2', styles: { color: 'Blue' } },
//     { name: 'Red Title',  element: 'h3', styles: { color: 'Red' } },

//     // Inline styles.
//     { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
//     { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
// ]);

// config.stylesSet = 'my_styles2'; 
			
  		</script>
  		<?php }} ?>