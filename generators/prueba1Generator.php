<?php
$template = array('editForm' => 'modal',);

$tablas["p"] = array(
    'nom' => 'PRUEBA1',
    'id' => 'ID',
    'getId' => 'SELECT (MAX(ID)+1) AS ID FROM PRUEBA1'
);

$bd = array(
    'sqlDeplegar' => 'SELECT ID, ID AS IDPADREeee, NOMBRE  FROM PRUEBA1',


    /*'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
    ),*/
    'idDeplegar' => 'ID',
    'busqLike' => '"NOMBRE"',
    'busqIgual' => '"ID"',
    'nomPlural' => 'PRUEBA',
    'nomSingular' => 'Registro',
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

$form = array(
    array('etiq' => '<div class="row">'),

    array(
        'campo' => 'NOMBRE',
        'tipo' => 'text',
        'required' => 'true',
        'label' => 'nombre',
        'col' => 'col-12'
    ),
    /*array(
        'col' => 'col-6',
        'tipo' => 'crud-table',
        'label'   => 'Esto es una prueba',
    ),*/
    array(
        'campo' => 'ID',
        'tipo' => 'oculto'
    ),

    // Sub‐Generator incrustado como “crud-table”
    //===============================================================================================
    array(
        'name_crud_table' => 'prueba2',
        'tipo' => 'crud-table',
        'label' => 'esto es una prueba con crud-table',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('campo' => 'NOMBRE2', 'label' => 'Nombre hijo', 'tipo' => 'text', 'required' => true),
            array('campo' => 'ID', 'tipo' => 'oculto', ),
            array('campo' => 'ID_PADRE', 'tipo' => 'oculto', 'value' => '[IDPADRE]'),
        ),

        // 2) Definición de tablas del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => 'PRUEBA2',
                'id' => 'ID',
                'getId' => 'SELECT (MAX(ID)+1) AS ID FROM PRUEBA2',
                'tRel' => 'h',          // índice de tabla padre en $tablas principal
                'cRel' => 'FACT_ID'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT * FROM PRUEBA2 WHERE ID_PADRE = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"NOMBRE2"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Detalles',
            'nomSingular' => 'Detalle',
            /*'columnas'     => array(
                array('campo'=>'ID',     'width'=>200),
                array('campo'=>'NOMBRE', 'width'=>80),
            ),*/
            //'btnOpciones'  => array()  // usa los botones por defecto
        ),
        'template' => array(
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ),
    ),
    //======================================================================================

    // Sub‐Generator incrustado como “crud-table”
    //===============================================================================================
    array(
        'name_crud_table' => 'prueba3',
        'tipo' => 'crud-table',
        'label' => 'esto es una 2da prueba con crud-table',
        'col' => 'col-12',

        // 1) Campos del formulario del sub‐Generator
        'form' => array(
            array('campo' => 'NOMBRE', 'label' => 'Nombre hijo 2', 'tipo' => 'text', 'required' => true),
            array('campo' => 'ID', 'tipo' => 'oculto', ),
            array('campo' => 'ID_PADRE', 'tipo' => 'oculto', 'value' => '[IDPADRE]'),
        ),

        // 2) Definición de tablas del sub‐Generator
        'tablas' => array(
            'p' => array(
                'nom' => 'PRUEBA3',
                'id' => 'ID',
                'getId' => 'SELECT (MAX(ID)+1) AS ID FROM PRUEBA3',
                'tRel' => 'h',          // índice de tabla padre en $tablas principal
                'cRel' => 'FACT_ID'     // FK al registro padre
            )
        ),

        // 3) Parámetros de BD (listado, columnas, botones…) del sub‐Generator
        'bd' => array(
            'sqlDeplegar' => "SELECT ID, NOMBRE AS NOMBRE3, ID_PADRE FROM PRUEBA3 WHERE ID_PADRE = [IDPADRE]",
            'idDeplegar' => 'ID',
            'busqLike' => '"NOMBRE3"',
            'busqIgual' => '"ID"',
            'nomPlural' => 'Detalles2',
            'nomSingular' => 'Detalle2',
            'bPaginate' => false, // o true
            'bFilter'   => false, // o true
            'bInfo'     => false, // o true
            /*'columnas'     => array(
                array('campo'=>'ID',     'width'=>200),
                array('campo'=>'NOMBRE', 'width'=>80),
            ),*/
            //'btnOpciones'  => array()  // usa los botones por defecto
        ),

        'template' => [
            'editForm' => 'modal',
            //'btnRegistrar' => false,
        ],
    ),
    //======================================================================================

    array('etiq' => '</div>'),



);

$codigoJS = '';

?>