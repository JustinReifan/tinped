<?php


namespace App\Helpers;


use App\Models\Provider;

class Smm
{

	public function __construct($provider)
	{
		$provider = Provider::where('nama', $provider)->first();
		$this->json = json_decode($provider->json, true);
	}
	public $json;
	public $api_url, $api_id, $api_key, $sign;

	public function profile($data)
	{
		return json_decode($this->connect($this->json['endpoint']['profile'], $data), true);
	}

	public function services($data)
	{
		return json_decode($this->connect($this->json['endpoint']['service'], $data), true);
	}
	public function order($data)
	{
		return json_decode($this->connect($this->json['endpoint']['order'], $data), true);
	}

	public function status($data)
	{
		return json_decode($this->connect($this->json['endpoint']['status'], $data), true);
	}
	public function  refill($data)
	{
		return json_decode($this->connect($this->json['endpoint']['refill'], $data), true);
	}
	public function cancel($data)
	{
		return json_decode($this->connect($this->json['endpoint']['cancel'], $data), true);
	}

	public function refill_status($data)
	{
		return json_decode($this->connect($this->json['endpoint']['refill_status'], $data), true);
	}

	private function connect($end_point, $post)
	{
		// dd($end_point, $post);
		$_post = array();
		if (is_array($post)) {
			foreach ($post as $name => $value) {
				$_post[] = $name . '=' . urlencode($value);
			}
		}
		$ch = curl_init($end_point);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		if (is_array($post)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
		}
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		$result = curl_exec($ch);
		if (curl_errno($ch) != 0 && empty($result)) {
			$result = false;
		}
		curl_close($ch);
		// dd($result);
		return $result;
	}
}
