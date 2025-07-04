{if $f.icon|default:""!=""}
	<div class="input-group">
	<div class="input-group-addon">
	<i class="fa fa-{$f.icon}"></i>
	</div>
{/if}

<select class="form-control {$f.class}" name="{$f.campo}" id="{$f.campo}" style="width:100%" 
{if isset($f.required) && $f.required== "true"} required="required" {/if}>

</select>

{if $f.icon|default:""!=""}</div>{/if}

<script type="text/javascript">
	
	$(document).ready(function(){ 
		$("#{$f.campo}").select2({
			language: 'es',
			theme: 'bootstrap4',
			placeholder: "Seleccione...",
			//allowClear: true,	
  			minimumInputLength: 1,  			
			ajax: { 
				url: '{$BASE_URL}{$controlador}/get_datos_select_ajax/{$f.campo}/',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
					  palabra: params.term // search term
					};
				},
				processResults: function (response) {
					return {
					    results: response
					};
				},
				//error: function(xhr) {  }, //no se usa, porque el selec_ajax cancela peticiones conforme vas escribiendo y las cancelaciones entran como error
			   	cache: true
			},
		});

		var pat = '{$BASE_URL}{$controlador}/infosearch_selectajax/{$f.campo}/{$d[$f.campo]|default:""}/';
		load_info_select_ajax(pat,'{$f.campo}');
	});

	banderaSelectGenerator = true;


	 
</script>

