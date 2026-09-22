<?php
class Training_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->users = $this->config->item("users");
		
	}
	
	
	/* fetch all video with category start */

	function all_video(){

		$this->db->select('tbl_training_video_categories.id as category_id,tbl_training_video_categories.title as category_title,tbl_training_videos.id as video_id,tbl_training_videos.title,tbl_training_videos.slug,tbl_training_videos.type,tbl_training_videos.url,tbl_training_videos.status,tbl_training_videos.video_thumbnail');	$this->db->join('tbl_training_video_categories','tbl_training_videos.training_video_category_id=tbl_training_video_categories.id','left');
		$this->db->where('tbl_training_videos.status','active');
		$this->db->where('tbl_training_video_categories.status','active');
		$this->db->order_by('tbl_training_videos.sort_order','asc');
		// $this->db->order_by('tbl_training_videos.title','asc');

		$query=$this->db->get('tbl_training_videos');
		if($query->num_rows()>0){
			$result1= array();
			return $result =$query->result();
		}

		return 0;

	}

	/* fetch all video with category end */

	/* fetch all pdf with category start */

	function all_pdf(){

		$this->db->select('tbl_training_pdf_categories.id as category_id,tbl_training_pdf_categories.title as category_title,tbl_training_pdfs.id as video_id,tbl_training_pdfs.title,tbl_training_pdfs.slug,tbl_training_pdfs.status,tbl_training_pdfs.pdf_file');
		$this->db->join('tbl_training_pdf_categories','tbl_training_pdfs.training_pdf_category_id=tbl_training_pdf_categories.id','left');
		$this->db->where('tbl_training_pdfs.status','active');
		$this->db->order_by('tbl_training_pdfs.sort_order','asc');
		$query=$this->db->get('tbl_training_pdfs');

		if($query->num_rows()>0){
			return $result =$query->result();

		}

		return 0;

	}

	/* fetch all pdf with category end */
	

	

	
}