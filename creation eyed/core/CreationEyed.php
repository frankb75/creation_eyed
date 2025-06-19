<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CREATION-EYED
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
 *  Creation Eyed version
 * ------------------------------------------------------
 */
	define('CE_VERSION', 'BETA 1.0');

/*
 * ------------------------------------------------------
 *  Load Global functions
 * ------------------------------------------------------
 */
	require(MODULE_DIR.'config/constant.php');

/*
 * ------------------------------------------------------
 *  URL Restriction
 * ------------------------------------------------------
 */
	$allowed_uri_chars = 'a-z 0-9~%.:_\-';
	$uri = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	$uri .= "://" . $_SERVER['HTTP_HOST'].''.$_SERVER["REQUEST_URI"];
	$uri .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	
	$a = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','9','8','7','6','5','4','3','2','1','~','%','.',':','_','-','/','?','&','=','+','|');

	$uri = str_replace($a, '', $uri);
	
	if( $uri && ! preg_match("|^[".str_replace(array('\\-', '\-'), '-', preg_quote($allowed_uri_chars, '-'))."]+$|i", $uri))
	{
		exit('The URI you submitted has disallowed characters.');
	}
	
/*
 * ------------------------------------------------------
 *  No Description
 * ------------------------------------------------------
 */
	require(BASEPATH.'helpers/url_helper.php');
	require(BASEPATH.'helpers/site_helper.php');
	require(BASEPATH.'core/Controller.php');
	
	function &get_instance()
	{
		return CE_Controller::get_instance();
	}
	
	$URI =& load_class('Common','CE_Common');
	$URI->initialization();