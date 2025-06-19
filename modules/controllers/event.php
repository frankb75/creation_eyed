<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Zarek Capturing Pure Emotion!";
		
		$this->load->view("event",$data);
	}
	
	public function wedding()
	{
		$data["title"] = "Zarek Capturing Pure Emotion!";
		
		$this->load->view("wedding",$data);
	}
}
