
<div class="box box-primary">
	
            <div class="box-header with-border">
			
<div  class="pull-left"><h2>Administracion de permisos de role</h2> </div>
<div class=" pull-right">
</div>
</div>
<div class="box-footer">


<p><strong>Role:</strong> {$role.role}</p>

<form name="form1" method="post" action="">
    <input type="hidden" name="guardar" value="1" />
    
    {if isset($permisos) && count($permisos)}
        <table class="table table-bordered table-condensed table-striped" style="width: 500px;">
            <tr>
                <th>Permiso</th>
                <th style="text-align: center;">Habilitado</th>
                <th style="text-align: center;">Denegado</th>
                <th style="text-align: center;">Ignorar</th>
            </tr>
            
            {foreach item=pr from=$permisos}
                <tr>
                    <td>{$pr.nombre}</td>
                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="1" {if ($pr.valor == 1)}checked="checked"{/if}/></td>
                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="" {if ($pr.valor == "")}checked="checked"{/if}/></td>
                    <td style="text-align: center;"><input type="radio" name="perm_{$pr.id}" value="x" {if ($pr.valor === "x")}checked="checked"{/if}/>
                    </td>
                </tr>
            {/foreach}
        </table>
    {/if}
    
    <p><button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"> </i> Guardar</button></p>
</form> 

</div>
</div>