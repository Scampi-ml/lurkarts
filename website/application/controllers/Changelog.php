<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Changelog extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->out['html_title'] = 'Changelog';

		$this->_render_page("changelog", $this->out);		
	}
}