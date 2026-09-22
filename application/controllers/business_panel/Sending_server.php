<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sending_server extends CI_Controller {
	

	function __construct()
	{ 
	    parent::__construct();
		$this->Common_Modal->checkSagPanelLogin();
		$this->Common_Modal->load();
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->model($this->config->item('adminFolderName').'/Sending_server_Model');
		$this->load->library('pagination');
		
	}
	public function index()
	{	
		$output['manager_id'] = $manager_id = 52;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');

		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-Sending_server/?keyword='.$keyword);
		$config['per_page'] = 10;
		$output['keyword'] = $keyword = $this->input->get('keyword');
		$config['total_rows'] = $this->Sending_server_Model->allCount('',$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
	    $output['paging']=$this->pagination->create_links();
		$output['active'] = $this->Sending_server_Model->allCount('active',$keyword);
		$output['inactive'] = $this->Sending_server_Model->allCount('inactive',$keyword);
		$output['total'] = $this->Sending_server_Model->allCount('',$keyword);
		$output['Sending_server_list'] = $this->Sending_server_Model->getRecords($keyword,$config['per_page'],$currentpage);
		$output['Sending_server_fields']=$this->Sending_server_Model->getCredentialFields();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/sending_server/sending_server_list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function create(){
		
		$output['manager_id'] = $manager_id = 51;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$server_name = $this->input->post('server_name');
		$server_type = $this->input->post('server_type');
		$server_status = $this->input->post('server_status');
		$credential_title = $this->input->post('credential_title');
		$credential_array=array();
		if($_POST)
		{
			
			$logo_url="";
			$this->form_validation->set_rules('server_name','Display Name','trim|required');
			
			if ($this->form_validation->run() == FALSE){
				foreach($credential_title as $tr=>$credential)
				{
					$credential_data=array(
						'name'=>$this->input->post('credential_name')[$tr],
						'type'=>strtolower($this->input->post('credential_type')[$tr]),
						'default_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'input_type'=>$this->input->post('credential_input')[$tr]
						);
					array_push($credential_array,$credential_data);
				}
				$credential=json_encode($credential_array);
			}
			else{
			
				$insert_data = array(
					'name'=>$server_name,
					'type' => strtolower($server_type),
					'fields'=>implode(",",$credential_title),
					'created' => time(),
					'modified' => time(),
					'ip' => time(),
					'status'=>$server_status
					);	
				$sending_server_id=$this->Sending_server_Model->addServer($insert_data);
				foreach($credential_title as $tr=>$credential)
				{
					$field_data=array(
						'sending_server_id'=>$sending_server_id,
						'title'=>$this->input->post('credential_title')[$tr],
						'name'=>strtolower($this->input->post('credential_name')[$tr]),
						'field_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'sorting_order'=>$this->input->post('credential_order')[$tr],
						'input_value'=>$this->input->post('credential_options')[$tr],
						'input_type'=>$this->input->post('credential_input')[$tr]
						);
					$this->Sending_server_Model->addServerFields($field_data);
				}
				$this->session->set_userdata('success_msg','Sending Server saved Successfully');
				redirect($this->config->item('adminName').'/manage-sending-server');
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
		$output['page_title'] = "Add New Sending Server";
		$output['server_name'] = $display_title;
		$output['server_type'] = $title;
		$output['credential_detail'] = $credential;
		$output['server_status'] = $server_status;
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/sending_server/add');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function check_responder_logo(){
		if($_FILES['responder_logo']['name']==''){
			$this->form_validation->set_message('check_responder_logo', 'The Responder Logo field is required');
			return FALSE;
		}
	}
	
	public function changeStatus($action,$id){
		
		$output['manager_id'] = $manager_id = 52;
		$this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');
		
		$this->Sending_server_Model->setStatus($action,$id);
		$this->session->set_userdata('success_msg','Sending Server Status changed Successfully');
		redirect($this->config->item('adminName').'/manage-sending-server');
	}
	
	public function deleteRecord($id){
		
		$output['manager_id'] = $manager_id = 52;
		$this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');
		
		$logo_url=$this->Sending_server_Model->getRecordDetail($id)->logo;
		$this->Sending_server_Model->deleteServer($id);
		$unlink_logo=end(explode("/",$logo_url));
		unlink($this->config->item('Sending_server_logo').$unlink_logo);
		redirect($this->config->item('adminName').'/manage-sending-server');
	}
	
	public function viewRecord(){
		
		$output['manager_id'] = $manager_id = 52;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$id = $this->input->post('id');
		$output['detail'] = $this->Sending_server_Model->getRecordDetail($id);
		$output['Sending_server_fields']=$this->Sending_server_Model->getCredentialFieldsDetail($id);
		$response['html'] =$this->load->view($this->config->item('adminFolderName').'/sending_server/view',$output,true);		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	
	public function edit($id){
		
		$output['manager_id'] = $manager_id = 52;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');
		
		if($this->Sending_server_Model->getRecordDetail($id)){
			$output['get_detail']=$this->Sending_server_Model->getRecordDetail($id);
			
			$output['Sending_server_fields']=$this->Sending_server_Model->getCredentialFieldsDetail($id);
			// print_r($output['Sending_server_fields']);
			// die;
		}
		else
		{
			redirect($this->config->item('adminName').'/manage-sending-server');
		}
		$credential_title = $this->input->post('credential_title');
		if($_POST)
		{
			/* echo'<pre>';
			print_r($_POST);
			die;  */
			$server_id = $id;
			$server_name = $this->input->post('server_name');
			$server_type = $this->input->post('server_type');
			$server_status = $this->input->post('server_status');
			$credential_title = $this->input->post('credential_title');
			$logo_url="";
			$this->form_validation->set_rules('server_name','Display Name','trim|required');
			
			if ($this->form_validation->run() == FALSE){
				foreach($credential_title as $tr=>$credential)
				{
					$credential_data=array(
						'name'=>$this->input->post('credential_name')[$tr],
						'type'=>strtolower($this->input->post('credential_type')[$tr]),
						'default_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'input_type'=>$this->input->post('credential_input')[$tr]
						);
					array_push($credential_array,$credential_data);
				}
				$credential=json_encode($credential_array);
			}
			
				$insert_data = array(
					'name'=>$server_name,
					'type' => strtolower($server_type),
					'fields'=>implode(",",$credential_title),
					'created' => time(),
					'modified' => time(),
					'ip' => time(),
					'status'=>$server_status
					);	
				$this->Sending_server_Model->deleteServerFields($server_id);
				$this->Sending_server_Model->editServer($insert_data,$server_id);
				$field_arr = array();
				foreach($credential_title as $tr=>$credential)
				{
					$field_data=array(
						'sending_server_id'=>$server_id,
						'title'=>$this->input->post('credential_title')[$tr],
						'name'=>strtolower($this->input->post('credential_name')[$tr]),
						'field_value'=>$this->input->post('credential_default_value')[$tr],
						'placeholder'=>$this->input->post('credential_placeholder')[$tr],
						'sorting_order'=>$this->input->post('credential_order')[$tr],
						'input_value'=>$this->input->post('credential_options')[$tr],
						'input_type'=>$this->input->post('credential_input')[$tr]
						);
					
						$this->Sending_server_Model->addServerFields($field_data);
					
				}
				$this->session->set_userdata('success_msg','Sending Server Updated Successfully');
				redirect($this->config->item('adminName').'/manage-sending-server');
			
			
		}
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/sending_server/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
}