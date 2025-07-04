<script>


function eliminar(id, nombre){
	BootstrapDialog.show({
		title: 'Advertencia:',
		message: 'Quiere eliminar la secci&oacute;n <b>' + nombre + '</b>?',
		buttons: [{
			icon: 'glyphicon glyphicon-trash',
			label: ' Eliminar',
			action: function(dialogItself){
				$.ajax({
						data:  'id='+id,
						url:   '{$_layoutParams.root}acl/eliminar_seccion/',
						type:  'post',
						scriptCharset:"utf-8",
						beforeSend: function () {
							//$("#mensaje").html('Eliminando...');
						},
						success:  function (response) {
						    if(!isNaN(response)){
								$("#fila_"+id).remove();
						    }else{
								BootstrapDialog.show({
									title: 'Error',
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
				dialogItself.close();
			}
		}, {
			label: 'Cancelar',
			action: function(dialogItself){
				dialogItself.close();
			}
		}]
	});
}



</script>

<div class="box box-primary">
	
            <div class="box-header with-border">
			
<div  class="pull-left"><h2>Administraci&oacute;n de Secciones</h2> </div>
<div class=" pull-right">

<a class="btn btn-primary" href="{$_layoutParams.root}acl/editar_seccion"><i class="icon-plus-sign icon-white"> </i> Agregar Secci&oacute;n</a>


</div>
</div>
<div class="box-footer">



{if isset($secciones) && count($secciones)}
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th>ID</th>
            <th>Secci&oacute;n</th>
            <th>Descripci&oacute;n</th>
<th width="90"></th>
        </tr>
        
        {foreach item=rl from=$secciones}
            <tr id="fila_{$rl.id}">
                <td>{$rl.id}</td>
                <td>{$rl.denominacion}</td>
                <td>{$rl.descripcion}</td>
                <td><a class="btn btn-sm btn-default" href="{$_layoutParams.root}acl/editar_seccion/{$rl.id}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> 

<a class="btn btn-default dropdown-toggle" onclick="eliminar({$rl.id}, '{$rl.denominacion}')">
                         <span class="glyphicon glyphicon-trash"></span>
                        </a> </td>
            </tr>
        {/foreach}
    </table>
{/if}


</div>
</div>