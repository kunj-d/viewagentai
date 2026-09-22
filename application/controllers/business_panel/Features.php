<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Feature_Model');
		$this->load->model($this->config->item('adminFolderName').'/Package_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 15;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['add_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$list = $this->Feature_Model->getRecordList();
		$output['list'] = $list;
		
		$output['active'] = $this->Feature_Model->getAllCount('active');
		$output['inactive'] = $this->Feature_Model->getAllCount('inactive');
		$output['total'] = $this->Feature_Model->getAllCount();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 15;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['feature'] = $this->input->post('feature');
		$output['condition_val'] = $this->input->post('condition_val');
		$output['app_id'] = $this->input->post('app_id');
		
		if($_POST)
		{
			  
			$this->form_validation->set_rules('feature','Feature','trim|required');
			$this->form_validation->set_rules('condition_val','Condition Value','trim|required');
			$this->form_validation->set_rules('app_id','App','trim|required');

			if($this->form_validation->run())
			 {
			   $this->Feature_Model->addRecord();
			   $this->session->set_userdata('success_msg','Feature Created Successfully');
			   redirect($this->config->item('adminName').'/manage-features');
			 }
		}
		
		$output['page_title'] = 'Add New Feature';
        $output['page_name'] = 'add';
		$output['appList'] = $this->Package_Model->getAppList();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 15;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$detail = $this->Feature_Model->getRecordDetail($id);
		$feature = $detail->feature;
		$condition_val = $detail->condition_val;
		$app_id = $detail->app_id;
		
		if($_POST)
		{
			$feature = $this->input->post('feature');
			$app_id = $this->input->post('app_id');

			$this->form_validation->set_rules('feature','Feature','trim|required');
			$this->form_validation->set_rules('condition_val','Condition Value','trim|required');
			$this->form_validation->set_rules('app_id','App','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Feature_Model->updateRecord($id);
			   $this->session->set_userdata('success_msg','Feature Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-features');
			 }
			 
		}
		
		$output['feature'] = $feature;
		$output['condition_val'] = $condition_val;
		$output['app_id'] = $app_id;
		$output['page_title'] = 'Edit Feature';
        $output['appList'] = $this->Package_Model->getAppList();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function deleteRecord($id) {
	
	   $output['manager_id'] = $manager_id = 15;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Feature_Model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Feature Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-features');
	}
	function changeStatus($task,$id) {
	
	   $output['manager_id'] = $manager_id = 15;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Feature_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Feature Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-features');
	}
}