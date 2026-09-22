<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');
require APPPATH . 'libraries/chat/autoload.php';
require_once APPPATH . 'libraries/vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;


class AppView_controller extends AppDefault {
	function __construct() {
		parent::__construct();
	
		$ss=$this->getBusinessId(); 
        $owner_id=$this->getUserFromString($ss);
        $business_id=$this->getBusinessIdFromString($ss); 
		$this->business_id = !empty($business_id) ? $business_id : '0';
		$this->owner_id = !empty($owner_id) ? $owner_id : '0'; 
		$this->getFeaturePlan($this->owner_id);
		
		$this->load->model('default/Cron_Model');
		$this->load->model('default/Videocreate_Remotion_Model');
		$this->load->model('default/Youtube_integration_model');
		$this->load->helper('tokengenerate'); 
		$this->spechify_key = $this->config->item('spechify_key');
        $this->python_api_key ='D684B8EFF387DBD9';
        $this->dupdub_api_key =$this->config->item('dupdub_api_key');
        $this->modelslab_video_key =$this->config->item('modelslab_video_key');
		$this->openaikey = $this->config->item('open_ai_key');
	}

    public function pwaInstall(){ 
        
		$this->loadView('autopostdata/pwa_install' , $data);
	}
	 public function pwaConversation(){
         
        $this->load->view('default/autopostdata/pwa_conversation');
	}
    function getBusinessId(){ 
        $host = $_SERVER['HTTP_HOST']; 
        $parts = explode('.', $host);
    
        if (count($parts) > 2) {
          //  return $parts[0];
            
            $this->db->select('*'); // or specific columns
            $this->db->from('business'); 
            $this->db->where('domain',$parts[0]);
            $query = $this->db->get();
            $result = $query->result();
            if(isset($result[0]->id) && $result[0]->id!=NULL){
                return $result[0]->id."|".$result[0]->user_id;
            }else{
                return '';
            }
        }
    
        return '';
    }
    
    function getBusinessIdFromString($str){
        if(isset($str) && $str!="" && $str!=NULL){
            $parts = explode('|', $str);
            return $parts[0]; // apple
        }else{
             return 0;
        }
    }
    function getUserFromString($str){
        if(isset($str) && $str!="" && $str!=NULL){
            $parts = explode('|', $str);
            return  $parts[1]; // apple
        }else{
            return 0;
        }
    }
     
    public function generatePost()  {

            $prompData = json_decode(file_get_contents('php://input'), true);
            // pr($prompData); die("ak"); 
            $keyword = $prompData['prompt'];
            $user_selection = isset($prompData['video_type']) ? strtolower(trim($prompData['video_type'])) : '';
            $openAISecretKey = $this->openaikey ;
            $open_ai = new OpenAi($openAISecretKey);

            $today_date = date("Y-m-d"); // Current date
            // $today_timestamp = strtotime("today");
            
           

            $prompt = "Today date is: ".$today_date." ".$keyword."
                Analyze the above text and extract the data in STRICT JSON format.
                
                 IMPORTANT Rules:
                    - If Instagram is mentioned → \"instagram\": \"Yes\", otherwise \"No\"
                    - If Facebook is mentioned → \"Facebook\": \"Yes\", otherwise \"No\"
                    - If YouTube is mentioned → \"Youtube\": \"Yes\", otherwise \"No\"
                    - If scheduling is mentioned → \"schedule\": \"Yes\", otherwise \"No\"
                    - If posting is mentioned → \"post\": \"Yes\", otherwise \"No\"
                
                Create Video (IMPORTANT):
                    - If text indicates ANY type of video content → \"Yes\" else \"No\"
                    - Consider words like: video, reel, reels, short, shorts, clip, story video, youtube video
                    - Also detect intent like: create, make, generate, post reel/short/video
                    - Example:
                      - 'create reel on marketing' → Yes
                      - 'post youtube short' → Yes
                      - 'make a video' → Yes
                    - If no video-related intent → \"No\"
                
                Term (IMPORTANT):
                - Extract the MAIN topic of the content/video
                - Topic is usually after words like 'on', 'about', 'for'
                - Example: 'video on Email Marketing' → \"Email Marketing\"
                - Return only the topic (no extra words)
                - If not found → \"\"
                
                Date & Time:
                - Use current date (".$today_date.")
                - Extract date & time
                - If only date → time = 10:00:00
                - Handle terms like tomorrow, next week
                - If past → shift to future
                - If missing → \"\"
                
                Gender:
                - Male/Female if mentioned else \"\"
                
                Return ONLY JSON
                
                Format:
                {
                  \"create_video\": \"Yes/No\",
                  \"Term\": \"\",
                  \"instagram\": \"Yes/No\",
                  \"Facebook\": \"Yes/No\",
                  \"Youtube\": \"Yes/No\",
                  \"schedule\": \"Yes/No\",
                  \"post\": \"Yes/No\",
                  \"date\": \"\",
                  \"time\": \"\",
                  \"gender\": \"Male/Female/\"
                }";
            
             
            $content = $this->getOpenAidata($prompt);
            $contentdata = str_replace("'", '"', $content);
            $postdata = json_decode($contentdata, true); 

            if (strtolower($postdata['create_video'] ?? '') == 'no') {
            // if ($video_type == 'chat') {
                
                $msgreply = $this->open_ai_chat($keyword);
                // echo '<pre>'; print_r($msgreply); die;
                if (!empty($msgreply)) {
                    echo json_encode([
                        "success" => true,
                        "status" => "chat_reply",
                        "message" => $msgreply
                    ]);
                    return;
                }
            }
            
            if (empty($user_selection)) {
                echo json_encode([
                    "success" => true,
                    "status" => "ask_type" // Frontend ko pata chalega ki buttons dikhane hain
                ]);
                return;
            }
            $video_type = $user_selection;
            if (empty($postdata['Term'])) {
                $postdata['Term'] = "motivational";
            }
            
            $errors = [];
            
            if (strtolower($postdata['instagram'] ?? '') == 'yes' || strtolower($postdata['Facebook'] ?? '') == 'yes'){
                    if (!in_array('insta_and_facebook_automation', $this->session->userdata('features'))) {
                        echo json_encode([
                            'success' => false,
                            'integration_required' => false,
                            'message' => 'Please upgrade your plan'
                        ]);
                        return;
                    }
                }
            
            if (strtolower($postdata['instagram'] ?? '') == 'yes') {
                $insta = $this->get_access_token('instagram_access_token');
                if (empty($insta)) {
                    $errors[] = "Instagram not connected";
                }
            }
            
            if (strtolower($postdata['Facebook'] ?? '') == 'yes') {
                $fb = $this->get_access_token('facebook_access_token');
                if (empty($fb)) {
                    $errors[] = "Facebook not connected";
                }
            }
            
            
            if (strtolower($postdata['Youtube'] ?? '') == 'yes' || strtolower($postdata['schedule'] ?? '') == 'yes' ) {
                    if (!in_array('youtube_automation', $this->session->userdata('features'))) {
                        echo json_encode([
                            'success' => false,
                            'integration_required' => false,
                            'message' => 'Please upgrade your plan'
                        ]);
                        return;
                    }
                }
            
            
            if (strtolower($postdata['Youtube'] ?? '') == 'yes') {
                $yt = $this->get_access_token('youtube_access_token');
                if (empty($yt)) {
                    $errors[] = "YouTube not connected";
                }
            }
            
            
            if (strtolower($postdata['Youtube'] ?? '') == 'yes' || strtolower($postdata['schedule'] ?? '') == 'yes' ) {
                    if (!in_array('youtube_automation', $this->session->userdata('features'))) {
                        echo json_encode([
                            'success' => false,
                            'integration_required' => false,
                            'message' => 'Please upgrade your plan'
                        ]);
                        return;
                    }
                }
            
            
            
            if (!empty($errors)) {
                echo json_encode([
                    "success" => false,
                    "integration_required" => true,
                    "message" => implode(', ', $errors),
                    "data" => $postdata
                ]);
                return;
            }
            
            
            if (strtolower($postdata['Youtube'] ?? '') == 'yes' || strtolower($postdata['schedule'] ?? '') == 'yes' ) {
                if (!in_array('youtube_automation', $this->session->userdata('features'))) {
                        echo json_encode([
                            'success' => true,
                            'message' => "Your Avatar talking video is currently in progress",
                            'insert_id' => $insert_id,
                            'loading' => true
                        ]);
                        return;
                    
                    return;
                }
            }
           
            $scheduleData = $this->getScheduleData($postdata['date'] ?? '', $postdata['time'] ?? '');
            $timestamp = $scheduleData['timestamp'];
            
            if ($video_type == 'ai') {
                
                $refine_prompt = "Convert this user concept: \"" . $keyword . "\" into a highly descriptive, visually clear, and detailed scene prompt for an AI Text-to-Video engine. 
                    Focus on setting layout, lighting, characters action, and cinematic fidelity. 
                    Avoid generic marketing buzzwords. Keep the total output concise within 200-300 characters max, optimized for video generation models.
                    Return ONLY the final rewritten text description prompt:";
        
                $optimized_modelslab_prompt = $this->generateOpenAidata($refine_prompt);
                
                // Safety Fallback check agar OpenAI layer response block blank ho jaye
                if (empty($optimized_modelslab_prompt)) {
                    $optimized_modelslab_prompt = $keyword;
                }

                $result = $this->generate_video_id($optimized_modelslab_prompt); 
            
                if (empty($result['id'])) {
            
                    echo json_encode([
                        "success" => false,
                        "message" => "AI Video generation failed"
                    ]);
                    return;
                }
            
                $video_id = $result['id'];
            
                // $scheduleData = $this->getScheduleData(
                //     $postdata['date'] ?? '',
                //     $postdata['time'] ?? ''
                // );
              
                // $timestamp = $scheduleData['timestamp']; 
                $data = [
                    "user_id"        => $this->owner_id,
                    "business_id"    => $this->business_id,
                    "keyword"        => $postdata['Term'],
                    "video_id"       => $video_id,
                    "video_type"     => "ai",
                    "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
                    "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
                    "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
                    "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
                    "schedule_time"  => $timestamp
                ];
            
                $this->db->insert('auto_post', $data);
            
                $insert_id = $this->db->insert_id();
                
                 if (!empty($insert_id)) {
                    echo json_encode([
                        'success' => true,
                        'status' => 'video_started',
                        'message' => "AI Video generation started successfully!",
                        'insert_id' => $insert_id,
                        'loading' => true
                    ]);
                    return;
                }
            
                // echo json_encode([
                //     "success" => true,
                //     "loading" => true,
                //     "insert_id" => $insert_id,
                //     "message" => "AI Video generation started"
                // ]);
            
                // return;
            }
            if ($video_type == 'avatar') {
                $scriptkeyword =  $postdata['Term'];
                $scriptprompt = "Write a clear and engaging voice-over script about ".$scriptkeyword.". The total length should be around 400�500 characters. The script should start with a strong hook, briefly explain the key idea, and end with a simple takeaway or call to action.";
                // pr($scriptprompt); die("ak");
                $voice_script = $this->generateOpenAidata($scriptprompt);
                
                /*-----------1 to 5 male video_url & 5 to 10 female video_url --------*/
                
                // $cdn_url = $this->config->item('cdn_url');
                $cdn_url = 'https://cdn.socialclawai.com/';
                
                /*--------For video Avatar using python API--------*/
                
                // $videos = [
                //     $cdn_url . "assets/uploads/avatar/talking_video/Military_Soldier_Mike.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Smart_Advisor_Malik.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Success_Mentor_Dana.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Finance_Expert_Max.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Business_Adviser_Ethan.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Science_Host_Georgia.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Lifestyle_Presenter_Sofia.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Health_Coach_Jenna.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Wellness_Host.mp4",
                //     $cdn_url . "assets/uploads/avatar/talking_video/Podcast_Host_Hana.mp4"
                // ];
                
                /*--------For Photo Avatar using Dup-Dub API--------*/
                $images = [
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar1.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar5.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar11.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar7.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar10.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar13.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar14.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar15.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar16.png',
                    $cdn_url.'assets/uploads/avatar/talking_photo/newavatar17.png',
                ];
                
                /*-----------1 to 5 male voice_id & 5 to 10 female voice_id --------*/
                $voices = [
                    "henry","oliver","joe", "george","rob","carly","kristy","tasha", "lisa","emily"
                ];
                
                // gender input
                $gender = strtolower(trim($postdata['gender'] ?? ''));
    
                if ($gender === "male") {
                    $index = rand(0, 4);
                } elseif ($gender === "female") {
                    $index = rand(5, 9);
                } else {
                    $index = rand(0, 9);
                }
                
                // SAME INDEX se dono 
                // $video_url = $videos[$index];
                $imagePath = $images[$index];
                $voice_id  = $voices[$index];
                // pr($voice_id); die("ak");
                
                $audiovoice = $this->generateSpeechifyAudio($voice_script, $voice_id);
                
                if (empty($audiovoice)) {
                    $response['success'] = false;
                    $response['message'] = "audio not generated ";
                    echo json_encode($response);
                    return $response;
                }
                /*--------For video Avatar using python API--------*/
                
                    // $result = $this->videoGenerator($video_url, $audiovoice); 
                    // $dataDecoded = json_decode($result, true);
                    // $video_id = $dataDecoded['id'];
                    
                /*--------For video Avatar using python API close--------*/
                
                $result = $this->generateDupDubAavatar($imagePath, $audiovoice);
                
                $video_id = $result['id'];
    
                if (empty($video_id)) {
                    echo json_encode(['success' => false, 'message' => "Some Error occurred"]);
                    return;
                }else{
                   
                    $data = [
                        "user_id"        => $this->owner_id,
                        "business_id"    => $this->business_id,
                        "keyword"        => $postdata['Term'],
                        "video_id"       => $video_id,
                        "video_type"     => "avatar",
                        "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
                        "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
                        "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
                        "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
                        "schedule_time"  => $timestamp
                    ];
                    $this->db->insert('auto_post', $data);
                    $insert_id = $this->db->insert_id();
    
                    if (!empty($insert_id)) {
                        echo json_encode([
                            'success' => true,
                            'status' => 'video_started',
                            'message' => "Your Avatar talking video is currently in progress",
                            'insert_id' => $insert_id,
                            'loading' => true
                        ]);
                        return;
                    }
                }
            }
            
    	  }
    	  
    	  
    	  public function getFeaturePlan($user_id){
    	      	
        		$owner_id = $user_id;
        
        		$this->db->select("user_package,add_time");
        	
        		$this->db->where('id', $owner_id);
        
        		$query = $this->db->get('tbl_user');
        		$result = $query->row_array();
        		$user_package = json_decode($result["user_package"],1);
        		
        		if(isset($user_package['add_time'])){
        			$buy_date = $user_package['add_time'];
        			$exp_date = strtotime('+14 days', $user_package['add_time']);
        			$cur_date = time();
        			
        			if($cur_date >= $exp_date){
        			
        			}
        		}
        
        		if(!isset($user_package['fields'])){
        			$user_package['fields']['business_count']['value'] = 'zero';
        			$user_package['fields']['team_count']['value'] = 'zero';
        			$user_package['fields']['product_count']['value'] = 'zero';
        			$user_package['fields']['funnel_count']['value'] = 'zero';
        			$user_package['fields']['fb_share_count']['value'] = 'zero';
        		}
        		if(!isset($user_package['features'])){
        			$user_package['features']=array();
        		}
        	
        		 $this->session->set_userdata('features', $user_package['features']);
        		return $user_package;
    	  }
    	  
        public function generateSpeechifyAudio($avatar_script,$voiceId) 
        {
    	    $directoryPath =  'assets/uploads/users/' . $this->user_id;
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
            
            $apiBaseUrl = "https://api.sws.speechify.com/v1/audio/speech";
            $apiKey = $this->spechify_key; 
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
                // echo '<pre>';  print_r($data ); die;
                if (isset($data['audio_data'])) {
                    $audioFile = $data['audio_data'];
                    $audioFormat = 'wav'; 
                    $decodedAudio = base64_decode($audioFile);
                    $fileName_final = 'audio_' . time() . '.' . $audioFormat;
                
                 
                    $filePath = $directoryPath . '/' . $fileName_final;
                    file_put_contents($filePath, $decodedAudio);
                    $uploadPath = 'assets/uploads/users/' . $this->user_id . '/' . $fileName_final;
                    uploadAwsfile($uploadPath);
                    $audiovoice = $this->config->item('bucket_url') . $uploadPath;
                    // pr($audiovoice); die("ak");
                    return $audiovoice;
              }
        	    
        	}
        
        
    	public function videoGenerator($video_url, $audiovoice) {
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
                ),
            ));
            $response = curl_exec($curl);
            // pr($response); die('here');
        
            if (curl_errno($curl)) {
                echo 'Curl error: ' . curl_error($curl);
            } 
            
            curl_close($curl);
            return $response;
        }
        
        
        public function get_video_id()
        {   
            sleep(2); 
            $this->db->where('user_id', 	$this->owner_id);
            $this->db->where('business_id', 	$this->business_id);
            $this->db->where('video_id IS NOT NULL', null, false);
            $this->db->where('video_id !=', '');            
            $query = $this->db->get('auto_post');
            
            $data = $query->row();
            // pr($data); die();
            if(!empty($data)){
                 $response = [
                    'status' => true,
                    'data'   => $data
                ];
                echo json_encode($response);
                }
            
           
        }
        
	   public function getCompeleteVideobyid()
        {  
         
            
            
            $videodata = json_decode(file_get_contents('php://input'), true);
            $id = $videodata['id'];
            $video_id = $videodata['video_id'];
            $avatar_type = "video";
           
            $this->db->where('id', $id);
            $query = $this->db->get('auto_post');
            $autodata = $query->row();
            $get_video_id = $autodata->video_id;
           
           
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
                     if ($autodata->video_type == 'ai') {

                        // ModelsLab Video
                        $video_url = $this->fetch_video($video_id);

                        if (empty($video_url)) {
                    
                            echo json_encode([
                                'status' => false,
                                'processing' => true,
                                'message' => 'Video still processing'
                            ]);
                            return;
                        }
                
                    } else {
                
                        // DupDub Avatar Video
                        $video_url = $this->fetchDupDubVideoAndSave($video_id);
                
                        if (empty($video_url)) {
                            echo json_encode([
                                'status' => false,
                                'processing' => true,
                                'message' => 'Avatar still processing'
                            ]);
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
                 if (!empty($url)) {
                        $this->db->where('business_id', 	$this->business_id);
                        $this->db->where('id', $id);
                        $this->db->update('auto_post', ['video_id' => NULL , 'video_url'=>$url]);
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
                echo json_encode($response);
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
            
            
        public function generateDupDubAavatar($imagePath, $audiovoice)
        { 
            $api_key = $this->dupdub_api_key; 
            $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/detectAvatar";  
        
            $data = [
                "photoUrl" => $imagePath
            ]; 
        
            $headers = [
                "dupdub_token: $api_key",
                "Content-Type: application/json"
            ]; 
        
            $ch1 = curl_init(); 
            curl_setopt($ch1, CURLOPT_URL, $url);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_POST, true);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers); 
        
            $response = curl_exec($ch1); 
                    //   pr($response); die("ak");
        
            if ($response === false) {
                curl_close($ch1);
                return ['success' => false, 'message' => "cURL Error: " . curl_error($ch1)];
            }
        
            $responseBoxJson = json_decode($response, true); 
        
            if (isset($responseBoxJson['code']) && $responseBoxJson['code'] == 200) {
        
                $boxes = $responseBoxJson['data']['boxes'] ?? null; 
        
                if (!$boxes) {
                    curl_close($ch1);
                    return ['success' => false, 'message' => "No boxes detected"];
                }
        
                $boxessize = [
                    $boxes[0][0],
                    $boxes[0][1],
                    $boxes[0][2],
                    $boxes[0][3]
                ];
        
                curl_close($ch1); 
        
                // Create Avatar Project
                $ch = curl_init();
                $url = "https://moyin-gateway.dupdub.com/tts/v1/photoProject/createMulti";  
        
                $data = [
                    "photoUrl" => $imagePath,
                    "info" => [
                        [
                            "audioUrl" => $audiovoice,
                            "box" => $boxessize
                        ]
                    ],
                    "watermark" => 0,
                    "useSr" => false
                ];  
        
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        
                $response = curl_exec($ch);  
        
                if ($response === false) {
                    curl_close($ch);
                    return ['success' => false, 'message' => curl_error($ch)];
                }
        
                $responseData = json_decode($response, true); 
        
                if (isset($responseData['code']) && $responseData['code'] == 200) { 
                    $id = $responseData['data']['id'];
                    curl_close($ch);  
        
                    // ✅ Sirf ID return
                    return ['success' => true, 'id' => $id];
                } else {
                    curl_close($ch); 
                    return ['success' => false, 'message' => "Project create failed"];
                }
        
            } else {
                curl_close($ch1);
                return ['success' => false, 'message' => "Face detect failed"];
            }
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
                    return false;
                }
            }
            
            
       public function socialmedia_post()
        {   
   
            $id = $this->input->post('id');
            $keyword = $this->input->post('keyword');
            $instagram = $this->input->post('instagram');
            $facebook = $this->input->post('facebook');
            $youtube = $this->input->post('youtube');
            $video_id = $this->input->post('video_id');
            $url = $this->input->post('video_url');
            $schedule = $this->input->post('schedule');
            $scheduletime = $this->input->post('schedule_time');

            
            // $keyword = "digital marketing";
            // $instagram = 0;
            // $facebook = 0;
            // $youtube = 1;
            // $video_id = "43c5b26b";
            // $url = "https://cdn.socipilotai.com/assets/uploads/users/1/generated_1775466762_1940.mp4";
            // $schedule = 0;
            // $scheduletime = 1800000000;
        
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
    	
     
    /*------function for reel upload  on Instagram-----*/
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
        // pr($this->db->last_query()); die('in');
                return [
                    "success" => !empty($insert_id),
                    "msg" => !empty($insert_id) ? 'video schedule successfull' : 'Something went wrong',
                    "publish_id" => $insert_id
                ];
            }
        // die('out');
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
                    'user_id'     => $this->owner_id,
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
        
        public function publish_reel($ig_user_id, $container_id, $access_token)
        {

            $url = "https://graph.facebook.com/v19.0/{$ig_user_id}/media_publish";
        
            $postData = [
                'creation_id'  => $container_id,
                'access_token' => $access_token
            ];
        
            return $this->curl_post($url, $postData);
        }
        
    /*------function for reel upload  on facebook-----*/    
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
                    'user_id'     => $this->owner_id,
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
         

            public function insertYoutubePublisher($keyword, $url, $caption, $schedule, $scheduletime)
            {
                $video_url = $url;
                $status = 1;
                $update_id = null;
            
                $data = array(
                    'user_id'            => $this->owner_id,
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
    		$this->Youtube_integration_model->update_yt_access_token($this->owner_id,$this->business_id,$yt_data);
    	}
    	
    	public function get_new_access_token()
    	{
            $this->db->select('*'); // or specific columns
            $this->db->from('youtube_access_token'); 
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
    
        public function get_client_data()
        {
    		$this->db->select('*'); // or specific columns
            $this->db->from('youtube_access_token');
            $this->db->where('user_id',$this->owner_id);
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

    	
    /*------Video upload  on Youtube close-----*/
	
	    public function getScheduleData($date, $time)
        {
            if (empty($date) || empty($time)) {
                return [
                    'timestamp' => 0,
                    'delay' => 0
                ];
            }
        
            $datetime = $date . ' ' . $time;
            $timestamp = strtotime($datetime);
        
            // current time
            $now = time();
        
            // delay in seconds
            $delay = $timestamp - $now;
        
            // safety (past na ho)
            if ($delay < 0) {
                $delay = 0;
                $timestamp = $now;
            }
        
            return [
                'timestamp' => $timestamp,
                'delay' => $delay
            ];
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


        public function getOpenAidata($prompt)
        {
    		$open_ai = new OpenAi($this->openaikey);
    		$history[] = ["role" => "user", "content" => $prompt];
    
    		$opt = [
    			"model" => "gpt-5-mini",
    			"messages" => $history,
    			"temperature" => 1,
    			"max_completion_tokens" => 1000,
    		];
    
    		$response = $open_ai->chat($opt);
    		$data = json_decode($response, true);

    		return $data["choices"][0]["message"]["content"];
    		
    	}
    	
    	
    	public function generateOpenAidata($prompt)
        {
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
    
    		return $data["choices"][0]["message"]["content"];
    		
    	}
    	
        public function get_access_token($table_name)
        {
            $this->db->where('user_id', $this->owner_id);
            $this->db->where('business_id', $this->business_id);
            $query = $this->db->get($table_name);
        
            return $query->row();
        }
        
        public function open_ai_chat($userMessage)
        {
            $apiKey = $this->openaikey;
        
            $postData = [
                "model" => "gpt-4.1-mini",
                "messages" => [
                    ["role" => "system", "content" => "You are a helpful assistant."],
                    ["role" => "user", "content" => $userMessage]
                ],
                "temperature" => 0.7,
                "max_tokens" => 1000
            ];
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
        
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer " . $apiKey
            ]);
        
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        
            $response = curl_exec($ch);
        
            if (curl_errno($ch)) {
                curl_close($ch);
                return "";
            }
        
            curl_close($ch);
        
            $result = json_decode($response, true);
        
            return $result['choices'][0]['message']['content'] ?? "";
        }
        
        public function analyz(){
    		$this->loadView('youtubetools/analyz' , $data);
	    }
	    
	    
	   public function generate_video_id($prompt)
        {
            $api_key = $this->modelslab_video_key;
 
            // $url = "https://modelslab.com/api/v7/video-fusion/text-to-video";
            $url = "https://modelslab.com/api/v6/video/text2video_ultra";
 
            $payload = json_encode([
                "prompt" => $prompt,
                "duration" => "10",
                "aspect_ratio" => "9:16",
                "model_id" => "ltx-2.3",
                "watermark" => false,
                "key" => $api_key
            ]);
 
            $curl = curl_init();
 
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ]
            ]);
 
            $response = curl_exec($curl);
 
            if (curl_errno($curl)) {
                return ['status' => false, 'error' => curl_error($curl)];
            }
 
            curl_close($curl);
 
            return json_decode($response, true);
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
                return false;
                }
                
                
                 
                
                public function getAvatarVideoHistory()
                {
                    // Added 'title' if exists, or you can manage it with keyword
                    $this->db->select('id, user_id, business_id, keyword, video_url, video_type');
                    $this->db->where('user_id', $this->owner_id);
                    $this->db->where('business_id', $this->business_id);
                    $this->db->where('video_type', 'avatar');
                    $this->db->where('video_url !=', '');
                    $this->db->order_by('id', 'DESC');
                    $query = $this->db->get('auto_post');
                    $historyData = $query->result_array();
                
                    foreach ($historyData as &$video) {
                        $this->db->select('thumbnail, title, created'); // added extra metadata fields if matching
                        $this->db->where('url', $video['video_url']);
                        $this->db->where('video_status', 'heygen');
                        $libQuery = $this->db->get('library');
                        $libRow = $libQuery->row();
                
                        $video['thumbnail'] = (!empty($libRow) && !empty($libRow->thumbnail)) ? $libRow->thumbnail : '';
                        // Agar library table me asli custom title h to vo utha lo varna keyword use hoga
                        $video['title'] = (!empty($libRow) && !empty($libRow->title)) ? $libRow->title : $video['keyword'];
                        $video['created'] = (!empty($libRow) && !empty($libRow->created)) ? $libRow->created : '';
                    }
                
                    echo json_encode([
                        'status' => true,
                        'data' => $historyData
                    ]);
                    exit();
                }
                
            public function getUserData(){  
                $query = $this->db->get('tbl_user');
                $data = $query->result_array(); 
        		$this->loadView('autopostdata/user_data' , $data);
        	}   
}
?>