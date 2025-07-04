{if $f.icon|default:""!=""}
				<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-{$f.icon}"></i>
				</div>
			{/if}

			<input class="form-control" list="{$f.campo}" name="{$f.campo}" placeholder="{$f.holder}"{$detalles|default:""}>
  				<datalist id="{$f.campo}">
  					{foreach key=key item=c from=$f.datos}
    					<option 
    				    {if $d[$f.CAMPO]|default:""==$c.CAMPO} selected {/if}
    					value="{$c.CAMPO}">
    				{/foreach}
  				</datalist>

  			{if $f.icon|default:""!=""}</div>{/if}