<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->out['html_title'] = 'FAQ';

		$this->_render_page("faq", $this->out);		
	}
}