 <?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class AutoPost_Controller extends AppDefault {

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
        $this->modelslab_video_key =$this->config->item('modelslab_video_api_key');
		$this->openaikey = $this->config->item('open_ai_key');
        
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);

	}
	
	//meghna
	
	public function getTelegramIntegration()
{
    $business_id = $this->business_id;

    $telegram = $this->db
        ->where('business_id', $business_id)
        ->where('channel_id', 2)
        ->get('openclaw_agents_channel_intregation')
        ->row();

    if (!empty($telegram)) {

        echo json_encode([
            'success' => true,
            'data' => [
                'bot_token'     => $telegram->channel_token,
                'is_connected'  => true
            ]
        ]);

    } else {

        echo json_encode([
            'success' => false,
            'data' => [
                'bot_token'     => '',
                'is_connected'  => false
            ]
        ]);
    }
}

    
    public function postGenerator()
   {
    $data['prompt'] = $this->session->flashdata('prompt');
    $data['user_id'] = $this->owner_id;
    $data['business_id'] = $this->business_id;

    // Telegram Token Fetch
    // $telegram = $this->db
    //     ->where('business_id', $this->business_id)
    //     ->where('channel_id', 2)
    //     ->get('openclaw_agents_channel_intregation')
    //     ->row();

    // $data['telegram_token'] = !empty($telegram) ? $telegram->channel_token : '';

    $this->loadView('autopostdata/post_generator', $data);
   }


    	 public function pwaInstall(){
            // $data['prompt'] = $this->session->flashdata('prompt');
            // $data['user_id'] = $this->owner_id;
            // $data['business_id'] = $this->business_id;
    		$this->loadView('autopostdata/pwa_install' , $data);
    	}
    	 public function pwaConversation(){
            // $data['prompt'] = $this->session->flashdata('prompt');
            // $data['user_id'] = $this->owner_id;
            // $data['business_id'] = $this->business_id;
    		// $this->loadView('autopostdata/pwa_conversation' , $data);
            $this->load->view('default/autopostdata/pwa_conversation');
    	}
    	
    	public function getAiAvatarVideo(){ 
    	    
    	
    	  if (!in_array('ai_video', $this->session->userdata('features'))) {
                $output['error']['type'] = 'flash';
                $output['error']['message'] = 'Please upgrade your plan';
                $this->session->set_flashdata('message', json_encode($output));
                redirect('subscription');
            }
    	  
            
            // Last 30 days AI video count
            $thirtyDaysAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
            
            $aiVideoCount = $this->db
                ->where('business_id', $this->business_id)
                ->where('video_type', 'ai')
                ->where('created_at >=', $thirtyDaysAgo)
                ->count_all_results('auto_post');
            
            //  if($this->user_id != 347){
            //         if ($aiVideoCount >= 20) {
            //             $output['error']['type'] = 'flash';
            //             $output['error']['message'] = 'You have reached your monthly limit of 20 AI videos.';
            //             $this->session->set_flashdata('message', json_encode($output));
            //             redirect('subscription');
            //         }
            //      }
            $data['prompt'] = $this->session->flashdata('prompt');
            $data['user_id'] = $this->owner_id;
            $data['business_id'] = $this->business_id;
            
            $this->team_edit_video = true; 
            $this->team_create_video = true;
        
            if ($this->user_id != $this->owner_id) {
                if (!in_array('edit_video', $this->all_team_privileges)) {
                    $this->team_edit_video = false;
                }
                if (!in_array('create_video', $this->all_team_privileges)) {
                    $this->team_create_video = false;
                }
            }
        
            $data['team_edit_video'] = $this->team_edit_video;
            $data['team_create_video'] = $this->team_create_video;
            $data['permission_msg'] = $this->permission_msg;
            $this->loadView("avtar/ai_video_generator" ,$data);
    }
    	
    	
        public function sendpromt(){
            $prompt = $this->input->post('prompt');
            $this->session->set_flashdata('prompt', $prompt);
            redirect('post-generator');
        }
    	
    	
    
        public function smartGenerator(){
    		$this->loadView('autopostdata/smart_generator');
    	}
    	
    // 	public function generatePost()
    // 	  {
    //         $prompData = json_decode(file_get_contents('php://input'), true);
    //         // pr($prompData); die("ak"); 
    //         $openAISecretKey = $this->openaikey ;
    //         $keyword = $prompData['prompt'];
    //         $open_ai = new OpenAi($openAISecretKey);

    //         $today_date = date("Y-m-d"); // Current date
    //         $today_timestamp = strtotime("today");

    //         // $prompt = "Today date is: ".$today_date." ".$keyword."
    //         //     Analyze the above text and extract the data in STRICT JSON format.
                
    //         //      IMPORTANT Rules:
    //         //         - If Instagram is mentioned → \"instagram\": \"Yes\", otherwise \"No\"
    //         //         - If Facebook is mentioned → \"Facebook\": \"Yes\", otherwise \"No\"
    //         //         - If YouTube is mentioned → \"Youtube\": \"Yes\", otherwise \"No\"
    //         //         - If scheduling is mentioned → \"schedule\": \"Yes\", otherwise \"No\"
    //         //         - If posting is mentioned → \"post\": \"Yes\", otherwise \"No\"
                
    //         //     Create Video (IMPORTANT):
    //         //         - If text indicates ANY type of video content → \"Yes\" else \"No\"
    //         //         - Consider words like: video, reel, reels, short, shorts, clip, story video, youtube video
    //         //         - Also detect intent like: create, make, generate, post reel/short/video
    //         //         - Example:
    //         //           - 'create reel on marketing' → Yes
    //         //           - 'post youtube short' → Yes
    //         //           - 'make a video' → Yes
    //         //         - If no video-related intent → \"No\"
                
    //         //     Term (IMPORTANT):
    //         //     - Extract the MAIN topic of the content/video
    //         //     - Topic is usually after words like 'on', 'about', 'for'
    //         //     - Example: 'video on Email Marketing' → \"Email Marketing\"
    //         //     - Return only the topic (no extra words)
    //         //     - If not found → \"\"
                
    //         //     Date & Time:
    //         //     - Use current date (".$today_date.")
    //         //     - Extract date & time
    //         //     - If only date → time = 10:00:00
    //         //     - Handle terms like tomorrow, next week
    //         //     - If past → shift to future
    //         //     - If missing → \"\"
                
    //         //     Gender:
    //         //     - Male/Female if mentioned else \"\"
                
    //         //     Return ONLY JSON
                
    //         //     Format:
    //         //     {
    //         //       \"create_video\": \"Yes/No\",
    //         //       \"Term\": \"\",
    //         //       \"instagram\": \"Yes/No\",
    //         //       \"Facebook\": \"Yes/No\",
    //         //       \"Youtube\": \"Yes/No\",
    //         //       \"schedule\": \"Yes/No\",
    //         //       \"post\": \"Yes/No\",
    //         //       \"date\": \"\",
    //         //       \"time\": \"\",
    //         //       \"gender\": \"Male/Female/\"
    //         //     }";
            
            
    //         $prompt = "Today date is: ".$today_date." ".$keyword."
    //             Analyze the above text and extract the data in STRICT JSON format.
                
    //             IMPORTANT Rules:
    //                 - If Instagram is mentioned → \"instagram\": \"Yes\", otherwise \"No\"
    //                 - If Facebook is mentioned → \"Facebook\": \"Yes\", otherwise \"No\"
    //                 - If YouTube is mentioned → \"Youtube\": \"Yes\", otherwise \"No\"
    //                 - If scheduling is mentioned → \"schedule\": \"Yes\", otherwise \"No\"
    //                 - If posting is mentioned → \"post\": \"Yes\", otherwise \"No\"
                
    //             Create Video (IMPORTANT):
    //                 - If text indicates ANY type of video content → \"Yes\" else \"No\"
    //                 - Consider words like: video, reel, reels, short, shorts, clip, story video, youtube video
    //                 - Also detect intent like: create, make, generate, post reel/short/video
    //                 - Example:
    //                   - 'create reel on marketing' → Yes
    //                   - 'post youtube short' → Yes
    //                   - 'make a video' → Yes
    //                 - If no video-related intent → \"No\"
                
    //             AI Video Detection (IMPORTANT):
                
    //             Determine the value of:
    //                 \"video_type\": \"avatar\" or \"ai\"
                
    //             Set \"video_type\": \"ai\" if the user is asking for:
    //                 - A scene or cinematic video
    //                 - Animation
    //                 - Cartoon video
    //                 - Movie style video
    //                 - Story based video
    //                 - Animal video
    //                 - Robot video
    //                 - Landscape video
    //                 - Fantasy video
    //                 - Flying objects
    //                 - Action sequences
    //                 - Visual effects based videos
    //                 - Any generated visual scene where no talking presenter/avatar is required
                
    //             Examples:
    //                 - 'create a video of lion running' → ai
    //                 - 'flying doremon video' → ai
    //                 - 'robot dancing in city' → ai
    //                 - 'cinematic sunset beach video' → ai
    //                 - 'animated story about a dragon' → ai
    //                 - 'space ship flying through galaxy' → ai
                
    //             Set \"video_type\": \"avatar\" if the user is asking for:
    //                 - Talking avatar
    //                 - Human presenter
    //                 - Male or female spokesperson
    //                 - AI host
    //                 - News presenter
    //                 - Educational presenter
    //                 - Marketing presenter
    //                 - Motivational speaker
                
    //             Examples:
    //                 - 'motivational avatar video' → avatar
    //                 - 'male avatar talking about marketing' → avatar
    //                 - 'female presenter explaining SEO' → avatar
    //                 - 'AI spokesperson for business tips' → avatar
                
    //             Default:
    //                 - If create_video = Yes and type is unclear → avatar
                    
    //             CRITICAL RULE:

    //                 If the text is describing a character, object, animal,
    //                 robot, cartoon, scene, environment, story, creature,
    //                 vehicle, fantasy subject, visual appearance or image concept,
    //                 then:
                    
    //                 'create_video': 'Yes'
    //                 'video_type': 'ai'
                    
    //                 Examples:
                    
    //                 'A cute blue robotic cat with a round face'
    //                 => create_video = Yes
    //                 => video_type = ai
                    
    //                 'Red sports car drifting on highway'
    //                 => create_video = Yes
    //                 => video_type = ai
                    
    //                 'Flying dragon over mountains'
    //                 => create_video = Yes
    //                 => video_type = ai
                    
    //                 Only return create_video = No when the user is clearly
    //                 asking a question, chatting, requesting information,
    //                 or having a normal conversation.
                    
    //                 Examples:
                    
    //                 'hey'
    //                 => create_video = No
                    
    //                 'what is email marketing'
    //                 => create_video = No
                    
    //                 'tell me about SEO'
    //                 => create_video = No
                
    //             Term (IMPORTANT):
    //                 - Extract the MAIN topic of the content/video
    //                 - Topic is usually after words like 'on', 'about', 'for'
    //                 - Example: 'video on Email Marketing' → \"Email Marketing\"
    //                 - Return only the topic (no extra words)
    //                 - If not found → \"\"
                
    //             Date & Time:
    //                 - Use current date (".$today_date.")
    //                 - Extract date & time
    //                 - If only date → time = 10:00:00
    //                 - Handle terms like tomorrow, next week
    //                 - If past → shift to future
    //                 - If missing → \"\"
                
    //             Gender:
    //                 - Male/Female if mentioned else \"\"
                
    //             Return ONLY JSON
                
    //             Format:
    //             {
    //               \"create_video\": \"Yes/No\",
    //               \"video_type\": \"avatar/ai\",
    //               \"Term\": \"\",
    //               \"instagram\": \"Yes/No\",
    //               \"Facebook\": \"Yes/No\",
    //               \"Youtube\": \"Yes/No\",
    //               \"schedule\": \"Yes/No\",
    //               \"post\": \"Yes/No\",
    //               \"date\": \"\",
    //               \"time\": \"\",
    //               \"gender\": \"Male/Female/\"
    //             }";

    //         $content = $this->getOpenAidata($prompt);
    //         $contentdata = str_replace("'", '"', $content);
    //         $postdata = json_decode($contentdata, true);
    //         $video_type = strtolower(trim($postdata['video_type'] ?? 'chat'));

    //         if (strtolower($postdata['create_video'] ?? '') == 'no') {
    //         // if ($video_type == 'chat') {
                
    //             $msgreply = $this->open_ai_chat($keyword);
    //             if (!empty($msgreply)) {
    //                 $response['success'] = true;
    //                 $response['message'] = $msgreply;
    //                 $response['loading'] = false;
    //                 echo json_encode($response);
    //                 return $response;
    //             }
    //         }
            
    //         if (empty($postdata['Term'])) {
    //             $postdata['Term'] = "motivational";
    //         }
            
    //         $errors = [];
    //         if (strtolower($postdata['instagram'] ?? '') == 'yes') {
    //             $insta = $this->get_access_token('instagram_access_token');
    //             if (empty($insta)) {
    //                 $errors[] = "Instagram not connected";
    //             }
    //         }
            
    //         if (strtolower($postdata['Facebook'] ?? '') == 'yes') {
    //             $fb = $this->get_access_token('facebook_access_token');
    //             if (empty($fb)) {
    //                 $errors[] = "Facebook not connected";
    //             }
    //         }
            
    //         if (strtolower($postdata['Youtube'] ?? '') == 'yes') {
    //             $yt = $this->get_access_token('youtube_access_token');
    //             if (empty($yt)) {
    //                 $errors[] = "YouTube not connected";
    //             }
    //         }
            
    //         if (!empty($errors)) {
    //             echo json_encode([
    //                 "success" => false,
    //                 "integration_required" => true,
    //                 "message" => implode(', ', $errors),
    //                 "data" => $postdata
    //             ]);
    //             return;
    //         }
            
    //         if ($video_type == 'ai') {

    //             $result = $this->generate_video_id($keyword);
            
    //             if (empty($result['id'])) {
            
    //                 echo json_encode([
    //                     "success" => false,
    //                     "message" => "AI Video generation failed"
    //                 ]);
    //                 return;
    //             }
            
    //             $video_id = $result['id'];
            
    //             // $scheduleData = $this->getScheduleData(
    //             //     $postdata['date'] ?? '',
    //             //     $postdata['time'] ?? ''
    //             // );
            
    //             // $timestamp = $scheduleData['timestamp'];
            
    //             $data = [
    //                 "user_id"        => $this->owner_id,
    //                 "business_id"    => $this->business_id,
    //                 "keyword"        => $postdata['Term'],
    //                 "video_id"       => $video_id,
    //                 "video_type"     => "ai",
    //                 "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
    //                 "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
    //                 "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
    //                 "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
    //                 "schedule_time"  => $timestamp
    //             ];
            
    //             $this->db->insert('auto_post', $data);
            
    //             $insert_id = $this->db->insert_id();
                
    //             if (!empty($insert_id)) {
    //                 $response['success'] = true;
    //                 $response['message'] = "AI Video generation started";
    //                 $response['insert_id'] = $insert_id;
    //                 $response['loading'] = true;
    //                 echo json_encode($response);
    //                 return $response;
    //             }
            
    //             // echo json_encode([
    //             //     "success" => true,
    //             //     "loading" => true,
    //             //     "insert_id" => $insert_id,
    //             //     "message" => "AI Video generation started"
    //             // ]);
            
    //             // return;
    //         }
            
    //         $scriptkeyword =  $postdata['Term'];
    //         $scriptprompt = "Write a clear and engaging voice-over script about ".$scriptkeyword.". The total length should be around 400�500 characters. The script should start with a strong hook, briefly explain the key idea, and end with a simple takeaway or call to action.";
    //         // pr($scriptprompt); die("ak");
    //         $voice_script = $this->generateOpenAidata($scriptprompt);
            
    //         /*-----------1 to 5 male video_url & 5 to 10 female video_url --------*/
            
    //         // $cdn_url = $this->config->item('cdn_url');
    //         $cdn_url = 'https://cdn.socialclawai.com/';
            
    //         /*--------For video Avatar using python API--------*/
            
    //         // $videos = [
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Military_Soldier_Mike.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Smart_Advisor_Malik.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Success_Mentor_Dana.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Finance_Expert_Max.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Business_Adviser_Ethan.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Science_Host_Georgia.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Lifestyle_Presenter_Sofia.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Health_Coach_Jenna.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Wellness_Host.mp4",
    //         //     $cdn_url . "assets/uploads/avatar/talking_video/Podcast_Host_Hana.mp4"
    //         // ];
            
    //         /*--------For Photo Avatar using Dup-Dub API--------*/
    //         $images = [
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar1.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar5.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar11.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar7.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar10.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar13.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar14.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar15.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar16.png',
    //             $cdn_url.'assets/uploads/avatar/talking_photo/newavatar17.png',
    //         ];
            
    //         /*-----------1 to 5 male voice_id & 5 to 10 female voice_id --------*/
    //         $voices = [
    //             "henry","oliver","joe", "george","rob","carly","kristy","tasha", "lisa","emily"
    //         ];
            
    //         // gender input
    //         $gender = strtolower(trim($postdata['gender'] ?? ''));

    //         if ($gender === "male") {
    //             $index = rand(0, 4);
    //         } elseif ($gender === "female") {
    //             $index = rand(5, 9);
    //         } else {
    //             $index = rand(0, 9);
    //         }
            
    //         // SAME INDEX se dono 
    //         // $video_url = $videos[$index];
    //         $imagePath = $images[$index];
    //         $voice_id  = $voices[$index];
    //         // pr($voice_id); die("ak");
            
    //         $audiovoice = $this->generateSpeechifyAudio($voice_script, $voice_id);
            
    //         if (empty($audiovoice)) {
    //             $response['success'] = false;
    //             $response['message'] = "audio not generated ";
    //             echo json_encode($response);
    //             return $response;
    //         }
    //         /*--------For video Avatar using python API--------*/
            
    //             // $result = $this->videoGenerator($video_url, $audiovoice); 
    //             // $dataDecoded = json_decode($result, true);
    //             // $video_id = $dataDecoded['id'];
                
    //         /*--------For video Avatar using python API close--------*/
            
    //         $result = $this->generateDupDubAavatar($imagePath, $audiovoice);
            
    //         $video_id = $result['id'];

    //         if (empty($video_id)) {
    //             $response['success'] = false;
    //             $response['message'] = "Some Error occurred";
    //             echo json_encode($response);
    //             return $response;
                
    //         }else{
    //             $data = [
    //                 "user_id"        => $this->owner_id,
    //                 "business_id"    => $this->business_id,
    //                 "keyword"        => $postdata['Term'],
    //                 "video_id"       => $video_id,
    //                 "video_type"     => "avatar",
    //                 "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
    //                 "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
    //                 "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
    //                 "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
    //                 "schedule_time"  => $timestamp
    //             ];
    //             $this->db->insert('auto_post', $data);
    //             $insert_id = $this->db->insert_id();

    //             if (!empty($insert_id)) {
    //                 $response['success'] = true;
    //                 $response['message'] = "Your video is currently in progress—great things take time! Stay patient, success is on the way 🚀";
    //                 $response['insert_id'] = $insert_id;
    //                 $response['loading'] = true;
    //                 echo json_encode($response);
    //                 return $response;
    //             }
    //         }
            
    // 	  }
    
    
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
            $this->db->where('user_id', $this->owner_id);
            $this->db->where('business_id', $this->business_id);
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
                        $this->db->where('business_id', $this->business_id);
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
            // $instagram = 1;
            // $facebook = 0;
            // $youtube = 0;
            // $video_id = "43c5b26b";
            // $url = "https://cdn.tubeclawai.com/assets/uploads/users/1/generated_1782383915_4634.mp4";
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
        
    /*------function for Video upload  on Youtube-----*/
//     	public function insertYoutubePublisher($keyword, $url, $caption, $schedule, $scheduletime) {
// 	   // pr($_POST); die;
// 	    $video_url = $url;
// 		$status = 1;
//         $data = array(
//             'user_id'            => $this->owner_id,
//             'business_id'        => $this->business_id,
//             'title'              => $keyword,
//             'description'        => $caption,
//             'tags'               => $keyword,
//             'thumbnail'          => '', 
//             'video_url'          => $video_url,
//             'video_id'           => NULL,
//             'schedule_date_time' => $schedule == 1 ? date('Y-m-d H:i:s', $scheduletime) : '',
//             'publish_type'       => $schedule == 1 ? 'false' : 'true',
//             'video_cat'          => 22,
//             'allow_embeding'     => 'true',
//             'age_restriction'    => 'false',
//             'copyright_content'  => 'false',
//             'visiblity'          => 'public',
//             'status'             => $status
//         );


//             if (!empty($video_url)) {
//                 $slug = $this->Videocreate_Remotion_Model->create_video_slug();
//                 $path = 'assets/uploads/videos/';
//                 $upload_folder = './' . $path . $slug;
                
//                 $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
//                 $post_data = [
//                     'api_key' => $this->python_api_key,
//                     'url'     => $video_url
//                 ];
            
//                 $video_details = getVideoDetailsPyCurl($post_data, $apiUrl);

//                 if (empty($video_details) || empty($video_details->thumbnail)) {
//                     echo json_encode(false);
//                     return;
//                 }

//                 $data['thumbnail'] =  $video_details->thumbnail;
            
//                 // die("Upload test completed.");
//             }
// // 		pr($data); die('here');
// 		// Upload video via API
// 		$videoResult = ['status' => false];
		
// 		if($update_id){
// 			$videoResult = $this->updateVideoData($data, $update_id);
// 		}else{
// 			$videoResult = $this->uploadData($data);
// 		}
// // 		 echo '<pre>'; print_r($videoResult); die;
// 		if ($videoResult['thumbnail_path']) {
// 			// Normalize boolean values
// 			$data['publish_type']       = ($this->input->post('publish_type') === 'true') ? 1 : 0;
// 			$data['allow_embeding']     = ($this->input->post('allow_embeding') === 'true') ? 1 : 0;
// 			$data['age_restriction']    = ($this->input->post('age_restriction') === 'true') ? 1 : 0;
// 			$data['copyright_content']  = ($this->input->post('copyright_content') === 'true') ? 1 : 0;

// 			$data['video_id'] = $videoResult['video_id'];
			

// 			// model and save data
// 			$saveResult = $this->Youtube_integration_model->save_youtube_publisher($data, $update_id);
			
// // 			pr($saveResult); die();

// 			header('Content-Type: application/json');
// 			echo json_encode([
// 				'status' => $saveResult,
// 				'message' => $saveResult ? ($update_id ? 'Video Edited Successfully !' : 'Inserted successfully') : ($update_id ? 'Update failed' : 'Insert failed'),
// 				'video_id' => $videoResult['video_id'],
// 				'thumbnail_path' => $videoResult['thumbnail_path'],
// 				'video_url' => $videoResult['video_url']
// 			]);
// 		} else {
// 			echo json_encode([
// 				'status' => false,
// 				'message' => $videoResult['msg'],
// 				'thumbnail_path' => '',
// 				'video_url' => $videoResult['video_url']
// 			]);
// 		}

//             return [
//                 "success" => false,
//                 "msg" => "Publish failed",
//                 "error" => $publish_data
//             ];
// 	}

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
            $this->db->where('user_id',$this->owner_id);
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
                
                
                public function getVideoHistory()
                {
                    // Fetch only active AI videos generated for this specific project domain
                    $this->db->select('id, user_id, business_id, keyword, video_url, video_type');
                    $this->db->where('user_id', $this->owner_id);
                    $this->db->where('business_id', $this->business_id);
                    $this->db->where('video_type', 'ai');
                    // $this->db->where('video_url IS NOT NULL', null, false);
                    $this->db->where('video_url !=', '');
                    $this->db->order_by('id', 'DESC');
                    $query = $this->db->get('auto_post');
                    $historyData = $query->result_array();
                
                    // Mapping background thumbnails directly using library configurations
                    foreach ($historyData as &$video) {
                        $this->db->select('thumbnail');
                        $this->db->where('url', $video['video_url']);
                        $this->db->where('video_status', 'heygen');
                        $libQuery = $this->db->get('library');
                        $libRow = $libQuery->row();
                
                        $video['thumbnail'] = (!empty($libRow) && !empty($libRow->thumbnail)) ? $libRow->thumbnail : '';
                    }
                    
                    
                    echo json_encode([
                        'status' => true,
                        'data' => $historyData
                    ]);
                    exit();
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
                
                public function deleteHistoryVideo()
                {
                    $id = $this->input->post('id');
                    if(!empty($id)) {
                        $this->db->where('id', $id);
                        $this->db->where('user_id', $this->owner_id);
                        $this->db->delete('auto_post');
                        echo json_encode(['status' => true, 'msg' => 'Video deleted successfully.']);
                    } else {
                        echo json_encode(['status' => false, 'msg' => 'Invalid video request configuration.']);
                    }
                    exit();
                }
                
// ------------------------------------------------------View Agent code --------------------------------------------------------------------------//
 //old code working                
        private function renderAndStoreVideo($request_id, $prefix = 'video')
        {
            
            
            // unchanged — included here only for completeness
            ignore_user_abort(true);
            set_time_limit(0);
        
            $final_video_url = false;
            $max_attempts = 30;      // ~5 minutes total
            $wait_seconds = 10;
        
            for ($i = 0; $i < $max_attempts; $i++) {
                $video_result = $this->fetch_video($request_id);
        
                if (!empty($video_result) && $video_result !== false) {
                    $final_video_url = $video_result;
                    break;
                }
                sleep($wait_seconds);
            }
        
            if (empty($final_video_url)) {
                return false;
            }
        
            $videoData = file_get_contents($final_video_url);
        
            if ($videoData === false) {
                return false;
            }
        
            $filename = $prefix . '_' . time() . '_' . rand(1000, 9999) . '.mp4';
            $directoryPath = FCPATH . 'uploads/users/' . $this->user_id;
        
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
        
            $filePath = $directoryPath . '/' . $filename;
            file_put_contents($filePath, $videoData);
        
            $uploadPath = 'uploads/users/' . $this->user_id . '/' . $filename;
            uploadAwsfile($uploadPath); // same helper used elsewhere in this controller
        
            return $this->config->item('bucket_url') . $uploadPath;
}
        private function renderAndStoreDupDubVideo($video_id, $prefix = 'avatar')
        {
            ignore_user_abort(true);
            set_time_limit(0);
        
            $final_video_url = false;
            $max_attempts = 30;
            $wait_seconds = 10;
        
            for ($i = 0; $i < $max_attempts; $i++) {
        
                $video_result = $this->fetchDupDubVideoAndSave($video_id);
        
                if (!empty($video_result) && $video_result !== false) {
                    $final_video_url = $video_result;
                    break;
                }
        
                sleep($wait_seconds);
            }
        
            if (empty($final_video_url)) {
                return false;
            }
        
            $videoData = @file_get_contents($final_video_url);
        
            if ($videoData === false) {
                return false;
            }
        
            $filename = $prefix . '_' . time() . '_' . rand(1000,9999) . '.mp4';
        
            $directoryPath = FCPATH . 'uploads/users/' . $this->user_id;
        
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath,0777,true);
            }
        
            $filePath = $directoryPath.'/'.$filename;
        
            file_put_contents($filePath,$videoData);
        
            $uploadPath = 'uploads/users/'.$this->user_id.'/'.$filename;
        
            uploadAwsfile($uploadPath);
        
            return $this->config->item('bucket_url').$uploadPath;
}
        private function failAvatarJob($insert_id, $message, $extra = [])
        {
            $update = array_merge(['status' => 'failed'], $extra);
            $this->Youtube_integration_model->updateVideoJob($insert_id, $update);
            echo json_encode(['status' => false, 'message' => $message, 'job_id' => $insert_id]);
        }
        private function renderDupDubVideo($videoUrl, $request_id, $prefix = 'avatar')
        {
            $videoData = file_get_contents($videoUrl);
        
            if ($videoData === false) {
                return false;
            }
        
            $filename = $prefix . '_' . time() . '_' . rand(1000,9999) . '.mp4';
        
            $directoryPath = FCPATH.'uploads/users/'.$this->user_id;
        
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath,0777,true);
            }
        
            $filePath = $directoryPath.'/'.$filename;
        
            file_put_contents($filePath,$videoData);
        
            $uploadPath = 'uploads/users/'.$this->user_id.'/'.$filename;
        
            uploadAwsfile($uploadPath);
        
            unlink($filePath);
        
            return $this->config->item('bucket_url').$uploadPath;
}
        public function getOpenAivc_new($script)
        {
        try {
                $open_ai = new OpenAi($this->openaikey);
                
                $prompt = "
        You are an expert YouTube SEO and AEO specialist.
        Based on the following video script/topic, generate:
        1. A highly clickable YouTube title.
        2. An SEO optimized YouTube description.
        3. 10 relevant YouTube tags.
        Return ONLY valid JSON, with no markdown code fences, no commentary.
        {
            \"title\": \"\",
            \"description\": \"\",
            \"tags\": []
        }
        Video Script:
        {$script}
        ";
                
                $history = [
                    ["role" => "user", "content" => $prompt]
                ];
                
                $opt = [
                    "model" => "gpt-4o-mini", // Fixed model name
                    "messages" => $history,
                    "temperature" => 0.8,
                    "max_completion_tokens" => 700,
                    "response_format" => ["type" => "json_object"] // Force JSON response
                ];
                
                $response = $open_ai->chat($opt);
                
                // Debug: Log the raw response
                log_message('debug', 'OpenAI Raw Response: ' . print_r($response, true));
                
                // Parse response properly
                if (is_string($response)) {
                    $data = json_decode($response, true);
                } else {
                    $data = $response;
                }
                
                // Check if we have the expected structure
                if (isset($data['choices'][0]['message']['content'])) {
                    $content = $data['choices'][0]['message']['content'];
                    
                    // Clean any markdown formatting
                    $content = preg_replace('/^```json\s*|\s*```$/', '', trim($content));
                    $content = preg_replace('/^```\s*|\s*```$/', '', $content);
                    
                    // Validate JSON
                    $decoded = json_decode($content, true);
                    if (json_last_error() === JSON_ERROR_NONE && isset($decoded['title'])) {
                        return $content;
                    }
                }
                
                // If we get here, something went wrong
                log_message('error', 'Invalid response from OpenAI: ' . print_r($response, true));
                return json_encode([
                    "title" => "",
                    "description" => "",
                    "tags" => []
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'OpenAI Error: ' . $e->getMessage());
                return json_encode([
                    "title" => "",
                    "description" => "",
                    "tags" => []
                ]);
            }
        } 
        public function ai_video_process()
        {
            $input = json_decode(file_get_contents('php://input'), true);
            $video_type = isset($input['video_type']) ? $input['video_type'] : null;
        
            // declared up front so they're always defined for the final JSON response
            $title = '';
            $description = '';
            $tags = [];
        
            if ($video_type == 'ai') {
        
                $prompt = isset($input['script']) ? trim($input['script']) : '';
        
                if ($prompt == '') {
                    echo json_encode(['status' => false, 'message' => 'Prompt is required.']);
                    return;
                }
        
                $api_key = $this->modelslab_video_key;
                $url = "https://modelslab.com/api/v6/video/text2video_ultra";
        
                $payload = json_encode([
                    "key"        => $api_key,
                    "model"      => "text-to-video",
                    "prompt"     => $prompt,
                    "duration"   => 5,
                    "resolution" => "720p",
                    "watermark"  => false
                ]);
        
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL            => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => $payload,
                    CURLOPT_HTTPHEADER     => ['Content-Type: application/json']
                ]);
        
                $response = curl_exec($curl);
        
                if (curl_errno($curl)) {
                    $error = curl_error($curl);
                    curl_close($curl);
                    echo json_encode(['status' => false, 'message' => 'ModelsLab request failed: ' . $error]);
                    return;
                }
                curl_close($curl);
        
                $result = json_decode($response, true);
                $request_id = $result['id'] ?? ($result['request_id'] ?? '');
        
                if (empty($request_id)) {
                    echo json_encode(['status' => false, 'message' => 'AI video generation failed to start.', 'raw' => $result]);
                    return;
                }
        
                $bucket_video_url = $this->renderAndStoreVideo($request_id, 'ai');
        
                $postdata = [];
        
                if ($bucket_video_url !== false) {
        
                    $content = $this->getOpenAivc_new($prompt);
        
                    // Strip markdown code fences if GPT wraps the JSON (```json ... ```)
                    $contentdata = preg_replace('/^```json\s*|\s*```$/', '', trim($content));
        
                    $postdata = json_decode($contentdata, true);
        
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        log_message('error', 'Failed to parse AI title/description JSON: '
                            . json_last_error_msg() . ' | raw content: ' . $content);
                        $postdata = [];
                    }
        
                    $title       = $postdata['title'] ?? '';
                    $description = $postdata['description'] ?? '';
                    $tags        = $postdata['tags'] ?? [];
                }
        
                if ($bucket_video_url === false) {
                    // Still processing — save as 'processing', frontend can poll job status separately.
                    $data = [
                        'user_id'       => $this->user_id,
                        'business_id'   => $this->business_id,
                        'video_type'    => 'ai',
                        'prompt'        => $prompt,
                        'job_id'        => $request_id,
                        'response_data' => json_encode($result),
                        'status'        => 'processing',
                        'progress'      => 1,
                        'created_on'    => date('Y-m-d H:i:s')
                    ];
                } else {
                    $data = [
                        'user_id'       => $this->user_id,
                        'business_id'   => $this->business_id,
                        'video_type'    => 'ai',
                        'prompt'        => $prompt,
                        'video_url'     => $bucket_video_url,
                        'job_id'        => $request_id,
                        'response_data' => json_encode([
                            'raw'    => $result,
                            'vcdata' => [
                                'title'       => $title,
                                'description' => $description,
                                'tags'        => $tags
                            ]
                        ]),
                        'status'        => 'completed',
                        'progress'      => 100,
                        'created_on'    => date('Y-m-d H:i:s'),
                        'completed_on'  => date('Y-m-d H:i:s')
                    ];
                }
        
            } elseif ($video_type == 'avatar') {
        
                $avatar_name = isset($input['avatar_name']) ? trim($input['avatar_name']) : '';
                $avatar_url  = isset($input['avatar_url']) ? trim($input['avatar_url']) : '';
                $script      = isset($input['script']) ? trim($input['script']) : '';
                $avatar_id   = isset($input['avatar_id']) ? $input['avatar_id'] : null;
                $voice_id    = isset($input['voice_id']) ? $input['voice_id'] : null;
                $voice_url   = isset($input['voice_url']) ? $input['voice_url'] : null;
        
                if ($script == '') {
                    echo json_encode(['status' => false, 'message' => 'Script is required.']);
                    return;
                }
                if (!$avatar_id || empty($avatar_url)) {
                    echo json_encode(['status' => false, 'message' => 'Please select an avatar photo.']);
                    return;
                }
                if (!$voice_id) {
                    echo json_encode(['status' => false, 'message' => 'Please select a voice.']);
                    return;
                }
        
                // ~15 chars/sec average speaking pace -> 30-60 sec needs ~450-900 chars
                $scriptLength = strlen($script);
                if ($scriptLength < 400) {
                    echo json_encode([
                        'status'  => false,
                        'message' => 'Script is too short for a 30-60 second video. Please provide at least 400 characters.'
                    ]);
                    return;
                }
        
                $voiceName = !empty($voice_url)
                    ? pathinfo(parse_url($voice_url, PHP_URL_PATH), PATHINFO_FILENAME)
                    : 'henry';
        
                
                $initial_data = [
                    'user_id'     => $this->user_id,
                    'business_id' => $this->business_id,
                    'video_type'  => 'avatar',
                    'avatar_name' => $avatar_name,
                    'script'      => $script,
                    'avatar_id'   => $avatar_id,
                    'avatar_url'  => $avatar_url,
                    'voice_id'    => $voice_id,
                    'voice_url'   => $voice_url,
                    'status'      => 'processing',
                    'progress'    => 5,
                    'created_on'  => date('Y-m-d H:i:s')
                ];
        
                try {
                    $insert_id = $this->Youtube_integration_model->insertVideoJob($initial_data);
                } catch (Exception $e) {
                    echo json_encode(['status' => false, 'message' => 'DB error: ' . $e->getMessage()]);
                    return;
                }
        
                if (empty($insert_id)) {
                    echo json_encode(['status' => false, 'message' => 'Could not save video job.']);
                    return;
                }
        
                // STEP 2: generate the voice-over audio (stashed in response_data — no dedicated column)
                $audiovoice = $this->generateSpeechifyAudio($script, $voiceName);
        
                if (empty($audiovoice) || strpos($audiovoice, 'Error') === 0) {
                    $this->failAvatarJob($insert_id, 'Audio generation failed.', [
                        'progress'      => 0,
                        'response_data' => json_encode(['error' => 'Audio generation failed.'])
                    ]);
                    return;
                }
        
                $this->Youtube_integration_model->updateVideoJob($insert_id, [
                    'progress'      => 20,
                    'response_data' => json_encode(['audio_url' => $audiovoice])
                ]);
        
                // STEP 3: kick off avatar video generation (DupDub)
                $dupdub = $this->generateDupDubAavatar($avatar_url, $audiovoice);
                
                
               
                if (!$dupdub['success']) {
                    $this->failAvatarJob($insert_id, $dupdub['message'], [
                        'progress'      => 20,
                        'response_data' => json_encode(['audio_url' => $audiovoice, 'error' => $dupdub['message']])
                    ]);
                    return;
                }
        
                $request_id = $dupdub['id'];
                $result     = $dupdub;
        
                if (empty($request_id)) {
                    $this->failAvatarJob($insert_id, 'Avatar video generation failed to start.', [
                        'response_data' => json_encode(['audio_url' => $audiovoice, 'raw' => $result])
                    ]);
                    return;
                }
        
                // external job_id now known — persist it
                $this->Youtube_integration_model->updateVideoJob($insert_id, [
                    'job_id'        => $request_id,
                    'progress'      => 30,
                    'response_data' => json_encode(['audio_url' => $audiovoice, 'raw' => $result])
                ]);
                
                $bucket_video_url = $this->renderAndStoreDupDubVideo($request_id, 'avatar');
                
                // print_r($bucket_video_url);
                // die();
                
                if ($bucket_video_url === false) {
                    
                    echo json_encode([
                        'status'   => true,
                        'message'  => 'Avatar video is still rendering. Check back shortly.',
                        'job_id'   => $insert_id,
                        'video_id' => $request_id
                    ]);
                    return;
                }
        
                
                $content = $this->getOpenAivc_new($script);
                $contentdata = preg_replace('/^```json\s*|\s*```$/', '', trim($content));
                $postdata = json_decode($contentdata, true);
        
                if (json_last_error() !== JSON_ERROR_NONE) {
                    log_message('error', 'Failed to parse avatar title/description JSON: '
                        . json_last_error_msg() . ' | raw content: ' . $content);
                    $postdata = [];
                }
        
                $title       = $postdata['title'] ?? '';
                $description = $postdata['description'] ?? '';
                $tags        = $postdata['tags'] ?? [];
        
                $final_update = [
                    'video_url'     => $bucket_video_url,
                    'response_data' => json_encode([
                        'audio_url' => $audiovoice,
                        'raw'       => $result,
                        'vcdata'    => [
                            'title'       => $title,
                            'description' => $description,
                            'tags'        => $tags
                        ]
                    ]),
                    'status'       => 'completed',
                    'progress'     => 100,
                    'completed_on' => date('Y-m-d H:i:s')
                ];
        
                try {
                    $this->Youtube_integration_model->updateVideoJob($insert_id, $final_update);
                } catch (Exception $e) {
                    echo json_encode(['status' => false, 'message' => 'DB error: ' . $e->getMessage()]);
                    return;
                }
        
                echo json_encode([
                    'status'      => true,
                    'message'     => 'Avatar video generated successfully.',
                    'job_id'      => $insert_id,
                    'video_url'   => $bucket_video_url,
                    'title'       => $title,
                    'description' => $description,
                    'tags'        => $tags
                ]);
                return;
        
            } else {
                echo json_encode(['status' => false, 'message' => 'Invalid video type.']);
                return;
            }
        
            // Only the 'ai' branch reaches here — 'avatar' always echoes + returns above.
            try {
                $insert_id = $this->Youtube_integration_model->insertVideoJob($data);
            } catch (Exception $e) {
                echo json_encode(['status' => false, 'message' => 'DB error: ' . $e->getMessage()]);
                return;
            }
        
            if ($insert_id) {
                echo json_encode([
                    'status'      => true,
                    'message'     => !empty($data['video_url'])
                        ? ucfirst($video_type) . ' video generated successfully.'
                        : 'Video generation started.',
                    'job_id'      => $insert_id,
                    'video_url'   => $data['video_url'] ?? null,
                    'title'       => $title,
                    'description' => $description,
                    'tags'        => $tags
                ]);
            } else {
                echo json_encode(['status' => false, 'message' => 'Could not start video generation.']);
            }
        }
        public function publishJob($job_id)
        {

            $keyword  = $this->input->post('title');
            $caption  = $this->input->post('description');
            $schedule = $this->input->post('publish_type') == 'false' ? 1 : 0;
            $tags  = $this->input->post('tags');
            $scheduletime = !empty($this->input->post('schedule_date_time'))
            ? strtotime($this->input->post('schedule_date_time'))
            : null;
        
            $posted_video_url = $this->input->post('video_url');
            
            $video_url = $posted_video_url;
        
            // if (method_exists($this->Youtube_integration_model, 'getVideoJob')) {
            //     try {
            //         $job = $this->Youtube_integration_model->getVideoJob($job_id);
            //         if (!empty($job['video_url'])) {
            //             $video_url = $job['video_url'];
            //         }
            //     } catch (Exception $e) {
            //         log_message('error', 'getVideoJob failed: ' . $e->getMessage());
            //     }
            // }
        
            if (empty($video_url)) {
                echo json_encode(['status' => false, 'msg' => 'Video not found for this job.']);
                return;
            }
        
            try {
                $result = $this->insertYoutubePublisher($keyword, $video_url, $caption, $schedule, $scheduletime);
            } catch (Exception $e) {
                log_message('error', 'insertYoutubePublisher failed: ' . $e->getMessage());
                echo json_encode(['status' => false, 'msg' => 'Publish failed: ' . $e->getMessage()]);
                return;
            }
        
            if (!empty($result['success'])) {
                echo json_encode([
                    'status'    => true,
                    'msg'       => $result['msg'],
                    'video_id'  => $result['video_id'],
                    'video_url' => $result['video_url']
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'msg'    => $result['msg'] ?? 'Publish failed.'
                ]);
            }
        }
        
        
        
}