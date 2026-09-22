
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Youtube_Controller extends AppDefault {

	public function __construct() {
		parent::__construct();
		$this->checkAlreadyLogout();
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
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
    $this->loadView('yt_integration/ytvideo_optimization');
   }
	
	 public function ai_video_genration()
   {
    $this->loadView('yt_integration/ai_video_genration');
   }
   
    public function ai_video_process()
    {        
        $input = json_decode(file_get_contents('php://input'), true);
    
        $video_type = isset($input['video_type']) ? $input['video_type'] : null;
    
        if ($video_type == 'ai') {
    
            $prompt = isset($input['prompt']) ? trim($input['prompt']) : '';
    
            if ($prompt == '') {
                echo json_encode(['status' => false, 'message' => 'Prompt is required.']);
                return;
            }
    
            $data = [
                'user_id'    => $this->session->userdata('user_id'),
                'video_type' => 'ai',
                'prompt'     => $prompt,
                'status'     => 'processing',
                'created_on' => date('Y-m-d H:i:s')
            ];
    
        } elseif ($video_type == 'avatar') {
    
            $avatar_name = isset($input['avatar_name']) ? trim($input['avatar_name']) : '';
            $script      = isset($input['script']) ? trim($input['script']) : '';
            $avatar_id   = isset($input['avatar_id']) ? $input['avatar_id'] : null;
            $voice_id    = isset($input['voice_id']) ? $input['voice_id'] : null;
            $voice_url   = isset($input['voice_url']) ? $input['voice_url'] : null;
    
            if ($script == '') {
                echo json_encode(['status' => false, 'message' => 'Script is required.']);
                return;
            }
            if (!$avatar_id) {
                echo json_encode(['status' => false, 'message' => 'Please select an avatar photo.']);
                return;
            }
            if (!$voice_id) {
                echo json_encode(['status' => false, 'message' => 'Please select a voice.']);
                return;
            }
    
            $data = [
                'user_id'     => $this->owner_id,
                'business_id'  =>$this->business_id,
                'video_type'  => 'avatar',
                'avatar_name' => $avatar_name,
                'script'      => $script,
                'video_url'   => "https://kunj.viewagentai.com/ai-video-genration/3273163ewqeqe",
                'avatar_id'   => $avatar_id,
                'voice_id'    => $voice_id,
                'voice_url'   => $voice_url,
                'status'      => 'processing',
                'created_on'  => date('Y-m-d H:i:s')
            ];
            
            // pr($data);
            // die();
            
    
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid video type.']);
            return;
        }
        
            try {
                $job_id = $this->Youtube_integration_model->insertVideoJob($data);
            } catch (Exception $e) {
                echo json_encode(['status' => false, 'message' => 'DB error: ' . $e->getMessage()]);
                return;
            }
    
        if ($job_id) {
            echo json_encode([
                'status'  => true,
                'message' => 'Video generation started.',
                'job_id'  => $job_id
            ]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Could not start video generation.']);
        }
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
        
    public function generatePost()
     {
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
                - If missing → date = next day from current date

                
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
            
            
            // $prompt = "Today date is: ".$today_date." ".$keyword."
            //     Analyze the above text and extract the data in STRICT JSON format.
                
            //     IMPORTANT Rules:
            //         - If Instagram is mentioned → \"instagram\": \"Yes\", otherwise \"No\"
            //         - If Facebook is mentioned → \"Facebook\": \"Yes\", otherwise \"No\"
            //         - If YouTube is mentioned → \"Youtube\": \"Yes\", otherwise \"No\"
            //         - If scheduling is mentioned → \"schedule\": \"Yes\", otherwise \"No\"
            //         - If posting is mentioned → \"post\": \"Yes\", otherwise \"No\"
                
            //     Create Video (IMPORTANT):
            //         - If text indicates ANY type of video content → \"Yes\" else \"No\"
            //         - Consider words like: video, reel, reels, short, shorts, clip, story video, youtube video
            //         - Also detect intent like: create, make, generate, post reel/short/video
            //         - Example:
            //           - 'create reel on marketing' → Yes
            //           - 'post youtube short' → Yes
            //           - 'make a video' → Yes
            //         - If no video-related intent → \"No\"
                
            //     AI Video Detection (IMPORTANT):
                
            //     Determine the value of:
            //         \"video_type\": \"avatar\" or \"ai\"
                
            //     Set \"video_type\": \"ai\" if the user is asking for:
            //         - A scene or cinematic video
            //         - Animation
            //         - Cartoon video
            //         - Movie style video
            //         - Story based video
            //         - Animal video
            //         - Robot video
            //         - Landscape video
            //         - Fantasy video
            //         - Flying objects
            //         - Action sequences
            //         - Visual effects based videos
            //         - Any generated visual scene where no talking presenter/avatar is required
                
            //     Examples:
            //         - 'create a video of lion running' → ai
            //         - 'flying doremon video' → ai
            //         - 'robot dancing in city' → ai
            //         - 'cinematic sunset beach video' → ai
            //         - 'animated story about a dragon' → ai
            //         - 'space ship flying through galaxy' → ai
                
            //     Set \"video_type\": \"avatar\" if the user is asking for:
            //         - Talking avatar
            //         - Human presenter
            //         - Male or female spokesperson
            //         - AI host
            //         - News presenter
            //         - Educational presenter
            //         - Marketing presenter
            //         - Motivational speaker
                
            //     Examples:
            //         - 'motivational avatar video' → avatar
            //         - 'male avatar talking about marketing' → avatar
            //         - 'female presenter explaining SEO' → avatar
            //         - 'AI spokesperson for business tips' → avatar
                
            //     Default:
            //         - If create_video = Yes and type is unclear → avatar
                    
            //     CRITICAL RULE:

            //         If the text is describing a character, object, animal,
            //         robot, cartoon, scene, environment, story, creature,
            //         vehicle, fantasy subject, visual appearance or image concept,
            //         then:
                    
            //         'create_video': 'Yes'
            //         'video_type': 'ai'
                    
            //         Examples:
                    
            //         'A cute blue robotic cat with a round face'
            //         => create_video = Yes
            //         => video_type = ai
                    
            //         'Red sports car drifting on highway'
            //         => create_video = Yes
            //         => video_type = ai
                    
            //         'Flying dragon over mountains'
            //         => create_video = Yes
            //         => video_type = ai
                    
            //         Only return create_video = No when the user is clearly
            //         asking a question, chatting, requesting information,
            //         or having a normal conversation.
                    
            //         Examples:
                    
            //         'hey'
            //         => create_video = No
                    
            //         'what is email marketing'
            //         => create_video = No
                    
            //         'tell me about SEO'
            //         => create_video = No
                
            //     Term (IMPORTANT):
            //         - Extract the MAIN topic of the content/video
            //         - Topic is usually after words like 'on', 'about', 'for'
            //         - Example: 'video on Email Marketing' → \"Email Marketing\"
            //         - Return only the topic (no extra words)
            //         - If not found → \"\"
                
            //     Date & Time:
            //         - Use current date (".$today_date.")
            //         - Extract date & time
            //         - If only date → time = 10:00:00
            //         - Handle terms like tomorrow, next week
            //         - If past → shift to future
            //         - If missing → \"\"
                
            //     Gender:
            //         - Male/Female if mentioned else \"\"
                
            //     Return ONLY JSON
                
            //     Format:
            //     {
            //       \"create_video\": \"Yes/No\",
            //       \"video_type\": \"avatar/ai\",
            //       \"Term\": \"\",
            //       \"instagram\": \"Yes/No\",
            //       \"Facebook\": \"Yes/No\",
            //       \"Youtube\": \"Yes/No\",
            //       \"schedule\": \"Yes/No\",
            //       \"post\": \"Yes/No\",
            //       \"date\": \"\",
            //       \"time\": \"\",
            //       \"gender\": \"Male/Female/\"
            //     }";

            $content = $this->getOpenAidata($prompt);
            $contentdata = str_replace("'", '"', $content);
            $postdata = json_decode($contentdata, true);
            // $video_type = strtolower(trim($postdata['video_type'] ?? 'chat'));

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
    	
    	
    	
    	
	
}