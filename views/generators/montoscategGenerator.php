<?php

    $template = [
        'editForm' => 'modal',
    ];

    $tablas["p"]= array('nom'  =>"NOM_CATEGORIA_MONTOS",
        'id'   => "CMTO_ID",
        'getId'=> "SELECT (MAX(CMTO_ID) + 1) AS ID FROM  NOM_CATEGORIA_MONTOS"
    );

    $bd = [
        'sqlDeplegar' => "SELECT
                            NM.CMTO_ID AS ID,
                            NM.CMTO_IDCATEGORIA || ' - ' || PT.CATEGORIA AS CATEGORIA,
                            CMTO_FECHA_INICIO AS FECHA_INICIO,
                            CMTO_FECHA_FIN AS FECHA_FIN,
                            MONTO_MENSUAL AS MONTO,
                            CMTO_IDCONCEPTO AS PRESTACION
                        FROM
                            SISRH.NOM_CATEGORIA_MONTOS NM
                        LEFT JOIN SISRH.PLT_TABULADOR PT ON
                            PT.ID_CATEGORIA = NM.CMTO_IDCATEGORIA
                        WHERE
                            NM.CMTO_FECHA_FIN IS NULL
                        ORDER BY
                            CMTO_ID DESC",
	    'idDeplegar'  => "ID",
	    'idFiltro'    => "ID_CATEGORIA",
        'busqLike'    => 'CATEGORIA',
        'busqIgual'   => 'CATEGORIA',
        'nomPlural'   => "Detalle de Montos de Categorias",
        'nomSingular' => "Detalle de Monto de Categoria",
        'cssEditar'   => ''
    ];

    $form = [
			['etiq'  =>'<div class="row">'],

                [
                    'campo'     =>  'CMTO_IDCATEGORIA',
                    'col'       =>  'col-md-6',
                    'label'     =>  'Categoria',
                    'holder'    =>  'Seleccione una Categoria',
                    'tipo'      =>  'select_ajax',
                    'sql'       =>  'SELECT NC.ID_CATEGORIA AS "id", CATEGORIA AS "text" FROM NOM_CATEGORIAS NC ORDER BY ID_CATEGORIA DESC',
                    'detalles'  =>  ' required'
                    
                ],

                [
                    'campo'     =>  'MONTO_MENSUAL',
                    'col'       =>  'col-md-3',
                    'tipo'      =>  'number',
                    'detalles'  =>  ' step="0.01" ',
                    'label'     =>  'Monto Mensual',
                    'detalles'  =>  ' required'
                ],

                [
                    'campo'     =>  'CMTO_IDCONCEPTO',
                    'col'       =>  'col-md-3',
                    'tipo'      =>  'number',
                    'label'     =>  'Número de Prestaciones',
                    'detalles'  =>  ' required'

                ],

                [
                    'campo'     =>  'CMTO_FECHA_INICIO',
                    'col'       =>  'col-md-3',
                    'label'     =>  'fecha de inicio',
                    'tipo'      =>  'date',
                    'detalles'  =>  ' required'
                ],

                [
                    'campo'     =>  'CMTO_FECHA_FIN',
                    'col'       =>  'col-md-3',
                    'label'     =>  'fecha de fin',
                    'tipo'      =>  'date',
                    'detalles'  =>  ' required'
                ],

            ['etiq'  =>'</div>'],		
        [ 
          'campo' =>'CMTO_ID',
          'tipo'  =>'oculto'
        ],
    ];
?>