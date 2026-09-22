<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('AppDefault.php');



class Remotion_editor_api_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
    
          $this->user_id = $this->session->userdata('logged_in')['id'];
          $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business_id = $this->session->userdata('business_id');
        $this->access_token = $this->session->userdata('business')['access_token'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . "Videocreate_Remotion_Model");
        //$this->load->model($this->model_folder . "Cron_Model");
        $this->load->helper('tokengenerate');
         $this->api_key ='D684B8EFF387DBD9';
         session_start();
    }



  
    
	public function append_parts(){
	    

		if(!isset($_POST['video_filename'])){
			$file_ext= $this->input->post('file_ext');
			$slug=$this->Videocreate_Remotion_Model->create_video_slug();
			$video_filename = $slug.'.'.$file_ext;
		}else{
			$video_filename = $this->input->post('video_filename');
			$temp	= explode('.',$video_filename);
			$slug	= $temp[0];
			$file_ext= $temp[1];
		}

		if($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'png' || $file_ext == 'mp3' || $file_ext == 'wav' || $file_ext == 'aif' || $file_ext == 'ogg' || $file_ext == 'oga' || $file_ext == 'wma' || $file_ext == 'ram' || $file_ext == 'snd') {
		    $this->uploadImageOnServer($slug, $video_filename);
		} else {
		
    		$upload_folder = './assets/uploads/';
    		if(!is_dir($upload_folder.'videos/'.$slug)){
    			mkdir($upload_folder.'videos/'.$slug);
    		}
    
    		$data =  file_get_contents($_FILES['filedata']['tmp_name']);
    		file_put_contents($upload_folder.'videos/'.$slug.'/'.$video_filename, $data, FILE_APPEND | LOCK_EX);
    		echo json_encode(array('video_filename'=>$video_filename));
    	}
	}
	
	
	public function queueInsert(){ 

        		$project_id = $this->input->post('project_id');
        		$video_filename = $this->input->post('video_filename');
        		$temp	= explode('.',$video_filename);
        		$slug	= $temp[0];
        		$file_ext= $temp[1];
                
        if($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'png' || $file_ext == 'mp3' || $file_ext == 'wav' || $file_ext == 'aif' || $file_ext == 'ogg' || $file_ext == 'oga' || $file_ext == 'wma' || $file_ext == 'ram' || $file_ext == 'snd') {
                 $this->insertImageTable($video_filename,$file_ext);
        } else { 
	           $path = 'assets/uploads/videos/';
		        moveVideoOnS3($path,$slug);
            	$upload_folder = 'assets/uploads/';
            	$video_url = $this->config->item('bucket_url').$upload_folder.'videos/'.$slug.'/'.$video_filename;
            	$api_key ='D684B8EFF387DBD9';
            	$apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
            	$post_data = array(
    	           'api_key'=> $this->api_key,
    	           'url' => $video_url
    	           );
		  	    $video_details = getVideoDetailsPyCurl($post_data,$apiUrl);
		  	    $fileExtension = getFileExtension($video_details->thumbnail);
		  	    $compressFileExtension = getFileExtension($video_details->thumbnail_webp);
            
                $compress_slug = 'compress_'.$slug;
	            $upload_path_image = 'assets/uploads/videos/'.$slug.'/'.$slug.'.'.$fileExtension;
	            $upload_path_image_compress = 'assets/uploads/videos/'.$slug.'/'.$compress_slug.'.'.$compressFileExtension;
	    
                downloadImageUrl($path.$slug,$upload_path_image,$video_details->thumbnail);
                downloadImageUrl($path.$slug,$upload_path_image_compress,$video_details->thumbnail_webp);
                rmdir('./'.$path.$slug);
            
            	$thumb_url = $this->config->item('bucket_url').'assets/uploads/videos/'.$slug.'/'.$slug.'.'.$fileExtension;
            	$video_info = array(
                    'user_id'           => $this->owner_id,
                    'business_id'       =>$this->business_id,
            		'project_id'	    => 1,
            		'slug'			    => $slug,
            		'file_type'			=> 'V',
            		'url'			    => $video_url,
            		'title' 		    => $this->input->post('title'),
            		'width'             =>$video_details->width,
            		'height'            =>$video_details->height,
            		'duration'          =>$video_details->duration,
            		'video_status'      => 'upload',
            		'thumbnail'	        => $thumb_url,
            		'compress_thumbnail' => $this->config->item('bucket_url').$upload_path_image_compress
            		
            	);
            	$video_id = $this->Videocreate_Remotion_Model->video_create($video_info);
            	
            	//$flashdata['success'] = array('message' => 'Success! Video Upload Successfully', 'type'=>'flash');
            	//$this->session->set_flashdata('message', json_encode($flashdata));
            	$type = 'videos';
                echo json_encode(array('uplode_type'=>$type));
        }
	}
	
	/*public function downloadImageUrl($slug ,$image_path) 
	{
	    $fileInfo = pathinfo($image_path);
        $fileExtension = $fileInfo['extension'];
	    $path = 'assets/uploads/videos/'.$slug.'/'.$slug.'.'.$fileExtension;
	    $vidoeFolder = 'assets/uploads/videos/'.$slug.'/';
		$dir = './'.$vidoeFolder;
	    	$data =  file_get_contents($image_path);
		$upload = file_put_contents($path, $data, FILE_APPEND | LOCK_EX);

		 if($upload) {
           	$this->Cron_Model->uploadAWS($path);
           	unlink($path);
           	rmdir($dir);
		 }
	}*/
	
	
	/*public function getVideoDetailsCurl($video_url) {
	       $post_data = array(
	           'api_key'=> 'D684B8EFF387DBD9',
	           'url' => $video_url
	           );
	           
	         $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://ai.oppyo.com/app/v1/thumnail_from_video',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $post_data,
            ));
            
            $response = curl_exec($curl);
            return json_decode($response);
            curl_close($curl);
           
	}*/


    public function uploadImageOnServer($slug, $video_filename){
        
          $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id;
        $library_folder = "library_images";
        $this->validateFolderDirectory($library_folder,$this->owner_id);
        $image_name = $video_filename;
        $temp_file_path = $ownerDirectoryName . '/' . $library_folder . '/' . $image_name;
        
        downloadImageUrl($temp_file_path,$temp_file_path,$_FILES['filedata']['tmp_name']);
		/*$data =  file_get_contents($_FILES['filedata']['tmp_name']);
		$upload = file_put_contents($temp_file_path, $data, FILE_APPEND | LOCK_EX);
		 if($upload) {
           	$this->Cron_Model->uploadAWS($temp_file_path);
           	unlink($temp_file_path);
		 }*/
		echo json_encode(array('video_filename'=>$video_filename)); die;
    }	
	
	public function insertImageTable($video_filename ,$extension) {
	      $title = $this->input->post('title');
	      $ownerDirectoryName = 'assets/uploads/users/' . $this->owner_id;
          $library_folder = "library_images";
          $thumbnail = '';
          $height = '';
          $width = '';
          $temp_file_path = $this->config->item('bucket_url'). $ownerDirectoryName . '/' . $library_folder . '/' . $video_filename;
          $compres_thumbnail_path = $ownerDirectoryName . '/' . $library_folder . '/' . 'compress_thumb'.time().'.'.$extension;
          
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                $file_type = 'I';
                $type = 'image';
                $duration = '';
                $apiUrl = 'https://ai.oppyo.com/app/v1/image_processing';
                 $post_data = array(
    	           'api_key'=> $this->api_key,
    	           'input_file_url' => $temp_file_path,
    	           'type' =>1,
    	           'quality'=>30,
    	           'img_width'=>100,
    	           'img_height'=>100
    	           
    	           );
                $image_details =  getVideoDetailsPyCurl($post_data,$apiUrl);
               
                  downloadImageUrl('users/'.$this->owner_id,$compres_thumbnail_path,$image_details->file_path);
                 $thumbnail = $this->config->item('bucket_url').$compres_thumbnail_path;
                 $height = $image_details->height_org_image;
                 $width = $image_details->width_org_image;
            }else {
                $file_type = 'A';
                $type = 'audio';
                $apiUrl = 'https://ai.oppyo.com/app/v1/audio_processing';
                 $post_data = array(
    	           'api_key'=> $this->api_key,
    	           'input_file_url' => $temp_file_path
    	           );
                $audio_details =  getVideoDetailsPyCurl($post_data,$apiUrl);
                $duration = $audio_details->duration;
            }
            $data = array(
                'user_id' => $this->owner_id,
                'business_id' => $this->business_id,
                'project_id' => 1,
                'title' => substr(strtolower($title), 0, 150),
                'file_type' => $file_type,
                'url' => $temp_file_path,
                'size' => 0,
                'dimension' => '',
                'duration' =>$duration,
                'height' => $height,
                'width' => $width,
                'compress_thumbnail' =>$thumbnail,
                //'created' => time(),
                //'modified' => time()
            );
     
            $data = $this->Videocreate_Remotion_Model->insertImageTable($data);
          $unlinkFolder = $ownerDirectoryName . '/' . $library_folder.'/';
              $files = glob($unlinkFolder. '*'); 
              
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file); 
                    }
                }
           // $flashdata['success'] = array('message' => 'Success! Image Upload Successfully', 'type'=>'flash');
        	//$this->session->set_flashdata('message', json_encode($flashdata));
     
            echo json_encode(array('uplode_type'=>$type));
            
	}
	
	public function getUserVideo() {
	 
	  if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $video_status = $this->input->post('video_status');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_video_list($user_id,$business_id,$video_status);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  }
	    
	}
	
	
	public function getUserImage() {

	  if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_images_list($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  }
	    
	}
	
	public function getUserAudio(){
	   if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_audio_list($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	public function getWatermarkLogo() {
	   if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_watermark_logo($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	public function getUserHeygenVideo(){
	   if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->getHeyganVideoavatar($user_id,$business_id);
            echo json_encode($data); die;
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
    public function getSaveDraftTemplate() {
           if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->getSaveAndDraft($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
    }
	
	public function renderVideo() 
	{

	   // $url = 'https://s3.us-east-1.amazonaws.com/remotionlambda-useast1-qe2jk3zrmz/renders/w0bnjmq82q/out.mp4';
	   if($this->input->post('access_token')) {
    	    $url = $this->input->post('urls');
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    
    	    $slug = $this->Videocreate_Remotion_Model->create_video_slug();
    	    $file_ext = 'mp4';
    	    $video_filename = $slug.'.'.$file_ext;
    	    $upload_folder = './assets/uploads/';
    		if(!is_dir($upload_folder.'videos/'.$slug)){
    			mkdir($upload_folder.'videos/'.$slug);
    		}

		    $data =  file_get_contents($url);
		    file_put_contents($upload_folder.'videos/'.$slug.'/'.$video_filename, $data, FILE_APPEND | LOCK_EX);
			$folder = 'assets/uploads/';
		    $video_url = $this->config->item('bucket_url').$folder.'videos/'.$slug.'/'.$video_filename;
		    $path = 'assets/uploads/videos/';
		    moveVideoOnS3($path,$slug);
		    $api_key ='D684B8EFF387DBD9';
		    $apiUrl = 'https://ai.oppyo.com/app/v1/thumnail_from_video';
		    $post_data = array(
    	           'api_key'=> $this->api_key,
    	           'url' => $video_url
    	           );
		  	$video_details = getVideoDetailsPyCurl($post_data,$apiUrl);
        
            $fileInfo = pathinfo($video_details->thumbnail);
            $compressFileExtension = getFileExtension($video_details->thumbnail_webp);
            $fileExtension = $fileInfo['extension'];
	        $upload_path_image = 'assets/uploads/videos/'.$slug.'/'.$slug.'.'.$fileExtension;
	        $upload_path_image_compress = 'assets/uploads/videos/'.$slug.'/'.$compress_slug.'.'.$compressFileExtension;
	    
            downloadImageUrl($path.$slug,$upload_path_image,$video_details->thumbnail);
            downloadImageUrl($path.$slug,$upload_path_image_compress,$video_details->thumbnail_webp);
            rmdir('./'.$path.$slug);
            $thumb_url = $this->config->item('bucket_url').'assets/uploads/videos/'.$slug.'/'.$slug.'.'.$fileExtension;
	        $json = $this->input->post('json');
    	    $name = time();
    		$ownerDirectoryName = 'assets/uploads/users/' . $user_id;
            $json_folder = "save_draft_json";
            	$file_path = $ownerDirectoryName.'/'. $json_folder.'/'. $name.'.json';
            $this->validateFolderDirectory($json_folder,$user_id);
            $this->save_json($json,$file_path,$ownerDirectoryName);
			$video_info = array(
           // 'user_id'       => $user_id,
            //'business_id'   =>$business_id,
			'project_id'	 => 1,
			'slug'			 => $slug,
			//'file_type'			 => 'V',
			'url'			 => $video_url,
			//'title' 		 => $video_filename,
			'json_url' => $this->config->item('cdn_url').$file_path,
			'width'          =>$video_details->width,
            'height'         =>$video_details->height,
            'duration'       =>$video_details->duration,
			'video_status'  => 'publish',
			'thumbnail'	     => $thumb_url,
			'compress_thumbnail'=> $this->config->item('bucket_url').$upload_path_image_compress
		);
		$this->Videocreate_Remotion_Model->update_rendor_vieo($video_info,$this->input->post('id'));
		
       
            	$type = 'videos';
                echo json_encode(array('uplode_type'=>$type)); die;
	   }else {
	        $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	   }
		
	}
	
	
	public function saveDraftTemplate() {
	
// 	  die('gfhfh');
	     if($this->input->post('access_token')) { 
	         
                $access_token = $this->input->post('access_token');
    	        $decript_token = decript_user_token($access_token);
    	        parse_str(str_replace(":", "&", $decript_token), $output);
    	        $user_id = $output['user_id'];
    	        $business_id = $output['business_id'];
	         	$project_id = $this->input->post('project_id');
	         	$video_id = $this->input->post('id');
        		$json = $this->input->post('json');
        		//$name = $this->input->post('name');
        	    $name = time();
        		$ownerDirectoryName = 'assets/uploads/users/' . $user_id;
                $json_folder = "save_draft_json";
                	$file_path = $ownerDirectoryName.'/'. $json_folder.'/'. $name.'.json';
                $this->validateFolderDirectory($json_folder,$user_id );
                $this->db->where('user_id',$user_id);
		        $this->db->where('business_id',$business_id);
		        $this->db->where('title',$name);
		        $query = $this->db->get('user_save_draft_video');
        		$this->save_json($json,$file_path,$ownerDirectoryName);
        		$json_array = array(
        		       'user_id' =>$user_id,
        		       'business_id' => $business_id,
        		       'json_url' => $this->config->item('cdn_url').$file_path,
        		       'modified' => time()
        		    );
        		    
        		    if(!empty($video_id)) {
        		    $last_insert_id = $video_id;
        		    $this->db->where('id',$this->input->post('id'));
        		        $this->db->set('json_url',$this->config->item('cdn_url').$file_path);
        		        $this->db->set('thumbnail',$this->config->item('assetsTemplatePath').'images/draft.png');
        		        $this->db->set('video_status','draft');
        		        $this->db->update('user_render_videos');
        		    } else {
        		      // $last_insert_id = $this->Videocreate_Remotion_Model->save_draft_json($json_array);            
        		    }
        		
        			$responst['type'] = 'save_and_draft';
        			$responst['video_id'] = $last_insert_id;
                echo json_encode(array('uplode_type'=>$responst)); die;
	     }
	}
	
	 public function save_json($json_data,$file_path,$ownerDirectoryName) {
	    
        $json_folder = "save_draft_json";
        if (file_put_contents($file_path, $json_data)) {
           moveVideoOnS3($ownerDirectoryName.'/',$json_folder);
          
        }
    }
    
      public function deleteSaveDraftTemplate() {
           if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $id = $this->input->post('id');
    	    $data = $this->Videocreate_Remotion_Model->deleteSaveAndDraft($id,$user_id,$business_id);
            echo json_encode($data); die;
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
    }
    
    public function defaultTemplate() {
          if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->getDefaultTemplate($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  }
    }
	
	function MakeThumb($sourceFile, $destinationFile, $getFromSecond=1, $options=array()){
		if(!$this->config->item('ffmpeg_https')){
			$sourceFile = str_replace('https', 'http', $sourceFile);
		}
		
		$dimention = "320x180";
		$ffmpeg 	=  $this->config->item('ffmpeg');
		$inserttext = '> E:\xampp1\htdocs\RND-video\tubetrafficai\assets\uploads\videos\ffmpeg.txt 2>&1 &';
		$inserttext = '> '. str_replace('.png', '.txt', $destinationFile).' 2>&1 &';
		$cmd = "$ffmpeg -i $sourceFile -an -ss $getFromSecond -s $dimention $destinationFile $inserttext";
		shell_exec($cmd);
		 $cmd;
		
		if(isset($options['duration'])){
			$destinationFile1 = str_replace('.png', '1.png', $destinationFile);
			$getFromSecond = round($options['duration']*0.33);
			$cmd = "$ffmpeg -i $sourceFile -an -ss $getFromSecond -s $dimention $destinationFile1 $inserttext";
			shell_exec($cmd);
			$destinationFile2 = str_replace('.png', '2.png', $destinationFile);
			$getFromSecond = round($options['duration']*0.67);
			$cmd = "$ffmpeg -i $sourceFile -an -ss $getFromSecond -s $dimention $destinationFile2 $inserttext";
			shell_exec($cmd);
		}
		return true;
	
	}
	
	function upload_root_url(){
		$root= $_SERVER['DOCUMENT_ROOT'].'/';
		$upload_folder = 'assets/uploads/';
		$upload_root_url =  $root.$this->config->item('assetsBasePath').$upload_folder;
		return $upload_root_url;
	}
	
	
	public function validateFolderDirectory($folderName, $owner_id, $imageName='')
	{

		 $ownerDirectoryName = './assets/uploads/users/' . $owner_id;
		if(!is_dir($ownerDirectoryName)){
			mkdir($ownerDirectoryName, 0755, true);
		}
		$subFolderDirectory=$ownerDirectoryName."/".$folderName;
		if(!is_dir($subFolderDirectory)){
			mkdir($subFolderDirectory, 0755, true);
		}

	}
	
	
	public function addBackgroundRemoveVideo() {

	        if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $id = $this->input->post('id');
    	    $video_url = $this->input->post('url');
    	    $slug = $this->Videocreate_Remotion_Model->create_video_slug();
            $path = 'assets/uploads/videos/';
            $fileInfo = pathinfo($video_url);
            $fileExtension = $fileInfo['extension'];
	        $upload_path_image = 'assets/uploads/videos/'.$slug.'/'.$slug.'.webm';
	        
	         $upload_folder = './assets/uploads/';
    		if(!is_dir($upload_folder.'videos/'.$slug)){
    			mkdir($upload_folder.'videos/'.$slug);
    		}
	        
	         downloadImageUrl($path.$slug,$upload_path_image,$video_url);
	         $this->db->where('id',$id);
	         $this->db->set('bg_remove_url', $this->config->item('cdn_url').$upload_path_image);
	         $this->db->update('library');
    	    
            echo json_encode($this->config->item('cdn_url').$upload_path_image); die;
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	
	public function addTitleEditor() {
	   if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $id = $this->input->post('id');
    	    $project_type = $this->input->post('project_type');
    	    $title = $this->input->post('title');
    	        
    	            $this->db->where('id',$id);
    	            $this->db->set('title',$title);
    	            $this->db->update('user_render_videos');

            $_SESSION['project_name']['name'] = 'new_name_value';
        $this->session->set_userdata('project_name', array('name' => $title));
        $this->session->set_userdata('mp4_session', array('name' => $title));
        
        
    	       $data = array(
    	           'project_name' =>$title
    	           );
            echo json_encode($data); die;
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	
	
	
	
	/*public function MoveVideoOnS3($slug){
		$vidoeFolder = 'assets/uploads/videos/'.$slug.'/';
		$dir = './'.$vidoeFolder;
		if(is_dir($dir)){
		  
			foreach (directory_map($dir,1) as $item) {
				if ($item == '.' || $item == '..') continue;
				$this->Cron_Model->uploadAWS($vidoeFolder . $item);
				unlink('./'.$vidoeFolder . $item);
			
			}
		}
	}*/

// add ai studio 

	public function textToImage() {
	
	      if ($this->input->post('access_token')) {
	        $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $prompt = $this->input->post('prompt');
    	    $size = $this->input->post('size');
    	
    	     
            $apiKey = config_item('openai_key_proj_2');
            $url = "https://api.openai.com/v1/images/generations";
             
             $customPrompt = $prompt;
               $data = [
                    "model" => "gpt-image-1",
                    "prompt" => $prompt,
                    "size" => $size
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/json",
                    "Authorization: Bearer " . $apiKey
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $response = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => curl_error($ch)
                    ]);
                    curl_close($ch);
                    return;
                }
                curl_close($ch);
                $responseData = json_decode($response, true);
                if (isset($responseData['error'])) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => $responseData['error']['message']
                    ]);
                    return;
                }
                if (isset($responseData['data'][0]['b64_json'])) {
                    $base64_image = $responseData['data'][0]['b64_json'];
                    $imageData = base64_decode($base64_image);
                    $filename = 'generated_' . time() . '_' . rand(1000, 9999) . '.png';
                    $directoryPath = FCPATH . 'assets/uploads/users' . $user_id;
                    if (!is_dir($directoryPath)) {
                        mkdir($directoryPath, 0777, true);
                    }
                    $filePath = $directoryPath . '/' . $filename;
                    if (file_put_contents($filePath, $imageData) === false) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Failed to save image'
                        ]);
                        return;
                    }
                    $uploadpath = 'assets/uploads/users' . $user_id . "/" . $filename;
                    uploadAwsfile($uploadpath);
                    $cdn_url_file = $this->config->item('bucket_url') . $uploadpath;
                        $file_type = 'ai_image';
                        $type = 'image';
                        $duration = '';
                        $apiUrl = 'https://ai.oppyo.com/app/v1/image_processing';
                         $post_data = array(
            	           'api_key'=> $this->api_key,
            	           'input_file_url' => $cdn_url_file,
            	           'type' =>1,
            	           'quality'=>30,
            	           'img_width'=>100,
            	           'img_height'=>100
            	           
            	           );
                        $image_details =  getVideoDetailsPyCurl($post_data,$apiUrl);
                             $compres_thumbnail_path = 'assets/uploads/users'. $user_id . '/' . 'compress_thumb'.time().'.png';
                          downloadImageUrl('users/'.$user_id,$compres_thumbnail_path,$image_details->file_path);
                         $thumbnail = $this->config->item('bucket_url').$compres_thumbnail_path;
                         $height = $image_details->height_org_image;
                         $width = $image_details->width_org_image;
                                 
             
                 
                             $data = array(
                                'user_id' => $user_id,
                                'business_id' => $business_id,
                                'project_id' => 1,
                                'title' => substr(strtolower($filename), 0, 150),
                                'file_type' => $file_type,
                                'url' => $cdn_url_file,
                                'size' => 0,
                                'dimension' => '',
                                'duration' =>'',
                                'height' => $height,
                                'width' => $width,
                                'compress_thumbnail' =>$thumbnail,
                                //'created' => time(),
                                //'modified' => time()
                            );
                     
                            $data = $this->Videocreate_Remotion_Model->insertImageTable($data);
                        
                         echo json_encode(array('uplode_type'=>$file_type));
                     
                    } else {
                        $output['error']['message'] = "Failed to process files";
                        $output['error']['type'] = 'flash';
                        $this->session->set_flashdata('message', json_encode($output));
                    }
	      }else {
    	    $data['status'] = 'Token not valid';
    	   // echo json_encode($data); die;
	      } 
                
        
	}
	
	public function getAiImageGenerat(){
	   if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_ai_image_list($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	public function getSpeechifyDefaultAudioList() {
	       if ($this->input->post('access_token')) {
        	    $access_token = $this->input->post('access_token');
        	    $decript_token = decript_user_token($access_token);
        	    parse_str(str_replace(":", "&", $decript_token), $output);
        	    $user_id = $output['user_id'];
        	    $business_id = $output['business_id'];
        	    $data = $this->Videocreate_Remotion_Model->get_speechify_default_list($user_id,$business_id);
                echo json_encode($data); die;
        
    	  } else {
        	    $data['status'] = 'Token not valid';
        	    echo json_encode($data); die;
    	  } 
	}
	
	public function generateSpeechifyAudio() {
	      if ($this->input->post('access_token')) {
                	    $access_token = $this->input->post('access_token');
                	    $decript_token = decript_user_token($access_token);
                	    parse_str(str_replace(":", "&", $decript_token), $output);
                	    $user_id = $output['user_id'];
                	    $business_id = $output['business_id'];
                	    $avatar_script = $this->input->post('avatar_script');
                	    if($this->input->post('type') == 'clone') {
                	      $this->uploadSpeechifyAudioFile();
                	    }
                	    $voiceId = $this->input->post('voice_id');
                	    $directoryPath =  'assets/uploads/users/' . $user_id;
                        if (!is_dir($directoryPath)) {
                            mkdir($directoryPath, 0777, true);
                        }
                        
            	        $apiBaseUrl = "https://api.sws.speechify.com/v1/audio/speech";
            	        $apiKey = config_item('spechify_key'); 
                        $audioFormat = "wav";
                          
                           $payload = json_encode([
                                'input' => $avatar_script,
                                'voice_id' => $voiceId,
                                'audio_format' => $audioFormat
                            ]);
                            
                             // Initialize cURL for speech generation
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $apiBaseUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Authorization: Bearer ' . $apiKey,
                                'Content-Type: application/json'
                            ]);
                           
                           $response = curl_exec($ch);
                           
                            curl_close($ch);
                        
                            if (curl_errno($ch)) {
                                return "Error: " . curl_error($ch);
                            }
                        
                            $data = json_decode($response, true);
                            //echo '<pre>';  print_r($data ); die;
                        if (isset($data['audio_data'])) {
                            $audioFile = $data['audio_data'];
                            $audioFormat = 'wav'; 
                            $decodedAudio = base64_decode($audioFile);
                            $fileName_final = 'audio_' . time() . '.' . $audioFormat;
                        
                         
                            $filePath = $directoryPath . '/' . $fileName_final;
                            file_put_contents($filePath, $decodedAudio);
                            $uploadPath = 'assets/uploads/users/' . $user_id . '/' . $fileName_final;
                            uploadAwsfile($uploadPath);
                            $audiovoice = $this->config->item('bucket_url') . $uploadPath;
                        
                                $file_type = 'ai_audio';
                                $type = 'ai_audio';
                                $apiUrl = 'https://ai.oppyo.com/app/v1/audio_processing';
                                 $post_data = array(
                                	           'api_key'=> $this->api_key,
                                	           'input_file_url' => $audiovoice
                                	           );
                                $audio_details =  getVideoDetailsPyCurl($post_data,$apiUrl);
                                $duration = $audio_details->duration;
                      
                            $data = array(
                                'user_id' =>  $user_id,
                                'business_id' => $business_id,
                                'project_id' => 1,
                                'title' => substr(strtolower($fileName_final), 0, 150),
                                'file_type' => $file_type,
                                'url' => $audiovoice,
                                'size' => 0,
                                'dimension' => '',
                                'duration' =>$duration,
                            );
                     
                            $data = $this->Videocreate_Remotion_Model->insertImageTable($data);
                             
                              echo json_encode(array('uplode_type'=>$file_type));
                            
                        }
	      }else {
        	    $data['status'] = 'Token not valid';
        	    echo json_encode($data); die;
    	  } 
	}
	
	public function getSpeechifyAudioList() {
	     if ($this->input->post('access_token')) {
    	    $access_token = $this->input->post('access_token');
    	    $decript_token = decript_user_token($access_token);
    	    parse_str(str_replace(":", "&", $decript_token), $output);
    	    $user_id = $output['user_id'];
    	    $business_id = $output['business_id'];
    	    $data = $this->Videocreate_Remotion_Model->get_ai_audio_list($user_id,$business_id);
            echo json_encode($data); die;
        
	  } else {
    	    $data['status'] = 'Token not valid';
    	    echo json_encode($data); die;
	  } 
	}
	
	
	 public function uploadSpeechifyAudioFile() {
                if ($this->input->post('access_token')) {
                	    $access_token = $this->input->post('access_token');
                	    $decript_token = decript_user_token($access_token);
                	    parse_str(str_replace(":", "&", $decript_token), $output);
                	    $user_id = $output['user_id'];
                	    $business_id = $output['business_id'];
                	    
                        $avatar_script = $this->input->post('avatar_script');
                        $directoryPath =  'assets/uploads/users/' . $user_id;
                            
                        if (!is_dir($directoryPath)) {
                            mkdir($directoryPath, 0777, true);
                        }
                        if (isset($_FILES['audio']['name']) && !empty($_FILES['audio']['name'])) {
                            	$data =  file_get_contents($_FILES['audio']['tmp_name']);
                            	$fileName =  time() . '_' . $_FILES['audio']['name'];
                                $filePath = $directoryPath . '/' . $fileName;
    		                    file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX);
                                uploadAwsfile($filePath);
                            $user_audioUrl = $this->config->item('bucket_url') . $filePath;
                            $audioFileProvided = true;
                        }
    
        
                       if($user_audioUrl) {
                            $apiBaseUrl = "https://api.sws.speechify.com/v1/voices";
                            $apiKey = config_item('spechify_key'); 
                            $name = "My Voice Name";
                            $consent = json_encode([
                                "fullName" => "John McVoices",
                                "email" => "me@voices.audio"
                            ]);
                            $filePath = $user_audioUrl;
                            $curlFile = curl_file_create($filePath);
                        
                            $postFields = [
                                "name" => $name,
                                "consent" => $consent,
                                "sample" => $curlFile
                            ];
                        
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $apiBaseUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                "Authorization: Bearer $apiKey",
                                "Content-Type: multipart/form-data"
                            ]);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        
                            $response = curl_exec($ch);
                            curl_close($ch);
                        
                            if ($response === false) {
                                $result = [
                                    'status' => false,
                                    'msg' => 'please upload minimum 5 seconds and maximum 30 seconds audio',
                                ];
                                echo json_encode($result);
                            }
                            $responseData = json_decode($response, true);
    
                           
                            
                             $voiceId = $responseData['id'] ?? null;
                              $apiBaseUrl = "https://api.sws.speechify.com/v1/audio/speech";
                              $audioFormat = "wav";
                              
                               $payload = json_encode([
                                    'input' => $avatar_script,
                                    'voice_id' => $voiceId,
                                    'audio_format' => $audioFormat
                                ]);
                                
                                 // Initialize cURL for speech generation
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $apiBaseUrl);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                    'Authorization: Bearer ' . $apiKey,
                                    'Content-Type: application/json'
                                ]);
                               
                               $response = curl_exec($ch);
                               
                                curl_close($ch);
                            
                                if (curl_errno($ch)) {
                                    return "Error: " . curl_error($ch);
                                }
                            
                                $data = json_decode($response, true);
    
                            if (isset($data['audio_data'])) {
                                $audioFile = $data['audio_data'];
                                $audioFormat = 'wav'; 
                                $decodedAudio = base64_decode($audioFile);
                                $fileName_final = 'audio_' . time() . '.' . $audioFormat;
                            
                             
                                $filePath = $directoryPath . '/' . $fileName_final;
                                file_put_contents($filePath, $decodedAudio);
                                $uploadPath = 'assets/uploads/users/' . $user_id . '/' . $fileName_final;
                                uploadAwsfile($uploadPath);
                                $audiovoice = $this->config->item('bucket_url') . $uploadPath;
                            
                                    $file_type = 'ai_audio';
                                    $type = 'ai_audio';
                                    $apiUrl = 'https://ai.oppyo.com/app/v1/audio_processing';
                                     $post_data = array(
                                    	           'api_key'=> $this->api_key,
                                    	           'input_file_url' => $audiovoice
                                    	           );
                                    $audio_details =  getVideoDetailsPyCurl($post_data,$apiUrl);
                                    $duration = $audio_details->duration;
                          
                                $data = array(
                                    'user_id' => $user_id,
                                    'business_id' => $business_id,
                                    'project_id' => 1,
                                    'title' => substr(strtolower($fileName_final), 0, 150),
                                    'file_type' => $file_type,
                                    'url' => $audiovoice,
                                    'size' => 0,
                                    'dimension' => '',
                                    'duration' =>$duration,
                                );
                         
                                $data = $this->Videocreate_Remotion_Model->insertImageTable($data);
                                 
                                     echo json_encode(array('uplode_type'=>$file_type)); die;
                                
                            }
                         
                        }
                         
                         
                        if ($audiovoice) {
                                  echo json_encode(array('uplode_type'=>$file_type));
                            } else {
                                $result = [
                                    'status' => false,
                                    'msg' => 'Something went wrong',
                                ];
                            }
                            
                            echo json_encode($result);
                        
                } else {
                	    $data['status'] = 'Token not valid';
                	    echo json_encode($data); die;
            	} 
                        
           }
           
           public function deleteAiSpAudioList() {

                if ($this->input->post('access_token')) {
                	    $access_token = $this->input->post('access_token');
                	    $decript_token = decript_user_token($access_token);
                	    parse_str(str_replace(":", "&", $decript_token), $output);
                	    $user_id = $output['user_id'];
                	    $business_id = $output['business_id'];
                	    $id = $this->input->post('id');
               
                	    $data = $this->Videocreate_Remotion_Model->delete_ai_sp_audio($user_id,$business_id,$id);
                	    $file_type = 'audio_delete';
                        echo json_encode(array('uplode_type'=>$file_type)); die;
                    
            	  } else {
                	    $data['status'] = 'Token not valid';
                	    echo json_encode($data); die;
            	  } 
           }
           
           
           public function get_user_mystories_video_list() {
	 
        	  if ($this->input->post('access_token')) {
            	    $access_token = $this->input->post('access_token');
            	    $video_status = $this->input->post('video_status');
            	    $decript_token = decript_user_token($access_token);
            	    parse_str(str_replace(":", "&", $decript_token), $output);
            	    $user_id = $output['user_id'];
            	    $business_id = $output['business_id'];
            	    $data = $this->Videocreate_Remotion_Model->get_user_mystories_video_list($user_id,$business_id);
                    echo json_encode($data); die;
                
        	  } else {
            	    $data['status'] = 'Token not valid';
            	    echo json_encode($data); die;
        	  }
        	    
        	}
	
	




   


}
