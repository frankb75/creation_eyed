<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CONTROLLER
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
class CE_Controller
{
	private static $instance;
	
	var $load;
	
	public function __construct()
	{
		self::$instance =& $this;
		$this->load =& load_class('Load','CE_Load');
		$this->segment =& load_class('Uri','CE_URI');
		$this->input =& load_class('Input','CE_INPUT');
		$this->db =& load_class('Database','CE_Database');
		
		$db = $this->db->_db_info('use_database','',TRUE);
		if($db)
		{
			require(BASEPATH.'database/DB.php');
			$this->QModel = new QModel();
		}
		
		require(MODULE_DIR.'config/config.php');
		
		// Session
		if($config['session'] === TRUE)
		{
			$this->session =& load_class('Session','CE_Session');
			$test = isset($_SESSION['session_timeout']) ? $_SESSION['session_timeout'] + $config['session_timeout'] - time() : 0;
			
			// Session Timeout
			if($test < 0)
			{
				session_destroy();
				redirect('site/session_lost');
			}
			else
			{
				// Session Re-Update
				if(isset($_SESSION['session_timeout']) ? $_SESSION['session_timeout'] : "")
				{
					$_SESSION['session_timeout'] = time();
				}
				else
				{
					// No Session Timeout set
				}
			}
		}
	}
	
	public static function &get_instance()
	{
		return self::$instance;
	}
}