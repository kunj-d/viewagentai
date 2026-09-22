<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation_Model extends CI_model {

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');  

        $this->business_id = $this->session->userdata('business_id');
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
		$this->chat = 'chat';
    }

    public function get_list_data($data) {
        $yesterday_time = time() - (24 * 60 * 60);

        $this->db->select('SQL_CALC_FOUND_ROWS chat.id', FALSE);        
        $this->db->select('chat.id, chat.business_id,chat.prompt_id, chat.chat_name, chat.created_at, prompts.text as assistant_name, prompts.purpose as purpose');

        $this->db->join('prompts', 'prompts.id = chat.prompt_id', 'left');      
        $this->db->where('prompts.appoint_status', 1);
        $this->db->where('prompts.status', 'yes');
        $this->db->where('chat.business_id', $this->business_id);
        $this->db->order_by('id','desc');
        if ($data['search_key']) {
            $this->db->group_start();
            $this->db->or_like('chat.chat_name', $data['search_key']);
            $this->db->or_like('prompts.text', $data['search_key']);
            $this->db->or_like('chat.created_at', $data['search_key']);
            $this->db->group_end();
        }
     
        $items_per_page = $data['items_per_page'] ? $data['items_per_page'] : 10;
        $current_page = $data['current_page'] ? $data['current_page'] : 1;
		$start = ($current_page - 1) * $items_per_page;
 
		// $order_by = $data['order_by'] ? $data['order_by'] : 'modified';
        // $order_type = $data['order_by'] ? $data['order_by'] : 'DESC';
        // $this->db->order_by($this->chat.'.'.$order_by, $order_type);
	
		$this->db->group_by('id');
        $query = $this->db->get($this->chat);
        // $query = $this->db->get($this->chat,$items_per_page,$start);
        $output['data'] = $query->result_array();
       // echo $this->db->last_query(); die;
        $totalquery = $this->db->query('SELECT FOUND_ROWS() as total;');
        $row = $totalquery->row();
        $output['total_items'] = $row->total;
        $ceil =  ceil($row->total/$items_per_page);
      
        // pr($ceil);
       
        if($current_page == 1){
            // echo "1";
           for ($x = 1; $x<=$ceil; $x++) {
                $no_of_pages[] = $x;
            }
           $no_of_pages = array_slice($no_of_pages,0,5);
        }else{
            if($current_page>1 && $ceil<5){
            // echo "2";
                for ($x = 1; $x<=$ceil; $x++) {
                    $no_of_pages[] = $x;
                } 
            }elseif($current_page>1 && $ceil>5){
            // echo "3";
                for ($x = $current_page-2; $x<=$ceil; $x++) {
                    $no_of_pages[] = $x;
                } 
            }

        }
        // pr($no_of_pages);
    //   die;
        
        $output['no_of_pages'] = $no_of_pages;
        // pr($output);
        // die;
        return $output;
    }





    public function get_conversation_details($id){
		$this->db->select('business_id, chat_id, human, ai, type');
		$this->db->where('chat_id',$id);
		$this->db->where('business_id', $this->business_id);
		$query = $this->db->get('chatgpt');
		return $query->result_array();
	}
	

    
    public function getChatTitle($business_id,$prompt_id)
    {
        $assistantData  = $this->getAssistantData($prompt_id);
        $this->db->distinct();
        $this->db->select('chat_name');
        $this->db->like('chat_name', 'chat', 'after');
        $this->db->where('business_id', $business_id);
        $this->db->where('prompt_id', $prompt_id);
        $this->db->order_by('id', 'desc');
        $data    =    $this->db->get('chat');
        // pr($data);
        // // die;
        // pr($this->db->last_query());
        // die;
        if ($data->num_rows() > 0) {
            $data = $data->result_array();
            $oldTitle = str_replace('chat', '', $data[0]['chat_name']);
            $title = 'chat' . ($oldTitle + 1);
        } else {
            $title = 'chat1';
        }
        
        if($assistantData->assistant_status == 'super_vachat'){
            $purpose = 'chat';
        }elseif($assistantData->assistant_status == 'super_va'){
            $purpose = 'images';
        }else{
            $purpose = $assistantData->purpose;
        }
        
        $this->db->insert('chat', ['chat_name' => $title, 'business_id'=> $this->business_id, 'prompt_id' => $prompt_id,'language'=>'en','tones'=>'0.6','token'=>'','purpose'=>$purpose]);
        $id = $this->db->insert_id();
        $result = [
            'chat_id'=> $id,
            'astdata'=>$assistantData,
            'purpose' => $purpose,
            ];
        return $result;
    }

     public function getChatlist($business_id,$prompt_id)
    {
        $this->db->distinct();
        $this->db->where('business_id', $business_id);
        $this->db->where('prompt_id', $prompt_id);
        $this->db->order_by('id', 'desc');
        $data    =    $this->db->get('chat')->result_array();
        // pr($this->db->last_query());
        // die;
        return $data;
    }
    
    public function getAssistantData($id){
        $this->db->select('prompts.*,prompt_category.id as pro_cat_id,prompt_category.name,prompt_category.category_name,prompt_category.category_image');
        $this->db->where('prompts.id',$id);
        $this->db->where('prompts.business_id', $this->business_id);
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');
        $data   =   $this->db->get('prompts')->row();
        return $data;
    }


    public function getLastChatID($prompt_id)
    {
        $this->db->where('prompt_id',$prompt_id);
        $this->db->where('business_id', $this->business_id);
        $this->db->order_by('id', 'desc');
       $data =    $this->db->get('chatgpt')->row();
       return $data; 
    }
    
    public function getAssistantInfo($prompt_id){
          $this->db->where('prompt_id',$prompt_id);
        $this->db->where('business_id', $this->business_id);
        $this->db->order_by('id', 'desc');
       $data =    $this->db->get('chat')->row();
       return $data; 
    }
    
    
     public function createChat($prompt_id){
	$assistantData  = $this->getAssistantData($prompt_id);
    $this->db->where('prompt_id',$prompt_id);
    $this->db->where('business_id', $this->business_id);
    $response = $this->db->get('chat')->row();
    if(empty($response)){
        $data = array(
            'business_id'=> $this->business_id,
            'prompt_id' => $prompt_id,
            'chat_name' => 'chat1',
            'language'=>'',
            'tones'=>'',
            'token'=>'',
            'type'=>''
        );
        if($assistantData->assistant_status == 'super_vachat'){
            $data['purpose'] = 'chat';
        }elseif($assistantData->assistant_status == 'super_va'){
            $data['purpose'] = 'images';
        }else{
            $data['purpose'] = $assistantData->purpose;
        }
        $this->db->insert('chat',$data);
        $chat_id = $this->db->insert_id();
		$user_name = $this->session->userdata('logged_in')['name'];

		if($assistantData->assistant_status == 'super_va' || $assistantData->assistant_status == 'super_vachat'){
        //   $va_first_message = 'Hi ' . $user_name . ', I am getaisupreme ( Your Super VA ) How may I help you today?';
              $va_first_message = 'Hi ' . $user_name . ', I am ' . $assistantData->name . ', your ' . $assistantData->category_name . '. How can I assist you today?';
        }else{
            // $va_first_message = 'Hi ' . $user_name . ', I am getaisupreme ( Your Super VA ) and I have expertise in ' . $assistantData->prompt_cat . ' too. How may I help you today?';
            $va_first_message = 'Hi ' . $user_name . ', I am ' . $assistantData->name . ', your ' . $assistantData->category_name . '. How can I assist you today?';
        }
		
// 		Hi Aman, I am Alex Bennett, Your Investment Manager. How can I assist you today?
		$array = [
			'prompt_id' =>	$prompt_id,
			'business_id'=> $this->business_id,
			'chat_id'	=>	$chat_id,
			'ai' 	=>	$va_first_message,
			'type' 	=>	'chatgpt'
		];
		$this->db->insert('chatgpt', $array);

    }
    return true;
  }
  
      public function updateFavStatus($listId, $status)
       {
        return $this->db->where('id', $listId)
                        ->where('business_id', $this->business_id)
                        ->update('prompts', array('agent_favorite' => $status));
    }

}

?>