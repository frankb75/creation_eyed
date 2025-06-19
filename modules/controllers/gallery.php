<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Gallery extends CE_Controller

{

	public function __construct()

	{

		parent::__construct();

	}

	

	public function index()

	{

		$data["title"] = "Photography By Zarek";

		

			redirect('gallery/zareks');

		

		$this->load->view("gallery",$data);

	}

	

	public function zareks($zareks_id = NULL)

	{

		// FORCE SSL

		if($_SERVER["HTTPS"] != "on")

		{

			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

			exit();

		}

		

		$data["title"] = "Photography By Zarek";

		

		$this->load->view("zareks",$data);

	}

	

	public function zareks_gallery_view($zareks_id = NULL, $favorite_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM zareks WHERE zareks_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_id)."' AND expiration_date > CURDATE()");

		$get = $this->QModel->g($query);

		

		if($_POST)

		{

			$email_address = $this->input->post('email_address');

			$continue = $this->input->post('continue');

			

			if($continue)

			{

				$selected = $this->input->post('selected');

				

				if( ! $selected)

				{

					$data['error2'] = "Please select atleast 1 image!";

				}

				else

				{

					// Generate Unique ID

					if($this->session->userdata('cart_unique_id_zareks')) {

						$unique_id = $this->session->userdata('cart_unique_id_zareks');

						$this->QModel->delete('selected_photos',array('unique_id' => $unique_id));

					} else {

						$unique_id = hash_password(date("YmdHis").rand(1,9999).rand(1,9999).rand(1,9999));

					}

					

					foreach($selected as $a => $b)

					{

						$insert = array(

							'unique_id' => $unique_id,

							'zareks_photos_id' => $b,

							'date_created' => date("Y-m-d H:i:s")

						);

						$this->QModel->insert('selected_photos',$insert);

						

						$this->session->set_userdata(array('img_zareks_id'.$b => $b));

					}

					

					if($this->session->userdata('cart_unique_id_zareks'))

					{

						redirect('gallery/view_images_zareks/'.$zareks_id.'/'.$unique_id);

					}

					else

					{

						$this->session->set_userdata(array('cart_unique_id_zareks' => $unique_id));

						redirect('gallery/view_images_zareks/'.$zareks_id.'/'.$unique_id);

					}

				}

			}

			else if($email_address)

			{

				if( ! $email_address)

				{

					$data['error'] = "Please enter email address!";

				}

				else if( ! filter_var($email_address, FILTER_VALIDATE_EMAIL))

				{

					$data['error'] = "Invalid email address!";

				}

				else

				{

					if($this->input->post('submit'))

					{

						$userdata = array(

							"myfavorites" => $email_address,

						);

						$this->session->set_userdata($userdata);

						

						redirect('gallery/clients_gallery_view/'.$clients_id);

					}

					else if($this->input->post('submit2'))

					{

						$qfavorite = $this->QModel->sfwa('clients_photos','clients_photos_id',$favorite_id);

						

						if($this->QModel->c($qfavorite))

						{

							$gfavorite = $this->QModel->g($qfavorite);

							

							$qfavorite2 = $this->QModel->sfwa('clients',array('clients_id','posted'),array($gfavorite['clients_id'],'Yes'));

							

							if($this->QModel->c($qfavorite))

							{

								$userdata = array(

									"myfavorites" => $email_address,

								);

								$this->session->set_userdata($userdata);

								

								$insert = array(

									'email_address' => $email_address,

									'clients_photos_id' => $favorite_id

								);

								$this->QModel->insert('myfavorites',$insert);

								

								if($this->input->get('url'))

								{

									header("Location: ".$this->input->get('url'));

									die();

								}

								else

								{

									redirect('gallery/clients_gallery_view/'.$clients_id);

								}

							}

							else

							{

								redirect('404');

							}

						}

						else

						{

							redirect('404');

						}

					}

					else

					{

						redirect('404');

					}

				}

			}

			else

			{

				redirect('404');

			}

		}

		

		$data["title"] = "Photography By Zarek";

		$data['zareks_id'] = $zareks_id;

		$data['client_name'] = $get['client_name'];

		$data['date_client'] = $get['date_client'];

		$data['expiration_date'] = $get['expiration_date'];

		

		$this->load->view("zareks_gallery_view",$data);

	}

	

	public function zareks_gallery_view_image($zareks_id = NULL, $zareks_photos_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM zareks_photos WHERE zareks_photos_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_photos_id)."'");

		$get = $this->QModel->g($query);

		

		if( ! $this->QModel->c($query))

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data['photos'] = $get['photos'];

		$data['original_image'] = $get['original_image'];

		$data['zareks_id'] = $zareks_id;

		$data['zareks_photos_id'] = $zareks_photos_id;

		

		$this->load->view("zareks_gallery_view_image",$data);

	}

	

	public function zareks_gallery_image_purchase($zareks_id = NULL, $zareks_photos_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM zareks_photos WHERE zareks_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_id)."' AND zareks_photos_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_photos_id)."'");

		$get = $this->QModel->g($query);



		$query2 = $this->QModel->query("SELECT * FROM zareks WHERE zareks_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_id)."' AND expiration_date > CURDATE()");

		$get2 = $this->QModel->g($query2);

		

		if( ! $this->QModel->c($query) && ! $this->QModel->c($query2))

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data['photos'] = $get['photos'];

		$data['original_image'] = $get['original_image'];

		$data['zareks_id'] = $zareks_id;

		$data['zareks_photos_id'] = $zareks_photos_id;

		

		if($_POST)

		{

			$color = $this->input->post('color',FALSE,FALSE);

			$bw = $this->input->post('bw',FALSE,FALSE);

			$i = 0;

			foreach($color as $a)

			{

				if(trim(strip_tags($a)) && is_numeric(trim(strip_tags($a))))

					$i++;

			}

			$ii = 0;

			foreach($bw as $b)

			{

				if(trim(strip_tags($b)) && is_numeric(trim(strip_tags($b))))

					$ii++;

			}



			if( ! $i && ! $ii)

			{

				$data['error'] = "Please put quantity! (Numbers only)";

			}

			else

			{

				if($this->session->userdata('isCart'))

					$session_id = $this->session->userdata('isCart');

				else

					$session_id = hash_password(rand(1,9999).date("Y-m-d H:i:s").$color.$bw);

				

				$this->QModel->delete('cart',array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id));

				foreach($color as $a => $b)

				{

					if($b)

					{

						$colorValue = trim(strip_tags($b));

						

						$q = $this->QModel->sfwa('cart',array('session_id','zareks_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$zareks_photos_id,$a,'Color'));

						if($this->QModel->c($q))

						{

							$update = array(

								'quantity' => $b,

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id,'color' => 'Color'));

						}

						else

						{

							$insert = array(

								'session_id' => $session_id,

								'zareks_photos_id' => $zareks_photos_id,

								'delivery_setup_id' => $a,

								'quantity' => $b,

								'color' => "Color",

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('cart',$insert);

						}

						

						if( ! $this->session->userdata('isCart'))

						{

							$userdata = array(

								"isCart" => $session_id,

							);

							$this->session->set_userdata($userdata);

						}

					}

				}

				

				foreach($bw as $a => $b)

				{

					if($b)

					{

						$colorValue = trim(strip_tags($b));

						

						$q = $this->QModel->sfwa('cart',array('session_id','zareks_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$zareks_photos_id,$a,'B&W'));

						if($this->QModel->c($q))

						{

							$update = array(

								'quantity' => $b,

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id,'color' => 'B&W'));

						}

						else

						{

							$insert = array(

								'session_id' => $session_id,

								'zareks_photos_id' => $zareks_photos_id,

								'delivery_setup_id' => $a,

								'quantity' => $b,

								'color' => "B&W",

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('cart',$insert);

						}

						

						if( ! $this->session->userdata('isCart'))

						{

							$userdata = array(

								"isCart" => $session_id,

							);

							$this->session->set_userdata($userdata);

						}

					}

				}

				

				redirect('gallery/zareks_gallery_view_addtocart?r='.$this->input->get('r'));

			}

		}

		

		$this->load->view("zareks_gallery_image_purchase",$data);

	}

	

	public function zareks_gallery_view_addtocart($cart_id = NULL)

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

		

		if($_POST)

		{

			$quantity = $this->input->post('quantity');

			$update = $this->input->post('update');

			$remove = $this->input->post('remove');

			$checkout = $this->input->post('checkout');

			

			if($update)

			{

				if( ! $quantity OR ! is_numeric($quantity))

				{

					$data['error'] = "Please input quantity and number only.";

				}

				else

				{

					$update = array(

						'quantity' => $quantity

					);

					$this->QModel->update('cart',$update,array('cart_id' => $cart_id));

					

					redirect('gallery/zareks_gallery_view_addtocart?r='.$this->input->get('r'));

				}

			}

			else if($remove)

			{

				$q = $this->QModel->sfwa('cart','cart_id',$cart_id);

				if($this->QModel->c($q))

				{

					$g = $this->QModel->g($q);

					$this->QModel->delete('cart',array('cart_id' => $cart_id));

					

					if($g['color'] == "Color")

					{

						$q2 = $this->QModel->sfwa('cart',array('zareks_photos_id','color','session_id'),array($g['zareks_photos_id'],'B&W',$this->session->userdata('isCart')));

						if( ! $this->QModel->c($q2))

							$this->session->unset_userdata('img_zareks_id'.$g['zareks_photos_id']);

					}

					else

					{

						$q2 = $this->QModel->sfwa('cart',array('zareks_photos_id','color','session_id'),array($g['zareks_photos_id'],'Color',$this->session->userdata('isCart')));

						if( ! $this->QModel->c($q2))

							$this->session->unset_userdata('img_zareks_id'.$g['zareks_photos_id']);

					}

					

					redirect('gallery/zareks_gallery_view_addtocart?r='.$this->input->get('r'));

				}

				else

				{

					redirect('gallery/zareks_gallery_view_addtocart?r='.$this->input->get('r'));

				}

			}

			else if($checkout)

			{

				$delivery = $this->input->post('delivery');

				$type = array("Check upon pickup","Cash upon pickup","Credit Card","Mail the check","Credit Card2");

				

				if( ! $delivery)

				{

					$data['error'] = "Please choose if Pickup or Delivery.";

				}

				else if( ! in_array($delivery, $type))

				{

					$data['error'] = "Please choose if Pickup or Delivery.";

				}

				else

				{

					$query = $this->QModel->sfwa('checkout','isCart_session',$this->session->userdata('isCart'));

					

					if($this->QModel->c($query) && $this->session->userdata('isCart'))

					{

						$update = array(

							'delivery_type' => $delivery,

							'date_created' => date("Y-m-d H:i:s")

						);

						$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

						

						redirect('gallery/zareks_gallery_view_checkout?r='.$this->input->get('r'));

					}

					else

					{

						if($this->session->userdata('isCart'))

						{

							$insert = array(

								'delivery_type' => $delivery,

								'isCart_session' => $this->session->userdata('isCart'),

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('checkout',$insert);

							

							redirect('gallery/zareks_gallery_view_checkout?r='.$this->input->get('r'));

						}

						else

						{

							redirect('404');

						}

					}

				}

			}

			else

			{

				redirect('');

			}

		}

		

		$this->load->view("zareks_gallery_view_addtocart",$data);

	}

	

	public function zareks_gallery_view_checkout()

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

				

		$qpayment = $this->QModel->sfwa("checkout","isCart_session",$this->session->userdata('isCart'));

		$gpayment = $this->QModel->g($qpayment);

		$data['delivery_type'] = $delivery_type = $gpayment['delivery_type'];

		

		if($_POST)

		{

			if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

			{

				$data['card_type'] = $card_type = $this->input->post('card_type');

				$data['cardholder_name'] = $cardholder_name = $this->input->post('cardholder_name');

				$data['account_number'] = $account_number = $this->input->post('account_number');

				$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');

				$data['cvv'] = $cvv = $this->input->post('cvv');

				$data['billing_address'] = $billing_address = $this->input->post('billing_address');

				$data['city'] = $city = $this->input->post('city');

				$data['state'] = $state = $this->input->post('state');

				$data['zip_code'] = $zip_code = $this->input->post('zip_code');

				$data['same_shipping_address'] = $same_shipping_address = $this->input->post('same_shipping_address');

				$data['shipping_address'] = $shipping_address = $this->input->post('shipping_address');

				$data['shipping_city'] = $shipping_city = $this->input->post('shipping_city');

				$data['shipping_state'] = $shipping_state = $this->input->post('shipping_state');

				$data['shipping_zip_code'] = $shipping_zip_code = $this->input->post('shipping_zip_code');

				$data['phone_number1'] = $phone_number1 = $this->input->post('phone_number1');

				$data['phone_number2'] = $phone_number2 = $this->input->post('phone_number2');

				$data['phone_number3'] = $phone_number3 = $this->input->post('phone_number3');

				$data['email_address'] = $email_address = $this->input->post('email_address');

				

				$filter = $this->load->validation(

					array(

						'required|ES|Card Type' => $card_type,

						'required|E|Cardholder Name' => $cardholder_name,

						'required|INT|Account Number|16|16' => $account_number,

						'required|E|Expiration Date' => $expiration_date,

						'required|E|CVV' => $cvv,

						'required|E|Billing Address' => $billing_address,

						'required|E|City' => $city,

						'required|E|State' => $state,

						'required|E|Zip Code' => $zip_code,

						'required|E|Same Shipping Address' => $same_shipping_address,

						'required|INT|Phone Number' => $phone_number1,

						'required|INT|Phone Number' => $phone_number2,

						'required|INT|Phone Number' => $phone_number3,

						'required|E|Email Address' => $email_address

					)

				);

				

				if($filter)

				{

					$data['error'] = $filter;

					

					if($same_shipping_address == "No" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && $billing_address != $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are not the same!";

					}

					elseif($same_shipping_address == "No" && $billing_address == $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are the same!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_city)

					{

						$data['error'] = "Please fill up Shipping City!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_state)

					{

						$data['error'] = "Please fill up Shipping State!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_zip_code)

					{

						$data['error'] = "Please fill up Shipping Zip Code!";

					}

					else

					{

						

					}

				}

				else

				{

					$update = array(

						'payment_method' => $card_type,

						'cardholder_name' => $cardholder_name,

						'account_number' => $account_number,

						'expiration_date' => $expiration_date,

						'cvv' => $cvv,

						'address' => $billing_address,

						'city' => $city,

						'state_province' => $state,

						'zip_code' => $zip_code,

						'same_shipping_address' => $same_shipping_address,

						'shipping_address' => $shipping_address,

						'shipping_city_state_zip' => $shipping_city.",".$shipping_state.",".$shipping_zip_code,

						'phone_number' => "(".$phone_number1.")"." ".$phone_number2."-".$phone_number3,

						'email_address' => $email_address

					);

					$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

					

					redirect('gallery/zareks_gallery_view_receipt?r='.$this->input->get('r'));

				}

			}

			else

			{

				$data['first_name'] = $first_name = $this->input->post('first_name');

				$data['last_name'] = $last_name = $this->input->post('last_name');

				$data['address'] = $address = $this->input->post('address');

				$data['city'] = $city = $this->input->post('city');

				$data['country'] = $country = $this->input->post('country');

				$data['state'] = $state = $this->input->post('state');

				$data['zip_code'] = $zip_code = $this->input->post('zip_code');

				$data['same_shipping_address'] = $same_shipping_address = $this->input->post('same_shipping_address');

				$data['shipping_address'] = $shipping_address = $this->input->post('shipping_address');

				$data['shipping_city'] = $shipping_city = $this->input->post('shipping_city');

				$data['shipping_state'] = $shipping_state = $this->input->post('shipping_state');

				$data['shipping_zip_code'] = $shipping_zip_code = $this->input->post('shipping_zip_code');

				$data['phone_number1'] = $phone_number1 = $this->input->post('phone_number1');

				$data['phone_number2'] = $phone_number2 = $this->input->post('phone_number2');

				$data['phone_number3'] = $phone_number3 = $this->input->post('phone_number3');

				$data['email_address'] = $email_address = $this->input->post('email_address');

				

				$filter = $this->load->validation(

					array(

						'required|ES|First Name' => $first_name,

						'required|E|Last Name' => $last_name,

						'required|E|Address' => $address,

						'required|E|City' => $city,

						'required|E|Country' => $country,

						'required|E|State' => $state,

						'required|E|Zip Code' => $zip_code,

						'required|E|Same Shipping Address' => $same_shipping_address,

						'required|INT|Phone Number' => $phone_number1,

						'required|INT|Phone Number' => $phone_number2,

						'required|INT|Phone Number' => $phone_number3,

						'required|E|Email Address' => $email_address

					)

				);

				

				if($filter)

				{

					$data['error'] = $filter;

						

					if($same_shipping_address == "No" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && $address != $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are not the same!";

					}

					elseif($same_shipping_address == "No" && $address == $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are the same!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_city)

					{

						$data['error'] = "Please fill up Shipping City!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_state)

					{

						$data['error'] = "Please fill up Shipping State!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_zip_code)

					{

						$data['error'] = "Please fill up Shipping Zip Code!";

					}

				}

				else

				{

					$update = array(

						'first_name' => $first_name,

						'last_name' => $last_name,

						'address' => $address,

						'same_shipping_address' => $same_shipping_address,

						'shipping_address' => $shipping_address,

						'shipping_city_state_zip' => $shipping_city.",".$shipping_state.",".$shipping_zip_code,

						'city' => $city,

						'country' => $country,

						'state_province' => $state,

						'city' => $city,

						'zip_code' => $zip_code,

						'phone_number' => "(".$phone_number1.")"." ".$phone_number2."-".$phone_number3,

						'email_address' => $email_address

					);

					$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

					

					redirect('gallery/zareks_gallery_view_receipt?r='.$this->input->get('r'));

				}

			}

		}

		

		$this->load->view("zareks_gallery_view_checkout",$data);

	}

	

	public function zareks_gallery_view_receipt()

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

				

		$qpayment = $this->QModel->sfwa("checkout","isCart_session",$this->session->userdata('isCart'));

		$gpayment = $this->QModel->g($qpayment);

		$data['delivery_type'] = $delivery_type = $gpayment['delivery_type'];

		$email_address = $gpayment['email_address'];

		

		$address = $gpayment['address'];

		$same_shipping_address = $gpayment['same_shipping_address'];

		$shipping_address = $gpayment['shipping_address'];

		$shipping_city_state_zip = $gpayment['shipping_city_state_zip'];

		$city = $gpayment['city'];

		$country = $gpayment['country'];

		$state_province = $gpayment['state_province'];

		$zip_code = $gpayment['zip_code'];

		$phone_number = $gpayment['phone_number'];

		$payment_method = $gpayment['payment_method'];

		$cardholder_name = $gpayment['cardholder_name'];

		$account_number = $gpayment['account_number'];

		$expiration_date = $gpayment['expiration_date'];

		$cvv = $gpayment['cvv'];

		

		if($_POST)

		{

			if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

			{

				$your_name = $gpayment['cardholder_name'];

				

				$content = "

					Cardholder Name: <b>{$gpayment['cardholder_name']}</b> <br />

					Account Number: <b>{$account_number}</b> <br />

					Expiration Date: <b>{$expiration_date}</b> <br />

					CVV: <b>{$cvv}</b> <br />

					Billing Address: <b>{$address}</b> <br />

					City, State, Zip Code: <b>{$city}</b> <br />

					Same Shipping Address: <b>{$same_shipping_address}</b> <br />

					Shipping Address: <b>{$shipping_address}</b> <br />

				";

					if($same_shipping_address == "No")

					{

						$content .= "Shipping City, State, Zip: <b>{$shipping_city_state_zip}</b> <br />";

					}

					else

					{

						

					}

				$content .= "

					Phone Number: <b>{$phone_number}</b> <br />

					Email Address: <b>{$email_address}</b> <br />

				";

				

				if($delivery_type == "Credit Card")

				{

					$content .= "<div><b>Pick up at Studio - No Shipping Charges</b></div>";

				}

				else

				{

					$content .= "<div><b>Ship Photos</b></div>";

				}

				

				$content .= "Payment Method: <b>{$payment_method}</b> <br />";

			}

			else

			{

				$your_name = $gpayment['first_name']." ".$gpayment['last_name'];

				

				$content = "

					Name: <b>{$gpayment['first_name']} {$gpayment['last_name']}</b> <br />

					Address: <b>{$address}</b> <br />

					City: <b>{$city}</b> <br />

					Country: <b>{$country}</b> <br /> 

					State: <b>{$state_province}</b> <br />

					Zip Code: <b>{$zip_code}</b> <br />

					Same Shipping Address: <b>{$same_shipping_address}</b> <br />

					Shipping Address: <b>{$shipping_address}</b> <br />

				";

					if($same_shipping_address == "No")

					{

						$content .= "Shipping City, State, Zip: <b>{$shipping_city_state_zip}</b> <br />";

					}

					else

					{

						

					}

				$content .= "	

					Phone Number: <b>{$phone_number}</b> <br />

					Email Address: <b>{$email_address}</b> <br />

				";

				

				if($delivery_type == "Mail the check")

				{

					$content .= "<div><b>Ship Photos</b></div>";

				}

				else

				{

					$content .= "<div><b>Pick up at Studio - No Shipping Charges<b></div>";

				}

				

				$content .="

					Mode of Payment:

				";

				

				if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

				{

					$content .= '<b>Credit Card</b>';

				}

				else

				{

					$content .= str_replace("upon pickup","",$delivery_type);

				}

				$content .="

					<br />

				";

			}

				

			$message = '<html>

					<head>

						<title>Message</title>

					</head>

					<body>

					Dear '.$your_name.',

					<br /><br />

					Thank you for choosing Photography and Video by Zarek.  Some orders may take up to 2 weeks for completion. We will take the utmost care in producing beautiful images for your memories. If you have any question, please contact us at (818) 304-0334

					<br /><br />

					<table style="width:100%;font-family:Helvetica;">

						<tr style="background:#404040; font-size:16px;">

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Description</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Event Name</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Color or B&W?</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Size</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Quantity</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Price</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Total</th>

						</tr>

					';

					

			$total_price = 0;

			$shipping_price = 0;

			$shipping_11x14 = 0;

			$query = $this->QModel->query("SELECT * FROM cart WHERE session_id='".mysqli_real_escape_string($this->db->conn_id(),$this->session->userdata('isCart'))."' AND clients_photos_id = 0");

			if( ! $this->QModel->c($query))

			{

				echo '<tr>

						<td colspan="6" style="text-align:center;">No Records found!</td>

					</tr>';

			}

			else

			{

				while($get = $this->QModel->g($query))

				{

					if($get['zareks_photos_id'])

					{

						// Get folder name.

						$query2 = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$get['zareks_photos_id']);

						$get2 = $this->QModel->g($query2);

						

						// Get delivery_setup

						$query3 = $this->QModel->sfwa('delivery_setup_zarek','delivery_setup_id',$get['delivery_setup_id']);

						$get3 = $this->QModel->g($query3);

						$total_price += $get3['price'] * $get['quantity'];

						$quantity_price = $get3['price'] * $get['quantity'];

						

						$query4 = $this->QModel->sfwa('zareks','zareks_id',$get2['zareks_id']);

						$get4 = $this->QModel->g($query4);

					}

					

					if($get3['sizes'] == "11x14")

						$shipping_11x14++;

					

					if($get['zareks_photos_id'])

					{

						$message .= '

						<tr>

							<td style="vertical-align:top; padding:15px 0; padding-left:5px;">

								'.$get2['photos'].'

							</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get4['client_name'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get['color'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get3['sizes'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get['quantity'].'</td>

							<td style="vertical-align:top; padding:15px 0;">$'.$get3['price'].'</td>

							<td style="vertical-align:top; padding:15px 0;">$'.number_format($quantity_price,2).'</td>

							<td style="vertical-align:center;">

							</td>

						</tr>

						';

					}

				}

				$qtax = $this->QModel->sf('tax');

				$gtax = $this->QModel->g($qtax);

				$tax = $gtax['tax'];

				

				$qship1 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',1);

				$qship2 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',2);

				$qship3 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',3);

				$gship1 = $this->QModel->g($qship1);

				$gship2 = $this->QModel->g($qship2);

				$gship3 = $this->QModel->g($qship3);

				$shipCost1 = $gship1['shipping_cost'];

				$shipCost2 = $gship2['shipping_cost'];

				$shipCost3 = $gship3['shipping_cost'];

				

				$message .= '				

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sub Total:</div></td>

						<td>$'.number_format($total_price,2).'</td>

					</tr>

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sales Tax:</div></td>

						<td>$'.number_format($total_price * $tax,2).'</td>

					</tr>

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total Shipping:</div></td>

						<td>

					';

							if($delivery_type == "Check upon pickup" OR $delivery_type == "Cash upon pickup" OR $delivery_type == "Credit Card")

							{

								$message .= '$0.00'; $shipping_cost = 0;

							}

							else

							{

								if($shipping_11x14)

								{

									$message .= '$'.$shipCost1; $shipping_cost = $shipCost1;

								}

								else

								{

									if($total_price > 60)

									{

										$message .= '$'.$shipCost2; $shipping_cost = $shipCost2;

									}

									else

									{

										$message .= '$'.$shipCost3; $shipping_cost = $shipCost3;

									}

								}

							}

					$message .= '

						</td>

					</tr>

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Mode of Payment:</div></td>

						<td>

					';

							if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

							{

								$message .= 'Credit Card';

							}

							else

							{

								$message .= str_replace("upon pickup","",$delivery_type);

							}

				$message .= '

						</td>

					</tr>

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total:</div></td>

						<td>$'.number_format($total_price + ($total_price * $tax) + $shipping_cost,2).'</td>

					</tr>

				';

			}

			

			$message .= "

					</table>

					</body>

					</html>";

			

			// ------------------------- PART 2 -------------

			$message2 = '<html>

					<head>

						<title>Message</title>

					</head>

					<body>

					Please see invoice generated from your order of '.$your_name.'.

					<br /><br />

					'.$content.'

					<br /><br />

					<table style="width:100%;font-family:Helvetica;">

						<tr style="background:#404040; font-size:16px;">

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Description</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Event Name</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Color or B&W?</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Size</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Quantity</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Price</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Total</th>

						</tr>

					';

					

			$total_price = 0;

			$shipping_price = 0;

			$shipping_11x14 = 0;

			$query = $this->QModel->query("SELECT * FROM cart WHERE session_id='".mysqli_real_escape_string($this->db->conn_id(),$this->session->userdata('isCart'))."' AND clients_photos_id = 0");

			if( ! $this->QModel->c($query))

			{

				echo '<tr>

						<td colspan="6" style="text-align:center;">No Records found!</td>

					</tr>';

			}

			else

			{

				while($get = $this->QModel->g($query))

				{

					if($get['zareks_photos_id'])

					{

						// Get folder name.

						$query2 = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$get['zareks_photos_id']);

						$get2 = $this->QModel->g($query2);

						

						// Get delivery_setup

						$query3 = $this->QModel->sfwa('delivery_setup_zarek','delivery_setup_id',$get['delivery_setup_id']);

						$get3 = $this->QModel->g($query3);

						$total_price += $get3['price'] * $get['quantity'];

						$quantity_price = $get3['price'] * $get['quantity'];

						

						$query4 = $this->QModel->sfwa('zareks','zareks_id',$get2['zareks_id']);

						$get4 = $this->QModel->g($query4);

					}

					

					if($get3['sizes'] == "11x14")

						$shipping_11x14++;

					

					if($get['zareks_photos_id'])

					{

						$message2 .= '

						<tr>

							<td style="vertical-align:top; padding:15px 0; padding-left:5px;">

								'.$get2['photos'].'

							</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get4['client_name'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get['color'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get3['sizes'].'</td>

							<td style="vertical-align:top; padding:15px 0;">'.$get['quantity'].'</td>

							<td style="vertical-align:top; padding:15px 0;">$'.$get3['price'].'</td>

							<td style="vertical-align:top; padding:15px 0;">$'.number_format($quantity_price,2).'</td>

							<td style="vertical-align:center;">

							</td>

						</tr>

						';

					}

				}

			}

			

			$message2 .= '				

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sub Total:</div></td>

					<td>$'.number_format($total_price,2).'</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sales Tax:</div></td>

					<td>$'.number_format($total_price * $tax,2).'</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total Shipping:</div></td>

					<td>

				';

						if($delivery_type == "Check upon pickup" OR $delivery_type == "Cash upon pickup" OR $delivery_type == "Credit Card")

						{

							$message2 .= '$0.00'; $shipping_cost = 0;

						}

						else

						{

							if($shipping_11x14)

							{

								$message2 .= '$'.$shipCost1; $shipping_cost = $shipCost1;

							}

							else

							{

								if($total_price > 60)

								{

									$message2 .= '$'.$shipCost2; $shipping_cost = $shipCost2;

								}

								else

								{

									$message2 .= '$'.$shipCost3; $shipping_cost = $shipCost3;

								}

							}

						}

			$message2 .= '

					</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total:</div></td>

					<td>$'.number_format($total_price + ($total_price * $tax) + $shipping_cost,2).'</td>

				</tr>

			';

			

			$message2 .= "

					</table>

					</body>

					</html>";



			$this->load->email(

				$email_address,

				$message,"You placed an order to Photography by Zarek"

			);

			

			$this->load->email(

				'zarek@photographybyzarek.com',

				$message2,"An order has been placed."

			);

			

			$update = array(

				'paid' => 1

			);

			$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

			

			$this->session->unset_userdata('isCart');

			

			foreach($_SESSION as $key => $val)

			{

				if ($key !== "admin" OR $key !== "myfavorites")

				{

					$this->session->unset_userdata($key);

				}

			}

			

			redirect('gallery/zareks_gallery_view_success');

		}

		

		$this->load->view("zareks_gallery_view_receipt",$data);

	}

	

	public function zareks_gallery_view_success()

	{

		$data["title"] = "Photography By Zarek";

		

		$this->load->view("zareks_gallery_view_success",$data);

	}

	

	public function clients($clients_id = NULL)

	{

		// FORCE SSL

		if($_SERVER["HTTPS"] != "on")

		{

			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

			exit();

		}

		

		$data["title"] = "Photography By Zarek";

		

		if($_POST)

		{

			$password = $this->input->post('password');

			$data['clients_ids'] = $clients_id;

			

			if( ! $password)

			{

				$data['error'] = "Please fill up password!";

			}

			else

			{

				$query = $this->QModel->sfwa('clients',array('clients_id','password','posted'),array($clients_id,$password,'Yes'));

				

				if($this->QModel->c($query))

				{

					$userdata = array(

						"events{$clients_id}" => $clients_id,

					);

					$this->session->set_userdata($userdata);

					redirect('gallery/clients_gallery_view/'.$clients_id);

				}

				

				$data['error'] = "Wrong username or password!";

			}

		}

		

		$this->load->view("clients",$data);

	}

	

	public function clients_gallery_view($clients_id = NULL, $favorite_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND expiration_date > CURDATE()");

		$get = $this->QModel->g($query);

		$password = $get['password'];

		

		if( ! $this->QModel->c($query) OR ! $this->session->userdata('events'.$clients_id) && $password)

		{

			redirect('404');

		}

		

		if($_POST)

		{

			$email_address = $this->input->post('email_address');

			$continue = $this->input->post('continue');

			

			if($continue)

			{

				$selected = $this->input->post('selected');

				

				if( ! $selected)

				{

					$data['error2'] = "Please select atleast 1 image!";

				}

				else

				{

					// Generate Unique ID

					if($this->session->userdata('cart_unique_id')) {

						$unique_id = $this->session->userdata('cart_unique_id');

						$this->QModel->delete('selected_photos',array('unique_id' => $unique_id));

					} else {

						$unique_id = hash_password(date("YmdHis").rand(1,9999).rand(1,9999).rand(1,9999));

					}

					

					foreach($selected as $a => $b)

					{

						$insert = array(

							'unique_id' => $unique_id,

							'clients_photos_id' => $b,

							'date_created' => date("Y-m-d H:i:s")

						);

						$this->QModel->insert('selected_photos',$insert);

						

						$this->session->set_userdata(array('img_clients_id'.$b => $b));

					}

					

					if($this->session->userdata('cart_unique_id'))

					{

						redirect('gallery/view_images/'.$clients_id.'/'.$unique_id);

					}

					else

					{

						$this->session->set_userdata(array('cart_unique_id' => $unique_id));

						redirect('gallery/view_images/'.$clients_id.'/'.$unique_id);

					}

				}

			}

			else if($email_address)

			{

				if( ! $email_address)

				{

					$data['error'] = "Please enter email address!";

				}

				else if( ! filter_var($email_address, FILTER_VALIDATE_EMAIL))

				{

					$data['error'] = "Invalid email address!";

				}

				else

				{

					if($this->input->post('submit'))

					{

						$userdata = array(

							"myfavorites" => $email_address,

						);

						$this->session->set_userdata($userdata);

						

						redirect('gallery/clients_gallery_view/'.$clients_id);

					}

					else if($this->input->post('submit2'))

					{

						$qfavorite = $this->QModel->sfwa('clients_photos','clients_photos_id',$favorite_id);

						

						if($this->QModel->c($qfavorite))

						{

							$gfavorite = $this->QModel->g($qfavorite);

							

							$qfavorite2 = $this->QModel->sfwa('clients',array('clients_id','posted'),array($gfavorite['clients_id'],'Yes'));

							

							if($this->QModel->c($qfavorite))

							{

								$userdata = array(

									"myfavorites" => $email_address,

								);

								$this->session->set_userdata($userdata);

								

								$insert = array(

									'email_address' => $email_address,

									'clients_photos_id' => $favorite_id

								);

								$this->QModel->insert('myfavorites',$insert);

								

								if($this->input->get('url'))

								{

									header("Location: ".$this->input->get('url'));

									die();

								}

								else

								{

									redirect('gallery/clients_gallery_view/'.$clients_id);

								}

							}

							else

							{

								redirect('404');

							}

						}

						else

						{

							redirect('404');

						}

					}

					else

					{

						redirect('404');

					}

				}

			}

			else

			{

				redirect('404');

			}

		}

		

		$data["title"] = "Photography By Zarek";

		$data['clients_id'] = $clients_id;

		$data['client_name'] = $get['client_name'];

		$data['date_client'] = $get['date_client'];

		$data['expiration_date'] = $get['expiration_date'];

		

		$this->load->view("clients_gallery_view",$data);

	}

	

	public function clientsImagesLoading($clients_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND expiration_date > CURDATE()");

		$get = $this->QModel->g($query);

		$password = $get['password'];

		

		if( ! $this->QModel->c($query) OR ! $this->session->userdata('events'.$clients_id) && $password)

		{

			redirect('404');

		}

		

		$data['clients_id'] = $clients_id;

		

		$this->load->view("clients_returnImages",$data);

	}

	

	public function zareksImagesLoading($zareks_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM zareks WHERE zareks_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_id)."' AND expiration_date > CURDATE()");

		$get = $this->QModel->g($query);

		

		if( ! $this->QModel->c($query))

		{

			redirect('404');

		}

		

		$data['zareks_id'] = $zareks_id;

		

		$this->load->view("zareks_returnImages",$data);

	}

	

	public function view_images($clients_id = NULL, $unique_id = NULL)

	{

		$qcheck = $this->QModel->sfwa('selected_photos','unique_id',$unique_id);

		

		if( ! $this->QModel->c($qcheck))

			redirect('404');

		

		$query = $this->QModel->query("SELECT * FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND expiration_date > CURDATE()");

		$get = $this->QModel->g($query);

		$password = $get['password'];

		

		if( ! $this->QModel->c($query) OR ! $this->session->userdata('events'.$clients_id) && $password)

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data['clients_id'] = $clients_id;

		$data['client_name'] = $get['client_name'];

		$data['date_client'] = $get['date_client'];

		$data['expiration_date'] = $get['expiration_date'];

		$data['unique_id'] = $unique_id;

		

		if($_POST)

		{

			$iii = 0;

			while($gcheck = $this->QModel->g($qcheck))

			{

				$clients_photos_id = $gcheck['clients_photos_id'];

				

				$color = $this->input->post('color'.$iii);

				$bw = $this->input->post('bw'.$iii);

				

				$i = 0;

				$i2 = 0;

				foreach($color as $a)

				{

					if(trim(strip_tags($a)) && is_numeric(trim(strip_tags($a))))

						$i++;

					else

						$i2++;

				}

				$ii = 0;

				$ii2 = 0;

				foreach($bw as $b)

				{

					if(trim(strip_tags($b)) && is_numeric(trim(strip_tags($b))))

						$ii++;

					else

						$ii2++;

				}



				if( ! $i && ! $ii && $this->input->post('add'))

				{

					$data['error'] = "Please put quantity in all images! (Numbers only)";

					break;

				}

				else

				{

					if($this->session->userdata('isCart'))

						$session_id = $this->session->userdata('isCart');

					else

						$session_id = hash_password(rand(1,9999).date("Y-m-d H:i:s").rand(1,9999));

					

					$this->QModel->delete('cart',array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id));

					foreach($color as $a => $b)

					{

						if($b)

						{

							$colorValue = trim(strip_tags($b));

							

							$q = $this->QModel->sfwa('cart',array('session_id','clients_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$clients_photos_id,$a,'Color'));

							if($this->QModel->c($q))

							{

								$update = array(

									'quantity' => $b,

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id,'color' => 'Color'));

							}

							else

							{

								$insert = array(

									'session_id' => $session_id,

									'clients_photos_id' => $clients_photos_id,

									'delivery_setup_id' => $a,

									'quantity' => $b,

									'color' => "Color",

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->insert('cart',$insert);

							}

							

							if( ! $this->session->userdata('isCart'))

							{

								$userdata = array(

									"isCart" => $session_id,

								);

								$this->session->set_userdata($userdata);

							}

						}

					}

					

					foreach($bw as $a => $b)

					{

						if($b)

						{

							$colorValue = trim(strip_tags($b));

							

							$q = $this->QModel->sfwa('cart',array('session_id','clients_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$clients_photos_id,$a,'B&W'));

							if($this->QModel->c($q))

							{

								$update = array(

									'quantity' => $b,

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id,'color' => 'B&W'));

							}

							else

							{

								$insert = array(

									'session_id' => $session_id,

									'clients_photos_id' => $clients_photos_id,

									'delivery_setup_id' => $a,

									'quantity' => $b,

									'color' => "B&W",

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->insert('cart',$insert);

							}

							

							if( ! $this->session->userdata('isCart'))

							{

								$userdata = array(

									"isCart" => $session_id,

								);

								$this->session->set_userdata($userdata);

							}

						}

					}

				}

				$iii++;

			}

			

			if( ! $i && ! $ii && $this->input->post('add'))

			{

				// Do Nothing

			}

			else

			{

				if($this->input->post('return')) {

					redirect('gallery/clients_gallery_view/'.$clients_id);

				} else {

					$this->session->unset_userdata('cart_unique_id');

					redirect('gallery/clients_gallery_view_addtocart?r='.$clients_id);

				}

			}

		}

		

		$this->load->view("clients_gallery_image_purchase2",$data);

	}

	

	public function view_images_zareks($zareks_id = NULL, $unique_id = NULL)

	{

		$qcheck = $this->QModel->sfwa('selected_photos','unique_id',$unique_id);

		

		if( ! $this->QModel->c($qcheck))

			redirect('404');

		

		$query = $this->QModel->query("SELECT * FROM zareks WHERE zareks_id='".mysqli_real_escape_string($this->db->conn_id(),$zareks_id)."' AND expiration_date > CURDATE()");

		

		if( ! $this->QModel->c($query))

		{

			redirect('404');

		}

		

		$get = $this->QModel->g($query);

		$data["title"] = "Photography By Zarek";

		$data['zareks_id'] = $zareks_id;

		$data['client_name'] = $get['client_name'];

		$data['date_client'] = $get['date_client'];

		$data['expiration_date'] = $get['expiration_date'];

		$data['unique_id'] = $unique_id;

		

		if($_POST)

		{

			$iii = 0;

			while($gcheck = $this->QModel->g($qcheck))

			{

				$zareks_photos_id = $gcheck['zareks_photos_id'];

				

				$color = $this->input->post('color'.$iii);

				$bw = $this->input->post('bw'.$iii);

				$i = 0;

				

				foreach($color as $a)

				{

					if(trim(strip_tags($a)) && is_numeric(trim(strip_tags($a))))

						$i++;

				}

				$ii = 0;

				foreach($bw as $b)

				{

					if(trim(strip_tags($b)) && is_numeric(trim(strip_tags($b))))

						$ii++;

				}



				if( ! $i && ! $ii && $this->input->post('add'))

				{

					$data['error'] = "Please put quantity in all images! (Numbers only)";

					break;

				}

				else

				{

					if($this->session->userdata('isCart'))

						$session_id = $this->session->userdata('isCart');

					else

						$session_id = hash_password(rand(1,9999).date("Y-m-d H:i:s").rand(1,9999));

					

					$this->QModel->delete('cart',array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id));

					foreach($color as $a => $b)

					{

						if($b)

						{

							$colorValue = trim(strip_tags($b));

							

							$q = $this->QModel->sfwa('cart',array('session_id','zareks_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$zareks_photos_id,$a,'Color'));

							if($this->QModel->c($q))

							{

								$update = array(

									'quantity' => $b,

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id,'color' => 'Color'));

							}

							else

							{

								$insert = array(

									'session_id' => $session_id,

									'zareks_photos_id' => $zareks_photos_id,

									'delivery_setup_id' => $a,

									'quantity' => $b,

									'color' => "Color",

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->insert('cart',$insert);

							}

							

							if( ! $this->session->userdata('isCart'))

							{

								$userdata = array(

									"isCart" => $session_id,

								);

								$this->session->set_userdata($userdata);

							}

						}

					}

					

					foreach($bw as $a => $b)

					{

						if($b)

						{

							$colorValue = trim(strip_tags($b));

							

							$q = $this->QModel->sfwa('cart',array('session_id','zareks_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$zareks_photos_id,$a,'B&W'));

							if($this->QModel->c($q))

							{

								$update = array(

									'quantity' => $b,

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'zareks_photos_id' => $zareks_photos_id,'color' => 'B&W'));

							}

							else

							{

								$insert = array(

									'session_id' => $session_id,

									'zareks_photos_id' => $zareks_photos_id,

									'delivery_setup_id' => $a,

									'quantity' => $b,

									'color' => "B&W",

									'date_created' => date("Y-m-d H:i:s")

								);

								$this->QModel->insert('cart',$insert);

							}

							

							if( ! $this->session->userdata('isCart'))

							{

								$userdata = array(

									"isCart" => $session_id,

								);

								$this->session->set_userdata($userdata);

							}

						}

					}

				}

				$iii++;

			}

			

			if( ! $i && ! $ii && $this->input->post('add'))

			{

				// Do Nothing

			}

			else

			{

				if($this->input->post('return')) {

					redirect('gallery/zareks_gallery_view/'.$zareks_id);

				} else {

					$this->session->unset_userdata('cart_unique_id_zareks');

					redirect('gallery/zareks_gallery_view_addtocart?r='.$zareks_id);

				}

			}

		}

		

		$this->load->view("zareks_gallery_image_purchase2",$data);

	}

	

	/*----------------------|

	|  Enalds  				|

	|-----------------------*/

	public function enteremailfavorites($clients_id = NULL, $favorite_id = NULL)

	{

		if($_POST)

		{

			$email_address = $this->input->post('email_address');

			

			if( ! $email_address)

			{

				echo "Please enter email address!";

			}

			else if( ! filter_var($email_address, FILTER_VALIDATE_EMAIL))

			{

				echo "Invalid email address!";

			}

			else

			{

				if($this->input->post('submit'))

				{

					$userdata = array(

						"myfavorites" => $email_address,

					);

					$this->session->set_userdata($userdata);

					

					echo "Success";

				}

				else if($this->input->post('submit2'))

				{

					$qfavorite = $this->QModel->sfwa('clients_photos','clients_photos_id',$favorite_id);

					

					if($this->QModel->c($qfavorite))

					{

						$gfavorite = $this->QModel->g($qfavorite);

						

						$qfavorite2 = $this->QModel->sfwa('clients',array('clients_id','posted'),array($gfavorite['clients_id'],'Yes'));

						

						if($this->QModel->c($qfavorite))

						{

							$userdata = array(

								"myfavorites" => $email_address,

							);

							$this->session->set_userdata($userdata);

							

							$qfavorite3 = $this->QModel->sfwa('myfavorites',array('email_address','photos_id'),array($email_address,$favorite_id));

							if( ! $this->QModel->c($qfavorite3))

							{

								$insert = array(

									'email_address' => $email_address,

									'photos_id' => $favorite_id

								);

								$this->QModel->insert('myfavorites',$insert);

							}

							

							echo "Success2";

						}

						else

						{

							echo "Please enter email address!";

						}

					}

					else

					{

						echo "Please enter email address!";

					}

				}

				else if($this->input->post('submit3'))

				{

					$qfavorite = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$favorite_id);

					

					if($this->QModel->c($qfavorite))

					{

						$gfavorite = $this->QModel->g($qfavorite);

						

						$qfavorite2 = $this->QModel->sfwa('zareks',array('zareks_id','posted'),array($gfavorite['zareks_id'],'Yes'));

						

						if($this->QModel->c($qfavorite))

						{

							$userdata = array(

								"myfavorites" => $email_address,

							);

							$this->session->set_userdata($userdata);

							

							$qfavorite3 = $this->QModel->sfwa('myfavorites',array('email_address','photos_id'),array($email_address,$favorite_id));

							if( ! $this->QModel->c($qfavorite3))

							{

								$insert = array(

									'email_address' => $email_address,

									'photos_id' => $favorite_id,

									'locate' => "Zareks"

								);

								$this->QModel->insert('myfavorites',$insert);

							}

							

							echo "Success2";

						}

						else

						{

							echo "Please enter email address!";

						}

					}

					else

					{

						echo "Please enter email address!";

					}

				}

				else

				{

					echo "Please enter email address!";

				}

			}

		}

	}

	/*----------------------|

	|  Enalds  				|

	|-----------------------*/

	public function favorites($clients_id = NULL)

	{

		if( ! $this->session->userdata('myfavorites'))

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data["clients_id"] = $clients_id;

		

		$this->load->view("myfavorites",$data);

	}

	/*----------------------|

	|  Joel  				|

	|  Edited By: Enalds  	|

	|-----------------------*/

	public function clients_gallery_view_image($clients_id = NULL, $clients_photos_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM clients_photos WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND clients_photos_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_photos_id)."'");

		$get = $this->QModel->g($query);

		

		$query2 = $this->QModel->query("SELECT * FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND expiration_date > CURDATE()");

		$get2 = $this->QModel->g($query2);

		$password = $get2['password'];

		

		if( ! $this->QModel->c($query) && ! $this->QModel->c($query2) OR ! $this->session->userdata('events'.$clients_id) && $password && ! $this->QModel->c($query2))

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data['photos'] = $get['photos'];

		$data['original_image'] = $get['original_image'];

		$data['clients_id'] = $clients_id;

		$data['clients_photos_id'] = $clients_photos_id;

		$data['client_name'] = $get2['client_name'];

		$data['date_client'] = $get2['date_client'];

		$data['expiration_date'] = $get2['expiration_date'];

		

		$this->load->view("clients_gallery_view_image",$data);

	}

	/*----------------------|

	|  Joel  				|

	|  Edited By: Enalds  	|

	|-----------------------*/

	// Danger Close

	public function clients_gallery_image_purchase($clients_id = NULL, $clients_photos_id = NULL)

	{

		$query = $this->QModel->query("SELECT * FROM clients_photos WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND clients_photos_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_photos_id)."'");

		$get = $this->QModel->g($query);

		

		$query2 = $this->QModel->query("SELECT * FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$clients_id)."' AND expiration_date > CURDATE()");

		$get2 = $this->QModel->g($query2);

		$password = $get2['password'];

		

		if( ! $this->QModel->c($query) && ! $this->QModel->c($query2) OR ! $this->session->userdata('events'.$clients_id) && $password && ! $this->QModel->c($query2))

		{

			redirect('404');

		}

		

		$data["title"] = "Photography By Zarek";

		$data['photos'] = $get['photos'];

		$data['original_image'] = $get['original_image'];

		$data['clients_id'] = $clients_id;

		$data['clients_photos_id'] = $clients_photos_id;

		$data['client_name'] = $get2['client_name'];

		$data['date_client'] = $get2['date_client'];

		$data['expiration_date'] = $get2['expiration_date'];

		

		if($_POST)

		{

			$color = $this->input->post('color',FALSE,FALSE);

			$bw = $this->input->post('bw',FALSE,FALSE);

			$i = 0;

			foreach($color as $a)

			{

				if(trim(strip_tags($a)) && is_numeric(trim(strip_tags($a))))

					$i++;

			}

			$ii = 0;

			foreach($bw as $b)

			{

				if(trim(strip_tags($b)) && is_numeric(trim(strip_tags($b))))

					$ii++;

			}



			if( ! $i && ! $ii)

			{

				$data['error'] = "Please put quantity! (Numbers only)";

			}

			else

			{

				if($this->session->userdata('isCart'))

					$session_id = $this->session->userdata('isCart');

				else

					$session_id = hash_password(rand(1,9999).date("Y-m-d H:i:s").$color.$bw);

				

				$this->QModel->delete('cart',array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id));

				foreach($color as $a => $b)

				{

					if($b)

					{

						$colorValue = trim(strip_tags($b));

						

						$q = $this->QModel->sfwa('cart',array('session_id','clients_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$clients_photos_id,$a,'Color'));

						if($this->QModel->c($q))

						{

							$update = array(

								'quantity' => $b,

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id,'color' => 'Color'));

						}

						else

						{

							$insert = array(

								'session_id' => $session_id,

								'clients_photos_id' => $clients_photos_id,

								'delivery_setup_id' => $a,

								'quantity' => $b,

								'color' => "Color",

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('cart',$insert);

						}

						

						if( ! $this->session->userdata('isCart'))

						{

							$userdata = array(

								"isCart" => $session_id,

							);

							$this->session->set_userdata($userdata);

						}

					}

				}

				

				foreach($bw as $a => $b)

				{

					if($b)

					{

						$colorValue = trim(strip_tags($b));

						

						$q = $this->QModel->sfwa('cart',array('session_id','clients_photos_id','delivery_setup_id','color'),array($this->session->userdata('isCart'),$clients_photos_id,$a,'B&W'));

						if($this->QModel->c($q))

						{

							$update = array(

								'quantity' => $b,

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->update('cart',$update,array('session_id' => $this->session->userdata('isCart'),'clients_photos_id' => $clients_photos_id,'color' => 'B&W'));

						}

						else

						{

							$insert = array(

								'session_id' => $session_id,

								'clients_photos_id' => $clients_photos_id,

								'delivery_setup_id' => $a,

								'quantity' => $b,

								'color' => "B&W",

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('cart',$insert);

							

							$this->session->set_userdata(array('img_clients_id'.$b => $b));

						}

						

						if( ! $this->session->userdata('isCart'))

						{

							$userdata = array(

								"isCart" => $session_id,

							);

							$this->session->set_userdata($userdata);

						}

					}

				}

				

				redirect('gallery/clients_gallery_view_addtocart?r='.$this->input->get('r'));

			}

		}

		

		$this->load->view("clients_gallery_image_purchase",$data);

	}

	/*----------------------|

	|  Joel  				|

	|  Edited By: Enalds  	|

	|-----------------------*/

	public function clients_gallery_view_addtocart($cart_id = NULL)

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

		

		if($_POST)

		{

			$quantity = $this->input->post('quantity');

			$update = $this->input->post('update');

			$remove = $this->input->post('remove');

			$checkout = $this->input->post('checkout');

			

			if($update)

			{

				if( ! $quantity OR ! is_numeric($quantity))

				{

					$data['error'] = "Please input quantity and number only.";

				}

				else

				{

					$update = array(

						'quantity' => $quantity

					);

					$this->QModel->update('cart',$update,array('cart_id' => $cart_id));

					

					redirect('gallery/clients_gallery_view_addtocart?r='.$this->input->get('r'));

				}

			}

			else if($remove)

			{

				$q = $this->QModel->sfwa('cart','cart_id',$cart_id);

				if($this->QModel->c($q))

				{

					$g = $this->QModel->g($q);

					$this->QModel->delete('cart',array('cart_id' => $cart_id));

					

					if($g['color'] == "Color")

					{

						$q2 = $this->QModel->sfwa('cart',array('clients_photos_id','color','session_id'),array($g['clients_photos_id'],'B&W',$this->session->userdata('isCart')));

						if( ! $this->QModel->c($q2))

							$this->session->unset_userdata('img_clients_id'.$g['clients_photos_id']);

					}

					else

					{

						$q2 = $this->QModel->sfwa('cart',array('clients_photos_id','color','session_id'),array($g['clients_photos_id'],'Color',$this->session->userdata('isCart')));

						if( ! $this->QModel->c($q2))

							$this->session->unset_userdata('img_clients_id'.$g['clients_photos_id']);

					}

					

					redirect('gallery/clients_gallery_view_addtocart?r='.$this->input->get('r'));

				}

				else

				{

					redirect('gallery/clients_gallery_view_addtocart?r='.$this->input->get('r'));

				}

			}

			else if($checkout)

			{

				$delivery = $this->input->post('delivery');

				$type = array("Check upon pickup","Cash upon pickup","Credit Card","Mail the check","Credit Card2");

				

				if( ! $delivery)

				{

					$data['error'] = "Please choose if Pickup or Delivery.";

				}

				else if( ! in_array($delivery, $type))

				{

					$data['error'] = "Please choose if Pickup or Delivery.";

				}

				else

				{

					$query = $this->QModel->sfwa('checkout','isCart_session',$this->session->userdata('isCart'));

					

					if($this->QModel->c($query) && $this->session->userdata('isCart'))

					{

						$update = array(

							'delivery_type' => $delivery,

							'date_created' => date("Y-m-d H:i:s")

						);

						$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

						

						redirect('gallery/clients_gallery_view_checkout?r='.$this->input->get('r'));

					}

					else

					{

						if($this->session->userdata('isCart'))

						{

							$insert = array(

								'delivery_type' => $delivery,

								'isCart_session' => $this->session->userdata('isCart'),

								'date_created' => date("Y-m-d H:i:s")

							);

							$this->QModel->insert('checkout',$insert);

							

							redirect('gallery/clients_gallery_view_checkout?r='.$this->input->get('r'));

						}

						else

						{

							redirect('404');

						}

					}

				}

			}

			else

			{

				redirect('');

			}

		}

		

		$this->load->view("clients_gallery_view_addtocart",$data);

	}

	/*-------|

	|  Joel  |

	|--------*/

	public function clients_gallery_view_checkout()

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

				

		$qpayment = $this->QModel->sfwa("checkout","isCart_session",$this->session->userdata('isCart'));

		$gpayment = $this->QModel->g($qpayment);

		$data['delivery_type'] = $delivery_type = $gpayment['delivery_type'];

		

		if($_POST)

		{

			if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

			{

				$data['card_type'] = $card_type = $this->input->post('card_type');

				$data['cardholder_name'] = $cardholder_name = $this->input->post('cardholder_name');

				$data['account_number'] = $account_number = $this->input->post('account_number');

				$data['expiration_date'] = $expiration_date = $this->input->post('expiration_date');

				$data['cvv'] = $cvv = $this->input->post('cvv');

				$data['billing_address'] = $billing_address = $this->input->post('billing_address');

				$data['same_shipping_address'] = $same_shipping_address = $this->input->post('same_shipping_address');

				$data['shipping_address'] = $shipping_address = $this->input->post('shipping_address');

				$data['shipping_city'] = $shipping_city = $this->input->post('shipping_city');

				$data['shipping_state'] = $shipping_state = $this->input->post('shipping_state');

				$data['shipping_zip_code'] = $shipping_zip_code = $this->input->post('shipping_zip_code');

				$data['city'] = $city = $this->input->post('city');

				$data['state'] = $state = $this->input->post('state');

				$data['zip_code'] = $zip_code = $this->input->post('zip_code');

				$data['phone_number1'] = $phone_number1 = $this->input->post('phone_number1');

				$data['phone_number2'] = $phone_number2 = $this->input->post('phone_number2');

				$data['phone_number3'] = $phone_number3 = $this->input->post('phone_number3');

				$data['email_address'] = $email_address = $this->input->post('email_address');

				

				$filter = $this->load->validation(

					array(

						'required|ES|Card Type' => $card_type,

						'required|E|Cardholder Name' => $cardholder_name,

						'required|INT|Account Number|16|16' => $account_number,

						'required|E|Expiration Date' => $expiration_date,

						'required|E|CVV' => $cvv,

						'required|E|Billing Address' => $billing_address,

						'required|E|City' => $city,

						'required|E|State' => $state,

						'required|E|Zip Code' => $zip_code,

						'required|E|Same Shipping Address' => $same_shipping_address,

						'required|INT|Phone Number' => $phone_number1,

						'required|INT|Phone Number' => $phone_number2,

						'required|INT|Phone Number' => $phone_number3,

						'required|E|Email Address' => $email_address

					)

				);

				

				if($filter)

				{

					$data['error'] = $filter;

					

					if($same_shipping_address == "No" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && $billing_address != $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are not the same!";

					}

					elseif($same_shipping_address == "No" && $billing_address == $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are the same!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_city)

					{

						$data['error'] = "Please fill up Shipping City!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_state)

					{

						$data['error'] = "Please fill up Shipping State!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_zip_code)

					{

						$data['error'] = "Please fill up Shipping Zip Code!";

					}

					else

					{

						

					}

				}

				else

				{	

					$update = array(

						'payment_method' => $card_type,

						'cardholder_name' => $cardholder_name,

						'account_number' => $account_number,

						'expiration_date' => $expiration_date,

						'cvv' => $cvv,

						'address' => $billing_address,

						'same_shipping_address' => $same_shipping_address,

						'shipping_address' => $shipping_address,

						'shipping_city_state_zip' => $shipping_city.",".$shipping_state.",".$shipping_zip_code,

						'city' => $city,

						'state_province' => $state,

						'zip_code' => $zip_code,

						'phone_number' => "(".$phone_number1.")"." ".$phone_number2."-".$phone_number3,

						'email_address' => $email_address

					);

					$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

					

					redirect('gallery/clients_gallery_view_receipt?r='.$this->input->get('r'));

				}

			}

			else

			{

				$data['first_name'] = $first_name = $this->input->post('first_name');

				$data['last_name'] = $last_name = $this->input->post('last_name');

				$data['address'] = $address = $this->input->post('address');

				$data['city'] = $city = $this->input->post('city');

				$data['country'] = $country = $this->input->post('country');

				$data['state'] = $state = $this->input->post('state');

				$data['zip_code'] = $zip_code = $this->input->post('zip_code');

				$data['same_shipping_address'] = $same_shipping_address = $this->input->post('same_shipping_address');

				$data['shipping_address'] = $shipping_address = $this->input->post('shipping_address');

				$data['shipping_city'] = $shipping_city = $this->input->post('shipping_city');

				$data['shipping_state'] = $shipping_state = $this->input->post('shipping_state');

				$data['shipping_zip_code'] = $shipping_zip_code = $this->input->post('shipping_zip_code');

				$data['phone_number1'] = $phone_number1 = $this->input->post('phone_number1');

				$data['phone_number2'] = $phone_number2 = $this->input->post('phone_number2');

				$data['phone_number3'] = $phone_number3 = $this->input->post('phone_number3');

				$data['email_address'] = $email_address = $this->input->post('email_address');

				

				$filter = $this->load->validation(

					array(

						'required|ES|First Name' => $first_name,

						'required|E|Last Name' => $last_name,

						'required|E|Address' => $address,

						'required|E|City' => $city,

						'required|E|Country' => $country,

						'required|E|State' => $state,

						'required|E|Zip Code' => $zip_code,

						'required|E|Same Shipping Address' => $same_shipping_address,

						'required|INT|Phone Number' => $phone_number1,

						'required|INT|Phone Number' => $phone_number2,

						'required|INT|Phone Number' => $phone_number3,

						'required|E|Email Address' => $email_address

					)

				);

				

				if($filter)

				{

					$data['error'] = $filter;

						

					if($same_shipping_address == "No" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && ! $shipping_address)

					{

						$data['error'] = "Please fill up Shipping Address!";

					}

					elseif($same_shipping_address == "Yes" && $address != $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are not the same!";

					}

					elseif($same_shipping_address == "No" && $address == $shipping_address)

					{

						$data['error'] = "Address and Shipping Address are the same!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_city)

					{

						$data['error'] = "Please fill up Shipping City!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_state)

					{

						$data['error'] = "Please fill up Shipping State!";

					}

					elseif($same_shipping_address == "No" && ! $shipping_zip_code)

					{

						$data['error'] = "Please fill up Shipping Zip Code!";

					}

				}

				else

				{

					$update = array(

						'first_name' => $first_name,

						'last_name' => $last_name,

						'address' => $address,

						'same_shipping_address' => $same_shipping_address,

						'shipping_address' => $shipping_address,

						'shipping_city_state_zip' => $shipping_city.",".$shipping_state.",".$shipping_zip_code,

						'city' => $city,

						'country' => $country,

						'state_province' => $state,

						'zip_code' => $zip_code,

						'phone_number' => "(".$phone_number1.")"." ".$phone_number2."-".$phone_number3,

						'email_address' => $email_address

					);

					$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

					

					redirect('gallery/clients_gallery_view_receipt?r='.$this->input->get('r'));

				}

			}

		}

		

		$this->load->view("clients_gallery_view_checkout",$data);

	}

	

	public function clients_gallery_view_receipt()

	{

		if( ! $this->session->userdata('isCart'))

			redirect('404');

		

		$data["title"] = "Photography By Zarek";

				

		$qpayment = $this->QModel->sfwa("checkout","isCart_session",$this->session->userdata('isCart'));

		$gpayment = $this->QModel->g($qpayment);

		$data['delivery_type'] = $delivery_type = $gpayment['delivery_type'];

		$email_address = $gpayment['email_address'];

		

		$address = $gpayment['address'];

		$same_shipping_address = $gpayment['same_shipping_address'];

		$shipping_address = $gpayment['shipping_address'];

		$shipping_city_state_zip = $gpayment['shipping_city_state_zip'];

		$city = $gpayment['city'];

		$country = $gpayment['country'];

		$state_province = $gpayment['state_province'];

		$zip_code = $gpayment['zip_code'];

		$phone_number = $gpayment['phone_number'];

		$payment_method = $gpayment['payment_method'];

		$cardholder_name = $gpayment['cardholder_name'];

		$account_number = $gpayment['account_number'];

		$expiration_date = $gpayment['expiration_date'];

		$cvv = $gpayment['cvv'];

		

		if($_POST)

		{

			if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

			{

				$your_name = $gpayment['cardholder_name'];

				

				

				$content = "

					Cardholder Name: <b>{$gpayment['cardholder_name']}</b> <br />

					Account Number: <b>{$account_number}</b> <br />

					Expiration Date: <b>{$expiration_date}</b> <br />

					CVV: <b>{$cvv}</b> <br />

					Billing Address: <b>{$address}</b> <br />

					City, State, Zip Code: <b>{$city}</b> <br />

					Same Shipping Address: <b>{$same_shipping_address}</b> <br />

					Shipping Address: <b>{$shipping_address}</b> <br />

				";

					if($same_shipping_address == "No")

					{

						$content .= "Shipping City, State, Zip: <b>{$shipping_city_state_zip}</b> <br />";

					}

					else

					{

						

					}

				$content .= "

					Phone Number: <b>{$phone_number}</b> <br />

					Email Address: <b>{$email_address}</b> <br />

				";

				

				if($delivery_type == "Credit Card")

				{

					$content .= "<div><b>Pick up at Studio - No Shipping Charges</b></div>";

				}

				else

				{

					$content .= "<div><b>Ship Photos</b></div>";

				}

				

				$content .= "Payment Method: <b>{$payment_method}</b> <br />";

			}

			else

			{	

				$your_name = $gpayment['first_name']." ".$gpayment['last_name'];

				

				$content = "

					Name: <b>{$gpayment['first_name']} {$gpayment['last_name']}</b> <br />

					Address: <b>{$address}</b> <br />

					City: <b>{$city}</b> <br />

					Country: <b>{$country}</b> <br /> 

					State: <b>{$state_province}</b> <br />

					Zip Code: <b>{$zip_code}</b> <br />

					Same Shipping Address: <b>{$same_shipping_address}</b> <br />

					Shipping Address: <b>{$shipping_address}</b> <br />

				";

					if($same_shipping_address == "No")

					{

						$content .= "Shipping City, State, Zip: <b>{$shipping_city_state_zip}</b> <br />";

					}

					else

					{

						

					}

				$content .= "

					Phone Number: <b>{$phone_number}</b> <br />

					Email Address: <b>{$email_address}</b> <br />

				";

				

				if($delivery_type == "Mail the check")

				{

					$content .= "<div><b>Ship Photos</b></div>";

				}

				else

				{

					$content .= "<div><b>Pick up at Studio - No Shipping Charges<b></div>";

				}

				

				$content .="

					Mode of Payment:

				";

				

				if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

				{

					$content .= '<b>Credit Card</b>';

				}

				else

				{

					$content .= str_replace("upon pickup","",$delivery_type);

				}

				$content .="

					<br />

				";

			}

				

			$message = '<html>

					<head>

						<title>Message</title>

					</head>

					<body>

					Dear '.$your_name.',

					<br /><br />

					Thank you for choosing Photography and Video by Zarek.  Some orders may take up to 2 weeks for completion. We will take the utmost care in producing beautiful images for your memories. If you have any question, please contact us at (818) 304-0334

					<br /><br />

					<table style="width:100%;font-family:Helvetica;">

						<tr style="background:#404040; font-size:16px;">

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Description</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Event Name</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Color or BlknWhite?</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Size</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Quantity</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Price</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Total</th>

						</tr>

					';

					

			$total_price = 0;

			$shipping_price = 0;

			$shipping_11x14 = 0;

			$discount = 0;

			$query = $this->QModel->query("SELECT * FROM cart WHERE session_id='".mysqli_real_escape_string($this->db->conn_id(),$this->session->userdata('isCart'))."' AND zareks_photos_id = 0");

			if( ! $this->QModel->c($query))

			{

				echo '<tr>

						<td colspan="6" style="text-align:center;">No Records found!</td>

					</tr>';

			}

			else

			{

				while($get = $this->QModel->g($query))

				{

					// Get folder name.

					$query2 = $this->QModel->sfwa('clients_photos','clients_photos_id',$get['clients_photos_id']);

					$get2 = $this->QModel->g($query2);

					

					// Get delivery_setup

					$query3 = $this->QModel->sfwa('delivery_setup','delivery_setup_id',$get['delivery_setup_id']);

					$get3 = $this->QModel->g($query3);

					$total_price += $get3['price'] * $get['quantity'];

					$quantity_price = $get3['price'] * $get['quantity'];

					

					if($get3['sizes'])

						$shipping_11x14++;

					

					// Discount

					$query4 = $this->QModel->query("SELECT clients_id,discount,date_from,date_to FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$get2['clients_id'])."' AND date_to > CURDATE()");

					$get4 = $this->QModel->g($query4);

					if($this->QModel->c($query4))

						$discount += ($get3['price'] * $get['quantity']) * $get4['discount'] / 100;

					

					$query5 = $this->QModel->query("SELECT clients_id,client_name FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$get2['clients_id'])."'");

					$get5 = $this->QModel->g($query5);

					

					$message .= '

					<tr>

						<td style="vertical-align:top; padding:15px 0; padding-left:5px;">

							'.$get2['photos'].'

						</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get5['client_name'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get['color'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get3['sizes'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get['quantity'].'</td>

						<td style="vertical-align:top; padding:15px 0;">$'.$get3['price'].'</td>

						<td style="vertical-align:top; padding:15px 0;">$'.number_format($quantity_price,2).'</td>

					</tr>

					';

				}

			}

			

			$qtax = $this->QModel->sf('tax');

			$gtax = $this->QModel->g($qtax);

			$tax = $gtax['tax'];

			

			$qship1 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',1);

			$qship2 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',2);

			$qship3 = $this->QModel->sfwa('shipping_cost','shipping_cost_id',3);

			$gship1 = $this->QModel->g($qship1);

			$gship2 = $this->QModel->g($qship2);

			$gship3 = $this->QModel->g($qship3);

			$shipCost1 = $gship1['shipping_cost'];

			$shipCost2 = $gship2['shipping_cost'];

			$shipCost3 = $gship3['shipping_cost'];

			

			$message .= '

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sub Total:</div></td>

					<td>$'.number_format($total_price,2).'</td>

				</tr>

			';

			if($discount)

			{

				$message .= '

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Discount:</div></td>

						<td>-$'.number_format($discount,2).'</td>

					</tr>

				';

			}

			$message .= '

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sales Tax:</div></td>

					<td>$'.number_format(($total_price - $discount) * $tax,2).'</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total Shipping:</div></td>

					<td>

				';

						if($delivery_type == "Check upon pickup" OR $delivery_type == "Cash upon pickup" OR $delivery_type == "Credit Card")

						{

							$message .= '$0.00'; $shipping_cost = 0;

						}

						else

						{

							if($shipping_11x14)

							{

								$message .= '$'.$shipCost1; $shipping_cost = $shipCost1;

							}

							else

							{

								if($total_price > 60)

								{

									$message .= '$'.$shipCost2; $shipping_cost = $shipCost2;

								}

								else

								{

									$message .= '$'.$shipCost3; $shipping_cost = $shipCost3;

								}

							}

						}

			$message .= '

						</td>

					</tr>

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Mode of Payment:</div></td>

						<td>

					';

							if($delivery_type == "Credit Card" OR $delivery_type == "Credit Card2")

							{

								$message .= 'Credit Card';

							}

							else

							{

								$message .= str_replace("upon pickup","",$delivery_type);

							}

			$message .= '

					</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total:</div></td>

					<td>$'.number_format($total_price + (($total_price - $discount) * $tax) + $shipping_cost - $discount,2).'</td>

				</tr>

			';

			

			$message .= "

					</table>

					</body>

					</html>";



			// ------------------------- PART 2 -------------

			$message2 = '<html>

					<head>

						<title>Message</title>

					</head>

					<body>

					Please see invoice generated from your order of '.$your_name.'.

					<br /><br />

					'.$content.'

					<br /><br />

					<table style="width:100%;font-family:Helvetica;">

						<tr style="background:#404040; font-size:16px;">

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Description</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Event Name</th>

							<th style="padding:8px 0 8px 8px; text-align:left; padding-left:5px; color:#fff">Color or B&W?</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Size</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Quantity</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Price</th>

							<th style="padding:8px 0; text-align:left; padding-left:5px; color:#fff">Total</th>

						</tr>

					';

					

			$total_price = 0;

			$shipping_price = 0;

			$shipping_11x14 = 0;

			$discount = 0;

			$query = $this->QModel->query("SELECT * FROM cart WHERE session_id='".mysqli_real_escape_string($this->db->conn_id(),$this->session->userdata('isCart'))."' AND zareks_photos_id = 0");

			if( ! $this->QModel->c($query))

			{

				echo '<tr>

						<td colspan="6" style="text-align:center;">No Records found!</td>

					</tr>';

			}

			else

			{

				while($get = $this->QModel->g($query))

				{

					// Get folder name.

					$query2 = $this->QModel->sfwa('clients_photos','clients_photos_id',$get['clients_photos_id']);

					$get2 = $this->QModel->g($query2);



					// Get delivery_setup

					$query3 = $this->QModel->sfwa('delivery_setup','delivery_setup_id',$get['delivery_setup_id']);

					$get3 = $this->QModel->g($query3);

					$total_price += $get3['price'] * $get['quantity'];

					$quantity_price = $get3['price'] * $get['quantity'];

					

					if($get3['sizes'])

						$shipping_11x14++;

					

					// Discount

					$query4 = $this->QModel->query("SELECT clients_id,discount,date_from,date_to FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$get2['clients_id'])."' AND date_to > CURDATE()");

					$get4 = $this->QModel->g($query4);

					if($this->QModel->c($query4))

						$discount += ($get3['price'] * $get['quantity']) * $get4['discount'] / 100;

					

					// Get Event Name

					$query5 = $this->QModel->query("SELECT clients_id,client_name FROM clients WHERE clients_id='".mysqli_real_escape_string($this->db->conn_id(),$get2['clients_id'])."'");

					$get5 = $this->QModel->g($query5);

					

					$message2 .= '

					<tr>

						<td style="vertical-align:top; padding:15px 0; padding-left:5px;">

							'.$get2['photos'].'

						</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get5['client_name'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get['color'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get3['sizes'].'</td>

						<td style="vertical-align:top; padding:15px 0;">'.$get['quantity'].'</td>

						<td style="vertical-align:top; padding:15px 0;">$'.$get3['price'].'</td>

						<td style="vertical-align:top; padding:15px 0;">$'.number_format($quantity_price,2).'</td>

						<td style="vertical-align:center;">

						</td>

					</tr>

					';

				}

			}

			

			$message2 .= '

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sub Total:</div></td>

					<td>$'.number_format($total_price,2).'</td>

				</tr>

			';

			if($discount)

			{

				$message2 .= '

					<tr>

						<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Discount:</div></td>

						<td>-$'.number_format($discount,2).'</td>

					</tr>

				';

			}

			$message2 .= '

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Sales Tax:</div></td>

					<td>$'.number_format(($total_price - $discount) * $tax,2).'</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total Shipping:</div></td>

					<td>

				';

						if($delivery_type == "Check upon pickup" OR $delivery_type == "Cash upon pickup" OR $delivery_type == "Credit Card")

						{

							$message2 .= '$0.00'; $shipping_cost = 0;

						}

						else

						{

							if($shipping_11x14)

							{

								$message2 .= '$'.$shipCost1; $shipping_cost = $shipCost1;

							}

							else

							{

								if($total_price > 60)

								{

									$message2 .= '$'.$shipCost2; $shipping_cost = $shipCost2;

								}

								else

								{

									$message2 .= '$'.$shipCost3; $shipping_cost = $shipCost3;

								}

							}

						}

			$message2 .= '

					</td>

				</tr>

				<tr>

					<td colspan="5" style="text-align:right;"><div style="margin-right:5px">Total:</div></td>

					<td>$'.number_format($total_price + (($total_price - $discount) * $tax) + $shipping_cost - $discount,2).'</td>

				</tr>

			';

			

			$message2 .= "

					</table>

					</body>

					</html>";



			$this->load->email(

				$email_address,

				$message,"You placed an order to Photography by Zarek"

			);

			

			$this->load->email(

				'zarek@photographybyzarek.com',

				$message2,"An order has been placed."

			);

			

			$update = array(

				'paid' => 1

			);

			$this->QModel->update('checkout',$update,array('isCart_session' => $this->session->userdata('isCart')));

			

			foreach($_SESSION as $key => $val)

			{

				if ($key !== "admin" OR $key !== "myfavorites")

				{

					$this->session->unset_userdata($key);

				}

			}

			

			redirect('gallery/clients_gallery_view_success');

		}

		

		$this->load->view("clients_gallery_view_receipt",$data);

	}

	

	public function clients_gallery_view_success()

	{

		$data["title"] = "Photography By Zarek";

		

		$this->load->view("clients_gallery_view_success",$data);

	}

	

	public function checksession($clients_id = NULL)

	{

		if($this->session->userdata('events'.$clients_id))

		{

			echo "Success";

		}

		else

		{

			echo "Not Success";

		}

	}

	

	public function logout($clients_id = NULL)

	{

		if($this->session->userdata('events'.$clients_id))

		{

			$this->session->unset_userdata('events'.$clients_id);

			$this->session->unset_userdata('myfavorites');

			redirect('gallery/clients');

		}

		else

		{

			redirect('404');

		}

	}

	

	public function myfavorites($clients_id = NULL, $photo_id = NULL, $type = NULL)

	{

		if($this->session->userdata('myfavorites'))

		{

			if($type == "clients")

			{

				$qfavorite = $this->QModel->sfwa('clients_photos','clients_photos_id',$photo_id);

				if($this->QModel->c($qfavorite))

				{

					$gfavorite = $this->QModel->g($qfavorite);

					

					$qfavorite2 = $this->QModel->sfwa('clients',array('clients_id','posted'),array($clients_id,'Yes'));

					

					if($this->QModel->c($qfavorite))

					{

						$query = $this->QModel->sfwa('myfavorites',array('email_address','photos_id','locate'),array($this->session->userdata('myfavorites'),$photo_id,'Clients'));

						if($this->QModel->c($query))

						{

							$this->QModel->delete('myfavorites',array('email_address' => $this->session->userdata('myfavorites'),'photos_id' => $photo_id,'locate' => 'Clients'));

							

							echo "Successfully deleted.";

						}

						else

						{

							$insert = array(

								'email_address' => $this->session->userdata('myfavorites'),

								'photos_id' => $photo_id,

								'locate' => "Clients"

							);

							$this->QModel->insert('myfavorites',$insert);

							

							echo "Successfully added.";

						}

					}

					else

					{

						redirect('404');

					}

				}

				else

				{

					redirect('404');

				}

			}

			else

			{

				$qfavorite = $this->QModel->sfwa('zareks_photos','zareks_photos_id',$photo_id);

				if($this->QModel->c($qfavorite))

				{

					$gfavorite = $this->QModel->g($qfavorite);

					

					$qfavorite2 = $this->QModel->sfwa('zareks',array('zareks_id','posted'),array($clients_id,'Yes'));

					

					if($this->QModel->c($qfavorite))

					{

						$query = $this->QModel->sfwa('myfavorites',array('email_address','photos_id','locate'),array($this->session->userdata('myfavorites'),$photo_id,'Zareks'));

						if($this->QModel->c($query))

						{

							$this->QModel->delete('myfavorites',array('email_address' => $this->session->userdata('myfavorites'),'photos_id' => $photo_id,'locate' => 'Zareks'));

							

							echo "Successfully deleted.";

						}

						else

						{

							$insert = array(

								'email_address' => $this->session->userdata('myfavorites'),

								'photos_id' => $photo_id,

								'locate' => "Zareks"

							);

							$this->QModel->insert('myfavorites',$insert);

							

							echo "Successfully added.";

						}

					}

					else

					{

						redirect('404');

					}

				}

				else

				{

					redirect('404');

				}

			}

		}

		else

		{

			redirect('404');

		}

	}

}

