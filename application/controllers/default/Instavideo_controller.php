<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Instavideo_controller extends AppDefault {

	public function __construct() {
		parent::__construct(); 
		$this->checkAlreadyLogout();
		$this->openaikey = $this->config->item('open_ai_key');
		$this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id = $this->session->userdata('logged_in')['id'];
		$this->load->model('default/Cron_Model');
// 		$this->access_token = config_item('instagram_access_token');
//      $this->ig_user_id   = "17841477057808967";
//      $this->fb_page_id   = "770370676164732";

	    $this->db->where('user_id',$this->owner_id);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('instagram_access_token');
		$user_access_token = $query->row();

		$this->access_token = $user_access_token->access_token;
        $this->ig_user_id   = $user_access_token->ig_user_id;
        
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

	}
   

        public function automation(){
    		$this->loadView('instavideo/automation');
    	}
	    

        public function save_insta_access_token()
        {
            $access_token = trim($this->input->post('access_token'));
            $fb_page_id   = trim($this->input->post('fb_page_id'));
        
            // Basic Validation
            if (empty($fb_page_id)) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Facebook Page ID required',
                    'error_field' => 'fb_page_id'
                ]);
                return;
            }
        
            if (empty($access_token)) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Access Token required',
                    'error_field' => 'access_token'
                ]);
                return;
            }
        
            // Graph API Request
            $url = "https://graph.facebook.com/v19.0/{$fb_page_id}?fields=instagram_business_account&access_token={$access_token}";
        
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true
            ]);
        
            $response = curl_exec($ch);
        
            if (curl_errno($ch)) {
                echo json_encode([
                    "status" => false,
                    "message" => "cURL Error: " . curl_error($ch)
                ]);
                curl_close($ch);
                return;
            }
        
            curl_close($ch);
        
            $result = json_decode($response, true);
            // Facebook returned error
            if (isset($result['error'])) {
                echo json_encode([
                    'status' => false,
                    'message' => "Please varify your Access Token & Facebook page id",
                    // 'message' => $result['error']['message']
                ]);
                return;
            }
        
            // Instagram User ID missing
            if (!isset($result['instagram_business_account']['id'])) {
                echo json_encode([
                    'status' => false,
                    'message' => "Instagram Business Account is NOT connected to this Facebook Page."
                ]);
                return;
            }
        
            $ig_user_id = $result['instagram_business_account']['id'];
        
            $data = [
                'user_id'       => $this->owner_id,
                'business_id'   => $this->business_id,
                'access_token'  => $access_token,
                'fb_page_id'    => $fb_page_id,
                'ig_user_id'    => $ig_user_id,
            ];
        
             $existing = $this->db->get_where('instagram_access_token', [
                'user_id'     => $this->owner_id,
                'business_id' => $this->business_id
            ])->row_array();
        
            if ($existing) {
                $this->db->where('id', $existing['id']);
                $this->db->update('instagram_access_token', $data);
        
                echo json_encode([
                    "status" => true,
                    "message" => "Access Token Updated Successfully!",
                    "ig_user_id" => $ig_user_id
                ]);
            } else {
                $this->db->insert('instagram_access_token', $data);
        
                echo json_encode([
                    "status" => true,
                    "message" => "Instagram Access Token Saved Successfully!",
                    "ig_user_id" => $ig_user_id
                ]);
            }
        }
        
        public function delete_insta_access_token(){
            $this->db->where('user_id', $this->user_id);
            $this->db->where('business_id', $this->business_id);
            // $this->db->where('autoresponder_id', $id);
            $deleted = $this->db->delete('instagram_access_token');
            if ($deleted) {
                echo json_encode(['status' => true, 'message' => 'Credentials reset successfully.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'No data found to delete or already deleted.']);
            }
        }


        public function intigration_cond()
        {
            
        if(!in_array('insta_automation',$this->session->userdata('features')) ) {
            $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
            
            $this->db->where('user_id',$this->owner_id);
    		$this->db->where('business_id',$this->business_id);
    		$query = $this->db->get('instagram_access_token');
    		$user_access_token = $query->row();
            if(empty($user_access_token)){
    			$flashdata['error']['message'] = "Please intigrate details first";
                $flashdata['error']['type'] = 'flash';
                $this->session->set_flashdata('message', json_encode($flashdata));
                $this->session->set_flashdata('active_tab', 'insta');
    			redirect('integration');
    		}
    		

        }

    	public function publish_video()
    	{ 
    	    $this->intigration_cond();
            $output['video_url'] = $_POST['video-url'];
    		$this->loadView('instavideo/ig_publish', $output);
    	}
	
	
        /*------function for video upload  on s3 bucket-----*/
        public function upload_reel_video()
        {
            if (empty($_FILES['video']['name'])) {
                echo json_encode([
                    "success" => false,
                    "message" => "No video file received."
                ]);
                return;
            }
        
            // User Folder
            $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id;
            $library_folder = "reels_videos";
            $this->validateFolderDirectory($library_folder);
        
            $upload_path = $ownerDirectoryName . '/' . $library_folder . '/';
        
            // Upload Configuration
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'mp4';
            $config['max_size']      = 102400; 
            $config['file_ext_tolower'] = TRUE;
        
            $this->upload->initialize($config);
        
            // Upload MP4 file
            if (!$this->upload->do_upload('video')) {
                echo json_encode([
                    "success" => false,
                    "message" => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        
            // Get File Info
            $fileData = $this->upload->data();
            $local_file_path = $upload_path . $fileData['file_name'];
        
            // Upload to AWS
            $aws_path = $this->uploadAWS($local_file_path);
            $cdn_url = $this->config->item('bucket_url') . $local_file_path;
            // Send back response
            echo json_encode([
                "success" => true,
                "cdn_url" => $cdn_url
            ]);
        }
        
    
    /*------function for reel upload  on Instagram-----*/
	    public function upload_reel()
        {
            // pr($_POST); die;
            $video_url = $this->input->post('video_url');
            $caption = $this->input->post('caption');
            $post_type = $this->input->post('post_type');
            $schedule_type = $this->input->post('schedule_type');
            $schedule_time = $this->input->post('schedule_time');
            $schedule_time = preg_replace('/\s*\(.*?\)/', '', $schedule_time);
            $unix_timestamp = strtotime($schedule_time);
            
            $access_token = $this->access_token;
            $ig_user_id   = $this->ig_user_id;
            
            if($schedule_type == 'schedule'){
                $data = [
                    "user_id"     => $this->user_id,
                    "business_id"   => $this->business_id,
                    "video_url"     => $video_url,
                    "post_type"     => $post_type,
                    "caption"       => $caption,
                    'schedule_time' => $unix_timestamp,
    		        'status'   		=> 1,
    		        "created_at"    => date("Y-m-d H:i:s")
                ];
                $this->db->insert('insta_auto_publish', $data);
                $insert_id = $this->db->insert_id();
                
                if(!empty($insert_id)){
                    echo json_encode([
                        "success" => true,
                        "msg" => 'video schedule successfull',
                        "publish_id" => $insert_id
                    ]);
                }else{
                   echo json_encode([
                    "success" => false,
                    "msg" => 'Something went wrong',
                    "publish_id" => $insert_id
                ]); 
                }
            }else{
            
                //Create container
                $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media";
            
                $postData = [
                    'video_url'     => $video_url,
                    'caption'       => $caption,
                    'media_type'    => $post_type,
                    'access_token'  => $access_token
                ];
            
                $response = $this->curl_post($url, $postData);
                // pr($response); die();
                $data = json_decode($response, true);
               $container_id = $data['id'];
                // pr($data); die;
                // sleep(5);
            
                if (empty($container_id) && $container_id === "" ) {
                    echo json_encode([
                        "success" => false,
                        "msg" => 'Container creation failed:',
                        "publish_id" => $data
                    ]); 
                        return;
                    }
                
    
                //Wait until upload complete (IMPORTANT)
                $status = $this->check_status($container_id, $access_token);

                if ($status !== "FINISHED" && $status !== "READY") {
                    echo json_encode([
                        "success" => false,
                        "msg" => "Something Went Wrong.",
                        "error" => $status
                    ]);
                    // echo "Video not ready yet. Status: ".$status;
                    exit;
                }
                //  sleep(5);
                // Publish reel function 
                $publish = $this->publish_reel($container_id, $access_token);
                

                $publish_id = json_decode($publish, true);
                
                if(!empty($publish_id)){
                   $data = array(
                        'user_id'     => $this->owner_id,
                        'business_id' => $this->business_id,
                        'type'        => 'instagram',
                        'publish_id'  => $publish_id
                    );
                
                    $this->db->insert('social_post_count', $data);
                }
                
                if(!empty($publish_id)){
                    echo json_encode([
                        "success" => true,
                        "msg" => 'video upload successfull',
                        "publish_id" => $publish_id
                    ]);
                }else{
                   echo json_encode([
                    "success" => false,
                    "msg" => 'Something went wrong',
                    "publish_id" => $publish_id
                ]); 
                }
            } 
        }


        public function check_status($container_id, $access_token)
        {
            $status_url = "https://graph.facebook.com/v19.0/{$container_id}?fields=status_code&access_token={$access_token}";
        
            for ($i = 0; $i < 10; $i++) {
        
                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL            => $status_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT        => 30,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                ]);
        
                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    curl_close($ch);
                    return "CURL_ERROR";
                }
        
                curl_close($ch);
        
                $data = json_decode($response, true); // ARRAY
        
                // Facebook API error
                if (isset($data['error'])) {
                    return $data['error']['message'];
                }
        
                // Status received
                if (isset($data['status_code'])) {
        
                    if ($data['status_code'] === 'FINISHED' || $data['status_code'] === 'READY') {
                        return $data['status_code'];
                    }
                }
        
                sleep(5); // wait before next try
            }
        
            return "TIMEOUT";
        }



        // public function check_status($container_id, $access_token)
        // {
        //     $status_url = "https://graph.facebook.com/v19.0/{$container_id}?fields=status_code&access_token={$access_token}";

        //     for ($i = 0; $i < 10; $i++) {
        //         $response = file_get_contents($status_url);
        //         $data = json_decode($response, true);
        
        //         if (isset($data['status_code'])) {
        //             if ($data['status_code'] == "FINISHED" || $data['status_code'] == "READY") {
        //                 return $data['status_code'];
        //             }
        //         }
        
        //         sleep(3); // wait before checking again
        //     }
            

        
        //     return "TIMEOUT";
        // }


        public function publish_reel($creation_id, $access_token)
        {
            $ig_user_id   = $this->ig_user_id;
        
            $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media_publish";
        
            $postData = [
                'creation_id'  => $creation_id,
                'access_token' => $access_token
            ];
        
            return $this->curl_post($url, $postData);
        }


    /*------functions for Auto reply on Instagram start-----*/
        public function insta_auto_reply()
    	{
    	    $this->intigration_cond();
            $output = [];
    		$this->loadView('instavideo/auto_reply_insta', $output);
    	}
	

        public function get_insta_data()
        {
        
            $ig_user_id   = $this->ig_user_id;
            
            $url = 'https://graph.facebook.com/v18.0/'.$ig_user_id.'/media?fields=id&limit=100&access_token='.$this->access_token;
    
            $data = $this->curl_get($url);
            $total_count = isset($data->data) ? count($data->data) : 0;
            echo json_encode([
                "success" => true,
                "all_video_count" => $total_count
            ]);
           
        }
        
         public function get_instavideo_data() {
             
            $ig_user_id   = $this->ig_user_id;
            $after  = $this->input->get('after'); // cursor for next page    
        
            $url = 'https://graph.facebook.com/v18.0/'.$ig_user_id.'/media?fields=id,media_type,media_url,thumbnail_url,permalink,timestamp,caption&limit=9&access_token=' . $this->access_token;
        
            if (!empty($after)) {
                $url .= "&after=" . $after;
            }
        
            $data = $this->curl_get($url);
            
            // pr($data); die('here');
            $next_cursor = isset($data->paging->cursors->after) ? $data->paging->cursors->after : null;
        
            if (!empty($data)) {
                echo json_encode([
                    "success" => true,
                    "all_video" => $data
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "msg" => 'Something went wrong',
                    "next"    => $next_cursor
                ]);
            }
        }



       public function save_insta_reply_automation()
        {
            $triggerkeyword      = strtolower(trim($this->input->post('triggerkeyword'))); 
            $video_id            = $this->input->post('video_id');
            $reply_text          = $this->input->post('reply_text');
            $max_activity        = $this->input->post('max_activity');
            $delay_activity      = $this->input->post('delay_activity');
            $delay_activity_time = $this->input->post('delay_activity_time');
            $stop_setting        = $this->input->post('stop_setting');
            $stop_setting_time   = $this->input->post('stop_setting_time');
            $valcustomreply      = $this->input->post('iscustomreply');
            $iscustomreply       = ($valcustomreply === 'true') ? 1 : 0; 
            $delayInSeconds      = $this->getDelayInSeconds($delay_activity, $delay_activity_time);
            $schedule_time       =  time() + $delayInSeconds;
            
            $setting_data = [
                "business_id"         => $this->business_id,
                "video_id"            => $video_id,
                "triggerkeyword"      => $triggerkeyword,
                "reply_text"          => $reply_text,
                "max_activity"        => $max_activity,
                "delay_activity"      => $delay_activity,
                "delay_activity_time" => $delay_activity_time,
                "stop_setting"        => $stop_setting,
                "stop_setting_time"   => $stop_setting_time,
                'schedule_time'       => $schedule_time,
                'iscustomreply'       => $iscustomreply,
		        'status'   			  => 1,
                "created_at"          => date("Y-m-d H:i:s")
            ];
            
            $already_exit = $this->db->get_where("insta_reply_settings", [
                "video_id"   => $video_id
            ])->row();
                
            if(!empty($already_exit)){
                $this->db->where('video_id', $video_id);
                $this->db->update("insta_reply_settings", $setting_data);
            }else{
                $this->db->insert('insta_reply_settings', $setting_data);
            }

            // Get comments
            $comments = $this->get_comments($video_id);
//             echo "<pre>";
// print_r($comments);
// die;
        
            // if (!$comments || empty($comments->data)) {
            //     echo json_encode(["status" => false, "msg" => "No comments found"]);
            //     return;
            // }
        
            $all_comments = $comments->data;
            $keywords     = array_map('trim', explode(',', $triggerkeyword));
            
//             echo "<pre>";
// echo "TRIGGER KEYWORD = ";
// print_r($triggerkeyword);

// echo "\nKEYWORDS = ";
// print_r($keywords);

// echo "\nCOMMENTS = ";
// print_r($all_comments);
// die;
        
            $matched       = [];
            $processed_ids = []; 
            

        
            foreach ($all_comments as $c) {
        
                $comment_text = strtolower(trim($c->text));
                $comment_id   = $c->id;
        
                /** CHECK ALREADY REPLIED IN DB */
                $reply_already = $this->db->get_where("insta_replied_comments", [
                    "comment_id" => $comment_id,
                    "video_id"   => $video_id
                ])->row();
        
                if (!empty($reply_already)) continue;  
                    echo "<pre>";
// echo "MATCHED COMMENTS";
// print_r($matched);
// echo "</pre>";
// die;
                /** MATCH KEYWORD */
                foreach ($keywords as $keyw) {
        
                    if ($keyw == "") continue;
        
                    if (strpos($comment_text, $keyw) !== false) {
        
                        if (!in_array($comment_id, $processed_ids)) {
                            $matched[] = $c;
                            $processed_ids[] = $comment_id; 
                        }
        
                        break;
                    }
                }
            }
//         echo "<h2>MATCHED COMMENTS</h2>";

// echo "<pre>";
// echo "MATCHED COMMENTS:\n";
// print_r($matched);
// echo "</pre>";

// die;
            // if (empty($matched)) {
            //     echo json_encode(["status" => false, "msg" => "No new matching comment found"]);
            //     return;
            // }
            

            /** SEND REPLY */
            foreach ($matched as $comment) {
            
                $comment_id = $comment->id;
            
                /** CHECK BEFORE REPLY */
                $check_again = $this->db->get_where("insta_replied_comments", [
                    "comment_id" => $comment_id,
                    "video_id"   => $video_id
                ])->row();
                
                if (!empty($check_again)) continue;
            
                $url = "https://graph.facebook.com/v18.0/{$comment_id}/replies";
                
                if($iscustomreply == 1){
                    $reply_text = $reply_text;
                }else{
                    $reply_text = $this->generateOpenAiReply($triggerkeyword);
                }
            
                $payload = [
                    "message"      => $reply_text,
                    "access_token" => $this->access_token
                ];
            
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
            
                $result = json_decode($response, true);
                sleep(10);
    
                if (!empty($result['id'])) {
            
                    $this->db->insert("insta_replied_comments", [
                        "business_id" => $this->business_id,
                        "video_id"    => $video_id,
                        "comment_id"  => $comment_id,
                        "reply_id"    => $result['id'],
                        "reply_text"  => $reply_text,
                        "keyword"     => $triggerkeyword,
                        "created_at"  => date("Y-m-d H:i:s")
                    ]);
                }
            }
    
        
            echo json_encode([
                "success" => true,
                "msg"     => 'Reply successfull',
            ]);
        }
        
        public function get_comments($video_id) 
        {
          
            $url = "https://graph.facebook.com/v18.0/$video_id/comments?access_token=" . $this->access_token;
            $c = curl_init($url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($c);
            curl_close($c);
        
            $response = json_decode($res);
            return $response;
        }


       /*------function for get likes,views,reach, on Instagram -----*/ 
        public function insta_publisher()
    	{
    	    $this->intigration_cond();
            $output = [];
    		$this->loadView('instavideo/ig_all_videos', $output);
    	}


        public function get_insights()
        {
            $ig_user_id   = $this->ig_user_id;
            $after        = $this->input->get('after'); // cursor for next page
        
            $media_url = "https://graph.facebook.com/v21.0/{$ig_user_id}/media?fields=id,media_type,media_url,thumbnail_url,permalink,timestamp,caption&limit=5&access_token={$this->access_token}";
        
            // Add pagination cursor if available
            if (!empty($after)) {
                $media_url .= "&after=" . $after;
            }
            
            
        
            $media_data = $this->curl_get($media_url);
        
            if (empty($media_data->data)) {
                echo json_encode([
                    "success" => false,
                    "message" => "No media found",
                    "next"    => ''
                    ]);
                return;
            }
        
            $final_output = [];
        
            foreach ($media_data->data as $media) {
        
                $media_id = $media->id;
        
                // insights
                $insights_url = "https://graph.facebook.com/v21.0/{$media_id}/insights?metric=reach,likes,views,comments&access_token={$this->access_token}";
                $insights_data = $this->curl_get($insights_url);
        
                $likes = $views = $comments = $reach = 0;
        
                if (!empty($insights_data->data)) {
                    foreach ($insights_data->data as $insight) {
                        if ($insight->name == "likes") $likes = $insight->values[0]->value;
                        if ($insight->name == "views") $views = $insight->values[0]->value;
                        if ($insight->name == "comments") $comments = $insight->values[0]->value;
                        if ($insight->name == "reach") $reach = $insight->values[0]->value;
                    }
                }
        
                $final_output[] = [
                    "id"            => $media->id,
                    "thumbnail"     => $media->thumbnail_url,
                    "media_type"    => $media->media_type,
                    "media_url"     => $media->media_url,
                    "permalink"     => $media->permalink,
                    "timestamp"     => $media->timestamp,
                    "caption"     => $media->caption,
                    "likeCount"     => $likes,
                    "viewCount"     => $views,
                    "commentCount"  => $comments,
                    "reachCount"    => $reach
                ];
            }
        
            // Pagination cursor
            $next_cursor = isset($media_data->paging->cursors->after) ? $media_data->paging->cursors->after : null;
    
        
            echo json_encode([
                "success" => true,
                "data"    => $final_output,
                "next"    => $next_cursor  
            ]);
    }
    
    
        public function get_schedule_video()
        {
            $this->db->from('insta_auto_publish');
            $this->db->where('business_id', $this->business_id);
            $this->db->where('status', 1);
            $schedule_data = $this->db->get()->result_array();
    
            echo json_encode([
                "success" => true,
                "schedule_data"    => $schedule_data,
            ]);
            
        }
    
    

 
        public function generate_hastag()
        {
            $this->intigration_cond();
    		$this->loadView('instavideo/generatehastag');
    	}
    	
        public function ig_hashtag_search()
        {   
 
        $keyword = $this->input->post('keyword');
        $type = $this->input->post('type');
        
        // $access_token = $this->access_token;
        // $ig_user_id   = $this->ig_user_id;

        
        $access_token = config_item('instagram_access_token_2');
        $ig_user_id   = '17841478149216852';

        $url = "https://graph.facebook.com/v19.0/ig_hashtag_search?user_id={$ig_user_id}&q={$keyword}&access_token={$access_token}";
        
        $response = $this->curl_get($url);
    
        if (isset($response->error)) {
            echo json_encode([
                'success' => false,
                'msg'  => 'No data found',
                'response_error'  => $response->error->message
            ]);
            return;
        }
    
        if (empty($response->data)) {
            echo json_encode([
                'success' => false,
                'msg'  => 'No data found'
            ]);
            return;
        }
    
        $media_id = $response->data[0]->id;
        
        if($type == 'top trending'){
            $ig_media_data = $this->get_top_media($media_id, $access_token, $ig_user_id);
        }else{
           $ig_media_data = $this->get_recent_media($media_id, $access_token, $ig_user_id); 
        }
        
        $hastag_media_data = $ig_media_data->data;
        
        if(!empty($hastag_media_data)){
                echo json_encode([
                    'success' => true,
                    'hashtag_id' => $media_id,
                    'hastag_media' => $hastag_media_data,
                    "msg" => 'Data Get Successfully',
                ]);
        }else{
           echo json_encode([
                "success" => false,
                "msg" => 'Something went wrong',
                'hashtag_id' => $media_id,
                'hastag_media' => $hastag_media_data
            ]); 
        }

    }
        
        public function get_top_media($media_id, $access_token, $ig_user_id)
        {

            // $access_token = $this->access_token;
            // $ig_user_id   = $this->ig_user_id;
        
            $url = "https://graph.facebook.com/v19.0/{$media_id}/top_media?user_id={$ig_user_id}&fields=id,caption,like_count,comments_count,media_url,permalink&limit=10&access_token={$access_token}";
        
            $response = $this->curl_get($url);
        
            if (isset($response->error)) {
                return [
                    'success' => false,
                    'msg'  => $response->error->message
                ];
            }
        
            return $response;
        }
        
        public function get_recent_media($media_id, $access_token, $ig_user_id)
        {
            // $access_token = $this->access_token;
            // $ig_user_id   = $this->ig_user_id;
        
            $url = "https://graph.facebook.com/v19.0/{$media_id}/recent_media?user_id={$ig_user_id}&fields=id,caption,like_count,comments_count,media_url,permalink&limit=10&access_token={$access_token}";
        
            $response = $this->curl_get($url);
        
            if (isset($response->error)) {
                return [
                    'success' => false,
                    'msg'  => $response->error->message
                ];
            }
        
            return $response;
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
        
        
         public function curl_get($url) 
        {
            $c = curl_init($url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
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
    	
    	
    	  public function generate_caption()
    	  {
            $prompData = json_decode(file_get_contents('php://input'), true);
            $openAISecretKey = $this->openaikey ;
            $keyword = $prompData['caption'];
            $open_ai = new OpenAi($openAISecretKey);
            
            $prompt = "You are a professional social media manager. Based on the user's input: '{$keyword}', write an engaging and creative Instagram caption.Keep it catchy, audience-focused, and include 5–10 relevant and trending hashtags.";
            $history[] = ["role" => "user", "content" => $prompt];
            
            $opt = [
                "model" => "gpt-3.5-turbo",
                "messages" => $history,
                "temperature" => 0.5,
                "max_tokens" => 100,
                "frequency_penalty" => 0,
                "presence_penalty" => 0
            ];
    
            $complete = $open_ai->chat($opt);
           
            // pr($complete); die;
            $data = json_decode($complete, true);
            
            $content = $data["choices"][0]["message"]["content"];
            echo json_encode([
                'status' => true,
                'data' => $content
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
    	
    	
    	   public function delete_schedule_video()
               {
                $id = $this->input->post('video_id');
                $this->db->where('id', $id);
                $this->db->delete('insta_auto_publish');
                echo json_encode([
                    'success' => true,
                    'msg' => 'Deleted successfully'
                ]);
           }
	
}
