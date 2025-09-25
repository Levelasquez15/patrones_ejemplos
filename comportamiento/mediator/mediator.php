<?php

// 1. Interfaz Mediador
interface ChatMediator {
    public function enviarMensaje(string $mensaje, Usuario $usuario);
    public function agregarUsuario(Usuario $usuario);
}

// 2. Mediador concreto
class ChatSala implements ChatMediator {
    private array $usuarios = [];

    public function agregarUsuario(Usuario $usuario) {
        $this->usuarios[] = $usuario;
    }

    public function enviarMensaje(string $mensaje, Usuario $usuario) {
        foreach ($this->usuarios as $u) {
            if ($u !== $usuario) {
                $u->recibir($usuario->getNombre() . ": " . $mensaje);
            }
        }
    }
}

// 3. Clase Colleague
class Usuario {
    private string $nombre;
    private ChatMediator $chat;

    public function __construct(string $nombre, ChatMediator $chat) {
        $this->nombre = $nombre;
        $this->chat = $chat;
        $this->chat->agregarUsuario($this);
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function enviar(string $mensaje) {
        echo "[Enviado por {$this->nombre}] $mensaje\n";
        $this->chat->enviarMensaje($mensaje, $this);
    }

    public function recibir(string $mensaje) {
        echo "[{$this->nombre} recibió] $mensaje\n";
    }
}

// 4. Cliente interactivo
$chat = new ChatSala();

echo "=== Chat con Mediator ===\n";

// Crear usuarios
$usuarios = [];
while (true) {
    echo "\nOpciones: (1) Crear usuario (2) Enviar mensaje (0) Salir\n";
    echo "Elige una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "1") {
        echo "Nombre del usuario: ";
        $nombre = trim(fgets(STDIN));
        $usuarios[$nombre] = new Usuario($nombre, $chat);
        echo "Usuario '$nombre' creado.\n";
    } elseif ($opcion === "2") {
        if (empty($usuarios)) {
            echo "No hay usuarios creados.\n";
            continue;
        }
        echo "Quién envía el mensaje? (" . implode(", ", array_keys($usuarios)) . "): ";
        $remitente = trim(fgets(STDIN));
        if (!isset($usuarios[$remitente])) {
            echo "Usuario no encontrado.\n";
            continue;
        }
        echo "Escribe el mensaje: ";
        $mensaje = trim(fgets(STDIN));
        $usuarios[$remitente]->enviar($mensaje);
    } elseif ($opcion === "0") {
        echo "Saliendo del chat...\n";
        break;
    } else {
        echo "Opción inválida.\n";
    }
}
