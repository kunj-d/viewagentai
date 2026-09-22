<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_manager extends CI_Controller {

	function __construct(){ 
	    parent::__construct();				
		$this->load->model($this->config->item('adminFolderName').'/Template_manager_Model');
		$this->load->model($this->config->item('adminFolderName').'/Email_template_Model');
		$this->load->model($this->config->item('adminFolderName').'/Last_login_Model');
		$this->load->library('pagination');
		$this->load->library('image_lib');
		$this->Common_Modal->load(); //load site settings 
	}
	
	public function index(){
		
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'','redirect'); 
		$output['edit_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'edit');
		$output['view_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'view');
		$output['delete_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'delete');
		$output['status_per'] = $this->Common_Modal->checkForPageAccess($manager_id,'status');
		$output['keyword'] = $keyword = $this->input->get('keyword');
		
		$config['base_url'] = base_url($this->config->item('adminName').'/manage-template-manager/?keyword='.$keyword);
		$config['per_page'] = 10;
		$config['total_rows'] = $this->Template_manager_Model->getAllCount('',$keyword);
		$config['page_query_string'] = TRUE;
		
	    $currentpage = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $this->pagination->initialize($config);	
		
	    $output['paging']=$this->pagination->create_links();
		$output['list'] = $this->Template_manager_Model->getRecordList($keyword,$config['per_page'],$currentpage);
		$output['package_plans']=$this->Template_manager_Model->getTemplatePlan();
		$output['active'] = $this->Template_manager_Model->getAllCount('active',$keyword);
		$output['inactive'] = $this->Template_manager_Model->getAllCount('inactive',$keyword);
		$output['total'] = $this->Template_manager_Model->getAllCount('',$keyword);
		$output['template_type']=$this->Template_manager_Model->getTemplateCategory("tbl_template_type");
		$output['template_industry']=$this->Template_manager_Model->getTemplateCategory("tbl_template_industry");
		$output['template_position']=$this->Template_manager_Model->getTemplateCategory("tbl_template_position");
		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/template_manager/list');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function view(){
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'view','redirect');

		$id = $this->input->post('id');

		$output['detail'] = $this->Template_manager_Model->getTemplateDetail($id);
		$response['html'] = $this->load->view($this->config->item('adminFolderName').'/template_manager/view',$output,true);

		$response['success'] = true;
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($response));
	}

	public function create(){

	$output['manager_id'] = $manager_id = 23;
	$this->Common_Modal->checkForPageAccess($manager_id,'','redirect');
	$output['options']=$this->Template_manager_Model->getTemplateCategory("tbl_template_type");
	$output['industry']=$this->Template_manager_Model->getTemplateCategory("tbl_template_industry");
	$output['position']=$this->Template_manager_Model->getTemplateCategory("tbl_template_position");
		if($_POST){
					
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$html_file = "";
			$zip = "";
			$thumbnail = "";	
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('slug','Slug','trim|required');
			//$this->form_validation->set_rules('html_file','HTML File','trim|required');
			//$this->form_validation->set_rules('zip','Assests','trim');
			//$this->form_validation->set_rules('thumbnail','Thumbnail','trim');
			//$this->form_validation->set_rules('content','Content','trim|required');

				if($this->form_validation->run()){
					$id=$this->Template_manager_Model->addTemplate();					
					$this->Template_manager_Model->addPlanTemplate($id);
					 if(!empty($_FILES['zip']["name"])){
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/';
						$config['allowed_types'] = '*';
						$config['max_size']    = '';
						$this->load->library('upload', $config);
						if(!$this->upload->do_upload('zip')){	
								$output['img_error'] = $img_error = $this->upload->display_errors();	
							} else {
							$data = $this->upload->data();
							$file_name= $data['file_name'];
							$zip = new ZipArchive;
							$file = $data['full_path'];
							chmod($file,0777);
							if($zip->open($file) === TRUE){
									$paths='./assets/uploads/templates/template'.$id;
									if(!is_dir($paths)) {
										mkdir($paths, 0777, TRUE);
									}
									$zip->extractTo($paths);
									$zip->close();
									unlink($file);
							} else {
									}
						}
					}
					if(!empty($_FILES['thumbnail']["name"])){
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/thumbnail';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['max_size']    = '';
						$new_name = 'template"'.$id.'"';
						$config['file_name']='template'.$id.".".'png';
						$thumbnail=$config['file_name'];
						$this->load->library('upload', $config);
						$this->upload->initialize($config); 
						$this->upload->do_upload('thumbnail');
						$data1 = $this->upload->data();
						if($data1["image_width"]>1000){ // for image compression 
							$config['image_library'] = 'gd2';
							$config['source_image'] = $data1['full_path'];
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 1000;
							$config['height'] = $data1["image_height"];
							$this->image_lib->initialize($config);
							$resize_image_data=$this->image_lib->resize();
						}	
					}
					if(!empty($_FILES['html_file']["name"])){
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/';
						$config['allowed_types'] = 'html';
						$config['max_size']    = '';
						$new_name = 'template"'.$id.'"';
						$config['file_name']='template'.$id.".".'html';
						$html_file=$config['file_name'];
						$this->load->library('upload', $config);
						$this->upload->initialize($config); 
						$this->upload->do_upload('html_file');
						$data1 = $this->upload->data();

					}
					$this->Template_manager_Model->modifyTemplate($id,$html_file,$thumbnail);
					$this->session->set_userdata('success_msg','Template Created Successfully');
					redirect($this->config->item('adminName').'/manage-template-manager');		
				}
		}
		$output['package_plan']=$this->Template_manager_Model->packagePlanList();	
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['type'] = $subject;
		$output['content'] = $message;
		$output['page_title'] = 'Add New Template';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/template_manager/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	public function edit($id){
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'edit','redirect');
		$detail = $this->Template_manager_Model->getTemplateDetail($id);
		
		$output['options']=$this->Template_manager_Model->getTemplateCategory("tbl_template_type");
		$output['industry']=$this->Template_manager_Model->getTemplateCategory("tbl_template_industry");
		$output['position']=$this->Template_manager_Model->getTemplateCategory("tbl_template_position");
		$thumbnail=$detail->thumbnail;
		$html_file=$detail->filename;
		$title = $detail->title;
		$slug = $detail->slug;
		$type = $detail->type;
		$business_type_id = $detail->business_type_id;
		$type = $detail->type;
		$position = $detail->position;
		$industry = $detail->industry;
		$content = $detail->content;
		
		if($_POST)		{
			
			$title= $this->input->post('title');
			$slug = $this->input->post('slug');	
			$this->form_validation->set_rules('title','Title','trim|required');
			$this->form_validation->set_rules('slug','Slug','trim|required');			
			if($this->form_validation->run())
			 {
				// echo "df";die;
			   $this->Template_manager_Model->updateTemplate($id);
			   $this->Template_manager_Model->deleteAddedTemplate($id);
			   $this->Template_manager_Model->addPlanTemplate($id);
			   if(!empty($_FILES['zip']["name"])){
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/';
						$config['allowed_types'] = '*';
						$config['max_size']    = '';
						$config['overwrite']    = TRUE;
						$this->load->library('upload', $config);
						if(!$this->upload->do_upload('zip')){	
								$output['img_error'] = $img_error = $this->upload->display_errors();	
						} 
						else {
							$data = $this->upload->data();
							$file_name= $data['file_name'];
							$zip = new ZipArchive;
							$file = $data['full_path'];
							chmod($file,0777);
							if($zip->open($file) === TRUE){
									$paths='./assets/uploads/templates/template'.$id;
									if(!is_dir($paths)) {
										mkdir($paths, 0777, TRUE);
									}
									$zip->extractTo($paths);
									$zip->close();
									unlink($file);
							}
						}
					}
					if(!empty($_FILES['thumbnail']["name"])){
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/thumbnail';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						$config['max_size']    = '';
						$config['overwrite']    = TRUE;
						$new_name = 'template"'.$id.'"';
						$config['file_name']='template'.$id.".".'png';
						$thumbnail=$config['file_name'];
						$this->load->library('upload', $config);
						$this->upload->initialize($config); 
						$this->upload->do_upload('thumbnail');
						$data1 = $this->upload->data();
						if($data1["image_width"]>1024){ // for image compression 
							$config['image_library'] = 'gd2';
							$config['source_image'] = $data1['full_path'];
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 1024;
							$config['height'] = $data1["image_height"];
							$this->image_lib->initialize($config);
							$resize_image_data=$this->image_lib->resize();
						}	
					}
					if(!empty($_FILES['html_file']["name"])){
						
						$config=array();
						$config['upload_path'] = './assets/uploads/templates/';
						$config['allowed_types'] = 'html';
						$config['max_size']    = '';
						$config['overwrite']    = TRUE;
						$new_name = 'template"'.$id.'"';
						$config['file_name']='template'.$id.".".'html';
						$html_file=$config['file_name'];
						$this->load->library('upload', $config);
						$this->upload->initialize($config); 
						$this->upload->do_upload('html_file');
						$data1 = $this->upload->data();

					}
					$this->Template_manager_Model->modifyTemplate($id,$html_file,$thumbnail);
					$this->session->set_userdata('success_msg','Template Created Successfully');
					redirect($this->config->item('adminName').'/manage-template-manager');	
			 }
			 
		}
		$output['package_plan']=$this->Template_manager_Model->packagePlanList();
		$output['save_plan_id']=$this->Template_manager_Model->savedPackagePlanList($id);
		$output['title'] = $title;
		$output['slug'] = $slug;
		$output['type'] = $type;
		$output['position_val'] = $position;
		$output['industry_val'] = $industry;
		$output['business_type_id'] = $business_type_id;
		$output['content'] = $content;
		$output['page_title'] = 'Edit Template Manager';

		$this->load->view($this->config->item('adminFolderName').'/header',$output);
		$this->load->view($this->config->item('adminFolderName').'/template_manager/edit');
		$this->load->view($this->config->item('adminFolderName').'/footer');
	}
	
	function delete($id){
	
	   $output['manager_id'] = $manager_id = 24;
	   $this->Common_Modal->checkForPageAccess($manager_id,'delete','redirect');
		$this->Template_manager_Model->deleteRecord($id);
	   $this->session->set_userdata('success_msg','Template Deleted Successfully');
	   redirect($this->config->item('adminName').'/manage-template-manager');
	}
	
	function changeStatus($task,$id){
	
		$output['manager_id'] = $manager_id = 24;
		$this->Common_Modal->checkForPageAccess($manager_id,'status','redirect');
		$this->Template_manager_Model->set_status($task,$id);
		$this->session->set_userdata('success_msg','Template Status changed Successfully');
		redirect($this->config->item('adminName').'/manage-template-manager');
	}
	
}