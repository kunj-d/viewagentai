<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Video_manager extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model($this->config->item('adminFolderName') . '/Video_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Amazons3_video_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Email_template_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Last_login_Model');
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->Common_Modal->load(); //load site settings
        $this->bucket = "kdmeditor";
    }

    public function create()
    {   
        
        $data = [];        
        if ($_FILES || $_POST) {
            $upload_path = './kd_videoeditor/files/templates/';
            $base_url = $this->config->item('cdn_url_1').'kd_videoeditor/files/templates/';
    
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }
            $title = $this->input->post('title');
            $template_category = $this->input->post('template_category');
            $template_type = $this->input->post('template_type');
            $image_url = '';
            $json_url = '';
            $img_error = '';
            $json_error = '';
    
            // ===== Image Upload =====
            if (!empty($_FILES['image']['name'])) {
                $config = [
                    'upload_path'   => $upload_path,
                    'allowed_types' => 'jpg|jpeg|png',
                    // 'file_name'     => time() . '_img'
                ];
                
                $this->load->library('upload');
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('image')) {
                    $img_error = $this->upload->display_errors('', '');
                } else {
                    $upload_data = $this->upload->data();
                    $image_url = $base_url . $upload_data['file_name'];
                    $this->uploadS3Template('kd_videoeditor/files/templates/'.$upload_data['file_name']);
                }
            } else {
                $img_error = 'Image file is required.';
            }
    
            // ===== JSON Upload =====
            if (!empty($_FILES['json_file']['name'])) {
                $config = [
                    'upload_path'   => $upload_path,
                    'allowed_types' => '*',
                    // 'file_name'     => time() . '_json'
                ];
                
                $this->load->library('upload');
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('json_file')) {
                    $json_error = $this->upload->display_errors('', '');
                } else {
                    $upload_data = $this->upload->data();
                    $json_url = $base_url . $upload_data['file_name'];
                    $this->uploadS3Template('kd_videoeditor/files/templates/'.$upload_data['file_name']);
                }
            } else {
                $json_error = 'JSON file is required.';
            }
          
            
            // ===== Video Upload =====
           
                $config = [
                    'upload_path'   => $upload_path,
                    'allowed_types' => 'mp4|gif|mov',
                    'max_size'      => 102400, // in KB (100MB)
                    // 'file_name'     => time() . '_img'
                ];
                
                $this->load->library('upload');
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('video_file')) {
                    $img_error = $this->upload->display_errors('', '');
                } else {
                    $upload_data = $this->upload->data();
                    $video_url = $base_url . $upload_data['file_name'];
                    $this->uploadS3Template('kd_videoeditor/files/templates/'.$upload_data['file_name']);
                }
            
            
            
    
            // ===== Error Handling =====
            if ($img_error || $json_error) {
                $data['img_error'] = $img_error;
                $data['json_error'] = $json_error;
                $data['page_title'] = 'Add Video Template'; // Optional: for header
    
                $this->load->view($this->config->item('adminFolderName') . '/header', $data);
                $this->load->view($this->config->item('adminFolderName') . '/video_manager/create');
                $this->load->view($this->config->item('adminFolderName') . '/footer');
                return;
            }
    
            // ===== Insert to DB =====
            $insert_data = [
                 'title' =>  $title,
                 'template_category' =>  $template_category,
                 'template_type' =>  $template_type,
                'thumbnail_url' => trim($image_url),
                'json_url'  => trim($json_url),
                'video_url'  => trim($video_url)
            ];
   
            $this->Video_manager_Model->insert_template($insert_data);
    
            $this->session->set_flashdata('success_msg', 'Video template uploaded successfully!');
            redirect($this->config->item('adminName') . '/manage-video-manager');
        }
    
        // ===== Show Form Initially =====
        $data['page_title'] = 'Add Video Template';
        $this->load->view($this->config->item('adminFolderName') . '/header', $data);
        $this->load->view($this->config->item('adminFolderName') . '/video_manager/create');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }
    
    public function uploadS3Template($sourceFile){
        
        $this->Amazons3_video_Model->putBucket($this->bucket);
        if (file_exists($sourceFile)) {
            if ($this->Amazons3_video_Model->putObjectFile($sourceFile, $this->bucket, $sourceFile)) {
                unlink($sourceFile);
                return array("status" => true, "message" => "Upload Success");
            } else {
                return array("status" => false, "message" => "error found");
            }
        } else {
            die("file not found");
        }
    }

    public function index()
    {
        $output['status_per'] = 'yes';
        $output['view_per'] = 'yes';
        $output['edit_per'] = 'yes';
        $output['delete_per'] = 'yes';

        $output['keyword'] = $keyword = $this->input->get('keyword');

        $config['base_url'] = base_url($this->config->item('adminName') . '/manage-video-manager/?keyword=' . $keyword);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->Video_manager_Model->getAllCount('', $keyword);
        $config['page_query_string'] = TRUE;

        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $output['paging'] = $this->pagination->create_links();

        $output['list'] = $this->Video_manager_Model->getRecordList($keyword, $config['per_page'], $currentpage);
        $output['active'] = $this->Video_manager_Model->getAllCount('active', $keyword);
        $output['inactive'] = $this->Video_manager_Model->getAllCount('inactive', $keyword);
        $output['total'] = $this->Video_manager_Model->getAllCount('', $keyword);

        if ($this->input->get('product_id')) {
            $output['selected_product_id'] = $this->input->get('product_id');
        }
        if (empty($output['selected_product_id'])) {
            $output['selected_product_id'] = 'all';
        }
        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/video_manager/list');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function view()
    {
        $id = $this->input->post('id');
        $output['detail'] = $this->Video_manager_Model->getVideoDetail($id);
        $response['html'] = $this->load->view($this->config->item('adminFolderName') . '/video_manager/view', $output, true);

        $response['success'] = true;
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    function deletetemplate($id) {
        $this->Video_manager_Model->deleteRecord($id);
        $this->session->set_userdata('success_msg', 'Menu Deleted Successfully');
        redirect($this->config->item('adminName') . '/manage-video-manager');
    }

    function changeStatus($task, $id)
    {
        $this->Video_manager_Model->set_status($task, $id);
        if ($task == 'active') {
            $this->Common_Model->installArticleFromBMS($id);
        }
        $this->session->set_userdata('success_msg', ' Status changed Successfully');
        redirect($this->config->item('adminName') . '/manage-Video-manager');
    }
  
    public function edit_before($id)
    {
        // $query =  $this->Amazons3_video_Model->deleteObject($this->bucket,'kd_videoeditor/files/templates/wrim9zbegw1.mp4');
        $detail = $this->Video_manager_Model->getVideoDetail($id);
        pr($detail);
        die;
        
        
        /*
        $detail = $this->Video_manager_Model->getVideoDetail($id);
        $thumbnail_url = $detail->thumbnail_url;
        $json_url = $detail->json_url;
        if ($_POST) {
            $checkTitle = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('thumbnail_url', 'tbl_menu', array('id' => $id));
            if ($checkTitle[0]['thumbnail_url'] != $this->input->post('thumbnail_url')) {
                $this->form_validation->set_rules('thumbnail_url', 'thumbnail_url', 'trim|required');
            }
            $this->form_validation->set_rules('route', 'Route', 'trim');

            if ($this->form_validation->run()) {

                $thumbnail_url = $this->input->post('thumbnail_url');
                $json_url = $this->input->post('rojson_urlute');
                $product = $this->input->post('product');

                $update_data['thumbnail_url'] = $thumbnail_url;
                $update_data['json_url'] = $json_url;
                // $update_data['created'] = time();
                // $update_data['modified'] = time();

                $this->Video_manager_Model->updateVideo($update_data, $id);
                $this->session->set_userdata('success_msg', 'Blog Updated Successfully');
                redirect($this->config->item('adminName') . '/manage-video-manager');
            }
        }
        */


        $output['thumbnail_url'] = $thumbnail_url;
        $output['json_url'] = $json_url;
        $output['page_title'] = 'Edit Video';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/video_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }
    
    public function edit($id){
            $data = [];
        
            // Fetch existing template data
            $template = $this->Video_manager_Model->getVideoDetail($id);
            if (!$template) {
                show_404();
                return;
            }
        
            if ($_FILES || $_POST) {
                $upload_path = './kd_videoeditor/files/templates/';
                $base_url = $this->config->item('cdn_url_1') . 'kd_videoeditor/files/templates/';
        
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0755, true);
                }
        
                $title = $this->input->post('title');
                $template_category = $this->input->post('template_category');
                $template_type = $this->input->post('template_type');
                $image_url = str_replace('https://kdmeditor.s3.us-east-1.amazonaws.com/', '', $template->thumbnail_url);
                $json_url  = str_replace('https://kdmeditor.s3.us-east-1.amazonaws.com/', '', $template->json_url);
                $video_url = str_replace('https://kdmeditor.s3.us-east-1.amazonaws.com/', '', $template->video_url);
                
                $img_error = '';
                $json_error = '';
        
                $update_data = [];
        
                // ===== Image Upload =====
                if (!empty($_FILES['image']['name'])) {
                    $config = [
                        'upload_path'   => $upload_path,
                        'allowed_types' => 'jpg|jpeg|png',
                    ];
        
                    $this->load->library('upload');
                    $this->upload->initialize($config);
        
                    if (!$this->upload->do_upload('image')) {
                        $img_error = $this->upload->display_errors('', '');
                    } else {
                        $this->Amazons3_video_Model->deleteObject($this->bucket, $image_url);
                        $upload_data = $this->upload->data();
                        $image_url = $base_url . $upload_data['file_name'];
                        $this->uploadS3Template('kd_videoeditor/files/templates/' . $upload_data['file_name']);
                        $update_data['thumbnail_url'] = trim($image_url);
                    }
                }
        
                // ===== JSON Upload =====
                if (!empty($_FILES['json_file']['name'])) {
                    $config = [
                        'upload_path'   => $upload_path,
                        'allowed_types' => '*',
                    ];
        
                    $this->load->library('upload');
                    $this->upload->initialize($config);
        
                    if (!$this->upload->do_upload('json_file')) {
                        $json_error = $this->upload->display_errors('', '');
                    } else {
                        $this->Amazons3_video_Model->deleteObject($this->bucket, $json_url);
                        $upload_data = $this->upload->data();
                        $json_url = $base_url . $upload_data['file_name'];
                        $this->uploadS3Template('kd_videoeditor/files/templates/' . $upload_data['file_name']);
                        $update_data['json_url'] = trim($json_url);
                    }
                }
        
                // ===== Video Upload =====
                if (!empty($_FILES['video_file']['name'])) {
                    $config = [
                        'upload_path'   => $upload_path,
                        'allowed_types' => 'mp4|gif|mov',
                    ];
        
                    $this->load->library('upload');
                    $this->upload->initialize($config);
        
                    if (!$this->upload->do_upload('video_file')) {
                        $img_error = $this->upload->display_errors('', '');
                    } else {
                        $this->Amazons3_video_Model->deleteObject($this->bucket, $video_url);
                        $upload_data = $this->upload->data();
                        $video_url = $base_url . $upload_data['file_name'];
                        $this->uploadS3Template('kd_videoeditor/files/templates/' . $upload_data['file_name']);
                        $update_data['video_url'] = trim($video_url);
                    }
                }
        
                // ===== Title Update =====
                if (!empty($title)) {
                    $update_data['title'] = $title;
                }
                if (!empty($template_category)) {
                    $update_data['template_category'] = $template_category;
                }
                if (!empty($template_type)) {
                    $update_data['template_type'] = $template_type;
                }
                

        
        
                // ===== Error Handling =====
                if ($img_error || $json_error) {
                    $data['img_error'] = $img_error;
                    $data['json_error'] = $json_error;
                    $data['template'] = $template;
                    $data['page_title'] = 'Edit Video Template';
        
                    $this->load->view($this->config->item('adminFolderName') . '/header', $data);
                    $this->load->view($this->config->item('adminFolderName') . '/video_manager/edit');
                    $this->load->view($this->config->item('adminFolderName') . '/footer');
                    return;
                }
        
                // ===== DB Update Call =====
                if (!empty($update_data)) {
                    $this->Video_manager_Model->update_columns($id, $update_data);
                    $this->session->set_flashdata('success_msg', 'Video template updated successfully!');
                } else {
                    $this->session->set_flashdata('success_msg', 'No fields to update.');
                }
        
                redirect($this->config->item('adminName') . '/manage-video-manager');
            }
        
            // ===== Show Form Initially =====
            $data['template'] = $template;
            $data['page_title'] = 'Edit Video Template';
        
            $this->load->view($this->config->item('adminFolderName') . '/header', $data);
            $this->load->view($this->config->item('adminFolderName') . '/video_manager/edit');
            $this->load->view($this->config->item('adminFolderName') . '/footer');
        }


    
    
    
    
}
