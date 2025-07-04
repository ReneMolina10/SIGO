<?php

class Session
{
    /**
     * Iniciar la sesión si aún no ha sido iniciada.
     */
    public static function init()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Destruir una o varias variables de sesión, o toda la sesión.
     * 
     * @param mixed $clave Puede ser una cadena con la clave o un array de claves.
     */
    public static function destroy($clave = false)
    {
        if ($clave) {
            if (is_array($clave)) {
                foreach ($clave as $key) {
                    if (isset($_SESSION[$key])) {
                        unset($_SESSION[$key]);
                    }
                }
            } elseif (isset($_SESSION[$clave])) {
                unset($_SESSION[$clave]);
            }
        } else {
            session_destroy();
        }
    }

    /**
     * Establecer una variable de sesión.
     * 
     * @param string $clave La clave de la sesión.
     * @param mixed $valor El valor a almacenar.
     */
    public static function set($clave, $valor)
    {
        if (!empty($clave)) {
            $_SESSION[$clave] = $valor;
        }
    }

    /**
     * Obtener una variable de sesión.
     * 
     * @param string $clave La clave de la sesión.
     * @return mixed El valor almacenado o null si no existe.
     */
    public static function get($clave)
    {
        return $_SESSION[$clave] ?? null;
    }

    /**
     * Verificar acceso según el nivel de usuario.
     * 
     * @param string $level Nivel requerido para acceso.
     */
    public static function acceso($level)
    {
        if (!self::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
        self::tiempo();

        if (self::getLevel($level) > self::getLevel(self::get('level'))) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }
    }

    /**
     * Verificar si el usuario tiene permiso para acceder a una vista.
     * 
     * @param string $level Nivel requerido para la vista.
     * @return bool True si el usuario tiene permiso, false si no.
     */
    public static function accesoView($level)
    {
        if (!self::get('autenticado')) {
            return false;
        }

        if (self::getLevel($level) > self::getLevel(self::get('level'))) {
            return false;
        }

        return true;
    }

    /**
     * Obtener el nivel de un usuario según su rol.
     * 
     * @param string $level Nombre del rol.
     * @return int Nivel del rol.
     * @throws InvalidArgumentException Si el rol no existe.
     */
    public static function getLevel($level)
    {
        $roles = [
            'admin' => 3,
            'especial' => 2,
            'usuario' => 1
        ];

        if (!array_key_exists($level, $roles)) {
            throw new InvalidArgumentException('Error de acceso: nivel no válido.');
        }

        return $roles[$level];
    }

    /**
     * Verificar acceso estricto según varios niveles de usuario.
     * 
     * @param array $level Array de niveles permitidos.
     * @param bool $noAdmin Si es true, se excluye al admin del acceso automático.
     */
    public static function accesoEstricto(array $level, $noAdmin = false)
    {
        if (!self::get('autenticado')) {
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

        self::tiempo();

        if (!$noAdmin && self::get('level') == 'admin') {
            return;
        }

        if (count($level) && in_array(self::get('level'), $level)) {
            return;
        }

        header('location:' . BASE_URL . 'error/access/5050');
        exit;
    }

    /**
     * Verificar acceso a vistas con verificación estricta.
     * 
     * @param array $level Array de niveles permitidos.
     * @param bool $noAdmin Si es true, se excluye al admin del acceso automático.
     * @return bool True si el usuario tiene acceso, false si no.
     */
    public static function accesoViewEstricto(array $level, $noAdmin = false)
    {
        if (!self::get('autenticado')) {
            return false;
        }

        if (!$noAdmin && self::get('level') == 'admin') {
            return true;
        }

        return in_array(self::get('level'), $level);
    }

    /**
     * Verificar y actualizar el tiempo de sesión.
     * 
     * @throws Exception Si el tiempo de sesión no está definido.
     */
    public static function tiempo()
    {
        if (!defined('SESSION_TIME')) {
            throw new Exception('No se ha definido el tiempo de sesión.');
        }

        if (SESSION_TIME == 0) {
            return;
        }

        // Manejador de tiempo de sesión (comentado originalmente)
        /*
        if (time() - self::get('tiempo') > (SESSION_TIME * 60)) {
            self::destroy();
            header('location:' . BASE_URL . 'error/access/8080');
            exit;
        } else {
            self::set('tiempo', time());
        }
        */
    }
}

?>
