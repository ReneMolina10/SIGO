<?php /* Smarty version Smarty-3.1.8, created on 2025-07-03 12:38:15
         compiled from "views/generators/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1293909246866a3ff60cb74-48743719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c8b5f552578dfb2f6d889e9f5758d49066cb307' => 
    array (
      0 => 'views/generators/form.tpl',
      1 => 1751560689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1293909246866a3ff60cb74-48743719',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866a3ff6458b1_84488595',
  'variables' => 
  array (
    'datosf' => 0,
    'f' => 0,
    'd' => 0,
    '_layoutParams' => 0,
    'controlador' => 0,
    'ventana_modal' => 0,
    'codigoJS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866a3ff6458b1_84488595')) {function content_6866a3ff6458b1_84488595($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["libJSFinder"] = new Smarty_variable("0", null, 0);?>

  
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

	/*tooltip*/
	.tooltip>.tooltip-inner {
	  padding: 15px !important;;
	  font-size: 1.2em !important;;
	  background-color: #FFEB6C !important;;
	  color: #374D40 !important;;
	  max-width: 350px !important;; /*si es 500 falla en dispositivos*/
	  opacity:1 !important;				  
	}
	.tooltip.show {
	  opacity: 1 !important;
	  filter: alpha(opacity=100) !important;;
	}
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
"> <?php }?>
		<div class="form-group">
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['label'])===null||$tmp==='' ? '' : $tmp)!=''){?>
		<label for="<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
"><?php echo $_smarty_tpl->tpl_vars['f']->value['label'];?>
: <?php if (isset($_smarty_tpl->tpl_vars['f']->value['required'])&&$_smarty_tpl->tpl_vars['f']->value['required']=="true"){?> <span style="color:red">*</span> <?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['info_tooltip'])&&$_smarty_tpl->tpl_vars['f']->value['info_tooltip']!=''){?>  
				<span style="font-size: 85%" data-toggle="tooltip" title="" class="custom-tooltip badge badge-info" data-original-title='<?php echo $_smarty_tpl->tpl_vars['f']->value['info_tooltip'];?>
'>?</span>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['info_modal'])&&$_smarty_tpl->tpl_vars['f']->value['info_modal']!=''){?>  
				<button type="button" class="btn bg-info btn-xs" onclick="info_modal_<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
()" style="font-size: .6rem; padding: 0.25rem 0.4rem 0.2rem 0.4rem;"> <i class="fas fa-info"></i></button>
			<?php }?>
		</label>
		<?php }?>


		<?php if ($_smarty_tpl->tpl_vars['f']->value['tipo']=="text"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="datetime-local"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="telephone"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="email"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="month"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="number"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="range"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="search"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="time"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="url"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="week"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="file"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="password"||$_smarty_tpl->tpl_vars['f']->value['tipo']=="date"){?>
			
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/generico.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="textarea"){?>

			

			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['editor'])&&$_smarty_tpl->tpl_vars['f']->value['editor']=="true"){?>

				<?php if (isset($_smarty_tpl->tpl_vars['f']->value['prompt'])&&trim($_smarty_tpl->tpl_vars['f']->value['prompt'])!=''){?> 
					<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/editor-ia.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
 
				<?php }else{ ?>
					<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/textarea.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/editor.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php }?>

			<?php }else{ ?>
				<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/textarea.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<?php }?>

			<?php if (isset($_smarty_tpl->tpl_vars['f']->value['editor'])&&$_smarty_tpl->tpl_vars['f']->value['editor']=="true2"){?>

				<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/editor2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


			<?php }?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="urlfile"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/urlfile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


			<?php $_smarty_tpl->tpl_vars['libJSFinder'] = new Smarty_variable(1, null, 0);?>

  		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="tabla"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/tabla.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="color"){?>
	
			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/color.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


  		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="examinar"){?> 

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/examinar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="datalist"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/datalist.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		
		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/select.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select_ajax"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/select_ajax.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="select_multiple"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/select_multiple.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/uploadfile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }elseif($_smarty_tpl->tpl_vars['f']->value['tipo']=="colorpicker"){?>

			<?php echo $_smarty_tpl->getSubTemplate ("views/generators/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<?php }?>


			
		</div>
		<?php if ((($tmp = @$_smarty_tpl->tpl_vars['f']->value['col'])===null||$tmp==='' ? '' : $tmp)!=''){?> </div><?php }?>
	<?php }?>
<?php } ?>

<input type="hidden" name="id_tabla" id="id_tabla" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['d']->value['ID_T'])===null||$tmp==='' ? '' : $tmp);?>
"></input>







<script type="text/javascript">
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	}); 

	//Se recorren los campos
	<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datosf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>

		<?php if (isset($_smarty_tpl->tpl_vars['f']->value['campo'])&&isset($_smarty_tpl->tpl_vars['f']->value['info_modal'])&&$_smarty_tpl->tpl_vars['f']->value['info_modal']!=''){?> 	
			function info_modal_<?php echo $_smarty_tpl->tpl_vars['f']->value['campo'];?>
()
			{
				BootstrapDialog.show({
					title: '<b><i class=\'fas fa-info-circle\'></i> Información:</b> <?php echo $_smarty_tpl->tpl_vars['f']->value['label'];?>
',
					message: '<?php echo $_smarty_tpl->tpl_vars['f']->value['info_modal'];?>
',
					type: BootstrapDialog.TYPE_INFO,
					buttons: 
					[{
							id: 'btn-ok',
							icon: 'glyphicon glyphicon-check',
							label: " Aceptar",
							cssClass: 'btn-info',
							autospin: false,
							action: function(dialogRef)
							{
								dialogRef.close();
							}
					}]
				});
			}
		<?php }?>

	<?php } ?>

	
/*
	$("#btnguardar").click(function() {
		guardar('<?php echo $_smarty_tpl->tpl_vars['_layoutParams']->value['root'];?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
');
	});

*/
<?php if ((($tmp = @$_smarty_tpl->tpl_vars['ventana_modal']->value)===null||$tmp==='' ? '' : $tmp)!=true){?>
	<?php echo (($tmp = @$_smarty_tpl->tpl_vars['codigoJS']->value)===null||$tmp==='' ? '' : $tmp);?>

<?php }?>


	//Script Only Numbers
	// Initialize our function when the document is ready for events.
	jQuery(document).ready(function(){
	  // Listen for the input event.
	  jQuery(".solonumeros").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
	  });
	});
	//End Script Only Numbers

	/** Cristhian Escamillia */
	//Script Only txt&numers
	jQuery(document).ready(function(){
	  // Listen for the input event.
	  jQuery(".onlytxtnumbers").on('input', function (evt) {
		// Allow only numbers.
		jQuery(this).val(jQuery(this).val().replace(/[^abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890\s]/gi, '').split(' ').join(' '));
	  });
	});
	//END Script Only txt&numers

	/** Cristhian Escamillia */
	//Script Only Numbers
	//Initialize our function when the document is ready for events.
	jQuery(document).ready(function(){
		// Listen for the input event.
		jQuery(".onlytxtmayus").on('input', function (evt) {
			//Allow only txt mayus
			jQuery(this).val(jQuery(this).val().replace(/[^ABCDEFGHIJKLMNÑOPQRSTUVWXYZ\s]/gi, '').split(' ').join(' '));
		});
	});





	//===================================================================
	//============Control de cambios y confirmación de salida============
	//===================================================================

	// Función universal para control de cambios en formularios
	function FormChangeDetector(options = {}) {
		const config = {
			formSelector: '#formp',
			modalSelector: '#modal_formulario',
			saveButtonSelector: '#btnguardar',
			confirmMessage: 'Tienes cambios sin guardar. ¿Seguro quieres salir?',
			checkInterval: 1000, // Intervalo para verificar nuevos CKEditors
			...options
		};

		let tieneCambios = false;
		let formularioInicializado = false;
		let ckeditorInstances = new Set(); // Para trackear instancias ya procesadas
		let intervalId = null;

		// Función para resetear el estado
		function resetearEstado() {
			tieneCambios = false;
			formularioInicializado = false;
			ckeditorInstances.clear();
		}

		// Función para detectar y vincular nuevos CKEditors
		function detectarNuevosCKEditors() {
			if (typeof CKEDITOR === 'undefined') return;

			// Iterar sobre todas las instancias de CKEDITOR
			for (let instanceName in CKEDITOR.instances) {
				if (ckeditorInstances.has(instanceName)) continue; // Ya procesada

				let editor = CKEDITOR.instances[instanceName];
				
				// Verificar si el editor pertenece a nuestro formulario
				let editorElement = editor.element;
				if (!editorElement || !$(editorElement.$).closest(config.formSelector).length) {
					continue; // No pertenece a nuestro formulario
				}

				// Marcar como procesada
				ckeditorInstances.add(instanceName);

				// Configurar listeners para esta instancia
				configurarListenersCKEditor(editor, instanceName);
			}
		}

		// Configurar listeners específicos para una instancia de CKEditor
		function configurarListenersCKEditor(editor, instanceName) {
			//console.log('Configurando listeners para CKEditor:', instanceName);

			// Remover listeners previos si existen
			editor.removeAllListeners('change');
			editor.removeAllListeners('key');
			editor.removeAllListeners('paste');
			editor.removeAllListeners('focus');

			// Listener para cambios de contenido
			editor.on('change', function() {
				if (formularioInicializado) {
					tieneCambios = true;
					//console.log('Cambio detectado en CKEditor:', instanceName);
				}
			});

			// Listener para teclas (más inmediato que change)
			editor.on('key', function() {
				if (formularioInicializado) {
					// Pequeño delay para permitir que el cambio se procese
					setTimeout(() => {
						tieneCambios = true;
						//console.log('Tecla detectada en CKEditor:', instanceName);
					}, 50);
				}
			});

			// Listener para paste
			editor.on('paste', function() {
				if (formularioInicializado) {
					setTimeout(() => {
						tieneCambios = true;
						//console.log('Paste detectado en CKEditor:', instanceName);
					}, 100);
				}
			});

			// Listener cuando el editor se destruye (limpieza)
			editor.on('destroy', function() {
				ckeditorInstances.delete(instanceName);
				//console.log('CKEditor destruido:', instanceName);
			});
		}

		// Función para inicializar la detección de cambios
		function inicializarDeteccionCambios() {
			if (formularioInicializado) return;

			//console.log('Inicializando detección de cambios...');

			// Detectar campos normales
			$(config.formSelector).off('input.changeDetector change.changeDetector')
				.on('input.changeDetector change.changeDetector', 'input, select, textarea', function() {
					// Ignorar textareas que son CKEditors
					if ($(this).hasClass('cke_source') || $(this).data('ckeditor-processed')) {
						return;
					}
					
					if (formularioInicializado) {
						tieneCambios = true;
						//console.log('Cambio detectado en campo normal:', this.name || this.id);
					}
				});

			// Detectar CKEditors existentes
			detectarNuevosCKEditors();

			// Iniciar monitoreo continuo para CKEditors dinámicos
			if (intervalId) clearInterval(intervalId);
			intervalId = setInterval(detectarNuevosCKEditors, config.checkInterval);

			formularioInicializado = true;
			//console.log('Detección de cambios inicializada');
		}

		// Función para limpiar recursos
		function limpiarRecursos() {
			if (intervalId) {
				clearInterval(intervalId);
				intervalId = null;
			}
			$(config.formSelector).off('.changeDetector');
		}

		// Configurar eventos del modal (si existe)
		if ($(config.modalSelector).length) {
			// Al mostrar el modal
			$(config.modalSelector).on('shown.bs.modal.changeDetector', function() {
				//console.log('Modal mostrado, reseteando estado...');
				resetearEstado();
				setTimeout(inicializarDeteccionCambios, 500);
			});

			// Al intentar cerrar el modal
			$(config.modalSelector)
				.off('hide.bs.modal.changeDetector')
				.on('hide.bs.modal.changeDetector', function(e) {
					if (!tieneCambios) return;
					
					if (!confirm(config.confirmMessage)) {
						e.preventDefault();
					} else {
						//console.log('Usuario confirmó salir del modal');
						limpiarRecursos();
						resetearEstado();
					}
				});

			// Limpiar cuando el modal se oculta completamente
			$(config.modalSelector).on('hidden.bs.modal.changeDetector', function() {
				limpiarRecursos();
			});
		} else {
			// Página completa - inicializar inmediatamente
			//console.log('Modo página completa detectado');
			resetearEstado();
			setTimeout(inicializarDeteccionCambios, 500);
		}

		// Prevenir salida de página
		const beforeUnloadHandler = function(e) {
			if (!tieneCambios) return;

			const modal = $(config.modalSelector);
			const modalVisible = modal.length && modal.hasClass('show');

			if ((modalVisible && tieneCambios) || (!modal.length && tieneCambios)) {
				//console.log('Previniendo salida de página - hay cambios sin guardar');
				e.preventDefault();
				e.returnValue = '';
			}
		};

		window.addEventListener('beforeunload', beforeUnloadHandler);

		// Botón guardar
		$(document).on('click', config.saveButtonSelector, function() {
			//console.log('Guardando - reseteando estado de cambios');
			tieneCambios = false;
		});

		// API pública
		return {
			// Resetear manualmente
			reset: function() {
				//console.log('Reset manual solicitado');
				resetearEstado();
			},
			
			// Verificar si hay cambios
			hasChanges: function() {
				return tieneCambios;
			},
			
			// Forzar inicialización (útil para formularios muy dinámicos)
			reinitialize: function() {
				//console.log('Reinicialización manual solicitada');
				limpiarRecursos();
				resetearEstado();
				setTimeout(inicializarDeteccionCambios, 500);
			},
			
			// Limpiar completamente
			destroy: function() {
				//console.log('Destruyendo detector de cambios');
				limpiarRecursos();
				window.removeEventListener('beforeunload', beforeUnloadHandler);
				$(config.modalSelector).off('.changeDetector');
				$(document).off('click', config.saveButtonSelector);
			},
			
			// Configurar nuevos CKEditors manualmente
			addCKEditor: function(instanceName) {
				if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances[instanceName]) {
					configurarListenersCKEditor(CKEDITOR.instances[instanceName], instanceName);
				}
			}
		};
	}

	// Uso básico - auto-inicializar con configuración por defecto
	$(function() {
		// Crear instancia global para fácil acceso
		window.formChangeDetector = new FormChangeDetector();
	});

	// Ejemplo de uso personalizado:
	/*
	$(function() {
		window.formChangeDetector = new FormChangeDetector({
			formSelector: '#mi_formulario',
			modalSelector: '#mi_modal',
			saveButtonSelector: '#btn_guardar',
			confirmMessage: 'Hay cambios sin guardar. ¿Deseas continuar?',
			checkInterval: 500
		});
	});
	*/
	//============Fin Control de cambios y confirmación de salida============

</script><?php }} ?>