<?php
class Package_purchase_Model extends CI_Model
{
	
	var $tablePurchase='tbl_package_purchase';	
	var $tablePackagePlan='tbl_package_plans';	
	
	
	function getAllPurchaseCount($status,$start_date,$end_date,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('add_time >=',$start_date);
		if($end_date)
		$this->db->where('add_time <=',$end_date);
		if($keyword)
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->tablePurchase);
		$result = $query->num_rows();
		return $result;
	 }
	 
	function getAllCount($status,$start_date,$end_date,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('add_time >=',$start_date);
		if($end_date)
		$this->db->where('add_time <=',$end_date);
		if($keyword)
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->tablePurchase);
		return $query->num_rows();
	 }
	function getPurchaseList($start_date,$end_date,$per_page,$currentpage,$keyword){
	
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('add_time >=',$start_date);
		if($end_date)
		$this->db->where('add_time <=',$end_date);
		if($keyword)
		$this->db->like('title',$keyword);
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->tablePurchase,$per_page,$currentpage);
		return $query->result();
	 }
    function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablePurchase);
	}

}
