<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Raffles extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->out['html_title'] = 'Raffle Statistics';
			
		$this->out['count_all_raffles'] 			= number_format($this->raffle_model->count_all_raffles(), 0, '', '.');
		$this->out['count_all_raffles_winners'] 	= number_format($this->raffle_model->count_all_raffles_winners(), 0, '', '.');
		$this->out['count_all_raffles_rejects'] 	= number_format($this->raffle_model->count_all_raffles_rejects(), 0, '', '.');
		$this->out['count_all_raffles_users'] 		= number_format($this->raffle_model->count_all_raffles_users(), 0, '', '.');
		
		$get_unique_raffle_users 					= $this->raffle_model->get_unique_raffle_users();
		$this->out['count_unique_raffle_users'] 	= $get_unique_raffle_users[0]['users'];
		
		$get_unique_raffle_winners 					= $this->raffle_model->get_unique_raffle_winners();
		$this->out['count_unique_raffle_winners'] 	= $get_unique_raffle_winners[0]['users'];		
		
		$this->_render_page("raffles_statistics", $this->out);		
	}
	
	public function streamer($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$streamer = $this->streamer_model->get_streamer_by_username($name);
			if(!$streamer)
			{
				log_message('error', 'raffles/streamer -> streamer not found: ' . htmlspecialchars($name));
				show_404();			
			}
			else
			{
				$this->out['get_raffles_by_streamer_id'] = $this->raffle_model->get_raffles_by_streamer_id($streamer->id);
				$this->out['streamer'] = $streamer;
				$this->out['html_title'] = 'Raffles from '.ucfirst($name);

				$this->_render_page("view_raffle_streamer", $this->out);
			}
		}
		else
		{
			log_message('error', 'raffles/streamer -> form_validation failed: ' . htmlspecialchars($name));
			show_404();
		}
	}
	
	public function detail($raffle_id)
	{
		$this->form_validation->set_data(array('raffle_id' => $raffle_id));			
		$this->form_validation->set_rules('raffle_id', 'raffle_id', 'trim|required|alpha_dash|exact_length[36]');
		if ($this->form_validation->run() === TRUE)
		{
			$get_raffle_from_raffle_id = $this->raffle_model->get_raffle_from_raffle_id($raffle_id);
			if(!$get_raffle_from_raffle_id)
			{
				log_message('error', 'raffles/detail -> raffle_id not found: ' . htmlspecialchars($raffle_id));
				show_404();			
			}
			else
			{
				$this->out['get_raffle_from_raffle_id'] 		= $get_raffle_from_raffle_id;
				$this->out['get_raffle_users_from_raffle_id'] 	= $this->raffle_model->get_raffle_users_from_raffle_id($raffle_id);
				$this->out['get_raffle_wins_from_raffle_id'] 	= $this->raffle_model->get_raffle_users_from_raffle_id_joined($raffle_id);
				$this->out['get_streamer_by_id'] 				= $this->streamer_model->get_streamer_by_id($get_raffle_from_raffle_id->streamer_id);

				$this->out['html_title'] = 'Raffle '.$raffle_id;

				$this->_render_page("view_raffle_detail", $this->out);
			}
		}
		else
		{
			log_message('error', 'raffles/detail -> form_validation failed: ' . htmlspecialchars($raffle_id));
			show_404();
		}
	}
	
	public function winners($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$streamer = $this->streamer_model->get_streamer_by_username($name);
			if(!$streamer)
			{
				log_message('error', 'raffles/winners -> streamer not found: ' . htmlspecialchars($name));
				show_404();			
			}
			else
			{
				$get_raffles_winners_by_streamer_id = $this->raffle_model->get_raffles_winners_by_streamer_id($streamer->id);
				if(!$get_raffles_winners_by_streamer_id)
				{
					$this->out['raffle_winners'] = false;
				}
				else
				{
					$winners = array();
					foreach($get_raffles_winners_by_streamer_id as $winner)
					{
						$winners[] = $winner->user;
					}
					
					// https://stackoverflow.com/questions/13633954/how-do-i-count-occurrence-of-duplicate-items-in-array
					$winners = array_count_values($winners);
					arsort($winners);
					
					$this->out['raffle_winners'] = $winners;
				}

				$this->out['streamer'] = $streamer;
				$this->out['html_title'] = 'Raffles winners for '.ucfirst($name);

				$this->_render_page("view_raffle_winners", $this->out);
			}
		}
		else
		{
			log_message('error', 'raffles/winners -> form_validation failed: ' . htmlspecialchars($card_name));
			show_404();
		}
	}

	public function rejects($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$streamer = $this->streamer_model->get_streamer_by_username($name);
			if(!$streamer)
			{
				log_message('error', 'raffles/rejects -> streamer not found: ' . htmlspecialchars($name));
				show_404();			
			}
			else
			{
				$get_raffles_rejects_by_streamer_id = $this->raffle_model->get_raffles_rejects_by_streamer_id($streamer->id);
				if(!$get_raffles_rejects_by_streamer_id)
				{
					$this->out['raffle_rejects'] = false;
				}
				else
				{
					$rejects = array();
					foreach($get_raffles_rejects_by_streamer_id as $reject)
					{
						$rejects[] = $reject->user;
					}
					
					// https://stackoverflow.com/questions/13633954/how-do-i-count-occurrence-of-duplicate-items-in-array
					$rejects = array_count_values($rejects);
					arsort($rejects);
					
					$this->out['raffle_rejects'] = $rejects;
				}

				$this->out['streamer'] = $streamer;
				$this->out['html_title'] = 'Raffles rejects for '.ucfirst($name);

				$this->_render_page("view_raffle_rejects", $this->out);
			}
		}
		else
		{
			log_message('error', 'raffles/rejects -> form_validation failed: ' . htmlspecialchars($card_name));
			show_404();
		}
	}
	
	public function users($name)
	{
		$this->form_validation->set_data(array('name' => $name));			
		$this->form_validation->set_rules('name', 'name', 'trim|alpha_dash|min_length[4]|max_length[25]');
		if ($this->form_validation->run() === TRUE)
		{
			$streamer = $this->streamer_model->get_streamer_by_username($name);
			if(!$streamer)
			{
				log_message('error', 'raffles/users -> streamer not found: '.htmlspecialchars($name));
				show_404();			
			}
			else
			{
				$get_raffles_users_by_streamer_id = $this->raffle_model->get_raffles_users_by_streamer_id($streamer->id);
				if(!$get_raffles_users_by_streamer_id)
				{
					$this->out['raffle_users'] = false;
				}
				else
				{
					$users = array();
					foreach($get_raffles_users_by_streamer_id as $user)
					{
						$users[] = $user->user;
					}
					
					// https://stackoverflow.com/questions/13633954/how-do-i-count-occurrence-of-duplicate-items-in-array
					$users = array_count_values($users);
					arsort($users);
					
					$this->out['raffle_users'] = $users;
				}

				$this->out['streamer'] = $streamer;
				$this->out['html_title'] = 'Raffles users for '.ucfirst($name);

				$this->_render_page("view_raffle_users", $this->out);				
			}
		}
		else
		{
			log_message('error', 'raffles/users -> form_validation failed: '.htmlspecialchars($card_name));
			show_404();
		}
	}
}