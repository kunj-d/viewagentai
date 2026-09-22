<?php

defined('BASEPATH') or exit('No direct script access allowed');
require('AppDefault.php');



class Business_finder_controller extends AppDefault
{

  public function __construct()
  {
    parent::__construct();
    $this->checkAlreadyLogout();
    $this->admin_id = $this->session->userdata('logged_in')['owner_id'];
    $this->business_id = $this->session->userdata('business_id');
  }



  public function index()
  {
//       	$user_plan = $this->app_lib->get_user_plan();
   
// 		if(!in_array('business_finder', $user_plan['features']) ){ 
// 		    redirect(base_url('subscription'));
// 		}
    $data = [];
    $this->loadView('businessFinder/index', $data);
  }



//   public function findPlaces()
//   {
//     // --- Step 1: Allow CORS (important for AngularJS) ---
//     header('Content-Type: application/json');
//     header('Access-Control-Allow-Origin: *');
//     header('Access-Control-Allow-Methods: POST, OPTIONS');
//     header('Access-Control-Allow-Headers: Content-Type, Authorization');

//     // Handle preflight OPTIONS request
//     if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//       exit(0);
//     }

//     // --- Step 2: Read incoming JSON request ---
//     $rawData = file_get_contents('php://input');
//     $post = json_decode($rawData);

//     if (empty($post->lat) || empty($post->lng) || empty($post->keyword)) {
//       echo json_encode([
//         'status' => false,
//         'message' => 'Missing required parameters (lat, lng, keyword)'
//       ]);
//       return;
//     }

//     $lat = $post->lat;
//     $lng = $post->lng;
//     $keyword = urlencode(trim($post->keyword));
//     $radius = 2000; // 2 KM radius

//     // --- Step 3: Your Google API Key ---
//     $api_key = config_item('business_finder_api_key'); // 👈 Replace with your actual key

//     // --- Step 4: Build Google Places API URL ---
//     $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?"
//       . "location=$lat,$lng"
//       . "&radius=$radius"
//       . "&keyword=$keyword"
//       . "&key=$api_key";

//     // --- Step 5: Call Google API ---
//     $response = @file_get_contents($url);

//     if ($response === FALSE) {
//       echo json_encode([
//         'status' => false,
//         'message' => 'Failed to fetch from Google Places API. Check your API key or billing status.'
//       ]);
//       return;
//     }
//     $responseData = json_decode($response, true);
//     if (isset($responseData['results'])) {
//       // Loop through the results and fetch place details for each place
//       foreach ($responseData['results'] as $index => $place) {
//         // Use the place_id to fetch place details
//         $placeId = $place['place_id'];

//         // URL for the Place Details API
//         $detailsUrl = "https://maps.googleapis.com/maps/api/place/details/json?"
//           . "placeid=$placeId"
//           . "&key=$api_key";

//         // Call the Place Details API
//         $detailsResponse = @file_get_contents($detailsUrl);
//         $detailsData = json_decode($detailsResponse, true);

//         // Check if website is available in place details response
//         if (isset($detailsData['result']['website'])) {
//           // Add website URL to the current place data
//           $responseData['results'][$index]['website'] = $detailsData['result']['website'];
//         } else {
//           // If no website, set it as null
//           $responseData['results'][$index]['website'] = null;
//         }
//       }
//     }


//     // --- Step 6: Return the same response to Angular ---
//     echo json_encode($responseData);
//   }

   public function findPlaces()
{
    // --- Step 1: Allow CORS ---
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    // --- Step 2: Read incoming JSON request ---
    $rawData = file_get_contents('php://input');
    $post = json_decode($rawData);

    if (empty($post->lat) || empty($post->lng) || empty($post->keyword)) {
        echo json_encode([
            'status' => false,
            'message' => 'Missing required parameters (lat, lng, keyword)'
        ]);
        return;
    }

    $lat = $post->lat;
    $lng = $post->lng;
    $keyword = urlencode(trim($post->keyword));
    $radius = 2000; // 2 KM

    // --- Step 3: Google API Key ---
   // $api_key = config_item('business_finder_api_key'); // <- apna key daalna
    $api_key = $this->config->item('business_finder_api_key'); // <- apna key daalna

    // --- Step 4: Build Google Places URL ---
    $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?"
        . "location=$lat,$lng"
        . "&radius=$radius"
        . "&keyword=$keyword"
        . "&key=$api_key";

    // --- Step 5: Call Google API ---
    $response = @file_get_contents($url);

    if ($response === FALSE) {
        echo json_encode([
            'status' => false,
            'message' => 'Failed to fetch from Google Places API. Check your API key or billing status.'
        ]);
        return;
    }

    $responseData = json_decode($response, true);

    // --- Step 6: Loop through results and fetch website + email ---
    if (isset($responseData['results'])) {
        foreach ($responseData['results'] as $index => $place) {

            $placeId = $place['place_id'];

            // Place details API URL
            $detailsUrl = "https://maps.googleapis.com/maps/api/place/details/json?"
                . "placeid=$placeId"
                . "&key=$api_key";

            $detailsResponse = @file_get_contents($detailsUrl);
            $detailsData = json_decode($detailsResponse, true);

            // Website available?
            if (isset($detailsData['result']['website'])) {

                $website = $detailsData['result']['website'];
                $responseData['results'][$index]['website'] = $website;

                // Try to fetch website HTML
                $html = @file_get_contents($website);

                if ($html !== false) {
                    // Regex for email extraction
                    preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/', $html, $matches);

                    if (!empty($matches[0])) {
                        $responseData['results'][$index]['email'] = $matches[0][0]; // 1st email
                    } else {
                        $responseData['results'][$index]['email'] = null; // No email
                    }
                } else {
                    $responseData['results'][$index]['email'] = null; // Website not reachable
                }
            } 
            else {
                // No website found
                $responseData['results'][$index]['website'] = null;
                $responseData['results'][$index]['email'] = null;
            }
        }
    }

    // --- Step 7: Return Final JSON to Angular ---
    echo json_encode($responseData);
}






  public function SaveSearchBusiness()
  {

    $user_id = (int) $this->admin_id;
    $business_id = (int) $this->business_id;


    $rawData = file_get_contents('php://input');
    $post = json_decode($rawData, true);



    $data = [
      'user_id' => $user_id,
      'business_id' => $business_id,
      'name' => $post['name'],
      'address' => $post['address'],
      'email' => $post['email'],
      'phone' => !empty($post['phone']) ? $post['phone'] : null,
      'website' => !empty($post['website']) ? $post['website'] : null
    ];

    $inserted = $this->db->insert('search_business_list', $data);

    if ($inserted) {
      // $this->session->set_flashdata('message', 'Business saved successfully!');

      echo json_encode([
        'status' => true,
        'message' => 'Business saved successfully!'
      ]);
    } else {
      // $this->session->set_flashdata('error', 'Database insert failed.');

      echo json_encode([
        'status' => false,
        'message' => 'Database insert failed.'
      ]);
    }
  }

  public function businessList()
  {
      
        $user_plan = $this->app_lib->get_user_plan();
   
		if(!in_array('lead_finder', $user_plan['features']) ){ 
		    redirect(base_url('subscription'));
		}
    $data = [];
    $query = $this->db->where('business_id', $this->business_id)->order_by('id', 'DESC')->get('search_business_list');
    $data['business_list'] = $query->result_array();
    $this->loadView('businessFinder/bussiness_list', $data);
  }
  public function businessDelete()
  {
    $data = [];
    $rawData = file_get_contents('php://input');
    $post = json_decode($rawData);
    
    $query = $this->db->where('id', $post->id)->delete('search_business_list');
    
    if ($query) {
      $list = $this->db->where('user_id', $this->admin_id)->get('search_business_list');
      $data['status'] = true;
      $data['list'] = $list->result_array();
      $data['message'] = "Data deleted successfully.";
    }else{
      $data['status'] = false;
      $data['message'] = "Data deletion failed.";
    }
    echo json_encode($data);
  }
}
