<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Business_Model extends CI_Model {

    var $tablename = 'business';
    var $select_columns = array("id", "user_id", "title", "logo", "domain", "modified", "created");
    var $order_columns = array(null, "title", "logo", "domain", 'created', null);

    function __construct() {
        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }

    public function get_business_list_data() {
        $query = $this->get_business_list_data1();
        // echo $this->db->last_query();
        // die;
        $result["data"] = $query->result_array();
        $result['filtered_records'] = $query->num_rows();

        $query = $this->get_business_list_data1(true);
        $result['total_records'] = $query->num_rows();

        return $result;
    }

    public function get_business_list_data1($get_count = false) {
        $limit = $this->input->get('limit');
        $pageNo = $this->input->get('pageNo');
        $start = ($pageNo - 1) * $limit;

        $this->db->select("business_id");
        $this->db->where('user_id', $this->user_id);
        $this->db->where('owner_id', $this->owner_id);
        $query = $this->db->get('team_users');
        $business_ids = array_column($query->result_array(), 'business_id');


        $this->db->select('b.id,b.title,b.domain,b.logo,b.created');
        $this->db->select('(select count(id) from business_products_settings where business_id = b.id and publish_status="published") as published_products');
        $this->db->select('(select count(id) from product_sales where business_id = b.id and status="active" and plan_type!="free_report") as sales_product_count');
        $this->db->select('(select count(id) from user_blogs where business_id = b.id and visibility_status="1") as published_blogs');
        $this->business_condition($business_ids);
        $this->filter_search();
        $this->filter_date();
        if (!$get_count) {
            if (!empty($this->input->get('sorted_on'))
            ) {
                $sorted_by = $this->input->get('sorted_by');
                $this->db->order_by($this->input->get('sorted_on'), $sorted_by);
            } else {
                $this->db->order_by('created', 'desc');
            }
            $this->db->limit($limit, $start);
        }
        return $query = $this->db->get('business b');
         
    }

    public function business_condition($business_ids) {
        if ($this->user_id == $this->owner_id || $this->owner_id == 0) {
            $this->db->where('user_id', $this->user_id);
        } else {
            $this->db->where_in('id', $business_ids);
        }
    }

    public function filter_search() {
        if ($this->input->get('searchKey') != "") {
            $this->db->group_start();
            $this->db->or_like('title', $this->input->get('searchKey'));
            $this->db->or_like('domain', $this->input->get('searchKey'));
            $this->db->group_end();
        }
    }

    public function filter_date() {
        if (!empty($this->input->get('from_date'))) {
             $from_date = $this->input->get('from_date') != '' ? $this->input->get('from_date')." 00:00:01" : ''; 
            $from_date = strtotime($from_date);
            $this->db->where("created >= ", $from_date);
        }
        if (!empty($this->input->get('to_date'))) {
            $to_date = $this->input->get('to_date') != '' ? $this->input->get('to_date')." 23:59:59" : '';
            $this->db->where("created <= ", strtotime($to_date));
        }
    }

    public function addRecord($data) {
        //echo "<pre>model "; print_r($data); die;
        $this->db->insert($this->tablename, $data);
        return $this->db->insert_id();
    }

    function get_businesses_data() {
        $logged_in = $this->session->userdata('logged_in');

        $user_id = $logged_in['id'];
        $owner_id = $logged_in['owner_id'];
        if ($user_id == $owner_id || $owner_id == 0) {
            $this->db->where("user_id", $user_id);
        } else {
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('team_users');
            if ($query->num_rows() > 0) {
                $business_ids = array_column($query->result_array(), 'business_id');
                $this->db->where_in("id", $business_ids);
            } else {
                return array();
            }
        }
        $query = $this->db->get("business");
        return $query->result_array();
    }

    public function deleteBusinessRecord($business_id) {
        $this->db->where('id', $business_id);
        $this->db->where('user_id', $this->user_id);
        $query = $this->db->get('business');
        if ($query->num_rows() > 0) {
            $title = $query->row_array()['title'];
            
            $businessIds[] = $business_id;
            $this->deleteBusinessData($businessIds);


            $this->db->where('id', $business_id);
            $this->db->where('user_id', $this->user_id);
            $this->db->delete('business');

            $this->Common_Model->set_user_logs('Delete Workspace', $title);
        }
    }
    public function deleteBusinessData($businessIds){
        
        
        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('autoresponder_lead_data');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('chat');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('chatgpt');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('custom_domain_settings');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('prompts');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('smart_library_objects');
        
        // $this->db->where_in('custom',$businessIds);
        // $this->db->delete('prompt_category');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('users_autoresponder_settings');

        $this->db->where_in('business_id',$businessIds);
        $this->db->delete('business_products_settings');
        
         $this->db->where_in('business_id',$businessIds);
        $this->db->delete('ai_generation');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('business_slider_settings');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('contact_us');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('cookie_consent');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('legal_settings');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('library');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('members');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('products_sales_page_setting');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('products_sales_report_setting');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('products_seo_setting');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('product_clicks_stats');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('product_sales');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('product_visitor_stats');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('seo_setting');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('smo_settings');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('social_campaign');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('social_campaign_story');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('team_role');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('team_users');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('ticket');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('users_autoresponder_settings');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('users_social_settings');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('user_blogs');

        // $this->db->where_in('business_id',$businessIds);
        // $this->db->delete('visitor_session');

        // foreach($businessIds as $key=>$business_id){
        //     $dirname = './application/views/users_sales_pages/' . $this->owner_id."/".$business_id;
        //     $this->Common_Model->rmdir_recursive($dirname);
        //     // array_map('unlink', glob("$dirname/*.*"));
        //     // rmdir($dirname);
        // }
       
    }
    
    /**     * *************************************Business Settings ********************************************
     * =========================================================================================================== */
    public function get_business_row($where) {
        $this->db->where($where);
        $query = $this->db->get('business');
        return $query->row_array();
    }

    public function updateBusiness($where, $data) {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('business');
    }

    function get_all_data($user_id) {
        $this->db->select('id');
        $this->db->where("user_id", $user_id);
        $query = $this->db->get('business');
        return $query->num_rows();
    }

    function get_filtered_data($user_id) {
        $this->businesses_filter();
        $this->db->where("user_id", $user_id);
        $query = $this->db->get('business');
        return $query->num_rows();
    }

    function business_delete_all($request) {
        foreach ($request as $key => $val) {
            $this->db->where('id', $val);
            $this->db->delete($this->tablename);
            $this->db->where('business_id', $val);
            $this->db->delete('user_products');
            $this->db->where('business_id', $val);
            $this->db->delete('campaigns');
            $this->db->where('business_id', $val);
            $this->db->delete('campaign_reports');
            $this->db->where('business_id', $val);
            $this->db->delete('social_campaign');
            $this->db->where('business_id', $val);
            $this->db->delete('social_share_items');
            $this->db->where('business_id', $val);
            $this->db->delete('cookie_consent');
            $this->db->where('business_id', $val);
            $this->db->delete('users_social_settings');
            $this->db->where('business_id', $val);
            $this->db->delete('users_autoresponder_settings');
            $this->db->where('business_id', $val);
            $this->db->delete('team_users');
        }
    }

    public function getAllRecord($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->tablename);
        return $query->result_array();
    }

    function deleteRecordById($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->tablename);

        $this->db->where('business_id', $id);
        $this->db->delete('user_products');

        $this->db->where('business_id', $id);
        $this->db->delete('campaigns');

        $this->db->where('business_id', $id);
        $this->db->delete('campaign_reports');
        $this->db->where('business_id', $id);
        $this->db->delete('social_campaign');
        $this->db->where('business_id', $id);
        $this->db->delete('social_share_items');
        $this->db->where('business_id', $id);
        $this->db->delete('cookie_consent');
        $this->db->where('business_id', $id);
        $this->db->delete('users_social_settings');
        $this->db->where('business_id', $id);
        $this->db->delete('users_autoresponder_settings');
        $this->db->where('business_id', $id);
        $this->db->delete('team_users');
    }

    function getRecordById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->tablename);
        return $query->row_array();
    }

    function updateById($id, $data, $user_id) {
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->tablename);

        if ($query->num_rows()) {
            $this->db->where('id', $id);
            $this->db->where('user_id', $user_id);
            $this->db->update($this->tablename, $data);
            return true;
        } else {
            return false;
        }
    }

    public function domainExist($id, $user_id) {
        $this->db->select('domain');
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->tablename);
        return $query->row_array();
    }

    public function getBusinessColorScheme() {
        $query = $this->db->get('business_color_scheme');
        return $query->result_array();
    }
    
    public function checkLastBusiness($user_id) {
        $query = $this->db->where('user_id',$user_id)->count_all_results($this->tablename);
        return $query;
    }
    
    public function getallBusinessUserwise($user_id) {
        $query = $this->db->where('user_id',$user_id)->get($this->tablename)->result_array();
        return $query;
    }
    
    

}
