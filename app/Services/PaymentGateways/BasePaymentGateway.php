<?php

namespace App\Services\PaymentGateways;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Support\Facades\Log;

abstract class BasePaymentGateway implements PaymentGatewayInterface
{
    protected string $name;
    protected string $code;
    protected array $config = [];
    protected ?string $paymentUrl = null;

    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * Load configuration from config file
     */
    protected function loadConfig(): void
    {
        $gatewayConfig = config("payment-gateways.{$this->code}", []);
        $this->config = array_merge($this->config, $gatewayConfig);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPaymentUrl(): ?string
    {
        return $this->paymentUrl;
    }

    /**
     * Log payment action
     */
    protected function log(string $action, array $data = []): void
    {
        Log::channel('payments')->info("[$this->code] $action", $data);
    }

    /**
     * Log payment error
     */
    protected function logError(string $action, \Exception $exception): void
    {
        Log::channel('payments')->error("[$this->code] $action failed", [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }

    /**
     * Get configuration value
     */
    protected function getConfigValue(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    /**
     * Check if required config keys are present
     */
    protected function validateConfig(array $requiredKeys): bool
    {
        foreach ($requiredKeys as $key) {
            if (empty($this->config[$key])) {
                return false;
            }
        }
        return true;
    }
}
