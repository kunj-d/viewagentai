<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_purchase extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Package_purchase_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
				$this->load->library('pagination');
	}
	public function index()
	{
		$output['manager_id'] = $manager_id = 20;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');

		$output['start_date'] = $start_date = $this->input->post('start_date');
		$output['end_date'] = $end_date = $this->input->post('end_date');
		
		
		   
        $output['keyword'] = $keyword = $this->input->post('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/purchased-package/?keyword='.$keyword.'&start_date='.$start_date.'&end_date='.$end_date);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Package_purchase_Model->getAllPurchaseCount('',$start_date,$end_date,$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
            
        
		$list = $this->Package_purchase_Model->getPurchaseList($start_date,$end_date,$config['per_page'],$currentpage,$keyword);
		$output['list'] = $list;
		
		$output['active'] = $this->Package_purchase_Model->getAllCount('active',$start_date,$end_date,$keyword);
		$output['inactive'] = $this->Package_purchase_Model->getAllCount('inactive',$start_date,$end_date,$keyword);
		$output['total'] = $this->Package_purchase_Model->getAllCount('',$start_date,$end_date,$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package_purchase/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	function changeStatus($task,$id) {
	
	   $output['manager_id'] = $manager_id = 20;
	   $this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');

	   $this->Package_purchase_Model->set_status($task,$id);
	   $this->session->set_userdata('success_msg','Package Status changed Successfully');
	   redirect($this->config->item('adminName').'/purchased-package');
	}
}