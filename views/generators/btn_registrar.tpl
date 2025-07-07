{* views/generators/components/btn_registrar.tpl *}
{*
  Variables recibidas:
   - urlAgregar       : URL para abrir el formulario en pantalla completa
   - esModal          : booleano, si abre un modal (default: false)
   - nSingular        : nombre singular del registro
   - ocultarAgregar   : valor de $bd.ocultarBtnAgregar (string 'true'/'false')
   - parentId         : ID del registro padre (number)
   - name_crud_table  : identificador único del sub-generator (string)
*}

{assign var="isModal" value=($childTemplate.editForm eq 'modal')}
{assign var="ocultarAgregar" value=$ocultarAgregar|default:'false'}
{assign var="name_crud_table" value=$name_crud_table|default:'false'}
{assign var="urlEditarModal" value="{$_layoutParams.root}/{$controlador}/editar_modal/{$parentId}/{$f.name_crud_table}"}



{if $ocultarAgregar == 'false'}
  {assign var="esModal" value=$esModal|default:false}
  {assign var="nSingular" value=$nSingular|default:'Registro'}
  {if $esModal}
    <a class="btn btn-sm btn-success"
       href="javascript:open_modal_to_edit(0,0,0,'{$urlEditarModal}','{$f.bd.nomSingular}', {$parentId},'{$name_crud_table}' )">
      <i class="fas fa-plus"></i> Registrar {$nSingular}
    </a>
  {else}
    <a class="btn btn-sm btn-success" href="{$urlAgregar}">
      <i class="fas fa-plus"></i> Registrar {$nSingular}
    </a>
  {/if} 
{/if}
