<?php
class TwitchGetUser
{		
	public $tw_access_token;	
	private $tw_api_url 			= 'https://api.twitch.tv/helix/';
	private $tw_auth_url 			= 'https://id.twitch.tv/oauth2/';
	private $tw_client_id 			= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
	private $tw_client_secret 		= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
	
	public function __construct()
	{
		$this->tw_access_token = $this->getTwitchAccessToken();
	}		
		
	public function run($channel_name)
	{
		$stream_data = $this->runCurlCommand('users?login='.$channel_name);
		return $stream_data['data']['0'];
	}
	
	private function runCurlCommand($url)
	{
		//echo 'Running curl stream: '.$url.'<br>';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_AUTOREFERER, 		TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 			0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
		curl_setopt($ch, CURLOPT_URL, 				$this->tw_api_url.$url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 	TRUE);     
		curl_setopt($ch, CURLOPT_HTTPHEADER, 		array
													(
														'Authorization: Bearer '.$this->tw_access_token,
														'Client-ID: '.$this->tw_client_id
													));
		$curl_data = curl_exec($ch);
		curl_close($ch);
		return json_decode($curl_data, true);
	}	
	
	private function getTwitchAccessToken()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 		1);
		curl_setopt($ch, CURLOPT_URL, 				$this->tw_auth_url.'token?client_id='.$this->tw_client_id.'&client_secret='.$this->tw_client_secret.'&grant_type=client_credentials');
		curl_setopt($ch, CURLOPT_POST, 				1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, 		array
													(
														'Content-Type: application/json'
													));
		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, true);
		return $data['access_token'];
	}
}
?>