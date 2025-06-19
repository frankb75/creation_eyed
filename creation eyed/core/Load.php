<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Creation Eyed
 *
 * Version: 1.1
 * Author: Enalds
 *
 * Copyright (c) 2010 - 2015, Creation Eyed.
 *
 */

class CE_Load
{
	var $cache_vars = array();
	
	function view($file='', $data=array())
	{
		if(empty($file))
		{
			show_error('Please specify your file name!');
		}
		else
		{
			$exists = file_exists(FCPATH.'/'.MODULE_DIR.'views/'.$file.'.php');
			
			if($exists === TRUE)
			{
				$instance =& get_instance();
				foreach(get_object_vars($instance) as $key => $var)
				{
					if( ! isset($this->$key))
					{
						$this->$key =& $instance->$key;
					}
				}
				
				$this->cache_vars = array_merge($this->cache_vars,$data);
				extract($this->cache_vars);
				
				require(FCPATH.'/modules/views/'.$file.'.php');
			}
			else
			{
				show_error('Wrong file location');
			}
		}
	}
	
	function library($file='')
	{
		if(empty($file))
		{
			show_error('Please specify your file name!');
		}
		else
		{
			$exists = file_exists(FCPATH.'/'.BASEPATH.'libraries/'.$file.'.php');

			if($exists === TRUE)
			{
				$data = array();
				$this->cache_vars = array_merge($this->cache_vars,$data);
				extract($this->cache_vars);
				return include(FCPATH.'/'.BASEPATH.'libraries/'.$file.'.php');
			}
			else
			{
				$exists2 = file_exists(FCPATH.'/'.MODULE_DIR.'libraries/'.$file.'.php');
				
				if($exists2 === TRUE)
				{
					$data = array();
					$this->cache_vars = array_merge($this->cache_vars,$data);
					extract($this->cache_vars);
					return include(FCPATH.'/'.MODULE_DIR.'libraries/'.$file.'.php');
				}
				else
				{
					show_error('Wrong file location');
				}
			}
		}
	}
	
	function validation($value = array())
	{
		foreach($value as $key => $filter)
		{
			$ex = explode("|",$key);
			
			if(count($ex) < 3)
			{
				show_error("<b>Validation Helper Error:</b> <br /><br />Missing parameters.",TRUE,2);
			}
			else
			{
				if( ! strlen($filter))
				{
					if($ex[0] === "required")
					{
						if($ex[1] === "ES")
						{
							$msg = "Please select {$ex[2]}.";
						}
						else if($ex[1] === "ER")
						{
							$msg = "Please choose {$ex[2]}.";
						}
						else
						{
							$msg = "Please fill up {$ex[2]}.";
						}
						
						return $msg;
					}
					else if($ex[0] === "not")
					{
						// Do Nothing
					}
					else
					{
						show_error("<b>Validation Helper Error:</b> <br /><br />First parameter must be `required` or `not` only.",TRUE,2);
					}
				}
				else
				{
					if(count($ex) == 3)
					{
						$ex[3] = 0;
						$ex[4] = 99999999999;
					}
					
					if(strlen($filter) > $ex[4] OR strlen($filter) < $ex[3])
					{
						$msg = "{$ex[2]} must be between {$ex[3]} - {$ex[4]} characters only.";
						
						return $msg;
					}
					else
					{
						if($ex[1] === "STR")
						{
							if( ! preg_match(FILTER_STR,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (a-z,A-Z, ).";
						
								return $msg;
							}
						}
						else if($ex[1] === "INT")
						{
							if( ! preg_match(FILTER_INT,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (0-9).";
						
								return $msg;
							}
						}
						else if($ex[1] === "INT_DEC")
						{
							if( ! preg_match(FILTER_INT_DEC,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (0-9,.).";
						
								return $msg;
							}
						}
						else if($ex[1] === "STR_INT")
						{
							if( ! preg_match(FILTER_STR_INT,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (a-z,A-Z,0-9,).";
						
								return $msg;
							}
						}
						else if($ex[1] === "STR_INT_SPA")
						{
							if( ! preg_match(FILTER_STR_INT_SPA,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (a-z,A-Z,0-9, ).";
						
								return $msg;
							}
						}
						else if($ex[1] === "USERNAME")
						{
							if( ! preg_match(FILTER_USERNAME,$filter))
							{
								$msg = "Invalid {$ex[2]}. You can only use this characters (a-z,A-Z,0-9,_, ).";
						
								return $msg;
							}
						}
						else if($ex[1] === "EMAIL")
						{
							if( ! preg_match(FILTER_EMAIL,$filter))
							{
								$msg = "Invalid {$ex[2]}. Please input a valid email address.";
						
								return $msg;
							}
						}
						else if($ex[1] === "E" OR $ex[1] === "ES" OR $ex[1] === "ER")
						{
							// Do Nothing
						}
						else
						{
							show_error("<b>Validation Helper Error:</b> <br /><br />There is no filter type <b>{$ex[1]}</b> like that. Please change it to <b>E</b>.",TRUE,2);
						}
					}
				}
			}
		}
	}
	
	function pagination($num = 0, $per_page = 10, $count = 0, $base_url = NULL, $andget = NULL, $config = array())
	{
		// Initialization
		$i = 1;
		$x = 0;
		if(is_array($config))
		{
			$first_open_tag = isset($config['first_open_tag']) ? $config['first_open_tag'] : "";
			$first_closed_tag = isset($config['first_closed_tag']) ? $config['first_closed_tag'] : "";
			$last_open_tag = isset($config['last_open_tag']) ? $config['last_open_tag'] : "";
			$last_closed_tag = isset($config['last_closed_tag']) ? $config['last_closed_tag'] : "";
			$number_open_tag = isset($config['number_open_tag']) ? $config['number_open_tag'] : "";
			$number_closed_tag = isset($config['number_closed_tag']) ? $config['number_closed_tag'] : "";
			$current_number_open_tag = isset($config['current_number_open_tag']) ? $config['current_number_open_tag'] : "";
			$current_number_closed_tag = isset($config['current_number_closed_tag']) ? $config['current_number_closed_tag'] : "";
			$next_open_tag = isset($config['next_open_tag']) ? $config['next_open_tag'] : "";
			$next_closed_tag = isset($config['next_closed_tag']) ? $config['next_closed_tag'] : "";
			$previous_open_tag = isset($config['previous_open_tag']) ? $config['previous_open_tag'] : "";
			$previous_closed_tag = isset($config['previous_closed_tag']) ? $config['previous_closed_tag'] : "";
		}
		else
		{
			$first_open_tag = "";
			$first_closed_tag = "";
			$last_open_tag = "";
			$last_closed_tag = "";
			$number_open_tag = "";-
			$number_closed_tag = "";
			$current_number_open_tag = "";
			$current_number_closed_tag = "";
			$next_open_tag = "";
			$next_closed_tag = "";
			$previous_open_tag = "";
			$previous_closed_tag = "";
		}
		$max_pages = 0;
		for($total_count = $count; ;)
		{
			if($total_count <= 0)
				break;
			
			$total_count = $total_count - $per_page;
			$max_pages++;
		}
		
		if( ! $num)
			$num = 0;
		
		if($num >= $count)
		{
			$num = $max_pages;
			$per_page2 = $per_page + 10; // Duplicate $per_page and add + 10
			
			while($per_page2 < $num)
			{
				$per_page2 = $per_page2 + $per_page;
				$i++;
				$x = $x + $per_page;
			}
			
			$count2 = $per_page2 + $per_page + $per_page + $per_page + $per_page; // +3 number
			
			while($x < $count2)
			{
				if($i > $max_pages)
				{
					// Do Nothing
				}
				else
				{
					echo '<a href="'.$base_url.'?num='.$x.''.$andget.'">'.$i.'</a> ';
				}
				$i++;
				$x = $x + $per_page;
			}
		}
		else
		{
			if($max_pages > 1)
			{
				if($num != 0)
				{
					$previous_page = $num - $per_page;
					echo '<a href="'.$base_url.'?num=0'.$andget.'">'.$first_open_tag.'First'.$first_closed_tag.'</a> ';
					echo '<a href="'.$base_url.'?num='.$previous_page.''.$andget.'">'.$previous_open_tag.'Previous'.$previous_closed_tag.'</a> ';
				}

				$per_page2 = $per_page + 10; // Duplicate $per_page and add + 10
				
				while($per_page2 < $num)
				{
					$per_page2 = $per_page2 + $per_page;
					$i++;
					$x = $x + $per_page;
				}
				$count2 = $per_page2 + $per_page + $per_page + $per_page + $per_page; // +3 number
				
				while($x < $count2)
				{
					if($i > $max_pages)
					{
						// Do Nothing
					}
					else
					{
						if( ! $num && $i == 1)
							echo '<b>'.$current_number_open_tag.''.$i.''.$current_number_closed_tag.'</b> ';
						elseif($num != $x)
							echo '<a href="'.$base_url.'?num='.$x.''.$andget.'">'.$number_open_tag.''.$i.''.$number_closed_tag.'</a> ';
						else
							echo '<b>'.$current_number_open_tag.''.$i.''.$current_number_closed_tag.'</b> ';
					}
					$i++;
					$x = $x + $per_page;
				}
				
				if($num != $per_page * $max_pages - $per_page)
				{
					$next_page = $num + $per_page;
					$last_page = $per_page * $max_pages - $per_page;
					echo '<a href="'.$base_url.'?num='.$next_page.''.$andget.'">'.$next_open_tag.'Next'.$last_closed_tag.'</a> ';
					echo '<a href="'.$base_url.'?num='.$last_page.''.$andget.'">'.$last_open_tag.'Last'.$last_closed_tag.'</a>';
				}
			}
		}
	}
	
	function email($to = NULL, $message = NULL, $subject = NULL)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.EMAIL_FROM.'' . "\r\n";
		$headers .= 'BCC: brenald@workercoach.com' . "\r\n";
		$headers .= 'BCC: allan@softwebamerica.com' . "\r\n";
		
		if($subject)
			mail($to, $subject, $message, $headers);
		else
			mail($to, EMAIL_SUBJECT, $message, $headers);
	}
	
	function resize($img = NULL, $new_img = NULL, $width = 0, $height = 0, $maintain_ratio = TRUE, $grayscale = FALSE)
	{
		if( ! $img) return FALSE;		
		
		$exists = file_exists(FCPATH.'/'.$img);
		if($exists === TRUE)
		{
			$img = FCPATH.'/'.$img;
			$new_img = FCPATH.'/'.$new_img;
			
			$imgs = getimagesize($img);
			$quality = 100;

			list($width_old, $height_old) = $imgs;
			$cropHeight = $cropWidth = 0;
			$image = '';
			$final_width = 0;
			$final_height = 0;
			
			// Maintain the Ratio?
			if($maintain_ratio)
			{
				if($width  == 0) $factor = $height/$height_old;
				elseif($height == 0) $factor = $width/$width_old;
				else $factor = min( $width / $width_old, $height / $height_old );

				$final_width  = round( $width_old * $factor );
				$final_height = round( $height_old * $factor );
			}
			else
			{
				$final_width = ( $width <= 0 ) ? $width_old : $width;
				$final_height = ( $height <= 0 ) ? $height_old : $height;
				$widthX = $width_old / $width;
				$heightX = $height_old / $height;

				$x = min($widthX, $heightX);
				$cropWidth = ($width_old - $width * $x) / 2;
				$cropHeight = ($height_old - $height * $x) / 2;
			}
			
			// Loading image to memory according to type
			switch ( $imgs[2] ) {
				case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($img); if($grayscale) imagefilter($image, IMG_FILTER_GRAYSCALE); break;
				case IMAGETYPE_GIF: $image = imagecreatefromgif($img); if($grayscale) imagefilter($image, IMG_FILTER_GRAYSCALE); break;
				case IMAGETYPE_PNG: $image = imagecreatefrompng($img); if($grayscale) imagefilter($image, IMG_FILTER_GRAYSCALE); break;
				default: return false;
			}
			
			$image_resized = imagecreatetruecolor( $final_width, $final_height );
			if( ($imgs[2] == IMAGETYPE_GIF) || ($imgs[2] == IMAGETYPE_PNG) )
			{
				$transparency = imagecolortransparent($image);
				$palletsize = imagecolorstotal($image);

				if ($transparency >= 0 && $transparency < $palletsize)
				{
					$transparent_color  = imagecolorsforindex($image, $transparency);
					$transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
					imagefill($image_resized, 0, 0, $transparency);
					imagecolortransparent($image_resized, $transparency);
				}
				else if($imgs[2] == IMAGETYPE_PNG)
				{
					imagealphablending($image_resized, false);
					$color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
					imagefill($image_resized, 0, 0, $color);
					imagesavealpha($image_resized, true);
				}
			}
			imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
			
			switch( strtolower($new_img) )
			{
				case 'browser':
					$mime = image_type_to_mime_type($imgs[2]);
					header("Content-type: $mime");
					$new_img = NULL;
					break;
				case 'file':
					$new_img = $img;
					break;
				case 'return':
					return $image_resized;
					break;
				default:
					break;
			}
			
			switch( $imgs[2] )
			{
				case IMAGETYPE_GIF:
					imagegif($image_resized, $new_img); break;
				case IMAGETYPE_JPEG:
					imagejpeg($image_resized, $new_img, $quality); break;
				case IMAGETYPE_PNG:
					$quality = 9 - (int)((0.9*$quality)/10.0);
					imagepng($image_resized, $new_img, $quality);
					break;
				default:
					return false;
			}

			return true;
		}
		else
		{
			show_error("<b>Resize Error:</b> <br /><br />Unable to locate <b>".base_url($img)."</b> file.",TRUE,2);
			
			return false;
		}
	}
}