<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Team_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->Common_Modal->load(); //load site settings
		
	}
	public function index()
	{
		
		$output['manager_id'] = $manager_id = 3;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');

		$output['list'] = $this->Team_Model->getTeamList();
		
		$output['active'] = $this->Team_Model->getAllCount('active');
		$output['inactive'] = $this->Team_Model->getAllCount('inactive');
		$output['total'] = $this->Team_Model->getAllCount(); 
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/team/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function createTeam()
	{
		$output['manager_id'] = $manager_id = 2;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		$allManagers	=	$this->Team_Model->getAllParentManagers();
		for($i=0;isset($allManagers[$i]);$i++)
    	 $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id); // for view page
		
		if($_POST)
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$department = $this->input->post('department');

			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[tbl_sag_user.email]');
			$this->form_validation->set_rules('password','Password','trim|required|matches[confirm_pass]');
			$this->form_validation->set_rules('confirm_pass','Confirm Password','trim|required');
			$this->form_validation->set_rules('phone','Phone','trim|required');
			$this->form_validation->set_rules('department','Department','trim|required');
			if($_FILES['profile_image']['name']=='')
			$this->form_validation->set_rules('profile_image','Profile Image','trim|required');
			$this->form_validation->set_rules('managers[]', 'privileges', 'trim|required'); 
			
			$allowed	=	$this->input->post('managers');
			$permission	=	$this->input->post('permission');
			//echo '<pre>'; print_r($allowed);
			//print_r($permission);
			// die;
			 if( sizeof($allowed) > 0 )
			  {
				for($i=0;isset($allManagers[$i]);$i++) // from above $allManagers
				 {
				   $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id); // for calculation
					$allSubmanagers	=	$allManagers[$i]->subManagers;
					  for($j=0;isset($allSubmanagers[$j]);$j++)
						{
						  if(in_array($allSubmanagers[$j]->mng_id,$allowed))
						   {
							 $allSubmanagers[$j]->selected	=	'yes';
							 $selectArray[] = $allSubmanagers[$j]->parent_id;
						   } else {
							 $allSubmanagers[$j]->selected	=	'no';	
						   }
						}
							$allManagers[$i]->subManagers	=	$allSubmanagers;	
				 }
			  }


			if($this->form_validation->run())
			 {

			   $config['upload_path'] = './assets/'.$this->config->item('adminFolderName').'/uploads/profile_images/';
			   $config['allowed_types'] = 'gif|jpg|png|jpeg';
			   $this->load->library('upload', $config);				
			   if(!$this->upload->do_upload('profile_image'))
			   {	
				  $output['img_error'] = $img_error = $this->upload->display_errors();	
			    } else {
				  $data = array('upload_data' => $this->upload->data());									
			   }
			   if(empty($img_error))
			    {
			      $this->Team_Model->addTeamMember($data['upload_data']['file_name']);
				  $this->session->set_userdata('success_msg','Team Created Successfully');
				  redirect($this->config->item('adminName').'/manage-team');
				}
				
			 }
			 
		}
		
		$output['name'] = $name;
		$output['email'] = $email;
		$output['phone'] = $phone;
		$output['department'] = $department;
		$output['page_title'] = 'Add New Team Member';
        $output['page_name'] = 'add';
		$output['allManagers']	=	$allManagers;
		$output['selectArray'] = array_unique($selectArray);
		$output['permission'] = $permission;
		$output['allowed'] = $allowed;
		

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/team/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function editTeam($id)
	{
		 $output['manager_id'] = $manager_id = 3;
		if($id!=$this->session->userdata('SAG_mem_id'))
		 {
		   $this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');
		 }
		$output['edit_per'] = $edit_per = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$allManagers	=	$this->Team_Model->getAllParentManagers();
		for($i=0;isset($allManagers[$i]);$i++)
    	 $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id);
		$detail = $this->Team_Model->getMemberDetail($id);

		$name = $detail->name;
		$email = $detail->email;
		$phone = $detail->phone;
		$department = $detail->department;
		$allowed = explode(',',$detail->privileges);
		$permission	=	unserialize($detail->permission);
		
		if($_POST)
		{
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$department = $this->input->post('department');
			$allowed	=	$this->input->post('managers');
			$permission	=	$this->input->post('permission');

			$this->form_validation->set_rules('name','Name','trim|required');
			
			if($detail->email==$this->input->post('email'))
			   $this->form_validation->set_rules('email','Email','trim|required|valid_email');
			else 
			   $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[tbl_sag_user.email]');

			$this->form_validation->set_rules('phone','Phone','trim|required');
			$this->form_validation->set_rules('department','Department','trim|required');
			if($edit_per=='yes')
			$this->form_validation->set_rules('managers[]', 'privileges', 'trim|required');
			
			if($this->form_validation->run())
			 {
			   
			   $config['upload_path'] = './assets/'.$this->config->item('adminFolderName').'/uploads/profile_images/';
			   $config['allowed_types'] = 'gif|jpg|png|jpeg';
			   $this->load->library('upload', $config);				
			   if(!$this->upload->do_upload('profile_image'))
			   {	
				  $output['img_error'] = $img_error = $this->upload->display_errors();	
			    } else {
				  $data = array('upload_data' => $this->upload->data());									
			   }
			   $this->Team_Model->updateTeamMember($id,$data['upload_data']['file_name']);
			   $this->session->set_userdata('success_msg','Team Updated Successfully');
			    if($edit_per=='yes')
			   redirect($this->config->item('adminName').'/manage-team');
			   else
			   redirect($this->config->item('adminName').'/edit-team/'.$id);
			 }
		}
		
		
			 if( sizeof($allowed) > 0 )
			  {
				for($i=0;isset($allManagers[$i]);$i++)
				 {
				   $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id);
					$allSubmanagers	=	$allManagers[$i]->subManagers;
					  for($j=0;isset($allSubmanagers[$j]);$j++)
						{
						  if(in_array($allSubmanagers[$j]->mng_id,$allowed))
						   {
							 $allSubmanagers[$j]->selected	=	'yes';
							 $selectArray[] = $allSubmanagers[$j]->parent_id;
						   } else {
							 $allSubmanagers[$j]->selected	=	'no';	
						   }
						}
							$allManagers[$i]->subManagers	=	$allSubmanagers;	
				 }
			  }

		
		$output['name'] = $name;
		$output['email'] = $email;
		$output['phone'] = $phone;
		$output['department'] = $department;
		$output['page_title'] = 'Edit Team Member';
		$output['allManagers']	=	$allManagers;
		$output['selectArray'] = array_unique($selectArray);
		$output['permission'] = $permission;
		$output['allowed'] = $allowed;

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/team/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 3;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$allManagers	=	$this->Team_Model->getAllParentManagers();
		for($i=0;isset($allManagers[$i]);$i++)
    	 $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id);

		$id = $this->input->post('id');
		$output['detail'] = $detail = $this->Team_Model->getMemberDetail($id);
		$allowed = explode(',',$detail->privileges);
		$permission	=	unserialize($detail->permission);
		
			 if( sizeof($allowed) > 0 )
			  {
				for($i=0;isset($allManagers[$i]);$i++)
				 {
				   $allManagers[$i]->subManagers	=	$this->Team_Model->getAllParentSubManagers($allManagers[$i]->mng_id);
					$allSubmanagers	=	$allManagers[$i]->subManagers;
					  for($j=0;isset($allSubmanagers[$j]);$j++)
						{
						  if(in_array($allSubmanagers[$j]->mng_id,$allowed))
						   {
							 $allSubmanagers[$j]->selected	=	'yes';
							 $selectArray[] = $allSubmanagers[$j]->parent_id;
						   } else {
							 $allSubmanagers[$j]->selected	=	'no';	
						   }
						}
							$allManagers[$i]->subManagers	=	$allSubmanagers;	
				 }
			  }
		$output['allManagers']	=	$allManagers;
		$output['selectArray'] = array_unique($selectArray);
		$output['permission'] = $permission;
		$output['allowed'] = $allowed;

		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/team/view_team',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	function deleteTeam($id) {
	
	   $output['manager_id'] = $manager_id = 3;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->Team_Model->deleteMember($id);
	   $this->session->set_userdata('success_msg','Member Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-team');
	}
	function changeStatus($task,$id) {
	
	   $output['manager_id'] = $manager_id = 3;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Team_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Member Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-team');
	}
	function changePassword() {
	  
	  if($_POST)
	   {
		 $this->form_validation->set_rules('curr_password','Current Password','trim|required|callback_CurrPassCheck');
		 $this->form_validation->set_rules('new_pass','New Password','trim|required|matches[confirm_pass]');
		 $this->form_validation->set_rules('confirm_pass','Confirm Password','trim|required');
		 
		 if($this->form_validation->run())
		  {
		     $this->Team_Model->updatePassword();
			 
			 $data['success'] = true;
		  }
		if(validation_errors())
		 {
		   $data['success'] = false;
		   $data['error'] = validation_errors();
		 } else {
		   $data['success'] = true;
		   $data['success_msg'] = 'Password Updated Successfully';
		   $data['model'] = 'hide';
		 }
        echo json_encode($data); die;
	   }
	   
	}
	public function CurrPassCheck($curr_password) {
        
		$result = $this->Common_Modal->getSingleFieldFromAnyTable('password','id',$this->session->userdata('SAG_mem_id'),'tbl_sag_user');
		if($result!=md5($curr_password)) 
		{
			  $this->form_validation->set_message('CurrPassCheck', 'Current Password is wrong');
			   return FALSE;
		} else {
			   return TRUE;
		}
    }
   public function webLogs(){	

	   $output['manager_id'] = $manager_id = 10;
	   $this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
	   $output['clear_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'clear');

		$output['start_date'] = $start_date = $this->input->post('start_date');
		$output['end_date'] = $end_date = $this->input->post('end_date');
		$output['allPages']	=	$this->Team_Model->getAllLog($start_date,$end_date);	

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/team/weblog');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function clearweblog(){		
	   $output['manager_id'] = $manager_id = 10;
	   $this->Common_Modal->checkForPageAccess($manager_id,'clear','redirect');
		
		$returnLogin = $this->Team_Model->clear_log();
		$this->session->set_userdata('success_msg','Weblogs deleted Successfully');
		redirect($this->config->item('adminName').'/team-web-logs');
	}
}