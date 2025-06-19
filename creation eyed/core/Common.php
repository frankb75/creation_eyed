<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * COMMON
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */

class CE_Common
{
	var $routes;
	var $segment;
	
	function __construct()
	{
		$this->routes =& load_class('Route','CE_Route');
		$this->hooks =& load_class('Hook','CE_Hook');
		$this->config =& load_class('Config','CE_Config');
	}
	
	function initialization()
	{
		require(MODULE_DIR.'config/config.php');
		
		// Set Date Timezone
		@date_default_timezone_set($config['timezone']) or show_error('The timezone you set is not supported. Here are the list of timezone <a href="https://php.net/manual/en/timezones.php" target="_blank">https://php.net/manual/en/timezones.php</a>.');
		
		// GZip
		if($config['gzip'] === TRUE)
			ob_start('ob_gzhandler');
		
		// View source code compress
		if($config['compress'] === TRUE)
		{
			require(BASEPATH.'libraries/Compress.php');
			$ob = new Compress();
			ob_start(array($ob,'sanitize'));
		}
		
		$this->routes->_controller();
		
		// Load Hooks
		if($config['hooks'] === TRUE)
			$this->hooks->_initialize();
		
		// End flush gzip.
		if($config['gzip'] === TRUE)
			ob_end_flush();
		
		// End flush view source code
		if($config['compress'] === TRUE)
			ob_end_flush();
	}
}

/* END */