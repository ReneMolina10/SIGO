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
    $minutasPendientes = $this->_index->getMinutasporFirmar();
    $this->_view->assign('minutasPendientes', $minutasPendientes);
    $this->_view->renderizar('index', true);
  }


}

