<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipn_sellero extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
		$this->load->model('package/Order_Model');
		$this->load->model('package/Mailsending_Model');
		$this->tableUser='tbl_user';	
		$this->jvZooSecretKey = "AKVEGI19ETZFSU25";
	
        
    }
    public function index()
    {
       
	/*	$_POST['caffitid'] = 15080745;
		$_POST['ccustcc'] = 'IN';
		$_POST['ccustemail'] = 'monusingh123sign@gmail.com';
		$_POST['ccustname'] = 'test';
		$_POST['ccuststate'] = '';
		$_POST['cproditem'] = 386756;
		$_POST['cprodtitle'] = 'JVBIZZ';
		$_POST['cprodtype'] = 'STANDARD';
		$_POST['ctransaction'] = 'SALE';
		$_POST['ctransaffiliate'] = 0;
		$_POST['ctransamount'] = '0';
		$_POST['ctranspaymentmethod'] = 'PYPL';
		$_POST['ctransreceipt'] = 'dfsdfsfsdf';
		$_POST['ctranstime'] = 1461676591;
		$_POST['ctransvendor'] = 54605;
		$_POST['cupsellreceipt'] = '';
        $_POST['cvendthru'] = ''; 
		$_POST['cverify'] = 'BEC3B70B';*/
		
		  /*$_POST['mimu-jvz-ipn']= '';
   $_POST['caffitid']= '';
   $_POST['ccustcc']= 'IN';
   $_POST['ccustemail']= 'bbbbbbbbbb@gmail.com';
   $_POST['ccustname']='test';
   $_POST['ccuststate']= '';
   $_POST['cproditem']= '353273';
   $_POST['cprodtitle']= 'AcademyPro Elite One-Time Deal';
   $_POST['cprodtype']= 'STANDARD';
   $_POST['ctransaction']= 'SALE';
   $_POST['ctransaffiliate']= '0';
   $_POST['ctransamount']= '0.00';
   $_POST['ctranspaymentmethod']= 'PYPL';
   $_POST['ctransreceipt']= '23205383KN9509628';
   $_POST['ctranstime']= '1590314626';
   $_POST['ctransvendor']= '1140863';
   $_POST['cupsellreceipt']= '';
   $_POST['cvendthru']= 'c=TP-PMsILGipDWJWXbROkXJH';
   $_POST['cverify']= 'F957D57C';*/
		
		$this->db->set('type','jvz');
		$this->db->set('description',json_encode($_POST));
		$this->db->insert('ipn_testing_hold');

		$response = $this->jvzipnVerification();
	//	$response = 1;
	
        if ($response == 1) {
            
			$_POST['transaction_from'] = 'jvz';
            $transaction_id = $this->Order_Model->addTransaction();
            
            // CHECK IF USER ALREADY EXISTS and SET FLAG
			$name = $_POST['ccustname'];
			$email = $_POST['ccustemail'];
			$product_id = $_POST['cproditem'];
			$title = $_POST['cprodtitle'];
            $user_exists = $this->Order_Model->checkUserExist($_POST['ccustemail']);
            
            
            if ($_POST['ctransaction'] == 'SALE') {
                
                if (!$user_exists) {
					$password = $this->generateRandomString();
					$passwordN =md5($password);
					
                    $user_id = $this->Order_Model->addUser($email,$passwordN,$name);
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvz_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','jvz_product_id',$product_id,'tbl_package_plans');
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
					$this->Order_Model->changeUserStatus($user_id,'active');
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvz_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','jvz_product_id',$product_id,'tbl_package_plans');
					
					$ReplaceArray['name'] = $name;
				    $ReplaceArray['email'] = $email;
					$ReplaceArray['plan_name'] = $title;

					$planTemplate = $this->Order_Model->getEmailTemplateDetail($level);
				    $plansubject = $planTemplate->subject;
				    $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
				
					if($planTemplate->message!='')
				    $this->Mailsending_Model->sendmail($plansubject,$planmessage,$email); 
                }
                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$product_id);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($product_id);
				$data['price']   =   $_POST['ctransamount'];
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $email;
			    $data['payment_mode']         =   'JVZoo';
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->setUserPackage($user_id);
				/*if($product_id=='386764' || $product_id=='386770' || $product_id=='386772' || $product_id=='386774' || $product_id=='386776' ){
				$free_plan_post = $_POST;
				$free_plan_post['ctransaffiliate'] = 'coursova';
				$free_plan_post['recipt_no'] = 'dcp-free-access';
				$free_plan_post['cproditem'] = 'dcp-free-access';
				$this->send_curl_request($free_plan_post,'https://www.dotcompal.com/api/bms/subscription/transactions/jvzoo');
				}*/
				
				
            }
         if ($user_exists) {
            if ($_POST['ctransaction'] == 'RFND') { 
			   $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$_POST['ccustemail'],$this->tableUser);
			   $this->Order_Model->changePackageStatus($user_id,$_POST['cproditem'],'inactive');
			   $purchase_id = $this->Order_Model->getPurchaseId($user_id,$_POST['cproditem']);
			   $this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
			      
			   $this->db->select('id');
			   $this->db->where('user_id',$user_id);
			   $this->db->where('status','active');
			   $query1 = $this->db->get('tbl_package_purchase');
			   $rCount = $query1->num_rows();
			   if($rCount==0)
			   $this->Order_Model->changeUserStatus($user_id,'inactive');
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
			
			if ($_POST['ctransaction'] == 'BILL') {
                
                $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$_POST['ccustemail'],$this->tableUser);
				$this->Order_Model->changeUserStatus($user_id,'active');

                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$_POST['cproditem']);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($_POST['cproditem']);
				$data['price']   =   $_POST['ctransamount'];
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $_POST['ccustemail'];
			    $data['payment_mode']         =   'JVZoo';
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->setUserPackage($user_id);
				
				$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvz_product_id',$product_id,'tbl_package_plans');
					
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
			   $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$_POST['ccustemail'],$this->tableUser);
			   $this->Order_Model->changePackageStatus($user_id,$_POST['cproditem'],'inactive');
			   $purchase_id = $this->Order_Model->getPurchaseId($user_id,$_POST['cproditem']);
			   $this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
			      
			   $this->db->select('id');
			   $this->db->where('user_id',$user_id);
			   $this->db->where('status','active');
			   $query1 = $this->db->get('tbl_package_purchase');
			   $rCount = $query1->num_rows();
			   if($rCount==0)
			   $this->Order_Model->changeUserStatus($user_id,'inactive');
			   $this->setUserPackage($user_id);
			   
			   $title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvz_product_id',$product_id,'tbl_package_plans');
					
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
		  
			if($product_id=='386764' || $product_id=='386770' || $product_id=='386772' || $product_id=='386774' || $product_id=='386776' ){
				$this->send_curl_request($_POST,'https://www.oppyo.com/api/bms/subscription/transactions/Product_deliveryjvzoo');
			}
        }
    }
    function jvzipnVerification()
    {
        $secretKey =$this->jvZooSecretKey ;
        $pop       = "";
        $ipnFields = array();
        foreach ($_POST AS $key => $value) {
            if ($key == "cverify") {
                continue;
            }
            $ipnFields[] = $key;
        }
		
        sort($ipnFields);
        foreach ($ipnFields as $field) {
            // if Magic Quotes are enabled $_POST[$field] will need to be
            // un-escaped before being appended to $pop
            $pop = $pop . $_POST[$field] . "|";
        }
		
        $pop          = $pop . $secretKey;
        $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
        $calcedVerify = strtoupper(substr($calcedVerify, 0, 8));
		
        return $calcedVerify == $_POST["cverify"];
    }
    // GENERATE PASSWORD
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
	function setUserPackage($user_id)
	{
	   $this->load->model('package/Package_purchase_Model');
	   $user_package = $this->Package_purchase_Model->checkForPackage($user_id);
	   $this->Order_Model->updateUserPackage($user_id,$user_package);
	}
	public function send_curl_request($post_data,$url,$show = false)
	{
		//return;
		//echo $url;die;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$result= curl_exec ($ch); 
		$result=  json_decode($result);
		if($show){ 
		echo "1 <pre>"; print_r($result);
		}

		return $result;
	}
}