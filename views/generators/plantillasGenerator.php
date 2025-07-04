<?php
$tablas["p"]= array(
    'nom' => 'CNT_PLANTILLAS',
    'id' => 'PLT_ID',
    'getId' => 'SELECT (MAX(PLT_ID)+1) AS ID FROM CNT_PLANTILLAS' 
);
/*$tablas["t"] = array(
    'nom' => 'CNT_TIPOCONT',
    'id' => 'TCNT_ID',
    'getId' => '',
    'tRel' => 'p',
    'cRel' => 'PLT_ID'
);*/
$bd = array(
   'sqlDeplegar' => 'SELECT PLT_ID AS ID, PLT_FK_ID_CNT AS FK, PLT_DENOMINACION AS DENOMINACION, 
    PLT_STATUS AS STATUS, PLT_CLAVE AS CLAVE, PLT_MARGENES AS MARGENES, PLT_MARGEN_SU AS MARGEN_SUPERIOR,
    PLT_MARGEN_IZ AS MARGEN_IZQUIERDO,PLT_MARGEN_IN AS MARGEN_INFERIOR, PLT_MARGEN_DE AS MARGEN_DERECHO, 
    PLT_MARGEN_EN AS MARGEN_ENCABEZADO,PLT_MARGEN_PP AS MARGEN_PIE_DE_PAGINA, TCNT_ID AS ID_CONT, 
    TCNT_DENOMINACION AS DENOMINACION_CONT FROM CNT_PLANTILLAS INNER JOIN CNT_TIPOCONT 
    ON CNT_PLANTILLAS.PLT_FK_ID_CNT = CNT_TIPOCONT.TCNT_ID ORDER BY ID ASC',
        'columnas' => array(
            array('campo' => 'ID','width' => '10%',),
            array('campo' => 'DENOMINACION','width' => '60%',),
            array('campo' => 'STATUS', 'width' => '10%',
            'status_style' =>
            array(
                array('value' => '0', 'background_color' => '#6c757d', 'text_color' => 'white',
             'text'=> 'Deshabilitada'),
             array('value' => '1', 'background_color' => '#28a745', 'text_color' => 'white', 
             'text' => 'Habilitada')
             )),
            array('campo' => 'clave', 'width'=> '10%')
        ),
    'idDeplegar' => 'ID',
    'busqLike' => '"DENOMINACION"',
    'busqIgual' =>'"ID"',
    'nomPlural' => 'Plantillas',
    'nomSingular' => 'Plantilla',
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
    'cssEditar' => ''
);
$codigoJS = '
const input2 = document.getElementById("PLT_MARGEN_SU");
input2.setAttribute("min", "0");
input2.setAttribute("max", "20");
var valores = [];
var input_id;
function validarInput(event) {
           const input = event.target;
        switch (input.id) {
        case "PLT_MARGEN_SU":
            input_id = 0;
        break;
        case "PLT_MARGEN_IZ":
            input_id = 1;
        break;
        case "PLT_MARGEN_IN":
            input_id = 2;
        break;
        case "PLT_MARGEN_DE":
            input_id = 3;
        break;
        case "PLT_MARGEN_EN":
            input_id = 4;
        break;
        case "PLT_MARGEN_PP":
            input_id = 5;
        break;
        default:
        }
            const valor = parseInt(input.value);

            if (valor < 0 || valor > 20) {
            input.value = valores[input_id];
            } else {
                console.log(`El valor en ${input.id} es válido.`);
            }
        }

        // Asignar el evento blur a cada input
        const inputs = document.querySelectorAll(\'input[type="number"]\');
        inputs.forEach(input => {
            input.addEventListener(\'keyup\', validarInput);
             valores.push(input.value);
        });

';
$form = array(
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'PLT_ID',
        'tipo' => 'oculto',
        'tabla' => 'p',
        'required' => 'true'
    ),
    array('etiq' => '<div class="col-md-8" col-12>'),
    array(
       //'col' => 'h-100',
        'campo' => 'PLT_TEXTO',
        'tipo' => 'textarea',
        'editor'=> 'true',
        'label' => 'Editor de plantilla',
        'holder' => '',
        'required' => 'true',
        'tabla' => 'p',
        'alto' => '40vh'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<div class="col-12 col-md-4">'),
    array('etiq' => '<div class="row">'),
    array(
        'campo' => 'PLT_DENOMINACION',
        'tipo' => 'text',
        'tabla' => 'p',
        'required' => 'true',
        'label' => 'Denominación',
        'col' => 'col-12'
    ),
    array(
        'label' => 'Tipo de plantilla',
        'campo' => 'PLT_FK_ID_CNT',
        'tipo' => 'select',
        'datosSQL' => "SELECT TCNT_ID AS ID, TCNT_DENOMINACION AS CAMPO
        FROM CNT_TIPOCONT",
        'tabla' => 'p',
        'col' => 'col-12'
    ),
    array(
        'col' => 'col-12',
        'campo' => 'PLT_STATUS',
        'datos' => array( 
            array('ID'=>'0','CAMPO'=>'Deshabilitado'),
            array('ID'=>'1','CAMPO'=>'Habilitado')
        ),
        'tipo'  =>'select',
        'label' => 'Status'
    ),
    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">Margenes</h6>'),
    array('etiq' => '<div class="row">'),
    array(
      'col' => 'col-4',
      'campo' => 'PLT_MARGEN_SU',
      'tipo' => 'number',
      'tabla' => 'p',
      'label' => 'Superior',
      'pattern' => '{1-20}'
    ),
    array(
        'col' => 'col-4',
        'campo' => 'PLT_MARGEN_IZ',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Izquierdo'
      ),
      array(
        'col' => 'col-4',
        'campo' => 'PLT_MARGEN_IN',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Inferior'
      ),
    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-4',
        'campo' => 'PLT_MARGEN_DE',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Derecho'
      ),
    array(
        'col' => 'col-4',
        'campo' => 'PLT_MARGEN_EN',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Enabezado'
      ),
      array(
        'col' => 'col-4',
        'campo' => 'PLT_MARGEN_PP',
        'tipo' => 'number',
        'tabla' => 'p',
        'label' => 'Pie de pagina'
      ),
    array('etiq' => '</div>'),
    array('etiq' => '</div>'),
    array('etiq' => '</div>')
);

?>