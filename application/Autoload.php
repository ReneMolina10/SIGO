<?php

function autoloadCore($class)
{
    if (file_exists(APP_PATH . ucfirst(strtolower($class)) . '.php')) {
        //echo APP_PATH . ucfirst(strtolower($class)) . '.php | ';
        include_once APP_PATH . ucfirst(strtolower($class)) . '.php';

        //echo APP_PATH . ucfirst(strtolower($class)) . '.php <br/>';
    }
}

function autoloadLibs($class)
{
    if (file_exists(ROOT . 'libs' . DS . 'class.' . strtolower($class) . '.php')) {
        include_once ROOT . 'libs' . DS . 'class.' . strtolower($class) . '.php';
    }
}

spl_autoload_register("autoloadCore");
spl_autoload_register("autoloadLibs");



?>


<?php
/*
function autoload($class)
{
    // Definir rutas posibles para la carga de clases
    $paths = [
        APP_PATH . ucfirst(strtolower($class)) . '.php',                 // Carga del núcleo (Core)
        ROOT . 'libs' . DS . 'class.' . strtolower($class) . '.php'      // Carga de librerías (Libs)
    ];

    // Intentar cargar la clase desde las rutas especificadas
    foreach ($paths as $path) {
        if (file_exists($path)) {
            include_once $path;
            return;
        }
    }

    // Si está en modo desarrollador, mostrar advertencia cuando la clase no se puede cargar
    if (defined('DEV_MODE') && DEV_MODE) {
        echo "<strong>Advertencia:</strong> No se pudo cargar la clase: " . htmlspecialchars($class) . "<br/>";
    }
}

// Registrar la función de autoload
spl_autoload_register('autoload');
*/
?>
