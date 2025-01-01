<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{	
	public $out;
	
	function __construct()
	{
		parent::__construct();
		
		$this->out['application_name'] 		= $this->config->item('application_name');
		$this->out['html_title']			= '';
		$this->out['html_title_after'] 		= $this->config->item('html_title_after');
		$this->out['html_meta_data'] 		= $this->config->item('html_meta_data');
		
		$this->do_cache_cleanup();
	}
	
	public function _render_page($view, $data = NULL)
	{
		$this->out['html_content'] 			= $this->load->view($view,$this->out, TRUE);
		$this->out['cc'] 					= $this->router->fetch_class();
		$final_output 						= $this->load->view('_template', $this->out, TRUE);	

		$this->output->_display($final_output);	
	}
	
	private function do_cache_cleanup()
	{
		$cache = $this->cache->file->get("timer.cache");
		if ($cache !== FALSE)
		{
		   // no nothing
		}
		else
		{
			$this->db->cache_delete_all();
			$this->cache->file->save("timer.cache" , 'foo', 3600);
		}
	}
}