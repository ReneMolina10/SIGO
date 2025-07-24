<?php

	$tablas["p"]= array('nom'  =>"CNT_SOLICITA",
		                'id'   => "SOL_ID",
		                'getId'=> "SELECT (MAX(SOL_ID) + 1) AS ID FROM CNT_SOLICITA"
					);
	
	$num_empldo = $_SESSION['numempl'.BASE_SESION];

	$bd = array(
		
		'columnas' => array(
				array('campo' => 'ID','width' => '2%',),
				array('campo' => 'NOMBRAMIENTO','width' => '2%',),
				array('campo' => 'NIVEL_ACA','width' => '2%',),
				array('campo' => 'NUMEMPL','width' => '5%',),
				array('campo' => 'EMPLEADO'),
				array('campo' => 'RFC'),
				array('campo' => 'CURP'),
				array('campo' => 'FECHA_INGRESO'),


				array('campo' => 'ID_URE','width' => '5%',),
				array('campo' => 'URE'),
				array('campo' => 'UBICACION'),
				array('campo' => 'ASIGNATURAS'),
				array('campo' => 'TOT GPOS','width' => '2%',),
				array('campo' => 'TOT HRS','width' => '2%',),
			//	array('campo' => 'STATUS','width' => '4%',),
				array('campo' => 'OFICIO SOLICITA','width' => '10%',),
				array('campo' => 'OFICIO CANCELA','width' => '10%',),

				array('campo' => 'STATUS','width' => '10%',),

				
				array('campo' => 'NUMC','width' => '5%',),
				
		),
 
		'sqlDeplegar' => '

SELECT ID,

GETIFNOMBRA(NUMEMPL,(SELECT PER_FECHA_INI FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)) AS NOMBRAMIENTO,
GETGRADOESTUDIOS(NUMEMPL) as NIVEL_ACA,

NUMEMPL,  EMPLEADO, RFC, CURP, FECHA_INGRESO, ID_URE,URE,UBICACION,ASIGNATURAS,"TOT GPOS","TOT HRS",(


SELECT --CNT_PK_CONTRATO AS NUMC, CNT_FK_NOEMPL AS NUMEMPLC,CNT_FK_URE AS UREC
COUNT(*) AS CANTIDAD
  FROM CNT_CONTRATOS 
WHERE  CNT_PK_ANIO = (SELECT PER_ANIO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)
AND CNT_PERIODO_SAE = (SELECT PER_PERIODO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)
AND SOL.NUMEMPL = CNT_FK_NOEMPL AND SOL.ID_URE = CNT_FK_URE



) AS NUMC,CLAVE AS "OFICIO SOLICITA",CLAVECANCEL AS "OFICIO CANCELA",

DECODE(CLAVE, NULL, \'Pendiente\', DECODE(CLAVECANCEL,NULL,\'Activo\' ,\'Cancelado\' ) ) AS STATUS

 FROM 
(
		    SELECT 
			SOL_ID as ID,  PER.pers_persona AS NUMEMPL,
			PER.pers_nombre || \' \' || PER.PERS_APEPAT || \' \' || PER.PERS_APEMAT as EMPLEADO, 

			PERS_RFC AS RFC, PERS_CURP AS CURP, PERS_FECHAING AS FECHA_INGRESO,

			TUR.URES as ID_URE, TUR.lures as URE, U.UBI_DENOMINACION AS "UBICACION", GET_ASIGNATURA_BY_ID_SOL(SOL.SOL_ID) AS ASIGNATURAS, (SELECT COUNT(*) FROM CNT_SOLICITA_ASIG WHERE ID_SOL = SOL.SOL_ID ) AS "TOT GPOS", SOL_HRS AS "TOT HRS", ST_DENOMINA AS STATUS, SOL_OFICIO AS IDOFICIO,
			SOL_OFICIO_CANCELA AS IDOFICIOC
			FROM 
			(SELECT * FROM CNT_SOLICITA 
			WHERE SOL_FK_PERIODO = 
			    (
				SELECT PER_ID FROM 
				(
					SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC
				) WHERE ROWNUM = 1
				)

			) SOL
			INNER JOIN finanzas.fpersonas PER ON PER.pers_persona = SOL.sol_numempl
			INNER JOIN TURESH TUR ON TUR.ures = sol.sol_fk_ure
			LEFT JOIN  PLT_UBICACIONES U ON u.ubi_id = SOL.SOL_LUGAR_ADSC
			LEFT JOIN  CNT_SOLICITA_STATUS S ON S.ST_ID = SOL.SOL_STATUS


			-- WHERE SOL_STATUS != 3 

) SOL            


LEFT JOIN (SELECT OFI_CLAVE AS CLAVE, OFI_ID FROM CNT_SOLICITA_OFICIO) OFI
ON OFI.OFI_ID = SOL.IDOFICIO

LEFT JOIN (SELECT OFI_CLAVE AS CLAVECANCEL, OFI_ID FROM CNT_SOLICITA_OFICIO_CANCEL) OFIC
			ON OFIC.OFI_ID = SOL.IDOFICIOC

-- order by NUMEMPL

			',

    'sqlContar' => 'SELECT COUNT(*) AS TOTAL FROM CNT_SOLICITA WHERE SOL_FK_PERIODO = 

			(
SELECT PER_ID FROM (
SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC
) WHERE ROWNUM = 1
) ',


		'idDeplegar' => "ID",
		'busqLike' => 'ID,EMPLEADO,URE,ID_URE,URE,"UBICACION",STATUS',
		'busqIgual' => 'ID,EMPLEADO,URE,ID_URE,URE,"UBICACION",STATUS',
		'nomPlural' => "Solicitudes de contrato",
		'nomSingular' => "Solicitud de contrato",
		'tablaResponsiva' => "false",
		'tablaScrollX' => "true",


		//'getIdForInsert' => "SELECT (MAX(EARE_AREA    ) + 1) AS ID FROM PEAREACAD",
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
		/*'buttons' => array(
			array(
				'label'=>'Descargar',
				'icon'=>'fa-pencil-alt', //librería Font Awesome
				'class'=>"", 
				'href'=>BASE_URL."paginas/editar/[ID]",
				'target'=>"_blank"
			),	
			array(
				'label'=>'Deshabilitar',
				'icon'=>'fa-pencil-alt', //librería Font Awesome
				'class'=>"", 
				'href'=>BASE_URL."paginas/editar/[ID]",
				'target'=>"_blank"
			),
		)*/
	);

/*
	$reports[0] = array(
						'name'=> 'Descargar solicitudes ',
						'sql'=> "",
						'url'=> "http://srh.uqroo.mx/contratospa/exec/generaword/"
					);

	*/
 
	$reports[0] = array(
						'name'=> 'Detalle de materias - URE SAE ',
						'sql'=> "SELECT ID,NUMEMPL,EMPLEADO,ID_URE,URE,UBICACION,TOTAL_GRUPOS,TOTAL_HORAS,DECODE(NUMC,NULL,'-',NUMC) AS NUMC,STATUS,CLAVE,ID_ASIG AS ID_GRUPO_SAE,NOM_MATERIA, ID_DIVISION AS ID_DIVISION_SAE FROM 
(
		    SELECT 
			SOL_ID as ID,  PER.pers_persona AS NUMEMPL,
			PER.pers_nombre || ' ' || PER.PERS_APEPAT || ' ' || PER.PERS_APEMAT as EMPLEADO, 
			TUR.URES as ID_URE, TUR.lures as URE, U.UBI_DENOMINACION AS UBICACION,  (SELECT COUNT(*) FROM CNT_SOLICITA_ASIG WHERE ID_SOL = SOL.SOL_ID ) AS TOTAL_GRUPOS, SOL_HRS AS TOTAL_HORAS, ST_DENOMINA AS STATUS, SOL_OFICIO AS IDOFICIO
			FROM CNT_SOLICITA SOL
			INNER JOIN finanzas.fpersonas PER ON PER.pers_persona = SOL.sol_numempl
			INNER JOIN TURESH TUR ON TUR.ures = sol.sol_fk_ure
			LEFT JOIN PLT_UBICACIONES U ON u.ubi_id = SOL.SOL_LUGAR_ADSC

			LEFT JOIN CNT_SOLICITA_STATUS S ON S.ST_ID = SOL.SOL_STATUS


			WHERE SOL_FK_PERIODO = 

			(
SELECT PER_ID FROM (
SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC
) WHERE ROWNUM = 1
)


			-- WHERE SOL_STATUS != 3 

) SOL            
LEFT JOIN
(
SELECT CNT_PK_CONTRATO AS NUMC, CNT_FK_NOEMPL AS NUMEMPLC,CNT_FK_URE AS UREC  FROM CNT_CONTRATOS 
WHERE  CNT_PK_ANIO = (SELECT PER_ANIO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)
AND CNT_PERIODO_SAE = (SELECT PER_PERIODO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)

) CON
ON CON.NUMEMPLC= SOL.NUMEMPL AND CON.UREC = SOL.ID_URE

LEFT JOIN (SELECT OFI_CLAVE AS CLAVE, OFI_ID FROM CNT_SOLICITA_OFICIO) OFI
ON OFI.OFI_ID = SOL.IDOFICIO

LEFT JOIN ( SELECT ID_SOL,ID_ASIG FROM CNT_SOLICITA_ASIG ) ASI
ON ASI.ID_SOL = SOL.ID

LEFT JOIN ( SELECT ID_GRUPO, NOM_MATERIA, ID_DIVISION FROM VGRUPOSD WHERE ID_DOCENTE IS NOT NULL ) ASIS
ON ASIS.ID_GRUPO = ASI.ID_ASIG

order by NUMEMPL",
						'url'=> ""
					);


		$reports[1] = array(
						'name'=> 'Detalle de información personal/estudios  ',
						'sql'=> 
'
SELECT * FROM (
SELECT ID,NUMEMPL,EMPLEADO,ID_URE,URE,UBICACION,ASIGNATURAS,"TOT GPOS","TOT HRS",DECODE(NUMC,NULL,\'-\',NUMC) AS NUMC,STATUS,CLAVE FROM 
(
		    SELECT 
			SOL_ID as ID,  PER.pers_persona AS NUMEMPL,
			PER.pers_nombre || \' \' || PER.PERS_APEPAT || \' \' || PER.PERS_APEMAT as EMPLEADO, 
			TUR.URES as ID_URE, TUR.lures as URE, U.UBI_DENOMINACION AS "UBICACION", GET_ASIGNATURA_BY_ID_SOL(SOL.SOL_ID) AS ASIGNATURAS, (SELECT COUNT(*) FROM CNT_SOLICITA_ASIG WHERE ID_SOL = SOL.SOL_ID ) AS "TOT GPOS", SOL_HRS AS "TOT HRS", ST_DENOMINA AS STATUS, SOL_OFICIO AS IDOFICIO
			FROM CNT_SOLICITA SOL
			INNER JOIN finanzas.fpersonas PER ON PER.pers_persona = SOL.sol_numempl
			INNER JOIN TURESH TUR ON TUR.ures = sol.sol_fk_ure
			LEFT JOIN PLT_UBICACIONES U ON u.ubi_id = SOL.SOL_LUGAR_ADSC

			LEFT JOIN CNT_SOLICITA_STATUS S ON S.ST_ID = SOL.SOL_STATUS


			WHERE SOL_FK_PERIODO = 

			(
SELECT PER_ID FROM (
SELECT * FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS = 1 ORDER BY PER_ID DESC
) WHERE ROWNUM = 1
)


			-- WHERE SOL_STATUS != 3 

) SOL            
LEFT JOIN
(
SELECT CNT_PK_CONTRATO AS NUMC, CNT_FK_NOEMPL AS NUMEMPLC,CNT_FK_URE AS UREC  FROM CNT_CONTRATOS 
WHERE  CNT_PK_ANIO = (SELECT PER_ANIO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)
AND CNT_PERIODO_SAE = (SELECT PER_PERIODO FROM CNT_PERIODOS_DOCEN WHERE PER_STATUS=1)

) CON
ON CON.NUMEMPLC= SOL.NUMEMPL AND CON.UREC = SOL.ID_URE

LEFT JOIN (SELECT OFI_CLAVE AS CLAVE, OFI_ID FROM CNT_SOLICITA_OFICIO) OFI
ON OFI.OFI_ID = SOL.IDOFICIO
) R

LEFT JOIN (
        
        SELECT 
        DECODE(ATRE_SINDICATO,1,\'SI\',\'NO\') AS SINDICALIZADO,
        ATRE_FECHA_DOCENTE AS FECHA_DOCENTE,
        PERS_PERSONA AS NUM_EMPL,PERS_RFC AS RFC, PERS_CURP AS CURP, PERS_CP AS CP,
        TO_CHAR(PERS_FECHANAC,\'YYYY-MM-DD\') AS FECHA_NAC, PERS_NACION AS NACIONALIDAD,TO_CHAR(PERS_FECHANAC,\'YYYY-MM-DD\') AS FECHA_NAC2, ATRE_IMSS AS NSS,PERS_NOMBRE AS NOMBRE, PERS_APEPAT AS APPATERNO,PERS_APEMAT AS APMATERNO, PERS_SEXO, PERS_HIJOS,
        PERS_EDOCIVIL AS EDO_CIVIL,
        PERS_CORREO AS CORREO, PERS_TELEFONO AS TELEFONO ,PERS_CALLE AS CALLE, PERS_COLONIA AS COLONIA,
        ECIU_CIUDAD AS ID,ECIU_NOMBRE AS CIUDAD, EEST_NOMBRE AS ESTADO, P.EPAI_NOMBRE AS PAIS,
        PERS_DEFINIACAD, TO_CHAR(PERS_FECHAING,\'DD/MM/YYYY\') AS FECHA_ING, I.ATRE_CORREOI AS CORREOI, ATRE_NUMPRO4 AS NUMPRO4
        
        FROM FINANZAS.FPERSONAS P
        LEFT JOIN PERSONAL.PATREMPL I ON I.ATRE_EMPL = P.PERS_PERSONA
        LEFT JOIN PECIUDAD C ON C.ECIU_CIUDAD = I.ATRE_LUGNAC
        LEFT JOIN PEESTADO E ON C.ECIU_ESTADO = E.EEST_ESTADO
        LEFT JOIN PEPAIS P ON E.EEST_PAIS = P.EPAI_PAIS
        
        ) E
        ON E.NUM_EMPL = R.NUMEMPL

LEFT JOIN (
                        SELECT 
                        EGRA_DOCUMENTO,EGRA_FOBGRADO AS FECHA_TITULO,EGRA_CEDULA AS NUMCEDULA,EGRA_FEXPCDLA AS FECHA_CEDULA,
                        EGRA_FEXPREGPROF AS FECHA_REG_PROFESIONISTAS,
                        ENIV_DESCRIP AS GRADO_ACADEMICO,
                        CA.ECAR_NOMBRE AS CARRERA, CA.ECAR_ESPECIALIDAD AS ESPECIALIDAD, AR.EARE_DESCRIP AS AREA_ESTUDIOS,
                        ESCU_NOMBRE AS INSTITUCION,
                        ECIU_NOMBRE AS CIUDAD_ESCUELA, EEST_NOMBRE AS ESTADO_ESCUELA, EPAI_NOMBRE AS PAIS_ESCUELA
                        
                        FROM PEGRADOACAD P
                        LEFT JOIN PERSONAL.PENIVELACAD A ON P.EGRA_GRADO = A.ENIV_GRADO
                        LEFT JOIN PECARRERAS CA ON CA.ECAR_CARRERA = P.EGRA_CARRERA
                        LEFT JOIN PEAREACAD AR ON CA.ECAR_AREA = AR.EARE_AREA
                        LEFT JOIN PERSONAL.PEDESCU R ON P.EGRA_ESCU = R.EDES_ID
                        LEFT JOIN PESCUELAS E ON E.ESCU_ESCU = R.EDES_ESCU
                        LEFT JOIN PECIUDAD C ON C.ECIU_CIUDAD = R.EDES_CIUDAD
                        LEFT JOIN PEESTADO E ON C.ECIU_ESTADO = E.EEST_ESTADO
                        LEFT JOIN PEPAIS P ON E.EEST_PAIS = P.EPAI_PAIS
                    --  WHERE  ( A.ENIV_NIVEL<=4  OR (A.ENIV_NIVEL>4 AND P.EGRA_CEDULA IS NOT NULL ) )
                        
 ) ESTU
ON ESTU.EGRA_DOCUMENTO = GETMAXGRADOESTUDIOS(R.NUMEMPL)

order by UBICACION,ID_URE
'
						,
						'url'=> ""
					);



	$form = array(
						//array('etiq'  =>'<h4>Datos generales</h4>'),
						array('etiq'  =>'<div class="row">'),  



						array(
                                'campo' =>'SOL_NUMEMPL',
                                //class' =>'get_asignaturas',
                                'col'   =>'col-sm-6',
                                'tipo'  =>'select_ajax',
                                'sql' =>'SELECT p.pers_persona AS "id",  p.pers_persona || \' - \' || p.pers_nombre || \' \' || p.PERS_APEPAT || \' \' || p.PERS_APEMAT AS "text" FROM  finanzas.fpersonas p WHERE PERS_EMPLEADO = \'S\' AND  PERS_ACTIVO = \'S\' ',
                                'label' =>'Persona ',
                                'holder'=>'Seleccione...'),	

						array(
							  'col'   =>'col-sm-6',
							  'campo' =>'SOL_FK_PERIODO',
							  'datosSQL' => "

							  				SELECT 0 AS ID, 'Otra fecha' as CAMPO FROM DUAL
							  				UNION
							  				SELECT PER_ID AS ID,  PER_PERIODO||'/'|| PER_ANIO||
										    ' ('||TO_CHAR(per.per_fecha_ini, 'DD/MM/YYYY')|| ' - '||  TO_CHAR(per.per_fecha_FIN, 'DD/MM/YYYY')||') ' 
										    AS CAMPO
										    FROM CNT_PERIODOS_DOCEN PER WHERE PER_STATUS = 1

										    
										    

										    ",
							  'tipo'  =>'select',
							  'label' =>'Periodo',
                              'holder'=>''),
						array(
							  'col'   =>'col-sm-6 otra_fecha',
							  'campo' =>'SOL_FECHA_INI',
							  'tipo'  =>'date',
							  'label' =>'Fecha de inicio',
                              'holder'=>''), 
						array(
							  'col'   =>'col-sm-6 otra_fecha',
							  'campo' =>'SOL_FECHA_FIN',
							  'tipo'  =>'date',
							  'label' =>'Fecha de finalización ',
                              'holder'=>''), 

                        array(
                                'campo' =>'SOL_FK_URE',
                                'col'   =>'col-sm-5',
                                'tipo'  =>'select',
                                'datosSQL' =>'SELECT URES AS ID, URES||\' - \'||LURES AS CAMPO FROM TURESH WHERE FECHA_FIN IS NULL AND DEPTO_ACAD = 1 /*AND URESP = (SELECT URE FROM PERS_ACCESOS WHERE NUM_EMPLEADO = \''.$_SESSION['numempl'.BASE_SESION].'\')*/ ',
                                'label' =>'URE',
                                'holder'=>'Seleccione...'), 


 array(
                              'campo' =>'SOL_LUGAR_ADSC',
                              'col'   =>'col-sm-6',
                              'datos' => array( 
                              				array('ID'=>'0','CAMPO'=>'Seleccione...'),
                                            array('ID'=>'1','CAMPO'=>'Chetumal'),
                                            array('ID'=>'2','CAMPO'=>'Cozumel'),
                                            array('ID'=>'3','CAMPO'=>'Playa de Carmen'),
                                            array('ID'=>'4','CAMPO'=>'Cancún'),
                                            array('ID'=>'5','CAMPO'=>'Ciencias de la Salud')
                                               ),
                              'tipo'  =>'select',
                              'label' =>'Lugar de adscripción'
                              ),


                        


						array('etiq'  =>'</div>'), 
						array('etiq'  =>'<div class="row" id="materias_sae">'),  


                        array(
		                  'col'   =>'col-sm-10',
		                  'campo' =>'SOL_ASIG',
		                  'tipo'  =>'select_multiple',
		                  'class' => '',
		                  'datosSQL' =>'',
		                  'label' =>'Asignatura (Desde SAE)',
		                  'holder'=>'Seleccione una o más asignaturas',
		                  'tabla_g' =>'CNT_SOLICITA_ASIG', //nombre de la tabla en donde quieres guardar 
		                  'id_tabla_g' =>'ID_SOL', //nombre de la columna en donde se guarda el id del registro de la tabla principal
		                  //'campo_tabla_g' =>'campo', //nombre de la columna en la tabla donde se guarda el nombre del campo check
		                  'valor_tabla_g' =>'ID_ASIG', //nombre de la columna en la tabla donde se guarda el valor de las opciones seleccionadas
		                ),
		                /*array('etiq'  =>'</div>'), 
		                array('etiq'  =>'<div style="display:none;" class="col-sm-9" id="matmsg">Espere un momento... consultando asignaturas para la persona y periodo seleccionado</div>'), */

		                array(
							  'col'   =>'col-sm-2',
							  'campo' =>'SOL_HRS',
							  'tipo'  =>'number',
							  'label' =>'Total horas a la semana'),



		                array('etiq'  =>'</div>'),  
/*
array('etiq'  =>'<div class="row">'),  

		                array(
							  'col'   =>'col-sm-12',
							  'campo' =>'SOL_FUNC_ASIG',
							  'tipo'  =>'textarea',
							  'label' =>'Asignaturas (Asignaturas que no se encuentren en el SAE)'),

*/
		                



						array(
							  'col'   =>'col-sm-12',
							  'campo' =>'SOL_OBS',
							  'tipo'  =>'textarea',
							  'label' =>'Observaciones o comentarios',
                              'alto'=>'75px'),

						


						

                        array('etiq'  =>'</div>'),                        

                        array(
                            #'col'   =>'col-sm-2',
							'campo' =>'SOL_ID',
							'tipo'  =>'oculto'
							),



					);

	$codigoJS= '
	//obtengo asignaturas
	$("#SOL_NUMEMPL").change(function() {		
		//$("#SOL_ASIG").val("").change(); //Limpio el campo de asignaturas

        var SOL_FK_URE = $("#SOL_FK_URE").val();
        var SOL_NUMEMPL = $("#SOL_NUMEMPL").val();

        obtener_asignaturas();
    });







	 function obtener_asignaturas(){	 	

	    var TIPO_EMPL = $("#SOL_TIPOEMPL").val();
	    var SOL_FK_URE = $("#SOL_FK_URE").val();
	    var SOL_ID = $("#SOL_ID").val();
	    var SOL_NUMEMPL = $("#SOL_NUMEMPL").val();
	    
	    $.ajax({
	        data:  "SOL_ID="+SOL_ID+"&SOL_NUMEMPL="+SOL_NUMEMPL+"&SOL_FK_URE="+SOL_FK_URE,
	        url:   "'.BASE_URL.'contratospa/exec/obtener_asignaturas",
	        type:  "post",
	        scriptCharset:"utf-8",
	        beforeSend: function () {
	        	$("div#divLoading").addClass("show");
	            $("#mat").hide();
	            $("#matmsg").show();
	            

	        },

	        complete:function(){

	        	$("#mat").show();
	            $("#matmsg").hide();
	            $("div#divLoading").removeClass("show");
	        },

	        success:  function (response) {
	        	$(".mat").hide("slow")
	            $(".matmsg").show("slow")

	          //if(response.id){
	          	if(response != "0")
	            $("#SOL_ASIG").html(response);	      
	            else
	            alert("No se encontraron asignaturas para el periodo esta persona en el periodo seleccionado. Use el campo de texto para escribir las asignaturas");

	          /*}else{
	              
	          }*/
	        }
	    }); 
	 }

	 $( "#SOL_FK_PERIODO" ).change(function() {
	    var periodo = this.value;
	    if(periodo == "0"){
	      $(".otra_fecha").show("slow")
	      $("#SOL_FECHA_INI").val("");
	      $("#SOL_FECHA_FIN").val("");
	    }else
	      $(".otra_fecha").hide("slow")
	  });



	';


	

	$class = "solicitudcontratos_2";

class solicitudcontratos_2 extends Controller{

	private $_m;
	public function __construct(){
		parent::__construct();
		$this->_m =$this->loadModel("solicitudcontratos");
	}

	public function index(){
		echo "hola mundo";
    }
    
    /*
    public function obtener_periodos($tipo_empl = 1) //1 profesor, 2 administracion
    {      	
        
		//$tipo_empl = $_POST['TIPO_EMPL'];
		$id_solicitud = $_POST['SOL_ID'];
		$id_periodo = 0;
        
  		if(!empty($id_solicitud)){ //si existe solicitud obtengo el id del periodo
            $datos_sol = $this->_m->get_datos_solicitud($id_solicitud);
            $id_periodo = $datos_sol['SOL_FK_PERIODO'];
  		}

        if($tipo_empl == 1){
            $res = $this->_m->get_periodo_profesor();
        }else if($tipo_empl == 2)
        	$res = $this->_m->get_periodo_administrativo();
  
		
        $cadena="";
	    //foreach ($res as $r) {
	        if($res['PER_ID']==$id_periodo) $s = " selected "; else $s = "";
	            $cadena.="<option $s value='".$res['PER_ID']."'>".$res['FECHA_INI']." - ".$res['FECHA_FIN']."</option>";
	    //} 
	    if($id_periodo == 0 and !empty($id_solicitud)) $s = " selected "; else $s = "";
	    	$cadena.="<option $s value='0'>Otra fecha</option>";
                
	  	echo $cadena;
    }

*/
    public function obtener_asignaturas()
    {      	
        
		$ure = $_POST['SOL_FK_URE'];
		$id_solicitud = $_POST['SOL_ID'];	
		$asig_seleccionadas = array();
        

  		if(!empty($id_solicitud)){ //si existe solicitud obtengo el id de la asignatura
             $solicitud= $this->_m->get_datos_solicitud($id_solicitud);
             $asig_seleccionadas= $this->_m->get_asignaturas_seleccionadas($id_solicitud);
             $id_docente = $solicitud['SOL_NUMEMPL'];
             
        }else{
        	$id_docente = $_POST['SOL_NUMEMPL'];
        }


        if($id_docente != 'null'){
        	$res_per = $this->_m->get_periodo_profesor();        	
        	$periodo = $res_per['PER_PERIODO'];
            $per_anio = $res_per['PER_ANIO'];

            $res = $this->_m->get_asignatura($id_docente, $ure, $periodo, $per_anio);
        
  
			//$cadena="<option value='0'>Seleccione...</option>";
	        $cadena="";
	        if(count($res)>0){ 
		    foreach ($res as $r) {
		    	$s = "";
		    	if(!empty($asig_seleccionadas)){
		    		foreach ($asig_seleccionadas as $key => $asig) {
		    			if($asig['ID_ASIG'] == $r['ID_GRUPO']){
		    				$s = " selected "; 
		    				break;
		    			}
		    		}
		    	}
	            $cadena.="<option $s value='".$r['ID_GRUPO']."'>".$r['NOM_MATERIA']."</option>";
		    } 
			}else{
			 $cadena = "0";
			}
		    echo $cadena;
        }        
	  	
    }


    public function generaword(){		
		// Creating the new document...
		$phpWord = (new PhpWord())->getInstancia();		
		$paper = new \PhpOffice\PhpWord\Style\Paper();
		$language = new \PhpOffice\PhpWord\Style\Language('es-ES');



		$paragraphStyleF = array(
		     'alignment' => 'center',
		     'indentation' => array('left' => 1100 , 'right' => 0),
		     'lineheight'=>1.5
		     );
		$footerLeft = array(
		     'alignment' => 'center',
		     'indentation' => array('left' => 1800, 'right' => 0),
		     'lineheight'=>1.5
		     );

		$fontFooter = 'oneUserDefinedStyle';
		$phpWord->addFontStyle(
		    $fontFooter,
		    array('name' => 'Times New Roman', 'color' => '000000','size' => 7)
		);
		//===tabla===
		$fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999');
		$cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFFFF');
		$cellRowTitle = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'BFBFBF');
		$cellRowContinue = array('vMerge' => 'continue');
		//$cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
		$cellHCentered = array('alignment' => 'center', 'space' => array('before' => 50, 'after' => 50),'indentation' => array('left' => 50, 'right' => 50), 'lineheight'=>1.5, 'spaceAfter' => 0);
		$cellHCentered = array('alignment' => 'center', 'space' => array('before' => 50, 'after' => 50),'indentation' => array('left' => 50, 'right' => 50), 'lineheight'=>1.5, 'spaceAfter' => 0);
		$cellAlignLeft = array('alignment' => 'left', 'space' => array('before' => 50, 'after' => 50),'indentation' => array('left' => 50, 'right' => 50), 'lineheight'=>1.5, 'spaceAfter' => 0 );
		//$cellHCentered = array('alignment' => 'center' \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
		$cellVCentered = array('valign' => 'center');
		$fontStyle = array("size"=>8,"bold"=>false,'name'=>'Arial'); 
		//======

		
		//Establezco el idioma del documento a español 
		$phpWord->getSettings()->setThemeFontLang($language);
		//$phpWord->getSettings()->setThemeFontLang(new Language(Language::ES_ES));
		$paper->setSize('Letter');  // or 'Legal', 'A4' ...
		//$section = $phpWord->addSection();
		$section = $phpWord->addSection([
			'headerHeight' => 400,
            'footerHeight' => 200,
		    'pageSizeW' => $paper->getWidth(),
		    'pageSizeH' => $paper->getHeight(),
		]);	
		
		

	    //===Header===
	    $header = $section->createHeader(); 
	    $header->addImage('/opt/sitios/srh/public/img/logo_uqroo.jpg',
	        array(
	        //'align'=>'left',
	    	'width'         => 120 ,
	        //'wrappingStyle' => 'square',
	        'positioning' => 'absolute',
	        //'marginTop'     => 50
	    ));   
		$header->addText("Chetumal, Quintana Roo, 25 de mayo de 2021", array('name' => 'Times New Roman','size' => 11), array('alignment' => 'right')); 
		$header->addText("2021, Año de la Independencia y la Grandeza de México, del Maestro <w:br/> Normalista y celebrando nuestro XXX Aniversario en Reconstrucción", array('name' => 'Times New Roman','size' => 11, "bold"=>true), array('alignment' => 'right')); 

		$header->addText('');

		/*$header->addImage('/opt/sitios/srh/puestos/portada.jpg',
	        array(
	        'width'         => 450 ,
	        'height'        => 604,
	        'wrappingStyle' => 'inline',
	        'marginTop'     => 50
	    ));*/
	    

	    //===Footer===
	    $footer = $section->createFooter();
		$foot1 = $footer->addTable();
		$foot1->addRow();
		$foot1->addCell(13500)->addText(
		    'Boulevard Bahía s/n, esquina Ignacio Comonfort, Colonia del Bosque Código Postal 77019, Chetumal, Quintana Roo, México. Teléfono <w:br/> +(983)3.50300, Fax +(983)83 29656 www.agroo.mx', $fontFooter,$cellHCentered
		);

		$foot2 = $footer->addTable();
		$foot2->addRow();
		$foot2->addCell(4500)->addText('Versión: 2;', $fontFooter,$cellHCentered);
		$foot2->addCell(4500)->addPreserveText('Página {PAGE} de {NUMPAGES}', $fontFooter, $paragraphStyleF);
		$foot2->addCell(4500)->addText('Código: ', $fontFooter, $footerLeft);

		$foot3 = $footer->addTable();
		$foot3->addRow();
		$foot3->addCell(13500)->addText(
		    'Documento impreso o electrónico que no se consulte directamente en el portal SIGC (http://sigc.uqroo.mx/) se considera <w:br/>  COPIA NO CONTROLADA', $fontFooter,$cellHCentered
		);

		

		$section->addText(
	    'Dra. Karina Amador Soriano <w:br/>Secretaria General <w:br/>Universidad de Quintana Roo',
		    array('name' => 'Times New Roman','size' => 11, "bold"=>true), 
		    array('alignment' => 'left')
		);

		$section->addText(
	    'Atención al Mtro. Israel Cruz Rodríguez <w:br/>Jefe del Departamento de Recursos Humanos',
		    array('name' => 'Times New Roman','size' => 11, "bold"=>true), 
		    array('alignment' => 'right')
		);

		$section->addText(
	    'Por medio del presente, solicito la contratación de los profesores de asignatura, que impartirán clases en la División de...',
		    array('name' => 'Times New Roman','size' => 12, "bold"=>false), 
		    array('alignment' => 'both')
		);

		/*
		$section->addText(
	    'Solicitud de contratos de Profesores de Asignatura',
		    array('name' => 'Tahoma', 'size' => 12,"bold"=>true)
		);

		*/
		

		$spanTableStyleName = 'Colspan Rowspan';
		$phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
		


		
		$solicitudes= $this->_m->get_solicitudes();
		$cont = 0;
		$ure = "";
		$ubic = "";
		foreach ($solicitudes as $sol) {
			$cont ++;

			if($ure != $sol['LURES'] OR $ubic != $sol['UBI_DENOMINACION']){

				if($ure != "")
					$section->addText('');  //separador de tablas

				$cont = 1;
				$ure = $sol['LURES'];
				$ubic = $sol['UBI_DENOMINACION'];
				$section->addText($ure." (".$ubic.")", array('name' => 'Tahoma', 'size' => 10));
				$table = $section->addTable($spanTableStyleName);
				$table->addRow();
				$table->addCell(500, $cellRowTitle)->addText('NUM.', $fontStyle, $cellHCentered);
				$table->addCell(800, $cellRowTitle)->addText('NUM. EMP', $fontStyle, $cellHCentered);
				$table->addCell(3000, $cellRowTitle)->addText('NOMBRE COMPLETO', $fontStyle, $cellHCentered);
				//$table->addCell(1200, $cellRowTitle)->addText('UBICACIÓN', $fontStyle, $cellHCentered);
				$table->addCell(4100, $cellRowTitle)->addText('MATERIA', $fontStyle, $cellHCentered);
				$table->addCell(1000, $cellRowTitle)->addText('HORAS A PAGAR', $fontStyle, $cellHCentered);
			}
			#$cell1 = $table->addCell(2000, $cellRowSpan);
			#$textrun1 = $cell1->addTextRun($cellHCentered);
			#$textrun1->addText('A');

			$table->addRow();
			$table->addCell(500, $cellRowSpan)->addText($cont, $fontStyle, $cellHCentered);
			$table->addCell(800, $cellRowSpan)->addText($sol['PERS_PERSONA'], $fontStyle, $cellHCentered);
			$table->addCell(3000, $cellRowSpan)->addText($sol['EMPLEADO'], $fontStyle, $cellAlignLeft);
			//$table->addCell(1200, $cellRowSpan)->addText($sol['UBI_DENOMINACION'], $fontStyle, $cellHCentered);

			//Esta consulta tarda  
			$asignaturas = $this->_m->getAsignaturasByIdSolicitud($sol['SOL_ID'], $sol['SOL_NUMEMPL'], $sol['PER_PERIODO'], $sol['PER_ANIO']);
			$contAsg = 0;
			//Asignaturas SAE
			if(!empty($asignaturas)){				
	    		foreach ($asignaturas as $key => $asg) {
	    			$contAsg ++;
	    			if($contAsg==1){
						$table->addCell(4100, $cellRowSpan)->addText($asg['NOM_MATERIA'], $fontStyle, $cellAlignLeft);
						$table->addCell(1000, $cellRowSpan)->addText($sol['SOL_HRS'], $fontStyle, $cellHCentered);
	    			}else{
	    				$table->addRow();
						$table->addCell(null, $cellRowContinue);
						$table->addCell(null, $cellRowContinue);
						$table->addCell(null, $cellRowContinue);
						//$table->addCell(null, $cellRowContinue);
						$table->addCell(4100, $cellVCentered)->addText($asg['NOM_MATERIA'], $fontStyle, $cellAlignLeft);
						$table->addCell(null, $cellRowContinue);
	    			}
	    		}
	    	}
			//Asignaturas que no están en el SAE
	    	elseif(!empty($sol['SOL_FUNC_ASIG'])){				
    			if($contAsg==0){
					$table->addCell(4100, $cellRowSpan)->addText($this->remplazar_saltos_linea_word($sol['SOL_FUNC_ASIG']), $cellAlignLeft);
					$table->addCell(1000, $cellRowSpan)->addText($sol['SOL_HRS'], $fontStyle, $cellHCentered);
    			}else{
    				$table->addRow();
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					$table->addCell(null, $cellRowContinue);
					//$table->addCell(null, $cellRowContinue);
					$table->addCell(4100, $cellVCentered)->addText($this->remplazar_saltos_linea_word($sol['SOL_FUNC_ASIG']), $fontStyle, $cellHCentered);
					$table->addCell(null, $cellRowContinue);
    			}	    	
	    	}else{
				$table->addCell(4100, $cellRowSpan)->addText("", $fontStyle, $cellHCentered);
				$table->addCell(1000, $cellRowSpan)->addText("", $fontStyle, $cellHCentered);
	    	}
		}

		$section->addText('');

		$section->addText(
	    	'Sin otro particular y agradecimiento de antemano su atención a la presente, quedo de usted.',
		    array('name' => 'Times New Roman','size' => 12, "bold"=>false), 
		    array('alignment' => 'left')
		);

		$section->addText('');

		$section->addText(
	    	'Atentamente <w:br/>“fructificar la razón: trascender nuestra cultura”',
		    array('name' => 'Times New Roman','size' => 12, "bold"=>true), 
		    array('alignment' => 'center')
		);

		$section->addText('');
		$section->addText('');
		$section->addText('');
		$section->addText('');

		$section->addText(
	    	'Atentamente <w:br/> <w:br/><w:br/><w:br/>------------------------<w:br/>Director',
		    array('name' => 'Times New Roman','size' => 12, "bold"=>true), 
		    array('alignment' => 'center')
		);


				$section->addText(
	    	'<w:br/><w:br/><w:br/>Vo.Bo. <w:br/> ------------------------<w:br/>Coordinador de la Unidad <w:br/>Académica Zona ----',
		    array('name' => 'Times New Roman','size' => 12, "bold"=>true), 
		    array('alignment' => 'right')
		);


		// Saving the document as OOXML file...
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('plantilla_sol_contrato/Solicitud.docx');

		header("Content-Disposition: attachment; filename=Solicitud.docx");
		echo file_get_contents('plantilla_sol_contrato/Solicitud.docx');

    }


    public function remplazar_saltos_linea_word($string = ""){
        //$string = htmlspecialchars($string);
        $string = preg_replace("/[\n]+/", "<w:br/> ", $string);
        $string = preg_replace("/[\t]+/", " ", $string);
        /*$resultado = str_replace("•", chr(127), $cadena);
        $resultado = str_replace("“", "\"", $resultado);
        $resultado = str_replace("”", "\"", $resultado);
        */
        return $string;
    }


}






?>