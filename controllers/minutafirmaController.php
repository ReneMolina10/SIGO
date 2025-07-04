<?php
class minutafirmaController extends Controller
{
    private $_cont;

    public function __construct()
    {
        parent::__construct();
        //$this->forzarLogin();
        //    $this->_cont = $this->loadModel('');
    }

    public function index()
    {

    }



    //* AREA DE FIRMA ELECTRONICA

    public function prueba($id)
    {

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
            'externalId' => 'SIGO-' . $id, //sigo-id 
            'iframePath' => BASE_URL . 'opt/sitios/gesco/public/MinutaSeguimiento/' . $id . '.pdf',
            'canonicalString' => '|SIGO|MINUTA|UAQROO|' . $infoGen['CADENA_ORIGINAL_SHA_256'] . '|',// $InfOGen['CADENA_ORIGINAL_SHA_256']
            'signers' => array_map(function ($firmante) {
                return [
                    'name' => $firmante['FIR_NOMBRE'],
                    'email' => $firmante['FIR_CORREO'],
                    'numberId' => $firmante['FIR_CURP'],
                ];
            }, $firmantes),


            'viewers' => [
                [
                    'name' => 'LUIS SALAZAR',
                    'email' => 'jose.ku.salazar@outlook.com',
                ],
            ],
        ];

        // Mostrar el contenido de $docPayload
        echo '<pre>';
        print_r($docPayload);
        echo '</pre>';
        exit;

        $created = $firmaClient->createDocument($token, $docPayload);
        if (!$created || empty($created['folio'])) {
            echo "Error al crear documento";
            return;
        }



        // Extraemos id y folio
        $docId = $created['id'];
        $folio = $created['folio'];
        echo "Documento creado (ID: {$docId}, Folio: {$folio})\n";


        // 4) Obtener documento POR FOLIO (no por id)
        $doc = $firmaClient->getDocumentByFolio($token, $created['folio']);
        if (!$doc) {
            echo "Error al obtener documento por folio\n";
            return;
        }

        // 5) Firmar documento
        // Extraemos del array $doc lo que necesitamos:
        /*$signPayload = [
            'document'        => $doc['folio'],                         // folio del documento
            'signer'          => $doc['signers'][0]['folio'],           // folio del firmante
            'password'        => '',                                    // como en el .bru
            'canonicalString' => $doc['signers'][0]['canonicalString'], // tal cual vino en GET
        ];

        $signResult = $firmaClient->signDocument($token, $signPayload);
        if (! $signResult) {
            echo "Error al firmar documento\n";
            return;
        }
        echo "Resultado de la firma:\n<pre>";
        print_r($signResult);
        echo "</pre>";*/
    }
}
?>