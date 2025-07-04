		<script src="{$BASE_URL_VIEW}plugins/ckeditor/ckeditor.js"></script>
		<script>
var btn_panginas = "Ver páginas";
var url_panginas = "BASE_URL/paginas/examinar";
  			$(function () {
    			CKEDITOR.replace('{$f.campo}', {
            		filebrowserBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		filebrowserImageBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
            		filebrowserFlashBrowseUrl : '/elFinder-2.1.29/elfinderck.php?idses=misitio&numselec=0',
					height: '100',
					allowedContent:true,
					toolbar: [
				{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
				{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
				{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
				{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
				{ name: 'about', items: [ 'About' ] }
					]
        		});
  			});
  		</script>
  		