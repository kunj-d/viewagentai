<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_videos extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Training_video_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 27;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-training-videos/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Training_video_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Training_video_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Training_video_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Training_video_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Training_video_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_videos/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 27;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Training_video_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/training_videos/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 26;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['categories'] = $this->Training_video_Model->getCategoryList();
		
		if($_POST)
		{
			$training_video_category_id = $this->input->post('training_video_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$type = $this->input->post('type');
			$url = $this->input->post('url');
			$sort_order = $this->input->post('sort_order');

			$this->form_validation->set_rules('training_video_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('type','Type','trim|required');
			$this->form_validation->set_rules('url','URL','trim|required');
			$this->form_validation->set_rules('sort_order','Sort Order','trim|required');
			if($_FILES['video_thumbnail']['name']=='')
			$this->form_validation->set_rules('video_thumbnail','Thumbnail','trim|required');
			
			if($this->form_validation->run())
			 {
			   if($_FILES['video_thumbnail']['name']!='')
			    { 
				   $config['upload_path'] = './assets/uploads/training_video_image/';
				   $config['allowed_types'] = 'gif|jpg|png|jpeg';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('video_thumbnail'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			   }
				 if($img_error=='') 
				  {
				    $this->Training_video_Model->addRecord($data['upload_data']['file_name']);
				    $this->session->set_userdata('success_msg','Training Video Created Successfully');
				    redirect($this->config->item('adminName').'/manage-training-videos');
				  }
			 }
		}
		
		$output['training_video_category_id'] = $training_video_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['type'] = $type;
		$output['url'] = $url;
		$output['page_title'] = 'Add New Video';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_videos/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 27;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['categories'] = $this->Training_video_Model->getCategoryList();

		$detail = $this->Training_video_Model->getRecordDetail($id);
		$training_video_category_id = $detail->training_video_category_id;
		$title = $detail->title;
		$slug = $detail->slug;
		$type = $detail->type;
		$video_thumbnail = $detail->video_thumbnail;
		$url = $detail->url;
		$sort_order = $detail->sort_order;
		
		if($_POST)
		{
			$training_video_category_id = $this->input->post('training_video_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$type = $this->input->post('type');
			$url = $this->input->post('url');
			$sort_order = $this->input->post('sort_order');

			$this->form_validation->set_rules('training_video_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('type','Type','trim|required');
			$this->form_validation->set_rules('url','URL','trim|required');
			$this->form_validation->set_rules('sort_order','Sort Order','trim|required');
			
			if($this->form_validation->run())
			 {
			   if($_FILES['video_thumbnail']['name']!='')
			    { 
				   $config['upload_path'] = './assets/uploads/training_video_image/';
				   $config['allowed_types'] = 'gif|jpg|png|jpeg';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('video_thumbnail'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			   }
			   
			   if($img_error=='')
			    {
				   $this->Training_video_Model->updateRecord($id,$data['upload_data']['file_name']);
				   $this->session->set_userdata('success_msg','Training Videos Updated Successfully');
				   redirect($this->config->item('adminName').'/manage-training-videos');
				}
			 }
			 
		}
		
		$output['training_video_category_id'] = $training_video_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['type'] = $type;
		$output['url'] = $url;
		$output['sort_order'] = $sort_order;
		$output['video_thumbnail'] = $video_thumbnail;
		$output['page_title'] = 'Edit Video';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_videos/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 27;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Training_video_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','Video Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-training-videos');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 27;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Training_video_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Video Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-training-videos');
	}
}