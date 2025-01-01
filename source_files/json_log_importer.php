<?php
ini_set('max_execution_time', '0');
session_start();

date_default_timezone_set('Europe/Brussels');
$conn_sql = mysqli_connect('127.0.0.1', 'lurkarts_bot', 'lurkarts_bot', 'lurkarts2');

//$streamers = array('abulic');

$streamers = array('abulic', 'annelytics', 'dikkesvekke', 'elephantje', 'espe_be', 'frapsel', 'ietiegirl2', 'jnoxx', 'laagvliet', 'michielvandeweert', 'mr_dezz', 'twoosie');

$streamers2 = array(
	'abulic' 				=> 1, 
	'annelytics'			=> 2, 
	'dikkesvekke'			=> 3, 
	'elephantje'			=> 4, 
	'espe_be'				=> 5, 
	'frapsel'				=> 6, 
	'ietiegirl2'			=> 7, 
	'jnoxx'					=> 8, 
	'laagvliet'				=> 9,  
	'michielvandeweert'		=> 10, 
	'mr_dezz'				=> 11, 
	'twoosie'				=> 12
);

foreach($streamers as $streamer)
{
	$path = "C:/xampp/htdocs/lurkarts_chat/" . $streamer;

	if ($handle = opendir($path))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ('.' === $file) continue;
			if ('..' === $file) continue;

			$matches = 0;
			
			$filename = file_get_contents("C:/xampp/htdocs/lurkarts_chat/".$streamer."/".$file);
			
			echo "BEGIN ------------------------------------------------- ".$file."<br>";
			
			$json = json_decode($filename, true);	

			foreach($json['comments'] as $j)
			{
				$skip1 = false;
				$skip2 = false;
				$skip3 = false;

				// ---------------------------------------- START RAFFLE ----------------------------------------
				if($j['commenter']['display_name'] == 'lurkarts' && $j['message']['body'] == 'Card raffle incoming, !lurkarts time') 
				{
					//echo '<b style="background-color:#CCFEFF">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
					$voters = array();
					
					$_SESSION['uuid4'] = uuidv4();
					
					$sql89 = "SELECT twitch_msg_id FROM raffles WHERE twitch_msg_id = '".$j['_id']."' ";
					$result89 = $conn_sql->query($sql89);
					if ($result89->num_rows == 0)
					{
						$sq7 = "INSERT INTO raffles (twitch_msg_id, streamer_id, raffle_id, raffle_start) VALUES ('".$j['_id']."', '".$streamers2[$streamer]."', '".$_SESSION['uuid4']."', '".strtotime($j['created_at'])."')";
						if ($conn_sql->query($sq7) === TRUE)
						{
							echo 'raffles entry added<br>';
						}
						else
						{
							echo mysqli_error($conn_sql);
							die();						
						}						
					}
					else
					{
						echo 'raffles entry skipped<br>';
					}
					
					$skip1 = true;
				}

				// ---------------------------------------- ADD !LURKARTS ----------------------------------------
				if($j['message']['body'] == '!lurkarts' && isset($_SESSION['uuid4'])) 
				{
					//echo '<b style="background-color:CCFFCD">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
					$voters[] = $j['commenter']['display_name'];
					
					
					$sql90 = "SELECT twitch_msg_id FROM raffle_users WHERE twitch_msg_id = '".$j['_id']."' ";
					$result90 = $conn_sql->query($sql90);
					if ($result90->num_rows == 0)
					{
					
						$sq6 = "INSERT INTO raffle_users (twitch_msg_id, raffle_id, streamer_id, username) VALUES ('".$j['_id']."', '".$streamers2[$streamer]."', '".$_SESSION['uuid4']."', '".$j['commenter']['display_name']."')";
						if ($conn_sql->query($sq6) === TRUE)
						{
							echo 'raffle_users entry added<br>';
						}
						else
						{
							echo mysqli_error($conn_sql);	
							die();
						}
					}
					else
					{
						echo 'raffle_users entry skipped<br>';
					}					
					
					$skip2 = true;
				}
				else if($j['message']['body'] == '!lurkarts') //------------------------------- REJECTED USERS
				{
					//echo '<b style="background-color:8B0000; color:white">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b> - (Message Rejected)<br>';
					
					$sql91 = "SELECT twitch_msg_id FROM raffle_rejects WHERE twitch_msg_id = '".$j['_id']."' ";
					$result91 = $conn_sql->query($sql91);
					if ($result91->num_rows == 0)
					{					
						$sql2 = "INSERT INTO raffle_rejects (twitch_msg_id, streamer_id, username, reject_time) VALUES ('".$j['_id']."','".$streamers2[$streamer]."', '".$j['commenter']['display_name']."', '".strtotime($j['created_at'])."')";
						if ($conn_sql->query($sql2) === TRUE)
						{
							echo 'raffle_rejects entry added<br>';
						}
						else
						{
							echo mysqli_error($conn_sql);
							die();								
						}
					}
					else
					{
						echo 'raffle_rejects entry skipped<br>';
					}
				}
				else
				{
					// do nothing
				}

				// ---------------------------------------- END RAFFLE ----------------------------------------
				$pattern = "/Raffle results:/";
				if( $j['commenter']['display_name'] == 'lurkarts' && preg_match($pattern, $j['message']['body']) ) 
				{
					//echo '<b style="background-color:#FFCCCB">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
					//print_r($voters);
					
					$winners = get_winners_from_string($j['message']['body']);
					
					//print_r($winners);
					
					
					$cntwinners = count($winners);
					
					if($cntwinners > 0)
					{
						foreach($winners as $winnr)
						{
							$sql92 = "SELECT twitch_msg_id FROM raffle_wins WHERE twitch_msg_id = '".$j['_id']."' ";
							$result92 = $conn_sql->query($sql92);
							if ($result92->num_rows < $cntwinners)
							{								
								$sql2 = "INSERT INTO raffle_wins (twitch_msg_id, streamer_id, raffle_id,  winner_name, winner_item, winner_time) VALUES ('".$j['_id']."', '".$streamers2[$streamer]."', '".$_SESSION['uuid4']."', '".$winnr['name']."', '".$winnr['item']."', '".strtotime($j['created_at'])."')";
								if ($conn_sql->query($sql2) === TRUE)
								{
									echo 'raffle_wins entry added<br>';
								}
								else
								{
									echo mysqli_error($conn_sql);
									die();								
								}
							}
							else
							{
								echo 'raffle_wins entry skipped<br>';
							}							
						}						
					}
					
					$sql92 = "SELECT * FROM raffles WHERE raffle_id = '".$_SESSION['uuid4']."' ";
					$result92 = $conn_sql->query($sql92);
					if ($result92->num_rows > 0)
					{	
						$sq4 = "UPDATE raffles SET raffle_stop = '".strtotime($j['created_at'])."'  WHERE raffle_id = '".$_SESSION['uuid4']."' ";
						if ($conn_sql->query($sq4) === TRUE)
						{
							echo 'raffle_stop entry added<br>';
						}
						else
						{
							echo mysqli_error($conn_sql);
							die();								
						}	
					}
					else
					{
						echo 'raffle_stop entry skipped<br>';
					}						
					
					unset($_SESSION['uuid4']);
					
					$skip3 = true;
				}
				
				if($skip1 OR $skip2 OR $skip3)
				{
					continue;
				}
				else
				{
					//echo $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '<br>';
				}
			}
		}
		closedir($handle);
	}	
}

function get_winners_from_string($string)
{
	// Extracting winners and winning items using regular expressions
	preg_match_all('/@(\w+)\sgot\s([^@]+)/', $string, $matches, PREG_SET_ORDER);

	$winners = [];
	$winning_items = [];
	
	$winning_array = [];

	foreach ($matches as $match)
	{
		$winners[] = $match[1];
		$winning_items[] = trim($match[2]);
	}

	if(isset($winners[0]) && isset($winning_items[0]))
	{
		$winning_array[] = array('name' => $winners[0], 'item' => clean_winning_item($winning_items[0]));
	}

	if(isset($winners[1]) && isset($winning_items[1]))
	{
		$winning_array[] = array('name' => $winners[1], 'item' => clean_winning_item($winning_items[1]));
	}

	if(isset($winners[2]) && isset($winning_items[2]))
	{
		$winning_array[] = array('name' => $winners[2], 'item' => clean_winning_item($winning_items[2]));
	}
	
	return $winning_array;
}

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