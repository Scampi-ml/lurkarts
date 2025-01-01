<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Latest extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();	
	}	
	
	public function index()
	{
		$this->out['html_title'] = 'Latest';
		
		$latest_raffles 		= $this->raffle_model->get_latest_raffles();
		$latest_raffle_winners 	= $this->raffle_model->get_latest_raffle_winners();
		$latest_raffle_rejects 	= $this->raffle_model->get_latest_raffle_rejects();
		
		$arr1 = array();
		$arr2 = array();
		$arr3 = array();
		
		foreach($latest_raffles as $raffles)
		{
			$raffles['type'] = "raffles";
			$arr1[] = $raffles;
		}
		
		foreach($latest_raffle_winners as $raffle_winners)
		{
			$raffle_winners['type'] = "raffle_winners";
			$arr2[] = $raffle_winners;	
		}
		
		foreach($latest_raffle_rejects as $raffle_rejects)
		{
			$raffle_rejects['type'] = "raffle_rejects";
			$arr3[] = $raffle_rejects;	
		}

		$originalArray = array_merge($arr1, $arr2, $arr3);

		foreach ($originalArray as $key => $part)
		{
			$sort[$key] = strtotime($part['created_at']);
		}
		array_multisort($sort, SORT_DESC, $originalArray);	

		
		//echo '<pre>';
		//var_export($originalArray);
		//die();
		
		$this->out['latest_actions'] = $originalArray;

		$this->_render_page("latest", $this->out);
	}
}