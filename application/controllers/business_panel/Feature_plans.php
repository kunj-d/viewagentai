<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_plans extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Feature_plan_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 16;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['add_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$list = $this->Feature_plan_Model->getRecordList();
		for($i=0;isset($list[$i]);$i++) {
		  $feature_ids = unserialize($list[$i]->feature_ids);
		  $list[$i]->feature_list = $this->Feature_plan_Model->getfeaturesbyId($feature_ids);
		}
		$output['list'] = $list;
		$output['active'] = $this->Feature_plan_Model->getAllCount('active');
		$output['inactive'] = $this->Feature_plan_Model->getAllCount('inactive');
		$output['total'] = $this->Feature_plan_Model->getAllCount();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature_plan/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 16;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['plan_name'] = $this->input->post('plan_name');
		$output['feature_ids'] = $this->input->post('feature_ids');
		
		if($_POST)
		{
			  
			$this->form_validation->set_rules('plan_name','Plan Name','trim|required');
			$this->form_validation->set_rules('feature_ids[]','Feature','trim|required');

			if($this->form_validation->run())
			 {
			   $this->Feature_plan_Model->addRecord();
			   $this->session->set_userdata('success_msg','Feature Plan Created Successfully');
			   redirect($this->config->item('adminName').'/manage-feature-plans');
			 }
		}
		
		$output['page_title'] = 'Add New Feature Plan';
        $output['page_name'] = 'add';
		$appList = $this->Feature_plan_Model->getfeatureApps();
		for($i=0;isset($appList[$i]);$i++) {
		   $appList[$i]->feature_list = $this->Feature_plan_Model->getfeaturebyAppId($appList[$i]->app_id);
		 }
		$output['appList'] = $appList;
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature_plan/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 16;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$detail = $this->Feature_plan_Model->getRecordDetail($id);
		$plan_name = $detail->plan_name;
		$feature_ids = unserialize($detail->feature_ids);
		
		if($_POST)
		{
			$plan_name = $this->input->post('plan_name');
			$feature_ids = $this->input->post('feature_ids');

			$this->form_validation->set_rules('plan_name','Plan Name','trim|required');
			$this->form_validation->set_rules('feature_ids[]','Features','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Feature_plan_Model->updateRecord($id);
			   $this->session->set_userdata('success_msg','Feature Plan Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-feature-plans');
			 }
			 
		}
		$appList = $this->Feature_plan_Model->getfeatureApps();
		for($i=0;isset($appList[$i]);$i++) {
		   $appList[$i]->feature_list = $this->Feature_plan_Model->getfeaturebyAppId($appList[$i]->app_id);
		 }
		$output['appList'] = $appList;
		$output['plan_name'] = $plan_name;
		$output['feature_ids'] = $feature_ids;
		$output['page_title'] = 'Edit Feature Plan';
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/feature_plan/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function deleteRecord($id) {
	
	   $output['manager_id'] = $manager_id = 16;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Feature_plan_Model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Feature Plan Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-feature-plans');
	}
	function changeStatus($task,$id) {
	
	   $output['manager_id'] = $manager_id = 16;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Feature_plan_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Feature Plan Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-feature-plans');
	}
}