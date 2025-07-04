<?php

class Bootstrap
{
    public static function run(Request $peticion)
    {
        try {
            $modulo = $peticion->getModulo();
            $controllerName = $peticion->getControlador() . 'Controller';
            $generator = $peticion->getControlador();
            $methodName = $peticion->getMetodo() ?? 'index';
            $args = $peticion->getArgs();

            // Determinar la ruta del controlador
            if ($modulo) {
                $rutaModulo = ROOT . 'controllers' . DS . $modulo . 'Controller.php';
                if (is_readable($rutaModulo)) {
                    require_once $rutaModulo;
                    $rutaControlador = ROOT . 'modules' . DS . $modulo . DS . 'controllers' . DS . $controllerName . '.php';
                } else {
                    throw new Exception('Error: No se pudo encontrar el módulo base: ' . $modulo);
                }
            } else {
                $rutaControlador = ROOT . 'controllers' . DS . $controllerName . '.php';
            }

            // Si la ruta del controlador es válida, cargar el controlador
            if (is_readable($rutaControlador)) {
                require_once $rutaControlador;

                if (class_exists($controllerName)) {
                    $controller = new $controllerName;

                    if (!is_callable([$controller, $methodName])) {
                        $methodName = 'index';
                    }

                    if (!empty($args)) {
                        call_user_func_array([$controller, $methodName], $args);
                    } else {
                        call_user_func([$controller, $methodName]);
                    }
                } else {
                    throw new Exception("Error: La clase del controlador {$controllerName} no existe.");
                }

            } else {
                // Manejar la situación cuando no se encuentra el controlador
                $btnsTabla = null;
                $btnsBarra = null;
                $claseI = null;
                $reports = null;
                $codigoJS = null;
                $template = null;
                $graficas = null;

                $rutaGenerador = ROOT . 'generators' . DS . $generator . 'Generator.php';
                if (is_readable($rutaGenerador)) {

                    require_once $rutaGenerador;
                    $rutaControlador = ROOT . 'controllers' . DS . 'generatorController.php';
                    if (is_readable($rutaControlador)) {
                        require_once $rutaControlador;

                        // Código para el generador de módulos "Generator"
                        $peticion->setControlador('generators');

                        if (isset($class)) {
                            $claseI = new $class;
                        }

                        // No se puede modificar esta línea
                        $controller = new generatorController($generator, $bd, $tablas, $form, $btnsTabla, $btnsBarra, $claseI, $reports, $codigoJS, $template, $graficas);

                        if (!is_callable([$controller, $methodName])) {
                            $methodName = 'index';
                        }

                        if (!empty($args)) {
                            call_user_func_array([$controller, $methodName], $args);
                        } else {
                            call_user_func([$controller, $methodName]);
                        }

                    } else {
                        throw new Exception('Error: No se encontró el archivo generatorController.php');
                    }
                } else {
                    include("./public/files/404.php");
                    if (isset($page404)) {
                        echo $page404;
                    } else {
                        echo 'Error 404: Página no encontrada.';
                    }
                }
            }
        } catch (Exception $e) {
            if (defined('DEV_MODE') && DEV_MODE) {
                echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br/>";
                echo "<pre>";
                print_r($e->getTrace());
                echo "</pre>";
            } else {
                include("./public/files/500.php");
            }
        }
    }
}

?>
