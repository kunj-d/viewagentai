<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Launchpad_ipn extends CI_Controller
{
    
    function __construct()
    { 
        parent::__construct(); 
		$this->load->model('package/Order_Model');
		$this->load->model('package/Mailsending_Model');
		$this->tableUser='tbl_user'; 
		$this->launchPadKey='qYjzcVZkBlRnwBRct4Vxih5QtAGgpaPW';	// Atul sir  Launchpad 
    }
    public function index()
    {
        
        
    	$data = json_decode($this->input->raw_input_stream, true);
  
    	
    	$this->db->set('type','launchpad');
		$this->db->set('description',json_encode($data));
		$this->db->insert('ipn_testing_hold');
		
		/////////// 
		$launchPadKey = $this->launchPadKey;
		
        if (true) {
            
			$data['transaction_from'] = 'launchpad';
            $transaction_id = $this->Order_Model->addLaunchPadTransaction($data); 
			$name = $data['user']['name'];
			$email = $data['user']['email'];
			$product_id = $data['product_id'];
			$title = $data['product']['name'];
			
			
		//	{"user_id":7882,"product_id":464,"offer_id":"139","pre_order_id":null,"vendor_id":2697,"quantity":1,"bump":"false","transaction_id":"pi_3ShTSeBnlbY60bT13Blrc2nb","total_amount":19.6700000000000017053025658242404460906982421875,"vat":0,"admin_amount":2.70000000000000017763568394002504646778106689453125,"payment_method":"stripe","updated_at":"2025-12-23T11:09:08.000000Z","created_at":"2025-12-23T11:09:07.000000Z","id":14279,"affiliate_user":2697,"affiliate_amount":8.4900000000000002131628207280300557613372802734375,"vendor_amount":8.4799999999999986499688020558096468448638916015625,
		//  "product":{"name":"MagicClips Ai Commercial"},"action":"SALE",
		//	"user":{"id":7882,"name":"ATUL PAREEK","email":"ashu.bizomart@gmail.com"}} 
            $user_exists = $this->Order_Model->checkUserExist($email);  
            if ($data['action'] == 'SALE' || $data['action'] == 'sale') {
                
                if (!$user_exists) {
					$password = $this->generateRandomString();
					$passwordN =md5($password);
					
                    $user_id = $this->Order_Model->addUser($email,$passwordN,$name);
						
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','lp_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','lp_product_id',$product_id,'tbl_package_plans');
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
					
                } else {
                    $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
					$this->Order_Model->changeUserStatus($user_id,'1');
					$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','lp_product_id',$product_id,'tbl_package_plans');
					$level = $this->Common_Modal->getSingleFieldFromAnyTable('sell_type','lp_product_id',$product_id,'tbl_package_plans');
					
					$ReplaceArray['name'] = $name;
				    $ReplaceArray['email'] = $email;
					$ReplaceArray['plan_name'] = $title;

					$planTemplate = $this->Order_Model->getEmailTemplateDetail($level);
				    $plansubject = $planTemplate->subject;
				    $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
				
					if($planTemplate->message!='')
				    $this->Mailsending_Model->sendmail($plansubject,$planmessage,$email); 
				}
				
                $purchase_id = $this->Order_Model->addPackageLaunchPad($data,$user_id,$transaction_id,$product_id);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetailLaunchPad($product_id);
				$dataPa['price']   =   $data['total_amount'];
			    $dataPa['package_id'] = $packageDetail->id;
			    $dataPa['user_id'] = $user_id;
				$dataPa['user_email'] = $email;
			    $dataPa['payment_mode']         =   'launchpad';
			    $dataPa['payment_status']         =   'complete';
			    $dataPa['trans_id']         =   $transaction_id;
			    $dataPa['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($dataPa);
				
				$this->setUserPackage($user_id);
				
				$this->db->where('email',$email);
				$this->db->where('receipt_num',$data['transaction_id']);
				$resultreciept=$this->db->get('tbl_package_transaction')->num_rows(); 
				
	            
                $credit=0;
                $imgcredit=0;
                $upload_credit=0;
                if($product_id=='wso_b6tw07'){    //magicClips fe
				    $credit=500; 
                    $upload_credit=540;
				}
                
				if($product_id=='wso_pv7vhs'){   //magicClips Unlimited
				    $credit=1500; 
				    $upload_credit=1240;
				}
				if($product_id=='wso_xdynqf'){   //magicClips lite
				    $credit=1500; 
                    $upload_credit=1240;
				}
			
				
			
				////BUTTON CREDIT ONLY
				if($product_id=='wso_btszsx'){  //CREDIT
				    $credit=100; 
				}
				if($product_id=='wso_m3d0fj'){  //CREDIT
				    $credit=200; 
				}
				if($product_id=='wso_tqm260'){  //CREDIT
				    $credit=500; 
				}
			 
				
				
				$credit_query="";
				if($product_id=='wso_b6tw07' || $product_id=='wso_xdynqf'  || $product_id=='wso_xdynqf'){
				    $credit_query = "UPDATE tbl_user SET  credit=$credit,upload_credit=$upload_credit WHERE id=$user_id"; 
				}else{
				    $credit_query = "UPDATE tbl_user SET  credit=credit+$credit,upload_credit=upload_credit+$upload_credit WHERE id=$user_id"; 
				}
			
                if($resultreciept=="1"){
                     $this->db->query($credit_query);
                }
				
				
            }
         if ($user_exists) {
            if ($data['action'] == 'refund' || $data['action'] == 'RFND') { 
			   $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
			   $this->Order_Model->changeWPPackageStatus($user_id,$product_id,'inactive');
			   $purchase_id = $this->Order_Model->getWPPurchaseId($user_id,$product_id);
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
			
			if ($data['action'] == 'BILL') {
                
                $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
				$this->Order_Model->changeUserStatus($user_id,'1');

                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$product_id);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($product_id);
				$data['price']   =   $data['WP_SALE_AMOUNT'];
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $email;
			    $data['payment_mode']         =   'WP';
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->setUserPackage($user_id);
				
				$title = $this->Common_Modal->getSingleFieldFromAnyTable('title','wp_product_id',$product_id,'tbl_package_plans');
					
				$ReplaceArray['name'] = $name;
				$ReplaceArray['email'] = $email;
				$ReplaceArray['plan_name'] = $title;

				$planTemplate = $this->Order_Model->getEmailTemplateDetail('bill');
				$plansubject = $planTemplate->subject;
				$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
				if($planTemplate->message!='')
				$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
				
				
            }
			if ($data['action'] == 'CANCEL-REBILL') { 
			   $user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$email,$this->tableUser);
			   $this->Order_Model->changePackageStatus($user_id,$product_id,'inactive');
			   $purchase_id = $this->Order_Model->getWPPurchaseId($user_id,$product_id);
			   $this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
			      
			   $this->db->select('id');
			   $this->db->where('user_id',$user_id);
			   $this->db->where('status','active');
			   $query1 = $this->db->get('tbl_package_purchase');
			   $rCount = $query1->num_rows();
			   if($rCount==0)
			   $this->Order_Model->changeUserStatus($user_id,'0');
			   $this->setUserPackage($user_id);
			   
			   $title = $this->Common_Modal->getSingleFieldFromAnyTable('title','wp_product_id',$product_id,'tbl_package_plans');
					
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