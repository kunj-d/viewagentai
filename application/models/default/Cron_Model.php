<?php

class Cron_Model extends CI_Model

{

	public function get_ffmpeg_queue($where, $select = array('*'), $limit = false){
		$this->db->select(implode(",",$select));

		$this->db->where($where);
		if($limit) {
			$this->db->limit($limit);
		}

		$query=$this->db->get('video');
		return $query->result_array();

	}

	

	public function set_ffmpeg_video_status($id, $status){

		$this->db->set('status', $status);

		$this->db->where('id', $id);

		$this->db->update('video');

	}

	

	public function set_videos_urls($id,$video_slug, $video_urls, $image){

		$this->db->set('url', $video_urls);
		$this->db->set('image', $image);
		$this->db->set('slug', $video_slug);

		$this->db->where('id', $id);
		$this->db->update('video');
		

	}
	
		public function get_filepath($id) {
    // Set the condition to retrieve the row with the given ID
    $this->db->where('id', $id);

    $query = $this->db->get('video');

    if ($query->num_rows() == 1) {
        $row = $query->row();
        return $row->filepath; // Assuming 'filepath' is the column name in database table
    } else {
        return NULL;
    }
}

	
	public function getAllAdminUsers(){

		//$this->db->select('id as owner_id,');

		$query = $this->db->get('user');

		return $query->result_array();

	}

	

	



	public function deleteDir($dir){

		//$dir = './assets/upload/example/' 

		if(is_dir($dir)){

			foreach (directory_map($dir,1) as $item) {

				if ($item == '.' || $item == '..') continue;

				unlink($dir.DIRECTORY_SEPARATOR.$item);

			}

			rmdir($dir);

		}

	}

	public function replaceDir($dir,  $old_slug, $new_slug){

		//$dir = './assets/upload/' 

		if(is_dir($dir.$old_slug.'/')){

			foreach (directory_map($dir.$old_slug.'/',1) as $item) {

				if ($item == '.' || $item == '..') continue;

				$item_new = str_replace($old_slug, $new_slug, $item);

				rename($dir.$old_slug.'/'.DIRECTORY_SEPARATOR.$item, $dir.$old_slug.'/'.DIRECTORY_SEPARATOR.$item_new);

			}

			rename($dir.$old_slug, $dir.$new_slug);

		}

	}

	public function DeleteAmazonS3files($files = array()){		//used by other
        
        $CI =& get_instance();
        $CI->load->model('default/Amazons3_Model');
		foreach($files as $uri){

			$bucket="tubeclawai";					

			$output['sendjson']['DeleteVideo'] = $this->Amazons3_Model->deleteObject($bucket, $uri);

		}

	}

	

	

	public function uploadAWS($sourceFile, $destinationFile="", $bucket = "viewagentai"){
        
        $CI =& get_instance();
        $CI->load->model('default/Amazons3_Model');
        
		if($destinationFile==""){

			$destinationFile = $sourceFile;

		}

		$this->Amazons3_Model->putBucket($bucket);

		// return;

		if(file_exists($sourceFile)){

			if($this->Amazons3_Model->putObjectFile($sourceFile, $bucket , $destinationFile)){

				// unlink($sourceFile);

				return array("status" => true, "message" =>"Upload Success");

			}

			else{

				return array("status" => false, "message" =>"error found");

			}

		}

		else{

			die("file not found");

		}

	}



	public function deleteObject($uri = '', $bucket = 'tubeclawai'){

		/*if($uri == ''){

			return;

		}

		if($this->config->item("server_delete") == 0){

			unlink($uri);

			return;

		}*/

        $CI =& get_instance();
        $CI->load->model('default/Amazons3_Model');

		$this->Amazons3_Model->deleteObject($bucket, $uri);

	}



	function scanAssets(){

		$GLOBALS['files'] = array();

		$this->dirToArray("assets");

		// echo "<pre>";

		// print_r($GLOBALS['files']);

		// echo "</pre>";

		

		if(!isset($_GET['file_id'])){

			redirect("http://localhost/profitmozo/scan?file_id=0");

		}else{

			if(!isset($_GET['file_id'])){

				echo "Assets Uploaded";

				die;

			}

			echo $sourceFile = str_replace("\\", "/", $GLOBALS['files'][$_GET['file_id']]);

			$this->uploadAWS($sourceFile);

			$file_id = $_GET['file_id'] +1;

			// redirect("http://localhost/profitmozo/scan?file_id=". $file_id);

			

				echo "<script> window.location = 'http://localhost/profitmozo/scan?file_id=". $file_id."'; </script>";

		}

	}



	public function dirToArray($dir) {

		$result = array();

		$cdir = scandir($dir);

		foreach ($cdir as $key => $value) {

			if (!in_array($value,array(".","..")))  {

				// echo $dir . DIRECTORY_SEPARATOR . $value . "</br>";

				if (is_dir($dir . DIRECTORY_SEPARATOR . $value)){

					$result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);

				}

				else {

					$result[] = $value;

					$GLOBALS['files'][] = $dir . DIRECTORY_SEPARATOR . $value;

				}

			}

		}

		return $result;

	}
	
	
	public function set_ffmpeg_video_status_s3($video_slug, $status){
	$this->db->set('status', $status);
	$this->db->where('slug', $video_slug);
	$this->db->update('video');
	}


	public function set_videos_urls_s3($video_slug, $video_urls, $image){
		$this->db->set('url', $video_urls); $this->db->set('image', $image);
		$this->db->where('slug', $video_slug);
		$this->db->update('video');
	}

}

