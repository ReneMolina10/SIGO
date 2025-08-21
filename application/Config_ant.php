<?php
// ^ - - - - DATA BASES - - - -
/*
$db['local']['HOST'] = '172.16.2.198'; // ^ <-- LOCAL
$db['local']['MANAGER'] = 'oracle';
$db['local']['USER'] = 'sisrh';
$db['local']['PASS'] = 'sisrhpruebas';
$db['local']['NAME'] = 'bitly';
$db['local']['CHAR'] = 'utf8';
*/

// Definición de la base de datos: Uso de variables de entorno
$db['local']['HOST']    = getenv('DB_HOST') ?: '172.16.2.198';
$db['local']['MANAGER'] = getenv('DB_MANAGER') ?: 'oracle';
$db['local']['USER']    = getenv('DB_USER') ?: 'SISRH';
$db['local']['PASS']    = getenv('DB_PASS') ?: 'SRHP_25#i';
$db['local']['NAME']    = getenv('DB_NAME') ?: 'uqro';
$db['local']['CHAR']    = getenv('DB_CHAR') ?: 'utf8';





define('DB', $db);

// Seguridad: Prefijo de tablas y claves de hash
define('PREFIJO_TABLAS', 'CNT_'); // Prefijo para todas las tablas
define('HASH_KEY', '4f6a6d832be79'); // Llave para el hashing de datos sensibles

// Información del sitio web
define('APP_NAME', 'Sistema_X');
define('APP_NAME_SHORT', 'SAU');
define('APP_SLOGAN', 'slogan');
define('APP_COMPANY', 'www.DevelCenter.com');
define('APP_VERSION', '2.0');

// Modo de depuración: Usar variables de entorno para activar/desactivar depuración
define('DEBUG', getenv('APP_DEBUG') ?: 0);

// Rutas base para archivos y URLs
define('BASE_FILE_SOL_SERV', '/opt/sitios/gesco/admin/files_adjunto');

// Rutas y configuraciones por defecto
define('DEFAULT_LAYOUT', 'lte2');
//define('DEFAULT_FOLDER', 'contratos2');
define('BASE_URL', getenv('BASE_URL') ?: 'https://gesco.uqroo.mx/' ); // URL base del sitio web
define('BASE_URL_VIEW', BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/'); // URL del HTML template

// Ruta para archivos locales
define('BASE_FILE', DS . 'opt' . DS . 'sitios' . DS . 'gesco' . DS); 

// Controlador predeterminado
define('DEFAULT_CONTROLLER', 'index');

// Configuración de sesiones
define('BASE_SESION', '_' . APP_NAME); // Palabra reservada para las sesiones
define('SESSION_TIME', 100); // Tiempo de expiración de la sesión

// Rutas de archivos específicos
define('RUTA_IMG_PERFIL', BASE_FILE . 'files' . DS . 'img' . DS . 'perfil' . DS);
define('RUTA_ARCHIVOS_SOLICITUD', BASE_FILE . 'files' . DS . 'solicitudes' . DS);

// Definir DEV_MODE basándose en la variable de entorno
//define('DEV_MODE', getenv('DEV_MODE') ?: false);
?>