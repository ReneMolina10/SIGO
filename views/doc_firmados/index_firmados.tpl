{literal}
<style>
    .page-header-custom {
        background-color:#f8f9fa;
        padding:1rem 1.5rem;
        border-radius:.5rem;
        margin-bottom:1.5rem;
        border:1px solid #dee2e6;
    }
    .dataTables_wrapper .dataTables_filter input{
        border:1px solid #ced4da;
        border-radius:.2rem;
        padding:.25rem .5rem;
    }
    .badge{padding:.45em .7em;font-size:.7rem;border-radius:2rem;letter-spacing:.5px;}
    .badge-warning{background:#ffc107;color:#212529;}
    .badge-success{background:#28a745;}
    .badge-info{background:#17a2b8;}
    tfoot input{width:100%;box-sizing:border-box;font-size:.7rem;padding:2px 4px;}
    tfoot th{padding:4px !important;}
    .btn-info{background:#4a6baf;border-color:#4a6baf;transition:all .25s;}
    .btn-info:hover{background:#3a5a9f;border-color:#3a5a9f;transform:translateY(-2px);}
    .text-center-empty{padding:1.5rem;color:#6c757d;font-style:italic;}

    /* Full-width badges in Estado / Firmantes columns */
    td.col-estado .badge,
    td.col-firmantes .badge{
        display:block;
        width:100%;
        text-align:center;
        border-radius:4px;
        font-size:.65rem;
        letter-spacing:.5px;
        padding:.5rem .25rem;
        box-sizing:border-box;
        white-space:nowrap;
    }
    td.col-firmantes a.badge{ text-decoration:none; }
    /* Optional equal height alignment */
    #grid_docs_firmados td.col-estado,
    #grid_docs_firmados td.col-firmantes{
        padding:4px 6px;
    }
</style>
{/literal}

<div class="page-header-custom d-flex justify-content-between align-items-center" style="background:#fff;border:none;">
    <h2 class="mb-0" style="font-weight:400;color:#333;">Mis Documentos Firmados</h2>
    <a href="{$smarty.const.BASE_URL}" class="btn btn-link text-secondary" style="font-size:1rem;text-decoration:none;">
        <i class="fas fa-arrow-left mr-1"></i> Regresar
    </a>
</div>

<div class="table-responsive">
    <table id="grid_docs_firmados" class="stripe hover order-column table-sm cell-border compact" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>FOLIO</th>
                <th>ESTADO DOCUMENTO</th>
                <th>ESTADO FIRMANTES</th>
                <th>FECHA FIRMA</th>
                <th>FECHA CREACIÓN</th>
                <th>ORIGEN</th>
                <th>TIPO</th>
                <th>ACCIÓN</th>
            </tr>
        </thead>
        <tbody>
        {if isset($documentos) && count($documentos)}
            {foreach from=$documentos item=doc}
                {assign var=pct value=0}
                {if $doc.FIRMANTES_TOTAL > 0}
                    {assign var=pct value=$doc.FIRMANTES_FIRMADOS/$doc.FIRMANTES_TOTAL*100}
                {/if}
                <tr>
                    <td>{$doc.TDOC_DOCUMENTO}</td>
                    <td>{$doc.TDOC_FOLIO|escape}</td>
                    <td class="col-estado">
                        {if $doc.TDOC_ESTATUS == 3}
                            <span class="badge badge-success">FIRMADO</span>
                        {elseif $doc.TDOC_ESTATUS == 2}
                            <span class="badge badge-warning">EN PROCESO</span>
                        {else}
                            <span class="badge badge-info">{$doc.TDOC_ESTATUS}</span>
                        {/if}
                    </td>
                    <td class="col-firmantes">
                        {if $doc.FIRMANTES_FIRMADOS == $doc.FIRMANTES_TOTAL}
                            <span class="badge badge-success">{$doc.FIRMANTES_FIRMADOS}/{$doc.FIRMANTES_TOTAL}</span>
                        {else}
                            <a href="#" class="badge badge-warning ver-firmantes"
                               data-toggle="modal"
                               data-target="#modalFirmantes"
                               data-doc="{$doc.TDOC_DOCUMENTO}">
                               Ver firmantes<br>{$doc.FIRMANTES_FIRMADOS}/{$doc.FIRMANTES_TOTAL}
                            </a>
                        {/if}
                    </td>
                    <td>{$doc.TDOC_FECHA_FIRMA}</td>
                    <td>{$doc.TDOC_FECHA}</td>
                    <td>{$doc.ORIGEN|escape}</td>
                    <td>{$doc.TIPO|escape}</td>
                    <td>
                        <a href="https://efirma.uqroo.mx/verify/{$doc.TDOC_FOLIO}" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-eye mr-1"></i> Ver
                        </a>
                    </td>
                </tr>
            {/foreach}
        {else}
            <tr>
                <td colspan="9" class="text-center-empty">
                    <i class="far fa-folder-open fa-2x mb-2"></i><br>No hay documentos firmados para mostrar.
                </td>
            </tr>
        {/if}
        </tbody>
        
    </table>
</div>

<div class="modal fade" id="modalFirmantes" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#4a6baf;color:#fff;">
        <h5 class="modal-title">
            <i class="fas fa-users mr-2"></i>Firmantes Documento <span id="mf-doc"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:#fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive mb-0">
            <table class="table table-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estatus</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody id="mf-body">
                    <tr><td colspan="4" class="text-center py-3"><i class="fas fa-spinner fa-spin"></i> Cargando...</td></tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">
            <i class="fas fa-check mr-1"></i> Aceptar
        </button>
      </div>
    </div>
  </div>
</div>

{assign var=firmantesJson value=$firmantesDocs|@json_encode}

{literal}
<script>
(function(){
  const FIRMANTES = {/literal}{$firmantesJson nofilter}{literal};
  function estatusTexto(e){
      switch(String(e)){
          case '1': return '<span class="badge badge-warning">Pendiente</span>';
          case '2': return '<span class="badge badge-info">En proceso</span>';
          case '3': return '<span class="badge badge-success">Firmado</span>';
          case '4': return '<span class="badge badge-danger">Rechazado</span>';
          default:  return e;
      }
  }
  function escapeHtml(s){
      return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
  }

  $('#modalFirmantes').on('show.bs.modal', function (ev){
      const btn = $(ev.relatedTarget);
      const docId = btn.data('doc');
      $('#mf-doc').text(docId);
      const body = $('#mf-body');
      const arr = FIRMANTES[docId] || [];
      if(!arr.length){
          body.html('<tr><td colspan="4" class="text-center py-3">Sin firmantes</td></tr>');
          return;
      }
      body.html(arr.map(f=>`
          <tr>
              <td>${escapeHtml(f.TDFI_FIRMANTE)}</td>
              <td>${escapeHtml(f.TDFI_NOMBRE||'')}</td>
              <td>${estatusTexto(f.TDFI_ESTATUS)}</td>
              <td>${escapeHtml(f.TDFI_CORREO||'')}</td>
          </tr>
      `).join(''));
  });

  // DataTables
  if($.fn.DataTable){
      // Add tfoot inputs
      $('#grid_docs_firmados tfoot th').each(function(i){
          if(i===8){ $(this).html(''); return; }
          const txt = $(this).text();
          $(this).html('<input type="text" placeholder="'+txt+'" />');
      });

      const table = $('#grid_docs_firmados').DataTable({
          language:{ url: '{/literal}{$_layoutParams.ruta_view}{literal}/plugins/datatables_1.10.21/language/Spanish.json' },
          order:[[0,'desc']],
          responsive:true,
          fixedHeader:true,
          columnDefs:[{orderable:false,targets:8}]
      });

      table.columns().every(function(){
          const that = this;
          $('input', this.footer()).on('keyup change', function(e){
              if(e.keyCode===13 || this.value===''){
                  if(that.search() !== this.value){
                      that.search(this.value).draw();
                  }
              }
          });
      });
  }
})();
</script>
{/literal}  