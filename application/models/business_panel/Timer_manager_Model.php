<?php

class Timer_manager_Model extends CI_Model 
{
    var $tablename = 'tbl_timer';



    public function getAllCount($keyword) 
    {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('title',$keyword);
            $this->db->or_like('type',$keyword);
            $this->db->group_end();
        }
        $query = $this->db->get($this->tablename);
        return $query->num_rows();
    }
    public function getRecordList($keyword,$per_page,$currentpage)
    {
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('title',$keyword);
            $this->db->or_like('type',$keyword);
            $this->db->group_end();
        }
        
        $this->db->select('*');
        $query = $this->db->get($this->tablename,$per_page,$currentpage);
        return $query->result();
    }

    public function addTimer()
    {
        $this->db->set('title',$this->input->post('title'));
        $this->db->set('type',$this->input->post('type'));
        if ($this->input->post('type') == 'fixedtime') {
            $time = $this->input->post('countdown_hrs') . ':' . $this->input->post('countdown_mins');
            $date = explode("/",$this->input->post('start_date')); /* month, day, year */
            /* passed to strtotime in day-month-year format */
            $this->db->set('enddate',date('Y-m-d',strtotime($date[1] .'-'. $date[0] .'-'. $date[2])));
            $this->db->set('endtime',$time);
        } else {
            $this->db->set('repeatin',$this->input->post('countdown_hour'));
        }
        $this->db->set('timezone', $this->input->post('timezone'));
        $this->db->insert($this->tablename);
    }

    public function getTimerDetail($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->tablename);
        return $query->row();
    }

    public function deleteRecord($id) 
    {
        $this->db->where('id',$id);
        $this->db->delete($this->tablename);
    }
    public function updateRecord($id)
    {
        $this->db->where('id',$id);
        $this->db->set('title',$this->input->post('title'));
        $this->db->set('type',$this->input->post('type'));
        if ($this->input->post('type') == 'fixedtime') {
            $time = $this->input->post('countdown_hrs') . ':' . $this->input->post('countdown_mins');
            $date = $this->input->post('start_date');              
            $str_date = strtotime($date . ' ' . $time);             
            date_default_timezone_set("America/New_York");            
            $this->db->set('enddate', $str_date);  
            $this->db->set('repeatin',null);         
        } else {
            date_default_timezone_set("America/New_York");
            $date = date("Y-m-d h:i:s");            
            $data =   strtotime($date);
            $repeattime = $this->input->post('countdown_hour') * 3600;
            $right_time = $data + $repeattime;
            $this->db->set('enddate',$right_time);            
            $this->db->set('repeatin',$this->input->post('countdown_hour'));              
        }
        $this->db->set('timezone', $this->input->post('timezone'));
        $this->db->update($this->tablename);   
    }
}