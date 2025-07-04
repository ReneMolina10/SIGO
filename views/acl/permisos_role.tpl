<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1 class="m-0">Administracion de permisos de role</h1>
        </div><!-- /.col -->
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item"><a href="{$_layoutParams.root}">Inicio</a></li>-->
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


<div class="card">
	<div class="card-header">
	  <div class="row">
		<div  class="col-sm-8"> <h5 style="margin:0px;">Role: {$role.role}</h5> </div>
		<!--<div class="col-sm-4 text-right">  
			<a class="btn btn-sm btn-success" href="{$_layoutParams.root}acl/nuevo_role">+ Agregar Rol</a>
		</div>-->
	  </div>
	</div>
  
	<div class="card-body "> 


        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item waves-effect waves-light">
              <a class="nav-link active" id="modulos-tab" data-toggle="tab" href="#modulos" role="tab" aria-controls="modulos" aria-selected="true">Modulos</a>
            </li>
            <li class="nav-item waves-effect waves-light">
              <a class="nav-link" id="generators-tab" data-toggle="tab" href="#generators" role="tab" aria-controls="generators" aria-selected="false">Generators</a>
            </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
                <form name="form1" id="form1" method="post" action="">
                    {if isset($permisos) && count($permisos)}
                        <table class="table table-bordered table-condensed table-striped" style="width: ;">
                            <tr>
                                <th>Permiso</th>
                                <th style="text-align: center;">Habilitado</th>
                                <th style="text-align: center;">Denegado</th>
                                <th style="text-align: center;">Sin especificar</th>
                            </tr>
                            {foreach item=pr from=$permisos}
                                <tr>
                                    <td>{$pr.nombre}</td>
                                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="1" {if ($pr.valor == 1)}checked="checked"{/if}/></td>
                                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="" {if ($pr.valor == '0')}checked="checked"{/if}/></td>
                                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="x" {if ($pr.valor === "x")}checked="checked"{/if}/>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                    <p>    	
                        <input type="hidden" name="rol" value="{$role.id_role}" />
                        <a class="btn" href="{$_layoutParams.root}acl/roles/">Salir</a>
                        <button type="button" class="btn btn-primary"  onclick="guardar_permisos_modulos()"><i class="icon-ok icon-white"> </i> Guardar</button>
                    </p>
                </form>
            </div>
            <div class="tab-pane fade" id="generators" role="tabpanel" aria-labelledby="generators-tab">
                <form name="form2" id="form2" method="post" action="">
                    {if isset($permisos_generators_rol) && count($permisos_generators_rol)}
                        <table class="table table-bordered table-condensed table-striped" style="width: ;">
                                <tr>
                                    <th>Generator</th>
                                    {foreach item=permiso from=$permisosGenerators}
                                        <th style="text-align: center;">{$permiso.permiso}</th>
                                    {/foreach}
                                </tr>
                            {foreach key=generator item=permisos from=$permisos_generators_rol}
                                <tr>
                                    <td>{$generator}</td> 
                                    {foreach item=permiso from=$permisosGenerators}
                                        <td style="text-align: center;"><input type="checkbox" name="permiso[{$generator}][]" value="{$permiso.id_permiso}" {if {$permisos[$permiso.id_permiso]} == 1}checked="checked"{/if}/></td>
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                    <p>    	    
                        <input type="hidden" name="rol" value="{$role.id_role}" />                    
                        <a class="btn" href="{$_layoutParams.root}acl/roles/">Salir</a>
                        <button type="button" class="btn btn-primary" onclick="guardar_permisos_generators()"><i class="icon-ok icon-white"> </i> Guardar</button>
                    </p>
                </form>	
            </div>
        </div>

    </div> <!-- card body -->
</div>



<script>
function guardar_permisos_modulos()
{
    guardar_permisos('acl/guardar_permisos_modulos/', 'form1');
}
function guardar_permisos_generators()
{
    guardar_permisos('acl/guardar_permisos_generators/', 'form2');
}

function guardar_permisos(path, form)
{
	$.ajax({
			data:  $('#'+form).serialize(),
			url:   '{$_layoutParams.root}'+path,
			type:  'post',
			scriptCharset:"utf-8",
			dataType: "json",
			beforeSend: function () {
				$("#btnguardar").html('Guardando...');
				$( "#btnguardar" ).prop( "disabled", true );
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
	    	},
			complete: function() {
				//$(placeholder).removeClass('loading');
				//alert("completo");
			},
			success:  function (response) {
			    if(response.id!= 'undefined' ){
					var valores = "";
					/*$.each(response.id,function(index, value){
					   // console.log('My array has at position ' + index + ', this value: ' + value);
					   $("#"+index).val(value);
					   valores = valores + " | " + value;
					});*/
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
                      //title: 'Éxito al guardar: Id '+ valores
                      title: 'Éxito al guardar'
					}) 

					//$("#btnguardar").html('Guardar');
				    $( "#btnguardar" ).prop( "disabled", false );

			    }else{
			    	cuadrodialogo(response.id+"Error","No se pudo guardar <br/> Error: "+response.msg, "Aceptar");
				}
			}

	});				
}

/*function cuadrodialogo(titulo, texto, boton)
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
}*/
</script>