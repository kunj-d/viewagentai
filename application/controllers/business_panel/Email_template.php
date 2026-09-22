<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Email_template_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-email-template/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Email_template_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Email_template_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Email_template_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Email_template_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Email_template_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/email_template/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function view()
	{
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Email_template_Model->getTemplateDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/email_template/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 23;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		$output['emailTypeList'] = $this->Email_template_Model->getEmailTypeList();
		
		if($_POST)
		{
			$email_type = $this->input->post('email_type');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$subject = $this->input->post('subject');
			$description = $this->input->post('description');
			$message = $this->input->post('message');

			$this->form_validation->set_rules('email_type','Email Type','trim|required|is_unique[tbl_email_templates.email_type]');
			$this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('subject','Subject','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');
			$this->form_validation->set_rules('message','Message','trim|required');
			
			if($this->form_validation->run())
			 {
				   $this->Email_template_Model->addTemplate();
				   $this->session->set_userdata('success_msg','Template Created Successfully');
				   redirect($this->config->item('adminName').'/manage-email-template');
			 }
		}
		
		$output['email_type'] = $email_type;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['subject'] = $subject;
		$output['description'] = $description;
		$output['message'] = $message;
		$output['page_title'] = 'Add New Template';
		
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/email_template/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');
		$output['emailTypeList'] = $this->Email_template_Model->getEmailTypeList();

		$detail = $this->Email_template_Model->getTemplateDetail($id);
		$email_type = $detail->email_type;
		$title = $detail->title;
		$slug = $detail->slug;
		$subject = $detail->subject;
		$description = $detail->description;
		$message = $detail->message;
		
		if($_POST)
		{
			$email_type= $this->input->post('email_type');
			$title= $this->input->post('title');
			$slug = $this->input->post('slug');
			$subject = $this->input->post('subject');
			$description = $this->input->post('description');
			$message = $this->input->post('message');
            
			if($detail->email_type==$this->input->post('email_type'))
			 {
		     	$this->form_validation->set_rules('email_type','Email Type','trim|required');
			} else {
			   $this->form_validation->set_rules('email_type','Email Type','trim|required|is_unique[tbl_email_templates.email_type]');
			 }
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('subject','Subject','trim|required');
			$this->form_validation->set_rules('description','Description','trim|required');
			$this->form_validation->set_rules('message','Message','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Email_template_Model->updateTemplate($id);
			   
			   $this->session->set_userdata('success_msg','Template Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-email-template');
			 }
			 
		}
		
		$output['email_type'] = $email_type;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['subject'] = $subject;
		$output['description'] = $description;
		$output['message'] = $message;
		$output['page_title'] = 'Edit Template';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/email_template/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 24;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Email_template_Model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Template Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-email-template');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 24;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Email_template_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Template Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-email-template');
	}
}