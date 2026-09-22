<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
 
	public function __construct()
	{ 
	    parent::__construct();		

		$this->load->model($this->config->item('adminFolderName').'/User_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->model('package/Order_Model');	
		$this->load->model('package/Mailsending_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 

	}
	public function index()
	{


		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['add_plan_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add_plan');		
		$output['add_product_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'add_product');
		$output['login_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'login');
		$output['reset_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'reset');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		
		$output['plan_list'] = $this->User_Model->getPackageList();
		
		$output['start_date'] = $start_date = $this->input->get('start_date');
		$output['end_date'] = $end_date = $this->input->get('end_date');
		$output['keyword'] = $keyword = $this->input->get('keyword');
		$output['plan_id'] = $plan_id = $this->input->get('plan_id');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-users/?keyword='.$keyword.'&plan_id='.$plan_id.'&start_date='.$start_date.'&end_date='.$end_date);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->User_Model->getAllCount('',$start_date,$end_date,$keyword,$plan_id);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->User_Model->getUserList($start_date,$end_date,$keyword,$plan_id,$config['per_page'],$currentpage);
		
		$output['active'] = $this->User_Model->getAllCount('active',$start_date,$end_date,$keyword,$plan_id);
		$output['inactive'] = $this->User_Model->getAllCount('inactive',$start_date,$end_date,$keyword,$plan_id);
		$output['total'] = $this->User_Model->getAllCount('',$start_date,$end_date,$keyword,$plan_id);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/users/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function view()
	{
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');
		
		$user_id = $this->input->post('user_id');
		
		$output['detail'] = $this->User_Model->getUserDetail($user_id);
		
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/users/view_user',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	public function createUser()
	{ 
		$output['manager_id'] = $manager_id = 5;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
		
		if($_POST)
		{
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$skype = $this->input->post('skype');
			$country = $this->input->post('country');

			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('phone','Phone','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[tbl_user.email]');
			$this->form_validation->set_rules('password','Password','trim|required|matches[confirm_pass]');
			$this->form_validation->set_rules('confirm_pass','Confirm Password','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->User_Model->addUser();
			   $this->load->model('package/Order_Model');												
			   // see these things later
			   $this->load->model('package/Package_purchase_Model');									
			   // see these things later
			   $this->Package_purchase_Model->setFreeplan($email,$this->input->post('password'));

			   $ReplaceArray['name'] = $name;
		       $ReplaceArray['email'] = $email;
		       $ReplaceArray['login_url'] = site_url();
			   $ReplaceArray['password'] = $this->input->post('password');
					
			   $registrationTemplate = $this->Order_Model->getEmailTemplateDetail('jvz-registration-email');
			   $registrationsubject = $registrationTemplate->subject;
			   $registrationmessage = $this->Common_Modal->replaceEmailTags($registrationTemplate->message,$ReplaceArray);
			   if($registrationTemplate->message!='')
				//$this->Mailsending_Model->sendmail($registrationsubject,$registrationmessage,$email);
								
			   $planTemplate = $this->Order_Model->getEmailTemplateDetail('fe-0');
			   $plansubject = $planTemplate->subject;
			   $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$ReplaceArray);
			   if($planTemplate->message!='')
				//$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
			
			   $this->session->set_userdata('success_msg','User Created Successfully');
			   redirect($this->config->item('adminName').'/manage-users');
			 }
			 
		}
		
		$output['name'] = $name;
		$output['phone'] = $phone;
		$output['email'] = $email;
		$output['page_title'] = 'Add New User';
        $output['page_name'] = 'add';
		
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/users/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function editUser($user_id)
	{
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');

		$detail = $this->User_Model->getUserDetail($user_id);
		$name = $detail->name;
		$phone = $detail->phone;
		$skype = $detail->skype_id;
		$country = $detail->country;
		
		if($_POST)
		{
			$name = $this->input->post('name');
			$phone = $this->input->post('phone');
			if($this->input->post('skype'))
							$skype = $this->input->post('skype');
			if($this->input->post('country'))
							$country = $this->input->post('country');
				

			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('phone','Phone','trim|required');
			
			if($this->form_validation->run())
			 {
			   $this->User_Model->updateUser($user_id);
			   $this->session->set_userdata('success_msg','User Updated Successfully');
			   redirect($this->config->item('adminName').'/manage-users');
			 }
			 
		}
		
		$output['name'] = $name;
		$output['phone'] = $phone;
		$output['skype_id'] = $skype;
		$output['country'] = $country;
		
		$output['page_title'] = 'Edit User';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/users/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function deleteUser($user_id) 
	{
	
	   $output['manager_id'] = $manager_id = 6;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');

	   $this->User_Model->deleteUser($user_id);
	   $this->session->set_userdata('success_msg','User Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-users');
	}
	function changeStatus($task,$user_id) 
	{
	
	   $output['manager_id'] = $manager_id = 6;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->User_Model->set_status($task,$user_id);
	   $this->session->set_userdata('success_msg','User Status changed Successfully');
	   redirect($this->config->item('adminName').'/manage-users');
	}
	function loginUser($user_id) 
	{
					$output['manager_id'] = $manager_id = 6;
					$this->Common_Modal->checkForPageAccess($manager_id,'login','redirect');
					$detail = $this->User_Model->getUserDetail($user_id);
					$this->db->select('*');
					$this->db->where('email',$detail->email);
					$query=$this->db->get('tbl_user');
					$result=$query->row();
					$answer = $user_id;
					$this->session->set_userdata(['id' => $answer]);
					if($result->parent_id==0){
							$parent_id=$result->id;
						}
						else{
							$parent_id=$result->parent_id;
						}
						$session_array = array(
											'id' 			=> 	$result->id,
											'parent_id' 	=> $parent_id,
											'owner_id' 		=> 	$parent_id,
											'user_role' 	=> $result->role,
											'email'			=>	$result->email,
											'name' 			=>	$result->name,
											'profile_pic' 	=> $result->profile_pic,
											'timezone' 		=> $result->timezone,
											'user_package' 	=> $result->user_package,
											'last_bid' 		=> $result->last_business_id
										);
						$this->session->set_userdata('logged_in', $session_array);
						//echo "<pre>";print_r($this->session->userdata('logged_in'));die;
						$this->session->set_userdata('welcome_status', $result->welcome_status);
						$this->session->set_userdata('social_login', '0');
						$this->session->set_userdata('user_log', 'ok');
						if($result->last_business_id > 0){
							$output['redirect'] = site_url('dashboard');
							}else{
								$output['redirect']= site_url('dashboard');
							}
							redirect($output['redirect']);
					
	}
	public function resetPassword()
	{
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'reset','redirect');
		
		
		
	   if($_POST['reset_pass'])
	   {
		 $this->form_validation->set_rules('new_pass','New Password','trim|required|matches[confirm_pass]');
		 $this->form_validation->set_rules('confirm_pass','Confirm Password','trim|required');
		 
		 if($this->form_validation->run())
		  {
		     $this->User_Model->updatePassword();
			 
			 $data['success'] = true;
		  }
		if(validation_errors())
		 {
		   $data['success'] = false;
		   $data['error'] = validation_errors();
		 } else {
		   $data['success'] = true;
		   $data['success_msg'] = 'Password Updated Successfully';
		   $data['model'] = 'hide';
		 }
        echo json_encode($data); die;
	   }
		
		$output['user_id'] = $this->input->post('user_id');
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/users/reset_password',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	function addUserPlan()
	{
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'add_plan','redirect');
		
		$user_id = $this->input->post('user_id');
		
		$output['detail'] = $this->User_Model->getUserDetail($user_id);
		$output['userPlans'] = $this->User_Model->getUserPurchasedPlans($user_id);
		$output['plan_list'] = $this->User_Model->getPackageList();
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/users/add_plan',$output,true);
		
        $response['success'] = true;
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
	}
	function updateUserPlan()
	{
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'add_plan','redirect');
		$user_id = $this->input->post('user_id');
		$detail = $this->User_Model->getUserDetail($user_id);
		if($this->input->post('credit')){
	        $this->addUserCredit($detail);
	    }
		$name = $detail->name;
		$email = $detail->email;
		$plan_ids = $this->input->post('plan_id');
		$current_planIds = $this->User_Model->getUserPurchasedPlans($user_id);
		
		$newArray = array();
		$refArray = array();
		$newrefArray = array();
		foreach($plan_ids as $val)
		{
		  if(!in_array($val,$current_planIds))
		  $newArray[] = $val;
		  else
		   $refArray[] = $val;
		  
		}
		
		foreach($current_planIds as $val12)
		{
		  if(!in_array($val12,$refArray))
		  $newrefArray[] = $val12;
		  
		}

		$planname = '';
		$totalplan = sizeof($newArray);
		
		foreach($newArray as $key=>$valArr)
		 {
		    $pkgDetail =  $this->User_Model->getPackageDetail($valArr);
	        $user_package = $this->addJVZoouser($detail->email,mt_rand(),$pkgDetail->price,$detail->name,$pkgDetail->jvz_product_id,$pkgDetail->title);
			if($key!=0 && ($key)<$totalplan)
			$planname.=', ';
			$planname.=$pkgDetail->title;
			$plan_type = $pkgDetail->sell_type;
		 }
		 
		 foreach($newrefArray as $key1=>$valRef)
		 {
		   $pkgDetail =  $this->User_Model->getPackageDetail($valRef);
		   $this->removePlan($detail,$pkgDetail->jvz_product_id);
		 }
		 
		if(sizeof($newArray)==1)
		 {
		   $planTemplate = $this->Order_Model->getEmailTemplateDetail($plan_type);
		 } else {
		   $planTemplate = $this->Order_Model->getEmailTemplateDetail('multi-plan');
		 }
		 
		 if(sizeof($newArray)>0)
		 {
		  $plansubject = $planTemplate->subject;
		  $replaceArray['name'] = $name;
		  $replaceArray['email'] = $email;
		  $replaceArray['plan_name'] = $planname;
		  $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$replaceArray);
		  //$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
		 }

		 $this->session->set_userdata('success_msg','User Upgraded Successfully');
		 redirect($this->config->item('adminName').'/manage-users');
		
	}
	
	private function addUserCredit($user){
        $credit = $this->input->post('credit') + $user->credit;
        $this->db->where('id',$user->id)->update('tbl_user',['credit' => $credit]);
        return true;
	}
	
	public function addJVZoouser($email,$receipt,$price,$name,$product_id,$product_title) {
		
		$_POST['caffitid'] = 15080745;
		$_POST['ccustcc'] = 'IN';
		$_POST['ccustemail'] = $email;
		$_POST['ccustname'] = $name;
		$_POST['ccuststate'] = '';
		$_POST['cproditem'] = $product_id;
		$_POST['cprodtitle'] = $product_title;
		$_POST['cprodtype'] = 'STANDARD';
		$_POST['ctransaction'] = 'SALE';
		$_POST['ctransaffiliate'] = 0;
		$_POST['ctransamount'] = '0.00';
		$_POST['ctranspaymentmethod'] = 'PYPL';
		$_POST['ctransreceipt'] = $receipt;
		$_POST['ctranstime'] = time();
		$_POST['ctransvendor'] = 54605;
		$_POST['cupsellreceipt'] = '';
        $_POST['cvendthru'] = ''; 
		$_POST['cverify'] = 'BEC3B70B';
		
			$_POST['transaction_from'] = 'BMS';
            $transaction_id = $this->Order_Model->addTransaction();
            
            if ($_POST['ctransaction'] == 'SALE') {
                
				$user_id = $this->Common_Modal->getSingleFieldFromAnyTable('id','email',$_POST['ccustemail'],'tbl_user');
				$this->Order_Model->changeUserStatus($user_id,'1');
					
                $purchase_id = $this->Order_Model->addPackagePurchaseJVZ($user_id,$transaction_id,$_POST['cproditem']);
				$this->Order_Model->updateTransaction($transaction_id,$purchase_id,$user_id);
				$packageDetail = $this->Order_Model->getPackageDetail($_POST['cproditem']);
				$data['price']   =   $_POST['ctransamount'];
			    $data['package_id'] = $packageDetail->id;
			    $data['user_id'] = $user_id;
				$data['user_email'] = $_POST['ccustemail'];
			    $data['payment_mode']         =   'Free';
			    $data['payment_status']         =   'complete';
			    $data['trans_id']         =   $transaction_id;
			    $data['purchase_id']         =   $purchase_id;
				$order_id =  $this->Order_Model->addPackageOrder($data);
				
				$this->load->model('package/Package_purchase_Model');
				$user_package = $this->Package_purchase_Model->checkForPackage($user_id);
	            $this->Order_Model->updateUserPackage($user_id,$user_package);
				
				//$this->Mailsending_Model->jvzooUpdateMail($_POST['cprodtitle'],$_POST['ccustemail'],$_POST['ccustname'],$product_id);
				
            }
    }
	
	public function removePlan($detail,$jvz_product_id)
	{
		 $user_id = $detail->id;
		 $this->Order_Model->changePackageStatus($user_id,$jvz_product_id,'inactive');
			      
		 $this->db->select('id');
		 $this->db->where('user_id',$user_id);
		 $this->db->where('status','active');
		 $query1 = $this->db->get('tbl_package_purchase');
		 $rCount = $query1->num_rows();
		 if($rCount==0)
		 $this->Order_Model->changeUserStatus($user_id,'0');
		 $this->load->model('package/Package_purchase_Model');
		 $user_package = $this->Package_purchase_Model->checkForPackage($user_id);
	     $this->Order_Model->updateUserPackage($user_id,$user_package);
	}		
	function addUserProduct()	{	
	$output['manager_id'] = $manager_id = 6;
	$this->Common_Modal->checkForPageAccess($manager_id,'add_product','redirect');	
	$user_id = $this->input->post('user_id');
	$output['detail'] = $this->User_Model->getUserDetail($user_id);	
	$output['product_list'] = $this->User_Model->getProductList();	
	$output['userProducts'] = $this->User_Model->getUserPurchasedProducts($user_id);	
	$response['html'] = $this->load->view($this->config->item('adminFolderName').'/users/add_product',$output,true);		$response['success'] = true;    
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}		
	public function updateUserProduct(){
		$output['manager_id'] = $manager_id = 6;
		$this->Common_Modal->checkForPageAccess($manager_id,'add_plan','redirect');
		$user_id = $this->input->post('user_id');
		$detail = $this->User_Model->getUserDetail($user_id);
		$name = $detail->name;
		$email = $detail->email;
		
		$where = array();
		$where['user_id'] = $user_id;
		$this->db->where($where);
		$query = $this->db->get('business');
		if(!$query->num_rows()){
			$this->session->set_userdata('error_msg','There is no any business for assign product.');
			redirect($this->config->item('adminName').'/manage-users');
		}
		
		$all_products = $this->User_Model->getProductList();
		$post_product_ids = $this->input->post('product_id');
		$current_product_ids = $this->User_Model->getUserPurchasedProducts($user_id);
		
		foreach($all_products as $key1=>$product){
			$product_id = $product->id;
			if(in_array($product_id,$post_product_ids)){
				if(!in_array($product_id,$current_product_ids)){
					//User not has this product yet
					$update_data1 = array();
					$update_data1['user_id'] = $user_id;
					$update_data1['product_id'] = $product_id;
                    $update_data1['title'] = $product->title;
                    $update_data1['plan_type'] = 'free';
                    $update_data1['price'] = 0;
                    $update_data1['transaction_from'] = 'BMS';
                    $update_data1['status'] = 'active';
                    $update_data1['add_time'] = time();
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'user_product_purchase');
					
				}
			}else{
				if(in_array($product_id,$current_product_ids)){
					$where = array();
					$where['user_id'] = $user_id;
					$where['product_id'] = $product_id;
					
					$this->db->set('status','inactive');
					$this->db->where($where);
					$this->db->update('user_product_purchase');
					
					$this->db->set('access_status','inactive');
					$this->db->where($where);
					$this->db->update('user_products');
				}
			}
		}
		
		
		
		$this->session->set_userdata('success_msg','User products updated Successfully');
		redirect($this->config->item('adminName').'/manage-users');
	}
	
	
}