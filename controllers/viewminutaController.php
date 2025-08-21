<?php

// HABILITAR CORS para permitir acceso desde efirma.uqroo.mx
header("Access-Control-Allow-Origin: https://efirma.uqroo.mx");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once ROOT . 'libs/composer_fpdi/vendor/autoload.php'; // Ajusta la ruta si es necesario

use setasign\Fpdi\Tcpdf\Fpdi;

class pdfl extends Fpdi
{

    public $folioDocumento = '';
    public $showWatermark = false;


    public function folioVertical()
    {
        if (!empty($this->folioDocumento)) {
            $this->SetFont('helvetica', 'B', 8);
            // Color gris suave (por ejemplo: #888888)
            $this->SetTextColor(238, 238, 238);
            $this->StartTransform();
            // Posición: X cerca del borde derecho, Y más abajo del centro vertical
            $yPos = ($this->h / 2) + 80; // 25 puntos más abajo del centro
            $this->Rotate(90, $this->w - 10, $yPos);
            $this->Text($this->w - 10, $yPos, 'FOLIO DEL DOCUMENTO DIGITAL: ' . $this->folioDocumento);
            $this->StopTransform();
            $this->SetTextColor(0, 0, 0);
        }
    }

    // Método para agregar la marca de agua
    public function addWatermark()
    {
        if ($this->showWatermark) {
            $this->SetAlpha(0.15);
            $this->SetFont('aealarabiya', '', 60);
            $this->SetTextColor(255, 0, 0);

            // Obtener dimensiones reales considerando márgenes
            $pageWidth = $this->getPageWidth() - $this->lMargin - $this->rMargin;
            $pageHeight = $this->getPageHeight() - $this->tMargin - $this->bMargin;

            // Calcular posición central
            $x = $this->lMargin + ($pageWidth / 2);
            $y = $this->tMargin + ($pageHeight / 2);

            // Rotar y colocar texto
            $this->StartTransform();
            $this->Rotate(35, $x, $y);
            $this->Text($x - 100, $y, 'Documento Sin Validez'); // Ajuste horizontal
            $this->StopTransform();

            $this->SetAlpha(1);
            $this->SetTextColor(0, 0, 0);
        }
    }

    function Header()
    {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);

        // Agregar marca de agua primero
        // $this->addWatermark();

        // Resto del encabezado
        $img_file = '/opt/sitios/gesco/public/img//UQROO.png';
        $this->Image($img_file, 20, 0, 20, 24, '', '', '', false, 300, '', false, false, 0);

        $this->SetFont('aealarabiya', 'B', 23);
        $this->SetTextColor(60, 120, 90);
        $this->SetXY(75, 13);
        $this->Cell(0, 10, 'Minuta de reunión', 0, 1, 'L', false, '', 0, false, 'T', 'M');
        $this->SetTextColor(0, 0, 0);

        $y = 23;
        $this->SetDrawColor(60, 120, 90);
        $this->SetLineWidth(0);
        $this->Line(20, $y, 191, $y);
        $this->SetLineWidth(0);
        $this->Line(20, $y + 1, 191, $y + 1);

        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

    function Footer()
    {

        // Agregar marca de agua primero
        $this->addWatermark();
        $this->folioVertical();
        $style = '
            <style>
                td {
                    /*border: 0px solid #9e9e9e;*/
                }  
            </style>
        ';

        $tabla = '<table cellpadding="0" border="0" >
            <tr>
                <td align="center">Formato PGC-F005 Minuta de reunión Rev. 3.1 - 11/07/2024</td>
            </tr>
            <tr>                  
                <td colspan="0" align="center" >Documento impreso o electrónico que no se consulte directamente en el portal Sistema Institucional de Gestión de la Calidad - Inicio (sharepoint.com) se considera copia no controlada
                </td>
            </tr>    
            <tr>
                <td align="center"> Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages() . '</td>
            </tr>                     
        </table>
        <div>&nbsp;</div>
        ';

        $this->SetY(-18);
        $this->setCellHeightRatio(1);
        $this->SetFont('aealarabiya', '', 8, '', true);
        $this->writeHTML($style . $tabla, true, 0, true, true);
    }
}

class viewminutaController extends Controller
{
    private $_pdf;
    public function __construct()
    {
        parent::__construct();

        $this->_nom = $this->loadModel('viewminuta'); // Cargar el modelo de minutas
    }

    public function index()
    {
    }


    //* METODO QUE RENDERIZA LA VISTA PARA SOLICITAR Y VERIFICAR EL ESTATUS DE LOS FIRMANTES 
    public function prefirmado($id)
    {

        $this->forzarLogin();

        //echo "-- $id --";

        if (!$id) {
            die("ID de minuta no proporcionado o inválido");
        }

        $firmantes = $this->_nom->getFirmantes($id);
        $infoGen = $this->_nom->getInfoGeneral($id);

        /*          
      echo '<pre>';
          echo "ID recibido: $id\n";
          echo "infoGen:\n";
          print_r($infoGen);
          echo "firmantes:\n";
          print_r($firmantes);
          echo '</pre>';
          exit;*/

        $totalFirmantes = is_array($firmantes) ? count($firmantes) : 0;
        $firmantesFirmados = 0;
        if ($totalFirmantes > 0) {
            foreach ($firmantes as $f) {
                if (isset($f['FIR_STATUS_FIRMANTE_DOC']) && $f['FIR_STATUS_FIRMANTE_DOC'] == 3) {
                    $firmantesFirmados++;
                }
            }
        }
        $infoGen = $this->_nom->getInfoGeneral($id);
        $folioDoc = $infoGen['FOLIO_DOC'] ?? null;
        $fechaCreacion = $infoGen['MIN_FECHA'] ?? null; // Extract MIN_FECHA
        if ($fechaCreacion) {
            $fechaCreacion = $this->fechaCastellano($fechaCreacion); // Convert to readable format
        }
        $this->_view->assign('fecha_creacion', $fechaCreacion);

        $this->_view->assign('totalFirmantes', $totalFirmantes);
        $this->_view->assign('firmantesFirmados', $firmantesFirmados);
        $this->_view->assign('folioDoc', $folioDoc);

        $this->_view->assign('minuta_id', $id);

        //////// echo "* $id * "; exit();

        $this->_view->assign('baseUrl', BASE_URL);
        $this->_view->assign('firmantes', $firmantes);

        $this->_view->renderizar('viewminuta');
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

    private function formatoFechaCorta($fecha)
    {
        $meses = [
            'JAN' => '01',
            'FEB' => '02',
            'MAR' => '03',
            'APR' => '04',
            'MAY' => '05',
            'JUN' => '06',
            'JUL' => '07',
            'AUG' => '08',
            'SEP' => '09',
            'OCT' => '10',
            'NOV' => '11',
            'DEC' => '12'
        ];
        $partes = explode('-', $fecha);
        if (count($partes) != 3)
            return $fecha;
        $dia = $partes[0];
        $mes = isset($meses[$partes[1]]) ? $meses[$partes[1]] : $partes[1];
        $anio = $partes[2];
        $anio = substr($anio, -2);
        return "{$dia}/{$mes}/{$anio}";
    }


    //*PDF QUE VISUALIZA EN EL MODULO DE MINUTAS CONTIENE MARCA DE AGUA Y HOJA COMPROBATORIA

    function previsualizarPDF($id)
    {
        /*
               echo "<pre>";
                print_r($_SERVER['HTTP_REFERER']);
                echo "</pre>";

                echo "-- $id  ---"; exit();

                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                */

        // 

        $firmantes = $this->_nom->getFirmantes($id);


        $totalFirmantes = is_array($firmantes) ? count($firmantes) : 0;

        $noSolicitado = true;
        if ($totalFirmantes > 0) {
            foreach ($firmantes as $f) {

                if (isset($f['FIR_STATUS_FIRMANTE_DOC']) == '') {
                    $noSolicitado = false;
                }
            }
        }


        // Solo intenta obtener la firma si ya existe un folio de documento
        $infoGen = $this->_nom->getInfoGeneral($id);
        if ($noSolicitado && !empty($infoGen['FOLIO_DOC'])) {
            $this->getFirma($id);
        }
        /*$firmantes = $this->_nom->getFirmantes($id);
                $totalFirmantes = is_array($firmantes) ? count($firmantes) : 0;
                $noSolicitado = true;
                if ($totalFirmantes > 0) {
                    foreach ($firmantes as $f) {
                        if (isset($f['FIR_STATUS_FIRMANTE_DOC']) == '') {
                            $noSolicitado = false;
                        }
                    }
                }
                if ($noSolicitado) {
                    $this->getFirma($id);
                }*/

        /*
              echo "<pre>";
                print_r($firmantes);
                echo "</pre>";

                exit();
                */


        $referer = $_SERVER['HTTP_REFERER'] ?? '';

        if (
            strpos($referer, 'https://sigo.uqroo.mx') === false &&
            strpos($referer, 'https://efirma.uqroo.mx') === false
        ) {
            echo "No permitido";
            exit();
        }



        $infoGen = $this->_nom->getInfoGeneral($id);
        $asuntos = $this->_nom->getAsuntos($id);
        $acuerdos = $this->_nom->getAcuerdos($id);
        $firmantes = $this->_nom->getFirmantes($id);
        $areasParticipa = $this->_nom->getAreasParticipa($id);
        $mejoras = $this->_nom->getMejoras($id);

        if (empty($infoGen)) {
            echo "No se encontró información general para la minuta.";
            return;
        }
        if (empty($asuntos)) {
            echo "No se encontraron asuntos para la minuta.";
            return;
        }
        if (empty($acuerdos)) {
            echo "No se encontraron acuerdos para la minuta.";
            return;
        }
        if (empty($firmantes)) {
            echo "No se encontraron firmantes para la minuta.";
            return;
        }
        if (empty($areasParticipa)) {
            echo "No se encontraron áreas participantes para la minuta.";
            return;
        }

        // Contar firmantes y firmantes finalizados
        $totalFirmantes = is_array($firmantes) ? count($firmantes) : 0;
        $firmantesFinalizados = 0;

        if ($totalFirmantes > 0) {
            foreach ($firmantes as $f) {
                if (isset($f['FIR_STATUS_FIRMANTE_DOC']) && $f['FIR_STATUS_FIRMANTE_DOC'] == 3) {
                    $firmantesFinalizados++;
                }

            }
        }



        $pdf = new pdfl(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Configurar marca de agua ANTES de agregar la primera página
        $pdf->showWatermark = ($totalFirmantes == 0 || $firmantesFinalizados < $totalFirmantes);

        // Asignar folio para el pie de página vertical
        $pdf->folioDocumento = $infoGen['FOLIO_DOC'] ?? '';

        // Configuración del PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sistema Institucional de Gestion de Oficios - MINUTAS');
        $pdf->SetSubject('Documento');
        $pdf->SetTitle('Minuta de reunión ' . $id);
        $pdf->SetKeywords('documento, minutas');

        $margenTop = "35";
        $margenIzq = "20";
        $margenDer = "25";
        $pdf->SetMargins($margenIzq, $margenTop, $margenDer);

        $margenEncabezado = "10";
        $pdf->SetHeaderMargin($margenEncabezado);
        $margenFooter = "10";
        $pdf->SetFooterMargin($margenFooter);

        $margenBoottom = "40";
        $pdf->SetAutoPageBreak(true, $margenBoottom);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $orientacion = 'P';
        if (isset($infoGen['ORIENTACION']) && $infoGen['ORIENTACION'] == 'H') {
            $orientacion = 'L';
        }

        // Agregar primera página (ya con la marca de agua configurada)
        $pdf->AddPage($orientacion, 'LETTER');


        // Centralización de estilos
        $styleTitulo = 'style="background-color:#00492e; color:#ffffff; font-weight:bold; font-size:14px; text-align:center;"';
        $styleSubtitulo = 'style="background-color:#00492e; color:#ffffff; font-weight:bold; font-size:12px; font-weight:bold;"';
        $styleTexto = 'style="background-color:#ffffff; color:#000000; font-size:10px;"';
        $styleTabla = 'style="border-collapse:collapse; width:100%; border:1px"';
        $styleTdBorder = 'style="border:1px ;"';

        $pdf->SetFont('aealarabiya', '', 15, '', true);
        $pdf->setCellHeightRatio(1.5);

        // Información de la minuta
        $areasHtml = '';
        if (is_array($areasParticipa)) {
            foreach ($areasParticipa as $area) {
                $areasHtml .= htmlspecialchars($area['AREA_PARTICIPA']) . '<br>';
            }
        } else {
            $areasHtml = htmlspecialchars($areasParticipa['AREA_PARTICIPA']);
        }

        $htmlMinuta = <<<EOD
<table cellpadding="4" cellspacing="0" border="1" width="100%" $styleTabla $styleTdBorder>
    <tr>
        <td $styleSubtitulo width="15%">Proceso(s):</td>
        <td $styleTexto width="40%"> {$infoGen['MIN_PROCESO']} </td>
        <td $styleSubtitulo width="15%">No./Folio (interno)</td>
        <td $styleTexto width="30%">{$infoGen['MIN_FOLIO']}</td>
    </tr>
    <tr>
        <td $styleSubtitulo width="15%">Fecha:</td>
        <td $styleTexto width="40%">{$this->fechaCastellano($infoGen['MIN_FECHA'])}</td>
        <td $styleSubtitulo width="15%">Hora inicio:</td>
        <td $styleTexto width="10%">{$infoGen['MIN_HINICIO']} hrs</td>
        <td $styleSubtitulo width="10%">Hora fin:</td>
        <td $styleTexto width="10%">{$infoGen['MIN_HFIN']} hrs</td>
    </tr>
    <tr>
        <td $styleSubtitulo width="15%">Lugar:</td>
        <td $styleTexto width="85%">{$infoGen['MIN_LUGAR']}</td>
    </tr>
    <tr>
        <td $styleSubtitulo width="15%">Áreas Participantes:</td>
        <td colspan="6" $styleTexto width="85%">{$areasHtml}</td>
    </tr>
</table>
EOD;
        $pdf->writeHTML($htmlMinuta, true, false, true, false, '');




        // ASUNTOS
        if ($asuntos && isset($asuntos['ASU_ID'])) {
            $asuntos = [$asuntos];
        }

        // Filtrar acuerdos generales y acuerdos por asunto
        $acuerdosGenerales = [];
        $acuerdosPorAsunto = [];
        if (is_array($acuerdos)) {
            foreach ($acuerdos as $acuerdo) {
                if (empty($acuerdo['ACU_FK_ASUNTO']) || $acuerdo['ACU_FK_ASUNTO'] == 0) {
                    $acuerdosGenerales[] = $acuerdo;
                } else {
                    $acuerdosPorAsunto[$acuerdo['ACU_FK_ASUNTO']][] = $acuerdo;
                }
            }
        }

        if (is_array($asuntos) && count($asuntos) > 0) {
            $contador = 1;
            foreach ($asuntos as $asunto) {
                // Tabla conjunta de asunto y acuerdos
                $htmlAsuntoAcuerdos = <<<EOD
<table cellpadding="4" cellspacing="0" border="1" width="100%" $styleTabla>
    <tr>
        <td colspan="4" $styleTitulo>Asunto {$contador}</td>
    </tr>
    <tr>
        <td $styleSubtitulo width="15%">Tema:</td>
        <td $styleTexto width="40%">{$asunto['ASU_TEMA']}</td>
        <td $styleSubtitulo width="15%">Presenta:</td>
        <td $styleTexto width="30%">{$asunto['ASU_PRESENTA']}</td>
    </tr>
    <tr>
        <td $styleSubtitulo>Resumen:</td>
        <td width="85%" $styleTexto colspan="3">{$asunto['ASU_RESUMEN']}</td>
    </tr>
    <tr>
        <td colspan="4" $styleSubtitulo>Acuerdos</td>
    </tr>
    <tr>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="50%">Descripción</td>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="25%">Responsable</td>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="25%">Fecha término</td>
        <td $styleSubtitulo width="0%"></td>
    </tr>
EOD;

                if (!empty($acuerdosPorAsunto[$asunto['ASU_ID']])) {
                    foreach ($acuerdosPorAsunto[$asunto['ASU_ID']] as $acuerdo) {
                        $htmlAsuntoAcuerdos .= <<<EOD
    <tr>
        <td $styleTexto>{$acuerdo['ACU_DESCRIPCION']}</td>
        <td $styleTexto>{$acuerdo['ACU_RESPONSABLE']}</td>
        <td $styleTexto nowrap>{$this->fechaCastellano($acuerdo['ACU_FECHA_FIN'])}</td>
        <td $styleTexto></td>
    </tr>
EOD;
                    }
                } else {
                    $htmlAsuntoAcuerdos .= <<<EOD
    <tr>
        <td $styleTexto colspan="4">Sin acuerdos vinculados.</td>
    </tr>
EOD;
                }
                $htmlAsuntoAcuerdos .= "</table>";

                // Escribir la tabla conjunta
                $pdf->writeHTML($htmlAsuntoAcuerdos, true, false, true, false, '');
                $contador++;
            }
        }

        // Tabla de acuerdos generales (no vinculados a ningún asunto)
        $htmlAcuerdosGenerales = <<<EOD
<table cellpadding="1" cellspacing="0" border="1" width="100%" $styleTabla>
    <tr>
        <td colspan="3" $styleTitulo>Acuerdos Generales</td>
    </tr>
    <tr>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="50%">Descripción</td>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="25%">Responsable</td>
        <td style="background-color:#7bab6a; color:#fff; font-weight:bold; font-size:12px;" width="25%">Fecha término</td>
    </tr>
EOD;

        if (count($acuerdosGenerales) > 0) {
            foreach ($acuerdosGenerales as $acuerdo) {
                $htmlAcuerdosGenerales .= <<<EOD
    <tr>
        <td $styleTexto>{$acuerdo['ACU_DESCRIPCION']}</td>
        <td $styleTexto>{$acuerdo['ACU_RESPONSABLE']}</td>
        <td $styleTexto nowrap>{$this->fechaCastellano($acuerdo['ACU_FECHA_FIN'])}</td>
    </tr>
EOD;
            }
        } else {
            $htmlAcuerdosGenerales .= <<<EOD
    <tr>
        <td $styleTexto colspan="3">Sin acuerdos generales.</td>
    </tr>
EOD;
        }
        $htmlAcuerdosGenerales .= "</table>";
        $pdf->writeHTML($htmlAcuerdosGenerales, true, false, true, false, '');


        // MEJORAS
        $mejorasConcluidas = [];
        $nuevasMejoras = [];

        foreach ($mejoras as $mejora) {
            if ($mejora['MEJ_TIPO'] == 1) {
                $mejorasConcluidas[] = $mejora['MEJ_DESCRIPCION'] ?? 'Ninguno';
            } elseif ($mejora['MEJ_TIPO'] == 2) {
                $nuevasMejoras[] = $mejora['MEJ_DESCRIPCION'] ?? 'Ninguno';
            }
        }

        $htmlMejoras = <<<EOD
<table cellpadding="4" cellspacing="0" border="1" width="100%" $styleTabla>
<tr>
    <td $styleTitulo>Mejora(s) al proceso concluidas</td>
</tr>
<tr>
    <td $styleTexto>
        <ol>
EOD;

        if (empty($mejorasConcluidas)) {
            $htmlMejoras .= <<<EOD
            <li>Ninguno</li>
EOD;
        } else {
            foreach ($mejorasConcluidas as $descripcion) {
                $htmlMejoras .= <<<EOD
            <li>{$descripcion}</li>
EOD;
            }
        }

        $htmlMejoras .= <<<EOD
        </ol>
    </td>
</tr>
<tr>
    <td $styleTitulo>Nuevas mejora(s) al proceso identificadas y comprometidas para la siguiente reunión</td>
</tr>
<tr>
    <td $styleTexto>
        <ol>
EOD;

        if (empty($nuevasMejoras)) {
            $htmlMejoras .= <<<EOD
            <li>Ninguno</li>
EOD;
        } else {
            foreach ($nuevasMejoras as $descripcion) {
                $htmlMejoras .= <<<EOD
            <li>{$descripcion}</li>
EOD;
            }
        }

        $htmlMejoras .= <<<EOD
        </ol>
    </td>
</tr>
</table>
EOD;

        $pdf->writeHTML($htmlMejoras, true, false, true, false, '');




        // FIRMANTES
        $htmlFirmantes = <<<EOD
<table border="1" cellspacing="0" cellpadding="4" $styleTabla>
    <tr>
        <th $styleTitulo>Nombre</th>
        <th $styleTitulo>Cargo</th>
        <th $styleTitulo>Firma</th>
    </tr>
EOD;

        // Si solo hay un firmante, lo convertimos en arreglo
        if ($firmantes && isset($firmantes['FIRMANTE'])) {
            $firmantes = [$firmantes];
        }

        if (is_array($firmantes) && count($firmantes) > 0) {
            foreach ($firmantes as $firmante) {
                // Determinar el texto a mostrar en la columna "Firma"
                if (!empty($firmante['FIR_DATESIGN']) && !empty($firmante['FIR_SHA_SIGNATURE'])) {
                    $textoFirma = '<span style="color:#388e3c;font-weight:bold;">FIRMADO</span> - <span style="color:#888;">' . $firmante['FIR_DATESIGN'] . '</span> - <span style="color:#888;">' . $firmante['FIR_SHA_SIGNATURE'] . '</span>';
                } else {
                    $textoFirma = '<span style="color:#d32f2f;font-weight:bold;">FIRMA PENDIENTE</span> <br>
<span style="color:#888;">Fecha de Firma: N/A</span> <br>
<span style="color:#888;">Folio de Seguimiento:<br> ' . $firmante['FIR_ID_SEGUIMIENTO'] . '</span>';
                }

                $htmlFirmantes .= <<<EOD
    <tr>
        <td $styleTexto>{$firmante['FIRMANTE']}</td>
        <td $styleTexto>{$firmante['FIR_CARGO']}</td>
        <td style="background-color:#ffffff; color:#000000; font-size:10px; text-align:center;">{$textoFirma}</td>
    </tr>
EOD;
            }
        } else {
            $htmlFirmantes .= <<<EOD
    <tr>
        <td $styleTexto></td>
        <td $styleTexto></td>
        <td $styleTexto></td>
    </tr>
EOD;
        }

        $htmlFirmantes .= "</table>";
        $pdf->writeHTML($htmlFirmantes, true, false, true, false, '');


        // Ruta del archivo adjunto


        $rutaVinculado = '';
        if (!empty($infoGen['RUTA_PDF_MINUTA'])) {
            $rutaVinculado = $_SERVER['DOCUMENT_ROOT'] . '/documentos_almacenados/minutas/' . $infoGen['RUTA_PDF_MINUTA'];
        }

        if ($rutaVinculado && file_exists($rutaVinculado)) {
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(true);


            $pageCount = $pdf->setSourceFile($rutaVinculado);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $tplId = $pdf->importPage($pageNo);
                $pdf->AddPage();
                $pdf->useTemplate($tplId);

                // Llama manualmente a la marca de agua y folio vertical

            }

            $pdf->setPrintHeader(true);
            $pdf->setPrintFooter(true);
        }



        //* PAGINA EXTRA PARA CADENA DE FIRMA Y QR
        $pdf->lastPage();

        if (!empty($infoGen['CADENA_ORIGINAL_SHA_256'])) {
            // Configuración de página
            $pdf->setPrintHeader(false);
            $pdf->AddPage($orientacion, 'LETTER');
            $pdf->setPrintFooter(true);

            // Encabezado del documento
            $pdf->SetFont('aealarabiya', 'B', 14, '', true);
            $pdf->SetY(15);
            $pdf->Cell(0, 0, 'Constancia de Verificación de Documentos Digitales', 0, 1, 'C');
            $pdf->SetFont('helvetica', '', 8, '', true);
            $pdf->Ln(5);

            // Sección QR y Cadena Original
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $qrSize = 40;
            $urlQR = "https://efirma.uqroo.mx/verify/" . $infoGen['FOLIO_DOC'];
            //$urlQR = BASE_URL . 'viewminuta/previsualizarPDF/' . $id;

            // QR Code con borde
            $pdf->SetDrawColor(200, 200, 200);
            $pdf->Rect($x, $y, $qrSize, $qrSize, 'D');
            $pdf->write2DBarcode(
                $urlQR,
                'QRCODE,H',
                $x + 2,  // Margen interno
                $y + 2,  // Margen interno
                $qrSize - 4,
                $qrSize - 4,
                [],
                'N'
            );


            $htmlCadena = <<<EOD
<table border="0" cellpadding="4" cellspacing="0" style="width:100%;">
    <tr>
        <td style="text-align:left; font-size:11px; font-weight:bold; border-bottom:1px solid #ddd; padding-bottom:3px;"><strong>CADENA ORIGINAL</strong>
        <br><span style="font-size:10px;">FOLIO DEL DOCUMENTO DIGITAL: {$infoGen['FOLIO_DOC']}</span>
        </td>
    </tr>
    <tr>
        <td style="font-family:aealarabiya; font-size:6px; word-wrap:break-word; padding-top:5px;">{$infoGen['CADENA_ORIGINAL_SHA_256']}
        </td>
    </tr>
</table>
EOD;

            // Cadena Original con mejor formato
            $pdf->SetXY($x + $qrSize + 8, $y);
            $pdf->writeHTML($htmlCadena, true, false, true, false, '');
            $pdf->Ln(8);

            /* $pdf->SetFont('aealarabiya', 'B', 7, '', true);
             $pdf->SetXY(20,65);
             $pdf->writeHTML('<a href="https://efirma.uqroo.mx/verify/' . $infoGen['FOLIO_DOC'] . '" target="_blank" style="text-decoration:none; color:#0000EE;">URL del Documento Comprobatorio</a>', true, false, true, false, '');
 */
            // --- NUEVO: Mueve el cursor Y debajo del QR antes de la tabla de firmas ---
            $pdf->SetY($y + $qrSize + 1); // 10 es margen, ajusta si lo necesitas

            // Sección de Firmas Digitales
            if (is_array($firmantes) && count($firmantes) > 0) {
                $htmlFirmantes = <<<EOD
    <table border="0" cellpadding="2" cellspacing="0" style="width:100%;">
        <tr>
            <td style="font-weight:bold; text-align:left; border-bottom:1px solid #ddd; padding-bottom:1px;">FIRMAS AUTORIZADAS MEDIANTE CERTIFICACIÓN DIGITAL
            </td>
        </tr>
EOD;

                foreach ($firmantes as $firmante) {
                    $nombre = mb_strtoupper($firmante['FIR_NOMBRE'], 'UTF-8');
                    $nombrePrefijo = mb_strtoupper($firmante['FIRMANTE'], 'UTF-8');
                    $cargo = mb_strtoupper($firmante['FIR_CARGO'], 'UTF-8');
                    $curp = mb_strtoupper($firmante['FIR_CURP'], 'UTF-8');
                    $folioDocumento = $infoGen['FOLIO_DOC'] ?? 'N/A';
                    $folioUnicoSeguimiento = $firmante['FIR_ID_SEGUIMIENTO'] ?? 'N/A';
                    $firma = $firmante['FIR_SHA_SIGNATURE'] ?? '<span style="color:#d32f2f;font-weight:bold;">En Espera De Firma Digital</span>';
                    $fechafirma = $firmante['FIR_DATESIGN'] ?? '<span style="color:#d32f2f;font-weight:bold;">Sin Fecha</span>';
                    $firmastatus = $firmante['FIR_STATUS_FIRMANTE_DOC'] ?? 'SIN ESTADO DE FIRMA';

                    // Traducción de estado
                    switch ($firmastatus) {
                        case 1:
                            $estadoTexto = '<span style="color:#d32f2f;font-weight:bold;">Sin estado</span>';
                            break;
                        case 2:
                            $estadoTexto = '<span style="color:#fbc02d;font-weight:bold;">En espera</span>';
                            break;
                        case 3:
                            $estadoTexto = '<span style="color:#388e3c;font-weight:bold;">Finalizado</span>';
                            break;
                        default:
                            $estadoTexto = 'SIN ESTADO DE FIRMA';
                            break;
                    }

                    $htmlFirmantes .= <<<EOD
<tr>
    <td style="border-bottom:1px solid #ddd; padding-bottom:4px;">
        <span style="font-weight:bold; font-size:9px;">{$nombrePrefijo} - {$cargo}</span><br>
        <span style="font-size:8px;"><strong>Nombre:</strong> {$nombre} | 
            <strong>CURP:</strong> {$curp} | 
            <strong>Fecha Firma:</strong> {$fechafirma} | 
            <strong>Estado:</strong> {$estadoTexto}<br>
            <strong>Sistema:</strong> SISTEMA INSTITUCIONAL DE GESTIÓN DE OFICIOS | 
            <strong>Folio Seguimiento:</strong> {$folioUnicoSeguimiento}<br>
            <strong>Validación Cifrada de la Firma Electrónica:</strong> 
            <span style="font-family:aealarabiya; font-size:8px;">{$firma}</span>
        </span>
    </td>
</tr>
EOD;
                }

                $htmlFirmantes .= "</table>";
                $pdf->writeHTML($htmlFirmantes, true, false, true, false, '');
            }
        }

        //* FIN DE LA HOJA EXTRA PARA CADENA DE FIRMA Y QR */
        ob_clean();
        $pdf->Output('Minuta de reunion ' . $id . '.pdf', 'I');
        exit;
    }

    //*GENERA LA CADENA DE MINUTA PARA FIRMA DIGITAL Y LA GUARDA EN LA BASE DE DATOS

    public function generarCadenaMinuta($id)
    {

        $this->forzarLogin();


        header('Content-Type: application/json; charset=utf-8');

        // Obtener los datos
        $infoGen = $this->_nom->getInfoGeneral($id);
        $asuntos = $this->_nom->getAsuntos($id);
        $acuerdos = $this->_nom->getAcuerdos($id);
        $mejoras = $this->_nom->getMejoras($id);
        $firmantes = $this->_nom->getFirmantes($id);
        $areasParticipa = $this->_nom->getAreasParticipa($id);

        // Validar datos
        if (empty($infoGen) || empty($asuntos) || empty($acuerdos) || empty($firmantes) || empty($areasParticipa)) {
            echo json_encode(['error' => 'Información incompleta para la minuta.']);
            exit;
        }

        // Normalizar datos
        if ($asuntos && isset($asuntos['ASU_ID'])) {
            $asuntos = [$asuntos];
        }
        if ($acuerdos && isset($acuerdos['ACU_ID'])) {
            $acuerdos = [$acuerdos];
        }
        if ($firmantes && isset($firmantes['FIRMANTE'])) {
            $firmantes = [$firmantes];
        }
        if ($areasParticipa && isset($areasParticipa['AREA_PARTICIPA'])) {
            $areasParticipa = [$areasParticipa];
        }


        // Formatear fechas
        $min_fecha = $this->formatoFechaCorta($infoGen['MIN_FECHA']);
        foreach ($acuerdos as &$acuerdo) {
            $acuerdo['ACU_FECHA_FIN'] = $this->formatoFechaCorta($acuerdo['ACU_FECHA_FIN']);
        }
        unset($acuerdo);

        // Solo los campos requeridos
        $data = [
            // Información general de la minuta
            $infoGen['TIPO_DOCUMENTO'],
            'informacion general' => 'General:' . $infoGen['MIN_PROCESO'] . ';' . $infoGen['MIN_FOLIO'] . ';' . $min_fecha . ';' . $infoGen['MIN_HINICIO'] . ';' . $infoGen['MIN_HFIN'] . ';' . $infoGen['MIN_LUGAR'] . ';' . 'URES:' . implode(
                ';',
                array_map(function ($a) {
                    return $a['ID_URE_PAR'];
                }, $areasParticipa)
            ),
            // Firmantes
            'firmantes' => 'Firmantes:' . implode(';', array_map(function ($f) {
                return $f['FIRMANTE'] . ';' . $f['FIR_CARGO'] . ';' . $f['FIR_CORREO'];
            }, $firmantes)),

            // Asuntos
            'asuntos' => 'Asuntos:' . implode(';', array_map(function ($a) {
                return $a['ASU_ID'] . ':[' . $a['ASU_TEMA'] . ';' . $a['ASU_PRESENTA'] . ']';
            }, $asuntos)),

            // SHA-256 de los asuntos
            'SHA-asuntos' => hash('sha256', implode(';', array_map(function ($a) {
                return $a['ASU_RESUMEN'];
            }, $asuntos))),

            // Acuerdos (con fecha formateada)
            'acuerdos' => 'Acuerdos:' . implode(';', array_map(function ($a) {
                return $a['ACU_ID'] . ';' . $a['RESPONSABLE_ID'] . ':' . $a['ACU_FECHA_FIN'];
            }, $acuerdos)),

            // SHA-256 de los acuerdos
            'SHA-acuerdos' => hash('sha256', implode(';', array_map(function ($a) {
                return $a['ACU_DESCRIPCION'];
            }, $acuerdos))),

            // Mejoras
            'mejoras' => 'Mejoras:' . implode(';', array_map(function ($m) {
                return $m['MEJ_ID'] . ':' . $m['MEJ_TIPO'];
            }, $mejoras)),
            // SHA-256 de las mejoras
            'SHA-mejoras' => hash('sha256', implode(';', array_map(function ($m) {
                return $m['MEJ_DESCRIPCION'];
            }, $mejoras))),

            'Formato PGC-F005 Minuta de reunión Rev. 3.1 - 11/07/2024', 
            (
                    (empty($infoGen['METADATOS_DOC']) || empty($infoGen['BINARIO_DOC']))
                    ? 'sin documento adjunto'
                    : $infoGen['METADATOS_DOC'] . '|' . 'Binario: ' . $infoGen['BINARIO_DOC']
                )


        ];


        $cadena = implode('|', $data);

        $sql = "UPDATE DOC_MINUTA SET MIN_CADENA = :cadena WHERE MD5(MIN_ID||'_minuta') = :id";
        $params = array(':cadena' => $cadena, ':id' => $id);
        $this->_nom->ssql($sql, $params, 0);

        /*
                echo json_encode([
                    'cadena' => $cadena,
                    //'sha256' => $hash,
                    'data' => $data
                ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        */
    }

    //*METDOO QUE CENTRALIZA LA ACCION DE GENERAR CADENA Y FIRMA DIGITAL
    public function generarCadenaYFirma($id)
    {
        $this->forzarLogin();

        // Limpia el buffer antes de enviar la respuesta JSON
        ob_clean();
        header('Content-Type: application/json');

        try {
            
            $this->extraerMetadatosPDF($id);
            $this->binFOpen($id);
            $this->generarCadenaMinuta($id);
            $this->firmaDigital($id);
            echo json_encode([
                'success' => true,
                'redirect' => BASE_URL . 'viewminuta/prefirmado/' . $id
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }




    //* METODO DE FIRMA ELECTRONICA

    public function firmaDigital($id)
    {

        $this->forzarLogin();

        require_once ROOT . 'libs/FirmaElectronicaApiClient.php';
        $firmaClient = new FirmaElectronicaApiClient();
        $firmantes = $this->_nom->getFirmantes($id);
        $infoGen = $this->_nom->getInfoGeneral($id);

        // 1) Autenticación
        $token = $firmaClient->authenticate();
        if (!$token) {
            echo "Error al autenticar";
            return;
        }

        // 2) (Opcional) Obtener info
        $info = $firmaClient->getInfo($token);
        // …

        // 3) Crear documento con todos los campos, incluyendo viewers
        $docPayload = [
            'signatureType' => 'FEAU',
            'sendInvites' => true,
            'externalId' => $infoGen['TIPO_DOCUMENTO'] . '|' . $id, //sigo-id S
            'iframePath' => BASE_URL . 'viewminuta/previsualizarPDF/' . $id,
            'canonicalString' =>  $infoGen['TIPO_DOCUMENTO'] . '|UAQROO|' . $infoGen['CADENA_ORIGINAL_SHA_256'] . '|',// $InfOGen['CADENA_ORIGINAL_SHA_256']
            'signers' => array_map(function ($firmante) {
                return [
                    'name' => $firmante['FIR_NOMBRE'],
                    'email' => $firmante['FIR_CORREO'],
                    'numberId' => $firmante['FIR_CURP'],
                ];
            }, $firmantes),

            /*
                        'viewers' => [
                            [
                                'name' => 'LUIS SALAZAR',
                                'email' => 'jose.ku.salazar@outlook.com',
                            ],
                        ],*/
        ];

        // Mostrar el contenido de $docPayload


        $created = $firmaClient->createDocument($token, $docPayload);
        if (!$created || empty($created['folio'])) {
            echo "Error al crear documento";
            return;
        }

        // Mostrar el contenido de $created
        /*  echo "<pre>";
          print_r($created);
          echo "</pre>";
  */


        // Extraemos id y folio
        $docId = $created['id'];
        $folio = $created['folio'];
        //echo "Documento creado (ID: {$docId}, Folio: {$folio})\n";

        $idexterno = $created['externalId'];
        $status = $created['status'];
        $date_created = $created['fecha_creacion'];
        $dateSign = $created['dateSign'];


        $sql = "UPDATE DOC_MINUTA 
                    SET FOLIO_DOC = :folio,
                        EXTERNALID = :externalId,
                        STATUS_DOC = :status,
                        ID_FK_DOC = :id
                        --DATE_CREATE = :fecha_creacion
                        
                             WHERE MD5(MIN_ID||'_minuta') = :minuta_id ";
        $params = array(
            ':folio' => $folio,
            ':id' => $docId,
            ':externalId' => $idexterno,
            ':status' => $status,
            //':fecha_creacion'   => $date_created,
            ':minuta_id' => $id,

        );

        $this->_nom->ssql($sql, $params, 0);



        // 4) Obtener documento POR FOLIO (no por id)
        $doc = $firmaClient->getDocumentByFolio($token, $created['folio']);
        if (!$doc) {
            echo "Error al obtener documento por folio\n";
            return;
        }
        /* echo "<pre>";
         print_r($doc);
         echo "</pre>";*/

        // Extraemos el folio del firmante (primer firmante)
        foreach ($doc['signers'] as $signer) {
            $firmanteFolio = $signer['folio'];
            $firmanteStatus = $signer['status'];
            $firmantefirma = $signer['signature'];
            $firmantefechafirmado = $signer['dateSign'];
            $firmanteCurp = $signer['numberId']; // CURP del firmante

            $sql = "UPDATE DOC_MIN_FIRMANTES 
                            SET FIR_ID_SEGUIMIENTO = :folio, 
                                FIR_STATUS_FIRMANTE_DOC = :status,
                                FIR_SIGNATURE = :firma,
                                FIR_DATESIGN = :fecha_firmado,
                                FIR_ID_DOC = :id
                           WHERE MD5(FIR_FK_MINUTA||'_minuta') = :minuta_id 
                            AND FIR_CURP = :curp";

            $params = array(
                ':folio' => $firmanteFolio,
                ':status' => $firmanteStatus,
                ':firma' => $firmantefirma,
                ':fecha_firmado' => $firmantefechafirmado,
                ':minuta_id' => $id,
                ':curp' => $firmanteCurp,
                ':id' => $docId
            );


            $this->_nom->ssql($sql, $params, 0);
        }

    }


    //* METODO QUE MANDA A VERIFICAR EL ESTATUS DE LA MINUTA

    private function getFirma($id)
    {

        //  $this->forzarLogin();



        if (!$id) {
            die("ID de minuta no proporcionado o inválido");
        }

        require_once ROOT . 'libs/FirmaElectronicaApiClient.php';
        $firmaClient = new FirmaElectronicaApiClient();

        $infoGen = $this->_nom->getInfoGeneral($id);
        $folioDocumento = $infoGen['FOLIO_DOC'] ?? null;

        if (!$folioDocumento) {
            die("Folio del documento no encontradoz");
        }

        // 1. Autenticación
        $token = $firmaClient->authenticate();
        if (!$token) {
            echo json_encode([
                "success" => false,
                "error" => "No se pudo autenticar con la API de firmas"
            ]);
            return;
        }

        // 2. Obtener documento por folio usando el método proporcionado
        $doc = $firmaClient->getDocumentByFolio($token, $folioDocumento);

        if (!$doc) {
            echo json_encode([
                "success" => false,
                "error" => "No se pudo obtener información del documento o el folio es incorrecto",
                "folio" => $folioDocumento
            ]);
            return;
        }


        // 3. Actualizar firmantes en la base de datos
        if (isset($doc['signers']) && is_array($doc['signers'])) {
            foreach ($doc['signers'] as $signer) {
                $firmanteStatus = $signer['status'];
                $firmanteFirma = $signer['signature'];
                $firmanteFechaFirmado = $signer['dateSign'];
                $firmanteCurp = $signer['numberId']; // CURP del firmante

                // Calcular SHA-256 de la firma si existe
                $shaFirma = null;
                if (!empty($firmanteFirma)) {
                    $shaFirma = hash('sha256', $firmanteFirma);
                }

                $sql = "UPDATE DOC_MIN_FIRMANTES 
                SET FIR_STATUS_FIRMANTE_DOC = :status,
                    FIR_SIGNATURE = :firma,
                    FIR_DATESIGN = :fecha_firmado,
                    FIR_SHA_SIGNATURE = :sha_firma
               WHERE MD5(FIR_FK_MINUTA||'_minuta') = :minuta_id 
                AND FIR_CURP = :curp";

                $params = array(
                    ':status' => $firmanteStatus,
                    ':firma' => $firmanteFirma,
                    ':fecha_firmado' => $firmanteFechaFirmado,
                    ':sha_firma' => $shaFirma,
                    ':minuta_id' => $id,
                    ':curp' => $firmanteCurp
                );

                $this->_nom->ssql($sql, $params, 0);
            }
        }

        // 4. Actualizar DOC_MINUTA con date, status y dateSign del documento principal
        $sqlMinuta = "UPDATE DOC_MINUTA 
                    SET DATE_CREATE = :date_create,
                        STATUS_DOC = :status_doc,
                        DATESIGN = :datesign
                  WHERE MD5(MIN_ID||'_minuta') = :minuta_id";
        $paramsMinuta = array(
            ':date_create' => $doc['date'] ?? null,
            ':status_doc' => $doc['status'] ?? null,
            ':datesign' => $doc['dateSign'] ?? null,
            ':minuta_id' => $id
        );
        $this->_nom->ssql($sqlMinuta, $paramsMinuta, 0);


        /*
                // 5. Respuesta exitosa
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => true,
                    "data" => $doc
                ]);
                */
    }
    public function extraerMetadatosPDF($id)
    {
        $infoGen = $this->_nom->getInfoGeneral($id);

        $rutaPDF = $_SERVER['DOCUMENT_ROOT'] . '/documentos_almacenados/minutas/' . $infoGen['RUTA_PDF_MINUTA'];

        if (!file_exists($rutaPDF)) {
            echo json_encode(['error' => 'El archivo PDF no existe']);
            return;
        }

        try {
            // Obtener información básica del archivo
            $fileStats = stat($rutaPDF);
            $fileInfo = [
                'Tamaño' => $fileStats['size'],
                'Creado' => date('Y-m-d H:i:s', filectime($rutaPDF)),
                'Modificado' => date('Y-m-d H:i:s', $fileStats['mtime']),
                'Accedido' => date('Y-m-d H:i:s', $fileStats['atime']),
            ];

            // Convertir los metadatos a una cadena de texto plano
            $metadatosTexto = "Información del documento: Tamaño:{$fileInfo['Tamaño']}, Creado:{$fileInfo['Creado']}, Modificado:{$fileInfo['Modificado']}, Accedido:{$fileInfo['Accedido']}";

            // Actualizar la columna METADATOS_DOC en la tabla DOC_MINUTA
            $sql = "UPDATE DOC_MINUTA SET METADATOS_DOC = :metadatos WHERE MD5(MIN_ID||'_minuta') = :id";
            $params = [
                ':metadatos' => $metadatosTexto,
                ':id' => $id,
            ];
            $this->_nom->ssql($sql, $params, 0);

            // Retornar los metadatos como respuesta
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function binFOpen($id)
    {
        $infoGen = $this->_nom->getInfoGeneral($id);

        $rutaPDF = $_SERVER['DOCUMENT_ROOT'] . '/documentos_almacenados/minutas/' . $infoGen['RUTA_PDF_MINUTA'];

        if (!file_exists($rutaPDF)) {
            echo json_encode(['error' => 'El archivo PDF no existe']);
            return;
        }

        try {
            // Abrir el archivo en modo binario
            $handle = fopen($rutaPDF, 'rb');
            if (!$handle) {
                echo json_encode(['error' => 'No se pudo abrir el archivo en modo binario']);
                return;
            }

            // Leer el contenido del archivo
            $content = fread($handle, filesize($rutaPDF));

            // Cerrar el archivo
            fclose($handle);

            // Verificar si el contenido binario está vacío
            if (empty($content)) {
                echo json_encode(['error' => 'El contenido del archivo está vacío']);
                return;
            }

            // Codificar el contenido en Base64
            $binaryEncoded = base64_encode($content);

            // Generar el hash SHA-256 del contenido binario
            $hash = hash('sha256', $content);

            // Actualizar la columna BINARIO_DOC en la tabla DOC_MINUTA
            // Usamos MD5 para identificar la minuta de forma única
            $sql = "UPDATE DOC_MINUTA SET BINARIO_DOC = :binario WHERE MD5(MIN_ID||'_minuta') = :id";
            $params = [
                ':binario' => $hash,
                ':id' => $id,
            ];
            $this->_nom->ssql($sql, $params, 0);

           

        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


}

