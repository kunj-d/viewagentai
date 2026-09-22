<?php

 class Socialmozo_Model extends CI_Model  
 {  
      var $table = "campaigns";  
      var $select_column = array("campaigns.id","title","template_id","type","schedule_on");  
      var $order_column = array(null, "title", 'template_id', null,"schedule_on","type");  
      function make_query()  
      {  
	  
            $this->db->select($this->select_column);  
			$this->db->join('user_templates','campaigns.user_template_id=user_templates.id','left');
			$this->db->from($this->table); 
		
			if(isset($_POST["search"]["value"]))  
           {  
                $this->db->like("title", $_POST["search"]["value"]);  
                $this->db->or_like("schedule_on", $_POST["search"]["value"]);  
                $this->db->or_like("type", $_POST["search"]["value"]);  
           }  
           if(isset($_POST["order"]))  
           {  
				$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
		  } 
		   
			else  
           {  
			$this->db->order_by('id', 'DESC');  
           }  
      }  
      function make_datatables(){  
	  
		$this->make_query(); 
		
		$limit = isset($_POST["length"]) ? $_POST["length"] : 20;
		$start = isset($_POST["start"]) ? $_POST["start"] : 0;

		$this->db->limit($limit, $start);  
		$query = $this->db->get(); 
	return	$query->result();  

      }  
      function get_filtered_data(){  
           $this->make_query();  
           $query = $this->db->get();  
           return $query->num_rows();  
      }       
      function get_all_data()  
      {  
           $this->db->select("*");  
           $this->db->from($this->table);  
           return $this->db->count_all_results();  
      } 

		function deleteRecord($id){
	
	    $this->db->where('id',$id);
		$this->db->delete($this->table);
	}
	
	function deleteall_social($request)
			{
				foreach($request as $key=>$val){
				$this->db->where('id',$val);
				$this->db->delete($this->table);
				echo $this->db->last_query();
				die("asd");
				}
			}	  
 }  