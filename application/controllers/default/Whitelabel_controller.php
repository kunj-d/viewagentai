<?php
defined('BASEPATH') or exit('No direct script access allowed');
include("AppDefault.php");

class Whitelabel_controller extends AppDefault
{

	public function __construct()
	{
		parent::__construct();
		$this->checkAlreadyLogout();
		//   if($this->session->userdata('logged_in')['id'] != $this->session->userdata('logged_in')['owner_id']) {
		//     redirect('dashboard');
		//     }
		//  $output['all_plan_features'] = $this->all_plan_features;
		if (!in_array('white_lable', $this->session->userdata('features'))) {
			$output['error']['type'] = 'flash';
			$output['error']['message'] = 'Please upgrade your plan';
			$this->session->set_flashdata('message', json_encode($output));
			redirect('subscription');
		}
		$this->load->model('default/Whitelabel_model');
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id = $this->session->userdata('logged_in')['id'];
		$this->business_id = $this->session->userdata('business_id');
		$this->model_folder = $this->config->item('template');
		$this->load->model($this->model_folder . "Whitelabel_model");




		// print_r($this->session->userdata('logged_in')); die('kk');
	}


	public function index()
	{

		$data = array();
		$userid = $this->session->userdata('logged_in')['id'];

		$output = $this->Whitelabel_model->getdata($this->business_id);
		$data['data'] = $output;

		$data['library_page'] = true;
		$this->loadView('whitelabel/whitelabel', $data);
	}

	public function insertdata()
	{

		if ($this->input->is_ajax_request()) {
			$userid = $this->session->userdata('logged_in')['id'];

			$user_data = $this->Whitelabel_model->getdata($this->business_id);
	
			if (!$user_data) {
				$datatoinsert = [];
				if (!empty($_FILES['logo']['name'])) {
					$config['file_name'] = time() . '_logo.jpg';
					// $config['upload_path']='assets/uploads/users/589/';
					$config['upload_pats'] = 'assets/uploads/users/' . $this->user_id;
					$config['upload_path'] = 'assets/uploads/users/' . $this->user_id . '/business_logo/';
					if (!is_dir($config['upload_pats'])) {
						mkdir($config['upload_pats']);
					}

					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path']);
					}

					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					//   echo '<pre>'; print_r($this->upload); die;

					if (!$this->upload->do_upload('logo')) {
						$output['error']['message'] = $this->upload->display_errors();
						$output['error']['type'] = "flash";
						$this->session->set_flashdata('message', json_encode($output));
						echo json_encode($output);
						die();
					} else {
						$data = array('upload_data' => $this->upload->data());
						$image = $data['upload_data']['file_name'];
					}


					$datatoinsert['logo'] = $config['upload_path'] . $image;
				}

				if (!empty($_FILES['chatbot_footer_branding']['name'])) {

					$config['file_name'] = time() . '_chatbot_footer_branding.jpg';
					// $config['upload_path']='assets/uploads/users/589/';
					$config['upload_pats'] = 'assets/uploads/users/' . $this->user_id;
					$config['upload_path'] = 'assets/uploads/users/' . $this->user_id . '/business_logo/';
					if (!is_dir($config['upload_pats'])) {
						mkdir($config['upload_pats']);
					}

					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path']);
					}

					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);


					if (!$this->upload->do_upload('chatbot_footer_branding')) {
						$output['error']['message'] = $this->upload->display_errors();
						$output['error']['type'] = "flash";
						$this->session->set_flashdata('message', json_encode($output));
						echo json_encode($output);
						die();
					} else {
						$data = array('upload_data' => $this->upload->data());
						$chatbot_footer_branding = $data['upload_data']['file_name'];
					}


					$datatoinsert['chatbot_footer_branding']  = $config['upload_path'] . $chatbot_footer_branding;
				}

				$datatoinsert['userid']    =  $this->business_id;
				
				
				$datatoinsert['chatbot_footer_branding_redirect_url']    =  $_REQUEST['chatbot_footer_branding_redirect_url'];
				$datatoinsert['text']    =  'saglus';
				$datatoinsert['fontcolor']    =  '#000';
				$datatoinsert['boxcolor']    =  '#000';
				$datatoinsert['fontsize']    =  '40';
				$datatoinsert['chatbot_footer_is_text_labeling']    =  $_REQUEST['checkCustomLabel'];
				$datatoinsert['theme_style']    =  $_REQUEST['checkisthemeDark'];
				$datatoinsert['theme_color']    =  $_REQUEST['checkCustomThemeColor'];
			
				
				$datatoinsert['sitetitle'] =  'Tubestar';
				$this->Whitelabel_model->insertdata($datatoinsert);
				
	   //     pr($this->db->last_query());
				// pr($datatoinsert); die('123');
				$output['success']['type'] = 'flash';
				$output['success']['message'] = 'Data Inserted Successfully';
				$this->session->set_flashdata('message', json_encode($output));
				echo json_encode($output);
				die();
			} else {
				$datatoupdate = [];
				if (!empty($_FILES['logo']['name'])) {
					$config['file_name'] = time() . '_logo.jpg';
					// $config['upload_path']='assets/uploads/users/589/';
					$config['upload_pats'] = 'assets/uploads/users/' . $this->user_id;
					$config['upload_path'] = 'assets/uploads/users/' . $this->user_id . '/business_logo/';
					if (!is_dir($config['upload_pats'])) {
						mkdir($config['upload_pats']);
					}

					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path']);
					}

					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);


					if (!$this->upload->do_upload('logo')) {

						$error = array('error' => $this->upload->display_errors());
						$output['error']['message'] = $this->upload->display_errors();
						$output['error']['type'] = "flash";
						$this->session->set_flashdata('message', json_encode($output));
						echo json_encode($output);
						die();
					} else {
						$data = array('upload_data' => $this->upload->data());
						$image = $data['upload_data']['file_name'];
					}
					$datatoupdate['logo'] = $config['upload_path'] . $image;
					if($user_data[0]->logo !==  "assets/default/images/logo.png"){
					    unlink($user_data[0]->logo);
					}
				}

				if (!empty($_FILES['chatbot_footer_branding']['name'])) {
					$config['file_name'] = time() . '_chatbot_footer_branding.jpg';
					// $config['upload_path']='assets/uploads/users/589/';
					$config['upload_pats'] = 'assets/uploads/users/' . $this->user_id;
					$config['upload_path'] = 'assets/uploads/users/' . $this->user_id . '/business_logo/';
					if (!is_dir($config['upload_pats'])) {
						mkdir($config['upload_pats']);
					}

					if (!is_dir($config['upload_path'])) {
						mkdir($config['upload_path']);
					}

					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);


					if (!$this->upload->do_upload('chatbot_footer_branding')) {

						$error = array('error' => $this->upload->display_errors());
						$output['error']['message'] = $this->upload->display_errors();
						$output['error']['type'] = "flash";
						$this->session->set_flashdata('message', json_encode($output));
						echo json_encode($output);
						die();
					} else {
						$data = array('upload_data' => $this->upload->data());
						$chatbot_footer_branding = $data['upload_data']['file_name'];
						$chatbot_footer_branding = $config['upload_path'] . $chatbot_footer_branding;
					}
					if($user_data[0]->chatbot_footer_branding !== "chat/chatbot_footer.png"){
					    unlink($user_data[0]->chatbot_footer_branding);
					}

					$datatoupdate['chatbot_footer_branding'] =   $chatbot_footer_branding;
				}
                
                $datatoupdate['chatbot_footer_branding_redirect_url']    =  $_REQUEST['chatbot_footer_branding_redirect_url'];
				$datatoupdate['text']    =  $_REQUEST['text'];
				$datatoupdate['fontcolor']    =  $_REQUEST['fontcolor'];
				$datatoupdate['boxcolor']    =  $_REQUEST['boxcolor'];
				$datatoupdate['fontsize']    =  $_REQUEST['fontsize'];
				$datatoupdate['chatbot_footer_is_text_labeling']    = $_REQUEST['checkCustomLabel'];
				$datatoupdate['theme_style']    = $_REQUEST['checkisthemeDark'];
				$datatoupdate['theme_color']    =  $_REQUEST['checkCustomThemeColor'];
				$this->Whitelabel_model->updatedata($datatoupdate);

				$output['success']['type'] = 'flash';
				$output['success']['message'] = 'Data Updated Successfully';
				$this->session->set_flashdata('message', json_encode($output));
				echo json_encode($output);
				die();
			}
		}
	}

	public function whitelabel_reset()
	{
		$user_id = $_POST['user_id'];
		$this->db->where('userid', $user_id);
		$result = $this->db->delete('web_setting');
		$output = 'Deleted';
		$this->session->set_flashdata('message', json_encode($output));
		echo json_encode($output);
		die();
	}
	
	public function whitelabel_style(){
	    $user_id = $this->business_id;
		$this->db->where('userid', $user_id);
		$result = $this->Whitelabel_model->getThemeSetting($user_id);
		print_r($result);
		$output = 'Changed';
		$this->session->set_flashdata('message', json_encode($output));
		echo json_encode($output);
		die();
	}
}
