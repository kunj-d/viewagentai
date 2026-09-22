<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socialresponder extends CI_Controller {
	

	function __construct()
	{ 
	    parent::__construct();
		$this->Common_Modal->checkSagPanelLogin();
		$this->Common_Modal->load();
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->model($this->config->item('adminFolderName').'/Socialresponder_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
	}
	public function index()
	{	
		

		$output['manager_id'] = $manager_id = 45;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-socialresponder/?keyword='.$keyword);
		$config['per_page'] = 10;
		$output['keyword'] = $keyword = $this->input->get('keyword');
		$config['total_rows'] = $this->Socialresponder_Model->allCount('',$keyword);		
		$config['page_query_string'] = TRUE;

	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
	   
		$output['active'] = $this->Socialresponder_Model->allCount('1',$keyword); 		

		$output['inactive'] = $this->Socialresponder_Model->inactiveCount('0',$keyword);
		$output['total'] = $this->Socialresponder_Model->allCount('',$keyword);	
       

		$output['autoresponder_list'] = $this->Socialresponder_Model->getRecords($keyword,$config['per_page'],$currentpage);
		
		$output['autoresponder_fields']=$this->Socialresponder_Model->getCredentialFields();
		
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/autoresponder/social_list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function create(){
		
		$output['manager_id'] = $manager_id = 43;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$display_title = $this->input->post('display_title');
		$title = $this->input->post('title');
		$responder_status = $this->input->post('responder_status');
		$credential_title = $this->input->post('credential_title');
		$credential_array=array();
		if($_POST)
		{
			$logo_url="";
			$this->form_validation->set_rules('display_title','Display Title','trim|required');
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('responder_logo','Logo','callback_check_responder_logo');
			$this->form_validation->set_rules('credential_title[]','Credential Title','trim|required');
			$this->form_validation->set_rules('credential_name[]','Credential Name','trim|required');
			$this->form_validation->set_rules('responder_status','Status','required');
			if ($this->form_validation->run() == FALSE){
				foreach($credential_title as $tr=>$credential)
				{
					$credential_data=array(
						'display_title'=>$this->input->post('credential_title')[$tr],
						'field_name'=>strtolower($this->input->post('credential_name')[$tr]),
						'default_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'field_type'=>$this->input->post('credential_type')[$tr]
						);
					array_push($credential_array,$credential_data);
				}
				$credential=json_encode($credential_array);
			}
			else{
				if($_FILES['responder_logo']['name']!=''){ 
					$config['upload_path'] = $this->config->item('autoresponder_logo');
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$extention = pathinfo($_FILES['responder_logo']['name'], PATHINFO_EXTENSION);
					$logo_image=time().".".$extention;
					$config['file_name'] = $logo_image;
					$user_image_file="";
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('responder_logo')){
						$img_error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $img_error);
					} 
					else {
						$image_data = array('upload_data' => $this->upload->data());
						$logo_url=$this->config->item('base_url').'assets/uploads/autoresponder_logo/'.$logo_image;						
					}
				}
				$insert_data = array(
					'display_title'=>$display_title,
					'title' => strtolower($title),
					'logo' => $logo_url,
					'status'=>$responder_status
					);
				$social_profile_id=$this->Socialresponder_Model->addResponder($insert_data);
				foreach($credential_title as $tr=>$credential)
				{
					$field_data=array(
						'social_profile_id'=>$social_profile_id,
						'display_title'=>$this->input->post('credential_title')[$tr],
						'field_name'=>strtolower($this->input->post('credential_name')[$tr]),
						'default_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'field_type'=>$this->input->post('credential_type')[$tr]
						);
					$this->Socialresponder_Model->addResponderFields($field_data);
				}
				$this->session->set_flashdata('success', 'Record saved successfully');
				redirect($this->config->item('adminName').'/create-socialresponder');
			}
		}
		else
		{ 
			$credential_data=array(
				'display_title'=>'',
				'field_name'=>'',
				'default_value'=>'',
				'placeholder'=>'',
				'field_type'=>''
				);
			array_push($credential_array,$credential_data);
			$credential=json_encode($credential_array);
		}
		$output['display_title'] = $display_title;
		$output['title'] = $title;
		$output['credential_detail'] = $credential;
		$output['responder_status'] = $responder_status;
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/autoresponder/social_add');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function check_responder_logo(){
		if($_FILES['responder_logo']['name']==''){
			$this->form_validation->set_message('check_responder_logo', 'The Responder Logo field is required');
			return FALSE;
		}
	}
	
	public function changeStatus($action,$id){
		
		$output['manager_id'] = $manager_id = 45;
		$this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');
		
		$this->Socialresponder_Model->SetStatus($action,$id);
		$this->session->set_userdata('success_msg','Auto Responder Status changed Successfully');
		redirect($this->config->item('adminName').'/manage-socialresponder');
	}
	
	public function deleteRecord($id){
		
		$output['manager_id'] = $manager_id = 45;
		$this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

		$logo_url=$this->Socialresponder_Model->GetRecordDetail($id)->logo;
		$this->Socialresponder_Model->deleteAutoresponder($id);
		$unlink_logo=end(explode("/",$logo_url));
		unlink($this->config->item('autoresponder_logo').$unlink_logo);
		redirect($this->config->item('adminName').'/manage-socialresponder');
	}
	
	public function viewRecord(){
		
		$output['manager_id'] = $manager_id = 45;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');

		$id = $this->input->post('id');
		$output['detail'] = $this->Socialresponder_Model->GetRecordDetail($id);
		$output['autoresponder_fields']=$this->Socialresponder_Model->getCredentialFieldsDetail($id);
		$response['html'] =$this->load->view($this->config->item('adminFolderName').'/autoresponder/view',$output,true);		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	
	public function editRecord($id){
		
		$output['manager_id'] = $manager_id = 45;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		if($this->Socialresponder_Model->GetRecordDetail($id)){
			$output['get_detail']=$this->Socialresponder_Model->GetRecordDetail($id);
			$output['autoresponder_fields']=$this->Socialresponder_Model->getCredentialFieldsDetail($id);
		}
		else
		{
			redirect($this->config->item('adminName').'/manage-socialresponder');
		}
		$credential_title = $this->input->post('credential_title');
		if($_POST)
		{
			$logo_url=$output['get_detail']->logo;
			$display_title = $this->input->post('display_title');
			$title = $this->input->post('title');
			$responder_status = $this->input->post('responder_status');
			$this->form_validation->set_rules('display_title','Display Title','trim|required');
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('credential_title[]','Credential Title','trim|required');
			$this->form_validation->set_rules('credential_name[]','Credential Name','trim|required');
			$this->form_validation->set_rules('responder_status','Status','required');
			if ($this->form_validation->run() == FALSE){
			
			}
			else{
				if($_FILES['responder_logo']['name']!=''){ 
					$config['upload_path'] = $this->config->item('autoresponder_logo');
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$extention = pathinfo($_FILES['responder_logo']['name'], PATHINFO_EXTENSION);
					$logo_image=time().".".$extention;
					$config['file_name'] = $logo_image;
					$user_image_file="";
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('responder_logo')){
						$img_error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $img_error);
					} 
					else {
						$unlink_logo=end(explode("/",$logo_url));
						unlink($this->config->item('autoresponder_logo').$unlink_logo);
						$img_data = array('upload_data' => $this->upload->data());
						$logo_url=$this->config->item('base_url').'assets/uploads/autoresponder_logo/'.$logo_image;						
					}
				}
				$update_data = array(
					'display_title'=>$display_title,
					'title' => strtolower($title),
					'logo' => $logo_url,
					'status'=>$responder_status
					);	
					$this->Socialresponder_Model->deleteAutoresponderFields($id);		
				foreach($credential_title as $tr=>$credential)
				{
						$field_data=array(
						'social_profile_id'=>$id,
						'display_title'=>$this->input->post('credential_title')[$tr],
						'field_name'=>strtolower($this->input->post('credential_name')[$tr]),
						'default_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'field_type'=>$this->input->post('credential_type')[$tr]
						);												
						$this->Socialresponder_Model->addResponderFields($field_data);
				}
				$this->Socialresponder_Model->editResponder($update_data,$id);
				$this->session->set_flashdata('success', 'Record update successfully');
				redirect($this->config->item('adminName').'/edit-socialresponder/'.$id);
			}
		}
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/autoresponder/social_edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
}