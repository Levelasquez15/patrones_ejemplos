<?php

// 1. Productos abstractos
interface Silla {
    public function crear();
}

interface Sofa {
    public function crear();
}

interface Mesa {
    public function crear();
}

// 2. Productos concretos (Modernos)
class SillaModerna implements Silla {
    public function crear() { echo "Creando Silla Moderna\n"; }
}

class SofaModerno implements Sofa {
    public function crear() { echo "Creando Sofá Moderno\n"; }
}

class MesaModerna implements Mesa {
    public function crear() { echo "Creando Mesa Moderna\n"; }
}

// 3. Productos concretos (Clásicos)
class SillaClasica implements Silla {
    public function crear() { echo "Creando Silla Clásica\n"; }
}

class SofaClasico implements Sofa {
    public function crear() { echo "Creando Sofá Clásico\n"; }
}

class MesaClasica implements Mesa {
    public function crear() { echo "Creando Mesa Clásica\n"; }
}

// 4. Abstract Factory
interface FabricaMuebles {
    public function crearSilla(): Silla;
    public function crearSofa(): Sofa;
    public function crearMesa(): Mesa;
}

// 5. Fábricas concretas
class FabricaModerna implements FabricaMuebles {
    public function crearSilla(): Silla { return new SillaModerna(); }
    public function crearSofa(): Sofa { return new SofaModerno(); }
    public function crearMesa(): Mesa { return new MesaModerna(); }
}

class FabricaClasica implements FabricaMuebles {
    public function crearSilla(): Silla { return new SillaClasica(); }
    public function crearSofa(): Sofa { return new SofaClasico(); }
    public function crearMesa(): Mesa { return new MesaClasica(); }
}

// 6. Cliente
class Tienda {
    private FabricaMuebles $fabrica;

    public function __construct(FabricaMuebles $fabrica) {
        $this->fabrica = $fabrica;
    }

    public function mostrarCatalogo() {
        $silla = $this->fabrica->crearSilla();
        $sofa = $this->fabrica->crearSofa();
        $mesa = $this->fabrica->crearMesa();

        $silla->crear();
        $sofa->crear();
        $mesa->crear();
    }
}

// --------------------
// Cliente interactivo
// --------------------
while (true) {
    echo "\n--- Menú Abstract Factory (Muebles) ---\n";
    echo "1. Mostrar Catálogo Moderno\n";
    echo "2. Mostrar Catálogo Clásico\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    switch ($opcion) {
        case "1":
            echo "\nCatálogo Moderno:\n";
            $tienda = new Tienda(new FabricaModerna());
            $tienda->mostrarCatalogo();
            break;
        case "2":
            echo "\nCatálogo Clásico:\n";
            $tienda = new Tienda(new FabricaClasica());
            $tienda->mostrarCatalogo();
            break;
        default:
            echo "Opción no válida.\n";
    }
}
