<?php
class Training_pdf_Model extends CI_Model
{
	
	var $tablename='tbl_training_pdfs';	
	var $tablecat='tbl_training_pdf_categories';	
	
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
    function addRecord($pdf_file){
	    
	    $slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
	    $this->db->set('training_pdf_category_id',$this->input->post('training_pdf_category_id'));
	    $this->db->set('title',$this->input->post('title'));
		$this->db->set('sort_order',$this->input->post('sort_order'));
		$this->db->set('slug',$slug);
	    $this->db->set('status','active');
		if($pdf_file)
	    $this->db->set('pdf_file',$pdf_file);
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
	}
    function updateRecord($id,$pdf_file){
	    
		$old_slug = $this->getRecordDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);

		if($this->input->post('training_pdf_category_id'))
	    $this->db->set('training_pdf_category_id',$this->input->post('training_pdf_category_id'));
		if($this->input->post('title'))
	    $this->db->set('title',$this->input->post('title'));
		if($this->input->post('sort_order'))
	    $this->db->set('sort_order',$this->input->post('sort_order'));
		if($pdf_file)
	    $this->db->set('pdf_file',$pdf_file);
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
	function getCategoryList(){
	 	
		$this->db->where('status','active');
		$query = $this->db->get($this->tablecat);
		return $query->result();
	 }
}
