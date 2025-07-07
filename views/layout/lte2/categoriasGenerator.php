<?php
$tablas["p"] = array(
    'nom' => 'CNT_CATEGORIAS',
    'id' => 'CAT_ID',
    'getId' => 'SELECT (MAX(PLT_ID)+1) AS ID FROM CNT_PLANTILLAS' 
);
$bd = array(
    'sqlDeplegar' => 'SELECT CAT_ID AS ID, CAT_CLASIFICA AS CALSIFICACION, CAT_MONTO AS MONTO,
    CAT_ABREVIA AS ABREVIATURA, CAT_DENOMINA_MAS AS "DENOMINACION MASCULINA", CAT_DENOMINA_FEM
    AS "DENOMINACION FEMENINA"FROM CNT_CATEGORIAS ORDER BY ID ASC',
    'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
        array('campo' => 'CALSIFICACION', 'width' => '10%'),
        array('campo' => 'MONTO', 'width' => '10%'),
        array('campo' => 'ABREVIATURA', 'width' => '10%'),
        array('campo' => 'DENOMINACION MASCULINA', 'width' => '30%'),
        array('campo' => 'DENOMINACION FEMENINA', 'width' => '30%')
    ),
    'idDeplegar' => 'ID',
    'busqLike' => '"DENOMINACION MASCULINA", "DENOMINACION FEMENINA"',
    'busqIgual' =>'"ID"',
    'nomPlural' => 'Categorias',
    'nomSingular' => 'Categoria',
    'btnOpciones' => array(
          'editar' => true,
          'detalles' => false,
          'duplicar' => false,
          'eliminar' => true
    ),
    'cssEditar' => ''
);
$form = array(
    array(
        'campo' => 'CAT_ID',
        'tipo' => 'oculto',
        'tabla' => 'p',
        'required' => 'true'
    ),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'CAT_ABREVIA',
        'tipo' => 'text',
        'tabla' => 'p',
        'col' => 'col-md-6 col-12',
        'label' => 'Abreviatura'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'CAT_CLASIFICA',
        'tipo' => 'text',
        'tabla' => 'p',
        'col' => 'col-md-6 col-12',
        'label' => 'Clasificacion'
    ),
    array(
        'campo' => 'CAT_MONTO',
        'tipo' => 'number',
        'label' => 'Monto $',
        'col' => 'col-md-6 col-12',
        'tabla' => 'p'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'CAT_DENOMINA_MAS',
        'tipo' => 'text',
        'label' => 'Denominacion masculina',
        'col' => 'col-md-6 col-12',
        'tabla' => 'p'
    ),
    array(
        'campo' => 'CAT_DENOMINA_MAS',
        'tipo' => 'text',
        'label' => 'Denominacion femenina',
        'col' => 'col-md-6 col-12',
        'tabla' => 'p'
    ),
    array('etiq' => '</div>')
);
?>