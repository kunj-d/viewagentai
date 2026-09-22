<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Faq_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
		
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
		$output['faq_id'] = $faq_id = $this->input->get('faq_id');
		$output['date_type'] = $date_type = $this->input->get('date_type');
		$output['start_date'] = $start_date = $this->input->get('start_date');
		$output['end_date'] = $end_date = $this->input->get('end_date');
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-faq/?keyword='.$keyword.'&faq_id='.$faq_id.'&date_type='.$date_type.'&start_date='.$start_date.'&end_date='.$end_date);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Faq_Model->getAllCount('',$keyword,$faq_id,$start_date,$end_date,$date_type);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Faq_Model->getRecordList($keyword,$config['per_page'],$currentpage,$faq_id,$start_date,$end_date,$date_type);
		$output['categories'] = $this->Faq_Model->getCategoryList();
		$output['active'] = $this->Faq_Model->getAllCount('active',$keyword,$faq_id,$start_date,$end_date,$date_type);
		$output['inactive'] = $this->Faq_Model->getAllCount('inactive',$keyword,$faq_id,$start_date,$end_date,$date_type);
		$output['total'] = $this->Faq_Model->getAllCount('',$keyword,$faq_id,$start_date,$end_date,$date_type);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/faq/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 30;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Faq_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/faq/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 29;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['categories'] = $this->Faq_Model->getCategoryList();
		
		if($_POST)
		{
			$faq_category_id = $this->input->post('faq_category_id');
			$question = $this->input->post('question');
			$slug = $this->input->post('slug');
			$answers = $this->input->post('answers');

			$this->form_validation->set_rules('faq_category_id','Category','trim|required');
		    $this->form_validation->set_rules('question','Question','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('answers','Answer','trim|required');
			
			if($this->form_validation->run())
			 {
				   $this->Faq_Model->addRecord();
				   $this->session->set_userdata('success_msg','FAQ Created Successfully');
				   redirect($this->config->item('adminName').'/manage-faq');
			 }
		}
		
		$output['faq_category_id'] = $faq_category_id;
		$output['question'] = $question;
		$output['slug'] = $slug;
		$output['answers'] = $answers;
		$output['page_title'] = 'Add New FAQ';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/faq/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		$output['manager_id'] = $manager_id = 30;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['categories'] = $this->Faq_Model->getCategoryList();

		$detail = $this->Faq_Model->getRecordDetail($id);
		$faq_category_id = $detail->faq_category_id;
		$question = $detail->question;
		$slug = $detail->slug;
		$answers = $detail->answers;
		
		if($_POST)
		{
			$faq_category_id = $this->input->post('faq_category_id');
			$question = $this->input->post('question');
			$slug = $this->input->post('slug');
			$answers = $this->input->post('answers');

			$this->form_validation->set_rules('faq_category_id','Category','trim|required');
		    $this->form_validation->set_rules('question','Question','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			$this->form_validation->set_rules('answers','Answer','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->Faq_Model->updateRecord($id);
			   
			   $this->session->set_userdata('success_msg','FAQ Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-faq');
			 }
			 
		}
		
		$output['faq_category_id'] = $faq_category_id;
		$output['question'] = $question;
		$output['slug'] = $slug;
		$output['answers'] = $answers;
		$output['page_title'] = 'Edit FAQ';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/faq/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	   $output['manager_id'] = $manager_id = 30;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Faq_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','FAQ Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-faq');
	}
	function changeStatus($task,$id) 
	{
	
	   $output['manager_id'] = $manager_id = 30;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Faq_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','FAQ Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-faq');
	}
}