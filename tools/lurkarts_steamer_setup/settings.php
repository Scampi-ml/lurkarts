<?php
error_reporting(E_ALL);
ini_set('max_execution_time', '0');
date_default_timezone_set('Europe/Brussels');


// specific data for "vod_downloader"
$tw_api_url 			= 'https://api.twitch.tv/helix/';
$tw_auth_url 			= 'https://id.twitch.tv/oauth2/';
$tw_client_id 			= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$tw_client_secret 		= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$max_streams 			= 7;
$download_dir 			= __DIR__ . '/chat_download/';
$archive_dir 			= __DIR__ . '/chat_archive/';




$db_host				= '192.168.30.228';
$db_user 				= 'xampp';
$db_password 			= 'xampp';
$db_database 			= 'lurkarts';


/*
$db_host 				= '127.0.0.1';
$db_user 				= 'lurkarts_php';
$db_password 			= 'lurkarts_php';
$db_database 			= 'lurkarts';
*/



// broadcasters username & user id
// https://www.streamweasels.com/tools/convert-twitch-username-to-user-id/

$twitch_users = array(
'abulic' 				=> '121935684',
'annelytics' 			=> '61014909', 
'dikkesvekke' 			=> '597601917', 
'elephantje' 			=> '168313211', 
'espe_be' 				=> '57117687', 
'frapsel' 				=> '96671713', 
'ietiegirl2' 			=> '927629631', 
'jnoxx' 				=> '68546404', 
'laagvliet' 			=> '48668213',
'michielvandeweert'		=> '66133267',
'mr_dezz'				=> '80066569',
'twoosie'				=> '531541730',
'foxieke' 				=> '159890911',
'xlobster_' 			=> '233498562',
'rigor_tv' 				=> '639760939'
);


$twitch_users_db = array(
'121935684' 			=> 1, 
'61014909'				=> 2, 
'597601917'				=> 3, 
'168313211'				=> 4, 
'57117687'				=> 5, 
'96671713'				=> 6, 
'927629631'				=> 7, 
'68546404'				=> 8, 
'48668213'				=> 9,  
'66133267'				=> 10, 
'80066569'				=> 11, 
'531541730'				=> 12,
'159890911' 			=> 13,
'233498562' 			=> 14,
'639760939' 			=> 15
);

?>