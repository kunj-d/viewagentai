<?php

defined('BASEPATH') or exit('No direct script access allowed');
include_once("AppDefault.php");
class Session_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();

        $this->owner_id = $this->session->userdata('logged_in')['id'];
         $this->business_id = $this->session->userdata('business')['id'];
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Settings_Model');
    }
    
    public function index(){
         $this->db->where('business_id',$this->business_id);
         if($this->input->post('search_key')!= ""){
            	$this->db->group_start();
            	$this->db->or_like('activity', $this->input->post('search_key'));
    			$this->db->or_like('description', $this->input->post('search_key'));
    				$this->db->group_end();
        }
        
        if (!$get_count) {
            if (!empty($this->input->post('sorted_on'))
            ) {
                $sorted_by = $this->input->post('sorted_by');
                $this->db->order_by($this->input->post('sorted_on'), $sorted_by);
            } else {
                $this->db->order_by('created', 'desc');
            }
            // $this->db->limit($limit, $start);
        }
        $data['lists'] = $this->db->get('user_logs')->result_array();
        $this->loadView('ci-session/session.php',$data);
    }
    
    public function getSessionListDatadd() {
    
    
        

            $data = $this->Settings_Model->getSessionListData($this->input->post('items_per_page'),$this->input->post('current_page') );

            $output['data'] = $data['data'];

            $output['total_records'] = $data['total_records'];

            $output['filtered_records'] = $data['filtered_records'];

  
        echo json_encode($output);

    }
    
    


}
    
  