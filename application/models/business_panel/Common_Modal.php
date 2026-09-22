<?php
class Common_Modal extends CI_Model{
	function __construct(){ 
        //$ci->config->set_item('facebook_url',$row->facebook_url); 
		
		if($this->session->userdata('SAG_mem_id')!='')
		  {
		  	global $URI, $CFG, $IN;
       	 	$ci = get_instance(); 
       	 	$ci->load->config('config');
			$this->db->where('parent_id','0');
			$this->db->where('status','Active');
			$this->db->order_by('display_order','ASC');
			$query = $this->db->get('tbl_sag_manager');
			$managers	=	$query->result();

			for($i=0;isset($managers[$i]);$i++)
				$managers[$i]->submanagers	=	$this->getSubmanagers($managers[$i]->mng_id);
				$ci->config->set_item('memberManagers',$managers);
		  } 
 	
	}
	protected function getSubmanagers($id){
		$this->db->where('parent_id',$id);
		$this->db->where('status','active');
		$this->db->order_by('display_order','ASC');
		$query = $this->db->get('tbl_sag_manager');
		$managers	=	$query->result();
		return $managers;
	 } 
	#=============Function Create Unique Slug===========================================================#
	public function create_unique_slug_for_common($app_title,$table){
			$slug = url_title($app_title);
			$slug = strtolower($slug);
			$i = 0;
			$params = array ();
			$params['slug'] = $slug;
			while ($this->db->where($params)->get($table)->num_rows()) 
				{
					if (!preg_match ('/-{1}[0-9]+$/', $slug )) 
						{
							$slug .= '-' . ++$i;
						}
				    else 
						{
							$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
						}
					$params ['slug'] = $slug;
				}
				$app_title=$slug;
				return $app_title;
	}

	// This will be called to check login details
	public function checkSagPanelLogin(){
		if($this->session->userdata('SAG_mem_id')=='')
		 {
		   redirect($this->config->item('adminName').'/login');
		 }
	}
	public function getSingleFieldFromAnyTable($fieldname,$conditionfield,$conditionval,$tablename){
		$this->db->select($fieldname);
		$this->db->where($conditionfield,$conditionval);
		$query = $this->db->get($tablename);
		return $query->row()->$fieldname;
	}
	public function getSelectedRowsAndFieldsFromAnyTable($fieldnames,$tablename,$condition=false){
		$this->db->select($fieldnames);
		if($condition)
		$this->db->where($condition);
		$query = $this->db->get($tablename);
		return $query->result_array();
	}
	public function getSingleRowFromAnyTable($conditionColoum, $conditionValue, $tableName) 
	{
        $this->db->select('*');
        $this->db->where($conditionColoum, $conditionValue);
        $query = $this->db->get($tableName);
        $data = $query->row();
        return $data;
    }
	public function insertRowInAnyTable($data,$tablename){
		$this->db->set($data);
		$this->db->insert($tablename);
		return $this->db->insert_id();
	}
	public function deleteRowsFromAnyTable($tablename,$condition=false){
		if($condition)
		$this->db->where($condition);
		$this->db->delete($tablename);
	}

	
    public function checkForPageAccess($mng_id,$permission=false,$redirect=false){
	   $SAG_mem_id = $this->session->userdata('SAG_mem_id');

	   $this->db->select('privileges,permission');
	   $this->db->where('id',$SAG_mem_id);
	   $this->db->where('status','active');
	   $query = $this->db->get('tbl_sag_user');
	   $result = $query->row();
	   
	   
	   $privileges = explode(',',$result->privileges);
	   if(in_array($mng_id,$privileges))
	    {
		  $access = 'yes';
		}
	   else
	    { $access = 'no'; }
	   if($permission)
	    {
		  $pr = unserialize($result->permission);
		  if(in_array($permission,$pr[$mng_id]))
		   {
		     $access = 'yes';
		   } else { $access = 'no'; }

		}
		if($redirect=='redirect' && $access=='no')
		 { redirect($this->config->item('adminName').'/access-denied'); }
		return $access;
	   

	 }
	
	 //fetch all categories in members area(created by trilok)
	public function getAllBonuses(){
		$this->db->select("tbl_bonus_categories.title,tbl_bonus_categories.slug");
		$this->db->where('tbl_bonus_categories.status','active');
		$query = $this->db->get('tbl_bonus_categories');
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}
	 //fetch all categories in members area(created by trilok)
	public function getAllFaqs(){
		$this->db->select("tbl_faq_categories.title,tbl_faq_categories.slug");
		$this->db->where('tbl_faq_categories.status','active');
		$query = $this->db->get('tbl_faq_categories');
		if($query->num_rows()>0)
		return $query->result();
		return 0;
	}
	
	
	public function load()
	{
		$qryForFetchAllConfiguration = $this->db->query("SELECT `title`,`value`,`options` FROM `settings` WHERE `status` = '1'");
		$resForFetchAllConfiguration = $qryForFetchAllConfiguration->result(); 
		foreach($resForFetchAllConfiguration as $key => $value)
		{
			$constantName = str_replace('.','_',$value->title);
			$constantValue = $value->value;
			$this->config->set_item($constantName,$constantValue);
		}
			
	} 
	function replaceEmailTags($content,$replaceArray)
	{
	   $tagArray = array('{#name#}','{#email#}','{#login_url#}','{#password#}','{#plan_name#}','{#forgot_password_link#}', '{#email_verification_link#}');
	   foreach($tagArray as $tag)
	    {
		   $tagname = str_replace('#}','',str_replace('{#','',$tag));
		   $content=str_replace($tag,$replaceArray[$tagname],$content);
		}
		$template_data = file_get_contents('./assets/email_template/index.html');
		$template_data = str_replace('{#Email_Content#}',$content,$template_data);
		return $template_data;
	}
	public function updateAnyTable($table_name,$where,$update) {
		$this->db->set($update);
		$this->db->where($where);
		$this->db->update($table_name);
	}
	function generateRandomString($length = 10)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	
	
}