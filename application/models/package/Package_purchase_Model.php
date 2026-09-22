<?php
class Package_purchase_Model extends CI_Model
{
	
	var $tablePurchase='tbl_package_purchase';	
	var $tablePackagePlan='tbl_package_plans';	
	var $tablePackageFields='tbl_package_fields';	
	var $tableFeaturePlan='tbl_feature_plans';	
	var $tableFeatures='tbl_features';	
	
	function getPurchaseData($user_id){
	
		$this->db->where('user_id',$user_id);
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->tablePurchase);
		return $query->result_array();
	 }
	function getPackageFields($appArr){
	
		$this->db->where_in('app_id',$appArr);
		$query = $this->db->get($this->tablePackageFields);
		return $query->result_array();
	 }
	function getFeaturePlan($id){
	
		$this->db->where('id',$id);
		$query = $this->db->get($this->tableFeaturePlan);
		return $query->row_array();
	 }
	 function getFeatures($features){
	
		$this->db->where_in('id',$features);
		$query = $this->db->get($this->tableFeatures);
		return $query->result_array();
	 }
	public function setFreeplan($email,$password)
	{
	     $user_email = $email;
		 $pkg_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','plan_type','free','tbl_package_plans');
		 
		 $packageDetail = $this->Order_Model->getPackageDetailByid($pkg_id);

		 $transaction_id = 0;
		 $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$user_email,'tbl_user');
		 $cust_name = $this->Common_Modal->getSingleFieldFromAnyTable('name','id',$user_id,'tbl_user');	 
		 
		 $purchase_id = $this->Order_Model->addPackagePurchase($user_id,$transaction_id,$pkg_id);
		 $data['price']   =   '0.00';
		 $data['package_id'] = $packageDetail->id;
		 $data['user_id'] = $user_id;
		 $data['user_email'] = $user_email;
		 $data['payment_mode']         =   'Free';
		 $data['payment_status']         =   'complete';
		 $data['trans_id']         =   $transaction_id;
		 $data['purchase_id']         =   $purchase_id;
		 $order_id =  $this->Order_Model->addPackageOrder($data);
		 $user_package = $this->checkForPackage($user_id);
		 $this->Order_Model->updateUserPackage($user_id,$user_package);
		// $this->Mailsending_Model->SignUpFreePlanMail($cust_name,$packageDetail->title,$user_email,$password);
			   
	   
	}
	public function checkForPackage($user_id)
	{
		$list = $this->getPurchaseData($user_id);

		if($list){
			
			$appArr = array();
			$featuresArr = array();
			$fieldsArr = array();
			foreach($list as $valList) 
			{
				$feature_plan = $this->getFeaturePlan($valList['feature_plan']);
				
				$featureIDS = unserialize($feature_plan['feature_ids']);
				$featuresArr1 = $this->getFeatures($featureIDS);
				$fieldsArr1 = unserialize($valList['fields'])[1];
				
				$appArr = array_unique(array_merge($appArr,unserialize($valList['app_ids'])));
				$featuresArr = array_unique(array_merge($featuresArr,$featuresArr1),SORT_REGULAR);
				 
				 foreach($fieldsArr1 as $keyF=>$valF)
				 {
				  if($fieldsArr1[$keyF][0]=='unlimited' || $fieldsArr[$keyF][0]=='unlimited')
				  $fieldsArr1[$keyF][0] = 'unlimited';
				  else {
				    if($fieldsArr1[$keyF][0]>$fieldsArr[$keyF][0])
					$fieldsArr1[$keyF][0] = $fieldsArr1[$keyF][0];//+$fieldsArr1[$keyF][0];
					else
					$fieldsArr1[$keyF][0] = $fieldsArr[$keyF][0];
				  }
				 }
				  
				$fieldsArr = $fieldsArr1;
			}
			
			//die;
			$package_fields = $this->getPackageFields($appArr);
			$SelectedFeaturesArr = array();
			foreach($featuresArr as $key1=>$val1)
			 {
			   $SelectedFeaturesArr[] = $val1['condition_val'];
			 }
           
			foreach($package_fields as $key=>$val)
			{ 
			  $newkey =  $val['condition_val'];
			  $package_fields[$newkey] = $package_fields[$key];
			  unset($package_fields[$key]);
			  $package_fields[$newkey]['value'] = $fieldsArr[$val['id']][0];
			  $package_fields[$newkey]['type_value'] = $fieldsArr[$val['id']][1];
			}
			
			$packageData = array();
			$packageData['user_id'] = $list[0]['user_id'];
			$packageData['title'] = $list[0]['title'];
			$packageData['package_id'] = $list[0]['package_id'];
			$packageData['fields'] = $package_fields;
			$packageData['features'] = $SelectedFeaturesArr;
			$packageData['add_time'] = $list[0]['add_time'];
			$packageData['plan_type'] = $list[0]['plan_type'];
			$packageData['sell_type'] = $list[0]['sell_type'];
			$packageData['paid_user'] = 'yes';
        } else { $packageData['paid_user'] = 'no'; }
        
		
		return json_encode($packageData);
	}
	
	
		public function setFreeBonusPlan($email,$password)
			
        	{
        	     $user_email = $email;
        		 $pkg_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','sell_type','bonus_plan','tbl_package_plans');
        		 
        		 $packageDetail = $this->Order_Model->getPackageDetailByid($pkg_id);
        
        		 $transaction_id = 0;
        		 $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$user_email,'tbl_user');
        		 $cust_name = $this->Common_Modal->getSingleFieldFromAnyTable('name','id',$user_id,'tbl_user');	 
        		 
        		 $purchase_id = $this->Order_Model->addPackagePurchase($user_id,$transaction_id,$pkg_id);
        		 $data['price']   =   '0.00';
        		 $data['package_id'] = $packageDetail->id;
        		 $data['user_id'] = $user_id;
        		 $data['user_email'] = $user_email;
        		 $data['payment_mode']         =   'Free';
        		 $data['payment_status']         =   'complete';
        		 $data['trans_id']         =   $transaction_id;
        		 $data['purchase_id']         =   $purchase_id;
        		 $order_id =  $this->Order_Model->addPackageOrder($data);
        		 $user_package = $this->checkForPackage($user_id);
        		 $this->Order_Model->updateUserPackage($user_id,$user_package);
        		 //$this->Mailsending_Model->SignUpFreePlanMail($cust_name,$packageDetail->title,$user_email,$password);
    	   
        	}
}
