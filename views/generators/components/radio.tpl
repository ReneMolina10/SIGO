
			<div style="clear: both;">
			{foreach key=key item=d from=$f.datos}
    			<input class="form-check-input" type="radio" id="{$d.CAMPO}" name="{$d.CAMPO}" value="{$d}" checked>{$d.CAMPO}<br>
    		{/foreach}
    		</div>