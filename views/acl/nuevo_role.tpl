<div class="box box-primary">
	
            <div class="box-header with-border">
			
<div  class="pull-left"><h2>Nuevo role</h2> </div>
<div class=" pull-right">
</div>
</div>
<div class="box-footer">


<form name="form1" method="post" action="">
    <input type="hidden" value="1" name="guardar">
    
    <table class="table table-bordered" style="width: 350px;">
        <tr>
            <td style="text-align: right;">Role: </td>
            <td><input type="text" name="role" value="{$datos.role|default:""}"></td>
        </tr>
    </table>
        
    <p><a href="{$_layoutParams.root}acl/roles" class="btn"> Salir</a> <button type="submit" class="btn btn-primary"> Guardar</button></p>
</form>
</div>
</div>