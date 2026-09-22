<?php
class Package_Model extends CI_Model
{
	
	var $tablename='tbl_package_plans';	
	var $tablefields='tbl_package_fields';	
	var $tableApps='tbl_apps';	
	var $tableFeaturePlan='tbl_feature_plans';	
	var $tableFeatures='tbl_features';	
	
	 function getPackageList(){
        
		$this->db->where($this->tablename.'.status','active');
		$this->db->select($this->tableFeaturePlan.'.plan_name,'.$this->tablename.'.*');
		$this->db->join($this->tableFeaturePlan,$this->tableFeaturePlan.'.id='.$this->tablename.'.feature_plan');
		$query = $this->db->get($this->tablename);
		return $query->result();
	 }
	 function getPackageFieldDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablefields);
		return $query->row();
	 }
	 function getPackageFieldAndAppNameBYid($id)
	 {
	   $this->db->select($this->tablefields.'.field_name,'.$this->tableApps.'.app_name');
	   $this->db->where($this->tablefields.'.id',$id);
	   $this->db->join($this->tableApps,$this->tableApps.'.id='.$this->tablefields.'.app_id');
	   $query = $this->db->get($this->tablefields);
	   return $query->row();
	 }
	function getPackageDetail($id){

		$this->db->select($this->tableFeaturePlan.'.plan_name,'.$this->tablename.'.*');
		$this->db->where($this->tablename.'.id',$id);
		$this->db->join($this->tableFeaturePlan,$this->tableFeaturePlan.'.id='.$this->tablename.'.feature_plan');
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
	function getFeatureslist($feature_plan){
	
		$this->db->where('id',$feature_plan);
		$query = $this->db->get($this->tableFeaturePlan);
		$fData = $query->row();
		$featureIDS = unserialize($fData->feature_ids);
		
		$this->db->where_in('id',$featureIDS);
		//$this->db->order_by('app_id','desc');
		$query = $this->db->get($this->tableFeatures);
		return $query->result();
	 }
	 
}