<?php
    $template = [
        'editForm' => 'modal',
        'btnRegistrar' => false,
    ];

	$tablas["p"]= ['nom'    =>  "CNT_CONTRATOS",
		           'id'     =>  "ID",
		           'getId'  =>  "SELECT (MAX(ID) + 1) AS ID FROM CNT_CONTRATOS"
                  ];
$unidadA    = @$_SESSION["ua".BASE_SESION];
$anioActual = date('Y');

$bd = [

    'columnas' => [
        ['campo' => 'ID'],
        ['campo' => 'FOLIO'],
        ['campo' => 'URE'],
        ['campo' => 'TIPO'],
        ['campo' => 'CATEGORÍA'],
        ['campo' => 'NOMBRE'],
        ['campo' => 'HORAS TOTALES'],
        ['campo' => 'MONTO TOTAL'],
        ['campo' => 'INICIO'],
        ['campo' => 'FIN'],
        ['campo' => 'NSTATUS'],
        ['campo' => 'OPCIONES'],

    ],

    'sqlDeplegar' => 'SELECT
            CNT_PK_CONTRATO AS ID,
            U.UA_CLAVE|| \'-\' || CNT_PK_ANIO || \'-\' || CNT_PK_CONTRATO AS FOLIO,
            DECODE(CNT_STATUS, 1, \'Abierto\', 2, \'Cerrado\', 3, \'CANCELADO\') AS NSTATUS,
            CNT_FK_URE || \'-\' || LURES AS URE,
            TC.TCNT_ABREVIA AS "TIPO",
            TC.TCNT_DENOMINACION AS TIPO_CONTRATO,
            CC.CAT_ABREVIA AS "CATEGORÍA",
            to_char(DECODE(CNT_MONTO_MENSUAL, 0, CNT_MONTO_QUINCENA * 2, NULL, CNT_MONTO_QUINCENA * 2, CNT_MONTO_MENSUAL), \'$999,999.99\') AS "MONTO TOTAL",
            CNT_FECHA_INICIO AS INICIO,
            CNT_FECHA_FIN AS FIN,
            DECODE (CNT_NUM_HORAS_SEM,
            NULL,
            \'-\',
            CNT_NUM_HORAS_SEM)AS "HORAS TOTALES",
            DECODE(CNT_NUM_HORAS, NULL, \'-\', CNT_NUM_HORAS) AS HORAS_TOTALES,
            DECODE (CNT_FK_NOEMPL,
            NULL,
            \'CANCELADO\',
            CNT_FK_NOEMPL|| \'-\' || VEMP_NOMBRE || \' \' || VEMP_APEPAT || \' \' || VEMP_APEMAT) AS NOMBRE,
            \' <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-upload"></i></button>
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fa-solid fa-print"></i></button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item " href="#" style="color: #dc3545 !important;"><i class="fa-solid fa-trash"></i> Eliminar</a>
                        </div>
                    </div>
                </div>\' AS OPCIONES
        FROM(SELECT	* FROM ( SELECT D.*, rownum r FROM ( SELECT * FROM CNT_CONTRATOS WHERE CNT_PK_ANIO = 2023 AND CNT_PK_UA = 1) D ))C
        LEFT JOIN PVEMPLDOS P
            ON P.VEMP_EMPL = C.CNT_FK_NOEMPL
        LEFT JOIN CNT_UACADEMICAS U
            ON	U.UA_ID = C.CNT_PK_UA
        LEFT JOIN CNT_TIPOCONT TC
            ON	TC.TCNT_ID = C.CNT_FK_TIPO
        LEFT JOIN CNT_CATEGORIAS CC
            ON 	CC.CAT_ID_CAT = C.CNT_FK_CATEGORIA
        LEFT JOIN TURESH UR
            ON UR.URES = C.CNT_FK_URE
        ORDER BY
            CNT_PK_ANIO DESC,
            C.CNT_PK_CONTRATO DESC',
        'idDeplegar'  => "ID",
        'busqLike'    => '"FOLIO"',
        'busqIgual'   =>'"ID"',
        'nomPlural'   => "Contratos",
        'nomSingular' => "Contrato",
        'cssEditar'   => '',
        'btnOpciones' => false,
        /*'btnOpciones' => [
            'editar'    => false,
            'detalles'  => false,
            'duplicar'  => false,
            'eliminar'  => true
        ],*/
        
];
 
$form = [

];

?>