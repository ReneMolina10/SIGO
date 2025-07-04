<?php
class Database extends PDO
{
    public $manager = "mysql";

    public function __construct($host, $dbname, $user, $pass, $char)
    {
        try {
            // Construir el DSN para MySQL
            $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=' . $char;

            // Llamar al constructor padre para inicializar la conexión PDO
            parent::__construct($dsn, $user, $pass);

            // Configurar atributos para un manejo seguro de la base de datos
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Lanza excepciones para errores de conexión
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Desactivar la emulación de declaraciones preparadas
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES ' . $char); // Establecer el juego de caracteres

        } catch (PDOException $e) {
            // Registrar el error en lugar de imprimir en la pantalla
            error_log("Error de conexión a la base de datos: " . $e->getMessage(), 0);
            throw new Exception("¡Error al conectar a la base de datos! Por favor contacte al administrador.");
        }
    }
}

?>

