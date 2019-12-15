<?php


namespace App\Http\Utils;


class ApiUtil
{

	public static function generateSmsCode() : string {
		$min = pow(10, 3);
		$max = pow(10, 4) - 1;
		return rand($min, $max);
	}

	public static function sendAuthSms(string $phone, string $code){
		$data = array
		(
			'recipient' => $phone,
			'text' => 'Код авторизации TAKON: ' . $code,
			'apiKey' => 'b60ce3cf8697fa6d2ef145c429eea815128dc7ca'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-type: application/x-www-form-urlencoded'
		));
		curl_setopt($ch, CURLOPT_URL, "https://api.mobizon.kz/service/Message/SendSMSMessage/");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		curl_close($ch);
	}

}