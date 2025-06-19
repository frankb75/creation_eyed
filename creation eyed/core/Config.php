<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Config
 *
 * Version: 1.0
 * Author: Enalds
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 */

class CE_Config
{
	var $config = array();
	
	function _load_config($config_name = '')
	{
		require(MODULE_DIR.'config/config.php');
		
		return $config[$config_name];
	}
}