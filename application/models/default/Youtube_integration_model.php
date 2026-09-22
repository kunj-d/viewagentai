<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube_integration_model extends CI_Model{

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');  
        $this->business_id = $this->session->userdata('business_id');
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }

	public function update_yt_access_token($user_id,$business_id,$yt_data){
		$this->db->where('user_id',$user_id);
		$this->db->where('business_id',$business_id);
		$this->db->delete('youtube_access_token');
		$this->db->set('user_id',$user_id);
		$this->db->set('business_id',$business_id);
		$this->db->set('access_token',json_encode($yt_data));
		$this->db->set('created',time());
		$this->db->insert('youtube_access_token');
	}


	// Get latest chat entry (to derive parent_id)
	public function get_latest_by_user_and_business($user_id, $business_id) {
		return $this->db->where('user_id', $user_id)
						->where('business_id', $business_id)
						->order_by('id', 'DESC')
						->limit(1)
						->get('publisher_chat')
						->row();
	}

	// Insert chat
	public function insert($data) {
		$this->db->insert('publisher_chat', $data);
		return $this->db->insert_id();
	}

	// Update parent_id if needed
	/* public function update_parent_id($id, $parent_id) {
		$this->db->where('id', $id)->update('publisher_chat', ['parent_id' => $parent_id]);
	} */

	// Get chat history by parent_id
	public function get_all_by_parent_id($insert_id) {
			$query = $this->db
				->where('user_id', $this->user_id)
				->where('business_id', $this->business_id)
				->where('id', $insert_id)
				->order_by('id', 'ASC')
				->get('publisher_chat');

			return $query->result(); // or result_array() if you want an array
	}
	
    	public function save_youtube_publisher($data, $update_id = null) {
    		$resultToUpdate = $this->db->get_where('youtube_publisher', [
    			'user_id'     => $data['user_id'],
    			'business_id' => $data['business_id'],
    			'video_id'    => $update_id
    		])->row_array();
    
        	if ($update_id && !empty($resultToUpdate)) {
        		// Update existing record
        		$this->db->where('video_id', $update_id);
        		$this->db->where('user_id', $data['user_id']);
        		$this->db->where('business_id', $data['business_id']);
        		return $this->db->update('youtube_publisher', $data);
        	} else {
        		// Insert new record
        		return $this->db->insert('youtube_publisher', $data);
        	}
        }
        
        
        // public function saveVideoAnalysis($data)
        // {
        //     // check if record exists
        //     $this->db->where('video_id', $data['video_id']);
        //     $query = $this->db->get('analysis_videos');
        
        //     if ($query->num_rows() > 0) {
        //         $this->db->where('video_id', $data['video_id']);
        //         $this->db->update('analysis_videos', $data);
        //         return $data['video_id'];
        
        //     } else {
        //         $this->db->insert('analysis_videos', $data);
        //         return $this->db->insert_id();
        //     }
        // }
        public function saveVideoAnalysis($data)
        {
            $this->db->insert('analysis_videos', $data);
            return $this->db->insert_id();
        }
        
        
        // VIEW AGENT ---- CODE 
        
        public function insertVideoJob($data)
        {
            $result = $this->db->insert('video_jobs', $data);
        
            if (!$result) {
                print_r($this->db->error());
                die;
            }
        
            return $this->db->insert_id();
        }
        
        public function updateVideoJob($id, $data)
        {
            $this->db->where('id', $id);
            return $this->db->update('video_jobs', $data);
        }
          
        public function getVideoJob($job_id)
        {
            $this->db->where('id', $job_id);
            $query = $this->db->get('video_jobs');
            return $query->row_array();
        }          
        
        
        
}


