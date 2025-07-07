{* views/generators/components/crud_table.tpl *}

{assign var="isModal" value=($childTemplate.editForm eq 'modal')}
<div class="mb-2 d-flex justify-content-end">
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
{assign var="tablaScrollX"    value=$f.bd.tablaScrollX|default:'false'}
{assign var="checkbox_column" value=$f.bd.checkbox_column|default:'false'}


<div class="card mb-4">
  <div class="card-body p-2">
      {* recupero sólo las columnas de este sub-generator *}
      {assign var="columnas" value=$columnas_per_sub[$f.name_crud_table]|default:[]}

      {* Ahora incluyo tabla.tpl sin usar pipes en los args *}
      {include file="views/generators/tabla.tpl"
        tableId         = "tbl_{$f.name_crud_table}"
        columnas        = $columnas
        rutaBuscar      = "{$_layoutParams.root}{$controlador}/buscar/{$parentId}"
        name_crud_table = $f.name_crud_table
        tablaResponsiva = $tablaResponsiva
        tablaScrollX    = $tablaScrollX
        checkbox_column = $checkbox_column
      }
    
</div>
</div>
