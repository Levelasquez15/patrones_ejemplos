<?php

// 1. Implementador
interface Mensajero {
    public function enviar(string $mensaje): void;
}

// 2. Implementadores concretos
class Email implements Mensajero {
    public function enviar(string $mensaje): void {
        echo "[EMAIL] Enviando: $mensaje\n";
    }
}

class SMS implements Mensajero {
    public function enviar(string $mensaje): void {
        echo "[SMS] Enviando: $mensaje\n";
    }
}

class WhatsApp implements Mensajero {
    public function enviar(string $mensaje): void {
        echo "[WHATSAPP] Enviando: $mensaje\n";
    }
}

// 3. Abstracción
abstract class Mensaje {
    protected Mensajero $mensajero;

    public function __construct(Mensajero $mensajero) {
        $this->mensajero = $mensajero;
    }

    abstract public function enviarMensaje(string $texto): void;
}

// 4. Abstracciones refinadas
class MensajePlano extends Mensaje {
    public function enviarMensaje(string $texto): void {
        $this->mensajero->enviar($texto);
    }
}

class MensajeUrgente extends Mensaje {
    public function enviarMensaje(string $texto): void {
        $this->mensajero->enviar("URGENTE: " . strtoupper($texto));
    }
}

// ---------------- CLIENTE INTERACTIVO ----------------
function seleccionarMensajero($opcion): Mensajero {
    return match($opcion) {
        "1" => new Email(),
        "2" => new SMS(),
        "3" => new WhatsApp(),
        default => new Email()
    };
}

function seleccionarTipoMensaje($opcion, Mensajero $mensajero): Mensaje {
    return match($opcion) {
        "1" => new MensajePlano($mensajero),
        "2" => new MensajeUrgente($mensajero),
        default => new MensajePlano($mensajero)
    };
}

while (true) {
    echo "\n--- MENU ---\n";
    echo "1. Enviar mensaje plano\n";
    echo "2. Enviar mensaje urgente\n";
    echo "3. Salir\n";
    echo "Seleccione una opcion: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "3") {
        exit("Saliendo...\n");
    }

    echo "Seleccione el medio:\n";
    echo "1. Email\n";
    echo "2. SMS\n";
    echo "3. WhatsApp\n";
    echo "Opcion: ";
    $medio = trim(fgets(STDIN));

    echo "Escriba el mensaje: ";
    $texto = trim(fgets(STDIN));

    $mensajero = seleccionarMensajero($medio);
    $mensaje = seleccionarTipoMensaje($opcion, $mensajero);

    $mensaje->enviarMensaje($texto);
}
