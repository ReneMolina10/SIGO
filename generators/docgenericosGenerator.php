<?php
$tablas["p"] = array(
    'nom' => 'DOC_GENERICOS',
    'id' => 'DG_ID',
    'getId' => 'SELECT (MAX(DG_ID)+1) AS ID FROM DOC_GENERICOS'
);

$bd = array(
    'sqlDeplegar' =>
        'SELECT 
        DG_ID                   AS ID,
        DG_FK_URE||\' - \'||LURES               AS URE,
        DG_ASUNTO               AS ASUNTO,
        DG_TEXTO                AS TEXTO,
        DG_LUGAR||\' - \'||UBI_DENOMINACION                AS LUGAR,
        DG_FECHA                AS FECHA,
        DG_FOLIO                AS FOLIO,
        DG_FK_CORRESPONDA    AS CORRESPONDA,
        DG_FK_CARGO_CORRESPONDE         AS CARGO_COR,
        DG_LEMA                 AS LEMA,
        DG_FIRMA_PATH           AS FIRMA_PATH,
        DG_NUMEMPL_FK_SOLICITA  AS NUMEMPL_FK_FIRMANTE,
        DG_DESCRIPCION          AS DESCRIPCION,
        DG_FK_CARGO_SOLICITA    AS CARGO_FIRM,
        DG_CCP1,
        DG_CCP2,
        DG_CCP3,
        DG_CCP4,

        \'<a href="' . BASE_URL . 'docgenericos/exec/previsualizarPDF/\' || DG_ID || \'" target="_blank"> <div style="text-align:center"> <i class="far fa-eye nav-icon"></i> </div> </a>\' AS PDF
        FROM DOC_GENERICOS DG
        LEFT JOIN TURESH ON DG_FK_URE = URES
        LEFT JOIN PLT_UBICACIONES ON DG_LUGAR = UBI_ID',


    'columnas' => array(
        array('campo' => 'ID', 'width' => '10%'),
        array('campo' => 'ASUNTO', 'width' => '40%'),
        array('campo' => 'CORRESPONDA', 'width' => '20%'),
        array('campo' => 'FOLIO', 'width' => '10%'),
        array('campo' => 'PDF', 'width' => '10%'),
    ),
    'idDeplegar' => 'ID',
    'busqLike' => '"DENOMINACION"',
    'busqIgual' => '"ID"',
    'nomPlural' => 'Documentos genéricos',
    'nomSingular' => 'Documento genérico',
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
        'campo' => 'DG_ID',
        'tipo' => 'oculto',
        'tabla' => 'p',
    ),
    array('etiq' => '<div class="col-md-7" col-12>'),
    array(
        //'col' => 'h-100',
        'campo' => 'DG_TEXTO',
        'tipo' => 'textarea',
        'editor' => 'true',
        'prompt' => 'Verificar ortografía, redacción y gramática',
        'label' => 'Editor del cuerpo del documento',
        'holder' => '',
        'required' => 'true',
        'tabla' => 'p',
        'alto' => '40vh'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<div class=" col-md-5 col-8">'),
    array('etiq' => '<div class="row">'),

    array(
        'campo' => 'DG_DESCRIPCION',
        'tipo' => 'text',
        'tabla' => 'p',
        'required' => 'true',
        'label' => 'Descripción (para uso interno)',
        'col' => 'col-12'
    ),

    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">DATOS GENERALES</h6>'),
    array('etiq' => '<div class="row">'),


    array(
        'col' => 'col-12',
        'campo' => 'DG_ASUNTO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'ASUNTO',
    ),


    array(
        'col' => 'col-4',
        'campo' => 'DG_LUGAR',
        'tipo' => 'select',
        //SELECT UBI_ID AS ID, UBI_DENOMINACION AS CAMPO FROM PLT_UBICACIONES ORDER BY UBI_ID ASC
        'datosSQL' => "SELECT UBI_ID AS ID, UBI_DENOMINACION AS CAMPO FROM PLT_UBICACIONES ORDER BY UBI_ID ASC",
        'tabla' => 'p',
        'label' => 'Lugar',
    ),


    array(
        'col' => 'col-4',
        'campo' => 'DG_FECHA',
        'tipo' => 'date',
        'tabla' => 'p',
        'label' => 'Fecha'
    ),
    array(
        'col' => 'col-4',
        'campo' => 'DG_FOLIO',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Folio'
    ),

    array(
        'col' => 'col-12',
        'campo' => 'DG_LEMA',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Lema (opcional)',
        'holder' => 'Lema del documento'
    ),


    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">DATOS DEL CORRESPONDIENTE</h6>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-12',
        'campo' => 'DG_FK_CORRESPONDA',
        'tipo' => 'select',
        'datosSQL' => "SELECT PERS_PERSONA AS ID, PERS_PERSONA ||' - '|| PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT AS CAMPO FROM FINANZAS.FPERSONAS WHERE PERS_ACTIVO = 'S'",
        'tabla' => 'p',
        'label' => 'A quién corresponda:',
    ),
    //debe venir automatico
    array(
        'col' => 'col-12',
        'campo' => 'DG_FK_CARGO_CORRESPONDE',
        'tipo' => 'text',
        //'datosSQL' => "SELECT CARGO_ID AS ID, CARGO_NOMBRE AS CAMPO FROM FINANZAS.FCARGOS",
        'tabla' => 'p',
        'label' => 'Cargo del destinatario'
    ),

    /*
    array(
        'col' => 'col-12',
        'campo' => 'DG_FIRMA_PATH',
        'tipo' => 'file',
        'tabla' => 'p',
        'label' => 'Firma del responsable (opcional)',
        'holder' => 'Firma del responsable del documento',
        'required' => false
        DG_NUMEMPL_FK_FIRMANTE

    ),*/

    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">DATOS DEL SOLICITANTE</h6>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-12',
        'campo' => 'DG_NUMEMPL_FK_SOLICITA',
        'tipo' => 'select',
        'datosSQL' => "SELECT PERS_PERSONA AS ID, PERS_PERSONA ||' - '|| PERS_NOMBRE || ' ' || PERS_APEPAT || ' ' || PERS_APEMAT AS CAMPO FROM FINANZAS.FPERSONAS WHERE PERS_ACTIVO = 'S'",
        'tabla' => 'p',
        'label' => 'ATTE del documento'
    ),


    array(
        'col' => 'col-12',
        'campo' => 'DG_FK_CARGO_SOLICITA',
        'tipo' => 'text',
        //'datosSQL' => "SELECT CARGO_ID AS ID, CARGO_NOMBRE AS CAMPO FROM FINANZAS.FCARGOS",
        'tabla' => 'p',
        'label' => 'Cargo del firmante'
    ),

    array(
        'col' => 'col-12',
        'campo' => 'DG_FK_URE',
        'tipo' => 'select',
        'datosSQL' => "SELECT URES AS ID, URES||' - '||LURES AS CAMPO FROM TURESH WHERE FECHA_FIN IS NULL",
        'tabla' => 'p',
        'label' => 'URE',
    ),


    array('etiq' => '</div>'),
    array('etiq' => '<h6 class="p-1" style="text-align: center;">PIE DE PAGINA</h6>'),
    array('etiq' => '<div class="row">'),

    array(
        'col' => 'col-6',
        'campo' => 'DG_CCP1',
        'tipo' => 'text',
        'tabla' => 'p',
        'label' => 'Copia a (opcional)',
        'holder' => 'Copia a (opcional)'
    ),
    array(
        'col' => 'col-6',
        'campo' => 'DG_CCP2',
        'tipo' => 'text',

        'label' => 'Copia a (opcional)',
        'holder' => 'Copia a (opcional)'
    ),
    array(
        'col' => 'col-6',
        'campo' => 'DG_CCP3',
        'tipo' => 'text',

        'label' => 'Copia a (opcional)',
        'holder' => 'Copia a (opcional)'
    ),
    array(
        'col' => 'col-6',
        'campo' => 'DG_CCP4',
        'tipo' => 'text',

        'label' => 'Copia a (opcional)',
        'holder' => 'Copia a (opcional)'
    ),




    array('etiq' => '</div>'),
    //array('etiq' => '<h4>Agregar Firmantes:</h4>'),

    array('etiq' => '<div class="row">'),
    array(
        'col' => 'col-md-12',
        'nombre' => 'FIRMANTES',
        'detalles' => 'width:100%;',
        'sql' => "SELECT 
                            FIRM_DOC AS ID,
                            FIRM_NOMBRE AS NOMBRE,
                            FIRM_PUESTO AS PUESTO,
                            FIRM_FK_TIPO AS TIPO
                            --FIRM_NUMEMPL, 
                            --FIRM_FK_DOC
                                    FROM DOC_FIRMANTES
                                    LEFT JOIN DOC_GENERICOS ON DG_ID = FIRM_FK_DOC
                                    WHERE FIRM_FK_DOC=:id ",
        'id' => "DG_ID",
        'idrel' => 'DG_ID',
        'tipo' => 'tabla',
        'btn_holder' => 'Agregar firmantes',
        'encabezado' => 'Firmantes del documento',
        'generator' => 'docfirmante' //nombre del generatos al que sera redirigido

    ),
    array('etiq' => '</div>'),



);

$codigoJS = '




';










$class = "kx";


class pdfl extends TCPDF
{
    function Header()
    {

        $bMargin = $this->getBreakMargin(0); // get the current page break margin
        $auto_page_break = $this->AutoPageBreak; // get current auto-page-break mode
        $this->SetAutoPageBreak(false, 0); // disable auto-page-break
        $img_file = '/opt/sitios/srh/public/img/MarcadeAguaUAEQROO.jpg'; // set bacground image
        $this->Image($img_file, 0, 0, 215.9, 279.4, '', '', '', false, 300, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin); // restore auto-page-break status
        $this->setPageMark(); // set the starting point for the page content

        // URE ENCABEZADO
        $this->SetFont('helvetica', '', 8, '', true);
        $ure = $this->ure_encabezado;
        $this->writeHTMLCell(0, 0, 20, 8, $ure, 0, 1, 0, true, '', true);

    }

    function Footer()
    {
        $style = '
            <style>
                td {
                    /*border: 1px solid #9e9e9e;*/
                }  
            </style>
        ';

        $tabla = '<table cellpadding="0" border="0" >
           
            <tr>
                <td align="center">Versión: Mayo, 2025</td>
                <td align="center">Código: DDS-04-25</td>
                <td align="center"> Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '</td>
            </tr>
            <tr>                  
                <td colspan="3" align="center" ><br><br>Este documento carece de validez legal si no cuenta con Firma Electrónica. Copia No Controlada.
                </td>
            </tr>                         
        </table>
        <div>&nbsp;</div>
        ';
        $this->SetY(-25);
        $this->setCellHeightRatio(1.5);
        $this->SetFont('times', '', 7, '', true);
        $this->writeHTML($style . $tabla, true, 0, true, true);
    }
}
class kx extends Controller
{
    private $_pdf;
    public function __construct()
    {
        parent::__construct();
        $this->_nom = $this->loadModel('docgenericos');
    }
    public function index()
    {
    }

    function fechaCastellano($fecha)
    {
        $meses = [
            'JAN' => 'Enero',
            'FEB' => 'Febrero',
            'MAR' => 'Marzo',
            'APR' => 'Abril',
            'MAY' => 'Mayo',
            'JUN' => 'Junio',
            'JUL' => 'Julio',
            'AUG' => 'Agosto',
            'SEP' => 'Sseptiembre',
            'OCT' => 'Octubre',
            'NOV' => 'Noviembre',
            'DEC' => 'Diciembre'
        ];
        $partes = explode('-', $fecha);
        if (count($partes) != 3)
            return $fecha;
        $dia = $partes[0];
        $mes = isset($meses[$partes[1]]) ? $meses[$partes[1]] : $partes[1];
        $anio = $partes[2];
        $anio = (strlen($anio) == 2) ? ('20' . $anio) : $anio;
        return "{$dia} de {$mes} del {$anio}";
    }


    function previsualizarPDF($id)
    {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);


        $infoDoc = $this->_nom->getDocGenerico($id);

        /*print_r($infoDoc);
        exit;*/

        if (!$infoDoc) {
            header('Content-Type: text/plain; charset=utf-8');
            echo 'Documento no encontrado';
            exit;
        }

        $pdf = new pdfl(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->ure_encabezado = $infoDoc['URE'];

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema Institucional de Gestion de Oficios');
        $pdf->SetTitle($infoDoc['DG_ASUNTO']);
        $pdf->SetSubject('Documento');
        $pdf->SetKeywords('documento, genérico');



        /*// Márgenes
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 30);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
*/
        // establece los margenes del documento
        $margenTop = "40";
        $margenIzq = "20";
        $margenDer = "25";
        $pdf->SetMargins($margenIzq, $margenTop, $margenDer);

        $margenEncabezado = "10";
        $pdf->SetHeaderMargin($margenEncabezado);
        $margenFooter = "10";
        $pdf->SetFooterMargin($margenFooter);

        // establecer saltos de página automáticos
        $margenBoottom = "55";
        $pdf->SetAutoPageBreak(true, $margenBoottom);

        // establecer el factor de escala de la imagen
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Decide orientación: vertical ('P') u horizontal ('L')
        $orientacion = 'P'; // Por defecto vertical
        // Si quieres que sea horizontal bajo alguna condición, cambia aquí:
        if (isset($infoDoc['ORIENTACION']) && $infoDoc['ORIENTACION'] == 'H') {
            $orientacion = 'L';
        }

        $pdf->AddPage($orientacion, 'LETTER');
        /*
                //URE ENCABEZADO
                $pdf->SetFont('helvetica', '', 8, '', true);
                $ure = $infoDoc['URE'];
                $pdf->writeHTMLCell(0, 0, 20, 8, $ure, 0, 5, 0, true, '', true);
                $pdf->Ln(8);*/


        $fechaOriginal = $infoDoc['DG_FECHA'];
        $fechaCastellano = $this->fechaCastellano($fechaOriginal);


        $pdf->SetFont('helvetica', '', 10, '', true);
        $lugar = $infoDoc['LUGAR'] . ', Quintana Roo a ' . $fechaCastellano;
        $pdf->writeHTMLCell(0, 0, 20, 20, $lugar, 0, 5, 0, true, '', true);
        $folio = $infoDoc['DG_FOLIO'];
        $pdf->writeHTMLCell(0, 0, 20, '', $folio, 0, 5, 0, true, '', true);
        $pdf->Ln(5);


        //DG_LEMA
        $lema = $infoDoc['DG_LEMA'];
        if (!empty($lema)) {
            $pdf->SetFont('helvetica', 'I', 6, '', true);
            $pdf->writeHTMLCell(0, 0, 20, '', $lema, 0, 5, 0, true, '', true);
            $pdf->Ln(20);
        } else {
            $pdf->Ln(21);
        }


        //A QUIEN CORRESPONDA
        $pdf->SetFont('helvetica', 'B', 10, '', true);
        $corresponde = $infoDoc['NOMBRE_CORRESPONDE'];
        $cargoCorresponde = $infoDoc['DG_FK_CARGO_CORRESPONDE'];
        $pdf->writeHTMLCell(0, 0, 20, '', $corresponde, 0, 5, 0, true, '', true);
        $pdf->writeHTMLCell(0, 0, 20, '', $cargoCorresponde, 0, 5, 0, true, '', true);
        $pdf->writeHTMLCell(0, 0, 20, '', 'Presente.', 0, 5, 0, true, '', true);
        $pdf->Ln(5);




        //CUERPO DEL DOCUMENTO
        $pdf->SetFont('helvetica', '', 10, '', true);
        $ancho = 170;
        $alto = 0; // Alto automático
        $borde = 0;
        $texto = $infoDoc['DG_TEXTO'];
        $pdf->writeHTMLCell($ancho, $alto, '', '', $texto, $borde, 1, 0, true, 'L', true);

        // Espacio después del texto del documento
        $pdf->Ln(15);


        //FIRMA de quien solicita



        $pdf->SetFont('helvetica', 'B', 10, '', true);
        $pdf->writeHTMLCell(0, 0, '', '', 'Atentamente', 0, 1, 0, true, '', true);
        $pdf->Ln(35);
        $firmante = $infoDoc['NOMBRE_SOLICITA'];
        $pdf->writeHTMLCell(0, 0, '', '', $firmante, 0, 1, 0, true, '', true);
        $cargoFirmante = $infoDoc['DG_FK_CARGO_SOLICITA'];
        $pdf->writeHTMLCell(0, 0, '', '', $cargoFirmante, 0, 1, 0, true, '', true);

        // CCP (copias)
        $ccps = array(
            $infoDoc['DG_CCP1'],
            $infoDoc['DG_CCP2'],
            $infoDoc['DG_CCP3'],
            $infoDoc['DG_CCP4']
        );

        // Filtra los CCP no vacíos
        $ccps_validos = array_filter($ccps, function ($ccp) {
            return !empty(trim($ccp));
        });

        if (count($ccps_validos) > 0) {
            $pdf->Ln(10);
            $pdf->SetFont('helvetica', '', 6, '', true);
            // $pdf->writeHTMLCell(0, 0, '', '', '<b>Copias para:</b>', 0, 1, 0, true, '', true);
            foreach ($ccps_validos as $ccp) {
                $pdf->writeHTMLCell(0, 0, '', '', $ccp, 0, 1, 0, true, '', true);
            }
        }


        $pdf->lastPage();
        ob_clean();
        $pdf->Output('DOCUMENTO_' . $id . '.pdf', 'I');
        exit;
    }
}

?>