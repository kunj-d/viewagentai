<?php
class Email_template_Model extends CI_Model
{
	
	var $tablename = 'tbl_email_templates';	
	var $tableEmailtypes = 'tbl_email_types';	
	
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		
		   $this->db->group_start();
		   $this->db->like('title',$keyword);
		   $this->db->or_like('subject',$keyword);
		   $this->db->or_like('slug',$keyword);
		   $this->db->group_end();
		   
		 }
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword)
		 {
		     $this->db->group_start();
		   $this->db->like('title',$keyword);
		   $this->db->or_like('subject',$keyword);
		   $this->db->or_like('slug',$keyword);
		   $this->db->group_end();
		 }
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	function getTemplateDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function addTemplate(){
	    
	    $slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
	    $this->db->set('email_type',$this->input->post('email_type'));
	    $this->db->set('title',$this->input->post('title'));
	    $this->db->set('slug',$slug);
	    $this->db->set('subject',$this->input->post('subject'));
	    $this->db->set('description',$this->input->post('description'));
		$this->db->set('message',$this->input->post('message'));
		$this->db->set('status','active');
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
	}
    function updateTemplate($id){
		
		$old_slug = $this->getTemplateDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);

		if($this->input->post('email_type'))
	    $this->db->set('email_type',$this->input->post('email_type'));
		if($this->input->post('title'))
	    $this->db->set('title',$this->input->post('title'));
		if($this->input->post('slug'))
	    $this->db->set('slug',$slug);
		if($this->input->post('subject'))
	    $this->db->set('subject',$this->input->post('subject'));
		if($this->input->post('description'))
	    $this->db->set('description',$this->input->post('description'));
		if($this->input->post('message'))
		$this->db->set('message',$this->input->post('message'));
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
	function getEmailTypeList(){
	 	
		$query = $this->db->get($this->tableEmailtypes);
		return $query->result();
	 }
}
