<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Crone_youtube_controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->user_id 			= $this->session->userdata('id');
		$this->load->model('default/youtube_integration_model');
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->openaikey = config_item('openai_key_proj_2');
        
	}

	public function index(){
		// die('sid');
		$this->processReplyAutomation(); // Call your main logic here
	}

	  public function getYouTubeChannelInfo($token=null) {
			// Get the access token (adjust this as per your app's logic)
			$access_token = $this->get_new_access_token($token);

			if (!$access_token) {
				echo json_encode(['error' => 'Access token not found.']);
				return;
			}

			// Corrected URL (no 'id', only 'mine=true')
			$url = 'https://youtube.googleapis.com/youtube/v3/channels?part=snippet&mine=true';

			$headers = [
				"Authorization: Bearer $access_token",
				"Accept: application/json"
			];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			$error = curl_error($ch);
			curl_close($ch);

			if ($error) {
				echo json_encode(['error' => 'Curl error: ' . $error]);
				return;
			}

			$result = json_decode($response, true);

			if (isset($result['items'][0])) {
				$channelId = $result['items'][0]['id'];
				$channelTitle = $result['items'][0]['snippet']['title'];

				echo json_encode([
					'status' => true,
					'channel_id' => $channelId,
					'channel_title' => $channelTitle
				]);
			} else {
				echo json_encode([
					'status' => false,
					'message' => 'Failed to fetch channel info.',
					'response' => $result
				]);
			}
		}


    public function get_new_access_token($access_token=Null){

		if(!empty($access_token)) {
			$tokenData =  json_decode($access_token,true);
		} else {
			$this->db->select('*'); // or specific columns
			$this->db->from('youtube_automation_reply');
			$this->db->join('youtube_access_token', 'youtube_automation_reply.business_id = youtube_access_token.business_id'); // JOIN condition
			$query = $this->db->group_by('youtube_access_token.business_id')->get();
			$result = $query->result();
			$tokenData =  json_decode($result[0]->access_token,true);
		}
	
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
                
                return false;
            }
        }
    }

    

	
    public function getLastComments($videoId = null,$channalId = null)  {	

		if (!$videoId) {
			$videoId = $this->input->get('videoId');
		}
        // $url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=$videoId&maxResults=10";
		$allComments = [];
		$pageToken = '';
		if(!$channalId){
			$channalId = $this->getChannalID($videoId);
		}
        // $url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet,replies&videoId=$videoId&maxResults=100";
		
		// Step 1: Loop through all comment threads
		do {
			$url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet,replies&videoId=$videoId&maxResults=100";
			if (!empty($pageToken)) {
				$url .= "&pageToken=$pageToken";
			}
	
			$response = $this->getCurlData($url);
			if (!isset($response['items'])) break;
			foreach ($response['items'] as $thread) {
				if (!isset($thread['snippet']['topLevelComment']['snippet'])) continue;
	
				$topCommentSnippet = $thread['snippet']['topLevelComment']['snippet'];
				$parentId = $thread['snippet']['topLevelComment']['id']; // this is the actual comment ID
				$commentAuthorChannelId = $topCommentSnippet['authorChannelId']['value'] ?? '';
				$isOwner = ($commentAuthorChannelId === $channalId) ? true :  false;


				$comment = [
					'id' => $parentId,
					'text' => $topCommentSnippet['textDisplay'],
					'author' => $topCommentSnippet['authorDisplayName'],
					'is_reply' => false,
					'is_owner' => $isOwner,
					'replys' => []
				];
	
				$totalReplyCount = $thread['snippet']['totalReplyCount'];
	
				// Get replies if they exist
				if ($totalReplyCount > 0) {
					$comment['replys'] = $this->getAllRepliesFlat($parentId,$channalId);
				}
	
				$allComments[] = $comment;
			}
			$pageToken = isset($response['nextPageToken']) ? $response['nextPageToken'] : null;
		} while ($pageToken);
	
		$lastItems = [];
		foreach ($allComments as $comment) {
			if (!empty($comment['replys'])) {
				// Get the last reply
				$lastReply = end($comment['replys']);
				$lastItems[] = $lastReply;
			} else {
				// No replies, use the top-level comment
				$lastItems[] = $comment;
			}
		}

		
		// $checkingAuto = $this->commentAutoReply($lastItems);
		// pr($checkingAuto);
        // echo json_encode($lastItems);
		return $lastItems;
		
    }


	private function getAllRepliesFlat($parentId, $channalId) {
		$url = "https://www.googleapis.com/youtube/v3/comments?part=snippet&parentId=$parentId&maxResults=100";
		$response = $this->getCurlData($url);
		$replies = [];

		foreach ($response['items'] as $item) {
			$replySnippet = $item['snippet'];
			$isOwner = ($replySnippet['authorChannelId']['value'] ?? '') === $channalId ?  true : false;

			$replies[] = [
				'id' => $item['id'],
				'text' => $replySnippet['textDisplay'],
				'author' => $replySnippet['authorDisplayName'],
				'is_reply' => true,
				'is_owner' => $isOwner
			];
		}

		return $replies;
	}


    private function getCurlData($url)
    {
        $access_token_data = $this->get_new_access_token();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $access_token_data]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function postComment()
	{
	    $access_token_data = $this->get_new_access_token();
	    $params = json_decode(file_get_contents('php://input'),true);
	    $videoId = $params['videoId'];
	    $text = $params['text'];

	    $url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet";
	    
	    $postData = json_encode([
	        "snippet" => [
	            "videoId" => $videoId,
	            "topLevelComment" => [
	                "snippet" => [
	                    "textOriginal" => $text
	                ]
	            ]
	        ]
	    ]);

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, [
	        "Authorization: Bearer " . $access_token_data,
	        "Content-Type: application/json"
	    ]);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	    
	    $response = curl_exec($ch);
	    curl_close($ch);

	    echo json_encode(["success" => true, "data" => json_decode($response)]);
	}



	function getChannalID($videoId){
		//  Get channelId from videoId
		$access_token_data = $this->get_new_access_token();
		$videoDetailsUrl = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $videoDetailsUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer " . $access_token_data
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$videoResponse = curl_exec($ch);
		$videoData = json_decode($videoResponse, true);
		curl_close($ch);
		
		if (empty($videoData['items'])) {
			echo json_encode(["success" => false, "message" => "Invalid video ID"]);
			return;
		}

		return $channelId = $videoData['items'][0]['snippet']['channelId'];
	}

	

	public function postReply($parentCommentId, $replyText){
		$accessToken = $this->get_new_access_token(); // however you store it
		
		// $access_token_data = $this->get_new_access_token();
		$url = 'https://www.googleapis.com/youtube/v3/comments?part=snippet';
		$realParentCommentId =  explode(".",$parentCommentId);
		

		$data = [
			'snippet' => [
				'parentId' => $realParentCommentId[0],
				'textOriginal' => $replyText
			]
		];
		
		$headers = [
			'Authorization: Bearer ' . $accessToken,
			'Content-Type: application/json'
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response, true);
	}


	private function replyToComment($accessToken, $commentId, $replyText) {
		$url = 'https://www.googleapis.com/youtube/v3/comments?part=snippet';
	
		$data = [
			'snippet' => [
				'parentId' => $commentId,
				'textOriginal' => $replyText
			]
		];
	
		$headers = [
			"Authorization: Bearer $accessToken",
			"Content-Type: application/json"
		];
	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
		$response = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
	
		// Optional debug
		log_message('debug', "Posted reply to $commentId with status $httpStatus");
	
		return $httpStatus == 200;
	}
	

	private function generateOpenAiReply($text){
		$open_ai = new OpenAi($this->openaikey);
		$history[] = ["role" => "user", "content" => $text];

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


	private function postReplyToComment($commentId, $text, $access_token){
	    
        // pr($commentId);
        // pr($text);
        // pr($access_token); die('dasdad');
		$url = "https://youtube.googleapis.com/youtube/v3/comments?part=snippet";
		$token = $this->get_new_access_token($access_token); 

		$postData = [
			"snippet" => [
				"parentId" => $commentId,
				"textOriginal" => $text
			]
		];

		$headers = [
			"Authorization: Bearer $token",
			"Content-Type: application/json"
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);

		$response = curl_exec($ch);
		curl_close($ch);
       
		return json_decode($response, true);
	}

	public function processReplyAutomation() {
		$open_ai = new OpenAi($this->openaikey);
		// $youtubeSettings = $this->db->get_where('youtube_automation_reply', ['status' => 1])->result_array();
		$this->db->select('*'); // or specific columns
        $this->db->from('youtube_access_token');
        $this->db->join('youtube_automation_reply', 'youtube_automation_reply.business_id = youtube_access_token.business_id');
		$this->db->where('youtube_automation_reply.status', 1);
		$youtubeSettings = $this->db->group_by('youtube_access_token.business_id')->get()->result_array();
		
// 		pr($youtubeSettings); die('sdsadad');


		foreach ($youtubeSettings as $config) {
			//pr($this->getYouTubeChannelInfo($config['access_token']));
			$id   	 =	 (int)$config['id'];
			$stop_setting    = (int)$config['stop_setting'];
			$videoId         = $config['video_id'];
			$maxActivity     = (int)$config['max_activity'];
			$triggerkeywords = $config['keywords'];
			$createdAt       = strtotime($config['created_at']);
			$delayAmount     = (int)$config['delay_activity'];
			$channalId       = $config['channel_id'];
			$delayUnit       = strtolower(trim($config['delay_activity_time']));
			$schedule_time   = $config['schedule_time'];
			$reply_text       = $config['reply_text'];
			if($delayAmount == 0){
				$delayAmount = 0;
				$delayUnit = 'min';
			}
			$tempArray = [];
			
			$delayInSeconds  = $this->getDelayInSeconds($delayAmount, $delayUnit);

			// Delay logic (do not process yet if delay not passed)
			$final_time =  $schedule_time;
			
			if(time() >= $final_time ){
				// Stop time logic (if current date exceeds created + stop_setting days, skip)
				$createdDate = new DateTime($config['created_at']);
				$plusday  = $createdDate->modify("+$stop_setting days");
				$now = new DateTime();

				if ($now > $plusday) {
					$this->db->set('status', '0', false)
						->where('id', $config['id'])
						->update('youtube_automation_reply');
					continue;
				} 
				

				// Prepare trigger keyword array
				$triggerKeyword = !empty($triggerkeywords)
				? array_map('strtolower', array_map('trim', explode(',', $triggerkeywords)))
				: [];

				// Get non-owner comments
				$comments = array_filter($this->getLastComments($videoId, $channalId), function($comment) {
					return empty($comment['is_owner']);
				});
				
				// Filter by keyword if needed
				if (!empty($triggerKeyword)) {
					$comments = array_filter($comments, function($comment) use ($triggerKeyword) {
						foreach ($triggerKeyword as $keyword) {
							if (!empty($keyword) && stripos($comment['text'], $keyword) !== false) {
								return true;
							}
						}
						return false;
					});
				}

				$finalComments = array_slice($comments, 0, $maxActivity);
				
				if (empty($finalComments)) {
					$query = $this->db->set('status', '0')
						->where('id', $config['id'])
						->update('youtube_automation_reply');
					continue;
				}
				foreach ($finalComments as $comment) {
					if ($comment['is_owner']) continue;

					if($reply_text){
						$replyMessage = $reply_text;
					
					}else{
					
						$prompt = "Generate a professional reply to this comment and : " . $comment['text'] . "\nUse this as context: " . $config['reply_text'];
						$response = $open_ai->chat([
							"model" => "gpt-3.5-turbo",
							"messages" => [["role" => "user", "content" => $prompt]],
							"temperature" => 0.5,
							"max_tokens" => 200
						]);
						$replyData = json_decode($response, true);
						$replyMessage = $replyData['choices'][0]['message']['content'] ?? '';
					}

					if (empty($comment['is_owner'])){
						$this->postReplyToComment($comment['id'], $replyMessage, $config['access_token']);
					}
				}
				$new_schedule_time  =  $final_time +  $delayInSeconds;
				$this->db->where('id', $id);  
				$this->db->update('youtube_automation_reply', ['schedule_time' => $new_schedule_time]);

			}

			sleep(300); // Optional between each reply
		}
		
		echo json_encode(['status' => true, 'message' => 'Reply automation processed']);
	}
	

	private function getDelayInSeconds($amount, $unit) {
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
	

	
	
	public function runAutoComments(){
		$this->processAutoComment();
	}


	public function processAutoComment() {
		$youtubeSettings = $this->db->get_where('youtube_automation_comment', ['status' => 1])->result_array();
		$this->db->select('*'); // or specific columns
        $this->db->from('youtube_automation_comment');
        $this->db->join('youtube_access_token', 'youtube_automation_comment.business_id = youtube_access_token.business_id');
		$this->db->where('youtube_automation_comment.status', 1);
		$youtubeSettings = $this->db->group_by('youtube_access_token.business_id')->get()->result_array();

		foreach ($youtubeSettings as $config) {
			$id    = (int)$config['id'];
			$stop_setting    = (int)$config['stop_setting'];
			$videoIds         = json_decode($config['video_id'],true);
			$createdAt       = strtotime($config['created_at']);
			$channalId       = $config['channal_id'];
			$schedule_time   = $config['schedule_time'];
			$comment_text   = $config['comment_text'];
			$delayInSeconds  = $this->getDelayInSeconds($delayAmount, 'hour');

			// Delay logic (do not process yet if delay not passed)
			$final_time =  $schedule_time;
			if(time() >=  $final_time){
				foreach ($videoIds as $video) {
					$this->videoComment($video, $comment_text,$config['access_token']);
				}
			}
			$new_schedule_time  =  $final_time +  $delayInSeconds;
			$this->db->where('id', $id);
			$this->db->update('youtube_automation_comment', ['schedule_time' => $new_schedule_time , 'status' => 0]);
		}
		echo json_encode(['status' => true, 'message' => 'Reply automation processed']);
	}

	public function videoComment($video_id, $comment_text,$access_token) {
		$access_token = $this->get_new_access_token($access_token); 

		$url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet";
		$post_fields = json_encode([
			"snippet" => [
				"videoId" => $video_id,
				"topLevelComment" => [
					"snippet" => [
						"textOriginal" => $comment_text
					]
				]
			]
		]);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $access_token",
			"Content-Type: application/json"
		]);
		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($http_code === 200) {
			echo "Comment posted successfully!";
		} else {
			echo "Failed to post comment. Response:<br><pre>$response</pre>";
		}
	}

	public function processVideoPublished() {
		$youtubeSettings = $this->db->get_where('youtube_automation_comment', ['status' => 1])->result_array();
		foreach ($youtubeSettings as $config) {
			$id    = (int)$config['id'];
			$stop_setting    = (int)$config['stop_setting'];
			$videoIds         = json_decode($config['video_id'],true);
			$createdAt       = strtotime($config['created_at']);
			$channalId       = $config['channal_id'];
			$schedule_time   = $config['schedule_time'];
			$comment_text   = $config['comment_text'];
			$delayInSeconds  = $this->getDelayInSeconds($delayAmount, 'hour');

			// Delay logic (do not process yet if delay not passed)
			$final_time =  $schedule_time;
			if(time() >=  $final_time){
				foreach ($videoIds as $video) {
					$this->videoComment($video, $comment_text);
				}
			}
			$new_schedule_time  =  $final_time +  $delayInSeconds;
			$this->db->where('id', $id);
			$this->db->update('youtube_automation_comment', ['schedule_time' => $new_schedule_time , 'status' => 0]);
		}
		echo json_encode(['status' => true, 'message' => 'Reply automation processed']);
	}

}
?>