<?php
$tablas["p"] = array(
    'nom' => 'CNT_TERM_GRADACAD',
    'id' => 'TGA_ID'
);
$bd = array(
'sqlDeplegar' => 'SELECT TGA_ID AS ID, TGA_PREFIJO_FEM AS "PREFIJO FEMENINO", 
TGA_PREFIJO_MAS AS "PREFIJO MASCULINO", TGA_DENOMINA_FEM AS "DENOMINACION FEMENINA",
TGA_DENOMINA_MAS AS "DENOMINACION MASCULINA" FROM CNT_TERM_GRADACAD ORDER BY ID ASC',
'columnas' => array(
    array('campo' => 'ID', 'width' => '10%'),
    array('campo' => 'PREFIJO FEMENINO', 'width' => '10%'),
    array('campo' => 'PREFIJO MASCULINO', 'width' => '10%'),
    array('campo' => 'DENOMINACION FEMENINA', 'width' => '30%'),
    array('campo' => 'DENOMINACION MASCULINA', 'width' => '30%')
),
'idDeplegar' => 'ID',
'busqLike' => '"DENOMINACION FEMENINA", "DENOMINACION MASCULINA", "PREFIJO FEMENINO", "PREFIJO MASCULINO"',
'nomPlural' => 'Grados academicos',
'nomSingular' => 'Grado academico',
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
    'campo' => 'TGA_ID',
    'col' => 'col-md-2 col-12',
    'tipo' => 'text',
    'tabla' => 'p',
    'required' => 'true',
    'label' => 'ID'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
    'campo' => 'TGA_PREFIJO_FEM',
    'tipo' => 'text',
    'col' => 'col-md-6 col-12',
    'tabla' => 'p',
    'required' => 'true',
    'label' => 'Prefijo femenino'
    ),
    array(
    'campo' => 'TGA_PREFIJO_MAS',
    'tipo' => 'text',
    'tabla' => 'p',
    'col' => 'col-md-6 col-12',
    'required' => 'true',
    'label' => 'Prefijo masculino'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
    'campo' => 'TGA_DENOMINA_FEM',
    'tipo' => 'text',
    'tabla' => 'p',
    'col' => 'col-md-6 col-12',
    'required' => 'true',
    'label' => 'Denominacion femenina'
    ),
    array(
    'campo' => 'TGA_DENOMINA_MAS',
    'tipo' => 'text',
    'tabla' => 'p',
    'col' => 'col-md-6 col-12',
    'required' => 'true',
    'label' => 'Denominacion masculina'
    ),
    array('etiq' => '</div>'),
);
?>