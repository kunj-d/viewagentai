<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Telegram_Cron extends AppDefault
{
    protected $modelslab_video_key;
    protected $dupdub_api_key;
    protected $spechify_key;
    protected $openaikey;

    public function __construct()
    {
        parent::__construct();
        	require_once APPPATH."libraries/youtube/vendor/autoload.php";
        $this->modelslab_video_key = $this->config->item('modelslab_video_key');
        $this->dupdub_api_key      = $this->config->item('dupdub_api_key');
        $this->spechify_key         = $this->config->item('spechify_key');
        $this->openaikey            = $this->config->item('open_ai_key');
        $this->load->model('default/Youtube_integration_model');
        $this->python_api_key ='D684B8EFF387DBD9';
        $this->load->helper('tokengenerate');
        $this->load->model('default/Videocreate_Remotion_Model');
        $this->user_id = '';
        $this->business_id = '';
        
    }

    public function check_telegram_video_process(){
        $this->db->where('video_id !=' ,'');
        $pending_triggers = $this->db->get('telegram_cron_process')->result();
        if(!empty($pending_triggers)) {
            
            foreach ($pending_triggers as $task) {
                  $this->user_id = $task->user_id;
                 $this->business_id = $task->business_id;
                $this->getCompeleteVideobyid($task->user_id,$task->business_id,$task->video_id,$task->auto_post_table_id,$task->type,$task->chat_id,$task->bot_token);
            }
        }
    }

       public function fetch_video($request_id)
            {
                $api_key = $this->modelslab_video_key;
     
                $url = "https://modelslab.com/api/v7/video-fusion/fetch/" . $request_id . "?key=" . $api_key;
     
                $curl = curl_init();
     
                curl_setopt_array($curl, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_CUSTOMREQUEST => 'POST', // ✅ correct method
                ]);
     
                $response = curl_exec($curl);
                
                // ❌ CURL Error
                if (curl_errno($curl)) {
                    $error = curl_error($curl);
                    curl_close($curl);
     
                    return [
                        'status' => false,
                        'error' => $error
                    ];
                }
     
                curl_close($curl);
     
                // ✅ Decode JSON
                $result = json_decode($response, true);
     
                $result_url = $result['output'][0] ?? '';
     
                if (!empty($result_url)) {
                    return $result_url;
                }
                //return false;
                }

        public function fetchDupDubVideoAndSave($video_id)
        {
                $api_key = $this->dupdub_api_key;
            
                $url_api = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/" . $video_id;
            
                $headers = [
                    "dupdub_token: $api_key",
                    "Content-Type: application/json"
                ];
            
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url_api);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
                $response = curl_exec($ch);
            
                if ($response === false) {
                    curl_close($ch);
                    return ['status' => false, 'message' => curl_error($ch)];
                }
            
                $response_data = json_decode($response, true);

                if (!isset($response_data['code']) || $response_data['code'] != 200) {
                    curl_close($ch);
                    return ['status' => false, 'message' => 'Invalid API response'];
                }
            
                $result_url = $response_data['data']['videoUrl'] ?? '';
   
                if (!empty($result_url)) {
                    return $result_url;
                } else {
                  
                }
            }


             public function sendTelegramMessage($bot_token, $chat_id, $text){
       
            $payload = [
                "chat_id" => $chat_id,
                "text" => $text,
            
            ];
        
            $url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
                CURLOPT_POSTFIELDS => json_encode($payload)
            ]);
            $tg_res = curl_exec($ch);
            curl_close($ch);

    }

    //   public function getCompeleteVideobyid($user_id,$business_id,$video_id,$id,$video_type,$chat_id, $bot_token)
    //     {  
         
            
            
    //         $avatar_type = "video";
           
            
           
           
    //         // if(!empty($get_video_id)){
    //             $slug = $this->Videocreate_Remotion_Model->create_video_slug();
    //             $path = 'assets/uploads/videos/';
    //             $upload_folder = './' . $path . $slug;
           
    //             // Create video folder
    //             if (!is_dir($upload_folder)) {
    //                 mkdir($upload_folder, 0755, true);
    //             }
           
    //             if (!empty($video_id) && $avatar_type === 'video') {  
                    
    //                 // $video_url = $this->fetch_video($video_id);
    //                  if ($video_type == 'ai') {

    //                     // ModelsLab Video
    //                     $video_url = $this->fetch_video($video_id);

    //                     if (empty($video_url)) {
                    
    //                         // echo json_encode([
    //                         //     'status' => false,
    //                         //     'processing' => true,
    //                         //     'message' => 'Video still processing'
    //                         // ]);
    //                         $this->sendTelegramMessage($bot_token, $chat_id, 'Avatar still processing' );
    //                         return;
    //                     }
                
    //                 } else {
                
    //                     // DupDub Avatar Video
    //                     $video_url = $this->fetchDupDubVideoAndSave($video_id);
                
    //                     if (empty($video_url)) {
    //                         $this->sendTelegramMessage($bot_token, $chat_id, 'Avatar still processing' );
    //                         // echo json_encode([
    //                         //     'status' => false,
    //                         //     'processing' => true,
    //                         //     'message' => 'Avatar still processing'
    //                         // ]);
    //                         return;
    //                     }
    //                 }
                   
    //                 $imageData = file_get_contents($video_url);
           
    //                 if ($imageData === false) {
    //                     pr("Error downloading video from: " . $video_url);
    //                     echo json_encode(false);
    //                     return;
    //                 }
   
    //                 $filename = 'generated_' . time() . '_' . rand(1000, 9999) . '.mp4';
    //                 $directoryPath = FCPATH . 'assets/uploads/users/' . $user_id;
           
    //                 if (!is_dir($directoryPath)) {
    //                     mkdir($directoryPath, 0777, true);
    //                 }
           
    //                 $filePath = $directoryPath . '/' . $filename;
    //                 if (file_put_contents($filePath, $imageData) === false) {
    //                     pr("Error saving the video to: " . $filePath);
    //                     echo json_encode(false);
    //                     return;
    //                 }
           
    //                 $uploadpath = 'assets/uploads/users/' . $user_id . "/" . $filename;
    //                 // Upload to AWS
    //                 $aws_path = $this->uploadAWS($uploadpath);
           
    //                 $bucketUrl = $this->config->item('bucket_url') . $uploadpath;
    //                 if($bucketUrl) {
    //                     $url = $bucketUrl;
    //                 }
                   
    //             }
    //              if (!empty($url)) {
    //                     // $this->socialmedia_post($id, $keyword, $instagram, $facebook, $youtube, $video_id, $url, $schedule, $scheduletime);
    //                     $this->db->where('business_id', $business_id);
    //                     $this->db->where('id', $id);
    //                     $this->db->update('auto_post', ['video_id' => NULL , 'video_url'=>$url]);
    //                     $this->sendTelegramMessage($bot_token, $chat_id, $url );
    //                 }
           
    //             // If avatar_type is not 'video', proceed with thumbnail generation
    //             $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
    //             $post_data = [
    //                 'api_key' => $this->python_api_key,
    //                 'url'     => $url
    //             ];
           
    //             $video_details = getVideoDetailsPyCurl($post_data, $apiUrl);
                  
    //             if (empty($video_details) || empty($video_details->thumbnail)) {
    //                 echo json_encode(false);
    //                 return;
    //             }
           
    //             $thumbnail_extension = getFileExtension($video_details->thumbnail);
    //             $image_filename = $slug . '.' . $thumbnail_extension;
    //             $upload_path_image = $path . $slug . '/' . $image_filename;
           
    //             // Download thumbnail
    //             downloadImageUrl($upload_folder, $upload_path_image, $video_details->thumbnail);
           
    //             // Remove folder if empty
    //             if (is_dir($upload_folder) && count(scandir($upload_folder)) <= 2) {
    //                 rmdir($upload_folder);
    //             }
    //              $this->db->where('auto_post_table_id',$id);
    //             $this->db->delete('telegram_cron_process');
             
    //             $video_info = [
    //                 'user_id'      => $user_id,
    //                 'business_id'  => $business_id,
    //                 'project_id'   => 1,
    //                 'slug'         => $slug,
    //                 'file_type'    => 'V',
    //                 'url'          => $url,
    //                 'avatar_id'    => '',
    //                 'title'        => '',
    //                 'width'        => $video_details->width ?? 0,
    //                 'height'       => $video_details->height ?? 0,
    //                 'duration'     => $video_details->duration ?? 0,
    //                 'video_status' => 'heygen',
    //                 'thumbnail'    => $this->config->item('cdn_url') . $upload_path_image
    //             ];
    //             $this->db->insert('library',$video_info);
    //             $insert_id = $this->db->insert_id();
               
    //         // }  
    //         $response = [
    //                 'status' => true,
    //                 'url'   => $url
    //             ];
    //           //  $this->sendTelegramMessage($bot_token, $chat_id, $url );
    //             //echo json_encode($response);
    //         }
    
    
    public function getCompeleteVideobyid($user_id,$business_id,$video_id,$id,$video_type,$chat_id, $bot_token)

        {  


            $avatar_type = "video";



            // if(!empty($get_video_id)){

                $slug = $this->Videocreate_Remotion_Model->create_video_slug();

                $path = 'assets/uploads/videos/';

                $upload_folder = './' . $path . $slug;

                // Create video folder

                if (!is_dir($upload_folder)) {

                    mkdir($upload_folder, 0755, true);

                }

                if (!empty($video_id) && $avatar_type === 'video') {  

                    // $video_url = $this->fetch_video($video_id);

                     if ($video_type == 'ai') {
 
                        // ModelsLab Video

                        $video_url = $this->fetch_video($video_id);
                    
                        if (empty($video_url)) {

                            // echo json_encode([

                            //     'status' => false,

                            //     'processing' => true,

                            //     'message' => 'Video still processing'

                            // ]);

                            $this->sendTelegramMessage($bot_token, $chat_id, 'Avatar still processing' );

                            return;

                        }

                    } else {

                        // DupDub Avatar Video

                        $video_url = $this->fetchDupDubVideoAndSave($video_id);

                        if (empty($video_url)) {

                            $this->sendTelegramMessage($bot_token, $chat_id, 'Avatar still processing' );

                            // echo json_encode([

                            //     'status' => false,

                            //     'processing' => true,

                            //     'message' => 'Avatar still processing'

                            // ]);

                            return;

                        }

                    }

                    $imageData = file_get_contents($video_url);

                    if ($imageData === false) {

                        pr("Error downloading video from: " . $video_url);

                        echo json_encode(false);

                        return;

                    }

                    $filename = 'generated_' . time() . '_' . rand(1000, 9999) . '.mp4';

                    $directoryPath = FCPATH . 'assets/uploads/users/' . $user_id;

                    if (!is_dir($directoryPath)) {

                        mkdir($directoryPath, 0777, true);

                    }

                    $filePath = $directoryPath . '/' . $filename;

                    if (file_put_contents($filePath, $imageData) === false) {

                        pr("Error saving the video to: " . $filePath);

                        echo json_encode(false);

                        return;

                    }

                    $uploadpath = 'assets/uploads/users/' . $user_id . "/" . $filename;

                    // Upload to AWS

                    $aws_path = $this->uploadAWS($uploadpath);

                    $bucketUrl = $this->config->item('bucket_url') . $uploadpath;

                    if($bucketUrl) {

                        $url = $bucketUrl;

                    }

                }

                 if (!empty($url)) {

                      $this->db->where('id', $id);

                        $auto_post_row = $this->db->get('auto_post')->row();
                    
                        if (!empty($auto_post_row)) {

                            $keyword      = $auto_post_row->keyword;

                            $instagram    = $auto_post_row->instagram;

                            $facebook     = $auto_post_row->facebook;

                            $youtube      = $auto_post_row->youtube;

                            $schedule     = $auto_post_row->schedule;

                            $scheduletime = $auto_post_row->schedule_time;

                        } 

                        $this->socialmedia_post($id, $keyword, $instagram, $facebook, $youtube, $video_id, $url, $schedule, $scheduletime);

                        $this->db->where('business_id', $business_id);

                        $this->db->where('id', $id);

                        $this->db->update('auto_post', ['video_id' => NULL , 'video_url'=>$url]);

                        $this->sendTelegramMessage($bot_token, $chat_id, $url );

                    }

                // If avatar_type is not 'video', proceed with thumbnail generation

                $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';

                $post_data = [

                    'api_key' => $this->python_api_key,

                    'url'     => $url

                ];

                $video_details = getVideoDetailsPyCurl($post_data, $apiUrl);

                if (empty($video_details) || empty($video_details->thumbnail)) {

                    echo json_encode(false);

                    return;

                }

                $thumbnail_extension = getFileExtension($video_details->thumbnail);

                $image_filename = $slug . '.' . $thumbnail_extension;

                $upload_path_image = $path . $slug . '/' . $image_filename;

                // Download thumbnail

                downloadImageUrl($upload_folder, $upload_path_image, $video_details->thumbnail);

                // Remove folder if empty

                if (is_dir($upload_folder) && count(scandir($upload_folder)) <= 2) {

                    rmdir($upload_folder);

                }

                 $this->db->where('auto_post_table_id',$id);

                $this->db->delete('telegram_cron_process');

                $video_info = [

                    'user_id'      => $user_id,

                    'business_id'  => $business_id,

                    'project_id'   => 1,

                    'slug'         => $slug,

                    'file_type'    => 'V',

                    'url'          => $url,

                    'avatar_id'    => '',

                    'title'        => '',

                    'width'        => $video_details->width ?? 0,

                    'height'       => $video_details->height ?? 0,

                    'duration'     => $video_details->duration ?? 0,

                    'video_status' => 'heygen',

                    'thumbnail'    => $this->config->item('cdn_url') . $upload_path_image

                ];

                $this->db->insert('library',$video_info);

                $insert_id = $this->db->insert_id();

            // }  

            $response = [

                    'status' => true,

                    'url'   => $url

                ];

              //  $this->sendTelegramMessage($bot_token, $chat_id, $url );

                //echo json_encode($response);

            }
 
            
            
             public function socialmedia_post($id, $keyword, $instagram, $facebook, $youtube, $video_id, $url, $schedule, $scheduletime)
            {   
                
    
                $prompt = "You are a professional social media manager. Based on the user's input: '{$keyword}', write an engaging and creative Instagram caption.Keep it catchy, audience-focused, and include 5–10 relevant and trending hashtags.";
                $caption = $this->generateOpenAidata($prompt);
                $video_caption = preg_replace('/[^\x00-\x7F]/', '', $caption);
            
                $final_response = [];
            
                /** Instagram */
                    if ($instagram == '1' || $instagram == 1) {
                        $insta = $this->get_access_token('instagram_access_token');
                
                        if(!empty($insta)){
                            $insta_access_token = $insta->access_token;
                            $page_id = $insta->ig_user_id;
                
                            $insta_res = $this->upload_reel($keyword, $insta_access_token, $page_id, $schedule, $url, $scheduletime, $video_caption);
                            $final_response['instagram'] = $insta_res;
                        } else {
                            $final_response['instagram'] = [
                                "success" => false,
                                "msg" => "Instagram token not found"
                            ];
                        }
                    }
            
                /** Facebook */
                if ($facebook == '1' || $facebook == 1) {
                    $fb = $this->get_access_token('facebook_access_token');
                    if(!empty($fb)){
                        $fb_access_token = $fb->access_token;
                        $page_id = $fb->page_id;
                        $fb_res = $this->fb_post_video($keyword, $fb_access_token, $page_id, $schedule, $url, $scheduletime, $video_caption);
                        $final_response['facebook'] = $fb_res;
                    } else {
                        $final_response['facebook'] = [
                            "success" => false,
                            "msg" => "Facebook token not found"
                        ];
                    }
                }
            
                /** YouTube */
                if ($youtube == '1' || $youtube == 1) {
                    $youtube_res = $this->insertYoutubePublisher($keyword, $url, $caption, $schedule, $scheduletime);
                    $final_response['youtube'] = $youtube_res;
                    
                    // $final_response['youtube'] = [
                    //     "success" => false,
                    //     "msg" => "YouTube not implemented yet"
                    // ];
                }
                echo json_encode($final_response);
            }
            
        public function get_access_token($table_name)
        {
            
            $this->db->where('user_id', $this->user_id);
            $this->db->where('business_id',$this->business_id);
            $query = $this->db->get($table_name);
        
            return $query->row();
        }
        
         public function upload_reel($keyword, $insta_access_token, $page_id, $schedule, $url, $scheduletime, $video_caption)
            {
                $caption = $video_caption;
                $video_url = $url;
                $post_type = 'REELS';
                $schedule_time = $scheduletime;
            
                $access_token = $insta_access_token;
                $ig_user_id   = $page_id;
                /** SCHEDULE */
                if($schedule == '1' || $schedule == 1){
            
                    $data = [
                        "user_id"     => $this->user_id,
                        "business_id" => $this->business_id,
                        "video_url"   => $video_url,
                        "post_type"   => $post_type,
                        "caption"     => $caption,
                        'schedule_time' => $schedule_time,
                        'status'      => 1,
                        "created_at"  => date("Y-m-d H:i:s")
                    ];
            
                    $this->db->insert('insta_auto_publish', $data);
                    $insert_id = $this->db->insert_id();
            
                    return [
                        "success" => !empty($insert_id),
                        "msg" => !empty($insert_id) ? 'video schedule successfull' : 'Something went wrong',
                        "publish_id" => $insert_id
                    ];
                }
            
                /** CREATE CONTAINER */
                $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media";
            
                $postData = [
                    'video_url'     => $video_url,
                    'caption'       => $caption,
                    'media_type'    => $post_type,
                    'access_token'  => $access_token
                ];
            
                $response = $this->curl_post($url, $postData);
                $data = json_decode($response, true);
            
                // ✅ safe access
                $container_id = $data['id'] ?? '';
                
    
                if (empty($container_id)) {
                    return [
                        "success" => false,
                        "msg" => 'Container creation failed',
                        "error" => $data
                    ];
                }
            
                /** CHECK STATUS */
                $status = $this->check_status($container_id, $access_token);
            
                if ($status !== "FINISHED" && $status !== "READY") {
                    return [
                        "success" => false,
                        "msg" => "Processing failed",
                        "error" => $status
                    ];
                }
            
                /** PUBLISH */
                $publish = $this->publish_reel($ig_user_id, $container_id, $access_token);
                $publish_data = json_decode($publish, true);
                
                if(isset($publish_data['id'])){
                    $this->db->insert('social_post_count', [
                        'user_id'     => $this->user_id,
                        'business_id' => $this->business_id,
                        'type'        => 'instagram',
                        'publish_id'  => $publish_data['id']
                    ]);
            
                    return [
                        "success" => true,
                        "msg" => "Reel uploaded successfully",
                        "publish_id" => $publish_data['id']
                    ];
                }
            
                return [
                    "success" => false,
                    "msg" => "Publish failed",
                    "error" => $publish_data
                ];
            }
            
            
        public function publish_reel($ig_user_id, $container_id, $access_token)
        {

            $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media_publish";
        
            $postData = [
                'creation_id'  => $container_id,
                'access_token' => $access_token
            ];
        
            return $this->curl_post($url, $postData);
        }
            
            
            public function fb_post_video($keyword, $fb_access_token, $page_id, $schedule, $url, $scheduletime, $video_caption)
        {
            $video_url     = $url;
            $caption       = $video_caption;
            $post_type     = 'video';
            $schedule_type = $schedule;
            $unix_timestamp = $scheduletime;
        
            if($schedule_type == '1' || $schedule_type == 1){
        
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
        
                return [
                    "success"=>!empty($insert_id),
                    "msg"=>!empty($insert_id) ? "Video scheduled successfully" : "Something went wrong",
                    "publish_id"=>$insert_id
                ];
            }
        
            // Upload
            $url = "https://graph.facebook.com/v19.0/{$page_id}/videos";
        
            $postData = [
                "file_url"     => $video_url,
                "description"  => $caption,
                "access_token" => $fb_access_token
            ];
        
            $response = $this->curl_post($url,$postData);
            $result = json_decode($response,true);
        
            if(isset($result['id'])){
        
                $this->db->insert('social_post_count', [
                    'user_id'     => $this->user_id,
                    'business_id' => $this->business_id,
                    'type'        => 'facebook',
                    'publish_id'  => $result['id']
                ]);
        
                return [
                    "success"=>true,
                    "msg"=>"Video upload successfull",
                    "video_id"=>$result['id']
                ];
            }
        
            return [
                "success"=>false,
                "msg"=>"Video upload failed",
                "error"=>$result
            ];
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
        public function insertYoutubePublisher($keyword, $url, $caption, $schedule, $scheduletime)
            {
                $video_url = $url;
                $status = 1;
                $update_id = null;
            
                $data = array(
                    'user_id'            => $this->user_id,
                    'business_id'        => $this->business_id,
                    'title'              => $keyword,
                    'description'        => $caption,
                    'tags'               => $keyword,
                    'thumbnail'          => '',
                    'video_url'          => $video_url,
                    'video_id'           => NULL,
                    'schedule_date_time' => $schedule == 1 ? date('Y-m-d H:i:s', $scheduletime) : '',
                    'publish_type'       => $schedule == 1 ? 'false' : 'true',
                    'video_cat'          => 22,
                    'allow_embeding'     => 'true',
                    'age_restriction'    => 'false',
                    'copyright_content'  => 'false',
                    'visiblity'          => 'public',
                    'status'             => $status
                );
            
                /** 🔥 THUMBNAIL FROM VIDEO */
                if (!empty($video_url)) {
            
                    $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
                    $post_data = [
                        'api_key' => $this->python_api_key,
                        'url'     => $video_url
                    ];
            
                    $video_details = getVideoDetailsPyCurl($post_data, $apiUrl);
            
                    if (!empty($video_details) && !empty($video_details->thumbnail)) {
                        $data['thumbnail'] = $video_details->thumbnail;
                    } else {
                        // fallback thumbnail
                        $data['thumbnail'] = 'https://www.socipilotai.com/app/assets/images/card-img.png';
                    }
                }
            
                /** UPLOAD */
                if($update_id){
                    $videoResult = $this->updateVideoData($data, $update_id);
                } else {
                    $videoResult = $this->uploadData($data);
                }
            
                /** RESULT CHECK */
                if (!empty($videoResult['status']) && $videoResult['status'] == true) {
            
                    $data['publish_type']      = $data['publish_type'] == 'true' ? 1 : 0;
                    $data['allow_embeding']    = 1;
                    $data['age_restriction']   = 0;
                    $data['copyright_content'] = 0;
            
                    $data['video_id'] = $videoResult['video_id'];
            
                    // save DB
                    $this->Youtube_integration_model->save_youtube_publisher($data, $update_id);
            
                    return [
                        "success" => true,
                        "msg" => "Video uploaded to YouTube",
                        "video_id" => $videoResult['video_id'],
                        "video_url" => $videoResult['video_url']
                    ];
                }
            
                return [
                    "success" => false,
                    "msg" => $videoResult['msg'] ?? "Upload failed",
                    "error" => $videoResult
                ];
            }
            
            
              public function updateVideoData($video_arr, $update_id)
    	    {
    		$output = [];
    		
    		/* if (!$this->session->userdata('yt_access_token')) {
    			$output['error'] = 'Please Integrate YouTube';
    			echo json_encode($output);
    			die;
    		} */
    		$this->check_yt_access_token();
    
    		$client = $this->getClient();
    		$youtube = new Google_Service_YouTube($client);
    
    		try {
    			// Build snippet
    			$snippet = new Google_Service_YouTube_VideoSnippet();
    			$snippet->setTitle(strip_tags($video_arr['title']));
    			$snippet->setDescription(strip_tags($video_arr['description']));
    			$snippet->setTags(is_string($video_arr['tags']) ? explode(",", $video_arr['tags']) : []);
    			$snippet->setCategoryId($video_arr['video_cat']); // YouTube category ID
    
    			// Build status
    			$status = new Google_Service_YouTube_VideoStatus();
    			$status->setEmbeddable($video_arr['allow_embeding'] === 'true');
    			// Always declare that this video is not made for kids (COPPA compliance)
    			$madeForkids =  $video_arr['age_restriction'] == "false" ? false : true;
    			$status->setMadeForKids($madeForkids);
    			$status->setSelfDeclaredMadeForKids($madeForkids);
    			
    
    			// Your internal age restriction logic (for logging or notification)
    			$ageRestricted = !empty($video_arr['age_restriction']);
    			if ($ageRestricted) {
    				// This means: "Yes, restrict my video to viewers over 18"
    				// But since API doesn't support 18+ directly, you may want to notify or log this case
    			}
    
    			if (!empty($video_arr['publish_type']) && $video_arr['publish_type'] !== 'false') {
    				$status->setPrivacyStatus($video_arr['visiblity']); // public, private, unlisted
    			}
    
    			// Set video ID to update
    			$video = new Google_Service_YouTube_Video();
    			$video->setId($update_id);
    			$video->setSnippet($snippet);
    			$video->setStatus($status);
    
    			// Update video metadata
    			$youtube->videos->update("snippet,status", $video);
    
    			// Upload thumbnail if provided
    			if (!empty($video_arr['thumbnail'])) {
    				$thumbnailPath = './assets/uploads/temp_youtube_thumb/temp_thumb_' . time() . '.jpg';
    				if (file_put_contents($thumbnailPath, file_get_contents($video_arr['thumbnail']))) {
    					$youtube->thumbnails->set(
    						$update_id,
    						[
    							'data' => file_get_contents($thumbnailPath),
    							'mimeType' => 'image/jpeg',
    							'uploadType' => 'media'
    						]
    					);
    					/* @unlink($thumbnailPath); */
    				}
    			}
    
    			$output = [
    				'status' => true,
    				'video_url' => 'https://youtu.be/' . $update_id,
    				'video_id' => $update_id,
    				'thumbnail_path' => str_replace('./','',$thumbnailPath),
    				'msg' => 'Video updated successfully!'
    			];
    		} catch (Google_Service_Exception $e) {
    			$output = [
    				'status' => false,
    				'video_url' => '',
    				'video_id' => $update_id,
    				'thumbnail_path' => '',
    				'msg' => 'Youtube Account has Some issue.'
    			];
    		} catch (Google_Exception $e) {
    			$output = [
    				'status' => false,
    				'video_url' => '',
    				'video_id' => $update_id,
    				'thumbnail_path' => '',
    				'msg' => 'Client Error: ' . $e->getMessage()
    			];
    		}
    // 		pr($e->getMessage()); die;
    		return $output;
    		
    	}
            
            
             public function uploadData($video_arr)
	    {
        
            ignore_user_abort(true);
            set_time_limit(0);
            ini_set('memory_limit', '-1');
        
            $output = [];
        
            $this->check_yt_access_token();
        
            $video_title = strip_tags($video_arr['title']);
            $video_desc = strip_tags($video_arr['description']);
            $video_tags = is_string($video_arr['tags']) ? explode(",", $video_arr['tags']) : [];
        
            // Generate paths
            $video_id = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 11);
            $videoPath = './assets/uploads/videos/' . $video_id . ".mp4";
            $thumbnailPath = './assets/uploads/temp_youtube_thumb/temp_thumb_' . time() . '.jpg';
        
            $context = stream_context_create(['http' => ['timeout' => 15]]);
        
            // Download thumbnail
            $thumbnailData = @file_get_contents($video_arr['thumbnail'], false, $context);
            if (!$thumbnailData) {
                $output['status'] = false;
                $output['msg'] = 'Failed to download thumbnail image (timeout or unreachable).';
                echo json_encode($output);
                die;
            }
            file_put_contents($thumbnailPath, $thumbnailData);
        
            // Download video
            $videoData = @file_get_contents($video_arr['video_url'], false, $context);
            if (!$videoData) {
                $output['status'] = false;
                $output['msg'] = 'Failed to download video (timeout or unreachable).';
                echo json_encode($output);
                die;
            }
            file_put_contents($videoPath, $videoData);
        
            $client = $this->getClient();
            $youtube = new Google_Service_YouTube($client);
        
            try {
                // Build snippet
                $snippet = new Google_Service_YouTube_VideoSnippet();
                $snippet->setTitle($video_title);
                $snippet->setDescription($video_desc);
                $snippet->setTags($video_tags);
                $snippet->setCategoryId($video_arr['video_cat']);
        
                // Build status
                $status = new Google_Service_YouTube_VideoStatus();
                $status->setEmbeddable($video_arr['allow_embeding'] === 'true');
                if($video_arr['publish_type'] != 'false'){
                    $status->setPrivacyStatus($video_arr['visiblity']);
                } else if (!empty($video_arr['schedule_date_time'])) {
                    $status->setPublishAt(date('c', strtotime($video_arr['schedule_date_time'])));
                    $status->setPrivacyStatus('private');
                }
                $status->setMadeForKids($video_arr['age_restriction'] ? false : true);
        
                $video = new Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);
        
                $chunkSizeBytes = 1 * 1024 * 1024;
                $client->setDefer(true);
                $insertRequest = $youtube->videos->insert("status,snippet", $video);
        
                $media = new Google_Http_MediaFileUpload(
                    $client,
                    $insertRequest,
                    'video/mp4',
                    null,
                    true,
                    $chunkSizeBytes
                );
                $media->setFileSize(filesize($videoPath));
        
                $status = false;
                $handle = fopen($videoPath, "rb");
                while (!$status && !feof($handle)) {
                    $chunk = fread($handle, $chunkSizeBytes);
                    $status = $media->nextChunk($chunk);
                }
                fclose($handle);
                $client->setDefer(false);
        
                if (!empty($status['id'])) {
                    $youtube_video_id = $status['id'];
        
                    // Try thumbnail upload separately
                    try {
                        if (file_exists($thumbnailPath)) {
                            $youtube->thumbnails->set(
                                $youtube_video_id,
                                [
                                    'data' => file_get_contents($thumbnailPath),
                                    'mimeType' => 'image/jpeg',
                                    'uploadType' => 'media'
                                ]
                            );
                        }
                    } catch (Google_Service_Exception $e) {
                        // Thumbnail failed, but video already uploaded
                        $output['thumbnail_warning'] = 'Thumbnail upload failed: ' . $e->getMessage();
                    }
        
                    @unlink($videoPath);
        
                    $output = [
                        'status' => true,
                        'video_url' => 'https://youtu.be/' . $youtube_video_id,
                        'video_id' => $youtube_video_id,
                        'thumbnail_path' => str_replace('./','',$thumbnailPath),
                        'msg' => 'Video has been uploaded to YouTube successfully!'
                    ];
                }
            } catch (Google_Service_Exception $e) {
                $errorresponse = $e->getMessage();
                $output['status'] = false;
                $output['video_url'] = '';
                $output['video_id'] = '';
                $output['thumbnail_path'] = str_replace('./','',$thumbnailPath);
                $output['msg'] = "YouTube API error: " . $errorresponse;
                @unlink($videoPath);
            } catch (Google_Exception $e) {
                $output['status'] = false;
                $output['video_url'] = '';
                $output['video_id'] = '';
                $output['thumbnail_path'] = str_replace('./','',$thumbnailPath);
                $output['msg'] = 'Client error occurred: ' . $e->getMessage();
                @unlink($videoPath);
            }
        
        // pr($output); die('asdsa');
            return $output;
        }
        
          public function getClient() {
        		$this->check_yt_access_token();
        		$redirectUrl =  base_url('save-youtube-integration');
        		$yt_access_token = $this->get_new_access_token();
        		$client_data=  $this->get_client_data();
        		//echo"<pre>"; print_r($yt_access_token); die;
        
        		$clientId= $client_data->clientId;
        		$clientSecret= $client_data->clientSecret;
        		$access_token= $client_data->access_token;
        		$client = new Google_Client();
        
        		$client->setClientId($clientId);
        		$client->setClientSecret($clientSecret);
        		$client->setAccessType('offline');
        		$this->set_yt_scopes($client);
        		$client->setRedirectUri('\''.$redirectUrl.'\'');
        
        		$client->setAccessToken(json_encode($client_data));
        
        		return $client;
        	}

        
         public function get_client_data()
        {
    		$this->db->select('*'); // or specific columns
            $this->db->from('youtube_access_token');
            $this->db->where('user_id',$this->user_id);
            $this->db->where('business_id',$this->business_id);
            $query = $this->db->get();
            $result = $query->result();
    
            $tokenData =  json_decode($result[0]->access_token);
    
    		if (!empty($tokenData)) {
    			// $access_token_from_refresh_token =  $result['access_token'];
    			return $tokenData;
    		} else {
    			echo "Error while getting access token: ";
    			// print_r($result);
    			return false;
    		}
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
    			$this->db->where('user_id',$this->user_id);
    			$query = $this->db->get('youtube_access_token');
    			
    			if($query->num_rows()>0){
    				$yt_access_token = $query->row_array()['access_token'];
    				$yt_access_token = json_decode($yt_access_token);
    				$this->session->set_userdata('yt_access_token',$yt_access_token);
    				$this->refresh_yt_access_token($yt_access_token);
    				//die('ddd');
    				//redirect(base_url('youtube_list'));
    			} else {
    				$this->session->set_flashdata('flash_error', "Please Integrate youtube");
    				$this->session->set_flashdata('active_tab', 'youtube');
    				//redirect(base_url('integration'));
    			}
    		}
    	}
    	
    	
    	 public function refresh_yt_access_token($ses_yt_access_token) 
	    {
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
    
    		//$yt_access_token = json_decode($accessToken);
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
    		//echo"<pre>"; print_r($_SESSION['yt_access_token']); die('999');
    		$this->Youtube_integration_model->update_yt_access_token($this->user_id,$this->business_id,$yt_data);
    	}
    	
    	public function get_new_access_token()
    	{
            $this->db->select('*'); // or specific columns
            $this->db->from('youtube_access_token');
            $this->db->where('user_id',$this->user_id);
            $this->db->where('business_id',$this->business_id);
            $query = $this->db->get();
            $result = $query->result();
    
            $tokenData =  json_decode($result[0]->access_token,true);
    
            $client_id = $tokenData['clientId'];  // apna client id
            $client_secret = $tokenData['clientSecret'];  // apna client secret
            $refresh_token = $tokenData['refresh_token'];  // jo aapke paas hai
    
    
            // Prepare POST data
            $post_fields = [
                'client_id'     => $client_id,
                'client_secret' => $client_secret,
                'refresh_token' => $refresh_token,
                'grant_type'    => 'refresh_token',
            ];
    
            // Initialize cURL
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
        
         public function set_yt_scopes($gClient) 
	    {
    		$gClient->setScopes(array('https://www.googleapis.com/auth/youtube.force-ssl',
    		'https://www.googleapis.com/auth/youtubepartner-channel-audit',
    		'https://www.googleapis.com/auth/youtube',
    		'https://www.googleapis.com/auth/youtube.readonly',
    		'https://www.googleapis.com/auth/yt-analytics.readonly',
    		'https://www.googleapis.com/auth/yt-analytics-monetary.readonly',
    		'https://www.googleapis.com/auth/youtube.upload',
    		'https://www.googleapis.com/auth/youtubepartner'));
    	}

    public function check_pending_telegram_videos()
    {
        // ============================================================
        // STEP 1: PENDING API TRIGGERS KO REAL API ID MEIN CONVERT KARO
        // ============================================================
        // $this->db->group_start();
        // $this->db->where('status', 'pending_api_trigger');
        // $this->db->or_where('status', '');
        // $this->db->or_where('status', NULL);
        // $this->db->group_end();
        $this->db->where('video_id !=' ,'');
        $pending_triggers = $this->db->get('telegram_cron_process')->result();
        
        foreach ($pending_triggers as $task) {
            
            // Safe Parsing JSON Configuration
            $meta = json_decode($task->video_id, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($meta)) {
                $original_prompt = $meta['prompt'] ?? 'Create a viral short video';
                $term            = $meta['term'] ?? 'Marketing';
            } else {
                $original_prompt = !empty($task->video_id) ? $task->video_id : 'Create a viral short video';
                $term            = "Marketing";
            }
            
            $generated_api_id = '';

            if ($task->video_type === 'ai') {
                // ModelsLab Text-to-Video API Ingestion
                $refine = "Convert this concept: \"" . $original_prompt . "\" into a highly descriptive scene prompt for an AI Text-to-Video engine. Max 250 characters. Return ONLY prompt:";
                $optimized_prompt = $this->generateOpenAidata($refine);
                if (empty($optimized_prompt)) $optimized_prompt = $original_prompt;

                $result = $this->generate_video_id($optimized_prompt);
                $generated_api_id = $result['id'] ?? $result['future_links_id'] ?? '';
            } else {
                // Talking Avatar Flow Pipeline
                $script_prompt = "Write a clear conversational narration about " . $term . ". Dynamic paragraph, absolute limit 400 characters max. Plain text only:";
                $voice_script = $this->generateOpenAidata($script_prompt);
                
                $audiovoice = $this->generateSpeechifyAudio($voice_script, 'henry', $task->agent_id);
                
                if (!empty($audiovoice)) {
                    $cdn_url = 'https://cdn.socialclawai.com/';
                    $imagePath = $cdn_url . 'assets/uploads/avatar/talking_photo/newavatar1.png';

                    // Detect Face Coordinates via DupDub
                    $ch1 = curl_init("https://moyin-gateway.dupdub.com/tts/v1/photoProject/detectAvatar");
                    curl_setopt_array($ch1, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => json_encode(["photoUrl" => $imagePath]),
                        CURLOPT_HTTPHEADER     => ["dupdub_token: " . $this->dupdub_api_key, "Content-Type: application/json"]
                    ]);
                    $resBox = curl_exec($ch1); curl_close($ch1);
                    $boxJson = json_decode($resBox, true);

                    if (isset($boxJson['code']) && $boxJson['code'] == 200 && !empty($boxJson['data']['boxes'])) {
                        $boxes = $boxJson['data']['boxes'][0];
                        $boxessize = [$boxes[0], $boxes[1], $boxes[2], $boxes[3]];

                        // Create Multi Avatar Video Project Task
                        $data_payload = [
                            "photoUrl"  => $imagePath,
                            "info"      => [["audioUrl" => $audiovoice, "box" => $boxessize]],
                            "watermark" => 0,
                            "useSr"     => false
                        ];

                        $ch2 = curl_init("https://moyin-gateway.dupdub.com/tts/v1/photoProject/createMulti");
                        curl_setopt_array($ch2, [
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST           => true,
                            CURLOPT_POSTFIELDS     => json_encode($data_payload),
                            CURLOPT_HTTPHEADER     => ["dupdub_token: " . $this->dupdub_api_key, "Content-Type: application/json"]
                        ]);
                        $resProj = curl_exec($ch2); curl_close($ch2);
                        $projJson = json_decode($resProj, true);
                        $generated_api_id = $projJson['data']['id'] ?? '';
                    }
                }
            }

            // Target hash identity successfully fetched
            if (!empty($generated_api_id)) {
                // Main board alignment sync insertion
                $auto_post_data = [
                    "user_id"       => $task->agent_id, 
                    "business_id"   => $task->business_id,
                    "keyword"       => $term,
                    "video_id"      => $generated_api_id,
                    "video_type"    => $task->video_type,
                    "instagram"     => 0,
                    "facebook"      => 0,
                    "youtube"       => 0,
                    "schedule"      => 0,
                    "schedule_time" => time()
                ];
                $this->db->insert('auto_post', $auto_post_data);

                // Transition row data state to processing status
                $this->db->where('id', $task->id)->update('telegram_video_queue', [
                    'video_id'   => $generated_api_id, 
                    'status'     => 'processing',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->db->where('id', $task->id)->update('telegram_video_queue', [
                    'status'     => 'failed',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // ============================================================
        // STEP 2: POLLING LOGIC - POLLING ONGOING PIPELINES
        // ============================================================
        $queue = $this->db->where('status', 'processing')->get('telegram_video_queue')->result();

        foreach ($queue as $item) {
            $final_video_url = '';

            if ($item->video_type === 'ai') {
                $url = "https://modelslab.com/api/v7/video-fusion/fetch/" . $item->video_id . "?key=" . $this->modelslab_video_key;
                $ch = curl_init();
                curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_CUSTOMREQUEST => 'POST']);
                $res = curl_exec($ch); curl_close($ch);
                $result = json_decode($res, true);
                
                if (isset($result['status']) && $result['status'] === 'success' && !empty($result['output'][0])) {
                    $final_video_url = $result['output'][0];
                } elseif (isset($result['status']) && $result['status'] === 'failed') {
                    $this->db->where('id', $item->id)->update('telegram_video_queue', ['status' => 'failed', 'updated_at' => date('Y-m-d H:i:s')]);
                    continue;
                }
            } else {
                $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/" . $item->video_id;
                $ch = curl_init();
                curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => ["dupdub_token: " . $this->dupdub_api_key]]);
                $res = curl_exec($ch); curl_close($ch);
                $result = json_decode($res, true);
                
                if (isset($result['code']) && $result['code'] == 200) {
                    $project_status = $result['data']['status'] ?? 0;
                    if ($project_status == 2 && !empty($result['data']['videoUrl'])) {
                        $final_video_url = $result['data']['videoUrl'];
                    } elseif ($project_status == 3) {
                        $this->db->where('id', $item->id)->update('telegram_video_queue', ['status' => 'failed', 'updated_at' => date('Y-m-d H:i:s')]);
                        continue;
                    }
                }
            }

            // Deliver finalized link asset straight into target user channel window
            if (!empty($final_video_url)) {
                
                $telegram_send_url = "https://api.telegram.org/bot{$item->bot_token}/sendVideo";
                $postFields = [
                    'chat_id' => $item->chat_id,
                    'video'   => $final_video_url,
                    'caption' => "🎉 Your dynamic custom video is ready! Generated successfully by Tube Claw AI Engine. 🚀"
                ];

                $ch = curl_init();
                curl_setopt_array($ch, [CURLOPT_URL => $telegram_send_url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $postFields]);
                $tg_res = curl_exec($ch); curl_close($ch);
                $tg_status = json_decode($tg_res, true);

                if (isset($tg_status['ok']) && $tg_status['ok'] == true) {
                    $this->db->where('id', $item->id)->update('telegram_video_queue', [
                        'status'     => 'completed',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    $this->db->where('video_id', $item->video_id)->update('auto_post', [
                        'video_id'  => NULL,
                        'video_url' => $final_video_url
                    ]);

                    $this->db->insert('telegram_messages', [
                        'agent_id'     => $item->agent_id,
                        'business_id'  => $item->business_id,
                        'chat_id'      => $item->chat_id,
                        'bot_token'    => $item->bot_token,
                        'message'      => "[AI Media Payload Dispatched: " . $final_video_url . "]",
                        'message_type' => 'bot_reply',
                        'raw_data'     => $tg_res,
                        'created_at'   => date('Y-m-d H:i:s')
                    ]);

                    $slug = $this->Videocreate_Remotion_Model->create_video_slug();
                    $this->db->insert('library', [
                        'user_id'      => $item->agent_id, 
                        'business_id'  => $item->business_id,
                        'project_id'   => 1,
                        'slug'         => $slug,
                        'file_type'    => 'V',
                        'url'          => $final_video_url,
                        'avatar_id'    => '',
                        'title'        => 'Telegram_Generated_' . time(),
                        'width'        => 720,
                        'height'       => 1280,
                        'duration'     => 5,
                        'video_status' => 'heygen',
                        'thumbnail'    => $this->config->item('cdn_url') . 'assets/default/images/avatar_loder.gif'
                    ]);
                }
            }
        }
        echo "Queue operations processed perfectly at: " . date('Y-m-d H:i:s');
    }

    // ============================================================
    //  INTERNAL REQUIRED HELPER METHODS (Syncing Class Contexts)
    // ============================================================
    private function generateOpenAidata($prompt)
    {
        $open_ai = new OpenAi($this->openaikey);
        $opt = [
            "model"       => "gpt-3.5-turbo",
            "messages"    => [["role" => "user", "content" => $prompt]],
            "temperature" => 0.5,
            "max_tokens"  => 500,
        ];
        $response = $open_ai->chat($opt);
        $data = json_decode($response, true);
        return $data["choices"][0]["message"]["content"] ?? '';
    }

    private function generate_video_id($prompt)
    {
        $payload = json_encode([
            "prompt"       => $prompt,
            "duration"     => "5",
            "aspect_ratio" => "9:16",
            "model_id"     => "ltx-2.3",
            "watermark"    => false,
            "key"          => $this->modelslab_video_key
        ]);
        $curl = curl_init("https://modelslab.com/api/v6/video/text2video_ultra");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json']
        ]);
        $response = curl_exec($curl); curl_close($curl);
        return json_decode($response, true);
    }

    private function generateSpeechifyAudio($avatar_script, $voiceId, $agent_id)
    {
        $directoryPath = FCPATH . 'assets/uploads/users/' . $agent_id;
        if (!is_dir($directoryPath)) { mkdir($directoryPath, 0777, true); }

        $payload = json_encode(['input' => $avatar_script, 'voice_id' => $voiceId, 'audio_format' => 'wav']);
        $ch = curl_init("https://api.sws.speechify.com/v1/audio/speech");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $this->spechify_key, 'Content-Type: application/json']
        ]);
        $response = curl_exec($ch); curl_close($ch);
        $data = json_decode($response, true);

        if (isset($data['audio_data'])) {
            $decodedAudio = base64_decode($data['audio_data']);
            $fileName_final = 'audio_' . time() . '.wav';
            file_put_contents($directoryPath . '/' . $fileName_final, $decodedAudio);
            return base_url('assets/uploads/users/' . $agent_id . '/' . $fileName_final);
        }
        return null;
    }
}