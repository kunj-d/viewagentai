<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include("AppDefault.php");

class Team_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        $this->checkAlreadyLogout();
 	$this->Common_Model->checkSubDomain();
        //$this->Common_Model->checkSubDomain();
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business = $this->session->userdata('business');
        $this->business_id = $this->business['id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Team_Model');
        $this->load->model($this->model_folder . "Business_model");
        $this->permission_msg = $this->config->item('permission_msg');

     //   $team_management = $this->Common_Model->checkFeatureInPlanArray('team_management');
            if(!in_array('team_management',$this->session->userdata('features')) ) {
     
            $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
        
        if ($this->user_id != $this->owner_id) {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('dashboard'));
        }
    }

    public function index() {
        $this->db->select('user.*');
        $this->db->from('tbl_user user');
        $this->db->where('user.owner_id',$this->owner_id);
        $this->db->where('user.role','team');
       // $this->db->join('business b','b.id=user.last_business_id','inner');
        
        if($this->input->post('search_key')!= ""){
            	$this->db->group_start();
            	$this->db->or_like('name', $this->input->post('search_key'));
    			$this->db->or_like('email', $this->input->post('search_key'));
    				$this->db->group_end();
        }
	
		if(!$get_count){
			if(!empty($this->input->post('sorted_on'))
			){
				$sorted_by =$this->input->post('sorted_by');
				$this->db->order_by('user.'.$this->input->post('sorted_on'),$sorted_by); 
			}else{
				$this->db->order_by('user.created','desc'); 
			}
			
		}
// 		$this->db->limit($limit, $start);
		$data['lists'] =  $query=$this->db->get()->result_array();
		//pr($data['lists']);
 		//die;
		
        
        $this->loadView('team/team-management', $data);
    }

    public function TeamListJson() {
       
        //if ($this->input->post('item_per_page') && $this->input->post('current_page')) {
 
            $business_data = $this->Team_Model->getTeamListJson($this->input->post('items_per_page'), $this->input->post('current_page'));
            $output['data'] = $business_data['data'];
            $output['total_records'] = $business_data['total_records'];
            $output['filtered_records'] = $business_data['filtered_records'];
   //     } else {
           /* $output['data'] = array();
            $output['total_records'] = 0;
            $output['filtered_records'] = 0;*/
       // }
        echo json_encode($output);
    }

    public function deleteTeamMemberJson() {
        $is_current_business_delete = false;
        $ids =  $this->input->post('id');
        if ($this->input->post('id')) {
           
           if($this->input->post('type') == 'single' ){
                $ids = explode(',', $this->input->post('id'));
           } else{
                $ids = $this->input->post('id');    
           }
            foreach ($ids as $key => $team_id) {
                 $business_data = $this->Business_model->getallBusinessUserwise($team_id);
                  foreach ($business_data as $key => $bus) {
                      $this->db->where('id', $bus['id']);
                      $this->db->delete('business');
                      $this->Business_model->deleteBusinessRecord($bus['id']);
                  }
                $this->Team_Model->deleteTeamRecord($team_id);
            }
            if (count($ids) > 1) {
                $this->Common_Model->set_user_logs('Delete Client', 'Delete Client');
                $output['success'] = array('message' => "Records Deleted Successfully", "type" => "flash");
            } else {
                $output['success'] = array('message' => "Record Deleted Successfully", "type" => "flash");
            }
        } else {
            $output['error'] = array('message' => "Some error occur", "type" => "flash");
        }
        echo json_encode($output);
        die;
    }

    public function editTeamMember($team_id) {
        $output = array();
        $output['pageTitle'] = 'Edit Member';
        $where = array('id' => $team_id, 'owner_id' => $this->owner_id);
        $team_data = $this->Team_Model->getTeamRecord($where)[0];
       
        if ($team_data) {
            /*$user_detail = $this->Team_Model->getUserDetail($team_data['user_id']);
            $team_data['name'] = $user_detail['name'];
            $team_data['email'] = $user_detail['email'];
            $output['team_data'] = $team_data;
            $output['team_user_id'] = $user_detail['id'];
            $output['team_id'] = $team_id;
            $output['custom_role_ids'] = json_decode($team_data['custom_role_ids']);*/

            $this->db->where('user_id', $this->owner_id);
            $query = $this->db->get('business');
            $output['business_list'] = $query->result();

           /* $this->db->where('slug !=', 'admin');
            $query = $this->db->get('default_role_type');
            $output['role_types'] = $query->result();

            $this->db->where('status', '1');
            $this->db->where('role_id', '0');
            $query = $this->db->get('default_privileges');
            $output['all_privilege'] = $query->result();*/
            $output['team_data'] = $team_data;
       
            $this->loadView('team/edit-team', $output);
        } else {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('dashboard'));
        }
    }

    public function editTeamMemberJson() {
        $output["error"] = false;
        if ($this->input->post()) {

           // $team_id = $this->input->post("team_id");
            $team_user_id = $this->input->post("team_user_id");

            /* check duplicate user access for same Businesss start here */
            $where = array('role' => 'team', 'owner_id' => $this->owner_id, 'id' => $team_user_id, 'id!=' => $this->owner_id);
            $all_team_data = $this->Team_Model->getTeamRecord($where);
            if(!empty($this->input->post("user_name"))) {
                $update_data = $this->input->post("user_name");
            }else {
                $update_data = 'Team Member Update';
            }
            $this->Team_Model->updateUserBusniess($team_user_id, $this->input->post("business"), $this->input->post("user_name"));
             $this->Common_Model->set_user_logs('Update Team member Settings', $update_data);
            /* save team member entry end  here */
            /* for show flash success message */
            $flashdata['success'] = array('message' => 'Team Member Updated Successfully ', 'type' => 'flash');
            $this->session->set_flashdata('message', json_encode($flashdata));
            $output['redirect'] = base_url("team-management");
            $output['success'] = array('message' => 'Team Member Updated Successfully ', 'type' => 'flash');
            echo json_encode($output);
            die;
        }
    }

    public function AddTeam() {
        
        $this->Common_Model->checkPlanCountAccess('client_count',false);

        $output = array();
        $output['pageTitle'] = 'Add New Member';
        if ($this->user_id == $this->owner_id) {
            
            $this->db->where('user_id',$this->user_id);
            $query = $this->db->get('business');
            
            $output['business'] =  $query->result();
    
            $this->loadView('team/add-team', $output);
        } else {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('dashboard'));
        }
    }

    public function AddTeamMemberJson() {
        
    
    
        $output["error"] = false;
    
        if ($this->input->post()) {
            $this->form_validation->set_rules('user_name', 'Name', 'trim|required');
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[tbl_user.email]');
           // $this->form_validation->set_rules('business_domain', 'Business_domain', 'required');
            if ($this->form_validation->run()) {
                $name = $this->input->post("user_name");
                $email = $this->input->post("user_email");
                $business = $this->input->post('business');
                
                $this->db->select('email');
                $this->db->where('email', $email);
                $query = $this->db->get('tbl_user');
                if ($query->num_rows() > 0) {
                    $result["error"]["error_data"] = "";
                    $result['error']['message'] = "Email Already Registered";
                    $result['error']['type'] = 'flash';
                    echo json_encode($result);
                    die();
                }

                $password = $this->generateRandomString();
                $forget_password_code = md5(md5($password));
                $user_deatil = array(
                    'name' => $name,
                    'email' => $email,
                    'role' => 'team',
                    'password' => md5($password),
                    'status' => 'active',
                    'owner_id' => $this->owner_id,
                     'last_business_id' => $business,
                    'reset_key' => $forget_password_code,
                    'forget_pass_exptime' => (time() + 86400),
                    'credit' => 0,
                    'ai_generation_count'=>0,
                    'modified' => time(),
                    'created' => time(),
                );
                $team_user_id = $this->Team_Model->addUser($user_deatil);
                $this->Common_Model->set_user_logs('Add Team member Settings', $name);

                if ($this->config->item('islive') == 'on') {
                    $this->load->model($this->model_folder . "Mail_Model");
                    $this->Mail_Model->registration_team($email, $forget_password_code);
                }
               
                /* save team member entry end  here */
                /* for show flash success message */
                $flashdata['success'] = array('message' => 'Team Member created successfully ', 'type' => 'flash');
                $this->session->set_flashdata('message', json_encode($flashdata));
                $output['redirect'] = base_url("team-management");
                $output['success'] = array('message' => 'Team Member created successfully ', 'type' => 'flash');
                echo json_encode($output);
                die;
            } else {
                $flashdata['error']['message'] = validation_errors();
                 $flashdata['error']['type'] = 'flash';

                $this->session->set_flashdata('message', json_encode($flashdata));
                $output['error'] = array('message' => validation_errors(), "type" => "flash");
                echo json_encode($output);
                die();
            }
        }
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
