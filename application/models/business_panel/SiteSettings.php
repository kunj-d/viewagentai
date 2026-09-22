<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteSettings extends CI_Model {

	var $tableName = 'settings';
	 
	public function getsettings($option_name){
	 	$this->db->select("*");
		$this->db->where('option_name',$option_name);
		$get = $this->db->get('settings');
		return $get->row();	
	 }
	public function fetch_data()
	{
		$this->db->select("*");
		$get = $this->db->get('settings');
		return $get->result();
	}	
	
	public function fetch_settings($prefix = 'Site')
	{
		$this->db->select("*");
		$this->db->like("title",$prefix); 
		$get = $this->db->get('settings');
		return $get->result();
	}	
	
	
	public function fetch_single_data($id)
	{
		$this->db->select("*");
		$get = $this->db->where('id',$id);
		$get = $this->db->get('settings');
		return $get->row();
	}
	function set_status($task,$id){
	
	if($task=='inactive'){ $task='0';}
	else{ $task = '1';}
	
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update('settings');
	}
	function deleteRecord($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('settings');
	}
	function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$this->db->limit($per_page, $currentpage);
		$query = $this->db->get('settings',$per_page,$currentpage);
		return $query->result();
	 }
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		 }
		$query = $this->db->get('settings');
		return $query->num_rows();
	 }
	 function updateSettings()
	 {
		foreach($_POST['option'] as $key=>$option)
		{
			if(is_array($_POST['values'][$key])){
				$val = implode(',',$_POST['values'][$key]);
			}
			else
			{
				$val = $_POST['values'][$key];
			}
			 
			$this->db->set('value',$val);
			$this->db->where('id',$key);
			$this->db->update('settings');
			//echo $this->db->last_query();die;
		}
	 }
	 function addSettingsFile($file)
	 {
	 	foreach($file as $key => $img){
			if($img!=''){
			$this->db->where('title',$_POST['option_images'][$key]);
			$this->db->set('value',$img);
			$this->db->update('settings');}
		}
		
	 }
	 function set_editable($task,$id)
	 {
		if($task=='0'){
			$task = '1';
		}
		else{
			$task ='0';
		}
		
		$this->db->set('editable',$task);
	    $this->db->where('id',$id);
		$this->db->update('settings');
	 }
	 
}
