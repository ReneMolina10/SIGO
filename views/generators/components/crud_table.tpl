{* views/generators/components/crud_table.tpl *}

{assign var="isModal" value=($childTemplate.editForm eq 'modal')}
<div class="mb-2 d-flex justify-content-between align-items-center">


		<label for="{$f.campo}">{$f.label}: {if isset($f.required) && $f.required== "true"} <span style="color:red">*</span> {/if}
			{if isset($f.info_tooltip) && $f.info_tooltip != '' }  
				<span style="font-size: 85%" data-toggle="tooltip" title="" class="custom-tooltip badge badge-info" data-original-title='{$f.info_tooltip }'>?</span>
			{/if}
			{if isset($f.info_modal) && $f.info_modal != '' }  
				<button type="button" class="btn bg-info btn-xs" onclick="info_modal_{$f.campo}()" style="font-size: .6rem; padding: 0.25rem 0.4rem 0.2rem 0.4rem;"> <i class="fas fa-info"></i></button>
			{/if}
		</label>

    

  {include file="views/generators/btn_registrar.tpl"
    urlAgregar     = "{$_layoutParams.root}{$controlador}/editar/0/0/0/{$parentId}/{$f.name_crud_table}"
    nSingular      = $f.bd.nomSingular|default:'Elemento'
    ocultarAgregar = $f.bd.ocultarBtnAgregar|default:'false'
    parentId         = $parentId
    name_crud_table  = $f.name_crud_table
    esModal          = $f.template.editForm eq 'modal'
  }
</div>


{* Preparo los valores por defecto para pasarlos *}
{assign var="tablaResponsiva" value=$f.bd.tablaResponsiva|default:'true'}
{assign var="tablaScrollX"    value=$f.bd.tablaScrollX|default:false}
{assign var="checkbox_column" value=$f.bd.checkbox_column|default:false}
{assign var="bPaginate"       value=$f.bd.bPaginate|default:true}
{assign var="bFilter"         value=$f.bd.bFilter|default:true}
{assign var="bInfo"           value=$f.bd.bInfo|default:true}
{assign var="mostrarTfoot"    value=$f.bd.mostrarTfoot|default:true}

{* Si es un modal, no muestro el título *}


<div class="card mb-4">
  <div class="card-body p-2">
      {* recupero sólo las columnas de este sub-generator *}
      {assign var="columnas" value=$columnas_per_sub[$f.name_crud_table]|default:[]}

      {* Ahora incluyo tabla.tpl sin usar pipes en los args *}
      {include file="views/generators/tabla.tpl"
        tableId         = "tbl_{$f.name_crud_table}"
        columnas        = $columnas
        
        name_crud_table = $f.name_crud_table
        tablaResponsiva = $tablaResponsiva
        tablaScrollX    = $tablaScrollX
        checkbox_column = $checkbox_column
        bPaginate       = $bPaginate
        bFilter         = $bFilter
        bInfo           = $bInfo
        mostrarTfoot    = $mostrarTfoot
      }
    {* rutaBuscar      = "{$_layoutParams.root}{$controlador}/buscar/{$parentId}" *}
</div>
</div>
