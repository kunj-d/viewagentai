<?php

header("access-control-allow-headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header('Access-Control-Allow-Origin: *');

defined('BASEPATH') or exit('No direct script access allowed');
include_once("AppDefault.php");
class Autoresponder_lead_data_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        
		$this->checkAlreadyLogout();
		$this->Common_Model->checkSubDomain();
        $this->owner_id = $this->session->userdata('logged_in')['id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Settings_integration_Model');
        $this->load->library('pdf');
    }
    public function index(){
        
        $updateData = ["lead_view_status" => 1];
    	$this->db->where('lead_view_status',0);
    	$this->db->update('autoresponder_lead_data', $updateData);
    	
    	
        if ($_POST['search_key']) {
            $this->db->group_start();
            $this->db->or_like('autoresponder_lead_data.name', $data['search_key']);
            $this->db->or_like('autoresponder_lead_data.email', $data['search_key']);
            $this->db->or_like('prompts.text', $data['search_key']);
            $this->db->group_end();
        }
    	
	    
	    $this->db->select('autoresponder_lead_data.*, prompts.text as prompt_name');
// 		$this->db->where("user_id", $this->user_id);
        $this->db->where("autoresponder_lead_data.business_id", $this->business_id);
        $this->db->join('prompts', 'prompts.id = autoresponder_lead_data.prompt_id', 'left');
        $this->db->order_by('autoresponder_lead_data.id','DESC');
        $query = $this->db->get('autoresponder_lead_data');
        $data['lists'] = $query->result_array();
      

        $this->loadView('autoresponder/autoresponder-list.php',$data);
    }
    
    public function getResponseList(){ 
        
        if ($_POST['search_key']) {
            $this->db->group_start();
            $this->db->or_like('customer_apps_visitor_response.cavr_response', $data['search_key']); 
            $this->db->or_like('customer_apps.ca_name', $data['search_key']); 
            $this->db->group_end();
        } 
	    $this->db->select('customer_apps_visitor_response.*, customer_apps.ca_name as ca_name,customer_apps.ca_ending_action_type as ca_ending_action_type'); 
        $this->db->where("customer_apps.ca_business_id", $this->business_id);
        $this->db->join('customer_apps', 'customer_apps_visitor_response.cavr_ca_id=customer_apps.ca_id');
        $this->db->order_by('customer_apps_visitor_response.cavr_id','DESC'); 
        $query = $this->db->get('customer_apps_visitor_response');
        $data['lists'] = $query->result_array(); 
        $this->loadView('autoresponder/app_response_list.php',$data);
    }
     public function coPilotFeedbackList(){ 
        
        if ($_POST['search_key']) {
            $this->db->group_start();
            $this->db->or_like('prompt_visitor_feedback.pvf_feedback', $data['search_key']); 
            $this->db->or_like('prompts.text', $data['search_key']); 
            $this->db->or_like('prompt_visitor_feedback.pvf_feedback_rating', $data['search_key']); 
            $this->db->group_end();
        } 
        $this->db->select('prompt_visitor_feedback.*, prompts.text as prompt_name');
        $this->db->where("prompts.business_id", $this->business_id);
        $this->db->join('prompts', 'prompt_visitor_feedback.pvf_prompt_id=prompts.id');
        $this->db->order_by('prompt_visitor_feedback.pvf_id','DESC'); 
        $query = $this->db->get('prompt_visitor_feedback');
        $data['lists'] = $query->result_array(); 
        $this->loadView('autoresponder/visitor_feedback_list.php',$data);
    }
    
    // public function autoresponderLeadList(){
    //     $this->loadView('autoresponder/autoresponder-list.php');
    // }

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
        // die('hello');
        $response = $this->Settings_integration_Model->get_autoresponder_lead_list_data($data);
		echo json_encode($response);
    }

    public function exportcsv(){
        
        $post_data = json_decode(file_get_contents('php://input'), true);
        
        $this->load->library('csv');
        
        
        $this->db->select('autoresponder_lead_data.*, prompts.text as prompt_name');
// 		$this->db->where("user_id", $this->user_id);
        $this->db->where("autoresponder_lead_data.business_id", $this->business_id);
        $this->db->where_in("autoresponder_lead_data.id", $post_data['ids']);
        $this->db->join('prompts', 'prompts.id = autoresponder_lead_data.prompt_id', 'left');
        $query = $this->db->get('autoresponder_lead_data');
 
        $data = $query->result_array();

        $list = [];
        $header = ['Name','Email','Expert','Date'];
        foreach($data as $key => $val)
        {
            $list[$key][] = $val['name'];
            $list[$key][] = $val['email'];
            $list[$key][] = $val['prompt_name'];
            $list[$key][] = $val['created_date'];
        }
       $exprotdata = $this->csv->exportToCsv($header,$list, 'lead_data.csv');
        echo $exprotdata;
        die();

    }
    
    public function deleteResponder(){
        $id = $this->input->post('id');
        $this->db->where("autoresponder_lead_data.business_id", $this->business_id);
        $this->db->where('id', $id);
        $this->db->delete('autoresponder_lead_data');
        $response = array(
            'status' => 1,
        ); 
        return $response;
    }
    public function deleteAppResponse(){
        $id = $this->input->post('id'); 
        $this->db->where('cavr_id', $id);
        $this->db->delete('customer_apps_visitor_response');
        $response = array(
            'status' => 1,
        ); 
        return $response;
    }
    
    public function deleteFeedback(){
        $id = $this->input->post('id'); 
        $this->db->where('pvf_id', $id);
        $this->db->delete('prompt_visitor_feedback');
        $response = array(
            'status' => 1,
        ); 
        return $response;
    }
    
    
     public function app_response_question(){
        $cavq_cavr_id = $this->input->post('cavq_cavr_id');
        
        $this->db->select('customer_apps_visitor_questions.cavq_visitor_input ,customer_apps_questions.caq_question_text,customer_apps_questions.caq_question_label,customer_apps.ca_name');
        $this->db->from('customer_apps_visitor_questions');
        $this->db->join(' customer_apps_questions', ' customer_apps_questions.caq_id = customer_apps_visitor_questions.cavq_caq_id', 'left');
        $this->db->join('customer_apps', '  customer_apps.ca_id = customer_apps_visitor_questions.cavq_ca_id', 'left');
        $this->db->where('customer_apps_visitor_questions.cavq_cavr_id',$cavq_cavr_id);
        $query = $this->db->get();
        $data= $query->result_array();
         $response = array(
            'status' => true,
            'list' => $data,
            'msg' => 'Success'
        );
        echo json_encode($response);
    }


    
    
    
    
}
