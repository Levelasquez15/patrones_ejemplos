<?php
// 1. Clase Singleton
class Logger {
    private static ?Logger $instancia = null;
    private array $logs = [];

    // Constructor privado
    private function __construct() {}

    public static function getInstance(): Logger {
        if (self::$instancia === null) {
            self::$instancia = new Logger();
        }
        return self::$instancia;
    }

    public function log(string $mensaje) {
        $this->logs[] = $mensaje;
        echo "Log registrado: $mensaje\n";
    }

    public function mostrarLogs() {
        echo "Historial de Logs:\n";
        foreach ($this->logs as $log) {
            echo "- $log\n";
        }
    }
}

// 2. Cliente interactivo
$logger = Logger::getInstance();

while (true) {
    echo "\n--- Logger Interactivo ---\n";
    echo "1. Registrar log\n";
    echo "2. Mostrar historial\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            echo "Escriba el mensaje del log: ";
            $mensaje = trim(fgets(STDIN));
            $logger->log($mensaje);
            break;
        case "2":
            $logger->mostrarLogs();
            break;
        case "0":
            echo "Saliendo...\n";
            exit;
        default:
            echo "Opción no válida\n";
            break;
    }
}
