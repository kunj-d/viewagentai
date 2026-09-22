<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include("AppDefault.php");

class Subscription_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        $this->checkAlreadyLogout();
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        //$this->Common_Model->checkSubDomain();
        $this->business = $this->session->userdata('business');
        $this->business_id = $this->business['id'];
        $this->model_folder = $this->config->item('template');
        $this->view_folder = $this->config->item('template');
        $this->load->model($this->model_folder . 'Subscription_Model');
    }

    public function index() {
        $output = array();

        //$plan_usage_data['user_business'] = $this->Common_Model->getBusiness_Count();
        $plan_usage_data['total_business'] = $this->all_plan_fields_counts['busniess_count']['value'];




        $output['plan_usage_data'] = $plan_usage_data;
        $payment_history = $this->Subscription_Model->getPaymentHistory();
        $output['payment_history'] = $payment_history;


        $this->db->select('package_id');
        $this->db->where('status', 'active');
        $this->db->where('user_id', $this->owner_id);
        $query = $this->db->get('tbl_package_purchase');
        if ($query->num_rows() > 0) {
            $package_data = $query->result_array();
            $purchase_plan_ids = $output['purchase_plan_ids'] = array_column($package_data, 'package_id');
        } else {
            $purchase_plan_ids = $output['purchase_plan_ids'] = array();
        }

        //$output['purchase_plan_ids'] = $purchase_plan_ids;

        $output['free_plan_active'] = false;
        $output['free_plan_purchased'] = false;
        $output['free_plan_expire_days'] = false;

        $this->db->where('user_id', $this->owner_id);
        $this->db->where('status', 'active');
        $this->db->where('plan_type', 'free');
        $query = $this->db->get('tbl_package_purchase');
        if ($query->num_rows() > 0) {
            $free_data = $query->row();

            $temp_time = time() - (86400 * 12);
            if ($temp_time > $free_data->add_time) {
                if (($temp_time - $free_data->add_time) > 86400) {
                    $output['free_plan_expire_days'] = "Expired in 2 Days";
                } else {
                    $output['free_plan_expire_days'] = "Expired in 1 Days";
                }
            }
            $output['free_plan_active'] = true;
            $output['free_plan_purchased'] = true;
        } else {
            $this->db->where('user_id', $this->owner_id);
            $this->db->where('plan_type', 'free');
            $query = $this->db->get('tbl_package_purchase');
            if ($query->num_rows() > 0) {
                $output['free_plan_active'] = false;
                $output['free_plan_purchased'] = true;
            } else {
                $output['free_plan_active'] = false;
                $output['free_plan_purchased'] = false;
            }
        }


        $plan_array_old = array(41, 42);
        $fe_A_link = 'https://www.tubeclawai.com/special';
        $fe_B_link = 'https://www.tubeclawai.com/special';

        $pro_B_link = 'https://www.tubeclawai.com/unlimited/';
        $enterprie_link = 'https://www.tubeclawai.com/enterprise';

        $agency_A_link = 'https://www.tubeclawai.com/agency';
        $agency_B_link = 'https://www.tubeclawai.com/agency';

        $Bundle_link = 'https://www.tubeclawai.com/bundle/';
        $dfy_link = 'https://www.tubeclawai.com/dfy/';
        
        $traffic_link = 'https://www.tubeclawai.com/traffic';
        $lite_link = 'https://www.tubeclawai.com/enterprise/';
        
        $studio_link = 'https://www.tubeclawai.com/studio/';

        $fastpass_link = 'https://www.tubeclawai.com/fastpass';
        $Mega_Bundle_link = 'https://www.tubeclawai.com/megabundle';

        $automation_link = 'https://tubeclawai.com/automation/';

        $reseller_A_link = 'https://www.tubeclawai.com/reseller';
        $reseller_B_link = 'https://www.tubeclawai.com/reseller';


        //Standard Plan(front end1)
        if (in_array(12, $purchase_plan_ids)) {
            $output['fe_A_show'] = true;
            $output['fe_A_active'] = true;
            $output['fe_A_link'] = 'javascript:;';
            $output['fe_A_recomnded'] = false;
        } else {
            $output['fe_A_show'] = false;
            $output['fe_A_active'] = false;
            $output['fe_A_link'] = $fe_A_link;
            $output['fe_A_recomnded'] = false;
        }

        //Commercial Plan(front end2)
        if (in_array(1, $purchase_plan_ids)) {
            $output['fe_B_show'] = true;
            $output['fe_B_active'] = true;
            $output['fe_B_link'] = 'javascript:;';
            $output['fe_B_recomnded'] = false;
        } else {
            $output['fe_B_show'] = true;
            $output['fe_B_active'] = false;
            $output['fe_B_link'] = $fe_B_link;
            $output['fe_B_recomnded'] = true;
        }

        //Pro Standard(OTO1)


        if (in_array(3, $purchase_plan_ids)) {
            $output['pro_B_show'] = true;
            $output['pro_B_active'] = true;
            $output['pro_B_link'] = 'javascript:;';
            $output['pro_B_recomnded'] = false;
        } else {
            $output['pro_B_show'] = true;
            $output['pro_B_active'] = false;
            $output['pro_B_link'] = $pro_B_link;
            $output['pro_B_recomnded'] = true;
        }

        if (in_array(4, $purchase_plan_ids)) {
            $output['enterprie_show'] = true;
            $output['enterprie_active'] = true;
            $output['enterprie_link'] = 'javascript:;';
            $output['enterprie_recomnded'] = false;
        } else {
            $output['enterprie_show'] = true;
            $output['enterprie_active'] = false;
            $output['enterprie_link'] = $enterprie_link;
            $output['enterprie_recomnded'] = true;
        }

        if(in_array(4,$purchase_plan_ids)){
            $output['traffic_show'] = true;
            $output['traffic_active'] = true;
            $output['traffic_link'] = 'javascript:;';
            $output['traffic_recomnded'] = false;
        }else{
            $output['traffic_show'] = true;
            $output['traffic_active'] = false;
            $output['traffic_link'] = $traffic_link;
            $output['traffic_recomnded'] = false;
        }
        //BizDrive (OTO2)
        //Agency 500(OTO3)
        if (in_array(7, $purchase_plan_ids)) {
            $output['agency_A_show'] = true;
            $output['agency_A_active'] = true;
            $output['agency_A_link'] = 'javascript:;';
            $output['agency_A_recomnded'] = false;
        } else {
            $output['agency_A_show'] = true;
            $output['agency_A_active'] = false;
            $output['agency_A_link'] = $agency_A_link;
            $output['agency_A_recomnded'] = false;
        }

        if (in_array(8, $purchase_plan_ids)) {
            $output['agency_B_show'] = true;
            $output['agency_B_active'] = true;
            $output['agency_B_link'] = 'javascript:;';
            $output['agency_B_recomnded'] = false;
        } else {
            $output['agency_B_show'] = true;
            $output['agency_B_active'] = false;
            $output['agency_B_link'] = $agency_B_link;
            $output['agency_B_recomnded'] = true;
        }

        
        if (in_array(5, $purchase_plan_ids)) {
            $output['lite_show'] = true;
            $output['lite_active'] = true;
            $output['lite_link'] = 'javascript:;';
            $output['lite_recomnded'] = false;
        } else {
            $output['lite_show'] = true;
            $output['lite_active'] = false;
            $output['lite_link'] = $lite_link;
            $output['lite_recomnded'] = false;
        }

        // Reseller

        if (in_array(12, $purchase_plan_ids)) {
            $output['reseller_A_show'] = true;
            $output['reseller_A_active'] = true;
            $output['reseller_A_link'] = 'javascript:;';
            $output['reseller_A_recomnded'] = false;
        } else {
            $output['reseller_A_link'] = true;
            $output['reseller_A_active'] = false;
            $output['reseller_A_link'] = $reseller_A_link;
            $output['reseller_A_recomnded'] = false;
        }

        if (in_array(13, $purchase_plan_ids)) {
            $output['reseller_B_show'] = true;
            $output['reseller_B_active'] = true;
            $output['reseller_B_link'] = 'javascript:;';
            $output['reseller_B_recomnded'] = false;
        } else {
            $output['reseller_B_link'] = true;
            $output['reseller_B_active'] = false;
            $output['reseller_B_link'] = $reseller_B_link;
            $output['reseller_B_recomnded'] = true;
        }

        if (in_array(10, $purchase_plan_ids)) {
            $output['Mega_Bundle_show'] = true;
            $output['Mega_Bundle_active'] = true;
            $output['Mega_Bundle_link'] = 'javascript:;';
            $output['Mega_Bundle_recomnded'] = false;
        } else {
            $output['Mega_Bundle_show'] = true;
            $output['Mega_Bundle_active'] = false;
            $output['Mega_Bundle_link'] = $Mega_Bundle_link;
            $output['Mega_Bundle_recomnded'] = true;
        }
        
        
 
        
        if (in_array(8, $purchase_plan_ids)) {
            $output['Automation_B_show'] = true;
            $output['Automation_B_active'] = true;
            $output['Automation_B_link'] = 'javascript:;';
            $output['Automation_B_recomnded'] = false;
        } else {
            $output['Automation_B_show'] = true;
            $output['Automation_B_active'] = false;
            $output['Automation_B_link'] = $automation_link;
            $output['Automation_B_recomnded'] = true;
        }
        
        if (in_array(5, $purchase_plan_ids)) {
            $output['studio_show'] = true;
            $output['studio_active'] = true;
            $output['studio_link'] = 'javascript:;';
            $output['studio_recomnded'] = false;
        } else {
            $output['studio_show'] = true;
            $output['studio_active'] = false;
            $output['studio_link'] = $studio_link;
            $output['studio_recomnded'] = true;
        }
        
        if (in_array(6, $purchase_plan_ids)) {
            $output['dfy_show'] = true;
            $output['dfy_active'] = true;
            $output['dfy_link'] = 'javascript:;';
            $output['dfy_recomnded'] = false;
        } else {
            $output['dfy_show'] = true;
            $output['dfy_active'] = false;
            $output['dfy_link'] = $dfy_link;
            $output['dfy_recomnded'] = true;
        }
        
        if (in_array(11, $purchase_plan_ids)) {
            $output['Bundle_show'] = true;
            $output['Bundle_active'] = true;
            $output['Bundle_link'] = 'javascript:;';
            $output['Bundle_recomnded'] = false;
        } else {
            $output['Bundle_show'] = true;
            $output['Bundle_active'] = false;
            $output['Bundle_link'] = $Bundle_link;
            $output['Bundle_recomnded'] = true;
        }
        
        if (in_array(9, $purchase_plan_ids)) {
            $output['fastpass_show'] = true;
            $output['fastpass_active'] = true;
            $output['fastpass_link'] = 'javascript:;';
            $output['fastpass_recomnded'] = false;
        } else {
            $output['fastpass_show'] = true;
            $output['fastpass_active'] = false;
            $output['fastpass_link'] = $fastpass_link;
            $output['fastpass_recomnded'] = true;
        }

        $this->loadView('subscription/subscription', $output);
    }

    public function payment() {

        $payment_history = $this->Subscription_Model->getPaymentHistory();
        $output['payment_history'] = $payment_history;


        $this->loadView('subscription/payment', $output);
    }
    
    public function user_credit() {
	    $payment_history = $this->Subscription_Model->getPaymentHistory();
        $output['payment_history'] = $payment_history;
        
		
		$this->loadView('subscription/user_credit', $output);
	}


}
