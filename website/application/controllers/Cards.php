<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cards extends MY_Controller
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->out['html_title'] = 'Cards';
		
		$items_per_page = 6;
		$limited = FALSE;
		
		//Encapsulate whole pagination 
		$config['full_tag_open'] = '<ul class="pagination pagination-lg justify-content-center mt-5 mb-0">';
		$config['full_tag_close'] = '</ul>';

		//First link of pagination
		$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';

		//Customizing the “Digit” Link
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';

		//For PREVIOUS PAGE Setup
		$config['prev_link'] = '<i class="fas fa-angle-left"></i>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		//For NEXT PAGE Setup
		$config['next_link'] = '<i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		//For LAST PAGE Setup
		$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';

		//For CURRENT page on which you are
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';		
		
		$card_data['order'] = 'streamer_id';
		$card_data['sortfield'] = 'ASC';
		
		$card_data['start_index '] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$GET_streamer = $this->input->get('streamer', TRUE);
		$GET_rarity = $this->input->get('rarity', TRUE);
		
		if($GET_streamer != false)
		{
			$this->form_validation->set_data(array('streamer' => $GET_streamer));			
			$this->form_validation->set_rules('streamer', 'streamer', 'trim|alpha_dash|min_length[4]|max_length[25]');
			if ($this->form_validation->run() === TRUE)
			{
				$card_data['streamer_id'] = $this->streamer_model->get_streamer_id_by_username($GET_streamer);
				$this->out['current_user'] = $GET_streamer;
				$this->out['html_title'] = 'Cards from '.$GET_streamer;
			}
			else
			{
				log_message('error', 'cards/index/GET_streamer -> form_validation failed: ' . htmlspecialchars($GET_streamer));
				show_404();				
			}
		}

		if($GET_rarity != false)
		{			
			$this->form_validation->set_data(array('rarity' => $GET_rarity));
			$this->form_validation->set_rules('rarity', 'rarity', 'trim|alpha_dash|min_length[5]|max_length[30]');
			if ($this->form_validation->run() === TRUE)
			{
				// hardcoded rarity array, stupid? maybe
				$rarity_array = array('normal', 'radiant', 'holiday');
				
				if (in_array($GET_rarity, $rarity_array))
				{
					$card_data['rarity'] = $GET_rarity;
					$this->out['current_rarity'] = $GET_rarity;
					$this->out['html_title'] = 'Cards by '.$GET_rarity;
				}
				else
				{
					log_message('error', 'raffles/index/GET_rarity -> hardcoded rarity_array failed: ' . htmlspecialchars($GET_rarity));
					show_404();
				}
			}
			else
			{
				log_message('error', 'raffles/index/GET_rarity -> form_validation failed: ' . htmlspecialchars($GET_rarity));
				show_404();				
			}			
		}
		
		$card_data['limit'] = $items_per_page;

		$cards = $this->card_model->get_all_cards($card_data);
		
		$total_rows = $this->card_model->get_true_card_count($card_data);
		// Get a true count of all cards
		$this->out['total_rows'] = $total_rows;
		
		$config['base_url'] = site_url('cards/');
		$config['per_page'] = $items_per_page;
		$config['total_rows'] = $total_rows;
		$config['display_pages'] = TRUE;
		$config['uri_segment'] = 2;
		$config['num_links'] = 2;
		$config['_attributes'] = 'class="page-link"';
		$config['use_page_numbers'] = FALSE;
		$config['enable_query_strings'] = FALSE;
		$config['page_query_string'] = FALSE;
		$config['reuse_query_string'] = TRUE;		
	
        $this->out['cards'] = $cards;
		
		// for the sidebar with sort options
		$this->out['rarities'] = array('normal', 'radiant', 'holiday');
		
		// for the sidebar with sort options
		$this->out['streamers'] = $this->streamer_model->get_all_streamers();	

		$this->pagination->initialize($config);
		$this->out["pagination_links"] = $this->pagination->create_links();

		$this->_render_page("cards", $this->out);
	}
	
	public function view($card_name)
	{
		$card_name = urldecode($card_name);
		
		$this->form_validation->set_data(array('card_name' => $card_name));			
		$this->form_validation->set_rules('card_name', 'card_name', 'trim|callback_allowed_characters|min_length[5]|max_length[120]');
		if ($this->form_validation->run() === TRUE)
		{
			$card_data = $this->card_model->get_card_by_card_name($card_name);
			if(!$card_data)
			{
				log_message('error', 'Card name not found: ' . htmlspecialchars($card_name));
				show_404();				
			}
			else
			{
				$this->out['html_title'] = $card_name;
				$this->out['count_cards_by_winner_name'] = number_format($this->card_model->count_cards_by_winner_name($card_name), 0, '', '.');
				$this->out['get_last_winner_by_card_name'] = $this->card_model->get_last_winner_by_card_name($card_name);
				$this->out['card'] = $card_data;
				$this->out['streamer'] = $this->streamer_model->get_streamer_by_id($card_data->streamer_id);

				$this->_render_page("view_card", $this->out);
			}
		}
		else
		{
			//die('form_validation failed: ' . $card_name);
			log_message('error', 'raffles/view -> form_validation failed: ' . htmlspecialchars($card_name));
			show_404();		
		}
	}
	
	public function holders($card_name)
	{
		$card_name = urldecode($card_name);
		
		$this->form_validation->set_data(array('card_name' => $card_name));			
		$this->form_validation->set_rules('card_name', 'card_name', 'trim|callback_allowed_characters|min_length[5]|max_length[120]');
		if ($this->form_validation->run() === TRUE)
		{
			$card_data = $this->card_model->get_card_by_card_name($card_name);
			if(!$card_data)
			{
				log_message('error', 'Card name not found: ' . htmlspecialchars($card_name));
				show_404();				
			}
			else
			{
				$this->out['html_title'] = $card_name;

				$card_holders = $this->card_model->cards_by_winner_name($card_name);

				if(!$card_holders)
				{
					$this->out['card_holders_by_winner_name'] = false;
				}
				else
				{
					$users = array();
					foreach($card_holders as $holder)
					{
						$users[] = $holder->user;
					}					
					
					// https://stackoverflow.com/questions/13633954/how-do-i-count-occurrence-of-duplicate-items-in-array
					$card_holders_by_count = array_count_values($users);
					arsort($card_holders_by_count);
					$this->out['card_holders_by_winner_name'] = $card_holders_by_count;
				}

				$this->out['card'] = $card_data;
				
				$this->_render_page("view_card_holders", $this->out);
			}
		}
		else
		{
			log_message('error', 'raffles/holders -> form_validation failed: ' . htmlspecialchars($card_name));
			show_404();		
		}
	}	
	
	public function allowed_characters($str)
	{
		return ( ! preg_match("/^([+_-a-zA-Z0-9 ])+$/i", $str)) ? FALSE : TRUE;
	}
}