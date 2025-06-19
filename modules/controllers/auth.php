<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CE_Controller
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
		
		if($_POST)
		{
			$submit = $this->input->post('submit');
			
			if( ! $submit )
			{
				redirect('404');
			}
			else
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				
				$data['username'] = $username;
				$data['password'] = $password;
				
				$filter = $this->load->validation(
					array(
							'required|USERNAME|Username|4|20' => $username,
							'required|E|Password|6|32' => $password
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$query = $this->QModel->sfwa(
						'admin_login',
						array('username','password'),
						array($username,hash_password($password))
					);
					$count = $this->QModel->c($query);
					if($count == 0)
					{
						$data['error'] = "Wrong username or password!";
					}
					else
					{
						$userdata = array(
							'admin' => $username,
						);
						$this->session->set_userdata($userdata);
						
						redirect('admin');
					}
				}
				
			}
		}
		
		$this->load->view("admin/login",$data);
	}
	
	public function logout()
	{
		if($this->session->userdata('admin')){
			$user = $this->session->userdata('admin');
			
			$this->session->unset_userdata('admin');
			redirect('auth');
		}else{
			redirect('404');
		}
	}
}
