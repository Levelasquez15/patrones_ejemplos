<?php

// 1. Clase abstracta con el Template Method
abstract class ProcesoCocina {
    // Template Method
    public final function prepararPlato() {
        $this->prepararIngredientes();
        $this->cocinar();
        $this->servir();
        echo "Plato listo!\n\n";
    }

    abstract protected function prepararIngredientes();
    abstract protected function cocinar();

    protected function servir() {
        echo "Sirviendo el plato en la mesa.\n";
    }
}

// 2. Subclases concretas
class Pasta extends ProcesoCocina {
    protected function prepararIngredientes() {
        echo "Preparando pasta y salsa.\n";
    }

    protected function cocinar() {
        echo "Cocinando la pasta en agua hirviendo.\n";
    }
}

class Pizza extends ProcesoCocina {
    protected function prepararIngredientes() {
        echo "Preparando masa, salsa y queso.\n";
    }

    protected function cocinar() {
        echo "Horneando la pizza a 220°C.\n";
    }
}

// 3. Cliente interactivo
while (true) {
    echo "Seleccione un plato para preparar:\n";
    echo "1. Pasta\n";
    echo "2. Pizza\n";
    echo "3. Salir\n";
    echo "Opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "3") {
        echo "Saliendo...\n";
        break;
    }

    switch ($opcion) {
        case "1":
            $pasta = new Pasta();
            $pasta->prepararPlato();
            break;
        case "2":
            $pizza = new Pizza();
            $pizza->prepararPlato();
            break;
        default:
            echo "Opción no válida.\n";
    }
}
