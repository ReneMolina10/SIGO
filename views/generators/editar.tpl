
<style>

.content{
    padding-top: 15px!important;
}
.card-title{
    font-size: 1.75rem;
}


</style>

<form class="bs-example bs-example-form" data-example-id="simple-input-groups" id="formp" name="formp" action="javascript:guardar_generator('{$_layoutParams.root}{$controlador}')" method="post" enctype="multipart/form-data">

	{if $nameCrudTable}
		<input type="hidden" name="name_crud_table" value="{$nameCrudTable}">
	{/if}

	<div class="card">

		<div class="card-header">
			<h3 class="card-title">
				{if $detalles|default:"" == "readonly"}
					<i class="fas fa-file-alt"></i> Detalle de {$nomsingular} {$d.ID_T|default:""}
				{else}
					<i class="fas fa-pencil-alt"></i> Crear {$nomsingular}
				{/if}
			</h3>	
			<div class="card-tools">
				<!--<a class="btn" href="{$_layoutParams.root}{$controlador}/index/{$filtro|default:''}">Sarlir</a>-->
				<a class="btn" href="{$_layoutParams.root}{$controlador}/index/">Salir</a>
				{if $detalles|default:""!="readonly"} 
					<button type="submit" class="btn btn-success" id="btnguardar"><i class="fas fa-save"></i> Guardar</button>
				{/if}	
			</div>
			
		</div>



		{if isset($idiomas) }
		<div class="bs-example bs-navbar-top-example" data-example-id="navbar-static-top"> 
			<nav class="navbar navbar-default navbar-static-top">  
		        <div class="container-fluid"> 
		            <div class="navbar-header"> 
		                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8" aria-expanded="false"> 		
		                    <span class="sr-only">Toggle navigation</span> 
		                    <span class="icon-bar"></span> <span class="icon-bar"></span> 
		                    <span class="icon-bar"></span> 
		                </button> 
		                <a class="navbar-brand">Idiomas:</a> 
		            </div>  
		            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8"> 
		                <ul class="nav navbar-nav"> 
		                    {foreach item=datoi from=$idiomas}
		                        {if $ididioma==$datoi.id}
		                            <li class="active"><a href="javascript:cambiar_idioma(0)">{$datoi.denominacion}({$datoi.prefijo})</a></li>
		                        {else}
		                            <li><a href="javascript:cambiar_idioma({$datoi.id})">{$datoi.denominacion}({$datoi.prefijo})</a></li>
		                        {/if}   
		                    {/foreach}
		                </ul> 
		            </div> 
		        </div> 
		    </nav> 
		</div>
		{/if}

		<div class="card-body" style="    background-color: white;">
			{if $detalles|default:"" == "readonly"}
				{include file="views/generators/detalles.tpl"}
			{else}
				{include file="views/generators/form.tpl"}
			{/if}
		</div>

	</div>
	
</form>
{include file="views/generators/ventanas_modal.tpl"}
{if $ventana_modal|default:"" != true}
<div id="divLoading"> </div> 
<!--<script  src="{$_layoutParams.root}public/js/app.js" type="text/javascript"></script>-->
{/if}


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

	


	/*{foreach key=key item=f from=$datosf}
		{if $f.etiq|default:""!=""} 
		{else}
			{if $f.tipo=="listas_dependientes" }
				$("#{$f.campo_dependencia}").on('change', function() {
				    alert("zxxx");
				});
			{/if}
		{/if}
	{/foreach}*/


</script>