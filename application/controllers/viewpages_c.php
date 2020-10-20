<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Viewpages_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //session_start();
        $this->load->model("login_modal");
    }


    //Front End && Back End Pages Load
    public function index(){
        
    $this->load->view('psmsfrontend/pages/index');

    
        
    }
}


