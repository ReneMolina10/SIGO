<?php

$bd = array( 
    'sqlDeplegar' => "SELECT CALEN_ID AS ID, CALEN_MES AS MES, CALEN_DIA AS DIA, CALEN_ANIO AS ANIO, CALEN_DIASEMANA AS DIA_SEMANA, CALEN_STATUS AS ESTATUS, CALEN_OBSERVACIONES AS OBSERVACIONES
                        FROM calendario ORDER BY MES ASC",
    'idDeplegar' => "ID",
    'busqLike' => 'MES,DIA,ANIO,DIA_SEMANA,ESTATUS,OBSERVACIONES',
    'busqIgual' =>'ID',
    'nomPlural' => "Calendario",
    'nomSingular' => "Calendario",
   
    'cssEditar' => '',

   /*  'btnOpciones' => array(
          'editar' => true,
          'detalles' => false,
          'duplicar' => true,
          'eliminar' => true
    ), */
    
    
);



$template = array(
    'editForm'  => 'modal',
); 

$tablas["p"]= array(
    'nom'  =>"CALENDARIO",
    'id'   => "CALEN_ID",
    'getId'=> "SELECT (MAX(id) + 1) AS ID FROM calendario"
);

 $form =array(
    array('etiq' => '<div class="row">'), 


        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_MES',
            'detalles' => 'width:100%',
            'datos'    => array(
                array('ID' => '1', 'CAMPO' => 'ENERO'),
                array('ID' => '2', 'CAMPO' => 'FEBRERO'),
                array('ID' => '3', 'CAMPO' => 'MARZO'),
                array('ID' => '4', 'CAMPO' => 'ABRIL'),
                array('ID' => '5', 'CAMPO' => 'MAYO'),
                array('ID' => '6', 'CAMPO' => 'JUNIO'), 
                array('ID' => '7', 'CAMPO' => 'JULIO'),
                array('ID' => '8', 'CAMPO' => 'AGOSTO'),
                array('ID' => '9', 'CAMPO' => 'SEPTIEMBRE'),
                array('ID' => '10', 'CAMPO' => 'OCTUBRE'),
                array('ID' => '11', 'CAMPO' => 'NOVIEMBRE'),
                array('ID' => '12', 'CAMPO' => 'DICIEMBRE'),
            ),
            'tipo'     => 'select',
            'label'    => 'Mes',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_DIA',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Día',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_ANIO',
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Año',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_DIASEMANA',
            'detalles' => 'width:100%',
            'datos'    => array(
                array('ID' => '1', 'CAMPO' => 'LUNES'),
                array('ID' => '2', 'CAMPO' => 'MARTES'),
                array('ID' => '3', 'CAMPO' => 'MIERCOLES'),
                array('ID' => '4', 'CAMPO' => 'JUEVES'),
                array('ID' => '5', 'CAMPO' => 'VIERNES'),
                array('ID' => '6', 'CAMPO' => 'SABADO'),                
                array('ID' => '7', 'CAMPO' => 'DOMINGO'),
            ),
            'tipo'     => 'select',
            'label'    => 'Día de la semana',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_STATUS',
            'detalles' => 'width:100%',
            'datos'    => array(
                array('ID' => '0', 'CAMPO' => 'DISPONIBLE'),
                array('ID' => '1', 'CAMPO' => 'NO DISPONIBLE'),
            ),
            'tipo'     => 'select',
            'label'    => 'Estatus',
            'required' => 'true',
        ),

        array(
            'col'      => 'col-md-6',
            'campo'    => 'CALEN_OBSERVACIONES',          
            'detalles' => 'width:100%',
            'tipo'     => 'text',
            'label'    => 'Observaciones',
            'required' => 'true',
        ),

        
       
        /* array(
            'col' => 'col-md-5',
            'label' => 'CAMPUS',
            'campo' => 'idRole',
            'tipo' => 'select',
            'datosSQL' => "SELECT id AS ID, role AS CAMPO FROM roles"
            
        ), */

        array(
            'campo' => 'CALEN_ID',
            'tipo' => 'oculto'
        ),
            
        array(
                'etiq'  =>'</div>'
        ),

       


 ); 




 $class ="miClase";



 class miClase extends Controller {
    
    private $_pdf;

    public function __construct() {
        parent::__construct();

       // $this->_rubrica = $this->loadModel('rubrica');
        //$this->_rubricaind = $this->loadModel('rubricaind');
         
    }

    public function index($anio="") {} 

    function inicializar($anio){
        
        echo "Se está creando el calandario ".$anio;


    }


}