<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Creation Eyed
 *
 * Version: 1.0
 * Author: Enalds
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 */

class CE_Route
{
	var $route = array();
	var $CE;
	
	function _default_controller()
	{
		require(MODULE_DIR.'config/routes.php');
		
		return $route['default_controller'];
	}
	
	function _routes()
	{
		require(MODULE_DIR.'config/routes.php');
		
		return $route;
	}
	
	function _controller()
	{
		$CE = get_instance();
		$main_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https://" : "http://");
		$main_url .= $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];
		$new_main_url = str_replace(base_url(),'',$main_url);
		$segments = explode('/', $new_main_url);
		$segments_count = count($segments);
		$seg0 = explode("?",$segments[0]);
		$segments0 = $seg0[0];
		if($segments_count > 1)
		{
			$seg1 = explode("?",$segments[1]);
			$segments1 = $seg1[0];
		}
		else
		{
			$segments1 = NULL;
		}
		
		if( ! $segments0) // If blank
		{
			$exists = file_exists(MODULE_DIR.'controllers/'.$this->_default_controller().'.php');
			
			if($exists === TRUE)
			{
				require(MODULE_DIR.'controllers/'.$this->_default_controller().'.php');
				
				if(class_exists($this->_default_controller()))
				{
					$class_name = $this->_default_controller();
					$main = new $class_name;
					
					if($segments_count == 1)
					{
						$main->index();
					}
					else
					{
						if(method_exists($class_name,$segments1))
						{
							$function_name = $segments1;
							$main->$function_name();
						}
						else
						{
							show_404();
						}
					}
				}
				else
				{
					exit('Unable to load the specified class: '.$this->_default_controller());
				}
			}
			else
			{
				show_404();
			}
		}
		else
		{
			$exists = file_exists(MODULE_DIR.'controllers/'.$segments0.'.php');
			
			if($exists === TRUE)
			{
				require(MODULE_DIR.'controllers/'.$segments0.'.php');
				
				if(class_exists($segments0))
				{
					$class_name = $segments0;
					$main = new $class_name;
					
					if($segments_count == 1)
					{
						if(method_exists($class_name,'index'))
						{
							$main->index();
						}
						else
						{
							show_404();
						}
					}
					else
					{
						if(method_exists($class_name,$segments1))
						{
							$param = array();
							$function_name = $segments1;
							
							if($segments_count >= 3)
							{
								$i = 0;
								foreach($segments as $seg)
								{
									// Ignore 0 and 1
									if($i > 1)
									{
										$remove_get = explode("?",$seg);
										$param[$i] = $remove_get[0];
									}
										
									$i++;
								}
							}
							
							call_user_func_array(array($main, $function_name), $param);
						}
						else
						{
							show_404();
						}
					}
				}
				else
				{
					exit('Unable to load the specified class: '.$segments0);
				}
			}
			else
			{
				$main = FALSE;
				$class = NULL;
				$func = "index";
				$param = NULL;
				
				foreach($this->_routes() as $url => $value)
				{
					$value = explode('/',$value);
					$exact_url = explode('?',$segments[0]);
						
					if($url == $exact_url[0])
					{
						$main = TRUE;
						
						if(count($value) == 1)
						{
							$class = $value[0];
						}
						else
						{
							$class = $value[0];
							$func = $value[1];
							
							if(count($value) > 1)
							{
								$i = 0;
								$ii = 0;
								foreach($value as $seg)
								{
									if($seg === "$" && $segments_count >= 2)
									{
										if($ii <= $segments_count)
										{
											$remove_get = explode("?",$segments[$i+1]);
											$param[$i] = $remove_get[0];
											$i++;
										}
									}
									
									$ii++;
								}
							}
						}
						break;
					}
				}
				
				if($main)
				{
					require(MODULE_DIR.'controllers/'.$class.'.php');
					
					if(class_exists($class))
					{
						$route_class = new $class;
					
						if(method_exists($class,$func))
						{
							if($param)
							{
								call_user_func_array(array($route_class, $func), $param);
							}
							else
							{
								$route_class->$func();
							}
						}
					}
					else
					{
						exit('Unable to load the specified class: '.$class);
					}
				}
				else
				{
					show_404();
				}
			}
		}
	}
}