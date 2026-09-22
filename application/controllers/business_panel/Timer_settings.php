<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Timer_settings extends CI_Controller {
	function __construct()
	{ 
	    parent::__construct();	
		$this->load->model($this->config->item('adminFolderName').'/SiteSettings');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->model($this->config->item('adminFolderName').'/Timer_manager_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function index()
	{
		
		$output['page_title'] = 'Timer Settings';
		$output['manager_id'] = $manager_id = 60;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');		
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		$output['keyword'] = $keyword = $this->input->get('keyword');		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-timer-settings/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Timer_manager_Model->getAllCount($keyword);
		$config['page_query_string'] = TRUE;		
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
		
		$output['paging']=$this->pagination->create_links();
		$output['total'] = $this->Timer_manager_Model->getAllCount($keyword);
		$output['list'] = $this->Timer_manager_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/timer-settings/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}

	public function create()
	{
		$output['page_title'] = 'Timer Settings';
		if ($_POST) {	
			$title = $this->input->post('title');			
            $this->form_validation->set_rules('title','Title','trim|required');			
				if ($this->form_validation->run()) {
					$this->Timer_manager_Model->addTimer();					
				//	$this->Color_themes_manager_model->addPlanColor($id);					
					$this->session->set_userdata('success_msg','Timer Created Successfully');
					redirect($this->config->item('adminName').'/manage-timer-settings');		
				}
		}
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/timer-settings/index');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}

	public function view()
	{
		$output['manager_id'] = $manager_id = 60;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		$id = $this->input->post('id');
		$output['detail'] = $this->Timer_manager_Model->getTimerDetail($id);	
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/template_manager/view',$output,true);		
		$response['success'] = true;
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($response));
	} 
	public function edit($id)
	{	
		$output['manager_id'] = $manager_id = 60;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');
		$details = $this->Timer_manager_Model->getTimerDetail($id);
		$output["edit_detail"] = $details;
		$output['page_title'] = $details->title;				
		$time = date("H:i", $details->enddate);		
		$output['edit_detail']->endtime = explode(":", $time);		
		
		if ($_POST) {
			$title = $this->input->post('title');
			$this->form_validation->set_rules('title','Title','trim|required');
			if ($this->form_validation->run()) {
				$this->Timer_manager_Model->updateRecord($id);			
				$this->session->set_userdata('success_msg','Timer Created Successfully');
				redirect($this->config->item('adminName').'/manage-timer-settings');		
			}
		}		
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/timer-settings/index');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function delete($id)
	{
		$output['manager_id'] = $manager_id = 60;	   
	   	$this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');
	   	$this->Timer_manager_Model->deleteRecord($id);
	   	$this->session->set_userdata('success_msg','Timer Deleted Successfully');
	   	redirect($this->config->item('adminName').'/manage-timer-settings');
	}
}