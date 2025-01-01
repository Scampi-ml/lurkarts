<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Streamers extends MY_Controller
{	
	public function __construct()
	{
		parent::__construct();
	}	
	
	public function index()
	{
		$this->out['html_title'] = 'Streamers';
		$this->out['streamers'] = $this->streamer_model->get_all_streamers();
		$this->_render_page("streamers", $this->out);
	}
	
	public function view($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$streamer = $this->streamer_model->get_streamer_by_username($name);
			
			if(!$streamer)
			{
				log_message('error', 'treamers/view -> streamer not found: ' . htmlspecialchars($name));
				show_404();			
			}
			else
			{			
				$this->out['count_raffles_by_streamer_id'] 			= number_format($this->raffle_model->count_raffles_by_streamer_id($streamer->id), 0, '', '.');
				$this->out['count_raffle_wins_by_streamer_id'] 		= number_format($this->raffle_model->count_raffle_wins_by_streamer_id($streamer->id), 0, '', '.');
				$this->out['count_raffle_rejects_by_streamer_id'] 	= number_format($this->raffle_model->count_raffle_rejects_by_streamer_id($streamer->id), 0, '', '.');
				$this->out['count_raffle_users_by_streamer_id'] 	= number_format($this->raffle_model->count_raffle_users_by_streamer_id($streamer->id), 0, '', '.');
				$this->out['streamer'] = $streamer;
				$this->out['html_title'] = ucfirst($name);

				$this->_render_page("view_streamer", $this->out);
			}
		}
		else
		{
			log_message('error', 'streamers/view -> form_validation failed: ' . htmlspecialchars($name));
			show_404();		
		}
	}
}