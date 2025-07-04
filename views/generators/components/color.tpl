			{if $f.icon|default:""!=""}
			<div class="input-group">
			<div class="input-group-addon">
			<i class="fa fa-{$f.icon}"></i>
			</div>
			{/if}
			
			<div class="input-group">
			<input  maxlength="7" class="form-control" type="color" name="{$f.campo}" id="{$f.campo}" placeholder="{$f.holder|default:''}"  
	        
	        {if $literal|default:'' == 1}
				{literal} value="{$info.{/literal}{$f.campo|default:'-'}{literal}|default:''}" {/literal}
	        {else}
				value="{$d[$f.campo]|default:$f.value|default:'#000000'}"   
			{/if}

			{$f.detalles|default:""}
			
			{if isset($f.max) } maxlength="{$f.max}" {/if}
			{if isset($f.pattern) } pattern="{$f.pattern}" {/if}
			
			{if isset($f.readonly) && $f.readonly=="true"} readonly {/if}
			{if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
			{if isset($f.required) && $f.required== "true"} required="required" {/if}

			/>






			  <div class="input-group-append">
					<!--INPUTS Y BOTONES-->
					<button class="btn btn-outline-secondary" type="button" id="btn_{$f.campo}_switch"><i class="fa fa-retweet"></i></button>
			  </div>
			</div>

			
			
			
			{if $f.icon|default:""!=""}</div>{/if}


			<script>
//SCRIPT
$('#btn_{$f.campo}_switch').click(function() {
	
	if($('#{$f.campo}').attr('type')==='text')
		$('#{$f.campo}').attr("type","color");
	else
		$('#{$f.campo}').attr("type","text");

});


</script>
