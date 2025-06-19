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

class CE_INPUT
{
	function _fetch_array(&$array, $index = NULL, $strip_clean = TRUE, $trim_clean = TRUE)
	{
		$a = &$array[$index];
		
		if(is_array($array[$index]))
		{
			$post = array();
			foreach($array[$index] as $key => $val)
			{
				$post[$val] = $this->_fetch_array($array, $val, $strip_clean, $trim_clean);
			}
		}
		else
		{
			if( ! isset($array[$index]))
				return FALSE;
			
			if($strip_clean === TRUE)
				$a = strip_tags($a);			
			
			if($trim_clean === TRUE)
				$a = trim($a);
		}
		
		return $a;
	}
	
	function post($index = NULL, $strip_clean = TRUE, $trim_clean = TRUE)
	{
		return $this->_fetch_array($_POST, $index, $strip_clean, $trim_clean);
	}
	
	function get($index = NULL, $strip_clean = TRUE, $trim_clean = TRUE)
	{
		return $this->_fetch_array($_GET, $index, $strip_clean, $trim_clean);
	}
}