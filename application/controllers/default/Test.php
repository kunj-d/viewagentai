<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller  {
    public function __construct() {
		parent::__construct();
		

		//$this->load->model('Common_plans_Model');
    }
    
    
    public function index() {
  
     
           //header('Content-Type: application/json');
       //$rawData = file_get_contents("php://input");
    
       $rawData = $_GET['q'];
             $result = array(
                    'status' => 1,
                    'data' => $rawData
                );
              
            echo json_encode($result);
            exit;

      //  $data =  $this->input->post('param1');
       // echo json_encode($data); die;
    }
	
	}