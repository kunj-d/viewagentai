<?php
class Last_login_Model extends CI_Model
{
	var $tablename='tbl_last_login';
	
	function doEntry(){
		$this->db->set('member_id',$this->session->userdata('SAG_mem_id'));
		$this->db->set('login_time',date('Y-m-d H:i:s'));
		$query = $this->db->insert($this->tablename);
	}
	public function lastEntryTime()
	{
		$this->db->where('member_id',$this->session->userdata('SAG_mem_id'));
		$this->db->where('status','Active');
		$this->db->order_by('id','desc');
		$this->db->limit(2);
		$query = $this->db->get($this->tablename);
		$row= $query->result();
		
		if($row[1]->login_time)
		{ 
			$time=$this->Myago(strtotime($row[1]->login_time));
			return $time;
		}
		else
		{
			return false;
		}
	}
	function Myago($tm,$rcs = 0)
	{
		$cur_tm = time();
		$dif = $cur_tm-$tm;
	
		$agoProcess =0;
		$agoText = '';
		//$lngh = array(1,60,3600,86400,604800,2630880,31570560);
		$difYear = floor($dif/31570560);
		$difYearRemaining = $dif%31570560;
		if($difYear>0)
		{
			$agoText.=$difYear.' Years ';
			$agoProcess++;
		}
	
		$difMonth = floor($difYearRemaining/2630880);
		$difMonthRemaining = $difYearRemaining%2630880;
		if($difMonth>0)
		{
			$agoText.=$difMonth.' Months ';
			$agoProcess++;
			if($agoProcess==2)
			return $agoText;
		}
	
		$difWeek = floor($difMonthRemaining/604800);
		$difWeekRemaining = $difMonthRemaining%604800;
		if($difWeek>0)
		{
			$agoText.=$difWeek.' Weeks ';
			$agoProcess++;
			if($agoProcess==2)
			return $agoText;
		}
	
		$difDay = floor($difWeekRemaining/86400);
		$difDayRemaining = $difWeekRemaining%86400;
		if($difDay>0)
		{
			$agoText.=$difDay.' Days ';
			$agoProcess++;
			if($agoProcess==2)
			return $agoText;
		}
	
		$difHour = floor($difDayRemaining/3600);
		$difHourRemaining = $difDayRemaining%3600;
		if($difHour>0)
		{
			$agoText.=$difHour.' Hours ';
			$agoProcess++;
			if($agoProcess==2)
			return $agoText;
		}
	
		$difMinute = floor($difHourRemaining/60);
		$difSecondRemaining = $difHourRemaining%60;
		if($difMinute>0)
		{
			$agoText.=$difMinute.' Minutes ';
			$agoProcess++;
			if($agoProcess==2)
			return $agoText;
		}
	
		$agoText.=$difSecondRemaining.' Second';
		return $agoText;
	}
}