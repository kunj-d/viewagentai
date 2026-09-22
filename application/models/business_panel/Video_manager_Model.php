<?php
class Video_manager_Model extends CI_Model
{
	
	var $tablename= 'vidoe_default_templates';	
	var $productTable = 'default_products';	
	var $tablePlanBlogs = 'tbl_blogs_plan';	
	
	public function insert_template($data)
    {
        return $this->db->insert('vidoe_default_templates', $data);
    }
	function savedPackagePlanList($default_blog_id){
		$this->db->where('default_blog_id',$default_blog_id);
		$query = $this->db->get($this->tablePlanBlogs);			
		$result=$query->result();
		$savePlanId=array();
		foreach($result as $res){
			$savePlanId[]=$res->plan_id;
		}
		return $savePlanId;
	}
	function addPlanProduct($default_blog_id){
		$package_plan = $this->input->post('package_plan');
		if(!empty($package_plan)){
			foreach($package_plan as $key=>$plan){
				if(!empty($this->input->post('package_plan')))
				{
					$plan_id=$this->input->post('package_plan')[$key];
					$this->db->set('plan_id',$plan_id);
					$this->db->set('default_blog_id',$default_blog_id);
					$this->db->set('created',time());
					$this->db->insert($this->tablePlanBlogs);
				}
			}
		}
	}
	
	function deleteAddedPlanProduct($default_blog_id){
		$this->db->where('default_blog_id',$default_blog_id);;
		$this->db->delete($this->tablePlanBlogs);
	}
	function getAllCount($status,$keyword){

		// if($status)
		// 	$this->db->where('status',$status);
		if($keyword){
			$this->db->group_start();
			$this->db->like('thumbnail_url',$keyword);
			//$this->db->or_like('type',$keyword);
			//$this->db->or_like('slug',$keyword);
			$this->db->group_end();
		}
		if($this->input->get('product_id') && !empty($this->input->get('product_id')) && $this->input->get('product_id')!='all'){
			$this->db->where('product_id',$this->input->get('product_id'));
		}
		$query = $this->db->get($this->tablename);
		return $query->num_rows();
	}
	
	function getRecordList($keyword,$per_page,$currentpage){
	 	
		if($keyword){
			$this->db->group_start();
		   $this->db->like('thumbnail_url',$keyword);
		   
		   $this->db->group_end();
		}
		if($this->input->get('product_id') && !empty($this->input->get('product_id')) && $this->input->get('product_id')!='all'){
			$this->db->where('product_id',$this->input->get('product_id'));
		}
		$this->db->order_by('id','DESC');
// 		$this->db->order_by('thumbnail_url','asc');
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	}
	
	function getVideoDetail($id){
	 	$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
	}
	 
	function deleteRecord($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->tablename);
	}
	
	// function set_status($task,$id){
	//     $this->db->set('status',$task);
	//     $this->db->where('id',$id);
	// 	$this->db->update($this->tablename);
	// }

	

   function updateVideo($update_data,$id){
		$this->db->set($update_data);
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}
	
	public function update_columns($id, $data)
    {
        if (!empty($data)) {
            $this->db->where('id', $id);
            return $this->db->update($this->tablename, $data); // Use your actual table name
            
            
        }   
        
        return false;
    }


}
