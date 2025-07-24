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

{assign var="esModal" value=$esModal|default:false}
{assign var="ocultarAgregar" value=$ocultarAgregar|default:'false'}
{assign var="name_crud_table" value=$name_crud_table|default:false}
{assign var="urlEditarModal" value="{$BASE_URL}{$controlador}/editar_modal/{$parentId}/{$f.name_crud_table}"}
{assign var="parentId" value=$parentId|default:0}
{if $name_crud_table}
  {assign var="modalId" value="modal_`$name_crud_table`"}
  {assign var="formId"  value="formp_`$name_crud_table`"}
  {assign var="nameTableGen"  value="{$name_crud_table}"}
{else}
  {assign var="modalId" value="modal_formulario"}
  {assign var="formId"  value="formp_modal"}
  {assign var="nameTableGen"  value="grid"}
{/if}
{if $esModal}
    {assign var='parentFormId' value="formp_grid"}
    {assign var='childModalId' value="modal_`$nameTableGen`"}    {* p.ej. modal_prueba2 *}
    {assign var='childFormId'  value="formp_`$nameTableGen`"}    {* p.ej. formp_prueba2 *}
{else}
    {assign var='parentFormId' value='formp'}                      {* full‑screen parent *}
    {assign var='childModalId' value="modal_`$nameTableGen`"}
    {assign var='childFormId'  value="formp_`$nameTableGen`"}
{/if}

{if $ocultarAgregar == 'false'}
  {assign var="esModal" value=$esModal|default:false}
  {assign var="nSingular" value=$nSingular|default:'Registro'}
  <a
    class="btn btn-sm btn-{if $esModal}outline-dark{else}dark{/if} rounded-pill"
    data-parent-full="formp"                       
    data-parent-modal="{$formId}"                  
    data-open-mode="{if $esModal}modal{else}full{/if}"  

    data-parent-form-id="{$parentFormId}"     
    data-parent-form-type="{if $esModal}modal{else}full{/if}"

    href="javascript:void(0);"
    onclick="return registrarConHijo(
      this,
      '{if $esModal}{$urlEditarModal}{else}{$urlAgregar}{/if}',
      '{$nameTableGen}',
      '{$nSingular}',
      '{$modalId}',
      '{$childFormId}'
    )"
  >
    <i class="fas fa-plus-circle mr-1"></i> Registrar {$nSingular}
  </a> 
{/if}
