<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();	
	}	
	
	public function not_found()
	{
		$this->out['html_title'] = '404 Page Not Found';
		
		$this->output->set_status_header('404'); 
		
		
		$class = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		
		log_message('error', 'show_404() called: CLASS => '.$class.' -  METHOD => '.$method);
		
		$this->_render_page("not_found", $this->out);
	}
}