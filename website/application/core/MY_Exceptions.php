<?php defined('BASEPATH') OR exit('No direct script access allowed');

// https://stackoverflow.com/questions/35788552/codeigniter-3-show-404-shows-only-template-file-and-not-controller

class MY_Exceptions extends CI_Exceptions
{
    public $out;
	
	public function show_404($page = 'not_found', $log_error = true)
    {
		$CI = &get_instance();
		$CI->output->set_status_header('404');
		
		$this->out['application_name'] 	= $CI->config->item('application_name');
		$this->out['html_title']		= 'Page Not Found';
		$this->out['html_title_after'] 	= $CI->config->item('html_title_after');
		$this->out['html_meta_data'] 	= $CI->config->item('html_meta_data');
		$this->out['html_content'] 		= $CI->load->view($page, $this->out, TRUE);
		$this->out['cc'] 				= $CI->router->fetch_class();
		$final_output 					= $CI->load->view('_template', $this->out, TRUE);	
		$CI->output->_display($final_output);

		// By default we log this, but allow a dev to skip it		
        if ($log_error)
        {
            log_message('error', 'custom show_404() called');
        }		

		exit(4); // EXIT_UNKNOWN_FILE
    }
}