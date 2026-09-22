<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');

class Assets_controller extends AppDefault {

	public function __construct()
	{ 
	    
        parent::__construct();

        $this->checkAlreadyLogout();
		$this->Common_Model->checkSubDomain();
		$this->load->model('default/library_model');
		$this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
		$this->owner_id 		= 	$this->session->userdata('logged_in')['owner_id'];
		$this->user_id 				= $this->session->userdata('logged_in')['id'];
		$this->assets_folder =   $this->config->item('assetsTemplatePath');
		$this->upload_folder 	= $this->config->item('uploadPath');

		if(!in_array('my_assets',$this->session->userdata('features'))) {
			$output['error']['type'] = 'flash';
			$output['error']['message'] = 'Please upgrade your plan';
			$this->session->set_flashdata('message', json_encode($output));
			redirect('subscription');
	  	}


	}

	public function index(){
	  
	    	$this->loadView('myassets/assets');
	}
	
	
	
	public function openFolderView(){

		$order_by =  $this->input->post('order_by') ? $this->input->post('order_by') : 'DESC';
		$order_type =  $this->input->post('order_type') ? $this->input->post('order_type') : 'modified_date';
		$type =  $this->input->post('type') ? $this->input->post('type') : '';
		$folder_id =  $this->input->post('folder_id') ? $this->input->post('folder_id') : '';
	
		
		$data = array(
			'business_id'=>$this->business_id,
			'library_folder_id'=>$folder_id
		);
		

	   $records = $this->library_model->getFolderData($data);
	  
	            
		$output = array(
				"records" => $records
		);
    

		$response 	= array('message'=>$output,'callback'=>'','redirect_type'=>'angular','redirect_url'=>'');
	    $response['status'] = 'success';
	    
	   
	    echo json_encode($response);
		die;
	}
	
	
	
	
	
	public function addFolder(){
	    $response = array('status'=>'error','message'=>'','callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
	    $this->form_validation->set_rules('title','Title','trim|required');
		$folder_id =  $this->input->post('folder_id') ? $this->input->post('folder_id') : '0';
		
		if($folder_id == ''){
			$folder_id = 0;
		}
		
		
		if($this->form_validation->run()){
			
			$data = array(
				'file_name'			=>	$this->input->post('title'),
				'file_alt_name'			=>	$this->input->post('title'),
				'library_folder_id'			=>	$folder_id,
				'business_id'	=>	$this->business_id,
				'status' 		=> 	'1',
				'file_type' 		=> 	'5',
				'privacy_status' 		=> 	'1',
				'password' 		=> 	'',
				'created_by'	=>		$this->business_id,
				'created_date'	=>	time(), 
				'modified_date'	=>	time(),
				'modified_by'	=>		$this->business_id,
			);
			
			$chk_condition = array(
				'file_name'			=>	$this->input->post('title'),
				'business_id'	=>	$this->business_id
			);
			
			$exist  = $this->library_model->check_folder_exist($chk_condition);
			
		
			if(!$exist){
				
				$output = $this->library_model->add_folder($data);
            $this->Common_Model->set_user_logs('Create Folder assets Settings', $this->input->post('title'));
				if($output['success']== 1){
					$data = array('library_object_id'=>$output['id'],'library_folder_id'=>$output['id']);
				// 	$res = $this->create_share_link($data);
					$response['status'] 	= 'success';
				// 	$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_002'),"Folder");
				    $response['message'] 	= 'Folder Created Successfully';
					$response['insert_id'] 	= $output['id'];
					
					$get_data = $this->library_model->get_folder($output['id']);
				
				}
			}else{
				$response['message'] 	= "Folder Already exist";
			}
	
		}
	  
	    echo json_encode($response);
		die;
	}
	
	
	
	
	public function getAllFolders(){
	    
	    $response = array('status'=>'success','message'=>'','callback' => '','redirect_type'=>'angular','redirect_url'=>'');
		$data = array(
			'business_id'=>$this->business_id,
			'status'=>1
		);
		$folders  = $this->library_model->get_all_folders($data);
		
		if(count($folders) == 0)
		{
	    	$insertdata = array(
				'file_name'			=>	'New Folder',
				'file_alt_name'			=>	'New Folder',
				'library_folder_id'			=>	$folder_id,
				'business_id'	=>	$this->business_id,
				'status' 		=> 	'1',
				'file_type' 		=> 	'5',
				'privacy_status' 		=> 	'1',
				'password' 		=> 	'',
				'created_by'	=>		$this->business_id,
				'created_date'	=>	time(), 
				'modified_date'	=>	time(),
				'modified_by'	=>		$this->business_id,
			);
			$this->library_model->add_folder($insertdata);
	    	$folders  = $this->library_model->get_all_folders($data);
		}
		
	    $output = array(
					"total_record"	=>	count($folders),
					"records"		=>	$folders,
					"draw"			=>	1,
				);
		$response['message'] = $output;
        echo json_encode($response);
        die;
	}
	
	
	
	public function renameFolder(){

		$response = array('status'=>'error','message'=>'','callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('id','Folder Id','trim|required');
		if($this->form_validation->run()){
			$data = array(
				'file_name'			=>	$this->input->post('title'),
				'modified_date'	=>	time(),
				'modified_by'	=>	$this->user_id,
			);
			$condition = array(
				'library_object_id'	=>	$this->input->post('id'),
				'business_id'	=>	$this->business_id
			);
			
			$chk_condition = array(
				'file_name'			=>	$this->input->post('title'),
				'library_object_id !=' =>	$this->input->post('id'),
				'business_id'	=>	$this->business_id
			);
			$exist  = $this->library_model->check_folder_exist($chk_condition);
			  $this->Common_Model->set_user_logs('Rename Folder assets', $this->input->post('title'));
			if(!$exist){
				$output = $this->library_model->update_folder($condition, $data);
				//echo $this->db->last_query(); die;
				if($output){
					$response['status'] 	= 'success';
					$response['message'] 	= 'Folder Update Successfully';

				}
			}else{	
				$response['message'] 	= 'Folder exist';
			}
		}else{
			$response['status']  = 'error';
			$error['title'] 	 = form_error('title');
			$error['id'] 	 = form_error('id');
			$response['message'] = $error;
		}
	    echo json_encode($response);
		die;
	}
	
	
	public function deleteObject(){
         $object_id = array();
         $object_id = json_decode($this->input->post('object_id'), true);
         $this->form_validation->set_rules('object_id', 'Files', 'trim|required');
        if ($this->form_validation->run()) {
            
            $file_id = array();
            $folder_id = array();
            foreach ($object_id as $value) {
                if ($value['type'] == '1') {
                    $this->db->where('library_object_id',$value['id'])->delete('smart_library_objects');
                } else {
                    $this->db->where('library_folder_id',$value['id'])->delete('smart_library_objects');
                    $this->db->where('library_object_id',$value['id'])->delete('smart_library_objects');
                }
            } 
            
            $this->Common_Model->set_user_logs('Delete Conversation  ', 'conversation delete successfully');
             $result = array(
                'status' => 1,
                'type' =>  $object_id[0]['type'],
                'msg' => 'Success'
            );
        } else {
             $result = array(
                'status' => 0,
                'msg' => 'Something went wrong'
            );
        }
        // pr($result);
        // die;
        echo json_encode($result);
        die;
	}
	
	
	// end deleteObject function
	
	
	
	
	
	
	public function getAssets(){
	    $post_data = json_decode(file_get_contents('php://input'), true);
	    $this->db->where('type',$post_data['type']);
	    $this->db->where('myasset','on');
	    $this->db->order_by('asset_created_at','DESC');
		$list = $this->db->get('chatgpt')->result_array();
		$result = array(
			'status' => 1,
			'list' => $list,
			'msg' => 'Success'
		);
		echo json_encode($result);
		die;
	}
	
	public function getDocxData(){
        $post_data = json_decode(file_get_contents('php://input'), true);
	    $this->db->where('id', $post_data['id']);
        $chats = $this->db->get('chatgpt')->row();
        $htmlContent = $chats->ai;
        $result = array(
        'ai' => $htmlContent
        );
       echo json_encode($result);
        die;
	}
	

	
	
}
?>