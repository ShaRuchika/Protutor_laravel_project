<?php

namespace App\Library;

date_default_timezone_set('UTC'); 
require_once 'vendor/php-jwt-master/src/BeforeValidException.php';
require_once 'vendor/php-jwt-master/src/ExpiredException.php';
require_once 'vendor/php-jwt-master/src/SignatureInvalidException.php';
require_once 'vendor/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


class Zoom_Api
{
	private $zoom_api_key = 'VJocTzFCRmWwXhTxrUlMlw';
	private $zoom_api_secret = 'lqaGZvSMnJpWAl8Dx6Y1NOTfJuysU9xD4PPl';	
	
	//function to generate JWT
	private function generateJWTKey() {
		$key = $this->zoom_api_key;
		$secret = $this->zoom_api_secret;
		$token = array(
			"iss" => $key,
			"exp" => time() + 3600 //60 seconds as suggested
		);
		return JWT::encode( $token, $secret );
	}	
	
	//function to create meeting
	public function createMeeting($data = array())
	{
		$post_time  = $data['start_date'];
		$start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));

		$createMeetingArray = array();
		if (!empty($data['alternative_host_ids'])) {
			if (count($data['alternative_host_ids']) > 1) {
				$alternative_host_ids = implode(",", $data['alternative_host_ids']);
			} else {
				$alternative_host_ids = $data['alternative_host_ids'][0];
			}
		}


		$createMeetingArray['topic']      = $data['topic'];
		$createMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
		$createMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'UTC';
		$createMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
		$createMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;

		$createMeetingArray['settings']   = array(
			'join_before_host'  => !empty($data['join_before_host']) ? true : false,
			'host_video'        => !empty($data['option_host_video']) ? true : false,
			'participant_video' => !empty($data['option_participants_video']) ? true : false,
			'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
			'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
			'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
			'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
		);

		return $this->sendRequest($createMeetingArray);
	}	
	
	//function to send request
	protected function sendRequest($data)
	{
		//Enter_Your_Email
		//$request_url = "https://api.zoom.us/v2/users/me/meetings";
		$request_url = "https://api.zoom.us/v2/users/mohan.yadav@indiaresults.com/meetings";

		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		
		$postFields = json_encode($data);
		
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $request_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postFields,
			CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (!$response) {
			return $err;
		}
		return json_decode($response);
	}

	
	public function createUser()
	{

		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/users";
		
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);


		$user_data = array(
			'email'         => 'shubham.jangir@indiaresults.com',
			'type'          =>  1,
			'first_name'    => 'shubham',
			'last_name'     => 'jangir',
		);	
		$postFields = json_encode([
			'user_info' => $user_data,
			'action' => 'create',
			'email' => 'shubham.jangir@indiaresults.com',
                'type' => 1, // 1 for a basic user, you can adjust it based on your needs
                'first_name' => 'shubham',
                'last_name' => 'jangir',
                // Add any other user properties as needed
            ]);
		
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $request_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postFields,
			CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (!$response) {
			return $err;
		}
		return json_decode($response);
	}

}

?>