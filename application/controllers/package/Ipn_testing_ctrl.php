<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipn_testing_ctrl extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct();
		$this->load->model('package/Order_Model');
		$this->load->model('package/Mailsending_Model');   
	}
	public function jvzooIpn(){
		$_POST['caffitid'] = 15080745;
		$_POST['ccustcc'] = 'IN';
		$_POST['ccustemail'] = 'gsrgajju786@gmail.com';
		$_POST['ccustname'] = 'Gajendra';
		$_POST['ccuststate'] = 'Rajasthan';
		$_POST['cproditem'] = '308439';
		$_POST['cprodtitle'] = 'its title';
		$_POST['cprodtype'] = 'STANDARD';
		$_POST['ctransaction'] = 'SALE';
		$_POST['ctransaffiliate'] = 0;
		$_POST['ctransamount'] = '25';
		$_POST['ctranspaymentmethod'] = 'PYPL';
		$_POST['ctransreceipt'] = '0HR17845E1241423B';
		$_POST['ctranstime'] = 1461676591;
		$_POST['ctransvendor'] = 54605;
		$_POST['cupsellreceipt'] = '';
        $_POST['cvendthru'] = ''; 
		$_POST['cverify'] = 'BEC3B70B';  
		$output = $this->jvz_tokenVerification($_POST);
		// print_r($output);
		// die;
		$url = site_url('mimu-jvz-ipn');
		echo $userProfile = $this->sendCurlRequest($url,$output);
		die;
	}
	public function wp_Ipn(){
		$_POST['WP_ITEM_NAME'] = 'its title';
		$_POST['WP_ITEM_NUMBER'] = 'AAZMP10';
		$_POST['WP_BUYER_NAME'] = 'Gajendra';
		$_POST['WP_BUYER_EMAIL'] = 'gsrgajju786@gmail.com';
		$_POST['WP_SALE_AMOUNT'] = '25';
		$_POST['WP_SALE_CURRENCY'] = 'USD';
		$_POST['WP_TXNID'] = 'AAZMP10';
		$_POST['WP_SALEID'] = 'AAZMP10';
		$_POST['WP_AFFID'] = 'AAZMP10';
		$_POST['WP_PAYMETHOD'] = 'paypal';
		$_POST['WP_ACTION'] = 'sale';
		$_POST['WP_SECURITYKEY'] = config_item('warriorplus_secret_key');

		//$output = $this->tokenVerification($_POST);
		$output = $_POST;
		
		$url = site_url('mimu-wp-ipn');
		echo $userProfile = $this->sendCurlRequest($url,$output);
		die;
	}
	function jvz_tokenVerification($data) {
		$secretKey="AKVEGI19ETZFSU25";
		$pop = "";
		$ipnFields = array();
		foreach ($data as $key => $value) {
			if ($key == "cverify") {
				continue;
			}
			$ipnFields[] = $key;
		}
		sort($ipnFields);
		foreach ($ipnFields as $field) {
			// if Magic Quotes are enabled $_POST[$field] will need to be
			// un-escaped before being appended to $pop
			$pop = $pop . $data[$field] . "|";
		}
		$pop = $pop . $secretKey;
		$calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
		$calcedVerify = strtoupper(substr($calcedVerify,0,8));
		 $data["cverify"] =  $calcedVerify ;
		 return $data;
	}
	function sendCurlRequest($request_url,$data=false){
		$handle = curl_init($request_url);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		curl_exec($handle);
		curl_close($handle);
	}	
	
}

