<?php

error_reporting(E_ALL);

$key = "akbhasinapikey";
$secret = "t5g6j3r8p2x8g5";
$key = "TESTKEY";
$secret = "TESTSECRET";



class OpenApiService{

	public static function call($apiUrl, $secret, $parameters){
		$signature = OpenApiService::sign($parameters, $secret);
		$parameters['signature'] = $signature;
		$postdata = http_build_query($parameters);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//		curl_setopt($ch, CURLOPT_PROXY, '222.246.232.55:80');
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}	
	
	public static function download($apiUrl, $secret, $parameters, $path){
		$signature = OpenApiService::sign($parameters, $secret);
		$parameters['signature'] = $signature;
		$postdata = http_build_query($parameters);
		$fp = fopen($path, 'w');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}
	
	public static function sign($parameters, $secret){
		$signature = '';
		ksort($parameters);
		foreach($parameters as $key=>$value){
			$signature .= $value;
		}
		$signature = $signature . '@' . $secret;
		$signature = md5($signature);
		return $signature;
	}
}

?>
