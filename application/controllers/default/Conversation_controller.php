<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/chat/autoload.php';
require_once(APPPATH . 'libraries/tcpdf/TCPDF/tcpdf.php');

require('AppDefault.php');
require_once APPPATH . 'libraries/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Conversation_controller extends AppDefault
{

    public function __construct()
    {

        parent::__construct();
        $this->checkAlreadyLogout();
        $this->Common_Model->checkSubDomain();
        $this->load->model('default/library_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->model_folder = $this->config->item('template');
        $this->load->model($this->model_folder . "Conversation_Model");
        $this->load->library('pdf');
        $this->logged_in = $this->session->userdata('logged_in');
        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];
        $this->business_id = !empty($this->session->userdata('business_id')) ? $this->session->userdata('business_id') : '1';
        $this->assets_folder = $this->config->item('assetsTemplatePath');
        $this->user_id = $this->session->userdata('logged_in')['id'];
        $this->upload_folder = $this->config->item('uploadPath');
        $this->title = '';
        $this->htmlHead = '';
        $this->htmlBody = '';
    }



    public function index()
    {
        $this->checkassitant($_POST['assistant_id']);
        if (!empty($_POST['chat_id'])) {
            $data['continue_chat_id'] = $_POST['chat_id'];
        } else {
            $data['last_chatid'] = $this->Conversation_Model->getLastChatID($_POST['assistant_id']);
            if (empty($data['last_chatid'])) {
                $this->Conversation_Model->createChat($_POST['assistant_id']);
                $data['last_chatid'] = $this->Conversation_Model->getLastChatID($_POST['assistant_id']);
            }
        }
        $data["user_id"] = $this->session->userdata('logged_in')['id'];
        $data["business_id"] = $this->session->userdata('business_id');
        $data["userData"] = $this->session->userdata('logged_in');
        $data["assistant_id"] = $_POST['assistant_id'];
        $data['assistantData'] = $this->Conversation_Model->getAssistantData($_POST['assistant_id']);
        $data['assistantData']->category_image =  $this->config->item("assetsPath") . "default/va/" .  $data['assistantData']->category_image;
        // pr($data['assistantData']);
        // die;
        $data['assistantChatInfo'] = $this->Conversation_Model->getAssistantInfo($_POST['assistant_id']);
        $data['footer_unactive'] = 'no';
        // pr($data);die;
        
        // if($this->user_id == 1){
            
        $this->loadView('conversation/agentconversation.php', $data);
        // }else{
            
        // $this->loadView('conversation/conversation', $data);
        // }

    }
    
    public function conversationMedia()
    {
    //   pr($this->getMediaVaID()); die;
        $_POST['assistant_id'] = $this->getMediaVaID();
        $this->checkassitant($_POST['assistant_id']);
        if (!empty($_POST['chat_id'])) {
            $data['continue_chat_id'] = $_POST['chat_id'];
        } else {
            $data['last_chatid'] = $this->Conversation_Model->getLastChatID($_POST['assistant_id']);
            if (empty($data['last_chatid'])) {
                $this->Conversation_Model->createChat($_POST['assistant_id']);
                $data['last_chatid'] = $this->Conversation_Model->getLastChatID($_POST['assistant_id']);
            }
        }
        $data["user_id"] = $this->session->userdata('logged_in')['id'];
        $data["business_id"] = $this->session->userdata('business_id');
        $data["userData"] = $this->session->userdata('logged_in');
        $data["assistant_id"] = $_POST['assistant_id'];
        $data['assistantData'] = $this->Conversation_Model->getAssistantData($_POST['assistant_id']);
        $data['assistantData']->category_image =  $this->config->item("assetsPath") . "default/va/" .  $data['assistantData']->category_image;
        // pr($data['assistantData']);
        // die;
        $data['assistantChatInfo'] = $this->Conversation_Model->getAssistantInfo($_POST['assistant_id']);
        // pr($data);die;
        
        // if($this->user_id == 1){
            
        $this->loadView('conversation/conversation', $data);
        // }else{
            
        // $this->loadView('conversation/conversation', $data);
        // }

    }


    ///// gaurav Function

    public function conversationList()
    {
        
        $yesterday_time = time() - (24 * 60 * 60);

        $this->db->select('SQL_CALC_FOUND_ROWS chat.id', FALSE);        
        $this->db->select('chat.id, chat.business_id,chat.prompt_id, chat.chat_name, chat.created_at, prompts.purpose as purpose,prompts.assistant_status,prompt_category.category_name');

        $this->db->join('prompts', 'prompts.id = chat.prompt_id', 'left');      
        $this->db->join('prompt_category', 'prompt_category.id = prompts.niche', 'left');      
        // $this->db->where('prompts.appoint_status', 1);
        // $this->db->where('prompts.assistant_status', 'default');
        $this->db->where_in('assistant_status', ['default','super_va','super_vachat']);
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
     
	
		$this->db->group_by('chat.id');
        $data['lists'] = $this->db->get('chat')->result_array();
        // pr($this->db->last_query());
        // pr($data['lists']);
        // die;
        $this->loadView('conversation/conversation-list',$data);
    }

    public function deleteConversation()
    {
        $id = $this->input->post('id');
        $chatdata =  $this->db->where('id',$id)->get('chat')->row();
        $this->checkassitant($chatdata->prompt_id);
        // $response = $this->Campaign_Model->delete_campaign($id );
        $this->db->where('business_id', $this->business_id);
        $this->db->where('id', $id);
        $this->db->delete('chat');



        $this->db->where('business_id', $this->business_id);
        $this->db->where('chat_id', $id);
        $this->db->delete('chatgpt');


            $this->Common_Model->set_user_logs('Delete Conversation Setting', 'Delete Conversation Setting');
        $response['status'] = 'success';
        echo json_encode($response);
        die;
    }

    public function deleteConversationMultiple()
    {
        
        $idArray = $_POST['ids'];
        // $idArray = explode(",", $this->input->get('id_data'));

        foreach ($idArray as $key => $val) {
            $this->db->where('id', $val);
            $this->db->delete('chat');
            $this->db->where('chat_id', $val);
            $this->db->delete('chatgpt');
        }
        $this->Common_Model->set_user_logs('Delete Conversation Setting', 'Delete Conversation Setting');
        $output['success'] = array('message' => 'Conversation Deleted Successfully.');
        echo json_encode($output);
        die;
    }

    public function getConversationList()
    {
        $data = $this->getPeramitter();
        $response = $this->Conversation_Model->get_list_data($data);

        echo json_encode($response);
    }

    public function getPeramitter()
    {
        $current_page = isset($_POST['current_page']) ? $this->input->post('current_page') : 1;
        $data = array(
            'search_key' => '',
            'items_per_page' => 10,
            'start' => 1,
            'current_page' => 1,
        );

        if (isset($_POST['search_key'])) {
            $data['search_key'] = $_POST['search_key'];
        }

        if (isset($_POST['items_per_page'])) {
            $data['items_per_page'] = $_POST['items_per_page'];
        }

        if (isset($_POST['current_page'])) {
            $data['current_page'] = $_POST['current_page'];
        }

        return $data;
    }

     public function getHeader()
    {
        $return = 'EOH 
        <html xmlns:v="urn:schemas-microsoft-com:vml" 
        xmlns:o="urn:schemas-microsoft-com:office:office" 
        xmlns:w="urn:schemas-microsoft-com:office:word" 
        xmlns="http://www.w3.org/TR/REC-html40"> 
         
        <head> 
        <meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
        <meta name=ProgId content=Word.Document> 
        <meta name=Generator content="Microsoft Word 9"> 
        <meta name=Originator content="Microsoft Word 9"> 
        <!--[if !mso]> 
        <style> 
        v\:* {behavior:url(#default#VML);} 
        o\:* {behavior:url(#default#VML);} 
        w\:* {behavior:url(#default#VML);} 
        .shape {behavior:url(#default#VML);} 
        </style> 
        <![endif]--> 
        <title>$this->title</title> 
        <!--[if gte mso 9]><xml> 
         <w:WordDocument> 
          <w:View>Print</w:View> 
          <w:DoNotHyphenateCaps/> 
          <w:PunctuationKerning/> 
          <w:DrawingGridHorizontalSpacing>9.35 pt</w:DrawingGridHorizontalSpacing> 
          <w:DrawingGridVerticalSpacing>9.35 pt</w:DrawingGridVerticalSpacing> 
         </w:WordDocument> 
        </xml><![endif]--> 
        <style> 
        <!-- 
         /* Font Definitions */ 
        @font-face 
            {font-family:Verdana; 
            panose-1:2 11 6 4 3 5 4 4 2 4; 
            mso-font-charset:0; 
            mso-generic-font-family:swiss; 
            mso-font-pitch:variable; 
            mso-font-signature:536871559 0 0 0 415 0;} 
         /* Style Definitions */ 
        p.MsoNormal, li.MsoNormal, div.MsoNormal 
            {mso-style-parent:""; 
            margin:0in; 
            margin-bottom:.0001pt; 
            mso-pagination:widow-orphan; 
            font-size:7.5pt; 
                mso-bidi-font-size:8.0pt; 
            font-family:"Verdana"; 
            mso-fareast-font-family:"Verdana";} 
        p.small 
            {mso-style-parent:""; 
            margin:0in; 
            margin-bottom:.0001pt; 
            mso-pagination:widow-orphan; 
            font-size:1.0pt; 
                mso-bidi-font-size:1.0pt; 
            font-family:"Verdana"; 
            mso-fareast-font-family:"Verdana";} 
        @page Section1 
            {size:8.5in 11.0in; 
            margin:1.0in 1.25in 1.0in 1.25in; 
            mso-header-margin:.5in; 
            mso-footer-margin:.5in; 
            mso-paper-source:0;} 
        div.Section1 
            {page:Section1;} 
        --> 
        </style> 
        <!--[if gte mso 9]><xml> 
         <o:shapedefaults v:ext="edit" spidmax="1032"> 
          <o:colormenu v:ext="edit" strokecolor="none"/> 
         </o:shapedefaults></xml><![endif]--><!--[if gte mso 9]><xml> 
         <o:shapelayout v:ext="edit"> 
          <o:idmap v:ext="edit" data="1"/> 
         </o:shapelayout></xml><![endif]--> 
         
        </head> 
        <body> ';
        // EOH;
        return $return;
    }

    public function getFotter()
    {
        return "</body></html>";
    }

    public function setDocFileName($docfile)
    {
        $this->docFile = $docfile;
        if (!preg_match("/\.doc$/i", $this->docFile) && !preg_match("/\.docx$/i", $this->docFile)) {
            $this->docFile .= '.doc';
        }
        return;
    }

    public function _parseHtml($html)
    {
        $html = preg_replace("/<!DOCTYPE((.|\n)*?)>/ims", "", $html);
        $html = preg_replace("/<script((.|\n)*?)>((.|\n)*?)<\/script>/ims", "", $html);
        preg_match("/<head>((.|\n)*?)<\/head>/ims", $html, $matches);
        $head = !empty($matches[1]) ? $matches[1] : '';
        preg_match("/<title>((.|\n)*?)<\/title>/ims", $head, $matches);
        $this->title = !empty($matches[1]) ? $matches[1] : '';
        $html = preg_replace("/<head>((.|\n)*?)<\/head>/ims", "", $html);
        $head = preg_replace("/<title>((.|\n)*?)<\/title>/ims", "", $head);
        $head = preg_replace("/<\/?head>/ims", "", $head);
        $html = preg_replace("/<\/?body((.|\n)*?)>/ims", "", $html);

        $this->htmlHead = $head;
        $this->htmlBody = $html;
        return;
    }

    public function downloadConversation()
    {

        // echo("I am in DonloadConversation controller");
        $id = $this->input->get('id');

        $text = '';
        $generate_html = $this->Conversation_Model->get_conversation_details($id);

        // echo("<pre>");
        // print_r($generate_html);
        // echo("</pre>");
        // die;

        foreach ($generate_html as $row) {
            if(!empty($row['human'])){
                 $text .= "<span><b>Human:</b>" . $row['human'] . "<br></span>";
            }
            if(!empty($row['ai'])){
                 $text .= "<span style='white-space: pre-line'><b>AI:</b>" . $row['ai'] . "<br></span>"; 
            }
           
        }
        
        $this->Common_Model->set_user_logs('Download Conversation', 'Download Conversation');
        
        if($this->input->get('type') == "word"){
            $this->_parseHtml($text);
            $this->setDocFileName(time());
            $doc = $this->getHeader();
            $doc .= $this->htmlBody;
            $doc .= $this->getFotter();
            @header("Cache-Control: "); // leave blank to avoid IE errors 
            @header("Pragma: "); // leave blank to avoid IE errors 
            @header("Content-type: application/octet-stream");
            @header("Content-Disposition: attachment; filename=\"$this->docFile\"");
            echo $doc;
            return true;
        }elseif($this->input->get('type') == "pdf"){
            
            $pdf_content = $this->generatePdf($text);
          
            $pdf_filename = 'conversation.pdf';

            header('Content-Type: application/pdf');
            header("Content-Disposition: attachment; filename=\"$pdf_filename\"");
            echo $pdf_content;
            return true;
            
        }elseif($this->input->get('type') == "text"){
            header('Content-Type: text/plain');
            header("Content-Disposition: attachment; filename=\"conversation.txt\"");
            $text = preg_replace('/<[^>]*>/', '', $text);
           echo $text;
          return true;
        }
    }
    
      public function generatePdf($text)
        {
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Conversation');
            $pdf->SetSubject('Conversation PDF');
            $pdf->SetKeywords('Conversation, PDF, export');
            $pdf->SetFont('helvetica', '', 11);
            $pdf->AddPage();
            $pdf->writeHTML($text, true, false, true, false, '');
            return $pdf->Output('conversation.pdf', 'S');
        }


    //// end gaurav function

    public function getConversation()
    {

        $post_data = json_decode(file_get_contents('php://input'), true);
        $chattype = $post_data['chattype'];
        $this->db->where('id', $post_data['chat_id']);
        $chat_setting = $this->db->get('chat')->row();

        $this->db->where('business_id', $this->business_id);
        $this->db->where('chat_id', $post_data['chat_id']);
        if(!empty($chattype) && $chattype == "image"){
            $this->db->order_by('id', 'DESC');
        }
        $chat = $this->db->get('chatgpt')->result();

        $result = array(
            'status' => 1,
            'chat_setting' => $chat_setting,
            'chats' => $chat,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function getchattitle()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);

        $data = $this->Conversation_Model->getChatTitle($this->business_id, $post_data['assistant_id']);
        $assistantData = $data['astdata'];
        $user_name = $this->session->userdata('logged_in')['name'];
        if($assistantData->assistant_status == 'super_va' || $assistantData->assistant_status == 'super_vachat'){
        //   $va_first_message = 'Hi ' . $user_name . ', I am getaisupreme ( Your Super VA ) How may I help you today?';
        $va_first_message = 'Hi ' . $user_name . ', I am ' . $assistantData->name . ', your ' . $assistantData->category_name . '. How can I assist you today?';

        }else{
            // $va_first_message = 'Hi ' . $user_name . ', I am getaisupreme ( Your Super VA ) and I have expertise in ' . $assistantData->prompt_cat . ' too. How may I help you today?';
           $va_first_message = 'Hi ' . $user_name . ', I am ' . $assistantData->name . ', your ' . $assistantData->category_name . '. How can I assist you today?';

            
        }
        $array = [
            'business_id' => $this->business_id,
            'prompt_id' => $post_data['assistant_id'],
            'chat_id' => $data['chat_id'],
            'ai' => $va_first_message,
            'type' => 'chatgpt'
        ];
        $this->db->insert('chatgpt', $array);
        $result = array(
            'status' => 1,
            'chat_id' => $data['chat_id'],
            'purpose'=>$data['purpose'],
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function getchatlist()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        // pr($post_data);
        // die();

        $chatlist = $this->Conversation_Model->getChatlist($this->business_id, $post_data['assistant_id']);
        $result = array(
            'status' => 1,
            'chatlist' => $chatlist,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function images()
    {
        header("access-control-allow-headers: origin, x-requested-with, content-type");
        header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
        header('Access-Control-Allow-Origin: *');

        $post_data = json_decode(file_get_contents('php://input'), true);
        if ($this->input->post()) {
            $apiData = $this->ownerAikey();
            if($apiData['status'] == 'nocount' && empty($apiData['key'])){ 
                $result = array(
                    'status' => 'failed',
                    'msg' => "You don't have more Credit."
                );
                 echo json_encode($result);
                    die;
            }
            

            $keyword = $post_data['keyword'];
            $data = array(
                'prompt_id' => $post_data['assistant_id'],
                'chat_id' => $post_data['chat_id'],
                'human' => $keyword,
                'type' => $post_data['type'],
                'business_id' => $this->business_id,
            );
            $this->db->insert('chatgpt', $data);
            $id = $this->db->insert_id();

            $data['id'] = $id;
            $data['keyword'] = $keyword;


            $result = array(
                'status' => 'success',
                'data' => $data,
                'msg' => 'Success'
            );
            echo json_encode($result);
            die;
        }
    }

    public function imageResponseToHtml()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        // pr($post_data);die;
        // $output['imagesList'] = $post_data;
        $html = '';
        $html .= '<div class="row">';
        foreach ($post_data as $key => $image) {
            // pr($image);die;
            $html .= '<div class="col-md-4 mb-3">
					<div class="card pixabay-images">
						<img src="' . $image['largeImageURL'] . '" alt="Image" class="img-fluid d-block mx-auto ">

					</div> </div>';
        }
        $html .= '</div>';
        $response = array(
            'status' => 1,
            'html' => $html,
        );

        echo json_encode($response);
        die;
    }

    public function saveImageUrl()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        // pr($post_data);die;
        // pr($post_data);


        // pr($post_data);

        $image_url = $post_data['image_url'];

        $this->db->where('prompt_id', $post_data['assistant_id']);
        $this->db->where('id', $post_data['chatgpt_id']);
        $this->db->update('chatgpt', array('ai' => $image_url));

        $response = array(
            "status" => 1,
            "msg" => "Save Successfully",
            "id" => $post_data['chat_id']

        );
 $this->Common_Model->set_user_logs('Conversation Image save', 'Conversation Image save');
        echo json_encode($response);
        die;
    }

    /* look for ajax request to search pixabay or pexels api */
    public function searchImages()
    {
        if ($this->input->is_ajax_request()) {
            
            $apiData = $this->ownerAikey();
            if($apiData['status'] == 'nocount' && empty($apiData['key'])){ 
               $result['error'] = "You don't have more Credit.";
                 echo json_encode($result);
                    die;
            }
            
            

            $criteria = $this->input->post('criteria');
            if ($criteria == 'gifs') {
                $data = $this->getGiphy('gifs');
            } else if ($criteria == 'stickers') {
                // $data = $this->getGiphy('stickers');
            } else if ($criteria == 'videos') {
                $data = $this->getVideoFromPexels();
            } else {
                $data = $this->getImagesFromPexels();
            }
            echo json_encode($data);
            die();
        }
        // redirect('dashboard');
    }

//     /* get images from pexels with API call */
//     private function getImagesFromPexels()
//     {
//         $key = "563492ad6f91700001000001058a23d1f89841b9ae8060ffd2b5abca";
//         $url = "https://api.pexels.com/v1/search?";
//         $query = $this->input->post('q');
//         $page = $this->input->post('page');
//         $per_page = 8;
//         $urlToHit = $url . http_build_query(compact('query', 'page', 'per_page'));
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $urlToHit);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // true: follow redirects
//         curl_setopt($ch, CURLOPT_MAXREDIRS, 1); // 1: max 1 redirect
//         curl_setopt($ch, CURLOPT_AUTOREFERER, true); // true: set referer on redirect
//         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // timeout on connect
//         curl_setopt($ch, CURLOPT_TIMEOUT, 120); // timeout on response
//         curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0"); // true: follow redirects
//         curl_setopt($ch, CURLOPT_HEADER, false); // false: do not print headers
//         curl_setopt($ch, CURLOPT_HTTPHEADER, [
//             'Content-type: application/json',
//             'Authorization: ' . $key
//         ]);
//         $result = curl_exec($ch);
//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//         curl_close($ch);
//         if ($httpCode == 200) {
//             $result = json_decode($result);
//             $data = array();
//             if ($result && property_exists($result, "photos")) {
//                 $photos = $result->photos;
//                 foreach ($photos as $key => $value) {
//                     //echo"<pre>";print_r($value); die('sRahul');
//                     $data[$key]['file_type'] = "image";
//                     $data[$key]['largeImageURL'] = $value->src->large;
//                     $data[$key]['previewURL'] = $value->src->medium;
//                     $data[$key]['id'] = $value->id;
//                     $data[$key]['title'] = $value->alt;
//                 }
//             }
//             return $data;
//         }
//         // $data['error'] = "Invalid API Key for Pexels!";
//         return $data;
//     }
    
//     private function getGiphy ($Giphy)
// 	{
// 		$apiKey = config_item('conversation_api_key');		
// 		$url 		= "https://api.giphy.com/v1/".$Giphy."/search?";
// 		$keyword		= $this->input->post('q');
// 		$page 		= $this->input->post('page');
// 		$limit 	= 8 ;
	
// 		$params = http_build_query([
// 			'q'			=> $keyword,
// 			'api_key'   => $apiKey,
// 			'limit'		=> $limit,
// 			'page'	=> $page,
// 			'offset'	=> $limit*$page
// 		]);
// 		 $urldata = $url.$params;
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, $urldata);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
// 		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			
// 		curl_setopt($ch, CURLOPT_AUTOREFERER, true);	
// 		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	
// 		curl_setopt($ch, CURLOPT_TIMEOUT, 120);			
// 		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	
// 		curl_setopt($ch, CURLOPT_HEADER, false);		

// 		$result = curl_exec($ch);

// 		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				
// 		curl_close($ch);
// 		if ($httpCode == 200) {
// 			$json_result = json_decode($result);
// 			$data 	= array();
// 			if ($json_result->data) {
// 				$photos = $json_result->data;
// 				foreach ($photos as $key => $value) {
				
// 				$giphyUrl = $value->images->original->url;
// 				//echo"<pre>";print_r($value); die();
// 					$data[$key]['file_type'] 		= $Giphy;
// 					$data[$key]['largeImageURL'] 	= $giphyUrl;
// 					$data[$key]['previewURL'] 		= $giphyUrl;
// 					$data[$key]['id'] 				= $value->id;
// 					$data[$key]['title'] 			= $value->title;
// 				}
// 			}
// 			return $data;
// 		}
// 		return $data;		
// 	}
	
// 	private function getVideoFromPexels ()
// 	{
// 		$key = "563492ad6f91700001000001058a23d1f89841b9ae8060ffd2b5abca";
// 		$url 		= "https://api.pexels.com/videos/search?";
// 		$query		= $this->input->post('q');
// 		$page 		= $this->input->post('page');
// 		$per_page 	= 8;
// 		$urlToHit 	= $url . http_build_query(compact('query','page','per_page'));
// 		$ch 		= curl_init();
// 		curl_setopt($ch, CURLOPT_URL, $urlToHit);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	// true: follow redirects
// 		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			// 1: max 1 redirect
// 		curl_setopt($ch, CURLOPT_AUTOREFERER, true);	// true: set referer on redirect
// 		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	// timeout on connect
// 		curl_setopt($ch, CURLOPT_TIMEOUT, 120);			// timeout on response
// 		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	// true: follow redirects
// 		curl_setopt($ch, CURLOPT_HEADER, false);		// false: do not print headers
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, [
// 			'Content-type: application/json',
// 			'Authorization: ' . $key
// 		]);
// 		$result = curl_exec($ch);
// 		curl_close($ch);
// 		$json_result = json_decode ($result);
    
// 			$data 	= array();
// 				$hits = $json_result->videos;
// 				foreach ($hits as $key => $value) {
// 				    //echo"<pre>";print_r($value->video_pictures); die('sRahul');
// 					$data[$key]['file_type'] 	= "video";
// 					$data[$key]['large_video'] 	    = $value->video_files['1']->link;
// 					$data[$key]['small_video'] 	    = $value->video_files['0']->link;
// 					$data[$key]['id'] 			    = $value->id;
// 					$data[$key]['largeImageURL']    = $value->video_pictures['0']->picture;
// 					$data[$key]['title'] 			= "";
// 				}
// 		return $data;		
// 	}
	

//     /// get images by pexel using on chat script 
//     public function getImagesPexel()
    // {
    //     if ($this->input->post()) {
    //         $type = $this->input->post('type');
    //         if ($type == 'gifs') {
    //             $data = $this->getGiphy('gifs');
    //         } else if ($type == 'stickers') {
    //             $data = $this->getGiphy('stickers');
    //         } else if ($type == 'videos') {
    //             $data = $this->getVideoFromPexels();
    //         } else if ($type == 'images') {
    //             $data = $this->getImagesFromPexels();
    //         }
    //         $html = '';
    //         foreach ($data as $key => $value) {
    //             $html .= '<div><img src="' . $value['previewURL'] . '" alt="' . $value['title'] . '"></div><br>';
    //         }
    //         // if (!empty($html)) {
    //         // 	$response = array(
    //         // 		'status' => 1,
    //         // 		'html' => $html,
    //         // 	);
    //         // } else {
    //         // 	$response = array(
    //         // 		'status' => 1,
    //         // 		'html' => $html,
    //         // 	);
    //         // }
    //         return json_encode($html);
    //     }
    // }
    
    
    private function getImagesFromPexels()
    {
        $key = "563492ad6f91700001000001058a23d1f89841b9ae8060ffd2b5abca";
        $url = "https://api.pexels.com/v1/search?";
        $query = $this->input->post('q');
        $page = $this->input->post('page');
        $per_page   = $this->input->post('per_page');
        $urlToHit = $url . http_build_query(compact('query', 'page', 'per_page'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlToHit);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // true: follow redirects
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1); // 1: max 1 redirect
        curl_setopt($ch, CURLOPT_AUTOREFERER, true); // true: set referer on redirect
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // timeout on connect
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // timeout on response
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0"); // true: follow redirects
        curl_setopt($ch, CURLOPT_HEADER, false); // false: do not print headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/json',
            'Authorization: ' . $key
        ]);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200) {
            $result = json_decode($result);
            $data = array();
            if ($result && property_exists($result, "photos")) {
                $photos = $result->photos;
                foreach ($photos as $key => $value) {
                    //echo"<pre>";print_r($value); die('sRahul');
                    $data[$key]['file_type'] = "image";
                    $data[$key]['largeImageURL'] = $value->src->large;
                    $data[$key]['previewURL'] = $value->src->medium;
                    $data[$key]['id'] = $value->id;
                    $data[$key]['title'] = $value->alt;
                }
            }
            return $data;
        }
        // $data['error'] = "Invalid API Key for Pexels!";
        return $data;
    }
    
    private function getGiphy ($Giphy)
	{
		$apiKey = config_item('conversation_api_key');		
		$url 		= "https://api.giphy.com/v1/".$Giphy."/search?";
		$keyword		= $this->input->post('q');
		$page 		= $this->input->post('page');
		$limit 	= $this->input->post('per_page');
	
		$params = http_build_query([
			'q'			=> $keyword,
			'api_key'   => $apiKey,
			'limit'		=> $limit,
			'page'	=> $page,
			'offset'	=> $limit*$page
		]);
		 $urldata = $url.$params;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urldata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	
		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);	
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);			
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	
		curl_setopt($ch, CURLOPT_HEADER, false);		

		$result = curl_exec($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				
		curl_close($ch);
		if ($httpCode == 200) {
			$json_result = json_decode($result);
			$data 	= array();
			if ($json_result->data) {
				$photos = $json_result->data;
				foreach ($photos as $key => $value) {
				
				$giphyUrl = $value->images->original->url;
				//echo"<pre>";print_r($value); die();
					$data[$key]['file_type'] 		= $Giphy;
					$data[$key]['largeImageURL'] 	= $giphyUrl;
					$data[$key]['previewURL'] 		= $giphyUrl;
					$data[$key]['id'] 				= $value->id;
					$data[$key]['title'] 			= $value->title;
				}
			}
			return $data;
		}
		return $data;		
	}
	
	private function getVideoFromPexels ()
	{
		$key = "563492ad6f91700001000001058a23d1f89841b9ae8060ffd2b5abca";
		$url 		= "https://api.pexels.com/videos/search?";
		$query		= $this->input->post('q');
		$page 		= $this->input->post('page');
		$per_page 	= $this->input->post('per_page');
		$urlToHit 	= $url . http_build_query(compact('query','page','per_page'));
		$ch 		= curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlToHit);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);	// true: follow redirects
		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);			// 1: max 1 redirect
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);	// true: set referer on redirect
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);	// timeout on connect
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);			// timeout on response
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:59.0) Gecko/20100101 Firefox/59.0");	// true: follow redirects
		curl_setopt($ch, CURLOPT_HEADER, false);		// false: do not print headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-type: application/json',
			'Authorization: ' . $key
		]);
		$result = curl_exec($ch);
		curl_close($ch);
		$json_result = json_decode ($result);
    
			$data 	= array();
				$hits = $json_result->videos;
				foreach ($hits as $key => $value) {
				    //echo"<pre>";print_r($value->video_pictures); die('sRahul');
					$data[$key]['file_type'] 	= "video";
					$data[$key]['large_video'] 	    = $value->video_files['1']->link;
					$data[$key]['small_video'] 	    = $value->video_files['0']->link;
					$data[$key]['id'] 			    = $value->id;
					$data[$key]['largeImageURL']    = $value->video_pictures['0']->picture;
					$data[$key]['title'] 			= "";
				}
		return $data;		
	}
	

    /// get images by pexel using on chat script 
    public function getImagesPexel()
    {
        if ($this->input->post()) {
            $type = $this->input->post('type');
            if ($type == 'gifs') {
                $data = $this->getGiphy('gifs');
            } else if ($type == 'stickers') {
                $data = $this->getGiphy('stickers');
            } else if ($type == 'videos') {
                $data = $this->getVideoFromPexels();
            } else if ($type == 'images') {
                $data = $this->getImagesFromPexels();
            }
            $html = '';
            foreach ($data as $key => $value) {
                $html .= '<div><img src="' . $value['previewURL'] . '" alt="' . $value['title'] . '"></div><br>';
            }
            // if (!empty($html)) {
            // 	$response = array(
            // 		'status' => 1,
            // 		'html' => $html,
            // 	);
            // } else {
            // 	$response = array(
            // 		'status' => 1,
            // 		'html' => $html,
            // 	);
            // }
            return json_encode($html);
        }
    }

    public function chat()
    {
        header("access-control-allow-headers: origin, x-requested-with, content-type");
        header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
        header('Access-Control-Allow-Origin: *');

        $post_data = json_decode(file_get_contents('php://input'), true);
        if ($this->input->post()) {
        
            $apiData = $this->ownerAikey();
            if($apiData['status'] == 'nocount' && empty($apiData['key'])){ 
                $result = array(
                    'status' => 'failed',
                    'msg' => "You don't have more Credit."
                );
                 echo json_encode($result);
                    die;
            }

            $user_question = $post_data['message'];

            $data = array(
                'prompt_id' => $post_data['assistant_id'],
                'chat_id' => $post_data['chat_id'],
                'human' => $user_question,
                'type' => $post_data['type'],
                'business_id' => $this->business_id,
            );
            $this->db->insert('chatgpt', $data);
            // echo $this->db->last_query(); die('a');
            $id = $this->db->insert_id();
            // print_r($id);
            // die;
            $data['id'] = $id;
            $data['user_question'] = $user_question;
            $result = array(
                'status' => 'success',
                'data' => $data,
                'msg' => 'Success'
            );
           
            echo json_encode($result);
            die;
        }
    }
    
    
    public function saveCurlFiles(){
        $post_data = json_decode(file_get_contents('php://input'), true);
        // pr($post_data);
        $jsonArray = [];
        $oldjsonArray = [];
        if($post_data['page'] > 1){
            $this->db->where('id', $post_data['id']);
            $chatArray = $this->db->get('chatgpt')->row();
            $oldjsonArray = json_decode($chatArray->ai,true);
        }   
        
        // die;
         foreach($post_data['data'] as $key => $val){
             if($val['file_type'] == 'video'){
                $jsonArray[] = $val;
                $file_type = 'videos';
             }else{
                $file_type = 'stockimage';
                $jsonArray[] = $val;
             }
         }
        $mainArray= array_merge($oldjsonArray,$jsonArray);
        $this->db->where('id', $post_data['id']);
        $this->db->update('chatgpt', array('ai' => json_encode($mainArray) , 'type' =>$file_type));
        $this->Common_Model->set_user_logs('Conversation chat update', 'Conversation chat update');
    }



    // public function openai()
    // {
 
    //     //  pr($_POST);
    //     // die;
    //     header('Content-Type: text/html; charset=UTF-8');
    //     header("access-control-allow-headers: origin, x-requested-with, content-type");
    //     header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    //     header('Access-Control-Allow-Origin: *');
    //     /*  ini_set('display_errors', 1);
    //               ini_set('display_startup_errors', 1);
    //               error_reporting(E_ALL);*/
    //     $post_data = json_decode(file_get_contents('php://input'), true);

    //     if ($this->input->post()) {
    //         define('ROLE', 'role');
    //         define('CONTENT', 'content');
    //         define('USER', 'user');
    //         define('SYS', 'system');
    //         define('ASSISTANT', 'assistant');
    //         $apiData = $this->ownerAikey();
    //         $open_ai_key = $apiData['key'];
    //         $this->db->where('id', $this->user_id);
    //         $userData = $this->db->get('tbl_user')->row();
            
    //         if($apiData['status'] == 'nocount' && empty($apiData['key'])){ 
    //             $result = array(
    //                 'status' => 0,
    //                 'msg' => "You don't have more Credit."
    //             );
    //              echo json_encode($result);
    //                 die;
    //         }
    //       /*  if($this->user_id==21){*/
    //         //   print_r($apiData); 
    //         //   die;
          
    //         // if(empty($open_ai_key)){
    //         //     $open_ai_key = config_item('openai_key_legacy');
    //         // }
    //         $open_ai = new OpenAi($open_ai_key);
    //         $history[] = [ROLE => SYS, CONTENT => "You are a helpful assistant."];
    //         $business_id = $this->business_id;

    //         $this->db->where('type', 'chatgpt');
    //         $this->db->where('business_id', $this->business_id);
    //         $this->db->where('chat_id', $post_data['chat_id']);
    //         $this->db->order_by("id", "asc");
    //         $query = $this->db->get('chatgpt');
    //         $row = $query->result_array();

    //         $this->db->where('business_id', $this->business_id);
    //         $this->db->where('id', $post_data['assistent_id']);
    //         $query1 = $this->db->get('prompts');

    //         $langulage = $query1->result_array();
            
    //         /// add this remove regenrate issue;
    //         if($post_data['action'] == 'regenerate'){
    //             foreach ($row as $val) {
    //                 if (!empty($val['human'])) {
    //                     $history[] = [ROLE => USER, CONTENT => $val['human']];
    //                 }
    
    //                 if (!empty($val['ai'])) {
    //                     $history[] = [ROLE => ASSISTANT, CONTENT => $val['ai']];
    //                 }



    //             // $history[] = [ROLE => USER, CONTENT => $val['human']];
    //             }
    //         }else{
    //           foreach (array_slice($row, 1) as $val) {
    //                 if (!empty($val['human'])) {
    //                     $history[] = [ROLE => USER, CONTENT => $val['human']];
    //                 }
    
    //                 if (!empty($val['ai'])) {
    //                     $history[] = [ROLE => ASSISTANT, CONTENT => $val['ai']];
    //                 }
    //             } 
    //         }
            
    //         // pr($history);
    //         // die;


    //         header('Content-type: text/event-stream');
    //         header('Cache-Control: no-cache');
    //         $txt = "";

    //         $tones = !empty($post_data['tones']) ? $post_data['tones'] : 1.0;
    //         $token = !empty($post_data['token']) ? $post_data['token'] : 50;
    //         $opt = [
    //             'model' => 'gpt-3.5-turbo',
    //             'messages' => $history,
    //             'temperature' => intval($tones),
    //             'max_tokens' => 1000,
    //             'frequency_penalty' => 0,
    //             'presence_penalty' => 0,
    //         ];
    //         $complete = $open_ai->chat($opt);

    //         $data = json_decode($complete, true);
    //         // pr($data);
    //         // die;
    //         if(!empty($data) && !empty($data['choices'][0]['message']['content']))
    //         {
                
    //             // if($apiData['status'] == 'count' && $userData->credit > 0){
    //             //     $stringCount = strlen($data['choices'][0]['message']['content']);
    //             //     $credit = $userData->credit - $stringCount;
    //             //     $credit = $credit > 0 ? $credit : 0;
    //             //     $this->db->where('id', $this->user_id);
    //             //     $this->db->update('tbl_user', array('credit' => $credit));
    //             // }

    //             // $lng = !empty($post_data['language']) ? $post_data['language'] : $langulage[0]['language_id'];
    //             $txt = $data['choices'][0]['message']['content'];
    //             // pr($txts); die;
    //             // $tr = new GoogleTranslate('en');
    //             // $txt = $tr->setSource('en')->setTarget($lng)->translate($txts);
    //             if(!empty($txt)) {
    //             $db_host = "localhost"; // Your database host
    //             $db_user = "getultim_user";  // Your database username
    //             $db_pass = "P_wPQwqc[7G&";  // Your database password
    //             $db_name = "getultim_ultimateai";  // Your database name
                

    //           $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    //                          $sql="UPDATE `chatgpt` SET `ai` = ".'"'.$txt.'"'." WHERE `id` = $post_data[id] "; 
                             
    //             //  pr($conn); die('123');
    //             if (mysqli_query($conn, $sql));
                
    //             $affectRow = $conn->affected_rows;
                
    //             // Close the connection
    //             mysqli_close($conn);   
    //             // $data['row'] = $affectRow;
                
    //             // Sometime upper query update ai column and somtime down query update ai column so we used both query 
    //             if($affectRow == -1){
    //               $this->db->where('id', $post_data['id']);
    //                 $this->db->update('chatgpt', array('ai' => $txt));
    //             }
    //             // $data['query'] = $this->db->last_query();
                
          
    
    //             $data['status'] = 1;
    //             $data['txt'] = $txt;
    //             // $data['response'] = $data;
    
    //             echo json_encode($data);
    //             die;
    //             }
    //         }else{
    //             if(!empty($data['error']) && $data['error']['code'] == 'context_length_exceeded'){
    //                 $res = array(
    //                     'status' => 0,
    //                     'msg' => "Conversation length exceeded Please Start New Chat"
    //                 );
    //             }elseif($apiData['status'] == 'count'){
    //                 // status 2 is taking for if our open ai recharge over so take this status 
    //                 $res = array(
    //                     'status' => 2,
    //                     // 'response' => $data,
    //                     // 'msg' => "Something went Wrong"
    //                 ); 
    //             }else{
    //                  $res = array(
    //                     'status' => 0,
    //                     // 'response' => $data,
    //                     // 'key' => $this->ownerAikey(),
    //                     'msg' => "Please check your Open Ai Key"
    //                 );
    //             }
    //             echo json_encode($res);
    //             die;
    //         }
    //     }
    // }


    public function openai()
    {
        
        //  pr($_POST);
        // die;
        header('Content-Type: text/html; charset=UTF-8');
        header("access-control-allow-headers: origin, x-requested-with, content-type");
        header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
        header('Access-Control-Allow-Origin: *');
        /*  ini_set('display_errors', 1);
                  ini_set('display_startup_errors', 1);
                  error_reporting(E_ALL);*/
        $post_data = json_decode(file_get_contents('php://input'), true);

        if ($this->input->post()) {
            define('ROLE', 'role');
            define('CONTENT', 'content');
            define('USER', 'user');
            define('SYS', 'system');
            define('ASSISTANT', 'assistant');
            $apiData = $this->ownerAikey();
            $open_ai_key = $apiData['key'];
            $this->db->where('id', $this->user_id);
            $userData = $this->db->get('tbl_user')->row();
            
            if($apiData['status'] == 'nocount' && empty($apiData['key'])){ 
                $result = array(
                    'status' => 0,
                    'msg' => "You don't have more Credit."
                );
                 echo json_encode($result);
                    die;
            }
             
            // if(empty($open_ai_key)){
            //     $open_ai_key = config_item('openai_key_legacy');
            // }
            $open_ai = new OpenAi($open_ai_key);
            $history[] = [ROLE => SYS, CONTENT => "You are a helpful assistant."];
            $business_id = $this->business_id;

            $this->db->where('type', 'chatgpt');
            $this->db->where('business_id', $this->business_id);
            $this->db->where('chat_id', $post_data['chat_id']);
            $this->db->order_by("id", "asc");
            $query = $this->db->get('chatgpt');
            $row = $query->result_array();

            $this->db->where('business_id', $this->business_id);
            $this->db->where('id', $post_data['assistent_id']);
            $query1 = $this->db->get('prompts');

            $langulage = $query1->result_array();
            
            /// add this remove regenrate issue;
            if($post_data['action'] == 'regenerate'){
                foreach ($row as $val) {
                    if (!empty($val['human'])) {
                        $history[] = [ROLE => USER, CONTENT => $val['human']];
                    }
    
                    if (!empty($val['ai'])) {
                        $history[] = [ROLE => ASSISTANT, CONTENT => $val['ai']];
                    }
                // $history[] = [ROLE => USER, CONTENT => $val['human']];
                }
            }else{
               foreach (array_slice($row, 1) as $val) {
                    if (!empty($val['human'])) {
                        $history[] = [ROLE => USER, CONTENT => $val['human']];
                    }
    
                    if (!empty($val['ai'])) {
                        $history[] = [ROLE => ASSISTANT, CONTENT => $val['ai']];
                    }
                } 
            }
            
            // pr($history);
            // die;


            header('Content-type: text/event-stream');
            header('Cache-Control: no-cache');
            $txt = "";

            $tones = !empty($post_data['tones']) ? $post_data['tones'] : 1.0;
            $token = !empty($post_data['token']) ? $post_data['token'] : 50;
            $opt = [
                'model' => 'gpt-4',
                // 'model' => 'gpt-3.5-turbo',
                'messages' => $history,
                'temperature' => intval($tones),
                'max_tokens' => 1000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ];
            $complete = $open_ai->chat($opt);

            $data = json_decode($complete, true);
            
            // pr($data); die;
           
            if(!empty($data) && !empty($data['choices'][0]['message']['content']))
            {
                
                
                if($apiData['status'] == 'count' && $userData->credit > 0){
                   $response_text = $data['choices'][0]['message']['content']; 
                    $deducted_credit = ceil(strlen($response_text) / 100); // Deduct 1 credit per 100 characters
                    $this->db->set('credit', 'credit - ' . $deducted_credit, FALSE);
                    $this->db->where('id', $this->owner_id);
                    $this->db->update('tbl_user');
                }
                
                
            //      if (isset($data['choices'][0]['message']['content'])) {
            //         $response_text = $data['choices'][0]['message']['content']; 
            //         $deducted_credit = ceil(strlen($response_text) / 100); // Deduct 1 credit per 100 characters
            //         $this->db->set('credit', 'credit - ' . $deducted_credit, FALSE);
            //         $this->db->where('id', $this->owner_id);
            //         $this->db->update('tbl_user');
            // }
                
                $lng = !empty($post_data['language']) ? $post_data['language'] :26;
                $txts = $data['choices'][0]['message']['content'];
               
/*                 ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
 */

                $tr = new GoogleTranslate('en');
                $txt = $tr->setSource('en')->setTarget($lng)->translate($txts);
                if(!empty($txt)) {
                 $db_host = "localhost"; // Your database host
                $db_user = "getvisor_user";  // Your database username
                $db_pass = "42}f7Kz9DB}D";  // Your database password
                $db_name = "getvisor_db";  // Your database name
               
                $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                             $sql="UPDATE `chatgpt` SET `ai` = ".'"'.$txt.'"'." WHERE `id` = $post_data[id] "; 
                if (mysqli_query($conn, $sql));
                
                $affectRow = $conn->affected_rows;
                   
                // Close the connection
                mysqli_close($conn);   
                // $data['row'] = $affectRow;
                
                
                // Sometime upper query update ai column and somtime down query update ai column so we used both query 
                if($affectRow == -1){
                   $this->db->where('id', $post_data['id']);
                    $this->db->update('chatgpt', array('ai' => $txt));
                }
                // $data['query'] = $this->db->last_query();
                
          
    
                $data['status'] = 1;
                $data['txt'] = $txt;
                // $data['response'] = $data;
    
                echo json_encode($data);
                die;
                }
            }else{
                if(!empty($data['error']) && $data['error']['code'] == 'context_length_exceeded'){
                    $res = array(
                        'status' => 0,
                        'msg' => "Conversation length exceeded Please Start New Chat"
                    );
                }elseif($apiData['status'] == 'count'){
                    // status 2 is taking for if our open ai recharge over so take this status 
                    $res = array(
                        'status' => 2,
                        // 'response' => $data,
                        // 'msg' => "Something went Wrong"
                    ); 
                }else{
                     $res = array(
                        'status' => 0,
                        // 'response' => $data,
                        // 'key' => $this->ownerAikey(),
                        'msg' => "Please check your Open Ai Key"
                    );
                }
                 
                echo json_encode($res);
                die;
            }
        }
    }

    public function fileUpload()
    {
        if ($_POST['type'] == 'custom') {
            $new_file_name = time() . substr($_FILES["image"]['name'], strpos($_FILES["image"]['name'], '.'));
            $config['file_name'] = $new_file_name;
            $config['upload_path'] = 'assets/uploads/chat_background/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            $this->db->where('id', $_POST['chat_id']);
            $data = $this->db->get('chat')->row();
            if (!empty($data) && $data->type == 'custom') {
                if (file_exists($data->chat_bg)) {
                    unlink($data->chat_bg);
                }
            }

            if ($this->upload->do_upload('image')) {
                $imageData = $this->upload->data();
                $filename = $imageData['file_name'];

                $path = $config['upload_path'] . $filename;

                $data = array(
                    'chat_bg' => $path,
                    'type' => $_POST['type']
                );
                $this->db->where('id', $_POST['chat_id']);
                $this->db->update('chat', $data);
                $this->Common_Model->set_user_logs('Conversation file upload', 'Conversation file upload');
                $response = array(
                    'status' => 'success',
                    'path' => $path,
                    'message' => 'Image uploaded successfully'
                );
                echo json_encode($response);
            } else {
                $error = $this->upload->display_errors();
                $response = array('status' => 'failed', 'error' => $error);
                echo json_encode($response);
            }
        } else {
            $path = $_POST['image'];
            $data = array(
                'chat_bg' => $path,
                'type' => $_POST['type']
            );
            $this->db->where('id', $_POST['chat_id']);
            $this->db->update('chat', $data);
            $response = array(
                'status' => 'success',
                'path' => $path,
                'message' => 'Image uploaded successfully'
            );
            echo json_encode($response);
        }
    }

    public function getPromptCategory()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $this->db->where('subcategory_id', $post_data['id']);
        $category = $this->db->order_by('id','DESC')->get('prompt_sub_category')->result_array();
        $result = array(
            'status' => 1,
            'category' => $category,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function getPromptDetail()
    {

        $post_data = json_decode(file_get_contents('php://input'), true);

        $this->db->where('category_id', $post_data['id']);
        $prompt_detail = $this->db->order_by('id','DESC')->get('prompt_detail')->result_array();
        $result = array(
            'status' => 1,
            'prompt_detail' => $prompt_detail,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function chatUpdate()
    {

        $post_data = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $post_data['id']);
        $this->db->update('chat', ['chat_name' => $post_data['value']]);
        $result = array(
            'status' => 1,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }

    public function deleteChat()
    {

        $post_data = json_decode(file_get_contents('php://input'), true);
        $id = $post_data['id'];
        $chatdata =  $this->db->where('id',$id)->get('chat')->row();
        $count = $this->db->where('prompt_id',$chatdata->prompt_id)->count_all_results('chat');
        if($count == 1){
            $result = array(
                'status' => 0,
                'msg' => 'You do not delete your last chat',
            );   
        }else{
            $this->checkassitant($chatdata->prompt_id);
            $this->db->where('id', $post_data['id']);
            $this->db->delete('chat');
    
            $this->db->where('chat_id', $post_data['id']);
            $this->db->delete('chatgpt');
            $result = array(
                'status' => 1,
                'msg' => 'Success'
            );                             
        }
        $this->Common_Model->set_user_logs('Conversation chat delete', 'Conversation chat delete');
        echo json_encode($result);
        die;
    }


    public function chatSetting()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        if ($post_data) {
            $array = array(
                'tones' => $post_data['tones'],
                'token' => '',
                'language' => $post_data['language'],
                'purpose' => $post_data['purpose'],
            );
            $this->db->where('id', $post_data['chat_id']);
            $this->db->update('chat', $array);
            $result = array(
                'status' => 1,
                'msg' => 'Success'
            );
            echo json_encode($result);
            die;
        }
    }


    public function pdfGenerate()
    {
        $this->load->helper('download');

        $this->db->where('id', $_GET['id']);
        $chats = $this->db->get('chatgpt')->row();
        $htmlContent = $chats->ai;


        /*$this->pdf->loadHtml($htmlContent);
        $this->pdf->setBasePath(base_url());
        $this->pdf->render();
        $output = $this->pdf->output();
        $filename = 'getaisupreme.pdf';
        return force_download($filename, $output, true);*/
        $this->Common_Model->set_user_logs('Conversation file download', 'Conversation file download');
        $filename= 'getaisupreme'.time();
        	$html = $htmlContent;		
		$this->_parseHtml($html); 
        $this->setDocFileName($filename); 
        $doc = $this->getHeader(); 
        $doc .= $this->htmlBody; 
        $doc .= $this->getFotter(); 
		@header("Cache-Control: ");// leave blank to avoid IE errors 
		@header("Pragma: ");// leave blank to avoid IE errors 
		@header("Content-type: application/octet-stream"); 
		@header("Content-Disposition: attachment; filename=\"$this->docFile\""); 
		echo $doc; 
		return true; 
    }


    /* shadab Functions */

    public function addFolder()
    {
        $response = array('status' => 'error', 'message' => '', 'callback' => '', 'redirect_type' => 'angular', 'redirect_url' => '', 'insert_id' => '');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $folder_id = $this->input->post('folder_id') ? $this->input->post('folder_id') : '0';

        if ($folder_id == '') {
            $folder_id = 0;
        }


        if ($this->form_validation->run()) {

            $data = array(
                'file_name' => $this->input->post('title'),
                'file_alt_name' => $this->input->post('title'),
                'library_folder_id' => $folder_id,
                'business_id' => $this->business_id,
                'status' => '1',
                'file_type' => '5',
                'privacy_status' => '1',
                'password' => '',
                'created_by' => $this->business_id,
                'created_date' => time(),
                'modified_date' => time(),
                'modified_by' => $this->business_id,
            );

            $chk_condition = array(
                'file_name' => $this->input->post('title'),
                'business_id' => $this->business_id
            );

            $exist = $this->library_model->check_folder_exist($chk_condition);


            if (!$exist) {

                $output = $this->library_model->add_folder($data);
            $this->Common_Model->set_user_logs('Create Folder assets Settings', $this->input->post('title'));
                if ($output['success'] == 1) {
                    $data = array('library_object_id' => $output['id'], 'library_folder_id' => $output['id']);
                    // 	$res = $this->create_share_link($data);
                    $response['status'] = 'success';
                    // 	$response['message'] 	= replaceSingleTag($this->lang->line('msg_suc_002'),"Folder");
                    $response['message'] = 'Folder Created Successfully';
                    $response['insert_id'] = $output['id'];

                    $get_data = $this->library_model->get_folder($output['id']);

                    // 	pr($get_data);die;


                }
            } else {
                $response['message'] = "Folder Already exist";
            }

        }

        echo json_encode($response);
        die;
    }

    public function getAllFolders()
    {

        $response = array('status' => 'success', 'message' => '', 'callback' => '', 'redirect_type' => 'angular', 'redirect_url' => '');
        $data = array(
            'business_id' => $this->business_id,
            'status' => 1
        );
        $folders = $this->library_model->get_all_folders($data);

        $output = array(
            "total_record" => count($folders),
            "records" => $folders,
            "draw" => 1,
        );
        $response['message'] = $output;
        echo json_encode($response);
        die;
    }

    public function renameFolder()
    {

        $response = array('status' => 'error', 'message' => '', 'callback' => '', 'redirect_type' => 'angular', 'redirect_url' => '', 'insert_id' => '');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('id', 'Folder Id', 'trim|required');
        if ($this->form_validation->run()) {
            $data = array(
                'file_name' => $this->input->post('title'),
                'modified_date' => time(),
                'modified_by' => $this->user_id,
            );
            $condition = array(
                'library_object_id' => $this->input->post('id'),
                'business_id' => $this->business_id
            );

            $chk_condition = array(
                'file_name' => $this->input->post('title'),
                'library_object_id !=' => $this->input->post('id'),
                'business_id' => $this->business_id
            );
            $exist = $this->library_model->check_folder_exist($chk_condition);
            if (!$exist) {
                $output = $this->library_model->update_folder($condition, $data);
                $this->Common_Model->set_user_logs('Rename folder Settings', $this->input->post('title'));
                //echo $this->db->last_query(); die;
                if ($output) {
                    $response['status'] = 'success';
                    $response['message'] = 'Folder Update Successfully';

                }
            } else {
                $response['message'] = 'Folder exist';
            }
        } else {
            $response['status'] = 'error';
            $error['title'] = form_error('title');
            $error['id'] = form_error('id');
            $response['message'] = $error;
        }
        echo json_encode($response);
        die;
    }

   
    
	public function deleteconObject(){
         $object_id = array();
         $object_id = json_decode($this->input->post('object_id'), true);
         $this->form_validation->set_rules('object_id', 'Files', 'trim|required');
        if ($this->form_validation->run()) {
            
            $file_id = array();
            $folder_id = array();
            foreach ($object_id as $value) {
                if ($value['type'] == '1') {
                    $this->db->where('library_object_id',$value['id'])->delete('smart_library_objects');
                } else {
                    $this->db->where('library_folder_id',$value['id'])->delete('smart_library_objects');
                    $this->db->where('library_object_id',$value['id'])->delete('smart_library_objects');
                }
            } 
            
            $this->Common_Model->set_user_logs('Delete Conversation  ', 'conversation delete successfully');
             $result = array(
                'status' => 1,
                'type' =>  $object_id[0]['type'],
                'msg' => 'Success'
            );
        } else {
             $result = array(
                'status' => 0,
                'msg' => 'Something went wrong'
            );
        }
        // pr($result);
        // die;
        echo json_encode($result);
        die;
	}

    public function getAssets()
    {
        $post_data = json_decode(file_get_contents('php://input'), true);
        $this->db->where('type', $post_data['type']);
        $this->db->where('myasset', 'on');
        $this->db->order_by('asset_created_at', 'DESC');
        $list = $this->db->get('chatgpt')->result_array();
        $result = array(
            'status' => 1,
            'list' => $list,
            'msg' => 'Success'
        );
        echo json_encode($result);
        die;
    }


    public function saveAssets()
    {
        // Check if the request contains JSON data
        $post_data = json_decode(file_get_contents('php://input'), true);
        // Check if required data is present
        if(!empty($post_data['imagedata']))
        {
            if($post_data['imagedata']['file_type'] == 'video')
            {
                $url = $post_data['imagedata']['large_video'];
                $file_name = 'video';
                $file_type = 2;
                $file_extension = 'mp4';
            }elseif($post_data['id'] == 'chat'){
                $file_name = 'getaisupreme '.time();
                $url = $post_data['imagedata'];
                $file_type = 3;
                $file_extension ='doc';
            }elseif($post_data['imagedata']['file_type'] == 'gifs'){
                $file_name = $post_data['imagedata']['title'];
                $url = $post_data['imagedata']['previewURL'];
                $file_type = 1;
                $file_extension='gif';
            }else{
                 $file_name = $post_data['imagedata']['title'];
                $url = $post_data['imagedata']['previewURL'];
                $file_type = 1;
                $file_extension='png';
            }
            
            $insert_data = array(
                'business_id' => $this->business_id,
                'library_folder_id' => $post_data['folder_id'],
                'file' => $url,
                'file_name' => $file_name,
                'file_type' => $file_type,
                'file_extension'=> $file_extension,
                'created_by' => $this->business_id,
                'created_date' => time(),
                'modified_date' => time(),
                'modified_by' => $this->business_id,
            );
    
            // Perform database insert
            $this->db->insert('smart_library_objects', $insert_data);
                 $this->Common_Model->set_user_logs('save assets successfully', 'save assets setting');
            // Check if the insert was successful
            if ($this->db->affected_rows() > 0) {
                $result = array(
                    'status' => 1,
                    'msg' => 'Success'
                );
            } else {
                $result = array(
                    'status' => 0,
                    'msg' => 'Failed to insert data into the database'
                );
            }
        }else{
             $result = array(
                    'status' => 0,
                    'msg' => 'Please select File'
                );
        }
       
        echo json_encode($result);
        die;
    }










}