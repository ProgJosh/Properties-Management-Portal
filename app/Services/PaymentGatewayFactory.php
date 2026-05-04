<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Services\PaymentGateways\{
    AtomeGateway,
    GCashGateway,
    BDOPayGateway,
};
use Exception;

class PaymentGatewayFactory
{
    /**
     * Map of gateway codes to their classes
     */
    protected static array $gateways = [
        'atome' => AtomeGateway::class,
        'gcash' => GCashGateway::class,
        'bdopay' => BDOPayGateway::class,
    ];

    /**
     * Create a payment gateway instance
     * 
     * @param string $gatewayCode Gateway code
     * @return PaymentGatewayInterface
     * @throws Exception
     */
    public static function make(string $gatewayCode): PaymentGatewayInterface
    {
        $gatewayCode = strtolower($gatewayCode);

        if (!isset(self::$gateways[$gatewayCode])) {
            throw new Exception("Payment gateway '{$gatewayCode}' is not registered");
        }

        $gatewayClass = self::$gateways[$gatewayCode];
        return new $gatewayClass();
    }

    /**
     * Get all available gateways
     * 
     * @return PaymentGatewayInterface[]
     */
    public static function getAvailable(): array
    {
        $available = [];

        foreach (self::$gateways as $code => $class) {
            try {
                $gateway = new $class();
                if ($gateway->isConfigured()) {
                    $available[$code] = $gateway;
                }
            } catch (\Exception $e) {
                // Gateway not available or not configured
            }
        }

        return $available;
    }

    /**
     * Get all gateway options (configured or not)
     * 
     * @return array
     */
    public static function getAllOptions(): array
    {
        $options = [];

        foreach (self::$gateways as $code => $class) {
            try {
                $gateway = new $class();
                $options[$code] = [
                    'code' => $gateway->getCode(),
                    'name' => $gateway->getName(),
                    'configured' => $gateway->isConfigured(),
                ];
            } catch (\Exception $e) {
                // Continue
            }
        }

        return $options;
    }

    /**
     * Register a new gateway
     * 
     * @param string $code Gateway code
     * @param string $class Gateway class
     */
    public static function register(string $code, string $class): void
    {
        self::$gateways[strtolower($code)] = $class;
    }

    /**
     * Check if a gateway is registered
     * 
     * @param string $gatewayCode
     * @return bool
     */
    public static function exists(string $gatewayCode): bool
    {
        return isset(self::$gateways[strtolower($gatewayCode)]);
    }
}
