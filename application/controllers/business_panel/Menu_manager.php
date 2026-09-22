<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_manager extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model($this->config->item('adminFolderName') . '/menu_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Email_template_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Last_login_Model');
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->Common_Modal->load(); //load site settings
    }

    public function create() {

        $menu = '';
		$route = '';
        if ($_POST) {
            $this->form_validation->set_rules('menu', 'Menu', 'trim|required');
			$this->form_validation->set_rules('route', 'Route', 'trim');
            if ($this->form_validation->run()) {
               
                $menu = $this->input->post('menu');
				$route = $this->input->post('route');

                $update_data['menu'] = $menu;
				$update_data['route'] = $route;
                $update_data['status'] = 'active';
				$update_data['created'] = time();
                $update_data['modified'] = time();

                $id = $this->menu_manager_Model->createMenu($update_data);
               

                $this->session->set_userdata('success_msg', 'menu Created Successfully');
                redirect($this->config->item('adminName') . '/manage-menu-manager');
            }
        }
        $output['menu'] = $menu;
		$output['route'] = $route;
        $output['page_title'] = 'Create Menu';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/menu_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function index() {
        $output['status_per'] = 'yes';
        $output['view_per'] = 'yes';
        $output['edit_per'] = 'yes';
        $output['delete_per'] = 'yes';

        $output['keyword'] = $keyword = $this->input->get('keyword');

        $config['base_url'] = base_url($this->config->item('adminName') . '/manage-menu-manager/?keyword=' . $keyword);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->menu_manager_Model->getAllCount('', $keyword);
        $config['page_query_string'] = TRUE;

        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $output['paging'] = $this->pagination->create_links();

        $output['list'] = $this->menu_manager_Model->getRecordList($keyword, $config['per_page'], $currentpage);
        $output['active'] = $this->menu_manager_Model->getAllCount('active', $keyword);
        $output['inactive'] = $this->menu_manager_Model->getAllCount('inactive', $keyword);
        $output['total'] = $this->menu_manager_Model->getAllCount('', $keyword);

		if($this->input->get('product_id')){
			$output['selected_product_id'] = $this->input->get('product_id');
		}
		if(empty($output['selected_product_id'])){
			$output['selected_product_id']= 'all';
		}
        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/menu_manager/list');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function view() {
        $id = $this->input->post('id');
        $output['detail'] = $this->menu_manager_Model->getMenuDetail($id);
        $response['html'] = $this->load->view($this->config->item('adminFolderName') . '/menu_manager/view', $output, true);

        $response['success'] = true;
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    function delete($id) {
        $this->menu_manager_Model->deleteRecord($id);
        $this->session->set_userdata('success_msg', 'Menu Deleted Successfully');
        redirect($this->config->item('adminName') . '/manage-menu-manager');
    }

    function changeStatus($task, $id) {
		$this->menu_manager_Model->set_status($task, $id);
        if ($task == 'active') {
            $this->Common_Model->installArticleFromBMS($id);
        }
        $this->session->set_userdata('success_msg', 'Menu Status changed Successfully');
        redirect($this->config->item('adminName') . '/manage-menu-manager');
    }

    public function edit($id) {
       
        $detail = $this->menu_manager_Model->getMenuDetail($id);
        $menu = $detail->menu;
		$route = $detail->route;
        if ($_POST) {
            $checkTitle = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('menu', 'tbl_menu', array('id' => $id));
            if ($checkTitle[0]['menu'] != $this->input->post('menu')) {
                $this->form_validation->set_rules('menu', 'Menu', 'trim|required');
            }
            $this->form_validation->set_rules('route', 'Route', 'trim');
            
            if ($this->form_validation->run()) {
               
                $menu = $this->input->post('menu');
                $route = $this->input->post('route');
                $product = $this->input->post('product');

                $update_data['menu'] = $menu;
                $update_data['route'] = $route;
                $update_data['created'] = time();
                $update_data['modified'] = time();

                $this->menu_manager_Model->updateMenu($update_data, $id);
                $this->session->set_userdata('success_msg', 'Blog Updated Successfully');
                redirect($this->config->item('adminName') . '/manage-menu-manager');
            }
        }



        $output['menu'] = $menu;
        $output['route'] = $route;
		$output['page_title'] = 'Edit Menu';
        
        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/menu_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

}
