<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(FCPATH . 'vendor/autoload.php');

use Aws\TranscribeService\TranscribeServiceClient;  
use Aws\TranscribeService\Exception;
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;

$CI = &get_instance();

class M_aws_transcribe {

	public function init($aws_config) {
		global $CI;
		$aws_config_array = json_decode($aws_config, TRUE);
		$profile = 'default';
		$path = $aws_config_array['config_file'];
		$provider = CredentialProvider::ini($profile, $path);
		$provider = CredentialProvider::memoize($provider);
		try {
			$client = new Aws\TranscribeService\TranscribeServiceClient([
			  'credentials' => $provider,
			  'version' => 'latest',
			  'region'  => $aws_config_array['region']
			]);
		}
		catch (AwsException $e) {
			log_message('error', $e->getMessage());
			$client = FALSE;
		}
		return $client;
	}
	
	
	
	public function transcribe($language, $ids, $object_uri) {
		global $CI;
		$aws_config = $CI->db->get('tts_configuration')->row()->aws;
		$client = $this->init($aws_config);
		try {
			
			$transcriptionJobArray = [
			  'Media' => [
			    'MediaFileUri' => $object_uri
			  ],
			  'TranscriptionJobName' => $ids
			];
			($language == '0') ? $transcriptionJobArray['IdentifyLanguage'] = true : $transcriptionJobArray['LanguageCode'] = $language;
			$client->startTranscriptionJob($transcriptionJobArray);
			$res = array('result'=>TRUE, 'message'=>'');
		}
		catch (AwsException $e) {
			log_message('error', $e->getMessage());
			$res = array('result'=>FALSE, 'message'=>my_caption('stt_notice_error_local'));
		}
		return $res;
	}
	
	
	
	public function getTranscribeJob($ids) {
		global $CI;
		$aws_config = $CI->db->get('tts_configuration')->row()->aws;
		$client = $this->init($aws_config);
		try {
			$result = $client->getTranscriptionJob([
			  'TranscriptionJobName' => $ids
			]);
			$transcribeStatus = strtolower($result->get('TranscriptionJob')['TranscriptionJobStatus']);
			if ($transcribeStatus == 'completed') {
				$transcriptFileUrl = $result->get('TranscriptionJob')['Transcript']['TranscriptFileUri'];
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $transcriptFileUrl);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, false);
				$transcript = curl_exec($curl);
				$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				if ($httpCode == 200) {
					$transcriptArray = json_decode($transcript, 1);
					$res = array('result'=>TRUE, 'status'=>$transcribeStatus, 'transcript'=>$transcriptArray['results']['transcripts'][0]['transcript']);
				}
				else {
					$res = array('result'=>TRUE, 'status'=>'Failed', 'transcript'=>'');
				}
			}
			else {
				$res = array('result'=>FALSE, 'status'=>$transcribeStatus);
			}
		}
		catch (AwsException $e) {
			log_message('error', $e->getMessage());
			$res = array('result'=>TRUE, 'status'=>'unknown');
		}
		return $res;
	}
	
	
	
	public function getSupportedLanguage() {
		global $CI;
		$CI->load->helper('my_basic');
		$langArray = ['af-ZA', 'ar-AE', 'ar-SA', 'zh-CN', 'da-DK', 'nl-NL', 'en-AB', 'en-AU', 'en-IE', 'en-IN', 'en-NZ', 'en-GB', 'en-US', 'en-WL', 'en-ZA', 'fa-IR', 'fr-CA', 'fr-FR', 'de-CH', 'de-DE', 'he-IL', 'hi-IN', 'id-ID', 'it-IT', 'ja-JP', 'ko-KR', 'ms-MY', 'zh-TW', 'pt-BR', 'pt-PT', 'ru-RU', 'es-ES', 'es-US', 'th-TH', 'ta-IN', 'te-IN', 'tr-TR'];
		$languageNameArray['0'] = my_caption('stt_automatic_identification');
		foreach($langArray as $lang) {
			$languageNameArray[$lang] = my_caption('tts_language_name_' . $lang);
		}
		return $languageNameArray;
	}
	
	
	
	
	
}
?>