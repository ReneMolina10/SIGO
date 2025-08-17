<?php

class firmadosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_nom = $this->loadModel('firmados');


    }

    public function index()
    {

    }

    public function minutas_firmadas()
    {

        $minutasFirmadas = $this->_nom->minutasfirmadas();


        $this->_view->assign('minutas', $minutasFirmadas);
        $this->_view->renderizar('documentos_firmados');
    }

    public function firmantes_pendientes_ajax($id_minuta)
    {
        if (!$id_minuta) {
            echo json_encode([]);
            return;
        }

        $id_minuta = (int) $id_minuta;
        $firmantes = $this->_nom->getFirmantesPendientes($id_minuta);
        header('Content-Type: application/json');
        echo json_encode($firmantes);
    }
}

?>