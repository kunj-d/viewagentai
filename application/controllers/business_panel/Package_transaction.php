<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_transaction extends CI_Controller {

	function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Package_transaction_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		
	}
	public function index()
	{
		$output['manager_id'] = $manager_id = 19;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');

		$output['start_date'] = $start_date = $this->input->post('start_date');
		$output['end_date'] = $end_date = $this->input->post('end_date');
		$output['keyword'] = $keyword = $this->input->post('keyword');
		
       
        
		$config['base_url'] = base_url($this->config->item('adminName').'/package-transactions/?keyword='.$keyword.'&start_date='.$start_date.'&end_date='.$end_date);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Package_transaction_Model->getAllTransactionCount('',$start_date,$end_date,$keyword);
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$list = $this->Package_transaction_Model->getTransactionList($start_date,$end_date,$config['per_page'],$currentpage,$keyword);
		$output['list'] = $list;
		 
		$output['BMS'] = $this->Package_transaction_Model->getAllCount('BMS',$start_date,$end_date,$keyword);
		$output['refund'] = $this->Package_transaction_Model->getRefundCount('RFND',$start_date,$end_date,$keyword);
		$output['sale'] = $this->Package_transaction_Model->getRefundCount('SALE',$start_date,$end_date,$keyword);
		//$output['cc'] = $this->Package_transaction_Model->getAllCount('cc',$start_date,$end_date);
		$output['wp'] = $this->Package_transaction_Model->getAllCount('wp',$start_date,$end_date,$keyword);
		$output['cb'] = $this->Package_transaction_Model->getAllCount('cb',$start_date,$end_date,$keyword);
		$output['jvz'] = $this->Package_transaction_Model->getAllCount('jvz',$start_date,$end_date,$keyword);
		$output['jvs'] = $this->Package_transaction_Model->getAllCount('jvshare',$start_date,$end_date,$keyword);
		$output['CGBK'] = $this->Package_transaction_Model->getRefundCount('CGBK',$start_date,$end_date,$keyword);
		//echo "<pre>";print_r($output);die;
		//$output['total'] = $this->Package_transaction_Model->getAllCount('',$start_date,$end_date);

		// print_r($output);
		// die;
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/package_transaction/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
}