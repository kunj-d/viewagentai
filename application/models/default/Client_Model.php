<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_Model extends CI_model {

   public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $business = $this->session->userdata('business');
        $this->business_id = $business['id'];
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }
    public function getClientListJson(){
		$query = $this->getTeamListJson1();
		// echo $this->db->last_query();
		// die;
		$result["data"]= $query->result_array();
		$result['filtered_records'] =$query->num_rows();
		
		$query = $this->getTeamListJson1(true);
		$result['total_records'] =$query->num_rows();
		
		return $result;
	}
	public function getTeamListJson1($get_count = false){
		$limit = $this->input->get('limit');
		$pageNo = $this->input->get('pageNo');
        $start = ($pageNo - 1)*$limit;
        
        $this->db->select('u.id,team.id as team_id,u.name,u.email,team.role_id,drt.title as role,team.custom_role_title,team.business_id,team.created,b.domain');
        $this->db->from('team_users team');
        $this->db->where('team.owner_id',$this->owner_id);
        $this->db->where('team.team_type','client');
        $this->db->join('tbl_user u','team.user_id=u.id','left');
        $this->db->join('business b','team.business_id=b.id','left');
        $this->db->join('default_role_type drt','team.role_id=drt.id','left');
		$this->filter_search();
		//$this->filter_date();
		if(!$get_count){
			if(!empty($this->input->get('sorted_on'))
			){
				$sorted_by =$this->input->get('sorted_by');
				$this->db->order_by($this->input->get('sorted_on'),$sorted_by); 
			}else{
				$this->db->order_by('created','desc'); 
			}
			$this->db->limit($limit, $start);
		}
		return $query=$this->db->get();
	}
	public function filter_search(){
		if($this->input->get('searchKey')!= ""){
			$this->db->group_start();
				$this->db->or_like('name', $this->input->get('searchKey'));
				$this->db->or_like('email', $this->input->get('searchKey'));
				$this->db->or_like('role', $this->input->get('searchKey'));
				$this->db->or_like('domain', $this->input->get('searchKey'));
			$this->db->group_end();
		}
    }
}

?>