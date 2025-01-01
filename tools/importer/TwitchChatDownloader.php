<?php
require_once('settings.php');

class TwitchChatDownloader
{	
	private $tw_access_token;
	public $tw_api_url;
	public $tw_auth_url;
	public $tw_client_id;
	public $tw_client_secret;
	public $max_streams;
	public $download_dir;
	public $twitch_users;

	public function runFirst()
	{	
		$this->tw_access_token = $this->getTwitchAccessToken();

		foreach($this->twitch_users as $key=>$val)
		{
			if (!file_exists($this->download_dir . $val))
			{
				mkdir($this->download_dir . $val);
			}
		}
	}
	
	public function run()
	{		
		$this->runFirst();
		
		echo '<pre>';
		echo 'START run() <br>';
		echo '------------------------------------------------------------<br>';
		
		foreach($this->twitch_users as $tw_username => $tw_userid)
		{
			echo 'Start loop for ' . $tw_username . '...<br>';
			
			$strm_data =  $this->getStreamData($tw_userid);
			
			echo '---------------<br>';

			foreach($strm_data as $video_data)
			{
				$vodid = $video_data['id'];
				
				$curr_file = $this->download_dir . $tw_userid . '/' . $vodid . '.json';
								
				if(file_exists($curr_file))
				{
					echo 'Vod already exists, skipping<br>';
				}					
				else
				{
					echo "Downloading VOD: " . $vodid.'<br>';
					echo $this->downloadChatFile($vodid, $tw_userid);
					echo "............... done<br>";						
				}
			}
			echo '---------------<br>';
			echo 'Loop finished...<br><br>';
		}
		
		echo 'All loops finished...<br>';
		echo '------------------------------------------------------------<br>';
		echo 'END run()';
	}

	private function getStreamData($twitch_user_id)
	{
		echo "Getting stream data for user ".$twitch_user_id."...<br>";
		$stream_data = $this->runCurlCommand('videos?user_id=' . $twitch_user_id . '&first=' . $this->max_streams . '&type=archive');
		return $stream_data['data'];
	}	
	
	private function downloadChatFile($vodid, $twitch_user_id)
	{
		try
		{
			echo $this->download_dir . $twitch_user_id . '/' . $vodid . '.json<br>';
			return exec('TwitchDownloaderCLI.exe chatdownload --id ' . $vodid . ' -o ' . $this->download_dir . $twitch_user_id . '/' . $vodid . '.json --threads 4');
		}
		catch (Exception $e)
		{
			return $e->getMessage();
		}	
	}	
	
	private function runCurlCommand($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_AUTOREFERER, 		TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 			0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
		curl_setopt($ch, CURLOPT_URL, 				$this->tw_api_url . $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 	TRUE);     
		curl_setopt($ch, CURLOPT_HTTPHEADER, 		array
													(
														'Authorization: Bearer ' . $this->tw_access_token,
														'Client-ID: ' . $this->tw_client_id
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
		curl_setopt($ch, CURLOPT_URL, 				$this->tw_auth_url . 'token?client_id=' . $this->tw_client_id . '&client_secret=' . $this->tw_client_secret . '&grant_type=client_credentials');
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

$tcd = new TwitchChatDownloader();

$tcd->tw_api_url 			= $tw_api_url;
$tcd->tw_auth_url 			= $tw_auth_url;
$tcd->tw_client_id 			= $tw_client_id;
$tcd->tw_client_secret 		= $tw_client_secret;
$tcd->max_streams			= $max_streams;
$tcd->download_dir			= $download_dir;
$tcd->twitch_users			= $twitch_users;

$tcd->run();
?>