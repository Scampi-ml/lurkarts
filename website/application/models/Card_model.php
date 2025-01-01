<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Card_model extends CI_Model
{	
	public function __construct()
	{    
		if (!is_cache_valid('servers',60))
		{
			$this->db->cache_delete('raffles');
		}
	}	

    public function get_count()
	{
		$this->db->cache_on();
		return $this->db->count_all('cards');
    }	
	
	public function count_cards_by_winner_name($card_name = NULL)
	{		
		$this->db->cache_on();
		$this->db->where('card_name', $card_name);
		$this->db->from('raffle_wins');
		return $this->db->count_all_results();
	}

	public function cards_by_winner_name($card_name = NULL)
	{		
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('card_name', $card_name)
					->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}	
	
	public function get_cards_from_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('streamer_id', $streamer_id)
					->get('cards');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}

	public function count_cards_from_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->where('streamer_id', $streamer_id);
		$this->db->from('cards');					
		return $this->db->count_all_results();
	}


	public function get_all_cards($data)
	{
		$this->db->cache_on();
		$this->db->order_by($data['order'], $data['sortfield']);	
		if(isset($data['streamer_id']))
		{
			$this->db->where('streamer_id', $data['streamer_id']);
		}
		if(isset($data['rarity']))
		{
			$this->db->where('rarity', $data['rarity']);
		}
		$this->db->limit($data['limit'], $data['start_index ']);		
		$query = $this->db->get('cards');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();			
	}
	

	
	public function get_true_card_count($data)
	{
		$this->db->cache_on();
		$this->db->select('*');
		if(isset($data['streamer_id']))
		{
			$this->db->where('streamer_id', $data['streamer_id']);
		}
		if(isset($data['rarity']))
		{
			$this->db->where('rarity', $data['rarity']);
		}
		$query = $this->db->get('cards');
		return $query->num_rows();		
	}
	
	public function get_card_by_card_name($card_name = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('card_name', $card_name)
					->get('cards');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		return $query->row();		
	}	
	
	public function get_last_winner_by_card_name($card_name = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('card_name', $card_name)
					->order_by('created_at', 'DESC')
					->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		return $query->row();		
	}		
	
	public function get_last_reject_by_card_name($card_name = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('card_name', $card_name)
					->order_by('created_at', 'DESC')
					->get('raffle_rejects');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		return $query->row();		
	}
}