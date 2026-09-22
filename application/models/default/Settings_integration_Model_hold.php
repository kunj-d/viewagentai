<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_integration_Model extends CI_model
{
    var $tableAutoResponders='autoresponders';
	var $tableAutoresponderSettings='users_autoresponder_settings';
    public function __construct()
	{
		parent::__construct();
		$logged_in=$this->session->userdata('logged_in');
		$this->user_id=$logged_in['id'];
	}

    public function getResponderList($autoresponder_id,$user_id){
        $this->db->where("id",$autoresponder_id);
		$query_responder = $this->db->get($this->tableAutoResponders);
		$responder_type = $query_responder->row()->title;
        return $this->getGetresponseList($autoresponder_id,$user_id);
		
		
	}


    public function getGetresponseList($autoresponder_id,$user_id){
		$responder_info = $this->getResponderCredential($autoresponder_id,$user_id);
		$credentials = json_decode($responder_info->credentials);
		$api_key = $credentials->api_key;
		//$api_url = 'https://api2.getresponse.com';
		//require_once APPPATH.'libraries/autoresponder/jsonRPCClient.php';
		//$client = new jsonRPCClient($api_url);
		$api_url = 'https://api.getresponse.com/v3';
		require_once APPPATH . 'libraries/autoresponder/getresponse-api-php/src/GetResponseAPI3.class.php';
		$client = new GetResponse($api_key,$api_url);
		# find campaign list
		//$getresponse_campaigns = $client->get_campaigns($api_key);
		$getresponse_campaigns = $client->getCampaigns();
		//echo '<pre>'; print_r($getresponse_campaigns); die;
		$responder_data = array();
		foreach($getresponse_campaigns as $campaignskey=>$campaignsdetails){
			//echo '<pre>'; print_r($campaignsdetails);
			$responder_d["listid"] = $campaignsdetails->campaignId;
			$responder_d["title"] = $campaignsdetails->name;
			array_push($responder_data,$responder_d);
		}
		return $responder_data;
	}

    public function getResponderCredential($autoresponder_id,$user_id){
		$this->db->where("user_id",$user_id);
		// $this->db->where('business_id', $this->business_id);
		$this->db->where("autoresponder_id",$autoresponder_id);
		$query=$this->db->get($this->tableAutoresponderSettings);
		return $query->row();


	}
	
	
	
    public function get_autoresponder_lead_list_data($data) {


        if ($data['search_key']) {
            $this->db->group_start();
            $this->db->or_like('name', $data['search_key']);
            $this->db->group_end();
        }

        $items_per_page = $data['items_per_page'] ? $data['items_per_page'] : 10;
        $current_page = $data['current_page'] ? $data['current_page'] : 1;
		$start = ($current_page - 1) * $items_per_page;
	
// 		$this->db->where("user_id", $this->user_id);
        $this->db->where("business_id", $this->business_id);
        $query = $this->db->get('autoresponder_lead_data',$items_per_page,$start);
        $output['data'] = $query->result_array();
// 		pr($output);die;
       // echo $this->db->last_query(); die;
        // $totalquery = $this->db->query('SELECT FOUND_ROWS() as total;');
        // $row = $totalquery->row();
        $output['total_items'] = $this->db->count_all('autoresponder_lead_data');

        return $output;
    }

	public function get_auto_responder_lead_details($id){

		$this->db->select('name, email,created_date');
		$this->db->where('id',$id);
		$this->db->where('user_id', $this->session->userdata('logged_in')['id']);
		$query = $this->db->get('autoresponder_lead_data');
		return $query->result_array();

	}
	
}