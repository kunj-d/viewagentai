<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* helper created by mahesh*/

if(!function_exists('encrypt_user_token'))
{
    function encrypt_user_token($data)
    {
        $key = 'your-256-bit-secret';  
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); 
        $encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($iv . $encrypted_data);
		
    }
}

if(!function_exists('decript_user_token'))
{
    function decript_user_token($encrypted_token)
    {
        // Decode the base64 encoded string
        $key = 'your-256-bit-secret';  // You can store this securely
        $data = base64_decode($encrypted_token);
    
        // Extract the initialization vector and the encrypted data
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $iv_length);
        $encrypted_data = substr($data, $iv_length);
    
        // Decrypt the data
        $decrypted_data = openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
        
        return $decrypted_data;
		
    }
}


/*if(!function_exists('validateFolderDirectory'))
{
    function validateFolderDirectory($folderName, $imageName='')
    {
        $owner_id=$this->session->userdata("logged_in")["owner_id"];
		$ownerDirectoryName = './assets/uploads/users/' . $owner_id;
		if(!is_dir($ownerDirectoryName)){
			mkdir($ownerDirectoryName, 0755, true);
		}
		$subFolderDirectory=$ownerDirectoryName."/".$folderName;
		if(!is_dir($subFolderDirectory)){
			mkdir($subFolderDirectory, 0755, true);
		}
		
    }
}*/

if(!function_exists('getFileExtension'))
{
    function getFileExtension($thumbnail_url)
    {
         $file_info = pathinfo(parse_url($thumbnail_url, PHP_URL_PATH));
         $file_extension = $file_info['extension'];
		return  $file_extension;
    }
}


if(!function_exists('moveVideoOnS3'))
{
    function moveVideoOnS3($path,$slug)
    {       
        
            $CI =& get_instance();
            $CI->load->model('default/Cron_Model');
             $vidoeFolder =  $path.$slug.'/';
        	//$vidoeFolder = 'assets/uploads/videos/'.$slug.'/';
	    	$dir = './'.$vidoeFolder;
		    if(is_dir($dir)){
		  
			foreach (directory_map($dir,1) as $item) {
				if ($item == '.' || $item == '..') continue;
			
				$CI->Cron_Model->uploadAWS($vidoeFolder . $item);
				unlink('./'.$vidoeFolder . $item);
				/*if (strpos($item, '.png') == false) { //not a png file
					unlink('./'.$vidoeFolder . $item);
					rmdir($dir);
				}*/
			}
		    }
    }
}




if(!function_exists('uploadAwsfile'))
{
    function uploadAwsfile($path)
    {       
        // echo $path; die;
            $CI =& get_instance();
            $CI->load->model('default/Cron_Model');
   
	    	$dir = './'.$path;

				$CI->Cron_Model->uploadAWS($path);
				unlink($path);
			   
		    
    }
}




if(!function_exists('getVideoDetailsPyCurl'))
{
    function getVideoDetailsPyCurl($post_data,$apiUrl)
    {       
        
           
	           
	         $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $apiUrl,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $post_data,
            ));
            
            $response = curl_exec($curl);
            return json_decode($response);
            curl_close($curl);
    }
}


if(!function_exists('downloadImageUrl'))
{
    function downloadImageUrl($vidoeFolder,$path,$image_path)
    {       
        
            $CI =& get_instance();
            $CI->load->model('default/Cron_Model');
	   
		$dir = './'.$vidoeFolder;
	    	$data =  file_get_contents($image_path);

		$upload = file_put_contents($path, $data, FILE_APPEND | LOCK_EX);
		
		 if($upload) {
           	$CI->Cron_Model->uploadAWS($path);
           /*	if(file_exists($path)) {
           	    unlink($path);    
           	}*/
           	
           	//rmdir($dir);
		 }
    }
}


if(!function_exists('getCurlRequests'))
{
    function getCurlRequests($api_url,$api_key)
    {       
        
          $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $api_url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'x-api-key: '.$api_key
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            return  $response;
    }
}


