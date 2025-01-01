<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends MY_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ranking_model');
	}	
	
	public function index()
	{
		$this->out['html_title'] = 'Ranking';
		$users = $this->ranking_model->get_all_users();
		
		$winners = array();
		foreach($users as $winner)
		{
			$winners[] = $winner->user;
		}
		
		// https://stackoverflow.com/questions/13633954/how-do-i-count-occurrence-of-duplicate-items-in-array
		$winners = array_count_values($winners);
		arsort($winners);

		$this->out['users'] = $winners;
		
		
		$this->_render_page("ranking", $this->out);
	}

	public function view($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$name_db = $this->ranking_model->get_user_from_raffle_wins($name);
			
			if(!$name_db)
			{
				log_message('error', 'ranking/view => name_db not found: ' . htmlspecialchars($name));
				show_404();			
			}
			else
			{			
				// get all streamers
				$streamers = $this->streamer_model->get_all_streamers();
				
				foreach($streamers as $streamer)
				{
					$streamer->cards = $this->card_model->get_cards_from_streamer_id($streamer->id);
					$streamer->card_count = $this->card_model->count_cards_from_streamer_id($streamer->id);
				}
				
				foreach($streamers as $streamer)
				{
					foreach($streamer->cards as $card)
					{
						$card->win_amount = $this->ranking_model->count_user_from_raffle_wins_by_card_name($name, $card->card_name);
					}
				}
				
				$this->out['streamers'] = $streamers;
				$this->out['rank_name'] = ucfirst($name);
				$this->out['html_title'] = ucfirst($name);

				$this->_render_page("view_ranking_user", $this->out);
			}
		}
		else
		{
			log_message('error', 'ranking/view -> form_validation failed: ' . htmlspecialchars($name));
			show_404();		
		}
	}
}