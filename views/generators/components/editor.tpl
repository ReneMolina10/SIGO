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
  		