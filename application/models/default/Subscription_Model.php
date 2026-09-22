<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_Model extends CI_model {

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $business = $this->session->userdata('business');
        $this->business_id = $business['id'];
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }

    public function getPaymentHistory() {
        $this->db->where('user_id', $this->owner_id);
        $this->db->order_by('add_time', "desc");
        $query = $this->db->get('tbl_package_purchase');
        
        return $query->result_array();
    }

}

?>