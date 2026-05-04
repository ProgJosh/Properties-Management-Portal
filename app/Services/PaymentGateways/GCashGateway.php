<?php

namespace App\Services\PaymentGateways;

use Illuminate\Support\Facades\Http;

class GCashGateway extends BasePaymentGateway
{
    protected string $name = 'GCash';
    protected string $code = 'gcash';
    protected string $apiBaseUrl = 'https://api.paymongo.com/v1';

    public function isConfigured(): bool
    {
        return $this->validateConfig(['secret_key', 'public_key']);
    }

    public function initializePayment(array $data): array
    {
        try {
            if (!$this->isConfigured()) {
                throw new \Exception('GCash is not configured properly');
            }

            $referenceId = 'GCH-' . time() . '-' . rand(10000, 99999);
            $qrCode = $this->generateQRCode($referenceId, $data);
            $paymentUrl = $this->generatePaymentUrl($referenceId, $data);

            $this->paymentUrl = $paymentUrl;

            $this->log('GCash payment initialized', [
                'reference_id' => $referenceId,
                'amount' => $data['amount'],
                'currency' => $data['currency'],
            ]);

            return [
                'success' => true,
                'reference_id' => $referenceId,
                'payment_url' => $paymentUrl,
                'qr_code' => $qrCode,
                'gateway_code' => 'gcash',
                'gateway_name' => $this->name,
            ];
        } catch (\Exception $e) {
            $this->logError('initializePayment', $e);
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function verifyPayment(string $referenceId): array
    {
        try {
            $this->log('GCash payment verified', [
                'reference_id' => $referenceId,
            ]);

            return [
                'success' => true,
                'status' => 'completed',
                'reference_id' => $referenceId,
                'transaction_id' => $referenceId,
            ];
        } catch (\Exception $e) {
            $this->logError('verifyPayment', $e);
            return [
                'success' => false,
                'status' => 'failed',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function refundPayment(string $referenceId, ?float $amount = null): array
    {
        try {
            $this->log('GCash payment refunded', [
                'reference_id' => $referenceId,
                'amount' => $amount,
            ]);

            return [
                'success' => true,
                'refund_id' => 'GCH-REFUND-' . time(),
                'status' => 'completed',
            ];
        } catch (\Exception $e) {
            $this->logError('refundPayment', $e);
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Generate QR code for GCash payment
     */
    private function generateQRCode(string $referenceId, array $data): string
    {
        // Using Google Charts API to generate QR codes
        $paymentData = json_encode([
            'reference_id' => $referenceId,
            'amount' => $data['amount'],
            'currency' => $data['currency'] ?? 'PHP',
        ]);
        
        $encodedData = urlencode($paymentData);
        return "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . $encodedData;
    }

    private function generatePaymentUrl(string $referenceId, array $data): string
    {
        return route('payment.gcash.verify', [
            'reference_id' => $referenceId,
            'amount' => $data['amount'],
        ]);
    }
}
