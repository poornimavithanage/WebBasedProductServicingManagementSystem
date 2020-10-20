<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_PHPMailer {
    
    public function __construct() {
        $this->ci =& get_instance();
        $this->ci->config->load('email');
        $this->key = $this->ci->config->item('key');
        
        require_once(APPPATH.'/third_party/PHPMailer/class.phpmailer.php');
    }
    
public function sendmailnow($data) {
        //return "Hello";die;
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->Host = $this->ci->config->item('smtp_host');      // setting GMail or AnyOther SMPT Server as our SMTP server
//        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = $this->ci->config->item('smtp_authentication'); // enable SMTP authentication
        //$mail->SMTPSecure = "tls"; //Secure conection (ssl or tls)
        $mail->Port =$this->ci->config->item('smtp_port'); // set the SMTP port  TLS : 587, SSL: 465

        $mail->Priority = $this->ci->config->item('mail_priority'); // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
        $mail->CharSet = $this->ci->config->item('mail_charset');
        $mail->Encoding = $this->ci->config->item('mail_encoding');
        $mail->ContentType = $this->ci->config->item('mail_contenttype');
        $mail->WordWrap = $this->ci->config->item('mail_wordwrap'); // RFC 2822 Compliant for Max 998 characters per line

        $mail->Username = $this->ci->config->item('mail_username');  // user email address
        $mail->Password =  $this->ci->config->item('mail_password');            // password in GMail
        $mail->SetFrom($this->ci->config->item('mail_fromemail'),$this->ci->config->item('mail_fromname'));  //Who is sending the email
        $mail->AddReplyTo($this->ci->config->item('mail_replytoemail'),$this->ci->config->item('mail_replytoname'));  //email address that receives the response
    
        if($this->ci->config->item('smtp_secure')!=''){
            $mail->SMTPSecure = $this->ci->config->item('smtp_secure');
        }
        
        $recepient = array();
        $mail->Subject = $data["subject"];
        $mail->Body = $data["mailbody"];
        $mail->AltBody = $data["altmailbody"];
        //$mail->addAttachment($data["pathpdf"]);
        $mail->addAttachment($data["pathpdf"].$data['student_id'].".pdf",$data['student_id']." invoice ". $data['date'].".pdf");

        $recepients = $data["recepients"];
         //var_dump($recepients);die;
        foreach ($recepients as $recipient) {
            
            $mail->AddAddress($recipient["email"]);
        }

        //$mail->AddAttachment("images/phpmailer.gif");      // some attached files
        //$mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        if (!$mail->Send()) {
            $mailresult["status"] = false;
            $mailresult["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $mailresult["status"] = true;
        }
        $mail->SmtpClose();
       
        return $mailresult;
    }
    
    public function sendcustomemail($data) {
        //return "Hello";die;
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->Host = $this->ci->config->item('smtp_host');      // setting GMail or AnyOther SMPT Server as our SMTP server
//        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = $this->ci->config->item('smtp_authentication'); // enable SMTP authentication
        //$mail->SMTPSecure = "tls"; //Secure conection (ssl or tls)
        $mail->Port =$this->ci->config->item('smtp_port'); // set the SMTP port  TLS : 587, SSL: 465

        $mail->Priority = $this->ci->config->item('mail_priority'); // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
        $mail->CharSet = $this->ci->config->item('mail_charset');
        $mail->Encoding = $this->ci->config->item('mail_encoding');
        $mail->ContentType = $this->ci->config->item('mail_contenttype');
        $mail->WordWrap = $this->ci->config->item('mail_wordwrap'); // RFC 2822 Compliant for Max 998 characters per line

        $mail->Username = $this->ci->config->item('mail_username');  // user email address
        $mail->Password =  $this->ci->config->item('mail_password');            // password in GMail
        $mail->SetFrom($this->ci->config->item('mail_fromemail'),$this->ci->config->item('mail_fromname'));  //Who is sending the email
        $mail->AddReplyTo($this->ci->config->item('mail_replytoemail'),$this->ci->config->item('mail_replytoname'));  //email address that receives the response
    
        if($this->ci->config->item('smtp_secure')!=''){
            $mail->SMTPSecure = $this->ci->config->item('smtp_secure');
        }
        
      //  $recepient = array();
        $mail->Subject = $data["subject"];
        $mail->Body = $data["mailbody"];
        
        //var_dump($data["mailbody"]);die;
       $mail->AltBody = $data["altmailbody"];

        $recepients = $data["recepients"];
         //var_dump($recepients);die;
        foreach ($recepients as $recipient) {
            
            $mail->AddAddress($recipient["email"]);
        }

        if (!$mail->Send()) {
            $mailresult["status"] = false;
            $mailresult["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $mailresult["status"] = true;
           $mailresult["message"] = "Message sent correctly!";
        }
        $mail->SmtpClose();
       
        return $mailresult;
    }
//    public function sendmailnow($data) {
//        //return "Hello";die;
//        $mail = new PHPMailer();
//        $mail->IsSMTP(); // we are going to use SMTP
//        $mail->Host = "COL-HUBCAS-NLB.brandixlk.org";      // setting GMail or AnyOther SMPT Server as our SMTP server
////        $mail->SMTPDebug = 2;
//        $mail->SMTPAuth = TRUE; // enable SMTP authentication
//        //$mail->SMTPSecure = "tls"; //Secure conection (ssl or tls)
//        $mail->Port = 25; // set the SMTP port  TLS : 587, SSL: 465
//
//        $mail->Priority = 3; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
//        $mail->CharSet = 'UTF-8';
//        $mail->Encoding = '8bit';
//        $mail->ContentType = 'text/html; charset=utf-8\r\n';
//        $mail->WordWrap = 900; // RFC 2822 Compliant for Max 998 characters per line
//
//        $mail->Username = "ddms";  // user email address
//        $mail->Password = "welcome@123";            // password in GMail
//        $mail->SetFrom('ddms@texturedjersey.com', 'DDMS');  //Who is sending the email
//        $mail->AddReplyTo('ddms@texturedjersey.com', 'DDMS');  //email address that receives the response
//
//        $recepient = array();
//
//        $mail->Subject = $data["subject"];
//        $mail->Body = $data["mailbody"];
//        $mail->AltBody = $data["altmailbody"];
//
//        $recepients = $data["recepients"];
//        // var_dump($recepients);die;
//        foreach ($recepients as $recipient) {
//            $mail->AddAddress($recipient["email"], $recipient["name"]);
//        }
//
//        //$mail->AddAttachment("images/phpmailer.gif");      // some attached files
//        //$mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
//        if (!$mail->Send()) {
//            $mailresult["status"] = false;
//            $mailresult["message"] = "Error: " . $mail->ErrorInfo;
//        } else {
//            $mailresult["status"] = true;
//            $mailresult["message"] = "Message sent correctly!";
//        }
//        $mail->SmtpClose();
//
//        return $mailresult;
//    }

}
