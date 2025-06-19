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

class CE_Hook
{
	var $hooks = array();
	
	function _load_hooks()
	{
		require(MODULE_DIR.'config/hooks.php');
		
		return $hooks;
	}
	
	function _initialize()
	{
		foreach($this->_load_hooks() as $hook_a => $hook_b)
		{
			$exists = file_exists(MODULE_DIR.'hooks/'.$hook_a.'.php');
			
			if($exists === TRUE)
			{
				require(MODULE_DIR.'hooks/'.$hook_a.'.php');
				
				if(class_exists($hook_a))
				{
					$ob = new $hook_a();
					if($hook_a === "compress")
					{
						ob_start(array($ob,$hook_b));
					}
					else
					{
						if(class_exists($hook_a))
						{
							$hook = new $hook_a();
							$hook = $hook->$hook_b();
						}
						else
						{
							show_error('Class name in your hooks is not found!');
						}
					}
				}
				else
				{
					show_error('Class name in your hooks is not found!');
				}
			}
			else
			{
				show_error('File is not found in your hooks.');
			}
		}
	}
}