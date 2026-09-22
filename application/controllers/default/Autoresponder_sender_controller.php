<?php

/*header("access-control-allow-headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header('Access-Control-Allow-Origin: *');*/

defined('BASEPATH') OR exit('No direct script access allowed'); 
include_once("AppDefault.php");
class Autoresponder_sender_controller extends AppDefault {

	public function __construct()
	{
		parent::__construct();
		$this->aweber_consumerKey    = config_item('aweber_consumer_key');
		$this->aweber_consumerSecret = config_item('aweber_consumer_secret');
	    $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business_id = $this->session->userdata('business')['id'];
		$this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Settings_integration_Model');
	}
	public function index(){
		$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 2;
	       $autoresponder_id = isset($_REQUEST['autoresponder_id']) ? $_REQUEST['autoresponder_id'] : 2;
	       $listId = isset($_REQUEST['list_id']) ? $_REQUEST['list_id'] : '';
	       $prompt_id = isset($_REQUEST['prompt_id']) ? $_REQUEST['prompt_id'] : '';
		$output=array();
			
		$this->db->where("id",$autoresponder_id);
		$query_responder=$this->db->get("autoresponders");
		$result = $query_responder->row(); 
	
		$responder_type = $result->title; 
		$this->db->select('business_id');
	       $this->db->where('id',$prompt_id);
	       $query1 = $this->db->get('prompts');
	       $user_data = $query1->row();
    
       	$business_id = $user_data->business_id;
        
		$this->db->where("user_id",$user_ids);
		$this->db->where("autoresponder_id",$autoresponder_id);
		$query=$this->db->get("users_autoresponder_settings");
		$result=$query->row();

		$credentials = json_decode($result->credentials);
		$credentials_modified = $result->modified;
		 
		$name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
		$first_name = isset($_REQUEST['first_name'])?$_REQUEST['first_name']:'';
		$last_name = isset($_REQUEST['last_name'])?$_REQUEST['last_name']:'';
		$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';
		$phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
		$address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
		$fax = isset($_REQUEST['fax'])?$_REQUEST['fax']:'';
		$bussiness = isset($_REQUEST['bussiness'])?$_REQUEST['bussiness']:null;
		$suffix = isset($_REQUEST['suffix'])?$_REQUEST['suffix']:null;
		$street = isset($_REQUEST['street'])?$_REQUEST['street']:null;
		$stree2 = isset($_REQUEST['stree2'])?$_REQUEST['stree2']:null;
		$city = isset($_REQUEST['city'])?$_REQUEST['city']:null;
		$state = isset($_REQUEST['state'])?$_REQUEST['state']:null;
		$country = isset($_REQUEST['country'])?$_REQUEST['country']:null;
		$postal_code = isset($_REQUEST['postal_code'])?$_REQUEST['postal_code']:null;
		$postal_code = isset($_REQUEST['zip'])?$_REQUEST['zip']:null;
		$prefix = isset($_REQUEST['prefix'])?$_REQUEST['prefix']:null;
		
		$inser_data = array(
                    'business_id'=>$business_id,
                    'prompt_id'=> $prompt_id,
                    'autoresponder_id'=>$autoresponder_id,
                    'list_id' =>$listId,
                    'name'=>$name,
                    'email'=>$email
              );
       	$this->db->insert('autoresponder_lead_data',$inser_data);
        
		if($responder_type == 'campaignmonitor'){
			require_once './application/views/lib/campaign_monitor/csrest_subscribers.php';
			$APIKey = $credentials->api_key;			
			$clientID = $credentials->client_id;			
			
			$wrap = new CS_REST_Subscribers($listId, $APIKey);
			$result = $wrap->add(array(
				'EmailAddress' => $email ,
				'Name' => $name ,
				'Resubscribe' => true
			));
			if($result->http_status_code==201)	{
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}
		if($responder_type == 'sendpulse'){
			$this->Settings_integration_Model->updateSendpulseToken($autoresponder_id,$user_id)	; 
			$curl = curl_init();			 
			$data = serialize(array("$email"));
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sendpulse.com/addressbooks/$listId/emails",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "id=$listId&emails=$data",
			CURLOPT_HTTPHEADER => array(
			"authorization: Bearer $credentials->access_token",
			"cache-control: no-cache",
			),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
			$response=json_decode($response,true);
		
			if($response['result']=="1")	{
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}
		elseif($responder_type == 'activecampaign'){
			
			require_once './application/views/lib/activecampaign-api-php-master/includes/ActiveCampaign.class.php';
			$APIUrl = $credentials->url;		
			$APIKey = $credentials->api_key;
			$ac = new ActiveCampaign($APIUrl, $APIKey);
			$contact = array(
				"email"              => $email,
				"first_name"         => $first_name,
				"last_name"          => $last_name,
				"phone"          	=> $phone,
				"p[{$listId}]"      => $listId,
				"status[{$listId}]" => 1, // "Active" status
			);
			
			$contact_sync = $ac->api("contact/sync", $contact);
			
			
			if($contact_sync->success==1){
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		
		}
		elseif($responder_type == 'icontact'){
		$api_key = $credentials->api_key;	
			$username = $credentials->username;	
			$password = $credentials->password;	
			require_once './application/views/lib/iContactApi.php'; 
			iContactApi::getInstance()->setConfig(array(
				'appId'       => $api_key, 
				'apiPassword' => $password, 
				'apiUsername' => $username
			));
			 
			// Store the singleton
			$oiContact = iContactApi::getInstance();
			$lists = $oiContact->getLists();
			
			$NewContact = $oiContact->addContact($email ,'normal', $prefix ,$first_name , $last_name , $suffix , $street , $stree2 , $city , $state , $postal_code , $phone , $fax , $bussiness);
			//print_r($NewContact);
			$contactId = $NewContact->contactId;
			$oiContact->subscribeContactToList($contactId, $listId, 'normal');
			$lastresponse=json_decode($oiContact->getLastResponse());
			
			if(!empty($lastresponse->subscriptions)){
				$output['status']=true;
				$output['message']='Successfully subscribed';
				
			}
			elseif(strpos($lastresponse->warnings[0], 'could not be updated')==true){
				$output['status']=true;
				$output['message']='Already suscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}
		elseif($responder_type == 'mailchimp'){
				
				// MailChimp API credentials	
				$mailChimpKey = $credentials->api_key;
				
				// MailChimp API URL
				$memberID = md5(strtolower($email));
				$dataCenter = substr($mailChimpKey,strpos($mailChimpKey,'-')+1);
				$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberID;
				
				// Member information
				$json = json_encode([
					'email_address' => $email,
					'status'        => 'subscribed',
					'merge_fields'  => [
						'FNAME'     => $first_name,
						'LNAME'     => $last_name
					]
				]);
			
				// send a HTTP POST request with curl
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $mailChimpKey);
				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
				$result = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				
				// store the status message based on response code
				
					if ($httpCode == 200) {
						$output['status'] = true;
						$output['message'] = 'Successfully subscribed';
					}
					else {
						switch ($httpCode) {
							case 214:
								$output['status'] = true;
								$output['message'] = 'You are already subscribed';
								break;
							case 400:
								$output['status'] = false;
								$output['message'] = 'Some problem occurred, please try again.';
								break;
							default:
								$output['status'] = false;
								$output['message']= 'Some problem occurred, please try again';
								break;
						}
					}
				
					
				
			}
		elseif($responder_type == 'getresponse'){
		
		//	require_once './application/views/lib/jsonRPCClient.php';
		require_once APPPATH . 'libraries/autoresponder/getresponse-api-php/src/GetResponseAPI3.class.php';
			// GetrRsponse API credentials
			$api_key = $credentials->api_key;
			//$api_url = 'https://api2.getresponse.com';
			$api_url = 'https://api.getresponse.com/v3';
			$client = new GetResponse($api_key,$api_url);
			//$client = new GetResponse($api_key,$api_url);
			# initialize JSON-RPC client
			//$client = new jsonRPCClient($api_url); 
			 $campaign = $listId;
	
			# add contact to the campaign
			try
			{
				if(!empty($email)) {
				$name = $name == "" ? $email : $name;
				$param = array(
					'campaign' => array("campaignId"=> $campaign),
					'name'       => $name,
					'email'      => $email,
					'type'       => 'single_select',
					'dayOfCycle' => 10,
					'createdOn'   => time(),
					'origin'      => 'email'
				);    
				$response = $client->addContact($param);					
				if (!empty($response)){
					$output['status'] = true;
					$output['message']= 'Successfully suscribed';
				}else{
				 	$output['status'] = false;
					$output['message']= 'something wrong, please try again';
				  }
				} else {
					$output['status'] = false;
					$output['message']= 'email field are required.';
				}
                                 
				
			} 
			catch (Exception $e)
			{
				$return_string = $e->getMessage();
				
				if (strpos($return_string, 'Contact already') == true) {				
				$output['status'] = true;
				$output['message']= 'Contact already added to target campaign';
				}
				else{
					$output['status'] = false;
					$output['message']= 'Some problem occurred, please try again';
				 }
			}
	
		}
		elseif($responder_type == 'benchmark'){
			
			require_once $this->config->item('benchmark_client');
			// GetrRsponse API credentials
			$api_key = $credentials->api_key;
			
				try
				{
                                   
					$client = XML_RPC2_Client::create("http://api.benchmarkemail.com/1.0/");
					
					$rec1['firstname'] = $first_name;
					$rec1['lastname'] = $last_name;
					$rec1['email'] = $email;
					$rec = array($rec1);
					$result = $client->listAddContacts($api_key, $listId, $rec);

					if($result == 1){
						$output['status'] = true;
						$output['message'] = 'Successfully subscribed';
					}
					elseif($result == '-2'){
						$output['status'] = true;
						$output['message'] = 'You have already subscribed';
					}
                                     else{
                                            $output['status']=false;
                                            $output['message']='Some problem occurred, please try again';
					}

				}
				catch (XML_RPC2_FaultException $e){
                                    
					//echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
					
						switch ($error_code) {
						case 15:
							 $output['status'] = false;
							 $output['message'] = 'Please check listid';
							break;
						case 14:
							 $output['status'] = false;
							 $output['message'] = 'Invalid Token,Please check apikey';
							break;
						default:
							 $output['status'] = false;
							 $output['message']= 'Some problem occurred, please try again';
							break;
						}
				}
                                 
						
		}
		elseif($responder_type == 'constantcontact'){
			require_once './application/views/lib/constantContact/src/Ctct/autoload.php';
			require_once './application/views/lib/constantContact/standalone/vendor/autoload.php';
			// define("APIKEY", "66wwe2jmgndfsnp9yyfdw67u");
			// define("ACCESS_TOKEN", "2f4837cd-a415-448f-96f4-3d13adbc2a6a");
			$APIKey      = $credentials->api_key;
			$accessToken   = $credentials->access_token;
			$cc = new Ctct\ConstantContact($APIKey);
			try {
				$response = $cc->contactService->getContacts($accessToken, array("email" => $email));
				
				if (empty($response->results)) {
					$action = "Creating Contact";
					$contact = new Ctct\Components\Contacts\Contact();
					$contact->addEmail($email);
					$contact->addList($listId);
					$contact->first_name = $first_name;
					$contact->last_name = $last_name;
					//print_r($contact); die();
					$returnContact = $cc->contactService->addContact($accessToken, $contact, true);
					$output['status']=true;
					$output['message']='Successfully suscribed';
				} 
				else {
					$action = "Updating Contact";
					 $contact = $response->results[0];
					if ($contact instanceof Contact) {
						$contact->addList($listId);
						$contact->first_name = $first_name;
						$contact->last_name = $last_name;

						$returnContact = $cc->contactService->updateContact($accessToken, $contact, true);
						$output['status']=true;
						$output['message']='Successfully suscribed';
					} 
					else {
						if (!empty($response->results)) {
							$output['status']=true;
							$output['message']='Contact already suscribed';
						}
						else{
							$output['status']=false;
							$output['message']='Some problem occurred, please try again';
						}
						//$e = new Ctct\Exceptions\CtctException();
						//$e->setErrors(array("type", "Contact type not returned"));
						//throw $e;
					}
				}
			} 
			catch (CtctException $ex) {
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}		
		elseif($responder_type=='aweber'){
			if(empty($this->input->post('email'))){
				$output['status'] = false;
				$output['message']= 'Some problem occurred, please try again';
				echo json_encode($output);
				die;
			}
			$output=$this->Settings_integration_Model->addSubscriber($autoresponder_id,$this->business_id);
			echo json_encode($output);
			die;
		}
		elseif($responder_type=='sendlane'){
			$HashKey = $credentials->hash_key;	
			$APIKey = $credentials->api_key;
			$APISubdomain = $credentials->api_subdomain;
			$formId = $listId;

			$subscriber= "$first_name $last_name<$email>";
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL,"https://".$APISubdomain.".sendlane.com/api/v1/list-subscribers-add");
									
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST,           true);

			curl_setopt($ch, CURLOPT_POSTFIELDS,"api=$APIKey&hash=$HashKey&email=$email&list_id=$formId");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
			$result= curl_exec ($ch);
			$result=  json_decode($result);
			//echo "<pre>";print_r($result);die;
			if(!empty($result))	{
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']   =   false;
				$output['message']  =   'Some problem occurred, please try again';
			}
		}
		elseif($responder_type=='mailzingo'){
			$APIKey = $credentials->api_key;			
			$APIUrl = $credentials->api_url;
			$result = json_decode(file_get_contents($APIUrl."?action=add_subscriber&api_key=".$APIKey."&campaign_id=".$listId."&".http_build_query($_REQUEST)));
			if(!empty($result->success) || $result->msg == "Subscriber Already Exists")	{
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}
		elseif($responder_type == 'mailprimo'){
				$APIKey = $credentials->api_key;			
				$APIUrl = "https://app.mailprimo.com/primo-api";
				$result = json_decode(file_get_contents($APIUrl."?action=add_subscriber&api_key=".$APIKey."&campaign_id=".$listId."&".http_build_query($_REQUEST)));
				if(!empty($result->success) || $result->msg == "Subscriber Already Exists" || $result->msg == "Subscriber Added Successfully")	{
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
			}
			elseif($responder_type == 'mailgpt'){
				$APIKey = $credentials->api_key;			
				$APIUrl = "https://app.mailgpt.live/primo-api";
				$result = json_decode(file_get_contents($APIUrl."?action=add_subscriber&api_key=".$APIKey."&campaign_id=".$listId."&".http_build_query($_REQUEST)));
				if(!empty($result->success) || $result->msg == "Subscriber Already Exists" || $result->msg == "Subscriber Added Successfully")	{
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
			}
		elseif($responder_type == 'leadprimo'){
				$APIKey = $credentials->api_key;			
				$APIUrl = "https://www.leadprimo.com/primo-api";
				$result = json_decode(file_get_contents($APIUrl."?action=add_leads&api_key=".$APIKey."&campaign_id=".$listId."&".http_build_query($_REQUEST)));
				if(!empty($result->success) || $result->msg == "Subscriber Already Exists" || $result->msg == "Subscriber Added Successfully")	{
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
			}
		elseif($responder_type=='gotowebinar'){
			$access_token = $credentials->access_token;
			$organizer_key = $credentials->organizer_key;
			$credential_new = $credentials;
			if(($credentials_modified+3600)<time()){
				$this->load->library("gotowebinar");
				$citrix = new gotowebinar();
				try {
					$oauth = $citrix->refreshToken($credentials->refresh_token,$credentials->api_key,$credentials->consumer_secret,site_url('integration-settings'));
					$credential_new = json_decode($oauth);
					$credential_new->api_key = $credentials->api_key;
					$credential_new->consumer_secret = $credentials->consumer_secret;
					$credential_value = json_encode($credential_new);
					$profile_id = 22;
					$insert = array('user_id' => $this->owner_id, 'business_id' => $this->business_id, 'autoresponder_id' => $profile_id, 'credentials' => $credential_value, 'created' => time(), 'modified' => time());
					$this->Settings_integration_Model->deleteUserAutoresponderSetting($profile_id, $this->owner_id);
					$this->Settings_integration_Model->insertAutoresponderSettings($insert);
	
				} catch (Exception $e) {
					return false;
				}
			}

			$this->load->library("CitrixAPI");
			$citrix1 = new CitrixAPI($credential_new->access_token,$credential_new->organizer_key);
			if(empty($first_name)){
				$first_name = $email;
			}
			if(empty($last_name)){
				$last_name = $email;
			}
			$postData = json_encode(array('firstName'=>$first_name,'lastName'=>$last_name,'email'=>$email));
			$response = $citrix1->postWebinarRegistrants($listId,$postData);
			$result = json_decode($response);
			if(!empty($result->status) || $result->status == "APPROVED")	{
				$output['status']=true;
				$output['message']='Successfully subscribed';
			}
			else{
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
		}
		elseif($responder_type=='mysticmailer'){
			$PublicKey = $credentials->public_key;			
			$PrivateKey = $credentials->private_key;
			require_once './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
			MailWizzApi_Autoloader::register();
			$config = new MailWizzApi_Config(array(
							'apiUrl' => 'http://app.mysticmailer.com/api', 
							'publicKey' => $PublicKey, 
							'privateKey' => $PrivateKey, 
							'components' => array('cache' => array(
												'class' => 'MailWizzApi_Cache_File', 
												'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
			MailWizzApi_Base::setConfig($config);
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
			$response = $endpoint->createUpdate($listId, array(
					'EMAIL'    => $email,
					'FNAME'    => $first_name,
					'LNAME'    => $last_name
				));
				if(isset($response->body["status"]) && $response->body["status"]=='success'){
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
		}
		elseif($responder_type=='oninbox'){
			$PublicKey = $credentials->public_key;			
			$PrivateKey = $credentials->private_key;
			require_once './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
			MailWizzApi_Autoloader::register();
			$config = new MailWizzApi_Config(array(
							'apiUrl' => 'https://news.oninbox.com/api/index.php', 
							'publicKey' => $PublicKey, 
							'privateKey' => $PrivateKey, 
							'components' => array('cache' => array(
												'class' => 'MailWizzApi_Cache_File', 
												'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
			MailWizzApi_Base::setConfig($config);
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
			$response = $endpoint->createUpdate($listId, array(
					'EMAIL'    => $email,
					'FNAME'    => $first_name,
					'LNAME'    => $last_name
				));
				if(isset($response->body["status"]) && $response->body["status"]=='success'){
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
		}elseif($responder_type=='inboxingpro'){
			$PublicKey = $credentials->public_key;			
			$PrivateKey = $credentials->private_key;
			require_once './application/views/lib/mysticmailer-php-api-master/MailWizzApi/Autoloader.php';
			MailWizzApi_Autoloader::register();
			$config = new MailWizzApi_Config(array(
							'apiUrl' => 'https://mailer.inboxingpro.com/api/index.php', 
							'publicKey' => $PublicKey, 
							'privateKey' => $PrivateKey, 
							'components' => array('cache' => array(
												'class' => 'MailWizzApi_Cache_File', 
												'filesPath' =>'./application/views/lib/mysticmailer-php-api-master/MailWizzApi/Cache/data/cache'))));
			MailWizzApi_Base::setConfig($config);
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
			$response = $endpoint->createUpdate($listId, array(
					'EMAIL'    => $email,
					'FNAME'    => $first_name,
					'LNAME'    => $last_name
				));
				if(isset($response->body["status"]) && $response->body["status"]=='success'){
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
		}
		elseif($responder_type=='mailwhizz'){
			$ApiUrl = $credentials->api_url;
			$PublicKey = $credentials->public_key;			
			$PrivateKey = $credentials->private_key;
			require_once './application/views/lib/mailwhizz-php-api-master/MailWizzApi/Autoloader.php';
			MailWizzApi_Autoloader::register();
			$config = new MailWizzApi_Config(array(
							'apiUrl' => $ApiUrl, 
							'publicKey' => $PublicKey, 
							'privateKey' => $PrivateKey, 
							'components' => array('cache' => array(
												'class' => 'MailWizzApi_Cache_File', 
												'filesPath' =>'./application/views/lib/mailwhizz-php-api-master/MailWizzApi/Cache/data/cache'))));
			MailWizzApi_Base::setConfig($config);
			$endpoint = new MailWizzApi_Endpoint_ListSubscribers();
			$response = $endpoint->createUpdate($listId, array(
					'EMAIL'    => $email,
					'FNAME'    => $first_name,
					'LNAME'    => $last_name
				));
				if(isset($response->body["status"]) && $response->body["status"]=='success'){
					$output['status']=true;
					$output['message']='Successfully subscribed';
				}
				else{
					$output['status']=false;
					$output['message']='Some problem occurred, please try again';
				}
		}
		elseif($responder_type=='interspire'){
			$xml_path = $credentials->xml_path;
			$xml_username = $credentials->xml_username;
			$xml_token = $credentials->xml_token;
			$xml = '<xmlrequest>
					<username>'.$xml_username.'</username>
					<usertoken>'.$xml_token.'</usertoken>
					<requesttype>subscribers</requesttype>
					<requestmethod>AddSubscriberToList</requestmethod>
					<details>
					<emailaddress>'.$email.'</emailaddress>
					<mailinglist>'.$listId.'</mailinglist>
					<format>html</format>
					<confirmed>yes</confirmed>
					<customfields>
					<item>
					<fieldid>2</fieldid>
					<value>'.$first_name.'</value>
					</item>
					<item>
					<fieldid>3</fieldid>
					<value>'.$last_name.'</value>
					</item>
					<item>
					<fieldid>4</fieldid>
					<value>'.$phone.'</value>
					</item>
					</customfields>
					</details>
					</xmlrequest>
					';
			$ch = curl_init($xml_path);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			$result = @curl_exec($ch);
			if($result === false) {
				$output['status']=false;
				$output['message']='Some problem occurred, please try again';
			}
			else {
				$xml_doc = simplexml_load_string($result);
				if ($xml_doc->status == 'SUCCESS') {
					$output['status']=true;
					$output['message']='Successfully subscribed';
				} 
				else {
					$output['status']=false;
					$output['message']=$xml_doc->errormessage;
				}
			}
		}
		echo json_encode($output);
	}
	
	   public function autoresponderLeadList(){
        $this->loadView('autoresponder/autoresponder-list.php');
    }
    
      public function getPeramitter()
	{
		$current_page = isset($_POST['current_page']) ? $this->input->post('current_page') : 1;
		$data = array(
			'search_key' => '',
			'items_per_page' => 10,
			'start' => 1,
			'current_page' => 1,
		);

		if (isset($_POST['search_key'])) {
			$data['search_key'] = $_POST['search_key'];
		}

		if (isset($_POST['items_per_page'])) {
			$data['items_per_page'] = $_POST['items_per_page'];
		}

		if (isset($_POST['current_page'])) {
			$data['current_page'] = $_POST['current_page'];
		}

		return $data;
	}

    public function getResponderLeadList(){
        $data = $this->getPeramitter();

        $response = $this->Settings_integration_Model->get_autoresponder_lead_list_data($data);
		echo json_encode($response);
    }

    public function downloadAutoResponderLead(){
        // echo("I am in DonloadConversation controller");
		$id = $this->input->get('id');

		$htmlContent = '';
		// $generate_html = $this->Conversation_Model->get_conversation_details($id);
		$generate_html = $this->Settings_integration_Model->get_auto_responder_lead_details($id)[0];

        // pr($generate_html);die;

	
		$htmlContent .= "<b>Auto Responder Name:  </b>" . $generate_html['name'] . "<br>" . "<b>Email:  </b>" . $generate_html['email'] . "<br>" ."<b>Create Date:  </b>" . $generate_html['created_date'] . "<br>" ;
        
        $this->load->helper('download');

        $this->pdf->loadHtml($htmlContent);

        $this->pdf->setBasePath(base_url());

        $this->pdf->render();


        $output = $this->pdf->output();

 

        // Set the file name for the downloaded PDF

        $filename = $generate_html['name'] . '.pdf';


        // Force the PDF to download in the browser

        return  force_download($filename, $output, true);
      
    }
}
