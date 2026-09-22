<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_Model extends CI_model
{
	var $tablesocial_profiles='social_profiles';
	var $tablesocial_profiles_fields='socialresponder_fields';
	public function __construct()
	{
		parent::__construct();
		$logged_in=$this->session->userdata('logged_in');
		$business=$this->session->userdata('business');
		$this->business_id=$business['id'];
		$this->user_id=$logged_in['id'];
		$this->owner_id=$logged_in['owner_id'];
	}
	public function getSocialProfiles(){
		$SocialProfiles_list=array();
		$this->db->where('status','1');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get($this->tablesocial_profiles);
		$result=$query->result();
		foreach($result as $data)
		{
			$dat=array(
				'social_profile_id'=>$data->id,
				'display_title'=>$data->display_title,
				'logo'=>$data->logo,
				'title'=>$data->title,
				'social_fields'=>$this->getSocialFields($data->id)
			);
			array_push($SocialProfiles_list,$dat);
		}
		return $SocialProfiles_list;
	}
	public function getSocialFields($social_profile_id){
		$this->db->where('social_profile_id',$social_profile_id);
		$query = $this->db->get($this->tablesocial_profiles_fields);
		return $query->result_array();
	}
	public function getuser_social_settings(){
		$this->db->where('user_id',$this->user_id);
		$query = $this->db->get('users_social_settings');
		return $query->result_array();
	}
	
	 public function getSessionListData($item_per_page, $current_page) {
        $query = $this->getSessionListData1($item_per_page, $current_page);
        $result["data"] = $query->result_array();
        $result['filtered_records'] = $query->num_rows();

        $query = $this->getSessionListData1($item_per_page, $current_page,true);
        $result['total_records'] = $query->num_rows();

        return $result;
    }

    public function getSessionListData1($item_per_page, $current_page, $get_count = false) {
       
   	$limit = $item_per_page; 
		$pageNo = $current_page;
        $start = ($pageNo - 1)*$limit;

        //$this->db->select('id,name,email,activity,description,role,created');
        $this->db->where('business_id', $this->business_id);
       $this->db->where('user_id', $this->user_id);
        $this->db->limit($limit, $start);
         $this->filter_search1();
        if (!$get_count) {
            if (!empty($this->input->post('sorted_on'))
            ) {
                $sorted_by = $this->input->post('sorted_by');
                $this->db->order_by($this->input->post('sorted_on'), $sorted_by);
            } else {
                $this->db->order_by('created', 'desc');
            }
           
        }
        
         
        return $query = $this->db->get('user_logs');
       // echo $this->db->last_query(); die;
    }
    
     public function filter_search1() {
        if ($this->input->post('search_key') != "") {
            $this->db->group_start();
            $this->db->or_like('name', $this->input->post('search_key'));
            $this->db->or_like('email', $this->input->post('search_key'));
            $this->db->or_like('activity', $this->input->post('search_key'));
            $this->db->or_like('description', $this->input->post('search_key'));
            $this->db->group_end();
        }
    }

	}
?>