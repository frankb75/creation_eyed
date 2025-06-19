<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Headshots extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("headshots",$data);
	}
	
	public function category()
	{
		$data["title"] = "Photography By Zarek";
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "adult" )
		{
			$data['categ'] = "Adult";
			$data['cats'] = "Adult";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM headshots_photos WHERE category='Adult' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		elseif( $type == "children2" )
		{
			$data['categ'] = "Children";
			$data['cats'] = "Child";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM headshots_photos WHERE category='Child' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		elseif( $type == "business" )
		{
			$data['categ'] = "Business";
			$data['cats'] = "Business";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM headshots_photos WHERE category='Business' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("category_headshots",$data);
	}
}
