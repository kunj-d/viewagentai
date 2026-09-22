<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus_category extends CI_Controller {

	function __construct() 
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Bonus_cat_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 36;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['add_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add');
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-bonus-category/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Bonus_cat_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Bonus_cat_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Bonus_cat_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Bonus_cat_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Bonus_cat_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus_cat/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 36;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Bonus_cat_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/bonus_cat/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 36;
		$this->Common_Modal->checkForPageAccess($manager_id,'add','redirect');
		
		if($_POST)
		{
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');

		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			
			if($this->form_validation->run())
			 {
				   $this->Bonus_cat_Model->addRecord();
				   $this->session->set_userdata('success_msg','Category Created Successfully');
				   redirect($this->config->item('adminName').'/manage-bonus-category');
			 }
		}
		
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['page_title'] = 'Add New Category';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus_cat/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 36;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$detail = $this->Bonus_cat_Model->getRecordDetail($id);
		$title = $detail->title;
		$slug = $detail->slug;
		
		if($_POST)
		{
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');

		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Bonus_cat_Model->updateRecord($id);
			   
			   $this->session->set_userdata('success_msg','Category Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-bonus-category');
			 }
			 
		}
		
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['page_title'] = 'Edit Category';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/bonus_cat/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 36;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Bonus_cat_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','Category Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-bonus-category');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 36;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Bonus_cat_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Category Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-bonus-category');
	}
}