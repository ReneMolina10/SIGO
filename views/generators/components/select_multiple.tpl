{if $f.icon|default:""!=""}
	<div class="input-group">
	<div class="input-group-addon">
	<i class="fa fa-{$f.icon}"></i>
	</div>
{/if}

<!--
f = array
d = datos
-->
<select  id="{$f.campo}" multiple="multiple" class="form-group {$f.class}" name="{$f.campo}[]" style="width:100%" data-placeholder="{$f.holder}"
{if isset($f.required) && $f.required== "true"} required="required" {/if}
>
	{foreach key=key item=c from=$f.datos}
		<option value="{$c.ID}"  {if $d[$f.campo][$c.ID]|default:'' == 1} selected {/if} >{$c.CAMPO}</option>
	{/foreach}
</select>

{if $f.icon|default:""!=""}</div>{/if}

{if isset($f.datosSQL) }

<script type="text/javascript">
	//$(function() { 
//load_op('{$BASE_URL}{$controlador}/op/{$f.table}','{$f.campo}','{$f.holder}'); }); 

	$(document).ready(function(){ 
		$("#{$f.campo}").select2({
			//tags: true,
			theme: 'bootstrap4',
			placeholder: "Seleccione...",
			language: 'es',
			//allowClear: true,			
		});
	});

	banderaSelectGenerator = true;
</script>

{/if}