<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/chat/autoload.php';

require('AppDefault.php');
require_once APPPATH . 'libraries/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;


class Integration_controller extends AppDefault
{
	public function __construct()
	{
		parent::__construct();
		$logged_in = $this->session->userdata('logged_in');
		$this->user_id = $logged_in['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business_id = $this->session->userdata('business')['id'];
		$this->checkAlreadyLogout();
		$this->Common_Model->checkSubDomain();
		$this->model_folder = $this->config->item('template');
		$this->load->model($this->model_folder . "Integration_Model");
		$this->load->model($this->model_folder . "Settings_integration_Model");
		$this->aweber_consumerKey = config_item('aweber_consumer_key');
        $this->aweber_consumerSecret = config_item('aweber_consumer_secret');
        $this->view_path = base_url('integration');
	}

	public function add()
	{
	    $data['title'] = 'Integration';
		$this->loadView('integration/integration',$data);
	}

	public function index()
	{
	     $output = array();
        $output['error'] = "";
        $output["error_title"] = "";
        $output["active_pos"] = 0;

        //Autoresponders
        $output['autoresponder_profile'] = $this->Integration_Model->getAutoresponderProfile();
        $output['autoresponder_values'] = $this->Integration_Model->getAutoresponderValues($this->user_id, $this->business_id);
		 // pr($output);
        // die;
        //Social
        $output['social_profiles'] = $this->Integration_Model->getSocialProfiles();
        $output['user_social_settings'] = $this->Integration_Model->getuser_social_settings();

        //$output['ipn_secret_key'] = $this->Common_Model->getSingleFieldFromAnyTable('ipn_secret_key', 'id', $this->business_id, 'business');
        $output['clickbank_badge_code'] = '';
        $output['clickbank_ipn_secret_key'] = '';
        $output['jvzoo_ipn_secret_key'] = '';
        $output['paydotcom_ipn_secret_key'] = '';
        $output['warriorplus_ipn_secret_key'] = '';
        $where_ipn['business_id'] = $this->business_id;
        $all_ipn_secret_keys = $this->Common_Model->getSingleRowFromTable('business_ipn_keys', $where_ipn);
        if($all_ipn_secret_keys){
            foreach($all_ipn_secret_keys as $key=>$value){
                $output[$value['market_place'].'_ipn_secret_key'] = $value['ipn_secret_key'];
                $output[$value['market_place'].'_badge_code'] = $value['badge_code'];
            }
        }

        $output['clickbank_ipn_url'] = base_url() . 'ipn-clickbank/' . $this->business_id;
        $output['jvzoo_ipn_url'] = base_url() . 'ipn-jvzoo/' . $this->business_id;
        $output['paydotcom_ipn_url'] = base_url() . 'ipn-paydotcom/' . $this->business_id;
        $output['warrior_plus_ipn_url'] = base_url() . 'ipn-warrior-plus/' . $this->business_id;
        $output['paypal_ipn_url'] = base_url() . 'ipn-paypal/' . $this->business_id;

        $where_custom_domain['business_id'] = $this->business_id;
        $custom_domain_settings = $this->Common_Model->getSingleRowFromTable('custom_domain_settings', $where_custom_domain);
        if(isset($custom_domain_settings[0])){
            $output['custom_domain'] = $custom_domain_settings[0]['custom_domain'];
        }else{
            $output['custom_domain'] = '';
        }
       
        $where_dotcomPal['business_id'] = $this->business_id;
        $custom_dotcompal_settings = $this->Common_Model->getSingleRowFromTable('dcp_integration', $where_dotcomPal);
      
        if(isset($custom_dotcompal_settings[0])){
            $output['dotcompal_api'] = $custom_dotcompal_settings[0]['api_key'];
        }else{
            $output['dotcompal_api'] = '';
        }

        $where_dotcomPal['business_id'] = $this->business_id;
        $paypal_credential_settings = $this->Common_Model->getSingleRowFromTable('paypal_integration', $where_dotcomPal);
        
		$this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('youtube_access_token');

		if($query->num_rows()>0){
			$yt_access_token = $query->row_array()['access_token'];
			$output['yt_access_token'] = json_decode($yt_access_token);
		}
      
        if(isset($paypal_credential_settings[0])){
            $output['client_id'] = $paypal_credential_settings[0]['client_id'];
            $output['client_secret'] = $paypal_credential_settings[0]['secret'];
        }else{
            $output['client_id'] = '';
            $output['client_secret'] = '';
        }
        
        $this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('instagram_access_token');
		

		if($query->num_rows()>0){
			$ig_access_token = $query->row_array()['access_token'];
			$fb_page_id = $query->row_array()['fb_page_id'];
			$id = $query->row_array()['id'];
			$output['id'] = $id;
			$output['ig_access_token'] = $ig_access_token;
			$output['fb_page_id'] = $fb_page_id;
		}
		
        $this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('facebook_access_token');
		if($query->num_rows()>0){
			$fb_user_token = $query->row_array()['user_access_token'];
			$fb_page_token = $query->row_array()['page_id'];
			$fb_app_id = $query->row_array()['app_id'];
			$fb_client_secret = $query->row_array()['client_secret'];
			$id = $query->row_array()['id'];
			$output['id'] = $id;
			$output['fb_user_token'] = $fb_user_token;
			$output['fb_page_token'] = $fb_page_token;
			$output['fb_app_id'] = $fb_app_id;
			$output['fb_client_secret'] = $fb_client_secret;
		}
		

        $output['all_plan_features'] = $this->all_plan_features;

        if ($_POST) {
            // pr($_POST);
            // die;
            $profile_id = $this->input->post('id', TRUE);
            $autoresponder_display_title = $this->input->post('autoresponder_display_title', TRUE);
            $autoresponder_title = $this->input->post('autoresponder_title', TRUE);
            $credentials = $this->Integration_Model->getCredentialFieldsDetail($profile_id); // get credential fields details for particular response
            $output["active_pos"] = $this->input->post('active_pos');
            if(!empty($this->input->post('active_tab')))
            {
                $output["active_tab"] = $this->input->post('active_tab');
            }elseif(!empty($this->input->post('search'))){
                $output["active_tab"] = $this->input->post('tabed');
                $output["search"] = $this->input->post('search');
            }
            $this->session->set_userdata('active_pos', $output["active_pos"]);
            $this->session->set_userdata('active_tab', $output["active_tab"]);
            if ($autoresponder_title == 'constantcontact') {
                $this->session->set_flashdata('constantcontact_pos', $output["active_pos"]);
            }
            // pr($_POST);
            foreach ($credentials as $credential) { // validate credential fields
            // pr($credential);
            // pr($credential->field_name);
            // die;
                $this->form_validation->set_rules($credential->field_name, $credential->display_title, 'required');
            }
            if ($this->form_validation->run()) {

                $credential_value_arr = array();

                foreach ($credentials as $key => $credential) {
                    if ($autoresponder_title == 'infusionsoft') {
                        $credential_value_arr["redirect_url"] = $this->view_path;
                    }
                    $name = $credential->field_name;
                    $credential_value_arr[$name] = $this->input->post($name);
                }

                $profile_id = $this->input->post('id', TRUE);
                $credential_value = json_encode($credential_value_arr);
                $this->getresponder_type = $autoresponder_title;
                $this->session->set_userdata("autoresponder_title", $autoresponder_title);
                if ($autoresponder_title == 'infusionsoft') {
                    $this->session->set_userdata('active_pos', $this->input->post('active_pos'));
                    $this->session->set_userdata('active_tab', $this->input->post('active_tab'));
                    $this->session->set_userdata('autoresponder_display_title', $autoresponder_display_title);
                    $this->session->set_userdata('profile_id', $this->input->post('id'));
                    $this->session->unset_userdata("infusionsoft");
                    $this->session->set_userdata("infusionsoft", $credential_value_arr);
                }
                $validateresponder = $this->validateResponder($autoresponder_title);
                //$this->Common_Model->set_user_logs('integration setting save', $autoresponder_title .' integration save');
                if ($validateresponder == 1) {
                    $insert = array('user_id' => $this->user_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value);
                    $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->user_id, $this->business_id);
                    $this->Integration_Model->insertAutoresponderSettings($insert, $profile_id);
                    $flashdata['success']['message'] = $autoresponder_display_title . ' Integrated Successfully';
                    $flashdata['success']['type'] = 'flash';
                    $this->session->set_flashdata('message_title', $autoresponder_title);
                    $this->session->set_flashdata('message', json_encode($flashdata)); //form submit
                    // if ($this->session->userdata("redirect_url")) {
                    //     $redirect = $this->session->userdata("redirect_url");
                    //     $this->session->unset_userdata("redirect_url");
                    //     redirect($redirect);
                    // }
                    redirect(base_url('integration'));
                } else {
                    $output["error"] = "Enter Valid " . $autoresponder_display_title . " Credentials";
                    $output["error_title"] = $autoresponder_title;
                }
            } else {
                $output["error"] = "Enter Valid " . $autoresponder_display_title . " Credentials";
                $output["error_title"] = $autoresponder_title;
            }
        }
        //if (isset($_REQUEST['scope']) && isset($_REQUEST['code']) && $this->session->userdata("autoresponder_title") != 'infusionsoft') {
        if (isset($_REQUEST['code']) && $this->session->has_userdata("webinar_integration")) {
            $this->validate_GoTOWebinar();
        } elseif (($this->session->userdata("autoresponder_title") == 'infusionsoft') && (isset($_REQUEST['code']) || isset($_REQUEST['error']) )) {
            $this->validate_Infusionsoft();
        }
        // pr($output);
        // die;
        //$user_plan=$this->app_lib->get_user_plan();
        //$output['user_plan_features'] = $user_plan['features'];
		$this->loadView('integration/add_integration',$output);
	}

	public function addIntegration()
	{
		$post_data = json_decode(file_get_contents('php://input'), true);
		$validateresponder = $this->validate_Getresponse();
		if ($validateresponder == 1) {
			$insertArray = array(
				'autoresponder_id' => 4,
				'user_id' => $this->user_id,
				'credentials' => json_encode($post_data)
			);
			$this->db->insert('users_autoresponder_settings', $insertArray);
			$result = array(
				'status' => 1,
				'msg' => 'Success'
			);
		} else {
			$result = array(
				'status' => 0,
				'msg' => 'Enter Valid Get Resoponse Credentials'
			);
		}

		echo json_encode($result);
		die;
	}

	public function validate_Getresponse()
	{
// 		$post_data = json_decode(file_get_contents('php://input'), true);
		$api_key = $_POST['api_key'];
		try {
			$api_url = 'https://api.getresponse.com/v3';
			require_once APPPATH . 'libraries/autoresponder/getresponse-api-php/src/GetResponseAPI3.class.php';
			$client = new GetResponse($api_key, $api_url);
			$response = $client->accounts();
			if (empty($response) || empty($response->accountId)) {
				return 0;
			} else {
				return 1;
			}
		} catch (RuntimeException $e) {
			return 0;
		}
	}

	public function autoresponder_forms() {
        $autoresponder_id = isset($_POST['autoresponder_id']) ? $_POST['autoresponder_id'] : 10;
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['id']; 
        $list = $this->Settings_integration_Model->getResponderList($autoresponder_id, $user_id); 
        echo json_encode($list);
    }
    
    public function validateResponder($responder_type) {

        if ($responder_type == 'icontact') {
            return $this->validate_Icontact();
        }
        if ($responder_type == 'mailchimp') {
            return $this->validate_MailChimp();
        }
        if ($responder_type == 'getresponse') {
            return $this->validate_Getresponse();
        }
        if ($responder_type == 'benchmark') {
            return $this->validate_Benchmark();
        }
        if ($responder_type == 'campaignmonitor') {
            return $this->validate_CampaignMonitor();
        }
        if ($responder_type == 'sendlane') {
            return $this->validate_Sendlane();
        }
        if ($responder_type == 'activecampaign') {
            return $this->validate_ActiveCampaign();
        }
        if ($responder_type == 'constantcontact') {
            return $this->validate_ConstantContact();
        }
        if ($responder_type == 'aweber') {
            return $this->validate_Aweber();
        }
        if ($responder_type == 'mailzingo') {
            return $this->validate_Mailzingo();
        }
        if ($responder_type == 'gotowebinar') {
            return $this->validate_GoTOWebinar();
        }
        if ($responder_type == 'mysticmailer') {
            return $this->validate_MysticMailer();
        }
        if ($responder_type == 'oninbox') {
            return $this->validate_OnInbox();
        }
        if ($responder_type == 'inboxingpro') {
            return $this->validate_inboxingpro();
        }
        if ($responder_type == 'interspire') {
            return $this->validate_Interspire();
        }
        if ($responder_type == 'mailprimo') {
            return $this->validate_Mailprimo();
        }
        if ($responder_type == 'leadprimo') {
            return $this->validate_Leadprimo();
        }
        if ($responder_type == 'mailwhizz') {
            return $this->validate_mailwhizz();
        }
        if ($responder_type == 'salesforceiq') {
            return $this->validate_salesforceiq();
        }
        if ($responder_type == 'salesforce') {
            return $this->validate_salesforce();
        }
        if ($responder_type == 'infusionsoft') {
            //echo $responder_type;
            return $this->validate_Infusionsoft();
        }
        if ($responder_type == 'smartmailer') {
            return $this->validate_smartmailer();
        }
        if ($responder_type == 'hubspot') {
            return $this->validate_hubspot();
        }
        if ($responder_type == 'convertkit') {
            return $this->validate_convertkit();
        } 
		if ($responder_type == 'sendpulse') {
            return $this->validate_sendpulse();
        }
        if ($responder_type == 'xmails') {
            return $this->validate_xmails();
        }
        if ($responder_type == 'openai') {
            return $this->validate_openai();
        }        
        if ($responder_type == 'stable_diffusion') {
            return $this->validate_stable_diffusion();
        }
        if($responder_type == 'pabbly'){
			return $this->validate_pabbly();
		}
        if ($responder_type == 'Pinecone') {
             return 1;
        }

    }

    public function validate_pabbly(){
        $bearer_token = $this->input->post('bearer_token');
        
        $curl = curl_init();
        
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://emails.pabbly.com/api/subscribers-list",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        CURLOPT_HTTPHEADER => array(
        "authorization: Bearer " . $bearer_token
        ),
        ));
        
        $response = curl_exec($curl);
        
        $exec_var = json_decode($response);
        
        $err = curl_error($curl);
        
        curl_close($curl);
        
        
            if ($exec_var->status == 'error') {
                return 0;
            } else {
                // $this->add_users($bearer_token,$name,$email);
                echo "success";
                return 1;
            }
    }
    
    public function validate_stable_diffusion(){
        $this->load->library('vision_lib');
        $result = $this->vision_lib->checkApiKey();
        $result = json_decode($result,true);
        if($result['status'] == "success"){
            return 1;
        }
        return 0;
    }
    
    
    // <openai key removed - see config/secrets.php>
    public function old_validate_openai()
    {
        //echo $this->input->post('api_key'); die;
        $apiKey=urlencode(trim($this->input->post('api_key')));
        $url = 'https://api.openai.com/v1/models'; // Test endpoint
        
        $headers = [
            "Authorization: Bearer $apiKey"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
      // echo $response; die;
        if ($httpStatus === 200) {
             return 1;
        } elseif ($httpStatus === 401) {
             return 0;
          // return false; // Unauthorized (invalid key)
        } else {
            return 0;
          // throw new Exception("Error connecting to OpenAI: HTTP status $httpStatus");
        }
    
      // echo "lucky"; die;
    
      // $open_ai = new OpenAi(urlencode(trim($this->input->post('api_key'))));

    //   $api_key = urlencode(trim($this->input->post('api_key'))); 
    //   $api_url = 'https://api.openai.com/v1/engines/davinci/completions';
    
      // $history[] = ['role' => 'user', 'content' => "This is a test prompt."];
      

        // $opt = [
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => $history,
        //     'temperature' => 1.0,
        //     'max_tokens' => 10,
        //     'frequency_penalty' => 0,
        //     'presence_penalty' => 0,
        // ];
        // $complete = $open_ai->chat($opt);
      
        // $data = json_decode($complete, true);
        
        
        // Set up cURL for a POST request
        // $ch = curl_init($api_url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send the data as JSON
        // curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //     'Authorization: Bearer ' . $api_key,
        //     'Content-Type: application/json', // Specify JSON content type
        // ]);
        
        // // Make the POST request to OpenAI
        // $response = curl_exec($ch);
        // $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
    //   print_r($response);die;

        // Check if the response is valid
        // if(!empty($data) && !empty($data['choices'][0]['message']['content'])){
        //      return 1;
        // }else{
        //      return 0;
        // }
        
    }
    
    public function validate_openai(){
        $apiKey=urlencode(trim($this->input->post('api_key')));
        $url = "https://api.openai.com/v1/models"; 
        $headers = [
            "Authorization: Bearer $apiKey"
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpCode === 200) {
            return 1;
        } else {
             return 0;
        }
    }
    
    public function validate_xmails(){
		 			
		$APIKey = urlencode(trim($this->input->post('api_key'))); 
		$APIUrl = "https://www.xmails.io/primo-api";
		try
		{ 	
			$data = json_decode(file_get_contents($APIUrl."?action=authentication_check&api_key=".$APIKey), 1);
			if(isset($data['success']) && $data['success']==true){ 
				return 1;
			} 
			else {
				return 0;
			}
			
		} 
		catch (XML_RPC2_FaultException $e){
			return 0;
		}
	}

    public function validate_convertkit() {
        $apiKey = $this->input->post('api_key');
        try {
            $ch = curl_init();
            $curlConfig = array(
                CURLOPT_URL => "https://api.convertkit.com/v3/forms?api_key=" . $apiKey,
                CURLOPT_POST => false,
                CURLOPT_RETURNTRANSFER => true,
            );
            curl_setopt_array($ch, $curlConfig);
            curl_exec($ch);
            $statusCode = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($statusCode == 200) {
                return 1;
            }
            return 0;
        } catch (Exception $e) {
            return 0;
        }
    }
	public function validate_sendpulse() {
        $client_id = $this->input->post('client_id');
        $client_secret = $this->input->post('client_secret');
        $autoresponder_title = $this->session->userdata('autoresponder_title');
		$profile_id = $this->input->post('id'); 


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://api.sendpulse.com/oauth/access_token");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			"grant_type=client_credentials&client_id=$client_id&client_secret=$client_secret");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close ($ch);
			$credential_value = json_decode($result);
            $credential_value->client_id = $client_id;
            $credential_value->client_secret = $client_secret;
			if(!isset($credential_value->access_token)){
                $flashdata['error']['message'] = 'Invalid Credientials';
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('active_tab', 'sendpulse');
                $this->session->set_flashdata('active_pos', $output["active_pos"]);
                $this->session->set_flashdata('message_title', $autoresponder_title);
                $this->session->set_flashdata('message', json_encode($flashdata)); 
                redirect($this->view_path);
            }
			$credential_value = json_encode($credential_value);
			$insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
            $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
            $this->Integration_Model->insertAutoresponderSettings($insert,$profile_id);

            
            $flashdata['success']['message'] = 'SendPulse credentials added successfully';
            $flashdata['success']['type'] = 'flash';
            $this->session->set_flashdata('active_tab', $this->input->post('active_tab'));
            $this->session->set_flashdata('active_pos', $this->input->post('active_pos'));
            $this->session->set_flashdata('message_title', $autoresponder_title);
            $this->session->set_flashdata('message', json_encode($flashdata)); //form submit
            redirect($this->view_path);
			
			
}
	/*
			$credential_value = json_decode($oauth);
            $credential_value->api_key = $this->session->userdata('api');
            $credential_value->consumer_secret = $this->session->userdata('consumer_secret');
            $profile_id = $this->session->userdata('profile_id');
            $this->session->unset_userdata('api');
            $this->session->unset_userdata('consumer_secret');
            $this->session->unset_userdata('profile_id');
            $this->session->unset_userdata('autoresponder_title');

            if(!isset($credential_value->access_token)){
                $flashdata['error']['message'] = 'Invalid Credientials';
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('active_tab', 'webinar');
                $this->session->set_flashdata('active_pos', $output["active_pos"]);
                $this->session->set_flashdata('message_title', $autoresponder_title);
                $this->session->set_flashdata('message', json_encode($flashdata)); 
                redirect($this->view_path);
            }
            
            $credential_value = json_encode($credential_value);
            
            $autoresponder_title = $this->session->userdata('autoresponder_title');

            

            $insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
            $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
            $this->Integration_Model->insertAutoresponderSettings($insert,$profile_id);
            
            $flashdata['success']['message'] = 'GoToWebinar credentials added successfully';
            $flashdata['success']['type'] = 'flash';
            $this->session->set_flashdata('active_tab', 'webinar');
            $this->session->set_flashdata('active_pos', $output["active_pos"]);
            $this->session->set_flashdata('message_title', $autoresponder_title);
            $this->session->set_flashdata('message', json_encode($flashdata)); //form submit
            redirect($this->view_path);
	*/

    public function validate_hubspot() {
        $key = $this->input->post('hapikey');
        try {
            $endpoint = "https://api.hubapi.com/integrations/v1/me?hapikey=" . $key;
            $ch = @curl_init();
            @curl_setopt($ch, CURLOPT_URL, $endpoint);
            @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            @curl_setopt($ch, CURLOPT_USERAGENT, array('Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'));
            @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            @curl_exec($ch);
            $statusCode = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            @curl_close($ch);
            if ($statusCode == 200) {
                return 1;
            }
            return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function validate_smartmailer() {
        $PublicKey = $this->input->post('public_key');
        $PrivateKey = $this->input->post('private_key');
        require_once(APPPATH . 'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php');
        try {
            MailWizzApi_Autoloader::register();
            $config = new MailWizzApi_Config(array(
                'apiUrl' => 'https://app.smartmailer.com/api/index.php',
                'publicKey' => $PublicKey,
                'privateKey' => $PrivateKey,
                'components' => array('cache' => array(
                        'class' => 'MailWizzApi_Cache_File',
                        'filesPath' => './application/libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
            MailWizzApi_Base::setConfig($config);
            $endpoint = new MailWizzApi_Endpoint_Lists();
            $response = $endpoint->getLists();
            if (isset($response->body["status"]) && $response->body["status"] == 'success') {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function validate_Leadprimo() {

        $APIKey = urlencode(trim($this->input->post('api_key')));
        $APIUrl = "https://www.leadprimo.com/primo-api";
        try {
            $data = json_decode(file_get_contents($APIUrl . "?action=authentication_check&api_key=" . $APIKey), 1);
            if (isset($data['success']) && $data['success'] == true) {
                return 1;
            } else {
                return 0;
            }
        } catch (XML_RPC2_FaultException $e) {
            return 0;
        }
    }

    public function validate_Mailprimo() {

        $APIKey = urlencode(trim($this->input->post('api_key')));
        $APIUrl = "https://app.mailprimo.com/primo-api";
        try {
            $data = json_decode(file_get_contents($APIUrl . "?action=authentication_check&api_key=" . $APIKey), 1);
            // pr($data);
            // die;
            if (isset($data['success']) && $data['success'] == true) {
                return 1;
            } else {
                return 0;
            }
        } catch (XML_RPC2_FaultException $e) {
            return 0;
        }
    }

    public function validate_Icontact() {
        $responder_type = $this->getresponder_type;
        $apikey = $this->input->post('api_key');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        require_once APPPATH . 'libraries/autoresponder/iContactApi.php';

        iContactApi::getInstance()->setConfig(array(
            'appId' => $apikey,
            'apiPassword' => $password,
            'apiUsername' => $username
        ));
        $oiContact = iContactApi::getInstance();
        $lists = $oiContact->getLists();

        if ($lists == '') {
            return 0;
        } else {
            return 1;
        }
    }

    public function validate_mailchimp() {
        $apiKey = $this->input->post('api_key');
        $type = 'GET';
        $data = [
            'fields' => 'lists'
        ];
        $mailChimpDataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
        $url = 'https://' . $mailChimpDataCenter . '.api.mailchimp.com/3.0/lists/';
        $url .= '?' . http_build_query($data);
        $ch = curl_init();
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode('user:' . $apiKey)
        );
        //echo "<pre>";print_r($headers);die;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type); // user POST/GET/PATCH/PUT/DELETE according to MailChimp
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // send data in json
        $execu = curl_exec($ch);
        $result = json_decode($execu);
        if (!empty($result)) {
            //echo "<pre>";print_r($result->lists);die;
            if (!empty($result->lists)) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function validate_ActiveCampaign() {
        $responder_type = $this->getresponder_type;
        $APIKey = $this->input->post('api_key');
        $APIUrl = $this->input->post('url');
        require_once APPPATH . 'libraries/autoresponder/activecampaign-api-php-master/includes/ActiveCampaign.class.php';
        $ac = new ActiveCampaign($APIUrl, $APIKey);
        //print_r($ac);die();
        if (!(int) $ac->credentials_test()) {
            return 0;
        } else {
            return 1;
        }
    }

    public function validate_Sendlane() {
        $responder_type = $this->getresponder_type;
        $APIKey = $this->input->post('api_key');
        $HashKey = $this->input->post('hash_key');
        $APIDomainUrl = $this->input->post('api_subdomain');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://" . $APIDomainUrl . ".sendlane.com/api/v1/lists");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "api=$APIKey&hash=$HashKey");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        $result = json_decode($result);
        $response = $result;


        if (isset($response->error) || empty($response)) {
            //echo "0";
            return 0;
        } else {
            //echo "1";
            return 1;
        }
        //echo "<pre>";print_r($response);die;
    }

    public function validate_CampaignMonitor() {
        $responder_type = $this->getresponder_type;
        $APIKey = $this->input->post('api_key');
        $clientID = $this->input->post('client_id');
        require_once APPPATH . 'libraries/autoresponder/campaign_monitor/csrest_clients.php';
        $wrap = new CS_REST_Clients($clientID, $APIKey);
        $result = $wrap->get_lists();
        $response = $result->response;
        if (isset($response->Code)) {
            return 0;
        } else {
            return 1;
        }
    }

    	public function validate_aweber(){
		require_once APPPATH.'libraries/autoresponder/aweber/vendor/autoload.php';
		$scopes = array(
            'account.read',
            'list.read',
            'list.write',
            'subscriber.read',
            'subscriber.write',
            'email.read',
            'email.write',
            'subscriber.read-extended'
        );
        $OAUTH_URL = 'https://auth.aweber.com/oauth2/';
		$clientId = trim($this->input->post('client_id'));
        $clientSecret = trim($this->input->post('client_secret'));
		$this->session->set_userdata('client_id',$clientId);
		$this->session->set_userdata('client_secret',$clientSecret);
		$this->session->set_userdata('profile_id', $this->input->post('id'));

      		$redirectUri = base_url().'integrations-aweber';


		// Create a OAuth2 client configured to use OAuth for authentication
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'redirectUri' => $redirectUri,
            'scopes' => $scopes,
            'scopeSeparator' => ' ',
            'urlAuthorize' => $OAUTH_URL . 'authorize',
            'urlAccessToken' => $OAUTH_URL . 'token',
            'urlResourceOwnerDetails' => 'https://api.aweber.com/1.0/accounts'
        ]);

        $authorizationUrl = $provider->getAuthorizationUrl();
		$_SESSION['oauth2state'] = $provider->getState();
		
		$redirect_uri = $redirectUri;
		redirect("https://auth.aweber.com/oauth2/authorize?state=8e8d0ac5ba995c2367ffdaebad709ba1&scope=account.read%20list.read%20list.write%20subscriber.read%20subscriber.write%20email.read%20email.write%20subscriber.read-extended&response_type=code&approval_prompt=auto&redirect_uri=".urlencode($redirect_uri)."&client_id=".$clientId);
		// echo "<pre>";
		// die(print_r($authorizationUrl));
		// redirect($authorizationUrl);
	}
	
	public function genreate_aweber_token(){ 
		$this->load->model('default/Integration_Model');
		require APPPATH.'libraries/autoresponder/aweber/vendor/autoload.php';
		$scopes = array(
			'account.read',
			'list.read',
			'list.write',
			'subscriber.read',
			'subscriber.write',
			'email.read',
			'email.write',
			'subscriber.read-extended'
		);
		$BASE_URL = 'https://api.aweber.com/1.0/';
		$OAUTH_URL = 'https://auth.aweber.com/oauth2/';
		$TOKEN_URL = 'https://auth.aweber.com/oauth2/token';
		$clientId = $this->session->userdata('client_id');
		$clientSecret =$this->session->userdata('client_secret');
		$redirectUri = base_url().'integrations-aweber';

		$code = $this->input->get('code');

			// Create a OAuth2 client configured to use OAuth for authentication
			$provider = new \League\OAuth2\Client\Provider\GenericProvider([
				'clientId' => $clientId,
				'clientSecret' => $clientSecret,
				'redirectUri' => $redirectUri,
				'scopes' => $scopes,
				'scopeSeparator' => ' ',
				'urlAuthorize' => $OAUTH_URL . 'authorize',
				'urlAccessToken' => $OAUTH_URL . 'token',
				'urlResourceOwnerDetails' => 'https://api.aweber.com/1.0/accounts'
			]);
			$token = $provider->getAccessToken('authorization_code', [
				'code' => $code
			]);

			$accessToken = $token->getToken();
			$refreshToken = $token->getRefreshToken();
			
			$credential_value = array(
				'accessToken'=>$accessToken,
				'refreshToken'=>$refreshToken,
				'redirectUrl'=>$redirectUri,
				'client_id'=>$clientId,
				'client_secret'=>$clientSecret,
				
			); 
			 $this->business_id = $this->session->userdata('business')['id'];
			 $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
			$profile_id = $this->session->userdata('profile_id');
			$autoresponder_title = $this->session->userdata('autoresponder_title');
			$active_pos = $this->session->userdata('active_pos');
			$active_tab = $this->session->userdata('active_tab');
			$insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => json_encode($credential_value),'created' => time(),'modified' => time());
                $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
			$this->Integration_Model->insertAutoresponderSettings($insert);
			$flashdata['success']['message'] = 'Aweber credentials added successfully';
			$flashdata['success']['type'] = 'flash';
			$this->session->set_flashdata('active_pos', $active_pos);
			$this->session->set_flashdata('active_tab', $active_tab);
			$this->session->set_flashdata('message_title', $autoresponder_title);
			$this->session->set_flashdata('message', json_encode($flashdata)); //form submit 
			redirect(base_url('integration'));
	}

    public function validate_ConstantContact() {
        require_once APPPATH . 'libraries/autoresponder/constantContact/src/Ctct/autoload.php';
        require_once APPPATH . 'libraries/autoresponder/constantContact/standalone/vendor/autoload.php';
        $accessToken = $this->input->post('access_token');
        $APIKey = $this->input->post('api_key');
        // define("APIKEY", "66wwe2jmgndfsnp9yyfdw67u");
        // define("ACCESS_TOKEN", "2f4837cd-a415-448f-96f4-3d13adbc2a6a");
        $cc = new Ctct\ConstantContact($APIKey);
        $this->session->set_flashdata('constantcontact_error', "Enter Valid Constant Contact Credentials");
        // attempt to fetch lists in the account, catching any exceptions and printing the errors to screen
        $lists = $cc->listService->getLists($accessToken);
        if (isset($lists)) {
            $this->session->set_flashdata('constantcontact_error', "");
            return 1;
        } else {
            return 0;
        }
    }

  

    public function validate_Benchmark() {

        $APIKey = $this->input->post('api_key');
        try {
            require_once $this->config->item('benchmark_client');  //load default by php

            $client = XML_RPC2_Client::create("http://api.benchmarkemail.com/1.0/");
            $contactList = $client->listGet($APIKey, "", 1, 10, "", "");
            if (!isset($contactList)) {
                return 0;
            } else {
                return 1;
            }
        } catch (XML_RPC2_FaultException $e) {
            return 0;
        }
    }

    public function validate_Mailzingo() {

        $APIKey = $this->input->post('api_key');
        $APIUrl = $this->input->post('api_url');
        try {
            $data = json_decode(file_get_contents($APIUrl . "?action=authentication_check&api_key=" . $APIKey), 1);
            if (isset($data['success']) && $data['success'] == "true") {
                return 1;
            } else {
                return 0;
            }
        } catch (XML_RPC2_FaultException $e) {
            return 0;
        }
    }

    public function validate_MysticMailer() {

        $PublicKey = $this->input->post('public_key');
        $PrivateKey = $this->input->post('private_key');
        require_once APPPATH . 'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
        MailWizzApi_Autoloader::register();
        $config = new MailWizzApi_Config(array(
            'apiUrl' => 'http://app.mysticmailer.com/api',
            'publicKey' => $PublicKey,
            'privateKey' => $PrivateKey,
            'components' => array('cache' => array(
                    'class' => 'MailWizzApi_Cache_File',
                    'filesPath' => './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
        MailWizzApi_Base::setConfig($config);
        $endpoint = new MailWizzApi_Endpoint_Lists();
        $response = $endpoint->getLists();
        if (isset($response->body["status"]) && $response->body["status"] == 'success') {
            return 1;
        } else {
            return 0;
        }
    }

    public function validate_inboxingpro() {

        $PublicKey = $this->input->post('public_key');
        $PrivateKey = $this->input->post('private_key');
        //require_once './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
        require_once(APPPATH . 'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php');
        MailWizzApi_Autoloader::register();
        $config = new MailWizzApi_Config(array(
            'apiUrl' => 'https://mailer.inboxingpro.com/api/index.php',
            'publicKey' => $PublicKey,
            'privateKey' => $PrivateKey,
            'components' => array('cache' => array(
                    'class' => 'MailWizzApi_Cache_File',
                    'filesPath' => './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
        MailWizzApi_Base::setConfig($config);
        $endpoint = new MailWizzApi_Endpoint_Lists();
        $response = $endpoint->getLists();
        if (isset($response->body["status"]) && $response->body["status"] == 'success') {
            return 1;
        } else {
            return 0;
        }
    }

    public function validate_OnInbox() {

        $PublicKey = $this->input->post('public_key');
        $PrivateKey = $this->input->post('private_key');
        //require_once './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
        require_once(APPPATH . 'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php');
        MailWizzApi_Autoloader::register();
        $config = new MailWizzApi_Config(array(
            'apiUrl' => 'https://news.oninbox.com/api/index.php',
            'publicKey' => $PublicKey,
            'privateKey' => $PrivateKey,
            'components' => array('cache' => array(
                    'class' => 'MailWizzApi_Cache_File',
                    'filesPath' => './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
        MailWizzApi_Base::setConfig($config);
        $endpoint = new MailWizzApi_Endpoint_Lists();
        $response = $endpoint->getLists();
        if (isset($response->body["status"]) && $response->body["status"] == 'success') {
            return 1;
        } else {
            return 0;
        }
    }

    /*     * added by tm start */

    public function validate_GoTOWebinar() {

        $api_key = $this->input->post('api_key');



        if ($this->input->post()) {
            $api_key = $this->input->post('api_key');
            $consumer_secret = $this->input->post('consumer_secret');
            $this->session->set_userdata('api', $api_key);
            $this->session->set_userdata('consumer_secret', $consumer_secret);
            $this->session->set_userdata('profile_id', $this->input->post('id'));
            $this->session->set_userdata('autoresponder_title', $this->input->post('autoresponder_title'));
        } else {
            $api_key = $this->session->userdata('api');
            $consumer_secret = $this->session->userdata('consumer_secret');
        }
        $redirectUrl = $this->view_path;
        //echo $redirectUrl;
        //$this->load->library("CitrixAPI");
        $this->load->library("gotowebinar");
        $citrix = new gotowebinar();
        $this->session->set_userdata('webinar_integration','true');
        try {
            $oauth = $citrix->getOAuthToken($api_key, $consumer_secret,$redirectUrl);
            $this->session->unset_userdata('webinar_integration');
            //die('auth');
        } catch (Exception $e) {
            $this->session->unset_userdata('webinar_integration');
            $e->getmessage();
            return 0;
        }
        if (isset($oauth)) {
            $credential_value = json_decode($oauth);
            $credential_value->api_key = $this->session->userdata('api');
            $credential_value->consumer_secret = $this->session->userdata('consumer_secret');
            $profile_id = $this->session->userdata('profile_id');
            $this->session->unset_userdata('api');
            $this->session->unset_userdata('consumer_secret');
            $this->session->unset_userdata('profile_id');
            $this->session->unset_userdata('autoresponder_title');

            if(!isset($credential_value->access_token)){
                $flashdata['error']['message'] = 'Invalid Credientials';
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('active_tab', 'webinar');
                $this->session->set_flashdata('active_pos', $output["active_pos"]);
                $this->session->set_flashdata('message_title', $autoresponder_title);
                $this->session->set_flashdata('message', json_encode($flashdata)); 
                redirect($this->view_path);
            }
            
            $credential_value = json_encode($credential_value);
            
            $autoresponder_title = $this->session->userdata('autoresponder_title');

            

            $insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
            $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
            $this->Integration_Model->insertAutoresponderSettings($insert,$profile_id);
            
            $flashdata['success']['message'] = 'GoToWebinar credentials added successfully';
            $flashdata['success']['type'] = 'flash';
            $this->session->set_flashdata('active_tab', 'webinar');
            $this->session->set_flashdata('active_pos', $output["active_pos"]);
            $this->session->set_flashdata('message_title', $autoresponder_title);
            $this->session->set_flashdata('message', json_encode($flashdata)); //form submit
            redirect($this->view_path);
        }
    }

    /*     * added by tm end */

    public function validate_Interspire() {
        $xml_path = $this->input->post('xml_path');
        $xml_username = $this->input->post('xml_username');
        $xml_token = $this->input->post('xml_token');
        $xml = '<xmlrequest>
		<username>' . $xml_username . '</username>
		<usertoken>' . $xml_token . '</usertoken>
		<requesttype>authentication</requesttype>
		<requestmethod>xmlapitest</requestmethod>
		<details>
		</details>
		</xmlrequest>';

        $ch = curl_init($xml_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $result = @curl_exec($ch);
        if ($result === false) {
            return 0;
        } else {
            if (empty(simplexml_load_string($result))) {
                return 0;
            } else {
                $xml_doc = simplexml_load_string($result);
                if ($xml_doc->status == 'SUCCESS') {
                    return 1;
                } else {
                    return 0;
                }
            }
        }
    }

    public function validate_mailwhizz() {

        $ApiUrl = $this->input->post('api_url');
        $PublicKey = $this->input->post('public_key');
        $PrivateKey = $this->input->post('private_key');
        //require_once './application/views/lib/mailwhizz-php-api-master/MailWizzApi/Autoloader.php';
        require_once(APPPATH . 'libraries/autoresponder/mailwhizz-php-api-master/MailWizzApi/Autoloader.php');
        MailWizzApi_Autoloader::register();
        $config = new MailWizzApi_Config(array(
            'apiUrl' => $ApiUrl,
            'publicKey' => $PublicKey,
            'privateKey' => $PrivateKey,
            'components' => array('cache' => array(
                    'class' => 'MailWizzApi_Cache_File',
                    'filesPath' => './application/views/lib/mailwhizz-php-api-master/MailWizzApi/Cache/data/cache'))));
        MailWizzApi_Base::setConfig($config);
        $endpoint = new MailWizzApi_Endpoint_Lists();
        $response = $endpoint->getLists();
        if (isset($response->body["status"]) && $response->body["status"] == 'success') {
            return 1;
        } else {
            return 0;
        }
    }

    public function validate_salesforceiq() {

        $api_key = $this->input->post('api_key');
        $api_secret = $this->input->post('api_secret');
        $credential = $api_key . ':' . $api_secret;

        $url = "https://api.salesforceiq.com/v2/accounts";
        $curl = curl_init($url);
        $header = array('Accept:application/json');
        curl_setopt($curl, CURLOPT_USERPWD, $credential);
        curl_setopt($curl, CURLOPT_HEADER, http_build_query($header));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $json_response = curl_exec($curl);

        if (is_object(json_decode($json_response))) {
            return 1;
        } else {
            return 0;
        }
    }

    public function validate_salesforce() {
        $login_uri = "https://login.salesforce.com";
        //$redirect_uri = $this->config->item('salesforce_redirect_uri');
        $redirect_uri = $this->config->item('redirectMainUrl') . 'integrations-salesforce';
        $token_url = $login_uri . "/services/oauth2/token";

        $code = $_GET['code'];
        if (!isset($code) || $code == "") {
            if ($this->input->post('id')) {
                $client_id = $this->input->post('client_id');
                $client_secret = $this->input->post('client_secret');
                $credential = array('client_id' => $client_id, 'client_secret' => $client_secret);

                $this->session->set_userdata('profile_id', $this->input->post('id'));
                $this->session->set_userdata('autoresponder_title', $this->input->post('autoresponder_title'));
                $this->session->set_userdata('active_pos', $this->input->post('active_pos'));
                $this->session->set_userdata('active_tab', $this->input->post('active_tab'));

                $this->session->set_userdata('credential', json_encode($credential));
                $auth_url = $login_uri . "/services/oauth2/authorize?response_type=code&client_id=" . $client_id . "&redirect_uri=" . urlencode($redirect_uri);
                
                $this->session->set_userdata('integration_sales_force','yes');
                header('Location: ' . $auth_url);
            } else {
                return 0;
            }
        } else {
            //die('code');
            
            $credential = json_decode($this->session->userdata('credential'), 1);
            $params = "code=" . $code
                    . "&grant_type=authorization_code"
                    . "&client_id=" . $credential['client_id']
                    . "&client_secret=" . $credential['client_secret']
                    . "&redirect_uri=" . urlencode($redirect_uri);

            $curl = curl_init($token_url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $json_response = curl_exec($curl);
            $response = json_decode($json_response, true);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($status != 200) {
                die("Error: call to token URL $token_url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
            } else {
                $response = json_decode($json_response, true);
                $credential['access_token'] = $response['access_token'];
                $credential['instance_url'] = $response['instance_url'];

                $profile_id = $this->session->userdata('profile_id');
                $autoresponder_title = $this->session->userdata('autoresponder_title');
                $active_pos = $this->session->userdata('active_pos');
                $active_tab = $this->session->userdata('active_tab');

                $this->session->unset_userdata('integration_sales_force');

                $insert = array('user_id' => $this->owner_id, 'business_id'=>$this->business_id,'autoresponder_id' => $profile_id, 'credentials' => json_encode($credential), 'created' => time(), 'modified' => time());
                $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
                $this->Integration_Model->insertAutoresponderSettings($insert,$profile_id);
                $flashdata['success']['message'] = 'Salesforce credentials added successfully';
                $flashdata['success']['type'] = 'flash';
                $this->session->set_flashdata('active_pos', $active_pos);
                $this->session->set_flashdata('active_tab', 'crm');
                $this->session->set_flashdata('message_title', $autoresponder_title);
                $this->session->set_flashdata('message', json_encode($flashdata)); //form submit

                if($this->session->userdata('business')){
                    $domain = $this->session->userdata('business')['domain'];
                    $current_domain = current(explode('.', $_SERVER['HTTP_HOST']));
                    $url = str_replace($current_domain, $domain, $this->view_path);
                    redirect($url);
                }else{
                    redirect($this->view_path);
                }
                
            }
        }
    }

    public function validate_Infusionsoft() {
        //die('infi1');
        if (!$this->session->userdata('infusionsoft')) {

            $profile_id = $this->input->post('id', TRUE);
            $credentials = $this->Integration_Model->getCredentialFieldsDetail($profile_id);
            $credential_value_arr = array();
            foreach ($credentials as $key => $credential) {
                if ($autoresponder_title == 'infusionsoft') {
                    $credential_value_arr["redirect_url"] = $this->view_path;
                }
                $name = $credential->field_name;
                $credential_value_arr[$name] = $this->input->post($name);
            }
            $autoresponder_display_title = $this->input->post('autoresponder_display_title');
            $autoresponder_title = $this->input->post('autoresponder_title');
            $this->session->set_userdata("autoresponder_title", $autoresponder_title);
            $this->session->set_userdata('active_pos', $this->input->post('active_pos'));
            $this->session->set_userdata('active_tab', $this->input->post('active_tab'));
            $this->session->set_userdata('autoresponder_display_title', $autoresponder_display_title);
            $this->session->set_userdata('profile_id', $this->input->post('id'));
            $this->session->set_userdata("infusionsoft", $credential_value_arr);
        }

        require_once APPPATH . 'libraries/autoresponder/infusionsoft/vendor/autoload.php';
        $infusionsoft = new \Infusionsoft\Infusionsoft(array(
            'clientId' => $this->session->userdata("infusionsoft")["client_id"],
            'clientSecret' => $this->session->userdata("infusionsoft")["client_secret"],
            'redirectUri' => $this->session->userdata("infusionsoft")["redirect_url"]
        ));
        //die('123');
        //echo "<pre>";print_r($infusionsoft);die;
        if (isset($_GET['code'])) {
            //die('fir');
            $logged_in = $this->session->userdata('logged_in');
            $user_id = $logged_in['owner_id'];
            $act_pos = $this->session->userdata('active_pos');
            $active_tab = $this->session->userdata('active_tab');
            $profile_id = $this->session->userdata('profile_id');
            if (!$infusionsoft->getToken()) {
                $infusionsoft_token = serialize($infusionsoft->requestAccessToken($_GET['code']));
                $infusionsoft_array = array(
                    'client_id' => $this->session->userdata("infusionsoft")["client_id"],
                    'client_secret' => $this->session->userdata("infusionsoft")["client_secret"],
                    'redirect_url' => $this->session->userdata("infusionsoft")["redirect_url"],
                    'token' => $infusionsoft_token,
                );
                $credential_value = json_encode($infusionsoft_array);
                $insert = array('user_id' => $this->owner_id,'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
                $this->Integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
                $this->Integration_Model->insertAutoresponderSettings($insert,$profile_id);
                $flashdata['success']['message'] = $this->session->userdata('autoresponder_display_title') . ' Credentials added successfully';
                $flashdata['success']['type'] = 'flash';
                $this->session->set_flashdata('message', json_encode($flashdata));
                $this->session->set_flashdata('active_pos', $act_pos);
                $this->session->set_flashdata('active_tab', $active_tab);
                $this->session->set_flashdata('tab', 1);
                $this->session->unset_userdata("infusionsoft");

                //echo "<pre>";print_r($credential_value);die;
                redirect($this->view_path);
            }
        } elseif (isset($_GET["error"])) {
            //echo "3";die;
            $user_id = $this->session->userdata('id');
            $act_pos = $this->session->userdata('active_pos');
            $active_tab = $this->session->userdata('active_tab');
            $profile_id = $this->session->userdata('profile_id');
            $flashdata['error']['message'] = "Enter Valid " . $this->session->userdata('autoresponder_display_title') . " Credentials";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('tab', 1);
            $this->session->set_flashdata('message', json_encode($flashdata));
            $this->session->set_flashdata('active_pos', $act_pos);
            $this->session->set_flashdata('active_tab', $active_tab);
            redirect($this->view_path);
        } else {
            //die('25');
            redirect($infusionsoft->getAuthorizationUrl());
        }
    }

    public function user_autoresponders() {
        $this->db->select("display_title as title, autoresponders.id");
        $this->db->where('user_id', $this->user_id);
        $this->db->where('business_id', $this->business_id);
        $this->db->order_by('sort_order', 'asc');
        $this->db->join('autoresponders', 'autoresponders.id = users_autoresponder_settings.autoresponder_id');
        $query = $this->db->get('users_autoresponder_settings');
        return $query->result();
    }

    public function autoresponders_fields() {

        $this->db->select("autoresponder_id");
        $this->db->where('user_id', $this->user_id);
        $this->db->where('business_id', $this->business_id);
        $query = $this->db->get('users_autoresponder_settings');
        $autoresponder_ids = $query->result_array();

        $autoresponder_ids_column = array_column($autoresponder_ids, 'autoresponder_id');

        $this->db->select("autoresponder_id, title, field_name");
        if (sizeof($autoresponder_ids_column) > 0) {
            $query = $this->db->where_in('autoresponder_id', $autoresponder_ids_column);
        }

        $query = $this->db->get('autoresponder_allow_fields');
        return $query->result();
    }

    public function user_autoresponder_field() {
        $output["autoresponders"] = $this->user_autoresponders();
        $output["fields"] = $this->autoresponders_fields();
        echo json_encode($output);
    }

   

    public function autoresponder_forms1() {
        $autoresponder_id = isset($_POST['autoresponder_id']) ? $_POST['autoresponder_id'] : 2;
        $logged_in = $this->session->userdata('logged_in');
        $user_id = $logged_in['id'];
        $list = $this->Integration_Model->getResponderList($autoresponder_id, $user_id);
        echo json_encode($list);
    }
    
    public function resetAutoresponder(){
        $id = $this->input->post('id');
        $this->db->where('user_id', $this->user_id);
        $this->db->where('business_id', $this->business_id);
        $this->db->where('autoresponder_id', $id);
        $deleted = $this->db->delete('users_autoresponder_settings');
        if ($deleted) {
            echo json_encode(['status' => true, 'message' => 'Credentials reset successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'No data found to delete or already deleted.']);
        }
    }

}
