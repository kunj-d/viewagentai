<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailsending_Model extends CI_Model {

	function sendmail($subject,$message,$contact_email,$from = false)
	{ 
			// Set SMTP Configuration
			/*$emailConfig = array(
				'protocol' => 'smtp',
				'smtp_host' => 'pb-srv5-client-120.emailpro.saglus.com',
				'smtp_port' => 587,
				'smtp_user' => 'hfaklnrlasdadnrrjjnsfzkffssjklrntntnrri@dpb-srv5-client-138.emailpro.saglus.com',
                'smtp_pass' => '[d#+_PJ%##hy',
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
			);  
				 
			
			
			// Set your email information
			$from = array('email' => 'support@oppyo.com', 'name' => 'AcademyPro');
			$reply_to = array('email' => '', 'name' => '');
			$to = array('email' => $contact_email);
			$subject = $subject;
			 
			$message = $message;
			// Load CodeIgniter Email library
			$this->load->library('email');
			$this->email->initialize($emailConfig);
			$this->load->library('user_agent'); 
			// Sometimes you have to set the new line character for better result
			$this->email->set_newline("\r\n");
			// Set email preferences
			$this->email->from($from['email'], $from['name'],'oireutioerutyoueyurtuyrityurtuyeir@dpb-srv4-client-45.emailpro.saglus.com');
			$this->email->reply_to($reply_to['email'],$reply_to['name']);
			$this->email->to($to);
			 
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->set_header('Feedback-ID', rand());

			// Ready to send email and check whether the email was successfully sent
			 
			if (!$this->email->send()) {
				// Raise error message
				show_error($this->email->print_debugger());
			}
			else {
				// Show success notification or other things here
				//echo 'Success to send email';
				return true;
			}
			//- See more at: https://arjunphp.com/send-gmail-codeigniter-email-library/#sthash.AZ29rif5.dpuf*/


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
			$mail->addAddress($contact_email);
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
	
	
	
}