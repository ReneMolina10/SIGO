<?php
// Activar modo desarrollador ( usar una variable de entorno en lugar de esto)
define('DEV_MODE', false); // Cambiar a `false` en producción
// Configuración de errores según el modo
if (DEV_MODE) {
    // opcache_reset();
    ini_set("display_errors", 1);
    //error_reporting(E_ALL & ~E_DEPRECATED); // Todos los errores excepto deprecados
    //error_reporting(E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
} else {
    ini_set("display_errors", 0);
    error_reporting(0);
}


set_time_limit(920);
ini_set('memory_limit', '5120M');

// Definiciones de constantes
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);



try {

    // Inclusión de archivos principales
    require_once APP_PATH . 'Autoload.php';
    require_once APP_PATH . 'Config.php';



    // Inicialización de sesión
    Session::init();

    // Registro de instancias globales
    $registry = Registry::getInstancia();
    $registry->_request = new Request();

    // Configuración de bases de datos (multi-BD)
    foreach (DB as $key => $dbConfig) {
        $registry->_db[$key] = ($dbConfig['MANAGER'] === "oracle")
            ? new Databaseoci($dbConfig['HOST'], $dbConfig['NAME'], $dbConfig['USER'], $dbConfig['PASS'], $dbConfig['CHAR'])
            : new Database($dbConfig['HOST'], $dbConfig['NAME'], $dbConfig['USER'], $dbConfig['PASS'], $dbConfig['CHAR']);
    }

    // Inicialización del control de acceso
    $registry->_acl = new ACL();

    // Ejecución del flujo principal
    Bootstrap::run($registry->_request);

    // Liberar recursos al finalizar
    $registry->_db = null;

} catch (Exception $e) {
    // Manejo de excepciones global
    if (DEV_MODE) {
        echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br/>";
        echo "<pre>";
        print_r($e->getTrace());
        echo "</pre>";
    } else {
        echo "Ha ocurrido un error. Por favor, contacte al administrador.";
    }
}
?>