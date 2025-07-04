<?php /* Smarty version Smarty-3.1.8, created on 2025-07-04 04:06:20
         compiled from "views/generators/components/tabla.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13292054596866c5f8b65c56-76934795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c1b5da5af2f71aa64bc75df2a38265638d298bb' => 
    array (
      0 => 'views/generators/components/tabla.tpl',
      1 => 1751616373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13292054596866c5f8b65c56-76934795',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_6866c5f8b720c4_45031814',
  'variables' => 
  array (
    'f' => 0,
    'col_width' => 0,
    'BASE_URL' => 0,
    'controlador' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6866c5f8b720c4_45031814')) {function content_6866c5f8b720c4_45031814($_smarty_tpl) {?><style>
    .custom-btn {
        float: right;
        margin-bottom: 15px;
    }
    /* Quitar borde superior de la tabla */
    .table-bordered {
        border-top: none !important;
    }
    .table-bordered thead th, 
    .table-bordered thead td {
        border-top: none !important;
    }
    .card-header {
        border-top: none !important;
    }
    .table thead th {
        border-color: #fff !important; /* Bordes blancos en el encabezado */
        background-color: #fff !important; /* Fondo blanco opcional */
    }
</style>

<div class="card">
    <div class="card-header">
       
        <a class="btn btn-outline-dark custom-btn" href="javascript:validaAbrirURL_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
('<?php echo $_smarty_tpl->tpl_vars['f']->value['generator'];?>
','<?php echo $_smarty_tpl->tpl_vars['f']->value['idrel'];?>
');">
        <a class="btn btn-outline-dark custom-btn" href="javascript:open_modal_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
('<?php echo $_smarty_tpl->tpl_vars['f']->value['generator'];?>
','<?php echo $_smarty_tpl->tpl_vars['f']->value['idrel'];?>
');">


            <script type="text/javascript">
                document.write('<?php echo $_smarty_tpl->tpl_vars['f']->value['btn_holder'];?>
'.trim() ? '<?php echo $_smarty_tpl->tpl_vars['f']->value['btn_holder'];?>
' : 'Nuevo');
            </script>
        </a>
        <h3 class="card-title"><?php echo $_smarty_tpl->tpl_vars['f']->value['encabezado'];?>
</h3>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead style="background-color: #fff;">
                    <tr>
                        <?php if (isset($_smarty_tpl->tpl_vars['f']->value['column_widths'])){?>
                            <?php  $_smarty_tpl->tpl_vars['col_width'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['col_width']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['f']->value['column_widths']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['col_width']->key => $_smarty_tpl->tpl_vars['col_width']->value){
$_smarty_tpl->tpl_vars['col_width']->_loop = true;
?>
                                <th style="width:<?php echo $_smarty_tpl->tpl_vars['col_width']->value;?>
;"></th>
                            <?php } ?>
                        <?php }else{ ?>
                            <!-- Aquí puedes poner los th por defecto si no hay configuración -->
                            <th></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody id="tabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="modal_formulario_label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_formulario_label">Formulario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formulario">
                <!-- Aquí se cargará el contenido dinámico del formulario -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar_modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function validaAbrirURL_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
(gen,idgen){
        let idAbrir = $('#'+idgen).val();
        if( idAbrir !='') {
            abrirURL('<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
'+gen+'/filtro/'+idAbrir);
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Debe guardar el documento antes de proseguir.',
                confirmButtonText: 'Aceptar'
            });
        }
    }

     function open_modal_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
(gen,idgen){
        let idAbrir = $('#'+idgen).val();
        if( idAbrir !='') {
            $.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
'+gen+'/editar_modal/'+idAbrir,
                type: 'GET',
                success: function(response) {
                    // Cargar el contenido del modal
                    $("#formulario").html(response);
                    // Mostrar el modal
                    $('#modal_formulario').modal({
                        focus: false
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cargar el contenido del modal.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Debe guardar el documento antes de proseguir.',
                confirmButtonText: 'Aceptar'
            });
        }
    }

    function actualizarTabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
() {
        if ($('#<?php echo $_smarty_tpl->tpl_vars['f']->value['idrel'];?>
').val() != "") {
            load_table(
                '<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['controlador']->value;?>
/gettable/<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
/' + $('#<?php echo $_smarty_tpl->tpl_vars['f']->value['idrel'];?>
').val(),
                '<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
',
                '<?php echo $_smarty_tpl->tpl_vars['f']->value['holder'];?>
'
            );
        }
    }

    $(document).ready(function() {
        if ($('#<?php echo $_smarty_tpl->tpl_vars['f']->value['idrel'];?>
').val() != "") {
            actualizarTabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
();
        }

        // Verificar si la tabla quedó sin registros después de 1 segundo
        setTimeout(function(){
            if ($("#tabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
 tr").length === 0) {
                $("#tabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
").html(
                    '<tr><td class="text-center"><h5>Sin registros</h5></td></tr>' +
                    '<tr><td colspan="1" class="text-center text-danger">Para poder registrar, primero debe guardar el formulario</td></tr>'
                );
            }
        }, 1000);

        // --- NUEVO: Actualización automática por AJAX cada 10 segundos ---
       setInterval(function() {
            actualizarTabla_<?php echo $_smarty_tpl->tpl_vars['f']->value['nombre'];?>
();
        }, 10000); // 10000 ms = 10 segundos (ajusta el tiempo si lo deseas)
    });
</script>
<?php }} ?>