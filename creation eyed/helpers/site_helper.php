<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SITE-HELPER
 *
 * Copyright (c) 2013, Creation Eyed.
 *
 * Author: Enalds
 *
 * Version: 1.0
 * 
 */
 
/** 
 * Get the header
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2011 - 2013, CreationEyed.
 * @view		Header file name.
 * @css			CSS file name.
 *
 * @since		CE Version 2.0
 *
 * @version		2.1
 */
if ( ! function_exists('get_header'))
{
	function get_header($view='', $css = array(), $css_layout = NULL)
	{
		if( ! $view)
		{
			show_error("Please input first parameter.",TRUE,2);
		}
		else
		{
			$exists = file_exists(FCPATH."/modules/views/{$view}.php");
			if($exists == TRUE)
			{
				$CE =& get_instance();
				
				if( ! is_array($css))
				{
					$data['css'] = array($css);
				}
				else
				{
					$data = array(
						'css' => $css
					);
					
				}
				
				// Layouts
				require(MODULE_DIR.'config/config.php');
				$layout = array('960','960_sticky_footer','full','full_sticky_footer','advertise','advertise_sticky_footer');
				if( ! in_array($config['layout'],$layout))
				{
					show_error('The layout you put in the config file is not supported.',TRUE,2);
				}
				else
				{
					if($css_layout)
						$layout = $data['css_layout'] = $css_layout;
					else
						$layout = $data['css_layout'] = $config['layout'];
						
					if($layout === "960" OR $layout === "advertise")
					{
						$data['css_stylesheet'] = '
							html { overflow-y:scroll; height: 100%; }
							body { font-size:100%; color:#000; margin:0 auto; padding:0; height: 100%; }
							a { color:blue; text-decoration:none; }
							a:hover { text-decoration:underline; }
							img { border:0; }
							table{ border-collapse:collapse }
							.error, .no-js .container { display: none; }
							.no-js .error { display: block; }
							.wrap { float:center; width:100%; height:auto; }
							.header { width:auto; overflow:hidden; }
							.header_body { width:960px; text-align:left; margin:0 auto; }
							.body { background:transparent; height:auto; width:auto; }
							.cont_body { background:#fff; width:960px; margin:0 auto; overflow:hidden; border:1px solid #000; }
							.footer { width:auto; color:#fcd68b; }
							.footer_body { height:94px; width:960px; text-align:center; margin:0 auto; }
						';
					}
					else if($layout === "960_sticky_footer" OR $layout === "advertise_sticky_footer")
					{
						$data['css_stylesheet'] = '
							html { overflow-y:scroll; height: 100%; }
							body { font-size:100%; color:#000; margin:0 auto; padding:0; height: 100%; }
							body > div#root{ height: auto; min-height: 100%; }
							div#root{ height: 100%; }
							section { padding-bottom: 140px; }
							a { color:blue; text-decoration:none; }
							a:hover { text-decoration:underline; }
							img { border:0; }
							table{ border-collapse:collapse }
							.error, .no-js .container { display: none; }
							.no-js .error { display: block; }
							.wrap { float:center; width:100%; height:auto; }
							.header { width:auto; overflow:hidden; }
							.header_body { width:960px; text-align:left; margin:0 auto; }
							.body { background:transparent; height:auto; width:auto; }
							.cont_body { background:#fff; width:960px; margin:0 auto; overflow:hidden; border:1px solid #000; }
							.footer { width:auto; color:#fcd68b; margin-top:-125px; }
							.footer_body { height:94px; width:960px; text-align:center; margin:0 auto; }
						';
					}
					else if($layout === "full")
					{
						$data['css_stylesheet'] = '
							html { overflow-y:scroll; height: 100%; }
							body { font-size:100%; color:#000; margin:0 auto; padding:0; height: 100%; }
							a { color:blue; text-decoration:none; }
							a:hover { text-decoration:underline; }
							img { border:0; }
							table{ border-collapse:collapse }
							.error, .no-js .container { display: none; }
							.no-js .error { display: block; }
							.wrap { float:center; width:100%; height:auto; }
							.header { width:auto; overflow:hidden; }
							.header_body { width:auto; text-align:left; margin:0 auto; }
							.body { background:transparent; height:auto; width:auto; }
							.cont_body { background:#fff; width:auto; margin:0 auto; overflow:hidden; border:1px solid #000; }
							.footer { width:auto; color:#fcd68b; }
							.footer_body { height:94px; width:auto; text-align:center; margin:0 auto; margin-top:10px; }
						';
					}
					else if($layout === "full_sticky_footer")
					{
						$data['css_stylesheet'] = '
							html { overflow-y:scroll; height: 100%; }
							body { font-size:100%; color:#000; margin:0 auto; padding:0; height: 100%; }
							body > div#root{ height: auto; min-height: 100%; }
							div#root{ height: 100%; }
							section { padding-bottom: 140px; }
							a { color:blue; text-decoration:none; }
							a:hover { text-decoration:underline; }
							img { border:0; }
							table{ border-collapse:collapse }
							.error, .no-js .container { display: none; }
							.no-js .error { display: block; }
							.wrap { float:center; width:100%; height:auto; }
							.header { width:auto; overflow:hidden; }
							.header_body { width:auto; text-align:left; margin:0 auto; }
							.body { background:transparent; height:auto; width:auto; }
							.cont_body { background:#fff; width:auto; margin:0 auto; overflow:hidden; border:1px solid #000; }
							.footer { width:auto; color:#fcd68b; margin-top:-125px; }
							.footer_body { height:94px; width:auto; text-align:center; margin:0 auto; }
						';
					}
					else
					{
						show_error('The layout you put in the config file is not supported.',TRUE,2);
					}
				}
				
				$CE->load->view($view,$data);
			}
			else
			{
				show_error("There is no file name like that <b>{$view}.php</b>.",TRUE,2);
			}
		}
	}
}

/** 
 * Get the footer
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2011 - 2013, CreationEyed.
 * @view		Footer file name.
 * @js			JS file name.
 *
 * @since		CE Version 2.0
 *
 * @version		2.0
 */
if ( ! function_exists('get_footer'))
{
	function get_footer($view='', $js = array())
	{
		if( ! $view)
		{
			show_error("Please input first parameter.",TRUE,2);
		}
		else
		{
			$exists = file_exists(FCPATH."/modules/views/{$view}.php");
			if($exists == TRUE)
			{
				if( ! is_array($js))
				{
					$CE =& get_instance();
					
					$data['js'] = array($js);
					
					$CE->load->view($view,$data);
				}
				else
				{
					$CE =& get_instance();
					
					$data = array(
						'js' => $js
					);
					
					$CE->load->view($view,$data);
				}
			}
			else
			{
				show_error("There is no file name like that <b>{$view}.php</b>.",TRUE,2);
			}
		}
	}
}

/** 
 * Password Hashing
 *
 * @author		Enalds
 * @copyright	Copyright (c) 2011 - 2015, CreationEyed.
 * @password	Password.
 *
 * @since		CE Version 3.0
 *
 * @version		1.2
 */ 
if ( ! function_exists('hash_password'))
{
	function hash_password($password = NULL, $hash = "sha512", $salt = "022@ 91#EMMu1A143%%")
	{
		$password = hash($hash,$salt.md5($password));
		
		return $password;
	}
}

/* END */