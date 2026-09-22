<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');


class Training extends AppDefault {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('logged_in')){
			redirect(config_item('redirect_www_url')."login");
		}
		if(!isset($_REQUEST['cron'])){
			//$this->check_login();
			//$this->check_channellogin();
		}
		
	//	echo '<pre>'; print_r($this->session->userdata('business_id')); die;
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id 			= $this->session->userdata('logged_in')['id'];
		$this->business_id		= $this->session->userdata('business_id');
	//	$this->business_id= 1;

		$this->assets_folder = $this->config->item('assetsTemplatePath');
		$this->load->model("default/Training_Model");
		$this->load->model("default/Faq_Model");

	}


/* 	public function index(){
		$output['video_data'] = $this->Training_Model->all_video();
		//$output['fetch_data'] = $this->Training_Model->all_video();
		$output['fetch_pdf'] = $this->Training_Model->all_pdf();
		$this->view('training/training', $output);
	} */

	public function index()
	{
		$output['type'] = 'video';
		$output['video_data'] = $this->Training_Model->all_video();
		//echo "<pre>"; print_r($output['video_data']); die;
        $this->loadView('training/trainings', $output);
	}
	
	public function pdfTraining()
	{
		$output['type'] = 'pdf';
		$output['fetch_pdf']  = $this->Training_Model->all_pdf();
		//echo "<pre>"; print_r($output['fetch_pdf']); die;
        $this->loadView('training/trainings', $output);

	}
	public function faqs($slug = 0)
	{
		$output['likedata'] = $this->get_faq_like_data($this->user_id);
		$output['type'] = 'faq';
		$output['allCat'] = $this->Faq_Model->getCategoryList();
	  	$search = '';
	   if(isset($_POST['search']))
		{
	 
			$search = $_POST['search'];
			//$output->search = $_POST['search'];
			$this->form_validation->set_rules('search','Search Text','trim|required');
			if($this->form_validation->run())
			 {
				$output['fetch_data'] = $this->Faq_Model->getSearchRecord();
			 }
			
			
			
		}
	  else{	
		  if($slug)
		  {
			$output['fetch_data'] = $this->Faq_Model->getRecordData($slug);
		  }
		  else
		  {
			$slug = $output['allCat'][0]->slug;
			$output['fetch_data'] = $this->Faq_Model->getRecordData($slug);
		  }
		
	  }
	//   print_r($output['fetch_data']);
	//   die;
	  $output['user_id'] = $this->user_id;
	  $output['search'] = $search;
	  $output['active_slug'] = $slug;
    //   $this->loadView('training/trainings', $output);
    
      $this->loadView('training/trainings-faqs', $output);

	}
	public function faqsLikeDislikeJson(){
		//echo "<pre>"; print_r($_POST); die('ff');
		$user_id = $this->user_id;
		$title = $this->input->post('title');
		$faq_id = $this->input->post('faq_id');
			
		if($title == 'Like'){
			$data = array(	'faq_id' 		=> 	$faq_id,
						 'user_id' => 	$user_id,
						 'status' => '1',
						 'created' 		=> time(),
					);
			$this->db->where('faq_id', $faq_id);
			$this->db->where('user_id', $user_id);
			$this->db->delete('faq_likes');		
			$this->db->insert('faq_likes',$data);
			echo 1;
		}
		elseif($title == 'Dislike'){
			$data = array(	
						 'faq_id' 		=> 	$faq_id,
						 'user_id' 		=> 	$user_id,
						 'status' 		=> '-1',
						 'created' 		=> time(),
					);
			$this->db->where('faq_id', $faq_id);
			$this->db->where('user_id', $user_id);
			$this->db->delete('faq_likes');	
				$this->db->insert('faq_likes',$data);
			echo 2;
		}
	}
	public function get_faq_like_data($user_id){
		$this->db->where('user_id', $user_id);
		$query=$this->db->get('faq_likes');
		return $query->result();
	}
	
	
	
			
}


?>
