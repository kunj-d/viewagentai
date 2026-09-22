<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tts_chatbot extends CI_Controller {
    public function __construct() {
		parent::__construct();

            
		$this->load->helper('htmlpurifier');
		$this->load->helper('my_basic');
		$this->load->helper('my_tts');
		$this->load->model('default/tts_model');
		$this->load->model('Common_Model');
	
    }
	
	
	public function index() {
		//die('r');
	
	}
	
	public function spin() {
		if(isset($_POST)){

	@set_time_limit(0);
	require_once(APPPATH."libraries/inc/class.spintax.php");
	require_once(APPPATH."libraries/inc/class.spin.php");
	$title = "tts";
	$description = $_POST['description'];
	$spin=new wp_auto_spin_spin($title,$description);
	$return=$spin->spin_wrap();
	$new_title = $return['spintaxed_ttl'];
	$new_desc = $return['spintaxed_cnt'];
	echo json_encode($new_desc); die;
	}


	}
	
	public function start() {
	     /* $output['all_plan_features'] = $this->all_plan_features;
	 
	      if(!in_array('vox',$output['all_plan_features'])) {
	         	$output['error']['type'] = 'flash';
				$output['error']['message'] = 'Please upgrade your plan';
				$this->session->set_flashdata('message', json_encode($output));
	          redirect('subscription');
	      }*/
		 $this->loadView('Tts/start', $output);
	}
	
	public function loadView_hold($page, $data = '')
	{
		$this->checkSubscription();
		if(!$this->session->userdata('logged_in')){
			redirect(site_url()."login");
		}else{
		$this->db->select('userid,logo,sitetitle,status');
            $this->db->where('userid', $this->session->userdata('logged_in')['owner_id']);
            $query = $this->db->get('web_setting');
            if ($query->num_rows() == 1) {
                $result = $query->row_array();
				$data['web_logo'] = $result['logo'];
				$data['web_sitetitle'] = $result['sitetitle'];
            }else{
				$data['web_logo'] = base_url("assets/default/images/logo.png");
				$data['web_sitetitle'] = $this->config->item('productName');
			}
			
		$data['logged_in']= $this->session->userdata('logged_in');
		$data['base_url'] = $this->config->item('base_url');
		$data['assetsPath'] = $this->config->item('assetsPath');
		$data['assetsFolder'] = $this->config->item('assetsTemplatePath');
		$data['uploadPath'] = $this->config->item('uploadPath');
		
		$this->load->view($this->config->item('template') . 'header', $data);
		$this->load->view($this->config->item('template') . $page, $data);
		$this->load->view($this->config->item('template') . 'footer', $data);
		$this->load->view($this->config->item('template') . 'common-modal', $data);
		}
	}
	
	public function checkSubscription(){
		$user_id=$this->session->userdata('logged_in')["id"];
		$owner_id=$this->session->userdata('logged_in')["owner_id"];
		if($user_id != $owner_id){
		redirect(site_url()."dashboard");
		}
		else{
			$data = $this->Common_Model->getSingleRowFromTable('tbl_package_purchase',array('user_id'=>$owner_id,'status'=>'active'));
			if(!isset($data[0])){
				$flashdata['error'] = array('message' => "Please Upgrade your Subscription Plan", 'type'=>'flash');
				$this->session->set_flashdata('message', json_encode($flashdata));
				//redirect(site_url()."subscription?expire=true");
				if ($this->input->is_ajax_request()) {
					$output['redirect']	= site_url('subscription')."?expire=true";
					echo json_encode($output);
					die();
				}else{
					redirect(site_url()."subscription?expire=true");
				}
			}
		}
	}
	
	public function start_action() { 
		$tts_check_result = $this->tts_basic_check(my_post('tts_text'));
		
		$tts_title_basic_check = $this->tts_title_basic_check(my_post('tts_title'));
		if (!$tts_title_basic_check['result']) {
			$res = '{"result":false, "message":"' . $tts_title_basic_check['message'] . '"}';
		}else {
		
		if (!$tts_check_result['result']) {
			//$flashdata['error']['message'] = $tts_check_result['message'];
			//$flashdata['error']['type'] = 'flash';
			//echo json_encode($flashdata);
			//die;
			$res = '{"result":false, "message":"' . $tts_check_result['message'] . '"}';
		}
		else {
			$query = $this->db->where('ids', my_post('tts_resource_ids'))->where('enabled', 1)->get('tts_resource', 1);
			if (!$query->num_rows()) {
				$res = '{"result":false, "message":"' . my_caption('tts_voice_unavailable') . '"}';
			}
			else {
				$rs = $query->row();
				
				if (my_post('ssml_mode') == '1' && $this->tts_config->ssml) {
					$tts_text = $this->input->post('tts_text', FALSE);
					if ($rs->scheme == 'aws' || $rs->scheme == 'google' || $rs->scheme == 'ibm') {
						(substr($tts_text, 0, 7) != '<speak>') ? $tts_text = '<speak>' . $tts_text : null;
						(substr($tts_text, -8) != '</speak>') ? $tts_text .= '</speak>' : null;
					}
					elseif ($rs->scheme == 'azure') {
						if (substr($tts_text, 0, 6) != '<speak') {  //need to build the header
							$azure_header = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis" xml:lang="en-US"><voice name="' . $rs->voice_id . '">';
							$tts_text = $azure_header . $tts_text;
						}
						if (substr($tts_text, -8) != '</speak>') {  //need to rebuild the tailer
							$tts_text .= '</voice></speak>';
						}
						log_message('error', $tts_text);
					}
					$ssml_mode = TRUE;
				}
				else {
					$tts_text = my_post('tts_text');
					$ssml_mode = FALSE;
				}
				$text_array = $this->text_builder($tts_text, $rs->scheme, $ssml_mode);  //handle the text for multiple purposes
				$tts_config_array = array('output_format'=>'mp3','output_volume'=>my_post('tts_ssml_volume'), 'spk_rate'=>my_post('tts_ssml_spk_rate'));
				(my_post('synthesize_type') == 'preview') ? $file_path = $this->tts_config->file_path_preview : $file_path = $this->tts_config->file_path_user;
				(my_post('tts_title') == '') ? $tts_title = my_caption('global_untitled') : $tts_title = my_post('tts_title');
				$config = array(
				  'ids' => rand(),
				  'voice_ids' => $rs->ids,
				  'title' => $tts_title,
				  'scheme' => $rs->scheme,
				  'engine' => my_post('tts_engine'),
				  'language_code' => $rs->language_code,
				  'language_name' => $rs->language_name,
				  'voice_id' => $rs->voice_id,
				  'gender' => $rs->gender,
				  'voice_name' => $rs->gender . ', ' . $rs->name,
				  'output_format' => 'mp3',
				  'text_type' => $text_array['text_type'],
				  'ssml_mode' => $ssml_mode,
				  'text' => $text_array['text_text'],
				  'characters_count' => $text_array['text_length'],
				  'file_path' => $file_path,
				  'tts_config' => json_encode($tts_config_array),
				  'synthesize_type' => my_post('synthesize_type'),
				);
				
				if ($config['scheme'] == 'azure' && ($config['language_code'] == 'ja-JP' || $config['language_code'] == 'ko-KR' || $config['language_code'] == 'yue-HK' || $config['language_code'] == 'cmn-TW' || $config['language_code'] == 'cmn-CN')) { //Japanese, Korean, Chinese in Azure will be counted twice
					$config['characters_count'] = 2*$config['characters_count'];
				}
				($config['scheme'] == 'aws' && $config['characters_count'] > 2999) ? $config['storage'] = 'S3' : $config['storage'] = $this->tts_config->storage;  //force to S3 according to aws requirement
				$this->load->library('m_billing');
				$billing_array = $this->m_billing->billing($config);
						//echo"<pre>";print_r($config);die('rr');
				if (my_post('ssml_mode') == '1' && $config['synthesize_type'] == 'preview') {
					$res = '{"result":false, "message":"' . my_caption('tts_ssml_preview_not_supported') . '"}';
				}
				
				elseif ($billing_array['result']) {
					$this->load->library('m_tts');
					$res = $this->m_tts->synthesis($config);
					if ($res['result']) {  //synthesis successfully
						$config['tts_uri'] = $res['tts_uri']; //file path
						($config['synthesize_type'] == 'preview') ? $res['tts_uri'] = base_url($res['tts_uri']) : null;  //for play preview only
						$insert_id = $this->tts_model->save_tts($config,$this->business_id);  //save to db
						
						$this->Common_Model->InsertIntoAnyTable('notification', array('user_id'=> $this->session->userdata('logged_in')['id'],'tts_log_id' => $insert_id, 'title'=>$tts_title,'type'=>'vox','created'=> time(),'url'=> base_url('vox-list')));
					}
					$this->update_statitics($config['synthesize_type'], $config['characters_count']);  //update statitics
					$res = json_encode($res);
				}
		
				else {
					$res = '{"result":false, "message":"' . $billing_array['message'] . '"}';
				}
			}
		}
		}
		echo my_esc_html($res);
	}
	
	
	
	
	
		public function start_action_chatbot() { 
		     
		//$tts_check_result = $this->tts_basic_check(my_post('tts_text'));
		$tts_check_result['result'] = true;
	
		$tts_title_basic_check = $this->tts_title_basic_check(my_post('tts_title'));
		
		if (!$tts_title_basic_check['result']) {
			$res = '{"result":false, "message":"' . $tts_title_basic_check['message'] . '"}';
		}else {
		
		if (!$tts_check_result['result']) {
		
			$res = '{"result":false, "message":"' . $tts_check_result['message'] . '"}';
		}
		else {
			$query = $this->db->where('ids', my_post('tts_resource_ids'))->where('enabled', 1)->get('tts_resource', 1);
			if (!$query->num_rows()) {
				$res = '{"result":false, "message":"' . my_caption('tts_voice_unavailable') . '"}';
			}
			else {
				$rs = $query->row();
				
				if (my_post('ssml_mode') == '1' && $this->tts_config->ssml) {
					$tts_text = $this->input->post('tts_text', FALSE);
					if ($rs->scheme == 'aws' || $rs->scheme == 'google' || $rs->scheme == 'ibm') {
						(substr($tts_text, 0, 7) != '<speak>') ? $tts_text = '<speak>' . $tts_text : null;
						(substr($tts_text, -8) != '</speak>') ? $tts_text .= '</speak>' : null;
					}
					elseif ($rs->scheme == 'azure') {
						if (substr($tts_text, 0, 6) != '<speak') {  //need to build the header
							$azure_header = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis" xml:lang="en-US"><voice name="' . $rs->voice_id . '">';
							$tts_text = $azure_header . $tts_text;
						}
						if (substr($tts_text, -8) != '</speak>') {  //need to rebuild the tailer
							$tts_text .= '</voice></speak>';
						}
						log_message('error', $tts_text);
					}
					$ssml_mode = TRUE;
				}
				else {
					$tts_text = my_post('tts_text');
					$ssml_mode = FALSE;
				}
				$text_array = $this->text_builder($tts_text, $rs->scheme, $ssml_mode);  //handle the text for multiple purposes
				$tts_config_array = array('output_format'=>'mp3','output_volume'=>my_post('tts_ssml_volume'), 'spk_rate'=>my_post('tts_ssml_spk_rate'));
				(my_post('synthesize_type') == 'preview') ? $file_path = $this->tts_config->file_path_preview : $file_path = $this->tts_config->file_path_user;
				(my_post('tts_title') == '') ? $tts_title = my_caption('global_untitled') : $tts_title = my_post('tts_title');
				$config = array(
				  'ids' => rand(),
				  'voice_ids' => $rs->ids,
				  'title' => $tts_title,
				  'scheme' => $rs->scheme,
				  'engine' => my_post('tts_engine'),
				  'language_code' => $rs->language_code,
				  'language_name' => $rs->language_name,
				  'voice_id' => $rs->voice_id,
				  'gender' => $rs->gender,
				  'voice_name' => $rs->gender . ', ' . $rs->name,
				  'output_format' => 'mp3',
				  'text_type' => $text_array['text_type'],
				  'ssml_mode' => $ssml_mode,
				  'text' => $text_array['text_text'],
				  'characters_count' => $text_array['text_length'],
				  'file_path' => $file_path,
				  'tts_config' => json_encode($tts_config_array),
				  'synthesize_type' => my_post('synthesize_type'),
				);
				
				if ($config['scheme'] == 'azure' && ($config['language_code'] == 'ja-JP' || $config['language_code'] == 'ko-KR' || $config['language_code'] == 'yue-HK' || $config['language_code'] == 'cmn-TW' || $config['language_code'] == 'cmn-CN')) { //Japanese, Korean, Chinese in Azure will be counted twice
					$config['characters_count'] = 2*$config['characters_count'];
				}
				($config['scheme'] == 'aws' && $config['characters_count'] > 2999) ? $config['storage'] = 'S3' : $config['storage'] = $this->tts_config->storage;  //force to S3 according to aws requirement
				$this->load->library('m_billing');
				$billing_array = $this->m_billing->billing($config);
						//echo"<pre>";print_r($config);die('rr');
				if (my_post('ssml_mode') == '1' && $config['synthesize_type'] == 'preview') {
					$res = '{"result":false, "message":"' . my_caption('tts_ssml_preview_not_supported') . '"}';
				}
				
				elseif ($billing_array['result']) {
					$this->load->library('m_tts');
					$res = $this->m_tts->synthesis($config);
					if ($res['result']) {  //synthesis successfully
						$config['tts_uri'] = $res['tts_uri']; //file path
						($config['synthesize_type'] == 'preview') ? $res['tts_uri'] = base_url().'app/'.$res['tts_uri'] : null;  //for play preview only
						echo json_encode($res); die;
						return $res;
					//	$insert_id = $this->tts_model->save_tts($config,$this->business_id);  //save to db
						
					//	$this->Common_Model->InsertIntoAnyTable('notification', array('user_id'=> $this->session->userdata('logged_in')['id'],'tts_log_id' => $insert_id, 'title'=>$tts_title,'type'=>'vox','created'=> time(),'url'=> base_url('vox-list')));
					}
				//	$this->update_statitics($config['synthesize_type'], $config['characters_count']);  //update statitics
				//	$res = json_encode($res);
				}
		
				else {
					$res = '{"result":false, "message":"' . $billing_array['message'] . '"}';
				}
			}
		}
		}
		echo my_esc_html($res);
	}
	
	
	public function download($ids) {

		if (!my_check_permission('TTS Management')) { 
			$this->db->where('user_ids', $_SESSION['logged_in']['id']);
		}
		$query = $this->db->where('ids', $ids)->get('tts_log', 1);
		//print_r($ids);die('dd');
		if ($query->num_rows()) {
			$rs = $query->row();
			$tts_uri = $rs->tts_uri;
			$this->load->helper('download');
			if (substr($tts_uri, 0, 4) == 'http') {
				if ($this->tts_config->download_type == 'flexible') { //jump to the file
					redirect($tts_uri);
				}
				else {  //download to local server and push to client
					$tts_config_array = json_decode($rs->config, TRUE);
					$file_name = $ids . '.' . $tts_config_array['output_format'];
					$data = file_get_contents($tts_uri);
					force_download($file_name, $data);
				}
			}
			else {
				force_download($tts_uri, NULL);
			}
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	public function getVoxlistJson() {
        if ($this->input->get('limit') && $this->input->get('pageNo')) {
            $data = $this->tts_model->getVoxlistJson();
            //echo"<pre>"; print_r($data['data']); die('11R');
            $output['data'] = $data['data'];
            $output['total_records'] = $data['total_records'];
            $output['filtered_records'] = $data['filtered_records'];
        } else {
            $output['data'] = array();
            $output['total_records'] = 0;
            $output['filtered_records'] = 0;
        }
        echo json_encode($output);
    }
	
	public function view() {
		if (!my_check_permission('TTS Management')) {
			$this->db->where('user_ids', $_SESSION['logged_in']['id']);
		}
		$query = $this->db->where('ids', my_uri_segment(3))->get('tts_log', 1);
		if ($query->num_rows()) {
			$data['rs'] = $query->row();
			my_load_view($this->setting->theme, 'Tts/tts_view', $data);
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	public function admin_tts_view() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$this->view();
	}
	
	
	
	public function remove($deleteId) {
	//print_r($deleteId); die('r');
		my_check_demo_mode('alert_json');  //check if it's in demo mode
		if (!my_check_permission('TTS Management')) {  //user is only allowed to remove his own file
			$this->db->where('user_ids', $_SESSION['logged_in']['id']);
		}
		$query = $this->db->where('ids', $deleteId)->get('tts_log', 1);
		if ($query->num_rows()) {
			$rs = $query->result();
			//$this->load->library('m_tts');
			//$result = $this->m_tts->deleteObject($rs);
			$this->db->where('ids', $deleteId)->delete('tts_log');
		}
		($result) ? $notice_text = my_caption('global_deleted_notice_message') : $notice_text = my_caption('tts_file_notice_delete_partly_success');
		echo '{"result":true, "title":"' . my_caption('global_deleted_notice_title') . '", "text":"'. $notice_text . '", "redirect":"CallBack"}';
	}
	
	
	
	public function get_language_detail() {
		$query = $this->db->where('enabled', 1)->order_by('scheme', 'asc')->order_by('name', 'asc')->get('tts_resource');
		$result = array();
		if ($query->num_rows()) {
			$rs = $query->result();
			foreach ($rs as $row) {
				$language_array = array(
				  'ids' => $row->ids,
				  'scheme' => $row->scheme,
				  'language_name' => my_caption('tts_language_name_' . $row->language_code),
				  'language_code' => $row->language_code,
				  'voice_id' => $row->voice_id,
				  'engines' => $row->engine,
				  'gender' => str_replace('Male', my_caption('global_gender_male'), str_replace('Female', my_caption('global_gender_female'), $row->gender)),
				  'name' => $row->name,
				  'description' => $row->description,
				  'accessibility_standard' => $row->accessibility_standard,
				  'accessibility_neural' => $row->accessibility_neural
				);
				array_push($result, $language_array);
			}
		}
		//echo"<pre>"; print_r($result);die('f');
		echo json_encode($result);
	}
	
	
	
	public function admin_resource() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_load_view($this->setting->theme, 'Tts/admin_resource');
	}
	
	
	
	public function admin_resource_bulk_action() {
		my_check_demo_mode();  //check if it's in demo mode
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$action = my_uri_segment(3);
		if ($action == 'tts_sync_aws' || $action == 'tts_sync_google') {
			$rs_tts_config = $this->db->get('tts_configuration', 1)->row();
			($action == 'tts_sync_aws') ? $tts_config_array = json_decode($rs_tts_config->aws, TRUE) : $tts_config_array = json_decode($rs_tts_config->google, TRUE);
			if ($tts_config_array['config_file'] != '') {
				if (!$this->check_file_exists($tts_config_array['config_file'])) {
					$this->session->set_flashdata('flash_danger', my_caption('tts_sync_resource_config_file_not_found'));
					redirect(base_url('tts/admin_resource'));
				}
			}
			else {
				$this->session->set_flashdata('flash_danger', my_caption('tts_sync_resource_not_config'));
				redirect(base_url('tts/admin_resource'));
			}
		}
		$this->load->library('m_tts');
		$result = TRUE;
		if ($action == 'tts_sync_aws') {  //sync from aws
			$result = $this->m_tts->syncResource('aws');
			($result) ? $notice = my_caption('tts_sync_resource_notice_success') : $notice = my_caption('tts_sync_resource_notice_fail');
		}
		elseif ($action == 'tts_sync_google') {  //sync from google
			$result = $this->m_tts->syncResource('google');
			($result) ? $notice = my_caption('tts_sync_resource_notice_success') : $notice = my_caption('tts_sync_resource_notice_fail');
		}
		elseif ($action == 'tts_sync_azure') {  //sync from azure
			$result = $this->m_tts->syncResource('azure');
			($result) ? $notice = my_caption('tts_sync_resource_notice_success') : $notice = my_caption('tts_sync_resource_notice_fail');
		}
		elseif ($action == 'tts_sync_ibm') {  //sync from ibm
			$result = $this->m_tts->syncResource('ibm');
			($result) ? $notice = my_caption('tts_sync_resource_notice_success') : $notice = my_caption('tts_sync_resource_notice_fail');
		}
		elseif (substr($action, 0, 11) == 'bulk_enable') { //bulk enabled
			$scheme = str_replace('bulk_enable_', '', $action);
			$this->db->where('scheme', $scheme)->where('enabled', '0')->update('tts_resource', array('enabled'=>'1'));
			$notice = my_caption('tts_resource_notice_enable_success');
		}
		elseif (substr($action, 0, 12) == 'bulk_disable') {  //bulk disable
		    $scheme = str_replace('bulk_disable_', '', $action);
			$this->db->where('scheme', $scheme)->where('enabled', '1')->update('tts_resource', array('enabled'=>'0'));
			$notice = my_caption('tts_resource_notice_disable_success');
		}
		elseif (substr($action, 0, 11) == 'bulk_delete') {  //bulk delete
		    $scheme = str_replace('bulk_delete_', '', $action);
			$this->db->where('scheme', $scheme)->delete('tts_resource');
			$notice = my_caption('tts_resource_notice_delete_success');
		}
		elseif (substr($action, 0, 9) == 'bulk_free' || substr($action, 0, 9) == 'bulk_payg') {  //other bulk operation
			$query = $this->db->get('tts_resource');
			$action = substr($action, 0, 9);
			if ($query->num_rows()) {
				$rs = $query->result();
				foreach ($rs as $row) {
					if ($action == 'bulk_free') {
						$accessibility_standard = $row->accessibility_standard;
						if (substr($accessibility_standard, 0, 4) != 'free') {
							($accessibility_standard == '') ? $accessibility_standard = 'free' : $accessibility_standard = 'free,' . $accessibility_standard;
							$this->db->where('id', $row->id)->update('tts_resource', array('accessibility_standard'=>$accessibility_standard));
						}
						$accessibility_neural = $row->accessibility_neural;
						if (substr($accessibility_neural, 0, 4) != 'free') {
							($accessibility_neural == '') ? $accessibility_neural = 'free' : $accessibility_neural = 'free,' . $accessibility_neural;
							$this->db->where('id', $row->id)->update('tts_resource', array('accessibility_neural'=>$accessibility_neural));
						}
					}
					elseif ($action == 'bulk_payg') {
						$accessibility_standard = $row->accessibility_standard;
						if (!my_check_str_contains($accessibility_standard, 'payg')) {
							($accessibility_standard == '') ? $accessibility_standard = 'payg' : $accessibility_standard .= ',payg';
							$this->db->where('id', $row->id)->update('tts_resource', array('accessibility_standard'=>$accessibility_standard));
						}
						$accessibility_neural = $row->accessibility_neural;
						if (!my_check_str_contains($accessibility_neural, 'payg')) {
							($accessibility_neural == '') ? $accessibility_neural = 'payg' : $accessibility_neural .= ',payg';
							$this->db->where('id', $row->id)->update('tts_resource', array('accessibility_neural'=>$accessibility_neural));
						}
					}
				}
			}
            (substr($action, 0, 9) == 'bulk_free') ? $notice = my_caption('tts_resource_notice_set_free') : $notice = my_caption('tts_resource_notice_set_payg');	
		}
		elseif (substr($action, 0, 11) == 'bulk_revoke') {
			$this->db->update('tts_resource', array('accessibility_standard'=>'', 'accessibility_neural'=>''));
			$notice = my_caption('tts_resource_notice_revoke');
		}
		else {  //unknown action
			$result = FALSE;
			$notice = my_caption('tts_notice_unknown_action');
		}
		if ($result) {
			$this->session->set_flashdata('flash_success', $notice);
		}
		else {
			$this->session->set_flashdata('flash_danger', $notice);
		}
		redirect(base_url('tts/admin_resource'));
	}
	
	
	
	public function admin_resource_edit() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$query = $this->db->where('ids', my_uri_segment(3))->get('tts_resource', 1);
		if ($query->num_rows()) {
			$data['rs'] = $query->row();
			my_load_view($this->setting->theme, 'Tts/admin_resource_edit', $data);
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	public function admin_resource_edit_action() {
		my_check_demo_mode();  //check if it's in demo mode
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$query = $this->db->where('ids', my_post('ids'))->get('tts_resource', 1);
		if ($query->num_rows()) {
			$this->form_validation->set_rules('tts_voice_name', my_caption('tts_voice_name'), 'trim|required|max_length[50]');
			$this->form_validation->set_rules('tts_voice_description', my_caption('global_description'), 'trim|max_length[255]');
			if ($this->form_validation->run() == FALSE) {
				$data['rs'] = $query->row();
				my_load_view($this->setting->theme, 'Tts/admin_resource_edit', $data);
			}
			else {
				$scope_standard_array = $this->input->post('access_scope_standard[]');
				$scopes_standard = '';
				foreach ($scope_standard_array as $scope) {
					$scopes_standard .= $scope . ',';
				}
				$scope_neural_array = $this->input->post('access_scope_neural[]');
				$scopes_neural = '';
				foreach ($scope_neural_array as $scope) {
					$scopes_neural .= $scope . ',';
				}
				(my_post('tts_resource_enabled') == '1') ? $enabled = 1 : $enabled = 0;
				$update_array = array(
				  'enabled' => $enabled,
				  'name' => my_post('tts_voice_name'),
				  'description' => my_post('tts_voice_description'),
				  'accessibility_standard' => rtrim($scopes_standard, ','),
				  'accessibility_neural' => rtrim($scopes_neural, ',')
				);
				$this->db->where('ids', my_post('ids'))->update('tts_resource', $update_array);
				$this->session->set_flashdata('flash_success', my_caption('tts_resource_notice_success'));
				redirect('tts/admin_resource_edit/' . my_post('ids'));
			}
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	public function admin_tts_list() {
	   
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_load_view($this->setting->theme, 'Tts/admin_tts_list');
	}
	
	
	
	public function admin_configuration() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_load_view($this->setting->theme, 'Tts/admin_configuration');
	}
	
	
	
	public function admin_configuration_action() {
		my_check_demo_mode();  //check if it's in demo mode
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$this->form_validation->set_rules('ttsc_preview_delay', my_caption('tts_configuration_preview_delay'), 'trim|required|integer|greater_than[-1]|less_than[9]');
		$this->form_validation->set_rules('ttsc_maximum_characters', my_caption('tts_configuration_maximum_characters'), 'trim|required|integer|greater_than[0]|less_than[100000]');
		$this->form_validation->set_rules('ttsc_maximum_characters_preview', my_caption('tts_configuration_maximum_characters_preivew'), 'trim|required|integer|greater_than[0]|less_than[100000]');
		$this->form_validation->set_rules('ttsc_tryme_tio_mc', my_caption('tts_configuration_tryme_tio_mc'), 'trim|required|integer|greater_than[0]|less_than[100000]');
		$this->form_validation->set_rules('ttsc_payg_price', my_caption('tts_configuration_payg_price'), 'trim|required|greater_than[0]|numeric');
		$this->form_validation->set_rules('ttsc_payg_characters', my_caption('tts_configuration_payg_characters_included'), 'trim|required|greater_than[0]|integer');
		if (my_post('ttsc_storage_solution') == 'S3') {
			$this->form_validation->set_rules('ttsc_aws_config_file', my_caption('tts_configuration_sp_config_file_path'), 'trim|required');
		}
		if (my_post('ttsc_storage_solution') == 'wasabi') {
			$this->form_validation->set_rules('ttsc_wasabi_config_file', my_caption('tts_configuration_sp_config_file_path'), 'trim|required');
		}
		if (my_post('ttsc_aws_config_file') != '') {
			$this->form_validation->set_rules('ttsc_aws_config_file', my_caption('tts_configuration_sp_config_file_path'), 'trim|callback_check_file_exists');
			$this->form_validation->set_rules('ttsc_aws_bucket', my_caption('tts_configuration_sp_bucket'), 'trim|required');
		}
		if (my_post('ttsc_google_config_file') != '') {
			$this->form_validation->set_rules('ttsc_google_config_file', my_caption('tts_configuration_sp_config_file_path'), 'trim|callback_check_file_exists');
		}
		if (my_post('ttsc_wasabi_config_file') != '') {
			$this->form_validation->set_rules('ttsc_wasabi_config_file', my_caption('tts_configuration_sp_config_file_path'), 'trim|callback_check_file_exists');
			$this->form_validation->set_rules('ttsc_wasabi_bucket', my_caption('tts_configuration_sp_bucket'), 'trim|required');
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('flash_danger', my_caption('tts_configuration_notice_fail'));
			my_load_view($this->setting->theme, 'Tts/admin_configuration');
		}
		else {
			$this->tts_model->save_configuration();
			$this->session->set_flashdata('flash_success', my_caption('tts_configuration_notice_success'));
			redirect(base_url('tts/admin_configuration'));
		}
	}
	
	
	
	public function admin_scenario() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		$query = $this->db->order_by('id', 'desc')->get('tts_scenario');
		if ($query->num_rows()) {
			$data['rs'] = $query->result();
		}
		else {
			$data['rs'] = '';
		}
		my_load_view($this->setting->theme, 'Tts/admin_scenario', $data);
	}
	
	
	
	public function admin_scenario_add_action() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_check_demo_mode('simple_json');  //check if it's in demo mode
		$this->form_validation->set_rules('scenario_block_title', my_caption('global_title'), 'trim|required|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$res = '{"result":false, "message":"' . strip_tags($this->form_validation->error('scenario_block_title')) . '"}';
		}
		else {
			$insertArray = array(
			  'ids' => my_random(),
			  'title' => my_post('scenario_block_title'),
			  'description' => my_post('scenario_block_description'),
			  'icon' => my_post('scenario_block_icon'),
			  'voice' => my_post('scenario_block_voice')
			);
			$this->db->insert('tts_scenario', $insertArray);
			$res = '{"result":true, "message":"' . my_caption('tts_scenario_new_created') . '"}';
		}
		echo $res;
	}
	
	
	
	public function admin_scenario_edit_action() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_check_demo_mode('simple_json');  //check if it's in demo mode
		$this->form_validation->set_rules('scenario_block_title', my_caption('global_title'), 'trim|required|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$res = '{"result":false, "message":"' . strip_tags($this->form_validation->error('scenario_block_title')) . '"}';
		}
		else {
			$updateArray = array(
			  'title' => my_post('scenario_block_title'),
			  'description' => my_post('scenario_block_description'),
			  'icon' => my_post('scenario_block_icon'),
			  'voice' => my_post('scenario_block_voice')
			);
			$this->db->where('ids', my_post('scenario_hidden_ids'))->update('tts_scenario', $updateArray);
			$res = '{"result":true, "message":"'. my_caption('tts_scenario_new_updated') . '"}';
		}
		echo $res;
	}
	
	
	
	public function admin_scenario_remove_action() {
		(!my_check_permission('TTS Management')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
		my_check_demo_mode('alert_json');  //check if it's in demo mode
		$this->db->where('ids', my_uri_segment(3))->delete('tts_scenario');
		echo '{"result":true, "title":"' . my_caption('global_deleted_notice_title') . '", "text":"'. my_caption('global_deleted_notice_message') . '", "redirect":"' . base_url('tts/admin_scenario') . '"}';
	}
	
	
	
	
	protected function tts_basic_check($text) {
		if (trim($text) == '') {
			$res_array = array('result'=>FALSE, 'message'=>my_caption('tts_text_required'));
		}
		else {
			$res_array = array('result'=>TRUE);
		}
		if ($res_array['result'] == TRUE && mb_strlen(trim(preg_replace('/\s+/', ' ', $text))) > $this->tts_config->maximum_character) {
			$res_array = array('result'=>FALSE, 'message'=>my_caption('tts_notice_character_limit') . $this->tts_config->maximum_character);
		} 
		return $res_array;		
	}	
	
	public function tts_title_basic_check($title) {
		
		if (trim($title) == '') {
			$res_array = array('result'=>FALSE, 'message'=>'Title is required');
		}
		else {
			$res_array = array('result'=>TRUE);
		}
		 
		
		if ($res_array['result'] == TRUE ) {
			$this->form_validation->set_rules('tts_title', 'title', 'is_unique[tts_log.title]');
			if($this->form_validation->run() == false) {
			
				$res_array = array('result'=>FALSE, 'message'=> 'The title name already exits');
			}else {
				
				$res_array = array('result'=>TRUE);
			}
		}
	
		return $res_array;		
	}
	
	
	
	public function check_file_exists($file_path) {
		if (file_exists($file_path)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('check_file_exists', my_caption('tts_configuration_notice_file_not_exist'));
			return FALSE;
		}
	}
	
	
	
	protected function text_builder($text, $scheme, $ssml_mode) {
		$text_array = array();
		if ($ssml_mode) {
			$text_array['text_type'] = 'ssml';
			$text_array['text_text'] = $text;
		}
		else {
			$ssml_property = '';
			$text_check_result = my_tts_check_ssml(my_post('tts_text'), my_post('synthesize_type'));
			$text_array['text_type'] = $text_check_result['type'];
			$text_array['text_text'] = $text_check_result['text'];
			if (my_post('tts_ssml_volume') != 'default') {
				if (my_check_str_contains('x-soft,soft,medium,loud,x-loud', my_post('tts_ssml_spk_rate'))) {
					$ssml_property = ' volume="' . my_post('tts_ssml_volume') . '"';
				}
			}
			if (my_post('tts_ssml_spk_rate') != 'default') {
				if (my_check_str_contains('x-slow,x-slow,medium,fast,x-fast', my_post('tts_ssml_spk_rate'))) {
					$ssml_property .= ' rate="' . my_post('tts_ssml_spk_rate') . '"';
				}
			}
			if ($text_array['text_type'] == 'ssml' || $ssml_property != '') {
				$text_array['text_type'] = 'ssml';
				if ($scheme == 'azure') {
					(my_post('tts_ssml_spk_rate') != 'default' || my_post('tts_ssml_volume') != 'default') ? $text_array['text_text'] = '<prosody' . $ssml_property . '>' . $text_array['text_text'] . '</prosody>' : null;
				}
				else {
					$text_array['text_text'] = '<speak><prosody' . $ssml_property . '>' . $text_array['text_text'] . '</prosody></speak>';
				}
			}
		}
		$text_array['text_length'] = mb_strlen($text_array['text_text'], 'utf-8');  //all handle with utf-8
		return $text_array;
	}
	
	

	
	protected function update_statitics($type, $characters_count) {
		$rs_statitics =  my_tts_generate_user_statitics(); //check & if not exist then generate
		if ($type == 'preview') {
			$characters_preview_used = $rs_statitics->characters_preview_used + $characters_count;
			$characters_production_used = $rs_statitics->characters_production_used;
			$voice_generated = $rs_statitics->voice_generated;
		}
		else {  //production
			$characters_preview_used = $rs_statitics->characters_preview_used;
			$characters_production_used = $rs_statitics->characters_production_used + $characters_count;
			$voice_generated = $rs_statitics->voice_generated + 1;
		}
		$update_data = array(
		  'characters_preview_used' => $characters_preview_used,
		  'characters_production_used' => $characters_production_used,
		  'voice_generated' => $voice_generated
		);
		$this->db->where('user_ids', $_SESSION['user_ids'])->update('tts_statitics', $update_data);
		return TRUE;
	}
	
	public function artical_search() {
	
			$keyword = $this->input->post('search');
			$page_no 		= $this->input->post("page_no");
			$ezine_category = $this->input->post("ezine_category");
			$url="http://api.ezinearticles.com/api.php?search=articles&category=".urlencode($ezine_category)."&limit=10&page=".$page_no."&response_format=json&key=6UgHsAY74XtARHLKCnMcfjQZcQRGNX";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	// true: return as string
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	// true: follow redirects
					curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			// 1: max 1 redirect
					curl_setopt($ch, CURLOPT_AUTOREFERER, true);	// true: set referer on redirect
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	// timeout on connect
					curl_setopt($ch, CURLOPT_TIMEOUT, 120);			// timeout on response
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	// true: follow redirects
					curl_setopt($ch, CURLOPT_HEADER, false);		// false: do not print headers
					$result = curl_exec($ch);
					curl_close($ch);
					$json_result = json_decode ($result, TRUE);
					
				if ( !empty($result) && !empty($json_result["articles"])) {
						$contentNews=array();
						foreach($json_result["articles"] as $key=>$content) {
							$articles = $content["article"];
							
								$contentImage=$this->config->item("assetsTemplatePath")."images/default-story-img.png";
						
							//$check_url = $this->StoryModel->checkStoryUrl($articles["url"]);
							if($check_url){
								$story_saved = "yes";
							}
							else {
								$story_saved = "no";
							}
							$contentNews[]=array(
												"title" 		=> $articles["title"],
												"source"		=> $cpData->title,
												"description" 	=> $articles["summary"],
												"url" 			=> $articles["url"],
												"urlToImage" 	=> $contentImage,
												"storySaved" 	=> $story_saved,
												"publishDate" 	=> $articles["date_published"]
												);
						}
						$output["content"]=$contentNews;
							$output["nextPageLink"]="no";
							echo json_encode($output);
							die;
					}
	
	}
	
	
	public function audio_list() {

		
		$data['statitics'] =  my_tts_generate_user_statitics();
		//$package_balance_array = my_tts_get_package_balance();
		if ($package_balance_array['amount'] >= 0) {
			$data['availableCharacters'] = $package_balance_array['amount'] + $data['statitics']->payg_balance;
			if ($package_balance_array['package'] == '') {
				$data['availableCharacters'] = $data['availableCharacters'] . ' ' . my_caption('tts_standard_characters');
			}
			else {
				$data['availableCharacters'] = $package_balance_array['package'] . '; ' . $data['availableCharacters'] . ' ' . my_caption('tts_standard_characters');
			}
		}
		else {
			if ($package_balance_array['amount'] = -1 && $package_balance_array['package'] == '') {
				$data['availableCharacters'] = $data['statitics']->payg_balance;
			}
			else {
				$data['availableCharacters'] = $package_balance_array['package'];
			}
		}
		$this->loadView('Tts/start_list', $data);
	}
	
    public function delete_tts_multiple() {
		 $idArray = explode(",", $this->input->get('id_data'));
	
        foreach ($idArray as $key => $val) {
            $this->db->where_in('id', "$val");
            $this->db->delete('tts_log');
        }
        $output['success'] = array('message' => 'Vox Deleted Successfully.');
        echo json_encode($output);
        die;
	}
	
	
	
}
?>