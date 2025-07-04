<?php
// Definición de la base de datos: Uso de variables de entorno
$db['local']['HOST']    = getenv('DB_HOST') ?: 'localhost';
$db['local']['MANAGER'] = getenv('DB_MANAGER') ?: 'mysql';
$db['local']['USER']    = getenv('DB_USER') ?: 'root';
$db['local']['PASS']    = getenv('DB_PASS') ?: 'r00tr00t';
$db['local']['NAME']    = getenv('DB_NAME') ?: 'bitly';
$db['local']['CHAR']    = getenv('DB_CHAR') ?: 'utf8';


define('DEFAULT_FOLDER', 'bitly2024');
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/' . DEFAULT_FOLDER . '/'); // URL base del sitio web



define('DB', $db);

// Seguridad: Prefijo de tablas y claves de hash
define('PREFIJO_TABLAS', 'CNT_'); // Prefijo para todas las tablas
define('HASH_KEY', '4f6a6d832be79'); // Llave para el hashing de datos sensibles

// Información del sistema
define('APP_NAME', 'Sistema de Prueba');
define('APP_NAME_SHORT', 'TEST');
define('APP_SLOGAN', 'slogan');
define('APP_COMPANY', 'www.DevelCenter.com');
define('APP_VERSION', '2.0');

// Modo de depuración: Usar variables de entorno para activar/desactivar depuración
define('DEBUG', getenv('APP_DEBUG') ?: 0);


// Rutas y configuraciones por defecto
define('DEFAULT_LAYOUT', 'lte2');
define('BASE_URL_VIEW', BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/'); // URL del HTML template



// Controlador predeterminado
define('DEFAULT_CONTROLLER', 'index');

// Configuración de sesiones
define('BASE_SESION', '_' . APP_NAME); // Palabra reservada para las sesiones
define('SESSION_TIME', 100); // Tiempo de expiración de la sesión



// Definir DEV_MODE basándose en la variable de entorno
//define('DEV_MODE', getenv('DEV_MODE') ?: false);
?>