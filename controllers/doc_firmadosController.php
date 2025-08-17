<?php

class doc_firmadosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_nom = $this->loadModel('doc_firmados');
    }

    public function index()
    {
        $documentosFirmados = $this->_nom->getDocumentosFirmadosUsuario();

        // Parsear TIPO / ORIGEN
        foreach ($documentosFirmados as &$doc) {
            $doc['TIPO'] = '';
            $doc['ORIGEN'] = '';
            if (!empty($doc['TDOC_ID_EXTERNO'])) {
                $parts = explode('|', $doc['TDOC_ID_EXTERNO']);
                $doc['TIPO'] = $parts[0] ?? '';
                $doc['ORIGEN'] = $parts[1] ?? '';
            }
        }
        unset($doc);

        // Pre-cargar firmantes para todos los documentos (sin AJAX)
        $ids = array_column($documentosFirmados, 'TDOC_DOCUMENTO');
        $firmantesRows = $this->_nom->getFirmantesDeDocumentos($ids);
        $firmantesMap = [];
        foreach ($firmantesRows as $f) {
            $firmantesMap[$f['TDFI_DOCUMENTO']][] = $f;
        }

        $this->_view->assign('documentos', $documentosFirmados);
        $this->_view->assign('firmantesDocs', $firmantesMap);
        $this->_view->renderizar('index_firmados');
    }

   
}

?>