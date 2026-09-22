<?php
class Updates_log_category_Model extends CI_Model
{
	var $tablename='tbl_update_log';	
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	 function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	 function addRecord(){

	    $slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
	    $this->db->set('title',$this->input->post('title'));
	    $this->db->set('slug',$slug);
		$this->db->set('status','active');
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
	}
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
	  function updateRecord($id){
	    
		$old_slug = $this->getRecordDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);

		if($this->input->post('title'))
	    $this->db->set('title',$this->input->post('title'));
		if($this->input->post('slug'))
	    $this->db->set('slug',$slug);
		$this->db->set('modified',time());
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	function deleteRecord($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->tablename);
	}
	function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
}