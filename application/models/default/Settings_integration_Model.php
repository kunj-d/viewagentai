<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_integration_Model extends CI_model
{
	var $tableAutoResponders='autoresponders';
	var $tableAutoresponderSettings='users_autoresponder_settings';
	var $tableAutoresponderFields='autoresponder_fields';
	var $tablesocial_profiles='social_profiles';
	var $tablesocial_profiles_fields='socialresponder_fields';
	public function __construct()
	{
		parent::__construct();
		$logged_in=$this->session->userdata('logged_in');
		$business=$this->session->userdata('business');
		$this->business_id=$business['id'];
		$this->user_id=$logged_in['id'];
		$this->owner_id=$logged_in['owner_id'];
		$this->aweber_consumerKey    = config_item('aweber_consumer_key');
		$this->aweber_consumerSecret = config_item('aweber_consumer_secret');
	}
	public function getAutoresponderProfile(){
		$autoresponder_list=array();
		$autoresponder_list['autoresponder']=array();
		$autoresponder_list['crm']=array();
		$autoresponder_list['webinar']=array();
		$autoresponder_list['payment']=array();
		$this->db->where('status','1');
		$this->db->order_by('sort_order', 'asc');
		$query = $this->db->get($this->tableAutoResponders);
		$result=$query->result();

		foreach($result as $data)
		{

			$dat=array(
				'autoresponder_id'=>$data->id,
				'display_title'=>$data->display_title,
				'logo'=>$data->logo,
				'title'=>$data->title,
				'autoresponder_fields'=>$this->getCredentialFieldsDetail($data->id)
			);

			array_push($autoresponder_list[$data->type],$dat);
			// if($data->type=='autoresponder'){
			// 	array_push($autoresponder_list['autoresponder'],$dat);
			// }elseif($data->type=='crm'){
			// 	array_push($autoresponder_list['crm'],$dat);
			// }elseif($data->type=='payment'){
			// 	array_push($autoresponder_list['payment'],$dat);
			// }else{
			// 	array_push($autoresponder_list['webinar'],$dat);
			// }
		}
		return json_encode($autoresponder_list);
	}
	public function getSocialProfiles(){
		$SocialProfiles_list=array();
		$this->db->where('status','1');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->tablesocial_profiles);
		$result=$query->result();
		foreach($result as $data)
		{
			$dat=array(
				'social_profile_id'=>$data->id,
				'display_title'=>$data->display_title,
				'logo'=>$data->logo,
				'title'=>$data->title,
				'social_fields'=>$this->getSocialFields($data->id)
			);
			array_push($SocialProfiles_list,$dat);
		}
		return $SocialProfiles_list;
	}
	public function getSocialFields($social_profile_id){
		$this->db->where('social_profile_id',$social_profile_id);
		$query = $this->db->get($this->tablesocial_profiles_fields);
		return $query->result_array();
	}
	public function getuser_social_settings(){
		$this->db->where('business_id',$this->business_id);
		$this->db->where('user_id',$this->user_id);
		$query = $this->db->get('users_social_settings');
		return $query->result_array();
	}
	public function getCredentialFieldsDetail($autoresponder_id){
		$this->db->where('autoresponder_id',$autoresponder_id);
		$query = $this->db->get($this->tableAutoresponderFields);
		return $query->result();
	}
	public function getAutoresponderProfileDetail($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->tableAutoResponders);
		return $query->row();
	}

	public function getAutoresponderValues($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get($this->tableAutoresponderSettings);
		return $query->result();
	}

	public function insertAutoresponderSettings($arr,$autoresponder_id=0){
		$this->db->insert($this->tableAutoresponderSettings,$arr);

		if($autoresponder_id>0){
			$this->db->where('id',$autoresponder_id);
			$query = $this->db->get('autoresponders');
			$display_title = $query->row_array()['display_title'];

			$this->Common_Model->set_user_logs($display_title.' Integration',$display_title.' Integration');
		}
	}

	public function deleteUserAutoresponderSetting($id,$user_id,$business_id = 0){
		$this->db->where('autoresponder_id', $id);
		$this->db->where('user_id', $user_id);
		$this->db->where('business_id', $this->business_id);
		$this->db->delete($this->tableAutoresponderSettings);
	}

	public function getResponderCredential($autoresponder_id,$user_id){
		$this->db->where("user_id",$user_id);
		$this->db->where('business_id', $this->business_id);
		$this->db->where("autoresponder_id",$autoresponder_id);
		$query=$this->db->get($this->tableAutoresponderSettings);
		return $query->row();


	}

	/*-------------- get autoresponders List start here-----------------*/

	public function getResponderList($autoresponder_id,$user_id){
		$this->db->where("id",$autoresponder_id);
		$query_responder = $this->db->get($this->tableAutoResponders);
		$responder_type = $query_responder->row()->title;
		
		if($responder_type == 'icontact'){
			return $this->getIcontactList($autoresponder_id,$user_id);
		}
		if($responder_type == 'mailchimp'){
			return $this->getMailChimpList($autoresponder_id,$user_id);
		}
		if($responder_type == 'getresponse'){
			return $this->getGetresponseList($autoresponder_id,$user_id);
		}
		if($responder_type == 'aweber'){
			$this->aweber_token_update($autoresponder_id,$user_id);
			return $this->getAweberList($autoresponder_id,$user_id);
		}
		if($responder_type == 'constantcontact'){
			return $this->getConstantContactList($autoresponder_id,$user_id);
		}
		if($responder_type == 'benchmark'){
			return $this->GetBenchmarkList($autoresponder_id,$user_id);
		}
		if($responder_type == 'campaignmonitor'){
			return $this->getCampaignMonitorList($autoresponder_id,$user_id);
		}
		if($responder_type == 'sendlane'){
			return $this->getSendlaneList($autoresponder_id,$user_id);
		}
		if($responder_type == 'activecampaign'){
			return $this->getActiveCampaignList($autoresponder_id,$user_id);
		}
		if($responder_type == 'mailzingo'){
			return $this->getMailzingoList($autoresponder_id,$user_id);
		}
		if($responder_type == 'gotowebinar'){
			return $this->getWebinarList($autoresponder_id,$user_id);
		}
		if($responder_type == 'mysticmailer'){
			return $this->getMysticMailerList($autoresponder_id,$user_id);
		}
		if($responder_type == 'oninbox'){
			return $this->getOnInboxList($autoresponder_id,$user_id);
		}
		if($responder_type == 'inboxingpro'){
			return $this->getinboxingproList($autoresponder_id,$user_id);
		}
		if($responder_type == 'mailwhizz'){
			return $this->getMailWhizzList($autoresponder_id,$user_id);
		}
		if($responder_type == 'interspire'){
			return $this->getInterspire($autoresponder_id,$user_id);
		}
		if($responder_type == 'mailprimo'){
			return $this->getMailPrimoList($autoresponder_id,$user_id);
		}
		if($responder_type == 'leadprimo'){
			return $this->getLeadPrimoList($autoresponder_id,$user_id);
		}
		if($responder_type == 'sendpulse'){
			$this->updateSendpulseToken($autoresponder_id,$user_id);
			return $this->getSendpulseList($autoresponder_id,$user_id);
		}
		if($responder_type == 'pabbly'){
			return  $this->getPabblyList($autoresponder_id,$user_id);
		}		
		if($responder_type == 'mailgpt'){
			return  $this->getMailgptList($autoresponder_id,$user_id);
		}
		//die($responder_type);
	}

	public function getPabblyList($autoresponder_id,$business_integration_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$business_integration_id);
		$credentials = json_decode($responder_info->credentials);
		$bearer_token = $credentials->bearer_token;
        // $bearer_token = ;			
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

		$results = json_decode($response);

		$err = curl_error($curl);

		curl_close($curl);

		$responder_data = array();
		foreach($results->subscribers_list as $data){
			$responder_d["listid"] = $data->list_id;
			$responder_d["title"] = $data->list_name;
			array_push($responder_data,$responder_d);
		 }

		return $responder_data;
    }
	
	public function getLeadPrimoList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = urlencode(trim($credentials->api_key));
		$APIUrl = "https://www.leadprimo.com/primo-api";
		$result = json_decode(file_get_contents($APIUrl."?action=campaign_list&api_key=".$APIKey), 1);
		$responder_data = array();
		foreach($result['campaign_list'] as $data){
			$responder_d["listid"] = $data['id'];
			$responder_d["title"] = $data['list_name'];
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}	
	public function getSendpulseList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sendpulse.com/addressbooks",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"authorization: Bearer $credentials->access_token",
			"cache-control: no-cache",
			),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			$response=json_decode($response,true);
			$responder_data = array();
			foreach($response as $data){
			$responder_d["listid"] = $data['id']; 
			$responder_d["title"] = $data['name'];
			array_push($responder_data,$responder_d);
			}
			return $responder_data;
	}
	
	public function updateSendpulseToken($autoresponder_id,$user_id) {
        $responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$client_id = urlencode(trim($credentials->client_id));
		$client_secret = urlencode(trim($credentials->client_secret));
		$profile_id = $autoresponder_id;


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
			
			$credential_value = json_encode($credential_value);
			$insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
            $this->Settings_integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id,$this->business_id);
            $this->Settings_integration_Model->insertAutoresponderSettings($insert,$profile_id);
           
            
			
			
}
	public function getMailPrimoList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = urlencode(trim($credentials->api_key));
		$APIUrl = "https://app.mailprimo.com/primo-api";
		$result = json_decode(file_get_contents($APIUrl."?action=campaign_list&api_key=".$APIKey), 1);
		$responder_data = array();
		foreach($result['campaign_list'] as $data){
			$responder_d["listid"] = $data['id'];
			$responder_d["title"] = $data['list_name'];
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}
	
	public function getMailgptList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = urlencode(trim($credentials->api_key));
		$APIUrl = "https://app.mailgpt.live/primo-api";
		$result = json_decode(file_get_contents($APIUrl."?action=campaign_list&api_key=".$APIKey), 1);
		$responder_data = array();
		foreach($result['campaign_list'] as $data){
			$responder_d["listid"] = $data['id'];
			$responder_d["title"] = $data['list_name'];
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}

	public function getMailChimpList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$apiKey = $credentials->api_key;

		/* Get list of mailchimpusing api 3.0 */
		$type = 'GET';
		$data = [
			'fields'     => 'lists'
		];
		$mailChimpDataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $mailChimpDataCenter . '.api.mailchimp.com/3.0/lists/';
		$url .= '?' . http_build_query($data);
		$ch = curl_init();
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Basic '.base64_encode( 'user:'. $apiKey )
		);
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type); // user POST/GET/PATCH/PUT/DELETE according to MailChimp
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
		$execu = curl_exec($ch);
		$result =json_decode($execu);
		$responder_data = array();
		if(!empty($result)) {
			if(!empty($result->lists)){
				foreach($result->lists as $chimp_data){
					$responder_d["listid"] = $chimp_data->id;
					$responder_d["title"] = $chimp_data->name;
					array_push($responder_data,$responder_d);
				}
			}
		}
		return $responder_data;
	}

	public function getIcontactList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$apikey = $credentials->api_key;
		$username = $credentials->username;
		$password = $credentials->password;
		require_once APPPATH.'libraries/autoresponder/iContactApi.php';

		iContactApi::getInstance()->setConfig(array(
				'appId'       => $apikey,
				'apiPassword' => $password,
				'apiUsername' => $username
			));
		$oiContact = iContactApi::getInstance();
		$lists = $oiContact->getLists();

		$responder_data=array();
		foreach($lists as $data){
			$responder_d["listid"] = $data->listId;
			$responder_d["title"] = $data->name;
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
		// echo "<pre>";
		// print_r(json_encode($responder_data)); die();

	}

	public function getGetresponseList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$api_key = $credentials->api_key;
		//$api_url = 'https://api2.getresponse.com';
		//require_once APPPATH.'libraries/autoresponder/jsonRPCClient.php';
		//$client = new jsonRPCClient($api_url);
		$api_url = 'https://api.getresponse.com/v3';
		require_once APPPATH . 'libraries/autoresponder/getresponse-api-php/src/GetResponseAPI3.class.php';
		$client = new GetResponse($api_key,$api_url);
		# find campaign list
		//$getresponse_campaigns = $client->get_campaigns($api_key);
		$getresponse_campaigns = $client->getCampaigns();
		//echo '<pre>'; print_r($getresponse_campaigns); die;
		$responder_data = array();
		foreach($getresponse_campaigns as $campaignskey=>$campaignsdetails){
			//echo '<pre>'; print_r($campaignsdetails);
			$responder_d["listid"] = $campaignsdetails->campaignId;
			$responder_d["title"] = $campaignsdetails->name;
			array_push($responder_data,$responder_d);
		}
		
		return $responder_data;
	}

	public function getAweberList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		require APPPATH.'libraries/autoresponder/aweber/vendor/autoload.php';
		$accessToken    = $credentials->accessToken;
		$accounts = $this->aweber_getCollection($accessToken, 'https://api.aweber.com/1.0/accounts');
		 // get all the list entries for the first account
        $listsUrl = $accounts[0]['lists_collection_link'];
        $lists = $this->aweber_getCollection($accessToken, $listsUrl);
        $responder_data = array();
		foreach($lists as $offset => $list) {
			$responder_d["listid"] = $list['id'];
			$responder_d["title"] = $list['name'];
			array_push($responder_data,$responder_d);
		}
		return $responder_data;
	}
	
	function aweber_getCollection($accessToken, $url) {
		
        // Create a Guzzle client
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
        $clientId = '88roHdwzMKdKM6sgPqJXijGzJxeqZIoE';
        $clientSecret = config_item('salesforce_client_secret');
        $redirectUri = "https://www.kyza.io/integrations-aweber";
		
        $client = new GuzzleHttp\Client();
        
        $collection = array();
        while (isset($url)) {
            $request = $client->get($url,
                ['headers' => ['Authorization' => 'Bearer ' . $accessToken]]
            );
            $body = $request->getBody();
            $page = json_decode($body, true);
            $collection = array_merge($page['entries'], $collection);
            $url = isset($page['next_collection_link']) ? $page['next_collection_link'] : null;
        }
        return $collection;
    }

	public function getConstantContactList($autoresponder_id,$user_id){

		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		require_once APPPATH.'libraries/autoresponder/constantContact/src/Ctct/autoload.php';
		require_once APPPATH.'libraries/autoresponder/constantContact/standalone/vendor/autoload.php';
		$accessToken = $credentials->access_token;
		$APIKey = $credentials->api_key;
		$cc = new Ctct\ConstantContact($APIKey);
		$lists = $cc->listService->getLists($accessToken);
		$responder_data = array();
		foreach($lists as $data){
			$responder_d["listid"] = $data->id;
			$responder_d["title"] = $data->name;
			array_push($responder_data,$responder_d);
		}
		//echo "<pre>";print_r($responder_data); die();
		return $responder_data;
	}

	public function getActiveCampaignList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = $credentials->api_key;
		$APIUrl = $credentials->url;
		require_once APPPATH.'libraries/autoresponder/activecampaign-api-php-master/includes/ActiveCampaign.class.php';
		$ac = new ActiveCampaign($APIUrl, $APIKey);
		$account = $ac->api("account/view");
		$lists = $ac->api("list/list?ids=all");
		$responder_data=array();
		foreach($lists as $data){
			if(isset($data->id))
			{
				$responder_d["listid"]=$data->id;
				$responder_d["title"]=$data->name;
				array_push($responder_data,$responder_d);
			}
		 }
		 // echo "<pre>";
		// print_r($responder_data);die;
		return $responder_data;
	}

	public function GetBenchmarkList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = $credentials->api_key;
		require_once $this->config->item('benchmark_client');  //load default by php
		$client = XML_RPC2_Client::create("http://api.benchmarkemail.com/1.0/");
		$contactList = $client->listGet($APIKey, "", 1, 10, "", "");
		$responder_data = array();
		foreach($contactList as $data){
			$responder_d["listid"] = $data['id'];
			$responder_d["title"] = $data['listname'];
			array_push($responder_data,$responder_d);
		}
		return $responder_data;
	}

	public function getSendlaneList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = $credentials->api_key;
		$HashKey = $credentials->hash_key;
		$APISubdomain = $credentials->api_subdomain;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://".$APISubdomain.".sendlane.com/api/v1/lists");

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST,           true);

		curl_setopt($ch, CURLOPT_POSTFIELDS,"api=$APIKey&hash=$HashKey");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result=curl_exec($ch);
		$result=  json_decode($result);
		$responder_data = array();
		foreach($result as $data){
				$responder_d["listid"] = $data->list_id;
				$responder_d["title"] = $data->list_name;
				array_push($responder_data,$responder_d);
		 }
		 return $responder_data;
	}

	public function getCampaignMonitorList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = $credentials->api_key;
		$clientID = $credentials->client_id;
		require_once APPPATH.'libraries/autoresponder/campaign_monitor/csrest_clients.php';
		$wrap = new CS_REST_Clients($clientID, $APIKey);
		$result = $wrap->get_lists();
		$responder_data = array();
		foreach($result->response as $data){
			$responder_d["listid"] = $data->ListID;
			$responder_d["title"] = $data->Name;
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}

	public function getMailzingoList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$APIKey = $credentials->api_key;
		$APIUrl = $credentials->api_url;

		$result = json_decode(file_get_contents($APIUrl."?action=campaign_list&api_key=".$APIKey));
		$responder_data = array();
		foreach($result->campaign_list as $data){
			$responder_d["listid"] = $data->campaign_id;
			$responder_d["title"] = $data->campaign_name;
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}

	public function getWebinarList($autoresponder_id,$user_id){
		//return array();
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credential_new =$credentials = json_decode($responder_info->credentials);

		// print_r($credential_new);
		// die;
		if(($responder_info->modified+3600)<time()){
			$this->load->library("gotowebinar");
			$citrix = new gotowebinar();
			try {
				$oauth = $citrix->refreshToken($credentials->refresh_token,$credentials->api_key,$credentials->consumer_secret,site_url('integration-settings'));
				$credential_new = $oauth;
				//$credential_new = json_decode($oauth);
				$credential_new->api_key = $credentials->api_key;
				$credential_new->consumer_secret = $credentials->consumer_secret;
				$credential_value = json_encode($credential_new);
				// print_r($credential_new);
				// print_r($credential_value);
				// die;
				$profile_id = 22;
				$insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
				$this->Settings_integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id);
				$this->Settings_integration_Model->insertAutoresponderSettings($insert);

			} catch (Exception $e) {
				return $responder_data = array();
			}
		}
		
		$this->load->library("CitrixAPI");
		$citrix1 = new CitrixAPI($credential_new->access_token,$credential_new->organizer_key);
		$result = $citrix1->getUpcomingWebinars();
		$result = json_decode($result);
		$responder_data = array();
		foreach($result as $data){
			$responder_d["listid"] = $data->webinarID;
			$responder_d["title"] = $data->subject;
			array_push($responder_data,$responder_d);
		 }
		return $responder_data;
	}

	public function getMysticMailerList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$PublicKey = $credentials->public_key;
		$PrivateKey = $credentials->private_key;
		require_once APPPATH.'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
		MailWizzApi_Autoloader::register();
		$config = new MailWizzApi_Config(array(
						'apiUrl' => 'http://app.mysticmailer.com/api',
						'publicKey' => $PublicKey,
						'privateKey' => $PrivateKey,
						'components' => array('cache' => array(
											'class' => 'MailWizzApi_Cache_File',
											'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
		MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		// GET ALL ITEMS
		$response = $endpoint->getLists();
		$responder_data=array();
		foreach($response->body["data"]["records"] as $data){
			if(isset($data["general"]["list_uid"]))
			{
				$responder_d["listid"]=$data["general"]["list_uid"];
				$responder_d["title"]=$data["general"]["name"];
				array_push($responder_data,$responder_d);
			}
		 }
		 // echo "<pre>";
		// print_r($responder_data);die;
		return $responder_data;
	}

	public function getinboxingproList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$PublicKey = $credentials->public_key;
		$PrivateKey = $credentials->private_key;
		require_once APPPATH.'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
		MailWizzApi_Autoloader::register();
		$config = new MailWizzApi_Config(array(
						'apiUrl' => 'https://mailer.inboxingpro.com/api/index.php',
						'publicKey' => $PublicKey,
						'privateKey' => $PrivateKey,
						'components' => array('cache' => array(
											'class' => 'MailWizzApi_Cache_File',
											'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
		MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		// GET ALL ITEMS
		$response = $endpoint->getLists();
		$responder_data=array();
		foreach($response->body["data"]["records"] as $data){
			if(isset($data["general"]["list_uid"]))
			{
				$responder_d["listid"]=$data["general"]["list_uid"];
				$responder_d["title"]=$data["general"]["name"];
				array_push($responder_data,$responder_d);
			}
		 }
		 // echo "<pre>";
		// print_r($responder_data);die;
		return $responder_data;
	}
	public function getOnInboxList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$PublicKey = $credentials->public_key;
		$PrivateKey = $credentials->private_key;
		require_once APPPATH.'libraries/autoresponder/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
		MailWizzApi_Autoloader::register();
		$config = new MailWizzApi_Config(array(
						'apiUrl' => 'https://news.oninbox.com/api/index.php',
						'publicKey' => $PublicKey,
						'privateKey' => $PrivateKey,
						'components' => array('cache' => array(
											'class' => 'MailWizzApi_Cache_File',
											'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
		MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		// GET ALL ITEMS
		$response = $endpoint->getLists();
		$responder_data=array();
		foreach($response->body["data"]["records"] as $data){
			if(isset($data["general"]["list_uid"]))
			{
				$responder_d["listid"]=$data["general"]["list_uid"];
				$responder_d["title"]=$data["general"]["name"];
				array_push($responder_data,$responder_d);
			}
		 }
		 // echo "<pre>";
		// print_r($responder_data);die;
		return $responder_data;
	}

	public function getMailWhizzList($autoresponder_id,$user_id){

		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$ApiUrl = $credentials->api_url;
		$PublicKey = $credentials->public_key;
		$PrivateKey = $credentials->private_key;
		require_once APPPATH.'libraries/autoresponder/mailwhizz-php-api-master/MailWizzApi/Autoloader.php';
		MailWizzApi_Autoloader::register();
		$config = new MailWizzApi_Config(array(
						'apiUrl' => $ApiUrl,
						'publicKey' => $PublicKey,
						'privateKey' => $PrivateKey,
						'components' => array('cache' => array(
											'class' => 'MailWizzApi_Cache_File',
											'filesPath' =>'./application/views/lib/mailwhizz-php-api-master/MailWizzApi/Cache/data/cache'))));
		MailWizzApi_Base::setConfig($config);
		$endpoint = new MailWizzApi_Endpoint_Lists();
		// GET ALL ITEMS
		$response = $endpoint->getLists();
		$responder_data=array();
		foreach($response->body["data"]["records"] as $data){
			if(isset($data["general"]["list_uid"]))
			{
				$responder_d["listid"]=$data["general"]["list_uid"];
				$responder_d["title"]=$data["general"]["name"];
				array_push($responder_data,$responder_d);
			}
		 }
		 // echo "<pre>";
		// print_r($responder_data);die;
		return $responder_data;
	}

	public function getInterspire($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$xml_path = $credentials->xml_path;
		$xml_username = $credentials->xml_username;
		$xml_token = $credentials->xml_token;
		$responder_data = array();
		$xml = '<xmlrequest>
		<username>'.$xml_username.'</username>
		<usertoken>'.$xml_token.'</usertoken>
		<requesttype>user</requesttype>
		<requestmethod>GetLists</requestmethod>
		<details>
		</details>
		</xmlrequest>';

		$ch = curl_init($xml_path);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$result = @curl_exec($ch);
		if($result === false) {
		}
		else {
			$xml_doc = simplexml_load_string($result);
			if ($xml_doc->status == 'SUCCESS') {
				$list_array = json_decode(json_encode($xml_doc), TRUE);
				foreach($list_array["data"]["item"] as $list_data){
					$responder_d["listid"] = $list_data["listid"];
					$responder_d["title"] =  $list_data["name"];
					array_push($responder_data,$responder_d);
				}
			}
		}

		return $responder_data;
	}
	public function aweber_token_update($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$accessToken    = $credentials->accessToken; 
		$refreshToken   = $credentials->refreshToken; 
		$client_id 		= $credentials->client_id; 
        $client_secret 	= $credentials->client_secret; 

		
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
        $OAUTH_URL = 'https://auth.aweber.com/oauth2/';

        // $clientId = $credentials->clientId; 
        // $clientSecret = $credentials->clientSecret; 
        


		$TOKEN_URL = 'https://auth.aweber.com/oauth2/token';

		
		$client = new GuzzleHttp\Client();
		$response = $client->post(
            $TOKEN_URL, [
                'auth' => [
                    $client_id, $client_secret
                ],
                'json' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken
                ]
            ]
		);
		
        $body = $response->getBody();
		$newCreds = json_decode($body, true);

		/* $credential_value = array(
			'accessToken'=>$newCreds['access_token'],
			'refreshToken'=>$newCreds['refresh_token'],
                        'clientId'     => $credentials->clientId,
                        'clientSecret' => $credentials->clientSecret
		);  */
		$credential_value_new = array(
			'accessToken'=>$newCreds['access_token'],
			'refreshToken'=>$newCreds['refresh_token'],
			'client_id'     => $credentials->client_id,
			'client_secret' => $credentials->client_secret
		); 

		

		$credential_value = json_encode($credential_value_new);

				$insert = array('user_id' => $user_id,'business_id'=>$this->business_id,'autoresponder_id' => $autoresponder_id, 'credentials' => $credential_value,'created' => time(),'modified' => time());
				$this->deleteUserAutoresponderSetting($autoresponder_id,$user_id,$this->business_id);
				$this->insertAutoresponderSettings($insert);
				// $output["dta"] = $this->db->last_query();
				// echo  json_encode($output);
				// die;			
				return true;	
	}
	
	public function addSubscriber($autoresponder_id,$business_id){ 
		$this->aweber_token_update($autoresponder_id,$this->owner_id);
		$responder_info = $this->getResponderCredential($autoresponder_id,$this->owner_id);
		$credentials = json_decode($responder_info->credentials);
		$accessToken = $credentials->accessToken;			
		$list_id		= $this->input->post('list_id');
		$name		= $this->input->post('name');
		$email		= $this->input->post('email');
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
	
		$clientId = $credentials->client_id; 
		$clientSecret = $credentials->client_secret;
					
		try {
			// Create a Guzzle client
			$client = new GuzzleHttp\Client();
			// find out if a subscriber exists on the first list
			$accounts = $this->aweber_getCollection($accessToken, 'https://api.aweber.com/1.0/accounts');
			$params = array(
				'ws.op' => 'find',
				'email' => $email
			);
			$subsUrl = 'https://api.aweber.com/1.0/accounts/'.$accounts[0]['id'].'/lists/'.$list_id.'/subscribers';
			$findUrl = $subsUrl . '?' . http_build_query($params);
			$foundSubscribers = $this->aweber_getCollection($accessToken, $findUrl);
			if (isset($foundSubscribers[0]['self_link'])) {
				// update the subscriber if they are on the first list
				$data = array(
					'custom_fields' =>  array('name' => $name),
					'tags' => array('add' => array('prospect'))
				);
				$subscriberUrl = $foundSubscribers[0]['self_link'];
				$subscriberResponse = $client->patch($subscriberUrl, [
						'json' => $data, 
						'headers' => ['Authorization' => 'Bearer ' . $accessToken]
					])->getBody();
				$subscriber = json_decode($subscriberResponse, true);
			} else {
				 // add the subscriber if they are not already on the first list
				/* $data = array(
					'email' => $email,
					'custom_fields' => array('name' => $name),
					'tags' => array('prospect')
				); */

				$data = array(
					'email' => $email,
					'name' => $name,
					'tags' => array('prospect')
				);

				$body = $client->post($subsUrl, [
						'json' => $data, 
						'headers' => ['Authorization' => 'Bearer ' . $accessToken]
					]);
				// get the subscriber entry using the Location header from the post request
				$subscriberUrl = $body->getHeader('Location')[0];
				$subscriberResponse = $client->get($subscriberUrl,
					['headers' => ['Authorization' => 'Bearer ' . $accessToken]])->getBody();
				$subscriber = json_decode($subscriberResponse, true);
			}
			$output['status']=true;
			$output['message']='Successfully subscribed';
		} catch(AWeberAPIException $exc) {
			$output['status']=false;
			$output['message']='Some problem occurred, please try again';
		}
		return $output;
	}
	
	
		
    public function get_autoresponder_lead_list_data($data) {


        if ($data['search_key']) {
            $this->db->group_start();
            $this->db->or_like('autoresponder_lead_data.name', $data['search_key']);
            $this->db->or_like('autoresponder_lead_data.email', $data['search_key']);
            $this->db->or_like('prompts.text', $data['search_key']);
            $this->db->group_end();
        }

        $items_per_page = $data['items_per_page'] ? $data['items_per_page'] : 10;
        $current_page = $data['current_page'] ? $data['current_page'] : 1;
		$start = ($current_page - 1) * $items_per_page;
	    
	    $this->db->select('autoresponder_lead_data.*, prompts.text as prompt_name');
// 		$this->db->where("user_id", $this->user_id);
        $this->db->where("autoresponder_lead_data.business_id", $this->business_id);
        $this->db->join('prompts', 'prompts.id = autoresponder_lead_data.prompt_id', 'left');
        $query = $this->db->get('autoresponder_lead_data',$items_per_page,$start);
        $output['data'] = $query->result_array();
      
// 		pr($this->db->last_query());die;
        // $totalquery = $this->db->query('SELECT FOUND_ROWS() as total;');
        // $row = $totalquery->row();
        $output['total_items'] = $this->db->count_all('autoresponder_lead_data');
        return $output;
    }

	public function get_auto_responder_lead_details($id){

		$this->db->select('name, email,created_date');
		$this->db->where('id',$id);
		$this->db->where('business_id', $this->business_id);
		$query = $this->db->get('autoresponder_lead_data');
		return $query->result_array();

	}
	
}
?>