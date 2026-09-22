<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Virtualassistant_Model extends CI_model {

    public function __construct() {

        parent::__construct();
        $logged_in = $this->session->userdata('logged_in');  

        $this->business_id = $this->session->userdata('business_id');
        $this->user_id = $logged_in['id'];
        $this->owner_id = $logged_in['owner_id'];
    }
    
    
    // public function checkQuestions($object){
    //     try{
    //         foreach($object as $key => $val){
    //             if($key == ''){
    //                 throw new Exception("Please Check Your Question");
    //             }
    //             if(count($val) == 0){
    //                 throw new Exception("Please Check Your Options and Response");
    //             }
    //             foreach($val as $key => $v){
                    
    //                 if($key != '' && $v == ''){
    //                     throw new Exception("Please Check Your Options and Response");
    //                 }
    //                 if($key == '' && $v != ''){
    //                     throw new Exception("Please Check Your Options and Response");
    //                 }
                    
    //             }
    //         }
    //          $flashdata['success']['message'] = 'done';
    //          return  $flashdata;

    //     } catch (Exception $e) {
    //         $flashdata['error']['message'] = $e->getMessage();
    //          return  $flashdata;
    //     }
    // }
    
     public function checkQuestions($object){
        try{
            foreach($object as $key => $val){
                if($key == '' || $val == ''){
                    throw new Exception("Please Check Your Question");
                }
            }
             $flashdata['success']['msg'] = 'done';
             return  $flashdata;
        } catch (Exception $e) {
            $flashdata['error']['msg'] = $e->getMessage();
             return  $flashdata;
        }
    }
    
    public function insertQuestion($object,$prompt_id){
        $this->db->where('prompt_id', $prompt_id);
        $this->db->delete('chatbot_question');
         foreach($object as $key => $val){
             $Qarray = array(
                 'prompt_id' => $prompt_id,
                 'question' => preg_replace('/[^\w\s?]/u', '', $key),
                 'response' => preg_replace('/[^\w\s?]/u', '', $val),
                 );
             $this->db->insert('chatbot_question',$Qarray);
         }
    }
    
    public function uploadPdfData($pdfData){
        $ownerDirectoryName = 'assets/uploads/users/'. $this->business_id;
        $library_folder = 'pdf_docs';
        $uploadFilePath = [];
        $dirname = $ownerDirectoryName . '/' . $library_folder . '/';
        // for ($i = 0; $i < count($_FILES['pdf_docs']['name']); $i++) {
        for ($i = 0; $i < count($pdfData['name']); $i++) {
            try{
                
                $_FILES['file']['name']     = $_FILES['pdf_docs']['name'][$i];
                $_FILES['file']['type']     = $_FILES['pdf_docs']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['pdf_docs']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['pdf_docs']['error'][$i];
                $_FILES['file']['size']     = $_FILES['pdf_docs']['size'][$i];
    
                if(!is_dir($ownerDirectoryName)){
        			mkdir($ownerDirectoryName, 0755, true);
        		}
        		$subFolderDirectory=$ownerDirectoryName."/".$library_folder;
        		if(!is_dir($subFolderDirectory)){
        			mkdir($subFolderDirectory, 0755, true);
        		}
                $filename = rand(1, 100) . "_" . time();
                $config['file_name'] = $filename;
                $config['upload_path'] = $ownerDirectoryName . '/' . $library_folder . '/';
                $config['allowed_types'] = 'pdf';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $library_image_data = $this->upload->data();
                    $image_title = $_FILES['file']['name'];
                    $image_name = $library_image_data['file_name'];
                    $uploadFilePath[] = $this->config->item('assetsBasePath'). $ownerDirectoryName . '/' . $library_folder . '/' . $image_name;
    
                } else {
                    throw new Exception($this->upload->display_errors());
                }
                
            } catch (Exception $e) {
                $flashdata['error']['message'] = $e->getMessage();
                 return  $flashdata;
            }

         }
         return $uploadFilePath;
        
    }
    
    
    public function uploadUrlData($urlData){
        $urls = explode(',',$urlData);
        $uploadTextPath = [];         
        foreach ($urls as $key => $val) {
            $url = $val;
        
            // Initialize cURL session
            $ch = curl_init($url);
        
            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        
            // Execute cURL and check for errors
            $htmlContent = curl_exec($ch);
        
            if (curl_errno($ch)) {
                // echo 'Error fetching the content: ' . curl_error($ch);
            } else {
                // Close cURL session
                curl_close($ch);
        
                // Check if HTML content is valid
                if ($htmlContent !== false) {
                    // Remove script and style elements
                    $htmlContent = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $htmlContent);
                    $htmlContent = preg_replace('/<style\b[^>]*>.*?<\/style>/is', '', $htmlContent);
        
                    // Create a DOMDocument
                    $dom = new DOMDocument;
                    libxml_use_internal_errors(true);
                    $dom->loadHTML($htmlContent);
                    libxml_clear_errors();
        
                    // Extract main content (body text)
                    $bodyContent = $dom->getElementsByTagName('body')->item(0)->textContent;
        
                    // Display the plain text content
                    $mainHtml = trim(html_entity_decode($bodyContent));
                    $mainHtml = preg_replace('/\s+/', ' ', $mainHtml);
        
                    // Create directory if not exists
                    $ownerDirectoryName = 'assets/uploads/users/' . $this->business_id;
                    $library_folder = 'text_files';
                    $subFolderDirectory = $ownerDirectoryName . "/" . $library_folder . '/';
                    if (!is_dir($subFolderDirectory)) {
                        mkdir($subFolderDirectory, 0755, true);
                    }
        
                    // Generate a unique filename
                    $fileName = rand(1, 100) . "_" . time() . ".txt";
        
                    // Combine the path and file name
                    $fullPath = $subFolderDirectory . $fileName;
        
                    // Write the text to the file
                    if (write_file($fullPath, $mainHtml)) {
                    $uploadTextPath[] = $this->config->item('assetsBasePath').$ownerDirectoryName. '/'.$library_folder. '/'.$fileName;

                        // echo "Text has been successfully written to the file: $fullPath<br>";
                    } else {
                        // echo "Unable to write text to the file: $fullPath<br>";
                    }
                } else {
                    // echo "Error retrieving HTML content from $url<br>";
                }
            }
        }
        return $uploadTextPath;
    }

    public function getQuestionAnswer($prompt_id=Null) {
        
        $this->db->select('*');
        $this->db->where('prompt_id', $prompt_id);
        $query = $this->db->get('chatbot_question');
        return $query->result_array();

    }
    
    
   
}