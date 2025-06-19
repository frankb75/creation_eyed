<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Digital_Imaging extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("digital_imaging",$data);
	}
	
	public function category()
	{
		$data["title"] = "Photography By Zarek";
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "retouching_restoration" )
		{
			$data['categ'] = "Retouching/Restoration";
			$data['cats'] = "Retouching Restoration - Before and After";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM headshots_photos WHERE category='Retouching Restoration - Before and after' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		elseif( $type == "image_manipulation" )
		{
			$data['categ'] = "Image Manipulation";
			$data['cats'] = "Image Manipulation";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM headshots_photos WHERE category='Image Manipulation' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("category_digital_imaging",$data);
	}
}
