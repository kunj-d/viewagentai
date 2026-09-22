<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class AnalyzeVideo_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        $this->checkAlreadyLogout();
        require_once APPPATH . "libraries/youtube/vendor/autoload.php";
        $this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->load->model('default/Youtube_integration_model');
        $this->dupdub_api_key = $this->config->item('dupdub_api_key');
        $this->openaikey = $this->config->item('open_ai_key');
        $this->youtubeApiKey = $this->config->item('youtube_api_key');
        $this->analyz_data = 'analyz_data';

    }
    public function analyz()
    {
        $this->db->where('business_id', $this->business_id);
        $youtube_access_token = $this->db->get('youtube_access_token')->row_array();
        $data['youtube_access_token'] = $youtube_access_token;
        $this->loadView('youtubetools/analyz', $data);
    }

    public function send_id()
    {
        $id = $this->input->post('id');
        $this->session->set_userdata('id', $id);
        redirect('video-analyzer');
    }


    public function videoanalyzer()
    {
        $data['id'] = $this->session->userdata('id');
        $data['url'] = $this->session->flashdata('url');
        $this->loadView('youtubetools/videoanalyzer', $data);
    }

    public function sendurl()
    {
        $url = $this->input->post('url');
        $this->session->set_flashdata('url', $url);
        redirect('video-analyzer');
    }
    
     public function youtubeGrow()
    {
        
        if(!in_array('youtube_growth',$this->session->userdata('features'))) {
            $output['error']['type'] = 'flash';
            $output['error']['message'] = 'Please upgrade your plan';
            $this->session->set_flashdata('message', json_encode($output));
            redirect('subscription');
         }
        // $url = $this->input->post('url');
        // $this->session->set_flashdata('url', $url);
       $this->loadView('youtubetools/youtubegrow', $data);
    }



    // public function analyzeVideo()
    // {
    //     header('Content-Type: application/json');

    //     $url = trim($this->input->post('videourl'));

    //     if (empty($url)) {
    //         echo json_encode([
    //             'success' => false,
    //             'msg' => 'Youtube Video URL is required'
    //         ]);
    //         exit;
    //     }

    //     $result = $this->analyzeYoutubeVideo($url);
        


    //     $video_id = $result['video_id'];

    //     $data = [
    //         'user_id' => $this->user_id,
    //         'business_id' => $this->business_id,
    //         'thumbnail' => $result['video_info']['thumbnail'],
    //         'video_url' => $result['video_info']['video_url'],
    //         'video_id' => $video_id,
    //         'title' => $result['video_info']['title'],
    //         'summary' => $result['ai_analysis']['summary'] ?? '',
    //         'engagement_rate' => $result['engagement_rate'],

    //         'ai_visibility_score' => $result['ai_analysis']['scores']['ai_visibility_score'],
    //         'answer_engine_score' => $result['ai_analysis']['scores']['answer_engine_score'],
    //         'generative_search_score' => $result['ai_analysis']['scores']['generative_search_score'],
    //         'content_readiness_score' => $result['ai_analysis']['scores']['content_readiness_score'],

    //         'ai_visibility_status' => $result['ai_analysis']['status_labels']['ai_visibility'],
    //         'answer_engine_status' => $result['ai_analysis']['status_labels']['answer_engine'],
    //         'generative_search_status' => $result['ai_analysis']['status_labels']['generative_search'],
    //         'content_readiness_status' => $result['ai_analysis']['status_labels']['content_readiness'],

    //         'thumbnail_analytics' => json_encode($result['ai_analysis']['thumbnail_analytics']),
    //         'issues' => json_encode($result['ai_analysis']['issues']),
    //         'opportunities' => json_encode($result['ai_analysis']['opportunities']),
    //         'keywords' => json_encode($result['ai_analysis']['keywords']),
    //         'video_info' => json_encode($result['video_info']),
    //         'optimized_value' => "",
    //     ];
        
        

    //     // 🔍 Check if video_id already exists
    //     $this->db->where('video_id', $video_id);
    //     $query = $this->db->get($this->analyz_data);

    //     if ($query->num_rows() > 0) {
    //         // ✅ UPDATE
    //         $this->db->where('video_id', $video_id);
    //         $this->db->update($this->analyz_data, $data);

    //         $existing = $query->row_array();
    //         $insert_id = $existing['id'];

    //     } else {
    //         // ✅ INSERT
    //         $this->db->insert($this->analyz_data, $data);
    //         $insert_id = $this->db->insert_id();
    //     }

    //     $this->session->set_userdata('id', $insert_id);

    //     if (!empty($insert_id)) {
    //         echo json_encode([
    //             'success' => true,
    //             'msg' => 'Data saved successfully',
    //             'analyze_data' => $result,
    //             'id' => $insert_id
    //         ]);
    //     } else {
    //         echo json_encode([
    //             'success' => false,
    //             'msg' => 'Something went wrong',
    //             'error' => $result
    //         ]);
    //     }

    //     exit;
    // }
    
        public function analyzeVideo()
    {
        header('Content-Type: application/json');
    
        $url = trim($this->input->post('videourl'));
    
        if (empty($url)) {
            echo json_encode([
                'success' => false,
                'msg' => 'Youtube Video URL is required'
            ]);
            exit;
        }
    
        $result = $this->analyzeYoutubeVideo($url);
        
        $video_id = $result['video_id'];
    
        if (!function_exists('getStatusLabel')) {
            function getStatusLabel($score) {
                if ($score <= 40) return 'Needs Work';
                if ($score <= 70) return 'Average';
                return 'Good';
            }
        }
    
        $ai_visibility_score    = $result['ai_analysis']['scores']['ai_visibility_score'] ?? 0;
        $answer_engine_score    = $result['ai_analysis']['scores']['answer_engine_score'] ?? 0;
        $generative_search_score = $result['ai_analysis']['scores']['generative_search_score'] ?? 0;
        $content_readiness_score = $result['ai_analysis']['scores']['content_readiness_score'] ?? 0;
    
        $ai_visibility_status    = getStatusLabel($ai_visibility_score);
        $answer_engine_status    = getStatusLabel($answer_engine_score);
        $generative_search_status = getStatusLabel($generative_search_score);
        $content_readiness_status = getStatusLabel($content_readiness_score);
    
        $result['ai_analysis']['status_labels']['ai_visibility']    = $ai_visibility_status;
        $result['ai_analysis']['status_labels']['answer_engine']    = $answer_engine_status;
        $result['ai_analysis']['status_labels']['generative_search'] = $generative_search_status;
        $result['ai_analysis']['status_labels']['content_readiness'] = $content_readiness_status;
    
        $data = [
            'user_id' => $this->user_id,
            'business_id' => $this->business_id,
            'thumbnail' => $result['video_info']['thumbnail'],
            'video_url' => $result['video_info']['video_url'],
            'video_id' => $video_id,
            'title' => $result['video_info']['title'],
            'summary' => $result['ai_analysis']['summary'] ?? '',
            'engagement_rate' => $result['engagement_rate'],
    
            'ai_visibility_score' => $ai_visibility_score,
            'answer_engine_score' => $answer_engine_score,
            'generative_search_score' => $generative_search_score,
            'content_readiness_score' => $content_readiness_score,
    
            'ai_visibility_status' => $ai_visibility_status,
            'answer_engine_status' => $answer_engine_status,
            'generative_search_status' => $generative_search_status,
            'content_readiness_status' => $content_readiness_status,
    
            'thumbnail_analytics' => json_encode($result['ai_analysis']['thumbnail_analytics']),
            'issues' => json_encode($result['ai_analysis']['issues']),
            'opportunities' => json_encode($result['ai_analysis']['opportunities']),
            'keywords' => json_encode($result['ai_analysis']['keywords']),
            'video_info' => json_encode($result['video_info']),
            'optimized_value' => "",
        ];
        
        $this->db->where('video_id', $video_id);
        $query = $this->db->get($this->analyz_data);
    
        // if ($query->num_rows() > 0) {
        //     $this->db->where('video_id', $video_id);
        //     $this->db->update($this->analyz_data, $data);
    
        //     $existing = $query->row_array();
        //     $insert_id = $existing['id'];
    
        // } else {
        //     $this->db->insert($this->analyz_data, $data);
        //     $insert_id = $this->db->insert_id();
        // }
        if ($query->num_rows() > 0) {

    $existing = $query->row_array();

    // Preserve optimized fields
    $data['optimized'] = $existing['optimized'];
    $data['optimized_score'] = $existing['optimized_score'];

    $this->db->where('video_id', $video_id);
    $this->db->update($this->analyz_data, $data);

    $insert_id = $existing['id'];

    // Current score
    if ($existing['optimized'] == 1) {
        $result['current_score'] = (int)$existing['optimized_score'];
    } else {
        $result['current_score'] = rand(40, 50);
    }

    // Also return optimized score

} else {

    $this->db->insert($this->analyz_data, $data);
    $insert_id = $this->db->insert_id();

    // New video is never optimized
    $result['current_score'] = rand(40, 50);
}
    
        $this->session->set_userdata('id', $insert_id);
    
        if (!empty($insert_id)) {
            echo json_encode([
                'success' => true,
                'msg' => 'Data saved successfully',
                'analyze_data' => $result, // Sahi status data yahan se Angular view par bind ho jayega
                'id' => $insert_id
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Something went wrong',
                'error' => $result
            ]);
        }
    
        exit;
    }

    //Extract Video ID
    public function extractVideoId($url)
    {
        preg_match('/(youtu\.be\/|v=|embed\/|shorts\/)([^\&\?\/]+)/', $url, $matches);
        return $matches[2] ?? null;
    }

    public function analyzeYoutubeVideo($youtubeUrl)
    {
        $videoId = $this->extractVideoId($youtubeUrl);
        // pr($videoId); die;

        if (!$videoId) {
            return ["status" => false, "message" => "Invalid YouTube URL"];
        }

        $videoData = $this->getVideoDetails($videoId);



        if (empty($videoData['items'])) {
            return ["status" => false, "message" => "Video not found"];
        }

        $item = $videoData['items'][0];
        $snippet = $item['snippet'];
        $stats = $item['statistics'];

        $view = (int) ($stats['viewCount'] ?? 0);
        $like = (int) ($stats['likeCount'] ?? 0);
        $comments = (int) ($stats['commentCount'] ?? 0);

        $engagementRate = ($view > 0) ? round((($like + $comments) / $view) * 100, 2) : 0;

        $channel_id = $snippet['channelId'];

        $views = $this->formatViews($view);
        $likes = $this->formatViews($like);

        $channelData = $this->getChannelDetails($channel_id);

        $videoInfo = [
            "title" => $snippet['title'] ?? '',
            "description" => $snippet['description'] ?? '',
            "tags" => $snippet['tags'] ?? [],
            "thumbnail" => $snippet['thumbnails']['medium']['url'] ?? '',
            "views" => $views,
            "likes" => $likes,
            "comments" => $comments,
            "engagement_rate" => $engagementRate,
            "video_url" => $youtubeUrl,
        ];

        // pr($videoInfo); die;
        

        $aiAnalysis = $this->analyzeWithAI($videoInfo);
        
        $channelInfo = [
                "channel_name" => $channelData['items'][0]['snippet']['title'] ?? '',
                "channelThumbnail" => $channelData['items'][0]['snippet']['thumbnails']['high']['url'] ?? '',
            ];
                
        $videoInfo = array_merge($videoInfo, $channelInfo);

        if (isset($aiAnalysis['error']) && $aiAnalysis['error'] == true) {
            return [
                "status" => false,
                "message" => "AI analysis failed",
                "error_data" => $aiAnalysis
            ];
        } else {
            return [
                "status" => true,
                "video_id" => $videoId,
                "video_info" => $videoInfo,
                "engagement_rate" => $engagementRate,
                "ai_analysis" => $aiAnalysis
            ];
        }

    }

    public function getVideoDetails($videoId)
    {
        $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id={$videoId}&key={$this->youtubeApiKey}";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($ch);

        // pr(json_decode($response, true)); die();

        if (curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        return json_decode($response, true);
    }

    public function getChannelDetails($channelId)
    {
        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id={$channelId}&key={$this->youtubeApiKey}";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        return json_decode($response, true);
    }


    public function analyzeWithAI($videoInfo)
    {

        $prompt = "You are a YouTube SEO & AEO (AI Engine Optimization) expert.

                    Analyze the given YouTube video data and return a COMPLETE analysis dashboard.

                    Return ONLY valid JSON.

                    Required JSON structure:

                    {

                      \"scores\": {

                        \"ai_visibility_score\": number,

                        \"answer_engine_score\": number,

                        \"generative_search_score\": number,

                        \"content_readiness_score\": number,

                        \"thumbnail_score\": number

                      },

                      \"status_labels\": {

                        \"ai_visibility\": \"Good|Average|Needs Work\",

                        \"answer_engine\": \"Good|Average|Needs Work\",

                        \"generative_search\": \"Good|Average|Needs Work\",

                        \"content_readiness\": \"Good|Average|Needs Work\",

                        \"thumbnail\": \"Good|Average|Needs Work\"

                      },

                      \"thumbnail_analytics\": [

                        \"Identifying patterns and meaning from thumbnail visuals\",

                        \"Systematic visual coding and structure evaluation\",

                        \"High flexibility for different audience interpretations\"

                      ],

                      \"issues\": [

                        {\"issue\": string, \"severity\": \"High|Medium|Low\"}

                      ],

                      \"opportunities\": [string],

                      \"keywords\": {

                        \"primary\": string,

                        \"related\": [string]

                      },

                      \"summary\": string

                    }

                    Rules:

                    - Scores must be 0–100

                    - Issues: 5–10 items

                    - Opportunities: 5–8 items

                    - Thumbnail analytics must be actionable and UI-friendly (short bullet points)

                    - Thumbnail analysis must consider:

                      - Visual clarity

                      - Color contrast

                      - Emotion / curiosity factor

                    - All scores, issues, opportunities and recommendations must reflect realistic YouTube ranking probability and not rely only on SEO or AEO metrics.

                    - Evaluate and infer rankings using real YouTube signals including Click-Through Rate (CTR), Average View Duration, Audience Retention, Watch Time, Engagement Rate (likes, comments, shares), Search Intent Satisfaction, Viewer Satisfaction Signals, and Channel Authority.

                    - Estimate scores based on the likelihood of ranking in YouTube Search, Suggested Videos and Browse Features.

                    - If certain metrics are missing, infer realistic benchmark values from the available video data and use conservative estimates rather than keyword-only assumptions.

                    - Prioritize actual ranking potential, viewer behaviour signals and content performance indicators over keyword density, tags and metadata optimization alone.
 
                    Video Data:"
                     . json_encode($videoInfo);


        $open_ai = new OpenAi($this->openaikey);
        $history[] = ["role" => "user", "content" => $prompt];

        $opt = [
            "model" => "gpt-5-mini",
            "messages" => $history,
            "temperature" => 1,
            "max_completion_tokens" => 6000,
        ];

        $response = $open_ai->chat($opt);

        $result = json_decode($response, true);

        $content = $result['choices'][0]['message']['content'] ?? '';

// pr($content);die;

        $content = trim($content);
        $content = preg_replace('/```json|```/', '', $content);

        $parsed = json_decode($content, true);

        if (!$parsed) {
            return [
                "error" => true,
                "raw" => $response
            ];
        }

        return $parsed;
    }


    public function optimize_data($encodedId = '')
    {
        // decode base64 id
        $encodedId = str_replace(['-', '_'], ['+', '/'], $encodedId);
        $padding = strlen($encodedId) % 4;
        if ($padding) {
            $encodedId .= str_repeat('=', 4 - $padding);
        }
        $id = base64_decode($encodedId);
        $data['id'] = $id;
        $this->loadView('youtubetools/optimizer', $data);
    }


    public function optimizeWithAI()
    {
        // $videoInfo = '{"title":"atlantic ocean\ud83c\udf0a View\ud83d\ude0e","description":"","tags":[],"thumbnail":"https:\/\/i.ytimg.com\/vi\/aEqgKNK4hnw\/mqdefault.jpg","views":7925538,"likes":90111,"comments":2140,"engagement_rate":1.1599999999999999200639422269887290894985198974609375,"video_url":"https:\/\/www.youtube.com\/watch?v=aEqgKNK4hnw","channel_name":"ammar and nazrana","channelThumbnail":"https:\/\/yt3.ggpht.com\/9S6wkJ8jQs3TEynM29AEQX3yfUyAhWKI7nw87yYKKm9eE8ZpTDZ2DEVaaq4ajMyhi0w_6bCK=s800-c-k-c0x00ffffff-no-rj"}';
        $id = $this->input->post('id');
        $videoInfo = $this->input->post('video_info');

        $open_ai = new OpenAi($this->openaikey);
        // $prompt = "You are a professional YouTube SEO + AEO expert focused on ranking, CTR, and audience engagement.

        //     Analyze the given video data and generate high-quality optimization suggestions that can realistically improve performance and push scores above 70.

        //     Return STRICT JSON only (no explanation, no markdown).

        //     {
        //       \"title_section\": {
        //         \"current_title\": string,
        //         \"current_score\": number,
        //         \"suggestions\": [
        //           {
        //             \"title\": string,
        //             \"score\": number,
        //             \"is_best\": boolean
        //           }
        //         ]
        //       },
        //       \"description_section\": {
        //         \"current_length\": number,
        //         \"score\": number,
        //         \"optimized_description\": string,
        //         \"key_points\": [string]
        //       },
        //       \"tags_section\": {
        //         \"current_count\": number,
        //         \"score\": number,
        //         \"suggested_tags\": [string]
        //       },
        //       \"aeo_score\": number,
        //       \"optimization_progress\": number,
        //       \"quick_recommendations\": [
        //         {
        //           \"text\": string,
        //           \"status\": \"done\" | \"pending\"
        //         }
        //       ]
        //     }

        //     Guidelines:
        //     - Titles must be high CTR, keyword-rich, and emotionally engaging
        //     - Include power words, numbers, or curiosity triggers where relevant
        //     - Description must be SEO + AEO optimized (first 2 lines highly clickable)
        //     - Tags must include long-tail, trending, and AI-search-friendly keywords
        //     - Scores must be realistic (avoid random low scoring unless necessary)
        //     - Give 3–5 title suggestions, mark ONLY ONE as \"is_best\": true
        //     - optimization_progress should reflect how optimized the video is overall
        //     - quick_recommendations must be actionable (minimum 4)
        //     - The description score MUST be higher than current_score
        //     - The AEO score MUST be higher than 90
        //     - The optimization_progress score MUST be higher than 70
        //     - If needed, improve content until score exceeds current_score

        //     Video Data: " . json_encode($videoInfo);
        
      $prompt = "You are a YouTube SEO + AEO expert focused on CTR, ranking, and engagement.
                    
                    Analyze the video data + thumbnail and return STRICT JSON only.
                    
                    {
                      \"title_section\": {
                        \"current_title\": string,
                        \"current_score\": number,
                        \"suggestions\": [{\"title\": string, \"score\": number, \"is_best\": boolean}]
                      },
                      \"description_section\": {
                        \"current_length\": number,
                        \"score\": number,
                        \"optimized_description\": string,
                        \"key_points\": [string]
                      },
                      \"tags_section\": {
                        \"current_count\": number,
                        \"score\": number,
                        \"suggested_tags\": [string]
                      },
                      \"thumbnail_variations\": [
                            {
                              \"variation\": number,
                              \"label\": string,
                              \"description\": string,
                              \"ctr_score\": number,
                              \"is_best\": boolean
                            }
                      \"aeo_score\": number,
                      \"optimization_progress\": number,
                      \"quick_recommendations\": [
                        {\"text\": string, \"status\": \"done\" | \"pending\"}
                      ]
                    }
                    
                    Rules:
                    - 3–5 high-CTR titles (1 best)
                    - Description: strong first 2 lines + better than current
                    - Tags: 10+ long-tail + trending
                    - Generate 3–4 thumbnail variations
                    - label = 'Variation 1', 'Variation 2'
                    - description = clear actionable instruction (like UI text)
                    - ctr_score = 70–100 realistic
                    - Mark ONLY ONE as is_best = true
                    - Best variation should have highest CTR score
                    - Make output directly usable for UI display
                    - aeo_score > 90, optimization_progress > 70
                    - Improve everything beyond current scores
                    
                    Video Data: " . json_encode($videoInfo);

        $open_ai = new OpenAi($this->openaikey);
        $history[] = ["role" => "user", "content" => $prompt];

        $opt = [
            "model" => "gpt-5-mini",
            "messages" => $history,
            "temperature" => 1,
            "max_completion_tokens" => 6000,
        ];

        $response = $open_ai->chat($opt);
        $result = json_decode($response, true);
        $content = $result['choices'][0]['message']['content'] ?? '';
        $optimze_data = array(
            'optimized_value' => $content,
            'Optimized' => 1
        );

        $this->db->where('id', $id);
        $result = $this->db->update($this->analyz_data, $optimze_data);

       if ($result) {

    // GPT returns JSON as string
    $optimized_value = json_decode($content, true);

    echo json_encode([
        'success' => true,
        'msg' => 'Data optimize successfully',
        'optimized_value' => $optimized_value
    ]);

} else {
            echo json_encode([
                'success' => false,
                'msg' => 'Somthing went wrong',
                'error' => $result
            ]);
        }

    }


    // public function get_analyz_data(){
    //     $id = $this->input->post('id');
    // 	$this->db->where('id', $id);
    // 	$query = $this->db->get($this->analyz_data);
    // 	$result = $query->row_array();

    // 	 if (!empty($result)) {
    //         echo json_encode([
    //             'success' => true,
    //             'analyze_data' => $result
    //         ]);
    //     } else {
    //         echo json_encode([
    //             'success' => false,
    //             'analyze_data' => ''
    //         ]);
    //     }

    // }
    public function get_analyz_data()
    {
        header('Content-Type: application/json');
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $query = $this->db->get($this->analyz_data);
        $result = $query->row_array();

        if (!empty($result)) {
            $this->db->where('business_id', $this->business_id);
            $this->db->where('user_id', $this->owner_id);
            $token_query = $this->db->get('youtube_access_token');

            $is_channel_connected = false;
            $connected_channel_id = '';
            $is_owner_of_video = false;

            if ($token_query->num_rows() > 0) {
                $is_channel_connected = true;
                $row_token = $token_query->row_array();

                // Decrypted or Parsed access token structure object
                $tokenData = json_decode($row_token['access_token'], true);
                $access_token = isset($tokenData['access_token']) ? $tokenData['access_token'] : null;

                if (empty($access_token)) {
                    $access_token = $this->session->userdata('yt_access_token')['access_token'] ?? null;
                }

                // Direct pure cURL se connected channel ID fetch karenge, bina kisi cross-controller dependency ke
                if (!empty($access_token)) {
                    try {
                        $url = 'https://youtube.googleapis.com/youtube/v3/channels?part=id&mine=true';
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            "Authorization: Bearer " . $access_token,
                            "Accept: application/json"
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        $response = curl_exec($ch);
                        curl_close($ch);

                        $channel_res = json_decode($response, true);
                        if (isset($channel_res['items'][0]['id'])) {
                            $connected_channel_id = $channel_res['items'][0]['id'];
                        }
                    } catch (Exception $e) {
                        // Fail-safe quiet
                    }
                }
            }

            // Target video structure verification map pointer
            if (!empty($connected_channel_id)) {
                $videoId = $result['video_id'];
                $video_details_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}&key={$this->youtubeApiKey}";

                $v_ch = curl_init($video_details_url);
                curl_setopt($v_ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($v_ch, CURLOPT_TIMEOUT, 10);
                $v_res = json_decode(curl_exec($v_ch), true);
                curl_close($v_ch);

                if (isset($v_res['items'][0]['snippet']['channelId'])) {
                    $video_actual_channel_id = $v_res['items'][0]['snippet']['channelId'];
                    // Agar connected channel aur video ka actual channel match hota hai
                    if ($video_actual_channel_id === $connected_channel_id) {
                        $is_owner_of_video = true;
                    }
                }
            }

            echo json_encode([
                'success' => true,
                'analyze_data' => $result,
                'is_channel_connected' => $is_channel_connected,
                'is_owner_of_video' => $is_owner_of_video
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'analyze_data' => '',
                'is_channel_connected' => false,
                'is_owner_of_video' => false
            ]);
        }
        exit;
    }


    public function analyz_data()
    {
        $this->loadView('youtubetools/all_analyz_data', $data);
    }

    // public function get_all_analyz_data()
    // {
    //     $this->db->where('business_id', $this->business_id);
    //     // $this->db->order_by('id', 'DESC');
    //     $this->db->order_by('updated_at', 'DESC');
    //     $query = $this->db->get($this->analyz_data);
    //     $result = $query->result_array();

    //     echo json_encode([
    //         'success' => true,
    //         'analyze_data' => $result
    //     ]);

    // }
    public function get_all_analyz_data()
    {
        $limit  = (int)$this->input->post('limit');
        $pageNo = (int)$this->input->post('pageNo');

        if ($limit <= 0) {
            $limit = 10;
        }

        if ($pageNo <= 0) {
            $pageNo = 1;
        }

        $offset = ($pageNo - 1) * $limit;

        $this->db->where('business_id', $this->business_id);
        $totalRecords = $this->db->count_all_results($this->analyz_data);

        $this->db->where('business_id', $this->business_id);
        $this->db->order_by('updated_at', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get($this->analyz_data);
        $result = $query->result_array();

        echo json_encode([
            'success'       => true,
            'analyze_data'  => $result,
            'recordsTotal'  => $totalRecords,
            'currentPage'   => $pageNo,
            'totalPages'    => ceil($totalRecords / $limit),
            'hasNext'       => ($pageNo * $limit) < $totalRecords,
            'hasPrev'       => $pageNo > 1
        ]);
    }

    public function delete_analyz_data()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $delete = $this->db->delete($this->analyz_data);

        if ($delete) {
            echo json_encode([
                'status' => true,
                'msg' => 'Analyze Data deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Failed to delete Analyz Data.'
            ]);
        }
    }

    public function update_title()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $new_title = trim($this->input->post('new_title'));

        if (empty($id) || empty($new_title)) {
            echo json_encode([
                'success' => false,
                'msg' => 'ID and New Title are required fields.'
            ]);
            exit;
        }

        // 1. Fetch current record from DB
        $this->db->where('id', $id);
        $query = $this->db->get($this->analyz_data);
        $row = $query->row_array();

        if (empty($row)) {
            echo json_encode([
                'success' => false,
                'msg' => 'Record not found.'
            ]);
            exit;
        }

        // 2. Parse optimized_value column and change current_title inside JSON
        $optimized_value_array = json_decode($row['optimized_value'], true);

        if (is_array($optimized_value_array) && isset($optimized_value_array['title_section'])) {
            $optimized_value_array['title_section']['current_title'] = $new_title;

            // Dynamic Score handling: Agar chosen title standard list me h, to current_score bhi badal do
            if (isset($optimized_value_array['title_section']['suggestions'])) {
                foreach ($optimized_value_array['title_section']['suggestions'] as $sug) {
                    if ($sug['title'] === $new_title) {
                        $optimized_value_array['title_section']['current_score'] = $sug['score'];
                        break;
                    }
                }
            }
        }

        // 3. Prepare data for updation
        $update_data = [
            'title' => $new_title,
            'optimized_value' => json_encode($optimized_value_array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        ];

        // 4. Update into DB
        $this->db->where('id', $id);
        $status = $this->db->update($this->analyz_data, $update_data);

        if ($status) {
            echo json_encode([
                'success' => true,
                'msg' => 'Title and database logs modified successfully.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to update database records.'
            ]);
        }
        exit;
    }


    public function ai_query()
    {
        $this->loadView('youtubetools/ai_query', $data);
    }

    public function generateQuery()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents("php://input"), true);

        $keyword = isset($input['keyword']) ? trim($input['keyword']) : '';
        $audience = isset($input['audience']) ? trim($input['audience']) : 'General';
        $language = isset($input['language']) ? trim($input['language']) : 'English';

        if (empty($keyword)) {
            echo json_encode([
                'status' => false,
                'message' => 'keyword is required'
            ]);
            return;
        }
        $data = $this->getAiQueries($keyword, $audience, $language);

        $queries = $data['queries'] ?? [];
        $queryInsights = $data['queryInsights'] ?? [];
        $popularIntent = $data['popularIntent'] ?? '';
        $topAISources = $data['topAISources'] ?? [];

        $totalQueries = count($queries);

        $intentStats = [];
        $sourceStats = [];

        foreach ($queries as $q) {
            if (isset($q['intent'])) {
                if (!isset($intentStats[$q['intent']])) {
                    $intentStats[$q['intent']] = 0;
                }
                $intentStats[$q['intent']]++;
            }

            if (isset($q['sources'])) {
                foreach ($q['sources'] as $sources) {
                    if (!isset($sourceStats[$sources])) {
                        $sourceStats[$sources] = 0;
                    }
                    $sourceStats[$sources]++;
                }
            }
        }
        echo json_encode([
            'status' => true,
            'keyword' => $keyword,
            'queries' => $queries,
            'totalQueries' => $totalQueries,
            'intentStats' => $intentStats,
            'sourceStats' => $sourceStats,
            'queryInsights' => $queryInsights,
            'popularIntent' => $popularIntent,
            'topAISources' => $topAISources
        ]);
    }

    private function getAiQueries($keyword, $audience, $language)
    {

        $prompt = "You are an Advanced AI Query Insights & Intent Analysis Engine.
        
                        Generate a complete AI Query Analytics Dashboard for the keyword: '{$keyword}'.
        
                        Audience: {$audience}
                        Language: {$language}
        
                        Rules:
        
                        1. Generate EXACTLY 25 realistic AI search queries.
        
                        2. Every query object must include:
                        - id
                        - query
                        - intent
                        - sources
        
                        3. Allowed intents:
                        - How To
                        - Problem
                        - Strategies
                        - Comparison
                        - Others
        
                        4. Allowed sources:
                        - ChatGPT
                        - Gemini
                        - Grok
                        - Claude
                        
        
                        5. Queries must look natural and human-generated.
        
                        6. Return ONLY valid JSON.
        
                        7. Do NOT return markdown.
        
                        Required JSON Structure:
        
                        {
                        \"queries\": [
                            {
                            \"id\": 1,
                            \"query\": \"how to grow youtube channel fast\",
                            \"intent\": \"How To\",
                            \"sources\": [\"ChatGPT\"]
                            }
                        ],
        
                        \"queryInsights\": {
                            \"totalQueries\": 20,
                            \"intentWiseCount\": {
                            \"How To\": 5,
                            \"Problem\": 4,
                            \"Strategies\": 4,
                            \"Comparison\": 3,
                            \"Others\": 4
                            },
                            \"intentWisePercentage\": {
                            \"How To\": \"25%\"
                            }
                        },
                        \"popularIntent\": \"How To\",
        
                        \"topAISources\": [
                            {
                            \"source\": \"ChatGPT\",
                            \"queryCount\": 10
                            }
                        ]
                        }
                        ";


        $response = $this->generateOpenAidata($prompt);
        $response = preg_replace('/```json|```/', '', $response);
        $data = json_decode(trim($response), true);
        return is_array($data) ? $data : [];
    }

    private function generateOpenAidata($prompt)
    {

        $open_ai = new OpenAi($this->config->item('open_ai_key'));
        $history[] = [
            "role" => "user",
            "content" => $prompt
        ];

        $opt = [
            "model" => "gpt-3.5-turbo",
            "messages" => $history,
            "temperature" => 0.5,
            "max_tokens" => 2200,
        ];

        $response = $open_ai->chat($opt);
        $data = json_decode($response, true);
        if (!isset($data["choices"][0]["message"]["content"])) {
            return '{"queries":[]}';
        }
        return $data["choices"][0]["message"]["content"];
    }

    public function formatViews($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }

        return $number;
    }

    public function lead_finder()
    {
        $this->loadView('youtubetools/channel_finder');
    }




    //         public function findLowGrowthChannels()
//         {
//             header('Content-Type: application/json');

    //             $keyword = 'entertainment';
//             // $keyword = $this->input->post('keyword');

    //             if (empty($keyword)) {
//                 echo json_encode(['success' => false, 'msg' => 'Keyword required']);
//                 return;
//             }

    //             $apiKey = $this->youtubeApiKey;

    //             // STEP 1: Search videos by keyword
//             $searchUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=20&q=" . urlencode($keyword) . "&key=" . $apiKey;

    //             $searchData = json_decode(file_get_contents($searchUrl), true);

    //             $channelIds = [];

    //             foreach ($searchData['items'] as $item) {
//                 $channelIds[] = $item['snippet']['channelId'];
//             }

    //             $channelIds = array_unique($channelIds);

    //             // STEP 2: Get channel details
//             $channelUrl = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=" . implode(',', $channelIds) . "&key=" . $apiKey;

    //             $channelData = json_decode(file_get_contents($channelUrl), true);


    // pr($channelData); die('here');
//             $lowGrowthChannels = [];

    //             foreach ($channelData['items'] as $channel) {

    //                 $subs = $channel['statistics']['subscriberCount'] ?? 0;
//                 $views = $channel['statistics']['viewCount'] ?? 0;
//                 $videos = $channel['statistics']['videoCount'] ?? 1;

    //                 $avgViews = $videos > 0 ? ($views / $videos) : 0;

    //                 // Channel age
//                 $created = strtotime($channel['snippet']['publishedAt']);
//                 $daysOld = (time() - $created) / (60 * 60 * 24);

    //                 // 🎯 FILTER (customize as needed)
//                 if ($subs < 50000 && $avgViews < 5000 && $daysOld > 180) {
//                     $lowGrowthChannels[] = [
//                         'title' => $channel['snippet']['title'],
//                         'channelId' => $channel['id'],
//                         'subs' => $subs,
//                         'avgViews' => round($avgViews),
//                         'totalViews' => $views,
//                         'videos' => $videos,
//                         'created_at' => date('Y-m-d', $created)
//                     ];
//                 }
//             }

    //                                     pr($lowGrowthChannels); die('herdde');


    //             echo json_encode([
//                 'success' => true,
//                 'data' => $lowGrowthChannels
//             ]);
//         }


    public function search_channels()
    {
        header('Content-Type: application/json');

        $keyword = $this->input->post('keyword');

        if (empty($keyword)) {
            echo json_encode([
                'status' => false,
                'msg' => 'Keyword Missing'
            ]);
            return;
        }

        $searchUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=channel&maxResults=20&q=" . urlencode($keyword) . "&key=" . $this->youtubeApiKey;

        $response = @file_get_contents($searchUrl);

        if ($response === FALSE) {
            echo json_encode([
                'status' => false,
                'msg' => 'YouTube API Failed'
            ]);
            return;
        }

        $searchData = json_decode($response, true);

        $finalData = [];

        foreach ($searchData['items'] as $item) {

            $channelId = $item['snippet']['channelId'];

            $channelUrl = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id="
                . $channelId
                . "&key=" . $this->youtubeApiKey;

            $channelResponse = @file_get_contents($channelUrl);

            if ($channelResponse === FALSE)
                continue;

            $channelData = json_decode($channelResponse, true);

            if (empty($channelData['items']))
                continue;

            $channel = $channelData['items'][0];

            $title = $channel['snippet']['title'] ?? '';
            $customurl = $channel['snippet']['customUrl'] ?? '';
            $description = $channel['snippet']['description'] ?? '';
            $thumbnail = $channel['snippet']['thumbnails']['medium']['url'] ?? '';
            $subs = $channel['statistics']['subscriberCount'] ?? 0;
            $viewcount = $channel['statistics']['viewCount'] ?? 0;
            $videocount = $channel['statistics']['videoCount'] ?? 0;
            $channelThumbnail = $channel['snippet']['thumbnails']['high']['url'] ?? '';

            $view_count = $this->formatViews($viewcount);
            $video_count = $this->formatViews($videocount);
            $subs_count = $this->formatViews($subs);

            // EMAIL
            preg_match_all('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/', $description, $emails);

            // INSTAGRAM
            preg_match_all('/https?:\/\/(www\.)?instagram\.com\/[^\s]+/i', $description, $insta);

            // WEBSITE
            preg_match_all('/https?:\/\/[^\s]+/i', $description, $websites);

            // PHONE
            preg_match_all('/(\+?\d{1,3}[\s\-]?)?(\(?\d{2,4}\)?[\s\-]?)?[\d\s\-]{6,15}\d/', $description, $phones);

            $finalData[] = [
                'thumbnail' => $channelThumbnail,
                'channelname' => $title,
                'customurl' => $customurl,
                'thumbnail' => $thumbnail,
                'subs' => $subs_count,
                'viewcount' => $view_count,
                'videocount' => $video_count,
                'email' => !empty($emails[0]) ? implode(", ", array_unique($emails[0])) : 'N/A',
                'phone' => !empty($phones[0]) ? implode(", ", array_unique($phones[0])) : 'N/A',
                'instagram' => !empty($insta[0]) ? implode(", ", array_unique($insta[0])) : 'N/A',
                'website' => !empty($websites[0]) ? implode(", ", array_unique($websites[0])) : 'N/A',
            ];
        }


        if (!empty($finalData)) {
            echo json_encode([
                'success' => true,
                'msg' => 'Channels Find Successfully',
                'channel_data' => $finalData
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Something went wrong',
                'channel_data' => $finalData
            ]);
        }

    }


    public function save_channel()
    {

        $user_id = $this->user_id;
        $business_id = $this->business_id;


        $rawData = file_get_contents('php://input');
        $post = json_decode($rawData, true);


        $data = [
            'user_id' => $user_id,
            'business_id' => $business_id,
            'thumbnail' => $post['thumbnail'],
            'name' => $post['name'],
            'customurl' => $post['customurl'],
            'views' => $post['views'],
            'email' => $post['email'],
            'phone' => $post['phone'],
            'subscriber' => $post['subscriber'],
            'videos' => $post['videos']
        ];

        $inserted = $this->db->insert('youtube_channel', $data);

        if ($inserted) {

            echo json_encode([
                'status' => true,
                'message' => 'channel saved successfully!'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Database insert failed.'
            ]);
        }
    }

    public function get_channel_data()
    {
        $this->db->where('business_id', $this->business_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('youtube_channel');
        $result = $query->result_array();

        echo json_encode([
            'success' => true,
            'channel_data' => $result
        ]);

    }


    public function delete_channel_data()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $delete = $this->db->delete('youtube_channel');

        if ($delete) {
            echo json_encode([
                'status' => true,
                'msg' => 'Channel deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Failed to delete Channel.'
            ]);
        }
    }

    public function image_analyze()
    {
        header('Content-Type: application/json');

        $imageUrl = "https://yt3.ggpht.com/Hq0IIALd7_WCaffO0tvZCkDEUQ8kI9yTUJh0i2jXMt7C63-jI22Qr2ykxPFyKb_RNBvSzGVY=s800-c-k-c0x00ffffff-no-rj";

        if (empty($imageUrl)) {
            echo json_encode([
                "status" => false,
                "message" => "image_url required"
            ]);
            exit;
        }

        // 🔍 Analyze
        $analysis = $this->analyzeImage($imageUrl);

        // 🎯 Improve same image
        $improvedImage = $this->improveImage($imageUrl);

        echo json_encode([
            "status" => true,
            "image_url" => $imageUrl,
            "analysis" => $analysis,
            "improved_image" => $improvedImage
        ], JSON_PRETTY_PRINT);
    }

    private function analyzeImage($imageUrl)
    {
        $payload = [
            "model" => "gpt-4.1",
            "input" => [
                [
                    "role" => "user",
                    "content" => [
                        [
                            "type" => "input_text",
                            "text" => "
                                    Analyze this YouTube thumbnail deeply.

                                    Return:
                                    1. CTR Score
                                    2. Viral Potential
                                    3. Thumbnail Quality
                                    4. Text Readability
                                    5. Emotion Trigger
                                    6. Color Psychology
                                    7. Weak Points
                                    8. Improvement Suggestions
                                    9. Better Thumbnail Ideas
                                    10. Suggested Titles
    "
                        ],
                        [
                            "type" => "input_image",
                            "image_url" => $imageUrl
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->curlJson(
            "https://api.openai.com/v1/responses",
            $payload
        );

        $result = json_decode($response, true);

        return $result['output'][0]['content'][0]['text'] ?? $result;
    }
    private function improveImage($imageUrl)
    {
        $imageData = file_get_contents($imageUrl);

        if (!$imageData) {
            return ["error" => "Unable to download image"];
        }

        // ✅ FORCE CONVERT TO JPG (fixes ALL mime issues)
        $image = @imagecreatefromstring($imageData);

        if (!$image) {
            return ["error" => "Invalid image format"];
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'img') . '.jpg';

        imagejpeg($image, $tempFile, 90);
        imagedestroy($image);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.openai.com/v1/images/edits",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . $this->openaikey
            ],
            CURLOPT_POSTFIELDS => [
                "model" => "gpt-image-1",
                "image" => new CURLFile($tempFile, "image/jpeg", "thumbnail.jpg"),
                "prompt" => "
                        Improve this YouTube thumbnail for HIGH CTR.

                        Keep same content but enhance:
                        - brightness & contrast
                        - sharpness
                        - vibrant colors
                        - subject focus
                        - clarity
                        - make it eye-catching and clickable

                        Style: MrBeast, viral, cinematic lighting "
            ],
            CURLOPT_TIMEOUT => 60
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ["error" => curl_error($ch)];
        }

        curl_close($ch);
        unlink($tempFile);

        $result = json_decode($response, true);

        return $result['data'][0]['url'] ?? $result;
    }


    private function curlJson($url, $payload)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->openaikey
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 60
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return json_encode([
                "error" => curl_error($ch)
            ]);
        }

        curl_close($ch);

        return $response;
    }





}

