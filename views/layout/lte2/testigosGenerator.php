<?php

	$tablas["p"]= array('nom'  =>"CNT_TESTIGOS",
		                'id'   => "TES_ID",
		                'getId'=> "SELECT (MAX(TES_ID) + 1) AS ID FROM CNT_TESTIGOS"

		            );



$bd = [

	  'sqlDeplegar' => '
	  			 SELECT TES_ID AS ID, TES_NOMBRE AS TESTIGO, TES_CARGO AS CARGO, TES_URE FROM CNT_TESTIGOS
	  			 ORDER BY ID DESC
	             ',
	  'idDeplegar' => "ID",

      'busqLike' => '"TESTIGO","CARGO"',
      'busqIgual' =>'"ID"',

      'nomPlural' => "testigos",
      'nomSingular' => "testigo",
      'cssEditar' => '	

						'

];


$form = [


				[
					'col'   =>'col-xs-2',
					'campo' =>'TES_NUMEMPL',
					'tipo'  =>'text',
					'label' =>'NúmEmpl',
					'holder'=>'#',
					'pattern'=>'[A-Z]{1,20}'

				],

				[
					'col'   =>'col-xs-2',
					'campo' =>'TES_PREFIJO',
					'tipo'  =>'text',
					'label' =>'Prefijo',
					'holder'=>'Prefijo estudios',
					'pattern'=>'[A-Z]{1,20}'

				],

				[
					'col'   =>'col-xs-8',
					'campo' =>'TES_NOMBRE',
					'tipo'  =>'text',
					'label' =>'Nombre',
					'holder'=>'Nombre completo del testigo',
					'pattern'=>'[A-Z ]{1,120}'

				],

				[
					'col'   =>'col-xs-6',
					'campo' =>'TES_CARGO',
					'tipo'  =>'text',
					'label' =>'Cargo',
					'holder'=>'Denominación del cargo',
					'pattern'=>'[A-Z ]{1,120}'

				],


				[
					'campo' =>'TES_URE',
					'col'   =>'col-xs-4',
					'tipo'  =>'select',
					'datosSQL' =>'SELECT URES  AS ID, URES || \' - \' || LURES || DECODE(FECHA_FIN,NULL,\'\',\' (CERRADO) \') AS CAMPO  
					              FROM (SELECT URES, LURES,FECHA_FIN FROM TURESH UNION SELECT URES, LURES,FECHA_FIN FROM TURESP)',
					'label' =>'URE'],

				[
					'campo' =>'TES_STATUS',
					'col'   =>'col-xs-2',
					'tipo'  =>'select',
					'datos' => array( 
                                               array('ID'=>'1','CAMPO'=>'Activado'),
                                               array('ID'=>'0','CAMPO'=>'Desactivado')
                                               ),
					'label' =>'URE'],

				[
							  'campo' =>'TES_ID',
							  'tipo'  =>'oculto'
				],

				];




?>