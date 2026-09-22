<?php
class Log_Model extends CI_Model
{
	var $tablename='tbl_update_log_details';	
	var $tablecat='tbl_update_log';	
	
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		   $this->db->like('question',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword)
		 {
		   $this->db->like('question',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function addRecord(){
	    $this->db->set('version_id',$this->input->post('faq_category_id'));
	    $this->db->set('description',$this->input->post('answers'));
	    $this->db->set('log_title',$this->input->post('log_title'));
		$this->db->set('status','active');
		$this->db->set('type',$this->input->post('type'));
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
		 
		
	}
    function updateRecord($id){
	    
		 
		if($this->input->post('faq_category_id'))
	    $this->db->set('version_id',$this->input->post('faq_category_id'));
		if($this->input->post('slug'))
	    $this->db->set('slug',$slug);
		if($this->input->post('answers'))
	    $this->db->set('description',$this->input->post('answers'));
	    if($this->input->post('log_title'))
		$this->db->set('log_title',$this->input->post('log_title'));
		$this->db->set('modified',time());
		$this->db->set('type',$this->input->post('type'));
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
	function getCategoryList(){
	 	
		$this->db->where('status','active');
		$query = $this->db->get($this->tablecat);
		return $query->result();
	}
	
}
?>