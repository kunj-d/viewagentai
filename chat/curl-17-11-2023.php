<?php
// Credentials live in chat/secrets.php, which is git-ignored.
// Copy chat/secrets.sample.php to chat/secrets.php and fill it in.
$SECRETS = file_exists(__DIR__ . '/secrets.php') ? require __DIR__ . '/secrets.php' : array();
header("access-control-allow-headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
header('Access-Control-Allow-Origin: *');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);        

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
$open_ai_max_tokens =100;
$open_ai_frequency_penalty = 0;
$open_ai_presence_penalty = 0;


$history[] = [ROLE => SYS, CONTENT => "You are a helpful assistant."];
$business_id = $_POST['user_id'];
$message = $_POST['message'];
$type = $_POST['type'];
$app = $_POST['app'];
$prompt_id = $_POST['prompt_id'];

$conn = mysqli_connect("localhost","aiagents_aiagent",";(~b7YxnS1-W","aiagents_aiagent_army");
// $conn = mysqli_connect("localhost","getaiemp_aistaff","[A5W=RsNY)ps","getaiemp_aistaff");
 $query = "SELECT * FROM prompts WHERE  business_id='".$business_id."' and app='".$app."'  and  id='".$prompt_id."'";
$result = mysqli_query($conn, $query);
$chat_row   = mysqli_fetch_assoc($result);
//var_dump($chat_row['language_id']);

//echo $chat_row['prompt'];
//die;
$query = "SELECT * FROM chatgpt where business_id='".$business_id."' and app='".$app."' and prompt_id='".$prompt_id."' ORDER BY id ASC ";  
$results=mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($results)) {
	$history[] = [ROLE => USER, CONTENT => $row['human']];
	if(empty($row['ai'])){
    $history[] = [ROLE => ASSISTANT, CONTENT => $chat_row['prompt']];
	}else{
		$history[] = [ROLE => ASSISTANT, CONTENT => $row['ai']];

	}
}


header('Content-type: text/event-stream');
header('Cache-Control: no-cache');
$txt = "";
/*$opts = [
    'model' => $open_ai_model,
    'messages' => $history,
    'temperature' => $open_ai_temperature,
    'max_tokens' => $open_ai_max_tokens,
    'frequency_penalty' => $open_ai_frequency_penalty,
    'presence_penalty' => $open_ai_presence_penalty,
    'stream' => true
];*/


$query_user = "SELECT user_id FROM business WHERE  id='".$business_id."'";
$result = mysqli_query($conn, $query_user);
$user_id   = mysqli_fetch_assoc($result);
$owner_id=$user_id['user_id'];

$query = "SELECT * FROM tbl_user WHERE id = $owner_id";
$result = mysqli_query($conn, $query);
$user_row   = mysqli_fetch_assoc($result);


$query = "SELECT credentials FROM users_autoresponder_settings WHERE  user_id='".$owner_id."' and autoresponder_id=35 ";
$result = mysqli_query($conn, $query);
$key   = mysqli_fetch_assoc($result);
if(is_null($key) && $user_row['credit'] > 0){
    $open_ai_key = ($SECRETS['openai_key_legacy_3'] ?? ''); 
}else{
    $json_response=(json_decode($key['credentials'],true));
    $open_ai_key=$json_response['api_key'];
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

$txt=$data['choices'][0]['message']['content'];

///update credit//
if(is_null($key) && $user_row['credit'] > 0){
$resp_length=strlen($txt);
$query = "UPDATE tbl_user SET  credit=credit-".'"'.$resp_length.'"'." WHERE id=$owner_id"; 
$result = mysqli_query($conn, $query);
}
/////////////

//  the INSERT statement
$query = "UPDATE $type SET  ai=".'"'.$txt.'"'." WHERE id=$_POST[id]"; 
$result = mysqli_query($conn, $query);
$id= $_POST['id'];
$conn->close();

 //$data['txt'] = $txt;
$data['txt']=$tr->setSource('en')->setTarget($chat_row['language_id'])->translate($txt);
echo json_encode($data);
