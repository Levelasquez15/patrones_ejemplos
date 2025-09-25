<?php

// 1. Flyweight (interfaz común)
interface Icono {
    public function dibujar(int $x, int $y): void;
}

// 2. Flyweight concreto (objeto compartido)
class IconoConcreto implements Icono {
    private string $tipo;

    public function __construct(string $tipo) {
        $this->tipo = $tipo;
        echo "Creando icono de tipo: {$this->tipo}\n";
    }

    public function dibujar(int $x, int $y): void {
        echo "Icono '{$this->tipo}' dibujado en posición ({$x}, {$y})\n";
    }
}

// 3. Flyweight Factory
class IconoFactory {
    private array $iconos = [];

    public function getIcono(string $tipo): Icono {
        if (!isset($this->iconos[$tipo])) {
            $this->iconos[$tipo] = new IconoConcreto($tipo);
        }
        return $this->iconos[$tipo];
    }
}

// --------------------
// Cliente interactivo
// --------------------
$factory = new IconoFactory();

while (true) {
    echo "\n--- Menú Flyweight (Iconos) ---\n";
    echo "1. Crear/obtener icono y dibujarlo\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    if ($opcion === "1") {
        echo "Ingrese el tipo de icono (ej: Casa, Arbol, Carro): ";
        $tipo = trim(fgets(STDIN));

        echo "Ingrese posición X: ";
        $x = (int) trim(fgets(STDIN));

        echo "Ingrese posición Y: ";
        $y = (int) trim(fgets(STDIN));

        $icono = $factory->getIcono($tipo);
        $icono->dibujar($x, $y);
    } else {
        echo "Opción no válida.\n";
    }
}
