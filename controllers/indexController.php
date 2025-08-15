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



    // Obtener el correo del usuario logueado
    $correoUsuario = '';
    if (!empty($_SESSION['infousr']['email'])) {
      $correoUsuario = $_SESSION['infousr']['email'];
    } elseif (!empty($_SESSION['getOffice']['nickname'])) {
      $correoUsuario = $_SESSION['getOffice']['nickname'];
    }

    // Obtener los documentos pendientes como ya lo haces
    $minutasPendientes = $this->_index->getMinutasporFirmar();
    $documentosPropiosPendientes = $this->_index->getFirmantesConDocumentosPendientes();
    $minutasSRH = $this->_index->getdocumentosMinutaSRH();

    // Combinar y filtrar por correo del firmante
    $documentosPendientes = array_merge(
      array_filter(array_map(function ($minuta) use ($correoUsuario) {
        if (isset($minuta['FIR_CORREO']) && strtolower($minuta['FIR_CORREO']) === strtolower($correoUsuario)) {
          return [
            'base_url' => BASE_URL . 'viewminuta/previsualizarPDF/' . $minuta['HASH_MINUTA'],
            'denominacion' => $minuta['MIN_PROCESO'],
            'folio' => $minuta['MIN_FOLIO'],
            'tipo' => $minuta['TIPO_DOCUMENTO'],
            'hash' => $minuta['HASH_MINUTA'],
            'url_firma' => "https://efirma.uqroo.mx/?document={$minuta['FOLIO_DOC']}&signer={$minuta['FIR_ID_SEGUIMIENTO']}",
            'url_verify' => "https://efirma.uqroo.mx/verify/{$minuta['FOLIO_DOC']}"
          ];
        }
        return null;
      }, $minutasPendientes)),
      array_filter(array_map(function ($doc) use ($correoUsuario) {
        if (isset($doc['DP_CORREO']) && strtolower($doc['DP_CORREO']) === strtolower($correoUsuario)) {
          return [
            'base_url' => BASE_URL . 'viewdocpropio/previsualizarPDF/' . $doc['HASH_DOC'],
            'denominacion' => $doc['DP_DENOMINACION'],
            'folio' => $doc['DP_FOLIO'],
            'tipo' => $doc['DP_TIPO_DOCUMENTO'],
            'hash' => $doc['HASH_DOC'],
            'url_firma' => "https://efirma.uqroo.mx/?document={$doc['DP_FOLIO_DOC']}&signer={$doc['DP_ID_SEGUIMIENTO']}",
            'url_verify' => "https://efirma.uqroo.mx/verify/{$doc['DP_FOLIO_DOC']}"
          ];
        }
        return null;
      }, $documentosPropiosPendientes)),
      array_filter(array_map(function ($minuta) use ($correoUsuario) {
        if (isset($minuta['FIR_CORREO']) && strtolower($minuta['FIR_CORREO']) === strtolower($correoUsuario)) {
          return [
            'base_url' => 'https://gesco.uqroo.mx/viewminuta/previsualizarPDF/' . $minuta['HASH_MINUTA'],
            'denominacion' => $minuta['MIN_PROCESO'],
            'folio' => $minuta['MIN_FOLIO'],
            'tipo' => $minuta['TIPO_DOC_MINUTA'],
            'hash' => $minuta['HASH_MINUTA'],
            'url_firma' => "https://efirma.uqroo.mx/?document={$minuta['FOLIO_DOC']}&signer={$minuta['FIR_ID_SEGUIMIENTO']}",
            'url_verify' => "https://efirma.uqroo.mx/verify/{$minuta['FOLIO_DOC']}"
          ];
        }
        return null;
      }, $minutasSRH))
    );

    // Limpiar nulos (por el filter)
    $documentosPendientes = array_values(array_filter($documentosPendientes));

    $this->_view->assign('documentosPendientes', $documentosPendientes);
    $this->_view->renderizar('index', true);
  }


}

