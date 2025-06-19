<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initialization
{
	var $CE;
	var $segment;
	var $no_session;
	var $admin;
	var $guest;
	
	function is_authorized()
	{
		$CE =& get_instance();
		
		$this->no_session = array('','main');
		$this->admin = array('');
		$this->guest = array('admin');
		
		$this->segment = new CE_URI();
		$url = $this->segment->uri(1);
		
		if(in_array($url, $this->no_session))
		{
			if($CE->session->userdata('admin'))
			{
				// DO NOTHING
			}
		}
		else
		{
			if($CE->session->userdata('admin')){
				if(in_array($url, $this->admin)){
					// DO NOTHING
				}else{
					// DO NOTHING
				}
			}
			else
			{
				if(in_array($url, $this->guest)){
					redirect('404');
				}else{
					// DO NOTHING
				}
			}
		}
	}
}