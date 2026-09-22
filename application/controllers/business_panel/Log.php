<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	
	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Log_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings by tm
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 30;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-log/?keyword='.$keyword);
		$config['per_page'] = (int)$this->config->item("Reading_records_per_page"); //from site settings
		$config['total_rows'] = $this->Log_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Log_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Log_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Log_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Log_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/log/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 30;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Log_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/log/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
		public function create()
	{
		
		$output['manager_id'] = $manager_id = 29;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['categories'] = $this->Log_Model->getCategoryList();
		
		if($_POST)
		{
			$faq_category_id = $this->input->post('faq_category_id');
			$log_title = $this->input->post('log_title');
			 
			$description = $this->input->post('description');

			$this->form_validation->set_rules('faq_category_id','Category','trim|required');
		    $this->form_validation->set_rules('type','Type','trim|required');
		    $this->form_validation->set_rules('log_title','Log Title','trim|required');
			$this->form_validation->set_rules('answers','Answer','trim|required');
			if($this->form_validation->run())
			 {
				 $this->Log_Model->addRecord();
				 $this->session->set_userdata('success_msg','Log Created Successfully');
				 redirect($this->config->item('adminName').'/manage-log');
			 }
		}
		
		$output['faq_category_id'] = $faq_category_id;
		$output['description'] = $description;
		$output['page_title'] = 'Add New Log';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/log/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 30;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['categories'] = $this->Log_Model->getCategoryList();

		$detail = $this->Log_Model->getRecordDetail($id);
		 
		$faq_category_id = $detail->version_id;
		$answers = $detail->description;
		$type = $detail->type;
		$log_title = $detail->log_title;
		
		if($_POST)
		{
			$faq_category_id = $this->input->post('faq_category_id');
			$description = $this->input->post('description');
			$type = $this->input->post('type');
			$log_title = $this->input->post('log_title');
			

			$this->form_validation->set_rules('faq_category_id','Category','trim|required');
		    $this->form_validation->set_rules('answers','Description','trim|required');
		    $this->form_validation->set_rules('type','Type','trim|required');
		    $this->form_validation->set_rules('log_title','Log Title','trim|required');
			
			if($this->form_validation->run())
			 {
				$this->Log_Model->updateRecord($id);
			    $this->session->set_userdata('success_msg','LOG Updated Successfully');
			    redirect($this->config->item('adminName').'/manage-log');
			 }
			 
		}
		
		$output['faq_category_id'] = $faq_category_id;
		 
		$output['answers'] = $answers;
		$output['type'] = $type;
		$output['log_title'] = $log_title;
		 
		 
		$output['faq_id'] = $id;
		$output['page_title'] = 'Edit Log';
		

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/log/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 30;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Log_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','LOG Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-log');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 30;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Log_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','LOG Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-log');
	}
	 

}