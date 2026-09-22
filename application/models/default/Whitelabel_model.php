<?php
class Whitelabel_model extends CI_model{
   
    
	public function insertdata($datatoinsert){
		//print_r($datatoinsert); die;
		//$this->db->where('userid',$datatoinsert['userid'])
		//$this->db->delete('web_setting');
		
		$this->db->insert('web_setting',$datatoinsert);
		return;
   }
   public function getdata($userid){
	   $this->db->where('userid',$userid);
	   $query=$this->db->get('web_setting');
	   $result=$query->result();
	   
	   return $result;
   }
   public function getThemeSetting($userid){
	   $this->db->where('userid',$userid);
	   $query=$this->db->get('theme_style');
	   $result=$query->result();
	   return $result;
   }
   public function updatedata($datatoupdate){
	   $userid=$this->session->userdata('business')['id'];
	   
	   $this->db->where('userid',$userid); 
	   $this->db->update('web_setting',$datatoupdate);
	   return;
   }
}


?>	