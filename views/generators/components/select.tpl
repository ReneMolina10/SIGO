{if $f.icon|default:""!=""}
	<div class="input-group">
	<div class="input-group-addon">
		<i class="fa fa-{$f.icon|default:""}"></i>
	</div>
{/if}

<select  id="{$f.campo|default:""}"  class="form-control {$f.class|default:""}" name="{$f.campo|default:""}" style="width:100%"
	{if isset($f.disabled) && $f.disabled== "true"} disabled {/if}
	{if $f.required|default:"false" == "true"} required  {/if} 

>





	{if $literal|default:'' == 1}			
		{literal}{$opciones_campo_{/literal}{$f.campo|default:""}}
    {else} 
		{foreach key=key item=c from=$f.datos|default:"" }

			<option {if $d[$f.campo]|default:""==$c.ID} selected {/if} value="{$c.ID|default:""}">{$c.CAMPO|default:""}</option>
		{/foreach}  
	{/if}
	
</select>

{if $f.icon|default:""!=""}</div>{/if}

<script type="text/javascript">

	{if isset($f.campo_dependencia) && $f.campo_dependencia!= "false" && $f.campo_dependencia!= ""}  
		{*Asigno nombre a la función*}
		{assign var="nombre_function_que_trae_lista" value="traer_lista_{$f.campo|default:""}"}

		$("#{$f.campo_dependencia}").change(function() {  // bind a change event:
	      {$nombre_function_que_trae_lista}();
	    }).change();

		function {$nombre_function_que_trae_lista}(){
			var value_campo_depende = $("#{$f.campo_dependencia}").val().replace(" ","_");
			//alert(value_campo_depende);
			$.ajax({
			  //data:  'x='+x+'&x='+x+'&x='+x,
			  url: '{$BASE_URL}{$controlador}/get_lista_dependiente/{$f.campo|default:""}/'+value_campo_depende+'/{$d[$f.campo]|default:""}/', 
			  type:  'post',
			  scriptCharset:"utf-8",
			  beforeSend: function () {
			    $("div#divLoading").addClass('show');
			    //$("#mensaje").html('Guardando...');			    
			  },
			  success:  function (response) {       
			    $( "#{$f.campo}" ).html(response).change();
			    $("div#divLoading").removeClass('show');                            
			  }
			});		
		}
	{/if}


		
	{if !isset($f.disabled) || $f.disabled == "false"}
		$(document).ready(function(){ 


			var id = '#{$f.campo|default:""}';
			var tries = 0;

			//inicializar Select2 cuando el <select> ya exista en el DOM del modal (porque en los generators hijos el <script> se ejecuta antes de que se inserte (se tiene que solucionar esto)).
			(function wait(){
				var $el = $(id);
				//console.log('[S2] wait try=' + tries + ' exists=' + $el.length);
				if ($el.length) {
					if (typeof $.fn.select2 === 'function' && !$el.hasClass('select2-hidden-accessible')) {
						var $parent = $el.closest('.modal');
						$el.select2({
							theme: 'bootstrap4',
							placeholder: 'Seleccione...',
							language: 'es',
							width: '100%',
							dropdownParent: $parent.length ? $parent : $(document.body)
						});
						//console.log('[S2] init done');
					}
					return;
				}
				if (++tries < 20) setTimeout(wait, 50); //50 ms, reintenta hasta ~1s
			})();


			/*anterior*/
			// $("#{$f.campo|default:""}").select2({
			// 	theme: 'default',
			// 	/*placeholder: {
			// 	    id: '0', // the value of the option
			// 	    text: 'Seleccione una opción'
			// 	},*/
			// 	placeholder: "Seleccione...",
			// 	language: 'es',
			// 	//allowClear: true,			
			// });
	






		 });

		


		banderaSelectGenerator = true;
	{/if}
	
</script>

