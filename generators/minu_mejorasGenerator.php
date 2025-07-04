<?php
$tablas["p"] = [
    'nom' => "DOC_MIN_MEJORAS",
    'id' => "MEJ_ID",
    'getId' => "SELECT (MAX(MEJ_ID)+1) AS ID FROM DOC_MIN_MEJORAS "
];

$bd = array(
    'sqlDeplegar' => "SELECT
                            MEJ_ID AS ID, MEJ_TIPO AS TIPO, MEJ_DESCRIPCION AS DESCRIPCION, MEJ_FK_MINUTA, DM.STATUS_DOC 
                            FROM DOC_MIN_MEJORAS DMJ
                            LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DMJ.MEJ_FK_MINUTA",

    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'TIPO', 'width' => '15%'),
        array('campo' => 'DESCRIPCION', 'width' => '30%'),
        array(
            'campo' => 'STATUS_DOC',
            'width' => '1%',
            'status_style' => array(
                array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white', 'text' => 'Sin Estatus', ),
                array('value' => '2', 'background_color' => '#007bff', 'text_color' => 'white', 'text' => 'En Proceso'),
                array('value' => '3', 'background_color' => '#28a745', 'text_color' => 'white', 'text' => 'Firmado'),
            ),
        ),

    ),

    'idDeplegar' => 'ID',
    'idFiltro' => 'MEJ_FK_MINUTA',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Mejoras al proceso de minuta',
    'nomSingular' => 'Mejoras ',

    'btnOpciones' => array(
        'editar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
        'detalles' => true,
        'duplicar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),
        'eliminar' => array(
            'mostrar_si' => '"[STATUS_DOC]" != "2" && "[STATUS_DOC]" != "3" ',
        ),

    ),
    'cssEditar' => ''
);

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
}

$template = array(
    'editForm' => 'modal'
);

$form = array(

    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'MEJ_ID',
        'tipo' => 'oculto',
    ),

    array(
        'campo' => 'MEJ_FK_MINUTA',
        'tipo' => 'oculto',
        'value' => $idFiltro
    ),

    array('etiq' => '</div>'),


    array('etiq' => '<div class="row">'),




    array(
        'col' => 'col-md-8',
        'campo' => 'MEJ_TIPO',
        'tipo' => 'select',
        'datos' => array(
            array('ID' => '0', 'CAMPO' => 'Seleccione...'),
            array('ID' => '1', 'CAMPO' => 'Mejora(s) al proceso concluidas'),
            array('ID' => '2', 'CAMPO' => 'Nuevas mejora(s) al proceso identificadas y comprometidas para la sig. reunión'),
        ),
        'label' => 'Tipo de mejora',
        'tabla' => 'p'
    ),


    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'campo' => 'MEJ_DESCRIPCION',
        'tipo' => 'textarea',
        'holder' => 'Descripción del acuerdo',
        'label' => 'Descripción',
        'tabla' => 'p',
        'alto' => '300px', //agregar px si no, no funciona
        'max' => '300'
    ),
    array('etiq' => '</div>')
);
?>