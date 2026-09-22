<?php


defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH."libraries/cloudfront/vendor/autoload.php";
// use Aws\CloudFront\CloudFrontClient;
// use Aws\Exception\AwsException;
class AppDefault extends CI_Controller {

    public $setting;
    public $user_timezone, $user_date_format, $user_time_format, $user_dtformat, $user_language, $user_avatar;
    public $rs_notification;

    public function __construct() {
        parent::__construct();
        // echo $_SERVER['HTTP_HOST'];
        // print_r($_SERVER);
        // die;
        $this->business_id = $this->session->userdata('business_id');
        $this->libraryUrl = $this->config->item('cdn_url');
        $this->permission_msg = $this->config->item('permission_msg');
        $this->pln_upgrade_msg = $this->config->item('pln_upgrade_msg');
        
        $this->setSuperVaSession();
       
        $this->load->library('upload');
        $this->load->library('image_lib');

        date_default_timezone_set($this->config->item('time_reference'));

        $query = $this->db->get('tts_configuration', 1);
        $this->tts_config = $query->row();

        if ($this->session->has_userdata('logged_in')) {
            $this->user_id = $this->session->userdata('logged_in')['id'];
            $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
            $this->parent_id = $this->session->userdata('logged_in')['parent_id'];
            $this->ai_key = $this->config->item('open_ai_key');
            
            $this->all_team_privileges = $this->app_lib->user_privilege();
            $this->user_plan = $this->app_lib->get_user_plan();
            $this->all_plan_features = $this->user_plan['features'];
            $this->all_plan_fields_counts = $this->user_plan['fields'];
            $this->session->set_userdata('features', $this->all_plan_features);
            $this->session->set_userdata('fields_counts', $this->all_plan_fields_counts);
            
            // pr($this->all_plan_features);
            // pr($this->all_plan_fields_counts); die;
        }
 

        $this->db->select('userid,logo,sitetitle,status,theme_style,theme_color');
        $this->db->where('userid', $this->business_id);
        $query = $this->db->get('web_setting');
        if ($query->num_rows() == 1) {
            $result = $query->row_array();
            $this->web_logo = $this->config->item('assetsBasePath') . $result['logo'];
            
            $this->theme_style = $result['theme_style'] == 'dark' ? 'dark-theme-color' : '';
            $this->theme_color = $result['theme_color'] == 'default' ? '' : $result['theme_color'];
            
            // $this->web_sitetitle = $result['sitetitle'];
            //echo"<pre>";print_r($this->web_logo); //die;
        } else {
            $this->web_logo = $this->config->item('assetsBasePath') . "assets/images/db-logo.png";
             $this->theme_style = $result['theme_style'] == 'dark' ? 'dark-theme-color' : '';
              $this->theme_color = $result['theme_color'] == 'default' ? '' : $result['theme_color'];
            //  $this->web_sitetitle = $this->config->item('productName');
        }

        if ($this->input->get("session_check") || $this->input->get("test")) {
            echo "<pre>";
            print_r($this->session->userdata());
            pr($this->session->userdata('fields_counts')['employee_count']);
            pr($this->web_logo);
			echo "<h1>Team Permissions</h1>";
			print_r($this->all_team_privileges);
			echo "<h1>All Team Permissions</h1>";
			$this->Super_admin_privileges = $this->app_lib->all_user_privilege();
			print_r($this->Super_admin_privileges);
            die;
        }
 
        if ($this->input->get("phpinfo")) {
            echo phpinfo();
            die;
        }
    }

    public function checkFeatureInPlanArray($feature) {
        if ($this->all_plan_features) {
            if (in_array($feature, $this->all_plan_features)) {
                return true;
            }
        }
        return false;
    }

    public function getMediaVaID() {
        $this->db->where('niche', 78);
        $this->db->where('business_id', $this->business_id);
        $prompt = $this->db->get('prompts')->row();
        return $prompt->id;
    }

    /* Function to load view */

    public function loadView($page, $data = []) {

// 		$domain_data = explode(".",$_SERVER['HTTP_HOST']);
// 		$subdomain = current($domain_data);
        $businessData = $this->db->where('id', $this->business_id)->get('business')->row();
        $subdomain = $businessData->title;
        if ($subdomain == 'www') {
            $subdomain = 'Workspace List';
        }

        $this->getBusinessList();
        // $data['logged_in'] = $this->session->userdata('logged_in');
        $data['team_privileges'] = $this->all_team_privileges;
        $data['media_id'] = $this->getMediaVaID();
        $data['businessList'] = $this->config->item('businessList');
        $data['current_subdomain'] = $subdomain;
        $data['base_url'] = $this->config->item('base_url');
        $data['assetsBasePath'] = $this->config->item('assetsBasePath');
        $data['assetsPath'] = $this->config->item('assetsPath');
        $data['assetsFolder'] = $this->config->item('assetsTemplatePath');
        $data['uploadPath'] = $this->config->item('uploadPath');
        $data['web_logo'] = $this->web_logo;
        $data['theme_style'] = $this->theme_style;
        $data['theme_color'] = $this->theme_color;
        $data['remainCredit'] = $this->userRemainCredit();
        ;
        $data['package_plan_ids'] = $this->getPlanIds();

        $this->db->select('role');
        $this->db->where('owner_id', $this->owner_id);
        $query = $this->db->get('tbl_user');

        $data['userRoles'] = $query->result_array();


        if (empty($data['footer_unactive'])) {
            $data['footer_unactive'] = 'yes';
        }

        $this->load->view($this->config->item('template') . 'header', $data);
        $this->load->view($this->config->item('template') . $page, $data);
        if ($data['footer_unactive'] != 'no') {
            $this->load->view($this->config->item('template') . 'footer', $data);
        }
        // $this->load->view($this->config->item('template') . 'common-modal', $data);
    }

    /* Function to redirect user, if already logged in */

    public function checkAlreadyLogin() {

        if ($this->session->userdata('logged_in')) {
            if ($this->input->is_ajax_request()) {
                $output['redirect'] = base_url('dashboard');
                echo json_encode($output);
                die();
            } else {
                redirect(base_url() . "dashboard");
            }
        } else {

            //Not logged in
            $output['domainurl'] = $_SERVER['HTTP_HOST'];
            $domain_data = explode(".", $_SERVER['HTTP_HOST']);
            $subdomain = current($domain_data);
            $has_subdomain_url = $this->check_business_exist($subdomain);

// 			if($has_subdomain_url){
// 				$this->Fe_common_model->redirectToDashboard();
// 			}
            //Custom Domain Start
            if ($domain_data[0] == 'www') {
                if ($this->config->item('productSite') != ($domain_data[1] . "." . $domain_data[2])) {
                    redirect(base_url('dashboard'));
                }
            } else {
                if ($this->config->item('productSite') != ($domain_data[0] . "." . $domain_data[1])) {
                    $url = "https://www";
                    foreach ($domain_data as $key => $value) {
                        $url = $url . "." . $value;
                    }
                    $url = $url . "/dashboard";
                    redirect($url);
                }
            }
            //Custom Domain End
        }
    }

    public function check_business_exist($domain) {
        if ($domain != 'www') {
            $this->db->select('id,user_id,domain,title,color_scheme,logo,fevicon,banner,fb_messanger_status,fb_pageid');
            $this->db->where('domain', $domain);
            $query = $this->db->get('business');
            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                false;
            }
        } else {
            //custum domain setting
            $domain_data = explode(".", $_SERVER['HTTP_HOST']);
            // if($this->config->item('productSite')!=($domain_data[1].".".$domain_data[2])){
            // $this->Common_Model->checkCustomDomainAndRedirectToFrontEnd($domain_data[1].".".$domain_data[2]);
            // }

            if ($domain_data[0] == 'www') {
                if ($this->config->item('productSite') != ($domain_data[1] . "." . $domain_data[2])) {
                    $this->Common_Model->checkCustomDomainAndRedirectToFrontEnd($domain_data[1] . "." . $domain_data[2]);
                }
            } else {
                if ($this->config->item('productSite') != ($domain_data[0] . "." . $domain_data[1])) {
                    $this->Common_Model->checkCustomDomainAndRedirectToFrontEnd($domain_data[0] . "." . $domain_data[1]);
                }
            }
            //Custom Domain End
        }

        return false;
    }

    /* Function to redirect user, if already logged out */

    public function checkAlreadyLogout() {
        if (!$this->session->has_userdata('logged_in')) {
            $current_domain = current(explode('.', $_SERVER['HTTP_HOST']));
            redirect(str_replace($current_domain, 'www', base_url('login')));
            $redirect_url = str_replace($current_domain, 'app', base_url('login'));
            $redirect_url = base_url() . 'login';
            if ($this->input->is_ajax_request()) {
                $output['redirect'] = $redirect_url;
                echo json_encode($output);
                die();
            } else {
                redirect($redirect_url);
            }
        } else {

        }
    }

    Public function checkSubscription() {
        $owner_id = $this->session->userdata('logged_in')["owner_id"];
        $data = $this->Common_Model->getSingleRowFromTable('tbl_package_purchase', array('user_id' => $owner_id, 'status' => 'active'));
        if (!isset($data[0])) {
            $flashdata['error'] = array('message' => "Please Upgrade your Subscription Plan", 'type' => 'flash');
            $this->session->set_flashdata('message', json_encode($flashdata));
            //redirect(site_url()."subscription?expire=true");
            if ($this->input->is_ajax_request()) {
                $output['redirect'] = site_url('subscription') . "?expire=true";
                echo json_encode($output);
                die();
            } else {
                redirect(site_url() . "subscription?expire=true");
            }
        }
    }

    protected function crudValidationRules() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('currentPage', 'Current Page', 'trim|required|numeric');
        $this->form_validation->set_rules('recordPerPage', 'Number of Records', 'trim|required|numeric');
        $this->form_validation->set_rules('search', 'Search', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('sort', 'Sort', 'trim|required|in_list[ASC,DESC]');
        $this->form_validation->set_rules('sortField', 'Sort Field', 'trim|required|in_list[title,description,created,status,like_count,view_count,category_title,conversion,name,email,message,subject,activity,link,category_name,category_type,auto_type]');
        /* $this->form_validation->set_rules('fromDate', 'From Date', 'trim|regex_match[/[0-9]\-/]');
          $this->form_validation->set_rules('toDate', 'To Date', 'trim|regex_match[/[0-9]\-/]'); */
    }

    public function validateFolderDirectory($folderName, $imageName = '') {
        $owner_id = $this->session->userdata("logged_in")["owner_id"];
        $ownerDirectoryName = './assets/uploads/users/' . $owner_id;
        if (!is_dir($ownerDirectoryName)) {
            mkdir($ownerDirectoryName, 0755, true);
        }
        $subFolderDirectory = $ownerDirectoryName . "/" . $folderName;
        if (!is_dir($subFolderDirectory)) {
            mkdir($subFolderDirectory, 0755, true);
        }
    }

    public function read_url_data($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n<br />";
            $contents = '';
        } else {
            curl_close($ch);
        }

        if (!is_string($contents) || !strlen($contents)) {
            echo "Failed to get contents.";
            $contents = '';
        }

        return $contents;
    }

    public function uploadGenerationResult($url) {
        $extention = pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION);

        $file_name = time();
        $file = $file_name . '.' . $extention;
        $this->load->library('image_lib');

        $destinationDirectory = 'assets/uploads/users/' . $this->owner_id . '/' . $this->input->post("type") . '/';
        $this->validateFolderDirectory($this->input->post("type"));
        $temp_file_path = $destinationDirectory . $file;
        $file_data = $this->read_url_data($url);

        $file_size = strlen($file_data);
        $upload = file_put_contents($temp_file_path, $file_data);

        if ($upload) {
            $msg = $this->uploadAWS($temp_file_path);
        }
        return $temp_file_path;
    }

    public function uploadAWS($sourceFile, $destinationFile = "", $bucket = "viewagentai") {
        if ($this->config->item('islive') == 'off') {
            return true;
        }
        $this->load->model('default/Amazons3_Model');
        if ($destinationFile == '') {

            $destinationFile = $sourceFile;
        }
        $this->Amazons3_Model->putBucket($bucket);
        if (file_exists($destinationFile)) {
            if ($this->Amazons3_Model->putObjectFile($sourceFile, $bucket, $destinationFile)) {
                unlink($sourceFile);
                return array("status" => true, "message" => "Upload Success");
            } else {
                return array("status" => false, "message" => "error found");
            }
        } else {
            die("file not found");
        }
    }

    public function deleteObject($uri = '', $bucket = 'viewagentai') {
        if ($this->config->item('islive') == 'off') {
            return;
        }
        if ($uri == '') {
            return;
        }
        if ($this->config->item("server_delete") == 0) {
            unlink($uri);
            return;
        }

        $this->load->model('default/Amazons3_Model');
        $this->Amazons3_Model->deleteObject($bucket, $uri);
    }

     public function addLibraryImages($name,$folder_name) {
        if (!empty($_FILES[$name]['name'])) {
            
            // for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name'] = $_FILES[$name]['name'];
                $_FILES['file']['type'] = $_FILES[$name]['type'];
                $_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'];
                $_FILES['file']['error'] = $_FILES[$name]['error'];
                $_FILES['file']['size'] = $_FILES[$name]['size'];
                 
                $library_folder = $folder_name;
                $this->validateFolderDirectory($library_folder);
                $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id;
            
                $filename = rand(1, 100) . "_" . time();
                $config['file_name'] = $filename;
                $config['upload_path'] = $ownerDirectoryName . '/' . $library_folder . '/';
                $config['allowed_types'] = 'jpeg|png|jpg|mp3|wav|mpeg|mpg|m4v|mp4';
                
                //$this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $library_image_data = $this->upload->data();
                    $image_title = $_FILES['file']['name'];
                    $image_name = $library_image_data['file_name'];
                    $uploadFilePath = $ownerDirectoryName . '/' . $library_folder . '/' . $image_name;
                    $msg = $this->uploadAWS($uploadFilePath);
                    return $uploadFilePath;
                    //return  $this->upload_library_image($library_image_data, $uploadFilePath, $image_title,$folder_name);
                } else {
                    $output['data']['error'] = "<p class='form-error'>" . $this->upload->display_errors() . "</p>";
                     return $output;
                    die;
                }
            // }

            
        } else {
            $output['data']['error'] = "<p class='form-error'>Please select a image file.</p>";
        }
        // echo json_encode($output);
         return $output;
    }
    

    public function getBusinessList() {
        $this->db->select("last_business_id");
        $this->db->where('id', $this->user_id);
        $this->db->where('owner_id', $this->owner_id);
        $query = $this->db->get('tbl_user');
        $business_ids = array_column($query->result_array(), 'last_business_id');

        if ($this->user_id == $this->owner_id || $this->owner_id == 0) {
            $this->db->where('user_id', $this->user_id);
        } else {
            $this->db->where_in('id', $business_ids);
        }
        $businessData = $this->db->get('business b')->result_array();
        $this->config->set_item('businessList', $businessData);
    }

    public function checkassitant($assistant_id) {
        $this->db->where('id', $assistant_id);
        $this->db->where('business_id', $this->business_id);
        $data = $this->db->get('prompts')->row();
        // pr($this->db->last_query());
        // pr($data);
        // die;
        if (!empty($data)) {
            // if($data->status == 'off')
            // {
            //     $flashdata['error']['message'] = 'Va is Inactive';
            //     $flashdata['error']['type'] = 'flash';
            //     $this->session->set_flashdata('message', json_encode($flashdata));
            //     redirect($this->config->item("redirectMainUrl"));
            // }elseif($data->appoint_status == '0'){
            //     $flashdata['error']['message'] = 'Va is not Appointed';
            //     $flashdata['error']['type'] = 'flash';
            //     $this->session->set_flashdata('message', json_encode($flashdata));
            //     redirect($this->config->item("redirectMainUrl"));
            // }else{
            return true;
            // }
        } else {
            $flashdata['error']['message'] = 'Something went wrong';
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect($this->config->item("redirectMainUrl"));
        }
    }

    public function createVaForBusiness($business_id) {

        // $this->db->where('main_category_id', 11);
        // $this->db->or_where('main_category_id', 12);
        // $prompt_category = $this->db->get('prompt_category')->result_array();
        
        $this->db->where_in('main_category_id', [11, 12, 13, 14]);
        $prompt_category = $this->db->get('prompt_category')->result_array();
        
        // echo $this->db->last_query();
        // pr("$prompt_category"); die;
        
        foreach ($prompt_category as $key => $value) {
            $prompt = "Hello! I am your " . $value['category_name'] . " AI assistant. How can I assist you today? . I am here to help you chat. What can I help you with today?";
            // $path = ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? 'default/images/default_profile.png':  $this->session->userdata('logged_in')['profile_pic'];
            $insert_data = array(
                "business_id" => $business_id,
                "user_id" => $business_id,
                "niche" => $value['id'],
                "language_id" => 'en',
                "color" => '#212529',
                "assistant_image" => '',
                'app' => '',
                'status' => 'yes',
                'prompt' => $prompt,
                'appoint_status' => 1,
                "purpose" => 'chat',
                'assistant_status' => 'default',
            );

            if ($value['custom'] == 1) {
                $insert_data["purpose"] = "super_va";
                $insert_data["assistant_status"] = "super_va";
            }

            $this->db->insert('prompts', $insert_data);
            $last_id = $this->db->insert_id();
            $base_url = $this->config->item('assetsBasePath');
            $src_url = $base_url . "chat/chat.js";
            $generate = "<script src=$base_url" . "chat/chat.js id=$last_id user_id=$business_id> </script>" . "\n";
            $updateArray = array(
                'script_tag' => $generate,
            );
            $this->db->where('id', $last_id);
            $this->db->update('prompts', $updateArray);
        }
        return true;
    }

    public function aiGenerationKey() {
        $this->db->where('business_id', $this->business_id);
        $this->db->where('autoresponder_id', 40);
        $this->db->where('status', '1');
        $data = $this->db->get('users_autoresponder_settings')->row();
        if (!empty($data)) {
            return false;
        }
        return true;
    }

    public function ownerAikey() {

        $this->db->where('id', $this->user_id);
        $userData = $this->db->get('tbl_user')->row();

        $api_key = '';
        $this->db->where('business_id', $this->business_id);
        $this->db->where('autoresponder_id', 35);
        $this->db->where('status', '1');
        $data = $this->db->get('users_autoresponder_settings')->row();
        if (!empty($data)) {
            $api_key = json_decode($data->credentials)->api_key;
            $result = array(
                'status' => 'nocount',
                'key' => $api_key
            );
            return $result;
        } else {
            if ($userData->credit > 0) {
                $open_ai_key = $this->ai_key;
                $result = array(
                    'status' => 'count',
                    'key' => $open_ai_key
                );
                return $result;
            } else {
                $result = array(
                    'status' => 'nocount',
                        // 'key' => $api_key
                );
            }
        }
        // if($userData->credit <= 0){
        //     $result = array(
        //         'status' => 'nocount',
        //         'key' => $api_key
        //       );
        // }
        return $result;
    }

    public function ownerAikeyByUserIdAndBusinessId($user_id, $business_id) {
        $this->db->where('id', $user_id);
        $userData = $this->db->get('tbl_user')->row();
        $api_key = '';
        $this->db->where('business_id', $business_id);
        $this->db->where('autoresponder_id', 35);
        $this->db->where('status', '1');
        $data = $this->db->get('users_autoresponder_settings')->row();
        if (!empty($data)) {
            $api_key = json_decode($data->credentials)->api_key;
            $result = array(
                'status' => 'nocount',
                'key' => $api_key
            );
            return $result;
        } else {
            if ($userData->credit > 0) {
                $open_ai_key = $this->ai_key;
                $result = array(
                    'status' => 'count',
                    'key' => $open_ai_key
                );
                return $result;
            } else {
                $result = array(
                    'status' => 'nocount',
                        // 'key' => $api_key
                );
            }
        }
        return $result;
    }

    public function setSuperVaSession() {
        $this->db->select('prompts.id as super_promptid,prompts.text,prompt_category.*');
        $this->db->where('assistant_status', 'super_va');
        $this->db->where('business_id', $this->business_id);
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');
        $query = $this->db->get('prompts');
        if ($query->num_rows() > 0) {
            $this->session->set_userdata('super_va', $query->row());
        } else {
            return false;
        }
    }

    public function userRemainCredit() {
        $this->db->where('id', $this->session->userdata('logged_in')['id']);
        $userData = $this->db->get('tbl_user')->row();
        return $userData->credit;
    }
    public function newLeadsCount() {
        $this->db->select('count(*) as count_rows');
        $this->db->where('business_id', $this->business_id);
        $this->db->where('lead_view_status', 0);
        $query = $this->db->get('autoresponder_lead_data');
        //$str = $this->db->last_query();
        //echo $str;
        $cnt = $query->row_array();
        return $cnt['count_rows']; 
    }

    // public function userRemainCredit()
    // {
    //     $userData = null;
    //     $logged_in_data = $this->session->userdata('logged_in');
    //     if ($logged_in_data['user_role'] === 'team') {
    //           $owner_id = $logged_in_data['owner_id'];
    //           $this->db->where('id', $owner_id);
    //           $userData = $this->db->get('tbl_user')->row();
    //     } else {
    //         $userData = $this->db->get_where('tbl_user', array('id' => $logged_in_data['id']))->row();
    //     }
    //     return $userData->credit;
    // }




    public function getPlanIds($owner_id = 0) {

        if ($owner_id == 0) {

            $owner_id = $this->session->userdata("logged_in")["owner_id"];
        }

        $this->db->select("package_id");

        $this->db->where("status", 'active');

        $this->db->where("user_id", $owner_id);

        $query = $this->db->get("tbl_package_purchase");

        $result = $query->result_array();

        //echo $this->db->last_query();die;

        $pacakge_id = array_column($result, 'package_id');

        return $pacakge_id;
    }

    public function password_strength($field, $strength) {
        $res = my_password_strength($field, $strength);
        if ($res['status']) {
            $status = TRUE;
        } else {
            $status = FALSE;
            $this->form_validation->set_message('password_strength', $res['error']);
        }
        return $status;
    }

    public function pineconeCrediential($business_id) {
        $this->db->where('business_id', $business_id);
        $this->db->where('autoresponder_id', 39);
        $this->db->where('status', '1');
        $data = $this->db->get('users_autoresponder_settings')->row();
        return $data;

        if ($data) {
            return json_decode($data->credentials);
        }
    }

}
