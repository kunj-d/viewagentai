<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include("AppDefault.php");

class Team_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        $this->checkAlreadyLogout();
        $this->Common_Model->checkSubDomain();
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business = $this->session->userdata('business');
        $this->business_id = $this->business['id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Team_Model');
        $this->permission_msg = $this->config->item('permission_msg');

         $team_management = $this->Common_Model->checkFeatureInPlanArray('team_management');
         if (!$team_management) {
             $flashdata['error']['message'] = $this->pln_upgrade_msg;
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

    // public function index() {
    //     $output = array();
    //     $this->loadView('team/team-management', $output);
    // }
    
     public function index() {
        $this->db->select('u.id,team.id as team_id,u.name,u.email,team.role_id,drt.title as role,team.custom_role_title,team.business_id,team.created,b.domain');
        $this->db->from('team_users team');
        $this->db->where('team.owner_id',$this->owner_id);
        $this->db->where('team.team_type','team');
        $this->db->join('tbl_user u','team.user_id=u.id','inner');
        $this->db->join('business b','team.business_id=b.id','left');
        $this->db->join('default_role_type drt','team.role_id=drt.id','left');
		//$this->filter_date();
		if(!$get_count){
			if(!empty($this->input->get('sorted_on'))
			){
				$sorted_by =$this->input->get('sorted_by');
				$this->db->order_by($this->input->get('sorted_on'),$sorted_by); 
			}else{
				$this->db->order_by('created','desc'); 
			}
			$this->db->limit($limit, $start);
		}
			
		

		$data['lists'] =  $query=$this->db->get()->result_array();

		
        
        $this->loadView('team/team-management', $data);
    }

    public function TeamListJson() {
        if ($this->input->get('limit') && $this->input->get('pageNo')) {
            $business_data = $this->Team_Model->getTeamListJson();
            $output['data'] = $business_data['data'];
            $output['total_records'] = $business_data['total_records'];
            $output['filtered_records'] = $business_data['filtered_records'];
        } else {
            $output['data'] = array();
            $output['total_records'] = 0;
            $output['filtered_records'] = 0;
        }
        echo json_encode($output);
    }

    public function deleteTeamMemberJson() {
        $is_current_business_delete = false;
        if ($this->input->get('ids')) {
            $ids = explode(',', $this->input->get('ids'));
            foreach ($ids as $key => $team_id) {
                $this->Team_Model->deleteTeamRecord($team_id);
            }
            if (count($ids) > 1) {
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
        $where = array('user_id' => $team_id, 'owner_id' => $this->owner_id);
        $team_data = $this->Team_Model->getTeamRecord($where)[0];
        if ($team_data) {
            $user_detail = $this->Team_Model->getUserDetail($team_data['user_id']);
            $team_data['name'] = $user_detail['name'];
            $team_data['email'] = $user_detail['email'];
            $output['team_data'] = $team_data;
            $output['team_user_id'] = $user_detail['id'];
            $output['team_id'] = $team_id;
            $output['custom_role_ids'] = json_decode($team_data['custom_role_ids']);

            $this->db->where('user_id', $this->owner_id);
            $query = $this->db->get('business');
            $output['business_list'] = $query->result();

            $this->db->where('slug !=', 'admin');
            $query = $this->db->get('default_role_type');
            $output['role_types'] = $query->result();

            $this->db->where('status', '1');
            $this->db->where('role_id', '0');
            $query = $this->db->get('default_privileges');
            $output['all_privilege'] = $query->result();

            //     print_r($output);
            //    die;
            $this->loadView('team/edit-team', $output);
        } else {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('dashboard'));
        }
    }

    public function editTeamMemberJson() {
    // pr($_POST); die;
        $output["error"] = false;
        if ($this->input->post()) {

            $team_id = $this->input->post("team_id");
            $team_user_id = $this->input->post("team_user_id");

            foreach ($this->input->post("team_data") as $keyd => $team) {
                if (empty($team["role_type"]))
                    $output["error"]["form_error_role" . $keyd] = "The User Level field is required.";
                if (empty($team["business"]))
                    $output["error"]["form_error_business" . $keyd] = "The Access To field is required.";

                if ($team["role_type"] == 4) {
                    if (empty($team['assign_name']))
                        $output["error"]["form_error_assign_name" . $keyd] = "The Assign  User Name field is required.";
                    if (isset($team["privilege"])) {

                    } else {
                        $output["error"]["form_error_privilege" . $keyd] = "The Privilege field is required.";
                    }
                }
            }

            if ($output["error"]) {
                $result["error"]["error_data"] = $output["error"];
                $result['error']['type'] = 'inline';
                echo json_encode($result);
                die();
            }
            /* check duplicate user access for same Businesss start here */
            $where = array('team_type' => 'team', 'owner_id' => $this->owner_id, 'user_id' => $team_user_id);
            $all_team_data = $this->Team_Model->getTeamRecord($where);
            


            foreach ($this->input->post("team_data") as $keyd => $team) {
                if ((!empty($team["role_type"])) && (!empty($team["business"]))) {
                    $role_type = $team["role_type"];
                    $business = $team["business"];
                    foreach ($this->input->post("team_data") as $dup_key => $duplicarte_team) {
                        if (!empty($duplicarte_team["role_type"]) && !empty($duplicarte_team["business"]) && $keyd != $dup_key) {
                            if ($business == $duplicarte_team["business"]) {
                                $result["error"]["error_data"] = "";
                                $result['error']['message'] = "Can't assign multiple user levels to same Workspace.";
                                $result['error']['type'] = 'flash';
                                echo json_encode($result);
                                die();
                            }
                        }
                    }

                    // if ($all_team_data) {
                    //     foreach ($all_team_data as $dup_key => $duplicarte_team) {

                    //         if (!empty($duplicarte_team["role_id"]) && !empty($duplicarte_team["business_id"])) {
                    //             if ($business == $duplicarte_team["business_id"]) {
                    //                 $result["error"]["error_data"] = "";
                    //                 $result['error']['message'] = "Can't assign multiple user levels to same business.";
                    //                 $result['error']['type'] = 'flash';
                    //                 echo json_encode($result);
                    //                 die();
                    //             }
                    //         }
                    //     }
                    // }
                }
            }

            // $this->Team_Model->editDeleteTeamRecord($team_id);

            //$this->load->model($this->model_folder . "Mail_Model");
            //$this->Mail_Model->registration_team($email,$forget_password_code);
            foreach ($this->input->post("team_data") as $team_key => $team) {
                if ($team_key == 0) {
                    $this->Team_Model->updateUserBusniess($team_user_id, $team["business"]);
                }
                $privilege_ids = array();
                if ($team["role_type"] == 4) {
                    foreach ($team["privilege"] as $privilege) {
                        $privilege_ids[] = $privilege;
                    }
                }
                
                $username = $team["user_name"];
                $this->db->where('id',$team_user_id);
                $this->db->set('name', $username);
                $this->db->update('tbl_user');
                
                
                $team_value = array(
                    "user_id" => $team_user_id,
                    "owner_id" => $this->owner_id,
                    "business_id" => $team["business"],
                    "role_id" => $team["role_type"],
                    "added_by" => $this->user_id,
                    "custom_role_title" => $team["assign_name"],
                    "custom_role_ids" => json_encode($privilege_ids),
                    "created" => time(),
                    "modified" => time()
                );
                $this->Team_Model->update_team_member($team_user_id,$this->owner_id,$team_value);
                // pr($this->db->last_query());die('here');
            }
            /* save team member entry end  here */
            /* for show flash success message */
            $flashdata['success'] = array('message' => 'Team Member Updated Successfully ', 'type' => 'flash');
            $this->session->set_flashdata('message', json_encode($flashdata));
            $output['redirect'] = site_url("team-management");
            $output['success'] = array('message' => 'Team Member Updated Successfully ', 'type' => 'flash');
            echo json_encode($output);
            die;
        }
    }

    public function AddTeam() {
		$created_team_count_array = $this->Common_Model->getSingleRowFromTable('team_users', array('business_id' => $this->business_id));
		$plan_team_counts = $this->all_plan_fields_counts['team_count']['value'];

        if($plan_team_counts=='zero' || $plan_team_counts=='0'){
            $flashdata['error']['message'] = $this->pln_upgrade_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
        if($plan_team_counts!='unlimited'){
			$created_team_count = count($created_team_count_array);
            if($created_team_count>=$plan_team_counts){
                $flashdata['error']['message'] = $this->pln_upgrade_msg;
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('message', json_encode($flashdata));
                redirect(site_url('subscription'));
            }
        }
		
		
        $output = array();
        $output['pageTitle'] = 'Add New Member';
        if ($this->user_id == $this->owner_id) {
            $output = array();
            $this->db->where('user_id', $this->owner_id);
            $query = $this->db->get('business');
            $output['business_list'] = $query->result();

            $this->db->where('slug !=', 'admin');
            $query = $this->db->get('default_role_type');
            $output['role_types'] = $query->result();

            $this->db->where('status', '1');
            $this->db->where('role_id', '0');
            $query = $this->db->get('default_privileges');
            $output['all_privilege'] = $query->result();

            $this->loadView('team/add-team', $output);
        } else {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('dashboard'));
        }
    }

    public function AddTeamMemberJson() {
        // pr($_POST); die('here');
        $output["error"] = false;
        if ($this->input->post()) {
            $this->form_validation->set_rules('user_name', 'Name', 'trim|required');
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|is_unique[tbl_user.email]');
            if ($this->form_validation->run()) {
                $name = $this->input->post("user_name");
                $email = $this->input->post("user_email");

                foreach ($this->input->post("team_data") as $keyd => $team) {
                    if (empty($team["role_type"]))
                        $output["error"]["form_error_role" . $keyd] = "The User Level field is required.";
                    if (empty($team["business"]))
                        $output["error"]["form_error_business" . $keyd] = "The Access To field is required.";

                    if ($team["role_type"] == 4) {
                        if (empty($team['assign_name']))
                            $output["error"]["form_error_assign_name" . $keyd] = "The Assign  User Name field is required.";
                        if (isset($team["privilege"])) {

                        } else {
                            $output["error"]["form_error_privilege" . $keyd] = "The Privilege field is required.";
                        }
                    }
                }

                if ($output["error"]) {
                    $result["error"]["error_data"] = $output["error"];
                    $result['error']['type'] = 'inline';
                    echo json_encode($result);
                    die();
                }
                /* check duplicate user access for same Businesss start here */
                foreach ($this->input->post("team_data") as $keyd => $team) {
                    if ((!empty($team["role_type"])) && (!empty($team["business"]))) {
                        $role_type = $team["role_type"];
                        $business = $team["business"];
                        foreach ($this->input->post("team_data") as $dup_key => $duplicarte_team) {
                            if (!empty($duplicarte_team["role_type"]) && !empty($duplicarte_team["business"]) && $keyd != $dup_key) {
                                if ($business == $duplicarte_team["business"]) {
                                    $result["error"]["error_data"] = "";
                                    $result['error']['message'] = "Can't assign multiple user levels to same Workspace.";
                                    $result['error']['type'] = 'flash';
                                    echo json_encode($result);
                                    die();
                                }
                            }
                        }
                    }
                }
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
                    'reset_key' => $forget_password_code,
                    'forget_pass_exptime' => (time() + 86400),
                    'modified' => time(),
                    'created' => time(),
                );

                $team_user_id = $this->Team_Model->addUser($user_deatil);


                if ($this->config->item('islive') == 'on') {
                    $this->load->model($this->model_folder . "Mail_Model");
                    $this->Mail_Model->registration_team($email, $forget_password_code);
                }
                foreach ($this->input->post("team_data") as $team_key => $team) {
                    if ($team_key == 0) {
                        $this->Team_Model->updateUserBusniess($team_user_id, $team["business"]);
                    }
                    $privilege_ids = array();
                    if ($team["role_type"] == 4) {
                        foreach ($team["privilege"] as $privilege) {
                            $privilege_ids[] = $privilege;
                        }
                    }
                    $team_value = array(
                        "user_id" => $team_user_id,
                        "owner_id" => $this->owner_id,
                        "business_id" => $team["business"],
                        "role_id" => $team["role_type"],
                        "added_by" => $this->user_id,
                        "custom_role_title" => $team["assign_name"],
                        "custom_role_ids" => json_encode($privilege_ids),
                        "created" => time(),
                        "modified" => time()
                    );
                    
                    // pr($team_value); die;
                    $this->Team_Model->add_team_member($team_value);
                }
                /* save team member entry end  here */
                /* for show flash success message */
                $flashdata['success'] = array('message' => 'Team Member created successfully ', 'type' => 'flash');
                $this->session->set_flashdata('message', json_encode($flashdata));
                $output['redirect'] = site_url("team-management");
                $output['success'] = array('message' => 'Team Member created successfully ', 'type' => 'flash');
                echo json_encode($output);
                die;
            } else {
                $output["error"]["form_error_name"] = form_error('user_name');
                $output["error"]["form_error_email"] = form_error('user_email');
                foreach ($this->input->post("team_data") as $keyd => $team) {
                    if (empty($team["role_type"]))
                        $output["error"]["form_error_role" . $keyd] = "The User Level field is required.";
                    if (empty($team["business"]))
                        $output["error"]["form_error_business" . $keyd] = "The Access To field is required.";


                    if ($team["role_type"] == 4) {
                        if (empty($team['assign_name']))
                            $output["error"]["form_error_assign_name" . $keyd] = "The Assign  User Name field is required.";
                        if (isset($team["privilege"])) {

                        } else {
                            $output["error"]["form_error_privilege" . $keyd] = "The Privilege field is required.";
                        }
                    }
                }
                $result["error"]["error_data"] = $output["error"];
                $result['error']['type'] = 'inline';
                echo json_encode($result);
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
