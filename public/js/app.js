
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

function guardar_generator(path, reload_list = false, formId = 'formp')
{
	var formData = new FormData( $('#' + formId)[0] );
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
			$("#btnguardar").html('Guardando...');
			$( "#btnguardar" ).prop( "disabled", true );
			$("div#divLoading").addClass('show');
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

			$("#btnguardar").html('Guardar');
			$( "#btnguardar" ).prop( "disabled", false );
			$("div#divLoading").removeClass('show');
		},
		complete: function() {
			//$(placeholder).removeClass('loading');
			//alert("completo");
		},
		success:  function (response) {
			if(response.id != 'undefined' ){				
				var valores = "";
				$.each(response.id,function(index, value){
					// console.log('My array has at position ' + index + ', this value: ' + value);
					$("#"+index).val(value);
					valores = valores + " | " + value;
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
				if(reload_list){
					var tabla = !!document.getElementById("grid");
					if(tabla) 
						traer_conceptos();
					else 
						location.reload();			
				}
				$("#btnguardar").html('Guardar');
				$( "#btnguardar" ).prop( "disabled", false );
				$("div#divLoading").removeClass('show');

			}else{
				cuadrodialogo(response.id+"Error","No se pudo guardar <br/> Error: "+response.msg, "Aceptar");
			}
		}

	});				
}


function eliminar_reg_generator(path,id, nombre){
	BootstrapDialog.show({
		title: '¡Advertencia!',
		message: '¿Está seguro de eliminar "<b>' + nombre +' '+ id + '</b>"?',
		type: BootstrapDialog.TYPE_WARNING,
		buttons: [{
			icon: 'glyphicon glyphicon-trash',
			label: ' Eliminar',
			cssClass: 'btn-warning',
			action: function(dialogItself){
				$.ajax({
						data:  'id='+id,
						url:   path+'/eliminar/'+id,
						type:  'post',
						scriptCharset:"utf-8",
						dataType: "json",
						beforeSend: function () {
							//$("#mensaje").html('Guardando...');
						},
						error: function(xhr) {
	        				//alert("Error al eliminar: "+ xhr.statusText +": " + xhr.responseText);
							cuadrodialogo("Error en respuesta","No se pudo eliminar "+nombre+" "+id+"<br/> Error: ("+xhr.statusText +")  " + xhr.responseText, "Aceptar");
	    				},
						complete: function() {
	        				//$(placeholder).removeClass('loading');
	        				//alert("completo");
	    				},
						success:  function (response) {
						    if(response.status==1){

						    	try {
								  var oTable = $('#grid').dataTable();
									  oTable.fnDeleteRow( "#fila_id_"+id);
								} catch (error) {
								  //console.error(error);
								  $('#fila_'+id).remove();

								}

						    	
								//$("#fila_id_"+id).remove();
								cuadrodialogoExito("Mensaje", '<i class="far fa-check-circle fa-2x pr-2" style="color: #4caf50;"></i> Se eliminó con éxito '+nombre+' '+id, "Aceptar");
						    }else{
						    	cuadrodialogo("Error","No se pudo eliminar "+nombre+" "+id+"<br/> Error: ("+response.msg, "Aceptar");
							}
						}

				});				
				dialogItself.close();
				//window.location="{$_layoutParams.root}menu/eliminar/" + id;
			}
		}, {
			label: 'Cancelar',
			action: function(dialogItself){
				dialogItself.close();
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
  nameCrudTable = ''
) {
  // 1) Título y botón
  $('#tit_modal_edit').html(
    '<i class="fas fa-pencil-alt"></i> Registrar ' + singular
  );
  $('#btnguardar').show();

  // 2) AJAX para traer el form
  $.ajax({
    type: 'POST',
    url: editUrl,
    data: {
      id_reg:           idReg,
      id_idioma:        idIdioma,
      duplicar:         duplicar,
      filtro:           filtro,
      name_crud_table:  nameCrudTable
    },
    beforeSend: function() {
      $('div#divLoading').addClass('show');
    },
    success: function(response) {
      $('#formulario').html(response);
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
  $('#id_reg').val(idReg);
  $('#modal_formulario').modal({ focus: false });
}
