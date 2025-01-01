<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Streamer_model extends CI_Model
{	
	public function __construct()
	{      
		if (!is_cache_valid('servers',60))
		{
			$this->db->cache_delete('raffles');
		}
	}	
	
	public function get_all_streamers()
	{
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->order_by('name', 'ASC');	
		$query = $this->db->get('streamers');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}	
		return $query->result();		
	}
	
	public function get_streamer_by_username($name = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('name', $name)
					->get('streamers');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		return $query->row();		
	}
	
	public function get_streamer_by_id($id = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('id', $id)
					->get('streamers');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		return $query->row();		
	}	
	
	public function get_streamer_id_by_username($name = NULL)
	{
		$this->db->cache_on();
		$query = $this->db->select('*')
					->where('name', $name)
					->get('streamers');
		if ($query->num_rows() == 0)
		{
			return FALSE;
		}
		$row = $query->row();
		return $row->id;
	}
	
    public function get_count()
	{
		$this->db->cache_on();
		return $this->db->count_all('streamers');
    }
}