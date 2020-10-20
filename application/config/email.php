<?php
// EMAIL Configuration - TJ


	$config['protocol'] = 'smtp';
        $config['smtp_secure'] = "ssl"; //(ssl OR tls)
	$config['mail_charset'] = 'UTF-8';
	$config['mail_wordwrap'] = 900;
	$config['mailtype'] = 'html';
	//$config['smtp_timeout'] = 30;
	$config['smtp_host'] = 'smtp.gmail.com';
	$config['smtp_port'] = 465;
	$config['smtp_authentication'] = TRUE;
	$config['mail_priority'] = 3;
	$config['mail_encoding'] = '8bit';
	$config['mail_contenttype'] = "'text/html; charset=utf-8\r\n'";

	$config['mail_username'] = 'stavpsms@gmail.com';
	$config['mail_password'] = 'poke@123#';

	$config['mail_fromemail'] = 'vithanagepurnima@gmail.com';
	$config['mail_fromename'] = 'Approbus';
	$config['mail_replytoemail'] =  'info@approbus.com';
	$config['mail_replytoname'] =  'Approbus';
        
?>