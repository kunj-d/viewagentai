
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Youtube_optimisation extends AppDefault {

	public function __construct() {
		parent::__construct();
		$this->checkAlreadyLogout();
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
// 		$this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
        if(!empty($this->session->userdata('business'))){
                $this->business_id = $this->session->userdata('business')['id'];
            }else{
                $this->business_id = $this->session->userdata('business_switch_session');
            }
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id = $this->session->userdata('logged_in')['id'];
		$this->load->model('default/Cron_Model');
		$this->load->model('default/Videocreate_Remotion_Model');
		$this->load->model('default/Youtube_integration_model');
		$this->load->helper('tokengenerate');
	    $this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('instagram_access_token');
		$user_access_token = $query->row();
        // $this->load->model($this->model_folder . "Videocreate_Remotion_Model");
		$this->access_token = $user_access_token->access_token;
        $this->ig_user_id   = $user_access_token->ig_user_id;
        $this->spechify_key = $this->config->item('spechify_key');
        $this->python_api_key ='D684B8EFF387DBD9';
        $this->dupdub_api_key =$this->config->item('dupdub_api_key');
        $this->modelslab_video_key =$this->config->item('modelslab_video_key');
		$this->openaikey = $this->config->item('open_ai_key');
        
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

	}
	

        public function yt_video_optimization()
        {
      
            $this->db->where('business_id', $this->business_id);
            $this->db->where('user_id', $this->owner_id);
            $youtube_access_token = $this->db->get('youtube_access_token')->row_array();
            $data['youtube_access_token'] = $youtube_access_token;
            $this->loadView('yt_integration/ytvideo_optimization', $data);
        }

       	public function get_client_data(){
    		$this->db->select('*'); // or specific columns
            $this->db->from('youtube_access_token');
            $this->db->where('user_id',$this->owner_id);
            $this->db->where('business_id',$this->business_id);
            $query = $this->db->get();
            $result = $query->result();
    
            $tokenData =  json_decode($result[0]->access_token);
    
    		if (!empty($tokenData)) {
    			return $tokenData;
    		} else {
    			echo "Error while getting access token: ";
    			return false;
    		}
    	}
	
		public function set_yt_scopes($gClient) {
		$gClient->setScopes(array('https://www.googleapis.com/auth/youtube.force-ssl',
		'https://www.googleapis.com/auth/youtubepartner-channel-audit',
		'https://www.googleapis.com/auth/youtube',
		'https://www.googleapis.com/auth/youtube.readonly',
		'https://www.googleapis.com/auth/yt-analytics.readonly',
		'https://www.googleapis.com/auth/yt-analytics-monetary.readonly',
		'https://www.googleapis.com/auth/youtube.upload',
		'https://www.googleapis.com/auth/youtubepartner'));
	}


    public function getClient() {
		$this->check_yt_access_token();
		$redirectUrl =  base_url('save-youtube-integration');
		$yt_access_token = $this->get_new_access_token();
		$client_data=  $this->get_client_data();

		$clientId= $client_data->clientId;
		$clientSecret= $client_data->clientSecret;
		$access_token= $client_data->access_token;
		$client = new Google_Client();

		$client->setClientId($clientId);
		$client->setClientSecret($clientSecret);
		$client->setAccessType('offline');
		$this->set_yt_scopes($client);
        $client->setRedirectUri($redirectUrl);

		$client->setAccessToken(json_encode($client_data));

		return $client;
	}
    
    
    
    	public function check_yt_access_token()
    	{
    		if($this->get_new_access_token()) {
    			$yt_access_token = $this->get_client_data();
    			$yt_access_token = (array) $yt_access_token;
    
    			//echo"<pre>"; print_r($yt_access_token); die('refresh');
    			$token_expire_time = $yt_access_token['created']+$yt_access_token['expires_in'];
    			if(($token_expire_time-500)<(time())) {
    				$this->refresh_yt_access_token($yt_access_token);
    			}
    		} else {
    
    			$this->db->where('business_id',$this->business_id);
    			$this->db->where('user_id',$this->owner_id);
    			$query = $this->db->get('youtube_access_token');
    			
    			if($query->num_rows()>0){
    				$yt_access_token = $query->row_array()['access_token'];
    				$yt_access_token = json_decode($yt_access_token);
    				$this->session->set_userdata('yt_access_token',$yt_access_token);
    				$this->refresh_yt_access_token($yt_access_token);
    				//die('ddd');
    				redirect(base_url('youtube_list'));
    			} else {
    				$this->session->set_flashdata('flash_error', "Please Integrate youtube");
    				$this->session->set_flashdata('active_tab', 'youtube');
    				redirect(base_url('integration'));
    			}
    		}
    	}

        	public function refresh_yt_access_token($ses_yt_access_token) {
        		$ses_yt_access_token = (array) $ses_yt_access_token;
        		//echo"<pre>"; print_r($ses_yt_access_token); die('refresh');
        		$clientId=$ses_yt_access_token['clientId'];
        		$clientSecret=$ses_yt_access_token['clientSecret'];
        		$refresh_token=$ses_yt_access_token['refresh_token'];
        		$token_type=$ses_yt_access_token['token_type'];
        		$gClient = new Google_Client();
        		$gClient->setApplicationName('vocalic');
        		$gClient->setClientId($clientId);
        		$gClient->setClientSecret($clientSecret);
        		$this->set_yt_scopes($gClient);
        		$gClient->refreshToken($refresh_token);
        		$yt_access_token = $gClient->getAccessToken();
        
        		if($yt_access_token){
        			$gClient->setAccessToken($yt_access_token);
        		}else{
        			$this->session->set_flashdata('flash_error', "Your Youtube integration setting has been expired.Please integrate again.");
        			redirect(site_url('youtube'));
        		}
        
        		$yt_data = array(
        			'clientId'=>$clientId,
        			'clientSecret'=>$clientSecret,
        			'access_token'=>$yt_access_token['access_token'],
        			'expires_in'=>$yt_access_token['expires_in'],
        			'refresh_token'=>$refresh_token,
        			'token_type'=>$token_type,
        			'created'=>$yt_access_token['created'],
        		);
        		$this->session->set_userdata('yt_access_token', $yt_data);
        		$this->youtube_integration_model->update_yt_access_token($this->owner_id,$this->business_id,$yt_data);
        	}

        		public function get_new_access_token(){
        
                $this->db->select('*'); 
                $this->db->from('youtube_access_token');
                $this->db->where('user_id',$this->owner_id);
                $this->db->where('business_id',$this->business_id);
                $query = $this->db->get();
                $result = $query->result();
        
                $tokenData =  json_decode($result[0]->access_token,true);
        
                $client_id = $tokenData['clientId'];  
                $client_secret = $tokenData['clientSecret'];  
                $refresh_token = $tokenData['refresh_token'];  
        
                $post_fields = [
                    'client_id'     => $client_id,
                    'client_secret' => $client_secret,
                    'refresh_token' => $refresh_token,
                    'grant_type'    => 'refresh_token',
                ];
        
                $ch = curl_init();
        
                curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/x-www-form-urlencoded'
                ]);
    
                $response = curl_exec($ch);
                $error = curl_error($ch);
        
                curl_close($ch);
        
                if ($error) {
                    echo "cURL Error: " . $error;
                    return false;
                } else {
                    $result = json_decode($response, true);
                    if (isset($result['access_token'])) {
                        $access_token_from_refresh_token =  $result['access_token'];
                        return $access_token_from_refresh_token;
                    } else {
                        echo "Error while getting access token: ";
                        print_r($result);
                        return false;
                    }
                }
            }
            
        public function updateYoutubeVideo()
        {
            
            $input = json_decode(file_get_contents("php://input"), true);
            $videoId    = $input['video_id'];
            $title      = $input['title'];
            $description= $input['description'];
            $tags       = $input['tags'];
        
            try {
        
                $client = $this->getClient();
                $service = new Google_Service_YouTube($client);
              
                $response = $service->videos->listVideos(
                    "snippet,status",
                    array(
                        "id" => trim($videoId)
                    )
                );
        
                $items = $response->getItems();
        
                if (empty($items)) {
                    echo json_encode([
                        "success" => false,
                        "msg" => "Video not found."
                    ]);
                    return;
                }
        
                $video = $items[0];
        
                $snippet = $video->getSnippet();
                $status  = $video->getStatus();
        
                $snippet->setTitle($title);
                $snippet->setDescription($description);
                $snippet->setTags($tags);
        
                $video->setSnippet($snippet);
                $video->setStatus($status);
        
                $service->videos->update(
                    "snippet,status",
                    $video
                );
                
                $aeo_score = $input['aeo_score'];  
                
                $this->db->where('video_id', $videoId);
                $this->db->update('analyz_data', [
                    'optimized' => 1,
                    'optimized_score' => $aeo_score
                ]);
                echo json_encode([
                    "success" => true,
                    "msg" => "Video updated successfully."
                ]);
        
            } catch (Exception $e) {
        
                echo json_encode([
                    "success" => false,
                    "msg" => $e->getMessage()
                ]);
            }
        }
     
        	
}