<?php

// 1. Interfaz del Iterador
interface Iterador {
    public function hasNext(): bool;
    public function next();
}

// 2. Interfaz de la colección
interface Coleccion {
    public function getIterator(): Iterador;
}

// 3. Clase concreta de colección
class ListaTareas implements Coleccion {
    private array $tareas = [];

    public function agregarTarea(string $tarea) {
        $this->tareas[] = $tarea;
    }

    public function getIterator(): Iterador {
        return new TareaIterador($this->tareas);
    }
}

// 4. Iterador concreto
class TareaIterador implements Iterador {
    private array $tareas;
    private int $posicion = 0;

    public function __construct(array $tareas) {
        $this->tareas = $tareas;
    }

    public function hasNext(): bool {
        return $this->posicion < count($this->tareas);
    }

    public function next() {
        return $this->tareas[$this->posicion++];
    }
}

// 5. Cliente interactivo
$lista = new ListaTareas();

echo "=== Lista de Tareas ===\n";

while (true) {
    echo "\nOpciones: (1) Agregar tarea (2) Ver tareas (0) Salir\n";
    echo "Elige una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "1") {
        echo "Escribe la tarea: ";
        $tarea = trim(fgets(STDIN));
        $lista->agregarTarea($tarea);
        echo "Tarea agregada.\n";
    } elseif ($opcion === "2") {
        echo "Tus tareas:\n";
        $iterador = $lista->getIterator();
        $i = 1;
        while ($iterador->hasNext()) {
            echo "- " . $i++ . ". " . $iterador->next() . "\n";
        }
    } elseif ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    } else {
        echo "Opción inválida.\n";
    }
}
