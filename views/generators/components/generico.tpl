			{if $f.icon|default:""!=""}
			<div class="input-group">
			<div class="input-group-addon">
			<i class="fa fa-{$f.icon}"></i>
			</div>
			{/if}
			
			
			<input  class="form-control" type="{$f.tipo}" name="{$f.campo}" id="{$f.campo}" placeholder="{$f.holder|default:''}" 
	        
	        {if $literal|default:'' == 1}
				{literal} value="{$info.{/literal}{$f.campo|default:'-'}{literal}|default:''}" {/literal}
	        {else}
				value="{$d[$f.campo]|escape:html|default:$f.value|default:''}"   
			{/if}

			{$f.detalles|default:""}
			
			{if isset($f.max) } maxlength="{$f.max}" {/if}
			{if isset($f.pattern) } pattern="{$f.pattern}" {/if}
			
			{if isset($f.readonly) && $f.readonly=="true"} readonly {/if}
			{if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
			{if isset($f.required) && $f.required== "true"} required="required" {/if}

			/>
			
			
			
			{if $f.icon|default:""!=""}</div>{/if}