<p class="clasificacion"> 
<input id="{$f.campo}_1" type="radio" name="{$f.campo}" value="5" {if $d[$f.campo]|default:""==5} checked="checked" {/if}>
<label for="{$f.campo}_1">&#9733;</label>
<input id="{$f.campo}_2" type="radio" name="{$f.campo}" value="4" {if $d[$f.campo]|default:""==4} checked="checked"  {/if}>
<label for="{$f.campo}_2">&#9733;</label>
<input id="{$f.campo}_3" type="radio" name="{$f.campo}" value="3" {if $d[$f.campo]|default:""==3} checked="checked"  {/if}>
<label for="{$f.campo}_3">&#9733;</label>
<input id="{$f.campo}_4" type="radio" name="{$f.campo}" value="2" {if $d[$f.campo]|default:""==2} checked="checked"  {/if}>
<label for="{$f.campo}_4">&#9733;</label>
<input id="{$f.campo}_5" type="radio" name="{$f.campo}" value="1" {if $d[$f.campo]|default:""==1} checked="checked"  {/if}>
<label for="{$f.campo}_5">&#9733;</label>
</p>