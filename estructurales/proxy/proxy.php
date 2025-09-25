<?php

// 1. Interfaz común
interface ServicioBD {
    public function consultar(string $query): string;
}

// 2. Objeto real (servicio pesado)
class BaseDeDatos implements ServicioBD {
    public function __construct() {
        // Simulamos carga pesada
        echo "Conectando a la base de datos real...\n";
        sleep(1); // simula tiempo de conexión
    }

    public function consultar(string $query): string {
        return "Resultado de la consulta: [$query]";
    }
}

// 3. Proxy (controla acceso al objeto real)
class ProxyBD implements ServicioBD {
    private ?BaseDeDatos $bd = null;
    private array $cache = [];

    public function consultar(string $query): string {
        // Si ya está en caché, devolvemos rápido
        if (isset($this->cache[$query])) {
            return "(Cache) " . $this->cache[$query];
        }

        // Creamos el objeto real solo si se necesita
        if ($this->bd === null) {
            $this->bd = new BaseDeDatos();
        }

        $resultado = $this->bd->consultar($query);
        $this->cache[$query] = $resultado;

        return $resultado;
    }
}

// --------------------
// Cliente interactivo
// --------------------
$bd = new ProxyBD();

while (true) {
    echo "\n--- Menú Proxy (Base de Datos) ---\n";
    echo "1. Ejecutar consulta\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    if ($opcion === "1") {
        echo "Ingrese la consulta SQL: ";
        $query = trim(fgets(STDIN));
        $resultado = $bd->consultar($query);
        echo $resultado . "\n";
    } else {
        echo "Opción no válida.\n";
    }
}
