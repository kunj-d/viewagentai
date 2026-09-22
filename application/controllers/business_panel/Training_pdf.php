<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_pdf extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Training_pdf_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings by tm
		
	}
	public function index()
	{
		
		 $output['manager_id'] = $manager_id = 39;
		 $this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		 $output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		 $output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		 $output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		 $output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-training-pdf/?keyword='.$keyword);
		$config['per_page'] = (int)$this->config->item("Reading_records_per_page"); //from site settings
		$config['total_rows'] = $this->Training_pdf_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->Training_pdf_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->Training_pdf_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Training_pdf_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Training_pdf_Model->getAllCount('',$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_pdf/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		 $output['manager_id'] = $manager_id = 39;
		 $this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		
		$output['detail'] = $this->Training_pdf_Model->getRecordDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/training_pdf/view',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function create()
	{
		
		$output['manager_id'] = $manager_id = 39;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$output['categories'] = $this->Training_pdf_Model->getCategoryList();
		
		if($_POST)
		{
			$training_pdf_category_id = $this->input->post('training_pdf_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$type = $this->input->post('type');
			$sort_order = $this->input->post('sort_order');
			$this->form_validation->set_rules('training_pdf_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
		 	if($_FILES['pdf_file']['name']=='')
			$this->form_validation->set_rules('pdf_file','Pdf File','trim|required');
			 
			
			if($this->form_validation->run())
			 {
					if($_FILES['pdf_file']['name']!='')
			    { 
				   $config['upload_path'] = './assets/uploads/training_pdf/';
				   $config['allowed_types'] = 'pdf';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('pdf_file'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			    }
				 if($img_error=='') 
				  {
				    $this->Training_pdf_Model->addRecord($data['upload_data']['file_name']);
				    $this->session->set_userdata('success_msg','Pdf Created Successfully');
				    redirect($this->config->item('adminName').'/manage-training-pdf');
				  }
				  
			 }
		}
		
		$output['training_pdf_category_id'] = $training_pdf_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['sort_order'] = $sort_order;
		$output['page_title'] = 'Add New Pdf';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_pdf/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id)
	{
		 $output['manager_id'] = $manager_id = 39;
		 $this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$output['categories'] = $this->Training_pdf_Model->getCategoryList();

		$detail = $this->Training_pdf_Model->getRecordDetail($id);
		$training_pdf_category_id = $detail->training_pdf_category_id;
		$title = $detail->title;
		$slug = $detail->slug;
		$sort_order = $detail->sort_order;
		if($_POST)
		{
			$training_pdf_category_id = $this->input->post('training_pdf_category_id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$url = $this->input->post('url');
			$sort_order = $this->input->post('sort_order');

			$this->form_validation->set_rules('training_pdf_category_id','Category','trim|required');
		    $this->form_validation->set_rules('title','Title','trim|required');
		    $this->form_validation->set_rules('slug','Slug','trim|required');
			 
			
			if($this->form_validation->run())
			 {
			   if($_FILES['pdf_file']['name']!='')
			    { 
				   $config['upload_path'] = './assets/uploads/training_pdf/';
				   $config['allowed_types'] = 'pdf';
				   $this->load->library('upload', $config);				
				   if(!$this->upload->do_upload('pdf_file'))
				   {	
					  $output['img_error'] = $img_error = $this->upload->display_errors();	
					} else {
					  $data = array('upload_data' => $this->upload->data());									
				   }
			   }
			   
			   if($img_error=='')
			    {
				   $this->Training_pdf_Model->updateRecord($id,$data['upload_data']['file_name']);
				   $this->session->set_userdata('success_msg','Training Pdf Updated Successfully');
				   redirect($this->config->item('adminName').'/manage-training-pdf');
				}
			   
			 }
			 
		}
		
		$output['training_pdf_category_id'] = $training_pdf_category_id;
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['sort_order'] = $sort_order;
		$output['page_title'] = 'Edit Pdf';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/training_pdf/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function delete($id) 
	{
	
	    $output['manager_id'] = $manager_id = 39;
	    $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Training_pdf_Model->deleteRecord($id);

	   $this->session->set_userdata('success_msg','Pdf Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-training-pdf');
	}
	function changeStatus($task,$id) 
	{
	
	    $output['manager_id'] = $manager_id = 39;
	    $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Training_pdf_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Pdf Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-training-pdf');
	}
	function valid_url_format(){
		$str = $this->input->post('url');
		$pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)){
			 // $this->form_validation->set_message('valid_url_format','');
		   $this->form_validation->set_message('valid_url_format', 'The URL you entered is not accessible.');
           return FALSE;
        }
 
        return TRUE;
    }       
 
}