<?php
class Package_transaction_Model extends CI_Model
{
	
	var $tableTransaction='tbl_package_transaction';	
	var $tablePackagePlan='tbl_package_plans';	
	var $tablePackagePurchase='tbl_package_purchase';	
	
	function getAllTransactionCount($status,$start_date,$end_date,$keyword){
	 	
		if($status)
		$this->db->where('transaction_from',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('created_on >=',$start_date);
		if($end_date)
		$this->db->where('created_on <=',$end_date);
		if($keyword)
		{
	     $this->db->group_start();
		$this->db->like('name',$keyword);
		$this->db->or_like('email',$keyword);
		    $this->db->group_end();
		}
		$query = $this->db->get($this->tableTransaction);
		$result = $query->num_rows();
		return $result;
	 }
	function getAllCount($status,$start_date,$end_date,$keyword){
	 	
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		if($status)
		$this->db->where('transaction_from',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('created_on >=',$start_date);
		if($end_date)
		$this->db->where('created_on <=',$end_date);
		if($keyword)
		{
	    $this->db->group_start();
		$this->db->like('name',$keyword);
		$this->db->or_like('email',$keyword);
		$this->db->group_end();
		}
		$query = $this->db->get($this->tableTransaction);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
	function getTransactionList($start_date,$end_date,$per_page,$currentpage,$keyword){
	 	
		$this->db->select($this->tablePackagePurchase.'.title,package_id,'.$this->tableTransaction.'.*');
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where($this->tableTransaction.'.created_on >=',$start_date);
		if($end_date)
		$this->db->where($this->tableTransaction.'.created_on <=',$end_date);
		if($keyword)
		{
	     $this->db->group_start();
		$this->db->like('name',$keyword);
		$this->db->or_like('email',$keyword);
		    $this->db->group_end();
		}
		$this->db->join($this->tablePackagePurchase,$this->tablePackagePurchase.'.id='.$this->tableTransaction.'.purchase_id');
		$this->db->order_by($this->tableTransaction.'.id','desc');
		$query = $this->db->get($this->tableTransaction,$per_page,$currentpage);
		return $query->result();
	 }
	function getRefundCount($status,$start_date,$end_date){
	 	
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		if($status)
		$this->db->where('transaction_type',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where('created_on >=',$start_date);
		if($end_date)
		$this->db->where('created_on <=',$end_date);
		$query = $this->db->get($this->tableTransaction);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
}
