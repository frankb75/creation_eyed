<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * URL-HELPER
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
 
/*
 * ------------------------------------------------------
 *  Base URL
 * ------------------------------------------------------
 */
if ( ! function_exists('base_url'))
{
	function base_url($urls='')
	{
		$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$url .= "://" . $_SERVER['HTTP_HOST'];
		$url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
		
		return $url.$urls;
	}
}

/** 
 * Link to theme path
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2011 - 2013, Creation Eyed.
 * @location	What do you want to locate. CSS, IMAGES, FONT and SWF.
 *
 * @since		CE Version 2.0
 *
 * @version		1.0
 */

if ( ! function_exists('themes_url'))
{
	function themes_url($location='')
	{
		if( ! $location)
		{
			echo '
				<div style="background:red; color:#fff; font-size:80%; padding:10px;">
					<b>ERROR:</b>
					<br />
					- There is an error on your themes_url(). You need to input first parameter.
				</div>
			';
		}
		else
		{
			return base_url('themes/default/'.$location);
		}
	}
}

/** 
 * Show the Image
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2011 - 2013, CreationEyed.
 * @location	Image file name, can call id, class and javascript event.
 * @title		Image title.
 * @alt			Image alt.
 * @style		Image added style.
 *
 * @since		CE Version 3.0
 *
 * @version		1.3
 */
if ( ! function_exists('image'))
{
	function image($location='', $title='', $alt='', $style='')
	{
		// Initialization
		$url = base_url('themes/default/images/');
		$url = str_replace("https://", "http://", $url); // Need to removed https to make the getimagesize() run correctly.
		$file_name = '';
		$id = '';
		$class = '';
		$event = '';
		
		if(is_array($location))
		{
			foreach($location as $many => $value)
			{
				if($many == "file")
				{
					$file_name = $value;
				}
				else if($many == "id")
				{
					$id = 'id="'.$value.'"';
				}
				else if($many == "class")
				{
					$class = 'class="'.$value.'"';
				}
				else if($many == "event")
				{
					$event = $value;
				}
				else
				{
					/* DO NOTHING */
				}
			}
		}
		else
		{
			$file_name = $location;
			
		}
		
		// Getting the width and height
		$exists = file_exists(FCPATH.'/themes/default/images/'.$file_name);
		if($exists == TRUE)
		{
			list($width, $height, $type, $attr) = getimagesize($url.'/'.$file_name);
			$width = 'width="'.$width.'"';
			$height = 'height="'.$height.'"';
		}
		else
		{
			$width = '';
			$height = '';
		}
		
		if($title)
			$title = 'title="'.$title.'"';
			
		if($alt) $alt = 'alt="'.$alt.'"';
		else $alt = 'alt=" "';
			
		if($style)
			$style = 'style="'.$style.'"';
		
		$img = '<img '.$id.' '.$class.' src="'.$url.$file_name.'" '.$title.' '.$alt.' '.$width.' '.$height.' '.$style.' '.$event.'/>';
		
		return $img;
	}
}

/* END */