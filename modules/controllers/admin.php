<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if( ! $this->session->userdata('admin'))
			redirect('404');
	}
	
	public function index()
	{
		// FORCE SSL
		if($_SERVER["HTTPS"] != "on")
		{
			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			exit();
		}
		
		$data["title"] = "Photography By Zarek";
		$data["menu"] = 0;
				
		$this->load->view("admin/body",$data);
	}
	
	/* ====================================================
	 * Gallery - Clients
	 * - Enalds
	 * ================================================= */
	public function clients()
	{
		$data["title"] = "Client's";
		$data["menu"] = 1;
		
		if($_POST)
		{
			$data['sizes'] = $sizes = $this->input->post('sizes');
			$data['price'] = $price = $this->input->post('price');
			
			$filter = $this->load->validation(
				array(
					'required|E|Sizes' => $sizes,
					'required|INT_DEC|Price' => $price
				)
			);
			
			if($filter)
			{
				$data['error'] = $filter;
			}
			else
			{
				$insert = array(
					'sizes' => $sizes,
					'price' => $price
				);
				$this->QModel->insert('delivery_setup',$insert);
				
				$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
				redirect('admin/clients');
			}
		}
		
		// Sorting
		$sort_by = $this->input->get('sort_by');
		$order_by = $this->input->get('order_by');
		
		$i = 1;
		$total_sort = 2;
		$sort_limit = 0;
		$sort_array = array('sizes','price');
		foreach($sort_array as $a)
		{
			if($sort_by == $a)
			{
				$ii = 1;
				while($ii <= $total_sort)
				{
					if($i != $ii)
					{
						$data['symbol_'.$ii] = '<img src="'.themes_url("images/icon_twistee.png").'"/>';
						$data['link_'.$ii] = base_url('admin/clients?sort_by='.$sort_array[$ii - 1].'&order_by=asc');
					}
					else
					{
						if($order_by == "asc")
						{
							$order_by = "CAST({$a} as DECIMAL(10,2)) ASC";
							$data['order_by'] = $order_by;
							$data['symbol_'.$ii] = '&#x25B2;';
							$data['link_'.$ii] = base_url('admin/clients?sort_by='.$a.'&order_by=desc');
						}
						else
						{
							$order_by = "CAST({$a} as DECIMAL(10,2)) DESC";
							$data['order_by'] = $order_by;
							$data['symbol_'.$ii] = '&#x25BC;';
							$data['link_'.$ii] = base_url('admin/clients?sort_by='.$a.'&order_by=asc');
						}
					}
					$ii++;
				}
			}
			else
			{
				$sort_limit++;
			}
			$i++;
		}
		
		if($sort_limit == $total_sort)
		{
			$order_by = "CAST(sizes as DECIMAL(2.0)) ASC";
			$data['order_by'] = $order_by;
			$data['symbol_1'] = '&#x25B2;';
			$data['symbol_2'] = '<img src="'.themes_url("images/icon_twistee.png").'"/>';
			$data['link_1'] = base_url('admin/clients?sort_by=sizes&order_by=desc');
			$data['link_2'] = base_url('admin/clients?sort_by=price&order_by=desc');
		}
		
		$this->load->view("admin/gallery/clients/client",$data);
	}
	
	public function clients_edit($id = NULL)
	{
		$query = $this->QModel->sfwa('delivery_setup',array('delivery_setup_id'),array($id));
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['sizes'] = $sizes = $get['sizes'];
			$data['price'] = $price = $get['price'];
			
			$data["title"] = "Zarek's Delivery Setup";
			$data["menu"] = 1;
			
			if($_POST)
			{
				$data['sizes'] = $sizes = $this->input->post('sizes');
				$data['price'] = $price = $this->input->post('price');
				
				$filter = $this->load->validation(
					array(
						'required|E|Sizes' => $sizes,
						'required|INT_DEC|Price' => $price
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$update = array(
						'sizes' => $sizes,
						'price' => $price
					);
					$this->QModel->update('delivery_setup',$update,array('delivery_setup_id' => $id));
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
					redirect('admin/clients');
				}
			}
			
			// Sorting
			$sort_by = $this->input->get('sort_by');
			$order_by = $this->input->get('order_by');
			
			$i = 1;
			$total_sort = 2;
			$sort_limit = 0;
			$sort_array = array('sizes','price');
			foreach($sort_array as $a)
			{
				if($sort_by == $a)
				{
					$ii = 1;
					while($ii <= $total_sort)
					{
						if($i != $ii)
						{
							$data['symbol_'.$ii] = '<img src="'.themes_url("images/icon_twistee.png").'"/>';
							$data['link_'.$ii] = base_url('admin/clients_edit/'.$id.'?sort_by='.$sort_array[$ii - 1].'&order_by=asc');
						}
						else
						{
							if($order_by == "asc")
							{
								$order_by = "CAST({$a} as DECIMAL(10,2)) ASC";
								$data['order_by'] = $order_by;
								$data['symbol_'.$ii] = '&#x25B2;';
								$data['link_'.$ii] = base_url('admin/clients_edit/'.$id.'?sort_by='.$a.'&order_by=desc');
							}
							else
							{
								$order_by = "CAST({$a} as DECIMAL(10,2)) DESC";
								$data['order_by'] = $order_by;
								$data['symbol_'.$ii] = '&#x25BC;';
								$data['link_'.$ii] = base_url('admin/clients_edit/'.$id.'?sort_by='.$a.'&order_by=asc');
							}
						}
						$ii++;
					}
				}
				else
				{
					$sort_limit++;
				}
				$i++;
			}
			
			if($sort_limit == $total_sort)
			{
				$order_by = "CAST(sizes as DECIMAL(2.0)) ASC";
				$data['order_by'] = $order_by;
				$data['symbol_1'] = '&#x25B2;';
				$data['symbol_2'] = '<img src="'.themes_url("images/icon_twistee.png").'"/>';
				$data['link_1'] = base_url('admin/clients_edit/'.$id.'?sort_by=sizes&oidrder_by=desc');
				$data['link_2'] = base_url('admin/clients_edit/'.$id.'?sort_by=price&order_by=desc');
			}
			
			$this->load->view("admin/gallery/clients/client",$data);
		}
	}
	
	public function delete_clients($delivery_setup_id = NULL)
	{
		$query = $this->QModel->sfwa('delivery_setup','delivery_setup_id',$delivery_setup_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$this->QModel->delete('delivery_setup',array('delivery_setup_id' => $delivery_setup_id));
			redirect('admin/clients');
		}
	}
	
	public function shipping_cost()
	{
		$data["title"] = "Shipping Cost";
		$data["menu"] = 9;
		
		
		$this->load->view("admin/gallery/shipping_cost_tax/shipping_cost",$data);
	}
	
	public function shipping_cost_edit($id = NULL)
	{
		$query = $this->QModel->sfwa('shipping_cost',array('shipping_cost_id'),array($id));
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['shipping_cost'] = $shipping_cost = $get['shipping_cost'];
			$data['description'] = $description = $get['description'];
			
			$data["title"] = "Zarek's Shipping Cost";
			$data["menu"] = 9;
			
			if($_POST)
			{
				$data['shipping_cost'] = $shipping_cost = $this->input->post('shipping_cost');
				$data['description'] = $description = $this->input->post('description');
				
				$filter = $this->load->validation(
					array(
						'required|E|Shipping Cost' => $shipping_cost,
						'required|E|Description' => $description,
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$update = array(
						'shipping_cost' => $shipping_cost,
						'description' => $description
					);
					$this->QModel->update('shipping_cost',$update,array('shipping_cost_id' => $id));
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully edited.</span>');
					redirect('admin/shipping_cost');
				}
			}
			
			$this->load->view("admin/gallery/shipping_cost_tax/shipping_cost_edit",$data);
		}
	}
	
	public function tax()
	{
		$data["title"] = "Tax";
		$data["menu"] = 9;
		
		
		$this->load->view("admin/gallery/shipping_cost_tax/tax",$data);
	}
	
	public function tax_edit($id = NULL)
	{
		$query = $this->QModel->sfwa('tax',array('tax_id'),array($id));
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['tax'] = $tax = $get['tax'];
			
			$data["title"] = "Zarek's Shipping Cost";
			$data["menu"] = 9;
			
			if($_POST)
			{
				$data['tax'] = $tax = $this->input->post('tax');
				
				$filter = $this->load->validation(
					array(
						'required|E|Tax' => $tax,
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$update = array(
						'tax' => $tax
					);
					$this->QModel->update('tax',$update,array('tax_id' => $id));
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully edited.</span>');
					redirect('admin/tax');
				}
			}
			
			$this->load->view("admin/gallery/shipping_cost_tax/tax_edit",$data);
		}
	}
	
	public function create_event()
	{
		$data["title"] = "Create Event";
		$data["menu"] = 1;
		
		if($_POST)
		{
			$data['event_name'] = $event_name = $this->input->post('event_name');
			$data['date_event'] = $date_event = $this->input->post('date_event');
			$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');
			$data['password'] = $password = $this->input->post('password');
			
			$filter = $this->load->validation(
				array(
					'required|E|Event Name' => $event_name,
					'required|E|Date Event' => $date_event,
					'required|E|Expiration Date' => $expiration_date,
					'not|E|Password' => $password
				)
			);
			
			if($filter)
			{
				$data['error'] = $filter;
			}
			else if( ! checkdate(date("m",strtotime($date_event)),date("d",strtotime($date_event)),date("y",strtotime($date_event))))
			{
				$data['error'] = "Incorrect date at Date Event!";
			}
			else if( ! checkdate(date("m",strtotime($expiration_date)),date("d",strtotime($expiration_date)),date("y",strtotime($expiration_date))))
			{
				$data['error'] = "Incorrect date at Expiration Date!";
			}
			else
			{
				$file = $_FILES['file']['name'];
				$type = $_FILES['file']['type'];
				$size = $_FILES['file']['size'];
				$temp = $_FILES['file']['tmp_name'];
				$error = $_FILES['file']['error'];
				
				if( ! $file)
				{
					$data['error'] = "Please select a file!";
				}
				else
				{
					if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
					{
						switch($error)
						{
							case UPLOAD_ERR_INI_SIZE: 
								$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
								break;
							case UPLOAD_ERR_FORM_SIZE: 
								$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
								break;
							case UPLOAD_ERR_PARTIAL: 
								$message = "The uploaded file was only partially uploaded"; 
								break;
							case UPLOAD_ERR_NO_FILE: 
								$message = "No file was uploaded"; 
								break;
							case UPLOAD_ERR_NO_TMP_DIR: 
								$message = "Missing a temporary folder"; 
								break;
							case UPLOAD_ERR_CANT_WRITE: 
								$message = "Failed to write file to disk"; 
								break;
							case UPLOAD_ERR_EXTENSION: 
								$message = "File upload stopped by extension"; 
								break;
							default:
								$message = "Unknown upload error"; 
								break; 
						}
						
						if($error)
						{
							$data['error'] = $message;
						}
						else
						{
							if($type == "image/pjpeg" OR $type == "image/jpeg")
								$ex = ".jpg";
							else
								$ex = ".png";
							
							// Creating folder...
							$last_id = $this->QModel->query("SHOW TABLE STATUS LIKE 'clients'");
							$glast_id = $this->QModel->g($last_id);
							
							mkdir(FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment'], 0755);
							mkdir(FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/original", 0755);
							mkdir(FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/semi-original", 0755);
							mkdir(FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/thumbnail", 0755);
							$file = FCPATH."/uploads/index.html";
							$newfile = FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/index.html";
							$newfile2 = FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/original/index.html";
							$newfile3 = FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/semi-original/index.html";
							$newfile4 = FCPATH."/uploads/gallery/clients/".$glast_id['Auto_increment']."/thumbnail/index.html";
							copy($file, $newfile);
							copy($file, $newfile2);
							copy($file, $newfile3);
							copy($file, $newfile4);
							
							$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
							$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
							$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
							move_uploaded_file($temp,"uploads/gallery/clients/".$glast_id['Auto_increment']."/original/".$orginal_naming);
							
							// Resizing...
							$this->load->resize("uploads/gallery/clients/".$glast_id['Auto_increment']."/original/".$orginal_naming,"uploads/gallery/clients/".$glast_id['Auto_increment']."/semi-original/".$semi_naming,224,224);
							$this->load->resize("uploads/gallery/clients/".$glast_id['Auto_increment']."/original/".$orginal_naming,"uploads/gallery/clients/".$glast_id['Auto_increment']."/thumbnail/".$thumb_naming,126,126);
							
							// Inserting...
							$insert = array(
								'client_name' => $event_name,
								'date_client' => date("Y-m-d",strtotime($date_event)),
								'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
								'original_image' => $orginal_naming,
								'semi_original_image' => $semi_naming,
								'thumbnail_image' => $thumb_naming,
								'password' => $password,
								'client_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('clients',$insert);
							
							$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
							redirect('admin/edit_event/'.$glast_id['Auto_increment']);
						}
					}
					else if($size > 20000000)
					{
						$data['error'] = "File size must be 20MB below!";
					}
					else
					{
						$data['error'] = "File extension must be .png or .jpg or .jpeg";
					}
				}
			}
		}
		
		$this->load->view("admin/gallery/clients/create_event",$data);
	}
	
	public function edit_event($clients_id = NULL)
	{
		$query = $this->QModel->sfwa('clients','clients_id',$clients_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$data["title"] = "Edit Event";
			$data["menu"] = 1;
			
			$get = $this->QModel->g($query);
			$data['event_name'] = $get['client_name'];
			$data['date_event'] = $get['date_client'];
			$data['expiration_date'] = $get['expiration_date'];
			$data['password'] = $get['password'];
			$data['event_post'] = $get['posted'];
			$data['thumbnail_image'] = $get['thumbnail_image'];
			$data['clients_id'] = $clients_id;
			$data['discount'] = $get['discount'];
			
			if($get['date_from'] == "0000-00-00")
				$data['from'] = "";
			else
				$data['from'] = date("m/d/Y",strtotime($get['date_from']));
			
			if($get['date_to'] == "0000-00-00")
				$data['to'] = "";
			else
				$data['to'] = date("m/d/Y",strtotime($get['date_to']));
			
			if($_POST)
			{
				$save = $this->input->post('save');
				$upload = $this->input->post('upload');
				$delete_selected = $this->input->post('delete_selected');

				if( ! $save && ! $upload && ! $delete_selected)
				{
					redirect('404');
				}
				else
				{
					if($save)
					{
						$data['event_name'] = $event_name = $this->input->post('event_name');
						$data['date_event'] = $date_event = $this->input->post('date_event');
						$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');
						$data['password'] = $password = $this->input->post('password');
						$data['event_post'] = $event_post = $this->input->post('event_post');
						//Discount
						$data['discount'] = $discount = $this->input->post('discount');
						$data['from'] = $from = $this->input->post('from');
						$data['to'] = $to = $this->input->post('to');
						
						$filter = $this->load->validation(
							array(
								'required|E|Event Name' => $event_name,
								'required|E|Date Event' => $date_event,
								'required|E|Expiration Date' => $expiration_date,
								'not|E|Password' => $password,
								'required|E|Event Post' => $event_post,
								'not|E|Discount' => $discount,
								'not|E|From' => $from,
								'not|E|Event Post' => $to
							)
						);
						
						if($filter)
						{
							$data['error'] = $filter;
						}
						else if( ! checkdate(date("m",strtotime($date_event)),date("d",strtotime($date_event)),date("y",strtotime($date_event))))
						{
							$data['error'] = "Incorrect date at Date Event!";
						}
						else if( ! checkdate(date("m",strtotime($expiration_date)),date("d",strtotime($expiration_date)),date("y",strtotime($expiration_date))))
						{
							$data['error'] = "Incorrect date at Expiration Date!";
						}
						else
						{
							$file = $_FILES['file']['name'];
							$type = $_FILES['file']['type'];
							$size = $_FILES['file']['size'];
							$temp = $_FILES['file']['tmp_name'];
							$error = $_FILES['file']['error'];

							if($file)
							{
								if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
								{
									switch($error)
									{
										case UPLOAD_ERR_INI_SIZE: 
											$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
											break;
										case UPLOAD_ERR_FORM_SIZE: 
											$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
											break;
										case UPLOAD_ERR_PARTIAL: 
											$message = "The uploaded file was only partially uploaded"; 
											break;
										case UPLOAD_ERR_NO_FILE: 
											$message = "No file was uploaded"; 
											break;
										case UPLOAD_ERR_NO_TMP_DIR: 
											$message = "Missing a temporary folder"; 
											break;
										case UPLOAD_ERR_CANT_WRITE: 
											$message = "Failed to write file to disk"; 
											break;
										case UPLOAD_ERR_EXTENSION: 
											$message = "File upload stopped by extension"; 
											break;
										default:
											$message = "Unknown upload error"; 
											break; 
									}
									
									if($error)
									{
										$data['error'] = $message;
									}
									else
									{
										if($type == "image/pjpeg" OR $type == "image/jpeg")
											$ex = ".jpg";
										else
											$ex = ".png";
										
										$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
										$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
										$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
										move_uploaded_file($temp,"uploads/gallery/clients/".$clients_id."/original/".$orginal_naming);
										
										// Deleting old picture...
										@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/original/'.$get['original_image']);
										@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/semi-original/'.$get['semi_original_image']);
										@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$get['thumbnail_image']);
										
										// Resizing...
										echo $this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/semi-original/".$semi_naming,224,224);
										echo $this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/thumbnail/".$thumb_naming,126,126);
										
										if( ! $from)
											$from = "";
										else
											$from = date("Y-m-d",strtotime($from));
										
										if( ! $to)
											$to = "";
										else
											$to = date("Y-m-d",strtotime($to));
										
										$update = array(
											'client_name' => $event_name,
											'date_client' => date("Y-m-d",strtotime($date_event)),
											'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
											'original_image' => $orginal_naming,
											'semi_original_image' => $semi_naming,
											'thumbnail_image' => $thumb_naming,
											'password' => $password,
											'posted' => $event_post,
											'discount' => $discount,
											'date_from' => $from,
											'date_to' => $to
										);
										$this->QModel->update('clients',$update,array('clients_id' => $clients_id));
										
										$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully saved.</span>');
										redirect('admin/edit_event/'.$clients_id);
									}
								}
								else if($size > 20000000)
								{
									$data['error'] = "File size must be 20MB below!";
								}
								else
								{
									$data['error'] = "File extension must be .png or .jpg or .jpeg";
								}
							}
							else
							{
								if( ! $from)
									$from = "";
								else
									$from = date("Y-m-d",strtotime($from));
								
								if( ! $to)
									$to = "";
								else
									$to = date("Y-m-d",strtotime($to));
										
								$update = array(
									'client_name' => $event_name,
									'date_client' => date("Y-m-d",strtotime($date_event)),
									'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
									'password' => $password,
									'posted' => $event_post,
									'client_created' => date("Y-m-d H:i:s"),
									'discount' => $discount,
									'date_from' => $from,
									'date_to' => $to
								);
								$this->QModel->update('clients',$update,array('clients_id' => $clients_id));
								
								$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully saved.</span>');
								redirect('admin/edit_event/'.$clients_id);
							}
						}
					}
					else if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('clients_photos',array('clients_photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/edit_event/'.$clients_id);
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);
						
						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($type == "image/pjpeg" OR $type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
									$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
									$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
									move_uploaded_file($temp,"uploads/gallery/clients/".$clients_id."/original/".$orginal_naming);
									
									// Resizing...
									$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/semi-original/".$semi_naming,224,224);
									$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/thumbnail/".$thumb_naming,126,126);
									
									// Get original upload name file.
									$new_fileName = explode(".",$file);
									
									$insert = array(
										'clients_id' => $clients_id,
										'photos' => $new_fileName[0].$ex,
										'original_image' => $orginal_naming,
										'semi_original_image' => $semi_naming,
										'thumbnail_image' => $thumb_naming,
										'clients_photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('clients_photos',$insert);
									
									echo "Successfully Uploaded - ".$new_fileName[0].$ex;
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
			
			if($_POST)
			{
				/* Show nothing */
			}
			else
			{
				$this->load->view("admin/gallery/clients/edit_event",$data);
			}
		}
	}
	
	public function clients_upload_to_many($clients_id = NULL)
	{
		$query = $this->QModel->sfwa('clients','clients_id',$clients_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			set_time_limit(0);
			error_reporting(0);
			ini_set('max_file_uploads','1000');
			
			// Initialization
			foreach ($_FILES as $k=>$v) { if(is_array($v)) { foreach ($v as $sk=>$sv) { $arr[$sk][$k]=$sv; } } }
			
			// Getting Started...
			$i = 0; foreach($arr['name'] as $a) { foreach($a as $b) { $file[$i] = $b; $i++; } }
			$i = 0; foreach($arr['type'] as $a) { foreach($a as $b) { $type[$i] = $b; $i++; } }
			$i = 0; foreach($arr['size'] as $a) { foreach($a as $b) { $size[$i] = $b; $i++; } }
			$i = 0; foreach($arr['tmp_name'] as $a) { foreach($a as $b) { $temp[$i] = $b; $i++; } }
			$i = 0; foreach($arr['error'] as $a) { foreach($a as $b) { $error[$i] = $b; $i++; } }
			$count_total = count($file);

			for($i = 0; $i < $count_total; $i++)
			{
				if( ! $file[$i])
				{
					$data['error'] = "Please select a file!";
					break;
				}
				else
				{
					$qexisting = $this->QModel->sfwa('clients_photos',array('clients_id','photos'),array($clients_id,$file[$i]));
					$cexisting = $this->QModel->c($qexisting);
					
					if($cexisting)
					{
						// Do Nothing.
					}
					else
					{
						if($type[$i] == "image/pjpeg" && $size[$i] < 20000000 OR $type[$i] == "image/jpeg" && $size[$i] < 20000000 OR $type[$i] == "image/png" && $size[$i] < 20000000)
						{
							switch($error[$i])
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error[$i])
							{
								echo $message;
								break;
							}
							else
							{
								if($type[$i] == "image/pjpeg" OR $type[$i] == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$orginal_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-original",'adler32').$ex;
								$semi_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-semi",'adler32').$ex;
								$thumb_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-thumb",'adler32').$ex;
								move_uploaded_file($temp[$i],"uploads/gallery/clients/".$clients_id."/original/".$orginal_naming);
								
								// Resizing...
								$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/semi-original/".$semi_naming,224,224);
								$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/thumbnail/".$thumb_naming,126,126);
								
								// Get original upload name file.
								$new_fileName = explode(".",$file[$i]);
								
								$insert = array(
									'clients_id' => $clients_id,
									'photos' => $new_fileName[0].$ex,
									'original_image' => $orginal_naming,
									'semi_original_image' => $semi_naming,
									'thumbnail_image' => $thumb_naming,
									'clients_photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->insert('clients_photos',$insert);
								
								$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added photo.</span>');
							}
						}
						else if($size[$i] < 20000000)
						{
							echo "File size must be 20MB below!";
							break;
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
							break;
						}
					}
				}
			}
			
			echo "Successfully Uploaded!";
		}
	}
	
	public function delete_event($clients_id = NULL)
	{
		$query = $this->QModel->sfwa('clients','clients_id',$clients_id);

		if( ! $this->QModel->c($query))
			redirect('404');
		
		$get = $this->QModel->g($query);
		$original_image_cover = $get['original_image'];
		$semi_original_image_cover = $get['semi_original_image'];
		$thumbnail_image_cover = $get['thumbnail_image'];
		
		// DB Deleting
		$query2 = $this->QModel->sfwa('clients_photos','clients_id',$clients_id);
		while($get2 = $this->QModel->g($query2))
		{
			$clients_photos_id = $get2['clients_photos_id'];
			$original_image = $get2['original_image'];
			$semi_original_image = $get2['semi_original_image'];
			$thumbnail_image = $get2['thumbnail_image'];
			
			// Delete Cover Image
			unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/original/".$original_image);
			unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/semi-original/".$semi_original_image);
			unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/thumbnail/".$thumbnail_image);
			
			$this->QModel->delete('clients_photos',array('clients_photos_id' => $clients_photos_id));
		}
		
		// Delete Cover Image and others
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/original/".$original_image_cover);
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/semi-original/".$semi_original_image_cover);
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/thumbnail/".$thumbnail_image_cover);
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/original/index.html");
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/semi-original/index.html");
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/thumbnail/index.html");
		unlink(FCPATH."/uploads/gallery/clients/{$clients_id}/index.html");
		rmdir(FCPATH."/uploads/gallery/clients/{$clients_id}/original");
		rmdir(FCPATH."/uploads/gallery/clients/{$clients_id}/semi-original");
		rmdir(FCPATH."/uploads/gallery/clients/{$clients_id}/thumbnail");
		rmdir(FCPATH."/uploads/gallery/clients/".$clients_id);
		
		$this->QModel->delete('clients',array('clients_id' => $clients_id));
		
		$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
		redirect('admin/client_event');
	}
	
	public function zareks_delete_event($zareks_id = NULL)
	{
		$query = $this->QModel->sfwa('zareks','zareks_id',$zareks_id);

		if( ! $this->QModel->c($query))
			redirect('404');
		
		$get = $this->QModel->g($query);
		$original_image_cover = $get['original_image'];
		$semi_original_image_cover = $get['semi_original_image'];
		$thumbnail_image_cover = $get['thumbnail_image'];
		
		// DB Deleting
		$query2 = $this->QModel->sfwa('zareks_photos','zareks_id',$zareks_id);
		while($get2 = $this->QModel->g($query2))
		{
			$zareks_photos_id = $get2['zareks_photos_id'];
			$original_image = $get2['original_image'];
			$semi_original_image = $get2['semi_original_image'];
			$thumbnail_image = $get2['thumbnail_image'];
			
			// Delete Cover Image
			unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/original/".$original_image);
			unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/semi-original/".$semi_original_image);
			unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/thumbnail/".$thumbnail_image);
			
			$this->QModel->delete('zareks_photos',array('zareks_photos_id' => $zareks_photos_id));
		}
		
		// Delete Cover Image and others
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/original/".$original_image_cover);
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/semi-original/".$semi_original_image_cover);
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/thumbnail/".$thumbnail_image_cover);
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/original/index.html");
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/semi-original/index.html");
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/thumbnail/index.html");
		unlink(FCPATH."/uploads/gallery/zareks/{$zareks_id}/index.html");
		rmdir(FCPATH."/uploads/gallery/zareks/{$zareks_id}/original");
		rmdir(FCPATH."/uploads/gallery/zareks/{$zareks_id}/semi-original");
		rmdir(FCPATH."/uploads/gallery/zareks/{$zareks_id}/thumbnail");
		rmdir(FCPATH."/uploads/gallery/zareks/".$zareks_id);
		
		$this->QModel->delete('zareks',array('zareks_id' => $zareks_id));
		
		$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
		redirect('admin/zareks_event');
	}
	
	public function client_event()
	{
		$data["title"] = "Client's - Event";
		$data["menu"] = 1;
		
		$this->load->view("admin/gallery/clients/event",$data);
	}
	
	public function zareks_event()
	{
		$data["title"] = "Zarek's - Event";
		$data["menu"] = 2;
		
		$this->load->view("admin/gallery/zareks/event",$data);
	}
	/* ====================================================
	 * End of Gallery - Clients
	 * ================================================= */
	
	/* ====================================================
	 * Gallery - Zarek's
	 * - Enalds
	 * ================================================= */
	public function zareks()
	{
		$data["title"] = "Zarek's Delivery Setup";
		$data["menu"] = 2;
		
		if($_POST)
		{
			$data['sizes'] = $sizes = $this->input->post('sizes');
			$data['price'] = $price = $this->input->post('price');
			
			$filter = $this->load->validation(
				array(
					'required|E|Sizes' => $sizes,
					'required|INT_DEC|Price' => $price
				)
			);
			
			if($filter)
			{
				$data['error'] = $filter;
			}
			else
			{
				$insert = array(
					'sizes' => $sizes,
					'price' => $price
				);
				$this->QModel->insert('delivery_setup_zarek',$insert);
				
				$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
				redirect('admin/zareksDeliverySetup');
			}
		}
		
		$this->load->view("admin/gallery/zareks/delivery_setup",$data);
	}
	
	public function zareksDeliverySetupedit($id = NULL)
	{
		$query = $this->QModel->sfwa('delivery_setup_zarek',array('delivery_setup_id'),array($id));
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['sizes'] = $sizes = $get['sizes'];
			$data['price'] = $price = $get['price'];
			
			$data["title"] = "Zarek's Delivery Setup";
			$data["menu"] = 2;
			$data["edit"] = 1;
			
			if($_POST)
			{
				$data['sizes'] = $sizes = $this->input->post('sizes');
				$data['price'] = $price = $this->input->post('price');
				
				$filter = $this->load->validation(
					array(
						'required|E|Sizes' => $sizes,
						'required|INT_DEC|Price' => $price
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$update = array(
						'sizes' => $sizes,
						'price' => $price
					);
					$this->QModel->update('delivery_setup_zarek',$update,array('delivery_setup_id' => $id));
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
					redirect('admin/zareksDeliverySetup');
				}
			}
			
			$this->load->view("admin/gallery/zareks/delivery_setup",$data);
		}
	}
	
	public function delete_deliverySetupZareks($delivery_setup_id = NULL)
	{
		$query = $this->QModel->sfwa('delivery_setup_zarek','delivery_setup_id',$delivery_setup_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$this->QModel->delete('delivery_setup_zarek',array('delivery_setup_id' => $delivery_setup_id));
			
			redirect('admin/zareksDeliverySetup');
		}
	}
	
	public function zareks_create_event()
	{
		$data["title"] = "Create Event";
		$data["menu"] = 2;
		
		if($_POST)
		{
			$data['event_name'] = $event_name = $this->input->post('event_name');
			$data['date_event'] = $date_event = $this->input->post('date_event');
			$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');
			
			$filter = $this->load->validation(
				array(
					'required|E|Event Name' => $event_name,
					'required|E|Date Event' => $date_event,
					'required|E|Expiration Date' => $expiration_date
				)
			);
			
			if($filter)
			{
				$data['error'] = $filter;
			}
			else if( ! checkdate(date("m",strtotime($date_event)),date("d",strtotime($date_event)),date("y",strtotime($date_event))))
			{
				$data['error'] = "Incorrect date at Date Event!";
			}
			else if( ! checkdate(date("m",strtotime($expiration_date)),date("d",strtotime($expiration_date)),date("y",strtotime($expiration_date))))
			{
				$data['error'] = "Incorrect date at Expiration Date!";
			}
			else
			{
				$file = $_FILES['file']['name'];
				$type = $_FILES['file']['type'];
				$size = $_FILES['file']['size'];
				$temp = $_FILES['file']['tmp_name'];
				$error = $_FILES['file']['error'];
				
				if( ! $file)
				{
					$data['error'] = "Please select a file!";
				}
				else
				{
					if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
					{
						switch($error)
						{
							case UPLOAD_ERR_INI_SIZE: 
								$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
								break;
							case UPLOAD_ERR_FORM_SIZE: 
								$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
								break;
							case UPLOAD_ERR_PARTIAL: 
								$message = "The uploaded file was only partially uploaded"; 
								break;
							case UPLOAD_ERR_NO_FILE: 
								$message = "No file was uploaded"; 
								break;
							case UPLOAD_ERR_NO_TMP_DIR: 
								$message = "Missing a temporary folder"; 
								break;
							case UPLOAD_ERR_CANT_WRITE: 
								$message = "Failed to write file to disk"; 
								break;
							case UPLOAD_ERR_EXTENSION: 
								$message = "File upload stopped by extension"; 
								break;
							default:
								$message = "Unknown upload error"; 
								break; 
						}
						
						if($error)
						{
							$data['error'] = $message;
						}
						else
						{
							if($type == "image/pjpeg" OR $type == "image/jpeg")
								$ex = ".jpg";
							else
								$ex = ".png";
							
							// Creating folder...
							$last_id = $this->QModel->query("SHOW TABLE STATUS LIKE 'zareks'");
							$glast_id = $this->QModel->g($last_id);
							
							mkdir(FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment'], 0755);
							mkdir(FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/original", 0755);
							mkdir(FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/semi-original", 0755);
							mkdir(FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/thumbnail", 0755);
							$file = FCPATH."/uploads/index.html";
							$newfile = FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/index.html";
							$newfile2 = FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/original/index.html";
							$newfile3 = FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/semi-original/index.html";
							$newfile4 = FCPATH."/uploads/gallery/zareks/".$glast_id['Auto_increment']."/thumbnail/index.html";
							copy($file, $newfile);
							copy($file, $newfile2);
							copy($file, $newfile3);
							copy($file, $newfile4);
							
							$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
							$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
							$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
							move_uploaded_file($temp,"uploads/gallery/zareks/".$glast_id['Auto_increment']."/original/".$orginal_naming);
							
							// Resizing...
							$this->load->resize("uploads/gallery/zareks/".$glast_id['Auto_increment']."/original/".$orginal_naming,"uploads/gallery/zareks/".$glast_id['Auto_increment']."/semi-original/".$semi_naming,224,224);
							$this->load->resize("uploads/gallery/zareks/".$glast_id['Auto_increment']."/original/".$orginal_naming,"uploads/gallery/zareks/".$glast_id['Auto_increment']."/thumbnail/".$thumb_naming,126,126);
							
							// Inserting...
							$insert = array(
								'client_name' => $event_name,
								'date_client' => date("Y-m-d",strtotime($date_event)),
								'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
								'original_image' => $orginal_naming,
								'semi_original_image' => $semi_naming,
								'thumbnail_image' => $thumb_naming,
								'client_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('zareks',$insert);
							
							$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added.</span>');
							redirect('admin/zareks_edit_event/'.$glast_id['Auto_increment']);
						}
					}
					else if($size > 20000000)
					{
						$data['error'] = "File size must be 20MB below!";
					}
					else
					{
						$data['error'] = "File extension must be .png or .jpg or .jpeg";
					}
				}
			}
		}
		
		$this->load->view("admin/gallery/zareks/create_event",$data);
	}
	
	public function zareks_edit_event($zareks_id = NULL)
	{
		$query = $this->QModel->sfwa('zareks','zareks_id',$zareks_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$data["title"] = "Edit Event";
			$data["menu"] = 2;
			
			$get = $this->QModel->g($query);
			$data['event_name'] = $get['client_name'];
			$data['date_event'] = $get['date_client'];
			$data['expiration_date'] = $get['expiration_date'];
			$data['event_post'] = $get['posted'];
			$data['thumbnail_image'] = $get['thumbnail_image'];
			$data['zareks_id'] = $zareks_id;
			
			if($_POST)
			{
				$save = $this->input->post('save');
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $save && ! $upload && ! $delete_selected)
				{
					redirect('404');
				}
				else
				{
					if($save)
					{
						$data['event_name'] = $event_name = $this->input->post('event_name');
						$data['date_event'] = $date_event = $this->input->post('date_event');
						$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');
						$data['event_post'] = $event_post = $this->input->post('event_post');
						
						$filter = $this->load->validation(
							array(
								'required|E|Event Name' => $event_name,
								'required|E|Date Event' => $date_event,
								'required|E|Expiration Date' => $expiration_date,
								'required|E|Event Post' => $event_post
							)
						);
						
						if($filter)
						{
							$data['error'] = $filter;
						}
						else if( ! checkdate(date("m",strtotime($date_event)),date("d",strtotime($date_event)),date("y",strtotime($date_event))))
						{
							$data['error'] = "Incorrect date at Date Event!";
						}
						else if( ! checkdate(date("m",strtotime($expiration_date)),date("d",strtotime($expiration_date)),date("y",strtotime($expiration_date))))
						{
							$data['error'] = "Incorrect date at Expiration Date!";
						}
						else
						{
							$file = $_FILES['file']['name'];
							$type = $_FILES['file']['type'];
							$size = $_FILES['file']['size'];
							$temp = $_FILES['file']['tmp_name'];
							$error = $_FILES['file']['error'];

							if($file)
							{
								if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
								{
									switch($error)
									{
										case UPLOAD_ERR_INI_SIZE: 
											$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
											break;
										case UPLOAD_ERR_FORM_SIZE: 
											$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
											break;
										case UPLOAD_ERR_PARTIAL: 
											$message = "The uploaded file was only partially uploaded"; 
											break;
										case UPLOAD_ERR_NO_FILE: 
											$message = "No file was uploaded"; 
											break;
										case UPLOAD_ERR_NO_TMP_DIR: 
											$message = "Missing a temporary folder"; 
											break;
										case UPLOAD_ERR_CANT_WRITE: 
											$message = "Failed to write file to disk"; 
											break;
										case UPLOAD_ERR_EXTENSION: 
											$message = "File upload stopped by extension"; 
											break;
										default:
											$message = "Unknown upload error"; 
											break; 
									}
									
									if($error)
									{
										$data['error'] = $message;
									}
									else
									{
										if($type == "image/pjpeg" OR $type == "image/jpeg")
											$ex = ".jpg";
										else
											$ex = ".png";
										
										$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
										$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
										$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
										move_uploaded_file($temp,"uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming);
										
										// Deleting old picture...
										@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/original/'.$get['original_image']);
										@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/semi-original/'.$get['semi_original_image']);
										@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/thumbnail/'.$get['thumbnail_image']);
										
										// Resizing...
										$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/semi-original/".$semi_naming,224,224);
										$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/thumbnail/".$thumb_naming,126,126);
										
										$update = array(
											'client_name' => $event_name,
											'date_client' => date("Y-m-d",strtotime($date_event)),
											'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
											'original_image' => $orginal_naming,
											'semi_original_image' => $semi_naming,
											'thumbnail_image' => $thumb_naming,
											'posted' => $event_post
										);
										$this->QModel->update('zareks',$update,array('zareks_id' => $zareks_id));
										
										$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully saved.</span>');
										redirect('admin/zareks_edit_event/'.$zareks_id);
									}
								}
								else if($size > 20000000)
								{
									$data['error'] = "File size must be 20MB below!";
								}
								else
								{
									$data['error'] = "File extension must be .png or .jpg or .jpeg";
								}
							}
							else
							{
								$update = array(
									'client_name' => $event_name,
									'date_client' => date("Y-m-d",strtotime($date_event)),
									'expiration_date' => date("Y-m-d",strtotime($expiration_date)),
									'posted' => $event_post,
									'client_created' => date("Y-m-d H:i:s"),
								);
								$this->QModel->update('zareks',$update,array('zareks_id' => $zareks_id));
								
								$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully saved.</span>');
								redirect('admin/zareks_edit_event/'.$zareks_id);
							}
						}
					}
					else if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('zareks_photos',array('zareks_photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/zareks_edit_event/'.$zareks_id);
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($type == "image/pjpeg" OR $type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
									$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
									$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
									move_uploaded_file($temp,"uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming);
									
									// Resizing...
									$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/semi-original/".$semi_naming,224,224);
									$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/thumbnail/".$thumb_naming,126,126);
									
									// Get original upload name file.
									$new_fileName = explode(".",$file);
									
									$insert = array(
										'zareks_id' => $zareks_id,
										'photos' => $new_fileName[0].$ex,
										'original_image' => $orginal_naming,
										'semi_original_image' => $semi_naming,
										'thumbnail_image' => $thumb_naming,
										'clients_photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('zareks_photos',$insert);
									
									echo "Successfully Uploaded - ".$new_fileName[0].$ex;
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
			
			if($_POST)
			{
				/* Show nothing */
			}
			else
			{
				$this->load->view("admin/gallery/zareks/edit_event",$data);
			}
		}
	}
	
	public function zareks_upload_to_many($zareks_id = NULL)
	{
		$query = $this->QModel->sfwa('zareks','zareks_id',$zareks_id);
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			set_time_limit(0);
			error_reporting(0);
			ini_set('max_file_uploads','1000');
			
			// Initialization
			foreach ($_FILES as $k=>$v) { if(is_array($v)) { foreach ($v as $sk=>$sv) { $arr[$sk][$k]=$sv; } } }
			
			// Getting Started...
			$i = 0; foreach($arr['name'] as $a) { foreach($a as $b) { $file[$i] = $b; $i++; } }
			$i = 0; foreach($arr['type'] as $a) { foreach($a as $b) { $type[$i] = $b; $i++; } }
			$i = 0; foreach($arr['size'] as $a) { foreach($a as $b) { $size[$i] = $b; $i++; } }
			$i = 0; foreach($arr['tmp_name'] as $a) { foreach($a as $b) { $temp[$i] = $b; $i++; } }
			$i = 0; foreach($arr['error'] as $a) { foreach($a as $b) { $error[$i] = $b; $i++; } }
			$count_total = count($file);

			for($i = 0; $i < $count_total; $i++)
			{
				if( ! $file[$i])
				{
					$data['error'] = "Please select a file!";
					break;
				}
				else
				{
					$qexisting = $this->QModel->sfwa('zareks_photos',array('zareks_id','photos'),array($zareks_id,$file[$i]));
					$cexisting = $this->QModel->c($qexisting);
					
					if($cexisting)
					{
						// Do Nothing.
					}
					else
					{
						if($type[$i] == "image/pjpeg" && $size[$i] < 20000000 OR $type[$i] == "image/jpeg" && $size[$i] < 20000000 OR $type[$i] == "image/png" && $size[$i] < 20000000)
						{
							switch($error[$i])
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error[$i])
							{
								echo $message;
								break;
							}
							else
							{
								if($type[$i] == "image/pjpeg" OR $type[$i] == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$orginal_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-original",'adler32').$ex;
								$semi_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-semi",'adler32').$ex;
								$thumb_naming = hash_password($file[$i].$type[$i].date('YmdHis')."-thumb",'adler32').$ex;
								move_uploaded_file($temp[$i],"uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming);
								
								// Resizing...
								$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/semi-original/".$semi_naming,224,224);
								$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/thumbnail/".$thumb_naming,126,126);
								
								// Get original upload name file.
								$new_fileName = explode(".",$file[$i]);
								
								$insert = array(
									'zareks_id' => $zareks_id,
									'photos' => $new_fileName[0].$ex,
									'original_image' => $orginal_naming,
									'semi_original_image' => $semi_naming,
									'thumbnail_image' => $thumb_naming,
									'clients_photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->insert('zareks_photos',$insert);
								
								$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added photo.</span>');
							}
						}
						else if($size[$i] < 20000000)
						{
							echo "File size must be 20MB below!";
							break;
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
							break;
						}
					}
				}
			}
			
			echo "Successfully Uploaded.";
		}
	}
	
	/* ====================================================
	 * End of Gallery - Zarek's
	 * ================================================= */
	 
	public function events()
	{
		$data["title"] = "Create Event";
		$data["menu"] = 3;
		
		$this->load->view("admin/events",$data);
	}
	
	/* ====================================================
	 * Events Cover Photo
	 * ================================================= */
	
	public function events_cover_reupload($photo_id = NULL)
	{
		$categ = $this->input->get('type');
		
		if($categ == "Weddings")
		{
			$query = $this->QModel->sfwa('events_cover_photo',array('photos_id','category'),array($photo_id,'Weddings'));
			
			if($this->QModel->c($query))
			{
				// Events Cover Photo - Weddings
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/weddings/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/weddings/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/weddings/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/weddings/cover-original/".$naming,"uploads/events/weddings/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Engagement")
		{
			$query = $this->QModel->sfwa('events_cover_photo',array('photos_id','category'),array($photo_id,'Engagement'));
			
			if($this->QModel->c($query))
			{
				// Events Cover Photo - Engagement
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/engagement/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/engagement/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/engagement/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/engagement/cover-original/".$naming,"uploads/events/engagement/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Bar Mitzvahs")
		{
			$query = $this->QModel->sfwa('events_cover_photo',array('photos_id','category'),array($photo_id,'Bar Mitzvahs'));
			
			if($this->QModel->c($query))
			{
				// Events Cover Photo - Bar Mitzvahs
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/bar_mitzvahs/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/bar_mitzvahs/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/bar_mitzvahs/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/bar_mitzvahs/cover-original/".$naming,"uploads/events/bar_mitzvahs/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Corporate")
		{
			$query = $this->QModel->sfwa('events_cover_photo',array('photos_id','category'),array($photo_id,'Corporate'));
			
			if($this->QModel->c($query))
			{
				// Events Cover Photo - Corporate
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/corporate/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/corporate/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/corporate/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/corporate/cover-original/".$naming,"uploads/events/corporate/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			redirect('404');
		}
	}
	
	public function portraits()
	{
		$data["title"] = "Create Portraits";
		$data["menu"] = 4;
		
		$this->load->view("admin/portraits",$data);
	}
	
	/* ====================================================
	 * Portrait Cover Photo
	 * ================================================= */
	
	public function portrait_cover_reupload($photo_id = NULL)
	{
		$categ = $this->input->get('type');
		
		if($categ == "Family")
		{
			$query = $this->QModel->sfwa('portrait_cover_photo',array('photos_id','category'),array($photo_id,'Family'));
			
			if($this->QModel->c($query))
			{
				// Portrait Cover Photo - Family
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/family/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/family/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/family/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/family/cover-original/".$naming,"uploads/portraits/family/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portrait_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Individual")
		{
			$query = $this->QModel->sfwa('portrait_cover_photo',array('photos_id','category'),array($photo_id,'Individual'));
			
			if($this->QModel->c($query))
			{
				// Portrait Cover Photo - Individual
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/individual/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/individual/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/individual/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/individual/cover-original/".$naming,"uploads/portraits/individual/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portrait_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Children")
		{
			$query = $this->QModel->sfwa('portrait_cover_photo',array('photos_id','category'),array($photo_id,'Children'));
			
			if($this->QModel->c($query))
			{
				// Portrait Cover Photo - Children
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/children/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/children/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/children/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/children/cover-original/".$naming,"uploads/portraits/children/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portrait_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Pregnancy/Boudoir")
		{
			$query = $this->QModel->sfwa('portrait_cover_photo',array('photos_id','category'),array($photo_id,'Pregnancy/Boudoir'));
			
			if($this->QModel->c($query))
			{
				// Portrait Cover Photo - Pregnancy/Boudair
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/pregnancy_boudair/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/pregnancy_boudair/cover-original/".$naming,"uploads/portraits/pregnancy_boudair/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portrait_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			redirect('404');
		}
	}
	
	public function headshots()
	{
		$data["title"] = "Create Headshots";
		$data["menu"] = 5;
		
		$this->load->view("admin/headshots",$data);
	}
	
	/* ====================================================
	 * Headshots Cover Photo
	 * ================================================= */
	
	public function headshots_cover_reupload($photo_id = NULL)
	{
		$categ = $this->input->get('type');
		
		if($categ == "Adult")
		{
			$query = $this->QModel->sfwa('headshots_cover_photo',array('photos_id','category'),array($photo_id,'Adult'));
			
			if($this->QModel->c($query))
			{
				// Headshots Cover Photo - Adult
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/adult/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/adult/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/adult/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/adult/cover-original/".$naming,"uploads/headshots/adult/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Children")
		{
			$query = $this->QModel->sfwa('headshots_cover_photo',array('photos_id','category'),array($photo_id,'Children'));
			
			if($this->QModel->c($query))
			{
				// Headshots Cover Photo - Children
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/child/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/child/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/child/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/child/cover-original/".$naming,"uploads/headshots/child/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Business")
		{
			$query = $this->QModel->sfwa('headshots_cover_photo',array('photos_id','category'),array($photo_id,'Business'));
			
			if($this->QModel->c($query))
			{
				// Headshots Cover Photo - Business
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/business/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/business/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/business/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/business/cover-original/".$naming,"uploads/headshots/business/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			redirect('404');
		}
	}
	
	public function digital_imaging()
	{
		$data["title"] = "Create Digital Imaging";
		$data["menu"] = 6;
		
		$this->load->view("admin/digital_imaging",$data);
	}
	
	/* ====================================================
	 * Digital Cover Photo
	 * ================================================= */
	
	public function digital_imaging_cover_reupload($photo_id = NULL)
	{
		$categ = $this->input->get('type');
		
		if($categ == "Retouching Restoration - Before and after")
		{
			$query = $this->QModel->sfwa('digital_imaging_cover_photo',array('photos_id','category'),array($photo_id,'Retouching Restoration - Before and after'));
			
			if($this->QModel->c($query))
			{
				// Digital Imaging Cover Photo - Retouching Restoration - Before and after
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/digital_imaging/retouching/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/digital_imaging/retouching/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/retouching/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/digital_imaging/retouching/cover-original/".$naming,"uploads/digital_imaging/retouching/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('digital_imaging_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Image Manipulation")
		{
			$query = $this->QModel->sfwa('digital_imaging_cover_photo',array('photos_id','category'),array($photo_id,'Image Manipulation'));
			
			if($this->QModel->c($query))
			{
				// Digital Imaging Cover Photo - Image Manipulation
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/digital_imaging/image_manipulation/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/digital_imaging/image_manipulation/cover-original/".$naming,"uploads/digital_imaging/image_manipulation/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('digital_imaging_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			redirect('404');
		}
	}
	
	public function category()
	{
		$data["title"] = "Upload Photos";
		$data['type'] = $type = $this->input->get('type');
		 
		
		if( $type == "weddings" )
		{
			// Events - Weddings
			$data['categ'] = "Weddings";
			$data['location_thumb'] = "uploads/events/weddings/thumbnail/";
			$data['location_orig'] = "uploads/events/weddings/original/";
			$data['table_name'] = "events_photos";
			$data['link'] = "admin/events";
			$data["menu"] = 3;
			
			$q = $this->QModel->sfwa('events_photos',array('category'),array('Weddings'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('events_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=weddings');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/events/weddings/original/".$naming);
									
									// Resizing...
									$this->load->resize("uploads/events/weddings/original/".$naming,"uploads/events/weddings/semi-original/".$naming,270,270);
									$this->load->resize("uploads/events/weddings/original/".$naming,"uploads/events/weddings/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Weddings",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('events_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		else if( $type == "engagement" )
		{
			// Events - Engagement
			$data['categ'] = "Engagement";
			$data['location_thumb'] = "uploads/events/engagement/thumbnail/";
			$data['location_orig'] = "uploads/events/engagement/original/";
			$data['table_name'] = "events_photos";
			$data['link'] = "admin/events";
			$data["menu"] = 3;
			
			$q = $this->QModel->sfwa('events_photos',array('category'),array('Engagement'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('events_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=engagement');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/events/engagement/original/".$naming);
									
									// Resizing...
									$this->load->resize("uploads/events/engagement/original/".$naming,"uploads/events/engagement/semi-original/".$naming,270,270);
									$this->load->resize("uploads/events/engagement/original/".$naming,"uploads/events/engagement/thumbnail/".$naming,126,126);
									
									
									$insert = array(
										'photos' => $naming,
										'category' => "Engagement",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('events_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		else if( $type == "bar_mitzvahs" )
		{
			// Events - Bar Mitzvahs
			$data['categ'] = "Bar Mitzvahs";
			$data['location_thumb'] = "uploads/events/bar_mitzvahs/thumbnail/";
			$data['location_orig'] = "uploads/events/bar_mitzvahs/original/";
			$data['table_name'] = "events_photos";
			$data['link'] = "admin/events";
			$data["menu"] = 3;
			
			$q = $this->QModel->sfwa('events_photos',array('category'),array('Bar Mitzvahs'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('events_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=bar_mitzvahs');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/events/bar_mitzvahs/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/events/bar_mitzvahs/original/".$naming,"uploads/events/bar_mitzvahs/semi-original/".$naming,270,270);
									$this->load->resize("uploads/events/bar_mitzvahs/original/".$naming,"uploads/events/bar_mitzvahs/thumbnail/".$naming,126,126);

									
									$insert = array(
										'photos' => $naming,
										'category' => "Bar Mitzvahs",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('events_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		else if( $type == "corporate" )
		{
			// Events - Corporate
			$data['categ'] = "Corporate";
			$data['location_thumb'] = "uploads/events/corporate/thumbnail/";
			$data['location_orig'] = "uploads/events/corporate/original/";
			$data['table_name'] = "events_photos";
			$data['link'] = "admin/events";
			$data["menu"] = 3;
			
			$q = $this->QModel->sfwa('events_photos',array('category'),array('Corporate'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('events_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=corporate');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/events/corporate/original/".$naming);
									
									// Resizing...
									$this->load->resize("uploads/events/corporate/original/".$naming,"uploads/events/corporate/semi-original/".$naming,270,270);
									$this->load->resize("uploads/events/corporate/original/".$naming,"uploads/events/corporate/thumbnail/".$naming,126,126);

									
									$insert = array(
										'photos' => $naming,
										'category' => "Corporate",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('events_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "family" )
		{
			//Portraits - Family
			$data['categ'] = "Family";
			$data['location_thumb'] = "uploads/portraits/family/thumbnail/";
			$data['location_orig'] = "uploads/portraits/family/original/";
			$data['table_name'] = "portraits_photos";
			$data['link'] = "admin/portraits";
			$data["menu"] = 4;
			
			$q = $this->QModel->sfwa('portraits_photos',array('category'),array('Family'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('portraits_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=family');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/portraits/family/original/".$naming);
									
									// Resizing...
									$this->load->resize("uploads/portraits/family/original/".$naming,"uploads/portraits/family/semi-original/".$naming,270,270);
									$this->load->resize("uploads/portraits/family/original/".$naming,"uploads/portraits/family/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Family",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('portraits_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}	
		}
		elseif( $type == "individual" )
		{
			//Portraits - Individual
			$data['categ'] = "Individual";
			$data['location_thumb'] = "uploads/portraits/individual/thumbnail/";
			$data['location_orig'] = "uploads/portraits/individual/original/";
			$data['table_name'] = "portraits_photos";
			$data['link'] = "admin/portraits";
			$data["menu"] = 4;
			
			$q = $this->QModel->sfwa('portraits_photos',array('category'),array('Individual'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('portraits_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=individual');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/portraits/individual/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/portraits/individual/original/".$naming,"uploads/portraits/individual/semi-original/".$naming,270,270);
									$this->load->resize("uploads/portraits/individual/original/".$naming,"uploads/portraits/individual/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Individual",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('portraits_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "children" )
		{
			//Portraits - Children
			$data['categ'] = "Children";
			$data['location_thumb'] = "uploads/portraits/children/thumbnail/";
			$data['location_orig'] = "uploads/portraits/children/original/";
			$data['table_name'] = "portraits_photos";
			$data['link'] = "admin/portraits";
			$data["menu"] = 4;
			
			$q = $this->QModel->sfwa('portraits_photos',array('category'),array('Children'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('portraits_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=children');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/portraits/children/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/portraits/children/original/".$naming,"uploads/portraits/children/semi-original/".$naming,270,270);
									$this->load->resize("uploads/portraits/children/original/".$naming,"uploads/portraits/children/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Children",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('portraits_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "pregnancy_boudoir" )
		{
			//Portraits - Pregnancy Boudair
			$data['categ'] = "Pregnancy/Boudoir";
			$data['location_thumb'] = "uploads/portraits/pregnancy_boudair/thumbnail/";
			$data['location_orig'] = "uploads/portraits/pregnancy_boudair/original/";
			$data['table_name'] = "portraits_photos";
			$data['link'] = "admin/portraits";
			$data["menu"] = 4;
			
			$q = $this->QModel->sfwa('portraits_photos',array('category'),array('Pregnancy/Boudoir'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('portraits_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=pregnancy_boudoir');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/portraits/pregnancy_boudair/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/portraits/pregnancy_boudair/original/".$naming,"uploads/portraits/pregnancy_boudair/semi-original/".$naming,270,270);
									$this->load->resize("uploads/portraits/pregnancy_boudair/original/".$naming,"uploads/portraits/pregnancy_boudair/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Pregnancy/Boudoir",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('portraits_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "adult" )
		{
			//Headshots - Adult
			$data['categ'] = "Adult";
			$data['location_thumb'] = "uploads/headshots/adult/thumbnail/";
			$data['location_orig'] = "uploads/headshots/adult/original/";
			$data['table_name'] = "headshots_photos";
			$data['link'] = "admin/headshots";
			$data["menu"] = 5;
			
			$q = $this->QModel->sfwa('headshots_photos',array('category'),array('Adult'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('headshots_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=adult');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/headshots/adult/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/headshots/adult/original/".$naming,"uploads/headshots/adult/semi-original/".$naming,270,270);
									$this->load->resize("uploads/headshots/adult/original/".$naming,"uploads/headshots/adult/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Adult",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('headshots_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "children2" )
		{
			//Headshots - Child
			$data['categ'] = "Child";
			$data['location_thumb'] = "uploads/headshots/child/thumbnail/";
			$data['location_orig'] = "uploads/headshots/child/original/";
			$data['table_name'] = "headshots_photos";
			$data['link'] = "admin/headshots";
			$data["menu"] = 5;
			
			$q = $this->QModel->sfwa('headshots_photos',array('category'),array('Child'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('headshots_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=children2');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
										
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/headshots/child/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/headshots/child/original/".$naming,"uploads/headshots/child/semi-original/".$naming,270,270);
									$this->load->resize("uploads/headshots/child/original/".$naming,"uploads/headshots/child/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Child",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('headshots_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "business" )
		{
			//Headshots - Business
			$data['categ'] = "Business";
			$data['location_thumb'] = "uploads/headshots/business/thumbnail/";
			$data['location_orig'] = "uploads/headshots/business/original/";
			$data['table_name'] = "headshots_photos";
			$data['link'] = "admin/headshots";
			$data["menu"] = 5;
			
			$q = $this->QModel->sfwa('headshots_photos',array('category'),array('Business'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('headshots_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=business');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/headshots/business/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/headshots/business/original/".$naming,"uploads/headshots/business/semi-original/".$naming,270,270);
									$this->load->resize("uploads/headshots/business/original/".$naming,"uploads/headshots/business/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Business",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('headshots_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "before_after" )
		{
			//Digital Imaging - Retouching Restoration
			$data['categ'] = "Retouching Restoration - Before and after";
			$data['location_thumb'] = "uploads/digital_imaging/retouching/thumbnail/";
			$data['location_orig'] = "uploads/digital_imaging/retouching/original/";
			$data['table_name'] = "digital_imaging_photos";
			$data['link'] = "admin/digital_imaging";
			$data["menu"] = 6;
			
			$q = $this->QModel->sfwa('digital_imaging_photos',array('category'),array('Retouching Restoration - Before and after'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('digital_imaging_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=before_after');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/digital_imaging/retouching/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/digital_imaging/retouching/original/".$naming,"uploads/digital_imaging/retouching/semi-original/".$naming,270,270);
									$this->load->resize("uploads/digital_imaging/retouching/original/".$naming,"uploads/digital_imaging/retouching/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Retouching Restoration - Before and after",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('digital_imaging_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		elseif( $type == "image_manipulation" )
		{
			//Digital Imaging - Image Manipulation
			$data['categ'] = "Image Manipulation";
			$data['location_thumb'] = "uploads/digital_imaging/image_manipulation/thumbnail/";
			$data['location_orig'] = "uploads/digital_imaging/image_manipulation/original/";
			$data['table_name'] = "digital_imaging_photos";
			$data['link'] = "admin/digital_imaging";
			$data["menu"] = 6;
			
			$q = $this->QModel->sfwa('digital_imaging_photos',array('category'),array('Image Manipulation'));
			$g = $this->QModel->g($q);
			
			$data['photos_id'] = $g['photos_id'];
			
			if($_POST)
			{
				$delete_selected = $this->input->post('delete_selected');
				$upload = $this->input->post('upload');
				
				if( ! $delete_selected && ! $upload)
				{
					redirect('404');
				}
				else
				{
					if($delete_selected)
					{
						$deleteImg = $this->input->post('deleteImg');

						foreach($deleteImg as $a => $b)
						{
							$this->QModel->delete('digital_imaging_photos',array('photos_id' => $b));
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted.</span>');
						redirect('admin/category?type=image_manipulation');
					}
					else
					{
						$file = $_FILES['Filedata']['name'];
						$pic_type = $_FILES['Filedata']['type'];
						$size = $_FILES['Filedata']['size'];
						$temp = $_FILES['Filedata']['tmp_name'];
						$error = $_FILES['Filedata']['error'];

						$fileTypes = array('jpg','jpeg','gif','png');
						$fileParts = pathinfo($file);

						if( ! $file)
						{
							exit("Please select a file!");
						}
						else
						{
							if(in_array($fileParts['extension'],$fileTypes) && $size < 20000000)
							{
								switch($error)
								{
									case UPLOAD_ERR_INI_SIZE: 
										$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
										break;
									case UPLOAD_ERR_FORM_SIZE: 
										$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
										break;
									case UPLOAD_ERR_PARTIAL: 
										$message = "The uploaded file was only partially uploaded"; 
										break;
									case UPLOAD_ERR_NO_FILE: 
										$message = "No file was uploaded"; 
										break;
									case UPLOAD_ERR_NO_TMP_DIR: 
										$message = "Missing a temporary folder"; 
										break;
									case UPLOAD_ERR_CANT_WRITE: 
										$message = "Failed to write file to disk"; 
										break;
									case UPLOAD_ERR_EXTENSION: 
										$message = "File upload stopped by extension"; 
										break;
									default:
										$message = "Unknown upload error"; 
										break; 
								}
								
								if($error)
								{
									exit($message);
								}
								else
								{
									if($pic_type == "image/pjpeg" OR $pic_type == "image/jpeg")
										$ex = ".jpg";
									else
										$ex = ".png";
									
									$naming = hash_password($file.$pic_type.date('YmdHis'),'adler32').$ex;
									move_uploaded_file($temp,"uploads/digital_imaging/image_manipulation/original/".$naming);

									// Resizing...
									$this->load->resize("uploads/digital_imaging/image_manipulation/original/".$naming,"uploads/digital_imaging/image_manipulation/semi-original/".$naming,270,270);
									$this->load->resize("uploads/digital_imaging/image_manipulation/original/".$naming,"uploads/digital_imaging/image_manipulation/thumbnail/".$naming,126,126);
									
									$insert = array(
										'photos' => $naming,
										'category' => "Image Manipulation",
										'photos_created' => date("Y-m-d H:i:s")
									);
									$this->QModel->insert('digital_imaging_photos',$insert);
									
									echo "Successfully Uploaded - ".$naming[0];
									
								}
							}
							else if($size > 20000000)
							{
								exit("File size must be 20MB below!");
							}
							else
							{
								exit("File extension must be .png or .jpg or .jpeg");
							}
						}
					}
				}
			}
		}
		else
		{
			redirect('404');
		}
		
		if($_POST)
		{
			/* Show nothing */
		}
		else
		{
			$this->load->view("admin/category_upload",$data);
		}
	}
	
	public function delete_client($clients_id = NULL, $photos_id = NULL)
	{
		$query = $this->QModel->sfwa(
			'clients_photos',
			array('clients_photos_id'),
			array($photos_id)
		);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$where = array(
				'clients_photos_id' => $photos_id
			);
			$this->QModel->delete(
				'clients_photos', $where
			);
			
			unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/original/'.$get['original_image']);
			unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/semi-original/'.$get['semi_original_image']);
			unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$get['thumbnail_image']);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted the photo.</span>');
			redirect('admin/edit_event/'.$clients_id);
		}
	}
	
	public function zareks_delete_client($zareks_id = NULL, $photos_id = NULL)
	{
		$query = $this->QModel->sfwa(
			'zareks_photos',
			array('zareks_photos_id'),
			array($photos_id)
		);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$where = array(
				'zareks_photos_id' => $photos_id
			);
			$this->QModel->delete(
				'zareks_photos', $where
			);
			
			unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/original/'.$get['original_image']);
			unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/semi-original/'.$get['semi_original_image']);
			unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/thumbnail/'.$get['thumbnail_image']);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted the photo.</span>');
			redirect('admin/zareks_edit_event/'.$zareks_id);
		}
	}
	
	/********************* Delete Category for Events, Headshots, Digital Imaging and Image Manipulation *************************/
	public function delete_categroy($photos_id = NULL, $table_name = NULL)
	{
		$query = $this->QModel->sfwa(
			$table_name,
			array('photos_id'),
			array($photos_id)
		);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'photos_id' => $photos_id
			);
			$this->QModel->delete(
				$table_name, $where
			);
			
			$get = $this->QModel->g($query);
			
			if( $get['category'] == "Weddings")
			{
				$type = 'weddings';
				
				unlink(FCPATH.'/uploads/events/weddings/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/weddings/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/weddings/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Engagement")
			{
				$type = 'engagement';
				
				unlink(FCPATH.'/uploads/events/engagement/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/engagement/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/engagement/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Bar Mitzvahs")
			{
				$type = 'bar_mitzvahs';
				
				unlink(FCPATH.'/uploads/events/bar_mitzvahs/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/bar_mitzvahs/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/bar_mitzvahs/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Corporate")
			{
				$type = 'corporate';
				
				unlink(FCPATH.'/uploads/events/corporate/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/corporate/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/events/corporate/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Family")
			{
				$type = 'family';
			
				unlink(FCPATH.'/uploads/portraits/family/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/family/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/family/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Individual")
			{
				$type = 'individual';
			
				unlink(FCPATH.'/uploads/portraits/individual/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/individual/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/individual/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Children")
			{
				$type = 'children';
			
				unlink(FCPATH.'/uploads/portraits/children/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/children/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/children/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Pregnancy/Boudoir")
			{
				$type = 'pregnancy_boudoir';
			
				unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Adult")
			{
				$type = 'adult';
			
				unlink(FCPATH.'/uploads/headshots/adult/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/adult/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/adult/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Child")
			{
				$type = 'children2';
			
				unlink(FCPATH.'/uploads/headshots/child/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/child/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/child/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Business")
			{
				$type = 'business';
			
				unlink(FCPATH.'/uploads/headshots/business/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/business/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/headshots/business/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Retouching Restoration - Before and after")
			{
				$type = 'before_after';
			
				unlink(FCPATH.'/uploads/digital_imaging/retouching/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/digital_imaging/retouching/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/digital_imaging/retouching/thumbnail/'.$get['photos']);
			}
			else if( $get['category'] == "Image Manipulation")
			{
				$type = 'image_manipulation';
			
				unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/original/'.$get['photos']);
				unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/semi-original/'.$get['photos']);
				unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/thumbnail/'.$get['photos']);
			}
			else
			{
				redirect('404');
			}
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted the photo.</span>');
			redirect('admin/category?type='.$type);
		}
		
	}
	
	public function video()
	{
		$data["title"] = "Upload Video";
		$data["menu"] = 7;
		
		$this->load->view("admin/video/video",$data);
	}
	
	/* ====================================================
	 * Video Cover Photo
	 * ================================================= */
	
	public function video_cover_reupload($photo_id = NULL)
	{
		$categ = $this->input->get('type');
		
		if($categ == "Weddings")
		{
			$query = $this->QModel->sfwa('video_cover_photo',array('photos_id','category'),array($photo_id,'Weddings'));
			
			if($this->QModel->c($query))
			{
				// Video Cover Photo - Weddings
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/weddings/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/weddings/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/video/weddings/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/video/weddings/cover-original/".$naming,"uploads/video/weddings/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('video_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Bar Mitzvahs")
		{
			$query = $this->QModel->sfwa('video_cover_photo',array('photos_id','category'),array($photo_id,'Bar Mitzvahs'));
			
			if($this->QModel->c($query))
			{
				// Video Cover Photo - Image Manipulation
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/bar_mitzvahs/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/bar_mitzvahs/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/video/bar_mitzvahs/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/video/bar_mitzvahs/cover-original/".$naming,"uploads/video/bar_mitzvahs/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('video_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Celebration of Life")
		{
			$query = $this->QModel->sfwa('video_cover_photo',array('photos_id','category'),array($photo_id,'Celebration of Life'));
			
			if($this->QModel->c($query))
			{
				// Video Cover Photo - Celebration of Life
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/celebration_of_life/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/celebration_of_life/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/video/celebration_of_life/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/video/celebration_of_life/cover-original/".$naming,"uploads/video/celebration_of_life/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('video_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Growing up Montage")
		{
			$query = $this->QModel->sfwa('video_cover_photo',array('photos_id','category'),array($photo_id,'Growing up Montage'));
			
			if($this->QModel->c($query))
			{
				// Video Cover Photo - Growing up Montage
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/growing_up_montage/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/growing_up_montage/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/video/growing_up_montage/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/video/growing_up_montage/cover-original/".$naming,"uploads/video/growing_up_montage/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('video_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else if($categ == "Specialty")
		{
			$query = $this->QModel->sfwa('video_cover_photo',array('photos_id','category'),array($photo_id,'Specialty'));
			
			if($this->QModel->c($query))
			{
				// Video Cover Photo - Specialty
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/specialty/cover-original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/specialty/cover/'.$get['photos']);
								unlink(FCPATH.'/uploads/video/specialty/cover-original/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/video/specialty/cover-original/".$naming,"uploads/video/specialty/cover/".$naming,270,270);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('video_cover_photo',$update,array('photos_id' => $photo_id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			redirect('404');
		}
	}
	
	public function upload_video()
	{
		set_time_limit(9999999999999999999999999999999999999999999999999);
		ini_set('memory_limit', '4000M');
		ini_set('max_execution_time', '9999999999999999999999999999999999999999999999999');
		ini_set('max_input_time', '9999999999999999999999999999999999999999999999999');
		ignore_user_abort(true);
			
		$data["title"] = "Upload Video";
		$data["menu"] = 7;
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "weddings")
		{
			$data['categ'] = "Weddings";
			$data['location_thumb'] = "../uploads/video/weddings/";
			
			if($_POST)
			{
				$upload_video = $this->input->post('upload_video');
				
				if( ! $upload_video )
				{
					redirect('404');
				}
				else
				{
					$data['video_id'] = $video_id = $this->input->post('video_id',false);
					$data['video_id2'] = $video_id2 = $this->input->post('video_id2',false);
					$data['video_title'] = $video_title = $this->input->post('video_title',false);
					$data['video_title2'] = $video_title2 = $this->input->post('video_title2',false);
					
					if( ! $video_id && ! $video_id2)
					{
						$data['error'] = "Please select and fill up if Youtube or Vimeo.";
					}
					else if($video_id && ! $video_title)
					{
						$data['error'] = "Please fill up youtube video title.";
					}
					else if($video_id2 && ! $video_title2)
					{
						$data['error'] = "Please fill up vimeo video title.";
					}
					else
					{
						if($video_id)
						{
							$insert = array(
								'video_title' => $video_title,
								'video' => $video_id,
								'description' => '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>',
								'category' => "Weddings",
								'video_type' => "youtube",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						else
						{
							$insert = array(
								'video_title' => $video_title2,
								'video' => $video_id2,
								'description' => '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$video_id2.'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
								'category' => "Weddings",
								'video_type' => "vimeo",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added video.</span>');
						redirect('admin/upload_video?type=weddings');
					}
				}
			}
		}
		elseif( $type == "bar_mitzvahs")
		{
			$data['categ'] = "Bar Mitzvahs";
			$data['location_thumb'] = "../uploads/video/bar_mitzvahs/";
			
			if($_POST)
			{
				$upload_video = $this->input->post('upload_video');
				
				if( ! $upload_video )
				{
					redirect('404');
				}
				else
				{
					$data['video_id'] = $video_id = $this->input->post('video_id',false);
					$data['video_id2'] = $video_id2 = $this->input->post('video_id2',false);
					$data['video_title'] = $video_title = $this->input->post('video_title',false);
					$data['video_title2'] = $video_title2 = $this->input->post('video_title2',false);
					
					if( ! $video_id && ! $video_id2)
					{
						$data['error'] = "Please select and fill up if Youtube or Vimeo.";
					}
					else if($video_id && ! $video_title)
					{
						$data['error'] = "Please fill up youtube video title.";
					}
					else if($video_id2 && ! $video_title2)
					{
						$data['error'] = "Please fill up vimeo video title.";
					}
					else
					{
						if($video_id)
						{
							$insert = array(
								'video_title' => $video_title,
								'video' => $video_id,
								'description' => '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>',
								'category' => "Bar Mitzvahs",
								'video_type' => "youtube",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						else
						{
							$insert = array(
								'video_title' => $video_title2,
								'video' => $video_id2,
								'description' => '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$video_id2.'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
								'category' => "Bar Mitzvahs",
								'video_type' => "vimeo",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added video.</span>');
						redirect('admin/upload_video?type=bar_mitzvahs');
					}
				}
			}
		}
		elseif( $type == "celebration_of_life")
		{
			$data['categ'] = "Celebration of Life";
			$data['location_thumb'] = "../uploads/video/celebration_of_life/";
			
			if($_POST)
			{
				$upload_video = $this->input->post('upload_video');
				
				if( ! $upload_video )
				{
					redirect('404');
				}
				else
				{
					$data['video_id'] = $video_id = $this->input->post('video_id',false);
					$data['video_id2'] = $video_id2 = $this->input->post('video_id2',false);
					$data['video_title'] = $video_title = $this->input->post('video_title',false);
					$data['video_title2'] = $video_title2 = $this->input->post('video_title2',false);
					
					if( ! $video_id && ! $video_id2)
					{
						$data['error'] = "Please select and fill up if Youtube or Vimeo.";
					}
					else if($video_id && ! $video_title)
					{
						$data['error'] = "Please fill up youtube video title.";
					}
					else if($video_id2 && ! $video_title2)
					{
						$data['error'] = "Please fill up vimeo video title.";
					}
					else
					{
						if($video_id)
						{
							$insert = array(
								'video_title' => $video_title,
								'video' => $video_id,
								'description' => '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>',
								'category' => "Celebration of Life",
								'video_type' => "youtube",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						else
						{
							$insert = array(
								'video_title' => $video_title2,
								'video' => $video_id2,
								'description' => '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$video_id2.'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
								'category' => "Celebration of Life",
								'video_type' => "vimeo",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added video.</span>');
						redirect('admin/upload_video?type=celebration_of_life');
					}
				}
			}
		}
		elseif( $type == "growing_up_montage")
		{
			$data['categ'] = "Growing up montage";
			$data['location_thumb'] = "../uploads/video/growing_up_montage/";
			
			if($_POST)
			{
				$upload_video = $this->input->post('upload_video');
				
				if( ! $upload_video )
				{
					redirect('404');
				}
				else
				{
					$data['video_id'] = $video_id = $this->input->post('video_id',false);
					$data['video_id2'] = $video_id2 = $this->input->post('video_id2',false);
					$data['video_title'] = $video_title = $this->input->post('video_title',false);
					$data['video_title2'] = $video_title2 = $this->input->post('video_title2',false);
					
					if( ! $video_id && ! $video_id2)
					{
						$data['error'] = "Please select and fill up if Youtube or Vimeo.";
					}
					else if($video_id && ! $video_title)
					{
						$data['error'] = "Please fill up youtube video title.";
					}
					else if($video_id2 && ! $video_title2)
					{
						$data['error'] = "Please fill up vimeo video title.";
					}
					else
					{
						if($video_id)
						{
							$insert = array(
								'video_title' => $video_title,
								'video' => $video_id,
								'description' => '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>',
								'category' => "Growing up montage",
								'video_type' => "youtube",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						else
						{
							$insert = array(
								'video_title' => $video_title2,
								'video' => $video_id2,
								'description' => '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$video_id2.'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
								'category' => "Growing up montage",
								'video_type' => "vimeo",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added video.</span>');
						redirect('admin/upload_video?type=growing_up_montage');
					}
				}
			}
		}
		elseif( $type == "specialty")
		{
			$data['categ'] = "Specialty";
			$data['location_thumb'] = "../uploads/video/specialty/";
			
			if($_POST)
			{
				$upload_video = $this->input->post('upload_video');
				
				if( ! $upload_video )
				{
					redirect('404');
				}
				else
				{
					$data['video_id'] = $video_id = $this->input->post('video_id',false);
					$data['video_id2'] = $video_id2 = $this->input->post('video_id2',false);
					$data['video_title'] = $video_title = $this->input->post('video_title',false);
					$data['video_title2'] = $video_title2 = $this->input->post('video_title2',false);
					
					if( ! $video_id && ! $video_id2)
					{
						$data['error'] = "Please select and fill up if Youtube or Vimeo.";
					}
					else if($video_id && ! $video_title)
					{
						$data['error'] = "Please fill up youtube video title.";
					}
					else if($video_id2 && ! $video_title2)
					{
						$data['error'] = "Please fill up vimeo video title.";
					}
					else
					{
						if($video_id)
						{
							$insert = array(
								'video_title' => $video_title,
								'video' => $video_id,
								'description' => '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>',
								'category' => "Specialty",
								'video_type' => "youtube",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						else
						{
							$insert = array(
								'video_title' => $video_title2,
								'video' => $video_id2,
								'description' => '<iframe width="100%" height="100%" src="https://player.vimeo.com/video/'.$video_id2.'" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
								'category' => "Specialty",
								'video_type' => "vimeo",
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->insert('videos',$insert);
						}
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added video.</span>');
						redirect('admin/upload_video?type=specialty');
					}
				}
			}
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("admin/video/video_upload",$data);
	}
	
	public function video_delete($video_id = NULL)
	{
		
		$query = $this->QModel->sfwa(
					'videos',
					array('video_id'),
					array($video_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'video_id' => $video_id
			);
			$this->QModel->delete(
				'videos', $where
			);
			
			$get = $this->QModel->g($query);
			
			if( $get['category'] == "Weddings")
			{
				$type = "weddings";
			}
			else if( $get['category'] == "Bar Mitzvahs")
			{
				$type = "bar_mitzvahs";
			}
			else if( $get['category'] == "Celebration of Life")
			{
				$type = "celebration_of_life";
			}
			else if( $get['category'] == "Growing Up Montage")
			{
				$type = "growing_up_montage";
			}
			else if( $get['category'] == "Specialty")
			{
				$type = "specialty";
			}
			else
			{
				redirect('404');
			}
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted the Video.</span>');
			redirect('admin/upload_video?type='.$type);
		}
		
	}
	
	public function edit_video($video_id= NULL)
	{
		$data["title"] = "Edit Video";
		$data["menu"] = 7;
		
		$data['video_id'] = $video_id;
		
		$query = $this->QModel->sfwa('videos',array('video_id'),array($video_id));
		
		if($this->QModel->c($query))
		{
			$get = $this->QModel->g($query);
			$data['thumbnail'] = $get['thumbnail'];
			$data['video'] = $get['video'];
			$data['category'] = $get['category'];
			$data['description'] = $get['description'];
			$data['video_title'] = $get['video_title'];
			
			if($get['category'] == "Weddings")
			{
				$data['type'] = "weddings";
				$data['thumb'] = "uploads/video/weddings/thumbnails/";
				$data['location_vid'] = "uploads/video/weddings/";
			}
			else if($get['category'] == "Bar Mitzvahs")
			{
				$data['type'] = "bar_mitzvahs";
				$data['thumb'] = "uploads/video/bar_mitzvahs/thumbnails/";
				$data['location_vid'] = "uploads/video/bar_mitzvahs/";
			}
			else if($get['category'] == "Celebration of Life")
			{
				$data['type'] = "celebrate_life";
				$data['thumb'] = "uploads/video/celebration_of_life/thumbnails/";
				$data['location_vid'] = "uploads/video/celebration_of_life/";
			}
			else if($get['category'] == "Growing Up Montage")
			{
				$data['type'] = "growing_montage";
				$data['thumb'] = "uploads/video/growing_up_montage/thumbnails/";
				$data['location_vid'] = "uploads/video/growing_up_montage/";
			}
			else if($get['category'] == "Specialty")
			{
				$data['type'] = "specialty";
				$data['thumb'] = "uploads/video/specialty/thumbnails/";
				$data['location_vid'] = "uploads/video/specialty/";
			}
			else
			{
				redirect('404');
			}
			
			if($_POST)
			{
				
				$submit = $this->input->post('submit');
				
				if(! $submit)
				{
					redirect('404');
				}
				else
				{
					$video_title = $this->input->post('video_title');
					$description = $this->input->post('description');
					
					$filter = $this->load->validation(
					array(
							'required|E|Video Title' => $video_title
						)
					);
					
					if($filter)
					{
						$data['error'] = $filter;
					}
					else
					{
						$update = array(
							'video_title' => $video_title,
							'description' => $description,
							'video_created' => date("Y-m-d H:i:s")
						);
						$this->QModel->update('videos',$update,array('video_id' => $video_id));
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Updated</span>');
						redirect('admin/edit_video/'.$video_id);
					}
				}
			}
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("admin/video/edit_video",$data);
	}
	
	public function video_reupload($video_id= NULL)
	{
		$data['type'] = $cat = $this->input->get('type');
		
		if($cat == "weddings")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($video_id,'Weddings'));
		}
		elseif($cat == "bar_mitzvahs")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($video_id,'Bar Mitzvahs'));
		}
		elseif($cat == "celebrate_life")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($video_id,'Celebration of Life'));
		}
		elseif($cat == "growing_montage")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($video_id,'Growing Up Montage'));
		}
		elseif($cat == "specialty")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($video_id,'Specialty'));
		}
		else
		{
			redirect('404');
		}
		
		if($this->QModel->c($query))
		{

			if($_FILES)
			{
				$file = $_FILES['upload2']['name'];
				$type = $_FILES['upload2']['type'];
				$size = $_FILES['upload2']['size'];
				$temp = $_FILES['upload2']['tmp_name'];
				$error = $_FILES['upload2']['error'];

				if( ! $file)
				{
					$data['error'] = "Please select a video file!";
				}
				else
				{
					if($type == "video/mp4" && $size < 2000000000 )
					{
						switch($error)
						{
							case UPLOAD_ERR_INI_SIZE: 
								$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
								break;
							case UPLOAD_ERR_FORM_SIZE: 
								$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
								break;
							case UPLOAD_ERR_PARTIAL: 
								$message = "The uploaded file was only partially uploaded"; 
								break;
							case UPLOAD_ERR_NO_FILE: 
								$message = "No file was uploaded"; 
								break;
							case UPLOAD_ERR_NO_TMP_DIR: 
								$message = "Missing a temporary folder"; 
								break;
							case UPLOAD_ERR_CANT_WRITE: 
								$message = "Failed to write file to disk"; 
								break;
							case UPLOAD_ERR_EXTENSION: 
								$message = "File upload stopped by extension"; 
								break;
							default:
								$message = "Unknown upload error"; 
								break; 
						}
						
						if($error)
						{
							$data['error'] = $message;
						}
						else
						{
							if($cat == "weddings")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').'.mp4';
								move_uploaded_file($temp,"uploads/video/weddings/".$naming);
								
								// Deleting old video...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/weddings/'.$get['video']);
							}
							elseif($cat == "bar_mitzvahs")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').'.mp4';
								move_uploaded_file($temp,"uploads/video/bar_mitzvahs/".$naming);
								
								// Deleting old video...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/bar_mitzvahs/'.$get['video']);
							}
							elseif($cat == "celebrate_life")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').'.mp4';
								move_uploaded_file($temp,"uploads/video/celebrate_life/".$naming);
								
								// Deleting old video...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/celebrate_life/'.$get['video']);
							}
							elseif($cat == "growing_montage")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').'.mp4';
								move_uploaded_file($temp,"uploads/video/growing_montage/".$naming);
								
								// Deleting old video...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/growing_montage/'.$get['video']);
							}
							elseif($cat == "specialty")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').'.mp4';
								move_uploaded_file($temp,"uploads/video/specialty/".$naming);
								
								// Deleting old video...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/specialty/'.$get['video']);
							}
							else
							{
								redirect('404');
							}
							
							$update = array(
								'video' => $naming,
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->update('videos',$update,array('video_id' => $video_id));
							
							echo "Successfully uploaded.";
						}
					}
					else if($size < 2000000000)
					{	
						$data['error'] = "File size must be 200MB!";
					}
					else
					{
						$data['error'] = "File extension must be .mp4";
					}
				}
			}
			else
			{
				echo "No FILE data.";
			}
		}
		else
		{
			echo "Unable to upload.";
		}
	}
	
	public function video_thumb_reupload($id = NULL)
	{
		
		$data['type'] = $cat = $this->input->get('type');
		
		if($cat == "weddings")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($id,'Weddings'));
		}
		elseif($cat == "bar_mitzvahs")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($id,'Bar Mitzvahs'));
		}
		elseif($cat == "celebrate_life")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($id,'Celebration of Life'));
		}
		elseif($cat == "growing_montage")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($id,'Growing Up Montage'));
		}
		elseif($cat == "specialty")
		{
			$query = $this->QModel->sfwa('videos',array('video_id','category'),array($id,'Specialty'));
		}
		else
		{
			redirect('404');
		}
		
			
		if($this->QModel->c($query))
		{
			
			if($_FILES)
			{
				$file = $_FILES['upload']['name'];
				$type = $_FILES['upload']['type'];
				$size = $_FILES['upload']['size'];
				$temp = $_FILES['upload']['tmp_name'];
				$error = $_FILES['upload']['error'];

				if( ! $file)
				{
					echo "Please select a file!";
				}
				else
				{
					if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
					{
						switch($error)
						{
							case UPLOAD_ERR_INI_SIZE: 
								$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
								break;
							case UPLOAD_ERR_FORM_SIZE: 
								$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
								break;
							case UPLOAD_ERR_PARTIAL: 
								$message = "The uploaded file was only partially uploaded"; 
								break;
							case UPLOAD_ERR_NO_FILE: 
								$message = "No file was uploaded"; 
								break;
							case UPLOAD_ERR_NO_TMP_DIR: 
								$message = "Missing a temporary folder"; 
								break;
							case UPLOAD_ERR_CANT_WRITE: 
								$message = "Failed to write file to disk"; 
								break;
							case UPLOAD_ERR_EXTENSION: 
								$message = "File upload stopped by extension"; 
								break;
							default:
								$message = "Unknown upload error"; 
								break; 
						}
						
						if($error)
						{
							echo $message;
						}
						else
						{
							if($type == "image/pjpeg" OR $type == "image/jpeg")
								$ex = ".jpg";
							else
								$ex = ".png";
							
							if($cat == "weddings")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/weddings/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/weddings/thumbnails/'.$get['thumbnail']);
													
								// Resizing...
								$this->load->resize("uploads/video/weddings/".$naming,"uploads/video/weddings/thumbnails/".$naming,126,126);
								unlink(FCPATH.'/uploads/video/weddings/'.$naming);
							}
							elseif($cat == "bar_mitzvahs")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/bar_mitzvahs/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/bar_mitzvahs/thumbnails/'.$get['thumbnail']);
													
								// Resizing...
								$this->load->resize("uploads/video/bar_mitzvahs/".$naming,"uploads/video/bar_mitzvahs/thumbnails/".$naming,126,126);
								unlink(FCPATH.'/uploads/video/bar_mitzvahs/'.$naming);
							}
							elseif($cat == "celebrate_life")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/celebration_of_life/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/celebration_of_life/thumbnails/'.$get['thumbnail']);
													
								// Resizing...
								$this->load->resize("uploads/video/celebration_of_life/".$naming,"uploads/video/celebration_of_life/thumbnails/".$naming,126,126);
								unlink(FCPATH.'/uploads/video/celebration_of_life/'.$naming);
							}
							elseif($cat == "growing_montage")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/growing_up_montage/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/growing_up_montage/thumbnails/'.$get['thumbnail']);
								
								// Resizing...
								$this->load->resize("uploads/video/growing_up_montage/".$naming,"uploads/video/growing_up_montage/thumbnails/".$naming,126,126);
								unlink(FCPATH.'/uploads/video/growing_up_montage/'.$naming);
							}
							elseif($cat == "specialty")
							{
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/video/specialty/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/video/specialty/thumbnails/'.$get['thumbnail']);
								
								// Resizing...
								$this->load->resize("uploads/video/specialty/".$naming,"uploads/video/specialty/thumbnails/".$naming,126,126);
								unlink(FCPATH.'/uploads/video/specialty/'.$naming);
							}
							else
							{
								redirect('404');
							}
							
							
							$update = array(
								'thumbnail' => $naming,
								'video_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->update('videos',$update,array('video_id' => $id));
							
							echo "Successfully uploaded.";
						}
					}
					else if($size > 20000000)
					{
						echo "File size must be 20MB below!";
					}
					else
					{
						echo "File extension must be .png or .jpg or .jpeg";
					}
				}
			}
			else
			{
				echo "No FILE data.";
			}
		}
		else
		{
			echo "Unable to upload.";
		}
		
	}
	
	public function contact_info()
	{
		$data["title"] = "Contact Information!";
		$data["menu"] = 8;
				
		$this->load->view("admin/contact_info/contact_information",$data);
	}
	
	public function testimonials()
	{
		$data["title"] = "Contact Information - Testimonials";
		$data["menu"] = 8;
		
		if($_POST)
		{
			
			$submit = $this->input->post('submit');
			
			if( ! $submit)
			{
				redirect('404');
			}
			else
			{
				$category = $this->input->post('category');
				$client_name = $this->input->post('client_name');
				$message = $this->input->post('message', false);
				
				$data['category'] = $category;
				$data['client_name'] = $client_name;
				$data['message'] = $message;
				
				$filter = $this->load->validation(
				array(
						'required|E|Category' => $category,
						'required|E|Client Name|4|50' => $client_name,
						'required|E|Message' => $message
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				elseif( ! $category == "Weddings" OR ! $category == "Portraits" OR ! $category == "Headshots" OR ! $category == "Bar Mitzvahs" )
				{
					$data['error'] = "Category didn't match!";
				}
				else
				{
					$insert = array(
						'category' => $category,
						'client_name' => $client_name,
						'testimonials' => $message,
						'date_time_created' => date("Y-m-d H:i:s")
					);
					$this->QModel->insert('client_testimonials',$insert);
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added testimonial.</span>');
					redirect('admin/testimonials');
				}
			}
			
		}
				
		$this->load->view("admin/contact_info/testimonials",$data);
	}
	
	public function edit_testimonials($testimonial_id = NULL)
	{
		$query = $this->QModel->sfwa('client_testimonials', array('testimonial_id'),array($testimonial_id));
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$data["title"] = "Contact Information - Testimonials";
			$data["menu"] = 8;
			
			$get = $this->QModel->g($query);
			$data['category'] = $get['category'];
			$data['client_name'] = $get['client_name'];
			$data['message'] = $get['testimonials'];
			
			if($_POST)
			{
				$submit = $this->input->post('submit');
				
				if( ! $submit)
				{
					redirect('404');
				}
				else
				{
					$data['category'] = $category = $this->input->post('category');
					$data['client_name'] = $client_name = $this->input->post('client_name');
					$data['message'] = $testimonials = $this->input->post('message', false);
					
					$filter = $this->load->validation(
					array(
							'required|E|Category' => $category,
							'required|E|Client Name|4|50' => $client_name,
							'required|E|Message' => $testimonials
						)
					);
					
					if($filter)
					{
						$data['error'] = $filter;
					}
					elseif( ! $category == "Weddings" OR ! $category == "Portraits" OR ! $category == "Headshots" OR ! $category == "Bar Mitzvahs" )
					{
						$data['error'] = "Category didn't match!";
					}
					else
					{
						$update = array(
							'category' => $category,
							'client_name' => $client_name,
							'testimonials' => $testimonials,
							'date_time_created' => date("Y-m-d H:i:s")
						);
						$this->QModel->update('client_testimonials',$update,array('testimonial_id' => $testimonial_id));
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Edit testimonial.</span>');
						redirect('admin/testimonials');
						
					}
				}
			}
			
			$this->load->view("admin/contact_info/testimonials",$data);
		}
	}
	
	public function delete_testimonials( $testimonial_id = NULL)
	{
		$query = $this->QModel->sfwa(
					'client_testimonials',
					array('testimonial_id'),
					array($testimonial_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'testimonial_id' => $testimonial_id
			);
			$this->QModel->delete(
				'client_testimonials', $where
			);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted testimonial.</span>');
			redirect('admin/testimonials');
		}
	}
	
	public function home_pics()
	{
		$data["title"] = "Contact Information - Home Pictures";
		$data["menu"] = 8;
		$data['location_thumb'] = 'uploads/home/thumbnail/';
		$data['location_orig'] = 'uploads/home/original/';
		
		if($_POST)
		{
			$upload_photo = $this->input->post('upload_photo');
			
			if( ! $upload_photo)
			{
				redirect('404');
			}
			else
			{
				$data['category'] = $category = $this->input->post('category');
				
				$filter = $this->load->validation(
				array(
						'required|E|Category' => $category
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$file = $_FILES['file']['name'];
					$type = $_FILES['file']['type'];
					$size = $_FILES['file']['size'];
					$temp = $_FILES['file']['tmp_name'];
					$error = $_FILES['file']['error'];

					if( ! $file)
					{
						$data['error'] = "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								$data['error'] = $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/home/original/".$naming);
								
								// Resizing...
								$this->load->resize("uploads/home/original/".$naming,"uploads/home/semi-original/".$naming,340,340);
								$this->load->resize("uploads/home/original/".$naming,"uploads/home/thumbnail/".$naming,126,126);
								
								$insert = array(
									'photos' => $naming,
									'category' => $category,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->insert('home_photos',$insert);
								
								$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully added photo.</span>');
								redirect('admin/home_pics');
							}
						}
						else if($size > 20000000)
						{
							$data['error'] = "File size must be 20MB below!";
						}
						else
						{
							$data['error'] = "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
			}
		}
		
		$this->load->view("admin/contact_info/home_pics",$data);
	}
	
	public function edit_home_pics($photos_id = NULL)
	{
		$data['photos_id'] = $photos_id;
		
		$query = $this->QModel->sfwa('home_photos', array('photos_id'), array($photos_id));
		
		if( ! $this->QModel->c($query))
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			
			$data['photos'] = $get['photos'];
			$data['category'] = $get['category'];
			
			$data["title"] = "Contact Information - Testimonials";
			$data["menu"] = 8;
			
			if($_POST)
			{
				$upload_photo = $this->input->post('upload_photo');
			
				if( ! $upload_photo)
				{
					redirect('404');
				}
				else
				{
					$data['category'] = $category = $this->input->post('category');
					
					$filter = $this->load->validation(
					array(
							'required|E|Category' => $category
						)
					);
					
					if($filter)
					{
						$data['error'] = $filter;
					}
					else
					{
						$update = array(
							'category' => $category,
							'photos_created' => date("Y-m-d H:i:s")
						);
						$this->QModel->update('home_photos',$update,array('photos_id' => $photos_id));
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Edit Photos.</span>');
						redirect('admin/edit_home_pics/'.$photos_id);
					}
				}

			}
			$this->load->view("admin/contact_info/home_pics_edit",$data);
		}
	}
	
	public function home_reupload($id = NULL)
	{
		$category_type = $this->input->get('type');
		
		$query = $this->QModel->sfwa('home_photos',array('photos_id'),array($id));
			
		if($this->QModel->c($query))
		{
			
			if($_FILES)
			{
				$file = $_FILES['upload']['name'];
				$type = $_FILES['upload']['type'];
				$size = $_FILES['upload']['size'];
				$temp = $_FILES['upload']['tmp_name'];
				$error = $_FILES['upload']['error'];

				if( ! $file)
				{
					echo "Please select a file!";
				}
				else
				{
					if($type == "image/pjpeg" && $size < 200000000 OR $type == "image/jpeg" && $size < 200000000 OR $type == "image/png" && $size < 200000000)
					{
						switch($error)
						{
							case UPLOAD_ERR_INI_SIZE: 
								$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
								break;
							case UPLOAD_ERR_FORM_SIZE: 
								$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
								break;
							case UPLOAD_ERR_PARTIAL: 
								$message = "The uploaded file was only partially uploaded"; 
								break;
							case UPLOAD_ERR_NO_FILE: 
								$message = "No file was uploaded"; 
								break;
							case UPLOAD_ERR_NO_TMP_DIR: 
								$message = "Missing a temporary folder"; 
								break;
							case UPLOAD_ERR_CANT_WRITE: 
								$message = "Failed to write file to disk"; 
								break;
							case UPLOAD_ERR_EXTENSION: 
								$message = "File upload stopped by extension"; 
								break;
							default:
								$message = "Unknown upload error"; 
								break; 
						}
						
						if($error)
						{
							echo $message;
						}
						else
						{
							if($type == "image/pjpeg" OR $type == "image/jpeg")
								$ex = ".jpg";
							else
								$ex = ".png";
							
							$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
							move_uploaded_file($temp,"uploads/home/original/".$naming);
							
							// Deleting old picture...
							$get = $this->QModel->g($query);
							unlink(FCPATH.'/uploads/home/original/'.$get['photos']);
							unlink(FCPATH.'/uploads/home/semi-original/'.$get['photos']);
							unlink(FCPATH.'/uploads/home/thumbnail/'.$get['photos']);
							
							// Resizing...
							$this->load->resize("uploads/home/original/".$naming,"uploads/home/semi-original/".$naming,340,340);
							$this->load->resize("uploads/home/original/".$naming,"uploads/home/thumbnail/".$naming,126,126);
							
							
							$update = array(
								'photos' => $naming,
								'category' => $category_type,
								'photos_created' => date("Y-m-d H:i:s")
							);
							$this->QModel->update('home_photos',$update,array('photos_id' => $id));
							
							echo "Successfully uploaded.";
						}
					}
					else if($size < 200000000)
					{
						echo "File size must be 20MB below!";
					}
					else
					{
						echo "File extension must be .png or .jpg or .jpeg";
					}
				}
			}
			else
			{
				echo "No FILE data.";
			}
		}
		else
		{
			echo "Unable to upload.";
		}
	}
	
	public function home_pics_delete($photos_id = NULL)
	{
		$query = $this->QModel->sfwa(
					'home_photos',
					array('photos_id'),
					array($photos_id)
				);
				
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'photos_id' => $photos_id
			);
			$this->QModel->delete(
				'home_photos', $where
			);
			
			$get = $this->QModel->g($query);
			
			unlink(FCPATH.'/uploads/home/original/'.$get['photos']);
			unlink(FCPATH.'/uploads/home/semi-original/'.$get['photos']);
			unlink(FCPATH.'/uploads/home/thumbnail/'.$get['photos']);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted the photo.</span>');
			redirect('admin/home_pics');
		}
	}
	
	public function whats_new()
	{
		$data["title"] = "Contact Information - What's New";
		$data["menu"] = 8;
		
		if($_POST)
		{
			
			$submit = $this->input->post('submit');
			
			if( ! $submit)
			{
				redirect('404');
			}
			else
			{
				$data['new_title'] = $new_title = $this->input->post('new_title');
				$data['new_date'] = $new_date = $this->input->post('new_date');
				$data['message'] = $message = $this->input->post('message', false, false);
				
				$filter = $this->load->validation(
				array(
						'required|E|Title' => $new_title,
						'required|E|Date' => $new_date,
						'required|E|Message' => $message
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$insert = array(
						'title' => $new_title,
						'date' => date('Y-m-d', strtotime($new_date)),
						'message' => $message,
						'date_created' => date("Y-m-d H:i:s"),
					);
					$this->QModel->insert('whats_new',$insert);
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Created.</span>');
					redirect('admin/whats_new');
				}
			}
			
		}
				
		$this->load->view("admin/contact_info/whats_new",$data);
	}
	
	public function edit_whats_new($whats_new_id = NULL)
	{	
		$query = $this->QModel->sfwa(
					'whats_new',
					array('whats_new_id'),
					array($whats_new_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['new_title'] = $get['title'];
			$data['new_date'] = $get['date'];
			$data['message'] = $get['message'];
		
			$data["title"] = "Contact Information - What's New";
			$data["menu"] = 8;
		
			if($_POST)
			{
			
				$submit = $this->input->post('submit');
				$cancel = $this->input->post('cancel');
				
				if( ! $submit && ! $cancel)
				{
					redirect('404');
				}
				elseif( $cancel)
				{
					redirect('admin/whats_new');
				}
				else
				{
					$data['new_title'] = $new_title = $this->input->post('new_title');
					$data['new_date'] = $new_date = $this->input->post('new_date');
					$data['message'] = $message = $this->input->post('message', false, false);
					
					$filter = $this->load->validation(
					array(
							'required|E|Title' => $new_title,
							'required|E|Date' => $new_date,
							'required|E|Message' => $message
						)
					);
					
					if($filter)
					{
						$data['error'] = $filter;
					}
					else
					{
						$update = array(
							'title' => $new_title,
							'date' => date('Y-m-d', strtotime($new_date)),
							'message' => $message,
							'date_created' => date("Y-m-d H:i:s"),
						);
						$this->QModel->update('whats_new',$update,array('whats_new_id' => $whats_new_id));
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Created.</span>');
						redirect('admin/whats_new');
					}
				}
				
			}
					
			$this->load->view("admin/contact_info/whats_new",$data);
		}
	}
	
	public function delete_whats_new($whats_new_id = NULL)
	{
		$query = $this->QModel->sfwa(
					'whats_new',
					array('whats_new_id'),
					array($whats_new_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'whats_new_id' => $whats_new_id
			);
			$this->QModel->delete(
				'whats_new', $where
			);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully deleted Whats New.</span>');
			redirect('admin/whats_new');
		}
	}
	
	public function referral()
	{
		$data["title"] = "Contact Information - Referral";
		$data["menu"] = 8;
		
		if($_POST)
		{
			
			$submit = $this->input->post('submit');
			
			if( ! $submit)
			{
				redirect('404');
			}
			else
			{
				$data['category'] = $category = $this->input->post('category');
				$data['content'] = $content = $this->input->post('content', false, false);
				
				$filter = $this->load->validation(
				array(
						'required|E|Category' => $category,
						'required|E|Content' => $content
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					$insert = array(
						'category' => $category,
						'content' => $content,
						'date_created' => date("Y-m-d H:i:s"),
					);
					$this->QModel->insert('referral',$insert);
					
					$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Created.</span>');
					redirect('admin/referral');
				}
			}
			
		}
				
		$this->load->view("admin/contact_info/referral",$data);
	}
	
	public function edit_referral($referral_id = NULL)
	{	
		$query = $this->QModel->sfwa(
					'referral',
					array('referral_id'),
					array($referral_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$get = $this->QModel->g($query);
			$data['category'] = $get['category'];
			$data['content'] = $get['content'];
		
			$data["title"] = "Contact Information - Referral";
			$data["menu"] = 8;
		
			if($_POST)
			{
			
				$submit = $this->input->post('submit');
				$cancel = $this->input->post('cancel');
				
				if( ! $submit && ! $cancel)
				{
					redirect('404');
				}
				elseif( $cancel)
				{
					redirect('admin/whats_new');
				}
				else
				{
					$data['category'] = $category = $this->input->post('category');
					$data['content'] = $content = $this->input->post('content', false, false);
					
					$filter = $this->load->validation(
					array(
							'required|E|Category' => $category,
							'required|E|Content' => $content
						)
					);
					
					if($filter)
					{
						$data['error'] = $filter;
					}
					else
					{
						$update = array(
							'category' => $category,
							'content' => $content,
							'date_created' => date("Y-m-d H:i:s"),
						);
						$this->QModel->update('referral',$update,array('referral_id' => $referral_id));
						
						$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Edit.</span>');
						redirect('admin/referral');
					}
				}
				
			}
					
			$this->load->view("admin/contact_info/referral",$data);
		}
	}
	
	public function delete_referral($referral_id = NULL)
	{
		$query = $this->QModel->sfwa(
					'referral',
					array('referral_id'),
					array($referral_id)
				);
		
		if( ! $this->QModel->c($query) )
		{
			redirect('404');
		}
		else
		{
			$where = array(
				'referral_id' => $referral_id
			);
			$this->QModel->delete(
				'referral', $where
			);
			
			$this->session->set_flashdata('success','<span style="color:green; font-size:14px;">Successfully Delete</span>');
			redirect('admin/referral');
		}
	}
	
	public function reupload($id = NULL)
	{
		$type = $this->input->get('type');
		
		if($type == "weddings")
		{
			$query = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($id,'Weddings'));
			
			if($this->QModel->c($query))
			{
				// Events - Weddings
				$data['categ'] = "Weddings";
				$data['location_thumb'] = "uploads/events/weddings/thumbnail/";
				$data['table_name'] = "events_photos";
				$data['link'] = "admin/events";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];
					
					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/weddings/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/weddings/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/weddings/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/weddings/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/weddings/original/".$naming,"uploads/events/weddings/semi-original/".$naming,270,270);
								$this->load->resize("uploads/events/weddings/original/".$naming,"uploads/events/weddings/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "engagement")
		{
			$query = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($id,'Engagement'));
			
			if($this->QModel->c($query))
			{
				// Events - Engagement
				$data['categ'] = "Engagement";
				$data['location_thumb'] = "uploads/events/engagement/thumbnail/";
				$data['table_name'] = "events_photos";
				$data['link'] = "admin/events";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/engagement/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/engagement/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/engagement/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/engagement/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/engagement/original/".$naming,"uploads/events/engagement/semi-original/".$naming,270,270);
								$this->load->resize("uploads/events/engagement/original/".$naming,"uploads/events/engagement/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "bar_mitzvahs")
		{
			$query = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($id,'Bar Mitzvahs'));
			
			if($this->QModel->c($query))
			{
				// Events - Bar Mitzvahs
				$data['categ'] = "Bar Mitzvahs";
				$data['location_thumb'] = "uploads/events/bar_mitzvahs/thumbnail/";
				$data['table_name'] = "events_photos";
				$data['link'] = "admin/events";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/bar_mitzvahs/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/bar_mitzvahs/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/bar_mitzvahs/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/bar_mitzvahs/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/bar_mitzvahs/original/".$naming,"uploads/events/bar_mitzvahs/semi-original/".$naming,270,270);
								$this->load->resize("uploads/events/bar_mitzvahs/original/".$naming,"uploads/events/bar_mitzvahs/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "corporate")
		{
			$query = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($id,'Corporate'));
			
			if($this->QModel->c($query))
			{
				// Events - Corporate
				$data['categ'] = "Corporate";
				$data['location_thumb'] = "uploads/events/corporate/thumbnail/";
				$data['table_name'] = "events_photos";
				$data['link'] = "admin/events";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/events/corporate/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/events/corporate/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/corporate/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/events/corporate/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/events/corporate/original/".$naming,"uploads/events/corporate/semi-original/".$naming,270,270);
								$this->load->resize("uploads/events/corporate/original/".$naming,"uploads/events/corporate/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('events_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "family")
		{
			$query = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($id,'Family'));
			
			if($this->QModel->c($query))
			{
				// Portraits - Family
				$data['categ'] = "family";
				$data['location_thumb'] = "uploads/portraits/family/thumbnail/";
				$data['table_name'] = "portraits_photos";
				$data['link'] = "admin/portraits";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/family/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/family/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/family/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/family/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/family/original/".$naming,"uploads/portraits/family/semi-original/".$naming,270,270);
								$this->load->resize("uploads/portraits/family/original/".$naming,"uploads/portraits/family/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portraits_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "individual")
		{
			$query = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($id,'Individual'));
			
			if($this->QModel->c($query))
			{
				// Portraits - Individual
				$data['categ'] = "individual";
				$data['location_thumb'] = "uploads/portraits/individual/thumbnail/";
				$data['table_name'] = "portraits_photos";
				$data['link'] = "admin/portraits";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/individual/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/individual/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/individual/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/individual/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/individual/original/".$naming,"uploads/portraits/individual/semi-original/".$naming,270,270);
								$this->load->resize("uploads/portraits/individual/original/".$naming,"uploads/portraits/individual/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portraits_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "children")
		{
			$query = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($id,'Children'));
			
			if($this->QModel->c($query))
			{
				// Portraits - Children
				$data['categ'] = "children";
				$data['location_thumb'] = "uploads/portraits/children/thumbnail/";
				$data['table_name'] = "portraits_photos";
				$data['link'] = "admin/portraits";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/children/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/children/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/children/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/children/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/children/original/".$naming,"uploads/portraits/children/semi-original/".$naming,270,270);
								$this->load->resize("uploads/portraits/children/original/".$naming,"uploads/portraits/children/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portraits_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "pregnancy_boudoir")
		{
			$query = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($id,'Pregnancy/Boudoir'));
			
			if($this->QModel->c($query))
			{
				// Portraits - Pregnancy/Boudair
				$data['categ'] = "Pregnancy/Boudoir";
				$data['location_thumb'] = "uploads/portraits/pregnancy_boudair/thumbnail/";
				$data['table_name'] = "portraits_photos";
				$data['link'] = "admin/portraits";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/portraits/pregnancy_boudair/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/portraits/pregnancy_boudair/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/portraits/pregnancy_boudair/original/".$naming,"uploads/portraits/pregnancy_boudair/semi-original/".$naming,270,270);
								$this->load->resize("uploads/portraits/pregnancy_boudair/original/".$naming,"uploads/portraits/pregnancy_boudair/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('portraits_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "adult")
		{
			$query = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($id,'adult'));
			
			if($this->QModel->c($query))
			{
				// Headshots - Adult
				$data['categ'] = "Adult";
				$data['location_thumb'] = "uploads/headshots/adult/thumbnail/";
				$data['table_name'] = "headshots_photos";
				$data['link'] = "admin/headshots";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/adult/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/adult/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/adult/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/adult/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/adult/original/".$naming,"uploads/headshots/adult/semi-original/".$naming,270,270);
								$this->load->resize("uploads/headshots/adult/original/".$naming,"uploads/headshots/adult/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "children2")
		{
			$query = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($id,'Child'));
			
			if($this->QModel->c($query))
			{
				// Headshots - Child
				$data['categ'] = "Child";
				$data['location_thumb'] = "uploads/headshots/child/thumbnail/";
				$data['table_name'] = "headshots_photos";
				$data['link'] = "admin/headshots";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/child/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/child/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/child/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/child/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/child/original/".$naming,"uploads/headshots/child/semi-original/".$naming,270,270);
								$this->load->resize("uploads/headshots/child/original/".$naming,"uploads/headshots/child/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "business")
		{
			$query = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($id,'Business'));
			
			if($this->QModel->c($query))
			{
				// Headshots - Business
				$data['categ'] = "Business";
				$data['location_thumb'] = "uploads/headshots/business/thumbnail/";
				$data['table_name'] = "headshots_photos";
				$data['link'] = "admin/headshots";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/headshots/business/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/headshots/business/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/business/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/headshots/business/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/headshots/business/original/".$naming,"uploads/headshots/business/semi-original/".$naming,270,270);
								$this->load->resize("uploads/headshots/business/original/".$naming,"uploads/headshots/business/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('headshots_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "before_after")
		{
			$query = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($id,'Retouching Restoration - Before and After'));
			
			if($this->QModel->c($query))
			{
				// Digital Imaging - Retouching Restoration - Before and after
				$data['categ'] = "Retouching Restoration - Before and after";
				$data['location_thumb'] = "uploads/digital_imaging/retouching/thumbnail/";
				$data['table_name'] = "digital_imaging_photos";
				$data['link'] = "admin/digital_imaging";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/digital_imaging/retouching/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/digital_imaging/retouching/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/retouching/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/retouching/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/digital_imaging/retouching/original/".$naming,"uploads/digital_imaging/retouching/semi-original/".$naming,270,270);
								$this->load->resize("uploads/digital_imaging/retouching/original/".$naming,"uploads/digital_imaging/retouching/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('digital_imaging_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "image_manipulation")
		{
			$query = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($id,'Image Manipulation'));
			
			if($this->QModel->c($query))
			{
				// Digital Imaging - Image Manipulation
				$data['categ'] = "Image Manipulation";
				$data['location_thumb'] = "uploads/digital_imaging/image_manipulation/thumbnail/";
				$data['table_name'] = "digital_imaging_photos";
				$data['link'] = "admin/digital_imaging";
				
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								$naming = hash_password($file.$type.date('YmdHis'),'adler32').$ex;
								move_uploaded_file($temp,"uploads/digital_imaging/image_manipulation/original/".$naming);
								
								// Deleting old picture...
								$get = $this->QModel->g($query);
								unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/original/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/semi-original/'.$get['photos']);
								unlink(FCPATH.'/uploads/digital_imaging/image_manipulation/thumbnail/'.$get['photos']);
								
								// Resizing...
								$this->load->resize("uploads/digital_imaging/image_manipulation/original/".$naming,"uploads/digital_imaging/image_manipulation/semi-original/".$naming,270,270);
								$this->load->resize("uploads/digital_imaging/image_manipulation/original/".$naming,"uploads/digital_imaging/image_manipulation/thumbnail/".$naming,126,126);
								
								$update = array(
									'photos' => $naming,
									'photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('digital_imaging_photos',$update,array('photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "clients_photos")
		{
			$query = $this->QModel->sfwa('clients_photos','clients_photos_id',$id);
			
			if($this->QModel->c($query))
			{
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								// Get clients ID
								$get = $this->QModel->g($query);
								$clients_id = $get['clients_id'];
								
								$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
								$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
								$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
								move_uploaded_file($temp,"uploads/gallery/clients/".$clients_id."/original/".$orginal_naming);
								
								// Deleting old picture...
								@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/original/'.$get['original_image']);
								@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/semi-original/'.$get['semi_original_image']);
								@unlink(FCPATH.'/uploads/gallery/clients/'.$clients_id.'/thumbnail/'.$get['thumbnail_image']);
								
								// Resizing...
								$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/semi-original/".$semi_naming,224,224);
								$this->load->resize("uploads/gallery/clients/".$clients_id."/original/".$orginal_naming,"uploads/gallery/clients/".$clients_id."/thumbnail/".$thumb_naming,126,126);
								
								// Get original upload name file.
								$new_fileName = explode(".",$file);
								
								$update = array(
									'photos' => $new_fileName[0].$ex,
									'original_image' => $orginal_naming,
									'semi_original_image' => $semi_naming,
									'thumbnail_image' => $thumb_naming,
									'clients_photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('clients_photos',$update,array('clients_photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		elseif($type == "zareks_photos")
		{
			$query = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$id);
			
			if($this->QModel->c($query))
			{
				if($_FILES)
				{
					$file = $_FILES['upload']['name'];
					$type = $_FILES['upload']['type'];
					$size = $_FILES['upload']['size'];
					$temp = $_FILES['upload']['tmp_name'];
					$error = $_FILES['upload']['error'];

					if( ! $file)
					{
						echo "Please select a file!";
					}
					else
					{
						if($type == "image/pjpeg" && $size < 20000000 OR $type == "image/jpeg" && $size < 20000000 OR $type == "image/png" && $size < 20000000)
						{
							switch($error)
							{
								case UPLOAD_ERR_INI_SIZE: 
									$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
									break;
								case UPLOAD_ERR_FORM_SIZE: 
									$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
									break;
								case UPLOAD_ERR_PARTIAL: 
									$message = "The uploaded file was only partially uploaded"; 
									break;
								case UPLOAD_ERR_NO_FILE: 
									$message = "No file was uploaded"; 
									break;
								case UPLOAD_ERR_NO_TMP_DIR: 
									$message = "Missing a temporary folder"; 
									break;
								case UPLOAD_ERR_CANT_WRITE: 
									$message = "Failed to write file to disk"; 
									break;
								case UPLOAD_ERR_EXTENSION: 
									$message = "File upload stopped by extension"; 
									break;
								default:
									$message = "Unknown upload error"; 
									break; 
							}
							
							if($error)
							{
								echo $message;
							}
							else
							{
								if($type == "image/pjpeg" OR $type == "image/jpeg")
									$ex = ".jpg";
								else
									$ex = ".png";
								
								// Get zareks ID
								$get = $this->QModel->g($query);
								$zareks_id = $get['zareks_id'];
								
								$orginal_naming = hash_password($file.$type.date('YmdHis')."-original",'adler32').$ex;
								$semi_naming = hash_password($file.$type.date('YmdHis')."-semi",'adler32').$ex;
								$thumb_naming = hash_password($file.$type.date('YmdHis')."-thumb",'adler32').$ex;
								move_uploaded_file($temp,"uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming);
								
								// Deleting old picture...
								@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/original/'.$get['original_image']);
								@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/semi-original/'.$get['semi_original_image']);
								@unlink(FCPATH.'/uploads/gallery/zareks/'.$zareks_id.'/thumbnail/'.$get['thumbnail_image']);
								
								// Resizing...
								$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/semi-original/".$semi_naming,224,224);
								$this->load->resize("uploads/gallery/zareks/".$zareks_id."/original/".$orginal_naming,"uploads/gallery/zareks/".$zareks_id."/thumbnail/".$thumb_naming,126,126);
								
								// Get original upload name file.
								$new_fileName = explode(".",$file);
								
								$update = array(
									'photos' => $new_fileName[0].$ex,
									'original_image' => $orginal_naming,
									'semi_original_image' => $semi_naming,
									'thumbnail_image' => $thumb_naming,
									'clients_photos_created' => date("Y-m-d H:i:s")
								);
								$this->QModel->update('zareks_photos',$update,array('zareks_photos_id' => $id));
								
								echo "Successfully uploaded.";
							}
						}
						else if($size > 20000000)
						{
							echo "File size must be 20MB below!";
						}
						else
						{
							echo "File extension must be .png or .jpg or .jpeg";
						}
					}
				}
				else
				{
					echo "No FILE data.";
				}
			}
			else
			{
				echo "Unable to upload.";
			}
		}
		else
		{
			echo "Unable to upload.";
		}
	}
	
	public function dragAndDrop($id = NULL)
	{
		$type = $this->input->get('type');
		$new_current_id = explode("|",$this->input->get('current_id'));
		$new_target_id = explode("|",$this->input->get('target_id'));
		$current_id = str_replace("drag","",$new_current_id[0]);
		$target_id = str_replace("drag","",$new_target_id[0]);
		
		if($type == "zareks")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('zareks_photos',array('zareks_photos_id','zareks_id'),array($current_id,$id));
			$q2 = $this->QModel->sfwa('zareks_photos',array('zareks_photos_id','zareks_id'),array($target_id,$id));

			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_id = $g['zareks_photos_id'];
				$current_photos = $g['photos'];
				$current_original = $g['original_image'];
				$current_semi = $g['semi_original_image'];
				$current_thumb = $g['thumbnail_image'];
				$current_date = $g['clients_photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_id = $g2['zareks_photos_id'];
				$target_photos = $g2['photos'];
				$target_original = $g2['original_image'];
				$target_semi = $g2['semi_original_image'];
				$target_thumb = $g2['thumbnail_image'];
				$target_date = $g2['clients_photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $target_photos,
					'original_image' => $target_original,
					'semi_original_image' => $target_semi,
					'thumbnail_image' => $target_thumb,
					'clients_photos_created' => $target_date
				);
				$update2 = array( // Target -> Current
					'photos' => $current_photos,
					'original_image' => $current_original,
					'semi_original_image' => $current_semi,
					'thumbnail_image' => $current_thumb,
					'clients_photos_created' => $current_date
				);
				$this->QModel->update('zareks_photos',$update,array('zareks_id' => $id,'zareks_photos_id' => $current_id));
				$this->QModel->update('zareks_photos',$update2,array('zareks_id' => $id,'zareks_photos_id' => $target_id));
			}
		}
		else if($type == "clients")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('clients_photos',array('clients_photos_id','clients_id'),array($current_id,$id));
			$q2 = $this->QModel->sfwa('clients_photos',array('clients_photos_id','clients_id'),array($target_id,$id));

			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_id = $g['clients_photos_id'];
				$current_photos = $g['photos'];
				$current_original = $g['original_image'];
				$current_semi = $g['semi_original_image'];
				$current_thumb = $g['thumbnail_image'];
				$current_date = $g['clients_photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_id = $g2['clients_photos_id'];
				$target_photos = $g2['photos'];
				$target_original = $g2['original_image'];
				$target_semi = $g2['semi_original_image'];
				$target_thumb = $g2['thumbnail_image'];
				$target_date = $g2['clients_photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $target_photos,
					'original_image' => $target_original,
					'semi_original_image' => $target_semi,
					'thumbnail_image' => $target_thumb,
					'clients_photos_created' => $target_date
				);
				$update2 = array( // Target -> Current
					'photos' => $current_photos,
					'original_image' => $current_original,
					'semi_original_image' => $current_semi,
					'thumbnail_image' => $current_thumb,
					'clients_photos_created' => $current_date
				);
				$this->QModel->update('clients_photos',$update,array('clients_id' => $id,'clients_photos_id' => $current_id));
				$this->QModel->update('clients_photos',$update2,array('clients_id' => $id,'clients_photos_id' => $target_id));
			}
		}
		elseif($type == "home")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('home_photos',array('photos_id'),array($current_id));
			$q2 = $this->QModel->sfwa('home_photos',array('photos_id'),array($target_id));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('home_photos',$update,array('photos_id' => $target_photos_id));
				$this->QModel->update('home_photos',$update2,array('photos_id' => $current_photos_id));
			}
		}
		elseif($type == "weddings")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($current_id,'Weddings'));
			$q2 = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($target_id,'Weddings'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('events_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Weddings'));
				$this->QModel->update('events_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Weddings'));
			}
		}
		elseif($type == "engagement")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($current_id,'Engagement'));
			$q2 = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($target_id,'Engagement'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('events_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Engagement'));
				$this->QModel->update('events_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Engagement'));
			}
		}
		elseif($type == "bar_mitzvahs")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($current_id,'Bar Mitzvahs'));
			$q2 = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($target_id,'Bar Mitzvahs'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('events_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Bar Mitzvahs'));
				$this->QModel->update('events_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Bar Mitzvahs'));
			}
		}
		elseif($type == "corporate")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($current_id,'Corporate'));
			$q2 = $this->QModel->sfwa('events_photos',array('photos_id','category'),array($target_id,'Corporate'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('events_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Corporate'));
				$this->QModel->update('events_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Corporate'));
			}
		}
		elseif($type == "family")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($current_id,'Family'));
			$q2 = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($target_id,'Family'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('portraits_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Family'));
				$this->QModel->update('portraits_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Family'));
			}
		}
		elseif($type == "individual")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($current_id,'Individual'));
			$q2 = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($target_id,'Individual'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('portraits_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Individual'));
				$this->QModel->update('portraits_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Individual'));
			}
		}
		elseif($type == "children")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($current_id,'Children'));
			$q2 = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($target_id,'Children'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('portraits_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Children'));
				$this->QModel->update('portraits_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Children'));
			}
		}
		elseif($type == "pregnancy_boudoir")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($current_id,'Pregnancy/Boudoir'));
			$q2 = $this->QModel->sfwa('portraits_photos',array('photos_id','category'),array($target_id,'Pregnancy/Boudoir'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('portraits_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Pregnancy/Boudoir'));
				$this->QModel->update('portraits_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Pregnancy/Boudoir'));
			}
		}
		elseif($type == "adult")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($current_id,'Adult'));
			$q2 = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($target_id,'Adult'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('headshots_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Adult'));
				$this->QModel->update('headshots_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Adult'));
			}
		}
		elseif($type == "children2")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($current_id,'Child'));
			$q2 = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($target_id,'Child'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('headshots_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Child'));
				$this->QModel->update('headshots_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Child'));
			}
		}
		elseif($type == "business")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($current_id,'Business'));
			$q2 = $this->QModel->sfwa('headshots_photos',array('photos_id','category'),array($target_id,'Business'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('headshots_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Business'));
				$this->QModel->update('headshots_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Business'));
			}
		}
		elseif($type == "before_after" OR $type == "retouching_restoration")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($current_id,'Retouching Restoration - Before and after'));
			$q2 = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($target_id,'Retouching Restoration - Before and after'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('digital_imaging_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Retouching Restoration - Before and after'));
				$this->QModel->update('digital_imaging_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Retouching Restoration - Before and after'));
			}
		}
		elseif($type == "image_manipulation")
		{
			// Get Current ID and Target ID if exists!
			$q = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($current_id,'Image Manipulation'));
			$q2 = $this->QModel->sfwa('digital_imaging_photos',array('photos_id','category'),array($target_id,'Image Manipulation'));
			
			if( ! $this->QModel->c($q) && ! $this->QModel->c($q2))
			{
				redirect('404');
			}
			else
			{
				// Get Information
				$g = $this->QModel->g($q);
				$current_photos_id = $g['photos_id'];
				$current_photos = $g['photos'];
				$current_category = $g['category'];
				$current_photos_created = $g['photos_created'];
				
				$g2 = $this->QModel->g($q2);
				$target_photos_id = $g2['photos_id'];
				$target_photos = $g2['photos'];
				$target_category = $g2['category'];
				$target_photos_created = $g2['photos_created'];
				
				// Swapping
				$update = array( // Current -> Target
					'photos' => $current_photos,
					'category' => $current_category,
					'photos_created' => $current_photos_created
				);
				$update2 = array( // Target -> Current
					'photos' => $target_photos,
					'category' => $target_category,
					'photos_created' => $target_photos_created
				);
				
				$this->QModel->update('digital_imaging_photos',$update,array('photos_id' => $target_photos_id,'category' => 'Image Manipulation'));
				$this->QModel->update('digital_imaging_photos',$update2,array('photos_id' => $current_photos_id,'category' => 'Image Manipulation'));
			}
		}
		else
		{
			redirect('404');
		}
	}
	
}