<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

    	if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin
	          
	        $data['nav'] = "dashboard";
	        $this->load->view('psmsbackend/pages/dashboard',$data);
            
            }else{
            
                echo "no access";
            }


        }else {

            echo "No user session found or user logout!!!";
        }
        
    }
    
}
