<?php
// Credentials live in chat/secrets.php, which is git-ignored.
// Copy chat/secrets.sample.php to chat/secrets.php and fill it in.
$SECRETS = file_exists(__DIR__ . '/secrets.php') ? require __DIR__ . '/secrets.php' : array(); 
require __DIR__ . '/chat/autoload.php'; // remove this line if you use a PHP Framework.
require __DIR__ . '/vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;
use Stichoza\GoogleTranslate\GoogleTranslate;
$tr = new GoogleTranslate('en');  
const ROLE = "role";
const CONTENT = "content";
const USER = "user";
const SYS = "system";
const ASSISTANT = "assistant";
$open_ai_model ='gpt-3.5-turbo';
$open_ai_temperature = 1.0;
$open_ai_max_tokens =1000;
$open_ai_frequency_penalty = 0;
$open_ai_presence_penalty = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $url = $_SERVER['HTTP_HOST'] ."/app/chat/db_details.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    $result = json_decode($result, true);

    // $conn = mysqli_connect("localhost","intellim_intelli","ht6Kp~5Th&Yx","intellim_intellim");
    $conn = mysqli_connect("localhost",$result['db_user'],$result['db_password'],$result['adb_name']);
    mysqli_set_charset($conn,"utf8");
    // $conn = mysqli_connect("localhost","aivideob_user","3b?u5aGA7oPY","aivideob_aivideobuilderfx");
    $visitor_id=$_POST['visitor_id'];
    $ca_id=$_POST['ca_id'];
    $index=$_POST['index'];
    $queryCa = "Select * from customer_apps where ca_id=".$ca_id; 
    $result = mysqli_query($conn, $queryCa);
    $row = $result -> fetch_array(MYSQLI_ASSOC); 
    $business_id=$row['ca_business_id'];
    $response="";
    $redirect_url="";
  
    if($row['ca_ending_action_type']==1){
        $prompt=$row['ca_ending_action_description'];
        $queryCaq = "Select * from customer_apps_questions where caq_ca_id=".$ca_id; 
        $result = mysqli_query($conn, $queryCaq);
        if(!$index){
            $index = $result->num_rows-1;
        }
        while ($row2=mysqli_fetch_object($result)) {
            $questionuk=$row2->caq_question_unique_id;
            $caq_id=$row2->caq_id;
            $find="@".$questionuk;
            for($counter=0;$counter<=$index;$counter++){ 
               
                $question_id=$_POST['question_id_'.$counter];
                //echo $question_id;
                //echo "ques : ".$question_id."<br/>";
                if($caq_id==$question_id){  
                    $answer=$_POST['answer_'.$counter];
                    if (strpos($prompt, $find) !== false) { 
                        //echo "||".$find."||".$answer."||".$prompt;
                        $prompt= str_replace( $find,"\"".$answer."\"",$prompt);
                        continue;
                    }
                }
            }
        }
        //echo $prompt;
        //die();
        $query_user = "SELECT user_id FROM business WHERE  id=".$business_id;
        
        $result = mysqli_query($conn, $query_user);
        $user_id   = mysqli_fetch_assoc($result);
        $owner_id=$user_id['user_id'];
        
        $query = "SELECT * FROM tbl_user WHERE id = $owner_id"; 
        $result = mysqli_query($conn, $query);
        $user_row   = mysqli_fetch_assoc($result); 
        
        //if($user_row['credit'] > 0){ 
            $query1 = "SELECT * FROM chatgpt_modal WHERE cm_id='".$row['ca_gpt_model']."'";
            $result = mysqli_query($conn, $query1);
            $gpt_modal   = mysqli_fetch_assoc($result);
            $ai_model    =  explode(" ",$gpt_modal['cm_description']);
            $ai_count_multipy    =  $gpt_modal['cm_response_character_count'];
            if($ai_model[1]){
                $ai_model[1] =  "-".$ai_model[1];
            }
            $open_ai_model = strtolower($ai_model[0] . $ai_model[1]);
            

            $query = "SELECT credentials FROM users_autoresponder_settings WHERE  business_id='".$business_id."' and autoresponder_id=35 ";
            //echo $query;
            $result = mysqli_query($conn, $query);
            $key   = mysqli_fetch_assoc($result);
            $key = json_decode($key['credentials'],true); 
            
            // echo $prompt; 
            // die();
            $history[] = [ROLE => SYS, CONTENT => "You are a helpful assistant."]; 
            $history[] = [ROLE => USER, CONTENT => $prompt]; 
        
            $open_ai_key="";
            $credir_not_available=false;
            if((is_null($key) ||  empty($key) || empty($key['api_key'])) &&  $user_row['credit'] > 0){ 
                $open_ai_key = ($SECRETS['openai_key_legacy_2'] ?? ''); 
            }else if(!empty($key) && !empty($key['api_key'])){  
                $open_ai_key=$key['api_key'];
            }else{
                $credir_not_available=true;
            }  
            if(!empty($open_ai_key)){
                if($open_ai_model==""){
                    $open_ai_model="gpt-3.5-turbo";
                    $ai_count_multipy=1;
                }
                $open_ai = new OpenAi($open_ai_key);  
                $complete = $open_ai->chat([
                'model' => $open_ai_model,
                    'messages' => $history,
                    'temperature' => $open_ai_temperature,
                    'max_tokens' => $open_ai_max_tokens,
                    'frequency_penalty' => $open_ai_frequency_penalty,
                    'presence_penalty' => $open_ai_presence_penalty,
                ]);
                
                $data=json_decode($complete,true); 
                //print_r($data);
                //die();
                $txt=$data['choices'][0]['message']['content']; 
                if(is_null($key) && $user_row['credit'] > 0){
                    $resp_length=strlen($txt)/10;
                    $query = "UPDATE tbl_user SET  credit=credit-".'"'.($resp_length*$ai_count_multipy).'"'." WHERE id=$owner_id"; 
                    $result = mysqli_query($conn, $query);
                } 
                $language_code="en";
                $queryL = "SELECT * FROM languages WHERE id =". $row['ca_language_id']; 
                $resultL = mysqli_query($conn, $queryL);
                $language_row   = mysqli_fetch_assoc($resultL); 
                
                if($language_code!=$language_row['language_code']){
                    $response=$tr->setSource('en')->setTarget($language_row['language_code'])->translate($txt);
                }else{
                    $response=$txt;
                }
                $response= str_replace( "\n","<br/>",$response);
                /*$myArray = preg_split('/<br[^>]*>/i', $response);
                foreach($myArray as $key) {  
                    //echo $key;
                    if (strpos(trim($key), '####') === 0) {
                        $response= str_replace($key,"<span style='font-size:16px'><b>".$key."</b><span/>",$response); 
                    }else if(strpos(trim($key), '###') === 0){
                        $response= str_replace($key,"<span style='font-size:18px'><b>".$key."</b><span/>",$response); 
                    }else if(strpos(trim($key), '##') === 0){
                        $response= str_replace($key,"<span style='font-size:20px'><b>".$key."</b><span/>",$response); 
                    }else if(strpos(trim($key), '#') === 0){
                        $response= str_replace($key,"<span style='font-size:22px'><b>".$key."</b><span/>",$response);  
                    }else if(strpos(trim($key), 'Title') === 0){
                        $response= str_replace($key,"<span style='font-size:22px'><b>".$key."</b><span/>",$response);  
                    }else if(strpos(trim($key), 'Chapter') === 0){
                        $response= str_replace($key,"<span style='font-size:20px'><b>".$key."</b><span/>",$response);  
                    }
                }*/ 
            }else if($credir_not_available==true){
                $response="Credit not available";
            }else{
                $response="API Key not available";
            }
     
    }else if($row['ca_ending_action_type']==2){ 
        $data['redirect_url']=$row['ca_ending_action_description'];
        $response="Redirect Action";
        $redirect_url=$row['ca_ending_action_description'];
    }else{
        $response=$row['ca_ending_action_description'];
    }
    $ca_ending_action_type=$row['ca_ending_action_type'];
    $ca_ending_action_description=$row['ca_ending_action_description'];
    $responseChanged=$response;
    $responseChanged=str_replace('"','\"',$responseChanged);
    $query = 'INSERT INTO customer_apps_visitor_response (cavr_ca_id, cavr_visitor_id,cavr_response,cavr_created_on) VALUES('.$ca_id.',"'.$visitor_id.'", "'.$responseChanged.'",now())'; 
   
    $result = mysqli_query($conn, $query);

    $cavr_id= mysqli_insert_id($conn);
    for($counter=0;$counter<=$index;$counter++){
        $question_id=$_POST['question_id_'.$counter]; 
        $answer=$_POST['answer_'.$counter];
        $queryQ = 'INSERT INTO customer_apps_visitor_questions (cavq_ca_id  , cavq_cavr_id ,cavq_caq_id ,cavq_visitor_input,cavq_created_on) VALUES('.$ca_id.','.$cavr_id.', '.$question_id.', "'.$answer.'",now())'; 
    //   echo "<br/>"; print_r($queryQ);
        $result = mysqli_query($conn, $queryQ); 
    }
    $data['ca_ending_action_type'] = $ca_ending_action_type;
    $data['msg'] = $response;  
    if($ca_ending_action_type==2 || $ca_ending_action_type=="2"){
        $data['redirect_url'] ==$ca_ending_action_description;
    }else{
        $data['redirect_url'] ="";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
 
	
    $conn->close();
}