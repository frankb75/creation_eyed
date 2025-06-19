<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Creation Eyed
 *
 * Version: 1.2
 * Author: Enalds
 *
 * Copyright (c) 2010 - 2012, Creation Eyed.
 *
 */

class CE_URI
{
	function uri($number = 0)
	{
		$main_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https://" : "http://");
		$main_url .= $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
		$new_main_url = str_replace(base_url(),'',$main_url);
		
		$segments = explode('/', $new_main_url);
		$count_segment = count($segments);
		
		if($number < $count_segment)
		{
			$uris = explode("?",$segments[$number]);
			$uri = $uris[0];
		}
		else
		{
			$uri = FALSE;
		}
		
		return $uri;
	}
}