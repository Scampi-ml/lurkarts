<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Beta extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->out['html_title'] = 'Beta';

		$this->_render_page("beta", $this->out);		
	}
}