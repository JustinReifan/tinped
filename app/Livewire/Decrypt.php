<?php

namespace App\Livewire;

use Livewire\Component;

class Decrypt extends Component
{
    public $string, $key, $iv, $result;

    public function Decrypt()
    {
        $remove = str_replace('$mpediaencrypt = \'', '', $this->string);
        $remove = str_replace('\';', '', $remove);
        $remove = trim($remove);
        $explode = explode(' ', $remove);
        // dd($explode);
        $key = str_replace('\'', '', $explode[3] == '0,' ? $explode[2] : $explode[3]);
        $key = str_replace('\',', '', $key);
        $key = str_replace(',', '', $key);
        $iv = str_replace('\'', '', $explode[5] ?? $explode[4]);
        $iv = str_replace('));', '', $iv);
        $ciphering = "AES-256-CBC";
        $options = 0;
        $encryption_iv = $iv;
        $encryption_key = $key;
        // dd($encryption_iv, $explode[0]);
        $decryption = openssl_decrypt($explode[0], $ciphering, $encryption_key, $options, $encryption_iv);
        // cek di $decrypt apakah ada string 'mpedia' jika ada maka decrypt lagi
        $this->result = $decryption;
        if (strpos($decryption, 'mpedia') !== false) {
            $this->dispatch('decrypt', ['string' => $decryption]);
        }
    }
    public function render()
    {
        return view('livewire.decrypt');
    }
}
