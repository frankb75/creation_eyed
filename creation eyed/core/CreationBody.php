<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CREATION-BODY
 *
 * Copyright (c) 2015, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.1
 * 
 */
 
/*
 * ------------------------------------------------------
 *  Show 404 Page
 * ------------------------------------------------------
 */
if ( ! function_exists('show_404'))
{
	function show_404()
	{
		$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$url .= "://" . $_SERVER['HTTP_HOST'];
		$url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
		
		header('Location: '.$url.'site');
	}
}

/*
 * ------------------------------------------------------
 *  Redirect
 * ------------------------------------------------------
 */
if ( ! function_exists('redirect'))
{
	function redirect($url2 = NULL, $sess = NULL, $name = NULL, $statusCode = 303)
	{
		if($sess && $name)
		{
			// Set Flashdata
			session_name("ce_flashdata");
			$_SESSION[$sess] = $name;
		}
		
		$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$url .= "://" . $_SERVER['HTTP_HOST'];
		$url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
		header('Location: '.$url.$url2, true, $statusCode);
		die();
	}
}

/*
 * ------------------------------------------------------
 *  Show Error Message
 * ------------------------------------------------------
 */
if ( ! function_exists('show_error'))
{
	function show_error($message = 0, $show_info = FALSE, $num = 3)
	{
		$data['msg'] = $message;
		$data['show_info'] = $show_info;
		$data['num'] = $num;
		
		require(MODULE_DIR.'errors/error.php');
	}
}

/*
 * ------------------------------------------------------
 *  Load Class
 * ------------------------------------------------------
 */
if ( ! function_exists('load_class'))
{
	function &load_class($class='', $name='')
	{
		static $_classes = array();
		
		$exists = file_exists(FCPATH.'/'.BASEPATH.'core/'.$class.'.php');
		
		if($exists === TRUE)
		{
			require(BASEPATH.'core/'.$class.'.php');
		}
		else
		{
			$exists = file_exists(MODULE_DIR.'libraries/'.$class.'.php');
			
			if($exists === TRUE)
			{
				require(MODULE_DIR.'libraries/'.$class.'.php');
			}
			else
			{
				exit('Unable to locate the specified class: '.$class.'.php');
			}
		}
		
		$_classes[$class] = new $name();
		
		return $_classes[$class];
	}
}