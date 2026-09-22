<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
 
	function __construct()
	{ 
	    parent::__construct();	
		$this->load->model($this->config->item('adminFolderName').'/SiteSettings');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->Common_Modal->load(); //load site settings 
		
	}
	public function add()
	{ 
		$output['page_title'] = 'Add New Setting';
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/settings/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function addoptionaction($id = 0)
	{
		 
		if($_POST)
		{
			$key = $_POST['title'];
			$value = $_POST['value'];
			if($key=='')
			$output['error']['title'] = "Title is required";
			 
			$type = $_POST['type'];
			if($type=='')
			$output['error']['type'] = "Type is required";
			
			if(!$output['error']['title'] && !$output['error']['type'])
			{
				if($type != 'textbox' && $type != 'textarea')
				{
					$options = $_POST['OptionName'];
					$radioinput = $_POST['radio_input'];
					$default = $options[$radioinput];
					$placeholder ='';
				}
				else
				{
					$options = 0; 
					$radioinput = 0; 
					$default = '';
					$placeholder = $_POST['placeholder'];
				}
				$help = $_POST['help']; 
				$editable = $_POST['editable']; 
				
				
				$this->db->set('title',$key);
				$this->db->set('value',$value); 
				$this->db->set('options',json_encode($options));
				$this->db->set('default_option',$default);
				$this->db->set('help_text',$help);
				$this->db->set('editable',$editable);
				$this->db->set('placeholder',$placeholder);
				$this->db->set('type',$type);
				$this->db->set('status','1');
				$this->db->set('created',time());
				
				if($id==0)
				{
					 $this->db->insert('settings'); 
					 $this->session->set_userdata('success_msg','Created Successfully');
					 $arr = array('status'=>TRUE,'msg'=>'Added Successfully','url'=>$this->config->item('spanel_url').'/settings/all');
				}
				else{
				
					$this->db->where('id',$id); 
					$this->db->update('settings'); 
					$this->session->set_userdata('success_msg','Updated Successfully');
					$arr = array('status'=>TRUE,'msg'=>'Added Successfully','url'=>$this->config->item('spanel_url').'/settings/all');
				}
			
			}
			else{
				$arr = array('status'=>FALSE,'msg'=>$output['error'],'url'=>'');
			}
			//echo $this->db->last_query();
			echo json_encode($arr);
			 
		}		
	}
	public function index($prefix = 'Site')
	{
		$output['prefix'] = $prefix;
		$output['page_title'] = $prefix.' Settings';
		if($_POST){
		 	if($_FILES['values_image']['name']!='')
			{
			
				 

				    $count = count($_FILES['values_image']['size']);
					/*Upload Multiple File*/
					 foreach($_FILES as $key=>$value)
					  { 
					  
						 for($s=0; $s<=$count-1; $s++)
						 {
						 
							 $_FILES['userfile']['name']=$value['name'][$s];
							 $_FILES['userfile']['type']    = $value['type'][$s];
							 $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s]; 
							 $_FILES['userfile']['error']       = $value['error'][$s];
							 $_FILES['userfile']['size']    = $value['size'][$s]; 
							 
							 $config['upload_path'] = './assets/settings/';
				  			 $config['allowed_types'] = 'gif|jpg|png|jpeg';
							 $this->load->library('upload', $config);
					 
							 if(!$this->upload->do_upload('userfile'))
							   {	
								  $output['img_error'] = $img_error = $this->upload->display_errors();	
								  $upload_img[] = '';
								} else {
								  $data = array('upload_data' => $this->upload->data());	
									$upload_img[] =$data['upload_data']['file_name'];									  
							   }
							  
						 }
						 
					  }
						$this->SiteSettings->addSettingsFile($upload_img); //update filename in database
					/*Upload Multiple File*/
			}	
			 $this->SiteSettings->updateSettings();
			}
		
		$output['data'] = $this->SiteSettings->fetch_settings($prefix); //fetch all Settings data by prefix
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/settings/site-form'); //view page
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function all()
	{
		$this->load->library('pagination');
		$output['keyword'] = $keyword = $this->input->get('keyword');
		$config['base_url'] = base_url($this->config->item('adminName').'/settings/all/?keyword='.$keyword);
		$config['per_page'] = (int)$this->config->item("Reading_records_per_page"); //from site settings
		$config['total_rows'] = $this->SiteSettings->getAllCount('',$keyword);
		
		$config['page_query_string'] = TRUE;
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
	    $output['paging']=$this->pagination->create_links();
		
		$output['list'] = $this->SiteSettings->getRecordList($keyword,$config['per_page'],$currentpage);
		
		$output['active'] = $this->SiteSettings->getAllCount('1',$keyword);
		$output['inactive'] = $this->SiteSettings->getAllCount('0',$keyword);
		$output['total'] = $this->SiteSettings->getAllCount('',$keyword);
		$output['site_settings'] = $this->SiteSettings->fetch_data();
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/settings/list',$output);
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	public function edit($id=0)
	{
			
		$output['site_settings'] = $this->SiteSettings->fetch_single_data($id);
		$output['title'] = $output['site_settings']->title;
		$output['value'] = $output['site_settings']->value;
		$output['type'] = $output['site_settings']->type;
		$output['default_option'] = $output['site_settings']->default_option;
		$output['options'] = json_decode($output['site_settings']->options);
		$output['help'] = json_decode($output['site_settings']->help_text);
		$output['editable'] = $output['site_settings']->editable;	
		$output['placeholder'] = $output['site_settings']->placeholder;
		$output['id'] = $id; 
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/settings/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}	
	public function changeStatus($task,$id)
	{
	 
	   $this->SiteSettings->set_status($task,$id);
	   $this->session->set_userdata('success_msg','SiteSettings Status changed Successfully');
	   redirect($this->config->item('adminName').'/settings/all');
	   
	
	}
	public function delete($id)
	{
		$this->SiteSettings->deleteRecord($id);
		$this->session->set_userdata('success_msg','Setting Deleted Successfully');
	    redirect($this->config->item('adminName').'/settings/all');
	}
	function getAllCount($status,$keyword){
	 	
		if($status)
		$this->db->where('status',$status);
		if($keyword)
		 {
		   $this->db->like('title',$keyword);
		   $this->db->or_like('slug',$keyword);
		 }
		$query = $this->db->get('settings');
		return $query->num_rows();
	 }


	
	function editable($task,$id)
	{ 
		   $this->SiteSettings->set_editable($task,$id);
		   $this->session->set_userdata('success_msg','Editable changed Successfully');
		   redirect($this->config->item('adminName').'/settings/all');
	}	
}

 