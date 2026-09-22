<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting_controller extends CI_controller {

	public function __construct()
	{
		parent::__construct();
		$this->adminFolderName = $this->config->item('adminFolderName');
		$this->load->model($this->adminFolderName."/setting_model");
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
	}
	
	public function index(){
		//die('index');
		$output = array();


		$output['data'] = $this->setting_model->getAllRecord();
		//echo "<pre>"; print_r($output); exit;
		$this->load->view($this->adminFolderName.'/header');
		$this->load->view($this->adminFolderName.'/setting/setting_list', $output);
		$this->load->view($this->adminFolderName.'/footer');
	}
	
	
	public function create_setting(){
		$output = array();

		
		 // echo"<pre>"; print_r($_POST); die;

				
		$this->form_validation->set_rules('title','Title','trim|required');
		//$this->form_validation->set_rules('value','Value','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		//$this->form_validation->set_rules('placeholder','Placeholder','trim|required');
		

		if($this->form_validation->run())
		{
			$data['form'] = array(
					'title' => $this->input->post('title'),
					'value'	 => $this->input->post('value'),
					'type'	 => $this->input->post('type'),
					'placeholder'	 => $this->input->post('placeholder'),
					);
			$this->setting_model->addRecord($data['form']);
			$this->session->set_userdata('success_msg','Setting Created Successfully');
			redirect($this->config->item('adminName').'/settings');
		} 
			 
		
		$this->load->view($this->config->item('adminFolderName').'/header');
		$this->load->view($this->config->item('adminFolderName').'/setting/create_setting');
		$this->load->view($this->config->item('adminFolderName').'/footer');
		
	}
	
	
	public function edit($id)
	{
		$output['detail'] = $this->setting_model->getRecordDetail($id);
		
		if($_POST)
		{
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('value','Value','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		$this->form_validation->set_rules('placeholder','Placeholder','trim|required');
			
			if($this->form_validation->run())
			 {
				$data['form'] = array(
					'title' => $this->input->post('title'),
					'value'	 => $this->input->post('value'),
					'type'	 => $this->input->post('type'),
					'placeholder'	 => $this->input->post('placeholder'),
					//'modified'	 => time()
					);
					
					
			   $this->setting_model->updateRecord($id, $data['form']);			   
			   $this->session->set_userdata('success_msg','Setting Updated Successfully');
			   redirect($this->config->item('adminName').'/settings');
			 }
			 
		}
		
		$output['page_title'] = 'Edit FAQ';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/setting/edit', $output);
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	
	function delete($id) 
	{
	   $this->setting_model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Setting Deleted Successfully');
	   redirect($this->config->item('adminName').'/settings');
	}
	
	
}
