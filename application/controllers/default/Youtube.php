<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Youtube extends AppDefault {

	public function __construct() {
		parent::__construct();
		$this->checkAlreadyLogout();
		$this->user_id= $this->session->userdata('id');
		$this->load->model('default/youtube_integration_model');
		$this->load->model('Youtube_integration_model');
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->openaikey = $this->config->item('open_ai_key');
		
// 		if(!in_array('youtube_integration',$this->session->userdata('features')) ) {
//          $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
//          $flashdata['error']['type'] = 'flash';
//          $this->session->set_flashdata('message', json_encode($flashdata));
//          redirect(site_url('subscription'));
//        }

		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id = $this->session->userdata('logged_in')['id'];
		if(!empty($this->session->userdata('business'))){
			$this->business_id = $this->session->userdata('business')['id'];
		}else{
			$this->business_id = $this->session->userdata('business_switch_session');
		}
		$this->youtubeApiKey = config_item('youtube_api_key');
	}

	public function index(){
		

		$output=array();
		if($this->input->post()){
			$this->form_validation->set_rules('clientId', 'Youtube client id', 'trim|required');
			$this->form_validation->set_rules('clientSecret', 'Youtube client secret', 'trim|required');

			if($this->form_validation->run()) {
				$clientId =$this->input->post('clientId');
				$clientSecret = $this->input->post('clientSecret');
				$this->session->set_userdata('yt_clientId',$clientId);
				$this->session->set_userdata('yt_clientSecret',$clientSecret);
				// $redirectUrl =  $this->config->item('redirectMainUrl');
				$redirectUrl =  base_url('save-youtube-integration');
				// $redirectUrl =  base_url('integration');

				$gClient = new Google_Client();
				$gClient->setIncludeGrantedScopes(true);
				$gClient->setAccessType('offline');
				$gClient->setApprovalPrompt('force');
				$gClient->setApplicationName('vocalic');
				$this->set_yt_scopes($gClient);
				$gClient->setClientId($clientId);
				$gClient->setClientSecret($clientSecret);
				$gClient->setRedirectUri($redirectUrl);
				$authgURL = $gClient->createAuthUrl();
				//print_r($authgURL); die('d');
				$output['redirect']=$authgURL;
				echo json_encode($output);
				die;
				//redirect($authgURL);
			}else{
				$output["youtubeerror"]['clientId']=form_error('clientId');
				$output["youtubeerror"]['clientSecret']=form_error('clientSecret');
				echo json_encode($output);
				die;
			}
		}else{
			$output=array();
			$this->db->where('user_id',$this->owner_id);
			$this->db->where('business_id',$this->business_id);
			$query = $this->db->get('youtube_access_token');
			if($query->num_rows()>0){
				$yt_access_token = $query->row_array()['access_token'];
				$output['yt_access_token'] = json_decode($yt_access_token);
			}
 			//echo"<pre>";print_r($output); die;
		}
		$this->session->set_flashdata('active_tab', 'youtube');
		redirect('integration'); 
// 		$this->loadView('yt_integration/youtube-integration', $output);
	}


	/* Access token data */
	public function get_new_access_token(){

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
// $response = curl_exec($ch);
// $error = curl_error($ch);

// curl_close($ch);

// echo "<pre>";
// echo "cURL Error:\n";
// var_dump($error);

// echo "\n\nGoogle Response:\n";
// echo $response;

// die;
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
	public function get_client_data(){
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

	/* Access token data */



	public function save_youtube_integration(){
		$clientId = $this->session->userdata('yt_clientId');
		$clientSecret = $this->session->userdata('yt_clientSecret');
		$redirectUrl =  base_url('save-youtube-integration');

		$gClient = new Google_Client();
		$this->set_yt_scopes($gClient);
		$gClient->setApplicationName('vocalic');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectUrl);
		$gClient->setIncludeGrantedScopes(true);
		$gClient->setAccessType('offline');
		$gClient->setApprovalPrompt('force');

		if($this->input->get('code')) {
			$this->session->unset_userdata('yt_access_token_data');
			$gClient->authenticate($this->input->get('code'));
			$yt_access_token =$gClient->getAccessToken();
			//print_r($yt_access_token); die('r');
			$this->session->set_userdata('yt_access_token_data', $yt_access_token);
			redirect($redirectUrl);
		}
		$yt_access_token = $this->session->userdata('yt_access_token_data');
		//print_r($yt_access_token); die('r');
		if (isset($yt_access_token['access_token'])) {
			$this->session->unset_userdata('yt_access_token_data');
			$this->session->unset_userdata('yt_clientId');
			$this->session->unset_userdata('yt_clientSecret');
			$yt_data = array(
				'clientId'=>$clientId,
				'clientSecret'=>$clientSecret,
				'access_token'=>$yt_access_token['access_token'],
				'expires_in'=>$yt_access_token['expires_in'],
				'refresh_token'=>$yt_access_token['refresh_token'],
				'token_type'=>$yt_access_token['token_type'],
				'created'=>$yt_access_token['created'],
			);
			$this->session->set_userdata('yt_access_token', $yt_data);
			$this->load->model('youtube_integration_model');
			$this->youtube_integration_model->update_yt_access_token($this->owner_id,$this->business_id, $yt_data);
			$this->session->set_flashdata('flash_success', 'Success! Youtube integrated successfully.');
		}else{
			$this->session->set_flashdata('flash_error', 'Error! Some Error Occur.');
			//redirect(site_url('youtube-integration'));
		}
		redirect(site_url('youtube'));
	}

	public function set_yt_scopes($gClient) {
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
	public function check_yt_access_token(){
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

	public function refresh_yt_access_token($ses_yt_access_token) {
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
		$this->youtube_integration_model->update_yt_access_token($this->owner_id,$this->business_id,$yt_data);
	}



	public function youtube_list($key='') {
	    
	     if(!in_array('youtube_automation',$this->session->userdata('features')) ) {
            $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
		$segment = $this->uri->segment(1);
// 		pr($segment); die('dsadad');

		//Permissions Check
		$this->check_yt_access_token();

		$output['delete_video'] = true;
		$output['edit_video'] = true;
		$output['delete_video']=false;
		$output['edit_video']=false;
		$this->get_yt_playlist();
		$output['playlists'] = $this->yt_playlists;

		if($segment == 'youtube-v2-list'){
			$this->loadView('yt_integration/youtube_comments', $output);

		}else if($segment == 'youtube-v2-auto-comment'){

			$this->loadView('yt_integration/youtube_auto_comment', $output);

		}else{
			$this->loadView('yt_integration/y_videos', $output);
		}
	}



	public function get_yt_playlist($pageToken = ''){
		try{
			$maxResults=25;
			$response = $this->y_get_yt_playlist($maxResults,$pageToken);
			if(isset($response->error)){
				$this->session->set_flashdata('flash_error', 'Channel Not Found');
				redirect(base_url('dashboard'));
			} else {
				$playlist_data=array();
				$pageInfo=$response['pageInfo'];
				$playlist_items=$response['items'];
				$resultsPerPage=$pageInfo->resultsPerPage;
				$totalResults=$pageInfo->totalResults;
				$nextPageToken=$response->nextPageToken;

				foreach($playlist_items as $item_key=>$item) {
					$snippet=$item['snippet'];
					$this->yt_playlists[] = array(
					"id"=>$item['id'],
					"title"=>$snippet['title']
					);
				}

				if($totalResults >= $resultsPerPage && $nextPageToken!=''){
					$this->get_yt_playlist($nextPageToken);
				}
			}
		} catch(Exception $e) {
			$this->session->set_flashdata('flash_error', 'Some Error Occur.');
			redirect(base_url('dashboard'));
		}
	}

	public function y_get_yt_playlist($maxResults=50,$pageToken = ''){
		try{
			$gClient = $this->getClient();
			$service = new Google_Service_YouTube($gClient);
			return $this->playlistsListMine($service, 'snippet,contentDetails', array('mine' => true, 'maxResults' => $maxResults, 'onBehalfOfContentOwner' => '', 'onBehalfOfContentOwnerChannel' => '','pageToken'=>$pageToken));
		}catch(Google_Service_Exception $e) {
			return $error = json_decode($e->getMessage());
		}
	}

	public function playlistsListMine($service, $part, $params) {
		$params = array_filter($params);
		$response = $service->playlists->listPlaylists( $part, $params );
		//echo"<pre>";print_r($response);die('r');
		return $response;
	}
    
	public function get_videos_json() {
		$videos_data = array();
		
		$limit = $this->input->get('limit');
		if($this->input->get('pageToken') && $this->input->get('pageToken')!=''){
			$pageToken = $this->input->get('pageToken');
		} else {
			$pageToken = '';
		}
		try {
			if(!$this->input->get('searchKey')){
				if(empty($this->input->get('playlist_id')) || $this->input->get('playlist_id')=='all'){
					$response = $this->get_yt_channels_list();
					$channel_item=$response['items'][0];
					$contentDetails=$channel_item['contentDetails']['relatedPlaylists'];
					$playlist_id = $contentDetails['uploads'];
				}else{
					$playlist_id =$this->input->get('playlist_id');
				}
				$videos_data1 = $this->get_playlist_videos($playlist_id,$pageToken,$limit);
			
				// echo '<pre>';
				// print_r($videos_data1);
				// die;
				
				$pageInfo=$videos_data1['pageInfo'];
				$videos_data['pagination']['resultsPerPage']=$pageInfo['resultsPerPage'];
				$videos_data['pagination']['totalResults']=$pageInfo['totalResults'];
				// $videos_data['pagination']['nextPageToken']=$videos_data1['nextPageToken'];
				// $videos_data['pagination']['prevPageToken']=$videos_data1['prevPageToken'];
				$videos_data['pagination']['nextPageToken'] = isset($videos_data1['nextPageToken']) ? $videos_data1['nextPageToken'] : '';
				$videos_data['pagination']['prevPageToken'] = isset($videos_data1['prevPageToken']) ? $videos_data1['prevPageToken'] : '';
				$video_ids = array();
				
	
				if(isset($videos_data1['items'])){
					foreach($videos_data1['items'] as $item_key=>$item){
						$video_ids[$item_key] = $item['contentDetails']['videoId'];
					}
				}

// echo "<pre>";
// 					print_r($video_ids);
// 					die; 
// echo "<br>COUNT = ".count($video_ids);
// die;
// echo '<pre>';
// echo "Video IDs Count: ".count($video_ids);
// print_r($video_ids);
// die;
				if(count($video_ids)>0){
					$this->get_video_stats_by_ids_nd_display_videos($video_ids,$videos_data);
				}

				echo json_encode($ajaxData);
				die;              

			} else {

				$keyword = $this->input->get('searchKey');
				$videos_data1 = $this->search_videos($keyword,$pageToken ,$limit);

			
				$pageInfo=$videos_data1['pageInfo'];
				$videos_data['pagination']['resultsPerPage']=$pageInfo['resultsPerPage'];
				$videos_data['pagination']['totalResults']=$pageInfo['totalResults'];
				$videos_data['pagination']['nextPageToken']=$videos_data1['nextPageToken'];
				$videos_data['pagination']['prevPageToken']=$videos_data1['prevPageToken'];
				$video_ids = array();


				if(isset($videos_data1['items'])){
					foreach($videos_data1['items'] as $item_key=>$item){
						$video_ids[$item_key] = $item['id']['videoId'];
					}
				}
				if(count($video_ids)>0){
					$this->get_video_stats_by_ids_nd_display_videos($video_ids,$videos_data);
				}
			}
        
        
		} catch(Exception $e) {
		  //  die("get_video_json");
		  // echo "<pre>";
    // echo $e->getMessage();
    // print_r($e);
    // die;
			$err_msg='Error! Some Error Occur.';
			$output['error']=array("message"=>$err_msg,'type'=>'flash');
			echo json_encode($output);
			die;
		}
	}

	public function search_videos($keyword = '', $pageToken = '', $maxResults = 2)
	{
		try {

			$gClient = $this->getClient();

			$service = new Google_Service_YouTube($gClient);

			$params = [
				'q' => $keyword,
				'type' => 'video',
				'maxResults' => $maxResults,
				'pageToken' => $pageToken,
				'forMine' => true
			];

			return $service->search->listSearch(
				'snippet',
				array_filter($params)
			);

		} catch(Exception $e) {

			log_message('error', $e->getMessage());

			return [
				'items' => [],
				'pageInfo' => [
					'totalResults' => 0,
					'resultsPerPage' => 0
				]
			];
		}
	}

	public function get_video_stats_by_ids_nd_display_videos($video_ids,$videos_data){
// 	  ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);  
		$video_ids = implode(',',$video_ids);
  
		$response = $this->video_list_by_ids($video_ids,'snippet,status,statistics');
// 		echo '<pre>';
// var_dump($response);
// die;
 
		if(isset($response['items']) && isset($response['pageInfo'])){
			$limit = $this->input->get('limit');
			$pageNo = $this->input->get('pageNo');
			$response['items'];
			
			foreach($response['items'] as $item_key=>$item){
			    
			    if (!isset($item['status']['privacyStatus']) || $item['status']['privacyStatus'] != 'public') {
                continue;
            }
				$snippet=$item['snippet'];
				$thumbnail=$item['snippet']['thumbnails'];
				$videos_data['videos'][$item_key]['sr_no']=$item_key+1+(($pageNo-1)*$limit);
				$videos_data['videos'][$item_key]['id']=$item['id'];
				$videos_data['videos'][$item_key]['title']=$snippet['title'];
				$videos_data['videos'][$item_key]['publishAt']=$item['status']['publishAt'];
				$videos_data['videos'][$item_key]['publishedAt']=$snippet['publishedAt'];
				$videos_data['videos'][$item_key]['description']=$snippet['description'];
				$videos_data['videos'][$item_key]['uploadStatus']=$item['status']['uploadStatus'];
				$videos_data['videos'][$item_key]['privacyStatus']=$item['status']['privacyStatus'];
				$videos_data['videos'][$item_key]['viewCount']=(int)$item['statistics']['viewCount'];
				$videos_data['videos'][$item_key]['likeCount']=(int)$item['statistics']['likeCount'];
				$videos_data['videos'][$item_key]['dislikeCount']=(int)$item['statistics']['dislikeCount'];
				$videos_data['videos'][$item_key]['favoriteCount']=(int)$item['statistics']['favoriteCount'];
				$videos_data['videos'][$item_key]['commentCount']=(int)$item['statistics']['commentCount'];
				$videos_data['videos'][$item_key]['thumbnail']=$thumbnail['high']['url'];
			}
			$ajaxData = array( "recordsTotal"=>$videos_data['pagination']['totalResults'], "recordsFiltered"=>$videos_data['pagination']['resultsPerPage'], "nextPageToken"=>$videos_data['pagination']['nextPageToken'], "prevPageToken"=>$videos_data['pagination']['prevPageToken'], "data"=>$videos_data['videos'], );
			echo json_encode($ajaxData);
			die;
		}

		$ajaxData = array( "recordsTotal"=>0, "recordsFiltered"=>0, "nextPageToken"=>'', "prevPageToken"=>'', "data"=>array(), );
		echo json_encode($ajaxData);
		die;
	}

	public function video_list_by_ids($video_ids,$part=''){

    if($part==''){
        $part='snippet,contentDetails,statistics,status,player';
    }

    $gClient = $this->getClient();

    $service = new Google_Service_YouTube($gClient);

    $video_data = $this->videosListMultipleIds(
        $service,
        $part,
        array('id' => $video_ids)
    );
    
    return $video_data;
}

	public function videosListMultipleIds($service, $part, $params) {
		$params = array_filter($params);
		$response = $service->videos->listVideos( $part, $params );
		return $response;
	}

	public function get_yt_channels_list(){
		$gClient = $this->getClient();
		$service = new Google_Service_YouTube($gClient);
		$channel_data = $this->channelsListManagedByMe($service,'snippet,contentDetails,statistics',
		array('managedByMe' => true, 'onBehalfOfContentOwner' => ''));
		return $channel_data;
	}

	public function playlistItemsListByPlaylistId($service, $part, $params) {
		$params = array_filter($params);
		$response = $service->playlistItems->listPlaylistItems( $part, $params );
		return $response;
	}

	public function channelsListManagedByMe($service, $part, $params) {
		$params = array_filter($params);
		$response = $service->channels->listChannels('snippet,contentDetails,statistics', array( 'mine' => 'true','maxResults' => 25 ));
		$propGetter = Closure::bind(  function($prop){return $this->$prop;}, $response, $response );
		return $response;
	}

	public function get_playlist_videos($playlistId,$pageToken='',$maxResults=50,$part=''){

		if($part==''){
			$part='snippet,contentDetails,status';
		}
		$gClient = $this->getClient();
		$service = new Google_Service_YouTube($gClient);
		return $this->playlistItemsListByPlaylistId($service,$part,array('maxResults' => $maxResults, 'playlistId' => $playlistId,'pageToken'=>$pageToken));
	}

	// Function to like a YouTube video
	function videolike() {
        $output =array();
		if(!$this->session->userdata('yt_access_token')) {
			$output['error'] = 'Please Integrate Youtube';
			echo json_encode($output); die;
		}
		$this->check_yt_access_token();
		$access_token_data=$this->session->userdata('yt_access_token');
		$client = new Google_Client();
        $client->addScope('https://www.googleapis.com/auth/youtube.force-ssl');
        $client->setAccessToken($this->get_new_access_token());
        $youtube = new Google_Service_YouTube($client);
        $videoId = "LZsiflidRAA"; // Replace with actual video ID
        $action = "like"; // Change to "dislike" or "none"
        try {
            $fgfdgdf=$youtube->videos->rate($videoId, $action);
           echo "<pre>"; print_r($fgfdgdf); die;
            echo "Video $action successfully!";
        } catch (Google_Service_Exception $e) {
            echo "Error: " . $e->getMessage();
        }


    }




    public function all_videos($value='')
    {

    	$output = [];

		$this->loadView('yt_integration/all_list', $output);
    }

    public function all_list()
    {
        $search_query = $this->input->get('search_txt') ? $this->input->get('search_txt') : '';
        $max_results = $this->input->get('limit') ? $this->input->get('limit') : 10;
        $page_token = $this->input->get('page_token') ? "&pageToken=".$this->input->get('page_token') : '';

        $url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=" . urlencode($search_query) . "&maxResults=$max_results&type=video" . $page_token;

        $all_list = $this->getCurlData($url);
        echo json_encode($all_list);
    }

   public function getVideoDetails(){
		$videoId = $this->input->post('videoId');
		$videoData = $this->video_list_by_ids([$videoId], 'snippet,contentDetails,status,statistics');
		/* pr($videoData);
		die('sid'); */
		$finalOutput =  array(
			'video_url' => 'https://www.youtube.com/embed/'.$videoId,
			'video_title' => $videoData['items'][0]['snippet']['title'],
			'video_description' => $videoData['items'][0]['snippet']['description'],
			'video_tags' => $videoData['items'][0]['snippet']['tags'],
			'thumbnail' => $videoData['items'][0]['snippet']['thumbnails'],
			'thumbnail' => $videoData['items'][0]['snippet']['thumbnails'],
			'privacyStatus' => $videoData['items'][0]['status']['privacyStatus'],
			'publishAt' => $videoData['items'][0]['status']['publishAt'],
			'embeddable' => $videoData['items'][0]['status']['embeddable'],
			'madeForKids' => $videoData['items'][0]['status']['madeForKids'],
			'publishedAt' => $videoData['items'][0]['snippet']['publishedAt'],
			'categoryId' => $videoData['items'][0]['snippet']['categoryId'],
		);
		echo json_encode($finalOutput);
	}

    public function getComments()
    {
        $videoId = $this->input->get('videoId');
        $url = "https://www.googleapis.com/youtube/v3/commentThreads?part=snippet&videoId=$videoId&maxResults=5";
        echo json_encode($this->getCurlData($url));
    }


    public function getLastComments($videoId = null,$channalId = null)
    {

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
				$isOwner = ($commentAuthorChannelId === $channalId);


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
			$isOwner = ($replySnippet['authorChannelId']['value'] ?? '') === $channalId;

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
        $access_token_data = $this->session->userdata('yt_access_token');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $this->get_new_access_token()]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function postComment()
	{
	    $access_token_data = $this->session->userdata('yt_access_token');
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
	        "Authorization: Bearer " . $this->get_new_access_token(),
	        "Content-Type: application/json"
	    ]);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

	    $response = curl_exec($ch);
	    curl_close($ch);

	    echo json_encode(["success" => true, "data" => json_decode($response)]);
	}

	public function likeVideo()
	{
		$getdata = json_decode(file_get_contents('php://input'), true);

	    $access_token_data = $this->session->userdata('yt_access_token');
	    $videoId = $getdata['videoId'];
	    $action = $getdata['action']; // 'like' or 'dislike'

	    $url = "https://www.googleapis.com/youtube/v3/videos/rate?id=$videoId&rating=$action";


		// pr($access_token_data);
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, [
	        "Authorization: Bearer " . $this->get_new_access_token()
	    ]);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);

	    $response = curl_exec($ch);
	    curl_close($ch);

	    echo json_encode(["success" => true]);
	}


	function getChannalID($videoId){
		//  Get channelId from videoId
		$access_token_data = $this->session->userdata('yt_access_token');
		$videoDetailsUrl = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id={$videoId}";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $videoDetailsUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer " . $this->get_new_access_token()
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

	public function subscribeChannal()
	{
		$getdata = json_decode(file_get_contents('php://input'), true);

		$access_token_data = $this->session->userdata('yt_access_token');
		$videoId = $getdata['videoId'];
		$action = $getdata['action']; // default to subscribe

		if(empty($action)){
			return json_encode(['status' => false,'data' => 'empty' ]);
			die;
		}

		$channelId = $this->getChannalID($videoId);

		// Step 2: Check if already subscribed
		$checkSubUrl = "https://www.googleapis.com/youtube/v3/subscriptions?part=id&forChannelId={$channelId}&mine=true";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $checkSubUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer " . $this->get_new_access_token()
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$subResponse = curl_exec($ch);
		$subData = json_decode($subResponse, true);
		curl_close($ch);

		$alreadySubscribed = !empty($subData['items']);
		$subscriptionId = $alreadySubscribed ? $subData['items'][0]['id'] : null;

		if ($action === 'unsubscribe') {
			if ($alreadySubscribed) {
				// Unsubscribe
				$unsubscribeUrl = "https://www.googleapis.com/youtube/v3/subscriptions?id={$subscriptionId}";

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $unsubscribeUrl);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					"Authorization: Bearer " . $this->get_new_access_token()
				]);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

				curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);

				echo json_encode([
					"success" => $status == 204,
					"message" => $status == 204 ? "Unsubscribed successfully" : "Failed to unsubscribe"
				]);
			} else {
				echo json_encode(["success" => false, "message" => "Not subscribed already"]);
			}
			return;
		}

		// If already subscribed
		if ($alreadySubscribed) {
			echo json_encode([
				"success" => false,
				"message" => "Already subscribed"
			]);
			return;
		}

		// Step 3: Subscribe to the channel
		$subscribeUrl = "https://www.googleapis.com/youtube/v3/subscriptions?part=snippet";

		$postData = [
			"snippet" => [
				"resourceId" => [
					"kind" => "youtube#channel",
					"channelId" => $channelId
				]
			]
		];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $subscribeUrl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer " . $this->get_new_access_token(),
			"Content-Type: application/json"
		]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		$subscribeResponse = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		echo json_encode([
			"success" => $httpStatus == 200,
			"message" => $httpStatus == 200 ? "Subscribed successfully" : "Failed to subscribe",
			"status" => $httpStatus
		]);
	}


	public function ylists()
    {
        $this->loadView("yt_integration/video_youtube_list");
    }





	public function postReply($parentCommentId, $replyText){
		$accessToken = $this->session->userdata('yt_access_token'); // however you store it

		// $access_token_data = $this->session->userdata('yt_access_token');
		$url = 'https://www.googleapis.com/youtube/v3/comments?part=snippet';
		$realParentCommentId =  explode(".",$parentCommentId);


		$data = [
			'snippet' => [
				'parentId' => $realParentCommentId[0],
				'textOriginal' => $replyText
			]
		];

		$headers = [
			'Authorization: Bearer ' . $this->get_new_access_token(),
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


	private function postReplyToComment($commentId, $text){
		$url = "https://youtube.googleapis.com/youtube/v3/comments?part=snippet";
		$yt_access_token = $this->session->userdata('yt_access_token');
		$token = $this->get_new_access_token();

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

	private function likeComment($commentId){
		$url = "https://youtube.googleapis.com/youtube/v3/comments/setModerationStatus";
		$yt_access_token = $this->session->userdata('yt_access_token');
		$token = $this->get_new_access_token(); // Get the user's access token

		$postData = [
			"id" => $commentId,
			"moderationStatus" => "published", // Approve the comment (moderation status set to published)
			"banAuthor" => false // Do not ban the author
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

		// Get the response
		$response = curl_exec($ch);

		// Close the cURL session
		curl_close($ch);

		// Output the response for debugging
		

		// Return the decoded JSON response
		return json_decode($response, true);
	}


	public function processReplyAutomation() {
		$open_ai = new OpenAi($this->openaikey);
		$youtubeSettings = $this->db->get_where('youtube_automation_reply', ['user_id' => $this->owner_id, 'business_id' => $this->business_id, 'status' => 1])->result_array();
		foreach ($youtubeSettings as $config) {
			$stop_setting    = (int)$config['stop_setting'];
			$videoId         = $config['video_id'];
			$maxActivity     = (int)$config['max_activity'];
			$triggerkeywords = $config['keywords'];
			$createdAt       = strtotime($config['created_at']);
			$delayAmount     = (int)$config['delay_activity'];
			$channalId      = $config['channel_id'];
			$delayUnit       = strtolower(trim($config['delay_activity_time']));
			$schedule_time       =$config['schedule_time'];
			$reply_text       = $config['reply_text'];

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
				pr($finalComments);
				die('sid');
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

					$this->postReplyToComment($comment['id'], $replyMessage);

				}
				$new_schedule_time  =  $final_time +  $delayInSeconds;
				$this->db->where('user_id', $this->owner_id);
				$this->db->where('business_id', $this->business_id);
				$this->db->update('youtube_automation_reply', ['schedule_time' => $new_schedule_time]);

			}

			sleep(5); // Optional between each reply
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



	public function insert_v2_reply(){
		$params = json_decode(file_get_contents('php://input'), true);
		$update_id =  $this->input->post('update_id');
		$video_id =  $this->input->post('video_id');


		$channel_id =  $this->getChannalID($this->input->post('video_id'));
		$delayAmount = $this->input->post('delay_activity');
		$delayUnit = $this->input->post('delay_activity_time');

		$delayInSeconds  = $this->getDelayInSeconds($delayAmount, $delayUnit);
		$schedule_time  =  time() + $delayInSeconds;
		$keyword = $this->input->post('keywords');

		$data = array(
			'user_id'             => $this->user_id,
			'business_id'         => $this->business_id,
			'autolike'            => $this->input->post('autolike'),
			'video_id'            => $video_id,
			'thumbnail'           => $this->input->post('thumbnail'),
			'channel_id'          => $channel_id,
			'keywords'            => !empty($keyword[0]) ? $keyword : '',
			'reply_text'          => $this->input->post('reply_text'),
			'max_activity'        => $this->input->post('max_activity'),
			'delay_activity'      => $this->input->post('delay_activity'),
			'delay_activity_time' => $this->input->post('delay_activity_time'),
			'stop_setting'        => $this->input->post('stop_setting'),
			'stop_setting_time'   => 'days',
			'schedule_time'       => $schedule_time,
			'status'   			  => 1
		);

		
		if($update_id){
			$this->db->where('id', $update_id);
			$this->db->update('youtube_automation_reply', $data);
			echo json_encode(['status' => true, 'message' => 'Updated successfully']);
		}else{
			$getDataviaVideoId = $this->db->get_where('youtube_automation_reply', [
				'user_id' => $this->owner_id,
				'business_id' => $this->business_id,
				'video_id' => $video_id
			])->result_array();

			if($video_id == $getDataviaVideoId[0]['video_id']){
				$this->db->where('video_id', $video_id);
				$this->db->update('youtube_automation_reply', $data);
				echo json_encode(['status' => true, 'message' => 'Updated successfully']);
			}else{
				$this->db->where('user_id', $this->owner_id);
				$this->db->where('business_id', $this->business_id);
				$query = $this->db->insert('youtube_automation_reply', $data);
				echo json_encode(['status' => true, 'message' => 'Inserted successfully']);

			}

		}

	}


	public function run_cron_youtube_reply(){
		// Get all active automation entries
		$automations = $this->db->get_where('youtube_automation_reply', [
			'user_id' => $this->owner_id,
			'business_id' => $this->business_id
		])->result_array();

		foreach ($automations as $automation) {
			$videoId = $automation['video_id'];
			$this->getLastComments($videoId); // Call modified getLastComments that accepts $videoId
		}

		echo "Cron job executed successfully.";
	}


	public function test_process_reply(){
		$res = $this->processReplyAutomation(); // Call your main logic here
		echo "Reply automation test complete.";
	}

	public function updateCommentData($videoId =  null){
		if ($videoId === null) {
			show_error('Video ID is required', 400);
		}
		$data['video_data'] = $this->db->get_where('youtube_automation_reply', [
			'video_id' => $videoId,
			'user_id' => $this->owner_id,
			'business_id' => $this->business_id
		])->result_array();

		$this->loadView('yt_integration/youtube_comments', $data);

	}



   /* Post auto Comment on my video  */


   	public function videoComment($video_id, $comment_text) {
		$access_token = $this->get_new_access_token();
		
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
			echo "✅ Comment posted successfully!";
		} else {
			echo "❌ Failed to post comment. Response:<br><pre>$response</pre>";
		}
	}


	public function insertAutoComment(){
		$params = json_decode(file_get_contents('php://input'), true);
		$update_id =  $this->input->post('update_id');
		$video_id =  $this->input->post('video_id');

		$delayAmount = $this->input->post('delay_activity');

		$delayInSeconds  = $this->getDelayInSeconds($delayAmount, 'hour');
		$schedule_time  =  time() + $delayInSeconds;

		$videos_ids =  json_encode($video_id,true);
		$comment_instant = $this->input->post('instant_comment');
		$comment_text =  $this->input->post('comment_text');
		$status = 1;


		if($comment_instant && !empty($comment_text)){
			foreach ($video_id as $video) {
				$this->videoComment($video, $comment_text);
			}
			$status = 0;
			echo json_encode(['status' => true, 'message' => 'Status is 0 now and instant comment works successfully']);
		}
	
		$data = array(
			'user_id'             => $this->owner_id,
			'business_id'         => $this->business_id,
			'video_id'            => $videos_ids,
			'channal_id'          => $channel_id,
			'comment_text'        => $comment_text,
			'comment_instant'     => $this->input->post('instant_comment'),
			'comment_delay'       => $this->input->post('delay_activity'),
			'schedule_time'       => $schedule_time,
			'status'     		  => $status
		);

		if($update_id){
			$this->db->where('id', $update_id);
			$this->db->update('youtube_automation_comment', $data);
			echo json_encode(['status' => true, 'message' => 'Updated successfully']);
		}else{
			$this->db->insert('youtube_automation_comment', $data);
			echo json_encode(['status' => true, 'message' => 'Inserted successfully']);
		}
	}


	public function processAutoComment() {
		$youtubeSettings = $this->db->get_where('youtube_automation_comment', ['user_id' => $this->owner_id, 'business_id' => $this->business_id, 'status' => 1])->result_array();
		foreach ($youtubeSettings as $config) {
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
			$this->db->where('user_id', $this->owner_id);
			$this->db->where('business_id', $this->business_id);
			$this->db->update('youtube_automation_comment', ['schedule_time' => $new_schedule_time , 'status' => 0]);
		}
		echo json_encode(['status' => true, 'message' => 'Reply automation processed']);
	}

	public function testAutoComment(){
		$this->processAutoComment();
	}




	/* Delete Video Functionality */


	public function processDeleteVideo() {
		$getdata = json_decode(file_get_contents('php://input'), true);
		$videosId = $getdata['videos_ids'];

		if (!empty($videosId)) {
			foreach ($videosId as $id) {
				// Delete from YouTube
				$this->delete_youtube_video($id);
				// Delete from your database
				$this->db->where('user_id', $this->owner_id);
				$this->db->where('business_id', $this->business_id);
				$this->db->where('video_id', $id); // Use $id from loop
				$this->db->delete('youtube_publisher'); // Table name assumed to be 'videos'
			}

			echo json_encode(['success' => true, 'message' => 'Video(s) deleted successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'No video IDs provided']);
		}
	}

	public function delete_youtube_video($videoId) {

		$accessToken = $this->get_new_access_token(); // Must belong to the video owner
		$url = 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoId;
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Authorization: Bearer ' . $accessToken,
			'Accept: application/json'
		]);

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $response;
	}



	/* Youtube Publish Code */
	public function publishYoutube(){
	    if(!in_array('youtube_automation',$this->session->userdata('features')) ) {
            $flashdata['error']['message'] = "Please Upgrade Your Plan To Use This Feature";
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect(site_url('subscription'));
        }
        
        $this->check_yt_access_token();
		$this->loadView('yt_integration/y_videos');
	}
	
	public function uploadOwnVideo()
    {
        if (!empty($_FILES['video']['name'])) {
            $uploaded_video = $this->addLibraryImages('video', 'video');
            if ($uploaded_video && !empty($uploaded_video['data']['error'])) {
                echo json_encode([
                    'status' => 'error',
                    'error'  => 'Your video file type is not allowed'
                ]);
                return;
            }
            
            $video_url = $this->config->item('cdn_url'). $uploaded_video;
            echo json_encode([
                'status' => 'success',
                'video_url' => $video_url
            ]);
            return;
        } else {
            echo json_encode([
                'status' => 'error',
                'error'  => 'No video file uploaded'
            ]);
            return;
        }
    }


	
	
	public function youtubeUpload(){
	   // $this->Common_Model->checkPlanCountAccess('youtube_upload_count',false);
		$data['video_name'] = $_POST['video-name'];
		$data['video_url'] = $_POST['video-url'];
		$this->check_yt_access_token();

		$this->loadView('yt_integration/youtube-publish',$data);

	}




	public function insertYoutubePublisher() {
	   // pr($_POST); die;
	    
		$status = 1;
		$update_id = $this->input->post('update_id');
		$data = array(
			'user_id'            => $this->owner_id,
			'business_id'        => $this->business_id,
			'title'              => $this->input->post('title'),
			'description'        => $this->input->post('description'),
			'tags'               => $this->input->post('tags'),
			'thumbnail'          => $this->input->post('thumbnail'),
			'thumbnail_id'       => $this->input->post('thumbnail_id'),
			'video_url'          => $this->input->post('video_url'),
			'video_id'           => NULL,
			'schedule_date_time' => $this->input->post('schedule_date_time'),
			'publish_type'       => $this->input->post('publish_type'),
			'video_cat'          => $this->input->post('video_cat'),
			'allow_embeding'     => $this->input->post('allow_embeding'),
			'age_restriction'    => $this->input->post('age_restriction'),
			'copyright_content'  => $this->input->post('copyright_content'),
			'visiblity'          => $this->input->post('visiblity'),
			'status'             => $status
		);
		

		// Handle thumbnail upload
// 		if (!empty($_FILES['thumbnail']['name'])) {
// 			$ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
// 			$upload_path = FCPATH . 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/';
// 			$file_name = 'thumbnail_' . time() . '.' . $ext;
		
// 			if (!is_dir($upload_path)) {
// 				mkdir($upload_path, 0755, true);
// 			}
// 			$data['thumbnail'] = 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/' . $file_name;
//              move_uploaded_file($_FILES["thumbnail"]["tmp_name"], 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/' . $file_name);
              
//             $this->uploadAWS($data['thumbnail']);
         
// 		/*	$config = [
// 				'upload_path'   => $upload_path,
// 				'allowed_types' => 'png|jpg|jpeg',
// 				'file_name'     => 'thumbnail_' . time() . '.' . $ext,
// 				'overwrite'     => TRUE,
// 				'detect_mime'   => TRUE
// 			];

// 			$this->load->library('upload', $config);
// 			$this->upload->initialize($config);

// 			if ($this->upload->do_upload('thumbnail')) {
// 				$fileData = $this->upload->data();
// 				$data['thumbnail'] = 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/' . $fileData['file_name'];
// 				$this->uploadAWS($data['thumbnail']);
// 				$data['thumbnail'] = $this->config->item('cdn_url') . $data['thumbnail'];
// 			}*/
// 		}

            if (!empty($_FILES['thumbnail']['name'])) {
            
                $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
                $upload_path = FCPATH . 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/';
                $file_name = 'thumbnail_' . time() . '.' . $ext;
            
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0755, true);
                    echo "Created directory: " . $upload_path . "<br>";
                }
            
                $source = $_FILES["thumbnail"]["tmp_name"];
                $destination = $upload_path . $file_name;
            
                if (move_uploaded_file($source, $destination)) {
                    // echo "file successfully moved.<br>";
                    $data['thumbnail'] = 'assets/uploads/users/' . $this->owner_id . '/youtube_thumbnails/' . $file_name;
                } else {
                    echo "Failed to move file.<br>";
                    echo "Error info:<br>";
                    print_r(error_get_last());
                }
            
                // die("Upload test completed.");
            }

		
// 		print_r($data['thumbnail']); die('here');

		// Upload video via API
		$videoResult = ['status' => false];
		
		if($update_id){
			$videoResult = $this->updateVideoData($data, $update_id);
		}else{
			$videoResult = $this->uploadData($data);
		}
// 		 echo '<pre>'; print_r($videoResult); die;
		if ($videoResult['thumbnail_path']) {
			// Normalize boolean values
			$data['publish_type']       = ($this->input->post('publish_type') === 'true') ? 1 : 0;
			$data['allow_embeding']     = ($this->input->post('allow_embeding') === 'true') ? 1 : 0;
			$data['age_restriction']    = ($this->input->post('age_restriction') === 'true') ? 1 : 0;
			$data['copyright_content']  = ($this->input->post('copyright_content') === 'true') ? 1 : 0;

			$data['video_id'] = $videoResult['video_id'];

			// model and save data
			$saveResult = $this->Youtube_integration_model->save_youtube_publisher($data, $update_id);
			
// 			pr($saveResult); die();

			header('Content-Type: application/json');
			echo json_encode([
				'status' => $saveResult,
				'message' => $saveResult ? ($update_id ? 'Video Edited Successfully !' : 'Inserted successfully') : ($update_id ? 'Update failed' : 'Insert failed'),
				'video_id' => $videoResult['video_id'],
				'thumbnail_path' => $videoResult['thumbnail_path'],
				'video_url' => $videoResult['video_url']
			]);
		} else {
			echo json_encode([
				'status' => false,
				'message' => $videoResult['msg'],
				'thumbnail_path' => '',
				'video_url' => $videoResult['video_url']
			]);
		}
	}

	/* Youtube Publish Code */


	public function edtiorActions(){
		header("Content-Type: application/json");

		$text    = $_POST['text'] ?? '';
		$action  = $_POST['action'] ?? '';
		$workFor = $_POST['workFor'] ?? ''; // Added workFor to guide prompt
		$prompt  = "";

		// Determine prompt instruction based on `action` and `workFor`
		switch ($workFor) {
			case "summernoteText":
				switch ($action) {
					case "rephrase":
						$prompt = "Rephrase the following YouTube video title to be more engaging and SEO-friendly: \"$text\"";
						break;
					case "make_longer":
						$prompt = "Expand the following video title slightly while keeping it under 80 characters and optimized for SEO: \"$text\"";
						break;
					case "make_shorter":
						$prompt = "Shorten this video title to make it concise and catchy under 80 characters: \"$text\"";
						break;
					case "simplyfy_langauge":
						$prompt = "Simplify this YouTube video title for broader audience appeal: \"$text\"";
						break;
					case "Improve_Writing":
						$prompt = "Improve the clarity and SEO-friendliness of this YouTube title: \"$text\"";
						break;
					case "Summarize":
						$prompt = "Summarize this video title into a more concise version: \"$text\"";
						break;
					default:
						$prompt = "Improve this YouTube video title: \"$text\"";
				}
				break;

			case "summernoteDescription":
				switch ($action) {
					case "rephrase":
						$prompt = "Rephrase the following YouTube video description while keeping it SEO-optimized and engaging: \"$text\"";
						break;
					case "make_longer":
						$prompt = "Expand this video description with more details and keywords for better SEO: \"$text\"";
						break;
					case "make_shorter":
						$prompt = "Shorten and summarize this video description to highlight key points: \"$text\"";
						break;
					case "simplyfy_langauge":
						$prompt = "Simplify the language of this video description for easier understanding: \"$text\"";
						break;
					case "Improve_Writing":
						$prompt = "Improve the writing quality and structure of this YouTube description: \"$text\"";
						break;
					case "Summarize":
						$prompt = "Summarize this YouTube description in a clear and concise way: \"$text\"";
						break;
					default:
						$prompt = "Improve this YouTube video description for SEO and readability: \"$text\"";
				}
				break;

			case "summernoteTags":
				$prompt = "Output tags as a '#' hashtag list, 
            	- dont-t give me the html output i want only texts hastags like instagram hastags";
				switch ($action) {
					case "rephrase":
						$prompt .= "Rephrase these YouTube tags to be more relevant and SEO-optimized: \"$text\"";
						break;
					case "make_longer":
						$prompt .= "Add more relevant YouTube tags to this list: \"$text\"";
						break;
					case "make_shorter":
						$prompt .= "Reduce this list of YouTube tags to the most essential and high-performing ones: \"$text\"";
						break;
					case "simplyfy_langauge":
						$prompt .= "Simplify these YouTube tags while maintaining keyword relevance: \"$text\"";
						break;
					case "Improve_Writing":
						$prompt .= "Polish and optimize these tags for YouTube search visibility: \"$text\"";
						break;
					case "Summarize":
						$prompt .= "Summarize these tags into a more concise and focused list: \"$text\"";
						break;
					default:
						$prompt .= "Make these YouTube tags better and optimized: \"$text\"";
				}
				break;

			default:
				// Fallback if no valid `workFor` provided
				switch ($action) {
					case "rephrase":
						$prompt = "Rephrase this text: \"$text\"";
						break;
					case "make_longer":
						$prompt = "Expand this text with more detail: \"$text\"";
						break;
					case "make_shorter":
						$prompt = "Summarize this text concisely: \"$text\"";
						break;
					case "simplyfy_langauge":
						$prompt = "Simplify this text using clear language: \"$text\"";
						break;
					case "Improve_Writing":
						$prompt = "Improve the clarity and style of this text: \"$text\"";
						break;
					case "Summarize":
						$prompt = "Summarize this text in a concise manner: \"$text\"";
						break;
					default:
						$prompt = "Make better: \"$text\"";
				}
		}

		$openAI = new OpenAi($this->openaikey);
		$history[] = ["role" => "user", "content" => $prompt];

		$opt = [
			"model"             => "gpt-3.5-turbo",
			"messages"          => $history,
			"temperature"       => 0.5,
			"max_tokens"        => 1000,
			"frequency_penalty" => 0,
			"presence_penalty"  => 0,
		];

		$complete = $openAI->chat($opt);
		$data     = json_decode($complete, true);

		if (!isset($data['choices'][0]['message']['content'])) {
			echo json_encode(["error" => "Failed to generate text"]);
			exit;
		}

		$response_text = trim($data['choices'][0]['message']['content']);
		$response_text = preg_replace('/.*?\[\[|\]\]/', '', $response_text); // Optional cleanup
       
		echo json_encode(["modified_text" => $response_text]);
		exit;
	}


	public function makeBetterPrompt(){
			$prompt = $_POST['inputText'] ?? '';
			$workFor = $_POST['workFor'] ?? '';
			$currentText = $_POST['currentText'] ?? '';
			$open_ai_key = $this->openaikey;
			$openAI = new OpenAi($open_ai_key);

			// Generate the instruction prompt based on the workFor type
			switch ($workFor) {
				case 'summernoteText':
					$instruction = 'Generate a catchy, SEO-friendly YouTube video title based on this topic: "' . $prompt . '". The title should be under 80 characters and optimized for search and click-through rate.';
					break;

				case 'summernoteDescription':
					$instruction = 'Generate a compelling, SEO-optimized YouTube video description based on the following topic: "' . $prompt . '". The description should:
		- Clearly explain what the video is about
		- Include relevant keywords naturally
		- Highlight the value or benefits for viewers
		- Include a soft call-to-action encouraging viewers to like, comment, and subscribe
		- Be suitable for YouTube SEO
		- Keep the length under 2000 characters for quick readability';
					break;

				case 'summernoteTags':
					$instruction = 'Generate a list of the most relevant and high-performing YouTube tags for the following video topic: "' . $prompt . '". The tags should:
		- Be optimized for search and YouTube SEO
		- Include both short and long-tail keywords
		- Be highly relevant to the topic
		- Avoid duplicates or unrelated terms
		- Output tags as a "#" hashtag list, 
		- dont-t give me the html output i want only texts hastags like instagram hastags';
					break;

				default:
					echo json_encode(["error" => "Invalid input type"]);
					exit;
			}

			// Prepare the chat history with the final instruction
			/* $history = [
				[
					"role" => "user",
					"content" => "Modify the following keyword based on the given instruction and give me only direct text:\n\n" .
								"Instruction: \"$instruction\"\n\n" .
								"Current Text: \"$currentText\"\n\n"
				]
			]; */
			 $history[] = ["role" => "user", "content" => $instruction];
			 $history[] = ["role" => "system", "content" => "You are a helpful assistant that provides well-structured blog content in minified HTML format with inline css, witout header and footer."];
		

			$opt = [
				"model" => "gpt-3.5-turbo",
				"messages" => $history,
				"temperature" => 0.5,
				"max_tokens" => 1000,
				"frequency_penalty" => 0,
				"presence_penalty" => 0,
			];

			$complete = $openAI->chat($opt);
			$data = json_decode($complete, true);

			if (!isset($data['choices'][0]['message']['content'])) {
				echo json_encode(["error" => "Failed to generate text"]);
				exit;
			}

			$response_text = trim($data['choices'][0]['message']['content']);
			echo json_encode(["modified_text" => $response_text]);
			exit;
		}



	/* For Generating the Thumbnail USing Open Ai */


    	public function thumbnailChat() {
    // 	$this->Common_Model->checkPlanCountAccess('thumbnail_generate_count',false);
        	$this->db->where('id', $this->owner_id);
            $userData = $this->db->get('tbl_user')->row();
            $credit = $userData->credit ?? 0;
    	
    	header("Content-Type: application/json");
    
    	$parent_id   = $this->input->post('parent_id') ? $this->input->post('parent_id') : NULL;
    	$text        = $this->input->post('usertext');
    	$user_id     = $this->owner_id;
    	$business_id = $this->business_id;
    
    	if (!$text || !$user_id || !$business_id) {
    		echo json_encode(["error" => "Missing required fields"]);
    		exit;
    	}
    
    	// === Generate Image from DALL·E ===
    	$image_prompt = "Create a eye-catching YouTube thumbnail (16:9 aspect ratio) for a video about '{$text}'. Use a dynamic background with bright, vibrant colors and large, attention-grabbing text related to video topic. Include a character that is directly related to the topic , showing a emotion. Surround the character with visual elements that clearly represent the topic. The layout should be high contrast, clean, and optimized for mobile viewing. and image should be less then 1.5mb always";
    
    	$image_url = $this->openai_Image($image_prompt);
    	if(empty($image_url)){ echo json_encode([
    	    'success'=> false,
    	    "msg"=> "Image generation failed"
    	    ]);
    	    exit;}
    	// === Set the folder and filename ===
    // 	$ownerDirectoryName = FCPATH . 'assets/uploads/users/' . $this->owner_id;
    // 	$library_folder = "youtube_upload_data";
    // 	$directoryUrl = 'assets/uploads/users/' . $this->owner_id . '/' . $library_folder . '/';
    // 	$upload_path = $ownerDirectoryName . '/' . $library_folder . '/';
    // 	$filename = 'youtube_thumb_' . time() . '.jpg';
    // 	$full_path = $upload_path . $filename;
    	$cdn_status = 0;
    
    	// === Make sure the directory exists ===
    // 	if (!is_dir($upload_path)) {
    // 		mkdir($upload_path, 0755, true);
    // 	}
    	error_reporting(E_ALL);
    	ini_set('display_errors', 1);
    	
    	// === Download and compress the image ===
    // 	$image_data = file_get_contents($image_url);
    
    // 	if ($image_data !== false && is_dir($upload_path)) {
    // 		$image = @imagecreatefromstring($image_data);
    
    // 		if ($image === false) {
    // 			echo json_encode([
    // 				"success" => false,
    // 				"msg" => "Failed to process image data"
    // 			]);
    // 			exit;
    // 		}
    
    // 		$max_size = 1800000; // 1.8MB
    // 		$quality = 90;
    // 		$compressed = false;
    
    // 		do {
    // 			ob_start();
    // 			imagejpeg($image, null, $quality);
    // 			$compressed_data = ob_get_clean();
    
    // 			if (strlen($compressed_data) <= $max_size) {
    // 				file_put_contents($full_path, $compressed_data);
    // 				$compressed = true;
    // 				break;
    // 			}
    
    // 			$quality -= 5;
    // 		} while ($quality >= 10);
    
    // 		imagedestroy($image);
    
    // 		if ($compressed) {
    // // 			$image_url = $directoryUrl . $filename;
    // 			$msg = $this->uploadAWS('assets/uploads/users/' . $this->owner_id . '/' . $library_folder . '/' . $filename);
    // 			$cdn_status = 1;
    // 		} else {
    // 			echo json_encode([
    // 				"success" => false,
    // 				"msg" => "Could not compress image under 1.8MB"
    // 			]);
    // 			exit;
    // 		}
    // 	} else {
    // 		echo json_encode([
    // 			"success" => false,
    // 			"msg" => "Image Not Generated"
    // 		]);
    // 		exit;
    // 	}
    
    	// === Insert new chat entry ===
    	$insert_data = [
    		"user_id"     => $user_id,
    		"business_id" => $business_id,
    		"parent_id"   => $parent_id,
    			"human_text"  => $text,
    			"ai_response" => $image_url,
    			"cdn_status"  => $cdn_status,
    			"created_at"  => date('Y-m-d H:i:s'),
    			"updated_at"  => date('Y-m-d H:i:s')
    		];
    
    		$insert_id = $this->Youtube_integration_model->insert($insert_data);
    
    		// === Get the last inserted chat data as array for looping ===
    		$chat_history = $this->Youtube_integration_model->get_all_by_parent_id($insert_id); // returns as [array]
    		
    		$deducted_credit = 5;
                $this->db->set('credit', 'credit - ' . $deducted_credit, FALSE);
                $this->db->where('id', $this->owner_id);
                $this->db->update('tbl_user');
    
    		echo json_encode([
    			"success" => true,
    			"image_url" => $image_url,
    			"chat_history" => $chat_history
    		]);
    		exit;
    	}
    
    
    	/* public function getChat(){
    		$parent_id   = $this->input->post('parent_id') ? $this->input->post('parent_id') : NULL;
    		// === Get full chat history based on parent_id ===
    		$chat_history = $this->Youtube_integration_model->get_all_by_parent_id($insert_id);
    		echo json_encode([
    			"success" => true,
    			"chat_history" => $chat_history
    		]);
    		exit;
    	} */
    
    
    private function openai_Image($prompt){
        
        $open_ai_key = $this->openaikey;
        $url = "https://api.openai.com/v1/images/generations";
        $data = [
            "model"  => "gpt-image-1",
            "prompt" => $prompt,
            "size"   => "1024x1024"
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $open_ai_key
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            log_message('error', 'OpenAI Image Error: ' . json_encode($responseData));
            return false;
        }
        if (!isset($responseData['data'][0]['b64_json'])) {
            return false;
        }
        $base64_image = $responseData['data'][0]['b64_json'];
        $imageData = base64_decode($base64_image);
        $filename = 'youtube_thumb_' . time() . '.png';
        $upload_path = FCPATH . 'assets/uploads/users/' .
                       $this->owner_id .
                      '/youtube_upload_data/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        $full_path = $upload_path . $filename;
        file_put_contents($full_path, $imageData);
        return 'app/assets/uploads/users/' .
               $this->owner_id .
               '/youtube_upload_data/' .
               $filename;
    }

    public function uploadData($video_arr){
            // pr($_POST);
            // die();
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
            $sourceThumbnailPath = FCPATH . str_replace('app/', '', $video_arr['thumbnail']);

            $thumbnailData = @file_get_contents($sourceThumbnailPath);
            
            if (!$thumbnailData) {
                $output['status'] = false;
                $output['msg'] = 'Failed to read thumbnail image.';
                echo json_encode($output);
                die;
            }

            file_put_contents($thumbnailPath, $thumbnailData);
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

	public function updateVideoData($video_arr, $update_id){
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
	public function getYouTubeChannelInfo($token=null) {
		// Get the access token (adjust this as per your app's logic)
		$access_token = $this->get_new_access_token();

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
	public function getYoutubeVideoCount(){
		 $this->db->where('business_id',$this->business_id);
		$query = $this->db->get('youtube_publisher');
		$output['video_count'] = $query->num_rows();

		$this->loadView('dashboard',$output);
	}
	
	 public function resetYoutubeAPI(){
        $this->db->where('user_id', $this->owner_id);
        $this->db->where('business_id', $this->business_id);
        // $this->db->where('autoresponder_id', $id);
        $deleted = $this->db->delete('youtube_access_token');
        if ($deleted) {
            echo json_encode(['status' => true, 'message' => 'Credentials reset successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'No data found to delete or already deleted.']);
        }
    }
    
   public function analyzeVideo()
    {
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        // die('herer');
        // $url = $this->input->post('url');
        $url = 'https://www.youtube.com/watch?v=gHmqKkfABhA';
    
        $result = $this->analyzeyoutubeVideo($url);
    
        echo "<pre>";
        print_r($result);
    }
    
    public function update_optimized_metadata() {
    // Force JSON output header
    header('Content-Type: application/json');

    $video_id = $this->input->post('video_id');
    $title = strip_tags($this->input->post('title'));
    $description = strip_tags($this->input->post('description'));
    $tags_raw = $this->input->post('tags');
    $category_id = $this->input->post('category_id') ? $this->input->post('category_id') : '22';

    if(empty($video_id)) {
        echo json_encode(['status' => false, 'message' => 'Invalid or missing YouTube Video ID.']);
        exit;
    }

    // Refresh credentials tokens manually
    $this->check_yt_access_token();
    $client = $this->getClient();
    $youtube = new Google_Service_YouTube($client);

    try {
        // Prepare snippet resource blocks
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle($title);
        $snippet->setDescription($description);
        $snippet->setCategoryId($category_id);

        if(!empty($tags_raw)) {
            $tags_array = array_map('trim', explode(',', $tags_raw));
            $snippet->setTags($tags_array);
        } else {
            $snippet->setTags([]);
        }

        // Initialize target video entity reference map pointers
        $video = new Google_Service_YouTube_Video();
        $video->setId($video_id);
        $video->setSnippet($snippet);

        // Hit Google OAuth2 update API route
        $youtube->videos->update('snippet', $video);

        echo json_encode(['status' => true, 'message' => 'Success']);
        exit;

    } catch (Google_Service_Exception $e) {
        echo json_encode([
            'status' => false, 
            'message' => 'YouTube API Service Error: ' . $e->getMessage()
        ]);
        exit;
    } catch (Google_Exception $e) {
        echo json_encode([
            'status' => false, 
            'message' => 'Google Client Library Error: ' . $e->getMessage()
        ]);
        exit;
    }
}

	public function get_connected_channel_overview() {
		header('Content-Type: application/json');
		try {
			$channel_data = $this->get_yt_channels_list();
			
			if (isset($channel_data['items'][0])) {
				$channel = $channel_data['items'][0];
				$snippet = $channel['snippet'];
				$statistics = $channel['statistics'];

				$response = [
					'status' => true,
					'channel_name' => $snippet['title'] ?? '',
					'custom_url' => $snippet['customUrl'] ?? '',
					'description' => $snippet['description'] ?? '',
					'thumbnail' => $snippet['thumbnails']['high']['url'] ?? ($snippet['thumbnails']['default']['url'] ?? ''),
					'subscriberCount' => (int)($statistics['subscriberCount'] ?? 0),
					'viewCount' => (int)($statistics['viewCount'] ?? 0),
					'videoCount' => (int)($statistics['videoCount'] ?? 0)
				];
				
				echo json_encode($response);
				exit;
			} else {
				echo json_encode(['status' => false, 'message' => 'No active channel found or session expired.']);
				exit;
			}
		} catch (Exception $e) {
			echo json_encode(['status' => false, 'message' => 'API Error: ' . $e->getMessage()]);
			exit;
		}
	}


    public function analyzeyoutubeVideo($youtubeUrl)
    {
        // 1. Extract Video ID
        $videoId = $this->extractVideoId($youtubeUrl);
        if (!$videoId) {
            return ["status" => false, "message" => "Invalid YouTube URL"];
        }

        // 2. Get YouTube Data
        $videoData = $this->getVideoanalyzDetails($videoId);
        pr($videoData); die('here');
        if (empty($videoData['items'])) {
            return ["status" => false, "message" => "Video not found"];
        }

        $snippet = $videoData['items'][0]['snippet'];
        $stats   = $videoData['items'][0]['statistics'];

        // 3. Basic Calculations
        $views = $stats['viewCount'] ?? 0;
        $likes = $stats['likeCount'] ?? 0;
        $comments = $stats['commentCount'] ?? 0;

        $engagementRate = ($views > 0) 
            ? round((($likes + $comments) / $views) * 100, 2) 
            : 0;

        // 4. Prepare Data for AI
        $videoInfo = [
            "title" => $snippet['title'],
            "description" => $snippet['description'],
            "tags" => $snippet['tags'] ?? [],
            "views" => $views,
            "likes" => $likes,
            "comments" => $comments,
            "engagement_rate" => $engagementRate
        ];

        // 5. AI Analysis
        $aiAnalysis = $this->analyzeWithAI($videoInfo);

        // 6. Final Response
        return [
            "status" => true,
            "video_id" => $videoId,
            "video_info" => $videoInfo,
            "engagement_rate" => $engagementRate,
            "ai_analysis" => $aiAnalysis
        ];
    }

    // 🔹 Extract Video ID
    private function extractVideoId($url)
    {
        preg_match('/(youtu\.be\/|v=)([^\&\?\/]+)/', $url, $matches);
        return $matches[2] ?? null;
    }

    // 🔹 YouTube API Call
    private function getVideoanalyzDetails($videoId)
    {
        $response = $this->video_list_by_ids([$videoId], 'snippet,contentDetails,status,statistics');
        // $url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id={$videoId}&key={$this->youtubeApiKey}";
        // $response = file_get_contents($url);
        return json_decode($response, true);
    }
    // 🔹 AI Analysis
    private function analyzeWithAI($videoInfo)
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
}
	
