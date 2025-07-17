<?php

namespace App\Libraries;

use Exception;
use App\Models\User;
use App\Models\Config;

class Duitku
{
    public function __construct()
    {
        $config = Config::first();
        $decode = json_decode($config->provider_payment, true);
        $duitku = $decode['duitku'];
        $this->apiKey = $duitku['api_key'];
        $this->merchantCode = $duitku['merchant_code'];
    }

    public $apiKey, $merchantCode;

    public function create($merchantRef, $method, $price, $data, $return_url = null)
    {
        $user = User::find($data['id'] ?? null);

        $params = array(
            'paymentAmount'     => $price,
            'paymentMethod'     => $method,
            'merchantOrderId'   => $merchantRef,
            'productDetails'    => "Deposits",
            'customerVaName'    => $user->name ?? 'Guest',
            'email'             => $user->email ?? $data['email'],
            'callbackUrl'       => url('api/callback/duitku'),
            'returnUrl'         => $return_url,
        );

        $duitkuConfig = new \Duitku\Config($this->apiKey, $this->merchantCode);
        $duitkuConfig->setSandboxMode(true); // Set to false for production

        try {
            // createInvoice Request
            $responseDuitkuApi = \Duitku\Api::createInvoice($params, $duitkuConfig);
            header('Content-Type: application/json');

            $result = json_decode($responseDuitkuApi);

            if ($result->statusCode == 00) {
                return $result;
            } else {
                throw new Exception($result->statusMessage);
            }
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
