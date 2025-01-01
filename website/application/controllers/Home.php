<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();	
	}	
	
	public function index()
	{
		$this->out['html_title'] = 'Home';

		$this->out['count_cards'] 		= number_format($this->card_model->get_count(), 0, '', '.');
		$this->out['count_streamers'] 	= number_format($this->streamer_model->get_count(), 0, '', '.');
		$this->out['count_raffels'] 	= number_format($this->raffle_model->count_all_raffles(), 0, '', '.');
		$this->out['count_user'] 		= number_format($this->raffle_model->count_all_raffles_users(), 0, '', '.');
		
		$this->_render_page("home", $this->out);
	}
}