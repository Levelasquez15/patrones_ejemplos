<?php

// 1. Producto final
class PC {
    public $cpu;
    public $ram;
    public $almacenamiento;
    public $gpu;

    public function mostrarConfig() {
        echo "\n--- Configuración de la PC ---\n";
        echo "- CPU: $this->cpu\n";
        echo "- RAM: $this->ram\n";
        echo "- Almacenamiento: $this->almacenamiento\n";
        echo "- GPU: $this->gpu\n\n";
    }
}

// 2. Builder abstracto
interface PCBuilder {
    public function setCPU(string $cpu);
    public function setRAM(string $ram);
    public function setAlmacenamiento(string $alm);
    public function setGPU(string $gpu);
    public function getPC(): PC;
}

// 3. Builder concreto
class GamingPCBuilder implements PCBuilder {
    private PC $pc;

    public function __construct() {
        $this->pc = new PC();
    }

    public function setCPU(string $cpu) {
        $this->pc->cpu = $cpu;
    }

    public function setRAM(string $ram) {
        $this->pc->ram = $ram;
    }

    public function setAlmacenamiento(string $alm) {
        $this->pc->almacenamiento = $alm;
    }

    public function setGPU(string $gpu) {
        $this->pc->gpu = $gpu;
    }

    public function getPC(): PC {
        return $this->pc;
    }
}

// 4. Director (opcional)
class Director {
    public function construirPCGamer(PCBuilder $builder) {
        $builder->setCPU("Intel i9");
        $builder->setRAM("32GB DDR5");
        $builder->setAlmacenamiento("1TB SSD");
        $builder->setGPU("NVIDIA RTX 4090");
    }

    public function construirPCOficina(PCBuilder $builder) {
        $builder->setCPU("Intel i5");
        $builder->setRAM("16GB DDR4");
        $builder->setAlmacenamiento("512GB SSD");
        $builder->setGPU("Integrada");
    }
}

// --------------------
// Cliente interactivo
// --------------------
$director = new Director();

while (true) {
    echo "\n--- Menú Builder (PCs) ---\n";
    echo "1. Construir PC Gamer\n";
    echo "2. Construir PC de Oficina\n";
    echo "0. Salir\n";
    echo "Seleccione una opción: ";
    $opcion = trim(fgets(STDIN));

    if ($opcion === "0") {
        echo "Saliendo...\n";
        break;
    }

    $builder = new GamingPCBuilder();

    switch ($opcion) {
        case "1":
            $director->construirPCGamer($builder);
            $pc = $builder->getPC();
            $pc->mostrarConfig();
            break;
        case "2":
            $director->construirPCOficina($builder);
            $pc = $builder->getPC();
            $pc->mostrarConfig();
            break;
        default:
            echo "Opción no válida.\n";
    }
}
