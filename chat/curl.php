<?php
// Credentials live in chat/secrets.php, which is git-ignored.
// Copy chat/secrets.sample.php to chat/secrets.php and fill it in.
$SECRETS = file_exists(__DIR__ . '/secrets.php') ? require __DIR__ . '/secrets.php' : array();
// header("access-control-allow-headers: origin, x-requested-with, content-type");
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header('Access-Control-Allow-Origin: *');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);        

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
$open_ai_max_tokens =3000;
$open_ai_frequency_penalty = 0;
$open_ai_presence_penalty = 0;


 
$user_id = $_POST['user_id'];
$business_id = $_POST['business_id'];
$message = $_POST['message'];
$type = $_POST['type'];
$app = $_POST['app'];
$prompt_id = $_POST['prompt_id'];
$visitor_id= $_POST['visitor_id'];



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
// $conn = mysqli_connect("localhost","aiagents_aiagent",";(~b7YxnS1-W","aiagents_aiagent");

$query = "SELECT * FROM prompts WHERE   id='".$prompt_id."'";
$result = mysqli_query($conn, $query);
$chat_row   = mysqli_fetch_assoc($result);
$business_id=$chat_row['business_id'];

//ChatGPT Modal
$query1 = "SELECT * FROM chatgpt_modal WHERE cm_id='".$chat_row['prompt_cm_id']."'";
$result = mysqli_query($conn, $query1);
$gpt_modal   = mysqli_fetch_assoc($result);
$ai_model    =  explode(" ",$gpt_modal['cm_description']);
if($ai_model[1]){
    $ai_model[1] =  "-".$ai_model[1];
}
$open_ai_model = strtolower($ai_model[0] . $ai_model[1]);
$response_count = $gpt_modal['cm_response_character_count'];

$query = "SELECT * FROM chatgpt where business_id='".$business_id."' and app='".$app."' and prompt_id='".$prompt_id."' ORDER BY id ASC ";   
$results=mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($results)) {
	//$history[] = [ROLE => USER, CONTENT => $row['human']];
	if(empty($row['ai'])){
       // $history[] = [ROLE => ASSISTANT, CONTENT => $chat_row['prompt']];
	}else{
	//	$history[] = [ROLE => ASSISTANT, CONTENT => $row['ai']]; 

	}
}


$query_user = "SELECT user_id FROM business WHERE  id='".$business_id."'";
$result = mysqli_query($conn, $query_user);
$user_id   = mysqli_fetch_assoc($result);
$owner_id=$user_id['user_id'];

$query = "SELECT * FROM tbl_user WHERE id = $owner_id"; 
$result = mysqli_query($conn, $query);
$user_row   = mysqli_fetch_assoc($result); 
 
$query = "SELECT credentials FROM users_autoresponder_settings WHERE  business_id='".$business_id."' and autoresponder_id=35 ";
$result = mysqli_query($conn, $query);
$key   = mysqli_fetch_assoc($result);
$key = json_decode($key['credentials'],true);  
if($chat_row['prompt_type'] == 1){ 
        if($user_row['credit'] > 0){
             $url = 'https://ai.oppyo.com/app/v1/ask_question';
            $fields = array(
                'query' => $message,
                'app_id'   =>  $prompt_id,
                'api_key'       =>  'D684B8EFF387DBD9',
                'client_id'     =>  $visitor_id,
                'project_id'     =>  1 
            );
            $fields_string = http_build_query($fields);
             
            // Open connection
             //print_r($fields);
            $ch = curl_init();
             
            // Set the URL, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             
            // Execute POST
            $result = curl_exec($ch);
            if($result){ 
                // Check if the response is valid JSON
                $decodedResponse = json_decode($result, true);
                $txt  =  $decodedResponse['answer']; 
                //close connection
                curl_close($ch); 
                ///update credit// 
                $resp_length=strlen($txt);
                
                //$query = "UPDATE tbl_user SET  credit=credit-".($resp_length)." WHERE id=$owner_id"; 
                //$result = mysqli_query($conn, $query); 
                //  the INSERT statement
                $query = "UPDATE $type SET  ai=".'"'.$txt.'"'." WHERE id=$_POST[id]"; 
                $result = mysqli_query($conn, $query);
                $id= $_POST['id'];
                $data['txt'] = $txt;
            }
        }else{
            $data['txt'] = '';
        }
}else{
    $history[] = [ROLE => USER, CONTENT => $message]; 
    //print_r($history);
    $open_ai_key="";
    if(is_null($key) && $user_row['credit'] > 0){
        $open_ai_key = ($SECRETS['openai_key_proj_2'] ?? ''); 
    }else{
        $json_response=(json_decode($key['credentials'],true));
        $open_ai_key=$json_response['api_key'];
    } 
     if($open_ai_key!=""){
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
            $query = "UPDATE tbl_user SET  credit=credit-".($resp_length*$response_count)." WHERE id=$owner_id"; 
            $result = mysqli_query($conn, $query);
        } 
        $query = "UPDATE $type SET  ai=".'"'.$txt.'"'." WHERE id=$_POST[id]"; 
        $result = mysqli_query($conn, $query);
        $id= $_POST['id']; 
        $data['txt']=$tr->setSource('en')->setTarget($chat_row['language_id'])->translate($txt);
     }else{
        $data['txt'] = '';  
     }
            
}   
$conn->close(); 

echo json_encode($data);
