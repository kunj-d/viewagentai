<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_fields extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Package_field_Model');
		$this->load->model($this->config->item('adminFolderName').'/Package_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 14;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['add_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$list = $this->Package_field_Model->getRecordList();
		$output['list'] = $list;
		
		$output['active'] = $this->Package_field_Model->getAllCount('active');
		$output['inactive'] = $this->Package_field_Model->getAllCount('inactive');
		$output['total'] = $this->Package_field_Model->getAllCount();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/package_field/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 14;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['field_name'] = $this->input->post('field_name');
		$output['condition_val'] = $this->input->post('condition_val');
		$output['app_id'] = $this->input->post('app_id');
		$output['overages'] = $this->input->post('overages');
		$output['input_type'] = $this->input->post('input_type');
		$output['input_val'] = $this->input->post('input_val');
		$output['field_type'] = $this->input->post('field_type');
		
		if($_POST)
		{
			  
			$this->form_validation->set_rules('field_name','Field Name','trim|required');
			$this->form_validation->set_rules('condition_val','Condition Value','trim|required');
			$this->form_validation->set_rules('app_id','App','trim|required');
			$this->form_validation->set_rules('overages','Overages','trim|required');
			$this->form_validation->set_rules('input_type','Input Type','trim|required');
			if($this->input->post('input_type')=='select')
			$this->form_validation->set_rules('input_val','Input Value','trim|required');
			$this->form_validation->set_rules('field_type','Field Type','trim|required');

			if($this->form_validation->run())
			 {
			   $this->Package_field_Model->addRecord();
			   $this->session->set_userdata('success_msg','Package Field Created Successfully');
			   redirect($this->config->item('adminName').'/manage-package-fields');
			 }
		}
		
		$output['page_title'] = 'Add New Package Field';
        $output['page_name'] = 'add';
		$output['appList'] = $this->Package_Model->getAppList();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/package_field/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 14;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$detail = $this->Package_field_Model->getRecordDetail($id);
		$field_name = $detail->field_name;
		$condition_val = $detail->condition_val;
		$app_id = $detail->app_id;
		$overages = $detail->overages;
		$input_type = $detail->input_type;
		$input_val = $detail->input_val;
		$field_type = $detail->field_type;
		
		if($_POST)
		{
			$field_name = $this->input->post('field_name');
			$condition_val = $this->input->post('condition_val');
			$app_id = $this->input->post('app_id');
			$overages = $this->input->post('overages');
			$input_type = $this->input->post('input_type');
			$input_val = $this->input->post('input_val');
			$field_type = $this->input->post('field_type');

			$this->form_validation->set_rules('field_name','Field Name','trim|required');
			$this->form_validation->set_rules('condition_val','Condition value','trim|required');
			$this->form_validation->set_rules('app_id','App','trim|required');
			$this->form_validation->set_rules('overages','Overages','trim|required');
			$this->form_validation->set_rules('input_type','Input Type','trim|required');
			if($this->input->post('input_type')=='select')
			$this->form_validation->set_rules('input_val','Input Value','trim|required');
			$this->form_validation->set_rules('field_type','Field Type','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Package_field_Model->updateRecord($id);
			   $this->session->set_userdata('success_msg','Package Fields Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-package-fields');
			 }
			 
		}
		
		$output['field_name'] = $field_name;
		$output['condition_val'] = $condition_val;
		$output['app_id'] = $app_id;
		$output['overages'] = $overages;
		$output['input_type'] = $input_type;
		$output['field_type'] = $field_type;
		$output['page_title'] = 'Edit Package Field';
        $output['appList'] = $this->Package_Model->getAppList();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/package_field/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function deleteRecord($id) {
	
	   $output['manager_id'] = $manager_id = 14;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Package_field_Model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Package Field Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-package-fields');
	}
	function changeStatus($task,$id) {
	
	   $output['manager_id'] = $manager_id = 14;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Package_field_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Package Field Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-package-fields');
	}
}