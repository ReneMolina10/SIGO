<?php
$tablas["p"] = [
    'nom' => "DOC_PROPIOS",
    'id' => "DP_ID",
    'getId' => "SELECT (MAX(DP_ID)+1) AS ID FROM DOC_PROPIOS"
];


$bd = array(
    'sqlDeplegar' => 'SELECT
    DP_ID AS ID,
    
    DP_DENOMINACION,
    DP_DESCRIPCION AS DESCRIPCION,
    DP_FOLIO AS FOLIO,
    DP_FECHA AS FECHA,
    DP_STATUS_DOC,
                CASE
                    -- 1. Sin firmantes
                    WHEN (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID) = 0 THEN
                        \'<a style="display:inline-block;min-width:100px;background:#dc3545;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;font-size:1em;word-break:break-word;" class="btn btn-danger btn-block" disabled>Sin Firmantes</a>\'
                
                    -- 2. Ya se solicitó la firma (FOLIO_DOC no es null) y todos firmaron
                    WHEN DP_FOLIO_DOC IS NOT NULL AND
                        (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID AND F.DP_STATUS_FIRMANTE_DOC = 3) =
                        (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID)
                    THEN
                        \'<a href="' . BASE_URL . 'viewdocpropio/prefirmado/\'|| MD5(DP_ID||\'_docpro\') ||\'" target="_blank">
                            <div style="background:#007bff;color:#fff;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                                \' ||
                                (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID) || \'/\' ||
                                (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID) || \' Completado
                            </div>
                        </a>\'

                    -- 3. Ya se solicitó la firma (FOLIO_DOC no es null) pero faltan firmas
                    WHEN DP_FOLIO_DOC IS NOT NULL THEN
                        \'<a href="' . BASE_URL . 'viewdocpropio/prefirmado/\'|| MD5(DP_ID||\'_docpro\') ||\'" target="_blank">
                            <div style="background:#ffc107;color:#212529;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                                \' ||
                                (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID AND F.DP_STATUS_FIRMANTE_DOC = 3) || \'/\' ||
                                (SELECT COUNT(*) FROM DOC_PRO_FIRMANTES F WHERE F.DP_FK_DOCPROPIO = DP_ID) || \' Firmantes
                            </div>
                        </a>\'

                    -- 4. Hay firmantes y aún no se ha solicitado la firma
                    ELSE
                        \'<a href="' . BASE_URL . 'viewdocpropio/prefirmado/\'|| MD5(DP_ID||\'_docpro\') ||\'" target="_blank">
                            <div style="background:#28A745;color:#FFFFFF;border:none;padding:6px 12px;border-radius:4px;text-align:center;">
                                Solicitar Firmas
                            </div>
                        </a>\'
                    END AS FIRMANTES

    FROM DOC_PROPIOS ORDER BY DP_ID DESC',

    'columnas' => array(
        array('campo' => 'ID', 'width' => '2%'),
        array('campo' => 'DP_DENOMINACION', 'width' => '10%'),
        array('campo' => 'DESCRIPCION', 'width' => '30%'),
        array('campo' => 'FOLIO', 'width' => '10%'),
        array('campo' => 'FIRMANTES', 'width' => '10%'),
    ),

    'idDeplegar' => 'ID',
    'idFiltro' => 'DP_ID',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Documentos Propios',
    'nomSingular' => 'Documento Propio',

    'btnOpciones' => array(
        'editar' => array(
            'mostrar_si' => '"[DP_STATUS_DOC]" != "2" && "[DP_STATUS_DOC]" != "3" ',
        ),
        'detalles' => true,
        'duplicar' => false,
        'eliminar' => array(
            'mostrar_si' => '"[DP_STATUS_DOC]" != "2" && "[DP_STATUS_DOC]" != "3" ',
        ),
    ),
    'cssEditar' => ''
);
$partes = explode('/', $_SERVER['REQUEST_URI']);
$pos = 0;
foreach ($partes as $key => $fila) {
    if ($fila == "editar" || $fila == "editar_modal")
        $pos = $key;
}

if ($pos == 0) {
    $idFiltro = 0;
} else {
    $idFiltro = $partes[$pos + 1];
}

$hashDoc = strtoupper(MD5(($idFiltro . '_docpro')));
/*
print_r($hashDoc);
exit();*/
$form = array(

    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'DP_ID',
        'tipo' => 'oculto',
        //'tabla' => 'p'
    ),

    array('etiq' => '<h5 style="font-weight:bold; color:#28a745; margin-top:20px; margin-bottom:10px;">Información del Documento</h5>'),
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-md-8',
        'campo' => 'DP_DENOMINACION',
        'tipo' => 'text',
        'label' => 'Denominación',
        'holder' => 'Denominación del Documento',
        'tabla' => 'p',
        'required' => 'true',
    ),
    array(
        'col' => 'col-md-4',
        'campo' => 'DP_FOLIO',
        'tipo' => 'text',
        'holder' => 'Folio',
        'label' => 'No./Folio (interno)',
        'tabla' => 'p'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),


    array(
        'col' => 'col-md-12',
        'campo' => 'DP_DESCRIPCION',
        'tipo' => 'textarea',
        'label' => 'Descripción',
        'holder' => 'Descripción',
        'tabla' => 'p',
        'alto' => '100px',
        'max' => '500',
        'encrypt' => true,
    ),
    array('etiq' => '</div>'),

    array('etiq' => '<div class="row">'),


    array(
        'col' => 'col-12',
        'campo' => 'DP_RUTA_PDF',
        'tipo' => 'uploadfile', // Para subida de archivo
        'format' => ["jpeg", "jpg", "pdf", "png"],
        'multiple' => 'true',
        'size' => '10000', //En KB
        'path' => $_SERVER['DOCUMENT_ROOT'] . 'documentos_almacenados/Doc_propios', //Ruta para guardar
        'label' => 'Documento',
        'file_name' => 'documento', //Nombre del archivo para guardar
    ),


    array('' => '</div>'),


    //**------------------------------------------------------------------------------------------------------------------------ */

    array(
        'name_crud_table' => 'DOC_PRO_FIRMANTES',
        'tipo' => 'crud-table',
        'label' => 'Firmantes',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('etiq' => '<div class="row">'),

            array(
                'col' => 'col-md-12',
                'campo' => 'DP_NUMEMPL',
                'tipo' => 'select',
                'datosSQL' => "SELECT FE_NUMEMPL AS ID, FE_NUMEMPL || ' - ' || 
                FE_PREFIJOESTUDIO || ' ' ||FE_NOMBRE|| ' - ' ||  FE_CARGO || ' - ' || FE_CURP || ' - ' || FE_CORREO  AS CAMPO 
                FROM SAU.PADRON_FIRMAELECTRONICA
                WHERE FE_NUMEMPL NOT IN (
                    SELECT DP_NUMEMPL FROM DOC_PRO_FIRMANTES WHERE DP_FK_DOCPROPIO = $idFiltro
                )",
                'label' => 'Número de Empleado',
                'holder' => 'Escriba su número de empleado',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-2',
                'campo' => 'DP_PREFIJOESTUDIOS',
                'tipo' => 'text',
                'label' => 'Prefijo de Estudios',
                'holder' => 'Prefijo',
                'tabla' => 'p',
                //'readonly' => true,
            ),
            array(
                'col' => 'col-md-6',
                'campo' => 'DP_NOMBRE',
                'tipo' => 'text',
                'label' => 'Nombre',
                'holder' => 'Nombre del firmante',
                'tabla' => 'p',
                'readonly' => true,
            ),
            array(
                'col' => 'col-md-4',
                'campo' => 'DP_CURP',
                'tipo' => 'text',
                'label' => 'CURP',
                'holder' => 'CURP',
                'tabla' => 'p',
                'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'DP_CARGO',
                'tipo' => 'text',
                'label' => 'Cargo',
                'holder' => 'Cargo',
                'tabla' => 'p',
                //'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'DP_CORREO',
                'tipo' => 'text',
                'label' => 'Correo',
                'holder' => 'Correo electrónico',
                'tabla' => 'p',
                'readonly' => true,
            ),

            array('etiq' => '</div>'),

            array('etiq' => '<div class="row">'),
            array(
                'campo' => 'ID_DP',
                'tipo' => 'oculto',
            ),
            array(
                'campo' => 'DP_FK_DOCPROPIO',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),
            array('etiq' => '</div>'),

        ),

        // 2) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => "DOC_PRO_FIRMANTES",
                'id' => "ID_DP",
                'getId' => "SELECT (MAX(ID_DP)+1) AS ID FROM DOC_PRO_FIRMANTES",
                'tRel' => 'p',          // índice de tabla padre en $tablas principal
                'cRel' => 'DP_FK_DOCPROPIO'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT 
                                    ID_DP AS ID,
                                    DP_NUMEMPL AS NUMEMPL,
                                    DP_PREFIJOESTUDIOS AS PREFIJO,
                                    DP_NOMBRE AS NOMBRE, 
                                    DP_PREFIJOESTUDIOS||' '|| DP_NOMBRE AS FIRMANTE,
                                    DP_CURP AS CURP, 
                                    DP_CORREO AS CORREO, 
                                    DP_CARGO AS CARGO, 
                                    DP_FK_DOCPROPIO,
                                    DM.DP_STATUS_DOC
                                    FROM DOC_PRO_FIRMANTES DF
                                    LEFT JOIN DOC_PROPIOS DM ON DM.DP_ID = DF.DP_FK_DOCPROPIO
                                    WHERE DP_FK_DOCPROPIO = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"DP_ID"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Firmantes',
            'nomSingular' => 'Firmante',

            //* Parámetros de la tabla
            'bPaginate' => false, // o true
            'bFilter' => false, // o true
            'bInfo' => false, // o true
            'mostrarTfoot' => false, // o true
            'columnas' => array(
                array('campo' => 'ID', 'width' => '5%'),
                array('campo' => 'NUMEMPL', 'width' => '15%'),
                array('campo' => 'FIRMANTE', 'width' => '30%'),
                array('campo' => 'CARGO', 'width' => '20%'),
                array('campo' => 'CORREO', 'width' => '30%'),
                array('campo' => 'OPCIONES', 'width' => '5%'),

            ),
            'btnOpciones' => array(
                'editar' => array(
                    'mostrar_si' => '"[DP_STATUS_DOC]" != "2" && "[DP_STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[DP_STATUS_DOC]" != "2" && "[DP_STATUS_DOC]" != "3" ',
                ),
            )  // usa los botones por defecto
        ),
        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),

    array('etiq' => '</div>'),


);


/*
// Configuración adicional de templates
$template = array(
    'editForm' => 'modal'
);*/
$baseUrl = BASE_URL;






$codigoJS = <<<JS



$(document).on('change', 'select[name="DP_NUMEMPL"]', function() {
    var selected = $(this).find('option:selected');
    var txt = selected.text();
    var parts = txt.split(' - ');
    // parts[0]: FE_NUMEMPL
    // parts[1]: FE_PREFIJOESTUDIO + ' ' + FE_NOMBRE
    // parts[2]: FE_CARGO
    // parts[3]: FE_CURP
    // parts[4]: FE_CORREO

    var nombreCompleto = parts.length > 1 ? parts[1].trim() : '';
    var cargo = parts.length > 2 ? parts[2].trim() : '';
    var curp = parts.length > 3 ? parts[3].trim() : '';
    var correo = parts.length > 4 ? parts[4].trim() : '';

    // Si quieres separar prefijo y nombre:
    var prefijo = '';
    var nombre = '';
    if (nombreCompleto) {
        var nombreParts = nombreCompleto.split(' ');
        prefijo = nombreParts.shift();
        nombre = nombreParts.join(' ').trim();
    }

    $('input[name="DP_NOMBRE"]').val(nombre);
    $('input[name="DP_CURP"]').val(curp);
    $('input[name="DP_CORREO"]').val(correo);
    $('input[name="DP_PREFIJOESTUDIOS"]').val(prefijo);
    $('input[name="DP_CARGO"]').val(cargo);
});


JS;







?>