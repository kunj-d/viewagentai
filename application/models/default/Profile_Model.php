<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Model extends CI_model {

    public function __construct() {
        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }

    public function getUserProfile($userid) {

        $this->db->select('*');
        $this->db->where('id', $userid);
        $query = $this->db->get('tbl_user');
        //echo $this->db->last_query(); die;
        //print_r($query->result_array()); die('789');
        return $query->result_array();
    }

    public function getAllTimezones() {
        $this->db->select('*');
        $query = $this->db->get('timezones');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    function updateUserProfile($userid, $data) {

        $this->db->where('id', $userid);
        $this->db->update('tbl_user', $data);
        //echo $this->db->last_query();
        //die;
        if ($this->db->affected_rows() > 0) {
            return $userid;
        }
    }

}
