<?php

// 1. Estrategia (interfaz)
interface MetodoPago {
    public function pagar(float $monto): void;
}

// 2. Estrategias concretas
class PagoTarjeta implements MetodoPago {
    public function pagar(float $monto): void {
        echo "Pagando \${$monto} con TARJETA.\n";
    }
}

class PagoPayPal implements MetodoPago {
    public function pagar(float $monto): void {
        echo "Pagando \${$monto} con PayPal.\n";
    }
}

class PagoEfectivo implements MetodoPago {
    public function pagar(float $monto): void {
        echo "Pagando \${$monto} en EFECTIVO.\n";
    }
}

// 3. Contexto
class Carrito {
    private MetodoPago $metodoPago;

    public function setMetodoPago(MetodoPago $metodo) {
        $this->metodoPago = $metodo;
    }

    public function procesarCompra(float $monto) {
        if (!isset($this->metodoPago)) {
            echo "Debe seleccionar un método de pago antes de continuar.\n";
            return;
        }
        $this->metodoPago->pagar($monto);
    }
}

// 4. Cliente interactivo
$carrito = new Carrito();

while (true) {
    echo "\nSeleccione un método de pago:\n";
    echo "1. Tarjeta\n";
    echo "2. PayPal\n";
    echo "3. Efectivo\n";
    echo "4. Salir\n";
    echo "Opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "4") {
        echo "Saliendo...\n";
        break;
    }

    echo "Ingrese el monto de la compra: ";
    $monto = (float) trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            $carrito->setMetodoPago(new PagoTarjeta());
            break;
        case "2":
            $carrito->setMetodoPago(new PagoPayPal());
            break;
        case "3":
            $carrito->setMetodoPago(new PagoEfectivo());
            break;
        default:
            echo "Opción no válida.\n";
            continue 2;
    }

    $carrito->procesarCompra($monto);
}
