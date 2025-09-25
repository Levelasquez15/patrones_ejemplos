<?php

interface Pago {
    public function procesar(float $monto);
}

class PagoTarjeta implements Pago {
    public function procesar(float $monto) {
        echo "Procesando pago con TARJETA: $$monto\n";
    }
}

class PagoPayPal implements Pago {
    public function procesar(float $monto) {
        echo "Procesando pago con PAYPAL: $$monto\n";
    }
}

class PagoCripto implements Pago {
    public function procesar(float $monto) {
        echo "Procesando pago con CRIPTOMONEDA: $$monto\n";
    }
}

abstract class PagoFactory {
    abstract public function crearPago(): Pago;

    public function procesarPago(float $monto) {
        $pago = $this->crearPago();
        $pago->procesar($monto);
    }
}

class PagoTarjetaFactory extends PagoFactory {
    public function crearPago(): Pago {
        return new PagoTarjeta();
    }
}

class PagoPayPalFactory extends PagoFactory {
    public function crearPago(): Pago {
        return new PagoPayPal();
    }
}

class PagoCriptoFactory extends PagoFactory {
    public function crearPago(): Pago {
        return new PagoCripto();
    }
}

// --------------------
// Cliente interactivo
// --------------------
while (true) {
    echo "\n--- Menú Factory Method (Pagos) ---\n";
    echo "1. Pagar con Tarjeta\n";
    echo "2. Pagar con PayPal\n";
    echo "3. Pagar con Criptomoneda\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    echo "Ingrese el monto a pagar: ";
    $monto = (float) trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            $factory = new PagoTarjetaFactory();
            break;
        case "2":
            $factory = new PagoPayPalFactory();
            break;
        case "3":
            $factory = new PagoCriptoFactory();
            break;
        default:
            echo "Opción no válida.\n";
            continue 2;
    }

    $factory->procesarPago($monto);
}
