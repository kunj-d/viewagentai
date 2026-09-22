<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Team_Model extends CI_model {

    var $legal_settings_table = 'legal_settings';

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $business = $this->session->userdata('business');
        $this->business_id = $business['id'];
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }
    public function updateUserBusniess($user_id,$business_id){
		$this->db->set('last_business_id',$business_id);
		$this->db->from('tbl_user');
		$this->db->where('id', $user_id);
		$this->db->update();	
    }
    public function add_team_member($team_value){
		$this->db->insert("team_users",$team_value);
		return $this->db->insert_id();
	}
	
		public function update_team_member($team_user_id, $owner_id, $team_value){
        $this->db->where('user_id', $team_user_id);
        $this->db->where('owner_id', $owner_id);
        return $this->db->update('team_users', $team_value);
    }
	
    public function addUser($user_deatil){
		$this->db->insert('tbl_user', $user_deatil);
		return $this->db->insert_id();
	}
    
    public function getTeamListJson(){
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
        $this->db->where('team.team_type','team');
        $this->db->join('tbl_user u','team.user_id=u.id','inner');
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
      public function deleteTeamRecord($team_id){
		$this->db->where('user_id',$team_id);
		$this->db->where('owner_id',$this->owner_id);
		$query = $this->db->get('team_users');
		$record=$query->result_array();

		if($query->num_rows()>0){
			$this->db->where('user_id',$team_id);
		    $this->db->where('owner_id',$this->owner_id);
			$this->db->delete('team_users');
        }
		$this->db->where('id',$record[0]['user_id']);
		$this->db->delete("tbl_user");
	} 	
	
	public function editDeleteTeamRecord($team_id){
		$this->db->where('id',$team_id);
		$this->db->where('owner_id',$this->owner_id);
		$query = $this->db->get('team_users');
		$record=$query->result_array();

		if($query->num_rows()>0){
			$this->db->where('id',$team_id);
		    $this->db->where('owner_id',$this->owner_id);
			$this->db->delete('team_users');
        }
	
	}
	
	public function getTeamRecord($where){
		$this->db->where($where);
		//$this->db->select('user.*,b.domain,b.')
		 //$this->db->from('tbl_user user');
	//	$this->db->join('business b','user.last_business_id=b.id','left');
		$query = $this->db->get('tbl_user');
		if($query->num_rows()>0){
			return $query->result_array();
        }else{
			return false;
		}
	}
	public function getUserDetail($user_id){
		$this->db->select('id,name,email');
		$this->db->where('id',$user_id);
		$query = $this->db->get('tbl_user');
		return $query->row_array();
	}
	
}

?>