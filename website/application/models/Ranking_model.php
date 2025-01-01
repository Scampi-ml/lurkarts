<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking_model extends CI_Model
{	
	public function __construct()
	{      
		if (!is_cache_valid('servers',60))
		{
			$this->db->cache_delete('ranking');
		}
	}	
	
	public function get_all_users()
	{
		$this->db->cache_on();
		$this->db->select('*');	
		$query = $this->db->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();		
	}
	
	
	public function get_user_from_raffle_wins($user = NULL)
	{		
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->where('user', $user);
		$query = $this->db->get('raffle_wins');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();
	}	

	public function count_user_from_raffle_wins_by_card_name($user, $card_name)
	{		
		$this->db->cache_on();
		$this->db->where('user', $user);
		$this->db->where('card_name', $card_name);
		$this->db->from('raffle_wins');
		return $this->db->count_all_results();

	}	
}