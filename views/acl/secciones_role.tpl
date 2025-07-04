<script>

function guardar(){
document.formp.submit();


	$.ajax({
                /*data:  $('#formp').serialize(),*/
				 data:  $('#formp').serialize(),
                url:   '{$_layoutParams.root}acl/guardar_seccion_rol/',
                type:  'post',
				/*scriptCharset: "ISO-8859-1",*/
				scriptCharset:"utf-8",
                beforeSend: function () {
                    $("#mensaje").html('Guardando...');
                },
                success:  function (response) {
                    $("#mensaje").html('');
					$("#idseccion").val(response);
					if(!isNaN(response)){
					   //$("#mensaje").html("Configuraci&oacute;n guardada:"+response);
						BootstrapDialog.show({
							title: 'Mensaje de salida',
							message: 'Secci&oacute;n guardada',
							buttons: [{
								id: 'btn-ok',
								//icon: 'glyphicon glyphicon-check',
								label: 'OK',
								cssClass: 'btn-primary',
								autospin: false,
								action: function(dialogRef)
								{
									dialogRef.close();
								}
							}]
						});
					}else{
						//$("#mensaje").html("Error: "+response);
						BootstrapDialog.show({
							title: 'Mensaje de salida',
							message: "Error: "+response,
							buttons: [{
								id: 'btn-ok',
								//icon: 'glyphicon glyphicon-check',
								label: 'OK',
								cssClass: 'btn-primary',
								autospin: false,
								action: function(dialogRef)
								{
									dialogRef.close();
								}
							}]
						});
						
					}
                }
        });	
		
}

function guardarSalir(idGrupo, ididioma){
	guardar()
	window.location="{$_layoutParams.root}acl/roles/";

}

</script>

<form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp" name="formp" action="javascript:guardar()" method="post" >



<div class="box box-primary">
	
            <div class="box-header with-border">
			
<div  class="pull-left"><h2>Asignar secciones a {$rol} </h2> </div>

</div>
<div class="box-footer">


<div class="form-group">
     <label>Secciones para editar:</label>
     <select id="secceditar" name="secceditar[]" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Seleccione una o varias secciones" style="width: 100%;" tabindex="-1" aria-hidden="true">
{$roles_edicion}
     </select>
 </div>

<div class="form-group">
     <label>Secciones para visualizar:</label>
     <select id="seccvisualiza" name="seccvisualiza[]" class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Seleccione una o varias secciones" style="width: 100%;" tabindex="-1" aria-hidden="true">
{$roles_prev}
     </select>
 </div>
 <input name="idrole" type="hidden" value="{$id|default:""}"



            <p>
                <a class="btn" href="{$_layoutParams.root}acl/roles/">Salir</a>
                <button type="button" onClick="formp.submit()" class="btn btn-primary">Guardar</button>
                <button type="button" onClick="guardarSalir();" class="btn btn-primary">Guardar y salir</button>
            </p>
			 </form>
			


</div>
</div>