<?php

// 1. Interfaz común
interface Pago {
    public function procesar(float $monto);
}

// 2. Implementaciones nativas
class PagoTarjeta implements Pago {
    public function procesar(float $monto) {
        echo "💳 Procesando pago con Tarjeta: $$monto\n";
    }
}

class PagoPayPal implements Pago {
    public function procesar(float $monto) {
        echo "💻 Procesando pago con PayPal: $$monto\n";
    }
}

// 3. Servicio externo (no lo podemos modificar)
class CryptoAPI {
    public function sendCrypto(float $cantidad) {
        echo "🪙 Enviando pago en Criptomoneda: $cantidad BTC\n";
    }
}

// 4. Adapter: adapta CryptoAPI a la interfaz Pago
class PagoCriptoAdapter implements Pago {
    private CryptoAPI $crypto;

    public function __construct(CryptoAPI $crypto) {
        $this->crypto = $crypto;
    }

    public function procesar(float $monto) {
        // Adaptamos dólares a BTC (ejemplo simple)
        $btc = $monto / 50000; // Supongamos 1 BTC = 50,000 USD
        $this->crypto->sendCrypto($btc);
    }
}

// 5. Cliente
function ejecutarPago(Pago $pago, float $monto) {
    $pago->procesar($monto);
}

// 🚀 Uso en la práctica
ejecutarPago(new PagoTarjeta(), 120.50);
ejecutarPago(new PagoPayPal(), 89.99);

// Uso del Adapter
$cryptoApi = new CryptoAPI();
ejecutarPago(new PagoCriptoAdapter($cryptoApi), 100000);
