<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tts_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
	}
	
	 public function getVoxlistJson() {

        $query = $this->getVoxlistJson1();

        $result["data"] = $query->result_array();

        $result['filtered_records'] = $query->num_rows();

        $query = $this->getVoxlistJson1(true);

        $result['total_records'] = $query->num_rows();
//echo"<pre>"; print_r($result); die('R');
        return $result;

    }
	
	public function getVoxlistJson1($get_count = false) {
        $limit = $this->input->get('limit');

        $pageNo = $this->input->get('pageNo');

        $start = ($pageNo - 1) * $limit;
        $this->db->select('id,title,text,characters_count,language_name,created_time,ids,tts_uri');
        $this->db->where('user_ids', $_SESSION['logged_in']['id']);
        $this->db->where('business_id', $_SESSION['business_id']);
		if (!$get_count) {
		$this->db->limit($limit, $start);
		}
        $this->filter_search();

        return $query = $this->db->get('tts_log');

    }
	
	    public function filter_search() {

        if ($this->input->get('searchKey') != "") {
            $this->db->group_start();
            $this->db->or_like('title', $this->input->get('searchKey'));
            $this->db->or_like('text', $this->input->get('searchKey'));
            $this->db->group_end();
        }
    }

	
	
	
	public function save_tts($config , $business_id) {
		($config['ssml_mode']) ? $tts_text = $config['text'] : $tts_text = $this->security->xss_clean($config['text']);
		$insert_array = array(
		  'ids' => $config['ids'],
		  'user_ids' => $_SESSION['logged_in']['id'],
		  'business_id' =>$business_id,
		  'title' => substr($config['title'], 0, 512),
		  'scheme' => $config['scheme'],
		  'engine' => $config['engine'],
		  'language_code' => $config['language_code'],
		  'voice_id' => $config['voice_id'],
		  'text' => $tts_text,
		  'tts_uri' => $config['tts_uri'],
		  'created_time' => my_server_time()
		);
		if ($config['synthesize_type'] == 'preview') {	
			$this->db->insert('tts_preview_log', $insert_array);
		}
		else {
			switch ($config['storage']) {
				case 'S3' :
				  $aws_array = json_decode($this->tts_config->aws, TRUE);
				  $storage = 'S3/' . $aws_array['region'] . '/' . $aws_array['bucket'] . '/' . $aws_array['folder'];
				  break;
				case 'wasabi' :
				  $wasabi_array = json_decode($this->tts_config->wasabi, TRUE);
				  $storage = 'wasabi/' . $wasabi_array['region'] . '/' . $wasabi_array['bucket'] . '/' . $wasabi_array['folder'];
				  break;
				default :
				  $storage = $config['storage'];
			}
			$insert_array['campaign'] = 'default';
			$insert_array['language_name'] = $config['language_name'];
			$insert_array['voice_name'] = $config['voice_name'];
			$insert_array['config'] = $config['tts_config'];
			$insert_array['storage'] = $storage;
			$insert_array['characters_count'] = $config['characters_count'];
			$this->db->insert('tts_log', $insert_array);
				$insert_id = $this->db->insert_id();
		}
		return $insert_id;
	}
	
	
	
	public function save_configuration() {
		$pricing_model_array = array(
		  'enabled' => 1,
		  'currency' => my_post('ttsc_payg_currency'),
		  'price' => my_post('ttsc_payg_price'),
		  'characters' => my_post('ttsc_payg_characters')
		);
		$aws_array = array(
		  'config_file' => my_post('ttsc_aws_config_file'),
		  'region' => my_post('ttsc_aws_region'),
		  'bucket' => my_post('ttsc_aws_bucket'),
		  'folder' => my_post('ttsc_aws_folder')
		);
		$google_array = array(
		  'config_file' => my_post('ttsc_google_config_file')
		);
		$azure_array = array(
		  'region' => my_post('ttsc_azure_region'),
		  'subscription_key' => my_post('ttsc_azure_key')
		);
		$ibm_array = array(
		  'api_key' => my_post('ttsc_ibm_api_key'),
		  'url' => my_post('ttsc_ibm_url')
		);
		$wasabi_array = array(
		  'config_file' => my_post('ttsc_wasabi_config_file'),
		  'region' => my_post('ttsc_wasabi_region'),
		  'bucket' => my_post('ttsc_wasabi_bucket'),
		  'folder' => my_post('ttsc_wasabi_folder')
		);
		$update_array = array(
		  'default_language' => my_post('ttsc_default_language'),
		  'preview_delay' => my_post('ttsc_preview_delay'),
		  'storage' => my_post('ttsc_storage_solution'),
		  'maximum_character' => my_post('ttsc_maximum_characters'),
		  'maximum_character_preview' => my_post('ttsc_maximum_characters_preview'),
		  'clean_up' => my_post('ttsc_clean_up_setting'),
		  'ssml' => my_post('ttsc_ssml_support'),
		  'engine' => my_post('ttsc_engine'),
		  'pricing_model' => json_encode($pricing_model_array),
		  'aws' => json_encode($aws_array),
		  'google' => json_encode($google_array),
		  'azure' => json_encode($azure_array),
		  'ibm' => json_encode($ibm_array),
		  'wasabi' => json_encode($wasabi_array),
		  'front_preview_enabled' => my_post('ttsc_tryme_enable'),
		  'front_preview_engine' => my_post('ttsc_tryme_engine'),
		  'front_tio_enabled' => my_post('ttsc_tryme_tio'),
		  'front_tio_maximum_character' => my_post('ttsc_tryme_tio_mc')
		);
		$this->db->update('tts_configuration', $update_array);
		return TRUE;
	}
	
	
	
	public function save_ss($configArray) {
		$filesName = '';
		$text = '';
		$this->load->helper('my_tts');
		foreach ($configArray['filesListIds'] as $singleFileIds) {
			$singleFileInfoArray = [];
			$singleFileInfoArray = my_tts_get_detail($singleFileIds);
			($singleFileInfoArray['title'] != '') ? $title = $singleFileInfoArray['title'] : $title = my_caption('global_untitled');
			$filesName .= $title . '<<fn>>';
			$text .= $singleFileInfoArray['text'] . ' ';
		}
		(my_post('st_generate_title') != '') ? $title = substr(my_post('st_generate_title'), 0, 512) : $title = my_caption('global_untitled');
		$insertArray = array(
		  'ids' => $configArray['ids'],
		  'user_ids' => $_SESSION['logged_in']['id'],
		  'title' => $title,
		  'text' => $text,
		  'file_list' => implode(',', $configArray['filesListIds']),
		  'file_name' => substr($filesName, 0, -6),
		  'background_music' => my_post('st_generate_background_music'),
		  'background_music_volume' => my_post('st_background_music_volume'),
		  'voice_file_volume' => my_post('st_voice_file_volume'),
		  'created_time' => my_server_time()
		);
		$this->db->insert('sound_studio_log', $insertArray);
		return TRUE;
	}
	
	
	
	public function save_stt($submitResultArray) {
		(my_post('stt_language_value') == '0') ? $languageName = my_caption('stt_automatic_identification_name') : $languageName = my_caption('tts_language_name_' . my_post('stt_language_value'));
		(my_post('stt_title_value') == '') ? $sttTitle = my_caption('global_untitled') : $sttTitle = substr(my_post('stt_title_value'), 0, 512);
		$insertArray = array(
		  'ids' => $submitResultArray['ids'],
		  'user_ids' => $_SESSION['logged_in']['id'],
		  'scheme' => 'aws',
		  'title' => $sttTitle,
		  'language_code' => my_post('stt_language_value'),
		  'language_name' => $languageName,
		  'object_uri' => $submitResultArray['objectUri'],
		  'duration' => $submitResultArray['duration'],
		  'transcript' => '',
		  'status' => 'pending',
		  'created_time' => my_server_time()
		);
		$this->db->insert('stt_log', $insertArray);
		return TRUE;
	}
	
	
	
	
	
	

}