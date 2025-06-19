<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CE_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data["title"] = "Photography By Zarek";
		
		$this->load->view("video",$data);
	}
	
	public function category()
	{
		$data["title"] = "Photography By Zarek";
		
		$data['type'] = $this->input->get('type');
		$type = $this->input->get('type');
		
		if( $type == "weddings" )
		{
			$data['categ'] = "Weddings";
			$data['location_thumb'] = "uploads/video/weddings/thumbnails/";
			$data['location_vid'] = "uploads/video/weddings/";
			
			$query = $this->QModel->query("SELECT * FROM videos WHERE category='Weddings' ORDER BY video_id ASC");
			
			$get = $this->QModel->g($query);
			$data['video_title'] = $get['video_title'];
			$data['description'] = $get['description'];
			
		}
		elseif( $type == "bar_mitzvahs" )
		{
			$data['categ'] = "Bar Mitzvahs";
			$data['location_thumb'] = "uploads/video/bar_mitzvahs/thumbnails/";
			$data['location_vid'] = "uploads/video/bar_mitzvahs/";
			
			$query = $this->QModel->query("SELECT * FROM videos WHERE category='Bar Mitzvahs' ORDER BY video_id ASC");
			
			$get = $this->QModel->g($query);
			$data['video_title'] = $get['video_title'];
			$data['description'] = $get['description'];
		}
		elseif( $type == "celebrate_life" )
		{
			$data['categ'] = "Celebration of Life";
			$data['location_thumb'] = "uploads/video/celebration_of_life/thumbnails/";
			$data['location_vid'] = "uploads/video/celebration_of_life/";
			
			$query = $this->QModel->query("SELECT * FROM videos WHERE category='Celebration of Life' ORDER BY video_id ASC");
			
			$get = $this->QModel->g($query);
			$data['video_title'] = $get['video_title'];
			$data['description'] = $get['description'];
		}
		elseif( $type == "growing_montage" )
		{
			$data['categ'] = "Growing Up Montage";
			$data['location_thumb'] = "uploads/video/growing_up_montage/thumbnails/";
			$data['location_vid'] = "uploads/video/growing_up_montage/";
			
			$query = $this->QModel->query("SELECT * FROM videos WHERE category='Growing Up Montage' ORDER BY video_id ASC");
			
			$get = $this->QModel->g($query);
			$data['video_title'] = $get['video_title'];
			$data['description'] = $get['description'];
		}
		elseif( $type == "specialty" )
		{
			$data['categ'] = "Specialty";
			$data['location_thumb'] = "uploads/video/specialty/thumbnails/";
			$data['location_vid'] = "uploads/video/specialty/";
			
			$query = $this->QModel->query("SELECT * FROM videos WHERE category='Specialty' ORDER BY video_id ASC");
			
			$get = $this->QModel->g($query);
			$data['video_title'] = $get['video_title'];
			$data['description'] = $get['description'];
		}
		else
		{
			redirect('404');
		}
		
		$this->load->view("cetegory_video",$data);
	}
}
