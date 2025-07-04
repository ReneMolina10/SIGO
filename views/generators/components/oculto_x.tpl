{* {if $detalles|default:""!="readonly"} *}
			<input type="hidden" name="{$f.campo|default:""}" id="{$f.campo|default:""}" value="{$d[$f.campo]|default:$f.valor|default:""}"></input>
{* {else} 
			<label for="{$f.campo|default:""}"><span style="text-transform: capitalize;"> {$f.campo|default:""}: </span></label>
			<input type="text" class="form-control"  name="{$f.campo|default:""}" id="{$f.campo|default:""}" value="{$d[$f.campo]|default:''}" readonly></input>
{/if} *}