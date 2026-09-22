<?php
class Faq_Model extends CI_Model
{
	
	var $tablename='tbl_faqs';	
	var $tablecat='tbl_faq_categories';	
	
	function getAllCount($status,$keyword,$faq_id,$start_date,$end_date,$date_type){
	 	
		$this->db->select($this->tablename.'.*');
		 if($status)
		 $this->db->where($this->tablename.'.status',$status);
		if($keyword)
		 {
			$this->db->group_start();
		    $this->db->like($this->tablename.'.question',$keyword);
		    $this->db->or_like($this->tablename.'.slug',$keyword);
		    $this->db->group_end();
		 }
		 if($faq_id)
		{
		  $this->db->join($this->tablecat,$this->tablename.'.faq_category_id='.$this->tablecat.'.id');
		  $this->db->where($this->tablecat.'.id',$faq_id);
		  $this->db->where($this->tablecat.'.status','active');
		}
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date){
				if($date_type==1)
				{
				$this->db->where($this->tablename.'.created >=',$start_date);
				$this->db->where($this->tablename.'.created <=',$end_date);	
				}
				if($date_type==2)
				{
				$this->db->where($this->tablename.'.modified >=',$start_date);
				$this->db->where($this->tablename.'.modified <=',$end_date);	
				}
		}		
		 
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getRecordList($keyword,$per_page,$currentpage,$faq_id,$start_date,$end_date,$date_type){
	 	
		if($keyword)
		 {
			 $this->db->group_start();
		   $this->db->like($this->tablename.'.question',$keyword);
		   $this->db->or_like($this->tablename.'.slug',$keyword);
		 $this->db->group_end();
		 }
		  if($faq_id)
		{
		  $this->db->join($this->tablecat,$this->tablename.'.faq_category_id='.$this->tablecat.'.id');
		  $this->db->where($this->tablecat.'.id',$faq_id);
		  $this->db->where($this->tablecat.'.status','active');
		}
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date){
				if($date_type==1)
				{
				$this->db->where($this->tablename.'.created >=',$start_date);
				$this->db->where($this->tablename.'.created <=',$end_date);	
				}
				if($date_type==2)
				{
				$this->db->where($this->tablename.'.modified >=',$start_date);
				$this->db->where($this->tablename.'.modified <=',$end_date);	
				}
		}
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function addRecord($upload=false){
	    
	    $slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
		$this->db->set('faq_category_id',$this->input->post('faq_category_id'));
	    $this->db->set('question',$this->input->post('question'));
	    $this->db->set('slug',$slug);
	    $this->db->set('answers',$this->input->post('answers'));
		if($upload!='')
		$this->db->set('attachments',$upload);
		$this->db->set('status','active');
		$this->db->set('modified',time());
		$this->db->set('created',time());
		$this->db->insert($this->tablename);
		
	}
    function updateRecord($id=false,$upload=false){
	    
		$old_slug = $this->getRecordDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);

		if($this->input->post('faq_category_id'))
	    $this->db->set('faq_category_id',$this->input->post('faq_category_id'));
		if($this->input->post('question'))
	    $this->db->set('question',$this->input->post('question'));
		if($this->input->post('slug'))
	    $this->db->set('slug',$slug);
		if($this->input->post('answers'))
	    $this->db->set('answers',$this->input->post('answers'));
		if($upload!='')
		$this->db->set('attachments',$upload);
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
	function updateFaqAttachment($id,$attach)
	{	
		$this->db->set('attachments',$attach);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}	
		function like_count($faq_id){
	 	
		$this->db->select('*');
		$this->db->where('faq_id',$faq_id);
		$this->db->where('status','1');
		$query = $this->db->get('faq_likes');
		return $query->num_rows();
	 }
	 
	 
	function dislike_count($faq_id){
	 	
		$this->db->select('*');
		$this->db->where('faq_id',$faq_id);
		$this->db->where('status','-1');
		$query = $this->db->get('faq_likes');
		return $query->num_rows();
	 }
	
}
