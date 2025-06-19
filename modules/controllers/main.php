<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		// FORCE SSL
		if($_SERVER["HTTPS"] != "on")
		{
			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			exit();
		}
		
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("body",$data);
	}
}
