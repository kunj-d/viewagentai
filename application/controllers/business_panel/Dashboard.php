<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/User_Model');
		$this->load->model($this->config->item('adminFolderName').'/Dashboard_Modal');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('user_agent');
		$this->Common_Modal->checkSagPanelLogin();
		$this->Common_Modal->load(); //load site settings
		
	}
	public function index()
	{
		
      // echo '<pre>'; print_r(json_decode('{"user_id":"30","title":"BigwigVideo Free","package_id":"15","fields":{"campaigns":{"id":"35","field_name":"campaigns","condition_val":"campaigns","app_id":"1","overages":"no","input_type":"text","input_val":"","field_type":"validity","status":"active","value":"1","type_value":"month"}},"features":["view_stats","campaign_type_youtube","template_type_promogate"],"add_time":"1492841827","plan_type":"free","sell_type":"fe","paid_user":"yes"}')); die;
	  $output['user_access'] = $user_access = $this->Common_Modal->checkForPageAccess(6);
	  $output['team_access'] = $team_access = $this->Common_Modal->checkForPageAccess(3);
	  $output['package_access'] = $package_access = $this->Common_Modal->checkForPageAccess(13);
	  $output['order_access'] = $order_access = $this->Common_Modal->checkForPageAccess(18);
	  $output['transaction_access'] = $transaction_access = $this->Common_Modal->checkForPageAccess(19);
	  $output['purchase_access'] = $purchase_access = $this->Common_Modal->checkForPageAccess(20);
	  
	  if($team_access=='yes')
	   {
		  $output['total_team'] = $this->Dashboard_Modal->getAllTeamCount();
	   }
	   
	  if($package_access=='yes')
	   {
		  $output['total_package'] = $this->Dashboard_Modal->getAllPackageCount();
	   }
      
	  if($user_access=='yes')
	   {
		  $output['total_user'] = $this->Dashboard_Modal->getAllUserCount();
		  $output['user_active'] = $this->Dashboard_Modal->getAllUserCount('active');
		  $output['user_inactive'] = $this->Dashboard_Modal->getAllUserCount('inactive');
		  $output['user_week'] = $this->Dashboard_Modal->getUserCountThisWeek();
		  $output['user_month'] = $this->Dashboard_Modal->getUserCountThisMonth();
	   }
	  if($order_access=='yes')
	   {
		  $output['total_order'] = $this->Dashboard_Modal->getAllOrderCount();
		  $output['order_new'] = $this->Dashboard_Modal->getAllOrderCount('new');
		  $output['order_process'] = $this->Dashboard_Modal->getAllOrderCount('process');
		  $output['order_complete'] = $this->Dashboard_Modal->getAllOrderCount('complete');
		  $output['order_pending'] = $this->Dashboard_Modal->getAllOrderCount('pending');
		  $output['order_week'] = $this->Dashboard_Modal->getOrderCountThisWeek();
		  $output['order_month'] = $this->Dashboard_Modal->getOrderCountThisMonth();
	  }
	  if($transaction_access=='yes')
	   {
		  $output['total_trans'] = $this->Dashboard_Modal->getAllTransCount();
		  $output['total_cgbk'] = $this->Dashboard_Modal->getAllTransCountByType('CGBK');
		  $output['total_refund'] = $this->Dashboard_Modal->getAllTransCountByType('RFND');
		  $output['total_sale'] = $this->Dashboard_Modal->getAllTransCountByType('SALE');
		  $output['trans_jvz'] = $this->Dashboard_Modal->getAllTransCount('jvz');
		  $output['trans_bms'] = $this->Dashboard_Modal->getAllTransCount('BMS');
		 // $output['trans_cc'] = $this->Dashboard_Modal->getAllTransCount('cc');
		  $output['trans_week'] = $this->Dashboard_Modal->getTransCountThisWeek();
		  $output['trans_month'] = $this->Dashboard_Modal->getTransCountThisMonth();
	   }
	  if($purchase_access=='yes')
	   {
		  $output['total_purchase'] = $this->Dashboard_Modal->getAllPurchaseCount();
		  $output['purchase_active'] = $this->Dashboard_Modal->getAllPurchaseCount('active');
		  $output['purchase_inactive'] = $this->Dashboard_Modal->getAllPurchaseCount('inactive');
		  $output['purchase_week'] = $this->Dashboard_Modal->getPurchaseCountThisWeek();
		  $output['purchase_month'] = $this->Dashboard_Modal->getPurchaseCountThisMonth();
	   }
	  
	  $this->load->view($this->config->item('adminFolderName').'/header',$output);
	  $this->load->view($this->config->item('adminFolderName').'/dashboard');
	  $this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function error404()
	{

	  $this->load->view($this->config->item('adminFolderName').'/error404');
	}
	public function accessDenied()
	{

	  $this->load->view($this->config->item('adminFolderName').'/access_denied');
	}
	

}