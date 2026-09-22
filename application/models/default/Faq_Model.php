<?php
class Faq_Model extends CI_Model
{
	
	var $tablename='tbl_faqs';	
	var $tablecat='tbl_faq_categories';	
	
	function getRecordList(){
		$this->db->select("$this->tablecat.id as faq_cat_id,$this->tablecat.title as faq_cat_title,$this->tablename.question,$this->tablename.answers,$this->tablename.attachments");
		$this->db->join($this->tablecat,"$this->tablecat.id=$this->tablename.faq_category_id",'left');
	 	$this->db->where("$this->tablename.status",'active');
		$query = $this->db->get($this->tablename);
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	 }
	function getCategoryList()
	{
		$this->db->select("$this->tablecat.id,$this->tablecat.title,$this->tablecat.slug");
		$this->db->where('status','active');
		$query = $this->db->get($this->tablecat);
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}	
	function getRecordData($slug)
	{
		$this->db->select("$this->tablename.id as id,$this->tablecat.id as faq_cat_id,$this->tablecat.title as faq_cat_title,$this->tablename.question,$this->tablename.answers,$this->tablename.attachments");
		$this->db->join($this->tablecat,"$this->tablecat.id=$this->tablename.faq_category_id",'left');
	 	$this->db->where("$this->tablename.status",'active');
		$this->db->where("$this->tablecat.slug",$slug);
		$query = $this->db->get($this->tablename);
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}
	
	function getSearchRecord()
	{
		$search = explode(' ',$this->input->post('search'));
		$this->db->select("question,answers,attachments");
		$this->db->where('status','active');
		$this->db->like('question',$this->input->post('search'));
		foreach($search as $key=>$value)
		 {
		  if(trim($value)!='')
		  {
		     $this->db->or_like('question',$value);
		     $this->db->or_like('answers',$value);
		  }
		 }
		$query = $this->db->get($this->tablename);
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}
	function getSearchRecordUser()
	{
		$search = urldecode($_GET['search']);
		$this->db->select("question,answers,attachments");
		$this->db->where('status','active');
		$this->db->like('question',$search);
		$query = $this->db->get($this->tablename);
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}
	 
}
