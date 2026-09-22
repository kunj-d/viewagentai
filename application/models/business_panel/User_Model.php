<?php
class User_Model extends CI_Model
{
	
	var $tablename='tbl_user';	
	var $tablePackagePurchase='tbl_package_purchase';	
	var $tablePackageOrder='tbl_package_order';	
	var $tablePackageTransaction='tbl_package_transaction';	
	var $tableNewusers='tbl_user';	
	
	function getAllCount($status,$start_date,$end_date,$keyword,$plan_id){
	 	
	    $this->db->select($this->tablename.'.*');
		 if($status)
		 $this->db->where($this->tablename.'.status',$status);
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where($this->tablename.'.created >=',$start_date);
		if($end_date)
		$this->db->where($this->tablename.'.created <=',$end_date);
		if($keyword){
		$this->db->group_start();
		$this->db->like($this->tablename.'.email',$keyword);
		$this->db->or_like($this->tablename.'.name',$keyword);
		$this->db->group_end();
		}
		if($plan_id)
		{
		  $this->db->join($this->tablePackagePurchase,$this->tablename.'.id='.$this->tablePackagePurchase.'.user_id');
		  $this->db->where($this->tablePackagePurchase.'.package_id',$plan_id);
		  $this->db->where($this->tablePackagePurchase.'.status','active');
		}
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	 }
	function getUserList($start_date,$end_date,$keyword,$plan_id,$per_page,$currentpage){
	 	
		$this->db->select($this->tablename.'.*');
		//$this->db->where('status','active');
		if($start_date)
		$start_date = strtotime($start_date);
		if($end_date)
		$end_date = strtotime($end_date.' 23:59:00');
		if($start_date)
		$this->db->where($this->tablename.'.created >=',$start_date);
		if($end_date)
		$this->db->where($this->tablename.'.created <=',$end_date);
		if($keyword){
		$this->db->group_start();
		$this->db->like($this->tablename.'.email',$keyword);
		$this->db->or_like($this->tablename.'.name',$keyword);
		$this->db->group_end();
		}
		if($plan_id)
		{
		  $this->db->join($this->tablePackagePurchase,$this->tablename.'.id='.$this->tablePackagePurchase.'.user_id');
		  $this->db->where($this->tablePackagePurchase.'.package_id',$plan_id);
		  $this->db->where($this->tablePackagePurchase.'.status','active');
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	 }
	function getUserDetail($user_id){
	 	
		$this->db->where('id',$user_id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	 }
    function updateUser($user_id){
	    
		if($this->input->post('name'))
	    $this->db->set('name',$this->input->post('name'));
		if($this->input->post('phone'))
			$this->db->set('phone',$this->input->post('phone'));
		if($this->input->post('skype'))
			$this->db->set('skype_id',$this->input->post('skype'));
		if($this->input->post('country'))
			$this->db->set('country',$this->input->post('country'));
		$this->db->where('id',$user_id);
		$this->db->update($this->tablename);
	}
	
    function addUser(){
	    $this->db->set('name',$this->input->post('name'));
		$this->db->set('phone',$this->input->post('phone'));
	    $this->db->set('email',$this->input->post('email'));
		// To Entry For Skype and country of user 22/07/17
		if($this->input->post('country'))
			// $this->db->set('country',$this->input->post('country'));
	    if($this->input->post('skype'))
			$this->db->set('skype_id',$this->input->post('skype'));
		$this->db->set('password',md5($this->input->post('password')));
		$this->db->set('created',time());
		$this->db->set('modified',time());
		$this->db->set('status','active');
		
		$this->db->insert($this->tablename);
		$up_id = $this->db->insert_id();

		$this->db->set('owner_id',$up_id);
	    $this->db->where('id',$up_id);
		$this->db->update($this->tablename);

		mkdir('./assets/uploads/users/' . $up_id . '/');
		}
    
	function deleteUser($id){
	
	    $this->db->select('id');
		$this->db->where('user_id',$id);
		$query = $this->db->get('business');
		$allBusinesses = $query->result_array();
		if(count($allBusinesses)>0){
			$businessIds = array_column($allBusinesses,'id');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ad_campaign_blog');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ad_campaign');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ad_campaign_pages');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ad_campaign_product');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ad_campaign_stats');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('blog_like_stats');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('blog_visitors_stats');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('business_products_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('business_slider_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('contact_us');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('cookie_consent');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('legal_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('library');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('members');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('products_sales_page_setting');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('products_sales_report_setting');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('products_seo_setting');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('product_clicks_stats');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('product_sales');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('product_visitor_stats');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('seo_setting');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('smo_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('social_campaign');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('social_campaign_story');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('team_role');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('team_users');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('ticket');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('users_autoresponder_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('users_social_settings');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('user_blogs');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('user_blogs');

			$this->db->where_in('business_id',$businessIds);
			$this->db->delete('visitor_session');
		}
		
		$this->db->where('user_id',$id);
		$this->db->delete('user_products');

		$this->db->where('user_id',$id);
		$this->db->delete('user_products');

		$this->db->where('owner_id',$id);
		$this->db->delete('team_users');

		$this->db->where('user_id',$id);
		$this->db->delete('team_users');

		$this->db->where('user_id',$id);
		$this->db->delete('library');

		$this->db->where('owner_id',$id);
		$this->db->delete($this->tablename);
		
		$this->db->where('id',$id);
		$this->db->delete($this->tablename);
			
		$dirname = './assets/uploads/users/' . $id;
		// array_map('unlink', glob("$dirname/*.*"));
		// rmdir($dirname);
		$this->rmdir_recursive($dirname);

		$dirname = './application/views/users_sales_pages/' . $id;
		// array_map('unlink', glob("$dirname/*.*"));
		// rmdir($dirname);
		$this->rmdir_recursive($dirname);
	}
	function rmdir_recursive($dir) {
			foreach(scandir($dir) as $file) {
					if ('.' === $file || '..' === $file) continue;
					if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
					else unlink("$dir/$file");
			}
			rmdir($dir);
	}
    
	function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	function getUserpurchasedPackages($user_id){
	 	
		$this->db->select('title');
		$this->db->where('user_id',$user_id);
		$this->db->where('status','active');
		$query = $this->db->get($this->tablePackagePurchase);
		return $query->result();
	 }
	 
	function updatePassword(){
		$user_email = $this->Common_Modal->getSingleFieldFromAnyTable('email','id',$this->input->post('user_id'),'tbl_user');
		$new_password = md5($this->input->post('new_pass'));
		   		
		$this->db->set('password',$new_password);
		$this->db->where('id',$this->input->post('user_id'));
		$this->db->update($this->tablename);
		
	}
	
	function getUserPurchasedPlans($user_id)
	{
	  $this->db->select('package_id');
	  $this->db->where('user_id',$user_id);
	  $this->db->where('status','active');
	  $query = $this->db->get($this->tablePackagePurchase);
	  $data = $query->result();
	  $dataNew = array();
	  foreach($data as $va)
	  $dataNew[] = $va->package_id;
	  return $dataNew;
	
	}
    
	function getPackageDetail($id){

		$this->db->where('id',$id);
		$query = $this->db->get('tbl_package_plans');
		return $query->row();
	 }
    
	function getPackageList(){
	 	
		//$this->db->where('status','active');
		$query = $this->db->get('tbl_package_plans');
		return $query->result();
	 }	 	
	 
	 function getProductList(){
	 	$this->db->where('status','active');
	 	$query = $this->db->get('default_products');
		return $query->result();
	 }
	 
	 function getUserPurchasedProducts($user_id)
	{
		  $all_product_ids = array();
		  $this->db->select('product_id');
		  $this->db->where('user_id',$user_id);
		  $this->db->where('access_status','active');
		  $query = $this->db->get('user_products');
		  if($query->num_rows()>0){
			  $all_products = $query->result_array();
			  $all_product_ids  = array_column($all_products,'product_id');
		  }
	  return $all_product_ids;
	}
}
