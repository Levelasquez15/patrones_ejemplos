<?php

// 1. Sujeto (Subject)
interface Sujeto {
    public function agregarObservador(Observador $observador);
    public function eliminarObservador(Observador $observador);
    public function notificar(string $mensaje);
}

// 2. Observador (Observer)
interface Observador {
    public function actualizar(string $mensaje);
}

// 3. Sujeto concreto
class CanalYouTube implements Sujeto {
    private array $observadores = [];

    public function agregarObservador(Observador $observador) {
        $this->observadores[] = $observador;
    }

    public function eliminarObservador(Observador $observador) {
        $this->observadores = array_filter(
            $this->observadores,
            fn($obs) => $obs !== $observador
        );
    }

    public function notificar(string $mensaje) {
        foreach ($this->observadores as $obs) {
            $obs->actualizar($mensaje);
        }
    }

    // Acción del canal
    public function subirVideo(string $titulo) {
        echo "El canal subió un nuevo video: $titulo\n";
        $this->notificar("Nuevo video disponible: $titulo");
    }
}

// 4. Observadores concretos
class Usuario implements Observador {
    private string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function actualizar(string $mensaje) {
        echo "{$this->nombre} recibió notificación: $mensaje\n";
    }
}

// 5. Cliente interactivo
$canal = new CanalYouTube();

echo "Ingrese nombre del primer usuario: ";
$nombre1 = trim(fgets(STDIN));
$usuario1 = new Usuario($nombre1);
$canal->agregarObservador($usuario1);

echo "Ingrese nombre del segundo usuario: ";
$nombre2 = trim(fgets(STDIN));
$usuario2 = new Usuario($nombre2);
$canal->agregarObservador($usuario2);

// Loop interactivo para subir videos
while (true) {
    echo "\nEscriba el título del nuevo video (o 'salir' para terminar): ";
    $titulo = trim(fgets(STDIN));

    if (strtolower($titulo) === "salir") {
        echo "Saliendo...\n";
        break;
    }

    $canal->subirVideo($titulo);
}
