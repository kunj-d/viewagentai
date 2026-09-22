<?php
class Team_Model extends CI_Model
{
	
	var $tablename='tbl_sag_user';	
	var $tablemanager='tbl_sag_manager';	
	var $tablenameLog='tbl_sag_user_log';

	function getAllCount($status=false){
	 	if($status)
		$this->db->where('status',$status);
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getTeamList(){
	 	
		//$this->db->where('status','active');
		$query = $this->db->get($this->tablename);
		return $query->result();
	 }
	function getMemberDetail($id){
	 	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function updateTeamMember($id,$file_name){
	    
		$privileges	=	implode(',',$this->input->post('managers'));
		$permission	=	serialize($this->input->post('permission'));
		if($privileges)   
        $this->db->set('privileges',$privileges);
	    if($permission)   
        $this->db->set('permission',$permission);
		if($file_name)
	    $this->db->set('profile_image',$file_name);
		if($this->input->post('name'))
	    $this->db->set('name',$this->input->post('name'));
		if($this->input->post('email'))
	    $this->db->set('email',$this->input->post('email'));
		if($this->input->post('phone'))
	    $this->db->set('phone',$this->input->post('phone'));
		if($this->input->post('department'))
	    $this->db->set('department',$this->input->post('department'));
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
		
		if($id==$this->session->userdata('SAG_mem_id'))
		{
			if($file_name)
			$this->session->set_userdata('profile_image',$file_name);
			$this->session->set_userdata('SAG_membername',$this->input->post('name'));
			
			if($$privileges)
			 {
				$this->session->set_userdata('PRIVILEDGES',$privileges);
				$sSql = "SELECT parent_id FROM tbl_sag_manager WHERE mng_id IN ($privileges)";
				$query = $this->db->query($sSql);
				$adminPri = $query->result();	
				for($j=0; $j<count($adminPri);$j++)
				$parentArr[] = $adminPri[$j]->parent_id;
				$parentArr	=	array_unique($parentArr);
				$this->session->set_userdata('parentArr',$parentArr);	
			}
	  }
			
	}
    function addTeamMember($filename){
	    
	    $privileges	=	implode(',',$this->input->post('managers'));
		$permission	=	serialize($this->input->post('permission'));
		if($privileges)   
        $this->db->set('privileges',$privileges);
	    if($permission)   
        $this->db->set('permission',$permission);
	    $this->db->set('profile_image',$filename);
	    $this->db->set('name',$this->input->post('name'));
	    $this->db->set('password',md5($this->input->post('password')));
	    $this->db->set('email',$this->input->post('email'));
	    $this->db->set('phone',$this->input->post('phone'));
	    $this->db->set('department',$this->input->post('department'));
		$this->db->set('created_by',$this->session->userdata('SAG_mem_id'));
		$this->db->set('add_time',time());
		$this->db->insert($this->tablename);
		$domain_id = $this->db->insert_id();
	}
	function deleteMember($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->tablename);
	}
	function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
    function getAllParentManagers()
	{
		$this->db->order_by('display_order','ASC');	
		$this->db->where('parent_id',0);	
		$this->db->where('status','Active');	
	 	$query=$this->db->get($this->tablemanager);
		return $row= $query->result();	
	}
	function getAllParentSubManagers($id)
	{
		$this->db->where('parent_id',$id);	
	 	$query=$this->db->get($this->tablemanager);
		return $row= $query->result();	
	}
	function getAllLog($start_date,$end_date){

		if($start_date)
		$start_date = date('Y-m-d H:i:s',strtotime($start_date));
		if($end_date)
		$end_date = date('Y-m-d H:i:s',strtotime($end_date.' 23:59:00'));
		if($start_date)
		$this->db->where('login_date >=',$start_date);
		if($end_date)
		$this->db->where('login_date <=',$end_date);
		$this->db->order_by("log_id","desc");
	 	$query=$this->db->get($this->tablenameLog);
		$record	=	$query->result();	
		return $record;		
	}
	function clear_log(){		
		$this->db->where('log_id !=',0);
		$this->db->delete($this->tablenameLog); 
	}
	function updatePassword(){
	    $this->db->set('password',md5($this->input->post('new_pass')));
		$this->db->where('id',$this->session->userdata('SAG_mem_id'));
		$this->db->update($this->tablename);
	}
}
