<?php
class Socialresponder_Model extends CI_Model {
	
	var $tableSocialresponders='social_profiles';	
	var $tableSocialresponderFields='socialresponder_fields';
	public function addResponder($data){
		$this->db->insert($this->tableSocialresponders,$data);
		return $last_id=$this->db->insert_id();
	}
	
	public function addResponderFields($data){
		$this->db->insert($this->tableSocialresponderFields,$data);
	}
	
	public function getRecords($keyword,$per_page,$currentpage){
		if($keyword){
		   $this->db->like('title',$keyword);
		 }
		$query = $this->db->get($this->tableSocialresponders,$per_page,$currentpage);
		return $query->result();
	}
	
	public function getCredentialFields(){
		$query = $this->db->get($this->tableSocialresponderFields);
		return $query->result();
	}
	
	public function getCredentialFieldsDetail($autoresponder_id){
		$this->db->where('social_profile_id',$autoresponder_id);
		$query = $this->db->get($this->tableSocialresponderFields);
		return $query->result();
	}
	
	public function setStatus($action,$id){
		$this->db->set('status',$action);
		$this->db->where('id',$id);
		$query=$this->db->update($this->tableSocialresponders);
	}
	
	public function getRecordDetail($id){
		$this->db->where('id',$id);
		$query=$this->db->get($this->tableSocialresponders);
		if($query->num_rows()>0){
			return $query->row(); 
		}
		else{
			return false;
		}
	}
	
	public function allCount($status,$keyword){
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		 }
		$query = $this->db->get($this->tableSocialresponders);
		return $query->num_rows();
	}
	public function inactiveCount($status,$keyword){
		$this->db->where('status','0');
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		 }
		$query = $this->db->get($this->tableSocialresponders);
		return $query->num_rows();
	}
	 
	function editResponder($data,$id){
			$this->db->where('id',$id);
			$query=$this->db->update($this->tableSocialresponders,$data);
	}
	
	function updateResponderField($data,$id){
			$this->db->where('id',$id);
			$query=$this->db->update($this->tableSocialresponderFields,$data);
	}
	
	 
	public function deleteAutoresponder($id){
		$this->db->where("id",$id);
		$this->db->delete($this->tableSocialresponders);
		$this->deleteAutoresponderFields($id);
	}
	
	public function deleteAutoresponderFields($id){
		$this->db->where("social_profile_id",$id);
		$this->db->delete($this->tableSocialresponderFields);
	}
}
