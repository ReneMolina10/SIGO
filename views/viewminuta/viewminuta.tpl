<div class="wrapper" style="height: 90vh;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-primary"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{$baseUrl}minutas"><i class="fas fa-home"></i> Regresar </a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- PDF Viewer -->
                    <div class="col-md-7">
                        <div class="card card-dark  card-outline">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title"><i class="fas fa-file-pdf mr-2"></i>Previsualización del Documento</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimizar">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize" title="Pantalla completa">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="background-color: #f8f9fa;">
                                <div class="pdf-container">
                                    <iframe 
                                        src="{$baseUrl}viewminuta/previsualizarPDF/{$minuta_id}" 
                                        class="pdf-viewer"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar Info -->
                    <div class="col-md-5">
                        <div class="card card-dark  card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Información de la Minuta</h3>
                            </div>
                            <div class="card-body">
                                <!-- Document Status Card -->
                                <div class="card mb-3 border-left-3 border-left-{if $totalFirmantes == 0}danger{elseif $folioDoc && $firmantesFirmados == $totalFirmantes}success{elseif $folioDoc}warning{else}primary{/if}">
                                    <div class="card-body py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0">Estado del Documento</h5>
                                                <p class="mb-0 text-muted small">
                                                    {if $totalFirmantes == 0}
                                                        Sin firmantes configurados
                                                    {elseif $folioDoc && $firmantesFirmados == $totalFirmantes}
                                                        Completamente firmado
                                                    {elseif $folioDoc}
                                                        En proceso de firma
                                                    {else}
                                                        Pendiente de firmas
                                                    {/if}
                                                </p>
                                            </div>
                                            <div class="badge-container">
                                                {if $totalFirmantes == 0}
                                                    <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> Sin Firmantes</span>
                                                {elseif $folioDoc && $firmantesFirmados == $totalFirmantes}
                                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Completado</span>
                                                {elseif $folioDoc}
                                                    <span class="badge badge-warning"><i class="fas fa-pen"></i> {$firmantesFirmados}/{$totalFirmantes}</span>
                                                {else}
                                                    <span class="badge badge-primary"><i class="fas fa-clock"></i> Pendiente</span>
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Acciones de boton-->
                                <div class="mb-4">
                                    {if $totalFirmantes == 0}
                                        <button class="btn btn-block btn-danger rounded-pill py-2" disabled>
                                            <i class="fas fa-user-slash mr-2"></i> Configurar firmantes primero
                                        </button>
                                    {elseif $folioDoc && $firmantesFirmados == $totalFirmantes}
                                        <i class="fas fa-check-circle mr-2"></i> Firmas recolectadas {$firmantesFirmados}/{$totalFirmantes}
                                    {elseif $folioDoc}
                                        <button
                                                    type="button"
                                                    id="btnVerificarFirmas"
                                                    class="btn btn-block btn-info rounded-pill py-2 shadow-sm">
                                                    <i class="fas fa-sync-alt mr-2"></i> Verificar estatus de firmas
                                                </button>
                                    {else}
                                        <button
                                            type="button"
                                            id="btnSolicitarFirmas"
                                            class="btn btn-block btn-warning rounded-pill py-2 shadow-sm btn-outline-hover"
                                            style="color: #fff;">
                                            <i class="fas fa-pen-fancy mr-2"></i> Solicitar Firmas Digitales
                                        </button>
                                    {/if}
                                </div>
                                
                                <!-- Lista de firmantes -->
                                <div class="card mb-4">
                                    <div class="card-header bg-white py-2">
                                        <h5 class="mb-0"><i class="fas fa-users mr-2 text-info"></i>Listado de Firmantes</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        {if $firmantes|@count > 0}
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="py-2">Nombre</th>
                                                            <th class="py-2 text-center">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {foreach from=$firmantes item=firmante}
                                                            <tr>
                                                                <td class="py-2 align-middle">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <p class="mb-0 font-weight-bold">{$firmante.FIRMANTE}</p>
                                                                            <small class="text-muted">{if $firmante.FIR_STATUS_FIRMANTE_DOC == 3}Firmado el {$firmante.FIR_DATESIGN}{else}Pendiente{/if}</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="py-2 align-middle text-center">
                                                                    {if $firmante.FIR_STATUS_FIRMANTE_DOC == 3}
                                                                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Firmado</span>
                                                                    {else}
                                                                        <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> Pendiente</span>
                                                                    {/if}
                                                                </td>
                                                            </tr>
                                                        {/foreach}
                                                    </tbody>
                                                </table>
                                            </div>
                                        {else}
                                            <div class="text-center py-4">
                                                <i class="fas fa-user-slash fa-2x text-muted mb-3"></i>
                                                <p class="text-muted">No hay firmantes registrados para este documento.</p>
                                            </div>
                                        {/if}
                                    </div>
                                </div>
                                
                                <!-- Metadata -->
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar-alt text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">Fecha de creación</p>
                                                <p class="mb-0 font-weight-bold">{$fecha_creacion|default:"No disponible"}</p>
                                            </div>
                                        </div>
                                        {if $folioDoc}
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-fingerprint text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">Folio del documento</p>
                                                <p class="mb-0 font-weight-bold">{$folioDoc}</p><br>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-link text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">URL del Documento Comprobatorio</p>
                                                <a href="https://efirma.uqroo.mx/verify/{$folioDoc}" 
                                                   class="mb-0 font-weight-bold text-primary text-break"
                                                   target="_blank" 
                                                   rel="noopener"
                                                   style="word-break: break-all; text-decoration: underline;">
                                                    https://efirma.uqroo.mx/verify/{$folioDoc}
                                                </a>
                                            </div>
                                        </div>    {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

    document.addEventListener('DOMContentLoaded', function() {
    var btnSolicitar = document.getElementById('btnSolicitarFirmas');
    if (btnSolicitar) {
        btnSolicitar.onclick = function() {
            if (window.confirm('¿Estás seguro de solicitar las firmas digitales? No podrás revertir esta acción.')) {
                var btn = this;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> solicitando firmas...';
                setTimeout(function() {
                    fetch('{$baseUrl}viewminuta/generarCadenaYFirma/{$minuta_id}')
                        .then(response => response.json())
                        .then(data => {
                            var iframe = document.querySelector('.pdf-viewer');
                            if (iframe) iframe.src = iframe.src;
                            location.reload();
                        })
                        .catch(() => {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-pen-fancy mr-2"></i> Solicitar Firmas Digitales';
                            alert('Ocurrió un error al solicitar las firmas.');
                        });
                }, 3000); // Espera 3 segundos antes de continuar
            }
        };
    }

    var btnVerificar = document.getElementById('btnVerificarFirmas');
    if (btnVerificar) {
        btnVerificar.onclick = function() {
            location.reload();
        };
    }
    });
    </script>

    <style>
        .pdf-container {
            position: relative;
            padding-bottom: 60%;
            height: 20%;
            overflow: hidden;
        }
        .pdf-viewer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .badge-container .badge {
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
        .border-left-3 {
            border-left-width: 3px !important;
        }
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
        .rounded-pill {
            border-radius: 50rem !important;
        }
        .btn-outline-hover.btn-primary {
            background-color: transparent !important;
            color: #007bff !important;
            border: 2px solid #007bff !important;
            box-shadow: none !important;
        }
        .btn-outline-hover.btn-primary:hover, .btn-outline-hover.btn-primary:focus {
            background-color: #007bff !important;
            color: #fff !important;
            border: 2px solid #007bff !important;
            box-shadow: none !important;
        }
        .btn-outline-hover.btn-danger {
            background-color: transparent !important;
            color: #dc3545 !important;
            border: 2px solid #dc3545 !important;
            box-shadow: none !important;
        }
        .btn-outline-hover.btn-danger:hover, .btn-outline-hover.btn-danger:focus {
            background-color: #dc3545 !important;
            color: #fff !important;
            border: 2px solid #dc3545 !important;
            box-shadow: none !important;
        }
        .btn-outline-hover.btn-info {
            background-color: transparent !important;
            color: #17a2b8 !important;
            border: 2px solid #17a2b8 !important;
            box-shadow: none !important;
        }
        .btn-outline-hover.btn-info:hover, .btn-outline-hover.btn-info:focus {
            background-color: #17a2b8 !important;
            color: #fff !important;
            border: 2px solid #17a2b8 !important;
            box-shadow: none !important;
        }
    </style>