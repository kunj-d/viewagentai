<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "libraries/chat/autoload.php";
require('AppDefault.php');
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
class Comparison_controller extends AppDefault {

	public function __construct() {
		parent::__construct();
		$this->checkAlreadyLogout();
		require_once APPPATH."libraries/youtube/vendor/autoload.php";
		$this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->dupdub_api_key =$this->config->item('dupdub_api_key');
		$this->openaikey = $this->config->item('open_ai_key');
        $this->youtubeApiKey = $this->config->item('youtube_api_key');
	}


        public function Comparison(){
    		$this->loadView('' , $data);
    	}
    	
    	

    	
}
