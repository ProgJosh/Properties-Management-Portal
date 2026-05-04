<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    /**
     * Initialize payment session
     * 
     * @param array $data Payment data (amount, currency, description, etc.)
     * @return mixed
     */
    public function initializePayment(array $data);

    /**
     * Verify/validate a payment
     * 
     * @param string $referenceId Payment reference from gateway
     * @return array Status and payment details
     */
    public function verifyPayment(string $referenceId): array;

    /**
     * Refund a payment
     * 
     * @param string $referenceId Original payment reference
     * @param float|null $amount Amount to refund (null for full refund)
     * @return array Refund status
     */
    public function refundPayment(string $referenceId, ?float $amount = null): array;

    /**
     * Get gateway name
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Get gateway code/slug
     * 
     * @return string
     */
    public function getCode(): string;

    /**
     * Check if gateway is configured properly
     * 
     * @return bool
     */
    public function isConfigured(): bool;
}
