<?php

class Registry
{
    private static $_instancia;
    private $_data = []; // Inicializar el array para evitar errores
    public $_db = []; // Para el manejo de múltiples bases de datos

    // El constructor es privado para evitar la creación de instancias directas
    private function __construct()
    {
    }

    /**
     * Obtener la instancia única de Registry (patrón Singleton)
     * 
     * @return Registry La instancia del registro.
     */
    public static function getInstancia()
    {
        if (self::$_instancia === null) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Establecer un valor en el registro.
     * 
     * @param string $name Nombre del valor a guardar.
     * @param mixed $value Valor a guardar.
     */
    public function __set($name, $value)
    {
        if (!empty($name) && $value !== null) {
            $this->_data[$name] = $value;
        } else {
            throw new InvalidArgumentException("El nombre o el valor no pueden estar vacíos");
        }
    }

    /**
     * Obtener un valor del registro.
     * 
     * @param string $name Nombre del valor a obtener.
     * @return mixed El valor almacenado o false si no existe.
     */
    public function __get($name)
    {
        return $this->_data[$name] ?? false;
    }

    /**
     * Verificar si un valor está registrado.
     * 
     * @param string $name Nombre del valor a verificar.
     * @return bool True si el valor está registrado, false de lo contrario.
     */
    public function existe($name)
    {
        return isset($this->_data[$name]);
    }
}

?>
