<?php

class indexController extends Controller
{
  private $_index;

  public function __construct()
  {
    parent::__construct();
    $this->forzarLogin();
    $this->_index = $this->loadModel('index');
  }

  public function session()
  {

    $_SESSION["_FederatedPrincipal_"] = "";

    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

  }

  public function refresh_session()
  {

    session_start();

  }

  public function index()
  {
    // Obtener minutas pendientes con firmantes
    $minutasPendientes = $this->_index->getMinutasporFirmar();

    // Obtener documentos propios pendientes con firmantes
    $documentosPropiosPendientes = $this->_index->getFirmantesConDocumentosPendientes();

    // Combinar ambos arreglos
    $documentosPendientes = array_merge(
        array_map(function ($minuta) {
            return [
                'origen' => 'Minuta',
                'denominacion' => $minuta['MIN_PROCESO'],
                'folio' => $minuta['MIN_FOLIO'],
                'tipo' => $minuta['TIPO_DOCUMENTO'],
                'hash' => $minuta['HASH_MINUTA'],
                'url_firma' => "https://efirma.uqroo.mx/?document={$minuta['FOLIO_DOC']}&signer={$minuta['FIR_ID_SEGUIMIENTO']}",
                'url_verify' => "https://efirma.uqroo.mx/verify/{$minuta['FOLIO_DOC']}"
            ];
        }, $minutasPendientes),
        array_map(function ($doc) {
            return [
                'origen' => 'Documento Propio',
                'denominacion' => $doc['DP_DENOMINACION'],
                'folio' => $doc['DP_FOLIO'],
                'tipo' => $doc['DP_TIPO_DOCUMENTO'],
                'hash' => $doc['HASH_DOC'],
                'url_firma' => "https://efirma.uqroo.mx/?document={$doc['DP_FOLIO_DOC']}&signer={$doc['DP_ID_SEGUIMIENTO']}",
                'url_verify' => "https://efirma.uqroo.mx/verify/{$doc['DP_FOLIO_DOC']}"
            ];
        }, $documentosPropiosPendientes)
    );

    // Pasar los documentos combinados a la vista
    $this->_view->assign('documentosPendientes', $documentosPendientes);

    $this->_view->renderizar('index', true);
  }


}

