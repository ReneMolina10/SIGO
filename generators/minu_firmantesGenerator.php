<?php
$tablas["p"] = [
    'nom' => "DOC_MIN_FIRMANTES",
    'id' => "FIR_ID",
    'getId' => "SELECT (MAX(FIR_ID)+1) AS ID FROM DOC_MIN_FIRMANTES"
];

$bd = array(
    'sqlDeplegar' => "SELECT 
            FIR_ID AS ID,
             FIR_NUMEMPL AS NUMEMPL,
              FIR_PREFIJOESTUDIOS AS PREFIJO,
               FIR_NOMBRE AS NOMBRE, 
            FIR_PREFIJOESTUDIOS||' '|| FIR_NOMBRE AS FIRMANTE,
               FIR_CURP AS CURP, 
               FIR_CORREO AS CORREO, 
               FIR_CARGO AS CARGO, 
               FIR_FK_MINUTA,
               DM.STATUS_DOC
            FROM DOC_MIN_FIRMANTES DF
            LEFT JOIN DOC_MINUTA DM ON DM.MIN_ID = DF.FIR_FK_MINUTA",

    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'NUMEMPL', 'width' => '15%'),
        array('campo' => 'FIRMANTE', 'width' => '30%'),
        array('campo' => 'CARGO', 'width' => '20%'),
        array('campo' => 'CORREO', 'width' => '30%'),
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
    'idFiltro' => 'FIR_FK_MINUTA',
    'busqLike' => '',
    'busqIgual' => '',
    'nomPlural' => 'Firmantes de Minutas',
    'nomSingular' => 'Firmante',

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
$template = array(
    'editForm' => 'modal'
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



$form = array(
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-md-3',
        'campo' => 'FIR_NUMEMPL',
        'tipo' => 'text',
        'label' => 'Número de Empleado',
        'holder' => 'Escriba su número de empleado',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-2',
        'campo' => 'FIR_PREFIJOESTUDIOS',
        'tipo' => 'text',
        'label' => 'Prefijo de Estudios',
        'holder' => 'Mtro., Dra., Ing., etc.',
        'max' => '10',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-7',
        'campo' => 'FIR_NOMBRE',
        'tipo' => 'text',
        'holder' => 'Escriba su nombre',
        'max' => '80',
        'label' => 'Nombre',
        'tabla' => 'p'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),


    array(
        'col' => 'col-md-2',
        'campo' => 'FIR_CURP',
        'tipo' => 'text',
        'label' => 'CURP',
        'max' => '18',
        //'pattern' => '[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}',
        //'required' => true,
        'holder' => 'Escriba su CURP',
        'tabla' => 'p'
    ),

    array(
        'col' => 'col-md-4',
        'campo' => 'FIR_CORREO',
        'tipo' => 'email',
        'label' => ' Correo Electrónico',
        'holder' => ' Micorreo@uqroo.mx',
        'max' => '80',
        'tabla' => 'p'
    ),
    array(
        'col' => 'col-md-6',
        'campo' => 'FIR_CARGO',
        'tipo' => 'text',
        'label' => 'Cargo',
        'holder' => 'Jefe dpto, Director, etc.',
        'tabla' => 'p'
    ),

    array('etiq' => '</div>'),



    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'FIR_ID',
        'tipo' => 'oculto',
    ),
    array(
        'campo' => 'FIR_FK_MINUTA',
        'tipo' => 'oculto',
        'value' => $idFiltro
    ),
    array('etiq' => '</div>'),
);








?>