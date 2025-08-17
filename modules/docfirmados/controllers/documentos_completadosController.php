<?php

class documentos_completadosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_nom = $this->loadModel('documentos_completados');


    }

    public function index()
    {

        // Mostrar mensaje en la vista en lugar de usar echo directamente
        $this->view->mensaje = 'Hola, este es mi controller';
        $this->view->renderizar('documentos_completados/index_doc');
    }

}

?>