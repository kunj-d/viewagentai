<?php 
// header("access-control-allow-headers: origin, x-requested-with, content-type");
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header('Access-Control-Allow-Origin: *');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     header("access-control-allow-headers: origin, x-requested-with, content-type");
// header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
// header('Access-Control-Allow-Origin: *');
    // Create a new SQLite database connection

    $url = $_SERVER['HTTP_HOST'] ."/app/chat/db_details.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    
    // $conn = mysqli_connect("localhost","intellim_intelli","ht6Kp~5Th&Yx","intellim_intellim");
$conn = mysqli_connect("localhost",$result['db_user'],$result['db_password'],$result['adb_name']);
mysqli_set_charset($conn,"utf8");
// $conn = mysqli_connect("localhost","intellim_intelli","ht6Kp~5Th&Yx","intellim_intellim");
// $conn = mysqli_connect("localhost","aivideob_user","3b?u5aGA7oPY","aivideob_aivideobuilderfx");
    // Get the user ID from the request data
    /* $query_fetch = "SELECT * FROM openai_key where user_id='".$_POST[user_id]."' ORDER BY id ASC "; 
     $results=mysqli_query($conn, $query_fetch);
     $row = mysqli_fetch_array($results,MYSQLI_BOTH);*/



    $prompt_id = $_POST['prompt_id'];
    $visitor_id = $_POST['visitor_id'];
    $msg = $_POST['message'];
    $type = $_POST['type'];
    $user_id=$_POST['user_id'];
    $app=$_POST['app'];
    $query = "INSERT INTO chatgpt (business_id, human,type,prompt_id,visitor_id,app) VALUES('".$user_id."','".$msg."', '".$type."','".$prompt_id."','".$visitor_id."','".$app."')"; 
	$result = mysqli_query($conn, $query);
	$id= mysqli_insert_id($conn);
    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');
    // data
    $data['id'] = $id;
    $data['msg'] = $msg;
    echo json_encode($data);
	
    $conn->close();
}

