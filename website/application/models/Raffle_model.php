<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle_model extends CI_Model
{	
	public function __construct()
	{   
		if (!is_cache_valid('servers',60))
		{
			$this->db->cache_delete('raffles');
		}
	}	
	
	public function count_all_raffles()
	{
		$this->db->cache_on();
		return $this->db->count_all('raffles');		
	}
	
	public function count_all_raffles_winners()
	{
		$this->db->cache_on();
		return $this->db->count_all('raffle_wins');		
	}	
	
	public function count_all_raffles_rejects()
	{
		$this->db->cache_on();
		return $this->db->count_all('raffle_rejects');		
	}	
	
	public function count_all_raffles_users()
	{
		$this->db->cache_on();
		return $this->db->count_all('raffle_users');		
	}	
	
	public function count_raffles_by_streamer_id($streamer_id = NULL)
	{
		$this->db->cache_on();
		$this->db->where('streamer_id', $streamer_id);
		$this->db->from('raffles');
		return $this->db->count_all_results();		
	}
	
	public function count_raffle_wins_by_streamer_id($streamer_id = NULL)
	{
		$this->db->cache_on();
		$this->db->where('streamer_id', $streamer_id);
		$this->db->from('raffle_wins');
		return $this->db->count_all_results();		
	}	

	public function count_raffle_rejects_by_streamer_id($streamer_id = NULL)
	{
		$this->db->cache_on();
		$this->db->where('streamer_id', $streamer_id);
		$this->db->from('raffle_rejects');
		return $this->db->count_all_results();
	}	
	
	public function count_raffle_users_by_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->where('streamer_id', $streamer_id);
		$this->db->from('raffle_users');
		return $this->db->count_all_results();
	}

	public function count_users_by_winner_name($card_name = NULL)
	{		
		$this->db->cache_on();
		$this->db->where('card_name', $card_name);
		$this->db->from('raffle_wins');
		return $this->db->count_all_results();
	}

	public function get_raffles_by_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->order_by('id', 'DESC');	
		$this->db->where('streamer_id', $streamer_id);
		$query = $this->db->get('raffles');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}
	
	public function get_raffles_winners_by_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('streamer_id', $streamer_id);
		$query = $this->db->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}	

	public function get_raffles_rejects_by_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('streamer_id', $streamer_id);	
		$query = $this->db->get('raffle_rejects');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}

	public function get_raffles_users_by_streamer_id($streamer_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('streamer_id', $streamer_id);	
		$query = $this->db->get('raffle_users');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}
	
	public function get_raffle_from_raffle_id($raffle_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('raffle_id', $raffle_id);
		$query = $this->db->get('raffles');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->row();
	}
		
	public function get_raffle_users_from_raffle_id($raffle_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('raffle_id', $raffle_id);
		$query = $this->db->get('raffle_users');
		if ($query->num_rows() == 0)
		{
			return [];
		}	
		return $query->result();
	}
	
	public function get_raffle_users_from_raffle_id_joined($raffle_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('cards.id AS card_id, raffle_wins.id AS id1, raffle_wins.raffle_id, raffle_wins.streamer_id, raffle_wins.user, raffle_wins.msg_id, cards.external, cards.card_name');
		$this->db->from('raffle_wins');
		$this->db->join('cards', 'cards.card_name = raffle_wins.card_name');
		$this->db->where('raffle_wins.raffle_id', $raffle_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0)
		{
			return [];
		}	
		return $query->result();
	}	
	
	public function get_raffle_wins_from_raffle_id($raffle_id = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('raffle_id', $raffle_id);
		$query = $this->db->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}

	public function get_unique_raffle_users()
	{
		$this->db->cache_on();
		$this->db->select('COUNT(DISTINCT user) AS users');
		$query = $this->db->get('raffle_users');
		return $query->result_array();
	}
	
	public function get_unique_raffle_winners()
	{
		$this->db->cache_on();
		$this->db->select('COUNT(DISTINCT user) AS users');
		$query = $this->db->get('raffle_wins');
		return $query->result_array();
	}

	public function get_latest_raffles()
	{
		$this->db->cache_on();
		$this->db->select('raffles.streamer_id, raffles.id, raffles.raffle_id, raffles.raffle_start, raffles.raffle_stop, raffles.created_at, streamers.display_name');
		$this->db->from('raffles');
		$this->db->join('streamers', 'streamers.id = raffles.streamer_id');
		$this->db->order_by('raffles.id', 'DESC');
		$this->db->limit(34); 		
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	public function get_latest_raffle_winners()
	{
		$this->db->cache_on();
		$this->db->select('raffle_wins.id, raffle_wins.raffle_id, raffle_wins.streamer_id, raffle_wins.user, raffle_wins.msg_id, raffle_wins.card_name, raffle_wins.created_at, streamers.display_name');
		$this->db->from('streamers');
		$this->db->join('raffle_wins', 'streamers.id = raffle_wins.streamer_id');
		$this->db->order_by('raffle_wins.id', 'DESC');
		$this->db->limit(33); 		
		$query = $this->db->get();
		return $query->result_array();
	}	

	public function get_latest_raffle_rejects()
	{
		$this->db->cache_on();
		$this->db->select('streamers.display_name, raffle_rejects.msg_id, raffle_rejects.streamer_id, raffle_rejects.user, raffle_rejects.created_at, raffle_rejects.id');
		$this->db->from('streamers');
		$this->db->join('raffle_rejects', 'streamers.id = raffle_rejects.streamer_id');
		$this->db->order_by('raffle_rejects.id', 'DESC');
		$this->db->limit(33); 
		$query = $this->db->get();
		return $query->result_array();
	}
}