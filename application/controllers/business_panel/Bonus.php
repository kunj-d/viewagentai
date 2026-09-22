<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Bonus_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 35;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-bonus/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Bonus_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Bonus_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Bonus_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Bonus_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Bonus_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 35;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Bonus_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/bonus/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 34;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['categories'] = $this->Bonus_Model->getCategoryList();
		
		if($_POST)
		{
			$bonus_category_id = $this->input->post('bonus_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$description = $this->input->post('description');
			$url = $this->input->post('url');

			$this->form_validation->set_rules('bonus_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');
			$this->form_validation->set_rules('url','URL','trim|required');
			 if($_FILES['image']['name']=='')
			$this->form_validation->set_rules('image','Image','trim|required');
			
			if($this->form_validation->run())
			 {
			   if($_FILES['image']['name']!='')
			    { 
				   $config['upload_path'] = './assets/uploads/bonus_image/';
				   $config['allowed_types'] = 'gif|jpg|png|jpeg';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('image'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			   }
				 if($img_error=='')
				  {
				   $this->Bonus_Model->addRecord($data['upload_data']['file_name']);
				   $this->session->set_userdata('success_msg','Bonus Created Successfully');
				   redirect($this->config->item('adminName').'/manage-bonus');
				  }
			 }
		}
		
		$output['bonus_category_id'] = $bonus_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['description'] = $description;
		$output['url'] = $url;
		$output['page_title'] = 'Add New Bonus';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 35;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['categories'] = $this->Bonus_Model->getCategoryList();

		$detail = $this->Bonus_Model->getRecordDetail($id);
		$bonus_category_id = $detail->bonus_category_id;
		$title = $detail->title;
		$slug = $detail->slug;
		$description = $detail->description;
		$url = $detail->url;
		$image = $detail->image;
		
		if($_POST)
		{
			$bonus_category_id = $this->input->post('bonus_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$description = $this->input->post('description');
			$url = $this->input->post('url');
			
			$this->form_validation->set_rules('bonus_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');
			$this->form_validation->set_rules('url','URL','trim|required');
			
			if($this->form_validation->run())
			 {
			
			   if($_FILES['image']['name']!='')
				{ 
				   $config['upload_path'] = './assets/uploads/bonus_image/';
				   $config['allowed_types'] = 'gif|jpg|png|jpeg';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('image'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			   }
			   if($img_error=='')
			    {
			      $this->Bonus_Model->updateRecord($id,$data['upload_data']['file_name']);
			      $this->session->set_userdata('success_msg','Bonus Updated Successfully');
			      redirect($this->config->item('adminName').'/manage-bonus');
			   }
			 }
			 
		}
		
		$output['bonus_category_id'] = $bonus_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['image'] = $image;
		$output['description'] = $description;
		$output['url'] = $url;
		$output['page_title'] = 'Edit Bonus';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 35;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Bonus_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','Bonus Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-bonus');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 35;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Bonus_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Bonnus Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-bonus');
	}
}