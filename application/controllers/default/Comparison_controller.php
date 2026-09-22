<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Comparison_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        $this->checkAlreadyLogout();
        require_once APPPATH . "libraries/youtube/vendor/autoload.php";
        $this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->dupdub_api_key = $this->config->item('dupdub_api_key');
        $this->openaikey = $this->config->item('open_ai_key');
        $this->youtubeApiKey = $this->config->item('youtube_api_key');

        // ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    }


    public function competitor_spy()
    {
        $this->loadView('youtubetools/compitetorspy', $data);
    }

    public function resolveChannelId($input)
{
    $input = trim($input);

    if (empty($input)) {
        return null;
    }

    // 1. Agar input direct Channel ID hai (UC...)
    if (preg_match('/^UC[a-zA-Z0-9_-]{20,}$/', $input)) {
        return $input;
    }

    // 2. Agar input directly @handle hai (jaise @technicalguruji)
    if (strpos($input, '@') === 0) {
        $handle = str_replace('@', '', $input);
        return $this->getChannelId($handle);
    }

    // 3. Agar input ek URL hai (jaise https://youtube.com/@technicalguruji?si=...)
    if (filter_var($input, FILTER_VALIDATE_URL) || strpos($input, 'youtube.com') !== false) {
        $parsedUrl = parse_url($input);
        $path = trim($parsedUrl['path'] ?? '', '/'); // handles '@username' or 'channel/UC...'
        
        // Agar URL /channel/UCxxxxx format mein hai
        if (strpos($path, 'channel/') === 0) {
            return str_replace('channel/', '', $path);
        }

        // Agar URL mein segment separate ho rhe hain
        $parts = explode('/', $path);
        $handle = end($parts);
        
        $handle = str_replace('@', '', $handle);
        return $this->getChannelId($handle);
    }

    return $this->getChannelId($input);
}

    public function getChannelId($query)
    {
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&type=channel&q=" . urlencode($query) . "&key=" . $this->youtubeApiKey;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($ch);
        // print_r($response); die("ak");

        if (curl_errno($ch)) {
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        $data = json_decode($response, true);
        return $data['items'][0]['snippet']['channelId'] ?? null;
    }

    public function getChannelDetails($channelId)
    {
        $url = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id={$channelId}&key={$this->youtubeApiKey}";

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

        $data = json_decode($response, true);

        if (!empty($data['items'][0])) {
            $item = $data['items'][0];

            return [
                'title' => $item['snippet']['title'],
                'thumbnail' => $item['snippet']['thumbnails']['default']['url'],
                'subscribers' => (int) $item['statistics']['subscriberCount'],
                'views' => (int) $item['statistics']['viewCount'],
                'videos' => (int) $item['statistics']['videoCount']
            ];
        }
        return [];
    }

    public function getTopVideos($channelId)
    {
        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId={$channelId}&type=video&maxResults=10&order=viewCount&key={$this->youtubeApiKey}";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if (empty($data['items'])) {
            return [];
        }

        $videoIds = [];

        foreach ($data['items'] as $item) {

            if (!empty($item['id']['videoId'])) {
                $videoIds[] = $item['id']['videoId'];
            }
        }

        if (empty($videoIds)) {
            return [];
        }

        $ids = implode(",", $videoIds);

        $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id={$ids}&key={$this->youtubeApiKey}";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        $videos = json_decode($response, true);

        $result = [];

        if (empty($videos['items'])) {
            return [];
        }

        foreach ($videos['items'] as $v) {

            $s = $v['statistics'] ?? [];

            $result[] = [
                'title' => $v['snippet']['title'] ?? '',
                'thumbnail' => $v['snippet']['thumbnails']['medium']['url'] ?? '',
                'views' => (int) ($s['viewCount'] ?? 0),
                'likes' => (int) ($s['likeCount'] ?? 0),
                'comments' => (int) ($s['commentCount'] ?? 0),
                'published_date' => !empty($v['snippet']['publishedAt'])
                    ? date('M d, Y', strtotime($v['snippet']['publishedAt']))
                    : ''
            ];
        }

        usort($result, function ($a, $b) {
            return $b['views'] <=> $a['views'];
        });

        return $result;
    }

    public function analyzeChannelWithAI($channelData, $inputUrl)
    {
        $prompt = "You are an AI Competitor Intelligence System.

        Analyze the given YouTube Channel + Top Videos data and return a COMPLETE AI Competitor Spy Dashboard.

        Return ONLY valid JSON.

        Required JSON structure:

        {
        \"AI_Competitor_Spy_Dashboard\": {

            \"Analyzed_Asset\": {
            \"type\": \"YouTube Channel / Video Ecosystem\",
            \"input_url\": \"$inputUrl\"
            },

            \"Overall_Score\": {

            \"AEO_Visibility_Score\": {
                \"score\": number,
                \"label\": \"Excellent|Good|Average|Needs Work\",
                \"growth\": string
            },

            \"SEO_Strength\": {
                \"score\": number,
                \"label\": \"Excellent|Good|Average|Needs Work\",
                \"growth\": string
            },

            \"AI_Discoverability\": {
                \"score\": number,
                \"label\": \"Excellent|Good|Average|Needs Work\",
                \"growth\": string
            },

            \"Viral_Potential\": {
                \"score\": number,
                \"label\": \"Excellent|Good|Average|Needs Work\",
                \"growth\": string
            }
            },

            \"Performance_Overview\": {

                \"Total_Views\": {
                    \"growth\": string,
                    \"trend\": \"Up|Stable|Down\"
                },

                \"Avg_Views_Per_Video\": {
                    \"growth\": string,
                    \"trend\": \"Up|Stable|Down\"
                },

                \"Engagement_Rate\": {
                    \"growth\": string,
                    \"trend\": \"Up|Stable|Down\"
                },

                \"Top_AI_Rank_Keywords\": {
                    \"growth\": string,
                    \"trend\": \"Up|Stable|Down\"
                }
                },

            \"Top_AI_Mentions\": {
            \"count\": number,
            \"growth\": string,
            \"platforms\": [
                {
                \"Platform\": \"ChatGPT\",
                \"Mentions\": string,
                \"Growth\": string
                },
                {
                \"Platform\": \"Gemini\",
                \"Mentions\": string,
                \"Growth\": string
                },
                {
                \"Platform\": \"Grok\",
                \"Mentions\": string,
                \"Growth\": string
                },
                {
                \"Platform\": \"Claude\",
                \"Mentions\": string,
                \"Growth\": string
                }
            ]
            },

            \"Estimated_AI_Traffic\": {
            \"monthly_traffic\": string,
            \"growth\": string,
            \"label\": \"Low|Medium|High\"
            },

            \"High_Performing_Topics\": [
            {
                \"Topic\": string,
                \"Estimated_AI_Traffic\": string,
                \"AEO_Score\": number
            }
            ],

            \"Top_Performing_Videos\": [
            {
                \"title\": string,
                \"thumbnail\": string,
                \"published_date\": string,
                \"views\": string,
                \"engagement_rate\": string,
                \"aeo_score\": number,
                \"search_volume\": string,
                \"competition\": \"High|Medium|Low\"
            }
            ],

            \"Top_Content_Gaps\": [
            {
                \"Keyword_Query\": string,
                \"Search_Volume\": string,
                \"Competition\": \"High|Medium|Low\"
            }
            ],

            \"Top_AI_Rank_Keywords\": {
            \"Keyword_Optimization_Score\": {
                \"score\": number,
                \"growth\": string
            },
            \"keywords\": [string]
            },

            \"summary\": string
        }
        }

        Rules:
        - Scores must be between 0-100
        - growth must be realistic like +12%
        - labels must depend on scores
        - 80+ = Excellent
        - 65-79 = Good
        - 45-64 = Average
        - below 45 = Needs Work
        - AI Traffic should include realistic monthly estimate
        - Detect high performing topics from titles
        - Keep output clean JSON only
        - No markdown
        - No explanation outside JSON
        - Growth values should be realistic estimated monthly growth percentages
        - trend should depend on engagement, views and topic momentum
        - Generate realistic video engagement percentages
        - Generate realistic AEO score for every video
        - Use channel videos data to estimate top performing videos
        - Thumbnail can be empty string if unavailable
        - published_date should be realistic
        - Use provided published_date from channel data
        - Do NOT generate fake published dates
        - Use exact video metadata from input data

        Channel Data:
        " . json_encode($channelData);

        $open_ai = new OpenAi($this->openaikey);

        $history[] = [
            "role" => "user",
            "content" => $prompt
        ];

        $opt = [
            "model" => "gpt-5-mini",
            "messages" => $history,
            "temperature" => 1,
            "max_completion_tokens" => 6000,
        ];

        $response = $open_ai->chat($opt);

        $result = json_decode($response, true);

        $content = $result['choices'][0]['message']['content'] ?? '';
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



    // public function competitorSpyAnalyze()
    // {
    //     header('Content-Type: application/json');
    //     $urlInput = trim($this->input->post('channel_url'));
    //     $idInput = trim($this->input->post('channel_id'));
    //     // $input = trim($this->input->post('channel'));
    //     $input = "";

    //     if (!empty($urlInput)) {
    //         $input = $urlInput;
    //     } elseif (!empty($idInput)) {
    //         $input = $idInput;
    //     }

    //     if (!$input) {
    //         echo json_encode(['status' => false, 'message' => 'Input required']);
    //         exit;
    //     }

    //     // Resolve ID
    //     $channelId = $this->resolveChannelId($input);

    //     if (!$channelId) {
    //         echo json_encode(['status' => false, 'message' => 'Invalid Channel Name or ID. Please check and try again.']);
    //         exit;
    //     }

    //     // Data
    //     $channel = $this->getChannelDetails($channelId);

    //     if (empty($channel)) {
    //         echo json_encode(['status' => false, 'message' => 'Channel details could not be fetched.']);
    //         exit;
    //     }

    //     $videos = $this->getTopVideos($channelId);

    //     if (empty($videos)) {
    //         echo json_encode(['status' => false, 'message' => 'No videos']);
    //         exit;
    //     }

    //     // Avg calc
    //     $totalViews = $totalLikes = $totalComments = 0;

    //     foreach ($videos as $v) {
    //         $totalViews += $v['views'];
    //         $totalLikes += $v['likes'];
    //         $totalComments += $v['comments'];
    //     }

    //     $count = count($videos);

    //     $avgViews = round($totalViews / $count);
    //     $engagement = $avgViews > 0
    //         ? round((($totalLikes + $totalComments) / $avgViews) * 100, 2)
    //         : 0;

    //     $data = [
    //         'channel' => $channel,
    //         'videos' => $videos,
    //         'avg_views' => $avgViews,
    //         'engagement_rate' => $engagement
    //     ];

    //     // AI
    //     $ai = $this->analyzeChannelWithAI($data, $input);

    //     echo json_encode([
    //         'status' => true,
    //         'channel' => $channel,
    //         'avg_views' => $avgViews,
    //         'engagement_rate' => $engagement,
    //         'videos' => $videos,
    //         'ai_analysis' => $ai
    //     ]);
    // }

    public function competitorSpyAnalyze()
    {
        header('Content-Type: application/json');
        $urlInput = trim($this->input->post('channel_url'));
        $idInput = trim($this->input->post('channel_id'));
        $input = "";

        if (!empty($urlInput)) {
            $input = $urlInput;
        } elseif (!empty($idInput)) {
            $input = $idInput;
        }

        if (!$input) {
            echo json_encode(['status' => false, 'message' => 'Input required']);
            exit;
        }

        $channelId = $this->resolveChannelId($input);
        if (!$channelId) {
            echo json_encode(['status' => false, 'message' => 'Invalid Channel Name or ID.']);
            exit;
        }

        $channel = $this->getChannelDetails($channelId);
        if (empty($channel)) {
            echo json_encode(['status' => false, 'message' => 'Channel details could not be fetched.']);
            exit;
        }

        $videos = $this->getTopVideos($channelId);
        if (empty($videos)) {
            echo json_encode(['status' => false, 'message' => 'No videos']);
            exit;
        }

        $totalViews = $totalLikes = $totalComments = 0;
        foreach ($videos as &$v) {
            $totalViews += $v['views'];
            $totalLikes += $v['likes'];
            $totalComments += $v['comments'];
            // Individual video raw views format karne ke liye helper call kiya:
            $v['formatted_views'] = $this->formatViews($v['views']);
        }

        $count = count($videos);
        $avgViewsRaw = round($totalViews / $count);
        $engagement = $avgViewsRaw > 0 ? round((($totalLikes + $totalComments) / $avgViewsRaw) * 100, 2) : 0;

        // Formatted strings structure pass karne ke liye:
        $channel['formatted_views'] = $this->formatViews($channel['views']);
        $channel['formatted_subscribers'] = $this->formatViews($channel['subscribers']);
        $avgViewsFormatted = $this->formatViews($avgViewsRaw);

        $data = [
            'channel' => $channel,
            'videos' => $videos,
            'avg_views' => $avgViewsRaw,
            'engagement_rate' => $engagement
        ];

        $ai = $this->analyzeChannelWithAI($data, $input);

        echo json_encode([
            'status' => true,
            'channel' => $channel,
            'avg_views' => $avgViewsRaw,
            'avg_views_formatted' => $avgViewsFormatted,
            'engagement_rate' => $engagement,
            'videos' => $videos,
            'ai_analysis' => $ai
        ]);
    }

    // public function export_pdf_report()
    // {
    //     if (ob_get_contents())
    //         ob_end_clean();
    //     require_once APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php';

    //     $data_json = $this->input->post('pdf_data');
    //     $d = json_decode($data_json, true);
    //     $channel = $d['channel'];
    //     $ai = $d['ai_analysis']['AI_Competitor_Spy_Dashboard'];

    //     $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    //     $pdf->SetMargins(10, 10, 10);
    //     $pdf->setPrintHeader(false);
    //     $pdf->setPrintFooter(false);
    //     $pdf->AddPage();

    //     // Custom CSS for Dashboard Look
    //     $html = '
    //     <style>
    //         .header-card { background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 10px; }
    //         .title { font-size: 16pt; font-weight: bold; color: #111827; }
    //         .sub-text { font-size: 9pt; color: #6b7280; }
    //         .stat-label { font-size: 8pt; color: #6b7280; font-weight: bold; }
    //         .stat-value { font-size: 12pt; font-weight: bold; color: #111827; }
    //         .stat-change { font-size: 8pt; color: #ef4444; }
    //         .section-header { font-size: 11pt; font-weight: bold; color: #111827; margin-bottom: 10px; }
    //         .card-box { border: 1px solid #e5e7eb; background-color: #ffffff; padding: 10px; }
    //         .table-head { background-color: #f9fafb; font-weight: bold; font-size: 8pt; color: #374151; }
    //         .score-red { color: #ef4444; font-weight: bold; font-size: 14pt; }
    //     </style>

    //     <div class="dashboard">
    //         <table cellpadding="10" class="header-card" width="100%">
    //             <tr>
    //                 <td width="12%"><img src="' . $channel['thumbnail'] . '" width="45"></td>
    //                 <td width="33%">
    //                     <span class="title">' . $channel['title'] . '</span><br>
    //                     <span class="sub-text">' . number_format($channel['subscribers']) . ' subscribers • ' . number_format($channel['videos']) . ' videos</span>
    //                 </td>
    //                 <td width="18%" align="center" style="border-left: 1px solid #eee;">
    //                     <span class="stat-label">AEO Visibility Score</span><br>
    //                     <span class="score-red">' . $ai['Overall_Score']['AEO_Visibility_Score']['score'] . '</span><span class="sub-text">/100</span>
    //                 </td>
    //                 <td width="18%" align="center" style="border-left: 1px solid #eee;">
    //                     <span class="stat-label">High Performing Topics</span><br>
    //                     <span class="stat-value">' . count($ai['High_Performing_Topics']) . '</span><br><span class="sub-text">Topics identified</span>
    //                 </td>
    //                 <td width="19%" align="center" style="border-left: 1px solid #eee;">
    //                     <span class="stat-label">Estimated AI Traffic</span><br>
    //                     <span class="stat-value">' . $ai['Estimated_AI_Traffic']['monthly_traffic'] . '</span><br><span class="stat-change">' . $ai['Estimated_AI_Traffic']['growth'] . '</span>
    //                 </td>
    //             </tr>
    //         </table>

    //         <br><br>

    //         <div class="section-header">Performance Overview</div>
    //         <table cellpadding="8" width="100%">
    //             <tr>
    //                 <td class="card-box" width="25%" align="center">
    //                     <span class="stat-label">Total Views</span><br>
    //                     <span class="stat-value">' . number_format($channel['views']) . '</span><br>
    //                     <span style="color:green; font-size:8pt;">' . $ai['Performance_Overview']['Total_Views']['growth'] . '</span>
    //                 </td>
    //                 <td class="card-box" width="25%" align="center">
    //                     <span class="stat-label">Avg. Views per Video</span><br>
    //                     <span class="stat-value">' . number_format($d['avg_views']) . '</span><br>
    //                     <span class="stat-change">' . $ai['Performance_Overview']['Avg_Views_Per_Video']['growth'] . '</span>
    //                 </td>
    //                 <td class="card-box" width="25%" align="center">
    //                     <span class="stat-label">Engagement Rate</span><br>
    //                     <span class="stat-value">' . round($d['engagement_rate'], 2) . '%</span><br>
    //                     <span style="color:green; font-size:8pt;">' . $ai['Performance_Overview']['Engagement_Rate']['growth'] . '</span>
    //                 </td>
    //                 <td class="card-box" width="25%" align="center">
    //                     <span class="stat-label">Top AI Rank Keywords</span><br>
    //                     <span class="stat-value">' . $ai['Top_AI_Rank_Keywords']['Keyword_Optimization_Score']['score'] . '</span><br>
    //                     <span style="color:green; font-size:8pt;">' . $ai['Top_AI_Rank_Keywords']['Keyword_Optimization_Score']['growth'] . '</span>
    //                 </td>
    //             </tr>
    //         </table>

    //         <br><br>

    //         <table cellpadding="0" width="100%">
    //             <tr>
    //                 <td width="55%" style="padding-right: 5px;">
    //                     <div class="section-header">Top Performing Videos</div>
    //                     <table border="0.1" cellpadding="5" style="border-color:#e5e7eb; font-size:8pt;">
    //                         <tr class="table-head">
    //                             <th width="55%">Video</th>
    //                             <th width="15%">Views</th>
    //                             <th width="15%">Eng.</th>
    //                             <th width="15%">AEO</th>
    //                         </tr>';
    //     foreach ($ai['Top_Performing_Videos'] as $v) {
    //         $html .= '<tr>
    //                                 <td>
    //                                     <table><tr>
    //                                         <td width="30"><img src="' . $v['thumbnail'] . '" width="25"></td>
    //                                         <td width="105">' . $v['title'] . '</td>
    //                                     </tr></table>
    //                                 </td>
    //                                 <td>' . $v['views'] . '</td>
    //                                 <td>' . $v['engagement_rate'] . '</td>
    //                                 <td style="color:red; font-weight:bold;">' . $v['aeo_score'] . '</td>
    //                             </tr>';
    //     }
    //     $html .= '</table>
    //                 </td>
                    
    //                 <td width="45%" style="padding-left: 5px;">
    //                     <div class="section-header">Top Performing Topics</div>
    //                     <table border="0.1" cellpadding="5" style="border-color:#e5e7eb; font-size:8pt;">
    //                         <tr class="table-head">
    //                             <th width="55%">Topic</th>
    //                             <th width="30%">Est. Traffic</th>
    //                             <th width="15%">AEO</th>
    //                         </tr>';
    //     foreach ($ai['High_Performing_Topics'] as $tp) {
    //         $html .= '<tr>
    //                                 <td>' . $tp['Topic'] . '</td>
    //                                 <td>' . $tp['Estimated_AI_Traffic'] . '</td>
    //                                 <td style="color:red; font-weight:bold;">' . $tp['AEO_Score'] . '</td>
    //                             </tr>';
    //     }
    //     $html .= '</table>
    //                 </td>
    //             </tr>
    //         </table>

    //         <br><br>

    //     <table cellpadding="0" cellspacing="0" border="0" width="100%">
    //         <tr>
    //             <td width="48%" valign="top">
    //                 <div class="section-header">&nbsp;Top AI Mentions</div>
    //                 <table border="0.1" cellpadding="7" cellspacing="0" style="border-color:#e5e7eb; background-color:#ffffff; width:100%;">
    //                     <tr class="table-head" style="background-color:#f9fafb; font-weight:bold;">
    //                         <th width="50%">&nbsp;AI Platform</th>
    //                         <th width="25%" align="center">Mentions</th>
    //                         <th width="25%" align="center">Change</th>
    //                     </tr>';
    //     foreach ($ai['Top_AI_Mentions']['platforms'] as $m) {
    //         $html .= '<tr>
    //                             <td style="font-size:9pt;">&nbsp;<b>' . htmlspecialchars($m['Platform']) . '</b></td>
    //                             <td align="center" style="font-size:9pt;">' . htmlspecialchars($m['Mentions']) . '</td>
    //                             <td align="center" style="font-size:9pt; color:#22c55e; font-weight:bold;">' . htmlspecialchars($m['Growth']) . '</td>
    //                         </tr>';
    //     }
    //     $html .= '</table>
    //             </td>
                
    //             <td width="4%"></td>
                
    //             <td width="48%" valign="top">
    //                 <div class="section-header">&nbsp;Top Content Gaps</div>
    //                 <table border="0.1" cellpadding="7" cellspacing="0" style="border-color:#e5e7eb; background-color:#ffffff; width:100%;">
    //                     <tr class="table-head" style="background-color:#f9fafb; font-weight:bold;">
    //                         <th width="55%">&nbsp;Topic / Query</th>
    //                         <th width="25%" align="center">Volume</th>
    //                         <th width="20%" align="center">Comp.</th>
    //                     </tr>';
    //     foreach ($ai['Top_Content_Gaps'] as $gap) {
    //         $compColor = '#22c55e'; // Low
    //         if ($gap['Competition'] == 'High') {
    //             $compColor = '#ef4444'; // Red
    //         } else if ($gap['Competition'] == 'Medium') {
    //             $compColor = '#f97316'; // Orange
    //         }

    //         $html .= '<tr>
    //                             <td style="font-size:8.5pt; line-height:1.3;">&nbsp;' . htmlspecialchars($gap['Keyword_Query']) . '</td>
    //                             <td align="center" style="font-size:9pt;">' . htmlspecialchars($gap['Search_Volume']) . '</td>
    //                             <td align="center" style="font-size:9pt; color:' . $compColor . '; font-weight:bold;">' . htmlspecialchars($gap['Competition']) . '</td>
    //                         </tr>';
    //     }
    //     $html .= '</table>
    //             </td>
    //         </tr>
    //     </table>

    //     <br><br>
    //     <div class="section-header">&nbsp;Strategic Summary</div>
    //     <div style="background-color:#f9fafb; border: 1px solid #e5e7eb; padding:12px; font-size:9.5pt; line-height:1.5;">
    //         ' . $ai['summary'] . '
    //     </div>
    //     </div>';

    //     $pdf->writeHTML($html, true, false, true, false, '');
    //     $pdf->Output('Competitor_Analysis_Report.pdf', 'D');
    // }
    
    public function export_pdf_report()
    {
        if (ob_get_contents()) {
            ob_end_clean();
        }
        require_once APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php';
    
        // 1. Base64 encoded data receive kiya
        $base64_data = $this->input->post('pdf_data');
    
        if (empty($base64_data)) {
            die("Data parsing failed: No data received");
        }
    
        // 2. Decode string back to JSON
        $json_string = base64_decode($base64_data);
    
        // 3. Parse JSON to Array
        $d = json_decode($json_string, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("Data parsing failed: Invalid JSON format");
        }
    
        // 4. Data Variables Extraction
        $channel = $d['channel'];
        $ai = $d['ai_analysis']['AI_Competitor_Spy_Dashboard'];
    
        // 5. TCPDF Configuration
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
    
        // Custom CSS for Dashboard Look
        $html = '
        <style>
            .header-card { background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 10px; }
            .title { font-size: 14pt; font-weight: bold; color: #111827; }
            .sub-text { font-size: 9pt; color: #6b7280; }
            .stat-label { font-size: 8pt; color: #6b7280; font-weight: bold; }
            .stat-value { font-size: 11pt; font-weight: bold; color: #111827; }
            .stat-change { font-size: 8pt; color: #ef4444; }
            .section-header { font-size: 11pt; font-weight: bold; color: #111827; margin-bottom: 10px; }
            .card-box { border: 1px solid #e5e7eb; background-color: #ffffff; padding: 10px; }
            .table-head { background-color: #f9fafb; font-weight: bold; font-size: 8pt; color: #374151; }
            .score-red { color: #ef4444; font-weight: bold; font-size: 14pt; }
        </style>
    
        <div class="dashboard">
            <table cellpadding="10" class="header-card" width="100%">
                <tr>
                    <td width="45%">
                        <span class="title">' . htmlspecialchars($channel['title']) . '</span><br>
                        <span class="sub-text">' . number_format($channel['subscribers']) . ' subscribers • ' . number_format($channel['videos']) . ' videos</span>
                    </td>
                    <td width="18%" align="center" style="border-left: 1px solid #eee;">
                        <span class="stat-label">AEO Visibility Score</span><br>
                        <span class="score-red">' . $ai['Overall_Score']['AEO_Visibility_Score']['score'] . '</span><span class="sub-text">/100</span>
                    </td>
                    <td width="18%" align="center" style="border-left: 1px solid #eee;">
                        <span class="stat-label">High Performing Topics</span><br>
                        <span class="stat-value">' . count($ai['High_Performing_Topics']) . '</span><br><span class="sub-text">Topics identified</span>
                    </td>
                    <td width="19%" align="center" style="border-left: 1px solid #eee;">
                        <span class="stat-label">Estimated AI Traffic</span><br>
                        <span class="stat-value">' . htmlspecialchars($ai['Estimated_AI_Traffic']['monthly_traffic']) . '</span><br><span class="stat-change">' . htmlspecialchars($ai['Estimated_AI_Traffic']['growth']) . '</span>
                    </td>
                </tr>
            </table>
    
            <br><br>
    
            <div class="section-header">Performance Overview</div>
            <table cellpadding="8" width="100%">
                <tr>
                    <td class="card-box" width="25%" align="center">
                        <span class="stat-label">Total Views</span><br>
                        <span class="stat-value">' . number_format($channel['views']) . '</span><br>
                        <span style="color:green; font-size:8pt;">' . htmlspecialchars($ai['Performance_Overview']['Total_Views']['growth']) . '</span>
                    </td>
                    <td class="card-box" width="25%" align="center">
                        <span class="stat-label">Avg. Views per Video</span><br>
                        <span class="stat-value">' . number_format($d['avg_views']) . '</span><br>
                        <span class="stat-change">' . htmlspecialchars($ai['Performance_Overview']['Avg_Views_Per_Video']['growth']) . '</span>
                    </td>
                    <td class="card-box" width="25%" align="center">
                        <span class="stat-label">Engagement Rate</span><br>
                        <span class="stat-value">' . round($d['engagement_rate'], 2) . '%</span><br>
                        <span style="color:green; font-size:8pt;">' . htmlspecialchars($ai['Performance_Overview']['Engagement_Rate']['growth']) . '</span>
                    </td>
                    <td class="card-box" width="25%" align="center">
                        <span class="stat-label">Top AI Rank Keywords</span><br>
                        <span class="stat-value">' . $ai['Top_AI_Rank_Keywords']['Keyword_Optimization_Score']['score'] . '</span><br>
                        <span style="color:green; font-size:8pt;">' . htmlspecialchars($ai['Top_AI_Rank_Keywords']['Keyword_Optimization_Score']['growth']) . '</span>
                    </td>
                </tr>
            </table>
    
            <br><br>
    
            <table cellpadding="0" width="100%">
                <tr>
                    <td width="55%" style="padding-right: 5px;">
                        <div class="section-header">Top Performing Videos</div>
                        <table border="0.1" cellpadding="5" style="border-color:#e5e7eb; font-size:8pt; width:100%;">
                            <thead>
                                <tr class="table-head">
                                    <th width="55%">Video Title</th>
                                    <th width="15%">Views</th>
                                    <th width="15%">Eng.</th>
                                    <th width="15%">AEO</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($ai['Top_Performing_Videos'] as $v) {
                                $html .= '<tr>
                                            <td width="55%" style="line-height:1.2;">' . htmlspecialchars($v['title']) . '</td>
                                            <td width="15%">' . htmlspecialchars($v['views']) . '</td>
                                            <td width="15%">' . htmlspecialchars($v['engagement_rate']) . '</td>
                                            <td width="15%" style="color:red; font-weight:bold;">' . htmlspecialchars($v['aeo_score']) . '</td>
                                        </tr>';
                            }
            $html .= '      </tbody>
                        </table>
                    </td>
                    
                    <td width="45%" style="padding-left: 5px;">
                        <div class="section-header">Top Performing Topics</div>
                        <table border="0.1" cellpadding="5" style="border-color:#e5e7eb; font-size:8pt; width:100%;">
                            <thead>
                                <tr class="table-head">
                                    <th width="55%">Topic</th>
                                    <th width="30%">Est. Traffic</th>
                                    <th width="15%">AEO</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($ai['High_Performing_Topics'] as $tp) {
                                $html .= '<tr>
                                            <td width="55%">' . htmlspecialchars($tp['Topic']) . '</td>
                                            <td width="30%">' . htmlspecialchars($tp['Estimated_AI_Traffic']) . '</td>
                                            <td width="15%" style="color:red; font-weight:bold;">' . htmlspecialchars($tp['AEO_Score']) . '</td>
                                        </tr>';
                            }
            $html .= '      </tbody>
                        </table>
                    </td>
                </tr>
            </table>
    
            <br><br>
    
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td width="48%" valign="top">
                        <div class="section-header">Top AI Mentions</div>
                        <table border="0.1" cellpadding="7" cellspacing="0" style="border-color:#e5e7eb; background-color:#ffffff; width:100%;">
                            <thead>
                                <tr class="table-head" style="background-color:#f9fafb; font-weight:bold;">
                                    <th width="50%">AI Platform</th>
                                    <th width="25%" align="center">Mentions</th>
                                    <th width="25%" align="center">Change</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($ai['Top_AI_Mentions']['platforms'] as $m) {
                                $platformName = isset($m['Platform']) ? $m['Platform'] : (isset($m['platform']) ? $m['platform'] : 'Unknown');
                                $html .= '<tr>
                                            <td width="50%" style="font-size:9pt;"><b>' . htmlspecialchars($platformName) . '</b></td>
                                            <td width="25%" align="center" style="font-size:9pt;">' . htmlspecialchars($m['Mentions']) . '</td>
                                            <td width="25%" align="center" style="font-size:9pt; color:#22c55e; font-weight:bold;">' . htmlspecialchars($m['Growth']) . '</td>
                                        </tr>';
                            }
            $html .= '      </tbody>
                        </table>
                    </td>
                    
                    <td width="4%"></td>
                    
                    <td width="48%" valign="top">
                        <div class="section-header">Top Content Gaps</div>
                        <table border="0.1" cellpadding="7" cellspacing="0" style="border-color:#e5e7eb; background-color:#ffffff; width:100%;">
                            <thead>
                                <tr class="table-head" style="background-color:#f9fafb; font-weight:bold;">
                                    <th width="55%">Topic / Query</th>
                                    <th width="25%" align="center">Volume</th>
                                    <th width="20%" align="center">Comp.</th>
                                </tr>
                            </thead>
                            <tbody>';
                            foreach ($ai['Top_Content_Gaps'] as $gap) {
                                $compColor = '#22c55e';
                                if ($gap['Competition'] == 'High') {
                                    $compColor = '#ef4444';
                                } else if ($gap['Competition'] == 'Medium') {
                                    $compColor = '#f97316';
                                }
    
                                $html .= '<tr>
                                            <td width="55%" style="font-size:8.5pt; line-height:1.3;">' . htmlspecialchars($gap['Keyword_Query']) . '</td>
                                            <td width="25%" align="center" style="font-size:9pt;">' . htmlspecialchars($gap['Search_Volume']) . '</td>
                                            <td width="20%" align="center" style="font-size:9pt; color:' . $compColor . '; font-weight:bold;">' . htmlspecialchars($gap['Competition']) . '</td>
                                        </tr>';
                            }
            $html .= '      </tbody>
                        </table>
                    </td>
                </tr>
            </table>
    
            <br><br>
            <div class="section-header">Strategic Summary</div>
            <div style="background-color:#f9fafb; border: 1px solid #e5e7eb; padding:12px; font-size:9.5pt; line-height:1.5;">
                ' . nl2br(htmlspecialchars($ai['summary'])) . '
            </div>
        </div>';
    
        $pdf->writeHTML($html, true, false, true, false, '');
        
        if (ob_get_length()) {
            ob_end_clean();
        }
        
        $pdf->Output('Competitor_Analysis_Report.pdf', 'D');
        exit;
    }

    public function export_video_analysis_pdf()
    {
        if (ob_get_contents()) {
            ob_end_clean();
        }
        require_once APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php';
    
        $base64_data = $this->input->post('pdf_data');
    
        if (empty($base64_data)) {
            die("Data parsing failed: Empty payload received");
        }
    
        $json_string = base64_decode($base64_data);
        $full_res = json_decode($json_string, true);
          
        if (!$full_res) {
            die("Data parsing failed: Invalid JSON structural signature");
        }
    
        if (isset($full_res['analyze_data'])) {
            $d = $full_res['analyze_data'];
        } else {
            $d = $full_res;
        }
    
        $v = is_string($d['video_info']) ? json_decode($d['video_info'], true) : $d['video_info'];
        $issues = is_string($d['issues']) ? json_decode($d['issues'], true) : $d['issues'];
        $opportunities = is_string($d['opportunities']) ? json_decode($d['opportunities'], true) : $d['opportunities'];
        $keywords = is_string($d['keywords']) ? json_decode($d['keywords'], true) : $d['keywords'];
    
        // --- SECURE IMAGE HANDLING FOR TCPDF USING cURL ---
        $img_base64 = '';
        if (!empty($v['thumbnail'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $v['thumbnail']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // SSL verification bypass to avoid local/prod secure breaks
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $img_raw = curl_exec($ch);
            curl_close($ch);
    
            if ($img_raw) {
                $img_base64 = 'data:image/jpeg;base64,' . base64_encode($img_raw);
            }
        }
        // --- END IMAGE HANDLING ---
    
        // PDF Initialize
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
    
        $html = '
        <style>
            .dashboard { font-family: helvetica; color: #111214; }
            .header-box { border-bottom: 2px solid #e8001d; padding-bottom: 10px; margin-bottom: 20px; }
            .video-title { font-size: 14pt; font-weight: bold; color: #111214; }
            .channel-info { font-size: 9pt; color: #6b7280; }
            .score-card { border: 1px solid #e8eaed; text-align: center; background-color: #ffffff; padding: 10px; }
            .score-val { font-size: 18pt; font-weight: bold; color: #111214; }
            .status-label { font-size: 9pt; font-weight: bold; color: #e8001d; }
            .section-header { font-size: 11pt; font-weight: bold; background-color: #f8f9fa; padding: 6px; border-left: 4px solid #e8001d; margin-top: 15px; }
            .item-text { font-size: 8.5pt; color: #444; line-height: 1.4; }
            .chip { background-color: #f1f3f5; padding: 3px 6px; border-radius: 10px; font-size: 8pt; color: #4b5563; border: 1px solid #ddd; }
            .summary-box { background-color: #f9fafb; padding: 12px; font-size: 9.5pt; border: 1px solid #e5e7eb; line-height: 1.5; }
        </style>
    
        <div class="dashboard">
            <table class="header-box" cellpadding="5" width="100%">
                <tr>
                    <td width="30%">';
                        if (!empty($img_base64)) {
                            $html .= '<img src="' . $img_base64 . '" width="140" height="90" style="object-fit:cover; border-radius:6px;">';
                        } else {
                            $html .= '<b>No Thumbnail</b>';
                        }
        $html .= '  </td>
                    <td width="70%">
                        <span class="video-title">' . htmlspecialchars($v['title']) . '</span><br><br>
                        <span class="channel-info">
                            <b>' . htmlspecialchars($v['channel_name']) . '</b><br>
                            ' . htmlspecialchars($v['views']) . ' Views •
                            ' . htmlspecialchars($v['likes']) . ' Likes •
                            ' . htmlspecialchars($v['comments'] ?? 0) . ' Comments
                        </span>
                    </td>
                </tr>
            </table>
    
            <br>
            <div class="section-header">&nbsp;AI Visibility Scores (AEO)</div>
            <table cellpadding="10" width="100%">
                <tr>
                    <td class="score-card" width="25%">
                        <span style="font-size:8pt; color:#6b7280;">AI Visibility</span><br>
                        <span class="score-val">' . htmlspecialchars($d['ai_visibility_score']) . '</span><small>/100</small><br>
                        <span class="status-label">' . htmlspecialchars($d['ai_visibility_status']) . '</span>
                    </td>
                    <td class="score-card" width="25%">
                        <span style="font-size:8pt; color:#6b7280;">Answer Engine</span><br>
                        <span class="score-val">' . htmlspecialchars($d['answer_engine_score']) . '</span><small>/100</small><br>
                        <span class="status-label">' . htmlspecialchars($d['answer_engine_status']) . '</span>
                    </td>
                    <td class="score-card" width="25%">
                        <span style="font-size:8pt; color:#6b7280;">Generative Search</span><br>
                        <span class="score-val">' . htmlspecialchars($d['generative_search_score']) . '</span><small>/100</small><br>
                        <span class="status-label">' . htmlspecialchars($d['generative_search_status']) . '</span>
                    </td>
                    <td class="score-card" width="25%">
                        <span style="font-size:8pt; color:#6b7280;">Content Readiness</span><br>
                        <span class="score-val">' . htmlspecialchars($d['content_readiness_score']) . '</span><small>/100</small><br>
                        <span class="status-label">' . htmlspecialchars($d['content_readiness_status']) . '</span>
                    </td>
                </tr>
            </table>
    
            <br>
            <table width="100%" cellpadding="0">
                <tr>
                    <td width="49%" valign="top">
                        <div class="section-header">&nbsp;Issues Found (' . count($issues) . ')</div>
                        <table cellpadding="6" width="100%" style="border: 1px solid #e8eaed; background-color: #ffffff;">';
                        foreach ($issues as $issue) {
                            $color = ($issue['severity'] == 'High') ? '#ef4444' : (($issue['severity'] == 'Medium') ? '#f97316' : '#22c55e');
                            $html .= '<tr><td class="item-text"><span style="color:' . $color . '; font-size: 12pt; font-weight: bold;">&bull;</span> ' . htmlspecialchars($issue['issue']) . ' <span style="color:' . $color . '; font-weight:bold; font-size:7pt;">[' . htmlspecialchars($issue['severity']) . ']</span></td></tr>';
                        }
        $html .= '      </table>
                    </td>
                    <td width="2%"></td>
                    <td width="49%" valign="top">
                        <div class="section-header">&nbsp;Opportunities to Improve</div>
                        <table cellpadding="6" width="100%" style="border: 1px solid #e8eaed; background-color: #ffffff;">';
                        foreach ($opportunities as $opp) {
                            $html .= '<tr><td class="item-text"><span style="color:#22c55e; font-size: 12pt; font-weight: bold;">&bull;</span> ' . htmlspecialchars($opp) . '</td></tr>';
                        }
        $html .= '      </table>
                    </td>
                </tr>
            </table>
    
            <br>
            <div class="section-header">&nbsp;AI Query Keyword Insights</div>
            <table cellpadding="10" width="100%" style="border:1px solid #e8eaed;">
                <tr>
                    <td>
                        <span style="font-size:9pt; font-weight:bold; color:#6b7280;">Primary Keyword:</span><br>
                        <span style="background-color:#fff0f2; color:#e8001d; font-size:11pt; font-weight:bold;">&nbsp; ' . htmlspecialchars($keywords['primary']) . ' &nbsp;</span><br><br>
                        <span style="font-size:9pt; font-weight:bold; color:#6b7280;">Related Keywords:</span><br><br>';
                        if (isset($keywords['related']) && is_array($keywords['related'])) {
                            foreach ($keywords['related'] as $kw) {
                                $html .= '<span class="chip">' . htmlspecialchars($kw) . '</span> &nbsp; ';
                            }
                        }
        $html .= '  </td>
                </tr>
            </table>
    
            <br>
            <div class="section-header">&nbsp;Analysis Summary</div>
            <div class="summary-box">
                ' . nl2br(htmlspecialchars($d['summary'])) . '
            </div>
        </div>';
    
        $pdf->writeHTML($html, true, false, true, false, '');
        if (ob_get_length()) {
            ob_end_clean();
        }
        $pdf->Output('Video_Analysis_Report_' . $d['video_id'] . '.pdf', 'D');
        exit;
    }


    public function export_ai_queries_pdf()
    {
        if (ob_get_contents())
            ob_end_clean();
        require_once APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php';

        $data_json = $this->input->post('pdf_data');
        $d = json_decode($data_json, true);

        if (!$d) {
            die("Data parsing failed");
        }

        $keyword = $d['keyword'];
        $popularIntent = $d['popularIntent'];
        $intentStats = $d['intentStats'];
        $topAISources = $d['topAISources'];
        $queries = $d['queries'];

        // PDF Configuration
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(12, 12, 12);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        $html = '
        <style>
            .wrapper { font-family: helvetica; color: #111214; }
            .main-header { border-bottom: 2px solid #e8001d; padding-bottom: 8px; }
            .title { font-size: 16pt; font-weight: bold; color: #111214; }
            .keyword-badge { background-color: #fff0f2; color: #e8001d; font-weight: bold; font-size: 12pt; }
            .section-header { font-size: 11pt; font-weight: bold; background-color: #f8f9fa; padding: 6px; border-left: 4px solid #e8001d; margin-top: 15px; margin-bottom: 10px; }
            .card-box { border: 1px solid #e8eaed; background-color: #ffffff; padding: 8px; text-align: center; }
            .metric-title { font-size: 8pt; color: #6b7280; font-weight: bold; text-transform: uppercase; }
            .metric-value { font-size: 14pt; font-weight: bold; color: #111214; }
            .intent-row { border-bottom: 1px solid #f1f3f5; font-size: 9pt; }
            .table-head { background-color: #f9fafb; font-weight: bold; font-size: 9pt; color: #374151; text-align: left; }
            .query-text { font-size: 9pt; color: #1f2937; }
            .intent-tag { font-weight: bold; font-size: 8.5pt; text-align: center; }
        </style>

        <div class="wrapper">
            <table class="main-header" cellpadding="5" width="100%">
                <tr>
                    <td width="70%">
                        <span class="title">AI Queries Report</span><br>
                        <span style="font-size: 9pt; color: #6b7280;">Target Keyword Analysis Insights</span>
                    </td>
                    <td width="30%" align="right">
                        <span class="metric-title">Analyzed Keyword</span><br>
                        <span class="keyword-badge">&nbsp; ' . htmlspecialchars($keyword) . ' &nbsp;</span>
                    </td>
                </tr>
            </table>

            <br><br>

            <table cellpadding="8" width="100%">
                <tr>
                    <td class="card-box" width="33%">
                        <span class="metric-title">Total AI Queries</span><br>
                        <span class="metric-value">' . count($queries) . '</span>
                    </td>
                    <td class="card-box" width="34%" style="border-left: none;">
                        <span class="metric-title">Popular Search Intent</span><br>
                        <span class="metric-value" style="color: #e8001d;">' . htmlspecialchars($popularIntent) . '</span>
                    </td>
                    <td class="card-box" width="33%" style="border-left: none;">
                        <span class="metric-title">Active AI Engines</span><br>
                        <span class="metric-value">' . count($topAISources) . '</span>
                    </td>
                </tr>
            </table>

            <br><br>

            <table width="100%" cellpadding="0" border="0">
                <tr>
                    <td width="48%">
                        <div class="section-header">&nbsp;Query Intent Distribution</div>
                        <table cellpadding="6" border="0.1" style="border-color: #e8eaed; background-color: #ffffff;">
                            <tr class="table-head">
                                <th width="60%">&nbsp;Intent Group</th>
                                <th width="40%" align="center">Volume / Ratio</th>
                            </tr>';
        foreach ($intentStats as $stat) {
            $html .= '<tr class="intent-row">
                                    <td>&nbsp; ' . htmlspecialchars($stat['intent']) . '</td>
                                    <td align="center"><b>' . $stat['count'] . '</b> (' . $stat['percentage'] . '%)</td>
                                </tr>';
        }
        $html .= '</table>
                    </td>
                    
                    <td width="4%"></td>

                    <td width="48%">
                        <div class="section-header">&nbsp;Top AI Tool Ingestion Sources</div>
                        <table cellpadding="6" border="0.1" style="border-color: #e8eaed; background-color: #ffffff;">
                            <tr class="table-head">
                                <th width="60%">&nbsp;AI Platform</th>
                                <th width="40%" align="center">Ingested Queries</th>
                            </tr>';
        foreach ($topAISources as $source) {
            $html .= '<tr class="intent-row">
                                    <td>&nbsp; <b>' . htmlspecialchars($source['source']) . '</b></td>
                                    <td align="center">' . $source['queryCount'] . ' queries</td>
                                </tr>';
        }
        $html .= '</table>
                    </td>
                </tr>
            </table>

            <br><br>

            <div class="section-header">&nbsp;Use These Queries For</div>
            <table cellpadding="6" width="100%" style="border: 1px solid #e8eaed; background-color: #ffffff;">
                <tr>
                    <td>
                        <table cellpadding="4" cellspacing="0" border="0">
                            <tr>
                                <td width="4%" style="color: #e8001d; font-size: 12pt; font-weight: bold;">&bull;</td>
                                <td width="96%" style="font-size: 9.5pt; color: #1f2937;">Video Ideas &amp; Topics</td>
                            </tr>
                            <tr>
                                <td width="4%" style="color: #e8001d; font-size: 12pt; font-weight: bold;">&bull;</td>
                                <td width="96%" style="font-size: 9.5pt; color: #1f2937;">Optimize Titles &amp; Descriptions</td>
                            </tr>
                            <tr>
                                <td width="4%" style="color: #e8001d; font-size: 12pt; font-weight: bold;">&bull;</td>
                                <td width="96%" style="font-size: 9.5pt; color: #1f2937;">FAQ/Q&amp;A Section Layouts</td>
                            </tr>
                            <tr>
                                <td width="4%" style="color: #e8001d; font-size: 12pt; font-weight: bold;">&bull;</td>
                                <td width="96%" style="font-size: 9.5pt; color: #1f2937;">Boosting AI Visibility &amp; Higher Rankings</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <br><br>

            <div class="section-header">&nbsp;Discovered AI User Intent Queries</div>
            <table cellpadding="6" border="0.1" style="border-color: #e8eaed; background-color: #ffffff;">
                <tr class="table-head">
                    <th width="8%">#</th>
                    <th width="62%">AI Search Query String</th>
                    <th width="15%" align="center">Intent</th>
                    <th width="15%" align="center">Engine Source</th>
                </tr>';
        foreach ($queries as $index => $q) {
            $intentColor = '#333333';
            if ($q['intent'] == 'How To') {
                $intentColor = '#22c55e'; // Green
            } else if ($q['intent'] == 'Problem') {
                $intentColor = '#ef4444'; // Red
            } else if ($q['intent'] == 'Strategies') {
                $intentColor = '#8045C4'; // Purple
            } else if ($q['intent'] == 'Comparison') {
                $intentColor = '#558EEB'; // Blue
            }

            $html .= '<tr cellpadding="5">
                        <td align="center" style="color: #6b7280;">' . ($index + 1) . '</td>
                        <td class="query-text">' . htmlspecialchars($q['query']) . '</td>
                        <td class="intent-tag" style="color: ' . $intentColor . ';">' . htmlspecialchars($q['intent']) . '</td>
                        <td align="center" style="font-size: 8.5pt; color: #4b5563;">' . htmlspecialchars(implode(', ', $q['sources'])) . '</td>
                    </tr>';
        }
        $html .= '</table>
        </div>';

        $pdf->writeHTML($html, true, false, true, false, '');

        if (ob_get_length())
            ob_end_clean();
        $pdf->Output('AI_Queries_Report_' . urlencode($keyword) . '.pdf', 'D');
        exit;
    }


    public function export_optimizer_report_pdf()
    {
        if (ob_get_contents()) ob_end_clean();
        require_once APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php';
    
        // 1. Base64 payload catch kiya
        $base64_data = $this->input->post('optimizer_data');
    
        if (empty($base64_data)) {
            die("Data parsing failed: No data payload received");
        }
    
        // 2. Decode string back to JSON array
        $json_string = base64_decode($base64_data);
        $d = json_decode($json_string, true);
    
        if (!$d) { die("Data parsing failed: Invalid JSON structural signature"); }
    
        $v = is_string($d['video_info']) ? json_decode($d['video_info'], true) : $d['video_info'];
        $opt = is_string($d['optimized_value']) ? json_decode($d['optimized_value'], true) : $d['optimized_value'];
        
        $title_sec = $opt['title_section'] ?? [];
        $desc_sec = $opt['description_section'] ?? [];
        $tags_sec = $opt['tags_section'] ?? [];
        $quicks = $opt['quick_recommendations'] ?? [];
    
        // 3. SECURE IMAGE HANDLING VIA cURL FOR TCPDF
        $img_base64 = '';
        if (!empty($v['thumbnail'])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $v['thumbnail']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Bypass SSL checks for external streaming
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $img_raw = curl_exec($ch);
            curl_close($ch);
    
            if ($img_raw) {
                $img_base64 = 'data:image/jpeg;base64,' . base64_encode($img_raw);
            }
        }
    
        // PDF Initialize
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(12, 12, 12);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
    
        $html = '
        <style>
            .wrapper { font-family: helvetica; color: #111214; }
            .main-header { border-bottom: 2px solid #e8001d; padding-bottom: 10px; margin-bottom: 15px; }
            .video-title { font-size: 13pt; font-weight: bold; color: #111214; line-height: 1.3; }
            .meta-text { font-size: 9pt; color: #6b7280; }
            .section-header { font-size: 11pt; font-weight: bold; background-color: #f8f9fa; padding: 6px; border-left: 4px solid #e8001d; margin-top: 15px; margin-bottom: 8px; }
            .score-box { border: 1px solid #e8eaed; text-align: center; background-color: #ffffff; padding: 8px; }
            .score-num { font-size: 16pt; font-weight: bold; color: #111214; }
            .info-block { border: 1px solid #e5e7eb; padding: 8px; background-color: #ffffff; font-size: 9pt; }
        </style>
    
        <div class="wrapper">
            <table class="main-header" cellpadding="5" width="100%">
                <tr>
                    <td width="28%">';
                    if (!empty($img_base64)) {
                        $html .= '<img src="' . $img_base64 . '" width="145" height="95" style="border-radius:6px; object-fit:cover;">';
                    } else {
                        $html .= '<b>No Image Thumbnail</b>';
                    }
    $html .= '      </td>
                    <td width="47%">
                        <span class="video-title">' . htmlspecialchars($title_sec['current_title']) . '</span><br><br>
                        <span class="meta-text">
                            <b>Channel:</b> ' . htmlspecialchars($v['channel_name']) . '<br>
                            <b>Views:</b> ' . htmlspecialchars($v['views']) . ' &nbsp;•&nbsp; <b>Progress:</b> ' . htmlspecialchars($opt['optimization_progress']) . '%
                        </span>
                    </td>
                    <td width="25%" class="score-box" valign="middle">
                        <span class="meta-text" style="text-transform:uppercase; font-size:7.5pt; font-weight:bold;">Overall AEO Score</span><br>
                        <span class="score-num" style="color:#e8001d;">' . htmlspecialchars($opt['aeo_score']) . '</span><small>/100</small><br>
                        <span style="font-size:8pt; font-weight:bold; color:#0c8649;">Optimization Progress</span>
                    </td>
                </tr>
            </table>
    
            <br>
    
            <div class="section-header">&nbsp;Optimize Title (Score: ' . htmlspecialchars($title_sec['current_score']) . '/100)</div>
            <table cellpadding="6" width="100%" class="info-block">
                <tr>
                    <td>
                        <span class="meta-text"><b>Selected Title Text:</b></span><br>
                        <span style="font-size:9.5pt; color:#22c55e; font-weight:bold;">' . htmlspecialchars($title_sec['current_title']) . '</span>
                    </td>
                </tr>
            </table>
            <br>
            <span class="meta-text"><b>AI Suggested Target Titles Evaluation:</b></span>
            <table cellpadding="5" border="0.1" style="border-color:#e5e7eb; background-color:#ffffff; width:100%;">
                <thead>
                    <tr style="background-color:#f9fafb; font-weight:bold; font-size:8.5pt;">
                        <th width="85%">&nbsp;Suggested Title Variant</th>
                        <th width="15%" align="center">AEO Score</th>
                    </tr>
                </thead>
                <tbody>';
                foreach ($title_sec['suggestions'] as $tsug) {
                    $isCurrent = ($tsug['title'] === $title_sec['current_title']) ? ' <span style="color:#22c55e; font-weight:bold;">[Selected]</span>' : ($tsug['is_best'] ? ' <span style="color:#ef4444; font-weight:bold;">[Best]</span>' : '');
                    $html .= '<tr>
                        <td style="font-size:9pt;">&nbsp;' . htmlspecialchars($tsug['title']) . $isCurrent . '</td>
                        <td align="center" style="font-size:9pt; font-weight:bold;">' . htmlspecialchars($tsug['score']) . '/100</td>
                    </tr>';
                }
    $html .= '  </tbody>
            </table>
    
            <br>
    
            <div class="section-header">&nbsp;Optimize Description (Score: ' . htmlspecialchars($desc_sec['score']) . '/100)</div>
            <table cellpadding="6" width="100%" class="info-block" style="background-color:#fffdfa; border-color:#f59e0b;">
                <tr>
                    <td>
                        <span style="color:#b45309; font-weight:bold; font-size:9pt;">AI Optimized Target Template:</span><br>
                        <span style="font-size:9pt; color:#222; line-height:1.4;">' . nl2br(htmlspecialchars($desc_sec['optimized_description'])) . '</span>
                    </td>
                </tr>
            </table>
    
            <br>
    
            <table width="100%" cellpadding="0" border="0">
                <tr>
                    <td width="48%" valign="top">
                        <div class="section-header">&nbsp;AI Target Tags (Score: ' . htmlspecialchars($tags_sec['score']) . '/100)</div>
                        <table cellpadding="6" width="100%" class="info-block">
                            <tr>
                                <td>';
                                foreach ($tags_sec['suggested_tags'] as $tg) {
                                    $html .= '<span style="background-color:#f3f4f6; color:#374151; font-size:8.5pt;"> &bull; ' . htmlspecialchars($tg) . '</span><br>';
                                }
                    $html .= '  </td>
                            </tr>
                        </table>
                    </td>
    
                    <td width="4%"></td>
    
                    <td width="48%" valign="top">
                        <div class="section-header">&nbsp;Quick Recommendations</div>
                        <table cellpadding="5" width="100%" style="border:1px solid #e5e7eb; background-color:#ffffff;">';
                        foreach ($quicks as $rec) {
                            $bulletColor = ($rec['status'] == 'done') ? '#0c8649' : '#fe1d20';
                            $html .= '<tr>
                                <td width="6%" style="color:' . $bulletColor . '; font-size:12pt; font-weight:bold;" valign="top">&bull;</td>
                                <td width="94%" style="font-size:8.5pt; color:#374151; line-height:1.3;">' . htmlspecialchars($rec['text']) . '</td>
                            </tr>';
                        }
                    $html .= '  </table>
                    </td>
                </tr>
            </table>
        </div>';
    
        $pdf->writeHTML($html, true, false, true, false, '');
    
        if (ob_get_length()) ob_end_clean();
        $pdf->Output('AI_Optimizer_Report_' . $d['id'] . '.pdf', 'D');
        exit;
    }



    public function analyzeVideo()
    {
        header('Content-Type: application/json');

        $url = trim($this->input->post('videourl'));

        if (empty($url)) {
            echo json_encode([
                'success' => false,
                'msg' => 'Video URL is required'
            ]);
            exit;
        }

        $result = $this->analyzeYoutubeVideo($url);

        if ($result['status']) {
            echo json_encode([
                'success' => true,
                'msg' => 'Data fetched successfully',
                'analyze_data' => $result
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => $result['message']
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

        $views = (int) ($stats['viewCount'] ?? 0);
        $likes = (int) ($stats['likeCount'] ?? 0);
        $comments = (int) ($stats['commentCount'] ?? 0);

        $engagementRate = ($views > 0)
            ? round((($likes + $comments) / $views) * 100, 2)
            : 0;

        $videoInfo = [
            "title" => $snippet['title'] ?? '',
            "description" => $snippet['description'] ?? '',
            "tags" => $snippet['tags'] ?? [],
            "views" => $views,
            "likes" => $likes,
            "comments" => $comments,
            "engagement_rate" => $engagementRate
        ];

        $aiAnalysis = $this->analyzeWithAI($videoInfo);

        return [
            "status" => true,
            "video_id" => $videoId,
            "video_info" => $videoInfo,
            "engagement_rate" => $engagementRate,
            "ai_analysis" => $aiAnalysis
        ];
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

        if (curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        return json_decode($response, true);
    }

    //YouTube API Call
    // public function getVideoanalyzDetails($videoId)
    // {
    //     $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id={$videoId}&key={$this->youtubeApiKey}";
    //     $response = file_get_contents($url);
    //     return json_decode($response, true);
    // }

    //AI Analysis
    public function analyzeWithAI($videoInfo)
    {
        $prompt = "
            Analyze this YouTube video and provide:
            1. SEO Score (0-100)
            2. Content Quality Score (0-100)
            3. Performance Level (Low/Medium/High)
            4. Suggested Title
            5. SEO Description
            6. Tags (comma separated)
            7. Short Transcript Idea
    
            Data: " . json_encode($videoInfo);

        $data = [
            "model" => "gpt-4o-mini",
            "messages" => [
                ["role" => "user", "content" => $prompt]
            ]
        ];

        $ch = curl_init("https://api.openai.com/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $this->openaikey,
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result['choices'][0]['message']['content'] ?? "AI analysis failed";
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

}
