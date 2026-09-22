<?php

class Mail_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->tbl_email_types = "tbl_email_types";
        $this->tbl_email_templates = "tbl_email_templates";
        $this->tbl_user = "tbl_user";

      /* $this->smtp_user = 'hfaklnrlasdadnrrjjnsfzkffssjklrntntnrri@dpb-srv5-client-138.emailpro.saglus.com';
			$this->emailConfig = array(
			    'protocol' => 'smtp',
				'smtp_host' => 'pb-srv5-client-120.emailpro.saglus.com',
'smtp_port' => 587,
'smtp_user' => $this->smtp_user,
'smtp_pass' => '[d#+_PJ%##hy',
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
			);*/
		
			
		
    }
    
    /* function sendmail($to = array(), $subject = "", $message = "", $from = false) {
        if(!$from){
            $from = array('email' => 'support@oppyo.com', 'name' => 'Bizomart');
        }
        $reply_to = $from;

        $this->load->library('email');
        $this->email->initialize($this->emailConfig);
        $this->email->from($from['email'], $from['name'], $this->smtp_user);
        $this->email->reply_to($reply_to['email'], $reply_to['name']);


        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_header('Feedback-ID', rand());

        // Ready to send email and check whether the email was successfully sent
        if (!$this->email->send()) {
            // Raise error message
            show_error($this->email->print_debugger());
        } else {
            //die('mail send ');
            // Show success notification or other things here
        }
    } */

	function sendmail($sending_email,$subject,$message,$from = false)
    {
        require_once(APPPATH."libraries/phpmailer/PHPMailerAutoload.php");
        //Create a new PHPMailer instance
	    $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp-relay.sendinblue.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'it.admin@saglus.com';                         // SMTP username
        $mail->Password = 'BjC7wKfdnkGQaXrJ';
        
        //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                 // TCP port to connect to
        $mail->Sender = 'support@oppyo.com';          // for return path
       
        //Set who the message is to be sent from
        $mail->setFrom('support@oppyo.com', 'Tubeclaw AI (Dr. Amit Pareek & Atul Pareek )'); 
        //Set an alternative reply-to address
		if(!$from){
			$mail->addReplyTo('support@oppyo.com', 'support@oppyo.com');
		}else{
			$mail->addReplyTo($from['email'], $from['name']);
		}
        //Set who the message is to be sent to
        $mail->addAddress($sending_email['email']);
        //Set the subject line
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Subject = $subject;
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Body    = $message;
        //Replace the plain text body with one created manually
        $mail->AltBody = strip_tags($message);
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
            ));
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
                return true;
        }
    }

    function forgetpassword() {
        $emaildata = $this->get_emailtemplate("forgot_password");
        $email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $userinfo = $this->get_userinfo('', $email);

        $password_reset = base_url("reset-password") . "?code=" . $userinfo->reset_key . '&email=' . $email;

        $replaceArray = array(
            'name' => $userinfo->name,
            'email' => $userinfo->email,
            'forgot_password_link' => $password_reset,
        );
        $message = $this->replaceEmailTags($message, $replaceArray);
        $this->sendmail($to, $subject, $message);
    }

    function registration_email($password) {

        $emaildata = $this->get_emailtemplate("registration-email");
        $email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $userinfo = $this->get_userinfo('', $email);
        $emailconfirm_link = base_url("verify-email") . "?code=" . $userinfo->reset_key . '&email=' . $_POST['email'];

        $replaceArray = array(
            'name' => $userinfo->name,
            'email' => $userinfo->email,
            'password' => "********",
            'email_verification_link' => $emailconfirm_link,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        if ($message != '')
            $sendmail = $this->sendmail($to, $subject, $message);
    }
    function registration_team($email, $password, $user_role=false, $owner_name=false) {

        $emaildata = $this->get_emailtemplate("team-registration");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;
        //echo $email;die;
        $userinfo = $this->get_userinfo('', $email);
        $password_reset = $this->config->item('redirectMainUrl') . "reset-password?code=" . $userinfo->reset_key . '&email=' . $email;


        $replaceArray = array(
            'name' => $userinfo->name,
            //'user_role' => $user_role,
            'email' => $userinfo->email,
            'forgot_password_link' => $password_reset,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        //die;
        if ($message != '')
        $this->sendmail($to, $subject, $message);
    }
    function registration_client($email, $password, $user_role=false, $owner_name=false) {

        $emaildata = $this->get_emailtemplate("client-registration");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;
        //echo $email;die;
        $userinfo = $this->get_userinfo('', $email);
        $password_reset = $this->config->item('redirectMainUrl') . "reset-password?code=" . $userinfo->reset_key . '&email=' . $email;


        $replaceArray = array(
            'name' => $userinfo->name,
            //'user_role' => $user_role,
            'email' => $userinfo->email,
            'forgot_password_link' => $password_reset,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        //die;
        if ($message != '')
        $this->sendmail($to, $subject, $message);
    }
    function email_confirm_link() {
        $emaildata = $this->get_emailtemplate("email-confirm-link");

        $email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $userinfo = $this->get_userinfo('', $email);

        $emailconfirm_link = base_url("verify-email") . "?code=" . $userinfo->reset_key . '&email=' . $_POST['email'];
        $replaceArray = array(
            'name' => $userinfo->name,
            'email' => $userinfo->email,
            'email_verification_link' => $emailconfirm_link,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        $this->sendmail($to, $subject, $message);
    }
    
    
    function exceed_email($user_id) {
        $emaildata = $this->get_emailtemplate("view-limit-exced");
        $userinfo = $this->get_userinfo($user_id, '');

        $email = $userinfo->email;
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $replaceArray = array(
            'name' => $userinfo->name,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);

        if ($message != '')
            $this->sendmail($to, $subject, $message);
    }

    function email_video_link($data) {
        $emaildata = $this->get_emailtemplate("video-share-email");
        $email = $data["email"];
        $to = array('email' => $email);
        $subject = "VideoWhizz | Share A Video Link";
        $message = $emaildata->message;

        $this->db->select('thumbnail');
        $this->db->where('slug', $data['slug']);
        $query = $this->db->get('videos');
        $video_info = $query->row_array();

        $replaceArray = array(
            'thumb' => $video_info['thumbnail'],
            'video_link' => base_url() . 'video/' . $data["slug"],
            'video_msg' => $data["message"],
        );

        $message = $this->replaceShareEmailTags($message, $replaceArray);
        if ($message != '')
            $this->sendmail($to, $subject, $message);
    }

    function get_userinfo($id = '', $email = '') {
        $this->db->select('id,name,email,reset_key');
        if ($id != '')
            $this->db->where('id', $id);
        if ($email != '')
            $this->db->where('email', $email);
        $query = $this->db->get($this->tbl_user);
        return $query->row();
    }

    function get_emailtemplate($email_type) {
        $this->db->select("subject, message");
        $this->db->where("email_type", $email_type);
        $query = $this->db->get($this->tbl_email_templates);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return 0;
    }
    
    function replaceEmailTags($content, $replaceArray) {
        //$tagArray = array('{#name#}','{#email#}','{#login_url#}','{#password#}','{#plan_name#}','{#forgot_password_link#}', '{#email_verification_link#}');
        foreach ($replaceArray as $key => $value) {
            //$tagname = str_replace('#}','',str_replace('{#','',$tag));
            $content = str_replace('{#' . $key . '#}', $value, $content);
        }
        $template_data = file_get_contents('./assets/email_template/index.html');
        $template_data = str_replace('{#Email_Content#}', $content, $template_data);
        return $template_data;
    }

    function replaceShareEmailTags($content, $replaceArray) {
        //$tagArray = array('{#name#}','{#email#}','{#login_url#}','{#password#}','{#plan_name#}','{#forgot_password_link#}', '{#email_verification_link#}');

        $template_data = file_get_contents('./assets/email_template/videoshare.html');
        $template_data = str_replace('{#Email_Content#}', $content, $template_data);
        foreach ($replaceArray as $key => $value) {
            $template_data = str_replace('{#' . $key . '#}', $value, $template_data);
        }
        return $template_data;
    }



    /* *****************************************************End User Mails ******************************************************
    *******************************************************************************************************************************
    */


    function enduser_registration_email($email,$business_id,$password=false) {
        $emaildata = $this->get_emailtemplate("enduser-registration-email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $this->db->select('id,name,email,reset_key,business_id');
        $this->db->where('email', $email);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get('members');
        $memberinfo=  $query->row();
        
        $business_id = $memberinfo->business_id;
        $this->db->where('id',$business_id);
        $query1 = $this->db->get('business');
        $business_data = $query1->row_array();


        $emailconfirm_link = base_url("verify-member") . "?code=" . $memberinfo->reset_key . '&email=' . $email;

        if(!$password){
            $password = "********";
        }
        $replaceArray = array(
            'name' => $memberinfo->name,
            'email' => $memberinfo->email,
            'password' => $password,
            'email_verification_link' => $emailconfirm_link,
            'domain_name' => $business_data['title'],
            'domain' => $business_data['domain'],
            'admin_email' => $business_data['notification_email'],
        );

        $message = $this->replaceEndUserEmailTags($message, $replaceArray);
        $message = $this->replaceEndUserEmailHeader($message, $business_data);
        $subject = $this->replaceEndUserSubjectTags($subject, $replaceArray);
        $from = array('email' => $business_data['notification_email'], 'name' => $business_data['title']);
        if ($message != '')
        $sendmail = $this->sendmail($to, $subject, $message,$from);
    }
    function manualy_enduserRegistrationEmail($email,$business_id,$password=false) {
        $emaildata = $this->get_emailtemplate("enduser-registration-email-manual");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $this->db->select('id,name,email,reset_key,business_id');
        $this->db->where('email', $email);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get('members');
        $memberinfo=  $query->row();
        
        $business_id = $memberinfo->business_id;
        $this->db->where('id',$business_id);
        $query1 = $this->db->get('business');
        $business_data = $query1->row_array();


       // $password_reset = site_url("reset-member-password") . "?code=" . $memberinfo->reset_key . '&email=' . $email;

        if(!$password){
            $password = "********";
        }
        $replaceArray = array(
            'name' => $memberinfo->name,
            'email' => $memberinfo->email,
            'password' => $password,
            //'forgot_password_link' => $password_reset,
            'domain_name' => $business_data['title'],
            'domain' => $business_data['domain'],
            'admin_email' => $business_data['notification_email'],
        );

        $message = $this->replaceEndUserEmailTags($message, $replaceArray);
        $message = $this->replaceEndUserEmailHeader($message, $business_data);
        $subject = $this->replaceEndUserSubjectTags($subject, $replaceArray);
        $from = array('email' => $business_data['notification_email'], 'name' => $business_data['title']);
        if ($message != '')
        $sendmail = $this->sendmail($to, $subject, $message,$from);
    }
    function enduser_verification_success_email($email,$business_id) {
        $emaildata = $this->get_emailtemplate("enduser-activation-success");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $this->db->select('id,name,email,reset_key,business_id');
        $this->db->where('email', $email);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get('members');
        $memberinfo=  $query->row();
        
        $business_id = $memberinfo->business_id;
        $this->db->where('id',$business_id);
        $query1 = $this->db->get('business');
        $business_data = $query1->row_array();


        $replaceArray = array(
            'name' => $memberinfo->name,
            'email' => $memberinfo->email,
            'password' => "********",
            'domain_name' => $business_data['title'],
            'domain' => $business_data['domain'],
            'admin_email' => $business_data['notification_email'],
        );

        $message = $this->replaceEndUserEmailTags($message, $replaceArray);
        $message = $this->replaceEndUserEmailHeader($message, $business_data);
        $subject = $this->replaceEndUserSubjectTags($subject, $replaceArray);
        $from = array('email' => $business_data['notification_email'], 'name' => $business_data['title']);
        if ($message != '')
        $sendmail = $this->sendmail($to, $subject, $message,$from);
    }
    function frontEndForgetpassword($email,$business_id){
        $emaildata = $this->get_emailtemplate("enduser-forgot_password");
        //$email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $this->db->select('id,name,email,reset_key,business_id');
        $this->db->where('email', $email);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get('members');
        $memberinfo=  $query->row();
        
        $business_id = $memberinfo->business_id;
        $this->db->where('id',$business_id);
        $query1 = $this->db->get('business');
        $business_data = $query1->row_array();

        $password_reset = base_url("reset-member-password") . "?code=" . $memberinfo->reset_key . '&email=' . $email;
        
        $replaceArray = array(
            'name' => $memberinfo->name,
            'email' => $memberinfo->email,
            'domain_name' => $business_data['title'],
            'domain' => $business_data['domain'],
            'admin_email' => $business_data['notification_email'],
            'forgot_password_link' => $password_reset,
        );
        $message = $this->replaceEndUserEmailTags($message, $replaceArray);
        $message = $this->replaceEndUserEmailHeader($message, $business_data);
        $subject = $this->replaceEndUserSubjectTags($subject, $replaceArray);
        $from = array('email' => $business_data['notification_email'], 'name' => $business_data['title']);
        if ($message != '')
        $this->sendmail($to, $subject, $message,$from);
    }
    function enduser_create_ticket($ticket_data) {
        $business_id = $this->session->userdata('fe_business')['id'];
        $this->db->where('id',$business_id);
        $query1 = $this->db->get('business');
        $business_data = $query1->row_array();
        $member_logged_in = $this->session->userdata('member_logged_in');

        $email = $business_data['notification_email'];
        $emaildata = $this->get_emailtemplate("enduser-create-ticket");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $replaceArray = array(
            'member_name' => $member_logged_in['name'],
            'member_email' => $member_logged_in['email'],
            'ticket_id' => $ticket_data['ticket_id'],
            'display_ticket_id' => $ticket_data['display_ticket_id'],
            'ticket_subject' => $ticket_data['subject'],
            'admin_email' => $business_data['notification_email'],
            'domain' => $business_data['domain'],
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        if ($message != '')
        $sendmail = $this->sendmail($to, $subject, $message);
    }
    function manualProductSaleMail($email,$business_id,$all_titles=false) {
        // $this->db->where_in('id',$all_assign_product_ids);
        // $query = $this->db->get('default_products');
        // if($query->num_rows()){
        //     $all_assign_products = $query->result_array();
        //     $all_products_title  =array_column($all_assign_products,'title');
        //     $all_titles = implode(',',$all_products_title);
            $emaildata = $this->get_emailtemplate("enduser-course-purchase");

            $to = array('email' => $email);
            $subject = $emaildata->subject;
            $message = $emaildata->message;

            $this->db->select('id,name,email,reset_key,business_id');
            $this->db->where('email', $email);
            $this->db->where('business_id', $business_id);
            $query = $this->db->get('members');
            $memberinfo=  $query->row();
            
            $business_id = $memberinfo->business_id;
            $this->db->where('id',$business_id);
            $query1 = $this->db->get('business');
            $business_data = $query1->row_array();

            $replaceArray = array(
                'name' => $memberinfo->name,
                'email' => $memberinfo->email,
                'domain_name' => $business_data['title'],
                'domain' => $business_data['domain'],
                'admin_email' => $business_data['notification_email'],
                'course_name' => $all_titles,
            );
            $message = $this->replaceEndUserEmailTags($message, $replaceArray);
            $message = $this->replaceEndUserEmailHeader($message, $business_data);
            $subject = $this->replaceEndUserSubjectTags($subject, $replaceArray);
            $from = array('email' => $business_data['notification_email'], 'name' => $business_data['title']);
            if ($message != '')
            $this->sendmail($to, $subject, $message,$from );
       //}
        
    }
    
    function replaceEndUserSubjectTags($content, $replaceArray) {
        foreach ($replaceArray as $key => $value) {
            $content = str_replace('{#' . $key . '#}', $value, $content);
        }
      
        return $content;
    }
    function replaceEndUserEmailTags($content, $replaceArray) {
        //$tagArray = array('{#name#}','{#email#}','{#login_url#}','{#password#}','{#plan_name#}','{#forgot_password_link#}', '{#email_verification_link#}');
        foreach ($replaceArray as $key => $value) {
            //$tagname = str_replace('#}','',str_replace('{#','',$tag));
            $content = str_replace('{#' . $key . '#}', $value, $content);
        }
        $template_data = file_get_contents('./assets/email_template/enduser_email_template.html');
        $template_data = str_replace('{#Email_Content#}', $content, $template_data);
        return $template_data;
    }
    function replaceEndUserEmailHeader($template_data, $business_data) {
        // if($business_data['logo']!=''){
        //     $header = '<img src="'.$business_data['logo'].'" style="max-height:50px;max-width:100%; display:block; margin-left:auto; margin-right:auto;" alt="" />';
        // }else{
            $header = '<h1>'.$business_data['title'].'</h1>';
        //}
        $template_data = str_replace('{#Header_Content#}', $header, $template_data);
        return $template_data;
    }
    /*
    function business_user_registration_email($busineeInfo, $verify_code) {
        $emaildata = $this->get_emailtemplate("subscriber-registration");
        $email = $this->input->post("email");
        $name = $this->input->post("name");
        $password = $this->input->post("password");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;
        $emailconfirm_link = site_url("verify-business-user-email") . "?code=" . $verify_code . '&email=' . $email;
        $replaceArray = array(
            'name' => $name,
            'password' => $password,
            'email' => $email,
            'business_name' => $busineeInfo->domain,
            'business_domain' => $busineeInfo->domain,
            'email_verification_link' => $emailconfirm_link,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        if ($message != '')
            $this->sendmail($to, $subject, $message);
    }

    function suscriber_email_confirm_link() {

        return;
        $emaildata = $this->get_emailtemplate("email-confirm-link");

        $email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $userinfo = $this->get_userinfo('', $email);

        $emailconfirm_link = site_url("verify-email") . "?code=" . $userinfo->reset_key . '&email=' . $_POST['email'];
        $replaceArray = array(
            'name' => $userinfo->name,
            'email' => $userinfo->email,
            'email_verification_link' => $emailconfirm_link,
        );

        $message = $this->replaceEmailTags($message, $replaceArray);
        $this->sendmail($to, $subject, $message);
    }

    function businessUserForgetpassword($userinfo) {
        $emaildata = $this->get_emailtemplate("forgot_password");
        $email = $this->input->post("email");
        $to = array('email' => $email);
        $subject = $emaildata->subject;
        $message = $emaildata->message;

        $password_reset = site_url("subuser-reset-password") . "?code=" . $userinfo->reset_key . '&email=' . $email;

        $replaceArray = array(
            'name' => $userinfo->name,
            'email' => $userinfo->email,
            'forgot_password_link' => $password_reset,
        );
        $message = $this->replaceEmailTags($message, $replaceArray);
        $this->sendmail($to, $subject, $message);
    }
    */

}
