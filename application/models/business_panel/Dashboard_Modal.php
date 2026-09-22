<?php
class Dashboard_Modal extends CI_Model
{
	
	var $tableTeamUser='tbl_sag_user';	
	var $tableUserProfile='tbl_user';	
	var $tablePackagePlan='tbl_package_plans';
	var $tableOrder='tbl_package_order';
	var $tableTrans='tbl_package_transaction';
	var $tablePurchase='tbl_package_purchase';

	function getAllTeamCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tableTeamUser);
		return $query->num_rows();
	 }
	 function getAllPackageCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablePackagePlan);
		return $query->num_rows();
	 }
	function getAllUserCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tableUserProfile);
		return $query->num_rows();
	 }
	function getUserCountThisWeek(){
	 	
		$lastweek = strtotime('-1 week');
		$this->db->where('created >=',$lastweek);
		$query = $this->db->get($this->tableUserProfile);
		return $query->num_rows();
	 }
	function getUserCountThisMonth(){
	 	
		$lastweek = strtotime('-1 month');
		$this->db->where('created >=',$lastweek);
		$query = $this->db->get($this->tableUserProfile);
		return $query->num_rows();
	 }
	function getAllOrderCount($status=false){
	 	
		if($status)
		$this->db->where('payment_status',$status);
		$query = $this->db->get($this->tableOrder);
		return $query->num_rows();
	 }
	function getOrderCountThisWeek(){
	 	
		$lastweek = strtotime('-1 week');
		$this->db->where('received_time >=',$lastweek);
		$query = $this->db->get($this->tableOrder);
		return $query->num_rows();
	 }
	function getOrderCountThisMonth(){
	 	
		$lastweek = strtotime('-1 month');
		$this->db->where('received_time >=',$lastweek);
		$query = $this->db->get($this->tableOrder);
		return $query->num_rows();
	 }
	function getAllTransCount($status=false){
	 	
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		if($status)
		$this->db->where('transaction_from',$status);
		$query = $this->db->get($this->tableTrans);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
	function getTransCountThisWeek(){
	 	
		$lastweek = strtotime('-1 week');
		
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		$this->db->where('created_on >=',$lastweek);
		$query = $this->db->get($this->tableTrans);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
	function getTransCountThisMonth(){
	 	
		$lastweek = strtotime('-1 month');
		
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		$this->db->where('created_on >=',$lastweek);
		$query = $this->db->get($this->tableTrans);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
	function getAllPurchaseCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablePurchase);
		return $query->num_rows();
	 }
	function getPurchaseCountThisWeek(){
	 	
		$lastweek = strtotime('-1 week');
		$this->db->where('add_time >=',$lastweek);
		$query = $this->db->get($this->tablePurchase);
		return $query->num_rows();
	 }
	function getPurchaseCountThisMonth(){
	 	
		$lastweek = strtotime('-1 month');
		$this->db->where('add_time >=',$lastweek);
		$query = $this->db->get($this->tablePurchase);
		return $query->num_rows();
	 }
	function getAllTransCountByType($status=false){
	 	
		$this->db->select('count(*) as size');
		$this->db->select_sum('amount');
		if($status)
		$this->db->where('transaction_type',$status);
		$query = $this->db->get($this->tableTrans);
		$result = $query->row();
		$data['totalamount'] = ($result->amount?round($result->amount,2):0);
		$data['size'] = ($result->size?$result->size:0);
		return $data;
	 }
}
