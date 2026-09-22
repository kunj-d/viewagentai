<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vision_lib
{
    public function __construct()
    {
        $CI =& get_instance();
        $this->business_id = $CI->session->userdata('business_id');
        $this->SD_Key = "9gTjhqhgvILJfFhe9bwAO8WT8NBmzOhqYdki4llgrvCmNUy37ScgTvRHnoRB";
        $CI->db->where('business_id',$this->business_id);
	    $CI->db->where('autoresponder_id',40);
	    $CI->db->where('status','1');
	    $data = $CI->db->get('users_autoresponder_settings')->row();
	    if(!empty($data)){
	        $this->SD_Key = json_decode($data->credentials)->api_key;
	    }
        // $this->load->library('input');
    }

    public function generatetexttoImage()
    {
    //   $this->input->post('prompt') this is create a error so i used $_POST;
        $payload = [
            "key" => $this->SD_Key,
            "prompt" => $_POST['prompt'],
            "negative_prompt" => null,
            "width" => "512",
            "height" => "512",
            "samples" => "1",
            "num_inference_steps" => "20",
            "seed" => null,
            "guidance_scale" => 7.5,
            "safety_checker" => "yes",
            "multi_lingual" => "no",
            "panorama" => "no",
            "self_attention" => "no",
            "upscale" => "no",
            "embeddings_model" => null,
            "webhook" => null,
            "track_id" => null
        ];
        
    //   pr($payload);
    //   die;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://stablediffusionapi.com/api/v3/text2img',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        return $response;
    }

    public function generateImagetoImage($img_url)
    {
        $payload = [
            "key" => $this->SD_Key,
            "prompt" => $_POST['prompt'],
            "negative_prompt" => null,
            // "init_image" => "https://raw.githubusercontent.com/CompVis/stable-diffusion/main/data/inpainting_examples/overture-creations-5sI6fQgYIuo.png",
            "init_image" => $img_url,
            "width" => "512",
            "height" => "512",
            "samples" => "1",
            "num_inference_steps" => "30",
            "safety_checker" => "no",
            "enhance_prompt" => "yes",
            "guidance_scale" => 7.5,
            "strength" => 0.7,
            "seed" => null,
            "base64" => "no",
            "webhook" => null,
            "track_id" => null
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://stablediffusionapi.com/api/v3/img2img',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        return $response;
    }

    public function generatetexttoVideo()
    {
        $payload = [
            "key" => $this->SD_Key,
            "prompt" => $_POST['prompt'],
            "model_id" => "zeroscope",
            "negative_prompt" => "low quality",
            "heigh" =>320,
            "width" => 576,
            "num_frames" => 16,
            "num_inference_steps" =>20,
            "guidance_scale" => 7,
            "upscale_height" => 640,
            "upscale_width" => 1024,
            "upscale_strength" => 0.6,
            "upscale_guidance_scale" => 12,
            "upscale_num_inference_steps" => 20,
            "output_type" => "gif",
            "webhook" => null,
            "track_id" => null 
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://modelslab.com/api/v6/video/text2video',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($payload),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        return $response;
    }
    
    public function checkApiKey()
    {
    //   $this->input->post('prompt') this is create a error so i used $_POST;
        $payload = [
            "key" => $_POST['api_key'],
             "prompt"=> "ultra realistic close up portrait ((beautiful pale cyberpunk female with heavy black eyeliner))",
            "negative_prompt" => null,
            "width" => "512",
            "height" => "512",
            "samples" => "1",
            "num_inference_steps" => "20",
            "seed" => null,
            "guidance_scale" => 7.5,
            "safety_checker" => "yes",
            "multi_lingual" => "no",
            "panorama" => "no",
            "self_attention" => "no",
            "upscale" => "no",
            "embeddings_model" => null,
            "webhook" => null,
            "track_id" => null
        ];
        
    

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://stablediffusionapi.com/api/v3/text2img',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        return $response;
    }
    
    
}
