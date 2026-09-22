<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_model 
{
	public function __construct()
	{
		parent::__construct();
		$this->tableUsers = 'tbl_user';
	}

    /* Fetch user data by email	 */
	public function getUserByEmail($email){
		$query = $this->db->get_where($this->tableUsers, array('email' => $email));
		if ($query) {
			return $query->row();
		}
		return false;
	}
	
	
		public function insertRecord()
	{
		$this->db->set('name', $this->input->post("name"));
		$this->db->set('email', $this->input->post("email"));
		$this->db->set('password', md5($this->input->post("password")));
		$this->db->set('reset_key', md5(md5($this->input->post("password"))));
		$this->db->set('varification_code', md5(md5($this->input->post("password"))));
		$this->db->set('role', 'admin');
		$this->db->set('add_time', time());
		$this->db->set('status',"active");
		$this->db->set('created', time());
		$this->db->set('modified', time());
		$this->db->insert($this->tableUsers);
		return $this->db->insert_id();
	}
	
	public function get_businesses_data() {
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
    
    public function addRecord($data) {
        //echo "<pre>model "; print_r($data); die;
        $this->db->insert('business', $data);
        return $this->db->insert_id();
    }

    public function defaultBusinessCreate(){
      
      $this->db->distinct();
      $this->db->select('domain');  
      $this->db->like('domain','myworkspace','after');
      $this->db->order_by('id', 'desc');
      $data = $this->db->get('business');
      
       if ($data->num_rows() > 0) {
            $data = $data->result_array();
            $oldTitle = str_replace('myworkspace', '', $data[0]['domain']);
            $business_name = 'myworkspace' . ($oldTitle + 1);
        } else {
            $business_name = 'myworkspace1';
        }
        $ipn_secret_key = $this->Common_Model->generateRandomString(16);
        $business_data = array(
            'domain' => $business_name,
            'title' => 'Default Business',
             'address' => '',
            'city' => '',
            'country' => '',
            'user_id' => $this->session->userdata('logged_in')['id'],
            'ipn_secret_key' => $ipn_secret_key,
            'notification_email' => $this->session->userdata('logged_in')['email'],
            'created' => time(),
            'modified' => time(),
        );
        
        
        // pr($business_data);
        // die;
        $business_id = $this->addRecord($business_data);
        $this->createVaForBusiness($business_id);
        $this->db->where('id',$this->session->userdata('logged_in')['id']);
        $this->db->update('tbl_user',['last_business_id'=>$business_id]);
        $this->Common_Model->set_user_logs('Create Default Business', $business_name);
        
        
        return true;
    }

    public function createVaForBusiness($business_id){
        
        $this->db->insert('prompt_category',['category_name'=>'Super VA','custom'=>$business_id]);
        $last_id = $this->db->insert_id();
        $prompt = "Hello! I am your Super AI assistant. How can I assist you today? . I am here to help you chat. What can I help you with today?";
        $path = ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? 'default/images/default_profile.png':  $this->session->userdata('logged_in')['profile_pic'];
        $superVaArray = array(
                "business_id" => $business_id,
                "user_id" => $business_id,
                "text" => 'Super Virtual Assistant',
                "niche" => $last_id,
                "language_id" => 'en',
                "purpose" => 'super_va',
                "color" => '#212529',
                "assistant_image" => $path,
                'app'   =>  '',
                'status'   =>  'yes',
                'prompt'   =>  $prompt,
                'appoint_status'   =>  1,
                'assistant_status'   =>  'super_va',
            );
        $this->db->insert('prompts', $superVaArray);
	    $this->db->where('custom',0);
        $prompt_category = $this->db->get('prompt_category')->result_array();
        foreach($prompt_category as $key => $value)
        {
    	    $prompt = "Hello! I am your " .$value['category_name']. " AI assistant. How can I assist you today? . I am here to help you chat. What can I help you with today?";
            $path = ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? 'default/images/default_profile.png':  $this->session->userdata('logged_in')['profile_pic'];
    	    $insert_data = array(
                "business_id" => $business_id,
                "user_id" => $business_id,
                "niche" => $value['id'],
                "language_id" => 'en',
                "purpose" => 'chat',
                "color" => '#212529',
                "assistant_image" => $path,
                'app'   =>  '',
                'status'   =>  'yes',
                'prompt'   =>  $prompt,
                'appoint_status'   =>  1,
                'assistant_status'   =>  'default',
            );
            $this->db->insert('prompts', $insert_data);
            $last_id = $this->db->insert_id();
            $base_url=  $this->config->item('assetsBasePath');
            $src_url = $base_url."chat/chat.js";
            $generate ="<script src=$base_url"."chat/chat.js id=$last_id user_id=$business_id > </script>"."\n";
            $updateArray = array(
                'script_tag' => $generate,
            );
            $this->db->where('id',$last_id);
            $this->db->update('prompts',$updateArray);
        }
        return true;
	}





}
?>