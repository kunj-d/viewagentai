<?php
class Login_Model extends CI_Model
{
	
	var $tablename='tbl_sag_user';	
	var $tablenameLog='tbl_sag_user_log';	
	
	
	function do_login(){ 
	 	$this->db->where('email',$this->input->post('email'));
		$this->db->where('password',md5($this->input->post('password')));
		$this->db->where('status','active');
	 	$query = $this->db->get($this->tablename);
		//echo $this->db->last_query(); die;
	 	$adminRow = $query->row();
	 
			
		if($adminRow->email)
		{
			$this->session->set_userdata('ADMIN_LOGIN_TYPE','1');
			$this->session->set_userdata('SAG_mem_id',$adminRow->id);
			$this->session->set_userdata('PRIVILEDGES',$adminRow->privileges);
			$this->session->set_userdata('SAG_membername',$adminRow->name);
			$this->session->set_userdata('profile_image',$adminRow->profile_image);
			
			$sSql = "SELECT parent_id FROM tbl_sag_manager WHERE mng_id IN ($adminRow->privileges)";
			$query = $this->db->query($sSql);
			$adminPri = $query->result();	
			for($j=0; $j<count($adminPri);$j++)
			$parentArr[] = $adminPri[$j]->parent_id;
			$parentArr	=	array_unique($parentArr);
			$this->session->set_userdata('parentArr',$parentArr);
		
			return '1';
		}
		else
		{
			return '0';
	 	}
	 }
	function create_log($browser,$version,$platform,$mobile){
		$operating_system=($mobile!="")?$platform.'-'.$mobile:$platform;
		$data = array(
		   'user_id' => '1',
		   'email' => $this->input->post('email'),
		   'login_date' => date("Y-m-d H:i:s"),
		   'login_ip' => $_SERVER['REMOTE_ADDR'],
		   'operating_system' => $operating_system,
		   'browser' => $browser."-Version-".$version
		);
		$this->db->insert($this->tablenameLog, $data); 
	}
}