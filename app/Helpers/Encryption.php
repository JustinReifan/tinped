<?php


namespace App\Helpers;

class Encryption
{
    public static function encrypt($string)
    {
        $ciphering = "AES-256-CBC";
        $options = 0;
        $encryption_iv = '0896690014860812';
        $encryption_key = "ENCBOSS";
        $encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);
        return $encryption;
    }
    public static function decrypt($string)
    {
        $ciphering = "AES-256-CBC";
        $options = 0;
        $encryption_iv = '0896690014860812';
        $encryption_key = "ENCBOSS";
        $encryption = openssl_decrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);
        return $encryption;
    }
}
