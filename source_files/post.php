<?php
error_reporting(E_ALL);

date_default_timezone_set('Europe/Brussels');
$conn_sql = mysqli_connect('127.0.0.1', 'lurkarts_bot', 'lurkarts_bot', 'lurkarts');

$responseBody = file_get_contents('php://input');


//$responseBody = '{"raffle": "6e521409-edab-4d59-90c0-1e01c5ff8b55", "message": "Raffle results: @scampi_ml got Dochter van Hilde \ud83c\udf89 @beanieweeny got IetiePeace \ud83c\udf89"}';


$input_contents = date("F j, Y, g:i a") . " 1- ".$responseBody." \r\n";	
$input_log_file_name = __DIR__ . "/" . date("m-Y") . '_incoming.txt';
file_put_contents($input_log_file_name, $input_contents, FILE_APPEND);


// Decode the JSON string
$data = json_decode($responseBody, true);


// Extracting winners and winning items using regular expressions
preg_match_all('/@(\w+)\sgot\s([^@]+)/', $data['message'], $matches, PREG_SET_ORDER);

$winners = [];
$winning_items = [];

foreach ($matches as $match)
{
    $winners[] = $match[1];
    $winning_items[] = trim($match[2]);
}

$json_array = array();

if(isset($winners[0]) && isset($winning_items[0]))
{
	$winning_item0 = clean_winning_item($winning_items[0]);	
	
	if (!$conn_sql)
	{
		$input_contents = date("F j, Y, g:i a") . " - ".mysqli_error($conn_sql)." \r\n";	
	}
	else
	{
		$sql = "INSERT INTO raffle_wins (raffle_id, winner_name, winner_item) VALUES ('".$data['raffle']."', '".$winners[0]."', '".$winning_item0."')";
	}


	if ($conn_sql->query($sql) === TRUE)
	{
		$input_contents = date("F j, Y, g:i a") . " - SUCCESS Insert Win1 \r\n";
	}
	else
	{
		$input_contents = date("F j, Y, g:i a") . " - ".mysqli_error($conn_sql)." \r\n";	
	}
	
	$input_log_file_name 		=__DIR__ . "/" . date("m-Y") . '_settingslog.txt';
	file_put_contents($input_log_file_name, $input_contents, FILE_APPEND);	
	
}



if(isset($winners[1]) && isset($winning_items[1]))
{
	$winning_item1 = clean_winning_item($winning_items[1]);	
	
	if (!$conn_sql)
	{
		$input_contents = date("F j, Y, g:i a") . " - ".mysqli_error($conn_sql)." \r\n";	
	}
	else
	{
		$sql = "INSERT INTO raffle_wins (raffle_id, winner_name, winner_item) VALUES ('".$data['raffle']."', '".$winners[1]."', '".$winning_item1."')";
	}

	if ($conn_sql->query($sql) === TRUE)
	{
		$input_contents = date("F j, Y, g:i a") . " - SUCCESS Insert Win2 \r\n";
	}
	else
	{
		$input_contents = date("F j, Y, g:i a") . " - ".mysqli_error($conn_sql)." \r\n";	
	}	

	$input_log_file_name 		=__DIR__ . "/" . date("m-Y") . '_settingslog.txt';
	file_put_contents($input_log_file_name, $input_contents, FILE_APPEND);
	
}


echo 'SUCCESS';
header('HTTP/1.1 201 Created');

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
