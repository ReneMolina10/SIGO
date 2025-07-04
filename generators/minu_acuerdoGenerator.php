<?php
$tablas["p"] = [
    'nom' => "DOC_MIN_ACUERDOS",
    'id' => "ACU_ID",
    'getId' => "SELECT (MAX(ACU_ID)+1) AS ID FROM DOC_MIN_ACUERDOS "
];

$bd = array(
    'sqlDeplegar' => "SELECT
                            ACU_ID AS ID,
                            ACU_DESCRIPCION AS DESCRIPCION,
                            LURES AS RESPONSABLE,
                            ACU_FECHA_FIN   AS FECHA_FIN,
                            ASU_TEMA AS ASUNTO,
                            ACU_FK_MINUTA,
                            DM.STATUS_DOC
                                FROM DOC_MIN_ACUERDOS DA
                                LEFT JOIN TURESH ON URES = ACU_RESPONSABLE
                                LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DA.ACU_FK_MINUTA
                                LEFT JOIN DOC_MIN_ASUNTO ON ASU_ID = ACU_FK_ASUNTO",

    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'RESPONSABLE', 'width' => '15%'),
        array('campo' => 'ASUNTO', 'width' => '15%'),
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
    'idFiltro' => 'ACU_FK_MINUTA',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'ACUERDOS DE MINUTAS',
    'nomSingular' => 'Acuerdo',

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
        'campo' => 'ACU_ID',
        'tipo' => 'oculto',
    ),

    array(
        'campo' => 'ACU_FK_MINUTA',
        'tipo' => 'oculto',
        'value' => $idFiltro
    ),

    array('etiq' => '</div>'),


    array('etiq' => '<div class="row">'),




    array(
        'col' => 'col-md-5',
        'campo' => 'ACU_RESPONSABLE',
        'tipo' => 'select',
        'datosSQL' => "SELECT ID_URE_PAR AS ID, ID_URE_PAR||' - '||LURES AS CAMPO FROM DOC_FIR_AREAS_PARTICIPA 
                        LEFT JOIN TURESH ON URES = ID_URE_PAR
                        WHERE ID_FK_MINUTA= $idFiltro",
        'placeholder' => 'Responsable del acuerdo',
        'label' => 'Responsable del acuerdo',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-5',
        'campo' => 'ACU_FK_ASUNTO',
        'tipo' => 'select',
        'datosSQL' => "SELECT ASU_ID AS ID, ASU_TEMA AS CAMPO FROM DOC_MIN_ASUNTO 
                       WHERE ASU_FK_MINUTA= $idFiltro",
        'placeholder' => 'Asunto',
        'label' => 'Asunto',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-2',
        'campo' => 'ACU_FECHA_FIN',
        'tipo' => 'date',
        'placeholder' => 'Fecha de finalización',
        'label' => 'Fechar de finalización',
        'tabla' => 'p'
    ),



    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'campo' => 'ACU_DESCRIPCION',
        'tipo' => 'textarea',
        'holder' => 'Descripción del acuerdo',
        'label' => 'Descripción',
        'tabla' => 'p',
        'alto' => '200px', //agregar px si no, no funciona
        'max' => '1000',
        //'encrypt' => true, // Si se requiere cifrado
    ),
    array('etiq' => '</div>')
);
?>