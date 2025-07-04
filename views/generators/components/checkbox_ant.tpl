<div >
{foreach key=key item=dt from=$f.datos}
	<div style="margin: 5px 0 5px 0;font-size: 15px;">
	<input class="flat-red" 
	type="checkbox" id="{$f.campo}_{$dt.ID}" name="{$f.campo}[]" value="{$dt.ID}" {if $d[$f.campo][$dt.ID]|default:'' == 1} checked {/if}> <label for="{$f.campo}_{$dt.ID}" style="font-weight: normal;"> {$dt.CAMPO} 
	</label>
</div>
{/foreach}
	</div>