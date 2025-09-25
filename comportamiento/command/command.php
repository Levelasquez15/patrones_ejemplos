<?php

// 1. Comando (Command)
interface Comando {
    public function ejecutar();
}

// 2. Receptor (Receiver)
class Luz {
    public function encender() {
        echo "La luz está ENCENDIDA\n";
    }

    public function apagar() {
        echo "La luz está APAGADA\n";
    }
}

// 3. Comandos concretos
class EncenderLuz implements Comando {
    private Luz $luz;

    public function __construct(Luz $luz) {
        $this->luz = $luz;
    }

    public function ejecutar() {
        $this->luz->encender();
    }
}

class ApagarLuz implements Comando {
    private Luz $luz;

    public function __construct(Luz $luz) {
        $this->luz = $luz;
    }

    public function ejecutar() {
        $this->luz->apagar();
    }
}

// 4. Invocador (Invoker)
class ControlRemoto {
    private ?Comando $comando = null;

    public function setComando(Comando $comando) {
        $this->comando = $comando;
    }

    public function presionarBoton() {
        if ($this->comando) {
            $this->comando->ejecutar();
        }
    }
}

// 5. Cliente interactivo
$luz = new Luz();
$encender = new EncenderLuz($luz);
$apagar = new ApagarLuz($luz);

$control = new ControlRemoto();

echo "=== Control Remoto de la Luz ===\n";

while (true) {
    echo "\nElige una acción:\n";
    echo "1. Encender la luz\n";
    echo "2. Apagar la luz\n";
    echo "3. Salir\n";
    echo "Opción: ";

    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            $control->setComando($encender);
            $control->presionarBoton();
            break;
        case "2":
            $control->setComando($apagar);
            $control->presionarBoton();
            break;
        case "3":
            echo "Saliendo...\n";
            exit;
        default:
            echo "Opción no válida. Intenta de nuevo.\n";
    }
}
