<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * QModel
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
class QModel extends CE_Database
{
	function __construct()
	{
		if(file_exists(BASEPATH.'database/driver/driver_'.$this->_db_info('driver').'.php'))
		{
			require(BASEPATH.'database/driver/driver_'.$this->_db_info('driver').'.php');
			
			$conn_id = @mysqli_connect($this->_db_info('hostname','default'),$this->_db_info('username','default'),$this->_db_info('password','default'),$this->_db_info('database','default')) or show_error("Unable to connect to your database!");
		}
		else
		{
			show_error("Unable to load your database driver.");
		}
	}
	
	function sf($db = NULL, $order_by = NULL, $limit = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_sf($db, $order_by, $limit);
		
		return $results;
	}
	
	function sfwa($db = NULL, $tbl = NULL, $val = NULL, $order_by = NULL, $limit = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_sfwa($db, $tbl, $val, $order_by, $limit);
		
		return $results;
	}
	
	function c($var = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_c($var);
		
		return $results;
	}
	
	function g($var = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_g($var);
		
		return $results;
	}
	
	function insert($tbl = NULL, $data = NULL, $connect = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_insert($tbl,$data,$connect);
		
		return $results;
	}
	
	function update($tbl = NULL, $data = NULL, $where = NULL, $connect = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_update($tbl,$data,$where,$connect);
		
		return $results;
	}
	
	function delete($tbl = NULL, $where = NULL, $connect = NULL)
	{
		$query = new DriverQModel();
		$results = $query->QModel_delete($tbl,$where,$connect);
		
		return $results;
	}
	
	function query($content='', $connect='')
	{
		$query = new DriverQModel();
		$results = $query->QModel_query($content,$connect);
		
		return $results;
	}
}
/* END */