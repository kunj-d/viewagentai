<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Telegram extends CI_Controller
{
    protected $openaikey;

    public function __construct()
    {
        parent::__construct();
        $this->openaikey = $this->config->item('open_ai_key');

        $this->load->library('session');
        $this->load->helper('tokengenerate');
          $this->spechify_key = $this->config->item('spechify_key');
        $this->python_api_key ='D684B8EFF387DBD9';
        $this->dupdub_api_key =$this->config->item('dupdub_api_key');
        $this->modelslab_video_key =$this->config->item('modelslab_video_key');
		$this->openaikey = $this->config->item('open_ai_key');
		$this->user_id = '';
		$this->business_id = '';
    }

    // ============================================================
    //  TELEGRAM WEBHOOK SETUP (Frontend Connection Endpoint)
    // ============================================================
    // public function telegram_webhook()
    // {
    //     $post = $this->input->post();
    //     $agent_code = trim($post['agent_unique_code'] ?? '');
    //     $business_id = trim($post['business_id'] ?? '');
    //     $bot_token = trim($post['bot_token'] ?? '');

    //     if (empty($agent_code) || empty($bot_token)) {
    //         echo json_encode(['success' => false, 'message' => 'Agent code and bot token are required']);
    //         return;
    //     }

    //     $webhook_url = base_url("telegram/webhook/" . $bot_token);
    //     $telegram_api = "https://api.telegram.org/bot{$bot_token}/setWebhook";

    //     $ch = curl_init();
    //     curl_setopt_array($ch, [
    //         CURLOPT_URL => $telegram_api,
    //         CURLOPT_POST => true,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POSTFIELDS => ['url' => $webhook_url]
    //     ]);
    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     $res = json_decode($response, true);
    //     if (!$res || !$res['ok']) {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Failed to set webhook',
    //             'telegram_response' => $res
    //         ]);
    //         return;
    //     }

    //     $exists = $this->db
    //         ->where('agent_id', $agent_code)
    //         ->where('channel_id', 2)
    //         ->get('openclaw_agents_channel_intregation')
    //         ->row();

    //     $data = [
    //         'agent_id' => $agent_code,
    //         'business_id' => $business_id,
    //         'channel_id' => 2,
    //         'channel_token' => $bot_token,
    //         'channel_status' => 1,
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ];

    //     if ($exists) {
    //         $this->db->where('aci_id', $exists->aci_id)->update('openclaw_agents_channel_intregation', $data);
    //     } else {
    //         $data['created_at'] = date('Y-m-d H:i:s');
    //         $this->db->insert('openclaw_agents_channel_intregation', $data);
    //     }

    //     echo json_encode([
    //         'success' => true,
    //         'message' => 'Telegram connected With Your Bot Agent'
    //     ]);
    // }
    
    public function telegram_webhook()
    {
       
        if (!in_array('telegram', $this->session->userdata('features'))) {

            echo json_encode([
                'success' => false,
                'message' => 'Please upgrade your plan'
            ]);
            exit;
        }
        
        $post = $this->input->post();
        //  pr($post);die;

        $agent_code  = trim($post['agent_unique_code'] ?? '');
        $business_id = trim($post['business_id'] ?? '');
        $bot_token   = trim($post['bot_token'] ?? '');
        
        
        // $agent = $this->db
        // ->where('business_id', $this->business_id)
        // ->get('openclaw_agents')
        // ->row();
  
        // $data['agent_id'] = !empty($agent) ? $agent->agent_unique_code : '';
    
        if (empty ($bot_token) || empty($business_id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Agent code, Business ID and Bot Token are required'
            ]);
            return;
        }
    
        // Telegram Webhook
        $webhook_url = base_url("telegram/webhook/" . $bot_token);
        $telegram_api = "https://api.telegram.org/bot{$bot_token}/setWebhook";
    
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $telegram_api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                'url' => $webhook_url
            ]
        ]);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $res = json_decode($response, true);
    
        if (!$res || empty($res['ok'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to set webhook',
                'telegram_response' => $res
            ]);
            return;
        }
    
        // Get Agent ID from openclaw_agents
        $agent = $this->db
            ->where('business_id', $business_id)
            // ->where('agent_id', $agent_code)
            ->get('openclaw_agents')
            ->row();
    
        if (!$agent) {
            echo json_encode([
                'success' => false,
                'message' => 'Agent not found'
            ]);
            return;
        }
    
        $agent_id = $agent->agent_id;
        
        
        $token_claimed = $this->db
        ->where('channel_token', $bot_token)
        ->where('channel_id', 2)
        ->where('agent_id !=', $agent_id) // Doosra agent hona chahiye, khud ka purana ho toh chalega update ke liye
        ->get('openclaw_agents_channel_intregation')
        ->row();

        if ($token_claimed) {
            echo json_encode([
                'success' => false,
                'message' => 'This Telegram Bot Token is already connected to another agent.'
            ]);
            return;
        }
    
        // Check Existing Integration
        $exists = $this->db
            ->where('agent_id', $agent_id)
            ->where('channel_id', 2)
            ->get('openclaw_agents_channel_intregation')
            ->row();
    
        $data = [
            'agent_id'       => $agent_id,
            'business_id'    => $business_id,
            'channel_id'     => 2,
            'channel_token'  => $bot_token,
            'channel_status' => 1,
            'updated_at'     => date('Y-m-d H:i:s')
        ];
    
        if ($exists) {
    
            $this->db->where('aci_id', $exists->aci_id);
            $this->db->update('openclaw_agents_channel_intregation', $data);
    
        } else {
    
            $data['created_at'] = date('Y-m-d H:i:s');
    
            $this->db->insert('openclaw_agents_channel_intregation', $data);
        }
    
        if ($this->db->affected_rows() > 0 || $exists) {
    
            echo json_encode([
                'success' => true,
                'message' => 'Telegram connected successfully.'
            ]);
    
        } else {
    
            echo json_encode([
                'success' => false,
                'message' => 'Database save failed.',
                'query' => $this->db->last_query(),
                'error' => $this->db->error()
            ]);
        }
    }
    
    public function telegram_reset()
{
    $post = $this->input->post();
    $business_id = trim($post['business_id'] ?? '');

    if (empty($business_id)) {
        echo json_encode([
            'success' => false,
            'message' => 'Business ID is required'
        ]);
        return;
    }

    // 1. Pehle business_id se agent fetch karein
    $agent = $this->db
        ->where('business_id', $business_id)
        ->get('openclaw_agents')
        ->row();

    if (!$agent) {
        echo json_encode([
            'success' => false,
            'message' => 'Agent not found for this Business ID.'
        ]);
        return;
    }

    $agent_id = $agent->agent_id;

    $this->db->where('agent_id', $agent_id);
    $this->db->where('channel_id', 2); // Telegram Channel ID
    $this->db->delete('openclaw_agents_channel_intregation');

    if ($this->db->affected_rows() > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Telegram token disconnected and reset successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No active integration found to reset.'
        ]);
    }
}

    // ============================================================
    //  TELEGRAM REALTIME INBOUND FLOW (Dynamic AI Chat)
    // ============================================================
    // public function webhook($bot_token = null)
    // {
    //     if (!$bot_token)
    //         return;

    //     $input = file_get_contents('php://input');
    //     $update = json_decode($input, true);
    //     if (!$update)
    //         return;

 
    //     $msg = $update['message'];
    //     $chat_id = $msg['chat']['id'];
    //     $user_prompt = trim($msg['text']);

    //     $channel = $this->db->where('channel_token', $bot_token)->get('openclaw_agents_channel_intregation')->row();
    //     //$agent_details     =   $this->Teligram_Model->get_row_any_table('openclaw_agents',array('agent_id'=>$channel->agent_id));
    //     $agent_details = $this->db->where('agent_id', $channel->agent_id)->get('openclaw_agents')->row();

    //     $user_id           =   $agent_details->user_id;
    //     $business_id       =   $agent_details->business_id;
    //     if (!$channel)
    //         return;

    
     
    //     $bottype = null;
        

    //             $msgData = [
    //         'agent_id' => $user_id,
    //         'business_id' => $business_id,
    //         'chat_id' => $chat_id,
    //         'user_id' => $msg['from']['id'] ?? null,
    //         'bot_token' => $bot_token,
    //         'username' => $msg['from']['username'] ?? '',
    //         'first_name' => $msg['from']['first_name'] ?? '',
    //         'message' => $user_prompt,
    //         'message_type' => 'text',
    //         'raw_data' => json_encode($update),
    //         'created_at' => date('Y-m-d H:i:s')
    //     ];
    //     $this->db->insert('telegram_messages', $msgData);
                   
    //     // if (strtolower($user_prompt) === '/start') {
    //     //     $welcome_txt = "Hello! I am your Tube Claw AI Agent. Send me any question or marketing prompt, and I will assist you instantly! ðŸš€";
    //     //     $this->sendTelegramMessage($bot_token, $chat_id, $welcome_txt, $channel);
    //     //     return;
    //     // }

    //     //$chat_reply = $this->open_ai_chat($user_prompt);
    //     if (isset($update['callback_query'])) {

    //                     $callback = $update['callback_query'];

    //                     $chat_id = $callback['message']['chat']['id'];
    //                   // $user_id = $callback['from']['id'];

    //                     // Button ki value
    //                     $callback_data = $callback['data'];
    //                 $user_prompt = $callback['message']['text'];
    //                     if ($callback_data == 'video_avatar') {
    //                     $bottype  ='video_avatar';
    //                         $this->generatePost(
    //                             $bot_token,
    //                             $chat_id,
    //                             $user_prompt,$user_id,$business_id,$bottype
    //                         );

    //                     } elseif ($callback_data == 'video_ai') {
    //                         $bottype ='video_ai';
    //                         $this->generatePost(
    //                             $bot_token,
    //                             $chat_id,
    //                         $user_prompt,$user_id,$business_id,$bottype
    //                         );
    //                     }

                     
    //                 }else {
    //                     $this->generatePost($bot_token, $chat_id, $user_prompt, $user_id, $business_id, $bottype);
    //                 }
    //                 // $this->sendTelegramMessage($bot_token, $chat_id, $chat_reply, $channel);
    // }
    public function webhook($bot_token = null)
    {
        if (!$bot_token)
            return;

        $input = file_get_contents('php://input');
        $update = json_decode($input, true);
        if (!$update)
            return;

        $channel = $this->db->where('channel_token', $bot_token)->get('openclaw_agents_channel_intregation')->row();
        if (!$channel)
            return;

        $agent_details = $this->db->where('agent_id', $channel->agent_id)->get('openclaw_agents')->row();
        $user_id       = $agent_details->user_id;
        $business_id   = $agent_details->business_id;

        $bottype = null;

        // CALLBACK QUERY PROCESSING (Jab user button dabaaye)
        if (isset($update['callback_query'])) {
            $callback = $update['callback_query'];
            $chat_id = $callback['message']['chat']['id'];
            $callback_data = $callback['data'];
            
            // Fix: Database se actual purana user text prompt uthate hain na ki bot ka question text
            $last_user_msg = $this->db->select('message')
                ->where('chat_id', $chat_id)
                ->where('message_type', 'text')
                ->order_by('id', 'DESC')
                ->get('telegram_messages')
                ->row();

            $user_prompt = (!empty($last_user_msg)) ? $last_user_msg->message : '';

            if ($callback_data == 'video_avatar') {
                $bottype = 'video_avatar';
                $this->generatePost($bot_token, $chat_id, $user_prompt, $user_id, $business_id, $bottype);
            } elseif ($callback_data == 'video_ai') {
                $bottype = 'video_ai';
                $this->generatePost($bot_token, $chat_id, $user_prompt, $user_id, $business_id, $bottype);
            }
            return;
        }

        // NORMAL TEXT PROCESSING (Jab user message likhe)
        if (isset($update['message'])) {
            $msg = $update['message'];
            $chat_id = $msg['chat']['id'];
            $user_prompt = trim($msg['text'] ?? '');

            if (empty($user_prompt)) return;

            $msgData = [
                'agent_id' => $user_id,
                'business_id' => $business_id,
                'chat_id' => $chat_id,
                'user_id' => $msg['from']['id'] ?? null,
                'bot_token' => $bot_token,
                'username' => $msg['from']['username'] ?? '',
                'first_name' => $msg['from']['first_name'] ?? '',
                'message' => $user_prompt,
                'message_type' => 'text',
                'raw_data' => json_encode($update),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('telegram_messages', $msgData);

            $this->generatePost($bot_token, $chat_id, $user_prompt, $user_id, $business_id, $bottype);
        }
    }

      public function generatePost($bot_token, $chat_id,$prompData,$user_id, $business_id, $bottype)
    	  {
            $this->user_id = $user_id;
		$this->business_id = $business_id;
            // pr($prompData); die("ak"); 
            if($bottype == 'video_ai') {

                $user_selection = $bottype ;
            }elseif($bottype == 'video_avatar') {
                $user_selection = $bottype ;
            }
            $keyword = $prompData;
            
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
            
            
       
            $content = $this->getOpenAidata($prompt);
            $contentdata = str_replace("'", '"', $content);
            $postdata = json_decode($contentdata, true);
                 
            if (strtolower($postdata['create_video'] ?? '') == 'no') {
            
                
                $msgreply = $this->open_ai_chat($keyword);
                if (!empty($msgreply)) {
                 
                   $this->sendTelegramMessage($bot_token, $chat_id, $msgreply, $user_id, $business_id);
                    
                    return;
                }
            }
            
            if (empty($user_selection)) {
                $ask_type = 'ask_type';
                  $this->sendTelegramMessage($bot_token, $chat_id, $ask_type, $user_id, $business_id);
              
                return;
            }
            $video_type = $user_selection;
            if (empty($postdata['Term'])) {
                $postdata['Term'] = "motivational";
            }
            
            $errors = [];
            if (strtolower($postdata['instagram'] ?? '') == 'yes') {
                $insta = $this->get_access_token('instagram_access_token');
                if (empty($insta)) {
                    $errors = "Instagram not connected";
                      $this->sendTelegramMessage($bot_token, $chat_id, $errors, $user_id, $business_id);
                      return false;
                }
            }
            
            if (strtolower($postdata['Facebook'] ?? '') == 'yes') {
                $fb = $this->get_access_token('facebook_access_token');
                if (empty($fb)) {
                    $errors = "Facebook not connected";
                    $this->sendTelegramMessage($bot_token, $chat_id, $errors, $user_id, $business_id);
                    return false;
                }
            }
            
            if (strtolower($postdata['Youtube'] ?? '') == 'yes') {
                $yt = $this->get_access_token('youtube_access_token');
                if (empty($yt)) {
                    $errors = "YouTube not connected";
                    $this->sendTelegramMessage($bot_token, $chat_id, $errors, $user_id, $business_id);
                    return false;
                }
            }
            
            
            $scheduleData = $this->getScheduleData($postdata['date'] ?? '', $postdata['time'] ?? '');
            $timestamp = $scheduleData['timestamp'];
            
            if ($video_type == 'video_ai') {
                
                $refine_prompt = "Convert this user concept: \"" . $keyword . "\" into a highly descriptive, visually clear, and detailed scene prompt for an AI Text-to-Video engine. 
                    Focus on setting layout, lighting, characters action, and cinematic fidelity. 
                    Avoid generic marketing buzzwords. Keep the total output concise within 200-300 characters max, optimized for video generation models.
                    Return ONLY the final rewritten text description prompt:";
        
                $optimized_modelslab_prompt = $this->generateOpenAidata($refine_prompt);
                
                if (empty($optimized_modelslab_prompt)) {
                    $optimized_modelslab_prompt = $keyword;
                }

                $result = $this->generate_video_id($optimized_modelslab_prompt);
            
                if (empty($result['id'])) {
                      $this->sendTelegramMessage($bot_token, $chat_id, "AI Video generation failed", $user_id, $business_id);
                    
                    return;
                }
            
                $video_id = $result['id'];
            
            
            
                $data = [
                    "user_id"        => $user_id,
                    "business_id"    => $business_id,
                    "keyword"        => $postdata['Term'],
                    //"video_id"       => $video_id,
                    "video_type"     => "ai",
                    "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
                    "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
                    "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
                    "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
                    "schedule_time"  => $timestamp
                ];
            
                $this->db->insert('auto_post', $data);
            
                $insert_id = $this->db->insert_id();

                  $data_temp_avtar = [
                           "user_id"               => $user_id,
                            "business_id"          => $business_id,
                            "auto_post_table_id"   => $insert_id,
                            "chat_id"              => $chat_id,
                            "video_id"             => $video_id,
                            "bot_token"            => $bot_token,
                            "type"                  => "ai",
                  
                    ];
                    $this->db->insert('telegram_cron_process ', $data_temp_avtar);
                
                 if (!empty($insert_id)) {
                    $this->sendTelegramMessage($bot_token, $chat_id, "AI Video generation started successfully!", $user_id, $business_id);
               
                    return;
                }
            
            }
            if ($video_type == 'video_avatar') {
                $scriptkeyword =  $postdata['Term'];
                $scriptprompt = "Write a clear and engaging voice-over script about ".$scriptkeyword.". The total length should be around 400ï¿½500 characters. The script should start with a strong hook, briefly explain the key idea, and end with a simple takeaway or call to action.";
              
                $voice_script = $this->generateOpenAidata($scriptprompt);
           
                $cdn_url = 'https://cdn.socialclawai.com/';

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
                
        
                $imagePath = $images[$index];
                $voice_id  = $voices[$index];
               
                $audiovoice = $this->generateSpeechifyAudio($voice_script, $voice_id);
                
                if (empty($audiovoice)) {
                   
                    $this->sendTelegramMessage($bot_token, $chat_id, "audio not generated", $user_id, $business_id);
                    return ;
                }
             
                
                $result = $this->generateDupDubAavatar($imagePath, $audiovoice);
                
                $video_id = $result['id'];
    
                if (empty($video_id)) {
                    $this->sendTelegramMessage($bot_token, $chat_id, "Some Error occurred", $user_id, $business_id);
                    
                    return;
                }else{
                    $data = [
                        "user_id"        => $user_id,
                        "business_id"    => $business_id,
                        "keyword"        => $postdata['Term'],
                        //"video_id"       => $video_id,
                        "video_type"     => "avatar",
                        "instagram"      => strtolower($postdata['instagram']) == 'yes' ? 1 : 0,
                        "facebook"       => strtolower($postdata['Facebook']) == 'yes' ? 1 : 0,
                        "youtube"        => strtolower($postdata['Youtube']) == 'yes' ? 1 : 0,
                        "schedule"       => strtolower($postdata['schedule']) == 'yes' ? 1 : 0,
                        "schedule_time"  => $timestamp
                    ];
                    $this->db->insert('auto_post', $data);
                    $insert_id = $this->db->insert_id();

                     $data_temp_avtar = [
                           "user_id"               => $user_id,
                            "business_id"          => $business_id,
                            "chat_id"              => $chat_id,
                            "auto_post_table_id"   => $insert_id,
                            "video_id"             => $video_id,
                            "bot_token"            => $bot_token,
                            "type"                 => "avatar",
                  
                    ];
                    $this->db->insert('telegram_cron_process ', $data_temp_avtar);
    
                    if (!empty($insert_id)) {
                        $this->sendTelegramMessage($bot_token, $chat_id, "Your Avatar talking video is currently in progress", $user_id, $business_id);
                     
                        return;
                    }
                }
            }
            
    	  }
    	  
    	  
    	    public function get_access_token($table_name)
        {
            
            $this->db->where('user_id', $this->user_id);
            $this->db->where('business_id',$this->business_id);
            $query = $this->db->get($table_name);
        
            return $query->row();
        }


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
        
                    // âœ… Sirf ID return
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

    // ============================================================
    //  CORE PLATFORM PROCESSING HELPERS
    // ============================================================
    public function sendTelegramMessage($bot_token, $chat_id, $text, $user_id, $business_id){
      //echo '<pre>'; print_r($text); die('fdfd');
     if($text == 'ask_type') {
            $payload = [
                "chat_id" => $chat_id,
                "text" => "How would you like to create a video for this topic?",
                "reply_markup" => [
                    "inline_keyboard" => [
                        [
                            [
                                "text" => "🎭 Talking Avatar",
                                "callback_data" => "video_avatar"
                            ]
                        ],
                        [
                            [
                                "text" => "🎬 AI Cinematic Video",
                                "callback_data" => "video_ai"
                            ]
                        ]
                    ]
                ]
    ];
     }else {

         $payload = [
             "chat_id" => $chat_id,
             "text" => $text,
          
         ];
     }
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

        $this->db->insert('telegram_messages', [
            'agent_id' => $user_id,
            'business_id' => $business_id,
            'chat_id' => $chat_id,
            'bot_token' => $bot_token,
            'message' => $text,
            'message_type' => 'bot_reply',
            'raw_data' => $tg_res,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    private function open_ai_chat($userMessage)
    {
        $postData = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "You are a professional full-stack social media manager and assistant. Answer clearly, accurately, and concisely based on user niche prompts."],
                ["role" => "user", "content" => $userMessage]
            ],
            "temperature" => 0.7,
            "max_tokens" => 1000
        ];

        $ch = curl_init("https://api.openai.com/v1/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->openaikey
            ],
            CURLOPT_POSTFIELDS => json_encode($postData)
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
      //  echo '<pre>';print_r($result); die;
        return $result['choices'][0]['message']['content'] ?? "I'm sorry, I couldn't process your request at this moment.";
    }
}