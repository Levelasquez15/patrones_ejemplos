<?php

// 1. Interfaz Elemento
interface Elemento {
    public function aceptar(Visitor $visitor);
}

// 2. Elementos concretos
class Circulo implements Elemento {
    public function aceptar(Visitor $visitor) {
        $visitor->visitarCirculo($this);
    }

    public function dibujar() {
        echo "Dibujando un Círculo\n";
    }
}

class Cuadrado implements Elemento {
    public function aceptar(Visitor $visitor) {
        $visitor->visitarCuadrado($this);
    }

    public function dibujar() {
        echo "Dibujando un Cuadrado\n";
    }
}

// 3. Interfaz Visitor
interface Visitor {
    public function visitarCirculo(Circulo $circulo);
    public function visitarCuadrado(Cuadrado $cuadrado);
}

// 4. Visitantes concretos
class DibujarVisitor implements Visitor {
    public function visitarCirculo(Circulo $circulo) {
        $circulo->dibujar();
    }

    public function visitarCuadrado(Cuadrado $cuadrado) {
        $cuadrado->dibujar();
    }
}

class CalcularAreaVisitor implements Visitor {
    public function visitarCirculo(Circulo $circulo) {
        echo "Área del Círculo = π * r^2 (ejemplo)\n";
    }

    public function visitarCuadrado(Cuadrado $cuadrado) {
        echo "Área del Cuadrado = lado^2 (ejemplo)\n";
    }
}

// ========== INTERACTIVO ==========
$figuras = [new Circulo(), new Cuadrado()];

while (true) {
    echo "\nSeleccione una opción:\n";
    echo "1. Dibujar figuras\n";
    echo "2. Calcular áreas\n";
    echo "3. Salir\n";
    echo "Opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion == "3") {
        echo "Saliendo...\n";
        break;
    }

    switch ($opcion) {
        case "1":
            $dibujar = new DibujarVisitor();
            foreach ($figuras as $figura) {
                $figura->aceptar($dibujar);
            }
            break;
        case "2":
            $calcular = new CalcularAreaVisitor();
            foreach ($figuras as $figura) {
                $figura->aceptar($calcular);
            }
            break;
        default:
            echo "Opción no válida.\n";
    }
}
