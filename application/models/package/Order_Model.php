<?php
class Order_Model extends CI_Model
{
	
	var $tableTransaction='tbl_package_transaction';	
	var $tableUser='tbl_user';	
	var $tablePackagePurchase='tbl_package_purchase';	
	var $tablePackagePlans='tbl_package_plans';	
	var $tablePackageOrder='tbl_package_order';	
	var $tableEmailTemplate='tbl_email_templates';	
	
	 function addTransaction(){
        
	   $amount = $_POST['ctransamount'];
	   if($this->input->post('transaction_from'))
       $this->db->set('transaction_from',$this->input->post('transaction_from'));
	   if($this->input->post('ctransaction'))
       $this->db->set('transaction_type',$this->input->post('ctransaction'));
	   if($this->input->post('ccustname'))
       $this->db->set('name',$this->input->post('ccustname'));
	   if($this->input->post('ccustemail'))
       $this->db->set('email',$this->input->post('ccustemail'));
	   if($this->input->post('ccustcc'))
       $this->db->set('country',$this->input->post('ccustcc'));
	   if($this->input->post('cproditem'))
       $this->db->set('item',$this->input->post('cproditem'));
	   if($this->input->post('cprodtype'))
       $this->db->set('type',$this->input->post('cprodtype'));
	   if($this->input->post('ctransaffiliate'))
       $this->db->set('affiliate',$this->input->post('ctransaffiliate'));
	   if($amount)
       $this->db->set('amount',$amount);
	   if($this->input->post('ctranspaymentmethod'))
       $this->db->set('payment_method',$this->input->post('ctranspaymentmethod'));
	   if($this->input->post('ctransvendor'))
       $this->db->set('vendor',$this->input->post('ctransvendor'));
	   if($this->input->post('ctransreceipt'))
       $this->db->set('receipt_num',$this->input->post('ctransreceipt'));
	   if($this->input->post('cupsellreceipt'))
       $this->db->set('upsell_receipt',$this->input->post('cupsellreceipt'));
	   if($this->input->post('cvendthru'))
       $this->db->set('extra_info',$this->input->post('cvendthru'));
       $this->db->set('created_on',time());
	   $this->db->insert($this->tableTransaction);
	   return $this->db->insert_id();

	 }
	 
	 function checkUserExist($email){
	   $this->db->where('email',$email);
	   $query = $this->db->get($this->tableUser);
	   return $query->num_rows();
	 }
    function addUser($email,$password,$name){
		if($name)
	    $this->db->set('name',$name);
	    $this->db->set('email',$email);
	    $this->db->set('password',$password);
		$this->db->set('created',time());
		$this->db->set('status','active');
		//$this->db->set('verify_status','1');
		$this->db->insert($this->tableUser);
		$user_id =  $this->db->insert_id();
		return $user_id;
	}
    function changeUserStatus($id,$status){
	    
		$this->db->set('status',$status);
		$this->db->where('id',$id);
		$this->db->update($this->tableUser);
	}
	 function addPackagePurchaseJVZ($user_id,$transaction_id,$jvz_product_id){
        
	   $packageDetail = $this->getPackageDetail($jvz_product_id);
	   
	   $amount = $_POST['ctransamount'];
       $this->db->set('user_id',$user_id);
       $this->db->set('transaction_id',$transaction_id);
       $this->db->set('package_id',$packageDetail->id);
       $this->db->set('title',$packageDetail->title);
       $this->db->set('app_ids',$packageDetail->app_ids);
       $this->db->set('fields',$packageDetail->fields);
       $this->db->set('overages',$packageDetail->overages);
		$this->db->set('plan_type',$packageDetail->plan_type);
		$this->db->set('plan_level',$packageDetail->plan_level);
       $this->db->set('price',$packageDetail->price);
       $this->db->set('sell_type',$packageDetail->sell_type);
       $this->db->set('feature_plan',$packageDetail->feature_plan);
	   $this->db->set('jvz_product_id',$packageDetail->jvz_product_id);
	   $this->db->set('jvs_product_id',$packageDetail->jvs_product_id);
       $this->db->set('status','active');
	   $this->db->set('add_time',time());
	   $this->db->insert($this->tablePackagePurchase);
	   return $this->db->insert_id();

	 }
	 function addPackagePurchase($user_id,$transaction_id,$package_id){
        
	   $packageDetail = $this->getPackageDetailByid($package_id);
	   
       $this->db->set('user_id',$user_id);
       $this->db->set('transaction_id',$transaction_id);
       $this->db->set('package_id',$packageDetail->id);
       $this->db->set('title',$packageDetail->title);
       $this->db->set('app_ids',$packageDetail->app_ids);
       $this->db->set('fields',$packageDetail->fields);
       $this->db->set('overages',$packageDetail->overages);
       $this->db->set('plan_type',$packageDetail->plan_type);
       $this->db->set('plan_level',$packageDetail->plan_level);
       $this->db->set('price',$packageDetail->price);
       $this->db->set('sell_type',$packageDetail->sell_type);
       $this->db->set('feature_plan',$packageDetail->feature_plan);
       $this->db->set('jvz_product_id',$packageDetail->jvz_product_id);
       $this->db->set('status','active');
	   $this->db->set('add_time',time());
	   $this->db->insert($this->tablePackagePurchase);
	   return $this->db->insert_id();

	 }
	 function getPackageDetail($jvz_product_id){
	 
	   $this->db->where('jvz_product_id',$jvz_product_id);
	   $query = $this->db->get($this->tablePackagePlans);
	   return $query->row();
	 }
	 function changePackageStatus($user_id,$jvz_product_id,$status){
	 
	   $this->db->set('status',$status);
	   $this->db->where('user_id',$user_id);
	   $this->db->where('jvz_product_id',$jvz_product_id);
	   $this->db->update($this->tablePackagePurchase);
	 }
	 function updateTransaction($transaction_id,$purchase_id,$user_id){
        
       $this->db->set('purchase_id',$purchase_id);
       $this->db->set('user_id',$user_id);
       $this->db->where('id',$transaction_id);
	   $this->db->update($this->tableTransaction);
	 }
	 function getPurchaseId($user_id,$jvz_product_id){
        
       $this->db->select('id');
	   $this->db->where('user_id',$user_id);
       $this->db->where('jvz_product_id',$jvz_product_id);
	   $query = $this->db->get($this->tablePackagePurchase);
	   return $query->row()->id;
	 }
	 function addPackageOrder($data){
	 
	 
       $this->db->set('package_id',$data['package_id']);
	   if($data['user_id'])
       $this->db->set('user_id',$data['user_id']);
	   if($data['user_email'])
       $this->db->set('user_email',$data['user_email']);
	   if($data['trans_id'])
       $this->db->set('trans_id',$data['trans_id']);
	   if($data['purchase_id'])
       $this->db->set('purchase_id',$data['purchase_id']);
       $this->db->set('price',$data['price']);
       $this->db->set('payment_mode',$data['payment_mode']);
       $this->db->set('payment_status',$data['payment_status']);
       $this->db->set('order_time',time());
	   $this->db->insert($this->tablePackageOrder);
	   return $this->db->insert_id();
	 }
	 function getPackageDetailByid($id){
	 
	   $this->db->where('id',$id);
	   $query = $this->db->get($this->tablePackagePlans);
	   return $query->row();
	 }
	 function updatePackageOrder($ResponseCode,$message,$order_id,$user_id,$trans_id,$purchase_id){
	 
	   if($ResponseCode)
	   $this->db->set('payment_status',$ResponseCode);
	   if($message)
	   $this->db->set('message',$message);
	   if($user_id)
	   $this->db->set('user_id',$user_id);
	   if($trans_id)
	   $this->db->set('trans_id',$trans_id);
	   if($purchase_id)
	   $this->db->set('purchase_id',$purchase_id);
	   
	   $this->db->where('id',$order_id);
	   $this->db->update($this->tablePackageOrder);
	 }
	 function getPackageOrderDetailByid($id){
	 
	   $this->db->where('id',$id);
	   $query = $this->db->get($this->tablePackageOrder);
	   return $query->row();
	 }
	 function updateUserPackage($user_id,$package_data){
	 
	   $this->db->set('user_package',$package_data);
	   $this->db->set('owner_id',$user_id);
	   $this->db->where('id',$user_id);
		 $this->db->update($this->tableUser);
		 //Its not BMS Common Model
	 }
	function getEmailTemplateDetail($email_type){
	 
	   $this->db->where('email_type',$email_type);
	   $query = $this->db->get($this->tableEmailTemplate);
	   return $query->row();
	 }

	function changeFreePkgStatus($user_id){
		
		$this->db->select('add_time');
		$this->db->where('user_id',$user_id);
		$this->db->where('plan_type','free');
		$query=$this->db->get($this->tablePackagePurchase);
		$user_data = $query->row_array();
	 if ($this->check_time($user_data['add_time'])){ 
			$this->db->set('status','inactive');
			$this->db->where('user_id',$user_id);
			$this->db->where('plan_type','free');
			$this->db->update($this->tablePackagePurchase);
	 }
 }
 public function check_time($buy_date)
		{
		$exp_date = strtotime('+14 days', $buy_date);
		$cur_date = time();
			if($cur_date >= $exp_date){
				return 1;	
			}
			else{
				return 0;
			}
		
		}



	 //Warrior Plus
	 function addWarriorPlusTransaction(){

		// WP_ITEM_NAME - Product name entered in WarriorPlus
		// WP_ITEM_NUMBER - Item number generated by WarriorPlus (unique to this productr)
		// WP_BUYER_NAME - First and last name of the buyer
		// WP_BUYER_EMAIL - Email address of the buyer
		// WP_SALE_AMOUNT - Price the buyer paid
		// WP_SALE_CURRENCY - Currency the buyer paid with (currently always USD)
		// WP_TXNID - Payment processor generated transaction id of the sale
		// WP_SALEID - WarriorPlus generated sale id (unique to this sale)
		// WP_AFFID - WarriorPlus unique affiliate id of referring affiliate (if applicable)
		// WP_PAYMETHOD - Payment method used (ie paypal, stripe, free, wallet)
		// WP_ACTION - Action related to this IPN message (currently 'sale' or 'refund')
		// WP_SECURITYKEY - If set in your account settings, this will be sent so you can validate the authenticity of the IPN message

			$amount = $_POST['WP_SALE_AMOUNT'];
			if($this->input->post('transaction_from'))
				$this->db->set('transaction_from',$this->input->post('transaction_from'));

			if($this->input->post('WP_ACTION'))
				$this->db->set('transaction_type',$this->input->post('WP_ACTION'));

			if($this->input->post('WP_BUYER_NAME'))
				$this->db->set('name',$this->input->post('WP_BUYER_NAME'));

			if($this->input->post('WP_BUYER_EMAIL'))
				$this->db->set('email',$this->input->post('WP_BUYER_EMAIL'));

			if($this->input->post('COUNTRYCODE'))
			$this->db->set('country',$this->input->post('COUNTRYCODE'));

			if($this->input->post('WP_ITEM_NUMBER'))
				$this->db->set('item',$this->input->post('WP_ITEM_NUMBER'));

			// if($this->input->post('cprodtype'))
			// 	$this->db->set('type',$this->input->post('cprodtype'));

			if($this->input->post('WP_AFFID'))
				$this->db->set('affiliate',$this->input->post('WP_AFFID'));

			if($amount)
				$this->db->set('amount',$amount);

			if($this->input->post('WP_PAYMETHOD'))
				$this->db->set('payment_method',$this->input->post('WP_PAYMETHOD'));

			// if($this->input->post('ctransvendor'))
			// 	$this->db->set('vendor',$this->input->post('ctransvendor'));

			if($this->input->post('WP_TXNID'))
				$this->db->set('receipt_num',$this->input->post('WP_TXNID'));

			// if($this->input->post('cupsellreceipt'))
			// 	$this->db->set('upsell_receipt',$this->input->post('cupsellreceipt'));

			//if($this->input->post('cvendthru'))
				$this->db->set('extra_info',json_encode($_POST));

			$this->db->set('created_on',time());
			$this->db->insert($this->tableTransaction);
			return $this->db->insert_id();

	 }
	 function addPackagePurchaseWP($user_id,$transaction_id,$wp_product_id){
        
		$packageDetail = $this->getPackageDetailWp($wp_product_id);
		
		$amount = $_POST['WP_SALE_AMOUNT'];
			$this->db->set('user_id',$user_id);
			$this->db->set('transaction_id',$transaction_id);
			$this->db->set('package_id',$packageDetail->id);
			$this->db->set('title',$packageDetail->title);
			$this->db->set('app_ids',$packageDetail->app_ids);
			$this->db->set('fields',$packageDetail->fields);
			$this->db->set('overages',$packageDetail->overages);
			$this->db->set('plan_type',$packageDetail->plan_type);
			$this->db->set('plan_level',$packageDetail->plan_level);
			$this->db->set('price',$packageDetail->price);
			$this->db->set('sell_type',$packageDetail->sell_type);
			$this->db->set('plan_level',$packageDetail->plan_level);
			$this->db->set('feature_plan',$packageDetail->feature_plan);
			$this->db->set('wp_product_id',$packageDetail->wp_product_id);
			//$this->db->set('jvs_product_id',$packageDetail->jvs_product_id);
			$this->db->set('status','active');
			$this->db->set('add_time',time());
			$this->db->insert($this->tablePackagePurchase);
			return $this->db->insert_id();

	}
	function getPackageDetailWp($wp_product_id){
	 
		$this->db->where('wp_product_id',$wp_product_id);
		$query = $this->db->get($this->tablePackagePlans);
		return $query->row();
	}
	function changeWPPackageStatus($user_id,$wp_product_id,$status){
	 
		$this->db->set('status',$status);
		$this->db->where('user_id',$user_id);
		$this->db->where('wp_product_id',$wp_product_id);
		$this->db->update($this->tablePackagePurchase);
	}
	function getWPPurchaseId($user_id,$wp_product_id){
        
			$this->db->select('id');
		$this->db->where('user_id',$user_id);
			$this->db->where('wp_product_id',$wp_product_id);
		$query = $this->db->get($this->tablePackagePurchase);
		return $query->row()->id;
	}



	//ClickBank
	function addClickBankTransaction($response,$orderItemData,$userDetail)
	{	
		$amount = $orderItemData->accountAmount;
		$this->db->set('transaction_from',"clickbank");
		if($response->transactionType)
		$this->db->set('transaction_type',$response->transactionType);
		if($userDetail->fullName)
		$this->db->set('name',$userDetail->fullName);
		if($userDetail->email)
		$this->db->set('email',$userDetail->fullName);
		if($userDetail->address->country)
		$this->db->set('country',$userDetail->address->country);
		if($orderItemData->itemNo)
		$this->db->set('item',$orderItemData->itemNo);
		if($orderItemData->lineItemType)
		$this->db->set('type',$orderItemData->lineItemType);
		if($response->affiliate)
		$this->db->set('affiliate',$response->affiliate);
		if($amount)
		$this->db->set('amount',$amount);
		if($response->paymentMethod)
		$this->db->set('payment_method',$response->paymentMethod);
		if($response->vendor)
		$this->db->set('vendor',$response->vendor);
		if($response->receipt)
		$this->db->set('receipt_num',$response->receipt);
		$this->db->set('created_on',time());
		$this->db->insert($this->tableTransaction);
		return $this->db->insert_id();

	} 
	function addPackagePurchaseClikBank($user_id,$transaction_id,$cb_product_id)
	{
		$packageDetail = $this->getPackageDetailClickBank($cb_product_id);
		$this->db->set('user_id',$user_id);
		$this->db->set('transaction_id',$transaction_id);
		$this->db->set('package_id',$packageDetail->id);
		$this->db->set('title',$packageDetail->title);
		$this->db->set('app_ids',$packageDetail->app_ids);
		$this->db->set('fields',$packageDetail->fields);
		$this->db->set('overages',$packageDetail->overages);
		$this->db->set('plan_type',$packageDetail->plan_type);
		$this->db->set('plan_level',$packageDetail->plan_level);
		$this->db->set('price',$packageDetail->price);
		$this->db->set('sell_type',$packageDetail->sell_type);
		$this->db->set('feature_plan',$packageDetail->feature_plan);
		$this->db->set('cb_product_id',$packageDetail->cb_product_id);
		$this->db->set('status','active');
		$this->db->set('add_time',time());
		$this->db->insert($this->tablePackagePurchase);
		return $this->db->insert_id();
	}
	function getPackageDetailClickBank($cb_product_id)
	{
	 
		$this->db->where('cb_product_id',$cb_product_id);
		$query = $this->db->get($this->tablePackagePlans);
		return $query->row();
	}
	function changeClickBankPackageStatus($user_id,$cb_product_id,$status){
	 
		$this->db->set('status',$status);
		$this->db->where('user_id',$user_id);
		$this->db->where('cb_product_id',$cb_product_id);
		$this->db->update($this->tablePackagePurchase);
	}
	function getClickBankPurchaseId($user_id,$cb_product_id){
        
		$this->db->select('id');
		$this->db->where('user_id',$user_id);
		$this->db->where('cb_product_id',$cb_product_id);
		$query = $this->db->get($this->tablePackagePurchase);
		return $query->row()->id;
	}
	function addLaunchPadTransaction($data){
 
            //	{"user_id":7882,"product_id":464,"offer_id":"139","pre_order_id":null,"vendor_id":2697,"quantity":1,"bump":"false","transaction_id":"pi_3ShTSeBnlbY60bT13Blrc2nb","total_amount":19.6700000000000017053025658242404460906982421875,"vat":0,"admin_amount":2.70000000000000017763568394002504646778106689453125,"payment_method":"stripe","updated_at":"2025-12-23T11:09:08.000000Z","created_at":"2025-12-23T11:09:07.000000Z","id":14279,"affiliate_user":2697,"affiliate_amount":8.4900000000000002131628207280300557613372802734375,"vendor_amount":8.4799999999999986499688020558096468448638916015625,
            // "product":{"name":"MagicClips Ai Commercial"},"action":"SALE",
		   //	"user":{"id":7882,"name":"ATUL PAREEK","email":"ashu.bizomart@gmail.com"}} 
       
			$amount = $data['total_amount'];
			$this->db->set('transaction_from',"launchpad");

			if($data['action'])
				$this->db->set('transaction_type',$data['action']);

			if($data['user']['name'])
				$this->db->set('name',$data['user']['name']);

			if($data['user']['email'])
				$this->db->set('email',$data['user']['email']);

			//if($this->input->post('COUNTRYCODE'))
		  //	$this->db->set('country',$this->input->post('COUNTRYCODE'));

			if($data['product_id'])
				$this->db->set('item',$data['product_id']);

			// if($this->input->post('cprodtype'))
			// 	$this->db->set('type',$this->input->post('cprodtype'));

			if($data['affiliate_user'])
				$this->db->set('affiliate',$data['affiliate_user']);

			if($amount)
				$this->db->set('amount',$amount);

			if($data['payment_method'])
				$this->db->set('payment_method',$data['payment_method']);

			// if($this->input->post('ctransvendor'))
			// 	$this->db->set('vendor',$this->input->post('ctransvendor'));

			if($data['transaction_id'])
				$this->db->set('receipt_num',$data['transaction_id']);

			// if($this->input->post('cupsellreceipt'))
			// 	$this->db->set('upsell_receipt',$this->input->post('cupsellreceipt'));

			//if($this->input->post('cvendthru'))
				$this->db->set('extra_info',json_encode($data));

			$this->db->set('created_on',time());
			$this->db->insert($this->tableTransaction);
			return $this->db->insert_id();

	 }
	 	function addPackageLaunchPad($data,$user_id,$transaction_id,$lp_product_id){
        
		$packageDetail = $this->getPackageDetailLaunchPad($lp_product_id); 
	    $amount = $data['total_amount'];
		$this->db->set('user_id',$user_id);
		$this->db->set('transaction_id',$transaction_id);
		$this->db->set('package_id',$packageDetail->id);
		$this->db->set('title',$packageDetail->title);
		$this->db->set('app_ids',$packageDetail->app_ids);
		$this->db->set('fields',$packageDetail->fields);
		$this->db->set('overages',$packageDetail->overages);
		$this->db->set('plan_type',$packageDetail->plan_type);
		$this->db->set('plan_level',$packageDetail->plan_level);
		$this->db->set('price',$packageDetail->price);
		$this->db->set('sell_type',$packageDetail->sell_type);
		$this->db->set('plan_level',$packageDetail->plan_level);
		$this->db->set('feature_plan',$packageDetail->feature_plan);
		$this->db->set('lp_product_id',$packageDetail->lp_product_id);
		//$this->db->set('jvs_product_id',$packageDetail->jvs_product_id);
		$this->db->set('status','active');
		$this->db->set('add_time',time());
		$this->db->insert($this->tablePackagePurchase);
		return $this->db->insert_id();

	}
	function getPackageDetailLaunchPad($lp_product_id){
	 
		$this->db->where('lp_product_id',$lp_product_id);
		$query = $this->db->get($this->tablePackagePlans);
		return $query->row();
	}

	function changeLaunchPadPackageStatus($user_id,$lp_product_id,$status){
	 
		$this->db->set('status',$status);
		$this->db->where('user_id',$user_id);
		$this->db->where('lp_product_id',$lp_product_id);
		$this->db->update($this->tablePackagePurchase);
	}
	function getLaunchPadPurchaseId($user_id,$lp_product_id){
        
			$this->db->select('id');
		$this->db->where('user_id',$user_id);
			$this->db->where('lp_product_id',$lp_product_id);
		$query = $this->db->get($this->tablePackagePurchase);
		return $query->row()->id;
	}

	 
}