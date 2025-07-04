<style>
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
       
        <a class="btn btn-outline-dark custom-btn" href="javascript:validaAbrirURL_{$f.nombre}('{$f.generator}','{$f.idrel}');">
        <a class="btn btn-outline-dark custom-btn" href="javascript:open_modal_{$f.nombre}('{$f.generator}','{$f.idrel}');">


            <script type="text/javascript">
                document.write('{$f.btn_holder}'.trim() ? '{$f.btn_holder}' : 'Nuevo');
            </script>
        </a>
        <h3 class="card-title">{$f.encabezado}</h3>
    </div>
    <div class="card-body">
       <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead style="background-color: #fff;">
                    <tr>
                        {if isset($f.column_widths)}
                            {foreach from=$f.column_widths item=col_width name=cols}
                                <th style="width:{$col_width};"></th>
                            {/foreach}
                        {else}
                            <!-- Aquí puedes poner los th por defecto si no hay configuración -->
                            <th></th>
                        {/if}
                    </tr>
                </thead>
                <tbody id="tabla_{$f.nombre}">
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

    function validaAbrirURL_{$f.nombre}(gen,idgen){
        let idAbrir = $('#'+idgen).val();
        if( idAbrir !='') {
            abrirURL('{$BASE_URL}'+gen+'/filtro/'+idAbrir);
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Debe guardar el documento antes de proseguir.',
                confirmButtonText: 'Aceptar'
            });
        }
    }

     function open_modal_{$f.nombre}(gen,idgen){
        let idAbrir = $('#'+idgen).val();
        if( idAbrir !='') {
            $.ajax({
                url: '{$BASE_URL}'+gen+'/editar_modal/'+idAbrir,
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

    function actualizarTabla_{$f.nombre}() {
        if ($('#{$f.idrel}').val() != "") {
            load_table(
                '{$BASE_URL}{$controlador}/gettable/{$f.id}/' + $('#{$f.idrel}').val(),
                '{$f.nombre}',
                '{$f.holder}'
            );
        }
    }

    $(document).ready(function() {
        if ($('#{$f.idrel}').val() != "") {
            actualizarTabla_{$f.nombre}();
        }

        // Verificar si la tabla quedó sin registros después de 1 segundo
        setTimeout(function(){
            if ($("#tabla_{$f.nombre} tr").length === 0) {
                $("#tabla_{$f.nombre}").html(
                    '<tr><td class="text-center"><h5>Sin registros</h5></td></tr>' +
                    '<tr><td colspan="1" class="text-center text-danger">Para poder registrar, primero debe guardar el formulario</td></tr>'
                );
            }
        }, 1000);

        // --- NUEVO: Actualización automática por AJAX cada 10 segundos ---
       setInterval(function() {
            actualizarTabla_{$f.nombre}();
        }, 10000); // 10000 ms = 10 segundos (ajusta el tiempo si lo deseas)
    });
</script>
