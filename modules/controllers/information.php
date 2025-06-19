<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Information extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("information",$data);
	}
	
	public function bio()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("bio",$data);
	}
	
	public function testimonial()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("testimonial",$data);
	}
	
	public function our_referrals()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("referral",$data);
	}
	
	public function whats_new()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("new_whats",$data);
	}
}
