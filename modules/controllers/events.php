<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("event",$data);
	}
	
	public function category()
	{
		$data["title"] = "Photography By Zarek";
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "weddings" )
		{
			$categ = $data['categ'] = "Weddings";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM events_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		elseif( $type == "engagement" )
		{
			$categ = $data['categ'] = "Engagement";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM events_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		elseif( $type == "bar_mitzvahs" )
		{
			$categ = $data['categ'] = "Bar Mitzvahs";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM events_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		elseif( $type == "corporate" )
		{
			$categ = $data['categ'] = "Corporate";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM events_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("category",$data);
	}
}
