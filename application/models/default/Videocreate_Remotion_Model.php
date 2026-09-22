<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videocreate_Remotion_Model extends CI_model {
	
	function __construct() { 
		 parent::__construct(); 
	    $this->remoton_video = 'library';
	    $this->library = 'library';
	    $this->avtar_photo_n_videos = 'avtar_photo_n_videos';
	    $this->user_save_draft_video = 'user_render_videos';
	    $this->speechify_voices = 'speechify_voices';
	    $this->websetting = 'web_setting';
	    $this->vidoe_default_templates = 'vidoe_default_templates';
	    $this->user_render_videos = ' user_render_videos';
	     $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
	}
	
	function get_youtube_data($userid) {
		$this->db->select('*');
		$this->db->where('user_id', $userid);
		$this->db->where('autoresponder_id', '19');
		$query=$this->db->get('users_autoresponder_settings');
		return $query->row();
	}
	
	public function get_video_list($user_id,$business_id,$video_status)
	{
	    $this->db->select('*');
	    if($video_status) {
	        $this->db->where('video_status',$video_status);
	    }
		$this->db->where('user_id',$user_id);
		$this->db->where('business_id',$business_id);
		 $this->db->order_by('id','DESC');
		$query=$this->db->get($this->remoton_video);
		return $query->result();
	}
	
	public function insertImageTable($data) {
	        $this->db->insert($this->library,$data);
	}
	
	public function get_images_list($user_id,$business_id) {
	    $this->db->select('url,height,width');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('file_type','I');
	     $this->db->order_by('id','DESC');
	    $query = $this->db->get($this->library);
	    return $query->result();
	}
	
	public function get_audio_list($user_id,$business_id) {
	    $this->db->select('url,title,id,duration');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('file_type','A');
	    $this->db->order_by('id','DESC');
	    $query = $this->db->get($this->library);
	    return $query->result();
	}
	
	
	
		public function get_ai_image_list($user_id,$business_id) {
	    //$this->db->select('url,title,id,duration');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('file_type','ai_image');
	    $this->db->order_by('id','DESC');
	    $query = $this->db->get($this->library);
	    return $query->result();
	}
	
	public function get_ai_audio_list($user_id,$business_id) {
	    $this->db->select('url,title,id,duration');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('file_type','ai_audio');
	    $this->db->order_by('id','DESC');
	    $query = $this->db->get($this->library);
	    return $query->result();
	}
	
	public function get_speechify_default_list($user_id,$business_id) {
	   
	    //$this->db->select('url,title,id,duration');
	    //$this->db->where('user_id',$user_id);
	    //$this->db->where('file_type','ai_image');
	    $this->db->order_by('sv_id','DESC');
	    $query = $this->db->get($this->speechify_voices);
	    return $query->result();
	}
	
	public function get_gif_list($user_id,$business_id) {
	    $this->db->select('url,title,id,duration');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('file_type','G');
	    $this->db->order_by('id','DESC');
	    $query = $this->db->get($this->library);
	    return $query->result();
	}
	
    public function get_user_mystories_video_list($user_id,$business_id) {
	    $this->db->select('rendered_video_path as url,id,total_duration as duration,height,width,thumbnail');
	    $this->db->where('user_id',$user_id);
	    $this->db->where('business_id',$business_id);
	    $this->db->where('status',1);
	    $this->db->where('render_status',2);
	    $this->db->order_by('id','DESC');
	    $query = $this->db->get('story_videos');
	    return $query->result();
	}
	
	
	
	
	
	
	
	
	
	function create_video_slug() {
		$tokens = 'abcdefghijklmnopqrstuvwxyz123456789';
		$segment_chars = 10;
		$slug = '';
		$segment = '';
		for ($j = 0; $j < $segment_chars; $j++) {
			$segment .= $tokens[rand(0, strlen($tokens)-1)];
		}
		$slug .= $segment;
		return $slug;
	}
	public function create_new_project($project_info){
		$this->db->insert('projects',$project_info);
		return $this->db->insert_id();
	}
	public function video_create($video_info){
		$this->db->insert($this->remoton_video,$video_info);
		$video_id = $this->db->insert_id();
	
		return $video_id;
	}
	
    public function update_rendor_vieo($data,$id) {
        $this->db->where('id',$id);
        $this->db->update($this->user_render_videos,$data);
        
    }
	
	public function get_watermark_logo($user_id,$business_id) {
	    $data = array();
	    $this->db->select('chatbot_footer_branding,watermark_status');
	    $this->db->where('userid', $business_id);
	    $query = $this->db->get($this->websetting);
	    if($query->num_rows() > 0) {
	        $resutl = $query->result_array();
	        $data['watermark_logo']  = $resutl[0]['chatbot_footer_branding'];
	        $data['permision'] = $resutl[0]['watermark_status'];
	        
	    }
	    
	    return $data;
	}
	
	
    	public function getHeyganVideoavatar($user_id,$business_id) {
    	    $this->db->where('user_id',$user_id);
    	    $this->db->where('business_id',$business_id);
    	    $this->db->where('video_status','heygen');
    	    $this->db->where('avatar_id =','');
    	    $query = $this->db->get($this->library);
    	    if($query->num_rows() > 0) {
    	        $data = $query->result_array();
    	    }else {
    	        $data = array();
    	    }
    	    
    	    return $data;
    	}
	
	
        // public function getHeyganVideo($user_id, $business_id, $avatar_type , $favourite ) {
    
        //     $this->db->where('user_id', $user_id);
        //     $this->db->where('business_id', $business_id);
        //     $this->db->where('video_status', 'heygen');
        
        //     // filters
        //     if (!empty($avatar_type)) {
        //         $this->db->where('avatar_type', $avatar_type);
        //     }
        
        //     if (!empty($favourite)) {
        //         $this->db->where('fav_status', $favourite);
        //     }
        //     $this->db->order_by('id','DESC');
        //     $query = $this->db->get($this->library);
            

        //     if ($query->num_rows() > 0) {
        //         return $query->result_array();
        //     }
        
        //     return array();
        // }
        
       public function getHeyganVideo($user_id, $business_id, $avatar_type = '', $favourite = '')
            {
                $this->db->select('library.*');
                $this->db->from('library');
            
                $this->db->where('library.user_id', $user_id);
                $this->db->where('library.business_id', $business_id);
                $this->db->where('library.video_status', 'heygen');
            
                // if (!empty($avatar_type)) {
                //     $this->db->where('library.avatar_type', $avatar_type);
                // }
            
                // if (!empty($favourite)) {
                //     $this->db->where('library.fav_status', $favourite);
                // }
            
                $this->db->where("
                    NOT EXISTS (
                        SELECT 1
                        FROM auto_post ap
                        WHERE TRIM(ap.video_url) = TRIM(library.url)
                        AND ap.video_type = 'ai'
                    )
                ", NULL, FALSE);
            
                $this->db->order_by('library.id', 'DESC');
            
                return $this->db->get()->result_array();
            }


	
	public function getavatartitle($user_id,$business_id,$id) {
	    $this->db->where('id',$id);
	    $this->db->where('user_id',$user_id);
	    $this->db->where('business_id',$business_id);
	    $this->db->where('video_status','heygen');
	    $query = $this->db->get($this->library);
	    if($query->num_rows() > 0) {
	        $data = $query->row();
	    }else {
	        $data = array();
	    }
	    return $data;
	}
	
	
	public function getEditorList($user_id,$business_id) {
	    $this->db->where('user_id',$user_id);
	    $this->db->where('business_id',$business_id);
	    $this->db->where('video_status','publish');
	    $this->db->order_by('id', 'DESC');
	    $query = $this->db->get($this->user_render_videos);
	    if($query->num_rows() > 0) {
	        $data = $query->result_array();
	    }else {
	        $data = array();
	    }
	    return $data;
	}
	
	public function gettitle($user_id,$business_id,$id) {
	    $this->db->where('id',$id);
	    $this->db->where('user_id',$user_id);
	    $this->db->where('business_id',$business_id);
	    $this->db->where('video_status','publish');
	    $query = $this->db->get($this->user_render_videos);
	    if($query->num_rows() > 0) {
	        $data = $query->row();
	    }else {
	        $data = array();
	    }
	    return $data;
	}
	
	public function getEditordraftList($user_id,$business_id) {
	    $this->db->where('user_id',$user_id);
	    $this->db->where('business_id',$business_id);
	    $this->db->where('video_status','draft');
	    $this->db->order_by('id', 'DESC');
	    $query = $this->db->get($this->user_render_videos);
	    if($query->num_rows() > 0) {
	        $data = $query->result_array();
	    }else {
	        $data = array();
	    }
	    return $data;
	}
	
	
	
	public function get_default_temaplate($user_id,$business_id) {
	   // $this->db->where('user_id',$user_id);
	   // $this->db->where('business_id',$business_id);
	   $this->db->order_by('id',"desc");
	    $query = $this->db->get("vidoe_default_templates");
	    if($query->num_rows() > 0) {
	        $data = $query->result_array();
	    }else {
	        $data = array();
	    }
	    return $data;
	}


    // public function get_default_temaplate($user_id, $business_id) {
    //     $data = [];
    
    //     // First Table
    //     // $this->db->where('user_id', $user_id);
    //     // $this->db->where('business_id', $business_id);
    //     $query1 = $this->db->get("vidoe_default_templates");
    //     if($query1->num_rows() > 0) {
    //         $data = $query1->result_array();
    //     } else {
    //         $data = [];
    //     }
    
    //     // Second Table
    //     $this->db->where('user_id', $user_id);
    //     $this->db->where('business_id', $business_id);
    //     $query2 = $this->db->get("user_render_videos");
    //     if($query2->num_rows() > 0) {
    //         $data = $query2->result_array();
    //     } else {
    //         $data = [];
    //     }
    
    //     return $data;
    // }

	function add_ffmpeg_queue($ffmpeg_queue){
		$this->db->insert('ffmpeg_queue',$ffmpeg_queue);
	}
	
	  public function getAvatarListingMade()
        {
            
            $this->db->select('p.*, apv.apv_image_path AS apv_image_path');
            $this->db->from('prompts p');
            $this->db->join('avtar_photo_n_videos apv', 'p.prompt_apv_id = apv.apv_id', 'left');
            $this->db->where('p.business_id', $this->business_id);
                    $this->db->group_start(); // Start grouping
                    $this->db->or_where('p.status', 1);
                    $this->db->or_where('p.status', 0);
                    $this->db->group_end(); // End grouping
                    $this->db->order_by('p.id', 'ASC');
            
            // echo $this->db->last_query();
            // die;
            return $this->db->get()->result_array();
        }
        
//         public function getAvatarImage($offset = 0 ,$limit,$type,$searchQuery) {
//             $this->db->group_start(); 
//             $this->db->where('business_id', $this->session->userdata('business_id'));
//             $this->db->or_where('business_id IS NULL'); 
//             $this->db->group_end();
          
//             $this->db->where('status', 1);
//             $this->db->where('avatar_status', $type);
//               if(isset($searchQuery) && !empty($searchQuery)) {
//                 $this->db->like('name',$searchQuery);
//             }
//             $this->db->order_by('id', 'desc');
// // 			$this->db->limit($limit, $offset);
// 			$query = $this->db->get($this->avtar_photo_n_videos)->result_array();

// 			//pr($this->db->last_query()); die;
// 			return $query;
//         }

    public function getAvatarImage($offset = 0, $limit, $type, $searchQuery)
    {
        $this->db->group_start(); 
        $this->db->where('business_id', $this->session->userdata('business_id'));
        $this->db->or_where('business_id IS NULL'); 
        $this->db->group_end();
    
        $this->db->where('status', 1);
        $this->db->where('avatar_status', $type);
    
        if (!empty($searchQuery)) {
            $this->db->like('name', $searchQuery);
        }
        
        if ($type == 'talking_video') {
            $this->db->order_by('RAND()');
        }else{
          $this->db->order_by('id', 'desc');
        }
    
        
    
        // ✅ pagination enable ho to uncomment
        // $this->db->limit($limit, $offset);
    
        $query = $this->db->get($this->avtar_photo_n_videos)->result_array();
    
        return $query;
    }

        
        public function getSaveAndDraft($user_id,$business_id) {
    	    $this->db->select('json_url,title,id');
    	    $this->db->where('user_id',$user_id);
    	    $this->db->where('business_id',$business_id);
    	    $this->db->order_by('id','DESC');
    	    $query = $this->db->get($this->user_save_draft_video);
    	    return $query->result();
	    }
	    
    	public function save_draft_json($json_array) {
    	    $this->db->insert($this->user_save_draft_video,$json_array);
    	     return $this->db->insert_id();
    	}
    	
    	public function deleteSaveAndDraft($id,$user_id,$business_id){
    	    $this->db->where('id',$id);
    	    $this->db->where('user_id',$user_id);
    	    $this->db->where('business_id',$business_id);
    	    $this->db->delete($this->user_save_draft_video);
	    }
	    
	    public function getDefaultTemplate($user_id,$business_id) {
    	    $this->db->order_by('id','DESC');
    	    $query = $this->db->get($this->vidoe_default_templates);
    	    return $query->result();
	    }
	    
	    public function update_video_create($id,$video_data)  {
	        $this->db->where('id',$id);
	           $this->db->update($this->library,$video_data);
	    }
	    
	   // for video editor list fav status in user_render_video
	     public function updateFavoriteStatus($promptId, $status)
            {
                return $this->db->where('id', $promptId)
                ->where('business_id', $this->business_id)
                ->update($this->user_render_videos, array('fav_status' => $status));
            }
            
        // for avatar fav status in library table 
        public function avatarFavoriteStatus($promptId, $status)
            {
                return $this->db->where('id', $promptId)
                ->where('business_id', $this->business_id)
                ->update($this->library, array('fav_status' => $status));
            }
            
                
       public function getFavAvatarListing()
        {
            $this->db->where('business_id', $this->business_id);
             $this->db->where('user_id',$this->owner_id);
            $this->db->where('video_status','publish');
            // $this->db->where('fav_status', 1);
            $this->db->order_by('id', 'DESC');
            $this->db->limit(7);
            return $this->db->get($this->user_render_videos)->result_array();
        }
        
        
        public function avatar_delete($id) {
            $this->db->where('id', $id); 
            return $this->db->delete('avtar_photo_n_videos'); 
        }


}
