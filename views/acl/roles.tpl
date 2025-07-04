<script>
function eliminar(id, nombre){
	BootstrapDialog.show({
		title: '¡Advertencia!',
		message: '¿Desea eliminar el rol <b>' + nombre + '</b>?',
		buttons: [{
			icon: 'glyphicon glyphicon-trash',
			label: ' Eliminar',
			action: function(dialogItself){
				$.ajax({
						data:  'id='+id,
						url:   '{$_layoutParams.root}acl/eliminar/',
						type:  'post',
						scriptCharset:"utf-8",
						beforeSend: function () {
							//$("#mensaje").html('Guardando...');
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
</script>

<div class="content-header">
	<div class="container-fluid">
	  
	</div>
</div>


<div class="card">
	<div class="card-header">
	  <div class="row mb-2">
		<div  class="col-sm-6"> <h3 style="margin:0px;"> Administración de roles</h3> </div>
		<div class="col-sm-6">  
			<ol class="breadcrumb float-sm-right" style="margin:0px;">
			  <li class="breadcrumb-item"><a href="{$_layoutParams.root}">Regresar</a></li>
			  <li class="breadcrumb-item active">
					<a class="btn btn-sm btn-success" href="{$_layoutParams.root}acl/nuevo_role">+ Agregar Rol</a>
			  </li>
			</ol>
		</div>
	  </div>
	</div>
  
	<div class="card-body ">   
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Role</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
			{foreach item=rl from=$roles}
				<tr id="fila_{$rl.id_role}">
					<td>{$rl.id_role}</td>
					<td>{$rl.role}</td>
					<td>
						<a class="btn btn-sm btn-default"href="{$_layoutParams.root}acl/permisos_role/{$rl.id_role}">Permisos</a>
						<a class="btn btn-sm btn-default"href="{$_layoutParams.root}acl/secciones_role/{$rl.id_role}">Secciones</a>						
						<a class="btn btn-default btn-sm" title="eliminar" onClick="eliminar({$rl.id_role}, '{$rl.role}')">
							<i class="fas fa-trash-alt"></i>
						</a>  
					</td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		
	</div>
  </div>