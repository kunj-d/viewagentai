<?php
class Package_Model extends CI_Model
{
	
	var $tablename='tbl_package_plans';	
	var $tablefields='tbl_package_fields';	
	var $tableApps='tbl_apps';	
	var $tableFeaturePlan='tbl_feature_plans';	
	
	function getAllCount($status="false"){
	 	
		if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getPackageList(){
	 	
		$this->db->select($this->tableFeaturePlan.'.plan_name,'.$this->tablename.'.*');
		//$this->db->where('status','active');
		$this->db->join($this->tableFeaturePlan,$this->tableFeaturePlan.'.id='.$this->tablename.'.feature_plan');
		$query = $this->db->get($this->tablename);
		return $query->result();
	 }
	function getAppList(){
	 	
		//$this->db->where('status','active');
		$query = $this->db->get($this->tableApps);
		return $query->result();
	 }
	function getAppFieldsList($app_id){
	 	
		$this->db->where('app_id',$app_id);
		$this->db->order_by('app_id','asc');
		$query = $this->db->get($this->tablefields);
		return $query->result();
	 }
	function getAppids($app_id){
	 	
		//$this->db->select($this->tableApps.'.id');
		$this->db->where_in($this->tableApps.'.id',$app_id);
		$query = $this->db->get($this->tableApps);
		return $query->result();
	 }
	function getPackageDetail($id){

		$this->db->select($this->tableFeaturePlan.'.plan_name,'.$this->tablename.'.*');
		$this->db->where($this->tablename.'.id',$id);
		$this->db->join($this->tableFeaturePlan,$this->tableFeaturePlan.'.id='.$this->tablename.'.feature_plan');
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
	 function getPackageFieldDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablefields);
		return $query->row();
	 }
    function updatePackage($id){
	    
		if($this->input->post('first_name'))
	    $this->db->set('first_name',$this->input->post('first_name'));
		if($this->input->post('last_name'))
	    $this->db->set('last_name',$this->input->post('last_name'));
		if($this->input->post('phone'))
	    $this->db->set('phone',$this->input->post('phone'));
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
    function addPackage(){
	    
	    $app_ids = serialize($this->input->post('app_id'));
		$fields = serialize($this->input->post('fieldval'));
		if($this->input->post('overages'))
		$overages = serialize($this->input->post('overages'));
		$this->db->set('app_ids',$app_ids);
		$this->db->set('fields',$fields);
		if($this->input->post('overages'))
		$this->db->set('overages',$overages);
	    $this->db->set('title',$this->input->post('title'));
		$this->db->set('feature_plan',$this->input->post('feature_plan'));
	    $this->db->set('plan_type',$this->input->post('plan_type'));
		if($this->input->post('price'))
	    $this->db->set('price',$this->input->post('price'));
	    $this->db->set('sell_type',$this->input->post('sell_type'));
	    $this->db->set('jvz_product_id',$this->input->post('jvz_product_id'));
		$this->db->set('add_time',time());
		$this->db->insert($this->tablename);
	}
	function deletePackage($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->tablename);
	}
	function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	function getAppName($id){
		$data1="";
	 	$app_ids = unserialize($id);
		$this->db->select('app_name');
		$this->db->where_in('id',$app_ids);
		$query = $this->db->get($this->tableApps);
		$data = $query->result();

		foreach($data as $key=>$val)
		{
		  $key++;
		  $data1.= $val->app_name;
		  if($key<sizeof($data))
		  $data1.= ', ';
		}
		return $data1;
	 }
	 function getFeaturePlanList()
	 {
	   $this->db->where('status','active');
	   $query = $this->db->get($this->tableFeaturePlan);
	   return $query->result();
	 }
	 function getPackageFieldAndAppNameBYid($id)
	 {
	   $this->db->select($this->tablefields.'.field_name,'.$this->tableApps.'.app_name');
	   $this->db->where($this->tablefields.'.id',$id);
	   $this->db->join($this->tableApps,$this->tableApps.'.id='.$this->tablefields.'.app_id');
	   $query = $this->db->get($this->tablefields);
	   return $query->row();
	 }
}
