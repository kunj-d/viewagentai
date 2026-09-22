<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI = &get_instance();

class M_tryme {
	
	
	public function listScenario() {
		global $CI;
		$rsScenario = FALSE;
		$query = $CI->db->order_by('id', 'asc')->get('tts_scenario');
		if ($query->num_rows()) {
			$rsScenario = $query->result();
		}
		return $rsScenario;
	}
	
	
	
	public function tryOut($voice, $text) {
		global $CI;
		$arrVoice = explode('_', $voice);
		$query = $CI->db->where('ids', $arrVoice[0])->where('enabled', 1)->get('tts_resource', 1);
		if ($query->num_rows()) {
			$rsVoice = $query->row();
			$rsTtsConfig = $CI->db->get('tts_configuration', 1)->row();
			$text = mb_substr($text, 0, $rsTtsConfig->front_tio_maximum_character, 'UTF-8');
			$config = array(
			  'ids' => my_random(),
			  'voice_ids' => $rsVoice->ids,
			  'scheme' => $rsVoice->scheme,
			  'engine' => $arrVoice[1],
			  'language_code' => $rsVoice->language_code,
			  'language_name' => $rsVoice->language_name,
			  'voice_id' => $rsVoice->voice_id,
			  'gender' => $rsVoice->gender,
			  'voice_name' => $rsVoice->gender . ', ' . $rsVoice->name,
			  'output_format' => 'mp3',
			  'text_type' => 'text',
			  'ssml_mode' => FALSE,
			  'text' => $text,
			  'characters_count' => mb_strlen($text, 'UTF-8'),
			  'file_path' => $rsTtsConfig->file_path_preview,
			  'tts_config' => json_encode(array('output_format'=>'mp3','output_volume'=>'default', 'spk_rate'=>'default')),
			  'synthesize_type' => 'preview',
			  'storage' => 'local'
			);
			$CI->load->library('m_tts');
			$res = $CI->m_tts->synthesis($config);
		}
		else {
			//
		}
		return $res;
	}
	
	
	
	public function listLanguage() {
		global $CI;
		$rsTtsSetting = $CI->db->get('tts_configuration', 1)->row();
		$frontPreviewScope = $rsTtsSetting->front_preview_engine;
		$arrLanguage = array();
		($frontPreviewScope == 'standard' || $frontPreviewScope == 'neural') ? $CI->db->like('engine', $frontPreviewScope) : null;
		$query = $CI->db->distinct('language_code')->where('enabled', 1)->order_by('language_name', 'asc')->get('tts_resource');
		if ($query->num_rows()) {
			$rsLanguage = $query->result();
			foreach ($rsLanguage as $row) {
				$arrLanguage[$row->language_code] = my_caption('tts_language_name_' . $row->language_code);
			}
		}
		return $arrLanguage;
	}
	
	
	
	public function listVoice() {
		global $CI;
		$rsTtsSetting = $CI->db->get('tts_configuration', 1)->row();
		$frontPreviewScope = $rsTtsSetting->front_preview_engine;
		$arrVoice = array();
		$query = $CI->db->where('enabled', 1)->order_by('id', 'asc')->get('tts_resource');
		if ($query->num_rows()) {
			$rsVoice = $query->result();
			foreach ($rsVoice as $row) {
				if ($row->engine == 'standard,neural' || $row->engine == 'neural,standard') {
					for ($i=0;$i<2;$i++) {
						($i==0) ? $engine = 'standard' : $engine = 'neural';
						if ($frontPreviewScope == 'both' || ((strpos($row->engine, $frontPreviewScope) >= 0) && $frontPreviewScope == $engine)) {
							array_push($arrVoice, $this->voiceDetailBuilder($engine, $row));
						}
					}
				}
				else {
					if ($frontPreviewScope == 'both' || $row->engine == $frontPreviewScope) {
						array_push($arrVoice, $this->voiceDetailBuilder($row->engine, $row));
					}
				}
			}
		}
		return $arrVoice;
	}
	
	
	
	private function voiceDetailBuilder($engine, $rsVoice) {
		switch ($rsVoice->scheme) {
			case 'aws' :
			  $sampleUri = 'aws_' . $engine . '_' . $rsVoice->language_code . '_' . $rsVoice->voice_id . '.mp3';
			  break;
			case 'google' :
			  ($engine == 'standard') ? $sampleUri = str_replace('{{engine}}', 'Standard', $rsVoice->voice_id) . '.mp3' : $sampleUri = str_replace('{{engine}}', 'Wavenet', $rsVoice->voice_id) . '.mp3';
			  break;
			case 'azure' :
			  $sampleUri = 'azure_' . $rsVoice->voice_id . '.mp3';
			  break;
			case 'ibm' :
			  $sampleUri = 'ibm_' . $rsVoice->voice_id . '.mp3';
			  break;
		} 
		return array(
		  'ids' => $rsVoice->ids . '_' . $engine,
		  'languageCode' => $rsVoice->language_code,
		  'languageName' => $rsVoice->language_name,
		  'scheme' => $rsVoice->scheme,
		  'engine' => my_caption('tts_engine_' . $engine),
		  'gender' => my_caption('global_gender_' . strtolower($rsVoice->gender)),
		  'name' => $rsVoice->name,
		  'sampleUri' => $sampleUri
		);
	}
	
	
	
}
?>