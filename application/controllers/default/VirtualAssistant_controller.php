<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('AppDefault.php');



class VirtualAssistant_controller extends AppDefault
{

    public function __construct()
    {
        parent::__construct();
        $this->checkAlreadyLogout();
        	$this->Common_Model->checkSubDomain();
         //$this->Common_Model->checkSubDomain();
         $this->business_id = $this->session->userdata('business_id');
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . "Integration_Model");
        $this->load->model($this->model_folder . "Conversation_Model");
        
     
    }



    public function index()
    {
        
        if(!in_array('ai_agent',$this->session->userdata('features'))) {
            $output['error']['type'] = 'flash';
            $output['error']['message'] = 'Please upgrade your plan';
            $this->session->set_flashdata('message', json_encode($output));
            redirect('subscription');
         }

		$data['available_va'] = $available_va;
        $data['title'] = 'Assistant';
        $data['autoresponder'] =  $this->Integration_Model->get_autoresponder_list();
        // pr($data);
        // die;
        $this->loadView('virtual_assistant/assistant',$data);
        
    }


    public function create(){
    //   if(!in_array('chatbot_setting',$this->session->userdata('features'))) {
    //     	$output['error']['type'] = 'flash';
			 //$output['error']['message'] = 'Please upgrade your plan';
			 //$this->session->set_flashdata('message', json_encode($output));
    //      redirect('subscription');
    //   }
      $data['white_lable'] = 'on';
      if(!in_array('white_lable',$this->session->userdata('features'))) {
            	$data['white_lable'] = 'off';
          }
        $data['languages'] = $this->db->get('languages')->result_array();
        $this->db->where('custom',0);
        $data['prompt_category'] = $this->db->get('prompt_category')->result_array();
         $data['autoresponder'] =  $this->Integration_Model->get_autoresponder_list();
        // pr($autoresponder);die;
        $this->loadView('virtual_assistant/create',$data);
    }

    public function store()
    {
      
        header('Content-Type: application/json');
        if ($this->input->post()) {
            $this->form_validation->set_rules('text', 'text', 'required');
            // $this->form_validation->set_rules('niche', 'niche', 'required');
            $this->form_validation->set_rules('purpose', 'purpose', 'required');
            // $this->form_validation->set_rules('color', 'color', 'required');
            // $this->form_validation->set_rules('languaage', 'languaage', 'required');
            $this->form_validation->set_rules('autoresponder', 'autoresponder', 'required');
            $this->form_validation->set_rules('select_list', 'select_list', 'required');
            if($this->input->post('purpose') == 'url'){
                $this->form_validation->set_rules('website_url', 'Website Url', 'required');
                $this->form_validation->set_rules('website_content', 'Website Content', 'required');
            }
            if ($this->form_validation->run() == FALSE) {
                $output['error'] = array('message' => validation_errors(), "type" => "flash");
                //$output['error']['message'] = validation_errors();
                //$output['error']['type'] = "flash";
                echo json_encode($output);
                die();
            } else {
                $prompt = "Hello! I am your " .$_POST['niche']. " AI assistant. How can I assist you today? . I am here to help you " .$_POST['purposeVal'].". What can I help you with today?";
                $path = 'assets/images/grabiris.png';
                $widget_image = 'chat/widget.png';
                $botbackground = $this->input->post('botimage');
                
               $prompt = "Hello! I am your " .$_POST['niche']. " AI assistant. How can I assist you today? . I am here to help you " .$_POST['purposeVal'].". What can I help you with today?";
                $path = 'assets/images/grabiris.png';
                $botbackground = $this->input->post('botimage');
                $widget_image = 'chat/widget.png';
                
                
                $insert_data = [
                    "business_id" => $this->session->userdata('business_id'),
                    "user_id" => $this->session->userdata('business_id'),
                    "text" => $this->input->post('text'),
                    // "niche" => $last_insert_id,
                    "language_id" => $this->input->post('languaage'),
                    "purpose" => $this->input->post('purpose'),
                    "color" => $this->input->post('color'),
                    "assistant_image" => $path,
                    "chatbot_background" => $botbackground,
                    "widget_image" => $widget_image,
                    "website_url" => $this->input->post('website_url'),
                    "website_content" => $this->input->post('website_content'),
                    "autoresponder_id" => $this->input->post('autoresponder'),
                    "list_id" => $this->input->post('select_list'),
                    "color" => $this->input->post('color'),
                    'app'   =>  '',
                    'status'   =>  'yes',
                    'prompt'   =>  $prompt,
                    'appoint_status'   =>  1,
                    'assistant_status'   =>  'custom',
                    'script_tag'   =>  '',
                    'niche'   =>  '',
               ];
                

                
                if (!empty($_FILES['image']['name'])) {
                    $path  =  $this->addLibraryImages('image','va_image');
                     if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your profile image uploaded file type is not  allowed';
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['assistant_image']  = $path;
                    }
                }
                
                
                if (!empty($_FILES['widget_image']['name'])) {
                    $widget_image  =  $this->addLibraryImages('widget_image','widget_image');
                    
                     if($widget_image && !empty($widget_image['data']['error'])){
                         $flashdata['error']['message'] = 'Your widget image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['widget_image']  = $widget_image;
                    }
                }
                
                if (!empty($_FILES['botimage']['name']) && $this->input->post('type') == 'custom') {
                    $botbackground  =  $this->addLibraryImages('botimage','va_botimage');
                    if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your chatbot background image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['chatbot_background']  = $this->config->item('bucket_url') . $botbackground;
                    }
                }
                
                
                $this->db->insert('prompts', $insert_data);
                $last_id = $this->db->insert_id();
                 $this->Common_Model->set_user_logs('Appoint VA Create Settings', $this->input->post('text'));
                $base_url=  $this->config->item('assetsBasePath');
                $business_id = $this->business_id;
                $src_url = $base_url."chat/chat.js";
                $generate ="<script src=$base_url"."chat/chat.js id=$last_id user_id=$business_id > </script>"."\n";
                $updateArray = array(
                    'script_tag' => $generate,
                );
                $this->db->where('id',$last_id);
                $this->db->update('prompts',$updateArray);
                $response = array(
                    'status' => 1,
                    'last_id' => $last_id,
                    'prompt' => $generate,
                    'msg' => 'Virtual Assistant save successfully'
                );
                echo json_encode($response);
            }
        }
    }
    
    
    public function webStore()
    {
      
        header('Content-Type: application/json');
        if ($this->input->post()) {
            $this->form_validation->set_rules('text', 'text', 'required');
            // $this->form_validation->set_rules('niche', 'niche', 'required');
            $this->form_validation->set_rules('purpose', 'purpose', 'required');
            $this->form_validation->set_rules('color', 'color', 'required');
            $this->form_validation->set_rules('languaage', 'languaage', 'required');
            $this->form_validation->set_rules('autoresponder', 'autoresponder', 'required');
            $this->form_validation->set_rules('select_list', 'select_list', 'required');
            if ($this->form_validation->run() == FALSE) {
                $output['error'] = array('message' => validation_errors(), "type" => "flash");
                //$output['error']['message'] = validation_errors();
                //$output['error']['type'] = "flash";
                echo json_encode($output);
                die();
            } else {
                $prompt = "Hello! I am your " .$_POST['niche']. " AI assistant. How can I assist you today? . I am here to help you " .$_POST['purposeVal'].". What can I help you with today?";
                $path = 'assets/images/grabiris.png';
                $botbackground = $this->input->post('botimage');
                $widget_image = 'chat/widget.png';
                
                
                $insert_data = [
                    "business_id" => $this->session->userdata('business_id'),
                    "user_id" => $this->session->userdata('business_id'),
                    "text" => $this->input->post('text'),
                    // "niche" => $last_insert_id,
                    "language_id" => $this->input->post('languaage'),
                    "purpose" => $this->input->post('purpose'),
                    "color" => $this->input->post('color'),
                    "assistant_image" => $path,
                    "chatbot_background" => $botbackground,
                    "widget_image" => $widget_image,
                    "website_url" => $this->input->post('website_url'),
                    "website_content" => $this->input->post('website_content'),
                    "autoresponder_id" => $this->input->post('autoresponder'),
                    "list_id" => $this->input->post('select_list'),
                    "color" => $this->input->post('color'),
                    'app'   =>  '',
                    'status'   =>  'yes',
                    'prompt'   =>  $prompt,
                    'appoint_status'   =>  1,
                    'assistant_status'   =>  'web',
                    'script_tag'   =>  '',
                    'niche'   =>  '',
               ];
                
                
              
                
                
                
                if (!empty($_FILES['image']['name'])) {
                    $path  =  $this->addLibraryImages('image','va_image');
                     if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your profile image uploaded file type is not  allowed';
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['assistant_image']  = $path;
                    }
                }
                
                
                if (!empty($_FILES['widget_image']['name'])) {
                    $widget_image  =  $this->addLibraryImages('widget_image','widget_image');
                    
                     if($widget_image && !empty($widget_image['data']['error'])){
                         $flashdata['error']['message'] = 'Your widget image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['widget_image']  = $widget_image;
                    }
                }
                
                if (!empty($_FILES['botimage']['name']) && $this->input->post('type') == 'custom') {
                    $botbackground  =  $this->addLibraryImages('botimage','va_botimage');
                    if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your chatbot background image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $insert_data['chatbot_background']  = $this->config->item('bucket_url') . $botbackground;
                    }
                }
                
                
                
                
                
                
                
                
                
                

                // $this->db->insert('prompt_category',['custom' => $this->business_id,'category_name' => $this->input->post('niche')]);
                // $last_insert_id    =   $this->db->insert_id();
                
                $this->db->insert('prompts', $insert_data);
                // pr($this->db->last_query());
                // die;
                $last_id = $this->db->insert_id();
                // $this->Common_Model->set_user_logs('Appoint VA Create Settings', $this->input->post('text'));
                $base_url=  $this->config->item('assetsBasePath');
                $business_id = $this->business_id;
                $src_url = $base_url."chat/chat.js";
                $generate ="<script src=$base_url"."chat/chat.js id=$last_id user_id=$business_id > </script>"."\n";
                $updateArray = array(
                    'script_tag' => $generate,
                );
                $this->db->where('id',$last_id);
                $this->db->update('prompts',$updateArray);
                $response = array(
                    'status' => 1,
                    'last_id' => $last_id,
                    'prompt' => $generate,
                );
                echo json_encode($response);
            }
        }
    }

    public function changeStatus(){
        $post_data = json_decode(file_get_contents('php://input'), true);
        $this->db->where('id', $post_data['id']);
        $assistants = $this->db->update('prompts',['status'=> $post_data['status']]);
        $response = array(
            'status' => 1,
        );
        echo json_encode($response);
    }
    
   public function deleteVa() {
     
    $id = $this->input->post('id');
    $this->checkassitant($id);
    $this->db->where('chatgpt.assistant_id', $id);
    $this->db->delete('chatgpt');
    $this->db->where('chat.assistant_id', $id);
    $this->db->delete('chat');
    $this->db->where('id', $id);
    $this->db->delete('prompts');
    $this->Common_Model->set_user_logs('Appoint VA Delete Settings', 'Delete VA');
    $response = array(
        'status' => 1,
    );
    echo json_encode($response);
}


    public function getVA()
    {

        $post_data = json_decode(file_get_contents('php://input'), true);
        $post_data['search'] = preg_replace('!\s+!', ' ', $post_data['search']);
        $search_array=explode(" ",$post_data['search']);

        $this->db->select('prompts.*,prompt_category.category_name,prompt_category.category_image,prompt_category.main_category_id,prompt_category.custom,prompt_category.type,prompt_category.name');
        $this->db->where('business_id', $this->session->userdata('business_id'));
        $this->db->where_in('assistant_status', ['default','super_va','super_vachat']);
         $this->db->where('prompt_category.custom', 0);
        if(!empty($post_data['search']))
        {
            $this->db->group_start();
                $this->db->like('category_name',$post_data['search'],'both');
                // $this->db->or_like('text',$post_data['search'],'both');
                
                foreach($search_array as $key => $value) {
                     if($key == 0) {
                          $this->db->like('category_name',$value);
                        //   $this->db->or_like('text',$value);
                     } else {
                        $this->db->or_like('category_name',$value);
                        // $this->db->or_like('text',$value);

                    }
                }
                
            $this->db->group_end();
        }
        if($post_data['status'] == 'active')
        {
            $this->db->where('prompts.status', 'yes');
            $this->db->where('prompts.appoint_status', 1);
        }elseif($post_data['status'] == 'inactive')
        {
            $this->db->where('prompts.status', 'no');
             $this->db->where('prompts.appoint_status', 1);
        }
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');
        $this->db->order_by('sort', 'ASC');
        $assistants   =   $this->db->get('prompts')->result_array();
        //  pr($this->db->last_query());
        //  die;
        
    
        $response = array(
                'status' => 1,
                'list' => $assistants,  // Poora array of AI assistants
                'msg' => 'Success'
            );
            
            // // $count ko session se lena
            // $count = $this->session->userdata('fields_counts')['ai_agents']['value'];
            
            // // Agar $count me value set hai aur wo 0 se zyada hai, to array slice karke utne hi elements bhejne hain
            // if ($count > 0) {
            //     $response['list'] = array_slice($assistants, 0, $count);
            // }
            
            // JSON response encode karke return karna
            echo json_encode($response);
    
        }

    public function getInactiveVA()
    {
        $this->db->select('prompts.*,prompt_category.category_name');
        $this->db->where('business_id', $this->session->userdata('business_id'));
        $this->db->where('status', 'no');
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');
        $this->db->order_by('id', 'DESC');
        $assistants   =   $this->db->get('prompts')->result_array();
        $response = array(
            'status' => 1,
            'list' => $assistants,
            'msg' => 'Success'
        );
        echo json_encode($response);
    }

     public function edit()
    {
        $id = $this->uri->segment(3);
        $this->checkassitant($id);
        $data['languages'] = $this->db->get('languages')->result_array();
        $this->db->where('custom',0);
        $data['prompt_category'] = $this->db->get('prompt_category')->result_array();
        $data['autoresponder'] =  $this->Integration_Model->get_autoresponder_list();
        $data['assistant_data'] = $this->Conversation_Model->getAssistantData($id);
        // pr($data);
        // die;
        
        $this->loadView('virtual_assistant/edit', $data);
    }
    
 
    
  public function appoint()
    {
         $data['white_lable'] = 'on';
          if(!in_array('white_lable',$this->session->userdata('features'))) {
            	$data['white_lable'] = 'off';
          }
        $id = $this->uri->segment(3);
        $this->checkassitant($id);
        $data['languages'] = $this->db->get('languages')->result_array();
        $this->db->where('custom',0);
        $data['prompt_category'] = $this->db->get('prompt_category')->result_array();
        $data['autoresponder'] =  $this->Integration_Model->get_autoresponder_list();
        $data['assistant_data'] = $this->Conversation_Model->getAssistantData($id);
        // pr($data['assistant_data']);
        // die;
        $this->loadView('virtual_assistant/edit', $data);
    }

    public function updateAssitant()
    {
      
       // die("Hello");
        header('Content-Type: application/json');
        $id = $this->input->post('id');
        $this->checkassitant($id);
        if ($this->input->post()) {
            $this->form_validation->set_rules('text', 'text', 'required');
            // $this->form_validation->set_rules('niche', 'niche', 'required');
            // $this->form_validation->set_rules('purpose', 'purpose', 'required');
            // $this->form_validation->set_rules('color', 'color', 'required');
            // $this->form_validation->set_rules('languaage', 'languaage', 'required');
            // $this->form_validation->set_rules('autoresponder', 'autoresponder', 'required');
            // $this->form_validation->set_rules('select_list', 'select_list', 'required');
            if ($this->form_validation->run() == FALSE) {
                $output['error'] = array('message' => validation_errors(), "type" => "flash");
                //$output['error']['message'] = validation_errors();
                //$output['error']['type'] = "flash";
                echo json_encode($output);
                die();
            } else {
                 $botbackground = $this->input->post('botimage');
                $prompt = "Hello! I am your " . $_POST['nicheVal'] . " AI assistant. How can I assist you today? . I am here to help you " . $_POST['purposeVal'] . ". What can I help you with today?";
                $update_data = [
                    "business_id" => $this->business_id,
                    "text" => $this->input->post('text'),
                    "language_id" => $this->input->post('languaage'),
                    // "purpose" => $this->input->post('purpose'),
                    "chatbot_background" => $botbackground,
                    "autoresponder_id" => $this->input->post('autoresponder'),
                    "list_id" => $this->input->post('select_list'),
                    "color" => $this->input->post('color'),
                    'prompt'   =>  $prompt,
                    'appoint_status' => 1,
                    'status' => 'yes',
                ];
                //  $path = ($this->session->userdata('logged_in')['profile_pic'] == '' || $this->session->userdata('logged_in')['profile_pic'] == "default_profile.png") ? 'default/images/default_profile.png':  $this->session->userdata('logged_in')['profile_pic'];
               
                
                if (!empty($_FILES['image']['name'])) {
                    $path  =  $this->addLibraryImages('image','va_image');
                     if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your profile image uploaded file type is not  allowed';
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $update_data['assistant_image']  = $path;
                    }
                }
                
                
                if (!empty($_FILES['widget_image']['name'])) {
                    $widget_image  =  $this->addLibraryImages('widget_image','widget_image');
                    
                     if($widget_image && !empty($widget_image['data']['error'])){
                         $flashdata['error']['message'] = 'Your widget image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $update_data['widget_image']  = $widget_image;
                    }
                }
                
                if (!empty($_FILES['botimage']['name']) && $this->input->post('type') == 'custom') {
                    $botbackground  =  $this->addLibraryImages('botimage','va_botimage');
                    if($path && !empty($path['data']['error'])){
                         $flashdata['error']['message'] = 'Your chatbot background image uploaded file type is not  allowed';;
                          echo json_encode($flashdata);
                         die;
                    }else{
                         $update_data['chatbot_background']  = $this->config->item('bucket_url') . $botbackground;
                    }
                }
                

                $this->db->where('id',$id);
                $this->db->update('prompts', $update_data);
                $response = array(
                    'status' => 1,
                    'msg' => 'Virtual Assistant update successfully'
                );
                echo json_encode($response);
                die;
            }
        } 
    }
    
    
    public function saveAutoresponderForms(){
        
        $id = $this->input->post('id');
        $autoresponder = $this->input->post('autoresponder');
        $select_list = $this->input->post('select_list');
        
        $this->db->where('id',$id);
        $this->db->set('autoresponder_id',$autoresponder);
        $this->db->set('list_id',$select_list);
        $this->db->update('prompts');
        $result = array(
            'status'=> 1,
            'msg'=> 'Sucesss'
            );
        echo json_encode($result);
        die;
        
    }
    
    public function getSaveAutoresponderForms(){
          $id = $this->input->post('id');
          
             $this->db->where('id',$id);
        $query=  $this->db->get('prompts');
        $result['data'] = $query->result_array()[0];
        echo  json_encode($result); die;
    }
    
     public function view() {
        $this->db->select('prompts.*, prompt_category.category_name');
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');
        $this->db->where('business_id', $this->session->userdata('business_id'));
        $this->db->where_in('assistant_status', ['custom']);
        $post_data = [/*...*/]; // Assuming $post_data is available.
        if (!empty($post_data['search'])) {
            $this->db->group_start();
            $this->db->like('category_name', $post_data['search'], 'both');
            $this->db->or_like('text', $post_data['search'], 'both');
            $this->db->group_end();
        }
        $this->db->order_by('id', 'DESC');
        $assistants = $this->db->get('prompts')->result_array();
        
    
        $this->loadView('virtual_assistant/list', ['assistants' => $assistants]);
    }
    
   public function webPreview()
    {
        $id = $this->uri->segment(3);
        $data['assistant_data'] = $this->Conversation_Model->getAssistantData($id);
       
        
        $this->load->view('default/virtual_assistant/website_preview', $data);
    }
    
    
     public function deleteMultiVa()
    {
        
        $idArray = $_POST['ids'];
        // $idArray = explode(",", $this->input->get('id_data'));

        foreach ($idArray as $key => $val) {
            $this->db->where('assistant_id', $val);
            $this->db->delete('chat');
            $this->db->where('assistant_id', $val);
            $this->db->delete('chatgpt');
            $this->db->where('id', $val);
            $this->db->delete('prompts');
        }
        $this->Common_Model->set_user_logs('Appoint VA Delete Settings', 'Delete VA');
        $output['success'] = array('message' => 'Conversation Deleted Successfully.');
        echo json_encode($output);
        die;
    }
    
    public function search_authenticat_url(){
        
    ;
        if($this->input->post()){
            $website_auth_url = $this->input->post('website_auth_url');
            	$url_html_data = @file_get_contents($website_auth_url);
			$url_doc = new DOMDocument();
			@$url_doc->loadHTML($url_html_data);
		
			$response = $url_doc->getElementsByTagName('body')->item(0)->nodeValue;
			
			$response = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $response);
		//	$response = preg_replace('/<script\b[^>]*>\s*\$\(document\)\.ready\([^>]*\)\s*{\s*([^>]*)}\s*<\/script>/is', '', $response);
            $response = preg_replace('/\s+/', ' ', $response);
            $response = preg_replace('/\s+>/', '>', $response);
            $response = strip_tags($response);
            $response = preg_replace('/\s*var\s+\w+\s*=\s*".*?";/', '', $response);
      /// $response = $this->remove_scripts_styles($response);
      
            //$xpath = new DOMXPath($url_doc);
          //  $response = $xpath->query('//body')->item(0)->textContent;
             echo json_encode($response);
                die;
        }
         
    }
    
    
    
    function strip_tags_content($text, $tags = '', $invert = false) { 
    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags); 
    $tags = array_unique($tags[1]); 
   
    if(is_array($tags) && count($tags) > 0) { 
        if($invert == false) { 
            return preg_replace('@<(' . implode('|', $tags) . ')(?:[^>]*)>@iU', '', $text); 
        } 
        else { 
            return preg_replace('@<(?!(?:' . implode('|', $tags) . ')\b)(\w+)\b[^>]*>@iU', '', $text); 
        } 
    } 
    elseif($invert == false) { 
        return preg_replace('@<(\w+)\b[^>]*>@iU', '', $text); 
    } 
    return $text; 
}

            function remove_scripts_styles($html) {
                $html = $this->strip_tags_content($html, '<script><style>', true); // Remove scripts and styles
                $html = preg_replace('/(<script[^>]*>)(.*?)(<\/script>)/is', '', $html); // Remove script content
                $html = preg_replace('/(<style[^>]*>)(.*?)(<\/style>)/is', '', $html); // Remove style content
                return $html;
            }
            
          public function updateFavStatus()
            {
                // pr($_POST);
                // die;
                $data = $this->input->post();
                if(isset($data['id']) && isset($data['value'])) {
                    $listId = $data['id'];
                    $status = $data['value'];
                    $success = $this->Conversation_Model->updateFavStatus($listId, $status);
            
                    if ($success) {
                        if ($status) {
                            echo json_encode(array('message' => 'Added to favorites successfully'));
                        } else {
                            echo json_encode(array('message' => 'Removed from favorites successfully'));
                        }
                    } else {
                        echo json_encode(array('error' => 'Failed to update favorite status'));
                    }
                }
            }


}
