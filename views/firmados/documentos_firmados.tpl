<div class="d-flex justify-content-between align-items-center page-header-custom">
    <h1 class="h2 text-dark mb-0">Mis Documentos Firmados</h1>
    <a href="{$smarty.const.BASE_URL}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-1"></i> Regresar
    </a>
</div>

<style>
    /* Estilo para el nuevo encabezado de página */
    .page-header-custom {
        background-color: #f8f9fa;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border: 1px solid #dee2e6;
    }

    /* Estilos mejorados */
    .table-responsive {
        margin-bottom: 2rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    /* Efecto hover moderno */
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f1f8ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Badges mejorados */
    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.85em;
        letter-spacing: 0.5px;
        border-radius: 2rem;
    }
    
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-success {
        background-color: #28a745;
    }

    /* Modal mejorado */
    #modalFirmantesPendientes .modal-header {
        background-color: #4a6baf;
        color: #fff;
        border-bottom: none;
    }
    
    #modalFirmantesPendientes .modal-content {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.2);
    }
    
    #modalFirmantesPendientes .modal-header .close {
        color: #fff;
        opacity: 0.8;
        text-shadow: none;
    }
    
    /* Lista de firmantes */
    #lista-firmantes-pendientes .list-group-item {
        font-weight: 500;
        border: none;
        border-bottom: 1px solid #eee;
        padding: 1rem 1.5rem;
    }
    
    #lista-firmantes-pendientes .list-group-item:last-child {
        border-bottom: none;
    }
    
    #lista-firmantes-pendientes .list-group-item span {
        font-size: 1.3rem;
        font-weight: bold;
    }
    
    /* Botones */
    .btn-info {
        background-color: #4a6baf;
        border-color: #4a6baf;
        transition: all 0.3s ease;
    }
    
    .btn-info:hover {
        background-color: #3a5a9f;
        border-color: #3a5a9f;
        transform: translateY(-2px);
    }
    
    /* Texto centrado */
    .text-center {
        padding: 1.5rem;
        color: #6c757d;
        font-style: italic;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="align-middle">ID</th>
                <th class="align-middle">DENOMINACIÓN</th>
                <th class="align-middle">ESTADO</th>
                <th class="align-middle">ESTADO DEL DOCUMENTO</th>
                <th class="align-middle">FECHA DE FIRMA</th>
                <th class="align-middle">ORIGEN</th>
                <th class="align-middle">ACCIÓN</th>
            </tr>
        </thead>
        <tbody>
            {if isset($minutas) && count($minutas)}
                {foreach from=$minutas item=doc}
                    <tr>
                        <td class="align-middle">{$doc.FIR_FK_MINUTA}</td>
                        <td class="align-middle">{$doc.MIN_PROCESO}</td>
                        <td class="align-middle">
                            {if $doc.FIR_STATUS_FIRMANTE_DOC == 2}
                                <span class="badge badge-warning">PENDIENTE POR FIRMAR</span>
                            {elseif $doc.FIR_STATUS_FIRMANTE_DOC == 3}
                                <span class="badge badge-success">FIRMADO</span>
                            {else}
                                {$doc.FIR_STATUS_FIRMANTE_DOC}
                            {/if}
                        </td>
                        <td class="align-middle">
                            {if $doc.STATUS_DOC == 2}
                                <a href="#" class="badge badge-warning ver-pendientes" data-toggle="modal" data-target="#modalFirmantesPendientes" data-minuta-id="{$doc.FIR_FK_MINUTA}">
                                    PENDIENTE POR FIRMAR {$doc.FIRMAS_HECHAS}/{$doc.TOTAL_FIRMAS}
                                </a>
                            {elseif $doc.STATUS_DOC == 3}
                                <span class="badge badge-success">FIRMADO</span>
                            {else}
                                {$doc.STATUS_DOC}
                            {/if}
                        </td>
                        <td class="align-middle">{$doc.FIR_DATESIGN}</td>
                        <td class="align-middle">{$doc.TIPO_DOCUMENTO}</td>
                        <td class="align-middle">
                            <a href="{$smarty.const.BASE_URL}viewminuta/prefirmado/{$doc.HASH_MINUTA}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-eye mr-1"></i> Ver Documento
                            </a>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td colspan="7" class="text-center py-4">
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
      <div class="modal-header">
        <h5 class="modal-title" id="modalFirmantesLabel">
            <i class="fas fa-users mr-2"></i>Firmantes Pendientes
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <ul id="lista-firmantes-pendientes" class="list-group list-group-flush">
            <!-- El contenido se cargará aquí vía AJAX -->
        </ul>
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
    $('#modalFirmantesPendientes').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var minutaId = button.data('minuta-id');
        var modal = $(this);
        var modalList = modal.find('#lista-firmantes-pendientes');

        modalList.html('<li class="list-group-item text-center py-3"><i class="fas fa-spinner fa-spin mr-2"></i>Cargando...</li>');

        $.ajax({
            url: '{$smarty.const.BASE_URL}firmados/firmantes_pendientes_ajax/' + minutaId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                modalList.empty();
                if (response && response.length > 0) {
                    $.each(response, function(index, firmante) {
                        var nombre = firmante.FIR_NOMBRE;
                        var estado = firmante.FIR_STATUS_FIRMANTE_DOC;
                        var itemHtml = '';

                        if (estado == 3) {
                            itemHtml = '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                       '<span><i class="fas fa-user-check mr-2 text-muted"></i>' + nombre + '</span>' +
                                       '<span class="text-success"><i class="fas fa-check-circle"></i></span>' +
                                       '</li>';
                        } else {
                            itemHtml = '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                       '<span><i class="fas fa-user-clock mr-2 text-muted"></i>' + nombre + '</span>' +
                                       '<span class="text-danger"><i class="fas fa-clock"></i></span>' +
                                       '</li>';
                        }
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