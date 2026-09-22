<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_manager extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model($this->config->item('adminFolderName') . '/Product_manager_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Email_template_Model');
        $this->load->model($this->config->item('adminFolderName') . '/Last_login_Model');
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->Common_Modal->load(); //load site settings
    }

    public function create() {

        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        //$this->Common_Modal->checkForPageAccess($manager_id,false,'redirect');
        $output['all_market_place'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('*', 'market_place');

        $price = '';
        $title = '';
        $slug = '';
        $thumbnail = '';
        $content = '';
        $has_purchased = '';
        $package_plan = '';
        $sales_page_url = '';
        $market_place = '';
        $ipn_product_id = '';
        $cb_ipn_product_id = '';
        $zip_file_url = '';
        $zip_file_url_upsell = '';
        $free_report_url = '';

        if ($_POST) {

            $title = $this->input->post('title');
            $slug = $this->input->post('slug');
            $content = $this->input->post('content');
            $has_purchased = $this->input->post('has_purchased');
            $sales_page_url = $this->input->post('sales_page_url');
            $market_place = $this->input->post('market_place');
            $ipn_product_id = $this->input->post('ipn_product_id');
            $cb_ipn_product_id = $this->input->post('cb_ipn_product_id');
            $price = $this->input->post('price');
            $zip_file_url = $this->input->post('zip_file_url');
            $zip_file_url_upsell = $this->input->post('zip_file_url_upsell');
            $free_report_url = $this->input->post('free_report_url');

            $this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[default_products.title]');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[default_products.slug]');
            //set thumbnail validation
            if (empty($_FILES['thumbnail']['name'])) {
                $this->form_validation->set_rules('thumbnail', 'Thumbnail', 'required');
            }
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            $this->form_validation->set_rules('has_purchased', 'Product Type', 'trim|required');
            $this->form_validation->set_rules('sales_page_url', 'Sales Page Url', 'trim|required');
            $this->form_validation->set_rules('market_place', 'Market Place', 'trim|required');
            $this->form_validation->set_rules('ipn_product_id', 'Ipn Product Id', 'trim|required');
            $this->form_validation->set_rules('cb_ipn_product_id', 'ClickBank Ipn Product Id', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            $this->form_validation->set_rules('zip_file_url', 'Customer Front End plan Zip File URL', 'trim|required');
            $this->form_validation->set_rules('zip_file_url_upsell', 'Customer Upsell plan Zip File URL', 'trim|required');
            $this->form_validation->set_rules('free_report_url', 'Buyer(Member) Free Report Url', 'trim|required');
            $this->form_validation->set_rules('package_plan[]', 'Product Plan', 'trim|required');



            if ($this->form_validation->run()) {
                if (!empty($_FILES['thumbnail']["name"])) {
                    $config = array();
                    $config['upload_path'] = './assets/uploads/default_product_images';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '';
                    $config['overwrite'] = TRUE;
                    $filename = 'product_' . rand(10) . "_" . time();
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
                        $update_data['image'] = $this->config->item('uploadPath')."default_product_images/".$data1["file_name"];
                    }
                }


                $update_data['title'] = $title;
                $update_data['slug'] = $slug;
                $update_data['content'] = $content;
                $update_data['status'] = 'inactive';
                $update_data['has_purchased'] = $has_purchased == 'for_use' ? '1' : '0';
                $update_data['sales_page_url'] = $sales_page_url;
                $update_data['market_place'] = $market_place;
                $update_data['ipn_product_id'] = $ipn_product_id;
                $update_data['cb_ipn_product_id'] = $cb_ipn_product_id;
                $update_data['price'] = $price;
                //$update_data['zip_file_url'] = $zip_file_url;
                //$update_data['free_report_url'] = $free_report_url;
                $update_data['created'] = time();
                $update_data['modified'] = time();

                $id = $this->Product_manager_Model->createProduct($update_data);
                if ($id > 0) {
                    $this->Product_manager_Model->deleteAddedPlanProduct($id);
                    $this->Product_manager_Model->addPlanProduct($id);

                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'enduser';
                    $update_data1['material_type'] = 'free_report';
                    $update_data1['file_type'] = 'NA';
                    $update_data1['file_url'] = $free_report_url;
                    $update_data1['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');

                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'customer';
                    $update_data1['material_type'] = 'fe';
                    $update_data1['file_type'] = 'zip';
                    $update_data1['file_url'] = $zip_file_url;
                    $update_data1['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');


                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'customer';
                    $update_data1['material_type'] = 'upsell';
                    $update_data1['file_type'] = 'zip';
                    $update_data1['file_url'] = $zip_file_url_upsell;
                    $update_data1['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');
                }
                //$this->Product_manager_Model->modifyProduct($id,$html_file,$thumbnail);
                $this->session->set_userdata('success_msg', 'Product Created Successfully');
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }

        if (!empty($this->input->post('package_plan'))) {
            $output['save_plan_id'] = $this->input->post('package_plan');
        } else {
            $output['save_plan_id'] = array();
        }

        $output['package_plan'] = $this->Product_manager_Model->packagePlanList();
        $output['title'] = $title;
        $output['slug'] = $slug;
        $output['ipn_product_id'] = $ipn_product_id;
        $output['cb_ipn_product_id'] = $cb_ipn_product_id;
        $output['price'] = $price;
        $output['zip_file_url'] = $zip_file_url;
        $output['zip_file_url_upsell'] = $zip_file_url_upsell;
        $output['free_report_url'] = $free_report_url;
        $output['market_place'] = 'jvzoo';
        $output['has_purchased'] = $has_purchased;
        $output['content'] = $content;
        $output['sales_page_url'] = $sales_page_url;
        $output['page_title'] = 'Create Product';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function index() {

        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        $output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id, 'edit');
        $output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id, 'view');
        $output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id, 'delete');
        $output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id, 'status');
        $output['keyword'] = $keyword = $this->input->get('keyword');

        $config['base_url'] = base_url($this->config->item('adminName') . '/manage-product-manager/?keyword=' . $keyword);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->Product_manager_Model->getAllCount('', $keyword);
        $config['page_query_string'] = TRUE;

        $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);
        $output['paging'] = $this->pagination->create_links();



        $output['list'] = $this->Product_manager_Model->getRecordList($keyword, $config['per_page'], $currentpage);
        $output['package_plans'] = $this->Product_manager_Model->getProductPlan();
        $output['active'] = $this->Product_manager_Model->getAllCount('active', $keyword);
        $output['inactive'] = $this->Product_manager_Model->getAllCount('inactive', $keyword);
        $output['total'] = $this->Product_manager_Model->getAllCount('', $keyword);

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/list');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    public function view() {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $id = $this->input->post('id');

        $output['detail'] = $product_data = $this->Product_manager_Model->getProductDetail($id);

        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'enduser';
        $where['material_type'] = 'free_report';
        $output['free_report_urls'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);

        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'customer';
        $where['material_type'] = 'fe';
        $output['customer_fe_zip_url'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);

        // print_r($output['customer_fe_zip_url']);
        // die;

        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'customer';
        $where['material_type'] = 'upsell';
        $output['customer_upsell_zip_url'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);

        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'enduser';
        $where['material_type'] = 'fe';
        $where['file_type'] = 'pdf';
        $output['fe_guides_urls'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);


        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'enduser';
        $where['material_type'] = 'fe';
        $where['file_type'] = 'video';
        $output['fe_videos_urls'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);

        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'enduser';
        $where['material_type'] = 'upsell';
        $where['file_type'] = 'pdf';
        $output['upsell_guides_urls'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);


        $where = array();
        $where['product_id'] = $id;
        $where['customer_type'] = 'enduser';
        $where['material_type'] = 'upsell';
        $where['file_type'] = 'video';
        $output['upsell_videos_urls'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', $where);

        $response['html'] = $this->load->view($this->config->item('adminFolderName') . '/product_manager/view', $output, true);

        $response['success'] = true;
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    public function edit($id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        $detail = $this->Product_manager_Model->getProductDetail($id);
        $output['all_market_place'] = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('*', 'market_place');
        $title = $detail->title;
        $slug = $detail->slug;
        $thumbnail = $detail->image;
        $content = $detail->content;
        $has_purchased = $detail->has_purchased;
        $sales_page_url = $detail->sales_page_url;
        $market_place = $detail->market_place;
        $ipn_product_id = $detail->ipn_product_id;
        $cb_ipn_product_id = $detail->cb_ipn_product_id;
        $price = $detail->price;
        $zip_file_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $id, 'customer_type' => 'customer', 'material_type' => 'fe'));
        $zip_file_url = $zip_file_array[0]['file_url'];
        $zip_file_array1 = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $id, 'customer_type' => 'customer', 'material_type' => 'upsell'));
        $zip_file_url_upsell = $zip_file_array1[0]['file_url'];
        $free_report_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $id, 'customer_type' => 'enduser', 'material_type' => 'free_report'));
        ;
        $free_report_url = $free_report_array[0]['file_url'];
        if ($_POST) {
            $_POST['id'] = $id;
            $this->form_validation->set_rules('title', 'Title', 'trim|required|callback_check_product_title');
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|callback_check_product_slug');
            $this->form_validation->set_rules('content', 'Content', 'trim|required');
            $this->form_validation->set_rules('has_purchased', 'Product Type', 'trim|required');
            $this->form_validation->set_rules('sales_page_url', 'Sales Page Url', 'trim|required');
            $this->form_validation->set_rules('market_place', 'Market Place', 'trim|required');
            $this->form_validation->set_rules('ipn_product_id', 'Ipn Product Id', 'trim|required');
            $this->form_validation->set_rules('cb_ipn_product_id', 'ClickBank Product Id', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required');
            $this->form_validation->set_rules('zip_file_url', 'Customer Front End plan Zip File URL', 'trim|required');
            $this->form_validation->set_rules('zip_file_url_upsell', 'Customer Upsell plan Zip File URL', 'trim|required');
            $this->form_validation->set_rules('free_report_url', 'Buyer(Member) Free Report Url', 'trim|required');
            $this->form_validation->set_rules('package_plan[]', 'Package Plan', 'trim|required');
            if ($this->form_validation->run()) {
                if (!empty($_FILES['thumbnail']["name"])) {
                    $config = array();
                    $config['upload_path'] = './assets/uploads/default_product_images';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '';
                    $config['overwrite'] = TRUE;
                    $filename = 'product_' . rand(10) . "_" . time();
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
                        $update_data['image'] = $this->config->item('uploadPath')."default_product_images/".$data1["file_name"];
                    }
                }
                $title = $this->input->post('title');
                $slug = $this->input->post('slug');
                $content = $this->input->post('content');
                $has_purchased = $this->input->post('has_purchased');
                $sales_page_url = $this->input->post('sales_page_url');
                $market_place = $this->input->post('market_place');
                $ipn_product_id = $this->input->post('ipn_product_id');
                $cb_ipn_product_id = $this->input->post('cb_ipn_product_id');
                $price = $this->input->post('price');
                $zip_file_url = $this->input->post('zip_file_url');
                $zip_file_url_upsell = $this->input->post('zip_file_url_upsell');
                $free_report_url = $this->input->post('free_report_url');

                $update_data['title'] = $title;
                $update_data['slug'] = $slug;
                $update_data['content'] = $content;
                //$update_data['status'] = 'inactive';
                $update_data['has_purchased'] = $has_purchased == 'for_use' ? '1' : '0';
                $update_data['sales_page_url'] = $sales_page_url;
                $update_data['market_place'] = $market_place;
                $update_data['ipn_product_id'] = $ipn_product_id;
                $update_data['cb_ipn_product_id'] = $cb_ipn_product_id;
                $update_data['price'] = $price;
                //$update_data['created'] = time();
                $update_data['modified'] = time();

                $this->Product_manager_Model->updateProduct($update_data, $id);
                $this->Product_manager_Model->deleteAddedPlanProduct($id);
                $this->Product_manager_Model->addPlanProduct($id);			
				/* add monthly membership*/				
				if (in_array("35", $this->input->post('package_plan')))		
				{ 				
					$this->db->select("tbl_user.id");			
					$this->db->from("tbl_user");		
					$this->db->where("tbl_package_purchase.package_id","35");		
					$this->db->where("tbl_user.status","active");			
					$this->db->join("tbl_package_purchase","tbl_user.id=tbl_package_purchase.user_id","INNER");	
					$this->db->group_by('tbl_user.id'); 		
					$query=$this->db->get();			
					$rec=$query->result_array();			
								
				}	
				if (in_array("49", $this->input->post('package_plan')))		
				{ 				
					$this->db->select("tbl_user.id");			
					$this->db->from("tbl_user");		
					$this->db->where("tbl_package_purchase.package_id","49");		
					$this->db->where("tbl_user.status","active");			
					$this->db->join("tbl_package_purchase","tbl_user.id=tbl_package_purchase.user_id","INNER");	
					$this->db->group_by('tbl_user.id'); 		
					$query=$this->db->get();			
					$rec=$query->result_array();			
								
				}
				if (in_array("50", $this->input->post('package_plan')))		
				{ 				
					$this->db->select("tbl_user.id");			
					$this->db->from("tbl_user");		
					$this->db->where("tbl_package_purchase.package_id","50");		
					$this->db->where("tbl_user.status","active");			
					$this->db->join("tbl_package_purchase","tbl_user.id=tbl_package_purchase.user_id","INNER");	
					$this->db->group_by('tbl_user.id'); 		
					$query=$this->db->get();			
					$rec=$query->result_array();			
								
				}
				if (in_array("51", $this->input->post('package_plan')))		
				{ 				
					$this->db->select("tbl_user.id");			
					$this->db->from("tbl_user");		
					$this->db->where("tbl_package_purchase.package_id","51");		
					$this->db->where("tbl_user.status","active");			
					$this->db->join("tbl_package_purchase","tbl_user.id=tbl_package_purchase.user_id","INNER");	
					$this->db->group_by('tbl_user.id'); 		
					$query=$this->db->get();	
					$rec=$query->result_array();			
								
				}
				/**/	

                if (!empty($free_report_url)) {
                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'enduser';
                    $update_data1['material_type'] = 'free_report';
                    $update_data1['file_type'] = 'NA';
                    $update_data1['file_url'] = $free_report_url;
                    $update_data1['created'] = time();

                    $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $id, 'customer_type' => 'enduser', 'material_type' => 'free_report'));
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');
                }

                if (!empty($zip_file_url)) {
                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'customer';
                    $update_data1['material_type'] = 'fe';
                    $update_data1['file_type'] = 'zip';
                    $update_data1['file_url'] = $zip_file_url;
                    $update_data1['created'] = time();
                    $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $id, 'customer_type' => 'customer', 'material_type' => 'fe'));
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');
                }
                if (!empty($zip_file_url_upsell)) {
                    $update_data1['product_id'] = $id;
                    $update_data1['customer_type'] = 'customer';
                    $update_data1['material_type'] = 'upsell';
                    $update_data1['file_type'] = 'zip';
                    $update_data1['file_url'] = $zip_file_url_upsell;
                    $update_data1['created'] = time();
                    $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $id, 'customer_type' => 'customer', 'material_type' => 'upsell'));
                    $this->Common_Modal->insertRowInAnyTable($update_data1, 'default_products_material');
                }
                $this->session->set_userdata('success_msg', 'Product Updated Successfully');
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }


        $output['package_plan'] = $this->Product_manager_Model->packagePlanList();
        $output['save_plan_id'] = $this->Product_manager_Model->savedPackagePlanList($id);

        $output['title'] = $title;
        $output['slug'] = $slug;
        $output['content'] = $content;
        $output['market_place'] = $market_place;
        $output['has_purchased'] = $has_purchased;
        $output['content'] = $content;
        $output['sales_page_url'] = $sales_page_url;
        $output['ipn_product_id'] = $ipn_product_id;
        $output['cb_ipn_product_id'] = $cb_ipn_product_id;
        $output['price'] = $price;
        $output['zip_file_url'] = $zip_file_url;
        $output['zip_file_url_upsell'] = $zip_file_url_upsell;
        $output['free_report_url'] = $free_report_url;
        $output['page_title'] = 'Edit Product';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/edit');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    function check_product_title($str) {
        if (empty(trim($str))) {
            $this->form_validation->set_message('check_product_title', 'The {field} field  is required.');
            return FALSE;
        }

        $this->db->where('id !=', $this->input->post('id'));
        $this->db->where('title', $str);
        $query = $this->db->get('default_products');
        if ($query->num_rows()) {
            $this->form_validation->set_message('check_product_title', 'The {field}  must contain a unique value.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_product_slug($str) {
        if (empty(trim($str))) {
            $this->form_validation->set_message('check_product_slug', 'The {field} field  is required.');
            return FALSE;
        }

        $this->db->where('id !=', $this->input->post('id'));
        $this->db->where('slug', $str);
        $query = $this->db->get('default_products');
        if ($query->num_rows()) {
            $this->form_validation->set_message('check_product_slug', 'The {field}  must contain a unique value.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function delete($id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $this->session->set_userdata('success_msg', 'Product delete funtionality is locked.');
        redirect($this->config->item('adminName') . '/manage-product-manager');
        die;




        $this->Common_Modal->deleteRowsFromAnyTable('default_blogs', array('product_id' => $id));
        $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $id));

        $dir = './application/views/products_sales_pages/squeeze/' . $id;
        $this->rrmdir($dir);
        $dir = './application/views/products_sales_pages/fe/' . $id;
        $this->rrmdir($dir);
        $dir = './application/views/products_sales_pages/upsell/' . $id;
        $this->rrmdir($dir);
        $this->Common_Modal->deleteRowsFromAnyTable('endusers_sales_pages_html', array('product_id' => $id));
        $this->Common_Modal->deleteRowsFromAnyTable('default_products', array('id' => $id));

        $this->session->set_userdata('success_msg', 'Product Deleted Successfully');
        redirect($this->config->item('adminName') . '/manage-product-manager');
    }

    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function changeStatus($task, $id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        if ($task == 'inactive') {
            $this->session->set_userdata('success_msg', 'Product inactive funtionality is locked.');
            redirect($this->config->item('adminName') . '/manage-product-manager');
            die;
        } else {
            $this->Product_manager_Model->set_status($task, $id);
            $has_purchased = $this->Common_Modal->getSingleFieldFromAnyTable('has_purchased', 'id', $id, 'default_products');
            // if($has_purchased=='1')
            // $this->Product_manager_Model->addProductInUserProducts($id);
            $this->Common_Model->installSingleProductInAllUsers($id);
            $this->session->set_userdata('success_msg', 'Product Status changed Successfully');
            redirect($this->config->item('adminName') . '/manage-product-manager');
        }
    }

    function productSalesPagesSetting($prod_id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $product_data_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('id,title', 'default_products', array('id' => $prod_id));
        $output['product_title'] = $product_data_array[0]['title'];
        if ($_POST || $_FILES) {
            $html_data['html_file'] = $_FILES['html_file']["name"];
            $html_data['assets_file'] = $_FILES['assets_file']["name"];

            $html_data['html_file1'] = $_FILES['html_file1']["name"];
            $html_data['assets_file1'] = $_FILES['assets_file1']["name"];

            $html_data['html_file2'] = $_FILES['html_file2']["name"];
            $html_data['assets_file2'] = $_FILES['assets_file2']["name"];

            $html_data['html_file3'] = $_FILES['html_file3']["name"];
            $html_data['assets_file3'] = $_FILES['assets_file3']["name"];
            $this->form_validation->set_data($html_data);
            //$this->form_validation->set_rules('prod_id','Product Id','trim|numeric');
            $this->form_validation->set_rules('html_file', 'Html File', 'trim|required');
            $this->form_validation->set_rules('assets_file', 'Html assets zip file', 'trim|required');

            $this->form_validation->set_rules('html_file1', 'Html File', 'trim|required');
            $this->form_validation->set_rules('assets_file1', 'Html assets zip file', 'trim|required');

            $this->form_validation->set_rules('html_file2', 'Html File', 'trim|required');
            $this->form_validation->set_rules('assets_file2', 'Html assets zip file', 'trim|required');

            $this->form_validation->set_rules('html_file3', 'Html File', 'trim|required');
            $this->form_validation->set_rules('assets_file3', 'Html assets zip file', 'trim|required');
            if ($this->form_validation->run()) {
                $data1 = $this->upload_sales_pages_files($prod_id, 'squeeze');
                $data2 = $this->upload_sales_pages_files($prod_id, 'fe');
                $data3 = $this->upload_sales_pages_files($prod_id, 'upsell');
                $data3 = $this->upload_sales_pages_files($prod_id, 'jvpages');
                if ($data1 && $data2 && $data3) {
                    $this->session->set_userdata('success_msg', 'EndUser Sales pages settings saved successfully.');
                } else {
                    $this->session->set_userdata('error', 'Some Error occur.');
                }
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }
        $output['prod_id'] = $prod_id;
        $output['page_title'] = 'End User Sales Pages Settings';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/sales-pages-settings');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    function upload_sales_pages_files($prod_id, $type) {
        $salesPageDirectoryPath = 'application/views/products_sales_pages/' . $type . '/' . $prod_id;
        $salesPageAsstsDirectoryPath = 'assets/uploads/products_sales_pages_assets/' . $type . '/' . $prod_id;
        $data1 = false;
        $data2 = false;
        $salesPageDirectory = './' . $salesPageDirectoryPath;
        if (!is_dir($salesPageDirectory)) {
            mkdir($salesPageDirectory, 0755, true);
        }
        $salesPageAssetsDirectory = './' . $salesPageAsstsDirectoryPath;
        if (!is_dir($salesPageAssetsDirectory)) {
            mkdir($salesPageAssetsDirectory, 0755, true);
        }
        if ($type == 'squeeze') {
            $html_file_name = 'html_file';
            $assets_file_name = 'assets_file';
        }
        if ($type == 'fe') {
            $html_file_name = 'html_file1';
            $assets_file_name = 'assets_file1';
        }

        if ($type == 'upsell') {
            $html_file_name = 'html_file2';
            $assets_file_name = 'assets_file2';
        }

        if ($type == 'jvpages') {
            $html_file_name = 'html_file3';
            $assets_file_name = 'assets_file3';
        }

        $this->load->library('upload');
        if (!empty($_FILES[$html_file_name]["name"])) {
            $config = array();
            $config['upload_path'] = './' . $salesPageDirectoryPath . '/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '';
            $config['file_name'] = 'index.php';
            $config['overwrite'] = TRUE;
            $html_file = $config['file_name'];

            $this->upload->initialize($config);
            $this->upload->do_upload($html_file_name);

            $data1 = $this->upload->data();
        }
        if (!empty($_FILES[$assets_file_name]["name"])) {
            $config = array();
            $config['upload_path'] = './' . $salesPageAsstsDirectoryPath . '/';
            $config['allowed_types'] = '*';
            $config['overwrite'] = TRUE;
            $config['max_size'] = '';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($assets_file_name)) {
                $output['assets_file_error'] = $this->upload->display_errors();
            } else {
                $data2 = $this->upload->data();
                $file_name = $data2['file_name'];
                $zip = new ZipArchive;
                $file = $data2['full_path'];
                chmod($file, 0777);
                if ($zip->open($file) === TRUE) {
                    $paths = './' . $salesPageAsstsDirectoryPath;
                    $zip->extractTo($paths);
                    $zip->close();
                    unlink($file);
                }
            }
        }
        if ($data1 && $data2) {
            $update_data['product_id'] = $prod_id;
            $update_data['page_type'] = $type;
            $update_data['filepath'] = $salesPageDirectoryPath . '/index.php';
            $update_data['created'] = time();
            $this->Common_Modal->deleteRowsFromAnyTable('endusers_sales_pages_html', array('product_id' => $prod_id, 'page_type' => $type));
            $this->Common_Modal->insertRowInAnyTable($update_data, 'endusers_sales_pages_html');
            return true;
        } else {
            return false;
        }
    }

    function productMaterialsSetting($prod_id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $product_data_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('id,title', 'default_products', array('id' => $prod_id));
        $output['product_title'] = $product_data_array[0]['title'];
        $def_count = 5;
        $output['guide_urls_counts'] = 4;
        $output['video_urls_counts'] = $def_count;

        $guide_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('title,file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'pdf'));
        $output['guide_urls'] = array_column($guide_urls_array, 'file_url');
        if(count($guide_urls_array)>0){
            $output['guide_urls_titles'] = array_column($guide_urls_array, 'title');
        }else{
            $output['guide_urls_titles'] = array('Training Guide','Cheat Sheet','Mind Map','Top Resource Report');
        }
        

        $video_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('title,file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'video'));
        $output['video_urls'] = array_column($video_urls_array, 'file_url');
        if(count($guide_urls_array)>0){
            $output['video_urls_titles'] = array_column($video_urls_array, 'title');
        }else{
            $output['video_urls_titles'] = array('Video 1','Video 2','Video 3','Video 4','Video 5');
        }

        $output['guide_urls_counts'] = $output['guide_urls'] ? count($output['guide_urls']) : $output['guide_urls_counts'];
        $output['video_urls_counts'] = $output['video_urls'] ? count($output['video_urls']) : $output['video_urls_counts'];

        if ($_POST) {
            $output['guide_urls_counts'] = count($this->input->post('guide_urls'));
            $output['video_urls_counts'] = count($this->input->post('video_urls'));

            $output['guide_urls'] = $guide_urls = $this->input->post('guide_urls');
            $output['video_urls'] = $video_urls = $this->input->post('video_urls');
            $output['guide_urls_titles'] = $guide_urls_titles = $this->input->post('guide_urls_titles');
            $output['video_urls_titles'] = $video_urls_titles = $this->input->post('video_urls_titles');

            $this->form_validation->set_rules('guide_urls[]', 'Step By Step Guide', 'trim|required');
            $this->form_validation->set_rules('video_urls[]', 'Video URL', 'trim|required');
            $this->form_validation->set_rules('guide_urls_titles[]', 'Step By Step Guide title', 'trim|required');
            $this->form_validation->set_rules('video_urls_titles[]', 'Video URL title', 'trim|required');
            if ($this->form_validation->run()) {

                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'pdf'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'fe';
                $insert_data['file_type'] = 'pdf';
                foreach ($guide_urls as $key => $val) {
                    $insert_data['title'] = $guide_urls_titles[$key];
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }


                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'video'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'upsell';
                $insert_data['file_type'] = 'video';
                foreach ($video_urls as $key => $val) {
                    $insert_data['title'] = $video_urls_titles[$key];
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }

                $this->session->set_userdata('success_msg', 'Front-end materials settings saved successfully.');
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }

        
        $output['prod_id'] = $prod_id;
        $output['page_title'] = 'Front-End Materials Settings';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/materials-settings');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }
    function productFeMaterialsSetting($prod_id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');

        $product_data_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('id,title', 'default_products', array('id' => $prod_id));
        $output['product_title'] = $product_data_array[0]['title'];
        $def_count = 5;
        $output['guide_urls_counts'] = $def_count;
        $output['video_urls_counts'] = $def_count;

        $guide_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'pdf'));
        $output['guide_urls'] = array_column($guide_urls_array, 'file_url');

        $video_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'video'));
        $output['video_urls'] = array_column($video_urls_array, 'file_url');


        $output['guide_urls_counts'] = $output['guide_urls'] ? count($output['guide_urls']) : $output['guide_urls_counts'];
        $output['video_urls_counts'] = $output['video_urls'] ? count($output['video_urls']) : $output['video_urls_counts'];

        if ($_POST) {
            // print_r($_POST);
            // die;
            $output['guide_urls_counts'] = count($this->input->post('guide_urls'));
            $output['video_urls_counts'] = count($this->input->post('video_urls'));

            $output['guide_urls'] = $guide_urls = $this->input->post('guide_urls');
            $output['video_urls'] = $video_urls = $this->input->post('video_urls');
            $output['guide_urls_titles'] = $guide_urls_titles = $this->input->post('guide_urls_titles');
            $output['video_urls_titles'] = $video_urls_titles = $this->input->post('video_urls_titles');

            $this->form_validation->set_rules('guide_urls[]', 'Step By Step Guide', 'trim|required');
            $this->form_validation->set_rules('video_urls[]', 'Video URL', 'trim|required');
            $this->form_validation->set_rules('guide_urls_titles[]', 'Step By Step Guide title', 'trim|required');
            $this->form_validation->set_rules('video_urls_titles[]', 'Video URL title', 'trim|required');
            if ($this->form_validation->run()) {
                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'pdf'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'fe';
                $insert_data['file_type'] = 'pdf';
                foreach ($guide_urls as $key => $val) {
                    $insert_data['title'] = $guide_urls_titles[$key];
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }


                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'fe', 'file_type' => 'video'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'fe';
                $insert_data['file_type'] = 'video';
                foreach ($video_urls as $key => $val) {
                    $insert_data['title'] = $video_urls_titles[$key];
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }

                $this->session->set_userdata('success_msg', 'Front-end materials settings saved successfully.');
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }


        $output['prod_id'] = $prod_id;
        $output['page_title'] = 'Front-End Materials Settings';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/materials-settings');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

    

    function productUpsellMaterialsSetting($prod_id) {
        $output['manager_id'] = $manager_id = 51;
        $this->Common_Modal->checkForPageAccess($manager_id, '', 'redirect');
        $product_data_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('id,title', 'default_products', array('id' => $prod_id));
        $output['product_title'] = $product_data_array[0]['title'];
        $def_count = 5;
        $output['guide_urls_counts'] = $def_count;
        $output['video_urls_counts'] = $def_count;

        $guide_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'pdf'));
        $output['guide_urls'] = array_column($guide_urls_array, 'file_url');

        $video_urls_array = $this->Common_Modal->getSelectedRowsAndFieldsFromAnyTable('file_url', 'default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'video'));
        $output['video_urls'] = array_column($video_urls_array, 'file_url');


        $output['guide_urls_counts'] = $output['guide_urls'] ? count($output['guide_urls']) : $output['guide_urls_counts'];
        $output['video_urls_counts'] = $output['video_urls'] ? count($output['video_urls']) : $output['video_urls_counts'];

        if ($_POST) {
            $output['guide_urls_counts'] = count($this->input->post('guide_urls'));
            $output['video_urls_counts'] = count($this->input->post('video_urls'));

            $output['guide_urls'] = $guide_urls = $this->input->post('guide_urls');
            $output['video_urls'] = $video_urls = $this->input->post('video_urls');

            $this->form_validation->set_rules('guide_urls[]', 'Step By Step Guide', 'trim|required');
            $this->form_validation->set_rules('video_urls[]', 'Video URL', 'trim|required');
            if ($this->form_validation->run()) {
                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'pdf'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'upsell';
                $insert_data['file_type'] = 'pdf';
                foreach ($guide_urls as $key => $val) {
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }


                $insert_data = array();
                $this->Common_Modal->deleteRowsFromAnyTable('default_products_material', array('product_id' => $prod_id, 'customer_type' => 'enduser', 'material_type' => 'upsell', 'file_type' => 'video'));
                $insert_data['product_id'] = $prod_id;
                $insert_data['customer_type'] = 'enduser';
                $insert_data['material_type'] = 'upsell';
                $insert_data['file_type'] = 'video';
                foreach ($video_urls as $key => $val) {
                    $insert_data['file_url'] = $val;
                    $insert_data['created'] = time();
                    $this->Common_Modal->insertRowInAnyTable($insert_data, 'default_products_material');
                }

                $this->session->set_userdata('success_msg', 'Upsell materials settings saved successfully.');
                redirect($this->config->item('adminName') . '/manage-product-manager');
            }
        }


        $output['prod_id'] = $prod_id;
        $output['page_title'] = 'Upsell Materials Settings';

        $this->load->view($this->config->item('adminFolderName') . '/header', $output);
        $this->load->view($this->config->item('adminFolderName') . '/product_manager/materials-settings');
        $this->load->view($this->config->item('adminFolderName') . '/footer');
    }

}
