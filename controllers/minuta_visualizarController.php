<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class minuta_visualizarController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // No inicialices $this->view aquí
    }

    public function index()
    {
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if ($id) {
                $this->_view->id = $id;
                $this->_view->pdf_url = BASE_URL . "minutas/exec/previsualizarPDF/" . urlencode($id);
                extract(get_object_vars($this->_view));
                $this->_view->renderizar('minuta_visualizar');
            } else {
                echo "ID no recibido.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}