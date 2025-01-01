<?php
//29af6bba-289d-4e72-b352-01be9effd503

date_default_timezone_set('Europe/Brussels');
$conn_sql = mysqli_connect('127.0.0.1', 'lurkarts_bot', 'lurkarts_bot', 'lurkarts');


$streamers = array('abulic', 'annelytics', 'dikkeSvekke', 'elephantje', 'espe_be', 'frapsel', 'ietiegirl2', 'jnoxx', 'laagvliet', 'michielvandeweert', 'mr_dezz', 'twoosie');

foreach($streamers as $streamer)
{
	$path = "C:/xampp/htdocs/lurkarts_chat/" . $streamer;

	if ($handle = opendir($path))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ('.' === $file) continue;
			if ('..' === $file) continue;

			echo $file." => ";
			$matches = 0;
			
			$current_uuid4 = uuidv4();
			

			$filename = file_get_contents("C:/xampp/htdocs/lurkarts_chat/".$streamer."/".$file);
			$json = json_decode($filename, true);
			foreach($json['comments'] as $j)
			{
				
				// START RAFFLE
				
				if($j['commenter']['display_name'] == 'lurkarts' && $j['message']['body'] == 'Card raffle incoming, !lurkarts time') 
				{
					$matches++;
				}
				else
				{
					continue;
				}
				
				echo $j['message']['body'] . '<br>';
				
				if( $j['commenter']['display_name'] == 'lurkarts' ) 
				{
					echo $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '<br>';
					die();
				}				
				
			}
			
			if($matches == 0)
			{
				unlink("C:/xampp/htdocs/lurkarts_chat/".$streamer."/".$file);
				echo ' 0 matches found, deleted';
			}
			else
			{
				echo $matches . ' matches found<br>';
				continue;
			}
			echo "<br><br>";
			
		}
		closedir($handle);
	}	
}




die();



/*
$filename = file_get_contents("C:/xampp/htdocs/lurkarts_chat/abulic/1078320202.json");
echo "<br><br>BEGIN<hr>";
echo '<pre>';
$json = json_decode($filename, true);
//var_export($json);
foreach($json['comments'] as $j)
{
	
	if( $j['commenter']['display_name'] == 'lurkarts' ) 
	{
		echo $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '<br>';
		die();
	}
	else
	{
		continue;
	}
}
echo '</pre>';
echo "<hr>END";



*/

















function post_to_post($payload)
{
	$url = 'http://127.0.0.1/lurkarts_chat/post.php';
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload) );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);
	return "<pre>$result</pre>";
}



function clean_winning_item($string)
{
    // remove emoji 
	// Match Enclosed Alphanumeric Supplement
    $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
    $clear_string = preg_replace($regex_alphanumeric, '', $string);

    // Match Miscellaneous Symbols and Pictographs
    $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clear_string = preg_replace($regex_symbols, '', $clear_string);
	
	// remove ending space
    return rtrim($clear_string);
}

function uuidv4()
{
	$data = random_bytes(16);
	$data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
?>