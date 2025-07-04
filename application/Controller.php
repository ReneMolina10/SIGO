<?php

abstract class Controller
{
    private $_registry;
    protected $_view;
    protected $_acl;
    protected $_request;

    public function __construct()
    {
        $this->_registry = Registry::getInstancia();
        $this->_acl = $this->_registry->_acl;
        $this->_request = $this->_registry->_request;
        $this->_view = new View($this->_request, $this->_acl);
        //print_r($_SESSION);
        $this->_view->assign('verpaginas', $this->_acl->accesov('seepages'));
        $this->_view->assign('vermenus', $this->_acl->accesov('seemenu'));
        $this->_view->assign('verarchivos', $this->_acl->accesov('accessfiles'));
        $this->_view->assign('verconfiguracion', $this->_acl->accesov('seeconfig'));
        $this->_view->assign('vergalerias', $this->_acl->accesov('seegaleria'));
        $this->_view->assign('verusuarios', $this->_acl->accesov('seeuser'));
        $this->_view->assign('verblog', $this->_acl->accesov('seeblog'));
    }

    abstract public function index();

    protected function loadModel($modelo, $modulo = false)
    {
        $modelo = $modelo . 'Model';
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
        if (!$modulo) {
            $modulo = $this->_request->getModulo();
        }

        if ($modulo && $modulo !== 'default') {
            $rutaModelo = ROOT . 'modules' . DS . $modulo . DS . 'models' . DS . $modelo . '.php';
        }

        if (is_readable($rutaModelo)) {
            require_once $rutaModelo;
            return new $modelo();
        } else {
            throw new Exception('Error de modelo: No se pudo encontrar el archivo del modelo ' . $modelo);
        }
    }

    protected function getLibrary($libreria)
    {
        $rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';

        if (is_readable($rutaLibreria)) {
            require_once $rutaLibreria;
        } else {
            throw new Exception('Error de librería: No se pudo encontrar ' . $libreria);
        }
    }

    protected function getTexto($clave)
    {
        return isset($_POST[$clave]) ? htmlspecialchars(trim($_POST[$clave]), ENT_QUOTES, 'UTF-8') : '';
    }

    protected function getInt($clave)
    {
        return isset($_POST[$clave]) ? (int)$_POST[$clave] : 0;
    }

    protected function redireccionar($ruta = false)
    {
        $url = BASE_URL . ($ruta ? $ruta : '');
        header('location:' . $url);
        exit;
    }

    protected function filtrarInt($int)
    {
        return filter_var($int, FILTER_VALIDATE_INT) ?: 0;
    }

    protected function getPostParam($clave)
    {
        return $_POST[$clave] ?? '';
    }

    protected function getSql($clave)
    {
        return isset($_POST[$clave]) ? strip_tags(trim($_POST[$clave])) : '';
    }

    protected function getAlphaNum($clave)
    {
        return isset($_POST[$clave]) ? preg_replace('/[^A-Z0-9_.@]/i', '', $_POST[$clave]) : '';
    }

    public function validarEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    protected function formatPermiso($clave)
    {
        return isset($_POST[$clave]) ? preg_replace('/[^A-Z_]/i', '', $_POST[$clave]) : '';
    }

    public function forzarLogin()
    {
        if (!Session::get('autenticado' . BASE_SESION)) {
            $this->redireccionar('usuarios/login');
        }
    }

    public function convierteOption($array, $id, $campo, $sel = "")
    {
        $cadena = "";
        foreach ($array as $fila) {
            $seleccionado = ($sel == $fila[$id]) ? 'selected="selected"' : '';
            $cadena .= '<option value="' . htmlspecialchars($fila[$id]) . '" ' . $seleccionado . '>' . htmlspecialchars($fila[$campo]) . "</option>";
        }
        return $cadena;
    }

    public function excell($datas, $titles = array(), $nombreFile = "")
    {
        set_time_limit(160);
        ini_set('memory_limit', '512M');

        $spreadsheet = (new exell())->getInstancia();
        $worksheet = $spreadsheet->getActiveSheet();

        $letter = 'A';
        if (empty($titles)) {
            foreach (array_keys($datas[0]) as $title) {
                $worksheet->setCellValue($letter . '1', $title);
                $worksheet->getColumnDimension($letter)->setAutoSize(true);
                $letter++;
            }
        } else {
            foreach ($titles as $value) {
                $worksheet->setCellValue($letter . '1', $value);
                $worksheet->getColumnDimension($letter)->setAutoSize(true);
                $letter++;
            }
        }

        $r = 2;
        foreach ($datas as $row) {
            $letter = 'A';
            foreach ($row as $value) {
                $worksheet->setCellValue($letter . $r, $value);
                $letter++;
            }
            $r++;
        }

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        ob_start();
        $writer->save('php://output');

        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=reporte_" . $nombreFile . "_" . date("Y-m-d_H-i-s") . ".xlsx");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
    }

    public function csv($datas, $titles = false, $filename = '')
    {
        ini_set('memory_limit', '13800M');
        $filename = "reporte_" . $filename . "_" . date("Y-m-d_H-i-s") . ".csv";

        $f = fopen('php://memory', 'w');
        if ($titles) {
            fputcsv($f, array_map('utf8_decode', array_values($titles)), ",");
        }

        foreach ($datas as $line) {
            fputcsv($f, array_map('utf8_decode', array_values($line)), ",");
        }

        fseek($f, 0);
        header("Content-Type: application/csv; charset=utf-8");
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fpassthru($f);

        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
    }

    public function limpiarTexto($texto)
    {
        $reemplazos = [
            "á" => "á", "é" => "é", "í" => "í", "ó" => "ó", "ú" => "ú",
            "ñ" => "ñ", "Á" => "Á", "É" => "É", "Í" => "Í", "Ó" => "Ó",
            "Ú" => "Ú", "ö" => "ö"
        ];
        return str_replace(array_keys($reemplazos), array_values($reemplazos), $texto);
    }

    public function refresh_session()
    {
        session_start();
    }
}

?>
