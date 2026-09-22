<?php
class Template_manager_Model extends CI_Model
{
	
	var $tablename = 'templates';	
	var $tablePlanTemplates = 'plan_templates';	
	//var $tableEmailtypes = 'tbl_email_types';	
	
	function getAllCount($status,$keyword){

		if($status)
			$this->db->where('status',$status);
		if($keyword){
			$this->db->group_start();
			$this->db->like('title',$keyword);
			$this->db->or_like('type',$keyword);
			$this->db->or_like('slug',$keyword);
			$this->db->group_end();
		}
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	}
	
	function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword){
			$this->db->group_start();
		   $this->db->like('title',$keyword);
		   $this->db->or_like('type',$keyword);
		   $this->db->or_like('slug',$keyword);
		   $this->db->group_end();
		}
		$this->db->order_by('title','asc');
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	}
	
	function getTemplateDetail($id){
	 	$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	}
	 
    function addTemplate(){	    
	  //  $slug = $this->Common_Model->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
	  /* for adding slash in slug*/
	    $slug = $this->create_slug_for_template($this->input->post('slug'),$this->tablename);
		$this->db->set('title',$this->input->post('title'));
	    $this->db->set('slug',$slug);
	    $this->db->set('type',$this->input->post('type'));
		$this->db->set('status','inactive');
		$this->db->set('modified',time('Y-m-d H:i:s'));
		$this->db->set('created',time('Y-m-d H:i:s'));
		$this->db->insert($this->tablename);
		return $this->db->insert_id();
	}
	
    function updateTemplate($id){
			
		$old_slug = $this->getTemplateDetail($id)->slug;
		if($old_slug==$this->input->post('slug'))
		$slug = $this->input->post('slug');
		else 
		//$slug = $this->Common_Modal->create_unique_slug_for_common($this->input->post('slug'),$this->tablename);
			$slug = $this->create_slug_for_template($this->input->post('slug'),$this->tablename);
		if($this->input->post('title'))
			$this->db->set('title',$this->input->post('title'));
		if($this->input->post('slug'))
			$this->db->set('slug',$slug);
	/* 	if($this->input->post('position'))
			$this->db->set('position',$this->input->post('position'));
		if($this->input->post('industry'))
			$this->db->set('industry',$this->input->post('industry')); */
		if($this->input->post('type'))
			$this->db->set('type',$this->input->post('type'));
			$this->db->set('modified',time('Y-m-d H:i:s'));
			$this->db->where('id',$id);
			$this->db->update($this->tablename);
	}
	
	function deleteRecord($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->tablename);
	}
	
	function set_status($task,$id){
	    $this->db->set('status',$task);
	    $this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	
	function create_slug_for_template($app_title,$table){
		$slug = $app_title;
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

	
	function packagePlanList(){
		$this->db->select('id,title,price,sell_type');
		$query = $this->db->get('tbl_package_plans');
		return $query->result();	
	}
	
	function getTemplatePlan(){
		$this->db->select('tbl_package_plans.*,plan_templates.template_id');
		$this->db->from('tbl_package_plans');
		$this->db->join('plan_templates', 'tbl_package_plans.id = plan_templates.plan_id', 'left'); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();	
	}
	
	function savedPackagePlanList($template_id){
		$this->db->where('template_id',$template_id);
		$query = $this->db->get($this->tablePlanTemplates);			
		$result=$query->result();
		$savePlanId=array();
		foreach($result as $res){
			$savePlanId[]=$res->plan_id;
		}
		return $savePlanId;
	}
	
	function addPlanTemplate($template_id){
		$package_plan = $this->input->post('package_plan');
		if(!empty($package_plan)){
			foreach($package_plan as $key=>$plan){
				if(!empty($this->input->post('package_plan')))
				{
					$plan_id=$this->input->post('package_plan')[$key];
					$this->db->set('plan_id',$plan_id);
					$this->db->set('template_id',$template_id);
					$this->db->insert($this->tablePlanTemplates);
				}
			}
		}
	}
	
	function deleteAddedTemplate($template_id){
		$this->db->where('template_id',$template_id);;
		$this->db->delete($this->tablePlanTemplates);
	}
	
	function getTemplateCategory($table_name){
		$query = $this->db->get($table_name);
		return $query->result();
	}
	
	function modifyTemplate($id,$html_file,$thumbnail){
		$this->db->set('filename',$html_file);
		$this->db->set('thumbnail',$thumbnail);
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	
}
