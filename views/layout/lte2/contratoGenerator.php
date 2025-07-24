<?php
$tablas["t"] = array(
    'nom' => 'CNT_TIPOCONT',
    'id' => 'TCNT_ID',
    'getId' => 'SELECT (MAX(TCNT_ID)+1) AS ID FROM CNT_TIPOCONT'
);
$bd= array(
    'sqlDeplegar' => 'SELECT TCNT_ID AS ID, TCNT_DENOMINACION AS DENOMINACION,
    TCNT_STATUS AS STATUS, TCNT_CLAVE AS CLAVE,TCNT_MARGENES AS MARGENES, 
    TCNT_ABREVIA AS ABERVIATURA, TCNT_SAIIES AS SAIIES,
    TCNT_GRUPO AS GRUPO FROM CNT_TIPOCONT ORDER BY ID ASC',
    'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
        array('campo' =>'DENOMINACION', 'width' => '40%'),
        array('campo' => 'STATUS', 'width' => '10%',
        'status_style' =>
        array(
            array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white',
         'text'=> 'Deshabilitada'),
         array('value' => '1', 'background_color' => '#28a745', 'text_color' => 'white', 
         'text' => 'Habilitada')
         )),
        array('campo' => 'CLAVE', 'width' => '20%'),
        array('campo' => 'SAIIES', 'width' => '20%')
        ),
    'idDeplegar' => 'ID',
    'busqLike' => '"DENOMINACION"',
    'busqIgual' =>'"ID"',
    'nomPlural' => 'Tipo contratos',
    'nomSingular' => 'Tipo contrato',
    'btnOpciones' => array(
          'editar' => true,
          'detalles' => false,
          'duplicar' => false,
          'eliminar' => true
    ),
    'cssEditar' => ''
);
$form = array(
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'TCNT_ID',
        'tipo' => 'oculto',
        'tabla' => 't',
        'required' => 'true'
    ),
    array(
        'campo' => 'TCNT_DENOMINACION',
        'tipo' => 'text',
        'tabla' => 't',
        'required' => 'true',
        'label' => 'Denominación',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'col' => 'col-md-6 col-12',
        'campo' => 'TCNT_STATUS',
        'datos' => array( 
            array('ID'=>'0','CAMPO'=>'Deshabilitado'),
            array('ID'=>'1','CAMPO'=>'Habilitado')
        ),
        'tipo'  =>'select',
        'label' => 'Status',
        'required' => 'true'
    ),
    array(
        'campo' => 'TCNT_CLAVE',
        'tipo' => 'text',
        'tabla' => 't',
        'required' => 'true',
        'label' => 'Clave',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'campo' => 'TCNT_ABREVIA',
        'tipo' => 'text',
        'tabla' => 't',
        'required' => 'true',
        'label' => 'Abreviatura',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'campo' => 'TCNT_SAIIES',
        'tipo' => 'text',
        'tabla' => 't',
        'required' => 'true',
        'label' => 'SAIIES',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'campo' => 'TCNT_GRUPO',
        'tipo' => 'text',
        'tabla' => 't',
        'required' => 'true',
        'label' => 'Grupo',
        'col' => 'col-md-6 col-12'
    ),
    array('etiq' => '</div>')
);
?>