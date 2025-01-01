<?php defined('BASEPATH') OR exit('No direct script access allowed');

// The basic name of this script, this will be used all over the site, First Capital letter is allowed and preferd
$config['application_name'] = 'Lurkarts';

// If you want to add a text or version behind the 'site_title' like:  - Something Behind or a version or whatever
$config['html_title_after'] = ' | Lurkarts';


// Other meta data
$config['html_meta_data'] = array
(
	array(
			'name' => 'Content-type',
			'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
	),
	array(
			'name' => 'X-UA-Compatible',
			'content' => 'IE=edge', 'type' => 'equiv'
	),	
	array(
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'
	),	
	array(
			'name' => 'description',
			'content' => 'Lurkarts is a FREE tradable card game for Twitch lurkers.'
	),
	array(
			'name' => 'keywords',
			'content' => 'twitch,lurkarts'
	),
	array(
			'name' => 'robots',
			'content' => 'all, notranslate'
	),	
	array(
			'name' => 'author',
			'content' => 'scampi_ml'
	),
);