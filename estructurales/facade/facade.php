<?php

// Subsistemas
class Caja {
    public function cobrar($monto) {
        echo "Cobrado: $$monto\n";
    }
}

class Cocinero {
    public function prepararComida($plato) {
        echo "Preparando $plato...\n";
    }
}

class Delivery {
    public function entregar($plato) {
        echo "Entregando $plato al cliente\n";
    }
}

// Facade
class RestauranteFacade {
    private Caja $caja;
    private Cocinero $cocinero;
    private Delivery $delivery;

    public function __construct() {
        $this->caja = new Caja();
        $this->cocinero = new Cocinero();
        $this->delivery = new Delivery();
    }

    public function ordenarComida($plato, $precio) {
        echo "Iniciando pedido...\n";
        $this->caja->cobrar($precio);
        $this->cocinero->prepararComida($plato);
        $this->delivery->entregar($plato);
    }
}

// --------------------
// Cliente interactivo
// --------------------
$restaurante = new RestauranteFacade();

while (true) {
    echo "\n--- Menú del Restaurante ---\n";
    echo "1. Ordenar Hamburguesa ($8)\n";
    echo "2. Ordenar Pizza ($12)\n";
    echo "3. Ordenar Ensalada ($6)\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";

    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    switch ($opcion) {
        case "1":
            $restaurante->ordenarComida("Hamburguesa", 8);
            break;
        case "2":
            $restaurante->ordenarComida("Pizza", 12);
            break;
        case "3":
            $restaurante->ordenarComida("Ensalada", 6);
            break;
        default:
            echo "Opción no válida\n";
            break;
    }
}
