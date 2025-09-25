<?php
// menu.php

function mostrarMenuPrincipal() {
    echo "=============================\n";
    echo "   MENÚ DE PATRONES PHP\n";
    echo "=============================\n";
    echo "1. Creacionales\n";
    echo "2. Estructurales\n";
    echo "3. Comportamiento\n";
    echo "0. Salir\n";
    echo "=============================\n";
    echo "Seleccione una opción: ";
}

function mostrarMenuCreacionales() {
    echo "\n--- PATRONES CREACIONALES ---\n";
    echo "1. Prototype\n";
    echo "2. Singleton\n";
    echo "3. Factory Method\n";
    echo "4. Builder\n";
    echo "5. Abstract Factory\n";
    echo "0. Volver\n";
    echo "Seleccione una opción: ";
}

function mostrarMenuEstructurales() {
    echo "\n--- PATRONES ESTRUCTURALES ---\n";
    echo "1. Adapter\n";
    echo "2. Bridge\n";
    echo "3. Composite\n";
    echo "4. Decorator\n";
    echo "5. Facade\n";
    echo "6. Flyweight\n";
    echo "7. Proxy\n";
    echo "0. Volver\n";
    echo "Seleccione una opción: ";
}

function mostrarMenuComportamiento() {
    echo "\n--- PATRONES DE COMPORTAMIENTO ---\n";
    echo "1. Chain of Responsibility\n";
    echo "2. Command\n";
    echo "3. Interpreter\n";
    echo "4. Iterator\n";
    echo "5. Mediator\n";
    echo "6. Memento\n";
    echo "7. Observer\n";
    echo "8. State\n";
    echo "9. Strategy\n";
    echo "10. Template Method\n";
    echo "11. Visitor\n";
    echo "0. Volver\n";
    echo "Seleccione una opción: ";
}

// ========== MENÚ PRINCIPAL ==========
mostrarMenuPrincipal();
$opcion = trim(fgets(STDIN));

switch ($opcion) {
    case "1": // Creacionales
        mostrarMenuCreacionales();
        $sub = trim(fgets(STDIN));
        switch ($sub) {
            case "1": require "creacionales/prototype/prototype.php"; break;
            case "2": require "creacionales/singleton/singleton.php"; break;
            case "3": require "creacionales/factory_method/factory_method.php"; break;
            case "4": require "creacionales/builder/builder.php"; break;
            case "5": require "creacionales/abstract_factory/abstract_factory.php"; break;
        }
        break;

    case "2": // Estructurales
        mostrarMenuEstructurales();
        $sub = trim(fgets(STDIN));
        switch ($sub) {
            case "1": require "estructurales/adapter/adapter.php"; break;
            case "2": require "estructurales/bridge/bridge.php"; break;
            case "3": require "estructurales/composite/composite.php"; break;
            case "4": require "estructurales/decorator/decorator.php"; break;
            case "5": require "estructurales/facade/facade.php"; break;
            case "6": require "estructurales/flyweight/flyweight.php"; break;
            case "7": require "estructurales/proxy/proxy.php"; break;
        }
        break;

    case "3": // Comportamiento
        mostrarMenuComportamiento();
        $sub = trim(fgets(STDIN));
        switch ($sub) {
            case "1": require "comportamiento/chain_of_responsibility/chain_of_responsibility.php"; break;
            case "2": require "comportamiento/command/command.php"; break;
            case "3": require "comportamiento/interpreter/interpreter.php"; break;
            case "4": require "comportamiento/iterator/iterator.php"; break;
            case "5": require "comportamiento/mediator/mediator.php"; break;
            case "6": require "comportamiento/memento/memento.php"; break;
            case "7": require "comportamiento/observer/observer.php"; break;
            case "8": require "comportamiento/state/state.php"; break;
            case "9": require "comportamiento/strategy/strategy.php"; break;
            case "10": require "comportamiento/template_method/template_method.php"; break;
            case "11": require "comportamiento/visitor/visitor.php"; break;
        }
        break;

    case "0":
        echo "Saliendo...\n";
        exit;

    default:
        echo "❌ Opción no válida\n";
        break;
}
