<?php
return array(
    'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET', ''),

    'settings' => array(
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 3000,
        'log.LogEnabled' => false,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'DEBUG'
    ),
);