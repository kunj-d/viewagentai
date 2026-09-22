<?php

header("access-control-allow-headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header('Access-Control-Allow-Origin: *');

defined('BASEPATH') or exit('No direct script access allowed');
include_once("AppDefault.php");
class Autoresponder_sender_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        $this->aweber_consumerKey    = config_item('aweber_consumer_key');
        $this->aweber_consumerSecret = config_item('aweber_consumer_secret');
        $this->owner_id = $this->session->userdata('logged_in')['user_id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Settings_integration_Model');
        $this->load->library('pdf');
    }
    public function index()
    {
        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 2;
        $autoresponder_id = isset($_REQUEST['autoresponder_id']) ? $_REQUEST['autoresponder_id'] : 2;
        $listId = isset($_REQUEST['list_id']) ? $_REQUEST['list_id'] : '';
        $prompt_id = isset($_REQUEST['prompt_id']) ? $_REQUEST['prompt_id'] : '';
        $output = array();

        $this->db->where("id", $autoresponder_id);
        $query_responder = $this->db->get("autoresponders");
        $result = $query_responder->row();
        // echo $this->db->last_query();
        // print_r($result);
        // die($result);
        $responder_type = $result->title;

        $this->db->select('user_id');
        $this->db->where('id',$user_id);
        $query1 = $this->db->get('business');
        $user_data = $query1->row();
    
        $user_ids = $user_data->user_id;

        $this->db->where("user_id", $user_ids);
       // $this->db->where("business_id", $user_id);
        $this->db->where("autoresponder_id", $autoresponder_id);
        $query = $this->db->get("users_autoresponder_settings");
       
        $result = $query->row();

        $credentials = json_decode($result->credentials);
        $credentials_modified = $result->modified;

        $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
        $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
        $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $fax = isset($_REQUEST['fax']) ? $_REQUEST['fax'] : '';
        $bussiness = isset($_REQUEST['bussiness']) ? $_REQUEST['bussiness'] : null;
        $suffix = isset($_REQUEST['suffix']) ? $_REQUEST['suffix'] : null;
        $street = isset($_REQUEST['street']) ? $_REQUEST['street'] : null;
        $stree2 = isset($_REQUEST['stree2']) ? $_REQUEST['stree2'] : null;
        $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : null;
        $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : null;
        $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : null;
        $postal_code = isset($_REQUEST['postal_code']) ? $_REQUEST['postal_code'] : null;
        $postal_code = isset($_REQUEST['zip']) ? $_REQUEST['zip'] : null;
        $prefix = isset($_REQUEST['prefix']) ? $_REQUEST['prefix'] : null;




        //	require_once './application/views/lib/jsonRPCClient.php';
        require_once APPPATH . 'libraries/autoresponder/getresponse-api-php/src/GetResponseAPI3.class.php';
        // GetrRsponse API credentials
        $api_key = $credentials->api_key;
        //$api_url = 'https://api2.getresponse.com';
        $api_url = 'https://api.getresponse.com/v3';
        $client = new GetResponse($api_key, $api_url);
        //$client = new GetResponse($api_key,$api_url);
        # initialize JSON-RPC client
        //$client = new jsonRPCClient($api_url); 
        $campaign = $listId;

        # add contact to the campaign
        try {
            if (!empty($email)) {
                $name = $name == "" ? $email : $name;
                $param = array(
                    'campaign' => array("campaignId" => $campaign),
                    'name'       => $name,
                    'email'      => $email,
                    'type'       => 'single_select',
                    'dayOfCycle' => 10,
                    'createdOn'   => time(),
                    'origin'      => 'email'
                );
                $response = $client->addContact($param);
              
                
                    
                if (!empty($response)) {
                                
              
                     $inser_data = array(
                    'business_id'=>$user_id,
                    'prompt_id'=> $prompt_id,
                    'autoresponder_id'=>$autoresponder_id,
                    'list_id' =>$listId,
                    'name'=>$name,
                    'email'=>$email
                    );
                    $this->db->insert('autoresponder_lead_data',$inser_data);
                    
                    $output['status'] = true;
                    $output['message'] = 'Successfully suscribed';
                } else {
                    $output['status'] = false;
                    $output['message'] = 'something wrong, please try again';
                }
            } else {
                $output['status'] = false;
                $output['message'] = 'email field are required.';
            }
        } catch (Exception $e) {
            $return_string = $e->getMessage();

            if (strpos($return_string, 'Contact already') == true) {
                $output['status'] = true;
                $output['message'] = 'Contact already added to target campaign';
            } else {
                $output['status'] = false;
                $output['message'] = 'Some problem occurred, please try again';
            }
        }


        echo json_encode($output);
    }
    
    
        public function autoresponderLeadList(){
        $this->loadView('autoresponder/autoresponder-list.php');
    }

    public function getPeramitter()
	{
		$current_page = isset($_POST['current_page']) ? $this->input->post('current_page') : 1;
		$data = array(
			'search_key' => '',
			'items_per_page' => 10,
			'start' => 1,
			'current_page' => 1,
		);

		if (isset($_POST['search_key'])) {
			$data['search_key'] = $_POST['search_key'];
		}

		if (isset($_POST['items_per_page'])) {
			$data['items_per_page'] = $_POST['items_per_page'];
		}

		if (isset($_POST['current_page'])) {
			$data['current_page'] = $_POST['current_page'];
		}

		return $data;
	}

    public function getResponderLeadList(){
        $data = $this->getPeramitter();

        $response = $this->Settings_integration_Model->get_autoresponder_lead_list_data($data);
		echo json_encode($response);
    }

    public function downloadAutoResponderLead(){
        // echo("I am in DonloadConversation controller");
		$id = $this->input->get('id');

		$htmlContent = '';
		// $generate_html = $this->Conversation_Model->get_conversation_details($id);
		$generate_html = $this->Settings_integration_Model->get_auto_responder_lead_details($id)[0];

        // pr($generate_html);die;

	
		$htmlContent .= "<b>Auto Responder Name:  </b>" . $generate_html['name'] . "<br>" . "<b>Email:  </b>" . $generate_html['email'] . "<br>" ."<b>Create Date:  </b>" . $generate_html['created_date'] . "<br>" ;
        
        $this->load->helper('download');

        $this->pdf->loadHtml($htmlContent);

        $this->pdf->setBasePath(base_url());

        $this->pdf->render();


        $output = $this->pdf->output();

 

        // Set the file name for the downloaded PDF

        $filename = $generate_html['name'] . '.pdf';


        // Force the PDF to download in the browser

        return  force_download($filename, $output, true);
      
    }

    
    
    
    
}
