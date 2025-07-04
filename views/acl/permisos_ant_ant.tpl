<div class="box box-primary">
	
            <div class="box-header with-border">
			
<div  class="pull-left"><h2>Administración de permisos</h2> </div>

</div>
<div class="box-footer">




{if isset($permisos) && count($permisos)}
<table class="table table-bordered table-condensed table-striped" style="width:500px;">
    <tr>
        <th>ID</th>
        <th>Permiso</th>
        <th>Llave</th>
    </tr>
    
    {foreach item=rl from=$permisos}
    
        <tr>
            <td>{$rl.id_permiso}</td>
            <td>{$rl.permiso}</td>
            <td>{$rl.key}</td>        </tr>
        
    {/foreach}
    
</table>
{/if}

<p><a href="{$_layoutParams.root}usuarios" class="btn"><i class="icon-plus-sign icon-white"> </i> Regresar a listado de usuarios </a> <a href="{$_layoutParams.root}acl/nuevo_permiso" class="btn btn-primary"><i class="icon-plus-sign icon-white"> </i> Agregar Permiso</a></p>

</div>
</div>