<?php
defined("BASEPATH") or exit("No direct script access allowed");
require APPPATH . "libraries/chat/autoload.php";

require "AppDefault.php";
require_once APPPATH . "libraries/vendor/autoload.php";

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Inkflow_socialmedia_controller extends AppDefault
{
    function __construct()
    {
        parent::__construct();

        $this->checkAlreadyLogout();

        $this->Common_Model->checkSubDomain();
        $this->owner_id = $this->session->userdata("logged_in")["owner_id"];
        $this->user_id = $this->session->userdata("logged_in")["id"];
        $this->view_folder = $this->config->item("template");
        $this->model_folder = $this->view_folder;
        $this->load->model($this->model_folder . "Business_model");
        $this->load->model('default/Inkflow_socialmedia_model');
        $this->load->model($this->model_folder . "Inkflow_socialmedia_model");

        if (!empty($this->session->userdata("business"))) {
            $this->business_id = $this->session->userdata("business")["id"];
        } else {
            $this->business_id = $this->session->userdata(
                "business_switch_session"
            );
        }
        $this->openaikey = config_item('openai_key_legacy_2');
    }

    public function index()
    {
        // 		$this->db->where('cas_business_id', $this->session->userdata('business_id'));
        // 	    $this->db->where('cas_status', 1);
        // 		$this->db->limit('1');
        // 		$appset_data = $this->db->get('customer_app_sets')->row();
        // 		if(isset($appset_data)){
        // 		    $url="update-set/".$appset_data->cas_id;
        // 		    return redirect($url);
        // 		}else{

        // 		}

        $this->db->where('business_id' ,$this->business_id);
        $this->db->where('user_id' ,$this->user_id);
        $query = $this->db->get('inkflow_socialmedia');
        $data['lists'] = $query->result_array();
        $this->loadView("inkflow/inkflow_socialmedia_listing" ,$data);
         
    }

    public function setupsocialmedia($socialmedia_id = null){
        if($socialmedia_id){
            $data['socialmediaData'] = $this->Inkflow_socialmedia_model->getsocialmediaById($socialmedia_id, $this->user_id, $this->business_id);
            $this->loadView("inkflow/inkflow_social_media", $data );
        }else{
            $this->loadView("inkflow/inkflow_social_media");
        }
    }

    public function insertsocialmedia() {
        $response = ['status' => false, 'msg' => ''];
        $updateId = trim($this->input->post('updateId'));
        // Retrieve POST data
        $socialmediaData = [
            'user_id' => $this->user_id,
            'business_id' => $this->business_id,
            'socialmedia_name' => trim($this->input->post('socialmedianame')),
            'socialmedia_type' => trim($this->input->post('socialmediatype')),
            'reference_url_keynote' => trim($this->input->post('reference')),
            'wizard_business' => trim($this->input->post('busineesname')),
            'wizard_offer' => trim($this->input->post('offer')),
            'wizard_contact' => trim($this->input->post('contact')),
            'keynote' => trim($this->input->post('keynoteData')),
            'language' => trim($this->input->post('language')),
            'ai_model' => trim($this->input->post('aimodel')),
            'tone' => trim($this->input->post('tone')),
            'style' => trim($this->input->post('style')),
            'socialmedia_subject' => trim($this->input->post('subject')),
            'socialmedia_body' => trim($this->input->post('socialmedia'))
        ];
	
        
        // Required fields validation
        $requiredFields = [
            'socialmedia_name' => 'Social Media Name',
            'socialmedia_type' => 'Social Media Type',
            'socialmedia_subject' => 'Social Media Subject',
            'socialmedia_body' => 'Social Media Body'
        ];

        foreach ($requiredFields as $key => $label) {
            if ($socialmediaData[$key] === '' || $socialmediaData[$key] === null) {
                $response['msg'] = "$label is required.";
                echo json_encode($response);
                return;
            }
        }
        if ($updateId) {
            // **UPDATE Logic**
            $update_status = $this->Inkflow_socialmedia_model->updatesocialmediaData($updateId, $socialmediaData);
            if ($update_status) {
                $response['status'] = true;
                $response['msg'] = 'Social Media updated successfully.';
            } else {
                $response['msg'] = 'Failed to update Social Media data.';
            }
        } else {
            // **INSERT Logic**
            $insert_status = $this->Inkflow_socialmedia_model->insertsocialmediaData($socialmediaData);
            if ($insert_status) {
                $response['status'] = true;
                $response['msg'] = 'Social Media inserted successfully.';
            } else {
                $response['msg'] = 'Failed to insert Social Media data.';
            }
        }

        echo json_encode($response);
    }

 
    public function get_socialmedia_list() {
        
        $socialmediaList = $this->Inkflow_socialmedia_model->getsocialmediaList($this->business_id, $this->user_id);
    
        echo json_encode($socialmediaList);
    }

    public function createsocialmedia()
    {
        $input = $this->input->post("urlkey"); // capture Input field value

        if ($this->is_youtube_url($input)) {
            // For Youtube 
            echo json_encode([
            "status" => 0,
            "msg" => "Failed to fetch data or received an invalid response.",
        ]);
            // $this->process_youtube_url($input);
            
        } elseif ($this->is_url($input)) {
            // for General URL
            $mail = $this->url_to_text($input);
            if (!empty($mail)) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Data fetched successfully.",
                    "data" => $mail,
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" =>
                        "Failed to fetch data or received an invalid response.",
                ]);
            }
            // pr($socialmedia); die;
        } else {
            // For Keyword
            $mail = $this->generate_socialmedia($input);
            if (!empty($mail)) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Data fetched successfully.",
                    "data" => $mail,
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" =>
                        "Failed to fetch data or received an invalid response.",
                ]);
            }
        }
    }


    public function delete_socialmedia() {
        $post_data = $this->input->post();
        $socialmedia_id = $post_data['socialmedia_id'] ?? null;
    
        if (!$socialmedia_id) {
            echo json_encode(['status' => 0, 'msg' => 'Invalid Social Media ID.']);
            return;
        }
    
        
        $result = $this->Inkflow_socialmedia_model->deletesocialmedia($socialmedia_id, $this->business_id, $this->user_id);
    
        echo json_encode($result);
    }
    

    public function createkeynote()
    {
        $busineesname = $this->input->post("busineesname"); // capture Input field value
        $offer = $this->input->post("offer"); // capture Input field value
        $contact = $this->input->post("contact"); // capture Input field value


        // For keynote
        $keynote = $this->generate_keynote($busineesname, $offer, $contact);
        if (!empty($keynote)) {
            echo json_encode([
                "status" => 1,
                "msg" => "Data fetched successfully.",
                "data" => $keynote,
            ]);
        } else {
            echo json_encode([
                "status" => 0,
                "msg" =>
                    "Failed to fetch data or received an invalid response.",
            ]);
        }
    }

    // YouTube URL validate karne ke liye function
    private function is_youtube_url($url)
    {
        return preg_match(
            '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/',
            $url
        );
    }

    // General URL validate karne ke liye function
    private function is_url($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    // // YouTube URL process karne ke liye function
    // private function process_youtube_url($url)
    // {
    //     echo "This is a YouTube URL: " . $url;
    // }

    // // General URL process karne ke liye function
    // private function process_url($url)
    // {
    //     echo "This is a General URL: " . $url;
    // }

    // // Keyword process karne ke liye function
    // private function process_keyword($keyword)
    // {
    //     echo "This is a keyword: " . $keyword;
    // }

    /*-----------------for url to text and generate Social Media start--------------------*/

    public function url_to_text($input)
    {
        // pr($_POST); die;
        // $url = $this->input->post('urlkey');
        $url = $input;

        $api_url = "https://ai.oppyo.com/app/v1/fetch_plain_text_from_url";

        // Parameters
        $params = [
            "api_key" => "D684B8EFF387DBD9",
            "url" => $url,
            "link_fetch_type" => "0",
        ];

        $ch = curl_init();

        // Set cURL options for a POST request
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params)); //parameters

        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            echo "cURL Error: " . $error_msg;
            return;
        }

        // Close cURL session
        curl_close($ch);

        // Decode response

        $data = json_decode($response, true);
        $dataa = implode("\n", $data["data"]);

        // Clean the data: Remove excessive blank lines and trim spaces
        $cleaned_data = preg_replace('/^\s*[\r\n]+/m', "", $dataa); // Remove blank lines
        $cleaned_data = trim($cleaned_data);
        // pr($cleaned_data); die;
        $mail = $this->get_socialmedia($cleaned_data);

        return $mail;

        // pr($mail); die('here');

        // if (!empty($mail)) {
        //     echo json_encode([
        //         'status' => 1,
        //         'msg' => 'Data fetched successfully.',
        //         'data' => $mail
        //     ]);
        // } else {
        //     echo json_encode([
        //         'status' => 0,
        //         'msg' => 'Failed to fetch data or received an invalid response.'
        //     ]);
        // }
    }

    public function get_socialmedia($cleaned_data)
    {
        // $keyword = $this->input->post('keyword');

       $openAISecretKey = $this->openaikey ;

        // Initialize OpenAI
        $open_ai = new OpenAi($openAISecretKey);

        // Define the prompt based on the keyword
        // $prompt = "Create only 1 quiz questions on the topic of $keyword. For each question, provide 4 answer options (A, B, C, D), and mark the correct answer. Ensure the questions are well-structured and cover various aspects of the topic. The difficulty level should be a mix of easy, moderate, and challenging.";

        $prompt =
            "I want to generate promotion Social Media using this text" . $cleaned_data;
        $history[] = ["role" => "user", "content" => $prompt];

        $opt = [
            "model" => "gpt-3.5-turbo",
            "messages" => $history,
            "temperature" => 0.5,
            "max_tokens" => 1000,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ];
        $complete = $open_ai->chat($opt);
        // pr($complete); die;
        $data = json_decode($complete, true);
        $content = $data["choices"][0]["message"]["content"];
        return $content;
    }

    /*---------for url to text and get Social Media close------------*/

    /*---------for keyword and generate Social Media start------------*/

    public function generate_socialmedia($input)
    {
        // $keyword = $this->input->post('keyword');
        $keyword = $input;

        $openAISecretKey = $this->openaikey ;

        // Initialize OpenAI
        $open_ai = new OpenAi($openAISecretKey);

        // Define the prompt based on the keyword
        // $prompt = "Create only 1 quiz questions on the topic of $keyword. For each question, provide 4 answer options (A, B, C, D), and mark the correct answer. Ensure the questions are well-structured and cover various aspects of the topic. The difficulty level should be a mix of easy, moderate, and challenging.";

        $prompt =
            "I want to generate promotion Social Media using this text" . $keyword;
        $history[] = ["role" => "user", "content" => $prompt];

        $opt = [
            "model" => "gpt-3.5-turbo",
            "messages" => $history,
            "temperature" => 0.5,
            "max_tokens" => 1000,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ];
        $complete = $open_ai->chat($opt);
        // pr($complete); die;
        $data = json_decode($complete, true);
        $content = $data["choices"][0]["message"]["content"];

        // pr($content); die('123456');
        return $content;
    }
   
   
    public function generate_keynote($businessname,$offer,$contact)
    {
        // $keyword = $this->input->post('keyword');

        $openAISecretKey = $this->openaikey ;

        // Initialize OpenAI
        $open_ai = new OpenAi($openAISecretKey);

        // Define the prompt based on the keyword
        // $prompt = "Create only 1 quiz questions on the topic of $keyword. For each question, provide 4 answer options (A, B, C, D), and mark the correct answer. Ensure the questions are well-structured and cover various aspects of the topic. The difficulty level should be a mix of easy, moderate, and challenging.";

        $prompt =
            "Generate a compelling 20-word short description for an Social Media prompt using the following details: 
            Business/Service Name: '".$businessname."' 
            Message: '".$offer."' 
            Contact Information: '".$contact."'
            Ensure it's engaging, persuasive, and encourages action";
        $history[] = ["role" => "user", "content" => $prompt];

        $opt = [
            "model" => "gpt-3.5-turbo",
            "messages" => $history,
            "temperature" => 0.5,
            "max_tokens" => 1000,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
        ];
        $complete = $open_ai->chat($opt);
        // pr($complete); die;
        $data = json_decode($complete, true);
        $content = $data["choices"][0]["message"]["content"];

        // pr($content); die('123456');
        return $content;
    }

    /*---------for keyword and generate Social Media close------------*/
}
?>
