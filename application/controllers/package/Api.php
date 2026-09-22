<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
		 $this->load->model('package/Order_Model');	
     	 $this->load->model('package/Package_purchase_Model');
        
    }
    public function index()
    {
       
	   $user_id = $_GET['user_id'];
	   $this->Order_Model->changeFreePkgStatus($user_id);
	   $user_package = $this->Package_purchase_Model->checkForPackage($user_id);
	   $this->Order_Model->updateUserPackage($user_id,$user_package);
	
	}
	
	
}