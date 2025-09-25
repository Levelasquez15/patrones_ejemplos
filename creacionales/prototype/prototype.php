<?php

interface DocumentoPrototype {
    public function __clone();
    public function mostrarInfo();
}

class Contrato implements DocumentoPrototype {
    private $titulo;
    private $contenido;
    private $firmado;

    public function __construct(string $titulo, string $contenido, bool $firmado) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->firmado = $firmado;
    }

    public function __clone() {
        $this->firmado = false;
        $this->titulo = $this->titulo . " (Copia)";
    }

    public function mostrarInfo() {
        $estado = $this->firmado ? "Firmado" : "No firmado";
        echo "Contrato: {$this->titulo}, Estado: {$estado}\n";
    }
}

class Reporte implements DocumentoPrototype {
    private $titulo;
    private $paginas;

    public function __construct(string $titulo, int $paginas) {
        $this->titulo = $titulo;
        $this->paginas = $paginas;
    }

    public function __clone() {
        $this->titulo = $this->titulo . " (Duplicado)";
    }

    public function mostrarInfo() {
        echo "Reporte: {$this->titulo}, Páginas: {$this->paginas}\n";
    }
}

// --------------------
// Cliente interactivo
// --------------------
$documentos = [];

while (true) {
    echo "\n--- Menú Prototype ---\n";
    echo "1. Crear Contrato\n";
    echo "2. Crear Reporte\n";
    echo "3. Clonar Documento\n";
    echo "4. Mostrar Documentos\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case "1":
            echo "Título del contrato: ";
            $titulo = trim(fgets(STDIN));
            echo "Contenido del contrato: ";
            $contenido = trim(fgets(STDIN));
            echo "¿Está firmado? (1=Sí, 0=No): ";
            $firmado = trim(fgets(STDIN)) === "1";
            $documentos[] = new Contrato($titulo, $contenido, $firmado);
            echo "Contrato creado correctamente.\n";
            break;

        case "2":
            echo "Título del reporte: ";
            $titulo = trim(fgets(STDIN));
            echo "Número de páginas: ";
            $paginas = (int) trim(fgets(STDIN));
            $documentos[] = new Reporte($titulo, $paginas);
            echo "Reporte creado correctamente.\n";
            break;

        case "3":
            if (empty($documentos)) {
                echo "No hay documentos para clonar.\n";
                break;
            }
            echo "Seleccione el índice del documento a clonar (0 - " . (count($documentos)-1) . "): ";
            $indice = (int) trim(fgets(STDIN));
            if (isset($documentos[$indice])) {
                $documentos[] = clone $documentos[$indice];
                echo "Documento clonado correctamente.\n";
            } else {
                echo "Índice no válido.\n";
            }
            break;

        case "4":
            if (empty($documentos)) {
                echo "No hay documentos creados.\n";
            } else {
                echo "Documentos actuales:\n";
                foreach ($documentos as $i => $doc) {
                    echo "[$i] ";
                    $doc->mostrarInfo();
                }
            }
            break;

        case "0":
            echo "Saliendo...\n";
            exit;

        default:
            echo "Opción no válida.\n";
            break;
    }
}
