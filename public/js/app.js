
function load_infosearch(path,campo){
	
	
	$.ajax({
		data:  $('#formp').serialize(),
		url:   path+$('#'+campo).val(),
		type:  'post',
		scriptCharset:"utf-8",
		dataType: "json",
		beforeSend: function () {
			//salert(path);
		},
		error: function(xhr) {
			//cuadrodialogo("Error en respuesta","No se pudo cargar catálogo <b>"+catalogo+"</b> <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
			$("#camposearch_"+campo).html('Error al buscar lugar:'+xhr.statusText +' ' +xhr.responseText);
	    },
		complete: function() {
	    },
		success:  function (response) {
		    if(response.status==1){
		    	//var cad = '<option value="0" selected>'+holder+'</option>'+response.info;
				$("#camposearch_"+campo).html(response.info);
		    }else{
				//cuadrodialogo(response.id+"Error","No se pudo cargar catálogo <b>"+catalogo+"</b> Error: "+response.msg, "Aceptar");
				$("#camposearch_"+campo).html('Lugar NO encontrado');
			}
		}
	});		
}

//Esta función se ejecuta cuando se carga la página y trae la opción seleccionada por el usuarios en el campo de tipo “select ajax” 
function load_info_select_ajax(path,campo){	
	$.ajax({
		data:  $('#formp').serialize(),
		url:   path,
		type:  'post',
		scriptCharset:"utf-8",
		dataType: "json",
		beforeSend: function () {
			$("div#divLoading").addClass('show');
		},
		error: function(xhr) {
			//cuadrodialogo("Error en respuesta","No se pudo cargar catálogo <b>"+catalogo+"</b> <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
			//$("#"+campo).html('Error al buscar lugar:'+xhr.statusText +' ' +xhr.responseText);
	    },
		complete: function() {
			$("div#divLoading").removeClass('show');
	    },
		success:  function (response) {
		    if(response.status==1){
		    	//var cad = '<option value="0" selected>'+holder+'</option>'+response.info;
				//$("#camposearch_"+campo).html(response.info);

				var newOption = new Option(response.text, response.id, false, false);
				$("#"+campo).append(newOption).trigger('change');

		    }else{
				//cuadrodialogo(response.id+"Error","No se pudo cargar catálogo <b>"+catalogo+"</b> Error: "+response.msg, "Aceptar");
				//$("#"+campo).html('Lugar NO encontrado');
			}
		}
	});		
}

function load_table(path,catalogo,holder){ 
	
	$.ajax({
		data:  $('#formp').serialize(),
		url:   path,
		type:  'post',
		scriptCharset:"utf-8",
		dataType: "json",
		beforeSend: function () {
		},
		error: function(xhr) {
			cuadrodialogo("Error en respuesta","No se pudo cargar catálogo <b>"+catalogo+"</b> <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
	    },
		complete: function() {
	    },
		success:  function (response) {
				$("#tabla_"+catalogo).html(response.msg); 
			/*
		    if(response.status==1){
		    	var cad = '<option value="0" selected>'+holder+'</option>'+response.info;
				$("#cat_"+catalogo).html(cad);
		    }else{
				cuadrodialogo(response.id+"Error","No se pudo cargar catálogo <b>"+catalogo+"</b> Error: "+response.msg, "Aceptar");
			}
			*/
		}
	});		
	
}

function load_op(path,catalogo,holder){
	
	
	$.ajax({
		data:  $('#formp').serialize(),
		url:   path,
		type:  'post',
		scriptCharset:"utf-8",
		dataType: "json",
		beforeSend: function () {
			//salert(path);
		},
		error: function(xhr) {
			cuadrodialogo("Error en respuesta","No se pudo cargar catálogo <b>"+catalogo+"</b> <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
	    },
		complete: function() {

	    },
		success:  function (response) {
		    if(response.status==1){
		    	var cad = '<option value="0" selected>'+holder+'</option>'+response.info;
				$("#cat_"+catalogo).html(cad);
		    }else{
				cuadrodialogo(response.id+"Error","No se pudo cargar catálogo <b>"+catalogo+"</b> Error: "+response.msg, "Aceptar");
			}
		}

	});		

}

// $(document).on('submit', '[id^="formp_"]', function(e){
//   e.preventDefault();

//   const $form      = $(this);
//   const path       = $form.data('path');               // "/prueba1/guardar"
//   const reloadList = $form.data('reload') === true;    // true o false
//   const formId     = this.id;                          // "formp_prueba2"

//   // Llamas con tus 3 parámetros:
//   guardar_generator(path, reloadList, formId);
// });


function guardar_generator(path, reload_list = false, formId = 'formp_base', callback = null)
{
	
	const $form   = $('#' + formId);
  	const formData = new FormData($form[0]);
  	const $btn    = $form.find('#btnguardar');
	//var formData = new FormData( $('#' + formId)[0] );
	$.ajax({
		//data:  $('#formp').serialize(),
		data:  formData,
		url:   path+'/guardar/',
		type:  'post',
		scriptCharset:"utf-8",
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		beforeSend: function () {
			$btn.find('#btnguardar').html('Guardando…');
           	$btn.find('#btnguardar').prop('disabled', true);
			$('div#divLoading').addClass('show');
			// $("#btnguardar").html('Guardando...');
			// $( "#btnguardar" ).prop( "disabled", true );
			// $("div#divLoading").addClass('show');
		},
		error: function(xhr) {
			//alert("Error al eliminar: "+ xhr.statusText +": " + xhr.responseText);
			//cuadrodialogo("Error en respuesta","No se pudo guardar <br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 10000,
				timerProgressBar: true,
				onOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})
			Toast.fire({
				icon: 'error',
				title: 'Error '+ xhr.statusText + ' - ' +xhr.responseText
			}) 			

			// $("#btnguardar").html('Guardar');
			// $( "#btnguardar" ).prop( "disabled", false );
			// $("div#divLoading").removeClass('show');
			$btn.find('#btnguardar').html('Guardar');
           	$btn.find('#btnguardar').prop('disabled', false);
      		$('div#divLoading').removeClass('show');
		},
		complete: function() {
			//$(placeholder).removeClass('loading');
			//alert("completo");
		},
		success:  function (response) {
			if (response.id !== undefined) {				
				var valores = "";
				$.each(response.id, function(key, val) {
					const $field = $form.find('[name="'+key+'"],#'+key);
					if ($field.length) {
						$field.val(val);
						valores += ' | ' + val;
					}
				});
				//console.log(response)
				//alert(response.id.PERS_PERSONA);			
				//cuadrodialogo("Mensaje", "Se guardÃ³ con Ã©xito. Id: "+ valores, "Aceptar");
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 5000,
					timerProgressBar: true,
					onOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
				Toast.fire({
					icon: 'success',
					title: 'Éxito al guardar: Id '+ valores
				}) 
				// Sólo recarga la DataTable si reload_list == true
				if (reload_list) {
					// 1) Saco el name_crud_table (e.g. "prueba")
					const name = $form.find('input[name="name_crud_table"]').val();
					// 2) Construyo el id de la tabla (e.g. "tbl_prueba")
					const tableId = 'tbl_' + name;
					console.log("tableId:",tableId);
					console.log('🔄 Recargando DataTable con id:', tableId);

					// 3) Llamo aL helper global
					traer_conceptos(tableId);


					// var tabla = !!document.getElementById("grid");
					// if(tabla) 
					// 	traer_conceptos();
					// else 
					// 	location.reload();			
				}
				// $("#btnguardar").html('Guardar');
				// $( "#btnguardar" ).prop( "disabled", false );
				// $("div#divLoading").removeClass('show');
				$btn.find('#btnguardar').html('Guardar');
           		$btn.find('#btnguardar').prop('disabled', false);
      			$('div#divLoading').removeClass('show');

				// ➊ además inyecto en id_registro:
				const idKey = Object.keys(response.id)[0];
				const newId = response.id[idKey];
				$('#' + formId).find('#id_registro').val(newId);
				// ➊ Ejecutar callback si existe
	        	if (typeof callback === 'function') {
	          	   callback(response);
	          	 }

			}else{
				cuadrodialogo(response.id+"Error","No se pudo guardar <br/> Error: "+response.msg, "Aceptar");
			}
		}

	});				
}

/**
 * Elimina un registro y refresca la DataTable correspondiente (padre o hijo).
 *
 * @param {string} path           Ruta base de tu controlador (sin "/eliminar")
 * @param {number|string} id      ID del registro a eliminar
 * @param {string} nombre         Etiqueta del registro (para el diálogo)
 * @param {string} [nameCrudTable]  Opcional: clave del sub-generator. Si se omite, asume la tabla padre "grid"
 */
function eliminar_reg_generator(path, id, nombre, nameCrudTable = ''){
	BootstrapDialog.show({
		title: '¡Advertencia!',
		message: '¿Está seguro de eliminar "<b>' + nombre +' '+ id + '</b>"?',
		type: BootstrapDialog.TYPE_WARNING,
		buttons: [
		{
			label: 'Cancelar',
			action: function(dialogItself){
				dialogItself.close();
			}
		},{
			icon: 'fas fa-trash-alt',
			label: ' Eliminar',
			cssClass: 'btn-warning',
			action: function(dialogItself){
				$.ajax({
						url:   path+'/eliminar/',
						type:  'post',
						scriptCharset:"utf-8",
						dataType: "json",
						data:  {
							id: id,
							name_crud_table: nameCrudTable  
						},
						beforeSend: function () {
							$('div#divLoading').addClass('show');
							//$("#mensaje").html('Guardando...');
						},
						error: function(xhr) {
	        				//alert("Error al eliminar: "+ xhr.statusText +": " + xhr.responseText);
							cuadrodialogo("Error en respuesta","No se pudo eliminar "+nombre+" "+id+"<br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
	    				},
						complete: function() {
							$('div#divLoading').removeClass('show');
	        				//$(placeholder).removeClass('loading');
	        				//alert("completo");
	    				},
						success:  function (response) {
						    if(response.status==1){
								const tableId = 'tbl_' + nameCrudTable;
								// 1) Cierro el diálogo
								dialogItself.close();
								// 2) Muestro toast de éxito
								Swal.fire({ 
									icon: 'success', 
									title: 'Se eliminó con éxito: ' + nombre + ' ' + id,
									toast: true,
									position: 'top-end',
									showConfirmButton: false,
									timer: 3000
								});

						    	try {
									const dt = $('#' + tableId).DataTable();
									// Asumiendo que tus filas tienen DT_RowId="fila_id_<ID>"
									dt.row('#fila_id_' + id).remove().draw(false);
								} catch (e) {
									// fallback: si no había DataTable inicializada
									$('#fila_id_' + id).remove();
								}

						    	
								//$("#fila_id_"+id).remove();
								//cuadrodialogoExito("Mensaje", '<i class="far fa-check-circle fa-2x pr-2" style="color: #4caf50;"></i> Se eliminó con éxito '+nombre+' '+id, "Aceptar");
						    }else{
						    	cuadrodialogo("Error","No se pudo eliminar "+nombre+" "+id+"<br/> Error: ("+response.msg, "Aceptar");
							}
						}

				});				
				//dialogItself.close();
				//window.location="{$_layoutParams.root}menu/eliminar/" + id;
			}
		}]
	});
}

/*
function eliminar(id_grupo, grupo){
	var mensaje ='¿Está seguro de que desea eliminar la el grupo <b>'+grupo+'</b>?';
	var path = "{$_layoutParams.root}"+"grupos/eliminar_grupo";
  cuadroDialogoEliminar(path, "¡Advertencia!", mensaje, id_grupo,  remover_fila);
  //"remover_fila("+id_grupo+")"
}*/

/*function buscar(path)
{
	var texto = $("#txtbuscar").val().replace(/ /g, "_");
	var texto = remove_accent(texto);
	//alert(texto);
	window.open(path+"/busqueda/"+texto,"_self");
}*/

function remove_accent(str) {var map={'À':'A','Á':'A','Â':'A','Ã':'A','Ä':'A','Å':'A','Æ':'AE','Ç':'C','È':'E','É':'E','Ê':'E','Ë':'E','Ì':'I','Í':'I','Î':'I','Ï':'I','Ð':'D','Ñ':'N','Ò':'O','Ó':'O','Ô':'O','Õ':'O','Ö':'O','Ø':'O','Ù':'U','Ú':'U','Û':'U','Ü':'U','Ý':'Y','ß':'s','à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e','ì':'i','í':'i','î':'i','ï':'i','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o','ù':'u','ú':'u','û':'u','ü':'u','ý':'y','ÿ':'y','Ā':'A','ā':'a','Ă':'A','ă':'a','Ą':'A','ą':'a','Ć':'C','ć':'c','Ĉ':'C','ĉ':'c','Ċ':'C','ċ':'c','Č':'C','č':'c','Ď':'D','ď':'d','Đ':'D','đ':'d','Ē':'E','ē':'e','Ĕ':'E','ĕ':'e','Ė':'E','ė':'e','Ę':'E','ę':'e','Ě':'E','ě':'e','Ĝ':'G','ĝ':'g','Ğ':'G','ğ':'g','Ġ':'G','ġ':'g','Ģ':'G','ģ':'g','Ĥ':'H','ĥ':'h','Ħ':'H','ħ':'h','Ĩ':'I','ĩ':'i','Ī':'I','ī':'i','Ĭ':'I','ĭ':'i','Į':'I','į':'i','İ':'I','ı':'i','Ĳ':'IJ','ĳ':'ij','Ĵ':'J','ĵ':'j','Ķ':'K','ķ':'k','Ĺ':'L','ĺ':'l','Ļ':'L','ļ':'l','Ľ':'L','ľ':'l','Ŀ':'L','ŀ':'l','Ł':'L','ł':'l','Ń':'N','ń':'n','Ņ':'N','ņ':'n','Ň':'N','ň':'n','ŉ':'n','Ō':'O','ō':'o','Ŏ':'O','ŏ':'o','Ő':'O','ő':'o','Œ':'OE','œ':'oe','Ŕ':'R','ŕ':'r','Ŗ':'R','ŗ':'r','Ř':'R','ř':'r','Ś':'S','ś':'s','Ŝ':'S','ŝ':'s','Ş':'S','ş':'s','Š':'S','š':'s','Ţ':'T','ţ':'t','Ť':'T','ť':'t','Ŧ':'T','ŧ':'t','Ũ':'U','ũ':'u','Ū':'U','ū':'u','Ŭ':'U','ŭ':'u','Ů':'U','ů':'u','Ű':'U','ű':'u','Ų':'U','ų':'u','Ŵ':'W','ŵ':'w','Ŷ':'Y','ŷ':'y','Ÿ':'Y','Ź':'Z','ź':'z','Ż':'Z','ż':'z','Ž':'Z','ž':'z','ſ':'s','ƒ':'f','Ơ':'O','ơ':'o','Ư':'U','ư':'u','Ǎ':'A','ǎ':'a','Ǐ':'I','ǐ':'i','Ǒ':'O','ǒ':'o','Ǔ':'U','ǔ':'u','Ǖ':'U','ǖ':'u','Ǘ':'U','ǘ':'u','Ǚ':'U','ǚ':'u','Ǜ':'U','ǜ':'u','Ǻ':'A','ǻ':'a','Ǽ':'AE','ǽ':'ae','Ǿ':'O','ǿ':'o'};var res='';for (var i=0;i<str.length;i++){c=str.charAt(i);res+=map[c]||c;}return res;} 

function cuadrodialogo(titulo, texto, boton)
{
	BootstrapDialog.show({
		  title: "<b>"+titulo+"</b>",
		message: texto,
		buttons: 
		[{
				id: 'btn-ok',
				icon: 'glyphicon glyphicon-check',
				label: " "+boton,
				cssClass: 'btn-primary',
			    autospin: false,
				action: function(dialogRef)
				{
					dialogRef.close();
				}
		}]
	});
}

function cuadrodialogoExito(titulo, texto, boton)
{
	BootstrapDialog.show({
		title: "<b>"+titulo+"</b>",
		message: texto,
		type: BootstrapDialog.TYPE_SUCCESS,
		buttons: 
		[{
				id: 'btn-ok',
				icon: 'glyphicon glyphicon-check',
				label: " "+boton,
				cssClass: 'btn-success',
			    autospin: false,
				action: function(dialogRef)
				{
					dialogRef.close();
				}
		}]
	});
}

function cuadroadvertencia(titulo, texto, boton, campoEnfocar = "")
{
	BootstrapDialog.show({
		title: "<b>"+titulo+"</b>",
		message: texto,
		type: BootstrapDialog.TYPE_WARNING,		
		buttons: 
		[{
				id: 'btn-ok',
				icon: 'glyphicon glyphicon-check',
				label: " "+boton,
				cssClass: 'btn-default',
			    autospin: false,
				action: function(dialogRef)
				{
					dialogRef.close();
				}
		}],
		onhidden: function(dialogRef){
            if(campoEnfocar != ""){
				if(document.getElementById(campoEnfocar))
                	document.getElementById(campoEnfocar).focus();
            }
        }
	});
}

/**
 * @param {number} idReg           ID del registro (0 = nuevo)
 * @param {number} idIdioma        ID de idioma (0 = n/a)
 * @param {number} duplicar        1 = duplicar, 0 = normal
 * @param {string} editUrl         URL para AJAX (incluye filtro y subName en path)
 * @param {string} singular        Texto singular para el título
 * @param {number} filtro          ID del padre (parentId)
 * @param {string} nameCrudTable   Identificador del sub-Generator
 */
function open_modal_to_edit(
  idReg = 0,
  idIdioma = 0,
  duplicar = 0,
  editUrl = '',
  singular = '',
  filtro = 0,
  nameCrudTable = '',
  modalId = 'modal_formulario', 
  formId = 'formp_modal'
) {
	console.log("==",filtro,"==");
	// 1) Clonar el template base y asignar IDs
  	const $base = $('#modal_base');                  // tu <div id="modal_base" style="display:none">…
  	const $clone = $base.clone();
   	const $btn = $clone.find('#btnguardar')
    .attr('type','button')             // ¡muy importante!
    .off('click')                      // limpiamos handlers anteriores
    .on('click', () => {
      // aquí pasamos el “path” correcto a guardar_generator
      const path = editUrl.split('/editar_modal')[0];
      guardar_generator(path, true, formId);
    });

  $clone.find('form').attr('id', formId);

  // 2) Ajustar título y hidden inputs
  $clone.find('#tit_modal_edit').html('<i class="fas fa-pencil-alt"></i> Registrar ' + singular);

  $clone.find('#id_reg').val(idReg);
  $clone.find('input[name="filtro"]').val(filtro);
  $clone.find('#id_registro').val(idReg);   // ← inicializo el campo fijo
  $clone.find('input[name="name_crud_table"]').val(nameCrudTable);

  // 3) AJAX para cargar el formulario en el body del clon
  const $body = $clone.find('.modal-body');

  // 2) AJAX para traer el form
  $.ajax({
    type: 'POST',
    url: editUrl,
    data: {
      id_reg:           idReg,
      id_idioma:        idIdioma,
      duplicar:         duplicar,
      filtro:           filtro,
      name_crud_table:  nameCrudTable,
    },
    beforeSend: function() {
      $('div#divLoading').addClass('show');
    },
    success: function(response) {
      //$('#formulario').html(response);}
	  $body.html(response);
	  $body.find('script').each(function() {
		const code = this.textContent || this.innerHTML;
		// Ejecuta el código en el contexto global
		$.globalEval(code);
		});
    },
    error: function(xhr) {
      modal_danger(
        'Error al cargar formulario',
        'Error: (' + xhr.status + ') ' + xhr.responseText,
        'Aceptar'
      );
    },
    complete: function() {
      $('div#divLoading').removeClass('show');
    }
  });

  // 3) Preparar y abrir modal
  //$('#id_reg').val(idReg);
  //$('#modal_formulario').modal({ focus: false });
  $clone
    .modal({ focus: false })
    .on('hidden.bs.modal', () => {
      $clone.remove();
    });
}


$(document).ready(function(){
    let submitTriggeredByButton = false;
    
    // Marcar cuando el submit es activado por el botón
    $('.prevent-submit').find('input[type="submit"], button[type="submit"]').on('click', function(e){
        submitTriggeredByButton = true;
        //console.log("Botón clickeado - bandera activada");
    });
    
    // Prevenir Enter ANTES de que active el submit
    $('.prevent-submit').on('keydown', function(e){
        if (e.which === 13) {
            //console.log("Enter detectado - previniendo...");
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    });
    
    // Manejar el evento submit
    $('.prevent-submit').on('submit', function(e){
        //console.log("Submit detectado - bandera:", submitTriggeredByButton);
        
        if (!submitTriggeredByButton) {
            e.preventDefault();
            //console.log("Formulario de registro: Envío prevenido por Enter.");
            return false;
        }
        
        // Si llegamos aquí, el submit fue activado por el botón
        //console.log("Formulario enviado por clic en botón");
        
        // Resetear la bandera después del submit exitoso
        submitTriggeredByButton = false;
        
        // Permitir el envío normal del formulario
        return true;
    });
});


const CrudGenerator = (function(){
	
	const configs   = {};
	const tables    = {};
	let   lastTable = null;

	function register(cfg){
		configs[cfg.tableId] = cfg;
		lastTable = cfg.tableId;
		_init(cfg.tableId);
	}

  	function _init(tableId){
		
		const cfg = configs[tableId];
		
		//if(!cfg) return console.error("CrudGenerator: falta cfg para", tableId);
		// Limpia el contenedor de filtros si existe
		const elf = document.getElementById("formf");
		if(elf) elf.innerHTML = "";
		// Si ya existe DataTable, recarga
		// Si ya existe DataTable, verifica si el elemento DOM aún existe
		if(tables[tableId]){
			const element = document.getElementById(tableId);
			if(element && $.fn.DataTable.isDataTable('#' + tableId)) {
				console.log('✅ Tabla ya existe, solo recargando...');
				return tables[tableId].ajax.reload();
			} else {
				// Limpia referencias obsoletas
				delete tables[tableId];
			}
		}	

		// Destruye cualquier instancia previa
		const $tbl = $('#'+tableId);
		//if($tbl.DataTable) $tbl.DataTable().destroy();
		if ($tbl.DataTable) {
			$tbl.DataTable().destroy();
		}
		
		const initialOrder = cfg.checkbox_column ? [1,'desc'] : [0,'desc'];

		// Crea por primera vez
		tables[tableId] = $tbl.DataTable({
			"bPaginate":      cfg.bPaginate,
			"bLengthChange":  true,
			"bFilter":        cfg.bFilter,
			"bSort":          true,
			"bInfo":          cfg.bInfo,
			"bAutoWidth":      true,
			"processing":      true,
			"autoWidth":       true,
			"serverSide":      true,
			"serverMethod":    'post',
			"order":           initialOrder,
			ajax: {
				url:  cfg.rutaBuscar,
				type: 'POST',
				data(d){ 
					d.name_crud_table = cfg.name_crud_table; 
				},
				beforeSend: function(){
					$("div#divLoading").addClass('show');
					$("#btnf").prop("disabled", true).val('Espere un momento por favor...');
				},
				complete: function(){
					$("div#divLoading").removeClass('show');
					$("#btnf").prop("disabled", false).val('Filtrar');
					mostrar_botones_opciones_checkboxes();
					$('input:checkbox[name="id[]"]').click(mostrar_botones_opciones_checkboxes);
					$('input:checkbox[name=select_all]').click(mostrar_botones_opciones_checkboxes);
				},
				error: function(){
					$("div#divLoading").removeClass('show');
					modal_danger("Error","Ha ocurrido un error","Aceptar");
				}
			},
			columns: cfg.columnas.map(c=>({
				 data:c.campo 
			})),
			columnDefs: cfg.columnas.map((col, idx)=>{
				const def = { 
					name: col.campo, 
					targets: idx, 
					className: col.class||'', 
					search:false 
				};
				if(col.tipo==='data'){
					if(col.width) def.width = col.width;
					def.orderable = true;
				} else if(col.tipo==='checkbox_column'){
					def.width      = '5%';
					def.searchable = false;
					def.orderable  = false;
					def.className  = 'dt-body-center';
					def.render     = d=>'<input type="checkbox" name="id[]" value="'+$('<div/>').text(d).html()+'">';
				} else if(col.tipo==='opciones'){
					def.width     = '5%';
					def.orderable = false;
					def.className = 'text-center';
				}
				return def;
			}),
			
			//language:      { url: "https://sigo.uqroo.mx/files/layout/lte2//plugins/datatables_1.10.21/language/Spanish.json" },
			language:      { url: cfg.root+"/files/layout/lte2//plugins/datatables_1.10.21/language/Spanish.json" },
			emptyTable: "No hay registros",
			responsive:    cfg.tablaResponsiva,
			//scrollX:       cfg.tablaScrollX,
			//fixedHeader:   true,
			lengthMenu:    [[10,25,50,100,-1],[10,25,50,100,"Todos"]],
			
			// Cuando se haya inicializado por completo
			initComplete: function(settings,json){
			$('#' + tableId + '_filter input')
				.unbind()
				.bind('keyup', function(e){
				if (e.keyCode === 13) table.search(this.value).draw();
				});
			}
		});

		 // Ya tenemos la instancia
		const table = tables[tableId];


		// Monta los search-boxes
  		set_search_boxes(tableId, cfg);

		// 8) Hook de botones
		$('#btnf')
			.off('click.' + tableId)
			.on ('click.' + tableId, ()=> table.draw());
		$('#btnDescRes')
			.off('click.' + tableId)
			.on ('click.' + tableId, ()=> {
			const params = table.ajax.params();
			window.location.href = cfg.root + cfg.controlador + '/descargar_resultados?datos='
									+ JSON.stringify(params);
			});
		$('#btnDescResScv')
			.off('click.' + tableId)
			.on ('click.' + tableId, ()=> {
			const params = table.ajax.params();
			window.location.href = cfg.root + cfg.controlador + '/descargar_resultados_csv?datos='
									+ JSON.stringify(params);
			});
  	}
	
	function reload(tableId){
		tableId = tableId || lastTable;
		const tbl = tables[tableId];
		if(tbl) tbl.ajax.reload();
		else console.error("CrudGenerator.reload: no existe tabla", tableId);
	}

	return { register, reload };
})();

// Alias para no romper código existente
function traer_conceptos(tableId){
  CrudGenerator.reload(tableId);
}


/**
 * ➋ Registrar hijo con guardado automático del padre
 *
 * @param {string} editUrl        Ruta base para /editar_modal/
 * @param {string} parentFormId   ID del formulario padre (por defecto 'formp')
 * @param {string} nameCrudTable  Identificador del sub‑generator
 * @param {string} singular       Texto singular del hijo para el título del modal
 * @param {string} modalId        ID del modal (opcional)
 * @param {string} childFormId    ID del form del hijo (opcional)
 */
function registrarConHijo(
	btn,
  editUrl,
  nameCrudTable,
  singular,
  childModalId = 'modal_formulario',
  childFormId = 'formp_modal'
) {

  const $btn = $(btn);

  // 1) ¿Hay un formulario padre dentro de un modal abierto?
  //    (Bootstrap usa .modal.show cuando el modal está arriba)
  const $modalPadre = $('.modal.show').find('form[id^="formp_"]').first();

  // 2) Si no, tiro de la forma full‑screen con id="formp"
  const $parentForm = $modalPadre.length
    ? $modalPadre
    : $('#formp');

  if (!$parentForm.length) {
    console.log('No encontré el form padre!');
  }

  const parentFormId = $parentForm.attr('id');
  console.log('parentFormId detectado:', parentFormId);

  // ── Extraigo basePath como antes
  const basePath = editUrl.split('/editar_modal')[0];
  console.log('basePath:', basePath);
 
  // ── 3) Form padre aún no cargado ──
  if (!$parentForm.length) {
    console.log('Rama -1: form padre no cargado');
    if ( editUrl.includes('/editar_modal/') ) {
      // abro modal padre
      open_modal_to_edit(
        0, 0, 0,
        editUrl,
        singular,
        0,
        nameCrudTable,
        childModalId,
        parentFormId
      );
    } else {
      //console.log('Rama -1: form padre no cargado, pero no es modal');
      //return false; // no puedo registrar hijo sin form padre
	  window.location.href = editUrl;
    }
    return false;
  }else{
	console.log("es hijo");
  }

  // 4) El form padre existe, leo su ID fijo
  const parentId = $parentForm.find('#id_registro').val() || '0';
  console.log('parentId (de #id_registro):', parentId);


  // ── 5) Si el padre es nuevo, validar y guardar ──
  if (parentId === '0') {
    console.log('Rama -2: padre nuevo, validando HTML5');
    if (!$parentForm[0].checkValidity()) {
      console.error('HTML5 invalid:', $parentForm[0]);
      $parentForm[0].reportValidity();
      return false;
    }

    console.log('Guardando formulario padre...');
    guardar_generator(
      basePath,
      true,
      parentFormId,
      (response) => {
        console.log('Callback de guardar_generator, response:', response);
        // 6) Extraer dinámicamente el nuevo ID
        const idKey = Object.keys(response.id)[0];
        const newId = response.id[idKey];
        console.log(`Nuevo ID [${idKey}]:`, newId);

        // 7) Recargo tabla de hijos
        const childTableId = 'tbl_' + nameCrudTable;
        const nuevaURL     = `${basePath}/buscar/${newId}`;
        console.log('Recargando DataTable hijos:', childTableId, '→', nuevaURL);
        $('#' + childTableId).DataTable().ajax.url(nuevaURL).load();

        // 8) Abro modal hijo
        const childUrl = `${basePath}/editar_modal/${newId}/${nameCrudTable}`;
        console.log('Abriendo modal hijo:', childUrl);
        open_modal_to_edit(
          0, 0, 0,
          childUrl,
          singular,
          Number(newId),
          nameCrudTable,
          childModalId,
          childFormId
        );
      }
    );

  } else {
    // ── 9) Padre ya existe: recargo hijos y abro hijo ──
    console.log('Rama -3: padre existe (ID=' + parentId + ')');
    const childTableId = 'tbl_' + nameCrudTable;
    const urlBuscar    = `${basePath}/buscar/${parentId}`;
    console.log('Recargando DataTable hijos:', childTableId, '→', urlBuscar);
    $('#' + childTableId).DataTable().ajax.url(urlBuscar).load();

    const childUrl = `${basePath}/editar_modal/${parentId}/${nameCrudTable}`;
    console.log('Abriendo modal hijo rama -3:', childUrl);
    open_modal_to_edit(
      0, 0, 0,
      childUrl,
      singular,
      Number(parentId),
      nameCrudTable,
      childModalId,
      childFormId
    );
  }

  console.log('--- Fin registrarConHijo ---');
  return false;
}
