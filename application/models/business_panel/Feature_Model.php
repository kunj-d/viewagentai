<?php
class Feature_Model extends CI_Model
{
	
	var $tablename='tbl_features';	
	var $tableapp='tbl_apps';	
	
	function getAllCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getRecordList(){
	 	
		$this->db->select($this->tablename.'.*,'.$this->tableapp.'.app_name');
		//$this->db->where('status','active');
		$this->db->join($this->tableapp,$this->tablename.'.app_id='.$this->tableapp.'.id');
		$this->db->order_by($this->tableapp.'.app_name','asc');
		$query = $this->db->get($this->tablename);
		return $query->result();
	 }
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function updateRecord($id){
	    
		if($this->input->post('feature'))
	    $this->db->set('feature',$this->input->post('feature'));
		if($this->input->post('condition_val'))
	    $this->db->set('condition_val',$this->input->post('condition_val'));
		if($this->input->post('app_id'))
	    $this->db->set('app_id',$this->input->post('app_id'));
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
    function addRecord(){
	    
	    $this->db->set('feature',$this->input->post('feature'));
		$this->db->set('condition_val',$this->input->post('condition_val'));
	    $this->db->set('app_id',$this->input->post('app_id'));
		$this->db->set('add_time',time());
		$this->db->insert($this->tablename);
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
}
