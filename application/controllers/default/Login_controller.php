<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("AppDefault.php");

class Login_controller extends AppDefault {

	public function __construct(){
		parent::__construct();
		$this->load->model('default/Login_Model','LoginModel');
		$this->load->model('default/Mail_Model');
		$this->recamptcha_secret = config_item('recaptcha_secret');
		$this->loginRedirectUrl = $this->config->item('loginRedirectUrl');


	}
	
	
	 public function BonusSignup() {
        $this->checkAlreadyLogin();
        $output = array();
    
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirmation Password', 'required|matches[password]');
            $this->form_validation->set_message('valid_email', 'Invalid email address.');
            $this->form_validation->set_message('is_unique', 'This %s is already registered. Try another.');
            $this->form_validation->set_message('matches', 'Confirmation Password does not match.');
    
            if ($this->form_validation->run() == FALSE) {
                $output['error']['message'] = validation_errors();
                $output['error']['type'] = "flash";
                echo json_encode($output);
                die();
            } else {
                require_once(APPPATH . 'libraries/recaptcha/recaptchalib.php');
                $response = null;
                $reCaptcha = new ReCaptcha($this->recamptcha_secret);
    
                if ($this->input->post("g-recaptcha-response")) {
                    try {
                        $response = $reCaptcha->verifyResponse(
                            $_SERVER["REMOTE_ADDR"],
                            $this->input->post("g-recaptcha-response")
                        );
                    } catch (Exception $e) {
                        $flashdata['error'] = array('message' => "Invalid reCAPTCHA", 'type' => 'flash');
                        $this->session->set_flashdata('message', json_encode($flashdata));
                        $output['redirect'] = 'reload';
                        echo json_encode($output);
                        die();
                    }
                } else {
                    $output['error'] = array('message' => "Please select reCAPTCHA", 'type' => 'flash');
                    echo json_encode($output);
                    die();
                }
    
              	$parentId = $this->LoginModel->insertRecord();
    
                // Add the following lines to update the 'owner_id' after user registration
                $parentId = $this->db->insert_id();
                $where = array('id' => $parentId);
                $update = array('owner_id' => $parentId);
                $this->Common_Model->updateAnyTable('tbl_user', $where, $update);
    
                // if($this->config->item('islive')!='off'){
                //     $this->Mail_Model->registration_email($this->input->post("password"));
                // }
                /* User Package Code */
                $name=$this->input->post("name");
                $email=$this->input->post("email");
                $this->load->model('package/Order_Model');
                $this->load->model('package/Mailsending_Model');
                $this->load->model('package/Package_purchase_Model');
                $this->Package_purchase_Model->setFreeBonusPlan($email,'****');
    
                if($this->config->item('islive')!='off'){
                    $replaceArray['name'] = $name;
                    $replaceArray['email'] = $email;
                    $planTemplate = $this->Order_Model->getEmailTemplateDetail('bonus_plan');
                    $plansubject = $planTemplate->subject;
                    $planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$replaceArray);
                    if($planTemplate->message!='')
                    $this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
                }
                
                //Aweber 
                $this->session->set_userdata('aw_name',$this->input->post("name"));
                $this->session->set_userdata('aw_email',$this->input->post("email"));
                $this->session->set_userdata('aweber','aweber');
                
    
    
                $flashdata['success'] = array('message' => 'Thanks for email registration. Please verify your email.', 'type' => 'flash');
                $this->session->set_flashdata('message', json_encode($flashdata));
                $output['redirect'] = site_url('login');
                echo json_encode($output);
                die();
            }
        } else {
            $this->load->view($this->config->item('template') . 'login/bonus_signup', $output);
        }
    }
	
// 		public function BonusSignup(){
// 		 $this->checkAlreadyLogin();
//          $output = array();

//             if ($this->input->post()){
//                 	$this->form_validation->set_rules('name', 'Name', 'required');
//         			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_user.email]');
//         			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
//         			$this->form_validation->set_rules('confirm_password', 'Confirmation Password', 'required|matches[password]');
//         			$this->form_validation->set_message('valid_email', 'Invalid email address.');
//         			$this->form_validation->set_message('is_unique', 'This %s is already registered. Try another.');
//         			$this->form_validation->set_message('matches', 'Confirmation Password does not match.');
//                 if ($this->form_validation->run() == FALSE){
//                     $output['error']['message'] = validation_errors();
//                     $output['error']['type'] = "flash";
//                     echo json_encode($output);
//                     die();
//                 } else {
//                     require_once(APPPATH.'libraries/recaptcha/recaptchalib.php');
//                     $response = null;
//                     $reCaptcha = new ReCaptcha($this->recamptcha_secret);
//                     //echo"<pre>"; print_r($this->input->post()); die('ff');
//                   if ($this->input->post("g-recaptcha-response")) {
//                       try{
//                           $response = $reCaptcha->verifyResponse(
//                               $_SERVER["REMOTE_ADDR"],
//                               $this->input->post("g-recaptcha-response")
//                           );
//                       }catch(Exception $e){
//                           $flashdata['error'] = array('message' => "Invalid reCAPTCHA", 'type'=>'flash');
//                           $this->session->set_flashdata('message', json_encode($flashdata));
//                           $output['redirect']= 'reload';
//                           echo json_encode($output);
//                           die();
//                       }
//                   }
//                   else{
//                       $output['error'] = array('message' => "Please select reCAPTCHA", 'type'=>'flash');
//                       echo json_encode($output);
//                       die();
//                   }
                   
        
//                     $data = array(
//                         'name'      =>$this->input->post('name'),
//                         'email'     => $this->input->post('email'),
//                         'password'  => md5($this->input->post('password')),
                        
//                     );
        
//                     $this->db->insert('tbl_user', $data);
//                     $output['success'] = 'User registered successfully!';
//                     echo json_encode($output);
//                     die();
//                     	$where = array('id'=>$parentId);
//         			$update = array('owner_id'=>$parentId);
//         			$this->Common_Model->updateAnyTable('tbl_user',$where,$update);
//         			$this->load->model('default/Mail_Model');
//         			if($this->config->item('islive')!='off'){
//         				$this->Mail_Model->registration_email($this->input->post("password"));
//         			}
//         			/* User Package Code */
//         			$name=$this->input->post("name");
//         			$email=$this->input->post("email");
//         			$this->load->model('package/Order_Model');
//         			$this->load->model('package/Mailsending_Model');
//         			$this->load->model('package/Package_purchase_Model');
//         			$this->Package_purchase_Model->setFreeplan($email,'****');
        
//         			if($this->config->item('islive')!='off'){
//         				$replaceArray['name'] = $name;
//         				$replaceArray['email'] = $email;
//         				$planTemplate = $this->Order_Model->getEmailTemplateDetail('fe-0');
//         				$plansubject = $planTemplate->subject;
//         				$planmessage = $this->Common_Modal->replaceEmailTags($planTemplate->message,$replaceArray);
//         				if($planTemplate->message!='')
//         				$this->Mailsending_Model->sendmail($plansubject,$planmessage,$email);
//         			}
        			
//         			//Aweber 
//         			$this->session->set_userdata('aw_name',$this->input->post("name"));
//         			$this->session->set_userdata('aw_email',$this->input->post("email"));
//         			$this->session->set_userdata('aweber','aweber');
        
//         			$flashdata['success'] = array('message' => 'Thanks for email register. Please verify your mail.', 'type'=>'flash');
//         			$this->session->set_flashdata('message', json_encode($flashdata));
//         			$output['redirect']= site_url('thank-you');
//         			echo json_encode($output);
//         			die();
//                 }
//             } else {
//                 $this->load->view($this->config->item('template').'login/bonus_signup', $output);
//             }
// 	}
	

	public function login(){
        // echo"<pre>"; print_r($this->input->post()); die('login');
        $this->checkAlreadyLogin();
        $output = array();
        if ($this->input->post()){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_message('valid_email', 'Error! Invalid email address.');
            if ($this->form_validation->run() == FALSE){
                $output['error']['message'] = validation_errors();
                $output['error']['type'] = "flash";
                echo json_encode($output);
                die();
            }else{
                
                /*require_once(APPPATH.'libraries/recaptcha/recaptchalib.php');
     			$response = null;
     			$reCaptcha = new ReCaptcha($this->recamptcha_secret);
     			//echo"<pre>"; print_r($this->input->post()); die('ff');
    			if ($this->input->post("g-recaptcha-response")) {
    				try{
    					$response = $reCaptcha->verifyResponse(
    						$_SERVER["REMOTE_ADDR"],
    						$this->input->post("g-recaptcha-response")
    					);
    				}catch(Exception $e){
    					$flashdata['error'] = array('message' => "Invalid reCAPTCHA", 'type'=>'flash');
    					$this->session->set_flashdata('message', json_encode($flashdata));
    					$output['redirect']= 'reload';
    					echo json_encode($output);
    					die();
    				}
    			}
    			else{
    				$output['error'] = array('message' => "Please select reCAPTCHA", 'type'=>'flash');
    				echo json_encode($output);
    				die();
    			}*/
                
                
                
                $email 	= $this->input->post('email');
                $record	= $this->LoginModel->getUserByEmail($email);
                if (!$record) {
					$output['error'] = array('message' => "Email not register here.", 'type'=>'flash');
					echo json_encode($output);
					die();
				}
                if(md5($this->input->post("password")) !=  $record->password){
					$output['error'] = array('message' => "Invalid Email or Password Credentials.", 'type'=>'flash');
					echo json_encode($output);
					die();
				}
                if ($record->owner_id == 0) {
					$parentId = $record->id;
				} else {
					$parentId = $record->owner_id;
				}
                if ($record->owner_id != $record->id) {
					$this->db->select('user_package');
					$this->db->where('id',$record->owner_id);
					$query1 = $this->db->get('tbl_user');				
					$record1 = $query1->row();			
					$user_package = $record1->user_package;
				} else {
					$user_package = $record->user_package;
				}
                $sessionArray = array(
					'id' 			=> $record->id,
					'parent_id' 	=> $record->owner_id,
					'owner_id' 		=> $parentId,
					'user_role' 	=> $record->role,
					'email'			=> $email,
					'name' 			=> $record->name,
					'profile_pic' 	=> $record->profile_image,
					'timezone' 		=> $record->timezone,
					'user_package' 	=> $user_package
				);
                // echo("<pre>");
                // print_r($sessionArray);
                // echo("/<pre>");die;
                $this->session->set_userdata('logged_in', $sessionArray);
				$this->session->set_userdata('welcome_status', $record->welcome_status);
				$this->session->set_userdata('social_login', 0);
				$this->session->set_userdata('business_switch_session', 1);
				$this->session->set_userdata('dashboardModal', 0);
				
				/// default businesss Create COde
				// $business_data = $this->LoginModel->get_businesses_data();
				// if(($record->id == $parentId || $parentId == 0) && empty($business_data))
				// {
				//     $this->LoginModel->defaultBusinessCreate();
				// }

				// echo site_url('dashboard');;
				$output['redirect']	= base_url($this->loginRedirectUrl);
				//echo($output);
				
				// redirect(base_url($this->loginRedirectUrl));
				

				echo json_encode($output);
				die();
			// $this->load->view($this->config->item('template').'login/login', $output);
                  
            }//else end;
           
        }else{
			$this->load->view($this->config->item('template').'login/login', $output);
		}


       
	}
	public function logout(){
    	$this->session->sess_destroy();
    	echo '<script>sessionStorage.removeItem("dashboardModal");</script>';
    	$current_domain = current(explode('.',$_SERVER['HTTP_HOST']));
    //	redirect(str_replace($current_domain, 'www', base_url('login')));
                 redirect($this->config->item("redirect_www_url")."login");
    	//redirect(base_url('login'));
	}
	
	public function forgotPassword(){
	    
		$this->checkAlreadyLogin();
		$output = array();
		if(isset($_POST['email'])){
		    
			$this->form_validation->set_rules('email', 'Email','required|valid_email');
			
			if ($this->form_validation->run()){
				$this->db->select('id');
				$this->db->where('email',$this->input->post("email"));
				$query=$this->db->get('tbl_user');
				
				if($query->num_rows() == 0){
					$output['error'] = array('message' => "Error! Email not registered.", 'type'=>'flash');
					echo json_encode($output);
					die();
				} else {
					$this->db->set('reset_key', md5($this->input->post("email").time()));
					$this->db->where('email', $this->input->post("email"));
					$this->db->update('tbl_user');
					$this->Mail_Model->forgetpassword($query->row());
					$output['redirect'] = base_url("forgot-password/thank-you");
					$flashdata['forgot'] = "true";
					$this->session->set_flashdata('fotgot-pass', json_encode($flashdata));
					echo json_encode($output);
					die();
				}
			} else {

				$output['error']['message'] = form_error('email');
				$output['error']['type'] = "flash";
				echo json_encode($output);
				die();
			}
		} else {
			$this->load->view($this->config->item('template').'login/forgot-password', $output);
		}
	}
	
	public function aftrForgotPassword(){
	    
		if($this->session->flashdata("fotgot-pass")){
			$this->load->view($this->config->item('template').'login/after-forgot-password');
		}
		else{
			redirect(base_url("login"));
		}
	}

	public function resetPassword(){
		
		
		$this->checkAlreadyLogin();
		if (isset($_POST['password']) && $this->input->get('email')) {
			//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|callback_valid_password');
			$this->form_validation->set_rules('cpassword', 'Confirmation Password', 'required|matches[password]');
			$this->form_validation->set_message('matches', 'Error! Confirmation Password does not match.');
			
			if ($this->form_validation->run() == FALSE) {
				$output['error']['message'] = validation_errors();
				$output['error']['type'] = "flash";
				echo json_encode($output);
				die();
			} else {
				$this->db->select('id,password,status');
				$this->db->where('email',$this->input->get("email"));
				$this->db->where('reset_key', $this->input->get("code"));
				$query=$this->db->get('tbl_user');
				//echo $this->db->last_query();die;
				
				if ($query->num_rows()) {
					$result=$query->row();
					$password=$this->input->post("password");
					if ($result->password==md5($password)) {
						$output['error']['message'] = 'Error! Old password and new password are same, Try another password';
                        $output['error']['type'] = "flash";
						echo json_encode($output);
						die();
					} else {
						$this->db->set('status', 'active');
						$this->db->set('password', md5($password));
						$this->db->set('reset_key', ' ');
						$this->db->where('email', $this->input->get("email"));
						$this->db->update('tbl_user');
						$flashdata['reset'] = "true";
						$this->session->set_flashdata('reset-pass', json_encode($flashdata));
						$output['redirect'] = base_url("reset-password/success");
						echo json_encode($output);
						die();
					}
				} else {
					$flashdata['error'] = array('message' => "Error! Reset password link expired.", 'type'=>'flash');
					$this->session->set_flashdata('message', json_encode($flashdata));
					$output['redirect'] = base_url("login");
					echo json_encode($output);
					die();
				}
			}
		}
		
		$this->db->select('id');
		$this->db->where('email',$this->input->get("email"));
		$this->db->where('reset_key',$this->input->get("code"));
		$query=$this->db->get('tbl_user');
		$user = $query->row();
		if ($query->num_rows()) {
		  //  echo($this->config->item('template').'login/reset-password');die;
			$this->load->view($this->config->item('template').'login/reset-password');
		} else {
			$output['error'] = array('message' => "Error! Password reset link expired.", 'type'=>'flash');
			$this->session->set_flashdata('message', json_encode($output));
			redirect(base_url("login"));
		}
	}
	
// 	Form Validation
	
    public function valid_password($password) {
        if (preg_match('/[A-Z]/', $password) === 0) {
            $this->form_validation->set_message('valid_password', 'The {field} must contain at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match('/[a-z]/', $password) === 0) {
            $this->form_validation->set_message('valid_password', 'The {field} must contain at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match('/[0-9]/', $password) === 0) {
            $this->form_validation->set_message('valid_password', 'The {field} must contain at least one number.');
            return FALSE;
        }
        if (preg_match('/[\W_]/', $password) === 0) {
            $this->form_validation->set_message('valid_password', 'The {field} must contain at least one special character.');
            return FALSE;
        }
        return TRUE;
    }

// 	Form Validation
	
	
	
		public function afterResetPassword(){

    		if($this->session->flashdata("reset-pass")){
    			$this->load->view($this->config->item('template').'login/after-reset');
    		}
    		else{
    			redirect(base_url("login"));
    		}
	}

}