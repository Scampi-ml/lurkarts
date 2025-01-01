<?php

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


$streamer = 'abulic';

$filename = file_get_contents("C:/xampp/htdocs/lurkarts_chat/abulic/2050189316.json");
echo "<br><br>BEGIN<hr>";
echo '<pre>';
$json = json_decode($filename, true);
var_export($json);
foreach($json['comments'] as $j)
{
	$skip1 = false;
	$skip2 = false;
	$skip3 = false;
	

	echo $j['created_at'] . '<br>';
	echo strtotime($j['created_at']) . '<br>';
	
	// ---------------------------------------- START RAFFLE ----------------------------------------
	
	if($j['commenter']['display_name'] == 'lurkarts' && $j['message']['body'] == 'Card raffle incoming, !lurkarts time') 
	{
		echo '<b style="background-color:#CCFEFF">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
		$voters = array();
		
		$skip1 = true;
		
	}

		
	// ---------------------------------------- ADD !LURKARTS ----------------------------------------
	if($j['message']['body'] == '!lurkarts') 
	{
		echo '<b style="background-color:CCFFCD">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
		$voters[] = $j['commenter']['display_name'];
		
		$skip2 = true;
	}

	// ---------------------------------------- END RAFFLE ----------------------------------------
	$pattern = "/Raffle results:/";
	if( $j['commenter']['display_name'] == 'lurkarts' && preg_match($pattern, $j['message']['body']) ) 
	{
		echo '<b style="background-color:#FFCCCB">' . $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '</b><br>';
		print_r($voters);
		print_r(get_winners_from_string($j['message']['body']));
		unset($voters);
		
		$skip3 = true;
	}
	
	if($skip1 OR $skip2 OR $skip3)
	{
		continue;
	}
	else
	{
		echo $j['commenter']['display_name'].' ==> '. $j['message']['body'] . '<br>';
	}

}


echo '</pre>';
echo "<hr>END";



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
		$winning_array[] = array('winner1_name' => $winners[0], 'winner1_item' => clean_winning_item($winning_items[0]));
	}

	if(isset($winners[1]) && isset($winning_items[1]))
	{
		$winning_array[] = array('winner2_name' => $winners[1], 'winner2_item' => clean_winning_item($winning_items[1]));
	}

	if(isset($winners[2]) && isset($winning_items[2]))
	{
		$winning_array[] = array('winner3_name' => $winners[2], 'winner3_item' => clean_winning_item($winning_items[2]));
	}
	
	
	return $winning_array;
}


