{* {if $detalles|default:""!="readonly"} *}
			<input type="hidden" name="{$f.campo}" id="{$f.campo}" value="{$d[$f.campo]|default:$f.valor|default:$f.value|default:''}"></input>
{* {else} 
			<label for="{$f.campo}"><span style="text-transform: capitalize;"> {$f.campo}: </span></label>
			<input type="text" class="form-control"  name="{$f.campo}" id="{$f.campo}" value="{$d[$f.campo]|default:''}" readonly></input>
{/if} *} 