<?php

// 1. Componente base
interface Elemento {
    public function mostrar(string $prefijo = ""): void;
    public function getTamano(): int;
}

// 2. Hoja (Archivo)
class Archivo implements Elemento {
    private string $nombre;
    private int $tamano;

    public function __construct(string $nombre, int $tamano) {
        $this->nombre = $nombre;
        $this->tamano = $tamano;
    }

    public function mostrar(string $prefijo = ""): void {
        echo $prefijo . "Archivo: {$this->nombre} ({$this->tamano}KB)\n";
    }

    public function getTamano(): int {
        return $this->tamano;
    }
}

// 3. Composite (Carpeta)
class Carpeta implements Elemento {
    private string $nombre;
    private array $elementos = [];

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function agregar(Elemento $elemento): void {
        $this->elementos[] = $elemento;
    }

    public function mostrar(string $prefijo = ""): void {
        echo $prefijo . "Carpeta: {$this->nombre}\n";
        foreach ($this->elementos as $e) {
            $e->mostrar($prefijo . "  ");
        }
    }

    public function getTamano(): int {
        $total = 0;
        foreach ($this->elementos as $e) {
            $total += $e->getTamano();
        }
        return $total;
    }
}

// ---------------- CLIENTE INTERACTIVO ----------------

$raiz = new Carpeta("Raiz");

while (true) {
    echo "\n--- MENU ---\n";
    echo "1. Agregar archivo\n";
    echo "2. Agregar carpeta\n";
    echo "3. Mostrar estructura\n";
    echo "4. Mostrar tamaño total\n";
    echo "5. Salir\n";
    echo "Seleccione una opcion: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            echo "Nombre del archivo: ";
            $nombre = trim(fgets(STDIN));
            echo "Tamaño en KB: ";
            $tamano = (int) trim(fgets(STDIN));
            $raiz->agregar(new Archivo($nombre, $tamano));
            echo "Archivo agregado.\n";
            break;

        case "2":
            echo "Nombre de la carpeta: ";
            $nombre = trim(fgets(STDIN));
            $carpeta = new Carpeta($nombre);
            $raiz->agregar($carpeta);
            echo "Carpeta agregada (vacía).\n";
            break;

        case "3":
            echo "\n--- ESTRUCTURA ---\n";
            $raiz->mostrar();
            break;

        case "4":
            echo "Tamaño total: " . $raiz->getTamano() . "KB\n";
            break;

        case "5":
            exit("Saliendo...\n");

        default:
            echo "Opción no válida.\n";
    }
}
