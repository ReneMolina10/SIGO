
{if $ventana_modal|default:"" != true}
<div id="divLoading"> </div> 
<script  src="{$_layoutParams.root}public/js/app.js" type="text/javascript"></script>
{/if}

<style type="text/css">	
	{$csseditar|default:""}
</style>

{assign var="libJSFinder" value="0"}

{literal}  
<style>
	.clasificacion input[type = "radio"]{ display:none;/*position: absolute;top: -1000em;*/}
	.clasificacion label{ color:grey; margin-bottom: 0px !important; }

	.clasificacion{
	    direction: rtl;
	    unicode-bidi: bidi-override;
	    text-align: left;
	    font-size: 25px;
	    margin: 0px !important;
	}

	.clasificacion label:hover,
	.clasificacion label:hover ~ label{color:orange;}
	.clasificacion input[type = "radio"]:checked ~ label{color:orange;}
</style>
{/literal}



{foreach key=key item=f from=$datosf}

	{if $f.etiq|default:""!=""} 
		{$f.etiq} 
	{else}

		{if $f.col|default:""!=""} <div class="{$f.col}" style="border: 1px solid #ededed;"> {/if}
		<div class="form-group" >
		{if $f.label|default:""!=""}
		<label for="{$f.campo}">{$f.label}: </label>
		{/if}


		{if $f.tipo=="text" || $f.tipo=="datetime-local" || $f.tipo=="telephone" || $f.tipo=="email" || $f.tipo=="color" || $f.tipo=="month" || $f.tipo=="number" || $f.tipo=="range" || $f.tipo=="search" || $f.tipo=="time" || $f.tipo=="url" || $f.tipo=="week" || $f.tipo=="file" || $f.tipo=="date"}
			
			<p>{$d[$f.campo]|default:$f.value} </p>

		{else if $f.tipo=="textarea" }

			<p>{$d[$f.campo]|default:""} </p>

		{else if $f.tipo=="urlfile" }
	
			{include file="views/generators/components/urlfile.tpl"}

			{$libJSFinder=1}

  		{else if $f.tipo=="tabla" }
	
			{include file="views/generators/components/tabla.tpl"}

  		{else if $f.tipo=="examinar" } 

			{include file="views/generators/components/examinar.tpl"}

		{else if $f.tipo=="datalist" }

			{include file="views/generators/components/datalist.tpl"}
		
		{else if $f.tipo=="select" }

			{* “f.datos” es el array de opciones del campo select*}

			{foreach key=key item=c from=$f.datos}
				{if $d[$f.campo]|default:""==$c.ID}
					<p >{$c.CAMPO}</p>
				{/if}
			{/foreach} 

		{else if $f.tipo=="select_ajax" }

			<p id="{$f.campo}"></p>

			<script type="text/javascript">
				var pat = '{$_layoutParams.root}{$controlador}/infosearch_selectajax/{$f.campo}/{$d[$f.campo]|default:""}/';
				load_info_select_ajax(pat,'{$f.campo}');
			</script>

		{else if $f.tipo=="select_multiple" }

			<ul>
			{foreach key=key item=c from=$f.datos}				
				{if $d[$f.campo][$c.ID]|default:'' == 1}
					<li>{$c.CAMPO}</li>
				{/if} 
			{/foreach}
			</ul>
						

		{else if $f.tipo=="listas_dependientes" }

			{include file="views/generators/components/listas_dependientes.tpl"}

		{else if $f.tipo=="dual_listbox" }

			{include file="views/generators/components/dual_listbox.tpl"}

		{else if $f.tipo=="estrellas" }

			{include file="views/generators/components/estrellas.tpl"}

		{else if $f.tipo=="radio" }
	
			{include file="views/generators/components/radio.tpl"}

    	{else if $f.tipo=="checkbox" }
    		
    		{include file="views/generators/components/checkbox.tpl"}

    	{else if $f.tipo=="oculto" }
			
			{include file="views/generators/components/oculto.tpl"}

		{else if $f.tipo=="mapa" }

			{include file="views/generators/components/mapa.tpl"}

		{else if $f.tipo=="uploadfile" }

			{$f.disabled = "true"}
			{include file="views/generators/components/uploadfile.tpl"}

		{/if}


			
		</div>
		{if $f.col|default:""!=""} </div>{/if}
	{/if}
{/foreach}

<input type="hidden" name="id_tabla" id="id_tabla" value="{$d.ID_T|default:''}"></input>



<script type="text/javascript">

	function cambiar_idioma(id){

		if(document.formp.id_grupo_idioma.value==0 && document.formp.id_idioma.value==1){
			alert("Es necesario guardar primero esta página  ");
		}else { 

		document.formp.submit();

		window.open("{$_layoutParams.root}{$controlador}/editar/"+document.formp.id_grupo_idioma.value+"/"+id,"_self");

	}
	

		/*
	if(id!=0){
		if(document.formp.id.value==0){
			//if( confirm("Es necesario guardar primero la página ") )

		}else{
			window.open("{$_layoutParams.root}{$controlador}/editar/{$idgrupoidioma}/"+id,"_self");
		}
	}	
	*/
}

	{$codigoJS|default:''}
</script>