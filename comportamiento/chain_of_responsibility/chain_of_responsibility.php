<?php

// 1. Manejador abstracto
abstract class Manejador {
    protected ?Manejador $siguiente = null;

    public function setSiguiente(Manejador $manejador): Manejador {
        $this->siguiente = $manejador;
        return $manejador;
    }

    public function manejar(string $mensaje) {
        if ($this->siguiente) {
            $this->siguiente->manejar($mensaje);
        } else {
            echo "Nadie pudo resolver el problema: $mensaje\n";
        }
    }
}

// 2. Manejadores concretos
class SoporteBasico extends Manejador {
    public function manejar(string $mensaje) {
        if ($mensaje === "contraseña") {
            echo "Soporte Básico: He resuelto el problema de contraseña.\n";
        } else {
            parent::manejar($mensaje);
        }
    }
}

class SoporteTecnico extends Manejador {
    public function manejar(string $mensaje) {
        if ($mensaje === "internet") {
            echo "Soporte Técnico: He resuelto el problema de conexión a Internet.\n";
        } else {
            parent::manejar($mensaje);
        }
    }
}

class SoporteAvanzado extends Manejador {
    public function manejar(string $mensaje) {
        if ($mensaje === "servidor") {
            echo "Soporte Avanzado: He resuelto el problema del servidor.\n";
        } else {
            parent::manejar($mensaje);
        }
    }
}

// 3. Cliente interactivo
$soporteBasico = new SoporteBasico();
$soporteTecnico = new SoporteTecnico();
$soporteAvanzado = new SoporteAvanzado();

// Se arma la cadena: básico -> técnico -> avanzado
$soporteBasico->setSiguiente($soporteTecnico)->setSiguiente($soporteAvanzado);

echo "=== Sistema de Soporte ===\n";
echo "Escribe el tipo de problema (contraseña, internet, servidor) o 'salir' para terminar.\n\n";

while (true) {
    echo "Problema: ";
    $entrada = trim(fgets(STDIN));

    if ($entrada === "salir") {
        echo "Saliendo del sistema de soporte...\n";
        break;
    }

    $soporteBasico->manejar($entrada);
}
