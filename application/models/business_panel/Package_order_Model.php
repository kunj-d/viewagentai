<?php
class Package_order_Model extends CI_Model
{
	
	var $tableOrder='tbl_package_order';	
	var $tablePackagePlan='tbl_package_plans';	
	

	function getAllOrdersCount($status,$start_date,$end_date,$keyword){
	 	
		if($status)
		$this->db->where('payment_status',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('order_time >=',$start_date);
		if($end_date)
		$this->db->where('order_time <=',$end_date);
		if($keyword)
		$this->db->like('user_email',$keyword);
		$query = $this->db->get($this->tableOrder);
		$result = $query->num_rows();
		return $result;
	 }
	 
	function getAllCount($status,$start_date,$end_date){
	 	
		if($status)
		$this->db->where('payment_status',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('order_time >=',$start_date);
		if($end_date)
		$this->db->where('order_time <=',$end_date);
		$query = $this->db->get($this->tableOrder);
		return $query->num_rows();
	 }
	function getOrderList($start_date,$end_date,$per_page,$currentpage,$keyword){
	
		$this->db->select($this->tablePackagePlan.'.title,'.$this->tableOrder.'.*');
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where($this->tableOrder.'.order_time >=',$start_date);
		if($end_date)
		$this->db->where($this->tableOrder.'.order_time <=',$end_date);
		if($keyword)
		$this->db->like('user_email',$keyword);
		$this->db->join($this->tablePackagePlan,$this->tablePackagePlan.'.id='.$this->tableOrder.'.package_id');
		$query = $this->db->get($this->tableOrder,$per_page,$currentpage);
		return $query->result();
	 }
}
