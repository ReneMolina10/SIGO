<?php
$tablas["p"] = [
    'nom' => "DT_DICTAMENES_TECNICOS",
    'id' => "DT_ID",
    'getId' => "SELECT (MAX(DT_ID)+1) AS ID FROM DT_DICTAMENES_TECNICOS"
];



$bd = array(
    'sqlDeplegar' => 'SELECT 
                        DT_ID AS ID, 
                        DT_PROCESO, 
                        DT_URE, 
                        DT_TIPO, 
                        DT_FECHA, 
                        DT_HORA, 
                        DT_AREA_SOL, 
                        DT_SOLICITA, 
                        DT_EQUIPO, 
                        DT_DIAGNOSTICO,
                        DT_OBSERVACIONES 
                    FROM DT_DICTAMENES_TECNICOS',

    /*'columnas' => array(  ),*/

    'idDeplegar' => 'ID',
    'idFiltro' => 'DT_ID',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Dictamenes Técnicos',
    'nomSingular' => 'Dictamen Tecnico',

    'btnOpciones' => true,
    'cssEditar' => ''
);

/*
$partes = explode('/', $_SERVER['REQUEST_URI']);
$pos = 0;
foreach ($partes as $key => $fila) {
    if ($fila == "editar_modal")
        $pos = $key;
}

if ($pos == 0) {
    $idFiltro = 0;
} else {
    $idFiltro = $partes[$pos + 1];
}*/



// Configuración del formulario para crear/editar registros
$form = array(
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'DT_ID',
        'tipo' => 'oculto',
        //'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-8',
        'campo' => 'DT_PROCESO',
        'tipo' => 'text',
        'holder' => 'Proceso',
        'label' => 'Proceso',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-4',
        'campo' => 'DT_TIPO',
        'tipo' => 'select',
        'datos' => array(
            array('ID' => '0', 'CAMPO' => 'Seleccione...'),
            array('ID' => '1', 'CAMPO' => 'CÓMPUTO'),
            array('ID' => '2', 'CAMPO' => 'REDES Y TELECOMUNICACIONES'),
        ),
        'label' => 'Tipo de dictamen',
        'tabla' => 'p'
    ),

    /*array(
        'col' => 'col-md-4',
        'campo' => 'DT_FOLIO',
        'tipo' => 'text',
        'holder' => 'Folio',
        'label' => 'No./Folio (interno)', //CONSECUTIVO
        'tabla' => 'p'
    ),*/
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-md-3',
        'campo' => 'DT_FECHA',
        'tipo' => 'date',
        'holder' => 'Fecha',
        'label' => 'Fecha',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-3',
        'campo' => 'DT_HORA',
        'tipo' => 'time',
        'holder' => 'Hora',
        'label' => 'Hora',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-6',
        'campo' => 'DT_AREA_SOL',
        'tipo' => 'select',
        'datosSQL' => "SELECT URES AS ID, URES||' - '||LURES AS CAMPO FROM TURESH WHERE FECHA_FIN IS NULL",
        'holder' => 'Área / Depto',
        'label' => 'Área / Depto',
        'tabla' => 'p'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-md-6',
        'campo' => 'DT_SOLICITA',
        'tipo' => 'select',
        'datosSQL' => "SELECT PERS_PERSONA AS ID, PERS_PERSONA||' - '||PERS_NOMBRE|| ' ' ||PERS_APEPAT||' '||PERS_APEMAT AS CAMPO FROM FINANZAS.FPERSONAS
        WHERE PERS_EMPLEADO = 'S' AND PERS_ACTIVO = 'S' AND PERS_PERSONA IS NOT NULL",
        'label' => 'Con atención a:',

        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-6',
        'campo' => 'DT_EQUIPO',
        'tipo' => 'text',
        'label' => 'Equipo:',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-12',
        'campo' => 'DT_DIAGNOSTICO',
        'tipo' => 'textarea',
        'label' => 'Diagnóstico',
        'holder' => 'Redacte el diagnóstico del equipo',
        'tabla' => 'p',
        'alto' => '150px',
        'max' => '800'
    ),
    array('etiq' => '</div>'),



    //**------------------------------------------------------------------------------------------------------------------------ */
    //* TABLA CRUD PARA FIRMANTES *//

    array('etiq' => '<h5 style="font-weight:bold; color:#28a745; margin-top:20px; margin-bottom:10px;">FIRMANTES</h5>'),
    array('etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'),



    array(
        'name_crud_table' => 'FIRMANTES_DICTAMENES_TECNICOS',
        'tipo' => 'crud-table',
        // 'label' => 'Firmantes',
        'col' => 'col-12',

        // 3) Campos del formulario del sub‐Generator
        'form' => array(

            array('etiq' => '<div class="row">'),
            array(
                'col' => 'col-md-12',
                'campo' => 'FD_NUMEMPL',
                'tipo' => 'select',
                'datosSQL' => "SELECT PERS_PERSONA AS ID, 
                                    PERS_PERSONA||' - '||PERS_NOMBRE|| ' ' ||PERS_APEPAT||' '||PERS_APEMAT AS CAMPO 
                            FROM FINANZAS.FPERSONAS
                            WHERE PERS_EMPLEADO = 'S' AND PERS_ACTIVO = 'S' AND PERS_PERSONA IS NOT NULL",
                'label' => 'Empleado',
                'tabla' => 'p'
            ),
            array('etiq' => '</div>'),
            array('etiq' => '<div class="row">'),

            array(
                'col' => 'col-md-6',
                'campo' => 'FD_NOMBRE',
                'tipo' => 'text',
                'holder' => 'Nombre del firmante',
                'label' => 'Nombre',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'FD_CURP',
                'tipo' => 'text',
                'holder' => 'CURP del firmante',
                'label' => 'CURP',
                'tabla' => 'p'
            ),

            array('etiq' => '</div>'),
            array('etiq' => '<div class="row">'),

            array(
                'col' => 'col-md-6',
                'campo' => 'FD_CORREO',
                'tipo' => 'text',
                'holder' => 'Correo electrónico del firmante',
                'label' => 'Correo electrónico',
                'tabla' => 'p'
            ),

            array(
                'col' => 'col-md-6',
                'campo' => 'FD_TIPO_FIRMANTE',
                'tipo' => 'select',
                'datos' => array(
                    array('ID' => '0', 'CAMPO' => 'Seleccione...'),
                    array('ID' => '1', 'CAMPO' => 'Realizó mantenimiento'),
                    array('ID' => '2', 'CAMPO' => 'Autorizó'),
                    array('ID' => '3', 'CAMPO' => 'Solicitante'),
                ),
                'label' => 'Tipo de firmante',
                'tabla' => 'p'
            ),

            array(
                'campo' => 'FD_ID',
                'tipo' => 'oculto',
            ),

            array(
                'campo' => 'FK_DT_ID',
                'tipo' => 'oculto',
                'value' => '[IDPADRE]'
            ),

            array('etiq' => '</div>'),

        ),
        // 1) Definición de tablas (MVS) del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => 'DT_FIRMANTES_DICTAMENES_TECNICOS',
                'id' => 'FD_ID',
                'getId' => 'SELECT (MAX(FD_ID)+1) AS ID FROM DT_FIRMANTES_DICTAMENES_TECNICOS',
                'tRel' => 'h',          // índice de tabla padre en $tablas principal
                'cRel' => 'FK_DT_ID'     // FK al registro padre
            )
        ),

        // 2) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT
                                    FD_ID AS ID, 
                                    FK_DT_ID, 
                                    FD_NUMEMPL,
                                    FD_NOMBRE,
                                    FD_CURP,
                                    FD_CORREO,
                                    FD_TIPO_FIRMANTE, 

                                    CASE FD_TIPO_FIRMANTE
                                        WHEN 1 THEN 'Realizó mantenimiento'
                                        WHEN 2 THEN 'Autorizó'
                                        WHEN 3 THEN 'Solicitante'
                                        ELSE 'N/A'
                                    END AS TIPO_FIRMANTE
                            FROM DT_FIRMANTES_DICTAMENES_TECNICOS
                                WHERE FK_DT_ID = [IDPADRE]",
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
                array('campo' => 'FD_NUMEMPL', 'width' => '10%'),
                array('campo' => 'FD_NOMBRE', 'width' => '20%'),
                array('campo' => 'FD_CURP', 'width' => '15%'),
                array('campo' => 'FD_CORREO', 'width' => '20%'),
                array('campo' => 'FK_DT_ID', 'width' => '15%'),
                array('campo' => 'OPCIONES', 'width' => '5%'),
            ),
            'btnOpciones' => array(
                'editar' => true,
                'detalles' => false,
                'duplicar' => false,
                'eliminar' => true,

            ),
        ),  // usa los botones por defecto

        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),

    array(
        'etiq' => '<hr style="margin-bottom:15px; border-top:2px solidrgb(35, 96, 161);">'
    ),
    array('etiq' => '</div>'), // Cierre de la fila principal del formulario


);



// Configuración adicional de templates
/*$template = array(
    'editForm' => 'modal'
);*/


$baseUrl = BASE_URL;

$codigoJS = <<<JS


$(document).on('change', 'select[name="FD_NUMEMPL"]', function() {
    var selected = $(this).find('option:selected');
    var txt = selected.text();
    var parts = txt.split(' - ');
    // parts[0]: FE_NUMEMPL
    // parts[1]: FE_PREFIJOESTUDIO + ' ' + FE_NOMBRE
    // parts[2]: FE_CARGO
    // parts[3]: FE_CURP
    // parts[4]: FE_CORREO

    var nombreCompleto = parts.length > 1 ? parts[1].trim() : '';
    //var cargo = parts.length > 2 ? parts[2].trim() : '';
    var curp = parts.length > 2 ? parts[3].trim() : '';
    var correo = parts.length > 3 ? parts[4].trim() : '';

    // Si quieres separar prefijo y nombre:
    var prefijo = '';
    var nombre = '';
    if (nombreCompleto) {
        var nombreParts = nombreCompleto.split(' ');
        prefijo = nombreParts.shift();
        nombre = nombreParts.join(' ').trim();
    }

    $('input[name="FD_NOMBRE"]').val(nombre);
    $('input[name="FD_CURP"]').val(curp);
    $('input[name="FD_CORREO"]').val(correo);
    /*$('input[name="FD_PREFIJOESTUDIOS"]').val(prefijo);
    $('input[name="FD_CARGO"]').val(cargo);*/
});






JS;







?>