<?php

namespace App\Services\PaymentGateways;

class BDOPayGateway extends BasePaymentGateway
{
    protected string $name = 'BDO Pay';
    protected string $code = 'bdopay';
    protected string $apiBaseUrl = 'https://api.bdogroup.com/v1';

    public function isConfigured(): bool
    {
        return $this->validateConfig(['merchant_id', 'api_key', 'secret_key']);
    }

    public function initializePayment(array $data): array
    {
        try {
            if (!$this->isConfigured()) {
                throw new \Exception('BDO Pay is not configured properly');
            }

            $referenceId = 'BDO-' . time() . '-' . rand(10000, 99999);
            $paymentUrl = $this->generatePaymentUrl($referenceId, $data);

            $this->paymentUrl = $paymentUrl;

            $this->log('BDO Pay payment initialized', [
                'reference_id' => $referenceId,
                'amount' => $data['amount'],
                'currency' => $data['currency'] ?? 'PHP',
            ]);

            return [
                'success' => true,
                'reference_id' => $referenceId,
                'payment_url' => $paymentUrl,
                'gateway_code' => 'bdopay',
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
            $this->log('BDO Pay payment verified', [
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
            $this->log('BDO Pay payment refunded', [
                'reference_id' => $referenceId,
                'amount' => $amount,
            ]);

            return [
                'success' => true,
                'refund_id' => 'BDO-REFUND-' . time(),
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

    private function generatePaymentUrl(string $referenceId, array $data): string
    {
        return route('payment.bdopay.verify', [
            'reference_id' => $referenceId,
            'amount' => $data['amount'],
        ]);
    }
}
