<?php
class Feature_plan_Model extends CI_Model
{
	
	var $tablename='tbl_feature_plans';	
	var $tableapp='tbl_apps';	
	var $tablefeature='tbl_features';	
	
	function getAllCount($status=false){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getRecordList(){
	 	
		//$this->db->select($this->tablename.'.*,'.$this->tableapp.'.app_name');
		//$this->db->where('status','active');
		//$this->db->join($this->tableapp,$this->tablename.'.app_id='.$this->tableapp.'.id');
		//$this->db->order_by($this->tableapp.'.app_name','asc');
		$query = $this->db->get($this->tablename);
		return $query->result();
	 }
	function getRecordDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
	function getfeatureApps()
	 {
	   $this->db->select($this->tablefeature.'.app_id,'.$this->tableapp.'.app_name');
	   $this->db->where($this->tablefeature.'.status','active');
	   $this->db->group_by('app_id');
	   $this->db->join($this->tableapp,$this->tablefeature.'.app_id='.$this->tableapp.'.id');
	   $this->db->order_by($this->tableapp.'.app_name','asc');
	   $query = $this->db->get($this->tablefeature);
	   return $query->result();
	 }
	function getfeaturebyAppId($app_id=false,$feature_ids=false)
	 {
	   $this->db->where('app_id',$app_id);
	   $query = $this->db->get($this->tablefeature);
	   return $query->result();
	 }
	 function getfeaturesbyId($feature_ids)
	 {
	   $this->db->select($this->tablefeature.'.*,'.$this->tableapp.'.app_name');
	   if($feature_ids)
	   $this->db->where_in($this->tablefeature.'.id',$feature_ids);
	   $this->db->join($this->tableapp,$this->tablefeature.'.app_id='.$this->tableapp.'.id');
	   $query = $this->db->get($this->tablefeature);
	   return $query->result();
	 }
    function updateRecord($id){
	    
	    $feature_ids = serialize($this->input->post('feature_ids'));
		$this->db->set('plan_name',$this->input->post('plan_name'));
	    $this->db->set('feature_ids',$feature_ids);
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
    function addRecord(){
	    
	    $feature_ids = serialize($this->input->post('feature_ids'));
		$this->db->set('plan_name',$this->input->post('plan_name'));
	    $this->db->set('feature_ids',$feature_ids);
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
