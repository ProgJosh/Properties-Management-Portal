<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Configure your payment gateways here. Each gateway can have its own
    | set of configuration options.
    |
    */

    'default' => env('PAYMENT_GATEWAY', 'stripe'),

    'log_channel' => 'payments',

    /*
    |--------------------------------------------------------------------------
    | Stripe Configuration
    |--------------------------------------------------------------------------
    */
    'stripe' => [
        'public_key' => env('STRIPE_KEY'),
        'secret_key' => env('STRIPE_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | GCash Configuration
    |--------------------------------------------------------------------------
    */
    'gcash' => [
        'public_key' => env('GCASH_PUBLIC_KEY'),
        'secret_key' => env('GCASH_SECRET_KEY'),
        'merchant_id' => env('GCASH_MERCHANT_ID'),
        'api_url' => env('GCASH_API_URL', 'https://api.paymongo.com/v1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | GotYME Configuration
    |--------------------------------------------------------------------------
    */
    'gotyme' => [
        'api_key' => env('GOTYME_API_KEY'),
        'merchant_id' => env('GOTYME_MERCHANT_ID'),
        'api_url' => env('GOTYME_API_URL', 'https://api.gotyme.com'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maya Configuration
    |--------------------------------------------------------------------------
    */
    'maya' => [
        'api_key' => env('MAYA_API_KEY'),
        'secret_key' => env('MAYA_SECRET_KEY'),
        'api_url' => env('MAYA_API_URL', 'https://api.sandbox.paymaya.com'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Dragonpay Configuration (Optional)
    |--------------------------------------------------------------------------
    */
    'dragonpay' => [
        'merchant_id' => env('DRAGONPAY_MERCHANT_ID'),
        'password' => env('DRAGONPAY_PASSWORD'),
        'api_url' => env('DRAGONPAY_API_URL', 'https://api.dragonpay.ph'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Atome Configuration
    |--------------------------------------------------------------------------
    */
    'atome' => [
        'merchant_id' => env('ATOME_MERCHANT_ID'),
        'api_key' => env('ATOME_API_KEY'),
        'api_url' => env('ATOME_API_URL', 'https://api.atome.ph/v1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | GCash Configuration with QR
    |--------------------------------------------------------------------------
    */
    'gcash' => [
        'public_key' => env('GCASH_PUBLIC_KEY'),
        'secret_key' => env('GCASH_SECRET_KEY'),
        'merchant_id' => env('GCASH_MERCHANT_ID'),
        'api_url' => env('GCASH_API_URL', 'https://api.paymongo.com/v1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | BDO Pay Configuration
    |--------------------------------------------------------------------------
    */
    'bdopay' => [
        'merchant_id' => env('BDOPAY_MERCHANT_ID'),
        'api_key' => env('BDOPAY_API_KEY'),
        'secret_key' => env('BDOPAY_SECRET_KEY'),
        'api_url' => env('BDOPAY_API_URL', 'https://api.bdogroup.com/v1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Redirect URLs
    |--------------------------------------------------------------------------
    */
    'redirect_urls' => [
        'success' => env('PAYMENT_SUCCESS_URL', '/payment/success'),
        'cancel' => env('PAYMENT_CANCEL_URL', '/payment/cancel'),
        'callback' => env('PAYMENT_CALLBACK_URL', '/payment/callback'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    */
    'default_currency' => env('PAYMENT_CURRENCY', 'PHP'),
];
