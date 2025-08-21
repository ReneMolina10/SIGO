<?php
$tablas["p"] = array(
    'nom' => 'DOC_FIRMANTES',
    'id' => 'FIRM_DOC',
    'getId' => 'SELECT (MAX(FIRM_DOC)+1) AS ID FROM DOC_FIRMANTES'
);

$bd = array(
    'sqlDeplegar' =>
        'SELECT 
        FIRM_DOC AS ID,
        FIRM_NOMBRE AS NOMBRE,
        FIRM_PUESTO AS  PUESTO,
        FIRM_FK_TIPO  AS TIPO,
        FIRM_NUMEMPL AS NUMEMPL,
        FIRM_CORREO      AS CORREO,
        FIRM_ORDEN  AS ORDEN,
        FIRM_OTRO_TIPO  AS OTRO_TIPO,
        FIRM_FK_DOC AS FK_DOC_FIRMANTE
        FROM DOC_FIRMANTES',


    'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
        array('campo' => 'NOMBRE', 'width' => '40%'),
        array('campo' => 'PUESTO', 'width' => '20%'),
        array('campo' => 'FK_DOC_FIRMANTE', 'width' => '10%'),

    ),
    'idDeplegar' => 'ID',
    'idFiltro' => "FK_DOC_FIRMANTE",
    'busqLike' => '""',
    'busqIgual' => '"ID"',
    'nomPlural' => 'Firmantes',
    'nomSingular' => 'Firmante',
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

$form = array(
    /*array(
        'campo' => 'FIRM_FK_DOC',
        'tipo' => 'oculto',
        'value' => $idFiltro
    ),*/
    array(
        'col' => 'col-12',
        'campo' => 'FIRM_DOC',
        'tipo' => 'oculto',
        'tabla' => 'p',

    ),



    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-3',
        'campo' => 'FIRM_FK_DOC',
        'tipo' => 'number',
        'tabla' => 'p',
        'required' => 'true',
        'label' => 'Documento al que pertenece el firmante'
    ),

    array(
        'col' => 'col-5',
        'campo' => 'FIRM_NUMEMPL',
        'tipo' => 'select',
        'datosSQL' => "SELECT PERS_PERSONA AS ID, PERS_PERSONA ||' - '|| PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT AS CAMPO FROM FINANZAS.FPERSONAS WHERE PERS_ACTIVO = 'S'",
        'tabla' => 'p',
        'label' => 'Número de empleado del firmante',
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-4',
        'campo' => 'FIRM_NOMBRE',
        'tipo' => 'select',
        'tabla' => 'p',
        'datosSQL' => "SELECT (PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT) AS ID, PERS_PERSONA ||' - '||PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT  AS CAMPO FROM FINANZAS.FPERSONAS WHERE PERS_ACTIVO = 'S'",
        'required' => 'true',
        'label' => 'Nombre del firmante',

    ),
    array(
        'col' => 'col-4',
        'campo' => 'FIRM_PUESTO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Puesto del firmante',
    ),
    array(
        'col' => 'col-md-4',
        'campo' => 'FIRM_CORREO',
        'tipo' => 'select',
        'datosSQL' => "SELECT PERS_CORREO AS ID, PERS_PERSONA ||' - '|| PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT  AS CAMPO FROM FINANZAS.FPERSONAS WHERE PERS_ACTIVO = 'S' AND PERS_CORREO IS NOT NULL",
        'tabla' => 'p',
        'label' => 'Correo de empleado del firmante',
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-4',
        'campo' => 'FIRM_FK_TIPO',
        'tipo' => 'select',
        'tabla' => 'p',
        'label' => 'Tipo de firmante',
        'datosSQL' => "SELECT DOC_ID AS ID , DOC_TIPO AS CAMPO FROM DOC_TIPO_FIRMA ORDER BY DOC_ID ASC",
    ),

    array(
        'col' => 'col-4',
        'campo' => 'FIRM_ORDEN',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Orden de firma',
        'holder' => 'Orden de firma'
    ),

    array(
        'col' => 'col-4',
        'campo' => 'FIRM_OTRO_TIPO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Otro tipo de firmante',
        'holder' => 'Otro tipo de firmante'
    ),




    array('etiq' => '</div>'),







);

// Configuración adicional de templates
$template = array(
    'editForm' => 'modal'
);


?>