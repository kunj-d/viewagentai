<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clickbank_ipn extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct();
		$this->load->model('package/Order_Model');
		$this->load->model('package/Mailsending_Model');   
		$this->tableUser='tbl_user';	
		//$this->cbSecretKey="739BE6863171291";	
	}
	
	function index(){
		if(!$this->input->post()){
			//echo "invalid"; 
			$this->db->set("type","ClickBankPostData");
			$this->db->set("description","invalid");
			$this->db->insert("ipn_testing_hold");
			die;
		}
		$post_message = $this->input->post("post_data");
		$secret_key = $this->input->post("secret_key");
		$response = json_decode($post_message);
		$verify = $this->verifyIpn($secret_key);
		if(!$verify){
			//echo "not verify"; 
			$this->db->set("type","ClickBankPostData");
			$this->db->set("description","not verify");
			$this->db->insert("ipn_testing_hold");
			die;
		}

		$this->db->set("type","ClickBankPostData");
		$this->db->set("description",$post_message);
		$this->db->insert("ipn_testing_hold");

		if(!empty($response)){
            //echo "<pre>";print_r($response);die;
			// CHECK IF USER ALREADY EXISTS and SET FLAG
			$userDetail = $response->customer->shipping;
			$name = $userDetail->fullName;
			$email = $userDetail->email; 
		    $user_exists = $this->Order_Model->checkUserExist($email);
		   	foreach($response->lineItems as $orderItemData) {
				$transaction_id = $this->Order_Model->addClickBankTransaction($response,$orderItemData,$userDetail);
				$product_id 	= $orderItemData->itemNo;
				$product_price 	= $orderItemData->accountAmount;
				$title 			= $orderItemData->productTitle;
				if($response->transactionType =="SALE"  || $response->transactionType == "TEST_SALE"){
					if (!$user_exists) {
						$password = $this->generateRandomString();
						$passwordN =md5($password);
						
						$user_id = $this->Order_Model->addUser($email,$passwordN,$name);
							
						$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','cb_product_id',$product_id,'tbl_package_plans');
						$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','cb_product_id',$product_id,'tbl_package_plans');
						$ReplaceArray['name'] = $name;
						$ReplaceArray['email'] = $email;
						$ReplaceArray['login_url'] = site_url();
						$ReplaceArray['password'] = $password;
						$ReplaceArray['plan_name'] = $title;				
						
						
						$registrationTemplate = $this->Order_Model->getEmailTemplateDetail('jvz-registration-email');
						$registrationsubject = $registrationTemplate->subject;
						$registrationmessage = $this->Common_Modal->replaceEmailTags($registrationTemplate->message,$ReplaceArray);
						 if($registrationTemplate->message!='')
						$this->Mailsending_Model->sendmail($registrationsubject,$registrationmessage,$email); 
						
						$planTemplate = $this->Order_Model->getEmailTemplateDetail($level);
						$plansubject = $planTemplate->subject;
						$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
						 if($planTemplate->message!='')
						$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email); 
						 
					}
					else {
						$user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
						$this->Order_Model->changeUserStatus($user_id,'1');
						$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','cb_product_id',$product_id,'tbl_package_plans');
						$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','cb_product_id',$product_id,'tbl_package_plans');
						
						$ReplaceArray['name'] = $name;
						$ReplaceArray['email'] = $email;
						$ReplaceArray['plan_name'] = $title;
	
						$planTemplate = $this->Order_Model->getEmailTemplateDetail($level);
						$plansubject = $planTemplate->subject;
						$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
					
						if($planTemplate->message!='')
						$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email); 	 
					}
					$purchase_id = $this->Order_Model->addPackagePurchaseClikBank($user_id,$transaction_id,$product_id);
					$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
					$packageDetail 			= $this->Order_Model->getPackageDetailClickBank($product_id);
					$data['price']   		= $product_price;
					$data['package_id'] 	= $packageDetail->id;
					$data['user_id'] 		= $user_id;
					$data['user_email'] 	= $email;
					$data['payment_mode']   = 'clickbank';
					$data['payment_status'] = 'complete';
					$data['trans_id']       = $transaction_id;
					$data['purchase_id']    = $purchase_id;
					$order_id 				=  $this->Order_Model->addPackageOrder($data);
					$this->setUserPackage($user_id);
				}
				if ($user_exists) {
					if ($response->transactionType == 'RFND') {
						$user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
						$this->Order_Model->changeClickBankPackageStatus($user_id,$product_id,'inactive');
						$purchase_id = $this->Order_Model->getClickBankPurchaseId($user_id,$product_id);
						$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
						   
						$this->db->select('id');
						$this->db->where('user_id',$user_id);
						$this->db->where('status','active');
						$query1 = $this->db->get('tbl_package_purchase');
						$rCount = $query1->num_rows();
						if($rCount==0)
						$this->Order_Model->changeUserStatus($user_id,'0');
						$this->setUserPackage($user_id);
						
						 $ReplaceArray['name'] = $name;
						 $ReplaceArray['email'] = $email;
						 $ReplaceArray['plan_name'] = $title;
						 $planTemplate = $this->Order_Model->getEmailTemplateDetail('refund');
						 $plansubject = $planTemplate->subject;
						 $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);

						  if($planTemplate->message!='')
						  $this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
					}
					if ($response->transactionType == 'BILL') {
                
						$user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
						$this->Order_Model->changeUserStatus($user_id,'1');
		
						$purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$product_id);
						$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
						$packageDetail = $this->Order_Model->getPackageDetail($product_id);
						$data['price']   		= $product_price;
						$data['package_id'] 	= $packageDetail->id;
						$data['user_id'] 		= $user_id;
						$data['user_email'] 	= $email;
						$data['payment_mode']   = 'clickbank';
						$data['payment_status'] = 'complete';
						$data['trans_id']       = $transaction_id;
						$data['purchase_id']    = $purchase_id;
						$order_id 				=  $this->Order_Model->addPackageOrder($data);
						
						$this->setUserPackage($user_id);
						
						$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','cb_product_id',$product_id,'tbl_package_plans');
							
						$ReplaceArray['name'] = $name;
						$ReplaceArray['email'] = $email;
						$ReplaceArray['plan_name'] = $title;
		
						$planTemplate = $this->Order_Model->getEmailTemplateDetail('bill');
						$plansubject = $planTemplate->subject;
						$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
						if($planTemplate->message!='')
						$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
					}
					if ($_POST['ctransaction'] == 'CANCEL-REBILL') { 
						$user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
						$this->Order_Model->changeClickBankPackageStatus($user_id,$product_id,'inactive');
						$purchase_id = $this->Order_Model->getClickBankPurchaseId($user_id,$product_id);
						$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
						   
						$this->db->select('id');
						$this->db->where('user_id',$user_id);
						$this->db->where('status','active');
						$query1 = $this->db->get('tbl_package_purchase');
						$rCount = $query1->num_rows();
						if($rCount==0)
						$this->Order_Model->changeUserStatus($user_id,'0');
						$this->setUserPackage($user_id);
						
						$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','cb_product_id',$product_id,'tbl_package_plans');
							 
						$ReplaceArray['name'] = $name;
						$ReplaceArray['email'] = $email;
						$ReplaceArray['plan_name'] = $title;
		 
						$planTemplate = $this->Order_Model->getEmailTemplateDetail('cancel-bill');
						$plansubject = $planTemplate->subject;
						$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
						if($planTemplate->message!='')
						$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
						 
					}
				}
		   	}		
		}
	}
	public function verifyIpn($secret_key) 
	{
		$verify_secret_key = config_item('clickbank_verify_secret') ;
		if ($secret_key == $verify_secret_key) {
			return true;
		}
		else {
			return false ;
		}
	}
	public function clickBankVerification(){
		// NOTE: the mcrypt libraries need to be installed and listed as an
		// available extension in your phpinfo() to be able to use this
		// method of decryption.
		$secretKey = $this->cbSecretKey; // secret key from your ClickBank account
		
		// get JSON from raw body...
		$message = json_decode(file_get_contents('php://input'));
		// Pull out the encrypted notification and the initialization vector for
		// AES/CBC/PKCS5Padding decryption
		$encrypted = $message->{'notification'};
		$iv = $message->{'iv'};		
		// decrypt the body...
		$decrypted = trim(
		openssl_decrypt(base64_decode($encrypted),
		'AES-256-CBC',
		substr(sha1($secretKey), 0, 32),
		OPENSSL_RAW_DATA,
		base64_decode($iv)), "\0..\32");
		
		//error_log("Decrypted: $decrypted");
		
		////UTF8 Encoding, remove escape back slashes, and convert the decrypted string to a JSON object...
		$sanitizedData = utf8_encode(stripslashes($decrypted));
		$order = json_decode($decrypted);
		return $order;
	}

	function setUserPackage($user_id)
	{
	   $this->load->model('package/Package_purchase_Model');
	   $user_package = $this->Package_purchase_Model->checkForPackage($user_id);
	   $this->Order_Model->updateUserPackage($user_id,$user_package);
	}

	function generateRandomString($length = 10)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

