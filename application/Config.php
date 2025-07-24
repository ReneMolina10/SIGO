<?php

// Definición de la base de datos: Uso de variables de entorno
$db['local']['HOST'] = getenv('DB_HOST') ?: '172.16.2.195'; //prueba: 172.16.2.198
$db['local']['MANAGER'] = getenv('DB_MANAGER') ?: 'oracle';
$db['local']['USER'] = getenv('DB_USER') ?: 'SIGO';
$db['local']['PASS'] = getenv('DB_PASS') ?: 'sg2025u'; //prueba: SRHP_25#i
$db['local']['NAME'] = getenv('DB_NAME') ?: 'uqro';
$db['local']['CHAR'] = getenv('DB_CHAR') ?: 'utf8';



define('DB', $db);

// Seguridad: Prefijo de tablas y claves de hash
define('PREFIJO_TABLAS', ''); // Prefijo para todas las tablas
define('HASH_KEY', '4f6a6d832be79'); // Llave para el hashing de datos sensibles

// Información del sitio web
define('APP_NAME', 'Sistema Institucional de Gestión de Oficios');
define('APP_NAME_SHORT', 'SIGO');
define('APP_SLOGAN', 'slogan');
define('APP_COMPANY', 'www.DevelCenter.com');
define('APP_VERSION', '2.0');

// Modo de depuración: Usar variables de entorno para activar/desactivar depuración
define('DEBUG', getenv('APP_DEBUG') ?: 0);

// Rutas base para archivos y URLs
define('BASE_FILE_SOL_SERV', '/opt/sitios/sau2/admin/files_adjunto');

// Rutas y configuraciones por defecto
define('DEFAULT_LAYOUT', 'lte2');
define('DEFAULT_FOLDER', '');

define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost/sigo/'); // URL base del sitio web
//define('BASE_URL', getenv('BASE_URL') ?: 'https://sigo.uqroo.mx/'); // URL base del sitio web
define('BASE_URL_VIEW', BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/'); // URL del HTML template

// Ruta para archivos locales
define('BASE_FILE', DS . 'opt' . DS . 'sitios' . DS . 'sau2' . DS);

// Controlador predeterminado
define('DEFAULT_CONTROLLER', 'index');

// Configuración de sesiones
define('BASE_SESION', '_' . APP_NAME_SHORT); // Palabra reservada para las sesiones
define('SESSION_TIME', 100); // Tiempo de expiración de la sesión

// Rutas de archivos específicos
define('RUTA_IMG_PERFIL', BASE_FILE . 'files' . DS . 'img' . DS . 'perfil' . DS);
define('RUTA_ARCHIVOS_SOLICITUD', BASE_FILE . 'files' . DS . 'solicitudes' . DS);

// Definir DEV_MODE basándose en la variable de entorno
//define('DEV_MODE', getenv('DEV_MODE') ?: false);
?>