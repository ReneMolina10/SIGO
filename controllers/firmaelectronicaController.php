<?php



class firmaelectronicaController extends Controller
{
  private $_cont;

  public function __construct()
  {
    parent::__construct();
    $this->forzarLogin();
    //    $this->_cont = $this->loadModel('');
  }

  public function index()
  {
    
  }

  public function prueba(){

    require_once ROOT. 'libs/FirmaElectronicaApiClient.php';
    $firmaClient= new FirmaElectronicaApiClient();
    
    // 1) Autenticación
    $token = $firmaClient->authenticate();
    if (! $token) {
        echo "Error al autenticar";
        return;
    }

    // 2) (Opcional) Obtener info
    $info = $firmaClient->getInfo($token);
    // …

    // 3) Crear documento con todos los campos, incluyendo viewers
    $docPayload = [
        'signatureType'   => 'FES',
        'sendInvites'     => true,
        'externalId'      => 'X', //sigo-id 
        'iframePath'      => 'https://www.orimi.com/pdf-test.pdf',
        'canonicalString' => '|PRUEBAS|FIRMA39|UNACAR|c4aeb629-99df-4c6e-b37d-9bd0f7da767f|3eece8bd-6c4d-485a-a5bf-4571a7b55430|',
        'signers'         => [
            [
                'name'     => 'JOSE SALAZAR',
                'email'    => 'jose.ku.salazar@uqroo.edu.mx',
                'numberId' => 'KUSL940606HQRXLS02',
            ],
        ],
        'viewers'         => [
            [
                'name'  => 'LUIS SALAZAR',
                'email' => 'jose.ku.salazar@outlook.com',
            ],
        ],
    ];
    $created = $firmaClient->createDocument($token, $docPayload);
    if (! $created || empty($created['folio'])) {
        echo "Error al crear documento";
        return;
    }

    // Extraemos id y folio
    $docId = $created['id'];
    $folio = $created['folio'];
    echo "Documento creado (ID: {$docId}, Folio: {$folio})\n";


    // 4) Obtener documento POR FOLIO (no por id)
    $doc = $firmaClient->getDocumentByFolio($token, $created['folio']);
    if (! $doc) {
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