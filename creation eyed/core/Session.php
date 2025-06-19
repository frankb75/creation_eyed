<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Creation Eyed
 *
 * Version: 1.0
 * Author: Enalds
 *
 * Copyright (c) 2010 - 2012, Creation Eyed.
 *
 */

class CE_Session
{
	function __construct()
	{
		session_start();
	}
	
	function set_userdata($sess = array())
	{
		foreach($sess as $a => $b)
		{
			$_SESSION[$a] = strip_tags($b);
		}
		
		$_SESSION['session_timeout'] = time();
	}
	
	function userdata($sess = NULL)
	{
		if(isset($_SESSION[$sess]) ? TRUE : FALSE)
			return $_SESSION[$sess];
	}
	
	function unset_userdata($sess = NULL)
	{
		unset($_SESSION[$sess]);
	}
	
	function flashdata($sess = NULL)
	{
		if(isset($_SESSION[$sess]) ? TRUE : FALSE)
		{
			$flashdata = $_SESSION[$sess];
			unset($_SESSION[$sess]);
			
			return $flashdata;
		}
	}
	
	function set_flashdata($sess = NULL, $name = NULL)
	{
		session_name("ce_flashdata");
		$_SESSION[$sess] = $name;
		//session_write_close();
	}
}