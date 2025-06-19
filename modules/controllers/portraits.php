<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portraits extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("portraits",$data);
	}
	
	public function category()
	{
		$data["title"] = "Photography By Zarek";
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "family" )
		{
			$categ = $data['categ'] = "Family";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM portraits_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		elseif( $type == "individual" )
		{
			$categ = $data['categ'] = "Individual";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM portraits_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		elseif( $type == "children" )
		{
			$categ = $data['categ'] = "Children";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM portraits_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		elseif( $type == "pregnancy_boudoir" )
		{
			$categ = $data['categ'] = "Pregnancy/Boudoir";
			
			$num = $this->input->get('num');
			$data['num'] = (int)($num);
			$data['per_page'] = 9;
			$query = $this->QModel->query("SELECT * FROM portraits_photos WHERE category='".$categ."' ORDER BY photos_id ASC");
			$data['total_row'] = $this->QModel->c($query);
			
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("category_portrait",$data);
	}
}
