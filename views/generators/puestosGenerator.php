<?php
$tablas["p"] = array(
    'nom' => 'CNT_TERM_PUESTOS',
    'id' => 'TPT_ID'
);
$bd = array(
    'sqlDeplegar' => 'SELECT TPT_ID AS ID, TPT_DENOMINA_FEM AS "DENOMINACION FEMENINA",
    TPT_DENOMINA_MAS AS "DENOMINACION MASCULINA" FROM CNT_TERM_PUESTOS ORDER BY ID ASC',
    'columnas' => array(
        array('campo' => 'ID', 'width' => '20%'),
        array('campo' => 'DENOMINACION FEMENINA', 'width' => '40%'),
        array('campo' => 'DENOMINACION MASCULINA', 'width' => '40%')
    ),
'idDeplegar' => 'ID',
'busqLike' => '"DENOMINACION FEMENINA", "DENOMINACION MASCULINA"',
'nomPlural' => 'Puestos',
'nomSingular' => 'Puesto',
'busqIgual' =>'"ID"',
'tablaResponsiva' => 'true',
'cssEditar' => '',
'btnOpciones' => array(
    'editar' => true,
    'detalles' => false,
    'duplicar' => true,
    'eliminar' => true
    )
);
$form = array(
    array('etiq' => '<div class="row">'),
    array(
    'campo' => 'TPT_ID',
    'col' => 'col-md-2 col-12',
    'tipo' => 'text',
    'tabla' => 'p',
    'required' => 'true',
    'label' => 'ID'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
    'campo' => 'TPT_DENOMINA_FEM',
    'tipo' => 'text',
    'tabla' => 'p',
    'col' => 'col-md-6 col-12',
    'required' => 'true',
    'label' => 'Denominacion femenina'
    ),
    array(
    'campo' => 'TPT_DENOMINA_MAS',
    'tipo' => 'text',
    'tabla' => 'p',
    'col' => 'col-md-6 col-12',
    'required' => 'true',
    'label' => 'Denominacion masculina'
    ),
    array('etiq' => '</div>')
);
?>