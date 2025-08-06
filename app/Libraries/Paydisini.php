<?php

namespace App\Libraries;

use App\Models\Config;
use Exception;
use Illuminate\Support\Str;
use Drnxloc\LaravelHtmlDom\HtmlDomParser;

use DOMDocument;

class Paydisini
{
    public function __construct()
    {
        $config = Config::first();
        $decode = json_decode($config->provider_payment, true);
        $paydisini = $decode['paydisini'];
        $this->apiKey = $paydisini['api_key'];
        $this->api_id = $paydisini['api_id'];
        $this->merchant_id = $paydisini['merchant_id'];
    }
    public $apiKey, $api_id, $merchant_id;
    public function create($unique_code, $service, $amount, $valid_time, $phone)
    {
        $singnature = md5($this->apiKey . $unique_code . $service . $amount . $valid_time . 'NewTransaction');
        $data = [
            'key' => $this->apiKey,
            'merchant_id' => $this->merchant_id,
            'api_id' => $this->api_id,
            'request' => 'new',
            'return_url' => url('return-invoice'),
            'unique_code' => $unique_code,
            'service' => $service,
            'amount' => $amount,
            'note' => 'Pembayaran',
            'valid_time' => $valid_time,
            'type_fee' => 2,
            'ewallet_phone' => rand(1000000000, 9999999999),
            'signature' => $singnature,
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://paydisini.co.id/api/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function service()
    {
        $data = [
            'key' => $this->apiKey,
            'request' => 'payment_channel',
            'signature' => md5($this->apiKey . 'PaymentChannel'),
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.paydisini.co.id/v1/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function batalkan($trxid)
    {
        $data = [
            'key' => $this->apiKey,
            'request' => 'cancel',
            'unique_code' => $trxid,
            'signature' => md5($this->apiKey . $trxid . 'PaymentChannel'),
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.paydisini.co.id/v1/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
