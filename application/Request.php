<?php

class Request
{
    private $_modulo;
    private $_controlador;
    private $_metodo;
    private $_argumentos = [];
    private $_modules;

    public function __construct()
    {
        if (isset($_GET['url'])) {

            // Almacenar la URL solicitada en la sesión si corresponde a ciertas rutas
            if (strpos($_GET['url'], "solicitudes") !== false || strpos($_GET['url'], "califica/calificar/") !== false) {
                $_SESSION["url_solicita"] = $_GET['url'];
            }

            // Sanitizar la URL
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url, 'strlen');

            // Definir los módulos permitidos
            $this->_modules = ['usuarios'];
            $this->_modulo = strtolower(array_shift($url));

            if ($this->_modulo && in_array($this->_modulo, $this->_modules)) {
                $this->_controlador = strtolower(array_shift($url)) ?: 'index';
            } else {
                $this->_controlador = $this->_modulo ?: DEFAULT_CONTROLLER;
                $this->_modulo = false;
            }

            $this->_metodo = strtolower(array_shift($url)) ?: 'index';
            $this->_argumentos = !empty($url) ? array_values($url) : [];
        } else {
            $this->_controlador = DEFAULT_CONTROLLER;
            $this->_metodo = 'index';
        }
    }

    /**
     * Obtener el módulo.
     * 
     * @return string|false El módulo si está definido, false si no.
     */
    public function getModulo()
    {
        return $this->_modulo;
    }

    /**
     * Obtener el controlador.
     * 
     * @return string El nombre del controlador.
     */
    public function getControlador()
    {
        return $this->_controlador;
    }

    /**
     * Establecer el controlador.
     * 
     * @param string $controlador El nombre del controlador.
     */
    public function setControlador($controlador)
    {
        $this->_controlador = $controlador;
    }

    /**
     * Obtener el método.
     * 
     * @return string El nombre del método.
     */
    public function getMetodo()
    {
        return $this->_metodo;
    }

    /**
     * Obtener los argumentos.
     * 
     * @return array Los argumentos proporcionados.
     */
    public function getArgs()
    {
        return $this->_argumentos;
    }
}

?>
