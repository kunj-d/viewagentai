<?php defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');

class Bonus_controller extends AppDefault {

	public function __construct()
	{ 
	    
        parent::__construct();
     
        $this->checkAlreadyLogout();
		//$this->Common_Model->checkSubDomain();
		$this->owner_id 		= 	$this->session->userdata('logged_in')['owner_id'];
		$this->user_id 				= $this->session->userdata('logged_in')['id'];
		$this->assets_folder =   $this->config->item('assetsTemplatePath');
		$this->upload_folder 	= $this->config->item('uploadPath');
		$this->load->model("default/Bonus_Model");


	}

	public function index($slug)
    	{
    	    //$slug = 'special-bonuses';
    		$output=array();
    		$output['fetch_data'] = $this->Bonus_Model->getRecordList($slug);
    		$output['slug'] =$slug;
    		$output['uploadFolder'] =$this->upload_folder;
    		$output['title'] = 'Bonuses';

    		$this->loadView('bonus/bonuses', $output);
    	}
    }