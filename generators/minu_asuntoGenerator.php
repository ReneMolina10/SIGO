<?php
$tablas["p"] = [
    'nom' => "DOC_MIN_ASUNTO",
    'id' => "ASU_ID",
    'getId' => "SELECT (MAX(ASU_ID)+1) AS ID FROM DOC_MIN_ASUNTO"
];

$bd = array(
    'sqlDeplegar' => "SELECT 
            ASU_ID AS ID,
            ASU_TEMA AS TEMA,
            ASU_PRESENTA||' - '||LURES AS PRESENTA,
            ASU_RESUMEN,
            ASU_FK_MINUTA,
            DM.STATUS_DOC
            FROM DOC_MIN_ASUNTO DA
            LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DA.ASU_FK_MINUTA
            LEFT JOIN TURESH ON URES = ASU_PRESENTA",

    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'TEMA', 'width' => '15%'),
        array('campo' => 'PRESENTA', 'width' => '30%'),
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
    'idFiltro' => 'ASU_FK_MINUTA',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Asuntos de Minutas',
    'nomSingular' => 'Asunto',

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
        'campo' => 'ASU_ID',
        'tipo' => 'oculto',
    ),

    array(
        'campo' => 'ASU_FK_MINUTA',
        'tipo' => 'oculto',
        'value' => $idFiltro
    ),




    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-6',
        'campo' => 'ASU_TEMA',
        'tipo' => 'text',
        'holder' => 'Escriba el tema del asunto',
        'label' => 'Tema',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-6',
        'campo' => 'ASU_PRESENTA',
        'tipo' => 'select',
        'datosSQL' => "SELECT ID_URE_PAR AS ID, ID_URE_PAR||' - '||LURES AS CAMPO FROM DOC_FIR_AREAS_PARTICIPA 
                        LEFT JOIN TURESH ON URES = ID_URE_PAR
                        WHERE ID_FK_MINUTA= $idFiltro",
        'holder' => 'Presenta el asunto',
        'label' => 'Área que presenta',
        'tabla' => 'p'
    ),


    array(
        'col' => 'col-md-12',
        'campo' => 'ASU_RESUMEN',
        'tipo' => 'textarea',
        'holder' => 'Resumen del asunto',
        'label' => 'Resumen del asunto',
        'tabla' => 'p',
        'alto' => '150px',
        'max' => '800'
    ),
    array('etiq' => '</div>'),

);
?>