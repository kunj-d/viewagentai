<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI = &get_instance();


class M_ibm_tts {
	
	public function syncResource() {  //get voice list from IBM, then insert into table 'tts_resource'
		global $CI;
		$rsTtsConfiguration = $CI->db->get('tts_configuration', 1)->row();
		$ibm_config_array = json_decode($rsTtsConfiguration->ibm, TRUE);
		$resource_url = $ibm_config_array['url'] . '/v1/voices';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $resource_url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($curl, CURLOPT_USERPWD, 'apikey:' . $ibm_config_array['api_key']);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		try {
			$response = curl_exec($curl);
			$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if ($http_code == 200) {
				$voice_list_array = json_decode($response, TRUE);
				foreach ($voice_list_array['voices'] as $voice) {
					$language_code = $voice['language'];
					$voice_name = $voice['name'];
					$gender = ucfirst($voice['gender']);
					$nickname = str_replace('Voice', '', str_replace($language_code . '_', '', $voice_name));
					$voice_name == 'zh-CN_WangWeiVoice' ? $language_code = 'cmn-CN' : null; //put the Chinese voice to a precise category
					$voice_name == 'zh-CN_LiNaVoice' ? $language_code = 'cmn-CN' : null; //put the Chinese voice to a precise category
					$voice_name == 'zh-CN_ZhangJingVoice' ? $language_code = 'cmn-TW' : null; //put the Chinese voice to a precise category
					$language_code == 'ar-MS' ? $language_code = 'arb' : null;  //put the ar-MS to Arabic
					$language_code == 'es-LA' ? $language_code = 'es-AR' : null; //put the Latin America Spanish to Argentina
					$query = $CI->db->where('scheme', 'ibm')->where('language_code', $language_code)->where('voice_id', $voice_name)->get('tts_resource', 1);
					if (!$query->num_rows()) {
						$insert_data = array(
						  'ids' => my_random(),
						  'scheme' => 'ibm',
						  'language_name' => my_tts_language_code_to_name($language_code),
						  'language_code' => $language_code,
						  'voice_id' => $voice_name,
						  'engine' => 'neural',
						  'gender' => $gender,
						  'name' => $nickname,
						  'description' => '',
						  'enabled' => 1,
						  'stuff' => '',
						  'accessibility_standard' => 'payg',
						  'accessibility_neural' => 'payg'
						);
						$CI->db->insert('tts_resource', $insert_data);
					}
					else {
						$rs = $query->row();
						if ($rs->language_name == 'Unknown') {  //try to update 'unknown' if necessary and possible
							$CI->db->where('id', $rs->id)->update('tts_resource', array('language_name'=>my_tts_language_code_to_name($language_code)));
						}
					}
				}	
				$result = TRUE;
			}
			else {  // this is an exception of http code
				log_message('error', '(syncResource) http error code from ibm: ' . $http_code);
				$result = FALSE;
			}
		}
		catch (Exception $e) {  // this is an exception of curl
			log_message('error', $e->getMessage());
			$result = FALSE;
		}
		return $result;
	}
	
	
	
	public function synthesize($config) {
		global $CI;
		$rsTtsConfiguration = $CI->db->get('tts_configuration', 1)->row();
		$ibm_config_array = json_decode($rsTtsConfiguration->ibm, TRUE);
		$resource_url = $ibm_config_array['url'] . '/v1/synthesize?voice=' . $config['voice_id'];
		$header = [
		  'Content-Type: application/json',
		  'Accept: audio/mp3'
		];
		$text_array = array('text'=>$config['text']);
		$data = json_encode($text_array);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $resource_url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curl, CURLOPT_USERPWD, 'apikey:' . $ibm_config_array['api_key']);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		try {
			$response = curl_exec($curl);
			$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if ($http_code == 200) {
				$tts_uri = $config['file_path'] . $config['ids'] . '.' . $config['output_format'];
				file_put_contents(FCPATH . $tts_uri, $response);  //no matter where to save in next step, currently need to save to local first, if it fails to save to remote server, then use this local file
				$res = array('result'=>TRUE, 'message'=>'', 'tts_uri'=>$tts_uri);
			}
			else {  // this is an exception of http code
				log_message('error', '(synthesize) http error code from ibm: ' . $http_code);
				$res = array('result'=>FALSE, 'message'=>my_caption('tts_notice_error_local'), 'tts_uri'=>'');
			}
		}
		catch (Exception $e) { // this is an exception of curl
		    log_message('error', $e->getMessage());
			$res = array('result'=>FALSE, 'message'=>my_caption('tts_notice_error_local'), 'tts_uri'=>'');
		}
		return $res;
	}
	
	
}
?>