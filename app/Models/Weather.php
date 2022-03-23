<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
	
	public static function get_weahter($locale, $ip){
		if($locale == ""){
			try{
				$data = \Location::get($ip);
				$data=(array)$data;
				$locale=$data['cityName'];
			}catch(Exception $e){
				echo json_encode(array("message"=>"You must enter a city."));
				return;
			}
		}
		$locale = str_replace(array(' ','%20'),'',$locale);
		
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://weatherapi-com.p.rapidapi.com/current.json?q=".$locale,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"X-RapidAPI-Host: weatherapi-com.p.rapidapi.com",
				"X-RapidAPI-Key: 525584a105msh536db538e5379f6p1ebed8jsn49422b035f19"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo json_encode(array("message"=>"cURL Error #:" . $err));
		} else {
			echo $response;
		}
	}
}
