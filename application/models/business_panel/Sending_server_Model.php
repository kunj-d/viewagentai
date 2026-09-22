<?php
class Sending_server_Model extends CI_Model {
	
	var $tableSendingServers		='sending_server_list';	
	var $tableSendingServerFields	='sending_server_fields';
	var $tableSendingServerUsers	='sending_server';
	public function addServer($data){
		$this->db->insert($this->tableSendingServers,$data);
		return $last_id=$this->db->insert_id();
	}
	
	public function addServerFields($data){
		$this->db->insert($this->tableSendingServerFields,$data);
	}
	
	public function getRecords($keyword,$per_page,$currentpage){
		if($keyword){
		   $this->db->like('title',$keyword);
		 }
		$query = $this->db->get($this->tableSendingServers,$per_page,$currentpage);
		return $query->result();
	}
	
	public function getCredentialFields(){
		$query = $this->db->get($this->tableSendingServerFields);
		return $query->result();
	}
	
	public function getCredentialFieldsDetail($sending_server_id){
		$this->db->where('sending_server_id',$sending_server_id);
		$query = $this->db->get($this->tableSendingServerFields);
		return $query->result();
	}
	
	public function setStatus($action,$id){
		$this->db->set('status',$action);
		$this->db->where('id',$id);
		$query=$this->db->update($this->tableSendingServers);
	}
	
	public function getRecordDetail($id){
		$this->db->where('id',$id);
		$query=$this->db->get($this->tableSendingServers);
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
		$query = $this->db->get($this->tableSendingServers);
		return $query->num_rows();
	}
	
	 
	function editServer($data,$id){
			$this->db->where('id',$id);
			$query=$this->db->update($this->tableSendingServers,$data);
	}
	
	function updateServerField($data,$id){
			$this->db->where('id',$id);
			$query=$this->db->update($this->tableSendingServerFields,$data);
	}
	
	 
	public function deleteServer($id){
		
		$this->db->select('type');
        $this->db->where('id', $id);
        $query = $this->db->get($this->tableSendingServers);
        $data = $query->row();
        		
		$this->db->where("id",$id);
		$this->db->delete($this->tableSendingServers);
		$this->db->where("server_type",$data->type);
		$this->db->delete($this->tableSendingServerUsers);
		$this->deleteServerFields($id);
	}
	
	public function deleteServerFields($id){
		$this->db->where("sending_server_id",$id);
		$this->db->delete($this->tableSendingServerFields);
	}
}
