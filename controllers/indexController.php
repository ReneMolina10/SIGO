<?php

class indexController extends Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->forzarLogin();
    $this->_index = $this->loadModel('index');


  }

  public function index()
  {
    //echo "<a href='http://img.uqroo.mx/personal/personas/'>VER CATALOGO DE PERSONAS</a>";
    $this->_view->assign('titulobarra', ' ');
    $this->_view->assign('home', 'Ok');




    $this->_view->renderizar('index', true);
  }

  public function a()
  {

    $res = $this->_index->getUresEmpl();


    foreach ($res as $key => $fila) {
      $this->_index->putUresEmpl($fila["EMPL"], $fila["URES_SAIES"]);
    }



  }

}





?>