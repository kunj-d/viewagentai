<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Crone_fb_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->user_id 			= $this->session->userdata('id');
		$this->load->model('default/youtube_integration_model');
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->openaikey = $this->config->item('open_ai_key');

	}


         public function facebookreplyAutomation()
        {
            $mesage = '';
            $this->db->select('frs.*, fat.access_token, fat.page_id');
    		$this->db->from('facebook_reply_settings frs');
    		$this->db->join('facebook_access_token fat', 'fat.business_id = frs.business_id');
    		$this->db->where('frs.status', 1);
        
            $settings = $this->db->get()->result_array();
            if (empty($settings)) {
                echo json_encode(["success" => false, "msg" => "No active settings"]);
                return;
            }
           foreach ($settings as $config) {
                $id               = (int)$config['id'];
                $video_id         = $config['video_id'];
                $reply_text       = trim($config['reply_text']);
                $triggerkeyword   = trim($config['triggerkeyword']);
                $maxActivity      = (int)$config['max_activity'];
                $delayActivity    = (int)$config['delay_activity'];
                $delayTime        = $config['delay_activity_time'];
                $stopSetting      = (int)$config['stop_setting'];
                $stopTime         = $config['stop_setting_time'];
                $scheduleTime     = (int)$config['schedule_time'];
                $accessToken      = $config['access_token'];
                $fb_page_id       = $config['page_id'];
                
                if($delayActivity == 0){
    				$delayActivity = 0;
    				$delayUnit = 'min';
    			}
             	$delayInSeconds  = $this->getDelayInSeconds($delayActivity, $delayTime);
             		$final_time =  $scheduleTime;
             		
                
            if(time() >= $final_time ){
                
                	$createdDate = new DateTime($config['created_at']);
    				$plusday  = $createdDate->modify("+$stopSetting days");
    				$now = new DateTime();
    
    				if ($now > $plusday) {
    					$this->db->set('status', '0', false)
    						->where('id', $id)
    						->update('facebook_reply_settings ');
    					continue;
    				} 
    				
    			
                /**  Delay */
                if ($delayActivity == 1 && $delayTime > 0) {
                    sleep($delayTime);
                }
            
                /** Keyword array */
                $keywords = !empty($triggerkeyword) ? array_map('strtolower', array_map('trim', explode(',', $triggerkeyword))) : [];
            
                /**  Get Instagram comments */
                $comments = $this->getFacebookComments($video_id, $accessToken);
                if (empty($comments['data'])) continue;
            
                /** Owner ke comments hatao */
                $comments = array_filter($comments['data'], function ($c) use ($fb_page_id) {
                    return isset($c['from']['id']) && $c['from']['id'] != $fb_page_id;
                });
            
                /**  Keyword filter  */
                if (!empty($keywords)) {
                    $comments = array_filter($comments, function ($c) use ($keywords) {
                        foreach ($keywords as $kw) {
                            if ($kw !== '' && stripos($c['text'], $kw) !== false) {
                                return true;
                            }
                        }
                        return false;
                    });
                }
            
                /**  maxActivity limit */
                $finalComments = array_slice($comments, 0, $maxActivity);
            
                if (empty($finalComments)) {
                    continue;
                }
            
                $repliedCount = 0;
            
                foreach ($finalComments as $c) {
            
                    $comment_id = $c['id'];
            
                    /** Duplicate reply check */
                    $exists = $this->db->get_where('facebook_replied_comments', [
                        'comment_id' => $comment_id,
                        'video_id'   => $video_id
                    ])->row();
            
                    if ($exists) continue;
            
                    /**  Reply */
                    
                    if($config['iscustomreply'] == 1){
                        $reply_text = $reply_text;
                    }else{
                        $reply_text = $this->generateOpenAiReply($triggerkeyword);
                    }
                    /** Send Facebook reply */
    				$url = "https://graph.facebook.com/v19.0/".$comment_id."/comments";
    				$payload = [
    					'message'=>$final_reply,
    					'access_token'=>$accessToken
    				];
    				
    				$ch = curl_init($url);
    				curl_setopt($ch,CURLOPT_POST,true);
    				curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($payload));
    				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    				$response = curl_exec($ch);
    				curl_close($ch);
    				$result = json_decode($response,true);
    				
    				if(!empty($result['id'])){
    					$this->db->insert('facebook_replied_comments',[
    						'business_id'=>$config['business_id'],
    						'video_id'=>$post_id,
    						'comment_id'=>$comment_id,
    						'reply_id'=>$result['id'],
    						'reply_text'=>$final_reply,
    						'keyword'=>$triggerkeyword,
    						'created_at'=>date('Y-m-d H:i:s')
    					]);
    					sleep(10); // anti spam
                    }
                }
            
                /** Next schedule */
                	$new_schedule_time  =  $final_time +  $delayInSeconds;
                	
    				$this->db->where('id', $id);  
    				$this->db->update('insta_reply_settings', ['schedule_time' => $new_schedule_time]);
                    $mesage = 'post successfully';
                }else{
                    $mesage = 'no post data';
                }
            
            }
    
            echo json_encode([
                "success" => true,
                "msg"     => $mesage,
            ]);
        }
    
    
    	public function generateOpenAiReply($text){
            $prompt = "Generate a professional reply to this comment: " . $text;
    		$open_ai = new OpenAi($this->openaikey);
    		$history[] = ["role" => "user", "content" => $prompt];
    
    		$opt = [
    			"model" => "gpt-3.5-turbo",
    			"messages" => $history,
    			"temperature" => 0.5,
    			"max_tokens" => 1000,
    		];
    
    		$response = $open_ai->chat($opt);
    		$data = json_decode($response, true);
    
    		return $data["choices"][0]["message"]["content"] ?? "Thanks for your comment!";
    	}
    
    
        public function facebook_schedule_auto_post()
        {
        $this->db->select('fsp.*, fat.access_token, fat.page_id');
        $this->db->from('facebook_schedule_post fsp');
        $this->db->join('facebook_access_token fat', 'fat.business_id = fsp.business_id');
		$this->db->where('fsp.status', 1);
    
        $auto_post_data = $this->db->get()->result_array();

        if (empty($auto_post_data)) {
            echo json_encode(["success" => false, "msg" => "No active data for post"]);
            return;
        }
           foreach ($auto_post_data as $auto_data) {
                $id                 = (int)$auto_data['id'];
                $post_type          = $auto_data['post_type'];
                $video_url          = $auto_data['video_url'];
                $caption            = $auto_data['caption'];
                $scheduleTime       = (int)$auto_data['schedule_time'];
                $accessToken        = $auto_data['access_token'];
                $fb_page_id         = $auto_data['page_id'];
            
                /** Schedule check  **/
                if (time() < $scheduleTime) {
                    continue;
                }
                if($post_type == 'story'){
                    $publish_id = $this->uploadFacebookVideoStory($fb_page_id, $video_url, $accessToken);
                }else{
                    /** NORMAL VIDEO POST */
                    $url = "https://graph.facebook.com/v19.0/{$fb_page_id}/videos";
                    $postData = [
                        "file_url"     => $video_url,
                        "description"  => $caption,
                        "access_token" => $accessToken
                    ];
                    $response = $this->curl_post($url,$postData);
                    $result = json_decode($response,true);
                    $publish_id = $result['id'];
                }
                
                
                if ($publish_id) {
                    $this->db->where('id', $id) ->update('facebook_schedule_post', ['status' => 0]);
                    continue;
                }
                
                echo json_encode([
                    "success" => true,
                    "msg"     => "Facebook auto post executed successfully"
                ]);
        }
   
    }  
    
    
      public function uploadFacebookVideoStory($page_id, $video_url, $access_token)
        {
            $start_url = "https://graph.facebook.com/v24.0/{$page_id}/video_stories";
        
            $start_payload = [
                "upload_phase" => "start",
                "access_token" => $access_token
            ];
        
            $start_response = $this->curl_post($start_url, $start_payload);
            $start_data = json_decode($start_response, true);
        
            if(empty($start_data['video_id'])){
                return [
                    "success" => false,
                    "step" => "start",
                    "response" => $start_data
                ];
            }
        
            $video_id = $start_data['video_id'];
            sleep(2);
            /** STEP 2 — UPLOAD VIDEO */
        
            $upload_url = "https://rupload.facebook.com/video-upload/v24.0/".$video_id;
        
            $headers = [
                "Authorization: OAuth ".$access_token,
                "file_url: ".$video_url,
                "Content-Type: application/octet-stream"
            ];
        
            $ch = curl_init();
        
            curl_setopt_array($ch,[
                CURLOPT_URL => $upload_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => $headers
            ]);
        
            $upload_response = curl_exec($ch);
            curl_close($ch);
        
            $upload_data = json_decode($upload_response,true);
             sleep(10);
            /** STEP 3 — FINISH STORY */
        
            $finish_url = "https://graph.facebook.com/v24.0/{$page_id}/video_stories";
        
            $finish_payload = [
                "upload_phase" => "finish",
                "video_id" => $video_id,
                "access_token" => $access_token
            ];
        
            $finish_response = $this->curl_post($finish_url,$finish_payload);
            $finish_data = json_decode($finish_response,true);
        
            if(isset($finish_data['success']) || isset($finish_data['id'])){
                return [
                    "success" => true,
                    "video_id" => $video_id,
                    "response" => $finish_data
                ];
            }
        
            return [
                "success" => false,
                "step" => "finish",
                "response" => $finish_data
            ];
        }

        
        public function curl_post($url, $data)
        {
            $ch = curl_init();
        
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data
            ]);
        
            $response = curl_exec($ch);
            curl_close($ch);
        
            return $response;
        }
	
    
	public function getDelayInSeconds($amount, $unit) {
		switch ($unit) {
			case 'min':
			case 'minute':
			case 'minutes':
				return $amount * 60;
			case 'hour':
			case 'hours':
				return $amount * 3600;
			case 'sec':
			case 'second':
			case 'seconds':
				return $amount;
			default:
				return 0;
		}
	}
    
    
	public function getFacebookComments($post_id,$access_token){

		$url = "https://graph.facebook.com/v19.0/".$post_id."/comments"."?fields=id,message,from{name,id},created_time"."&access_token=".$access_token;
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response,true);

	}
	




}
?>