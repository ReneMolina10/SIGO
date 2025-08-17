

<style>
    .page-header-custom {
        background-color: #f8f9fa;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border: 1px solid #dee2e6;
    }
    /* Ajuste visual alineado a tabla.tpl (se eliminan sombras fuertes y se adopta estilo compacto) */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: .2rem;
        padding: .25rem .5rem;
    }
    .badge {
        padding: 0.45em 0.7em;
        font-size: 0.75rem;
        border-radius: 2rem;
        letter-spacing: .5px;
    }
    .badge-warning { background:#ffc107; color:#212529; }
    .badge-success { background:#28a745; }
    /* Inputs de búsqueda por columna */
    tfoot input {
        width: 100%;
        box-sizing: border-box;
        font-size: .7rem;
        padding: 2px 4px;
    }
    tfoot th {
        padding: 4px !important;
    }
    .btn-info {
        background-color: #4a6baf;
        border-color: #4a6baf;
        transition: all .25s ease;
    }
    .btn-info:hover {
        background-color: #3a5a9f;
        border-color: #3a5a9f;
        transform: translateY(-2px);
    }
    .text-center {
        padding: 1.5rem;
        color: #6c757d;
        font-style: italic;
    }
</style>
<div class="page-header-custom d-flex justify-content-between align-items-center" style="background: #fff; border: none; padding: 1rem 0; margin-bottom: 1.5rem;">
    <h2 class="mb-0" style="font-weight: 400; color: #333;">Mis Documentos Firmados</h2>
    <a href="{$smarty.const.BASE_URL}" class="btn btn-link text-secondary" style="font-size: 1rem; text-decoration: none;">
        <i class="fas fa-arrow-left mr-1"></i> Regresar
    </a>
</div>

<div class="table-responsive">
    <table id="grid_firmados" class="stripe hover order-column table-sm cell-border compact" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>DENOMINACIÓN</th>
                <th>ESTADO</th>
                <th>ESTADO DEL DOCUMENTO</th>
                <th>FECHA DE FIRMA</th>
                <th>ORIGEN</th>
                <th>ACCIÓN</th>
            </tr>
        </thead>
        <tbody>
            {if isset($minutas) && count($minutas)}
                {foreach from=$minutas item=doc}
                    <tr>
                        <td>{$doc.FIR_FK_MINUTA}</td>
                        <td>{$doc.MIN_PROCESO|escape}</td>
                        <td>
                            {if $doc.FIR_STATUS_FIRMANTE_DOC == 2}
                                <span class="badge badge-warning">PENDIENTE POR FIRMAR</span>
                            {elseif $doc.FIR_STATUS_FIRMANTE_DOC == 3}
                                <span class="badge badge-success">FIRMADO</span>
                            {else}
                                {$doc.FIR_STATUS_FIRMANTE_DOC}
                            {/if}
                        </td>
                        <td>
                            {if $doc.STATUS_DOC == 2}
                                <a href="#" class="badge badge-warning ver-pendientes" data-toggle="modal" data-target="#modalFirmantesPendientes" data-minuta-id="{$doc.FIR_FK_MINUTA}">
                                    PENDIENTE {$doc.FIRMAS_HECHAS}/{$doc.TOTAL_FIRMAS}
                                </a>
                            {elseif $doc.STATUS_DOC == 3}
                                <span class="badge badge-success">FIRMADO</span>
                            {else}
                                {$doc.STATUS_DOC}
                            {/if}
                        </td>
                        <td>{$doc.FIR_DATESIGN}</td>
                        <td>{$doc.TIPO_DOCUMENTO|escape}</td>
                        <td>
                            <a href="{$smarty.const.BASE_URL}viewminuta/prefirmado/{$doc.HASH_MINUTA}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-eye mr-1"></i> Ver
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td colspan="7" class="text-center">
                        <i class="far fa-folder-open fa-2x mb-2"></i><br>
                        No hay documentos firmados para mostrar.
                    </td>
                </tr>
            {/if}
        </tbody>
      
    </table>
</div>

<!-- Modal para Firmantes Pendientes -->
<div class="modal fade" id="modalFirmantesPendientes" tabindex="-1" role="dialog" aria-labelledby="modalFirmantesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#4a6baf;color:#fff;">
        <h5 class="modal-title" id="modalFirmantesLabel">
            <i class="fas fa-users mr-2"></i>Firmantes Pendientes
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:#fff;">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <ul id="lista-firmantes-pendientes" class="list-group list-group-flush"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">
            <i class="fas fa-check mr-1"></i> Entendido
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {

    // Añadir inputs de búsqueda en tfoot (excepto columna de acción)
    $('#grid_firmados tfoot th').each(function(index) {
        if(index === 6) { $(this).html(''); return; }
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="'+title+'" />');
    });

    var table = $('#grid_firmados').DataTable({
        language: {
            url: '{$_layoutParams.ruta_view}/plugins/datatables_1.10.21/language/Spanish.json'
        },
        order: [[0,'desc']],
        responsive: true,
        fixedHeader: true,
        // Ajuste: evita orden en columna Acción
        columnDefs: [
            { orderable: false, targets: 6 }
        ]
    });

    // Búsqueda por columna al presionar Enter
    table.columns().every(function() {
        var that = this;
        $('input', this.footer()).on('keyup change', function(e) {
            if(e.keyCode === 13 || this.value === '') {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            }
        });
    });

    // Modal firmantes pendientes (se conserva tu lógica original)
    $('#modalFirmantesPendientes').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var minutaId = button.data('minuta-id');
        var modalList = $('#lista-firmantes-pendientes');
        modalList.html('<li class="list-group-item text-center py-3"><i class="fas fa-spinner fa-spin mr-2"></i>Cargando...</li>');

        $.ajax({
            url: '{$smarty.const.BASE_URL}firmados/firmantes_pendientes_ajax/' + minutaId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modalList.empty();
                if (response && response.length > 0) {
                    $.each(response, function(_, firmante) {
                        var nombre = firmante.FIR_NOMBRE;
                        var estado = firmante.FIR_STATUS_FIRMANTE_DOC;
                        var itemHtml = (estado == 3)
                            ? '<li class="list-group-item d-flex justify-content-between align-items-center">\
                                <span><i class="fas fa-user-check mr-2 text-muted"></i>'+nombre+'</span>\
                                <span class="text-success"><i class="fas fa-check-circle"></i></span>\
                               </li>'
                            : '<li class="list-group-item d-flex justify-content-between align-items-center">\
                                <span><i class="fas fa-user-clock mr-2 text-muted"></i>'+nombre+'</span>\
                                <span class="text-danger"><i class="fas fa-clock"></i></span>\
                               </li>';
                        modalList.append(itemHtml);
                    });
                } else {
                    modalList.html('<li class="list-group-item text-center py-3"><i class="far fa-frown mr-2"></i>No se encontraron firmantes</li>');
                }
            },
            error: function() {
                modalList.html('<li class="list-group-item text-center py-3 text-danger"><i class="fas fa-exclamation-circle mr-2"></i>Error al cargar los datos</li>');
            }
        });
    });
});
</script>