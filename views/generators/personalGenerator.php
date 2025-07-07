<?php

	$tablas["p"]= array('nom'  =>"PERS_EMPLEADOS",
						'id'   => "EMP_ID",
						'getId'=> "SELECT (MAX(EMP_ID) + 1) AS ID FROM PERS_EMPLEADOS"
					);


	$reports[2] = array(
		'name'=>'Asignar plazas y nombramientos SAIIES',
		'url'=>BASE_URL."/personal/exec/asignar/"
	);

	$includes = [
		// 'index' => [
		// 	'tpls' => [ 
		// 		'personalGenerator/module',
		// 	],
		// ],

		'form' => [
			'tpls' => [ 
				'personalGenerator/formModule',
			]
		]
	];
	

	$bd = array(
		'sqlDeplegar' => 'SELECT * FROM (
						SELECT 
						EMP_ID as ID, EMP_EMPLEADO AS NUMEMPL,
						EMP_NOMBRE || \' \' || EMP_APPAT || \' \' || EMP_APMAT as EMPLEADO, 
						EMP_EMAIL as EMAIL,                      
						CASE 
						WHEN EMP_NIVEL_ACAD = 1  THEN \'Licenciatura\'
						WHEN EMP_NIVEL_ACAD = 2  THEN \'Maestría\'
						WHEN EMP_NIVEL_ACAD = 3  THEN \'Doctorado\'
						ELSE \' \'
						END AS "NIVEL ACADEMICO",
						T.URES ||\'-\'||T.LURES AS URE, U.DENOMINA
						FROM PERS_EMPLEADOS
						LEFT JOIN TURESH T ON T.URES = EMP_URE
						LEFT JOIN NOM_UNIDADES U ON u.id = EMP_CIUDAD
			) S
			LEFT JOIN (
			SELECT

			pnombram.nomb_nomb AS IDNOMBRA,
			pnombram.nomb_PLAZA AS IDPLAZA,

			pnombram.nomb_empl vemp_empl,
					fpersonas.pers_nombre vemp_nombre,
					fpersonas.pers_apepat vemp_apepat,
					fpersonas.pers_apemat vemp_apemat,
					pplazas.plaz_ures vemp_ures,
					pcpuestos.cpue_categ vemp_categ,
					pplazas.plaz_horas vemp_horas,

			
					pnombram.nomb_descrip vemp_nomb_descrip,
					ppuestos.pues_profe vemp_pues_profe,
					pnombram.nomb_ini,
							pnombram.nomb_fin,
							pnombram.nomb_ilice,
							pnombram.nomb_flice

				FROM fpersonas,
					personal.pnombram,
					personal.pplazas,
					personal.ppuestos,
					personal.pcpuestos,
					personal.pspuestos

				WHERE     pers_persona = nomb_empl

					AND plaz_plaza = nomb_plaza
					AND pues_psto = plaz_psto
					AND cpue_psto = pues_psto
					AND cpue_categ =

							(SELECT DECODE (COUNT (*),

											0, pues_categ_defa,

											MAX (cate_categ))

								FROM pcatempl

							WHERE cate_empl = nomb_empl AND cate_psto = plaz_psto)

					AND spue_spue = cpue_spue
					AND ppuestos.pues_profe = \'S\'
			) N
			ON N.vemp_empl = S.NUMEMPL

			ORDER BY ID DESC

			',
			
		'idDeplegar' => "ID",
		'busqLike' => "ID,EMPLEADO,EMAIL,'NIVEL ACADEMICO'",
		'busqIgual' => "ID,EMPLEADO,EMAIL,'NIVEL ACADEMICO'",
		'nomPlural' => "altas de empleados",
		'nomSingular' => "empleado",
		'cssEditar' => '
						h4{
							color:powderblue;
							border-bottom: 1px solid powderblue;
						}
						.box-body{
							max-width:980px; margin:auto;
						}
						.otra_fecha{
							display: none;
						}
	
		',		
	);


	$form = array(
						array('etiq'  =>'<div class="row">'),  

                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_NOMBRE',
							  'tipo'  =>'text',
							  'label' =>'Nombre',
							  'required'   =>'true',),
                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_APPAT',
							  'tipo'  =>'text',
							  'label' =>'Apellido paterno',
							  'required'   =>'true',),
                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_APMAT',
							  'tipo'  =>'text',
							  'label' =>'Apellido materno'),

                       array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_NIVEL_ACAD',
							  'datos' => array( 
							  				array('ID'=>'','CAMPO'=>'Seleccione...'),
                                            array('ID'=>'1','CAMPO'=>'Licenciatura'),
                                            array('ID'=>'2','CAMPO'=>'Maestría'),
                                            array('ID'=>'3','CAMPO'=>'Doctorado'),                                              
                                           ),
							  'tipo'  =>'select',
							  'label' =>'Nivel académico (con cédula)',
                              'holder'=>'',
                          	  'required'   =>'true',),

                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_EMAIL',
							  'tipo'  =>'email',
							  'label' =>'Email personal',
							  'required'   =>'true',
							
							),


                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_RFC',
							  'tipo'  =>'text',
							  'label' =>'RFC',
							  'max' => 13,
							  'required'   =>'true',

						),
                        array(
							  'col'      =>'col-6 col-sm-4 col-md-3',
							  'campo'    =>'EMP_CURP',
							  'tipo'     =>'text',
							  'label'    =>'CURP',
							  'max'      => 18,
							  'required' =>'true',

						),

                        array(
							  'col'      => 'col-6 col-sm-4 col-md-3',
							  'campo'    => 'EMP_TEL',
							  'tipo'     => 'text',
							  'label'    => 'Teléfono',
							  'required' => 'true',
							
							),

                        array(
                                'campo' =>'EMP_URE',
                                'col'   =>'col-6 col-sm-4 col-md-3',
                                'tipo'  =>'select',
                                'datosSQL' =>'SELECT URES AS "ID", URES||\' - \'||LURES AS "CAMPO" FROM TURESH  WHERE FECHA_FIN IS NULL order by URES ASC',
                                'label' =>'URE de adscripción',
                                'holder'=>'Seleccione...',
                            	'required'   =>'true',),

                        array(
                                'campo' =>'EMP_CIUDAD',
                                'col'   =>'col-6 col-sm-4 col-md-3',
                                'tipo'  =>'select',
                                'datosSQL' =>'SELECT ID AS "ID", DENOMINA AS "CAMPO" FROM NOM_UNIDADES ',
                                'label' =>'Ciudad',
                                'holder'=>'Seleccione...',
                            	'required'   =>'true',),


                        array(
							  'col'   =>'col-6 col-sm-4 col-md-3',
							  'campo' =>'EMP_EMPLEADO',
							  'tipo'  =>'text',
							  'label' =>'NÚMERO DE EMPLEADO'),

		                array('etiq'  =>'</div>'),  
                     

                        array(
							'campo' =>'EMP_ID',
							'tipo'  =>'oculto'
							),



					);

$codigoJS= '';

$class ="t";

class t extends Controller{

	private $_tim;

	public function __construct() {
		parent::__construct();
		$this->forzarLogin();
		$this->_per = $this->loadModel('personal');
	}


	/**
	 * Este metodo es obligatorio para los controllers
	 * @return void
	 */
	public function index(){}

	/**
	 * Se encarga de verificar si el empleado enviado esta duplicado o no
	 * 
	 * @return mixed
	 */
	public function verificaEmpleadoDuplicado(){

		if ( !is_empty( $_POST, 'EMP_ID' ) ) {
			echo json_encode([
				'duplicado' => false
			]);	

			return;
		}

		
		$datosEmpleado = [
			'nombre' => strtoupper( $_POST['EMP_NOMBRE'].' '.$_POST['EMP_APPAT'].' '.$_POST['EMP_APMAT']),
			'rfc'    =>	$_POST['EMP_RFC'],
			'curp'   => $_POST['EMP_CURP']
		];

		$respuesta = $this->_per->verificaDuplicidadEmpleado( $datosEmpleado );

		echo json_encode([
			'duplicado' => $respuesta
		]);
	}

    /**
	 * Asigna numeros de empleados
	 * 
     * @return void
     */
    public function asignar(){
      	$res = $this->_per->getPersonasSinNumero();

      	foreach ($res as $key => $fila) {
      		echo "<pre>";
      		print_r($fila);
      		echo "</pre>";

			$uresCarrillo = [ 
				'139200' => '0109200',
				
			];

      		switch ($fila[EMP_CIUDAD]) {				
				case 7:
					$ureAnterior = isset( $uresCarrillo[ $fila[EMP_URE] ] ) 
										? $uresCarrillo[ $fila[EMP_URE] ]
										: null;
					break;
      			case 4:
      				$ureAnterior = "0401100";
      				break;
      			case 3:
      				$ureAnterior = "0301400";
      				break;
      			case 2:
      				$ureAnterior = "0206000";
      				break;
      			case 1:
      				// Mercadotecnia, turismo
      				if($fila[EMP_URE]=='147830' or $fila[EMP_URE]=='147820' ){
						$ureAnterior = "0104100";

      				//Idiomas
					}else if($fila[EMP_URE]=='146420'  ) {
      					$ureAnterior = "0110200";

					}else{
						$ureAnterior = "0104500";

					}

      				break;
      			
      			default:
      				$ureAnterior = "";
      				break;
      		}

      		if($ureAnterior !=""){
      			$res = $this->_per->putEmpleado($fila,$ureAnterior);
      			echo "Ok";

      		}else{
      			echo  "No se encontró URE anterior para ".$fila[EMP_URE]."<br/>";

      		}

      	}


      }


  }





?>