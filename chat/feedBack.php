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

    $prompt_id = $_POST['prompt_id'];
    $visitor_id = $_POST['visitor_id'];
    $rating = $_POST['selectedValue'];
    $message = $_POST['message'];


    $query = "INSERT INTO prompt_visitor_feedback (pvf_prompt_id, pvf_visitor_id,pvf_feedback,pvf_feedback_rating,pvf_created_on) VALUES('".$prompt_id."','".$visitor_id."', '".$message."','".$rating."',now())";
        $result = mysqli_query($conn, $query);
        $id= mysqli_insert_id($conn);
        // Set the HTTP response header to indicate that the response is JSON
        header('Content-Type: application/json');

    $data['message'] = 'Feedback submited successfully';
    echo json_encode($data);
	
    $conn->close();
}