<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Session_Model extends CI_model {

    var $legal_settings_table = 'legal_settings';

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $business = $this->session->userdata('business');
        $this->business_id = $business['id'];
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }


  public function getSessionListData() {
        $query = $this->getSessionListData1();
        $result["data"] = $query->result_array();
        $result['filtered_records'] = $query->num_rows();

        $query = $this->getSessionListData1(true);
        $result['total_records'] = $query->num_rows();

        return $result;
    }

    public function getSessionListData1($get_count = false) {
    
    	$limit = $this->input->post('item_per_page');
		$pageNo = $this->input->post('current_page');
        $start = ($pageNo - 1)*$limit;

        //$this->db->select('id,name,email,activity,description,role,created');
        $this->db->where('business_id',$this-business_id);
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
            $this->db->limit($limit, $start);
        }
        return $query = $this->db->get('user_logs');
    }
    
}