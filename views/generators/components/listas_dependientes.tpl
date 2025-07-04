{if $f.icon|default:""!=""}
	<div class="input-group">
	<div class="input-group-addon">
	<i class="fa fa-{$f.icon}"></i>
	</div>
{/if}

<select  id="{$f.campo}"  class="form-control" name="{$f.campo}" style="width:100%" onchange=""
	{if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
	{if isset($f.required) && $f.required== "true"} required="required" {/if}
	>
	<option  value="">Seleccione</option>

	{if $literal|default:'' == 1}			
		{literal}{$opciones_campo_{/literal}{$f.campo}}
    {else}
		{*{foreach key=key item=c from=$f.datos}
			<!--<option {if $d[$f.campo]|default:""==$c.ID} selected {/if} value="{$c.ID}">{$c.CAMPO}</option>-->
		{/foreach}  *}
	{/if}
	
</select>

<script type="text/javascript">
	{*Asigno nombre a la función*}
	{assign var="nombre_function_que_trae_lista" value="traer_lista_{$f.campo}"}

	/*$("#{$f.campo_dependencia}").on('change', function() {
		alert("campo {$nombre_function_que_trae_lista}");
		{$nombre_function_que_trae_lista}();
	});*/

	$("#{$f.campo_dependencia}").change(function() {  // bind a change event:
		//alert("campo {$nombre_function_que_trae_lista}");
      {$nombre_function_que_trae_lista}();
    }).change();

    //document.getElementById("{$f.campo_dependencia}").addEventListener("change", {$nombre_function_que_trae_lista}());

	/*$(document).ready(function(){ 		
		{$nombre_function_que_trae_lista}();
	});*/

	function {$nombre_function_que_trae_lista}(){
		//var id = $("#{$f.campo_dependencia}").val();
		var value_campo_depende = $("#{$f.campo_dependencia}").val().replace(" ","_");
		//alert(value_campo_depende);

		//if(value_campo_depende){
			$.ajax({
			  //data:  'xx='+xx+'&xx='+xx+'&xx='+xx,
			  url: '{$BASE_URL}{$controlador}/get_lista_dependiente/{$f.campo}/'+value_campo_depende+'/{$d[$f.campo]|default:""}/', 
			  type:  'post',
			  scriptCharset:"utf-8",
			  beforeSend: function () {
			    $("div#divLoading").addClass('show');
			    //$("#mensaje").html('Guardando...');
			    
			  },
			  success:  function (response) {  
			  //console.log(response);     
			    $( "#{$f.campo}" ).html(response).change();
			    $("div#divLoading").removeClass('show');                            
			  }
			});
		//}
	}



	{if !isset($f.disabled) || $f.disabled == "false"}
	/*rtdrt*/
		$(document).ready(function(){ 
			$("#{$f.campo}").select2({
				theme: 'bootstrap4',
				placeholder: "Seleccione...",
				language: 'es',
				//allowClear: true,			
			});
		 });
		banderaSelectGenerator = true;
	{/if}
</script>


{if $f.icon|default:""!=""}</div>{/if}

