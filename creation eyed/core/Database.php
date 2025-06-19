<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Database
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
class CE_Database
{
	function _db_info($value=NULL, $var="default", $config=FALSE)
	{
		require(MODULE_DIR.'config/database.php');
		
		if($config)
			return $db[$value];
		else
			return $db[$var][$value];
	}
	
	function conn_id($var="default")
	{
		$db = $this->_db_info('use_database',$var,TRUE);
		
		if($db)
		{
			if($this->_db_info('driver') === "mysqli")
			{
				$conn_id = @mysqli_connect($this->_db_info('hostname',$var),$this->_db_info('username',$var),$this->_db_info('password',$var),$this->_db_info('database',$var)) or show_error("Unable to connect to your database!");
				
				if($this->_db_info('stricton',$var))
					mysqli_query($conn_id,"SET SESSION sql_mode='STRICT_ALL_TABLES'");
			}
			else
			{
				show_error("Unable to load database driver <b>".$this->_db_info('driver',$var)."</b>");
			}
			
			return $conn_id;
		}
		else
		{
			show_error("Unable to use database.");
		}
	}
	
	function escape($value)
	{
		return mysqli_real_escape_string($this->conn_id(),$value);
	}
}