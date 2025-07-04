<?php
$tablas["p"] = [
    'nom' => "DOC_MINUTA",
    'id' => "MIN_ID",
    'getId' => "SELECT (MAX(MIN_ID)+1) AS ID FROM DOC_MINUTA"
];
/*
\'<a href="' . BASE_URL . 'viewminuta/prefirmado?id=\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">Ver PDF y detalles</a>\' AS PDF_EXTERNO,


\'<a href="' . BASE_URL . 'viewminuta/previsualizarPDF/\' || MD5(MIN_ID||\'_minuta\') || \'" target="_blank"> <div style="text-align:center"> <i class="far fa-eye nav-icon"></i> </div> </a>\' AS PDF_INTERNO,
*/


$bd = array(
    'sqlDeplegar' => 'SELECT
    MIN_ID AS ID,
    MIN_PROCESO AS PROCESO,
    MIN_FOLIO AS FOLIO,
    MIN_FECHA AS FECHA,
    MIN_HINICIO AS HINICIO,
    MIN_HFIN AS HFIN,
    MIN_LUGAR AS LUGAR,
    MIN_FK_AREAS_PARTICIPA AS AREAS_PARTICIPA,
    STATUS_DOC,


    

   CASE
    -- 1. Sin firmantes
    WHEN (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) = 0 THEN
        \'<a style="display:inline-block;min-width:100px;background:#dc3545;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;font-size:1em;word-break:break-word;" class="btn btn-danger btn-block" disabled>Sin Firmantes</a>\'
    -- 2. Ya se solicitó la firma (FOLIO_DOC no es null) y todos firmaron
    WHEN FOLIO_DOC IS NOT NULL AND
         (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID AND F.FIR_STATUS_FIRMANTE_DOC = 3) =
         (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID)
    THEN
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#007bff;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                \' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \'/\' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \' Completado
            </div>
        </a>\'
    -- 3. Ya se solicitó la firma (FOLIO_DOC no es null) pero faltan firmas
    WHEN FOLIO_DOC IS NOT NULL THEN
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#ffc107;color:#212529;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                \' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID AND F.FIR_STATUS_FIRMANTE_DOC = 3) || \'/\' ||
                (SELECT COUNT(*) FROM DOC_MIN_FIRMANTES F WHERE F.FIR_FK_MINUTA = MIN_ID) || \' Firmantes
            </div>
        </a>\'
    -- 4. Hay firmantes y aún no se ha solicitado la firma
    ELSE
        \'<a href="' . BASE_URL . 'viewminuta/prefirmado/\'|| MD5(MIN_ID||\'_minuta\') ||\'" target="_blank">
            <div style="background:#28A745;color:#FFFFFF;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                Solicitar Firmas
            </div>
        </a>\'
END AS FIRMANTES

    FROM DOC_MINUTA ORDER BY MIN_ID DESC
    ',

    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'PROCESO', 'width' => '30%'),
        array('campo' => 'FOLIO', 'width' => '10%'),
        array('campo' => 'LUGAR', 'width' => '10%'),

        // array('campo' => 'PDF_EXTERNO', 'width' => '5%'),
        // array('campo' => 'PDF_INTERNO', 'width' => '5%'),

        array('campo' => 'FIRMANTES', 'width' => '10%'),
        /*array(
            'campo' => 'STATUS_DOC',
            'status_style' => array(
                array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white', 'text' => 'Sin Estatus', ),
                array('value' => '2', 'background_color' => '#007bff', 'text_color' => 'white', 'text' => 'En Proceso'),
                array('value' => '3', 'background_color' => '#28a745', 'text_color' => 'white', 'text' => 'Finalizado'),
            ),
        ),*/
    ),

    'idDeplegar' => 'ID',
    'idFiltro' => '',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Minutas',
    'nomSingular' => 'Minutas',

    'btnOpciones' => array(
        'editar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
        'detalles' => true,
        'duplicar' => false,
        'eliminar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
    ),
    'cssEditar' => ''
);


// Configuración del formulario para crear/editar registros
$form = array(

    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'MIN_ID',
        'tipo' => 'oculto',
        //'tabla' => 'p'
    ),




    array('etiq' => '</div>'),
    array('etiq' => '<h5 style="font-weight:bold; color:#28a745; margin-top:20px; margin-bottom:10px;">Información General</h5>'),
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '<div class="row">'),




    array(
        'col' => 'col-md-8',
        'campo' => 'MIN_PROCESO',
        'tipo' => 'text',
        'holder' => 'Proceso',
        'label' => 'Proceso',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-4',
        'campo' => 'MIN_FOLIO',
        'tipo' => 'text',
        'holder' => 'Folio',
        'label' => 'No./Folio (interno)',
        'tabla' => 'p'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_FECHA',
        'tipo' => 'date',
        'holder' => 'Feuucha',
        'label' => 'Fecha',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_HINICIO',
        'tipo' => 'time',
        'holder' => 'Hora de Inicio',
        'label' => 'Hora de Inicio',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_HFIN',
        'tipo' => 'time',
        'holder' => 'Hora de Fin',
        'label' => 'Hora de Fin',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-3',
        'campo' => 'MIN_LUGAR',
        'tipo' => 'text',
        'holder' => 'Lugar',
        'label' => 'Lugar',
        'tabla' => 'p'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    // Selección de áreas participantes
    // Esta sección utiliza un dual listbox para seleccionar múltiples áreas
    array(
        'col' => 'col-md-12',
        'campo' => 'MIN_FK_AREAS_PARTICIPA', //Id (name) con el que se nombrará en el formulario, no debe repetirse.
        'tipo' => 'dual_listbox',
        'class' => 'select2',
        'id_local' => 'MIN_ID',//Tabla origen
        'tabla_g' => 'DOC_FIR_AREAS_PARTICIPA', //nombre de la tabla en donde quieres guardar 
        'id_tabla_g' => 'ID_FK_MINUTA', //nombre de la columna en donde se guarda el id del registro
        'valor_tabla_g' => 'ID_URE_PAR', //nombre de la columna en la tabla donde se el valor de la opcion del check

        'datosSQL' => "SELECT URES AS ID, URES || '-' ||LURES AS CAMPO FROM TURESH WHERE FECHA_FIN IS NULL",
        'label' => 'Áreas participantes',
    ),

    array('etiq' => '</div>'),

    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'nombre' => 'ASUNTOS',
        'detalles' => 'width:100%;',
        'sql' => "SELECT 
                        ASU_ID AS ID,
                        ASU_TEMA AS TEMA,
                        ASU_PRESENTA||' - '||LURES AS PRESENTA,
                        ASU_RESUMEN AS RESUMEN
                        --ASU_FK_MINUTA
                        FROM DOC_MIN_ASUNTO
                        LEFT JOIN TURESH ON URES = ASU_PRESENTA
                                    WHERE ASU_FK_MINUTA = :id",
        'id' => "ASUNTOS",
        'idrel' => 'MIN_ID',
        'tipo' => 'tabla',
        'btn_holder' => 'Agregar Asunto',
        'encabezado' => 'Asuntos',
        'tabla' => 'p',
        'generator' => 'minu_asunto', //nombre del generatos al que sera redirigido
        //'column_widths' => ['5%', '20%', '25%', '50%'],

    ),
    array('etiq' => '</div>'),





    //array('etiq' => '<h5 style="font-weight:bold; color:#2c3e50; margin-top:20px; margin-bottom:10px;">Información General de la Minuta</h5>'),
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '</div>'),
    array(
        'col' => 'col-md-12',
        'nombre' => 'ACUERDOS',
        'detalles' => 'width:100%;',
        'sql' => "SELECT
                            ACU_ID AS ID,
                            ACU_DESCRIPCION AS DESCRIPCION,
                            ACU_RESPONSABLE||' - '||LURES AS RESPONSABLE,
                            ACU_FECHA_FIN   AS FECHA_FIN
                            --ACU_FK_MINUTA
                                FROM DOC_MIN_ACUERDOS
                                 LEFT JOIN TURESH ON URES = ACU_RESPONSABLE
                                    WHERE ACU_FK_MINUTA=:id",
        'id' => "ACUERDOS",
        'idrel' => 'MIN_ID',
        'tipo' => 'tabla',
        'btn_holder' => 'Agregar Acuerdo',
        'encabezado' => 'Acuerdos',
        'tabla' => 'p',
        'generator' => 'minu_acuerdo', //nombre del generatos al que sera redirigido
        //'column_widths' => ['5%', '20%', '25%', '50%'],
    ),
    array('etiq' => '</div>'),

    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'nombre' => 'MEJORAS',
        'detalles' => 'width:100%;',
        'sql' => "SELECT
                            MEJ_ID AS ID, MEJ_TIPO AS TIPO, MEJ_DESCRIPCION AS DESCRIPCION, MEJ_FK_MINUTA 
                            FROM DOC_MIN_MEJORAS
                                    WHERE MEJ_FK_MINUTA=:id ",
        'id' => "MEJORAS",
        'idrel' => 'MIN_ID',
        'tipo' => 'tabla',
        'btn_holder' => 'Agregar Mejoras',
        'encabezado' => 'Mejoras al proceso',
        'tabla' => 'p',
        'generator' => 'minu_mejoras' //nombre del generatos al que sera redirigido

    ),
    array('etiq' => '</div>'),


    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'nombre' => 'FIRMAMTES',
        'detalles' => 'width:100%;',
        'sql' => "SELECT
                        FIR_ID AS ID,
             FIR_NUMEMPL AS NUMEMPL,
             --FIR_PREFIJOESTUDIOS, 
             FIR_PREFIJOESTUDIOS ||''||FIR_NOMBRE AS FIRMANTE, 
             --FIR_CURP, 
             FIR_CORREO AS CORREO,
             FIR_CARGO AS CARGO
             --FIR_FK_MINUTA
                        FROM DOC_MIN_FIRMANTES
                                    WHERE FIR_FK_MINUTA=:id ",
        'id' => "FIRMAMTES",
        'idrel' => 'MIN_ID',
        'tipo' => 'tabla',
        'btn_holder' => 'Agregar Firmante',
        'encabezado' => 'Firmantes',
        'tabla' => 'p',
        'generator' => 'minu_firmantes' //nombre del generatos al que sera redirigido

    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-6',
        'campo' => 'DOCUMENTO',
        'tipo' => 'uploadfile', // Para subida de archivo
        'format' => ["jpeg", "jpg", "pdf", "png"],
        'multiple' => 'true',
        'size' => '10000', //En KB
        'path' => '/opt/docs_minutas/minutas', //Ruta para guardar
        'label' => 'Documento adjunto',
        'file_name' => 'documento_adjunto_minuta', //Nombre del archivo para guardar
    ),

    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '</div>'),

);


/*
// Configuración adicional de templates
$template = array(
    'editForm' => 'modal'
);*/
$baseUrl = BASE_URL;



$codigoJS = <<<JS

function solicitarFirmas(minutaId) {
    $.ajax({
        url:  '{$baseUrl}viewminuta/exec/generarCadenaYFirma/' + minutaId,
        type: 'POST',
        dataType: 'text', // <-- Cambia a text
        success: function(response) {
    try {
        var data = JSON.parse(response);
        Swal.fire({
            icon: 'success',
            title: '¡Firmas solicitadas!',
            text: 'La cadena y la solicitud de firmas se generaron correctamente.'
        }).then(() => {
            setTimeout(function() {
                location.reload(); // Recarga la página después de 5 segundos
            }, 1000);
        });
    } catch (e) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Respuesta inesperada del servidor: ' + response
        });
    }
},
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al solicitar las firmas.'
            });
        }
    });
}






JS;







?>