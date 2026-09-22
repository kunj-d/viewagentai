<?php
class Inkflow_socialmedia_model extends CI_model{
   
    
	public function insertsocialmediaData($socialmediaData) {
   
        $insert_id = $this->db->insert('inkflow_socialmedia', $socialmediaData);
		return $insert_id;
	}
	public function updatesocialmediaData($socialmedia_id, $socialmediaData) {
		$this->db->where('id', $socialmedia_id);
		$this->db->where('user_id', $socialmediaData['user_id']);
		$this->db->where('business_id', $socialmediaData['business_id']);
		return $this->db->update('inkflow_socialmedia', $socialmediaData);
	}


	public function getsocialmediaList($business_id, $user_id) {
		$this->db->select('*');
		$this->db->from('inkflow_socialmedia');
		$this->db->where('business_id', $business_id);
		$this->db->where('user_id', $user_id);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$socialmediaList = $query->result_array();

		return [
			'status' => 1,
			'list' => $socialmediaList,
			'msg' => 'Success'
		];
	}


	public function getsocialmediaById($socialmedia_id, $user_id, $business_id) {
		$this->db->where('id', $socialmedia_id);
		$this->db->where('user_id', $user_id);
		$this->db->where('business_id', $business_id);
		$query = $this->db->get('inkflow_socialmedia');
		
		return $query->row_array();
	}

	public function deletesocialmedia($socialmedia_id, $business_id, $user_id) {
        $this->db->where('id', $socialmedia_id);
        $this->db->where('business_id', $business_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('inkflow_socialmedia');

        if ($this->db->affected_rows() > 0) {
            return ['status' => 1, 'msg' => 'Social Mediadeleted successfully.'];
        } else {
            return ['status' => 0, 'msg' => 'Failed to delete socialmedia.'];
        }
    }

	
   public function getThemeSetting($userid){
	   $this->db->where('userid',$userid);
	   $query=$this->db->get('theme_style');
	   $result=$query->result();
	   return $result;
   }
   public function updatedata($datatoupdate){
	   $userid=$this->session->userdata('business')['id'];
	   
	   $this->db->where('userid',$userid); 
	   $this->db->update('web_setting',$datatoupdate);
	   return;
   }
}


?>	