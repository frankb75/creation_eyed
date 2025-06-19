<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CE_Controller
{
	public function index()
	{
		$data['title'] = "404 Page not Found!";
		
		$this->load->view('site/404',$data);
	}
	
	public function session_lost()
	{
		$data['title'] = "Session Timeout";
		
		$this->load->view('site/lost_session',$data);
	}
}