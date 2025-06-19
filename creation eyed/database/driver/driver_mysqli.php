<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DB
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
class DriverQModel extends CE_Database
{
	// Initialize
	var $query = NULL;
	var $where = NULL;
	
	function QModel_sf($db = NULL, $order_by = NULL, $limit = NULL)
	{
		if(is_array($db))
		{
			$i = 1;
			foreach($db as $many)
			{
				if($i == 1)
				{
					if( ! $many)
					{
						$db_selected = "default";
					}
					else
					{
						$db_selected = $many;
					}
				}
				else if($i == 2)
				{
					if($many)
						$ask = "`".$many."`";
					else
						$ask = "*";
				}
				else if($i == 3)
				{
					$db = $many;
				}
				else
				{
					show_error('There is an error on QModel. Too many array parameters!',TRUE);
				}
				$i++;
			}
		}
		else
		{
			$db_selected = "default";
			$ask = "*";
		}
		
		if($order_by)
		{
			$order_by = "ORDER BY ".$this->escape($order_by)."";
		}
		
		if($limit)
		{
			$limit = "LIMIT ".$this->escape($limit)."";
		}
		
		$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
		$this->query .= "SELECT {$ask} FROM {$db} {$order_by} {$limit}";
		$execute = mysqli_query($conn,$this->query) or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error:</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		
		return $execute;
	}
	
	function QModel_sfwa($db = NULL, $tbl = NULL, $val = NULL, $order_by = NULL, $limit = NULL)
	{
		if(is_array($db))
		{
			$i = 1;
			foreach($db as $many)
			{
				if($i == 1)
				{
					if( ! $many)
					{
						$db_selected = "default";
					}
					else
					{
						$db_selected = $many;
					}
				}
				else if($i == 2)
				{
					$ask = $many;
				}
				else if($i == 3)
				{
					$db = $many;
				}
				else
				{
					show_error('There is an error on QModel. Too many array parameters!',TRUE);
				}
				$i++;
			}
		}
		else
		{
			$db_selected = "default";
			$ask = "*";
		}
		
		if(is_array($tbl) && is_array($val))
		{
			$i = 0;
			foreach($tbl as $cols)
			{
				if($i == 0)
					$this->where .= "{$cols}='".$this->escape($val[$i])."'";
				else
					$this->where .= "AND {$cols}='".$this->escape($val[$i])."'";
				
				$i++;
			}
		}
		else
		{
			if(is_array($tbl) && $val)
			{
				show_error('QModel(sfwa) ERROR: 2nd and 3rd parameter must be array!',TRUE);
			}
			else if($tbl && is_array($val))
			{
				show_error('QModel(sfwa) ERROR: 2nd and 3rd parameter must be array!',TRUE);
			}
			else
			{
				$this->where .= "{$tbl}='".$this->escape($val)."'";
			}
		}
		
		if($order_by)
		{
			$order_by = "ORDER BY ".$this->escape($order_by)."";
		}
		
		if($limit)
		{
			$limit = "LIMIT ".$this->escape($limit)."";
		}

		$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
		$this->query .= "SELECT {$ask} FROM `{$db}` WHERE {$this->where} {$order_by} {$limit}";
		$execute = mysqli_query($conn,$this->query) or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error:</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		
		return $execute;
	}
	
	function QModel_c($var='')
	{
		$count = mysqli_num_rows($var);
		
		return $count;
	}
	
	function QModel_g($var = NULL)
	{
		$execute = mysqli_fetch_array($var);
		
		return $execute;
	}
	
	public function QModel_insert($tbl = NULL, $data = NULL, $connect = NULL)
	{
		if( ! $connect)
		{
			$db_selected = "default";
		}
		else
		{
			$db_selected = $connect;
		}
		
		$cols = NULL;
		$val = NULL;
		$i = 0;
		$count = count($data);
		$this->query = "INSERT INTO `{$tbl}` ";
		
		if($data)
		{
			foreach($data as $a => $b)
			{
				if($i == $count-1)
				{
					$cols .= $this->escape($a);
					$val .= "'".$this->escape($b)."'";
				}
				else
				{
					$cols .= $this->escape($a).",";
					$val .= "'".$this->escape($b)."',";
				}
				$i++;
			}
			
			$this->query .= "({$cols}) VALUES ({$val})";
			
			$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
			$execute = mysqli_query($conn,$this->query) or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error: Unable to Insert</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		}
		else
		{
			show_error("Missing 2nd parameter array(data).",TRUE);
		}

		return $execute;
	}
	
	public function QModel_update($tbl = NULL, $data = NULL, $where = NULL, $connect = NULL)
	{
		if( ! $connect)
		{
			$db_selected = "default";
		}
		else
		{
			$db_selected = $connect;
		}
		
		$cols = NULL;
		$val = NULL;
		$wh = NULL;
		$i = 0;
		$count = count($data);
		$this->query = "UPDATE `{$tbl}` SET ";
		
		if($data)
		{
			foreach($data as $a => $b)
			{
				$increment = explode("+",$b);
				$decrement = explode("-",$b);
				
				if($i == $count-1)
				{
					if(count($increment) == 2)
					{
						if($a == $increment[0])
						{
							$cols .= $this->escape($a)."=".$this->escape($b)."";
						}
						else
						{
							if(strlen($b) <= 0)
								$cols .= $this->escape($a)."=''";
							else
								$cols .= $this->escape($a)."='".$this->escape($b)."'";
						}
					}
					else if(count($decrement) == 2)
					{
						if($a == $decrement[0])
						{
							$cols .= $this->escape($a)."=".$this->escape($b)."";
						}
						else
						{
							if(strlen($b) <= 0)
								$cols .= $this->escape($a)."=''";
							else
								$cols .= $this->escape($a)."='".$this->escape($b)."'";
						}
					}
					else
					{
						if(strlen($b) <= 0)
							$cols .= $this->escape($a)."=''";
						else
							$cols .= $this->escape($a)."='".$this->escape($b)."'";
					}
				}
				else
				{
					if(count($increment) == 2)
					{
						if($a == $increment[0])
						{
							$cols .= $this->escape($a)."=".$this->escape($b).",";
						}
						else
						{
							if(strlen($b) <= 0)
								$cols .= $this->escape($a)."='',";
							else
								$cols .= $this->escape($a)."='".$this->escape($b)."',";
						}
					}
					else if(count($decrement) == 2)
					{
						if($a == $decrement[0])
						{
							$cols .= $this->escape($a)."=".$this->escape($b).",";
						}
						else
						{
							if(strlen($b) <= 0)
								$cols .= $this->escape($a)."='',";
							else
								$cols .= $this->escape($a)."='".$this->escape($b)."',";
						}
					}
					else
					{
						if(strlen($b) <= 0)
							$cols .= $this->escape($a)."='',";
						else
							$cols .= $this->escape($a)."='".$this->escape($b)."',";
					}
				}
				$i++;
			}
			
			if($where)
			{
				$i = 0;
				$wh .= "WHERE ";
				$count = count($where);
				foreach($where as $a => $b)
				{
					if($i == $count-1)
					{
						$wh .= $this->escape($a)."='".$this->escape($b)."'";
					}
					else
					{
						$wh .= $this->escape($a)."='".$this->escape($b)."' AND ";
					}
					$i++;
				}
			}
			
			$this->query .= "{$cols} {$wh}";
			
			$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
			$execute = mysqli_query($conn,$this->query) or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error: Unable to Update</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		}
		else
		{
			show_error("Missing 2nd parameter array(data).",TRUE);
		}
		
		return $execute;
	}
	
	public function QModel_delete($tbl = NULL, $where = NULL, $connect = NULL)
	{
		if( ! $connect)
		{
			$db_selected = "default";
		}
		else
		{
			$db_selected = $connect;
		}
		
		if($where)
		{
			$i = 0;
			$this->where .= " WHERE ";
			foreach($where as $column => $value)
			{
				if($i == 0)
					$this->where .= "".$this->escape($column)."='".$this->escape($value)."'";
				else
					$this->where .= " AND ".$this->escape($column)."='".$this->escape($value)."'";
				
				$i++;
			}
		}
		
		$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
		$execute = mysqli_query($conn,"DELETE FROM `{$tbl}` {$this->where}") or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error: Unable to Delete</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		
		return $execute;
	}
	
	public function QModel_query($content = NULL, $connect = NULL)
	{
		if( ! $connect)
		{
			$db_selected = "default";
		}
		else
		{
			$db_selected = $connect;
		}
		
		$this->query .= "{$content}";
		
		$conn = mysqli_connect($this->_db_info('hostname',$db_selected),$this->_db_info('username',$db_selected),$this->_db_info('password',$db_selected),$this->_db_info('database',$db_selected)) or show_error("Unable to connect to your database!");
		$execute = mysqli_query($conn,$this->query) or show_error("<b>Query:</b><br />".$this->query."<br /><br /><b>Database Error: Unable to Query</b><br />#".mysqli_errno($conn)." - ".mysqli_error($conn),TRUE);
		
		return $execute;
	}
}
/* END */