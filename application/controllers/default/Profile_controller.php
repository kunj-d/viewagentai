<?php



defined('BASEPATH') OR exit('No direct script access allowed');

include("AppDefault.php");



class Profile_controller extends AppDefault {

    public function __construct() {

        parent::__construct();

        $this->checkAlreadyLogout();
	$this->Common_Model->checkSubDomain();
        //$this->Common_Model->checkSubDomain();

        $this->user_id = $this->session->userdata('logged_in')['id'];

        $this->owner_id = $this->session->userdata('logged_in')['owner_id'];

        $this->model_folder = $this->config->item('template');
        
        $this->uploadPath = $this->config->item('uploadPath');

        $this->view_folder = $this->config->item('template');

        $this->load->model($this->model_folder . 'Profile_Model');

        $this->permission_msg = $this->config->item('permission_msg');

    }


    public function index() {
        // pr($_POST);die;
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]');
        // $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
        
        if ($this->input->post('change_password') == '1') {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_checkOldPassword');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|callback_checkOldNewPassword');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');
        }
        
        if ($this->form_validation->run() == TRUE) {
            $update_data['name'] = $this->input->post('firstname') . ' ' . $this->input->post('lastname');
            $update_data['phone'] = $this->input->post('phone');
    
            if (!empty($this->input->post('new_password'))) {
                $update_data['password'] = md5($this->input->post('new_password'));
            }
    
            $update_data['modified'] = time();
    
            // Handle profile image upload
            if (!empty($_FILES["avatar_icon"]["name"])) {
                $path = $this->addLibraryImages('avatar_icon', 'profile_image');
                if($path && !empty($path['data']['error'])){
                     $flashdata['error']['message'] = $path['data']['error'];
                    $flashdata['error']['type'] = 'flash';
                    $this->session->set_flashdata('message', json_encode($flashdata));
                    redirect('profile');
                }else{
                     $update_data['profile_image'] = $path;
                }
            }

            $this->Profile_Model->updateUserProfile($this->user_id, $update_data);
    
            // Reset logged_in session
            $this->session->unset_userdata('logged_in');
            $user_data = $this->Profile_Model->getUserProfile($this->user_id);
            $record = (object) $user_data[0];
    
            $parentId = ($record->owner_id == 0) ? $record->id : $record->owner_id;
    
            $sessionArray = array(
                'id' => $record->id,
                'parent_id' => $record->owner_id,
                'owner_id' => $parentId,
                'user_role' => $record->role,
                'email' => $record->email,
                'name' => $record->name,
                'profile_pic' => $record->profile_image,
                'timezone' => $record->timezone,
                'user_package' => $record->user_package,
            );
    
            $this->session->set_userdata('logged_in', $sessionArray);
    
            $flashdata['success']['message'] = 'Profile Update Successfully';
            $flashdata['success']['type'] = 'flash';
            $this->Common_Model->set_user_logs('Update profile Settings', $update_data['name']);
            $this->session->set_flashdata('message', json_encode($flashdata));
    
            redirect('dashboard');
        } 

        $output = array();
        
        $user_data = array();

        $timezone_list = array();

        //get userinfo

        $user_data = $this->Profile_Model->getUserProfile($this->user_id);
        
        $output['user_data'] = $user_data[0];

        //get first_name and last_name

        $output['user_data']['firstname'] = '';

        $output['user_data']['lastname'] = '';

        
        if (!empty($user_data[0]['name'])) {

            $parts = explode(' ', $user_data[0]['name'], 2);

            $output['user_data']['firstname'] = trim(ucfirst($parts[0]));

            if (isset($parts[1])){
                $output['user_data']['lastname'] = trim(ucfirst($parts[1]));
            }else{
                $output['user_data']['lastname'] = '';
            }
        }

        $output['action'] = base_url('profile');

        $output['cancel'] = base_url('dashboard');
        $this->loadView('profile/user-profile', $output);


    }




    public function checkOldPassword($old_password) {

        if ($old_password == ''){
            $this->form_validation->set_message('checkOldPassword', 'The Old Password field shouldn’t be empty.');
            return FALSE;
        }



        $old_password_hash = md5($old_password);

        $user_data = $this->Profile_Model->getUserProfile($this->user_id);

        $old_password_db_hash = $user_data[0]['password'];



        if ($old_password_hash != $old_password_db_hash) {
            $this->form_validation->set_message('checkOldPassword', 'Old password not match');
            return FALSE;
        }

        return TRUE;

    }



    public function checkOldNewPassword($password) {

        $password_hash = md5($password);

        $user_data = $this->Profile_Model->getUserProfile($this->user_id);

        $old_password_db_hash = $user_data[0]['password'];

        if ($password_hash == $old_password_db_hash) {

            $this->form_validation->set_message('checkOldNewPassword', 'New password and old password are same');

            return FALSE;

        }

        return TRUE;
    }



//     public function saveUserProfile() {


//         $flashdata = array();


//         $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|regex_match[/^[a-z][a-z ]*$/i]|min_length[3]');

//         $this->form_validation->set_rules('lastname', 'Last Name', 'trim|regex_match[/^[a-z][a-z ]*$/i]');


// 		if ($this->input->post('change_password') == '1') {
		    
//             $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_checkOldPassword');
    
//             $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|callback_checkOldNewPassword');
    
//             $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');

// 		}



//         if ($this->form_validation->run()) {



//                 $filename = $_FILES["avatar_icon"]["name"] == '' ? 'avatar_btn': 'avatar_icon';

//     			if(!empty($_FILES[$filename]['name'])) {
//     			    $path  =  $this->addLibraryImages($filename,'profile_image');
//     			}
//     			$update_data['profile_image'] = $path; 
//     // 			if(!empty($_FILES[$filename]['name'])) {					
//     // 				$temp_name = $_FILES[$filename]['tmp_name'];					
//     // 				$name = $_FILES[$filename]['name'];					
//     // 				// $size = $_FILES[$filename]['size'];
//     // 				$extension = end(explode('.', $name));
//     // 				$microtime = microtime();
//     // 				$dt = date('m-d-Y');
//     // 				$tm = str_replace(' ','', $microtime);
//     // 				$tm = str_replace('0.','', $tm);
//     // 				$tms = "$dt$tm.$extension"; 
//     // 				$path1 =  "assets/uploads/users/".$this->user_id;
//     // 				if(!is_dir($path1)){
//     // 					mkdir($path1);
//     // 				}
//     // 				$path2 =    "assets/uploads/users/".$this->user_id.'/profile_image/';
//     // 				if(!is_dir($path2)){
//     // 					mkdir($path2);
//     // 				}
//     // 				//echo $path.'/'$tms; die;
//     // 			  $update_data['profile_image'] = $path2.$tms; 
//     // 				move_uploaded_file($temp_name, $path2.$tms);

//     // 			}


//             $update_data['name'] = $this->input->post('firstname') . ' ' . $this->input->post('lastname');


//             $update_data['phone'] = $this->input->post('phone');


// 				if(!empty($this->input->post('new_password'))) {
//                 $update_data['password'] = md5($this->input->post('new_password'));
// 				}



//             $update_data['modified'] = time();



//             $this->Profile_Model->updateUserProfile($this->user_id, $update_data);



//             //******* start reset logged_in session *******//

//             //unset logged_in session

//             $this->session->unset_userdata('logged_in');

//             //get userinfo

//             $user_data = $this->Profile_Model->getUserProfile($this->user_id);

//             $record = (object) $user_data[0];

//             //after update profile update logged_in session

//             if ($record->owner_id == 0) {

//                 $parentId = $record->id;

//             } else {

//                 $parentId = $record->owner_id;

//             }

//             $sessionArray = array(

//                 'id' => $record->id,

//                 'parent_id' => $record->owner_id,

//                 'owner_id' => $parentId,

//                 'user_role' => $record->role,

//                 'email' => $record->email,

//                 'name' => $record->name,

//                 'profile_pic' => $record->profile_image,

//                 'timezone' => $record->timezone,

//                 'user_package' => $record->user_package,

//             );

//             //reset logged_in

//             $this->session->set_userdata('logged_in', $sessionArray);



//             //******* End reset logged_in session *******//


//             $flashdata['success']['message'] = 'Profile Update Successfully';
//             $flashdata['success']['type'] = 'flash';
//             $this->Common_Model->set_user_logs('Update profile Settings', $update_data['name']);
//             $this->session->set_flashdata('message', json_encode($flashdata));
            
//               redirect('dashboard');
//             // $flashdata['redirect'] = 'reload';

//         }
//         else{

//             $flashdata['error']['firstname'] = form_error("firstname");

//             $flashdata['error']['lastname'] = form_error("lastname");


//           if ($this->input->post('change_password') == '1') {

//                 $flashdata['error']['current_password'] = form_error("current_password");

//                 $flashdata['error']['new_password'] = form_error("new_password");

//                 $flashdata['error']['confirm_password'] = form_error("confirm_password");

//           }

//         }

//         echo json_encode($flashdata);
//         die;
       

//     }


   


}