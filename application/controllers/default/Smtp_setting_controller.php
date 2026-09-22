<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("AppDefault.php");

class Smtp_setting_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        $this->checkAlreadyLogout();
        	$this->Common_Model->checkSubDomain();
          if($this->session->userdata('logged_in')['id'] != $this->session->userdata('logged_in')['owner_id']) {
           redirect('dashboard');
            }
        //  $output['all_plan_features'] = $this->all_plan_features;
        
        $this->load->model('default/Whitelabel_model');
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . "Whitelabel_model");
        
        
        
        
//print_r($this->session->userdata('logged_in')); die('kk');
    }
    
    
   public function index(){
      
		$output = array();
		$userid=$this->session->userdata('logged_in')['id'];
		$this->db->where('userid',$userid);
        $query=$this->db->get('customer_smtp');
        $result=$query->result();
		$data=$result;
	   
	
	    $output['data']=$data;
		
	   
	
	  

        $output['library_page'] = true;
		// pr($output);die;
        
        $this->loadView('settings/smtp_settings', $output);
	       
	}
	
	public function insertdata(){
		
		if($this->input->is_ajax_request()){
	
		    $username = $this->input->post('username');
		    $host = $this->input->post('host');
		    $password = $this->input->post('password');
		        $port = $this->input->post('port');
		        $from_name = $this->input->post('from_name');
		        $from_email = $this->input->post('from_email');
		    
			$this->form_validation->set_rules('username','user name','required');
				$this->form_validation->set_rules('host','host name','required');
					$this->form_validation->set_rules('password','password name','required');
						$this->form_validation->set_rules('port','port ','required');
							$this->form_validation->set_rules('from_name','from name ','required');
							$this->form_validation->set_rules('from_email','from email ','required');
		
			if($this->form_validation->run()===FALSE){
			//	$output['error']['message'] = form_error('username');
					$output['error']['message'] = validation_errors();
				$output['error']['type'] = "flash";
				$this->session->set_flashdata('message', json_encode($output));
				echo json_encode($output);
				die();
          }else{
                $userid=$this->session->userdata('logged_in')['id'];
                
				 $this->db->where('userid',$userid);
            	   $query=$this->db->get('customer_smtp');
            	   $result=$query->result();
				$user_data= $result;
				
				
				if(!$user_data){
				
				
				
				$datatoinsert=array(
				"userid"=>$this->user_id,
				"username"=>$username,
				"host"=>$host,
				"password"=>$password,
				"port"=>$port,
				"from_name"=>$from_name,
				"from_email"=>$from_email,
				"created"=>time(),
				"modified"=>time(),
				);
				
			$this->db->insert('customer_smtp',$datatoinsert);
			
				$output['success']['type'] = 'flash';
				$output['success']['message'] = 'Data Inserted Successfully';
				$this->session->set_flashdata('message', json_encode($output));
			    echo json_encode($output);
				die();
				
				
				
		}else{ 
			
				$datatoupdate=array(
				
				"username"=>$username,
				"host"=>$host,
				"password"=>$password,
				"port"=>$port,
				"from_name"=>$from_name,
				"from_email"=>$from_email,
				"modified"=>time(),
					);
					
					$userid=$this->session->userdata('logged_in')['id'];
	   
	                $this->db->where('userid',$userid); 
	                $this->db->update('customer_smtp',$datatoupdate);
					
					$output['success']['type'] = 'flash';
					$output['success']['message'] = 'Data Updated Successfully';
					$this->session->set_flashdata('message', json_encode($output));
			       echo json_encode($output);
				   die();
				
			}
			
		}
	}
	}
	
// 	public function whitelabel_reset(){
// 	        $user_id = $_POST['user_id'];
// 	        $this->db->where('userid', $user_id);
// 		    $result=$this->db->delete('web_setting');
// 			$output = 'Deleted';
// 			$this->session->set_flashdata('message', json_encode($output));
// 		    echo json_encode($output); die();

// }
    
}
?>