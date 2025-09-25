<?php

// 1. Componente base
interface Mensaje {
    public function mostrar();
}

// 2. Componente concreto
class MensajeSimple implements Mensaje {
    public function mostrar() {
        return "Hola Mundo";
    }
}

// 3. Decorador abstracto
abstract class MensajeDecorator implements Mensaje {
    protected $mensaje;

    public function __construct(Mensaje $mensaje) {
        $this->mensaje = $mensaje;
    }

    public function mostrar() {
        return $this->mensaje->mostrar();
    }
}

// 4. Decoradores concretos
class Mayusculas extends MensajeDecorator {
    public function mostrar() {
        return strtoupper(parent::mostrar());
    }
}

class ConAsteriscos extends MensajeDecorator {
    public function mostrar() {
        return "*** " . parent::mostrar() . " ***";
    }
}

// 5. Cliente
$mensaje = new MensajeSimple();
echo $mensaje->mostrar() . PHP_EOL; // Hola Mundo

$mensajeMayus = new Mayusculas($mensaje);
echo $mensajeMayus->mostrar() . PHP_EOL; // HOLA MUNDO

$mensajeDecorado = new ConAsteriscos($mensajeMayus);
echo $mensajeDecorado->mostrar() . PHP_EOL; // *** HOLA MUNDO ***
