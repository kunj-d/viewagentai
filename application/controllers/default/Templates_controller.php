<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');

class Templates_controller extends AppDefault {

	function __construct() {

		parent::__construct();
	
		$this->checkAlreadyLogout();
		 
		$this->Common_Model->checkSubDomain();
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
		$this->user_id = $this->session->userdata('logged_in')['id'];
		
		$this->view_folder = $this->config->item('template');
		$this->model_folder = $this->view_folder;
		$this->load->model($this->model_folder . "Business_model");
	
		if(!empty($this->session->userdata('business'))){
			$this->business_id = $this->session->userdata('business')['id'];
		}else{
			$this->business_id = $this->session->userdata('business_switch_session');
		}

		if(!in_array('template_editor',$this->session->userdata('features'))) {
			$output['error']['type'] = 'flash';
			$output['error']['message'] = 'Please upgrade your plan';
			$this->session->set_flashdata('message', json_encode($output));
			redirect('subscription');
	  	}

	}

	public function index(){
 
			 if(!empty($_GET['size'])) {
				$size = $_GET['size'];    
			 }else {
				 $size = '1200x628';
			 }
		$this->size( $size );

	}
	
	public function templates_new(){
	    $this->loadView('templates/new_templates');
	}
	
	public function templates_questions(){
	    $this->loadView('templates/templates_questions');
	}

	public function size( $size ){

		$access_level = $this->session->userdata( 'access_level' );
		$data = array();
		$userID = $this->user_id;
		$adminUserID = $this->Common_Model->get_data( 'tbl_user', array('role'=>'admin'), 'id' );
		$pre_templates = $pre_templates_count = array();
		$templates = $this->Common_Model->get_data( 'user_templates', array( 'user_id'=>$userID, 'save_as_template'=>1, 'status'=>1 ) );
		// pr($adminUserID); die(' here');

		if(!empty($adminUserID)){
			$pre_templates = $this->Common_Model->query( "SELECT * FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND template_size = '".$size."' AND `template_id` NOT IN(1,2) ORDER BY `modifydate` DESC LIMIT 0,12" );
			$pre_templates_count = $this->Common_Model->query( "SELECT COUNT(*) as total FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND template_size = '".$size."' AND `template_id` NOT IN(1,2) ORDER BY `modifydate` DESC" );
			$templates_count = $this->Common_Model->query( "SELECT COUNT(*) as total FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND `template_id` NOT IN(1,2) ORDER BY `modifydate` DESC" );
			$template_size_count = $this->Common_Model->query('SELECT template_size, COUNT(*) as tot FROM `user_templates` WHERE `user_id` = '.$adminUserID[0]['id'].' AND `campaign_id` = 1 AND status = 1 AND `template_id` NOT IN(1,2) GROUP BY template_size');
		}

		$campaigns = $this->Common_Model->get_data( 'campaign', array( 'user_id' => $userID ) );
		$data['templates'] = array_merge($pre_templates, $templates);
		$data['campaigns'] = $campaigns;
		$data['size'] = $size;
		$data['template_size_count'] = $template_size_count;
		$data['sizetotal'] = !empty($pre_templates_count) ? $pre_templates_count[0]['total'] : 0;
		$data['total'] = 3137;
		$data['subcat'] = $this->Common_Model->get_data( 'sub_category', array( 'cat_id' => 1, 'sub_cat_id !=' => 8 ) );
		// $data['subcat'] = array();

		$this->loadView('templates/index', $data);
	}

	public function action(){

		if(!isset( $_POST['template_id'] )){ echo json_encode( array( 'status' => 0, 'msg' => html_escape($this->lang->line('ltr_images_action_msg1'))) ); die(); }

		$userID = $this->user_id;

		if(isset($_POST['sub_user_id']) && !empty($_POST['sub_user_id'])){

			$sub_users = $this->Common_Model->get_data( 'sub_users', array('parent_user_id'=>$userID,'sub_user_id'=>html_escape($_POST['sub_user_id']),'status'=>1) );

			if(count($sub_users) == 1){

				$userID = html_escape($_POST['sub_user_id']);

			}

		}

		$where = array( 'template_id' => $_POST['template_id'], 'user_id' => $userID, 'status' => 1 );

		$template = $this->Common_Model->get_data( 'user_templates', $where );

		if(empty($template)){ echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg2'))) ); die(); }

		if(isset($_POST['action']) && $_POST['action'] == 'copy'){

			unset($template[0]['template_id']);

			$template[0]['datetime'] = date('Y-m-d H:i:s');

			$file = './'.$template[0]['thumb'];

			$name = random_generator() . '.jpg';

			$newfile = './uploads/user_'.$userID.'/templates/'.$name;

			if (!copy($file, $newfile)) {

				echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg3'))) );

				die();

			}

			$template[0]['thumb'] = 'uploads/user_'.$userID.'/templates/'.$name;
			$what = $template[0];
			$insert_id = $this->Common_Model->put_data( 'user_templates', $what );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg4')), 'insert_id' => $insert_id, 'data' => $what ) );

		}

		if(isset($_POST['action']) && $_POST['action'] == 'delete'){

			$path = $template[0]['thumb'];

			if(!empty($path)) unlink($path);

			$this->Common_Model->delete_data( 'user_templates', $where );	

			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg5'))) );

		}

		if(isset($_POST['action']) && $_POST['action'] == 'rename'){

			$what = array( 'template_name' => html_escape($_POST['template_rename']) );

			$this->Common_Model->set_data( 'user_templates', $what, $where );

			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg6'))) );

		}

		if(isset($_POST['action']) && $_POST['action'] == 'save_as_template'){

			$what = array( 'save_as_template' => 1 );

			$this->Common_Model->set_data( 'user_templates', $what, $where );

			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_images_action_msg7'))) );

		}

		die();

	}

	public function campaign_template(){

		$campaign_id = 1;
		$template_id = '';
		$userID = $this->user_id;

		if(!empty($_POST['campaign_name'])){
			$campaign_name = html_escape($_POST['campaign_name']);
			$what = array( 
				'name' => trim($campaign_name),
				'user_id' => $userID,
				'datetime' => date('Y-m-d H:i:s'),
				'status' => 1
			);
			$campaign_id = $this->Common_Model->put_data( 'campaign', $what );
		}

		if(!empty($campaign_id)){

			$template_name = html_escape($_POST['template_name']);
			$get_template_id = html_escape($_POST['get_template_id']);
			$template_userID = html_escape($_POST['template_userID']);
			$template_data = $this->Common_Model->get_data( 'user_templates', array( 'user_id' => $template_userID, 'template_id' => $get_template_id, 'status' => 1 ), 'template_data,template_size,cat_id,sub_cat_id', array() );
			
			if(!empty($template_data)){

				$what = $template_data[0];
				$date = date('Y-m-d H:i:s');
				$what['user_id'] = $userID;
				$what['template_name'] = $template_name;
				$what['campaign_id'] = $campaign_id;
				$what['datetime'] = $date;
				$what['modifydate'] = $date;
				$what['status'] = 1;

				$template_id = $this->Common_Model->put_data( 'user_templates', $what );
				$url = base_url() . 'editor/edit/'.$campaign_id.'/'.$template_id;
				echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_images_campaign_template_msg1')), 'url' => $url ) );
			}else{

				$template_data = $this->Common_Model->get_data( 'user_templates', array( 'template_id' => 1, 'status' => 1 ), 'template_data,cat_id,sub_cat_id', array() );

				$what = $template_data[0];
				$date = date('Y-m-d H:i:s');
				$what['user_id'] = $userID;
				$what['template_size'] = html_escape($_POST['template_size']);
				$what['template_name'] = $template_name;
				$what['campaign_id'] = $campaign_id;
				$what['datetime'] = $date;
				$what['modifydate'] = $date;
				$what['status'] = 1;

				$template_id = $this->Common_Model->put_data( 'user_templates', $what );
				$url = base_url() . 'editor/edit/'.$campaign_id.'/'.$template_id;
				echo json_encode( array( 'status' => 1, 'msg' =>'Graphics created successfully', 'url' => $url ) );
			}			
		}else{
			echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_images_campaign_template_msg2'))) );
		}
	  die();
	}
	
	public function get_more_template(){

		if(isset($_POST['reach'])){

			$userID = $this->user_id;

			$adminUserID = $this->Common_Model->get_data( 'tbl_user', array('role'=>'admin'), 'id' );

			$pre_templates = array();

			$count = array();

			$templates = $this->Common_Model->get_data( 'user_templates', array( 'user_id'=>$userID, 'save_as_template'=>1, 'status'=>1 ) );

			$size = html_escape($_POST['size']);

			$access_level = $this->session->userdata( 'access_level' );

			if(!empty($adminUserID)){

				$subcat = $search = '';

				if($_POST['sub_cat_id'] != 'all'&& isset($_POST['sub_cat_id']) && $_POST['sub_cat_id'] != ''){ 
				    $subcat = 'AND cat_id = 1 AND sub_cat_id = '.html_escape($_POST['sub_cat_id']); 
				}

				if(isset($_POST['q']) && !empty($_POST['q'])){
					$search = 'AND template_name LIKE "%'.html_escape($_POST['q']).'%"';
				}

				if($_POST['use']){

					$where = array( 'user_id' => $adminUserID[0]['id'], 'campaign_id' => 1, 'status' => 1, 'template_size' => $size );

					if($_POST['sub_cat_id'] != 'all'){

						$where['cat_id'] = 1;

						$where['sub_cat_id'] = html_escape($_POST['sub_cat_id']);

					}

					if(isset($_POST['q']) && !empty($_POST['q'])){

						$where['template_name LIKE'] = '%'.html_escape($_POST['q']).'%';

					}

					$pre_templates = $this->Common_Model->get_data_limit( 
								'user_templates', 
								$where, 
								'template_id,thumb,template_name,template_size,status,datetime,user_id', 
								array(html_escape($_POST['reach']),12),
								'modifydate',
								'DESC'
							);
					$count = $this->Common_Model->query( "SELECT template_id FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND template_size = '".$size."' $subcat $search ORDER BY `modifydate` DESC LIMIT ".(html_escape($_POST['reach'])+12).",12" );
// print_r($pre_templates);
// die();
				}else{

					$sql = "SELECT template_id,thumb,user_id,template_name,template_size,status,DATE_FORMAT(datetime, \"%d/%m/%Y\") as datetime FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND template_size = '".$size."' AND `template_id` NOT IN(1,2) $subcat $search ORDER BY `modifydate` DESC LIMIT ".html_escape($_POST['reach']).",12";

					$pre_templates = $this->Common_Model->query( $sql );

					$count = $this->Common_Model->query( "SELECT template_id FROM `user_templates` WHERE `user_id` = ".$adminUserID[0]['id']." AND `campaign_id` = 1 AND `status` = 1 AND template_size = '".$size."' AND `template_id` NOT IN(1,2) $subcat $search ORDER BY `modifydate` DESC LIMIT ".(html_escape($_POST['reach'])+12).",12" );

				}

			}

			$response = array(
				'status' => 1,
				'reach' => html_escape($_POST['reach']) + count( array_merge($pre_templates, $templates) ),
				'data' => array_merge($pre_templates, $templates),
				'templates' =>array_merge($pre_templates, $templates),
				'hide' => count($count) > 0 ? 0 : 1
				);
			echo json_encode( $response );
			die();
		}

	}

	/**
	 * Embed Code Template Images
	 */
	public function embed_code_template_images($id){
		$temp_id = base64_encode($id);
		$templates = $this->Common_Model->get_data('user_templates', array('template_id'=>$temp_id));
		if(!empty($templates[0]['thumb'])):
		 echo "<img src='".base_url().$templates[0]['thumb']."' alt='".$templates[0]['template_name']."' width='500' height='300'>";
		else:
		 echo "Not Found !";	
		endif;
	}

	public function my_templates(){
		ini_set('memory_limit', '-1');
		$userID = $this->user_id;
		$where = array( 'user_id' => $userID, 'status' => 1 );
		$data = array();
		$data['templates'] = $this->Common_Model->get_data( 'user_templates', $where, '*', array( 'template_id'=>'DESC' ) );
		$data['campaigns'] = $this->Common_Model->get_data( 'campaign', array( 'user_id' => $userID ) );
		$this->loadView('templates/my_templates', $data);
	}

}