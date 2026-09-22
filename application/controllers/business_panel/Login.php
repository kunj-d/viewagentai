<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Login_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('user_agent');
		
	}
	public function index()
	{
		$output = array();
		if($this->session->userdata('SAG_mem_id'))
		{
			redirect($this->config->item('adminName').'/');
		}
		
		if($_POST)
		 {
		  $output['email'] = $this->input->post('email');
		  $this->form_validation->set_rules('email','Email','trim|required|valid_email');
		  $this->form_validation->set_rules('password','Password','trim|required');
		  
		  if($this->form_validation->run())
		   { 
		     $returnLogin = $this->Login_Model->do_login();		// check user && setting session variables
			
					if($returnLogin=='1')
						{
							// for logging details
							$this->Login_Model->create_log($this->agent->browser(),$this->agent->version(),$this->agent->platform(),$this->agent->mobile()); 
							$this->Last_login_Model->doEntry();		// last login time
							redirect($this->config->item('adminName'));
						}
					else
						{
							$output['error_login']='Invalid login details';
						}
		   }
		 
		 }
		$this->load->view($this->config->item('adminFolderName').'/login',$output);
	}
	public function logout()
	 {
	   $this->session->sess_destroy();
	    redirect($this->config->item('adminName').'/login');
	 }
}