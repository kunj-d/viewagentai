<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Package_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 13;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$list = $this->Package_Model->getPackageList();
		 for($i=0;isset($list[$i]);$i++) {
		   $list[$i]->apps_name = $this->Package_Model->getAppName($list[$i]->app_ids);
		 }
		$output['list'] = $list;
		
		$output['active'] = $this->Package_Model->getAllCount('active');
		$output['inactive'] = $this->Package_Model->getAllCount('inactive');
		$output['total'] = $this->Package_Model->getAllCount();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 13;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$user_id = $this->input->post('user_id');
		$output['detail'] = $detail = $this->Package_Model->getPackageDetail($user_id);
		
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/package/view_package',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function createPackage()
	{
		
		$output['manager_id'] = $manager_id = 12;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		
		if($_POST)
		{
			  //echo '<pre>';
			 // print_r($_POST); die;
			   $this->Package_Model->addPackage();
			   $this->session->set_userdata('success_msg','Package Created Successfully');
			   redirect($this->config->item('adminName').'/manage-packages');
			 
		}
		
		$output['page_title'] = 'Add New Package';
		$output['page_type'] = 'edit';
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function editPackage($id)
	{
		$output['manager_id'] = $manager_id = 13;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['detail'] = $this->Package_Model->getPackageDetail($id);
		
		if($_POST)
		{
			
			if($this->form_validation->run())
			 {
			   $this->Package_Model->updateUser($user_id);
			   $this->session->set_userdata('success_msg','Package Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-packages');
			 }
			 
		}
		
		$output['page_type'] = 'edit';
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function deletePackage($user_id) {
	
	   $output['manager_id'] = $manager_id = 13;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Package_Model->deletePackage($user_id);
	   $this->session->set_userdata('success_msg','Package Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-packages');
	}
	function changeStatus($task,$user_id) {
	
	   $output['manager_id'] = $manager_id = 13;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Package_Model->set_status($task,$user_id);
	   $this->session->set_userdata('success_msg','Package Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-packages');
	}
	function getAppFields(){
	 
	  $output['app_id'] = $app_id = $this->input->post('app_id');
	  $output['step_number'] = $step_number = $this->input->post('step_number');
	  
	  if($step_number==1)
	  {
		$output['appList'] = $this->Package_Model->getAppList();
	  } 
	  else if($step_number==2) {

	    $app_ids = $this->Package_Model->getAppids($app_id);
		for($i=0;isset($app_ids[$i]);$i++) {
		   $app_ids[$i]->fieldList = $this->Package_Model->getAppFieldsList($app_ids[$i]->id);
		 }
		 
	    $output['app_ids'] = $app_ids;
	  }
	  else if($step_number==3) {
	    $output['feature_plans'] = $this->Package_Model->getFeaturePlanList();
	  }
	  else if($step_number==4) {
	    
		$output['alldata'] = $this->convert_formdata($_POST);
		
	  }
	  $this->load->view($this->config->item('adminFolderName').'/package/get_step_data',$output);
	}
	function convert_formdata($input) {    
    $output = array();
    foreach($input['formdata'] as $data) {
        $keys = preg_split("#[\[\]]+#", $data['name']);
        $value = $data['value'];
        $target = &$output;
        foreach($keys as $key) {
            // Get index for "[]" reference
            if ($key == '') $key = count($target);
            // Create the key in the parent array if not there yet
            if (!isset($target[$key])) $target[$key] = array();
            // Move pointer one level down the hierarchy
            $target = &$target[$key];
        }
        // Write the value at the pointer location
        $target = $value;
    }
    return $output;
}
}