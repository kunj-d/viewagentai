<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('AppDefault.php');


class Dashboard_controller extends AppDefault{

	public function __construct()
	{
		parent::__construct();
		$this->checkAlreadyLogout();
		$this->Common_Model->checkSubDomain();
 		$this->owner_id = $this->session->userdata('logged_in')['owner_id'];
 		$this->user_id = $this->session->userdata('logged_in')['id'];
 		
        $this->view_folder = $this->config->item('template');
        $this->model_folder = $this->view_folder;
        $this->load->model($this->model_folder . "Business_model");
 	
 		if(!empty($this->session->userdata('business'))){
 		    $this->business_id = $this->session->userdata('business')['id'];
 		}else{
 		    $this->business_id = $this->session->userdata('business_switch_session');
 		}

	}

	public function index(){
	    $output= array();
	   $this->session->unset_userdata('project_name');
	   $this->session->unset_userdata('mp4_session');
	    $this->db->where('status', 'yes');
	    $this->db->where('business_id',$this->business_id);
        $query = $this->db->get('prompts');
        $output['grabiris_active'] = $query->num_rows();
        
	    $this->db->where('status', 'no');
	    $this->db->where('business_id',$this->business_id);
        $query = $this->db->get('prompts');
        $output['grabiris_inactive'] = $query->num_rows(); 
        
        //aigentarmy_assests_count
         $this->db->where('business_id',$this->business_id);
        $query = $this->db->get('smart_library_objects');
        $output['assets_count'] = $query->num_rows();
        
          //aigentarmy_workspace_count
         $this->db->where('user_id',$this->user_id);
        $query = $this->db->get('business');
        $output['workspace_count'] = $query->num_rows();
        
         //aigentarmy Text_to_Image_count
         $this->db->where('business_id',$this->business_id);
         $this->db->where('	type','text-to-image');
        $query = $this->db->get('ai_generation');
        $output['text_to_imaget_count'] = $query->num_rows();
        
        //aigentarmy Image_to_Image
         $this->db->where('business_id',$this->business_id);
         $this->db->where('	type','image-to-image');
        $query = $this->db->get('ai_generation');
        $output['image_to_image_count'] = $query->num_rows();
        
        //Avatar Count 
        $this->db->where('business_id',$this->business_id);
        $this->db->where('video_status','heygen');
        $query = $this->db->get('library');
        $output['avatar_count'] = $query->num_rows();
        
        //video count
        $this->db->where('business_id',$this->business_id);
        $this->db->where('video_status','publish');
        $query = $this->db->get('user_render_videos');
        $output['video_count'] = $query->num_rows();
        
        
        //Youtube Video count
        $this->db->where('business_id',$this->business_id);
        $this->db->where('status',1);
        $query = $this->db->get('youtube_publisher');
        $output['youtube_video_count'] = $query->num_rows();

        //total analyze video count
        $this->db->where('business_id', $this->business_id);
        $query = $this->db->get('analyz_data');
        $output['total_analyzed_videos'] = $query->num_rows();      
        // pr($output['total_analyzed_videos']); die('current_week_count');

        //total optimized count
        $this->db->where('business_id', $this->business_id);
        $this->db->where('optimized', 1);
        $query_optimized = $this->db->get('analyz_data');
        $output['total_optimized_videos'] = $query_optimized->num_rows();

        // pr($output['total_optimized_videos']); die('analyze count');

        // total aeo score
        $this->db->select('AVG(answer_engine_score) as avg_aeo_score');
        $this->db->where('business_id', $this->business_id);
        $aeo_query = $this->db->get('analyz_data')->row_array();

        // pr($aeo_query); die('aeo score');

        $output['average_aeo_score'] = !empty($aeo_query['avg_aeo_score']) ? round($aeo_query['avg_aeo_score']) : 0;
        // pr($output['average_aeo_score']); die('aeo score');


        // score improvement
        $this->db->where('business_id', $this->business_id);
        $this->db->where('optimized', 1);
        $increased_count = $this->db->get('analyz_data')->num_rows();
        $output['increased_videos'] = $increased_count;

        $this->db->where('business_id', $this->business_id);
        $this->db->where('optimized', 0);
        $no_change_count = $this->db->get('analyz_data')->num_rows();
        $output['no_change_videos'] = $no_change_count;

       $total_videos = $increased_count + $no_change_count;

        $improvement_percentage = 0;
        if ($total_videos > 0) {
            $improvement_percentage = round(($increased_count / $total_videos) * 100);
        }

        $output['improvement_percentage'] = $improvement_percentage;
        // pr($output['no_change_videos']); die('improvement_percentage');
        
        //aigentarmy Text_to_GIF_count
        //  $this->db->where('business_id',$this->business_id);
        //  $this->db->where('	type','text-to-video');
        // $query = $this->db->get('ai_generation');
        // $output['text_to_video_count'] = $query->num_rows();
        
        // 100 apps Favorite Apps
        //  $this->db->select('customer_app_sets .*');
        //  // $this->db->join('app_template_category ', 'app_template_category.atc_id = customer_apps.ca_atc_id', 'left');
        //  $this->db->where('cas_business_id ',$this->business_id);
        //  $this->db->where('cas_is_favourite ',1);
        //   $this->db->where('cas_status ',1);
        //  $output['favorite_apps'] = $this->db->get('customer_app_sets')->result_array();
        //  $str=$this->db->last_query();
        //  echo $str;
        //  die();
        
        $this->db->select('package_id');
        $this->db->where('status', 'active');
        $this->db->where('user_id', $this->owner_id);
        $query = $this->db->get('tbl_package_purchase');
        if ($query->num_rows() > 0) {
            $package_data = $query->result_array();
            $purchase_plan_ids = $output['purchase_plan_ids'] = array_column($package_data, 'package_id');
        } else {
            $purchase_plan_ids = $output['purchase_plan_ids'] = array();
        }
        
         
       // echo "<pre>"; print_r($output['favorite_apps']); die;
        
        //query for work done
        $this->db->where('business_id', $this->business_id);
        $this->db->where('library_folder_id !=', 0); 
        $query = $this->db->get('smart_library_objects');
         $output['grabiris_work_count'] = $query->num_rows();
         
         //query for total chat-bot
         $this->db->where('business_id', $this->business_id);
         $this->db->where('assistant_status', 'custom');
         $query = $this->db->get('prompts');
         $output['total_chatBot_count'] = $query->num_rows();
        
    
         $sql="select chatgpt.prompt_id,prompts.text as emp_name, count(*) as popular from chatgpt, prompts where chatgpt.prompt_id = prompts.id and chatgpt.business_id=".$this->business_id." group by chatgpt.prompt_id order by popular desc limit 5";    
         $query = $this->db->query($sql);
         $output['popular']= $query->result_array();
         
         
          $sql="select autoresponder_lead_data.prompt_id, count(*) as lead, prompts.text as emp_name from autoresponder_lead_data, prompts where autoresponder_lead_data.prompt_id = prompts.id and prompts.business_id=".$this->business_id." group by autoresponder_lead_data.prompt_id order by lead desc limit 5";    
         $query = $this->db->query($sql);
         $output['leads']= $query->result_array();
         
        $this->db->select('count(*) as count_rows'); 
        $this->db->where('business_id',$this->business_id);
        $query = $this->db->get('autoresponder_lead_data');
        $lead_count_row = $query->row_array();
        $lead_count= $lead_count_row['count_rows']; 
        $output['lead_count']= $lead_count;
        
        $this->db->select('count(*) as count_rows'); 
        $this->db->where('business_id',$this->business_id);
	    $this->db->where('lead_view_status',0);
        $query = $this->db->get('autoresponder_lead_data');
        $lead_count_row = $query->row_array();
        $lead_count= $lead_count_row['count_rows']; 
        $output['new_lead_count']= $lead_count;
        
        
        
        
        // $this->db->select('count(*) as count_rows');
        // $this->db->where('cas_business_id',$this->business_id);
        // $this->db->where('cas_status',1);
        // $query = $this->db->get('customer_app_sets');
        // $app_count_row = $query->row_array();
        // $app_count= $app_count_row['count_rows']; 
        // $output['app_count']= $app_count;
        
        
        
       /*  $this->db->select('prompt_id, COUNT(autoresponder_lead_data.id) as lead_count, prompts.text')->from('autoresponder_lead_data');
        $this->db->join('prompts', 'autoresponder_lead_data.prompt_id = prompts.id', 'left')->group_by('prompt_id');
    	$this->db->where("autoresponder_lead_data.business_id", $this->business_id);

        $query = $this->db->get();
        $output['leads'] = $query->result_array();*/
        $business_data = $this->Business_model->get_businesses_data();
         $output['business_count']= count($business_data);
         
         
          $available_features = [];
        
        if(in_array('agent_general',$this->session->userdata('features'))) {
            $available_features[] = "general";
        }
        if(in_array('agent_pro',$this->session->userdata('features'))) {
            $available_features[] = "pro";
        }
        if(in_array('agent_premium',$this->session->userdata('features'))) {
            $available_features[] = "premium";
        }
         
        $output['available_features'] = $available_features;
        
        
        $this->team_create_avatar = true;
        $this->team_create_video = true;
        $this->team_edit_video = true;
        $this->team_templates = true;
        $this->team_youtube_publisher = true;
        
        if ($this->user_id != $this->owner_id) {
            if (!in_array('create_avatar', $this->all_team_privileges)) {
                $this->team_create_avatar = false;
            }
            if (!in_array('create_video', $this->all_team_privileges)) {
                $this->team_create_video = false;
            }
            if (!in_array('edit_video', $this->all_team_privileges)) {
                $this->team_edit_video = false;
            }
            if (!in_array('templates', $this->all_team_privileges)) {
                $this->team_templates = false;
            }
            if (!in_array('youtube_publisher', $this->all_team_privileges)) {
                $this->team_youtube_publisher = false;
            }
            
        }

        $output['team_create_avatar'] = $this->team_create_avatar;
        $output['team_create_video'] = $this->team_create_video;
        $output['team_edit_video'] = $this->team_edit_video;
        $output['team_templates'] = $this->team_templates;
        $output['team_youtube_publisher'] = $this->team_youtube_publisher;
        
        
        
        
		$this->loadView('dashboard',$output);
	}
	
	function getBusinessHeader(){
	    
	    $type = '';
	    $html = '';
    	$domain_data = explode(".",$_SERVER['HTTP_HOST']);
		$current_subdomain = current($domain_data);
	    $search = $this->input->post('business');
        // if ($this->user_id == $this->owner_id || $this->owner_id == 0) {
            $this->db->where('user_id', $this->user_id);
        // } else {
        //     $this->db->where_in('id', $business_ids);
        // }
        if(!empty($search))
        {
            $this->db->like('title',$search,'both');
            $this->db->like('domain',$search,'both');
            $type  ='search';
        }
        // $this->db->orderBy('id','DESC');
        $businessData = $this->db->order_by('id','DESC')->get('business b','5')->result_array();
        foreach($businessData as $key => $list)
        
        {
            $img = $list['logo'] == "default_business_logo.png" ? $this->config->item('assetsPath') . "uploads/default_images/default_business_logo.png" : $this->config->item('bucket_url') . $list['logo'] ;
            $html .= '<li style="list-style-type: none;"><a class="dropdown-item" href="'.base_url('workspace_switch').'/'.$list['id'].'">';
            $html .='<img src="'.$img.'" class="img-fluid">'. $list['title'];
            if($current_subdomain == $list['domain'])
            {
             $html .= '<span style="position: absolute;right: 35px;"><i class="icon-check size-icon" style="font-weight:900;color:#58bd1a;"></i></span>';
            } 
            $html .= '</a></li>';
        }
        
   
        $result = array(
            'status' => 1,
            'type' => $type,
            'html' => $html
        );
        echo json_encode($result);
        die;
	}
	
	
		public function test(){
	    
    		$this->load->view('default/test/test');
    	}
	
		public function superVaUpdate(){
	        
	        $superVa = $this->session->userdata('super_va');
	        $superva_name = $this->input->post("superva_name");
	       // pr($_FILES);
	       // pr($_POST);
	       // die;
	        
	        if (!empty($_FILES["superva_image"]['name']) && $this->input->post("type") == 'custom') {

                    $new_file_name           = time() . substr($_FILES["superva_image"]['name'], strpos($_FILES["superva_image"]['name'], '.'));
                    $config['file_name']     = $new_file_name;
                    $config['upload_path']   = 'assets/default/va/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|jfif';
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    $data = 'assets/default/va/'.$this->session->userdata('super_va')->category_image;
                    if (!empty($data) && $data != "superva.png") {
                        if (file_exists($data)) {
                            unlink($data);
                        }
                    }
                    if ($this->upload->do_upload('superva_image')) {
                        $imageData = $this->upload->data();
                        $filename = $imageData['file_name'];
                        $path =  $filename;
                    } else {
                        $error = $this->upload->display_errors();
                        $response = array(
                            'success' => 'false',
                            'error' => $error
                        );
                        echo json_encode($response);
                    }
                    $this->db->where('id',$superVa->id);
                    $this->db->update('prompt_category',['category_image'=>$path]);
                }
                $this->db->where('id',$superVa->super_promptid);
                $this->db->update('prompts',['text'=>$superva_name]);

        		$flashdata['success'] = array('message' => 'Super Va Updated ', 'type' => 'flash');
                $this->session->set_flashdata('message', json_encode($flashdata));
                // $output['redirect'] = base_url("team-management");
                // pr(redirect(base_url("dashboard")));
                // die;
                redirect(base_url("dashboard"));
                // echo json_encode($output);
                // die;
    	}

       public function getCredit(){
          $remain_credit = $this->userRemainCredit(); 
          $remain_credit = round($remain_credit);
        //   $html = abs(10000 - $remain_credit);
          $result = array(
                    'html' => $remain_credit > 0 ? $remain_credit : 0,
                );
           echo json_encode($result);
            die;
       }
       public function getNewLeadsCount(){
          $new_leads_count = $this->newLeadsCount(); 
          $result = array(
                    'html' => $new_leads_count > 0 ? $new_leads_count : 0,
                );
           echo json_encode($result);
            die;
       }
       
    //   	public function test(){
	    
    // 		$this->load->view('default/test/temp');
    // 	}
    	
    		public function temp(){
	    
    		$this->loadView('test/temp');
    	}
    	
    		public function testing(){
	    
    		$this->loadView('test/testing');
    	}
    	
    		public function testAvatar(){
	    
    		$this->loadView('test/testavatar');
    	}

        public function get_all_analyz_data(){
    		$this->db->where('business_id' , $this->business_id);
            // $this->db->order_by('id', 'DESC');
            $this->db->order_by('updated_at', 'DESC');
            $query = $this->db->get($this->analyz_data);
    		$result = $query->result_array();
                        // pr($result); die("ak");
    		
            echo json_encode([
                'success' => true,
                'analyze_data' => $result
            ]);
            
    	}
    	
    	
    	public function get_optimization_graph_data()
        {
            $days = $this->input->post('days');

            $this->db->select("
                DATE(updated_at) as optimize_date,
                COUNT(*) as optimized_count
            ");

            $this->db->from('analyz_data');
            $this->db->where('business_id', $this->business_id);
            $this->db->where('optimized', 1);
            $this->db->where("updated_at >=", date('Y-m-d', strtotime("-{$days} days")));

            $this->db->group_by('DATE(updated_at)');
            $this->db->order_by('optimize_date', 'ASC');

            $result = $this->db->get()->result_array();

            echo json_encode($result);
        }
	
	
}
