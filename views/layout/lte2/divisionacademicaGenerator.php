<?php
$tablas["p"] = array(
    'nom' =>'CNT_DA',
    'id' => 'DA_ID',
    'getId'  => 'SELECT (MAX(DA_ID)+1) AS ID FROM CNT_DA'
);
$bd = array(
    'sqlDeplegar' => 'SELECT DA_ID AS ID, DA_DENOMINACION AS DENOMINACION,
    DA_STATUS AS STATUS, DA_SIGLA AS SIGLAS, DA_URI AS URI, UA_DENOMINACION
    AS CIUDAD FROM CNT_DA INNER JOIN CNT_UACADEMICAS ON CNT_DA.DA_FK_ID_UA = 
    CNT_UACADEMICAS.UA_ID ORDER BY ID ASC',
    'columnas' => array(
        array('campo' => 'ID', 'width' => '5%'),
        array('campo' => 'SIGLAS', 'width' => '10%'),
        array('campo' => 'DENOMINACION', 'width' => '35%'),
        array('campo' => 'CIUDAD', 'width' => '20%'),
        array('campo' => 'URI', 'width' => '10%'),
        array('campo' => 'STATUS', 'width' => '10%',
        'status_style' =>
        array(
            array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white',
         'text'=> 'Inactivo'),
         array('value' => '1', 'background_color' => '#28a745', 'text_color' => 'white', 
         'text' => 'Activo')
         )
        )
    ),
    'idDeplegar' => 'ID',
    'busqLike' => '"DENOMINACION", "CIUDAD", "SIGLAS"',
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
        'campo' => 'DA_ID',
        'tipo' => 'oculto',
        'tabla' => 'p',
        'required' => 'true'
    ),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'DA_DENOMINACION',
        'tipo' => 'text',
        'tabla' => 'p',
        'required' => 'true',
        'label' => 'Denominacion',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'tipo' => 'text',
        'campo' => 'DA_SIGLA',
        'label' => 'Siglas',
        'required' => 'true',
        'col' => 'col-md-3 col-12',
        'tabla' => 'p'
    ),
    array(
        'label' => 'Unidad academica',
        'campo' => 'DA_FK_ID_UA',
        'tipo' => 'select',
        'datosSQL' => "SELECT UA_ID AS ID, UA_DENOMINACION AS CAMPO
        FROM CNT_UACADEMICAS",
        'tabla' => 'p',
        'col' => 'col-md-3 col-12'
    ),
   array('etiq' => '</div>'),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'DA_URI',
        'label' => 'URI',
        'tipo' => 'text',
        'required' => 'true',
        'tabla' => 'p',
        'col' => 'col-md-6 col-12'
    ),
    array(
        'col' => 'col-md-6 col-12',
        'campo' => 'DA_STATUS',
        'datos' => array( 
            array('ID'=>'0','CAMPO'=>'Inactivo'),
            array('ID'=>'1','CAMPO'=>'Activo')
        ),
        'tipo'  =>'select',
        'label' => 'Status',
        'tabla' => 'p'
    ),
   array('etiq' => '</div>')
);
?>