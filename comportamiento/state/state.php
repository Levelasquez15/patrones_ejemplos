<?php

// 1. Estado (interface)
interface Estado {
    public function manejar();
}

// 2. Estados concretos
class EstadoRojo implements Estado {
    public function manejar() {
        echo "Semáforo en ROJO: Detente\n";
    }
}

class EstadoAmarillo implements Estado {
    public function manejar() {
        echo "Semáforo en AMARILLO: Precaución\n";
    }
}

class EstadoVerde implements Estado {
    public function manejar() {
        echo "Semáforo en VERDE: Avanza\n";
    }
}

// 3. Contexto
class Semaforo {
    private Estado $estado;

    public function __construct(Estado $estadoInicial) {
        $this->estado = $estadoInicial;
    }

    public function setEstado(Estado $estado) {
        $this->estado = $estado;
    }

    public function mostrar() {
        $this->estado->manejar();
    }
}

// 4. Cliente interactivo
$semaforo = new Semaforo(new EstadoRojo());

while (true) {
    echo "\nSeleccione el estado del semáforo:\n";
    echo "1. Rojo\n";
    echo "2. Verde\n";
    echo "3. Amarillo\n";
    echo "4. Salir\n";
    echo "Opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "4") {
        echo "Saliendo...\n";
        break;
    }

    switch ($opcion) {
        case "1":
            $semaforo->setEstado(new EstadoRojo());
            break;
        case "2":
            $semaforo->setEstado(new EstadoVerde());
            break;
        case "3":
            $semaforo->setEstado(new EstadoAmarillo());
            break;
        default:
            echo "Opción inválida.\n";
            continue 2;
    }

    $semaforo->mostrar();
}
