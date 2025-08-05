<?php
require_once 'c:/xampp/htdocs/SIGO/libs/composer_fpdi/vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi; 

// HABILITAR CORS para permitir acceso desde efirma.uqroo.mx
header("Access-Control-Allow-Origin: https://efirma.uqroo.mx");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class pdfl extends FPDI
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

      protected function addWatermark()
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

        // Resto del encabezado
        $img_file = '/opt/sitios/gesco/public/img//UQROO.png';
        $this->Image($img_file, 20, 0, 20, 24, '', '', '', false, 300, '', false, false, 0);

        $this->SetFont('aealarabiya', 'B', 23);
        $this->SetTextColor(60, 120, 90);
        $this->SetXY(75, 13);
        $this->SetTextColor(0, 0, 0);

        $y = 23;
      

        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }

    function Footer()
    {
         // Agregar marca de agua primero
        $this->addWatermark();
        $this->folioVertical();
        
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

class viewdocpropioController extends Controller
{
    private $_pdf;
    public function __construct()
    {
        parent::__construct();

        $this->_nom = $this->loadModel('viewdocpropio'); // Cargar el modelo de documentos propios
    }

    public function index()
    {       
    }




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

       /*$referer = $_SERVER['HTTP_REFERER'] ?? '';

            if (
                strpos($referer, 'https://sigo.uqroo.mx') === false &&
                strpos($referer, 'https://efirma.uqroo.mx') === false
            ) {
                echo "No permitido";
                exit();
            }*/
    // Obtener información del documento propio desde el modelo
    $infoDocPro = $this->_nom->getInfoDocPro($id);
    $firmantesPDF = $this->_nom->getFirmantes($id);

    
/*
echo "<pre>";
    print_r($firmantesPDF);
    echo "</pre>";
    exit;*/
    // Verificar si se obtuvo información del documento
    if (!$infoDocPro ||  !isset($infoDocPro['DP_ID'])) {
        echo "No se encontró información del documento.";
        return;
    }

    // Ruta del archivo PDF existente
    $rutaPDF = 'C:/xampp/htdocs/SIGO/documentos_almacenados/Doc_propios/' . $infoDocPro['DP_ID'] . '/' . $infoDocPro['DP_ID'] . '.pdf';

    // Verificar si el archivo existe
    if (!file_exists($rutaPDF)) {
        echo "El archivo no existe en la ruta: " . $rutaPDF;
        return;
    }

    // Crear una instancia de la clase pdfl
     $pdf = new pdfl(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

     // Contar firmantes y firmantes finalizados
        $totalFirmantes = is_array($firmantesPDF) ? count($firmantesPDF) : 0;
        $firmantesFinalizados = 0;
        if ($totalFirmantes > 0) {
            foreach ($firmantesPDF as $f) {
                if (isset($f['DP_STATUS_FIRMANTE_DOC']) && $f['DP_STATUS_FIRMANTE_DOC'] == 3) {
                    $firmantesFinalizados++;
                }
            }
        }
     $pdf->showWatermark = ($totalFirmantes == 0 || $firmantesFinalizados < $totalFirmantes);
    

     $pdf->folioDocumento = $infoDocPro['DP_FOLIO_DOC'] ?? '';
    // Importar el PDF existente
    try {
        $pageCount = $pdf->setSourceFile($rutaPDF);
    } catch (Exception $e) {
        echo "Error al cargar el archivo PDF: " . $e->getMessage();
        return;
    }

    // Agregar todas las páginas del PDF existente
    for ($i = 1; $i <= $pageCount; $i++) {
        $tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
        $pdf->useTemplate($tplIdx);
    }

    // Verificar si el documento tiene cadena original
    if (!empty($infoDocPro['DP_CADENA_ORIGINAL'])) {
    // Configuración de página adicional
    $pdf->setPrintHeader(false);
    $pdf->AddPage('P', 'LETTER');
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
    $urlQR = "https://efirma.uqroo.mx/verify/" . $infoDocPro['DP_ID'];

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

    // Cadena Original
    $htmlCadena = <<<EOD
<table border="0" cellpadding="4" cellspacing="0" style="width:100%;">
    <tr>
        <td style="text-align:left; font-size:11px; font-weight:bold; border-bottom:1px solid #ddd; padding-bottom:3px;"><strong>CADENA ORIGINAL</strong>
        <br><span style="font-size:10px;">FOLIO DEL DOCUMENTO DIGITAL: {$infoDocPro['DP_FOLIO_DOC']}</span>
        </td>
    </tr>
    <tr>
        <td style="font-family:aealarabiya; font-size:6px; word-wrap:break-word; padding-top:5px;">{$infoDocPro['DP_CADENA_ORIGINAL']}
        </td>
    </tr>
</table>
EOD;

    $pdf->SetXY($x + $qrSize + 8, $y);
    $pdf->writeHTML($htmlCadena, true, false, true, false, '');
    $pdf->Ln(8);

    // Sección de Firmas Digitales
    if (!empty($firmantesPDF)) {
        $pdf->Ln(10); // Espacio antes de la tabla de firmantes
        $htmlFirmantes = <<<EOD
<table border="0" cellpadding="2" cellspacing="0" style="width:100%;">
    <tr>
        <td style="font-weight:bold; text-align:left; border-bottom:1px solid #ddd; padding-bottom:1px;">FIRMAS AUTORIZADAS MEDIANTE CERTIFICACIÓN DIGITAL
        </td>
    </tr>
EOD;

        foreach ($firmantesPDF as $firmante) {
            $nombre = mb_strtoupper($firmante['DP_NOMBRE'], 'UTF-8');
            $nombrePrefijo = mb_strtoupper($firmante['FIRMANTE'], 'UTF-8');
            $cargo = mb_strtoupper($firmante['DP_CARGO'], 'UTF-8');
            $curp = mb_strtoupper($firmante['DP_CURP'], 'UTF-8');
            $firma = $firmante['DP_SHA_SIGNATURE'] ?? '<span style="color:#d32f2f;font-weight:bold;">En Espera De Firma Digital</span>';
            $fechaFirma = $firmante['DP_DATESIGN'] ?? '<span style="color:#d32f2f;font-weight:bold;">Sin Fecha</span>';
            $estadoFirma = $firmante['DP_STATUS_FIRMANTE_DOC'] ?? 'SIN ESTADO DE FIRMA';
            $folioUnicoSeguimiento = $firmante['DP_ID_SEGUIMIENTO'] ?? 'N/A';
            $tipoDocumento = $infoDocPro['DP_TIPO_DOCUMENTO'] ?? 'N/A';

            // Traducción de estado
            switch ($estadoFirma) {
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
            <strong>Fecha Firma:</strong> {$fechaFirma} | 
            <strong>Estado:</strong> {$estadoTexto}<br>
            <strong>Sistema:</strong> SISTEMA INSTITUCIONAL DE GESTIÓN DE OFICIOS | {$tipoDocumento}<br>
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
    

    // Mostrar el PDF en el navegador
    ob_clean(); // Limpia el buffer de salida para evitar errores
    $pdf->Output('documento_modificado.pdf', 'I');
}


 public function generarCadenaOriginal($id)
    {

        $this->forzarLogin();


        header('Content-Type: application/json; charset=utf-8');

        // Obtener los datos
        $postInfoDocPro = $this->_nom->getInfoDocPro($id);
        

        // Validar datos
        if (empty($postInfoDocPro)) {
            echo json_encode(['error' => 'Información incompleta para el documento.']);
            exit;
        }

        // Solo los campos requeridos
        $data = [
            $postInfoDocPro['DP_FOLIO_DOC'], $postInfoDocPro['DP_DENOMINACION'],
            $postInfoDocPro['DP_FOLIO'], $postInfoDocPro['DP_FECHA'], $postInfoDocPro['DP_TIPO_DOCUMENTO'],
        ];


        $cadena = implode('|', $data);

        $sql = "UPDATE DOC_PROPIOS SET DP_CADENA_ORIGINAL = :cadena WHERE MD5(DP_ID||'_docpro') = :id";
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

    
     public function prefirmado($id)
    {

        $this->forzarLogin();


        if (!$id) {
            die("ID de documento no proporcionado o inválido");
        }


        $postInfoDocPro = $this->_nom->getInfoDocPro($id);
        $firmantesPDF = $this->_nom->getFirmantes($id);
     /* echo '<pre>';
          echo "ID recibido: $id\n";
          echo "infoGen:\n";
          print_r($postInfoDocPro);
          echo "firmantes:\n"; DP_FOLIO_DOC
          print_r($firmantesPDF);
          echo '</pre>';
          exit;*/

        $totalFirmantes = is_array($firmantesPDF) ? count($firmantesPDF) : 0;
        $firmantesFirmados = 0;
        if ($totalFirmantes > 0) {
            foreach ($firmantesPDF as $f) {
                if (isset($f['DP_STATUS_FIRMANTE_DOC']) && $f['DP_STATUS_FIRMANTE_DOC'] == 3) {
                    $firmantesFirmados++;
                }
            }
        }


        $fechaCreacion = $postInfoDocPro['DP_FECHA'] ?? null; // Extract DP_FECHA
        if ($fechaCreacion) {
            $fechaCreacion = $this->fechaCastellano($fechaCreacion); // conversion a formato legible
        }
        $this->_view->assign('fecha_creacion', $fechaCreacion);


        $folioDoc = $postInfoDocPro['DP_FOLIO_DOC'] ?? null;
        $this->_view->assign('folioDoc', $folioDoc);


        $this->_view->assign('totalFirmantes', $totalFirmantes);
        $this->_view->assign('firmantesFirmados', $firmantesFirmados);
        $this->_view->assign('firmantes', $firmantesPDF);

        $this->_view->assign('documento_propio_id', $id);
        $this->_view->assign('baseUrl', BASE_URL);

        $this->_view->renderizar('viewdocpropio'); // vista de documento propio
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


    public function generarCadenaYFirma($doc_id)
    {
        $this->forzarLogin();


        header('Content-Type: application/json');
        try {
            $this->generarCadenaOriginal($doc_id);
            $this->firmaDigital($doc_id);
            echo json_encode([
                'success' => true,
                'redirect' => BASE_URL . 'viewdocpropio/prefirmado/' . $doc_id
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
        $postInfoDocPro = $this->_nom->getInfoDocPro($id);
        $firmantesPDF = $this->_nom->getFirmantes($id);


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
            'externalId' => 'SIGO-' . $postInfoDocPro['DP_TIPO_DOCUMENTO'] . $id, 
            'iframePath' => BASE_URL . 'viewdocpro/previsualizarPDF/' . $id,
            'canonicalString' => '|SIGO|'.$postInfoDocPro['DP_TIPO_DOCUMENTO'].'|UAQROO|' . $postInfoDocPro['DP_CADENA_ORIGINAL'] . '|',// $InfOGen['CADENA_ORIGINAL_SHA_256']
            'signers' => array_map(function ($firmante) {
                return [
                    'name' => $firmante['DP_NOMBRE'],
                    'email' => $firmante['DP_CORREO'],
                    'numberId' => $firmante['DP_CURP'],
                ];
            }, $firmantesPDF),

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


        $docId          = $created['id'];
        $folio          = $created['folio'];
        $idexterno      = $created['externalId'];
        $status         = $created['status'];
        $date_created   = $created['fecha_creacion'];
        $dateSign       = $created['dateSign'];


        $sql = "UPDATE DOC_PROPIOS 
                    SET DP_FOLIO_DOC = :folio,
                        DP_ID_FK_DOC = :id,
                        DP_EXTERNALID = :externalId,
                        DP_STATUS_DOC = :status                      
                             WHERE MD5(DP_ID||'_docpro') = :docpro_id ";
        $params = array(
            ':folio'        => $folio,
            ':id'           => $docId,
            ':externalId'   => $idexterno,
            ':status'       => $status,
            ':docpro_id'    => $id,

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
            $firmanteFolio          = $signer['folio'];
            $firmanteStatus         = $signer['status'];
            $firmantefirma          = $signer['signature'];
            $firmantefechafirmado   = $signer['dateSign'];
            $firmanteCurp           = $signer['numberId']; // CURP del firmante

            $sql = "UPDATE DOC_PRO_FIRMANTES 
                            SET DP_ID_SEGUIMIENTO       = :folio, 
                                DP_STATUS_FIRMANTE_DOC  = :status,
                                DP_SIGNATURE            = :firma,
                                DP_DATESIGN             = :fecha_firmado,
                                DP_ID_DOC               = :id
                            WHERE MD5(DP_FK_DOCPROPIO||'_docpro') = :docpro_id
                            AND DP_CURP = :curp";

            $params = array(
                ':folio'            => $firmanteFolio,
                ':status'           => $firmanteStatus,
                ':firma'            => $firmantefirma,
                ':fecha_firmado'    => $firmantefechafirmado,
                ':docpro_id'        => $id,
                ':curp'             => $firmanteCurp,
                ':id'               => $docId
            );


            $this->_nom->ssql($sql, $params, 0);
        }

    }


    //* METODO QUE MANDA A VERIFICAR EL ESTATUS DE LA MINUTA

    public function getFirma($id)
    {

        $this->forzarLogin();



        if (!$id) {
            die("ID del documento no proporcionado o inválido");
        }

        require_once ROOT . 'libs/FirmaElectronicaApiClient.php';
        $firmaClient = new FirmaElectronicaApiClient();

        $postInfoDocPro = $this->_nom->getInfoDocPro($id);
        $folioDocumento = $postInfoDocPro['DP_FOLIO_DOC'] ?? null;

        if (!$folioDocumento) {
            die("Folio del documento no encontrado");
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
                $firmanteStatus         = $signer['status'];
                $firmanteFirma          = $signer['signature'];
                $firmanteFechaFirmado   = $signer['dateSign'];
                $firmanteCurp           = $signer['numberId']; // CURP del firmante

                // Calcular SHA-256 de la firma si existe
                $shaFirma = null;
                if (!empty($firmanteFirma)) {
                    $shaFirma = hash('sha256', $firmanteFirma);
                }

                $sql = "UPDATE DOC_PRO_FIRMANTES 
                SET DP_STATUS_FIRMANTE_DOC  = :status,
                    DP_SIGNATURE            = :firma,
                    DP_DATESIGN             = :fecha_firmado,
                    DP_SHA_SIGNATURE        = :sha_firma
               WHERE MD5(DP_FK_DOCPROPIO||'_docpro') = :docpro_id 
                AND DP_CURP = :curp";

                $params = array(
                    ':status'           => $firmanteStatus,
                    ':firma'            => $firmanteFirma,
                    ':fecha_firmado'    => $firmanteFechaFirmado,
                    ':sha_firma'        => $shaFirma,
                    ':docpro_id'        => $id,
                    ':curp'             => $firmanteCurp
                );

                $this->_nom->ssql($sql, $params, 0);
            }
        }

        // 4. Actualizar DOC_PROPIOS con date, status y dateSign del documento principal
        $sqlDocPropio = "UPDATE DOC_PROPIOS
                    SET DP_DATESIGN     = :date_create,
                        DP_STATUS_DOC   = :status_doc,
                        DP_DATESIGN     = :datesign
                  WHERE MD5(DP_ID||'_docpro') = :docpro_id";
        $paramsDocPropio = array(
            ':date_create'  => $doc['date'] ?? null,
            ':status_doc'   => $doc['status'] ?? null,
            ':datesign'     => $doc['dateSign'] ?? null,
            ':docpro_id'    => $id
        );
        $this->_nom->ssql($sqlDocPropio, $paramsDocPropio, 0);



        // 5. Respuesta exitosa
        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "data" => $doc
        ]);
    }

}