<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		if($_POST)
		{
			$submit = $this->input->post('submit');
			
			if( ! $submit )
			{
				redirect('404');
			}
			else
			{
				$data['fullname'] = $fullname = $this->input->post('fullname');
				$data['email'] = $email = $this->input->post('email');
				$data['pnumber'] = $pnumber = $this->input->post('pnumber');
				$data['date_event'] = $date_event = $this->input->post('date_event');
				$data['typephoto'] = $typephoto = $this->input->post('typephoto');
				$data['comment'] = $comment = $this->input->post('comment');
				
				$filter = $this->load->validation(
					array(
							'required|E|Name|4|20' => $fullname,
							'required|EMAIL|Email' => $email,
							'required|E|Phone Number' => $pnumber,
							'required|E|Date Event' => $date_event,
							'required|E|Type of Photo' => $typephoto,
							'not|E|Comment' => $comment
					)
				);
				
				if($filter)
				{
					$data['error'] = $filter;
				}
				else
				{
					
					$to = "zarek@photographybyzarek.com";
					$subject = "PBZ Inquiry";
					
					$message_content = "
					<html>
						<head>
							<title>".$subject."</title>
						</head>
					<body>
						<b>Name:</b> ".$fullname."<br />
						<b>Email Address:</b> ".$email."<br />
						<b>Phone:</b> ".$pnumber ."<br />
						<b>Date Event:</b> ".$date_event ."<br />
						<br />
						<br />
						<b>Type of Photo:</b> ".$typephoto ."<br />
						<b>Message:</b> ".$comment."
					</body>
					</html>
					";
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
					$headers .= "X-Mailer: PHP/" . phpversion()."\r\n";
					$headers .= "From: ".$fullname." <".$email.">" . "\r\n";
					$headers .= "Reply-To: ".$fullname." <".$email.">" . "\r\n";
					
					mail($to,$subject,$message_content,$headers);
					$this->session->set_flashdata('success','<span style="color:green">Message successfully submitted.</span><br />');
					redirect('contact');
					
				}
			}
		}
		
		$this->load->view("contact",$data);
	}
}
