<?php

// 1. Interfaz de Expresión
interface Expresion {
    public function interpretar(array $contexto): bool;
}

// 2. Expresiones concretas
class Variable implements Expresion {
    private string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function interpretar(array $contexto): bool {
        return $contexto[$this->nombre] ?? false;
    }
}

class AndExpresion implements Expresion {
    private Expresion $expr1;
    private Expresion $expr2;

    public function __construct(Expresion $expr1, Expresion $expr2) {
        $this->expr1 = $expr1;
        $this->expr2 = $expr2;
    }

    public function interpretar(array $contexto): bool {
        return $this->expr1->interpretar($contexto) && $this->expr2->interpretar($contexto);
    }
}

class OrExpresion implements Expresion {
    private Expresion $expr1;
    private Expresion $expr2;

    public function __construct(Expresion $expr1, Expresion $expr2) {
        $this->expr1 = $expr1;
        $this->expr2 = $expr2;
    }

    public function interpretar(array $contexto): bool {
        return $this->expr1->interpretar($contexto) || $this->expr2->interpretar($contexto);
    }
}

// 3. Cliente interactivo
// Expresión: (A AND B) OR C
$A = new Variable("A");
$B = new Variable("B");
$C = new Variable("C");

$expresion = new OrExpresion(
    new AndExpresion($A, $B),
    $C
);

echo "=== Evaluador de Expresiones Lógicas ===\n";
echo "Expresión: (A AND B) OR C\n\n";

while (true) {
    echo "Introduce valores (true/false):\n";

    echo "A = ";
    $a = trim(fgets(STDIN)) === "true";

    echo "B = ";
    $b = trim(fgets(STDIN)) === "true";

    echo "C = ";
    $c = trim(fgets(STDIN)) === "true";

    $contexto = ["A" => $a, "B" => $b, "C" => $c];
    $resultado = $expresion->interpretar($contexto);

    echo "Resultado: " . ($resultado ? "VERDADERO" : "FALSO") . "\n\n";

    echo "¿Deseas probar otro caso? (s/n): ";
    $continuar = trim(fgets(STDIN));
    if (strtolower($continuar) !== "s") {
        echo "Saliendo...\n";
        break;
    }
}
