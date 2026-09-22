<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');

/**
 * @package			:	Saglus Smart
 * @subpackage		:	Smart Library
 * @Class		 	:	Library	
 * @author		 	:	Firoz
 * @created_date 	:	15-05-2018	
 * @modified_date 	:	14-06-2018	
 * @modified_by 	:	Dharmendra Nama
 */
class Library extends AppDefault {
	public function __construct(){
		parent::__construct();
		
		$this->model_folder = $this->config->item('template');
		$this->load->model($this->model_folder . "library_model");
// 		$this->load->model('smart/getdata_model');
// 		$this->load->model('smart/login/Smartlogin_model');
// 		$this->load->helper('smart/office_converter_helper');
// 		$this->load->model('smart/library_model');
// 		$this->load->model('smart/storage_model');
// 		$this->load->helper('smart/cdn_url_helper');
// 		$this->load->helper('smart/upload_helper');
// 		$this->load->helper('encrypt'); // Load this helper
// 		$this->load->helper('string');
// 		$this->load->helper('file');
// 		$this->load->library('amazons3');
// 		$this->share_url = $this->get_fontend_domain(true).'doc/';
// 		$this->share_private_url = $this->config->item('private_library_share_url').'share/';
// 		$this->cdn_url = $this->config->item('cdn_url');
// 		//$this->cdn_url = $this->config->item('aws_url');
                
//                 $this->tbl_smart_businesses = "smart_businesses";
// 		/* added by trilok start*/
		
// 		$subdomain = join('.', explode('.', $_SERVER['HTTP_HOST'], -2));
// 		//if($subdomain == 'www' || $subdomain == 'my'){
// 		if($subdomain == 'my'){
// 			$this->business_id = $this->user_id; // when user login
// 			/*
// 			if($this->parent_id != NULL){
// 				$this->business_id = $this->parent_id; // when team member login
// 			}
// 			*/
// 		}
// 		/* added by trilok end*/
// 		$this->library_url = $this->cdn_url.get_library_path($this->business_id);
                
//                 /* added by amarat start*/
//                 if($this->input->post('is_myDrive') == 1){
//                     $this->business_id = $this->user_id;
//                     $this->video_url = $this->config->item('cdn_url').get_video_path($this->user_id);
//                 }else{
//                     $this->video_url = $this->config->item('cdn_url').get_video_path($this->business_id);
//                 }
//                 /* added by amarat end*/
//                 $this->apps_id = 8;
// 		$this->module_id = 47;
// 		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
	}
	
	/**
	 * index
	 *
	 * Performs "Listing Of All Object for library content".
	 * It's related to all the smart library in saglus smart
	 * default method
	 *
	 * @param			:	string,integer,date
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function index(){    
		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
		
		$draw  =  $this->input->post('draw') ? $this->input->post('draw') : 1;
		$search = $this->input->post('search') ? $this->input->post('search') : '';
		$limit =  $this->input->post('items_per_page') ? $this->input->post('items_per_page') : '*';
		$current_page =  $this->input->post('current_page') ? $this->input->post('current_page') : 1;
		$order_by =  $this->input->post('order_by') ? $this->input->post('order_by') : 'DESC';
		$order_type =  $this->input->post('order_type') ? $this->input->post('order_type') : 'modified_date';
		$type =  $this->input->post('type') ? $this->input->post('type') : '';
		$folder_id =  $this->input->post('folder_id') ? $this->input->post('folder_id') : '';
		$filter =  $this->input->post('filter') ? $this->input->post('filter') : '';
		$recent =  $this->input->post('recent') ? $this->input->post('recent') : '';
		$popup =  $this->input->post('popup') ? $this->input->post('popup') : '0';
		$is_myDrive =  $this->input->post('is_myDrive') ? $this->input->post('is_myDrive') : '';
		$date_range = array();
		if($filter!=''){
			$filter = json_decode($filter,true);
			//print_r($filter);
			foreach($filter as $value){
				if(trim($value['value']) != ''){
					if($value['title']=='uploaded' || $value['title']=='updated'){
						$gate = 'and';
						if($value['gate'] == 'or'){$gate = $value['gate'];}
						$date_range[] = array('title'=>$value['title'],'value'=>$value['value'],'from'=>$value['min'],'to'=>$value['max'],'gate'=>$gate);
					}else{
						$gate = 'and';
						if($value['gate'] == 'or'){$gate = $value['gate'];}
						$date_range[] = array('title'=>$value['title'],'value'=>$value['value'],'from'=>'','to'=>'','gate'=>$gate);
					}
				}
			}
		} 
		$this->load->model('smart/Status_model');
		$file_types = $this->Status_model->get_status('file_type');
		//$file_type= '';
		$file_type= array();
		
                
                if( strpos($type, ',') !== false ) {
                    $post_file_type = explode(",",$type);
                    
                    //echo "<pre>"; print_r($file_types); 
                    //echo "<pre>"; print_r($file_type); die;
                    
                    foreach($file_types as $key => $val){
                        if($val['option_value'] != '5'){
                            //if($val['option_value'] == strtolower($type)){
                            if (in_array($val['option_value'], $post_file_type)){   
                                //$file_type=$val['option_key'];
                                $file_type[$key]=$val['option_key']; 
                                //if($popup == '0'){$folder_id = '';}
                            }
                        }
                        //echo "<pre>"; print_r($file_type); die;
                    }
                    
                    
                }else{
                    foreach($file_types as $key => $val){
                        if($val['option_value'] != '5'){
                            if($val['option_value'] == strtolower($type)){
                                //$file_type=$val['option_key'];
                                $file_type[$key]=$val['option_key']; 
                                //if($popup == '0'){$folder_id = '';}
                            }
                        }
                    }
                }
                //echo "<pre>"; print_r($file_type); die;
		// if($type=='folder'){
			// if(trim($folder_id)==''){$folder_id=0;}
		// }
		//echo $folder_id; die;
		if($type == '' && $folder_id !=''){
			$folder_id = 0;
		}
		if($type == 'folder' && $folder_id ==''){
			$folder_id = 0;
		}
		if($type == 'folder' && $folder_id > 0){
			$file_type= '';
		}

		$data = array(
			'business_id'=>$this->business_id,
			'user_id'=>$this->user_id,
			'search'=>$search,
			'current_page'=>$current_page,
			'limit'=>$limit,
			'order_by'=>$order_by,
			'order_type'=>$order_type,
			'type'=>$type,
			'recent'=>$recent,
			'file_type'=>$file_type,
			'folder_id'=>$folder_id,
			'date_range'=>$date_range,
			'is_myDrive'=>$is_myDrive
		);
		//print_R($data); die;
		if($is_myDrive == 1){
			/* if($this->parent_id){
				$parent_user_id = $this->parent_id;
			}else{
				$parent_user_id = $this->user_id;
			} In all cases current user id will used either ADMIN or Team member*/
			$parent_user_id = $this->user_id;
			$data['business_id'] = $parent_user_id;
			$this->library_url = $this->cdn_url.get_library_path($data['business_id']);
                        
                }else if($is_myDrive == 2){
                    
                    $this->load->helper("sag_common_helper");
                    $bms_business_data = get_single_rows('smart_businesses',array('subdomain' => 'bms'),array('business_id'));
                    $bms_business_id = $bms_business_data['business_id'];
                    
                    //set bms business_id for stock images 
                    $data['business_id'] = $bms_business_id;
                    $this->library_url = $this->cdn_url.get_library_path($data['business_id']);
                    
                }else{
			$this->library_url = $this->cdn_url.get_library_path($this->business_id);
		}
		
		// echo '<pre>';
		// print_r($data); die;
		// get all records and total number of records
		$counts 	= $this->library_model->get_count($data);
		//	print_r($counts);
		$records 	= $this->library_model->get($data);
                //echo $this->db->last_query(); die('8');
		//print_r($records);
		//	echo'asdadasd';
		foreach($records as $key=>$record){
			if($record['file_type'] == 'video'){
				$records[$key]['url'] = base_url().'api/video/players/players_ctrl/cplayer/'.$record['video_id'].'?theme_id=1';
				$records[$key]['file_url'] = $this->video_url.$record['file'].'/'.$record['file'].'.'.$record['file_extension'];
				$records[$key]['download_url'] = $this->library_url.$record['thumbnail'];
			}else{
                                
                                //create stock file url
                                if($record['is_stock'] == '1'){
                                    $records[$key]['url'] = $this->library_url. 'stock/'. $record['file_type'] .'/' .$record['thumbnail'];
                                    $records[$key]['file_url'] = $this->library_url. 'stock/'. $record['file_type'] .'/' .$record['thumbnail'];
                                }else{
                                    $records[$key]['url'] = $this->library_url.$record['thumbnail'];
                                    $records[$key]['file_url'] = $this->library_url.$record['thumbnail'];
                                }
			}
			$records[$key]['file_name'] = $records[$key]['title'].'.'.$records[$key]['file_extension'];
			if($records[$key]['type'] == 'folder'){
				$records[$key]['share_url'] = $this->share_url.'sharefolder/'.$record['slug'];
			}else{
				$records[$key]['share_url'] = $this->share_url.'share/'.$record['slug'];
			}
			
			$records[$key]['thumbnail1']='';
			$records[$key]['thumbnail2']='';
			$records[$key]['folder_name']= '';
			if($records[$key]['type'] == 'file'){
				$records[$key]['folder_name']=$this->library_model->get_folder_title($records[$key]['folder_id']);
			}
			if(in_array($record['file_type'], array('image','video'))){
				if($record['file_type'] == 'video'){
                                    
                                    // set file_image as video thumbnail and change url also
                                    if(empty($records[$key]['file_image'])){    
					$records[$key]['thumbnail1'] = $this->cdn_url.$record['thumbnail'];
					$records[$key]['thumbnail2'] = $this->cdn_url.$record['thumbnail'];
                                    }else if(!empty($records[$key]['file_image'])){
                                        $records[$key]['thumbnail1'] = $this->cdn_url.$record['file_image'];
                                        $records[$key]['thumbnail2'] = $this->cdn_url.$record['file_image'];
                                        $records[$key]['url'] = base_url() . 'video/mydrive/' . $record['video_id'];
                                    }
                                        
				}else{
					$image_detail = explode(".",$record['thumbnail']);
					$records[$key]['thumbnail1'] = $this->get_thumbnail_string($this->library_url.$record['thumbnail'],320);
					
					$records[$key]['thumbnail2'] = $this->get_thumbnail_string($this->library_url.$record['thumbnail'],640);
					$size_array = array('320','640','800','1200','1600'); 
					foreach($size_array as $resulation=>$width){
						if($width < $record['width'] || $width == $record['width']){
							$image_height = round($record['height'] / $record['width'] * $width);
							$records[$key]['resulation'][$width] = array(
								'width'=>$width,
								'height'=>$image_height,
								'url'=>$this->library_url.$image_detail[0].'_'.$width.'.'.$image_detail[1],
							);
						}
					}
					
				}
			}
			$modified_by = $this->Smartlogin_model->get_user_full_name($records[$key]['modified_by']);
			$records[$key]['modified_by'] = trim($modified_by['first_name'].' '.$modified_by['last_name']);
			$created_by = $this->Smartlogin_model->get_user_full_name($records[$key]['created_by']);
			$records[$key]['created_by'] = trim($created_by['first_name'].' '.$created_by['last_name']);
                        
                        if($records[$key]['folder_id'] != '0'){ 
                            $folder_path = '';//$this->create_file_path($records[$key]['object_id'], $records[$key]['folder_name']);
                            //$folder_path = $this->create_file_path('1980');
                            $folder_path .= $records[$key]['file'];

                            $records[$key]['folder_path'] = $folder_path;
                        }else if($records[$key]['folder_id'] == '0'){
                            $records[$key]['folder_path'] = $records[$key]['file'];
                        }
//                        echo "<pre>"; 
//                        print_r($records[$key]['object_id'] . ' = ' . $records[$key]['folder_path']); 
//                        echo "<br>"; 
//                        die;
		}
		$draw++;
                
		$output = array(
					"counts"	=>	$counts,
					"records"		=>	$records,
					"draw"			=>	$draw
				);
    
		//	print_r($records);
		
		$response 	= array('message'=>$output,'callback'=>'','redirect_type'=>'angular','redirect_url'=>'');
	    $response['status'] = 'success';
		echo $this->jsonify($response, 0);
	}
	
        
            
        public function create_file_path($folder_id){ 
		
                $file_path = '';
                $parent_tree = array($folder_id);
                //echo "<pre>"; print_r($parent_tree); die;
                
		$this->db->select('library_folder_id, file_name');
		$this->db->where('library_object_id', $folder_id);
		$query = $this->db->get('smart_library_objects'); 
                
                //echo $this->db->last_query(); die; 
                if ($query->num_rows() == 0) {
                    $parent_tree = array($folder_id);
                }else{
                    $this->db->select('library_folder_id, file_name');
                    $this->db->where('library_object_id', $folder_id);
                    $query = $this->db->get('smart_library_objects');
                    
                    $row =  $query->row_array();
                    $folder_id = $row['library_folder_id'];
                    
                    $parent_tree = $this->append_parent_id($folder_id, $parent_tree = array(), $query->num_rows());
                    
                }
                //sort array
                sort($parent_tree);
//                echo "<pre>"; print_r($parent_tree); 
//                die('==');
                
                foreach($parent_tree as $key => $val){
                    if($val != 0){
                        $this->db->select('file_name');
                        $this->db->where('library_object_id', $val);
                        $query = $this->db->get('smart_library_objects');

                        $row =  $query->row_array();
                        $file_path .= $row['file_name'] . '/';
                    }
                    
                }
                //echo $file_path; die;
                return $file_path;
                
	}    
        
        
        public function append_parent_id($folder_id, $parent_array, $count){
            
                array_push($parent_array, $folder_id);
//                echo  "<pre>"; 
//                print_r($parent_array); 
//                //die;
                
		$this->db->select('library_folder_id, file_name');
                $this->db->where('library_object_id', $folder_id);
                $query = $this->db->get('smart_library_objects');
                
                if ($query->num_rows() == 0) {
                    return $parent_array;
                }
		else{
			$count++;
                        $row =  $query->row_array();
                        $parent_folder_id = $row['library_folder_id'];
                        
                        //echo $file_path = $row['file_name'];
                        if($parent_folder_id != '0'){
                            //array_push($parent_array, $folder_id);
                            return $this->append_parent_id($parent_folder_id, $parent_array, $count++);
                        }else{
                            return $parent_array;
                        }
                        
			
		}
	}
        
        
        
	public function get_thumbnail_string($file,$size=320){
		$file= explode('.',$file);
		$file[count($file)-2] .= '_'.$size;
		return implode('.',$file);
	}
	/**
	 * get_smart_video
	 *
	 * Performs "Listing Of All Object for library content".
	 * It's related to all the smart library in saglus smart
	 * default method
	 *
	 * @param			:	string,integer,date
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_smart_video(){
		$draw  =  $this->input->post('draw') ? $this->input->post('draw') : 1;
		$search = $this->input->post('search') ? $this->input->post('search') : '';
		$limit =  $this->input->post('items_per_page') ? $this->input->post('items_per_page') : '0';
		$current_page =  $this->input->post('current_page') ? $this->input->post('current_page') : 1;
		$order_by =  $this->input->post('order_by') ? $this->input->post('order_by') : 'ASC';
		$order_type =  $this->input->post('order_type') ? $this->input->post('order_type') : 'file_name';
		$project_id =  $this->input->post('project_id')!='' ? $this->input->post('project_id') : '';
		$recent =  $this->input->post('recent') ? $this->input->post('recent') : '';
		$this->load->model('smart/Status_model');
		$data = array(
			'business_id'=>$this->business_id,
			'search'=>$search,
			'current_page'=>$current_page,
			'limit'=>$limit,
			'order_by'=>$order_by,
			'order_type'=>$order_type,
			'recent'=>$recent,
			'project_id'=>$project_id
		);
		// get all records and total number of records
		$counts 	= $this->library_model->get_videos_count($data);
		//	print_r($counts);
		$records 	= $this->library_model->get_videos($data);
		//print_r($records);
		//	echo'asdadasd';
		foreach($records as $key=>$record){
		   $records[$key]['thumbnail1'] = $this->cdn_url.$record['thumbnail'];
			$records[$key]['url'] = base_url().'api/video/players/players_ctrl/embed/'.$record['video_id'];
			$records[$key]['file_url'] = $this->video_url.$record['slug_folder'].'/'.$record['slug_folder'].'.'.$record['video_extention'];
			$created_by = $this->Smartlogin_model->get_user_full_name($records[$key]['created_by']);
			$records[$key]['created_by'] = trim($created_by['first_name'].' '.$created_by['last_name']);
		}
		$draw++;
		$output = array(
					"counts"	=>	$counts,
					"records"		=>	$records,
					"draw"			=>	$draw
				);
    
	//	print_r($records);
		$response 	= array('message'=>$output,'callback'=>'','redirect_type'=>'angular','redirect_url'=>'');
	    $response['status'] = 'success';
		echo $this->jsonify($response);
	}
	/**
	 * add_folder
	 *
	 * Performs "add new folder into the library".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function add_folder(){
// 		check_privilege('mydrive', 'folder_add');
		$count_folder = $this->library_model->count_available_folders($this->business_id);
// 		check_package_limit('folder', $count_folder); 
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_002'),"Folder"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
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
				'created_by'	=>	$this->user_id,
				'created_date'	=>	time(), 
				'modified_date'	=>	time(),
				'modified_by'	=>	$this->user_id,
			);
			$chk_condition = array(
				'file_name'			=>	$this->input->post('title'),
				'business_id'	=>	$this->business_id
			);
			if($this->input->post('is_myDrive') == 1){
					$data['business_id'] = $this->user_id;
					$chk_condition['business_id'] = $this->user_id;
			}
// 			pr($data);
// 			die;
			$exist  = $this->library_model->check_folder_exist($chk_condition);
			if(!$exist){
				
				$output = $this->library_model->add_folder($data);
				// print_R($output); die;
				if($output['success']== 1){
					$data = array('library_object_id'=>$output['id'],'library_folder_id'=>$output['id']);
				// 	$res = $this->create_share_link($data);
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_002'),"Folder");
					$response['insert_id'] 	= $output['id'];
					
				// 	$get_data = $this->library_model->get_folder($output['id']);
					//  set session activity 
				// 	$message = $this->lang->line('msg_activity_013');
				// 	$user_url = '<b>'.$this->user_firstname.'</b>';
				// 	$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
				// 	$message = get_activity_message($message,[$user_url,'Folder',$page_name]);
				// 	// function for insert user activity
				// 	$this->user_activity($message,'folder',$this->module_id,$this->apps_id); 
					

				}
			}else{
				$response['message'] 	= replaceSingleTag($this->lang->line('msg_err_005'),"Folder");
			}
		}else{
			$error['title'] 	 = form_error('title');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * rename_folder
	 *
	 * Performs "rename exist folder into the library".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string,integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function rename_folder(){
		check_privilege('mydrive', 'folder_edit');
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_001'),"Folder"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
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
			if(!$exist){
				$output = $this->library_model->update_folder($condition, $data);
				//echo $this->db->last_query(); die;
				if($output){
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_001'),"Folder");
					
					$get_data = $this->library_model->get_folder($this->input->post('id'));
					//  set session activity 
					$message = $this->lang->line('msg_activity_002');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['title'].'"</span>';
					$message = get_activity_message($message,[$user_url,'Folder',$page_name]);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					
				}
			}else{	
				$response['message'] 	= replaceSingleTag($this->lang->line('msg_err_005'),"Folder");
			}
		}else{
			$response['status']  = 'error';
			$error['title'] 	 = form_error('title');
			$error['id'] 	 = form_error('id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * get_all_folders
	 *
	 * Performs "get list of all folders from database".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string,integer,date
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_all_folders(){
		$response = array('status'=>'success','message'=>'','callback' => '','redirect_type'=>'angular','redirect_url'=>'');
		
		
		$data = array(
			'business_id'=>$this->business_id,
			'status'=>1
		);
		if($this->input->post('is_myDrive') == 1){
			$data['business_id'] = $this->user_id;
		}
		$folders  = $this->library_model->get_all_folders($data);
		$output = array(
					"total_record"	=>	count($folders),
					"records"		=>	$folders,
					"draw"			=>	1,
				);
		$response['message'] = $output;
		echo $this->jsonify($response);
	}
        
        
        public function count_available_files(){
            $mydrive_files = $this->library_model->count_available_files($this->business_id);   
            $response['mydrive_files'] = $mydrive_files;
            echo $this->jsonify($response);
        }
        
	/**
	 * upload_object
	 *
	 * Performs "upload object into the AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string,integer,file
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function upload_object(){
		if(!check_privilege('other_features', 'common_upload',TRUE)){
			if(!check_privilege('mydrive', 'file_upload',TRUE)){
				$response['status'] = 'privilege_denied';
				$response['message'] = 'Privilege Denied';
				header('Content-Type: application/json');
				echo json_encode($response); die();
			}
		}
		
		//added by trilok if business id already sent from client id
		if($this->input->post('business_id')){
			$this->business_id = $this->input->post('business_id');
			$this->user_id = 0;
			
		}
		//added by trilok end
		
		$callback =  $this->input->post('callback')!='' ? $this->input->post('callback') : '';
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_008'),"File"),'callback' => $callback,'redirect_type'=>'angular','redirect_url'=>'');
		$folder_id =  $this->input->post('folder_id')!='' ? $this->input->post('folder_id') : '0';
		$chunk =  $this->input->post('chunk') ? $this->input->post('chunk') : 0;
		$type = $this->input->post('type') ? $this->input->post('type') : '';
		$is_myDrive = $this->input->post('is_myDrive') ? $this->input->post('is_myDrive') : '0';
		$encrpyt = $this->input->post('encrpyt') ? $this->input->post('encrpyt') : '0';
		
		$uploaded_file = $_FILES['file'];
		$upload_filename = $uploaded_file['name'];
		$upload_filename = explode('.',$upload_filename);
		$file_size = $uploaded_file['size'];
		unset($upload_filename[count($upload_filename)-1]);
		$upload_filename = implode('.',$upload_filename);
		if(isset($_FILES['file'])){
			$status = 1;
			if(isset($_POST['status'])){
				if($_POST['status'] == '0'){$status = '0';}
			}
			$config['upload_path']   = './uploads/temp/'; 
			$availbale_ext = array(
				'image'=>array('jpg','jpeg','png','gif','svg'),
				'video'=>array('mkv','mp4','mov','wmv','webm'),
				'audio'=>array('mp3'),
				'document'=>array('doc','docx','xls','xlsx','ppt','pptx','pdf','txt'),
				'other'=>array('zip','rar','7zip','psd','ai','afdesign','aiff')
			);
			
			
			//$config['max_size']  = 7*1024*1024*1024;
			
			$file_string = explode('.',$uploaded_file['name']);
			$file_ext = strtolower($file_string[COUNT($file_string)-1]);
			if($chunk){
				$new_filename = $this->input->post('_chunkNumber').'_chunk_part_'.$this->input->post('indentity').'.tmp';				
			}else{
				$new_filename = time().random_string('alnum',10).'.'.$file_ext;
			}
			
			$valid_ext = true;
			
			if($type == 'image'){
				if(!in_array($file_ext, $availbale_ext['image'])){
					$valid_ext = false;
				}
			}
			else if($type == 'video'){
				if(!in_array($file_ext, $availbale_ext['video'])){
					$valid_ext = false;
				}
			}
			else if($type == 'audio'){
				if(!in_array($file_ext, $availbale_ext['audio'])){
					$valid_ext = false;
				}
			}
			else if($type == 'documnet'){
				if(!in_array($file_ext, $availbale_ext['documnet'])){
					$valid_ext = false;
				}
			}
			else if($type == 'other'){
				if(!in_array($file_ext, $availbale_ext['other'])){
					$valid_ext = false;
				}
			}
			else{
				if(!in_array($file_ext, $availbale_ext['image']) && !in_array($file_ext, $availbale_ext['video']) && !in_array($file_ext, $availbale_ext['audio']) && !in_array($file_ext, $availbale_ext['document']) && !in_array($file_ext, $availbale_ext['other'])){
					$valid_ext = false;
					}
			}
			
			
			if(!$valid_ext){
				$config['allowed_types'] = false;
			}else{
				$config['allowed_types'] = '*';
			}
			
			$config['file_name'] = $new_filename;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file')){
				$data = $this->upload->data();
				if($chunk){
					$current_chunk_number = $this->input->post('_chunkNumber');
					$chunk_size = $this->input->post('_chunkSize');
					$total_size = $this->input->post('_totalSize');
					$chunk_number = $this->input->post('_chunkNumber');
					$total_chunk_number = ceil($total_size / $chunk_size);
					$upload_folder = str_replace('\\','/',FCPATH).'uploads/temp/';
					
					$new_generate_filename = $this->input->post('indentity').'.'.$file_ext;
					$content = file_get_contents($upload_folder .$chunk_number.'_chunk_part_'.$this->input->post('indentity').'.tmp');
					if($encrpyt){
						$content = cryptoJsAesDecrypt($content);
					}
					file_put_contents('./uploads/temp/'.$new_generate_filename , $content, FILE_APPEND);
					unlink('./uploads/temp/' .$chunk_number.'_chunk_part_'.$this->input->post('indentity').'.tmp');
					if ($current_chunk_number == ($total_chunk_number - 1)) {
						$data = array();
						$data['raw_name'] = $this->input->post('indentity');
						$data['orig_name'] = $new_generate_filename;
						$data['file_name'] = $new_generate_filename;
						$data['file_path'] = str_replace('\\','/',FCPATH).'uploads/temp/';
						$data['full_path'] = $data['file_path'].$new_generate_filename;
						$data['file_type'] =  $uploaded_file['type'];
						$data['file_ext'] = '.'.$file_ext;
						$data['is_image'] = '0';
						if(in_array($file_ext, $availbale_ext['image'])){
							$data['is_image'] = '1';
						}
						$file_size = $total_size ;
					}else{
						die;
					}
				}
				else{
					if($encrpyt){
						$content = file_get_contents($data['full_path']);
						$content = cryptoJsAesDecrypt($content);
						file_put_contents($data['full_path'] , $content);
					}
				}
				
				$width = '0';
				$height = '0';
				if($data['is_image'] == '1'){
					$image_data = getimagesize($data['full_path']);
					$width = $image_data[0];
					$height = $image_data[1];
				}
				$file_ext_data = $this->get_file_type_status($data); 
				$file_extention = $file_ext;
				$file_ext = $file_ext_data['type'];
				$file_ext_status = $file_ext_data['status'];
				$upload_file_ext = strtolower(str_replace('.','',$data['file_ext']));
				if($file_ext_status == '3'){
					//$upload_file_ext = 'pdf';
				}
				$upload_filename_new = $this->library_model->object_title_generator($upload_filename,$folder_id,$this->business_id);
				$insert = array(
								'business_id'=>$this->business_id,
								'library_folder_id'=>$folder_id,
								'file'=>$data['file_name'],
								'file_name'=>$upload_filename_new,
								'file_alt_name'=>$upload_filename,
								'file_type'=>$file_ext_status,
								'file_extension'=>$upload_file_ext,
								'duration'=>0,
								'pages'=>0,
								'size'=>$file_size,
								'width'=>$width,
								'height'=>$height,
								'status'=>$status,
								'privacy_status'=>1,
								'password'=>'',
								'created_by'=>$this->user_id,
								'created_date'=>time(),
								'modified_by'=>$this->user_id,
								'modified_date'=>0
							);
				if($is_myDrive == 1){
					$insert['status'] = 1; 
					$insert['business_id'] = $this->user_id;
					$this->business_id = $this->user_id;
				}
				//print_R($insert); die;
				$s3_upload_file_array = array();
				$source_path = $data['full_path'];
				$target_path = './uploads/temp/';
				if($file_ext == 'image'){
					$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
					$size_array = array('320','640','800','1200','1600'); 
					foreach($size_array as $key=>$val){
						if($val < $width || $val == $width){
							$image_sizes[$val] = round($height / $width * $val);
						}
					}
					// $image_sizes = array();
					$this->load->library('image_lib');
					foreach ($image_sizes as $width=>$height) {
						$config = array(
							'source_image' => $source_path,
							'new_image' => $target_path,
							'maintain_ration' => true,
							'create_thumb' => TRUE,
							'thumb_marker' => '_thumb'.$width,
							'width' => $width,
							'height' => $height
						);
						$this->image_lib->initialize($config);
						if($this->image_lib->resize()){
							$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
							// $s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$width.'X'.$height.'/'.$data['orig_name']);
							$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$data['raw_name'].'_'.$width.$data['file_ext']);
						}
			
						$this->image_lib->clear();
					}
				
				}
				else if($file_ext == 'video'){
					// $this->load->helper('smart/ffmpeg_helper');
					// $s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
					// $video_details = get_video_details($source_path);
					// $insert['duration'] = $video_details['duration'];
					// $insert['width'] = $video_details['width'];
					// $insert['height'] = $video_details['height'];
					// $video_sizes = array('205'=>'140','565'=>'377');
					// foreach ($video_sizes as $width=>$height) {
						// $thumbnail_path = $data['file_path'].$data['raw_name'].'_thumb'.$width.'.png';
						// $res = create_video_thumbnail($source_path,$thumbnail_path,$width.'X'.$height,1);
						// if($res){
							// $s3_upload_file_array[] = array('source'=>$thumbnail_path,'destination'=>get_library_path($this->business_id).$width.'X'.$height.'/'.$data['raw_name'].'.png');
						// }
					// }
					// print_r($s3_upload_file_array); die;
				}
				else if($file_ext == 'document'){
					
					if($file_extention != 'pdf'){
                   	 	$res = true;//convert_to_pdf($source_path,$data['file_path']);
               		 }else{
                 		 $res = true; 
               		 }
					if($res){
						//$source = $data['file_path'].$data['raw_name'].'.pdf';
						$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['raw_name'].$data['file_ext']);
					}
					$pages = 0;
				if(file_exists($source_path)) {
                        $pdftext = file_get_contents($source_path);
						$pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
					}
                
					$insert['pages'] = $pages;
					//$insert['file'] = $data['raw_name'].'.pdf';
					//$insert['file_extension'] = 'pdf';
				}
				else{
					if($file_ext == 'audio'){
						$this->load->helper('smart/ffmpeg_helper');
						$audio_details = get_video_details($source_path);
						$insert['duration'] = $audio_details['duration'];
					}
					$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
				}
				$complete_flag = true;
				foreach($s3_upload_file_array as $file){
					$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
					if(!$res){ $complete_flag = false; }
				}
				if($complete_flag){
					$output = $this->library_model->add_object($insert);
					if($output['success']== 1){
						if($file_ext == 'video'){
							$remote_url = base_url().'api/video/processor/videolibtoapp';
							$postdata['library_id'] = $output['id'];
							$postdata['business_id'] = $this->business_id;
							$postdata['user_id'] = $this->user_id;
							$postdata['video_url'] = $source_path;
							$postdata['video_title'] = $upload_filename_new;
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $remote_url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
							$video_responce =  curl_exec($ch);
							$video_responce = json_decode($video_responce,true);
							$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
							
							$thumbnail = $this->getdata_model->field('video_videos','thumbnail',array('video_id'=> $video_responce['video_id']));
							$this->db->set('file_image',$thumbnail);
							$this->db->where('library_object_id',$output['id']);
							$this->db->update('smart_library_objects');
						}
						
						/* Start count storage */
							/*if($this->parent_id){
								$parent_user_id = $this->parent_id;
							}else{
								$parent_user_id = $this->user_id;
							}*/
							$parent_user_id = $this->user_id;
							if($file_ext == 'video'){
								$file_path = $this->get_video_url($video_responce['video_id'],false);
							}else{
								$file_path = get_library_path($this->business_id).$insert['file'];
							}
							$insert_storage = array(
								'business_id'=>$this->business_id,
								'user_id'=>$parent_user_id,
								'file_path'=>$file_path,
								'size'=>$insert['size'],
								'created_date'=>time()
							);
							$this->storage_model->insert($insert_storage);
						/* End count storage */
				
						$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>$insert['library_folder_id']);
						$this->create_share_link($insert);
						$response['status'] 	= 'success';
						$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_009'),"File");
						$response['insert_id'] 	= $output['id'];
						$response['file'] 	= $data['file_name'];
					}
				}
			}
			else{
				//print_R($this->upload->display_errors());
				$response['message'] =  strip_tags($this->upload->display_errors());// replaceSingleTag($this->lang->line('msg_err_008'),"File");
			}
		}else{
			$error['file'] 	= 'File Required!';
			$response['message'] = $error;
		}
		
		echo $this->jsonify($response);
	}
	
	public function get_object_type($object_type){
		$this->load->model('smart/Status_model');
		$response = $this->Status_model->get_title('file_type',$object_type);
		return $response['title'];
	}
	
	public function upload_object_backup(){
		
		$callback =  $this->input->post('callback')!='' ? $this->input->post('callback') : '';
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_004'),"File"),'callback' => $callback,'redirect_type'=>'angular','redirect_url'=>'');
		$folder_id =  $this->input->post('folder_id')!='' ? $this->input->post('folder_id') : '0';
		$type = $this->input->post('type') ? $this->input->post('type') : '';
		$uploaded_file = $_FILES['file'];
		$upload_filename = $uploaded_file['name'];
		$upload_filename = explode('.',$upload_filename);
		unset($upload_filename[count($upload_filename)-1]);
		$upload_filename = implode('.',$upload_filename);
		if(isset($_FILES['file'])){
			$status = 1;
			if(isset($_POST['status'])){
				if($_POST['status'] == '0'){$status = '0';}
			}
			$config['upload_path']   = './uploads/temp/'; 
			$availbale_ext = array(
				'image'=>'jpg|jpeg|png|gif',
				'video'=>'mkv|mp4|wmv|webm',
				'audio'=>'mp3',
				'document'=>'doc|docx|xls|xlsx||ppt|pptx|pdf',
				'other'=>'txt|zip|rar|7zip|afdesign|aiff'
			);
			if($type == 'image'){
				$config['allowed_types'] = $availbale_ext['image'];
			}
			else if($type == 'video'){
				$config['allowed_types'] = $availbale_ext['video'];
			}
			else if($type == 'audio'){
				$config['allowed_types'] = $availbale_ext['audio'];
			}
			else if($type == 'documnet'){
				$config['allowed_types'] = $availbale_ext['documnet'];
			}
			else if($type == 'other'){
				$config['allowed_types'] = $availbale_ext['other'];
			}
			else{
				$config['allowed_types'] = $availbale_ext['image'].'|'.$availbale_ext['video'].'|'.$availbale_ext['audio'].'|'.$availbale_ext['document'].'|'.$availbale_ext['other'];
			}
			
			$new_filename = time().str_replace(' ','-',$uploaded_file['name']);
			$config['file_name'] = $new_filename;
			$this->load->library('upload', $config);
			$folder_id = $this->input->post('folder_id');
			
			if($this->upload->do_upload('file')){
				$data = $this->upload->data();
				$width = '0';
				$height = '0';
				if($data['is_image'] == '1'){
					$width = $data['image_width'];
					$height = $data['image_height'];
				}
				$file_ext_data = $this->get_file_type_status($data); 
				$file_ext = $file_ext_data['type'];
				$file_ext_status = $file_ext_data['status'];
				$upload_file_ext = strtolower(str_replace('.','',$data['file_ext']));
				if($file_ext_status == '3'){
					$upload_file_ext = 'pdf';
				}
				$upload_filename_new = $this->library_model->object_title_generator($upload_filename,$folder_id,$this->business_id);
				$insert = array(
								'business_id'=>$this->business_id,
								'library_folder_id'=>$folder_id,
								'file'=>$data['file_name'],
								'file_name'=>$upload_filename_new,
								'file_alt_name'=>$upload_filename,
								'file_type'=>$file_ext_status,
								'file_extension'=>$upload_file_ext,
								'duration'=>0,
								'size'=>$uploaded_file['size'],
								'width'=>$width,
								'height'=>$height,
								'status'=>$status,
								'privacy_status'=>1,
								'password'=>'',
								'created_by'=>$this->user_id,
								'created_date'=>time(),
								'modified_by'=>$this->user_id,
								'modified_date'=>time()
							);
				$s3_upload_file_array = array();
				$source_path = $data['full_path'];
				$target_path = './uploads/temp/';
				if($file_ext == 'image'){
					$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
					$image_sizes = array('205'=>'140','565'=>'377');
					$this->load->library('image_lib');
					foreach ($image_sizes as $width=>$height) {
						$config = array(
							'source_image' => $source_path,
							'new_image' => $target_path,
							'maintain_ration' => true,
							'create_thumb' => TRUE,
							'thumb_marker' => '_thumb'.$width,
							'width' => $width,
							'height' => $height
						);
						$this->image_lib->initialize($config);
						if($this->image_lib->resize()){
							$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
							$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$width.'X'.$height.'/'.$data['orig_name']);
						}
						$this->image_lib->clear();
					}
				}
				else if($file_ext == 'video'){
					$this->load->helper('smart/ffmpeg_helper');
					$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
					$video_details = get_video_details($source_path);
					$insert['duration'] = $video_details['duration'];
					$insert['width'] = $video_details['width'];
					$insert['height'] = $video_details['height'];
					$video_sizes = array('205'=>'140','565'=>'377');
					foreach ($video_sizes as $width=>$height) {
						$thumbnail_path = $data['file_path'].$data['raw_name'].'_thumb'.$width.'.png';
						$res = create_video_thumbnail($source_path,$thumbnail_path,$width.'X'.$height,1);
						if($res){
							$s3_upload_file_array[] = array('source'=>$thumbnail_path,'destination'=>get_library_path($this->business_id).$width.'X'.$height.'/'.$data['raw_name'].'.png');
						}
					}
				}
				else if($file_ext == 'document'){
					$data['file_path'] = str_replace('\\','/',FCPATH).'uploads/temp/';
					$res = convert_to_pdf($source_path,$data['file_path']);
					if($res){
						$source = $data['file_path'].$data['raw_name'].'.pdf';
						$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$data['raw_name'].'.pdf');
					}
					$insert['file'] = $data['raw_name'].'.pdf';
					$insert['file_extension'] = 'pdf';
				}
				else{
					$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>get_library_path($this->business_id).$data['orig_name']);
				}
				$complete_flag = true;
				foreach($s3_upload_file_array as $file){
					$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
					if(!$res){ $complete_flag = false; }
				}
				if($complete_flag){
					$output = $this->library_model->add_object($insert);
					if($output['success']== 1){
						$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>$insert['library_folder_id']);
						$this->create_share_link($insert);
						$response['status'] 	= 'success';
						$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_009'),"File");
						$response['insert_id'] 	= $output['id'];
						$response['file'] 	= $data['file_name'];
					}
				}
			}
			else{
				$response['message'] =  strip_tags($this->upload->display_errors());// replaceSingleTag($this->lang->line('msg_err_008'),"File");
			}
		}else{
			$error['file'] 	= 'File Required !';
			$response['message'] = $error;
		}
		
		echo $this->jsonify($response);
	}
	/**
	 * convert_to_pdf
	 *
	 * Performs "convert document to pdf".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string,integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	17-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function convert_to_pdf($source,$destination){
            $remote_url = config_item('processing_server_url').'api/bms/documentprocess';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $remote_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "source=".$source."&destination=".$destination);
			curl_exec($ch);
			return 1;
			}
	/**
	 * rename_object
	 *
	 * Performs "rename object into the AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	string,integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	17-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function rename_object(){
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_001'),"Filet"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('id','File Id','trim|required');
		if($this->form_validation->run()){
			$object = $this->library_model->get_object($this->input->post('id'));
			$folder_id =$object['data']['library_folder_id'];
			$data = array(
				'file_name'		=>	$this->input->post('title'),
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
				'library_folder_id ' =>	$folder_id,
				'business_id'	=>	$this->business_id
			);
			$exist  = $this->library_model->check_object_exist($chk_condition);
			if(!$exist){
				$output = $this->library_model->update_object($condition, $data);
				if($output){
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_001'),"File");
					
					$get_data = $this->library_model->get_object($this->input->post('id'));
					//  set session activity 
					$message = $this->lang->line('msg_activity_002');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,$this->get_object_type($get_data['data']['file_type']),$page_name]);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
				}
			}else{	
				$response['message'] 	= replaceSingleTag($this->lang->line('msg_err_005'),"File");
			}
		}else{
			$response['status']  = 'error';
			$error['title'] 	 = form_error('title');
			$error['id'] 	 = form_error('id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * get_file_type_status
	 *
	 * Performs "get the object type status for categories".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	associate array 
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	19-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_file_type_status($data){
		$availbale_ext = array(
				'image'=>array('jpg','jpeg','png','gif','svg'),
				'video'=>array('mkv','mp4','webm','mov','wmv'),
				'audio'=>array('mp3'),
				'document'=>array('doc','docx','xls','xlsx','ppt','pptx','pdf','txt'),
				'other'=>array('zip','rar','7zip','psd','afdesign','aiff')
			);
		$file_ext = str_replace('.','',$data['file_ext']);
		$file_type = 'other';
		if(in_array($file_ext, $availbale_ext['image'])){
			$file_type = 'image';
		}
		if(in_array($file_ext, $availbale_ext['video'])){
			$file_type = 'video';
		}
		if(in_array($file_ext, $availbale_ext['audio'])){
			$file_type = 'audio';
		}
		if(in_array($file_ext, $availbale_ext['document'])){
			$file_type = 'document';
		}
		
		if($file_type == 'image'){$file_type_status =1;}
		else if($file_type == 'video'){$file_type_status =2;}
		else if($file_type == 'document' || $file_type == 'pdf'){$file_type_status =3;}
		else if($file_type == 'audio'){$file_type_status =4;}
		else{$file_type_status = 0;}
		return array('type'=>$file_type,'status'=>$file_type_status);
	}
	/**
	 * move_object
	 *
	 * Performs "move object from folder to folder in AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	20-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function move_object(){
	check_permission('mydrive', 'file_move', 'mydrive.others.folder_management');
		if($this->input->post('is_myDrive') == 1){
				$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('transfer_folder_id','Folder','trim|required');
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
			
			$object_id = $this->get_object_id();
		}
		
		if($this->input->post('object_type') == 'folder'){
			$object_data = $this->library_model->get_object_id_by_folder($this->input->post('object_id'));
			//print_R($object_data); die;
			foreach($object_data as $val){
				$object_id[] = $val['id'];
			}
		}else{
			$object_id_post = explode(',',$this->input->post('object_id'));
			$object_id = array_merge($object_id,$object_id_post);
			$object_id = array_unique($object_id);		
		}
		
		if($this->form_validation->run()){
			$folder_id = $this->input->post('transfer_folder_id');
			$condition = array('business_id'=>$this->business_id,'library_object_id'=>$folder_id);
			if($this->library_model->chk_folder_exist($condition) || $folder_id=='0'){
				$responce_flag = $this->library_model->move_object($folder_id, $this->business_id ,$object_id);
				if($responce_flag){
				$folder_name = $this->library_model->get_folder($folder_id);
				if(sizeof($object_id)==1){
					$get_data = $this->library_model->get_object($object_id[0]);
					//  set session activity 
					$message = $this->lang->line('msg_activity_018');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,'File',$page_name,'<span class="w600 p-blue-clr">'.$folder_name['data']['title'].'</span>']);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"File");
				}else{
					//  set session activity 
					$message = $this->lang->line('msg_activity_016');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = sizeof($object_id);
					$message = get_activity_message($message,[$user_url,$page_name,'Files']);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id);
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"Files");
				}
				
					$response['status'] = 'success';
					
				}
			}
			else{
				$response['message'] = replaceSingleTag($this->lang->line('msg_err_006'),"Folder");
			}
				
		}else{
			
			$error['transfer_folder_id'] 	 = form_error('transfer_folder_id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
        
        
        /**
	 * move_object
	 *
	 * Performs "move object from persnal my drive to business drive in AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2020		
	 * @modified_date 	:	26-05-2020
	 * @modified_by 	:	Amarat
	 */
	public function move_object_to_business_old(){
		if($this->input->post('is_myDrive') == 1){
                        $this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		//$this->form_validation->set_rules('transfer_folder_id','Folder','trim|required');
		$this->form_validation->set_rules('transfer_business_id','Business','trim|required');
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
                    $object_id = $this->get_object_id();
		}
		
		if($this->input->post('object_type') == 'folder'){
			$object_data = $this->library_model->get_object_id_by_folder($this->input->post('object_id'));
			//print_R($object_data); die;
			foreach($object_data as $val){
				$object_id[] = $val['id'];
			}
		}else{
			$object_id_post = explode(',',$this->input->post('object_id'));
			$object_id = array_merge($object_id,$object_id_post);
			$object_id = array_unique($object_id);		
		}
		
		if($this->form_validation->run()){
			//$folder_id = $this->input->post('transfer_business_id');
			$transfer_business_id = $this->input->post('transfer_business_id');
			//$condition = array('business_id'=>$this->business_id,'library_object_id'=>$transfer_business_id);
			$condition = array('business_id'=>$transfer_business_id);
                        
			if($this->library_model->chk_business_exist($condition) || $transfer_business_id=='0'){
				$responce_flag = $this->library_model->move_object_to_business($transfer_business_id, $this->business_id ,$object_id);
				if($responce_flag){ 
				//$folder_name = $this->library_model->get_folder($folder_id);
                                    
                                $resp = get_single_rows($this->tbl_smart_businesses,$condition, array('title'));    
                                $business_name = $resp['title'];
                                
				if(sizeof($object_id)==1){
					$get_data = $this->library_model->get_object($object_id[0]);
					//  set session activity 
					$message = $this->lang->line('msg_activity_044');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,'File',$page_name,'<span class="w600 p-blue-clr">'.$business_name.'</span>']);
                                        // function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"File");
				}else{
					//  set session activity 
					$message = $this->lang->line('msg_activity_044');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = sizeof($object_id);
					$message = get_activity_message($message,[$user_url,'Files',$page_name,'<span class="w600 p-blue-clr">'.$business_name.'</span>']);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id);
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"Files");
				}
					$response['status'] = 'success';
					
				}
			}
			else{
				$response['message'] = replaceSingleTag($this->lang->line('msg_err_006'),"Business");
			}
				
		}else{
			
			$error['transfer_business_id'] 	 = form_error('transfer_business_id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
        
        
        
        public function move_object_to_business(){
	
		if($this->input->post('is_myDrive') == 1){
				$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0014'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'','failed_message'=>'');
		$this->form_validation->set_rules('transfer_business_id','Business','trim|required');
		$this->form_validation->set_error_delimiters('', '');
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
			$object_id = $this->get_object_id();
			
		}
		
		
		if($this->input->post('object_type') == 'folder'){
			$object_data = $this->library_model->get_object_id_by_folder($this->input->post('object_id'));
			//print_R($object_data); die;
			foreach($object_data as $val){
				$object_id[] = $val['id'];
			}
		}else{
			$object_id_post = explode(',',$this->input->post('object_id'));
			$object_id = array_merge($object_id,$object_id_post);
			$object_id = array_unique($object_id);		
		}
		
		if($this->form_validation->run()){
			
			//$folder_id = $this->input->post('transfer_folder_id');
			$transfer_business_id = $this->input->post('transfer_business_id');
			//$condition = array('business_id'=>$this->business_id,'library_object_id'=>$folder_id);
                        $condition = array('business_id'=>$transfer_business_id);
			
			$failed_count = 0;
			if($this->library_model->chk_business_exist($condition) || $transfer_business_id=='0'){
				
				foreach($object_id as $id){
					$res = $this->library_model->get_object($id);
					if($res['success']){
						
						$is_upload = true;
						if($res['data']['file_type'] != '2'){
							$source_file = get_library_path($this->business_id).$res['data']['file'];
                                                        
							$tmp_array = explode('.',$res['data']['file']);
							$tmp_ext = $tmp_array[count($tmp_array)-1];
							array_pop($tmp_array);
							$tmp_filename = implode('.',$tmp_array);
							$new_filename = time().random_string('alnum',10);
							$new_file_fullname = $new_filename.'.'.$tmp_ext;
							//$destination_file = get_library_path($this->business_id).$new_file_fullname;
							$destination_file = get_library_path($transfer_business_id).$new_file_fullname;
                                                        
							$is_upload = copy_file($source_file, $destination_file,$this->storage_server);
                                                        
                                                        //echo "<pre>"; print_r($is_upload); die;
							if($res['data']['file_type'] == 1){
								//$exist_sizes = array('205'=>'140','565'=>'377');
								$exist_sizes = array();
								foreach ($exist_sizes as $width=>$height) {
									if($res['data']['file_type'] == 1){
										$source_filename = $res['data']['file'];
										$destination_filename = $new_file_fullname;
									}else{
										$source_filename = $tmp_filename.'.png';
										$destination_filename = $new_filename.'.png';
									}
									$source_file = get_library_path($this->business_id).$width.'X'.$height.'/'.$source_filename;
									//$destination_file = get_library_path($this->business_id).$width.'X'.$height.'/'.$destination_filename;
									$destination_file = get_library_path($transfer_business_id).$width.'X'.$height.'/'.$destination_filename;
									copy_file($source_file, $destination_file,$this->storage_server);
								}
							}
						}
						
						if($res['data']['file_type'] == '2'){ 
							if(!$this->is_video_processed($res['data']['video_id'])){ 
								$failed_count++;
								$is_upload = false;
								$response['failed_message'] =replaceSingleTag($this->lang->line('msg_err_004'),$failed_count." File Move");
							}
						}
						
						if($is_upload){
							$insert = $res['data'];
                                                        //chnage business_id
                                                        $insert['business_id'] = $transfer_business_id;
                                                        unset($insert['link_id']);
							unset($insert['meta_title']);
							unset($insert['meta_description']);
							unset($insert['meta_keyword']);
							unset($insert['no_index']);
							unset($insert['no_follow']);
							unset($insert['library_object_id']);
							unset($insert['slug']);
							unset($insert['expired_from']);
							unset($insert['expired_to']);
                                                        
							$insert['file_name'] =  $this->library_model->object_title_generator($insert['file_name'],$folder_id=0,$transfer_business_id);
							
                                                        //$insert['library_folder_id'] = $folder_id;
							$insert['library_folder_id'] = '0';
							$insert['created_by'] =  $this->user_id;
							$insert['created_date'] = time();
							$insert['modified_by'] = $this->user_id;
							$insert['modified_date'] = time();
							$insert['file'] = $new_file_fullname;
							unset($insert['first_name']);
							unset($insert['last_name']);
							unset($insert['total_share']);
							$output = $this->library_model->add_object($insert);
							if($output['success']== 1){
								if($res['data']['file_type'] == '2'){
									$remote_url = base_url().'api/video/processor/videolibtoapp';
									$postdata['library_id'] = $output['id'];
									$postdata['business_id'] = $this->business_id;
									//$postdata['business_id'] = $transfer_business_id; 
									$postdata['user_id'] = $this->user_id;
									$postdata['video_url'] = $this->get_video_url($insert['video_id']);
									$postdata['video_title'] = $insert['file_name'];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, $remote_url);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
									$video_responce =  curl_exec($ch);
									$video_responce = json_decode($video_responce,true);
									
									$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
								}
								
								/* Start count storage */
									/*if($this->parent_id){
										$parent_user_id = $this->parent_id;
									}else{
										$parent_user_id = $this->user_id;
									} */
									$parent_user_id = $this->user_id;
									if($res['data']['file_type'] == '2'){
										$file_path = $this->get_video_url($video_responce['video_id'],false);
									}else{
										$file_path = get_library_path($this->business_id).$insert['file'];
									}
									
									$insert_storage = array(
										//'business_id'=>$this->business_id,
										'business_id'=>$transfer_business_id,
										'user_id'=>$parent_user_id,
										'file_path'=>$file_path,
										'size'=>$insert['size'],
										'created_date'=>time()
									);
									$this->storage_model->insert($insert_storage);
								/* End count storage */
								
								$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>$insert['library_folder_id']);
								$this->create_share_link($insert);
								$response['status'] 	= 'success';
								$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0014'),"File");
                                                                
                                                                //delete now from persnal mydrive
                                                                $this->library_model->delete_object(array('object_id'=>$id));        
                                                                
							}
					}
					}
				}
				if($response['status'] == 'success'){
                                    
                                        
                                    
                                    
					$resp = get_single_rows($this->tbl_smart_businesses,$condition, array('title'));    
                                        $business_name = $resp['title'];
					if(sizeof($object_id)==1){
                                            $get_data = $this->library_model->get_object($object_id[0]);
                                            //  set session activity 
                                            $message = $this->lang->line('msg_activity_044');
                                            $user_url = '<b>'.$this->user_firstname.'</b>';
                                            $page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
                                            $message = get_activity_message($message,[$user_url,'File',$page_name,'<span class="w600 p-blue-clr">'.$business_name.'</span>']);
                                            // function for insert user activity
                                            $this->user_activity($message,'library',$this->module_id,$this->apps_id); 
                                            $response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"File");
                                    }else{
                                            //  set session activity 
                                            $message = $this->lang->line('msg_activity_044');
                                            $user_url = '<b>'.$this->user_firstname.'</b>';
                                            $page_name = sizeof($object_id);
                                            $message = get_activity_message($message,[$user_url,'Files',$page_name,'<span class="w600 p-blue-clr">'.$business_name.'</span>']);
                                            // function for insert user activity
                                            $this->user_activity($message,'library',$this->module_id,$this->apps_id);
                                            $response['message'] = replaceSingleTag($this->lang->line('msg_suc_0022'),"Files");
                                    }
				}
			}
			else{
				
				//$response['message'] = replaceSingleTag($this->lang->line('msg_err_007'),"Folder");
                                $response['message'] = replaceSingleTag($this->lang->line('msg_err_006'),"Business");
			}
				
		}else{
			$error['transfer_business_id'] 	 = form_error('transfer_business_id');
			$response['message'] = $error;
		}
	
		echo $this->jsonify($response);
	}
        
        
        
	/**
	 * get_object_id
	 *
	 * Performs "search object by parameter and get object id".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer,string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	21-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_id($object=false){
		return  array();
		$recent =  $this->input->post('recent') ? $this->input->post('recent') : '';
		$search = $this->input->post('search') ? $this->input->post('search') : '';
		$type =  $this->input->post('type') ? $this->input->post('type') : '';
		$folder_id =  $this->input->post('folder_id')!='' ? $this->input->post('folder_id') : '';
		$select =  json_decode($this->input->post('select'),true);
		$filter =  $this->input->post('filter') ? $this->input->post('filter') : '';
		$date_range = array();
		if($filter!=''){
			$filter = json_decode($filter,true);
			foreach($filter as $value){
				if($value['title']=='uploaded' || $value['title']=='updated'){
					$gate = 'and';
					if($value['gate'] == 'or'){$gate = $value['gate'];}
					$date_range[] = array('title'=>$value['title'],'value'=>$value['value'],'from'=>$value['min'],'to'=>$value['max'],'gate'=>$gate);
				}else{
					$date_range[] = array('title'=>$value['title'],'value'=>$value['value'],'from'=>'','to'=>'','gate'=>$gate);
				}

			}
		} 
		$this->load->model('smart/Status_model');
		$file_types = $this->Status_model->get_status('file_type');
		$file_type= '';
		foreach($file_types as $val){
			if($val['option_value'] == strtolower($type)){
				$file_type=$val['option_key'];
				//$folder_id = '';
			}
		}
		if($folder_id == ''){
			$folder_id = 0;
		}
		$data = array(
			'business_id'=>$this->business_id,
			'search'=>$search,
			'type'=>$type,
			'file_type'=>$file_type,
			'folder_id'=>$folder_id,
			'date_range'=>$date_range,
			'select'=>$select
		);
		
		$result = $this->library_model->get_object_id($data);
		
		$responce = [];
		foreach($result as $val){
			if($object){
				$responce[] = array('id'=>$val['id'],'type'=>$val['type']);
			}else{
				$responce[] =$val['id'];
			}
		}
		return $responce;
	}
	/**
	 * copy_object
	 *
	 * Performs "copy object from folder to folder in AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	21-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function copy_object(){
	check_permission('mydrive', 'file_copy', 'mydrive.others.folder_management');
		if($this->input->post('is_myDrive') == 1){
				$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0014'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'','failed_message'=>'');
		$this->form_validation->set_rules('transfer_folder_id','Folder','trim|required');
		$this->form_validation->set_error_delimiters('', '');
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
			$object_id = $this->get_object_id();
			
		}
		
		
		if($this->input->post('object_type') == 'folder'){
			$object_data = $this->library_model->get_object_id_by_folder($this->input->post('object_id'));
			//print_R($object_data); die;
			foreach($object_data as $val){
				$object_id[] = $val['id'];
			}
		}else{
			$object_id_post = explode(',',$this->input->post('object_id'));
			$object_id = array_merge($object_id,$object_id_post);
			$object_id = array_unique($object_id);		
		}
		
		if($this->form_validation->run()){
			
			$folder_id = $this->input->post('transfer_folder_id');
			$condition = array('business_id'=>$this->business_id,'library_object_id'=>$folder_id);
			
			$failed_count = 0;
			if($this->library_model->chk_folder_exist($condition) || $folder_id=='0'){
				
				foreach($object_id as $id){
					$res = $this->library_model->get_object($id);
					if($res['success']){
						
						$is_upload = true;
						if($res['data']['file_type'] != '2'){
							$source_file = get_library_path($this->business_id).$res['data']['file'];
							$tmp_array = explode('.',$res['data']['file']);
							$tmp_ext = $tmp_array[count($tmp_array)-1];
							array_pop($tmp_array);
							$tmp_filename = implode('.',$tmp_array);
							$new_filename = time().random_string('alnum',10);
							$new_file_fullname = $new_filename.'.'.$tmp_ext;
							$destination_file = get_library_path($this->business_id).$new_file_fullname;
							$is_upload = copy_file($source_file, $destination_file,$this->storage_server);
							if($res['data']['file_type'] == 1){
								//$exist_sizes = array('205'=>'140','565'=>'377');
								$exist_sizes = array();
								foreach ($exist_sizes as $width=>$height) {
									if($res['data']['file_type'] == 1){
										$source_filename = $res['data']['file'];
										$destination_filename = $new_file_fullname;
									}else{
										$source_filename = $tmp_filename.'.png';
										$destination_filename = $new_filename.'.png';
									}
									$source_file = get_library_path($this->business_id).$width.'X'.$height.'/'.$source_filename;
									$destination_file = get_library_path($this->business_id).$width.'X'.$height.'/'.$destination_filename;
									copy_file($source_file, $destination_file,$this->storage_server);
								}
							}
						}
						
						if($res['data']['file_type'] == '2'){ 
							if(!$this->is_video_processed($res['data']['video_id'])){
								$failed_count++;
								$is_upload = false;
								$response['failed_message'] =replaceSingleTag($this->lang->line('msg_err_004'),$failed_count." File Copy");
							}
						}
						
						if($is_upload){
							$insert = $res['data'];
							unset($insert['link_id']);
							unset($insert['meta_title']);
							unset($insert['meta_description']);
							unset($insert['meta_keyword']);
							unset($insert['no_index']);
							unset($insert['no_follow']);
							unset($insert['library_object_id']);
							unset($insert['slug']);
							unset($insert['expired_from']);
							unset($insert['expired_to']);
							$insert['file_name'] =  $this->library_model->object_title_generator($insert['file_name'],$folder_id,$this->business_id);
							$insert['library_folder_id'] = $folder_id;
							$insert['created_by'] =  $this->user_id;
							$insert['created_date'] = time();
							$insert['modified_by'] = $this->user_id;
							$insert['modified_date'] = time();
							$insert['file'] = $new_file_fullname;
							unset($insert['first_name']);
							unset($insert['last_name']);
							unset($insert['total_share']);
							$output = $this->library_model->add_object($insert);
							if($output['success']== 1){
								if($res['data']['file_type'] == '2'){
									$remote_url = base_url().'api/video/processor/videolibtoapp';
									$postdata['library_id'] = $output['id'];
									$postdata['business_id'] = $this->business_id;
									$postdata['user_id'] = $this->user_id;
									$postdata['video_url'] = $this->get_video_url($insert['video_id']);
									$postdata['video_title'] = $insert['file_name'];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, $remote_url);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
									$video_responce =  curl_exec($ch);
									$video_responce = json_decode($video_responce,true);
									
									$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
								}
								
								/* Start count storage */
									/*if($this->parent_id){
										$parent_user_id = $this->parent_id;
									}else{
										$parent_user_id = $this->user_id;
									} */
									$parent_user_id = $this->user_id;
									if($res['data']['file_type'] == '2'){
										$file_path = $this->get_video_url($video_responce['video_id'],false);
									}else{
										$file_path = get_library_path($this->business_id).$insert['file'];
									}
									
									$insert_storage = array(
										'business_id'=>$this->business_id,
										'user_id'=>$parent_user_id,
										'file_path'=>$file_path,
										'size'=>$insert['size'],
										'created_date'=>time()
									);
									$this->storage_model->insert($insert_storage);
								/* End count storage */
								
								$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>$insert['library_folder_id']);
								$this->create_share_link($insert);
								$response['status'] 	= 'success';
								$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0014'),"File");
							}
					}
					}
				}
				if($response['status'] == 'success'){
					$folder_name = $this->library_model->get_folder($folder_id);
					if(sizeof($object_id)==1){
						$get_data = $this->library_model->get_object($object_id[0]);
						//  set session activity 
						$message = $this->lang->line('msg_activity_017');
						$user_url = '<b>'.$this->user_firstname.'</b>';
						$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
						$message = get_activity_message($message,[$user_url,'File',$page_name,'<span class="w600 p-blue-clr">'.$folder_name['data']['title'].'</span>']);
						// function for insert user activity
						$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					}else{
						//  set session activity 
						$message = $this->lang->line('msg_activity_015');
						$user_url = '<b>'.$this->user_firstname.'</b>';
						$page_name = sizeof($object_id);
						$message = get_activity_message($message,[$user_url,$page_name,'Files']);
						// function for insert user activity
						$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					}
				}
			}
			else{
				
				$response['message'] = replaceSingleTag($this->lang->line('msg_err_007'),"Folder");
			}
				
		}else{
			$error['transfer_folder_id'] 	 = form_error('transfer_folder_id');
			$response['message'] = $error;
		}
	
		echo $this->jsonify($response);
	}
	/**
	 * final_upload
	 *
	 * Performs "give the upload final status after upload is done".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	associate array
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	22-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function final_upload(){
                if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
                
                $current_files = $this->library_model->count_available_files($this->business_id);   
                //echo $current_files; die;
                check_package_limit('mydrive_files', $current_files); 
            
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_008'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('objects','Files','trim|required');
		if($this->form_validation->run()){
			$objects = json_decode($this->input->post('objects'),true);
			$upload_count = 0; 
			foreach($objects as $object){
				$condition = array('library_object_id'=>$object['id'],'business_id'=>$this->business_id);
				$data = array('status'=>$object['status']);
				$res = $this->library_model->update_object($condition ,$data);
				if($res && $object['status']=='0'){
					$file_data = $this->library_model->get_object($object['id'],false);
					$file_uri = get_library_path($this->business_id).$file_data['data']['file'];
					remove_file($file_uri);
				}else{
					$upload_count++;
				}
			}
			
			if($upload_count == 1){
				$get_data = $this->library_model->get_object($object['id']);
				//  set session activity 
				$message = $this->lang->line('msg_activity_012');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
				$message = get_activity_message($message,[$user_url,$this->get_object_type($get_data['data']['file_type']),$page_name]);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
				$response['message'] = replaceSingleTag($this->lang->line('msg_suc_009'),"File");
			}else{
				//  set session activity 
				$message = $this->lang->line('msg_activity_034');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = $upload_count;
				$message = get_activity_message($message,[$user_url,$page_name]);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id);
				$response['message'] = replaceSingleTag($this->lang->line('msg_suc_009'),"Files");
			}
			$response['status'] = 'success';
			
		}else{
			$error['object_id'] 	 = form_error('object_id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * delete_object
	 *
	 * Performs "delete the object from AWS S3".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	22-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function delete_object(){
	
		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
		
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
			$object_id = $this->get_object_id(true);
		}
		
		$object_id_post = json_decode($this->input->post('object_id'),true);
		$object_id = array_merge($object_id,$object_id_post);
		
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_003'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('object_id','Files','trim|required');
		if($this->form_validation->run()){
			$file_id = array();
			$folder_id = array();
			foreach($object_id as $value){
				if($value['type']=='folder'){
					check_privilege('mydrive', 'folder_delete');
						$folder_id[] = $value['id'];
						$files = $this->library_model->get_object_id_by_folder($value['id']);
						foreach($files as $file){
							if($file['file_type'] == '5'){
								$folder_id[] = $file['id'];
							}else{
								$file_id[] = $file['id'];
							}
						}
				}else{
					check_privilege('mydrive', 'file_delete');
					$file_id[] = $value['id'];
				}
			}
			$file_id = array_unique($file_id);
			$responce_flag = true;
			if(!empty($folder_id)){
				$condition = array('business_id'=>$this->business_id,'folder_id'=>$folder_id);
				$responce_flag =$this->library_model->delete_folder($condition);
			}
			if(sizeof($file_id)==1){
				$get_data = $this->library_model->get_object($file_id[0]);
			}
			
			if(!empty($file_id)){
				$condition = array('business_id'=>$this->business_id,'object_id'=>$file_id);
				// if(!empty($folder_id)){
					// $condition['folder_id'] = $folder_id;
				// }
				
				$responce_flag = $this->library_model->delete_object($condition);
			}
			if($responce_flag){
				foreach($file_id as $id){
					//remove s3 file code
					$condition = array('business_id'=>$this->business_id,'library_object_id'=>$id);
					$file = $this->library_model->get_file($condition);
					
					if($file['file_type'] == '2'){
						$this->library_model->delete_video($condition);
						$this->load->model('video/delete_model');
						$this->delete_model->delete_video_from_library($file['video_id'],$this->business_id);
						
						/*start delete storage*/
							$file_path = $this->get_video_url($file['video_id'],false);
							$this->storage_model->delete(array($file_path));
						/*end delete storage*/
							
					}
					else{
						if(trim($file['file']) != '' && trim($file['video_id'])== ''){
							$file['file'] = get_library_path($this->business_id).$file['file'];
							
							/*start delete storage*/
							$this->storage_model->delete(array($file['file']));
							/*end delete storage*/
							
							copy_file($file['file'], $file['file'].'_deleted',$this->storage_server);
							remove_file($file['file'],$this->storage_server);
							
							$purge_url = $this->config->item('base_url').'api/akamai/purge?url='.$this->cdn_url.$file['file'];
							read_url_data($purge_url);
							
						}
					}
				}
				
				if(sizeof($file_id)==1){
					//  set session activity 
					$message = $this->lang->line('msg_activity_019');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,'File',$page_name]);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_003'),"File");
				}else{
					//  set session activity 
					$message = $this->lang->line('msg_activity_032');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = sizeof($file_id);
					$message = get_activity_message($message,[$user_url,$page_name,'Files']);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_003'),"Files");
				}
				
				if(!empty($folder_id)){
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_003'),"Folder");
				}
				$response['status'] = 'success';
				
				
			}
		}else{
			$error['object_id'] 	 = form_error('object_id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}




	public function replace_delete_object(){
		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
	
		
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$new_object_id  =  $this->input->post('new_object_id') ? $this->input->post('new_object_id') : 0;
		$object_id = array();
		if($selection){
			$object_id = $this->get_object_id(true);
		}
		
		$object_id_post = json_decode($this->input->post('object_id'),true);
		$object_id = array_merge($object_id,$object_id_post);
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_003'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('object_id','Files','trim|required');
		if($this->form_validation->run()){
			$file_id = array();
			
			foreach($object_id as $value){
				if($value['type']=='file'){
					check_privilege('mydrive', 'file_delete');
					$file_id[] = $value['id'];
				}
			}
			$file_id = array_unique($file_id);
			
			$responce_flag = false;
			if(sizeof($file_id)==1){
				$get_data = $this->library_model->get_object($file_id[0]);
			}
			
			if(!empty($file_id)){
				$condition = array('business_id'=>$this->business_id,'object_id'=>$file_id[0],'new_object_id'=>$new_object_id);
				$responce_flag = $this->library_model->replace_delete_object($condition);
			}
			if($responce_flag){
				foreach($file_id as $id){
					//remove s3 file code
					$condition = array('business_id'=>$this->business_id,'library_object_id'=>$id);
					$file = $this->library_model->get_file($condition);
					
					if($file['file_type'] == '2'){
						//$this->library_model->replace_delete_video($condition);
						$this->load->model('video/delete_model');
						$this->delete_model->delete_video_from_library($get_data['data']['video_id'],$this->business_id);
						
					}
					else{
						if(trim($file['file']) != '' && trim($file['video_id'])== ''){
							$old_file = get_library_path($this->business_id).$get_data['data']['file'];
							remove_file($old_file,$this->storage_server);
							$purge_url = $this->config->item('base_url').'api/akamai/purge?url='.$this->cdn_url.$old_file;
							read_url_data($purge_url);
							
						}
					}
				}
				
				if(sizeof($file_id)==1){
					//  set session activity 
					$message = $this->lang->line('msg_activity_041');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,'File',$page_name]);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0024'),"File");
				}else{
					//  set session activity 
					$message = $this->lang->line('msg_activity_041');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = sizeof($file_id);
					$message = get_activity_message($message,[$user_url,$page_name,'Files']);
					// function for insert user activity
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0024'),"Files");
				}
				$response['status'] = 'success';
			}
		}else{
			$error['object_id'] 	 = form_error('object_id');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}




	/**
	 * download
	 *
	 * Performs "download single object".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	File (downloadable)
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	23-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function download($id,$is_myDrive){
		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
	
		
		check_privilege('mydrive', 'file_download');
		
		$object = $this->library_model->get_object($id);
		$this->business_id = $object['data']['business_id'];
		if($is_myDrive == 1){
			$this->business_id = $object['data']['created_by'];  //$object['created_by'];
			$this->library_url = $this->cdn_url.get_library_path($this->business_id);
			$this->video_url = $this->config->item('cdn_url').get_video_path($object['data']['business_id']);
		}else{
			$this->library_url = $this->cdn_url.get_library_path($this->business_id);
		}
		if($object['data']['business_id']){
			$this->load->helper('download');
			if(doesFileExist(get_library_path($this->business_id).$object['data']['file'],$this->storage_server)){
				$this->library_url = $this->cdn_url.get_library_path($this->business_id);
			}else if(doesFileExist(get_library_path($object['data']['business_id']).$object['data']['file'],$this->storage_server)){
				$this->library_url = $this->cdn_url.get_library_path($object['data']['business_id']);
			}
			
			if($object['data']['file_type'] == '2'){
				$url = $this->get_video_url($object['data']['video_id']);
				$video_data = $this->library_model->get_video($object['data']['video_id']);
				$object['data']['file_extension'] = $video_data['data']['video_extention'];
			}else{
				$url = $this->library_url.$object['data']['file'];
			}
			
			$get_data = $this->library_model->get_object($id);
			$get_folder = $this->library_model->get_folder($get_data['data']['library_folder_id']);
			//  set session activity 
			$message = $this->lang->line('msg_activity_020');
			$user_url = '<b>'.$this->user_firstname.'</b>';
			$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
			$message = get_activity_message($message,[$user_url,$this->get_object_type($get_data['data']['file_type']),$page_name,'<span class="w600 p-blue-clr">'.$get_folder['data']['file_name'].'</span>']);
			// function for insert user activity
			$this->user_activity($message,'library',$this->module_id,$this->apps_id);
			$data = read_url_data($url);
			force_download($object['data']['file_name'].'.'.$object['data']['file_extension'], $data);
		}
	}
	/**
	 * download_zip
	 *
	 * Performs "download multiple object in zip format".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer
	 * @return			: 	File (downloadable)
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	23-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function download_zip($file = ''){
		$this->storage_server = $this->config->item('cdn_url') == $this->config->item('cdn_url_s3') ? 's3' : 'b2';
		
		
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
			$this->library_url = $this->cdn_url.get_library_path($this->business_id);
		}else{
			$this->library_url = $this->cdn_url.get_library_path($this->business_id);
		}
		$temp_path = FCPATH."/uploads/temp/";
		if($file!=''){
			$this->load->helper('download');
			force_download($temp_path.$file, NULL);
			die;
		}
		$selection  =  $this->input->post('selection') ? $this->input->post('selection') : 0;
		$object_id = array();
		if($selection){
			$object_id = $this->get_object_id(true);
		}
		$object_id_post = json_decode($this->input->post('object_id'),true);
		$object_id = array_merge($object_id,$object_id_post);
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_004'),"File Delete"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('object_id','Files','trim|required');
	
		if($this->form_validation->run()){
			$file_id = array();
			$folder_id = array();
			$master = array();
			foreach($object_id as $value){
				if($value['type']=='folder'){
					$folder_id[] = $value['id']; 
					
					$folder_data = $this->library_model->get_folder($value['id']);
					$title = $folder_data['data']['file_name'];
					$files = $this->library_model->get_object_tree_folder($value['id']);
					$master[] = array('id'=>$value['id'],'type'=>'folder','title'=>$title,'inside'=>$files);
				}else{
					$file_id[] = $value['id'];
					$master[] = array('id'=>$value['id'],'type'=>'file','title'=>'');
				}
			}
			// echo '<pre>';
			// print_R($master); die;
			
			if(sizeof($folder_id) == 1){
				$get_folder = $this->library_model->get_folder($folder_id[0]);
				//  set session activity 
				$message = $this->lang->line('msg_activity_020');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = '<span class="w600 p-blue-clr">'.$get_folder['data']['file_name'].'</span>';
				$message = get_activity_message($message,[$user_url,'Folder',$page_name]);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id);	
			}elseif(sizeof($folder_id) > 1){
				//  set session activity 
				$message = $this->lang->line('msg_activity_033');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = sizeof($folder_id);
				$message = get_activity_message($message,[$user_url,$page_name,'Folders']);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id);	
			}elseif(sizeof($file_id)>1){
				//  set session activity 
				$message = $this->lang->line('msg_activity_033');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = sizeof($file_id);
				$message = get_activity_message($message,[$user_url,$page_name,'Files']);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id);	
			}else{}
		
			$this->load->library('zip');
			$temp_folder = $temp_path.time().random_string('alnum',10);
			if (!is_dir($temp_folder)) {
				mkdir($temp_folder, 0777, TRUE);
			}
			
			foreach($master as $value){
				$this->write_files_local($temp_folder,$value);
			}
			
			$this->zip->read_dir($temp_folder,false);
			delete_directory($temp_folder);
			$filename = random_string('alnum',10).'.zip';
			$this->zip->archive(FCPATH.'uploads/temp/'.$filename);
			
			
			
			$response['status'] = 'success';
			$response['message'] = $filename;
		}else{
			$error['object_id'] 	 = form_error('object_id');
			$response['message'] = $error;
		}

		echo $this->jsonify($response);
	}
	
	public function write_files_local($path,$value){
		if($value['type']=='folder'){
			$path = $path.'/'.$value['title'];
			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
			}
			foreach($value['inside'] as $val){
				$this->write_files_local($path,$val);
			}
			
		}else{
			
			$condition = array('business_id'=>$this->business_id,'library_object_id'=>$value['id']);
			$file = $this->library_model->get_file($condition);
			$name = $file['file_name'].'.'.$file['file_extension'];
			if($file['file_type'] == '2'){
				$read_url = $this->get_video_url($file['video_id']);
			}else{
				$read_url = $this->library_url.$file['file'];
			}
			
			$data = read_url_data($read_url);
			if ($data) {
				$location = $path.'/'. $name;
				file_put_contents($location, $data);
			}
		}
	}


/**Anurag Rathore updated code start here  */
	
	public function get_branding_status(){

		$type = $this->input->post('type');
		$id = $this->input->post('id');

		$is_myDrive = $this->input->post('is_myDrive');
		$business_id = ($is_myDrive == 1) ? $this->user_id : $this->business_id;


		$condition = array('business_id'=>	$business_id,'type'=>$type,'id'=>$id);
		$is_branding = $this->library_model->get_branding_status($condition);
		$response['status'] = 'success';
		$response['res'] = $is_branding;
		
		echo $this->jsonify($response);
	}



	public function update_branding(){
		$type = $this->input->post('type');
		$is_branding = $this->input->post('is_branding');
		$id = $this->input->post('id');

		$is_myDrive = $this->input->post('is_myDrive');
		$business_id = ($is_myDrive == 1) ? $this->user_id : $this->business_id;

		if($type == 'folder'){
			$condition = array('business_id'=>	$business_id,'library_object_id'=>$id);
		}else{
			$condition = array('business_id'=>	$business_id,'library_object_id'=>$id);
		}
		
		$data = array('is_branding'=>$is_branding);
		$result = $this->library_model->update_branding_status($type, $condition ,$data);
		$response['status'] = 'success';
		$response['branding_status'] = $result;
		echo $this->jsonify($response);
	}

/** Updated code by anurag end here  */
        
        
        /** Amarat code start here  */
	
	public function get_share_status(){

		$is_myDrive = $this->input->post('is_myDrive');
		$type = $this->input->post('type');
		$id = $this->input->post('id');
                
                $business_id = ($is_myDrive == 1) ? $this->user_id : $this->business_id;
                $condition = array('business_id'=>$business_id,'type'=>$type,'id'=>$id);
		$share_data = $this->library_model->get_share_status($condition);
                if($share_data){
                    $response['status'] = 'success';
                    $response['res'] = $share_data;
                }
		
		echo $this->jsonify($response);
	}
        
        public function update_share(){
            
                $is_myDrive = $this->input->post('is_myDrive');
		$type = $this->input->post('type');
		$is_facebook = $this->input->post('is_facebook');
		$is_twitter = $this->input->post('is_twitter');
		$is_linkedin = $this->input->post('is_linkedin');
		$is_download = $this->input->post('is_download');
		$is_view = $this->input->post('is_view');
		$is_like = $this->input->post('is_like');
		$id = $this->input->post('id');
                
                //for file image
                $file_image = $this->input->post('file_image');
		if($file_image){
			$file_image = str_replace($this->config->item('cdn_url'),'',$file_image);
		}
                
                $business_id = ($is_myDrive == 1) ? $this->user_id : $this->business_id;
                if($type == 'folder'){
                    $condition = array('business_id'=> $business_id,'library_object_id'=>$id);
                    $data = array('is_facebook'=>$is_facebook, 'is_twitter'=>$is_twitter, 'is_linkedin'=>$is_linkedin, 'is_download'=>$is_download, 'is_view'=>$is_view, 'is_like'=>$is_like);
                }else{
                    $condition = array('business_id'=> $business_id,'library_object_id'=>$id);
                    $data = array('is_facebook'=>$is_facebook, 'is_twitter'=>$is_twitter, 'is_linkedin'=>$is_linkedin, 'is_download'=>$is_download, 'file_image'=>$file_image, 'is_view'=>$is_view, 'is_like'=>$is_like);
                }
                
		$result = $this->library_model->update_share_status($type, $condition ,$data);
		$response['status'] = 'success';
		//$response['branding_status'] = $result;
		echo $this->jsonify($response);
	}
        
        /** Amarat code Ends here  */

	/**
	 * update_privacy
	 *
	 * Performs "update the privacy status of the object".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer,string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	24-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function update_privacy(){
		if($this->input->post('type')=='folder'){
			check_privilege('mydrive', 'folder_edit');
		}
		if($this->input->post('is_myDrive') == 1){
				$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_000'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('type','Type','trim|required');
		if($this->input->post('type')=='folder'){
			$this->form_validation->set_rules('id','Folder','trim|required');
		}else{
			$this->form_validation->set_rules('id','File','trim|required');
		}
		$this->form_validation->set_rules('privacy_status','Privacy','trim|required');
		if($this->input->post('privacy_status')){
			if($this->input->post('privacy_status') == '2'){
				$this->form_validation->set_rules('password','Password','trim|required');
			}
		}
		if($this->form_validation->run()){
			
			$privacy_status = $this->input->post('privacy_status');
			$id = $this->input->post('id');
			$password = '';
			if($this->input->post('password')){$password = trim($this->input->post('password'));}
			if($this->input->post('type')=='folder'){
				$condition = array('business_id'=>$this->business_id,'library_object_id'=>$id);
				$data = array('privacy_status'=>$privacy_status,'password'=>$password,'modified_date'=>time(),'modified_by'=>$this->user_id);
				$responce_flag = $this->library_model->update_folder($condition,$data);
				$this->library_model->update_object($condition,$data);   // code updated by Anurag 16_12_19
			}else{
				$condition = array('business_id'=>$this->business_id,'library_object_id'=>$id);
				$data = array('privacy_status'=>$privacy_status,'password'=>$password,'modified_date'=>time(),'modified_by'=>$this->user_id);
				$responce_flag = $this->library_model->update_object($condition,$data);
			}
			
			if($responce_flag){
				$response['status'] = 'success';
				if($this->input->post('type')=='folder'){
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_001'),"Folder Privacy");
				
					//To show Activity after status change
					$get_data = $this->library_model->get_folder($id);
					$message = $this->lang->line('msg_activity_040');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['title'].'"</span>';
					$message = get_activity_message($message,[$user_url,'Folder',$page_name]);
					$this->user_activity($message,'folder',$this->module_id,$this->apps_id);
				}else{
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_001'),"Files Privacy");

					//To show Activity after status change
					$get_data = $this->library_model->get_object($id);
					$message = $this->lang->line('msg_activity_040');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
					$message = get_activity_message($message,[$user_url,$this->get_object_type($get_data['data']['file_type']),$page_name]);
					$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
					//echo $this->db->last_query();die;
				}
			}
		}else{
			$error['id'] 	 = form_error('id');
			$error['type'] 	 = form_error('type');
			$error['privacy_status'] 	 = form_error('privacy_status');
			$error['password'] 	 = form_error('password');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}





	public function update_privacy_status(){
		if($this->input->post('type')=='folder'){
			check_privilege('mydrive', 'folder_edit');
		}
		if($this->input->post('is_myDrive') == 1){
				$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_000'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('type','Type','trim|required');
		if($this->input->post('type')=='folder'){
			$this->form_validation->set_rules('id','Folder','trim|required');
		}else{
			$this->form_validation->set_rules('id','File','trim|required');
		}
		$this->form_validation->set_rules('privacy_status','Privacy','trim|required');
		if($this->input->post('privacy_status')){
			if($this->input->post('privacy_status') == '2'){
				$this->form_validation->set_rules('password','Password','trim|required');
			}
		}
		if($this->form_validation->run()){	
			$privacy_status = $this->input->post('privacy_status');

			$id = explode(',', $this->input->post('id'));

			$password = '';
			if($this->input->post('password')){$password = trim($this->input->post('password'));}
			if($this->input->post('type')=='folder'){
				$data = array('privacy_status'=>$privacy_status,'password'=>$password,'modified_date'=>time(),'modified_by'=>$this->user_id);
				$responce_flag = $this->library_model->update_folder_status($id,$data);
			}else{
				$data = array('privacy_status'=>$privacy_status,'password'=>$password,'modified_date'=>time(),'modified_by'=>$this->user_id);
				$responce_flag = $this->library_model->update_object_status($id,$data);
			}
			
			if($responce_flag){
				$response['status'] = 'success';
				if($this->input->post('type')=='folder'){
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_001'),"Folder Privacy");
				
					//To show Activity after status change
					$no = count($id);
					
					//$get_data = $this->library_model->get_folder($id);
					$message = $this->lang->line('msg_activity_040');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$no.'"</span>';
					$message = get_activity_message($message,[$user_url,'Folder',$page_name]);
					$this->user_activity($message,'folder',$this->module_id,$this->apps_id);
				}else{
					$response['message'] = replaceSingleTag($this->lang->line('msg_suc_001'),"Files Privacy");

					//To show Activity after status change
					$no = count($id);
					
					//$get_data = $this->library_model->get_folder($id);
					$message = $this->lang->line('msg_activity_040');
					$user_url = '<b>'.$this->user_firstname.'</b>';
					$page_name = '<span class="w600 p-blue-clr">"'.$no.'"</span>';
					$message = get_activity_message($message,[$user_url,'file',$page_name]);
					$this->user_activity($message,'file',$this->module_id,$this->apps_id);
				}
			}
		}else{
			$error['id'] 	 = form_error('id');
			$error['type'] 	 = form_error('type');
			$error['privacy_status'] 	 = form_error('privacy_status');
			$error['password'] 	 = form_error('password');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}


	/**
	 * get_share_link
	 *
	 * Performs "get the object share link address".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer,string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	24-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_share_link(){
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_000'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('id','Object','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		if($this->form_validation->run()){
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			if($type == 'folder'){
				$object_id = 0;
				$folder_id = $id;
				$object_responce = $this->library_model->get_folder($folder_id);
			}else{
				$object_id = $id;
				$folder_id = 0;
				$object_responce = $this->library_model->get_object($object_id);
			}
			
			$data = array('library_object_id'=>$object_id,'library_folder_id'=>$folder_id);
			if($object_responce['success']){
				if(!$this->library_model->chk_share_link_exist($data)){
					$this->create_share_link($data);
				}
				$output = $this->library_model->get_share_link($data);
				if($output['success']){
					$response['status'] = 'success';
					if($type == 'folder'){
						$output['data']['url'] = $this->share_url.'sharefolder/'.$output['data']['slug']; 
					}
					else{
						$output['data']['url'] = $this->share_url.'share/'.$output['data']['slug']; 
					}$response['message'] = $output['data'];
				}
			}
			else{
				$response['message'] = replaceSingleTag($this->lang->line('msg_err_006'),"File");
			}
		}else{
			$error['id'] 	 = form_error('id');
			$error['type'] 	 = form_error('type');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * create_share_link
	 *
	 * Performs "create the object share link address".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	associate array
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function create_share_link($data){
		$insert = array(
						'business_id'=>$this->business_id,
						'library_folder_id'=>$data['library_folder_id'],
						'library_object_id'=>$data['library_object_id'],
						'slug'=>$this->library_model->generate_unique_link(),
						'expired_from'=>0,
						'expired_to'=>0,
						'status'=>1,
						'created_date'=>time(),
						'created_by'=>$this->business_id,
						'modified_date'=>time(),
						'modified_by'=>$this->business_id
					);
		return $this->library_model->create_share_link($insert);
	}
	/**
	 * link_share
	 *
	 * Performs "object link share by the email and other medium".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer, date, string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function link_share(){
		check_privilege('mydrive', 'file_sharing');

		if($this->input->post('type') == 'image'){
			check_package_feature('mydrive.share.image');
		}
		if($this->input->post('type') == 'video'){
			check_package_feature('mydrive.share.video');
		}
		if($this->input->post('type') == 'audio'){
			check_package_feature('mydrive.share.audio');
		}
		if($this->input->post('type') == 'document'){
			check_package_feature('mydrive.share.document');
		}
		if($this->input->post('type') == 'folder'){
			check_package_feature('mydrive.share.folder');
		}
		
	
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('id','Link','trim|required');
		$expired_from  =  $this->input->post('expired_from') ? $this->input->post('expired_from') : 0;
		$expired_to  =  $this->input->post('expired_to') ? $this->input->post('expired_to') : 0;
		$this->form_validation->set_rules('email','Email','trim|required');
		if($this->form_validation->run()){
			$message = '';
			if($this->input->post('message')){$message = $this->input->post('message');}
			$link_data = array(
								'expired_from' => $expired_from,
								'expired_to' => $expired_to,
								'modified_by'	=>	$this->user_id,
								'modified_date'	=>	time()
							);
			$link_condition = array(
									'business_id'	=>	$this->business_id,
									'library_share_link_id'	=>	$this->input->post('id')
								);
			 $this->library_model->update_share_link($link_condition,$link_data);
			$emails = explode(',',$this->input->post('email'));
			
			//Sending Email code paste**
			// $this->load->model('smart/Mail_model');
			// $send_message = "Hello,<br><br>Check this out...<br><br>".$this->user_firstname." has shared something with you-<br><br>".$message."<br><br>".$this->input->post('share_url')."<br><br>Hope you liked it.<br><br><br>Regards,<br>Team Saglus ";
			// $subject = 'Hello, something interesting is shared with you...';
			// $this->Mail_model->sendmail($emails, $subject, $send_message);
			
			if($this->input->post('object_type') == 'file'){
				$get_data = $this->library_model->get_object($this->input->post('object_id'));
			}elseif($this->input->post('object_type') == 'folder'){
				$get_data = $this->library_model->get_folder($this->input->post('folder_id'));
			}
			
			$this->load->model('mail/mail_model');
			$maildata['mail_nature'] = 'system'; 
			$maildata['email_type'] = 'library-share-link';
			$replace_array = array();
			$replace_array['first_name'] = $this->user_firstname;
			$replace_array['message'] = $message;
			$replace_array['share_url'] = $this->input->post('share_url');
			$replace_array['password'] = $get_data['data']['password'];
			
			
			foreach($emails as $email){
				$maildata['to'] = $email;
				$replace_array['name'] = explode('@',$email)[0];
				$insert = array(
							'library_share_link_id' =>	$this->input->post('id'),
							'business_id'	=>	$this->business_id,
							'email'	=>	$email,
							'message'	=>	$message,
							'status' 		=> 	'1',
							'created_by'	=>	$this->user_id,
							'created_date'	=>	time(), 
							'modified_date'	=>	time(),
							'modified_by'	=>	$this->user_id
						);
						
						
				$maildata['replace_array'] = $replace_array; 
				$this->library_model->insert_share_user($insert);
				$this->mail_model->sendmail($maildata);
				
			}
			if($this->input->post('object_type') == 'file'){
				//  set session activity 
				$message = $this->lang->line('msg_activity_014');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = '<span class="w600 p-blue-clr">"'.$get_data['data']['file_name'].'"</span>';
				///{0} shared a {1} {2} to {3} people from  library
				$message = get_activity_message($message,[$user_url,$this->get_object_type($get_data['data']['file_type']),$page_name,sizeof($emails)]);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
				$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0021'),"File");
			}elseif($this->input->post('object_type') == 'folder'){
				//  set session activity 
				$message = $this->lang->line('msg_activity_014');
				$user_url = '<b>'.$this->user_firstname.'</b>';
				$page_name = '<b>"'.$get_data['data']['title'].'"</b>';
				$message = get_activity_message($message,[$user_url,'Folder',$page_name,sizeof($emails)]);
				// function for insert user activity
				$this->user_activity($message,'library',$this->module_id,$this->apps_id); 
				$response['message'] = replaceSingleTag($this->lang->line('msg_suc_0021'),"Folder");
			}
			$response['status'] = 'success';
			
			
		}else{
			$error['id'] 	 = form_error('id');
			$error['email'] = form_error('email');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * get_object_password
	 *
	 * Performs "get the object password that define for privacy".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer,string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	27-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_password(){
		$this->form_validation->set_rules('id','Object','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		if($this->form_validation->run()){
			$type = $this->input->post('type');
			$id = $this->input->post('id');
			$condition = array('business_id'=>	$this->business_id,'type'=>$type,'id'=>$id);
			$password = $this->library_model->get_object_password($condition);
			$response['status'] = 'success';
			$response['message'] = $password;
		}else{
			$error['id'] 	 = form_error('id');
			$error['type'] = form_error('type');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}
	/**
	 * get_video_url
	 *
	 * Performs "get the video url".
	 * It's related to all the smart library in saglus smart
	 * 
	 *
	 * @param			:	integer,string
	 * @return			: 	JSON string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	27-05-2018		
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_video_url($video_id,$full_path=true){
		$video = $this->library_model->get_video($video_id,false);
		$url = '';
		if($video['success'] == '1'){
			if($full_path){
				$url = $this->video_url.$video['data']['slug_folder'].'/'.$video['data']['slug_folder'].'.'.$video['data']['video_extention'];
			}else{
				$url =  get_video_path($this->business_id).$video['data']['slug_folder'].'/'.$video['data']['slug_folder'].'.'.$video['data']['video_extention'];
			}
		}
		return $url;
	}
	
	public function is_video_processed($video_id){
		return $ffmpeg_status = $this->getdata_model->field('video_videos', 'ffmpeg_status', array('video_id' => $video_id));
	}
	
	public function update_object_seo(){
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_001'),"Object SEO"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		$this->form_validation->set_rules('object_id','Object Id','trim|required');
		$this->form_validation->set_rules('meta_description','Meta Description','max_length[250]');
		if($this->form_validation->run()){
			$data = array(
				'meta_title'		=>$this->input->post('meta_title'),
				'meta_description'	=>$this->input->post('meta_description'),
				'meta_keyword'		=>$this->input->post('meta_keyword'),
				'no_index'			=>$this->input->post('no_index'),
				'no_follow'			=>$this->input->post('no_follow'),
				'modified_date'		=>time(),
				'modified_by'		=>$this->user_id,
			);
			$condition = array(
				'library_object_id'	=>	$this->input->post('object_id'),
				'business_id'		=>	$this->business_id
			);
			$output  = $this->library_model->update_object_seo($condition,$data);
			if($output){
				$response['status'] 	= 'success';
				$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_006'),"SEO settings saved");
			}
		}else{
			$error['object_id']  = form_error('object_id');
			$error['meta_description']  = form_error('meta_description');
			$response['message'] = $error;
		}
		echo $this->jsonify($response);
	}

	public function pixabay(){
            
                $media_type = $this->input->post('media_type');
		$per_page = 25;  //$this->input->post('page_per');
		$page = $this->input->post('page');
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'43','type'=>'7')); 
		$api_data = json_decode($api_data['data']['credentials']); 
		$key = $api_data->api_key;
		$search = $this->input->post('search');
		$category = $this->input->post('category');
		if($key != ''){
                    
                    if($media_type == 'video'){ 
                        $url = 'https://pixabay.com/api/videos/?key='.$key.'&q='.$search.'&per_page='.$per_page.'&page='.$page.'&order=latest&category='.$category;			
                    }else if($media_type == 'image'){   
                        $url = 'https://pixabay.com/api/?key='.$key.'&q='.$search.'&image_type=photo&per_page='.$per_page.'&page='.$page.'&order=latest&category='.$category;			
                    }
                         
                        $curl_handle=curl_init();
			curl_setopt($curl_handle,CURLOPT_URL,$url);
			curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
			curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);
			if (empty($buffer)){
				print array('totalHits'=>0,'hits'=>array(),'total'=>0,'message'=>'Please insert the Credential or Check the Token.');
			}
			else{
				  print $buffer;
			}
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"Pixabay");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
	}

	public function pexels(){
                
                $media_type = $this->input->post('media_type');
                $per_page = $this->input->post('page_per');
		$page = $this->input->post('page');
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'44','type'=>'7')); 
		$api_data = json_decode($api_data['data']['credentials']); 
		$key = $api_data->api_key;
                if($media_type == 'video'){ 
                    $search = $this->input->post('search')? $this->input->post('search'): 'Animation';
                }else if($media_type == 'image'){  
                    $search = $this->input->post('search')? $this->input->post('search'): 'Wallpaper';
                }
                
		if($key != ''){
			$apiKey=$key;
			$params = http_build_query([
				'query'			=> $search,
				'per_page'		=> 25,     //$per_page,  
				'page'			=> $page 
			]);	
                        

                        if($media_type == 'video'){ 
                           $url = "https://api.pexels.com/videos/search?query=". $params;
                        }else if($media_type == 'image'){  
                            $url = "https://api.pexels.com/v1/search?" . $params;
                        }
                       
			//
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
			curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);	
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);			
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	
			curl_setopt($ch, CURLOPT_HEADER, false);		
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-type: application/json',
				'Authorization: ' . $apiKey
			]);
			$result = curl_exec($ch);
			curl_close($ch);
			$json_result = $result;
			print_R($json_result);die;
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"Pexels");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
	}
	
	public function shutterstock(){
            
                $media_type = $this->input->post('media_type');
                $category = $this->input->post('category');
                $per_page = $this->input->post('page_per');
		$page = $this->input->post('page');
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'45','type'=>'7')); 
		$api_data = json_decode($api_data['data']['credentials']); 
		$access_token = $api_data->access_token;
		$search = $this->input->post('search');
                
		if($access_token != ''){
			if(!empty($category)){
                            $params = http_build_query([
                                    'query'		=> $search,
                                    'category'	=> $category,
                                    'orientation'	=> 'horizontal',
                                    'sort'		=> 'popular',
                                    'per_page'  	=> $per_page,
                                    'page'  	=> $page,

                            ]);
                        }else{
                            $params = http_build_query([
                                'query'		=> $search,
                                'orientation'	=> 'horizontal',
				'sort'		=> 'popular',
				'per_page'  	=> $per_page,
				'page'  	=> $page,
                                
                            ]);
                        }
                        
			if($media_type == 'video'){ 
                            $url = "https://api.shutterstock.com/v2/videos/search?" . $params;
                        }else if($media_type == 'image'){  
                            $url = "https://api.shutterstock.com/v2/images/search?" . $params;
                        }
                        
                        $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
			curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);	
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);			
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	
			curl_setopt($ch, CURLOPT_HEADER, false);		
			curl_setopt($ch, CURLOPT_HTTPHEADER, [ 
				"Authorization : Bearer $access_token "
			]);
			$result = curl_exec($ch);
			curl_close($ch);
			if(json_decode($result)->message == 'Invalid access token'){
				$res['message'] = "Please insert the Credential or Check the Token.";
				$res['status'] = 'error';
				echo $this->jsonify($res);die;
			} 
			echo $result; die;
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"Shutterstock");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
	}

	public function google_drive_files(){ 
		
                include_once(APPPATH. 'libraries/google/vendor/autoload.php');
                
                $page_per = $this->input->get('page_per');
                $page = $this->input->get('page');
		$search = trim($this->input->get('search'));
		$folder_id = trim($this->input->get('folder_id'));
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'46','type'=>'8')); 
		$api_data = json_decode($api_data['data']['credentials']); 
                
		if($api_data->google_data->access_token != ''){
                    
			$api_data = json_encode($api_data->google_data); 
			$client = $this->getClient();
			$service = new Google_Service_Drive($client);
			$client->setAccessToken($api_data);
			$result = array();
			$pageToken = NULL;
			if($this->input->get('page_token') != ''){
				$pageToken = $this->input->get('page_token');
			}
			do { 
				try {   
					$parameters = array();
					$parameters['pageSize'] = $page_per;
					$parameters['q'] =  "'" . $folder_id . "' in parents";
					if(!empty($search)){
						$parameters['q'] .=  " and name contains '" . $search . "'";
					}
                                        $parameters['q'] .= " and trashed = false";
					if ($pageToken) {
						$parameters['pageToken'] = $pageToken;
					}
                                        $files = $service->files->listFiles($parameters);
                                        $result['data'] = array_merge($result, $files->getFiles());
					$result['pageToken'] = $files->getNextPageToken();
                                        
                                        echo json_encode($result); die;
				} catch (Exception $e) {
					$res['message'] = "Please insert the Credential or Check the Token.";
					$res['status'] = 'error';
					echo $this->jsonify($res);
					$pageToken = NULL;
				}
			} while ($pageToken);
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"Google Drive");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
       
	}
        
    /**
    * Returns an authorized API client.
    * @return Google_Client the authorized client object
    */
    function getClient(){ 
        $client = new Google_Client();
        
        //get all detai from db
        //get ClientId, ClientSecret, accessToken from db (active_business_id, integration_id = 46)
        $this->load->helper("sag_common_helper");
        $credentials_data = get_single_rows('smart_business_integrations',array('business_id' => $this->business_id,'integration_id' => '46'),array('credentials','integration_id','business_integration_id','title'));
        //echo "<pre>"; print_r($credentials_data); die;
        if($credentials_data){  
            
            $credentials = json_decode($credentials_data['credentials']);
            $clientId = $credentials->client_id;
            $clientSecret = $credentials->client_secret;
            $redirectUrl = $credentials->redirectUrl;
            
            $accessToken = $credentials->google_data->access_token;
            $refreshToken = $credentials->google_data->refresh_token;
            
            
            $client->setClientId($clientId);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUrl);
            //$client->authenticate($_GET['code']);
            $client->setApplicationName('Google Drive API PHP Quickstart');
            $client->setScopes(Google_Service_Drive::DRIVE_METADATA_READONLY);
            //$client->setAuthConfig('credentials.json');
            $client->setAccessType('offline');
            $client->setPrompt('select_account consent');
            
            $client->setAccessToken($accessToken);
            //echo "<pre>"; print_r($client); die;
            
            if ($client->isAccessTokenExpired()) {   
            
                //if ($client->getRefreshToken()) { 
                if ($refreshToken) { 
                    //$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                    $client->fetchAccessTokenWithRefreshToken($refreshToken);
                } else { 
                    $authUrl = $client->createAuthUrl();
                    // printf("Open the following link in your browser:\n%s\n", $authUrl);
                     //print "<a class='login' href='$authUrl'>Select a calendar!</a>";
                     $authCode = trim($_GET['code']);
                     //echo $authCode; die('$authCode');
                     
                     // Exchange authorization code for an access token.
                     $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                     $client->setAccessToken($accessToken);
                }
            }
        
        }
        return $client; 
    }
        
        
	public function dropbox(){
		$per_page = $this->input->get('page_per');
		$page = $this->input->get('page');
		$path = $this->input->get('path')?$this->input->get('path'):'';
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'47','type'=>'8')); 
		$api_data = json_decode($api_data['data']['credentials']); 
		$access_token = $api_data->access_token;
		$search = $this->input->get('search');
		if($access_token != ''){
			$url = "https://api.dropboxapi.com/2/files/list_folder";
			$post_field =  array(
				"path"         =>$path,        
				"recursive"    => true,
				"include_media_info"  => false,
				"include_deleted"    => false,
				"include_has_explicit_shared_members" => false,
				"include_mounted_folders" => true,
				"include_non_downloadable_files" => true ,
				"limit"=>(int) $per_page
			);
			$ch = curl_init(); 
			curl_setopt_array($ch, array( 
				CURLOPT_POST            => TRUE,
				CURLOPT_RETURNTRANSFER  => TRUE,
				CURLOPT_SSL_VERIFYPEER  => FALSE,
				CURLOPT_SSL_VERIFYHOST  => FALSE,    
				CURLOPT_URL         => $url,
				CURLOPT_POSTFIELDS  => json_encode($post_field),
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$access_token,
					"content-type: application/json"            
				),
			));
			$response = curl_exec($ch);     
			curl_close($ch);
			if($response == 'Error in call to API function "files/list_folder": The given OAuth 2 access token is malformed.'){
				$res['message'] = "Please insert the Credential or Check the Token.";
				$res['status'] = 'error';
				echo $this->jsonify($res);die;
			}
			print_R($response); die;
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"Dropbox");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
	}
	
	public function onedrive(){
		$per_page = $this->input->post('page_per');
		$page = $this->input->post('page');
		$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'48','type'=>'8')); 
		$api_data = json_decode($api_data['data']['credentials']); 
		$access_token = $api_data->access_token;
		
		$search = $this->input->post('search');
		if($access_token != ''){
			
			$curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://graph.microsoft.com/v1.0/me/drive/root/children?top=".$per_page."&select=name,id,lastModifiedDateTime,folder,file,webUrl,@microsoft.graph.downloadUrl",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$access_token,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: graph.microsoft.com",
                "cache-control: no-cache"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
			if(json_decode($response)->error){
				$res['message'] = "Please insert the Credential or Check the Token.";
				$res['status'] = 'error';
				echo $this->jsonify($res);die;
			} 
			print_R(str_replace("@microsoft.graph.downloadUrl","path",$response)); die;
		}else{
			$res['message'] = replaceSingleTag($this->lang->line('msg_err_0022'),"OneDrive");
			$res['status'] = 'error';
			echo $this->jsonify($res);
		}
	}
	
	function dropbox_to_mydrive(){
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		
		$name = $this->input->post('name');
		$path = $this->input->post('path');
		
		$extention = explode('.',$name);
		$original_name = $extention[0];
		$file_ext = array_values(array_slice($extention, -1))[0];;
		
		$availbale_ext = array('jpg','jpeg','png','gif','mkv','mp4','webm','mov','wmv','mp3','doc','docx','xls','xlsx','ppt','pptx','pdf','txt','zip','rar','7zip','afdesign','aiff');
		
		$valid_ext = true;
		
		if(!in_array($file_ext, $availbale_ext)){
			$response['message'] = 'The filetype you are attempting to upload is not allowed';
		}
		else{
			$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'47','type'=>'8')); 
			$api_data = json_decode($api_data['data']['credentials']); 
			$access_token = $api_data->access_token;
			$url = "https://content.dropboxapi.com/2/files/download";
			$post_field = array( 
			 "path"         => $path     //folder end file   
			);   
			$content = '';
			$ch = curl_init();     
			curl_setopt_array($ch, array( 
				CURLOPT_POST            => TRUE,
				CURLOPT_RETURNTRANSFER  => TRUE,
				CURLOPT_SSL_VERIFYPEER  => FALSE,
				CURLOPT_SSL_VERIFYHOST  => FALSE,
				//CURLOPT_FILE           => $fp,    
				CURLOPT_URL         => $url,
			// CURLOPT_POSTFIELDS  => json_encode($post_field),
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$access_token,
					"content-type: application/octet-stream",
					"Dropbox-API-Arg: " . json_encode($post_field)   
				),
			));
			curl_setopt( $ch, CURLOPT_POSTFIELDS, '' );
			$content = curl_exec($ch);  
			curl_close($ch);
				
			if ($content) {
				$file_title = time();
				$file = $file_title.'.'.$file_ext; 
				$temp_file_path = 'uploads/temp/'.$file; 
				$temp_path = 'uploads/temp/';
				$full_path = str_replace('\\','/',FCPATH).'uploads/temp/';
				$width  =0;
				$height =0; 
				$doc_page=0;
				$duration = 0;
				$file_size =strlen($content);
				$file_ext_status = $this->get_file_type_status(array('file_ext'=> $file_ext)); 
				file_put_contents($temp_file_path,$content); 
				$insert = array(
					'business_id'=>$this->business_id,
					'library_folder_id'=>'0',
					'file'=>$file,
					'file_name'=>$file_title,
					'file_alt_name'=>$file_title,
					'file_type'=>$file_ext_status['status'],
					'file_extension'=>$file_ext,
					'duration'=>$duration,
					'pages'=>$doc_page,
					'size'=>$file_size,
					'width'=>$width,
					'height'=>$height,
					'status'=>1,
					'privacy_status'=>1,
					'password'=>'',
					'created_by'=>$this->user_id,
					'created_date'=>time(),
					'modified_by'=>$this->user_id,
					'modified_date'=>0
				);
				
				
				$temp_full_path = str_replace('\\','/',FCPATH).$temp_file_path;
				$s3_upload_file_array = array();
				$source = $temp_file_path;
				$destination_path = get_library_path($this->business_id).$file;
				
				if(in_array($file_ext, array('mkv','mp4','webm','mov','wmv'))){
					
					$output = $this->library_model->add_object($insert);
					
					$remote_url = base_url().'api/video/processor/videolibtoapp';
					$postdata['library_id'] = $output['id'];
					$postdata['business_id'] = $this->business_id;
					$postdata['user_id'] = $this->user_id;
					$postdata['video_url'] = $temp_full_path;
					$postdata['video_title'] = $file;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $remote_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
					$video_responce =  curl_exec($ch);
					$video_responce = json_decode($video_responce,true);
					$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
					$res = true;
				}
				else{
					if(in_array($file_ext, array('jpg','jpeg','png','gif'))){
						$image_data = getimagesize($temp_full_path);
						if($image_data != ''){
							$width = $image_data[0];
							$height = $image_data[1];
							$insert['width'] = $width;
							$insert['height'] = $height;
						}
						$target_path = './uploads/temp/';
						$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$file);
						$size_array = array('320','640','800','1200','1600'); 
						$image_sizes = array(); 
						foreach($size_array as $key=>$val){
							if($val < $width || $val == $width){
								$image_sizes[$val] = round($height / $width * $val);
							}
						}
						$this->load->library('image_lib');
						foreach ($image_sizes as $w=>$h) {
							$config = array(
								'source_image' => $temp_full_path,
								'new_image' => $target_path,
								'maintain_ration' => true,
								'create_thumb' => TRUE,
								'thumb_marker' => '_thumb'.$w,
								'width' => $w,
								'height' => $h
							);
							$this->image_lib->initialize($config);
							if($this->image_lib->resize()){
								$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
								$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$file_title.'_'.$w.'.'.$file_ext);
							}
							$this->image_lib->clear();
						}
					}
					else if(in_array($file_ext, array('doc','docx','xls','xlsx','ppt','pptx','pdf'))){
						if($file_ext != 'pdf'){
							$res = convert_to_pdf($full_path.$file,$full_path);
							$source = $full_path.$file_title.'.pdf';
						}else{
							$res = true; 
							$source = $full_path.$file;
						}
						if($res){
							$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$file_title.'.pdf');
						}
						$pages = 0;
						if(file_exists($source)) {
							$pdftext = file_get_contents($source);
							$pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
						}
						$insert['pages'] = $pages;
						$insert['file'] = $file_title.'.pdf';
						$insert['file_name'] = $file_title;
						$insert['file_alt_name'] = $file_title;
						$insert['file_extension'] = 'pdf';
						
					}
					else if(in_array($file_ext, array('mp3'))){
						$this->load->helper('smart/ffmpeg_helper');
						$audio_details = get_video_details($temp_full_path);
						$duration = $audio_details['duration'];
						if($duration ==''){
							$duration = 0;
						}
						$s3_upload_file_array[] = array('source'=>$temp_file_path,'destination'=>get_library_path($this->business_id).$file);
					}
					else if(in_array($file_ext, array('txt','zip','aiff'))){
						$s3_upload_file_array[] = array('source'=>$full_path.$file,'destination'=>get_library_path($this->business_id).$file);
					}
					$output = $this->library_model->add_object($insert);
					foreach($s3_upload_file_array as $file){
						$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
					}
				}
				if($res){ 
					$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>0);
					$this->create_share_link($insert);
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0020'),"File");
					$response['insert_id'] 	= $output['id'];
					$response['file'] 		= $title;
				}
			}
		
		}
		echo $this->jsonify($response);
	}
	
	function google_drive_to_mydrive(){
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		
		$name = $this->input->post('name');
		$file_id = $this->input->post('file_id');
		
		$extention = explode('.',$name);
		$original_name = $extention[0];
		$file_ext = array_values(array_slice($extention, -1))[0];;
		
		$availbale_ext = array('jpg','jpeg','png','gif','mkv','mp4','webm','mov','wmv','mp3','doc','docx','xls','xlsx','ppt','pptx','pdf','txt','zip','rar','7zip','afdesign','aiff');
		
		$valid_ext = true;
		
		if(!in_array($file_ext, $availbale_ext)){
			$response['message'] = 'The filetype you are attempting to upload is not allowed';
		}
		else{
			include_once(APPPATH. 'libraries\Google\autoload.php');
			$fileId = $this->input->post('file_id');
			$api_data = $this->library_model->getApiCredentials(array('business_id'=>$this->business_id,'integration_id'=>'46','type'=>'8')); 
			$api_data = json_decode($api_data['data']['credentials']); 
			// $api_data = json_ecode($api_data->google_data->access_token);
			$access_token = $api_data->google_data->access_token;
			$url = "https://www.googleapis.com/drive/v3/files/".$fileId."?alt=media";
			$ch = curl_init();     
			curl_setopt_array($ch, array( 
				CURLOPT_POST            => false,
				CURLOPT_RETURNTRANSFER  => TRUE,
				CURLOPT_SSL_VERIFYPEER  => FALSE,
				CURLOPT_SSL_VERIFYHOST  => FALSE,
				CURLOPT_URL         => $url,
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$access_token 
				),
			));
			$content = curl_exec($ch); 
			curl_close($ch);
				
			if ($content) {
				$file_title = time();
				$file = $file_title.'.'.$file_ext; 
				$temp_file_path = 'uploads/temp/'.$file; 
				$temp_path = 'uploads/temp/';
				$full_path = str_replace('\\','/',FCPATH).'uploads/temp/';
				$width  =0;
				$height =0; 
				$doc_page=0;
				$duration = 0;
				$file_size =strlen($content);
				$file_ext_status = $this->get_file_type_status(array('file_ext'=> $file_ext)); 
				file_put_contents($temp_file_path,$content); 
				$insert = array(
					'business_id'=>$this->business_id,
					'library_folder_id'=>'0',
					'file'=>$file,
					'file_name'=>$file_title,
					'file_alt_name'=>$file_title,
					'file_type'=>$file_ext_status['status'],
					'file_extension'=>$file_ext,
					'duration'=>$duration,
					'pages'=>$doc_page,
					'size'=>$file_size,
					'width'=>$width,
					'height'=>$height,
					'status'=>1,
					'privacy_status'=>1,
					'password'=>'',
					'created_by'=>$this->user_id,
					'created_date'=>time(),
					'modified_by'=>$this->user_id,
					'modified_date'=>0
				);
				
				
				$temp_full_path = str_replace('\\','/',FCPATH).$temp_file_path;
				$s3_upload_file_array = array();
				$destination_path = get_library_path($this->business_id).$file;
				
				if(in_array($file_ext, array('mkv','mp4','webm','mov','wmv'))){
					
					$output = $this->library_model->add_object($insert);
					
					$remote_url = base_url().'api/video/processor/videolibtoapp';
					$postdata['library_id'] = $output['id'];
					$postdata['business_id'] = $this->business_id;
					$postdata['user_id'] = $this->user_id;
					$postdata['video_url'] = $temp_full_path;
					$postdata['video_title'] = $file;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $remote_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
					$video_responce =  curl_exec($ch);
					$video_responce = json_decode($video_responce,true);
					$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
					$res = true;
				}
				else{
					if(in_array($file_ext, array('jpg','jpeg','png','gif'))){
						$image_data = getimagesize($temp_full_path);
						if($image_data != ''){
							$width = $image_data[0];
							$height = $image_data[1];
							$insert['width'] = $width;
							$insert['height'] = $height;
						}
						$target_path = './uploads/temp/';
						$s3_upload_file_array[] = array('source'=>$full_path.$file,'destination'=>get_library_path($this->business_id).$file);
						$size_array = array('320','640','800','1200','1600'); 
						$image_sizes = array(); 
						foreach($size_array as $key=>$val){
							if($val < $width || $val == $width){
								$image_sizes[$val] = round($height / $width * $val);
							}
						}
						$this->load->library('image_lib');
						foreach ($image_sizes as $w=>$h) {
							$config = array(
								'source_image' => $temp_full_path,
								'new_image' => $target_path,
								'maintain_ration' => true,
								'create_thumb' => TRUE,
								'thumb_marker' => '_thumb'.$w,
								'width' => $w,
								'height' => $h
							);
							$this->image_lib->initialize($config);
							if($this->image_lib->resize()){
								$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
								$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$file_title.'_'.$w.'.'.$file_ext);
							}
							$this->image_lib->clear();
						}
						 
					}
					else if(in_array($file_ext, array('doc','docx','xls','xlsx','ppt','pptx','pdf'))){
						if($file_ext != 'pdf'){
							$res = convert_to_pdf($full_path.$file,$full_path);
							$source = $full_path.$file_title.'.pdf';
						}else{
                 		 $res = true; 
						 $source = $full_path.$file;
						}
						if($res){
							$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$file_title.'.pdf');
						}
						$pages = 0;
						if(file_exists($source)) {
							$pdftext = file_get_contents($source);
							$pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
						}
						$insert['pages'] = $pages;
						$insert['file'] = $file_title.'.pdf';
						$insert['file_name'] = $file_title;
						$insert['file_alt_name'] = $file_title;
						$insert['file_extension'] = 'pdf';
						
					}
					else if(in_array($file_ext, array('mp3'))){
						$this->load->helper('smart/ffmpeg_helper');
						$audio_details = get_video_details($temp_full_path);
						$duration = $audio_details['duration'];
						if($duration ==''){
							$duration = 0;
						}
						$s3_upload_file_array[] = array('source'=>$temp_file_path,'destination'=>get_library_path($this->business_id).$file);
					}
					else if(in_array($file_ext, array('txt','zip'))){
						$s3_upload_file_array[] = array('source'=>$full_path.$file,'destination'=>get_library_path($this->business_id).$file);
					}
					
					$output = $this->library_model->add_object($insert);
					foreach($s3_upload_file_array as $file){
						$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
					}
				}
				if($res){ 
					$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>0);
					$this->create_share_link($insert);
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0020'),"File");
					$response['insert_id'] 	= $output['id'];
					$response['file'] 		= $title;
				}
			}
		
		}
		echo $this->jsonify($response);
		
		
	}
	
	function onedrive_to_mydrive(){
		
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_0023'),"File"),'callback' => '','redirect_type'=>'angular','redirect_url'=>'','insert_id'=>'');
		
		$name = $this->input->post('name');
		$path = $this->input->post('path');
		
		$extention = explode('.',$name);
		$original_name = $extention[0];
		$file_ext = array_values(array_slice($extention, -1))[0];;
		
		$availbale_ext = array('jpg','jpeg','png','gif','mkv','mp4','webm','mov','wmv','mp3','doc','docx','xls','xlsx','ppt','pptx','pdf','txt','zip','rar','7zip','afdesign','aiff');
		
		$valid_ext = true;
		
		if(!in_array($file_ext, $availbale_ext)){
			$response['message'] = 'The filetype you are attempting to upload is not allowed';
		}
		else{
			$content = file_get_contents($path);
			if ($content) {
				$file_title = time();
				$file = $file_title.'.'.$file_ext; 
				$temp_file_path = 'uploads/temp/'.$file; 
				$temp_path = 'uploads/temp/';
				$full_path = str_replace('\\','/',FCPATH).'uploads/temp/';
				$width  =0;
				$height =0; 
				$doc_page=0;
				$duration = 0;
				$file_size =strlen($content);
				$file_ext_status = $this->get_file_type_status(array('file_ext'=> $file_ext)); 
				file_put_contents($temp_file_path,$content); 
				$insert = array(
					'business_id'=>$this->business_id,
					'library_folder_id'=>'0',
					'file'=>$file,
					'file_name'=>$file_title,
					'file_alt_name'=>$file_title,
					'file_type'=>$file_ext_status['status'],
					'file_extension'=>$file_ext,
					'duration'=>$duration,
					'pages'=>$doc_page,
					'size'=>$file_size,
					'width'=>$width,
					'height'=>$height,
					'status'=>1,
					'privacy_status'=>1,
					'password'=>'',
					'created_by'=>$this->user_id,
					'created_date'=>time(),
					'modified_by'=>$this->user_id,
					'modified_date'=>0
				);
				
				
				$temp_full_path = str_replace('\\','/',FCPATH).$temp_file_path;
				$s3_upload_file_array = array();
				$source = $temp_file_path;
				$destination_path = get_library_path($this->business_id).$file;
				
				if(in_array($file_ext, array('mkv','mp4','mov','wmv','webm'))){
					
					$output = $this->library_model->add_object($insert);
					
					$remote_url = base_url().'api/video/processor/videolibtoapp';
					$postdata['library_id'] = $output['id'];
					$postdata['business_id'] = $this->business_id;
					$postdata['user_id'] = $this->user_id;
					$postdata['video_url'] = $temp_full_path;
					$postdata['video_title'] = $file;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $remote_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
					$video_responce =  curl_exec($ch);
					$video_responce = json_decode($video_responce,true);
					$this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
					$res = true;
				}
				else{
					if(in_array($file_ext, array('jpg','jpeg','png','gif'))){
						$image_data = getimagesize($temp_full_path);
						if($image_data != ''){
							$width = $image_data[0];
							$height = $image_data[1];
							$insert['width'] = $width;
							$insert['height'] = $height;
						}
						$target_path = './uploads/temp/';
						$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$file);
						$size_array = array('320','640','800','1200','1600'); 
						$image_sizes = array(); 
						foreach($size_array as $key=>$val){
							if($val < $width || $val == $width){
								$image_sizes[$val] = round($height / $width * $val);
							}
						}
						$this->load->library('image_lib');
						foreach ($image_sizes as $w=>$h) {
							$config = array(
								'source_image' => $temp_full_path,
								'new_image' => $target_path,
								'maintain_ration' => true,
								'create_thumb' => TRUE,
								'thumb_marker' => '_thumb'.$w,
								'width' => $w,
								'height' => $h
							);
							$this->image_lib->initialize($config);
							if($this->image_lib->resize()){
								$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
								$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$file_title.'_'.$w.'.'.$file_ext);
							}
							$this->image_lib->clear();
						}
					}
					else if(in_array($file_ext, array('doc','docx','xls','xlsx','ppt','pptx','pdf'))){
						if($file_ext != 'pdf'){
							$res = convert_to_pdf($full_path.$file,$full_path);
							$source = $full_path.$file_title.'.pdf';
						}else{
							$res = true; 
							$source = $full_path.$file;
						}
						if($res){
							$s3_upload_file_array[] = array('source'=>$source,'destination'=>get_library_path($this->business_id).$file_title.'.pdf');
						}
						$pages = 0;
						if(file_exists($source)) {
							$pdftext = file_get_contents($source);
							$pages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
						}
						$insert['pages'] = $pages;
						$insert['file'] = $file_title.'.pdf';
						$insert['file_name'] = $file_title;
						$insert['file_alt_name'] = $file_title;
						$insert['file_extension'] = 'pdf';
						
					}
					else if(in_array($file_ext, array('mp3'))){
						$this->load->helper('smart/ffmpeg_helper');
						$audio_details = get_video_details($temp_full_path);
						$duration = $audio_details['duration'];
						if($duration ==''){
							$duration = 0;
						}
						$s3_upload_file_array[] = array('source'=>$temp_file_path,'destination'=>get_library_path($this->business_id).$file);
					}
					else if(in_array($file_ext, array('txt','zip','aiff'))){
						$s3_upload_file_array[] = array('source'=>$full_path.$file,'destination'=>get_library_path($this->business_id).$file);
					}
					$output = $this->library_model->add_object($insert);
					foreach($s3_upload_file_array as $file){
						$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
					}
				}
				if($res){ 
					$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>0);
					$this->create_share_link($insert);
					$response['status'] 	= 'success';
					$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0020'),"File");
					$response['insert_id'] 	= $output['id'];
					$response['file'] 		= $title;
				}
			}
		
		}
		echo $this->jsonify($response);
	}
	
	public function add_to_library(){
            
                if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
                
                if($this->input->post('is_myDrive') == 2){
			$is_stock = 1;
		}
                
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_004'),"File"),'redirect_type'=>'angular','redirect_url'=>'');
		
		//input section
		$media_url = $this->input->post('media_url'); 
		$id = $this->input->post('id'); 
                
                if(!empty($this->input->post('resulation'))){
                    $resulation = explode('-',$this->input->post('resulation')); 
                    $width = $resulation[0];
                    $height = $resulation[1];
                    
                }else{
                    list($width, $height) = getimagesize($this->input->post('media_url')); 
                    $arr = array('h' => $height, 'w' => $width );
                    //print_r($arr); //output - Array ( [h] => 545 [w] => 968 ) 
                    $width = $arr['w'];
                    $height = $arr['h'];
                }
                
		$title = $this->input->post('title'); 
		//title section
		
                if(!empty($this->input->post('extention'))){
                    $extention = $this->input->post('extention');
                }else{ 
                    $extention = end(explode('.',end(explode('/',$this->input->post('media_url')))));
                }
		if(strpos($extention, '?') == true){		
			$extention = explode('?',$extention)[0];
		}
                
                if($title != ''){ $title = $title.'-'.$id; }else{ $title = $id; }
		$title = $this->library_model->object_title_generator($title,0,$this->business_id);
		$file_name = time().'-'.$id; 
		$file = $file_name.'.'.$extention; 
		//file section
		$temp_file_path = 'uploads/temp/'.$file;
		$file_data = read_url_data($media_url);
		
		$file_size =strlen($file_data);
		file_put_contents($temp_file_path,$file_data); 
		$file_ext_status = $this->get_file_type_status(array('file_ext'=> $extention)); 
		
                
                
                
		$insert = array(
			'business_id'=>$this->business_id,
			'library_folder_id'=>'0',
			'file'=>$file,
			'file_name'=>$title,
			'file_alt_name'=>$title,
			'file_type'=>$file_ext_status['status'],
			'file_extension'=>$extention,
			'duration'=>0,
			'pages'=>0,
			'size'=>$file_size,
			'width'=>$width,
			'height'=>$height,
			'status'=>1,
			'privacy_status'=>1,
			'password'=>'',
			'created_by'=>$this->user_id,
			'created_date'=>time(),
			'modified_by'=>$this->user_id,
			'modified_date'=>0,
			'is_stock'=> 0
		);
                //echo "<pre>"; print_r($insert); 
                //die('5555');
		$output = $this->library_model->add_object($insert);
                //set for test
                //$this->input->post('pexels_file_type') = 'video';
                //$extention = 'mp4';
                //end for test
                $temp_full_path = str_replace('\\','/',FCPATH).$temp_file_path;
                if($this->input->post('media_type') == 'video'){ 
                    if(in_array($extention, array('mkv','mp4','mov','wmv','webm'))){ 
                        $remote_url = base_url().'api/video/processor/videolibtoapp';
                        $postdata['library_id'] = $output['id'];
                        $postdata['business_id'] = $this->business_id;
                        $postdata['user_id'] = $this->user_id;
                        $postdata['video_url'] = $temp_full_path;
                        $postdata['video_title'] = $file;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $remote_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
                        $video_responce =  curl_exec($ch);
                        $video_responce = json_decode($video_responce,true);
                        $this->library_model->update_object(array('library_object_id'=>$output['id']), array('video_id'=>$video_responce['video_id']));
                        $res = true;
                    }
                }else{ 
                    // $s3_upload = array('source'=>base_url().$temp_file_path,'destination'=>get_library_path($this->business_id).$file);
                    $s3_upload_file_array = array();
                    $source_path = str_replace('\\','/',FCPATH).$temp_file_path;
                    $destination_path = get_library_path($this->business_id).$file;
                    $target_path = './uploads/temp/';
                    $s3_upload_file_array[] = array('source'=>$source_path,'destination'=>$destination_path);
                    $size_array = array('320','640','800','1200','1600'); 
                    $image_sizes = array(); 
                    foreach($size_array as $key=>$val){
                            if($val < $resulation[0] || $val == $resulation[0]){
                                    $image_sizes[$val] = round($resulation[1] / $resulation[0] * $val);
                            }
                    }
                    
                    $this->load->library('image_lib');
                                    foreach ($image_sizes as $width=>$height) {
                                            $config = array(
                                                    'source_image' => $source_path,
                                                    'new_image' => $target_path,
                                                    'maintain_ration' => true,
                                                    'create_thumb' => TRUE,
                                                    'thumb_marker' => '_thumb'.$width,
                                                    'width' => $width,
                                                    'height' => $height
                                            );
                                            $this->image_lib->initialize($config);
                                            if($this->image_lib->resize()){
                                                    $thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
                                                    $s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$file_name.'_'.$width.'.'.$extention);
                                            }

                                            $this->image_lib->clear();
                                    }
                    foreach($s3_upload_file_array as $file){
                            $res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
                    }
                    
		}
                
                if($res){ 
                    $insert = array('library_object_id'=>$output['id'],'library_folder_id'=>0);
                    $this->create_share_link($insert);
                    $response['status'] 	= 'success';
                    $response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0020'),"File");
                    $response['insert_id'] 	= $output['id'];
                    $response['file'] 		= $title;
                }
		echo $this->jsonify($response);
	}
        
        
        
        public function add_to_library_old(){
		if($this->input->post('is_myDrive') == 1){
			$this->business_id = $this->user_id;
		}
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_004'),"File"),'redirect_type'=>'angular','redirect_url'=>'');
		
		//input section
		$image_url = $this->input->post('image_url'); 
		$id = $this->input->post('id'); 
		$resulation = explode('-',$this->input->post('resulation')); 
		$title = $this->input->post('title'); 
		//title section
		
		 
		$extention = end(explode('.',end(explode('/',$this->input->post('image_url')))));
		if(strpos($extention, '?') == true){		
			$extention = explode('?',$extention)[0];
		}
		if($title != ''){ $title = $title.'-'.$id; }else{ $title = $id; }
		$title = $this->library_model->object_title_generator($title,0,$this->business_id);
		$file_name = time().'-'.$id; 
		$file = $file_name.'.'.$extention; 
		//file section
		$temp_file_path = 'uploads/temp/'.$file;
		$file_data = read_url_data($image_url);
		
		$file_size =strlen($file_data);
		file_put_contents($temp_file_path,$file_data); 
		$file_ext_status = $this->get_file_type_status(array('file_ext'=> $extention)); 
		
		$insert = array(
			'business_id'=>$this->business_id,
			'library_folder_id'=>'0',
			'file'=>$file,
			'file_name'=>$title,
			'file_alt_name'=>$title,
			'file_type'=>$file_ext_status['status'],
			'file_extension'=>$extention,
			'duration'=>0,
			'pages'=>0,
			'size'=>$file_size,
			'width'=>$resulation[0],
			'height'=>$resulation[1],
			'status'=>1,
			'privacy_status'=>1,
			'password'=>'',
			'created_by'=>$this->user_id,
			'created_date'=>time(),
			'modified_by'=>$this->user_id,
			'modified_date'=>0
		);
		$output = $this->library_model->add_object($insert);
		
		// $s3_upload = array('source'=>base_url().$temp_file_path,'destination'=>get_library_path($this->business_id).$file);
		
		$s3_upload_file_array = array();
		$source_path = str_replace('\\','/',FCPATH).$temp_file_path;
		$destination_path = get_library_path($this->business_id).$file;
		$target_path = './uploads/temp/';
		$s3_upload_file_array[] = array('source'=>$source_path,'destination'=>$destination_path);
		$size_array = array('320','640','800','1200','1600'); 
		$image_sizes = array(); 
		foreach($size_array as $key=>$val){
			if($val < $resulation[0] || $val == $resulation[0]){
				$image_sizes[$val] = round($resulation[1] / $resulation[0] * $val);
			}
		}
		
		$this->load->library('image_lib');
				foreach ($image_sizes as $width=>$height) {
					$config = array(
						'source_image' => $source_path,
						'new_image' => $target_path,
						'maintain_ration' => true,
						'create_thumb' => TRUE,
						'thumb_marker' => '_thumb'.$width,
						'width' => $width,
						'height' => $height
					);
					$this->image_lib->initialize($config);
					if($this->image_lib->resize()){
						$thumbnail = str_replace('\\','/',$this->image_lib->full_dst_path);
						$s3_upload_file_array[] = array('source'=>$thumbnail,'destination'=>get_library_path($this->business_id).$file_name.'_'.$width.'.'.$extention);
					}
		
					$this->image_lib->clear();
				}
		foreach($s3_upload_file_array as $file){
			$res = upload_file($file['source'], $file['destination'],false,$this->storage_server);
		}
		if($res){ 
			$insert = array('library_object_id'=>$output['id'],'library_folder_id'=>0);
			$this->create_share_link($insert);
			$response['status'] 	= 'success';
			$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_0020'),"File");
			$response['insert_id'] 	= $output['id'];
			$response['file'] 		= $title;
		}
		
		echo $this->jsonify($response);
	}
        
        
	/**
	 * Analytics of Library Module Section 
	 * @modified_by 	:	Anurag
	 */	
	public function basic_report(){
		$response['visitors'] = $this->library_model->basic_report($this->get_businessID());
		$response['like_dislike'] = $this->library_model->like_dislike();
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}

	public function traffic_report(){
		$response['data'] = $this->library_model->traffic_report($this->get_businessID());
		$response['status'] = 'success';
		
		echo json_encode($response,JSON_NUMERIC_CHECK);
		
		// echo $this->jsonify($response);
	}

	public function operating_system_report(){	
		$response['data'] = $this->library_model->operating_system_report($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}
	
	public function browser_report(){	
		$response['data'] = $this->library_model->browser_report($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}
	
	public function device_report(){	
		$response['data'] = $this->library_model->device_report($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}

	public function location_report(){	
		$response['data'] = $this->library_model->location_report($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}

	public function location_report_country(){	
		$response['data'] = $this->library_model->location_report_country($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}
	
	public function location_report_state(){	
		$response['data'] = $this->library_model->location_report_state($this->get_businessID());
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}


	public function breadcrumb($id){										
			$response = $this->library_model->row('smart_library_objects','file_name as file_title,library_object_id',array('library_object_id'=>$id));			
			echo $this->jsonify($response);		
	}

	public function countries(){
		$response = $this->library_model->countries();
		echo json_encode($response,JSON_NUMERIC_CHECK);
	}
	
	public function states($country_id){
		$response = $this->library_model->states($country_id);
		echo json_encode($response,JSON_NUMERIC_CHECK);
	}
	
	public function cities($state_id){
		$response = $this->library_model->cities($state_id);
		echo json_encode($response,JSON_NUMERIC_CHECK);
	}

	public function country_name($country_id){
		$response = $this->library_model->country_name($country_id);
		echo json_encode($response);
	}

	public function locationbreadcrumb($type,$id){
		if($type == 'country'){											
			$response = $this->library_model->row('smart_countries','country_name as country_title,id',array('id'=>$id));			
			echo $this->jsonify($response);		
	}else{
			$output1 = $this->library_model->row('smart_states','state_name as state_title,id,country_id',array('id'=>$id));
			$output2 = $this->library_model->row('smart_countries','country_name as country_title',array('id'=>$output1['country_id']));
			$response = array_merge($output1,$output2);			
			echo $this->jsonify($response);
		}	
	}

//Api to check Dashboard data
	public function mydrive_dashboard_data(){
		$response= $this->library_model->mydrive_dashboard_data($this->business_id,'1562322549','1563343017','folder_shared');
		$response['status']			  = 'success';
		echo $this->jsonify($response);
	}

	public function get_like_dislike(){
		$response= $this->library_model->get_like_dislike_details($this->input->post('id'), $this->input->post('type'));
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}

	public function add_like_dislike(){
		$response= $this->library_model->add_like_dislike($this->input->post('id'), $this->input->post('status'), $this->input->post('type'), $this->input->post('user_id'));
		$response['status'] = 'success';
		echo $this->jsonify($response);
	}

	public function check_user_storage_space(){
		$user_storage_usage_limit = '487398446';
		$response = $this->library_model->check_user_storage_space();
		if($response['used_space_by_user'] > $user_storage_usage_limit){
			echo "Sorry your storage limit not more than".$user_storage_usage_limit;
			echo $this->jsonify($response); 
			die;
		}
	}

	public function get_businessID(){
		$object = $this->library_model->get_object_businessID();
		if($object['business_id'] == $this->business_id){ 
			return $this->business_id;
		}
		return $this->user_id;
	}
	public function get_video_slug(){
		$res = $this->library_model->get_video_slug();
		$res['status'] = 'success';
		echo $this->jsonify($res);
	}

	
	//slug
	public function update_object_slug(){
		$response = array('status'=>'error','message'=>replaceSingleTag($this->lang->line('msg_err_001'),"Url"),'redirect_type'=>'angular','redirect_url'=>'');
		$id = $this->input->post('id');
		$slug = $this->input->post('slug');
		$condition = array('library_object_id' => $id);
		$data = array('slug'=>$slug);
		if($this->library_model->get_unique_slug($id,$slug,$this->business_id)){
			$this->library_model->update_object($condition,$data);
			$response['message'] = replaceSingleTag($this->lang->line('msg_suc_001'),"Url");
			$response['status'] = 'success';
		}else{
			$response['message'] = replaceSingleTag($this->lang->line('msg_err_005'),"Url");
		}
		// echo $this->db->last_query(); die;
		echo $this->jsonify($response);
	}
	public function get_fontend_domain($return=false){
		$this->load->model('funnel/page_model');
		$business_domain = $this->page_model->get_custom_domain($this->business_id);
		if ($business_domain == '') { 
                    //$business_domain = $this->config->item('frontend_domain');
                    //set business frontend domain config variable
                    if(!empty($this->session->userdata('sagsmart_login_business_data')['subdomain'])){ 
                        $business_domain = $this->config->item('http') . $this->session->userdata('sagsmart_login_business_data')['subdomain'] . $this->config->item('oppyo_domain_co');
                        $this->config->set_item('frontend_domain', $business_domain);
                    }
		}
		if (strpos($business_domain, 'http://') === false && strpos($business_domain, 'https://') === false) {
			$business_domain = $this->config->item('http') . $business_domain;
		}
		if($return){
			return $business_domain;
		}else{
			echo $business_domain;
		}
		
	} 
	public function get_detail_homepage(){
		$type = $this->input->post('type');
		$data = $this->library_model->get_detail_homepage(array('type'=>$type,'business_id'=>$this->business_id)); 
		echo $this->jsonify($data);
	}

	public function audio_embed($id){
		$query = $this->db->get_where('smart_library_objects',array('library_object_id'=>$id,'is_deleted'=>0));
		if($query->num_rows()){
			$row = $query->row_array();
			$data = array('audio'=>$this->library_url.$row['file'],'thumbnail'=>$this->cdn_url.'assets/images/full-video-bg.jpg');
			if($row['file_image']!=''){
				$data['thumbnail'] = $row['file_image'];
			}
			
			$this->load->view('app/smart/full-audio',$data);
		}
		else{
			redirect(base_url().'404');
		}
	}
	
	
	
	public function delete_object_not_uploaded(){
		$data = $this->library_model->delete_object_not_uploaded($this->business_id); 
		echo $this->jsonify($data);
	}
        
        public function is_product_object(){
            
            $object_id = $this->input->post('object_id');
            $is_product_object = $this->library_model->is_product_object($this->business_id, $object_id); 
			
            //return $is_product_object;
			if(!empty($is_product_object) && $is_product_object['product_count'] > 0) {	
				$responce['status'] = 'success';
				$responce['data'] = $is_product_object;
			} else {
				$responce['status'] = 'error';
				$responce['data'] = $is_product_object;
			}
            echo $this->jsonify($responce);
            
        }
		
		public function is_product_object_multipe() {
			
			$product_object = $this->library_model->is_product_object_multipe($this->business_id); 
			
			if(!empty($product_object)) {	
					$responce['status'] = 'success';
					$responce['data'] = $product_object;
					$responce['product_count'] = count($product_object);
				} else {
					$responce['status'] = 'error';
					$responce['data'] = $product_object;
					$responce['product_count'] = count($product_object);
				}
				echo $this->jsonify($responce);
			
		}
                
                
    public function add_stock_files($type='image'){
        
        $file_type = $this->input->get('type');
        
        if($file_type == 'image'){
            $this->add_stock_images();
        }
        
    }    
	
	
    public function add_stock_images(){
        
        
        $this->load->helper("sag_common_helper");   
        
        //$directory = $this->cdn_url . "uploads/business/aff2499f9a0711e8/stock/image";
        $directory = "uploads/business/aff2499f9a0711e8/library/stock/image";
                
        $images = glob($directory . "/*.jpg");
        //$images = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
        //echo "<pre>"; print_r($images); die;
        
        $data = array();

        foreach($images as $key => $image){
            
            $insert = array();
            
            $file = end(explode("/",$image));
            $file_info = pathinfo($file);
            
            $insert['file'] = $file_info['basename']; 
            $insert['file_name'] = $file_info['filename']; 
            $insert['slug'] = create_slug($file_info['filename']); 
            $insert['file_alt_name'] = $file_info['filename']; 
            $insert['file_extension'] = $file_info['extension']; 
            
            $insert['business_id'] = 'aff2499f9a0711e8'; //bms_busines_id
            $insert['created_by'] = '8749a5dd89b411e9'; //developer_bms@gmail.com
            $insert['modified_by'] = '8749a5dd89b411e9'; //developer_bms@gmail.com
            $insert['file_type'] = '1'; //1 for images
            $insert['status'] = '1';
            $insert['privacy_status'] = '0'; // for public
            $insert['password'] = ''; // for public
            $insert['is_stock'] = '1'; 
            
            
            $media_url = $this->cdn_url . 'uploads/business/aff2499f9a0711e8/library/stock/image/' . $insert['file'];
            //echo $url; die;
            
            //get file size
            $file_data = read_url_data($media_url);
            $file_size = strlen($file_data);
            $insert['size'] = $file_size; 
            
            //get file width, height
            list($width, $height) = getimagesize($media_url); 
            $arr = array('h' => $height, 'w' => $width );
            //print_r($arr); //output - Array ( [h] => 545 [w] => 968 ) 
            
            $insert['width'] = $arr['w'];
            $insert['height'] = $arr['h'];
            
            //echo "<pre>"; print_r($insert); die;
            
            $data[] = $insert;
        }
        //echo "<pre>"; print_r($data); die(' 54');
        $this->db->insert_batch('smart_library_objects', $data);
        echo $this->db->last_query(); 
        
        die();
    }            
     
    
        
                
    
}
