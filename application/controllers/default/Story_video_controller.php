<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";

require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;



class Story_video_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        
        $this->checkAlreadyLogout();
        $this->Common_Model->checkSubDomain();
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business_id = $this->session->userdata('business_id');
        $this->access_token = $this->session->userdata('business')['access_token'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . "Videocreate_Remotion_Model");
        $this->load->model($this->model_folder . "Cron_Model");
        $this->load->helper('tokengenerate');
        
        //$this->api_key = config_item('heygen_api_key');
        $this->openaikey = config_item('openai_key_legacy_2');
        $this->api_key = config_item('heygen_api_key'); //paid api key heygen
         $this->python_api_key ='D684B8EFF387DBD9';
    }



    public function index()
    {
        $data = array();
        if(empty($this->access_token)) {
            $this->db->select('access_token');
            $this->db->where('id', $this->business_id);
            $query = $this->db->get('business');
            $token = $query->result_array()[0];
            $data['access_token'] = $token['access_token'];
        }else {
            $data['access_token'] = $this->access_token;
        }
        
        if($this->input->post('templates')) {
            $data['template_json'] = $this->input->post('templates');
        }else {
            $data['template_json'] = '';
        }
        $this->loadView('remotion_videoeditor/videoeditor',$data);
   
    }
    
    public function avatarList() {
        
        // pr($this->all_team_privileges); die('here');
        
       // $data['videos'] = $this->Videocreate_Remotion_Model->getHeyganVideo($this->user_id,$this->business_id);
        $this->team_create_avatar = true;
        $this->team_delete_avatar = true;
        $this->team_create_video = true;
        $this->team_workspace = true;
        
        if ($this->user_id != $this->owner_id) {
            if (!in_array('create_video', $this->all_team_privileges)) {
                $this->team_create_video = false;
            }
            if (!in_array('create_avatar', $this->all_team_privileges)) {
                $this->team_create_avatar = false;
            }
            if (!in_array('delete_avatar', $this->all_team_privileges)) {
                $this->team_delete_avatar = false;
            }
                $this->team_workspace = false;
            
        }

        $data['team_create_avatar'] = $this->team_create_avatar;
        $data['team_create_video'] = $this->team_create_video;
        $data['team_delete_avatar'] = $this->team_delete_avatar;
        $data['team_workspace'] = $this->team_workspace;
        $data['permission_msg'] = $this->permission_msg;

           $this->db->where('user_id', $this->user_id);
	       $this->db->where_not_in('id', $this->business_id);
         $data['workspaceData'] = $this->db->order_by('id','DESC')->get('business b')->result_array();
       
        $this->loadView("story/heygen_video_list" ,$data);
    }
    
    public function addworkspaceVideo() {
          // Validate input data
            $list_id= $this->input->post('list_id');
            $name = $this->input->post('name');
            $business_id = $this->input->post('business_id');
            $url = $this->input->post('url');
            
            
            $this->db->select("*");
            $this->db->where('user_id', $this->user_id);
            $this->db->where('business_id', $business_id);
            $prompt_data = $this->db->get('library')->result_array();
            // pr($prompt_data);
            $count = count($prompt_data);

            $this->db->select("*");
            $this->db->where('id', $list_id);
            $user_prompt_data = $this->db->get('library')->row_array();
            // pr($this->db->last_query());
            // pr($user_prompt_data); die('here');
        
                if (empty($prompt_data)) {
                    $prompt_data = $user_prompt_data ;
                    // pr($prompt_data); die('sjida');
                    $prompt_data['title'] = "avatar 1";               
                    //$prompt_data['status'] = $status;           
                    $prompt_data['business_id'] = $business_id; 
                    unset($prompt_data['id']); 
                    $this->db->insert('library', $prompt_data);
                    $response = [
                        'status' => true,
                        'msg' => 'Avatar Moved to Workspace successfully'
                    ];
                } else {
                    $prompt_data = $user_prompt_data ;
                    // pr($prompt_data); die('shasa');
                    $prompt_data['title'] = "avatar " . ($count + 1);               
                    //$prompt_data['status'] = $status;           
                    $prompt_data['business_id'] = $business_id; 
                    unset($prompt_data['id']); 
                    $this->db->insert('library', $prompt_data);
                    $response = [
                        'status' => true,
                        'msg' => 'Avatar Moved to Workspace successfully'
                    ];
                }
                // pr($this->db->last_query());
                // pr($response); die;
                // Return response
                echo json_encode($response);
                die;
    }
    
    
    public function getTemplates() {
       $this->loadView('remotion_videoeditor/videoeditor_template',$data);
    }
    
    public function getHeygenVoice() {
        /* $api_url = 'https://api.heygen.com/v2/voices';
        $voice = getCurlRequests($api_url,$this->api_key);
        $all_voice = json_decode($voice)->data->voices; */
        //  $this->loadView("avtar/avtar_list");
    }
    
    public function getAllAudios() {
        // Decode input JSON
        $audioData = json_decode(file_get_contents('php://input'), true);
        
        $offset = $audioData['offset'];
        $limit = $audioData['limit'];

        // Extract values with null fallback
        $avatars  = !empty($audioData['avatars']) ? $audioData['avatars'] : null;
        $language = !empty($audioData['language']) ? $audioData['language'] : null;
        $gender   = !empty($audioData['gender']) ? $audioData['gender'] : null;
        $emotion  = !empty($audioData['emotion']) ? $audioData['emotion'] : null;
        
        // Create filter array (Only include non-null values)
        $filterarr = [];
        if ($avatars)  $filterarr['support_interactive_avatar'] = $avatars;
        if ($language) $filterarr['language']                = $language;
        if ($gender)   $filterarr['speaker_gender']                     = $gender;
        if ($emotion)  $filterarr['emotion_support']            = $emotion == 'emotion_0' ? "0" : $emotion;
    
        // Fetch data based on filters
        // $filter = false;
        if (!empty($filterarr)) {
            // $filter = true;
            $get_all_voices = $this->Common_Model->getConditionRow('speaker_list', $filterarr,$offset,$limit);
        } else {
            $get_all_voices = $this->Common_Model->getAllRowFromAnyTable('speaker_list',$offset,$limit);
        }
        // pr($filter);
        // Return response
        if (!empty($get_all_voices)) {
            echo json_encode([
                'status' => true,
                // 'filter' => $filter,
                'all_audio' => $get_all_voices
            ]);
        } else {
            echo json_encode(['error' => 'No Data Found','all_audio' => []]);
        }
    }
    


    
    public function getHeygenAvatar(){ 
        $api_url = 'https://api.heygen.com/v2/avatars';
        $avatars = getCurlRequests($api_url,$this->api_key);
        $all_avatars = json_decode($avatars)->data->avatars;
        //echo '<pre>'; print_r(json_decode($avatars)->data->avatars); die;
        // $this->loadView("avtar/avtar_list" ,$all_avatars);
    }
    
    public function getHeygenTalkingPhotoAvatar(){ 
        $api_url = 'https://api.heygen.com/v2/talking_photos';
        $avatars = getCurlRequests($api_url,$this->api_key);
        $all_avatars = json_decode($avatars)->data->avatars;
        $data['language']= $this->db->get('audio_lang')->result_array();
        $data['voice'] = $this->getHeygenVoice();
        
        //echo '<pre>'; print_r(json_decode($avatars)); die;
        $this->loadView("avtar/avtar_list" ,$data);
    }
    
    public function avatarVideoGenerate($character_id,$input_text,$voice_id,$avatar_type,$avtar_url,$video_url,$clone_voice_url,$voicetype) 
    {

        if($voicetype == 'ai_voice'){
            $audiovoice = $this->avatar_voice($input_text, $voice_id);
        }else{
            $audiovoice = $clone_voice_url;
        }

        if (empty($audiovoice)) {
            return false;
        }
        
        if($avatar_type == 'video') {
        $this->Common_Model->checkPlanCountAccess('video_avatar_count',true);
            $type = "avatar";
            $id_colum = "avatar_id";
          $data=   $this->getVideoCurl($character_id,$input_text,$voice_id,$video_url,$audiovoice);
          
           $dataDecoded = json_decode($data, true);
          $result = $dataDecoded['reference_id'];
          
        //   pr($result); die;
        } else {
            $this->Common_Model->checkPlanCountAccess('photo_avatar_count',true);
            /*$type = "talking_photo";
            $id_colum = "talking_photo_id";
             $background = "transparent"; 
                $width = "640";
                $height = "720";
                  $api_url = 'https://api.heygen.com/v2/video/generate';
                  $curl_header = 'Content-Type: application/json';
                   $post_data = json_encode([
                            "video_inputs" => [
                                [
                                    "character" => [
                                        "type" =>  $type,
                                        $id_colum => $character_id
                                    ],
                                    "voice" => [
                                        "type" => "text",
                                        "input_text" => $input_text,
                                        "voice_id" => $voice_id
                                    ]
                                ]
                            ],
                            "test" => true,
                            "dimension" => [
                                "width" => $width,
                                "height" => $height
                            ],
                            "background" => $background
                        ]);
                  $result = $this->postCurlRequest($api_url,$curl_header,$post_data);*/
            $result = $this->generateDupDubAavatar($avtar_url, $audiovoice);
            
           
             if (isset($avatarVideoUrl['success']) && !$avatarVideoUrl['success']) {
                    $response['success'] = false;
                    $response['message'] = $avatarVideoUrl['message'];
                    echo json_encode($response);
                    return $result;
                }
        }
        
       
        //   pr($result); die('here');
          return $result;
    }
    
    
      public function fetchDupDubVideoAndSave($id, $api_key)
        {
            set_time_limit(300); // Allow enough time for polling
            $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/" . $id;
            $headers = [
                "dupdub_token: $api_key",
                "Content-Type: application/json"
            ];
        
            $ch = curl_init();
            $timeout = 300; // Maximum time to wait (in seconds)
            $interval = 10; // Polling interval (in seconds)
            $elapsedTime = 0;
        
            while ($elapsedTime < $timeout) {
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
                $response = curl_exec($ch);
        
                if ($response === false) {
                    echo "cURL Error: " . curl_error($ch);
                    break;
                }
        
                $response_data = json_decode($response, true);
        
                if (isset($response_data['code']) && $response_data['code'] == '200') {
                    $result_url = $response_data['data']['videoUrl'];
        
                    if (!empty($result_url)) {
                        
                        $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id . '/' . $this->business_id . '/' . "AvatarVideos" . '/';
                        $savePath = FCPATH . $ownerDirectoryName;
        
                        if (!is_dir($savePath)) {
                            mkdir($savePath, 0755, true);
                        }
        
                        $videoContent = file_get_contents($result_url);
                        if ($videoContent !== false) {
                            $videoFileName = time() . '.mp4';
                            $saveFilePath = $savePath . $videoFileName;
                            file_put_contents($saveFilePath, $videoContent);
        
                            curl_close($ch);
                            return $ownerDirectoryName . $videoFileName;
                        } else {
                            echo "Error downloading video.";
                            break;
                        }
                    }
                }
        
                // Delay and retry
                sleep($interval);
                $elapsedTime += $interval;
            }
        
            curl_close($ch);
            echo "Timeout or error occurred while waiting for video generation.";
            return false;
        }
    
    public function avatar_voice($prompt , $speaker_value) {
        
            
            $url = "https://moyin-gateway.dupdub.com/tts/v1/playDemo/dubForSpeaker";
            $api_key = config_item('dupdub_api_key');
            
            // Headers
            $headers = [
                'dupdub_token: ' . $api_key,
                'Content-Type: application/json'
            ];
            
            // Payload data
            $data = [
                "speaker" => $speaker_value,
                "speed" => "1.0",
                "pitch" => "1.0",
                "textList" => [$prompt]
            ];
            
            // pr($data); die;
            
            // Initialize cURL session
            $ch = curl_init($url);
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send data as JSON
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers
    
            // Execute cURL request
            $response = curl_exec($ch);
         
             $result = json_decode($response, true);
    
            $ossFile = $result['data']['resList'][0]['result']['ossFile'];
            // pr($ossFile); die;
            return $ossFile ;
 
            curl_close($ch);
        }
        
        public function generateDupDubAavatar($imagePath, $audiovoice)
            { 
                $api_key = config_item('dupdub_api_key'); 
                $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/detectAvatar";  
                $data = [
                    "photoUrl" => $imagePath
                ]; 
                $json_data = json_encode($data); 
                $headers = [
                    "dupdub_token: $api_key",
                    "Content-Type: application/json"
                ]; 
                $ch1 = curl_init(); 
                
                // Set cURL options
                curl_setopt($ch1, CURLOPT_URL, $url);
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch1, CURLOPT_POST, true);
                curl_setopt($ch1, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers); 
                $response = curl_exec($ch1); 
                
                if ($response === false) {
                    curl_close($ch1);
                    return ['success' => false, 'message' => "cURL Error: " . curl_error($ch1)];
                } else {
                    // Decode the JSON response
                    $responseBoxJson = json_decode($response, true); 
                    
                    if (isset($responseBoxJson['code']) && $responseBoxJson['code'] == 200) {
                        $boxes = $responseBoxJson['data']['boxes'] ?? null; 
                        if (!$boxes) {
                            curl_close($ch1);
                            return ['success' => false, 'message' => "No boxes detected in the avatar response."];
                        } 
            
                        $boxessize = [
                            $boxes[0][0],
                            $boxes[0][1],
                            $boxes[0][2],
                            $boxes[0][3]
                        ];
                        curl_close($ch1); 
            
                        // Proceed to create the avatar
                        $ch = curl_init();
                        $audioPath = $audiovoice;
                        $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/createMulti";  
                        $data = [
                            "photoUrl" => $imagePath,
                            "info" => [
                                [
                                    "audioUrl" => $audioPath,
                                    "box" => $boxessize
                                ]
                            ],
                            "watermark" => 0,
                            "useSr" => false
                        ];  
                        $headers = [
                            "dupdub_token: $api_key",
                            "Content-Type: application/json"
                        ]; 
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
                        $response = curl_exec($ch);  
                        
                        if ($response === false) {
                            curl_close($ch);
                            return ['success' => false, 'message' => "cURL Error while creating project: " . curl_error($ch)];
                        } else { 
                            $responseData = json_decode($response, true); 
                            if (isset($responseData['code']) && $responseData['code'] == 200) { 
                                $id = $responseData['data']['id'];
                                curl_close($ch);  
                                return $this->fetchDupDubVideoAndSave($id, $api_key);
                            } else {
                                curl_close($ch); 
                                return ['success' => false, 'message' => "Failed to create project."];
                            }
                        }  
                    } else {
                        return ['success' => false, 'message' => "Failed to detect face."];
                    }
                }
            }
    
    //     public function getCompeleteVideoStatus($id,$video_id,$url,$avatar_type) 
    //     {
    //         $api_url = 'https://api.heygen.com/v1/video_status.get?video_id='.$video_id;
    //         $slug = $this->Videocreate_Remotion_Model->create_video_slug();
    //         // $video_status = getCurlRequests($api_url,$this->api_key);
    //         // $thumbnail_url = json_decode($video_status)->data->thumbnail_url;
    //         // $video_url = json_decode($video_status)->data->video_url;
           
    //         if (!empty($video_id)) {
            
    // 		 //downloadImageUrl($path.$slug,$upload_path_video,$video_url);
    // 		 //downloadImageUrl($path.$slug,$upload_path_image,$thumbnail_url);
    // 		// moveVideoOnS3($path,$slug);
    	     
    // 		 $api_key ='D684B8EFF387DBD9';
    // 		 $upload_db_path = $path.$slug.'/'.$video_filename;
    // 		 $upload_db_path_image = $path.$slug.'/'.$image_filename;
    // 		 $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
    // 	     $post_data = array(
    // 	           'api_key'=> $this->python_api_key,
    // 	           'url' => $url
    // 	           );
    // 		 $video_details = getVideoDetailsPyCurl($post_data,$apiUrl);
    
    // 		   $thumbnail_url_extention = getFileExtension($video_details->thumbnail);
    //         //$video_url_extention = getFileExtension($video_url);
    //     	$upload_folder = './assets/uploads/';
    // 		if(!is_dir($upload_folder.'videos/'.$slug)){
    // 			mkdir($upload_folder.'videos/'.$slug);
    // 		}
    // 		  $path = 'assets/uploads/videos/';
    // 		$image_filename = $slug.'.'.$thumbnail_url_extention;
    //       // $video_filename = $slug.'.'.$video_url_extention;
    //         //$upload_path_video = $path.$slug.'/'.$video_filename;
    //         $upload_path_image = $path.$slug.'/'.$image_filename;
              
    // 		 downloadImageUrl($path.$slug,$upload_path_image,$video_details->thumbnail);
    		 
    // 		  rmdir('./'.$path.$slug);
    //             $this->db->select("*");
    //             $this->db->where('user_id',  $this->user_id);
    //             $this->db->where('business_id', $this->business_id);
    //             $this->db->where('video_status', 'heygen');
    //             $this->db->like('title', 'avatar'); 
    //             $avatar_data = $this->db->get('library')->result_array();
                
    //             $count = count($avatar_data);
                
    //             // $new_title = 'avatar ' . ($count + 1);
    
            
    //         	$video_info = array(
    //                 'user_id'       => $this->owner_id,
    //                 'business_id'   =>$this->business_id,
    //         		'project_id'	 => 1,
    //         		'slug'			 => $slug,
    //         		'file_type'			 => 'V',
    //         		'avatar_id'         => '',
    //         		//'url'			 => $this->config->item('cdn_url').$upload_db_path,
    //         // 		'title' 		 => 'avatar '.($count + 1),
    //         		'width'          =>$video_details->width,
    //         		'height'         =>$video_details->height,
    //         		'duration'       =>$video_details->duration,
    //         		'video_status'  => 'heygen',
    //         		'thumbnail'	     => $this->config->item('cdn_url').$upload_path_image
    //         	);
    //         	$video_id = $this->Videocreate_Remotion_Model->update_video_create($id,$video_info);
            
    //         	/*$vidoeFolder = 'assets/uploads/videos/'.$slug.'/';
    // 		    $dir = './'.$vidoeFolder;*/
    // 		    //rmdir($dir);
    // 		    $status = true;
    // 		    echo json_encode($status); die;
    //         }else {
    //             $status = false;
    // 		    echo json_encode($status); die;
    //         }
    //     }
    
    
    
    public function getCompeleteVideoStatus($id, $video_id, $url, $avatar_type)
        {
            $slug = $this->Videocreate_Remotion_Model->create_video_slug();
            $path = 'assets/uploads/videos/';
            $upload_folder = './' . $path . $slug;
        
            // Create video folder
            if (!is_dir($upload_folder)) {
                mkdir($upload_folder, 0755, true);
            }
        
            if (!empty($video_id) && $avatar_type === 'video') {
                
                $video_url = $this->videogenerate($video_id);
                // pr($video_url);
                $imageData = file_get_contents($video_url);
        
                if ($imageData === false) {
                    pr("Error downloading video from: " . $video_url);
                    echo json_encode(false);
                    return;
                }
        
                $filename = 'generated_' . time() . '_' . rand(1000, 9999) . '.mp4';
                $directoryPath = FCPATH . 'assets/uploads/users/' . $this->owner_id;
        
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0777, true);
                }
        
                $filePath = $directoryPath . '/' . $filename;
        
                if (file_put_contents($filePath, $imageData) === false) {
                    pr("Error saving the video to: " . $filePath);
                    echo json_encode(false);
                    return;
                }
        
                $uploadpath = 'assets/uploads/users/' . $this->owner_id . "/" . $filename;
                // Upload to AWS
                $aws_path = $this->uploadAWS($uploadpath);
        
                $bucketUrl = $this->config->item('bucket_url') . $uploadpath;
                if($bucketUrl) {
                    $url = $bucketUrl;
                }
               
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

        
            $video_info = [
                'user_id'      => $this->owner_id,
                'business_id'  => $this->business_id,
                'project_id'   => 1,
                'slug'         => $slug,
                'file_type'    => 'V',
                'url'          =>$url,
                'avatar_id'    => '',
                // 'title'        => $title,
                'width'        => $video_details->width ?? 0,
                'height'       => $video_details->height ?? 0,
                'duration'     => $video_details->duration ?? 0,
                'video_status' => 'heygen',
                'thumbnail'    => $this->config->item('cdn_url') . $upload_path_image
            ];
        
            $this->Videocreate_Remotion_Model->update_video_create($id, $video_info);
        
            echo json_encode(true);
        }

    
    
        public function videogenerate($reference_id)
            {
                $api_key = 'D684B8EFF387DBD9';
            
                $curl = curl_init();
            
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://ai3.oppyo.com/app/v1/get_lipsynch_video_processed',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'api_key' => $api_key,
                        'reference_id' => $reference_id
                    ),
                ));
            
                $response = curl_exec($curl);
                
                if (curl_errno($curl)) {
                    echo 'Curl error: ' . curl_error($curl);
                } 
                
                curl_close($curl);
            
                $responseData = json_decode($response);
            
                if (!empty($responseData->success) && $responseData->success == true && !empty($responseData->url)) {
                    return 'https://ai3.oppyo.com/files/' . $responseData->url;
                } else {
                    return false;
                }
            }

    
    public function validateFolderDirectory($folderName, $imageName='')
	{
		$owner_id=$this->owner_id;
		$ownerDirectoryName = './assets/uploads/users/' . $owner_id;
		if(!is_dir($ownerDirectoryName)){
			mkdir($ownerDirectoryName, 0755, true);
		}
		$subFolderDirectory=$ownerDirectoryName."/".$folderName;
		if(!is_dir($subFolderDirectory)){
			mkdir($subFolderDirectory, 0755, true);
		}

	}
	
    public function uploadOwnPhotoHeygen(){
        $name = $this->input->post('name');
        // $gender = $this->input->post('gender');
        // $age = $this->input->post('age');
        
        if($_FILES) {
            $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id;
            $library_folder = "library_images";
            $this->validateFolderDirectory($library_folder);
            $upload_path = $ownerDirectoryName.'/'.$library_folder.'/';
            $api_url = 'https://upload.heygen.com/v1/talking_photo';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; 

            $this->upload->initialize($config);

        if ($this->upload->do_upload('avatar')) {
            $file_data = $this->upload->data();
            $file_path = $file_data['file_name']; 
            $image_path = $upload_path.$file_path;
            $this->Cron_Model->uploadAWS($image_path);
            //$image_path = 'assets/uploads/videos/Frame_1000002473-removebg-preview.png';
           // $post_data = file_get_contents($image_path);
            //$curl_header = 'Content-Type: image/jpeg';
            //$result = $this->postCurlRequest($api_url,$curl_header,$post_data);
     
        
                 $insert_data = array(
                'user_id'=> $this->owner_id,
                'business_id' => $this->business_id,
                'url' => $this->config->item('cdn_url').$image_path,
                'name' => $name,
                'avatar_status' =>'talking_photo',
                'status' =>1,
                'avtar_id'=>'',
                'avatar_gender'=> $gender,
                'avatar_age'=> $age,
                'created_date' => time(),
                );
                $this->Common_Model->InsertIntoAnyTable('avtar_photo_n_videos',$insert_data);
  
              
            // if(!empty(json_decode($result)->data)) {
            //   // unlink($image_path);
            // }
        } else {
            echo $this->upload->display_errors();
        }
   
        }else {
         // $data = array();
          //  $this->loadView('remotion_videoeditor/upload_avatar',$data);
        }
    }
    
    
        public function getAvatarMadeList() {
            $avatar_type = $this->input->post('avatar_type');
            $favourite = $this->input->post('favourite');
        
            $data = $this->Videocreate_Remotion_Model->getHeyganVideo($this->owner_id, $this->business_id,$avatar_type,$favourite);
            if (empty($data)) { echo json_encode([
                    'status' => false,
                    'avatarListingMade' => []
                ]);
            } else { echo json_encode([
                    'status' => true,
                    'avatarListingMade' => $data
                ]);
            }
        
            exit();
        }

        
       public function getavatartitle() {
            $id = $this->input->post('id');
            $data = $this->Videocreate_Remotion_Model->getavatartitle($this->owner_id,$this->business_id , $id);
            // pr($data); die;
            if(empty($data)) {
    	        echo json_encode(array('status' => false, 'avatartitle' => array()));
    	        exit();
            }
    	    echo json_encode(array('status' => true, 'avatartitle' =>  $data));
    	    exit();
        }
        
        
        public function getEditorList() {
            $data = $this->Videocreate_Remotion_Model->getEditorList($this->owner_id,$this->business_id);
            if(empty($data)) {
    	        echo json_encode(array('status' => false, 'avatarListingMade' => array()));
    	        exit();
            }
    	    echo json_encode(array('status' => true, 'avatarListingMade' =>  $data));
    	    exit();
        }
        
        public function gettitle() {
            $id = $this->input->post('id');
            $data = $this->Videocreate_Remotion_Model->gettitle($this->owner_id,$this->business_id , $id);
            // pr($data); die;
            if(empty($data)) {
    	        echo json_encode(array('status' => false, 'videotitle' => array()));
    	        exit();
            }
    	    echo json_encode(array('status' => true, 'videotitle' =>  $data));
    	    exit();
        }
        
        public function getEditorDraftList() {
            $data = $this->Videocreate_Remotion_Model->getEditordraftList($this->owner_id,$this->business_id);
            // pr($data); die;
            if(empty($data)) {
    	        echo json_encode(array('status' => false, 'draftvideoListing' => array()));
    	        exit();
            }
    	    echo json_encode(array('status' => true, 'draftvideoListing' =>  $data));
    	    exit();
        }
        
        public function deleteAvatarVideo() {
            $video_id = $this->input->post('video_id');
            $this->db->where('id',$video_id);
            $this->db->delete('library');
			$flashdata['status'] = true;
			$flashdata['msg'] = 'Delete successfully.';
			echo json_encode($flashdata);
		    exit();
        }
        
        public function getAvatarImage(){
            $avatarData = json_decode(file_get_contents('php://input'), true);
            $offset     = $avatarData['offset'];
            $limit      = $avatarData['limit'];
            $avtar_type      = $avatarData['avtar_type'];
            $searchQuery      = $avatarData['searchQuery'];
            $type = $avtar_type == 'video' ? 'talking_video' : 'talking_photo';
            
            $avatarImage = $this->Videocreate_Remotion_Model->getAvatarImage($offset, $limit,$type,$searchQuery);
            if(empty($avatarImage)) {
                echo json_encode(array('status' => false, 'avatarImage' => array()));
                exit();
            }
            echo json_encode(array('status' => true, 'avatarImage' => $avatarImage));
            exit();
        }
    
    
    public function postCurlRequest($api_url,$curl_header,$post_data){
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $api_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $post_data,
          CURLOPT_HTTPHEADER => array(
            'x-api-key: '.$this->api_key,
            $curl_header
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;

    }

     public function insertAllAvatars(){
        $url = 'https://api.heygen.com/v2/avatars';
        $apiKey = config_item('heygen_api_key');

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ["accept: application/json", "X-Api-Key: $apiKey"]
        ]);
    
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        $data['data'] ?? [];

        if (!isset($data['data']['avatars'])) {
            die('No avatars found');
        }
        //echo '<pre>'; print_r($data['data']); die;
        // Prepare data for insertion
        $avatars = [];
        foreach ($data['data']['avatars'] as $avatar) {
            
            $path_info = pathinfo(parse_url($avatar['preview_image_url'], PHP_URL_PATH));
            //$file_extension = isset($path_info['filename']) ? $path_info['filename'] : 'png';
            //$file_extension_video = isset($path_info['extension']) ? $path_info['extension'] : 'webp';
            $file_extension = 'webp';
            $ownerDirectoryName = 'assets/uploads/avatar/talking_video';
            $image_name = 'avatar'.time().'.'.$file_extension;
              $temp_file_path_image = $ownerDirectoryName . '/' . $image_name;
              $temp_file_path_video = $ownerDirectoryName . '/avatar_video'.time().'.mp4';
            downloadImageUrl($temp_file_path_image,$temp_file_path_image,$avatar['preview_image_url']);
            downloadImageUrl($temp_file_path_video,$temp_file_path_video,$avatar['preview_video_url']);
        
           /* $avatars = array(
                'name'  => $avatar['talking_photo_name'], 
                'url' => $this->config->item('cdn_url').$temp_file_path,
                'avtar_id' => $avatar['talking_photo_id'],
                'avatar_status' => 'talking_photo',
                'status' => 1,
                'created_date' => time()
            );*/
            
            
              $avatars = array(
                'name'  => $avatar['avatar_name'], 
                'url' => $this->config->item('cdn_url').$temp_file_path_image,
                'video_url' => $this->config->item('cdn_url').$temp_file_path_video,
                'avtar_id' => $avatar['avatar_id'],
                'avatar_status' => 'talking_video',
                'avatar_gender' => $avatar['gender'],
                'status' => 1,
                'created_date' => time()
            );
            
            $insertQuery = $this->db->insert('avtar_photo_n_videos', $avatars);
            unlink($temp_file_path );
            sleep(5);
           
        }

        if (!empty($avatars)) {
            // $insertQuery = $this->db->insert_batch('avtar_photo_n_videos', $avatars);
            
            // unlink($temp_file_path );
            if($insertQuery){
                echo "Succsefully Insert";
            }else{
                echo "Not Inserted";
            }
        }
    } 
    
    
    /*public function getCurlRequest($api_url){

          
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => $api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'x-api-key: '.$this->api_key
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            return  $response;

    }*/


     public function getScript(){
        
        $prompData = json_decode(file_get_contents('php://input'), true);
        $openAISecretKey = $this->openaikey ;
        $keyword = $prompData['prompt'];
        $open_ai = new OpenAi($openAISecretKey);
        // Define the prompt based on the keyword
        // $prompt = "Create only 1 quiz questions on the topic of $keyword. For each question, provide 4 answer options (A, B, C, D), and mark the correct answer. Ensure the questions are well-structured and cover various aspects of the topic. The difficulty level should be a mix of easy, moderate, and challenging.";

        // $prompt = "Generate a compelling 1000-word long description for this prompt '".$keyword."' ";
        $prompt = "Write a clear and engaging voice-over script about ".$keyword.". The total length should be around 400�500 characters. The script should start with a strong hook, briefly explain the key idea, and end with a simple takeaway or call to action.";
        $prompt = str_replace(["�", "�", "�"], ["-", "\"", "\""], $prompt);
        $history[] = ["role" => "user", "content" => $prompt];
        
       
        $opt = [
            "model" => "gpt-3.5-turbo",
            "messages" => $history,
            "temperature" => 0.5,
            "max_tokens" => 1000,
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
    
    
    public function videoEditorList() {
        $this->team_create_video = true;
        $this->team_edit_video = true;
        $this->team_delete_video = true;
        $this->team_addtoworkspace = true;
        $this->team_templates = true;
        $this->team_youtube_publisher =true;
        
        if ($this->user_id != $this->owner_id) {
            if (!in_array('create_video', $this->all_team_privileges)) {
                $this->team_create_video = false;
            }
            if (!in_array('edit_video', $this->all_team_privileges)) {
                $this->team_edit_video = false;
            }
            if (!in_array('delete_video', $this->all_team_privileges)) {
                $this->team_delete_video = false;
            }
            if (!in_array('templates', $this->all_team_privileges)) {
                $this->team_templates = false;
            }
            if (!in_array('youtube_publisher', $this->all_team_privileges)) {
                $this->team_youtube_publisher = false;
            }
                $this->team_workspace = false;
            
        }
        

        $data['team_create_video'] = $this->team_create_video;
        $data['team_edit_video'] = $this->team_edit_video;
        $data['team_delete_video'] = $this->team_delete_video;
        $data['team_templates'] = $this->team_templates;
        $data['team_workspace'] = $this->team_workspace;
        $data['team_youtube_publisher'] = $this->team_youtube_publisher;
        $data['permission_msg'] = $this->permission_msg;
        
        // pr($data); die;
        
        $this->session->unset_userdata('project_name');
        $this->session->unset_userdata('mp4_session');
        $this->db->where('user_id', $this->owner_id);
        $this->db->where_not_in('id', $this->business_id);
        $data['workspaceData'] = $this->db->order_by('id','DESC')->get('business b')->result_array();
        if(empty($this->access_token)) {
            $this->db->select('access_token');
            $this->db->where('id', $this->business_id);
            $query = $this->db->get('business');
            $token = $query->result_array()[0];
            $data['access_token'] = $token['access_token'];
        }else {
            $data['access_token'] = $this->access_token;
        }
        $this->loadView("avtar/editor_list", $data);
    }
    
    public function createNewProject(){
        $project_name = $this->input->post('project_name');
        $data = array(
            'user_id'=>$this->owner_id,
            'business_id'=>$this->business_id,
            'title' => $project_name,
            'file_type' => 'V'
            );
            
        $this->db->insert('user_render_videos',$data);
          $id =  $this->db->insert_id();
        $data= array(
            'id'=> $id,
            'name'=>$project_name,
            'json_url' => ''
            );
            
        $this->session->set_userdata('project_name',$data);
        echo json_encode($data); die;
    }
    
    public function editVideoTemplate($id){
        $this->session->unset_userdata('project_name');
        $data = $this->Common_Model->getSingleRowFromAnyTable('id',$id,' user_render_videos');
        $new_session = array(
            'id'=>$data->id,
            'name'=>$data->title,
            'json_url'=>$data->json_url,
            'template' => 'custom_template'
            );
            $this->session->set_userdata('project_name',$new_session);
             $redirect = base_url().$this->config->item('prefix_video_route').'/video-editor'; 
            redirect($redirect);
        
    }
    
    public function editDefaultVideoTemplate($id){
        $this->session->unset_userdata('project_name');
        $data = $this->Common_Model->getSingleRowFromAnyTable('id',$id,'vidoe_default_templates');
        $insert_data = array(
             'user_id'=>$this->owner_id,
            'business_id'=>$this->business_id,
            'file_type' => 'V',
            'title' => $data->title
            );
        $last_insert_id = $this->Common_Model->InsertIntoAnyTable('user_render_videos',$insert_data);
        
        $new_session = array(
            'id'=>$last_insert_id,
            'name'=>$data->title,
            'json_url'=>$data->json_url,
            );
            $this->session->set_userdata('project_name',$new_session);
             $redirect = base_url().$this->config->item('prefix_video_route').'/video-editor'; 
            redirect($redirect);
    }
    
       public function deleteRenderVideo() {
            $video_id = $this->input->post('video_id');
            $this->db->where('id',$video_id);
            $this->db->delete('user_render_videos');
			$flashdata['status'] = true;
			$flashdata['msg'] = 'Delete successfully.';
			echo json_encode($flashdata);
		    exit();
        }
        
        public function generateAvatarVideo(){

            $audioData = json_decode(file_get_contents('php://input'), true);
            
            // pr($audioData); die;
            $avatar_type = $audioData['avatar_type'];
            $avatar_script = $audioData['avatar_script']; 
            $avtar_audio = $audioData['avtar_audio']; 
            $avtar_id = $audioData['avtar_id'];
            $avtar_name = $audioData['avatar_name'];
            $avtar_url = $audioData['avtar_url'];
            $video_url = $audioData['video_url'];
            $clone_voice_url = $audioData['audio_url'];
            $voicetype = $audioData['voicetype'];
            
           
            $data = $this->avatarVideoGenerate($avtar_id ,$avatar_script,$avtar_audio,$avatar_type,$avtar_url,$video_url,$clone_voice_url,$voicetype);
            
            if($avatar_type == 'video') {
                // $dataDecoded = json_decode($data, true);
                $reference_id = $data;
                $avatarVideoUrlServer = '';
            }else {
                $this->Cron_Model->uploadAWS($data);
                $avatarVideoUrlServer = $this->config->item('cdn_url') . $data;        
                 $reference_id = time();
            }
            if($data) {
                 $response  = array(
                     'status'=>'success', 
                     'video_id' =>$reference_id
                     );  
            }
        
        // pr($response); die('here');
        
            if(!empty($data)) {
                $video_info = array(
                'user_id'            => $this->owner_id,
                'business_id'        =>$this->business_id,
        		'project_id'	     => 1,
        		'file_type'			 => 'V',
        		'avatar_id'          => $reference_id,
        		'title' 		     => $avtar_name,
         		'url'                => $avatarVideoUrlServer,
        		'video_status'       => 'heygen',
        		'thumbnail'	         => $this->config->item('assetsBasePath').'assets/default/images/avatar_loder.gif',
        		'avatar_type'        => $avatar_type,
            	);
            // 	pr($video_info); die;
        	$video_id = $this->Videocreate_Remotion_Model->video_create($video_info);
            }
            
            // pr(json_encode($response)); die;
                
            echo  json_encode($response); die;
            
            
            //echo '<pre>'; print_r($result->data->video_id); die;
           
        }
        
        
        
        public function uploadAudioFile()
           {
               
                    $avatar_script = $this->input->post('avatar_script');
               
                    if (isset($_FILES['audioFile']['name']) && !empty($_FILES['audioFile']['name'])) {
                        $path = $this->addLibraryImages('audioFile', 'audioFile');
                        $user_audioUrl = $this->config->item('bucket_url') . $path;
                        $audioFileProvided = true;
                    }

    
                   if($user_audioUrl) {
                        $apiBaseUrl = "https://api.sws.speechify.com/v1/voices";
                        $apiKey = config_item('spechify_key_2'); 
                        $name = "My Voice Name";
                        $consent = json_encode([
                            "fullName" => "John McVoices",
                            "email" => "me@voices.audio"
                        ]);
                        $filePath = $user_audioUrl;
                        $curlFile = curl_file_create($filePath);
                    
                        $postFields = [
                            "name" => $name,
                            "consent" => $consent,
                            "sample" => $curlFile
                        ];
                    
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $apiBaseUrl);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "Authorization: Bearer $apiKey",
                            "Content-Type: multipart/form-data"
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    
                        $response = curl_exec($ch);
                        curl_close($ch);
                    
                        if ($response === false) {
                            $result = [
                                'status' => false,
                                'msg' => 'please upload minimum 5 seconds and maximum 30 seconds audio',
                            ];
                            echo json_encode($result);
                        }
                        $responseData = json_decode($response, true);

                        
                        
                         $voiceId = $responseData['id'] ?? null;
                          $apiBaseUrl = "https://api.sws.speechify.com/v1/audio/speech";
                          $audioFormat = "wav";
                          
                           $payload = json_encode([
                                'input' => $avatar_script,
                                'voice_id' => $voiceId,
                                'audio_format' => $audioFormat
                            ]);
                            
                             // Initialize cURL for speech generation
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $apiBaseUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Bearer ' . $apiKey,
                                'Content-Type: application/json'
                            ]);
                           
                           $response = curl_exec($ch);
                           
                            curl_close($ch);
                        
                            if (curl_errno($ch)) {
                                return "Error: " . curl_error($ch);
                            }
                        
                            $data = json_decode($response, true);
                        if (isset($data['audio_data'])) {
                              $audioFile = $data['audio_data'];
                              $audioFormat = 'wav'; 
                            $decodedAudio = base64_decode($audioFile);
                        
                            $fileName = 'audio_' . time() . '.' . $audioFormat;
                        
                            $directoryPath = FCPATH . 'assets/uploads/users/' . $this->owner_id;
                        
                            if (!is_dir($directoryPath)) {
                                mkdir($directoryPath, 0777, true);
                            }
                            $filePath = $directoryPath . '/' . $fileName;
                            file_put_contents($filePath, $decodedAudio);
                            $uploadPath = 'assets/uploads/users/' . $this->owner_id . '/' . $fileName;
                            $audiovoice = $this->config->item('assetsBasePath') . $uploadPath;
                         }
                     
                    }
                     
                     
                    if ($audiovoice) {
                            $result = [
                                'status' => true,
                                'msg' => 'Voice Generated successfully.',
                                'audioUrl' => $audiovoice
                            ];
                        } else {
                            $result = [
                                'status' => false,
                                'msg' => 'Something went wrong',
                            ];
                        }
                        
                        echo json_encode($result);
                        
           }
           

        
        
        public function getGeneratedAvatarVideo() {
            $Datas = json_decode(file_get_contents('php://input'), true);
            $this->getCompeleteVideoStatus($Datas['id'],$Datas['avtar_video_id'],$Datas['url'],$Datas['avatar_type']);
        }
        
        
        public function gotoEditor() {
            $id = $_GET['id'];
            $data = $this->Common_Model->getSingleRowFromAnyTable('id',$id,'library');
             $insert_data = array(
             'user_id'=>$this->owner_id,
            'business_id'=>$this->business_id,
            'file_type' => 'V',
            'title' => $data->title
            );
        $last_insert_id = $this->Common_Model->InsertIntoAnyTable('user_render_videos',$insert_data);
            $dataSession = array(
                'url'               => $data->url,
                'thumbnail_url'     =>$data->thumbnail,
                 'width'           => $data->width,
                'height'            => $data->height,
                'duration'          => $data->duration,
                'playerHeight'      => $_GET['height'],
                'playerWidth'       => $_GET['width'],
                'id'                => $last_insert_id,
                'project_name'      => $data->title,
                );
                
                $this->session->set_userdata('mp4_session',$dataSession);
            $redirect = base_url().$this->config->item('prefix_video_route').'/video-editor'; 
            redirect($redirect);
        }
        
        
        public function default_template() {
            
        $this->team_create_video = true;
        $this->team_edit_video = true;
        $this->team_delete_video = true;
        $this->team_addtoworkspace = true;
        $this->team_templates = true;
        
        if ($this->user_id != $this->owner_id) {
            if (!in_array('create_video', $this->all_team_privileges)) {
                $this->team_create_video = false;
            }
            if (!in_array('edit_video', $this->all_team_privileges)) {
                $this->team_edit_video = false;
            }
            if (!in_array('templates', $this->all_team_privileges)) {
                $this->team_templates = false;
            }
        }

        $data['team_create_video'] = $this->team_create_video;
        $data['team_edit_video'] = $this->team_edit_video;
        $data['team_templates'] = $this->team_templates;
        $data['permission_msg'] = $this->permission_msg;
      
        $this->loadView("avtar/default_template", $data);
        }
        
        
        public function get_default_template() {
            $data = $this->Videocreate_Remotion_Model->get_default_temaplate($this->owner_id,$this->business_id);
            // pr($data); die;
            if(empty($data)) {
    	        echo json_encode(array('status' => false, 'avatarListingMade' => array()));
    	        exit();
            }
    	    echo json_encode(array('status' => true, 'avatarListingMade' =>  $data));
    	    exit();
        }
        
        
        public function updateFavStatus()
            {
                $data = $this->input->post();
            
                if (isset($data['prompt_id']) && isset($data['value'])) {
                    $promptId = $data['prompt_id'];
                    $status = $data['value'];
                    
                    // Call the model method to update favorite status
                    $success = $this->Videocreate_Remotion_Model->updateFavoriteStatus($promptId, $status);
            
                    // Respond based on success or failure
                    if ($success) {
                        if ($status) {
                            echo json_encode(array('message' => 'Added to favorites successfully'));
                        } else {
                            echo json_encode(array('message' => 'Removed from favorites successfully'));
                        }
                    } else {
                        echo json_encode(array('error' => 'Failed to update favorite status'));
                    }
                } else {
                    echo json_encode(array('error' => 'Invalid data provided'));
                }
            }
            
            
            public function AvatarFavStatuschange()
            {
                $data = $this->input->post();
            
                if (isset($data['prompt_id']) && isset($data['value'])) {
                    $promptId = $data['prompt_id'];
                    $status = $data['value'];
                    
                    // Call the model method to update favorite status
                    $success = $this->Videocreate_Remotion_Model->avatarFavoriteStatus($promptId, $status);
            
                    // Respond based on success or failure
                    if ($success) {
                        if ($status) {
                            echo json_encode(array('message' => 'Added to favorites successfully'));
                        } else {
                            echo json_encode(array('message' => 'Removed from favorites successfully'));
                        }
                    } else {
                        echo json_encode(array('error' => 'Failed to update favorite status'));
                    }
                } else {
                    echo json_encode(array('error' => 'Invalid data provided'));
                }
            }
            
            
            public function getfavVideoList()
            {
                $avatarList = $this->Videocreate_Remotion_Model->getfavAvatarListing();
                // pr($this->db->last_query());
                // pr($avatarList); die;
                if(empty($avatarList)) {
        	        echo json_encode(array('status' => false, 'avatarListingMade' => array()));
        	        exit();
                }
        	    echo json_encode(array('status' => true, 'avatarListingMade' => $avatarList));
        	    exit();
            }
            
            
            
            
            // public function getVideoCurl($charector_id,$input_text,$audio_id) {
            //   $id = "Ren_sitting_office_front";
            //   $curl = curl_init();

            // curl_setopt_array($curl, array(
            //   CURLOPT_URL => 'https://api.heygen.com/v2/video/generate',
            //   CURLOPT_RETURNTRANSFER => true,
            //   CURLOPT_ENCODING => '',
            //   CURLOPT_MAXREDIRS => 10,
            //   CURLOPT_TIMEOUT => 0,
            //   CURLOPT_FOLLOWLOCATION => true,
            //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //   CURLOPT_CUSTOMREQUEST => 'POST',
            //   CURLOPT_POSTFIELDS =>'{
            //   "video_inputs": [
            //     {
            //       "character": {
            //         "type": "avatar",
            //         "avatar_id": "'.$charector_id.'",
            //         "avatar_style": "normal"
            //       },
            //       "voice": {
            //         "type": "text",
            //         "input_text": "'.$input_text.'",
            //         "voice_id": "'.$audio_id.'",
            //         "speed": 1.1
            //       },
            //       "background": {
            //           "type":"color",
            //           "value": "#ffffff"
                    
            
            //       }
            //     }
            //   ],
            //   "dimension": {
            //     "width": 1280,
            //     "height": 720
            //   }
            // }
            
            // ',
            //   CURLOPT_HTTPHEADER => array(
            //     'accept: application/json',
            //     'content-type: application/json',
            //     'x-api-key: <heygen key removed - see config/secrets.php>'
            //   ),
            // ));
            
            // $response = curl_exec($curl);
            
            // curl_close($curl);
            // return $response;
            // }
            
            
            public function getVideoCurl($character_id, $input_text, $audio_id, $video_url, $audiovoice) {
                $curl = curl_init();
            
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://ai3.oppyo.com/app/v1/lipsync_video_queue?',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'api_key' => 'D684B8EFF387DBD9',
                        'video_url' => $video_url,
                        'audio_url' => $audiovoice,
                        // 'audio_url' => 'https://www.instaengineai.com/app/assets/uploads/users/5/testvoice.mp3',
                    ),
                ));
                $response = curl_exec($curl);
                // pr($response); die;
            
                if (curl_errno($curl)) {
                    echo 'Curl error: ' . curl_error($curl);
                } 
                
                curl_close($curl);
                return $response;
            }

            

// function for video editor 
    // public function addvideotoworkspace() {
    //     // pr($_POST); die;
    //       // Validate input data
    //         $list_id= $this->input->post('list_id');
    //         $name = $this->input->post('name');
    //         $business_id = $this->input->post('business_id');
    //         $url = $this->input->post('url');
            
    //         $this->db->select("*");
    //         $this->db->where('business_id', $business_id);
    //         $prompt_data = $this->db->get('user_render_videos')->result_array();
    //         $count = count($prompt_data);

    //         $this->db->select("*");
    //         $this->db->where('business_id', $this->business_id);
    //         $user_prompt_data = $this->db->get('user_render_videos')->row_array();
        
    //             if (empty($prompt_data)) {
    //                 $prompt_data = $user_prompt_data ;
    //                 $prompt_data['title'] = $name;               
    //                 //$prompt_data['status'] = $status;           
    //                 $prompt_data['business_id'] = $business_id; 
    //                 unset($prompt_data['id']); 
    //                 $this->db->insert('user_render_videos', $prompt_data);
    //                 $response = [
    //                     'status' => true,
    //                     'msg' => 'Video copied successfully'
    //                 ];
    //             } else {
    //                 $prompt_data = $user_prompt_data ;
    //                 $prompt_data['title'] = $name . ($count + 1);               
    //                 //$prompt_data['status'] = $status;           
    //                 $prompt_data['business_id'] = $business_id; 
    //                 unset($prompt_data['id']); 
    //                 $this->db->insert('user_render_videos', $prompt_data);
    //                 $response = [
    //                     'status' => true,
    //                     'msg' => 'Video copied successfully'
    //                 ];
    //             }
         
    //             // Return response
    //             echo json_encode($response);
    //             die;
    // }
    
    
    public function addvideotoworkspace() {
        // pr($_POST); die;
          // Validate input data
            $list_id= $this->input->post('list_id');
            $name = $this->input->post('name');
            $business_id = $this->input->post('business_id');
            $url = $this->input->post('url');
            
            $this->db->select("*");
            $this->db->where('user_id', $this->user_id);
            $this->db->where('business_id', $business_id);
            $prompt_data = $this->db->get('user_render_videos')->result_array();
            $count = count($prompt_data);

            $this->db->select("*");
            $this->db->where('id', $list_id);
            $user_prompt_data = $this->db->get('user_render_videos')->row_array();
        
                if (empty($prompt_data)) {
                    $prompt_data = $user_prompt_data ;
                    $prompt_data['title'] = $name;               
                    //$prompt_data['status'] = $status;           
                    $prompt_data['business_id'] = $business_id; 
                    unset($prompt_data['id']); 
                    $this->db->insert('user_render_videos', $prompt_data);
                    $response = [
                        'status' => true,
                        'msg' => 'Video copied successfully'
                    ];
                } else {
                    $prompt_data = $user_prompt_data ;
                    $prompt_data['title'] = $name . ($count + 1);               
                    //$prompt_data['status'] = $status;           
                    $prompt_data['business_id'] = $business_id; 
                    unset($prompt_data['id']); 
                    $this->db->insert('user_render_videos', $prompt_data);
                    $response = [
                        'status' => true,
                        'msg' => 'Video copied successfully'
                    ];
                }
         
                // Return response
                echo json_encode($response);
                die;
    }
    
    public function updateavatartitle()
        {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $this->db->where('id', $id);
            $update = $this->db->update('library', ['title' => $title]);
            if ($update) {
                echo json_encode([
                    'status' => true,
                    'message' => 'Title updated successfully.'
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'Failed to update title.'
                ]);
            }
            exit();
        }
        
        


        
        public function delete_avatar() {

            $id = $this->input->post('id');
        
            if (!$id) {
                echo json_encode(['status' => 0, 'msg' => 'Invalid ID']);
                return;
            }
        
            $result = $this->Videocreate_Remotion_Model->avatar_delete($id);
        
            if ($result) {
                echo json_encode(['status' => 2, 'msg' => 'Image deleted successfully.']);
            } else {
                echo json_encode(['status' => 1, 'mssg' => 'Failed to delete agent profile.']);
            }
        }



    


}
