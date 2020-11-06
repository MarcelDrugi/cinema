<?php

namespace App\Clients;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalClient
{
    public function context()
    {
        return new ApiContext($this->credentials());
    }    

    protected function credentials()
    {
        $clientId     = env('PAYPAL_SANDBOX_CLIENT_ID', '');
        $clientSecret = env('PAYPAL_SANDBOX_SECRET', '');        
        return new OAuthTokenCredential($clientId, $clientSecret);
    }
}

