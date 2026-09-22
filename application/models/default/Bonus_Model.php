<?php
class Bonus_Model extends CI_Model
{
	
	var $tablename='tbl_bonuses';	
	var $tablecat='tbl_bonus_categories';	
	
// 	function getRecordList(){
// 		$this->db->select("$this->tablecat.id,$this->tablecat.title as bonus_category_title,$this->tablename.title,$this->tablename.image,$this->tablename.url,$this->tablename.description");
// 		$this->db->join($this->tablename,"$this->tablecat.id=$this->tablename.bonus_category_id",'left');
// 	 	//$this->db->where("$this->tablecat.bonus_category_id",$slug);
// 	 	$this->db->where("$this->tablename.status",'active');
// 		$query = $this->db->get($this->tablecat);
// 		if($query->num_rows()>0){
// 		    return $query->result();
//         }
// 		return 0;
// 	 }

        function getRecordList($slug){
    		$this->db->select("$this->tablecat.id,$this->tablecat.title as bonus_category_title,$this->tablename.title,$this->tablename.image,$this->tablename.url,$this->tablename.description");
    		$this->db->join($this->tablename,"$this->tablecat.id=$this->tablename.bonus_category_id",'left');
    	 	$this->db->where("$this->tablecat.slug",$slug);
    	 	//$this->db->where("$this->tablename.status",'active');
    		$query = $this->db->get($this->tablecat);
    		if($query->num_rows()>0){
    		    return $query->result();
            }
    		return 0;
    	 }
}
