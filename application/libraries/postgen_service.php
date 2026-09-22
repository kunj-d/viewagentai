<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Orhanerday\OpenAi\OpenAi;

class PostGen_Service {

    protected $CI;
    protected $openaikey;
    protected $modelslab_video_key;
    protected $dupdub_api_key;
    protected $spechify_key;
    protected $python_api_key;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
        
        $this->openaikey          = $this->CI->config->item('open_ai_key');
        $this->spechify_key        = $this->CI->config->item('spechify_key');
        $this->dupdub_api_key      = $this->CI->config->item('dupdub_api_key');
        $this->modelslab_video_key = $this->CI->config->item('modelslab_video_key');
        $this->python_api_key      = 'D684B8EFF387DBD9';
    }

    public function parsePromptIntent($keyword) {
        $today_date = date("Y-m-d");
        $prompt = "Today date is: " . $today_date . " " . $keyword . "
        Analyze the above text and extract the data in STRICT JSON format.
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

        $open_ai = new OpenAi($this->openaikey);
        $response = $open_ai->chat([
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", "content" => $prompt]],
            "temperature" => 0.1
        ]);
        $data = json_decode($response, true);
        $content = $data["choices"][0]["message"]["content"] ?? '{}';
        return json_decode(str_replace("'", '"', $content), true);
    }

    public function executeOpenAiChat($userMessage) {
        $ch = curl_init("https://api.openai.com/v1/chat/completions");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Authorization: Bearer " . $this->openaikey],
            CURLOPT_POSTFIELDS => json_encode([
                "model" => "gpt-3.5-turbo",
                "messages" => [
                    ["role" => "system", "content" => "You are a helpful assistant in Hinglish."],
                    ["role" => "user", "content" => $userMessage]
                ]
            ])
        ]);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $result['choices'][0]['message']['content'] ?? "";
    }

    public function initiateAiVideoPipeline($keyword, $postdata, $owner_id, $business_id) {
        $refine_prompt = "Convert to short visual prompt. Return ONLY prompt: " . $keyword;
        $open_ai = new OpenAi($this->openaikey);
        $ai_res = json_decode($open_ai->chat([
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", "content" => $refine_prompt]]
        ]), true);
        $optimized_prompt = $ai_res["choices"][0]["message"]["content"] ?? $keyword;

        $ch = curl_init("https://modelslab.com/api/v6/video/text2video_ultra");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                "prompt" => $optimized_prompt, "duration" => "5", "aspect_ratio" => "9:16",
                "model_id" => "ltx-2.3", "watermark" => false, "key" => $this->modelslab_video_key
            ]),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
        ]);
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return (!empty($response['id'])) ? $this->logAutoPostRecord($response['id'], 'ai', $postdata, $owner_id, $business_id) : false;
    }

    public function initiateAvatarVideoPipeline($keyword, $postdata, $owner_id, $business_id) {
        $term = !empty($postdata['Term']) ? $postdata['Term'] : "motivational";
        $open_ai = new OpenAi($this->openaikey);
        $script_res = json_decode($open_ai->chat([
            "model" => "gpt-3.5-turbo",
            "messages" => [["role" => "user", "content" => "Write voice-over plain script about: " . $term]]
        ]), true);
        $voice_script = $script_res["choices"][0]["message"]["content"] ?? '';

        $ch = curl_init("https://api.sws.speechify.com/v1/audio/speech");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $this->spechify_key, 'Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode(['input' => $voice_script, 'voice_id' => $this->resolveVoiceGenderId($postdata['gender'] ?? ''), 'audio_format' => 'wav'])
        ]);
        $audio_res = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (empty($audio_res['audio_data'])) return false;

        $directoryPath = FCPATH . 'assets/uploads/users/' . $owner_id;
        if (!is_dir($directoryPath)) mkdir($directoryPath, 0777, true);
        $fileName = 'audio_' . time() . '.wav';
        file_put_contents($directoryPath . '/' . $fileName, base64_decode($audio_res['audio_data']));
        
        $uploadRelativePath = 'assets/uploads/users/' . $owner_id . '/' . $fileName;
        uploadAwsfile($uploadRelativePath);
        $s3AudioUrl = $this->CI->config->item('bucket_url') . $uploadRelativePath;

        $imagePath = $this->resolveRandomAvatarAsset($postdata['gender'] ?? '');
        $dup_id = $this->triggerDupDubAvatarCreation($imagePath, $s3AudioUrl);

        return $dup_id ? $this->logAutoPostRecord($dup_id, 'avatar', $postdata, $owner_id, $business_id) : false;
    }

    private function logAutoPostRecord($video_id, $type, $postdata, $owner_id, $business_id) {
        $timestamp = 0;
        if (!empty($postdata['date']) && !empty($postdata['time'])) {
            $timestamp = strtotime($postdata['date'] . ' ' . $postdata['time']);
            if ($timestamp < time()) { $timestamp = time(); }
        }
        $data = [
            "user_id"        => $owner_id,
            "business_id"    => $business_id,
            "keyword"        => !empty($postdata['Term']) ? $postdata['Term'] : "motivational",
            "video_id"       => $video_id,
            "video_type"     => $type,
            "instagram"      => (isset($postdata['instagram']) && strtolower($postdata['instagram']) == 'yes') ? 1 : 0,
            "facebook"       => (isset($postdata['Facebook']) && strtolower($postdata['Facebook']) == 'yes') ? 1 : 0,
            "youtube"        => (isset($postdata['Youtube']) && strtolower($postdata['Youtube']) == 'yes') ? 1 : 0,
            "schedule"       => (isset($postdata['schedule']) && strtolower($postdata['schedule']) == 'yes') ? 1 : 0,
            "schedule_time"  => $timestamp,
            "created_at"     => date("Y-m-d H:i:s")
        ];
        $this->CI->db->insert('auto_post', $data);
        return $this->CI->db->insert_id();
    }

    private function resolveVoiceGenderId($gender) {
        $voices = ["henry","oliver","joe", "george","rob","carly","kristy","tasha", "lisa","emily"];
        return $voices[(strtolower($gender) === "male") ? rand(0, 4) : ((strtolower($gender) === "female") ? rand(5, 9) : rand(0, 9))];
    }

    private function resolveRandomAvatarAsset($gender) {
        $images = ['newavatar1.png', 'newavatar5.png', 'newavatar11.png', 'newavatar7.png', 'newavatar10.png', 'newavatar13.png', 'newavatar14.png', 'newavatar15.png', 'newavatar16.png', 'newavatar17.png'];
        return 'https://cdn.socialclawai.com/assets/uploads/avatar/talking_photo/' . $images[(strtolower($gender) === "male") ? rand(0, 4) : ((strtolower($gender) === "female") ? rand(5, 9) : rand(0, 9))];
    }

    private function triggerDupDubAvatarCreation($imagePath, $audioUrl) {
        $headers = ["dupdub_token: " . $this->dupdub_api_key, "Content-Type: application/json"];
        $ch1 = curl_init("https://moyin-gateway.dupdub.com/tts/v1/photoProject/detectAvatar");
        curl_setopt_array($ch1, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => json_encode(["photoUrl" => $imagePath]), CURLOPT_HTTPHEADER => $headers]);
        $box_res = json_decode(curl_exec($ch1), true); curl_close($ch1);
        if (empty($box_res['data']['boxes'])) return false;

        $boxessize = [$box_res['data']['boxes'][0][0], $box_res['data']['boxes'][0][1], $box_res['data']['boxes'][0][2], $box_res['data']['boxes'][0][3]];
        $ch2 = curl_init("https://moyin-gateway.dupdub.com/tts/v1/photoProject/createMulti");
        curl_setopt_array($ch2, [
            CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode(["photoUrl" => $imagePath, "info" => [["audioUrl" => $audioUrl, "box" => $boxessize]], "watermark" => 0, "useSr" => false])
        ]);
        $proj_res = json_decode(curl_exec($ch2), true); curl_close($ch2);
        return $proj_res['data']['id'] ?? false;
    }
}