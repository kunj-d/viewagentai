<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package			:	Saglus Smart
 * @subpackage		:	Smart Library
 * @Class		 	:	Library_model	
 * @author		 	:	Firoz
 * @created_date 	:	15-04-2018	
 * @modified_date 	:	14-06-2018	
 * @modified_by 	:	Dharmendra Nama
 */
 
class Library_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->tbl_library_object = "smart_library_objects";
		$this->tbl_library_folder = "smart_library_objects";
		$this->tbl_library_share_link = "smart_library_share_links";
		$this->tbl_library_share_user = "smart_library_share_users";
		$this->tbl_smart_businesses = "smart_businesses";
		$this->saglus_users = 'saglus_users';
		$this->video_videos = 'video_videos';
		$this->cart_products_files = 'cart_products_files';
		$this->cart_products = 'cart_products';
		// $this->video_video_stat1 = 'video_video_stat1';
		
		$this->db->query("SET sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
		
		$this->allocated_slug = array('activate-account','author','about-business','folder','share','sharefolder','video-subscriber-dashboard','video-subscriber-profile','search','login','404','url-not-exist','link-expired');
	
	
	
		
	}
	
	
	public function getFolderData($data){
	    
	    $data['is_deleted'] = '0';
		$this->db->select('*,file_name as title');
		$query = $this->db->get_where($this->tbl_library_object,$data);
		return $query->result_array();
	  
    }
	
	
	
	
	
	/**
	 * get_count
	 *
	 * Performs "count all the object according to its type".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array 
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_count($data){
		
		$yesterday_time = time()-(24*60*60);
		$select = 'count(if(file_type!=5, 1, null)) as `all`,count(if(file_type=0, 1, null)) as other,count(if(file_type=1, 1, null)) as image,count(if(file_type=2, 1, null)) as video,count(if(file_type=3, 1, null)) as document,count(if(file_type=4, 1, null)) as audio, count(if(file_type=5, 1, null)) as folder ';
		$this->db->select($select);
	   	if($data['search']!=''){
			$this->db->like('file_name',$data['search']);
		}
		// if($data['file_type']!=''&& $data['folder_id']=='0'){
			// $this->db->where('file_type',$data['file_type']);
		// }

		if(!empty($data['file_type']) ){
			$this->db->where_in('file_type',$data['file_type']);
		}
		
		
		
		
		// if($data['type'] == 'folder'){
			// if($data['folder_id']>0){
				// $this->db->where('library_folder_id',$data['folder_id']);
			// }else
			// {
				// $this->db->where('library_folder_id > ',0);
			// }
		// }else{
			// if($data['folder_id']!=''){
				// $this->db->where('library_folder_id',$data['folder_id']);
			// }
		// }
		
		if((string)$data['folder_id']!= ''){
			$this->db->where('library_folder_id',$data['folder_id']);
		}
		
		
	   	$this->db->where('status','1');
		$this->db->where('is_deleted','0');
		$this->db->where('business_id',$data['business_id']);
		if(count($data['date_range'])) {
			$this->db->group_start();
			foreach($data['date_range'] as $key=>$range){
				if($key){
					if($range['gate'] == 'or'){
						$this->db->or_group_start();
					}else{
						$this->db->group_start();
					}
				}else{
					$this->db->group_start();
				}
				if($range['title'] == 'updated'){
					$this->db->where('modified_date >=',$range['from']);
					$this->db->where('modified_date <=',$range['to']);
					$this->db->where('modified_date != created_date');
				}
				else if($range['title'] == 'uploaded'){
					$this->db->where('created_date >=',$range['from']);
					$this->db->where('created_date <=',$range['to']);
				}
				else{
					$this->db->where('library_folder_id',$range['value']);
				}
				$this->db->group_end();
				
			}
			$this->db->group_end();
		}
		if($data['recent']!=''){
			if($data['recent'] == 'updated'){
				$this->db->where('modified_date >',$yesterday_time);
				$this->db->where('modified_date != created_date');
			}else{
				$this->db->where('created_date >',$yesterday_time);
			}
		}
		if(!isset($data['filter_list']) ){
			$data['filter_list']=''; 
		}
		if($data['filter_list']=='all' ){
			$this->db->where('privacy_status !=',1);
		}else if($data['filter_list'] == '0' ){
			$this->db->where('privacy_status',0);
		}else if($data['filter_list'] == '2' ){
			$this->db->where('privacy_status',2);
		}
		
		// if($data['is_myDrive']!=''){
			// if($data['is_myDrive'] == '1'){
				// $this->db->where('created_by =',$data['user_id']);
			// }else{
				
			// }
		// }
                
                /*** get stock images ***/
                if($data['is_myDrive'] == '2'){
                        $this->db->where('is_stock =',1);
                }
		 

		$query=	$this->db->get($this->tbl_library_object);
		// echo $this->db->last_query(); die;
		$count= $query->row_array();
	
		$select = 'count(if(file_type!=5, 1, null)) as `total`,count(if(created_date >= '.$yesterday_time.', 1, null)) as recently_created,count(if(modified_date >= '.$yesterday_time.' and modified_date !=  created_date, 1, null)) as recently_updated, count(if(file_type=5, 1, null)) as folder ';
		$this->db->select($select);
	   	if($data['search']!=''){
			$this->db->like('file_name',$data['search']);
		}
		
		if(!empty($data['file_type']) ){
			$this->db->where_in('file_type',$data['file_type']);
		}
		// if($data['type'] == 'folder'){
			// if($data['folder_id']>0){
				// $this->db->where('library_folder_id',$data['folder_id']);
			// }else
			// {
				// $this->db->where('library_folder_id > ',0);
			// }
		// }else{
			// if($data['folder_id']!=''){
				// $this->db->where('library_folder_id',$data['folder_id']);
			// }
		// }
		if((string)$data['folder_id']!= ''){
			$this->db->where('library_folder_id',$data['folder_id']);
		}

		
	   	$this->db->where('status','1');
		$this->db->where('is_deleted','0');
		$this->db->where('business_id',$data['business_id']);
		if(count($data['date_range'])) {
			$this->db->group_start();
			foreach($data['date_range'] as $key=>$range){
				if($key){
					if($range['gate'] == 'or'){
						$this->db->or_group_start();
					}else{
						$this->db->group_start();
					}
				}else{
					$this->db->group_start();
				}
				if($range['title'] == 'updated'){
					$this->db->where('modified_date >=',$range['from']);
					$this->db->where('modified_date <=',$range['to']);
					$this->db->where('modified_date != created_date');
				}
				else if($range['title'] == 'uploaded'){
					$this->db->where('created_date >=',$range['from']);
					$this->db->where('created_date <=',$range['to']);
				}
				else{
					$this->db->where('library_folder_id',$range['value']);
				}
				$this->db->group_end();
				
			}
			$this->db->group_end();
		}
		if(!isset($data['filter_list']) ){
				$data['filter_list']=''; 
			}
		if($data['filter_list']=='all' && $data['filter_list'] !=''){
			$this->db->where('privacy_status !=',1);
		}else if($data['filter_list'] == 0 && $data['filter_list'] !=''){
			$this->db->where('privacy_status',0);
		}else if($data['filter_list'] == 2 && $data['filter_list'] !=''){
			$this->db->where('privacy_status',2);
		}
		
		$query=	$this->db->get($this->tbl_library_object);
		//echo  $this->db->last_query(); die;
		$countA = $query->row_array();
		$count = array_merge($count,$countA);
		
		// if($data['type']=='folder' && $data['folder_id'] == 0){
			// $select = 'count(*) as folder , count(if(created_date >= '.$yesterday_time.', 1, null)) as recently_created,count(if(modified_date >= '.$yesterday_time.' and created_date != modified_date, 1, null)) as recently_updated';
			// $this->db->select($select);
			// if($data['search']!=''){
				// $this->db->like('title',$data['search']);
			// }
			// $this->db->where('status','1');
			// $this->db->where('is_deleted','0');
			// $this->db->where('business_id',$data['business_id']);
			// if(count($data['date_range'])) {
				// $this->db->group_start();
				// foreach($data['date_range'] as $key=>$range){
					// if($key){
						// if($range['gate'] == 'and'){
							// $this->db->group_start();
						// }else{
							// $this->db->or_group_start();
						// }
					// }
					// if($range['title'] == 'updated'){
						// $this->db->where('modified_date >=',$range['from']);
						// $this->db->where('modified_date <=',$range['to']);
						// $this->db->where('modified_date != created_date');
					// }
					// else if($range['title'] == 'uploaded'){
						// $this->db->where('created_date >=',$range['from']);
						// $this->db->where('created_date <=',$range['to']);
					// }
					// else{
						// $this->db->where('library_folder_id',$range['value']);
					// }
					// if($key){
						// $this->db->group_end();
					// }
					
				// }
				// $this->db->group_end();
			// }
			// if(!isset($data['filter_list']) ){
				// $data['filter_list']=''; 
			// }
			// if($data['filter_list']=='all' && $data['filter_list'] !=''){
				// $this->db->where('privacy_status !=',1);
			// }else if($data['filter_list'] == 0 && $data['filter_list'] !=''){
				// $this->db->where('privacy_status',0);
			// }else if($data['filter_list'] == 2 && $data['filter_list'] !=''){
				// $this->db->where('privacy_status',2);
			// }
			
			// $query=	$this->db->get($this->tbl_library_folder);
			// $folders_count = $query->row_array();
			// $count['folder'] = $folders_count['folder']; 
			// $count['recently_created'] = $folders_count['recently_created']; 
			// $count['recently_updated'] = $folders_count['recently_updated']; 
		// }
		
		return $count ;
	}
	/**
	 * get
	 *
	 * Performs "get all the object for library form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array 
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get($data){

	
			
		$this->db->select('objects.library_folder_id as folder_id,objects.video_id, objects.library_object_id as object_id ,if(objects.file_type=5, "folder", "file") as type,objects.file, objects.file_name as title, objects.file_alt_name as alt_text,objects.file_image as file_image, objects.width,objects.height,objects.duration,objects.pages,objects.slug as url_slug');
		
	
		$this->db->select('`file` as thumbnail, objects.file_extension,objects.size,objects.modified_date,objects.created_date,objects.business_id,objects.status');
		$this->db->select('objects.modified_by');

		$this->db->select('objects.created_by');
		$this->db->select("objects.privacy_status");
		$this->db->select("objects.is_stock");

		$this->db->from($this->tbl_library_object." as objects");
		
	
		$this->db->where('objects.is_deleted','0');
		

		
 
		$this->db->where('objects.business_id',$data['business_id']);
		
		
		

		if($data['search']!=''){
			$this->db->like('objects.file_name',$data['search']);
		}
                
        if(!empty($data['file_type']) ){

			$this->db->where_in('objects.file_type',$data['file_type']);
		}
		
		if($data['type'] != 'folder' ){
			$this->db->where('objects.file_type !=',5);
		}
		if((string)$data['folder_id']!= ''){
			$this->db->where('objects.library_folder_id',$data['folder_id']);
		}
		
		$this->db->where('objects.status','1');
		
		
		$this->db->group_by(array("objects.library_object_id","objects.library_folder_id")); 
		
		//if($data['order_type'] == 'file_name'){$data['order_type'] = 'title'; }
		$this->db->order_by($data['order_type'], $data['order_by']);
		
		

		$query = $this->db->get();

		$result = $query->result_array();
		

		return $result ;
	}
	public function getFolderSize($folder_id){
		
		$this->db->select(' IFNULL(size, 0) AS size,library_object_id,, if(file_type=5, "folder", "file") as type');
		$this->db->where('library_folder_id',$folder_id);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$query = $this->db->get($this->tbl_library_object);
		$result = $query->result_array();
		$total_size = 0;
		//echo $this->db->last_query(); die;
		
		foreach($result as $row){
			if($row['type']=='folder'){
				$total_size += $this->getFolderSize($row['library_object_id']);
			}else{
				$total_size += $row['size'];
			}
		}
			
		return $total_size;
	}
	/**
	 * get_videos_count
	 *
	 * Performs "count all the object according to its type".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array 
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_videos_count($data){
		$yesterday_time = time()-(24*60*60);
		$select = 'count(*) as `all`';
		$this->db->select($select);
	   	if($data['search']!=''){
			$this->db->like('title',$data['search']);
		}
		$this->db->where('project_id !=','1');
		if($data['project_id']!=''){
			$this->db->where('project_id',$data['project_id']);
		}
		$this->db->where('business_id',$data['business_id']);
		$this->db->where('is_deleted','0');
		if($data['recent']!=''){
			if($data['recent'] == 'updated'){
				$this->db->where('modified_date >',$yesterday_time);
				$this->db->where('modified_date != created_date');
			}else{
				$this->db->where('created_date >',$yesterday_time);
			}
		}
		$query=	$this->db->get($this->video_videos);
		
		//echo $this->db->last_query(); die;
		$count= $query->row_array();
	
		$select = 'count(*) as `total`,count(if(created_date >= '.$yesterday_time.', 1, null)) as recently_created,count(if(modified_date >= '.$yesterday_time.' and modified_date !=  created_date, 1, null)) as recently_updated ';
		$this->db->select($select);
	   	if($data['search']!=''){
			$this->db->like('title',$data['search']);
		}
		$this->db->where('project_id !=','1');
		if($data['project_id']!=''){
			$this->db->where('project_id',$data['project_id']);
		}
		$this->db->where('business_id',$data['business_id']);
		$this->db->where('is_deleted','0');
		$query=	$this->db->get($this->video_videos);
		$countA = $query->row_array();
		$count = array_merge($count,$countA);
		return $count ;
	}
	/**
	 * get_videos
	 *
	 * Performs "get all the object for library form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array 
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	16-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_videos($data){
		$yesterday_time = time()-(24*60*60);
		$this->db->select('video.video_id,video.thumbnail,video.slug_folder,video.slug_smart,video.title,video.created_date,video.modified_date,video.created_by,video.modified_by,video.video_extention,file_size as size,duration,width,height');
		$this->db->from("$this->video_videos as video");
		// $this->db->join("$this->video_video_stat1 as stats","stats.video_id = video.video_id",'left');
		if($data['search']!=''){
			$this->db->like('video.title',$data['search']);
		}
		$this->db->where('video.project_id !=','1');
		$this->db->where('video.is_deleted','0');
		if($data['project_id']!=''){
			$this->db->where('video.project_id',$data['project_id']);
		}
		if($data['recent']!=''){
			if($data['recent'] == 'updated'){
				$this->db->where('video.modified_date >',$yesterday_time);
				$this->db->where('video.modified_date != video.created_date');
			}else{
				$this->db->where('video.created_date >',$yesterday_time);
			}
		}
		if( $data['limit']!='*'){
			$start =  $data['limit'] * ($data['current_page']-1); 
			$data['limit'] = (int)$data['limit'];
			$this->db->limit($data['limit'], $start);
		}
   		 $this->db->where('business_id',$data['business_id']);
		 $this->db->group_by('video.video_id');
		 if( isset($data['order_type']) && isset($data['order_by']) ){
			$this->db->order_by($data['order_type'], $data['order_by']);
		 }
		$query =  $this->db->get();
    	$result = $query->result_array();
		return $result ;
	}
	/**
	 * add_folder
	 *
	 * Performs "add folder into library in database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	17-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function slugify($text){
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	public function get_unique($slug){
		if(in_array($slug, $this->allocated_slug)){return false;}
		$this->db->where('slug',$slug);
		$this->db->where('business_id',$this->business_id);
		$query = $this->db->get('smart_library_objects');
		if($query->num_rows()){
			return false;
		}else{
			return true;
		}
	}
	public function create_slug($slug){
		$slug = $this->slugify($slug);
		if(!$this->get_unique($slug)){
			$slug = $this->create_slug($slug.rand(0,10000));
		}
		return $slug;
	}
	public function add_folder($data){
		$res = array('success'=>0, 'id'=>0);
		$data['slug'] = $this->create_slug($data['file_name']);
		$insert = $this->db->insert($this->tbl_library_folder,$data);
		//echo  $this->db->last_query(); die;
		if($insert){
			$res['success'] = 1;
			$res['id'] =  $this->db->insert_id();   
		}
		return $res;
	}
	/**
	 * check_folder_exist
	 *
	 * Performs "check the folder if exist or not".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	17-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function check_folder_exist($condition){
		$condition['is_deleted'] = '0';
		$condition['file_type'] = '5';
		$query = $this->db->get_where($this->tbl_library_folder,$condition);
		if($query->num_rows()){
			
			return true;
		}else{
			return false;
		}
	}
	/**
	 * delete_folder
	 *
	 * Performs "delete the exist folder from the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	19-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function delete_folder($condition){
		$this->db->where_in('library_object_id',$condition['folder_id']);
		$query = $this->db->get($this->tbl_library_folder);

		$purge_date = time()+DELETED_TIME;
		foreach($query->result_array() as $key=>$val){
			$title = explode("(Deleted",$val['file_name'])[0];
			$set = array('file_name'=>$title . ' (Deleted on '.date("d-m-Y").')','is_deleted'=>'1','deleted_date'=>time(),'purge_date'=>$purge_date,'slug'=>$val['slug'].'-'.$purge_date);
			$this->db->where('business_id',$val['business_id']);
			$this->db->where('library_object_id',$val['library_object_id']);
			$this->db->update($this->tbl_library_folder,$set);
		}
		return true;
		
	}
	/**
	 * get_folder
	 *
	 * Performs "get the folder and included objects from the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	19-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_folder($id){
		$this->db->select("folder.*");
		//$this->db->select("links.library_share_link_id as link_id,links.slug,links.expired_from,links.expired_to, links.meta_title, links.meta_description, links.meta_keyword, links.no_index,links.no_follow");
		//$this->db->select("user.first_name as first_name, user.last_name as last_name");
		//$this->db->select("count(share_user.library_share_link_id) as total_share");
		//$this->db->select('(select IFNULL(SUM(size),0) from '.$this->tbl_library_object.' where '.$this->tbl_library_object.'.library_folder_id = folder.library_object_id and '.$this->tbl_library_object.'.is_deleted = 0) as folder_size');
		$this->db->where('folder.library_object_id',$id);
		$this->db->where('folder.is_deleted','0');
		$this->db->from($this->tbl_library_folder." as folder");
		//$this->db->join($this->tbl_library_share_link.' as links', 'folder.library_object_id = links.library_object_id', 'left');
		//$this->db->join($this->tbl_library_share_user.' as share_user', 'links.library_share_link_id = share_user.library_share_link_id', 'left');
		//$this->db->join($this->saglus_users.' as user', 'folder.created_by = user.user_id', 'left');
		$query = $this->db->get();
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			$responce['success'] = 1;
			$responce['data'] = $query->row_array();
		}
		return $responce;
	}
	/**
	 * get_folder_title
	 *
	 * Performs "get the folder name from the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	19-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_folder_title($id){
		$this->db->select('file_name as title');
		$query = $this->db->get_where($this->tbl_library_folder,array('library_object_id'=>$id,'status'=>1,'is_deleted'=>'0'));
		$title = '';
		if($query->num_rows()){
			$row =  $query->row_array();
			$title = $row['title'];
		}
		return $title;
	}
	/**
	 * update_folder
	 *
	 * Performs "update the folder name into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	20-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function update_folder($condition ,$data){
		$this->db->where($condition);
		if($this->db->update($this->tbl_library_folder,$data)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * get_all_folders
	 *
	 * Performs "get all the folder from the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	22-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_all_folders($data){
		$data['is_deleted'] = '0';
		$data['file_type'] = '5';
		$this->db->select('*,file_name as title ,library_object_id as library_folder_id');
		$query = $this->db->get_where($this->tbl_library_folder,$data);
		return $query->result_array();
	}
	/**
	 * chk_folder_exist
	 *
	 * Performs "check the folder exist of not into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	integer
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	24-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function chk_folder_exist($data){
		$data['is_deleted'] = '0';
		$data['file_type'] = '5';
		$query = $this->db->get_where($this->tbl_library_folder,$data);
		return $query->num_rows();
	}
        
        /**
	 * chk_business_exist
	 *
	 * Performs "check the business exist of not into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	integer
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	27-05-2020	
	 * @modified_date 	:	27-05-2020	
	 * @modified_by 	:	Amarat
	 */
	public function chk_business_exist($data){ 
            $query = $this->db->get_where($this->tbl_smart_businesses,$data);
            return $query->num_rows();
	}
        
	/**
	 * add_object
	 *
	 * Performs "insert new object data into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	24-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function add_object($data){
		$res = array('success'=>0, 'id'=>0);
		$data['slug'] = $this->create_slug($data['file_name']);
		$insert = $this->db->insert($this->tbl_library_object,$data);
		if($insert){
			$res['success'] = 1;
			$res['id'] =  $this->db->insert_id();   
		}
		return $res;
	}
	/**
	 * update_object
	 *
	 * Performs "update the object data into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	25-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function update_object($condition ,$data){
		$this->db->where($condition);
		if($this->db->update($this->tbl_library_object,$data)){
			return true;
		}else{
			return false;
		}
	}

	public function update_object_status($id ,$data){
		$this->db->where('business_id', $this->business_id);
		$this->db->where_in('library_object_id', $id);

		if($this->db->update($this->tbl_library_object,$data)){
			return true;
		}else{
			return false;
		}
	}

	public function update_folder_status($id ,$data){
		$this->db->where('business_id', $this->business_id);
		$this->db->where_in('library_object_id', $id);

		// $this->db->update($this->tbl_library_folder,$data);

		// die(print_r($this->db->last_query()));

		if($this->db->update($this->tbl_library_folder,$data)){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * move_object
	 *
	 * Performs "move object from folder to folder update data of object into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	25-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function move_object($folder_id ,$business_id ,$object_id){
		$res = false;
		foreach($object_id as $id){
			$file = $this->get_file(array('library_object_id'=>$id));
			$title = $file['file_name'];
			$title = $this->object_title_generator($title,$folder_id,$business_id);
			$this->db->where('business_id',$business_id);
			$this->db->where('library_object_id',$id);
			if($this->db->update($this->tbl_library_object,array('library_folder_id'=>$folder_id,'file_name'=>$title))){
				$res = true;
			}
		}
		return true;
	}
        
        /**
	 * move_object
	 *
	 * Performs "move object from persnal mydrive to business drive update data of object into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Amarat
	 * @created_date 	:	26-05-2020	
	 * @modified_date 	:	26-05-2020	
	 * @modified_by 	:	Amarat
	 */
	public function move_object_to_business($transfer_business_id ,$current_business_id ,$object_id){
		$res = false;
		foreach($object_id as $id){
                    /*
			$file = $this->get_file(array('library_object_id'=>$id));
			$title = $file['file_name'];
			$title = $this->object_title_generator($title,$folder_id,$current_business_id);
                     * 
                     */
			$this->db->where('business_id',$current_business_id);
			$this->db->where('library_object_id',$id);
			//if($this->db->update($this->tbl_library_object,array('business_id'=>$move_business_id,'file_name'=>$title))){
			if($this->db->update($this->tbl_library_object,array('business_id'=>$transfer_business_id))){
				$res = true;
			}
		}
		return true;
	}
        
	/**
	 * delete_object
	 *
	 * Performs "delete object record  form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function delete_object($condition){
		
		if(isset($condition['folder_id'])){
			$this->db->where_in('library_folder_id',$condition['folder_id']);
		}
		$this->db->where_in('library_object_id',$condition['object_id']);
		$query = $this->db->get($this->tbl_library_object);
		$purge_date = time()+DELETED_TIME;
		foreach($query->result_array() as $key=>$val){
			$title = explode("(Deleted",$val['file_name'])[0];
			$set = array('file_name'=>$title.' (Deleted on "'.date($this->config->item('datetime_format')).'")','is_deleted'=>'1','deleted_date'=>time(),'purge_date'=>$purge_date,'slug'=>$val['slug'].'-'.$purge_date);
			$this->db->where('business_id',$val['business_id']);
			$this->db->where('library_object_id',$val['library_object_id']);
			$this->db->update($this->tbl_library_object,$set);
		}
		return true;
		
	}
	
	
	public function delete_object_not_uploaded($business_id){
		$set = array('is_deleted'=>'1','deleted_date'=>time());
		$this->db->where('business_id',$business_id);
		$this->db->where('status',0);
		$this->db->update($this->tbl_library_object,$set);
		return true;
	}



	   
	/**
	 * replace_delete_object
	 *
	 * Performs "replace delete object record  form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	15-01-2020	
	 * @modified_date 	:	15-01-2020	
	 * @modified_by 	:	Amarat
	 */
	public function replace_delete_object($condition){
		
		$this->db->where('library_object_id',$condition['new_object_id']);
		$this->db->where('business_id',$condition['business_id']);
		$query = $this->db->get($this->tbl_library_object);
		$row = $query->row_array();
		
		
		$set = array(
			'file' => $row['file'],
			'size' => $row['size'],
			'file_extension' => $row['file_extension'],
			'duration' => $row['duration'],
			'pages' => $row['pages'],
			'width' => $row['width'],
			'height' => $row['height'],
			'video_id' => $row['video_id'],
			'file_image' => '',
		);
		$this->db->where('library_object_id',$condition['object_id']);
		$this->db->where('business_id',$condition['business_id']);
		$this->db->update($this->tbl_library_object,$set);
		
		//echo $this->db->last_query();
			
		
		$this->db->where('business_id',$condition['business_id']);
		$this->db->where('library_object_id',$condition['new_object_id']);
		$this->db->delete($this->tbl_library_object);
		
		
		return true;
		
	}


	/**
	 * delete_object
	 *
	 * Performs "delete Video record  form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function delete_video($condition){
		if(isset($condition['folder_id'])){
			$this->db->where_in('library_folder_id',$condition['folder_id']);
		}
		$this->db->where_in('library_object_id',$condition['library_object_id']);
		$query = $this->db->get($this->tbl_library_object);
		$purge_date = time()+DELETED_TIME;
		foreach($query->result_array() as $key=>$val){
			$title = explode("(Deleted",$val['file_name'])[0];
			$set = array('file_name'=>$title.' (Deleted on "'.date($this->config->item('datetime_format')).'")','is_deleted'=>'1','deleted_date'=>time(),'purge_date'=>$purge_date);
			$this->db->where('business_id',$val['business_id']);
			$this->db->where('library_object_id',$val['library_object_id']);
			$this->db->update($this->tbl_library_object,$set);
		}
		return true;
	}
	/**
	 * copy_object
	 *
	 * Performs "copy object into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer 
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function copy_object($folder_id ,$business_id ,$object_id){
		$this->db->where('business_id',$business_id);
		$this->db->where_in('library_object_id',$object_id);
		if($this->db->update($this->tbl_library_object,array('library_folder_id'=>$folder_id))){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * get_object
	 *
	 * Performs "get object record into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer,string 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object($id,$status=true){
		$this->db->select("objects.*");
		$this->db->select("links.library_share_link_id as link_id,links.slug,links.expired_from,links.expired_to, links.meta_title, links.meta_description, links.meta_keyword, links.no_index,links.no_follow");
		$this->db->select("user.first_name as first_name, user.last_name as last_name");
		$this->db->select("count(share_user.library_share_link_id) as total_share");
		$this->db->where('objects.library_object_id',$id);
		if($status){
			$this->db->where('objects.is_deleted','0');
		}
		$this->db->from($this->tbl_library_object." as objects");
		$this->db->join($this->tbl_library_share_link.' as links', 'objects.library_object_id = links.library_object_id', 'left');
		$this->db->join($this->tbl_library_share_user.' as share_user', 'links.library_share_link_id = share_user.library_share_link_id', 'left');
		$this->db->join($this->saglus_users.' as user', 'objects.created_by = user.user_id', 'left');
		$query = $this->db->get();
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			$responce['success'] = 1;
			$responce['data'] = $query->row_array();
		}
		return $responce;
	}
	/**
	 * get_object
	 *
	 * Performs "get object record into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer,string 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_video($id,$status=true){
		$this->db->select('video.business_id,video.video_id,video.thumbnail,video.slug_folder,video.slug_smart,video.title,video.video_extention,file_size,duration,width,height');
		$this->db->from("$this->video_videos as video");
		// $this->db->join("$this->video_video_stat1 as stats","stats.video_id = video.video_id",'left');
		$this->db->where('video.video_id',$id);
		if($status){$this->db->where('video.is_deleted','0'); }
		$query =  $this->db->get();
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			$responce['success'] = 1;
			$responce['data'] = $query->row_array();
		}
		return $responce;
	}
	/**
	 * check_object_exist
	 *
	 * Performs "check object existance into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	27-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function check_object_exist($condition){
		$condition['is_deleted'] = '0';
		$query = $this->db->get_where($this->tbl_library_object,$condition);
		if($query->num_rows()){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * get_share_link
	 *
	 * Performs "get the object share link form database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	27-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_share_link($data){
		$query = $this->db->get_where($this->tbl_library_share_link,$data);
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			$responce['success'] = 1;
			$responce['data'] = $query->row_array();
		}
		return $responce;
	}
	/**
	 * create_share_link
	 *
	 * Performs "create share link and insert into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	29-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function create_share_link($data){
		$res = array('success'=>0, 'id'=>0);
		$insert = $this->db->insert($this->tbl_library_share_link,$data);
		if($insert){
			$res['success'] = 1;
			$res['id'] =  $this->db->insert_id();   
		}
		return $res;
	}
	/**
	 * update_share_link
	 *
	 * Performs "update_share_link share link into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	29-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function update_share_link($condition ,$data){
		$this->db->where($condition);
		if($this->db->update($this->tbl_library_share_link,$data)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * chk_share_link_exist
	 *
	 * Performs "check share link already existance into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	true and false
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	29-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function chk_share_link_exist($data){
		$query = $this->db->get_where($this->tbl_library_share_link,$data);
		if($query->num_rows()){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * generate_unique_link
	 *
	 * Performs "generate the unique slug link of object".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	.....
	 * @return			: 	string
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	29-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function generate_unique_link(){
		$this->load->helper('string');
		$slug = random_string('alnum',20);
		if($this->chk_share_link_exist(array('slug'=>$slug,'status'=>1))){
			$this->generate_unique_link();
		}
		return $slug;
	}
	/**
	 * insert_share_user
	 *
	 * Performs "insert the share object user information into database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	30-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function insert_share_user($data){
		$res = array('success'=>0, 'id'=>0);
		$insert = $this->db->insert($this->tbl_library_share_user,$data);
		if($insert){
			$res['success'] = 1;
			$res['id'] =  $this->db->insert_id();   
		}
		return $res;
	}
	/**
	 * get_share_folder_object
	 *
	 * Performs "get share folder object information from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	30-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_share_folder_object($id){
		$this->db->select('objects.library_object_id as object_id,objects.file_type,objects.file,objects.file_name,objects.file_extension,objects.size,objects.privacy_status,status.option_value as privacy,links.slug,links.expired_from,links.expired_to');
		$this->db->from($this->tbl_library_object.' as objects');
		$this->db->join($this->tbl_library_share_link.' as links', 'objects.library_object_id= links.library_object_id');
		$this->db->join('smart_status_master as status','objects.privacy_status = status.option_key','left');	
		$this->db->where(array(
			'objects.library_folder_id' => $id,
			'objects.is_deleted' => 0,
			'objects.status' => 1,
			'objects.privacy_status !=' => 1,
			'links.status' => 1,
			'status.domain_name'=>'privacy_status',
			
		));
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $data = $query->result_array();
	}
	/**
	 * get_object_id_by_folder
	 *
	 * Performs "get objects id's by folder id from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	30-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_id_by_folder($id){
		if($id == '0'){return array();}
		$this->db->select('library_object_id as id,file_type');
		$this->db->from($this->tbl_library_object);
		$this->db->where('library_folder_id',$id);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$query = $this->db->get();
		$result = $query->result_array();
		
		$rows = $result;
		foreach($rows as $row){
			if($row['file_type'] == '5'){
				$myrow = $this->get_object_id_by_folder($row['id']);
				if(!empty($myrow)){
					$result = array_merge($result,$myrow);
				}
			}
		}
		return $result;
		 
	}
	public function get_object_tree_folder($id){
		if($id == '0'){return array();}
		$this->db->select('library_object_id as id,file_type,if(file_type=5, "folder", "file") as type,file_name as title');
		$this->db->from($this->tbl_library_object);
		$this->db->where('library_folder_id',$id);
		$this->db->where('is_deleted','0');
		$this->db->where('status','1');
		$query = $this->db->get();
		$result = $query->result_array();
		
		foreach($result as $key=>$row){
			if($row['type'] == 'folder'){
				$myrow = $this->get_object_tree_folder($row['id']);
				$result[$key]['inside'] = $myrow;
				
			}
		}
		return $result;
		 
	}
	/**
	 * get_file
	 *
	 * Performs "get file information from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	31-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_file($condition){
		$this->db->select('file,file_name,file_type,file_extension,video_id,business_id');
		$this->db->from($this->tbl_library_object);
		//$condition['is_deleted'] = '0';
		$this->db->where($condition);
		$query = $this->db->get();
		$file = array('file'=>'','file_name'=>'','file_type'=>0,'file_extension'=>'');
		if($query->num_rows()){
			$file = $query->row_array();
			if($file['file_type'] == '2'){
				$video_data = $this->get_video($file['video_id']);
            	$file['file_extension'] = $video_data['data']['video_extention'];
			}
		}
		return $file;
	}
	/**
	 * get_object_password
	 *
	 * Performs "get the specific object password from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	31-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_password($condition){
		$password = '';
		if($condition['type'] == 'folder'){
			$this->db->select('password');
			$this->db->from($this->tbl_library_folder);
			$condition_folder = array('business_id'=>$condition['business_id'],'library_folder_id'=>$condition['id'],'is_deleted'=>'0');
			$this->db->where($condition_folder);
			$query = $this->db->get();
			if($query->num_rows()){
				$row = $query->row_array();
				$password = $row['password'];
			}
		}else{
			$this->db->select('password');
			$this->db->from($this->tbl_library_object);
			$condition_object = array('business_id'=>$condition['business_id'],'library_object_id'=>$condition['id'],'is_deleted'=>'0');
			$this->db->where($condition_object);
			$query = $this->db->get();
			if($query->num_rows()){
				$row = $query->row_array();
				$password = $row['password'];
			}
		}
		return $password;
	}
	/**
	 * get_object_id
	 *
	 * Performs "get object id and data by parameter from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	31-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_id($data){
		
		$yesterday_time = time()-(24*60*60);
		// $this->db->select('"folder" as type,library_folder_id as id,library_folder_id as folder_id, title,"folder" as file_type');
		// $this->db->select('status,business_id,modified_date,created_date');
		// $this->db->from($this->tbl_library_folder);
		// $this->db->where('library_folder_id.is_deleted','0');
		// $query1 = $this->db->get_compiled_select(); 
	
		$this->db->select('if(file_type=5, "folder", "file") as type,library_object_id as id ,library_folder_id as folder_id, file_name as title');
		$this->db->select('(select option_value from smart_status_master where domain_name="file_type" and option_key = file_type and status = 1) as `file_type`');
		$this->db->select('library_object_id,business_id,modified_date,created_date');
		$this->db->from($this->tbl_library_object);
		$this->db->where('folder.is_deleted','0');
		
		//$query2 = $this->db->get_compiled_select(); 
		//$this->db->select("");
		//$this->db->from('(('.$query1.') UNION ('.$query2.')) as listing');
		
		if($data['search']!=''){
			$this->db->like('file_name',$data['search']);
		}
		
		if($data['file_type']!='' && $data['folder_id']=='0'){
			$this->db->where('file_type',$data['type']);
		}
		
		
		
		if($data['file_type']!=''){
			$this->db->where('file_type',$data['type']);
		}else{
			$select = array();
			if(!$data['select']['all']){
				foreach($data['select'] as $key=>$val){
					if($val){
						$select[] = $key;
					}	
				}
			}
			if(!empty($select)){
				$this->db->where_in('file_type ', $select);
			}
		}
		// if($data['type'] == 'folder' ){
			// if($data['folder_id'] == '0'){
				// $this->db->where('type','folder');
			// }else{
				// $this->db->where('type','file');
				// if($data['folder_id'] == ''){ $data['folder_id'] = 0;}
				// $this->db->where('folder_id',$data['folder_id']);
			// }
		// }else{
			// if($data['folder_id']!=''){
				// $this->db->where('folder_id',$data['folder_id']);
			// }
			// $this->db->where('type','file');
		// }
		if($data['type'] != 'folder' ){
			$this->db->where('type','file');
		}
		if($data['folder_id'] > 0){
			$this->db->where('folder_id',$data['folder_id']);
		}
		$this->db->where('business_id',$data['business_id']);
		$data['date_range'] = array();
		if(count($data['date_range'])) {
			$this->db->group_start();
			foreach($data['date_range'] as $key=>$range){
				if($key){
					if($range['gate'] == 'or'){
						$this->db->or_group_start();
					}else{
						$this->db->group_start();
					}
				}else{
					$this->db->group_start();
				}
				if($range['title'] == 'updated'){
					$this->db->where('modified_date >=',$range['from']);
					$this->db->where('modified_date <=',$range['to']);
				}
				else if($range['title'] == 'uploaded'){
					$this->db->where('created_date >=',$range['from']);
					$this->db->where('created_date <=',$range['to']);
				}
				else{
					$this->db->where('folder_id',$range['value']);
				}
				$this->db->group_end();
				
			}
			$this->db->group_end();
		}
		if($data['recent']!=''){
			if($data['recent'] == 'updated'){
				$this->db->where('modified_date >',$yesterday_time);
			}else{
				$this->db->where('created_date >',$yesterday_time);
			}
		}
		$query=	$this->db->get();
		return $query->result_array();
	}
	/**
	 * object_title_generator
	 *
	 * Performs "generat object title from database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	31-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function object_title_generator($title,$folder_id,$business_id,$count=0,$repeat=false){		
		$title = explode(' - copy',$title)[0];
		if($repeat){
			$rows = $count;
		}else{
			$this->db->select('file_name');
			$this->db->like('file_name',$title,'after');
			$this->db->where('library_folder_id',$folder_id);
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$query = $this->db->get('smart_library_objects');
			$rows = $query->num_rows();
		}
		if($rows > 0){
			$title = explode(' - copy',$title)[0];
			$title .= ' - copy('.$rows.')';
		}
		//$this->db->where('library_folder_id',$folder_id);
		$this->db->where('file_name',$title);
		$this->db->where('business_id',$business_id);
		$this->db->where('is_deleted','0');
		$this->db->where('library_folder_id',$folder_id);
		$query = $this->db->get('smart_library_objects');
		
		if($query->num_rows()){
			$rows++;
			$title = $this->object_title_generator($title,$folder_id,$business_id,$rows,true);
		}
	   //echo $title; die;
	   return $title;
   }
   
    public function update_object_seo($condition,$data){
		$this->db->where($condition);
		if($this->db->update($this->tbl_library_share_link,$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function getApiCredentials($data){
		$this->db->where('business_id',$data['business_id']);
		$this->db->where('type',$data['type']);
		$this->db->where('integration_id',$data['integration_id']);
		$query = $this->db->get('smart_business_integrations'); 
		if($query->num_rows()){
			$res['status'] = 'success';
			$res['data'] = $query->row_array(); 
		}else{
			$res['status'] = 'error';
			$res['data'] = '';
		}
		return $res;
	}
	
	/**
	 * get_object_related
	 *
	 * Performs "get object related record into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer,string 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_object_related($file_type,$business_id,$not_in_id){
		$this->db->select("objects.file_name as title, objects.file, objects.file_type as file_type,links.slug,objects.business_id,objects.library_object_id");
		$this->db->where('objects.file_type',$file_type);
		$this->db->where('objects.business_id',$business_id);
		$this->db->where('objects.is_deleted',0);
		$this->db->where('objects.privacy_status !=',1);
		$this->db->where('objects.library_object_id !=',$not_in_id);
		$this->db->from($this->tbl_library_object." as objects");
		$this->db->join($this->tbl_library_share_link.' as links', 'objects.library_object_id = links.library_object_id', 'left');
		$query = $this->db->get();
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			return $query->result_array();
		}
		return false;
	}
	/**
	 * get_object_related
	 *
	 * Performs "get object related record into the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	integer,string 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	26-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_folder_related($business_id,$not_in_id){
		$this->db->select("folder.title,links.slug,folder.business_id,folder.library_folder_id");
		$this->db->where('folder.business_id',$business_id);
		$this->db->where('folder.is_deleted',0);
		$this->db->where('folder.privacy_status !=',1);
		$this->db->where('folder.library_folder_id !=',$not_in_id);
		$this->db->from($this->tbl_library_folder." as folder");
// 		$this->db->join($this->tbl_library_share_link.' as links', 'folder.library_folder_id = links.library_folder_id', 'left');
		$query = $this->db->get();
		$responce = array('success'=>0,'data'=>array());
		if($query->num_rows()){
			return $query->result_array();
		}
		return false;
	}
	
	/**
	 * get_folder
	 *
	 * Performs "get the folder and included objects from the database".
	 * It's related to all the smart Library in saglus smart
	 *
	 * @param			:	associate array 
	 * @return			: 	array
	 *
	 * @author		 	:	Firoz
	 * @created_date 	:	19-05-2018	
	 * @modified_date 	:	14-06-2018	
	 * @modified_by 	:	Firoz
	 */
	public function get_folder_files_counts($id,$business_id){
		$this->db->select('count(*) as `all`,count(if(file_type=0, 1, null)) as other,count(if(file_type=1, 1, null)) as image,count(if(file_type=2, 1, null)) as video,count(if(file_type=3, 1, null)) as document,count(if(file_type=4, 1, null)) as audio, "0" as folder ');
		$this->db->where('library_folder_id',$id);
		$this->db->where('status','1');
		$this->db->where('is_deleted','0');
		$this->db->where('privacy_status !=','1');
		$this->db->where('business_id',$business_id);
		$query=	$this->db->get($this->tbl_library_object);
		$count= $query->row_array();
		return $count;
	
	}



/**
	 * Analytics of Library Module Section 
	 *
	 * @modified_by 	:	Firoz
	 */
	function basic_report($business_id){
		$this->db->select("COUNT(visitor_session_id) as total_visitors");
		$this->db->select("COUNT(distinct (visitor_id)) as  unique_visitors");
		$this->db->from('smart_library_object_visitors');
		$this->db->where('business_id',$business_id);
		//$this->set_where();
		$this->db->where('library_object_id',$this->input->get('object_id'));	
		$this->set_dates('smart_library_object_visitors');
		$query = $this->db->get();
		$data =  $query->row_array();	
		if($data){
			return $data;
		}else{
			return array('total_visitors'=>0,'unique_visitors'=>0);
		}
	}


	function like_dislike(){
		$this->db->select("COUNT(if(status = '1', status, null)) as likes");
		$this->db->select("COUNT(if(status = '-1', status, null)) as dislikes");
		$this->db->from('smart_library_objects_likes');
		// $this->db->where('user_id',$this->user_id);
		$this->db->where('library_object_id',$this->input->get('object_id'));
		$this->set_dates('smart_library_objects_likes');
		$query = $this->db->get();
		$data =  $query->row_array();	
		if($data){
			return $data;
		}else{
			return array('likes'=>0,'dislikes'=>0);
		}
	}

	function traffic_report($business_id){
		$this->db->select("from_unixtime(created,'".$this->get_date_formate()."') as new_date");
		$this->db->select("COUNT(visitor_session_id) as visitors");
		$this->db->select("COUNT(distinct (visitor_id)) as  unique_visitors");
		$this->db->where('business_id',$business_id);
		$this->db->where('library_object_id',$this->input->get('object_id'));	
		$this->db->where('is_deleted != ',1,FALSE);
		//$this->set_where();
		$this->set_dates('smart_library_object_visitors');
		$this->db->group_by('new_date');
		$query = $this->db->get('smart_library_object_visitors');
		return $query->result_array();	
	}


	function operating_system_report($business_id){
		$this->db->select("smart_visitors.operating_system_id as operating_system_id");
		$this->db->select("COUNT(smart_library_object_visitors.visitor_session_id) as visitors");
		$this->db->select("COUNT(distinct (smart_library_object_visitors.visitor_id)) as  unique_visitors");
		$this->db->select("COUNT(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','left');
		
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		$this->set_dates('smart_library_object_visitors');

		$this->db->group_by('smart_visitors.operating_system_id');
		$query 	= $this->db->get();
		//die(print_r($this->db->last_query()));

		$query = $this->db->last_query();
		$this->db->select("id as operating_system_id, title");
		$this->db->select("visitors,unique_visitors,known_visitors");
		$this->db->join('('.$query.') as t','t.operating_system_id = smart_operating_systems.id','Left');
		$this->db->order_by('id');
		$query = $this->db->get('smart_operating_systems');
		
		//die(print_r($this->db->last_query()));

		$output['data'] = $query->result_array();	
		return $output;	
	}

	function browser_report($business_id){
		$this->db->select("smart_visitors.browser_id as browser_id,
		count(smart_library_object_visitors.visitor_id) as visitors,
		count(distinct(smart_library_object_visitors.visitor_id)) as unique_visitors,
		count(distinct (if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		$this->set_dates('smart_library_object_visitors');

		$this->db->group_by('smart_visitors.browser_id');
		$query 	= $this->db->get();

		$query = $this->db->last_query();
		$this->db->select("id as browser_id, title");
		$this->db->select("visitors,unique_visitors,known_visitors");
		$this->db->join('('.$query.') as t','t.browser_id = smart_browsers.id','Left');
		$this->db->order_by('id');
		$query = $this->db->get('smart_browsers');

		$output['data'] = $query->result_array();	
		return $output;
	}


	function device_report($business_id){
		$this->db->select("smart_visitors.device_id as device_id,
		count(smart_library_object_visitors.visitor_id) as visitors,
		count(distinct(smart_library_object_visitors.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','left');
		//$this->db->join('smart_devices','device_id = smart_devices.id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		$this->set_dates('smart_library_object_visitors');

		$this->db->group_by('smart_visitors.device_id');
		$query 	= $this->db->get();

		$query = $this->db->last_query();
		$this->db->select("id as device_id, title");
		$this->db->select("visitors,unique_visitors,known_visitors");
		$this->db->join('('.$query.') as t','t.device_id = smart_devices.id','Left');
		$this->db->order_by('id');
		$query = $this->db->get('smart_devices');

		$output['data'] = $query->result_array();	
		return $output;
	}



	function location_report($business_id){
		$this->db->select("smart_visitor_sessions.country_id as country_id, 
		smart_countries.country_name as title,
		count(smart_visitor_sessions.country_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		
		
		$this->db->join('smart_countries','smart_visitor_sessions.country_id = smart_countries.id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		
		if($this->input->get('country_ids')){
			$this->db->where_in('country_id',explode(',',$this->input->get('country_ids')));
		}
		
		$this->set_dates('smart_library_object_visitors');

		$this->db->order_by('unique_visitors','desc');
		$this->db->limit(11,0);
		
		$this->db->group_by('smart_visitor_sessions.country_id');
		$query 	= $this->db->get();
		
		$result1 = $query->result_array();
		
		
		if($this->input->get('country_ids')){
			return $result1;
		}
		if($query->num_rows()<11){
			return $result1;
		}else{
			array_pop($result1);
			$country_ids = array_column($result1,'country_id');
		}
		
		
		$this->db->select("0 as country_id,'others' as title,
		count(smart_visitor_sessions.country_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		if(!empty($country_ids)){
			$this->db->where_not_in('smart_visitor_sessions.country_id',$country_ids);
		}
		$this->set_dates('smart_library_object_visitors');
		$query = $this->db->get('smart_library_object_visitors');
		$result2 = $query->result_array();
	
		return array_merge($result1,$result2);  
	}


	function location_report_country($business_id){
		$this->db->select("smart_visitor_sessions.state_id as state_id, 
		smart_states.state_name as title,
		count(smart_visitor_sessions.state_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		$this->db->join('smart_states','state_id = smart_states.id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();

		if($this->input->get('country_ids')){
			$this->db->where('smart_visitor_sessions.country_id',$this->input->get('country_ids'));
		}

		if($this->input->get('state_ids')){
			$this->db->where('smart_visitor_sessions.state_id',$this->input->get('state_ids'));
		}
		
		$this->set_dates('smart_library_object_visitors');

		$this->db->order_by('unique_visitors','desc');
		$this->db->limit(11,0);
		
		$this->db->group_by('smart_visitor_sessions.state_id');
		$query 	= $this->db->get();
		
		$result1 = $query->result_array();

		
		
		if($this->input->get('state_ids')){
			return $result1;
		}
		if($query->num_rows()<11){
			return $result1;
		}else{
			array_pop($result1);
			$state_ids = array_column($result1,'state_id');
		}	
		
		
		$this->db->select("0 as state_id,'others' as title,
		count(smart_visitor_sessions.state_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();
		
		if($this->input->get('country_ids')){
			$this->db->where_in('smart_visitor_sessions.country_id',explode(',',$this->input->get('country_ids')));
		}

		if(!empty($state_ids)){
			$this->db->where_not_in('smart_visitor_sessions.state_id',$state_ids);
		}

		
		$this->set_dates('smart_library_object_visitors');
		$query = $this->db->get('smart_library_object_visitors');
		$result2 = $query->result_array();

		return array_merge($result1,$result2);
	}


	function location_report_state($business_id){
		$this->db->select("smart_visitor_sessions.city_id as city_id, 
		smart_cities.city_name as title,
		count(smart_visitor_sessions.city_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");

		$this->db->from('smart_library_object_visitors');
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		$this->db->join('smart_cities','city_id = smart_cities.id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();

		if($this->input->get('country_ids')){
			$this->db->where_in('smart_visitor_sessions.country_id',explode(',',$this->input->get('country_ids')));
		}
		if($this->input->get('state_ids')){
			$this->db->where_in('smart_visitor_sessions.state_id',explode(',',$this->input->get('state_ids')));
		}
		if($this->input->get('city_ids')){
			$this->db->where_in('smart_visitor_sessions.city_id',explode(',',$this->input->get('city_ids')));
		}	

		$this->set_dates('smart_library_object_visitors');

		$this->db->order_by('unique_visitors','desc');
		$this->db->limit(11,0);
		
		$this->db->group_by('smart_visitor_sessions.city_id');
		$query 	= $this->db->get();
		
		$result1 = $query->result_array();
		

		
		if($this->input->get('city_ids')){
			return $result1;
		}
		if($query->num_rows()<11){
			return $result1;
		}else{
			array_pop($result1);
			$city_ids = array_column($result1,'city_id');
		}	
		
		
		$this->db->select("0 as city_id,'others' as title,
		count(smart_visitor_sessions.city_id) as visitors,
		count(distinct(smart_visitor_sessions.visitor_id)) as unique_visitors,
		count(distinct(if(smart_visitors.contact_id > 0, smart_visitors.contact_id, null))) as known_visitors");
		$this->db->join('smart_visitors','smart_library_object_visitors.visitor_id = smart_visitors.visitor_id','Left');
		$this->db->join('smart_visitor_sessions','smart_library_object_visitors.visitor_session_id = smart_visitor_sessions.visitor_session_id','Left');
		$this->db->where('smart_library_object_visitors.is_deleted != ',1,FALSE);
		$this->db->where('smart_library_object_visitors.library_object_id',$this->input->get('object_id'));
		$this->db->where('smart_library_object_visitors.business_id',$business_id);
		//$this->set_where();

		if($this->input->get('country_ids')){
			$this->db->where_in('smart_visitor_sessions.country_id',explode(',',$this->input->get('country_ids')));
		}
		 if($this->input->get('state_ids')){
			$this->db->where_in('smart_visitor_sessions.state_id',explode(',',$this->input->get('state_ids')));
		} 

		if(!empty($city_ids)){
			$this->db->where_not_in('smart_visitor_sessions.city_id',$city_ids);
		}	

	
		$this->set_dates('smart_library_object_visitors');
		$query = $this->db->get('smart_library_object_visitors');
		$result2 = $query->result_array();

		return array_merge($result1,$result2); 
	}


	function set_where(){
		if($this->input->get('library_folder_id')){
			$this->db->where('library_folder_id',$this->input->get('library_folder_id'));
		}
		if($this->input->get('object_id')){
			$this->db->where('library_object_id',$this->input->get('object_id'));	
		}
	}


	function set_dates($table = 'smart_library_object_visitors'){
		if($this->input->get('date_start')){
			$this->db->where($table.'.created >=', $this->input->get('date_start'));
		}
		if($this->input->get('date_end')){
			$this->db->where($table.'.created <=', $this->input->get('date_end'));
		}
	}

	function get_date_formate(){		
		$time_interval = $this->input->post('time_interval') ? $this->input->post('time_interval') : 'daywise';
		$date_formate = [
							'daywise' 	=> '%Y-%m-%d',
							'weekwise' 	=> '%X-%V',
							'monthwise' => '%Y-%m-01',
						];
		return $date_formate[$time_interval];
	}



	public function row($table_name, $fields, $where){
		$this->db->select($fields);
		$this->db->where($where);
		$query=$this->db->get($table_name);
		$row = $query->row_array();					
		return $row;
	}


	function countries(){
		$this->db->select("*");
		$query = $this->db->get('smart_countries');
		return $query->result_array();
	}

	function states($country_id){
		$this->db->select("*");
		$this->db->where("country_id",$country_id);
		$query = $this->db->get('smart_states');
		return $query->result_array();
	}
	
	function cities($state_id){
		$this->db->select("*");
		$this->db->where("state_id",$state_id);
		$query = $this->db->get('smart_cities');
		return $query->result_array();
	}


	function country_name($country_id){
		$this->db->select("country_name");
		$this->db->where('id',$country_id);
		$query = $this->db->get('smart_countries');
		return $query->row_array();
	}


	function mydrive_dashboard_data($business_id,$start_date,$end_date,$slug){
		if($slug == 'all_files_uploaded'){
			$this->db->select("COUNT(library_object_id) as all_files_uploaded");
			$this->db->from('smart_library_objects');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'images_uploaded'){
			$this->db->select("COUNT(library_object_id) as images_uploaded");
			$this->db->from('smart_library_objects');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('file_type','1');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'video_uploaded'){
			$this->db->select("COUNT(library_object_id) as video_uploaded");
			$this->db->from('smart_library_objects');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('file_type','2');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'documents_uploaded'){
			$this->db->select("COUNT(library_object_id) as documents_uploaded");
			$this->db->from('smart_library_objects');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('file_type','3');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'audio_uploaded'){
			$this->db->select("COUNT(library_object_id) as audio_uploaded");
			$this->db->from('smart_library_objects');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('file_type','4');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'folder_created'){
			$this->db->select("COUNT(library_folder_id) as folder_created");
			$this->db->from('smart_library_folders');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			$this->db->where('status','1');
			if($start_date){
				$this->db->where('created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('created_date <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'folder_shared'){
			$this->db->select("*");
			$this->db->join('smart_library_share_links', 'smart_library_share_links.library_folder_id = smart_library_folders.library_folder_id', 'left');
			$this->db->join('smart_library_share_users', 'smart_library_share_users.library_share_link_id = smart_library_share_links.library_share_link_id', 'left');
			$this->db->where('smart_library_folders.business_id',$business_id);
			$this->db->where('smart_library_folders.is_deleted','0');
			$this->db->where('smart_library_folders.status','1');
			$this->db->where('smart_library_share_links.library_folder_id !=','0');
			if($start_date){
				$this->db->where('smart_library_share_users.created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('smart_library_share_users.created_date <=', $end_date);
			}
			$this->db->group_by('smart_library_share_users.library_share_user_id'); 
			$query=$this->db->get('smart_library_folders');
			return array('folder_shared'=>$query->num_rows());
			
			
			/* $this->db->select("*");
			$this->db->join('smart_library_share_links', 'smart_library_share_links.library_folder_id = smart_library_objects.library_folder_id', 'left');
			$this->db->join('smart_library_share_users', 'smart_library_share_users.library_share_link_id = smart_library_share_links.library_share_link_id', 'left');
			$this->db->where('smart_library_objects.business_id',$business_id);
			$this->db->where('smart_library_objects.is_deleted','0');
			$this->db->where('smart_library_objects.status','1');
			$this->db->where('smart_library_share_links.library_folder_id !=','0');
			if($start_date){
				$this->db->where('smart_library_share_users.created_date >=', $start_date);
			}
			if($end_date){
				$this->db->where('smart_library_share_users.created_date <=', $end_date);
			}
			$this->db->group_by('smart_library_share_links.library_share_link_id'); 
			$query=$this->db->get('smart_library_objects');
			return array('folder_shared'=>$query->num_rows()); */
		}else if($slug == 'all_visitors'){
			$this->db->select("COUNT(visitor_session_id) as all_visitors");
			$this->db->from('smart_library_object_visitors');
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			if($start_date){
				$this->db->where('created >=', $start_date);
			}
			if($end_date){
				$this->db->where('created <=', $end_date);
			}
			$query = $this->db->get();
			return $query->row_array();
		}else if($slug == 'all_documents_visitors'){
			$this->db->select("COUNT(smart_library_object_visitors.library_object_id) as all_documents_visitors");
			$this->db->join('smart_library_objects', 'smart_library_objects.library_object_id = smart_library_object_visitors.library_object_id', 'left');
			$this->db->where('smart_library_objects.business_id',$business_id);
			$this->db->where('smart_library_objects.is_deleted','0');
			$this->db->where('smart_library_objects.file_type','3');
			$this->db->where('smart_library_objects.status','1');
			if($start_date){
				$this->db->where('created >=', $start_date);
			}
			if($end_date){
				$this->db->where('created <=', $end_date);
			}
			$query=$this->db->get('smart_library_object_visitors');
			return $query->row_array();
		}else if($slug == 'all_image_visitors'){
			$this->db->select("COUNT(smart_library_object_visitors.library_object_id) as all_image_visitors");
			$this->db->join('smart_library_objects', 'smart_library_objects.library_object_id = smart_library_object_visitors.library_object_id', 'left');
			$this->db->where('smart_library_objects.business_id',$business_id);
			$this->db->where('smart_library_objects.is_deleted','0');
			$this->db->where('smart_library_objects.file_type','1');
			$this->db->where('smart_library_objects.status','1');
			if($start_date){
				$this->db->where('created >=', $start_date);
			}
			if($end_date){
				$this->db->where('created <=', $end_date);
			}
			$query=$this->db->get('smart_library_object_visitors');
			return $query->row_array();
		}else if($slug == 'all_folder_visitors'){
			$this->db->select("count(if(smart_library_object_visitors.library_folder_id > 0, smart_library_object_visitors.library_folder_id, null)) as all_folder_visitors");
			$this->db->where('business_id',$business_id);
			$this->db->where('is_deleted','0');
			if($start_date){
				$this->db->where('created >=', $start_date);
			}
			if($end_date){
				$this->db->where('created <=', $end_date);
			}
			$query=$this->db->get('smart_library_object_visitors');
			return $query->row_array();

			/* $this->db->select("COUNT(smart_library_object_visitors.library_folder_id) as all_folder_visitors");
			$this->db->join('smart_library_objects', 'smart_library_objects.library_folder_id = smart_library_object_visitors.library_folder_id', 'left');
			$this->db->where('smart_library_objects.business_id',$business_id);
			$this->db->where('smart_library_objects.is_deleted','0');
			$this->db->where('smart_library_objects.status','1');
			if($start_date){
				$this->db->where('created >=', $start_date);
			}
			if($end_date){
				$this->db->where('created <=', $end_date);
			}
			$query=$this->db->get('smart_library_object_visitors');
			return $query->row_array(); */
		}

	}


	public function add_like_dislike($id, $status, $type, $user_id){
		$res = $this->add_like_dislike_restriction($id, $type, $user_id);
		if($res == 1){
			return 'false';
		}

		$data = array(
			'user_id' => $user_id,
			'status' => $status,
			'created' => time()
		);

		if($type== 'folder'){
			$data['library_folder_id'] = $id;
		}else{
			$data['library_object_id'] = $id;
		}
		
		$this->db->insert('smart_library_objects_likes', $data);
		return $this->db->insert_id();
	 }
	 

	 public function add_like_dislike_restriction($id, $type, $user_id){
		$this->db->select();
		$this->db->from('smart_library_objects_likes');
		if($type== 'folder'){
			$this->db->where('library_folder_id',$id);
		}else{
			$this->db->where('library_object_id',$id);
		}
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->num_rows();
	 }


	function get_like_dislike_details($id, $type){
		$this->db->select("COUNT(if(status = '1', status, null)) as likes");
		$this->db->select("COUNT(if(status = '-1', status, null)) as dislikes");
		$this->db->from('smart_library_objects_likes');
		if($type== 'folder'){
			$this->db->where('library_folder_id',$id);
		}else{
			$this->db->where('library_object_id',$id);
		}
		$query = $this->db->get();
		$data =  $query->row_array();	
		if($data){
			return $data;
		}else{
			return array('likes'=>0,'dislikes'=>0);
		}
	}

	function get_like_dislike_condition($id, $type, $user_id){
		$this->db->select("status");
		$this->db->from('smart_library_objects_likes');
		if($type== 'folder'){
			$this->db->where('library_folder_id',$id);
		}else{
			$this->db->where('library_object_id',$id);
		}
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return  $query->row_array();
	}

	function get_views_count($id, $type){
		$this->db->select("COUNT(object_visitor_id) as views");
		$this->db->from('smart_library_object_visitors');
		$this->db->where('is_deleted','0');
		if($type== 'folder'){
			$this->db->where('library_folder_id',$id);
		}else{
			$this->db->where('library_object_id',$id);
		}
		$query = $this->db->get();
		$data =  $query->row_array();	
		if($data){
			return $data;
		}else{
			return array('views'=>0);
		}
	}


	public function add_visitors($business_id, $visitor_id, $visitor_session_id, $id, $type){
		$data = array(
			'business_id' => $business_id,
			'visitor_id' => $visitor_id,
			'visitor_session_id' => $visitor_session_id,
			'created' => time()
		);

		if($type== 'folder'){
			$data['library_folder_id'] = $id;
		}else{
			$data['library_object_id'] = $id;
		}
		
		$this->db->insert('smart_library_object_visitors', $data);
		return $this->db->insert_id();
	}
	 
//To check Storage limit of user 
	public function check_user_storage_space(){
		$this->db->select("SUM(size) as used_space_by_user");
		$this->db->from('smart_storage_details');
		$this->db->where('business_id','cd115d22f21211e8');
		//$this->db->where('user_id','e45ff7caf20f11e8');
		$query = $this->db->get();
		$data =  $query->row_array();
		return $data;
	}


	public function get_object_businessID(){
		$this->db->select("business_id");
		$this->db->from('smart_library_objects');
		$this->db->where('library_object_id',$this->input->get('object_id'));
		$query = $this->db->get();
		$data =  $query->row_array();
		return $data;
	}
	public function get_video_slug(){
		$this->db->select('slug_user');
		$this->db->where('video_id',$this->input->post('video_id'));		
        $this->db->where('video_videos.is_deleted != ',1,FALSE);
		$query = $this->db->get('video_videos');
		return $query->row_array();
	}





//Created by Anurag Rathore for Branding Status 

	public function get_branding_status($condition){
		if($condition['type'] == 'folder'){
			$this->db->select('is_branding');
			$this->db->from($this->tbl_library_folder);
			$condition_folder = array('business_id'=>$condition['business_id'],'library_object_id'=>$condition['id'],'is_deleted'=>'0');
			$this->db->where($condition_folder);
			$query = $this->db->get();
			if($query->num_rows()){
				$row = $query->row_array();
				$is_branding = $row['is_branding'];
			}
		}else{
			$this->db->select('is_branding');
			$this->db->from($this->tbl_library_object);
			$condition_object = array('business_id'=>$condition['business_id'],'library_object_id'=>$condition['id'],'is_deleted'=>'0');
			$this->db->where($condition_object);
			$query = $this->db->get();
			if($query->num_rows()){
				$row = $query->row_array();
				$is_branding = $row['is_branding'];
			}
		}
		return $is_branding;
	}


	public function update_branding_status($type, $condition ,$data){
		$local_tbl_name = $this->tbl_library_object; 
		if($type == 'folder'){
			$local_tbl_name = $this->tbl_library_folder; 
		}else{
			$local_tbl_name = $this->tbl_library_object; 
		}

		$this->db->where($condition);

		// $this->db->update($local_tbl_name,$data);
		// die(print_r($this->db->last_query()));

		if($this->db->update($local_tbl_name,$data)){
			return true;
		}else{
			return false;
		}
	}

//Added by Amarat for share Status 
        
        public function get_share_status($condition){
                
            $share_data = array();
            
            if($condition['type'] == 'folder'){
                    $this->db->select('is_twitter, is_facebook, is_linkedin, is_download, is_like, is_view');
                    $this->db->from($this->tbl_library_folder);
                    $condition_folder = array('business_id'=>$condition['business_id'],'library_object_id'=>$condition['id'],'is_deleted'=>'0');
                    $this->db->where($condition_folder);
                    $query = $this->db->get();
                    if($query->num_rows()){
                        $share_data = $query->row_array();
                    }
            }else{
                    $this->db->select('is_twitter, is_facebook, is_linkedin, is_download, is_like, is_view');
                    $this->db->from($this->tbl_library_object);
                    $condition_object = array('business_id'=>$condition['business_id'],'library_object_id'=>$condition['id'],'is_deleted'=>'0');
                    $this->db->where($condition_object);
                    $query = $this->db->get();
                    if($query->num_rows()){
                        $share_data = $query->row_array();
                    }
            }
            return $share_data;
	}
        
        
        public function update_share_status($type, $condition ,$data){ 
		if($type == 'folder'){
			//update folder status
                        $this->db->where($condition);
                        $folder_update_status = $this->db->update($this->tbl_library_folder,$data);

                        //update folder's filrs status
                        $this->db->where($condition);
                        $object_update_status = $this->db->update($this->tbl_library_object,$data);
                        
                        if($folder_update_status && $object_update_status){
                                return true;
                        }else{
                                return false;
                        }
                        
		}else{
                        $this->db->where($condition);
                        if($this->db->update($this->tbl_library_object,$data)){
                                return true;
                        }else{
                                return false;
                        }
		}

	}
        
//Ends by Amarat for share Status 
	
	public function get_unique_slug($id,$slug,$business_id=''){
		if(in_array($slug, $this->allocated_slug)){return false;}
		$this->db->where('slug',$slug);
		$this->db->where('library_object_id != ',$id);
		if($business_id!=''){
			$this->db->where('business_id',$business_id);
		}
		$this->db->where('is_deleted',0);
		$query = $this->db->get($this->tbl_library_object);
		if($query->num_rows()){
			return false;
		}
		else{
			return true;
		}
		
	
	}
	public function get_detail_homepage($data){
		$respopnce = array();
		if($data['type'] != '0'){
			$this->db->select('file_name,slug');
			$this->db->where('business_id',$data['business_id']);
			$this->db->where('is_deleted',0);
			$this->db->where('privacy_status !=',1);
			$this->db->where('slug !=',null);
			if($data['type'] == '1'){ // folder
				$this->db->where('file_type',5);
				$this->db->where('library_folder_id',0);
			}
			if($data['type'] == '2'){ //file 
				$this->db->where('file_type !=',5);
			}
			$query = $this->db->get($this->tbl_library_object);
			$respopnce = $query->result_array();
		}
		return $respopnce;
	}

	public function count_available_folders($business_id){
		$this->db->select('count(*) as total');
		$this->db->where('business_id',$business_id);
		$this->db->where('is_deleted',0);
		$this->db->where('file_type',5);
		$query = $this->db->get($this->tbl_library_object);
		$total = 0;
		if($query->num_rows()){
			$total = $query->row_array()['total'];
		}
		return $total;
	}
        
        public function count_available_files($business_id){
		$this->db->select('count(*) as total');
		$this->db->where('business_id',$business_id);
		$this->db->where('is_deleted',0);
		$this->db->where('status',1);
		$this-> db-> where('file_type !=', 5);
		$query = $this->db->get($this->tbl_library_object);
                $total = 0;
		if($query->num_rows()){
			$total = $query->row_array()['total'];
		}
		return $total;
	}
        
        public function is_product_object($business_id, $object_id){
            $data = array();
            $this->db->select('count(id) as product_count');
            $this->db->where('library_object_id',$object_id);
            $this->db->where('business_id',$business_id);
			//$this->db->join($this->cart_products . ' as CP', 'CP.product_id = CPF.product_id', 'left');
            $query = $this->db->get($this->cart_products_files);
           // echo $this->db->last_query(); die;
            if($query->num_rows() > 0) {
				$data = $query->row_array();
			}
			
			return $data;
           // return ($query->num_rows()) ? true : false;
            
            
        }
		
		public function is_product_object_multipe($business_id) {
			$object_id = $this->input->post('object_id');
			$object_id = json_decode($object_id);
			$ids = array_column($object_id,'id');
			
			$data = array();
		
				$this->db->select(" GROUP_CONCAT(CP.title SEPARATOR '  |  ')as product_name" );
				$this->db->where_in('CPF.library_object_id',$ids);
				$this->db->select('SLO.file_name,SLO.library_object_id,SLO.file_extension');
				$this->db->select("CASE
                                WHEN SLO.file_type = 1 THEN 'image'
                                WHEN SLO.file_type = 2 THEN 'video'
                                WHEN SLO.file_type = 3 THEN 'document'
                                WHEN SLO.file_type = 4 THEN 'audio'
                                ELSE 'other'
                        END AS type
				");				
				$this->db->where('CPF.business_id',$business_id);
				$this->db->join($this->cart_products . ' as CP', 'CP.product_id = CPF.product_id', 'left');
				$this->db->join($this->tbl_library_object . ' as SLO', 'SLO.library_object_id = CPF.library_object_id', 'left');
				$this->db->where('SLO.is_deleted','0');
				$this->db->where('CP.is_deleted !=',1);
				$this->db->group_by('CPF.library_object_id');
				$query = $this->db->get($this->cart_products_files . ' as CPF');
				
				if($query->num_rows() > 0 ){
					$data = $query->result_array();
					/*foreach($data as $value) {
						
					}*/
					
				}
				
			
			
			return $data;
			
		}
        
}


