<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('my_tts_language_code_to_name')) {
	function my_tts_language_code_to_name($code) {
		$CI = &get_instance();
		$field = 'tts_language_name_' . $code;
		$language_name = $CI->lang->line($field);
		($language_name == '') ? $language_name = $CI->lang->line('tts_language_name_unknown') : null;
		return $language_name;
	}
}



if (!function_exists('my_tts_language_list')) {
	function my_tts_language_list($scheme) {
		$CI = &get_instance();
		$CI->db->distinct('language_name');
		if ($scheme != 'all') {
			$CI->db->where('scheme', $scheme);
		}
		$query = $CI->db->where('enabled', 1)->order_by('language_name', 'asc')->get('tts_resource');
		if ($query->num_rows()) {
			if (!$CI->tts_config->default_language) {
				$result[0] = my_caption('tts_language_select_notice');
			}
			$rs = $query->result();
			foreach($rs as $row) {
				$result[$row->language_code] = my_caption('tts_language_name_' . $row->language_code);
			}
		}
		else {
			$result[0] = my_caption('tts_language_no_available');
		}
		return $result;
	}
}



if (!function_exists('my_tts_check_ssml')) {  //check whether the text is a ssml text, if yes, return the escaped one
	function my_tts_check_ssml($text, $synthesize_type = 'preview') {
		$text = trim($text);
		if (preg_match("/<[^<]+>/", $text)) {  // contains tag '<>'
			preg_match_all('/\<(.*?)\>/', $text, $matches);
			$i = 0;
			$ssml_array = array();
			foreach ($matches[1] as $match) {
				(substr($match, 0, 5) == 'break' || substr($match, 0, 4) == 'mark') ? $ssml_tag_array[$i] = '<' . $match . '/>' : $ssml_tag_array[$i] = '<' . $match . '>';
				$match = '<' . $match . '>';
				$text = str_replace($match, '[[[' . $i . ']]]', $text);
				$i++;
			}
			$text = my_tts_get_preview_text($text, $synthesize_type);
			//$text = str_replace('"', '&quot;', $text);
			$text = str_replace('"', '', $text);
			$text = str_replace('&', '&amp;', $text);
			$text = str_replace('\'', '&apos;', $text);
			$text = str_replace('<', '&lt;', $text);
			$text = str_replace('>', '&gt;', $text);			
			$i = 0;
			foreach ($ssml_tag_array as $ssml_tag) {
				$text = str_replace('[[[' . $i . ']]]', $ssml_tag, $text);
				$i++;
			}
			$result = array('type'=>'ssml', 'text'=>$text);
		}
		else {
			$text = my_tts_get_preview_text($text, $synthesize_type);
			$result = array('type'=>'text', 'text'=>$text);
		}
		return $result;
	}
}



if (!function_exists('my_tts_get_preview_text')) {
	function my_tts_get_preview_text($text, $synthesize_type) {
		$CI = &get_instance();
		if ($synthesize_type == 'preview' || $CI->config->item('my_demo_mode')) {  //preview mode or demo mode
			$text = str_replace('"', '', $text);
		    ($synthesize_type == 'preview') ? $characters = $CI->tts_config->maximum_character_preview : $characters = 250;  // preview mode->50, demo mode->200
			if (my_tts_check_ascii($text)) {
				if ($characters < 1000) {
					$recovery = FALSE;
					if (substr($text, 0, 7) == '[[[0]]]') { //start with a tag, replace it first
					    $text = ltrim($text, '[[[0]]]');
						$recovery = TRUE;
					}
					preg_match("/(?:\w+(?:\W+|$)){0," . $characters . "}/", $text, $matches);
					$text = $matches[0];
					($recovery) ? '[[[0]]]' . $text : null;
				}
			}
			else {
				$text = mb_substr($text, 0, $characters, 'utf-8');
			}
		}
		return $text;
	}
}



if (!function_exists('my_tts_check_ascii')) {
	function my_tts_check_ascii($text) {
		$str_array = str_split($text);
		$result = TRUE;
		foreach ($str_array as $str) {
			if (!mb_detect_encoding($str, 'ASCII')) {
				$result = FALSE;
				break;
			}
		}
		return $result;
	}
}



if (!function_exists('my_tts_generate_user_statitics')) {
	function my_tts_generate_user_statitics($user_ids = '') {
		$CI = &get_instance();
		($user_ids == '') ? $user_ids = $_SESSION['logged_in']['id'] : null;
		$query = $CI->db->where('user_ids', $user_ids)->get('tts_statitics', 1);
		if (!$query->num_rows()) {
			$insert_array = array(
			  'user_ids' => $user_ids,
			  'payg_balance' => 0,
			  'payg_purchased' => 0,
			  'characters_preview_used' => 0,
			  'characters_production_used' => 0,
			  'voice_generated' => 0
			);
			$CI->db->insert('tts_statitics', $insert_array);
			$rs = $CI->db->where('user_ids', $user_ids)->get('tts_statitics', 1)->row();
		}
		else {
			$rs = $query->row();
		}
		return $rs;
	}
}



if (!function_exists('my_tts_get_package_balance')) {
	function my_tts_get_package_balance($user_ids = '') {
		$CI = &get_instance();
		($user_ids == '') ? $user_ids = $_SESSION['logged_in']['id'] : null;
		$amount_purchase = 0;
		$amount_subscription = 0;
		$standard_unlimited = FALSE;
		$query_purchase = $CI->db->where('item_type', 'purchase')->where('user_ids', $user_ids)->where('used_up', 0)->get('payment_purchased');
		if ($query_purchase->num_rows()) {
			$rs_purchase = $query_purchase->result();
			foreach ($rs_purchase as $purchase) {
				$stuff_array = json_decode($purchase->stuff, TRUE);
				if ($stuff_array['characters_limit'] != '') {
					$amount_purchase += $stuff_array['characters_limit'] - $stuff_array['characters_used'];
				}
				else {
					$standard_unlimited = TRUE;
				}
			}
		}
		$query_subscription = $CI->db->where('user_ids', $user_ids)->where('used_up', 0)->where('status!=', 'expired')->where('end_time>=', my_server_time('UTC', 'Y-m-d'))->get('payment_subscription');
		if ($query_subscription->num_rows()) {
			$rs_subscription = $query_subscription->result();
			foreach ($rs_subscription as $subscription) {
				$stuff_array = json_decode($subscription->stuff, TRUE);
				if ($stuff_array['characters_limit'] != '') {
					$amount_subscription += $stuff_array['characters_limit'] - $stuff_array['characters_used'];
				}
				else {
					$standard_unlimited = TRUE;
				}
			}
		}
		if ($amount_purchase >0 or $amount_subscription > 0) {
			$balance_array['amount'] = $amount_purchase + $amount_subscription;
		}
		else {
			$balance_array['amount'] = -1;  //no available chars or have unlimited chars
		}
		($standard_unlimited) ? $standard_pkg = ' ' . my_caption('tts_character_unlimited_standard') : $standard_pkg = '';
		$balance_array['package'] = $standard_pkg;
		return $balance_array;
		
	}
}



//return the title and text of the a TTS entry
if (!function_exists('my_tts_get_detail')) {
	function my_tts_get_detail($ids) {
		$CI = &get_instance();
		$query = $CI->db->where('ids', $ids)->where('user_ids', $_SESSION['logged_in']['id'])->get('tts_log', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			$result = array('title'=>$rs->title, 'text'=>$rs->text);
		}
		else {
			$result = FALSE;
		}
		return $result;
	}
}



//return the background music's title and path, uri according to its ids
if (!function_exists('my_tts_get_music_detail')) {
	function my_tts_get_music_detail($musicIds, $requestPath = TRUE) {
		if ($musicIds == '0') {
			$musicTitle = '';
			$musicPath = '0';
			$musicUri = '';
		}
		else {
			$CI = &get_instance();
			$query = $CI->db->where('ids', $musicIds)->get('sound_studio_music', 1);
			if ($query->num_rows()) {
				$rs = $query->row();
				$musicTitle = $rs->name;
				$musicPath = '0';
				$musicUri = '';
				if ($requestPath) {
					$filePath = FCPATH . str_replace(base_url(), '', $rs->uri);
					if (file_exists($filePath)) {
						$musicPath = $filePath;
						$musicUri = $rs->uri;
					}
				}
			}
			else {
				$musicTitle = '';
				$musicPath = '0';
				$musicUri = '';
			}
		}
		return array('musicTitle' => $musicTitle, 'musicPath' => $musicPath, 'musicUri' => $musicUri);
	}
}


//check pre-eq of ffmpeg
if (!function_exists('my_tts_check_ffmpeg')) {
	function my_tts_check_ffmpeg() {
		$resultArray = array(
		  'success' => TRUE,
		  'message' => ''
		);
		if (!file_exists(FCPATH . 'vendor/ffmpeg/')) {
			$resultArray['success'] = FALSE;
			$resultArray['message'] = 'Something goes wrong. The folder <b>/vendor/ffmpeg</b> is missing, check the solution <a href="https://support.cyberbukit.com/help-center/articles/32/guideline-of-sound-studio#3-for-upgrade-users-only" target="_blank">here (3.For upgrade users only)</a>.';
		}
		if ($resultArray['success'] && !is_executable(FCPATH . 'vendor/ffmpeg/ffmpeg')) {
			$resultArray['success'] = FALSE;
			$resultArray['message'] = 'Something goes wrong. The file <b>/vendor/ffmpeg/ffmpeg</b> is not executable, check the solution <a href="https://support.cyberbukit.com/help-center/articles/32/guideline-of-sound-studio#1-prerequisite" target="_blank">here</a>.';
		}
		if ($resultArray['success'] && !is_executable(FCPATH . 'vendor/ffmpeg/ffprobe')) {
			$resultArray['success'] = FALSE;
			$resultArray['message'] = 'Something goes wrong. The file <b>/vendor/ffmpeg/ffprobe</b> is not executable, check the solution <a href="https://support.cyberbukit.com/help-center/articles/32/guideline-of-sound-studio#1-prerequisite" target="_blank">here</a>.';
		}
		if($resultArray['success'] && @exec('echo shell_exec') != 'shell_exec') {
			$resultArray['success'] = FALSE;
			$resultArray['message'] = 'Something goes wrong. The PHP function <b>shell_exec</b> is not allowed, check the solution <a href="https://support.cyberbukit.com/help-center/articles/32/guideline-of-sound-studio#1-prerequisite" target="_blank">here</a>.';
		}
		return $resultArray;
	}
}


if (!function_exists('my_whiteboard_generate_user_statitics')) {
	function my_whiteboard_generate_user_statitics($user_ids = '') {
		$CI = &get_instance();
		($user_ids == '') ? $user_ids = $_SESSION['logged_in']['id'] : null;
		$query = $CI->db->where('ids', $user_ids)->get('whiteboard_statitics', 1);
		if (!$query->num_rows()) {
			$insert_array = array(
			  'ids' => $user_ids,
			  'user_id' => $_SESSION['id'],			  
			  'characters_production_used' => 0
			 
			);
			$CI->db->insert('whiteboard_statitics', $insert_array);
			$rs = $CI->db->where('ids', $user_ids)->get('whiteboard_statitics', 1)->row();
		}
		else {
			$rs = $query->row();
		}
		return $rs;
	}
}





