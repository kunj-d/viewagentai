<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_manager extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model($this->config->item('adminFolderName') . '/Product_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Blog_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Email_template_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Last_login_Model');
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->Common_Modal->load(); //load site settings
    }

    public function create() {
        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        $output['product_detail'] = $this->Blog_manager_Model->productDetail();
        $title = '';
        $thumbnail = '';
        $content = '';
        if ($_POST) {
            $this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[default_blogs.title]');
            $this->form_validation->set_rules('product', 'Product', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            //$this->form_validation->set_rules('package_plan[]','Package Plan','trim|required');
            if ($this->form_validation->run()) {
                if (!empty($_FILES['thumbnail']["name"])) {
                    $config = array();
                    $config['upload_path'] = './assets/uploads/default_blog_images';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '';
                    $config['overwrite'] = TRUE;
                    $filename = 'blog_' . rand(10, 100) . "_" . time();
                    $config['file_name'] = $filename;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('thumbnail');
                    if ($data1 = $this->upload->data()) {
                        if ($data1["image_width"] > 1024) { // for image compression
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $data1['full_path'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 1024;
                            $config['height'] = $data1["image_height"];
                            $this->image_lib->initialize($config);
                            $resize_image_data = $this->image_lib->resize();
                        }
                        $update_data['image'] = $this->config->item('uploadPath').'default_blog_images/' . $data1["file_name"];
                    }
                }
                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $product = $this->input->post('product');

                $update_data['title'] = $title;
                $update_data['product_id'] = $product;
                $update_data['status'] = 'inactive';
                $update_data['description'] = $content;
                $update_data['created'] = time();
                $update_data['modified'] = time();

                $id = $this->Blog_manager_Model->createProduct($update_data);
                // $this->Blog_manager_Model->deleteAddedPlanProduct($id);
                // $this->Blog_manager_Model->addPlanProduct($id);

                $this->session->set_userdata('success_msg', 'Product Created Successfully');
                redirect($this->config->item('adminName') . '/manage-blog-manager');
            }
        }
        $output['title'] = $title;
        $output['content'] = $content;
        $output['page_title'] = 'Create Blog';

        //$output['package_plan']=$this->Product_manager_Model->packagePlanList();


        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/blog_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function index() {

        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        // $output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
        // $output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
        // $output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
        // $output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');

        $output['status_per'] = 'yes';
        $output['view_per'] = 'yes';
        $output['edit_per'] = 'yes';
        $output['delete_per'] = 'yes';

        $output['keyword'] = $keyword = $this->input->get('keyword');

        $config['base_url'] = base_url($this->config->item('adminName') . '/manage-blog-manager/?keyword=' . $keyword);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->Blog_manager_Model->getAllCount('', $keyword);
        $config['page_query_string'] = TRUE;

        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $output['paging'] = $this->pagination->create_links();



        $output['list'] = $this->Blog_manager_Model->getRecordList($keyword, $config['per_page'], $currentpage);
        $output['active'] = $this->Blog_manager_Model->getAllCount('active', $keyword);
        $output['inactive'] = $this->Blog_manager_Model->getAllCount('inactive', $keyword);
        $output['total'] = $this->Blog_manager_Model->getAllCount('', $keyword);

		$output['all_products'] = $this->Blog_manager_Model->productDetail();
		
		if($this->input->get('product_id')){
			$output['selected_product_id'] = $this->input->get('product_id');
		}
		if(empty($output['selected_product_id'])){
			$output['selected_product_id']= 'all';
		}
		// print_r($output['all_products']);
		// die;
        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/blog_manager/list');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function view() {
        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $id = $this->input->post('id');

        $output['detail'] = $this->Blog_manager_Model->getBlogDetail($id);
        $response['html'] = $this->load->view($this->config->item('adminFolderName') . '/blog_manager/view', $output, true);

        $response['success'] = true;
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    function delete($id) {

        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $this->Blog_manager_Model->deleteRecord($id);
        $this->session->set_userdata('success_msg', 'Blog Deleted Successfully');
        redirect($this->config->item('adminName') . '/manage-blog-manager');
    }

    function changeStatus($task, $id) {
        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $this->Blog_manager_Model->set_status($task, $id);

        if ($task == 'active') {
            $this->Common_Model->installArticleFromBMS($id);
        }
        $this->session->set_userdata('success_msg', 'Blog Status changed Successfully');
        redirect($this->config->item('adminName') . '/manage-blog-manager');
    }

    public function edit($id) {
        $output['manager_id'] = $manager_id = 58;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $output['product_detail'] = $this->Blog_manager_Model->productDetail();
        $detail = $this->Blog_manager_Model->getBlogDetail($id);
        $title = $detail->title;
        $thumbnail = $detail->image;
        $content = $detail->description;
        $product_id = $detail->product_id;
        if ($_POST) {
            $checkTitle = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('title', 'default_blogs', array('id' => $id));
            if ($checkTitle[0]['title'] != $this->input->post('title')) {
                $this->form_validation->set_rules('title', 'Title', 'trim|required');
            }
            $this->form_validation->set_rules('product', 'Product', 'trim|required');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            //$this->form_validation->set_rules('package_plan[]','Package Plan','trim|required');

            if ($this->form_validation->run()) {
                if (!empty($_FILES['thumbnail']["name"])) {
                    $config = array();
                    $config['upload_path'] = './assets/uploads/default_blog_images';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '';
                    $config['overwrite'] = TRUE;
                    $filename = 'product_' . rand(10, 100) . "_" . time();
                    $config['file_name'] = $filename;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $this->upload->do_upload('thumbnail');
                    if ($data1 = $this->upload->data()) {
                        if ($data1["image_width"] > 1024) { // for image compression
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $data1['full_path'];
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 1024;
                            $config['height'] = $data1["image_height"];
                            $this->image_lib->initialize($config);
                            $resize_image_data = $this->image_lib->resize();
                        }
                        $update_data['image'] = $this->config->item('uploadPath').'default_blog_images/' . $data1["file_name"];
                    }
                }
                $title = $this->input->post('title');
                $content = $this->input->post('content');
                $product = $this->input->post('product');

                $update_data['title'] = $title;
                $update_data['description'] = $content;
                $update_data['created'] = time();
                $update_data['modified'] = time();

                $this->Blog_manager_Model->updateBlog($update_data, $id);
                // $this->Blog_manager_Model->deleteAddedPlanProduct($id);
                // $this->Blog_manager_Model->addPlanProduct($id);

                $this->session->set_userdata('success_msg', 'Blog Updated Successfully');
                redirect($this->config->item('adminName') . '/manage-blog-manager');
            }
        }



        $output['title'] = $title;
        $output['product_id'] = $product_id;
        $output['content'] = $content;
        $output['product_id'] = $product_id;
        $output['page_title'] = 'Edit Product';

        // $output['package_plan']=$this->Product_manager_Model->packagePlanList();
        // $output['save_plan_id']=$this->Blog_manager_Model->savedPackagePlanList($id);

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/blog_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

}
