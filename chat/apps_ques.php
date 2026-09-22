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
    $customer_apps ="";
    $customer_apps_questions ="";
    $app_id = [];

    $query_fetch = "SELECT * FROM customer_app_sets where cas_id='".$_POST['cas_id']."' AND cas_business_id='".$_POST['ca_business_id']."' AND cas_status=1 ORDER BY cas_id ASC"; 
    //echo $query_fetch; 
    $results=mysqli_query($conn, $query_fetch);
    $customer_app_sets = mysqli_fetch_array($results,MYSQLI_ASSOC);

    $query_fetch = "SELECT * FROM customer_app_sets_app where casa_cas_id='".$_POST['cas_id']."' AND casa_status=1 ORDER BY casa_id ASC"; 
    $results=mysqli_query($conn, $query_fetch);
    
    if ($results) {
        while ($customer_apps_question = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $app_id[] = $customer_apps_question;            
        }
    }

    forEach($app_id as $ca_id){
        $query_fetch = "SELECT * FROM customer_apps where ca_id='".$ca_id['casa_ca_id']."' AND ca_business_id='".$_POST['ca_business_id']."' AND ca_status=1 ORDER BY ca_id ASC"; 
        $results=mysqli_query($conn, $query_fetch);
        while ($customer_apps = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            //$customer_apps['ca_ending_action_description']="";
            //$customer_apps['ca_description']=""; 
            $app[] = $customer_apps;            
        }
    }

    


    $data['customer_app_sets'] = $customer_app_sets;
    $data['customer_apps'] = $app;

    // Set the HTTP response header to indicate that the response is JSON
    header('Content-Type: application/json');
    //print_r($data);
    $json=json_encode($data);
    echo $json;
	
    $conn->close();

}