<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Common_Model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        // pr($this->getChatTitle('1'));
        // die;
        
             $this->business_id = !empty($this->session->userdata("business")["id"]) ? $this->session->userdata("business")["id"] : '';
        if (!empty($this->session->userdata("logged_in")) && $this->session->userdata("logged_in")) {
            $this->user_id = $this->session->userdata("logged_in")["id"];
            $this->owner_id = $this->session->userdata("logged_in")["owner_id"];

       
            $userInfo = $this->getSingleRowFromAnyTable("id", $this->session->userdata("logged_in")["owner_id"], "tbl_user");
            if ($userInfo->welcome_status == '0') {
                $current_route = $this->uri->segment(1);
                $welcome_array = array("welcome", "logout");
                if (!in_array($current_route, $welcome_array)) { 
                    redirect($this->config->item("redirectMainUrl") . "welcome");
                }
            }
            
        }
    }




    	 //fetch all categories in members area(created by trilok)
	public function getAllBonuses(){
		$this->db->select("tbl_bonus_categories.title,tbl_bonus_categories.slug");
		$this->db->where('tbl_bonus_categories.status','active');
		$query = $this->db->get('tbl_bonus_categories');
		if($query->num_rows()>0)
		    return $query->result();
		return 0;
	}

    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString = rand(5, 9) . $randomString . rand(1, 4);
        return $randomString;
    }
    
   
    
     public function set_user_logs($activity, $description) {
        if ($this->session->userdata('logged_in')) {
            $logged_in = $this->session->userdata('logged_in');
            $this->user_id = $logged_in['id'];
            $this->owner_id = $logged_in['id'];
            if ($this->session->userdata('business')) {
                $business_id = $this->session->userdata('business')['id'];
            } else {
                $business_id = 0;
            }
            if ($this->user_id != $this->owner_id && $this->owner_id != 0) {
                if ($business_id == 0) {
                    $role = '';
                } else {
                    $this->db->where('business_id', $this->business_id);
                    $this->db->where('user_id', $this->user_id);
                    $this->db->where('owner_id', $this->owner_id);
                    $query = $this->db->get('team_users');
                    $role_id = $query->result_array()[0]['role_id'];
                    $role = $query->result_array()[0]['custom_role_title'];
                    if ($role_id != 4) {
                        $this->db->where('id', $role_id);
                        $query = $this->db->get('default_role_type');
                        $role = $query->row_array()['slug'];
                    }
                }
            } else {
                $role = 'admin';
            }

            $this->db->set('user_id', $this->user_id);
            $this->db->set('owner_id', $this->owner_id);
            $this->db->set('business_id', $business_id);
            $this->db->set('name', $logged_in['name']);
            $this->db->set('email', $logged_in['email']);
            $this->db->set('role', $role);
            $this->db->set('activity', $activity);
            $this->db->set('description', $description);
            $this->db->set('created', time());
            $this->db->insert('user_logs');
        }
    }



    /*     * **********************************************************************************************************
     * ******************************Product Installtion End*******************************************************
     * ************************************************************************************************************ */
     
     
      
      public function checkSubDomain() {
         
        $this->getBusiness_Count();
        if (!$this->session->userdata('business')) {
            $this->db->select('last_business_id');
            $this->db->where('id', $this->user_id);
            $query = $this->db->get('tbl_user');
            $result = $query->row_array();
            $business_id = $result['last_business_id'];

            if ($business_id > 0) {
                if ($this->isBusinessExist($business_id) == 0) {
                    $this->db->set('last_business_id', 0);
                    $this->db->where('id', $this->user_id);
                    $this->db->update('tbl_user');

                    $this->session->unset_userdata('business_id');
                    $this->session->unset_userdata('business');

                    $flashdata['error']['message'] = 'Error! Select Workspace first.';
                    $flashdata['error']['type'] = 'flash';
                    $this->session->set_flashdata('message', json_encode($flashdata));
                    redirect($this->config->item("redirectMainUrl") . 'workspace');
                }
           $redirect_url = base_url('workspace_switch') . "/" . $business_id;
            //     die;
                redirect($redirect_url);
            }
            $flashdata['error']['message'] = 'Please! Select Workspace First.';
            $flashdata['error']['type'] = 'flash';
            $this->session->set_flashdata('message', json_encode($flashdata));
            redirect($this->config->item("redirectMainUrl") . 'workspace');
        } else {
            $current_domain = current(explode('.', $_SERVER['HTTP_HOST']));
            $domain = $this->session->userdata('business')['domain'];
            if ($current_domain == 'www' || $current_domain != $domain) {
                if (!$this->session->has_userdata('integration_sales_force')) {
                    $business_id = $this->session->userdata('business')['id'];
                    $redirect = base_url('workspace_switch') . "/" . $business_id;
                    redirect($redirect);
                }
            }
        }
    }
    
        function isBusinessExist($business_id) {
        $this->db->select('id');
        $this->db->where('id', $business_id);
        //$this->db->where('user_id', $this->user_id);
        $query = $this->db->get('business');
        return $query->num_rows();
    }
    
       function getBusiness_Count() {
     
        if ($this->user_id != $this->owner_id && $this->owner_id != 0) {
            $this->db->where('id', $this->user_id);
            $query = $this->db->get('tbl_user');
            if ($query->num_rows()) {
                $business_ids = array_column($query->result_array(), 'last_business_id');
       
            } else {
                $business_ids = array();
            }
        
            $this->db->select('id,domain');
            $this->db->where_in('id', $business_ids);
            $query = $this->db->get('business');
        } else {
            $this->db->select('id,domain');
            $this->db->where('user_id', $this->owner_id);
            $query = $this->db->get('business');
               
        }
    
        $count_rows = $query->num_rows();
        if ($count_rows == 0) {
            // $flashdata['error']['message'] = 'Error! Create business first.';
            // $flashdata['error']['type'] = 'flash';
            // $this->session->set_flashdata('message', json_encode($flashdata));
            redirect($this->config->item("redirectMainUrl") . 'create-workspace');
        }
      
        return $count_rows;
    }
    
        public function checkCustomDomainAndRedirectToFrontEnd($custom_domain){ 
		$domain_data = explode(".",$_SERVER['HTTP_HOST']);
        $this->db->like('custom_domain',$custom_domain);
        $query = $this->db->get('custom_domain_settings');
        if($query->num_rows()>0){
            $custom_domain_data = $query->row_array();
            $this->session->set_userdata('custom_domain_data',$custom_domain_data);
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if($this->session->flashdata('sitemap')=='sitemap'){
				redirect($actual_link);
			}
			if($domain_data[0]=='www' && $_SERVER[REQUEST_URI]=='/login'){
			redirect(base_url('login'));
			}
			redirect($actual_link);
        }
    }
    
     public function checkFeatureInPlanArray($feature) {
        if ($this->all_plan_features) {
            if (in_array($feature, $this->all_plan_features)) {
                return true;
            }
        }
        return false;
    }
    
    public function getAllRowFromAnyTable($tableName,$offset = 0,$limit) {
        $this->db->select('*');
        $query = $this->db->limit($limit, $offset)->get($tableName);
        $data = $query->result();
        return $data;
    }

    public function getConditionRow($tableName, $conditions = [],$offset=0,$limit=null) {
        $this->db->select('*');
        if (!empty($conditions)) {
            foreach ($conditions as $column => $value) {
                log_message('error', "Applying condition: $column => $value");
                $this->db->where($column, $value);
            }
        }
        // $query = $this->db->get($tableName);
        $query = $this->db->limit($limit, $offset)->get($tableName);
        
       /*  echo $this->db->last_query();
        die('sid'); */
        return $query->result();
    }

     public function getSingleRowFromAnyTable($conditionColoum, $conditionValue, $tableName) {
        $this->db->select('*');
        $this->db->where($conditionColoum, $conditionValue);
        $query = $this->db->get($tableName);
        $data = $query->row();
        return $data;
    }

    public function InsertIntoAnyTable($table_name, $insert) {
        $this->db->set($insert);
        $this->db->insert($table_name);
        return $this->db->insert_id();
    }

    public function updateAnyTable($table_name, $where, $update) {
        $this->db->set($update);
        $this->db->where($where);
        $this->db->update($table_name);
    }

    public function deleteFromAnyTable($table_name, $where) {
        $this->db->where($where);
        $this->db->delete($table_name);
    }
    
     /* Return Single/Multiple Row  as array */

    public function getSingleRowFromTable($tableName, $condition, $order_on = false, $order_by = 'desc') {
        $this->db->select('*');
        $this->db->where($condition);
        if ($order_on) {
            $this->db->order_by($order_on, $order_by);
        }
        $query = $this->db->get($tableName);
        return $query->result_array();
    }
    
    
    function checkPlanCountAccess($condition,$ajax){

		$totalCount = 0;

		//echo "<pre>"; print_r($this->session->userdata());die;

		$planConditionValue = $this->session->userdata('fields_counts')[$condition]['value'];

		if($planConditionValue !='unlimited'){

			switch($condition){

				case 'business_count' :  
						$totalCount = $this->getRowCounts("business"); 
						break; 
				case 'client_count' :  
						$totalCount = $this->getRowCounts("client_count"); 
						break;
				case 'app_set' :  
						$totalCount = $this->getRowCounts("customer_app_sets"); 
						break;
				case 'copilot' :  
						$totalCount = $this->getRowCounts("prompts"); 
						break;
                case 'app' :  
						$totalCount = $this->getRowCounts("customer_apps"); 
						break;
                case 'photo_avatar_count' :  
						$totalCount = $this->getRowCounts("photo_avatar_count"); 
						break;
                case 'video_avatar_count' :  
						$totalCount = $this->getRowCounts("video_avatar_count"); 
						break;
                case 'youtube_upload_count' :  
						$totalCount = $this->getRowCounts("youtube_upload_count"); 
						break;
                case 'thumbnail_generate_count' :  
						$totalCount = $this->getRowCounts("thumbnail_generate_count"); 
						break;
			}

			//echo $totalCount." ".$planConditionValue;die;

			if($totalCount >= $planConditionValue){

				$flashdata['error']['message']  = 'You have Crossed Your Plan Limit. Please Upgrade your Subscription Plan';

				$flashdata['error']['type']	 	= 'flash';

				if($ajax){

					echo json_encode($flashdata);

					die();

				}

				else{

					$this->session->set_flashdata('message', json_encode($flashdata));

					redirect('subscription');

				}

			}

			return true;

		}

		else {

			return true;

		}	

	}
	
	
	 /* Get single field from table */

    public function getSingleFieldFromAnyTable($fieldName, $conditionColoum, $conditionValue, $tableName) {
        $this->db->select($fieldName);
        $this->db->where($conditionColoum, $conditionValue);
        $query = $this->db->get($tableName);
        $data = $query->row();
        return $data->$fieldName;
    }
	
	
	public function getRowCounts($table)

	{

		if($table != 'client_count' && $table != 'customer_app_sets'  && $table != 'customer_apps' && $table != 'youtube_upload_count' && $table != 'video_avatar_count'  && $table != 'photo_avatar_count' && $table != 'thumbnail_generate_count') { 
			$this->db->select("id"); 
			$this->db->where("user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get($table); 
		}else if($table == 'customer_app_sets'){
            $this->db->select("cas_id"); 
            $this->db->from('customer_app_sets appset'); 
			$this->db->join('business b','b.id=appset.cas_business_id','inner'); 
			$this->db->where("b.user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get();
		}else if($table == 'customer_apps'){
            $this->db->select("ca_id"); 
            $this->db->from('customer_apps apps'); 
			$this->db->join('business b','b.id=apps.ca_business_id','inner'); 
			$this->db->where("b.user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get();
		}else if($table =="photo_avatar_count"){
			$this->db->select("id"); 
			$this->db->where("user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$this->db->where("avatar_type","photo"); 
			$query=$this->db->get("library"); 
		}else if($table =="video_avatar_count"){
			$this->db->select("id"); 
			$this->db->where("user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$this->db->where("avatar_type","video"); 
			$query=$this->db->get("library"); 
		}else if($table =="youtube_upload_count"){
			$this->db->select("id"); 
			$this->db->where("user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get("youtube_publisher"); 
		}else if($table =="thumbnail_generate_count"){
			$this->db->select("id"); 
			$this->db->where("user_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get("publisher_chat"); 
		}else{ 
			$this->db->select("id"); 
			$this->db->where("owner_id",$this->session->userdata("logged_in")["owner_id"]); 
			$query=$this->db->get("tbl_user"); 
		}

		return $query->num_rows();

	}
    
    public function get_data( $table_name, $where = array(), $field = '*', $order = array() ){
        $this->db->select( $field );
        $this->db->from( $table_name );
        if( !empty($where) ){
             $this->db->where( $where );
        }
        if(!empty($order)){
            foreach($order as $k=>$v){
                $this->db->order_by($k, $v);
            }
        }
        $query = $this->db->get();
        return $query->result_array();   
    }
    
    public function get_join_data( $table_name, $join_table, $on, $where = array(), $field = '*', $order = array(), $join = 'inner', $group = '' ){
        $this->db->select( $field );
        $this->db->from( $table_name );
        
        if(!empty($join_table) && !empty($on)){
            $this->db->join( $join_table, $on, $join );
        }
        
        if( !empty($where) ){
            $this->db->where( $where );
        }
        
        if(!empty($order)){
            foreach($order as $k=>$v){
                $this->db->order_by($k, $v);
            }
        }
        
        if( !empty($group) ){
            $this->db->group_by( $group ); 
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function put_data( $table_name, $what = array() ){
        $this->db->insert($table_name,$what);
        return $this->db->insert_id();
    }
    
    	public function get_data_limit( $table_name, $where = array(), $field = '*', $limit = array(), $orderby = '', $order = '', $where_in = array()){
		$this->db->select( $field );
		$this->db->from( $table_name );
		if( !empty($where) ){
			$this->db->where( $where );
		}
		if( !empty($where_in) ){
			foreach($where_in as $k=>$v){
				$this->db->where_in( $k, $v );
			}
		}
		
		if(isset($limit[1]) && $limit[1] !== '' && $limit[0] !== ''){
			$this->db->limit($limit[1], $limit[0]);
		}
		
		if($orderby != '' && $order != ''){
			$this->db->order_by($orderby, $order);
		}
		
		$query = $this->db->get();
        return $query->result_array();
	}
    
    public function query( $query, $return = true ){
        $query = $this->db->query( $query );
        if($return){
            return $query->result_array();
        }
    }
    
    public function set_data( $table_name, $what = array() , $where = array()){
        $this->db->where($where);
        $this->db->update($table_name,$what);
    }
    
    public function delete_data( $table_name, $what = array() ){
        $this->db->delete( $table_name, $what);
    }

}
