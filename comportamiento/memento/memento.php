<?php

// 1. Memento: guarda el estado
class Memento {
    private string $estado;

    public function __construct(string $estado) {
        $this->estado = $estado;
    }

    public function getEstado(): string {
        return $this->estado;
    }
}

// 2. Originador: crea y restaura estados
class Documento {
    private string $contenido = "";

    public function escribir(string $texto) {
        $this->contenido .= $texto . " ";
    }

    public function mostrar() {
        echo "Documento: " . $this->contenido . "\n";
    }

    public function guardar(): Memento {
        return new Memento($this->contenido);
    }

    public function restaurar(Memento $memento) {
        $this->contenido = $memento->getEstado();
    }
}

// 3. Caretaker: administra los mementos
class Historial {
    private array $estados = [];

    public function add(Memento $memento) {
        $this->estados[] = $memento;
    }

    public function get(int $index): ?Memento {
        return $this->estados[$index] ?? null;
    }

    public function mostrarHistorial() {
        foreach ($this->estados as $i => $memento) {
            echo "[$i] " . $memento->getEstado() . "\n";
        }
    }
}

// 4. Cliente interactivo
$doc = new Documento();
$historial = new Historial();

while (true) {
    echo "\nOpciones: (1) Escribir (2) Guardar (3) Mostrar (4) Historial (5) Restaurar (0) Salir\n";
    echo "Elige una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            echo "Escribe el texto: ";
            $texto = trim(fgets(STDIN));
            $doc->escribir($texto);
            break;
        case "2":
            $historial->add($doc->guardar());
            echo "Estado guardado.\n";
            break;
        case "3":
            $doc->mostrar();
            break;
        case "4":
            echo "Historial de estados:\n";
            $historial->mostrarHistorial();
            break;
        case "5":
            echo "Número de estado a restaurar: ";
            $index = (int) trim(fgets(STDIN));
            $memento = $historial->get($index);
            if ($memento) {
                $doc->restaurar($memento);
                echo "Documento restaurado.\n";
            } else {
                echo "Índice no válido.\n";
            }
            break;
        case "0":
            echo "Saliendo...\n";
            exit;
        default:
            echo "Opción inválida.\n";
    }
}
