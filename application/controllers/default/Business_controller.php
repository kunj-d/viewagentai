<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 
include("AppDefault.php");

class Business_controller extends AppDefault {

    public function __construct() {
      
        parent::__construct();
        $this->checkAlreadyLogout();
        // $this->Common_Model->checkSubDomain();
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->user_id = $this->session->userdata('logged_in')['id'];
         $this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : 0;
        $this->view_folder = $this->config->item('template');
        $this->model_folder = $this->view_folder;
        $this->load->model($this->model_folder . "Business_model");
        $this->permission_msg = $this->config->item('permission_msg');
               $this->load->helper('tokengenerate');
    //   pr($this->session->userdata());
    //     die;
        //Plan
        // $user_plan=$this->app_lib->get_user_plan();
        // $user_plan_counts=$user_plan['fields'];
        // $this->plan_business_count = $user_plan_counts['business_count']['value'];
        // $this->created_business_count=$this->app_lib->get_business_count();
        // if($this->session->userdata('welcome_status')=='0' &&
        // $this->created_business_count==0){
        // redirect(base_url('welcome'));
        // }
    }

    public function business_list() {
        $output = array();

        $this->team_business_setting = true;
        if ($this->user_id != $this->owner_id) {
            if (!in_array('business_setting', $this->all_team_privileges)) {
                $this->team_business_setting = false;
            }
        }
               
        $output['team_business_setting'] = $this->team_business_setting;
        $output['permission_msg'] = $this->permission_msg;
        
        $business_data = $this->Business_model->get_businesses_data();
        // pr($business_data);
       
        
        $this->db->select("business_id");
        $this->db->where('user_id', $this->user_id);
        $this->db->where('owner_id', $this->owner_id);
        $query = $this->db->get('team_users');
        $business_ids = array_column($query->result_array(), 'business_id');
        // pr($business_ids);

        $this->db->select('b.id,b.title,b.domain,b.logo,b.created');
        $this->db->select('(select count(id) from business_products_settings where business_id = b.id and publish_status="published") as published_products');
        $this->db->select('(select count(id) from product_sales where business_id = b.id and status="active" and plan_type!="free_report") as sales_product_count');
        $this->db->select('(select count(id) from user_blogs where business_id = b.id and visibility_status="1") as published_blogs');
        // if ($this->user_id == $this->owner_id || $this->owner_id == 0) {
            $this->db->where('user_id', $this->user_id);
        // } else {
        //     $this->db->where_in('id', $business_ids);
        // }
        if (!$get_count) {
            if (!empty($this->input->get('sorted_on'))
            ) {
                $sorted_by = $this->input->get('sorted_by');
                $this->db->order_by($this->input->get('sorted_on'), $sorted_by);
            } else {
                $this->db->order_by('created', 'desc');
            }
            // $this->db->limit($limit, $start);
        }
        //  echo "hello";
        // die;
        $output['lists'] =  $this->db->get('business b')->result_array();
        //  echo "hello1";
        // pr($output['lists']);
        // die;
        // if (sizeof($business_data) == 0) {
        //     $flashdata['error']['message'] = 'Please! Create Workspace First.';
        //     $flashdata['error']['type'] = 'flash';
        //     $this->session->set_flashdata('message', json_encode($flashdata));
        //     redirect($this->config->item('redirectMainUrl') . "create-workspace");
        // }

        $output['user_business_logo_folder'] = $this->config->item('uploadPath') . "users/" . $this->owner_id . "/business_logo/";
    //     pr($output);
    //   echo "hello";
    //     die;
        $this->loadView('business/business_list', $output);
    }

    public function get_business_list_json() {
        if ($this->input->get('limit') && $this->input->get('pageNo')) {
            $business_data = $this->Business_model->get_business_list_data();
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

    public function create_business() {
    //  echo "<pre>"; print_r($this->input->post()); die;
     $this->Common_Model->checkPlanCountAccess('business_count',false);
        // echo "hello";
        // die;
        //Team Feature
        // if ($this->owner_id != $this->user_id) {
        //     $flashdata['error']['message'] = $this->config->item('permission_msg');
        //     $flashdata['error']['type'] = 'flash';
        //     $this->session->set_flashdata('message', json_encode($flashdata));
        //     redirect(base_url('dashboard'));
        // }

        //Plan
        // print_r($this->all_plan_fields_counts);
        // die;
        // $plan_business_counts = $this->all_plan_fields_counts['busniess_count']['value'];
        // if($plan_business_counts=='zero' || $plan_business_counts=='0'){
        //     $flashdata['error']['message'] = $this->pln_upgrade_msg;
        //     $flashdata['error']['type'] = 'flash';
        //     $this->session->set_flashdata('message', json_encode($flashdata));
        //     redirect(site_url('subscription'));
        // }
        // if($plan_business_counts!='unlimited'){
        //     $created_business_count = $this->app_lib->get_business_count();
        //     if($created_business_count>=$plan_business_counts){
        //         $flashdata['error']['message'] = $this->pln_upgrade_msg;
        //         $flashdata['error']['type'] = 'flash';
        //         $this->session->set_flashdata('message', json_encode($flashdata));
        //         redirect(site_url('subscription'));
        //     }
        // }


        $output = array();
        
        $domain  = strtolower(str_replace(' ', '', $this->input->post('domain')));
        
        $this->db->where('domain', $domain);
        $query = $this->db->get('business'); 
        if ($query->num_rows() > 0) {
            $flashdata['error'] = array('message' => 'This Workspace is already registered. Try another', 'type' => 'flash');
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(base_url('create-workspace'));
            die();
        }

        $this->form_validation->set_rules('domain', 'WorkSpace', 'trim|required|is_unique[business.domain]|callback_domain_name_validate');
        $this->form_validation->set_message('is_unique', 'This %s is already registered. Try another');
        //$this->form_validation->set_rules('business_name', 'Workspace Name', 'trim|required');
        // $this->form_validation->set_rules('address', 'Address', 'trim|required');
        // $this->form_validation->set_rules('city', 'City', 'trim|required');
        // $this->form_validation->set_rules('country', 'Country', 'trim|required');

        
        if ($this->form_validation->run()) {
            // $user_plan = $this->app_lib->get_user_plan();
            // $business_count = $this->created_business_count;
            // if($user_plan['fields']['business_count']['value'] <= $business_count && $user_plan['fields']['business_count']['value'] != "unlimited"){
            // $flashdata['error']['message'] = 'Error! Upgrade account first';
            // $flashdata['error']['type'] = 'flash';
            // $this->session->set_flashdata('message', json_encode($flashdata));
            // redirect(site_url('subscription'));
            // }
            $ipn_secret_key = $this->Common_Model->generateRandomString(16);

            $business_data = array(
                'domain' => $domain,
                'title' => $this->input->post('domain'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'user_id' => $this->user_id,
                'ipn_secret_key' => $ipn_secret_key,
                'notification_email' => $this->session->userdata('logged_in')['email'],
                'created' => time(),
                'modified' => time(),
            );
            if (!empty($_FILES['business_logo']['name'])) {
                $path  =  $this->addLibraryImages('business_logo','business');
                 if($path && !empty($path['data']['error'])){
                    $flashdata['error']['message'] = $path['data']['error'];
                    $flashdata['error']['type'] = 'flash';
                    $this->session->set_flashdata('message', json_encode($flashdata));
                    redirect('create-workspace');
                }else{
                     $business_data['logo'] = $path;
                    $business_data['fevicon'] = $path;
                }
                
                
            }

            $business_id = $this->Business_model->addRecord($business_data);
            
            // echo"<pre>";
            // print_r($business_id);
            // die;
            
           $agent_data = array(
            'business_id'       => $business_id,
            'user_id'           => $this->user_id,
            'agent_unique_code' => uniqid('agent_'),
            'agent_display_name'=> $business_data['title'],
            'status'            => 1
        );

         $this->db->insert('openclaw_agents', $agent_data);
            
            $user_id = $this->session->userdata('logged_in')['id'];
            $business_id = $business_id;
            $token_generate = "user_id={$user_id}:business_id={$business_id}";
            $access_token = encrypt_user_token($token_generate);
            $this->db->where('id',$business_id);
            $this->db->update('business',['access_token'=>$access_token]);
                
                $this->createVaForBusiness($business_id);
           
            
            $business_data = $this->Business_model->checkLastBusiness($this->session->userdata('logged_in')['owner_id']);
            $business_data = $this->Business_model->checkLastBusiness($this->session->userdata('logged_in')['id']);
         
            if(!empty($business_data) && $business_data == 1){
                 $this->db->where('id',$this->session->userdata('logged_in')['id']);
                 $this->db->update('tbl_user',['last_business_id'=>$business_id]);
                 $this->business_switch($business_id);
            }

       
            $this->Common_Model->set_user_logs('Create Workspace', $this->input->post('business_name'));

            $flashdata['success'] = array('message' => 'Workspace Created Successfully', 'type' => 'flash');
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(base_url('workspace'));
        }

        //Plan
        // if($this->plan_business_count == 'zero' || ($this->plan_business_count != 'unlimited' && $this->created_business_count >= $this->plan_business_count)){
        // $flashdata['error']['message'] = $this->config->item('pln_upgrade_msg');
        // $flashdata['error']['type'] = 'flash';
        // $this->session->set_flashdata('message', json_encode($flashdata));
        // redirect(site_url('subscription'));
        // }
        //$output['count_business'] = $this->created_business_count;
        
        $output['default_img_folder'] = $this->config->item('uploadPath') . "default_images/";
        $output['default_logo'] = "default_business_logo.png";
        $output['default_business_logo'] = $output['default_img_folder'] . "default_business_logo.png";
        $this->loadView('business/create_business', $output);
    }

    public function business_switch($id) {
        
        if ($this->user_id != $this->owner_id && $this->owner_id != 0) {
            $this->db->where('id', $this->user_id);
            $query = $this->db->get('tbl_user');
            if ($query->num_rows()) {
                $business_ids = array_column($query->result_array(), 'last_business_id');
            } else {
                $business_ids = array();
            }
            $this->db->select('id,title,domain,logo,fevicon');
            $this->db->where_in('id', $business_ids);
            $query = $this->db->get('business');
            
        } else {
             
            $this->db->select('id,title,domain,logo,fevicon');
            $this->db->where('id', $id);
            $this->db->where('user_id', $this->user_id);
            $query = $this->db->get('business');
             
        }
     
        if ($query->num_rows()) {
            $business_info = $query->row_array();
            $this->session->set_userdata('business', $business_info);
            $this->session->set_userdata('business_id', $id);
            $this->db->set('last_business_id', $id);
            $this->db->where('id', $this->user_id);
            $query = $this->db->update('tbl_user');
            
            $current_domain = current(explode('.', $_SERVER['HTTP_HOST']));
            
            // $this->db->select("last_business_id");
            // $this->db->where('id ',$id);
            // $flashdata_msg= $this->db->get('tbl_user')->row_array();
    
            // $url = str_replace($current_domain, $business_info['domain'], base_url('dashboard'));

            $url = $this->config->item("http").$business_info['domain'].'.'. $this->config->item('productSite').'/dashboard';
           // if (!$this->session->has_userdata('business_switch_session')) {
                $flashdata['success']['type'] = 'flash';
                $flashdata['success']['message'] = 'Workspace Changed Successfully';
                $this->session->set_flashdata('message', json_encode($flashdata));
          // }
          
          $this->Common_Model->set_user_logs('Workspace switch setting', $business_info['domain']);
            $this->session->unset_userdata('business_switch_session');
            redirect($url);
        } else {
            redirect(base_url('workspace'));
        }
    }

    /*public function domain_name_validate($str) {
        if (empty(trim($str))) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field  is required.');
            return FALSE;
        }
        if (trim($str) == 'www') {
            $this->form_validation->set_message('domain_name_validate', 'This {field}  not allowed.');
            return FALSE;
        }
        if (!preg_match("/^([a-zA-Z0-9])+$/i", $str)) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field can not have special character.');
            return FALSE;
        } elseif (preg_match('/[A-Z]/', $str)) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field can not have upper character.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    */
      public function domain_name_validate($str) {
        $str = strtolower(str_replace(' ', '', $str));
 
        if (empty(trim($str))) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field  is required.');
            return FALSE;
        }
        if (trim($str) == 'www') {
            $this->form_validation->set_message('domain_name_validate', 'This {field}  not allowed.');
            return FALSE;
        }
        if (!preg_match("/^([a-zA-Z0-9])+$/i", $str)) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field can not have special character.');
            return FALSE;
        } elseif (preg_match('/[A-Z]/', $str)) {
            $this->form_validation->set_message('domain_name_validate', 'The {field} field can not have upper character.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function set_plan_msg_nd_redirct_to_subscription() {
        $flashdata['error']['message'] = $this->config->item('pln_upgrade_msg');
        $flashdata['error']['type'] = 'flash';
        $this->session->set_flashdata('message', json_encode($flashdata));
        redirect(base_url('subscription'));
    }

    public function deleteBusinessJson() {
        $is_current_business_delete = false;
        // if ($this->user_id != $this->owner_id) {
        //     $flashdata['error'] = array('message' => 'Something went wrong', 'type' => 'flash');
        //     $this->session->set_flashdata('message', json_encode($flashdata));
        //     redirect($redirect_url);
        // }else{
             if ($this->input->get('ids')) {
                $ids = explode(',', $this->input->get('ids'));
                foreach ($ids as $key => $business_id) {
                    if($business_id == $this->business_id){
                         $output['error'] = array('message' => "You don't delete your currently activated Workspace", "type" => "flash");
                          echo json_encode($output);
                         die;
                    }
                    
                    $count = $this->Business_model->checkLastBusiness($this->user_id);
             
                    if($count == 1)
                    {
                        $output['error'] = array('message' => "You don't delete your last Workspace", "type" => "flash");
                          echo json_encode($output);
                         die;
                    }
                    $this->Business_model->deleteBusinessRecord($business_id);
                    $this->Common_Model->set_user_logs('Delete Workspace', 'Delete Workspace');
                    if ($this->session->userdata('business') && $this->session->userdata('business')['id'] == $business_id) {
                        $this->session->unset_userdata('business');
                        $this->session->unset_userdata('business_id');
                        $is_current_business_delete = true;
                    }
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
            
        // }
    }

    /**     * *************************************Business Settings ********************************************
     * =========================================================================================================== */
    public function BusinessSettings($business_id = 0) {
        $output = array();
        // if ($this->user_id != $this->owner_id) {
        //     if (!in_array('business_setting', $this->all_team_privileges)) {
        //         $flashdata['error']['type'] = 'flash';
        //         $flashdata['error']['message'] = $this->permission_msg;
        //         $this->session->set_flashdata('message', json_encode($flashdata));
        //         redirect(base_url() . "dashboard");
        //     }
        // }
       

        if ($business_id == 0) {
            $this->business_id = $this->session->userdata('business')['id'];
            $where = array('id' => $this->business_id, 'user_id' => $this->owner_id);
            $output['business_id'] = $this->business_id;
        } else {
            $where = array('id' => $business_id, 'user_id' => $this->user_id);
            $output['business_id'] = $business_id;
        }
        $business = $this->Business_model->get_business_row($where);
        if ($business) {
            $output['default_img_folder'] = $this->config->item('uploadPath') . "default_images/";
            $output['default_logo'] = "default_business_logo.png";
            $output['default_fevicon'] = "default_business_fevicon.png";
           

            //get business color scheme
            $business_color_scheme = $this->Business_model->getBusinessColorScheme();
            $output['business_color_scheme'] = $business_color_scheme;

            $output['business'] = $business;
            // pr($output['business']);
            // die;
            $output['permission_msg'] = $this->permission_msg;
            $output['pln_upgrade_msg'] = $this->pln_upgrade_msg;
            $output['business_theme_colors'] = $this->Common_Model->checkFeatureInPlanArray('business_theme_colors');
            $this->loadView('settings/business-settings', $output);
        } else {
            $flashdata['error']['message'] = $this->permission_msg;
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(base_url('dashboard'));
        }
    }

    public function SaveBusinessSettings() { 
        $output = array();
        if ($this->input->post('business_id') && $this->input->post('business_id') > 0) {
            $this->form_validation->set_rules('title', 'Workspace Name', 'trim|required');
            $this->form_validation->set_rules('logo', 'Workspace Logo', 'trim');
            // $this->form_validation->set_rules('fevicon', 'Business Fevicon', 'trim');
            // $this->form_validation->set_rules('color_scheme', 'Color Scheme', 'trim|required');
            // $this->form_validation->set_rules('address', 'Address', 'trim|required');
            // $this->form_validation->set_rules('city', 'city', 'trim|required');
            // $this->form_validation->set_rules('country', 'country', 'trim|required');
            // $this->form_validation->set_rules('notification_email', 'Support Email', 'trim|required');
            if ($this->form_validation->run()) {
            
            // pr($_FILES);
            // pr($_POST);
            // die;
                $title = $this->input->post('title');
                $fevicon = $this->input->post('fevicon');
                $color_scheme = $this->input->post('color_scheme');
                $address = $this->input->post('address');
                $city = $this->input->post('city');
                $country = $this->input->post('country');
                $notification_email = $this->input->post('notification_email');
                if (empty($_FILES['logo']['name'])) {
                    $logo = $this->input->post('logo');
                    $fevicon = $this->input->post('fevicon');
                }else{
                    $logo =  $this->addLibraryImages('logo','business');
                    if($path && !empty($path['data']['error'])){
                        $flashdata['error']['message'] = $path['data']['error'];
                        $flashdata['error']['type'] = 'flash';
                        $this->session->set_flashdata('message', json_encode($flashdata));
                        redirect('workspace');
                    }else{
                         $fevicon = $logo;
                    }
                    
                   
                }
                $data = array(
                    'title' => $title,
                    'logo' => $logo,
                    'fevicon' => $fevicon,
                    'address' => $address,
                    'city' => $city,
                    'country' => $country,
                    // 'notification_email' => $notification_email,
                );
                $business_id = $this->input->post('business_id');
                $where = array('id' => $business_id, 'user_id' => $this->user_id);
                $this->Business_model->updateBusiness($where, $data);
                if ($this->session->userdata("business") && $this->session->userdata("business")["id"] == $business_id) {
                    $business = $this->session->userdata("business");
                    $business['logo'] = $logo;
                    $business['fevicon'] = $fevicon;
                    $this->session->set_userdata('business', $business);
                }
                $this->Common_Model->set_user_logs('Update Workspace Settings', $title);
                $output['success'] = array('message' => "Workspace settings saved successfully", "type" => "flash");
                $output['redirect'] = base_url('workspace');
            } else {
                $output['error']['title'] = form_error('title');
                $output['error']['logo'] = form_error('logo');
                $output['error']['fevicon'] = form_error('fevicon');
				$business_theme_colors = $this->Common_Model->checkFeatureInPlanArray('business_theme_colors');
				if (!$business_theme_colors) {
				$output['error']['color_scheme'] = "Please Upgrade to use this feature";
				}
				else{
				$output['error']['color_scheme'] = form_error('color_scheme');

				}
                $output['error']['address'] = form_error('address');
                $output['error']['city'] = form_error('city');
                $output['error']['country'] = form_error('country');
                $output['error']['notification_email'] = form_error('notification_email');
            }
            echo json_encode($output);
        }
    }

    public function business_fetchall() {
        $fetch_data = $this->business_model->business_fetchall();
        $default_logo = 'default-business-logo.png';
        $delivery_url = $this->config->item("delivery_url");

        $data = array();
        foreach ($fetch_data as $row) {
            if (sizeof(explode('.', $_SERVER['HTTP_HOST'])) == 2) {
                $domain_url = str_replace('://', "://" . $row['domain'] . '.', base_url());
                $show_domain_url = $domain_url;
            } else {
                $http_prefix = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                $domainPart = explode('.', $_SERVER['HTTP_HOST']);
                $domain_url = $http_prefix . $row['domain'] . '.' . $domainPart[1] . '.' . $domainPart[2] . '/' . $this->config->item('BigwigMainFolder');
                $show_domain_url = $http_prefix . $row['domain'] . '.' . $domainPart[1] . '.' . $domainPart[2];
            }
            $logo = !empty($row['logo']) ? $row['logo'] : $default_logo;
            $sub_array = array();
            $sub_array[] = '<input class="checkbox-custom checkbox-custom1 check1" name="CheckList[]" type="checkbox" value="' . $row['id'] . '" required="" id="subcheck' . $row['id'] . '"><label for="subcheck' . $row['id'] . '" class="checkbox-custom-label checkbox-custom1-label check1"></label>';
            $sub_array[] = '<a href="' . $domain_url . 'workspace-switch/' . $row['id'] . '">' . $this->highlight_keyword($row['title']) . '</a>';

            if (!empty($row['logo'])) {
                $sub_array[] = '<img src="' . $delivery_url . 'assets/uploads/business_logo_image/' . $logo . '" class="img-responsive demologo" alt=""/>';
            } else {
                $sub_array[] = 'N/A';
            }
            $sub_array[] = $this->highlight_keyword($show_domain_url);
            //$sub_array[] = wordwrap(date("Y/m/d H:i:s", strtotime($this->app_lib->timezone_mysql_user($row['created']))),12,"<br>\n");
            //$sub_array[] = $row['created'];
            $sub_array[] = wordwrap($row['created'], 11, "<br>\n");
            $sub_array[] = '<div class="dropdown dropdown1"><a href="table-icon" class="mytoggle" data-toggle="dropdown"><i class="icon icon-action doticon" ></i></a><ul class="dropdown-menu dropdown-menu1"><li><a href="' . $domain_url . 'workspace-switch/' . $row['id'] . '"><i class="icon icon-manage "></i>&nbsp; Manage</a></li><li><a href="' . base_url('edit-workspace') . '/' . $row['id'] . '"><i class="icon icon-edit"></i>&nbsp; Edit</a></li><li><a data-toggle="modal" data-target="#business_delete" class="cursor" data-id="' . $row['id'] . '" id="deleteRecord" ><i class="icon icon-delete"></i>&nbsp; Delete</a></li></ul></div>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->business_model->get_all_data($this->owner_id),
            "recordsFiltered" => $this->business_model->get_filtered_data($this->owner_id),
            "data" => $data
        );

        echo json_encode($output);
    }

    function business_delete_all() {
        $request = $_REQUEST['data'];
        foreach ($request as $key => $id) {
            $this->db->select('domain');
            $this->db->where('id', $id);
            $query = $this->db->get('businesses');
            $domain = $query->row_array()['domain'];
            $this->set_user_logs('Delete Workspace', "User deleted Workspace " . $domain);
        }
        $this->business_model->business_delete_all($request);

        $flashdata['success'] = array('message' => 'Records Deleted Successfully', 'type' => 'flash');
        $this->session->set_flashdata('message', json_encode($flashdata));
        $this->session->unset_userdata('business_id');
    }

    public function delete_business($id) {
        $this->db->select('id,domain');
        $this->db->where('id', $id);
        $query = $this->db->get('businesses');
        $domain = $query->row_array()['domain'];
        $this->set_user_logs('Delete Workspace', "User deleted Workspace " . $domain);

        $this->business_model->deleteRecordById($id);
        $flashdata['success'] = array('message' => 'Record Deleted Successfully', 'type' => 'flash');
        $this->session->set_flashdata('message', json_encode($flashdata));
        $this->session->unset_userdata('business_id');
    }

    public function edit_business($id) {
        //User Permissions
        $this->permission_msg = $this->config->item('permission_msg');
        if ($this->user_id != $this->owner_id) {
            $all_privileges = $this->app_lib->user_privilege();
            if (!in_array('integration', $all_privileges)) {
                if (isset($_SERVER['HTTP_REFERER'])) {
                    $redirect_url = $_SERVER['HTTP_REFERER'];
                } else {
                    $redirect_url = $this->config->item('base_url') . "dashboard";
                }
                $flashdata['error'] = array('message' => $this->permission_msg, 'type' => 'flash');
                $this->session->set_flashdata('message', json_encode($flashdata));
                redirect($redirect_url);
            }
        }

        if (isset($_POST['submit'])) {

            $output = array();
            $logged_in = $this->session->userdata('logged_in');
            $user_id = $logged_in['id'];
            $this->form_validation->set_rules('business_name', 'Workspace Name', 'trim|required');
            $input_domain = $this->input->post('domain');
            $domain = $this->business_model->domainExist($id, $user_id);


            $img_error = "";
            if ($this->form_validation->run()) {
                if ($_FILES['business_logo']['name'] != '') {
                    $config['upload_path'] = './assets/uploads/business_logo_image/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $extention = pathinfo($_FILES['business_logo']['name'], PATHINFO_EXTENSION);
                    $bus_image_name = time() . rand() . "." . $extention;
                    $config['file_name'] = $bus_image_name;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('business_logo')) {
                        $output['img_error'] = $img_error = $this->upload->display_errors();
                    } else {
                        $img_data = array('upload_data' => $this->upload->data());
                        $logo = $img_data['upload_data']['file_name'];
                        $oldlogoimg = $this->input->post('old_logo');

                        $uploadFilePath = 'assets/uploads/business_logo_image/' . $bus_image_name;
                        $logo = $bus_image_name;
                        $oldFilePath = 'assets/uploads/business_logo_image/' . $oldlogoimg;
                        if ($uploadFilePath) {
                            $this->upload_library_image($img_data['upload_data'], $uploadFilePath, $bus_image_name);
                        }
                        $this->uploadAWS($uploadFilePath);
                        $this->deleteObject($oldFilePath);
						//$this->cloudFrontPurge($uploadFilePath);			

                    }
                } else {
                    $logo = $this->input->post('old_logo');
                }

                if ($img_error == '') {
                    $output['form'] = array(
                        'title' => $this->input->post('business_name'),
                        'logo' => $logo
                    );
                    $id = $this->input->post('id');
                    $affected = $this->business_model->updateById($id, $output['form'], $user_id);
                    if ($affected) {
                        $this->db->select('id,domain');
                        $this->db->where('id', $id);
                        $query = $this->db->get('businesses');
                        $domain = $query->row_array()['domain'];

                        $this->set_user_logs('Update Workspace', "User updated Workspace " . $domain);
                        $flashdata['success'] = array('message' => 'Workspace Updated Successfully', 'type' => 'flash');
                        $output['flashdata'] = json_encode($flashdata);
                    } else {
                        $flashdata['success'] = array('message' => 'Sorry! You are not authenticated to update this record', 'type' => 'flash');
                        $output['flashdata'] = json_encode($flashdata);
                    }
                }
            }
        }
        $output["delivery_url"] = $this->config->item("delivery_url");
        $output['singleBusinessList'] = $this->business_model->getRecordById($id);

        $this->load->view($this->view_folder . 'header', $output);
        $this->load->view($this->view_folder . 'edit_business', $output);
        $this->load->view($this->view_folder . 'footer');
    }

    public function setting_business() {
        $business_id = $this->getBusinessId();
        redirect(base_url('edit-workspace') . '/' . $business_id);
    }

    // for highlight search keyword
    public function highlight_keyword($content) {
        $keyword = $_REQUEST["search_box"];
        if (!empty($_REQUEST["search_box"])) {
            $count_strfound = substr_count(strtolower($content), strtolower($keyword));
            $content_new = $content;
            $match = array();

            for ($i = 0; $i < $count_strfound; $i++) {
                $str_pos = stripos($content, $keyword, $i);
                $match_keyword = substr($content, $str_pos, strlen($keyword));
                $content_new = str_replace($match_keyword, '<b>' . $match_keyword . '</b>', $content_new);
            }
            return $content_new;
        } else {
            return $content;
        }
    }

    /*
      public function adddummy(){
      SELECT * FROM `campaign_reports` WHERE `id` BETWEEN 1 AND 211 ORDER BY `id` DESC
      UPDATE `campaign_reports` SET `created`='2017-05-10 15:42:21' WHERE `id` BETWEEN 1 AND 211

      $browser = array('firefox','chrome', 'safari' );
      $opration_system  = array('windows','linux', 'mac' );
      $device  = array('desktop','iphone', 'android' );

      for($i=1; $i<=1567; $i++){
      $data = array(
      'bussiness_id' => 84,
      'campaign_id'	 => 445,
      'session_id'	 => 1,
      'browser'	 => $browser[1],
      'opration_system' => $opration_system[0],
      'device'	 => $device[0],
      'country'	 =>  'IN'
      );

      $this->db->insert('campaign_reports', $data);
      }

      } */

    /* 	public function adddummy(){
      // die('dsf');
      for($i=1; $i<=4316; $i++){
      $data = array(
      'user_id'=>0,
      'user_product_id'=>281,
      'bussiness_id' =>77,
      'campaign_id'=> 700,
      'session_id'=> 1111,
      'success_redirect'=>0,
      'success_lead'=>0,
      'success_share'=>0,
      'browser'	 => 'chrome',
      'opration_system' =>'windows',
      'device'	 => 'desktop',
      'country'	 =>  'us'
      );
      $this->db->insert('campaign_reports', $data);
      }
      } */

    public function updatedummy() {
        $date = "2018-04-11";
        $count = 81;
        $start = 8019;
        for ($i = $start; $i <= $start + $count; $i++) {
            $this->db->where('id', $i);
            $this->db->where('created >=', $date);
            $this->db->where('created <=', $date . ' 23:59:59');
            $this->db->set('success_redirect', 1);
            if ($i - $start < ($count / 3)) {
                $this->db->set('success_lead', 1);
            }
            if ($i - $start < ($count / 3.9)) {
                $this->db->set('success_share', 1);
            }
            $this->db->update('campaign_reports');
            echo $this->db->last_query() . '<br/>';
        }
    }

    public function updatedate() {
        $this->db->select('id');
        $this->db->where('bussiness_id', 77);
        $query = $this->db->get('campaign_reports');
        foreach ($query->result_array() as $key => $val) {
            $this->db->where('id', $val['id']);
            $this->db->set('id', $val['id'] + 10000);
            $this->db->update('campaign_reports');
        }
    }

    public function manual_insert_product_in_user_product() {
        //die('123');
        $business_id = 5;
        $user_id = 18;
        $this->db->where('business_id', $business_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('type', 'default');
        $query = $this->db->get('user_products');
        if (!$query->num_rows()) {
            $this->business_model->get_data($business_id, $user_id);
        }
    }

}
