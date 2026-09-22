<?php   
// header("access-control-allow-headers: origin, x-requested-with, content-type");
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new SQLite database connection
// header("access-control-allow-headers: origin, x-requested-with, content-type");
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header('Access-Control-Allow-Origin: *');

$url = $_SERVER['HTTP_HOST'] ."/app/chat/db_details.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
$result = json_decode($result, true);

// $conn = mysqli_connect("localhost","intellim_intelli","ht6Kp~5Th&Yx","intellim_intellim");
$conn = mysqli_connect("localhost",$result['db_user'],$result['db_password'],$result['adb_name']);
mysqli_set_charset($conn,"utf8");
$row ="";
$chatbot_question ="";
$results_web_setting ="";
$customer_apps ="";
$customer_apps_questions ="";
$app_ques = [];
    // Get the user ID from the request data
    if($_POST['prompt_id'] != '' && $_POST['business_id'] != '' ){
        $query_fetch = "SELECT * FROM prompts where id='".$_POST['prompt_id']."' AND prompt_delete_status=1 AND prompt_active_status=1  ORDER BY id ASC"; 
        $results=mysqli_query($conn, $query_fetch);
        $row = mysqli_fetch_array($results,MYSQLI_ASSOC);
         
        $query_fetch_chatbot_question = "SELECT * FROM  chatbot_question   where prompt_id='".$_POST['prompt_id']."' ORDER BY id ASC "; 
        $results_chatbot_question=mysqli_query($conn, $query_fetch_chatbot_question);
        $chatbot_question = mysqli_fetch_all($results_chatbot_question,MYSQLI_ASSOC);
         
        // chatbotFooter
        $chatbot_footer = '';
        $query_web_setting = "SELECT * FROM  web_setting   where userid='".$_POST['business_id']."' ORDER BY id ASC "; 
        $results_web_setting=mysqli_query($conn, $query_web_setting);
        if($results->num_rows > 0){
           $chatbot_footer = mysqli_fetch_array($results_web_setting,MYSQLI_ASSOC);
        }
    }else if($_POST['ca_id'] != ''){

        $query_fetch = "SELECT * FROM customer_apps where ca_id='".$_POST['ca_id']."' AND ca_business_id='".$_POST['ca_business_id']."' AND ca_status=1 ORDER BY ca_id ASC"; 
        $results=mysqli_query($conn, $query_fetch);
        $customer_apps = mysqli_fetch_array($results,MYSQLI_ASSOC);

        $query_fetch = "SELECT * FROM  customer_apps_questions  where caq_ca_id='".$_POST['ca_id']."' AND caq_status=1 ORDER BY caq_ca_id ASC"; 
        $results=mysqli_query($conn, $query_fetch);
        
        if ($results) {
            while ($customer_apps_question = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                $app_ques[] = $customer_apps_question;
            }
        }
    }
     
     
     
    //  $query_fetch_chatbot_answer = "SELECT * FROM  chatbot_answer  where prompt_id='".$_POST[prompt_id]."' ORDER BY id ASC "; 
    //  $results=mysqli_query($conn, $query_fetch_chatbot_answer);
    //  $chatbot_option = mysqli_fetch_all($results,MYSQLI_BOTH);
     
    $chatbot_class    =  explode(",",$row['chatbot_class']);
     
     
    $html = '';
    $html .= '<div class="promt-msg-wall" id="PromptWall" >';
    $i =0;
        
    // Question Trim
    // $originalQuestion = [];
    // foreach($chatbot_question as $key => $value){
    //     $originalQuestion[] = $value['question'];
    //     if (strlen($value['question']) > 30) {
    //         $trimmedString = substr($value['question'], 0, 30 - 3) . '...';
    //     } else {
    //        $trimmedString  = $value['question']; 
    //     }
    //     $chatbot_question[$key]['question'] = $trimmedString;
    // }
    
    foreach($chatbot_question as $key => $value){
        if($chatbot_class[1] == 'none'){
            $i++;
            if($i%2!=0){
                $html .= '<div class="promt-msg1">
                            <div style="background-color:'.$row['userbackground_color'].'">
                                <span  class="question" data-qt="'.$originalQuestion[$key].'" data-response="'.$value['response'].'"  style="color:'.$row['usertext_color'].'">'.$value['question'].'</span>
                            </div>
                            <div style="display:none">
                                <span  style="color:'.$row['usertext_color'].'">What is your least1 </span>
                            </div>
                        </div>';
            }else{
                $html .= '<div class="promt-msg2">
                            <div style="background-color:'.$row['userbackground_color'].'">
                                <span class="question" data-qt="'.$originalQuestion[$key].'" data-response="'.$value['response'].'"  style="color:'.$row['usertext_color'].'">'.$value['question'].'</span>
                            </div>
                
                            <div style="display:none" ng-style="userbackground_style">
                                <span  style="color:'.$row['usertext_color'].'">What is your least2</span>
                            </div>
                        </div>';
            }
        }
    }

     if($chatbot_class[1] == 'block'){
        $html .= '<div class="promt-msg1">
                        <div style="display:'. (empty($chatbot_question[0]) ? none : '').'; background-color:'.$row['userbackground_color'].'">
                            <span class="question" data-qt="'.$originalQuestion[0].'" data-response="'.$chatbot_question[0]['response'].'" style="color:'.$row['usertext_color'].'">'.$chatbot_question[0]['question'].'</span>
                        </div>
                        <div style="display:'. (empty($chatbot_question[2]) ? none : '').'; background-color:'.$row['userbackground_color'].'">
                            <span class="question" data-qt="'.$originalQuestion[2].'"  data-response="'.$chatbot_question[2]['response'].'" style="color:'.$row['usertext_color'].'">'.$chatbot_question[2]['question'].'</span>
                        </div>
                    </div>
                    
                    <div class="promt-msg2">
                        <div style="display:'. (empty($chatbot_question[1]) ? none : '').'; background-color:'.$row['userbackground_color'].'">
                          <span  class="question" data-qt="'.$originalQuestion[1].'"  data-response="'.$chatbot_question[1]['response'].'" style="color:'.$row['usertext_color'].'">'.$chatbot_question[1]['question'].'</span>
                        </div>
                        
                        <div style="display:'. (empty($chatbot_question[3]) ? none : '').'; background-color:'.$row['userbackground_color'].'">
                            <span  class="question" data-qt="'.$originalQuestion[3].'"  data-response="'.$chatbot_question[3]['response'].'" style="color:'.$row['usertext_color'].'">'.$chatbot_question[3]['question'].'</span>
                        </div>                                            
                    </div>';
        }
 
    $html .= '</div>';

  /*  $prompt_id = $_POST['prompt_id'];
    $visitor_id = $_POST['visitor_id'];
    $msg = $_POST['message'];
    $type = $_POST['type'];
    $user_id=$_POST['user_id'];
    $app=$_POST['app'];
    $query = "INSERT INTO chatgpt (user_id, human,type,prompt_id,visitor_id,app) VALUES('".$user_id."','".$msg."', '".$type."','".$prompt_id."','".$visitor_id."','".$app."')";
	$result = mysqli_query($conn, $query);
	$id= mysqli_insert_id($conn);*/

	if(($row == null || $row == '') && ($customer_apps == null || $customer_apps == '')){
        $data['not_active'] = 'Copilot Not Activated.';
    }else if($row != null || $row != ''){
        $chatbot_class    =  explode(",",$row['chatbot_class']);
       
        // data
        $data['not_active'] = null;
        $data['prompt'] = $row['prompt'];
        $data['txt'] = $row['text'];
        $data['color'] = $row['color'];
        $data['list_id'] = $row['list_id'];
        $data['autoresponder_id'] = $row['autoresponder_id'];
        $data['close_message'] = $row['close_message'];
        $data['assistant_image'] = $row['assistant_image'];
        $data['widget_image'] = $row['widget_image'];
        $data['bottext_color'] = $row['bottext_color'];
        $data['botbackground_color'] = $row['botbackground_color'];
        $data['usertext_color'] = $row['usertext_color'];
        $data['userbackground_color'] = $row['userbackground_color']; 
        $data['prompt_theme_text_color'] = $row['prompt_theme_text_color']; 
        $data['prompt_description'] = $row['prompt_description'];
        $data['prompt_place_holder_text'] = $row['prompt_place_holder_text'];
        $data['prompt_notice_message'] = $row['prompt_notice_message'];
        $data['prompt_is_show_lead_form'] = $row['prompt_is_show_lead_form'];
        $data['prompt_time_delay_close'] = $row['prompt_time_delay_close'];
        $data['prompt_is_show_feedback_form'] = $row['prompt_is_show_feedback_form'];
        $data['chatbot_question'] = $chatbot_question;
        $data['text_labeling_check'] = $chatbot_footer['chatbot_footer_is_text_labeling'];
        if($row['prompt_is_style_manually'] == 1){
            $data['chatbot_class'] = 'manually';
        }else{
            $data['chatbot_class'] = $row['chatbot_class'];
        }
        if($chatbot_footer['chatbot_footer_is_text_labeling'] == 0){
            $data['chatbot_footer'] = $chatbot_footer ?  $chatbot_footer['chatbot_footer_branding'] : 'chat/chatbot_footer.png';
        }else if($chatbot_footer['chatbot_footer_is_text_labeling'] == 1){
            $data['fontsize'] = $chatbot_footer['fontsize'];
            $data['fontcolor'] = $chatbot_footer['fontcolor'];
            $data['boxcolor'] = $chatbot_footer['boxcolor'];
            $data['chatbot_footer'] = $chatbot_footer ?  $chatbot_footer['text'] : '';
            $data['footer_redirect_url'] = $chatbot_footer ?  $chatbot_footer['chatbot_footer_branding_redirect_url'] : '';
        }
    }else if($customer_apps != null || $customer_apps != '' ){
        $data['customer_apps'] = $customer_apps;
        $data['customer_apps_questions'] =  mb_convert_encoding($app_ques, "UTF-8", "auto");
        $data['assistant_image'] = $customer_apps['ca_image_path'];
        $customer_apps['ca_ending_action_description'] = ''; 
        $data['customer_apps']['ca_ending_action_description']= $customer_apps['ca_ending_action_description'] ;
    }
    
//    print_r($data);die;
    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json; charset=utf-8');
    $json=json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
	
    $conn->close();
}

