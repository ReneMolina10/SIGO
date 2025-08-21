
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
		{include file="views/generators/components/textarea.tpl"}
	</div>
	<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
		<form id="formPrompt">
			<div class="form-group">
			  <label for="prompt">Prompt</label>
			  <p class="text-muted">Instrucciones para la revisión del texto proporcionado en el editor HTML</p>
			  <textarea class="form-control" id="prompt" name="prompt" rows="4" placeholder="Escribe tu prompt aquí...">{$f.prompt}</textarea>
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

 

	//	alert("El prompt es: {$_layoutParams.root}{$controlador}/getRespuestaIA    " + prompt+' - '+dgTextoHTML);
  
		$.ajax({
		  url: '{$_layoutParams.root}{$controlador}/ia', // <-- cambia esto a tu endpoint
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

  	

		<script src="{$_layoutParams.ruta_view}plugins/ckeditor/ckeditor.js"></script>
		<script>
var btn_panginas = "Ver páginas"; 
var url_panginas = "BASE_URL/paginas/examinar";
  			$(function () {
					try {
						CKEDITOR.replace('{$f.campo}', {
            		// filebrowserBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		// filebrowserImageBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		// filebrowserFlashBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
								height: {if isset($f.alto) } "{$f.alto}" {else} '100' {/if} ,
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
  		