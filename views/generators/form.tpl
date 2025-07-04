{assign var="libJSFinder" value="0"}

{literal}  
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
{/literal}



{foreach key=key item=f from=$datosf}

	{if $f.etiq|default:""!=""} 
		{$f.etiq} 
	{else}

		{if $f.col|default:""!=""} <div class="{$f.col}"> {/if}
		<div class="form-group">
		{if $f.label|default:"" != ""}
		<label for="{$f.campo}">{$f.label}: {if isset($f.required) && $f.required== "true"} <span style="color:red">*</span> {/if}
			{if isset($f.info_tooltip) && $f.info_tooltip != '' }  
				<span style="font-size: 85%" data-toggle="tooltip" title="" class="custom-tooltip badge badge-info" data-original-title='{$f.info_tooltip }'>?</span>
			{/if}
			{if isset($f.info_modal) && $f.info_modal != '' }  
				<button type="button" class="btn bg-info btn-xs" onclick="info_modal_{$f.campo}()" style="font-size: .6rem; padding: 0.25rem 0.4rem 0.2rem 0.4rem;"> <i class="fas fa-info"></i></button>
			{/if}
		</label>
		{/if}


		{if $f.tipo=="text" || $f.tipo=="datetime-local" || $f.tipo=="telephone" || $f.tipo=="email"  || $f.tipo=="month" || $f.tipo=="number" || $f.tipo=="range" || $f.tipo=="search" || $f.tipo=="time" || $f.tipo=="url" || $f.tipo=="week" || $f.tipo=="file" || $f.tipo=="password" || $f.tipo=="date"}
			
			{include file="views/generators/components/generico.tpl"}

		{else if $f.tipo=="textarea" }

			

			{if isset($f.editor) && $f.editor=="true"}

				{if isset($f.prompt) && $f.prompt|trim != ""} 
					{include file="views/generators/components/editor-ia.tpl"} 
				{else}
					{include file="views/generators/components/textarea.tpl"}
					{include file="views/generators/components/editor.tpl"}
				{/if}

			{else}
				{include file="views/generators/components/textarea.tpl"}
			{/if}

			{if isset($f.editor) && $f.editor=="true2"}

				{include file="views/generators/components/editor2.tpl"}

			{/if}


		{else if $f.tipo=="urlfile" }
	
			{include file="views/generators/components/urlfile.tpl"}

			{$libJSFinder=1}

  		{else if $f.tipo=="tabla" }
	
			{include file="views/generators/components/tabla.tpl"}

		{else if $f.tipo=="color" }
	
			{include file="views/generators/components/color.tpl"}

  		{else if $f.tipo=="examinar" } 

			{include file="views/generators/components/examinar.tpl"}

		{else if $f.tipo=="datalist" }

			{include file="views/generators/components/datalist.tpl"}
		
		{else if $f.tipo=="select" }

			{include file="views/generators/components/select.tpl"}

		{else if $f.tipo=="select_ajax" }

			{include file="views/generators/components/select_ajax.tpl"}

		{else if $f.tipo=="select_multiple" }

			{include file="views/generators/components/select_multiple.tpl"}

		{else if $f.tipo=="listas_dependientes" }

			{include file="views/generators/components/listas_dependientes.tpl"}

		{else if $f.tipo=="dual_listbox" }

			{include file="views/generators/components/dual_listbox.tpl"}

		{else if $f.tipo=="estrellas" }

			{include file="views/generators/components/estrellas.tpl"}

		{else if $f.tipo=="radio" }
	
			{include file="views/generators/components/radio.tpl"}

    	{else if $f.tipo=="checkbox" }
    		
    		{include file="views/generators/components/checkbox.tpl"}

		{else if $f.tipo=="oculto" }
			
			{include file="views/generators/components/oculto.tpl"}

		{else if $f.tipo=="mapa" }

			{include file="views/generators/components/mapa.tpl"}

		{else if $f.tipo=="uploadfile" }

			{include file="views/generators/components/uploadfile.tpl"}

		{else if $f.tipo=="colorpicker" }

			{include file="views/generators/components/colorpicker.tpl"}

		{/if}


			
		</div>
		{if $f.col|default:""!=""} </div>{/if}
	{/if}
{/foreach}

<input type="hidden" name="id_tabla" id="id_tabla" value="{$d.ID_T|default:''}"></input>







<script type="text/javascript">
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	}); 

	//Se recorren los campos
	{foreach key=key item=f from=$datosf}

		{if isset($f.campo) && isset($f.info_modal) && $f.info_modal != '' } 	
			function info_modal_{$f.campo}()
			{
				BootstrapDialog.show({
					title: '<b><i class=\'fas fa-info-circle\'></i> Información:</b> {$f.label}',
					message: '{$f.info_modal}',
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
		{/if}

	{/foreach}

	
/*
	$("#btnguardar").click(function() {
		guardar('{$_layoutParams.root}{$controlador}');
	});

*/
{if $ventana_modal|default:"" != true}
	{$codigoJS|default:''}
{/if}


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

</script>