<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Crone_insta_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->user_id 			= $this->session->userdata('id');
		$this->load->model('default/youtube_integration_model');
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->openaikey = $this->config->item('open_ai_key');
        
	}

	public function index(){
		$this->replyInstaAutomation(); // Call your main logic here
	}

    public function get_access_token(){

			$this->db->select('*');
			$this->db->from('insta_reply_settings');
			$this->db->join('instagram_access_token', 'insta_reply_settings.business_id = instagram_access_token.business_id'); // JOIN condition
			$query = $this->db->group_by('instagram_access_token.business_id')->get();
			$result = $query->result();
			
			pr($result); die;
			$tokenData =  $result[0]->access_token ;
			pr($this->db->last_query()); die('hree');
	
        $access_token = $tokenData['access_token'];  // apna access_token
        $ig_user_id = $tokenData['ig_user_id'];  // apna ig_user_id

    }
    
     public function replyInstaAutomation()
    {
        $mesage = '';
//         ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
        $this->db->select('irs.*, iat.access_token, iat.ig_user_id');
        $this->db->from('insta_reply_settings irs');
        $this->db->join('instagram_access_token iat', 'iat.business_id = irs.business_id');
        $this->db->where('irs.status', 1);
    
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
            $ig_user_id       = $config['ig_user_id'];
            
            if($delayActivity == 0){
				$delayActivity = 0;
				$delayUnit = 'min';
			}
         	$delayInSeconds  = $this->getDelayInSeconds($delayActivity, $delayTime);
         		$final_time =  $scheduleTime;
         		
         		
         		
            /** Schedule check  hold **/
            // if (time() < $scheduleTime) {
            //     continue;
            // }
   
            /** Stop condition */
            // if ($stopSetting == 1 && !empty($stopTime)) {
              
            //     if (time() >= strtotime($stopTime)) {
            //         $this->db->where('id', $id)
            //                  ->update('insta_reply_settings', ['status' => 0]);
            //         continue;
            //     }
            // }
            
        if(time() >= $final_time ){
            
            	$createdDate = new DateTime($config['created_at']);
				$plusday  = $createdDate->modify("+$stopSetting days");
				$now = new DateTime();

				if ($now > $plusday) {
					$this->db->set('status', '0', false)
						->where('id', $id)
						->update('insta_reply_settings ');
					continue;
				} 
				
			
            /**  Delay */
            if ($delayActivity == 1 && $delayTime > 0) {
                sleep($delayTime);
            }
        
            /** Keyword array */
            $keywords = !empty($triggerkeyword) ? array_map('strtolower', array_map('trim', explode(',', $triggerkeyword))) : [];
        
            /**  Get Instagram comments */
            $comments = $this->getInstagramComments($video_id, $accessToken);
            if (empty($comments['data'])) continue;
        
            /** Owner ke comments hatao */
            $comments = array_filter($comments['data'], function ($c) use ($ig_user_id) {
                return isset($c['from']['id']) && $c['from']['id'] != $ig_user_id;
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
                $exists = $this->db->get_where('insta_replied_comments', [
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
                $url = "https://graph.facebook.com/v19.0/{$comment_id}/replies";
                $payload = [
                    'message'      => $reply_text,
                    'access_token' => $accessToken
                ];
        
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
        
                $result = json_decode($response, true);
        
                if (!empty($result['id'])) {
        
                    $this->db->insert('insta_replied_comments', [
                        'business_id' => $config['business_id'],
                        'video_id'    => $video_id,
                        'comment_id'  => $comment_id,
                        'reply_id'    => $result['id'],
                        'reply_text'  => $reply_text,
                        'keyword'     => $triggerkeyword,
                        'created_at'  => date('Y-m-d H:i:s')
                    ]);
        
                    $repliedCount++;
                    sleep(10); // anti-spam 
                }
            }
        
            /** Next schedule */
            	$new_schedule_time  =  $final_time +  $delayInSeconds;
            	
				$this->db->where('id', $id);  
				$this->db->update('insta_reply_settings', ['schedule_time' => $new_schedule_time]);
            $mesage = 'post successfully';
       }
           else{
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
    
    
        public function schedule_auto_post()
        {
        $this->db->select('iap.*, iat.access_token, iat.ig_user_id');
        $this->db->from('insta_auto_publish iap');
        $this->db->join('instagram_access_token iat', 'iat.business_id = iap.business_id');
        $this->db->where('iap.status', 1);
    
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
                $ig_user_id         = $auto_data['ig_user_id'];
            
                /** Schedule check  **/
                if (time() < $scheduleTime) {
                    continue;
                }
                
                $publish_id = $this->upload_reel($post_type ,$video_url ,$caption ,$scheduleTime ,$accessToken ,$ig_user_id);
                
                if ($publish_id) {
                    $this->db->where('id', $id) ->update('insta_auto_publish', ['status' => 0]);
                    continue;
                }
                
                echo json_encode([
                    "success" => true,
                    "msg"     => "Instagram auto post executed successfully"
                ]);
        }
   
    }  
    
    
        /*------function for reel upload  on Instagram-----*/
	    public function upload_reel($post_type ,$video_url ,$caption ,$scheduleTime ,$accessToken ,$ig_user_id)
        {
                //Create container
            $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media";
        
            $postData = [
                'video_url'     => $video_url,
                'caption'       => $caption,
                'media_type'    => $post_type,
                'access_token'  => $accessToken
            ];
        
            $response = $this->curl_post($url, $postData);
            $data = json_decode($response, true);
        
            if (!isset($data['id'])) {
                echo json_encode([
                    "success" => false,
                    "msg" => 'Container creation failed:',
                    "publish_id" => $data
                ]); 
                     return false;
                }
            $container_id = $data['id'];

            //Wait until upload complete (IMPORTANT)
            $status = $this->check_status($container_id, $accessToken);

            if ($status !== "FINISHED" && $status !== "READY") {
                echo "Video not ready yet. Status: ".$status;
                 return false;
            }
        
            // Publish reel function 
            $publish = $this->publish_reel($container_id, $accessToken , $ig_user_id);
            
            $publish_id = json_decode($publish, true);
            
            return $publish_id ;

        }


        public function check_status($container_id, $accessToken)
        {
            $status_url = "https://graph.facebook.com/v19.0/{$container_id}?fields=status_code&access_token={$accessToken}";
        
            for ($i = 0; $i < 20; $i++) {
                $response = file_get_contents($status_url);
                $data = json_decode($response, true);
        
                if (isset($data['status_code'])) {
                    if ($data['status_code'] == "FINISHED" || $data['status_code'] == "READY") {
                        return $data['status_code'];
                    }
                }
        
                sleep(3); // wait before checking again
            }
        
            return "TIMEOUT";
        }


        public function publish_reel($creation_id, $accessToken ,$ig_user_id)
        {
        
            $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media_publish";
        
            $postData = [
                'creation_id'  => $creation_id,
                'access_token' => $accessToken
            ];
        
            return $this->curl_post($url, $postData);
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
    
    
    public function getInstagramComments($media_id, $access_token)
    {
        $url = "https://graph.facebook.com/v19.0/{$media_id}/comments" . "?fields=id,text,from{id,username},timestamp" . "&access_token={$access_token}";
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
	

// 	public function getInstagramComments($media_id, $access_token)
//     {
//         $url = "https://graph.facebook.com/v19.0/{$media_id}/comments"
//              . "?fields=id,text,username,timestamp"
//              . "&access_token={$access_token}";
    
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
//         $response = curl_exec($ch);
//         curl_close($ch);
//     pr(json_decode($response, true)); die('here');
//         return json_decode($response, true);
//     }


}
?>