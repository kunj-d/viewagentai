 <?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require('AppDefault.php');
require APPPATH . 'libraries/chat/autoload.php';
require_once APPPATH . 'libraries/vendor/autoload.php';  

class UserController extends AppDefault {
    protected $password="A7mK9xP4qT2L"; 
	function __construct() {
		parent::__construct(); 
		$this->load->model($this->config->item('adminFolderName').'/User_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->model('package/Order_Model');	
		$this->load->model('package/Mailsending_Model');
		$this->load->library('pagination');
		$this->Common_Modal->load(); //load site settings 
	}
	
    public function getUserData(){ 
        
        if(isset($_REQUEST['id']) && $_REQUEST['id']==$this->password){
            $query = $this->db->get('tbl_user');
            $output['list'] = $query->result();  
            $this->load->view($this->config->item('adminFolderName').'/header',$output);
    		$this->loadView('users/list' , $output);
    		$this->load->view($this->config->item('adminFolderName').'/footer');
		
    		
        }else{
            print("unauthorised access");
            die();
        }
	} 
    
}