<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu_manager extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model($this->config->item('adminFolderName') . '/submenu_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Email_template_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Last_login_Model');
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->Common_Modal->load(); //load site settings
    }

    public function create() {

        $menu_id = '';
		$submenu = '';
		$route = '';
		$output['menuData'] = $this->submenu_manager_Model->getAllMenuDetail();
		//echo"<pre>";print_r($output); die;
        if ($_POST) {
            $this->form_validation->set_rules('menu_id', 'Menu', 'trim|required');
			$this->form_validation->set_rules('submenu', 'Submenu', 'trim|required');
			$this->form_validation->set_rules('route', 'Route', 'trim');
            if ($this->form_validation->run()) {
               
                $menu_id = $this->input->post('menu_id');
				$submenu = $this->input->post('submenu');
				$route = $this->input->post('route');

                $update_data['menu_id'] = $menu_id;
				$update_data['submenu'] = $submenu;
				$update_data['route'] = $route;
                $update_data['status'] = 'active';
				$update_data['created'] = time();
                $update_data['modified'] = time();

                $id = $this->submenu_manager_Model->createMenu($update_data);
               

                $this->session->set_userdata('success_msg', 'Submenu Created Successfully');
                redirect($this->config->item('adminName') . '/manage-submenu-manager');
            }
        }
        $output['menu_id'] = $menu_id;
		$output['submenu'] = $submenu;
		$output['route'] = $route;
        $output['page_title'] = 'Create Menu';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/submenu_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function index() {
        $output['status_per'] = 'yes';
        $output['view_per'] = 'yes';
        $output['edit_per'] = 'yes';
        $output['delete_per'] = 'yes';

        $output['keyword'] = $keyword = $this->input->get('keyword');

        $config['base_url'] = base_url($this->config->item('adminName') . '/manage-submenu-manager/?keyword=' . $keyword);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->submenu_manager_Model->getAllCount('', $keyword);
        $config['page_query_string'] = TRUE;

        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $output['paging'] = $this->pagination->create_links();

        $output['list'] = $this->submenu_manager_Model->getRecordList($keyword, $config['per_page'], $currentpage);
        $output['active'] = $this->submenu_manager_Model->getAllCount('active', $keyword);
        $output['inactive'] = $this->submenu_manager_Model->getAllCount('inactive', $keyword);
        $output['total'] = $this->submenu_manager_Model->getAllCount('', $keyword);

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/submenu_manager/list');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function view() {
        $id = $this->input->post('id');
        $output['detail'] = $this->submenu_manager_Model->getMenuDetail($id);
        $response['html'] = $this->load->view($this->config->item('adminFolderName') . '/submenu_manager/view', $output, true);

        $response['success'] = true;
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    function delete($id) {
        $this->submenu_manager_Model->deleteRecord($id);
        $this->session->set_userdata('success_msg', 'Menu Deleted Successfully');
        redirect($this->config->item('adminName') . '/manage-submenu-manager');
    }

    function changeStatus($task, $id) {
		$this->submenu_manager_Model->set_status($task, $id);
        if ($task == 'active') {
            $this->Common_Model->installArticleFromBMS($id);
        }
        $this->session->set_userdata('success_msg', 'Menu Status changed Successfully');
        redirect($this->config->item('adminName') . '/manage-submenu-manager');
    }

    public function edit($id) {
		$output['menuData'] = $this->submenu_manager_Model->getAllMenuDetail();
        $detail = $this->submenu_manager_Model->getMenuDetail($id);
        $menu_id = $detail->menu_id;
		$submenu = $detail->submenu;
		$route = $detail->route;
        if ($_POST) {
            $this->form_validation->set_rules('menu_id', 'Menu', 'trim|required');
			$this->form_validation->set_rules('submenu', 'Sub Menu', 'trim|required');
            $this->form_validation->set_rules('route', 'Route', 'trim');
            
            if ($this->form_validation->run()) {
               
                $menu_id = $this->input->post('menu_id');
				$menu = $this->input->post('submenu');
                $route = $this->input->post('route');
                $product = $this->input->post('product');

                $update_data['submenu'] = $submenu;
                $update_data['route'] = $route;
                $update_data['created'] = time();
                $update_data['modified'] = time();

                $this->submenu_manager_Model->updateMenu($update_data, $id);
                $this->session->set_userdata('success_msg', 'Sub Menu Updated Successfully');
                redirect($this->config->item('adminName') . '/manage-submenu-manager');
            }
        }



        $output['submenu'] = $submenu;
        $output['route'] = $route;
		$output['page_title'] = 'Edit Menu';
        
        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/submenu_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

}
