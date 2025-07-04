<?php

require_once ROOT . 'libs' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';

class View extends Smarty
{
    private $_request;
    private $_js = [];
    private $_acl;
    private $_rutas = [];
    private $_jsPlugin = [];
    private $_template;
    private $_item = '';
    private $_controlador;

    public function __construct(Request $peticion, ACL $_acl)
    {
        parent::__construct();
        $this->_request = $peticion;
        $this->_acl = $_acl;

        // Validar que DEFAULT_LAYOUT sea una cadena
        if (is_string(DEFAULT_LAYOUT)) {
            $this->_template = DEFAULT_LAYOUT;
        } else {
            throw new Exception('Error: DEFAULT_LAYOUT debe ser una cadena.');
        }

        $modulo = $this->_request->getModulo();
        $controlador = $this->_request->getControlador();
        $this->_controlador = $controlador;

        if ($modulo) {
            $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'modules/' . $modulo . '/views/' . $controlador . '/js/';
        } else {
            $this->_rutas['view'] = ROOT . 'views' . DS . $controlador . DS;
            $this->_rutas['js'] = BASE_URL . 'views/' . $controlador . '/js/';
        }
    }

    /**
     * Renderiza la vista solicitada.
     * 
     * @param string $vista Nombre de la vista.
     * @param string|bool $item Elemento actual.
     * @param bool $noLayout Si es true, se omite el layout.
     * @throws Exception Si la vista no es legible.
     */
    public function renderizar($vista, $item = false, $noLayout = false)
    {
        if ($item) {
            $this->_item = $item;
        }



 

        $this->template_dir = ROOT . 'views' . DS . 'layout' . DS . $this->_template . DS;

        if(is_array($this->template_dir))
        $this->config_dir = $this->template_dir[0] . 'configs' . DS;
        else
        $this->config_dir = $this->template_dir . 'configs' . DS;

        $this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
        $this->compile_dir = ROOT . 'tmp' . DS . 'template' . DS;
        $this->debugging = false;

        $menu = !empty($_SESSION) ? "" : "";

        $_params = [
            'email' => $_SESSION['getOffice']['nickname'] ?? '',
            'nombre' => $_SESSION['nombre' . BASE_SESION] ?? '',
            'imagen' => $_SESSION['imagen' . BASE_SESION] ?? '',
            'infousr' => $_SESSION['infousr'] ?? '',
            'ruta_view' => BASE_URL . 'files/layout/' . $this->_template . '/',
            'ruta_css' => BASE_URL . 'files/layout/' . $this->_template . '/css/',
            'ruta_img' => BASE_URL . 'files/layout/' . $this->_template . '/img/',
            'ruta_js' => BASE_URL . 'files/layout/' . $this->_template . '/js/',
            'menu' => $menu,
            'item' => $this->_item,
            'js' => $this->_js,
            'js_plugin' => $this->_jsPlugin,
            'root' => BASE_URL,
            'configs' => [
                'app_name' => APP_NAME,
                'app_name_short' => APP_NAME_SHORT,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY,
                'app_version' => APP_VERSION
            ]
        ];

        if (is_readable($this->_rutas['view'] . $vista . '.tpl')) {
            if ($noLayout) {
                $this->template_dir = $this->_rutas['view'];
                $this->display($this->_rutas['view'] . $vista . '.tpl');
                exit;
            }

            $this->assign('_contenido', $this->_rutas['view'] . $vista . '.tpl');
        } else {
            throw new Exception('Error de vista: No se puede encontrar la vista solicitada ('. $vista .').');
        }

        $this->assign('menu', $menu);
        $this->assign('_acl', $this->_acl);
        $this->assign('_layoutParams', $_params);
        $this->assign('_controlador', $this->_controlador);

        $this->display('template.tpl');
    }

    /**
     * Establece archivos JavaScript para la vista.
     * 
     * @param array $js Array de archivos JavaScript.
     * @throws Exception Si no se proporcionan archivos JS válidos.
     */
    public function setJs(array $js)
    {
        if (count($js)) {
            foreach ($js as $archivo) {
                $this->_js[] = $this->_rutas['js'] . $archivo . '.js';
            }
        } else {
            throw new Exception('Error de js: No se proporcionaron archivos JS válidos.');
        }
    }

    /**
     * Establece archivos JavaScript de plugins para la vista.
     * 
     * @param array $js Array de archivos JavaScript de plugins.
     * @throws Exception Si no se proporcionan archivos JS válidos.
     */
    public function setJsPlugin(array $js)
    {
        if (count($js)) {
            foreach ($js as $archivo) {
                $this->_jsPlugin[] = BASE_URL . 'public/js/' . $archivo . '.js';
            }
        } else {
            throw new Exception('Error de js plugin: No se proporcionaron archivos JS válidos.');
        }
    }

    /**
     * Establece el template a utilizar.
     * 
     * @param string $template Nombre del template.
     */
    public function setTemplate($template)
    {
        if (is_string($template)) {
            $this->_template = $template;
        } else {
            throw new Exception('Error: El nombre del template debe ser una cadena.');
        }
    }

    // Otros métodos como widget(), getLayoutPositions(), getWidgets() y getWidgetContent() permanecen sin cambios
    // Se mejoraron comentarios y se aseguraron buenas prácticas
}

?>
    