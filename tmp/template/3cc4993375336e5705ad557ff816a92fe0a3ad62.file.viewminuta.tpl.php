<?php /* Smarty version Smarty-3.1.8, created on 2025-07-24 11:56:36
         compiled from "C:\xampp\htdocs\SIGO\views\viewminuta\viewminuta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179379910868813495738df9-87540584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cc4993375336e5705ad557ff816a92fe0a3ad62' => 
    array (
      0 => 'C:\\xampp\\htdocs\\SIGO\\views\\viewminuta\\viewminuta.tpl',
      1 => 1753376192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179379910868813495738df9-87540584',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_68813495781ac0_89177887',
  'variables' => 
  array (
    'baseUrl' => 0,
    'minuta_id' => 0,
    'totalFirmantes' => 0,
    'folioDoc' => 0,
    'firmantesFirmados' => 0,
    'firmantes' => 0,
    'firmante' => 0,
    'fecha_creacion' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_68813495781ac0_89177887')) {function content_68813495781ac0_89177887($_smarty_tpl) {?><div class="wrapper" style="height: 90vh;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-primary"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
minutas"><i class="fas fa-home"></i> Regresar </a></li>
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
                                        src="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
viewminuta/previsualizarPDF/<?php echo $_smarty_tpl->tpl_vars['minuta_id']->value;?>
" 
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
                                <div class="card mb-3 border-left-3 border-left-<?php if ($_smarty_tpl->tpl_vars['totalFirmantes']->value==0){?>danger<?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value&&$_smarty_tpl->tpl_vars['firmantesFirmados']->value==$_smarty_tpl->tpl_vars['totalFirmantes']->value){?>success<?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value){?>warning<?php }else{ ?>primary<?php }?>">
                                    <div class="card-body py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0">Estado del Documento</h5>
                                                <p class="mb-0 text-muted small">
                                                    <?php if ($_smarty_tpl->tpl_vars['totalFirmantes']->value==0){?>
                                                        Sin firmantes configurados
                                                    <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value&&$_smarty_tpl->tpl_vars['firmantesFirmados']->value==$_smarty_tpl->tpl_vars['totalFirmantes']->value){?>
                                                        Completamente firmado
                                                    <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value){?>
                                                        En proceso de firma
                                                    <?php }else{ ?>
                                                        Pendiente de firmas
                                                    <?php }?>
                                                </p>
                                            </div>
                                            <div class="badge-container">
                                                <?php if ($_smarty_tpl->tpl_vars['totalFirmantes']->value==0){?>
                                                    <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> Sin Firmantes</span>
                                                <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value&&$_smarty_tpl->tpl_vars['firmantesFirmados']->value==$_smarty_tpl->tpl_vars['totalFirmantes']->value){?>
                                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Completado</span>
                                                <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value){?>
                                                    <span class="badge badge-warning"><i class="fas fa-pen"></i> <?php echo $_smarty_tpl->tpl_vars['firmantesFirmados']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['totalFirmantes']->value;?>
</span>
                                                <?php }else{ ?>
                                                    <span class="badge badge-primary"><i class="fas fa-clock"></i> Pendiente</span>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Acciones de boton-->
                                <div class="mb-4">
                                    <?php if ($_smarty_tpl->tpl_vars['totalFirmantes']->value==0){?>
                                        <button class="btn btn-block btn-danger rounded-pill py-2" disabled>
                                            <i class="fas fa-user-slash mr-2"></i> Configurar firmantes primero
                                        </button>
                                    <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value&&$_smarty_tpl->tpl_vars['firmantesFirmados']->value==$_smarty_tpl->tpl_vars['totalFirmantes']->value){?>
                                        <i class="fas fa-check-circle mr-2"></i> Firmas recolectadas <?php echo $_smarty_tpl->tpl_vars['firmantesFirmados']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['totalFirmantes']->value;?>

                                    <?php }elseif($_smarty_tpl->tpl_vars['folioDoc']->value){?>
                                        <button
                                                    type="button"
                                                    id="btnVerificarFirmas"
                                                    class="btn btn-block btn-info rounded-pill py-2 shadow-sm"
                                                    onclick="location.reload();">
                                                    <i class="fas fa-sync-alt mr-2"></i> Verificar estatus de firmas
                                                </button>
                                    <?php }else{ ?>
                                        <button
                                            type="button"
                                            id="btnSolicitarFirmas"
                                            class="btn btn-block btn-warning rounded-pill py-2 shadow-sm btn-outline-hover"
                                            style="color: #fff;">
                                            <i class="fas fa-pen-fancy mr-2"></i> Solicitar Firmas Digitales
                                        </button>
                                    <?php }?>
                                </div>
                                
                                <!-- Lista de firmantes -->
                                <div class="card mb-4">
                                    <div class="card-header bg-white py-2">
                                        <h5 class="mb-0"><i class="fas fa-users mr-2 text-info"></i>Listado de Firmantes</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <?php if (count($_smarty_tpl->tpl_vars['firmantes']->value)>0){?>
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th class="py-2">Nombre</th>
                                                            <th class="py-2 text-center">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  $_smarty_tpl->tpl_vars['firmante'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['firmante']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['firmantes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['firmante']->key => $_smarty_tpl->tpl_vars['firmante']->value){
$_smarty_tpl->tpl_vars['firmante']->_loop = true;
?>
                                                            <tr>
                                                                <td class="py-2 align-middle">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <p class="mb-0 font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['firmante']->value['FIRMANTE'];?>
</p>
                                                                            <small class="text-muted"><?php if ($_smarty_tpl->tpl_vars['firmante']->value['FIR_STATUS_FIRMANTE_DOC']==3){?>Firmado el <?php echo $_smarty_tpl->tpl_vars['firmante']->value['FIR_DATESIGN'];?>
<?php }else{ ?>Pendiente<?php }?></small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="py-2 align-middle text-center">
                                                                    <?php if ($_smarty_tpl->tpl_vars['firmante']->value['FIR_STATUS_FIRMANTE_DOC']==3){?>
                                                                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Firmado</span>
                                                                    <?php }else{ ?>
                                                                        <span class="badge badge-warning"><i class="fas fa-clock mr-1"></i> Pendiente</span>
                                                                    <?php }?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="text-center py-4">
                                                <i class="fas fa-user-slash fa-2x text-muted mb-3"></i>
                                                <p class="text-muted">No hay firmantes registrados para este documento.</p>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div>
                                
                                <!-- Metadata -->
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-calendar-alt text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">Fecha de creación</p>
                                                <p class="mb-0 font-weight-bold"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['fecha_creacion']->value)===null||$tmp==='' ? "No disponible" : $tmp);?>
</p>
                                            </div>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['folioDoc']->value){?>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-fingerprint text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">Folio del documento</p>
                                                <p class="mb-0 font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['folioDoc']->value;?>
</p><br>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-link text-info mr-3"></i>
                                            <div>
                                                <p class="mb-0 small text-muted">URL del Documento Comprobatorio</p>
                                                <a href="https://efirma.uqroo.mx/verify/<?php echo $_smarty_tpl->tpl_vars['folioDoc']->value;?>
" 
                                                   class="mb-0 font-weight-bold text-primary text-break"
                                                   target="_blank" 
                                                   rel="noopener"
                                                   style="word-break: break-all; text-decoration: underline;">
                                                    https://efirma.uqroo.mx/verify/<?php echo $_smarty_tpl->tpl_vars['folioDoc']->value;?>

                                                </a>
                                            </div>
                                        </div>    <?php }?>
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
                        fetch('<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
viewminuta/generarCadenaYFirma/<?php echo $_smarty_tpl->tpl_vars['minuta_id']->value;?>
')
                            .then(response => response.json())
                            .then(data => {
                                var iframe = document.querySelector('.pdf-viewer');
                                if (iframe) iframe.src = iframe.src;
                                btn.outerHTML = `<button
                                                    type="button"
                                                    id="btnVerificarFirmas"
                                                    class="btn btn-block btn-info rounded-pill py-2 shadow-sm"
                                                    onclick="location.reload();">
                                                    <i class="fas fa-sync-alt mr-2"></i> Verificar estatus de firmas
                                                </button>`;
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

        document.addEventListener('DOMContentLoaded', function() {
    // ...existing code para btnSolicitar...

    var btnVerificar = document.getElementById('btnVerificarFirmas');
    if (btnVerificar) {
        btnVerificar.onclick = function() {
            location.reload();
        };
    }
});
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
    </style><?php }} ?>