<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jvshare_ipn extends CI_Controller
{
    
    function __construct()
    { 
        parent::__construct();
		$this->load->model('package/Order_Model');
		$this->load->model('package/Mailsending_Model');
		$this->tableUser='tbl_user';	
    }
    public function index()
    {
	
	   /* $postdata = json_encode($_POST);
        $reqdata = json_encode($_REQUEST);
        $getdata = json_encode($_GET);
        
		$data['ident']=$_REQUEST['jvpidentifier'];
		$data['time']=$_REQUEST['jvptime'];
		$data['item']=$_REQUEST['jvpitem'];
		$data['jvpiv']=$_REQUEST['jvpiv'];
			
        $message = 'Post Data- '.$postdata.' <br/>Request Data- '.$reqdata.' <br/>Get Data'.$getdata.' <br/> My Data'.json_encode($data);
        
        mail( 'vijay@saglusinfo.com', 'jvshare testing', $message ); */
		
       
		

		/*$_POST['caffitid'] = $_POST['affiliateID']; //15080745; //affiliateID
		$_POST['ctransvendor'] = $_POST['vendorID']; //54605; //vendorID
		$_POST['ctransaction'] = 'SALE';//$_POST['transactionType']; //$_GET['type']; //transactionType
		$_POST['ctransamount'] = $_POST['receivedAmount']; //'2.50'; //receivedAmount
		$_POST['ctranspaymentmethod'] = $_POST['paymentService']; //'PYPL'; //paymentService
		$_POST['ctranstime'] = $_POST['transactionTime']; //1461676591; //transactionTime

		$_POST['cproditem'] = '8b9aaac8ed';//$_POST['productID']; //123456;  //productID
		$_POST['cprodtitle'] = $_POST['productName']; //'JVBIZZ';  //productName

		$_POST['ccustname'] = $_POST['fullName']; //'Cyan Willi'; //fullName
		$_POST['ccustemail'] = 'vijay@saglusinfo.com';//$_POST['email']; //$_GET['eid']; //email
		$_POST['ccustcc'] = $_POST['country']; //'IN'; //country
		$_POST['ccuststate'] = $_POST['state']; //''; //state


		$_POST['cprodtype'] = 'STANDARD';
		$_POST['ctransaffiliate'] = 0;
		$_POST['ctransreceipt'] = '0HR17845E1241423B';
		$_POST['cupsellreceipt'] = '';
        $_POST['cvendthru'] = ''; 
		$_POST['cverify'] = 'BEC3B70B';*/ 
		
		
		
		$this->db->set('type','paydotcom');
		$this->db->set('description',json_encode($_REQUEST));
		$this->db->insert('ipn_testing_hold');
		
		$response = 1;//$this->jvpivValid();
		
	
        if ($response == 1) {
            
			$transaction_from = $_POST['transaction_from'] = 'jvshare';
			if($_POST['ctransaction']!='')
            $transaction_id = $this->Order_Model->addTransaction();
            
            // CHECK IF USER ALREADY EXISTS and SET FLAG
			$name = $_POST['ccustname'];
			$email = $_POST['ccustemail'];
			$product_id = $_POST['cproditem'];
			$title = $_POST['cprodtitle'];
			$ctransamount = $_POST['ctransamount'];
            $user_exists = $this->Order_Model->checkUserExist($email);
			$jvz_product_id = $this->Common_Modal->getSingleFieldFromAnyTable('jvz_product_id','jvs_product_id',$product_id,'tbl_package_plans');
            
            if ($_POST['ctransaction'] == 'SALE') {
                
                if (!$user_exists) {
					$password = $this->generateRandomString();
					$passwordN =md5($password);
					
                    $user_id = $this->Order_Model->addUser($email,$passwordN,$name);
						mkdir('./assets/uploads/users/' . $user_id . '/');
					//$this->Mailsending_Model->jvzooSignupMail($_POST['cprodtitle'],$_POST['ccustemail'],$password,$_POST['ccustname'],$_POST['cproditem']);
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvs_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','jvs_product_id',$product_id,'tbl_package_plans');
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
					// $this->Mailsending_Model->jvzooUpdateMail($_POST['cprodtitle'],$_POST['ccustemail'],$_POST['ccustname'],$_POST['cproditem']);
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvs_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','jvs_product_id',$product_id,'tbl_package_plans');
					
					$ReplaceArray['name'] = $name;
				    $ReplaceArray['email'] = $email;
					$ReplaceArray['plan_name'] = $title;

					$planTemplate = $this->Order_Model->getEmailTemplateDetail($level);
				    $plansubject = $planTemplate->subject;
				    $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
				
					if($planTemplate->message!='')
				    $this->Mailsending_Model->sendmail($plansubject,$planmessage,$email); 
                }
                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$jvz_product_id);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($jvz_product_id);
				$data['price']   =   $ctransamount;
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $email;
			    $data['payment_mode']         =   $transaction_from;
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->setUserPackage($user_id);
				
				
            }
         if ($user_exists) {
            if ($_POST['ctransaction'] == 'RFND') { 
			   $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
			   $this->Order_Model->changePackageStatus($user_id,$jvz_product_id,'inactive');
			   $purchase_id = $this->Order_Model->getPurchaseId($user_id,$jvz_product_id);
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
                
                $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
				$this->Order_Model->changeUserStatus($user_id,'active');

                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$jvz_product_id);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($jvz_product_id);
				$data['price']   =   $ctransamount;
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $email;
			    $data['payment_mode']         =   $transaction_from;
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->setUserPackage($user_id);
				
				$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvs_product_id',$product_id,'tbl_package_plans');
					
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
			   $this->Order_Model->changePackageStatus($user_id,$jvz_product_id,'inactive');
			   $purchase_id = $this->Order_Model->getPurchaseId($user_id,$jvz_product_id);
			   $this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
			      
			   $this->db->select('id');
			   $this->db->where('user_id',$user_id);
			   $this->db->where('status','active');
			   $query1 = $this->db->get('tbl_package_purchase');
			   $rCount = $query1->num_rows();
			   if($rCount==0)
			   $this->Order_Model->changeUserStatus($user_id,'inactive');
			   $this->setUserPackage($user_id);
			   
			   $title = $this->Common_Modal->getSingleFieldFromAnyTable('title','jvs_product_id',$product_id,'tbl_package_plans');
					
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
    
	function jvpivValid()
          {
            $key='*&^%$#$@#amit77$%$#@';
            $ident=$_REQUEST['jvpidentifier'];
            $time=$_REQUEST['jvptime'];
            $item=$_REQUEST['jvpitem'];
            $jvpiv=$_REQUEST['jvpiv'];

            $xxiv=sha1("$key|$ident|$time|$item");
            $xxiv=strtoupper(substr($xxiv,0,8));

            if($jvpiv==$xxiv)
            return 1;
            else
            return 0;
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
}