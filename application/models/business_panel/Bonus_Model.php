<?php
class Bonus_Model extends CI_Model
{
	
	var $tablename='tbl_bonuses';	
	var $tablecat='tbl_bonus_categories';	
	
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
			 $this->db->group_start();
		   $this->db->like('title',$keyword);
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
		   $this->db->or_like('slug',$keyword);
		   $this->db->group_end();
		 }
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function addRecord($image){
	    
	    $slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
		$this->db->set('bonus_category_id',$this->input->post('bonus_category_id'));
	    $this->db->set('title',$this->input->post('title'));
	    $this->db->set('image',$image);
	    $this->db->set('slug',$slug);
	    $this->db->set('description',$this->input->post('description'));
		$this->db->set('url',$this->input->post('url'));
		$this->db->set('status','active');
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
	}
    function updateRecord($id,$image){
	    
	    $old_slug = $this->getRecordDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
		if($this->input->post('bonus_category_id'))
	    $this->db->set('bonus_category_id',$this->input->post('bonus_category_id'));
		if($this->input->post('title'))
	    $this->db->set('title',$this->input->post('title'));
		if($image)
	    $this->db->set('image',$image);
		if($this->input->post('slug'))
	    $this->db->set('slug',$slug);
		if($this->input->post('description'))
	    $this->db->set('description',$this->input->post('description'));
		if($this->input->post('url'))
		$this->db->set('url',$this->input->post('url'));
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
	function getCategoryList(){
	 	
		$this->db->where('status','active');
		$query = $this->db->get($this->tablecat);
		return $query->result();
	 }
}
