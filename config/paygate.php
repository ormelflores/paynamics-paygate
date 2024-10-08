<?php

return [
    'merchant_id' => env('PAYNAMICS_MERCHANT_ID'),

    'merchant_key' => env('PAYNAMICS_MERCHANT_KEY'),

    'environment' => env('PAYNAMICS_ENVIRONMENT', 'sandbox'),

    'endpoint' => [
        'sandbox' => env('PAYNAMICS_SANDBOX_ENDPOINT'),
        'production' => env('PAYNAMICS_PRODUCTION_ENDPOINT'),
    ],

    'hsbc' => [
        'merchant_id' => env('HSBC_MERCHANT_ID'),
        'name' => env('HSBC_MERCHANT_NAME'),
        'merchant_key' => env('HSBC_MERCHANT_KEY'),
    ],

    'notification_url' => ('PAYNAMICS_NOTIFICATION_URL'),

    'response_url' => env('PAYNAMICS_RESPONSE_URL'),

    'mtac_url' => env('PAYNAMICS_MTAC_URL'),

    'cancel_url' => env('PAYNAMICS_CANCEL_URL'),

    'server_ip' => env('PAYNAMICS_SERVER_IP_ADDRESS'),
];