<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("AppDefault.php");

class Settings_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        $this->checkAlreadyLogout();
        	$this->Common_Model->checkSubDomain();
       // $this->Common_Model->checkSubDomain();
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
       
        $this->model_folder = $this->config->item('template');
        $this->view_folder = $this->config->item('template');

        // $this->load->model($this->model_folder . 'Settings_Model');

    }

    public function index(){
        $output = array();
        $this->loadView('settings/settings', $output);
    }
    
    public function agency_product(){
        $output = array();
        $this->loadView('agency/agency', $output);
    }
}
