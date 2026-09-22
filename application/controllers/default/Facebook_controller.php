<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Facebook_controller extends AppDefault {

    public function __construct() {
        parent::__construct();

        $this->checkAlreadyLogout();
        $this->openaikey = $this->config->item('open_ai_key');
        $this->business_id = $this->session->userdata('business_id');
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->user_id = $this->session->userdata('logged_in')['id'];
        
        // $this->access_token = config_item('facebook_access_token');
        // $this->page_id = '960079320518209';
        
        $this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('facebook_access_token');
		$user_access_token = $query->row();

		$this->access_token = $user_access_token->access_token;
        $this->page_id   = $user_access_token->page_id;
       
    }

    /* Save Facebook Access Token */

    
    // public function save_fb_access_token()
    // {
    //             pr($_POST); die('here');

    //     $app_id             = $this->input->post('fb_app_id');
    //     $app_secret         = $this->input->post('client_secret');
    //     $access_token       = $this->input->post('fb_access_token');
    //     $page_id            = $this->input->post('fb_page_id');
    
    
    //     if (empty($app_id)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => "APP id required"
    //         ]);
    //         return;
    //     }
        
    //     if (empty($app_secret)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => "client Secret required"
    //         ]);
    //         return;
    //     }

    //     if (empty($access_token)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => "Access Token required"
    //         ]);
    //         return;
    //     }
    //     if (empty($page_id)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => "Page id required"
    //         ]);
    //         return;
    //     }
    //     // ==============================
    //     // STEP 1: Exchange Long-lived Token
    //     // ==============================
    //     $exchange_url = "https://graph.facebook.com/v19.0/oauth/access_token?grant_type=fb_exchange_token&client_id={$app_id}&client_secret={$app_secret}&fb_exchange_token={$access_token}";
    //     $long_token_res = $this->curl_get($exchange_url);

    //     if (empty($long_token_res) || isset($long_token_res->error)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => $long_token_res->error->message ?? "Failed to generate long-lived token"
    //         ]);
    //         return;
    //     }
    
    //     $long_user_token = $long_token_res->access_token;
        

    //     // ==============================
    //     // STEP 2: Get Page Access Token
    //     // ==============================
    //     $page_url = "https://graph.facebook.com/v25.0/me/accounts?access_token={$long_user_token}";

    //     $page_res = $this->curl_get($page_url);
    //     pr($page_res); die('here');

    //     if (empty($page_res) || isset($page_res->error)) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => $page_res->error->message ?? "Failed to fetch pages"
    //         ]);
    //         return;
    //     }
    
    //     $page_access_token = null;
    //     $page_name = '';
    
    //     if (!empty($page_res->data)) {
    //         foreach ($page_res->data as $page) {
    //             if ($page->id == $page_id) {
    //                 $page_access_token = $page->access_token;
    //                 $page_name = $page->name ?? '';
    //                 break;
    //             }
    //         }
    //     }
    
    //     if (!$page_access_token) {
    //         echo json_encode([
    //             "status" => false,
    //             "message" => "Page not found or permission missing"
    //         ]);
    //         return;
    //     }

    //     $data = [
    //         "user_id"       => $this->owner_id,
    //         "business_id"   => $this->business_id,
    //         "page_id"       => $page_id,
    //         "client_secret" => $app_secret,
    //         "access_token"  => $page_access_token, 
    //     ];
    
    //     $exist = $this->db->get_where("facebook_access_token", [
    //         "user_id"     => $this->owner_id,
    //         "business_id" => $this->business_id
    //     ])->row();
    
    //     if ($exist) {
    //         $this->db->where("id", $exist->id);
    //         $this->db->update("facebook_access_token", $data);
    //     } else {
    //         $this->db->insert("facebook_access_token", $data);
    //     }
    
    //     echo json_encode([
    //         "status" => true,
    //         "message" => "Long-lived Page Access Token Saved Successfully",
    //         "page_name" => $page_name
    //     ]);
    // }
    
    
    public function save_fb_access_token()
        {
            $app_id       = $this->input->post('fb_app_id');
            $app_secret   = $this->input->post('client_secret');
            $user_access_token = $this->input->post('fb_access_token');
            $page_id      = $this->input->post('fb_page_id');

            if (empty($app_id)) {
                echo json_encode(["status" => false, "message" => "APP ID required"]);
                return;
            }
        
            if (empty($app_secret)) {
                echo json_encode(["status" => false, "message" => "Client Secret required"]);
                return;
            }
        
            if (empty($user_access_token)) {
                echo json_encode(["status" => false, "message" => "Access Token required"]);
                return;
            }
        
            if (empty($page_id)) {
                echo json_encode(["status" => false, "message" => "Page ID required"]);
                return;
            }
        
            // STEP 1: Long-lived Token
            $exchange_url = "https://graph.facebook.com/v19.0/oauth/access_token?" . http_build_query([
                'grant_type'        => 'fb_exchange_token',
                'client_id'         => $app_id,
                'client_secret'     => $app_secret,
                'fb_exchange_token' => $user_access_token
            ]);
        
            $long_token_res = $this->curl_get($exchange_url);
        
            if (empty($long_token_res) || isset($long_token_res->error)) {
                echo json_encode([
                    "status" => false,
                    "message" => $long_token_res->error->message ?? "Failed to generate long-lived token"
                ]);
                return;
            }
        
            $long_user_token = $long_token_res->access_token;
        
            // STEP 2: Get Pages

            $page_url = "https://graph.facebook.com/v25.0/me/accounts?access_token={$long_user_token}";
            $page_res = $this->curl_get($page_url);
        
            if (empty($page_res) || isset($page_res->error)) {
                echo json_encode([
                    "status" => false,
                    "message" => $page_res->error->message ?? "Failed to fetch pages"
                ]);
                return;
            }
        
            // ==============================
            // STEP 3: Find Matching Page
            // ==============================
            $page_access_token = null;
            $page_name = '';
        
            if (!empty($page_res->data)) {
                foreach ($page_res->data as $page) {
        
                    // IMPORTANT: string compare fix
                    if ((string)$page->id === (string)$page_id) {
                        $page_access_token = $page->access_token;
                        $page_name = $page->name ?? '';
                        break;
                    }
                }
            }
        
            if (!$page_access_token) {
                echo json_encode([
                    "status" => false,
                    "message" => "Page not found or permission missing",
                    "available_pages" => array_map(function($page){
                        return [
                            "id" => $page->id,
                            "name" => $page->name
                        ];
                    }, $page_res->data ?? [])
                ]);
                return;
            }

            $data = [
                "user_id"           => $this->owner_id,
                "business_id"       => $this->business_id,
                "app_id"            => $app_id,
                "page_name"         => $page_name,
                "client_secret"     => $app_secret,
                "access_token"      => $page_access_token,
                "user_access_token" => $user_access_token,
                "page_id"           => $page_id,
            ];
        
            $exist = $this->db->get_where("facebook_access_token", [
                "user_id"     => $this->owner_id,
                "business_id" => $this->business_id,
                "page_id"     => $page_id
            ])->row();
        
            if ($exist) {
                $this->db->where("id", $exist->id)->update("facebook_access_token", $data);
            } else {
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert("facebook_access_token", $data);
            }

            echo json_encode([
                "status" => true,
                "message" => "Page Access Token Saved Successfully",
                "page_name" => $page_name,
                "page_id" => $page_id
            ]);
        }
    
    
    public function delete_fb_access_token(){
        $this->db->where('user_id', $this->user_id);
        $this->db->where('business_id', $this->business_id);
        // $this->db->where('autoresponder_id', $id);
        $deleted = $this->db->delete('facebook_access_token');
        if ($deleted) {
            echo json_encode(['status' => true, 'message' => 'Credentials reset successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'No data found to delete or already deleted.']);
        }
    }

        public function intigration_cond()
        {
            
        if(!in_array('facebook_automation',$this->session->userdata('features')) ) {
            $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
            
            $this->db->where('user_id',$this->owner_id);
    		$this->db->where('business_id',$this->business_id);
    		$query = $this->db->get('facebook_access_token');
    		$user_access_token = $query->row();
            if(empty($user_access_token)){
    			$flashdata['error']['message'] = "Please intigrate details first";
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('message', json_encode($flashdata));
                $this->session->set_flashdata('active_tab', 'facebook');
    			redirect('integration');
    		}
    		

        }
    public function fb_publish_video()
	{ 
	    $this->intigration_cond();
        $output['video_url'] = $_POST['video-url'];
		$this->loadView('facebook_automation/fb_publish', $output);
	}
    /* Upload Video */

    // public function fb_post_video()
    // {
    //     $video_url = $this->input->post('video_url');
    //     $caption = $this->input->post('caption');
    //     $post_type = $this->input->post('post_type');
    //     $schedule_type = $this->input->post('schedule_type');
    //     $schedule_time = $this->input->post('schedule_time');
    //     $schedule_time = preg_replace('/\s*\(.*?\)/', '', $schedule_time);
    //     $unix_timestamp = strtotime($schedule_time);
        
    //     if($schedule_type == 'schedule'){
    //         $data = [
    //             "user_id"     => $this->user_id,
    //             "business_id"   => $this->business_id,
    //             "video_url"     => $video_url,
    //             "post_type"     => $post_type,
    //             "caption"       => $caption,
    //             'schedule_time' => $unix_timestamp,
		  //      'status'   		=> 1,
		  //      "created_at"    => date("Y-m-d H:i:s")
    //         ];
    //         $this->db->insert('facebook_schedule_post', $data);
    //         $insert_id = $this->db->insert_id();
    //         if(!empty($insert_id)){
    //             echo json_encode([
    //                 "success" => true,
    //                 "msg" => 'video schedule successfull',
    //                 "publish_id" => $insert_id
    //             ]);
    //         }else{
    //           echo json_encode([
    //             "success" => false,
    //             "msg" => 'Something went wrong',
    //             "publish_id" => $insert_id
    //         ]); 
    //         }
    //     }else{
    //         $url = "https://graph.facebook.com/v19.0/{$this->page_id}/videos";
    
    //         $postData = [
    //             "file_url"=>$video_url,
    //             "description"=>$caption,
    //             "access_token"=>$this->access_token
    //         ];
    
    //         $response = $this->curl_post($url,$postData);
    
    //         $result = json_decode($response,true);
    
    //         if(isset($result['id'])){
    //             echo json_encode([
    //                 "success"=>true,
    //                 "video_id"=>$result['id']
    //             ]);
    //         }else{
    //             echo json_encode([
    //                 "success"=>false,
    //                 "msg"=>"Upload Failed"
    //             ]);
    //         }
    //     }
    // }  
    
    public function fb_post_video()
    {
        $video_url     = $this->input->post('video_url');
        $caption       = $this->input->post('caption');
        $post_type     = $this->input->post('post_type'); // video | story
        $schedule_type = $this->input->post('schedule_type');
        $schedule_time = $this->input->post('schedule_time');
    
        $schedule_time = preg_replace('/\s*\(.*?\)/', '', $schedule_time);
        $unix_timestamp = strtotime($schedule_time);
    
        /** SCHEDULE POST */
    
        if($schedule_type == 'schedule'){
            $data = [
                "user_id"       => $this->user_id,
                "business_id"   => $this->business_id,
                "video_url"     => $video_url,
                "post_type"     => $post_type,
                "caption"       => $caption,
                "schedule_time" => $unix_timestamp,
                "status"        => 1,
                "created_at"    => date("Y-m-d H:i:s")
            ];
    
            $this->db->insert('facebook_schedule_post',$data);
            $insert_id = $this->db->insert_id();
            if($insert_id){
                echo json_encode([
                    "success"=>true,
                    "msg"=>"Video scheduled successfully",
                    "publish_id"=>$insert_id
                ]);
    
            }else{
                echo json_encode([
                    "success"=>false,
                    "msg"=>"Something went wrong"
                ]);
    
            }
            return;
        }
        /** DIRECT POST */
        if($post_type == 'story'){
    
            /** STORY UPLOAD */
            $result = $this->uploadFacebookVideoStory($this->page_id,$video_url,$this->access_token);
            
              if(!empty($result)){
                   $data = array(
                        'user_id'     => $this->owner_id,
                        'business_id' => $this->business_id,
                        'type'        => 'facebook',
                        'publish_id'  => $result['video_id']
                    );
                
                    $this->db->insert('social_post_count', $data);
                }
    
            if($result['success']){
                echo json_encode([
                    "success"=>true,
                    "msg"=>"Story uploaded successfully",
                    "video_id"=>$result['video_id']
                ]);

            }else{
                echo json_encode([
                    "success"=>false,
                    "msg"=>"Story upload failed",
                    "error"=>$result
                ]);
            }
        }else{
            /** NORMAL VIDEO POST */
            $url = "https://graph.facebook.com/v19.0/{$this->page_id}/videos";
            $postData = [
                "file_url"     => $video_url,
                "description"  => $caption,
                "access_token" => $this->access_token
            ];
            $response = $this->curl_post($url,$postData);
            $result = json_decode($response,true);
            
            if(!empty($result)){
                   $data = array(
                        'user_id'     => $this->owner_id,
                        'business_id' => $this->business_id,
                        'type'        => 'facebook',
                        'publish_id'  => $result['id']
                    );
                
                    $this->db->insert('social_post_count', $data);
                }
            if(isset($result['id'])){
                echo json_encode([
                    "success"=>true,
                    "msg"=>"Video upload successfull",
                    "video_id"=>$result['id']
                ]);
            }else{
                echo json_encode([
                    "success"=>false,
                    "msg"=>"Video upload failed",
                    "error"=>$result
                ]);
    
            }
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
        // pr($start_response); die();
        $start_data = json_decode($start_response, true);
    
        if(empty($start_data['video_id'])){
            return [
                "success" => false,
                "step" => "start",
                "response" => $start_data
            ];
        }
    
        $video_id = $start_data['video_id'];
        $upload_url = $start_data['upload_url'];
        sleep(2);
        /** STEP 2 — UPLOAD VIDEO */
    
        // $upload_url = "https://rupload.facebook.com/video-upload/v24.0/".$video_id;
    
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
    
    
    
    /*------function for get likes,views,reach, on facebook -----*/ 
    public function facebook_publisher()
	{
	    $this->intigration_cond();
        $output = [];
		$this->loadView('facebook_automation/fb_all_videos', $output);
	}

    /* Get Page Posts */
    
    public function get_posts()
    {
    
        $page_id = $this->page_id;
        $url = 'https://graph.facebook.com/v18.0/'.$page_id.'/posts?fields=id,message,full_picture,permalink_url,created_time&limit=9&access_token='.$this->access_token;
        
        $data = $this->curl_get($url);
        if(!empty($data->data)){
            echo json_encode([
                "success"=>true,
                "all_video"=>$data
            ]);
        }else{
            echo json_encode([
                "success"=>false,
                "msg"=>"No posts found"
            ]);
        }
    
    }


    
    
    public function facebook_auto_reply()
	{
	    $this->intigration_cond();
        $output = [];
		$this->loadView('facebook_automation/auto_reply_fb', $output);
	}

    public function save_fb_reply_automation()
    {  

        $triggerkeyword      = strtolower(trim($this->input->post('triggerkeyword')));
        $video_id            = $this->input->post('video_id');
        $reply_text          = $this->input->post('reply_text');
        $max_activity        = $this->input->post('max_activity');
        $delay_activity      = $this->input->post('delay_activity');
        $delay_activity_time = $this->input->post('delay_activity_time');
        $stop_setting        = $this->input->post('stop_setting');
        $stop_setting_time   = $this->input->post('stop_setting_time');
    
        $valcustomreply = $this->input->post('iscustomreply');
        $iscustomreply  = ($valcustomreply === 'true') ? 1 : 0;
    
        $delayInSeconds = $this->getDelayInSeconds($delay_activity,$delay_activity_time);
        $schedule_time  = time() + $delayInSeconds;
    
        $setting_data = [
            "business_id"=>$this->business_id,
            "video_id"=>$video_id,
            "triggerkeyword"=>$triggerkeyword,
            "reply_text"=>$reply_text,
            "max_activity"=>$max_activity,
            "delay_activity"=>$delay_activity,
            "delay_activity_time"=>$delay_activity_time,
            "stop_setting"=>$stop_setting,
            "stop_setting_time"=>$stop_setting_time,
            "schedule_time"=>$schedule_time,
            "iscustomreply"=>$iscustomreply,
            "status"=>1,
            "created_at"=>date("Y-m-d H:i:s")
        ];
    
        /** CHECK EXISTING SETTINGS */
    
        $query = $this->db->get_where("facebook_reply_settings",[
            "video_id"=>$video_id
        ]);
    
        $already_exit = ($query && $query->num_rows()>0) ? $query->row() : null;
        if($already_exit){
            $this->db->where('video_id',$video_id);
            $this->db->update("facebook_reply_settings",$setting_data);
        }else{
            $this->db->insert('facebook_reply_settings',$setting_data);
        }
        /** FETCH COMMENTS */
        $comments = $this->get_fb_comments($video_id);
        if(!$comments || empty($comments->data)){
            echo json_encode([
                "status"=>false,
                "msg"=>"No comments found"
            ]);
            return;
        }
        $all_comments = $comments->data;
        $keywords = array_map('trim',explode(',',$triggerkeyword));
        $matched = [];
        $processed_ids = [];
    
        foreach($all_comments as $c){
            if(empty($c->message)) continue;
            $comment_text = strtolower(trim($c->message));
            $comment_id   = $c->id;
    
            /** ALREADY REPLIED CHECK */
            $query = $this->db->get_where("facebook_replied_comments",[
                "comment_id"=>$comment_id,
                "video_id"=>$video_id
            ]);
            $reply_already = ($query && $query->num_rows()>0) ? $query->row() : null;
    
            if($reply_already) continue;
            /** KEYWORD MATCH */
            foreach($keywords as $keyw){
                if($keyw == "") continue;
                if(strpos($comment_text,$keyw) !== false){
                    if(!in_array($comment_id,$processed_ids)){
                        $matched[] = $c;
                        $processed_ids[] = $comment_id;
                    }
                    break;
                }
            }
        }
    
        /** SEND REPLY */
    
        foreach($matched as $comment){
            $comment_id = $comment->id;
            $query = $this->db->get_where("facebook_replied_comments",[
                "comment_id"=>$comment_id,
                "video_id"=>$video_id
            ]);
            
            $check_again = ($query && $query->num_rows()>0) ? $query->row() : null;
            
            if($check_again) continue;
    
            if($iscustomreply == 1){
                $final_reply = $reply_text;
            }else{
                $final_reply = $this->generateOpenAiReply($triggerkeyword);
            }
    
            $result = $this->fb_reply_comment($comment_id,$final_reply);
            sleep(10);
            if(!empty($result['id'])){
                $this->db->insert("facebook_replied_comments",[
                    "user_id"=>$this->user_id,
                    "video_id"=>$video_id,
                    "comment_id"=>$comment_id,
                    "reply_id"=>$result['id'],
                    "reply_text"=>$final_reply,
                    "keyword"=>$triggerkeyword,
                    "created_at"=>date("Y-m-d H:i:s")
                ]);
            }
        }
    
        echo json_encode([
            "success"=>true,
            "msg"=>"Reply successful"
        ]);
    }
    
    
    public function fb_reply_comment($comment_id,$reply_text)
    {
        $url = "https://graph.facebook.com/v18.0/".$comment_id."/comments";
        $payload = [
            "message"=>$reply_text,
            "access_token"=>$this->access_token
        ];
        $response = $this->curl_post($url,$payload);
        return json_decode($response,true);
    }
    
    
    public function get_fb_comments($post_id)
    {
        $url = "https://graph.facebook.com/v18.0/".$post_id."/comments?fields=id,message,created_time,from&limit=100&access_token=".$this->access_token;
        return $this->curl_get($url);
    }	


    /* Post Insights */

    public function get_fb_insights()
    {
        $page_id = $this->page_id;
        $after   = $this->input->get('after');
        $posts_url = "https://graph.facebook.com/v21.0/{$page_id}/posts?fields=id,message,permalink_url,created_time,full_picture,reactions.summary(true),comments.summary(true),shares&limit=5&access_token={$this->access_token}";
    
        if (!empty($after)) {
            $posts_url .= "&after=" . $after;
        }
    
        $posts_data = $this->curl_get($posts_url);
        if (empty($posts_data->data)) {
            echo json_encode([
                "success" => false,
                "message" => "No posts found",
                "next"    => ''
            ]);
            return;
        }
    
        $final_output = [];
    
        foreach ($posts_data->data as $post) {
            $post_id = $post->id;
    
            $insights_url = "https://graph.facebook.com/v21.0/{$post_id}/insights?metric=post_impressions_unique&access_token={$this->access_token}";
            $insights_data = $this->curl_get($insights_url);
    
            // Reach
            $reach = 0;
            if (!empty($insights_data->data[0]->values[0]->value)) {
                $reach = $insights_data->data[0]->values[0]->value;
            }
    
            // Likes
            $likes = 0;
            if (!empty($post->reactions->summary->total_count)) {
                $likes = $post->reactions->summary->total_count;
            }
    
            // Comments
            $comments = 0;
            if (!empty($post->comments->summary->total_count)) {
                $comments = $post->comments->summary->total_count;
            }
    
            // Views (default 0 because only video posts have it)
            $views = 0;
    
            $final_output[] = [
                "id"           => $post->id,
                "thumbnail"    => isset($post->full_picture) ? $post->full_picture : '',
                "media_type"   => "POST",
                "media_url"    => isset($post->full_picture) ? $post->full_picture : '',
                "permalink"    => $post->permalink_url,
                "timestamp"    => $post->created_time,
                "caption"      => isset($post->message) ? $post->message : '',
                "likeCount"    => $likes,
                "viewCount"    => $views,
                "commentCount" => $comments,
                "reachCount"   => $reach
            ];
        }
        
        $next_cursor = isset($posts_data->paging->cursors->after) ? $posts_data->paging->cursors->after : null;
    
        echo json_encode([
            "success" => true,
            "data"    => $final_output,
            "next"    => $next_cursor
        ]);
    }

    /* Schedule Post */

    public function get_fb_schedule_video()
        {
            $this->db->from('facebook_schedule_post');
            $this->db->where('business_id', $this->business_id);
            $this->db->where('status', 1);
            $schedule_data = $this->db->get()->result_array();
            echo json_encode([
                "success" => true,
                "schedule_data"    => $schedule_data,
            ]);
            
        }

    /* Delete Scheduled */

    public function delete_fb_schedule_video()
    {
        $id = $this->input->post('video_id');
        $this->db->where("id",$id);
        $this->db->delete("facebook_schedule_post");
        // pr($this->db->last_query()); die();

        echo json_encode([
            "success"=>true,
            "msg"=>"Deleted"
        ]);
    }


    public function curl_post($url,$data)
    {
        $ch = curl_init();
        curl_setopt_array($ch,[
            CURLOPT_URL=>$url,
            CURLOPT_RETURNTRANSFER=>true,
            CURLOPT_POST=>true,
            CURLOPT_POSTFIELDS=>$data
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    public function curl_get($url)
    {
        $c = curl_init($url);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($c);
        curl_close($c);
        return json_decode($res);
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
	  

    
    
    public function fb_video_count()
        {
            $page_id = $this->page_id;
            $url = 'https://graph.facebook.com/v18.0/'.$page_id.'/posts?fields=id,message,full_picture,permalink_url,created_time&limit=100&access_token='.$this->access_token;
    
            $data = $this->curl_get($url);
            $total_count = isset($data->data) ? count($data->data) : 0;
            echo json_encode([
                "success" => true,
                "all_video_count" => $total_count
            ]);
           
        }

}