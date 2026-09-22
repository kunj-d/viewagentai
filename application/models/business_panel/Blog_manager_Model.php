<?php
class Blog_manager_Model extends CI_Model
{
	
	var $tablename= 'default_blogs';	
	var $productTable = 'default_products';	
	var $tablePlanBlogs = 'tbl_blogs_plan';	
	

	function productDetail(){
		$this->db->select('id,title');
		//$this->db->where('status','active');
		$query=$this->db->get($this->productTable);
		return $query->result_array();
	}

	 function createProduct($data){
		$this->db->set($data);
		$this->db->insert($this->tablename);
		return $this->db->insert_id();
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

		if($status)
			$this->db->where('status',$status);
		if($keyword){
			$this->db->group_start();
			$this->db->like('title',$keyword);
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
		   $this->db->like('title',$keyword);
		   //$this->db->or_like('type',$keyword);
		   //$this->db->or_like('slug',$keyword);
		   $this->db->group_end();
		}
		if($this->input->get('product_id') && !empty($this->input->get('product_id')) && $this->input->get('product_id')!='all'){
			$this->db->where('product_id',$this->input->get('product_id'));
		}
		$this->db->order_by('title','asc');
		$query = $this->db->get($this->tablename,$per_page,$currentpage);
		return $query->result();
	}
	
	function getBlogDetail($id){
	 	$this->db->where('id',$id);
		$query = $this->db->get($this->tablename);
		return $query->row();
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

	

   function updateBlog($update_data,$id){
		$this->db->set($update_data);
		$this->db->where('id',$id);
		$this->db->update($this->tablename);
	}

		

    // function createProduct($data){
	// 	$this->db->set($data);
	// 	$this->db->insert($this->tablename);
	// 	return $this->db->insert_id();
	// }
    // function addproduct(){	    
	//  	$this->db->set('title',$this->input->post('title'));
	//     //$this->db->set('slug',$slug);
	//     //$this->db->set('type',$this->input->post('type'));
	// 	$this->db->set('status','inactive');
	// 	$this->db->set('modified',time('Y-m-d H:i:s'));
	// 	$this->db->set('created',time('Y-m-d H:i:s'));
	// 	$this->db->insert($this->tablename);
	// 	return $this->db->insert_id();
	// }
	
    // function updateProduct($update_data,$id){
	// 	$this->db->set($update_data);
	// 	$this->db->where('id',$id);
	// 	$this->db->update($this->tablename);
	// }
	

	
	// function packagePlanList(){
	// 	$this->db->select('id,title,price,sell_type');
	// 	$query = $this->db->get('tbl_package_plans');
	// 	return $query->result();	
	// }
	
	// function getProductPlan(){
	// 	$this->db->select('tbl_package_plans.*,tbl_products_plan.product_id');
	// 	$this->db->from('tbl_package_plans');
	// 	$this->db->join('tbl_products_plan', 'tbl_package_plans.id = tbl_products_plan.plan_id', 'left'); 
	// 	$query = $this->db->get();
	// 	//echo $this->db->last_query();
	// 	return $query->result();	
	// }
	
	// function savedPackagePlanList($product_id){
	// 	$this->db->where('product_id',$product_id);
	// 	$query = $this->db->get($this->tablePlanProducts);			
	// 	$result=$query->result();
	// 	$savePlanId=array();
	// 	foreach($result as $res){
	// 		$savePlanId[]=$res->plan_id;
	// 	}
	// 	return $savePlanId;
	// }
	
	// function addPlanProduct($product_id){
	// 	$package_plan = $this->input->post('package_plan');
	// 	if(!empty($package_plan)){
	// 		foreach($package_plan as $key=>$plan){
	// 			if(!empty($this->input->post('package_plan')))
	// 			{
	// 				$plan_id=$this->input->post('package_plan')[$key];
	// 				$this->db->set('plan_id',$plan_id);
	// 				$this->db->set('product_id',$product_id);
	// 				$this->db->set('created',time());
	// 				$this->db->insert($this->tablePlanProducts);
	// 			}
	// 		}
	// 	}
	// }
	
	// function deleteAddedPlanProduct($product_id){
	// 	$this->db->where('product_id',$product_id);;
	// 	$this->db->delete($this->tablePlanProducts);
	// }
	
	// // function getProductCategory($table_name){
	// // 	$query = $this->db->get($table_name);
	// // 	return $query->result();
	// // }
	
	// function modifyProduct($id,$html_file,$thumbnail){
	// 	$this->db->set('content',$html_file);
	// 	$this->db->set('image',$thumbnail);
	// 	$this->db->where('id',$id);
	// 	$this->db->update($this->tablename);
	// }
	
}
