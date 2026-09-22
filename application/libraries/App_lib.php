<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_lib{
	public function user_privilege(){
		$permissions=array();
		
		$CI =& get_instance();
		$user_id = $this->get_session_user('id');
		$owner_id = $this->get_session_user('owner_id');
		if($CI->session->userdata('business')){
			$business_id = $CI->session->userdata('business')['id'];
		}else{
			$business_id = 0;
		}
		if($user_id != $owner_id){
			
			$CI->db->where('user_id',$user_id);
			$CI->db->where('business_id',$business_id);
			$query = $CI->db->get('team_users');
			if($query->num_rows()){
				
				$result = $query->result_array();
				$role_ids = array_column($result,'role_id');
				$CI->db->where_in('role_id',$role_ids );
				$CI->db->where('status',1);
				$query = $CI->db->get('default_privileges');
				$permissions = array_column($query->result_array(),'slug');
				if(in_array(4,$role_ids)){
					foreach($result as $key=>$value){
						if($value['role_id']==4)
						$custom_role_ids = json_decode($value['custom_role_ids']);
					}
					$CI->db->where_in('id',$custom_role_ids);
					$CI->db->where('status',1);
					$query = $CI->db->get('default_privileges');
					$custom_privilegs = $query->result_array();
					foreach($custom_privilegs as $key=>$value){
						$permissions[] = $value['slug'];
					}
				}
			}
		}else{
			$CI->db->where('role_id',0);
			$CI->db->where('status',1);
			$query = $CI->db->get('default_privileges');
			$permissions = array_column($query->result_array(),'slug');
		}
		
		return $permissions;
	} 
	public function all_user_privilege(){
		$CI =& get_instance();
		$CI->db->where('role_id',0);
		$CI->db->where('status',1);
		$query = $CI->db->get('default_privileges');
		$permissions = array_column($query->result_array(),'slug');
		return $permissions;

	}
	public function get_session_user($field){
		$CI =& get_instance();
		$CI->load->library('session');
		
		if($CI->session->userdata('logged_in')){ 
			$userdata = $CI->session->userdata('logged_in');
			return $userdata[$field];
		}else{
			return 0;
		}
	}
	function get_user_plan($user_id = 0){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$owner_id = $userdata['owner_id'];
		// if($user_id == 0){
			// $userdata = $CI->session->userdata('logged_in');
			// if($user_id == 0){
				// $user_id = $userdata['id'];
			// }
			// $owner_id = $userdata['owner_id'];
		// }else{
			// $owner_id = $user_id ;
		// }
		$CI->db->select("user_package,add_time");
		// if($user_id != $owner_id && $owner_id!=0){  //Sub user
			// $CI->db->where('id', $owner_id);
		// }else{
			// $CI->db->where('id', $user_id);
		// }
		$CI->db->where('id', $owner_id);

		$query = $CI->db->get('tbl_user');
		$result = $query->row_array();
		$user_package = json_decode($result["user_package"],1);
		
		if(isset($user_package['add_time'])){
			$buy_date = $user_package['add_time'];
			$exp_date = strtotime('+14 days', $user_package['add_time']);
			$cur_date = time();
			
			if($cur_date >= $exp_date){
				//Plan Expire Start(Date 19/12/2018)
					// $result = $CI->db
					// ->select("*")
					// ->from("tbl_package_purchase")
					// ->where(array('user_id' => $owner_id, 'sell_type' => 'fe-0', 'status' =>'active'))
					// ->order_by("id","desc")
					// ->get();
					// $row1 = $result->row();
					// if($result->num_rows() >= 1){
					// 	$update_id=$row1->id;
					// 	if(time() - (86400 * 14) > $row1->add_time){		
					// 		$CI->db->set('status', 'inactive')->where(array('user_id' => $owner_id, 'sell_type' => 'fe-0'))->update('tbl_package_purchase');				
					// 		$CI->db->set('status', 'expire')->where(array('id' =>$update_id))->update('tbl_package_purchase');
					// 		$CI->load->model('package/Package_purchase_Model');
					// 		$user_package = $CI->Package_purchase_Model->checkForPackage($owner_id);
					// 		$CI->load->model('package/Order_Model');
					// 		$CI->Order_Model->updateUserPackage($owner_id,$user_package);			
							
					// 	}
					// }

				//Plan Expire End
			}
		}

		if(!isset($user_package['fields'])){
			$user_package['fields']['business_count']['value'] = 'zero';
			$user_package['fields']['team_count']['value'] = 'zero';
			$user_package['fields']['product_count']['value'] = 'zero';
			$user_package['fields']['funnel_count']['value'] = 'zero';
			$user_package['fields']['fb_share_count']['value'] = 'zero';
		}
		if(!isset($user_package['features'])){
			$user_package['features']=array();
		}
		// $user_package['fields']['business_count']['value'] = 'unlimited';
		// $user_package['fields']['team_count']['value'] = 'unlimited';
		// $user_package['fields']['product_count']['value'] = 'unlimited';
		// $user_package['fields']['funnel_count']['value'] = 'unlimited';
		// $user_package['fields']['fb_share_count']['value'] = 'unlimited';
		
		return $user_package;
	}
	function get_business_count(){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$user_id = $userdata['id'];
		$owner_id = $userdata['owner_id'];
		
		$CI->db->select("id");
		$CI->db->where('owner_id', $owner_id);
		$query = $CI->db->get('tbl_user');
		$user_ids = array_column($query->result_array(),'id');
		
		$CI->db->select("id");
		$CI->db->where_in('user_id', $user_ids);
		$query = $CI->db->get('business');
		return $query->num_rows();
	}





	function session(){
		$CI =& get_instance();
		$CI->load->library('session');
		echo "<pre>";
		print_r($CI->session->userdata);
		echo "</pre>";
	}
	
	function timezone_user($date){
		$CI =& get_instance();
		$timezone = $CI->session->userdata('timezone');
		return date("Y-m-d H:i:s",strtotime("-".$timezone." minutes",strtotime($date)));
	}
	function timezone_php($date){
		$CI =& get_instance();
		$timezone = $CI->session->userdata('timezone');
		return date("Y-m-d H:i:s",strtotime("+".$timezone." minutes",strtotime($date)));
	}
	function timezone_mysql($date){
		$CI =& get_instance();
		$timezone = $CI->config->item('timeoffset_sql');
		return date("Y-m-d H:i:s",strtotime("+".$timezone." minutes",strtotime($date)));
	}

	function timezone_php_user($date){
		$CI =& get_instance();
		$timezone = $CI->session->userdata('timezone');
		return date("Y-m-d H:i:s",strtotime("-".$timezone." minutes",strtotime($date)));
	}
	function timezone_mysql_user($date){ //pending
		return $this->timezone_php_user($this->timezone_mysql_php($date));
	}
	function timezone_php_mysql($date){
		$CI =& get_instance();
		$timezone = $CI->config->item('timeoffset_sql');
		return date("Y-m-d H:i:s",strtotime("+".$timezone." minutes",strtotime($date)));
	}
	function timezone_user_mysql($date){
		return $this->timezone_php_mysql($this->timezone_user_php($date));
	}
	function timezone_user_php($date){
		$CI =& get_instance();
		$timezone = $CI->session->userdata('timezone');
		return date("Y-m-d H:i:s",strtotime($timezone." minutes",strtotime($date)));
	}
	function timezone_mysql_php($date){
		$CI =& get_instance();
		$timezone = $CI->config->item('timeoffset_sql');
		return date("Y-m-d H:i:s",strtotime("-".$timezone." minutes",strtotime($date)));
	}
	
	
	
	function get_page_count(){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$user_id = $userdata['id'];
		
		$CI->db->select("id");
		$CI->db->where('user_id', $user_id);
		$CI->db->where('page_id',0);
		// $CI->db->where('status !=','D');
		$query = $CI->db->get('campaigns');
		return $query->num_rows();
	}
	
	
	
	 function get_team_count(){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$user_id = $userdata['id'];
		$owner_id = $userdata['owner_id'];
		
		$CI->db->select("id");
		$CI->db->where('owner_id', $owner_id);
		$query = $CI->db->get('tbl_user');
		$team_count = $query->num_rows();
		if($team_count>1){
			$team_count = $team_count-1;//Self Minus
		}else{
			$team_count=0;
		}
		return $team_count;
	} 
	
	 function get_template_plan(){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		//$user_id = $userdata['id'];
		$user_id = $userdata['owner_id'];
		
		$CI->db->select("GROUP_CONCAT(distinct package_id) as plan_ids");
		$CI->db->where('user_id', $user_id);
		$CI->db->where('status', 'active');
		$query = $CI->db->get('tbl_package_purchase');
		$result = $query->row_array();
		return $result["plan_ids"];
	} 
	
	 function get_visitor_count(){
			
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$user_id = $userdata['id'];
		
		$CI->db->select("id");
		$CI->db->where('user_id', $user_id);
		$query = $CI->db->get('businesses');
		if($query->num_rows() == 0){
			return 0;
		}
		$business_ids = $query->result_array();
		$business_ids_col = array_column($business_ids,'id');

		$CI->db->select("id");
		$CI->db->where_in('bussiness_id',$business_ids_col);
		$query = $CI->db->get('campaign_reports');
		return $query->num_rows();
	} 
	
	 function is_trail_expr(){
		$CI =& get_instance();
		$userdata = $CI->session->userdata('logged_in');
		$user_id = $userdata['id'];
		
		$CI->db->select("add_time");
		$CI->db->where('user_id', $user_id);
		$CI->db->where('package_id', 9);
		$CI->db->where('status', 'active');
		$query = $CI->db->get('tbl_package_purchase');
		if($query->num_rows() == 0){
			return true;
		}
		else{
			$plan_date = $query->row_array();
			
			$buy_date = $plan_date['add_time'];
			$exp_date = strtotime('+14 days', $plan_date['add_time']);
			$cur_date = time();
			if($cur_date >= $exp_date){
				return true;
			}
		}
		return false;
	} 
	 function is_plan_expr(){
		$plans = $this->get_template_plan();
		if($plans == '9'){
			return $this->is_trail_expr();
		}else{
			return false;
		}
	} 
	
	
	 function get_plan_ids($owner_id = 0){
		$CI =& get_instance();
		if($owner_id == 0){
			if($CI->session->userdata('logged_in')){ 
				$userdata = $CI->session->userdata('logged_in');
				$owner_id= $userdata['owner_id'];
			}else{
				return array();
			}
		}
		$CI->db->select("package_id");
		$CI->db->where("status",'active');
		$CI->db->where("user_id",$owner_id);
		$query=$CI->db->get("tbl_package_purchase");
		$result=$query->result_array();
		//echo $CI->db->last_query();die;
		$pacakge_ids=array_column($result, 'package_id');
		return $pacakge_ids;
	} 
	
}
