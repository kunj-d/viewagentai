<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_order extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Package_order_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
	}
	public function index()
	{
		$output['manager_id'] = $manager_id = 18;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');

		$output['start_date'] = $start_date = $this->input->post('start_date');
		$output['end_date'] = $end_date = $this->input->post('end_date');
        
        
        
        
        
        $output['keyword'] = $keyword = $this->input->post('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/package-orders/?keyword='.$keyword.'&start_date='.$start_date.'&end_date='.$end_date);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Package_order_Model->getAllOrdersCount('',$start_date,$end_date,$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
        
		$list = $this->Package_order_Model->getOrderList($start_date,$end_date,$config['per_page'],$currentpage,$keyword);
	
        $output['list'] = $list;
		
		$output['complete'] = $this->Package_order_Model->getAllCount('complete',$start_date,$end_date,$keyword);
		$output['pending'] = $this->Package_order_Model->getAllCount('pending',$start_date,$end_date,$keyword);
		$output['process'] = $this->Package_order_Model->getAllCount('process',$start_date,$end_date,$keyword);
		$output['total'] = $this->Package_order_Model->getAllCount('',$start_date,$end_date,$keyword);
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package_order/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
}