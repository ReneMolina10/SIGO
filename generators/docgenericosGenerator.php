<?php
$tablas["p"] = array(
    'nom' => 'DOC_GENERICOS',
    'id' => 'DG_ID',
    'getId' => 'SELECT (MAX(DG_ID)+1) AS ID FROM DOC_GENERICOS'
);

$bd = array(
    'sqlDeplegar' =>
        'SELECT 
        DG_ID                   AS ID,
        DG_FK_URE||\' - \'||LURES               AS URE,
        DG_ASUNTO               AS ASUNTO,
        DG_TEXTO                AS TEXTO,
        DG_LUGAR               AS LUGAR,
        DG_FECHA                AS FECHA,
        DG_FOLIO                AS FOLIO,
        DG_LEMA                 AS LEMA,
        DG_DESCRIPCION          AS DESCRIPCION,
        

        \'<a href="' . BASE_URL . 'docgenericos/exec/previsualizarPDF/\' || DG_ID || \'" target="_blank"> <div style="text-align:center"> <i class="far fa-eye nav-icon"></i> </div> </a>\' AS PDF
        FROM DOC_GENERICOS DG
        LEFT JOIN TURESH ON DG_FK_URE = URES
        LEFT JOIN SISRH.PLT_UBICACIONES ON DG_LUGAR = UBI_ID',


    'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
        array('campo' => 'ASUNTO', 'width' => '40%'),
        array('campo' => 'FECHA', 'width' => '20%'),
        array('campo' => 'FOLIO', 'width' => '10%'),
        array('campo' => 'PDF', 'width' => '10%'),
    ),
    'idDeplegar' => 'ID',
    'idFiltro' => 'DG_ID',
    'busqLike' => '"DENOMINACION"',
    'busqIgual' => '"ID"',
    'nomPlural' => 'Documentos genéricos',
    'nomSingular' => 'Documento genérico',
    /*
    'btnOpciones' => array(
          'editar' => true,
          'detalles' => array(
            'label' => 'PDF',
            'href' => '#',
            'target' => '_blank'
          ),
          'duplicar' => false,
          'eliminar' => true
    ),
    */
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


$form = array(
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'DG_ID',
        'tipo' => 'oculto',
        'tabla' => 'p',
    ),
    
    
    array(
        'col' => 'col-12',
        'campo' => 'DG_TEXTO',
        'tipo' => 'editor',
        'prompt' => 'Verificar ortografía, redacción y gramática',
        'label' => 'Editor del cuerpo del documento',
        'holder' => '',
        'required' => 'true',

    ),

    array('etiq' => '</div>'),


    //** TABLA CRUD DE FIRMANTES */

    array(
        'name_crud_table' => 'DOC_GEN_FIRMANTES',
        'tipo' => 'crud-table',
        'label' => 'Firmantes',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('etiq' => '<div class="row">'),

            array(
                'col' => 'col-md-4',
                'campo' => 'GEN_TIPO_FIRMANTE',
                'tipo' => 'select',
                'datosSQL' => "SELECT ID_TIPO AS ID, DENOMINACION AS CAMPO FROM TIPO_FIRMANTES",
                'label' => 'Tipo de firmante',
                'tabla' => 'p'
            ),
            array(
                'col' => 'col-md-8',
                'campo' => 'GEN_NUMEMPL',
                'tipo' => 'select',

                'datosSQL' => "SELECT FE_NUMEMPL AS ID, FE_NUMEMPL || ' - ' || 
                FE_PREFIJOESTUDIO || ' ' ||FE_NOMBRE|| ' - ' ||  FE_CARGO || ' - ' || FE_CURP || ' - ' || FE_CORREO  AS CAMPO 
                FROM SAU.PADRON_FIRMAELECTRONICA
                WHERE FE_NUMEMPL NOT IN (
                    SELECT GEN_NUMEMPL FROM DOC_GEN_FIRMANTES WHERE FK_GEN_DOCUMENTO = $idFiltro
                )",
                'label' => 'Número de Empleado',
                'tabla' => 'p'
            ),
            array(
                'col' => 'col-md-2',
                'campo' => 'GEN_PREFIJOESTUDIOS',
                'tipo' => 'text',
                'label' => 'Prefijo de Estudios',
                'holder' => 'Prefijo',
                'tabla' => 'p',
                //'readonly' => true,
            ),
            array(
                'col' => 'col-md-6',
                'campo' => 'GEN_NOMBRE',
                'tipo' => 'text',
                'label' => 'Nombre',
                'holder' => 'Nombre del firmante',
                'tabla' => 'p',
                'readonly' => true,
            ),
            array(
                'col' => 'col-md-4',
                'campo' => 'GEN_CURP',
                'tipo' => 'text',
                'label' => 'CURP',
                'holder' => 'CURP',
                'tabla' => 'p',
                'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'GEN_CARGO',
                'tipo' => 'text',
                'label' => 'Cargo',
                'holder' => 'Cargo',
                'tabla' => 'p',
                //'readonly' => true,
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'GEN_CORREO',
                'tipo' => 'text',
                'label' => 'Correo',
                'holder' => 'Correo electrónico',
                'tabla' => 'p',
                'readonly' => true,
            ),
            array('etiq' => '</div>'),


            array('etiq' => '<div class="row">'),
            array(
                'campo' => 'GEN_ID',
                'tipo' => 'oculto',
            ),
            array(
                'campo' => 'FK_GEN_DOCUMENTO',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),
            array('etiq' => '</div>'),

        ),

        // 2) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => "DOC_GEN_FIRMANTES",
                'id' => "GEN_ID",
                'getId' => "SELECT (MAX(GEN_ID)+1) AS ID FROM DOC_GEN_FIRMANTES",
                'tRel' => 'p',          // índice de tabla padre en $tablas principal
                'cRel' => 'FK_GEN_DOCUMENTO'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT 
                                    GEN_ID AS ID,
                                    GEN_NUMEMPL AS NUMEMPL,
                                    GEN_PREFIJOESTUDIOS AS PREFIJO,
                                    GEN_NOMBRE AS NOMBRE, 
                                    GEN_PREFIJOESTUDIOS||' '|| GEN_NOMBRE AS FIRMANTE,
                                    GEN_CURP AS CURP, 
                                    GEN_CORREO AS CORREO, 
                                    GEN_CARGO AS CARGO, 
                                    FK_GEN_DOCUMENTO,
                                    DG.STATUS_DOC
                                    FROM DOC_GEN_FIRMANTES DF
                                    LEFT JOIN DOC_GENERICOS DG ON DG.DG_ID = DF.FK_GEN_DOCUMENTO
                                    WHERE FK_GEN_DOCUMENTO = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"ID"',
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
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => array(
                    'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
                ),
            )  // usa los botones por defecto
        ),
        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),



    array('etiq' => '</div>'),
    
    array('etiq' => '<div class="row">'),

    array(
        'campo' => 'DG_DESCRIPCION',
        'tipo' => 'text',
        'tabla' => 'p',
        'required' => 'true',
        'label' => 'Descripción (para uso interno)',
        'col' => 'col-12'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">DATOS GENERALES</h6>'),
    array('etiq' => '<div class="row">'),


    array(
        'col' => 'col-7',
        'campo' => 'DG_ASUNTO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Asunto',
    ),
    array(
        'col' => 'col-5',
        'campo' => 'DG_FOLIO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Folio'
    ),
    array(
        'col' => 'col-7',
        'campo' => 'DG_LUGAR',
        'tipo' => 'select',
        //SELECT UBI_ID AS ID, UBI_DENOMINACION AS CAMPO FROM PLT_UBICACIONES ORDER BY UBI_ID ASC
        'datosSQL' => "SELECT UBI_ID AS ID, UBI_DENOMINACION AS CAMPO FROM UBICACIONES ORDER BY UBI_ID ASC",
        'tabla' => 'p',
        'label' => 'Lugar',
    ),
    array(
        'col' => 'col-5',
        'campo' => 'DG_FECHA',
        'tipo' => 'date',
        'tabla' => 'p',
        'label' => 'Fecha',
        'value' => date('Y-m-d'),
    ),

    array(
        'col' => 'col-12',
        'campo' => 'DG_LEMA',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Lema (opcional)',
        'holder' => 'Lema del documento'
    ),
    

    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">PARTICIPANTES</h6>'),
    array('etiq' => '<div class="row">'),

   

    array('etiq' => '</div>'),



);


$baseUrl = BASE_URL;
$codigoJS = <<<JS


$(document).on('change', 'select[name="GEN_NUMEMPL"]', function() {
    var selected = $(this).find('option:selected');
    var txt = selected.text();
    var parts = txt.split(' - ');

    // Validar que el texto tenga al menos 5 partes
    var nombreCompleto = parts[1] ? parts[1].trim() : '';
    var cargo = parts[2] ? parts[2].trim() : '';
    var curp = parts[3] ? parts[3].trim() : '';
    var correo = parts[4] ? parts[4].trim() : '';

    // Separar prefijo y nombre si es necesario
    var prefijo = '';
    var nombre = '';
    if (nombreCompleto) {
        var nombreParts = nombreCompleto.split(' ');
        prefijo = nombreParts.shift() || ''; // Obtener el prefijo
        nombre = nombreParts.join(' ').trim(); // Obtener el nombre
    }

    // Asignar valores a los campos de entrada correctos
    $('input[name="GEN_NOMBRE"]').val(nombre || '');
    $('input[name="GEN_CURP"]').val(curp || '');
    $('input[name="GEN_CORREO"]').val(correo || '');
    $('input[name="GEN_PREFIJOESTUDIOS"]').val(prefijo || '');
    $('input[name="GEN_CARGO"]').val(cargo || '');
});



JS;







